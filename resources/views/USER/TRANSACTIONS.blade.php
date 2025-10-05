@extends('USER.User')
@section('title', 'Transactions')
@section('content')

    @php
        $total_to_show = 0;
    @endphp
    @foreach($batches as $batchId => $batch)
        @php
            $display_total = ($batch['batch_total'] == $batch['batch_discounted_total'])
                ? $batch['batch_total']
                : $batch['batch_discounted_total'];

            $total_to_show += $display_total;
        @endphp
        <div class="container mt-2 card mb-4 p-3">
            <div class="card-header text-white" style="background-color: #081621;">
                <strong>Transaction ID:</strong> {{ $batchId }}
            </div>
            <div class="card-body">
                <h5 class="text-end">Total Paid: ${{ number_format($display_total, 2) }}</h5>
            </div>
        </div>
    @endforeach
    <div class="container fixed-bottom bg-white border-top shadow-lg py-3">
        <div class="container d-flex justify-content-center">
            <h5 class="mb-0">
                Total Paid: <strong>{{ number_format($total_to_show, 2) }}</strong>
            </h5>
        </div>
    </div>
@endsection
