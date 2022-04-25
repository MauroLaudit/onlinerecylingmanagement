@extends('layouts.ormApp')


@push('styles')
    <!-- Style External File -->
    <link href="{{ asset('css/orm-inventory-style.css') }}" rel="stylesheet">
@endpush

@section('content')
    <section class="head-title">
        <div class="container">
            <div class="row d-flex justify-content-center">
                <div class="col-md-8">
                    <div class="title">
                        <h1>Inventory</h1>
                    </div>
                </div>

                <div class="col-md-4 d-flex justify-content-end align-items-center">
                    <div type="button" class="btn-nav d-flex align-items-center justify-content-center" data-bs-toggle="modal" data-bs-target="#ormAddStock">
                        <em class="fa fa-cart-plus" aria-hidden="true"></em> Add Stock
                    </div>
                </div>
            </div>
        </div>
    </section>

    @include('inventory_views.add_inventory')

    <section class="stock-section">
        <div class="container">
            <div class="row">
                <div class="col-md-12 pb-5">
                    <table id="inventoryTable" class="table table-striped table-hover">
                    <thead>
                        <tr>
                            <th scope="col">#</th>
                            <th scope="col">First</th>
                            <th scope="col">Last</th>
                            <th scope="col">Handle</th>
                            <th scope="col"></th>
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

    <script>
        $(document).ready(function(){
            $('#rec-item').on('change', function(){
                var items = $('#rec-item option').val();

                /* alert($(this).val()); */

                if($(this).val() == 'White Paper') {
                    $( "span" ).attr( "data-text", "Used bond paper" );
                }
                else if($(this).val() == 'Cartons') {
                    $( "span" ).attr( "data-text", "Appliance boxes, Packaging boxes" );
                }
                else if($(this).val() == 'Newspaper') {
                    $( "span" ).attr( "data-text", "Newspapers" );
                }
                else if($(this).val() == 'Assorted or Mixed Waste Papers') {
                    $( "span" ).attr( "data-text", "Colored papers, papers with heavy prints & others not falling into the previous 3 categories" );
                }
                else if($(this).val() == 'PET Bottle') {
                    $( "span" ).attr( "data-text", "Mineral water bottle, clear softdrinks bottle" );
                }
                else if($(this).val() == 'Aluminum Cans') {
                    $( "span" ).attr( "data-text", "Softdrink cans" );
                }
                else if($(this).val() == 'Plastic HDPE') {
                    $( "span" ).attr( "data-text", "Food bottles used for vinegar, soy sauce, ketchup, etc." );
                }
                else if($(this).val() == 'Plastic LDPE') {
                    $( "span" ).attr( "data-text", "Ice Cream & Margarine Lids" );
                }
                else if($(this).val() == 'Engineering Plastic ') {
                    $( "span" ).attr( "data-text", "Computer & printer casing " );
                }
                else if($(this).val() == 'Copper Wire') {
                    $( "span" ).attr( "data-text", "Heavy duty wires used in aircons" );
                }
                else if($(this).val() == 'Steel') {
                    $( "span" ).attr( "data-text", "Steel tubes used for plumbing" );
                }
                else if($(this).val() == 'Tin Can') {
                    $( "span" ).attr( "data-text", "Sardine can, corned beef can, etc" );
                }
                else if($(this).val() == 'Liquor Bottle') {
                    $( "span" ).attr( "data-text", "Emperador long neck, Emperador lapad, Ginebra gin, Ketchup, Softdrinks bottle" );
                }
                else if($(this).val() == 'Glass Cullets') {
                    $( "span" ).attr( "data-text", "Broken glass bottles, colorless" );
                }
                else{
                    $( "span" ).attr( "data-text", "Please Choose An Item" );
                }

            })
        });
    </script>
@endsection