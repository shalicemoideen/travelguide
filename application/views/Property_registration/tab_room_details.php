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
                                         <!-- <div class="tab-pane fade show row page" style="display:none" data-page="Room_details" id="Room_details"> -->
                                                <div class="col-sm-2"><button type="button" id="btn1" class="btn btn-rounded btn-primary btn-md"><i class="fas fa-filter"></i> Filter</button></div><br><br><br>
                                                <!-- <div class="row page-titles">
                                                    <ol class="breadcrumb">
                                                        <li class="breadcrumb-item active"><a href="javascript:void(0)">Table</a></li>
                                                        <li class="breadcrumb-item"><a href="javascript:void(0)">Datatable</a></li>
                                                    </ol>
                                                </div> -->
                                                <!-- row -->
                                                <form id="exampleValidation1" method="POST" action="" enctype="multipart/form-data">
                                                                    <div class="card-header" id="Create1" style="display:none;">
                                                                        <div class="d-flex align-items-center">
                                                                            <div class="row row-demo-grid hdr-filter-dd-fullwd"> 
                                                                                <div class="col-sm-6 col-md-3">
                                                                                    <div class="card">
                                                                                        <div class="input-group">
                                                                                            <select data-validation="required"  data-pms-required="true" class="form-control input-lg multi-select" id="properties_room_category_id" name="properties_room_category_id"  required>  
                                                            
                                                                                                   <option value="">Please Select Room Category</option>
                                                                                            </select>
                                                                                        </div>
                                                                                    </div>
                                                                                </div>
                                                                                <div class="col-sm-6 col-md-3">
                                                                                    <div class="card">
                                                                                        <div class="input-group">
                                                                                            <select data-validation="required"  data-pms-required="true" class="form-control input-lg multi-select" id="room_meal_plan_id" name="room_meal_plan_id" required>  
                                                            
                                                                                                    <option value="">Please Select meal plan</option>
                                                                                            </select>
                                                                                        </div>
                                                                                    </div>
                                                                                </div>
                                                                                                                          
                                                                                <div class="col-sm-6 col-md-3 staff-do-not-show">
                                                                                    <div class="card">
                                                                                        <div class="input-group">
                                                                                            <select name="properties_room_category_createdby_user_id" id="properties_room_category_createdby_user_id" class="form-control input-lg multi-select" required>                                     
                                                                                                <option value="">Please Select Created by</option>
                                                                                            </select>
                                                                                        </div>
                                                                                    </div>
                                                                                </div>
                                                                                <div class="col-sm-2 col-md-3">
                                                                                    <div class="card">
                                                                                        <button type="button" class="btn btn-warning btn-md" id="search1">
                                                                                            <span class="btn-label">
                                                                                                <i class="fas fa-search"></i>
                                                                                            </span>
                                                                                            Search
                                                                                        </button>
                                                                                    </div>
                                                                                </div>
                                                                                
                                                                                <div class="col-sm-2 col-md-3">
                                                                                    <div class="card">
                                                                                        <button type="button" class="btn btn-secondary btn-md" id="refresh1">
                                                                                            <span class="btn-label">
                                                                                                <i class="icon-refresh"></i>
                                                                                            </span>
                                                                                            Refresh
                                                                                        </button>
                                                                                    </div>
                                                                                </div>


                                                                            </div>
                                                                        
                                                                        </div>
                                                                    </div>
                                                                    </form>

                                                <div class="row">
                                                    
                                                    
                                                    <div class="col-12">
                                                        <div class="card">
                                                            <div class="card-header">
                                                                <h2 class="card-title"><b>Room Category Details</b></h2>
                                                                <?php if (has_permission('ROOM_DETAILS_CREATE')): ?>
                                                                    <button onclick="add_room()"  data-bs-target="#RoomModal" class="btn btn-rounded btn-secondary btn-md"><b>+ New room category</b></button>
                                                                <?php endif; ?>
                                                            </div>
                                                            <div class="card-body">
                                                                <div class="table-responsive">
                                                                    <table class="table card-table display mb-4 shadow-hover table-responsive-lg" id="Room_registration">
                                                                        <thead>
                                                                            <tr>
                                                                                <th>Sl.no</th>                                                                                
                                                                                <th>Room category name</th>
                                                                                <th>Photo</th>
                                                                                <th>Meal plan</th>
                                                                                <th>Inventory</th>
                                                                                <th>Description</th>
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

