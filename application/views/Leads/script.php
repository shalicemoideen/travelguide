<script>
    ////***Latest dropdown select2*****///

function renderRejectedQuotationRow(data, row) {
    if((data['leads_accomodation_status'] == 2 || data['leads_accomodation_status'] == 1) && data['leads_quotation_status'] == 3){
        $('td', row).eq(1).html('<a class="leads-number-link" href="javascript:void(0)" onclick="view_lead_details('+data['leads_id']+')">'+data['leads_number']+'</a><br><span class="badge badge-xs badge badge-danger">Rejected/Quotation not created</span>');
        let actionHtml = '<div class="dropdown ms-auto text-end"><div class="btn-link" data-bs-toggle="dropdown"><svg width="24px" height="24px" viewBox="0 0 24 24" version="1.1"><g stroke="none" stroke-width="1" fill="none" fill-rule="evenodd"><rect x="0" y="0" width="24" height="24"></rect><circle fill="#000000" cx="5" cy="12" r="2"></circle><circle fill="#000000" cx="12" cy="12" r="2"></circle><circle fill="#000000" cx="19" cy="12" r="2"></circle></g></svg></div><div class="dropdown-menu dropdown-menu-end">';
        if (hasPermission('LEADS_UPDATE')) { actionHtml += '<a class="dropdown-item" href="javascript:void(0)" id="rt" onclick="edit_leads('+data['leads_id']+')">Edit</a>'; }
        if (hasPermission('LEADS_CHANGE_STATUS')) { actionHtml += '<a class="dropdown-item" href="javascript:void(0)" id="rt" onclick="openChangeStatus1Modal('+data['leads_id']+')">Change status</a>'; }
        if (hasPermission('LEADS_SHOW_STATUS')) { actionHtml += '<a class="dropdown-item" href="javascript:void(0)" id="rt" onclick="showStatus1Modal('+data['leads_id']+')">Status history</a>'; }
        if (hasPermission('LEADS_CHANGE_STAGE')) { actionHtml += '<a class="dropdown-item" href="javascript:void(0)" id="rt" onclick="openChangeStatusModal('+data['leads_id']+')">Change stage</a>'; }
        if (hasPermission('LEADS_SHOW_STAGE')) { actionHtml += '<a class="dropdown-item" href="javascript:void(0)" id="rt" onclick="showStatusModal('+data['leads_id']+')">Show stages</a>'; }
        if (hasPermission('LEADS_GUEST_COUNT')) { actionHtml += '<a class="dropdown-item" href="javascript:void(0)" id="rt"  onclick="open_guest_count_checked('+data['leads_id']+')">Guest count</a>'; }
        if (hasPermission('LEADS_ACCOMODATION_PLAN')) { actionHtml += '<a class="dropdown-item" href="javascript:void(0)" id="rt"  onclick="open_accommodation_checked('+data['leads_id']+')">Accomodation plan</a>'; }
        if (hasPermission('LEADS_QUOTATION')) { actionHtml += '<a class="dropdown-item" href="javascript:void(0)" id="rt" onclick="open_quotation('+data['leads_id']+')">Quotation</a>'; }
        if (hasPermission('LEADS_DETAILS')) { actionHtml += '<a class="dropdown-item" href="javascript:void(0)" id="rt" onclick="view_lead_details('+data['leads_id']+')">view</a>'; }
        if (hasPermission('LEADS_DELETE')) { actionHtml += '<a class="dropdown-item" href="javascript:void(0)" onclick="return delete_leads('+data['leads_id']+')">Delete</a>'; }
        actionHtml += '</div></div>';
        $('td', row).eq(11).html(actionHtml);
    }
}

function renderQuotationCreatedRow(data, row) {
    if(data['leads_accomodation_status'] == 1 && data['leads_quotation_status'] == 1){
        $('td', row).eq(1).html('<a class="leads-number-link" href="javascript:void(0)" onclick="view_lead_details('+data['leads_id']+')">'+data['leads_number']+'</a><br><span class="badge badge-xs badge badge-success">Quotation created</span>');
        let actionHtml = '<div class="dropdown ms-auto text-end"><div class="btn-link" data-bs-toggle="dropdown"><svg width="24px" height="24px" viewBox="0 0 24 24" version="1.1"><g stroke="none" stroke-width="1" fill="none" fill-rule="evenodd"><rect x="0" y="0" width="24" height="24"></rect><circle fill="#000000" cx="5" cy="12" r="2"></circle><circle fill="#000000" cx="12" cy="12" r="2"></circle><circle fill="#000000" cx="19" cy="12" r="2"></circle></g></svg></div><div class="dropdown-menu dropdown-menu-end">';
        if (hasPermission('LEADS_UPDATE')) { actionHtml += '<a class="dropdown-item" href="javascript:void(0)" id="rt" onclick="edit_leads('+data['leads_id']+')">Edit</a>'; }
        if (hasPermission('LEADS_CHANGE_STATUS')) { actionHtml += '<a class="dropdown-item" href="javascript:void(0)" id="rt" onclick="openChangeStatus1Modal('+data['leads_id']+')">Change status</a>'; }
        if (hasPermission('LEADS_SHOW_STATUS')) { actionHtml += '<a class="dropdown-item" href="javascript:void(0)" id="rt" onclick="showStatus1Modal('+data['leads_id']+')">Status history</a>'; }
        if (hasPermission('LEADS_CHANGE_STAGE')) { actionHtml += '<a class="dropdown-item" href="javascript:void(0)" id="rt" onclick="openChangeStatusModal('+data['leads_id']+')">Change stage</a>'; }
        if (hasPermission('LEADS_SHOW_STAGE')) { actionHtml += '<a class="dropdown-item" href="javascript:void(0)" id="rt" onclick="showStatusModal('+data['leads_id']+')">Show stages</a>'; }
        if (hasPermission('LEADS_DETAILS')) { actionHtml += '<a class="dropdown-item" href="javascript:void(0)" id="rt" onclick="view_lead_details('+data['leads_id']+')">view</a>'; }
        if (hasPermission('LEADS_DELETE')) { actionHtml += '<a class="dropdown-item" href="javascript:void(0)" onclick="return delete_leads('+data['leads_id']+')">Delete</a>'; }
        actionHtml += '</div></div>';
        $('td', row).eq(11).html(actionHtml);
    }
}

function renderCancelledQuotationRow(data, row) {
    if(data['leads_accomodation_status'] == 1 && data['leads_quotation_status'] == 2){
        $('td', row).eq(1).html('<a class="leads-number-link" href="javascript:void(0)" onclick="view_lead_details('+data['leads_id']+')">'+data['leads_number']+'</a><br><span class="badge badge-xs badge badge-danger">Cancelled/Quotation not created</span>');
        let actionHtml = '<div class="dropdown ms-auto text-end"><div class="btn-link" data-bs-toggle="dropdown"><svg width="24px" height="24px" viewBox="0 0 24 24" version="1.1"><g stroke="none" stroke-width="1" fill="none" fill-rule="evenodd"><rect x="0" y="0" width="24" height="24"></rect><circle fill="#000000" cx="5" cy="12" r="2"></circle><circle fill="#000000" cx="12" cy="12" r="2"></circle><circle fill="#000000" cx="19" cy="12" r="2"></circle></g></svg></div><div class="dropdown-menu dropdown-menu-end">';
        if (hasPermission('LEADS_UPDATE')) { actionHtml += '<a class="dropdown-item" href="javascript:void(0)" id="rt" onclick="edit_leads('+data['leads_id']+')">Edit</a>'; }
        if (hasPermission('LEADS_CHANGE_STATUS')) { actionHtml += '<a class="dropdown-item" href="javascript:void(0)" id="rt" onclick="openChangeStatus1Modal('+data['leads_id']+')">Change status</a>'; }
        if (hasPermission('LEADS_SHOW_STATUS')) { actionHtml += '<a class="dropdown-item" href="javascript:void(0)" id="rt" onclick="showStatus1Modal('+data['leads_id']+')">Status history</a>'; }
        if (hasPermission('LEADS_CHANGE_STAGE')) { actionHtml += '<a class="dropdown-item" href="javascript:void(0)" id="rt" onclick="openChangeStatusModal('+data['leads_id']+')">Change stage</a>'; }
        if (hasPermission('LEADS_SHOW_STAGE')) { actionHtml += '<a class="dropdown-item" href="javascript:void(0)" id="rt" onclick="showStatusModal('+data['leads_id']+')">Show stages</a>'; }
        if (hasPermission('LEADS_GUEST_COUNT')) { actionHtml += '<a class="dropdown-item" href="javascript:void(0)" id="rt"  onclick="open_guest_count_checked('+data['leads_id']+')">Guest count</a>'; }
        if (hasPermission('LEADS_ACCOMODATION_PLAN')) { actionHtml += '<a class="dropdown-item" href="javascript:void(0)" id="rt"  onclick="open_accommodation_checked('+data['leads_id']+')">Accomodation plan</a>'; }
        if (hasPermission('LEADS_QUOTATION')) { actionHtml += '<a class="dropdown-item" href="javascript:void(0)" id="rt" onclick="open_quotation('+data['leads_id']+')">Quotation</a>'; }
        if (hasPermission('LEADS_DETAILS')) { actionHtml += '<a class="dropdown-item" href="javascript:void(0)" id="rt" onclick="view_lead_details('+data['leads_id']+')">view</a>'; }
        if (hasPermission('LEADS_DELETE')) { actionHtml += '<a class="dropdown-item" href="javascript:void(0)" onclick="return delete_leads('+data['leads_id']+')">Delete</a>'; }
        actionHtml += '</div></div>';
        $('td', row).eq(11).html(actionHtml);
    }
}

function initCommonSelect2(scope) {

    scope = scope || document;

    $(scope).find('.lst-flt-select2').each(function () {

        let $select = $(this);

        // avoid re-initializing
        if ($select.hasClass('select2-hidden-accessible')) {
            return;
        }

        // find nearest opened modal if this select is inside modal
        let $modal = $select.closest('.modal');

        let options = {
            width: '100%',
            minimumResultsForSearch: 0
        };

        // only set dropdownParent when inside modal
        if ($modal.length) {
            options.dropdownParent = $modal;
        }

        $select.select2(options);
    });
}

// auto focus search input for all select2
$(document).on('select2:open', function () {
    setTimeout(function () {
        let searchField = document.querySelector('.select2-container--open .select2-search__field');
        if (searchField) {
            searchField.focus();
        }
    }, 50);
});

// initialize page select2
$(document).ready(function () {
    initCommonSelect2(document);
});

// call this after opening any modal
$('#LeadsModal').on('shown.bs.modal', function () {
    initCommonSelect2(this);
});
////***Date picker *****///

////***Filter Select2 AJAX dropdowns *****///
function initFilterSelect2Ajax(id, url, placeholder) {
    $('#' + id).select2({
        width: '100%',
        placeholder: placeholder,
        allowClear: true,
        minimumInputLength: 0,
        ajax: {
            url: '<?php echo base_url(); ?>index.php/' + url,
            type: 'GET',
            dataType: 'json',
            delay: 250,
            data: function (params) { return { q: params.term || '' }; },
            processResults: function (data) { return { results: data.results }; },
            cache: false
        }
    });
}

function initFilterSelect2Static(id, placeholder) {
    $('#' + id).select2({ width: '100%', placeholder: placeholder, allowClear: true });
}

$(document).ready(function () {
    // B2C tab (tab 1)
    initFilterSelect2Ajax('leads_number_filter1', 'Leads/get_b2c_leads_dropdown', 'Please Select lead number');
    initFilterSelect2Ajax('staff_id1',            'Leads/get_staff_dropdown', 'Please Select assigned staff');
    initFilterSelect2Ajax('source_id1',           'Leads/get_source_dropdown', 'Please Select source');
    initFilterSelect2Ajax('packages_id1',         'Leads/get_packages_dropdown', 'Please Select template');
    initFilterSelect2Ajax('country_id1',          'Leads/get_country_dropdown', 'Please Select country');
    initFilterSelect2Ajax('priority_status_id1',  'Leads/get_priority_status_dropdown', 'Please Select priority status');
    initFilterSelect2Ajax('stages_id1',           'Leads/get_stages_dropdown', 'Please Select stage');
    initFilterSelect2Static('lead_current_status1',        'Please Select lead status');
    initFilterSelect2Static('leads_accomodation_status1',  'Please Select accommodation status');
    initFilterSelect2Ajax('leads_createdby_userid1', 'Leads/get_all_users_dropdown', 'Please Select Created by');

    // Meta leads tab (tab 2)
    initFilterSelect2Ajax('leads_number_filter2', 'Leads/get_meta_leads_dropdown', 'Please Select lead number');
    initFilterSelect2Ajax('staff_id2',            'Leads/get_staff_dropdown', 'Please Select assigned staff');
    initFilterSelect2Ajax('source_id2',           'Leads/get_source_dropdown', 'Please Select source');
    initFilterSelect2Ajax('packages_id2',         'Leads/get_packages_dropdown', 'Please Select template');
    initFilterSelect2Ajax('facebook_ads',         'Leads/get_ads_dropdown', 'Please Select Facebook Ads name');
    initFilterSelect2Ajax('country_id2',          'Leads/get_country_dropdown', 'Please Select country');
    initFilterSelect2Ajax('priority_status_id2',  'Leads/get_priority_status_dropdown', 'Please Select priority status');
    initFilterSelect2Ajax('stages_id2',           'Leads/get_stages_dropdown', 'Please Select stage');
    initFilterSelect2Static('lead_current_status2',        'Please Select lead status');
    initFilterSelect2Static('leads_accomodation_status2',  'Please Select accommodation status');
    initFilterSelect2Ajax('leads_createdby_userid2', 'Leads/get_all_users_dropdown', 'Please Select Created by');

    // Refresh button - B2C
    $('#refresh1').on('click', function () {
        $('#leads_number_filter1, #staff_id1, #source_id1, #packages_id1, #country_id1, #priority_status_id1, #stages_id1, #lead_current_status1, #leads_accomodation_status1, #leads_createdby_userid1').val(null).trigger('change');
        $('#guest_name_filter1').val('');
        $('#whats_number_filter1').val('');
        $('#leads_daterange').val('');
        $('#travel_daterange').val('');
        $table1.ajax.reload();
    });

    // Refresh button - Meta
    $('#refresh2').on('click', function () {
        $('#leads_number_filter2, #staff_id2, #source_id2, #packages_id2, #facebook_ads, #country_id2, #priority_status_id2, #stages_id2, #lead_current_status2, #leads_accomodation_status2, #leads_createdby_userid2').val(null).trigger('change');
        $('#guest_name_filter2').val('');
        $('#whats_number_filter2').val('');
        $('#leads_daterange2').val('');
        $('#travel_daterange2').val('');
        $table2.ajax.reload();
    });
});
////***Filter Select2 AJAX dropdowns *****///

$(document).on('show.bs.modal', '.modal', function () {
    $('.lst2').each(function () {
        if ($(this).hasClass('select2-hidden-accessible')) {
            $(this).select2('close');
        }
    });

    $('#Create1').css({
        'pointer-events': 'none',
        'opacity': '0.6'
    });
});

$(document).on('hidden.bs.modal', '.modal', function () {
    $('#Create1').css({
        'pointer-events': '',
        'opacity': ''
    });
});

$(document).on('show.bs.modal', '.modal', function () {
    $('.lst2').each(function () {
        if ($(this).hasClass('select2-hidden-accessible')) {
            $(this).select2('close');
        }
    });

    $('#Create2').css({
        'pointer-events': 'none',
        'opacity': '0.6'
    });
});

$(document).on('hidden.bs.modal', '.modal', function () {
    $('#Create2').css({
        'pointer-events': '',
        'opacity': ''
    });
});

/////////////
$('#start_date1').datepicker({
    format: 'dd-mm-yyyy',
    autoclose: true,
    todayHighlight: true
});

$('#end_date').bootstrapMaterialDatePicker({
         weekStart: 0,
        time: false,
        format: 'DD/MM/YYYY'
    });

$('#leads_start_date1').datepicker({
    format: 'dd-mm-yyyy',
    autoclose: true,
    todayHighlight: true
});

$('#leads_end_date1').datepicker({
    format: 'dd-mm-yyyy',
    autoclose: true,
    todayHighlight: true
});

$('#travels_start_date1').datepicker({
    format: 'dd-mm-yyyy',
    autoclose: true,
    todayHighlight: true
});

$('#travels_end_date1').datepicker({
    format: 'dd-mm-yyyy',
    autoclose: true,
    todayHighlight: true
});

$('#leads_start_date2').datepicker({
    format: 'dd-mm-yyyy',
    autoclose: true,
    todayHighlight: true
});

$('#leads_end_date2').datepicker({
    format: 'dd-mm-yyyy',
    autoclose: true,
    todayHighlight: true
});

$('#travels_start_date2').datepicker({
    format: 'dd-mm-yyyy',
    autoclose: true,
    todayHighlight: true
});

$('#travels_end_date2').datepicker({
    format: 'dd-mm-yyyy',
    autoclose: true,
    todayHighlight: true
});
// $('#leads_start_date').bootstrapMaterialDatePicker({
//          weekStart: 0,
//         time: false,
//         format: 'DD/MM/YYYY'
//     });

// $('#leads_end_date').bootstrapMaterialDatePicker({
//          weekStart: 0,
//         time: false,
//         format: 'DD/MM/YYYY'
//     });
// $('#travels_start_date').bootstrapMaterialDatePicker({
//          weekStart: 0,
//         time: false,
//         format: 'DD/MM/YYYY'
//     });

// $('#travels_end_date').bootstrapMaterialDatePicker({
//          weekStart: 0,
//         time: false,
//         format: 'DD/MM/YYYY'
//     });
////***Date picker *****///

////***Filter button hide and show*****///

$(document).ready(function () {
    $("#btn1").click(function () {
        $("#Create1").toggle();
    });
});

$(document).ready(function () {
    $("#btn2").click(function () {
        $("#Create2").toggle();
    });
});

$(document).ready(function () {
    $("#btn3").click(function () {
        $("#Create3").toggle();
    });
});


////***Filter button hide and show*****///

////***Latest dropdown select2*****///

// $(".lst2").select2({
//   minimumResultsForSearch: 0
// });

function initModalSelect2Ajax(id, url, placeholder, extraOptions) {
    var opts = {
        dropdownParent: $('#LeadsModal'),
        width: '100%',
        placeholder: placeholder,
        allowClear: true,
        minimumInputLength: 0,
        ajax: {
            url: '<?php echo base_url(); ?>index.php/' + url,
            type: 'GET',
            dataType: 'json',
            delay: 250,
            data: function (params) { return { q: params.term || '' }; },
            processResults: function (data) { return { results: data.results }; },
            cache: false
        }
    };
    if (extraOptions) { $.extend(opts, extraOptions); }
    $('#' + id).select2(opts);
}

$(document).ready(function () {
    initModalSelect2Ajax('staff_id_fk1',           'Leads/get_staff_dropdown',           'Select assigned staff');
    initModalSelect2Ajax('country_id_fk',          'Leads/get_country_dropdown',         'Select nationality');
    initModalSelect2Ajax('package_created_by_staff_id', 'Leads/get_staff_dropdown',      'Select created by staff');
    initModalSelect2Ajax('leads_package_category_id_fk', 'Leads/get_packages_category_dropdown', 'Select template category');

    // Source â€” AJAX with fixed '+ Add new' prepended
    $('#source_id_fk1').select2({
        dropdownParent: $('#LeadsModal'),
        width: '100%',
        placeholder: 'Select source',
        allowClear: true,
        minimumInputLength: 0,
        ajax: {
            url: '<?php echo base_url(); ?>index.php/Leads/get_source_dropdown',
            type: 'GET', dataType: 'json', delay: 250, cache: false,
            data: function (params) { return { q: params.term || '' }; },
            processResults: function (data, params) {
                var results = data.results || [];
                if (!params.term) {
                    results = [{ id: '+', text: '+ Add new' }].concat(results);
                }
                return { results: results };
            }
        }
    });

    // Priority status â€” AJAX with fixed '+ Add new' prepended
    $('#priority_status_id_fk').select2({
        dropdownParent: $('#LeadsModal'),
        width: '100%',
        placeholder: 'Select priority status',
        allowClear: true,
        minimumInputLength: 0,
        ajax: {
            url: '<?php echo base_url(); ?>index.php/Leads/get_priority_status_dropdown',
            type: 'GET', dataType: 'json', delay: 250, cache: false,
            data: function (params) { return { q: params.term || '' }; },
            processResults: function (data, params) {
                var results = data.results || [];
                if (!params.term) {
                    results = [{ id: '+', text: '+ Add new' }].concat(results);
                }
                return { results: results };
            }
        }
    });

    $('#date_type').select2({ dropdownParent: $('#LeadsModal'), width: '100%', placeholder: 'Select date type', minimumResultsForSearch: -1 });
    $('#package_id_fk').select2({ dropdownParent: $('#LeadsModal'), width: '100%', placeholder: 'Select template', minimumResultsForSearch: 0 });
    $('#agent_id_fk').select2({ dropdownParent: $('#LeadsB2BModal'), width: '100%', minimumResultsForSearch: 0 });
});


////***Latest dropdown select2*****///

////***searching button*****///

$('#search').click(function () {
        
        $table.ajax.reload();
    });

$( "#guest_name_filter1" ).keypress(function() {
            $table1.ajax.reload();
});

$( "#whats_number_filter1" ).keypress(function() {
            $table1.ajax.reload();
});


$( "#guest_name_filter2" ).keypress(function() {
            $table2.ajax.reload();
});

$( "#whats_number_filter2" ).keypress(function() {
            $table2.ajax.reload();
});

$('#search1').click(function () {
        
        $table1.ajax.reload();
    });

$('#search2').click(function () {
        
        $table2.ajax.reload();
    });

// $( "#b2b_partner_person_name1" ).keypress(function() {
//             $table.ajax.reload();
// });

////***searching button*****///


////***Latest Jquery form validation for adding form*****///
        
$("#form").validate({
            debug: true,
            validClass: "success",
            rules: {
                    
                    // booking_work_order_end_date: { greaterThan: "#booking_work_order_date" }
                
            },
            messages: {
                
            },
            
            highlight: function(element) {
                $(element).closest('.form-group').removeClass('input-success-o').addClass('input-warning-o');
            },
            unhighlight: function(element) {
                $(element).closest('.form-group').removeClass('input-warning-o').addClass('input-success-o');
            },
            success: function(element) {
                $(element).closest('.form-group').removeClass('input-warning-o').addClass('input-success-o');
            },

        });

////***Latest Jquery form validation for adding form*****///


////***Listing table*****///
$('#leads_daterange').daterangepicker({
    autoUpdateInput: false,
    locale: {
        format: 'DD/MM/YYYY',
        cancelLabel: 'Clear'
    }
});

$('#leads_daterange').on('apply.daterangepicker', function(ev, picker) {
    $(this).val(
        picker.startDate.format('DD/MM/YYYY') + ' - ' + picker.endDate.format('DD/MM/YYYY')
    );
});

$('#leads_daterange').on('cancel.daterangepicker', function() {
    $(this).val('');
});


// Travel date
$('#travel_daterange').daterangepicker({
    autoUpdateInput: false,
    locale: {
        format: 'DD/MM/YYYY',
        cancelLabel: 'Clear'
    }
});

$('#travel_daterange').on('apply.daterangepicker', function(ev, picker) {
    $(this).val(
        picker.startDate.format('DD/MM/YYYY') + ' - ' + picker.endDate.format('DD/MM/YYYY')
    );
});

$('#travel_daterange').on('cancel.daterangepicker', function() {
    $(this).val('');
});
var save_method; //for save method string
  $(document).ready(function() {
    
    
    $table1 = $('#B2C_Leads_table').DataTable( {
        "processing": true,
        "serverSide": true,
        "searching": false,
        "aLengthMenu": [[10, 25, 50, -1], [10, 25, 50, "All"]],
        // "bDestroy" : true,
        dom: 'lBfrtip',
            buttons: [
                
                                {
                                    extend: 'excel',
                                    exportOptions: {
                                        columns: [0, 1, 2, 3, 4, 5, 6, 7, 8, 9, 10]
                                    },
                                    title: 'B2C Leads details',
                                },
                                {
                                    extend: 'pdf',
                                    exportOptions: {
                                        columns: [0, 1, 2, 3, 4, 5, 6, 7, 8, 9, 10]
                                    },
                                    title: 'B2C Leads details',
                                },
                                {
                                    extend: 'print',
                                    exportOptions: {
                                        columns: [0, 1, 2, 3, 4, 5, 6, 7, 8, 9, 10]
                                    },
                                    title: 'B2C Leads details',
                                    customize: function ( win ) {
                                    $(win.document.body)
                                      .css( 'font-size', '10pt' )
                                      .prepend(
                                        // '<img src="http://datatables.net/media/images/logo-fade.png" style="position:absolute; top:0; left:0;" />'
                                      );

                                    $(win.document.body).find( 'table' )
                                      .addClass( 'compact' )
                                      .css( 'font-size', 'inherit' );
                                    },
                                },
                               
            ],
        "ajax": {
            "url": "<?php echo base_url();?>index.php/Leads/get_b2c/",
            "type": "POST",
            "data" : function (d) {
                        d.leads_number_filter1 = $("#leads_number_filter1").val();
                        d.staff_id1 = $("#staff_id1").val();
                        d.source_id1 = $("#source_id1").val();
                        d.packages_id1 = $("#packages_id1").val();
                        d.country_id1 = $("#country_id1").val();
                        d.priority_status_id1 = $("#priority_status_id1").val();
                        d.stages_id1 = $("#stages_id1").val();
                        d.lead_type1 = $("#lead_type1").val();
                        d.lead_current_status1 = $("#lead_current_status1").val();
                        d.leads_accomodation_status1 = $("#leads_accomodation_status1").val();
                        d.guest_name_filter1 = $("#guest_name_filter1").val();
                        d.whats_number_filter1 = $("#whats_number_filter1").val();
                        d.leads_createdby_userid1 = $("#leads_createdby_userid1").val();
                        // d.leads_start_date1 = $("#leads_start_date1").val();
                        // d.leads_end_date1 = $("#leads_end_date1").val();
                        // d.travels_start_date1 = $("#travels_start_date1").val();
                        // d.travels_end_date1 = $("#travels_end_date1").val();

                        // Lead date range
                        var leadRange = $("#leads_daterange").val();
                        if (leadRange) {
                            var dates = leadRange.split(' - ');
                            d.leads_start_date1 = dates[0];
                            d.leads_end_date1   = dates[1];
                        } else {
                            d.leads_start_date1 = '';
                            d.leads_end_date1   = '';
                        }

                        // Travel date range
                        var travelRange = $("#travel_daterange").val();
                        if (travelRange) {
                            var dates2 = travelRange.split(' - ');
                            d.travels_start_date1 = dates2[0];
                            d.travels_end_date1   = dates2[1];
                        } else {
                            d.travels_start_date1 = '';
                            d.travels_end_date1   = '';
                        }
           }            
        },
        // "ajax": {
            // "url": "<?php echo site_url('States/get')?>",
            // "type": "POST"
        // },
        "createdRow": function ( row, data, index ) {
          
//            $('td',row).eq(0).html(index+1);
           $table1.column(0).nodes().each(function(node,index,dt){
            $table1.cell(node).data(index+1);
            });
            
            
            $table1.column(8).nodes().each(function(node, index, dt) {
              if($table1.cell(node).data() == '1') {
			  $table1.cell(node).data('<center><span class="badge badge-sm light btn-info">In take</span></center>');
            //   <span class="badge badge-sm light" style="background-color:'.$stages_button.'">'.$stages_name.'</span>
              // if(data['lead_current_status'] == 1){
              // $('td', row).eq(9).html('<span class="badge badge-info">In take</span>');

              if(data['leads_accomodation_status'] == 0 && data['leads_quotation_status'] == 0){
              
                $('td', row).eq(1).html('<a class="leads-number-link" href="javascript:void(0)" onclick="view_lead_details('+data['leads_id']+')">'+data['leads_number']+'</a><br><span class="badge badge-xs badge badge-primary">guest count required</span>');
                // $('td', row).eq(11).html('<div class="dropdown ms-auto text-end"><div class="btn-link" data-bs-toggle="dropdown"><svg width="24px" height="24px" viewBox="0 0 24 24" version="1.1"><g stroke="none" stroke-width="1" fill="none" fill-rule="evenodd"><rect x="0" y="0" width="24" height="24"></rect><circle fill="#000000" cx="5" cy="12" r="2"></circle><circle fill="#000000" cx="12" cy="12" r="2"></circle><circle fill="#000000" cx="19" cy="12" r="2"></circle></g></svg></div><div class="dropdown-menu dropdown-menu-end"><a class="dropdown-item" href="javascript:void(0)" id="rt" onclick="openChangeStatusModal('+data['leads_id']+')">Change stage</a><a class="dropdown-item" href="javascript:void(0)" id="rt" onclick="showStatusModal('+data['leads_id']+')">Show stages</a><a class="dropdown-item" href="javascript:void(0)" id="rt" onclick="openChangeStatus1Modal('+data['leads_id']+')">Change status</a><a class="dropdown-item" href="javascript:void(0)" id="rt" onclick="showStatus1Modal('+data['leads_id']+')">Status history</a><a class="dropdown-item" href="javascript:void(0)" id="rt"  onclick="guset_count_edit('+data['leads_id']+')">Guest count</a><a class="dropdown-item" href="javascript:void(0)" id="rt" onclick="edit_leads('+data['leads_id']+')">Edit</a><a class="dropdown-item" href="javascript:void(0)" id="rt" onclick="view_lead_details('+data['leads_id']+')">view</a><a class="dropdown-item" href="javascript:void(0)" onclick="return delete_leads('+data['leads_id']+')">Delete</a></div></div>');
              
                 let actionHtml = '<div class="dropdown ms-auto text-end"><div class="btn-link" data-bs-toggle="dropdown"><svg width="24px" height="24px" viewBox="0 0 24 24" version="1.1"><g stroke="none" stroke-width="1" fill="none" fill-rule="evenodd"><rect x="0" y="0" width="24" height="24"></rect><circle fill="#000000" cx="5" cy="12" r="2"></circle><circle fill="#000000" cx="12" cy="12" r="2"></circle><circle fill="#000000" cx="19" cy="12" r="2"></circle></g></svg></div><div class="dropdown-menu dropdown-menu-end">';
                // Edit button
                if (hasPermission('LEADS_UPDATE')) {
                    actionHtml += '<a class="dropdown-item" href="javascript:void(0)" id="rt" onclick="edit_leads('+data['leads_id']+')">Edit</a>';
                }

               // Change status button
                if (hasPermission('LEADS_CHANGE_STATUS')) {
                    actionHtml += '<a class="dropdown-item" href="javascript:void(0)" id="rt" onclick="openChangeStatus1Modal('+data['leads_id']+')">Change status</a>';
                }

                // Show status button
                if (hasPermission('LEADS_SHOW_STATUS')) {
                    actionHtml += '<a class="dropdown-item" href="javascript:void(0)" id="rt" onclick="showStatus1Modal('+data['leads_id']+')">Status history</a>';
                }

                // Change stage button
                if (hasPermission('LEADS_CHANGE_STAGE')) {
                    actionHtml += '<a class="dropdown-item" href="javascript:void(0)" id="rt" onclick="openChangeStatusModal('+data['leads_id']+')">Change stage</a>';
                }

                // Show stage button
                if (hasPermission('LEADS_SHOW_STAGE')) {
                    actionHtml += '<a class="dropdown-item" href="javascript:void(0)" id="rt" onclick="showStatusModal('+data['leads_id']+')">Show stages</a>';
                }

                // Guest count button
                if (hasPermission('LEADS_GUEST_COUNT')) {
                    actionHtml += '<a class="dropdown-item" href="javascript:void(0)" id="rt"  onclick="open_guest_count_checked('+data['leads_id']+')">Guest count</a>';
                }

                // Details button
                if (hasPermission('LEADS_DETAILS')) {
                    actionHtml += '<a class="dropdown-item" href="javascript:void(0)" id="rt" onclick="view_lead_details('+data['leads_id']+')">view</a>';
                }

                // Delete button
                if (hasPermission('LEADS_DELETE')) {
                    actionHtml += '<a class="dropdown-item" href="javascript:void(0)" onclick="return delete_leads('+data['leads_id']+')">Delete</a>';
                }

                actionHtml += '</div></div>';

                $('td', row).eq(11).html(actionHtml);

                }
              
              if(data['leads_accomodation_status'] == 1 && data['leads_quotation_status'] == 0){

                // $('td', row).eq(11).html('<div class="dropdown ms-auto text-end"><div class="btn-link" data-bs-toggle="dropdown"><svg width="24px" height="24px" viewBox="0 0 24 24" version="1.1"><g stroke="none" stroke-width="1" fill="none" fill-rule="evenodd"><rect x="0" y="0" width="24" height="24"></rect><circle fill="#000000" cx="5" cy="12" r="2"></circle><circle fill="#000000" cx="12" cy="12" r="2"></circle><circle fill="#000000" cx="19" cy="12" r="2"></circle></g></svg></div><div class="dropdown-menu dropdown-menu-end"><a class="dropdown-item" href="javascript:void(0)" id="rt" onclick="openChangeStatusModal('+data['leads_id']+')">Change stage</a><a class="dropdown-item" href="javascript:void(0)" id="rt" onclick="showStatusModal('+data['leads_id']+')">Show stages</a><a class="dropdown-item" href="javascript:void(0)" id="rt" onclick="openChangeStatus1Modal('+data['leads_id']+')">Change status</a><a class="dropdown-item" href="javascript:void(0)" id="rt" onclick="showStatus1Modal('+data['leads_id']+')">Status history</a><a class="dropdown-item" href="javascript:void(0)" id="rt"  onclick="guset_count_edit('+data['leads_id']+')">Guest count</a><a class="dropdown-item" href="javascript:void(0)" id="rt"  onclick="accomodation_plan('+data['leads_id']+')">Accomodation plan</a><a class="dropdown-item" href="javascript:void(0)" id="rt" onclick="edit_leads('+data['leads_id']+')">Edit</a><a class="dropdown-item" href="javascript:void(0)" id="rt" onclick="view_lead_details('+data['leads_id']+')">view</a><a class="dropdown-item" href="javascript:void(0)" onclick="return delete_leads('+data['leads_id']+')">Delete</a></div></div>');

                $('td', row).eq(1).html('<a class="leads-number-link" href="javascript:void(0)" onclick="view_lead_details('+data['leads_id']+')">'+data['leads_number']+'</a><br><span class="badge badge-xs badge badge-warning">accommodation required</span>');

                let actionHtml = '<div class="dropdown ms-auto text-end"><div class="btn-link" data-bs-toggle="dropdown"><svg width="24px" height="24px" viewBox="0 0 24 24" version="1.1"><g stroke="none" stroke-width="1" fill="none" fill-rule="evenodd"><rect x="0" y="0" width="24" height="24"></rect><circle fill="#000000" cx="5" cy="12" r="2"></circle><circle fill="#000000" cx="12" cy="12" r="2"></circle><circle fill="#000000" cx="19" cy="12" r="2"></circle></g></svg></div><div class="dropdown-menu dropdown-menu-end">';
                
                // Edit button
                if (hasPermission('LEADS_UPDATE')) {
                    actionHtml += '<a class="dropdown-item" href="javascript:void(0)" id="rt" onclick="edit_leads('+data['leads_id']+')">Edit</a>';
                }

               // Change status button
                if (hasPermission('LEADS_CHANGE_STATUS')) {
                    actionHtml += '<a class="dropdown-item" href="javascript:void(0)" id="rt" onclick="openChangeStatus1Modal('+data['leads_id']+')">Change status</a>';
                }

                // Show status button
                if (hasPermission('LEADS_SHOW_STATUS')) {
                    actionHtml += '<a class="dropdown-item" href="javascript:void(0)" id="rt" onclick="showStatus1Modal('+data['leads_id']+')">Status history</a>';
                }

                // Change stage button
                if (hasPermission('LEADS_CHANGE_STAGE')) {
                    actionHtml += '<a class="dropdown-item" href="javascript:void(0)" id="rt" onclick="openChangeStatusModal('+data['leads_id']+')">Change stage</a>';
                }

                // Show stage button
                if (hasPermission('LEADS_SHOW_STAGE')) {
                    actionHtml += '<a class="dropdown-item" href="javascript:void(0)" id="rt" onclick="showStatusModal('+data['leads_id']+')">Show stages</a>';
                }

                // Guest count button
                if (hasPermission('LEADS_GUEST_COUNT')) {
                    actionHtml += '<a class="dropdown-item" href="javascript:void(0)" id="rt"  onclick="open_guest_count_checked('+data['leads_id']+')">Guest count</a>';
                }

                 // Accomodation plan button
                if (hasPermission('LEADS_ACCOMODATION_PLAN')) {
                    actionHtml += '<a class="dropdown-item" href="javascript:void(0)" id="rt"  onclick="open_accommodation_checked('+data['leads_id']+')">Accomodation plan</a>';
                }

                // Details button
                if (hasPermission('LEADS_DETAILS')) {
                    actionHtml += '<a class="dropdown-item" href="javascript:void(0)" id="rt" onclick="view_lead_details('+data['leads_id']+')">view</a>';
                }

                // Delete button
                if (hasPermission('LEADS_DELETE')) {
                    actionHtml += '<a class="dropdown-item" href="javascript:void(0)" onclick="return delete_leads('+data['leads_id']+')">Delete</a>';
                }

                actionHtml += '</div></div>';

                $('td', row).eq(11).html(actionHtml);

                }

              if(data['leads_accomodation_status'] == 2 && data['leads_quotation_status'] == 0){

                // $('td', row).eq(11).html('<div class="dropdown ms-auto text-end"><div class="btn-link" data-bs-toggle="dropdown"><svg width="24px" height="24px" viewBox="0 0 24 24" version="1.1"><g stroke="none" stroke-width="1" fill="none" fill-rule="evenodd"><rect x="0" y="0" width="24" height="24"></rect><circle fill="#000000" cx="5" cy="12" r="2"></circle><circle fill="#000000" cx="12" cy="12" r="2"></circle><circle fill="#000000" cx="19" cy="12" r="2"></circle></g></svg></div><div class="dropdown-menu dropdown-menu-end"><a class="dropdown-item" href="javascript:void(0)" id="rt" onclick="openChangeStatusModal('+data['leads_id']+')">Change stage</a><a class="dropdown-item" href="javascript:void(0)" id="rt" onclick="showStatusModal('+data['leads_id']+')">Show stages</a><a class="dropdown-item" href="javascript:void(0)" id="rt" onclick="openChangeStatus1Modal('+data['leads_id']+')">Change status</a><a class="dropdown-item" href="javascript:void(0)" id="rt" onclick="showStatus1Modal('+data['leads_id']+')">Status history</a><a class="dropdown-item" href="javascript:void(0)" id="rt"  onclick="guset_count_edit('+data['leads_id']+')">Guest count</a><a class="dropdown-item" href="javascript:void(0)" id="rt"  onclick="accomodation_plan('+data['leads_id']+')">Accomodation plan</a><a class="dropdown-item" href="javascript:void(0)" id="rt" onclick="open_quotation('+data['leads_id']+')">Quotation</a><a class="dropdown-item" href="javascript:void(0)" id="rt" onclick="edit_leads('+data['leads_id']+')">Edit</a><a class="dropdown-item" href="javascript:void(0)" id="rt" onclick="view_lead_details('+data['leads_id']+')">view</a><a class="dropdown-item" href="javascript:void(0)" onclick="return delete_leads('+data['leads_id']+')">Delete</a></div></div>');

                $('td', row).eq(1).html('<a class="leads-number-link" href="javascript:void(0)" onclick="view_lead_details('+data['leads_id']+')">'+data['leads_number']+'</a><br><span class="badge badge-xs badge badge-info">Quotation not created</span>');

                let actionHtml = '<div class="dropdown ms-auto text-end"><div class="btn-link" data-bs-toggle="dropdown"><svg width="24px" height="24px" viewBox="0 0 24 24" version="1.1"><g stroke="none" stroke-width="1" fill="none" fill-rule="evenodd"><rect x="0" y="0" width="24" height="24"></rect><circle fill="#000000" cx="5" cy="12" r="2"></circle><circle fill="#000000" cx="12" cy="12" r="2"></circle><circle fill="#000000" cx="19" cy="12" r="2"></circle></g></svg></div><div class="dropdown-menu dropdown-menu-end">';
                
                // Edit button
                if (hasPermission('LEADS_UPDATE')) {
                    actionHtml += '<a class="dropdown-item" href="javascript:void(0)" id="rt" onclick="edit_leads('+data['leads_id']+')">Edit</a>';
                }

               // Change status button
                if (hasPermission('LEADS_CHANGE_STATUS')) {
                    actionHtml += '<a class="dropdown-item" href="javascript:void(0)" id="rt" onclick="openChangeStatus1Modal('+data['leads_id']+')">Change status</a>';
                }

                // Show status button
                if (hasPermission('LEADS_SHOW_STATUS')) {
                    actionHtml += '<a class="dropdown-item" href="javascript:void(0)" id="rt" onclick="showStatus1Modal('+data['leads_id']+')">Status history</a>';
                }

                // Change stage button
                if (hasPermission('LEADS_CHANGE_STAGE')) {
                    actionHtml += '<a class="dropdown-item" href="javascript:void(0)" id="rt" onclick="openChangeStatusModal('+data['leads_id']+')">Change stage</a>';
                }

                // Show stage button
                if (hasPermission('LEADS_SHOW_STAGE')) {
                    actionHtml += '<a class="dropdown-item" href="javascript:void(0)" id="rt" onclick="showStatusModal('+data['leads_id']+')">Show stages</a>';
                }

                // Guest count button
                if (hasPermission('LEADS_GUEST_COUNT')) {
                    actionHtml += '<a class="dropdown-item" href="javascript:void(0)" id="rt"  onclick="open_guest_count_checked('+data['leads_id']+')">Guest count</a>';
                }

                // Accomodation plan button
                if (hasPermission('LEADS_ACCOMODATION_PLAN')) {
                    actionHtml += '<a class="dropdown-item" href="javascript:void(0)" id="rt"  onclick="open_accommodation_checked('+data['leads_id']+')">Accomodation plan</a>';
                }

                // Quotation button
                if (hasPermission('LEADS_QUOTATION')) {
                    actionHtml += '<a class="dropdown-item" href="javascript:void(0)" id="rt" onclick="open_quotation('+data['leads_id']+')">Quotation</a>';
                }

                // Details button
                if (hasPermission('LEADS_DETAILS')) {
                    actionHtml += '<a class="dropdown-item" href="javascript:void(0)" id="rt" onclick="view_lead_details('+data['leads_id']+')">view</a>';
                }

                // Delete button
                if (hasPermission('LEADS_DELETE')) {
                    actionHtml += '<a class="dropdown-item" href="javascript:void(0)" onclick="return delete_leads('+data['leads_id']+')">Delete</a>';
                }

                actionHtml += '</div></div>';

                $('td', row).eq(11).html(actionHtml);

              }
              renderRejectedQuotationRow(data, row);
              renderQuotationCreatedRow(data, row);
              renderCancelledQuotationRow(data, row);
              if(data['leads_accomodation_status'] == 2 && data['leads_quotation_status'] == 1){

                    // $('td', row).eq(11).html('<div class="dropdown ms-auto text-end"><div class="btn-link" data-bs-toggle="dropdown"><svg width="24px" height="24px" viewBox="0 0 24 24" version="1.1"><g stroke="none" stroke-width="1" fill="none" fill-rule="evenodd"><rect x="0" y="0" width="24" height="24"></rect><circle fill="#000000" cx="5" cy="12" r="2"></circle><circle fill="#000000" cx="12" cy="12" r="2"></circle><circle fill="#000000" cx="19" cy="12" r="2"></circle></g></svg></div><div class="dropdown-menu dropdown-menu-end"><a class="dropdown-item" href="javascript:void(0)" id="rt" onclick="openChangeStatusModal('+data['leads_id']+')">Change stage</a><a class="dropdown-item" href="javascript:void(0)" id="rt" onclick="showStatusModal('+data['leads_id']+')">Show stages</a><a class="dropdown-item" href="javascript:void(0)" id="rt" onclick="openChangeStatus1Modal('+data['leads_id']+')">Change status</a><a class="dropdown-item" href="javascript:void(0)" id="rt" onclick="showStatus1Modal('+data['leads_id']+')">Status history</a><a class="dropdown-item" href="javascript:void(0)" id="rt" onclick="edit_leads('+data['leads_id']+')">Edit</a><a class="dropdown-item" href="javascript:void(0)" id="rt" onclick="view_lead_details('+data['leads_id']+')">view</a><a class="dropdown-item" href="javascript:void(0)" onclick="return delete_leads('+data['leads_id']+')">Delete</a></div></div>');

                    $('td', row).eq(1).html('<a class="leads-number-link" href="javascript:void(0)" onclick="view_lead_details('+data['leads_id']+')">'+data['leads_number']+'</a><br><span class="badge badge-xs badge badge-success">Quotation created</span>');

                    let actionHtml = '<div class="dropdown ms-auto text-end"><div class="btn-link" data-bs-toggle="dropdown"><svg width="24px" height="24px" viewBox="0 0 24 24" version="1.1"><g stroke="none" stroke-width="1" fill="none" fill-rule="evenodd"><rect x="0" y="0" width="24" height="24"></rect><circle fill="#000000" cx="5" cy="12" r="2"></circle><circle fill="#000000" cx="12" cy="12" r="2"></circle><circle fill="#000000" cx="19" cy="12" r="2"></circle></g></svg></div><div class="dropdown-menu dropdown-menu-end">';
                
                // Edit button
                if (hasPermission('LEADS_UPDATE')) {
                    actionHtml += '<a class="dropdown-item" href="javascript:void(0)" id="rt" onclick="edit_leads('+data['leads_id']+')">Edit</a>';
                }

               // Change status button
                if (hasPermission('LEADS_CHANGE_STATUS')) {
                    actionHtml += '<a class="dropdown-item" href="javascript:void(0)" id="rt" onclick="openChangeStatus1Modal('+data['leads_id']+')">Change status</a>';
                }

                // Show status button
                if (hasPermission('LEADS_SHOW_STATUS')) {
                    actionHtml += '<a class="dropdown-item" href="javascript:void(0)" id="rt" onclick="showStatus1Modal('+data['leads_id']+')">Status history</a>';
                }

                // Change stage button
                if (hasPermission('LEADS_CHANGE_STAGE')) {
                    actionHtml += '<a class="dropdown-item" href="javascript:void(0)" id="rt" onclick="openChangeStatusModal('+data['leads_id']+')">Change stage</a>';
                }

                // Show stage button
                if (hasPermission('LEADS_SHOW_STAGE')) {
                    actionHtml += '<a class="dropdown-item" href="javascript:void(0)" id="rt" onclick="showStatusModal('+data['leads_id']+')">Show stages</a>';
                }

                // Details button
                if (hasPermission('LEADS_DETAILS')) {
                    actionHtml += '<a class="dropdown-item" href="javascript:void(0)" id="rt" onclick="view_lead_details('+data['leads_id']+')">view</a>';
                }

                // Delete button
                if (hasPermission('LEADS_DELETE')) {
                    actionHtml += '<a class="dropdown-item" href="javascript:void(0)" onclick="return delete_leads('+data['leads_id']+')">Delete</a>';
                }

                actionHtml += '</div></div>';

                $('td', row).eq(11).html(actionHtml);
              }
              if(data['leads_accomodation_status'] == 2 && data['leads_quotation_status'] == 2){

                    // $('td', row).eq(11).html('<div class="dropdown ms-auto text-end"><div class="btn-link" data-bs-toggle="dropdown"><svg width="24px" height="24px" viewBox="0 0 24 24" version="1.1"><g stroke="none" stroke-width="1" fill="none" fill-rule="evenodd"><rect x="0" y="0" width="24" height="24"></rect><circle fill="#000000" cx="5" cy="12" r="2"></circle><circle fill="#000000" cx="12" cy="12" r="2"></circle><circle fill="#000000" cx="19" cy="12" r="2"></circle></g></svg></div><div class="dropdown-menu dropdown-menu-end"><a class="dropdown-item" href="javascript:void(0)" id="rt" onclick="openChangeStatusModal('+data['leads_id']+')">Change stage</a><a class="dropdown-item" href="javascript:void(0)" id="rt" onclick="showStatusModal('+data['leads_id']+')">Show stages</a><a class="dropdown-item" href="javascript:void(0)" id="rt" onclick="openChangeStatus1Modal('+data['leads_id']+')">Change status</a><a class="dropdown-item" href="javascript:void(0)" id="rt" onclick="showStatus1Modal('+data['leads_id']+')">Status history</a><a class="dropdown-item" href="javascript:void(0)" id="rt" onclick="edit_leads('+data['leads_id']+')">Edit</a><a class="dropdown-item" href="javascript:void(0)" id="rt" onclick="view_lead_details('+data['leads_id']+')">view</a><a class="dropdown-item" href="javascript:void(0)" onclick="return delete_leads('+data['leads_id']+')">Delete</a></div></div>');

                    $('td', row).eq(1).html('<a class="leads-number-link" href="javascript:void(0)" onclick="view_lead_details('+data['leads_id']+')">'+data['leads_number']+'</a><br><span class="badge badge-xs badge badge-danger">Cancelled/Quotation not created</span>');

                    let actionHtml = '<div class="dropdown ms-auto text-end"><div class="btn-link" data-bs-toggle="dropdown"><svg width="24px" height="24px" viewBox="0 0 24 24" version="1.1"><g stroke="none" stroke-width="1" fill="none" fill-rule="evenodd"><rect x="0" y="0" width="24" height="24"></rect><circle fill="#000000" cx="5" cy="12" r="2"></circle><circle fill="#000000" cx="12" cy="12" r="2"></circle><circle fill="#000000" cx="19" cy="12" r="2"></circle></g></svg></div><div class="dropdown-menu dropdown-menu-end">';
                
                // Edit button
                if (hasPermission('LEADS_UPDATE')) {
                    actionHtml += '<a class="dropdown-item" href="javascript:void(0)" id="rt" onclick="edit_leads('+data['leads_id']+')">Edit</a>';
                }

               // Change status button
                if (hasPermission('LEADS_CHANGE_STATUS')) {
                    actionHtml += '<a class="dropdown-item" href="javascript:void(0)" id="rt" onclick="openChangeStatus1Modal('+data['leads_id']+')">Change status</a>';
                }

                // Show status button
                if (hasPermission('LEADS_SHOW_STATUS')) {
                    actionHtml += '<a class="dropdown-item" href="javascript:void(0)" id="rt" onclick="showStatus1Modal('+data['leads_id']+')">Status history</a>';
                }

                // Change stage button
                if (hasPermission('LEADS_CHANGE_STAGE')) {
                    actionHtml += '<a class="dropdown-item" href="javascript:void(0)" id="rt" onclick="openChangeStatusModal('+data['leads_id']+')">Change stage</a>';
                }

                // Show stage button
                if (hasPermission('LEADS_SHOW_STAGE')) {
                    actionHtml += '<a class="dropdown-item" href="javascript:void(0)" id="rt" onclick="showStatusModal('+data['leads_id']+')">Show stages</a>';
                }

                // Guest count button
                if (hasPermission('LEADS_GUEST_COUNT')) {
                    actionHtml += '<a class="dropdown-item" href="javascript:void(0)" id="rt"  onclick="open_guest_count_checked('+data['leads_id']+')">Guest count</a>';
                }

                // Accomodation plan button
                if (hasPermission('LEADS_ACCOMODATION_PLAN')) {
                    actionHtml += '<a class="dropdown-item" href="javascript:void(0)" id="rt"  onclick="open_accommodation_checked('+data['leads_id']+')">Accomodation plan</a>';
                }

                // Quotation button
                if (hasPermission('LEADS_QUOTATION')) {
                    actionHtml += '<a class="dropdown-item" href="javascript:void(0)" id="rt" onclick="open_quotation('+data['leads_id']+')">Quotation</a>';
                }

                // Details button
                if (hasPermission('LEADS_DETAILS')) {
                    actionHtml += '<a class="dropdown-item" href="javascript:void(0)" id="rt" onclick="view_lead_details('+data['leads_id']+')">view</a>';
                }

                // Delete button
                if (hasPermission('LEADS_DELETE')) {
                    actionHtml += '<a class="dropdown-item" href="javascript:void(0)" onclick="return delete_leads('+data['leads_id']+')">Delete</a>';
                }

                actionHtml += '</div></div>';

                $('td', row).eq(11).html(actionHtml);
              }
              renderRejectedQuotationRow(data, row);
            }
            else if($table1.cell(node).data() == '2') {
					    $table1.cell(node).data('<center><span class="badge badge-sm light btn-secondary">Qualified</span></center>');
            // else if(data['lead_current_status'] == 2){
            //   $('td', row).eq(9).html('<span class="badge badge-secondary">Qualified</span>');

              if(data['leads_accomodation_status'] == 0 && data['leads_quotation_status'] == 0){
              
                $('td', row).eq(1).html('<a class="leads-number-link" href="javascript:void(0)" onclick="view_lead_details('+data['leads_id']+')">'+data['leads_number']+'</a><br><span class="badge badge-xs badge badge-primary">guest count required</span>');
                // $('td', row).eq(11).html('<div class="dropdown ms-auto text-end"><div class="btn-link" data-bs-toggle="dropdown"><svg width="24px" height="24px" viewBox="0 0 24 24" version="1.1"><g stroke="none" stroke-width="1" fill="none" fill-rule="evenodd"><rect x="0" y="0" width="24" height="24"></rect><circle fill="#000000" cx="5" cy="12" r="2"></circle><circle fill="#000000" cx="12" cy="12" r="2"></circle><circle fill="#000000" cx="19" cy="12" r="2"></circle></g></svg></div><div class="dropdown-menu dropdown-menu-end"><a class="dropdown-item" href="javascript:void(0)" id="rt" onclick="openChangeStatusModal('+data['leads_id']+')">Change stage</a><a class="dropdown-item" href="javascript:void(0)" id="rt" onclick="showStatusModal('+data['leads_id']+')">Show stages</a><a class="dropdown-item" href="javascript:void(0)" id="rt" onclick="openChangeStatus1Modal('+data['leads_id']+')">Change status</a><a class="dropdown-item" href="javascript:void(0)" id="rt" onclick="showStatus1Modal('+data['leads_id']+')">Status history</a><a class="dropdown-item" href="javascript:void(0)" id="rt"  onclick="guset_count_edit('+data['leads_id']+')">Guest count</a><a class="dropdown-item" href="javascript:void(0)" id="rt" onclick="edit_leads('+data['leads_id']+')">Edit</a><a class="dropdown-item" href="javascript:void(0)" id="rt" onclick="view_lead_details('+data['leads_id']+')">view</a><a class="dropdown-item" href="javascript:void(0)" onclick="return delete_leads('+data['leads_id']+')">Delete</a></div></div>');
              
                 let actionHtml = '<div class="dropdown ms-auto text-end"><div class="btn-link" data-bs-toggle="dropdown"><svg width="24px" height="24px" viewBox="0 0 24 24" version="1.1"><g stroke="none" stroke-width="1" fill="none" fill-rule="evenodd"><rect x="0" y="0" width="24" height="24"></rect><circle fill="#000000" cx="5" cy="12" r="2"></circle><circle fill="#000000" cx="12" cy="12" r="2"></circle><circle fill="#000000" cx="19" cy="12" r="2"></circle></g></svg></div><div class="dropdown-menu dropdown-menu-end">';
                // Edit button
                if (hasPermission('LEADS_UPDATE')) {
                    actionHtml += '<a class="dropdown-item" href="javascript:void(0)" id="rt" onclick="edit_leads('+data['leads_id']+')">Edit</a>';
                }

               // Change status button
                if (hasPermission('LEADS_CHANGE_STATUS')) {
                    actionHtml += '<a class="dropdown-item" href="javascript:void(0)" id="rt" onclick="openChangeStatus1Modal('+data['leads_id']+')">Change status</a>';
                }

                // Show status button
                if (hasPermission('LEADS_SHOW_STATUS')) {
                    actionHtml += '<a class="dropdown-item" href="javascript:void(0)" id="rt" onclick="showStatus1Modal('+data['leads_id']+')">Status history</a>';
                }

                // Change stage button
                if (hasPermission('LEADS_CHANGE_STAGE')) {
                    actionHtml += '<a class="dropdown-item" href="javascript:void(0)" id="rt" onclick="openChangeStatusModal('+data['leads_id']+')">Change stage</a>';
                }

                // Show stage button
                if (hasPermission('LEADS_SHOW_STAGE')) {
                    actionHtml += '<a class="dropdown-item" href="javascript:void(0)" id="rt" onclick="showStatusModal('+data['leads_id']+')">Show stages</a>';
                }

                // Guest count button
                if (hasPermission('LEADS_GUEST_COUNT')) {
                    actionHtml += '<a class="dropdown-item" href="javascript:void(0)" id="rt"  onclick="open_guest_count_checked('+data['leads_id']+')">Guest count</a>';
                }

                // Details button
                if (hasPermission('LEADS_DETAILS')) {
                    actionHtml += '<a class="dropdown-item" href="javascript:void(0)" id="rt" onclick="view_lead_details('+data['leads_id']+')">view</a>';
                }

                // Delete button
                if (hasPermission('LEADS_DELETE')) {
                    actionHtml += '<a class="dropdown-item" href="javascript:void(0)" onclick="return delete_leads('+data['leads_id']+')">Delete</a>';
                }

                actionHtml += '</div></div>';

                $('td', row).eq(11).html(actionHtml);

                }
              
              if(data['leads_accomodation_status'] == 1 && data['leads_quotation_status'] == 0){

                // $('td', row).eq(11).html('<div class="dropdown ms-auto text-end"><div class="btn-link" data-bs-toggle="dropdown"><svg width="24px" height="24px" viewBox="0 0 24 24" version="1.1"><g stroke="none" stroke-width="1" fill="none" fill-rule="evenodd"><rect x="0" y="0" width="24" height="24"></rect><circle fill="#000000" cx="5" cy="12" r="2"></circle><circle fill="#000000" cx="12" cy="12" r="2"></circle><circle fill="#000000" cx="19" cy="12" r="2"></circle></g></svg></div><div class="dropdown-menu dropdown-menu-end"><a class="dropdown-item" href="javascript:void(0)" id="rt" onclick="openChangeStatusModal('+data['leads_id']+')">Change stage</a><a class="dropdown-item" href="javascript:void(0)" id="rt" onclick="showStatusModal('+data['leads_id']+')">Show stages</a><a class="dropdown-item" href="javascript:void(0)" id="rt" onclick="openChangeStatus1Modal('+data['leads_id']+')">Change status</a><a class="dropdown-item" href="javascript:void(0)" id="rt" onclick="showStatus1Modal('+data['leads_id']+')">Status history</a><a class="dropdown-item" href="javascript:void(0)" id="rt"  onclick="guset_count_edit('+data['leads_id']+')">Guest count</a><a class="dropdown-item" href="javascript:void(0)" id="rt"  onclick="accomodation_plan('+data['leads_id']+')">Accomodation plan</a><a class="dropdown-item" href="javascript:void(0)" id="rt" onclick="edit_leads('+data['leads_id']+')">Edit</a><a class="dropdown-item" href="javascript:void(0)" id="rt" onclick="view_lead_details('+data['leads_id']+')">view</a><a class="dropdown-item" href="javascript:void(0)" onclick="return delete_leads('+data['leads_id']+')">Delete</a></div></div>');

                $('td', row).eq(1).html('<a class="leads-number-link" href="javascript:void(0)" onclick="view_lead_details('+data['leads_id']+')">'+data['leads_number']+'</a><br><span class="badge badge-xs badge badge-warning">accommodation required</span>');

                let actionHtml = '<div class="dropdown ms-auto text-end"><div class="btn-link" data-bs-toggle="dropdown"><svg width="24px" height="24px" viewBox="0 0 24 24" version="1.1"><g stroke="none" stroke-width="1" fill="none" fill-rule="evenodd"><rect x="0" y="0" width="24" height="24"></rect><circle fill="#000000" cx="5" cy="12" r="2"></circle><circle fill="#000000" cx="12" cy="12" r="2"></circle><circle fill="#000000" cx="19" cy="12" r="2"></circle></g></svg></div><div class="dropdown-menu dropdown-menu-end">';
                
                // Edit button
                if (hasPermission('LEADS_UPDATE')) {
                    actionHtml += '<a class="dropdown-item" href="javascript:void(0)" id="rt" onclick="edit_leads('+data['leads_id']+')">Edit</a>';
                }

               // Change status button
                if (hasPermission('LEADS_CHANGE_STATUS')) {
                    actionHtml += '<a class="dropdown-item" href="javascript:void(0)" id="rt" onclick="openChangeStatus1Modal('+data['leads_id']+')">Change status</a>';
                }

                // Show status button
                if (hasPermission('LEADS_SHOW_STATUS')) {
                    actionHtml += '<a class="dropdown-item" href="javascript:void(0)" id="rt" onclick="showStatus1Modal('+data['leads_id']+')">Status history</a>';
                }

                // Change stage button
                if (hasPermission('LEADS_CHANGE_STAGE')) {
                    actionHtml += '<a class="dropdown-item" href="javascript:void(0)" id="rt" onclick="openChangeStatusModal('+data['leads_id']+')">Change stage</a>';
                }

                // Show stage button
                if (hasPermission('LEADS_SHOW_STAGE')) {
                    actionHtml += '<a class="dropdown-item" href="javascript:void(0)" id="rt" onclick="showStatusModal('+data['leads_id']+')">Show stages</a>';
                }

                // Guest count button
                if (hasPermission('LEADS_GUEST_COUNT')) {
                    actionHtml += '<a class="dropdown-item" href="javascript:void(0)" id="rt"  onclick="open_guest_count_checked('+data['leads_id']+')">Guest count</a>';
                }

                 // Accomodation plan button
                if (hasPermission('LEADS_ACCOMODATION_PLAN')) {
                    actionHtml += '<a class="dropdown-item" href="javascript:void(0)" id="rt"  onclick="open_accommodation_checked('+data['leads_id']+')">Accomodation plan</a>';
                }

                // Details button
                if (hasPermission('LEADS_DETAILS')) {
                    actionHtml += '<a class="dropdown-item" href="javascript:void(0)" id="rt" onclick="view_lead_details('+data['leads_id']+')">view</a>';
                }

                // Delete button
                if (hasPermission('LEADS_DELETE')) {
                    actionHtml += '<a class="dropdown-item" href="javascript:void(0)" onclick="return delete_leads('+data['leads_id']+')">Delete</a>';
                }

                actionHtml += '</div></div>';

                $('td', row).eq(11).html(actionHtml);

                }

              if(data['leads_accomodation_status'] == 2 && data['leads_quotation_status'] == 0){

                // $('td', row).eq(11).html('<div class="dropdown ms-auto text-end"><div class="btn-link" data-bs-toggle="dropdown"><svg width="24px" height="24px" viewBox="0 0 24 24" version="1.1"><g stroke="none" stroke-width="1" fill="none" fill-rule="evenodd"><rect x="0" y="0" width="24" height="24"></rect><circle fill="#000000" cx="5" cy="12" r="2"></circle><circle fill="#000000" cx="12" cy="12" r="2"></circle><circle fill="#000000" cx="19" cy="12" r="2"></circle></g></svg></div><div class="dropdown-menu dropdown-menu-end"><a class="dropdown-item" href="javascript:void(0)" id="rt" onclick="openChangeStatusModal('+data['leads_id']+')">Change stage</a><a class="dropdown-item" href="javascript:void(0)" id="rt" onclick="showStatusModal('+data['leads_id']+')">Show stages</a><a class="dropdown-item" href="javascript:void(0)" id="rt" onclick="openChangeStatus1Modal('+data['leads_id']+')">Change status</a><a class="dropdown-item" href="javascript:void(0)" id="rt" onclick="showStatus1Modal('+data['leads_id']+')">Status history</a><a class="dropdown-item" href="javascript:void(0)" id="rt"  onclick="guset_count_edit('+data['leads_id']+')">Guest count</a><a class="dropdown-item" href="javascript:void(0)" id="rt"  onclick="accomodation_plan('+data['leads_id']+')">Accomodation plan</a><a class="dropdown-item" href="javascript:void(0)" id="rt" onclick="open_quotation('+data['leads_id']+')">Quotation</a><a class="dropdown-item" href="javascript:void(0)" id="rt" onclick="edit_leads('+data['leads_id']+')">Edit</a><a class="dropdown-item" href="javascript:void(0)" id="rt" onclick="view_lead_details('+data['leads_id']+')">view</a><a class="dropdown-item" href="javascript:void(0)" onclick="return delete_leads('+data['leads_id']+')">Delete</a></div></div>');

                $('td', row).eq(1).html('<a class="leads-number-link" href="javascript:void(0)" onclick="view_lead_details('+data['leads_id']+')">'+data['leads_number']+'</a><br><span class="badge badge-xs badge badge-info">Quotation not created</span>');

                let actionHtml = '<div class="dropdown ms-auto text-end"><div class="btn-link" data-bs-toggle="dropdown"><svg width="24px" height="24px" viewBox="0 0 24 24" version="1.1"><g stroke="none" stroke-width="1" fill="none" fill-rule="evenodd"><rect x="0" y="0" width="24" height="24"></rect><circle fill="#000000" cx="5" cy="12" r="2"></circle><circle fill="#000000" cx="12" cy="12" r="2"></circle><circle fill="#000000" cx="19" cy="12" r="2"></circle></g></svg></div><div class="dropdown-menu dropdown-menu-end">';
                
                // Edit button
                if (hasPermission('LEADS_UPDATE')) {
                    actionHtml += '<a class="dropdown-item" href="javascript:void(0)" id="rt" onclick="edit_leads('+data['leads_id']+')">Edit</a>';
                }

               // Change status button
                if (hasPermission('LEADS_CHANGE_STATUS')) {
                    actionHtml += '<a class="dropdown-item" href="javascript:void(0)" id="rt" onclick="openChangeStatus1Modal('+data['leads_id']+')">Change status</a>';
                }

                // Show status button
                if (hasPermission('LEADS_SHOW_STATUS')) {
                    actionHtml += '<a class="dropdown-item" href="javascript:void(0)" id="rt" onclick="showStatus1Modal('+data['leads_id']+')">Status history</a>';
                }

                // Change stage button
                if (hasPermission('LEADS_CHANGE_STAGE')) {
                    actionHtml += '<a class="dropdown-item" href="javascript:void(0)" id="rt" onclick="openChangeStatusModal('+data['leads_id']+')">Change stage</a>';
                }

                // Show stage button
                if (hasPermission('LEADS_SHOW_STAGE')) {
                    actionHtml += '<a class="dropdown-item" href="javascript:void(0)" id="rt" onclick="showStatusModal('+data['leads_id']+')">Show stages</a>';
                }

                // Guest count button
                if (hasPermission('LEADS_GUEST_COUNT')) {
                    actionHtml += '<a class="dropdown-item" href="javascript:void(0)" id="rt"  onclick="open_guest_count_checked('+data['leads_id']+')">Guest count</a>';
                }

                // Accomodation plan button
                if (hasPermission('LEADS_ACCOMODATION_PLAN')) {
                    actionHtml += '<a class="dropdown-item" href="javascript:void(0)" id="rt"  onclick="open_accommodation_checked('+data['leads_id']+')">Accomodation plan</a>';
                }

                // Quotation button
                if (hasPermission('LEADS_QUOTATION')) {
                    actionHtml += '<a class="dropdown-item" href="javascript:void(0)" id="rt" onclick="open_quotation('+data['leads_id']+')">Quotation</a>';
                }

                // Details button
                if (hasPermission('LEADS_DETAILS')) {
                    actionHtml += '<a class="dropdown-item" href="javascript:void(0)" id="rt" onclick="view_lead_details('+data['leads_id']+')">view</a>';
                }

                // Delete button
                if (hasPermission('LEADS_DELETE')) {
                    actionHtml += '<a class="dropdown-item" href="javascript:void(0)" onclick="return delete_leads('+data['leads_id']+')">Delete</a>';
                }

                actionHtml += '</div></div>';

                $('td', row).eq(11).html(actionHtml);

              }
              renderRejectedQuotationRow(data, row);
              renderQuotationCreatedRow(data, row);
              renderCancelledQuotationRow(data, row);
              if(data['leads_accomodation_status'] == 2 && data['leads_quotation_status'] == 1){

                    // $('td', row).eq(11).html('<div class="dropdown ms-auto text-end"><div class="btn-link" data-bs-toggle="dropdown"><svg width="24px" height="24px" viewBox="0 0 24 24" version="1.1"><g stroke="none" stroke-width="1" fill="none" fill-rule="evenodd"><rect x="0" y="0" width="24" height="24"></rect><circle fill="#000000" cx="5" cy="12" r="2"></circle><circle fill="#000000" cx="12" cy="12" r="2"></circle><circle fill="#000000" cx="19" cy="12" r="2"></circle></g></svg></div><div class="dropdown-menu dropdown-menu-end"><a class="dropdown-item" href="javascript:void(0)" id="rt" onclick="openChangeStatusModal('+data['leads_id']+')">Change stage</a><a class="dropdown-item" href="javascript:void(0)" id="rt" onclick="showStatusModal('+data['leads_id']+')">Show stages</a><a class="dropdown-item" href="javascript:void(0)" id="rt" onclick="openChangeStatus1Modal('+data['leads_id']+')">Change status</a><a class="dropdown-item" href="javascript:void(0)" id="rt" onclick="showStatus1Modal('+data['leads_id']+')">Status history</a><a class="dropdown-item" href="javascript:void(0)" id="rt" onclick="edit_leads('+data['leads_id']+')">Edit</a><a class="dropdown-item" href="javascript:void(0)" id="rt" onclick="view_lead_details('+data['leads_id']+')">view</a><a class="dropdown-item" href="javascript:void(0)" onclick="return delete_leads('+data['leads_id']+')">Delete</a></div></div>');

                    $('td', row).eq(1).html('<a class="leads-number-link" href="javascript:void(0)" onclick="view_lead_details('+data['leads_id']+')">'+data['leads_number']+'</a><br><span class="badge badge-xs badge badge-success">Quotation created</span>');

                    let actionHtml = '<div class="dropdown ms-auto text-end"><div class="btn-link" data-bs-toggle="dropdown"><svg width="24px" height="24px" viewBox="0 0 24 24" version="1.1"><g stroke="none" stroke-width="1" fill="none" fill-rule="evenodd"><rect x="0" y="0" width="24" height="24"></rect><circle fill="#000000" cx="5" cy="12" r="2"></circle><circle fill="#000000" cx="12" cy="12" r="2"></circle><circle fill="#000000" cx="19" cy="12" r="2"></circle></g></svg></div><div class="dropdown-menu dropdown-menu-end">';
                
                // Edit button
                if (hasPermission('LEADS_UPDATE')) {
                    actionHtml += '<a class="dropdown-item" href="javascript:void(0)" id="rt" onclick="edit_leads('+data['leads_id']+')">Edit</a>';
                }

               // Change status button
                if (hasPermission('LEADS_CHANGE_STATUS')) {
                    actionHtml += '<a class="dropdown-item" href="javascript:void(0)" id="rt" onclick="openChangeStatus1Modal('+data['leads_id']+')">Change status</a>';
                }

                // Show status button
                if (hasPermission('LEADS_SHOW_STATUS')) {
                    actionHtml += '<a class="dropdown-item" href="javascript:void(0)" id="rt" onclick="showStatus1Modal('+data['leads_id']+')">Status history</a>';
                }

                // Change stage button
                if (hasPermission('LEADS_CHANGE_STAGE')) {
                    actionHtml += '<a class="dropdown-item" href="javascript:void(0)" id="rt" onclick="openChangeStatusModal('+data['leads_id']+')">Change stage</a>';
                }

                // Show stage button
                if (hasPermission('LEADS_SHOW_STAGE')) {
                    actionHtml += '<a class="dropdown-item" href="javascript:void(0)" id="rt" onclick="showStatusModal('+data['leads_id']+')">Show stages</a>';
                }

                // Details button
                if (hasPermission('LEADS_DETAILS')) {
                    actionHtml += '<a class="dropdown-item" href="javascript:void(0)" id="rt" onclick="view_lead_details('+data['leads_id']+')">view</a>';
                }

                // Delete button
                if (hasPermission('LEADS_DELETE')) {
                    actionHtml += '<a class="dropdown-item" href="javascript:void(0)" onclick="return delete_leads('+data['leads_id']+')">Delete</a>';
                }

                actionHtml += '</div></div>';

                $('td', row).eq(11).html(actionHtml);
              }
              if(data['leads_accomodation_status'] == 2 && data['leads_quotation_status'] == 2){

                    // $('td', row).eq(11).html('<div class="dropdown ms-auto text-end"><div class="btn-link" data-bs-toggle="dropdown"><svg width="24px" height="24px" viewBox="0 0 24 24" version="1.1"><g stroke="none" stroke-width="1" fill="none" fill-rule="evenodd"><rect x="0" y="0" width="24" height="24"></rect><circle fill="#000000" cx="5" cy="12" r="2"></circle><circle fill="#000000" cx="12" cy="12" r="2"></circle><circle fill="#000000" cx="19" cy="12" r="2"></circle></g></svg></div><div class="dropdown-menu dropdown-menu-end"><a class="dropdown-item" href="javascript:void(0)" id="rt" onclick="openChangeStatusModal('+data['leads_id']+')">Change stage</a><a class="dropdown-item" href="javascript:void(0)" id="rt" onclick="showStatusModal('+data['leads_id']+')">Show stages</a><a class="dropdown-item" href="javascript:void(0)" id="rt" onclick="openChangeStatus1Modal('+data['leads_id']+')">Change status</a><a class="dropdown-item" href="javascript:void(0)" id="rt" onclick="showStatus1Modal('+data['leads_id']+')">Status history</a><a class="dropdown-item" href="javascript:void(0)" id="rt" onclick="edit_leads('+data['leads_id']+')">Edit</a><a class="dropdown-item" href="javascript:void(0)" id="rt" onclick="view_lead_details('+data['leads_id']+')">view</a><a class="dropdown-item" href="javascript:void(0)" onclick="return delete_leads('+data['leads_id']+')">Delete</a></div></div>');

                    $('td', row).eq(1).html('<a class="leads-number-link" href="javascript:void(0)" onclick="view_lead_details('+data['leads_id']+')">'+data['leads_number']+'</a><br><span class="badge badge-xs badge badge-info">Cancelled/Quotation not created</span>');

                    let actionHtml = '<div class="dropdown ms-auto text-end"><div class="btn-link" data-bs-toggle="dropdown"><svg width="24px" height="24px" viewBox="0 0 24 24" version="1.1"><g stroke="none" stroke-width="1" fill="none" fill-rule="evenodd"><rect x="0" y="0" width="24" height="24"></rect><circle fill="#000000" cx="5" cy="12" r="2"></circle><circle fill="#000000" cx="12" cy="12" r="2"></circle><circle fill="#000000" cx="19" cy="12" r="2"></circle></g></svg></div><div class="dropdown-menu dropdown-menu-end">';
                
                // Edit button
                if (hasPermission('LEADS_UPDATE')) {
                    actionHtml += '<a class="dropdown-item" href="javascript:void(0)" id="rt" onclick="edit_leads('+data['leads_id']+')">Edit</a>';
                }

               // Change status button
                if (hasPermission('LEADS_CHANGE_STATUS')) {
                    actionHtml += '<a class="dropdown-item" href="javascript:void(0)" id="rt" onclick="openChangeStatus1Modal('+data['leads_id']+')">Change status</a>';
                }

                // Show status button
                if (hasPermission('LEADS_SHOW_STATUS')) {
                    actionHtml += '<a class="dropdown-item" href="javascript:void(0)" id="rt" onclick="showStatus1Modal('+data['leads_id']+')">Status history</a>';
                }

                // Change stage button
                if (hasPermission('LEADS_CHANGE_STAGE')) {
                    actionHtml += '<a class="dropdown-item" href="javascript:void(0)" id="rt" onclick="openChangeStatusModal('+data['leads_id']+')">Change stage</a>';
                }

                // Show stage button
                if (hasPermission('LEADS_SHOW_STAGE')) {
                    actionHtml += '<a class="dropdown-item" href="javascript:void(0)" id="rt" onclick="showStatusModal('+data['leads_id']+')">Show stages</a>';
                }

                // Guest count button
                if (hasPermission('LEADS_GUEST_COUNT')) {
                    actionHtml += '<a class="dropdown-item" href="javascript:void(0)" id="rt"  onclick="open_guest_count_checked('+data['leads_id']+')">Guest count</a>';
                }

                // Accomodation plan button
                if (hasPermission('LEADS_ACCOMODATION_PLAN')) {
                    actionHtml += '<a class="dropdown-item" href="javascript:void(0)" id="rt"  onclick="open_accommodation_checked('+data['leads_id']+')">Accomodation plan</a>';
                }

                // Quotation button
                if (hasPermission('LEADS_QUOTATION')) {
                    actionHtml += '<a class="dropdown-item" href="javascript:void(0)" id="rt" onclick="open_quotation('+data['leads_id']+')">Quotation</a>';
                }

                // Details button
                if (hasPermission('LEADS_DETAILS')) {
                    actionHtml += '<a class="dropdown-item" href="javascript:void(0)" id="rt" onclick="view_lead_details('+data['leads_id']+')">view</a>';
                }

                // Delete button
                if (hasPermission('LEADS_DELETE')) {
                    actionHtml += '<a class="dropdown-item" href="javascript:void(0)" onclick="return delete_leads('+data['leads_id']+')">Delete</a>';
                }

                actionHtml += '</div></div>';

                $('td', row).eq(11).html(actionHtml);
              }
              renderRejectedQuotationRow(data, row);
            }
             else if($table1.cell(node).data() == '3') {
					    $table1.cell(node).data('<center><span class="badge badge-sm light btn-success">Converted to trip</span></center>');
            // else if(data['lead_current_status'] == 5){
              // $('td', row).eq(9).html('<span class="badge badge-danger">Lost</span>');

             $('td', row).eq(1).html('<a class="leads-number-link" href="javascript:void(0)" onclick="view_lead_details('+data['leads_id']+')">'+data['leads_number']+'</a>');
              
                // $('td', row).eq(11).html('<div class="dropdown ms-auto text-end"><div class="btn-link" data-bs-toggle="dropdown"><svg width="24px" height="24px" viewBox="0 0 24 24" version="1.1"><g stroke="none" stroke-width="1" fill="none" fill-rule="evenodd"><rect x="0" y="0" width="24" height="24"></rect><circle fill="#000000" cx="5" cy="12" r="2"></circle><circle fill="#000000" cx="12" cy="12" r="2"></circle><circle fill="#000000" cx="19" cy="12" r="2"></circle></g></svg></div><div class="dropdown-menu dropdown-menu-end"><a class="dropdown-item" href="javascript:void(0)" id="rt" onclick="openChangeStatusModal('+data['leads_id']+')">Change stage</a><a class="dropdown-item" href="javascript:void(0)" id="rt" onclick="showStatusModal('+data['leads_id']+')">Show stages</a><a class="dropdown-item" href="javascript:void(0)" id="rt" onclick="openChangeStatus1Modal('+data['leads_id']+')">Change status</a><a class="dropdown-item" href="javascript:void(0)" id="rt" onclick="showStatus1Modal('+data['leads_id']+')">Status history</a><a class="dropdown-item" href="javascript:void(0)" id="rt"  onclick="guset_count_edit('+data['leads_id']+')">Guest count</a><a class="dropdown-item" href="javascript:void(0)" id="rt" onclick="edit_leads('+data['leads_id']+')">Edit</a><a class="dropdown-item" href="javascript:void(0)" id="rt" onclick="view_lead_details('+data['leads_id']+')">view</a><a class="dropdown-item" href="javascript:void(0)" onclick="return delete_leads('+data['leads_id']+')">Delete</a></div></div>');
              
                 let actionHtml = '<div class="dropdown ms-auto text-end"><div class="btn-link" data-bs-toggle="dropdown"><svg width="24px" height="24px" viewBox="0 0 24 24" version="1.1"><g stroke="none" stroke-width="1" fill="none" fill-rule="evenodd"><rect x="0" y="0" width="24" height="24"></rect><circle fill="#000000" cx="5" cy="12" r="2"></circle><circle fill="#000000" cx="12" cy="12" r="2"></circle><circle fill="#000000" cx="19" cy="12" r="2"></circle></g></svg></div><div class="dropdown-menu dropdown-menu-end">';
                // Edit button
                // if (hasPermission('LEADS_UPDATE')) {
                //     actionHtml += '<a class="dropdown-item" href="javascript:void(0)" id="rt" onclick="edit_leads('+data['leads_id']+')">Edit</a>';
                // }

               // Change status button
                // if (hasPermission('LEADS_CHANGE_STATUS')) {
                //     actionHtml += '<a class="dropdown-item" href="javascript:void(0)" id="rt" onclick="openChangeStatus1Modal('+data['leads_id']+')">Change status</a>';
                // }

                // Show status button
                if (hasPermission('LEADS_SHOW_STATUS')) {
                    actionHtml += '<a class="dropdown-item" href="javascript:void(0)" id="rt" onclick="showStatus1Modal('+data['leads_id']+')">Status history</a>';
                }

                // Change stage button
                // if (hasPermission('LEADS_CHANGE_STAGE')) {
                //     actionHtml += '<a class="dropdown-item" href="javascript:void(0)" id="rt" onclick="openChangeStatusModal('+data['leads_id']+')">Change stage</a>';
                // }

                // Show stage button
                if (hasPermission('LEADS_SHOW_STAGE')) {
                    actionHtml += '<a class="dropdown-item" href="javascript:void(0)" id="rt" onclick="showStatusModal('+data['leads_id']+')">Show stages</a>';
                }

                // Guest count button
                // if (hasPermission('LEADS_GUEST_COUNT')) {
                //     actionHtml += '<a class="dropdown-item" href="javascript:void(0)" id="rt"  onclick="guset_count_edit('+data['leads_id']+')">Guest count</a>';
                // }

                // Details button
                if (hasPermission('LEADS_DETAILS')) {
                    actionHtml += '<a class="dropdown-item" href="javascript:void(0)" id="rt" onclick="view_lead_details('+data['leads_id']+')">view</a>';
                }

                // Delete button
                // if (hasPermission('LEADS_DELETE')) {
                //     actionHtml += '<a class="dropdown-item" href="javascript:void(0)" onclick="return delete_leads('+data['leads_id']+')">Delete</a>';
                // }

                actionHtml += '</div></div>';

                $('td', row).eq(11).html(actionHtml);

                
            }
            else if($table1.cell(node).data() == '4') {
					    $table1.cell(node).data('<center><span class="badge badge-sm light btn-warning">Not Qualified</span></center>');
            // else if(data['lead_current_status'] == 4){
            //   $('td', row).eq(9).html('<span class="badge badge-warning">Not Qualified</span>');

              if(data['leads_accomodation_status'] == 0 && data['leads_quotation_status'] == 0){
              
                $('td', row).eq(1).html('<a class="leads-number-link" href="javascript:void(0)" onclick="view_lead_details('+data['leads_id']+')">'+data['leads_number']+'</a><br><span class="badge badge-xs badge badge-primary">guest count required</span>');

                // $('td', row).eq(11).html('<div class="dropdown ms-auto text-end"><div class="btn-link" data-bs-toggle="dropdown"><svg width="24px" height="24px" viewBox="0 0 24 24" version="1.1"><g stroke="none" stroke-width="1" fill="none" fill-rule="evenodd"><rect x="0" y="0" width="24" height="24"></rect><circle fill="#000000" cx="5" cy="12" r="2"></circle><circle fill="#000000" cx="12" cy="12" r="2"></circle><circle fill="#000000" cx="19" cy="12" r="2"></circle></g></svg></div><div class="dropdown-menu dropdown-menu-end"><a class="dropdown-item" href="javascript:void(0)" id="rt" onclick="openChangeStatusModal('+data['leads_id']+')">Change stage</a><a class="dropdown-item" href="javascript:void(0)" id="rt" onclick="showStatusModal('+data['leads_id']+')">Show stages</a><a class="dropdown-item" href="javascript:void(0)" id="rt" onclick="openChangeStatus1Modal('+data['leads_id']+')">Change status</a><a class="dropdown-item" href="javascript:void(0)" id="rt" onclick="showStatus1Modal('+data['leads_id']+')">Status history</a><a class="dropdown-item" href="javascript:void(0)" id="rt"  onclick="guset_count_edit('+data['leads_id']+')">Guest count</a><a class="dropdown-item" href="javascript:void(0)" id="rt" onclick="edit_leads('+data['leads_id']+')">Edit</a><a class="dropdown-item" href="javascript:void(0)" id="rt" onclick="view_lead_details('+data['leads_id']+')">view</a><a class="dropdown-item" href="javascript:void(0)" onclick="return delete_leads('+data['leads_id']+')">Delete</a></div></div>');
              
                 let actionHtml = '<div class="dropdown ms-auto text-end"><div class="btn-link" data-bs-toggle="dropdown"><svg width="24px" height="24px" viewBox="0 0 24 24" version="1.1"><g stroke="none" stroke-width="1" fill="none" fill-rule="evenodd"><rect x="0" y="0" width="24" height="24"></rect><circle fill="#000000" cx="5" cy="12" r="2"></circle><circle fill="#000000" cx="12" cy="12" r="2"></circle><circle fill="#000000" cx="19" cy="12" r="2"></circle></g></svg></div><div class="dropdown-menu dropdown-menu-end">';
                // Edit button
                if (hasPermission('LEADS_UPDATE')) {
                    actionHtml += '<a class="dropdown-item" href="javascript:void(0)" id="rt" onclick="edit_leads('+data['leads_id']+')">Edit</a>';
                }

               // Change status button
                if (hasPermission('LEADS_CHANGE_STATUS')) {
                    actionHtml += '<a class="dropdown-item" href="javascript:void(0)" id="rt" onclick="openChangeStatus1Modal('+data['leads_id']+')">Change status</a>';
                }

                // Show status button
                if (hasPermission('LEADS_SHOW_STATUS')) {
                    actionHtml += '<a class="dropdown-item" href="javascript:void(0)" id="rt" onclick="showStatus1Modal('+data['leads_id']+')">Status history</a>';
                }

                // Change stage button
                if (hasPermission('LEADS_CHANGE_STAGE')) {
                    actionHtml += '<a class="dropdown-item" href="javascript:void(0)" id="rt" onclick="openChangeStatusModal('+data['leads_id']+')">Change stage</a>';
                }

                // Show stage button
                if (hasPermission('LEADS_SHOW_STAGE')) {
                    actionHtml += '<a class="dropdown-item" href="javascript:void(0)" id="rt" onclick="showStatusModal('+data['leads_id']+')">Show stages</a>';
                }

                // Guest count button
                if (hasPermission('LEADS_GUEST_COUNT')) {
                    actionHtml += '<a class="dropdown-item" href="javascript:void(0)" id="rt"  onclick="open_guest_count_checked('+data['leads_id']+')">Guest count</a>';
                }

                // Details button
                if (hasPermission('LEADS_DETAILS')) {
                    actionHtml += '<a class="dropdown-item" href="javascript:void(0)" id="rt" onclick="view_lead_details('+data['leads_id']+')">view</a>';
                }

                // Delete button
                if (hasPermission('LEADS_DELETE')) {
                    actionHtml += '<a class="dropdown-item" href="javascript:void(0)" onclick="return delete_leads('+data['leads_id']+')">Delete</a>';
                }

                actionHtml += '</div></div>';

                $('td', row).eq(11).html(actionHtml);

                }
              
              if(data['leads_accomodation_status'] == 1 && data['leads_quotation_status'] == 0){

                $('td', row).eq(1).html('<a class="leads-number-link" href="javascript:void(0)" onclick="view_lead_details('+data['leads_id']+')">'+data['leads_number']+'</a><br><span class="badge badge-xs badge badge-warning">accommodation required</span>');
                // $('td', row).eq(11).html('<div class="dropdown ms-auto text-end"><div class="btn-link" data-bs-toggle="dropdown"><svg width="24px" height="24px" viewBox="0 0 24 24" version="1.1"><g stroke="none" stroke-width="1" fill="none" fill-rule="evenodd"><rect x="0" y="0" width="24" height="24"></rect><circle fill="#000000" cx="5" cy="12" r="2"></circle><circle fill="#000000" cx="12" cy="12" r="2"></circle><circle fill="#000000" cx="19" cy="12" r="2"></circle></g></svg></div><div class="dropdown-menu dropdown-menu-end"><a class="dropdown-item" href="javascript:void(0)" id="rt" onclick="openChangeStatusModal('+data['leads_id']+')">Change stage</a><a class="dropdown-item" href="javascript:void(0)" id="rt" onclick="showStatusModal('+data['leads_id']+')">Show stages</a><a class="dropdown-item" href="javascript:void(0)" id="rt" onclick="openChangeStatus1Modal('+data['leads_id']+')">Change status</a><a class="dropdown-item" href="javascript:void(0)" id="rt" onclick="showStatus1Modal('+data['leads_id']+')">Status history</a><a class="dropdown-item" href="javascript:void(0)" id="rt"  onclick="guset_count_edit('+data['leads_id']+')">Guest count</a><a class="dropdown-item" href="javascript:void(0)" id="rt"  onclick="accomodation_plan('+data['leads_id']+')">Accomodation plan</a><a class="dropdown-item" href="javascript:void(0)" id="rt" onclick="edit_leads('+data['leads_id']+')">Edit</a><a class="dropdown-item" href="javascript:void(0)" id="rt" onclick="view_lead_details('+data['leads_id']+')">view</a><a class="dropdown-item" href="javascript:void(0)" onclick="return delete_leads('+data['leads_id']+')">Delete</a></div></div>');

                let actionHtml = '<div class="dropdown ms-auto text-end"><div class="btn-link" data-bs-toggle="dropdown"><svg width="24px" height="24px" viewBox="0 0 24 24" version="1.1"><g stroke="none" stroke-width="1" fill="none" fill-rule="evenodd"><rect x="0" y="0" width="24" height="24"></rect><circle fill="#000000" cx="5" cy="12" r="2"></circle><circle fill="#000000" cx="12" cy="12" r="2"></circle><circle fill="#000000" cx="19" cy="12" r="2"></circle></g></svg></div><div class="dropdown-menu dropdown-menu-end">';
                
                // Edit button
                if (hasPermission('LEADS_UPDATE')) {
                    actionHtml += '<a class="dropdown-item" href="javascript:void(0)" id="rt" onclick="edit_leads('+data['leads_id']+')">Edit</a>';
                }

               // Change status button
                if (hasPermission('LEADS_CHANGE_STATUS')) {
                    actionHtml += '<a class="dropdown-item" href="javascript:void(0)" id="rt" onclick="openChangeStatus1Modal('+data['leads_id']+')">Change status</a>';
                }

                // Show status button
                if (hasPermission('LEADS_SHOW_STATUS')) {
                    actionHtml += '<a class="dropdown-item" href="javascript:void(0)" id="rt" onclick="showStatus1Modal('+data['leads_id']+')">Status history</a>';
                }

                // Change stage button
                if (hasPermission('LEADS_CHANGE_STAGE')) {
                    actionHtml += '<a class="dropdown-item" href="javascript:void(0)" id="rt" onclick="openChangeStatusModal('+data['leads_id']+')">Change stage</a>';
                }

                // Show stage button
                if (hasPermission('LEADS_SHOW_STAGE')) {
                    actionHtml += '<a class="dropdown-item" href="javascript:void(0)" id="rt" onclick="showStatusModal('+data['leads_id']+')">Show stages</a>';
                }

                // Guest count button
                if (hasPermission('LEADS_GUEST_COUNT')) {
                    actionHtml += '<a class="dropdown-item" href="javascript:void(0)" id="rt"  onclick="open_guest_count_checked('+data['leads_id']+')">Guest count</a>';
                }

                 // Accomodation plan button
                if (hasPermission('LEADS_ACCOMODATION_PLAN')) {
                    actionHtml += '<a class="dropdown-item" href="javascript:void(0)" id="rt"  onclick="open_accommodation_checked('+data['leads_id']+')">Accomodation plan</a>';
                }

                // Details button
                if (hasPermission('LEADS_DETAILS')) {
                    actionHtml += '<a class="dropdown-item" href="javascript:void(0)" id="rt" onclick="view_lead_details('+data['leads_id']+')">view</a>';
                }

                // Delete button
                if (hasPermission('LEADS_DELETE')) {
                    actionHtml += '<a class="dropdown-item" href="javascript:void(0)" onclick="return delete_leads('+data['leads_id']+')">Delete</a>';
                }

                actionHtml += '</div></div>';

                $('td', row).eq(11).html(actionHtml);

                }

              if(data['leads_accomodation_status'] == 2 && data['leads_quotation_status'] == 0){

                $('td', row).eq(1).html('<a class="leads-number-link" href="javascript:void(0)" onclick="view_lead_details('+data['leads_id']+')">'+data['leads_number']+'</a><br><span class="badge badge-xs badge badge-info">Quotation not created</span>');
                // $('td', row).eq(11).html('<div class="dropdown ms-auto text-end"><div class="btn-link" data-bs-toggle="dropdown"><svg width="24px" height="24px" viewBox="0 0 24 24" version="1.1"><g stroke="none" stroke-width="1" fill="none" fill-rule="evenodd"><rect x="0" y="0" width="24" height="24"></rect><circle fill="#000000" cx="5" cy="12" r="2"></circle><circle fill="#000000" cx="12" cy="12" r="2"></circle><circle fill="#000000" cx="19" cy="12" r="2"></circle></g></svg></div><div class="dropdown-menu dropdown-menu-end"><a class="dropdown-item" href="javascript:void(0)" id="rt" onclick="openChangeStatusModal('+data['leads_id']+')">Change stage</a><a class="dropdown-item" href="javascript:void(0)" id="rt" onclick="showStatusModal('+data['leads_id']+')">Show stages</a><a class="dropdown-item" href="javascript:void(0)" id="rt" onclick="openChangeStatus1Modal('+data['leads_id']+')">Change status</a><a class="dropdown-item" href="javascript:void(0)" id="rt" onclick="showStatus1Modal('+data['leads_id']+')">Status history</a><a class="dropdown-item" href="javascript:void(0)" id="rt"  onclick="guset_count_edit('+data['leads_id']+')">Guest count</a><a class="dropdown-item" href="javascript:void(0)" id="rt"  onclick="accomodation_plan('+data['leads_id']+')">Accomodation plan</a><a class="dropdown-item" href="javascript:void(0)" id="rt" onclick="open_quotation('+data['leads_id']+')">Quotation</a><a class="dropdown-item" href="javascript:void(0)" id="rt" onclick="edit_leads('+data['leads_id']+')">Edit</a><a class="dropdown-item" href="javascript:void(0)" id="rt" onclick="view_lead_details('+data['leads_id']+')">view</a><a class="dropdown-item" href="javascript:void(0)" onclick="return delete_leads('+data['leads_id']+')">Delete</a></div></div>');

                let actionHtml = '<div class="dropdown ms-auto text-end"><div class="btn-link" data-bs-toggle="dropdown"><svg width="24px" height="24px" viewBox="0 0 24 24" version="1.1"><g stroke="none" stroke-width="1" fill="none" fill-rule="evenodd"><rect x="0" y="0" width="24" height="24"></rect><circle fill="#000000" cx="5" cy="12" r="2"></circle><circle fill="#000000" cx="12" cy="12" r="2"></circle><circle fill="#000000" cx="19" cy="12" r="2"></circle></g></svg></div><div class="dropdown-menu dropdown-menu-end">';
                
                // Edit button
                if (hasPermission('LEADS_UPDATE')) {
                    actionHtml += '<a class="dropdown-item" href="javascript:void(0)" id="rt" onclick="edit_leads('+data['leads_id']+')">Edit</a>';
                }

               // Change status button
                if (hasPermission('LEADS_CHANGE_STATUS')) {
                    actionHtml += '<a class="dropdown-item" href="javascript:void(0)" id="rt" onclick="openChangeStatus1Modal('+data['leads_id']+')">Change status</a>';
                }

                // Show status button
                if (hasPermission('LEADS_SHOW_STATUS')) {
                    actionHtml += '<a class="dropdown-item" href="javascript:void(0)" id="rt" onclick="showStatus1Modal('+data['leads_id']+')">Status history</a>';
                }

                // Change stage button
                if (hasPermission('LEADS_CHANGE_STAGE')) {
                    actionHtml += '<a class="dropdown-item" href="javascript:void(0)" id="rt" onclick="openChangeStatusModal('+data['leads_id']+')">Change stage</a>';
                }

                // Show stage button
                if (hasPermission('LEADS_SHOW_STAGE')) {
                    actionHtml += '<a class="dropdown-item" href="javascript:void(0)" id="rt" onclick="showStatusModal('+data['leads_id']+')">Show stages</a>';
                }

                // Guest count button
                if (hasPermission('LEADS_GUEST_COUNT')) {
                    actionHtml += '<a class="dropdown-item" href="javascript:void(0)" id="rt"  onclick="open_guest_count_checked('+data['leads_id']+')">Guest count</a>';
                }

                // Accomodation plan button
                if (hasPermission('LEADS_ACCOMODATION_PLAN')) {
                    actionHtml += '<a class="dropdown-item" href="javascript:void(0)" id="rt"  onclick="open_accommodation_checked('+data['leads_id']+')">Accomodation plan</a>';
                }

                // Quotation button
                if (hasPermission('LEADS_QUOTATION')) {
                    actionHtml += '<a class="dropdown-item" href="javascript:void(0)" id="rt" onclick="open_quotation('+data['leads_id']+')">Quotation</a>';
                }

                // Details button
                if (hasPermission('LEADS_DETAILS')) {
                    actionHtml += '<a class="dropdown-item" href="javascript:void(0)" id="rt" onclick="view_lead_details('+data['leads_id']+')">view</a>';
                }

                // Delete button
                if (hasPermission('LEADS_DELETE')) {
                    actionHtml += '<a class="dropdown-item" href="javascript:void(0)" onclick="return delete_leads('+data['leads_id']+')">Delete</a>';
                }

                actionHtml += '</div></div>';

                $('td', row).eq(11).html(actionHtml);

              }
              renderRejectedQuotationRow(data, row);
              renderQuotationCreatedRow(data, row);
              renderCancelledQuotationRow(data, row);
              if(data['leads_accomodation_status'] == 2 && data['leads_quotation_status'] == 1){

                    // $('td', row).eq(11).html('<div class="dropdown ms-auto text-end"><div class="btn-link" data-bs-toggle="dropdown"><svg width="24px" height="24px" viewBox="0 0 24 24" version="1.1"><g stroke="none" stroke-width="1" fill="none" fill-rule="evenodd"><rect x="0" y="0" width="24" height="24"></rect><circle fill="#000000" cx="5" cy="12" r="2"></circle><circle fill="#000000" cx="12" cy="12" r="2"></circle><circle fill="#000000" cx="19" cy="12" r="2"></circle></g></svg></div><div class="dropdown-menu dropdown-menu-end"><a class="dropdown-item" href="javascript:void(0)" id="rt" onclick="openChangeStatusModal('+data['leads_id']+')">Change stage</a><a class="dropdown-item" href="javascript:void(0)" id="rt" onclick="showStatusModal('+data['leads_id']+')">Show stages</a><a class="dropdown-item" href="javascript:void(0)" id="rt" onclick="openChangeStatus1Modal('+data['leads_id']+')">Change status</a><a class="dropdown-item" href="javascript:void(0)" id="rt" onclick="showStatus1Modal('+data['leads_id']+')">Status history</a><a class="dropdown-item" href="javascript:void(0)" id="rt" onclick="edit_leads('+data['leads_id']+')">Edit</a><a class="dropdown-item" href="javascript:void(0)" id="rt" onclick="view_lead_details('+data['leads_id']+')">view</a><a class="dropdown-item" href="javascript:void(0)" onclick="return delete_leads('+data['leads_id']+')">Delete</a></div></div>');

                    $('td', row).eq(1).html('<a class="leads-number-link" href="javascript:void(0)" onclick="view_lead_details('+data['leads_id']+')">'+data['leads_number']+'</a><br><span class="badge badge-xs badge badge-success">Quotation created</span>');

                    let actionHtml = '<div class="dropdown ms-auto text-end"><div class="btn-link" data-bs-toggle="dropdown"><svg width="24px" height="24px" viewBox="0 0 24 24" version="1.1"><g stroke="none" stroke-width="1" fill="none" fill-rule="evenodd"><rect x="0" y="0" width="24" height="24"></rect><circle fill="#000000" cx="5" cy="12" r="2"></circle><circle fill="#000000" cx="12" cy="12" r="2"></circle><circle fill="#000000" cx="19" cy="12" r="2"></circle></g></svg></div><div class="dropdown-menu dropdown-menu-end">';
                
                // Edit button
                if (hasPermission('LEADS_UPDATE')) {
                    actionHtml += '<a class="dropdown-item" href="javascript:void(0)" id="rt" onclick="edit_leads('+data['leads_id']+')">Edit</a>';
                }

               // Change status button
                if (hasPermission('LEADS_CHANGE_STATUS')) {
                    actionHtml += '<a class="dropdown-item" href="javascript:void(0)" id="rt" onclick="openChangeStatus1Modal('+data['leads_id']+')">Change status</a>';
                }

                // Show status button
                if (hasPermission('LEADS_SHOW_STATUS')) {
                    actionHtml += '<a class="dropdown-item" href="javascript:void(0)" id="rt" onclick="showStatus1Modal('+data['leads_id']+')">Status history</a>';
                }

                // Change stage button
                if (hasPermission('LEADS_CHANGE_STAGE')) {
                    actionHtml += '<a class="dropdown-item" href="javascript:void(0)" id="rt" onclick="openChangeStatusModal('+data['leads_id']+')">Change stage</a>';
                }

                // Show stage button
                if (hasPermission('LEADS_SHOW_STAGE')) {
                    actionHtml += '<a class="dropdown-item" href="javascript:void(0)" id="rt" onclick="showStatusModal('+data['leads_id']+')">Show stages</a>';
                }

                // Details button
                if (hasPermission('LEADS_DETAILS')) {
                    actionHtml += '<a class="dropdown-item" href="javascript:void(0)" id="rt" onclick="view_lead_details('+data['leads_id']+')">view</a>';
                }

                // Delete button
                if (hasPermission('LEADS_DELETE')) {
                    actionHtml += '<a class="dropdown-item" href="javascript:void(0)" onclick="return delete_leads('+data['leads_id']+')">Delete</a>';
                }

                actionHtml += '</div></div>';

                $('td', row).eq(11).html(actionHtml);
              }
              if(data['leads_accomodation_status'] == 2 && data['leads_quotation_status'] == 2){

                    // $('td', row).eq(11).html('<div class="dropdown ms-auto text-end"><div class="btn-link" data-bs-toggle="dropdown"><svg width="24px" height="24px" viewBox="0 0 24 24" version="1.1"><g stroke="none" stroke-width="1" fill="none" fill-rule="evenodd"><rect x="0" y="0" width="24" height="24"></rect><circle fill="#000000" cx="5" cy="12" r="2"></circle><circle fill="#000000" cx="12" cy="12" r="2"></circle><circle fill="#000000" cx="19" cy="12" r="2"></circle></g></svg></div><div class="dropdown-menu dropdown-menu-end"><a class="dropdown-item" href="javascript:void(0)" id="rt" onclick="openChangeStatusModal('+data['leads_id']+')">Change stage</a><a class="dropdown-item" href="javascript:void(0)" id="rt" onclick="showStatusModal('+data['leads_id']+')">Show stages</a><a class="dropdown-item" href="javascript:void(0)" id="rt" onclick="openChangeStatus1Modal('+data['leads_id']+')">Change status</a><a class="dropdown-item" href="javascript:void(0)" id="rt" onclick="showStatus1Modal('+data['leads_id']+')">Status history</a><a class="dropdown-item" href="javascript:void(0)" id="rt" onclick="edit_leads('+data['leads_id']+')">Edit</a><a class="dropdown-item" href="javascript:void(0)" id="rt" onclick="view_lead_details('+data['leads_id']+')">view</a><a class="dropdown-item" href="javascript:void(0)" onclick="return delete_leads('+data['leads_id']+')">Delete</a></div></div>');

                    $('td', row).eq(1).html('<a class="leads-number-link" href="javascript:void(0)" onclick="view_lead_details('+data['leads_id']+')">'+data['leads_number']+'</a><br><span class="badge badge-xs badge badge-info">Cancelled/Quotation not created</span>');

                    let actionHtml = '<div class="dropdown ms-auto text-end"><div class="btn-link" data-bs-toggle="dropdown"><svg width="24px" height="24px" viewBox="0 0 24 24" version="1.1"><g stroke="none" stroke-width="1" fill="none" fill-rule="evenodd"><rect x="0" y="0" width="24" height="24"></rect><circle fill="#000000" cx="5" cy="12" r="2"></circle><circle fill="#000000" cx="12" cy="12" r="2"></circle><circle fill="#000000" cx="19" cy="12" r="2"></circle></g></svg></div><div class="dropdown-menu dropdown-menu-end">';
                
                // Edit button
                if (hasPermission('LEADS_UPDATE')) {
                    actionHtml += '<a class="dropdown-item" href="javascript:void(0)" id="rt" onclick="edit_leads('+data['leads_id']+')">Edit</a>';
                }

               // Change status button
                if (hasPermission('LEADS_CHANGE_STATUS')) {
                    actionHtml += '<a class="dropdown-item" href="javascript:void(0)" id="rt" onclick="openChangeStatus1Modal('+data['leads_id']+')">Change status</a>';
                }

                // Show status button
                if (hasPermission('LEADS_SHOW_STATUS')) {
                    actionHtml += '<a class="dropdown-item" href="javascript:void(0)" id="rt" onclick="showStatus1Modal('+data['leads_id']+')">Status history</a>';
                }

                // Change stage button
                if (hasPermission('LEADS_CHANGE_STAGE')) {
                    actionHtml += '<a class="dropdown-item" href="javascript:void(0)" id="rt" onclick="openChangeStatusModal('+data['leads_id']+')">Change stage</a>';
                }

                // Show stage button
                if (hasPermission('LEADS_SHOW_STAGE')) {
                    actionHtml += '<a class="dropdown-item" href="javascript:void(0)" id="rt" onclick="showStatusModal('+data['leads_id']+')">Show stages</a>';
                }

                // Guest count button
                if (hasPermission('LEADS_GUEST_COUNT')) {
                    actionHtml += '<a class="dropdown-item" href="javascript:void(0)" id="rt"  onclick="open_guest_count_checked('+data['leads_id']+')">Guest count</a>';
                }

                // Accomodation plan button
                if (hasPermission('LEADS_ACCOMODATION_PLAN')) {
                    actionHtml += '<a class="dropdown-item" href="javascript:void(0)" id="rt"  onclick="open_accommodation_checked('+data['leads_id']+')">Accomodation plan</a>';
                }

                // Quotation button
                if (hasPermission('LEADS_QUOTATION')) {
                    actionHtml += '<a class="dropdown-item" href="javascript:void(0)" id="rt" onclick="open_quotation('+data['leads_id']+')">Quotation</a>';
                }

                // Details button
                if (hasPermission('LEADS_DETAILS')) {
                    actionHtml += '<a class="dropdown-item" href="javascript:void(0)" id="rt" onclick="view_lead_details('+data['leads_id']+')">view</a>';
                }

                // Delete button
                if (hasPermission('LEADS_DELETE')) {
                    actionHtml += '<a class="dropdown-item" href="javascript:void(0)" onclick="return delete_leads('+data['leads_id']+')">Delete</a>';
                }

                actionHtml += '</div></div>';

                $('td', row).eq(11).html(actionHtml);
              }
              renderRejectedQuotationRow(data, row);
            }
            else if($table1.cell(node).data() == '5') {
					    $table1.cell(node).data('<center><span class="badge badge-sm light btn-danger">Lost</span></center>');
            // else if(data['lead_current_status'] == 5){
              // $('td', row).eq(9).html('<span class="badge badge-danger">Lost</span>');

              if(data['leads_accomodation_status'] == 0 && data['leads_quotation_status'] == 0){
              
                $('td', row).eq(1).html('<a class="leads-number-link" href="javascript:void(0)" onclick="view_lead_details('+data['leads_id']+')">'+data['leads_number']+'</a><br><span class="badge badge-xs badge badge-primary">guest count required</span>');

                // $('td', row).eq(11).html('<div class="dropdown ms-auto text-end"><div class="btn-link" data-bs-toggle="dropdown"><svg width="24px" height="24px" viewBox="0 0 24 24" version="1.1"><g stroke="none" stroke-width="1" fill="none" fill-rule="evenodd"><rect x="0" y="0" width="24" height="24"></rect><circle fill="#000000" cx="5" cy="12" r="2"></circle><circle fill="#000000" cx="12" cy="12" r="2"></circle><circle fill="#000000" cx="19" cy="12" r="2"></circle></g></svg></div><div class="dropdown-menu dropdown-menu-end"><a class="dropdown-item" href="javascript:void(0)" id="rt" onclick="openChangeStatusModal('+data['leads_id']+')">Change stage</a><a class="dropdown-item" href="javascript:void(0)" id="rt" onclick="showStatusModal('+data['leads_id']+')">Show stages</a><a class="dropdown-item" href="javascript:void(0)" id="rt" onclick="openChangeStatus1Modal('+data['leads_id']+')">Change status</a><a class="dropdown-item" href="javascript:void(0)" id="rt" onclick="showStatus1Modal('+data['leads_id']+')">Status history</a><a class="dropdown-item" href="javascript:void(0)" id="rt"  onclick="guset_count_edit('+data['leads_id']+')">Guest count</a><a class="dropdown-item" href="javascript:void(0)" id="rt" onclick="edit_leads('+data['leads_id']+')">Edit</a><a class="dropdown-item" href="javascript:void(0)" id="rt" onclick="view_lead_details('+data['leads_id']+')">view</a><a class="dropdown-item" href="javascript:void(0)" onclick="return delete_leads('+data['leads_id']+')">Delete</a></div></div>');
              
                 let actionHtml = '<div class="dropdown ms-auto text-end"><div class="btn-link" data-bs-toggle="dropdown"><svg width="24px" height="24px" viewBox="0 0 24 24" version="1.1"><g stroke="none" stroke-width="1" fill="none" fill-rule="evenodd"><rect x="0" y="0" width="24" height="24"></rect><circle fill="#000000" cx="5" cy="12" r="2"></circle><circle fill="#000000" cx="12" cy="12" r="2"></circle><circle fill="#000000" cx="19" cy="12" r="2"></circle></g></svg></div><div class="dropdown-menu dropdown-menu-end">';
                // Edit button
                if (hasPermission('LEADS_UPDATE')) {
                    actionHtml += '<a class="dropdown-item" href="javascript:void(0)" id="rt" onclick="edit_leads('+data['leads_id']+')">Edit</a>';
                }

               // Change status button
                if (hasPermission('LEADS_CHANGE_STATUS')) {
                    actionHtml += '<a class="dropdown-item" href="javascript:void(0)" id="rt" onclick="openChangeStatus1Modal('+data['leads_id']+')">Change status</a>';
                }

                // Show status button
                if (hasPermission('LEADS_SHOW_STATUS')) {
                    actionHtml += '<a class="dropdown-item" href="javascript:void(0)" id="rt" onclick="showStatus1Modal('+data['leads_id']+')">Status history</a>';
                }

                // Change stage button
                if (hasPermission('LEADS_CHANGE_STAGE')) {
                    actionHtml += '<a class="dropdown-item" href="javascript:void(0)" id="rt" onclick="openChangeStatusModal('+data['leads_id']+')">Change stage</a>';
                }

                // Show stage button
                if (hasPermission('LEADS_SHOW_STAGE')) {
                    actionHtml += '<a class="dropdown-item" href="javascript:void(0)" id="rt" onclick="showStatusModal('+data['leads_id']+')">Show stages</a>';
                }

                // Guest count button
                if (hasPermission('LEADS_GUEST_COUNT')) {
                    actionHtml += '<a class="dropdown-item" href="javascript:void(0)" id="rt"  onclick="open_guest_count_checked('+data['leads_id']+')">Guest count</a>';
                }

                // Details button
                if (hasPermission('LEADS_DETAILS')) {
                    actionHtml += '<a class="dropdown-item" href="javascript:void(0)" id="rt" onclick="view_lead_details('+data['leads_id']+')">view</a>';
                }

                // Delete button
                if (hasPermission('LEADS_DELETE')) {
                    actionHtml += '<a class="dropdown-item" href="javascript:void(0)" onclick="return delete_leads('+data['leads_id']+')">Delete</a>';
                }

                actionHtml += '</div></div>';

                $('td', row).eq(11).html(actionHtml);

                }
              
              if(data['leads_accomodation_status'] == 1 && data['leads_quotation_status'] == 0){

                $('td', row).eq(1).html('<a class="leads-number-link" href="javascript:void(0)" onclick="view_lead_details('+data['leads_id']+')">'+data['leads_number']+'</a><br><span class="badge badge-xs badge badge-warning">accommodation required</span>');
                
                // $('td', row).eq(11).html('<div class="dropdown ms-auto text-end"><div class="btn-link" data-bs-toggle="dropdown"><svg width="24px" height="24px" viewBox="0 0 24 24" version="1.1"><g stroke="none" stroke-width="1" fill="none" fill-rule="evenodd"><rect x="0" y="0" width="24" height="24"></rect><circle fill="#000000" cx="5" cy="12" r="2"></circle><circle fill="#000000" cx="12" cy="12" r="2"></circle><circle fill="#000000" cx="19" cy="12" r="2"></circle></g></svg></div><div class="dropdown-menu dropdown-menu-end"><a class="dropdown-item" href="javascript:void(0)" id="rt" onclick="openChangeStatusModal('+data['leads_id']+')">Change stage</a><a class="dropdown-item" href="javascript:void(0)" id="rt" onclick="showStatusModal('+data['leads_id']+')">Show stages</a><a class="dropdown-item" href="javascript:void(0)" id="rt" onclick="openChangeStatus1Modal('+data['leads_id']+')">Change status</a><a class="dropdown-item" href="javascript:void(0)" id="rt" onclick="showStatus1Modal('+data['leads_id']+')">Status history</a><a class="dropdown-item" href="javascript:void(0)" id="rt"  onclick="guset_count_edit('+data['leads_id']+')">Guest count</a><a class="dropdown-item" href="javascript:void(0)" id="rt"  onclick="accomodation_plan('+data['leads_id']+')">Accomodation plan</a><a class="dropdown-item" href="javascript:void(0)" id="rt" onclick="edit_leads('+data['leads_id']+')">Edit</a><a class="dropdown-item" href="javascript:void(0)" id="rt" onclick="view_lead_details('+data['leads_id']+')">view</a><a class="dropdown-item" href="javascript:void(0)" onclick="return delete_leads('+data['leads_id']+')">Delete</a></div></div>');

                let actionHtml = '<div class="dropdown ms-auto text-end"><div class="btn-link" data-bs-toggle="dropdown"><svg width="24px" height="24px" viewBox="0 0 24 24" version="1.1"><g stroke="none" stroke-width="1" fill="none" fill-rule="evenodd"><rect x="0" y="0" width="24" height="24"></rect><circle fill="#000000" cx="5" cy="12" r="2"></circle><circle fill="#000000" cx="12" cy="12" r="2"></circle><circle fill="#000000" cx="19" cy="12" r="2"></circle></g></svg></div><div class="dropdown-menu dropdown-menu-end">';
                
                // Edit button
                if (hasPermission('LEADS_UPDATE')) {
                    actionHtml += '<a class="dropdown-item" href="javascript:void(0)" id="rt" onclick="edit_leads('+data['leads_id']+')">Edit</a>';
                }

               // Change status button
                if (hasPermission('LEADS_CHANGE_STATUS')) {
                    actionHtml += '<a class="dropdown-item" href="javascript:void(0)" id="rt" onclick="openChangeStatus1Modal('+data['leads_id']+')">Change status</a>';
                }

                // Show status button
                if (hasPermission('LEADS_SHOW_STATUS')) {
                    actionHtml += '<a class="dropdown-item" href="javascript:void(0)" id="rt" onclick="showStatus1Modal('+data['leads_id']+')">Status history</a>';
                }

                // Change stage button
                if (hasPermission('LEADS_CHANGE_STAGE')) {
                    actionHtml += '<a class="dropdown-item" href="javascript:void(0)" id="rt" onclick="openChangeStatusModal('+data['leads_id']+')">Change stage</a>';
                }

                // Show stage button
                if (hasPermission('LEADS_SHOW_STAGE')) {
                    actionHtml += '<a class="dropdown-item" href="javascript:void(0)" id="rt" onclick="showStatusModal('+data['leads_id']+')">Show stages</a>';
                }

                // Guest count button
                if (hasPermission('LEADS_GUEST_COUNT')) {
                    actionHtml += '<a class="dropdown-item" href="javascript:void(0)" id="rt"  onclick="open_guest_count_checked('+data['leads_id']+')">Guest count</a>';
                }

                 // Accomodation plan button
                if (hasPermission('LEADS_ACCOMODATION_PLAN')) {
                    actionHtml += '<a class="dropdown-item" href="javascript:void(0)" id="rt"  onclick="open_accommodation_checked('+data['leads_id']+')">Accomodation plan</a>';
                }

                // Details button
                if (hasPermission('LEADS_DETAILS')) {
                    actionHtml += '<a class="dropdown-item" href="javascript:void(0)" id="rt" onclick="view_lead_details('+data['leads_id']+')">view</a>';
                }

                // Delete button
                if (hasPermission('LEADS_DELETE')) {
                    actionHtml += '<a class="dropdown-item" href="javascript:void(0)" onclick="return delete_leads('+data['leads_id']+')">Delete</a>';
                }

                actionHtml += '</div></div>';

                $('td', row).eq(11).html(actionHtml);

                }

              if(data['leads_accomodation_status'] == 2 && data['leads_quotation_status'] == 0){

                // $('td', row).eq(11).html('<div class="dropdown ms-auto text-end"><div class="btn-link" data-bs-toggle="dropdown"><svg width="24px" height="24px" viewBox="0 0 24 24" version="1.1"><g stroke="none" stroke-width="1" fill="none" fill-rule="evenodd"><rect x="0" y="0" width="24" height="24"></rect><circle fill="#000000" cx="5" cy="12" r="2"></circle><circle fill="#000000" cx="12" cy="12" r="2"></circle><circle fill="#000000" cx="19" cy="12" r="2"></circle></g></svg></div><div class="dropdown-menu dropdown-menu-end"><a class="dropdown-item" href="javascript:void(0)" id="rt" onclick="openChangeStatusModal('+data['leads_id']+')">Change stage</a><a class="dropdown-item" href="javascript:void(0)" id="rt" onclick="showStatusModal('+data['leads_id']+')">Show stages</a><a class="dropdown-item" href="javascript:void(0)" id="rt" onclick="openChangeStatus1Modal('+data['leads_id']+')">Change status</a><a class="dropdown-item" href="javascript:void(0)" id="rt" onclick="showStatus1Modal('+data['leads_id']+')">Status history</a><a class="dropdown-item" href="javascript:void(0)" id="rt"  onclick="guset_count_edit('+data['leads_id']+')">Guest count</a><a class="dropdown-item" href="javascript:void(0)" id="rt"  onclick="accomodation_plan('+data['leads_id']+')">Accomodation plan</a><a class="dropdown-item" href="javascript:void(0)" id="rt" onclick="open_quotation('+data['leads_id']+')">Quotation</a><a class="dropdown-item" href="javascript:void(0)" id="rt" onclick="edit_leads('+data['leads_id']+')">Edit</a><a class="dropdown-item" href="javascript:void(0)" id="rt" onclick="view_lead_details('+data['leads_id']+')">view</a><a class="dropdown-item" href="javascript:void(0)" onclick="return delete_leads('+data['leads_id']+')">Delete</a></div></div>');

                $('td', row).eq(1).html('<a class="leads-number-link" href="javascript:void(0)" onclick="view_lead_details('+data['leads_id']+')">'+data['leads_number']+'</a><br><span class="badge badge-xs badge badge-info">Quotation not created</span>');

                let actionHtml = '<div class="dropdown ms-auto text-end"><div class="btn-link" data-bs-toggle="dropdown"><svg width="24px" height="24px" viewBox="0 0 24 24" version="1.1"><g stroke="none" stroke-width="1" fill="none" fill-rule="evenodd"><rect x="0" y="0" width="24" height="24"></rect><circle fill="#000000" cx="5" cy="12" r="2"></circle><circle fill="#000000" cx="12" cy="12" r="2"></circle><circle fill="#000000" cx="19" cy="12" r="2"></circle></g></svg></div><div class="dropdown-menu dropdown-menu-end">';
                
                // Edit button
                if (hasPermission('LEADS_UPDATE')) {
                    actionHtml += '<a class="dropdown-item" href="javascript:void(0)" id="rt" onclick="edit_leads('+data['leads_id']+')">Edit</a>';
                }

               // Change status button
                if (hasPermission('LEADS_CHANGE_STATUS')) {
                    actionHtml += '<a class="dropdown-item" href="javascript:void(0)" id="rt" onclick="openChangeStatus1Modal('+data['leads_id']+')">Change status</a>';
                }

                // Show status button
                if (hasPermission('LEADS_SHOW_STATUS')) {
                    actionHtml += '<a class="dropdown-item" href="javascript:void(0)" id="rt" onclick="showStatus1Modal('+data['leads_id']+')">Status history</a>';
                }

                // Change stage button
                if (hasPermission('LEADS_CHANGE_STAGE')) {
                    actionHtml += '<a class="dropdown-item" href="javascript:void(0)" id="rt" onclick="openChangeStatusModal('+data['leads_id']+')">Change stage</a>';
                }

                // Show stage button
                if (hasPermission('LEADS_SHOW_STAGE')) {
                    actionHtml += '<a class="dropdown-item" href="javascript:void(0)" id="rt" onclick="showStatusModal('+data['leads_id']+')">Show stages</a>';
                }

                // Guest count button
                if (hasPermission('LEADS_GUEST_COUNT')) {
                    actionHtml += '<a class="dropdown-item" href="javascript:void(0)" id="rt"  onclick="open_guest_count_checked('+data['leads_id']+')">Guest count</a>';
                }

                // Accomodation plan button
                if (hasPermission('LEADS_ACCOMODATION_PLAN')) {
                    actionHtml += '<a class="dropdown-item" href="javascript:void(0)" id="rt"  onclick="open_accommodation_checked('+data['leads_id']+')">Accomodation plan</a>';
                }

                // Quotation button
                if (hasPermission('LEADS_QUOTATION')) {
                    actionHtml += '<a class="dropdown-item" href="javascript:void(0)" id="rt" onclick="open_quotation('+data['leads_id']+')">Quotation</a>';
                }

                // Details button
                if (hasPermission('LEADS_DETAILS')) {
                    actionHtml += '<a class="dropdown-item" href="javascript:void(0)" id="rt" onclick="view_lead_details('+data['leads_id']+')">view</a>';
                }

                // Delete button
                if (hasPermission('LEADS_DELETE')) {
                    actionHtml += '<a class="dropdown-item" href="javascript:void(0)" onclick="return delete_leads('+data['leads_id']+')">Delete</a>';
                }

                actionHtml += '</div></div>';

                $('td', row).eq(11).html(actionHtml);

              }
              renderRejectedQuotationRow(data, row);
              renderQuotationCreatedRow(data, row);
              renderCancelledQuotationRow(data, row);
              if(data['leads_accomodation_status'] == 2 && data['leads_quotation_status'] == 1){

                    // $('td', row).eq(11).html('<div class="dropdown ms-auto text-end"><div class="btn-link" data-bs-toggle="dropdown"><svg width="24px" height="24px" viewBox="0 0 24 24" version="1.1"><g stroke="none" stroke-width="1" fill="none" fill-rule="evenodd"><rect x="0" y="0" width="24" height="24"></rect><circle fill="#000000" cx="5" cy="12" r="2"></circle><circle fill="#000000" cx="12" cy="12" r="2"></circle><circle fill="#000000" cx="19" cy="12" r="2"></circle></g></svg></div><div class="dropdown-menu dropdown-menu-end"><a class="dropdown-item" href="javascript:void(0)" id="rt" onclick="openChangeStatusModal('+data['leads_id']+')">Change stage</a><a class="dropdown-item" href="javascript:void(0)" id="rt" onclick="showStatusModal('+data['leads_id']+')">Show stages</a><a class="dropdown-item" href="javascript:void(0)" id="rt" onclick="openChangeStatus1Modal('+data['leads_id']+')">Change status</a><a class="dropdown-item" href="javascript:void(0)" id="rt" onclick="showStatus1Modal('+data['leads_id']+')">Status history</a><a class="dropdown-item" href="javascript:void(0)" id="rt" onclick="edit_leads('+data['leads_id']+')">Edit</a><a class="dropdown-item" href="javascript:void(0)" id="rt" onclick="view_lead_details('+data['leads_id']+')">view</a><a class="dropdown-item" href="javascript:void(0)" onclick="return delete_leads('+data['leads_id']+')">Delete</a></div></div>');

                    $('td', row).eq(1).html('<a class="leads-number-link" href="javascript:void(0)" onclick="view_lead_details('+data['leads_id']+')">'+data['leads_number']+'</a><br><span class="badge badge-xs badge badge-success">Quotation created</span>');

                    let actionHtml = '<div class="dropdown ms-auto text-end"><div class="btn-link" data-bs-toggle="dropdown"><svg width="24px" height="24px" viewBox="0 0 24 24" version="1.1"><g stroke="none" stroke-width="1" fill="none" fill-rule="evenodd"><rect x="0" y="0" width="24" height="24"></rect><circle fill="#000000" cx="5" cy="12" r="2"></circle><circle fill="#000000" cx="12" cy="12" r="2"></circle><circle fill="#000000" cx="19" cy="12" r="2"></circle></g></svg></div><div class="dropdown-menu dropdown-menu-end">';
                
                // Edit button
                if (hasPermission('LEADS_UPDATE')) {
                    actionHtml += '<a class="dropdown-item" href="javascript:void(0)" id="rt" onclick="edit_leads('+data['leads_id']+')">Edit</a>';
                }

               // Change status button
                if (hasPermission('LEADS_CHANGE_STATUS')) {
                    actionHtml += '<a class="dropdown-item" href="javascript:void(0)" id="rt" onclick="openChangeStatus1Modal('+data['leads_id']+')">Change status</a>';
                }

                // Show status button
                if (hasPermission('LEADS_SHOW_STATUS')) {
                    actionHtml += '<a class="dropdown-item" href="javascript:void(0)" id="rt" onclick="showStatus1Modal('+data['leads_id']+')">Status history</a>';
                }

                // Change stage button
                if (hasPermission('LEADS_CHANGE_STAGE')) {
                    actionHtml += '<a class="dropdown-item" href="javascript:void(0)" id="rt" onclick="openChangeStatusModal('+data['leads_id']+')">Change stage</a>';
                }

                // Show stage button
                if (hasPermission('LEADS_SHOW_STAGE')) {
                    actionHtml += '<a class="dropdown-item" href="javascript:void(0)" id="rt" onclick="showStatusModal('+data['leads_id']+')">Show stages</a>';
                }

                // Details button
                if (hasPermission('LEADS_DETAILS')) {
                    actionHtml += '<a class="dropdown-item" href="javascript:void(0)" id="rt" onclick="view_lead_details('+data['leads_id']+')">view</a>';
                }

                // Delete button
                if (hasPermission('LEADS_DELETE')) {
                    actionHtml += '<a class="dropdown-item" href="javascript:void(0)" onclick="return delete_leads('+data['leads_id']+')">Delete</a>';
                }

                actionHtml += '</div></div>';

                $('td', row).eq(11).html(actionHtml);
              }
              if(data['leads_accomodation_status'] == 2 && data['leads_quotation_status'] == 2){

                    // $('td', row).eq(11).html('<div class="dropdown ms-auto text-end"><div class="btn-link" data-bs-toggle="dropdown"><svg width="24px" height="24px" viewBox="0 0 24 24" version="1.1"><g stroke="none" stroke-width="1" fill="none" fill-rule="evenodd"><rect x="0" y="0" width="24" height="24"></rect><circle fill="#000000" cx="5" cy="12" r="2"></circle><circle fill="#000000" cx="12" cy="12" r="2"></circle><circle fill="#000000" cx="19" cy="12" r="2"></circle></g></svg></div><div class="dropdown-menu dropdown-menu-end"><a class="dropdown-item" href="javascript:void(0)" id="rt" onclick="openChangeStatusModal('+data['leads_id']+')">Change stage</a><a class="dropdown-item" href="javascript:void(0)" id="rt" onclick="showStatusModal('+data['leads_id']+')">Show stages</a><a class="dropdown-item" href="javascript:void(0)" id="rt" onclick="openChangeStatus1Modal('+data['leads_id']+')">Change status</a><a class="dropdown-item" href="javascript:void(0)" id="rt" onclick="showStatus1Modal('+data['leads_id']+')">Status history</a><a class="dropdown-item" href="javascript:void(0)" id="rt" onclick="edit_leads('+data['leads_id']+')">Edit</a><a class="dropdown-item" href="javascript:void(0)" id="rt" onclick="view_lead_details('+data['leads_id']+')">view</a><a class="dropdown-item" href="javascript:void(0)" onclick="return delete_leads('+data['leads_id']+')">Delete</a></div></div>');

                    $('td', row).eq(1).html('<a class="leads-number-link" href="javascript:void(0)" onclick="view_lead_details('+data['leads_id']+')">'+data['leads_number']+'</a><br><span class="badge badge-xs badge badge-info">Cancelled/Quotation not created</span>');

                    let actionHtml = '<div class="dropdown ms-auto text-end"><div class="btn-link" data-bs-toggle="dropdown"><svg width="24px" height="24px" viewBox="0 0 24 24" version="1.1"><g stroke="none" stroke-width="1" fill="none" fill-rule="evenodd"><rect x="0" y="0" width="24" height="24"></rect><circle fill="#000000" cx="5" cy="12" r="2"></circle><circle fill="#000000" cx="12" cy="12" r="2"></circle><circle fill="#000000" cx="19" cy="12" r="2"></circle></g></svg></div><div class="dropdown-menu dropdown-menu-end">';
                
                // Edit button
                if (hasPermission('LEADS_UPDATE')) {
                    actionHtml += '<a class="dropdown-item" href="javascript:void(0)" id="rt" onclick="edit_leads('+data['leads_id']+')">Edit</a>';
                }

               // Change status button
                if (hasPermission('LEADS_CHANGE_STATUS')) {
                    actionHtml += '<a class="dropdown-item" href="javascript:void(0)" id="rt" onclick="openChangeStatus1Modal('+data['leads_id']+')">Change status</a>';
                }

                // Show status button
                if (hasPermission('LEADS_SHOW_STATUS')) {
                    actionHtml += '<a class="dropdown-item" href="javascript:void(0)" id="rt" onclick="showStatus1Modal('+data['leads_id']+')">Status history</a>';
                }

                // Change stage button
                if (hasPermission('LEADS_CHANGE_STAGE')) {
                    actionHtml += '<a class="dropdown-item" href="javascript:void(0)" id="rt" onclick="openChangeStatusModal('+data['leads_id']+')">Change stage</a>';
                }

                // Show stage button
                if (hasPermission('LEADS_SHOW_STAGE')) {
                    actionHtml += '<a class="dropdown-item" href="javascript:void(0)" id="rt" onclick="showStatusModal('+data['leads_id']+')">Show stages</a>';
                }

                // Guest count button
                if (hasPermission('LEADS_GUEST_COUNT')) {
                    actionHtml += '<a class="dropdown-item" href="javascript:void(0)" id="rt"  onclick="open_guest_count_checked('+data['leads_id']+')">Guest count</a>';
                }

                // Accomodation plan button
                if (hasPermission('LEADS_ACCOMODATION_PLAN')) {
                    actionHtml += '<a class="dropdown-item" href="javascript:void(0)" id="rt"  onclick="open_accommodation_checked('+data['leads_id']+')">Accomodation plan</a>';
                }

                // Quotation button
                if (hasPermission('LEADS_QUOTATION')) {
                    actionHtml += '<a class="dropdown-item" href="javascript:void(0)" id="rt" onclick="open_quotation('+data['leads_id']+')">Quotation</a>';
                }

                // Details button
                if (hasPermission('LEADS_DETAILS')) {
                    actionHtml += '<a class="dropdown-item" href="javascript:void(0)" id="rt" onclick="view_lead_details('+data['leads_id']+')">view</a>';
                }

                // Delete button
                if (hasPermission('LEADS_DELETE')) {
                    actionHtml += '<a class="dropdown-item" href="javascript:void(0)" onclick="return delete_leads('+data['leads_id']+')">Delete</a>';
                }

                actionHtml += '</div></div>';

                $('td', row).eq(11).html(actionHtml);
              }
              renderRejectedQuotationRow(data, row);
            }
        
          });
          
          
            // $('td', row).eq(4).html('<center>'+data['leads_created_at']+'</center>');
            
           },

           "drawCallback": function( settings ) {
                // displaySelectByUserType();
            },

        "columns": [
            { "data": "leads_status", "orderable": false },
            { "data": "leads_number", "orderable": false },
            { "data": "guest_name", "orderable": false },
            { "data": "whats_number", "orderable": false },
            { "data": "lead_register_date", "orderable": false },
            { "data": "start_date", "orderable": false },
            { "data": "duration", "orderable": false },
            { "data": "admin_name", "orderable": false },
            { "data": "lead_current_status", "orderable": false },
            { "data": "stages_button", "orderable": false },
            { "data": "priority_status_button", "orderable": false },
            { "data": "leads_id", "orderable": false }
            
            
        ]
        
    });
    
  

  });
 
$('#leads_daterange2').daterangepicker({
    autoUpdateInput: false,
    locale: {
        format: 'DD/MM/YYYY',
        cancelLabel: 'Clear'
    }
});

$('#leads_daterange2').on('apply.daterangepicker', function(ev, picker) {
    $(this).val(
        picker.startDate.format('DD/MM/YYYY') + ' - ' + picker.endDate.format('DD/MM/YYYY')
    );
});

$('#leads_daterange2').on('cancel.daterangepicker', function() {
    $(this).val('');
});


// Travel date
$('#travel_daterange2').daterangepicker({
    autoUpdateInput: false,
    locale: {
        format: 'DD/MM/YYYY',
        cancelLabel: 'Clear'
    }
});

$('#travel_daterange2').on('apply.daterangepicker', function(ev, picker) {
    $(this).val(
        picker.startDate.format('DD/MM/YYYY') + ' - ' + picker.endDate.format('DD/MM/YYYY')
    );
});

$('#travel_daterange2').on('cancel.daterangepicker', function() {
    $(this).val('');
});

 var table2;
  $(document).ready(function() {
    
    
    $table2 = $('#meta_Leads_table').DataTable( {
        "processing": true,
        "serverSide": true,
        "searching": false,
        "aLengthMenu": [[10, 25, 50, -1], [10, 25, 50, "All"]],
        // "bDestroy" : true,
        dom: 'lBfrtip',
            buttons: [
                
                                {
                                    extend: 'excel',
                                    exportOptions: {
                                        columns: [0, 1, 2, 3, 4, 5, 6, 7, 8, 9, 10]
                                    },
                                    title: 'Meta Leads details',
                                },
                                {
                                    extend: 'pdf',
                                    exportOptions: {
                                        columns: [0, 1, 2, 3, 4, 5, 6, 7, 8, 9, 10]
                                    },
                                    title: 'Meta Leads details',
                                },
                                {
                                    extend: 'print',
                                    exportOptions: {
                                        columns: [0, 1, 2, 3, 4, 5, 6, 7, 8, 9, 10]
                                    },
                                    title: 'Meta Leads details',
                                    customize: function ( win ) {
                                    $(win.document.body)
                                      .css( 'font-size', '10pt' )
                                      .prepend(
                                        // '<img src="http://datatables.net/media/images/logo-fade.png" style="position:absolute; top:0; left:0;" />'
                                      );

                                    $(win.document.body).find( 'table' )
                                      .addClass( 'compact' )
                                      .css( 'font-size', 'inherit' );
                                    },
                                },
                               
            ],
        "ajax": {
            "url": "<?php echo base_url();?>index.php/Leads/get_meta/",
            "type": "POST",
            "data" : function (d) {
                        d.staff_id2 = $("#staff_id2").val();
                        d.source_id2 = $("#source_id2").val();
                        d.packages_id2 = $("#packages_id2").val();
                        d.facebook_ads = $("#facebook_ads").val();
                        d.country_id2 = $("#country_id2").val();
                        d.priority_status_id2 = $("#priority_status_id2").val();
                        d.stages_id2 = $("#stages_id2").val();
                        d.lead_type2 = $("#lead_type2").val();
                        d.lead_current_status2 = $("#lead_current_status2").val();
                        d.leads_accomodation_status2 = $("#leads_accomodation_status2").val();
                        d.guest_name_filter2 = $("#guest_name_filter2").val();
                        d.whats_number_filter2 = $("#whats_number_filter2").val();
                        d.leads_createdby_userid2 = $("#leads_createdby_userid2").val();
                        // d.leads_start_date2 = $("#leads_start_date2").val();
                        // d.leads_end_date2 = $("#leads_end_date2").val();
                        // d.travels_start_date2 = $("#travels_start_date2").val();
                        // d.travels_end_date2 = $("#travels_end_date2").val();
                        // Lead date range
                        var leadRange2 = $("#leads_daterange2").val();
                        if (leadRange2) {
                            var dates = leadRange2.split(' - ');
                            d.leads_start_date2 = dates[0];
                            d.leads_end_date2   = dates[1];
                        } else {
                            d.leads_start_date2 = '';
                            d.leads_end_date2   = '';
                        }

                        // Travel date range
                        var travelRange2 = $("#travel_daterange2").val();
                        if (travelRange2) {
                            var dates2 = travelRange2.split(' - ');
                            d.travels_start_date2 = dates2[0];
                            d.travels_end_date2   = dates2[1];
                        } else {
                            d.travels_start_date2 = '';
                            d.travels_end_date2   = '';
                        }
           }            
        },
        // "ajax": {
            // "url": "<?php echo site_url('States/get')?>",
            // "type": "POST"
        // },
        "createdRow": function ( row, data, index ) {
          
//            $('td',row).eq(0).html(index+1);
           $table2.column(0).nodes().each(function(node,index,dt){
            $table2.cell(node).data(index+1);
            });
            
            

            $table2.column(8).nodes().each(function(node, index, dt) {
              if($table2.cell(node).data() == '1') {
					    $table2.cell(node).data('<center><span class="badge badge-sm light btn-info">In take</span></center>');
              // if(data['lead_current_status'] == 1){
              // $('td', row).eq(9).html('<span class="badge badge-info">In take</span>');

              if(data['leads_accomodation_status'] == 0 && data['leads_quotation_status'] == 0){
              
                $('td', row).eq(1).html('<a class="leads-number-link" href="javascript:void(0)" onclick="view_lead_details('+data['leads_id']+')">'+data['leads_number']+'</a><br><span class="badge badge-xs badge badge-primary">guest count required</span>');
                // $('td', row).eq(11).html('<div class="dropdown ms-auto text-end"><div class="btn-link" data-bs-toggle="dropdown"><svg width="24px" height="24px" viewBox="0 0 24 24" version="1.1"><g stroke="none" stroke-width="1" fill="none" fill-rule="evenodd"><rect x="0" y="0" width="24" height="24"></rect><circle fill="#000000" cx="5" cy="12" r="2"></circle><circle fill="#000000" cx="12" cy="12" r="2"></circle><circle fill="#000000" cx="19" cy="12" r="2"></circle></g></svg></div><div class="dropdown-menu dropdown-menu-end"><a class="dropdown-item" href="javascript:void(0)" id="rt" onclick="openChangeStatusModal('+data['leads_id']+')">Change stage</a><a class="dropdown-item" href="javascript:void(0)" id="rt" onclick="showStatusModal('+data['leads_id']+')">Show stages</a><a class="dropdown-item" href="javascript:void(0)" id="rt" onclick="openChangeStatus1Modal('+data['leads_id']+')">Change status</a><a class="dropdown-item" href="javascript:void(0)" id="rt" onclick="showStatus1Modal('+data['leads_id']+')">Status history</a><a class="dropdown-item" href="javascript:void(0)" id="rt"  onclick="guset_count_edit('+data['leads_id']+')">Guest count</a><a class="dropdown-item" href="javascript:void(0)" id="rt" onclick="edit_leads('+data['leads_id']+')">Edit</a><a class="dropdown-item" href="javascript:void(0)" id="rt" onclick="view_lead_details('+data['leads_id']+')">view</a><a class="dropdown-item" href="javascript:void(0)" onclick="return delete_leads('+data['leads_id']+')">Delete</a></div></div>');
              
                 let actionHtml = '<div class="dropdown ms-auto text-end"><div class="btn-link" data-bs-toggle="dropdown"><svg width="24px" height="24px" viewBox="0 0 24 24" version="1.1"><g stroke="none" stroke-width="1" fill="none" fill-rule="evenodd"><rect x="0" y="0" width="24" height="24"></rect><circle fill="#000000" cx="5" cy="12" r="2"></circle><circle fill="#000000" cx="12" cy="12" r="2"></circle><circle fill="#000000" cx="19" cy="12" r="2"></circle></g></svg></div><div class="dropdown-menu dropdown-menu-end">';
                // Edit button
                if (hasPermission('LEADS_UPDATE')) {
                    actionHtml += '<a class="dropdown-item" href="javascript:void(0)" id="rt" onclick="edit_leads('+data['leads_id']+')">Edit</a>';
                }

               // Change status button
                if (hasPermission('LEADS_CHANGE_STATUS')) {
                    actionHtml += '<a class="dropdown-item" href="javascript:void(0)" id="rt" onclick="openChangeStatus1Modal('+data['leads_id']+')">Change status</a>';
                }

                // Show status button
                if (hasPermission('LEADS_SHOW_STATUS')) {
                    actionHtml += '<a class="dropdown-item" href="javascript:void(0)" id="rt" onclick="showStatus1Modal('+data['leads_id']+')">Status history</a>';
                }

                // Change stage button
                if (hasPermission('LEADS_CHANGE_STAGE')) {
                    actionHtml += '<a class="dropdown-item" href="javascript:void(0)" id="rt" onclick="openChangeStatusModal('+data['leads_id']+')">Change stage</a>';
                }

                // Show stage button
                if (hasPermission('LEADS_SHOW_STAGE')) {
                    actionHtml += '<a class="dropdown-item" href="javascript:void(0)" id="rt" onclick="showStatusModal('+data['leads_id']+')">Show stages</a>';
                }

                // Guest count button
                if (hasPermission('LEADS_GUEST_COUNT')) {
                    actionHtml += '<a class="dropdown-item" href="javascript:void(0)" id="rt"  onclick="open_guest_count_checked('+data['leads_id']+')">Guest count</a>';
                }

                // Details button
                if (hasPermission('LEADS_DETAILS')) {
                    actionHtml += '<a class="dropdown-item" href="javascript:void(0)" id="rt" onclick="view_lead_details('+data['leads_id']+')">view</a>';
                }

                // Delete button
                if (hasPermission('LEADS_DELETE')) {
                    actionHtml += '<a class="dropdown-item" href="javascript:void(0)" onclick="return delete_leads('+data['leads_id']+')">Delete</a>';
                }

                actionHtml += '</div></div>';

                $('td', row).eq(11).html(actionHtml);

                }
              
              if(data['leads_accomodation_status'] == 1 && data['leads_quotation_status'] == 0){

                // $('td', row).eq(11).html('<div class="dropdown ms-auto text-end"><div class="btn-link" data-bs-toggle="dropdown"><svg width="24px" height="24px" viewBox="0 0 24 24" version="1.1"><g stroke="none" stroke-width="1" fill="none" fill-rule="evenodd"><rect x="0" y="0" width="24" height="24"></rect><circle fill="#000000" cx="5" cy="12" r="2"></circle><circle fill="#000000" cx="12" cy="12" r="2"></circle><circle fill="#000000" cx="19" cy="12" r="2"></circle></g></svg></div><div class="dropdown-menu dropdown-menu-end"><a class="dropdown-item" href="javascript:void(0)" id="rt" onclick="openChangeStatusModal('+data['leads_id']+')">Change stage</a><a class="dropdown-item" href="javascript:void(0)" id="rt" onclick="showStatusModal('+data['leads_id']+')">Show stages</a><a class="dropdown-item" href="javascript:void(0)" id="rt" onclick="openChangeStatus1Modal('+data['leads_id']+')">Change status</a><a class="dropdown-item" href="javascript:void(0)" id="rt" onclick="showStatus1Modal('+data['leads_id']+')">Status history</a><a class="dropdown-item" href="javascript:void(0)" id="rt"  onclick="guset_count_edit('+data['leads_id']+')">Guest count</a><a class="dropdown-item" href="javascript:void(0)" id="rt"  onclick="accomodation_plan('+data['leads_id']+')">Accomodation plan</a><a class="dropdown-item" href="javascript:void(0)" id="rt" onclick="edit_leads('+data['leads_id']+')">Edit</a><a class="dropdown-item" href="javascript:void(0)" id="rt" onclick="view_lead_details('+data['leads_id']+')">view</a><a class="dropdown-item" href="javascript:void(0)" onclick="return delete_leads('+data['leads_id']+')">Delete</a></div></div>');

                $('td', row).eq(1).html('<a class="leads-number-link" href="javascript:void(0)" onclick="view_lead_details('+data['leads_id']+')">'+data['leads_number']+'</a><br><span class="badge badge-xs badge badge-warning">accommodation required</span>');

                let actionHtml = '<div class="dropdown ms-auto text-end"><div class="btn-link" data-bs-toggle="dropdown"><svg width="24px" height="24px" viewBox="0 0 24 24" version="1.1"><g stroke="none" stroke-width="1" fill="none" fill-rule="evenodd"><rect x="0" y="0" width="24" height="24"></rect><circle fill="#000000" cx="5" cy="12" r="2"></circle><circle fill="#000000" cx="12" cy="12" r="2"></circle><circle fill="#000000" cx="19" cy="12" r="2"></circle></g></svg></div><div class="dropdown-menu dropdown-menu-end">';
                
                // Edit button
                if (hasPermission('LEADS_UPDATE')) {
                    actionHtml += '<a class="dropdown-item" href="javascript:void(0)" id="rt" onclick="edit_leads('+data['leads_id']+')">Edit</a>';
                }

               // Change status button
                if (hasPermission('LEADS_CHANGE_STATUS')) {
                    actionHtml += '<a class="dropdown-item" href="javascript:void(0)" id="rt" onclick="openChangeStatus1Modal('+data['leads_id']+')">Change status</a>';
                }

                // Show status button
                if (hasPermission('LEADS_SHOW_STATUS')) {
                    actionHtml += '<a class="dropdown-item" href="javascript:void(0)" id="rt" onclick="showStatus1Modal('+data['leads_id']+')">Status history</a>';
                }

                // Change stage button
                if (hasPermission('LEADS_CHANGE_STAGE')) {
                    actionHtml += '<a class="dropdown-item" href="javascript:void(0)" id="rt" onclick="openChangeStatusModal('+data['leads_id']+')">Change stage</a>';
                }

                // Show stage button
                if (hasPermission('LEADS_SHOW_STAGE')) {
                    actionHtml += '<a class="dropdown-item" href="javascript:void(0)" id="rt" onclick="showStatusModal('+data['leads_id']+')">Show stages</a>';
                }

                // Guest count button
                if (hasPermission('LEADS_GUEST_COUNT')) {
                    actionHtml += '<a class="dropdown-item" href="javascript:void(0)" id="rt"  onclick="open_guest_count_checked('+data['leads_id']+')">Guest count</a>';
                }

                 // Accomodation plan button
                if (hasPermission('LEADS_ACCOMODATION_PLAN')) {
                    actionHtml += '<a class="dropdown-item" href="javascript:void(0)" id="rt"  onclick="open_accommodation_checked('+data['leads_id']+')">Accomodation plan</a>';
                }

                // Details button
                if (hasPermission('LEADS_DETAILS')) {
                    actionHtml += '<a class="dropdown-item" href="javascript:void(0)" id="rt" onclick="view_lead_details('+data['leads_id']+')">view</a>';
                }

                // Delete button
                if (hasPermission('LEADS_DELETE')) {
                    actionHtml += '<a class="dropdown-item" href="javascript:void(0)" onclick="return delete_leads('+data['leads_id']+')">Delete</a>';
                }

                actionHtml += '</div></div>';

                $('td', row).eq(11).html(actionHtml);

                }

              if(data['leads_accomodation_status'] == 2 && data['leads_quotation_status'] == 0){

                // $('td', row).eq(11).html('<div class="dropdown ms-auto text-end"><div class="btn-link" data-bs-toggle="dropdown"><svg width="24px" height="24px" viewBox="0 0 24 24" version="1.1"><g stroke="none" stroke-width="1" fill="none" fill-rule="evenodd"><rect x="0" y="0" width="24" height="24"></rect><circle fill="#000000" cx="5" cy="12" r="2"></circle><circle fill="#000000" cx="12" cy="12" r="2"></circle><circle fill="#000000" cx="19" cy="12" r="2"></circle></g></svg></div><div class="dropdown-menu dropdown-menu-end"><a class="dropdown-item" href="javascript:void(0)" id="rt" onclick="openChangeStatusModal('+data['leads_id']+')">Change stage</a><a class="dropdown-item" href="javascript:void(0)" id="rt" onclick="showStatusModal('+data['leads_id']+')">Show stages</a><a class="dropdown-item" href="javascript:void(0)" id="rt" onclick="openChangeStatus1Modal('+data['leads_id']+')">Change status</a><a class="dropdown-item" href="javascript:void(0)" id="rt" onclick="showStatus1Modal('+data['leads_id']+')">Status history</a><a class="dropdown-item" href="javascript:void(0)" id="rt"  onclick="guset_count_edit('+data['leads_id']+')">Guest count</a><a class="dropdown-item" href="javascript:void(0)" id="rt"  onclick="accomodation_plan('+data['leads_id']+')">Accomodation plan</a><a class="dropdown-item" href="javascript:void(0)" id="rt" onclick="open_quotation('+data['leads_id']+')">Quotation</a><a class="dropdown-item" href="javascript:void(0)" id="rt" onclick="edit_leads('+data['leads_id']+')">Edit</a><a class="dropdown-item" href="javascript:void(0)" id="rt" onclick="view_lead_details('+data['leads_id']+')">view</a><a class="dropdown-item" href="javascript:void(0)" onclick="return delete_leads('+data['leads_id']+')">Delete</a></div></div>');

                $('td', row).eq(1).html('<a class="leads-number-link" href="javascript:void(0)" onclick="view_lead_details('+data['leads_id']+')">'+data['leads_number']+'</a><br><span class="badge badge-xs badge badge-info">Quotation not created</span>');

                let actionHtml = '<div class="dropdown ms-auto text-end"><div class="btn-link" data-bs-toggle="dropdown"><svg width="24px" height="24px" viewBox="0 0 24 24" version="1.1"><g stroke="none" stroke-width="1" fill="none" fill-rule="evenodd"><rect x="0" y="0" width="24" height="24"></rect><circle fill="#000000" cx="5" cy="12" r="2"></circle><circle fill="#000000" cx="12" cy="12" r="2"></circle><circle fill="#000000" cx="19" cy="12" r="2"></circle></g></svg></div><div class="dropdown-menu dropdown-menu-end">';
                
                // Edit button
                if (hasPermission('LEADS_UPDATE')) {
                    actionHtml += '<a class="dropdown-item" href="javascript:void(0)" id="rt" onclick="edit_leads('+data['leads_id']+')">Edit</a>';
                }

               // Change status button
                if (hasPermission('LEADS_CHANGE_STATUS')) {
                    actionHtml += '<a class="dropdown-item" href="javascript:void(0)" id="rt" onclick="openChangeStatus1Modal('+data['leads_id']+')">Change status</a>';
                }

                // Show status button
                if (hasPermission('LEADS_SHOW_STATUS')) {
                    actionHtml += '<a class="dropdown-item" href="javascript:void(0)" id="rt" onclick="showStatus1Modal('+data['leads_id']+')">Status history</a>';
                }

                // Change stage button
                if (hasPermission('LEADS_CHANGE_STAGE')) {
                    actionHtml += '<a class="dropdown-item" href="javascript:void(0)" id="rt" onclick="openChangeStatusModal('+data['leads_id']+')">Change stage</a>';
                }

                // Show stage button
                if (hasPermission('LEADS_SHOW_STAGE')) {
                    actionHtml += '<a class="dropdown-item" href="javascript:void(0)" id="rt" onclick="showStatusModal('+data['leads_id']+')">Show stages</a>';
                }

                // Guest count button
                if (hasPermission('LEADS_GUEST_COUNT')) {
                    actionHtml += '<a class="dropdown-item" href="javascript:void(0)" id="rt"  onclick="open_guest_count_checked('+data['leads_id']+')">Guest count</a>';
                }

                // Accomodation plan button
                if (hasPermission('LEADS_ACCOMODATION_PLAN')) {
                    actionHtml += '<a class="dropdown-item" href="javascript:void(0)" id="rt"  onclick="open_accommodation_checked('+data['leads_id']+')">Accomodation plan</a>';
                }

                // Quotation button
                if (hasPermission('LEADS_QUOTATION')) {
                    actionHtml += '<a class="dropdown-item" href="javascript:void(0)" id="rt" onclick="open_quotation('+data['leads_id']+')">Quotation</a>';
                }

                // Details button
                if (hasPermission('LEADS_DETAILS')) {
                    actionHtml += '<a class="dropdown-item" href="javascript:void(0)" id="rt" onclick="view_lead_details('+data['leads_id']+')">view</a>';
                }

                // Delete button
                if (hasPermission('LEADS_DELETE')) {
                    actionHtml += '<a class="dropdown-item" href="javascript:void(0)" onclick="return delete_leads('+data['leads_id']+')">Delete</a>';
                }

                actionHtml += '</div></div>';

                $('td', row).eq(11).html(actionHtml);

              }
              renderRejectedQuotationRow(data, row);
              renderQuotationCreatedRow(data, row);
              renderCancelledQuotationRow(data, row);
              if(data['leads_accomodation_status'] == 2 && data['leads_quotation_status'] == 1){

                    // $('td', row).eq(11).html('<div class="dropdown ms-auto text-end"><div class="btn-link" data-bs-toggle="dropdown"><svg width="24px" height="24px" viewBox="0 0 24 24" version="1.1"><g stroke="none" stroke-width="1" fill="none" fill-rule="evenodd"><rect x="0" y="0" width="24" height="24"></rect><circle fill="#000000" cx="5" cy="12" r="2"></circle><circle fill="#000000" cx="12" cy="12" r="2"></circle><circle fill="#000000" cx="19" cy="12" r="2"></circle></g></svg></div><div class="dropdown-menu dropdown-menu-end"><a class="dropdown-item" href="javascript:void(0)" id="rt" onclick="openChangeStatusModal('+data['leads_id']+')">Change stage</a><a class="dropdown-item" href="javascript:void(0)" id="rt" onclick="showStatusModal('+data['leads_id']+')">Show stages</a><a class="dropdown-item" href="javascript:void(0)" id="rt" onclick="openChangeStatus1Modal('+data['leads_id']+')">Change status</a><a class="dropdown-item" href="javascript:void(0)" id="rt" onclick="showStatus1Modal('+data['leads_id']+')">Status history</a><a class="dropdown-item" href="javascript:void(0)" id="rt" onclick="edit_leads('+data['leads_id']+')">Edit</a><a class="dropdown-item" href="javascript:void(0)" id="rt" onclick="view_lead_details('+data['leads_id']+')">view</a><a class="dropdown-item" href="javascript:void(0)" onclick="return delete_leads('+data['leads_id']+')">Delete</a></div></div>');

                    $('td', row).eq(1).html('<a class="leads-number-link" href="javascript:void(0)" onclick="view_lead_details('+data['leads_id']+')">'+data['leads_number']+'</a><br><span class="badge badge-xs badge badge-success">Quotation created</span>');

                    let actionHtml = '<div class="dropdown ms-auto text-end"><div class="btn-link" data-bs-toggle="dropdown"><svg width="24px" height="24px" viewBox="0 0 24 24" version="1.1"><g stroke="none" stroke-width="1" fill="none" fill-rule="evenodd"><rect x="0" y="0" width="24" height="24"></rect><circle fill="#000000" cx="5" cy="12" r="2"></circle><circle fill="#000000" cx="12" cy="12" r="2"></circle><circle fill="#000000" cx="19" cy="12" r="2"></circle></g></svg></div><div class="dropdown-menu dropdown-menu-end">';
                
                // Edit button
                if (hasPermission('LEADS_UPDATE')) {
                    actionHtml += '<a class="dropdown-item" href="javascript:void(0)" id="rt" onclick="edit_leads('+data['leads_id']+')">Edit</a>';
                }

               // Change status button
                if (hasPermission('LEADS_CHANGE_STATUS')) {
                    actionHtml += '<a class="dropdown-item" href="javascript:void(0)" id="rt" onclick="openChangeStatus1Modal('+data['leads_id']+')">Change status</a>';
                }

                // Show status button
                if (hasPermission('LEADS_SHOW_STATUS')) {
                    actionHtml += '<a class="dropdown-item" href="javascript:void(0)" id="rt" onclick="showStatus1Modal('+data['leads_id']+')">Status history</a>';
                }

                // Change stage button
                if (hasPermission('LEADS_CHANGE_STAGE')) {
                    actionHtml += '<a class="dropdown-item" href="javascript:void(0)" id="rt" onclick="openChangeStatusModal('+data['leads_id']+')">Change stage</a>';
                }

                // Show stage button
                if (hasPermission('LEADS_SHOW_STAGE')) {
                    actionHtml += '<a class="dropdown-item" href="javascript:void(0)" id="rt" onclick="showStatusModal('+data['leads_id']+')">Show stages</a>';
                }

                // Details button
                if (hasPermission('LEADS_DETAILS')) {
                    actionHtml += '<a class="dropdown-item" href="javascript:void(0)" id="rt" onclick="view_lead_details('+data['leads_id']+')">view</a>';
                }

                // Delete button
                if (hasPermission('LEADS_DELETE')) {
                    actionHtml += '<a class="dropdown-item" href="javascript:void(0)" onclick="return delete_leads('+data['leads_id']+')">Delete</a>';
                }

                actionHtml += '</div></div>';

                $('td', row).eq(11).html(actionHtml);
              }
              if(data['leads_accomodation_status'] == 2 && data['leads_quotation_status'] == 2){

                    // $('td', row).eq(11).html('<div class="dropdown ms-auto text-end"><div class="btn-link" data-bs-toggle="dropdown"><svg width="24px" height="24px" viewBox="0 0 24 24" version="1.1"><g stroke="none" stroke-width="1" fill="none" fill-rule="evenodd"><rect x="0" y="0" width="24" height="24"></rect><circle fill="#000000" cx="5" cy="12" r="2"></circle><circle fill="#000000" cx="12" cy="12" r="2"></circle><circle fill="#000000" cx="19" cy="12" r="2"></circle></g></svg></div><div class="dropdown-menu dropdown-menu-end"><a class="dropdown-item" href="javascript:void(0)" id="rt" onclick="openChangeStatusModal('+data['leads_id']+')">Change stage</a><a class="dropdown-item" href="javascript:void(0)" id="rt" onclick="showStatusModal('+data['leads_id']+')">Show stages</a><a class="dropdown-item" href="javascript:void(0)" id="rt" onclick="openChangeStatus1Modal('+data['leads_id']+')">Change status</a><a class="dropdown-item" href="javascript:void(0)" id="rt" onclick="showStatus1Modal('+data['leads_id']+')">Status history</a><a class="dropdown-item" href="javascript:void(0)" id="rt" onclick="edit_leads('+data['leads_id']+')">Edit</a><a class="dropdown-item" href="javascript:void(0)" id="rt" onclick="view_lead_details('+data['leads_id']+')">view</a><a class="dropdown-item" href="javascript:void(0)" onclick="return delete_leads('+data['leads_id']+')">Delete</a></div></div>');

                    $('td', row).eq(1).html('<a class="leads-number-link" href="javascript:void(0)" onclick="view_lead_details('+data['leads_id']+')">'+data['leads_number']+'</a><br><span class="badge badge-xs badge badge-danger">Cancelled/Quotation not created</span>');

                    let actionHtml = '<div class="dropdown ms-auto text-end"><div class="btn-link" data-bs-toggle="dropdown"><svg width="24px" height="24px" viewBox="0 0 24 24" version="1.1"><g stroke="none" stroke-width="1" fill="none" fill-rule="evenodd"><rect x="0" y="0" width="24" height="24"></rect><circle fill="#000000" cx="5" cy="12" r="2"></circle><circle fill="#000000" cx="12" cy="12" r="2"></circle><circle fill="#000000" cx="19" cy="12" r="2"></circle></g></svg></div><div class="dropdown-menu dropdown-menu-end">';
                
                // Edit button
                if (hasPermission('LEADS_UPDATE')) {
                    actionHtml += '<a class="dropdown-item" href="javascript:void(0)" id="rt" onclick="edit_leads('+data['leads_id']+')">Edit</a>';
                }

               // Change status button
                if (hasPermission('LEADS_CHANGE_STATUS')) {
                    actionHtml += '<a class="dropdown-item" href="javascript:void(0)" id="rt" onclick="openChangeStatus1Modal('+data['leads_id']+')">Change status</a>';
                }

                // Show status button
                if (hasPermission('LEADS_SHOW_STATUS')) {
                    actionHtml += '<a class="dropdown-item" href="javascript:void(0)" id="rt" onclick="showStatus1Modal('+data['leads_id']+')">Status history</a>';
                }

                // Change stage button
                if (hasPermission('LEADS_CHANGE_STAGE')) {
                    actionHtml += '<a class="dropdown-item" href="javascript:void(0)" id="rt" onclick="openChangeStatusModal('+data['leads_id']+')">Change stage</a>';
                }

                // Show stage button
                if (hasPermission('LEADS_SHOW_STAGE')) {
                    actionHtml += '<a class="dropdown-item" href="javascript:void(0)" id="rt" onclick="showStatusModal('+data['leads_id']+')">Show stages</a>';
                }

                // Guest count button
                if (hasPermission('LEADS_GUEST_COUNT')) {
                    actionHtml += '<a class="dropdown-item" href="javascript:void(0)" id="rt"  onclick="open_guest_count_checked('+data['leads_id']+')">Guest count</a>';
                }

                // Accomodation plan button
                if (hasPermission('LEADS_ACCOMODATION_PLAN')) {
                    actionHtml += '<a class="dropdown-item" href="javascript:void(0)" id="rt"  onclick="open_accommodation_checked('+data['leads_id']+')">Accomodation plan</a>';
                }

                // Quotation button
                if (hasPermission('LEADS_QUOTATION')) {
                    actionHtml += '<a class="dropdown-item" href="javascript:void(0)" id="rt" onclick="open_quotation('+data['leads_id']+')">Quotation</a>';
                }

                // Details button
                if (hasPermission('LEADS_DETAILS')) {
                    actionHtml += '<a class="dropdown-item" href="javascript:void(0)" id="rt" onclick="view_lead_details('+data['leads_id']+')">view</a>';
                }

                // Delete button
                if (hasPermission('LEADS_DELETE')) {
                    actionHtml += '<a class="dropdown-item" href="javascript:void(0)" onclick="return delete_leads('+data['leads_id']+')">Delete</a>';
                }

                actionHtml += '</div></div>';

                $('td', row).eq(11).html(actionHtml);
              }
              renderRejectedQuotationRow(data, row);
            }
            else if($table2.cell(node).data() == '2') {
					    $table2.cell(node).data('<center><span class="badge badge-sm light btn-secondary">Qualified</span></center>');
            // else if(data['lead_current_status'] == 2){
            //   $('td', row).eq(9).html('<span class="badge badge-secondary">Qualified</span>');

              if(data['leads_accomodation_status'] == 0 && data['leads_quotation_status'] == 0){
              
                $('td', row).eq(1).html('<a class="leads-number-link" href="javascript:void(0)" onclick="view_lead_details('+data['leads_id']+')">'+data['leads_number']+'</a><br><span class="badge badge-xs badge badge-primary">guest count required</span>');
                // $('td', row).eq(11).html('<div class="dropdown ms-auto text-end"><div class="btn-link" data-bs-toggle="dropdown"><svg width="24px" height="24px" viewBox="0 0 24 24" version="1.1"><g stroke="none" stroke-width="1" fill="none" fill-rule="evenodd"><rect x="0" y="0" width="24" height="24"></rect><circle fill="#000000" cx="5" cy="12" r="2"></circle><circle fill="#000000" cx="12" cy="12" r="2"></circle><circle fill="#000000" cx="19" cy="12" r="2"></circle></g></svg></div><div class="dropdown-menu dropdown-menu-end"><a class="dropdown-item" href="javascript:void(0)" id="rt" onclick="openChangeStatusModal('+data['leads_id']+')">Change stage</a><a class="dropdown-item" href="javascript:void(0)" id="rt" onclick="showStatusModal('+data['leads_id']+')">Show stages</a><a class="dropdown-item" href="javascript:void(0)" id="rt" onclick="openChangeStatus1Modal('+data['leads_id']+')">Change status</a><a class="dropdown-item" href="javascript:void(0)" id="rt" onclick="showStatus1Modal('+data['leads_id']+')">Status history</a><a class="dropdown-item" href="javascript:void(0)" id="rt"  onclick="guset_count_edit('+data['leads_id']+')">Guest count</a><a class="dropdown-item" href="javascript:void(0)" id="rt" onclick="edit_leads('+data['leads_id']+')">Edit</a><a class="dropdown-item" href="javascript:void(0)" id="rt" onclick="view_lead_details('+data['leads_id']+')">view</a><a class="dropdown-item" href="javascript:void(0)" onclick="return delete_leads('+data['leads_id']+')">Delete</a></div></div>');
              
                 let actionHtml = '<div class="dropdown ms-auto text-end"><div class="btn-link" data-bs-toggle="dropdown"><svg width="24px" height="24px" viewBox="0 0 24 24" version="1.1"><g stroke="none" stroke-width="1" fill="none" fill-rule="evenodd"><rect x="0" y="0" width="24" height="24"></rect><circle fill="#000000" cx="5" cy="12" r="2"></circle><circle fill="#000000" cx="12" cy="12" r="2"></circle><circle fill="#000000" cx="19" cy="12" r="2"></circle></g></svg></div><div class="dropdown-menu dropdown-menu-end">';
                // Edit button
                if (hasPermission('LEADS_UPDATE')) {
                    actionHtml += '<a class="dropdown-item" href="javascript:void(0)" id="rt" onclick="edit_leads('+data['leads_id']+')">Edit</a>';
                }

               // Change status button
                if (hasPermission('LEADS_CHANGE_STATUS')) {
                    actionHtml += '<a class="dropdown-item" href="javascript:void(0)" id="rt" onclick="openChangeStatus1Modal('+data['leads_id']+')">Change status</a>';
                }

                // Show status button
                if (hasPermission('LEADS_SHOW_STATUS')) {
                    actionHtml += '<a class="dropdown-item" href="javascript:void(0)" id="rt" onclick="showStatus1Modal('+data['leads_id']+')">Status history</a>';
                }

                // Change stage button
                if (hasPermission('LEADS_CHANGE_STAGE')) {
                    actionHtml += '<a class="dropdown-item" href="javascript:void(0)" id="rt" onclick="openChangeStatusModal('+data['leads_id']+')">Change stage</a>';
                }

                // Show stage button
                if (hasPermission('LEADS_SHOW_STAGE')) {
                    actionHtml += '<a class="dropdown-item" href="javascript:void(0)" id="rt" onclick="showStatusModal('+data['leads_id']+')">Show stages</a>';
                }

                // Guest count button
                if (hasPermission('LEADS_GUEST_COUNT')) {
                    actionHtml += '<a class="dropdown-item" href="javascript:void(0)" id="rt"  onclick="open_guest_count_checked('+data['leads_id']+')">Guest count</a>';
                }

                // Details button
                if (hasPermission('LEADS_DETAILS')) {
                    actionHtml += '<a class="dropdown-item" href="javascript:void(0)" id="rt" onclick="view_lead_details('+data['leads_id']+')">view</a>';
                }

                // Delete button
                if (hasPermission('LEADS_DELETE')) {
                    actionHtml += '<a class="dropdown-item" href="javascript:void(0)" onclick="return delete_leads('+data['leads_id']+')">Delete</a>';
                }

                actionHtml += '</div></div>';

                $('td', row).eq(11).html(actionHtml);

                }
              
              if(data['leads_accomodation_status'] == 1 && data['leads_quotation_status'] == 0){

                // $('td', row).eq(11).html('<div class="dropdown ms-auto text-end"><div class="btn-link" data-bs-toggle="dropdown"><svg width="24px" height="24px" viewBox="0 0 24 24" version="1.1"><g stroke="none" stroke-width="1" fill="none" fill-rule="evenodd"><rect x="0" y="0" width="24" height="24"></rect><circle fill="#000000" cx="5" cy="12" r="2"></circle><circle fill="#000000" cx="12" cy="12" r="2"></circle><circle fill="#000000" cx="19" cy="12" r="2"></circle></g></svg></div><div class="dropdown-menu dropdown-menu-end"><a class="dropdown-item" href="javascript:void(0)" id="rt" onclick="openChangeStatusModal('+data['leads_id']+')">Change stage</a><a class="dropdown-item" href="javascript:void(0)" id="rt" onclick="showStatusModal('+data['leads_id']+')">Show stages</a><a class="dropdown-item" href="javascript:void(0)" id="rt" onclick="openChangeStatus1Modal('+data['leads_id']+')">Change status</a><a class="dropdown-item" href="javascript:void(0)" id="rt" onclick="showStatus1Modal('+data['leads_id']+')">Status history</a><a class="dropdown-item" href="javascript:void(0)" id="rt"  onclick="guset_count_edit('+data['leads_id']+')">Guest count</a><a class="dropdown-item" href="javascript:void(0)" id="rt"  onclick="accomodation_plan('+data['leads_id']+')">Accomodation plan</a><a class="dropdown-item" href="javascript:void(0)" id="rt" onclick="edit_leads('+data['leads_id']+')">Edit</a><a class="dropdown-item" href="javascript:void(0)" id="rt" onclick="view_lead_details('+data['leads_id']+')">view</a><a class="dropdown-item" href="javascript:void(0)" onclick="return delete_leads('+data['leads_id']+')">Delete</a></div></div>');

                $('td', row).eq(1).html('<a class="leads-number-link" href="javascript:void(0)" onclick="view_lead_details('+data['leads_id']+')">'+data['leads_number']+'</a><br><span class="badge badge-xs badge badge-warning">accommodation required</span>');

                let actionHtml = '<div class="dropdown ms-auto text-end"><div class="btn-link" data-bs-toggle="dropdown"><svg width="24px" height="24px" viewBox="0 0 24 24" version="1.1"><g stroke="none" stroke-width="1" fill="none" fill-rule="evenodd"><rect x="0" y="0" width="24" height="24"></rect><circle fill="#000000" cx="5" cy="12" r="2"></circle><circle fill="#000000" cx="12" cy="12" r="2"></circle><circle fill="#000000" cx="19" cy="12" r="2"></circle></g></svg></div><div class="dropdown-menu dropdown-menu-end">';
                
                // Edit button
                if (hasPermission('LEADS_UPDATE')) {
                    actionHtml += '<a class="dropdown-item" href="javascript:void(0)" id="rt" onclick="edit_leads('+data['leads_id']+')">Edit</a>';
                }

               // Change status button
                if (hasPermission('LEADS_CHANGE_STATUS')) {
                    actionHtml += '<a class="dropdown-item" href="javascript:void(0)" id="rt" onclick="openChangeStatus1Modal('+data['leads_id']+')">Change status</a>';
                }

                // Show status button
                if (hasPermission('LEADS_SHOW_STATUS')) {
                    actionHtml += '<a class="dropdown-item" href="javascript:void(0)" id="rt" onclick="showStatus1Modal('+data['leads_id']+')">Status history</a>';
                }

                // Change stage button
                if (hasPermission('LEADS_CHANGE_STAGE')) {
                    actionHtml += '<a class="dropdown-item" href="javascript:void(0)" id="rt" onclick="openChangeStatusModal('+data['leads_id']+')">Change stage</a>';
                }

                // Show stage button
                if (hasPermission('LEADS_SHOW_STAGE')) {
                    actionHtml += '<a class="dropdown-item" href="javascript:void(0)" id="rt" onclick="showStatusModal('+data['leads_id']+')">Show stages</a>';
                }

                // Guest count button
                if (hasPermission('LEADS_GUEST_COUNT')) {
                    actionHtml += '<a class="dropdown-item" href="javascript:void(0)" id="rt"  onclick="open_guest_count_checked('+data['leads_id']+')">Guest count</a>';
                }

                 // Accomodation plan button
                if (hasPermission('LEADS_ACCOMODATION_PLAN')) {
                    actionHtml += '<a class="dropdown-item" href="javascript:void(0)" id="rt"  onclick="open_accommodation_checked('+data['leads_id']+')">Accomodation plan</a>';
                }

                // Details button
                if (hasPermission('LEADS_DETAILS')) {
                    actionHtml += '<a class="dropdown-item" href="javascript:void(0)" id="rt" onclick="view_lead_details('+data['leads_id']+')">view</a>';
                }

                // Delete button
                if (hasPermission('LEADS_DELETE')) {
                    actionHtml += '<a class="dropdown-item" href="javascript:void(0)" onclick="return delete_leads('+data['leads_id']+')">Delete</a>';
                }

                actionHtml += '</div></div>';

                $('td', row).eq(11).html(actionHtml);

                }

              if(data['leads_accomodation_status'] == 2 && data['leads_quotation_status'] == 0){

                // $('td', row).eq(11).html('<div class="dropdown ms-auto text-end"><div class="btn-link" data-bs-toggle="dropdown"><svg width="24px" height="24px" viewBox="0 0 24 24" version="1.1"><g stroke="none" stroke-width="1" fill="none" fill-rule="evenodd"><rect x="0" y="0" width="24" height="24"></rect><circle fill="#000000" cx="5" cy="12" r="2"></circle><circle fill="#000000" cx="12" cy="12" r="2"></circle><circle fill="#000000" cx="19" cy="12" r="2"></circle></g></svg></div><div class="dropdown-menu dropdown-menu-end"><a class="dropdown-item" href="javascript:void(0)" id="rt" onclick="openChangeStatusModal('+data['leads_id']+')">Change stage</a><a class="dropdown-item" href="javascript:void(0)" id="rt" onclick="showStatusModal('+data['leads_id']+')">Show stages</a><a class="dropdown-item" href="javascript:void(0)" id="rt" onclick="openChangeStatus1Modal('+data['leads_id']+')">Change status</a><a class="dropdown-item" href="javascript:void(0)" id="rt" onclick="showStatus1Modal('+data['leads_id']+')">Status history</a><a class="dropdown-item" href="javascript:void(0)" id="rt"  onclick="guset_count_edit('+data['leads_id']+')">Guest count</a><a class="dropdown-item" href="javascript:void(0)" id="rt"  onclick="accomodation_plan('+data['leads_id']+')">Accomodation plan</a><a class="dropdown-item" href="javascript:void(0)" id="rt" onclick="open_quotation('+data['leads_id']+')">Quotation</a><a class="dropdown-item" href="javascript:void(0)" id="rt" onclick="edit_leads('+data['leads_id']+')">Edit</a><a class="dropdown-item" href="javascript:void(0)" id="rt" onclick="view_lead_details('+data['leads_id']+')">view</a><a class="dropdown-item" href="javascript:void(0)" onclick="return delete_leads('+data['leads_id']+')">Delete</a></div></div>');

                $('td', row).eq(1).html('<a class="leads-number-link" href="javascript:void(0)" onclick="view_lead_details('+data['leads_id']+')">'+data['leads_number']+'</a><br><span class="badge badge-xs badge badge-info">Quotation not created</span>');

                let actionHtml = '<div class="dropdown ms-auto text-end"><div class="btn-link" data-bs-toggle="dropdown"><svg width="24px" height="24px" viewBox="0 0 24 24" version="1.1"><g stroke="none" stroke-width="1" fill="none" fill-rule="evenodd"><rect x="0" y="0" width="24" height="24"></rect><circle fill="#000000" cx="5" cy="12" r="2"></circle><circle fill="#000000" cx="12" cy="12" r="2"></circle><circle fill="#000000" cx="19" cy="12" r="2"></circle></g></svg></div><div class="dropdown-menu dropdown-menu-end">';
                
                // Edit button
                if (hasPermission('LEADS_UPDATE')) {
                    actionHtml += '<a class="dropdown-item" href="javascript:void(0)" id="rt" onclick="edit_leads('+data['leads_id']+')">Edit</a>';
                }

               // Change status button
                if (hasPermission('LEADS_CHANGE_STATUS')) {
                    actionHtml += '<a class="dropdown-item" href="javascript:void(0)" id="rt" onclick="openChangeStatus1Modal('+data['leads_id']+')">Change status</a>';
                }

                // Show status button
                if (hasPermission('LEADS_SHOW_STATUS')) {
                    actionHtml += '<a class="dropdown-item" href="javascript:void(0)" id="rt" onclick="showStatus1Modal('+data['leads_id']+')">Status history</a>';
                }

                // Change stage button
                if (hasPermission('LEADS_CHANGE_STAGE')) {
                    actionHtml += '<a class="dropdown-item" href="javascript:void(0)" id="rt" onclick="openChangeStatusModal('+data['leads_id']+')">Change stage</a>';
                }

                // Show stage button
                if (hasPermission('LEADS_SHOW_STAGE')) {
                    actionHtml += '<a class="dropdown-item" href="javascript:void(0)" id="rt" onclick="showStatusModal('+data['leads_id']+')">Show stages</a>';
                }

                // Guest count button
                if (hasPermission('LEADS_GUEST_COUNT')) {
                    actionHtml += '<a class="dropdown-item" href="javascript:void(0)" id="rt"  onclick="open_guest_count_checked('+data['leads_id']+')">Guest count</a>';
                }

                // Accomodation plan button
                if (hasPermission('LEADS_ACCOMODATION_PLAN')) {
                    actionHtml += '<a class="dropdown-item" href="javascript:void(0)" id="rt"  onclick="open_accommodation_checked('+data['leads_id']+')">Accomodation plan</a>';
                }

                // Quotation button
                if (hasPermission('LEADS_QUOTATION')) {
                    actionHtml += '<a class="dropdown-item" href="javascript:void(0)" id="rt" onclick="open_quotation('+data['leads_id']+')">Quotation</a>';
                }

                // Details button
                if (hasPermission('LEADS_DETAILS')) {
                    actionHtml += '<a class="dropdown-item" href="javascript:void(0)" id="rt" onclick="view_lead_details('+data['leads_id']+')">view</a>';
                }

                // Delete button
                if (hasPermission('LEADS_DELETE')) {
                    actionHtml += '<a class="dropdown-item" href="javascript:void(0)" onclick="return delete_leads('+data['leads_id']+')">Delete</a>';
                }

                actionHtml += '</div></div>';

                $('td', row).eq(11).html(actionHtml);

              }
              renderRejectedQuotationRow(data, row);
              renderQuotationCreatedRow(data, row);
              renderCancelledQuotationRow(data, row);
              if(data['leads_accomodation_status'] == 2 && data['leads_quotation_status'] == 1){

                    // $('td', row).eq(11).html('<div class="dropdown ms-auto text-end"><div class="btn-link" data-bs-toggle="dropdown"><svg width="24px" height="24px" viewBox="0 0 24 24" version="1.1"><g stroke="none" stroke-width="1" fill="none" fill-rule="evenodd"><rect x="0" y="0" width="24" height="24"></rect><circle fill="#000000" cx="5" cy="12" r="2"></circle><circle fill="#000000" cx="12" cy="12" r="2"></circle><circle fill="#000000" cx="19" cy="12" r="2"></circle></g></svg></div><div class="dropdown-menu dropdown-menu-end"><a class="dropdown-item" href="javascript:void(0)" id="rt" onclick="openChangeStatusModal('+data['leads_id']+')">Change stage</a><a class="dropdown-item" href="javascript:void(0)" id="rt" onclick="showStatusModal('+data['leads_id']+')">Show stages</a><a class="dropdown-item" href="javascript:void(0)" id="rt" onclick="openChangeStatus1Modal('+data['leads_id']+')">Change status</a><a class="dropdown-item" href="javascript:void(0)" id="rt" onclick="showStatus1Modal('+data['leads_id']+')">Status history</a><a class="dropdown-item" href="javascript:void(0)" id="rt" onclick="edit_leads('+data['leads_id']+')">Edit</a><a class="dropdown-item" href="javascript:void(0)" id="rt" onclick="view_lead_details('+data['leads_id']+')">view</a><a class="dropdown-item" href="javascript:void(0)" onclick="return delete_leads('+data['leads_id']+')">Delete</a></div></div>');

                    $('td', row).eq(1).html('<a class="leads-number-link" href="javascript:void(0)" onclick="view_lead_details('+data['leads_id']+')">'+data['leads_number']+'</a><br><span class="badge badge-xs badge badge-success">Quotation created</span>');

                    let actionHtml = '<div class="dropdown ms-auto text-end"><div class="btn-link" data-bs-toggle="dropdown"><svg width="24px" height="24px" viewBox="0 0 24 24" version="1.1"><g stroke="none" stroke-width="1" fill="none" fill-rule="evenodd"><rect x="0" y="0" width="24" height="24"></rect><circle fill="#000000" cx="5" cy="12" r="2"></circle><circle fill="#000000" cx="12" cy="12" r="2"></circle><circle fill="#000000" cx="19" cy="12" r="2"></circle></g></svg></div><div class="dropdown-menu dropdown-menu-end">';
                
                // Edit button
                if (hasPermission('LEADS_UPDATE')) {
                    actionHtml += '<a class="dropdown-item" href="javascript:void(0)" id="rt" onclick="edit_leads('+data['leads_id']+')">Edit</a>';
                }

               // Change status button
                if (hasPermission('LEADS_CHANGE_STATUS')) {
                    actionHtml += '<a class="dropdown-item" href="javascript:void(0)" id="rt" onclick="openChangeStatus1Modal('+data['leads_id']+')">Change status</a>';
                }

                // Show status button
                if (hasPermission('LEADS_SHOW_STATUS')) {
                    actionHtml += '<a class="dropdown-item" href="javascript:void(0)" id="rt" onclick="showStatus1Modal('+data['leads_id']+')">Status history</a>';
                }

                // Change stage button
                if (hasPermission('LEADS_CHANGE_STAGE')) {
                    actionHtml += '<a class="dropdown-item" href="javascript:void(0)" id="rt" onclick="openChangeStatusModal('+data['leads_id']+')">Change stage</a>';
                }

                // Show stage button
                if (hasPermission('LEADS_SHOW_STAGE')) {
                    actionHtml += '<a class="dropdown-item" href="javascript:void(0)" id="rt" onclick="showStatusModal('+data['leads_id']+')">Show stages</a>';
                }

                // Details button
                if (hasPermission('LEADS_DETAILS')) {
                    actionHtml += '<a class="dropdown-item" href="javascript:void(0)" id="rt" onclick="view_lead_details('+data['leads_id']+')">view</a>';
                }

                // Delete button
                if (hasPermission('LEADS_DELETE')) {
                    actionHtml += '<a class="dropdown-item" href="javascript:void(0)" onclick="return delete_leads('+data['leads_id']+')">Delete</a>';
                }

                actionHtml += '</div></div>';

                $('td', row).eq(11).html(actionHtml);
              }
              if(data['leads_accomodation_status'] == 2 && data['leads_quotation_status'] == 2){

                    // $('td', row).eq(11).html('<div class="dropdown ms-auto text-end"><div class="btn-link" data-bs-toggle="dropdown"><svg width="24px" height="24px" viewBox="0 0 24 24" version="1.1"><g stroke="none" stroke-width="1" fill="none" fill-rule="evenodd"><rect x="0" y="0" width="24" height="24"></rect><circle fill="#000000" cx="5" cy="12" r="2"></circle><circle fill="#000000" cx="12" cy="12" r="2"></circle><circle fill="#000000" cx="19" cy="12" r="2"></circle></g></svg></div><div class="dropdown-menu dropdown-menu-end"><a class="dropdown-item" href="javascript:void(0)" id="rt" onclick="openChangeStatusModal('+data['leads_id']+')">Change stage</a><a class="dropdown-item" href="javascript:void(0)" id="rt" onclick="showStatusModal('+data['leads_id']+')">Show stages</a><a class="dropdown-item" href="javascript:void(0)" id="rt" onclick="openChangeStatus1Modal('+data['leads_id']+')">Change status</a><a class="dropdown-item" href="javascript:void(0)" id="rt" onclick="showStatus1Modal('+data['leads_id']+')">Status history</a><a class="dropdown-item" href="javascript:void(0)" id="rt" onclick="edit_leads('+data['leads_id']+')">Edit</a><a class="dropdown-item" href="javascript:void(0)" id="rt" onclick="view_lead_details('+data['leads_id']+')">view</a><a class="dropdown-item" href="javascript:void(0)" onclick="return delete_leads('+data['leads_id']+')">Delete</a></div></div>');

                    $('td', row).eq(1).html('<a class="leads-number-link" href="javascript:void(0)" onclick="view_lead_details('+data['leads_id']+')">'+data['leads_number']+'</a><br><span class="badge badge-xs badge badge-info">Cancelled/Quotation not created</span>');

                    let actionHtml = '<div class="dropdown ms-auto text-end"><div class="btn-link" data-bs-toggle="dropdown"><svg width="24px" height="24px" viewBox="0 0 24 24" version="1.1"><g stroke="none" stroke-width="1" fill="none" fill-rule="evenodd"><rect x="0" y="0" width="24" height="24"></rect><circle fill="#000000" cx="5" cy="12" r="2"></circle><circle fill="#000000" cx="12" cy="12" r="2"></circle><circle fill="#000000" cx="19" cy="12" r="2"></circle></g></svg></div><div class="dropdown-menu dropdown-menu-end">';
                
                // Edit button
                if (hasPermission('LEADS_UPDATE')) {
                    actionHtml += '<a class="dropdown-item" href="javascript:void(0)" id="rt" onclick="edit_leads('+data['leads_id']+')">Edit</a>';
                }

               // Change status button
                if (hasPermission('LEADS_CHANGE_STATUS')) {
                    actionHtml += '<a class="dropdown-item" href="javascript:void(0)" id="rt" onclick="openChangeStatus1Modal('+data['leads_id']+')">Change status</a>';
                }

                // Show status button
                if (hasPermission('LEADS_SHOW_STATUS')) {
                    actionHtml += '<a class="dropdown-item" href="javascript:void(0)" id="rt" onclick="showStatus1Modal('+data['leads_id']+')">Status history</a>';
                }

                // Change stage button
                if (hasPermission('LEADS_CHANGE_STAGE')) {
                    actionHtml += '<a class="dropdown-item" href="javascript:void(0)" id="rt" onclick="openChangeStatusModal('+data['leads_id']+')">Change stage</a>';
                }

                // Show stage button
                if (hasPermission('LEADS_SHOW_STAGE')) {
                    actionHtml += '<a class="dropdown-item" href="javascript:void(0)" id="rt" onclick="showStatusModal('+data['leads_id']+')">Show stages</a>';
                }

                // Guest count button
                if (hasPermission('LEADS_GUEST_COUNT')) {
                    actionHtml += '<a class="dropdown-item" href="javascript:void(0)" id="rt"  onclick="open_guest_count_checked('+data['leads_id']+')">Guest count</a>';
                }

                // Accomodation plan button
                if (hasPermission('LEADS_ACCOMODATION_PLAN')) {
                    actionHtml += '<a class="dropdown-item" href="javascript:void(0)" id="rt"  onclick="open_accommodation_checked('+data['leads_id']+')">Accomodation plan</a>';
                }

                // Quotation button
                if (hasPermission('LEADS_QUOTATION')) {
                    actionHtml += '<a class="dropdown-item" href="javascript:void(0)" id="rt" onclick="open_quotation('+data['leads_id']+')">Quotation</a>';
                }

                // Details button
                if (hasPermission('LEADS_DETAILS')) {
                    actionHtml += '<a class="dropdown-item" href="javascript:void(0)" id="rt" onclick="view_lead_details('+data['leads_id']+')">view</a>';
                }

                // Delete button
                if (hasPermission('LEADS_DELETE')) {
                    actionHtml += '<a class="dropdown-item" href="javascript:void(0)" onclick="return delete_leads('+data['leads_id']+')">Delete</a>';
                }

                actionHtml += '</div></div>';

                $('td', row).eq(11).html(actionHtml);
              }
              renderRejectedQuotationRow(data, row);
            }
             else if($table2.cell(node).data() == '3') {
					    $table2.cell(node).data('<center><span class="badge badge-sm light btn-success">Converted to trip</span></center>');
            // else if(data['lead_current_status'] == 5){
              // $('td', row).eq(9).html('<span class="badge badge-danger">Lost</span>');

             $('td', row).eq(1).html('<a class="leads-number-link" href="javascript:void(0)" onclick="view_lead_details('+data['leads_id']+')">'+data['leads_number']+'</a>');
              
                // $('td', row).eq(11).html('<div class="dropdown ms-auto text-end"><div class="btn-link" data-bs-toggle="dropdown"><svg width="24px" height="24px" viewBox="0 0 24 24" version="1.1"><g stroke="none" stroke-width="1" fill="none" fill-rule="evenodd"><rect x="0" y="0" width="24" height="24"></rect><circle fill="#000000" cx="5" cy="12" r="2"></circle><circle fill="#000000" cx="12" cy="12" r="2"></circle><circle fill="#000000" cx="19" cy="12" r="2"></circle></g></svg></div><div class="dropdown-menu dropdown-menu-end"><a class="dropdown-item" href="javascript:void(0)" id="rt" onclick="openChangeStatusModal('+data['leads_id']+')">Change stage</a><a class="dropdown-item" href="javascript:void(0)" id="rt" onclick="showStatusModal('+data['leads_id']+')">Show stages</a><a class="dropdown-item" href="javascript:void(0)" id="rt" onclick="openChangeStatus1Modal('+data['leads_id']+')">Change status</a><a class="dropdown-item" href="javascript:void(0)" id="rt" onclick="showStatus1Modal('+data['leads_id']+')">Status history</a><a class="dropdown-item" href="javascript:void(0)" id="rt"  onclick="guset_count_edit('+data['leads_id']+')">Guest count</a><a class="dropdown-item" href="javascript:void(0)" id="rt" onclick="edit_leads('+data['leads_id']+')">Edit</a><a class="dropdown-item" href="javascript:void(0)" id="rt" onclick="view_lead_details('+data['leads_id']+')">view</a><a class="dropdown-item" href="javascript:void(0)" onclick="return delete_leads('+data['leads_id']+')">Delete</a></div></div>');
              
                 let actionHtml = '<div class="dropdown ms-auto text-end"><div class="btn-link" data-bs-toggle="dropdown"><svg width="24px" height="24px" viewBox="0 0 24 24" version="1.1"><g stroke="none" stroke-width="1" fill="none" fill-rule="evenodd"><rect x="0" y="0" width="24" height="24"></rect><circle fill="#000000" cx="5" cy="12" r="2"></circle><circle fill="#000000" cx="12" cy="12" r="2"></circle><circle fill="#000000" cx="19" cy="12" r="2"></circle></g></svg></div><div class="dropdown-menu dropdown-menu-end">';
                // Edit button
                // if (hasPermission('LEADS_UPDATE')) {
                //     actionHtml += '<a class="dropdown-item" href="javascript:void(0)" id="rt" onclick="edit_leads('+data['leads_id']+')">Edit</a>';
                // }

               // Change status button
                // if (hasPermission('LEADS_CHANGE_STATUS')) {
                //     actionHtml += '<a class="dropdown-item" href="javascript:void(0)" id="rt" onclick="openChangeStatus1Modal('+data['leads_id']+')">Change status</a>';
                // }

                // Show status button
                if (hasPermission('LEADS_SHOW_STATUS')) {
                    actionHtml += '<a class="dropdown-item" href="javascript:void(0)" id="rt" onclick="showStatus1Modal('+data['leads_id']+')">Status history</a>';
                }

                // Change stage button
                // if (hasPermission('LEADS_CHANGE_STAGE')) {
                //     actionHtml += '<a class="dropdown-item" href="javascript:void(0)" id="rt" onclick="openChangeStatusModal('+data['leads_id']+')">Change stage</a>';
                // }

                // Show stage button
                if (hasPermission('LEADS_SHOW_STAGE')) {
                    actionHtml += '<a class="dropdown-item" href="javascript:void(0)" id="rt" onclick="showStatusModal('+data['leads_id']+')">Show stages</a>';
                }

                // Guest count button
                // if (hasPermission('LEADS_GUEST_COUNT')) {
                //     actionHtml += '<a class="dropdown-item" href="javascript:void(0)" id="rt"  onclick="guset_count_edit('+data['leads_id']+')">Guest count</a>';
                // }

                // Details button
                if (hasPermission('LEADS_DETAILS')) {
                    actionHtml += '<a class="dropdown-item" href="javascript:void(0)" id="rt" onclick="view_lead_details('+data['leads_id']+')">view</a>';
                }

                // Delete button
                // if (hasPermission('LEADS_DELETE')) {
                //     actionHtml += '<a class="dropdown-item" href="javascript:void(0)" onclick="return delete_leads('+data['leads_id']+')">Delete</a>';
                // }

                actionHtml += '</div></div>';

                $('td', row).eq(11).html(actionHtml);

                
            }
            else if($table2.cell(node).data() == '4') {
					    $table2.cell(node).data('<center><span class="badge badge-sm light btn-warning">Not Qualified</span></center>');
            // else if(data['lead_current_status'] == 4){
            //   $('td', row).eq(9).html('<span class="badge badge-warning">Not Qualified</span>');

              if(data['leads_accomodation_status'] == 0 && data['leads_quotation_status'] == 0){
              
                $('td', row).eq(1).html('<a class="leads-number-link" href="javascript:void(0)" onclick="view_lead_details('+data['leads_id']+')">'+data['leads_number']+'</a><br><span class="badge badge-xs badge badge-primary">guest count required</span>');

                // $('td', row).eq(11).html('<div class="dropdown ms-auto text-end"><div class="btn-link" data-bs-toggle="dropdown"><svg width="24px" height="24px" viewBox="0 0 24 24" version="1.1"><g stroke="none" stroke-width="1" fill="none" fill-rule="evenodd"><rect x="0" y="0" width="24" height="24"></rect><circle fill="#000000" cx="5" cy="12" r="2"></circle><circle fill="#000000" cx="12" cy="12" r="2"></circle><circle fill="#000000" cx="19" cy="12" r="2"></circle></g></svg></div><div class="dropdown-menu dropdown-menu-end"><a class="dropdown-item" href="javascript:void(0)" id="rt" onclick="openChangeStatusModal('+data['leads_id']+')">Change stage</a><a class="dropdown-item" href="javascript:void(0)" id="rt" onclick="showStatusModal('+data['leads_id']+')">Show stages</a><a class="dropdown-item" href="javascript:void(0)" id="rt" onclick="openChangeStatus1Modal('+data['leads_id']+')">Change status</a><a class="dropdown-item" href="javascript:void(0)" id="rt" onclick="showStatus1Modal('+data['leads_id']+')">Status history</a><a class="dropdown-item" href="javascript:void(0)" id="rt"  onclick="guset_count_edit('+data['leads_id']+')">Guest count</a><a class="dropdown-item" href="javascript:void(0)" id="rt" onclick="edit_leads('+data['leads_id']+')">Edit</a><a class="dropdown-item" href="javascript:void(0)" id="rt" onclick="view_lead_details('+data['leads_id']+')">view</a><a class="dropdown-item" href="javascript:void(0)" onclick="return delete_leads('+data['leads_id']+')">Delete</a></div></div>');
              
                 let actionHtml = '<div class="dropdown ms-auto text-end"><div class="btn-link" data-bs-toggle="dropdown"><svg width="24px" height="24px" viewBox="0 0 24 24" version="1.1"><g stroke="none" stroke-width="1" fill="none" fill-rule="evenodd"><rect x="0" y="0" width="24" height="24"></rect><circle fill="#000000" cx="5" cy="12" r="2"></circle><circle fill="#000000" cx="12" cy="12" r="2"></circle><circle fill="#000000" cx="19" cy="12" r="2"></circle></g></svg></div><div class="dropdown-menu dropdown-menu-end">';
                // Edit button
                if (hasPermission('LEADS_UPDATE')) {
                    actionHtml += '<a class="dropdown-item" href="javascript:void(0)" id="rt" onclick="edit_leads('+data['leads_id']+')">Edit</a>';
                }

               // Change status button
                if (hasPermission('LEADS_CHANGE_STATUS')) {
                    actionHtml += '<a class="dropdown-item" href="javascript:void(0)" id="rt" onclick="openChangeStatus1Modal('+data['leads_id']+')">Change status</a>';
                }

                // Show status button
                if (hasPermission('LEADS_SHOW_STATUS')) {
                    actionHtml += '<a class="dropdown-item" href="javascript:void(0)" id="rt" onclick="showStatus1Modal('+data['leads_id']+')">Status history</a>';
                }

                // Change stage button
                if (hasPermission('LEADS_CHANGE_STAGE')) {
                    actionHtml += '<a class="dropdown-item" href="javascript:void(0)" id="rt" onclick="openChangeStatusModal('+data['leads_id']+')">Change stage</a>';
                }

                // Show stage button
                if (hasPermission('LEADS_SHOW_STAGE')) {
                    actionHtml += '<a class="dropdown-item" href="javascript:void(0)" id="rt" onclick="showStatusModal('+data['leads_id']+')">Show stages</a>';
                }

                // Guest count button
                if (hasPermission('LEADS_GUEST_COUNT')) {
                    actionHtml += '<a class="dropdown-item" href="javascript:void(0)" id="rt"  onclick="open_guest_count_checked('+data['leads_id']+')">Guest count</a>';
                }

                // Details button
                if (hasPermission('LEADS_DETAILS')) {
                    actionHtml += '<a class="dropdown-item" href="javascript:void(0)" id="rt" onclick="view_lead_details('+data['leads_id']+')">view</a>';
                }

                // Delete button
                if (hasPermission('LEADS_DELETE')) {
                    actionHtml += '<a class="dropdown-item" href="javascript:void(0)" onclick="return delete_leads('+data['leads_id']+')">Delete</a>';
                }

                actionHtml += '</div></div>';

                $('td', row).eq(11).html(actionHtml);

                }
              
              if(data['leads_accomodation_status'] == 1 && data['leads_quotation_status'] == 0){

                $('td', row).eq(1).html('<a class="leads-number-link" href="javascript:void(0)" onclick="view_lead_details('+data['leads_id']+')">'+data['leads_number']+'</a><br><span class="badge badge-xs badge badge-warning">accommodation required</span>');
                // $('td', row).eq(11).html('<div class="dropdown ms-auto text-end"><div class="btn-link" data-bs-toggle="dropdown"><svg width="24px" height="24px" viewBox="0 0 24 24" version="1.1"><g stroke="none" stroke-width="1" fill="none" fill-rule="evenodd"><rect x="0" y="0" width="24" height="24"></rect><circle fill="#000000" cx="5" cy="12" r="2"></circle><circle fill="#000000" cx="12" cy="12" r="2"></circle><circle fill="#000000" cx="19" cy="12" r="2"></circle></g></svg></div><div class="dropdown-menu dropdown-menu-end"><a class="dropdown-item" href="javascript:void(0)" id="rt" onclick="openChangeStatusModal('+data['leads_id']+')">Change stage</a><a class="dropdown-item" href="javascript:void(0)" id="rt" onclick="showStatusModal('+data['leads_id']+')">Show stages</a><a class="dropdown-item" href="javascript:void(0)" id="rt" onclick="openChangeStatus1Modal('+data['leads_id']+')">Change status</a><a class="dropdown-item" href="javascript:void(0)" id="rt" onclick="showStatus1Modal('+data['leads_id']+')">Status history</a><a class="dropdown-item" href="javascript:void(0)" id="rt"  onclick="guset_count_edit('+data['leads_id']+')">Guest count</a><a class="dropdown-item" href="javascript:void(0)" id="rt"  onclick="accomodation_plan('+data['leads_id']+')">Accomodation plan</a><a class="dropdown-item" href="javascript:void(0)" id="rt" onclick="edit_leads('+data['leads_id']+')">Edit</a><a class="dropdown-item" href="javascript:void(0)" id="rt" onclick="view_lead_details('+data['leads_id']+')">view</a><a class="dropdown-item" href="javascript:void(0)" onclick="return delete_leads('+data['leads_id']+')">Delete</a></div></div>');

                let actionHtml = '<div class="dropdown ms-auto text-end"><div class="btn-link" data-bs-toggle="dropdown"><svg width="24px" height="24px" viewBox="0 0 24 24" version="1.1"><g stroke="none" stroke-width="1" fill="none" fill-rule="evenodd"><rect x="0" y="0" width="24" height="24"></rect><circle fill="#000000" cx="5" cy="12" r="2"></circle><circle fill="#000000" cx="12" cy="12" r="2"></circle><circle fill="#000000" cx="19" cy="12" r="2"></circle></g></svg></div><div class="dropdown-menu dropdown-menu-end">';
                
                // Edit button
                if (hasPermission('LEADS_UPDATE')) {
                    actionHtml += '<a class="dropdown-item" href="javascript:void(0)" id="rt" onclick="edit_leads('+data['leads_id']+')">Edit</a>';
                }

               // Change status button
                if (hasPermission('LEADS_CHANGE_STATUS')) {
                    actionHtml += '<a class="dropdown-item" href="javascript:void(0)" id="rt" onclick="openChangeStatus1Modal('+data['leads_id']+')">Change status</a>';
                }

                // Show status button
                if (hasPermission('LEADS_SHOW_STATUS')) {
                    actionHtml += '<a class="dropdown-item" href="javascript:void(0)" id="rt" onclick="showStatus1Modal('+data['leads_id']+')">Status history</a>';
                }

                // Change stage button
                if (hasPermission('LEADS_CHANGE_STAGE')) {
                    actionHtml += '<a class="dropdown-item" href="javascript:void(0)" id="rt" onclick="openChangeStatusModal('+data['leads_id']+')">Change stage</a>';
                }

                // Show stage button
                if (hasPermission('LEADS_SHOW_STAGE')) {
                    actionHtml += '<a class="dropdown-item" href="javascript:void(0)" id="rt" onclick="showStatusModal('+data['leads_id']+')">Show stages</a>';
                }

                // Guest count button
                if (hasPermission('LEADS_GUEST_COUNT')) {
                    actionHtml += '<a class="dropdown-item" href="javascript:void(0)" id="rt"  onclick="open_guest_count_checked('+data['leads_id']+')">Guest count</a>';
                }

                 // Accomodation plan button
                if (hasPermission('LEADS_ACCOMODATION_PLAN')) {
                    actionHtml += '<a class="dropdown-item" href="javascript:void(0)" id="rt"  onclick="open_accommodation_checked('+data['leads_id']+')">Accomodation plan</a>';
                }

                // Details button
                if (hasPermission('LEADS_DETAILS')) {
                    actionHtml += '<a class="dropdown-item" href="javascript:void(0)" id="rt" onclick="view_lead_details('+data['leads_id']+')">view</a>';
                }

                // Delete button
                if (hasPermission('LEADS_DELETE')) {
                    actionHtml += '<a class="dropdown-item" href="javascript:void(0)" onclick="return delete_leads('+data['leads_id']+')">Delete</a>';
                }

                actionHtml += '</div></div>';

                $('td', row).eq(11).html(actionHtml);

                }

              if(data['leads_accomodation_status'] == 2 && data['leads_quotation_status'] == 0){

                $('td', row).eq(1).html('<a class="leads-number-link" href="javascript:void(0)" onclick="view_lead_details('+data['leads_id']+')">'+data['leads_number']+'</a><br><span class="badge badge-xs badge badge-info">Quotation not created</span>');
                // $('td', row).eq(11).html('<div class="dropdown ms-auto text-end"><div class="btn-link" data-bs-toggle="dropdown"><svg width="24px" height="24px" viewBox="0 0 24 24" version="1.1"><g stroke="none" stroke-width="1" fill="none" fill-rule="evenodd"><rect x="0" y="0" width="24" height="24"></rect><circle fill="#000000" cx="5" cy="12" r="2"></circle><circle fill="#000000" cx="12" cy="12" r="2"></circle><circle fill="#000000" cx="19" cy="12" r="2"></circle></g></svg></div><div class="dropdown-menu dropdown-menu-end"><a class="dropdown-item" href="javascript:void(0)" id="rt" onclick="openChangeStatusModal('+data['leads_id']+')">Change stage</a><a class="dropdown-item" href="javascript:void(0)" id="rt" onclick="showStatusModal('+data['leads_id']+')">Show stages</a><a class="dropdown-item" href="javascript:void(0)" id="rt" onclick="openChangeStatus1Modal('+data['leads_id']+')">Change status</a><a class="dropdown-item" href="javascript:void(0)" id="rt" onclick="showStatus1Modal('+data['leads_id']+')">Status history</a><a class="dropdown-item" href="javascript:void(0)" id="rt"  onclick="guset_count_edit('+data['leads_id']+')">Guest count</a><a class="dropdown-item" href="javascript:void(0)" id="rt"  onclick="accomodation_plan('+data['leads_id']+')">Accomodation plan</a><a class="dropdown-item" href="javascript:void(0)" id="rt" onclick="open_quotation('+data['leads_id']+')">Quotation</a><a class="dropdown-item" href="javascript:void(0)" id="rt" onclick="edit_leads('+data['leads_id']+')">Edit</a><a class="dropdown-item" href="javascript:void(0)" id="rt" onclick="view_lead_details('+data['leads_id']+')">view</a><a class="dropdown-item" href="javascript:void(0)" onclick="return delete_leads('+data['leads_id']+')">Delete</a></div></div>');

                let actionHtml = '<div class="dropdown ms-auto text-end"><div class="btn-link" data-bs-toggle="dropdown"><svg width="24px" height="24px" viewBox="0 0 24 24" version="1.1"><g stroke="none" stroke-width="1" fill="none" fill-rule="evenodd"><rect x="0" y="0" width="24" height="24"></rect><circle fill="#000000" cx="5" cy="12" r="2"></circle><circle fill="#000000" cx="12" cy="12" r="2"></circle><circle fill="#000000" cx="19" cy="12" r="2"></circle></g></svg></div><div class="dropdown-menu dropdown-menu-end">';
                
                // Edit button
                if (hasPermission('LEADS_UPDATE')) {
                    actionHtml += '<a class="dropdown-item" href="javascript:void(0)" id="rt" onclick="edit_leads('+data['leads_id']+')">Edit</a>';
                }

               // Change status button
                if (hasPermission('LEADS_CHANGE_STATUS')) {
                    actionHtml += '<a class="dropdown-item" href="javascript:void(0)" id="rt" onclick="openChangeStatus1Modal('+data['leads_id']+')">Change status</a>';
                }

                // Show status button
                if (hasPermission('LEADS_SHOW_STATUS')) {
                    actionHtml += '<a class="dropdown-item" href="javascript:void(0)" id="rt" onclick="showStatus1Modal('+data['leads_id']+')">Status history</a>';
                }

                // Change stage button
                if (hasPermission('LEADS_CHANGE_STAGE')) {
                    actionHtml += '<a class="dropdown-item" href="javascript:void(0)" id="rt" onclick="openChangeStatusModal('+data['leads_id']+')">Change stage</a>';
                }

                // Show stage button
                if (hasPermission('LEADS_SHOW_STAGE')) {
                    actionHtml += '<a class="dropdown-item" href="javascript:void(0)" id="rt" onclick="showStatusModal('+data['leads_id']+')">Show stages</a>';
                }

                // Guest count button
                if (hasPermission('LEADS_GUEST_COUNT')) {
                    actionHtml += '<a class="dropdown-item" href="javascript:void(0)" id="rt"  onclick="open_guest_count_checked('+data['leads_id']+')">Guest count</a>';
                }

                // Accomodation plan button
                if (hasPermission('LEADS_ACCOMODATION_PLAN')) {
                    actionHtml += '<a class="dropdown-item" href="javascript:void(0)" id="rt"  onclick="open_accommodation_checked('+data['leads_id']+')">Accomodation plan</a>';
                }

                // Quotation button
                if (hasPermission('LEADS_QUOTATION')) {
                    actionHtml += '<a class="dropdown-item" href="javascript:void(0)" id="rt" onclick="open_quotation('+data['leads_id']+')">Quotation</a>';
                }

                // Details button
                if (hasPermission('LEADS_DETAILS')) {
                    actionHtml += '<a class="dropdown-item" href="javascript:void(0)" id="rt" onclick="view_lead_details('+data['leads_id']+')">view</a>';
                }

                // Delete button
                if (hasPermission('LEADS_DELETE')) {
                    actionHtml += '<a class="dropdown-item" href="javascript:void(0)" onclick="return delete_leads('+data['leads_id']+')">Delete</a>';
                }

                actionHtml += '</div></div>';

                $('td', row).eq(11).html(actionHtml);

              }
              renderRejectedQuotationRow(data, row);
              renderQuotationCreatedRow(data, row);
              renderCancelledQuotationRow(data, row);
              if(data['leads_accomodation_status'] == 2 && data['leads_quotation_status'] == 1){

                    // $('td', row).eq(11).html('<div class="dropdown ms-auto text-end"><div class="btn-link" data-bs-toggle="dropdown"><svg width="24px" height="24px" viewBox="0 0 24 24" version="1.1"><g stroke="none" stroke-width="1" fill="none" fill-rule="evenodd"><rect x="0" y="0" width="24" height="24"></rect><circle fill="#000000" cx="5" cy="12" r="2"></circle><circle fill="#000000" cx="12" cy="12" r="2"></circle><circle fill="#000000" cx="19" cy="12" r="2"></circle></g></svg></div><div class="dropdown-menu dropdown-menu-end"><a class="dropdown-item" href="javascript:void(0)" id="rt" onclick="openChangeStatusModal('+data['leads_id']+')">Change stage</a><a class="dropdown-item" href="javascript:void(0)" id="rt" onclick="showStatusModal('+data['leads_id']+')">Show stages</a><a class="dropdown-item" href="javascript:void(0)" id="rt" onclick="openChangeStatus1Modal('+data['leads_id']+')">Change status</a><a class="dropdown-item" href="javascript:void(0)" id="rt" onclick="showStatus1Modal('+data['leads_id']+')">Status history</a><a class="dropdown-item" href="javascript:void(0)" id="rt" onclick="edit_leads('+data['leads_id']+')">Edit</a><a class="dropdown-item" href="javascript:void(0)" id="rt" onclick="view_lead_details('+data['leads_id']+')">view</a><a class="dropdown-item" href="javascript:void(0)" onclick="return delete_leads('+data['leads_id']+')">Delete</a></div></div>');

                    $('td', row).eq(1).html('<a class="leads-number-link" href="javascript:void(0)" onclick="view_lead_details('+data['leads_id']+')">'+data['leads_number']+'</a><br><span class="badge badge-xs badge badge-success">Quotation created</span>');

                    let actionHtml = '<div class="dropdown ms-auto text-end"><div class="btn-link" data-bs-toggle="dropdown"><svg width="24px" height="24px" viewBox="0 0 24 24" version="1.1"><g stroke="none" stroke-width="1" fill="none" fill-rule="evenodd"><rect x="0" y="0" width="24" height="24"></rect><circle fill="#000000" cx="5" cy="12" r="2"></circle><circle fill="#000000" cx="12" cy="12" r="2"></circle><circle fill="#000000" cx="19" cy="12" r="2"></circle></g></svg></div><div class="dropdown-menu dropdown-menu-end">';
                
                // Edit button
                if (hasPermission('LEADS_UPDATE')) {
                    actionHtml += '<a class="dropdown-item" href="javascript:void(0)" id="rt" onclick="edit_leads('+data['leads_id']+')">Edit</a>';
                }

               // Change status button
                if (hasPermission('LEADS_CHANGE_STATUS')) {
                    actionHtml += '<a class="dropdown-item" href="javascript:void(0)" id="rt" onclick="openChangeStatus1Modal('+data['leads_id']+')">Change status</a>';
                }

                // Show status button
                if (hasPermission('LEADS_SHOW_STATUS')) {
                    actionHtml += '<a class="dropdown-item" href="javascript:void(0)" id="rt" onclick="showStatus1Modal('+data['leads_id']+')">Status history</a>';
                }

                // Change stage button
                if (hasPermission('LEADS_CHANGE_STAGE')) {
                    actionHtml += '<a class="dropdown-item" href="javascript:void(0)" id="rt" onclick="openChangeStatusModal('+data['leads_id']+')">Change stage</a>';
                }

                // Show stage button
                if (hasPermission('LEADS_SHOW_STAGE')) {
                    actionHtml += '<a class="dropdown-item" href="javascript:void(0)" id="rt" onclick="showStatusModal('+data['leads_id']+')">Show stages</a>';
                }

                // Details button
                if (hasPermission('LEADS_DETAILS')) {
                    actionHtml += '<a class="dropdown-item" href="javascript:void(0)" id="rt" onclick="view_lead_details('+data['leads_id']+')">view</a>';
                }

                // Delete button
                if (hasPermission('LEADS_DELETE')) {
                    actionHtml += '<a class="dropdown-item" href="javascript:void(0)" onclick="return delete_leads('+data['leads_id']+')">Delete</a>';
                }

                actionHtml += '</div></div>';

                $('td', row).eq(11).html(actionHtml);
              }
              if(data['leads_accomodation_status'] == 2 && data['leads_quotation_status'] == 2){

                    // $('td', row).eq(11).html('<div class="dropdown ms-auto text-end"><div class="btn-link" data-bs-toggle="dropdown"><svg width="24px" height="24px" viewBox="0 0 24 24" version="1.1"><g stroke="none" stroke-width="1" fill="none" fill-rule="evenodd"><rect x="0" y="0" width="24" height="24"></rect><circle fill="#000000" cx="5" cy="12" r="2"></circle><circle fill="#000000" cx="12" cy="12" r="2"></circle><circle fill="#000000" cx="19" cy="12" r="2"></circle></g></svg></div><div class="dropdown-menu dropdown-menu-end"><a class="dropdown-item" href="javascript:void(0)" id="rt" onclick="openChangeStatusModal('+data['leads_id']+')">Change stage</a><a class="dropdown-item" href="javascript:void(0)" id="rt" onclick="showStatusModal('+data['leads_id']+')">Show stages</a><a class="dropdown-item" href="javascript:void(0)" id="rt" onclick="openChangeStatus1Modal('+data['leads_id']+')">Change status</a><a class="dropdown-item" href="javascript:void(0)" id="rt" onclick="showStatus1Modal('+data['leads_id']+')">Status history</a><a class="dropdown-item" href="javascript:void(0)" id="rt" onclick="edit_leads('+data['leads_id']+')">Edit</a><a class="dropdown-item" href="javascript:void(0)" id="rt" onclick="view_lead_details('+data['leads_id']+')">view</a><a class="dropdown-item" href="javascript:void(0)" onclick="return delete_leads('+data['leads_id']+')">Delete</a></div></div>');

                    $('td', row).eq(1).html('<a class="leads-number-link" href="javascript:void(0)" onclick="view_lead_details('+data['leads_id']+')">'+data['leads_number']+'</a><br><span class="badge badge-xs badge badge-info">Cancelled/Quotation not created</span>');

                    let actionHtml = '<div class="dropdown ms-auto text-end"><div class="btn-link" data-bs-toggle="dropdown"><svg width="24px" height="24px" viewBox="0 0 24 24" version="1.1"><g stroke="none" stroke-width="1" fill="none" fill-rule="evenodd"><rect x="0" y="0" width="24" height="24"></rect><circle fill="#000000" cx="5" cy="12" r="2"></circle><circle fill="#000000" cx="12" cy="12" r="2"></circle><circle fill="#000000" cx="19" cy="12" r="2"></circle></g></svg></div><div class="dropdown-menu dropdown-menu-end">';
                
                // Edit button
                if (hasPermission('LEADS_UPDATE')) {
                    actionHtml += '<a class="dropdown-item" href="javascript:void(0)" id="rt" onclick="edit_leads('+data['leads_id']+')">Edit</a>';
                }

               // Change status button
                if (hasPermission('LEADS_CHANGE_STATUS')) {
                    actionHtml += '<a class="dropdown-item" href="javascript:void(0)" id="rt" onclick="openChangeStatus1Modal('+data['leads_id']+')">Change status</a>';
                }

                // Show status button
                if (hasPermission('LEADS_SHOW_STATUS')) {
                    actionHtml += '<a class="dropdown-item" href="javascript:void(0)" id="rt" onclick="showStatus1Modal('+data['leads_id']+')">Status history</a>';
                }

                // Change stage button
                if (hasPermission('LEADS_CHANGE_STAGE')) {
                    actionHtml += '<a class="dropdown-item" href="javascript:void(0)" id="rt" onclick="openChangeStatusModal('+data['leads_id']+')">Change stage</a>';
                }

                // Show stage button
                if (hasPermission('LEADS_SHOW_STAGE')) {
                    actionHtml += '<a class="dropdown-item" href="javascript:void(0)" id="rt" onclick="showStatusModal('+data['leads_id']+')">Show stages</a>';
                }

                // Guest count button
                if (hasPermission('LEADS_GUEST_COUNT')) {
                    actionHtml += '<a class="dropdown-item" href="javascript:void(0)" id="rt"  onclick="open_guest_count_checked('+data['leads_id']+')">Guest count</a>';
                }

                // Accomodation plan button
                if (hasPermission('LEADS_ACCOMODATION_PLAN')) {
                    actionHtml += '<a class="dropdown-item" href="javascript:void(0)" id="rt"  onclick="open_accommodation_checked('+data['leads_id']+')">Accomodation plan</a>';
                }

                // Quotation button
                if (hasPermission('LEADS_QUOTATION')) {
                    actionHtml += '<a class="dropdown-item" href="javascript:void(0)" id="rt" onclick="open_quotation('+data['leads_id']+')">Quotation</a>';
                }

                // Details button
                if (hasPermission('LEADS_DETAILS')) {
                    actionHtml += '<a class="dropdown-item" href="javascript:void(0)" id="rt" onclick="view_lead_details('+data['leads_id']+')">view</a>';
                }

                // Delete button
                if (hasPermission('LEADS_DELETE')) {
                    actionHtml += '<a class="dropdown-item" href="javascript:void(0)" onclick="return delete_leads('+data['leads_id']+')">Delete</a>';
                }

                actionHtml += '</div></div>';

                $('td', row).eq(11).html(actionHtml);
              }
              renderRejectedQuotationRow(data, row);
            }
            else if($table2.cell(node).data() == '5') {
				$table2.cell(node).data('<center><span class="badge badge-sm light btn-danger">Lost</span></center>');
            // else if(data['lead_current_status'] == 5){
              // $('td', row).eq(9).html('<span class="badge badge-danger">Lost</span>');

              if(data['leads_accomodation_status'] == 0 && data['leads_quotation_status'] == 0){
              
                $('td', row).eq(1).html('<a class="leads-number-link" href="javascript:void(0)" onclick="view_lead_details('+data['leads_id']+')">'+data['leads_number']+'</a><br><span class="badge badge-xs badge badge-primary">guest count required</span>');

                // $('td', row).eq(11).html('<div class="dropdown ms-auto text-end"><div class="btn-link" data-bs-toggle="dropdown"><svg width="24px" height="24px" viewBox="0 0 24 24" version="1.1"><g stroke="none" stroke-width="1" fill="none" fill-rule="evenodd"><rect x="0" y="0" width="24" height="24"></rect><circle fill="#000000" cx="5" cy="12" r="2"></circle><circle fill="#000000" cx="12" cy="12" r="2"></circle><circle fill="#000000" cx="19" cy="12" r="2"></circle></g></svg></div><div class="dropdown-menu dropdown-menu-end"><a class="dropdown-item" href="javascript:void(0)" id="rt" onclick="openChangeStatusModal('+data['leads_id']+')">Change stage</a><a class="dropdown-item" href="javascript:void(0)" id="rt" onclick="showStatusModal('+data['leads_id']+')">Show stages</a><a class="dropdown-item" href="javascript:void(0)" id="rt" onclick="openChangeStatus1Modal('+data['leads_id']+')">Change status</a><a class="dropdown-item" href="javascript:void(0)" id="rt" onclick="showStatus1Modal('+data['leads_id']+')">Status history</a><a class="dropdown-item" href="javascript:void(0)" id="rt"  onclick="guset_count_edit('+data['leads_id']+')">Guest count</a><a class="dropdown-item" href="javascript:void(0)" id="rt" onclick="edit_leads('+data['leads_id']+')">Edit</a><a class="dropdown-item" href="javascript:void(0)" id="rt" onclick="view_lead_details('+data['leads_id']+')">view</a><a class="dropdown-item" href="javascript:void(0)" onclick="return delete_leads('+data['leads_id']+')">Delete</a></div></div>');
              
                 let actionHtml = '<div class="dropdown ms-auto text-end"><div class="btn-link" data-bs-toggle="dropdown"><svg width="24px" height="24px" viewBox="0 0 24 24" version="1.1"><g stroke="none" stroke-width="1" fill="none" fill-rule="evenodd"><rect x="0" y="0" width="24" height="24"></rect><circle fill="#000000" cx="5" cy="12" r="2"></circle><circle fill="#000000" cx="12" cy="12" r="2"></circle><circle fill="#000000" cx="19" cy="12" r="2"></circle></g></svg></div><div class="dropdown-menu dropdown-menu-end">';
                // Edit button
                if (hasPermission('LEADS_UPDATE')) {
                    actionHtml += '<a class="dropdown-item" href="javascript:void(0)" id="rt" onclick="edit_leads('+data['leads_id']+')">Edit</a>';
                }

               // Change status button
                if (hasPermission('LEADS_CHANGE_STATUS')) {
                    actionHtml += '<a class="dropdown-item" href="javascript:void(0)" id="rt" onclick="openChangeStatus1Modal('+data['leads_id']+')">Change status</a>';
                }

                // Show status button
                if (hasPermission('LEADS_SHOW_STATUS')) {
                    actionHtml += '<a class="dropdown-item" href="javascript:void(0)" id="rt" onclick="showStatus1Modal('+data['leads_id']+')">Status history</a>';
                }

                // Change stage button
                if (hasPermission('LEADS_CHANGE_STAGE')) {
                    actionHtml += '<a class="dropdown-item" href="javascript:void(0)" id="rt" onclick="openChangeStatusModal('+data['leads_id']+')">Change stage</a>';
                }

                // Show stage button
                if (hasPermission('LEADS_SHOW_STAGE')) {
                    actionHtml += '<a class="dropdown-item" href="javascript:void(0)" id="rt" onclick="showStatusModal('+data['leads_id']+')">Show stages</a>';
                }

                // Guest count button
                if (hasPermission('LEADS_GUEST_COUNT')) {
                    actionHtml += '<a class="dropdown-item" href="javascript:void(0)" id="rt"  onclick="open_guest_count_checked('+data['leads_id']+')">Guest count</a>';
                }

                // Details button
                if (hasPermission('LEADS_DETAILS')) {
                    actionHtml += '<a class="dropdown-item" href="javascript:void(0)" id="rt" onclick="view_lead_details('+data['leads_id']+')">view</a>';
                }

                // Delete button
                if (hasPermission('LEADS_DELETE')) {
                    actionHtml += '<a class="dropdown-item" href="javascript:void(0)" onclick="return delete_leads('+data['leads_id']+')">Delete</a>';
                }

                actionHtml += '</div></div>';

                $('td', row).eq(11).html(actionHtml);

                }
              
              if(data['leads_accomodation_status'] == 1 && data['leads_quotation_status'] == 0){

                $('td', row).eq(1).html('<a class="leads-number-link" href="javascript:void(0)" onclick="view_lead_details('+data['leads_id']+')">'+data['leads_number']+'</a><br><span class="badge badge-xs badge badge-warning">accommodation required</span>');
                
                // $('td', row).eq(11).html('<div class="dropdown ms-auto text-end"><div class="btn-link" data-bs-toggle="dropdown"><svg width="24px" height="24px" viewBox="0 0 24 24" version="1.1"><g stroke="none" stroke-width="1" fill="none" fill-rule="evenodd"><rect x="0" y="0" width="24" height="24"></rect><circle fill="#000000" cx="5" cy="12" r="2"></circle><circle fill="#000000" cx="12" cy="12" r="2"></circle><circle fill="#000000" cx="19" cy="12" r="2"></circle></g></svg></div><div class="dropdown-menu dropdown-menu-end"><a class="dropdown-item" href="javascript:void(0)" id="rt" onclick="openChangeStatusModal('+data['leads_id']+')">Change stage</a><a class="dropdown-item" href="javascript:void(0)" id="rt" onclick="showStatusModal('+data['leads_id']+')">Show stages</a><a class="dropdown-item" href="javascript:void(0)" id="rt" onclick="openChangeStatus1Modal('+data['leads_id']+')">Change status</a><a class="dropdown-item" href="javascript:void(0)" id="rt" onclick="showStatus1Modal('+data['leads_id']+')">Status history</a><a class="dropdown-item" href="javascript:void(0)" id="rt"  onclick="guset_count_edit('+data['leads_id']+')">Guest count</a><a class="dropdown-item" href="javascript:void(0)" id="rt"  onclick="accomodation_plan('+data['leads_id']+')">Accomodation plan</a><a class="dropdown-item" href="javascript:void(0)" id="rt" onclick="edit_leads('+data['leads_id']+')">Edit</a><a class="dropdown-item" href="javascript:void(0)" id="rt" onclick="view_lead_details('+data['leads_id']+')">view</a><a class="dropdown-item" href="javascript:void(0)" onclick="return delete_leads('+data['leads_id']+')">Delete</a></div></div>');

                let actionHtml = '<div class="dropdown ms-auto text-end"><div class="btn-link" data-bs-toggle="dropdown"><svg width="24px" height="24px" viewBox="0 0 24 24" version="1.1"><g stroke="none" stroke-width="1" fill="none" fill-rule="evenodd"><rect x="0" y="0" width="24" height="24"></rect><circle fill="#000000" cx="5" cy="12" r="2"></circle><circle fill="#000000" cx="12" cy="12" r="2"></circle><circle fill="#000000" cx="19" cy="12" r="2"></circle></g></svg></div><div class="dropdown-menu dropdown-menu-end">';
                
                // Edit button
                if (hasPermission('LEADS_UPDATE')) {
                    actionHtml += '<a class="dropdown-item" href="javascript:void(0)" id="rt" onclick="edit_leads('+data['leads_id']+')">Edit</a>';
                }

               // Change status button
                if (hasPermission('LEADS_CHANGE_STATUS')) {
                    actionHtml += '<a class="dropdown-item" href="javascript:void(0)" id="rt" onclick="openChangeStatus1Modal('+data['leads_id']+')">Change status</a>';
                }

                // Show status button
                if (hasPermission('LEADS_SHOW_STATUS')) {
                    actionHtml += '<a class="dropdown-item" href="javascript:void(0)" id="rt" onclick="showStatus1Modal('+data['leads_id']+')">Status history</a>';
                }

                // Change stage button
                if (hasPermission('LEADS_CHANGE_STAGE')) {
                    actionHtml += '<a class="dropdown-item" href="javascript:void(0)" id="rt" onclick="openChangeStatusModal('+data['leads_id']+')">Change stage</a>';
                }

                // Show stage button
                if (hasPermission('LEADS_SHOW_STAGE')) {
                    actionHtml += '<a class="dropdown-item" href="javascript:void(0)" id="rt" onclick="showStatusModal('+data['leads_id']+')">Show stages</a>';
                }

                // Guest count button
                if (hasPermission('LEADS_GUEST_COUNT')) {
                    actionHtml += '<a class="dropdown-item" href="javascript:void(0)" id="rt"  onclick="open_guest_count_checked('+data['leads_id']+')">Guest count</a>';
                }

                 // Accomodation plan button
                if (hasPermission('LEADS_ACCOMODATION_PLAN')) {
                    actionHtml += '<a class="dropdown-item" href="javascript:void(0)" id="rt"  onclick="open_accommodation_checked('+data['leads_id']+')">Accomodation plan</a>';
                }

                // Details button
                if (hasPermission('LEADS_DETAILS')) {
                    actionHtml += '<a class="dropdown-item" href="javascript:void(0)" id="rt" onclick="view_lead_details('+data['leads_id']+')">view</a>';
                }

                // Delete button
                if (hasPermission('LEADS_DELETE')) {
                    actionHtml += '<a class="dropdown-item" href="javascript:void(0)" onclick="return delete_leads('+data['leads_id']+')">Delete</a>';
                }

                actionHtml += '</div></div>';

                $('td', row).eq(11).html(actionHtml);

                }

              if(data['leads_accomodation_status'] == 2 && data['leads_quotation_status'] == 0){

                // $('td', row).eq(11).html('<div class="dropdown ms-auto text-end"><div class="btn-link" data-bs-toggle="dropdown"><svg width="24px" height="24px" viewBox="0 0 24 24" version="1.1"><g stroke="none" stroke-width="1" fill="none" fill-rule="evenodd"><rect x="0" y="0" width="24" height="24"></rect><circle fill="#000000" cx="5" cy="12" r="2"></circle><circle fill="#000000" cx="12" cy="12" r="2"></circle><circle fill="#000000" cx="19" cy="12" r="2"></circle></g></svg></div><div class="dropdown-menu dropdown-menu-end"><a class="dropdown-item" href="javascript:void(0)" id="rt" onclick="openChangeStatusModal('+data['leads_id']+')">Change stage</a><a class="dropdown-item" href="javascript:void(0)" id="rt" onclick="showStatusModal('+data['leads_id']+')">Show stages</a><a class="dropdown-item" href="javascript:void(0)" id="rt" onclick="openChangeStatus1Modal('+data['leads_id']+')">Change status</a><a class="dropdown-item" href="javascript:void(0)" id="rt" onclick="showStatus1Modal('+data['leads_id']+')">Status history</a><a class="dropdown-item" href="javascript:void(0)" id="rt"  onclick="guset_count_edit('+data['leads_id']+')">Guest count</a><a class="dropdown-item" href="javascript:void(0)" id="rt"  onclick="accomodation_plan('+data['leads_id']+')">Accomodation plan</a><a class="dropdown-item" href="javascript:void(0)" id="rt" onclick="open_quotation('+data['leads_id']+')">Quotation</a><a class="dropdown-item" href="javascript:void(0)" id="rt" onclick="edit_leads('+data['leads_id']+')">Edit</a><a class="dropdown-item" href="javascript:void(0)" id="rt" onclick="view_lead_details('+data['leads_id']+')">view</a><a class="dropdown-item" href="javascript:void(0)" onclick="return delete_leads('+data['leads_id']+')">Delete</a></div></div>');

                $('td', row).eq(1).html('<a class="leads-number-link" href="javascript:void(0)" onclick="view_lead_details('+data['leads_id']+')">'+data['leads_number']+'</a><br><span class="badge badge-xs badge badge-info">Quotation not created</span>');

                let actionHtml = '<div class="dropdown ms-auto text-end"><div class="btn-link" data-bs-toggle="dropdown"><svg width="24px" height="24px" viewBox="0 0 24 24" version="1.1"><g stroke="none" stroke-width="1" fill="none" fill-rule="evenodd"><rect x="0" y="0" width="24" height="24"></rect><circle fill="#000000" cx="5" cy="12" r="2"></circle><circle fill="#000000" cx="12" cy="12" r="2"></circle><circle fill="#000000" cx="19" cy="12" r="2"></circle></g></svg></div><div class="dropdown-menu dropdown-menu-end">';
                
                // Edit button
                if (hasPermission('LEADS_UPDATE')) {
                    actionHtml += '<a class="dropdown-item" href="javascript:void(0)" id="rt" onclick="edit_leads('+data['leads_id']+')">Edit</a>';
                }

               // Change status button
                if (hasPermission('LEADS_CHANGE_STATUS')) {
                    actionHtml += '<a class="dropdown-item" href="javascript:void(0)" id="rt" onclick="openChangeStatus1Modal('+data['leads_id']+')">Change status</a>';
                }

                // Show status button
                if (hasPermission('LEADS_SHOW_STATUS')) {
                    actionHtml += '<a class="dropdown-item" href="javascript:void(0)" id="rt" onclick="showStatus1Modal('+data['leads_id']+')">Status history</a>';
                }

                // Change stage button
                if (hasPermission('LEADS_CHANGE_STAGE')) {
                    actionHtml += '<a class="dropdown-item" href="javascript:void(0)" id="rt" onclick="openChangeStatusModal('+data['leads_id']+')">Change stage</a>';
                }

                // Show stage button
                if (hasPermission('LEADS_SHOW_STAGE')) {
                    actionHtml += '<a class="dropdown-item" href="javascript:void(0)" id="rt" onclick="showStatusModal('+data['leads_id']+')">Show stages</a>';
                }

                // Guest count button
                if (hasPermission('LEADS_GUEST_COUNT')) {
                    actionHtml += '<a class="dropdown-item" href="javascript:void(0)" id="rt"  onclick="open_guest_count_checked('+data['leads_id']+')">Guest count</a>';
                }

                // Accomodation plan button
                if (hasPermission('LEADS_ACCOMODATION_PLAN')) {
                    actionHtml += '<a class="dropdown-item" href="javascript:void(0)" id="rt"  onclick="open_accommodation_checked('+data['leads_id']+')">Accomodation plan</a>';
                }

                // Quotation button
                if (hasPermission('LEADS_QUOTATION')) {
                    actionHtml += '<a class="dropdown-item" href="javascript:void(0)" id="rt" onclick="open_quotation('+data['leads_id']+')">Quotation</a>';
                }

                // Details button
                if (hasPermission('LEADS_DETAILS')) {
                    actionHtml += '<a class="dropdown-item" href="javascript:void(0)" id="rt" onclick="view_lead_details('+data['leads_id']+')">view</a>';
                }

                // Delete button
                if (hasPermission('LEADS_DELETE')) {
                    actionHtml += '<a class="dropdown-item" href="javascript:void(0)" onclick="return delete_leads('+data['leads_id']+')">Delete</a>';
                }

                actionHtml += '</div></div>';

                $('td', row).eq(11).html(actionHtml);

              }
              renderRejectedQuotationRow(data, row);
              renderQuotationCreatedRow(data, row);
              renderCancelledQuotationRow(data, row);
              if(data['leads_accomodation_status'] == 2 && data['leads_quotation_status'] == 1){

                    // $('td', row).eq(11).html('<div class="dropdown ms-auto text-end"><div class="btn-link" data-bs-toggle="dropdown"><svg width="24px" height="24px" viewBox="0 0 24 24" version="1.1"><g stroke="none" stroke-width="1" fill="none" fill-rule="evenodd"><rect x="0" y="0" width="24" height="24"></rect><circle fill="#000000" cx="5" cy="12" r="2"></circle><circle fill="#000000" cx="12" cy="12" r="2"></circle><circle fill="#000000" cx="19" cy="12" r="2"></circle></g></svg></div><div class="dropdown-menu dropdown-menu-end"><a class="dropdown-item" href="javascript:void(0)" id="rt" onclick="openChangeStatusModal('+data['leads_id']+')">Change stage</a><a class="dropdown-item" href="javascript:void(0)" id="rt" onclick="showStatusModal('+data['leads_id']+')">Show stages</a><a class="dropdown-item" href="javascript:void(0)" id="rt" onclick="openChangeStatus1Modal('+data['leads_id']+')">Change status</a><a class="dropdown-item" href="javascript:void(0)" id="rt" onclick="showStatus1Modal('+data['leads_id']+')">Status history</a><a class="dropdown-item" href="javascript:void(0)" id="rt" onclick="edit_leads('+data['leads_id']+')">Edit</a><a class="dropdown-item" href="javascript:void(0)" id="rt" onclick="view_lead_details('+data['leads_id']+')">view</a><a class="dropdown-item" href="javascript:void(0)" onclick="return delete_leads('+data['leads_id']+')">Delete</a></div></div>');

                    $('td', row).eq(1).html('<a class="leads-number-link" href="javascript:void(0)" onclick="view_lead_details('+data['leads_id']+')">'+data['leads_number']+'</a><br><span class="badge badge-xs badge badge-success">Quotation created</span>');

                    let actionHtml = '<div class="dropdown ms-auto text-end"><div class="btn-link" data-bs-toggle="dropdown"><svg width="24px" height="24px" viewBox="0 0 24 24" version="1.1"><g stroke="none" stroke-width="1" fill="none" fill-rule="evenodd"><rect x="0" y="0" width="24" height="24"></rect><circle fill="#000000" cx="5" cy="12" r="2"></circle><circle fill="#000000" cx="12" cy="12" r="2"></circle><circle fill="#000000" cx="19" cy="12" r="2"></circle></g></svg></div><div class="dropdown-menu dropdown-menu-end">';
                
                // Edit button
                if (hasPermission('LEADS_UPDATE')) {
                    actionHtml += '<a class="dropdown-item" href="javascript:void(0)" id="rt" onclick="edit_leads('+data['leads_id']+')">Edit</a>';
                }

               // Change status button
                if (hasPermission('LEADS_CHANGE_STATUS')) {
                    actionHtml += '<a class="dropdown-item" href="javascript:void(0)" id="rt" onclick="openChangeStatus1Modal('+data['leads_id']+')">Change status</a>';
                }

                // Show status button
                if (hasPermission('LEADS_SHOW_STATUS')) {
                    actionHtml += '<a class="dropdown-item" href="javascript:void(0)" id="rt" onclick="showStatus1Modal('+data['leads_id']+')">Status history</a>';
                }

                // Change stage button
                if (hasPermission('LEADS_CHANGE_STAGE')) {
                    actionHtml += '<a class="dropdown-item" href="javascript:void(0)" id="rt" onclick="openChangeStatusModal('+data['leads_id']+')">Change stage</a>';
                }

                // Show stage button
                if (hasPermission('LEADS_SHOW_STAGE')) {
                    actionHtml += '<a class="dropdown-item" href="javascript:void(0)" id="rt" onclick="showStatusModal('+data['leads_id']+')">Show stages</a>';
                }

                // Details button
                if (hasPermission('LEADS_DETAILS')) {
                    actionHtml += '<a class="dropdown-item" href="javascript:void(0)" id="rt" onclick="view_lead_details('+data['leads_id']+')">view</a>';
                }

                // Delete button
                if (hasPermission('LEADS_DELETE')) {
                    actionHtml += '<a class="dropdown-item" href="javascript:void(0)" onclick="return delete_leads('+data['leads_id']+')">Delete</a>';
                }

                actionHtml += '</div></div>';

                $('td', row).eq(11).html(actionHtml);
              }
              if(data['leads_accomodation_status'] == 2 && data['leads_quotation_status'] == 2){

                    // $('td', row).eq(11).html('<div class="dropdown ms-auto text-end"><div class="btn-link" data-bs-toggle="dropdown"><svg width="24px" height="24px" viewBox="0 0 24 24" version="1.1"><g stroke="none" stroke-width="1" fill="none" fill-rule="evenodd"><rect x="0" y="0" width="24" height="24"></rect><circle fill="#000000" cx="5" cy="12" r="2"></circle><circle fill="#000000" cx="12" cy="12" r="2"></circle><circle fill="#000000" cx="19" cy="12" r="2"></circle></g></svg></div><div class="dropdown-menu dropdown-menu-end"><a class="dropdown-item" href="javascript:void(0)" id="rt" onclick="openChangeStatusModal('+data['leads_id']+')">Change stage</a><a class="dropdown-item" href="javascript:void(0)" id="rt" onclick="showStatusModal('+data['leads_id']+')">Show stages</a><a class="dropdown-item" href="javascript:void(0)" id="rt" onclick="openChangeStatus1Modal('+data['leads_id']+')">Change status</a><a class="dropdown-item" href="javascript:void(0)" id="rt" onclick="showStatus1Modal('+data['leads_id']+')">Status history</a><a class="dropdown-item" href="javascript:void(0)" id="rt" onclick="edit_leads('+data['leads_id']+')">Edit</a><a class="dropdown-item" href="javascript:void(0)" id="rt" onclick="view_lead_details('+data['leads_id']+')">view</a><a class="dropdown-item" href="javascript:void(0)" onclick="return delete_leads('+data['leads_id']+')">Delete</a></div></div>');

                    $('td', row).eq(1).html('<a class="leads-number-link" href="javascript:void(0)" onclick="view_lead_details('+data['leads_id']+')">'+data['leads_number']+'</a><br><span class="badge badge-xs badge badge-info">Cancelled/Quotation not created</span>');

                    let actionHtml = '<div class="dropdown ms-auto text-end"><div class="btn-link" data-bs-toggle="dropdown"><svg width="24px" height="24px" viewBox="0 0 24 24" version="1.1"><g stroke="none" stroke-width="1" fill="none" fill-rule="evenodd"><rect x="0" y="0" width="24" height="24"></rect><circle fill="#000000" cx="5" cy="12" r="2"></circle><circle fill="#000000" cx="12" cy="12" r="2"></circle><circle fill="#000000" cx="19" cy="12" r="2"></circle></g></svg></div><div class="dropdown-menu dropdown-menu-end">';
                
                // Edit button
                if (hasPermission('LEADS_UPDATE')) {
                    actionHtml += '<a class="dropdown-item" href="javascript:void(0)" id="rt" onclick="edit_leads('+data['leads_id']+')">Edit</a>';
                }

               // Change status button
                if (hasPermission('LEADS_CHANGE_STATUS')) {
                    actionHtml += '<a class="dropdown-item" href="javascript:void(0)" id="rt" onclick="openChangeStatus1Modal('+data['leads_id']+')">Change status</a>';
                }

                // Show status button
                if (hasPermission('LEADS_SHOW_STATUS')) {
                    actionHtml += '<a class="dropdown-item" href="javascript:void(0)" id="rt" onclick="showStatus1Modal('+data['leads_id']+')">Status history</a>';
                }

                // Change stage button
                if (hasPermission('LEADS_CHANGE_STAGE')) {
                    actionHtml += '<a class="dropdown-item" href="javascript:void(0)" id="rt" onclick="openChangeStatusModal('+data['leads_id']+')">Change stage</a>';
                }

                // Show stage button
                if (hasPermission('LEADS_SHOW_STAGE')) {
                    actionHtml += '<a class="dropdown-item" href="javascript:void(0)" id="rt" onclick="showStatusModal('+data['leads_id']+')">Show stages</a>';
                }

                // Guest count button
                if (hasPermission('LEADS_GUEST_COUNT')) {
                    actionHtml += '<a class="dropdown-item" href="javascript:void(0)" id="rt"  onclick="open_guest_count_checked('+data['leads_id']+')">Guest count</a>';
                }

                // Accomodation plan button
                if (hasPermission('LEADS_ACCOMODATION_PLAN')) {
                    actionHtml += '<a class="dropdown-item" href="javascript:void(0)" id="rt"  onclick="open_accommodation_checked('+data['leads_id']+')">Accomodation plan</a>';
                }

                // Quotation button
                if (hasPermission('LEADS_QUOTATION')) {
                    actionHtml += '<a class="dropdown-item" href="javascript:void(0)" id="rt" onclick="open_quotation('+data['leads_id']+')">Quotation</a>';
                }

                // Details button
                if (hasPermission('LEADS_DETAILS')) {
                    actionHtml += '<a class="dropdown-item" href="javascript:void(0)" id="rt" onclick="view_lead_details('+data['leads_id']+')">view</a>';
                }

                // Delete button
                if (hasPermission('LEADS_DELETE')) {
                    actionHtml += '<a class="dropdown-item" href="javascript:void(0)" onclick="return delete_leads('+data['leads_id']+')">Delete</a>';
                }

                actionHtml += '</div></div>';

                $('td', row).eq(11).html(actionHtml);
              }
              renderRejectedQuotationRow(data, row);
            }
        
          });
        

        //    $('td', row).eq(1).html('<center><a class="leads-number-link" href="javascript:void(0)" onclick="view_lead_details('+data['leads_id']+')">'+data['leads_number']+'</a></center>');

        //    $('td', row).eq(4).html('<center>'+data['leads_created_at']+'</center>');
            
            
           },

           "drawCallback": function( settings ) {
                // displaySelectByUserType();
            },

        "columns": [
            { "data": "leads_status", "orderable": false },
            { "data": "leads_number", "orderable": false },
            { "data": "guest_name", "orderable": false },
            { "data": "whats_number", "orderable": false },
            { "data": "lead_register_date", "orderable": false },
            { "data": "start_date", "orderable": false },
            { "data": "duration", "orderable": false },
            { "data": "admin_name", "orderable": false },
            { "data": "lead_current_status", "orderable": false },
            { "data": "stages_button", "orderable": false },
            { "data": "priority_status_button", "orderable": false },
            { "data": "leads_id", "orderable": false }
            
            
        ]
        
    });
    
  

  });

  var table3;
  $(document).ready(function() {
    
    
    $table3 = $('#B2B_table').DataTable( {
        "processing": true,
        "serverSide": true,
        "searching": false,
        "aLengthMenu": [[10, 25, 50, -1], [10, 25, 50, "All"]],
        // "bDestroy" : true,
        dom: 'lBfrtip',
            buttons: [
                
                                {
                                    extend: 'excel',
                                    exportOptions: {
                                        columns: [0, 1, 2, 3, 4, 5]
                                    }
                                },
                                {
                                    extend: 'pdf',
                                    exportOptions: {
                                        columns: [0, 1, 2, 3, 4, 5]
                                    }
                                },
                                {
                                    extend: 'print',
                                    exportOptions: {
                                        columns: [0 ,1, 2, 3, 4, 5]
                                    }
                                },
                               
            ],
        "ajax": {
            "url": "<?php echo base_url();?>index.php/Leads/get_b2b/",
            "type": "POST",
            "data" : function (d) {
                        d.agent_id_filter = $("#agent_id_filter").val();
                        d.leads_createdby_userid3 = $("#leads_createdby_userid3").val();
                        d.leads_start_date3 = $("#leads_start_date3").val();
                        d.leads_end_date3 = $("#leads_end_date3").val();
           }            
        },
        // "ajax": {
            // "url": "<?php echo site_url('States/get')?>",
            // "type": "POST"
        // },
        "createdRow": function ( row, data, index ) {
          
//            $('td',row).eq(0).html(index+1);
           $table3.column(0).nodes().each(function(node,index,dt){
            $table3.cell(node).data(index+1);
            });
            
            

            // $('td', row).eq(5).html('<div class="form-button-action"><a  data-toggle="tooltip" title="" class="btn btn-link btn-primary btn-lg" data-original-title="Edit Task" href="javascript:void(0)" onclick="edit_role('+data['roles_id']+')"><i class="fa fa-edit"></i></a><button type="button" data-toggle="tooltip" title="" class="btn btn-link btn-danger" data-original-title="Remove" href="javascript:void(0)" onclick="return delete_role('+data['roles_id']+')"><i class="fa fa-times"></i></button></div>');

            // $('td', row).eq(6).html('<div class="d-flex"><a href="javascript:void(0)" onclick="edit_room_tariff('+data['room_tariff_hike_id']+')" class="btn btn-primary shadow btn-xs sharp me-1"><i class="fas fa-pencil-alt"></i></a><a href="javascript:void(0)" onclick="return delete_room_tariff('+data['room_tariff_hike_id']+')" class="btn btn-danger shadow btn-xs sharp"><i class="fa fa-trash"></i></a></div>');

            // if(data['leads_accomodation_status'] == 0){

            //   $('td', row).eq(11).html('<div class="dropdown ms-auto text-end"><div class="btn-link" data-bs-toggle="dropdown"><svg width="24px" height="24px" viewBox="0 0 24 24" version="1.1"><g stroke="none" stroke-width="1" fill="none" fill-rule="evenodd"><rect x="0" y="0" width="24" height="24"></rect><circle fill="#000000" cx="5" cy="12" r="2"></circle><circle fill="#000000" cx="12" cy="12" r="2"></circle><circle fill="#000000" cx="19" cy="12" r="2"></circle></g></svg></div><div class="dropdown-menu dropdown-menu-end"><a class="dropdown-item" href="javascript:void(0)" id="rt" onclick="openChangeStatusModal('+data['leads_id']+')">Change status</a><a class="dropdown-item" href="javascript:void(0)" id="rt" onclick="showStatusModal('+data['leads_id']+')">Show status</a><a class="dropdown-item" href="javascript:void(0)" id="rt" onclick="edit_room_tariff('+data['room_tariff_hike_id']+')">Edit</a><a class="dropdown-item" href="javascript:void(0)" onclick="return delete_room_tariff('+data['room_tariff_hike_id']+')">Delete</a><a class="dropdown-item" href="javascript:void(0)" id="rt"  onclick="guset_count('+data['leads_id']+')">Guest count</a><a class="dropdown-item" href="javascript:void(0)" id="rt"  onclick="accomodation_plan('+data['leads_id']+')">Accomodation plan</a><a class="dropdown-item" href="<?php echo base_url();?>index.php/Room_tariff_management/View/'+data['room_tariff_hike_id']+'" >View Details</a></div></div>');
            // }
            
            //  if(data['leads_accomodation_status'] == 1){
              
            //   $('td', row).eq(11).html('<div class="dropdown ms-auto text-end"><div class="btn-link" data-bs-toggle="dropdown"><svg width="24px" height="24px" viewBox="0 0 24 24" version="1.1"><g stroke="none" stroke-width="1" fill="none" fill-rule="evenodd"><rect x="0" y="0" width="24" height="24"></rect><circle fill="#000000" cx="5" cy="12" r="2"></circle><circle fill="#000000" cx="12" cy="12" r="2"></circle><circle fill="#000000" cx="19" cy="12" r="2"></circle></g></svg></div><div class="dropdown-menu dropdown-menu-end"><a class="dropdown-item" href="javascript:void(0)" id="rt" onclick="openChangeStatusModal('+data['leads_id']+')">Change status</a><a class="dropdown-item" href="javascript:void(0)" id="rt" onclick="showStatusModal('+data['leads_id']+')">Show status</a><a class="dropdown-item" href="javascript:void(0)" id="rt" onclick="edit_room_tariff('+data['room_tariff_hike_id']+')">Edit</a><a class="dropdown-item" href="javascript:void(0)" onclick="return delete_room_tariff('+data['room_tariff_hike_id']+')">Delete</a><a class="dropdown-item" href="javascript:void(0)" id="rt"  onclick="guset_count_edit('+data['leads_id']+')">Guest count</a><a class="dropdown-item" href="javascript:void(0)" id="rt"  onclick="accomodation_plan('+data['leads_id']+')">Accomodation plan</a><a class="dropdown-item" href="<?php echo base_url();?>index.php/Room_tariff_management/View/'+data['room_tariff_hike_id']+'" >View Details</a></div></div>');
            //  }

            //  if(data['leads_accomodation_status'] == 2){
              
              $('td', row).eq(7).html('<div class="dropdown ms-auto text-end"><div class="btn-link" data-bs-toggle="dropdown"><svg width="24px" height="24px" viewBox="0 0 24 24" version="1.1"><g stroke="none" stroke-width="1" fill="none" fill-rule="evenodd"><rect x="0" y="0" width="24" height="24"></rect><circle fill="#000000" cx="5" cy="12" r="2"></circle><circle fill="#000000" cx="12" cy="12" r="2"></circle><circle fill="#000000" cx="19" cy="12" r="2"></circle></g></svg></div><div class="dropdown-menu dropdown-menu-end"><a class="dropdown-item" href="javascript:void(0)" id="rt" onclick="edit_b2bleads('+data['leads_id']+')">Edit</a><a class="dropdown-item" href="javascript:void(0)" onclick="return delete_leads('+data['leads_id']+')">Delete</a><a class="dropdown-item" href="<?php echo base_url();?>index.php/Room_tariff_management/View/'+data['room_tariff_hike_id']+'" >View Details</a></div></div>');
            //  }
            
            
           },

           "drawCallback": function( settings ) {
                // displaySelectByUserType();
            },

        "columns": [
            { "data": "leads_status", "orderable": false },
             { "data": "b2b_partner_agent_name", "orderable": false },
            { "data": "total_package_cost", "orderable": false },
            { "data": "expense", "orderable": false },
            { "data": "margin", "orderable": false },
            { "data": "description", "orderable": false },
            { "data": "leads_createdby_username", "orderable": false },                      
            { "data": "leads_id", "orderable": false }
            
            
        ]
        
    });
    
  

  });
////***Listing table*****///

////***For Leads view *****///

// function view_lead_details(id)
// {
//     $('#leadViewBody').html(`
//         <div class="text-center py-5">
//             <div class="spinner-border text-primary"></div>
//             <p class="mt-2 mb-0">Loading lead details...</p>
//         </div>
//     `);

//     $('#LeadsviewModal').modal('show');

//     $.ajax({
//         url: "<?php echo base_url('index.php/Leads/ajax_view_lead_details/'); ?>" + id,
//         type: "GET",
//         dataType: "JSON",
//         success: function(response)
//         {
//             if (!response.status) {
//                 $('#leadViewBody').html(`
//                     <div class="alert alert-danger mb-0">${response.message || 'Lead details not found.'}</div>
//                 `);
//                 return;
//             }

//             var d = response.data;
//             var leadType = (d.lead_type || '').trim();
//             var html = '';

//             html += buildLeadTopSection(d);

//             if (leadType === 'B2C') {
//                 html += buildB2CLayout(d);
//             } else if (leadType === 'Meta Lead') {
//                 html += buildMetaLayout(d);
//             } else if (leadType === 'B2B') {
//                 html += buildB2BLayout(d);
//             } else {
//                 html += buildFallbackLayout(d);
//             }

//             $('#leadViewBody').html(html);
//         },
//         error: function()
//         {
//             $('#leadViewBody').html(`
//                 <div class="alert alert-danger mb-0">Failed to load lead details.</div>
//             `);
//         }
//     });
// }

function view_lead_details(id)
{
    $('#leadViewBody').html(`
        <div class="text-center py-5">
            <div class="spinner-border text-primary"></div>
            <p class="mt-2 mb-0">Loading lead details...</p>
        </div>
    `);

    $('#guestAccommodationBody').html(`
        <div class="text-center py-5">
            <div class="spinner-border text-primary"></div>
            <p class="mt-2 mb-0">Loading guest and accommodation details...</p>
        </div>
    `);

    $('#leadViewTabs button[data-bs-target="#leadDetailsTab"]').tab('show');
    $('#LeadsviewModal').modal('show');

    $.ajax({
        url: "<?php echo base_url('index.php/Leads/ajax_view_lead_details/'); ?>" + id,
        type: "GET",
        dataType: "JSON",
        success: function(response)
        {
            if (!response.status) {
                $('#leadViewBody').html(`
                    <div class="alert alert-danger mb-0">${response.message || 'Lead details not found.'}</div>
                `);
                return;
            }

            var d = response.data;
            var leadType = (d.lead_type || '').trim();
            var html = '';

            html += buildLeadTopSection(d);

            if (leadType === 'B2C') {
                html += buildB2CLayout(d);
            } else if (leadType === 'Meta Lead') {
                html += buildMetaLayout(d);
            } else if (leadType === 'B2B') {
                html += buildB2BLayout(d);
            } else {
                html += buildFallbackLayout(d);
            }

            $('#leadViewBody').html(html);
        },
        error: function()
        {
            $('#leadViewBody').html(`
                <div class="alert alert-danger mb-0">Failed to load lead details.</div>
            `);
        }
    });

    load_guest_accommodation_details(id);
}

function load_guest_accommodation_details(lead_id)
{
    $.ajax({
        url: "<?php echo base_url('index.php/Leads/ajax_guest_accommodation_details/'); ?>" + lead_id,
        type: "GET",
        dataType: "JSON",
        success: function(response)
        {
            if (!response.status || !response.data || response.data.length === 0) {
                $('#guestAccommodationBody').html(`
                    <div class="alert alert-warning mb-0">
                        No guest count or accommodation details found.
                    </div>
                `);
                return;
            }

            var html = `
                <div class="table-responsive">
                    <table class="table table-bordered table-hover align-middle lead-accommodation-table">
                        <thead class="table-light">
                            <tr>
                                <th>Day</th>
                                <th>Date</th>
                                <th>Accommodation Type</th>
                                <th>Destination</th>
                                <th>Adults</th>
                                <th>Child</th>
                                <th>Total</th>
                                <th>Child Age Breakup</th>
                                <th>Meal Plan</th>
                            </tr>
                        </thead>
                        <tbody>
            `;

            $.each(response.data, function(i, row) {
                html += `
                    <tr>
                        <td>
                            <strong>${escapeHtml(row.day_name || row.day_label || '-')}</strong>

                            ${row.travel_back_flag === 'TB' ? `
                                <div class="mt-1">
                                    <span class="badge bg-info">Travel Back</span>
                                </div>
                            ` : ''}

                            <div class="text-muted small">${escapeHtml(row.accommodation_day_name || '')}</div>
                        </td>
                        <td>${formatDate(row.accommodation_date)}</td>
                        <td>${getAccommodationRequiredBadge(row.accomodation_required_staus)}</td>
                        <td>${escapeHtml(row.state_name || '-')}</td>
                        <td>${escapeHtml(row.adults || '0')}</td>
                        <td>${escapeHtml(row.children || '0')}</td>
                        <td><strong>${escapeHtml(row.total_count || '0')}</strong></td>
                        <td>${escapeHtml(row.child_age_breakup || '-')}</td>
                        <td>${escapeHtml(row.meal_plan_name || '-')}</td>
                    </tr>
                `;
            });

            html += `
                        </tbody>
                    </table>
                </div>
            `;

            $('#guestAccommodationBody').html(html);
        },
        error: function()
        {
            $('#guestAccommodationBody').html(`
                <div class="alert alert-danger mb-0">
                    Failed to load guest count and accommodation details.
                </div>
            `);
        }
    });
}

function getAccommodationRequiredBadge(value)
{
    if (value === 'R') {
        return '<span class="badge bg-success">Required</span>';
    }

    if (value === 'N') {
        return '<span class="badge bg-secondary">Not Required</span>';
    }

    // if (value === 'T') {
    //     return '<span class="badge bg-info">Travel Back Required</span>';
    // }

    return '<span class="badge bg-light text-dark">-</span>';
}

function buildLeadTopSection(d)
{
    return `
        <div class="lead-summary-box">
            <div class="row align-items-center g-3">
                <div class="col-md-8">
                    <div class="lead-summary-title">${escapeHtml(d.guest_name || d.agent_name || '-')}</div>
                    <div class="lead-summary-sub">Lead No: <strong>${escapeHtml(d.leads_number || '-')}</strong></div>

                    <div class="mini-info-row">
                        <div class="mini-pill"><strong>Stage:</strong> ${cleanButtonHtml(d.stages_button)}</div>
                        <div class="mini-pill"><strong>Priority:</strong> ${cleanButtonHtml(d.priority_status_button)}</div>
                        <div class="mini-pill"><strong>Created:</strong> ${formatDateTime(d.leads_created_at)}</div>
                        <div class="mini-pill"><strong>Assigned Staff:</strong> ${escapeHtml(d.staff_name || '-')}</div>
                    </div>
                </div>

                <div class="col-md-4">
                    <div class="lead-top-badges">
                        ${getStatusChipHtml(d.lead_current_status)}
                        <span class="lead-type-badge">${escapeHtml(d.lead_type || '-')}</span>
                    </div>
                </div>
            </div>
        </div>
    `;
}

function buildB2CLayout(d)
{
    return `
        <div class="row g-3">
            <div class="col-md-6">
                ${buildLeadCard('Guest Information', [
                    ['Guest Name', d.guest_name],
                    ['Email', d.leads_email],
                    ['WhatsApp', d.whats_number],
                    ['Alternative Number', d.alternative_number],
                    ['Address', d.leads_address],
                    ['Lead Type', d.lead_type]
                ])}
            </div>

            <div class="col-md-6">
                ${buildLeadCard('Assignment & Source', [
                    ['Status', getStatusChipHtml(d.lead_current_status)],
                    ['Assigned Staff', d.staff_name],
                    ['Source', d.source_name],
                    ['Template', d.packages_title],
                    ['Country', d.country_name],
                ])}
            </div>

            <div class="col-md-6">
                ${buildLeadCard('Travel Information', [
                    ['Register Date', formatDate(d.lead_register_date)],
                    ['Date Type', d.date_type],
                    ['Travel Start Date', formatDate(d.start_date)],
                    ['End Date', formatDate(d.end_date)],
                    ['Duration', formatDuration(d.duration)],
                    ['Accommodation Status', getAccommodationStatusText(d.leads_accomodation_status,d.leads_quotation_status)]
                ])}
            </div>

            <div class="col-md-6">
                ${buildLeadCard('Created Information', [
                    ['Created Date', formatDateTime(d.leads_created_at)],
                    ['Created By User', d.created_by_admin_name],
                    ['Updated Date', formatDateTime(d.leads_updated_at)],
                    ['Updated By', d.updated_by_admin_name]
                ])}
            </div>

            <div class="col-md-12">
                ${buildDescriptionSection(d.description)}
            </div>
        </div>
    `;
}

function buildMetaLayout(d)
{
    return `
        <div class="row g-3">
            <div class="col-md-6">
                ${buildLeadCard('Guest Information', [
                    ['Guest Name', d.guest_name],
                    ['Email', d.leads_email],
                    ['WhatsApp', d.whats_number],
                    ['Alternative Number', d.alternative_number],
                    ['Address', d.leads_address],
                    ['Lead Type', d.lead_type]
                ])}
            </div>

            <div class="col-md-6">
                ${buildLeadCard('Assignment & Ads Information', [
                    ['Status', getStatusChipHtml(d.lead_current_status)],
                    ['Assigned Staff', d.staff_name],
                    ['Ads Name', d.meta_ads_setting_name],
                    ['Source', d.source_name],
                    ['Template', d.packages_title],
                    ['Country', d.country_name],
                ])}
            </div>

            <div class="col-md-6">
                ${buildLeadCard('Travel Information', [
                    ['Register Date', formatDate(d.lead_register_date)],
                    ['Date Type', d.date_type],
                    ['Travel Start Date', formatDate(d.start_date)],
                    ['End Date', formatDate(d.end_date)],
                    ['Duration', formatDuration(d.duration)],
                    ['Accommodation Status', getAccommodationStatusText(d.leads_accomodation_status,d.leads_quotation_status)]
                ])}
            </div>

            <div class="col-md-6">
                ${buildLeadCard('Created Information', [
                    ['Created Date', formatDateTime(d.leads_created_at)],
                    ['Created By User', d.created_by_admin_name],
                    ['Updated Date', formatDateTime(d.leads_updated_at)],
                    ['Updated By', d.updated_by_admin_name]
                ])}
            </div>

            <div class="col-md-12">
                ${buildDescriptionSection(d.description)}
            </div>
        </div>
    `;
}

function buildB2BLayout(d)
{
    return `
        <div class="row g-3">
            <div class="col-md-6">
                ${buildLeadCard('B2B Information', [
                    ['Agent Name', d.agent_name],
                    ['Status', getStatusChipHtml(d.lead_current_status)],
                    ['Stage', d.stages_name]
                ])}
            </div>

            <div class="col-md-6">
                ${buildLeadCard('Financial Details', [
                    ['Total Package Cost', d.total_package_cost],
                    ['Expense', d.expense],
                    ['Margin', d.margin]
                ])}
            </div>

            <div class="col-md-6">
                ${buildLeadCard('Created Information', [
                    ['Created Date', formatDateTime(d.leads_created_at)],
                    ['Created By User', d.created_by_admin_name],
                    ['Updated Date', formatDateTime(d.leads_updated_at)],
                    ['Updated By', d.updated_by_admin_name]
                ])}
            </div>

            <div class="col-md-12">
                ${buildDescriptionSection(d.description)}
            </div>
        </div>
    `;
}

function buildFallbackLayout(d)
{
    return `
        <div class="row g-3">
            <div class="col-md-6">
                ${buildLeadCard('Lead Information', [
                    ['Guest Name', d.guest_name],
                    ['Lead No', d.leads_number],
                    ['Lead Type', d.lead_type],
                    ['Status', getStatusChipHtml(d.lead_current_status)],
                    ['Stage', cleanButtonHtml(d.stages_button)],
                    ['Priority', cleanButtonHtml(d.priority_status_button)],
                ])}
            </div>

            <div class="col-md-6">
                ${buildLeadCard('Created Information', [
                    ['Created Date', formatDateTime(d.leads_created_at)],
                    ['Created By User', d.created_by_admin_name],
                    ['Updated Date', formatDateTime(d.leads_updated_at)],
                    ['Updated By', d.updated_by_admin_name]
                ])}
            </div>

            <div class="col-md-12">
                ${buildDescriptionSection(d.description)}
            </div>
        </div>
    `;
}


function buildLeadCard(title, rows)
{
    var rowsHtml = '';

    for (var i = 0; i < rows.length; i++) {

        let value = rows[i][1];

        // allow html for stage & priority
        if (typeof value === 'string' && value.includes('<span')) {
            value = cleanButtonHtml(value);
        } else {
            value = normalizeValue(value);
        }

        rowsHtml += `
            <div class="lead-detail-row">
                <div class="lead-detail-label">${escapeHtml(rows[i][0])}</div>
                <div class="lead-detail-value">${value}</div>
            </div>
        `;
    }

    return `
        <div class="lead-card">
            <div class="lead-card-header">${escapeHtml(title)}</div>
            <div class="lead-card-body">
                ${rowsHtml}
            </div>
        </div>
    `;
}

function buildDescriptionSection(description)
{
    return `
        <div class="lead-card">
            <div class="lead-card-header">Description</div>
            <div class="lead-card-body">
                <div class="lead-description-box">${escapeHtml(description || '-')}</div>
            </div>
        </div>
    `;
}

function normalizeValue(value)
{
    if (value === null || value === undefined || value === '') {
        return '-';
    }
    return value;
}


function formatDate(dateStr)
{
    if (!dateStr || dateStr === '0000-00-00') return '-';

    var parts = dateStr.split('-');
    if (parts.length !== 3) return dateStr;

    return parts[2] + '/' + parts[1] + '/' + parts[0];
}

function formatDuration(dur)
{
    var n = parseInt(dur, 10);
    if (isNaN(n) || n <= 0) return '-';
    var nights = n - 1;
    return nights + ' Night' + (nights !== 1 ? 's' : '') + ' ' + n + ' Day' + (n !== 1 ? 's' : '');
}

function formatDateTime(dateTimeStr)
{
    if (!dateTimeStr || dateTimeStr === '0000-00-00 00:00:00') return '-';

    var parts = dateTimeStr.split(' ');
    if (parts.length !== 2) return dateTimeStr;

    var dateParts = parts[0].split('-');
    if (dateParts.length !== 3) return dateTimeStr;

    return dateParts[2] + '/' + dateParts[1] + '/' + dateParts[0] + ' ' + parts[1];
}

// function getAccommodationStatusText(val)
// {
//     return parseInt(val, 10) === 1 ? 'Completed' : 'Pending';
// }

function getAccommodationStatusText(accStatus, quotationStatus)
{
    accStatus = parseInt(accStatus);
    quotationStatus = parseInt(quotationStatus);

    if (accStatus === 0) {
        return '<span class="badge badge-xs badge-primary">Guest Count Required</span>';
    }

    if (accStatus === 1) {
        return '<span class="badge badge-xs badge-warning">Accommodation Required</span>';
    }

    if (accStatus === 2 && quotationStatus === 0) {
        return '<span class="badge badge-xs badge-info">Quotation Not Created</span>';
    }

    if (accStatus === 2 && quotationStatus === 1) {
        return '<span class="badge badge-xs badge-success">Quotation Created</span>';
    }

    if (accStatus === 2 && quotationStatus === 2) {
        return '<span class="badge badge-xs badge-danger">Cancelled / Quotation Not Created</span>';
    }

    return '<span class="badge badge-xs badge-secondary">Unknown</span>';
}

function getLeadCurrentStatusText(val)
{
    val = parseInt(val, 10);

    if (val === 1) return 'In take';
    if (val === 2) return 'Qualified';
    if (val === 3) return 'Converted to trip';
    if (val === 4) return 'Not Qualified';
    if (val === 5) return 'Lost';

    return '-';
}

function getStatusChipHtml(statusValue)
{
    var text = getLeadCurrentStatusText(statusValue);
    var cls = 'status-intake';

    if (text === 'Qualified') cls = 'status-qualified';
    else if (text === 'Converted to trip') cls = 'status-converted';
    else if (text === 'Not Qualified') cls = 'status-notqualified';
    else if (text === 'Lost') cls = 'status-lost';

    return `<span class="status-chip ${cls}">${escapeHtml(text)}</span>`;
}

function escapeHtml(str)
{
    if (str === null || str === undefined) return '';
    return String(str)
        .replace(/&/g, '&amp;')
        .replace(/</g, '&lt;')
        .replace(/>/g, '&gt;')
        .replace(/"/g, '&quot;')
        .replace(/'/g, '&#039;');
}

function cleanButtonHtml(html)
{
    if (!html) return '-';

    return html
        .replace(/<center>/gi, '')
        .replace(/<\/center>/gi, '')
        .trim();
}
////***For Leads view *****///

////***For close the modal *****///
function Leadsmodalclose()
{

    $('#LeadsModal').modal('hide');
     $('#form')[0].reset();
    $('#form').removeClass('was-validated');
    //$( "div" ).remove( ".modal-backdrop" );
    $('#staff_id_fk1').val('');
    $('#guest_name1').val('');
    $('#source_id_fk').val('').change();
    // $('#vehicle_id_fk').val('0').change();
    $('#category_name_alert').hide();
    $('.submit').removeAttr('disabled');
    $('.form-group').removeClass('input-success-o');
    $('.form-group').removeClass('input-warning-o');
    $('.staff_id_fk1').removeClass('input-success-o');
    $('.staff_id_fk1').removeClass('input-warning-o');
    $('.guest_name1').removeClass('input-success-o');
    $('.guest_name1').removeClass('input-warning-o');
    // $('#btnSave').removeAttr('disabled');
}
////***For close the modal *****///

////***For open the modal *****///
$('#LeadsModal').on('shown.bs.modal', function () {
    // $("#state_id_fk").select2('open');
    // $('#transporter_name').focus();
    var id = $("#id").val();
    if(id == '')
    { 
        $('#properties_id_fk').val('').change();
        // $('#vehicle_id_fk').val('0').change();
    }
    $('#category_name_alert').hide();
    // $(".submit").attr("disabled", "disabled");
    $('.form-group').removeClass('input-success-o');
    $('.form-group').removeClass('input-warning-o');
    $('.properties_id_fk').removeClass('input-success-o');
    $('.properties_id_fk').removeClass('input-warning-o');
    $('.room_tariff_hike_from_date').removeClass('input-success-o');
    $('.room_tariff_hike_from_date').removeClass('input-warning-o');
    
})
////***For open the modal *****///
    
////***For open modal of leads adding form  *****///
    
// function add_leads()
// { 
//     save_method = 'add';package_msg
//     $("#id").val('');
//     $('#form')[0].reset(); // reset form on modals
//     $('#form').removeClass('was-validated');
//     //  resetSelect2Validation();
//     $('.form-group').removeClass('input-warning-o'); // clear error class
//     $('.help-block').empty(); // clear error string
//     $('#LeadsModal').modal('show'); // show bootstrap modal
//     $('.modal-title').text('Add leads Details'); // Set Title to Bootstrap modal title
//     $('#country_id_fk').val('99').trigger('change.select2');
//     $('#staff_id_fk1').val('').trigger('change.select2');
//     $('#source_id_fk1').val('').trigger('change.select2');
//     $('#priority_status_id_fk').val('').trigger('change.select2');
//     $('#package_id_fk').val('').trigger('change.select2');
//     $('#date_type').val('').trigger('change.select2');
//      $('#leads_package_category_id_fk').val('').trigger('change.select2');
//     $('#package_created_by_staff_id').val('').trigger('change.select2');
//     $('[name="lead_type_txt"]').html('B2C');
//     $('[name="lead_type"]').val('B2C');
    
//     $('#btnSave').text('save');
    
// }

function add_leads()
{ 
    save_method = 'add';

    $("#id").val('');
    $('#form')[0].reset();
    $('#form').removeClass('was-validated');
    $('#form').find('.is-valid, .is-invalid').removeClass('is-valid is-invalid');
    $('#LeadsModal').find('.select2-container').removeClass('is-valid is-invalid');

    $('.form-group').removeClass('input-warning-o input-success-o');
    $('.help-block').empty();

    // clear Select2 fields
    $('#country_id_fk').val('99').trigger('change.select2');
    $('#staff_id_fk1').val('').trigger('change.select2');
    $('#source_id_fk1').val('').trigger('change.select2');
    $('#priority_status_id_fk').val('').trigger('change.select2');
    $('#date_type').val('').trigger('change.select2');
    $('#leads_package_category_id_fk').val('').trigger('change.select2');
    $('#package_created_by_staff_id').val('').trigger('change.select2');

    // clear package dropdown + message
    $('#package_id_fk')
        .html('<option value="">Please Select Template</option>')
        .val('')
        .prop('disabled', true)
        .trigger('change.select2');

    $('#package_msg')
        .addClass('d-none')
        .text('');

    // clear end date hidden + display
    $('#end_date1').val('');
    $('#end_date_text')
        .addClass('d-none')
        .text('');

    packageHasProperties = false;

    $('#package_properties_msg')
        .addClass('d-none')
        .text('');

    previous_saved_package_id = '';
allowPackageRollback = false;

$('#package_change_msg')
    .addClass('d-none')
    .text('');
    // clear date/duration fields
    $('#start_date1').val('');
    $('#duration').val('');

    $('[name="lead_type_txt"]').html('B2C');
    $('[name="lead_type"]').val('B2C');

    $('#btnSave').text('Save');
    $('.modal-title').text('Add leads Details');

    $('#LeadsModal').modal('show');
}
////***For open modal of leads adding form  *****///

////***For editing room leads details from adding modal form  *****///

// function edit_leads(id)
// {
//     var num_2 = 1;
//     save_method = 'update';
//     $('#form')[0].reset(); // reset form on modals
//     $('.form-group').removeClass('input-warning-o'); // clear error class
//     $('.help-block').empty(); // clear error string

//     //Ajax Load data from ajax
//     $.ajax({
//         url : "<?php echo base_url();?>index.php/Leads/ajax_edit/" + id,
//         type: "GET",
//         dataType: "JSON",
//         success: function(data)
//         {
//          // .trigger('change.select2')
            
//             $('[name="id"]').val(data.leads_id);
//             $('[name="lead_type"]').val(data.lead_type);
//             $('[name="staff_id_fk"]').val(data.staff_id_fk);
//             $('[name="source_id_fk"]').val(data.source_id_fk).trigger('change.select2');
//             $('[name="guest_name"]').val(data.guest_name);
//             $('[name="agent_id_fk"]').val(data.agent_id_fk);  
//             $('[name="total_package_cost"]').val(data.total_package_cost); 
//             $('[name="expense"]').val(data.expense);
//             $('[name="country_id_fk"]').val(data.country_id_fk).trigger('change.select2');
//             $('[name="priority_status_id_fk"]').val(data.priority_status_id_fk).trigger('change.select2');
//             $('[name="stage_id_fk"]').val(data.stage_id_fk);
//             $('[name="agent_id_fk"]').val(data.agent_id_fk);
//             $('[name="lead_type"]').val(data.lead_type);
//             $('[name="guest_name"]').val(data.guest_name);
//             $('[name="date_type"]').val(data.date_type).trigger('change.select2');
//             $('[name="start_date"]').val(data.start_date);
//             $('[name="end_date"]').val(data.end_date);
//             $('[name="duration"]').val(data.duration);
//             $('[name="package_id_fk"]').val(data.date_type).trigger('change.select2');
//             $('[name="whats_number"]').val(data.whats_number);
//             $('[name="alternative_number"]').val(data.alternative_number);
//             $('[name="total_package_cost"]').val(data.total_package_cost);
//             $('[name="expense"]').val(data.expense);
//             $('[name="margin"]').val(data.margin);
//             $('[name="description"]').val(data.description);
                 
//             $('#LeadsModal').modal('show'); // show bootstrap modal when complete loaded
//             $('.modal-title').text('Edit leads Details'); // Set title to Bootstrap modal title
//             $('#btnSave').text('update');

//         },
//         error: function (jqXHR, textStatus, errorThrown)
//         {
//             alert('Error get data from ajax');
//         }
//     });
// }

var edit_package_id = null;
var previous_saved_package_id = '';
var previous_start_date = '';
var previous_duration = '';
var previous_end_date = '';
var allowRollback = false;
var allowPackageRollback = false;

function edit_leads(id)
{
    save_method = 'update';

    $('#form')[0].reset();
    $('#form').removeClass('was-validated');
    $('#form').find('.is-valid, .is-invalid').removeClass('is-valid is-invalid');
    $('#LeadsModal').find('.select2-container').removeClass('is-valid is-invalid');
    $('.form-group').removeClass('input-warning-o');
    $('.help-block').empty();

     // âœ… RESET ALL VALIDATION STATES
    packageHasProperties = false;
    previous_saved_package_id = '';
    allowPackageRollback = false;

    // âœ… HIDE MESSAGES
    $('#package_properties_msg')
        .addClass('d-none')
        .text('');

    $('#package_change_msg')
        .addClass('d-none')
        .text('');

    $('#package_msg')
        .addClass('d-none')
        .text('');

    // âœ… CLEAR END DATE DISPLAY
    $('#end_date1').val('');
    $('#end_date_text')
        .addClass('d-none')
        .text('');

    $.ajax({
        url: "<?php echo base_url();?>index.php/Leads/ajax_edit/" + id,
        type: "GET",
        dataType: "JSON",
        success: function(data)
        {
            $('[name="id"]').val(data.leads_id);
            $('[name="lead_type_txt"]').html(data.lead_type);
            $('[name="lead_type"]').val(data.lead_type);

            function setAjaxSelect2Val(selector, id, text) {
                if (id) {
                    var opt = new Option(text, id, true, true);
                    $(selector).append(opt).trigger('change');
                } else {
                    $(selector).val(null).trigger('change');
                }
            }

            setAjaxSelect2Val('#staff_id_fk1',            data.staff_id_fk,           data.staff_name || '');
            setAjaxSelect2Val('#source_id_fk1',           data.source_id_fk,          data.source_name || '');
            setAjaxSelect2Val('#country_id_fk',           data.country_id_fk,         data.country_name || '');
            setAjaxSelect2Val('#priority_status_id_fk',   data.priority_status_id_fk, data.priority_status_name || '');
            setAjaxSelect2Val('#package_created_by_staff_id', data.package_created_by_staff_id, data.package_created_by_staff_name || '');
            setAjaxSelect2Val('#leads_package_category_id_fk', data.leads_package_category_id_fk, data.package_category_name || '');

            $('[name="guest_name"]').val(data.guest_name);
            $('[name="agent_id_fk"]').val(data.agent_id_fk);
            $('[name="stage_id_fk"]').val(data.stage_id_fk);
            $('[name="date_type"]').val(data.date_type).trigger('change.select2');

            // $('[name="start_date"]').val(data.start_date);
            // $('[name="end_date"]').val(data.end_date);

            // Existing
$('[name="start_date"]').val(data.start_date);
$('[name="end_date"]').val(data.end_date);
$('[name="duration"]').val(data.duration);

// âœ… Show end date if exists
if (data.date_type === 'WITH' && data.end_date) {

    let parts = data.end_date.split('-'); // YYYY-MM-DD

    let displayDate =
        parts[2] + '/' + parts[1] + '/' + parts[0]; // DD/MM/YYYY

    $('#end_date_text')
        .removeClass('d-none')
        .text('Travel end date: ' + displayDate);

} else {
    $('#end_date_text')
        .addClass('d-none')
        .text('');
}

            $('[name="whats_number"]').val(data.whats_number);
            $('[name="alternative_number"]').val(data.alternative_number);

            $('[name="total_package_cost"]').val(data.total_package_cost);
            $('[name="expense"]').val(data.expense);
            $('[name="margin"]').val(data.margin);

            $('[name="description"]').val(data.description);

        

// $('[name="duration"]').val(data.duration);

// var selectedPackageId = data.package_id_fk ? String(data.package_id_fk) : '';

// isEditModeLoading = true;

// $('#LeadsModal').modal('show');

// setTimeout(function () {
//     loadPackagesByDuration(parseInt(data.duration, 10), selectedPackageId);
//     isEditModeLoading = false;
// }, 500);

// $('[name="duration"]').val(data.duration || '');

// var categoryId  = data.leads_package_category_id_fk ? String(data.leads_package_category_id_fk) : '';
// var createdById = data.package_created_by_staff_id ? String(data.package_created_by_staff_id) : '';
// var packageId   = data.package_id_fk ? String(data.package_id_fk) : '';

// $('[name="leads_package_category_id_fk"]')
//     .val(categoryId)
//     .trigger('change.select2');

// $('[name="package_created_by_staff_id"]')
//     .val(createdById)
//     .trigger('change.select2');

// isEditModeLoading = true;


$('[name="duration"]').val(data.duration);

var categoryId  = data.leads_package_category_id_fk ? String(data.leads_package_category_id_fk) : '';
var createdById = data.package_created_by_staff_id ? String(data.package_created_by_staff_id) : '';
var packageId   = data.package_id_fk ? String(data.package_id_fk) : '';

// previous_saved_package_id = data.package_id_fk ? String(data.package_id_fk) : '';
previous_start_date = data.start_date ? String(data.start_date) : '';
previous_duration = data.duration ? String(data.duration) : '';
previous_end_date = data.end_date ? String(data.end_date) : '';

previous_saved_package_id = packageId;
// previous_saved_package_id = data.package_id_fk ? String(data.package_id_fk) : '';
$('[name="leads_package_category_id_fk"]')
    .val(categoryId)
    .trigger('change.select2');

$('[name="package_created_by_staff_id"]')
    .val(createdById)
    .trigger('change.select2');

isEditModeLoading = true;


$('#LeadsModal').modal('show');

setTimeout(function () {
    if (packageId !== '') {
        loadPackagesByFilter(packageId);
    } else {
        emptyPackageDropdown('');
    }

    isEditModeLoading = false;
}, 500);
            $('.modal-title').text('Edit Leads Details');
            $('#btnSave').text('Update');
        },
        error: function ()
        {
            alert('Error getting data from ajax');
        }
    });
}
////***For editing leads details from adding modal form  *****///

////***For close B2B the modal *****///
function Leadsb2bmodalclose()
{

    $('#LeadsB2BModal').modal('hide');
     $('#form3')[0].reset();
    $('#form3').removeClass('was-validated');

    $('#agent_id_fk').val('').change();
    // $('#vehicle_id_fk').val('0').change();
    $('#category_name_alert').hide();
    $('.submit').removeAttr('disabled');
    $('.form-group').removeClass('input-success-o');
    $('.form-group').removeClass('input-warning-o');
    $('.agent_id_fk').removeClass('input-success-o');
    $('.agent_id_fk').removeClass('input-warning-o');
    
    // $('#btnSave').removeAttr('disabled');
}
////***For close B2B the modal *****///

////***For open B2b the modal *****///
$('#LeadsB2BModal').on('shown.bs.modal', function () {

    $('#category_name_alert').hide();
    // $(".submit").attr("disabled", "disabled");
    $('.form-group').removeClass('input-success-o');
    $('.form-group').removeClass('input-warning-o');
    // $('.properties_id_fk').removeClass('input-success-o');
    // $('.properties_id_fk').removeClass('input-warning-o');
    // $('.room_tariff_hike_from_date').removeClass('input-success-o');
    // $('.room_tariff_hike_from_date').removeClass('input-warning-o');
})
////***For open B2b the modal *****///
    
////***For open modal of leads adding form  *****///
    
function add_b2bleads()
{ 
    save_method = 'add';
    $("#id3").val('');
    $('#form3')[0].reset(); // reset form on modals
    $('#form3').removeClass('was-validated');
    //  resetSelect2Validation();
    $('.form-group').removeClass('input-warning-o'); // clear error class
    $('.help-block').empty(); // clear error string
    $('#LeadsB2BModal').modal('show'); // show bootstrap modal
    $('.modal-title').text('Add B2B leads Details'); // Set Title to Bootstrap modal title
    $('#agent_id_fk').val('').trigger('change.select2');
    $('[name="lead_type_txt_b2b"]').html('B2B');
    $('[name="lead_type_b2b"]').val('B2B');
    $('#btnSave3').text('save');
    
}

////***For open modal of b2b leads adding form  *****///

////***For editing b2b leads details from adding modal form  *****///

function edit_b2bleads(id)
{
    var num_2 = 1;
    save_method = 'update';
    $('#form3')[0].reset(); // reset form on modals
    $('.form-group').removeClass('input-warning-o'); // clear error class
    $('.help-block').empty(); // clear error string

    //Ajax Load data from ajax
    $.ajax({
        url : "<?php echo base_url();?>index.php/Leads/ajax_edit/" + id,
        type: "GET",
        dataType: "JSON",
        success: function(data)
        {
         // .trigger('change.select2')
            
            $('[id="id3"]').val(data.leads_id);
            $('[name="lead_type_txt_b2b"]').html(data.lead_type);
            $('[name="lead_type_b2b"]').val(data.lead_type);
            $('[name="agent_id_fk"]').val(data.agent_id_fk).trigger('change.select2');
            $('[name="total_package_cost"]').val(data.total_package_cost); 
            $('[name="expense"]').val(data.expense);
            $('[name="margin"]').val(data.margin);
            $('[name="description"]').val(data.description);
                 
            $('#LeadsB2BModal').modal('show'); // show bootstrap modal when complete loaded
            $('.modal-title').text('Edit B2B leads Details'); // Set title to Bootstrap modal title
            $('#btnSave3').text('update');

        },
        error: function (jqXHR, textStatus, errorThrown)
        {
            alert('Error get data from ajax');
        }
    });
}


////***For editing B2B leads details from adding modal form  *****///

////***For reload the datatable  *****///
function reload_table_guset_count()
{

    $table.ajax.reload(null,false); //reload datatable ajax 
    var id = $("#id").val();
    if(id)
    {  

        swal("Guest count updated successfully", "", "success")
        // var ff = 0;
        
        // ff = "Room tariff details updated successfully";

        //  $("#vehicle_update").val(ff);
        
         
        //  var options = {

        // 'title': '',

        // 'style': 'success',

        // 'message': ff,

        // // 'success': 'warning',
        // 'icon': 'fas fa-check',

        // };
        
        // var n1 = new notify(options); 

        // n1.show(); 

        // setTimeout(function(){ n1.hide(); }, 10000);
    }
    else{
        
        swal("Guest count added successfully", "", "success")

        // var ff = 0;
        
        // ff = "Transporter details added successfully";

        //  $("#vehicle_add").val(ff);
        
         
        //  var options = {

        // 'title': '',

        // 'style': 'success',

        // 'message': ff,

        // // 'success': 'warning',
        // 'icon': 'fas fa-check',

        // };
        
        // var n1 = new notify(options); 

        // n1.show(); 

        // setTimeout(function(){ n1.hide(); }, 10000);
    }
}
function reload_table()
{
    $table1.ajax.reload(null,false); //reload datatable ajax 
    var id = $("#id").val();
    if(id)
    {  

        swal("Leads details updated successfully", "", "success")
        // var ff = 0;
        
        // ff = "Room tariff details updated successfully";

        //  $("#vehicle_update").val(ff);
        
         
        //  var options = {

        // 'title': '',

        // 'style': 'success',

        // 'message': ff,

        // // 'success': 'warning',
        // 'icon': 'fas fa-check',

        // };
        
        // var n1 = new notify(options); 

        // n1.show(); 

        // setTimeout(function(){ n1.hide(); }, 10000);
    }
    else{
        
        swal("Leads details added successfully", "", "success")

        // var ff = 0;
        
        // ff = "Transporter details added successfully";

        //  $("#vehicle_add").val(ff);
        
         
        //  var options = {

        // 'title': '',

        // 'style': 'success',

        // 'message': ff,

        // // 'success': 'warning',
        // 'icon': 'fas fa-check',

        // };
        
        // var n1 = new notify(options); 

        // n1.show(); 

        // setTimeout(function(){ n1.hide(); }, 10000);
    }
    
    
}

function reload_table_meta()
{
    $table2.ajax.reload(null,false); //reload datatable ajax 
    var id = $("#id").val();
    if(id)
    {  

        swal("Leads details updated successfully", "", "success")
        // var ff = 0;
        
        // ff = "Room tariff details updated successfully";

        //  $("#vehicle_update").val(ff);
        
         
        //  var options = {

        // 'title': '',

        // 'style': 'success',

        // 'message': ff,

        // // 'success': 'warning',
        // 'icon': 'fas fa-check',

        // };
        
        // var n1 = new notify(options); 

        // n1.show(); 

        // setTimeout(function(){ n1.hide(); }, 10000);
    }
    else{
        
        swal("Leads details added successfully", "", "success")

        // var ff = 0;
        
        // ff = "Transporter details added successfully";

        //  $("#vehicle_add").val(ff);
        
         
        //  var options = {

        // 'title': '',

        // 'style': 'success',

        // 'message': ff,

        // // 'success': 'warning',
        // 'icon': 'fas fa-check',

        // };
        
        // var n1 = new notify(options); 

        // n1.show(); 

        // setTimeout(function(){ n1.hide(); }, 10000);
    }
    
    
}

function reload_table_b2b()
{
    $table3.ajax.reload(null,false); //reload datatable ajax 
    var id = $("#id3").val();
    if(id)
    {  

        swal("Leads B2B details updated successfully", "", "success")
        // var ff = 0;
        
        // ff = "Room tariff details updated successfully";

        //  $("#vehicle_update").val(ff);
        
         
        //  var options = {

        // 'title': '',

        // 'style': 'success',

        // 'message': ff,

        // // 'success': 'warning',
        // 'icon': 'fas fa-check',

        // };
        
        // var n1 = new notify(options); 

        // n1.show(); 

        // setTimeout(function(){ n1.hide(); }, 10000);
    }
    else{
        
        swal("Leads B2B details added successfully", "", "success")

        // var ff = 0;
        
        // ff = "Transporter details added successfully";

        //  $("#vehicle_add").val(ff);
        
         
        //  var options = {

        // 'title': '',

        // 'style': 'success',

        // 'message': ff,

        // // 'success': 'warning',
        // 'icon': 'fas fa-check',

        // };
        
        // var n1 = new notify(options); 

        // n1.show(); 

        // setTimeout(function(){ n1.hide(); }, 10000);
    }
    
    
}

function reload_table_guest_count_b2c()
{
    $table1.ajax.reload(null,false); //reload datatable ajax 
    var id = $("#guset_count_id").val();
    if(id)
    {  

        swal("Guest count details updated successfully", "", "success")
        
    }
    else{
        
        swal("Guest count details added successfully", "", "success")

        
    }
    
    
}

function reload_table_guest_count_meta()
{
    $table2.ajax.reload(null,false); //reload datatable ajax 
    var id = $("#guset_count_id").val();
    if(id)
    {  

        swal("Guest count details updated successfully", "", "success")
        
    }
    else{
        
        swal("Guest count details added successfully", "", "success")

        
    }
    
    
}

function reload_table_accomodation_b2c()
{
    $table1.ajax.reload(null,false); //reload datatable ajax 
    var id = $("#accommodation_plan_guset_count_id_fk").val();
    if(id)
    {  

        swal("Accommodation details updated successfully", "", "success")
        
    }
    else{
        
        swal("Accommodation details added successfully", "", "success")

        
    }
    
    
}

function reload_table_accomodation_meta()
{
    $table2.ajax.reload(null,false); //reload datatable ajax 
    var id = $("#accommodation_plan_guset_count_id_fk").val();
    if(id)
    {  

        swal("Accommodation details updated successfully", "", "success")
        
    }
    else{
        
        swal("Accommodation details added successfully", "", "success")

        
    }
    
    
}

////***For reload the datatable  *****///

///***For save the leads details from adding modal form *****///

function validateSelect2(select) {
    let val = $(select).val();
    let container = $(select).next('.select2-container'); // get the Select2 UI
// alert(val);
    // if(val === "" || val === null) {
    if(val === null || val === "" || (Array.isArray(val) && val.length === 0)) {
        // alert("k");
        container.addClass('is-invalid').removeClass('is-valid');
        return false;
    } else {
        // alert("d");
        container.addClass('is-valid').removeClass('is-invalid');
        return true;
    }
}




function resetValidation() {
    $('#form')[0].reset();
    $('#form').removeClass('was-validated');
    $('.select2-container').removeClass('is-valid is-invalid');
    $('input, textarea').removeClass('is-valid is-invalid');
}

// On modal show
// $('#LeadsModal').on('show.bs.modal', resetValidation);

// Optional: validate on change
$('.lst-flt-select2-form').on('change', function() {
    validateSelect2(this);
});

const B2C_FIELDS = [
    'staff_id_fk',
    'source_id_fk',
    'guest_name',
    'country_id_fk',
    'priority_status_id_fk',
    'whats_number',
    'date_type',
    // 'start_date',
    // 'duration',
    // 'package_id_fk'
];

const B2B_FIELDS = [
    'agent_id_fk',
    'total_package_cost',
    'expense',
    'margin'
];

function validateInput(name) {
    let el = $('[name="' + name + '"]');
    let val = el.val();

    if (!val) {
        el.addClass('is-invalid').removeClass('is-valid');
        return false;
    }

    el.addClass('is-valid').removeClass('is-invalid');
    return true;
}


function validateSelect2ByName(name) {
    let el = $('[name="' + name + '"]');
    return validateSelect2(el);
}
// function save() {

//     let leadType = $('[name="lead_type"]').val();
//     let allValid = true;

//     // Clear previous validation
//     $('.is-valid, .is-invalid').removeClass('is-valid is-invalid');

//     // Decide fields to validate
//     let fieldsToValidate = [];

//     // if (leadType === 'B2C') {
//         fieldsToValidate = B2C_FIELDS;
//     // } else if (leadType === 'B2B') {
//     //     fieldsToValidate = B2B_FIELDS;
//     // }

//     // Validate selected fields only
//     fieldsToValidate.forEach(name => {
//         let el = $('[name="' + name + '"]');

//         if (el.hasClass('lst-flt-select2-form')) {
//             if (!validateSelect2ByName(name)) allValid = false;
//         } else {
//             if (!validateInput(name)) allValid = false;
//         }
//     });

//     if (!allValid) return; // ðŸš« stop submit

//     // âœ… proceed with save
//     $('#btnSave').text('saving...').attr('disabled', true);

//     let form = document.getElementById('form');
//     let data = new FormData(form);
//     let url = save_method === 'add'
//         ? "<?php echo base_url();?>index.php/Leads/ajax_add1/"
//         : "<?php echo base_url();?>index.php/Leads/ajax_update1/";

//     $.ajax({
//         url: url,
//         type: "POST",
//         data: data,
//         dataType: "JSON",
//         processData: false,
//         contentType: false,
//         success: function (data) {
//             if (data.status) {
//                 $('#LeadsModal').modal('hide');

//                 var leadtype = $('[name="lead_type"]').val();
//                 if(leadtype == 'B2C'){
//                   reload_table();
//                 }else{
//                   reload_table_meta();
//                 }
                

                
//             }
//             $('#btnSave').text('save').attr('disabled', false);
//         },
//         error: function () {
//             alert('Error saving data!');
//             $('#btnSave').text('save').attr('disabled', false);
//         }
//     });
// }

function save() {

    let leadType = $('[name="lead_type"]').val();
    let allValid = true;

    $('.is-valid, .is-invalid').removeClass('is-valid is-invalid');

    let fieldsToValidate = [];
    fieldsToValidate = B2C_FIELDS;

    fieldsToValidate.forEach(name => {
        let el = $('[name="' + name + '"]');

        if (el.hasClass('lst-flt-select2-form')) {
            if (!validateSelect2ByName(name)) allValid = false;
        } else {
            if (!validateInput(name)) allValid = false;
        }
    });



let dateType = $('#date_type').val();

if (dateType === 'WITH') {

    if (!validateInput('start_date')) {
        allValid = false;
    }

    if (!validateInput('duration')) {
        allValid = false;
    }
}

var packageId = $('#package_id_fk').val();

// Skip properties check during update if package hasn't changed
var packageChanged = packageId !== previous_saved_package_id;

if (packageId && packageChanged && packageHasProperties === false) {
    $('#package_properties_msg')
        .removeClass('d-none')
        .text('Selected template does not have properties saved. Please update properties.');

    return;
}

if (save_method === 'update') {

    var leadId = $('#id').val();
    var selectedPackageId = $('#package_id_fk').val();

    if (
        leadId &&
        previous_saved_package_id &&
        selectedPackageId !== previous_saved_package_id
    ) {
        $.ajax({
            url: "<?php echo base_url('index.php/Leads/check_lead_active_quotation'); ?>",
            type: "POST",
            dataType: "json",
            async: false,
            data: {
                lead_id: leadId
            },
            success: function (res) {
                if (res.status && res.has_active_quotation) {

                    $('#package_change_msg')
                        .removeClass('d-none')
                        .text('Other templates could not select already quotation is created using this template.');

                    $('#package_id_fk')
                        .val(previous_saved_package_id)
                        .trigger('change.select2');

                    allValid = false;
                }
            },
            error: function () {
                $('#package_change_msg')
                    .removeClass('d-none')
                    .text('Unable to validate quotation. Please try again.');

                allValid = false;
            }
        });
    }
}

if (save_method === 'update') {

    var startChanged = $('#start_date1').val() !== previous_start_date;
    var durationChanged = $('#duration').val() !== previous_duration;
    var packageChanged = $('#package_id_fk').val() !== previous_saved_package_id;

    if (startChanged || durationChanged || packageChanged) {

        $.ajax({
            url: "<?php echo base_url('index.php/Leads/check_lead_active_quotation'); ?>",
            type: "POST",
            dataType: "json",
            async: false,
            data: { lead_id: $('#id').val() },
            success: function(res) {
                if (res.status && res.has_active_quotation) {

                    allowRollback = true;

                    $('#package_id_fk').val(previous_saved_package_id).trigger('change.select2');
                    $('#start_date1').val(previous_start_date);
                    $('#duration').val(previous_duration);
                    $('#end_date1').val(previous_end_date);
                    showEditEndDate(previous_end_date);

                    allowRollback = false;

                    Swal.fire({
                        icon: 'warning',
                        title: 'Cannot Update',
                        text: 'Template, travel date, and duration cannot be changed because a quotation is already created.'
                    });

                    allValid = false;
                }
            }
        });
    }
}
    if (!allValid) return;

    $('#btnSave').text('saving...').attr('disabled', true);

    let form = document.getElementById('form');
    let data = new FormData(form);
    let isAdd = (save_method === 'add');

    let url = isAdd
        ? "<?php echo base_url();?>index.php/Leads/ajax_add1/"
        : "<?php echo base_url();?>index.php/Leads/ajax_update1/";

    $.ajax({
        url: url,
        type: "POST",
        data: data,
        dataType: "JSON",
        processData: false,
        contentType: false,
        success: function (data) {

            if (data.status) {
                $('#LeadsModal').modal('hide');

                var leadtype = $('[name="lead_type"]').val();
                if (leadtype == 'B2C') {
                    reload_table();
                } else {
                    reload_table_meta();
                }

                // after new lead save, open guest count modal only if travel/template details exist
                if (isAdd && data.lead_id) {
                    checkLeadTravelDetails(data.lead_id, function () {
                        guset_count(data.lead_id);
                    });
                }

                // If accommodation was reset due to travel details change, open accommodation modal directly
                if (!isAdd && data.accommodation_reset) {
                    setTimeout(function() {
                        Swal.fire({
                            icon: 'info',
                            title: 'Accommodation Required',
                            text: 'Travel date, duration, or template has been changed. Please set accommodation again.',
                            showCancelButton: true,
                            confirmButtonText: 'Set Accommodation',
                            cancelButtonText: 'Later',
                            allowOutsideClick: false,
                            allowEscapeKey: false
                        }).then(function(result) {
                            if (result.value === true || result.isConfirmed === true) {
                                accomodation_plan(data.lead_id);
                            }
                        });
                    }, 300);
                }
            }

            $('#btnSave').text('save').attr('disabled', false);
        },
        error: function () {
            alert('Error saving data!');
            $('#btnSave').text('save').attr('disabled', false);
        }
    });
}

function save_b2b() {

    let leadType = $('[name="lead_type"]').val();
    let allValid = true;

    // Clear previous validation
    $('.is-valid, .is-invalid').removeClass('is-valid is-invalid');

    // Decide fields to validate
    let fieldsToValidate = [];

    // if (leadType === 'B2C') {
        fieldsToValidate = B2B_FIELDS;
    // } else if (leadType === 'B2B') {
    //     fieldsToValidate = B2B_FIELDS;
    // }

    // Validate selected fields only
    fieldsToValidate.forEach(name => {
        let el = $('[name="' + name + '"]');

        if (el.hasClass('lst-flt-select2-form')) {
            if (!validateSelect2ByName(name)) allValid = false;
        } else {
            if (!validateInput(name)) allValid = false;
        }
    });

    if (!allValid) return; // ðŸš« stop submit

    // âœ… proceed with save
    $('#btnSave3').text('saving...').attr('disabled', true);

    let form = document.getElementById('form3');
    let data = new FormData(form);
    let url = save_method === 'add'
        ? "<?php echo base_url();?>index.php/Leads/ajax_add2/"
        : "<?php echo base_url();?>index.php/Leads/ajax_update2/";

    $.ajax({
        url: url,
        type: "POST",
        data: data,
        dataType: "JSON",
        processData: false,
        contentType: false,
        success: function (data) {
            if (data.status) {
                $('#LeadsB2BModal').modal('hide');

              
                  reload_table_b2b();
         
                

                
            }
            $('#btnSave3').text('save').attr('disabled', false);
        },
        error: function () {
            alert('Error saving data!');
            $('#btnSave3').text('save').attr('disabled', false);
        }
    });
}

///***For save the leads details from adding modal form *****///

////***For reload the datatable for delete *****///

function reload_table_delete()
{
    $table1.ajax.reload(null,false); //reload datatable ajax
    
    swal("Leads details deleted successfully", "", "success")
        // var ff = 0;
        
        // ff = "Room tariff details deleted successfully";

        //  $("#roles_delete").val(ff);
        
         
        //  var options = {

        // 'title': '',

        // 'style': 'success',

        // 'message': ff,

        // // 'success': 'warning',
        // 'icon': 'fas fa-check',

        // };
        // var n1 = new notify(options); 

        // n1.show(); 

        // setTimeout(function(){ n1.hide(); }, 10000);
        
}

function reload_table_delete_meta()
{
    $table2.ajax.reload(null,false); //reload datatable ajax
    
    swal("Leads details deleted successfully", "", "success")
        // var ff = 0;
        
        // ff = "Room tariff details deleted successfully";

        //  $("#roles_delete").val(ff);
        
         
        //  var options = {

        // 'title': '',

        // 'style': 'success',

        // 'message': ff,

        // // 'success': 'warning',
        // 'icon': 'fas fa-check',

        // };
        // var n1 = new notify(options); 

        // n1.show(); 

        // setTimeout(function(){ n1.hide(); }, 10000);
        
}

function reload_table_delete_b2b()
{
    $table3.ajax.reload(null,false); //reload datatable ajax
    
    swal("Leads details deleted successfully", "", "success")
        // var ff = 0;
        
        // ff = "Room tariff details deleted successfully";

        //  $("#roles_delete").val(ff);
        
         
        //  var options = {

        // 'title': '',

        // 'style': 'success',

        // 'message': ff,

        // // 'success': 'warning',
        // 'icon': 'fas fa-check',

        // };
        // var n1 = new notify(options); 

        // n1.show(); 

        // setTimeout(function(){ n1.hide(); }, 10000);
        
}
////***For reload the datatable for delete *****///
    
////***For reload the leads datatable for delete *****///

function delete_leads(id)
{
     $.ajax({
        url : "<?php echo base_url();?>index.php/Leads/ajax_edit/" + id,
        type: "GET",
        dataType: "JSON",
        success: function(data)
        {

            $('[id="id1"]').val(data.leads_id);
            $('[name="guest_name2"]').val(data.guest_name);
            $('[name="lead_type_delete"]').val(data.lead_type);
            $('#deleterowModal').modal('show'); // show bootstrap modal when complete loaded
            $('.modal-title1').text('Do you want to delete this record?'); // Set title to Bootstrap modal title
            $('#btnSave1').text('delete');
            $('#btnSave1').attr('disabled',false); //set button enable 

        },
        error: function (jqXHR, textStatus, errorThrown)
        {
            alert('Error get data from ajax');
        }
    });
    
    // $('#deleterowModal').modal('show'); // show bootstrap modal
        // ajax delete data to database 
}

function delete_leads_action()
{
    $('#btnSave1').text('deleting...'); //change button text
    $('#btnSave1').attr('disabled',true); //set button disable 
    var url;

        url = "<?php echo base_url();?>index.php/Leads/delete/";
        
    

    // ajax adding data to database
    $.ajax({
        url : url,
        type: "POST",
        data: $('#form1').serialize(),
        dataType: "JSON",
        success: function(data)
        {

            if(data.status) //if success close modal and reload ajax table
            {
                $("#id1").val('');
                $('#deleterowModal').modal('hide');
                
                var leadtype = $('[name="lead_type_delete"]').val();
                if(leadtype == 'B2C'){
                  reload_table_delete();
                }
                else if(leadtype == 'B2B'){
                  reload_table_delete_b2b();
                }
                else{
                  reload_table_delete_meta();
                }
                // ('body').removeClass('modal-open');
                //$('.modal-backdrop').remove();
                
            }
            else
            {
                for (var i = 0; i < data.inputerror.length; i++) 
                {
                    $('[name="'+data.inputerror[i]+'"]').parent().parent().addClass('has-error'); //select parent twice to select div form-group class and add has-error class
                    if($('[name="'+data.inputerror[i]+'"]').parent().find('.help-block').length) {
                        $('[name="'+data.inputerror[i]+'"]').parent().find('.help-block').text(data.error_string[i]); //select span help-block class set text error string
                    } else {
                        $('[name="'+data.inputerror[i]+'"]').next().text(data.error_string[i]);
                    }
                }
            }

            $('#btnSave1').text('save'); //change button text
            $('#btnSave1').attr('disabled',false); //set button enable 


        },
        error: function (jqXHR, textStatus, errorThrown)
        {
            alert('Error adding / update data');
            $('#btnSave1').text('save'); //change button text
            $('#btnSave1').attr('disabled',false); //set button enable 

        }
    });
}

////***** For delete the leads details from  database *****///

function accomodation_plan(id)
{
    $.ajax({
        url: "<?php echo base_url('index.php/Leads/ajax_accommodation_plan/'); ?>" + id,
        type: "GET",
        dataType: "JSON",
        success: function (res) {

            $('#lead_id_fk').val(res.lead.leads_id);
            $('#lead_type_accomodation').val(res.lead.lead_type);
            $('#pacakage_id_fk').val(res.lead.package_id_fk);

            let tbody = $('#accommodationTableBody');
            tbody.empty();

            // Same guest count => auto select first pax plan
            // let singleValue = null;
            // $.each(res.pax_plans || [], function (_, p) {
            //     if (p.guset_count_details_type === 'S' && singleValue === null) {
            //         singleValue = p.guset_count_details_id;
            //     }
            // });

            let singleValue = null;
            let firstPaxValue = null;

            $.each(res.pax_plans || [], function (_, p) {

                if (firstPaxValue === null) {
                    firstPaxValue = p.guset_count_details_id;
                }

                if (p.guset_count_details_type === 'S' && singleValue === null) {
                    singleValue = p.guset_count_details_id;
                }
            });

            $.each(res.days || [], function (i, day) {

            // skip rows where required_status = 2
            if (String(day.packages_itineraries_days_required_status) === '2') {
                return true; // continue
            }

            let dayId =
                day.packages_itinerary_days_id ||
                day.packages_itineraries_days_id ||
                day.packages_itinerary_days_id_fk ||
                day.day_id_fk ||
                '';

            let ex = (res.existing && dayId && res.existing[String(dayId)])
                ? res.existing[String(dayId)]
                : null;

            // âœ… Travel Back label
            let travelBackFlag = $.trim(String(day.packages_itineraries_days_travel_back || '')).toUpperCase();
            let isTravelBack = (travelBackFlag === 'TB');


            let dayText = day.packages_itineraries_days_day || ('Day ' + (i + 1));

            // only for display
            let dayLabel = isTravelBack
                ? dayText + ' - Travel Back'
                : dayText;

            // âœ… default accommodation status = Required
            let selectedStatus = ex
                ? ex.accomodation_required_staus
                : 'R';

            // âœ… default destination from itinerary day
            let selectedDestination = ex
                ? ex.stay_destination_id_fk
                : (day.packages_itineraries_days_destination_id_fk || '');

            // âœ… default meal plan = 1 (CP)
            let selectedMeal = ex
                ? ex.meal_plan_id_fk
                : '1';

            // âœ… default pax plan for Same guest count
            // let selectedPax = ex
            //     ? ex.guset_count_details_id_fk
            //     : (singleValue || '');

            let selectedPax = ex
            ? ex.guset_count_details_id_fk
            : (singleValue || firstPaxValue || '');

            // Destination options
            let destinationOptions = '<option value="">Select Destination</option>';
            $.each(res.destinations || [], function (_, d) {
                let sel = (String(d.state_id) === String(selectedDestination)) ? 'selected' : '';
                destinationOptions += '<option value="' + d.state_id + '" ' + sel + '>' + d.state_name + '</option>';
            });

            // Meal options
            let mealOptions = '<option value="">Select Meal Plan</option>';
            $.each(res.meal_plans || [], function (_, m) {
                let sel = (String(m.meal_plan_id) === String(selectedMeal)) ? 'selected' : '';
                mealOptions += '<option value="' + m.meal_plan_id + '" ' + sel + '>' + m.meal_plan_name + '</option>';
            });

            // Pax plan options
            let paxOptions = '<option value="">Select Pax Plan</option>';
            $.each(res.pax_plans || [], function (_, p) {
                let sel = (String(p.guset_count_details_id) === String(selectedPax)) ? 'selected' : '';
                paxOptions += '<option value="' + p.guset_count_details_id + '" ' + sel + '>' +
                    p.pax_count_plan + ' (' + p.adults + 'A + ' + p.children + 'C)' +
                    '</option>';
            });

            tbody.append(`
            <tr class="acc-row"
                data-default-destination="${selectedDestination}"
                data-default-meal="${selectedMeal}"
                data-default-pax="${selectedPax}">
                <td>
                    <input type="hidden" name="itinerary_day_id[]" value="${dayId}">
                    <input type="hidden" name="day[]" value="${dayText}">
                    <span class="fw-semibold">${dayLabel}</span>
                </td>

                <td>
                    <div class="field-wrap">
                        <select name="accommodation_status[]" class="form-control acc-status lst-flt-select2">
                            <option value="">Select</option>
                            <option value="R" ${selectedStatus === 'R' ? 'selected' : ''}>Required</option>
                            <option value="N" ${selectedStatus === 'N' ? 'selected' : ''}>Not Required</option>
                        </select>
                        <span class="state-ico"></span>
                    </div>
                </td>

                

                <td>
                    <div class="field-wrap">
                        <select class="form-control acc-field lst-flt-select2 stay-destination-view" disabled>
                            ${destinationOptions}
                        </select>

                        <input type="hidden"
                            name="stay_destination_id[]"
                            class="stay-destination-hidden"
                            value="${selectedDestination}">

                        <span class="state-ico"></span>
                    </div>
                </td>
                <td>
                    <div class="field-wrap">
                        <select name="meal_plan_id[]" class="form-control acc-field lst-flt-select2">
                            ${mealOptions}
                        </select>
                        <span class="state-ico"></span>
                    </div>
                </td>

                <td>
                    <div class="field-wrap">
                        <select name="pax_count_plan_id[]" class="form-control acc-field lst-flt-select2 pax-plan">
                            ${paxOptions}
                        </select>
                        <span class="state-ico"></span>
                    </div>
                </td>
            </tr>
        `);
            let $row = tbody.find('tr.acc-row').last();
            let $paxSelect = $row.find('select[name="pax_count_plan_id[]"]');

            // Same guest count => auto-select and disable pax plan
            if (singleValue) {
                $paxSelect.val(String(singleValue)).prop('disabled', true);
                if (!$paxSelect.next('small').length) {
                    $paxSelect.after('<small class="text-muted d-block">Auto-selected single Pax Plan</small>');
                }
            } else {
                $paxSelect.prop('disabled', false);
                $paxSelect.next('small').remove();
            }

            // if status N, disable remaining fields
            if (selectedStatus === 'N') {
                $row.find('.acc-field').prop('disabled', true).val('').trigger('change');
                $row.addClass('table-secondary');
            }
        });

            initSelect2AccModal();
            validateAllAccRows();
            $('#accomodation_planModal').modal('show');
        },
        error: function(xhr){
            console.log('AJAX error:', xhr.responseText);
            alert('Failed to load accommodation plan (see console)');
        }
    });
}

window.accomodation_plan = accomodation_plan;

// $(document).on('change', '.acc-status', function () {

//     let $row = $(this).closest('tr.acc-row');
//     let statusVal = $(this).val();

//     // let $dest = $row.find('select[name="stay_destination_id[]"]');
//     let $dest = $row.find('.stay-destination-view');
//     let $destHidden = $row.find('.stay-destination-hidden');
//     let $meal = $row.find('select[name="meal_plan_id[]"]');
//     let $pax  = $row.find('select[name="pax_count_plan_id[]"]');

//     if (statusVal === 'N') {
//         // disable and clear when not required
//         $dest.val('').trigger('change');
//         $destHidden.val('');
//         $meal.val('').trigger('change');
//         $pax.val('').trigger('change');

//         $dest.prop('disabled', true);
//         $meal.prop('disabled', true);
//         $pax.prop('disabled', true);

//         $row.addClass('table-secondary');
//     }
//     else if (statusVal === 'R') {
//         // enable again
//         $dest.prop('disabled', false);
//         $meal.prop('disabled', false);
//         $pax.prop('disabled', false);

//         // restore defaults
//         let defaultDest = $row.attr('data-default-destination') || '';

// $dest.val(defaultDest).trigger('change');
// $destHidden.val(defaultDest);

//         let defaultMeal = $row.attr('data-default-meal') || '';
//         let defaultPax  = $row.attr('data-default-pax') || '';

//         $dest.val(defaultDest).trigger('change');
//         $meal.val(defaultMeal).trigger('change');
//         $pax.val(defaultPax).trigger('change');

//         $row.removeClass('table-secondary');
//     }

//     validateAllAccRows();
// });

$(document).on('change', '.acc-status', function () {

    let $row = $(this).closest('tr.acc-row');
    let statusVal = $(this).val();

    let $dest = $row.find('.stay-destination-view');
    let $destHidden = $row.find('.stay-destination-hidden');

    let $meal = $row.find('select[name="meal_plan_id[]"]');
    let $pax  = $row.find('select[name="pax_count_plan_id[]"]');

    if (statusVal === 'N') {
        $dest.val('').trigger('change.select2');
        $destHidden.val('');

        $meal.val('').trigger('change.select2');
        $pax.val('').trigger('change.select2');

        $meal.prop('disabled', true);
        $pax.prop('disabled', true);

        $row.addClass('table-secondary');
    } else if (statusVal === 'R') {
        let defaultDest = $row.attr('data-default-destination') || '';
        let defaultMeal = $row.attr('data-default-meal') || '';
        let defaultPax  = $row.attr('data-default-pax') || '';

        $dest.val(defaultDest).trigger('change.select2');
        $destHidden.val(defaultDest);

        $meal.prop('disabled', false).val(defaultMeal).trigger('change.select2');
        $pax.prop('disabled', false).val(defaultPax).trigger('change.select2');

        $row.removeClass('table-secondary');
    }

    validateAllAccRows();
});

function clearSavedGuestMemory()
{
    savedGuestCountData = null;
    savedGuestCountType = '';
    isLoadingGuestCount = false;

    $('#guset_count_id').val('');
}
$('#gusetcountModal').on('hidden.bs.modal', function () {
    clearSavedGuestMemory();
    resetGuestCountModal();
});
function guset_count(id)
{
    savedGuestCountData = null;
    savedGuestCountType = '';
    isLoadingGuestCount = false;

    $.ajax({
        url : "<?php echo base_url();?>index.php/Leads/ajax_edit/" + id,
        type: "GET",
        dataType: "JSON",
        success: function(data)
        {
            if (typeof resetGuestCountModal === 'function') {
                resetGuestCountModal();
            }

            $('[name="guset_count_lead_id_fk"]').val(data.leads_id);
            $('[name="lead_type_count"]').val(data.lead_type);
            $('[name="guset_count_package_id_fk"]').val(data.package_id_fk);

            $('#gusetcountModal').modal('show');
            $('.modal-title1').text('Add Guest count Details');
            $('#btnSaveGuest').text('Save');
        },
        error: function ()
        {
            alert('Error get data from ajax');
        }
    });
}

// function guset_count(id)
// {
//      $.ajax({
//         url : "<?php echo base_url();?>index.php/Leads/ajax_edit/" + id,
//         type: "GET",
//         dataType: "JSON",
//         success: function(data)
//         {

//             // âœ… always reset first
//             // resetGuestCountModal();

//             $('[name="guset_count_lead_id_fk"]').val(data.leads_id);
//             $('[name="lead_type_count"]').val(data.lead_type);
//             $('[name="guset_count_package_id_fk"]').val(data.package_id_fk);
//             $('#gusetcountModal').modal('show'); // show bootstrap modal when complete loaded
//             $('.modal-title1').text('Add Guest count Details'); // Set title to Bootstrap modal title
//             $('#btnSave').text('save'); 

//         },
//         error: function (jqXHR, textStatus, errorThrown)
//         {
//             alert('Error get data from ajax');
//         }
//     });
    
//     // $('#deleterowModal').modal('show'); // show bootstrap modal
//         // ajax delete data to database 
// }


var savedGuestCountData = null;
var savedGuestCountType = '';
var isLoadingGuestCount = false;

document.addEventListener('DOMContentLoaded', function () {

  const sameRadio = document.getElementById('ds');
  const diffRadio = document.getElementById('df');
  const addPlanBtn = document.getElementById('addInclusionBtn_count');
  const saveBtn = document.getElementById('btnSaveGuest');
  const tableBody = document.querySelector('#GuestTableCount tbody');

  let planIndex = 1;

  loadSameGuest();

//   sameRadio.addEventListener('change', loadSameGuest);
//   diffRadio.addEventListener('change', loadDifferentGuest);
  sameRadio.addEventListener('change', function () {
    handleGuestTypeChange('S');
});

diffRadio.addEventListener('change', function () {
    handleGuestTypeChange('D');
});
  addPlanBtn.addEventListener('click', () => addPlan(true));
  saveBtn.addEventListener('click', saveGuestCount);

  function loadSameGuest() {
    tableBody.innerHTML = '';
    planIndex = 1;
    addPlanBtn.style.display = 'none';
    addPlan(false);
    validateAllPlans(); // ensure save state correct
  }

  function loadDifferentGuest() {
    tableBody.innerHTML = '';
    planIndex = 1;
    addPlanBtn.style.display = 'inline-block';
    addPlan(true);
    validateAllPlans();
  }

  function refreshPlanNumbers()
{
    let index = 1;

    document.querySelectorAll('#GuestTableCount tbody tr.pax-row').forEach(function(row) {
        let strong = row.querySelector('strong');

        if (strong) {
            strong.textContent = 'Plan ' + index;
        }

        index++;
    });

    planIndex = index;
}

  function addPlan(removable) {
    // const planNo = planIndex++;
    refreshPlanNumbers();
const planNo = planIndex++;

    const paxRow = document.createElement('tr');
    paxRow.classList.add('pax-row');
    paxRow.innerHTML = `
      <td>
        <strong>Plan ${planNo}</strong>
        ${removable ? '<button type="button" class="btn btn-sm btn-danger remove-plan ms-2">Ã—</button>' : ''}
      </td>
      <td><div class="field-wrap"><input type="number" min="0" class="form-control adult" value="0"></div></td>
      <td><div class="field-wrap"><input type="number" min="0" class="form-control child" value="0"></div></td>
      <td class="total text-center">0</td>
    `;
    tableBody.appendChild(paxRow);

    const childRow = document.createElement('tr');
    childRow.classList.add('child-wrapper');
    childRow.innerHTML = `
      <td colspan="4">
        <div class="p-3 bg-light rounded">
          <table class="table table-sm child-table">
            <tbody>
              <tr class="child-row">
                <td><div class="field-wrap"><input type="number" min="0" class="form-control age" placeholder="Age"</div></td>
                <td><div class="field-wrap"><input type="number" min="0" class="form-control count" placeholder="Count"></div></td>
                <td></td>
              </tr>
            </tbody>
          </table>
          <button type="button" class="btn btn-sm btn-success add-child">+ Add new row</button>
          <div class="text-danger error mt-1"></div>
        </div>
      </td>
    `;
    tableBody.appendChild(childRow);

    bindPlanEvents(paxRow, childRow);

    const removeBtn = paxRow.querySelector('.remove-plan');
    if (removeBtn) {
    //   removeBtn.onclick = () => {
    //     childRow.remove();
    //     paxRow.remove();
    //     validateAllPlans();
    //   };
    removeBtn.onclick = () => {
    childRow.remove();
    paxRow.remove();

    refreshPlanNumbers();
    validateAllPlans();
};
    }
    

    validateAllPlans();
  }

  // ==============================
  // VALIDATION CORE
  // ==============================
  function validateAllPlans() {
    const guestType = document.querySelector('input[name="guest_type"]:checked').value;

    let allOk = true;

    document.querySelectorAll('#GuestTableCount tbody tr.pax-row').forEach(paxRow => {
      const childRow = paxRow.nextElementSibling; // child-wrapper
      const ok = validatePlan(paxRow, childRow, guestType);
      if (!ok) allOk = false;
    });

    saveBtn.disabled = !allOk;
    return allOk;
  }

  function validatePlan(paxRow, childRow, guestType) {
    const adultEl = paxRow.querySelector('.adult');
    const childEl = paxRow.querySelector('.child');
    const errEl = childRow.querySelector('.error');
    const childTbody = childRow.querySelector('.child-table tbody');

    const adults = toInt(adultEl.value);
    const children = toInt(childEl.value);

    // requirement: in SAME and DIFFERENT you asked adults and children must be > 0
    // if (adults <= 0 || children <= 0) {
    if (adults <= 0) {
      errEl.textContent = 'Adults must be greater than 0';
      return false;
    }

    // child breakup sum(count) <= children (including first default row)
    let used = 0;
    childTbody.querySelectorAll('.count').forEach(c => used += toInt(c.value));

    if (used > children) {
      errEl.textContent = `Child count exceeded (Allowed: ${children})`;
      return false;
    }

    // If OK clear error
    errEl.textContent = '';
    return true;
  }

  function toInt(v) {
    const n = parseInt(v, 10);
    return isNaN(n) ? 0 : n;
  }

  // ==============================
  // PLAN EVENTS
  // ==============================


// function guset_count_edit(id) {
//   // Add Mode UI reset
//   $('#guset_count_id').val(''); // important: empty means INSERT
//   $('#ds').prop('checked', true).trigger('change'); // Same default
//   // rebuild UI blocks
//   // call your function that clears table and adds 1 plan
//   // loadSameGuest();
//    // âœ… EDIT MODE must fetch existing guest count
//     openGuestCountModal(id);
//   $('#gusetcountModal').modal('show');
// }

function guset_count_edit(id) {
    openGuestCountModal(id);
}

function resetGuestCountModal() {
    // clear hidden ids
    $('#guset_count_id').val('');
    $('#guset_count_lead_id_fk').val('');
    $('#guset_count_package_id_fk').val('');

    // reset radio
    $('#ds').prop('checked', true);
    $('#df').prop('checked', false);

    // clear table
    const tbody = document.querySelector('#GuestTableCount tbody');
    if (tbody) {
        tbody.innerHTML = '';
    }

    // reset plan index
    planIndex = 1;

    // hide add plan button for same guest count
    $('#addInclusionBtn_count').hide();

    // rebuild one default same guest count row
    loadSameGuest();

    // clear validation / save state
    $('#btnSaveGuest').prop('disabled', false);
}

// âœ… make available outside DOMContentLoaded
window.resetGuestCountModal = resetGuestCountModal;
window.loadSameGuest = loadSameGuest;
window.loadDifferentGuest = loadDifferentGuest;

function openGuestCountModal(leadId) {

    // âœ… always reset first
    resetGuestCountModal();

    // set current lead id
    $('#guset_count_lead_id_fk').val(leadId);

    $.ajax({
        url: "<?php echo site_url('Leads/ajax_get_guest_count'); ?>/" + leadId,
        type: "GET",
        dataType: "json",
        success: function(res){

            if (!res.status) {
                alert('Fetch failed');
                return;
            }

            // if no existing record, open clean add mode
            // if (!res.exists || !res.master || !res.master.guset_count_id) {
            //     guset_count(leadId);
            //     return;
            // }
            if (!res.exists || !res.master || !res.master.guset_count_id) {
    savedGuestCountData = null;
    savedGuestCountType = '';
    guset_count(leadId);
    return;
}
            $('[name="lead_type_count"]').val(res.master.lead_type);
            // fill ids
            $('#guset_count_id').val(res.master.guset_count_id);
            $('#guset_count_package_id_fk').val(res.master.guset_count_package_id_fk);

             savedGuestCountData = res;
            savedGuestCountType = res.master.guset_count_type;

            // radio type
            if (res.master.guset_count_type === 'D') {
                $('#df').prop('checked', true);
                $('#ds').prop('checked', false);
                $('#addInclusionBtn_count').show();
            } else {
                $('#ds').prop('checked', true);
                $('#df').prop('checked', false);
                $('#addInclusionBtn_count').hide();
            }

            const tbody = document.querySelector('#GuestTableCount tbody');
            tbody.innerHTML = '';
            planIndex = 1;

            // load saved details
            res.details.forEach(function(detail, idx){
                addPlanFromData(detail, idx, res.master.guset_count_type === 'D');
            });
            refreshPlanNumbers();
            $('#gusetcountModal').modal('show');
        },
        error: function () {
            alert('Failed to fetch guest count data');
        }
    });
}

function fillGuestCountModal(res){
  // master id
  document.getElementById('guset_count_id').value = res.master.guset_count_id;

  // select type
  if(res.master.guset_count_type === 'D'){
    document.getElementById('df').checked = true;
    loadDifferentGuest(true); // youâ€™ll adjust loadDifferentGuest to accept "skip default add"
  } else {
    document.getElementById('ds').checked = true;
    loadSameGuest(true);
  }

  // clear table
  const tbody = document.querySelector('#GuestTableCount tbody');
  tbody.innerHTML = '';
  planIndex = 1;

  // build each plan
  res.details.forEach((d, idx) => {
    addPlanFromData(d, idx, res.master.guset_count_type === 'D');
  });
}
// <strong>${detail.pax_count_plan || ('Plan ' + planNo)}</strong>
function addPlanFromData(detail, idx, removable){
  const tbody = document.querySelector('#GuestTableCount tbody');
  const planNo = idx + 1;

  const paxRow = document.createElement('tr');
  paxRow.classList.add('pax-row');
  paxRow.innerHTML = `
    <td>
      
      <strong>Plan ${planNo}</strong>
      <input type="hidden" name="detail_id[]" class="detail-id" value="${detail.guset_count_details_id}">
      ${removable ? '<button type="button" class="btn btn-sm btn-danger remove-plan ms-2">Ã—</button>' : ''}
    </td>
    <td><input type="number" min="0" class="form-control adult" value="${detail.adults}"></td>
    <td><input type="number" min="0" class="form-control child" value="${detail.children}"></td>
    <td class="total text-center">${detail.total_count}</td>
  `;
  tbody.appendChild(paxRow);

  const childRow = document.createElement('tr');
  childRow.classList.add('child-wrapper');
  childRow.innerHTML = `
    <td colspan="4">
      <div class="p-3 bg-light rounded">
        <table class="table table-sm child-table">
          <tbody></tbody>
        </table>
        <button type="button" class="btn btn-sm btn-success add-child">+ Add new row</button>
        <div class="text-danger error mt-1"></div>
      </div>
    </td>
  `;
  tbody.appendChild(childRow);

  const ctbody = childRow.querySelector('.child-table tbody');

  // render child rows
  if(detail.child_breakup && detail.child_breakup.length){
    detail.child_breakup.forEach(cb => {
      const tr = document.createElement('tr');
      tr.classList.add('child-row');
      tr.innerHTML = `
        <td><input type="number" min="0" class="form-control age" value="${cb.age}"></td>
        <td><input type="number" min="0" class="form-control count" value="${cb.count}"></td>
        <td><button type="button" class="btn btn-sm btn-danger remove-child">Ã—</button></td>
      `;
      ctbody.appendChild(tr);
      // tr.querySelector('.remove-child').onclick = () => tr.remove();
      tr.querySelector('.remove-child').onclick = () => {
        tr.remove();
        validateAllPlans(); // or validatePlanRealtime() if available here
      };

    });
  } else {
    // default row if none
    const tr = document.createElement('tr');
    tr.classList.add('child-row');
    tr.innerHTML = `
      <td><input type="number" min="0" class="form-control age"></td>
      <td><input type="number" min="0" class="form-control count"></td>
      <td></td>
    `;
    ctbody.appendChild(tr);
  }

  // hook add-child + validation + remove-plan (reuse your bindPlanEvents)
  bindPlanEvents(paxRow, childRow);

  const rm = paxRow.querySelector('.remove-plan');
  // if(rm){
  //   rm.onclick = () => { paxRow.remove(); childRow.remove(); };
  // }
  if(rm){
    rm.onclick = () => {
      paxRow.remove();
      childRow.remove();
      refreshPlanNumbers();
      validateAllPlans(); // âœ… IMPORTANT
    };
  }

}

function restoreSavedGuestCount()
{
    if (!savedGuestCountData || !savedGuestCountData.details) {
        return false;
    }

    const tbody = document.querySelector('#GuestTableCount tbody');
    tbody.innerHTML = '';
    planIndex = 1;

    savedGuestCountData.details.forEach(function(detail, idx){
        addPlanFromData(
            detail,
            idx,
            savedGuestCountData.master.guset_count_type === 'D'
        );
    });

    refreshPlanNumbers();
    validateAllPlans();

    return true;
}

function handleGuestTypeChange(type)
{
    if (isLoadingGuestCount) return;

    var guestCountId = $('#guset_count_id').val();

    // No saved guest count: normal switching
    if (!guestCountId) {
        if (type === 'S') {
            loadSameGuest();
        } else {
            loadDifferentGuest();
        }
        return;
    }

    // Saved guest count exists
    if (type === savedGuestCountType) {

        // Switch back to original saved type: restore saved rows
        if (type === 'S') {
            $('#ds').prop('checked', true);
            $('#df').prop('checked', false);
            $('#addInclusionBtn_count').hide();
        } else {
            $('#df').prop('checked', true);
            $('#ds').prop('checked', false);
            $('#addInclusionBtn_count').show();
        }

        restoreSavedGuestCount();
        return;
    }

    // Switching to opposite type: show fresh blank UI
    if (type === 'S') {
        loadSameGuest();
    } else {
        loadDifferentGuest();
    }
}

function bindPlanEvents(paxRow, childRow) {

  var adult = paxRow.querySelector('.adult');
  var child = paxRow.querySelector('.child');
  var total = paxRow.querySelector('.total');

  var error = childRow.querySelector('.error');
  var childTbody = childRow.querySelector('.child-table tbody');

  function updateTotal(){
    total.textContent = toInt(adult.value) + toInt(child.value);
  }


function validatePlanRealtime(){
    var ok = true;

    // Adults required > 0
    if (toInt(adult.value) <= 0){
      setInvalid(adult, 'Adults > 0');
      ok = false;
    } else setValid(adult);

    // Children required > 0
    var childrenAllowed = toInt(child.value);
    // if (childrenAllowed <= 0){
    //   setInvalid(child, 'Children > 0');
    //   ok = false;
    // } else 
    setValid(child);

    // Validate each child breakup row
    var used = 0;
    var rowError = false;

    if(childrenAllowed > 0) {
        childRow.querySelectorAll('.child-row').forEach(function(r){
          var ageInput = r.querySelector('.age');
          var countInput = r.querySelector('.count');

          if (toInt(ageInput.value) <= 0){
            setInvalid(ageInput, 'Age > 0');
            rowError = true;
          } else setValid(ageInput);

          if (toInt(countInput.value) <= 0){
            setInvalid(countInput, 'Count > 0');
            rowError = true;
          } else setValid(countInput);

          used += toInt(countInput.value);
        });
    }

    

    if (rowError){
      error.textContent = 'Child age & count are required';
      ok = false;
    } else {
      // EXACT MATCH rule requested
      if (childrenAllowed > 0 && used < childrenAllowed){
        error.textContent = 'Child breakup incomplete (Need: ' + childrenAllowed + ', Given: ' + used + ')';
        // mark all count boxes invalid to guide user
        childRow.querySelectorAll('.count').forEach(function(c){ setInvalid(c, 'Need total = ' + childrenAllowed); });
        ok = false;
      } else if (childrenAllowed > 0 && used > childrenAllowed){
        error.textContent = 'Child count exceeded (Allowed: ' + childrenAllowed + ')';
        childRow.querySelectorAll('.count').forEach(function(c){ setInvalid(c, 'Max ' + childrenAllowed); });
        ok = false;
      } else {
        error.textContent = '';
      }
    }

    // âœ… Remove child row (delegated) + revalidate
    childRow.addEventListener('click', function(e){
      const btn = e.target.closest('.remove-child');
      if(!btn) return;

      const tr = btn.closest('tr.child-row');
      if(!tr) return;

      tr.remove();
      validatePlanRealtime();  // âœ… IMPORTANT
    });

    // Enable/disable save across ALL plans
    validateAllPlansButton();
    return ok;
  }

  function validateAllPlansButton(){
    var allOk = true;
    document.querySelectorAll('#GuestTableCount tbody tr.pax-row').forEach(function(pr){
      var cr = pr.nextElementSibling;
      if (!cr) return;

      var a = pr.querySelector('.adult');
      var c = pr.querySelector('.child');
      if (toInt(a.value) <= 0 ) allOk = false;

      // exact match check
      var allowed = toInt(c.value);
      var used = 0;
      if(allowed > 0){
        cr.querySelectorAll('.child-row .count').forEach(function(x){ used += toInt(x.value); });

          // also require age/count >0
          cr.querySelectorAll('.child-row .age, .child-row .count').forEach(function(x){
            if (toInt(x.value) <= 0) allOk = false;
          });
      }
      

      if (allowed > 0 && used !== allowed) allOk = false;
      if (cr.querySelector('.error') && cr.querySelector('.error').textContent.trim() !== '') allOk = false;
    });

    document.getElementById('btnSaveGuest').disabled = !allOk;
  }

  // Realtime listeners
  adult.addEventListener('input', function(){ updateTotal(); validatePlanRealtime(); });
  child.addEventListener('input', function(){ updateTotal(); validatePlanRealtime(); });

  // delegate child age/count typing
  childTbody.addEventListener('input', function(e){
    if (e.target.classList.contains('age') || e.target.classList.contains('count')){
      validatePlanRealtime();
    }
  });

  // Add row
  childRow.querySelector('.add-child').onclick = function(){
    var tr = document.createElement('tr');
    tr.classList.add('child-row');
    tr.innerHTML = `
      <td>
        <div class="field-wrap">
          <input type="number" min="0" class="form-control age" placeholder="Age">
         
        </div>
      </td>
      <td>
        <div class="field-wrap">
          <input type="number" min="0" class="form-control count" placeholder="Count">
          
        </div>
      </td>
      <td><button type="button" class="btn btn-sm btn-danger remove-child">Ã—</button></td>
    `;
    childTbody.appendChild(tr);

    tr.querySelector('.remove-child').onclick = function(){
      tr.remove();
      validatePlanRealtime();
    };

    validatePlanRealtime();
  };

  // initial
  updateTotal();
  validatePlanRealtime();
}

  // ==============================
  // COLLECT PAYLOAD (your existing one is fine; keep safe checks)
  // ==============================
  function collectPayload() {
    const payload = {
      guest_type: document.querySelector('input[name="guest_type"]:checked').value,
      pax: []
    };

    document.querySelectorAll('.pax-row').forEach(paxRow => {
      const childRow = paxRow.nextElementSibling;
      if (!childRow) return;

      const planLabel = paxRow.querySelector('strong');
      const adultInput = paxRow.querySelector('.adult');
      const childInput = paxRow.querySelector('.child');
      const totalCell = paxRow.querySelector('.total');

      if (!planLabel || !adultInput || !childInput || !totalCell) return;

      const plan = {
        planName: planLabel.textContent.trim(),
        adults: adultInput.value,
        children: childInput.value,
        total: totalCell.textContent,
        childrenAge: []
      };

      childRow.querySelectorAll('.child-row').forEach(r => {
        const ageInput = r.querySelector('.age');
        const countInput = r.querySelector('.count');
        if (ageInput && countInput) {
          plan.childrenAge.push({ age: ageInput.value, count: countInput.value });
        }
      });

      payload.pax.push(plan);
    });

    return payload;
  }

  // ==============================
  // SAVE
  // ==============================

function markInvalid(input) {
  input.classList.remove('is-valid');
  input.classList.add('is-invalid');
}

function markValid(input) {
  input.classList.remove('is-invalid');
  input.classList.add('is-valid');
}

function clearState(input) {
  input.classList.remove('is-invalid', 'is-valid');
}

// function toInt(v) {
//   const n = parseInt(v, 10);
//   return isNaN(n) ? 0 : n;
// }

function toInt(v){ var n = parseInt(v,10); return isNaN(n)?0:n; }

function tipEl(input){
  var wrap = input.closest('.field-wrap');
  return wrap ? wrap.querySelector('.tip') : null;
}

function setInvalid(input, msg){
  input.classList.remove('is-valid');
  input.classList.add('is-invalid');

  var tip = tipEl(input);
  if (tip){
    tip.textContent = msg || 'Invalid';
    tip.classList.add('show');
  }

  // shake input (restart animation)
  input.classList.remove('shake');
  void input.offsetWidth;
  input.classList.add('shake');
}

function setValid(input){
  input.classList.remove('is-invalid');
  input.classList.add('is-valid');

  var tip = tipEl(input);
  if (tip){
    tip.textContent = '';
    tip.classList.remove('show');
  }
}

function clearState(input){
  input.classList.remove('is-invalid','is-valid','shake');
  var tip = tipEl(input);
  if (tip){
    tip.textContent = '';
    tip.classList.remove('show');
  }
}

function validateChildrenExact() {
  const allowed = toInt(child.value); // children input
  let used = 0;

  childTbody.querySelectorAll('.count').forEach(c => {
    used += toInt(c.value);
  });

  // EXACT MATCH RULE
  if (allowed <= 0) {
    error.textContent = 'Children is required and must be greater than 0';
    saveBtn.disabled = true;
    return false;
  }

  if (used < allowed) {
    error.textContent = `Child breakup is incomplete (Need: ${allowed}, Given: ${used})`;
    saveBtn.disabled = true;
    return false;
  }

  if (used > allowed) {
    error.textContent = `Child count exceeded (Allowed: ${allowed})`;
    saveBtn.disabled = true;
    return false;
  }

  error.textContent = '';
  saveBtn.disabled = false;
  return true;
}

function saveGuestCount() {

  let hasError = false;

  // clear previous error messages
  document.querySelectorAll('.error').forEach(e => e.textContent = '');

  document.querySelectorAll('#GuestTableCount tbody tr.pax-row').forEach(paxRow => {

    const childRow = paxRow.nextElementSibling;
    if (!childRow) return;

    const errEl = childRow.querySelector('.error');

    const adultInput = paxRow.querySelector('.adult');
    const childInput = paxRow.querySelector('.child');

    const adults = toInt(adultInput.value);
    const children = toInt(childInput.value);

    clearState(adultInput);
    clearState(childInput);

    /* ---- Adults validation ---- */
    if (adults <= 0) {
      markInvalid(adultInput);
      errEl.textContent = 'Adults is required and must be greater than 0';
      hasError = true;
      return;
    } else {
      markValid(adultInput);
    }

    /* ---- Children validation ---- */
    // if (children <= 0) {
    //   markInvalid(childInput);
    //   errEl.textContent = 'Children is required and must be greater than 0';
    //   hasError = true;
    //   return;
    // } else {
    //   markValid(childInput);
    // }

    /* ---- Child breakup validation ---- */
    let used = 0;
    let childError = false;

    if(children >0){
        childRow.querySelectorAll('.child-row').forEach(r => {
          const ageInput = r.querySelector('.age');
          const countInput = r.querySelector('.count');

          clearState(ageInput);
          clearState(countInput);

          const age = toInt(ageInput.value);
          const count = toInt(countInput.value);

          if (age <= 0) {
            markInvalid(ageInput);
            childError = true;
          } else {
            markValid(ageInput);
          }

          if (count <= 0) {
            markInvalid(countInput);
            childError = true;
          } else {
            markValid(countInput);
          }

          used += count;
        });

        if (childError) {
          errEl.textContent = 'Child age and count are required';
          hasError = true;
          return;
        }

        if (used > children) {
          errEl.textContent = `Child count exceeded (Allowed: ${children})`;
          childRow.querySelectorAll('.count').forEach(c => markInvalid(c));
          hasError = true;
          return;
        }
    }

    

    
  });

  // â›” stop save
  if (hasError) return;

  // âœ… proceed to AJAX
  const payload = collectPayload();
  submitGuestCount(payload);
}

function submitGuestCount(payload) {

  const fd = new FormData();

  const leadId = $('#guset_count_lead_id_fk').val();
  const packageId = $('#guset_count_package_id_fk').val();

  fd.append('guset_count_lead_id_fk', leadId);
  fd.append('guset_count_package_id_fk', packageId);
  fd.append('guest_type', payload.guest_type);

  let totalGuests = 0;

  payload.pax.forEach((p, planIndex) => {

    fd.append('pax_count_plan[]', p.planName);
    fd.append('adults[]', p.adults);
    fd.append('children[]', p.children);
    fd.append('total_count[]', p.total);

    totalGuests += parseInt(p.total, 10) || 0;

    p.childrenAge.forEach((c) => {
      fd.append(`age[${planIndex}][]`, c.age);
      fd.append(`count[${planIndex}][]`, c.count);
    });

  });

  fd.append('guset_count_total', totalGuests);

  $.ajax({
    url: "<?php echo base_url('index.php/Leads/ajax_save_guest_count/'); ?>",
    type: "POST",
    data: fd,
    processData: false,
    contentType: false,
    dataType: "json",
    success: function(res){
      if(res.status){
        $('#gusetcountModal').modal('hide');
        var leadtype = $('[name="lead_type_count"]').val();
        if(leadtype == 'B2C'){
          reload_table_guest_count_b2c();
        }else{
          reload_table_guest_count_meta();
        }

        // âœ… open accommodation plan modal after guest count save
        // accomodation_plan(leadId);
        setTimeout(function(){
        accomodation_plan(leadId);
    }, 500);

      } else {
        console.log(res);
        alert((res.errors && res.errors.length) ? res.errors.join("\n") : "Save failed");
      }
    },
    error: function(xhr){
      console.error(xhr.responseText);
      alert('Save failed (server error)');
    }
  });
}
window.guset_count_edit = guset_count_edit;
  window.openGuestCountModal = openGuestCountModal;
});



function setInvalid(el){
  el.classList.remove('is-valid');
  el.classList.add('is-invalid');
  el.classList.remove('shake'); void el.offsetWidth; el.classList.add('shake');
}
function setValid(el){
  el.classList.remove('is-invalid');
  el.classList.add('is-valid');
}
function clearState(el){
  el.classList.remove('is-invalid','is-valid','shake');
}

// function validateAccRow(row){
//   let ok = true;

//   const status = row.querySelector('select[name="accommodation_status[]"]');
//   const dest   = row.querySelector('select[name="stay_destination_id[]"]');
//   const meal   = row.querySelector('select[name="meal_plan_id[]"]');
//   const pax    = row.querySelector('select[name="pax_count_plan_id[]"]');

//   // reset
//   [status,dest,meal,pax].forEach(e => e && clearState(e));

//   // status always required
//   if(!status || !status.value){
//     if(status) setInvalid(status);
//     ok = false;
//   } else setValid(status);

//   // if status Required => dest/meal/pax required
//   if(status && status.value === 'R'){
//     if(!dest.value){ setInvalid(dest); ok = false; } else setValid(dest);
//     if(!meal.value){ setInvalid(meal); ok = false; } else setValid(meal);
//     if(!pax.value){ setInvalid(pax); ok = false; } else setValid(pax);
//   } else {
//     // not required => clear states
//     [dest,meal,pax].forEach(e => e && clearState(e));
//   }

//   return ok;
// }

function validateAccRow(row){
  let ok = true;

  const status = row.querySelector('select[name="accommodation_status[]"]');

  // âœ… destination is now hidden input
  const dest = row.querySelector('input[name="stay_destination_id[]"]');

  const meal = row.querySelector('select[name="meal_plan_id[]"]');
  const pax  = row.querySelector('select[name="pax_count_plan_id[]"]');

  [status, meal, pax].forEach(e => e && clearState(e));

  if (!status || !status.value) {
    if (status) setInvalid(status);
    ok = false;
  } else {
    setValid(status);
  }

  if (status && status.value === 'R') {
    if (!dest || !dest.value) {
      ok = false;
    }

    if (!meal || !meal.value) {
      if (meal) setInvalid(meal);
      ok = false;
    } else {
      setValid(meal);
    }

    if (!pax || !pax.value) {
      if (pax) setInvalid(pax);
      ok = false;
    } else {
      setValid(pax);
    }
  } else {
    [meal, pax].forEach(e => e && clearState(e));
  }

  return ok;
}

function validateAllAccRows(){
  let allOk = true;
  document.querySelectorAll('#accommodationTableBody tr.acc-row').forEach(row=>{
    if(!validateAccRow(row)) allOk = false;
  });

  const btn = document.getElementById('btnSaveaccplan');
  if(btn) btn.disabled = !allOk;
  return allOk;
}


// function initAccommodationValidation() {

//   // Custom method: required if status is R in same row
//   $.validator.addMethod("requiredIfAccRequired", function(value, element) {
//     var $row = $(element).closest('tr.acc-row');
//     var status = $row.find('select[name="accommodation_status[]"]').val();
//     if (status === 'R') {
//       return $.trim(value) !== '';
//     }
//     return true; // not required if status != R
//   }, "This field is required.");

//   // Setup validate
//   $('#form3').validate({
//     ignore: [], // important for select2
//     errorClass: 'is-invalid',
//     validClass: 'is-valid',
//     errorPlacement: function(error, element){
//       // no default error text under fields; icons show status
//       // optionally: you can append tooltip text here if needed
//     },
//     highlight: function(element){
//       $(element).addClass('is-invalid').removeClass('is-valid');
//       // Select2 fix: apply class to visible container
//       if ($(element).hasClass('lst-flt-select2')) {
//         $(element).next('.select2').find('.select2-selection').addClass('is-invalid').removeClass('is-valid');
//       }
//     },
//     unhighlight: function(element){
//       $(element).removeClass('is-invalid').addClass('is-valid');
//       if ($(element).hasClass('lst-flt-select2')) {
//         $(element).next('.select2').find('.select2-selection').removeClass('is-invalid').addClass('is-valid');
//       }
//     },
//     rules: {
//       'accommodation_status[]': { required: true },
//       'stay_destination_id[]': { requiredIfAccRequired: true },
//       'meal_plan_id[]': { requiredIfAccRequired: true },
//       'pax_count_plan_id[]': { requiredIfAccRequired: true }
//     }
//   });

//   // Real-time validate on change
//   $(document).on('change', '#form3 select', function(){
//     $('#form3').valid();
//   });
// }


// âœ… IMPORTANT: make function callable from onclick in datatable
window.accomodation_plan = accomodation_plan;



$(document).on('change', '.acc-status', function(){
  const row = $(this).closest('tr.acc-row');
  const isNotReq = $(this).val() === 'N';

  const fields = row.find('select[name="stay_destination_id[]"], select[name="meal_plan_id[]"], select[name="pax_count_plan_id[]"]');

  if(isNotReq){
    fields.val('').trigger('change');
    fields.prop('disabled', true);
    row.addClass('table-secondary');
  } else {
    fields.prop('disabled', false);
    row.removeClass('table-secondary');
  }

  validateAllAccRows();
});

// realtime validation on any select change
$(document).on('change', '#accomodation_planModal select', function(){
  validateAllAccRows();
});

function initSelect2AccModal(){
  if(!$.fn.select2) return;

  $('#accomodation_planModal .lst-flt-select2').each(function(){
    if($(this).hasClass('select2-hidden-accessible')){
      $(this).select2('destroy');
    }
  });

  $('#accomodation_planModal .lst-flt-select2').select2({
    dropdownParent: $('#accomodation_planModal'),
    width: '100%'
  });
}

function validateAccommodationPlan()
{
    let requiredCount = 0;

    $('select[name="accommodation_status[]"]').each(function () {
        if ($(this).val() === 'R') {
            requiredCount++;
        }
    });

    if (requiredCount === 0) {
        alert('Please select at least one day accommodation status required');
        return false;
    }

    return true;
}

$('#btnSaveaccplan').off('click').on('click', function(e){
  e.preventDefault();

  if(!validateAllAccRows()){
    return;
  }

   if (!validateAccommodationPlan()) {
        return;
    }
  const disabled = $('#form4').find(':disabled');
  disabled.prop('disabled', false);

  const postData = $('#form4').serialize();

  disabled.prop('disabled', true);

  // console.log('FORM SERIALIZED:', postData);
  // console.log('lead_id_fk:', $('#lead_id_fk').val());
  // console.log('pacakage_id_fk:', $('#pacakage_id_fk').val());

  $.ajax({
    url: "<?php echo base_url('index.php/Leads/save_accommodation_plan'); ?>",
    type: "POST",
    data: postData,
    dataType: "json",
    success: function(res){
      // console.log('save_accommodation_plan response:', res);

      if(res.status){
        var leadtype = $('[name="lead_type_accomodation"]').val();
        if(leadtype == 'B2C'){
          reload_table_accomodation_b2c();
        }else{
          reload_table_accomodation_meta();
        }
        $('#accomodation_planModal').modal('hide');
      }else{
        alert((res.errors && res.errors.length) ? res.errors.join("\n") : (res.msg || 'Save failed'));
      }
    },
    error: function(xhr){
      console.log('SAVE ERROR:', xhr.responseText);
      alert('Save failed (server error)');
    }
  });
});

$(document).ready(function(){
// $("select[name='related_type']").onchange(function(){
$("#lead_type1").change(function() {


if($(this).val()=="B2C")
{
// alert("oo");
$('.staff_id_fk1').show();
$('.source_id_fk').show();
$('.guest_name').show();
$('.country_id_fk').show();
$('.priority_status_id_fk').show();
$('.stage_id_fk').show();
$('.date_type').show();
$('.stage_id_fk').show();
$('#hidden5').show();
$('.agent_id_fk').hide();
$('.total_package_cost').hide();
$('.expense').hide();
$('.margin').hide();
$('.description').hide();
$('.stage_flow_description').show();
$('.whats_number').show();
$('.alternative_number').show();
}
else
{
$('.staff_id_fk1').hide();
$('.source_id_fk').hide();
$('.guest_name').hide();
$('.country_id_fk').hide();
$('.priority_status_id_fk').hide();
$('.stage_id_fk').hide();
$('.date_type').hide();
$('.stage_id_fk').hide();
$('#hidden5').hide();
$('.agent_id_fk').show();
$('.total_package_cost').show();
$('.expense').show();
$('.margin').show();
$('.description').show();
$('.stage_flow_description').hide();
$('.whats_number').hide();
$('.alternative_number').hide();
}
});  
});

// $(document).ready(function () {

//     function toggleStartDate() {
//         let dateType = $('#date_type').val();

//         if (dateType === 'WITHOUT') {
//             $('#start_date1')
//                 .prop('disabled', true)
//                 .prop('required', false)
//                 .val('');
//         } else {
//             $('#start_date1')
//                 .prop('disabled', false)
//                 .prop('required', true);
//         }
//     }

//     // On change
//     $('#date_type').on('change', toggleStartDate);

//     // On page load
//     toggleStartDate();
// });

// $(document).ready(function () {

//     function toggleStartDate() {
//         let dateType = $('#date_type').val();

//         if (dateType === 'WITHOUT') {
//             $('#start_date1')
//                 .prop('disabled', true)
//                 .prop('required', false)
//                 .val('')
//                 .removeClass('is-invalid is-valid');

//             $('#start_date1').closest('.form-group').find('.help-block').html('');
//         } else if (dateType === 'WITH') {
//             $('#start_date1')
//                 .prop('disabled', false)
//                 .prop('required', true);
//         } else {
//             $('#start_date1')
//                 .prop('disabled', true)
//                 .prop('required', false)
//                 .val('')
//                 .removeClass('is-invalid is-valid');
//         }
//     }

//     $('#date_type').on('change', toggleStartDate);

//     $('#LeadsModal').on('shown.bs.modal', function () {
//         toggleStartDate();
//     });

// });

$(document).ready(function () {

    function toggleDateFields() {
        let dateType = $('#date_type').val();

        if (dateType === 'WITHOUT') {

            // Start Date
            $('#start_date1')
                .prop('disabled', true)
                .prop('required', false)
                .val('')
                .removeClass('is-invalid is-valid');

        } else if (dateType === 'WITH') {

            // Start Date
            $('#start_date1')
                .prop('disabled', false)
                .prop('required', true);

        } else {

            $('#start_date1')
                .prop('disabled', true)
                .prop('required', false)
                .val('')
                .removeClass('is-invalid is-valid');
        }
    }

    $('#date_type').on('change', toggleDateFields);

    $('#LeadsModal').on('shown.bs.modal', function () {
        toggleDateFields();
    });

});


// $(document).ready(function () {

//     function calculateEndDate() {
//         let dateType = $('#date_type').val();
//         let startDate = $('#start_date1').val();
//         let duration = parseInt($('#duration').val(), 10);

//         if (dateType === 'WITH' && startDate && duration > 0) {

//             // Split DD-MM-YYYY
//             let parts = startDate.split('-');
//             let day = parseInt(parts[0], 10);
//             let month = parseInt(parts[1], 10) - 1;
//             let year = parseInt(parts[2], 10);

//             let date = new Date(year, month, day);

//             // Add duration
//             date.setDate(date.getDate() + duration);

//             // Format YYYY-MM-DD
//             let formattedDate = date.toISOString().split('T')[0];

//             $('#end_date1').val(formattedDate);
//             $('#end_date_text').text(formattedDate);


//         } else {
//             $('#end_date1').val('');
//         }
//     }

//     $('#start_date1, #duration, #date_type').on('change keyup', calculateEndDate);
// });

$(document).ready(function () {

    function calculateEndDate() {

        let dateType  = $('#date_type').val();
        let startDate = $('#start_date1').val();
        let duration  = parseInt($('#duration').val(), 10);

        if (dateType === 'WITH' && startDate && duration > 0) {

            let separator = startDate.includes('/') ? '/' : '-';
            let parts = startDate.split(separator);

            let day   = parseInt(parts[0], 10);
            let month = parseInt(parts[1], 10) - 1;
            let year  = parseInt(parts[2], 10);

            let date = new Date(year, month, day);

            date.setDate(date.getDate() + duration);

            let dbDate = date.getFullYear() + '-' +
                String(date.getMonth() + 1).padStart(2, '0') + '-' +
                String(date.getDate()).padStart(2, '0');

            let displayDate =
                String(date.getDate()).padStart(2, '0') + '/' +
                String(date.getMonth() + 1).padStart(2, '0') + '/' +
                date.getFullYear();

            $('#end_date1').val(dbDate);

            // âœ… Show label with value
            $('#end_date_text')
                .removeClass('d-none')
                .text('Travel end date: ' + displayDate);

        } else {

            $('#end_date1').val('');

            // âŒ Hide label when no value
            $('#end_date_text')
                .addClass('d-none')
                .text('');
        }
    }

    $('#start_date1, #duration, #date_type').on('change keyup', calculateEndDate);

});
// Show modal when + Add new is clicked
window.checkAddNewSource = function(select) {
    if(select.value === '+') {
        var modal = new bootstrap.Modal(document.getElementById('AddSourceModal'));
        modal.show();
        select.value = ''; // reset dropdown temporarily
    }
}

// Save source via AJAX
let sourceSaved = false;

function saveSource() {
    let form = $('#addSourceForm')[0];
    if(!form.checkValidity()) {
        form.classList.add('was-validated');
        return;
    }

    let sourceName = $('#source_name_modal').val().trim();

    $.ajax({
        url: "<?php echo base_url('index.php/Leads/add_source'); ?>",
        type: 'POST',
        data: { source_name: sourceName },
        dataType: 'json',
        success: function(data) {
            if(data.status === 'success') {
                sourceSaved = true; // mark saved

                // Close modal
                let modalEl = document.getElementById('AddSourceModal');
                let modal = bootstrap.Modal.getInstance(modalEl);
                modal.hide();

                // Reset form
                form.reset();
                form.classList.remove('was-validated');

                // Add new option to dropdown and select it
                let select = $('#source_id_fk1');
                let newOption = new Option(data.source_name, data.source_id, true, true);
                select.append(newOption).val(data.source_id).trigger('change');

            } else {
                alert(data.message);
            }
        },
        error: function(err) {
            console.log(err);
        }
    });
}

// Reset dropdown ONLY if modal closed without saving
var sourceModalEl = document.getElementById('AddSourceModal');
sourceModalEl.addEventListener('hidden.bs.modal', function () {
    if(!sourceSaved) {
        let select = $('#source_id_fk1');
        select.val('').trigger('change');
    }
    $('#addSourceForm')[0].reset();
    $('#addSourceForm')[0].classList.remove('was-validated');
    sourceSaved = false;
});


// Show modal when + Add new is clicked
window.checkAddNewPriority = function(select) {
    if(select.value === '+') {
        var modal = new bootstrap.Modal(document.getElementById('AddPriorityModal'));
        modal.show();
        select.value = ''; // reset dropdown temporarily
    }
}

// Save priority status via AJAX
let prioritySaved = false;

function savePriorityStatus() {
    let form = $('#addPriorityForm')[0];
    if(!form.checkValidity()) {
        form.classList.add('was-validated');
        return;
    }

    let name = $('#priority_name_modal').val().trim();
    let color = $('#priority_color_modal').val();
    let description = $('#priority_description_modal').val().trim();

    // let button_html = `<center><span class="btn btn-sm" style="background-color:${color}"><span style="color:white">${name}</span></span></center>`;
    let button_html = `<span class="badge badge-sm light" style="background-color:${color}">${name}</span>`;

    $.ajax({
        url: "<?php echo base_url('index.php/Leads/add_priority_status'); ?>",
        type: 'POST',
        data: {
            priority_status_name: name,
            priority_status_button: button_html,
            priority_status_description: description
        },
        dataType: 'json',
        success: function(data) {
            if(data.status === 'success') {
                prioritySaved = true;

                // Close modal
                let modalEl = document.getElementById('AddPriorityModal');
                let modal = bootstrap.Modal.getInstance(modalEl);
                modal.hide();

                // Reset form
                form.reset();
                form.classList.remove('was-validated');

                // Add new option to dropdown and select it
                let select = $('#priority_status_id_fk');
                let newOption = new Option(name, data.priority_status_id, true, true);
                select.append(newOption).val(data.priority_status_id).trigger('change');

            } else {
                alert(data.message);
            }
        },
        error: function(err) {
            console.log(err);
        }
    });
}

// Reset dropdown ONLY if modal closed without saving
var priorityModalEl = document.getElementById('AddPriorityModal');
priorityModalEl.addEventListener('hidden.bs.modal', function () {
    if(!prioritySaved) {
        let select = $('#priority_status_id_fk');
        select.val('').trigger('change');
    }
    $('#addPriorityForm')[0].reset();
    $('#addPriorityForm')[0].classList.remove('was-validated');
    prioritySaved = false;
});


// Show modal when + Add new is clicked
function checkAddNewStage(select) {
    if(select.value === '+') {
        var modal = new bootstrap.Modal(document.getElementById('AddStageModal'));
        modal.show();
        select.value = ''; // reset dropdown temporarily
    }
}

// Save stage via AJAX
let stageSaved = false;

function saveStage() {
    let form = $('#addStageForm')[0];
    if(!form.checkValidity()) {
        form.classList.add('was-validated');
        return;
    }

    let name = $('#stage_name_modal').val().trim();
    let color = $('#stage_color_modal').val();
    let description = $('#stage_description_modal').val().trim();

    // let button_html = `<center><span class="btn btn-sm" style="background-color:${color}"><span style="color:white">${name}</span></span></center>`;
    let button_html = `<span class="badge badge-sm light" style="background-color:${color}">${name}</span>`;

    $.ajax({
        url: "<?php echo base_url('index.php/Leads/add_stage'); ?>",
        type: "POST",
        data: {
            stages_name: name,
            stages_button: button_html,
            stages_description: description
        },
        dataType: "json",
        success: function(data) {
            if(data.status === 'success') {
                stageSaved = true; // mark that save was successful

                // Close modal
                let modalEl = document.getElementById('AddStageModal');
                let modal = bootstrap.Modal.getInstance(modalEl);
                modal.hide();

                // Reset form
                form.reset();
                form.classList.remove('was-validated');

                // Add new option to dropdown and select it
                let select = $('#stage_id_fk'); // your stage dropdown
                let newOption = new Option(name, data.stages_id, true, true);
                select.append(newOption).val(data.stages_id).trigger('change');
            } else {
                alert(data.message);
            }
        },
        error: function(err) {
            console.log(err);
        }
    });
}

// Reset dropdown ONLY if user closed without saving
// var stageModalEl = document.getElementById('AddStageModal');
// stageModalEl.addEventListener('hidden.bs.modal', function () {
//     if(!stageSaved) { // only reset if modal closed without saving
//         let select = document.getElementById('stage_id_fk');
//         select.value = "";
//         if ($(select).hasClass("select2-hidden-accessible")) {
//             $(select).val("").trigger('change');
//         }
//     }
//     // always reset form validation
//     document.getElementById('addStageForm').reset();
//     document.getElementById('addStageForm').classList.remove('was-validated');
//     stageSaved = false; // reset flag for next time
// });

///// Disable package if duration is less than 1 //////

// var edit_package_id = null;
// var packageAjaxTimer = null;
// var isEditModeLoading = false;

// function resetPackageDropdown(disabled, message) {
//     $('#package_id_fk')
//         .html('<option value="">Please Select Templates</option>')
//         .val('')
//         .prop('disabled', disabled)
//         .trigger('change.select2');

//     if (message) {
//         $('#package_msg').removeClass('d-none').text(message);
//     } else {
//         $('#package_msg').addClass('d-none').text('');
//     }
// }

// function loadPackagesByDuration(duration, selectedPackageId) {

//     selectedPackageId = selectedPackageId ? String(selectedPackageId) : '';

//     $('#package_msg').addClass('d-none').text('');

//     if (isNaN(duration) || duration <= 0) {
//         resetPackageDropdown(true, 'Please enter a duration greater than 0.');
//         return;
//     }

//     $('#package_id_fk').prop('disabled', true);

//     $.ajax({
//         url: "<?php echo base_url('index.php/Leads/get_packages_by_duration'); ?>",
//         type: "POST",
//         dataType: "json",
//         data: { duration: duration },
//         success: function (response) {

//             var options = '<option value="">Please Select Templates</option>';

//             if (response && response.length > 0) {

//                 $.each(response, function (i, pkg) {
//                     options += '<option value="' + pkg.packages_id + '">' + pkg.packages_title + '</option>';
//                 });

//                 $('#package_id_fk')
//                     .html(options)
//                     .prop('disabled', false);

//                 setTimeout(function () {

//                     if (selectedPackageId !== '') {
//                         $('#package_id_fk').val(selectedPackageId).trigger('change.select2');
//                     } else {
//                         $('#package_id_fk').val('').trigger('change.select2');
//                     }

//                 }, 100);

//             } else {
//                 resetPackageDropdown(true, 'No template available for selected duration.');
//             }
//         },
//         error: function () {
//             resetPackageDropdown(true, 'Something went wrong. Please try again.');
//         }
//     });
// }

// $(document).ready(function () {

//     $('#package_id_fk').select2({
//         dropdownParent: $('#LeadsModal'),
//         width: '100%',
//         minimumResultsForSearch: 0
//     });

//     $('#duration').on('input change keyup', function () {

//         if (isEditModeLoading) {
//             return;
//         }

//         var duration = parseInt($(this).val(), 10);

//         clearTimeout(packageAjaxTimer);

//         packageAjaxTimer = setTimeout(function () {
//             loadPackagesByDuration(duration, '');
//         }, 300);
//     });

// });

var packageAjaxTimer = null;
var isEditModeLoading = false;

function resetPackageDropdown(disabled, message) {
    $('#package_id_fk')
        .html('<option value="">Please Select Templates</option>')
        .val('')
        .prop('disabled', disabled)
        .trigger('change.select2');

    if (message) {
        $('#package_msg').removeClass('d-none').text(message);
    } else {
        $('#package_msg').addClass('d-none').text('');
    }
}

function emptyPackageDropdown(message) {
    $('#package_id_fk')
        .html('<option value="">Please Select Template</option>')
        .val('')
        .prop('disabled', true)
        .trigger('change.select2');

    if (message) {
        $('#package_msg').removeClass('d-none').text(message);
    } else {
        $('#package_msg').addClass('d-none').text('');
    }
}

function loadPackagesByFilter(selectedPackageId) {
    selectedPackageId = selectedPackageId ? String(selectedPackageId) : '';

    var duration  = parseInt($('#duration').val(), 10);
    var category  = $('#leads_package_category_id_fk').val();
    var createdby = $('#package_created_by_staff_id').val();

    duration = isNaN(duration) ? 0 : duration;
    category = category ? parseInt(category, 10) : 0;
    createdby = createdby ? parseInt(createdby, 10) : 0;

    if (duration <= 0 && category <= 0 && createdby <= 0) {
        emptyPackageDropdown('Please enter duration or select category or created by staff.');
        return;
    }

    $('#package_msg').addClass('d-none').text('');
    $('#package_id_fk').prop('disabled', true);

    $.ajax({
        url: "<?php echo base_url('index.php/Leads/get_packages_by_filter'); ?>",
        type: "POST",
        dataType: "json",
        data: {
            duration: duration,
            category: category,
            createdby: createdby
        },
        success: function (response) {
            var options = '<option value="">Please Select Template</option>';

            if (response && response.length > 0) {
                $.each(response, function (i, pkg) {
                    options += '<option value="' + pkg.packages_id + '">' + pkg.packages_title + '</option>';
                });

                $('#package_id_fk')
                    .html(options)
                    .prop('disabled', false);

                if (selectedPackageId && $('#package_id_fk option[value="' + selectedPackageId + '"]').length) {
                    $('#package_id_fk').val(selectedPackageId).trigger('change');
                } else {
                    $('#package_id_fk').val('').trigger('change');
                }
            } else {
                emptyPackageDropdown('No template available for selected filter.');
            }
        },
        error: function () {
            emptyPackageDropdown('Something went wrong. Please try again.');
        }
    });
}

$(document).ready(function () {
    $('#package_id_fk').select2({
        dropdownParent: $('#LeadsModal'),
        width: '100%',
        minimumResultsForSearch: 0
    });

    emptyPackageDropdown('');

    $('#duration, #leads_package_category_id_fk, #package_created_by_staff_id').on('input change keyup', function () {
        if (isEditModeLoading) return;

        clearTimeout(packageAjaxTimer);
        packageAjaxTimer = setTimeout(function () {
            loadPackagesByFilter('');
        }, 300);
    });
});

var packageHasProperties = false;

$('#package_id_fk').on('change', function () {
    var packageId = $(this).val();

    packageHasProperties = false;

    $('#package_properties_msg')
        .addClass('d-none')
        .text('');

    if (!packageId) {
        return;
    }

    $.ajax({
        url: "<?php echo base_url('index.php/Leads/check_package_properties'); ?>",
        type: "POST",
        dataType: "json",
        data: {
            package_id: packageId
        },
        success: function (res) {
            if (res.status && res.has_properties) {
                packageHasProperties = true;

                $('#package_properties_msg')
                    .addClass('d-none')
                    .text('');
            } else {
                packageHasProperties = false;

                $('#package_properties_msg')
                    .removeClass('d-none')
                    .text(res.msg || 'Selected template does not have properties saved. Please update properties.');
            }
        },
        error: function () {
            packageHasProperties = false;

            $('#package_properties_msg')
                .removeClass('d-none')
                .text('Unable to check template properties. Please try again.');
        }
    });
});

$('#package_id_fk').on('change', function () {

    if (isEditModeLoading || allowPackageRollback) {
        return;
    }

    var leadId = $('#id').val();
    var selectedPackageId = $(this).val();

    $('#package_change_msg')
        .addClass('d-none')
        .text('');

    if (!leadId || save_method !== 'update') {
        return;
    }

    if (!previous_saved_package_id || selectedPackageId === previous_saved_package_id) {
        return;
    }

    $.ajax({
        url: "<?php echo base_url('index.php/Leads/check_lead_active_quotation'); ?>",
        type: "POST",
        dataType: "json",
        data: {
            lead_id: leadId
        },
        success: function (res) {

            if (res.status && res.has_active_quotation) {

                $('#package_change_msg')
                    .removeClass('d-none')
                    .text('Other templates could not select already quotation is created using this template.');

                allowPackageRollback = true;

                $('#package_id_fk')
                    .val(previous_saved_package_id)
                    .trigger('change.select2');

                allowPackageRollback = false;
            }
        },
        error: function () {

            $('#package_change_msg')
                .removeClass('d-none')
                .text('Unable to validate quotation. Please try again.');

            allowPackageRollback = true;

            $('#package_id_fk')
                .val(previous_saved_package_id)
                .trigger('change.select2');

            allowPackageRollback = false;
        }
    });
});

function checkLeadTravelDetails(lead_id, callback)
{
    $.ajax({
        url: "<?php echo base_url('index.php/Leads/ajax_check_lead_travel_details/'); ?>" + lead_id,
        type: "GET",
        dataType: "JSON",
        success: function(res) {
            if (res.status) {
                callback();
                return;
            }

            var missingHtml = '';

            if (res.missing && res.missing.length > 0) {
                missingHtml = '<ul class="text-start mb-0">';
                $.each(res.missing, function(i, item) {
                    missingHtml += '<li><strong class="text-danger">' + item + '</strong> is missing</li>';
                });
                missingHtml += '</ul>';
            } else {
                missingHtml = '<strong class="text-danger">' + (res.message || 'Required details are missing.') + '</strong>';
            }

            Swal.fire({
                icon: 'warning',
                title: 'Travel Details Missing',
                html: `
                    <div class="text-start">
                        <p class="mb-2">Kindly update the following details before continuing:</p>
                        ${missingHtml}
                    </div>
                `,
                confirmButtonText: 'OK'
            });
        },
        error: function() {
            Swal.fire({
                icon: 'error',
                title: 'Validation Failed',
                text: 'Unable to validate travel details. Please try again.'
            });
        }
    });
}

function open_guest_count_checked(lead_id)
{
    checkLeadTravelDetails(lead_id, function() {
        guset_count_edit(lead_id);
    });
}

function open_accommodation_checked(lead_id)
{
    checkLeadTravelDetails(lead_id, function() {
        accomodation_plan(lead_id);
    });
}

function checkActiveQuotationAndRollback(fieldName)
{
    if (allowRollback || save_method !== 'update') return;

    var leadId = $('#id').val();
    if (!leadId) return;

    $.ajax({
        url: "<?php echo base_url('index.php/Leads/check_lead_active_quotation'); ?>",
        type: "POST",
        dataType: "json",
        data: { lead_id: leadId },
        success: function(res) {
            if (res.status && res.has_active_quotation) {

                allowRollback = true;

                $('#package_id_fk').val(previous_saved_package_id).trigger('change.select2');
                $('#start_date1').val(previous_start_date);
                $('#duration').val(previous_duration);
                $('#end_date1').val(previous_end_date);

                showEditEndDate(previous_end_date);

                allowRollback = false;

                Swal.fire({
                    icon: 'warning',
                    title: 'Cannot Change',
                    text: fieldName + ' could not be changed because a quotation is already created using this template.'
                });
            }
        }
    });
}

$('#start_date1, #duration').on('change keyup', function () {

    if (allowRollback || isEditModeLoading || save_method !== 'update') return;

    var currentStart = $('#start_date1').val();
    var currentDuration = $('#duration').val();

    if (
        currentStart !== previous_start_date ||
        currentDuration !== previous_duration
    ) {
        checkActiveQuotationAndRollback('Travel date or duration');
    }
});

function showEditEndDate(endDate)
{
    if (endDate && endDate !== '0000-00-00' && endDate !== '1970-01-01') {
        var parts = endDate.split('-');

        if (parts.length === 3) {
            $('#end_date_text')
                .removeClass('d-none')
                .text('Travel end date: ' + parts[2] + '/' + parts[1] + '/' + parts[0]);
        }
    } else {
        $('#end_date_text').addClass('d-none').text('');
    }
}

$('#start_date1').on('focus click', function (e) {

    let dateType = $('#date_type').val();

    if (dateType !== 'WITH') {

        e.preventDefault();

        Swal.fire({
            icon: 'warning',
            title: 'Select Date Type',
            text: 'Please select date type to enable travel date.'
        });

        return false;
    }
});

function openChangeStatusModal(lead_id)
{
    $('#changeStatusForm')[0].reset();
    $('#stage_id').empty();

    $.ajax({
      url: "<?php echo base_url('index.php/Leads/getLeadStageData'); ?>",
      type: "POST",
      data: { lead_id: lead_id },
      dataType: "json",
      success: function(res)
      {
          $('#lead_id').val(lead_id);
          $('#prev_stage_id').val(res.current_stage_id);
          $('#lead_type_stutus').val(res.lead_type);

          $('#stage_id').empty(); // clear old data

          $('#stage_id').append(`<option value="+">+ Add New</option>`);

          $.each(res.stages, function(i, stage) {

              let selected = (String(stage.stages_id) === String(res.current_stage_id)) 
                              ? 'selected' 
                              : '';

              $('#stage_id').append(
                  `<option value="${stage.stages_id}" ${selected}>
                      ${stage.stages_name}
                  </option>`
              );
          });

          $('#ChangeStatusModal').modal('show');
      }
  });
}


function reload_table_status()
{
    $table1.ajax.reload(null,false); //reload datatable ajax 


        swal("Leads stage updated successfully", "", "success")
         $('#ChangeStatusModal').modal('hide');
    
}

function reload_table_status_meta()
{
    $table2.ajax.reload(null,false); //reload datatable ajax 


        swal("Leads stage updated successfully", "", "success")
         $('#ChangeStatusModal').modal('hide');
    
}

function saveChangeStatus() {
    let cur_stage  = $('#stage_id').val();
    let prev_stage = $('#prev_stage_id').val();

    if (!cur_stage) {
        // Swal.fire('Required', 'Please select a stage', 'warning');
        swal("Please select a stage", "", "warning")
        return;
    }

    if (String(cur_stage) === String(prev_stage)) {
        // Swal.fire({
        //     icon: 'warning',
        //     title: 'No Change Detected',
        //     text: 'Please select a different status'
        // });
        swal("Please select a different stage", "", "error")
        return;
    }

    $.ajax({
        url: "<?php echo base_url('index.php/Leads/saveStageFlow'); ?>",
        type: "POST",
        data: $('#changeStatusForm').serialize(),
        dataType: "json",
        success: function(res) {
            if (res.status) {
                // Swal.fire('Success', 'Status changed successfully', 'success')
                //     .then(() => location.reload());
                

                var leadtype = $('[name="lead_type_stutus"]').val();
                if(leadtype == 'B2C'){
                  reload_table_status();
                }else{
                 reload_table_status_meta();
                }
            } else {
                Swal.fire('Error', res.message, 'error');
            }
        }
    });
}

///////////// change status 1 //////////////

function openChangeStatus1Modal(lead_id)
{
    $('#changeStatusForm1')[0].reset();
    $('#status').empty();

    $.ajax({
      url: "<?php echo base_url('index.php/Leads/getLeadStatusData'); ?>",
      type: "POST",
      data: { lead_id: lead_id },
      dataType: "json",
      success: function(res)
      {
          $('#lead_id1').val(lead_id);
          $('#prev_status').val(res.current_status);
          $('#lead_type_stutus1').val(res.lead_type);

          $('#status').empty(); // clear old data

          $.each(res.status, function(i, statu) {
              // Compare current lead status with the loop status to auto-select
              let selected = (String(statu.lead_current_status) === String(res.current_status)) 
                              ? 'selected' 
                              : '';

              $('#status').append(
                  `<option value="${statu.lead_current_status}" ${selected}>
                      ${statu.status_name}
                  </option>`
              );
          });

          $('#ChangeStatus1Modal').modal('show');
      }
  });
}


function reload_table_status1()
{
    $table1.ajax.reload(null,false); //reload datatable ajax 


        swal("Leads stage updated successfully", "", "success")
         $('#ChangeStatus1Modal').modal('hide');
    
}

function reload_table_status_meta1()
{
    $table2.ajax.reload(null,false); //reload datatable ajax 


        swal("Leads stage updated successfully", "", "success")
         $('#ChangeStatus1Modal').modal('hide');
    
}

function saveChangeStatus1() {
    let cur_status  = $('#status').val();
    let prev_status = $('#prev_status').val();

    if (!cur_status) {
        // Swal.fire('Required', 'Please select a stage', 'warning');
        swal("Please select a status", "", "warning")
        return;
    }

    if (String(cur_status) === String(prev_status)) {
        // Swal.fire({
        //     icon: 'warning',
        //     title: 'No Change Detected',
        //     text: 'Please select a different status'
        // });
        swal("Please select a different status", "", "error")
        return;
    }

    $.ajax({
        url: "<?php echo base_url('index.php/Leads/saveStatusFlow'); ?>",
        type: "POST",
        data: $('#changeStatusForm1').serialize(),
        dataType: "json",
        success: function(res) {
            if (res.status) {
                // Swal.fire('Success', 'Status changed successfully', 'success')
                //     .then(() => location.reload());
                

                var leadtype = $('[name="lead_type_stutus1"]').val();
                if(leadtype == 'B2C'){
                  reload_table_status1();
                }else{
                 reload_table_status_meta1();
                }
            } else {
                Swal.fire('Error', res.message, 'error');
            }
        }
    });
}

// Show modal when + Add new is clicked

function checkAddNewStage(select) {
    if (select.value === '+') {

        stagelistingSaved = false; // reset here âœ”ï¸

        const addModal = new bootstrap.Modal(
            document.getElementById('AddStageModal'),
            { backdrop: false }
        );
        addModal.show();

        $(select).val(null).trigger('change.select2');
    }
}


$('#stage_id').select2({
    dropdownParent: $('#ChangeStatusModal'),
    width: '100%'
});

$('#status').select2({
    dropdownParent: $('#ChangeStatus1Modal'),
    width: '100%'
});

// Save stage via AJAX
let stagelistingSaved = false;

function saveStagelisting() {
    let form = $('#addStageForm')[0];

    // âœ… Validate form
    if (!form.checkValidity()) {
        form.classList.add('was-validated');
        return;
    }

    let name = $('#stage_name_modal').val().trim();
    let color = $('#stage_color_modal').val();
    let description = $('#stage_description_modal').val().trim();

    // let button_html = `<center><span class="btn btn-sm" style="background-color:${color}"><span style="color:white">${name}</span></span></center>`;

    let buton_html = `<center><span class="btn btn-sm" style="background-color:${color}"><span style="color:white">${name}</span></span></center>`;

    $.ajax({
        url: "<?php echo base_url('index.php/Leads/add_stage'); ?>",
        type: "POST",
        data: {
            stages_name: name,
            stages_button: button_html,
            stages_description: description
        },
        dataType: "json",
        success: function (data) {
            if (data.status === 'success') {

                // mark as successfully saved
                stagelistingSaved = true;

                // close only AddStageModal
                const modalEl = document.getElementById('AddStageModal');
                const modal = bootstrap.Modal.getInstance(modalEl);
                modal.hide();

                // reset form validation
                form.reset();
                form.classList.remove('was-validated');

                // âœ… Add new stage to ChangeStatusModal dropdown
                let $select = $('#stage_id');
                let newOption = new Option(
                    data.stages_name,
                    data.stages_id,
                    true,   // defaultSelected
                    true    // selected
                );
                $select.append(newOption).trigger('change.select2');

            } else {
                alert(data.message);
            }
        },
        error: function(err) {
            console.log(err);
        }
    });
}



// Reset dropdown ONLY if user closed without saving
var stageModalEl = document.getElementById('AddStageModal');

$('#AddStageModal').on('hidden.bs.modal', function () {
    let $select = $('#stage_id');
    let currentVal = $select.val();  // what is currently selected
    let prevVal = $('#prev_stage_id').val(); // previous stage

    // Only restore if nothing is selected
    if (!currentVal) {
        $select.val(prevVal).trigger('change.select2');
    }

    // Always reset the rest of the form
    $(this).find('form')[0].reset();
    $(this).find('form').removeClass('was-validated');
});


///// show stage history //////////

function showStatus1Modal(lead_id) {
    let $tbody = $('#statusHistoryTable tbody');
    $tbody.empty(); // clear previous rows

    $.ajax({
        url: "<?php echo base_url('index.php/Leads/getStatusHistory'); ?>",
        type: "POST",
        data: { lead_id: lead_id },
        dataType: "json",
        success: function(res) {
    if(res.status && res.history.length > 0) {
        
        // ðŸ”¹ Define the color mapping
        const statusColors = {
            'In take': 'btn-info',
            'Qualified': 'btn-secondary',
            'Converted to trip': 'btn-success',
            'Not Qualified': 'btn-warning',
            'Lost': 'btn-danger'
        };

        res.history.forEach((row, index) => {
            // Get class for current and previous status (defaults to btn-light if not found)
            let curClass = statusColors[row.status_flow_cur] || 'btn-light';
            let prevClass = statusColors[row.status_flow_prev] || 'btn-light';

            let dateParts = row.status_flow_created_date.split('-');
            let formattedDate = dateParts[2] + '/' + dateParts[1] + '/' + dateParts[0];

            let timeParts = row.status_flow_created_time.split(':');
            let hour = parseInt(timeParts[0]);
            let ampm = hour >= 12 ? 'PM' : 'AM';
            hour = hour % 12 || 12;
            let formattedTime = hour + ':' + timeParts[1] + ' ' + ampm;

            // ðŸ”¹ Wrap the status text in a <span> with the badge/button class
            let tr = `<tr>
                <td>${index + 1}</td>
                <td><span class="badge ${curClass}">${row.status_flow_cur}</span></td>
                <td><span class="badge ${prevClass}">${row.status_flow_prev}</span></td>
                <td>${row.status_flow_description || '-'}</td>
                <td>${row.status_flow_created_username}</td>
                <td>${formattedDate}</td>
                <td>${formattedTime}</td>
            </tr>`;

            $tbody.append(tr);
        });
    } else {
        $tbody.append(`<tr><td colspan="7" class="text-center">No history found</td></tr>`);
    }
    // ... rest of your code

            // Show modal
            let modal = new bootstrap.Modal(document.getElementById('StatusHistoryModal'));
            modal.show();
        },
        error: function(err) {
            console.log(err);
            alert('Error fetching stage history');
        }
    });
}


///// show status history //////////

function showStatusModal(lead_id) {
    let $tbody = $('#stageHistoryTable tbody');
    $tbody.empty(); // clear previous rows

    $.ajax({
        url: "<?php echo base_url('index.php/Leads/getStageHistory'); ?>",
        type: "POST",
        data: { lead_id: lead_id },
        dataType: "json",
        success: function(res) {
            if(res.status && res.history.length > 0) {
                res.history.forEach((row, index) => {

                    // ðŸ”¹ Format Date: YYYY-MM-DD â†’ DD/MM/YYYY
                    let dateParts = row.stage_flow_created_date.split('-');
                    let formattedDate = dateParts[2] + '/' + dateParts[1] + '/' + dateParts[0];

                    // ðŸ”¹ Format Time: HH:MM:SS â†’ 12-hour format with AM/PM
                    let timeParts = row.stage_flow_created_time.split(':');
                    let hour = parseInt(timeParts[0]);
                    let minute = timeParts[1];
                    let ampm = hour >= 12 ? 'PM' : 'AM';
                    hour = hour % 12;
                    hour = hour ? hour : 12; // convert 0 â†’ 12
                    let formattedTime = hour + ':' + minute + ' ' + ampm;

                    let tr = `<tr>
                        <td>${index + 1}</td>
                        <td>${row.current_stage_name}</td>
                        <td>${row.prev_stage_name}</td>
                        <td>${row.stage_flow_description || '-'}</td>
                        <td>${row.stage_flow_created_username}</td>
                        <td>${formattedDate}</td>
                        <td>${formattedTime}</td>
                    </tr>`;

                    $tbody.append(tr);
                });
            } else {
                $tbody.append(`<tr><td colspan="7" class="text-center">No history found</td></tr>`);
            }

            // Show modal
            let modal = new bootstrap.Modal(document.getElementById('StageHistoryModal'));
            modal.show();
        },
        error: function(err) {
            console.log(err);
            alert('Error fetching stage history');
        }
    });
}



/// set india is selected in dropdown
$(document).ready(function () {

    let hiddenVal = $('#id').val();

    if (!hiddenVal) {   // null, empty, or undefined
        // $('#country_id_fk').val('99').trigger('change');
        //  $('[id="country_id_fk"]').val('99').trigger('change.select2');
    }

});



<?php include(APPPATH . 'views/Quotation/quotation_modal_script.php'); ?>

</script>
