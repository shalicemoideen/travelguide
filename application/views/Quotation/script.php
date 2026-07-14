
<script type="text/javascript">

////***Select2 AJAX option *****///

// Quotation number filter - AJAX Select2
$("#quotation_number_filter").select2({
  width: '100%',
  placeholder: 'Please Select Quotation number',
  allowClear: true,
  ajax: {
    url: '<?php echo base_url(); ?>index.php/Quotation/ajax_filter_quotations',
    dataType: 'json',
    delay: 250,
    data: function(params) {
      return { q: params.term };
    },
    processResults: function(data) {
      return data;
    },
    cache: true
  }
});

// Package filter - AJAX Select2
$("#package_id_filter").select2({
  width: '100%',
  placeholder: 'Please Select package',
  allowClear: true,
  ajax: {
    url: '<?php echo base_url(); ?>index.php/Quotation/ajax_filter_packages',
    dataType: 'json',
    delay: 250,
    data: function(params) {
      return { q: params.term };
    },
    processResults: function(data) {
      return data;
    },
    cache: true
  }
});

// Leads filter - AJAX Select2 (shows lead number + guest name)
$("#leads_id_filter").select2({
  width: '100%',
  placeholder: 'Please Select lead',
  allowClear: true,
  ajax: {
    url: '<?php echo base_url(); ?>index.php/Quotation/ajax_filter_leads',
    dataType: 'json',
    delay: 250,
    data: function(params) {
      return { q: params.term };
    },
    processResults: function(data) {
      return data;
    },
    cache: true
  }
});

// Fix Select2 focus issue - force focus search input when dropdown opens
$(document).on('select2:open', function() {
  setTimeout(function() {
    var searchInput = document.querySelector('.select2-container--open .select2-search__field');
    if (searchInput) {
      searchInput.focus();
    }
  }, 100);
});
$("#quotation_created_by_userid").select2({
  // dropdownParent: $("#LeadsModal"),
  minimumResultsForSearch: 0
});
$("#quotation_current_status_filter").select2({
  // dropdownParent: $("#LeadsModal"),
  minimumResultsForSearch: 0
});
$("#leads_id").select2({
  dropdownParent: $("#QuotationModal"),
  placeholder: 'Please Select lead',
  allowClear: true,
  width: '100%',
  ajax: {
    url: '<?php echo base_url(); ?>index.php/Quotation/ajax_filter_leads',
    dataType: 'json',
    delay: 250,
    data: function(params) {
      return {
        q: params.term || '',
        filter_mode: $('#leads_id').data('filter-mode') || 'add_quotation'
      };
    },
    processResults: function(data) {
      return data;
    },
    cache: false
  }
});
// $("#packages_id_fk").select2({
//   dropdownParent: $("#QuotationModal"),
//   minimumResultsForSearch: 0
// });

/* run once on load */
// toggleAddOptionBtn();
////***Select2 option *****///

////***Date picker *****///

////***Date picker *****///

// $('#quotation_date').bootstrapMaterialDatePicker({
//     weekStart: 0,
//     time: false,
//     format: 'DD/MM/YYYY'
// }).bootstrapMaterialDatePicker('setDate', moment());

$('#quotation_date').datepicker({
    format: 'dd-mm-yyyy',
    autoclose: true,
    todayHighlight: true
});



// Date range picker for quotation date filter
$('#quotation_daterange').daterangepicker({
    autoUpdateInput: false,
    locale: {
        format: 'DD/MM/YYYY',
        cancelLabel: 'Clear'
    }
});

$('#quotation_daterange').on('apply.daterangepicker', function(ev, picker) {
    $(this).val(
        picker.startDate.format('DD/MM/YYYY') + ' - ' + picker.endDate.format('DD/MM/YYYY')
    );
});

$('#quotation_daterange').on('cancel.daterangepicker', function() {
    $(this).val('');
});
 
////***Date picker *****///

////***Filter button hide and show*****///

$(document).ready(function () {
    $("#btn").click(function () {
        $("#Create").toggle();
    });
});

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


////***Filter button hide and show*****///

////***searching button*****///

$('#search').click(function () {
    $table.ajax.reload();
});

$('#search1').click(function () {
    $table1.ajax.reload();
});

$('#search2').click(function () {
    $table2.ajax.reload();
});

$("#guest_name").keypress(function() {
    $table.ajax.reload();
});
$("#arriving_destination_filter").keypress(function() {
    $table.ajax.reload();
});
$("#departuring_destination_filter").keypress(function() {
    $table.ajax.reload();
});

// Reset filter button
$('#reset_filter').click(function() {
    // Clear all filter inputs
    $('#quotation_number_filter').val(null).trigger('change');
    $('#package_id_filter').val(null).trigger('change');
    $('#leads_id_filter').val(null).trigger('change');
    $('#quotation_current_status_filter').val('').trigger('change');
    $('#guest_name').val('');
    $('#arriving_destination_filter').val('');
    $('#departuring_destination_filter').val('');
    $('#quotation_daterange').val('');
    $('#quotation_created_by_userid').val('').trigger('change');

    // Reload table
    $table.ajax.reload();
});
////***searching button*****///

////***Listing table*****///

