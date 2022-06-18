<!-- Modal -->
<div class="modal fade" id="ormAddForecast" data-bs-backdrop="static" data-bs-keyboard="false" tabindex="-1" aria-labelledby="ormAddForecast" aria-hidden="true">
    <div class="modal-dialog modal-dialog-centered d-flex justify-content-center">
        <div class="modal-content col-lg-12">
            <div class="modal-body">
                <!-- <hr>
                <h4>Company Information</h4>
                <hr> -->
                <div class="col-md-12 d-flex justify-content-end sticky-top pt-1">
                    <button type="button" id="modal-close" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
                </div>
                <div class="col-12 d-flex justify-content-center">
                    <form action="forecast" method="post" id="recForecast" class="company-info d-flex row justify-content-between">
                        @csrf
                        <div class="inner-form mb-3 d-flex">
                            <input type="text" name="forecast_type" id="forecast-type" required hidden>
                            <input type="month" name="forecast_month" id="forecast-month" required>
                            <select class="select-form" id="modal_category" name="modal_category" required>
                                <option selected>Choose Recyclable Category</option>
                                <option value="Paper">Paper</option>
                                <option value="Plastic">Plastic</option>
                                <option value="Metal">Metal</option>
                                <option value="Glass">Glass</option>
                            </select>
                        </div>
                        <table id="forecast_tbl" class="table table-striped table-bordered">
                            <thead>
                                <tr>
                                    <th scope="col">Year</th>
                                    <th scope="col">Month</th>
                                    <th scope="col">Total</th>
                                    <th scope="col">
                                        <!-- <button type="button" class="btn btn-success btn-inner d-flex justify-content-center align-items-center" id="add_btn">
                                            <em class="fa fa-plus" aria-hidden="true"></em>
                                        </button> -->
                                    </th>
                                </tr>
                            </thead>
                            <tbody id="table-forecast">
                                <tr id="row_new_forecast">
                                    <td>
                                        <select name="year" class="js-example-basic-single yearList" required>
                                        <option></option>
                                        </select>
                                    </td>
                                    <td>
                                        <select name="month" class="js-example-basic-single monthList" required>
                                        <option></option>
                                        </select>
                                    </td>
                                    <td><input type="number" name="totalSupply[]" class="form-input totalSupply" required readonly></td>
                                    <td class="d-flex justify-content-center align-items-center">
                                    <button type="button" class="btn btn-danger btn-inner d-flex justify-content-center align-items-center" id="remove_btn"><em class="fa fa-remove" aria-hidden="true"></em></button>
                                    </td>
                                </tr>
                            </tbody>
                            <tfoot>
                                <tr>
                                    <td></td>
                                    <td></td>
                                    <td></td>
                                    <td class="d-flex justify-content-center align-items-center">
                                        <button type="button" class="btn btn-success btn-inner d-flex justify-content-center align-items-center" id="add_btn">
                                            <em class="fa fa-plus" aria-hidden="true"></em>
                                        </button></td>
                                </tr>
                            </tfoot>
                        </table>
                        <div class="d-flex justify-content-center">
                            <button type="submit" class="btn_forecast">FORECAST</button>
                        </div>
                        
                    </form>
                </div>
            </div>
        </div>
    </div>
</div>