<!-- Modal -->
<div class="modal fade" id="ormAddOrder" data-bs-backdrop="static" data-bs-keyboard="false" tabindex="-1" aria-labelledby="ormAddOrderModal" aria-hidden="true">
    <div class="modal-dialog modal-dialog-centered d-flex justify-content-center">
        <div class="modal-content col-lg-auto">
            <div class="modal-body">
                <!-- <hr>
                <h4>Company Information</h4>
                <hr> -->
                <div class="col-md-12 d-flex justify-content-end sticky-top pt-3">
                    <button type="button" id="modal-close" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
                </div>
                <form action="client_transactions" method="post" id="formid">
                    @csrf
                    <div class="col-12 d-flex justify-content-center">
                        <div action="" class="company-info d-flex row justify-content-between">
                            <div class="inner-form mb-3 d-flex justify-content-between align-items-center">
                                <label for="transaction_id" class="fw-bold">Transaction ID:</label>
                                <input type="text" id="transaction_id" name="transaction_id" class="form-input transac_id" placeholder="0000" readonly required>
                            </div>
                            <div class="inner-form mb-3 d-flex justify-content-between align-items-center">
                                <label for="company_name">Company Name:</label>
                                <input type="text" id="company_name" name="company_name" class="form-input " placeholder="Company Name" autocomplete="on" required hiddem>
                            </div>
                            <div class="inner-form mb-3 d-flex justify-content-between align-items-center">
                                <label for="client_name">Client Name:</label>
                                <input type="text" id="client_name" name="client_name" class="form-input " placeholder="Lastname, Firstname M.I." autocomplete="off" required>
                            </div>
                            <div class="inner-form mb-3 d-flex justify-content-between align-items-center">
                                <label for="address">Address:</label>
                                <input type="text" id="address" name="address" class="form-input " placeholder="Address" autocomplete="off" required>
                            </div>
                            <div class="inner-form mb-3 d-flex justify-content-between align-items-center">
                                <label for="contact">Contact No.:</label>
                                <input type="number" id="contact" name="contact" class="form-input" placeholder="09---------" autocomplete="off" inputmode="numeric" required>
                            </div>
                        </div>
                    </div>
                    <hr>
                    <div class="company-order col-12">
                        <h4>Orders</h4>
                        <div class="order">
                            <table id="order_tbl" class="table table-striped table-bordered">
                                <thead>
                                    <tr>
                                        <th scope="col">Commodity</th>
                                        <th scope="col">Quantity</th>
                                        <th scope="col">Total Price</th>
                                        <th scope="col">
                                            <button type="button" class="btn btn-success btn-inner d-flex justify-content-center align-items-center" id="add_btn">
                                                <em class="fa fa-plus" aria-hidden="true"></em>
                                            </button>
                                        </th>
                                    </tr>
                                </thead>
                                <tbody id="table-order">
                                    <tr id="row_new_orders">
                                        <td>
                                            <select name="commodity[]" class="js-example-basic-single itemList" required>
                                            <option selected>-- Choose item --</option>
                                            </select>
                                        </td>
                                        <td><input type="number" name="quantity[]" class="form-input itemQuantity" required></td>
                                        <td><input type="number" name="tot_price[]" min="0.00" max="10000.00" step="0.01" class="form-input itemPrice" required></td>
                                        <td class="d-flex justify-content-center align-items-center">
                                        <button type="button" class="btn btn-danger btn-inner d-flex justify-content-center align-items-center" id="remove_btn"><em class="fa fa-remove" aria-hidden="true"></em></button>
                                        </td>
                                    </tr>
                                </tbody>
                                <tfoot>

                                </tfoot>
                            </table>

                            <div class="btn-nav d-flex justify-content-center">
                                <button type="submit" class="btn btn-primary" id="btn-add-new">Order</button>
                            </div>
                        </div>
                    </div>
                </form>
                
            </div>
        </div>
    </div>
</div>