var save_method; //for save method string
var table;
  $(document).ready(function() {
    
    
    $table = $('#Quotation_registration').DataTable( {
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
                                        columns: [0, 1, 2, 3, 4, 5, 6]
                                    },
                                    title: 'Quotation details'
                                },
                                {
                                    extend: 'pdf',
                                    exportOptions: {
                                        columns: [0, 1, 2, 3, 4, 5, 6]
                                    },
                                    title: 'Quotation details'
                                },
                                {
                                    extend: 'print',
                                    exportOptions: {
                                        columns: [0 ,1, 2, 3, 4, 5, 6]
                                    },
                                    title: 'Quotation details'
                                },
                               
            ],
        "ajax": {
            "url": "<?php echo base_url();?>index.php/Quotation/get/",
            "type": "POST",
            "data" : function (d) {
                d.quotation_number_filter = $("#quotation_number_filter").val();
                d.leads_id_filter = $("#leads_id_filter").val();
                d.guest_name = $("#guest_name").val();
                d.package_id_filter = $("#package_id_filter").val();
                d.arriving_destination_filter = $("#arriving_destination_filter").val();
                d.departuring_destination_filter = $("#departuring_destination_filter").val();
                d.quotation_current_status_filter = $("#quotation_current_status_filter").val();
                d.quotation_created_by_userid = $("#quotation_created_by_userid").val();

                // Date range filter
                var dateRange = $("#quotation_daterange").val();
                if (dateRange) {
                    var dates = dateRange.split(' - ');
                    d.start_date = dates[0] || '';
                    d.end_date = dates[1] || '';
                } else {
                    d.start_date = '';
                    d.end_date = '';
                }
           }            
        },
        "createdRow": function ( row, data, index ) {
          
//            $('td',row).eq(0).html(index+1);
           $table.column(0).nodes().each(function(node,index,dt){
            $table.cell(node).data(index+1);
            });
            
            
            $table.column(6).nodes().each(function(node, index, dt) {
            if($table.cell(node).data() == '1') {
            
            // if(data['quotation_current_status'] == 1){
              $table.cell(node).data('<span class="badge badge-secondary">Generated</span>');
              
            //   $('td', row).eq(9).html('<div class="dropdown ms-auto text-end"><div class="btn-link" data-bs-toggle="dropdown"><svg width="24px" height="24px" viewBox="0 0 24 24" version="1.1"><g stroke="none" stroke-width="1" fill="none" fill-rule="evenodd"><rect x="0" y="0" width="24" height="24"></rect><circle fill="#000000" cx="5" cy="12" r="2"></circle><circle fill="#000000" cx="12" cy="12" r="2"></circle><circle fill="#000000" cx="19" cy="12" r="2"></circle></g></svg></div><div class="dropdown-menu dropdown-menu-end"><a class="dropdown-item" href="javascript:void(0)" id="rt" onclick="change_status('+data['quotation_id']+')">Change status</a><a class="dropdown-item" href="javascript:void(0)" id="rt" onclick="update_itinerary('+data['quotation_id']+')">Edit Itinerary</a><a class="dropdown-item" target="_blank" href="<?php echo base_url();?>index.php/Quotation/quotation_preview/'+data['quotation_id']+'" >Preview</a><a class="dropdown-item" href="javascript:void(0)" id="rt" onclick="edit_quotation('+data['quotation_id']+')">Edit</a><a class="dropdown-item" href="javascript:void(0)" onclick="return delete_quotation('+data['quotation_id']+')">Delete</a></div></div>');

                $('td', row).eq(2).html('<center><a class="dropdown-item" href="javascript:void(0)" id="rt" onclick="view_lead_details('+data['quotation_id']+')">'+data['leads_number']+'</a></center>');

              let actionHtml = '<div class="dropdown ms-auto text-end"><div class="btn-link" data-bs-toggle="dropdown"><svg width="24px" height="24px" viewBox="0 0 24 24" version="1.1"><g stroke="none" stroke-width="1" fill="none" fill-rule="evenodd"><rect x="0" y="0" width="24" height="24"></rect><circle fill="#000000" cx="5" cy="12" r="2"></circle><circle fill="#000000" cx="12" cy="12" r="2"></circle><circle fill="#000000" cx="19" cy="12" r="2"></circle></g></svg></div><div class="dropdown-menu dropdown-menu-end">';

                // Edit button
                if (hasPermission('QUOTATION_UPDATE')) {
                    actionHtml += '<a class="dropdown-item" href="javascript:void(0)" id="rt" onclick="edit_quotation('+data['quotation_id']+')">Edit</a>';
                }

                // Edit itinireary button
                if (hasPermission('QUOTATION_UPDATE_ITINERARY')) {
                    actionHtml += '<a class="dropdown-item" href="javascript:void(0)" id="rt" onclick="update_itinerary('+data['quotation_id']+')">Edit Itinerary</a>';
                }

               // Change status button
                // if (hasPermission('QUOTATION_CHANGE_STATUS')) {
                //     actionHtml += '<a class="dropdown-item" href="javascript:void(0)" id="rt" onclick="change_status('+data['quotation_id']+')">Change status</a>';
                // }

                // Quotation preview button
                if (hasPermission('QUOTATION_PREVIEW')) {
                    actionHtml += '<a class="dropdown-item" target="_blank" href="<?php echo base_url();?>index.php/Quotation/quotation_preview/'+data['quotation_id']+'" >Preview</a>';
                }

                // Quotation hub button
                if (hasPermission('QUOTATION_HUB')) {

                    actionHtml += '<a class="dropdown-item" target="_blank" href="<?php echo base_url();?>index.php/Quotation/quotation_hub/'+data['quotation_id']+'" >Quotation hub</a>';
                }

                // Delete button
                if (hasPermission('QUOTATION_DELETE')) {
                    actionHtml += '<a class="dropdown-item" href="javascript:void(0)" onclick="return delete_quotation('+data['quotation_id']+')">Delete</a>';
                }

                actionHtml += '</div></div>';

                $('td', row).eq(8).html(actionHtml);
            }
            else if($table.cell(node).data() == '2') {
            // else if(data['quotation_current_status'] == 2){
              $table.cell(node).data('<span class="badge badge-light">Draft</span>');
            //   $('td', row).eq(9).html('<div class="dropdown ms-auto text-end"><div class="btn-link" data-bs-toggle="dropdown"><svg width="24px" height="24px" viewBox="0 0 24 24" version="1.1"><g stroke="none" stroke-width="1" fill="none" fill-rule="evenodd"><rect x="0" y="0" width="24" height="24"></rect><circle fill="#000000" cx="5" cy="12" r="2"></circle><circle fill="#000000" cx="12" cy="12" r="2"></circle><circle fill="#000000" cx="19" cy="12" r="2"></circle></g></svg></div><div class="dropdown-menu dropdown-menu-end"><a class="dropdown-item" href="javascript:void(0)" id="rt" onclick="change_status('+data['quotation_id']+')">Change status</a><a class="dropdown-item" href="javascript:void(0)" id="rt" onclick="update_itinerary('+data['quotation_id']+')">Edit Itinerary</a><a class="dropdown-item" target="_blank" href="<?php echo base_url();?>index.php/Quotation/quotation_preview/'+data['quotation_id']+'" >Preview</a><a class="dropdown-item" href="javascript:void(0)" id="rt" onclick="edit_quotation('+data['quotation_id']+')">Edit</a><a class="dropdown-item" href="javascript:void(0)" onclick="return delete_quotation('+data['quotation_id']+')">Delete</a></div></div>');
                
            $('td', row).eq(2).html('<center><a class="dropdown-item" href="javascript:void(0)" id="rt" onclick="view_lead_details('+data['quotation_id']+')">'+data['leads_number']+'</a></center>');

              let actionHtml = '<div class="dropdown ms-auto text-end"><div class="btn-link" data-bs-toggle="dropdown"><svg width="24px" height="24px" viewBox="0 0 24 24" version="1.1"><g stroke="none" stroke-width="1" fill="none" fill-rule="evenodd"><rect x="0" y="0" width="24" height="24"></rect><circle fill="#000000" cx="5" cy="12" r="2"></circle><circle fill="#000000" cx="12" cy="12" r="2"></circle><circle fill="#000000" cx="19" cy="12" r="2"></circle></g></svg></div><div class="dropdown-menu dropdown-menu-end">';

                // Edit button
                if (hasPermission('QUOTATION_UPDATE')) {
                    actionHtml += '<a class="dropdown-item" href="javascript:void(0)" id="rt" onclick="edit_quotation('+data['quotation_id']+')">Edit</a>';
                }

                // Edit itinireary button
                if (hasPermission('QUOTATION_UPDATE_ITINERARY')) {
                    actionHtml += '<a class="dropdown-item" href="javascript:void(0)" id="rt" onclick="update_itinerary('+data['quotation_id']+')">Edit Itinerary</a>';
                }

                // Change status button
                if (hasPermission('QUOTATION_CHANGE_STATUS')) {
                    actionHtml += '<a class="dropdown-item" href="javascript:void(0)" id="rt" onclick="change_status('+data['quotation_id']+')">Change status</a>';
                }

                // Quotation preview button
                if (hasPermission('QUOTATION_PREVIEW')) {
                    actionHtml += '<a class="dropdown-item" target="_blank" href="<?php echo base_url();?>index.php/Quotation/quotation_preview/'+data['quotation_id']+'" >Preview</a>';
                }

                // Quotation hub button
                if (hasPermission('QUOTATION_HUB')) {

                    actionHtml += '<a class="dropdown-item" target="_blank" href="<?php echo base_url();?>index.php/Quotation/quotation_hub/'+data['quotation_id']+'" >Quotation hub</a>';
                }

                // Delete button
                if (hasPermission('QUOTATION_DELETE')) {
                    actionHtml += '<a class="dropdown-item" href="javascript:void(0)" onclick="return delete_quotation('+data['quotation_id']+')">Delete</a>';
                }

                actionHtml += '</div></div>';

                $('td', row).eq(8).html(actionHtml);
            }
            else if($table.cell(node).data() == '3') {
            // else if(data['quotation_current_status'] == 3){
              $table.cell(node).data('<span class="badge badge-info">Sent</span>');
            //   $('td', row).eq(9).html('<div class="dropdown ms-auto text-end"><div class="btn-link" data-bs-toggle="dropdown"><svg width="24px" height="24px" viewBox="0 0 24 24" version="1.1"><g stroke="none" stroke-width="1" fill="none" fill-rule="evenodd"><rect x="0" y="0" width="24" height="24"></rect><circle fill="#000000" cx="5" cy="12" r="2"></circle><circle fill="#000000" cx="12" cy="12" r="2"></circle><circle fill="#000000" cx="19" cy="12" r="2"></circle></g></svg></div><div class="dropdown-menu dropdown-menu-end"><a class="dropdown-item" href="javascript:void(0)" id="rt" onclick="change_status('+data['quotation_id']+')">Change status</a><a class="dropdown-item" href="javascript:void(0)" id="rt" onclick="update_itinerary('+data['quotation_id']+')">Edit Itinerary</a><a class="dropdown-item" target="_blank" href="<?php echo base_url();?>index.php/Quotation/quotation_preview/'+data['quotation_id']+'" >Preview</a><a class="dropdown-item" href="javascript:void(0)" id="rt" onclick="edit_quotation('+data['quotation_id']+')">Edit</a><a class="dropdown-item" href="javascript:void(0)" onclick="return delete_quotation('+data['quotation_id']+')">Delete</a></div></div>');
                
            $('td', row).eq(2).html('<center><a class="dropdown-item" href="javascript:void(0)" id="rt" onclick="view_lead_details('+data['quotation_id']+')">'+data['leads_number']+'</a></center>');

              let actionHtml = '<div class="dropdown ms-auto text-end"><div class="btn-link" data-bs-toggle="dropdown"><svg width="24px" height="24px" viewBox="0 0 24 24" version="1.1"><g stroke="none" stroke-width="1" fill="none" fill-rule="evenodd"><rect x="0" y="0" width="24" height="24"></rect><circle fill="#000000" cx="5" cy="12" r="2"></circle><circle fill="#000000" cx="12" cy="12" r="2"></circle><circle fill="#000000" cx="19" cy="12" r="2"></circle></g></svg></div><div class="dropdown-menu dropdown-menu-end">';

                // Edit button
                if (hasPermission('QUOTATION_UPDATE')) {
                    actionHtml += '<a class="dropdown-item" href="javascript:void(0)" id="rt" onclick="edit_quotation('+data['quotation_id']+')">Edit</a>';
                }

                // Edit itinireary button
                if (hasPermission('QUOTATION_UPDATE_ITINERARY')) {
                    actionHtml += '<a class="dropdown-item" href="javascript:void(0)" id="rt" onclick="update_itinerary('+data['quotation_id']+')">Edit Itinerary</a>';
                }

                // Change status button
                if (hasPermission('QUOTATION_CHANGE_STATUS')) {
                    actionHtml += '<a class="dropdown-item" href="javascript:void(0)" id="rt" onclick="change_status('+data['quotation_id']+')">Change status</a>';
                }

                // Quotation preview button
                if (hasPermission('QUOTATION_PREVIEW')) {
                    actionHtml += '<a class="dropdown-item" target="_blank" href="<?php echo base_url();?>index.php/Quotation/quotation_preview/'+data['quotation_id']+'" >Preview</a>';
                }

                // Quotation hub button
                if (hasPermission('QUOTATION_HUB')) {

                    actionHtml += '<a class="dropdown-item" target="_blank" href="<?php echo base_url();?>index.php/Quotation/quotation_hub/'+data['quotation_id']+'" >Quotation hub</a>';
                }

                // Delete button
                if (hasPermission('QUOTATION_DELETE')) {
                    actionHtml += '<a class="dropdown-item" href="javascript:void(0)" onclick="return delete_quotation('+data['quotation_id']+')">Delete</a>';
                }

                actionHtml += '</div></div>';

                $('td', row).eq(8).html(actionHtml);
            }
            else if($table.cell(node).data() == '4') {
            // else if(data['quotation_current_status'] == 4){
              $table.cell(node).data('<span class="badge badge-danger">Rejected</span>');
            //   $('td', row).eq(9).html('<div class="dropdown ms-auto text-end"><div class="btn-link" data-bs-toggle="dropdown"><svg width="24px" height="24px" viewBox="0 0 24 24" version="1.1"><g stroke="none" stroke-width="1" fill="none" fill-rule="evenodd"><rect x="0" y="0" width="24" height="24"></rect><circle fill="#000000" cx="5" cy="12" r="2"></circle><circle fill="#000000" cx="12" cy="12" r="2"></circle><circle fill="#000000" cx="19" cy="12" r="2"></circle></g></svg></div><div class="dropdown-menu dropdown-menu-end"><a class="dropdown-item" href="javascript:void(0)" id="rt" onclick="change_status('+data['quotation_id']+')">Change status</a><a class="dropdown-item" href="javascript:void(0)" id="rt" onclick="update_itinerary('+data['quotation_id']+')">Edit Itinerary</a><a class="dropdown-item" target="_blank" href="<?php echo base_url();?>index.php/Quotation/quotation_preview/'+data['quotation_id']+'" >Preview</a><a class="dropdown-item" href="javascript:void(0)" id="rt" onclick="edit_quotation('+data['quotation_id']+')">Edit</a><a class="dropdown-item" href="javascript:void(0)" onclick="return delete_quotation('+data['quotation_id']+')">Delete</a></div></div>');
                
            $('td', row).eq(2).html('<center><a class="dropdown-item" href="javascript:void(0)" id="rt" onclick="view_lead_details('+data['quotation_id']+')">'+data['leads_number']+'</a></center>');

              let actionHtml = '<div class="dropdown ms-auto text-end"><div class="btn-link" data-bs-toggle="dropdown"><svg width="24px" height="24px" viewBox="0 0 24 24" version="1.1"><g stroke="none" stroke-width="1" fill="none" fill-rule="evenodd"><rect x="0" y="0" width="24" height="24"></rect><circle fill="#000000" cx="5" cy="12" r="2"></circle><circle fill="#000000" cx="12" cy="12" r="2"></circle><circle fill="#000000" cx="19" cy="12" r="2"></circle></g></svg></div><div class="dropdown-menu dropdown-menu-end">';

                // Edit button
                if (hasPermission('QUOTATION_UPDATE')) {
                    actionHtml += '<a class="dropdown-item" href="javascript:void(0)" id="rt" onclick="edit_quotation('+data['quotation_id']+')">Edit</a>';
                }

                // Edit itinireary button
                if (hasPermission('QUOTATION_UPDATE_ITINERARY')) {
                    actionHtml += '<a class="dropdown-item" href="javascript:void(0)" id="rt" onclick="update_itinerary('+data['quotation_id']+')">Edit Itinerary</a>';
                }

                // Change status button
                if (hasPermission('QUOTATION_CHANGE_STATUS')) {
                    actionHtml += '<a class="dropdown-item" href="javascript:void(0)" id="rt" onclick="change_status('+data['quotation_id']+')">Change status</a>';
                }

                // Quotation preview button
                if (hasPermission('QUOTATION_PREVIEW')) {
                    actionHtml += '<a class="dropdown-item" target="_blank" href="<?php echo base_url();?>index.php/Quotation/quotation_preview/'+data['quotation_id']+'" >Preview</a>';
                }

                // Quotation hub button
                if (hasPermission('QUOTATION_HUB')) {

                    actionHtml += '<a class="dropdown-item" target="_blank" href="<?php echo base_url();?>index.php/Quotation/quotation_hub/'+data['quotation_id']+'" >Quotation hub</a>';
                }

                // Delete button
                if (hasPermission('QUOTATION_DELETE')) {
                    actionHtml += '<a class="dropdown-item" href="javascript:void(0)" onclick="return delete_quotation('+data['quotation_id']+')">Delete</a>';
                }

                actionHtml += '</div></div>';

                $('td', row).eq(8).html(actionHtml);
            }
            else if($table.cell(node).data() == '5') {
            // else if(data['quotation_current_status'] == 5){
              $table.cell(node).data('<span class="badge badge-success">Confirmed</span>');
            //   $('td', row).eq(9).html('<div class="dropdown ms-auto text-end"><div class="btn-link" data-bs-toggle="dropdown"><svg width="24px" height="24px" viewBox="0 0 24 24" version="1.1"><g stroke="none" stroke-width="1" fill="none" fill-rule="evenodd"><rect x="0" y="0" width="24" height="24"></rect><circle fill="#000000" cx="5" cy="12" r="2"></circle><circle fill="#000000" cx="12" cy="12" r="2"></circle><circle fill="#000000" cx="19" cy="12" r="2"></circle></g></svg></div><div class="dropdown-menu dropdown-menu-end"><a class="dropdown-item" href="javascript:void(0)" id="rt" onclick="change_status('+data['quotation_id']+')">Change status</a><a class="dropdown-item" href="javascript:void(0)" id="rt" onclick="update_itinerary('+data['quotation_id']+')">Edit Itinerary</a><a class="dropdown-item" target="_blank" href="<?php echo base_url();?>index.php/Quotation/quotation_preview/'+data['quotation_id']+'" >Preview</a><a class="dropdown-item" href="javascript:void(0)" id="rt" onclick="edit_quotation('+data['quotation_id']+')">Edit</a><a class="dropdown-item" href="javascript:void(0)" onclick="return delete_quotation('+data['quotation_id']+')">Delete</a></div></div>');
              
                $('td', row).eq(2).html('<center><a class="dropdown-item" href="javascript:void(0)" id="rt" onclick="view_lead_details('+data['quotation_id']+')">'+data['leads_number']+'</a></center>');

                let actionHtml = '<div class="dropdown ms-auto text-end"><div class="btn-link" data-bs-toggle="dropdown"><svg width="24px" height="24px" viewBox="0 0 24 24" version="1.1"><g stroke="none" stroke-width="1" fill="none" fill-rule="evenodd"><rect x="0" y="0" width="24" height="24"></rect><circle fill="#000000" cx="5" cy="12" r="2"></circle><circle fill="#000000" cx="12" cy="12" r="2"></circle><circle fill="#000000" cx="19" cy="12" r="2"></circle></g></svg></div><div class="dropdown-menu dropdown-menu-end">';

                // Edit button
                if (hasPermission('QUOTATION_UPDATE')) {
                    actionHtml += '<a class="dropdown-item" href="javascript:void(0)" id="rt" onclick="edit_quotation('+data['quotation_id']+')">Edit</a>';
                }

                // Edit itinireary button
                if (hasPermission('QUOTATION_UPDATE_ITINERARY')) {
                    actionHtml += '<a class="dropdown-item" href="javascript:void(0)" id="rt" onclick="update_itinerary('+data['quotation_id']+')">Edit Itinerary</a>';
                }

                // Change status button
                // if (hasPermission('QUOTATION_CHANGE_STATUS')) {
                //     actionHtml += '<a class="dropdown-item" href="javascript:void(0)" id="rt" onclick="change_status('+data['quotation_id']+')">Change status</a>';
                // }

                // Quotation preview button
                if (hasPermission('QUOTATION_PREVIEW')) {
                    actionHtml += '<a class="dropdown-item" target="_blank" href="<?php echo base_url();?>index.php/Quotation/quotation_preview/'+data['quotation_id']+'" >Preview</a>';
                }

                // Quotation hub button
                if (hasPermission('QUOTATION_HUB')) {

                    actionHtml += '<a class="dropdown-item" target="_blank" href="<?php echo base_url();?>index.php/Quotation/quotation_hub/'+data['quotation_id']+'" >Quotation hub</a>';
                }

                // Delete button
                if (hasPermission('QUOTATION_DELETE')) {
                    actionHtml += '<a class="dropdown-item" href="javascript:void(0)" onclick="return delete_quotation('+data['quotation_id']+')">Delete</a>';
                }

                actionHtml += '</div></div>';

                $('td', row).eq(8).html(actionHtml);  
            }
            else if($table.cell(node).data() == '7') {
              $table.cell(node).data('<span class="badge badge-primary">Ready to Trip</span>');

                $('td', row).eq(2).html('<center><a class="dropdown-item" href="javascript:void(0)" id="rt" onclick="view_lead_details('+data['quotation_id']+')">'+data['leads_number']+'</a></center>');

                let actionHtml7 = '<div class="dropdown ms-auto text-end"><div class="btn-link" data-bs-toggle="dropdown"><svg width="24px" height="24px" viewBox="0 0 24 24" version="1.1"><g stroke="none" stroke-width="1" fill="none" fill-rule="evenodd"><rect x="0" y="0" width="24" height="24"></rect><circle fill="#000000" cx="5" cy="12" r="2"></circle><circle fill="#000000" cx="12" cy="12" r="2"></circle><circle fill="#000000" cx="19" cy="12" r="2"></circle></g></svg></div><div class="dropdown-menu dropdown-menu-end">';

                if (hasPermission('QUOTATION_PREVIEW')) {
                    actionHtml7 += '<a class="dropdown-item" target="_blank" href="<?php echo base_url();?>index.php/Quotation/quotation_preview/'+data['quotation_id']+'" >Preview</a>';
                }
                if (hasPermission('QUOTATION_HUB')) {
                    actionHtml7 += '<a class="dropdown-item" target="_blank" href="<?php echo base_url();?>index.php/Quotation/quotation_hub/'+data['quotation_id']+'" >Quotation hub</a>';
                }
                if (hasPermission('QUOTATION_DELETE')) {
                    actionHtml7 += '<a class="dropdown-item" href="javascript:void(0)" onclick="return delete_quotation('+data['quotation_id']+')">Delete</a>';
                }

                actionHtml7 += '</div></div>';
                $('td', row).eq(8).html(actionHtml7);
            }
            else if($table.cell(node).data() == '6') {
            // else if(data['quotation_current_status'] == 6){
              $table.cell(node).data('<span class="badge badge-danger">Cancelled</span>');
            //   $('td', row).eq(9).html('<div class="dropdown ms-auto text-end"><div class="btn-link" data-bs-toggle="dropdown"><svg width="24px" height="24px" viewBox="0 0 24 24" version="1.1"><g stroke="none" stroke-width="1" fill="none" fill-rule="evenodd"><rect x="0" y="0" width="24" height="24"></rect><circle fill="#000000" cx="5" cy="12" r="2"></circle><circle fill="#000000" cx="12" cy="12" r="2"></circle><circle fill="#000000" cx="19" cy="12" r="2"></circle></g></svg></div><div class="dropdown-menu dropdown-menu-end"><a class="dropdown-item" href="javascript:void(0)" onclick="return delete_quotation('+data['quotation_id']+')">Delete</a></div></div>');

                $('td', row).eq(2).html('<center><a class="dropdown-item" href="javascript:void(0)" id="rt" onclick="view_lead_details('+data['quotation_id']+')">'+data['leads_number']+'</a></center>');

                let actionHtml = '<div class="dropdown ms-auto text-end"><div class="btn-link" data-bs-toggle="dropdown"><svg width="24px" height="24px" viewBox="0 0 24 24" version="1.1"><g stroke="none" stroke-width="1" fill="none" fill-rule="evenodd"><rect x="0" y="0" width="24" height="24"></rect><circle fill="#000000" cx="5" cy="12" r="2"></circle><circle fill="#000000" cx="12" cy="12" r="2"></circle><circle fill="#000000" cx="19" cy="12" r="2"></circle></g></svg></div><div class="dropdown-menu dropdown-menu-end">';

               

                // Quotation preview button
                if (hasPermission('QUOTATION_PREVIEW')) {
                    actionHtml += '<a class="dropdown-item" target="_blank" href="<?php echo base_url();?>index.php/Quotation/quotation_preview/'+data['quotation_id']+'" >Preview</a>';
                }

                // Quotation hub button
                if (hasPermission('QUOTATION_HUB')) {

                    actionHtml += '<a class="dropdown-item" target="_blank" href="<?php echo base_url();?>index.php/Quotation/quotation_hub/'+data['quotation_id']+'" >Quotation hub</a>';
                }

                // Delete button
                if (hasPermission('QUOTATION_DELETE')) {
                    actionHtml += '<a class="dropdown-item" href="javascript:void(0)" onclick="return delete_quotation('+data['quotation_id']+')">Delete</a>';
                }

                actionHtml += '</div></div>';

                $('td', row).eq(8).html(actionHtml);
            }
            });

            $('td', row).eq(2).html('<center><a href="javascript:void(0)" class="text-primary" onclick="view_lead_details('+data['quotation_id']+')">'+data['leads_number']+' ('+data['guest_name']+')</a></center>')
            // <a class="dropdown-item" href="javascript:void(0)" id="rt" onclick="convert_trip('+data['quotation_id']+')">Convert to trips</a>
           },

           "drawCallback": function( settings ) {
                // displaySelectByUserType();
            },

        "columns": [
            { "data": "quotation_status", "orderable": false },
            { "data": "quotation_number", "orderable": false },
            { "data": "leads_number", "orderable": false },
            { "data": "packages_title", "orderable": false },
            { "data": "quotation_date", "orderable": false },
            { "data": "quotation_remarks", "orderable": false },
            { "data": "quotation_current_status", "orderable": false },
            { "data": "quotation_created_by_username", "orderable": false },                      
            { "data": "quotation_id", "orderable": false }
            
            
        ]
        
    });
    
  

  });
    
 
