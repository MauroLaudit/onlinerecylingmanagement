<div class="modal fade" id="ormDeleteStock" data-bs-backdrop="static" data-bs-keyboard="false" tabindex="-1" aria-labelledby="ormDeleteModal" aria-hidden="true">
    <div class="modal-dialog modal-dialog-centered d-flex justify-content-center">
        <div class="modal-content col-lg-auto">
            <div class="modal-body">
            <form action="{{ route('recyclable.destroy', 'inventory_id') }}" method="POST" id="recInventory" class="company-info d-flex row justify-content-between">
                @csrf
                @method('delete')
                <div class="col-md-12 d-flex justify-content-end sticky-top pt-3">
                <input name="inventory_id" id="inventory_id" type="hidden" placeholder="">
                </div>
                <h5>Are you sure you want to delete this?</h5>

                <div class="btn-nav d-flex justify-content-center">
                    <button type="submit" class="btn btn-danger" id="btn-modalRecyclable" style="margin-right: 10px;">Delete Record</button>
                    <button type="button" class="btn btn-outline-danger waves-effect" data-bs-dismiss="modal">Cancel</button>

                </div>
            </form>
            </div>
        </div>
    </div>
</div>