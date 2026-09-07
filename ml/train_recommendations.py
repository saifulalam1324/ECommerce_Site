import pandas as pd
import numpy as np

from scipy.sparse import csr_matrix
from implicit.als import AlternatingLeastSquares

from sqlalchemy import create_engine, text

from datetime import datetime



DB_USER = "root"
DB_PASSWORD = ""
DB_HOST = "127.0.0.1"
DB_PORT = "3306"
DB_NAME = "ecommerce"


DATABASE_URL = (
    f"mysql+pymysql://{DB_USER}:{DB_PASSWORD}"
    f"@{DB_HOST}:{DB_PORT}/{DB_NAME}"
)

engine = create_engine(DATABASE_URL)



query = """
SELECT
    customer_id,
    product_id,
    quantity
FROM orders
WHERE customer_id IS NOT NULL
AND product_id IS NOT NULL
"""

orders = pd.read_sql(query, engine)

print("Orders loaded:", len(orders))



if orders.empty:
    print("No order data found.")
    exit()

if orders["customer_id"].nunique() < 2:
    print("Not enough customers to train recommendation model.")
    exit()

if orders["product_id"].nunique() < 2:
    print("Not enough products to train recommendation model.")
    exit()




orders = (
    orders
    .groupby(
        ["customer_id", "product_id"],
        as_index=False
    )["quantity"]
    .sum()
)



customer_categories = (
    orders["customer_id"].astype("category")
)

orders["customer_idx"] = (
    customer_categories.cat.codes
)

customer_ids = list(
    customer_categories.cat.categories
)




product_categories = (
    orders["product_id"].astype("category")
)

orders["product_idx"] = (
    product_categories.cat.codes
)

product_ids = list(
    product_categories.cat.categories
)




interaction_matrix = csr_matrix(
    (
        orders["quantity"].astype(float),
        (
            orders["customer_idx"],
            orders["product_idx"]
        )
    ),
    shape=(
        len(customer_ids),
        len(product_ids)
    )
)


print("Interaction matrix created.")
print("Customers:", len(customer_ids))
print("Products:", len(product_ids))



model = AlternatingLeastSquares(
    factors=10,
    regularization=0.1,
    iterations=20,
    random_state=42
)


print("Training ALS model...")

# IMPORTANT:
# Do NOT transpose here.
model.fit(interaction_matrix)

print("Recommendation model trained.")


recommendation_rows = []

TOP_N = min(10, len(product_ids) - 1)


for customer_idx in range(len(customer_ids)):

    recommendations, scores = model.recommend(
        customer_idx,
        interaction_matrix[customer_idx],
        N=TOP_N,
        filter_already_liked_items=True
    )

    for product_idx, score in zip(
        recommendations,
        scores
    ):

        recommendation_rows.append({
            "customer_id": int(
                customer_ids[customer_idx]
            ),

            "product_id": int(
                product_ids[product_idx]
            ),

            "score": float(score),

            "generated_at": datetime.now()
        })



results = pd.DataFrame(
    recommendation_rows
)


print(
    "Recommendations generated:",
    len(results)
)


with engine.begin() as connection:

    connection.execute(
        text(
            "DELETE FROM recommendations"
        )
    )


if not results.empty:

    results.to_sql(
        "recommendations",
        engine,
        if_exists="append",
        index=False
    )

    print(
        f"Successfully saved "
        f"{len(results)} recommendations "
        f"for "
        f"{results['customer_id'].nunique()} customers."
    )

else:

    print(
        "No recommendations were generated."
    )
