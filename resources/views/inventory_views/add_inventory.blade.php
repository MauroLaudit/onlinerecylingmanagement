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
                            <input type="text" id="rc-id" name="rc-id" class="form-input transac_id" placeholder="0000" required>
                        </div>
                        <div class="inner-form mb-3">
                            <div class="item-selection d-flex align-items-center">
                                <label for="rec-item">Recyclable Commodity:</label>
                                <span class="option-viewer ps-2 m-0" data-text="Please Choose An Item"><em class="fa fa-question-circle-o" aria-hidden="true"></em></span>
                            </div>
                            <select class="select-form" id="rec-item" name="rec-item" aria-label="Default select example" required>
                                <option selected>Choose Recyclable Item</option>
                                <option value="White Paper">White Paper</option>
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
                            <label for="amount">Amount (Weight):</label>
                            <input type="number" id="amount" name="amount" class="form-input " placeholder="per kilo" autocomplete="off" required>
                        </div>
                        <div class="inner-form mb-3">
                            <label for="price">Price:</label>
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