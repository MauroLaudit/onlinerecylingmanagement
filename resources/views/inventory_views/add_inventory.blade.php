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
                    <form action="recyclable" method="post" id="recInventory" class="company-info d-flex row justify-content-between">
                        @csrf
                        <div class="inner-form mb-3">
                            <label for="stock_category">Category:</label>
                            <input type="text" id="stock_category" name="stock_category" class="form-input" placeholder="" required readonly>
                            <input type="text" id="rcID" name="rc_id" class="form-input transac_id" placeholder="0000" required readonly hidden>
                            <input type="text" id="stockDate" name="stockDate" class="form-input" required readonly>
                        </div>
                        <div class="inner-form mb-3">
                            <div class="item-selection d-flex align-items-center">
                                <label for="rec-item">Recyclable Commodity:</label>
                                <span id="selected-item" class="option-viewer ps-2 m-0" data-text="Please Choose An Item"><em class="fa fa-question-circle-o" aria-hidden="true"></em></span>
                            </div>
                            <select class="select-form" id="rec_item" name="rec_item" required>
                                <option selected>Choose Recyclable Item</option>
                                <option value="White Paper">White Paper</option>
                                <option value="Cartons">Cartons</option>
                                <option value="Newspaper">Newspaper</option>
                                <option value="Assorted or Mixed Waste Papers">Assorted or Mixed Waste Papers</option>
                                <option value="PET Bottle">PET Bottle</option>
                                <option value="Plastic HDPE">Plastic HDPE</option>
                                <option value="Plastic LDPE">Plastic LDPE</option>
                                <option value="Copper Wire A (red color)">Copper Wire A (red color)</option>
                                <option value="Copper Wire B (reddish yellow)">Copper Wire B (reddish yellow)</option>
                                <option value="Copper Wire C (Thin yellow strands)">Copper Wire C (Thin yellow strands)</option>
                                <option value="Steel">Steel</option>
                                <option value="Tin Cans">Tin Cans</option>
                                <option value="Aluminum Cans">Aluminum Cans</option>
                                <option value="Emperador (Long Neck)">Emperador (Long Neck)</option>
                                <option value="Emperador (Lapad)">Emperador (Lapad)</option>
                                <option value="Gin">Gin</option>
                                <option value="Ketchup">Ketchup</option>
                                <option value="Softdrinks Bottle">Softdrinks Bottle</option>
                            </select>
                        </div>
                        <div class="inner-form mb-3">
                            <label for="amount">Amount:</label>
                            <input type="number" id="amount" name="amount" class="form-input " placeholder="" autocomplete="off" required>
                        </div>
                        <div class="inner-form mb-3">
                            <label for="price">Price:</label>
                            <input type="number" id="price" name="price" min="0.00" max="10000.00" step="0.01" class="form-input" placeholder="per kilo" autocomplete="off" required>
                        </div>
                        <div class="btn-nav d-flex justify-content-center">
                            <button type="submit" class="btn btn-primary" id="btn-modalRecyclable">Add Record</button>
                        </div>
                    </form>
                </div>
            </div>
        </div>
    </div>
</div>