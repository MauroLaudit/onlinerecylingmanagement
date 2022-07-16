@extends('layouts.ormApp')

@push('styles')
    <!-- Styles and Script Here -->
    <link href="{{ asset('css/orm-dashboard-style.css') }}" rel="stylesheet">
    <script src="https://cdn.jsdelivr.net/npm/echarts@5.3.2/dist/echarts.min.js"></script>
@endpush

@section('content')
    <section class="dashboard-section">
        <div class="container">
            <div class="row mt-3">
                <div class="col-md-12">
                    <div class="d-flex justify-content-evenly mb-4">
                        <div class="col-3 yearRevenue box-data text-center">
                            <div class="yearTitle"></div>
                            <div class="yearValue h4"></div>
                        </div>
                        <div class="col-3 monthRevenue box-data text-center">
                            <div class="monTitle"></div>
                            <div class="monValue h4"></div>
                        </div>
                        <div class="col-3 totTransact box-data text-center">
                            <div class="transTitle"></div>
                            <div class="transValue h4"></div>
                        </div>
                    </div>
                </div>
            </div>
            <div class="row">
                <div class="col-md-6">
                    <div id="monthlyTransacts" style="width:100%;height:420px;"></div>
                </div>
                <div class="col-md-6">
                    <div id="categoryRevenue" style="width:100%;height:420px;"></div>
                </div>
            </div>
        </div> 
    </section>

    <script type="text/javascript">
        
        $(document).ready(function(){
            fetchRevenue();
            fetchDemandSupply();
            fetchCategorizeRevenue();
            function fetchRevenue(){
                var d = new Date();
                const monthNames = ["January", "February", "March", "April", "May", "June",
                    "July", "August", "September", "October", "November", "December"];

                $('.monTitle').text("Monthly Revenue ( " + monthNames[d.getMonth()+1] + " )");
                $('.yearTitle').text("Total Revenue in " + d.getFullYear());
                $('.transTitle').text("Monthly Transactions ( " + monthNames[d.getMonth()+1] + " )");
                
                $.ajax({
                    url: '{{ route('revenueRecords') }}',
                    type: 'GET',
                    data:{year:d.getFullYear(), month:d.getMonth()+1},
                    success: function(response){ // What to do if we succeed 
                        var yearRev = 0, monRev = 0;
                        if(response[0].yearRevenueValue == null ){
                            $('.yearValue').text(0);
                        }else{
                            $('.yearValue').text("Php " + response[0].yearRevenueValue + "0");
                        }
                        if(response[0].monRevenueValue == null ){
                            $('.monValue').text("Php 0.00");
                        }else{
                            $('.monValue').text("Php " + response[0].monRevenueValue + "0");
                        }
                        if(response[0].monTotTransactions == 0 ){
                            $('.transValue').text("00");
                        }else{
                            $('.transValue').text(response[0].monTotTransactions);
                        }
                    }
                });
            }
            function fetchDemandSupply(){
                var currentYear = new Date().getFullYear();
                var myChart = echarts.init(document.getElementById('monthlyTransacts'));
                
                var option = {
                    title:{
                        show: true,
                        text: 'Monthly Demand and Supply '+ currentYear,
                        left: 'center',
                    },
                    animationDuration: 1000,
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
                    url: '{{ route('transactRecords') }}',
                    type: 'GET',
                    data:{year:currentYear},
                    success: function(response){ // What to do if we succeed 
                        var months = [];
                        var demands = [];
                        var supplies = [];
                        $.each(response, function(index, item) {
                            months.push(item.monthData);
                            demands.push(item.dataDemand);
                            supplies.push(item.dataSupply);
                        });
                        
                        myChart.setOption ({
                            legend: {
                                data: ['demands', 'supplies'],
                                top: 'bottom',
                                itemHeight: 8,
                                itemGap: 20
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
                            series: [
                                {
                                    name: 'supplies',
                                    type: 'bar',
                                    data: supplies,
                                    color: ['#00ff1e'],
                                },{
                                    name: 'demands',
                                    type: 'bar',
                                    data: demands,
                                    color: ['#007fff'],
                                }
                            ]
                            
                        });
                    }
                });
            }
            function fetchCategorizeRevenue(){
                var currentYear = new Date().getFullYear();
                var myChart = echarts.init(document.getElementById('categoryRevenue'));
                
                var option = {
                    title:{
                        show: true,
                        text: 'Revenues Per Category ('+ currentYear + ')',
                        left: 'center',
                    },
                    animationDuration: 1000,
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
                    url: '{{ route('revenueCategories') }}',
                    type: 'GET',
                    data:{year:currentYear},
                    success: function(response){ // What to do if we succeed 
                        var months = [];
                        var glass = [];
                        var metal = [];
                        var paper = [];
                        var plastic = [];
                        $.each(response, function(index, item) {
                            months.push(item.monthData);
                            glass.push(item.glassValue);
                            metal.push(item.metalValue);
                            paper.push(item.paperValue);
                            plastic.push(item.plasticValue);

                        });
                        
                        myChart.setOption ({
                            legend: {
                                data: ['glass', 'metal', 'paper', 'plastic'],
                                top: 'bottom',
                                itemHeight: 8,
                                itemGap: 20
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
                            series: [
                                {
                                    name: 'glass',
                                    type: 'bar',
                                    data: glass,
                                    color: ['#ff0000'],
                                },{
                                    name: 'metal',
                                    type: 'bar',
                                    data: metal,
                                    color: ['#007fff'],
                                },{
                                    name: 'paper',
                                    type: 'bar',
                                    data: paper,
                                    color: ['#ffdd00'],
                                },{
                                    name: 'plastic',
                                    type: 'bar',
                                    data: plastic,
                                    color: ['#00ff1e'],
                                }
                            ]
                            
                        });
                    }
                });
            }
        })
    </script>
@endsection