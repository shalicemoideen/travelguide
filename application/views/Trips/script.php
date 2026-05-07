<script type="text/javascript">

////***Select2 option *****///

$("#quotation_number_filter").select2({
  // dropdownParent: $("#LeadsModal"),
  minimumResultsForSearch: 0
});

$("#leads_id_filter").select2({
  // dropdownParent: $("#LeadsModal"),
  minimumResultsForSearch: 0
});

$("#package_id_filter").select2({
  // dropdownParent: $("#LeadsModal"),
  minimumResultsForSearch: 0
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
  minimumResultsForSearch: 0
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
toggleAddOptionBtn();
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



$('#start_date').bootstrapMaterialDatePicker({
    weekStart: 0,
    time: false,
    format: 'DD/MM/YYYY'
})

$('#end_date').bootstrapMaterialDatePicker({
    weekStart: 0,
    time: false,
    format: 'DD/MM/YYYY'
})
 
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

$( "#arriving_destination_filter" ).keypress(function() {
            $table.ajax.reload();
});
$( "#departuring_destination_filter" ).keypress(function() {
            $table.ajax.reload();
});
////***searching button*****///

////***Listing table*****///

var save_method; //for save method string
var table;
  $(document).ready(function() {
    
    
    $table = $('#Trip_registration').DataTable( {
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
                                        columns: [0, 1, 2, 3, 4, 5, 6, 7]
                                    }
                                },
                                {
                                    extend: 'pdf',
                                    exportOptions: {
                                        columns: [0, 1, 2, 3, 4, 5, 6, 7]
                                    }
                                },
                                {
                                    extend: 'print',
                                    exportOptions: {
                                        columns: [0 ,1, 2, 3, 4, 5, 6, 7]
                                    }
                                },
                               
            ],
        "ajax": {
            "url": "<?php echo base_url();?>index.php/Trips/get/",
            "type": "POST",
            "data" : function (d) {
                        d.quotation_number_filter = $("#quotation_number_filter").val();
                        d.leads_id_filter = $("#leads_id_filter").val();
                        d.package_id_filter = $("#package_id_filter").val();
                        d.arriving_destination_filter = $("#arriving_destination_filter").val();
                        d.departuring_destination_filter = $("#departuring_destination_filter").val();
                        d.quotation_current_status_filter = $("#quotation_current_status_filter").val();
                        d.quotation_created_by_userid = $("#quotation_created_by_userid").val();
                        d.start_date = $("#start_date").val();
                        d.end_date = $("#end_date").val();
                        
                       
           }            
        },
        "createdRow": function ( row, data, index ) {
          
//            $('td',row).eq(0).html(index+1);
           $table.column(0).nodes().each(function(node,index,dt){
            $table.cell(node).data(index+1);
            });
            
            
            

            if(data['lead_current_status'] == 1){
              $('td', row).eq(10).html('<span class="badge badge-secondary">Generated</span>');
              $('td', row).eq(12).html('<div class="dropdown ms-auto text-end"><div class="btn-link" data-bs-toggle="dropdown"><svg width="24px" height="24px" viewBox="0 0 24 24" version="1.1"><g stroke="none" stroke-width="1" fill="none" fill-rule="evenodd"><rect x="0" y="0" width="24" height="24"></rect><circle fill="#000000" cx="5" cy="12" r="2"></circle><circle fill="#000000" cx="12" cy="12" r="2"></circle><circle fill="#000000" cx="19" cy="12" r="2"></circle></g></svg></div><div class="dropdown-menu dropdown-menu-end"><a class="dropdown-item" href="javascript:void(0)" id="rt" onclick="change_status('+data['quotation_id']+')">Change status</a><a class="dropdown-item" href="javascript:void(0)" id="rt" onclick="update_itinerary('+data['quotation_id']+')">Edit Itinerary</a><a class="dropdown-item" target="_blank" href="<?php echo base_url();?>index.php/Quotation/quotation_preview/'+data['quotation_id']+'" >Preview</a><a class="dropdown-item" href="javascript:void(0)" id="rt" onclick="edit_quotation('+data['quotation_id']+')">Edit</a><a class="dropdown-item" href="javascript:void(0)" onclick="return delete_quotation('+data['quotation_id']+')">Delete</a></div></div>');

            }
            else if(data['lead_current_status'] == 2){
              $('td', row).eq(10).html('<span class="badge badge-light">Draft</span>');
              $('td', row).eq(12).html('<div class="dropdown ms-auto text-end"><div class="btn-link" data-bs-toggle="dropdown"><svg width="24px" height="24px" viewBox="0 0 24 24" version="1.1"><g stroke="none" stroke-width="1" fill="none" fill-rule="evenodd"><rect x="0" y="0" width="24" height="24"></rect><circle fill="#000000" cx="5" cy="12" r="2"></circle><circle fill="#000000" cx="12" cy="12" r="2"></circle><circle fill="#000000" cx="19" cy="12" r="2"></circle></g></svg></div><div class="dropdown-menu dropdown-menu-end"><a class="dropdown-item" href="javascript:void(0)" id="rt" onclick="change_status('+data['quotation_id']+')">Change status</a><a class="dropdown-item" href="javascript:void(0)" id="rt" onclick="update_itinerary('+data['quotation_id']+')">Edit Itinerary</a><a class="dropdown-item" target="_blank" href="<?php echo base_url();?>index.php/Quotation/quotation_preview/'+data['quotation_id']+'" >Preview</a><a class="dropdown-item" href="javascript:void(0)" id="rt" onclick="edit_quotation('+data['quotation_id']+')">Edit</a><a class="dropdown-item" href="javascript:void(0)" onclick="return delete_quotation('+data['quotation_id']+')">Delete</a></div></div>');
            }
            else if(data['lead_current_status'] == 3){
              $('td', row).eq(10).html('<span class="badge badge-info">Sent</span>');
              $('td', row).eq(12).html('<div class="dropdown ms-auto text-end"><div class="btn-link" data-bs-toggle="dropdown"><svg width="24px" height="24px" viewBox="0 0 24 24" version="1.1"><g stroke="none" stroke-width="1" fill="none" fill-rule="evenodd"><rect x="0" y="0" width="24" height="24"></rect><circle fill="#000000" cx="5" cy="12" r="2"></circle><circle fill="#000000" cx="12" cy="12" r="2"></circle><circle fill="#000000" cx="19" cy="12" r="2"></circle></g></svg></div><div class="dropdown-menu dropdown-menu-end"><a class="dropdown-item" href="javascript:void(0)" id="rt" onclick="change_status('+data['quotation_id']+')">Change status</a><a class="dropdown-item" href="javascript:void(0)" id="rt" onclick="update_itinerary('+data['quotation_id']+')">Edit Itinerary</a><a class="dropdown-item" target="_blank" href="<?php echo base_url();?>index.php/Quotation/quotation_preview/'+data['quotation_id']+'" >Preview</a><a class="dropdown-item" href="javascript:void(0)" id="rt" onclick="edit_quotation('+data['quotation_id']+')">Edit</a><a class="dropdown-item" href="javascript:void(0)" onclick="return delete_quotation('+data['quotation_id']+')">Delete</a></div></div>');
            }
            else if(data['lead_current_status'] == 4){
              $('td', row).eq(10).html('<span class="badge badge-danger">Rejected</span>');
              $('td', row).eq(12).html('<div class="dropdown ms-auto text-end"><div class="btn-link" data-bs-toggle="dropdown"><svg width="24px" height="24px" viewBox="0 0 24 24" version="1.1"><g stroke="none" stroke-width="1" fill="none" fill-rule="evenodd"><rect x="0" y="0" width="24" height="24"></rect><circle fill="#000000" cx="5" cy="12" r="2"></circle><circle fill="#000000" cx="12" cy="12" r="2"></circle><circle fill="#000000" cx="19" cy="12" r="2"></circle></g></svg></div><div class="dropdown-menu dropdown-menu-end"><a class="dropdown-item" href="javascript:void(0)" id="rt" onclick="change_status('+data['quotation_id']+')">Change status</a><a class="dropdown-item" href="javascript:void(0)" id="rt" onclick="update_itinerary('+data['quotation_id']+')">Edit Itinerary</a><a class="dropdown-item" target="_blank" href="<?php echo base_url();?>index.php/Quotation/quotation_preview/'+data['quotation_id']+'" >Preview</a><a class="dropdown-item" href="javascript:void(0)" id="rt" onclick="edit_quotation('+data['quotation_id']+')">Edit</a><a class="dropdown-item" href="javascript:void(0)" onclick="return delete_quotation('+data['quotation_id']+')">Delete</a></div></div>');
            }
            else if(data['lead_current_status'] == 5){
              $('td', row).eq(10).html('<span class="badge badge-success">Accepted</span>');
              $('td', row).eq(12).html('<div class="dropdown ms-auto text-end"><div class="btn-link" data-bs-toggle="dropdown"><svg width="24px" height="24px" viewBox="0 0 24 24" version="1.1"><g stroke="none" stroke-width="1" fill="none" fill-rule="evenodd"><rect x="0" y="0" width="24" height="24"></rect><circle fill="#000000" cx="5" cy="12" r="2"></circle><circle fill="#000000" cx="12" cy="12" r="2"></circle><circle fill="#000000" cx="19" cy="12" r="2"></circle></g></svg></div><div class="dropdown-menu dropdown-menu-end"><a class="dropdown-item" href="javascript:void(0)" id="rt" onclick="change_status('+data['quotation_id']+')">Change status</a><a class="dropdown-item" href="javascript:void(0)" id="rt" onclick="convert_trip('+data['quotation_id']+')">Convert to trips</a><a class="dropdown-item" href="javascript:void(0)" id="rt" onclick="update_itinerary('+data['quotation_id']+')">Edit Itinerary</a><a class="dropdown-item" target="_blank" href="<?php echo base_url();?>index.php/Quotation/quotation_preview/'+data['quotation_id']+'" >Preview</a><a class="dropdown-item" href="javascript:void(0)" id="rt" onclick="edit_quotation('+data['quotation_id']+')">Edit</a><a class="dropdown-item" href="javascript:void(0)" onclick="return delete_quotation('+data['quotation_id']+')">Delete</a></div></div>');
            }
            
           },

           "drawCallback": function( settings ) {
                // displaySelectByUserType();
            },

        "columns": [
            { "data": "trips_status", "orderable": false },
            { "data": "quotation_number", "orderable": false },
            { "data": "leads_number", "orderable": false },
            { "data": "guest_name", "orderable": false },
            { "data": "whats_number", "orderable": false },
            { "data": "arriving_destination", "orderable": false },
            { "data": "departuring_destination", "orderable": false },
            { "data": "trips_travel_start_date", "orderable": false },
            { "data": "duration", "orderable": false },
            { "data": "trips_travel_end_date", "orderable": false },
            { "data": "trips_current_status", "orderable": false },
            { "data": "trips_created_by_username", "orderable": false },                      
            { "data": "trips_id", "orderable": false }
            
            
        ]
        
    });
    
  

  });
    
 
////***Listing table*****///
</script>