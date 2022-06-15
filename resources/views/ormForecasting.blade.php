@extends('layouts.ormApp')

@push('styles')
    <!-- Style External File -->
    <link href="{{ asset('css/orm-inventory-style.css') }}" rel="stylesheet">
    <!-- <script src="https://cdn.jsdelivr.net/npm/chart.js@3.8.0/dist/chart.min.js"></script> -->
    <script src="https://cdn.jsdelivr.net/npm/echarts@5.3.2/dist/echarts.min.js"></script>
    
@endpush

@section('content')
    <section class="head-title sticky-top">
        <div class="container">
            <div class="row d-flex justify-content-center">
                <div class="col-md-12">
                    <div class="title">
                        <h1>Data Charts and Records</h1>
                    </div>
                </div>

                <!-- <div class="col-md-4 d-flex justify-content-end align-items-center">
                    <div type="button" id="btn_addStock" class="btn-nav d-flex align-items-center justify-content-center" data-bs-toggle="modal" data-bs-target="#ormAddStock">
                        <em class="fa fa-cart-plus" aria-hidden="true"></em> Add Stock
                    </div>
                </div> -->
            </div>
        </div>
    </section>
    <section>
        
    </section>
    <section class="forecast-data">
        <div class="container">
            <div class="row">
                <div class="col-md-6">
                    <a href="" class="btn_forecast">
                        New Forecast
                    </a>
                </div>
                <div class="col-md-6 d-flex justify-content-end">
                    <select name="category" id="category">
                        <option value="Paper" selected>Paper</option>
                        <option value="Plastic">Plastic</option>
                        <option value="Metal">Metal</option>
                        <option value="Glass">Glass</option>
                    </select>
                </div>
            </div>
            <div class="row">
                <div class="col-md-12">
                    <div id="supply_forecast" style="width:100%;height:450px;"></div>
                </div>
            </div>
        </div>
        <!-- <canvas id="myChart" width="400px" height="400px"></canvas> -->
        
        
        
    </section>
<!-- <script>
    const ctx = document.getElementById('myChart');
    const myChart = new Chart(ctx, {
        type: 'line',
        data: {
            labels: ['Red', 'Blue', 'Yellow', 'Green', 'Purple', 'Orange'],
            datasets: [{
                label: '# of Votes',
                data: [12, 19, 3, 5, 2, 3],
                backgroundColor: [
                    'rgba(255, 99, 132, 0.2)',
                    'rgba(54, 162, 235, 0.2)',
                    'rgba(255, 206, 86, 0.2)',
                    'rgba(75, 192, 192, 0.2)',
                    'rgba(153, 102, 255, 0.2)',
                    'rgba(255, 159, 64, 0.2)'
                ],
                borderColor: [
                    'rgba(255, 99, 132, 1)',
                    'rgba(54, 162, 235, 1)',
                    'rgba(255, 206, 86, 1)',
                    'rgba(75, 192, 192, 1)',
                    'rgba(153, 102, 255, 1)',
                    'rgba(255, 159, 64, 1)'
                ],
                borderWidth: 1
            }]
        },
        options: {
            scales: {
                y: {
                    beginAtZero: true
                }
            }
        }
    });
</script> -->
    <script type="text/javascript">
        
        $(document).ready(function(){
            fetchDataSupply();
            $('#category').on('change', function(){
                /* alert($('#category').val()); */
                fetchDataSupply();
            })
            function fetchDataSupply(){
                var myChart = echarts.init(document.getElementById('supply_forecast'));
                
                var option = {

                    grid: {
                        
                        containLabel: true
                    },
                    legend: {
                    },    
                    tooltip: {
                        trigger: 'axis',
                        backgroundColor: 'rgba(0,0,0,0.75)',
                        padding: [10, 15],
                        textStyle: {
                            fontSize: 13,
                            fontFamily: 'Poppins, sans-serif'
                        }
                    },
                    xAxis: {
                    },
                    yAxis: {
                    },
                    series: [
                    ]
                };

                myChart.setOption(option);

                $.ajax({
                    url: '{{ route('supply') }}',
                    type: 'GET',
                    data:{input_category:$('.forecast-data').find('#category :selected').val()},
                    success: function(response){ // What to do if we succeed
                        console.log(response);
                        console.log($('#category').val());
                        var months = [];
                        var supply = [];
                        $.each(response, function(index, item) {
                            var obj = new Object();
                            var month = "";
                            
                            
                            months.push(item.monthData);

                            obj.month = month;
                            obj.value = item.totSupply;
                            supply.push(item.supplyValue);
                        });
                        
                        myChart.setOption ({
                            legend: {
                                data: ['demand']
                            },
                            xAxis: {
                                type:'category',
                                data: months,
                                boundaryGap: false,
                                axisLabel: {
                                    color: '#333'
                                },
                                axisLine: {
                                    lineStyle: {
                                        color: '#999'
                                    }
                                },
                                splitLine: {
                                    lineStyle: {
                                        color: ['#eee']
                                    }
                                }
                            },
                            yAxis: {
                                type: 'value',
                                axisLabel: {
                                    color: '#333'
                                },
                                axisLine: {
                                    lineStyle: {
                                        color: '#ddd'
                                    }
                                },
                                splitLine: {
                                    lineStyle: {
                                        color: ['#eee']
                                    }
                                },
                                splitArea: {
                                    show: true,
                                    areaStyle: {
                                        color: ['rgba(250,250,250,0.1)', 'rgba(0,0,0,0.01)']
                                    }
                                }
                            },
                            series: [{
                                name: 'demand',
                                type: 'line',
                                data: supply,
                                color: ['#007fff'],
                            } ]
                            
                        });
                    }
                });
            }
        })
    </script>
@endsection