
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
function toggleAddOptionBtn() {
    var packageId = $('#packages_id_fk').val();
    $('#addOptionBtn').prop('disabled', !packageId);
}

$('#packages_id_fk').select2({
    dropdownParent: $('#QuotationModal'),
    minimumResultsForSearch: 0,
    width: '100%'
});

$('#packages_id_fk').on('change select2:select select2:clear', function () {
    toggleAddOptionBtn();
});

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
    
////***For open modal of quotation adding form  *****///

function clearQuotationOnPackageChange() {

    // ❗ clear option blocks
    // $('#optionsContainer').empty();
    $('.optionBlock').remove();

    if (typeof optionCount !== 'undefined') {
        optionCount = 0;
    }

    // ❗ uncheck checkboxes
    $('#quotation_property_inclusion_type').prop('checked', false);
    $('#quotation_special_requirement_type').prop('checked', false);

    // ❗ hide boxes
    $('#inclusionBox').hide();
    $('#specialReqBox').hide();

    // ===== PROPERTY INCLUSION RESET =====
    const $incTbody = $('#inclusionTable tbody');

    if ($incTbody.length) {
        $incTbody.find('tr:gt(0)').remove();

        const $first = $incTbody.find('tr:eq(0)');
        $first.find('input').val('');
        $first.find('select').val('').trigger('change');

        // reset dropdown options if needed
        $first.find('.inclusionPropertySelect').html('<option value="">Select Property</option>');
        $first.find('.inclusionNameSelect').html('<option value="">Select Inclusion</option>');

        $first.find('.removeInclusionBtn').prop('disabled', true);
    }

    // ===== SPECIAL REQUIREMENT RESET =====
    const $spTbody = $('#specialReqTable tbody');

    if ($spTbody.length) {
        $spTbody.find('tr:gt(0)').remove();

        const $first = $spTbody.find('tr:eq(0)');
        $first.find('input').val('');
        $first.find('select').val('').trigger('change');

        $first.find('.specialReqSelect').html('<option value="">Select Requirement</option>');

        $first.find('.removeSpecialReqBtn').prop('disabled', true);
    }

    // ❗ reset totals
    $('#totalInclusionAmountText').text('0.00');
    $('#totalInclusionAmountInput').val('0');

    $('#totalSpecialReqAmountText').text('0.00');
    $('#totalSpecialReqAmountInput').val('0');

    // ❗ clear cached data
    if (typeof __dayOptions !== 'undefined') __dayOptions = [];
    if (typeof __specialReqOptions !== 'undefined') __specialReqOptions = [];
    if (typeof __dayPropertyMap !== 'undefined') __dayPropertyMap = {};
    if (typeof __propertyInclusionMap !== 'undefined') __propertyInclusionMap = {};

    // ✅ reset scroll position
    $('#QuotationModal .modal-body').scrollTop(0);

    // ✅ fix bootstrap scroll recalculation
    setTimeout(function () {
        $('#QuotationModal').modal('handleUpdate');
    }, 100);
}

function resetQuotationModalForm() {

    // reset native form
    var form = document.getElementById('form');
    if (form) {
        form.reset();
    }

    // hidden ids
    $('#id').val('');
    $('#leads_id_hidden').val('');
    $('#packages_id_hidden').val('');

    // if visible dropdowns exist — re-enable and clear AJAX Select2
    if ($('#leads_id').length) {
        $('#leads_id').prop('disabled', false).data('filter-mode', 'add_quotation').empty()
            .append('<option value="">Please Select lead</option>')
            .val('').trigger('change.select2');
    }
    if ($('#packages_id_fk').length) {
        $('#packages_id_fk').prop('disabled', false)
            .html('<option value="">Please Select Template</option>')
            .val('').trigger('change.select2');
    }

    // clear select2 fields inside modal
    $('#QuotationModal').find('select').each(function () {
        $(this).val('').trigger('change');
    });

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
            // $(this).html('<option value="">Select</option>').val('').trigger('change');
            $(this).html('<option value="">Select</option>').val('').trigger('change.select2');
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
            $(this).html('<option value="">Select</option>').val('').trigger('change');
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

// function add_quotation()
// { 
//     save_method = 'add';
//     resetQuotationModalForm();
//     $("#id").val('');
//     $('#form')[0].reset(); // reset form on modals
//     $('.form-group').removeClass('input-warning-o'); // clear error class
//     $('.help-block').empty(); // clear error string
//      $('#leadPackageRow').removeClass('d-none'); // if needed for normal quotation page
//     $('#QuotationModal').modal('show'); // show bootstrap modal
//     $('.modal-title').text('Add Quotation Details'); // Set Title to Bootstrap modal title
//     $('#btnSave').text('save');
// $('#leads_id, #packages_id_fk')
//     .prop('disabled', false)
//     .trigger('change.select2');

// $('#leads_id_hidden, #packages_id_hidden').val('');
//     // Set current date in textbox
// var today = new Date();
// var dd = String(today.getDate()).padStart(2, '0');
// var mm = String(today.getMonth() + 1).padStart(2, '0'); // January is 0
// var yyyy = today.getFullYear();

// var formattedDate = dd + '-' + mm + '-' + yyyy;
// $('#quotation_date').val(formattedDate);
    
// }

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

$('#packages_id_fk')
    .prop('disabled', false)
    .html('<option value="">Please Select Template</option>')
    .val('')
    .trigger('change.select2');

$('#leads_id_hidden, #packages_id_hidden').val('');

    // ✅ clear option blocks/details
    $('#optionsContainer').empty();
    $('.optionBlock').remove();

    if (typeof optionCount !== 'undefined') {
        optionCount = 0;
    }

    // ✅ clear inclusion/special boxes
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
}
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
      $ta.val(editor.getData()); // ✅ write editor html into textarea
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

  var form = document.getElementById('form2'); // ✅ correct form id
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
        $('#QuotationitineraryModal').modal('hide'); // ✅ correct modal
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

//   // ✅ prevent confirm popup while saving/resetting
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

  var form = document.getElementById('form2'); // ✅ correct form id
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
        $('#QuotationitineraryModal').modal('hide'); // ✅ correct modal
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

  // ✅ wait 1 tick so DOM rows are fully inserted
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

  // ✅ Init Select2 AJAX for change_itinerary (loads when dropdown opens)
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

  // ✅ Init CKEditor
  if (typeof initEditorsForDays === 'function') initEditorsForDays();

}



