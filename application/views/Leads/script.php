<script>
    ////***Latest dropdown select2*****///

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

    // Source — AJAX with fixed '+ Add new' prepended
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

    // Priority status — AJAX with fixed '+ Add new' prepended
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
                                {
                                    extend: 'pdf',
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
                                {
                                    extend: 'pdf',
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

     // ✅ RESET ALL VALIDATION STATES
    packageHasProperties = false;
    previous_saved_package_id = '';
    allowPackageRollback = false;

    // ✅ HIDE MESSAGES
    $('#package_properties_msg')
        .addClass('d-none')
        .text('');

    $('#package_change_msg')
        .addClass('d-none')
        .text('');

    $('#package_msg')
        .addClass('d-none')
        .text('');

    // ✅ CLEAR END DATE DISPLAY
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

// ✅ Show end date if exists
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

//     if (!allValid) return; // 🚫 stop submit

//     // ✅ proceed with save
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

if (packageId && packageHasProperties === false) {
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

                // ✅ after new lead save, open guest count modal
                // if (isAdd && data.lead_id) {
                //     guset_count(data.lead_id);
                // }
                // ✅ after new lead save, open guest count modal only if travel/template details exist
                if (isAdd && data.lead_id) {
                    checkLeadTravelDetails(data.lead_id, function () {
                        guset_count(data.lead_id);
                    });
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

    if (!allValid) return; // 🚫 stop submit

    // ✅ proceed with save
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

            // ✅ Travel Back label
            let travelBackFlag = $.trim(String(day.packages_itineraries_days_travel_back || '')).toUpperCase();
            let isTravelBack = (travelBackFlag === 'TB');


            let dayText = day.packages_itineraries_days_day || ('Day ' + (i + 1));

            // only for display
            let dayLabel = isTravelBack
                ? dayText + ' - Travel Back'
                : dayText;

            // ✅ default accommodation status = Required
            let selectedStatus = ex
                ? ex.accomodation_required_staus
                : 'R';

            // ✅ default destination from itinerary day
            let selectedDestination = ex
                ? ex.stay_destination_id_fk
                : (day.packages_itineraries_days_destination_id_fk || '');

            // ✅ default meal plan = 1 (CP)
            let selectedMeal = ex
                ? ex.meal_plan_id_fk
                : '1';

            // ✅ default pax plan for Same guest count
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

//             // ✅ always reset first
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
        ${removable ? '<button type="button" class="btn btn-sm btn-danger remove-plan ms-2">×</button>' : ''}
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
//    // ✅ EDIT MODE must fetch existing guest count
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

// ✅ make available outside DOMContentLoaded
window.resetGuestCountModal = resetGuestCountModal;
window.loadSameGuest = loadSameGuest;
window.loadDifferentGuest = loadDifferentGuest;

function openGuestCountModal(leadId) {

    // ✅ always reset first
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
    loadDifferentGuest(true); // you’ll adjust loadDifferentGuest to accept "skip default add"
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
      ${removable ? '<button type="button" class="btn btn-sm btn-danger remove-plan ms-2">×</button>' : ''}
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
        <td><button type="button" class="btn btn-sm btn-danger remove-child">×</button></td>
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
      validateAllPlans(); // ✅ IMPORTANT
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

    // ✅ Remove child row (delegated) + revalidate
    childRow.addEventListener('click', function(e){
      const btn = e.target.closest('.remove-child');
      if(!btn) return;

      const tr = btn.closest('tr.child-row');
      if(!tr) return;

      tr.remove();
      validatePlanRealtime();  // ✅ IMPORTANT
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
      <td><button type="button" class="btn btn-sm btn-danger remove-child">×</button></td>
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

  // ⛔ stop save
  if (hasError) return;

  // ✅ proceed to AJAX
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

        // ✅ open accommodation plan modal after guest count save
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

  // ✅ destination is now hidden input
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


// ✅ IMPORTANT: make function callable from onclick in datatable
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

            // Duration
            $('#duration')
                .prop('disabled', true)
                .prop('required', false)
                .val('')
                .removeClass('is-invalid is-valid');

        } else if (dateType === 'WITH') {

            // Start Date
            $('#start_date1')
                .prop('disabled', false)
                .prop('required', true);

            // Duration
            $('#duration')
                .prop('disabled', false)
                .prop('required', true);

        } else {

            $('#start_date1, #duration')
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

            date.setDate(date.getDate() + (duration - 1));

            let dbDate = date.getFullYear() + '-' +
                String(date.getMonth() + 1).padStart(2, '0') + '-' +
                String(date.getDate()).padStart(2, '0');

            let displayDate =
                String(date.getDate()).padStart(2, '0') + '/' +
                String(date.getMonth() + 1).padStart(2, '0') + '/' +
                date.getFullYear();

            $('#end_date1').val(dbDate);

            // ✅ Show label with value
            $('#end_date_text')
                .removeClass('d-none')
                .text('Travel end date: ' + displayDate);

        } else {

            $('#end_date1').val('');

            // ❌ Hide label when no value
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
                    $('#package_id_fk').val(selectedPackageId).trigger('change.select2');
                } else {
                    $('#package_id_fk').val('').trigger('change.select2');
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

$('#start_date1, #duration').on('focus click', function (e) {

    let dateType = $('#date_type').val();

    if (dateType !== 'WITH') {

        e.preventDefault();

        Swal.fire({
            icon: 'warning',
            title: 'Select Date Type',
            text: 'Please select date type to enable travel date and duration.'
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

        stagelistingSaved = false; // reset here ✔️

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

    // ✅ Validate form
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

                // ✅ Add new stage to ChangeStatusModal dropdown
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
        
        // 🔹 Define the color mapping
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

            // 🔹 Wrap the status text in a <span> with the badge/button class
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

                    // 🔹 Format Date: YYYY-MM-DD → DD/MM/YYYY
                    let dateParts = row.stage_flow_created_date.split('-');
                    let formattedDate = dateParts[2] + '/' + dateParts[1] + '/' + dateParts[0];

                    // 🔹 Format Time: HH:MM:SS → 12-hour format with AM/PM
                    let timeParts = row.stage_flow_created_time.split(':');
                    let hour = parseInt(timeParts[0]);
                    let minute = timeParts[1];
                    let ampm = hour >= 12 ? 'PM' : 'AM';
                    hour = hour % 12;
                    hour = hour ? hour : 12; // convert 0 → 12
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



///////////////////////////////////////////////////**************** Quotation ***************////////////////////////////

$('#quotation_date').datepicker({
    format: 'dd-mm-yyyy',
    autoclose: true,
    todayHighlight: true
});

function resetQuotationModalForm() {

    // reset native form
    // var form = document.getElementById('form5');
    // if (form) {
    //     form.reset();
    // }

    // hidden ids
    // $('#id').val('');
    // $('#leads_id_hidden').val('');
    // $('#packages_id_hidden').val('');

    // // if visible dropdowns exist
    // if ($('#leads_id').length) {
    //     $('#leads_id').val('').trigger('change');
    // }
    // if ($('#packages_id_fk').length) {
    //     $('#packages_id_fk').val('').trigger('change');
    // }

    // clear select2 fields inside modal
    // $('#QuotationModal').find('select').each(function () {
    //     $(this).val('').trigger('change');
    // });

    // reset option blocks
    if ($('#optionsContainer').length) {
        $('#optionsContainer').html('');
    }
    if ($('.optionBlockContainer').length) {
        $('.optionBlockContainer').html('');
    }

    // reset counters
    if (typeof optionCount !== 'undefined') {
        optionCount = 0;
    }

    // reset inclusion table
    var $incTbody = $('#inclusionTable tbody');
    if ($incTbody.length) {
        $incTbody.find('tr:gt(0)').remove();

        var $firstInc = $incTbody.find('tr:eq(0)');
        $firstInc.find('input').val('');
        $firstInc.find('select').each(function () {
            $(this).html('<option value="">Select</option>').val('').trigger('change');
        });
        $firstInc.find('.removeInclusionBtn').prop('disabled', true);
    }

    // reset special requirement table
    var $spTbody = $('#specialReqTable tbody');
    if ($spTbody.length) {
        $spTbody.find('tr:gt(0)').remove();

        var $firstSp = $spTbody.find('tr:eq(0)');
        $firstSp.find('input').val('');
        $firstSp.find('select').each(function () {
            // $(this).html('<option value="">Select</option>').val('').trigger('change');
            $(this).html('<option value="">Select</option>').val('').trigger('change.select2');
        });
        $firstSp.find('.removeSpecialReqBtn').prop('disabled', true);
    }

    // uncheck and hide addon boxes
    $('#quotation_property_inclusion_type').prop('checked', false);
    $('#quotation_special_requirement_type').prop('checked', false);
    $('#inclusionBox').hide();
    $('#specialReqBox').hide();

    // reset totals
    $('#totalInclusionAmountText').text('0.00');
    $('#totalInclusionAmountInput').val('0');

    $('#totalSpecialReqAmountText').text('0.00');
    $('#totalSpecialReqAmountInput').val('0');

    // reset runtime arrays if used
    if (typeof __dayOptions !== 'undefined') __dayOptions = [];
    if (typeof __specialReqOptions !== 'undefined') __specialReqOptions = [];
    if (typeof __dayPropertyMap !== 'undefined') __dayPropertyMap = {};
    if (typeof __propertyInclusionMap !== 'undefined') __propertyInclusionMap = {};

    // button reset
    $('#btnSave').text('save').prop('disabled', false);

    // remove invalid classes
    $('#QuotationModal').find('.is-invalid').removeClass('is-invalid');
}

$('#QuotationModal').on('hidden.bs.modal', function () {
    resetQuotationModalForm();
});

function open_quotation(leadId) {
resetQuotationModalForm();
  // Reset the form (optional)
  var form = document.getElementById('form5');
  if (form) form.reset();

  // Clear payload UI containers if you have any
  // $('.optionBlockContainer').empty();

  // Disable save until lead is loaded
  $('#btnSave').prop('disabled', true);

$('.modal-title-quote').text('Add Quotation Details'); // Set Title to Bootstrap modal title

// Set current date in textbox
var today = new Date();
var dd = String(today.getDate()).padStart(2, '0');
var mm = String(today.getMonth() + 1).padStart(2, '0'); // January is 0
var yyyy = today.getFullYear();

var formattedDate = dd + '-' + mm + '-' + yyyy;
$('#quotation_date').val(formattedDate);
  // Fetch lead (gives package_id_fk)
  $.ajax({
    url: "<?php echo base_url('index.php/Leads/ajax_edit/'); ?>" + leadId,
    type: "GET",
    dataType: "JSON",
    success: function(res) {

      var packageId = res && res.package_id_fk ? res.package_id_fk : '';

      if (!packageId) {
        alert('This lead does not have a template assigned (package_id_fk is empty).');
        return;
      }


      // ✅ set hidden ids
      $('#leads_id_hidden').val(leadId);
      $('#packages_id_hidden').val(packageId);

      loadInclusionAndRequirementDropdownData();   // ✅ now will work (after you fixed IDs inside it)
      // (optional) show lead info in modal header
      // $('#leadNameText').text(res.leads_name || res.leads_number || leadId);

      // Hide dropdown row in this Leads-page modal version
      $('#leadPackageRow').addClass('d-none');

      // Open modal (Bootstrap 4 vs 5 safe)
      $('#QuotationModal').modal('show');

      // Enable save
      $('#btnSave').prop('disabled', false);

      // ✅ prepare: when user clicks "Add New Option", load package options based on hidden package id
      // (we attach once)
      bindAddOptionBtnOnce();

    },
    error: function() {
      alert('Failed to load lead details.');
    }
  });
}


var __addOptionBound = false;

function bindAddOptionBtnOnce() {
  if (__addOptionBound) return;
  __addOptionBound = true;

  // bind inside modal (safer than document)
  $('#QuotationModal').on('click', '#addOptionBtn', function (e) {
    e.preventDefault();
    e.stopPropagation();

    console.log('✅ Add Option clicked');

    var packageId = $('#packages_id_hidden').val();
    console.log('packageId:', packageId);

    if (!packageId) {
      alert('Template id not found.');
      return;
    }

    // make sure container exists
    var $wrap = $('.optionBlockContainer');
    console.log('optionBlockContainer length:', $wrap.length);

    if (!$wrap.length) {
      alert('Missing .optionBlockContainer in HTML. Add it inside modal body.');
      return;
    }

    var $newOptionBlock = addNewOptionBlock(); // must return block
    console.log('new option block created:', $newOptionBlock.length);

    if (!$newOptionBlock || !$newOptionBlock.length) {
      alert('Option block was not created. Check addNewOptionBlock().');
      return;
    }

    loadPackageOptionsIntoDropdown($newOptionBlock.find('.propertyDropdown'), packageId);
  });
}


///***For save the quotation details from adding modal form *****///



/////******** Jquery validation when save******/////////////

// function showError(msg, el) {
//     alert(msg);
//     if (el) {
//         el.scrollIntoView({ behavior: 'smooth', block: 'center' });
//         el.classList.add('is-invalid');
//         setTimeout(() => el.classList.remove('is-invalid'), 2000);
//     }
// }

function showError(message, element)
{
    alert(message);

    $('.is-invalid').removeClass('is-invalid');
    $('.select2-error').removeClass('select2-error');

    if (!element) return false;

    var $modalBody = $('#QuotationModal .modal-body');
    var $target = $(element);

    // select2 support
    if ($target.hasClass('select2-hidden-accessible')) {
        var $s2 = $target.next('.select2').find('.select2-selection');
        $s2.addClass('select2-error');
        $target = $s2;
    } else if ($target.closest('.select2').length) {
        $target.closest('.select2').find('.select2-selection').addClass('select2-error');
        $target = $target.closest('.select2');
    } else {
        $target.addClass('is-invalid');
    }

    if ($target.length && $modalBody.length) {
        var bodyTop = $modalBody.offset().top;
        var targetTop = $target.offset().top;
        var currentScroll = $modalBody.scrollTop();

        $modalBody.animate({
            scrollTop: currentScroll + (targetTop - bodyTop) - 80
        }, 300);
    }

    setTimeout(function () {
        if ($(element).hasClass('select2-hidden-accessible')) {
            $(element).select2('open');
        } else if (element.focus) {
            element.focus();
        }
    }, 350);

    return false;
}

function num(v) {
    const n = parseFloat(v);
    return isNaN(n) ? 0 : n;
}

$('.specialReqSelect, .specialReqDaySelect, .inclusionDaySelect, .inclusionPropertySelect, .inclusionNameSelect')
.each(function () {
    $(this).trigger('change.select2');
});

function isValidOpenedPackageOption(optionId) {
    let found = false;

    $('.optionBlock').each(function () {
        const val = $(this).find('.propertyDropdown').val() || '';
        if (val == optionId) {
            found = true;
            return false;
        }
    });

    return found;
}

function validateUniquePropertyDropdowns() {
    var values = {};
    var valid = true;

    $('.propertyDropdown').each(function () {
        var val = $(this).val() || '';

        if (!val) return;

        if (values[val]) {
            alert('Duplicate package option selected.');
            $(this).focus();
            valid = false;
            return false;
        }

        values[val] = true;
    });

    return valid;
}

// function validateQuotationForm() {

//     if (!$('#quotation_date').val())
//         return showError('Quotation date is required', $('#quotation_date')[0]), false;

//     if (!$('#arriving_destination').val())
//         return showError('Arriving destination is required', $('#arriving_destination')[0]), false;

//     if (!$('#departuring_destination').val())
//         return showError('Departuring destination is required', $('#departuring_destination')[0]), false;

//     if (!$('#leads_id_hidden').val())
//         return showError('Please select Lead', $('#leads_id_hidden')[0]), false;

//     if (!$('#packages_id_hidden').val())
//         return showError('Please select Template', $('#packages_id_hidden')[0]), false;

//     if (!validateUniquePropertyDropdowns()) {
//         return false;
//     }

//     const optionBlocks = document.querySelectorAll('.optionBlock');
//     if (!optionBlocks || optionBlocks.length === 0) {
//         showError('Please add at least one Template Option', document.getElementById('packages_id_hidden'));
//         return false;
//     }

//     let anySelected = false;
//     optionBlocks.forEach(ob => {
//         const sel = ob.querySelector('.propertyDropdown');
//         if (sel && sel.value) anySelected = true;
//     });

//     if (!anySelected) {
//         const firstSelect = optionBlocks[0]?.querySelector('.propertyDropdown');
//         showError('Please select at least one Template Option from dropdown', firstSelect || document.getElementById('packages_id_fk'));
//         return false;
//     }

//     let valid = true;

//     document.querySelectorAll('.optionBlock').forEach(optionBlock => {

//         if (!valid) return;

//         const optionSel = optionBlock.querySelector('[name="packages_properties_common_id_fk[]"]');
//         const titleEl   = optionBlock.querySelector('[name="quotation_options_title[]"]');
//         const cabEl     = optionBlock.querySelector('[name="quotation_options_cab_amount[]"]');
//         const designEl  = optionBlock.querySelector('[name="quotation_options_design_type[]"]');
//         const vehicleEl = optionBlock.querySelector('[name="quotation_options_vehicle_id_fk[]"]');
       
//         const amountTypeEl = optionBlock.querySelector('.optionAmountType');
//         const perAmountEl  = optionBlock.querySelector('.optionPerAmount');

//         if (!amountTypeEl || !amountTypeEl.value) {
//             return valid = false, showError('Select amount type', amountTypeEl);
//         }

//         if (amountTypeEl.value !== 'net' && num(perAmountEl?.value) <= 0) {
//             return valid = false, showError('Amount is required', perAmountEl);
//         }

//         if (!optionSel?.value)
//             return valid = false, showError('Select Template Option', optionSel);

//         if (!titleEl?.value.trim())
//             return valid = false, showError('Option title is required', titleEl);

//         if (num(cabEl?.value) <= 0)
//             return valid = false, showError('Cab amount is required', cabEl);

//         if (!designEl || !designEl.value)
//             return valid = false, showError('Design type is required', designEl);

//         if (!vehicleEl || !vehicleEl.value)
//             return valid = false, showError('Vehicle is required', vehicleEl);
        

//         optionBlock.querySelectorAll('.autoCalcRateInput').forEach(inp => {
//             if (!valid) return;
//             if (num(inp.value) <= 0)
//                 return valid = false, showError('Room calculated rate cannot be 0.00', inp);
//         });

//         optionBlock.querySelectorAll('.itineraryDayRow').forEach(dayRow => {

//             if (!valid) return;

//             const openPropertySelector = dayRow.querySelector('.propertySelector:not(.d-none)');
//             if (openPropertySelector) {
//                 const propDropdown = openPropertySelector.querySelector('.propertySelectDropdown');
//                 if (propDropdown && !propDropdown.value) {
//                     return valid = false, showError('Please select property or remove the empty property block', propDropdown);
//                 }
//             }

//             dayRow.querySelectorAll('.propertyBlock').forEach(propertyBlock => {

//                 if (!valid) return;

//                 if (!propertyBlock.dataset.propertyId) {
//                     valid = false;
//                     showError('Property not selected', propertyBlock);
//                     return;
//                 }

//                 const tbody = propertyBlock.querySelector('tbody');
//                 const allRows = tbody ? tbody.querySelectorAll('tr') : [];

//                 // 1) package-loaded existing room rows
//                 const existingSavedRows = tbody ? tbody.querySelectorAll('tr[data-room-id]') : [];

//                 // 2) manually opened room dropdown rows
//                 const manualRoomRows = tbody ? tbody.querySelectorAll('tr .roomSelect') : [];

//                 let hasManualRow = false;
//                 let hasManualSelectedRoom = false;

//                 manualRoomRows.forEach(function(roomSelect) {
//                     if (!valid) return;

//                     hasManualRow = true;

//                     const roomRow = roomSelect.closest('tr');

//                     // manual room row opened but no room selected
//                     if (!roomSelect.value) {
//                         valid = false;
//                         showError('Please select room or remove the empty room row', roomSelect);
//                         return;
//                     }

//                     // selected but dataset not set
//                     if (!roomRow.dataset.roomId) {
//                         valid = false;
//                         showError('Room not selected', roomSelect);
//                         return;
//                     }

//                     hasManualSelectedRoom = true;
//                 });

//                 if (!valid) return;

//                 // CASE A:
//                 // property block has package-loaded saved rooms -> valid
//                 if (existingSavedRows.length > 0) {
//                     return;
//                 }

//                 // CASE B:
//                 // no existing saved rooms, but manual room rows exist and selected -> valid
//                 if (hasManualRow && hasManualSelectedRoom) {
//                     return;
//                 }

//                 // CASE C:
//                 // no existing saved rooms and no manual rows at all
//                 if (allRows.length === 0) {
//                     valid = false;
//                     showError('Please add at least one room', propertyBlock);
//                     return;
//                 }

//                 // CASE D:
//                 // rows exist but still no selected room
//                 valid = false;
//                 showError('Please select at least one room', propertyBlock);
//                 return;
//             });
//         });

//         const marginType  = optionBlock.querySelector('.optionMarginType');
//         const marginValue = optionBlock.querySelector('.optionMarginValue');

//         if (!marginType?.value || num(marginValue?.value) <= 0)
//             return valid = false, showError('Margin amount/percentage is required', marginValue);
//     });

//     if (!valid) return false;

    

//     /* ================= 8. PROPERTY INCLUSIONS ================= */

// if ($('#quotation_property_inclusion_type').is(':checked')) {

//     document.querySelectorAll('#inclusionTable tbody tr').forEach(tr => {
//         if (!valid) return;

//         const optionSel = tr.querySelector('.inclusionPackageOptionSelect');
//         const optionId  = optionSel ? optionSel.value : '';

//         const daySel  = tr.querySelector('.inclusionDaySelect');
//         const propSel = tr.querySelector('.inclusionPropertySelect');
//         const incSel  = tr.querySelector('.inclusionNameSelect');
//         const amtEl   = tr.querySelector('.inclusionAmountInput');

//         if (!optionId || !isValidOpenedPackageOption(optionId)) {
//             valid = false;
//             alert('Please select a valid Template Option from opened option blocks');
//             if (optionSel) optionSel.focus();
//             return;
//         }

//         if (!daySel || !daySel.value) {
//             valid = false;
//             showError('Select Day | Date | Destination for Inclusion', daySel);
//             return;
//         }

//         if (!propSel || !propSel.value) {
//             valid = false;
//             showError('Select Property for Inclusion', propSel);
//             return;
//         }

//         if (!incSel || !incSel.value) {
//             valid = false;
//             showError('Select Inclusion Name', incSel);
//             return;
//         }

//         if (!amtEl || num(amtEl.value) <= 0) {
//             valid = false;
//             showError('Inclusion amount required', amtEl);
//             return;
//         }
//     });
// }

// if (!valid) return false;

//     /* ================= 9. SPECIAL REQUIREMENTS ================= */
// if ($('#quotation_special_requirement_type').is(':checked')) {

//     document.querySelectorAll('#specialReqTable tbody tr').forEach(tr => {
//         if (!valid) return;

//         const daySel = tr.querySelector('.specialReqDaySelect');
//         const reqSel = tr.querySelector('.specialReqSelect');
//         const amtEl  = tr.querySelector('.specialReqCost');

//         if (!daySel?.value)
//             return valid = false, showError('Select Day | Date | Destination for Requirement', daySel);

//         if (!reqSel?.value)
//             return valid = false, showError('Select Special Requirement', reqSel);

//         if (num(amtEl?.value) <= 0)
//             return valid = false, showError('Requirement amount required', amtEl);
//     });
// }

// if (!valid) return false;
//     return valid;
// }

function validateQuotationForm() {

    $('.room-rate-error').removeClass('room-rate-error');
$('.select2-error').removeClass('select2-error');
$('.is-invalid').removeClass('is-invalid');

    if (!$('#quotation_date').val())
        return showError('Quotation date is required', $('#quotation_date')[0]), false;

    if (!$('#arriving_destination').val())
        return showError('Arriving destination is required', $('#arriving_destination')[0]), false;

    if (!$('#departuring_destination').val())
        return showError('Departuring destination is required', $('#departuring_destination')[0]), false;

     if (!$('#leads_id_hidden').val())
        return showError('Please select Lead', $('#leads_id_hidden')[0]), false;

    if (!$('#packages_id_hidden').val())
        return showError('Please select Template', $('#packages_id_hidden')[0]), false;

    if (!validateUniquePropertyDropdowns()) {
        return false;
    }

    const optionBlocks = document.querySelectorAll('.optionBlock');
    if (!optionBlocks || optionBlocks.length === 0) {
        showError('Please add at least one Template Option', document.getElementById('packages_id_fk'));
        return false;
    }

    let anySelected = false;
    optionBlocks.forEach(ob => {
        const sel = ob.querySelector('.propertyDropdown');
        if (sel && sel.value) anySelected = true;
    });

    if (!anySelected) {
        const firstSelect = optionBlocks[0]?.querySelector('.propertyDropdown');
        // showError('Please select at least one Template Option from dropdown', firstSelect || document.getElementById('packages_id_fk'));
        showError(
    'Please select at least one Template Option from dropdown',
        $(firstSelect).next('.select2')[0] || firstSelect
    );
        return false;
    }

    let valid = true;

    document.querySelectorAll('.optionBlock').forEach(optionBlock => {

        if (!valid) return;

        const optionSel = optionBlock.querySelector('[name="packages_properties_common_id_fk[]"]');
        const titleEl   = optionBlock.querySelector('[name="quotation_options_title[]"]');
        const cabEl     = optionBlock.querySelector('[name="quotation_options_cab_amount[]"]');
        const designEl  = optionBlock.querySelector('[name="quotation_options_design_type[]"]');
        const vehicleEl = optionBlock.querySelector('[name="quotation_options_vehicle_id_fk[]"]');
        
        const marginType  = optionBlock.querySelector('.optionMarginType');
        const marginValue = optionBlock.querySelector('.optionMarginValue');



        const amountTypeEl = optionBlock.querySelector('.optionAmountType');
        const perAmountEl  = optionBlock.querySelector('.optionPerAmount');


        /* ===== VALIDATE MARGIN LAST ===== */



if (amountTypeEl) {
    if (!amountTypeEl.value) {
        valid = false;
        showError('Select amount type', amountTypeEl);
        return;
    }

    if (amountTypeEl.value !== 'net' && num(perAmountEl ? perAmountEl.value : 0) <= 0) {
        valid = false;
        showError('Amount is required', perAmountEl);
        return;
    }
}


// if (!marginValue?.value || num(marginValue.value) <= 0) {
//     return valid = false,
//     showError('Margin amount/percentage is required', marginValue);
// }
        if (!optionSel?.value)
            return valid = false, showError('Select Template Option', optionSel);

        if (!titleEl?.value.trim())
            return valid = false, showError('Option title is required', titleEl);

        if (num(cabEl?.value) <= 0)
            return valid = false, showError('Cab amount is required', cabEl);

        if (!designEl || !designEl.value)
            return valid = false, showError('Design type is required', designEl);

        // if (!vehicleEl || !vehicleEl.value)
        //     return valid = false, showError('Vehicle is required', vehicleEl);
        
        if (!vehicleEl || !vehicleEl.value) {
            return valid = false,
            showError(
                'Vehicle is required',
                $(vehicleEl).next('.select2')[0] || vehicleEl
            );
        }

        let hasZeroRoomRate = false;

        optionBlock.querySelectorAll('.autoCalcRateInput').forEach(inp => {
            if (!valid) return;

            const row = inp.closest('tr');

            if (num(inp.value) <= 0) {
                valid = false;

                if (row) {
                    $(row).addClass('room-rate-error');

                    const $modalBody = $('#QuotationModal .modal-body');
                    const $target = $(row);

                    $modalBody.animate({
                        scrollTop: $modalBody.scrollTop() + ($target.offset().top - $modalBody.offset().top) - 90
                    }, 300);
                }

                alert('Room calculated rate cannot be 0.00');
                return;
            } else {
                if (row) {
                    $(row).removeClass('room-rate-error');
                }
            }
        });

        if (!valid) return false;
        

        optionBlock.querySelectorAll('.itineraryDayRow').forEach(dayRow => {

            if (!valid) return;

            const openPropertySelector = dayRow.querySelector('.propertySelector:not(.d-none)');
            if (openPropertySelector) {
                const propDropdown = openPropertySelector.querySelector('.propertySelectDropdown');
                if (propDropdown && !propDropdown.value) {
                    return valid = false, showError('Please select property or remove the empty property block', propDropdown);
                }
            }

            dayRow.querySelectorAll('.propertyBlock').forEach(propertyBlock => {

                if (!valid) return;

                if (!propertyBlock.dataset.propertyId) {
                    valid = false;
                    showError('Property not selected', propertyBlock);
                    return;
                }

                const tbody = propertyBlock.querySelector('tbody');
                const allRows = tbody ? tbody.querySelectorAll('tr') : [];

                // 1) package-loaded existing room rows
                const existingSavedRows = tbody ? tbody.querySelectorAll('tr[data-room-id]') : [];

                // 2) manually opened room dropdown rows
                const manualRoomRows = tbody ? tbody.querySelectorAll('tr .roomSelect') : [];

                let hasManualRow = false;
                let hasManualSelectedRoom = false;

                manualRoomRows.forEach(function(roomSelect) {
                    if (!valid) return;

                    hasManualRow = true;

                    const roomRow = roomSelect.closest('tr');

                    // manual room row opened but no room selected
                    if (!roomSelect.value) {
                        valid = false;
                        showError('Please select room or remove the empty room row', roomSelect);
                        return;
                    }

                    // selected but dataset not set
                    if (!roomRow.dataset.roomId) {
                        valid = false;
                        showError('Room not selected', roomSelect);
                        return;
                    }

                    hasManualSelectedRoom = true;
                });

                if (!valid) return;

                // CASE A:
                // property block has package-loaded saved rooms -> valid
                if (existingSavedRows.length > 0) {
                    return;
                }

                // CASE B:
                // no existing saved rooms, but manual room rows exist and selected -> valid
                if (hasManualRow && hasManualSelectedRoom) {
                    return;
                }

                // CASE C:
                // no existing saved rooms and no manual rows at all
                if (allRows.length === 0) {
                    valid = false;
                    showError('Please add at least one room', propertyBlock);
                    return;
                }

                // CASE D:
                // rows exist but still no selected room
                valid = false;
                showError('Please select at least one room', propertyBlock);
                return;
            });
        });

        
    });

    if (!valid) return false;

    // 8. Margin validation ONLY HERE, outside the above loop
    $('.optionBlock').each(function () {
        if (!valid) return false;

        const marginValue = this.querySelector('.optionMarginValue');

        if (!marginValue || $.trim($(marginValue).val()) === '' || num($(marginValue).val()) <= 0) {
            valid = false;
            showError('Margin amount/percentage is required', marginValue);
            return false;
        }

        return true;
    });

    if (!valid) return false;

    /* ================= 8. PROPERTY INCLUSIONS ================= */

if ($('#quotation_property_inclusion_type').is(':checked')) {

    document.querySelectorAll('#inclusionTable tbody tr').forEach(tr => {
        if (!valid) return;

        const optionSel = tr.querySelector('.inclusionPackageOptionSelect');
        const optionId  = optionSel ? optionSel.value : '';

        const daySel  = tr.querySelector('.inclusionDaySelect');
        const propSel = tr.querySelector('.inclusionPropertySelect');
        const incSel  = tr.querySelector('.inclusionNameSelect');
        const amtEl   = tr.querySelector('.inclusionAmountInput');

        if (!optionId || !isValidOpenedPackageOption(optionId)) {
            valid = false;
            // alert('Please select a valid Template Option from opened option blocks');
            // if (optionSel) optionSel.focus();
            showError(
                'Please select a valid Template Option from opened option blocks',
                $(optionSel).next('.select2')[0] || optionSel
            );
            return;
        }

        if (!daySel || !daySel.value) {
            valid = false;
            // showError('Select Day | Date | Destination for Inclusion', daySel);
            showError(
                'Select Day | Date | Destination for Inclusion',
                $(daySel).next('.select2')[0] || daySel
            );
            return;
        }

        if (!propSel || !propSel.value) {
            valid = false;
            // showError('Select Property for Inclusion', propSel);
            showError(
    'Select Property for Inclusion',
    $(propSel).next('.select2')[0] || propSel
);
            return;
        }

        if (!incSel || !incSel.value) {
            valid = false;
            // showError('Select Inclusion Name', incSel);
            showError(
    'Select Inclusion Name',
    $(incSel).next('.select2')[0] || incSel
);
            return;
        }

        if (!amtEl || num(amtEl.value) <= 0) {
            valid = false;
            showError('Inclusion amount required', amtEl);
            return;
        }
    });
}

if (!valid) return false;

    /* ================= 9. SPECIAL REQUIREMENTS ================= */
if ($('#quotation_special_requirement_type').is(':checked')) {

    document.querySelectorAll('#specialReqTable tbody tr').forEach(tr => {
        if (!valid) return;

        const daySel = tr.querySelector('.specialReqDaySelect');
        const reqSel = tr.querySelector('.specialReqSelect');
        const amtEl  = tr.querySelector('.specialReqCost');

        if (!daySel?.value)
            return valid = false, 
        // showError('Select Day | Date | Destination for Requirement', daySel);
        showError(
    'Select Day | Date | Destination for Requirement',
    $(daySel).next('.select2')[0] || daySel
);

        if (!reqSel?.value)
            return valid = false, 
        // showError('Select Special Requirement', reqSel);
        showError(
    'Select Special Requirement',
    $(reqSel).next('.select2')[0] || reqSel
);

        if (num(amtEl?.value) <= 0)
            return valid = false, showError('Requirement amount required', amtEl);
    });
}

if (!valid) return false;
    return valid;
}

function save_quote() {

    // ✅ VALIDATE FIRST
    if (!validateQuotationForm()) {
        return;
    }

    let url = "<?php echo base_url();?>index.php/Quotation/ajax_add/";

    $('#btnSave').text('saving...').attr('disabled', true);

    // ensure latest totals
    recalcAllOptionsBeforeSave();

    const form = document.getElementById('form5');
    const data = new FormData(form);

    // JSON payload
    data.append('data', JSON.stringify(buildQuotationPayload()));

    $.ajax({
        url: url,
        type: "POST",
        data: data,
        dataType: "JSON",
        processData: false,
        contentType: false,
        success: function (res) {

            if (res.status) {
                // resetQuotationModalForm();
                $('#QuotationModal').modal('hide');
                // reload_table();
            //     swal("Quotation details added successfully", "", "success")

            //  window.location.href = "<?php echo base_url('index.php/Quotation'); ?>";
            swal("Quotation details added successfully", "", "success").then((result) => {
    if (result.isConfirmed || result.value) {
        window.location.href = "<?php echo base_url('index.php/Quotation'); ?>";
    }
});

            } else {
                alert('Validation failed on server');
            }

            $('#btnSave').text('save').attr('disabled', false);
        },
        error: function () {
            alert('Error saving data');
            $('#btnSave').text('save').attr('disabled', false);
        }
    });
}


///***For save the quotation details from adding modal form *****///



$(document).ready(function () {

    function resetInclusionBox() {
        const $tbody = $('#inclusionTable tbody');
        $tbody.find('tr:gt(0)').remove();

        const $first = $tbody.find('tr:eq(0)');
        $first.find('input').val('');
        $first.find('select').each(function () {
            $(this).val(null).trigger('change');
        });

        $first.find('.inclusionPropertySelect').html('<option value="">Select Property</option>');
        $first.find('.inclusionNameSelect').html('<option value="">Select Inclusion</option>');
        $first.find('.removeInclusionBtn').prop('disabled', true);

        if (typeof recalcInclusionTotal === 'function') {
            recalcInclusionTotal();
        }
    }

    function resetSpecialReqBox() {
        const $tbody = $('#specialReqTable tbody');
        $tbody.find('tr:gt(0)').remove();

        const $first = $tbody.find('tr:eq(0)');
        $first.find('input').val('');
        $first.find('select').each(function () {
            $(this).val(null).trigger('change');
        });

        $first.find('.removeSpecialReqBtn').prop('disabled', true);

        if (typeof recalcSpecialReqTotal === 'function') {
            recalcSpecialReqTotal();
        }
    }

    function resetAddonBlocks() {
        $('#quotation_property_inclusion_type').prop('checked', false);
        $('#quotation_special_requirement_type').prop('checked', false);

        $('#inclusionBox').hide();
        $('#specialReqBox').hide();

        resetInclusionBox();
        resetSpecialReqBox();
    }

    function hasPackageSelected() {
        var pkg = $('#packages_id_fk').val() || $('#packages_id_hidden').val() || '';
        return $.trim(pkg) !== '';
    }

    function hasValidOptionSelected() {
        var ok = false;
        $('.optionBlock .propertyDropdown').each(function () {
            if ($(this).val()) {
                ok = true;
                return false;
            }
        });
        return ok;
    }

    function loadDefaultInclusionPackageOptions() {
        document.querySelectorAll('#inclusionTable tbody tr').forEach(function (row) {
            const selectEl = row.querySelector('.inclusionPackageOptionSelect');
            if (selectEl) {
                fillInclusionPackageOptionSelect(selectEl);
            }
        });
    }

    function toggleBox($checkbox, $box, resetFn) {
        if ($checkbox.is(':checked')) {

            if (!hasPackageSelected()) {
                alert('Please select template first');
                $checkbox.prop('checked', false);
                $box.hide();
                resetFn();
                return;
            }

            if ($('.optionBlock').length === 0) {
                alert('Please add at least one option block first');
                $checkbox.prop('checked', false);
                $box.hide();
                resetFn();
                return;
            }

            if (!hasValidOptionSelected()) {
                alert('Please select at least one template option first');
                $checkbox.prop('checked', false);
                $box.hide();
                resetFn();
                return;
            }

            $box.stop(true, true).slideDown(150);

            if (typeof loadInclusionAndRequirementDropdownData === 'function') {
                loadInclusionAndRequirementDropdownData();
            }

            // ✅ NEW: load package option for default row
            setTimeout(function () {
                loadDefaultInclusionPackageOptions();
            }, 50);


        } else {
            $box.stop(true, true).slideUp(150, function () {
                resetFn();
            });
        }
    }

    // setTimeout(function () {

    //     $box.find('.inclusionPackageOptionSelect').each(function () {
    //         initSelect2(this, 'Select Package Option');
    //     });
    //     $box.find('.inclusionDaySelect').each(function () {
    //         initSelect2(this, 'Select Day | Date | Destination');
    //     });

    //     $box.find('.inclusionPropertySelect').each(function () {
    //         initSelect2(this, 'Select Property');
    //     });

    //     $box.find('.inclusionNameSelect').each(function () {
    //         initSelect2(this, 'Select Inclusion');
    //     });

    //     $box.find('.specialReqSelect').each(function () {
    //         initSelect2(this, 'Select Requirement');
    //     });

    // }, 100);

    $('#inclusionBox').hide();
    $('#specialReqBox').hide();

    $('#quotation_property_inclusion_type').on('change', function () {
        toggleBox($(this), $('#inclusionBox'), resetInclusionBox);
    });

    $('#quotation_special_requirement_type').on('change', function () {
        toggleBox($(this), $('#specialReqBox'), resetSpecialReqBox);
    });

    // visible package select
    $(document).on('change', '#packages_id_fk', function () {
        resetAddonBlocks();
    });

    // visible package select2
    $(document).on('select2:select select2:clear', '#packages_id_fk', function () {
        resetAddonBlocks();
    });

    // hidden package field used in leads page modal version
    $(document).on('change', '#packages_id_hidden', function () {
        resetAddonBlocks();
    });

    // if no valid option remains
    $(document).on('change', '.propertyDropdown', function () {
        if (!hasValidOptionSelected()) {
            resetAddonBlocks();
        }
    });

    $(document).on('click', '.removeOptionBtn', function () {
        setTimeout(function () {
            if (!hasValidOptionSelected()) {
                resetAddonBlocks();
            }
        }, 50);
    });

});

/* ================= SPECIAL REQUIREMENTS ================= */

// $(document).ready(function () {

//     function resetInclusionBox() {
//         var $tbody = $('#inclusionTable tbody');
//         $tbody.find('tr:gt(0)').remove();

//         var $first = $tbody.find('tr:eq(0)');
//         $first.find('select').val('').trigger('change');
//         $first.find('input').val('');
//         $first.find('.removeInclusionBtn').prop('disabled', true);

//         recalcInclusionTotal();
//     }

//     function toggleInclusionBox() {
//         if ($('#quotation_property_inclusion_type').is(':checked')) {
//             $('#inclusionBox').stop(true, true).slideDown(150);
//             loadInclusionAndRequirementDropdownData();
//         } else {
//             $('#inclusionBox').stop(true, true).slideUp(150, function () {
//                 resetInclusionBox();
//             });
//         }
//     }

//     // first load
//     toggleInclusionBox();

//     // checkbox change
//     $(document).on('change', '#quotation_property_inclusion_type', function () {
//         toggleInclusionBox();
//     });
// });

let __dayOptions = [];
let __dayPropertyMap = {};        // dayKey => properties
let __propertyInclusionMap = {};  // propertyId => inclusions

function formatDateDMY(dateStr) {
    if (!dateStr) return '';
    var p = dateStr.split('-');
    if (p.length === 3) return p[2] + '/' + p[1] + '/' + p[0];
    return dateStr;
}

function makeDayKey(row) {
    return row.day_id_fk + '|' + row.stay_destination_id_fk + '|' + row.accommodation_date;
}

function buildDayOptionLabel(row) {
    return (row.packages_properties_days_day || '') +
           ' | ' + formatDateDMY(row.accommodation_date || '') +
           ' | ' + (row.state_name || '');
}

function initSelect2(el, placeholder) {
    if (!el) return;

    var $el = $(el);

    if ($el.hasClass('select2-hidden-accessible')) {
        $el.select2('destroy');
    }

    $el.select2({
        width: '100%',
        placeholder: placeholder || 'Select',
        allowClear: true,
        dropdownParent: $('#QuotationModal')
    });
}


function fillDaySelect(selectEl) {
    if (!selectEl) return;

    var currentVal = $(selectEl).val() || '';

    var html = '<option value="">Select Day | Date | Destination</option>';
    __dayOptions.forEach(function (r) {
        var key = makeDayKey(r);
        html += '<option value="' + key + '">' + buildDayOptionLabel(r) + '</option>';
    });

    $(selectEl).html(html);

    if (currentVal && $(selectEl).find('option[value="' + currentVal + '"]').length) {
        $(selectEl).val(currentVal);
    } else {
        $(selectEl).val('');
    }

    initSelect2(selectEl, 'Select Day | Date | Destination');
}

function fillPropertySelect(selectEl, dayKey) {
    if (!selectEl) return;

    var html = '<option value="">Select Property</option>';
    var rows = __dayPropertyMap[dayKey] || [];

    rows.forEach(function (r) {
        html += '<option value="' + r.property_id + '">' + r.property_name + '</option>';
    });

    selectEl.innerHTML = html;
    initSelect2(selectEl, 'Select Property');
}

function fillInclusionSelect(selectEl, propertyId) {
    if (!selectEl) return;

    var html = '<option value="">Select Inclusion</option>';
    var rows = __propertyInclusionMap[propertyId] || [];

    rows.forEach(function (r) {
        html += '<option value="' + r.property_inclusions_id + '" data-amount="' + (r.property_inclusions_amount || 0) + '">' +
                    r.property_inclusions_name +
                '</option>';
    });

    selectEl.innerHTML = html;
    initSelect2(selectEl, 'Select Inclusion');
}

// function clearPropertySelect(selectEl) {
//     if (!selectEl) return;

//     $(selectEl).html('<option value="">Select Property</option>').val('');
//     initSelect2(selectEl, 'Select Property');
//     $(selectEl).trigger('change.select2');
// }

// function clearInclusionSelect(selectEl) {
//     if (!selectEl) return;

//     $(selectEl).html('<option value="">Select Inclusion</option>').val('');
//     initSelect2(selectEl, 'Select Inclusion');
//     $(selectEl).trigger('change.select2');
// }

function clearPropertySelect(selectEl) {
    setSelect2Empty(selectEl, 'Select Property');
}

function clearInclusionSelect(selectEl) {
    setSelect2Empty(selectEl, 'Select Inclusion');
}

function applySpecialReqCostFromSelect(sel) {
    if (!sel) return;

    var row = sel.closest('tr');
    if (!row) return;

    var costInput = row.querySelector('.specialReqCost');
    if (!costInput) return;

    var opt = sel.options[sel.selectedIndex];
    var cost = opt ? (opt.getAttribute('data-cost') || '0') : '0';

    costInput.value = cost;

    if (typeof recalcSpecialReqTotal === 'function') {
        recalcSpecialReqTotal();
    }
}

$(document).on('change', '.specialReqSelect', function () {
    applySpecialReqCostFromSelect(this);
});

$(document).on('select2:select', '.specialReqSelect', function () {
    applySpecialReqCostFromSelect(this);
});

$(document).on('select2:clear', '.specialReqSelect', function () {
    var row = this.closest('tr');
    var costInput = row ? row.querySelector('.specialReqCost') : null;

    if (costInput) costInput.value = '';

    if (typeof recalcSpecialReqTotal === 'function') {
        recalcSpecialReqTotal();
    }
});

/* ✅ Fallback if Select2 not active */
document.addEventListener('change', function (e) {
  const sel = e.target.closest('.specialReqSelect');
  if (!sel) return;
  applySpecialReqCostFromSelect(sel);
});


function fillSpecialReqSelect(selectEl) {
    if (!selectEl) return;

    var currentVal = $(selectEl).val() || '';

    var html = '<option value="">Select Requirement</option>';
    __specialReqOptions.forEach(function (r) {
        html += '<option value="' + r.special_requirements_id + '" data-cost="' + (r.special_requirements_cost || 0) + '">' +
                    r.special_requirements_name +
                '</option>';
    });

    $(selectEl).html(html);

    if (currentVal && $(selectEl).find('option[value="' + currentVal + '"]').length) {
        $(selectEl).val(currentVal);
    } else {
        $(selectEl).val('');
    }

    initSelect2(selectEl, 'Select Requirement');
    applySpecialReqCostFromSelect(selectEl);
}


document.getElementById('addSpecialReqBtn').addEventListener('click', function (e) {
    e.preventDefault();

    var tbody = document.querySelector('#specialReqTable tbody');
    tbody.insertAdjacentHTML('beforeend', createSpecialReqRow());

    var row = tbody.lastElementChild;

    fillDaySelect(row.querySelector('.specialReqDaySelect'));
    fillSpecialReqSelect(row.querySelector('.specialReqSelect'));

    if (typeof recalcSpecialReqTotal === 'function') {
        recalcSpecialReqTotal();
    }
});

// ✅ Works with normal select + select2
document.addEventListener('change', function (e) {
  const sel = e.target.closest('.specialReqSelect');
  if (!sel) return;

  const row = sel.closest('tr');
  const costInput = row?.querySelector('.specialReqCost');
  if (!costInput) return;

  // read selected option data-cost
  const opt = sel.options[sel.selectedIndex];
  const cost = opt && opt.dataset ? (opt.dataset.cost || '0') : '0';

  costInput.value = cost;

  // ✅ update total instantly
  recalcSpecialReqTotal();
});



function isPackageSelected() {
    return $('#packages_id_fk').val() !== '';
}

function hasValidOptionSelected() {
    let valid = false;

    document.querySelectorAll('.propertyDropdown').forEach(el => {
        if (el.value && el.value !== '') {
            valid = true;
        }
    });

    return valid;
}

/* ================= LOAD DROPDOWNS (call on package/lead change) ================= */

function loadInclusionAndRequirementDropdownData() {
    var leadId = $('#leads_id_hidden').val() || $('#leads_id').val() || '';
    var packageId = $('#packages_id_hidden').val() || $('#packages_id_fk').val() || '';

    if (!leadId || !packageId) return;

    var urlDays =
        `<?php echo base_url(); ?>index.php/Quotation/ajax_get_accommodation_day_options?lead_id=${encodeURIComponent(leadId)}&package_id=${encodeURIComponent(packageId)}`;

    var urlReq =
        `<?php echo base_url(); ?>index.php/Quotation/ajax_get_special_requirements`;

    Promise.all([
        fetch(urlDays).then(function (r) { return r.json(); }),
        fetch(urlReq).then(function (r) { return r.json(); })
    ])
    .then(function (result) {
        var daysRes = result[0];
        var reqRes = result[1];

        __dayOptions = (daysRes && daysRes.status && Array.isArray(daysRes.data)) ? daysRes.data : [];
        __specialReqOptions = (reqRes && reqRes.status && Array.isArray(reqRes.data)) ? reqRes.data : [];

        document.querySelectorAll('.inclusionDaySelect').forEach(function (el) {
            fillDaySelect(el);
        });

        document.querySelectorAll('.specialReqDaySelect').forEach(function (el) {
            fillDaySelect(el);
        });

        document.querySelectorAll('.specialReqSelect').forEach(function (el) {
            fillSpecialReqSelect(el);
        });

        if (typeof recalcInclusionTotal === 'function') {
            recalcInclusionTotal();
        }

        if (typeof recalcSpecialReqTotal === 'function') {
            recalcSpecialReqTotal();
        }
    })
    .catch(function (err) {
        console.error(err);
    });
}
// Call it when lead/package changes:

// // ✅ if you still also use visible package dropdown somewhere else
$(document).on('change', '#packages_id_fk, #leads_id', function () {
    loadInclusionAndRequirementDropdownData();
    clearQuotationOnPackageChange();
      // ✅ fix bootstrap scroll recalculation
    setTimeout(function () {
        $('#QuotationModal').modal('handleUpdate');
    }, 100);
});

// ✅ Select2-safe trigger
$(document).on('select2:select', '#packages_id_fk, #leads_id', function () {
    loadInclusionAndRequirementDropdownData();
    clearQuotationOnPackageChange();
      // ✅ fix bootstrap scroll recalculation
    setTimeout(function () {
        $('#QuotationModal').modal('handleUpdate');
    }, 100);
});

/* ================= ROW TEMPLATES ================= */

function createInclusionRow() {
    return `
        <tr>
            <td>
                <select class="form-select form-select-sm inclusionPackageOptionSelect" name="package_option_id_fk[]">
                    <option value="">Select Template Option</option>
                </select>
            </td>
            <td>
                <select class="form-select form-select-sm inclusionDaySelect" name="inclusion_day_key[]">
                    <option value="">Select Day | Date | Destination</option>
                </select>
            </td>
            <td>
                <select class="form-select form-select-sm inclusionPropertySelect" name="inclusion_property_id_fk[]">
                    <option value="">Select Property</option>
                </select>
            </td>
            <td>
                <select class="form-select form-select-sm inclusionNameSelect" name="inclusion_name_id_fk[]">
                    <option value="">Select Inclusion</option>
                </select>
            </td>
            <td class="amount-col">
    <input type="number"
           class="form-control form-control-sm inclusionAmountInput"
           name="inclusion_amount[]"
           placeholder="Amount">
</td>
            <td>
                <button type="button" class="btn btn-danger btn-sm removeInclusionBtn">X</button>
            </td>
        </tr>
    `;
}


function fillInclusionPackageOptionSelect(selectEl, selectedValue) {
    if (!selectEl) return;

    var currentValue = selectedValue || $(selectEl).val() || '';
    var html = '<option value="">Select Template Option</option>';

    $('.optionBlock').each(function () {
        var val  = $(this).find('.propertyDropdown').val() || '';
        var text = $(this).find('.propertyDropdown option:selected').text() || '';

        if (val) {
            html += '<option value="' + val + '">' + text + '</option>';
        }
    });

    $(selectEl).html(html);

    if (currentValue) {
        $(selectEl).val(currentValue);
    }

    initSelect2(selectEl, 'Select Template Option');
    $(selectEl).trigger('change.select2');
}

document.getElementById('addInclusionBtn').addEventListener('click', function (e) {
    e.preventDefault();

    const tbody = document.querySelector('#inclusionTable tbody');
    tbody.insertAdjacentHTML('beforeend', createInclusionRow());

    const row = tbody.lastElementChild;

    fillInclusionPackageOptionSelect(row.querySelector('.inclusionPackageOptionSelect'));
    fillDaySelect(row.querySelector('.inclusionDaySelect')); // initially empty/reset later
    clearPropertySelect(row.querySelector('.inclusionPropertySelect'));
    clearInclusionSelect(row.querySelector('.inclusionNameSelect'));
});

document.querySelectorAll('.inclusionPackageOptionSelect').forEach(function (el) {
    fillInclusionPackageOptionSelect(el);
});


function createSpecialReqRow() {
    return `
        <tr>
            <td>
                <select class="form-select form-select-sm specialReqDaySelect" name="specialreq_day_key[]">
                    <option value="">Select Day | Date | Destination</option>
                </select>
            </td>
            <td>
                <select class="form-select form-select-sm specialReqSelect" name="quotation_special_requirements_id_fk[]">
                    <option value="">Select Requirement</option>
                </select>
            </td>
            <td>
                <input type="number" class="form-control form-control-sm specialReqCost"
                       name="special_requirements_cost[]" placeholder="Amount">
            </td>
            <td class="text-center">
                <button type="button" class="btn btn-sm btn-danger removeSpecialReqBtn">
                    <i class="bi bi-trash"></i>
                </button>
            </td>
        </tr>
    `;
}
/* ================= ADD/REMOVE ROWS ================= */

function refreshQuotationModalScroll(keepPosition) {
    setTimeout(function () {
        var $modal = $('#QuotationModal');
        var body = $modal.find('.modal-body')[0];

        if (body) {
            var oldTop = body.scrollTop;

            body.style.overflowY = 'auto';
            body.style.overflowX = 'hidden';
            body.style.maxHeight = 'none';
            body.style.minHeight = '0';

            if (keepPosition) {
                body.scrollTop = oldTop;
            }
        }

        if ($modal.hasClass('show')) {
            $modal.modal('handleUpdate');
        }
    }, 120);
}

function setSelect2Loading(selectEl, loadingText) {
    if (!selectEl) return;

    var $el = $(selectEl);

    if ($el.hasClass('select2-hidden-accessible')) {
        $el.select2('destroy');
    }

    $el.prop('disabled', true)
       .html('<option value="">' + (loadingText || 'Loading...') + '</option>')
       .val('');

    initSelect2(selectEl, loadingText || 'Loading...');
}

function setSelect2Ready(selectEl, html, placeholder) {
    if (!selectEl) return;

    var $el = $(selectEl);

    if ($el.hasClass('select2-hidden-accessible')) {
        $el.select2('destroy');
    }

    $el.html(html)
       .val('')
       .prop('disabled', false);

    initSelect2(selectEl, placeholder || 'Select');
    refreshQuotationModalScroll(true);
}

function setSelect2Empty(selectEl, placeholder) {
    if (!selectEl) return;

    var $el = $(selectEl);

    if ($el.hasClass('select2-hidden-accessible')) {
        $el.select2('destroy');
    }

    $el.html('<option value="">' + (placeholder || 'Select') + '</option>')
       .val('')
       .prop('disabled', true);

    initSelect2(selectEl, placeholder || 'Select');
}

// $(document).on('change', '.inclusionDaySelect', function () {
//     var row = this.closest('tr');
//     if (!row) return;

//     var dayKey = $(this).val() || '';
//     var leadId = $('#leads_id_hidden').val() || $('#leads_id').val() || '';
//     var packageId = $('#packages_id_hidden').val() || $('#packages_id_fk').val() || '';
//     var packageOptionId = $(row).find('.inclusionPackageOptionSelect').val() || '';

//     var propSel = row.querySelector('.inclusionPropertySelect');
//     var incSel = row.querySelector('.inclusionNameSelect');
//     var amtEl = row.querySelector('.inclusionAmountInput');

//     clearPropertySelect(propSel);
//     clearInclusionSelect(incSel);
//     if (amtEl) amtEl.value = '';

//     if (!dayKey || !leadId || !packageId || !packageOptionId) return;

//     fetch(
//         `<?php echo base_url(); ?>index.php/Quotation/ajax_get_daywise_properties_for_inclusion?lead_id=${encodeURIComponent(leadId)}&package_id=${encodeURIComponent(packageId)}&day_key=${encodeURIComponent(dayKey)}&packages_properties_common_id_fk=${encodeURIComponent(packageOptionId)}`
//     )
//     .then(function (r) { return r.json(); })
//     .then(function (res) {
//         var html = '<option value="">Select Property</option>';

//         if (res && res.status && Array.isArray(res.data)) {
//             res.data.forEach(function (p) {
//                 html += '<option value="' + p.property_id + '">' + p.property_name + '</option>';
//             });
//         }

//         $(propSel).html(html).val('');
//         initSelect2(propSel, 'Select Property');

//         clearInclusionSelect(incSel);
//     })
//     .catch(function (err) {
//         console.error(err);
//     });
// });

$(document).on('change', '.inclusionDaySelect', function () {
    var row = this.closest('tr');
    if (!row) return;

    var dayKey = $(this).val() || '';
    var leadId = $('#leads_id_hidden').val() || $('#leads_id').val() || '';
    var packageId = $('#packages_id_hidden').val() || $('#packages_id_fk').val() || '';
    var packageOptionId = $(row).find('.inclusionPackageOptionSelect').val() || '';

    var propSel = row.querySelector('.inclusionPropertySelect');
    var incSel = row.querySelector('.inclusionNameSelect');
    var amtEl = row.querySelector('.inclusionAmountInput');

    if (amtEl) amtEl.value = '';

    // lock property and inclusion first
    setSelect2Empty(incSel, 'Select Inclusion');
    setSelect2Loading(propSel, 'Loading Property...');

    if (!dayKey || !leadId || !packageId || !packageOptionId) {
        setSelect2Empty(propSel, 'Select Property');
        setSelect2Empty(incSel, 'Select Inclusion');
        refreshQuotationModalScroll(true);
        return;
    }

    fetch(
        `<?php echo base_url(); ?>index.php/Quotation/ajax_get_daywise_properties_for_inclusion?lead_id=${encodeURIComponent(leadId)}&package_id=${encodeURIComponent(packageId)}&day_key=${encodeURIComponent(dayKey)}&packages_properties_common_id_fk=${encodeURIComponent(packageOptionId)}`
    )
    .then(function (r) { return r.json(); })
    .then(function (res) {
        var html = '<option value="">Select Property</option>';

        if (res && res.status && Array.isArray(res.data) && res.data.length > 0) {
            res.data.forEach(function (p) {
                html += '<option value="' + p.property_id + '">' + p.property_name + '</option>';
            });

            setSelect2Ready(propSel, html, 'Select Property');
        } else {
            setSelect2Empty(propSel, 'No Property Found');
        }

        setSelect2Empty(incSel, 'Select Inclusion');
        refreshQuotationModalScroll(true);
    })
    .catch(function (err) {
        console.error(err);
        setSelect2Empty(propSel, 'Failed to load Property');
        setSelect2Empty(incSel, 'Select Inclusion');
        refreshQuotationModalScroll(true);
    });
});

// $(document).on('change', '.inclusionPropertySelect', function () {
//     var row = this.closest('tr');
//     if (!row) return;

//     var propertyId = $(this).val() || '';
//     var incSel = row.querySelector('.inclusionNameSelect');
//     var amtEl = row.querySelector('.inclusionAmountInput');

//     clearInclusionSelect(incSel);
//     if (amtEl) amtEl.value = '';

//     if (!propertyId) return;

//     fetch(`<?php echo base_url(); ?>index.php/Quotation/ajax_get_property_inclusions_by_property?property_id=${encodeURIComponent(propertyId)}`)
//         .then(function (r) { return r.json(); })
//         .then(function (res) {
//             var html = '<option value="">Select Inclusion</option>';

//             if (res && res.status && Array.isArray(res.data)) {
//                 res.data.forEach(function (item) {
//                     html += '<option value="' + item.property_inclusions_id + '" data-amount="' + (item.property_inclusions_amount || 0) + '">' +
//                                 item.property_inclusions_name +
//                             '</option>';
//                 });
//             }

//             $(incSel).html(html).val('');
//             initSelect2(incSel, 'Select Inclusion');
//         })
//         .catch(function (err) {
//             console.error(err);
//         });
// });

$(document).on('change', '.inclusionPropertySelect', function () {
    var row = this.closest('tr');
    if (!row) return;

    var propertyId = $(this).val() || '';
    var incSel = row.querySelector('.inclusionNameSelect');
    var amtEl = row.querySelector('.inclusionAmountInput');

    if (amtEl) amtEl.value = '';

    setSelect2Loading(incSel, 'Loading Inclusion...');

    if (!propertyId) {
        setSelect2Empty(incSel, 'Select Inclusion');
        refreshQuotationModalScroll(true);
        return;
    }

    fetch(`<?php echo base_url(); ?>index.php/Quotation/ajax_get_property_inclusions_by_property?property_id=${encodeURIComponent(propertyId)}`)
        .then(function (r) { return r.json(); })
        .then(function (res) {
            var html = '<option value="">Select Inclusion</option>';

            if (res && res.status && Array.isArray(res.data) && res.data.length > 0) {
                res.data.forEach(function (item) {
                    html += '<option value="' + item.property_inclusions_id + '" data-amount="' + (item.property_inclusions_amount || 0) + '">' +
                                item.property_inclusions_name +
                            '</option>';
                });

                setSelect2Ready(incSel, html, 'Select Inclusion');
            } else {
                setSelect2Empty(incSel, 'No Inclusion Found');
            }

            refreshQuotationModalScroll(true);
        })
        .catch(function (err) {
            console.error(err);
            setSelect2Empty(incSel, 'Failed to load Inclusion');
            refreshQuotationModalScroll(true);
        });
});

$(document).on('change', '.inclusionNameSelect', function () {
    var row = this.closest('tr');
    if (!row) return;

    var amtEl = row.querySelector('.inclusionAmountInput');
    var opt = this.options[this.selectedIndex];
    var amount = opt ? (opt.getAttribute('data-amount') || '0') : '0';

    if (amtEl) amtEl.value = amount;

    recalcInclusionTotal();
});

$(document).on('input', '.inclusionAmountInput', function () {
    recalcInclusionTotal();
});

$(document).on('select2:select', '.inclusionNameSelect', function () {
    $(this).trigger('change');
});


document.addEventListener('click', function (e) {
  if (e.target.closest('.removeInclusionBtn')) {
    e.target.closest('tr').remove();
    recalcInclusionTotal();
  }
});


document.addEventListener('click', function (e) {
  if (e.target.closest('.removeSpecialReqBtn')) {
    e.target.closest('tr').remove();
    recalcSpecialReqTotal();
  }
});


/* ================= AUTO-FILL COST WHEN SELECT REQUIREMENT ================= */


function num(v) {
  const n = parseFloat(v);
  return isNaN(n) ? 0 : n;
}

function money(n) {
  return num(n).toFixed(2);
}

/* ✅ Recalculate inclusion total */
function recalcInclusionTotal() {
  let total = 0;
  document.querySelectorAll('#inclusionTable tbody [name="inclusion_amount[]"]').forEach(inp => {
    total += num(inp.value);
  });

  const txt = document.getElementById('totalInclusionAmountText');
  const hid = document.getElementById('totalInclusionAmountInput');
  if (txt) txt.textContent = money(total);
  if (hid) hid.value = money(total);

  return total;
}

/* ✅ Recalculate special requirements total */
function recalcSpecialReqTotal() {
  let total = 0;
  document.querySelectorAll('#specialReqTable tbody [name="special_requirements_cost[]"]').forEach(inp => {
    total += num(inp.value);
  });

  const txt = document.getElementById('totalSpecialReqAmountText');
  const hid = document.getElementById('totalSpecialReqAmountInput');
  if (txt) txt.textContent = money(total);
  if (hid) hid.value = money(total);

  return total;
}

/* ✅ Recalculate both (use after add/remove/load) */
function recalcAllInclusionSpecialTotals() {
  recalcInclusionTotal();
  recalcSpecialReqTotal();
}

/* Live update on typing amount fields */
document.addEventListener('input', function (e) {
  if (e.target.matches('#inclusionTable tbody [name="inclusion_amount[]"]')) {
    recalcInclusionTotal();
  }
  if (e.target.matches('#specialReqTable tbody [name="special_requirements_cost[]"]')) {
    recalcSpecialReqTotal();
  }
});

let optionCount = 0;

/* ================= ENABLE ADD OPTION AFTER PACKAGE ================= */

const packageSelect = document.getElementById('packages_id_fk');
const addOptionBtn = document.getElementById('addOptionBtn');
const optionsContainer = document.getElementById('optionsContainer');

packageSelect.addEventListener('change', () => {
  alert("dd")
    addOptionBtn.disabled = !packageSelect.value;
    optionsContainer.innerHTML = '';
    optionCount = 0;
    // loadDayDestOptionsForInclusionAndReq();
});

/* ================= ADD OPTION ================= */

document.getElementById('addOptionBtn')?.addEventListener('click', function (e) {
    e.preventDefault();
    e.stopPropagation();

    optionCount++;

    optionsContainer.insertAdjacentHTML('beforeend', getOptionTemplate(optionCount));

    const optionBlock = optionsContainer.lastElementChild;
    const dropdown = optionBlock.querySelector('.propertyDropdown');
    const vehicleDropdown = optionBlock.querySelector('.vehicle-select');

    fetchPropertyCategories(dropdown);
    fetchVehicles(vehicleDropdown);

    if ($.fn.select2) {
        $(optionBlock).find('.design-type-select').select2({
            width: '100%',
            placeholder: 'Select Design',
            allowClear: true,
            dropdownParent: $('#QuotationModal')
        });

        $(optionBlock).find('.vehicle-select').select2({
            width: '100%',
            placeholder: 'Select Vehicle',
            allowClear: true,
            dropdownParent: $('#QuotationModal')
        });

        $(optionBlock).find('.propertyDropdown').select2({
            width: '100%',
            placeholder: 'Select template option',
            allowClear: true,
            dropdownParent: $('#QuotationModal')
        });
    }

    reIndexOptions();
// clearQuotationOnPackageChange();
      // ✅ fix bootstrap scroll recalculation
    setTimeout(function () {
        $('#QuotationModal').modal('handleUpdate');
    }, 100);
});

function fetchVehicles(dropdown) {
    if (!dropdown) return;

    dropdown.innerHTML = '<option value="">Loading...</option>';

    fetch(`<?php echo base_url(); ?>index.php/Quotation/ajax_get_vehicle_list`)
        .then(res => res.json())
        .then(res => {
            dropdown.innerHTML = '<option value="">Select Vehicle</option>';
            if (!res.status || !res.data) return;

            res.data.forEach(item => {
                const opt = document.createElement('option');
                opt.value = item.vehicle_id;
                opt.textContent = item.vehicle_name + ' (' + item.vehicle_number_seat + ')';
                dropdown.appendChild(opt);
            });
        })
        .catch(() => {
            dropdown.innerHTML = '<option value="">Failed to load vehicle</option>';
        });
}

/* ================= LOAD ITINERARY ON OPTION SELECT ================= */

// ✅ store old value BEFORE dropdown opens
$(document).on('select2:opening', '.propertyDropdown', function () {
    $(this).data('old-value', $(this).val() || '');
});

// ✅ validate on change
$(document).on('change', '.propertyDropdown', function () {
    var current = this;
    var selectedValue = $(current).val() || '';
    var oldValue = $(current).data('old-value') || '';

    if (!selectedValue) return;

    var duplicateFound = false;

    $('.propertyDropdown').not(current).each(function () {
        if (($(this).val() || '') === selectedValue) {
            duplicateFound = true;
            return false;
        }
    });

    if (duplicateFound) {
        alert('This template option is already selected.');

        // ✅ restore previous value correctly
        $(current).val(oldValue).trigger('change.select2');

        return false;
    }
});

$(document).on('change', '.propertyDropdown', function () {
    var dropdown = this;
    if (!dropdown) return;

    const optionBlock = dropdown.closest('.optionBlock');
    if (!optionBlock) return;

    const commonId = dropdown.value;

    const selectedOption = dropdown.options[dropdown.selectedIndex];
    const designType = selectedOption ? (selectedOption.getAttribute('data-design-type') || '') : '';

    const designDropdown = optionBlock.querySelector('.design-type-select');
    if (designDropdown) {
        designDropdown.value = designType;
        if ($.fn.select2 && $(designDropdown).hasClass('select2-hidden-accessible')) {
            $(designDropdown).trigger('change');
        }
    }

    if (!commonId) return;

    loadItinerary(optionBlock, commonId);
});

$(document).on('select2:select', '.propertyDropdown', function () {
    $(this).trigger('change');
});
/* ================= REMOVE OPTION ================= */


document.addEventListener('click', function (e) {
    const btn = e.target.closest('.removeOptionBtn');
    if (!btn) return;

    e.preventDefault();
    e.stopPropagation();

    const uid = btn.getAttribute('data-remove-uid');
    if (!uid) return;

    const block = document.querySelector('.optionBlock[data-option-uid="' + uid + '"]');
    if (block) {
        block.remove();
    }

    reIndexOptions();
});

/* ================= HELPERS ================= */


function reIndexOptions() {
    const blocks = document.querySelectorAll('.optionBlock');
    optionCount = blocks.length;

    blocks.forEach((block, i) => {
        const newIndex = i + 1;

        block.dataset.optionIndex = newIndex;

        const titleEl = block.querySelector('.optionTitle');
        if (titleEl) {
            titleEl.innerText = 'Option ' + newIndex;
        }

        const removeBtn = block.querySelector('.removeOptionBtn');
        if (removeBtn) {
            if (blocks.length === 1) {
                removeBtn.classList.add('d-none');
            } else {
                removeBtn.classList.remove('d-none');
            }
        }
    });
}

/* ================= FETCH PROPERTY OPTIONS ================= */

function fetchPropertyCategories(dropdown) {

    // const packageId = packageSelect.value;
    const packageId = document.getElementById('packages_id_hidden')?.value || '';
    if (!packageId) return;

    dropdown.innerHTML = '<option>Loading...</option>';

    fetch(`<?php echo base_url(); ?>index.php/Quotation/get_property_categories_by_package?package_id=${packageId}`)
        .then(res => res.json())
        .then(res => {
            dropdown.innerHTML = '<option value="">Select template option</option>';
            if (!res.status) return;

            // res.data.forEach(item => {
            //     const opt = document.createElement('option');
            //     opt.value = item.packages_properties_common_id;
            //     opt.textContent = item.packages_properties_common_category_name;
            //     dropdown.appendChild(opt);
            // });
            
            res.data.forEach(item => {
                const opt = document.createElement('option');
                opt.value = item.packages_properties_common_id;
                opt.textContent = item.packages_properties_common_category_name;
                opt.setAttribute('data-design-type', item.packages_properties_common_design_type || '');
                dropdown.appendChild(opt);
            });

            if ($.fn.select2) {
                $(dropdown).select2({
                    width: '100%',
                    placeholder: 'Select template option',
                    allowClear: true,
                    dropdownParent: $('#QuotationModal')
                });
            }
        });
}

/* ================= LOAD FULL ITINERARY ================= */

function formatDateDMY(dateStr) {
    if (!dateStr) return '';

    const parts = dateStr.split('-');
    if (parts.length !== 3) return dateStr;

    return parts[2] + '/' + parts[1] + '/' + parts[0];
}

$(document).on('change', '.optionAmountType', function () {
    var $block = $(this).closest('.option-total-box');
    var val = $(this).val();

    var input = $block.find('.optionPerAmount');

    if (val === 'adult' || val === 'person' || val === 'couple') {
        input.removeClass('d-none');
    } else {
        input.addClass('d-none').val('');
    }
});

function loadItinerary(optionBlock, commonId) {

    const container = optionBlock.querySelector('.itineraryContainer');
    if (!container) return;

    // ✅ Your select id is leads_id (from your HTML)
    const leadId = document.getElementById('leads_id_hidden')?.value || '';
    const packageId = document.getElementById('packages_id_hidden')?.value || '';

    // ✅ Debug (check in browser console)
    console.log('loadItinerary params =>', { leadId, packageId, commonId });

    if (!commonId || !leadId || !packageId) {
        container.innerHTML = `
            <p class="text-danger mb-0">
                Missing params: 
                commonId=${commonId || 'EMPTY'},
                leadId=${leadId || 'EMPTY'},
                packageId=${packageId || 'EMPTY'}.
                Please select Lead + Template + Template Option.
            </p>`;
        return;
    }

    container.innerHTML = '<p>Loading itinerary...</p>';

    const url =
        `<?php echo base_url(); ?>index.php/Quotation/get_package_full_itinerary` +
        `?packages_properties_common_id=${encodeURIComponent(commonId)}` +
        `&lead_id=${encodeURIComponent(leadId)}` +
        `&package_id=${encodeURIComponent(packageId)}`;

    fetch(url)
        .then(async (r) => {
            // ✅ read as text first to avoid JSON.parse crash
            const text = await r.text();
            console.log('API raw response:', text);

            if (!text || text.trim() === '') {
                throw new Error('Empty response from server');
            }

            try {
                return JSON.parse(text);
            } catch (err) {
                throw new Error('Response is not valid JSON. Check API raw response in console.');
            }
        })
        .then(res => {

            if (!res.status || !Array.isArray(res.data) || res.data.length === 0) {
                container.innerHTML = `<p class="text-warning mb-0">No accommodation days found for this lead/template.</p>`;
                return;
            }

            let html = `
                <div class="table-responsive">
                <table class="table table-bordered">
                    <thead class="table-dark">
                        <tr>
                            <th>Day | Date</th>
                            <th>Stay Destination</th>
                            <th>Properties & Rooms</th>
                        </tr>
                    </thead>
                    <tbody>
            `;

            res.data.forEach(day => {

                let propertiesHTML = '';

                (day.properties || []).forEach(property => {

                    let roomsHTML = '';

                    (property.rooms || []).forEach(room => {
                        roomsHTML += `
                            <tr data-room-id="${room.properties_room_category_id || ''}" data-packages-room-id="${room.packages_properties_rooms_id || 0}"
      data-day-id="${day.packages_properties_days_id || 0}">
                                <td class="roomName">
                                    ${room.properties_room_category_name || ''}
                                    <input type="hidden" name="packages_properties_rooms_id_fk[]" value="${room.packages_properties_rooms_id || 0}">
                                    <input type="hidden" name="quotation_properties_rooms_id_fk[]" value="${room.properties_room_category_id || 0}">
                                    <input type="hidden" name="quotation_room_tariff_details_id[]" class="quotationRoomTariffDetailsIdInput" value="${room.quotation_room_tariff_details_id || ''}">    
                                </td>
                                <td><span class="autoCalcRateText">0.00</span><!-- Hidden input for saving to DB -->
    <input type="hidden"
           name="total_room_cost[][]"
           class="autoCalcRateInput"
           value="0.00"></td>
                                <td class="text-center">
                                    <button type="button"
        class="btn btn-sm btn-warning me-1 editRoomBtn"
        data-lead-id="${leadId}"
        data-property-day-id="${day.packages_properties_days_id}"
        data-stay-destination-id="${day.packages_properties_days_destination_id_fk}"
        data-property-id="${property.properties_id}"
        data-room-category-id="${room.properties_room_category_id}">
    <i class="bi bi-pencil"></i>
</button>

                                    <button type="button" class="btn btn-sm btn-danger removeRoomBtn">
                                        <i class="bi bi-trash"></i>
                                    </button>
                                </td>
                            </tr>
                        `;
                    });

                    propertiesHTML += `
                        <div class="propertyBlock mt-3"
                             data-property-id="${property.properties_id || ''}"
                             data-packages-property-id="${property.packages_properties_id || 0}">
                            <h6 class="fw-bold text-primary propertyTitle">
                                Property: ${property.properties_name || ''}
                            </h6>

                            <input type="hidden" name="packages_properties_id_fk[]" value="${property.packages_properties_id || 0}">
                            <input type="hidden" name="properties_id_fk[]" value="${property.properties_id || 0}">

                            <table class="table table-sm table-bordered">
                                <thead class="table-light">
                                    <tr>
                                        <th>Room Name</th>
                                        <th>Calculated Rate</th>
                                        <th class="text-center">Action</th>
                                    </tr>
                                </thead>
                                <tbody>${roomsHTML}</tbody>
                                <tfoot>
                                    <tr>
                                        <td colspan="3" class="text-center">
                                            <button type="button" class="btn btn-sm btn-success addRoomBtn">
                                                <i class="bi bi-plus-circle"></i> Add New Room
                                            </button>
                                        </td>
                                    </tr>
                                </tfoot>
                            </table>
                        </div>
                    `;
                });
// <tr class="itineraryDayRow">
                html += `
                    
                    <tr class="itineraryDayRow" data-itinerary-day-id="${day.packages_itinerary_days_id_fk || 0}">
                        <td>
                            <strong>${day.packages_properties_days_day || ''} | ${formatDateDMY(day.accommodation_date)}</strong>
                            <input type="hidden" name="packages_properties_days_id_fk[]" value="${day.packages_properties_days_id || 0}">
                            <input type="hidden" name="packages_itinerary_days_id_fk[]" value="${day.packages_itinerary_days_id_fk || 0}">
                            <input type="hidden" name="quotation_properties_days_day[]" value="${day.packages_properties_days_day || ''}">
                            <input type="hidden" name="accommodation_plan_id_fk[]" value="${day.accommodation_plan_id || 0}">
                        </td>

                        <td>
                            ${day.state_name || ''}
                            <input type="hidden" name="quotation_properties_days_destination_id_fk[]" value="${day.packages_properties_days_destination_id_fk || 0}">
                        </td>

                        <td>
                            <div class="propertiesContainer">${propertiesHTML}</div>

                            <div class="propertySelector d-none mt-2 border rounded p-2 bg-light">
                                <div class="d-flex gap-2 align-items-start">
                                    <div class="flex-grow-1">
                                        <select class="form-select form-select-sm propertySelectDropdown">
                                            <option value="">Select Property</option>
                                        </select>
                                    </div>
                                    <button type="button" class="btn btn-sm btn-danger removePropertySelectorBtn" title="Remove">
                                        <i class="bi bi-trash"></i>
                                    </button>
                                </div>
                            </div>

                            <div class="text-center mt-2">
                                <button type="button" class="btn btn-sm btn-primary addPropertyBtn">
                                    <i class="bi bi-plus-square"></i> Add Property
                                </button>
                            </div>
                        </td>
                    </tr>
                `;
            });

            html += `</tbody></table><!-- ================= OPTION TOTAL SUMMARY ================= -->
<div class="option-total-box border rounded p-3 mt-4 bg-light">

  <div class="row g-3 align-items-end">

  <!-- Total Cost -->
  <div class="col-md-3">
    <label class="form-label fw-semibold">Total Cost</label>
    <div class="fw-bold text-primary fs-5">
      ₹ <span class="optionTotalCostText">0.00</span>
    </div>
    <input type="hidden" class="optionTotalCostInput" name="option_total_cost[]">
  </div>

  <!-- Amount Type -->
  <div class="col-md-3">
    <label class="form-label fw-semibold">Amount Type</label>
    <div class="d-flex gap-2">
      <select class="form-select form-select-sm optionAmountType" style="width:55%;">
        <option value="net">Net Amount</option>
        <option value="adult">Per Adult</option>
        <option value="person">Per Person</option>
        <option value="couple">Per Couple</option>
      </select>

      <input type="number"
             class="form-control form-control-sm optionPerAmount d-none"
             style="width:45%;"
             placeholder="Amount">
    </div>
  </div>

  <!-- Margin -->
  <div class="col-md-3">
    <label class="form-label fw-semibold">Margin</label>
    <div class="d-flex gap-2">
      <select class="form-select form-select-sm optionMarginType" style="width:45%;">
        <option value="amount">Amount</option>
        <option value="percent">%</option>
      </select>

      <input type="number"
             class="form-control form-control-sm optionMarginValue"
             style="width:55%;"
             placeholder="Margin">
    </div>
  </div>

  <!-- Total Quote Rate -->
  <div class="col-md-3 text-end">
    <label class="form-label fw-semibold">Total Quote Rate</label>
    <div class="fw-bold text-primary fs-4">
      ₹ <span class="optionQuoteTotalText">0.00</span>
    </div>
    <input type="hidden" class="optionQuoteTotalInput" name="option_quote_total[]">
  </div>

</div>
</div>`;
            container.innerHTML = html;
        })
        .catch(err => {
            console.error(err);
            container.innerHTML = `<p class="text-danger mb-0">${err.message}</p>`;
        });
}



/* ================= TEMPLATE ================= */


function getOptionTemplate(index) {
    const uid = 'option_' + Date.now() + '_' + Math.floor(Math.random() * 10000);

    return `
    <div class="optionBlock border p-3 mb-4"
         data-option-index="${index}"
         data-option-uid="${uid}">
         
        <h2 class="optionTitle mb-3">Option ${index}</h2>

        <div class="row mb-3 g-3">
            <div class="col-md-2">
                <label>Select template option</label>
                <select name="packages_properties_common_id_fk[]" class="form-select form-select-sm propertyDropdown">
                    <option value="">Select template option</option>
                </select>
            </div>

            <div class="col-md-2">
                <label>Name of the option</label>
                <input type="text" name="quotation_options_title[]" class="form-control form-control-sm">
            </div>

            <div class="col-md-2">
                <label>Cab amount</label>
                <input type="number" name="quotation_options_cab_amount[]" class="form-control form-control-sm">
            </div>

            <div class="col-md-2">
                <label>Select Design</label>
                <select name="quotation_options_design_type[]" class="form-select form-select-sm design-type-select">
                    <option value="">Select Design</option>
                    <option value="Standard">Standard</option>
                    <option value="Exclusive">Exclusive</option>
                </select>
            </div>

            <div class="col-md-2">
                <label>Select Vehicle</label>
                <select name="quotation_options_vehicle_id_fk[]" class="form-select form-select-sm vehicle-select">
                    <option value="">Select Vehicle</option>
                </select>
            </div>

            <div class="col-md-2 d-flex align-items-end justify-content-end">
                <button type="button"
                        class="btn btn-danger removeOptionBtn ${index === 1 ? 'd-none' : ''}"
                        data-remove-uid="${uid}">
                    <i class="bi bi-trash"></i>
                </button>
            </div>
        </div>

        <div class="row mb-3">
            <div class="col-md-3">
                <div class="form-check mt-2">
                    <input class="form-check-input room-category-display-checkbox"
                           type="checkbox"
                           name="quotation_options_room_category_display[]"
                           value="1"
                           checked>
                    <label class="form-check-label">
                        Show Room Category
                    </label>
                </div>
            </div>

            <div class="col-md-3">
                <div class="form-check mt-2">
                    <input class="form-check-input meal-plan-display-checkbox"
                           type="checkbox"
                           name="quotation_options_meal_plan_display[]"
                           value="1"
                           checked>
                    <label class="form-check-label">
                        Show Meal Plan
                    </label>
                </div>
            </div>

            <div class="col-md-3">
                <div class="form-check mt-2">
                    <input class="form-check-input vehicle-display-checkbox"
                        type="checkbox"
                        name="quotation_options_vehicle_display[]"
                        value="1"
                        checked>
                    <label class="form-check-label">
                        Show Vehicle
                    </label>
                </div>
            </div>
        </div>

        <div class="itineraryContainer"></div>
    </div>
    `;
}
////////////********** *************///////////

function initModalSelect2(el, placeholderText) {
    if (!el) return;

    var $el = $(el);

    if ($el.hasClass('select2-hidden-accessible')) {
        $el.select2('destroy');
    }

    $el.select2({
        width: '100%',
        placeholder: placeholderText || 'Select',
        allowClear: true,
        dropdownParent: $('#QuotationModal')
    });
}


document.addEventListener('click', function (e) {

    const btn = e.target.closest('.addPropertyBtn');
    if (!btn) return;

    const td = btn.closest('td');
    const selector = td.querySelector('.propertySelector');
    const dropdown = selector.querySelector('.propertySelectDropdown');

    selector.classList.remove('d-none');

    if (dropdown.dataset.loaded === '1') {
        initModalSelect2(dropdown, 'Select Property');
        return;
    }

    dropdown.innerHTML = '<option value="">Loading...</option>';

    fetch(`<?php echo base_url(); ?>index.php/Quotation/get_properties`)
        .then(r => r.json())
        .then(r => {
            dropdown.innerHTML = '<option value="">Select Property</option>';

            if (r.status && Array.isArray(r.data)) {
                r.data.forEach(p => {
                    dropdown.innerHTML += `
                        <option value="${p.properties_id}">
                            ${p.properties_name}
                        </option>`;
                });
            }

            dropdown.dataset.loaded = '1';

            // ✅ init select2
            initModalSelect2(dropdown, 'Select Property');
        });
});


$(document).on('change', '.propertySelectDropdown', function () {

    const dropdown = this;
    const propertyId = dropdown.value;
    if (!propertyId) return;

    const td = dropdown.closest('td');
    const propertiesContainer = td.querySelector('.propertiesContainer');

    const exists = [...propertiesContainer.querySelectorAll('.propertyBlock')]
        .some(block => block.dataset.propertyId === propertyId);

    if (exists) {
        alert('This property is already added for this day.');
        $(dropdown).val('').trigger('change');
        return;
    }

    const propertyName = dropdown.options[dropdown.selectedIndex].text;

    propertiesContainer.insertAdjacentHTML('beforeend', `
        <div class="propertyBlock mt-3" data-property-id="${propertyId}">
            
            <div class="d-flex justify-content-between align-items-center mb-2">
                <h6 class="fw-bold text-primary mb-0">
                    Property: ${propertyName}
                </h6>

                <button type="button" class="btn btn-sm btn-danger removePropertyBtn">
                    <i class="bi bi-trash"></i>
                </button>
            </div>

            <input type="hidden" name="properties_id_fk[]" value="${propertyId}">
            <input type="hidden" name="packages_properties_id_fk[]" value="0">

            <table class="table table-sm table-bordered">
                <thead>
                    <tr>
                        <th>Room Name</th>
                        <th>Rate</th>
                        <th class="text-center">Action</th>
                    </tr>
                </thead>
                <tbody></tbody>
                <tfoot>
                    <tr>
                        <td colspan="3" class="text-center">
                            <button type="button" class="btn btn-sm btn-success addRoomBtn">
                                <i class="bi bi-plus-circle"></i> Add Room
                            </button>
                        </td>
                    </tr>
                </tfoot>
            </table>
        </div>
    `);

    $(dropdown).val('').trigger('change');
    dropdown.closest('.propertySelector').classList.add('d-none');
});

document.addEventListener('click', function (e) {
    const btn = e.target.closest('.removePropertyBtn');
    if (!btn) return;

    const propertyBlock = btn.closest('.propertyBlock');
    if (propertyBlock) {
        propertyBlock.remove();
    }
});

$(document).on('click', '.removePropertySelectorBtn', function () {
    var $selector = $(this).closest('.propertySelector');
    $selector.find('.propertySelectDropdown').val('').trigger('change');
    $selector.addClass('d-none');
});

document.addEventListener('change', function (e) {

    if (!e.target.classList.contains('propertySelectDropdown')) return;

    const dropdown = e.target;
    const propertyId = dropdown.value;
    if (!propertyId) return;

    const td = dropdown.closest('td');
    const propertiesContainer = td.querySelector('.propertiesContainer');

    let exists = false;

    propertiesContainer.querySelectorAll('.propertyBlock').forEach(block => {
        if (block.dataset.propertyId === propertyId) {
            exists = true;
        }
    });

    if (exists) {
        alert('This property is already added for this day.');
        dropdown.value = '';
        return;
    }

    // ✅ continue adding property if not duplicate
});


function getRoomRowTemplate(propertyId, rooms, leadId, propertyDayId, stayDestId) {
    let options = `<option value="">Select Room</option>`;

    rooms.forEach(r => {
        options += `
            <option value="${r.properties_room_category_id}"
                    data-room-category-id="${r.properties_room_category_id}"
                    data-package-room-id="${r.packages_properties_rooms_id || 0}">
                ${r.properties_room_category_name}
            </option>
        `;
    });

    return `
        <tr data-room-id="" data-packages-room-id="" data-day-id="${propertyDayId || ''}">
            <td>
                <select class="form-select form-select-sm roomSelect">${options}</select>
                <input type="hidden" name="packages_properties_rooms_id_fk[]" class="pkgRoomInput" value="">
                <input type="hidden" name="quotation_properties_rooms_id_fk[]" class="roomInput" value="">
                <input type="hidden" name="quotation_room_tariff_details_id[]" class="quotationRoomTariffDetailsIdInput" value="">
            </td>

            <td class="roomRate">
                <span class="autoCalcRateText">0.00</span>
                <input type="hidden" name="total_room_cost[][]" class="autoCalcRateInput" value="0.00">
            </td>

            <td class="text-center">
                <button type="button"
                        class="btn btn-sm btn-warning me-1 editRoomBtn"
                        data-lead-id="${leadId || ''}"
                        data-property-id="${propertyId || ''}"
                        data-property-day-id="${propertyDayId || ''}"
                        data-stay-destination-id="${stayDestId || ''}"
                        data-room-category-id="">
                    <i class="bi bi-pencil"></i>
                </button>

                <button type="button" class="btn btn-sm btn-danger removeRoomBtn">
                    <i class="bi bi-trash"></i>
                </button>
            </td>
        </tr>
    `;
}


$(document).on('change', '.roomSelect', function () {
    const select = this;
    const row = select.closest('tr');
    const propertyBlock = select.closest('.propertyBlock');
    const dayRow = select.closest('.itineraryDayRow');

    const roomId = $(select).val();
    if (!roomId) return;

    let duplicate = false;

    // ✅ check all room rows in same property except current row
    $(propertyBlock).find('tbody tr').each(function () {
        if (this === row) return;

        const otherRowRoomId =
            this.dataset.roomId ||
            ($(this).find('.roomSelect').length ? $(this).find('.roomSelect').val() : '');

        if (String(otherRowRoomId) === String(roomId)) {
            duplicate = true;
        }
    });

    if (duplicate) {
        alert('Room already selected');

        row.dataset.roomId = '';
        row.dataset.packagesRoomId = '';
        row.querySelector('.roomInput').value = '';
        row.querySelector('.pkgRoomInput').value = '';

        const editBtnReset = row.querySelector('.editRoomBtn');
        if (editBtnReset) {
            editBtnReset.dataset.roomCategoryId = '';
        }

        $(select).val('').trigger('change.select2');
        return;
    }

    const selectedOption = select.options[select.selectedIndex];
    const packageRoomId = selectedOption ? (selectedOption.getAttribute('data-package-room-id') || 0) : 0;

    const leadId = $('#leads_id_hidden').val() || '';
    const propertyId = propertyBlock?.dataset.propertyId || '';
    const propertyDayId = dayRow?.querySelector('[name="packages_properties_days_id_fk[]"]')?.value || '';
    const stayDestId = dayRow?.querySelector('[name="quotation_properties_days_destination_id_fk[]"]')?.value || '';

    // ✅ save row datasets
    row.dataset.roomId = roomId;
    row.dataset.packagesRoomId = packageRoomId;

    // ✅ save hidden inputs
    row.querySelector('.roomInput').value = roomId;
    row.querySelector('.pkgRoomInput').value = packageRoomId;

//         alert("leadId"+leadId)
// alert("propertyId"+propertyId);
// alert("propertyDayId"+propertyDayId);
// alert("stayDestId"+stayDestId);
// alert("roomId"+roomId);

    // ✅ set edit button datasets
    const editBtn = row.querySelector('.editRoomBtn');
    if (editBtn) {
        editBtn.dataset.leadId = leadId;
        editBtn.dataset.propertyId = propertyId;
        editBtn.dataset.propertyDayId = propertyDayId;
        editBtn.dataset.stayDestinationId = stayDestId;
        editBtn.dataset.roomCategoryId = roomId;
    }

    console.log('editRoomBtn data set =>', {
        leadId: leadId,
        propertyId: propertyId,
        propertyDayId: propertyDayId,
        stayDestId: stayDestId,
        roomCategoryId: roomId,
        packageRoomId: packageRoomId
    });
});

// document.addEventListener('click', function (e) {

//     const btn = e.target.closest('.addRoomBtn');
//     if (!btn) return;

//     const propertyBlock = btn.closest('.propertyBlock');
//     const tbody = propertyBlock.querySelector('tbody');
//     const propertyId = propertyBlock.dataset.propertyId;

//     fetch(`<?php echo base_url(); ?>index.php/Quotation/get_rooms?properties_id=${propertyId}`)
//         .then(res => res.json())
//         .then(res => {
//             if (!res.status || !res.data.length) return;

//             tbody.insertAdjacentHTML(
//                 'beforeend',
//                 getRoomRowTemplate(propertyId, res.data)
//             );
//         });
// });

// document.addEventListener('click', function (e) {
//     const btn = e.target.closest('.addRoomBtn');
//     if (!btn) return;

//     const propertyBlock = btn.closest('.propertyBlock');
//     const tbody = propertyBlock.querySelector('tbody');
//     const propertyId = propertyBlock.dataset.propertyId || '';

//     const dayRow = btn.closest('.itineraryDayRow');
//     const propertyDayId = dayRow?.querySelector('[name="packages_properties_days_id_fk[]"]')?.value || '';
//     const stayDestId = dayRow?.querySelector('[name="quotation_properties_days_destination_id_fk[]"]')?.value || '';
//     const leadId = document.getElementById('selected_lead_id')?.value || '';

//     fetch(`<?php echo base_url(); ?>index.php/Quotation/get_rooms?properties_id=${propertyId}`)
//         .then(res => res.json())
//         .then(res => {
//             if (!res.status || !res.data.length) return;

//             tbody.insertAdjacentHTML(
//                 'beforeend',
//                 getRoomRowTemplate(propertyId, res.data, leadId, propertyDayId, stayDestId)
//             );
//         });
// });

// document.addEventListener('click', function (e) {

//     const btn = e.target.closest('.addRoomBtn');
//     if (!btn) return;

//     const propertyBlock = btn.closest('.propertyBlock');
//     const tbody = propertyBlock.querySelector('tbody');
//     const propertyId = propertyBlock.dataset.propertyId || '';

//     const dayRow = btn.closest('.itineraryDayRow');
//     const propertyDayId = dayRow?.querySelector('[name="packages_properties_days_id_fk[]"]')?.value || '';
//     const stayDestId = dayRow?.querySelector('[name="quotation_properties_days_destination_id_fk[]"]')?.value || '';
//     const leadId = $('#selected_lead_id').val() || '';

//     // ✅ validate existing rows:
//     // if any room row exists but room not selected, stop add new row
//     const roomRows = tbody.querySelectorAll('tr');
//     for (let i = 0; i < roomRows.length; i++) {
//         const roomSelect = roomRows[i].querySelector('.roomSelect');
//         const roomId = roomRows[i].dataset.roomId || (roomSelect ? roomSelect.value : '');

//         if (!roomId) {
//             alert('Please select room in existing row before adding new room.');
//             if (roomSelect) {
//                 initModalSelect2(roomSelect, 'Select Room');
//                 $(roomSelect).select2('open');
//             }
//             return;
//         }
//     }

//     fetch(`<?php echo base_url(); ?>index.php/Quotation/get_rooms?properties_id=${propertyId}`)
//         .then(res => res.json())
//         .then(res => {
//             if (!res.status || !res.data.length) return;

//             tbody.insertAdjacentHTML(
//                 'beforeend',
//                 getRoomRowTemplate(propertyId, res.data, leadId, propertyDayId, stayDestId)
//             );

//             const newRow = tbody.lastElementChild;
//             const roomSelect = newRow.querySelector('.roomSelect');

//             // ✅ init select2
//             initModalSelect2(roomSelect, 'Select Room');
//         });
// });

// document.addEventListener('click', function (e) {
//     const btn = e.target.closest('.addRoomBtn');
//     if (!btn) return;

//     const propertyBlock = btn.closest('.propertyBlock');
//     const tbody = propertyBlock.querySelector('tbody');
//     const propertyId = propertyBlock.dataset.propertyId || '';

//     const dayRow = btn.closest('.itineraryDayRow');
//     const propertyDayId = dayRow?.querySelector('[name="packages_properties_days_id_fk[]"]')?.value || '';
//     const stayDestId = dayRow?.querySelector('[name="quotation_properties_days_destination_id_fk[]"]')?.value || '';
//     const leadId = $('#selected_lead_id').val() || '';

//     const existingRows = tbody.querySelectorAll('tr');

//     // ✅ first click alert when no rooms yet
//     if (existingRows.length === 0) {
//         alert('No rooms added under this property. Please select a room.');
//     }

//     // ✅ if any existing row is still not selected, stop new row
//     for (let i = 0; i < existingRows.length; i++) {
//         const row = existingRows[i];
//         const roomSelect = row.querySelector('.roomSelect');
//         const roomId = row.dataset.roomId || (roomSelect ? roomSelect.value : '');

//         if (!roomId) {
//             alert('Please select room in existing row before adding new room.');
//             if (roomSelect) {
//                 initModalSelect2(roomSelect, 'Select Room');
//                 $(roomSelect).select2('open');
//             }
//             return;
//         }
//     }

//     fetch(`<?php echo base_url(); ?>index.php/Quotation/get_rooms?properties_id=${propertyId}`)
//         .then(res => res.json())
//         .then(res => {
//             if (!res.status || !res.data.length) return;

//             tbody.insertAdjacentHTML(
//                 'beforeend',
//                 getRoomRowTemplate(propertyId, res.data, leadId, propertyDayId, stayDestId)
//             );

//             const newRow = tbody.lastElementChild;
//             const roomSelect = newRow.querySelector('.roomSelect');

//             initModalSelect2(roomSelect, 'Select Room');
//         });
// });

const roomCache = {}; // ✅ cache rooms per property

document.addEventListener('click', async function (e) {
    const btn = e.target.closest('.addRoomBtn');
    if (!btn) return;

    const propertyBlock = btn.closest('.propertyBlock');
    const tbody = propertyBlock.querySelector('tbody');
    const propertyId = propertyBlock.dataset.propertyId || '';

    const dayRow = btn.closest('.itineraryDayRow');
    const propertyDayId = dayRow?.querySelector('[name="packages_properties_days_id_fk[]"]')?.value || '';
    const stayDestId = dayRow?.querySelector('[name="quotation_properties_days_destination_id_fk[]"]')?.value || '';
    const leadId = $('#selected_lead_id').val() || '';

    const existingRows = tbody.querySelectorAll('tr');

    // ✅ Validate existing rows first
    for (let row of existingRows) {
        const roomSelect = row.querySelector('.roomSelect');
        const roomId = row.dataset.roomId || (roomSelect ? $(roomSelect).val() : '');

        if (!roomId) {
            alert('Please select room in existing row before adding new room.');
            if (roomSelect) {
                initModalSelect2(roomSelect, 'Select Room');
                $(roomSelect).select2('open');
            }
            return;
        }
    }

    let rooms = [];

    try {
        // ✅ use cache
        if (roomCache[propertyId]) {
            rooms = roomCache[propertyId];
        } else {
            const res = await fetch(`<?php echo base_url(); ?>index.php/Quotation/get_rooms?properties_id=${propertyId}`);
            const data = await res.json();

            if (!data.status || !Array.isArray(data.data)) {
                alert('No rooms available under this property.');
                return;
            }

            rooms = data.data;
            roomCache[propertyId] = rooms; // ✅ cache
        }

        // ✅ FINAL CHECK (only here alert)
        if (!rooms.length) {
            alert('No rooms available under this property.');
            return;
        }

        // ✅ insert row
        tbody.insertAdjacentHTML(
            'beforeend',
            getRoomRowTemplate(propertyId, rooms, leadId, propertyDayId, stayDestId)
        );

        const newRow = tbody.lastElementChild;
        const roomSelect = newRow.querySelector('.roomSelect');

        initModalSelect2(roomSelect, 'Select Room');

    } catch (err) {
        console.error(err);
        alert('Error loading rooms');
    }
});

document.addEventListener('click', function (e) {

    const btn = e.target.closest('.removeRoomBtn');
    if (!btn) return;

    btn.closest('tr').remove();
});

function parseDayDestValue(val) {
  // "dayId|stayDestId|date"
  const parts = (val || '').split('|');
  return {
    packages_properties_days_id_fk: parts[0] ? parseInt(parts[0], 10) : 0,
    stay_destination_id_fk: parts[1] ? parseInt(parts[1], 10) : 0,
    accommodation_date: parts[2] || ''
  };
}


function buildQuotationPayload() {

    const payload = { options: [], inclusions: [], special_requirements: [] };

    // Loop through each option block
    document.querySelectorAll('.optionBlock').forEach(optionBlock => {

        const option = {
            packages_properties_common_id_fk:
                optionBlock.querySelector('.propertyDropdown')?.value || '',
            title:
                optionBlock.querySelector('[name="quotation_options_title[]"]')?.value || '',
            cab_amount:
                optionBlock.querySelector('[name="quotation_options_cab_amount[]"]')?.value || '',

            quotation_options_design_type:
                optionBlock.querySelector('[name="quotation_options_design_type[]"]')?.value || '',

            quotation_options_vehicle_id_fk:
                optionBlock.querySelector('[name="quotation_options_vehicle_id_fk[]"]')?.value || '',

            quotation_options_room_category_display:
                optionBlock.querySelector('[name="quotation_options_room_category_display[]"]')?.checked ? 1 : 0,

            quotation_options_meal_plan_display:
                optionBlock.querySelector('[name="quotation_options_meal_plan_display[]"]')?.checked ? 1 : 0,

            quotation_options_vehicle_display:
                optionBlock.querySelector('[name="quotation_options_vehicle_display[]"]')?.checked ? 1 : 0,
            
            // ✅ NEW: save exactly what UI calculated
            quotation_options_total_cost:
                optionBlock.querySelector('.optionTotalCostInput')?.value || '0',

            // store 'percent' or 'amount' (same as your UI)
            quotation_options_margin_type:
                optionBlock.querySelector('.optionMarginType')?.value || 'amount',

            quotation_options_margin_value:
                optionBlock.querySelector('.optionMarginValue')?.value || '0',

            quotation_options_total_quote_rate:
            optionBlock.querySelector('.optionQuoteTotalInput')?.value || '0',

            quotation_options_amount_type:
             optionBlock.querySelector('.optionAmountType')?.value || 'net',

            quotation_options_per_amount:
            optionBlock.querySelector('.optionPerAmount')?.value || 0,
            days: []
        };

        // Loop only actual day rows in itinerary table (skip room/property rows)
        optionBlock.querySelectorAll('.itineraryContainer tbody > tr').forEach(dayRow => {

            // Only process rows that contain day inputs
            const dayIdInput = dayRow.querySelector('[name="packages_properties_days_id_fk[]"]');
            if (!dayIdInput) return; // skip non-day rows

            const day = {
                packages_properties_days_id_fk: dayIdInput.value,
                day: dayRow.querySelector('[name="quotation_properties_days_day[]"]')?.value || '',
                destination_id: dayRow.querySelector('[name="quotation_properties_days_destination_id_fk[]"]')?.value || '',
                accommodation_plan_id_fk:dayRow.querySelector('[name="accommodation_plan_id_fk[]"]')?.value || 0,
                properties: []
            };

            // Loop properties within this day
            const propertiesContainer = dayRow.querySelector('.propertiesContainer');
            if (propertiesContainer) {
                propertiesContainer.querySelectorAll('.propertyBlock').forEach(propertyBlock => {

                    const property = {
                        packages_properties_id_fk: propertyBlock.dataset.packagesPropertyId || 0,
                        properties_id_fk: propertyBlock.dataset.propertyId || 0,
                        rooms: []
                    };

                    
                    // Loop rooms within this property
                    propertyBlock.querySelectorAll('tbody tr').forEach(roomRow => {
                        if (!roomRow.dataset.roomId) return;

                        //READ TOTAL ROOM COST from the row (you must have this hidden input in the row)
            const totalRoomCost =
              roomRow.querySelector('input.autoCalcRateInput')?.value ||
              roomRow.querySelector('[name="total_room_cost[]"]')?.value ||
              '0';
            //             property.rooms.push({
            //                 packages_properties_rooms_id_fk: roomRow.dataset.packagesRoomId || 0,
            //                 quotation_properties_rooms_id_fk: roomRow.dataset.roomId,
            //                  // ✅ NEW FIELD (will go to DB later)
            //   total_room_cost: totalRoomCost
            //             });

                        property.rooms.push({
                            packages_properties_rooms_id_fk: roomRow.dataset.packagesRoomId || 0,
                            quotation_properties_rooms_id_fk: roomRow.dataset.roomId,
                            total_room_cost: totalRoomCost,
                            quotation_room_tariff_details_id: roomRow.querySelector('.quotationRoomTariffDetailsIdInput')?.value || 0
                        });
                    });

                    day.properties.push(property);
                });
            }

            option.days.push(day);
        });

        payload.options.push(option);
    });


    
        // ================= INCLUSIONS =================
    // payload.inclusions = [];
    // document.querySelectorAll('#inclusionTable tbody tr').forEach(tr => {
    //   const dayKey = tr.querySelector('[name="inclusion_day_key[]"]')?.value || '';
    //   const name = tr.querySelector('[name="inclusion_name[]"]')?.value || '';
    //   const amount = tr.querySelector('[name="inclusion_amount[]"]')?.value || '';

    //   if (!dayKey || !name) return;

    //   payload.inclusions.push({ dayKey, name, amount });
    // });
    
    // payload.inclusions = [];
    // document.querySelectorAll('#inclusionTable tbody tr').forEach(tr => {
    //     const dayKey = tr.querySelector('[name="inclusion_day_key[]"]')?.value || '';
    //     const propertyId = tr.querySelector('[name="inclusion_property_id_fk[]"]')?.value || '';
    //     const propertyInclusionId = tr.querySelector('[name="property_inclusions_id_fk[]"]')?.value || '';
    //     const amount = tr.querySelector('[name="inclusion_amount[]"]')?.value || '';

    //     if (!dayKey || !propertyId || !propertyInclusionId) return;

    //     payload.inclusions.push({
    //         dayKey: dayKey,
    //         property_id_fk: propertyId,
    //         property_inclusions_id_fk: propertyInclusionId,
    //         amount: amount
    //     });
    // });

    payload.inclusions = [];

    $('#inclusionTable tbody tr').each(function () {
        var $tr = $(this);

        var packageOptionId = $tr.find('.inclusionPackageOptionSelect').val() || '';
        var dayKey = $tr.find('.inclusionDaySelect').val() || '';
        var propertyId = $tr.find('.inclusionPropertySelect').val() || '';
        var propertyInclusionId = $tr.find('.inclusionNameSelect').val() || '';
        var name = $tr.find('.inclusionNameSelect option:selected').text() || '';
        var amount = $tr.find('.inclusionAmountInput').val() || '';

        if (!packageOptionId && !dayKey && !propertyId && !propertyInclusionId && !amount) {
            return;
        }

        if (!dayKey || !propertyId || !propertyInclusionId) {
            console.log('Skipped incomplete inclusion row', {
                packageOptionId: packageOptionId,
                dayKey: dayKey,
                propertyId: propertyId,
                propertyInclusionId: propertyInclusionId,
                amount: amount
            });
            return;
        }

      payload.inclusions.push({
            package_option_id_fk: packageOptionId,
            quotation_options_id_fk: $(this).closest('.optionBlock').data('option-id') || '', // ✅ ADD THIS
            dayKey: dayKey,
            property_id_fk: propertyId,
            property_inclusions_id_fk: propertyInclusionId,
            name: name,
            amount: amount
        });
    });

    console.log('Final inclusions payload:', payload.inclusions);
    // ================= SPECIAL REQUIREMENTS =================
    payload.special_requirements = [];
    document.querySelectorAll('#specialReqTable tbody tr').forEach(tr => {
      const dayKey = tr.querySelector('[name="specialreq_day_key[]"]')?.value || '';
      const reqId = tr.querySelector('[name="quotation_special_requirements_id_fk[]"]')?.value || '';
      const cost = tr.querySelector('[name="special_requirements_cost[]"]')?.value || '';

      if (!dayKey || !reqId) return;

      payload.special_requirements.push({
        dayKey,
        quotation_special_requirements_id_fk: reqId,
        cost
      });
    });

    return payload;
}

    function recalcAllOptionsBeforeSave() {
  document.querySelectorAll('.optionBlock').forEach(ob => recalcOptionTotals(ob));
}


////////////********** *************///////////


function setHtmlSafe(selector, html) {
    const el = document.querySelector(selector);
    if (el) el.innerHTML = html;
}

function setTextSafe(selector, text) {
    const el = document.querySelector(selector);
    if (el) el.textContent = text;
}

/* ================= EDIT ROOM BUTTON (ENQUIRY ONLY) ================= */
/* helpers (keep yours) */
/* ================= SAFE HELPERS ================= */
function setHtmlSafe(selector, html) {
    const el = document.querySelector(selector);
    if (el) el.innerHTML = html;
}
function setTextSafe(selector, text) {
    const el = document.querySelector(selector);
    if (el) el.textContent = text;
}


/***********************
 *  POLICY AGE HELPERS
 ***********************/
function toInt(v, def = 0) {
  const n = parseInt(v, 10);
  return Number.isFinite(n) ? n : def;
}

function inRange(age, from, to) {
  if (!Number.isFinite(age)) return false;
  if (!Number.isFinite(from) || !Number.isFinite(to)) return false;
  return age >= from && age <= to;
}

function normalizeYesNo(v) {
  const s = String(v ?? '').trim().toLowerCase();
  return (s === 'y' || s === 'yes' || s === '1' || s === 'true');
}

/**
 * Build room policy age ranges string:
 * Baby 2-3 YR | Child 4-14 YR OR Baby - | Child -
 */
function getRoomPolicyAgeText(room) {
  const babyType = normalizeYesNo(room.properties_room_category_complimentary_guest_between_type);
  const babyFrom = toInt(room.properties_room_category_complimentary_guest_between_from_year, 0);
  const babyTo   = toInt(room.properties_room_category_complimentary_guest_between_to_year, 0);

  const childType = normalizeYesNo(room.properties_room_category_child_rate_applied_guest_between_type);
  const childFrom = toInt(room.properties_room_category_child_rate_applied_guest_from_year, 0);
  const childTo   = toInt(room.properties_room_category_child_rate_applied_guest_to_year, 0);

  const babyTxt  = (babyType && babyFrom > 0 && babyTo > 0) ? `Baby ${babyFrom}-${babyTo} YR` : `Baby -`;
  const childTxt = (childType && childFrom > 0 && childTo > 0) ? `Child ${childFrom}-${childTo} YR` : `Child -`;

  return `${babyTxt} | ${childTxt}`;
}

/***********************
 *  APPLIED PLAN (AGE BASED)
 *  Turns enquiry children ages into: adult/child/baby counts
 ***********************/
function computeAppliedCountsFromAges(room, enquiryPlan, childAges) {
  // enquiryPlan: { adults, children } from guset_count_details
  // childAges: [{age, count}, ...] from child_age_break_up

  const welcomesAll = normalizeYesNo(room.properties_room_category_welcomes_child_all_ages);
  const restrictUnder = toInt(room.properties_room_category_admission_restricted_guests_under_age, 0);

  const compType = normalizeYesNo(room.properties_room_category_complimentary_guest_between_type);
  const compFrom = toInt(room.properties_room_category_complimentary_guest_between_from_year, 0);
  const compTo   = toInt(room.properties_room_category_complimentary_guest_between_to_year, 0);

  const childType = normalizeYesNo(room.properties_room_category_child_rate_applied_guest_between_type);
  const childFrom = toInt(room.properties_room_category_child_rate_applied_guest_from_year, 0);
  const childTo   = toInt(room.properties_room_category_child_rate_applied_guest_to_year, 0);

  const adultOver = toInt(room.properties_room_category_adult_rate_applied_guest_over, 0);

  let adults = toInt(enquiryPlan.adults, 0);
  let children = 0;
  let baby = 0;

  let hasUnderRestrictedChild = false;

  // If you didn’t store ages, fall back to enquiryPlan.children
  const ageRows = Array.isArray(childAges) && childAges.length
    ? childAges
    : (toInt(enquiryPlan.children, 0) ? [{ age: null, count: toInt(enquiryPlan.children, 0) }] : []);

  ageRows.forEach(row => {
    const age = row.age === null ? null : toInt(row.age, NaN);
    const cnt = toInt(row.count, 0);
    if (cnt <= 0) return;

    // If no age info => treat as "child" unless rule #1 forces adult
    if (age === null || !Number.isFinite(age)) {
      // Rule 1: adultOver == 0 AND welcomesAll==Y AND restrictUnder==0 => child becomes adult
      if (adultOver === 0 && welcomesAll && (!restrictUnder || restrictUnder === 0)) {
        adults += cnt;
      } else {
        children += cnt;
      }
      return;
    }

    // Rule 2: restricted age -> convert to adult and flag warning
    if (!welcomesAll && restrictUnder > 0 && age < restrictUnder) {
      adults += cnt;
      hasUnderRestrictedChild = true;
      return;
    }

    // Rule 3: complimentary range => baby
    if (compType && compFrom > 0 && compTo > 0 && inRange(age, compFrom, compTo)) {
      baby += cnt;
      return;
    }

    // Rule 4: child rate range => child
    if (childType && childFrom > 0 && childTo > 0 && inRange(age, childFrom, childTo)) {
      children += cnt;
      return;
    }

    // Adult rule by age
    if (adultOver > 0 && age >= adultOver) {
      adults += cnt;
      return;
    }

    // Rule 1 again (welcomes + adultOver==0)
    if (adultOver === 0 && welcomesAll && (!restrictUnder || restrictUnder === 0)) {
      adults += cnt;
      return;
    }

    // default => child
    children += cnt;
  });

  return {
    applied: { adults, children, baby },
    warnings: {
      restrictUnder,
      hasUnderRestrictedChild
    }
  };
}

/***********************
 *  CORE ALLOCATOR
 *  Uses policy db/eb/sb like your examples
 *
 *  Interpretation:
 *  - db = number of adults allowed per room WITHOUT extra bed
 *  - eb = extra adult capacity per room (extra beds)
 *  - sb = sharing-bed capacity per room for baby/child
 ***********************/
function autoAllocate(policy, applied) {
  const db = toInt(policy.db, 0);
  const eb = toInt(policy.eb, 0);
  const sb = toInt(policy.sb, 0);

  let adults = toInt(applied.adults, 0);
  let children = toInt(applied.children, 0);
  let baby = toInt(applied.baby, 0);

  // outputs
  const out = {
    eligible: true,
    // pax-wise
    pax: {
      adult: { db: 0, eb: 0, sb: 0, sgl: 0 },
      child: { db: 0, eb: 0, sb: 0, sgl: 0 },
      baby:  { db: 0, eb: 0, sb: 0, sgl: 0 },
    },
    // rooming plan inputs (counts only)
    plan: {
      rooms_units: 0,
      extra_bed_adult: 0,
      child_sharing_bed: 0,
      single_occupancy: 0
    },
    // messages under pax box
    notes: {
      surplus: { db: 0, eb: 0, sb: 0 },
      excess:  { eb: 0 },
      alerts: []
    }
  };

  // ======= Scenario 1: all zero => not eligible
  if (db === 0 && eb === 0 && sb === 0) {
    out.eligible = false;
    out.notes.alerts.push('This room is not eligible for booking this lead. Please update DB count.');
    return out;
  }

  // ======= Adult-only invalid: db=0 sb>0 eb=0
  if (adults > 0 && children === 0 && baby === 0 && db === 0 && eb === 0 && sb > 0) {
    out.eligible = false;
    out.notes.alerts.push('This room is not eligible for booking this lead. Please update DB count.');
    return out;
  }

  // ======= Adult-only: 1 adult special SGL rules
  if (adults === 1 && children === 0 && baby === 0) {

    // scenario 2: db>=1 eb=0 => SGL 1
    if (db >= 1 && eb === 0) {
      out.pax.adult.sgl = 1;
      out.plan.single_occupancy = 1;
      out.plan.rooms_units = 1;
      return out;
    }

    // scenario 3: db=0 eb>=1 => SGL 1 and EB 1
    if (db === 0 && eb >= 1) {
      out.pax.adult.sgl = 1;
      out.pax.adult.eb = 1;
      out.plan.single_occupancy = 1;
      out.plan.extra_bed_adult = 1;
      out.plan.rooms_units = 1;
      out.notes.excess.eb = 1; // "Excess Bed Utilization: EB:1"
      return out;
    }

    // scenario 4: db=0 sb>=1 eb=0 already handled invalid above
  }

  // ======= General Adult allocation (your examples 5-14 etc.)
  // If db == 0 and adults > 0, only EB can host adults (rare but you used it)
  // We'll treat room base capacity = db + eb. If db=0, capacity = eb.
  const capAdultPerRoom = db + eb;

  if (adults > 0) {

    // If cap is 0 but adults exist => not eligible
    if (capAdultPerRoom <= 0) {
      out.eligible = false;
      out.notes.alerts.push('This room is not eligible for booking this lead. Please update DB/EB policy.');
      return out;
    }

    // rooms needed
    const rooms = Math.ceil(adults / capAdultPerRoom);

    // DB utilization means: rooms count (like your examples)
    // For db=1 -> adult DB becomes adults because rooms = adults when cap=1
    // For db=2 -> adult DB becomes rooms (e.g. 8 adults => rooms 4)
    // BUT you display "Adult DB" as number of rooms (units). That matches your examples.
    out.pax.adult.db = rooms; // number of rooms
    out.plan.rooms_units = rooms;

    // base beds available for adults inside rooms = rooms * db
    const baseBedSlots = rooms * db;

    // extra adults beyond base => EB used
    let needExtra = Math.max(0, adults - baseBedSlots);

    // EB capacity total
    const ebCap = rooms * eb;

    // clamp
    if (needExtra > ebCap) {
      // should not happen if rooms computed from capAdultPerRoom,
      // but keep safe
      needExtra = ebCap;
      out.notes.alerts.push('Not enough EB capacity for this enquiry.');
    }

    out.pax.adult.eb = needExtra;
    out.plan.extra_bed_adult = needExtra;

    // Surplus EB (when eb policy exists and not fully used)
    if (eb > 0) {
      out.notes.surplus.eb = Math.max(0, ebCap - needExtra);
    }

    // Special: if db=0 and adults hosted only by EB => mark EB “excess”
    if (db === 0 && needExtra > 0) {
      out.notes.excess.eb = needExtra;
    }

    // Special: if adults==1 and db>=1 but eb>0, still your rule says SGL
    // We already handled adults===1 earlier, but keep safe
    if (adults === 1) {
      out.pax.adult.db = 0;
      out.pax.adult.eb = (db === 0 ? 1 : 0);
      out.pax.adult.sgl = 1;
      out.plan.rooms_units = 1;
      out.plan.single_occupancy = 1;
    }
  }

  // ======= Child/Baby allocation into SB (per room)
  // Your later scenarios use SB for baby/child “sharing bed”.
  // We allocate sharing beds across rooms calculated above.
  const roomsCount = Math.max(1, out.plan.rooms_units || 0);
  const sbCapTotal = roomsCount * sb;
  const needSB = children + baby;

  const useSB = Math.min(sbCapTotal, needSB);
  out.plan.child_sharing_bed = useSB;

  // split SB usage: prefer baby first, then child (common)
  const babySB = Math.min(baby, useSB);
  const childSB = Math.max(0, useSB - babySB);

  out.pax.baby.sb = babySB;
  out.pax.child.sb = childSB;

  // Surplus SB
  if (sb > 0) out.notes.surplus.sb = Math.max(0, sbCapTotal - useSB);

  // If there are remaining child/baby not placed
  const remain = needSB - useSB;
  if (remain > 0) {
    out.notes.alerts.push('Not enough SB capacity for child/baby. Please adjust rooming manually.');
  }

  // Surplus DB (when db per room > what is required per room, like your db=4 example)
  // In your example: adults=9, db=4 => rooms=3, baseBedSlots=12, unused base beds = 3
  // You show "Surplus Bed Available: DB:3"
  const unusedBaseBeds = Math.max(0, (roomsCount * db) - adults);
  out.notes.surplus.db = unusedBaseBeds;

  return out;
}

/***********************
 *  APPLY ALLOCATION TO MODAL UI
 ***********************/
function applyAllocationToModal(allocation) {
  // reset message areas if you have them
  setTextSafe('#paxNoteSurplus', '');
  setTextSafe('#paxNoteExcess', '');
  setTextSafe('#paxNoteAlert', '');

  // pax-wise spans
  setTextSafe('[data-role="adult-db"]', allocation.pax.adult.db);
  setTextSafe('[data-role="adult-eb"]', allocation.pax.adult.eb);
  setTextSafe('[data-role="adult-sb"]', allocation.pax.adult.sb);
  setTextSafe('[data-role="adult-sgl"]', allocation.pax.adult.sgl);

  setTextSafe('[data-role="child-db"]', allocation.pax.child.db);
  setTextSafe('[data-role="child-eb"]', allocation.pax.child.eb);
  setTextSafe('[data-role="child-sb"]', allocation.pax.child.sb);
  setTextSafe('[data-role="child-sgl"]', allocation.pax.child.sgl);

  setTextSafe('[data-role="baby-db"]', allocation.pax.baby.db);
  setTextSafe('[data-role="baby-eb"]', allocation.pax.baby.eb);
  setTextSafe('[data-role="baby-sb"]', allocation.pax.baby.sb);
  setTextSafe('[data-role="baby-sgl"]', allocation.pax.baby.sgl);

  // rooming plan input fields (Auto)
  // Use your modal input names/ids; adjust selectors if different.
  const autoRooms = document.querySelector('[name="auto_room_member_count"]');
  const autoEB    = document.querySelector('[name="auto_extra_bed_adult_count"]');
  const autoSB    = document.querySelector('[name="auto_child_sharing_bed_count"]');
  const autoSGL   = document.querySelector('[name="auto_single_occupancy_count"]');

  if (autoRooms) autoRooms.value = allocation.plan.rooms_units;
  if (autoEB)    autoEB.value    = allocation.plan.extra_bed_adult;
  if (autoSB)    autoSB.value    = allocation.plan.child_sharing_bed;
  if (autoSGL)   autoSGL.value   = allocation.plan.single_occupancy;

  // rooming plan input fields (Manual) default same as auto
  const manRooms = document.querySelector('[name="manual_count"]');
  const manEB    = document.querySelector('[name="manual_extra_bed_adult_count"]');
  const manSB    = document.querySelector('[name="manual_child_sharing_bed_count"]');
  const manSGL   = document.querySelector('[name="manual_single_occupancy_count"]');

  if (manRooms) manRooms.value = allocation.plan.rooms_units;
  if (manEB)    manEB.value    = allocation.plan.extra_bed_adult;
  if (manSB)    manSB.value    = allocation.plan.child_sharing_bed;
  if (manSGL)   manSGL.value   = allocation.plan.single_occupancy;

  // notes
  const surplusParts = [];
  if (allocation.notes.surplus.db > 0) surplusParts.push(`DB:${allocation.notes.surplus.db}`);
  if (allocation.notes.surplus.eb > 0) surplusParts.push(`EB:${allocation.notes.surplus.eb}`);
  if (allocation.notes.surplus.sb > 0) surplusParts.push(`SB:${allocation.notes.surplus.sb}`);

  if (surplusParts.length) {
    setTextSafe('#paxNoteSurplus', `Surplus Bed Available: ${surplusParts.join(' ')}`);
  }

  if (allocation.notes.excess.eb > 0) {
    setTextSafe('#paxNoteExcess', `Excess Bed Utilization: EB:${allocation.notes.excess.eb}`);
  }

  if (allocation.notes.alerts.length) {
    setTextSafe('#paxNoteAlert', allocation.notes.alerts.join(' | '));
  }
}


/* ================= EDIT ROOM BUTTON (FULL) ================= */
function setHtmlSafe(selector, html) {
    var el = document.querySelector(selector);
    if (el) el.innerHTML = html;
}
function setTextSafe(selector, text) {
    var el = document.querySelector(selector);
    if (el) el.textContent = (text === undefined || text === null) ? '' : String(text);
}
function setTextSafeIn(modalEl, selector, text) {
    if (!modalEl) return;
    var el = modalEl.querySelector(selector);
    if (el) el.textContent = (text === undefined || text === null) ? '' : String(text);
}
function setHtmlSafeIn(modalEl, selector, html) {
    if (!modalEl) return;
    var el = modalEl.querySelector(selector);
    if (el) el.innerHTML = html || '';
}

function nval(selector)
{
    return parseFloat($(selector).val()) || 0;
}

function clearRoomPricingWarnings()
{
    $('#roomPricingWarningBox')
        .addClass('d-none')
        .html('');
}

function showRoomPricingWarnings(messages)
{
    if (!messages || messages.length === 0) {
        clearRoomPricingWarnings();
        return;
    }

    var html = '<div class="alert alert-warning mb-0">';

    $.each(messages, function(i, msg) {
        html += '<div class="mb-1"><i class="bi bi-exclamation-triangle me-1"></i>' + msg + '</div>';
    });

    html += '</div>';

    $('#roomPricingWarningBox')
        .removeClass('d-none')
        .html(html);
}

function checkRoomPricingWarnings()
{
    var messages = [];

    /*
      CASE 1:
      Check both auto and manual rates.
      If all rates are zero, show tariff warning.
    */
    var roomAutoRate = nval('[name="auto_room_member_rate"]');
    var roomManRate  = nval('[name="manual_rate"]');

    var sglAutoRate  = nval('[name="auto_single_occupancy_rate"]');
    var sglManRate   = nval('[name="manual_single_occupancy_rate"]');

    var ebaAutoRate  = nval('[name="auto_extra_bed_adult_rate"]');
    var ebaManRate   = nval('[name="manual_extra_bed_adult_rate"]');

    var cwbAutoRate  = nval('[name="auto_extra_bed_child_rate"]');
    var cwbManRate   = nval('[name="manual_extra_bed_child_rate"]');

    var cnbAutoRate  = nval('[name="auto_child_sharing_bed_rate"]');
    var cnbManRate   = nval('[name="manual_child_sharing_bed_rate"]');

    var tariffFound =
        roomAutoRate > 0 || roomManRate > 0 ||
        sglAutoRate  > 0 || sglManRate  > 0 ||
        ebaAutoRate  > 0 || ebaManRate  > 0 ||
        cwbAutoRate  > 0 || cwbManRate  > 0 ||
        cnbAutoRate  > 0 || cnbManRate  > 0;

    if (!tariffFound) {
        messages.push(
            'Rates for all bed units were not found in the tariff. Auto rooming amounts may show as zero — enter per-unit rates manually in the rooming table.'
        );
    }

    /*
      CASE 2:
      Meal supplement missing.
      Use tariff data stored on the modal by applyTariffRatesToModal.
    */
    var modalEl = document.getElementById('roompricingandguestallocationModal');
    var tariffData = null;
    if (modalEl && modalEl.dataset.tariffData) {
        try { tariffData = JSON.parse(modalEl.dataset.tariffData); } catch (e) { tariffData = null; }
    }

    if (tariffData && tariffData.needs_supplement) {
        var autoSupplement  = nval('[name="auto_supplment_cost"]');
        var manualSupplement = nval('[name="manual_supplment_cost"]');

        // If backend says supplement is needed but couldn't find the tariff rates for missing meals
        if (tariffData.meal_rates_missing && tariffData.meal_rates_missing.length > 0) {
            messages.push(
                'Meal rates not found. Update rates or enter manually in the supplement cost field.'
            );
        }
    }

    showRoomPricingWarnings(messages);
}

// Check warnings when modal opens (after fields are populated)
$('#roompricingandguestallocationModal').on('shown.bs.modal', function () {
    setTimeout(function () {
        checkRoomPricingWarnings();
    }, 500);
});

$(document).on('input change', '#roompricingandguestallocationModal input', function () {
    checkRoomPricingWarnings();
});

$(document).on('click', '.editRoomBtn', function () {
clearRoomPricingWarnings();
    window.__lastRoomEditBtn = this;

    let row = $(this).closest('tr');

    let day_id_fk = row.find('[name="packages_properties_days_id_fk[]"]').val();
    let room_row_fk = row.find('[name="quotation_properties_rooms_id_fk[]"]').val();

    $.ajax({
        url: '<?php echo base_url(); ?>index.php/Quotation/ajax_get_quotation_room_tariff_details',
        type: "GET",
        dataType: "json",
        data: {
            packages_properties_days_id_fk: day_id_fk,
            quotation_properties_rooms_id_fk: room_row_fk
        },
        // success: function (res) {

        //     if (res.status) {

        //         let d = res.data;

        //         // ✅ SET HIDDEN ID
        //         $('#modal_quotation_room_tariff_details_id')
        //             .val(d.quotation_room_tariff_details_id);

        //         // ✅ AUTO SECTION
        //         $('[name="room_unit_auto_count"]').val(d.room_unit_auto_count);
        //         $('[name="room_unit_auto_rate"]').val(d.room_unit_auto_rate);

        //         // ✅ MANUAL SECTION
        //         $('[name="room_unit_manual_count"]').val(d.room_unit_manual_count);
        //         $('[name="room_unit_manual_rate"]').val(d.room_unit_manual_rate);

        //         // 👉 repeat for all fields (same mapping)

        //         // ✅ TRIGGER TOTAL CALCULATION
        //         calculateRoomTariffTotals();

        //     } else {
        //         // no data → reset modal
        //         $('#modal_quotation_room_tariff_details_id').val('');
        //         resetRoomTariffModal();
        //     }
        // }

        success: function (res) {

    clearRoomPricingWarnings();

    if (res.status) {

        let d = res.data;

        $('#modal_quotation_room_tariff_details_id')
            .val(d.quotation_room_tariff_details_id);

        $('[name="room_unit_auto_count"]').val(d.room_unit_auto_count);
        $('[name="room_unit_auto_rate"]').val(d.room_unit_auto_rate);

        $('[name="room_unit_manual_count"]').val(d.room_unit_manual_count);
        $('[name="room_unit_manual_rate"]').val(d.room_unit_manual_rate);

        $('[name="single_occupancy_auto_rate"]').val(d.single_occupancy_auto_rate);
        $('[name="single_occupancy_manual_rate"]').val(d.single_occupancy_manual_rate);

        $('[name="extra_bed_adult_auto_rate"]').val(d.extra_bed_adult_auto_rate);
        $('[name="extra_bed_adult_manual_rate"]').val(d.extra_bed_adult_manual_rate);

        $('[name="extra_bed_child_auto_rate"]').val(d.extra_bed_child_auto_rate);
        $('[name="extra_bed_child_manual_rate"]').val(d.extra_bed_child_manual_rate);

        $('[name="child_sharing_bed_auto_rate"]').val(d.child_sharing_bed_auto_rate);
        $('[name="child_sharing_bed_manual_rate"]').val(d.child_sharing_bed_manual_rate);

        $('[name="adult_meal_plan_rate"]').val(d.adult_meal_plan_rate || 0);
        $('[name="child_meal_plan_rate"]').val(d.child_meal_plan_rate || 0);
        $('[name="adult_supplement_cost"]').val(d.adult_supplement_cost || 0);
        $('[name="child_supplement_cost"]').val(d.child_supplement_cost || 0);

        calculateRoomTariffTotals();

        setTimeout(function () {
            checkRoomPricingWarnings();
        }, 200);

    } else {
        resetRoomTariffModal();

        setTimeout(function () {
            checkRoomPricingWarnings();
        }, 200);
    }
}
    });

});

function updateRemainingUI(result) {

    const cap = result.capacity;

    if (!cap) {
        $('#remaining-row').hide();
        return;
    }

    let hasRemaining = false;

    // DB
    if (cap.remainingDB > 0) {
        $('#remaining-db')
            .text(`DB: ${cap.remainingDB}`)
            .show();
        hasRemaining = true;
    } else {
        $('#remaining-db').hide();
    }

    // EB
    if (cap.remainingEB > 0) {
        $('#remaining-eb')
            .text(`EB: ${cap.remainingEB}`)
            .show();
        hasRemaining = true;
    } else {
        $('#remaining-eb').hide();
    }

    // SB
    if (cap.remainingSB > 0) {
        $('#remaining-sb')
            .text(`SB: ${cap.remainingSB}`)
            .show();
        hasRemaining = true;
    } else {
        $('#remaining-sb').hide();
    }

    // Show row only if anything exists
    if (hasRemaining) {
        $('#remaining-row').show();
    } else {
        $('#remaining-row').hide();
    }
}

$('#sync-btn').on('click', syncAutoToManualCountsAndRates);

document.addEventListener('click', function (e) {

    var btn = e.target.closest('.editRoomBtn');
    if (!btn) return;

    $('.child-note-foc').text('');
    $('.child-note-foc').hide();
    $('#remaining-row').hide();
    var leadId         = btn.dataset.leadId || '';
    var propertyId     = btn.dataset.propertyId || '';
    var roomCategoryId = btn.dataset.roomCategoryId || '';
    // var propertyDayId  = btn.dataset.propertyDayId || '';
    var stayDestId     = btn.dataset.stayDestinationId || '';

    // if (!leadId || !propertyId || !roomCategoryId || !propertyDayId || !stayDestId) {
    //     alert('Missing lead/property/room/day/destination details');
    //     console.log({ leadId: leadId, propertyId: propertyId, roomCategoryId: roomCategoryId, propertyDayId: propertyDayId, stayDestId: stayDestId });
    //     return;
    // }

    const dayRow = btn.closest('.itineraryDayRow');
    var itineraryDayId = dayRow?.dataset.itineraryDayId || 
                     dayRow?.querySelector('[name="packages_itinerary_days_id_fk[]"]')?.value || '';

    if (!leadId || !propertyId || !roomCategoryId || !itineraryDayId || !stayDestId) {
  //     alert("Lead"+leadId);
  // alert("propertyId"+propertyId);
  // alert("roomCategoryId"+roomCategoryId);
  // alert("itineraryDayId"+itineraryDayId);
  // alert("stayDestId"+stayDestId);
      alert('Missing lead/property/room/day/destination details');
      console.log({
          leadId: leadId,
          propertyId: propertyId,
          roomCategoryId: roomCategoryId,
          itineraryDayId: itineraryDayId,
          stayDestId: stayDestId
      });
      return;
  }    
  
 
    var modalEl = document.getElementById('roompricingandguestallocationModal');
    if (!modalEl) {
        alert('Modal not found in page');
        return;
    }

    // store last clicked button row for UI update after save
window.__lastRoomEditBtn = btn;

// day row (itinerary day row)
// const dayRow = btn.closest('.itineraryDayRow'); 
// const dayId = dayRow?.querySelector('[name="packages_properties_days_id_fk[]"]')?.value || '';



// room row id (quotation_properties_rooms_id_fk)
// you already store room row id in hidden input inside the room row:
const roomTr = btn.closest('tr');
const qpRoomId = roomTr?.querySelector('[name="packages_properties_rooms_id_fk[]"]')?.value || '';

const tariffDetailsId = roomTr?.querySelector('.quotationRoomTariffDetailsIdInput')?.value || '';
document.getElementById('modal_quotation_room_tariff_details_id').value = tariffDetailsId;

document.getElementById('modal_packages_properties_days_id_fk').value = itineraryDayId;
document.getElementById('modal_quotation_properties_rooms_id_fk').value = qpRoomId;


    /* ================= RESET MODAL ================= */
    setTextSafeIn(modalEl, '#modalTotalRate', '0');
    setTextSafeIn(modalEl, '#modalLeadInfo', 'Loading...');
    setTextSafeIn(modalEl, '#modalRoomInfo', 'Loading...');
    setTextSafeIn(modalEl, '[data-role="room-policy"]', 'Loading...');
    setTextSafeIn(modalEl, '[data-role="meal-plan"]', '-');

    // Room policy age line (Baby/Child range)
    setTextSafeIn(modalEl, '[data-role="room-policy-ages"]', 'Baby - | Child -');

    // ✅ In Enquiry reset (Adult + Child only)
    setTextSafeIn(modalEl, '[data-role="enquiry-adult"]', '0');
    setTextSafeIn(modalEl, '[data-role="enquiry-child"]', '0');
    setTextSafeIn(modalEl, '[data-role="enquiry-meal"]', '-');

    // ✅ Applied reset (Adult + Child + Baby + meal)
    setTextSafeIn(modalEl, '[data-role="applied-adult"]', '0');
    setTextSafeIn(modalEl, '[data-role="applied-child"]', '0');
    setTextSafeIn(modalEl, '[data-role="applied-baby"]', '0');
    setTextSafeIn(modalEl, '[data-role="applied-meal"]', '-');
    setHtmlSafeIn(modalEl, '#mealMismatchIconWrap', '');
    setHtmlSafeIn(modalEl, '#appliedMealWarningWrap', '');

    // ✅ reset pax-wise bed utilization spans
    var spans = modalEl.querySelectorAll('[data-role^="adult-"],[data-role^="child-"],[data-role^="baby-"]');
    for (var i = 0; i < spans.length; i++) spans[i].textContent = '0';

    // ✅ hidden fields
    var modalLead = document.getElementById('modal_lead_id');
    var modalProp = document.getElementById('modal_property_id');
    var modalRoom = document.getElementById('modal_room_category_id');
    var savedTariffId = document.getElementById('modal_quotation_room_tariff_details_id').value || '';
    if (modalLead) modalLead.value = leadId;
    if (modalProp) modalProp.value = propertyId;
    if (modalRoom) modalRoom.value = roomCategoryId;

    // ✅ open modal first
    // bootstrap.Modal.getOrCreateInstance(modalEl).show();
//     $('#roompricingandguestallocationModal').modal({
//   backdrop: 'static',
//   keyboard: false,
//   show: true
// });
$('#roompricingandguestallocationModal').modal('show'); // show bootstrap modal

    /* ================= API URLS ================= */
    var urlPolicy =
        `<?php echo base_url(); ?>index.php/Quotation/ajax_get_room_policy_details` +
        `?lead_id=${encodeURIComponent(leadId)}` +
        `&property_id=${encodeURIComponent(propertyId)}` +
        `&room_category_id=${encodeURIComponent(roomCategoryId)}`;

    // var urlEnquiry =
    //     `<?php echo base_url(); ?>index.php/Quotation/ajax_get_in_enquiry_context` +
    //     `?lead_id=${encodeURIComponent(leadId)}` +
    //     `&property_day_id=${encodeURIComponent(propertyDayId)}` +
    //     `&stay_destination_id=${encodeURIComponent(stayDestId)}` +
    //     `&property_id=${encodeURIComponent(propertyId)}` +
    //     `&room_category_id=${encodeURIComponent(roomCategoryId)}`;

    var urlEnquiry =
      `<?php echo base_url(); ?>index.php/Quotation/ajax_get_in_enquiry_context` +
      `?lead_id=${encodeURIComponent(leadId)}` +
      `&day_id_fk=${encodeURIComponent(itineraryDayId)}` +
      `&stay_destination_id=${encodeURIComponent(stayDestId)}` +
      `&property_id=${encodeURIComponent(propertyId)}` +
      `&room_category_id=${encodeURIComponent(roomCategoryId)}`;

    // var urlApplied =
    //     `<?php echo base_url(); ?>index.php/Quotation/ajax_get_applied_plan_context` +
    //     `?lead_id=${encodeURIComponent(leadId)}` +
    //     `&property_day_id=${encodeURIComponent(propertyDayId)}` +
    //     `&stay_destination_id=${encodeURIComponent(stayDestId)}` +
    //     `&property_id=${encodeURIComponent(propertyId)}` +
    //     `&room_category_id=${encodeURIComponent(roomCategoryId)}`;
    
    var urlApplied =
    `<?php echo base_url(); ?>index.php/Quotation/ajax_get_applied_plan_context` +
    `?lead_id=${encodeURIComponent(leadId)}` +
    `&day_id_fk=${encodeURIComponent(itineraryDayId)}` +
    `&stay_destination_id=${encodeURIComponent(stayDestId)}` +
    `&property_id=${encodeURIComponent(propertyId)}` +
    `&room_category_id=${encodeURIComponent(roomCategoryId)}`;

    /* ================= LOAD ALL ================= */
    Promise.all([
        fetch(urlPolicy).then(function (r) { return r.json(); }),
        fetch(urlEnquiry).then(function (r) { return r.json(); }),
        fetch(urlApplied).then(function (r) { return r.json(); })
    ])
    .then(function (responses) {

        var policyRes = responses[0];
        var enquiryRes = responses[1];
        var appliedRes = responses[2];

        /* ================= POLICY UI ================= */
        var policy = { db: 0, eb: 0, sb: 0 };

        if (policyRes && policyRes.status) {

            var lead = (policyRes.data && policyRes.data.lead) ? policyRes.data.lead : {};
            var property = (policyRes.data && policyRes.data.property) ? policyRes.data.property : {};
            var room = (policyRes.data && policyRes.data.room) ? policyRes.data.room : {};

            var db  = parseInt(room.properties_room_category_number_of_adults_allowed, 10);
            var eb  = parseInt(room.properties_room_category_extra_bed_mattress_allowed_in_room, 10);
            var sb  = parseInt(room.properties_room_category_children_allowed_on_bed_sharing_basis, 10);
            var inv = room.properties_room_category_inventory;

            if (isNaN(db)) db = 0;
            if (isNaN(eb)) eb = 0;
            if (isNaN(sb)) sb = 0;
            if (inv === undefined || inv === null) inv = 0;

            policy = { db: db, eb: eb, sb: sb };

            setTextSafeIn(modalEl, '#modalLeadInfo', 'Lead No: ' + (lead.leads_number || '-'));

            setHtmlSafeIn(
                modalEl,
                '#modalRoomInfo',
                (property.properties_name || '-') + '<br>' +
                (room.properties_room_category_name || '-') + '<br>' +
                'DB:' + db + ' | EB:' + eb + ' | SB:' + sb + ' | Inventory:' + inv
            );

            setTextSafeIn(modalEl, '[data-role="room-policy"]', 'DB:' + db + ' | EB:' + eb + ' | SB:' + sb + ' | Inventory:' + inv);

            // Room default meal plan name
            setTextSafeIn(modalEl, '[data-role="meal-plan"]', room.meal_plan_name || '-');

            // Baby/Child age range text from backend (if you return it)
            var agesTxt = (policyRes.data && policyRes.data.policy_ages_text) ? policyRes.data.policy_ages_text : '';
            setTextSafeIn(modalEl, '[data-role="room-policy-ages"]', agesTxt ? agesTxt : 'Baby - | Child -');
        }

        /* ================= IN ENQUIRY UI ================= */
        if (enquiryRes && enquiryRes.status) {

            var eqData = enquiryRes.data ? enquiryRes.data : {};
            var eqPlan = eqData.plan ? eqData.plan : null;

            setTextSafeIn(modalEl, '[data-role="enquiry-meal"]', eqData.meal_plan_name || '-');

            if (eqPlan) {
                setTextSafeIn(modalEl, '[data-role="enquiry-adult"]', (eqPlan.adults !== undefined && eqPlan.adults !== null) ? eqPlan.adults : 0);
                setTextSafeIn(modalEl, '[data-role="enquiry-child"]', (eqPlan.children !== undefined && eqPlan.children !== null) ? eqPlan.children : 0);
            } else {
                setTextSafeIn(modalEl, '[data-role="enquiry-adult"]', '0');
                setTextSafeIn(modalEl, '[data-role="enquiry-child"]', '0');
            }

        } else {
            setTextSafeIn(modalEl, '[data-role="enquiry-adult"]', '0');
            setTextSafeIn(modalEl, '[data-role="enquiry-child"]', '0');
            setTextSafeIn(modalEl, '[data-role="enquiry-meal"]', '-');
        }

        /* ================= APPLIED UI ================= */
        var appliedPlan = { adults: 0, children: 0, baby: 0 };

        setTextSafeIn(modalEl, '[data-role="applied-meal"]', '-');
        setHtmlSafeIn(modalEl, '#mealMismatchIconWrap', '');
        setHtmlSafeIn(modalEl, '#appliedMealWarningWrap', '');

        if (appliedRes && appliedRes.status) {

            var apData = appliedRes.data ? appliedRes.data : {};

            // Applied meal name
            setTextSafeIn(modalEl, '[data-role="applied-meal"]', apData.meal_plan_name || '-');

            // mismatch icon (ONLY for applied meal)data-bs-placement="top"
            if (parseInt(apData.meal_plan_mismatch, 10) === 1) {

                setHtmlSafeIn(modalEl, '#mealMismatchIconWrap', (
                    '<span class="ms-2 text-warning" ' +
                    'data-bs-toggle="tooltip" data-placement="top" ' +
                    'title="Room\'s default meal plan is overridden by the enquiry meal plan">' +
                    '<i class="bi bi-exclamation-triangle-fill"></i>' +
                    '</span>'
                ));

                var wrap = modalEl.querySelector('#mealMismatchIconWrap');
                var tipEl = wrap ? wrap.querySelector('[data-bs-toggle="tooltip"]') : null;
                // if (tipEl) new bootstrap.Tooltip(tipEl);
                if (tipEl) $(tipEl).tooltip();
            }

            // EP room-only warning: room default meal plan id = 2
            // if (parseInt(apData.room_is_ep_room_only, 10) === 1) {
            //     setHtmlSafeIn(modalEl, '#appliedMealWarningWrap',
            //         '<div class="text-danger mt-2"><small>' +
            //         'Meal rates not found. Update rates or enter manually in the supplement cost field.' +
            //         '</small></div>'
            //     );
            // }

            // Applied counts computed in backend (adult/child/baby)
            if (apData.applied) {
                appliedPlan.adults = parseInt(apData.applied.adults, 10); if (isNaN(appliedPlan.adults)) appliedPlan.adults = 0;
                appliedPlan.children = parseInt(apData.applied.children, 10); if (isNaN(appliedPlan.children)) appliedPlan.children = 0;
                appliedPlan.baby = parseInt(apData.applied.baby, 10); if (isNaN(appliedPlan.baby)) appliedPlan.baby = 0;
            }

            setTextSafeIn(modalEl, '[data-role="applied-adult"]', appliedPlan.adults);
            setTextSafeIn(modalEl, '[data-role="applied-child"]', appliedPlan.children);
            setTextSafeIn(modalEl, '[data-role="applied-baby"]', appliedPlan.baby);

        } else {
            setTextSafeIn(modalEl, '[data-role="applied-adult"]', '0');
            setTextSafeIn(modalEl, '[data-role="applied-child"]', '0');
            setTextSafeIn(modalEl, '[data-role="applied-baby"]', '0');
            setTextSafeIn(modalEl, '[data-role="applied-meal"]', '-');
        }

        /* ================= AUTO ALLOCATION ================= */
        if (typeof autoAllocateBeds === 'function' && typeof applyAutoAllocationToModal === 'function') {
            var allocation = allocateRooms(policy, appliedPlan);
            applyAutoAllocationToModal(allocation);
            updateRemainingUI(allocation);

            // Store context for manual validation
            var _pDb = document.getElementById('modal_policy_db');
            var _pEb = document.getElementById('modal_policy_eb');
            var _pSb = document.getElementById('modal_policy_sb');
            var _pAdults = document.getElementById('modal_applied_adults');
            var _pChildren = document.getElementById('modal_applied_children');
            var _pBaby = document.getElementById('modal_applied_baby');
            var _pMin = document.getElementById('modal_min_rooms_required');
            if (_pDb) _pDb.value = policy.db;
            if (_pEb) _pEb.value = policy.eb;
            if (_pSb) _pSb.value = policy.sb;
            if (_pAdults) _pAdults.value = appliedPlan.adults;
            if (_pChildren) _pChildren.value = appliedPlan.children;
            if (_pBaby) _pBaby.value = appliedPlan.baby;
            if (_pMin) _pMin.value = allocation.totalRooms;

            // 1) copy auto -> manual so manual starts same
            syncAutoToManualCountsAndRates();

           // 2) calculate amounts + totals for both
          //  refreshAllAmountsAndTotals();

        }

    //     const urlTariff =
    // `<?php echo base_url(); ?>index.php/Quotation/ajax_get_tariff_by_context` +
    // `?lead_id=${encodeURIComponent(leadId)}` +
    // `&property_day_id=${encodeURIComponent(propertyDayId)}` +
    // `&stay_destination_id=${encodeURIComponent(stayDestId)}` +
    // `&property_id=${encodeURIComponent(propertyId)}` +
    // `&room_category_id=${encodeURIComponent(roomCategoryId)}`;

    const urlTariff =
    `<?php echo base_url(); ?>index.php/Quotation/ajax_get_tariff_by_context` +
    `?lead_id=${encodeURIComponent(leadId)}` +
    `&day_id_fk=${encodeURIComponent(itineraryDayId)}` +
    `&stay_destination_id=${encodeURIComponent(stayDestId)}` +
    `&property_id=${encodeURIComponent(propertyId)}` +
    `&room_category_id=${encodeURIComponent(roomCategoryId)}`;

// fetch(urlTariff)
//   .then(r => r.json())
//   .then(tariffRes => {
//       applyTariffRatesToModal(tariffRes);
//       calcTotalFromAuto(); // optional
//   })

// fetch(urlTariff)
//   .then(r => r.json())
//   .then(tariffRes => {

//       applyTariffRatesToModal(tariffRes);

//       // ✅ ensure DOM updated before calculation
//       setTimeout(() => {
//           syncAutoToManualCountsAndRates();   // important
//           refreshAllAmountsAndTotals();       // MAIN FIX
//       }, 50);
//   })

//   .catch(err => console.error('Tariff API error', err));

fetch(urlTariff)
  .then(r => r.json())
  .then(tariffRes => {
      applyTariffRatesToModal(tariffRes);

      if (savedTariffId) {
          fetch(`<?php echo base_url(); ?>index.php/Quotation/ajax_get_saved_quotation_room_tariff_details_by_id?quotation_room_tariff_details_id=${encodeURIComponent(savedTariffId)}`)
            .then(r => r.json())
            .then(savedRes => {
                if (savedRes.status && savedRes.data) {
                    fillSavedManualSection(savedRes.data);
                } else {
                    refreshAllAmountsAndTotals();
                }
            })
            .catch(err => {
                console.error(err);
                refreshAllAmountsAndTotals();
            });
      } else {
          refreshAllAmountsAndTotals();
      }
  })
  .catch(err => console.error('Tariff API error', err));


    })
    .catch(function (err) {
        console.error(err);
        alert('Error loading modal data');
    });

});


/* ================= Auto Allocation ================= */
function autoAllocateBeds(policy, applied) {

    const roomDB = Number(policy.db || 0);
    const roomEB = Number(policy.eb || 0);
    const roomSB = Number(policy.sb || 0);

    let adults = Number(applied.adults || 0);
    let children = Number(applied.children || 0);
    let baby = Number(applied.baby || 0);

    const dbCap = roomDB > 0 ? roomDB : 2;

    // ===== Adults -> Rooms/DB/EB =====
    let rooms = Math.ceil(adults / dbCap);
    if (rooms < 1 && adults > 0) rooms = 1;

    let adultsInDB = Math.min(adults, rooms * dbCap);
    let remainingAdults = adults - adultsInDB;

    let adultsInEB = 0;

    if (remainingAdults > 0 && roomEB > 0) {
        const ebCapacityTotal = rooms * roomEB;
        adultsInEB = Math.min(remainingAdults, ebCapacityTotal);
        remainingAdults -= adultsInEB;
    }

    while (remainingAdults > 0) {
        rooms += 1;

        const takeDB = Math.min(dbCap, remainingAdults);
        adultsInDB += takeDB;
        remainingAdults -= takeDB;

        if (roomEB > 0 && remainingAdults > 0) {
            const takeEB = Math.min(roomEB, remainingAdults);
            adultsInEB += takeEB;
            remainingAdults -= takeEB;
        }
    }

    // SGL (approx): if remainder is 1 adult in last room
    let remDB = adults % dbCap;
    let adultSGLRooms = (dbCap > 1 && remDB === 1) ? 1 : 0;

    // ===== Children/Baby -> SB =====
    let sbCapacityTotal = rooms * roomSB;

    let childInSB = Math.min(children, sbCapacityTotal);
    let remainingChildren = children - childInSB;

    let babyInSB = Math.min(baby, Math.max(0, sbCapacityTotal - childInSB));
    let remainingBaby = baby - babyInSB;

    let extraChildRooms = 0;

    while ((remainingChildren + remainingBaby) > 0) {

        if (roomSB <= 0) break;

        extraChildRooms += 1;

        const takeChild = Math.min(roomSB, remainingChildren);
        remainingChildren -= takeChild;

        const freeSB = roomSB - takeChild;
        const takeBaby = Math.min(freeSB, remainingBaby);
        remainingBaby -= takeBaby;
    }

    return {
        totalRooms: rooms + extraChildRooms,
        adult: { db: Math.max(0, adults - adultsInEB), eb: adultsInEB, sb: 0, sgl: adultSGLRooms },
        child: { db: 0, eb: 0, sb: (children - remainingChildren), sgl: 0 },
        baby: { db: 0, eb: 0, sb: (baby - remainingBaby), sgl: 0 },
        warnings: { unallocatedChildren: remainingChildren, unallocatedBaby: remainingBaby }
    };
}

function handleSingleAdultSGL(policy) {

    const adults = Number(policy.adults || 0);
    const children = Number(policy.children || 0);
    const baby = Number(policy.baby || 0);

    // ✅ Only 1 adult and no dependents
    if (adults === 1 && children === 0 && baby === 0) {
        return {
            isHandled: true,
            result: {
                totalRooms: 0,
                adult: {
                    db: 0,
                    eb: 0,
                    sb: 0,
                    sgl: 1
                },
                child: { db: 0, eb: 0, sb: 0 },
                baby: { db: 0, eb: 0, sb: 0 }
            }
        };
    }

    return { isHandled: false };
}

function allocateRooms(applied, policy) {

    // 🔹 Step 0: Check SGL condition
    const sglCheck = handleSingleAdultSGL(policy);

    if (sglCheck.isHandled) {
        return sglCheck.result;
    }
    
    const baseAdults = Number(policy.adults || 0);
    const baseChildren = Number(policy.children || 0);
    const baseBaby = Number(policy.baby || 0);

    const roomDB = Number(applied.db || 0); // per room
    const roomEB = Number(applied.eb || 0); // per room
    const roomSB = Number(applied.sb || 0); // per room (child sharing)

    const effectiveCapacity = roomDB + roomEB + roomSB;

    if (effectiveCapacity === 0) {
        throw new Error("Invalid room config: DB + EB + SB cannot be 0");
    }

    // -------------------------------
    // 🏨 STEP 1: INITIAL ROOM ESTIMATE
    // -------------------------------
    const totalGuests = baseAdults + baseChildren + baseBaby;
    let rooms = Math.ceil(totalGuests / effectiveCapacity) || 1;

    // -------------------------------
    // 🔁 STEP 2: ALLOCATION LOOP
    // -------------------------------
    while (true) {

        let adults = baseAdults;
        let children = baseChildren;
        let baby = baseBaby;

        // capacities
        let totalDB = rooms * roomDB;
        let totalEB = rooms * roomEB;
        let totalSB = rooms * roomSB;

        // -------------------------------
        // 👶 1. BABY → SB
        // -------------------------------
        let babySB = Math.min(baby, totalSB);
        baby -= babySB;

        let remainingSB = totalSB - babySB;

        // -------------------------------
        // 👨 2. ADULT → DB
        // -------------------------------
        let adultDB = Math.min(adults, totalDB);
        adults -= adultDB;

        let remainingDB = totalDB - adultDB;

        // -------------------------------
        // 🧒 3. CHILD → remaining DB (use free DB slots before SB/EB)
        // -------------------------------
        let childDB = Math.min(children, remainingDB);
        children -= childDB;

        remainingDB -= childDB;

        // -------------------------------
        // 🧒 4. CHILD → SB (only if DB is full)
        // -------------------------------
        let childSB = Math.min(children, remainingSB);
        children -= childSB;

        remainingSB -= childSB;

        // -------------------------------
        // 👶 5. BABY → EB
        // -------------------------------
        let babyEB = Math.min(baby, totalEB);
        baby -= babyEB;

        let remainingEB = totalEB - babyEB;

        // -------------------------------
        // 👨 6. ADULT → EB
        // -------------------------------
        let adultEB = Math.min(adults, remainingEB);
        adults -= adultEB;

        remainingEB -= adultEB;

        // -------------------------------
        // 🧒 7. CHILD → EB
        // -------------------------------
        let childEB = Math.min(children, remainingEB);
        children -= childEB;

        remainingEB -= childEB;

        // -------------------------------
        // ✅ CHECK: ALL ALLOCATED?
        // -------------------------------
        if (adults === 0 && children === 0 && baby === 0) {
            return {
                totalRooms: rooms,
                capacity: {
                    totalDB: totalDB,
                    totalEB: totalEB,
                    totalSB: totalSB,
                    remainingDB: remainingDB,
                    remainingEB: remainingEB,
                    remainingSB: remainingSB
                },

                adult: {
                    db: adultDB,
                    eb: adultEB,
                    sb: 0
                },

                child: {
                    db: childDB,
                    eb: childEB,
                    sb: childSB
                },

                baby: {
                    db: 0,
                    eb: babyEB,
                    sb: babySB
                }
            };
        }

        // -------------------------------
        // ❗ NOT ENOUGH → INCREASE ROOMS
        // -------------------------------
        rooms++;
    }
}

function setValSafe(selector, val) {
    const el = document.querySelector(selector);
    if (el) el.value = (val ?? 0);
}

function applyAutoAllocationToModal(result) {

    // ---------------------------
    // AUTO ROOMING PLAN INPUTS
    // ---------------------------
    setValSafe('#roompricingandguestallocationModal [name="auto_room_member_count"]', result.totalRooms ?? 0);

    // If your autoAllocateBeds also calculates these, use them.
    // If not, they will become 0 (safe).
    setValSafe('#roompricingandguestallocationModal [name="auto_extra_bed_adult_count"]', result.adult?.eb ?? 0);
    setValSafe('#roompricingandguestallocationModal [name="auto_extra_bed_child_count"]', result.child?.eb ?? 0);
    setValSafe('#roompricingandguestallocationModal [name="auto_child_sharing_bed_count"]', result.child?.sb ?? 0);
    setValSafe('#roompricingandguestallocationModal [name="auto_single_occupancy_count"]', result.adult?.sgl ?? 0);
    setValSafe('#roompricingandguestallocationModal [name="auto_supplment_cost_count"]', 0); // later

    // ---------------------------
    // ✅ MANUAL DEFAULTS = SAME AS AUTO
    // ---------------------------
    setValSafe('#roompricingandguestallocationModal [name="manual_count"]', result.totalRooms ?? 0);
    setValSafe('#roompricingandguestallocationModal [name="manual_extra_bed_adult_count"]', result.adult?.eb ?? 0);
    setValSafe('#roompricingandguestallocationModal [name="manual_extra_bed_child_count"]', result.child?.eb ?? 0);
    setValSafe('#roompricingandguestallocationModal [name="manual_child_sharing_bed_count"]', result.child?.sb ?? 0);
    setValSafe('#roompricingandguestallocationModal [name="manual_single_occupancy_count"]', result.adult?.sgl ?? 0);
    setValSafe('#roompricingandguestallocationModal [name="manual_supplment_cost_count"]', 0); // later

    // ---------------------------
    // PAX-WISE BED UTILIZATION
    // ---------------------------
    setTextSafe('#roompricingandguestallocationModal [data-role="adult-db"]',  result.adult?.db  ?? 0);
    setTextSafe('#roompricingandguestallocationModal [data-role="adult-eb"]',  result.adult?.eb  ?? 0);
    setTextSafe('#roompricingandguestallocationModal [data-role="adult-sb"]',  result.adult?.sb  ?? 0);
    setTextSafe('#roompricingandguestallocationModal [data-role="adult-sgl"]', result.adult?.sgl ?? 0);

    setTextSafe('#roompricingandguestallocationModal [data-role="child-db"]',  result.child?.db  ?? 0);
    setTextSafe('#roompricingandguestallocationModal [data-role="child-eb"]',  result.child?.eb  ?? 0);
    setTextSafe('#roompricingandguestallocationModal [data-role="child-sb"]',  result.child?.sb  ?? 0);
    setTextSafe('#roompricingandguestallocationModal [data-role="child-sgl"]', result.child?.sgl ?? 0);

    setTextSafe('#roompricingandguestallocationModal [data-role="baby-db"]',   result.baby?.db   ?? 0);
    setTextSafe('#roompricingandguestallocationModal [data-role="baby-eb"]',   result.baby?.eb   ?? 0);
    setTextSafe('#roompricingandguestallocationModal [data-role="baby-sb"]',   result.baby?.sb   ?? 0);
    setTextSafe('#roompricingandguestallocationModal [data-role="baby-sgl"]',  result.baby?.sgl  ?? 0);

    baby_child_sharing_count = result.baby?.sb;
    var total_baby_foc = (result.baby?.sb ?? 0) + (result.baby?.eb ?? 0);

    if(total_baby_foc > 0){
        $('.child-note-foc').text(`Child on FOC basis (${total_baby_foc})`);
        $('.child-note-foc').show();
    }

    var _babySbEl = document.getElementById('modal_baby_sb_count');
    var _babyEbEl = document.getElementById('modal_baby_eb_count');
    if (_babySbEl) _babySbEl.value = result.baby?.sb ?? 0;
    if (_babyEbEl) _babyEbEl.value = result.baby?.eb ?? 0;
    // ---------------------------
    // WARNINGS (optional)
    // ---------------------------
    if (result.warnings && (result.warnings.unallocatedChildren > 0 || result.warnings.unallocatedBaby > 0)) {
        console.warn('Unallocated pax due to policy limits:', result.warnings);
    }
}

function setInputSafe(selector, val) {
    const el = document.querySelector(selector);
    if (el) el.value = (val === undefined || val === null) ? '' : val;
}

function applyTariffRatesToModal(tariffRes) {

    if (!tariffRes || !tariffRes.status) return;

    const d = tariffRes.data || {};
    const rates = d.rates || {};

    // Store tariff data on modal for warning checks
    const modalEl = document.getElementById('roompricingandguestallocationModal');
    if (modalEl) {
        modalEl.dataset.tariffData = JSON.stringify({
            rates: rates,
            supplement_amount: d.supplement_amount || 0,
            needs_supplement: d.needs_supplement || false,
            missing_meals: d.missing_meals || [],
            meal_rates_missing: d.meal_rates_missing || [],
            meal_rates_source: d.meal_rates_source || '',
            rates_source: d.rates_source || ''
        });
    }

    // ✅ Rooms | Units RATE (Auto + Manual)
    setInputSafe('#roompricingandguestallocationModal [name="auto_room_member_rate"]', rates.room_rate || 0);
    setInputSafe('#roompricingandguestallocationModal [name="manual_rate"]', rates.room_rate || 0);

    // ✅ Extra Bed Adult RATE (Auto + Manual)
    setInputSafe('#roompricingandguestallocationModal [name="auto_extra_bed_adult_rate"]', rates.adult_eb_rate || 0);
    setInputSafe('#roompricingandguestallocationModal [name="manual_extra_bed_adult_rate"]', rates.adult_eb_rate || 0);

    // ✅ Extra Bed Child RATE (Auto + Manual)
    setInputSafe('#roompricingandguestallocationModal [name="auto_extra_bed_child_rate"]', rates.child_eb_rate || 0);
    setInputSafe('#roompricingandguestallocationModal [name="manual_extra_bed_child_rate"]', rates.child_eb_rate || 0);

    // ✅ Child Sharing Bed RATE (Auto + Manual)
    setInputSafe('#roompricingandguestallocationModal [name="auto_child_sharing_bed_rate"]', rates.child_sb_rate || 0);
    setInputSafe('#roompricingandguestallocationModal [name="manual_child_sharing_bed_rate"]', rates.child_sb_rate || 0);

    // ✅ Single Occupancy RATE (Auto + Manual)
    setInputSafe('#roompricingandguestallocationModal [name="auto_single_occupancy_rate"]', rates.sgl_rate || 0);
    setInputSafe('#roompricingandguestallocationModal [name="manual_single_occupancy_rate"]', rates.sgl_rate || 0);

    // ✅ Supplement Cost COUNT = NA (Auto + Manual)
    const supCountAuto = document.querySelector('#roompricingandguestallocationModal [name="auto_supplment_cost_count"]');
    const supCountMan  = document.querySelector('#roompricingandguestallocationModal [name="manual_supplment_cost_count"]');
    if (supCountAuto) { supCountAuto.value = 'NA'; supCountAuto.setAttribute('readonly','readonly'); }
    if (supCountMan)  { supCountMan.value  = 'NA'; supCountMan.setAttribute('readonly','readonly'); }

    // ✅ Supplement Cost RATE (Auto + Manual)
    setInputSafe('#roompricingandguestallocationModal [name="auto_supplment_cost"]', d.supplement_amount || 0);
    setInputSafe('#roompricingandguestallocationModal [name="manual_supplment_cost"]', d.supplement_amount || 0);
}

function calcTotalFromAuto() {

    const num = (sel) => parseFloat(document.querySelector(sel)?.value || 0) || 0;

    const roomsCount = num('#roompricingandguestallocationModal [name="auto_room_member_count"]');
    const roomsRate  = num('#roompricingandguestallocationModal [name="auto_room_member_rate"]');

    const ebAcount = num('#roompricingandguestallocationModal [name="auto_extra_bed_adult_count"]');
    const ebArate  = num('#roompricingandguestallocationModal [name="auto_extra_bed_adult_rate"]');

    const ebCcount = num('#roompricingandguestallocationModal [name="auto_extra_bed_child_count"]');
    const ebCrate  = num('#roompricingandguestallocationModal [name="auto_extra_bed_child_rate"]');

    const sbCount = num('#roompricingandguestallocationModal [name="auto_child_sharing_bed_count"]');
    const sbRate  = num('#roompricingandguestallocationModal [name="auto_child_sharing_bed_rate"]');

    const sglCount = num('#roompricingandguestallocationModal [name="auto_single_occupancy_count"]');
    const sglRate  = num('#roompricingandguestallocationModal [name="auto_single_occupancy_rate"]');

    const supplement = num('#roompricingandguestallocationModal [name="auto_supplment_cost"]');

    const total =
        (roomsCount * roomsRate) +
        (ebAcount * ebArate) +
        (ebCcount * ebCrate) +
        (sbCount * sbRate) +
        (sglCount * sglRate) +
        supplement;

    setTextSafe('#modalTotalRate', total.toFixed(2));
}

/* ================= RATE + AMOUNT CALC HELPERS ================= */

function toNumber(val) {
  if (val === null || val === undefined) return 0;
  val = ('' + val).replace(/,/g, '').trim();
  if (val === '' || val.toUpperCase() === 'NA') return 0;
  const n = parseFloat(val);
  return isNaN(n) ? 0 : n;
}

function money(val) {
  // you can format if you want. Keeping simple:
  const n = toNumber(val);
  return (Math.round(n * 100) / 100).toFixed(2);
}

function getPlanInput(plan, line, field) {
  return document.querySelector(
    `#roompricingandguestallocationModal [data-plan="${plan}"][data-line="${line}"][data-field="${field}"]`
  );
}

function setAmount(plan, line, amount) {
  const span = document.querySelector(
    `#roompricingandguestallocationModal [data-role="amount-${plan}-${line}"]`
  );
  if (span) span.textContent = money(amount);

  const hidden = document.querySelector(
    `#roompricingandguestallocationModal [data-save="${plan}"][data-line="${line}"][data-save-field="amount"]`
  );
  if (hidden) hidden.value = money(amount);
}

function calcLineAmount(plan, line) {
  const countEl = getPlanInput(plan, line, 'count');
  const rateEl  = getPlanInput(plan, line, 'rate');

  const rate = toNumber(rateEl ? rateEl.value : 0);

  // Supplement: amount = rate only (count is NA)
  if (line === 'supplement') {
    setAmount(plan, line, rate);
    return rate;
  }

  const count = toNumber(countEl ? countEl.value : 0);
  const amt = count * rate;
  setAmount(plan, line, amt);
  return amt;
}

function calcTotal(plan) {
  const lines = ['rooms', 'eb_adult', 'eb_child', 'sb_child', 'sgl', 'supplement'];
  let total = 0;

  lines.forEach(line => {
    total += calcLineAmount(plan, line);
  });

  // total html + hidden
  const totalSpan = document.querySelector(`#roompricingandguestallocationModal [data-role="total-${plan}"]`);
  if (totalSpan) totalSpan.textContent = money(total);

  const totalHidden = document.getElementById(`${plan}_total_rate`);
  if (totalHidden) totalHidden.value = money(total);

  return total;
}

/* Copy Auto -> Manual counts/rates so manual starts same as auto */
function syncAutoToManualCountsAndRates() {
  const lines = ['rooms', 'eb_adult', 'eb_child', 'sb_child', 'sgl', 'supplement'];

  lines.forEach(line => {
    const aCount = getPlanInput('auto', line, 'count');
    const aRate  = getPlanInput('auto', line, 'rate');
    const mCount = getPlanInput('manual', line, 'count');
    const mRate  = getPlanInput('manual', line, 'rate');

    // manual should start same values (only if inputs exist)
    if (mCount && aCount) mCount.value = aCount.value;
    if (mRate && aRate) mRate.value = aRate.value;
  });
}

/* Call this whenever modal opens or whenever auto allocation/rates loaded */
function refreshAllAmountsAndTotals() {
  // Auto
  calcTotal('auto');
  // Manual
  calcTotal('manual');
}

/* Manual live update when user edits count/rate */
document.addEventListener('input', function (e) {
  const el = e.target;
  if (!el.closest('#roompricingandguestallocationModal')) return;

  const plan = el.dataset.plan;
  const line = el.dataset.line;

  if (plan !== 'manual') return; // only manual updates by user input
  if (!line) return;

  // update only that line and total
  calcLineAmount('manual', line);
  calcTotal('manual');
});

const roomModalEl = document.getElementById('roompricingandguestallocationModal');

if (roomModalEl) {
  roomModalEl.addEventListener('shown.bs.modal', function () {
    // Wait 1 tick so DOM values are painted
    setTimeout(() => {
      refreshAllAmountsAndTotals();
    }, 0);
  });
}

document.getElementById('btnSave1')?.addEventListener('click', function () {

     // ✅ NEW VALIDATION
    if (!validateManualRoomingPlan()) {
        return;
    }

    const dayId   = document.getElementById('modal_packages_properties_days_id_fk')?.value || '';
    const roomRow = document.getElementById('modal_quotation_properties_rooms_id_fk')?.value || '';

    if (!dayId || !roomRow) {
        console.log({ dayId, roomRow });
        return alert('Missing Day ID or Room Row ID');
    }

    const fd = new FormData();
    fd.append('packages_properties_days_id_fk', dayId);
    fd.append('quotation_properties_rooms_id_fk', roomRow);

    const spanNum = (sel) => (document.querySelector(sel)?.textContent || '0').trim();
    const inputVal = (sel, def='0') => (document.querySelector(sel)?.value ?? def);

    const quotationRoomTariffDetailsId =
    document.getElementById('modal_quotation_room_tariff_details_id')?.value || '';

    fd.append('quotation_room_tariff_details_id', quotationRoomTariffDetailsId);
    // pax wise
    fd.append('pax_wise_bed_adult_db_count', spanNum('[data-role="adult-db"]'));
    fd.append('pax_wise_bed_adult_eb_count', spanNum('[data-role="adult-eb"]'));
    fd.append('pax_wise_bed_adult_sgl_count', spanNum('[data-role="adult-sb"]'));

    fd.append('pax_wise_bed_child_db_count', spanNum('[data-role="child-db"]'));
    fd.append('pax_wise_bed_child_eb_count', spanNum('[data-role="child-eb"]'));
    fd.append('pax_wise_bed_child_sb_count', spanNum('[data-role="child-sb"]'));

    fd.append('pax_wise_bed_baby_db_count', spanNum('[data-role="baby-db"]'));
    fd.append('pax_wise_bed_baby_eb_count', spanNum('[data-role="baby-eb"]'));
    fd.append('pax_wise_bed_baby_sb_count', spanNum('[data-role="baby-sb"]'));

    // Auto inputs
    fd.append('room_unit_auto_count', inputVal('[name="auto_room_member_count"]'));
    fd.append('room_unit_auto_rate', inputVal('[name="auto_room_member_rate"]'));
    fd.append('room_unit_auto_total_rate', (document.querySelector('[data-role="amount-auto-rooms"]')?.textContent || '0'));

    fd.append('extra_bed_adult_auto_count', inputVal('[name="auto_extra_bed_adult_count"]'));
    fd.append('extra_bed_adult_auto_rate', inputVal('[name="auto_extra_bed_adult_rate"]'));
    fd.append('extra_bed_adult_auto_total_rate', (document.querySelector('[data-role="amount-auto-eb_adult"]')?.textContent || '0'));

    fd.append('extra_bed_child_auto_count', inputVal('[name="auto_extra_bed_child_count"]'));
    fd.append('extra_bed_child_auto_rate', inputVal('[name="auto_extra_bed_child_rate"]'));
    fd.append('extra_bed_child_auto_total_rate', (document.querySelector('[data-role="amount-auto-eb_child"]')?.textContent || '0'));

    fd.append('child_sharing_bed_auto_count', inputVal('[name="auto_child_sharing_bed_count"]'));
    fd.append('child_sharing_bed_auto_rate', inputVal('[name="auto_child_sharing_bed_rate"]'));
    fd.append('child_sharing_bed_auto_total_rate', (document.querySelector('[data-role="amount-auto-sb_child"]')?.textContent || '0'));

    fd.append('single_occupancy_auto_count', inputVal('[name="auto_single_occupancy_count"]'));
    fd.append('single_occupancy_auto_rate', inputVal('[name="auto_single_occupancy_rate"]'));
    fd.append('single_occupancy_auto_total_rate', (document.querySelector('[data-role="amount-auto-sgl"]')?.textContent || '0'));

    fd.append('supplyment_auto_cost', inputVal('[name="auto_supplment_cost"]'));
    fd.append('supplyment_auto_total_cost', (document.querySelector('[data-role="amount-auto-supplement"]')?.textContent || '0'));

    // Manual inputs
    fd.append('room_unit_manual_count', inputVal('[name="manual_count"]'));
    fd.append('room_unit_manual_rate', inputVal('[name="manual_rate"]'));
    fd.append('room_unit_manual_total_rate', (document.querySelector('[data-role="amount-manual-rooms"]')?.textContent || '0'));

    fd.append('extra_bed_adult_manual_count', inputVal('[name="manual_extra_bed_adult_count"]'));
    fd.append('extra_bed_adult_manual_rate', inputVal('[name="manual_extra_bed_adult_rate"]'));
    fd.append('extra_bed_adult_manual_total_rate', (document.querySelector('[data-role="amount-manual-eb_adult"]')?.textContent || '0'));

    fd.append('extra_bed_child_manual_count', inputVal('[name="manual_extra_bed_child_count"]'));
    fd.append('extra_bed_child_manual_rate', inputVal('[name="manual_extra_bed_child_rate"]'));
    fd.append('extra_bed_child_manual_total_rate', (document.querySelector('[data-role="amount-manual-eb_child"]')?.textContent || '0'));

    fd.append('child_sharing_bed_manual_count', inputVal('[name="manual_child_sharing_bed_count"]'));
    fd.append('child_sharing_bed_manual_rate', inputVal('[name="manual_child_sharing_bed_rate"]'));
    fd.append('child_sharing_bed_manual_total_rate', (document.querySelector('[data-role="amount-manual-sb_child"]')?.textContent || '0'));

    fd.append('single_occupancy_manual_count', inputVal('[name="manual_single_occupancy_count"]'));
    fd.append('single_occupancy_manual_rate', inputVal('[name="manual_single_occupancy_rate"]'));
    fd.append('single_occupancy_manual_total_rate', (document.querySelector('[data-role="amount-manual-sgl"]')?.textContent || '0'));

    fd.append('supplyment_manual_cost', inputVal('[name="manual_supplment_cost"]'));
    fd.append('supplyment_manual_total_cost', (document.querySelector('[data-role="amount-manual-supplement"]')?.textContent || '0'));

    // totals
    fd.append('auto_total_rate', (document.querySelector('[data-role="total-auto"]')?.textContent || '0'));
    fd.append('manual_total_rate', (document.querySelector('[data-role="total-manual"]')?.textContent || '0'));

    fetch(`<?php echo base_url(); ?>index.php/Quotation/ajax_add_quotation_room_tariff_details`, {
        method: 'POST',
        body: fd
    })
    .then(r => r.json())

    .then(res => {
    if (!res.status) {
        alert(res.message || 'Save failed');
        return;
    }

    const savedId = res.quotation_room_tariff_details_id || '';

    // modal hidden
    const modalIdEl = document.getElementById('modal_quotation_room_tariff_details_id');
    if (modalIdEl) modalIdEl.value = savedId;

    // row hidden
    if (window.__lastRoomEditBtn) {
        const tr = window.__lastRoomEditBtn.closest('tr');

        const tariffIdInput = tr?.querySelector('.quotationRoomTariffDetailsIdInput');
        if (tariffIdInput) tariffIdInput.value = savedId;

        const rateText  = tr?.querySelector('.autoCalcRateText');
        const rateInput = tr?.querySelector('.autoCalcRateInput');

        const manualTotal = num(document.querySelector('#manual_total_rate')?.value || 0);
        const finalTotal  = manualTotal > 0 ? manualTotal : num(document.querySelector('#auto_total_rate')?.value || 0);
        const val = finalTotal.toFixed(2);

        if (rateText)  rateText.textContent = val;
        if (rateInput) rateInput.value = val;

        const optionBlock = window.__lastRoomEditBtn.closest('.optionBlock');
        if (optionBlock) recalcOptionTotals(optionBlock);
    }

    if (window.__lastRoomEditBtn) {
        const tr = window.__lastRoomEditBtn.closest('tr');
        const tariffHidden = tr ? tr.querySelector('.quotationRoomTariffDetailsIdInput') : null;

        if (tariffHidden && res.quotation_room_tariff_details_id) {
            tariffHidden.value = res.quotation_room_tariff_details_id;
        }
    }
    $('#roompricingandguestallocationModal').modal('hide');
})
    .catch(err => {
        console.error(err);
        alert('Server error');
    });

});



/* ================= READ VALUES ================= */

/**
 * If you have multiple optionBlocks, we calculate totals using the ACTIVE option.
 * ACTIVE = the optionBlock that user is working on (has selected package option)
 * If you want "highest room among ALL options", change getActiveOptionBlock().
 */
function getActiveOptionBlock() {
  // Best-effort: choose first visible optionBlock
  const blocks = Array.from(document.querySelectorAll('.optionBlock'));
  if (!blocks.length) return null;

  // If you mark active one with class, prefer that:
  const active = document.querySelector('.optionBlock.active');
  if (active) return active;

  // Otherwise take first:
  return blocks[0];
}

function getCabCost() {
  const optionBlock = getActiveOptionBlock();
  if (!optionBlock) return 0;

  const cabEl = optionBlock.querySelector('[name="quotation_options_cab_amount[]"]');
  return toNumber(cabEl ? cabEl.value : 0);
}

function getHighestRoomRate() {
  const optionBlock = getActiveOptionBlock();
  if (!optionBlock) return 0;

  let maxRate = 0;

  // Room rows have hidden input .autoCalcRateInput (your plan)
  optionBlock.querySelectorAll('.autoCalcRateInput').forEach(inp => {
    const v = toNumber(inp.value);
    if (v > maxRate) maxRate = v;
  });

  // If you don't have inputs in some rows, also try text
  optionBlock.querySelectorAll('.autoCalcRateText').forEach(span => {
    const v = toNumber(span.textContent);
    if (v > maxRate) maxRate = v;
  });

  return maxRate;
}

function getInclusionTotal() {
  let total = 0;
  document.querySelectorAll('[name="inclusion_amount[]"]').forEach(inp => {
    total += toNumber(inp.value);
  });
  return total;
}

function getSpecialReqTotal() {
  let total = 0;
  document.querySelectorAll('[name="special_requirements_cost[]"], .specialReqCost').forEach(inp => {
    total += toNumber(inp.value);
  });
  return total;
}

function getMarginAmount(totalCost) {
  const type = document.getElementById('marginType')?.value || 'amount';
  const value = toNumber(document.getElementById('marginValue')?.value);

  if (type === 'percent') {
    return (totalCost * value) / 100;
  }
  return value;
}

/* ================= MAIN CALC ================= */

function refreshQuoteSummaryTotals() {
  const cab = getCabCost();
  const highestRoom = getHighestRoomRate();
  const inclusionTotal = getInclusionTotal();
  const specialReqTotal = getSpecialReqTotal();

  const totalCost = cab + highestRoom + inclusionTotal + specialReqTotal;
  const marginAmount = getMarginAmount(totalCost);
  const totalQuote = totalCost + marginAmount;

  // UI text
  const setText = (id, val) => {
    const el = document.getElementById(id);
    if (el) el.textContent = money(val);
  };

  setText('cabCostText', cab);
  setText('highestRoomText', highestRoom);
  setText('inclusionTotalText', inclusionTotal);
  setText('specialReqTotalText', specialReqTotal);
  setText('marginAmountText', marginAmount);

  setText('totalCostText', totalCost);
  setText('totalQuoteText', totalQuote);

  // Hidden inputs for save
  const totalCostInp = document.getElementById('total_cost');
  const marginInp = document.getElementById('margin_amount');
  const totalQuoteInp = document.getElementById('total_quote_rate');

  if (totalCostInp) totalCostInp.value = money(totalCost);
  if (marginInp) marginInp.value = money(marginAmount);
  if (totalQuoteInp) totalQuoteInp.value = money(totalQuote);
}

/* ================= LIVE UPDATES ================= */

// Any typing in Cab / Inclusion / Special Req should recalc
document.addEventListener('input', function (e) {
  const t = e.target;

  if (
    t.matches('[name="quotation_options_cab_amount[]"]') ||
    t.matches('[name="inclusion_amount[]"]') ||
    t.matches('[name="special_requirements_cost[]"]') ||
    t.closest('.specialReqCost') ||
    t.id === 'marginValue'
  ) {
    refreshQuoteSummaryTotals();
  }
});

// Margin type change
document.addEventListener('change', function (e) {
  const t = e.target;
  if (t && t.id === 'marginType') refreshQuoteSummaryTotals();
});


/* ===== GLOBAL HELPERS ===== */
function num(v) {
  const n = parseFloat(v);
  return isNaN(n) ? 0 : n;
}

/* Highest room auto-calculated rate per day (sum of max per day) */
function calculateHighestRoomRatePerDay(optionBlock) {
  const dayMax = {}; // {dayId: maxRate}

  optionBlock.querySelectorAll('.autoCalcRateInput').forEach(input => {
    const tr = input.closest('tr');
    const dayId = tr?.getAttribute('data-day-id');
    if (!dayId) return;

    const rate = num(input.value);

    if (dayMax[dayId] === undefined || rate > dayMax[dayId]) {
      dayMax[dayId] = rate;
    }
  });

  return Object.values(dayMax).reduce((a, b) => a + b, 0);
}


function recalcOptionTotals(optionBlock) {
  if (!optionBlock) return;

  const cabInput = optionBlock.querySelector('[name="quotation_options_cab_amount[]"]');
  const cabAmount = num(cabInput?.value);

  const roomsTotal = calculateHighestRoomRatePerDay(optionBlock);
  const totalCost = cabAmount + roomsTotal;

  const costText  = optionBlock.querySelector('.optionTotalCostText');
  const costInput = optionBlock.querySelector('.optionTotalCostInput');
  if (costText)  costText.textContent = totalCost.toFixed(2);
  if (costInput) costInput.value = totalCost.toFixed(2);

  const marginTypeEl  = optionBlock.querySelector('.optionMarginType');
  const marginValueEl = optionBlock.querySelector('.optionMarginValue');

  const marginType  = marginTypeEl ? marginTypeEl.value : 'amount';
  const marginValue = num(marginValueEl?.value);

  let marginAmount = 0;
  if (marginType === 'percent') marginAmount = (totalCost * marginValue) / 100;
  else marginAmount = marginValue;

  const quoteTotal = totalCost + marginAmount;

  const quoteText  = optionBlock.querySelector('.optionQuoteTotalText');
  const quoteInput = optionBlock.querySelector('.optionQuoteTotalInput');
  if (quoteText)  quoteText.textContent = quoteTotal.toFixed(2);
  if (quoteInput) quoteInput.value = quoteTotal.toFixed(2);
}

/* ===== LIVE RECALC TRIGGERS ===== */
document.addEventListener('input', function (e) {
  // cab amount
  if (e.target.name === 'quotation_options_cab_amount[]') {
    const optionBlock = e.target.closest('.optionBlock');
    recalcOptionTotals(optionBlock);
  }

  // margin value
  if (e.target.classList.contains('optionMarginValue')) {
    const optionBlock = e.target.closest('.optionBlock');
    recalcOptionTotals(optionBlock);
  }
});

document.addEventListener('change', function (e) {
  // margin type
  if (e.target.classList.contains('optionMarginType')) {
    const optionBlock = e.target.closest('.optionBlock');
    recalcOptionTotals(optionBlock);
  }
});

function setManualField(name, value) {
    var el = document.querySelector('#roompricingandguestallocationModal [name="' + name + '"]');
    if (el) el.value = (value === undefined || value === null) ? '' : value;
}

function fillSavedManualSection(data) {
    if (!data) return;

    setManualField('manual_count', data.room_unit_manual_count || 0);
    setManualField('manual_rate', data.room_unit_manual_rate || 0);

    setManualField('manual_extra_bed_adult_count', data.extra_bed_adult_manual_count || 0);
    setManualField('manual_extra_bed_adult_rate', data.extra_bed_adult_manual_rate || 0);

    setManualField('manual_extra_bed_child_count', data.extra_bed_child_manual_count || 0);
    setManualField('manual_extra_bed_child_rate', data.extra_bed_child_manual_rate || 0);

    setManualField('manual_child_sharing_bed_count', data.child_sharing_bed_manual_count || 0);
    setManualField('manual_child_sharing_bed_rate', data.child_sharing_bed_manual_rate || 0);

    setManualField('manual_single_occupancy_count', data.single_occupancy_manual_count || 0);
    setManualField('manual_single_occupancy_rate', data.single_occupancy_manual_rate || 0);

    setManualField('manual_supplment_cost_count', data.supplyment_manual_cost_count || 'NA');
    setManualField('manual_supplment_cost', data.supplyment_manual_cost || 0);

    var hidden = document.getElementById('manual_total_rate');
    if (hidden) hidden.value = data.manual_total_rate || 0;

    if (typeof refreshAllAmountsAndTotals === 'function') {
        refreshAllAmountsAndTotals();
    }
}
// Status options
const QUOTATION_STATUSES = [
//   { id: 1, text: 'Generated' },
  { id: 2, text: 'Draft' },
  { id: 3, text: 'Sent' },
  { id: 4, text: 'Rejected' },
//   { id: 5, text: 'Confirmed' },
  { id: 6, text: 'Cancelled' }
];

function computeRequiredBedCounts(rooms, policyDb, policyEb, policySb, adults, children, baby) {
    var totalDB = rooms * policyDb;
    var totalEB = rooms * policyEb;
    var totalSB = rooms * policySb;
    var a = adults, c = children, b = baby;

    var babySB  = Math.min(b, totalSB);              b -= babySB;
    var childSB = Math.min(c, totalSB - babySB);     c -= childSB;
    var adultDB = Math.min(a, totalDB);              a -= adultDB;
    var remDB   = totalDB - adultDB;
    var childDB = Math.min(c, remDB);                c -= childDB;
    var babyEB  = Math.min(b, totalEB);              b -= babyEB;
    var remEB   = totalEB - babyEB;
    var adultEB = Math.min(a, remEB);                a -= adultEB; remEB -= adultEB;
    var childEB = Math.min(c, remEB);                c -= childEB;

    return {
        fits:    (a === 0 && c === 0 && b === 0),
        adultEB: adultEB,
        childEB: childEB,
        childSB: childSB,
        babySB:  babySB,
        maxEB:   totalEB,
        maxSB:   totalSB
    };
}

document.addEventListener('input', function (e) {

    if (!e.target.closest('#roompricingandguestallocationModal')) return;

    const el = e.target;

    if (!el.name) return;

    if (el.name.includes('manual')) {

        const row = el.closest('tr') || el.closest('.row');
        if (!row) return;

        const countEl = row.querySelector('[name*="count"]');
        const rateEl  = row.querySelector('[name*="rate"]');

        if (!countEl || !rateEl) return;

        const count = parseFloat(countEl.value) || 0;
        const rate  = parseFloat(rateEl.value) || 0;

        if (count > 0 && rate <= 0) {
            rateEl.classList.add('is-invalid');
        } else {
            rateEl.classList.remove('is-invalid');
        }
    }

    // Live room count adequacy warning
    if (el.name === 'manual_count') {
        var minRooms = parseInt(document.getElementById('modal_min_rooms_required')?.value || 0);
        var enteredRooms = parseInt(el.value || 0);
        var warnDiv = document.getElementById('manual-room-count-warning');
        if (warnDiv && minRooms > 0) {
            if (enteredRooms < minRooms) {
                var policyDb = parseInt(document.getElementById('modal_policy_db')?.value || 0);
                var policyEb = parseInt(document.getElementById('modal_policy_eb')?.value || 0);
                var policySb = parseInt(document.getElementById('modal_policy_sb')?.value || 0);
                var appAdults = parseInt(document.getElementById('modal_applied_adults')?.value || 0);
                var appChildren = parseInt(document.getElementById('modal_applied_children')?.value || 0);
                var appBaby = parseInt(document.getElementById('modal_applied_baby')?.value || 0);
                warnDiv.textContent =
                    'Insufficient rooms: ' + enteredRooms + ' chosen, min ' + minRooms + ' required ' +
                    '(Policy DB:' + policyDb + ' EB:' + policyEb + ' SB:' + policySb +
                    ' | Guests Adults:' + appAdults + ' Children:' + appChildren + ' Baby:' + appBaby + ')';
                warnDiv.style.display = 'block';
                el.classList.add('is-invalid');
            } else {
                warnDiv.style.display = 'none';
                el.classList.remove('is-invalid');
            }
        }
    }

    // Live EB / SB adequacy warnings
    var _ebSbFields = ['manual_count', 'manual_extra_bed_adult_count', 'manual_extra_bed_child_count', 'manual_child_sharing_bed_count'];
    if (_ebSbFields.includes(el.name)) {
        var _rooms    = parseInt(document.querySelector('[name="manual_count"]')?.value || 0);
        var _pDb      = parseInt(document.getElementById('modal_policy_db')?.value || 0);
        var _pEb      = parseInt(document.getElementById('modal_policy_eb')?.value || 0);
        var _pSb      = parseInt(document.getElementById('modal_policy_sb')?.value || 0);
        var _adults   = parseInt(document.getElementById('modal_applied_adults')?.value || 0);
        var _children = parseInt(document.getElementById('modal_applied_children')?.value || 0);
        var _baby     = parseInt(document.getElementById('modal_applied_baby')?.value || 0);

        if (_rooms > 0 && (_adults + _children + _baby) > 0) {
            var _req = computeRequiredBedCounts(_rooms, _pDb, _pEb, _pSb, _adults, _children, _baby);

            var _ebAEl   = document.querySelector('[name="manual_extra_bed_adult_count"]');
            var _ebCEl   = document.querySelector('[name="manual_extra_bed_child_count"]');
            var _sbCEl   = document.querySelector('[name="manual_child_sharing_bed_count"]');
            var _ebAWarn = document.getElementById('manual-eb-adult-warning');
            var _ebCWarn = document.getElementById('manual-eb-child-warning');
            var _sbCWarn = document.getElementById('manual-sb-child-warning');

            var _mEbA = parseInt(_ebAEl?.value || 0);
            var _mEbC = parseInt(_ebCEl?.value || 0);
            var _mSbC = parseInt(_sbCEl?.value || 0);

            var _totalEB    = _mEbA + _mEbC;
            var _babySb = parseInt(document.getElementById('modal_baby_sb_count')?.value || 0);
            var _babyEb = parseInt(document.getElementById('modal_baby_eb_count')?.value || 0);
            var _totalCap  = _rooms * _pDb + _totalEB + _mSbC + _babySb + _babyEb;
            var _totalGuests = _adults + _children + _baby;

            if (_ebAWarn) {
                if (_totalEB > _req.maxEB) {
                    _ebAWarn.textContent = 'Total EB (' + _totalEB + ') exceeds capacity: max ' + _req.maxEB + ' for ' + _rooms + ' room(s)';
                    _ebAWarn.style.display = 'block';
                    if (_ebAEl) _ebAEl.classList.add('is-invalid');
                } else {
                    _ebAWarn.style.display = 'none';
                    if (_ebAEl) _ebAEl.classList.remove('is-invalid');
                }
            }

            if (_ebCWarn) {
                if (_totalEB > _req.maxEB) {
                    _ebCWarn.textContent = 'Total EB (' + _totalEB + ') exceeds capacity: max ' + _req.maxEB + ' for ' + _rooms + ' room(s)';
                    _ebCWarn.style.display = 'block';
                    if (_ebCEl) _ebCEl.classList.add('is-invalid');
                } else {
                    _ebCWarn.style.display = 'none';
                    if (_ebCEl) _ebCEl.classList.remove('is-invalid');
                }
            }

            if (_sbCWarn) {
                if (_mSbC > _req.maxSB) {
                    _sbCWarn.textContent = 'SB (' + _mSbC + ') exceeds capacity: max ' + _req.maxSB + ' for ' + _rooms + ' room(s)';
                    _sbCWarn.style.display = 'block';
                    if (_sbCEl) _sbCEl.classList.add('is-invalid');
                } else if (_totalCap < _totalGuests) {
                    _sbCWarn.textContent = 'Insufficient beds: capacity ' + _totalCap + ' < guests ' + _totalGuests + '. Add rooms, EB, or SB.';
                    _sbCWarn.style.display = 'block';
                    if (_sbCEl) _sbCEl.classList.add('is-invalid');
                } else {
                    _sbCWarn.style.display = 'none';
                    if (_sbCEl) _sbCEl.classList.remove('is-invalid');
                }
            }
        }
    }
});

function validateManualRoomingPlan() {

    let isValid = true;

    function showError(el, msg) {
        var n = new notify({
            title: '',
            style: 'error',
            message: msg,
            icon: 'fas fa-times'
        });
        n.show();
        setTimeout(function(){ n.hide(); }, 5000);

        if (el) {
            el.focus();
            el.classList.add('is-invalid');
            setTimeout(() => el.classList.remove('is-invalid'), 2000);
        }
        isValid = false;
    }

    // Capacity adequacy check
    var minRooms   = parseInt(document.getElementById('modal_min_rooms_required')?.value || 0);
    var policyDb   = parseInt(document.getElementById('modal_policy_db')?.value || 0);
    var policyEb   = parseInt(document.getElementById('modal_policy_eb')?.value || 0);
    var policySb   = parseInt(document.getElementById('modal_policy_sb')?.value || 0);
    var appAdults  = parseInt(document.getElementById('modal_applied_adults')?.value || 0);
    var appChildren= parseInt(document.getElementById('modal_applied_children')?.value || 0);
    var appBaby    = parseInt(document.getElementById('modal_applied_baby')?.value || 0);

    var manualCountEl = document.querySelector('[name="manual_count"]');
    var manualRooms   = parseInt(manualCountEl?.value || 0);

    if (minRooms > 0 && manualRooms < minRooms) {
        alert(
            'Room count is inadequate.\n\n' +
            'You entered: ' + manualRooms + ' room(s)\n' +
            'Minimum required: ' + minRooms + ' room(s)\n\n' +
            'Room policy — DB: ' + policyDb + ' | EB: ' + policyEb + ' | SB: ' + policySb + '\n' +
            'Guest requirement — Adults: ' + appAdults + ' | Children: ' + appChildren + ' | Baby: ' + appBaby
        );
        if (manualCountEl) {
            manualCountEl.focus();
            manualCountEl.classList.add('is-invalid');
            setTimeout(() => manualCountEl.classList.remove('is-invalid'), 3000);
        }
        return false;
    }

    // EB / SB adequacy check
    if (manualRooms > 0 && (appAdults + appChildren + appBaby) > 0) {
        var req = computeRequiredBedCounts(manualRooms, policyDb, policyEb, policySb, appAdults, appChildren, appBaby);

        var ebAdultEl = document.querySelector('[name="manual_extra_bed_adult_count"]');
        var ebChildEl = document.querySelector('[name="manual_extra_bed_child_count"]');
        var sbChildEl = document.querySelector('[name="manual_child_sharing_bed_count"]');
        var mEbAdult  = parseInt(ebAdultEl?.value || 0);
        var mEbChild  = parseInt(ebChildEl?.value || 0);
        var mSbChild  = parseInt(sbChildEl?.value || 0);

        var babySb = parseInt(document.getElementById('modal_baby_sb_count')?.value || 0);
        var babyEb = parseInt(document.getElementById('modal_baby_eb_count')?.value || 0);
        var totalCap    = manualRooms * policyDb + mEbAdult + mEbChild + mSbChild + babySb + babyEb;
        var totalGuests = appAdults + appChildren + appBaby;
        if (totalCap < totalGuests) {
            alert(
                'Bed capacity is insufficient for all guests.\n\n' +
                'Capacity: ' + manualRooms + ' rooms × DB(' + policyDb + ') + EB(' + (mEbAdult + mEbChild) + ') + SB(' + mSbChild + ') = ' + totalCap + '\n' +
                'Guests: Adults(' + appAdults + ') + Children(' + appChildren + ') + Baby(' + appBaby + ') = ' + totalGuests + '\n\n' +
                'Please increase room count, Extra Beds, or Child Sharing Beds.'
            );
            return false;
        }

        if (mEbAdult + mEbChild > req.maxEB) {
            alert(
                'Total Extra Bed count exceeds room capacity.\n\n' +
                'EB Adult: ' + mEbAdult + ' + EB Child: ' + mEbChild + ' = ' + (mEbAdult + mEbChild) + '\n' +
                'Max EB capacity: ' + req.maxEB + ' (' + manualRooms + ' rooms × EB:' + policyEb + ')'
            );
            return false;
        }

        if (mSbChild > req.maxSB) {
            alert(
                'Child Sharing Bed count exceeds room capacity.\n\n' +
                'Entered: ' + mSbChild + '\n' +
                'Max SB capacity: ' + req.maxSB + ' (' + manualRooms + ' rooms × SB:' + policySb + ')'
            );
            return false;
        }
    }

    // All manual fields
    const fields = [
        {count: 'manual_count', rate: 'manual_rate', label: 'Room Units'},
        {count: 'manual_extra_bed_adult_count', rate: 'manual_extra_bed_adult_rate', label: 'Extra Bed Adult'},
        {count: 'manual_extra_bed_child_count', rate: 'manual_extra_bed_child_rate', label: 'Extra Bed Child'},
        {count: 'manual_child_sharing_bed_count', rate: 'manual_child_sharing_bed_rate', label: 'Child Sharing Bed'},
        {count: 'manual_single_occupancy_count', rate: 'manual_single_occupancy_rate', label: 'Single Occupancy'}
    ];

    for (let f of fields) {

        let countEl = document.querySelector(`[name="${f.count}"]`);
        let rateEl  = document.querySelector(`[name="${f.rate}"]`);

        if (!countEl || !rateEl) continue;

        let count = parseFloat(countEl.value) || 0;
        let rate  = parseFloat(rateEl.value) || 0;

        // ❌ Empty validation
        if (countEl.value === '') {
            showError(countEl, `${f.label} count is required`);
            return false;
        }

        if (rateEl.value === '') {
            showError(rateEl, `${f.label} rate is required`);
            return false;
        }

        // ❌ Logic validation
        if (count > 0 && rate <= 0) {
            showError(rateEl, `${f.label} rate must be greater than 0`);
            return false;
        }
    }

    // ❌ Supplement cost validation
    var modalEl2 = document.getElementById('roompricingandguestallocationModal');
    var tariffData2 = null;
    if (modalEl2 && modalEl2.dataset.tariffData) {
        try { tariffData2 = JSON.parse(modalEl2.dataset.tariffData); } catch (e) { tariffData2 = null; }
    }

    if (tariffData2 && tariffData2.needs_supplement) {
        let supEl = document.querySelector('[name="manual_supplment_cost"]');
        let supVal = supEl ? (parseFloat(supEl.value) || 0) : 0;

        if (supVal <= 0) {
            showError(supEl, 'Supplement cost is required because the room policy does not cover the enquiry meal plan. Please enter a valid supplement cost.');
            return false;
        }
    }

    return isValid;
}

</script>