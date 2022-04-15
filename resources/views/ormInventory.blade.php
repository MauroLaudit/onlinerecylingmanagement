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

    <!-- Modal -->
    <div class="modal fade" id="ormAddStock" data-bs-backdrop="static" data-bs-keyboard="false" tabindex="-1" aria-labelledby="ormAddOrderModal" aria-hidden="true">
        <div class="modal-dialog modal-dialog-centered d-flex justify-content-center">
            <div class="modal-content col-lg-auto">
                <div class="modal-body">
                    <!-- <hr>
                    <h4>Company Information</h4>
                    <hr> -->
                    <div class="col-md-12 d-flex justify-content-end sticky-top pt-3">
                        <button type="button" id="modal-close" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
                    </div>
                    <div class="col-12 d-flex justify-content-center">
                        <form action="" class="company-info d-flex row justify-content-between">
                            <div class="inner-form mb-3">
                                <label for="fname">Stock ID:</label>
                                <input type="text" id="tr-id" name="tr-id" class="form-input transac_id" placeholder="0000" required>
                            </div>
                            <div class="inner-form mb-3">
                                <div class="item-selection d-flex align-items-center">
                                    <label for="fname">Recyclable Commodity:</label>
                                    <span class="option-viewer ps-2" data-text="Please Choose An Item"><em class="fa fa-question-circle-o" aria-hidden="true"></em></span>
                                </div>
                                <select class="select-form" id="rec-item" aria-label="Default select example" required>
                                    <option selected>Choose Recyclable Item</option>
                                    <option class="option-tooltip" data-text="Used Bond Paper" value="White Paper">White Paper</option>
                                    <option value="Cartons">Cartons</option>
                                    <option value="Newspaper">Newspaper</option>
                                    <option value="Assorted or Mixed Waste Papers">Assorted or Mixed Waste Papers</option>
                                    <option value="PET Bottle">PET Bottle</option>
                                    <option value="Aluminum Cans">Aluminum Cans</option>
                                    <option value="Plastic HDPE">Plastic HDPE</option>
                                    <option value="Plastic LDPE">Plastic LDPE</option>
                                    <option value="Engineering Plastics">Engineering Plastics</option>
                                    <option value="Copper Wire">Copper Wire</option>
                                    <option value="Steel">Steel</option>
                                    <option value="Tin Can">Tin Can</option>
                                    <option value="Liquor Bottle">Liquor Bottle</option>
                                    <option value="Glass Cullets">Glass Cullets (Bubog)</option>
                                </select>
                            </div>
                            <div class="inner-form mb-3">
                                <label for="fname">Amount (Weight):</label>
                                <input type="number" id="amount" name="amount" class="form-input " placeholder="per kilo" autocomplete="off" required>
                            </div>
                            <div class="inner-form mb-3">
                                <label for="fname">Price:</label>
                                <input type="number" id="price" name="price" class="form-input " placeholder="per kilo" autocomplete="off" required>
                            </div>
                            <div class="btn-nav d-flex justify-content-center">
                                <button type="submit" class="btn btn-primary">Add Record</button>
                            </div>
                        </form>
                    </div>
                </div>
            </div>
        </div>
    </div>

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