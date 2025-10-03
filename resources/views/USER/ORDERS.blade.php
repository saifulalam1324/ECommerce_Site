@extends('USER.User')
@section('title', 'Orders')
@section('content')
    <div class="container mt-3 card mb-4 p-3">
        <div class="card-header d-flex justify-content-between" style="background-color: #081621">
            <a href="#" class="text-white" style="text-decoration: none;">Pending Orders</a>
            <a href="#" class="text-white" style="text-decoration: none;">Shipped Orders</a>
            <a href="#" class="text-white" style="text-decoration: none;">Delivered Orders</a>
        </div>
    </div>

    @foreach($batches as $batchId => $batch)
        <div class="container mt-2 card mb-4 p-3">
            <div class="card-header text-white" style="background-color: #081621;">
                <strong>Transaction ID:</strong> {{ $batchId }}
            </div>
            <div class="card-body">
                <ul class="list-group mb-2">
                    @foreach($batch['items'] as $item)
                        <li class="list-group-item d-flex justify-content-between">
                            <span>
                                <img src="{{ asset('storage/' . $item['image_url']) }}" width="60" class="me-2">
                                {{ $item['product_name'] }} (x{{ $item['quantity'] }})
                            </span>
                            <span>Delivery Status : <span class="text-danger"><strong>{{ $item['delivery_status'] }}</strong></span></span>
                            <span>Placed: {{ $batch['created_at'] }}</span>
                            <span class="text-secondary">Sold by: {{ $item['vendor_name'] }}</span>
                            <span>${{ number_format($item['line_total'], 2) }}</span>
                        </li>
                    @endforeach
                </ul>

                <h5 class="text-end">Batch Total: ${{ number_format($batch['batch_total'], 2) }}</h5>
            </div>
            <div>
                <a href="{{ route('Pdf', ['id' => $batchId]) }}" class="btn"
                    style="background-color: #081621; color: white;">Download Pdf</a>
            </div>
        </div>
    @endforeach

@endsection
