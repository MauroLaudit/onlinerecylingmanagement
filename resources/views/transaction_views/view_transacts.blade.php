<!-- Modal -->
<div class="modal fade" id="ormViewOrders" data-bs-backdrop="static" data-bs-keyboard="false" tabindex="-1" aria-labelledby="ormViewOrdersModal" aria-hidden="true">
    <div class="modal-dialog modal-dialog-centered d-flex justify-content-center">
        <div class="modal-content col-lg-auto">
            <div class="modal-body">
                <div class="col-md-12 d-flex justify-content-end sticky-top pt-3">
                    <button type="button" id="modal-close" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
                </div>
                <div class="company-details m-3 col-10">
                    <div class="inner-form mb-3 d-flex justify-content-between align-items-center">
                        <label for="view_companyName" class="fw-400">Company:</label>
                        <input type="text" id="view_companyName" name="view_companyName" class="view-input" readonly>
                    </div>
                    <div class="inner-form mb-3 d-flex justify-content-between align-items-center">
                        <label for="view_clientName" class="fw-400">Client Name:</label>
                        <input type="text" id="view_clientName" name="view_clientName" class="view-input" readonly>
                    </div>
                    <div class="inner-form mb-3 d-flex justify-content-between align-items-center">
                        <label for="view_address" class="fw-400">Address:</label>
                        <input type="text" id="view_address" name="view_address" class="view-input" readonly>
                    </div>
                    <div class="inner-form mb-3 d-flex justify-content-between align-items-center">
                        <label for="view_contact" class="fw-400">Contact Number:</label>
                        <input type="text" id="view_contact" name="view_contact" class="view-input" readonly>
                    </div>
                </div>
                <div class="company-order m-3">
                    <h4>Orders</h4>
                    <div class="order">
                        <input type="text" id="transactID" name="transactID" class="form-input transac_id" readonly hidden>
                        
                        <table id="viewOrders" class="table table-striped table-bordered">
                            <thead>
                                <tr>
                                    <th scope="col">id</th>
                                    <th scope="col">Commodity</th>
                                    <th scope="col">Quantity</th>
                                    <th scope="col">Total Price</th>
                                </tr>
                            </thead>
                            <tbody id="orderList">
                            </tbody>
                        </table>
                    </div>
                </div>

                
            </div>
        </div>
    </div>
</div>



