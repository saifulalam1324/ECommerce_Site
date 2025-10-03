@extends('USER.User')
@section('title', 'Orders')
@section('content')

    @php
        $total = 0;
    @endphp
    @foreach($batches as $batchId => $batch)
        @php
            $total += $batch['batch_total'];
        @endphp
        <div class="container mt-2 card mb-4 p-3">
            <div class="card-header text-white" style="background-color: #081621;">
                <strong>Transaction ID:</strong> {{ $batchId }}
            </div>
            <div class="card-body">
                <h5 class="text-end">Total: ${{ number_format($batch['batch_total'], 2) }}</h5>
            </div>
        </div>
    @endforeach
    <div class="container fixed-bottom bg-white border-top shadow-lg py-3">
        <div class="container d-flex justify-content-center">
            <h5 class="mb-0">
                Total: <strong>{{ number_format($total, 2) }}</strong>
            </h5>
        </div>
    </div>

@endsection
