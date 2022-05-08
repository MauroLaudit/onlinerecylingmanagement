@extends('layouts.ormApp')


@push('styles')
    <!-- Style External File -->
    <link href="{{ asset('css/orm-transaction-style.css') }}" rel="stylesheet">
@endpush

@section('content')
    <section class="head-title sticky-top">
        <div class="container">
            <div class="row d-flex justify-content-center">
                <div class="col-md-8">
                    <div class="title">
                        <h1>Transactions</h1>
                    </div>
                </div>

                <div class="col-md-4 d-flex justify-content-end align-items-center">
                    <div type="button" class="btn-nav d-flex align-items-center justify-content-center" data-bs-toggle="modal" data-bs-target="#ormAddOrder" id="add-btn-order">
                        <em class="fa fa-cart-plus" aria-hidden="true"></em> Add Order
                    </div>
                </div>
            </div>  
        </div>
    </section>

    @include('transaction_views.add_transaction')

    <section class="transact-section my-4">
        <div class="container">
            <div class="row">
                <div class="col-md-12">
                    <table id="transactTable" class="table table-striped table-hover table-bordered pt-3" data-page-length='50'>
                        <thead>
                            <tr>
                            <th scope="col">ID</th>
                            <th scope="col">Transaction ID</th>
                            <th scope="col">Company Name</th>
                            <th scope="col">Client Name</th>
                            <th scope="col">Address</th>
                            <th scope="col">Contact Number</th>
                            <th scope="col">Action</th>
                            </tr>
                        </thead>
                        <tbody>
                        @if($transactions)
                            @foreach($transactions as $transactionslist)
                            <tr>
                            <th data-label="ID" scope="row">{{ $transactionslist->id }}</th>
                            <td data-label="Transaction_ID">{{ $transactionslist->transaction_id }}</td>
                            <td data-label="Category_ID">{{ $transactionslist->company_name }}</td>
                            <td data-label="Quantity">{{ $transactionslist->client_name }}</td>
                            <td data-label="Total Price">{{ $transactionslist->address }}</td>
                            <td data-label="Total Price">{{ $transactionslist->contact_no }}</td>
                            <td class="d-flex">
                                <div type="button" class="btn-inner">
                                    <!-- <a href="#" class="text-nav btn-update d-flex align-items-center justify-content-center"><em class="fa fa-pencil" aria-hidden="true"></em>Edit</a> -->
                                    {{-----***************************** EDIT BUTTON *******************************------}}
                                    <a data-bs-toggle="modal" type="button" data-id="{{$transactionslist->transaction_id}}" data-bs-target="#ormViewOrders" class="text-nav btn-view d-flex align-items-center justify-content-center">
                                        <em class="fa fa-eye" aria-hidden="true"></em>View Orders
                                    </a>
                                    @include('transaction_views.view_transacts')
                                </div>
                                
                            </td>
                        </tr>
                            @endforeach
                        @endif
                        </tbody>
                    </table>    
                </div>
            </div>
        </div>
    </section>

    
    
@endsection

