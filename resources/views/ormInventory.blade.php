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
                            <div class="inner-form mb-3 d-flex justify-content-between align-items-center">
                                <label for="fname" class="fw-bold">Stock ID:</label>
                                <input type="text" id="tr-id" name="tr-id" class="form-input transac_id" placeholder="0000" required>
                            </div>
                            <div class="inner-form mb-3 d-flex justify-content-between align-items-center">
                                <label for="fname">Recyclable Commodity:</label>
                                <div class="item-selection">
                                    <select class="form-select" aria-label="Default select example" required>
                                        <option selected>Choose Recyclable Items</option>
                                        <option value="1">One</option>
                                        <option value="2">Two</option>
                                        <option value="3">Three</option>
                                    </select>
                                    <span type="button"><em class="fa fa-question-circle-o" aria-hidden="true"></em></span>
                                </div>
                            </div>
                            <div class="inner-form mb-3 d-flex justify-content-between align-items-center">
                                <label for="fname">Client Name:</label>
                                <input type="text" id="fname" name="fname" class="form-input " placeholder="Lastname, Firstname M.I." autocomplete="off" required>
                            </div>
                            <div class="inner-form mb-3 d-flex justify-content-between align-items-center">
                                <label for="fname">Address:</label>
                                <input type="text" id="fname" name="fname" class="form-input " placeholder="Address" autocomplete="off" required>
                            </div>
                            <div class="inner-form mb-3 d-flex justify-content-between align-items-center">
                                <label for="fname">Contact No.:</label>
                                <input type="tel" id="fname" name="fname" class="form-input " placeholder="09 ---- -----" autocomplete="off" maxlength="11" required>
                            </div>
                            <div class="btn-nav d-flex justify-content-center">
                                <button type="submit" class="btn btn-primary">Add Record</button>
                            </div>
                        </form>
                    </div>
                    <hr>
                    <div class="company-order col-12">
                        <h4>Orders</h4>
                        <form action="">
                            <table id="" class="table">
                                <thead>
                                    <tr>
                                        <th scope="col">Commodity</th>
                                        <th scope="col">Amount (per kl)</th>
                                        <th scope="col">Action</th>
                                    </tr>
                                </thead>
                                <tbody id="table-order">
                                    <tr>
                                        <!-- <th scope="row">1</th> -->
                                        <td><input type="text" id="commodity" name="commodity" class="form-input" required></td>
                                        <td><input type="text" id="amount" name="amount" class="form-input" required></td>
                                        <td class="d-flex justify-content-center align-items-center">
                                            <button type="button" class="btn btn-success btn-inner d-flex justify-content-center align-items-center" id="add_btn">
                                                <em class="fa fa-plus" aria-hidden="true"></em>
                                            </button>
                                        </td>
                                    </tr>
                                </tbody>
                            </table>

                            <div class="btn-nav d-flex justify-content-center">
                                <button type="submit" class="btn btn-primary">Order</button>
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
@endsection