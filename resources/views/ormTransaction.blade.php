@extends('layouts.ormApp')


@push('styles')
    <!-- Style External File -->
    <link href="{{ asset('css/orm-transaction-style.css') }}" rel="stylesheet">
@endpush

@section('content')
    <section class="head-title">
        <div class="container">
            <div class="row d-flex justify-content-center">
                <div class="col-md-8">
                    <div class="title">
                        <h1>Orders</h1>
                    </div>
                </div>

                <div class="col-md-4 d-flex justify-content-end align-items-center">
                    <div type="button" class="btn-nav d-flex align-items-center justify-content-center" data-bs-toggle="modal" data-bs-target="#ormAddOrder">
                        <em class="fa fa-cart-plus" aria-hidden="true"></em> Add Order
                    </div>
                </div>
            </div>  
        </div>
    </section>

    @include('transaction_views.add_transaction')

    <section class="form-order">
        <div class="container">
            <div class="row">
                <div class="col-md-12">
                    <table id="transactTable" class="table table-striped table-hover">
                        <thead>
                            <tr>
                                <th scope="col">#</th>
                                <th scope="col">First</th>
                                <th scope="col">Last</th>
                                <th scope="col">Handle</th>
                                <th scope="col">Action</th>
                            </tr>
                        </thead>
                        <tbody>
                            <tr>
                                <th scope="row">1</th>
                                <td>Mark</td>
                                <td>Otto</td>
                                <td>@mdo</td>
                                <td class="d-flex">
                                    <div type="button" class="btn-inner">
                                        <a href="#" class="text-nav btn-update d-flex align-items-center justify-content-center"><em class="fa fa-pencil" aria-hidden="true"></em>Edit</a>
                                    </div>
                                    <div type="button" class="btn-inner">
                                        <a href="#" class="text-nav btn-delete d-flex align-items-center justify-content-center"><em class="fa fa-trash" aria-hidden="true"></em>Delete</a>
                                    </div>
                                </td>
                            </tr>
                            <tr>
                                <th scope="row">2</th>
                                <td>Jacob</td>
                                <td>Thornton</td>
                                <td>@fat</td>
                                <td class="d-flex">
                                    <div type="button" class="btn-inner">
                                        <a href="#" class="text-nav btn-update d-flex align-items-center justify-content-center"><em class="fa fa-pencil" aria-hidden="true"></em>Edit</a>
                                    </div>
                                    <div type="button" class="btn-inner">
                                        <a href="#" class="text-nav btn-delete d-flex align-items-center justify-content-center"><em class="fa fa-trash" aria-hidden="true"></em>Delete</a>
                                    </div>
                                </td>
                            </tr>
                            <tr>
                                <th scope="row">3</th>
                                <td>Larry the Bird</td>
                                <td>Thornton</td>
                                <td>@twitter</td>
                                <td class="d-flex">
                                    <div type="button" class="btn-inner">
                                        <a href="#" class="text-nav btn-update d-flex align-items-center justify-content-center"><em class="fa fa-pencil" aria-hidden="true"></em>Edit</a>
                                    </div>
                                    <div type="button" class="btn-inner">
                                        <a href="#" class="text-nav btn-delete d-flex align-items-center justify-content-center"><em class="fa fa-trash" aria-hidden="true"></em>Delete</a>
                                    </div>
                                </td>
                            </tr>
                            <tr>
                                <th scope="row">1</th>
                                <td>Mark</td>
                                <td>Otto</td>
                                <td>@mdo</td>
                                <td class="d-flex">
                                    <div type="button" class="btn-inner">
                                        <a href="#" class="text-nav btn-update d-flex align-items-center justify-content-center"><em class="fa fa-pencil" aria-hidden="true"></em>Edit</a>
                                    </div>
                                    <div type="button" class="btn-inner">
                                        <a href="#" class="text-nav btn-delete d-flex align-items-center justify-content-center"><em class="fa fa-trash" aria-hidden="true"></em>Delete</a>
                                    </div>
                                </td>
                            </tr>
                            <tr>
                                <th scope="row">2</th>
                                <td>Jacob</td>
                                <td>Thornton</td>
                                <td>@fat</td>
                                <td class="d-flex">
                                    <div type="button" class="btn-inner">
                                        <a href="#" class="text-nav btn-update d-flex align-items-center justify-content-center"><em class="fa fa-pencil" aria-hidden="true"></em>Edit</a>
                                    </div>
                                    <div type="button" class="btn-inner">
                                        <a href="#" class="text-nav btn-delete d-flex align-items-center justify-content-center"><em class="fa fa-trash" aria-hidden="true"></em>Delete</a>
                                    </div>
                                </td>
                            </tr>
                            <tr>
                                <th scope="row">3</th>
                                <td>Larry the Bird</td>
                                <td>Thornton</td>
                                <td>@twitter</td>
                                <td class="d-flex">
                                    <div type="button" class="btn-inner">
                                        <a href="#" class="text-nav btn-update d-flex align-items-center justify-content-center"><em class="fa fa-pencil" aria-hidden="true"></em>Edit</a>
                                    </div>
                                    <div type="button" class="btn-inner">
                                        <a href="#" class="text-nav btn-delete d-flex align-items-center justify-content-center"><em class="fa fa-trash" aria-hidden="true"></em>Delete</a>
                                    </div>
                                </td>
                            </tr>
                            <tr>
                                <th scope="row">1</th>
                                <td>Mark</td>
                                <td>Otto</td>
                                <td>@mdo</td>
                                <td class="d-flex">
                                    <div type="button" class="btn-inner">
                                        <a href="#" class="text-nav btn-update d-flex align-items-center justify-content-center"><em class="fa fa-pencil" aria-hidden="true"></em>Edit</a>
                                    </div>
                                    <div type="button" class="btn-inner">
                                        <a href="#" class="text-nav btn-delete d-flex align-items-center justify-content-center"><em class="fa fa-trash" aria-hidden="true"></em>Delete</a>
                                    </div>
                                </td>
                            </tr>
                            <tr>
                                <th scope="row">2</th>
                                <td>Jacob</td>
                                <td>Thornton</td>
                                <td>@fat</td>
                                <td class="d-flex">
                                    <div type="button" class="btn-inner">
                                        <a href="#" class="text-nav btn-update d-flex align-items-center justify-content-center"><em class="fa fa-pencil" aria-hidden="true"></em>Edit</a>
                                    </div>
                                    <div type="button" class="btn-inner">
                                        <a href="#" class="text-nav btn-delete d-flex align-items-center justify-content-center"><em class="fa fa-trash" aria-hidden="true"></em>Delete</a>
                                    </div>
                                </td>
                            </tr>
                            <tr>
                                <th scope="row">3</th>
                                <td>Larry the Bird</td>
                                <td>Thornton</td>
                                <td>@twitter</td>
                                <td class="d-flex">
                                    <div type="button" class="btn-inner">
                                        <a href="#" class="text-nav btn-update d-flex align-items-center justify-content-center"><em class="fa fa-pencil" aria-hidden="true"></em>Edit</a>
                                    </div>
                                    <div type="button" class="btn-inner">
                                        <a href="#" class="text-nav btn-delete d-flex align-items-center justify-content-center"><em class="fa fa-trash" aria-hidden="true"></em>Delete</a>
                                    </div>
                                </td>
                            </tr>
                            <tr>
                                <th scope="row">1</th>
                                <td>Mark</td>
                                <td>Otto</td>
                                <td>@mdo</td>
                                <td class="d-flex">
                                    <div type="button" class="btn-inner">
                                        <a href="#" class="text-nav btn-update d-flex align-items-center justify-content-center"><em class="fa fa-pencil" aria-hidden="true"></em>Edit</a>
                                    </div>
                                    <div type="button" class="btn-inner">
                                        <a href="#" class="text-nav btn-delete d-flex align-items-center justify-content-center"><em class="fa fa-trash" aria-hidden="true"></em>Delete</a>
                                    </div>
                                </td>
                            </tr>
                            <tr>
                                <th scope="row">2</th>
                                <td>Jacob</td>
                                <td>Thornton</td>
                                <td>@fat</td>
                                <td class="d-flex">
                                    <div type="button" class="btn-inner">
                                        <a href="#" class="text-nav btn-update d-flex align-items-center justify-content-center"><em class="fa fa-pencil" aria-hidden="true"></em>Edit</a>
                                    </div>
                                    <div type="button" class="btn-inner">
                                        <a href="#" class="text-nav btn-delete d-flex align-items-center justify-content-center"><em class="fa fa-trash" aria-hidden="true"></em>Delete</a>
                                    </div>
                                </td>
                            </tr>
                            <tr>
                                <th scope="row">3</th>
                                <td>Larry the Bird</td>
                                <td>Thornton</td>
                                <td>@twitter</td>
                                <td class="d-flex">
                                    <div type="button" class="btn-inner">
                                        <a href="#" class="text-nav btn-update d-flex align-items-center justify-content-center"><em class="fa fa-pencil" aria-hidden="true"></em>Edit</a>
                                    </div>
                                    <div type="button" class="btn-inner">
                                        <a href="#" class="text-nav btn-delete d-flex align-items-center justify-content-center"><em class="fa fa-trash" aria-hidden="true"></em>Delete</a>
                                    </div>
                                </td>
                            </tr>
                        </tbody>
                    </table>    
                </div>
            </div>
        </div>
    </section>

    <section class="stock-section">
        <div class="container">
            <div class="row">
                
            </div>
        </div>
    </section>


    <script>
        $(document).ready(function(){
            $('#add_btn').on('click', function(){
                var new_order='';
                new_order+='<tr>';
                new_order+='<td><select id="commodity"  name="commodity" class="form-input" required>';
                new_order+='@if($inventory)';
                new_order+='@foreach($inventory as $inventoryList)';
                new_order+='<option value="{{ $inventoryList-> stock_id }}"> {{ $inventoryList->recyclable }} </option>';
                new_order+='@endforeach';
                new_order+='@endif';
                new_order+='</select></td>';
                new_order+='<td><input type="text" id="amount" name="amount" class="form-input" required></td>';
                new_order+='<td><input type="number" id="tot_price" name="tot_price" min="0.00" max="10000.00" step="0.01" class="form-input" required readonly></td>';
                new_order+='<td class="d-flex justify-content-center align-items-center">';
                new_order+='<button type="button" class="btn btn-danger btn-inner d-flex justify-content-center align-items-center" id="remove_btn"><em class="fa fa-remove" aria-hidden="true"></em></button>'
                new_order+='</td>';
                new_order+='</tr>';
                
                $('#table-order').append(new_order);
            })
        });

        $(document).on('click', '#remove_btn', function(){
            $(this).closest('tr').remove();
        });

        $(document).on('click', '#modal-close', function(){
            $(this).closest('tr').remove();
        });
    </script>

    <script>
        /* $(document).ready(function() {
            $('#commodity').select2();
        }); */
    </script>
@endsection