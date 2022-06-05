<!-- Modal -->
<div class="modal fade" id="ormViewOrders" data-bs-backdrop="static" data-bs-keyboard="false" tabindex="-1" aria-labelledby="ormViewOrdersModal" aria-hidden="true">
    <div class="modal-dialog modal-dialog-centered d-flex justify-content-center">
        <div class="modal-content col-lg-auto">
            <div class="modal-body">
                <div class="col-md-12 d-flex justify-content-end sticky-top pt-3">
                    <button type="button" id="modal-close" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
                </div>
                    <div class="company-order">
                        <h4>Orders</h4>
                        <div class="order">
                        <input type="text" id="transactID" name="transactID" class="form-input transac_id" readonly>
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



