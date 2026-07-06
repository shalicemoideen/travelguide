<style>
    #TemplateMasterModal .modal-lg {
        max-width: 95%;
    }
    #TemplateMasterModal .modal-body {
        padding: 0.75rem 1rem;
    }
    #TemplateMasterModal .form-control,
    #TemplateMasterModal .form-select,
    #TemplateMasterModal select.form-control {
        font-size: 12px;
        padding: 0.3rem 0.5rem;
        min-height: 32px;
        height: auto;
    }
    #TemplateMasterModal label,
    #TemplateMasterModal .col-form-label {
        font-size: 12px;
        margin-bottom: 0.15rem;
        font-weight: 600;
    }
    #TemplateMasterModal .form-group,
    #TemplateMasterModal .mb-3 {
        margin-bottom: 0.5rem !important;
    }
    #TemplateMasterModal .row {
        --bs-gutter-y: 0.4rem;
    }
    #TemplateMasterModal .modal-header {
        padding: 0.6rem 1rem;
    }
    #TemplateMasterModal .modal-footer {
        padding: 0.5rem 1rem;
    }
    #TemplateMasterModal h5.modal-title {
        font-size: 14px;
    }
    #TemplateMasterModal .card-header {
        padding: 0.4rem 0.75rem;
    }
    #TemplateMasterModal .card-body {
        padding: 0.5rem 0.75rem;
    }
    #TemplateMasterModal .destination-block {
        padding: 0.5rem 0.75rem !important;
        margin-bottom: 0.5rem !important;
    }
    #TemplateMasterModal .destination-header {
        background: linear-gradient(135deg, #5b73e8 0%, #7c8fe0 100%);
        color: #ffffff;
        padding: 0.5rem 0.75rem;
        display: flex;
        align-items: center;
        justify-content: space-between;
        border: none;
        border-radius: 4px;
        font-weight: 600;
        font-size: 13px;
        margin-bottom: 0.5rem;
    }
    #TemplateMasterModal .destination-header .dest-number {
        color: #fff;
        font-weight: 700;
    }
    #TemplateMasterModal .assignment-row {
        margin-bottom: 0.4rem !important;
        padding-bottom: 0.4rem !important;
    }
    #TemplateMasterModal .btn-sm {
        font-size: 11px;
        padding: 0.25rem 0.5rem;
    }
    #TemplateMasterModal .select2-container .select2-selection--single {
        height: 32px;
        font-size: 12px;
    }
    #TemplateMasterModal .select2-container--default .select2-selection--single .select2-selection__rendered {
        line-height: 30px;
    }
    #TemplateMasterModal .select2-container--default .select2-selection--single .select2-selection__arrow {
        height: 30px;
    }
    #TemplateMasterModal .select2-container .select2-selection--multiple {
        min-height: 32px;
        font-size: 12px;
    }
    #TemplateMasterModal .select2-container--default .select2-selection--multiple .select2-selection__choice {
        font-size: 11px;
        padding: 1px 5px;
        margin-top: 3px;
    }
</style>

<style>
.select2-container--default .select2-selection--single .select2-selection__clear {
    position: absolute;
    right: 25px;
    top: 50%;
    transform: translateY(-50%);
    z-index: 10;
}
.select2-container--default .select2-selection--single .select2-selection__arrow {
    position: absolute;
    right: 5px;
    top: 50%;
    transform: translateY(-50%);
}
</style>