// loadRowWiseItineraries removed — .change_itinerary now uses Select2 AJAX

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
    url: '<?php echo base_url(); ?>index.php/Packages/fetch_itinerary_under_category', // ✅ correct
    type: 'POST',
    data: {
      packages_itinerary_category_id_fk: catId,     // ✅ correct
      packages_duration_in_nights: nights           // ✅ correct
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

    // ✅ get row number from input
    const rowNum = $(this).data('row-num');

    // ✅ find exact row using rowNum (same as your editor sync)
    const $tr = $('#itinerary tr[data-row-num="' + rowNum + '"]');

    const $img = $tr.find('.day-thumb');

    if ($img.length === 0) {
        console.warn('day-thumb not found for row:', rowNum);
        return;
    }

    // ❌ if no file (cancel)
    if (!file) {
        $img.attr('src', '').hide();
        return;
    }

    // ❌ validate image
    if (!file.type.startsWith('image/')) {
        alert('Please select a valid image');
        $(this).val('');
        return;
    }

    // ✅ preview
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
       4. Itinerary change → Load itinerary days
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

    // 🔥 Destroy existing Select2 instance
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

            // ✅ Re-initialize Select2 AFTER options added
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

  // ✅ Put description into CKEditor
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

      // ✅ IMPORTANT: show cards + add buttons now
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

        // ✅ create jQuery element so we can grab the select from THIS row
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

        // ✅ now target select inside THIS inserted row (not first row)
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
       ON CHANGE SELECT → LOAD AMOUNT
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

// $(document).on('input change', '.autoCalcRateInput', function () {

//     const val = parseFloat($(this).val()) || 0;

//     if (val > 0) {
//         $(this)
//             .closest('tr')
//             .css('border', '');
//     }
// });

// $(document).on('input change', '.autoCalcRateInput', function () {

//     const row = $(this).closest('tr');
//     const val = parseFloat($(this).val()) || 0;

//     if (val > 0) {
//         row.removeClass('room-rate-error');
//     }
// });

// function showError(message, element)
// {
//     if (typeof toastr !== 'undefined') {
//         toastr.error(message);
//     } else {
//         alert(message);
//     }

//     $('.is-invalid').removeClass('is-invalid');
//     $('.select2-error').removeClass('select2-error');

//     if (!element) return false;

//     const $el = $(element);

//     // ===== SELECT2 =====
//     if (
//         $el.hasClass('select2-hidden-accessible') ||
//         $el.hasClass('select2-selection') ||
//         $el.closest('.select2').length
//     ) {

//         let $select2Container;

//         if ($el.hasClass('select2-selection')) {
//             $select2Container = $el;
//         }
//         else if ($el.next('.select2').length) {
//             $select2Container = $el.next('.select2').find('.select2-selection');
//         }
//         else {
//             $select2Container = $el.closest('.select2').find('.select2-selection');
//         }

//         $select2Container.addClass('select2-error');

//         $('html, body').animate({
//             scrollTop: $select2Container.offset().top - 150
//         }, 300);

//         return false;
//     }

//     // ===== NORMAL INPUT =====
//     $el.addClass('is-invalid');

//     $('html, body').animate({
//         scrollTop: $el.offset().top - 150
//     }, 300);

//     return false;
// }

function showError(message, element)
{
    var n = new notify({
        title: '',
        style: 'error',
        message: message,
        icon: 'fas fa-times'
    });
    n.show();
    setTimeout(function(){ n.hide(); }, 5000);

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

// function isValidOpenedPackageOption(optionId) {
//     let found = false;

//     $('.optionBlock').each(function () {
//         const val = $(this).find('.propertyDropdown').val() || '';
//         if (val == optionId) {
//             found = true;
//             return false;
//         }
//     });

//     return found;
// }

function isValidOpenedPackageOption(optionId) {
    let found = false;

    document.querySelectorAll('.optionBlock .propertyDropdown').forEach(sel => {
        if ((sel.value || '') === (optionId || '')) {
            found = true;
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
            alert('Duplicate template option selected.');
            $(this).focus();
            valid = false;
            return false;
        }

        values[val] = true;
    });

    return valid;
}


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

    if (!$('#leads_id').val())
        return showError('Please select Lead', $('#leads_id')[0]), false;

    if (!$('#packages_id_fk').val())
        return showError('Please select Template', $('#packages_id_fk')[0]), false;

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

function save() {

    // ✅ VALIDATE FIRST
    if (!validateQuotationForm()) {
        return;
    }

    let url = save_method === 'add'
        ? "<?php echo base_url();?>index.php/Quotation/ajax_add/"
        : "<?php echo base_url();?>index.php/Quotation/ajax_update/";

    $('#btnSave').text('saving...').attr('disabled', true);

    // ensure latest totals
    recalcAllOptionsBeforeSave();

    const form = document.getElementById('form');
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
                reload_table();
                resetQuotationModalForm();
                $('#QuotationModal').modal('hide');
                
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

// $(document).ready(function () {

//   function resetInclusionBox() {
//     // Keep only first row
//     const $tbody = $('#inclusionTable tbody');
//     $tbody.find('tr:gt(0)').remove();

//     // Clear first row inputs/select
//     $tbody.find('tr:eq(0) input').val('');
//     $tbody.find('tr:eq(0) select').val('').trigger('change');

//     // Disable first row remove btn
//     $tbody.find('tr:eq(0) .removeInclusionBtn').prop('disabled', true);
//   }

//   function resetSpecialReqBox() {
//     const $tbody = $('#specialReqTable tbody');
//     $tbody.find('tr:gt(0)').remove();

//     $tbody.find('tr:eq(0) input').val('');
//     $tbody.find('tr:eq(0) select').val('').trigger('change');

//     $tbody.find('tr:eq(0) .removeSpecialReqBtn').prop('disabled', true);
//   }

//   function toggleBox($checkbox, $box, resetFn) {
//     if ($checkbox.is(':checked')) {
//       $box.slideDown(150);

//       // ✅ fill dropdowns if your data already loaded
//       loadInclusionAndRequirementDropdownData();

//       // ✅ re-init select2 inside newly shown box (important)
//       setTimeout(function(){
//         $box.find('select').each(function(){
//           initSelect2(this, $(this).hasClass('specialReqSelect') ? 'Select Requirement' : 'Select Day | Date | Destination');
//         });
//       }, 50);

//     } else {
//       $box.slideUp(150, function(){
//         resetFn();
//       });
//     }
//   }

//   // default state (hide both)
//   $('#inclusionBox').hide();
//   $('#specialReqBox').hide();

//   // on load (if checked due to edit)
//   toggleBox($('#quotation_property_inclusion_type'), $('#inclusionBox'), resetInclusionBox);
//   toggleBox($('#quotation_special_requirement_type'), $('#specialReqBox'), resetSpecialReqBox);

//   // change handlers
//   $('#quotation_property_inclusion_type').on('change', function () {
//     toggleBox($(this), $('#inclusionBox'), resetInclusionBox);
//   });

//   $('#quotation_special_requirement_type').on('change', function () {
//     toggleBox($(this), $('#specialReqBox'), resetSpecialReqBox);
//   });

// });


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
    // $(document).on('change', '#packages_id_fk', function () {
    //     resetAddonBlocks();
    // });

    $(document).on('change', '#packages_id_fk', function () {
        if (window.isQuotationEditLoading) return;
        resetAddonBlocks();
    });
    // visible package select2
    // $(document).on('select2:select select2:clear', '#packages_id_fk', function () {
    //     resetAddonBlocks();
    // });

    $(document).on('select2:select select2:clear', '#packages_id_fk', function () {
        if (window.isQuotationEditLoading) return;
        resetAddonBlocks();
    });
    // hidden package field used in leads page modal version
    // $(document).on('change', '#packages_id_hidden', function () {
    //     resetAddonBlocks();
    // });
    $(document).on('change', '#packages_id_hidden', function () {
        if (window.isQuotationEditLoading) return;
        resetAddonBlocks();
    });

    // if no valid option remains
    // $(document).on('change', '.propertyDropdown', function () {
    //     if (!hasValidOptionSelected()) {
    //         resetAddonBlocks();
    //     }
    // });

    $(document).on('change', '.propertyDropdown', function () {
    if (window.isQuotationEditLoading) return;

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

// function fillDaySelect(selectEl) {
//     if (!selectEl) return;

//     var currentVal = $(selectEl).val() || selectEl.value || '';

//     var html = '<option value="">Select Day | Date | Destination</option>';

//     __dayOptions.forEach(function (r) {
//         var key = makeDayKey(r);
//         html += '<option value="' + key + '">' + buildDayOptionLabel(r) + '</option>';
//     });

//     $(selectEl).html(html);

//     // restore selected value if still exists
//     if (currentVal && $(selectEl).find('option[value="' + currentVal + '"]').length) {
//         $(selectEl).val(currentVal);
//     } else {
//         $(selectEl).val('');
//     }

//     initSelect2(selectEl, 'Select Day | Date | Destination');
//     $(selectEl).trigger('change.select2');
// }

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

// function fillSpecialReqSelect(selectEl) {
//     if (!selectEl) return;

//     var currentVal = $(selectEl).val() || selectEl.value || '';

//     var html = '<option value="">Select Requirement</option>';

//     if (Array.isArray(__specialReqOptions) && __specialReqOptions.length) {
//         __specialReqOptions.forEach(function (r) {
//             html += '<option value="' + r.special_requirements_id + '" data-cost="' + (r.special_requirements_cost || 0) + '">' +
//                         r.special_requirements_name +
//                     '</option>';
//         });
//     }

//     $(selectEl).html(html);

//     if (currentVal && $(selectEl).find('option[value="' + currentVal + '"]').length) {
//         $(selectEl).val(currentVal);
//     } else {
//         $(selectEl).val('');
//     }

//     initSelect2(selectEl, 'Select Requirement');
//     $(selectEl).trigger('change.select2');

//     applySpecialReqCostFromSelect(selectEl);
// }

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

// document.getElementById('addSpecialReqBtn').addEventListener('click', function (e) {
//   e.preventDefault();

//   const tbody = document.querySelector('#specialReqTable tbody');
//   tbody.insertAdjacentHTML('beforeend', createSpecialReqRow());

//   const row = tbody.lastElementChild;
//   fillDaySelect(row.querySelector('.specialReqDaySelect'));
//   fillSpecialReqSelect(row.querySelector('.specialReqSelect'));

//   recalcSpecialReqTotal();
// });

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

// function fillSpecialReqSelect(selectEl) {
//     if (!selectEl) return;

//     let html = `<option value="">Select Requirement</option>`;
//     __specialReqOptions.forEach(r => {
//         html += `
//             <option value="${r.special_requirements_id}"
//                     data-cost="${r.special_requirements_cost || 0}">
//                 ${r.special_requirements_name}
//             </option>`;
//     });

//     selectEl.innerHTML = html;

//     // ✅ Select2 init
//     initSelect2(selectEl, 'Select Requirement');

//     // if something already selected, apply its cost
// applySpecialReqCostFromSelect(selectEl);

// }


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

function loadInclusionAndRequirementDropdownData(callback) {
    var leadId = $('#leads_id_hidden').val() || $('#leads_id').val() || '';
    var packageId = $('#packages_id_hidden').val() || $('#packages_id_fk').val() || '';

    if (!leadId || !packageId) {
        if (typeof callback === 'function') callback();
        return;
    }

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

        if (typeof callback === 'function') callback();
    })
    .catch(function (err) {
        console.error(err);
        if (typeof callback === 'function') callback();
    });
}
// Call it when lead/package changes:
// document.getElementById('packages_id_fk')?.addEventListener('change', loadInclusionAndRequirementDropdownData);
// document.getElementById('leads_id')?.addEventListener('change', loadInclusionAndRequirementDropdownData);

// ❌ REMOVE THESE OLD LINES
// document.getElementById('packages_id_fk')?.addEventListener('change', loadInclusionAndRequirementDropdownData);
// document.getElementById('leads_id')?.addEventListener('change', loadInclusionAndRequirementDropdownData);

// ✅ USE THIS INSTEAD
// $(document).on('change', '#packages_id_hidden, #leads_id_hidden', function () {
//     loadInclusionAndRequirementDropdownData();
// });

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

function enableSelect2(selectEl, placeholder) {
    if (!selectEl) return;

    $(selectEl).prop('disabled', false);

    if ($(selectEl).hasClass('select2-hidden-accessible')) {
        $(selectEl).select2('destroy');
    }

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
//         refreshQuotationModalScroll(true);
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
//             refreshQuotationModalScroll(true);
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

function fetchVehicles(selectEl, callback) {
    if (!selectEl) return;

    $.ajax({
        url: "<?php echo base_url(); ?>index.php/Quotation/ajax_get_vehicle_list",
        type: "GET",
        dataType: "JSON",
        success: function (res) {
            let html = '<option value="">Select Vehicle</option>';

            if (res && res.status && Array.isArray(res.data)) {
                res.data.forEach(function (v) {
                    html += '<option value="' + v.vehicle_id + '">' +
                        v.vehicle_name +
                    '</option>';
                });
            }

            $(selectEl).html(html);

            if ($.fn.select2) {
                if ($(selectEl).hasClass('select2-hidden-accessible')) {
                    $(selectEl).select2('destroy');
                }

                $(selectEl).select2({
                    width: '100%',
                    placeholder: 'Select Vehicle',
                    allowClear: true,
                    dropdownParent: $('#QuotationModal')
                });
            }

            if (typeof callback === 'function') {
                callback();
            }
        }
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

    const packageId = packageSelect.value;
    if (!packageId) return;

    // Disable while loading
    dropdown.disabled = true;
    dropdown.innerHTML = '<option value="">Loading...</option>';
    if ($.fn.select2 && $(dropdown).hasClass('select2-hidden-accessible')) {
        $(dropdown).trigger('change.select2');
    }

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

            // Re-enable after load
            dropdown.disabled = false;

            if ($.fn.select2) {
                if ($(dropdown).hasClass('select2-hidden-accessible')) {
                    $(dropdown).select2('destroy');
                }
                $(dropdown).select2({
                    width: '100%',
                    placeholder: 'Select template option',
                    allowClear: true,
                    dropdownParent: $('#QuotationModal')
                });
            }
        })
        .catch(function() {
            dropdown.innerHTML = '<option value="">Failed to load</option>';
            dropdown.disabled = false;
            if ($.fn.select2 && $(dropdown).hasClass('select2-hidden-accessible')) {
                $(dropdown).trigger('change.select2');
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
    const leadId = document.getElementById('leads_id')?.value || '';
    const packageId = document.getElementById('packages_id_fk')?.value || '';

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
                container.innerHTML = `<p class="text-warning mb-0">No accommodation days found for this lead/package.</p>`;
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
            refreshQuotationModalScroll()
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

    const leadId = $('#leads_id').val() || '';
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
    // document.querySelectorAll('#inclusionTable tbody tr').forEach(function(tr) {
    //     var package_option_id_fk = tr.querySelector('[name="package_option_id_fk[]"]')?.value || '';
    //     var dayKey = tr.querySelector('[name="inclusion_day_key[]"]')?.value || '';
    //     var propertyId = tr.querySelector('[name="inclusion_property_id_fk[]"]')?.value || '';
    //     var propertyId = tr.querySelector('[name="inclusion_property_id_fk[]"]')?.value || '';
    //     var propertyInclusionId = tr.querySelector('[name="property_inclusions_id_fk[]"]')?.value || '';
    //     var name = '';

    //     var incSel = tr.querySelector('[name="property_inclusions_id_fk[]"]');
    //     if (incSel && incSel.selectedIndex >= 0) {
    //         name = incSel.options[incSel.selectedIndex].text || '';
    //     }

    //     var amount = tr.querySelector('[name="inclusion_amount[]"]')?.value || '';

    //     if (!dayKey || !propertyId || !propertyInclusionId) return;

    //     payload.inclusions.push({
    //         package_option_id_fk: package_option_id_fk,
    //         dayKey: dayKey,
    //         property_id_fk: propertyId,
    //         property_inclusions_id_fk: propertyInclusionId,
    //         name: name,
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
        url: BASE_URL + "Quotation/ajax_get_quotation_room_tariff_details",
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
            try {
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
            } catch (allocErr) {
                console.warn('Auto allocation skipped:', allocErr.message);
            }

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

            var _totalEB   = _mEbA + _mEbC;
            var _babySb    = parseInt(document.getElementById('modal_baby_sb_count')?.value || 0);
            var _babyEb    = parseInt(document.getElementById('modal_baby_eb_count')?.value || 0);
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

    // Capacity adequacy check
    var minRooms    = parseInt(document.getElementById('modal_min_rooms_required')?.value || 0);
    var policyDb    = parseInt(document.getElementById('modal_policy_db')?.value || 0);
    var policyEb    = parseInt(document.getElementById('modal_policy_eb')?.value || 0);
    var policySb    = parseInt(document.getElementById('modal_policy_sb')?.value || 0);
    var appAdults   = parseInt(document.getElementById('modal_applied_adults')?.value || 0);
    var appChildren = parseInt(document.getElementById('modal_applied_children')?.value || 0);
    var appBaby     = parseInt(document.getElementById('modal_applied_baby')?.value || 0);

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

function change_status(quotationId) {
  if (!quotationId) return;

  // reset form
  $('#changeStatusForm')[0].reset();
  $('#quotation_id').val(quotationId);

  // fill select
  const $status = $('#quotation_current_status');
  $status.empty().append('<option value="">Select Status</option>');

  QUOTATION_STATUSES.forEach(s => {
    $status.append(`<option value="${s.id}">${s.text}</option>`);
  });

  // init select2 properly inside modal
  if ($status.hasClass('select2-hidden-accessible')) {
    $status.select2('destroy');
  }

  $status.select2({
    width: '100%',
    dropdownParent: $('#ChangeStatusModal'),
    placeholder: 'Select Status',
    allowClear: true
  });

  // open modal (Bootstrap 4)
  // $('#ChangeStatusModal').modal({
  //   backdrop: 'static',
  //   keyboard: false
  // });
$('#ChangeStatusModal').modal('show'); // show bootstrap modal
  // fetch current status
  $.getJSON(
    "<?php echo base_url(); ?>index.php/Quotation/ajax_get_quotation_status",
    { quotation_id: quotationId },
    function (res) {
      if (res.status) {
        $('#quotation_current_status')
          .val(res.data.quotation_current_status)
          .trigger('change');
      }
    }
  );
}


function saveChangeStatus() {
  const quotationId = $('#quotation_id').val();
  const status = $('#quotation_current_status').val();

  if (!status) {
    alert('Please select status');
    return;
  }

  $.ajax({
    url: "<?php echo base_url(); ?>index.php/Quotation/ajax_update_quotation_status",
    type: "POST",
    dataType: "JSON",
    data: {
      quotation_id: quotationId,
      quotation_current_status: status
    },
    success: function (res) {
      if (res.status) {
        $('#ChangeStatusModal').modal('hide');
        reload_table_status();
      } else {
        alert('Failed to update status');
      }
    },
    error: function () {
      alert('Server error');
    }
  });
}



document.getElementById('leads_id').addEventListener('change', function () {
  document.getElementById('selected_lead_id').value = this.value || '';
});

$(document).ready(function() {
    $('#leads_id').change(function() {
    //alert("oo");
          var leads_id = $('#leads_id').val();

          // If lead cleared, reset template dropdown
          if (!leads_id) {
              $('#packages_id_fk').prop('disabled', false)
                  .html('<option value="">Please Select Template</option>')
                  .val('').trigger('change.select2');
              toggleAddOptionBtn();
              return;
          }

          // Disable template dropdown while loading
          $('#packages_id_fk').prop('disabled', true)
              .html('<option value="">Loading...</option>')
              .trigger('change.select2');

          $.ajax({
              url: "<?php echo base_url(); ?>index.php/Quotation/packageid_underlead/"+leads_id,
              dataType: 'json',
              type: 'POST',
              success:
              function(data) {

                packages_id = data['package_id_fk'];
                // alert(packages_id);

                 if(packages_id != '') {
                  $.ajax({
                      url: "<?php echo base_url(); ?>index.php/Quotation/fetch_package_under_lead",
                      method: "POST",
                      data: {
                          packages_id: packages_id
                      },
                      success: function(data) {
                          $('#packages_id_fk').html(data);
                          $('#packages_id_fk').prop('disabled', false).trigger('change.select2');
                          toggleAddOptionBtn();
                      }
                  });
                  } else {
                      $('#packages_id_fk').html('<option value="">Please Select Template</option>')
                          .prop('disabled', false).trigger('change.select2');
                  }
                
                  }
            
          });

    
       

    });
});



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

////***For convert to trip *****///

////////////////////// Quotation Edit /////////////////////////


function edit_quotation(id)
{
    save_method = 'update';
    window.isQuotationEditLoading = true;

    $('#form')[0].reset();
    $('.form-group').removeClass('input-warning-o');
    $('.help-block').empty();

    $('.optionBlockContainer').empty();
    $('#inclusionTable tbody tr:gt(0)').remove();
    $('#specialReqTable tbody tr:gt(0)').remove();

    $('#quotation_property_inclusion_type').prop('checked', false);
    $('#quotation_special_requirement_type').prop('checked', false);
    $('#inclusionBox').hide();
    $('#specialReqBox').hide();

    

    optionCount = 0;

    $.ajax({
        url: "<?php echo base_url();?>index.php/Quotation/ajax_edit/" + id,
        type: "GET",
        dataType: "JSON",
        success: function(res)
        {
            if (!res.status) {
                window.isQuotationEditLoading = false;
                alert(res.message || 'Failed to load quotation');
                return;
            }

            const q = res.quotation || {};

            $('[name="id"]').val(q.quotation_id || '');
            $('[name="quotation_date"]').val(q.quotation_date || '');
            $('[name="arriving_destination"]').val(q.arriving_destination || '');
            $('[name="departuring_destination"]').val(q.departuring_destination || '');
            $('[name="quotation_remarks"]').val(q.quotation_remarks || '');

            const leads_id = q.leads_id_fk || '';

            // ✅ support both possible column names
            const package_id = q.packages_id_fk || q.package_id_fk || q.pacakage_id_fk || '';

            if (q.leads_id_fk) {
            var leadText = q.leads_number
                ? q.leads_number + ' - ' + q.guest_name
                : q.guest_name;

            var leadOption = new Option(leadText, q.leads_id_fk, true, true);
            $('#leads_id').data('filter-mode', 'edit').empty().append(leadOption).trigger('change.select2');
            $('#leads_id').prop('disabled', true);
            $('#leads_id_hidden').val(q.leads_id_fk);
        }

            // $('#leads_id').val(leads_id).trigger('change.select2');
            // $('#leads_id_hidden').val(leads_id);
            // Lead disable
// $('[name="leads_id"]').prop('disabled', true).trigger('change.select2');
// $('#leads_id_hidden').val(leads_id);

            $('#packages_id_hidden').val(package_id);

            if (!leads_id || !package_id) {
                window.isQuotationEditLoading = false;
                alert('Lead or Template missing');
                return;
            }

            // Disable template dropdown while loading for edit
            $('#packages_id_fk').prop('disabled', true)
                .html('<option value="">Loading...</option>')
                .trigger('change.select2');

            $.ajax({
                url: "<?php echo base_url(); ?>index.php/Quotation/fetch_package_under_lead",
                method: "POST",
                data: {
                    packages_id: package_id,
                    leads_id: leads_id
                },
                success: function(html) {

                    $('#packages_id_fk').html(html);

                    // ✅ do not use normal change here, it may clear modal
                    // $('#packages_id_fk').val(package_id).trigger('change.select2');
                    // $('#packages_id_hidden').val(package_id);

                    $('#packages_id_fk')
    .val(package_id)
    .prop('disabled', true)
    .trigger('change.select2');

$('#packages_id_hidden').val(package_id);

                    $('#QuotationModal').modal('show');
                    $('#QuotationModal .modal-title').text('Edit Quotation Details');
                    $('#btnSave').text('Update');

                    rebuildQuotationOptionBlocks(res.options || [], package_id, function () {

                        loadInclusionAndRequirementDropdownData(function () {

                            if ((res.property_inclusions || []).length > 0) {
                                $('#quotation_property_inclusion_type').prop('checked', true);
                                $('#inclusionBox').show();

                                refillSavedPropertyInclusions(res.property_inclusions || []);
                            }

                            if ((res.special_requirements || []).length > 0) {
                                $('#quotation_special_requirement_type').prop('checked', true);
                                $('#specialReqBox').show();

                                refillSavedSpecialRequirements(res.special_requirements || []);
                            }

                            setTimeout(function () {
                                window.isQuotationEditLoading = false;
                            }, 500);
                        });
                    });

                    setTimeout(function () {
                        window.isQuotationEditLoading = false;
                        $('#addOptionBtn').prop('disabled', false).removeClass('disabled');
                    }, 500);
                },
                error: function () {
                    window.isQuotationEditLoading = false;
                    alert('Failed to load template dropdown');
                }
            });
        },
        error: function ()
        {
            window.isQuotationEditLoading = false;
            alert('Error getting data from ajax');
        }
    });
}

$(document).on('change', '#packages_id_fk', function () {
    if (window.isQuotationEditLoading) {
        return;
    }

    clearQuotationOnPackageChange();
    loadInclusionAndRequirementDropdownData();
});

function loadPackageOptionsIntoDropdown($select, packageId, selectedValue, callback) {
    if (!$select || !$select.length) return;

    $.ajax({
        url: "<?php echo base_url('index.php/Leads/ajax_get_package_property_categories'); ?>",
        type: "GET",
        dataType: "JSON",
        data: { package_id: packageId },
        success: function(res) {

            var rows = (res && res.status && res.data) ? res.data : [];
            var html = '<option value="">Select Template Option</option>';

            for (var i = 0; i < rows.length; i++) {
                html += '<option value="' + rows[i].packages_properties_common_id + '">' +
                            rows[i].packages_properties_common_category_name +
                        '</option>';
            }

            $select.html(html);

            if (selectedValue) {
                $select.val(String(selectedValue));
            }

            if ($.fn.select2) {
                if ($select.hasClass('select2-hidden-accessible')) {
                    $select.select2('destroy');
                }

                $select.select2({
                    width: '100%',
                    placeholder: 'Select Template Option',
                    allowClear: true,
                    dropdownParent: $('#QuotationModal')
                });
            }

            $select.trigger('change.select2');

            if (typeof callback === 'function') {
                callback();
            }
        },
        error: function() {
            $select.html('<option value="">Failed to load options</option>');
            if (typeof callback === 'function') {
                callback();
            }
        }
    });
}

function rebuildQuotationOptionBlocks(options, packageId, doneCallback)
{
    // const $wrap = $('.optionBlockContainer');
    const $wrap = $('#optionsContainer').length ? $('#optionsContainer') : $('.optionBlockContainer');
    $wrap.empty();
    optionCount = 0;

    if (!options || !options.length) {
        if (typeof doneCallback === 'function') doneCallback();
        return;
    }

    let completed = 0;

    options.forEach(function(opt) {

        optionCount++;
        $wrap.append(getOptionTemplate(optionCount));

        const $block = $wrap.children('.optionBlock').last();

        $block.attr('data-option-id', opt.quotation_options_id || '');
        $block.find('[name="quotation_options_title[]"]').val(opt.quotation_options_title || '');
        $block.find('[name="quotation_options_cab_amount[]"]').val(opt.quotation_options_cab_amount || '');
        // $block.find('[name="quotation_options_design_type[]"]').val(opt.quotation_options_design_type || '').trigger('change');
        // $block.find('[name="quotation_options_vehicle_id_fk[]"]').val(opt.quotation_options_vehicle_id_fk || '').trigger('change');

        // Select Design
        const $design = $block.find('[name="quotation_options_design_type[]"]');

        if ($.fn.select2 && !$design.hasClass('select2-hidden-accessible')) {
            $design.select2({
                width: '100%',
                placeholder: 'Select Design',
                allowClear: true,
                dropdownParent: $('#QuotationModal')
            });
        }

        $design.val(String(opt.quotation_options_design_type || '')).trigger('change.select2');


        // Select Vehicle
        const $vehicle = $block.find('[name="quotation_options_vehicle_id_fk[]"]');

        fetchVehicles($vehicle[0], function () {
            $vehicle.val(String(opt.quotation_options_vehicle_id_fk || '')).trigger('change.select2');
        });

        $block.find('[name="quotation_options_room_category_display[]"]').prop(
            'checked',
            parseInt(opt.quotation_options_room_category_display || 0) === 1
        );

        $block.find('[name="quotation_options_meal_plan_display[]"]').prop(
            'checked',
            parseInt(opt.quotation_options_meal_plan_display || 0) === 1
        );

        $block.find('[name="quotation_options_vehicle_display[]"]')
    .prop('checked', parseInt(opt.quotation_options_vehicle_display || 0) === 1);

        // load package option dropdown, then render saved itinerary
        loadPackageOptionsIntoDropdown(
            $block.find('.propertyDropdown'),
            packageId,
            opt.packages_properties_common_id_fk,
            function () {
                buildSavedOptionItinerary($block, opt);

                completed++;
                if (completed === options.length) {
                    if (typeof doneCallback === 'function') doneCallback();
                }
            }
        );
    });
}

function formatItineraryDayDate(dateStr)
{
    if (!dateStr || dateStr === '0000-00-00') return '';

    var parts = dateStr.split('-');
    if (parts.length !== 3) return dateStr;

    var d = new Date(parts[0], parts[1] - 1, parts[2]);

    var days = ['Sun', 'Mon', 'Tue', 'Wed', 'Thu', 'Fri', 'Sat'];
    var months = ['Jan', 'Feb', 'Mar', 'Apr', 'May', 'Jun',
                  'Jul', 'Aug', 'Sep', 'Oct', 'Nov', 'Dec'];

    return days[d.getDay()] + ', ' + parts[2] + ' ' + months[d.getMonth()] + ' ' + parts[0];
}

function buildSavedOptionItinerary($block, optionData)
{
    const container = $block.find('.itineraryContainer');
    if (!container.length) return;

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

    (optionData.days || []).forEach(function(day) {

        let propertiesHTML = '';

        (day.properties || []).forEach(function(property) {

            let roomsHTML = '';

            (property.rooms || []).forEach(function(room) {
                const finalRate = parseFloat(room.manual_total_rate || room.auto_total_rate || room.total_room_cost || 0).toFixed(2);

                roomsHTML += `
                    <tr data-room-id="${room.quotation_properties_rooms_id_fk || ''}"
                        data-packages-room-id="${room.packages_properties_rooms_id_fk || 0}"
                        data-day-id="${day.packages_properties_days_id_fk || 0}">
                        <td class="roomName">
                            ${room.properties_room_category_name || ''}
                            <input type="hidden" name="packages_properties_rooms_id_fk[]" value="${room.packages_properties_rooms_id_fk || 0}">
                            <input type="hidden" name="quotation_properties_rooms_id_fk[]" value="${room.quotation_properties_rooms_id_fk || 0}">
                            <input type="hidden" name="quotation_room_tariff_details_id[]" class="quotationRoomTariffDetailsIdInput" value="${room.quotation_room_tariff_details_id || ''}">
                        </td>
                        <td>
                            <span class="autoCalcRateText">${finalRate}</span>
                            <input type="hidden" name="total_room_cost[][]" class="autoCalcRateInput" value="${finalRate}">
                        </td>
                        <td class="text-center">
                            <button type="button"
                                class="btn btn-sm btn-warning me-1 editRoomBtn"
                                data-lead-id="${$('#leads_id_hidden').val() || $('#leads_id').val() || ''}"
                                data-property-day-id="${day.packages_properties_days_id_fk || ''}"
                                data-stay-destination-id="${day.quotation_properties_days_destination_id_fk || ''}"
                                data-property-id="${property.properties_id_fk || ''}"
                                data-room-category-id="${room.quotation_properties_rooms_id_fk || ''}">
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
                     data-property-id="${property.properties_id_fk || ''}"
                     data-packages-property-id="${property.packages_properties_id_fk || 0}">
                    <h6 class="fw-bold text-primary propertyTitle">
                        Property: ${property.properties_name || ''}
                    </h6>

                    <input type="hidden" name="packages_properties_id_fk[]" value="${property.packages_properties_id_fk || 0}">
                    <input type="hidden" name="properties_id_fk[]" value="${property.properties_id_fk || 0}">

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

        html += `
            

            <tr class="itineraryDayRow"
                data-accommodation-date="${day.accommodation_date || ''}">
                <td>
                    <strong>${day.quotation_properties_days_day || ''}</strong>

                    ${
                        day.accommodation_date
                        ? `<div >${formatItineraryDayDate(day.accommodation_date)}</div>`
                        : ''
                    }
                    
                    <input type="hidden" name="packages_itinerary_days_id_fk[]" value="${day.packages_itinerary_days_id_fk || 0}">
                           

                    <input type="hidden" name="packages_properties_days_id_fk[]" value="${day.packages_properties_days_id_fk || 0}">
                    <input type="hidden" name="quotation_properties_days_day[]" value="${day.quotation_properties_days_day || ''}">
                     <input type="hidden" name="accommodation_plan_id_fk[]" value="${day.accommodation_plan_id_fk || 0}">
                </td>

                <td>
                    ${day.state_name || day.destination_name || ''}
                    <input type="hidden" name="quotation_properties_days_destination_id_fk[]" value="${day.quotation_properties_days_destination_id_fk || 0}">
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

    html += `</tbody></table>
    <div class="option-total-box border rounded p-3 mt-4 bg-light">

    <div class="row g-3 align-items-end">

        <!-- Total Cost -->
        <div class="col-md-3">
        <label class="form-label fw-semibold">Total Cost</label>
        <div class="fw-bold text-primary fs-5">
            ₹ <span class="optionTotalCostText">
            ${parseFloat(optionData.quotation_options_total_cost || 0).toFixed(2)}
            </span>
        </div>
        <input type="hidden"
                class="optionTotalCostInput"
                name="option_total_cost[]"
                value="${parseFloat(optionData.quotation_options_total_cost || 0).toFixed(2)}">
        </div>

        <!-- Amount Type -->
        <div class="col-md-3">
        <label class="form-label fw-semibold">Amount Type</label>
        <div class="d-flex gap-2">

            <select class="form-select form-select-sm optionAmountType" style="width:55%;">
            <option value="net" ${optionData.quotation_options_amount_type === 'net' ? 'selected' : ''}>Net Amount</option>
            <option value="adult" ${optionData.quotation_options_amount_type === 'adult' ? 'selected' : ''}>Per Adult</option>
            <option value="person" ${optionData.quotation_options_amount_type === 'person' ? 'selected' : ''}>Per Person</option>
            <option value="couple" ${optionData.quotation_options_amount_type === 'couple' ? 'selected' : ''}>Per Couple</option>
            </select>

            <input type="number"
                class="form-control form-control-sm optionPerAmount ${optionData.quotation_options_amount_type !== 'net' ? '' : 'd-none'}"
                style="width:45%;"
                placeholder="Amount"
                value="${optionData.quotation_options_per_amount || ''}">

        </div>
        </div>

        <!-- Margin -->
        <div class="col-md-3">
        <label class="form-label fw-semibold">Margin</label>
        <div class="d-flex gap-2">

            <select class="form-select form-select-sm optionMarginType" style="width:45%;">
            <option value="amount" ${optionData.quotation_options_margin_type === 'amount' ? 'selected' : ''}>Amount</option>
            <option value="percent" ${optionData.quotation_options_margin_type === 'percent' ? 'selected' : ''}>%</option>
            </select>

            <input type="number"
                class="form-control form-control-sm optionMarginValue"
                style="width:55%;"
                placeholder="Margin"
                value="${optionData.quotation_options_margin_value || 0}">

        </div>
        </div>

        <!-- Total Quote -->
        <div class="col-md-3 text-end">
        <label class="form-label fw-semibold">Total Quote Rate</label>
        <div class="fw-bold text-primary fs-4">
            ₹ <span class="optionQuoteTotalText">
            ${parseFloat(optionData.quotation_options_total_quote_rate || 0).toFixed(2)}
            </span>
        </div>
        <input type="hidden"
                class="optionQuoteTotalInput"
                name="option_quote_total[]"
                value="${parseFloat(optionData.quotation_options_total_quote_rate || 0).toFixed(2)}">
        </div>

    </div>
    </div>`;

    container.html(html);
}


function refillSavedPropertyInclusions(rows)
{
    if (!rows || !rows.length) return;

    $('#quotation_property_inclusion_type').prop('checked', true);
    $('#inclusionBox').show();

    const $tbody = $('#inclusionTable tbody');
    $tbody.find('tr:gt(0)').remove();

    rows.forEach(function(row, idx) {

        if (idx > 0) {
            const tbody = document.querySelector('#inclusionTable tbody');
            tbody.insertAdjacentHTML('beforeend', createInclusionRow());
        }

        const $tr = $tbody.find('tr').eq(idx);

        const packageOptionId = String(row.package_option_id_fk || '');
        const dayKey = [
            row.packages_properties_days_id_fk || '',
            row.stay_destination_id_fk || '',
            row.accommodation_date || ''
        ].join('|');

        const propertyId  = String(row.inclusion_property_id_fk || row.properties_id_fk || row.property_id_fk || '');
        const inclusionId = String(row.property_inclusions_id_fk || row.inclusion_name_id_fk || '');

        // package option
        fillInclusionPackageOptionSelect($tr.find('.inclusionPackageOptionSelect')[0]);
        setSelectValueSafe($tr.find('.inclusionPackageOptionSelect'), packageOptionId, 'Selected Template Option');

        // ✅ same as special requirement day dropdown
        fillDaySelect($tr.find('.inclusionDaySelect')[0]);
        setSelectValueSafe($tr.find('.inclusionDaySelect'), dayKey, buildSavedDayLabel(row));

        // load property based on selected day + package option
        // loadInclusionPropertiesForRow($tr, function () {

        //     setSelectValueSafe(
        //         $tr.find('.inclusionPropertySelect'),
        //         propertyId,
        //         row.property_name || row.properties_name || 'Selected Property'
        //     );

        //     loadInclusionNamesForRow($tr, function () {

        //         setSelectValueSafe(
        //             $tr.find('.inclusionNameSelect'),
        //             inclusionId,
        //             row.inclusion_name || row.property_inclusions_name || 'Selected Inclusion'
        //         );

        //         $tr.find('.inclusionAmountInput').val(row.inclusion_amount || '');
        //         recalcInclusionTotal();
        //     });
        // });
        // 1. set package option
$tr.find('.inclusionPackageOptionSelect')
   .val(row.package_option_id_fk || '')
   .trigger('change.select2');

// 2. load days
loadInclusionDaysForRow($tr, row.package_option_id_fk, dayKey, function () {

    // 3. select saved day
    $tr.find('.inclusionDaySelect')
       .val(dayKey)
       .trigger('change.select2');

    // 4. load properties
    // loadInclusionPropertiesForRow($tr, function () {

    //     var propSel = $tr.find('.inclusionPropertySelect')[0];

    //     $(propSel)
    //         .val(row.inclusion_property_id_fk || '')
    //         .trigger('change.select2');

    //     enableSelect2(propSel, 'Select Property');

    //     // 5. load inclusions
    //     loadInclusionNamesForRow($tr, function () {

    //         var incSel = $tr.find('.inclusionNameSelect')[0];

    //         $(incSel)
    //             .val(row.property_inclusions_id_fk || '')
    //             .trigger('change.select2');

    //         enableSelect2(incSel, 'Select Inclusion');

    //         $tr.find('.inclusionAmountInput').val(row.inclusion_amount || '');

    //         recalcInclusionTotal();
    //     });
    // });
    loadInclusionPropertiesForRow($tr, function () {

    var propSel = $tr.find('.inclusionPropertySelect')[0];

    var savedPropertyId = String(row.inclusion_property_id_fk || row.properties_id_fk || row.property_id_fk || '');

    setSelectValueSafe(
        $(propSel),
        savedPropertyId,
        row.property_name || row.properties_name || 'Selected Property'
    );

    enableSelect2(propSel, 'Select Property');

    // loadInclusionNamesForRow($tr, function () {

    //     var incSel = $tr.find('.inclusionNameSelect')[0];

    //     var savedInclusionId = String(row.property_inclusions_id_fk || row.inclusion_name_id_fk || '');

    //     setSelectValueSafe(
    //         $(incSel),
    //         savedInclusionId,
    //         row.inclusion_name || row.property_inclusions_name || 'Selected Inclusion'
    //     );

    //     enableSelect2(incSel, 'Select Inclusion');

    //     $tr.find('.inclusionAmountInput').val(row.inclusion_amount || '');

    //     recalcInclusionTotal();
    // });

    loadInclusionNamesForRow($tr, function () {

        var incSel = $tr.find('.inclusionNameSelect')[0];

        var savedInclusionId = String(
            row.property_inclusions_id_fk ||
            row.inclusion_name_id_fk ||
            ''
        );

        // ✅ if saved inclusion exists but not in loaded dropdown, add it
        if (savedInclusionId && $(incSel).find('option[value="' + savedInclusionId + '"]').length === 0) {
            $(incSel).append(
                '<option value="' + savedInclusionId + '">' +
                (row.inclusion_name || row.property_inclusions_name || 'Selected Inclusion') +
                '</option>'
            );
        }

        // ✅ select from all loaded inclusions
        $(incSel)
            .val(savedInclusionId)
            .prop('disabled', false)
            .trigger('change.select2');

        enableSelect2(incSel, 'Select Inclusion');

        $tr.find('.inclusionAmountInput').val(row.inclusion_amount || '');

        recalcInclusionTotal();
    });
});
});
    });
}

function buildSavedDayLabel(row) {
    return 'Day ' + (row.quotation_properties_days_day || row.packages_properties_days_day || '') +
           ' | ' + formatDateDMY(row.accommodation_date || '') +
           ' | ' + (row.state_name || row.destination_name || '');
}

function setSelectValueSafe($select, value, text) {
    value = String(value || '');

    if (!$select.length || !value) return;

    if ($select.find('option[value="' + value + '"]').length === 0) {
        $select.append('<option value="' + value + '">' + (text || value) + '</option>');
    }

    $select.val(value).trigger('change.select2');
}

function buildSavedDayLabelByKey(dayId, destinationId, accDate)
{
    var label = 'Saved Day';

    $('.optionBlock .itineraryDayRow').each(function () {
        var rowDayId = $(this).find('input[name="packages_properties_days_id_fk[]"]').val() || '';
        var rowDestId = $(this).find('input[name="quotation_properties_days_destination_id_fk[]"]').val() || '';
        var rowDate = $(this).attr('data-accommodation-date') || '';

        if (String(rowDayId) === String(dayId)) {
            var dayText = $(this).find('td:eq(0) strong').text().trim();
            var destinationText = $(this).find('td:eq(1)').clone().children().remove().end().text().trim();

            var dateText = rowDate ? formatItineraryDayDate(rowDate) : (accDate ? formatItineraryDayDate(accDate) : '');

            label = dayText;

            if (dateText) {
                label += ' | ' + dateText;
            }

            if (destinationText) {
                label += ' | ' + destinationText;
            }

            return false;
        }
    });

    return label;
}

function loadInclusionDaysForRow($tr, packageOptionId, savedDayKey, callback)
{
    var daySel = $tr.find('.inclusionDaySelect')[0];
    var html = '<option value="">Select Day | Date | Destination</option>';

    $('.optionBlock').each(function () {
        var selectedOptionId = $(this).find('.propertyDropdown').val() || '';

        if (String(selectedOptionId) === String(packageOptionId)) {

            $(this).find('.itineraryDayRow').each(function () {

                var dayText = $(this).find('td:eq(0) strong').text().trim();
                var destinationText = $(this).find('td:eq(1)').clone().children().remove().end().text().trim();

                var packagesPropertiesDaysId =
                    $(this).find('input[name="packages_properties_days_id_fk[]"]').val() || '';

                var destinationId =
                    $(this).find('input[name="quotation_properties_days_destination_id_fk[]"]').val() || '';

                var accommodationDate =
                    $(this).attr('data-accommodation-date') || '';

                if (packagesPropertiesDaysId) {
                    var dayKey = packagesPropertiesDaysId + '|' + destinationId + '|' + accommodationDate;
                    // html += '<option value="' + dayKey + '">' + dayText + ' | ' + destinationText + '</option>';

                    var dateText = accommodationDate ? formatItineraryDayDate(accommodationDate) : '';

                    var label = dayText;
                    if (dateText) label += ' | ' + dateText;
                    if (destinationText) label += ' | ' + destinationText;

                    html += '<option value="' + dayKey + '">' + label + '</option>';
                }
            });
        }
    });

    $(daySel).html(html);
    initSelect2(daySel, 'Select Day | Date | Destination');

    // if (savedDayKey && $(daySel).find('option[value="' + savedDayKey + '"]').length === 0) {
    //     $(daySel).append('<option value="' + savedDayKey + '">Saved Day</option>');
    // }

    if (savedDayKey && $(daySel).find('option[value="' + savedDayKey + '"]').length === 0) {

        var savedParts = savedDayKey.split('|');

        var savedDayId = savedParts[0] || '';
        var savedDestinationId = savedParts[1] || '';
        var savedDate = savedParts[2] || '';

        var savedLabel = buildSavedDayLabelByKey(savedDayId, savedDestinationId, savedDate);

        $(daySel).append(
            '<option value="' + savedDayKey + '">' + savedLabel + '</option>'
        );
    }

    if (typeof callback === 'function') callback();
}

loadInclusionPropertiesForRow($tr, function () {
    var propSel = $tr.find('.inclusionPropertySelect')[0];

    $(propSel).val(row.inclusion_property_id_fk || '').trigger('change.select2');
    enableSelect2(propSel, 'Select Property');

    loadInclusionNamesForRow($tr, function () {
        var incSel = $tr.find('.inclusionNameSelect')[0];

        $(incSel).val(row.property_inclusions_id_fk || '').trigger('change.select2');
        enableSelect2(incSel, 'Select Inclusion');

        $tr.find('.inclusionAmountInput').val(row.inclusion_amount || '');
        recalcInclusionTotal();
    });
});

// function loadInclusionPropertiesForRow($tr, callback)
// {
//     var dayKey = $tr.find('.inclusionDaySelect').val() || '';
//     var leadId = $('#leads_id_hidden').val() || $('#leads_id').val() || '';
//     var packageId = $('#packages_id_hidden').val() || $('#packages_id_fk').val() || '';
//     var packageOptionId = $tr.find('.inclusionPackageOptionSelect').val() || '';

//     var propSel = $tr.find('.inclusionPropertySelect')[0];
//     var incSel = $tr.find('.inclusionNameSelect')[0];

//     clearPropertySelect(propSel);
//     clearInclusionSelect(incSel);

//     if (!dayKey || !leadId || !packageId || !packageOptionId) {
//         if (typeof callback === 'function') callback();
//         return;
//     }

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

//         $(propSel).html(html);
//         initSelect2(propSel, 'Select Property');

//         if (typeof callback === 'function') callback();
//     })
//     .catch(function (err) {
//         console.error(err);
//         if (typeof callback === 'function') callback();
//     });
// }

function loadInclusionPropertiesForRow($tr, callback)
{
    var dayKey = $tr.find('.inclusionDaySelect').val() || '';
    var leadId = $('#leads_id_hidden').val() || $('#leads_id').val() || '';
    var packageId = $('#packages_id_hidden').val() || $('#packages_id_fk').val() || '';
    var packageOptionId = $tr.find('.inclusionPackageOptionSelect').val() || '';

    var propSel = $tr.find('.inclusionPropertySelect')[0];
    var incSel  = $tr.find('.inclusionNameSelect')[0];

    // disable while loading
    setSelect2Loading(propSel, 'Loading Property...');
    setSelect2Empty(incSel, 'Select Inclusion');

    if (!dayKey || !leadId || !packageId || !packageOptionId) {
        setSelect2Empty(propSel, 'Select Property');

        if (typeof callback === 'function') callback();
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

            // enable after data loaded
            setSelect2Ready(propSel, html, 'Select Property');
        } else {
            setSelect2Empty(propSel, 'No Property Found');
        }

        if (typeof callback === 'function') callback();

        refreshQuotationModalScroll(true);
    })
    .catch(function (err) {
        console.error(err);

        setSelect2Empty(propSel, 'Failed to load Property');

        if (typeof callback === 'function') callback();

        refreshQuotationModalScroll(true);
    });
}

// function loadInclusionNamesForRow($tr, callback)
// {
//     var propertyId = $tr.find('.inclusionPropertySelect').val() || '';
//     var incSel = $tr.find('.inclusionNameSelect')[0];

//     clearInclusionSelect(incSel);

//     if (!propertyId) {
//         if (typeof callback === 'function') callback();
//         return;
//     }

//     fetch(
//         `<?php echo base_url(); ?>index.php/Quotation/ajax_get_property_inclusions?property_id=${encodeURIComponent(propertyId)}`
//     )
//     .then(function (r) { return r.json(); })
//     .then(function (res) {
//         var html = '<option value="">Select Inclusion</option>';

//         if (res && res.status && Array.isArray(res.data)) {
//             res.data.forEach(function (p) {
//                 html += '<option value="' + p.property_inclusions_id + '" data-amount="' + (p.property_inclusions_amount || 0) + '">' +
//                     p.property_inclusions_name +
//                 '</option>';
//             });
//         }

//         $(incSel).html(html);
//         initSelect2(incSel, 'Select Inclusion');

//         if (typeof callback === 'function') callback();
//     })
//     .catch(function (err) {
//         console.error(err);
//         if (typeof callback === 'function') callback();
//     });
// }

function loadInclusionNamesForRow($tr, callback)
{
    var propertyId = $tr.find('.inclusionPropertySelect').val() || '';
    var incSel = $tr.find('.inclusionNameSelect')[0];

    // 🔒 disable + show loading
    setSelect2Loading(incSel, 'Loading Inclusion...');

    if (!propertyId) {
        setSelect2Empty(incSel, 'Select Inclusion');

        if (typeof callback === 'function') callback();
        return;
    }

    fetch(
        `<?php echo base_url(); ?>index.php/Quotation/ajax_get_property_inclusions_by_property?property_id=${encodeURIComponent(propertyId)}`
    )
    .then(function (r) { return r.json(); })
    .then(function (res) {

        var html = '<option value="">Select Inclusion</option>';

        if (res && res.status && Array.isArray(res.data) && res.data.length > 0) {

            res.data.forEach(function (p) {
                html += '<option value="' + p.property_inclusions_id + '" data-amount="' + (p.property_inclusions_amount || 0) + '">' +
                            p.property_inclusions_name +
                        '</option>';
            });

            // ✅ enable after load
            setSelect2Ready(incSel, html, 'Select Inclusion');

        } else {
            setSelect2Empty(incSel, 'No Inclusion Found');
        }

        if (typeof callback === 'function') callback();

        refreshQuotationModalScroll(true);
    })
    .catch(function (err) {
        console.error(err);

        setSelect2Empty(incSel, 'Failed to load Inclusion');

        if (typeof callback === 'function') callback();

        refreshQuotationModalScroll(true);
    });
}

function refillSavedSpecialRequirements(rows)
{
    if (!rows || !rows.length) return;

    $('#quotation_special_requirement_type').prop('checked', true).trigger('change');

    const $tbody = $('#specialReqTable tbody');
    $tbody.find('tr:gt(0)').remove();

    rows.forEach(function(row, idx) {

        if (idx > 0) {
            $('#addSpecialReqBtn').trigger('click');
        }

        const $tr = $tbody.find('tr').eq(idx);

        const dayKey = [
            row.packages_properties_days_id_fk || '',
            row.stay_destination_id_fk || '',
            row.accommodation_date || ''
        ].join('|');

        $tr.find('.specialReqDaySelect').val(dayKey).trigger('change');
        $tr.find('.specialReqSelect').val(row.quotation_special_requirements_id_fk || '').trigger('change');
        $tr.find('.specialReqCost').val(row.quotation_special_requirements_cost || '');
    });

    recalcSpecialReqTotal();
}
////***For editing quotation details from adding modal form  *****///

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
