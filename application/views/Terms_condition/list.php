<style>
    .modal-lg {
    max-width: 80%;
}
</style>
<!--**********************************
            Content body start
        ***********************************-->
        <div class="content-body">
            <div class="container-fluid">
				

                <!-- ============================================
                     TERMS AND CONDITION LIST PAGE
                ============================================ -->
                <div class="row">

                    <div class="col-12">

                        <div class="card">

                            <!-- HEADER -->
                            <div class="card-header d-flex justify-content-between align-items-center">

                                <h4 class="card-title mb-0">
                                    Terms & Condition Details
                                </h4>

                               

                                <?php if (has_permission('TERMS_AND_CONDITIONS_CREATE')): ?>
                                         <!-- ADD NEW BUTTON -->
                                <button type="button"
                                        onclick="add_terms_condition()"
                                        class="btn btn-rounded btn-secondary btn-md">
                                    + New Terms & Condition
                                </button>
                                <?php endif; ?>

                            </div>


                            <!-- BODY -->
                            <div class="card-body">

                                <!-- FLASH MESSAGE -->
                                <div id="flash_message"></div>

                                <!-- ============================================
                                     SEARCH + RESET FILTERS
                                     Add this ABOVE the table inside card-body
                                ============================================ -->
                                <div class="row mb-3">

                                    <!-- SEARCH BY POLICY NAME -->
                                    <!-- <div class="col-md-4">
                                        <input type="text"
                                               id="terms_condition_name_filter"
                                               class="form-control"
                                               placeholder="Search Terms & Condition Name">
                                    </div>

                                     BUTTONS 
                                    <div class="col-md-4">

                                        <button type="button"
                                                class="btn btn-primary"
                                                onclick="search_payment_policies()">
                                            Search
                                        </button>

                                        <button type="button"
                                                class="btn btn-secondary"
                                                onclick="reset_filters()">
                                            Reset
                                        </button>

                                    </div>

                                </div> -->


                                <!-- TABLE -->
                                <div class="table-responsive">

                                    <table id="Terms_Condition_table"
                                           class="display table table-bordered table-striped"
                                           style="width:100%">

                                        <thead>
                                            <tr>
                                                <th style="width:5%;">Sl.No</th>
                                                <th style="width:25%;">Terms Name</th>
                                                <!-- <th style="width:25%;">Created By</th> -->
                                                <th style="width:5%;">Action</th>
                                            </tr>
                                        </thead>

                                        <tbody></tbody>

                                    </table>

                                </div>

                            </div>

                        </div>

                    </div>

                </div>
            </div>
        </div>
        <!--**********************************
            Content body end
        ***********************************-->



        <!-- ADD / EDIT MODAL -->
        <div class="modal fade" id="Terms_conditionModal" tabindex="-1">
            <div class="modal-dialog modal-lg">
                <div class="modal-content">

                    <div class="modal-header">
                        <h4 class="modal-title">Terms & Condition</h4>
                        <button type="button" class="btn-close" data-bs-dismiss="modal"></button>
                    </div>

                    <div class="modal-body">
                        <form id="form">

                            <!-- Hidden ID -->
                            <input type="hidden" name="terms_condition_id" id="terms_condition_id">

                            <!-- Main Terms Name -->
                            <div class="mb-3">
                                <label>Terms & Condition Name</label>
                                <input type="text"
                                       class="form-control"
                                       name="terms_condition_name"
                                       id="terms_condition_name"
                                       placeholder="Enter Terms & Condition Name">

                                <span class="help-block text-danger"></span>
                            </div>

                            <!-- Dynamic Items -->
                            <div class="row">
                                <div class="col-md-12">
                                    <label>Terms & Condition Items</label>

                                    <div id="product1"></div>

                                    <button type="button"
                                            class="btn btn-success mt-2"
                                            id="add_more_btn">
                                        + Add New Item
                                    </button>
                                </div>
                            </div>

                        </form>
                    </div>

                    <div class="modal-footer">
                        <button type="button"
                                class="btn btn-primary"
                                id="btnSave"
                                onclick="save(event)">
                            Save
                        </button>

                        <button type="button"
                                class="btn btn-secondary"
                                data-bs-dismiss="modal">
                            Cancel
                        </button>
                    </div>

                </div>
            </div>
        </div>

        


<!-- ============================================
     DELETE CONFIRMATION MODAL
============================================ -->
<div class="modal fade" id="deleterowModal" tabindex="-1">

    <div class="modal-dialog modal-md">

        <div class="modal-content">

            <!-- HEADER -->
            <div class="modal-header bg-danger text-white">

                <h5 class="modal-title modal-title1">
                    Delete Confirmation
                </h5>

                <button type="button"
                        class="btn-close"
                        data-bs-dismiss="modal"></button>

            </div>

            <!-- BODY -->
            <div class="modal-body">

                <!-- HIDDEN DELETE ID -->
                <input type="hidden" name="delete_id" id="delete_id">

                <p class="mb-2">
                    Are you sure you want to delete this Terms & Condition?
                </p>

                <div class="alert alert-warning mb-0">
                    <strong id="delete_terms_name"></strong>
                </div>

            </div>

            <!-- FOOTER -->
            <div class="modal-footer">

                <button type="button"
                        class="btn btn-secondary"
                        data-bs-dismiss="modal">
                    Cancel
                </button>

                <button type="button"
                        class="btn btn-danger"
                        id="btnSave1"
                        onclick="confirm_delete_terms_condition()">
                    Delete
                </button>

            </div>

        </div>

    </div>

</div>