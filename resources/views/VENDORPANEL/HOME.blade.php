@extends('VENDORPANEL.Vendor')
@section('title', 'Vendor Home')
@section('content')

    <div class="container justify-content-center">
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
        <div class="container mt-3 ml-2 pt-5 mb-5 justify-content-center d-flex">
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
    </div>


    <script src="https://cdn.jsdelivr.net/npm/chart.js"></script>

    <script>
        const ctx = document.getElementById('myChart').getContext('2d');

        new Chart(ctx, {
            type: 'bar',
            data: {
                labels: [
                    'Ac', 'AirCooler', 'Tv', 'Fridge', 'WashingMachine', 'Oven',
                    'Blender', 'DishWasher', 'Chimney', 'ElectricStove', 'RiceCooker',
                    'CeilingFan', 'Toaster', 'VacuumCleaner', 'WaterHeater', 'Bulb',
                    'Iron', 'AirPurifier'
                ],
                datasets: [{
                    label: '# of Orders',
                    data: [
                                {{ $Ac }}, {{ $Aicooler }}, {{ $Tv }}, {{ $Fridge }}, {{ $Washingmachine }}, {{ $Oven }},
                                {{ $Blender }}, {{ $Dishwasher }}, {{ $Chimney }}, {{ $Electricstove }}, {{ $Ricecooker }},
                                {{ $Ceillingfan }}, {{ $Toaster }}, {{ $Vacuumcleaner }}, {{ $waterheater }}, {{ $Bulb }},
                                {{ $Iron }}, {{ $Airpurifier }}
                    ],
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
                labels: [
                    'Ac', 'AirCooler', 'Tv', 'Fridge', 'WashingMachine', 'Oven',
                    'Blender', 'DishWasher', 'Chimney', 'ElectricStove', 'RiceCooker',
                    'CeilingFan', 'Toaster', 'VacuumCleaner', 'WaterHeater', 'Bulb',
                    'Iron', 'AirPurifier'
                ],
                datasets: [{
                    label: 'Orders per Category',
                    data: [
                            {{ $Ac }}, {{ $Aicooler }}, {{ $Tv }}, {{ $Fridge }}, {{ $Washingmachine }}, {{ $Oven }},
                            {{ $Blender }}, {{ $Dishwasher }}, {{ $Chimney }}, {{ $Electricstove }}, {{ $Ricecooker }},
                            {{ $Ceillingfan }}, {{ $Toaster }}, {{ $Vacuumcleaner }}, {{ $waterheater }}, {{ $Bulb }},
                            {{ $Iron }}, {{ $Airpurifier }}
                    ],
                    backgroundColor: [
                        '#FF6384', '#36A2EB', '#FFCE56', '#4BC0C0', '#9966FF', '#FF9F40',
                        '#C9CBCF', '#FF6384', '#36A2EB', '#FFCE56', '#4BC0C0', '#9966FF',
                        '#FF9F40', '#C9CBCF', '#FF6384', '#36A2EB', '#FFCE56', '#4BC0C0'
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

        new Chart(ctx3, {
            type: 'line',
            data: {
                labels: [
                    'Ac', 'AirCooler', 'Tv', 'Fridge', 'WashingMachine', 'Oven',
                    'Blender', 'DishWasher', 'Chimney', 'ElectricStove', 'RiceCooker',
                    'CeilingFan', 'Toaster', 'VacuumCleaner', 'WaterHeater', 'Bulb',
                    'Iron', 'AirPurifier'
                ],
                datasets: [{
                    label: 'Orders per Category',
                    data: [
                        {{ $Ac }}, {{ $Aicooler }}, {{ $Tv }}, {{ $Fridge }}, {{ $Washingmachine }}, {{ $Oven }},
                        {{ $Blender }}, {{ $Dishwasher }}, {{ $Chimney }}, {{ $Electricstove }}, {{ $Ricecooker }},
                        {{ $Ceillingfan }}, {{ $Toaster }}, {{ $Vacuumcleaner }}, {{ $waterheater }}, {{ $Bulb }},
                        {{ $Iron }}, {{ $Airpurifier }}
                    ],
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
