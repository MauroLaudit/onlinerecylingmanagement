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
                <div class="col-12 d-flex justify-content-center">
                    <form action="" class="company-info d-flex row justify-content-between">
                        <div class="inner-form mb-3 d-flex justify-content-between align-items-center">
                            <label for="transaction_id" class="fw-bold">Transaction ID:</label>
                            <input type="text" id="transaction_id" name="transaction_id" class="form-input transac_id" placeholder="0000" required>
                        </div>
                        <div class="inner-form mb-3 d-flex justify-content-between align-items-center">
                            <label for="company_name">Company Name:</label>
                            <input type="text" id="company_name" name="company_name" class="form-input " placeholder="Company Name" autocomplete="off" required>
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
                            <input type="number" id="contact" name="contact" class="form-input " placeholder="09 ---- -----" autocomplete="off" maxlength="11" required>
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
                                    <th scope="col">Total Price</th>
                                    <th scope="col">Action</th>
                                </tr>
                            </thead>
                            <tbody id="table-order">
                                <tr>
                                    <!-- <th scope="row">1</th> -->
                                    <td>
                                        <!-- <input type="text" id="commodity" name="commodity" class="form-input" required> -->
                                        <select id="commodity"  name="commodity" class="form-input" required>
                                        @if($inventory)
                                        @foreach($inventory as $inventoryList)
                                            <option value="{{ $inventoryList-> stock_id }}"> {{ $inventoryList->recyclable }} </option>
                                        @endforeach
                                        @endif
                                        </select>
                                    </td>
                                    <td><input type="number" id="amount" name="amount" class="form-input" required></td>
                                    <td><input type="number" id="tot_price" name="tot_price" min="0.00" max="10000.00" step="0.01" class="form-input" required readonly></td>
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