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
                                <div class="col-sm-2"><button type="button" id="btn6" class="btn btn-rounded btn-primary btn-md"><i class="fas fa-filter"></i> Filter</button></div><br><br><br>
                                        <!-- <div class="row page-titles">
                                            <ol class="breadcrumb">
                                                <li class="breadcrumb-item active"><a href="javascript:void(0)">Table</a></li>
                                                <li class="breadcrumb-item"><a href="javascript:void(0)">Datatable</a></li>
                                            </ol>
                                        </div> -->
                                        <!-- row -->
                                        <form id="exampleValidation2" method="POST" action="" enctype="multipart/form-data">
                                            <div class="card-header" id="Create2" style="display:none;">
                                                <div class="d-flex align-items-center">
                                                    <div class="row row-demo-grid hdr-filter-dd-fullwd">

                                                        <div class="col-sm-6 col-md-4">
                                                            <div class="card">
                                                                <div class="input-group">
                                                                    <select name="property_inclusions_id_filter" id="property_inclusions_id_filter" class="form-control input-lg multi-select" required>
                                                                        <option value="">Please Select inclusion</option>
                                                                    </select>
                                                                </div>
                                                            </div>
                                                        </div>

                                                        <div class="col-sm-6 col-md-4">
                                                            <div class="card">
                                                                <div class="input-group">
                                                                    <select name="property_inclusions_created_by_userid" id="property_inclusions_created_by_userid" class="form-control input-lg multi-select" required>
                                                                        <option value="">Please Select Created by</option>
                                                                    </select>
                                                                </div>
                                                            </div>
                                                        </div>
                                                        <div class="col-sm-2 col-md-3">
                                                            <div class="card">
                                                                <button type="button" class="btn btn-warning btn-md" id="search4">
                                                                    <span class="btn-label">
                                                                        <i class="fas fa-search"></i>
                                                                    </span>
                                                                    Search
                                                                </button>
                                                            </div>
                                                        </div>
                                                        <div class="col-sm-2 col-md-3">
                                                            <div class="card">
                                                                <button type="button" class="btn btn-secondary btn-md" id="refresh4">
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
                                                                <h2 class="card-title"><b>Property inclusion Details</b></h2>
                                                                <?php if (has_permission('PROPERTY_INCLUSION_CREATE')): ?>
                                                                    <button onclick="add_property_inclusion()"  data-bs-target="#Property_inclusionModal" class="btn btn-rounded btn-secondary btn-md"><b>+ Add new property inclusion</b></button>
                                                                <?php endif; ?>
                                                            </div>
                                                            <div class="card-body">
                                                                <div class="table-responsive">
                                                                    <table class="table card-table display mb-4 shadow-hover table-responsive-lg" id="Property_inclusion_table">
                                                                        <thead>
                                                                            <tr>
                                                                                <th>Sl.no</th>
                                                                                <th>Inclusion name</th>
                                                                                <th>Amount</th>
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
    $("#btn6").click(function () {
        $("#Create2").toggle();
    });

    // Property inclusion dropdown with AJAX
    $('#property_inclusions_id_filter').select2({
        ajax: {
            url: "<?php echo base_url();?>index.php/Property_registration/get_property_inclusion_dropdown",
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
        dropdownParent: $('#Create2'),
        allowClear: true,
        placeholder: "Please Select inclusion"
    }).on('select2:unselecting', function(e) {
        if (!e.params.args.data) {
            $(this).one('select2:open', function(e) {
                e.preventDefault();
                e.stopImmediatePropagation();
            });
        }
    });

    // Created by dropdown with AJAX
    $('#property_inclusions_created_by_userid').select2({
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
        dropdownParent: $('#Create2'),
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
    $('#refresh4').click(function () {
        $('#property_inclusions_id_filter').val(null).trigger('change');
        $('#property_inclusions_created_by_userid').val(null).trigger('change');
        // Reload datatable after clearing filters
        if ($('#Property_inclusion_table').length) {
            $('#Property_inclusion_table').DataTable().ajax.reload();
        }
    });

    // Search button functionality
    $('#search4').click(function () {
        // Reload datatable with current filter values
        if ($('#Property_inclusion_table').length) {
            $('#Property_inclusion_table').DataTable().ajax.reload();
        }
    });
});
</script>
