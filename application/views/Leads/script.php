<script>
////***Date picker *****///
$('#quotation_date').bootstrapMaterialDatePicker({
    weekStart: 0,
    time: false,
    format: 'DD/MM/YYYY'
}).bootstrapMaterialDatePicker('setDate', moment());

// $('#start_date1').bootstrapMaterialDatePicker({
//          weekStart: 0,
//         time: false,
//         format: 'DD/MM/YYYY'
//     });

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
$('#leads_start_date').bootstrapMaterialDatePicker({
         weekStart: 0,
        time: false,
        format: 'DD/MM/YYYY'
    });

$('#leads_end_date').bootstrapMaterialDatePicker({
         weekStart: 0,
        time: false,
        format: 'DD/MM/YYYY'
    });
$('#travels_start_date').bootstrapMaterialDatePicker({
         weekStart: 0,
        time: false,
        format: 'DD/MM/YYYY'
    });

$('#travels_end_date').bootstrapMaterialDatePicker({
         weekStart: 0,
        time: false,
        format: 'DD/MM/YYYY'
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

////***Latest dropdown select2*****///

$("#lead_type1").select2({
  dropdownParent: $("#LeadsModal"),
  minimumResultsForSearch: 0
});
$("#staff_id_fk1").select2({
  dropdownParent: $("#LeadsModal"),
  minimumResultsForSearch: 0
});
$("#source_id_fk1").select2({
  dropdownParent: $("#LeadsModal"),
  minimumResultsForSearch: 0
});
$("#package_id_fk1").select2({
  dropdownParent: $("#LeadsModal"),
  minimumResultsForSearch: 0
});
$("#country_id_fk1").select2({
  dropdownParent: $("#LeadsModal"),
  minimumResultsForSearch: 0
});
$("#priority_status_id_fk1").select2({
  dropdownParent: $("#LeadsModal"),
  minimumResultsForSearch: 0
});
$("#stage_id_fk1").select2({
  dropdownParent: $("#LeadsModal"),
  minimumResultsForSearch: 0
});
$("#country_id_fk").select2({
  dropdownParent: $("#LeadsModal"),
  minimumResultsForSearch: 0
});
$("#priority_status_id_fk").select2({
  dropdownParent: $("#LeadsModal"),
  minimumResultsForSearch: 0
});
$("#stage_id_fk").select2({
  dropdownParent: $("#LeadsModal"),
  minimumResultsForSearch: 0
});
$("#date_type").select2({
  dropdownParent: $("#LeadsModal"),
  minimumResultsForSearch: 0
});
$("#package_id_fk").select2({
  dropdownParent: $("#LeadsModal"),
  minimumResultsForSearch: 0
});
$("#agent_id_fk").select2({
  dropdownParent: $("#LeadsB2BModal"),
  minimumResultsForSearch: 0
});


////***Latest dropdown select2*****///

////***searching button*****///

$('#search').click(function () {
        
        $table.ajax.reload();
    });

$( "#guest_name_filter" ).keypress(function() {
            $table.ajax.reload();
});

$( "#whats_number_filter" ).keypress(function() {
            $table.ajax.reload();
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

var save_method; //for save method string
var table1;
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
            "url": "<?php echo base_url();?>index.php/Leads/get_b2c/",
            "type": "POST",
            "data" : function (d) {
                        d.staff_id1 = $("#staff_id1").val();
                        d.source_id1 = $("#source_id1").val();
                        d.packages_id1 = $("#packages_id1").val();
                        d.country_id1 = $("#country_id1").val();
                        d.priority_status_id1 = $("#priority_status_id1").val();
                        d.stages_id1 = $("#stages_id1").val();
                        d.lead_type1 = $("#lead_type1").val();
                        d.lead_current_status1 = $("#lead_current_status1").val();
                        d.guest_name_filter1 = $("#guest_name_filter1").val();
                        d.whats_number_filter1 = $("#whats_number_filter1").val();
                        d.leads_createdby_userid1 = $("#leads_createdby_userid1").val();
                        d.leads_start_date1 = $("#leads_start_date1").val();
                        d.leads_end_date1 = $("#leads_end_date1").val();
                        d.travels_start_date1 = $("#travels_start_date1").val();
                        d.travels_end_date1 = $("#travels_end_date1").val();
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
            
            
            
            if(data['lead_current_status'] == 1){
              $('td', row).eq(9).html('<span class="badge badge-info">In take</span>');

              if(data['leads_accomodation_status'] == 0){
              
                $('td', row).eq(13).html('<div class="dropdown ms-auto text-end"><div class="btn-link" data-bs-toggle="dropdown"><svg width="24px" height="24px" viewBox="0 0 24 24" version="1.1"><g stroke="none" stroke-width="1" fill="none" fill-rule="evenodd"><rect x="0" y="0" width="24" height="24"></rect><circle fill="#000000" cx="5" cy="12" r="2"></circle><circle fill="#000000" cx="12" cy="12" r="2"></circle><circle fill="#000000" cx="19" cy="12" r="2"></circle></g></svg></div><div class="dropdown-menu dropdown-menu-end"><a class="dropdown-item" href="javascript:void(0)" id="rt" onclick="openChangeStatusModal('+data['leads_id']+')">Change stage</a><a class="dropdown-item" href="javascript:void(0)" id="rt" onclick="showStatusModal('+data['leads_id']+')">Show stages</a><a class="dropdown-item" href="javascript:void(0)" id="rt"  onclick="guset_count_edit('+data['leads_id']+')">Guest count</a><a class="dropdown-item" href="javascript:void(0)" id="rt" onclick="edit_leads('+data['leads_id']+')">Edit</a><a class="dropdown-item" href="<?php echo base_url();?>index.php/Room_tariff_management/View/'+data['room_tariff_hike_id']+'" >View Details</a><a class="dropdown-item" href="javascript:void(0)" onclick="return delete_leads('+data['leads_id']+')">Delete</a></div></div>');
              }
              
              if(data['leads_accomodation_status'] == 1){

                $('td', row).eq(13).html('<div class="dropdown ms-auto text-end"><div class="btn-link" data-bs-toggle="dropdown"><svg width="24px" height="24px" viewBox="0 0 24 24" version="1.1"><g stroke="none" stroke-width="1" fill="none" fill-rule="evenodd"><rect x="0" y="0" width="24" height="24"></rect><circle fill="#000000" cx="5" cy="12" r="2"></circle><circle fill="#000000" cx="12" cy="12" r="2"></circle><circle fill="#000000" cx="19" cy="12" r="2"></circle></g></svg></div><div class="dropdown-menu dropdown-menu-end"><a class="dropdown-item" href="javascript:void(0)" id="rt" onclick="openChangeStatusModal('+data['leads_id']+')">Change stage</a><a class="dropdown-item" href="javascript:void(0)" id="rt" onclick="showStatusModal('+data['leads_id']+')">Show stages</a><a class="dropdown-item" href="javascript:void(0)" id="rt"  onclick="guset_count_edit('+data['leads_id']+')">Guest count</a><a class="dropdown-item" href="javascript:void(0)" id="rt"  onclick="accomodation_plan('+data['leads_id']+')">Accomodation plan</a><a class="dropdown-item" href="javascript:void(0)" id="rt" onclick="edit_leads('+data['leads_id']+')">Edit</a><a class="dropdown-item" href="<?php echo base_url();?>index.php/Room_tariff_management/View/'+data['room_tariff_hike_id']+'" >View Details</a><a class="dropdown-item" href="javascript:void(0)" onclick="return delete_leads('+data['leads_id']+')">Delete</a></div></div>');

              }

              if(data['leads_accomodation_status'] == 2){

                $('td', row).eq(13).html('<div class="dropdown ms-auto text-end"><div class="btn-link" data-bs-toggle="dropdown"><svg width="24px" height="24px" viewBox="0 0 24 24" version="1.1"><g stroke="none" stroke-width="1" fill="none" fill-rule="evenodd"><rect x="0" y="0" width="24" height="24"></rect><circle fill="#000000" cx="5" cy="12" r="2"></circle><circle fill="#000000" cx="12" cy="12" r="2"></circle><circle fill="#000000" cx="19" cy="12" r="2"></circle></g></svg></div><div class="dropdown-menu dropdown-menu-end"><a class="dropdown-item" href="javascript:void(0)" id="rt" onclick="openChangeStatusModal('+data['leads_id']+')">Change stage</a><a class="dropdown-item" href="javascript:void(0)" id="rt" onclick="showStatusModal('+data['leads_id']+')">Show stages</a><a class="dropdown-item" href="javascript:void(0)" id="rt"  onclick="guset_count_edit('+data['leads_id']+')">Guest count</a><a class="dropdown-item" href="javascript:void(0)" id="rt"  onclick="accomodation_plan('+data['leads_id']+')">Accomodation plan</a><a class="dropdown-item" href="javascript:void(0)" id="rt" onclick="open_quotation('+data['leads_id']+')">Quotation</a><a class="dropdown-item" href="javascript:void(0)" id="rt" onclick="edit_leads('+data['leads_id']+')">Edit</a><a class="dropdown-item" href="<?php echo base_url();?>index.php/Room_tariff_management/View/'+data['room_tariff_hike_id']+'" >View Details</a><a class="dropdown-item" href="javascript:void(0)" onclick="return delete_leads('+data['leads_id']+')">Delete</a></div></div>');

              }

            }
            else if(data['lead_current_status'] == 2){
              $('td', row).eq(9).html('<span class="badge badge-secondary">Qualified</span>');

              if(data['leads_accomodation_status'] == 0){
            
                $('td', row).eq(13).html('<div class="dropdown ms-auto text-end"><div class="btn-link" data-bs-toggle="dropdown"><svg width="24px" height="24px" viewBox="0 0 24 24" version="1.1"><g stroke="none" stroke-width="1" fill="none" fill-rule="evenodd"><rect x="0" y="0" width="24" height="24"></rect><circle fill="#000000" cx="5" cy="12" r="2"></circle><circle fill="#000000" cx="12" cy="12" r="2"></circle><circle fill="#000000" cx="19" cy="12" r="2"></circle></g></svg></div><div class="dropdown-menu dropdown-menu-end"><a class="dropdown-item" href="javascript:void(0)" id="rt" onclick="openChangeStatusModal('+data['leads_id']+')">Change stage</a><a class="dropdown-item" href="javascript:void(0)" id="rt" onclick="showStatusModal('+data['leads_id']+')">Show stages</a><a class="dropdown-item" href="javascript:void(0)" id="rt"  onclick="guset_count_edit('+data['leads_id']+')">Guest count</a><a class="dropdown-item" href="javascript:void(0)" id="rt" onclick="edit_leads('+data['leads_id']+')">Edit</a><a class="dropdown-item" href="<?php echo base_url();?>index.php/Room_tariff_management/View/'+data['room_tariff_hike_id']+'" >View Details</a><a class="dropdown-item" href="javascript:void(0)" onclick="return delete_leads('+data['leads_id']+')">Delete</a></div></div>');
              }
              
              if(data['leads_accomodation_status'] == 1){

                $('td', row).eq(13).html('<div class="dropdown ms-auto text-end"><div class="btn-link" data-bs-toggle="dropdown"><svg width="24px" height="24px" viewBox="0 0 24 24" version="1.1"><g stroke="none" stroke-width="1" fill="none" fill-rule="evenodd"><rect x="0" y="0" width="24" height="24"></rect><circle fill="#000000" cx="5" cy="12" r="2"></circle><circle fill="#000000" cx="12" cy="12" r="2"></circle><circle fill="#000000" cx="19" cy="12" r="2"></circle></g></svg></div><div class="dropdown-menu dropdown-menu-end"><a class="dropdown-item" href="javascript:void(0)" id="rt" onclick="openChangeStatusModal('+data['leads_id']+')">Change stage</a><a class="dropdown-item" href="javascript:void(0)" id="rt" onclick="showStatusModal('+data['leads_id']+')">Show stages</a><a class="dropdown-item" href="javascript:void(0)" id="rt"  onclick="guset_count_edit('+data['leads_id']+')">Guest count</a><a class="dropdown-item" href="javascript:void(0)" id="rt"  onclick="accomodation_plan('+data['leads_id']+')">Accomodation plan</a><a class="dropdown-item" href="javascript:void(0)" id="rt" onclick="edit_leads('+data['leads_id']+')">Edit</a><a class="dropdown-item" href="<?php echo base_url();?>index.php/Room_tariff_management/View/'+data['room_tariff_hike_id']+'" >View Details</a><a class="dropdown-item" href="javascript:void(0)" onclick="return delete_leads('+data['leads_id']+')">Delete</a></div></div>');

              }

              if(data['leads_accomodation_status'] == 2){

                $('td', row).eq(13).html('<div class="dropdown ms-auto text-end"><div class="btn-link" data-bs-toggle="dropdown"><svg width="24px" height="24px" viewBox="0 0 24 24" version="1.1"><g stroke="none" stroke-width="1" fill="none" fill-rule="evenodd"><rect x="0" y="0" width="24" height="24"></rect><circle fill="#000000" cx="5" cy="12" r="2"></circle><circle fill="#000000" cx="12" cy="12" r="2"></circle><circle fill="#000000" cx="19" cy="12" r="2"></circle></g></svg></div><div class="dropdown-menu dropdown-menu-end"><a class="dropdown-item" href="javascript:void(0)" id="rt" onclick="openChangeStatusModal('+data['leads_id']+')">Change stage</a><a class="dropdown-item" href="javascript:void(0)" id="rt" onclick="showStatusModal('+data['leads_id']+')">Show stages</a><a class="dropdown-item" href="javascript:void(0)" id="rt"  onclick="guset_count_edit('+data['leads_id']+')">Guest count</a><a class="dropdown-item" href="javascript:void(0)" id="rt"  onclick="accomodation_plan('+data['leads_id']+')">Accomodation plan</a><a class="dropdown-item" href="javascript:void(0)" id="rt" onclick="open_quotation('+data['leads_id']+')">Quotation</a><a class="dropdown-item" href="javascript:void(0)" id="rt" onclick="edit_leads('+data['leads_id']+')">Edit</a><a class="dropdown-item" href="<?php echo base_url();?>index.php/Room_tariff_management/View/'+data['room_tariff_hike_id']+'" >View Details</a><a class="dropdown-item" href="javascript:void(0)" onclick="return delete_leads('+data['leads_id']+')">Delete</a></div></div>');

              }
            }
            else if(data['lead_current_status'] == 3){
              $('td', row).eq(9).html('<span class="badge badge-success">Converted to trip</span>');

              if(data['leads_accomodation_status'] == 0){
            
                $('td', row).eq(13).html('<div class="dropdown ms-auto text-end"><div class="btn-link" data-bs-toggle="dropdown"><svg width="24px" height="24px" viewBox="0 0 24 24" version="1.1"><g stroke="none" stroke-width="1" fill="none" fill-rule="evenodd"><rect x="0" y="0" width="24" height="24"></rect><circle fill="#000000" cx="5" cy="12" r="2"></circle><circle fill="#000000" cx="12" cy="12" r="2"></circle><circle fill="#000000" cx="19" cy="12" r="2"></circle></g></svg></div><div class="dropdown-menu dropdown-menu-end"><a class="dropdown-item" href="javascript:void(0)" id="rt" onclick="openChangeStatusModal('+data['leads_id']+')">Change stage</a><a class="dropdown-item" href="javascript:void(0)" id="rt" onclick="showStatusModal('+data['leads_id']+')">Show stages</a></div></div>');
              }
              
              if(data['leads_accomodation_status'] == 1){

                $('td', row).eq(13).html('<div class="dropdown ms-auto text-end"><div class="btn-link" data-bs-toggle="dropdown"><svg width="24px" height="24px" viewBox="0 0 24 24" version="1.1"><g stroke="none" stroke-width="1" fill="none" fill-rule="evenodd"><rect x="0" y="0" width="24" height="24"></rect><circle fill="#000000" cx="5" cy="12" r="2"></circle><circle fill="#000000" cx="12" cy="12" r="2"></circle><circle fill="#000000" cx="19" cy="12" r="2"></circle></g></svg></div><div class="dropdown-menu dropdown-menu-end"><a class="dropdown-item" href="javascript:void(0)" id="rt" onclick="openChangeStatusModal('+data['leads_id']+')">Change stage</a><a class="dropdown-item" href="javascript:void(0)" id="rt" onclick="showStatusModal('+data['leads_id']+')">Show stages</a><a class="dropdown-item" href="<?php echo base_url();?>index.php/Room_tariff_management/View/'+data['room_tariff_hike_id']+'" >View Details</a></div></div>');

              }

              if(data['leads_accomodation_status'] == 2){

                $('td', row).eq(13).html('<div class="dropdown ms-auto text-end"><div class="btn-link" data-bs-toggle="dropdown"><svg width="24px" height="24px" viewBox="0 0 24 24" version="1.1"><g stroke="none" stroke-width="1" fill="none" fill-rule="evenodd"><rect x="0" y="0" width="24" height="24"></rect><circle fill="#000000" cx="5" cy="12" r="2"></circle><circle fill="#000000" cx="12" cy="12" r="2"></circle><circle fill="#000000" cx="19" cy="12" r="2"></circle></g></svg></div><div class="dropdown-menu dropdown-menu-end"><a class="dropdown-item" href="javascript:void(0)" id="rt" onclick="openChangeStatusModal('+data['leads_id']+')">Change stage</a><a class="dropdown-item" href="javascript:void(0)" id="rt" onclick="showStatusModal('+data['leads_id']+')">Show stages</a><a class="dropdown-item" href="<?php echo base_url();?>index.php/Room_tariff_management/View/'+data['room_tariff_hike_id']+'" >View Details</a></div></div>');

              }
            }
            else if(data['lead_current_status'] == 4){
              $('td', row).eq(9).html('<span class="badge badge-warning">Not Qualified</span>');

              if(data['leads_accomodation_status'] == 0){
              
                $('td', row).eq(13).html('<div class="dropdown ms-auto text-end"><div class="btn-link" data-bs-toggle="dropdown"><svg width="24px" height="24px" viewBox="0 0 24 24" version="1.1"><g stroke="none" stroke-width="1" fill="none" fill-rule="evenodd"><rect x="0" y="0" width="24" height="24"></rect><circle fill="#000000" cx="5" cy="12" r="2"></circle><circle fill="#000000" cx="12" cy="12" r="2"></circle><circle fill="#000000" cx="19" cy="12" r="2"></circle></g></svg></div><div class="dropdown-menu dropdown-menu-end"><a class="dropdown-item" href="javascript:void(0)" id="rt" onclick="openChangeStatusModal('+data['leads_id']+')">Change stage</a><a class="dropdown-item" href="javascript:void(0)" id="rt" onclick="showStatusModal('+data['leads_id']+')">Show stages</a><a class="dropdown-item" href="javascript:void(0)" id="rt"  onclick="guset_count_edit('+data['leads_id']+')">Guest count</a><a class="dropdown-item" href="javascript:void(0)" id="rt" onclick="edit_leads('+data['leads_id']+')">Edit</a><a class="dropdown-item" href="<?php echo base_url();?>index.php/Room_tariff_management/View/'+data['room_tariff_hike_id']+'" >View Details</a><a class="dropdown-item" href="javascript:void(0)" onclick="return delete_leads('+data['leads_id']+')">Delete</a></div></div>');
              }
              
              if(data['leads_accomodation_status'] == 1){

                $('td', row).eq(13).html('<div class="dropdown ms-auto text-end"><div class="btn-link" data-bs-toggle="dropdown"><svg width="24px" height="24px" viewBox="0 0 24 24" version="1.1"><g stroke="none" stroke-width="1" fill="none" fill-rule="evenodd"><rect x="0" y="0" width="24" height="24"></rect><circle fill="#000000" cx="5" cy="12" r="2"></circle><circle fill="#000000" cx="12" cy="12" r="2"></circle><circle fill="#000000" cx="19" cy="12" r="2"></circle></g></svg></div><div class="dropdown-menu dropdown-menu-end"><a class="dropdown-item" href="javascript:void(0)" id="rt" onclick="openChangeStatusModal('+data['leads_id']+')">Change stage</a><a class="dropdown-item" href="javascript:void(0)" id="rt" onclick="showStatusModal('+data['leads_id']+')">Show stages</a><a class="dropdown-item" href="javascript:void(0)" id="rt"  onclick="guset_count_edit('+data['leads_id']+')">Guest count</a><a class="dropdown-item" href="javascript:void(0)" id="rt"  onclick="accomodation_plan('+data['leads_id']+')">Accomodation plan</a><a class="dropdown-item" href="javascript:void(0)" id="rt" onclick="edit_leads('+data['leads_id']+')">Edit</a><a class="dropdown-item" href="<?php echo base_url();?>index.php/Room_tariff_management/View/'+data['room_tariff_hike_id']+'" >View Details</a><a class="dropdown-item" href="javascript:void(0)" onclick="return delete_leads('+data['leads_id']+')">Delete</a></div></div>');

              }

              if(data['leads_accomodation_status'] == 2){

                $('td', row).eq(13).html('<div class="dropdown ms-auto text-end"><div class="btn-link" data-bs-toggle="dropdown"><svg width="24px" height="24px" viewBox="0 0 24 24" version="1.1"><g stroke="none" stroke-width="1" fill="none" fill-rule="evenodd"><rect x="0" y="0" width="24" height="24"></rect><circle fill="#000000" cx="5" cy="12" r="2"></circle><circle fill="#000000" cx="12" cy="12" r="2"></circle><circle fill="#000000" cx="19" cy="12" r="2"></circle></g></svg></div><div class="dropdown-menu dropdown-menu-end"><a class="dropdown-item" href="javascript:void(0)" id="rt" onclick="openChangeStatusModal('+data['leads_id']+')">Change stage</a><a class="dropdown-item" href="javascript:void(0)" id="rt" onclick="showStatusModal('+data['leads_id']+')">Show stages</a><a class="dropdown-item" href="javascript:void(0)" id="rt"  onclick="guset_count_edit('+data['leads_id']+')">Guest count</a><a class="dropdown-item" href="javascript:void(0)" id="rt"  onclick="accomodation_plan('+data['leads_id']+')">Accomodation plan</a><a class="dropdown-item" href="javascript:void(0)" id="rt" onclick="open_quotation('+data['leads_id']+')">Quotation</a><a class="dropdown-item" href="javascript:void(0)" id="rt" onclick="edit_leads('+data['leads_id']+')">Edit</a><a class="dropdown-item" href="<?php echo base_url();?>index.php/Room_tariff_management/View/'+data['room_tariff_hike_id']+'" >View Details</a><a class="dropdown-item" href="javascript:void(0)" onclick="return delete_leads('+data['leads_id']+')">Delete</a></div></div>');

              }
            }
            else if(data['lead_current_status'] == 5){
              $('td', row).eq(9).html('<span class="badge badge-danger">Lost</span>');

              if(data['leads_accomodation_status'] == 0){
              
                $('td', row).eq(13).html('<div class="dropdown ms-auto text-end"><div class="btn-link" data-bs-toggle="dropdown"><svg width="24px" height="24px" viewBox="0 0 24 24" version="1.1"><g stroke="none" stroke-width="1" fill="none" fill-rule="evenodd"><rect x="0" y="0" width="24" height="24"></rect><circle fill="#000000" cx="5" cy="12" r="2"></circle><circle fill="#000000" cx="12" cy="12" r="2"></circle><circle fill="#000000" cx="19" cy="12" r="2"></circle></g></svg></div><div class="dropdown-menu dropdown-menu-end"><a class="dropdown-item" href="javascript:void(0)" id="rt" onclick="openChangeStatusModal('+data['leads_id']+')">Change stage</a><a class="dropdown-item" href="javascript:void(0)" id="rt" onclick="showStatusModal('+data['leads_id']+')">Show stages</a><a class="dropdown-item" href="javascript:void(0)" id="rt"  onclick="guset_count_edit('+data['leads_id']+')">Guest count</a><a class="dropdown-item" href="javascript:void(0)" id="rt" onclick="edit_leads('+data['leads_id']+')">Edit</a><a class="dropdown-item" href="<?php echo base_url();?>index.php/Room_tariff_management/View/'+data['room_tariff_hike_id']+'" >View Details</a><a class="dropdown-item" href="javascript:void(0)" onclick="return delete_leads('+data['leads_id']+')">Delete</a></div></div>');
              }
              
              if(data['leads_accomodation_status'] == 1){

                $('td', row).eq(13).html('<div class="dropdown ms-auto text-end"><div class="btn-link" data-bs-toggle="dropdown"><svg width="24px" height="24px" viewBox="0 0 24 24" version="1.1"><g stroke="none" stroke-width="1" fill="none" fill-rule="evenodd"><rect x="0" y="0" width="24" height="24"></rect><circle fill="#000000" cx="5" cy="12" r="2"></circle><circle fill="#000000" cx="12" cy="12" r="2"></circle><circle fill="#000000" cx="19" cy="12" r="2"></circle></g></svg></div><div class="dropdown-menu dropdown-menu-end"><a class="dropdown-item" href="javascript:void(0)" id="rt" onclick="openChangeStatusModal('+data['leads_id']+')">Change stage</a><a class="dropdown-item" href="javascript:void(0)" id="rt" onclick="showStatusModal('+data['leads_id']+')">Show stages</a><a class="dropdown-item" href="javascript:void(0)" id="rt"  onclick="guset_count_edit('+data['leads_id']+')">Guest count</a><a class="dropdown-item" href="javascript:void(0)" id="rt"  onclick="accomodation_plan('+data['leads_id']+')">Accomodation plan</a><a class="dropdown-item" href="javascript:void(0)" id="rt" onclick="edit_leads('+data['leads_id']+')">Edit</a><a class="dropdown-item" href="<?php echo base_url();?>index.php/Room_tariff_management/View/'+data['room_tariff_hike_id']+'" >View Details</a><a class="dropdown-item" href="javascript:void(0)" onclick="return delete_leads('+data['leads_id']+')">Delete</a></div></div>');

              }

              if(data['leads_accomodation_status'] == 2){

                $('td', row).eq(13).html('<div class="dropdown ms-auto text-end"><div class="btn-link" data-bs-toggle="dropdown"><svg width="24px" height="24px" viewBox="0 0 24 24" version="1.1"><g stroke="none" stroke-width="1" fill="none" fill-rule="evenodd"><rect x="0" y="0" width="24" height="24"></rect><circle fill="#000000" cx="5" cy="12" r="2"></circle><circle fill="#000000" cx="12" cy="12" r="2"></circle><circle fill="#000000" cx="19" cy="12" r="2"></circle></g></svg></div><div class="dropdown-menu dropdown-menu-end"><a class="dropdown-item" href="javascript:void(0)" id="rt" onclick="openChangeStatusModal('+data['leads_id']+')">Change stage</a><a class="dropdown-item" href="javascript:void(0)" id="rt" onclick="showStatusModal('+data['leads_id']+')">Show stages</a><a class="dropdown-item" href="javascript:void(0)" id="rt"  onclick="guset_count_edit('+data['leads_id']+')">Guest count</a><a class="dropdown-item" href="javascript:void(0)" id="rt"  onclick="accomodation_plan('+data['leads_id']+')">Accomodation plan</a><a class="dropdown-item" href="javascript:void(0)" id="rt" onclick="open_quotation('+data['leads_id']+')">Quotation</a><a class="dropdown-item" href="javascript:void(0)" id="rt" onclick="edit_leads('+data['leads_id']+')">Edit</a><a class="dropdown-item" href="<?php echo base_url();?>index.php/Room_tariff_management/View/'+data['room_tariff_hike_id']+'" >View Details</a><a class="dropdown-item" href="javascript:void(0)" onclick="return delete_leads('+data['leads_id']+')">Delete</a></div></div>');

              }
            }
        
              
          // $('td', row).eq(13).html('<div class="dropdown ms-auto text-end"><div class="btn-link" data-bs-toggle="dropdown"><svg width="24px" height="24px" viewBox="0 0 24 24" version="1.1"><g stroke="none" stroke-width="1" fill="none" fill-rule="evenodd"><rect x="0" y="0" width="24" height="24"></rect><circle fill="#000000" cx="5" cy="12" r="2"></circle><circle fill="#000000" cx="12" cy="12" r="2"></circle><circle fill="#000000" cx="19" cy="12" r="2"></circle></g></svg></div><div class="dropdown-menu dropdown-menu-end"><a class="dropdown-item" href="javascript:void(0)" id="rt" onclick="openChangeStatusModal('+data['leads_id']+')">Change stage</a><a class="dropdown-item" href="javascript:void(0)" id="rt" onclick="showStatusModal('+data['leads_id']+')">Show stages</a><a class="dropdown-item" href="javascript:void(0)" id="rt" onclick="open_quotation('+data['leads_id']+')">Quotation</a><a class="dropdown-item" href="javascript:void(0)" id="rt" onclick="edit_leads('+data['leads_id']+')">Edit</a><a class="dropdown-item" href="javascript:void(0)" onclick="return delete_leads('+data['leads_id']+')">Delete</a><a class="dropdown-item" href="javascript:void(0)" id="rt"  onclick="guset_count_edit('+data['leads_id']+')">Guest count</a><a class="dropdown-item" href="javascript:void(0)" id="rt"  onclick="accomodation_plan('+data['leads_id']+')">Accomodation plan</a><a class="dropdown-item" href="<?php echo base_url();?>index.php/Leads/View/'+data['leads_id']+'" >View Details</a></div></div>');
         
          // if(data['leads_accomodation_status'] == 0){
            
          // $('td', row).eq(13).html('<div class="dropdown ms-auto text-end"><div class="btn-link" data-bs-toggle="dropdown"><svg width="24px" height="24px" viewBox="0 0 24 24" version="1.1"><g stroke="none" stroke-width="1" fill="none" fill-rule="evenodd"><rect x="0" y="0" width="24" height="24"></rect><circle fill="#000000" cx="5" cy="12" r="2"></circle><circle fill="#000000" cx="12" cy="12" r="2"></circle><circle fill="#000000" cx="19" cy="12" r="2"></circle></g></svg></div><div class="dropdown-menu dropdown-menu-end"><a class="dropdown-item" href="javascript:void(0)" id="rt" onclick="openChangeStatusModal('+data['leads_id']+')">Change stage</a><a class="dropdown-item" href="javascript:void(0)" id="rt" onclick="showStatusModal('+data['leads_id']+')">Show stages</a><a class="dropdown-item" href="javascript:void(0)" id="rt"  onclick="guset_count_edit('+data['leads_id']+')">Guest count</a><a class="dropdown-item" href="javascript:void(0)" id="rt" onclick="edit_leads('+data['leads_id']+')">Edit</a><a class="dropdown-item" href="<?php echo base_url();?>index.php/Leads/View/'+data['leads_id']+'" >View Details</a><a class="dropdown-item" href="javascript:void(0)" onclick="return delete_leads('+data['leads_id']+')">Delete</a></div></div>');
          // }
          
          // if(data['leads_accomodation_status'] == 1){

          //   $('td', row).eq(13).html('<div class="dropdown ms-auto text-end"><div class="btn-link" data-bs-toggle="dropdown"><svg width="24px" height="24px" viewBox="0 0 24 24" version="1.1"><g stroke="none" stroke-width="1" fill="none" fill-rule="evenodd"><rect x="0" y="0" width="24" height="24"></rect><circle fill="#000000" cx="5" cy="12" r="2"></circle><circle fill="#000000" cx="12" cy="12" r="2"></circle><circle fill="#000000" cx="19" cy="12" r="2"></circle></g></svg></div><div class="dropdown-menu dropdown-menu-end"><a class="dropdown-item" href="javascript:void(0)" id="rt" onclick="openChangeStatusModal('+data['leads_id']+')">Change stage</a><a class="dropdown-item" href="javascript:void(0)" id="rt" onclick="showStatusModal('+data['leads_id']+')">Show stages</a><a class="dropdown-item" href="javascript:void(0)" id="rt"  onclick="guset_count_edit('+data['leads_id']+')">Guest count</a><a class="dropdown-item" href="javascript:void(0)" id="rt"  onclick="accomodation_plan('+data['leads_id']+')">Accomodation plan</a><a class="dropdown-item" href="javascript:void(0)" id="rt" onclick="edit_leads('+data['leads_id']+')">Edit</a><a class="dropdown-item" href="<?php echo base_url();?>index.php/Room_tariff_management/Leads/'+data['leads_id']+'" >View Details</a><a class="dropdown-item" href="javascript:void(0)" onclick="return delete_leads('+data['leads_id']+')">Delete</a></div></div>');

          // }

          // if(data['leads_accomodation_status'] == 2){

          //   $('td', row).eq(13).html('<div class="dropdown ms-auto text-end"><div class="btn-link" data-bs-toggle="dropdown"><svg width="24px" height="24px" viewBox="0 0 24 24" version="1.1"><g stroke="none" stroke-width="1" fill="none" fill-rule="evenodd"><rect x="0" y="0" width="24" height="24"></rect><circle fill="#000000" cx="5" cy="12" r="2"></circle><circle fill="#000000" cx="12" cy="12" r="2"></circle><circle fill="#000000" cx="19" cy="12" r="2"></circle></g></svg></div><div class="dropdown-menu dropdown-menu-end"><a class="dropdown-item" href="javascript:void(0)" id="rt" onclick="openChangeStatusModal('+data['leads_id']+')">Change stage</a><a class="dropdown-item" href="javascript:void(0)" id="rt" onclick="showStatusModal('+data['leads_id']+')">Show stages</a><a class="dropdown-item" href="javascript:void(0)" id="rt"  onclick="guset_count_edit('+data['leads_id']+')">Guest count</a><a class="dropdown-item" href="javascript:void(0)" id="rt"  onclick="accomodation_plan('+data['leads_id']+')">Accomodation plan</a><a class="dropdown-item" href="javascript:void(0)" id="rt" onclick="open_quotation('+data['leads_id']+')">Quotation</a><a class="dropdown-item" href="javascript:void(0)" id="rt" onclick="edit_leads('+data['leads_id']+')">Edit</a><a class="dropdown-item" href="<?php echo base_url();?>index.php/Leads/View/'+data['leads_id']+'" >View Details</a><a class="dropdown-item" href="javascript:void(0)" onclick="return delete_leads('+data['leads_id']+')">Delete</a></div></div>');

          // }
            
            
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
            { "data": "end_date", "orderable": false },
            { "data": "packages_title", "orderable": false },
            { "data": "lead_current_status", "orderable": false },
            { "data": "stages_button", "orderable": false },
            { "data": "priority_status_button", "orderable": false },
            { "data": "leads_createdby_username", "orderable": false },                      
            { "data": "leads_id", "orderable": false }
            
            
        ]
        
    });
    
  

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
            "url": "<?php echo base_url();?>index.php/Leads/get_meta/",
            "type": "POST",
            "data" : function (d) {
                        d.staff_id2 = $("#staff_id2").val();
                        d.source_id2 = $("#source_id2").val();
                        d.packages_id2 = $("#packages_id2").val();
                        d.country_id2 = $("#country_id2").val();
                        d.priority_status_id2 = $("#priority_status_id2").val();
                        d.stages_id2 = $("#stages_id2").val();
                        d.lead_type2 = $("#lead_type2").val();
                        d.lead_current_status2 = $("#lead_current_status2").val();
                        d.guest_name_filter2 = $("#guest_name_filter2").val();
                        d.whats_number_filter2 = $("#whats_number_filter2").val();
                        d.leads_createdby_userid2 = $("#leads_createdby_userid2").val();
                        d.leads_start_date2 = $("#leads_start_date2").val();
                        d.leads_end_date2 = $("#leads_end_date2").val();
                        d.travels_start_date2 = $("#travels_start_date2").val();
                        d.travels_end_date2 = $("#travels_end_date2").val();
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
            
            

            if(data['lead_current_status'] == 1){
              $('td', row).eq(9).html('<span class="badge badge-info">In take</span>');

              if(data['leads_accomodation_status'] == 0){
              
                $('td', row).eq(13).html('<div class="dropdown ms-auto text-end"><div class="btn-link" data-bs-toggle="dropdown"><svg width="24px" height="24px" viewBox="0 0 24 24" version="1.1"><g stroke="none" stroke-width="1" fill="none" fill-rule="evenodd"><rect x="0" y="0" width="24" height="24"></rect><circle fill="#000000" cx="5" cy="12" r="2"></circle><circle fill="#000000" cx="12" cy="12" r="2"></circle><circle fill="#000000" cx="19" cy="12" r="2"></circle></g></svg></div><div class="dropdown-menu dropdown-menu-end"><a class="dropdown-item" href="javascript:void(0)" id="rt" onclick="openChangeStatusModal('+data['leads_id']+')">Change stage</a><a class="dropdown-item" href="javascript:void(0)" id="rt" onclick="showStatusModal('+data['leads_id']+')">Show stages</a><a class="dropdown-item" href="javascript:void(0)" id="rt"  onclick="guset_count_edit('+data['leads_id']+')">Guest count</a><a class="dropdown-item" href="javascript:void(0)" id="rt" onclick="edit_leads('+data['leads_id']+')">Edit</a><a class="dropdown-item" href="<?php echo base_url();?>index.php/Room_tariff_management/View/'+data['room_tariff_hike_id']+'" >View Details</a><a class="dropdown-item" href="javascript:void(0)" onclick="return delete_leads('+data['leads_id']+')">Delete</a></div></div>');
              }
              
              if(data['leads_accomodation_status'] == 1){

                $('td', row).eq(13).html('<div class="dropdown ms-auto text-end"><div class="btn-link" data-bs-toggle="dropdown"><svg width="24px" height="24px" viewBox="0 0 24 24" version="1.1"><g stroke="none" stroke-width="1" fill="none" fill-rule="evenodd"><rect x="0" y="0" width="24" height="24"></rect><circle fill="#000000" cx="5" cy="12" r="2"></circle><circle fill="#000000" cx="12" cy="12" r="2"></circle><circle fill="#000000" cx="19" cy="12" r="2"></circle></g></svg></div><div class="dropdown-menu dropdown-menu-end"><a class="dropdown-item" href="javascript:void(0)" id="rt" onclick="openChangeStatusModal('+data['leads_id']+')">Change stage</a><a class="dropdown-item" href="javascript:void(0)" id="rt" onclick="showStatusModal('+data['leads_id']+')">Show stages</a><a class="dropdown-item" href="javascript:void(0)" id="rt"  onclick="guset_count_edit('+data['leads_id']+')">Guest count</a><a class="dropdown-item" href="javascript:void(0)" id="rt"  onclick="accomodation_plan('+data['leads_id']+')">Accomodation plan</a><a class="dropdown-item" href="javascript:void(0)" id="rt" onclick="edit_leads('+data['leads_id']+')">Edit</a><a class="dropdown-item" href="<?php echo base_url();?>index.php/Room_tariff_management/View/'+data['room_tariff_hike_id']+'" >View Details</a><a class="dropdown-item" href="javascript:void(0)" onclick="return delete_leads('+data['leads_id']+')">Delete</a></div></div>');

              }

              if(data['leads_accomodation_status'] == 2){

                $('td', row).eq(13).html('<div class="dropdown ms-auto text-end"><div class="btn-link" data-bs-toggle="dropdown"><svg width="24px" height="24px" viewBox="0 0 24 24" version="1.1"><g stroke="none" stroke-width="1" fill="none" fill-rule="evenodd"><rect x="0" y="0" width="24" height="24"></rect><circle fill="#000000" cx="5" cy="12" r="2"></circle><circle fill="#000000" cx="12" cy="12" r="2"></circle><circle fill="#000000" cx="19" cy="12" r="2"></circle></g></svg></div><div class="dropdown-menu dropdown-menu-end"><a class="dropdown-item" href="javascript:void(0)" id="rt" onclick="openChangeStatusModal('+data['leads_id']+')">Change stage</a><a class="dropdown-item" href="javascript:void(0)" id="rt" onclick="showStatusModal('+data['leads_id']+')">Show stages</a><a class="dropdown-item" href="javascript:void(0)" id="rt"  onclick="guset_count_edit('+data['leads_id']+')">Guest count</a><a class="dropdown-item" href="javascript:void(0)" id="rt"  onclick="accomodation_plan('+data['leads_id']+')">Accomodation plan</a><a class="dropdown-item" href="javascript:void(0)" id="rt" onclick="open_quotation('+data['leads_id']+')">Quotation</a><a class="dropdown-item" href="javascript:void(0)" id="rt" onclick="edit_leads('+data['leads_id']+')">Edit</a><a class="dropdown-item" href="<?php echo base_url();?>index.php/Room_tariff_management/View/'+data['room_tariff_hike_id']+'" >View Details</a><a class="dropdown-item" href="javascript:void(0)" onclick="return delete_leads('+data['leads_id']+')">Delete</a></div></div>');

              }

            }
            else if(data['lead_current_status'] == 2){
              $('td', row).eq(9).html('<span class="badge badge-secondary">Qualified</span>');

              if(data['leads_accomodation_status'] == 0){
            
                $('td', row).eq(13).html('<div class="dropdown ms-auto text-end"><div class="btn-link" data-bs-toggle="dropdown"><svg width="24px" height="24px" viewBox="0 0 24 24" version="1.1"><g stroke="none" stroke-width="1" fill="none" fill-rule="evenodd"><rect x="0" y="0" width="24" height="24"></rect><circle fill="#000000" cx="5" cy="12" r="2"></circle><circle fill="#000000" cx="12" cy="12" r="2"></circle><circle fill="#000000" cx="19" cy="12" r="2"></circle></g></svg></div><div class="dropdown-menu dropdown-menu-end"><a class="dropdown-item" href="javascript:void(0)" id="rt" onclick="openChangeStatusModal('+data['leads_id']+')">Change stage</a><a class="dropdown-item" href="javascript:void(0)" id="rt" onclick="showStatusModal('+data['leads_id']+')">Show stages</a><a class="dropdown-item" href="javascript:void(0)" id="rt"  onclick="guset_count_edit('+data['leads_id']+')">Guest count</a><a class="dropdown-item" href="javascript:void(0)" id="rt" onclick="edit_leads('+data['leads_id']+')">Edit</a><a class="dropdown-item" href="<?php echo base_url();?>index.php/Room_tariff_management/View/'+data['room_tariff_hike_id']+'" >View Details</a><a class="dropdown-item" href="javascript:void(0)" onclick="return delete_leads('+data['leads_id']+')">Delete</a></div></div>');
              }
              
              if(data['leads_accomodation_status'] == 1){

                $('td', row).eq(13).html('<div class="dropdown ms-auto text-end"><div class="btn-link" data-bs-toggle="dropdown"><svg width="24px" height="24px" viewBox="0 0 24 24" version="1.1"><g stroke="none" stroke-width="1" fill="none" fill-rule="evenodd"><rect x="0" y="0" width="24" height="24"></rect><circle fill="#000000" cx="5" cy="12" r="2"></circle><circle fill="#000000" cx="12" cy="12" r="2"></circle><circle fill="#000000" cx="19" cy="12" r="2"></circle></g></svg></div><div class="dropdown-menu dropdown-menu-end"><a class="dropdown-item" href="javascript:void(0)" id="rt" onclick="openChangeStatusModal('+data['leads_id']+')">Change stage</a><a class="dropdown-item" href="javascript:void(0)" id="rt" onclick="showStatusModal('+data['leads_id']+')">Show stages</a><a class="dropdown-item" href="javascript:void(0)" id="rt"  onclick="guset_count_edit('+data['leads_id']+')">Guest count</a><a class="dropdown-item" href="javascript:void(0)" id="rt"  onclick="accomodation_plan('+data['leads_id']+')">Accomodation plan</a><a class="dropdown-item" href="javascript:void(0)" id="rt" onclick="edit_leads('+data['leads_id']+')">Edit</a><a class="dropdown-item" href="<?php echo base_url();?>index.php/Room_tariff_management/View/'+data['room_tariff_hike_id']+'" >View Details</a><a class="dropdown-item" href="javascript:void(0)" onclick="return delete_leads('+data['leads_id']+')">Delete</a></div></div>');

              }

              if(data['leads_accomodation_status'] == 2){

                $('td', row).eq(13).html('<div class="dropdown ms-auto text-end"><div class="btn-link" data-bs-toggle="dropdown"><svg width="24px" height="24px" viewBox="0 0 24 24" version="1.1"><g stroke="none" stroke-width="1" fill="none" fill-rule="evenodd"><rect x="0" y="0" width="24" height="24"></rect><circle fill="#000000" cx="5" cy="12" r="2"></circle><circle fill="#000000" cx="12" cy="12" r="2"></circle><circle fill="#000000" cx="19" cy="12" r="2"></circle></g></svg></div><div class="dropdown-menu dropdown-menu-end"><a class="dropdown-item" href="javascript:void(0)" id="rt" onclick="openChangeStatusModal('+data['leads_id']+')">Change stage</a><a class="dropdown-item" href="javascript:void(0)" id="rt" onclick="showStatusModal('+data['leads_id']+')">Show stages</a><a class="dropdown-item" href="javascript:void(0)" id="rt"  onclick="guset_count_edit('+data['leads_id']+')">Guest count</a><a class="dropdown-item" href="javascript:void(0)" id="rt"  onclick="accomodation_plan('+data['leads_id']+')">Accomodation plan</a><a class="dropdown-item" href="javascript:void(0)" id="rt" onclick="open_quotation('+data['leads_id']+')">Quotation</a><a class="dropdown-item" href="javascript:void(0)" id="rt" onclick="edit_leads('+data['leads_id']+')">Edit</a><a class="dropdown-item" href="<?php echo base_url();?>index.php/Room_tariff_management/View/'+data['room_tariff_hike_id']+'" >View Details</a><a class="dropdown-item" href="javascript:void(0)" onclick="return delete_leads('+data['leads_id']+')">Delete</a></div></div>');

              }
            }
            else if(data['lead_current_status'] == 3){
              $('td', row).eq(9).html('<span class="badge badge-success">Converted to trip</span>');

              if(data['leads_accomodation_status'] == 0){
            
                $('td', row).eq(13).html('<div class="dropdown ms-auto text-end"><div class="btn-link" data-bs-toggle="dropdown"><svg width="24px" height="24px" viewBox="0 0 24 24" version="1.1"><g stroke="none" stroke-width="1" fill="none" fill-rule="evenodd"><rect x="0" y="0" width="24" height="24"></rect><circle fill="#000000" cx="5" cy="12" r="2"></circle><circle fill="#000000" cx="12" cy="12" r="2"></circle><circle fill="#000000" cx="19" cy="12" r="2"></circle></g></svg></div><div class="dropdown-menu dropdown-menu-end"><a class="dropdown-item" href="javascript:void(0)" id="rt" onclick="openChangeStatusModal('+data['leads_id']+')">Change stage</a><a class="dropdown-item" href="javascript:void(0)" id="rt" onclick="showStatusModal('+data['leads_id']+')">Show stages</a></div></div>');
              }
              
              if(data['leads_accomodation_status'] == 1){

                $('td', row).eq(13).html('<div class="dropdown ms-auto text-end"><div class="btn-link" data-bs-toggle="dropdown"><svg width="24px" height="24px" viewBox="0 0 24 24" version="1.1"><g stroke="none" stroke-width="1" fill="none" fill-rule="evenodd"><rect x="0" y="0" width="24" height="24"></rect><circle fill="#000000" cx="5" cy="12" r="2"></circle><circle fill="#000000" cx="12" cy="12" r="2"></circle><circle fill="#000000" cx="19" cy="12" r="2"></circle></g></svg></div><div class="dropdown-menu dropdown-menu-end"><a class="dropdown-item" href="javascript:void(0)" id="rt" onclick="openChangeStatusModal('+data['leads_id']+')">Change stage</a><a class="dropdown-item" href="javascript:void(0)" id="rt" onclick="showStatusModal('+data['leads_id']+')">Show stages</a><a class="dropdown-item" href="<?php echo base_url();?>index.php/Room_tariff_management/View/'+data['room_tariff_hike_id']+'" >View Details</a></div></div>');

              }

              if(data['leads_accomodation_status'] == 2){

                $('td', row).eq(13).html('<div class="dropdown ms-auto text-end"><div class="btn-link" data-bs-toggle="dropdown"><svg width="24px" height="24px" viewBox="0 0 24 24" version="1.1"><g stroke="none" stroke-width="1" fill="none" fill-rule="evenodd"><rect x="0" y="0" width="24" height="24"></rect><circle fill="#000000" cx="5" cy="12" r="2"></circle><circle fill="#000000" cx="12" cy="12" r="2"></circle><circle fill="#000000" cx="19" cy="12" r="2"></circle></g></svg></div><div class="dropdown-menu dropdown-menu-end"><a class="dropdown-item" href="javascript:void(0)" id="rt" onclick="openChangeStatusModal('+data['leads_id']+')">Change stage</a><a class="dropdown-item" href="javascript:void(0)" id="rt" onclick="showStatusModal('+data['leads_id']+')">Show stages</a><a class="dropdown-item" href="<?php echo base_url();?>index.php/Room_tariff_management/View/'+data['room_tariff_hike_id']+'" >View Details</a></div></div>');

              }
            }
            else if(data['lead_current_status'] == 4){
              $('td', row).eq(9).html('<span class="badge badge-warning">Not Qualified</span>');

              if(data['leads_accomodation_status'] == 0){
              
                $('td', row).eq(13).html('<div class="dropdown ms-auto text-end"><div class="btn-link" data-bs-toggle="dropdown"><svg width="24px" height="24px" viewBox="0 0 24 24" version="1.1"><g stroke="none" stroke-width="1" fill="none" fill-rule="evenodd"><rect x="0" y="0" width="24" height="24"></rect><circle fill="#000000" cx="5" cy="12" r="2"></circle><circle fill="#000000" cx="12" cy="12" r="2"></circle><circle fill="#000000" cx="19" cy="12" r="2"></circle></g></svg></div><div class="dropdown-menu dropdown-menu-end"><a class="dropdown-item" href="javascript:void(0)" id="rt" onclick="openChangeStatusModal('+data['leads_id']+')">Change stage</a><a class="dropdown-item" href="javascript:void(0)" id="rt" onclick="showStatusModal('+data['leads_id']+')">Show stages</a><a class="dropdown-item" href="javascript:void(0)" id="rt"  onclick="guset_count_edit('+data['leads_id']+')">Guest count</a><a class="dropdown-item" href="javascript:void(0)" id="rt" onclick="edit_leads('+data['leads_id']+')">Edit</a><a class="dropdown-item" href="<?php echo base_url();?>index.php/Room_tariff_management/View/'+data['room_tariff_hike_id']+'" >View Details</a><a class="dropdown-item" href="javascript:void(0)" onclick="return delete_leads('+data['leads_id']+')">Delete</a></div></div>');
              }
              
              if(data['leads_accomodation_status'] == 1){

                $('td', row).eq(13).html('<div class="dropdown ms-auto text-end"><div class="btn-link" data-bs-toggle="dropdown"><svg width="24px" height="24px" viewBox="0 0 24 24" version="1.1"><g stroke="none" stroke-width="1" fill="none" fill-rule="evenodd"><rect x="0" y="0" width="24" height="24"></rect><circle fill="#000000" cx="5" cy="12" r="2"></circle><circle fill="#000000" cx="12" cy="12" r="2"></circle><circle fill="#000000" cx="19" cy="12" r="2"></circle></g></svg></div><div class="dropdown-menu dropdown-menu-end"><a class="dropdown-item" href="javascript:void(0)" id="rt" onclick="openChangeStatusModal('+data['leads_id']+')">Change stage</a><a class="dropdown-item" href="javascript:void(0)" id="rt" onclick="showStatusModal('+data['leads_id']+')">Show stages</a><a class="dropdown-item" href="javascript:void(0)" id="rt"  onclick="guset_count_edit('+data['leads_id']+')">Guest count</a><a class="dropdown-item" href="javascript:void(0)" id="rt"  onclick="accomodation_plan('+data['leads_id']+')">Accomodation plan</a><a class="dropdown-item" href="javascript:void(0)" id="rt" onclick="edit_leads('+data['leads_id']+')">Edit</a><a class="dropdown-item" href="<?php echo base_url();?>index.php/Room_tariff_management/View/'+data['room_tariff_hike_id']+'" >View Details</a><a class="dropdown-item" href="javascript:void(0)" onclick="return delete_leads('+data['leads_id']+')">Delete</a></div></div>');

              }

              if(data['leads_accomodation_status'] == 2){

                $('td', row).eq(13).html('<div class="dropdown ms-auto text-end"><div class="btn-link" data-bs-toggle="dropdown"><svg width="24px" height="24px" viewBox="0 0 24 24" version="1.1"><g stroke="none" stroke-width="1" fill="none" fill-rule="evenodd"><rect x="0" y="0" width="24" height="24"></rect><circle fill="#000000" cx="5" cy="12" r="2"></circle><circle fill="#000000" cx="12" cy="12" r="2"></circle><circle fill="#000000" cx="19" cy="12" r="2"></circle></g></svg></div><div class="dropdown-menu dropdown-menu-end"><a class="dropdown-item" href="javascript:void(0)" id="rt" onclick="openChangeStatusModal('+data['leads_id']+')">Change stage</a><a class="dropdown-item" href="javascript:void(0)" id="rt" onclick="showStatusModal('+data['leads_id']+')">Show stages</a><a class="dropdown-item" href="javascript:void(0)" id="rt"  onclick="guset_count_edit('+data['leads_id']+')">Guest count</a><a class="dropdown-item" href="javascript:void(0)" id="rt"  onclick="accomodation_plan('+data['leads_id']+')">Accomodation plan</a><a class="dropdown-item" href="javascript:void(0)" id="rt" onclick="open_quotation('+data['leads_id']+')">Quotation</a><a class="dropdown-item" href="javascript:void(0)" id="rt" onclick="edit_leads('+data['leads_id']+')">Edit</a><a class="dropdown-item" href="<?php echo base_url();?>index.php/Room_tariff_management/View/'+data['room_tariff_hike_id']+'" >View Details</a><a class="dropdown-item" href="javascript:void(0)" onclick="return delete_leads('+data['leads_id']+')">Delete</a></div></div>');

              }
            }
            else if(data['lead_current_status'] == 5){
              $('td', row).eq(9).html('<span class="badge badge-danger">Lost</span>');

              if(data['leads_accomodation_status'] == 0){
              
                $('td', row).eq(13).html('<div class="dropdown ms-auto text-end"><div class="btn-link" data-bs-toggle="dropdown"><svg width="24px" height="24px" viewBox="0 0 24 24" version="1.1"><g stroke="none" stroke-width="1" fill="none" fill-rule="evenodd"><rect x="0" y="0" width="24" height="24"></rect><circle fill="#000000" cx="5" cy="12" r="2"></circle><circle fill="#000000" cx="12" cy="12" r="2"></circle><circle fill="#000000" cx="19" cy="12" r="2"></circle></g></svg></div><div class="dropdown-menu dropdown-menu-end"><a class="dropdown-item" href="javascript:void(0)" id="rt" onclick="openChangeStatusModal('+data['leads_id']+')">Change stage</a><a class="dropdown-item" href="javascript:void(0)" id="rt" onclick="showStatusModal('+data['leads_id']+')">Show stages</a><a class="dropdown-item" href="javascript:void(0)" id="rt"  onclick="guset_count_edit('+data['leads_id']+')">Guest count</a><a class="dropdown-item" href="javascript:void(0)" id="rt" onclick="edit_leads('+data['leads_id']+')">Edit</a><a class="dropdown-item" href="<?php echo base_url();?>index.php/Room_tariff_management/View/'+data['room_tariff_hike_id']+'" >View Details</a><a class="dropdown-item" href="javascript:void(0)" onclick="return delete_leads('+data['leads_id']+')">Delete</a></div></div>');
              }
              
              if(data['leads_accomodation_status'] == 1){

                $('td', row).eq(13).html('<div class="dropdown ms-auto text-end"><div class="btn-link" data-bs-toggle="dropdown"><svg width="24px" height="24px" viewBox="0 0 24 24" version="1.1"><g stroke="none" stroke-width="1" fill="none" fill-rule="evenodd"><rect x="0" y="0" width="24" height="24"></rect><circle fill="#000000" cx="5" cy="12" r="2"></circle><circle fill="#000000" cx="12" cy="12" r="2"></circle><circle fill="#000000" cx="19" cy="12" r="2"></circle></g></svg></div><div class="dropdown-menu dropdown-menu-end"><a class="dropdown-item" href="javascript:void(0)" id="rt" onclick="openChangeStatusModal('+data['leads_id']+')">Change stage</a><a class="dropdown-item" href="javascript:void(0)" id="rt" onclick="showStatusModal('+data['leads_id']+')">Show stages</a><a class="dropdown-item" href="javascript:void(0)" id="rt"  onclick="guset_count_edit('+data['leads_id']+')">Guest count</a><a class="dropdown-item" href="javascript:void(0)" id="rt"  onclick="accomodation_plan('+data['leads_id']+')">Accomodation plan</a><a class="dropdown-item" href="javascript:void(0)" id="rt" onclick="edit_leads('+data['leads_id']+')">Edit</a><a class="dropdown-item" href="<?php echo base_url();?>index.php/Room_tariff_management/View/'+data['room_tariff_hike_id']+'" >View Details</a><a class="dropdown-item" href="javascript:void(0)" onclick="return delete_leads('+data['leads_id']+')">Delete</a></div></div>');

              }

              if(data['leads_accomodation_status'] == 2){

                $('td', row).eq(13).html('<div class="dropdown ms-auto text-end"><div class="btn-link" data-bs-toggle="dropdown"><svg width="24px" height="24px" viewBox="0 0 24 24" version="1.1"><g stroke="none" stroke-width="1" fill="none" fill-rule="evenodd"><rect x="0" y="0" width="24" height="24"></rect><circle fill="#000000" cx="5" cy="12" r="2"></circle><circle fill="#000000" cx="12" cy="12" r="2"></circle><circle fill="#000000" cx="19" cy="12" r="2"></circle></g></svg></div><div class="dropdown-menu dropdown-menu-end"><a class="dropdown-item" href="javascript:void(0)" id="rt" onclick="openChangeStatusModal('+data['leads_id']+')">Change stage</a><a class="dropdown-item" href="javascript:void(0)" id="rt" onclick="showStatusModal('+data['leads_id']+')">Show stages</a><a class="dropdown-item" href="javascript:void(0)" id="rt"  onclick="guset_count_edit('+data['leads_id']+')">Guest count</a><a class="dropdown-item" href="javascript:void(0)" id="rt"  onclick="accomodation_plan('+data['leads_id']+')">Accomodation plan</a><a class="dropdown-item" href="javascript:void(0)" id="rt" onclick="open_quotation('+data['leads_id']+')">Quotation</a><a class="dropdown-item" href="javascript:void(0)" id="rt" onclick="edit_leads('+data['leads_id']+')">Edit</a><a class="dropdown-item" href="<?php echo base_url();?>index.php/Room_tariff_management/View/'+data['room_tariff_hike_id']+'" >View Details</a><a class="dropdown-item" href="javascript:void(0)" onclick="return delete_leads('+data['leads_id']+')">Delete</a></div></div>');

              }
            }


            // $('td', row).eq(13).html('<div class="dropdown ms-auto text-end"><div class="btn-link" data-bs-toggle="dropdown"><svg width="24px" height="24px" viewBox="0 0 24 24" version="1.1"><g stroke="none" stroke-width="1" fill="none" fill-rule="evenodd"><rect x="0" y="0" width="24" height="24"></rect><circle fill="#000000" cx="5" cy="12" r="2"></circle><circle fill="#000000" cx="12" cy="12" r="2"></circle><circle fill="#000000" cx="19" cy="12" r="2"></circle></g></svg></div><div class="dropdown-menu dropdown-menu-end"><a class="dropdown-item" href="javascript:void(0)" id="rt" onclick="openChangeStatusModal('+data['leads_id']+')">Change stage</a><a class="dropdown-item" href="javascript:void(0)" id="rt" onclick="showStatusModal('+data['leads_id']+')">Show stages</a><a class="dropdown-item" href="javascript:void(0)" id="rt" onclick="open_quotation('+data['leads_id']+')">Quotation</a><a class="dropdown-item" href="javascript:void(0)" id="rt" onclick="edit_leads('+data['leads_id']+')">Edit</a><a class="dropdown-item" href="javascript:void(0)" onclick="return delete_leads('+data['leads_id']+')">Delete</a><a class="dropdown-item" href="javascript:void(0)" id="rt"  onclick="guset_count_edit('+data['leads_id']+')">Guest count</a><a class="dropdown-item" href="javascript:void(0)" id="rt"  onclick="accomodation_plan('+data['leads_id']+')">Accomodation plan</a><a class="dropdown-item" href="<?php echo base_url();?>index.php/Room_tariff_management/View/'+data['room_tariff_hike_id']+'" >View Details</a></div></div>');
            
            // if(data['leads_accomodation_status'] == 0){
            
            // $('td', row).eq(13).html('<div class="dropdown ms-auto text-end"><div class="btn-link" data-bs-toggle="dropdown"><svg width="24px" height="24px" viewBox="0 0 24 24" version="1.1"><g stroke="none" stroke-width="1" fill="none" fill-rule="evenodd"><rect x="0" y="0" width="24" height="24"></rect><circle fill="#000000" cx="5" cy="12" r="2"></circle><circle fill="#000000" cx="12" cy="12" r="2"></circle><circle fill="#000000" cx="19" cy="12" r="2"></circle></g></svg></div><div class="dropdown-menu dropdown-menu-end"><a class="dropdown-item" href="javascript:void(0)" id="rt" onclick="openChangeStatusModal('+data['leads_id']+')">Change stage</a><a class="dropdown-item" href="javascript:void(0)" id="rt" onclick="showStatusModal('+data['leads_id']+')">Show stages</a><a class="dropdown-item" href="javascript:void(0)" id="rt"  onclick="guset_count_edit('+data['leads_id']+')">Guest count</a><a class="dropdown-item" href="javascript:void(0)" id="rt" onclick="edit_leads('+data['leads_id']+')">Edit</a><a class="dropdown-item" href="<?php echo base_url();?>index.php/Room_tariff_management/View/'+data['room_tariff_hike_id']+'" >View Details</a><a class="dropdown-item" href="javascript:void(0)" onclick="return delete_leads('+data['leads_id']+')">Delete</a></div></div>');
            // }
            
            // if(data['leads_accomodation_status'] == 1){

            //   $('td', row).eq(13).html('<div class="dropdown ms-auto text-end"><div class="btn-link" data-bs-toggle="dropdown"><svg width="24px" height="24px" viewBox="0 0 24 24" version="1.1"><g stroke="none" stroke-width="1" fill="none" fill-rule="evenodd"><rect x="0" y="0" width="24" height="24"></rect><circle fill="#000000" cx="5" cy="12" r="2"></circle><circle fill="#000000" cx="12" cy="12" r="2"></circle><circle fill="#000000" cx="19" cy="12" r="2"></circle></g></svg></div><div class="dropdown-menu dropdown-menu-end"><a class="dropdown-item" href="javascript:void(0)" id="rt" onclick="openChangeStatusModal('+data['leads_id']+')">Change stage</a><a class="dropdown-item" href="javascript:void(0)" id="rt" onclick="showStatusModal('+data['leads_id']+')">Show stages</a><a class="dropdown-item" href="javascript:void(0)" id="rt"  onclick="guset_count_edit('+data['leads_id']+')">Guest count</a><a class="dropdown-item" href="javascript:void(0)" id="rt"  onclick="accomodation_plan('+data['leads_id']+')">Accomodation plan</a><a class="dropdown-item" href="javascript:void(0)" id="rt" onclick="edit_leads('+data['leads_id']+')">Edit</a><a class="dropdown-item" href="<?php echo base_url();?>index.php/Room_tariff_management/View/'+data['room_tariff_hike_id']+'" >View Details</a><a class="dropdown-item" href="javascript:void(0)" onclick="return delete_leads('+data['leads_id']+')">Delete</a></div></div>');

            // }

            // if(data['leads_accomodation_status'] == 2){

            //   $('td', row).eq(13).html('<div class="dropdown ms-auto text-end"><div class="btn-link" data-bs-toggle="dropdown"><svg width="24px" height="24px" viewBox="0 0 24 24" version="1.1"><g stroke="none" stroke-width="1" fill="none" fill-rule="evenodd"><rect x="0" y="0" width="24" height="24"></rect><circle fill="#000000" cx="5" cy="12" r="2"></circle><circle fill="#000000" cx="12" cy="12" r="2"></circle><circle fill="#000000" cx="19" cy="12" r="2"></circle></g></svg></div><div class="dropdown-menu dropdown-menu-end"><a class="dropdown-item" href="javascript:void(0)" id="rt" onclick="openChangeStatusModal('+data['leads_id']+')">Change stage</a><a class="dropdown-item" href="javascript:void(0)" id="rt" onclick="showStatusModal('+data['leads_id']+')">Show stages</a><a class="dropdown-item" href="javascript:void(0)" id="rt"  onclick="guset_count_edit('+data['leads_id']+')">Guest count</a><a class="dropdown-item" href="javascript:void(0)" id="rt"  onclick="accomodation_plan('+data['leads_id']+')">Accomodation plan</a><a class="dropdown-item" href="javascript:void(0)" id="rt" onclick="open_quotation('+data['leads_id']+')">Quotation</a><a class="dropdown-item" href="javascript:void(0)" id="rt" onclick="edit_leads('+data['leads_id']+')">Edit</a><a class="dropdown-item" href="<?php echo base_url();?>index.php/Room_tariff_management/View/'+data['room_tariff_hike_id']+'" >View Details</a><a class="dropdown-item" href="javascript:void(0)" onclick="return delete_leads('+data['leads_id']+')">Delete</a></div></div>');

            // }
            
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
            { "data": "end_date", "orderable": false },
            { "data": "packages_title", "orderable": false },
            { "data": "lead_current_status", "orderable": false },
            { "data": "stages_button", "orderable": false },
            { "data": "priority_status_button", "orderable": false },
            { "data": "leads_createdby_username", "orderable": false },                      
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

            //   $('td', row).eq(13).html('<div class="dropdown ms-auto text-end"><div class="btn-link" data-bs-toggle="dropdown"><svg width="24px" height="24px" viewBox="0 0 24 24" version="1.1"><g stroke="none" stroke-width="1" fill="none" fill-rule="evenodd"><rect x="0" y="0" width="24" height="24"></rect><circle fill="#000000" cx="5" cy="12" r="2"></circle><circle fill="#000000" cx="12" cy="12" r="2"></circle><circle fill="#000000" cx="19" cy="12" r="2"></circle></g></svg></div><div class="dropdown-menu dropdown-menu-end"><a class="dropdown-item" href="javascript:void(0)" id="rt" onclick="openChangeStatusModal('+data['leads_id']+')">Change status</a><a class="dropdown-item" href="javascript:void(0)" id="rt" onclick="showStatusModal('+data['leads_id']+')">Show status</a><a class="dropdown-item" href="javascript:void(0)" id="rt" onclick="edit_room_tariff('+data['room_tariff_hike_id']+')">Edit</a><a class="dropdown-item" href="javascript:void(0)" onclick="return delete_room_tariff('+data['room_tariff_hike_id']+')">Delete</a><a class="dropdown-item" href="javascript:void(0)" id="rt"  onclick="guset_count('+data['leads_id']+')">Guest count</a><a class="dropdown-item" href="javascript:void(0)" id="rt"  onclick="accomodation_plan('+data['leads_id']+')">Accomodation plan</a><a class="dropdown-item" href="<?php echo base_url();?>index.php/Room_tariff_management/View/'+data['room_tariff_hike_id']+'" >View Details</a></div></div>');
            // }
            
            //  if(data['leads_accomodation_status'] == 1){
              
            //   $('td', row).eq(13).html('<div class="dropdown ms-auto text-end"><div class="btn-link" data-bs-toggle="dropdown"><svg width="24px" height="24px" viewBox="0 0 24 24" version="1.1"><g stroke="none" stroke-width="1" fill="none" fill-rule="evenodd"><rect x="0" y="0" width="24" height="24"></rect><circle fill="#000000" cx="5" cy="12" r="2"></circle><circle fill="#000000" cx="12" cy="12" r="2"></circle><circle fill="#000000" cx="19" cy="12" r="2"></circle></g></svg></div><div class="dropdown-menu dropdown-menu-end"><a class="dropdown-item" href="javascript:void(0)" id="rt" onclick="openChangeStatusModal('+data['leads_id']+')">Change status</a><a class="dropdown-item" href="javascript:void(0)" id="rt" onclick="showStatusModal('+data['leads_id']+')">Show status</a><a class="dropdown-item" href="javascript:void(0)" id="rt" onclick="edit_room_tariff('+data['room_tariff_hike_id']+')">Edit</a><a class="dropdown-item" href="javascript:void(0)" onclick="return delete_room_tariff('+data['room_tariff_hike_id']+')">Delete</a><a class="dropdown-item" href="javascript:void(0)" id="rt"  onclick="guset_count_edit('+data['leads_id']+')">Guest count</a><a class="dropdown-item" href="javascript:void(0)" id="rt"  onclick="accomodation_plan('+data['leads_id']+')">Accomodation plan</a><a class="dropdown-item" href="<?php echo base_url();?>index.php/Room_tariff_management/View/'+data['room_tariff_hike_id']+'" >View Details</a></div></div>');
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
    
function add_leads()
{ 
    save_method = 'add';
    $("#id").val('');
    $('#form')[0].reset(); // reset form on modals
    $('#form').removeClass('was-validated');
    //  resetSelect2Validation();
    $('.form-group').removeClass('input-warning-o'); // clear error class
    $('.help-block').empty(); // clear error string
    $('#LeadsModal').modal('show'); // show bootstrap modal
    $('.modal-title').text('Add leads Details'); // Set Title to Bootstrap modal title
    $('#country_id_fk').val('99').trigger('change.select2');
    $('#staff_id_fk1').val('').trigger('change.select2');
    $('#source_id_fk1').val('').trigger('change.select2');
    $('#priority_status_id_fk').val('').trigger('change.select2');
    $('#package_id_fk').val('').trigger('change.select2');
    $('#date_type').val('').trigger('change.select2');
    $('[name="lead_type_txt"]').html('B2C');
    $('[name="lead_type"]').val('B2C');
    $('#btnSave').text('save');
    
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

function edit_leads(id)
{
    save_method = 'update';

    $('#form')[0].reset();
    $('.form-group').removeClass('input-warning-o');
    $('.help-block').empty();

    $.ajax({
        url: "<?php echo base_url();?>index.php/Leads/ajax_edit/" + id,
        type: "GET",
        dataType: "JSON",
        success: function(data)
        {
            $('[name="id"]').val(data.leads_id);
            $('[name="lead_type_txt"]').html(data.lead_type);
            $('[name="lead_type"]').val(data.lead_type);
            $('[name="staff_id_fk"]').val(data.staff_id_fk).trigger('change.select2');
            $('[name="source_id_fk"]').val(data.source_id_fk).trigger('change.select2');
            $('[name="guest_name"]').val(data.guest_name);
            $('[name="agent_id_fk"]').val(data.agent_id_fk);
            $('[name="country_id_fk"]').val(data.country_id_fk).trigger('change.select2');
            $('[name="priority_status_id_fk"]').val(data.priority_status_id_fk).trigger('change.select2');
            $('[name="stage_id_fk"]').val(data.stage_id_fk);
            $('[name="date_type"]').val(data.date_type).trigger('change.select2');

            $('[name="start_date"]').val(data.start_date);
            $('[name="end_date"]').val(data.end_date);

            $('[name="whats_number"]').val(data.whats_number);
            $('[name="alternative_number"]').val(data.alternative_number);

            $('[name="total_package_cost"]').val(data.total_package_cost);
            $('[name="expense"]').val(data.expense);
            $('[name="margin"]').val(data.margin);

            $('[name="description"]').val(data.description);

            // Set duration
            $('[name="duration"]').val(data.duration);

            // Store package id for later selection
            edit_package_id = data.package_id_fk;

            // Trigger duration change to load packages
            $('#duration').trigger('change');

            $('#LeadsModal').modal('show');
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
    'start_date',
    'duration',
    'package_id_fk'
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
                if (isAdd && data.lead_id) {
                    guset_count(data.lead_id);
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

// function accomodation_plan(id)
// {
//   $.ajax({
//     url: "<?php echo base_url('index.php/Leads/ajax_accommodation_plan/'); ?>" + id,
//     type: "GET",
//     dataType: "JSON",
//     success: function (res) {

//       $('#lead_id_fk').val(res.lead.leads_id);
//       $('#pacakage_id_fk').val(res.lead.package_id_fk);

//       let tbody = $('#accommodationTableBody');
//       tbody.empty();

//       $.each(res.days, function (i, day) {

//         // ✅ existing record for this day_id (if saved earlier)
//         // IMPORTANT: day.packages_itinerary_days_id must match accommodation_plan.day_id_fk
//         const ex = res.existing && res.existing[day.packages_itinerary_days_id]
//           ? res.existing[day.packages_itinerary_days_id]
//           : null;

//         // choose status (existing takes priority, otherwise use day default)
//         const selectedStatus = ex
//           ? ex.accomodation_required_staus
//           : (day.accomodation_required_staus || '');

//         const selectedDestination = ex ? ex.stay_destination_id_fk : '';
//         const selectedMeal        = ex ? ex.meal_plan_id_fk : '';
//         const selectedPax         = ex ? ex.guset_count_details_id_fk : '';

//         // Destination options
//         let destinationOptions = '<option value="">Select Destination</option>';
//         $.each(res.destinations, function (_, d) {
//           let sel = (String(d.state_id) === String(selectedDestination)) ? 'selected' : '';
//           destinationOptions += `<option value="${d.state_id}" ${sel}>${d.state_name}</option>`;
//         });

//         // Meal options
//         let mealOptions = '<option value="">Select Meal Plan</option>';
//         $.each(res.meal_plans, function (_, m) {
//           let sel = (String(m.meal_plan_id) === String(selectedMeal)) ? 'selected' : '';
//           mealOptions += `<option value="${m.meal_plan_id}" ${sel}>${m.meal_plan_name}</option>`;
//         });

//         // Pax options
//         let paxOptions = '<option value="">Select Pax Plan</option>';
//         let singleValue = null;

//         $.each(res.pax_plans, function (_, p) {
//           let sel = (String(p.guset_count_details_id) === String(selectedPax)) ? 'selected' : '';
//           paxOptions += `<option value="${p.guset_count_details_id}" ${sel}>
//               ${p.pax_count_plan} (${p.adults}A + ${p.children}C)
//             </option>`;

//           if (p.guset_count_details_type === 'S') {
//             singleValue = p.guset_count_details_id;
//           }
//         });

//         const dayLabel = day.packages_itineraries_days_day || ('Day ' + (i+1));

//         tbody.append(`
//           <tr class="acc-row">
//             <td>
//               <input type="hidden" name="itinerary_day_id[]" value="${day.packages_itinerary_days_id}">
//               <input type="hidden" name="day[]" value="${dayLabel}">
//               <span class="fw-semibold">${dayLabel}</span>
//             </td>

//             <td>
//               <div class="field-wrap">
//                 <select name="accommodation_status[]" class="form-control acc-status lst-flt-select2">
//                   <option value="">Select</option>
//                   <option value="R" ${selectedStatus==='R'?'selected':''}>Required</option>
//                   <option value="N" ${selectedStatus==='N'?'selected':''}>Not Required</option>
//                 </select>
//                 <span class="state-ico"></span>
//               </div>
//             </td>

//             <td>
//               <div class="field-wrap">
//                 <select name="stay_destination_id[]" class="form-control acc-field lst-flt-select2">
//                   ${destinationOptions}
//                 </select>
//                 <span class="state-ico"></span>
//               </div>
//             </td>

//             <td>
//               <div class="field-wrap">
//                 <select name="meal_plan_id[]" class="form-control acc-field lst-flt-select2">
//                   ${mealOptions}
//                 </select>
//                 <span class="state-ico"></span>
//               </div>
//             </td>

//             <td>
//               <div class="field-wrap">
//                 <select name="pax_count_plan_id[]" class="form-control acc-field lst-flt-select2 pax-plan">
//                   ${paxOptions}
//                 </select>
//                 <span class="state-ico"></span>
//               </div>
//             </td>
//           </tr>
//         `);

//         // ✅ Apply Same-guest rule (auto-select + disable pax plan)
//         const $row = tbody.find('tr.acc-row').last();
//         const $paxSelect = $row.find('select[name="pax_count_plan_id[]"]');

//         if (singleValue) {
//           // if no existing selected pax, force single
//           if (!selectedPax) $paxSelect.val(singleValue);
//           $paxSelect.prop('disabled', true);
//           if (!$paxSelect.next('small').length) {
//             $paxSelect.after('<small class="text-muted d-block">Auto-selected single Pax Plan</small>');
//           }
//         } else {
//           $paxSelect.prop('disabled', false);
//           $paxSelect.next('small').remove();
//         }

//         // ✅ If status is N, disable other fields
//         if (selectedStatus === 'N') {
//           $row.find('.acc-field').prop('disabled', true).val('').trigger('change');
//           $row.addClass('table-secondary');
//         }
//       });

//       // select2 inside modal
//       initSelect2AccModal();

//       // validate + disable save if invalid
//       validateAllAccRows();

//       $('#accomodation_planModal').modal('show');
//     },
//     error: function(xhr){
//       console.log('AJAX error:', xhr.responseText);
//       alert('Failed to load accommodation plan (see console)');
//     }
//   });
// }

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
            let singleValue = null;
            $.each(res.pax_plans || [], function (_, p) {
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
            let selectedPax = ex
                ? ex.guset_count_details_id_fk
                : (singleValue || '');

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
                        <select name="stay_destination_id[]" class="form-control acc-field lst-flt-select2">
                            ${destinationOptions}
                        </select>
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

$(document).on('change', '.acc-status', function () {

    let $row = $(this).closest('tr.acc-row');
    let statusVal = $(this).val();

    let $dest = $row.find('select[name="stay_destination_id[]"]');
    let $meal = $row.find('select[name="meal_plan_id[]"]');
    let $pax  = $row.find('select[name="pax_count_plan_id[]"]');

    if (statusVal === 'N') {
        // disable and clear when not required
        $dest.val('').trigger('change');
        $meal.val('').trigger('change');
        $pax.val('').trigger('change');

        $dest.prop('disabled', true);
        $meal.prop('disabled', true);
        $pax.prop('disabled', true);

        $row.addClass('table-secondary');
    }
    else if (statusVal === 'R') {
        // enable again
        $dest.prop('disabled', false);
        $meal.prop('disabled', false);
        $pax.prop('disabled', false);

        // restore defaults
        let defaultDest = $row.attr('data-default-destination') || '';
        let defaultMeal = $row.attr('data-default-meal') || '';
        let defaultPax  = $row.attr('data-default-pax') || '';

        $dest.val(defaultDest).trigger('change');
        $meal.val(defaultMeal).trigger('change');
        $pax.val(defaultPax).trigger('change');

        $row.removeClass('table-secondary');
    }

    validateAllAccRows();
});

function guset_count(id)
{
     $.ajax({
        url : "<?php echo base_url();?>index.php/Leads/ajax_edit/" + id,
        type: "GET",
        dataType: "JSON",
        success: function(data)
        {

            // ✅ always reset first
            // resetGuestCountModal();

            $('[name="guset_count_lead_id_fk"]').val(data.leads_id);
            $('[name="lead_type_count"]').val(data.lead_type);
            $('[name="guset_count_package_id_fk"]').val(data.package_id_fk);
            $('#gusetcountModal').modal('show'); // show bootstrap modal when complete loaded
            $('.modal-title1').text('Add Guest count Details'); // Set title to Bootstrap modal title
            $('#btnSave').text('save'); 

        },
        error: function (jqXHR, textStatus, errorThrown)
        {
            alert('Error get data from ajax');
        }
    });
    
    // $('#deleterowModal').modal('show'); // show bootstrap modal
        // ajax delete data to database 
}



document.addEventListener('DOMContentLoaded', function () {

  const sameRadio = document.getElementById('ds');
  const diffRadio = document.getElementById('df');
  const addPlanBtn = document.getElementById('addInclusionBtn');
  const saveBtn = document.getElementById('btnSaveGuest');
  const tableBody = document.querySelector('#inclusionTable tbody');

  let planIndex = 1;

  loadSameGuest();

  sameRadio.addEventListener('change', loadSameGuest);
  diffRadio.addEventListener('change', loadDifferentGuest);
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

  function addPlan(removable) {
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
      removeBtn.onclick = () => {
        childRow.remove();
        paxRow.remove();
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

    document.querySelectorAll('#inclusionTable tbody tr.pax-row').forEach(paxRow => {
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
    if (adults <= 0 || children <= 0) {
      errEl.textContent = 'Adults and Children must be greater than 0';
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
    const tbody = document.querySelector('#inclusionTable tbody');
    if (tbody) {
        tbody.innerHTML = '';
    }

    // reset plan index
    planIndex = 1;

    // hide add plan button for same guest count
    $('#addInclusionBtn').hide();

    // rebuild one default same guest count row
    loadSameGuest();

    // clear validation / save state
    $('#btnSaveGuest').prop('disabled', false);
}

// function openGuestCountModal(leadId) {

//   // ✅ ALWAYS set lead id (required by backend)
//   $('#guset_count_lead_id_fk').val(leadId);

//   $.ajax({
//     url: "<?php echo site_url('Leads/ajax_get_guest_count'); ?>/" + leadId,
//     type: "GET",
//     dataType: "json",
//     success: function(res){

//       if (!res.status) { alert('Fetch failed'); return; }

//       if (!res.exists) {
//         guset_count(leadId);
//         return;
//       }
//       $('[name="lead_type_count"]').val(res.master.lead_type);
//       // ✅ set package id (required by backend)
//       // take it from master record (recommended)
//       $('#guset_count_package_id_fk').val(res.master.guset_count_package_id_fk);

//       // ✅ set master id (for update endpoint, if you use it)
//       $('#guset_count_id').val(res.master.guset_count_id);

//       // type selection...
//       if (res.master.guset_count_type === 'D') $('#df').prop('checked', true);
//       else $('#ds').prop('checked', true);

//       // rebuild plans...
//       const tbody = document.querySelector('#inclusionTable tbody');
//       tbody.innerHTML = '';
//       planIndex = 1;

//       document.getElementById('addInclusionBtn').style.display =
//         (res.master.guset_count_type === 'D') ? 'inline-block' : 'none';

//       res.details.forEach(function(detail, idx){
//         addPlanFromData(detail, idx, res.master.guset_count_type === 'D');
//       });

//       $('#gusetcountModal').modal('show');
//     }
//   });
// }

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
            if (!res.exists || !res.master || !res.master.guset_count_id) {
                guset_count(leadId);
                return;
            }
            $('[name="lead_type_count"]').val(res.master.lead_type);
            // fill ids
            $('#guset_count_id').val(res.master.guset_count_id);
            $('#guset_count_package_id_fk').val(res.master.guset_count_package_id_fk);

            // radio type
            if (res.master.guset_count_type === 'D') {
                $('#df').prop('checked', true);
                $('#ds').prop('checked', false);
                $('#addInclusionBtn').show();
            } else {
                $('#ds').prop('checked', true);
                $('#df').prop('checked', false);
                $('#addInclusionBtn').hide();
            }

            const tbody = document.querySelector('#inclusionTable tbody');
            tbody.innerHTML = '';
            planIndex = 1;

            // load saved details
            res.details.forEach(function(detail, idx){
                addPlanFromData(detail, idx, res.master.guset_count_type === 'D');
            });

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
  const tbody = document.querySelector('#inclusionTable tbody');
  tbody.innerHTML = '';
  planIndex = 1;

  // build each plan
  res.details.forEach((d, idx) => {
    addPlanFromData(d, idx, res.master.guset_count_type === 'D');
  });
}

function addPlanFromData(detail, idx, removable){
  const tbody = document.querySelector('#inclusionTable tbody');
  const planNo = idx + 1;

  const paxRow = document.createElement('tr');
  paxRow.classList.add('pax-row');
  paxRow.innerHTML = `
    <td>
      <strong>${detail.pax_count_plan || ('Plan ' + planNo)}</strong>
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
      validateAllPlans(); // ✅ IMPORTANT
    };
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
    if (childrenAllowed <= 0){
      setInvalid(child, 'Children > 0');
      ok = false;
    } else setValid(child);

    // Validate each child breakup row
    var used = 0;
    var rowError = false;

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
    document.querySelectorAll('#inclusionTable tbody tr.pax-row').forEach(function(pr){
      var cr = pr.nextElementSibling;
      if (!cr) return;

      var a = pr.querySelector('.adult');
      var c = pr.querySelector('.child');
      if (toInt(a.value) <= 0 || toInt(c.value) <= 0) allOk = false;

      // exact match check
      var allowed = toInt(c.value);
      var used = 0;
      cr.querySelectorAll('.child-row .count').forEach(function(x){ used += toInt(x.value); });

      // also require age/count >0
      cr.querySelectorAll('.child-row .age, .child-row .count').forEach(function(x){
        if (toInt(x.value) <= 0) allOk = false;
      });

      if (allowed <= 0 || used !== allowed) allOk = false;
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

  document.querySelectorAll('#inclusionTable tbody tr.pax-row').forEach(paxRow => {

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
    if (children <= 0) {
      markInvalid(childInput);
      errEl.textContent = 'Children is required and must be greater than 0';
      hasError = true;
      return;
    } else {
      markValid(childInput);
    }

    /* ---- Child breakup validation ---- */
    let used = 0;
    let childError = false;

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
  });

  // ⛔ stop save
  if (hasError) return;

  // ✅ proceed to AJAX
  const payload = collectPayload();
  submitGuestCount(payload);
}

// function submitGuestCount(payload) {

//   const fd = new FormData();

//   fd.append('guset_count_lead_id_fk', $('#guset_count_lead_id_fk').val());
//   fd.append('guset_count_package_id_fk', $('#guset_count_package_id_fk').val());
//   fd.append('guest_type', payload.guest_type);

//   let totalGuests = 0;

//   payload.pax.forEach((p, planIndex) => {

//     fd.append('pax_count_plan[]', p.planName);
//     fd.append('adults[]', p.adults);
//     fd.append('children[]', p.children);
//     fd.append('total_count[]', p.total);

//     totalGuests += parseInt(p.total, 10) || 0;

//     // ✅ GROUPED child breakup:
//     // age[0][], count[0][] ...
//     p.childrenAge.forEach((c) => {
//       fd.append(`age[${planIndex}][]`, c.age);
//       fd.append(`count[${planIndex}][]`, c.count);
//     });

//   });

//   fd.append('guset_count_total', totalGuests);

//   $.ajax({
//     url: "<?php echo base_url('index.php/Leads/ajax_save_guest_count/'); ?>",
//     type: "POST",
//     data: fd,
//     processData: false,
//     contentType: false,
//     dataType: "json",
//     success: function(res){
//       if(res.status){
//         $('#gusetcountModal').modal('hide');
        
//         var leadtype = $('[name="lead_type_count"]').val();
//         if(leadtype == 'B2C'){
//           reload_table_guest_count_b2c();
//         }else{
//           reload_table_guest_count_meta();
//         }
//       } else {
//         console.log(res);
//         alert((res.errors && res.errors.length) ? res.errors.join("\n") : "Save failed");
//       }
//     },
//     error: function(xhr){
//       console.error(xhr.responseText);
//       alert('Save failed (server error)');
//     }
//   });
  
// }
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
        accomodation_plan(leadId);

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

function validateAccRow(row){
  let ok = true;

  const status = row.querySelector('select[name="accommodation_status[]"]');
  const dest   = row.querySelector('select[name="stay_destination_id[]"]');
  const meal   = row.querySelector('select[name="meal_plan_id[]"]');
  const pax    = row.querySelector('select[name="pax_count_plan_id[]"]');

  // reset
  [status,dest,meal,pax].forEach(e => e && clearState(e));

  // status always required
  if(!status || !status.value){
    if(status) setInvalid(status);
    ok = false;
  } else setValid(status);

  // if status Required => dest/meal/pax required
  if(status && status.value === 'R'){
    if(!dest.value){ setInvalid(dest); ok = false; } else setValid(dest);
    if(!meal.value){ setInvalid(meal); ok = false; } else setValid(meal);
    if(!pax.value){ setInvalid(pax); ok = false; } else setValid(pax);
  } else {
    // not required => clear states
    [dest,meal,pax].forEach(e => e && clearState(e));
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

// $('#btnSaveaccplan').off('click').on('click', function(e){
//   e.preventDefault();

//   if(!validateAllAccRows()){
//     return;
//   }

//   // ✅ IMPORTANT: serialize ignores disabled fields
//   // Temporarily enable disabled selects so arrays post correctly
//   const disabled = $('#form3').find(':disabled');
//   disabled.prop('disabled', false);

//   const postData = $('#form3').serialize();

//   // restore disabled state
//   disabled.prop('disabled', true);

//   $.ajax({
//     url: "<?php echo base_url('index.php/Leads/save_accommodation_plan'); ?>",
//     type: "POST",
//     data: postData,
//     dataType: "json",
//     success: function(res){
//       console.log('save_accommodation_plan response:', res);

//       if(res.status){
//         // alert(res.msg || 'Saved');
        
//         var leadtype = $('[name="lead_type_accomodation"]').val();
//         if(leadtype == 'B2C'){
//           reload_table_accomodation_b2c();
//         }else{
//           reload_table_accomodation_meta();
//         }
//         $('#accomodation_planModal').modal('hide');
//       }else{
//         alert((res.errors && res.errors.length) ? res.errors.join("\n") : (res.msg || 'Save failed'));
//       }
//     },
//     error: function(xhr){
//       console.log('SAVE ERROR:', xhr.responseText);
//       alert('Save failed (server error)');
//     }
//   });
// });


$('#btnSaveaccplan').off('click').on('click', function(e){
  e.preventDefault();

  if(!validateAllAccRows()){
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

$(document).ready(function () {

    function toggleStartDate() {
        let dateType = $('#date_type').val();

        if (dateType === 'WITHOUT') {
            $('#start_date1')
                .prop('disabled', true)
                .prop('required', false)
                .val('');
        } else {
            $('#start_date1')
                .prop('disabled', false)
                .prop('required', true);
        }
    }

    // On change
    $('#date_type').on('change', toggleStartDate);

    // On page load
    toggleStartDate();
});


// $(document).ready(function () {

//     function calculateEndDate() {
//         let dateType = $('#date_type').val();
//         let startDate = $('#start_date1').val();
//         let duration = parseInt($('#duration').val(), 10);

//         if (dateType === 'WITH' && startDate && duration > 0) {

//             // Split DD/MM/YYYY
//             let parts = startDate.split('/');
//             let day = parseInt(parts[0], 10);
//             let month = parseInt(parts[1], 10) - 1; // JS months are 0-based
//             let year = parseInt(parts[2], 10);

//             let date = new Date(year, month, day);

//             // Add duration
//             date.setDate(date.getDate() + duration);

//             // Format as YYYY-MM-DD (for input[type="date"])
//             let formattedDate = date.toISOString().split('T')[0];
//             alert(formattedDate);
//             $('#end_date1').val(formattedDate);

//         } else {
//             $('#end_date1').val('');
//         }
//     }

//     $('#start_date1, #duration, #date_type').on('change keyup', calculateEndDate);
// });

$(document).ready(function () {

    function calculateEndDate() {
        let dateType = $('#date_type').val();
        let startDate = $('#start_date1').val();
        let duration = parseInt($('#duration').val(), 10);

        if (dateType === 'WITH' && startDate && duration > 0) {

            // Split DD-MM-YYYY
            let parts = startDate.split('-');
            let day = parseInt(parts[0], 10);
            let month = parseInt(parts[1], 10) - 1;
            let year = parseInt(parts[2], 10);

            let date = new Date(year, month, day);

            // Add duration
            date.setDate(date.getDate() + duration);

            // Format YYYY-MM-DD
            let formattedDate = date.toISOString().split('T')[0];

            $('#end_date1').val(formattedDate);

        } else {
            $('#end_date1').val('');
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

    let button_html = `<center><span class="btn btn-sm" style="background-color:${color}"><span style="color:white">${name}</span></span></center>`;

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

    let button_html = `<center><span class="btn btn-sm" style="background-color:${color}"><span style="color:white">${name}</span></span></center>`;

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

$(document).ready(function () {

    function togglePackageDropdown() {
        var duration = parseInt($('#duration').val(), 10);

        if (isNaN(duration) || duration <= 0) {
            $('#package_id_fk')
                .val('')
                .prop('disabled', true)
                .trigger('change'); // important for Select2
        } else {
            $('#package_id_fk')
                .prop('disabled', false)
                .trigger('change');
        }
    }

    // Run on page load (edit case)
    togglePackageDropdown();

    // Run when duration changes
    $('#duration').on('input change keyup', function () {
        togglePackageDropdown();
    });

});



$(document).ready(function () {

    $('#duration').on('keyup change', function () {
        var duration = parseInt($(this).val(), 10);

        // Reset state
        $('#package_msg').addClass('d-none');

        if (isNaN(duration) || duration <= 0) {
            $('#package_id_fk')
                .html('<option value="">Please Select Packages</option>')
                .prop('disabled', true)
                .trigger('change');

            $('#package_msg')
                .removeClass('d-none')
                .text('Please enter a duration greater than 0.');

            return;
        }

        $.ajax({
            url: "<?php echo base_url('index.php/Leads/get_packages_by_duration'); ?>",
            type: 'POST',
            dataType: 'json',
            data: { duration: duration },
            success: function (response) {

                var options = '<option value="">Please Select Packages</option>';

                if (response.length > 0) {
                    $.each(response, function (i, pkg) {
                        options += '<option value="' + pkg.packages_id + '">' +
                                    pkg.packages_title +
                                   '</option>';
                    });

                    $('#package_id_fk')
                        .html(options)
                        .prop('disabled', false)
                        .trigger('change');

                    if(edit_package_id){
                        $('#package_id_fk')
                            .val(edit_package_id)
                            .trigger('change.select2');

                        edit_package_id = null;
                    }
                } else {
                    $('#package_id_fk')
                        .html(options)
                        .prop('disabled', true)
                        .trigger('change');

                    $('#package_msg')
                        .removeClass('d-none')
                        .text('No packages available for selected duration.');
                }
            },
            error: function () {
                $('#package_msg')
                    .removeClass('d-none')
                    .text('Something went wrong. Please try again.');
            }
        });
    });

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
        swal("Please select a different status", "", "error")
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

    let button_html = `<center><span class="btn btn-sm" style="background-color:${color}"><span style="color:white">${name}</span></span></center>`;

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



</script>