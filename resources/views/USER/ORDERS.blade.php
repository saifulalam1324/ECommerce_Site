@extends('USER.User')
@section('title', 'Orders')
@section('content')
    <div class="container mt-3 card mb-4 p-3">
        <div class="card-header d-flex justify-content-between" style="background-color: #081621">
            <a href="{{ route('Orders') }}" class="text-white" style="text-decoration: none;">Pending Orders</a>
            <a href="{{ route('ShippedOrdersc') }}" class="text-white" style="text-decoration: none;">Shipped Orders</a>
            <a href="{{ route('deliveredOrders') }}" class="text-white" style="text-decoration: none;">Delivered
                Orders</a>
        </div>
    </div>
    <div class="container order-div" id="pending">
        @foreach($batches as $batchId => $batch)
            <div class="container mt-2 card mb-4 p-3">
                <div class="card-header text-white" style="background-color: #081621;">
                    <strong>Transaction ID:</strong> {{ $batchId }}
                </div>
                <div class="card-body">
                    <ul class="list-group mb-2">
                        @foreach($batch['items'] as $item)
                            @php
                                $display_price = ($item['line_total'] == $item['discounted_tota'])
                                    ? $item['line_total']
                                    : $item['discounted_tota'];
                            @endphp
                            <li class="list-group-item d-flex justify-content-between align-items-center">
                                <span>
                                    <img src="{{ asset('storage/' . $item['image_url']) }}" width="60" class="me-2">
                                    {{ $item['product_name'] }} (x{{ $item['quantity'] }})
                                </span>
                                <span>Delivery Status: <strong class="text-danger">{{ $item['delivery_status'] }}</strong></span>
                                <span>Placed: {{ $batch['created_at'] }}</span>
                                <span class="text-secondary">Sold by: {{ $item['vendor_name'] }}</span>
                                <span>
                                    ${{ number_format($display_price, 2) }}
                                    @if($item['line_total'] != $item['discounted_tota'])
                                        <small
                                            class="text-muted text-decoration-line-through">${{ number_format($item['line_total'], 2) }}</small>
                                    @endif
                                </span>
                            </li>
                        @endforeach
                    </ul>

                    @php
                        $batch_display_total = ($batch['batch_total'] == $batch['batch_discounted_total'])
                            ? $batch['batch_total']
                            : $batch['batch_discounted_total'];
                    @endphp

                    <h5 class="text-end">
                        Batch Total Paid: ${{ number_format($batch_display_total, 2) }}
                        @if($batch['batch_total'] != $batch['batch_discounted_total'])
                            <small
                                class="text-muted text-decoration-line-through">${{ number_format($batch['batch_total'], 2) }}</small>
                        @endif
                    </h5>
                </div>
                <div>
                    <a href="{{ route('Pdf', ['id' => $batchId]) }}" class="btn"
                        style="background-color: #081621; color: white;">Download Pdf</a>
                </div>
            </div>
        @endforeach
    </div>
@endsection
