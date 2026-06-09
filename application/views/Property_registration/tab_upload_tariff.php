                                                <div class="col-sm-2"><button type="button" id="btn2" class="btn btn-rounded btn-primary btn-md"><i class="fas fa-filter"></i> Filter</button></div><br><br><br>
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
                                                                                            <div class="example">                                                                                                
                                                                                                <input type="text" class="form-control" id="tariff_daterange" name="daterange" placeholder="Tariff date range">
                                                                                            </div>
                                                                                        </div>
                                                                                    </div>
                                                                                </div>

                                                                                <div class="col-sm-6 col-md-4">
                                                                                    <div class="card">
                                                                                        <div class="input-group">
                                                                                            <select name="upload_tariff_document_created_by_user_id" id="upload_tariff_document_created_by_user_id" class="form-control input-lg multi-select" required>
                                                                                                <option value="">Please Select Created by</option>
                                                                                            </select>
                                                                                        </div>
                                                                                    </div>
                                                                                </div>
                                                                                <div class="col-sm-2 col-md-3">
                                                                                    <div class="card">
                                                                                        <button type="button" class="btn btn-warning btn-md" id="search2">
                                                                                            <span class="btn-label">
                                                                                                <i class="fas fa-search"></i>
                                                                                            </span>
                                                                                            Search
                                                                                        </button>
                                                                                    </div>
                                                                                </div>
                                                                                <div class="col-sm-2 col-md-3">
                                                                                    <div class="card">
                                                                                        <button type="button" class="btn btn-secondary btn-md" id="refresh2">
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
                                                                <h2 class="card-title"><b>Tariff uploaded Details</b></h2>
                                                                <?php if (has_permission('UPLOAD_TARIFF_CREATE')): ?>
                                                                    <button onclick="add_tariff_uploaded()"  data-bs-target="#Tariff_uploadedModal" class="btn btn-rounded btn-secondary btn-md"><b>+ Upload new room tariff</b></button>
                                                                <?php endif; ?>
                                                            </div>
                                                            <div class="card-body">
                                                                <div class="table-responsive">
                                                                    <table class="table card-table display mb-4 shadow-hover table-responsive-lg" id="Tariff_uploaded_registration">
                                                                        <thead>
                                                                            <tr>
                                                                                <th>Sl.no</th>
                                                                                <th>From date</th>
                                                                                <th>To date</th>
                                                                                <th>Document</th>
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
    $("#btn2").click(function () {
        $("#Create2").toggle();
    });

    // Initialize daterangepicker
    $('#tariff_daterange').daterangepicker({
        autoUpdateInput: false,
        opens: 'left',
        locale: {
            format: 'DD/MM/YYYY',
            separator: ' - ',
            applyLabel: 'Apply',
            cancelLabel: 'Cancel',
            fromLabel: 'From',
            toLabel: 'To',
            customRangeLabel: 'Custom',
            daysOfWeek: ['Su', 'Mo', 'Tu', 'We', 'Th', 'Fr', 'Sa'],
            monthNames: ['January', 'February', 'March', 'April', 'May', 'June', 'July', 'August', 'September', 'October', 'November', 'December'],
            firstDay: 1
        }
    });

    $('#tariff_daterange').on('apply.daterangepicker', function(ev, picker) {
        $(this).val(
            picker.startDate.format('DD/MM/YYYY') + ' - ' + picker.endDate.format('DD/MM/YYYY')
        );
    });

    $('#tariff_daterange').on('cancel.daterangepicker', function() {
        $(this).val('');
    });

    // Created by dropdown with AJAX
    $('#upload_tariff_document_created_by_user_id').select2({
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
    $('#refresh2').click(function () {
        $('#tariff_daterange').val('');
        $('#upload_tariff_document_created_by_user_id').val(null).trigger('change');
        // Reload datatable after clearing filters
        if ($('#Tariff_uploaded_registration').length) {
            $('#Tariff_uploaded_registration').DataTable().ajax.reload();
        }
    });

    // Search button functionality
    $('#search2').click(function () {
        // Reload datatable with current filter values
        if ($('#Tariff_uploaded_registration').length) {
            $('#Tariff_uploaded_registration').DataTable().ajax.reload();
        }
    });
});
</script>
