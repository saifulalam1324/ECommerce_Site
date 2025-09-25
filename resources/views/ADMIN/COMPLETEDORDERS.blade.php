@extends('ADMIN.Admin')
@section('title', 'Completed Orders')
@section('content')
    <div class="container-fluid pl-5 pt-4 mt-5 ml-3 justify-content-center align-items-center">
        <div class="container-fluid fixed-top border-0 p-2 mb-5" style="background-color: #7a4eb0;">
            <h2 class="text-white text-center">Completed Orders</h2>
        </div>
        @foreach ($batches as $batchId => $batch)
            <div class="container mt-4 card p-3">
                <div class="card-header text-white" style="background-color: #7a4eb0;">
                    <strong>Transaction ID:</strong> {{ $batchId }}
                </div>
                <div class="card-body">
                    <ul class="list-group mb-2">
                        @foreach ($batch['items'] as $item)
                            <li class="list-group  item d-flex justify-content-between">
                                <span>
                                    <img src="{{ asset('storage/' . $item['image_url']) }}" width="60" class="me-2">
                                    {{ $item['product_name'] }} (x{{ $item['quantity'] }})
                                </span>
                                <span class="text-danger">Delivery Status : {{ $item['delivery_status'] }}</span>
                                <span>Placed: {{ $batch['created_at'] }}</span>
                                <span>${{ number_format($item['line_total'], 2) }}</span>
                                <span>Company: {{$item['vendor_name']}}</span>
                                <span>Company Email: {{$item['vendor_email']}}</span>
                                <span>Customer Name: {{$item['customer_name']}}</span>
                                <span>Customer Address: {{$item['customer_address']}}</span>
                                <span>Customer Phone: {{$item['customer_phone']}}</span>
                                <span>Customer Email: {{$item['customer_email']}}</span>
                            </li>
                        @endforeach
                    </ul>
                    <h5 class="text-end">Batch Total: ${{ number_format($batch['batch_total'], 2) }}</h5>
                </div>
            </div>
        @endforeach
        </div>
@endsection