@section('script')
    <script src="https://cdn.jsdelivr.net/npm/select2@4.1.0-rc.0/dist/js/select2.min.js"></script>
    
    <script>
    
        $(document).ready(function() {
            //initialize select2
            initializeSelect2();
            //fetch data from item selected
            fetchItemData();

            $('#add_btn').on('click', function(){
                $.ajax({
                    url: "{{ route('stockItems') }}",
                    type: "get",
                    delay: 250,
                    dataType: 'json',
                    data: function(params) {
                        return {
                            query: params.term, // search term
                            "_token": "{{ csrf_token() }}",
                        };
                    },
                    processResults: function(response) {
                        return {
                            results: response
                        };
                    },
                    cache: true
                });

                var new_order='';
                new_order+='<tr id="row_new_orders">';
                new_order+='<td><select name="commodity[]" class="js-example-basic-single itemList" required>';
                new_order+='<option selected>-- Choose item --</option>';
                new_order+='</select></td>';
                new_order+='<td><input type="number" name="quantity[]" class="form-input itemQuantity" required></td>';
                new_order+='<td><input type="number" name="tot_price[]" min="0.00" max="10000.00" step="0.01" class="form-input itemPrice" required readonly></td>';
                new_order+='<td class="d-flex justify-content-center align-items-center">';
                new_order+='<button type="button" class="btn btn-danger btn-inner d-flex justify-content-center align-items-center" id="remove_btn"><em class="fa fa-remove" aria-hidden="true"></em></button>'
                new_order+='</td>';
                new_order+='</tr>';
                
                $('#table-order').append(new_order);

                //initialize select2
                initializeSelect2();
                //fetch data from item selected
                fetchItemData();
            });


            function initializeSelect2(){
                $(".itemList").select2({
                    selectOnClose: true,
                    dropdownParent: $('#ormAddOrder'),
                    placeholder: "-- Choose Item --",
                    ajax: {
                        url: "{{ route('stockItems') }}",
                        type: "get",
                        delay: 250,
                        dataType: 'json',
                        data: function(params) {
                            return {
                                query: params.term, // search term
                                "_token": "{{ csrf_token() }}",
                            };
                        },
                        processResults: function(response) {
                            return {
                                results: response
                            };
                        },
                        cache: true
                    },
                });
            }
            
            function fetchItemData(){
                $('.itemList').on('change', function(){
                    var selected = $(this).find(':selected').val();  
                    var parentTR = $(this).closest('tr');

                    $.ajax({
                        url: "{{ route('fetchItems') }}",
                        type: "get",
                        data:{stock_id:$(this).find(':selected').val()}, // the value of input having id vid
                        success: function(response){ // What to do if we succeed
                            /* parentRow.find('.itemPrice').val(response[0].price);
                            parentRow.find('.itemQuantity').val(response[0].amount); */
                            checkData(response[0].amount, response[0].price);
                        }
                    });

                    parentTR.find('.itemPrice').val("");
                    parentTR.find('.itemQuantity').val("");
                });
            }

            function checkData(amount, price){
                console.log(amount + ", " + price);

                $('.itemQuantity').change( function(){
                    var parentRow = $(this).closest('tr');
                    var inputQuantity = parseInt(parentRow.find('.itemQuantity').val(), 10) || 0;
                    console.log(inputQuantity);
                    if(inputQuantity > amount){
                        Swal.fire({
                            title: "Invalid Input!",
                            text: "Not Enough Stock! You Only have " + amount + "kg",
                            icon: "warning",
                            showCloseButton: true,
                            showConfirmButton: false,
                            timer: 1000
                        });
                    }
                    else{
                        var totPrice = inputQuantity * price;

                        parentRow.find('.itemPrice').val(totPrice);
                        

                        if($('#totOrder').val() == ''){
                            $('#totOrder').val(totPrice);
                        }
                        else{
                            var totalOrders = parseInt($('#totOrder').val()) + totPrice;
                            $('#totOrder').val(totalOrders);
                        }
                        
                    }
                });
            }
        });
    </script>

    <script>
        $(document).on('click', '#remove_btn', function(){
            var itemTotOrder= parseInt($('#totOrder').val());
            var itemTotPrice = parseInt($(this).closest('tr').find('.itemPrice').val());
            $(this).closest('tr').remove();
            $('#totOrder').val(itemTotOrder - itemTotPrice);
        });

        $(document).on('hidden.bs.modal', function(){
            $("tbody").find("tr:gt(0)").remove();
            $('#ormAddOrder form')[0].reset();
            $(".itemList").select2({
                selectOnClose: true,
                dropdownParent: $('#ormAddOrder'),
                placeholder: "-- Choose Item --",
                ajax: {
                    url: "{{ route('stockItems') }}",
                    type: "get",
                    delay: 250,
                    dataType: 'json',
                    data: function(params) {
                        return {
                            query: params.term, // search term
                            "_token": "{{ csrf_token() }}",
                        };
                    },
                    processResults: function(response) {
                        return {
                            results: response
                        };
                    },
                    cache: true
                },
            });
        });

        $('#add-btn-order').click(function(){ 
            $("tbody").find("tr:gt(0)").remove();
            $('#ormAddOrder form')[0].reset();
        });
    </script>

    <script>
        $(document).ready(function(){
            $('#company_name').on('change', function(){
                var str = $('#company_name').val();
                var matches = str.match(/\b(\w)/g);
                var acronym = matches.join('');
                /* alert(acronym); */

                var d = new Date();
                var strDate = (d.getMonth()+1) + "" + d.getDate() + "" + d.getFullYear();

                var transactID = acronym.toUpperCase() + "-" + strDate + "-" + Math.floor((Math.random() * 9999) + 1);
                
                $('#transaction_id').val(transactID);
                /* alert(transactID); */
            });
        });
    </script>
@endsection