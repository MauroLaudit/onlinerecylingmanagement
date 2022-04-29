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
                    <div type="button" id="btn_addStock" class="btn-nav d-flex align-items-center justify-content-center" data-bs-toggle="modal" data-bs-target="#ormAddStock">
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
                    <table id="inventoryTable" class="table table-striped table-hover table-bordered pt-3">
                    <thead>
                        <tr>
                            <th scope="col">ID</th>
                            <th scope="col">Stock ID</th>
                            <th scope="col">Commodity</th>
                            <th scope="col">Amount</th>
                            <th scope="col">Price</th>
                            <th scope="col">Actions</th>
                        </tr>
                    </thead>
                    <tbody>
                        @if($inventory)
                        @foreach($inventory as $inventoryList)
                        <tr>
                            <th data-label="ID" scope="row">{{ $inventoryList->id }}</th>
                            <td data-label="Category_ID">{{ $inventoryList->stock_id }}</td>
                            <td data-label="Recyclables">{{ $inventoryList->recyclable }}</td>
                            <td data-label="Amount">{{ $inventoryList->amount }} kg</td>
                            <td data-label="Price">Php {{ $inventoryList->price }}</td>
                            <td class="d-flex">
                                <div type="button" class="btn-inner">
                                    <!-- <a href="#" class="text-nav btn-update d-flex align-items-center justify-content-center"><em class="fa fa-pencil" aria-hidden="true"></em>Edit</a> -->
                                    {{-----***************************** EDIT BUTTON *******************************------}}
                                    <a data-bs-toggle="modal" type="button"
                                    data-id="{{$inventoryList->id}}" data-category_id="{{ $inventoryList->stock_id }}" data-recyclables="{{ $inventoryList->recyclable }}"
                                    data-amount="{{$inventoryList->amount}}" data-price="{{$inventoryList->price}}" 
                                    data-bs-target="#ormUpdateStock" class="text-nav btn-update d-flex align-items-center justify-content-center">
                                        <em class="fa fa-pencil" aria-hidden="true"></em>Edit
                                    </a>
                                    @include('inventory_views.update_inventory')
                                </div>
                                <div type="button" class="btn-inner">
                                    {{-----***************************** DELETE BUTTON *******************************------}}
                                    <a href="#" type="button" 
                                    data-bs-toggle="modal" data-id="{{$inventoryList->id}}"
                                    data-bs-target="#ormDeleteStock"
                                    class="text-nav btn-delete d-flex align-items-center justify-content-center">
                                    <em class="fa fa-trash" aria-hidden="true"></em>Delete</a>
                                    @include('inventory_views.delete_inventory')
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

    <script>
        var item_type = "";
        $(document).ready(function(){
            $('#rec_item').on('change', function(){
                if($(this).val() == 'White Paper') {
                    $( "span" ).attr( "data-text", "Used bond paper" );
                    item_type = "Paper";
                }
                else if($(this).val() == 'Cartons') {
                    $( "span" ).attr( "data-text", "Appliance boxes, Packaging boxes" );
                    item_type = "Paper";
                }
                else if($(this).val() == 'Newspaper') {
                    $( "span" ).attr( "data-text", "Newspapers" );
                    item_type = "Paper";
                }
                else if($(this).val() == 'Assorted or Mixed Waste Papers') {
                    $( "span" ).attr( "data-text", "Colored papers, papers with heavy prints & others not falling into the previous 3 categories" );
                    item_type = "Paper";
                }
                else if($(this).val() == 'PET Bottle') {
                    $( "span" ).attr( "data-text", "Mineral water bottle, clear softdrinks bottle" );
                    item_type = "Plastic";
                }
                else if($(this).val() == 'Aluminum Cans') {
                    $( "span" ).attr( "data-text", "Softdrink cans" );
                    item_type = "Plastic";
                }
                else if($(this).val() == 'Plastic HDPE') {
                    $( "span" ).attr( "data-text", "Food bottles used for vinegar, soy sauce, ketchup, etc." );
                    item_type = "Plastic";
                }
                else if($(this).val() == 'Plastic LDPE') {
                    $( "span" ).attr( "data-text", "Ice Cream & Margarine Lids" );
                    item_type = "Plastic";
                }
                else if($(this).val() == 'Engineering Plastic ') {
                    $( "span" ).attr( "data-text", "Computer & printer casing " );
                    item_type = "Plastic";
                }
                else if($(this).val() == 'Copper Wire') {
                    $( "span" ).attr( "data-text", "Heavy duty wires used in aircons" );
                    item_type = "Metal";
                }
                else if($(this).val() == 'Steel') {
                    $( "span" ).attr( "data-text", "Steel tubes used for plumbing" );
                    item_type = "Metal";
                }
                else if($(this).val() == 'Tin Can') {
                    $( "span" ).attr( "data-text", "Sardine can, corned beef can, etc" );
                    item_type = "Metal";
                }
                else if($(this).val() == 'Liquor Bottle') {
                    $( "span" ).attr( "data-text", "Emperador long neck, Emperador lapad, Ginebra gin, Ketchup, Softdrinks bottle" );
                    item_type = "Glass";
                }
                else if($(this).val() == 'Glass Cullets') {
                    $( "span" ).attr( "data-text", "Broken glass bottles, colorless" );
                    item_type = "Glass";
                }
                else{
                    $( "span" ).attr( "data-text", "Please Choose An Item" ); 
                    item_type = "none";
                }
                
                var stockID = "";

                var d = new Date();
                var strDate = (d.getMonth()+1) + "" + d.getDate() + "" + d.getFullYear();

                var sc_type = "";

                if(item_type=="Paper"){
                    sc_type="PPR";
                }
                else if(item_type=="Plastic"){
                    sc_type="PSC";
                }
                else if(item_type=="Metal"){
                    sc_type="MTL";
                }
                else if(item_type=="Glass"){
                    sc_type="GLS";
                }
                /* else{
                    sc_type="none";
                } */
                
                stockID = sc_type + "-" + strDate + "-" + Math.floor((Math.random() * 9999) + 1);
                

                $('form #rcID').val(stockID);
                /* alert($('#rcID').val()); */
            })
            
        });
    </script>

    <!-- Clear All Input After Closing The Modal -->
    <script>
        $('#btn_addStock').on('click', function () {
            $('#ormAddStock form')[0].reset();
        });

        $('#signupModal'). on('hidden.bs.modal', function () {
            $('#ormAddStock form')[0].reset();
        });
    </script>

    <!-- Update_Inventory -->
    <script>    
        $('#ormUpdateStock').on('show.bs.modal', function(event) {
            var button = $(event.relatedTarget)
            var id = button.data('id')
            var category_id = button.data('category_id')
            var recyclables = button.data('recyclables')
            var amount = button.data('amount')
            var price = button.data('price')
            

            var modal = $(this)
            /* modal.find('.modal-title').text('View Resident Profile'); */
            modal.find('.modal-body #inventory_id').val(id);
            modal.find('.modal-body #rc_id').val(category_id);
            modal.find('.modal-body #rec_item').val(recyclables);
            modal.find('.modal-body #amount').val(amount);
            modal.find('.modal-body #price').val(price);
        })
    </script>

    <!-- Delete_Inventory -->
    <script>    
        $('#ormDeleteStock').on('show.bs.modal', function(event) {
            var button = $(event.relatedTarget)
            var id = button.data('id')            

            var modal = $(this)
            modal.find('.modal-body #inventory_id').val(id);
        })
    </script>

@endsection