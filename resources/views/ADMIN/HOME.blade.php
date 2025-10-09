@extends('ADMIN.Admin')
@section('title', 'Admin Home')
@section('content')
    <div class="container mt-5 pt-5 mb-5 justify-content-center d-flex">
        <div class="row container">
            <div class="col-8 justify-content-center align-items-center d-flex">
                <div class="container">
                    <canvas id="myLineChart" width="700" height="500"></canvas>
                </div>
            </div>
            <div class="col-4 justify-content-center d-flex" style="background-color: #081621; border-radius: 10px;">
                <div class="container-fluid mt-2 text-white">
                    <h5 class="text-center mb-3">Monthly Sales</h5>
                    <ul class="list-group list-group-flush">
                        @php
                            $months = ['Jan', 'Feb', 'Mar', 'Apr', 'May', 'Jun', 'Jul', 'Aug', 'Sep', 'Oct', 'Nov', 'Dec'];
                        @endphp
                        @foreach($monthlySales as $index => $sale)
                            <span style="font-size: 20px;"><span>{{ $months[$index] }}</span> : ${{ number_format($sale, 2) }}</span>
                        @endforeach
                    </ul>
                </div>
            </div>

        </div>
    </div>


    <script src="https://cdn.jsdelivr.net/npm/chart.js"></script>
    <script>

        const ctx3 = document.getElementById('myLineChart').getContext('2d');

        new Chart(ctx3, {
            type: 'line',
            data: {
                labels: [
                    'Jan', 'Feb', 'Mar', 'Apr', 'May', 'Jun',
                    'Jul', 'Aug', 'Sep', 'Oct', 'Nov', 'Dec'
                ],
                datasets: [{
                    label: 'Total Sales per Month',
                    data: @json($monthlySales),
                    fill: false,
                    borderColor: 'rgb(75, 192, 192)',
                    backgroundColor: 'rgba(75, 192, 192, 0.2)',
                    tension: 0.1
                }]
            },
            options: {
                responsive: true,
                maintainAspectRatio: false,
                scales: {
                    y: {
                        beginAtZero: true
                    }
                }
            }
        });
    </script>
@endsection