////***Listing table*****///

    

////***For close the modal *****///
function Quotationmodalclose()
{

    $('#QuotationModal').modal('hide');
   
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
$('#QuotationModal').on('shown.bs.modal', function () {
    // $("#state_id_fk").select2('open');
    // $('#transporter_name').focus();
    var id = $("#id").val();
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
    

<?php include(APPPATH . 'views/Quotation/quotation_modal_script.php'); ?>

function add_quotation()
{ 
    save_method = 'add';

    resetQuotationModalForm();

    $("#id").val('');
    $('#form')[0].reset();

    $('.form-group').removeClass('input-warning-o');
    $('.help-block').empty();

    $('#leadPackageRow').removeClass('d-none');

   $('#leads_id').prop('disabled', false).data('filter-mode', 'add_quotation');

$('#leads_id').val('').trigger('change.select2');

$('#template_name_display').text('');
$('#packages_id_fk').val('');
$('#packages_id_hidden').val('');

$('#leads_id_hidden').val('');

    // âœ… clear option blocks/details
    $('#optionsContainer').empty();
    $('.optionBlock').remove();

    if (typeof optionCount !== 'undefined') {
        optionCount = 0;
    }

    // âœ… clear inclusion/special boxes
    $('#quotation_property_inclusion_type').prop('checked', false);
    $('#quotation_special_requirement_type').prop('checked', false);
    $('#inclusionBox').hide();
    $('#specialReqBox').hide();

    // Date
    var today = new Date();
    var dd = String(today.getDate()).padStart(2, '0');
    var mm = String(today.getMonth() + 1).padStart(2, '0');
    var yyyy = today.getFullYear();

    $('#quotation_date').val(dd + '-' + mm + '-' + yyyy);

    $('#QuotationModal').modal('show');
    $('#QuotationModal .modal-title').text('Add Quotation Details');
    $('#btnSave').text('Save');

    bindAddOptionBtnOnce();
    toggleAddOptionBtn();
}

// When lead is selected in add form, fetch template info
$(document).on('change', '#leads_id', function () {
    var leadId = $(this).val();
    if (!leadId) {
        $('#template_name_display').text('');
        $('#packages_id_fk').val('');
        $('#packages_id_hidden').val('');
        return;
    }
    $.ajax({
        url: "<?php echo base_url('index.php/Leads/ajax_edit/'); ?>" + leadId,
        type: "GET",
        dataType: "JSON",
        success: function (res) {
            var packageId = res && res.package_id_fk ? res.package_id_fk : '';
            $('#packages_id_hidden').val(packageId);
            $('#packages_id_fk').val(packageId);
            $('#template_name_display').text(res.packages_title || '');
            toggleAddOptionBtn();
        },
        error: function () {
            $('#template_name_display').text('');
            $('#packages_id_fk').val('');
            $('#packages_id_hidden').val('');
            toggleAddOptionBtn();
        }
    });
});

$('#QuotationModal').on('hidden.bs.modal', function () {
    resetQuotationModalForm();
});
////***For open modal of quotation adding form  *****///

///***For update the quotation itinerary details from adding modal form *****///

function clearValidationErrors() {
  $('.is-invalid').removeClass('is-invalid');
  $('.js-err').remove();
}
function isEmpty(val) {
  return val === null || val === undefined || String(val).trim() === '';
}

function setInvalid($el, msg) {
  $el.addClass('is-invalid');

  // put message after input/select/textarea
  const $msg = $('<div class="text-danger small js-err mt-1"></div>').text(msg);

  // if element already has a message, replace it
  if ($el.next('.js-err').length) {
    $el.next('.js-err').replaceWith($msg);
  } else {
    $el.after($msg);
  }
}

function scrollToFirstError() {
  const $first = $('.is-invalid').first();
  if ($first.length) {
    $('html, body').animate({ scrollTop: $first.offset().top - 120 }, 300);
  }
}



function validateQuoteItineraryForm() {

  clearValidationErrors();
  syncDayEditorsToTextarea();

    $('.ck-editor').css('border', '');
    $('textarea.day-editor').css('border', '');
  let ok = true;

  /* ==========================================================
     1) MAIN REQUIRED FIELDS
     ========================================================== */
  const $qtnTitle   = $('[name="quotation_title"]');
  
    $('#itinerary tr').each(function () {
        const $tr = $(this);
        const rowNum = $tr.data('row-num') || '';
        const $desc = $tr.find('textarea.day-editor');

        if (!$desc.length) return;

        const value = ($desc.val() || '').trim();

        if (value === '' || value === '<p>&nbsp;</p>' || value === '<p></p>') {
            ok = false;

            alert('Day ' + rowNum + ' description is required');

            $('html, body').animate({
                scrollTop: $tr.offset().top - 120
            }, 300);

            const $editorBox = $tr.find('.ck-editor');
            if ($editorBox.length) {
                $editorBox.css('border', '1px solid #dc3545');
            } else {
                $desc.css('border', '1px solid #dc3545');
            }

            return false;
        }
    });
    
  if (isEmpty($qtnTitle.val())) { ok = false; setInvalid($qtnTitle, 'Template title is required'); }

  /* ==========================================================
     2-3) INCLUSIONS / EXCLUSIONS
     checkbox checked -> must have at least 1 textarea in each
     and none can be empty
     ========================================================== */
  const $incChk = $('#quotation_inclusion_exclusion_checked_type');
  if ($incChk.is(':checked')) {

    const $incAreas = $('#inclusion textarea');
    const $excAreas = $('#exclusion textarea');

    // Must open at least one in each OR loaded from dropdown
    if ($incAreas.length === 0) {
      ok = false;
      setInvalid($('#packages_inclusion_exclusion_common_id_fk'), 'Add at least one Inclusion (use +Add new or select a title)');
    }
    if ($excAreas.length === 0) {
      ok = false;
      setInvalid($('#quotation_inclusion_exclusion_common_id_fk'), 'Add at least one Exclusion (use +Add new or select a title)');
    }

    // Required: any textarea empty => invalid
    $incAreas.each(function () {
      if (isEmpty($(this).val())) { ok = false; setInvalid($(this), 'Inclusion cannot be empty'); }
    });
    $excAreas.each(function () {
      if (isEmpty($(this).val())) { ok = false; setInvalid($(this), 'Exclusion cannot be empty'); }
    });
  }

  /* ==========================================================
     4-5) OPTIONAL ADD ON
     checkbox checked -> must have at least 1 textarea
     and none can be empty
     ========================================================== */
  const $optChk = $('#quotation_optional_add_on_checked_type');
  if ($optChk.is(':checked')) {

    // change selector below if your container id differs
    const $optAreas = $('#optional-addon textarea[name="quotation_optional_add_on_details[]"], #optional-addon textarea');

    if ($optAreas.length === 0) {
      ok = false;
      setInvalid($optChk, 'Add at least one Optional add on');
    }

    $optAreas.each(function () {
      if (isEmpty($(this).val())) { ok = false; setInvalid($(this), 'Optional add on cannot be empty'); }
    });
  }

  /* ==========================================================
     6-7) SPECIAL REQUIREMENT
     checkbox checked -> must have at least 1 row
     validate select + amount (both required)
     ========================================================== */
  // const $spChk = $('#packages_special_requirment_checked_type');
  // if ($spChk.is(':checked')) {

  //   const $spRows = $('#special-requirments .special-row');
  //   if ($spRows.length === 0) {
  //     ok = false;
  //     setInvalid($spChk, 'Add at least one Special requirement');
  //   }

  //   // validate each row
  //   $spRows.each(function () {
  //     const $sel = $(this).find('select[name="special_requirements_id_fk[]"]');
  //     const $amt = $(this).find('input[name="packages_special_requirements_cost[]"]');

  //     if ($sel.length && isEmpty($sel.val())) { ok = false; setInvalid($sel, 'Select a special requirement'); }
  //     if ($amt.length && isEmpty($amt.val())) { ok = false; setInvalid($amt, 'Amount is required'); }
  //   });
  // }

  /* ==========================================================
     8-9) PAYMENT POLICIES
     checkbox checked -> must have at least 1 textarea
     and none empty
     ========================================================== */
  const $payChk = $('#quotation_payment_policies_checked_type');
  if ($payChk.is(':checked')) {

    // container: #payment-policies
    const $payAreas = $('#payment-policies textarea');

    if ($payAreas.length === 0) {
      ok = false;
      setInvalid($('#quotation_policies_id_fk'), 'Add at least one Payment policy item (+Add new or select a title)');
    }

    $payAreas.each(function () {
      if (isEmpty($(this).val())) { ok = false; setInvalid($(this), 'Payment policy cannot be empty'); }
    });
  }

  /* ==========================================================
     10-11) TERMS & CONDITIONS
     checkbox checked -> must have at least 1 textarea
     and none empty
     ========================================================== */
  const $tcChk = $('#quotation_terms_conditions_checked_type');
  if ($tcChk.is(':checked')) {

    const $tcAreas = $('#terms-conditions textarea');

    if ($tcAreas.length === 0) {
      ok = false;
      setInvalid($('#quotation_terms_condition_id_fk'), 'Add at least one Terms & condition item (+Add new or select a title)');
    }

    $tcAreas.each(function () {
      if (isEmpty($(this).val())) { ok = false; setInvalid($(this), 'Terms & condition cannot be empty'); }
    });
  }

  /* ==========================================================
     12-13) CANCELLATION POLICY
     checkbox checked -> must have at least 1 textarea
     and none empty
     ========================================================== */
  const $canChk = $('#quotation_cancellation_policy_checked_type');
  if ($canChk.is(':checked')) {

    const $canAreas = $('#cancellation-policy textarea');

    if ($canAreas.length === 0) {
      ok = false;
      setInvalid($('#quotation_cancellation_policies_id_fk'), 'Add at least one Cancellation policy item (+Add new or select a title)');
    }

    $canAreas.each(function () {
      if (isEmpty($(this).val())) { ok = false; setInvalid($(this), 'Cancellation policy cannot be empty'); }
    });
  }

  /* ==========================================================
     14-15) NOTES
     checkbox checked -> must have at least 1 textarea
     and none empty
     ========================================================== */
  const $notesChk = $('#quotation_notes_checked_type');
  if ($notesChk.is(':checked')) {

    const $noteAreas = $('#add_notes textarea');

    if ($noteAreas.length === 0) {
      ok = false;
      setInvalid($notesChk, 'Add at least one Note');
    }

    $noteAreas.each(function () {
      if (isEmpty($(this).val())) { ok = false; setInvalid($(this), 'Note cannot be empty'); }
    });
  }

  if (!ok) scrollToFirstError();
  return ok;
}

function syncDayEditorsToTextarea() {
  if (!window.dayEditors) return;

  Object.keys(window.dayEditors).forEach(function(rowNum){
    const editor = window.dayEditors[rowNum];
    const $tr = $('#itinerary tr[data-row-num="'+rowNum+'"]');
    const $ta = $tr.find('textarea.day-editor');

    if (editor && $ta.length) {
      $ta.val(editor.getData()); // âœ… write editor html into textarea
    }
  });
}

window.dayEditors = {};   // {rowNum: editorInstance}

function save_quote_itinerary() {

  if (!validateQuoteItineraryForm()) {
    return;
  }

  let url = "<?php echo base_url();?>index.php/Quotation/ajax_itinerary_update/";

  $('#btnSave').text('Updating...');
  $('#btnSave').attr('disabled', true);

  syncDayEditorsToTextarea();

  var form = document.getElementById('form2'); // âœ… correct form id
  var data = new FormData(form);

  $.ajax({
    url: url,
    type: "POST",
    data: data,
    dataType: "JSON",
    processData: false,
    contentType: false,
    success: function(res) {

      if (res.status) {
        $('#QuotationitineraryModal').modal('hide'); // âœ… correct modal
        resetQuotationItineraryModal();
        reload_table();
      } else {
        alert(res.message || 'Validation failed');
      }

      $('#btnSave').text('Save');
      $('#btnSave').attr('disabled', false);
    },
    error: function() {
      alert('Error saving data');
      $('#btnSave').text('Save');
      $('#btnSave').attr('disabled', false);
    }
  });
}

// function resetPackageModal() {

//   suppressPropertyClearConfirm = true;

//   const $modal = $('#QuotationitineraryModal');
//   const $form  = $('#form2');

//   $form[0].reset();

//   $modal.find('select').each(function () {
//     if ($(this).hasClass('select2-hidden-accessible')) {
//       $(this).val(null).trigger('change');
//     }
//   });

//   $modal.find('input[type="checkbox"]').prop('checked', false);

//   $('#itinerary').empty();
//   $('#inclusion, #exclusion').empty();
//   $('#inclusionExclusionWrapper').hide();
//   $('#myDiv2, #myDiv3').hide();

//   $('#optional-addon').find('.optional-addon-row').remove();
//   $('#optional-addon').closest('.col-xl-10').hide();

//   $('#payment-policies').find('.payment-row').remove();
//   $('#myDiv4, #myDiv5').hide();

//   $('#terms-conditions').find('.terms-row').remove();
//   $('#myDiv6, #myDiv7').hide();

//   $('#cancellation-policy').find('.cancellation-row').remove();
//   $('#myDiv8, #myDiv9').hide();

//   $('#add_notes').find('.note-row').remove();

// //   $('#property').empty().hide();
// //   $('[onClick="addMore10();"]').closest('.terms_add, .mb-3').hide();

//   $modal.find('.is-invalid, .has-error').removeClass('is-invalid has-error');
//   $modal.find('.help-block').text('');

//   setTimeout(function () {
//     suppressPropertyClearConfirm = false;
//   }, 300);
// }

// function save_quote_itinerary() {

//   if (!validateQuoteItineraryForm()) {
//     return;
//   }

//   let url = "";

// //   if (save_method === 'add') {
// //     url = "<?php echo base_url();?>index.php/Quotation/ajax_add/";
// //     $('#btnSave').text('Saving...');
// //   } else {
//     url = "<?php echo base_url();?>index.php/Quotation/ajax_itinerary_update/";
//     $('#btnSave').text('Updating...');
// //   }

//   $('#btnSave').attr('disabled', true);

//   syncDayEditorsToTextarea();

//   // âœ… prevent confirm popup while saving/resetting
//   suppressPropertyClearConfirm = true;

//   var form = document.getElementById('form2');
//   var data = new FormData(form);

//   $.ajax({
//     url: url,
//     type: "POST",
//     data: data,
//     dataType: "JSON",
//     processData: false,
//     contentType: false,
//     success: function(res) {

//       if (res.status) {
//         $('#QuotationitineraryModal').modal('hide');
//         resetPackageModal();
//         reload_table();
//       } else {
//         alert(res.message || 'Validation failed');
//       }

//       $('#btnSave').text('Save');
//       $('#btnSave').attr('disabled', false);

//       setTimeout(function () {
//         suppressPropertyClearConfirm = false;
//       }, 300);
//     },
//     error: function() {
//       alert('Error saving data');
//       $('#btnSave').text('Save');
//       $('#btnSave').attr('disabled', false);

//       setTimeout(function () {
//         suppressPropertyClearConfirm = false;
//       }, 300);
//     }
//   });
// }

function save_quote_itinerary() {

  if (!validateQuoteItineraryForm()) {
    return;
  }

  let url = "<?php echo base_url();?>index.php/Quotation/ajax_itinerary_update/";

  $('#btnSave').text('Updating...');
  $('#btnSave').attr('disabled', true);

  syncDayEditorsToTextarea();

  var form = document.getElementById('form2'); // âœ… correct form id
  var data = new FormData(form);

  $.ajax({
    url: url,
    type: "POST",
    data: data,
    dataType: "JSON",
    processData: false,
    contentType: false,
    success: function(res) {

      if (res.status) {
        $('#QuotationitineraryModal').modal('hide'); // âœ… correct modal
        resetQuotationItineraryModal();
        reload_table();
      } else {
        alert(res.message || 'Validation failed');
      }

      $('#btnSave').text('Save');
      $('#btnSave').attr('disabled', false);
    },
    error: function() {
      alert('Error saving data');
      $('#btnSave').text('Save');
      $('#btnSave').attr('disabled', false);
    }
  });
}

///***For update the quotation itinerary details from adding modal form *****///

////***For editing update itinerary quotation details from adding modal form  *****///

window.isPropertyPrefill = false;   // prevents change handler from interfering during edit
window.isEditLoading = false;       // you already use this

window.dayEditors = window.dayEditors || {};

window.destroyDayEditors = function () {
  if (!window.dayEditors) window.dayEditors = {};
  Object.keys(window.dayEditors).forEach(function (k) {
    try {
      var ed = window.dayEditors[k];
      if (ed && ed.destroy) ed.destroy();
    } catch (e) {}
  });
  window.dayEditors = {};
};

window.initEditorsForDays = function () {
  window.destroyDayEditors();

  // âœ… wait 1 tick so DOM rows are fully inserted
  setTimeout(function () {
    $('.day-editor').each(function () {
      const textarea = this;
      const rowNum = $(this).closest('tr').data('row-num');

      // If ClassicEditor is not loaded, you will see plain textarea
      if (typeof ClassicEditor === 'undefined') {
        console.error('ClassicEditor not loaded!');
        return;
      }

      ClassicEditor.create(textarea).then(editor => {
        window.dayEditors[rowNum] = editor;
      }).catch(err => console.error(err));
    });
  }, 0);
};

function buildItineraryRowsFromSaved(itineraryDays) {

  const tbody = $('#itinerary');

  destroyDayEditors();     // your existing function
  tbody.empty();

  if (!itineraryDays || !itineraryDays.length) {
    tbody.append(`<tr><td colspan="6" class="text-center text-danger">No saved itinerary days found</td></tr>`);
    return;
  }

  itineraryDays.forEach(function (item, i) {

    const rowNum = i + 1;

    const isTB = (item.quotation_itineraries_days_travel_back === 'TB');

    const tbBadge = isTB
      ? ` <span class="badge bg-warning text-dark ms-2">Travel Back</span>`
      : '';

    // destination name might not exist in your saved table - fallback to ID
    const destName = item.state_name || item.quotation_itineraries_days_destination_id_fk || '';

    // day image preview
    const imgFile = item.quotation_itineraries_days_image || '';
    const imgUrl  = imgFile
      ? `<?php echo base_url('uploads/quotation_day_images/'); ?>${imgFile}`
      : '';

    // const imgHtml = imgUrl
    //   ? `<img src="${imgUrl}" class="day-thumb" alt="Day Image">`
    //   : `<div class="text-muted small">No image</div>`;

    
    const imgHtml = `
  <img src="${imgUrl}" class="day-thumb" alt="Day Image"
       style="max-width:120px; max-height:90px; ${imgUrl ? '' : 'display:none;'}">
  <div class="no-image-text text-muted small" ${imgUrl ? 'style="display:none;"' : ''}>No image</div>
`;

    const requiredStatus = parseInt(item.quotation_itineraries_days_required_status || 0, 10);
    let requiredStatusHtml = '';

    if (isTB) {
      requiredStatusHtml = `
        <div class="mt-2 tb-required-wrap">
          
          <input type="hidden"
                name="quotation_itineraries_days_required_status[]"
                class="tb-required-status"
                value="${requiredStatus === 2 ? 2 : 1}">
        </div>
      `;
    } else {
      requiredStatusHtml = `
        <input type="hidden"
              name="quotation_itineraries_days_required_status[]"
              class="tb-required-status"
              value="0">
      `;
    }
    tbody.append(`
      <tr data-row-num="${rowNum}" data-required-status="${isTB ? (requiredStatus === 2 ? 2 : 1) : 0}">
        <td>
          <div>
            <b>${item.quotation_itineraries_days_day || ('Day ' + rowNum)}</b>
            | ${item.quotation_itineraries_days_title || ''}
            ${tbBadge}
          </div>

          <input type="hidden" name="is_travel_back[]" class="is-travel-back" value="${isTB ? '1' : '0'}">

          <input type="hidden"
                name="quotation_itineraries_days_travel_back[]"
                class="pkg-travel-back"
                value="${isTB ? 'TB' : ''}">

          ${requiredStatusHtml}
        </td>

        <td class="stay-destination-cell">
  <span class="stay-destination-text">${item.state_name || ''}</span>
  <input type="hidden" class="active-destination-id" value="${item.quotation_itineraries_days_destination_id_fk || ''}">
  <input type="hidden" class="active-destination-name" value="${item.state_name || ''}">
</td>

        <td>
          <textarea
            name="quotation_itineraries_days_description[]"
            class="form-control day-editor"
            id="day_editor_${rowNum}"
            rows="6">${item.quotation_itineraries_days_description || ''}</textarea>

          <!-- Needed for saving -->
          <input type="hidden" name="quotation_itinerary_days_id[]" value="${item.quotation_itinerary_days_id || ''}">
          <input type="hidden" name="itineraries_days_id_fk[]" value="${item.itineraries_days_id_fk || ''}">
          <input type="hidden" name="quotation_itineraries_days_day[]" value="${item.quotation_itineraries_days_day || ''}">
          <input type="hidden" name="quotation_itineraries_days_title[]" value="${item.quotation_itineraries_days_title || ''}">

          <!-- IMPORTANT: this is the posted destination array -->
          <input type="hidden"
                 name="quotation_itineraries_days_destination_id_fk[]"
                 class="destination-post"
                 value="${item.quotation_itineraries_days_destination_id_fk || ''}">

          <!-- keep old image if no new upload -->
          <input type="hidden" name="default_itinerary_day_image[]" value="${imgFile}">
        </td>

        <td>
          ${imgHtml}
          <div class="mt-2">
            <input type="file"
                   class="form-control form-control-sm day-image-input"
                   name="quotation_itineraries_days_image_file[]"
                   accept="image/*">
          </div>
        </td>

        

        <td class="position-relative">
          <select class="form-control change_itinerary mb-2" data-row-num="${rowNum}" style="width:100%;" data-loaded="0">
            <option value="">Please Select Itinerary</option>
          </select>

          <select class="form-control change_itinerary_day" data-row-num="${rowNum}" style="width:100%;">
            <option value="">Please Select Days</option>
          </select>

          <div class="day-description-tooltip" id="tooltip_${rowNum}">
            <div class="tooltip-content"></div>
          </div>
        </td>
      </tr>
    `);
  });

  // âœ… Init Select2 AJAX for change_itinerary (loads when dropdown opens)
  $('.change_itinerary').each(function () {
    const $sel = $(this);
    if ($sel.hasClass('select2-hidden-accessible')) {
      $sel.select2('destroy');
    }
    $sel.select2({
      width: '100%',
      placeholder: 'Please Select Itinerary',
      allowClear: true,
      dropdownParent: $('#QuotationitineraryModal'),
      ajax: {
        url: '<?php echo base_url(); ?>index.php/Packages/ajax_filter_change_itineraries',
        dataType: 'json',
        delay: 250,
        data: function(params) { return { q: params.term }; },
        processResults: function(data) { return data; },
        cache: true
      }
    });
  });

  $('.change_itinerary_day').select2({ width: '100%', dropdownParent: $('#QuotationitineraryModal') });

  // âœ… Init CKEditor
  if (typeof initEditorsForDays === 'function') initEditorsForDays();

}



// loadRowWiseItineraries removed â€” .change_itinerary now uses Select2 AJAX

window.loadItinerariesByCategoryDuration = function(done){

  const $duration  = $('#packages_duration_in_nights');
  const $cat       = $('#packages_itinerary_category_id_fk');
  const $itinerary = $('#packages_itinerary_id_fk');

  const nights = $.trim($duration.val());
  const catId  = $.trim($cat.val());

  $itinerary.html('<option value="">Please Select itinerary</option>');

  if (!catId || !nights) {
    if ($itinerary.hasClass('select2-hidden-accessible')) $itinerary.trigger('change.select2');
    if (typeof done === 'function') done(false);
    return;
  }

  $itinerary.html('<option value="">Loading...</option>');
  if ($itinerary.hasClass('select2-hidden-accessible')) $itinerary.trigger('change.select2');

  $.ajax({
    url: '<?php echo base_url(); ?>index.php/Packages/fetch_itinerary_under_category', // âœ… correct
    type: 'POST',
    data: {
      packages_itinerary_category_id_fk: catId,     // âœ… correct
      packages_duration_in_nights: nights           // âœ… correct
    },
    success: function(html){
      $itinerary.html(html);

      // refresh select2
      if ($itinerary.hasClass('select2-hidden-accessible')) {
        $itinerary.trigger('change.select2');
      } else {
        $itinerary.trigger('change');
      }

      if (typeof done === 'function') done(true);
    },
    error: function(){
      $itinerary.html('<option value="">Please Select itinerary</option>');
      if ($itinerary.hasClass('select2-hidden-accessible')) $itinerary.trigger('change.select2');
      if (typeof done === 'function') done(false);
    }
  });
};

$(document).on('change', '.tb-required-checkbox', function () {
  var $itineraryRow = $(this).closest('tr');
  var val = $(this).is(':checked') ? '1' : '2';

  $itineraryRow.find('.tb-required-status').val(val);
  $itineraryRow.attr('data-required-status', val);

  var dayId = String($itineraryRow.find('input[name="itineraries_days_id_fk[]"]').val() || '');
  if (!dayId) return;

  $('#property .day-row[data-day-id="' + dayId + '"]').each(function(){
    $(this).attr('data-required-status', val);

    $(this).find('.assignment-row').each(function(){
      var $propSel = $(this).find('.property-select');
      var $roomSel = $(this).find('.rooms-select');

      if (val === '1') {
        $propSel.attr('required', 'required');
        $roomSel.attr('required', 'required');
      } else {
        $propSel.removeAttr('required');
        $roomSel.removeAttr('required');
      }
    });
  });
});

////***For loading itiniraries in dropdown under duration nights and load days based on itineray and display details in tooltip *****///



$('#quotation_first_cover_page').on('change', function(){
    const file = this.files[0];
    if(file){
        const url = URL.createObjectURL(file);
        $('#first_cover_preview').html('<img src="'+url+'" style="width:120px;">');
    }
});

$('#quotation_last_cover_page').on('change', function(){
    const file = this.files[0];
    if(file){
        const url = URL.createObjectURL(file);
        $('#last_cover_preview').html('<img src="'+url+'" style="width:120px;">');
    }
});

// Allowed extensions
const allowedImageExt = ['jpg', 'jpeg', 'png'];

$(document).on('change', '.day-image-input', function () {

  const file = this.files[0];
  if (!file) return;

  const fileName = file.name.toLowerCase();
  const extension = fileName.split('.').pop();

  if ($.inArray(extension, allowedImageExt) === -1) {

    alert('Only JPG, JPEG and PNG files are allowed.');

    // Clear invalid file
    $(this).val('');

    return false;
  }
});

$(document).on('change', '.day-image-input', function () {

    const file = this.files && this.files[0] ? this.files[0] : null;

    // âœ… get row number from input
    const rowNum = $(this).data('row-num');

    // âœ… find exact row using rowNum (same as your editor sync)
    const $tr = $('#itinerary tr[data-row-num="' + rowNum + '"]');

    const $img = $tr.find('.day-thumb');

    if ($img.length === 0) {
        console.warn('day-thumb not found for row:', rowNum);
        return;
    }

    // âŒ if no file (cancel)
    if (!file) {
        $img.attr('src', '').hide();
        return;
    }

    // âŒ validate image
    if (!file.type.startsWith('image/')) {
        alert('Please select a valid image');
        $(this).val('');
        return;
    }

    // âœ… preview
    const reader = new FileReader();

    reader.onload = function (e) {
        $img
            .attr('src', e.target.result)
            .show();
    };

    reader.readAsDataURL(file);
});

// $(document).on('change', '.day-image-input', function(){
//   var file = this.files && this.files[0] ? this.files[0] : null;
//   var $row = $(this).closest('.day-row');
//   var $img = $row.find('.day-thumb');

//   if (!file) { $img.hide().attr('src',''); return; }

//   var reader = new FileReader();
//   reader.onload = function(e){
//     $img.attr('src', e.target.result).show();
//   };
//   reader.readAsDataURL(file);
// });

$(document).on('change', '.day-image-input', function () {
    var file = this.files && this.files[0] ? this.files[0] : null;
    var $tr = $(this).closest('tr');
    var $img = $tr.find('.day-thumb');
    var $noImg = $tr.find('.no-image-text');

    if (!$img.length) {
        console.log('day-thumb not found');
        return;
    }

    if (!file) {
        $img.attr('src', '').hide();
        $noImg.show();
        return;
    }

    if (!file.type.match(/^image\//)) {
        alert('Please select a valid image');
        $(this).val('');
        return;
    }

    var reader = new FileReader();
    reader.onload = function (e) {
        $img.attr('src', e.target.result).show();
        $noImg.hide();
    };
    reader.readAsDataURL(file);
});

function update_itinerary(id) {
    $('#form')[0].reset();
    $('.form-group').removeClass('input-warning-o');
    $('.help-block').empty();

    // clear existing dynamic content
    $('#itinerary').empty();
    $('#inclusion').empty();
    $('#exclusion').empty();
    $('#optional-addon').find('.optional-addon-row').remove();
    $('#payment-policies').find('.payment-row').remove();
    $('#terms-conditions').find('.terms-row').remove();
    $('#cancellation-policy').find('.cancellation-row').remove();
    $('#add_notes').find('.note-row').remove();

    $.ajax({
        url: "<?php echo base_url();?>index.php/Quotation/ajax_edit_itinerary/" + id,
        type: "GET",
        dataType: "JSON",
        success: function(res) {
            if (!res.status) {
                alert(res.message || 'Failed to load quotation itinerary');
                return;
            }

            const p = res.quotation_itinerary || {};

            // Init Select2 AJAX for policy dropdowns before showing modal
            initQuotationItineraryModalSelect2();

            $('#QuotationitineraryModal').modal('show');
            $('#quotations_id').val(p.quotation_id || '');
            $('#btnSave').text('Update');
            $('#QuotationitineraryModal .modal-title').text('Update Quotation Itinerary');

            $('#quotation_title').val(p.quotation_title || '');

            // cover previews
            if (p.quotation_first_cover_page) {
                $('#quotation_first_cover_page_txt').val(p.quotation_first_cover_page);
                $('#first_cover_preview').html(
                    '<img src="<?php echo base_url("uploads/quotation_cover/"); ?>' +
                    p.quotation_first_cover_page +
                    '" style="width:120px;border:1px solid #ddd;padding:3px;">'
                );
                $('#quotation_first_cover_page').prop('required', false);
            } else {
                $('#quotation_first_cover_page_txt').val('');
                $('#first_cover_preview').html('');
                $('#quotation_first_cover_page').prop('required', true);
            }

            if (p.quotation_last_cover_page) {
                $('#quotation_last_cover_page_txt').val(p.quotation_last_cover_page);
                $('#last_cover_preview').html(
                    '<img src="<?php echo base_url("uploads/quotation_cover/"); ?>' +
                    p.quotation_last_cover_page +
                    '" style="width:120px;border:1px solid #ddd;padding:3px;">'
                );
                $('#quotation_last_cover_page').prop('required', false);
            } else {
                $('#quotation_last_cover_page_txt').val('');
                $('#last_cover_preview').html('');
                $('#quotation_last_cover_page').prop('required', true);
            }

            window.isEditLoading = true;

            // build saved itinerary rows directly
            buildItineraryRowsFromSaved(res.itinerary_days || []);

            window.isEditLoading = false;

            // inclusion / exclusion
            if (p.quotation_inclusion_exclusion_checked_type === 'Y') {
                $('#quotation_inclusion_exclusion_checked_type').prop('checked', true).trigger('change');
                select2AjaxSetSelected(
                    '#quotation_inclusion_exclusion_common_id_fk',
                    p.quotation_inclusion_exclusion_common_id_fk || '',
                    p.inclusion_exclusion_common_title || ''
                );

                setTimeout(function () {
                    $('#inclusion').empty();
                    $('#exclusion').empty();

                    (res.inclusions || []).forEach(function (row) {
                        $('#inclusion').append(`
                            <div class="d-flex gap-2 mb-2 inclusion-row align-items-start">
                                <textarea class="form-control" name="quotation_inclusions_details[]" rows="3">${row.quotation_inclusions_details || ''}</textarea>
                                <button type="button" class="btn btn-sm btn-danger remove-row"><b>X</b></button>
                            </div>
                        `);
                    });

                    (res.exclusions || []).forEach(function (row) {
                        $('#exclusion').append(`
                            <div class="d-flex gap-2 mb-2 exclusion-row align-items-start">
                                <textarea class="form-control" name="quotation_exclusions_details[]" rows="3">${row.quotation_exclusions_details || ''}</textarea>
                                <button type="button" class="btn btn-sm btn-danger remove-row"><b>X</b></button>
                            </div>
                        `);
                    });
                }, 200);
            } else {
                $('#quotation_inclusion_exclusion_checked_type').prop('checked', false).trigger('change');
            }

            if (p.quotation_optional_add_on_checked_type === 'Y') {
                $('#quotation_optional_add_on_checked_type').prop('checked', true).trigger('change');

                (res.optional_addons || []).forEach(function (r) {
                    $('#optional-addon').find('.mb-3.col-md-6').first().before(`
                        <div class="d-flex gap-2 mb-2 optional-addon-row align-items-start">
                            <textarea name="quotation_optional_add_on_details[]" class="form-control" rows="3">${r.quotation_optional_add_on_details || ''}</textarea>
                            <button type="button" class="btn btn-sm btn-danger remove-optional-addon"><b>X</b></button>
                        </div>
                    `);
                });
            } else {
                $('#quotation_optional_add_on_checked_type').prop('checked', false).trigger('change');
            }

            if (p.quotation_payment_policies_checked_type === 'Y') {
                $('#quotation_payment_policies_checked_type').prop('checked', true).trigger('change');
                select2AjaxSetSelected(
                    '#quotation_policies_id_fk',
                    p.quotation_policies_id_fk || '',
                    p.payment_policies_name || ''
                );

                setTimeout(function () {
                    $('#payment-policies').find('.payment-row').remove();
                    (res.payment_policies || []).forEach(function (r) {
                        $('#payment-policies').find('.payment_add').first().before(`
                            <div class="d-flex gap-2 mb-2 payment-row align-items-start">
                                <textarea class="form-control" name="quotation_payment_policies_details[]" rows="3">${r.quotation_payment_policies_details || ''}</textarea>
                                <button type="button" class="btn btn-sm btn-danger remove-payment"><b>X</b></button>
                            </div>
                        `);
                    });
                }, 200);
            } else {
                $('#quotation_payment_policies_checked_type').prop('checked', false).trigger('change');
            }

            if (p.quotation_terms_conditions_checked_type === 'Y') {
                $('#quotation_terms_conditions_checked_type').prop('checked', true).trigger('change');
                select2AjaxSetSelected(
                    '#quotation_terms_condition_id_fk',
                    p.quotation_terms_condition_id_fk || '',
                    p.terms_condition_name || ''
                );

                setTimeout(function () {
                    $('#terms-conditions').find('.terms-row').remove();
                    (res.terms || []).forEach(function (r) {
                        $('#terms-conditions').find('.terms_add').first().before(`
                            <div class="d-flex gap-2 mb-2 terms-row align-items-start">
                                <textarea class="form-control" name="quotation_terms_condition_details[]" rows="3">${r.quotation_terms_condition_details || ''}</textarea>
                                <button type="button" class="btn btn-sm btn-danger remove-terms"><b>X</b></button>
                            </div>
                        `);
                    });
                }, 200);
            } else {
                $('#quotation_terms_conditions_checked_type').prop('checked', false).trigger('change');
            }

            if (p.quotation_cancellation_policy_checked_type === 'Y') {
                $('#quotation_cancellation_policy_checked_type').prop('checked', true).trigger('change');
                select2AjaxSetSelected(
                    '#quotation_cancellation_policies_id_fk',
                    p.quotation_cancellation_policies_id_fk || '',
                    p.cancellation_policies_name || ''
                );

                setTimeout(function () {
                    $('#cancellation-policy').find('.cancellation-row').remove();
                    (res.cancellation || []).forEach(function (r) {
                        $('#cancellation-policy').find('.terms_add').first().before(`
                            <div class="d-flex gap-2 mb-2 cancellation-row align-items-start">
                                <textarea class="form-control" name="quotation_cancellation_policies_details[]" rows="3">${r.quotation_cancellation_policies_details || ''}</textarea>
                                <button type="button" class="btn btn-sm btn-danger remove-cancellation"><b>X</b></button>
                            </div>
                        `);
                    });
                }, 200);
            } else {
                $('#quotation_cancellation_policy_checked_type').prop('checked', false).trigger('change');
            }

            if (p.quotation_notes_checked_type === 'Y') {
                $('#quotation_notes_checked_type').prop('checked', true).trigger('change');

                (res.notes || []).forEach(function (r) {
                    $('#add_notes').find('.mb-3.col-md-6').first().before(`
                        <div class="d-flex gap-2 mb-2 note-row align-items-start">
                            <textarea class="form-control" name="quotation_notes_details[]" rows="3">${r.quotation_notes_details || ''}</textarea>
                            <button type="button" class="btn btn-sm btn-danger remove-note"><b>X</b></button>
                        </div>
                    `);
                });
            } else {
                $('#quotation_notes_checked_type').prop('checked', false).trigger('change');
            }
        },
        error: function () {
            alert('Error get data from ajax');
        }
    });
}

// function update_itinerary(id){

//     //  mode = mode || 'update';
//     // window.save_method = (mode === 'duplicate') ? 'add' : 'update';

//     // always reset first for stable edit load
//     // resetPackageModal();

//     $('#form')[0].reset(); // reset form on modals
//     $('.form-group').removeClass('input-warning-o'); // clear error class
//     $('.help-block').empty(); // clear error string

//     //Ajax Load data from ajax
//     $.ajax({
//         url : "<?php echo base_url();?>index.php/Quotation/ajax_edit/" + id,
//         type: "GET",
//         dataType: "JSON",
//         success: function(res)
//         {
//             if (!res.status) {
//                 alert(res.message || 'Failed to load package');
//                 return;
//             }

//             const p = res.quotation_itinerary || {};

//             $('#QuotationitineraryModal').modal('show');

          
//                 $('#quotations_id').val(p.quotation_id);
//                 $('#btnSave').text('Update');
//                 $('#QuotationitineraryModal .modal-title').text('Edit Quotation Itinerary');
            
            
//             // master fields
//             $('#quotation_title').val(p.quotation_title || '');

//             // cover previews
//             if (p.quotation_first_cover_page) {
//                 $('#quotation_first_cover_page_txt').val(p.quotation_first_cover_page);
//                 $('#first_cover_preview').html(
//                 '<img src="<?php echo base_url("uploads/quotation_cover/"); ?>' +
//                 p.quotation_first_cover_page +
//                 '" style="width:120px;border:1px solid #ddd;padding:3px;">'
//                 );
//                 $('#quotation_first_cover_page').prop('required', false);
//             } else {
//                 $('#quotation_first_cover_page_txt').val('');
//                 $('#first_cover_preview').html('');
//                 $('#quotation_first_cover_page').prop('required', true);
//             }

//             if (p.quotation_last_cover_page) {
//                 $('#quotation_last_cover_page_txt').val(p.quotation_last_cover_page);
//                 $('#last_cover_preview').html(
//                 '<img src="<?php echo base_url("uploads/quotation_cover/"); ?>' +
//                 p.quotation_last_cover_page +
//                 '" style="width:120px;border:1px solid #ddd;padding:3px;">'
//                 );
//                 $('#quotation_last_cover_page').prop('required', false);
//             } else {
//                 $('#quotation_last_cover_page_txt').val('');
//                 $('#last_cover_preview').html('');
//                 $('#quotation_last_cover_page').prop('required', true);
//             }

//             window.isEditLoading = true;
//             // window.isPropertyPrefill = true;
//             // window.pendingPropertyOpen = false;

        
//             // load itinerary dropdown options based on category + duration
//             loadItinerariesByCategoryDuration(function(ok){

//                 if (!ok) {
//                 window.isEditLoading = false;
//                 // window.isPropertyPrefill = false;
//                 alert('Failed to load itinerary list');
//                 return;
//                 }

//                 // set itinerary dropdown AFTER options are loaded
//                 $('#quotation_itinerary_id_fk').val(String(p.quotation_itinerary_id_fk || ''));

//                 if ($('#quotation_itinerary_id_fk').hasClass('select2-hidden-accessible')) {
//                 $('#quotation_itinerary_id_fk').trigger('change.select2');
//                 }

//                 // DO NOT trigger normal change here during edit
//                 // build rows directly from saved data
//                 buildItineraryRowsFromSaved(res.itinerary_days || []);

//                 // now build property block only after itinerary rows exist
//                 setTimeout(function () {

//                 // if (p.packages_property_checked_type === 'Y') {
//                 //     $('#packages_property_type').prop('checked', true);
//                 //     $('input[name="packages_property_checked_type"]').val('Y');
//                 //     buildSavedPropertyUI(res.property_data || []);
//                 // }

//                 window.isEditLoading = false;

//                 }, 300);
//             });

//             // inclusion / exclusion
//             if (p.quotation_inclusion_exclusion_checked_type === 'Y') {
//                 $('#quotation_inclusion_exclusion_checked_type').prop('checked', true).trigger('change');
//                 $('#quotation_inclusion_exclusion_common_id_fk').val(p.quotation_inclusion_exclusion_common_id_fk || '').trigger('change');

//                 setTimeout(function () {
//                 $('#inclusion').empty();
//                 $('#exclusion').empty();

//                 (res.inclusions || []).forEach(function (row) {
//                     $('#inclusion').append(`
//                     <div class="d-flex gap-2 mb-2 inclusion-row align-items-start">
//                         <textarea class="form-control" name="quotation_inclusions_details[]" rows="3">${row.quotation_inclusions_details || ''}</textarea>
//                         <button type="button" class="btn btn-sm btn-danger remove-row"><b>X</b></button>
//                     </div>
//                     `);
//                 });

//                 (res.exclusions || []).forEach(function (row) {
//                     $('#exclusion').append(`
//                     <div class="d-flex gap-2 mb-2 exclusion-row align-items-start">
//                         <textarea class="form-control" name="quotation_exclusions_details[]" rows="3">${row.quotation_exclusions_details || ''}</textarea>
//                         <button type="button" class="btn btn-sm btn-danger remove-row"><b>X</b></button>
//                     </div>
//                     `);
//                 });
//                 }, 300);
//             }

//             if (p.quotation_optional_add_on_checked_type === 'Y') {
//                 $('#quotation_optional_add_on_checked_type').prop('checked', true).trigger('change');
//                 const $box = $('#optional-addon');
//                 $box.find('.optional-addon-row').remove();

//                 (res.optional_addons || []).forEach(function (r) {
//                 $box.find('.mb-3.col-md-6').first().before(`
//                     <div class="d-flex gap-2 mb-2 optional-addon-row align-items-start">
//                     <textarea name="quotation_optional_add_on_details[]" class="form-control" rows="3">${r.quotation_optional_add_on_details || ''}</textarea>
//                     <button type="button" class="btn btn-sm btn-danger remove-optional-addon"><b>X</b></button>
//                     </div>
//                 `);
//                 });
//             }

//             if (p.quotation_payment_policies_checked_type === 'Y') {
//                 $('#quotation_payment_policies_checked_type').prop('checked', true).trigger('change');
//                 $('#quotation_policies_id_fk').val(p.quotation_policies_id_fk || '').trigger('change');

//                 setTimeout(function () {
//                 $('#payment-policies').find('.payment-row').remove();
//                 (res.payment_policies || []).forEach(function (r) {
//                     $('#payment-policies').find('.payment_add').first().before(`
//                     <div class="d-flex gap-2 mb-2 payment-row align-items-start">
//                         <textarea class="form-control" name="quotation_payment_policies_details[]" rows="3">${r.quotation_payment_policies_details || ''}</textarea>
//                         <button type="button" class="btn btn-sm btn-danger remove-payment"><b>X</b></button>
//                     </div>
//                     `);
//                 });
//                 }, 300);
//             }

//             if (p.quotation_terms_conditions_checked_type === 'Y') {
//                 $('#quotation_terms_conditions_checked_type').prop('checked', true).trigger('change');
//                 $('#quotation_terms_condition_id_fk').val(p.quotation_terms_condition_id_fk || '').trigger('change');

//                 setTimeout(function () {
//                 $('#terms-conditions').find('.terms-row').remove();
//                 (res.terms || []).forEach(function (r) {
//                     $('#terms-conditions').find('.terms_add').first().before(`
//                     <div class="d-flex gap-2 mb-2 terms-row align-items-start">
//                         <textarea class="form-control" name="quotation_terms_condition_details[]" rows="3">${r.quotation_terms_condition_details || ''}</textarea>
//                         <button type="button" class="btn btn-sm btn-danger remove-terms"><b>X</b></button>
//                     </div>
//                     `);
//                 });
//                 }, 300);
//             }

//             if (p.quotation_cancellation_policy_checked_type === 'Y') {
//                 $('#quotation_cancellation_policy_checked_type').prop('checked', true).trigger('change');
//                 $('#quotation_cancellation_policies_id_fk').val(p.quotation_cancellation_policies_id_fk || '').trigger('change');

//                 setTimeout(function () {
//                 $('#cancellation-policy').find('.cancellation-row').remove();
//                 (res.cancellation || []).forEach(function (r) {
//                     $('#cancellation-policy').find('.terms_add').first().before(`
//                     <div class="d-flex gap-2 mb-2 cancellation-row align-items-start">
//                         <textarea class="form-control" name="quotation_cancellation_policies_details[]" rows="3">${r.quotation_cancellation_policies_details || ''}</textarea>
//                         <button type="button" class="btn btn-sm btn-danger remove-cancellation"><b>X</b></button>
//                     </div>
//                     `);
//                 });
//                 }, 300);
//             }

//             if (p.quotation_notes_checked_type === 'Y') {
//                 $('#quotation_notes_checked_type').prop('checked', true).trigger('change');
//                 $('#add_notes').find('.note-row').remove();

//                 (res.notes || []).forEach(function (r) {
//                 $('#add_notes').find('.mb-3.col-md-6').first().before(`
//                     <div class="d-flex gap-2 mb-2 note-row align-items-start">
//                     <textarea class="form-control" name="quotation_notes_details[]" rows="3">${r.quotation_notes_details || ''}</textarea>
//                     <button type="button" class="btn btn-sm btn-danger remove-note"><b>X</b></button>
//                     </div>
//                 `);
//                 });
//             }
//             // $('[name="quotations_id"]').val(data.quotation_id);
                 
//             // $('#QuotationitineraryModal').modal('show'); // show bootstrap modal when complete loaded
//             // $('.modal-title').text('Edit Itinerary Details'); // Set title to Bootstrap modal title
//             // $('#btnSave').text('update');

//         },
//         error: function (jqXHR, textStatus, errorThrown)
//         {
//             alert('Error get data from ajax');
//         }
//     });
// }


////***For loading select2 change detination dropdown*****///

function select2AjaxSetSelected(selector, id, text) {
    var $s = $(selector);
    if (!id || !text) { $s.val(null).trigger('change'); return; }
    if ($s.find('option[value="' + id + '"]').length === 0) {
        $s.append(new Option(text, id, true, true));
    } else {
        $s.val(id);
    }
    $s.trigger('change');
}

function initQuotationItineraryModalSelect2() {
    var $modal = $('#QuotationitineraryModal');

    // Inclusions & Exclusions
    var $inc = $('#quotation_inclusion_exclusion_common_id_fk');
    if ($inc.length && !$inc.hasClass('select2-hidden-accessible')) {
        $inc.select2({
            width: '100%',
            placeholder: 'Please Search by title',
            allowClear: true,
            dropdownParent: $modal,
            ajax: {
                url: '<?php echo base_url(); ?>index.php/Packages/ajax_filter_inclusion_exclusion',
                dataType: 'json',
                delay: 250,
                data: function(params) { return { q: params.term }; },
                processResults: function(data) { return data; },
                cache: true
            }
        });
    }

    // Payment Policies
    var $pay = $('#quotation_policies_id_fk');
    if ($pay.length && !$pay.hasClass('select2-hidden-accessible')) {
        $pay.select2({
            width: '100%',
            placeholder: 'Please Search by title',
            allowClear: true,
            dropdownParent: $modal,
            ajax: {
                url: '<?php echo base_url(); ?>index.php/Packages/ajax_filter_payment_policies',
                dataType: 'json',
                delay: 250,
                data: function(params) { return { q: params.term }; },
                processResults: function(data) { return data; },
                cache: true
            }
        });
    }

    // Terms & Conditions
    var $tc = $('#quotation_terms_condition_id_fk');
    if ($tc.length && !$tc.hasClass('select2-hidden-accessible')) {
        $tc.select2({
            width: '100%',
            placeholder: 'Please Search by title',
            allowClear: true,
            dropdownParent: $modal,
            ajax: {
                url: '<?php echo base_url(); ?>index.php/Packages/ajax_filter_terms_conditions',
                dataType: 'json',
                delay: 250,
                data: function(params) { return { q: params.term }; },
                processResults: function(data) { return data; },
                cache: true
            }
        });
    }

    // Cancellation Policies
    var $can = $('#quotation_cancellation_policies_id_fk');
    if ($can.length && !$can.hasClass('select2-hidden-accessible')) {
        $can.select2({
            width: '100%',
            placeholder: 'Please Search by title',
            allowClear: true,
            dropdownParent: $modal,
            ajax: {
                url: '<?php echo base_url(); ?>index.php/Packages/ajax_filter_cancellation_policies',
                dataType: 'json',
                delay: 250,
                data: function(params) { return { q: params.term }; },
                processResults: function(data) { return data; },
                cache: true
            }
        });
    }
}

$(document).ready(function () {
    initQuotationItineraryModalSelect2();
});

$(document).ready(function () {
  /* ==========================================================
       4. Itinerary change â†’ Load itinerary days
    ========================================================== */

    function initDaySelect2(el) {
    el.select2({
        width: '100%',
        placeholder: 'Please Select Days',
        allowClear: true,
        dropdownAutoWidth: true,
        templateResult: function (data) {

            if (!data.id) return data.text;

            var description = $(data.element).attr('data-desc');

            var $span = $('<span>').text(data.text);

            if (description) {
                $span.attr('data-preview-desc', description);
            }

            return $span;
        }
    });
}

/* ==========================================================
       5. Itinerary description in block on mouse over itinerary days
    ========================================================== */

    $(document).on('change', '.change_itinerary', function () {

    let row = $(this).closest('tr');
    let itineraryId = $(this).val();
    let daySelect = row.find('.change_itinerary_day');

    // ðŸ”¥ Destroy existing Select2 instance
    if (daySelect.hasClass('select2-hidden-accessible')) {
        daySelect.select2('destroy');
    }

    daySelect.empty().append('<option value="">Please Select Days</option>');

    if (!itineraryId) {
        initDaySelect2(daySelect);
        return;
    }

    $.ajax({
        type: "POST",
        url: "<?php echo base_url(); ?>index.php/Packages/fetch_days_under_itinerary",
        data: { itineraries_id_fk: itineraryId },
        dataType: "json",
        success: function (days) {

            $.each(days, function (i, day) {

                daySelect.append(
                    `<option value="${day.itineraries_days_id}"
                        data-desc="${day.itineraries_days_description}">
                         ${day.itineraries_days_day} | ${day.itineraries_days_title}
                    </option>`
                );
            });

            // âœ… Re-initialize Select2 AFTER options added
            initDaySelect2(daySelect);
        }
    });
});

var activeRowId = null;
var isMenuOpening = false;

$(document).on('select2:open', '.change_itinerary_day', function() {
    activeRowId = $(this).data('row-num');
    isMenuOpening = true;
    setTimeout(() => isMenuOpening = false, 200);
});

$(document).on('mouseenter', '.select2-results__option', function() {

    if (!activeRowId || isMenuOpening) return;

    var description = $(this).find('[data-preview-desc]').attr('data-preview-desc');
    // var tooltip = $('#tooltip_' + activeRowId);

    // if (description) {
    //     tooltip.html(description).fadeIn(100);
    //     $tooltip.css({ opacity: 1, transform: 'translateY(0)' }).show();

    // }

    var $tooltip = $('#tooltip_' + activeRowId);

    if (description) {
      $tooltip.html(description).fadeIn(100);
      $tooltip.css({ opacity: 1, transform: 'translateY(0)' }).show();
    }
});

$(document).on('select2:close', '.change_itinerary_day', function() {
    $('.day-description-tooltip').hide();
    activeRowId = null;
});




$(document).on('select2:select', '.change_itinerary_day', function (e) {

  let $select = $(this);
  let row = $select.closest('tr');
  let rowNum = row.data('row-num');

  let data = e.params.data;
  let description = $(data.element).attr('data-desc') || '';

  // âœ… Put description into CKEditor
  if (window.dayEditors && window.dayEditors[rowNum]) {
    window.dayEditors[rowNum].setData(description);
  } else {
    // fallback
    row.find('.day-editor').val(description);
  }
});

});

////***For loading or dynamically add the inclusion and exclusion*****///

$(document).ready(function () {

  /* ==========================
     SELECTORS
     ========================== */
  const $wrapper = $('#inclusionExclusionWrapper');
  const $chk     = $('#quotation_inclusion_exclusion_checked_type');
  const $ddl     = $('#quotation_inclusion_exclusion_common_id_fk');

  const $incBox  = $('#inclusion');
  const $excBox  = $('#exclusion');

  // Button wrappers (your buttons are inside these)
  const $btnIncWrap = $('.add1');
  const $btnExcWrap = $('.add2');

  // Cards (heading + body + buttons)
  const $cardInc = $('#myDiv2');
  const $cardExc = $('#myDiv3');

  /* ==========================
     INITIAL STATE
     ========================== */
  $wrapper.hide();
  $cardInc.hide();
  $cardExc.hide();
  $btnIncWrap.hide();
  $btnExcWrap.hide();

  /* ==========================
     HELPERS
     ========================== */

  function clearTextareas() {
    $incBox.html('');
    $excBox.html('');
  }

  function showManualUI() {
    // Manual mode = checkbox checked + dropdown empty
    $cardInc.show();
    $cardExc.show();
    $btnIncWrap.show();
    $btnExcWrap.show();
  }

  function hideAllUI() {
    $cardInc.hide();
    $cardExc.hide();
    $btnIncWrap.hide();
    $btnExcWrap.hide();
  }

  function appendRow(type, value = '') {
    const isInc = type === 'inclusion';
    const name  = isInc ? 'quotation_inclusions_details[]' : 'quotation_exclusions_details[]';
    const cls   = isInc ? 'inclusion-row' : 'exclusion-row';

    const html = `
      <div class="d-flex gap-2 mb-2 ${cls} align-items-start">
        <textarea class="form-control" name="${name}" rows="3">${value}</textarea>
        <button type="button" class="btn btn-sm btn-danger remove-row"><b>X</b></button>
      </div>
    `;

    (isInc ? $incBox : $excBox).append(html);
  }

  function loadFromBackend(commonId) {
    $.ajax({
      url: '<?php echo base_url(); ?>index.php/Packages/get_inclusion_exclusion_details',
      type: 'POST',
      dataType: 'json',
      data: { common_id: commonId },
      success: function (res) {
        clearTextareas();

        // Show cards when loading (content visible)
        $cardInc.show();
        $cardExc.show();

        // Hide add buttons in load mode
        $btnIncWrap.hide();
        $btnExcWrap.hide();

        if (res.inclusions && res.inclusions.length) {
          $.each(res.inclusions, function (i, row) {
            appendRow('inclusion', row.inclusions_details || '');
          });
        }

        if (res.exclusions && res.exclusions.length) {
          $.each(res.exclusions, function (i, row) {
            appendRow('exclusion', row.exclusions_details || '');
          });
        }
      }
    });
  }

  function isManualMode() {
    return $chk.is(':checked') && !$ddl.val();
  }

  /* ==========================
     CHECKBOX TOGGLE
     ========================== */
  $chk.on('change', function () {

    if ($(this).is(':checked')) {

      // Show whole module
      $wrapper.slideDown();

      // Reset everything
      $ddl.val('');
      clearTextareas();

      // âœ… IMPORTANT: show cards + add buttons now
      showManualUI();

    } else {

      // Hide whole module
      $wrapper.slideUp();

      // Reset/clear
      $ddl.val('');
      clearTextareas();

      // Hide cards + buttons
      hideAllUI();
    }
  });

  /* ==========================
     DROPDOWN CHANGE
     ========================== */
  $ddl.on('change', function () {

    const commonId = $(this).val();
    clearTextareas();

    // If checkbox not checked, nothing should show
    if (!$chk.is(':checked')) {
      hideAllUI();
      return;
    }

    // Reset to manual mode (dropdown empty)
    if (!commonId) {
      showManualUI();
      return;
    }

    // Load mode (dropdown selected)
    loadFromBackend(commonId);
  });

  /* ==========================
     ADD MANUAL ROWS
     ========================== */
  $(document).on('click', '.add-inclusion', function () {
    if (!isManualMode()) return;
    $cardInc.show();
    appendRow('inclusion', '');
  });

  $(document).on('click', '.add-exclusion', function () {
    if (!isManualMode()) return;
    $cardExc.show();
    appendRow('exclusion', '');
  });

  /* ==========================
     REMOVE ROW
     ========================== */
  $(document).on('click', '.remove-row', function () {
    $(this).closest('.inclusion-row, .exclusion-row').remove();
  });

});


////***For loading or dynamically add the inclusion and exclusion*****///


////***For dynamically add the optional addon*****///

$(document).ready(function () {

    // Checkbox
    const $optChk = $('#quotation_optional_add_on_checked_type');

    // Main container where rows are appended
    const $optBox = $('#optional-addon');

    // Keep a reference to the add button block so we don't remove it
    const $optAddBtnBlock = $optBox.find('.mb-3.col-md-6').first();

    // Hide Optional Add-on section initially if checkbox is not checked
    toggleOptionalAddonUI($optChk.is(':checked'));

    /* ==========================================
       CHECKBOX TOGGLE (SHOW/HIDE + CLEAR)
       ========================================== */
    $optChk.on('change', function () {
        const isChecked = $(this).is(':checked');

        // Show/hide UI
        toggleOptionalAddonUI(isChecked);

        // When toggling, clear all added rows
        clearOptionalAddonRows();
    });

    /* ==========================================
       ADD NEW OPTIONAL ADDON ROW
       ========================================== */
    $(document).on('click', '.add-optional-addon', function () {

        // Allow add only if checkbox checked
        if (!$optChk.is(':checked')) return;

        // Append a new row BEFORE the Add button block
        $optAddBtnBlock.before(`
            <div class="d-flex gap-2 mb-2 optional-addon-row align-items-start">
                <textarea name="quotation_optional_add_on_details[]"
                          class="form-control"
                          rows="3"
                          placeholder="Enter optional add on"></textarea>

                <button type="button"
                        class="btn btn-sm btn-danger remove-optional-addon">
                    <b>X</b>
                </button>
            </div>
        `);
    });

    /* ==========================================
       REMOVE OPTIONAL ADDON ROW
       ========================================== */
    $(document).on('click', '.remove-optional-addon', function () {
        $(this).closest('.optional-addon-row').remove();
    });

    /* ==========================================
       HELPERS
       ========================================== */
    function toggleOptionalAddonUI(show) {
        // Hide/show the whole card column for optional-addon
        // (closest col-xl-10 col-lg-10 holds card)
        const $section = $optBox.closest('.col-xl-10.col-lg-10');

        if (show) {
            $section.slideDown();
        } else {
            $section.slideUp();
        }
    }

    function clearOptionalAddonRows() {
        // Remove only dynamically added rows, keep add button block
        $optBox.find('.optional-addon-row').remove();
    }

});

////***For dynamically add the optional addon*****///

////***For dynamically add the special requirments *****///

$(document).ready(function () {

    /* ==========================================================
       GET OPTIONS (CACHED)
       ========================================================== */
    function getSpecialOptions(callback) {

        // If already fetched once, reuse
        if (specialOptionsCache) {
            callback(specialOptionsCache);
            return;
        }

        $.ajax({
            url: "<?php echo base_url(); ?>index.php/Packages/get_special_requirements",
            type: "GET",
            dataType: "json",
            success: function (res) {
                specialOptionsCache = res || [];
                callback(specialOptionsCache);
            }
        });
    }

    /* ==========================================================
       POPULATE A SELECT
       ========================================================== */
    function fillSelect($select, options) {

        $select.empty().append('<option value="">Please Select</option>');

        $.each(options, function (i, item) {
            $select.append(`<option value="${item.id}">${item.text}</option>`);
        });
    }

    /* ==========================================================
       GLOBAL FUNCTION used by onClick="addMore4();"
       ========================================================== */
    window.addMore4 = function () {

        if (!$chk.is(':checked')) return;

        const $btnBlock = $box.find('.mb-3.col-md-6').first();

        // âœ… create jQuery element so we can grab the select from THIS row
        const $row = $(`
            <div class="row special-row align-items-end mb-2">

                <div class="col-md-3">
                    <select name="special_requirements_id_fk[]"
                            class="form-control special-select"
                            required>
                        <option value="">Loading...</option>
                    </select>
                </div>

                <div class="col-md-3">
                    <input type="text"
                           class="form-control special-amount"
                           name="packages_special_requirements_cost[]"
                           placeholder="Enter amount"
                           required>
                </div>

                <div class="col-md-1">
                    <button type="button" class="btn btn-sm btn-danger remove-special">
                        <b>X</b>
                    </button>
                </div>

            </div>
        `);

        // Insert before button block
        $btnBlock.before($row);

        // âœ… now target select inside THIS inserted row (not first row)
        const $select = $row.find('.special-select');

        // Load options (cached) and fill
        getSpecialOptions(function (options) {
            fillSelect($select, options);
        });
    };

    /* ==========================================================
       REMOVE ROW
       ========================================================== */
    $(document).on('click', '.remove-special', function () {
        $(this).closest('.special-row').remove();
    });

    /* ==========================================================
       ON CHANGE SELECT â†’ LOAD AMOUNT
       ========================================================== */
    $(document).on('change', '.special-select', function () {

        const specialId = $(this).val();
        const $row = $(this).closest('.special-row');
        const $amount = $row.find('.special-amount');

        $amount.val('');

        if (!specialId) return;

        $.ajax({
            url: "<?php echo base_url(); ?>index.php/Packages/get_special_requirement_amount",
            type: "POST",
            dataType: "json",
            data: { special_requirements_id: specialId },
            success: function (res) {
                $amount.val(res.amount || '');
            }
        });
    });

});

////***For dynamically add the special requirments *****///

////***For load or dynamically add the payment policies *****///

$(document).ready(function () {

    const $chk   = $('#quotation_payment_policies_checked_type');
    const $ddl   = $('#quotation_policies_id_fk');
    const $box   = $('#payment-policies');
    const $card  = $('#myDiv5');
    const $ddRow = $('#myDiv4');

    // Initial hide
    $ddRow.hide();
    $card.hide();

    /* ===============================
       CHECKBOX TOGGLE
       =============================== */
    $chk.on('change', function () {

        if ($(this).is(':checked')) {

            $ddRow.slideDown();
            $card.slideDown();

            resetPaymentPolicies(true);

        } else {

            $ddRow.slideUp();
            $card.slideUp();

            resetPaymentPolicies(false);
        }
    });

    /* ===============================
       DROPDOWN CHANGE
       =============================== */
    $ddl.on('change', function () {

        const id = $(this).val();

        clearRows();

        if (!id) {
            // Manual mode
            $('.payment_add').show();
            return;
        }

        // Load mode
        $('.payment_add').hide();

        $.ajax({
            url: "<?php echo base_url(); ?>index.php/Packages/get_payment_policies_items",
            type: "POST",
            dataType: "json",
            data: { payment_policies_id: id },
            success: function (res) {

                $.each(res, function (i, row) {
                    appendRow(row.description || '');
                });
            }
        });
    });

    /* ===============================
       GLOBAL ADD FUNCTION (button)
       =============================== */
    window.addMore5 = function () {

        // Only allow manual add
        if (!$chk.is(':checked')) return;
        if ($ddl.val()) return;

        appendRow('');
    };

    /* ===============================
       APPEND TEXTAREA ROW
       =============================== */
    function appendRow(value) {

        const $btnBlock = $box.find('.payment_add').first();

        $btnBlock.before(`
            <div class="d-flex gap-2 mb-2 payment-row align-items-start">
                <textarea class="form-control"
                          name="quotation_payment_policies_details[]"
                          rows="3">${value}</textarea>

                <button type="button"
                        class="btn btn-sm btn-danger remove-payment">
                    <b>X</b>
                </button>
            </div>
        `);
    }

    /* ===============================
       CLEAR ROWS
       =============================== */
    function clearRows() {
        $box.find('.payment-row').remove();
    }

    /* ===============================
       RESET FUNCTION
       =============================== */
    function resetPaymentPolicies(showAdd) {

        $ddl.val('');
        clearRows();

        if (showAdd) {
            $('.payment_add').show();
        } else {
            $('.payment_add').hide();
        }
    }

    /* ===============================
       REMOVE ROW
       =============================== */
    $(document).on('click', '.remove-payment', function () {
        $(this).closest('.payment-row').remove();
    });

});

////***For load or dynamically add the payment policies *****///

////***For load or dynamically add the terms and condition *****///

$(document).ready(function () {

    const $chk   = $('#quotation_terms_conditions_checked_type');
    const $ddl   = $('#quotation_terms_condition_id_fk');
    const $box   = $('#terms-conditions');

    const $ddRow = $('#myDiv6');  // dropdown row
    const $card  = $('#myDiv7');  // card

    // Initial hide
    $ddRow.hide();
    $card.hide();

    /* ===============================
       CHECKBOX TOGGLE
       =============================== */
    $chk.on('change', function () {

        if ($(this).is(':checked')) {
            $ddRow.slideDown();
            $card.slideDown();
            resetTerms(true);
        } else {
            $ddRow.slideUp();
            $card.slideUp();
            resetTerms(false);
        }
    });

    /* ===============================
       DROPDOWN CHANGE
       =============================== */
    $ddl.on('change', function () {

        const id = $(this).val();

        clearTermsRows();

        // Manual mode
        if (!id) {
            $('.terms_add').show();
            return;
        }

        // Load mode
        $('.terms_add').hide();

        $.ajax({
            url: "<?php echo base_url(); ?>index.php/Packages/get_terms_conditions_items",
            type: "POST",
            dataType: "json",
            data: { terms_condition_id: id },
            success: function (res) {
                $.each(res, function (i, row) {
                    appendTermsRow(row.description || '');
                });
            }
        });
    });

    /* ===============================
       GLOBAL ADD FUNCTION (button)
       =============================== */
    window.addMore6 = function () {

        // Only allow manual add
        if (!$chk.is(':checked')) return;
        if ($ddl.val()) return;

        appendTermsRow('');
    };

    /* ===============================
       APPEND TEXTAREA ROW
       =============================== */
    function appendTermsRow(value) {

        const $btnBlock = $box.find('.terms_add').first();

        $btnBlock.before(`
            <div class="d-flex gap-2 mb-2 terms-row align-items-start">
                <textarea class="form-control"
                          name="quotation_terms_condition_details[]"
                          rows="3">${value}</textarea>

                <button type="button"
                        class="btn btn-sm btn-danger remove-terms">
                    <b>X</b>
                </button>
            </div>
        `);
    }

    /* ===============================
       CLEAR ROWS
       =============================== */
    function clearTermsRows() {
        $box.find('.terms-row').remove();
    }

    /* ===============================
       RESET
       =============================== */
    function resetTerms(showAdd) {

        $ddl.val('');
        clearTermsRows();

        if (showAdd) {
            $('.terms_add').show();
        } else {
            $('.terms_add').hide();
        }
    }

    /* ===============================
       REMOVE ROW
       =============================== */
    $(document).on('click', '.remove-terms', function () {
        $(this).closest('.terms-row').remove();
    });

});

////***For load or dynamically add the terms and condition *****///

////***For load or dynamically add the cancellation policy *****///

$(document).ready(function () {

    const $chk   = $('#quotation_cancellation_policy_checked_type');
    const $ddl   = $('#quotation_cancellation_policies_id_fk');
    const $box   = $('#cancellation-policy');

    const $ddRow = $('#myDiv8');  // dropdown row
    const $card  = $('#myDiv9');  // card

    // Initial hide
    $ddRow.hide();
    $card.hide();

    /* ===============================
       CHECKBOX TOGGLE
       =============================== */
    $chk.on('change', function () {

        if ($(this).is(':checked')) {
            $ddRow.slideDown();
            $card.slideDown();
            resetCancellation(true);
        } else {
            $ddRow.slideUp();
            $card.slideUp();
            resetCancellation(false);
        }
    });

    /* ===============================
       DROPDOWN CHANGE
       =============================== */
    $ddl.on('change', function () {

        const id = $(this).val();

        clearCancellationRows();

        // Manual mode
        if (!id) {
            $('.terms_add').show(); // your add button wrapper is terms_add
            return;
        }

        // Load mode
        $('.terms_add').hide();

        $.ajax({
            url: "<?php echo base_url(); ?>index.php/Packages/get_cancellation_policy_items",
            type: "POST",
            dataType: "json",
            data: { cancellation_policies_id: id },
            success: function (res) {
                $.each(res, function (i, row) {
                    appendCancellationRow(row.description || '');
                });
            }
        });
    });

    /* ===============================
       GLOBAL ADD FUNCTION (button)
       =============================== */
    window.addMore7 = function () {

        // Only allow manual add
        if (!$chk.is(':checked')) return;
        if ($ddl.val()) return;

        appendCancellationRow('');
    };

    /* ===============================
       APPEND TEXTAREA ROW
       =============================== */
    function appendCancellationRow(value) {

        const $btnBlock = $box.find('.terms_add').first();

        $btnBlock.before(`
            <div class="d-flex gap-2 mb-2 cancellation-row align-items-start">
                <textarea class="form-control"
                          name="quotation_cancellation_policies_details[]"
                          rows="3">${value}</textarea>

                <button type="button"
                        class="btn btn-sm btn-danger remove-cancellation">
                    <b>X</b>
                </button>
            </div>
        `);
    }

    /* ===============================
       CLEAR ROWS
       =============================== */
    function clearCancellationRows() {
        $box.find('.cancellation-row').remove();
    }

    /* ===============================
       RESET
       =============================== */
    function resetCancellation(showAdd) {

        $ddl.val('');
        clearCancellationRows();

        if (showAdd) {
            $('.terms_add').show();
        } else {
            $('.terms_add').hide();
        }
    }

    /* ===============================
       REMOVE ROW
       =============================== */
    $(document).on('click', '.remove-cancellation', function () {
        $(this).closest('.cancellation-row').remove();
    });

});

////***For load or dynamically add the cancellation policy *****///

////***For dynamically add the notes *****///

$(document).ready(function () {

    const $chk = $('#quotation_notes_checked_type');
    const $box = $('#add_notes');

    // Hide/show the whole Notes card column (col-xl-10 col-lg-10)
    const $cardCol = $box.closest('.col-xl-10.col-lg-10');

    // The add button block (we keep it, and insert rows before it)
    const $btnBlock = $box.find('.mb-3.col-md-6').first();

    /* ===============================
       INITIAL STATE
       =============================== */
    if (!$chk.is(':checked')) {
        $btnBlock.hide();
    }

    /* ===============================
       CHECKBOX TOGGLE
       =============================== */
    $chk.on('change', function () {

        if ($(this).is(':checked')) {
            $btnBlock.slideDown();
            clearNoteRows();
        } else {
            $btnBlock.slideUp();
            clearNoteRows();
        }
    });

    /* ===============================
       GLOBAL FUNCTION (button onClick)
       =============================== */
    window.addMore8 = function () {

        // Add only if checkbox checked
        if (!$chk.is(':checked')) return;

        // Insert a new textarea row before button block
        $btnBlock.before(`
            <div class="d-flex gap-2 mb-2 note-row align-items-start">
                <textarea class="form-control"
                          name="quotation_notes_details[]"
                          rows="3"
                          placeholder="Enter note"
                          required></textarea>

                <button type="button"
                        class="btn btn-sm btn-danger remove-note">
                    <b>X</b>
                </button>
            </div>
        `);
    };

    /* ===============================
       REMOVE ROW
       =============================== */
    $(document).on('click', '.remove-note', function () {
        $(this).closest('.note-row').remove();
    });

    /* ===============================
       CLEAR ONLY DYNAMIC ROWS
       =============================== */
    function clearNoteRows() {
        $box.find('.note-row').remove();
    }

});

////***For dynamically add the notes *****///

////***For update itinerary quotation details from adding modal form  *****///

////***For reload the datatable  *****///

function reload_table()
{
    $table.ajax.reload(null,false); //reload datatable ajax 
    var id = $("#id").val();
    if(id > 0)
    {  

        swal("Quotation details updated successfully", "", "success")
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
        
        swal("Quotation details added successfully", "", "success")

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

function reload_table_status()
{
    $table.ajax.reload(null,false); //reload datatable ajax 

        swal("Quotation status updated successfully", "", "success")
       
    
    
}

////***For reload the datatable  *****///




////***For convert to trip *****///

function reload_table_trip()
{
    $table.ajax.reload(null,false); //reload datatable ajax 

        swal("Converted into trip successfully", "", "success")
    
}

function convert_trip(id)
{
     $.ajax({
        url : "<?php echo base_url();?>index.php/Quotation/ajax_edit_trip/" + id,
        type: "GET",
        dataType: "JSON",
        success: function(data)
        {

            $("#id5").val(data.quotation_id);
            $("#lead_id_fk1").val(data.leads_id_fk);
            $("#trips_travel_start_date").val(data.start_date);
            $("#trips_travel_end_date").val(data.end_date);
            $("#trips_travel_duration").val(data.duration);
            $('#ConverttripModal').modal('show'); // show bootstrap modal when complete loaded
            $('.modal-title5').text('Do you want to convert to trip?'); // Set title to Bootstrap modal title
            $('#btnSave1').text('convert');
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

function convert_to_trip_action()
{
    $('#btnSave4').text('converting...'); //change button text
    $('#btnSave4').attr('disabled',true); //set button disable 
    var url;

        url = "<?php echo base_url();?>index.php/Quotation/convert_trip/";
        
    

    // ajax adding data to database
    $.ajax({
        url : url,
        type: "POST",
        data: $('#form5').serialize(),
        dataType: "JSON",
        success: function(data)
        {

            if(data.status) //if success close modal and reload ajax table
            {
                $("#id1").val('');
                $('#ConverttripModal').modal('hide');
                reload_table_trip();
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

            $('#btnSave4').text('save'); //change button text
            $('#btnSave4').attr('disabled',false); //set button enable 


        },
        error: function (jqXHR, textStatus, errorThrown)
        {
            alert('Error adding / update data');
            $('#btnSave4').text('save'); //change button text
            $('#btnSave4').attr('disabled',false); //set button enable 

        }
    });
}

////***For reload the datatable for delete *****///

function reload_table_delete()
{
    $table.ajax.reload(null,false); //reload datatable ajax
    
    swal("Quotation details deleted successfully", "", "success")
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

////***For reload the quotation datatable for delete *****///

function delete_quotation(id)
{
     $.ajax({
        url : "<?php echo base_url();?>index.php/Quotation/ajax_edit_delete/" + id,
        type: "GET",
        dataType: "JSON",
        success: function(data)
        {

            $("#id1").val(data.quotation_id);
            $("#quote_num").val(data.quotation_number);
            $('#deleterowModal').modal('show'); // show bootstrap modal when complete loaded
            $('.modal-title1').text('Do you want to delete this record?'); // Set title to Bootstrap modal title
            $('#btnSave7').text('delete');
            $('#btnSave7').attr('disabled',false); //set button enable 

        },
        error: function (jqXHR, textStatus, errorThrown)
        {
            alert('Error get data from ajax');
        }
    });
    
    // $('#deleterowModal').modal('show'); // show bootstrap modal
        // ajax delete data to database 
}

function delete_quotation_action()
{
    $('#btnSave7').text('deleting...'); //change button text
    $('#btnSave7').attr('disabled',true); //set button disable 
    var url;

        url = "<?php echo base_url();?>index.php/Quotation/ajax_delete/";
        
    

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
                reload_table_delete();
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

            $('#btnSave7').text('save'); //change button text
            $('#btnSave7').attr('disabled',false); //set button enable 


        },
        error: function (jqXHR, textStatus, errorThrown)
        {
            alert('Error adding / update data');
            $('#btnSave7').text('save'); //change button text
            $('#btnSave7').attr('disabled',false); //set button enable 

        }
    });
}

////***For delete the quotation details from  database *****///

////***For Leads view *****///

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
        url: "<?php echo base_url('index.php/Quotation/ajax_view_lead_details/'); ?>" + id,
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

function load_guest_accommodation_details(quotation_id)
{
    $.ajax({
        url: "<?php echo base_url('index.php/Quotation/ajax_guest_accommodation_details/'); ?>" + quotation_id,
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
                    ['Accommodation Status', getAccommodationStatusText(d.leads_accomodation_status, d.leads_quotation_status)]
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
                    ['Accommodation Status', getAccommodationStatusText(d.leads_accomodation_status, d.leads_quotation_status)]
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

</script>
