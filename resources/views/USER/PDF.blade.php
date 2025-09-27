<!doctype html>
<html lang="en">
  <head>
    <title>Title</title>
    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1, shrink-to-fit=no">
    <link rel="stylesheet" href="https://stackpath.bootstrapcdn.com/bootstrap/4.3.1/css/bootstrap.min.css" integrity="sha384-ggOyR0iXCbMQv3Xipma34MD+dH/1fQ784/j6cY/iJTQUOhcWr7x9JvoRxT2MZw1T" crossorigin="anonymous">
  </head>
  <body>
     @foreach($batches as $batchId => $items)
        @php
            $createdAt  = optional($items->first())->created_at;
            $batchTotal = $items->sum(function ($i) {
                return $i->price * $i->quantity;
            });
        @endphp
        <div class="container mt-2 card mb-4 p-3">
            <div class="card-header" style="background-color:#7a4eb0; color: white;">
                <h2 class="text-center">Your Market</h2>
            </div>
        </div>
        <div class="container mt-2 card mb-4 p-3">
            <div class="card-header" style="background-color:#7a4eb0; color: white;">
                <strong>Transaction ID:</strong> {{ $batchId }}
                <span class="float-right">Placed: {{ $createdAt }}</span>
            </div>

            <div class="card-body">
                <ul class="list-group mb-2">
                    @foreach($items as $item)
                        <li class="list-group-item d-flex justify-content-between">
                            <span>
                                {{ $item->product_name }} (x{{ $item->quantity }})
                            </span>
                            <span>
                                Delivery Status :
                                <span class="text-danger">
                                    <strong>{{ $item->delivery_status }}</strong>
                                </span>
                            </span>
                            <span>${{ number_format($item->price * $item->quantity, 2) }}</span>
                            <span class="text-secondary">
                                Sold by: {{ $item->company_name }}
                            </span>
                        </li>
                    @endforeach
                </ul>
                <h5 class="text-end">Total: ${{ number_format($batchTotal, 2) }}</h5>
            </div>
        </div>
    @endforeach
    <script src="https://code.jquery.com/jquery-3.3.1.slim.min.js" integrity="sha384-q8i/X+965DzO0rT7abK41JStQIAqVgRVzpbzo5smXKp4YfRvH+8abtTE1Pi6jizo" crossorigin="anonymous"></script>
    <script src="https://cdnjs.cloudflare.com/ajax/libs/popper.js/1.14.7/umd/popper.min.js" integrity="sha384-UO2eT0CpHqdSJQ6hJty5KVphtPhzWj9WO1clHTMGa3JDZwrnQq4sF86dIHNDz0W1" crossorigin="anonymous"></script>
    <script src="https://stackpath.bootstrapcdn.com/bootstrap/4.3.1/js/bootstrap.min.js" integrity="sha384-JjSmVgyd0p3pXB1rRibZUAYoIIy6OrQ6VrjIEaFf/nJGzIxFDsf4x0xIM+B07jRM" crossorigin="anonymous"></script>
  </body>
</html>
