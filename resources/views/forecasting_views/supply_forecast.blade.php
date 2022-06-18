@extends('layouts.ormApp')

@push('styles')
    <!-- Style External File -->
    <link href="{{ asset('css/orm-forecasting-style.css') }}" rel="stylesheet">
    <!-- <script src="https://cdn.jsdelivr.net/npm/chart.js@3.8.0/dist/chart.min.js"></script> -->
    <script src="https://cdn.jsdelivr.net/npm/echarts@5.3.2/dist/echarts.min.js"></script>
    
@endpush

@section('content')
    <section class="head-title sticky-top">
        <div class="container">
            <div class="row d-flex justify-content-center">
                <div class="col-md-6">
                    <div class="title">
                        <h1>Supply Forecasting</h1>
                    </div>
                </div>
                <div class="col-md-6 d-flex justify-content-end align-items-center">
                    <div class="btn-inner" type="button">
                        <a data-bs-toggle="modal" type="button" data-forecast_type="Supply" data-bs-target="#ormAddForecast">
                            New Forecast (<em class="fa fa-cubes"></em>)
                        </a>
                    </div>
                </div>
            </div>
        </div>
    </section>
    
    @include('forecasting_views.add_forecast')
    
    <section class="forecast-data">
        <div class="container">
            <div class="row">
                
                <div class="col-md-12 d-flex justify-content-start">
                    <select name="category" id="category">
                        <option value="Paper" selected>Paper</option>
                        <option value="Plastic">Plastic</option>
                        <option value="Metal">Metal</option>
                        <option value="Glass">Glass</option>
                    </select>
                    <select name="yearRecords" id="yearRecords">
                        <option></option>
                    </select>
                </div>
            </div>
            <div class="row">
                <div class="col-md-12">
                    <div id="supply_forecast" style="width:100%;height:450px;margin-top:-20px;"></div>
                </div>
            </div>
        </div>
        <!-- <canvas id="myChart" width="400px" height="400px"></canvas> -->
        
        
        
    </section>

    <script src="https://cdn.jsdelivr.net/npm/select2@4.1.0-rc.0/dist/js/select2.min.js"></script>
    <script type="text/javascript">
        
        $(document).ready(function(){
            fetchYearRecord();
            fetchDataSupply();
            $('#category').on('change', function(){
                /* alert($('#category').val()); */
                fetchYearRecord();
                fetchDataSupply();
            })

            function fetchYearRecord(){
                $("#yearRecords").select2({
                    selectOnClose: true,
                    placeholder: "-- Choose Item --",
                    ajax: {
                        url: "{{ route('yearSupplyRecords') }}",
                        type: "get",
                        delay: 250,
                        dataType: 'json',
                        data: {category:$('.forecast-data').find('#category :selected').val()},
                        processResults: function(response) {
                            return {
                                results: response
                            };
                        },
                        cache: true
                    },
                });
            }

            function fetchDataSupply(){
                var myChart = echarts.init(document.getElementById('supply_forecast'));
                
                var option = {
                    animationDuration: 7000,
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
                    data:{input_category:$('.forecast-data').find('#category :selected').val(), year:$("#yearRecords").val()},
                    success: function(response){ // What to do if we succeed
                        // console.log(response);
                        // console.log($('#category').val());
                        var months = [];
                        var supply = [];
                        var forecastSupply = [];
                        $.each(response, function(index, item) {
                            var obj = new Object();
                            var month = "";
                            
                            
                            months.push(item.monthData);
                            supply.push(item.supplyValue);
                            forecastSupply.push(item.forecastSupply);
                        });
                        
                        myChart.setOption ({
                            legend: {
                                data: ['supply', 'forecast-supply'],
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
                                    name: 'forecast-supply',
                                    type: 'line',
                                    data: forecastSupply,
                                    color: ['#ff0000'],
                                },
                                {
                                    name: 'supply',
                                    type: 'line',
                                    data: supply,
                                    color: ['#007fff'],
                                }
                                
                            ]
                            
                        });
                    }
                });
            }
        })
    </script>

    <!-- Fetch Data to Forecast Specific Data -->
    <script>
        $(document).ready(function(){
            
            $('#modal_category').change(function(){
                fetchYearForecast();
            })
            $('.yearList').change(function(){
                
                fetchMonthSupply();
            })

            fetchTotalSupply();

            $('#add_btn').on('click', function(){
                var totDiv = parseInt($('#divisor').val());

                var new_order='';
                
                new_order+='<tr id="row_new_forecast">';
                new_order+='<td>';
                new_order+='<select name="year" class="js-example-basic-single yearList" required>';
                new_order+='<option></option>';
                new_order+='</select></td>';
                new_order+='<td>';
                new_order+='<select name="month" class="js-example-basic-single monthList" required>';
                new_order+='<option></option>';
                new_order+='</select></td>';
                new_order+='<td><input type="number" name="totalSupply[]" class="form-input totalSupply" required readonly></td>';
                new_order+='<td class="d-flex justify-content-center align-items-center">';
                new_order+='<button type="button" class="btn btn-danger btn-inner d-flex justify-content-center align-items-center" id="remove_btn"><em class="fa fa-remove" aria-hidden="true"></em></button></td>';
                new_order+='</tr>';
                
                $('#table-forecast').append(new_order);

                $('#divisor').val(totDiv + 1);

                //initialize select2 for Year
                fetchYearForecast();
                $('.yearList').change(function(){
                    fetchMonthSupply();
                })

                fetchTotalSupply();
            });

            function fetchYearForecast(){
                $(".yearList").select2({
                    selectOnClose: true,
                    dropdownParent: $('#ormAddForecast'),
                    placeholder: "-- Choose Item --",
                    ajax: {
                        url: "{{ route('yearSupplyRecords') }}",
                        type: "get",
                        delay: 250,
                        dataType: 'json',
                        data: {category:$('#ormAddForecast').find('#modal_category :selected').val()},
                        processResults: function(response) {
                            return {
                                results: response
                            };
                        },
                        cache: true
                    },
                });
            }

            function fetchMonthSupply(){
                var parentTR = $('.monthList').closest('tr');
                $(".monthList").select2({
                    selectOnClose: true,
                    dropdownParent: $('#ormAddForecast'),
                    placeholder: "-- Choose Item --",
                    ajax: {
                        url: "{{ route('monthSupplyRecords') }}",
                        type: "get",
                        delay: 250,
                        dataType: 'json',
                        data: {year:parentTR.find('.yearList :selected').val(), category:$('#ormAddForecast').find('#modal_category :selected').val()},
                        processResults: function(response) {
                            return {
                                results: response
                            };
                        },
                        cache: true
                    },
                });
            }

            function fetchTotalSupply(){
                var currentMonth = $('.monthList').val();
                $('.monthList').on('change', function(){
                    var selected = $(this).find(':selected').val();  
                    var parentTR = $(this).closest('tr');

                    $.ajax({
                        url: "{{ route('monthTotalSupply') }}",
                        type: "get",
                        dataType: 'json',
                        data:{month:parentTR.find('.monthList :selected').val(), year:parentTR.find('.yearList :selected').val(), category:$('#ormAddForecast').find('#modal_category :selected').val()},
                        success: function(response){ // What to do if we succeed
                            console.log(response[0].totSupply);
                            parentTR.find('.totalSupply').val(response[0].totSupply);
                        }
                    });
                    
                });
            }
        })

        $(document).on('click', '#remove_btn', function(){
            $(this).closest('tr').remove();
        });

        $(document).on('hidden.bs.modal', function(){
            $(".forecast_tbl tbody").find("tr:gt(0)").remove();
            $('#ormAddForecast form')[0].reset();

            $(".yearList").select2({});
            $(".monthList").select2({});
        });

        $('#btn_forecast').click(function(){ 
            $(".forecast_tbl tbody").find("tr:gt(0)").remove();
            $('#ormAddForecast form')[0].reset();
        });
    </script>

    <script>
        $('#ormAddForecast').on('show.bs.modal', function(event) {
            var button = $(event.relatedTarget)
            var type = button.data('forecast_type')

            //alert(type);
            var modal = $(this);
            modal.find('.modal-body #forecast-type').val(type);
        })
    </script>
@endsection