<script>
$(document).ready(function () {
    // Filter toggle
    $("#btn1").click(function () {
        $("#Create1").toggle();
    });

    // Room category dropdown with AJAX
    $('#properties_room_category_id').select2({
        ajax: {
            url: "<?php echo base_url();?>index.php/Property_registration/get_room_category_dropdown",
            dataType: 'json',
            delay: 250,
            data: function (params) {
                return {
                    q: params.term,
                    page: params.page || 1,
                    properties_id: $('#properties_id_fk_hidden').val()
                };
            },
            processResults: function (data, params) {
                params.page = params.page || 1;
                return {
                    results: data.results
                };
            },
            cache: true
        },
        width: '100%',
        minimumResultsForSearch: 0,
        dropdownParent: $('#Create1'),
        allowClear: true,
        placeholder: "Please Select Room"
    }).on('select2:unselecting', function(e) {
        if (!e.params.args.data) {
            $(this).one('select2:open', function(e) {
                e.preventDefault();
                e.stopImmediatePropagation();
            });
        }
    });

    // Meal plan dropdown with AJAX
    $('#room_meal_plan_id').select2({
        ajax: {
            url: "<?php echo base_url();?>index.php/Property_registration/get_meal_plan_dropdown",
            dataType: 'json',
            delay: 250,
            data: function (params) {
                return {
                    q: params.term,
                    page: params.page || 1
                };
            },
            processResults: function (data, params) {
                params.page = params.page || 1;
                return {
                    results: data.results
                };
            },
            cache: true
        },
        width: '100%',
        minimumResultsForSearch: 0,
        dropdownParent: $('#Create1'),
        allowClear: true,
        placeholder: "Please Select meal plan"
    }).on('select2:unselecting', function(e) {
        if (!e.params.args.data) {
            $(this).one('select2:open', function(e) {
                e.preventDefault();
                e.stopImmediatePropagation();
            });
        }
    });

    // Created by dropdown with AJAX
    $('#properties_room_category_createdby_user_id').select2({
        ajax: {
            url: "<?php echo base_url();?>index.php/Property_registration/get_staff_dropdown",
            dataType: 'json',
            delay: 250,
            data: function (params) {
                return {
                    q: params.term,
                    page: params.page || 1
                };
            },
            processResults: function (data, params) {
                params.page = params.page || 1;
                return {
                    results: data.results
                };
            },
            cache: true
        },
        width: '100%',
        minimumResultsForSearch: 0,
        dropdownParent: $('#Create1'),
        allowClear: true,
        placeholder: "Please Select Created by"
    }).on('select2:unselecting', function(e) {
        if (!e.params.args.data) {
            $(this).one('select2:open', function(e) {
                e.preventDefault();
                e.stopImmediatePropagation();
            });
        }
    });

    // Refresh button functionality
    $('#refresh1').click(function () {
        $('#properties_room_category_id').val(null).trigger('change');
        $('#room_meal_plan_id').val(null).trigger('change');
        $('#properties_room_category_createdby_user_id').val(null).trigger('change');
        // Reload datatable after clearing filters
        if ($('#Room_registration').length) {
            $('#Room_registration').DataTable().ajax.reload();
        }
    });

    // Search button functionality
    $('#search1').click(function () {
        // Reload datatable with current filter values
        if ($('#Room_registration').length) {
            $('#Room_registration').DataTable().ajax.reload();
        }
    });
});
</script>