@extends('ADMIN.Admin')
@section('title', 'Pending Orders')
@section('content')
    <div class="container-fluid pl-5 pt-4 mt-5 ml-3 justify-content-center align-items-center">
        @if (session('info'))
            <div class="alert alert-info mt-5">
                {{ session('info') }}
            </div>
        @endif

        @if (count($batches) == 0)
            <div class="alert alert-danger alert-info mt-5">
                No pending orders available.
            </div>
        @endif
        <div class="container">
            <h3>Total: {{ count($batches) }}</h3>
        </div>
        @foreach ($batches as $batchId => $batch)
            <div class="container mt-4 card p-3">
                <div class="card-header text-white" style="background-color: #081621;">
                    <strong>Transaction ID:</strong> {{ $batchId }}
                </div>
                <div class="card-body">
                    <ul class="list-group mb-2">
                        @foreach ($batch['items'] as $item)
                            @php
                                $display_price = ($item['line_total'] == $item['discounted_total'])
                                    ? $item['line_total']
                                    : $item['discounted_total'];
                            @endphp
                            <li class="list-group  item d-flex justify-content-between">
                                <span>
                                    <img src="{{ asset('storage/' . $item['image_url']) }}" width="60" class="me-2">
                                    {{ $item['product_name'] }} (x{{ $item['quantity'] }})
                                </span>
                                <span>Delivery Status : <span
                                        class="text-danger"><strong>{{ $item['delivery_status'] }}</strong></span></span>
                                <span>Placed: {{ $batch['created_at'] }}</span>
                                <span>
                                    ${{ number_format($display_price, 2) }}
                                    @if($item['line_total'] != $item['discounted_total'])
                                        <small
                                            class="text-muted text-decoration-line-through">${{ number_format($item['line_total'], 2) }}</small>
                                    @endif
                                </span>
                                <span>Company: {{ $item['vendor_name'] }}</span>
                                <span>Company Email: {{ $item['vendor_email'] }}</span>
                                <span>Customer ID: {{ $item['customer_id'] }}</span>
                                <span>Customer Name: {{ $item['customer_name'] }}</span>
                                <span>Customer Address: {{ $item['customer_address'] }}</span>
                                <span>Customer Phone: {{ $item['customer_phone'] }}</span>
                                <span>Customer Email: {{ $item['customer_email'] }}</span>
                            </li>
                        @endforeach
                    </ul>

                    @php
                        $batch_display_total = ($batch['batch_total'] == $batch['batch_discounted_total'])
                            ? $batch['batch_total']
                            : $batch['batch_discounted_total'];
                    @endphp

                    <h5 class="text-end">
                        Batch Total: ${{ number_format($batch_display_total, 2) }}
                        @if($batch['batch_total'] != $batch['batch_discounted_total'])
                            <small
                                class="text-muted text-decoration-line-through">${{ number_format($batch['batch_total'], 2) }}</small>
                        @endif
                    </h5>

                    <form id="shippedForm" action="{{ route('UpdateDeliveryStatus', $batchId)}}" method="POST">
                        @csrf
                        <input type="hidden" name="vendor_email" value="{{ $item['vendor_email'] }}">
                        <button type="submit" class="btn text-white" style="background-color: #081621;">Mark as Shipped</button>
                    </form>
                    <script>
                        document.getElementById('shippedForm').addEventListener('submit', function (event) {
                            event.preventDefault();
                            if (confirm("Are you sure you want to mark this order as shipped?")) {
                                this.submit();
                            }
                        });
                    </script>
                </div>
            </div>
        @endforeach
    </div>
@endsection
