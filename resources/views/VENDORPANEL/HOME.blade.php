@extends('VENDORPANEL.Vendor')
@section('title', 'Vendor Home')
@section('content')
    <div class="container-fluid pl-5 pt-4 mt-5 ml-3 justify-content-center align-items-center">
        <div class="container-fluid fixed-top border-0 p-2 mb-5 d-flex justify-content-center"
            style="background-color: #081621">
            <h2 class="text-white text-center">Vendor Dashboard</h2>
        </div>
    </div>

    <div class="container mt-5 pt-5 justify-content-center d-flex">
        <div class="row">
            <div class="col-6 justify-content-center align-items-center d-flex">
                <div class="container">
                    <canvas id="myChart" width="500" height="500"></canvas>
                </div>
            </div>
            <div class="col-6 justify-content-center align-items-center d-flex">
                <div class="container">
                    <canvas id="myDoughnut" width="500" height="500"></canvas>
                </div>
            </div>
        </div>
    </div>

    <script src="https://cdn.jsdelivr.net/npm/chart.js"></script>

    <script>
        const ctx = document.getElementById('myChart').getContext('2d');

        new Chart(ctx, {
            type: 'bar',
            data: {
                labels: ['Tv', 'Fridge', 'Ac', 'Green', 'Purple', 'Orange', 'Tv', 'Fridge', 'Ac', 'Green', 'Purple', 'Orange', 'Tv', 'Fridge', 'Ac', 'Green', 'Purple', 'Orange'],
                datasets: [{
                    label: '# of Votes',
                    data: [12, 19, 3, 5, 2, 3, 12, 19, 3, 5, 2, 3, 12, 19, 3, 5, 2, 3],
                    backgroundColor: Array(18).fill('#081621')
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

        const ctx2 = document.getElementById('myDoughnut').getContext('2d');

        new Chart(ctx2, {
            type: 'doughnut',
            data: {
                labels: ['Red', 'Blue', 'Yellow'],
                datasets: [{
                    label: 'My First Dataset',
                    data: [300, 50, 100],
                    backgroundColor: [
                        'rgb(255, 99, 132)',
                        'rgb(54, 162, 235)',
                        'rgb(255, 205, 86)'
                    ],
                    hoverOffset: 4
                }]
            },
            options: {
                responsive: true,
                maintainAspectRatio: false
            }
        });
    </script>
@endsection
