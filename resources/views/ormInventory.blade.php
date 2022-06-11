@extends('layouts.ormApp')


@push('styles')
    <!-- Style External File -->
    <link href="{{ asset('css/orm-inventory-style.css') }}" rel="stylesheet">

@endpush

@section('content')
    <section class="head-title sticky-top">
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
                    <table id="inventoryTable" class="table table-striped table-bordered pt-3">
                    <thead>
                        <tr>
                            <th scope="col">ID</th>
                            <th scope="col">Category</th>
                            <th scope="col">Recyclable</th>
                            <th scope="col">Amount</th>
                            <th scope="col">Price</th>
                            <!-- <th scope="col">Actions</th> -->
                        </tr>
                    </thead>
                    <tbody>
                        @if($inventory)
                        @foreach($inventory as $inventoryList)
                        <tr>
                            <th data-label="ID" scope="row">{{ $inventoryList->id }}</th>
                            <td data-label="Category_ID">{{ $inventoryList->category }}</td>
                            <td data-label="Recyclables">{{ $inventoryList->recyclable }}</td>
                            <td data-label="Amount">
                                @if($inventoryList->category == "Glass")
                                    {{ $inventoryList->amount }} pc
                                @else
                                    {{ $inventoryList->amount }} kg
                                @endif
                            </td>
                            <td data-label="Price">Php {{ $inventoryList->price }}</td>
                            
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
                    $('#stock_category').val("Paper");
                    item_type = "Paper";
                }
                else if($(this).val() == 'Cartons') {
                    $( "span" ).attr( "data-text", "Appliance boxes, Packaging boxes" );
                    $('#stock_category').val("Paper");
                    $('#stock_category').val("Paper");
                    item_type = "Paper";
                }
                else if($(this).val() == 'Newspaper') {
                    $( "span" ).attr( "data-text", "Newspapers" );
                    $('#stock_category').val("Paper");
                    item_type = "Paper";
                }
                else if($(this).val() == 'Assorted or Mixed Waste Papers') {
                    $( "span" ).attr( "data-text", "Colored papers, papers with heavy prints & others not falling into the previous 3 categories" );
                    $('#stock_category').val("Paper");
                    item_type = "Paper";
                }
                else if($(this).val() == 'PET Bottle') {
                    $( "span" ).attr( "data-text", "Mineral water bottle, clear softdrinks bottle" );
                    $('#stock_category').val("Plastic");
                    item_type = "Plastic";
                }
                else if($(this).val() == 'Plastic HDPE') {
                    $( "span" ).attr( "data-text", "Food bottles used for vinegar, soy sauce, ketchup, etc." );
                    $('#stock_category').val("Plastic");
                    item_type = "Plastic";
                }
                else if($(this).val() == 'Plastic LDPE') {
                    $( "span" ).attr( "data-text", "Ice Cream & Margarine Lids" );
                    $('#stock_category').val("Plastic");
                    item_type = "Plastic";
                }
                else if($(this).val() == 'Copper Wire A (red color)') {
                    $( "span" ).attr( "data-text", "Heavy duty wires used in aircons" );
                    $('#stock_category').val("Metal");
                    item_type = "Metal";
                }
                else if($(this).val() == 'Copper Wire B (reddish yellow)') {
                    $( "span" ).attr( "data-text", "Ordinary wire used in extension cords" );
                    $('#stock_category').val("Metal");
                    item_type = "Metal";
                }
                else if($(this).val() == 'Copper Wire C (Thin yellow strands)') {
                    $( "span" ).attr( "data-text", "Wire used in Christmas lights" );
                    $('#stock_category').val("Metal");
                    item_type = "Metal";
                }
                else if($(this).val() == 'Steel') {
                    $( "span" ).attr( "data-text", "Steel tubes used for plumbing" );
                    $('#stock_category').val("Metal");
                    item_type = "Metal";
                }
                else if($(this).val() == 'Tin Cans') {
                    $( "span" ).attr( "data-text", "Sardine can, corned beef can, etc" );
                    $('#stock_category').val("Metal");
                    item_type = "Metal";
                }
                else if($(this).val() == 'Aluminum Cans') {
                    $( "span" ).attr( "data-text", "Softdrink cans" );
                    $('#stock_category').val("Metal");
                    item_type = "Metal";
                }
                else if($(this).val() == 'Emperador (Long Neck)') {
                    $( "span" ).attr( "data-text", "Liquor Bottles" );
                    $('#stock_category').val("Glass");
                    item_type = "Glass";
                }
                else if($(this).val() == 'Emperador (Lapad)') {
                    $( "span" ).attr( "data-text", "Liquor Bottles" );
                    $('#stock_category').val("Glass");
                    item_type = "Glass";
                }
                else if($(this).val() == 'Gin') {
                    $( "span" ).attr( "data-text", "Liquor Bottles" );
                    $('#stock_category').val("Glass");
                    item_type = "Glass";
                }
                else if($(this).val() == 'Ketchup') {
                    $( "span" ).attr( "data-text", "Bottles" );
                    $('#stock_category').val("Glass");
                    item_type = "Glass";
                }
                else if($(this).val() == 'Softdrinks Bottle') {
                    $( "span" ).attr( "data-text", "Bottles" );
                    $('#stock_category').val("Glass");
                    item_type = "Glass";
                }
                else{
                    $( "span" ).attr( "data-text", "Please Choose An Item" ); 
                    item_type = "none";
                }
                
                var stockID = "";

                var d = new Date();
                var strDate = (d.getMonth()+1) + "" + d.getDate() + "" + d.getFullYear();
                var getCurrentDate = d.getFullYear() + "/" + (d.getMonth()+1) + "/" + d.getDate();

                var sc_type = "";

                if(item_type=="Paper"){
                    $( '#price' ).attr( "placeholder", "per kilo" );
                    sc_type="PPR";
                }
                else if(item_type=="Plastic"){
                    $( '#price' ).attr( "placeholder", "per kilo" );
                    sc_type="PSC";
                }
                else if(item_type=="Metal"){
                    $( '#price' ).attr( "placeholder", "per kilo" );
                    sc_type="MTL";
                }
                else if(item_type=="Glass"){
                    $( '#price' ).attr( "placeholder", "per piece" );
                    sc_type="GLS";
                }
                /* else{
                    sc_type="none";
                } */
                
                stockID = sc_type + "-" + strDate + "-" + Math.floor((Math.random() * 9999) + 1);
                

                $('form #rcID').val(stockID);
                /* alert($('#rcID').val()); */
                $('form #stockDate').val(getCurrentDate);
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