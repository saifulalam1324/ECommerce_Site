import pandas as pd
import numpy as np
from scipy.sparse import csr_matrix
from implicit.als import AlternatingLeastSquares
from sqlalchemy import create_engine, text
from datetime import datetime

# ============================================================
# 1. DATABASE CONFIGURATION
# ============================================================

DB_USER = "root"
DB_PASSWORD = ""
DB_HOST = "127.0.0.1"
DB_PORT = "3306"
DB_NAME = "ecommerce_site"

DATABASE_URL = (
    f"mysql+pymysql://{DB_USER}:{DB_PASSWORD}"
    f"@{DB_HOST}:{DB_PORT}/{DB_NAME}"
)

engine = create_engine(DATABASE_URL)


# ============================================================
# 2. LOAD CUSTOMER PURCHASE DATA
# ============================================================

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


# ============================================================
# 3. CHECK WHETHER THERE IS ENOUGH DATA
# ============================================================

if orders.empty:
    print("No order data found.")
    exit()

if orders["customer_id"].nunique() < 2:
    print("Not enough customers to train recommendation model.")
    exit()

if orders["product_id"].nunique() < 2:
    print("Not enough products to train recommendation model.")
    exit()


# ============================================================
# 4. COMBINE DUPLICATE CUSTOMER-PRODUCT PURCHASES
# ============================================================

orders = (
    orders
    .groupby(["customer_id", "product_id"], as_index=False)["quantity"]
    .sum()
)


# ============================================================
# 5. CREATE CUSTOMER AND PRODUCT INDEXES
# ============================================================

customer_categories = orders["customer_id"].astype("category")

orders["customer_idx"] = customer_categories.cat.codes

customer_ids = list(customer_categories.cat.categories)


product_categories = orders["product_id"].astype("category")

orders["product_idx"] = product_categories.cat.codes

product_ids = list(product_categories.cat.categories)


# ============================================================
# 6. CREATE USER-ITEM INTERACTION MATRIX
# ============================================================

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


# ============================================================
# 7. TRAIN ALS RECOMMENDATION MODEL
# ============================================================

model = AlternatingLeastSquares(
    factors=20,
    regularization=0.1,
    iterations=20,
    random_state=42
)

# implicit expects item-user matrix
model.fit(interaction_matrix.T.tocsr())

print("Recommendation model trained.")


# ============================================================
# 8. GENERATE RECOMMENDATIONS
# ============================================================

recommendation_rows = []

TOP_N = 10

for customer_idx in range(len(customer_ids)):

    recommendations, scores = model.recommend(
        customer_idx,
        interaction_matrix[customer_idx],
        N=TOP_N,
        filter_already_liked_items=True
    )

    for product_idx, score in zip(recommendations, scores):

        recommendation_rows.append({
            "customer_id": customer_ids[customer_idx],
            "product_id": product_ids[product_idx],
            "score": float(score),
            "generated_at": datetime.now()
        })


# ============================================================
# 9. CREATE DATAFRAME
# ============================================================

results = pd.DataFrame(recommendation_rows)

print("Recommendations generated:", len(results))


# ============================================================
# 10. DELETE OLD RECOMMENDATIONS
# ============================================================

with engine.begin() as connection:

    connection.execute(
        text("DELETE FROM recommendations")
    )


# ============================================================
# 11. SAVE NEW RECOMMENDATIONS TO MYSQL
# ============================================================

if not results.empty:

    results.to_sql(
        "recommendations",
        engine,
        if_exists="append",
        index=False
    )


# ============================================================
# 12. FINISHED
# ============================================================

if not results.empty:

    print(
        f"Successfully saved {len(results)} recommendations "
        f"for {results['customer_id'].nunique()} customers."
    )

else:

    print("No recommendations were generated.")