<!--**********************************
            Content body start
        ***********************************-->
        <div class="content-body">
            <div class="container-fluid">
                <div class="row">
                    <div class="col-12">
                        <div class="card">
                            <div class="card-header">
                                <h4 class="card-title">Template Master</h4>
                                <?php if (has_permission('TEMPLATE_MASTER_CREATE')): ?>
                                    <a onclick="add_template_master()" data-bs-target="#TemplateMasterModal" class="btn btn-rounded btn-secondary btn-md">+ New Template Master</a>
                                <?php endif; ?>
                            </div>
                            <div class="card-body">
                                <div class="table-responsive">
                                    <table id="Template_master_table" class="display" style="min-width: 845px">
                                        <thead>
                                            <tr>
                                                <th>Sl.no</th>
                                                <th>Category Name</th>
                                                <th>Design Type</th>
                                                <th>Action</th>
                                            </tr>
                                        </thead>
                                        <tbody>
                                        </tbody>
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

        <!-- Add/Edit Modal -->
        <div class="modal fade" id="TemplateMasterModal" role="dialog" data-bs-backdrop="static" data-bs-keyboard="false">
            <div class="modal-dialog modal-lg modal-dialog-scrollable" role="document">
                <div class="modal-content">
                    <div class="modal-header">
                        <h5 class="modal-title"></h5>
                        <button type="button" class="btn-close" onclick="templateMasterModalClose()"></button>
                    </div>
                    <div class="modal-body">
                        <form class="needs-validation" action="#" id="form">
                            <input type="hidden" value="" name="id" id="id"/>
                            <div class="row">
                                <div class="col-xl-12">
                                    <div class="mb-3 row form-group">
                                        <label class="col-lg-2 col-form-label" for="template_master_category_name">Category Name
                                            <span class="text-danger">*</span>
                                        </label>
                                        <div class="col-lg-4 template_master_category_name">
                                            <input type="text" class="form-control" name="template_master_category_name" id="template_master_category_name" placeholder="Enter category name" required>
                                            <span class="help-block" style="color:red"></span>
                                            <b><span id="category_name_alert" style="color: red"></span></b>
                                        </div>
                                    </div>
                                    <div class="mb-3 row form-group">
                                        <label class="col-lg-2 col-form-label" for="template_master_design_type">Design Type
                                            <span class="text-danger">*</span>
                                        </label>
                                        <div class="col-lg-4 template_master_design_type">
                                            <select class="form-control" name="template_master_design_type" id="template_master_design_type" required>
                                                <option value="">Select Design</option>
                                                <option value="Standard">Standard</option>
                                                <option value="Exclusive">Exclusive</option>
                                            </select>
                                            <span class="help-block" style="color:red"></span>
                                        </div>
                                    </div>
                                </div>
                            </div>

                            <!-- Destinations Section -->
                            <div class="card border-0 mb-2">
                                <div class="card-header d-flex justify-content-between align-items-center py-1" style="background: linear-gradient(135deg, #5b73e8 0%, #7c8fe0 100%); border:none; border-radius:4px;">
                                    <h6 class="mb-0 text-white" style="font-size:13px;"><i class="la la-map-marker me-1"></i> Destinations</h6>
                                    <button type="button" class="btn btn-success btn-sm" onclick="addDestination()">+ Add Destination</button>
                                </div>
                                <div class="card-body p-2" id="destinations_container">
                                    <!-- Dynamic destination blocks -->
                                </div>
                            </div>
                        </form>
                    </div>
                    <div class="modal-footer">
                        <button type="button" class="btn btn-danger light" onclick="templateMasterModalClose()">Close</button>
                        <button type="button" class="btn btn-primary" id="btnSave" onclick="save()">Save</button>
                    </div>
                </div>
            </div>
        </div>

        <!-- Templates for dynamic rows -->
        <div id="destination_template" style="display:none;">
            <div class="destination-block border rounded p-2 mb-2 bg-white" data-dest-idx="__DEST_IDX__">
                <div class="destination-header">
                    <span><i class="la la-map-marker me-1"></i> Destination <span class="dest-number">1</span></span>
                    <button type="button" class="btn btn-link text-white p-0" onclick="removeDestination(this)" title="Remove" style="font-size:14px;"><i class="la la-trash"></i></button>
                </div>
                <div class="row form-group mb-1">
                    <label class="col-lg-2 col-form-label py-0">Destination <span class="text-danger">*</span></label>
                    <div class="col-lg-6">
                        <select class="form-control destination-select" name="destination[__DEST_IDX__][state_id]" required style="width:100%">
                            <option value="">Select Destination</option>
                        </select>
                        <span class="help-block" style="color:red"></span>
                    </div>
                </div>
                <div class="assignments-container mt-1">
                    <!-- Dynamic property+room rows -->
                </div>
                <button type="button" class="btn btn-outline-primary btn-sm mt-1" onclick="addAssignment(this)">+ Property & Room</button>
            </div>
        </div>

        <div id="assignment_template" style="display:none;">
            <div class="assignment-row d-flex gap-2 align-items-start mb-1 border-bottom pb-1" data-prop-idx="__PROP_IDX__">
                <div class="flex-grow-1" style="min-width:160px;">
                    <select class="form-control property-select" name="destination[__DEST_IDX__][property][__PROP_IDX__][property_id]" required style="width:100%">
                        <option value="">Select Property</option>
                    </select>
                    <span class="help-block" style="color:red"></span>
                </div>
                <div class="flex-grow-1" style="min-width:160px;">
                    <select class="form-control room-select" name="destination[__DEST_IDX__][property][__PROP_IDX__][rooms][]" multiple required style="width:100%">
                    </select>
                    <span class="help-block" style="color:red"></span>
                </div>
                <div>
                    <button type="button" class="btn btn-outline-secondary btn-sm py-0 px-2" onclick="removeAssignment(this)" title="Remove"><i class="la la-times"></i></button>
                </div>
            </div>
        </div>

<!-- Delete Modal -->
<div class="modal fade" id="deleterowModal" role="dialog" data-backdrop="static" data-keyboard="false">
    <div class="modal-dialog" role="document">
        <div class="modal-content">
            <div class="modal-header">
                <h5 class="modal-title1"></h5>
                <button type="button" class="btn-close" data-bs-dismiss="modal"></button>
            </div>
            <div class="modal-body">
                <form class="needs-validation" action="#" id="form1">
                    <input type="hidden" value="" name="id" id="id1"/>
                </form>
            </div>
            <div class="modal-footer">
                <button type="button" class="btn btn-danger light" data-bs-dismiss="modal">Close</button>
                <button type="button" class="btn btn-primary" id="btnSave1" onclick="delete_template_master_action()">Delete</button>
            </div>
        </div>
    </div>
</div>
