@extends('VENDORPANEL.Vendor')
@section('title', 'Vendor Home')
@section('content')

    <div class="container mt-3 pt-5 mb-5 justify-content-center d-flex">
        <div class="row container">
            <div class="col-8 justify-content-center align-items-center d-flex">
                <div class="container">
                    <canvas id="myChart" width="700" height="500"></canvas>
                </div>
            </div>
            <div class="col-4 justify-content-center align-items-center d-flex">
                <div class="container">

                </div>
            </div>
        </div>
    </div>
    <div class="container mt-3 pt-5 mb-5 justify-content-center d-flex">
        <div class="row container">
            <div class="col-4 ">
                <div class="container">

                </div>
            </div>
            <div class="col-8 justify-content-center align-items-center d-flex">
                <div class="container">
                    <canvas id="myDoughnut" width="700" height="500"></canvas>
                </div>
            </div>
        </div>
    </div>
    <div class="container mt-3 pt-5 mb-5 justify-content-center d-flex">
        <div class="row container">
            <div class="col-8 justify-content-center align-items-center d-flex">
                <div class="container">
                    <canvas id="myLineChart" width="700" height="500"></canvas>
                </div>
            </div>
            <div class="col-4 justify-content-center align-items-center d-flex">
                <div class="container">

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



        const ctx3 = document.getElementById('myLineChart').getContext('2d');

        const labels = ['January', 'February', 'March', 'April', 'May', 'June', 'July']; // or Utils.months({count: 7})

        new Chart(ctx3, {
            type: 'line',
            data: {
                labels: labels,
                datasets: [{
                    label: 'My First Dataset',
                    data: [65, 59, 80, 81, 56, 55, 40],
                    fill: false,
                    borderColor: 'rgb(75, 192, 192)',
                    tension: 0.1
                }]
            },
            options: {
                responsive: true,
                maintainAspectRatio: false
            }
        });

    </script>
@endsection
