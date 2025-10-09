@extends('VENDORPANEL.Vendor')
@section('title', 'Vendor Home')
@section('content')

    <div class="container justify-content-center">
        <div class="container mt-3 mb-5 justify-content-center d-flex overflow-hidden">
            <div class="row container">
                <div class="col-8 justify-content-center align-items-center d-flex">
                    <div class="container">
                        <canvas id="myChart" width="700" height="500"></canvas>
                    </div>
                </div>
                <div class="col-4 justify-content-center d-flex" style="background-color: #081621; border-radius: 10px;">
                    <div class="container-fluid mt-2">
                        <h6 class="text-white text-center mt-2">Totale Quantity Of Sale: {{$total}}</h6>
                        <div class="row">
                            <div class="col-6">
                                <span class="text-white" style="font-size: 14px">Ac: {{$Ac}}</span><br>
                                <span class="text-white" style="font-size: 14px">Air Cooler: {{$Aicooler}}</span><br>
                                <span class="text-white" style="font-size: 14px">Tv: {{$Tv}}</span><br>
                                <span class="text-white" style="font-size: 14px">Fridge: {{$Fridge}}</span><br>
                                <span class="text-white" style="font-size: 14px">Washing Machine:
                                    {{$Washingmachine}}</span><br>
                                <span class="text-white" style="font-size: 14px">Oven: {{$Oven}}</span><br>
                                <span class="text-white" style="font-size: 14px">Blender: {{$Blender}}</span><br>
                                <span class="text-white" style="font-size: 14px">Dish Washer: {{$Dishwasher}}</span><br>
                                <span class="text-white" style="font-size: 14px">Chimney: {{$Chimney}}</span><br>

                            </div>
                            <div class="col-6">
                                <span class="text-white" style="font-size: 14px">Electric Stove:
                                    {{$Electricstove}}</span><br>
                                <span class="text-white" style="font-size: 14px">Rice Cooker: {{$Ricecooker}}</span><br>
                                <span class="text-white" style="font-size: 14px">Celling Fan: {{$Ceillingfan}}</span><br>
                                <span class="text-white" style="font-size: 14px">Toster: {{$Toaster}}</span><br>
                                <span class="text-white" style="font-size: 14px">Vacuum Cleaner:
                                    {{$Vacuumcleaner}}</span><br>
                                <span class="text-white" style="font-size: 14px">Water Heater: {{$waterheater}}</span><br>
                                <span class="text-white" style="font-size: 14px">Bulb: {{$Bulb}}</span><br>
                                <span class="text-white" style="font-size: 14px">Iron: {{$Iron}}</span><br>
                                <span class="text-white" style="font-size: 14px">Air Purifier: {{$Airpurifier}}</span><br>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
        </div>
        <div class="container mt-3 ml-2 pt-5 mb-5 justify-content-center d-flex">
            <div class="row container">
                <div class="col-4 justify-content-center d-flex" style="background-color: #081621; border-radius: 10px;">
                    <div class="container-fluid mt-2">
                        <h6 class="text-white text-center mt-2">Totale Amount Of Sale: {{$sumc}}</h6>
                        <div class="row">
                            <div class="col-6 container-fluid">
                                <span class="text-white" style="font-size: 14px">Ac: {{$Acc}}</span><br>
                                <span class="text-white" style="font-size: 14px">Air Cooler: {{$Aicoolerc}}</span><br>
                                <span class="text-white" style="font-size: 14px">Tv: {{$Tvc}}</span><br>
                                <span class="text-white" style="font-size: 14px">Fridge: {{$Fridgec}}</span><br>
                                <span class="text-white" style="font-size: 14px">Washing Machine:
                                    {{$Washingmachinec}}</span><br>
                                <span class="text-white" style="font-size: 14px">Oven: {{$Ovenc}}</span><br>
                                <span class="text-white" style="font-size: 14px">Blender: {{$Blenderc}}</span><br>
                                <span class="text-white" style="font-size: 14px">Dish Washer: {{$Dishwasherc}}</span><br>
                                <span class="text-white" style="font-size: 14px">Chimney: {{$Chimneyc}}</span><br>

                            </div>
                            <div class="col-6">
                                <span class="text-white" style="font-size: 14px">Electric Stove:
                                    {{$Electricstovec}}</span><br>
                                <span class="text-white" style="font-size: 14px">Rice Cooker: {{$Ricecookerc}}</span><br>
                                <span class="text-white" style="font-size: 14px">Celling Fan: {{$Ceillingfanc}}</span><br>
                                <span class="text-white" style="font-size: 14px">Toster: {{$Toasterc}}</span><br>
                                <span class="text-white" style="font-size: 14px">Vacuum Cleaner:
                                    {{$Vacuumcleanerc}}</span><br>
                                <span class="text-white" style="font-size: 14px">Water Heater: {{$waterheaterc}}</span><br>
                                <span class="text-white" style="font-size: 14px">Bulb: {{$Bulbc}}</span><br>
                                <span class="text-white" style="font-size: 14px">Iron: {{$Ironc}}</span><br>
                                <span class="text-white" style="font-size: 14px">Air Purifier: {{$Airpurifierc}}</span><br>
                            </div>
                        </div>
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
                <div class="col-4 justify-content-center d-flex" style="background-color: #081621; border-radius: 10px;">
                    <div class="container-fluid mt-2 text-white">
                        <h5 class="text-center mb-3">Monthly Sales</h5>
                        <ul class="list-group list-group-flush">
                            @php
                                $months = ['Jan', 'Feb', 'Mar', 'Apr', 'May', 'Jun', 'Jul', 'Aug', 'Sep', 'Oct', 'Nov', 'Dec'];
                            @endphp
                            @foreach($monthlySales as $index => $sale)
                                <span style="font-size: 20px;"><span>{{ $months[$index] }}</span> :
                                    ${{ number_format($sale, 2) }}</span>
                            @endforeach
                        </ul>
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
                                                    {{ $Acc}}, {{ $Aicoolerc}}, {{ $Tvc}}, {{ $Fridgec}}, {{ $Washingmachinec}}, {{ $Ovenc}},
                                                    {{ $Blenderc}}, {{ $Dishwasherc}}, {{ $Chimneyc}}, {{ $Electricstovec}}, {{ $Ricecookerc}},
                                                    {{ $Ceillingfanc}}, {{ $Toasterc}}, {{ $Vacuumcleanerc}}, {{ $waterheaterc}}, {{ $Bulbc}},
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
                        'Jan', 'Feb', 'Mar', 'Apr', 'May', 'Jun',
                        'Jul', 'Aug', 'Sep', 'Oct', 'Nov', 'Dec'
                    ],
                    datasets: [{
                        label: 'Total Sales per Month',
                        data: @json($monthlySales), // Blade will convert PHP array to JS
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
