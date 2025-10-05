@extends('VENDORPANEL.Vendor')
@section('title', 'Shipped Orders')
@section('content')
    @if (session('info'))
        <div class="alert alert-info mt-5">
            {{ session('info') }}
        </div>
    @endif

    @if (count($batches) == 0)
        <div class="container alert alert-danger alert-info mt-5">
            No pending orders available.
        </div>
    @endif
    @foreach($batches as $batchId => $batch)
        <div class="container mt-2 card mb-4 p-3">
            <div class="card-header text-white" style="background-color: #081621;">
                <strong>Transaction ID:</strong> {{ $batchId }}
            </div>
            <div class="card-body">
                <ul class="list-group mb-2">
                    @foreach($batch['items'] as $item)
                        @php
                            $display_price = ($item['line_total'] == $item['discounted_total'])
                                ? $item['line_total']
                                : $item['discounted_total'];
                        @endphp
                        <li class="list-group-item d-flex justify-content-between align-items-center">
                            <span>
                                <img src="{{ asset('storage/' . $item['image_url']) }}" width="60" class="me-2">
                                {{ $item['product_name'] }} (x{{ $item['quantity'] }})
                            </span>
                            <span>Delivery Status: <strong class="text-success">{{ $item['delivery_status'] }}</strong></span>
                            <span>${{ number_format($display_price, 2) }}
                                @if($item['line_total'] != $item['discounted_total'])
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
                <h5 class="text-end">Batch Total: ${{ number_format($batch_display_total, 2) }}
                    @if($batch['batch_total'] != $batch['batch_discounted_total'])
                        <small class="text-muted text-decoration-line-through">${{ number_format($batch['batch_total'], 2) }}
                        </small>
                    @endif
                </h5>
            </div>
        </div>
    @endforeach

@endsection
