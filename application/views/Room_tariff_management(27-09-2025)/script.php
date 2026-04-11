<script>
////***Date picker *****///

$('#room_tariff_hike_from_date').bootstrapMaterialDatePicker({
         weekStart: 0,
        time: false,
        format: 'DD/MM/YYYY'
    });

$('#room_tariff_hike_to_date').bootstrapMaterialDatePicker({
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

$("#transporter_id").select2();


////***Latest dropdown select2*****///

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

// $( "#b2b_partner_person_name1" ).keypress(function() {
//             $table.ajax.reload();
// });

////***searching button*****///


////***ajax hide & show on view page*****///
$(document).ready(function() {
    $(".panel-body a").on('click', function(e) {
        e.preventDefault()
        var page = $(this).data('page');
        $("#pages .page:not('.hide')").stop().fadeOut('fast', function() {
            $(this).addClass('hide');
            $('#pages .page[data-page="'+page+'"]').fadeIn('slow').removeClass('hide');
        });
    });
});

////***ajax hide & show on view page*****///

////***Leads details on view*****///  

function Tariff_details(id){
    // var conf = confirm("Do you want to Edit details?");
    // if(conf){
        $('#Tariff_details').html();
        $.ajax({
        url:"<?php echo base_url();?>index.php/Room_tariff_management/get_data",
        type: 'POST',
        data:{id:id},
        dataType: 'json',
        success:
        function(data)
        {
             //alert(data['id']);
               document.getElementById('Id').value=data['room_tariff_hike_id'];
                //$("#properties_name").html(data['properties_name']);
                
               
               
            
        },
        
        error:function(e){
        console.log("error");
        }
      
      });
      $('.nav-link').removeClass('active');
      $('#Tariff_details').addClass('active');
}

////***Leads details on view*****///

////***Room category details*****///

function Hike_tariff_details(id){
    // alert(id);
    //var id = document.getElementById('Id').value;
    $table1 = $('#Hike_room_tariff_registration').DataTable( {
        "searching": false,
        "processing": true,
        "serverSide": true,
        "aLengthMenu": [[10, 25, 50, -1], [10, 25, 50, "All"]],
        "bDestroy" : true,
        "aLengthMenu": [[10, 25, 50, -1], [10, 25, 50, "All"]],
        // "bDestroy" : true,
        // aLengthMenu: [
          // [1, 2],
          // [1, 2]
        // ],
        // iDisplayLength: 1,
        dom: 'lBfrtip',
            buttons: [
                
                {
                                    extend: 'excel',
                                    exportOptions: {
                                        columns: [0, 1, 2, 3, 4, 5, 6]
                                    },
                                    title: 'Hike room tariff details',
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
                                        columns: [0, 1, 2, 3, 4, 5, 6]
                                    },
                                    title: 'Hike room tariff details',
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
                                        columns: [0, 1, 2, 3, 4, 5, 6]
                                    },
                                    title: 'Hike room tariff details',
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
            "url": "<?php echo base_url();?>index.php/Room_tariff_management/get_hikeRoomtariff/"+id,
            "type": "POST",
            "data" : function (d) {
                        d.properties_id = $("#properties_id").val();
                        d.property_category_id_fk = $("#property_category_id_fk").val();
                        d.properties_room_category_id = $("#properties_room_category_id").val();
                        d.room_tariff_hike_createdby_user_id = $("#room_tariff_hike_createdby_user_id").val();
                        d.start_date = $("#start_date").val();
                        d.end_date = $("#end_date").val();
                        
                        
           }
        },
        "createdRow": function ( row, data, index ) {
          
//            $('td',row).eq(0).html(index+1);
           $table1.column(0).nodes().each(function(node,index,dt){
            $table1.cell(node).data(index+1);
            });
            
           $('td', row).eq(7).html('<div class="d-flex"><a href="javascript:void(0)" id="rt" onclick="edit_room('+data['properties_room_category_id']+')" class="btn btn-primary shadow btn-xs sharp me-1"><i class="fas fa-pencil-alt"></i></a><a href="javascript:void(0)" onclick="return delete_room('+data['properties_room_category_id']+')" class="btn btn-danger shadow btn-xs sharp"><i class="fa fa-trash"></i></a></div>');

           },

        "columns": [
            { "data": "hike_room_tariff_hike_status", "orderable": false },
            { "data": "properties_name", "orderable": false },
            { "data": "hike_room_tariff_hike_from_date", "orderable": false },
            { "data": "hike_room_tariff_hike_to_date", "orderable": false },
            { "data": "hike_room_tariff_hike_description", "orderable": false },
            { "data": "hike_room_tariff_hike_createdby_user_name", "orderable": false },                      
            { "data": "hike_room_tariff_hike_id", "orderable": false }
            
   
        ]
        
    } );
    
    $('.nav-link').removeClass('active');
    $('#Hike_tariff_details').addClass('active');
    
  }
    
 
////***Hike tariff details*****///

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

$(document).ready(function(){

    $(document).on("click",'#btnSave',function(){
        $('#form').find('[required][value=""]').attr('aria-invalid', true);
    });
// $("select[name='related_type']").onchange(function(){
$("#properties_id_fk").change(function() {

var properties_id = $(this).val();
$.ajax({
      url: "<?php echo base_url(); ?>index.php/Room_tariff_management/weekdays_array_list/",
        dataType: 'json',
        type: 'POST',
        //data:{properties_id:properties_id},
        success: function(data) {
          var result1 = data;
          // console.log(result);
          var num1 = 1; var num = 1;

          /*var field1 = [];
          $.each(result1, function (i, item) {  
            field1.push('<tr><td><div class="form-check custom-checkbox checkbox-success check-lg me-3"><input type="checkbox" class="form-check-input sc_chkbox" id="customCheckBox2_'+num1+'" name="customCheckBox2['+num1+']" value="'+item.week_days_id+'" required=""><label class="form-check-label" for="customCheckBox2"></label></div></td><td><strong>'+item.week_days_name+'</strong></td><td><div class="d-flex align-items-center"><input type="text" class="form-control" name="room_tariff_week_days_rate_room_amount['+num1+']" id="room_tariff_week_days_rate_room_amount_'+num1+'" placeholder="Enter room rate" required disabled><span class="help-block" style="color:red"></span></div></td><td><input type="number" class="form-control" name="room_tariff_week_days_rate_adult_with_extra_bed['+num1+']" id="room_tariff_week_days_rate_adult_with_extra_bed_'+num1+'" placeholder="Enter Adult with Extra Bed" required disabled><span class="help-block" style="color:red"></span> </td><td><input type="number" class="form-control" name="room_tariff_week_days_rate_child_with_extra_bed['+num1+']" id="room_tariff_week_days_rate_child_with_extra_bed_'+num1+'" placeholder="Enter Child With Extra Bed" required disabled><span class="help-block" style="color:red"></span></td><td><input type="number" class="form-control" name="room_tariff_week_days_rate_child_sharing_bed['+num1+']" id="room_tariff_week_days_rate_child_sharing_bed_'+num1+'" placeholder="Enter Child Sharing Bed" required disabled><span class="help-block" style="color:red"></span></td><td><input type="number" class="form-control" name="room_tariff_week_days_rate_single_occupancy['+num1+']" id="room_tariff_week_days_rate_single_occupancy_'+num1+'" placeholder="Enter Single Occupancy rate" required disabled><span class="help-block" style="color:red"></span></td></tr>');
              num1++;
          });*/

          // $("#counter_edit1").val(num);    
                //console.log('field1: ' + field1); 
                //$("#stg").html(field);
                //$("#row2").append(field1);
            
            $.ajax({
              url: "<?php echo base_url(); ?>index.php/Room_tariff_management/rooms_array_list/",
              dataType: 'json',
              type: 'POST',
              data:{properties_id:properties_id},
              success: function(data) {    
                 var result = data;
                // console.log(result);
                var field = [];
                
                $.each(result, function (i, item) {

                    var field1 = [];
                    $.each(result1, function (i, item) {  
                        field1.push('<tr><td><div class="form-check custom-checkbox checkbox-success check-lg me-3"><input type="checkbox" class="form-check-input sc_chkbox" name="week_day_id['+num+']['+num1+']"" id="room_tariff_week_days_rate_id_'+num1+'" value="'+item.week_days_id+'"><label class="form-check-label" for="customCheckBox2"></label></div></td><td><strong>'+item.week_days_name+'</strong></td><td><div class="d-flex align-items-center"><input type="text" class="form-control" name="room_amount['+num+']['+num1+']" id="room_tariff_week_days_rate_room_amount_'+num1+'" placeholder="Enter room rate" required disabled><span class="help-block" style="color:red"></span></div></td><td><input type="number" class="form-control" name="adult_with_extra_bed['+num+']['+num1+'] id="room_tariff_week_days_rate_adult_with_extra_bed_'+num1+'" placeholder="Enter Adult with Extra Bed" required disabled><span class="help-block" style="color:red"></span> </td><td><input type="number" class="form-control" name="child_with_extra_bed['+num+']['+num1+']  id="room_tariff_week_days_rate_child_with_extra_bed_'+num1+'" placeholder="Enter Child With Extra Bed" required disabled><span class="help-block" style="color:red"></span></td><td><input type="number" class="form-control" name="child_sharing_bed['+num+']['+num1+'] id="room_tariff_week_days_rate_child_sharing_bed_'+num1+'" placeholder="Enter Child Sharing Bed" required disabled><span class="help-block" style="color:red"></span></td><td><input type="number" class="form-control" name="single_occupancy['+num+']['+num1+'] id="room_tariff_week_days_rate_single_occupancy_'+num1+'" placeholder="Enter Single Occupancy rate" required disabled><span class="help-block" style="color:red"></span></td></tr>');
                          num1++;
                    });

                    field.push('<hr><div class="profile-details"><div class="profile-name px-3 pt-2"><input type="hidden" name="room_tariff_hike_rate_id['+num+']" id="room_tariff_hike_rate_id_'+num+'"><input type="hidden" name="room_id_fk['+num+']" id="room_id_fk_'+num+'" value="'+item.properties_room_category_id+'"><h4 class="text-primary mb-0">'+item.properties_room_category_name+'</h4><!--<p>UX / UI Designer</p></div><div class="profile-email px-2 pt-2"><h4 class="text-muted mb-0">hello@email.com</h4><p>Email</p>--></div></div><div class="row rates"><div class="col-md-2"><div class="form-group"><label class="col-lg-6 col-form-label" for="room_tariff_hike_rate_room_rate"><b>Room rate</b> <span class="text-danger">*</span></label><input type="number" class="form-control" name="room_tariff_hike_rate_room_rate['+num+']" id="room_tariff_hike_rate_room_rate_'+num+'" placeholder="Enter Room rate" required><span class="help-block" style="color:red"></span></div></div><div class="col-md-2"><div class="form-group"><label class="col-lg-12 col-form-label" for="room_tariff_hike_rate_adult_with_extra_bed"><b>Adult with Extra Bed Rate</b></label><input type="number" class="form-control" name="room_tariff_hike_rate_adult_with_extra_bed['+num+']" id="room_tariff_hike_rate_adult_with_extra_bed_'+num+'" placeholder="Adult with Extra Bed Rate" required><span class="help-block" style="color:red"></span></div></div><div class="col-md-2"><div class="form-group"><label class="col-lg-12 col-form-label" for="room_tariff_hike_rate_child_with_extra_bed"><b>Child With Extra Bed Rate</b></label><input type="number" class="form-control" name="room_tariff_hike_rate_child_with_extra_bed['+num+']" id="room_tariff_hike_rate_child_with_extra_bed_'+num+'" placeholder="Child With Extra Bed Rate" required><span class="help-block" style="color:red"></span></div></div> <div class="col-md-2"><div class="form-group"><label class="col-lg-10 col-form-label" for="room_tariff_hike_rate_child_sharing_bed"><b>Child Sharing Bed Rate</b></label><input type="number" class="form-control" name="room_tariff_hike_rate_child_sharing_bed['+num+']" id="room_tariff_hike_rate_child_sharing_bed_'+num+'" placeholder="Child Sharing Bed Rate" required><span class="help-block" style="color:red"></span></div></div><div class="col-md-2"><div class="form-group"><label class="col-lg-10 col-form-label" for="room_tariff_hike_rate_single_occupancy"><b>Single Occupancy Rate</b></label><input type="number" class="form-control" name="room_tariff_hike_rate_single_occupancy['+num+']" id="room_tariff_hike_rate_single_occupancy_'+num+'" placeholder="Single Occupancy Rate" required><span class="help-block" style="color:red"></span></div></div><div class="col-md-2"><div class="form-group"><label class="col-lg-12 col-form-label" for="room_tariff_hike_rate_single_occupancy"><b>Hike on some days of week</b></label><select name="room_tariff_hike_rate_some_days_type['+num+']" id="room_tariff_hike_rate_some_days_type_'+num+'" class="form-control multi-select item" required><option value="N">No</option><option value="Y">Yes</option></select><span class="help-block" style="color:red"></span></div></div><div class="row some_days" id="some_days_'+num+'"><div class="table-responsive"><table class="table table-responsive-md"><thead><tr><th style="width:50px;"><div class="form-check custom-checkbox checkbox-success check-lg me-3"><input type="checkbox" class="form-check-input checkAll" id="checkAll" name="checkAll_'+num+'"><label class="form-check-label" for="checkAll"></label></div></th><th><strong>Weekday</strong></th><th><strong>Hike Amount Room</strong></th><th><strong>Adult with Extra Bed</strong></th><th><strong>Child With Extra Bed</strong></th><th><strong>Child Sharing Bed</strong></th><th><strong>Single Occupancy</strong></th></tr></thead><tbody>'+ field1.join('') +'</tbody></table></div></div>');
                    

                    num++;
                   
                });

                
                 // $("#counter_edit1").val(num);    
                console.log(field); 
                //$("#stg").html(field);
                //$("#row1").append(field);
                $("#row1").html(field);
                $('.some_days').hide();
              }
            });

        }

    }); 

                
             

                  
    

});

$(document).on("change",'.item',function(){
    var type = $(this).val();
    var counterId = $(this).attr("id");
    // var counter = counterId.substr(counterId.length - 1);
    var counter = counterId.split("_").pop(-1);
    // console.log(counter,"counter");

    // alert(type);


    if(type == 'Y'){

        $('#some_days_'+counter+'').show();

    }
    else{

        $('#some_days_'+counter+'').hide();
    }

});

$(document).on('change', '.checkAll', function(){
    var cur_tbl = $(this).closest('table');
    cur_tbl.find('input[type="checkbox"]').prop('checked', $(this).prop('checked'));
    if($(this).prop('checked')){
        cur_tbl.find('input[type="text"], input[type="number"]').prop('disabled',false);
    } else {
        cur_tbl.find('input[type="text"], input[type="number"]').prop('disabled',true);
    }
});

  $(document).on('change', '.sc_chkbox', function(){
    var cur_tbl = $(this).closest('tr');
    cur_tbl.find('input[type="checkbox"]').prop('checked', $(this).prop('checked'));
    if($(this).prop('checked')){
        cur_tbl.find('input[type="text"], input[type="number"]').prop('disabled',false);
    } else {
        cur_tbl.find('input[type="text"], input[type="number"]').prop('disabled',true);
    }
  });
});

////***Listing table*****///

var save_method; //for save method string
var table;
  $(document).ready(function() {
    
    
    $table = $('#Room_tariff_registration').DataTable( {
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
            "url": "<?php echo base_url();?>index.php/Room_tariff_management/get/",
            "type": "POST",
            "data" : function (d) {
                        d.properties_id = $("#properties_id").val();
                        d.property_category_id_fk = $("#property_category_id_fk").val();
                        d.properties_room_category_id = $("#properties_room_category_id").val();
                        d.room_tariff_hike_createdby_user_id = $("#room_tariff_hike_createdby_user_id").val();
                        d.start_date = $("#start_date").val();
                        d.end_date = $("#end_date").val();
           }            
        },
        // "ajax": {
            // "url": "<?php echo site_url('States/get')?>",
            // "type": "POST"
        // },
        "createdRow": function ( row, data, index ) {
          
//            $('td',row).eq(0).html(index+1);
           $table.column(0).nodes().each(function(node,index,dt){
            $table.cell(node).data(index+1);
            });
            
            

            // $('td', row).eq(5).html('<div class="form-button-action"><a  data-toggle="tooltip" title="" class="btn btn-link btn-primary btn-lg" data-original-title="Edit Task" href="javascript:void(0)" onclick="edit_role('+data['roles_id']+')"><i class="fa fa-edit"></i></a><button type="button" data-toggle="tooltip" title="" class="btn btn-link btn-danger" data-original-title="Remove" href="javascript:void(0)" onclick="return delete_role('+data['roles_id']+')"><i class="fa fa-times"></i></button></div>');

            // $('td', row).eq(6).html('<div class="d-flex"><a href="javascript:void(0)" onclick="edit_room_tariff('+data['room_tariff_hike_id']+')" class="btn btn-primary shadow btn-xs sharp me-1"><i class="fas fa-pencil-alt"></i></a><a href="javascript:void(0)" onclick="return delete_room_tariff('+data['room_tariff_hike_id']+')" class="btn btn-danger shadow btn-xs sharp"><i class="fa fa-trash"></i></a></div>');

             $('td', row).eq(6).html('<div class="dropdown ms-auto text-end"><div class="btn-link" data-bs-toggle="dropdown"><svg width="24px" height="24px" viewBox="0 0 24 24" version="1.1"><g stroke="none" stroke-width="1" fill="none" fill-rule="evenodd"><rect x="0" y="0" width="24" height="24"></rect><circle fill="#000000" cx="5" cy="12" r="2"></circle><circle fill="#000000" cx="12" cy="12" r="2"></circle><circle fill="#000000" cx="19" cy="12" r="2"></circle></g></svg></div><div class="dropdown-menu dropdown-menu-end"><a class="dropdown-item" href="javascript:void(0)" id="rt" onclick="edit_room_tariff('+data['room_tariff_hike_id']+')">Edit</a><a class="dropdown-item" href="javascript:void(0)" onclick="return delete_room_tariff('+data['room_tariff_hike_id']+')">Delete</a><a class="dropdown-item" href="<?php echo base_url();?>index.php/Room_tariff_management/View/'+data['room_tariff_hike_id']+'" >View Details</a></div></div>');
            
            var staff_id_fk = data['room_tariff_hike_id'];

            // $.ajax({
            //           url: "<?php echo base_url(); ?>index.php/Transporter/vehicle_array_list/",
            //           dataType: 'json',
            //           type: 'POST',
            //           data:{staff_id_fk: staff_id_fk},
            //           success: function(data) {
            //             var result = data;
            //             console.log(result);
            //             var field = [];
            //             $.each(result, function (i, item) {
            //                 // $('#myTable tbody').append('<tr><td>' + item.customer_name + '</td><td>' + item.customer_address + '</td></tr>');
            //                 //field.push(item.task_assigning_datetime);
                            

            //                        field.push('<span class="badge badge-secondary">'+item.vehicle_name+'</span>');
                            

                            
            //                 //var tt = 'Date : '+item.task_assigning_datetime;
            //             });

            //             //console.log(field);
            //             var str1 = field.toString(); // Gives you "42,55"
            //             var str2 = String(field); // Ditto
            //             $('td', row).eq(4).html(field);
            //         }
            //     });
            
           },

           "drawCallback": function( settings ) {
                // displaySelectByUserType();
            },

        "columns": [
            { "data": "room_tariff_hike_status", "orderable": false },
            { "data": "properties_name", "orderable": false },
            { "data": "room_tariff_hike_from_date", "orderable": false },
            { "data": "room_tariff_hike_to_date", "orderable": false },
            { "data": "room_tariff_hike_description", "orderable": false },
            { "data": "room_tariff_hike_createdby_user_name", "orderable": false },                      
            { "data": "room_tariff_hike_id", "orderable": false }
            
            
        ]
        
    });
    
  

  });
    
 
////***Listing table*****///

////***For close the modal *****///
function RoomTariffmodalclose()
{

    $('#RoomTariffModal').modal('hide');
   
    //$( "div" ).remove( ".modal-backdrop" );
    $('#properties_id_fk').val('');
    $('#room_tariff_hike_from_date').val('');
    $('#transporter_base_station_id_fk').val('').change();
    // $('#vehicle_id_fk').val('0').change();
    $('#category_name_alert').hide();
    $('.submit').removeAttr('disabled');
    $('.form-group').removeClass('input-success-o');
    $('.form-group').removeClass('input-warning-o');
    $('.properties_id_fk').removeClass('input-success-o');
    $('.properties_id_fk').removeClass('input-warning-o');
    $('.room_tariff_hike_from_date').removeClass('input-success-o');
    $('.room_tariff_hike_from_date').removeClass('input-warning-o');
    // $('#btnSave').removeAttr('disabled');
}
////***For close the modal *****///

////***For open the modal *****///
$('#RoomTariffModal').on('shown.bs.modal', function () {
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
    
////***For open modal of room tariff adding form  *****///
    
function add_room_tariff()
{ 
    save_method = 'add';
    $("#id").val('');
    $('#form')[0].reset(); // reset form on modals
    $('.form-group').removeClass('input-warning-o'); // clear error class
    $('.help-block').empty(); // clear error string
    $('#RoomTariffModal').modal('show'); // show bootstrap modal
    $('.modal-title').text('Add room tariff Details'); // Set Title to Bootstrap modal title
    $('#btnSave').text('save');
    $(".profile-details").remove();
    $(".rates").remove();
    $("hr").remove();
    $(".some_days").remove();
}

////***For open modal of room tariff adding form  *****///

////***For editing room tariff details from adding modal form  *****///

function edit_room_tariff(id)
{
    var num_2 = 1;
    save_method = 'update';
    $('#form')[0].reset(); // reset form on modals
    $('.form-group').removeClass('input-warning-o'); // clear error class
    $('.help-block').empty(); // clear error string

    //Ajax Load data from ajax
    $.ajax({
        url : "<?php echo base_url();?>index.php/Room_tariff_management/ajax_edit/" + id,
        type: "GET",
        dataType: "JSON",
        success: function(data)
        {
         // .trigger('change.select2')
            
            $('[name="id"]').val(data.room_tariff_hike_id);
            $('[name="properties_id_fk"]').val(data.properties_id_fk);
            $('[name="room_tariff_hike_from_date"]').val(data.room_tariff_hike_from_date);
            $('[id="room_tariff_hike_to_date"]').val(data.room_tariff_hike_to_date);
            $('[id="room_tariff_hike_breakfast_rate_adult"]').val(data.room_tariff_hike_breakfast_rate_adult);
            $('[id="room_tariff_hike_breakfast_rate_child"]').val(data.room_tariff_hike_breakfast_rate_child);  
            $('[name="room_tariff_hike_lunch_rate_adult"]').val(data.room_tariff_hike_lunch_rate_adult); 
            $('[name="room_tariff_hike_lunch_rate_child"]').val(data.room_tariff_hike_lunch_rate_child);
            $('[name="room_tariff_hike_dinner_rate_adult"]').val(data.room_tariff_hike_dinner_rate_adult);
            $('[name="room_tariff_hike_dinner_rate_child"]').val(data.room_tariff_hike_dinner_rate_child);
            $('[name="room_tariff_hike_description"]').val(data.room_tariff_hike_description);
                 
            $('#RoomTariffModal').modal('show'); // show bootstrap modal when complete loaded
            $('.modal-title').text('Edit room tariff Details'); // Set title to Bootstrap modal title
            $('#btnSave').text('update');

//$("#vehicle_id_fk").val(['1', '2']).prop('selected', true).trigger('change.select2');
            var properties_id = data.properties_id_fk;
            $.ajax({
              url: "<?php echo base_url(); ?>index.php/Room_tariff_management/fetch_property_rooms/",
              dataType: 'json',
              type: 'POST',
              data:{properties_id:properties_id},
              success: function(data) {
                var result = data;
                // console.log(result);
                var field = [];
                
                $.each(result, function (i, item) {


                            field.push('<div class="row"><div class="col-md-3"><div class="form-group"><label class="col-lg-5 col-form-label" for="room_id_fk"><b>Room details</b> <span class="text-danger">*</span></label><div class="input-group clockpicker"><input type="text" class="form-control" name="room_id_fk" id="room_id_fk" placeholder="Enter check in time" required><span class="input-group-text"><i class="far fa-clock"></i></span><span class="help-block" style="color:red"></span></div></div></div><div class="col-md-3"><div class="form-group"><label class="col-lg-6 col-form-label" for="room_tariff_hike_rate_room_rate"><b>Room rate</b> <span class="text-danger">*</span></label><div class="input-group clockpicker"><input type="text" class="form-control" name="room_tariff_hike_rate_room_rate" id="room_tariff_hike_rate_room_rate" placeholder="Enter Room rate" required><span class="input-group-text"><i class="far fa-clock"></i></span><span class="help-block" style="color:red"></span></div></div></div><div class="col-md-3"><div class="form-group"><label class="col-lg-7 col-form-label" for="room_tariff_hike_rate_adult_with_extra_bed"><b>Adult with Extra Bed Rate</b></label><input type="text" class="form-control" name="room_tariff_hike_rate_adult_with_extra_bed" id="room_tariff_hike_rate_adult_with_extra_bed" placeholder="Enter Adult with Extra Bed Rate" required><span class="help-block" style="color:red"></span></div></div><div class="col-md-3"><div class="form-group"><label class="col-lg-8 col-form-label" for="room_tariff_hike_rate_child_with_extra_bed"><b>Child With Extra Bed Rate</b></label><input type="text" class="form-control" name="room_tariff_hike_rate_child_with_extra_bed" id="room_tariff_hike_rate_child_with_extra_bed" placeholder="Enter Child With Extra Bed Rate" required><span class="help-block" <div class="col-md-3"><div class="form-group"><label class="col-lg-8 col-form-label" for="room_tariff_hike_rate_child_sharing_bed"><b>Child Sharing Bed Rate</b></label><input type="text" class="form-control" name="room_tariff_hike_rate_child_sharing_bed" id="room_tariff_hike_rate_child_sharing_bed" placeholder="Enter Child Sharing Bed Rate" required><span class="help-block" style="color:red"></span></div></div><div class="col-md-3"><div class="form-group"><label class="col-lg-8 col-form-label" for="room_tariff_hike_rate_single_occupancy"><b>Single Occupancy Rate</b></label><input type="text" class="form-control" name="room_tariff_hike_rate_single_occupancy" id="room_tariff_hike_rate_single_occupancy" placeholder="Enter Single Occupancy Rate" required><span class="help-block" style="color:red"></span></div></div><div class="col-md-3"><div class="form-group"><label class="col-lg-8 col-form-label" for="room_tariff_hike_rate_single_occupancy"><b>Room has hike on some days of the week</b></label><select name="properties_room_category_welcomes_child_all_ages" id="properties_room_category_welcomes_child_all_ages" class="form-control multi-select" required><option value="N">No</option><option value="Y">Yes</option></select><span class="help-block" style="color:red"></span></div></div></div>');
                    

                    num_2++;
                   
                });

                
                 $("#counter_edit1").val(num_2);    
                console.log(field); 
                //$("#stg").html(field);
                //$("#row1").append(field);   
                $("#row1").html(field);   
            }

                
             });
        },
        error: function (jqXHR, textStatus, errorThrown)
        {
            alert('Error get data from ajax');
        }
    });
}

////***For editing room tariff details from adding modal form  *****///

////***For reload the datatable  *****///

function reload_table()
{
    $table.ajax.reload(null,false); //reload datatable ajax 
    var id = $("#id").val();
    if(id)
    {  

        swal("Room tariff details updated successfully", "", "success")
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
        
        swal("Room tariff details added successfully", "", "success")

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

////***For reload the datatable  *****///

///***For save the room tariff details from adding modal form *****///

function save()
{
     
    var url;

    if(save_method == 'add') {
        $("#id").val('');
        $('#btnSave').text('saving...'); //change button text
        $('#btnSave').attr('disabled',true); //set button disable

        url = "<?php echo base_url();?>index.php/Room_tariff_management/ajax_add/";
    } 
    else {

        $('#btnSave').text('updating...'); //change button text
        $('#btnSave').attr('disabled',true); //set button disable

        url = "<?php echo base_url();?>index.php/Room_tariff_management/ajax_update/";
    }
    
    var fd = new FormData();
    
    var form = document.getElementById('form');
    var data = new FormData(form);
    // ajax adding data to database
    $.ajax({
        url : url,
        type: "POST",
        data: data, //$('#form').serialize(),
        dataType: "JSON",
        //cache : false,
        processData: false,
        enctype: 'multipart/form-data',
        contentType: false,
        success: function(data)
        {

            if(data.status) //if success close modal and reload ajax table
            {

                $('#RoomTariffModal').modal('hide');
                // $('body').removeClass('modal-open');
                // $('.modal-backdrop').remove();


                reload_table();
            }
            else
            {
                for (var i = 0; i < data.inputerror.length; i++) 
                {
                    $('[name="'+data.inputerror[i]+'"]').parent().parent().addClass('input-warning-o'); //select parent twice to select div form-group class and add has-error class
                    if($('[name="'+data.inputerror[i]+'"]').parent().find('.help-block').length) {
                        $('[name="'+data.inputerror[i]+'"]').parent().find('.help-block').text(data.error_string[i]); //select span help-block class set text error string
                    } else {
                        $('[name="'+data.inputerror[i]+'"]').next().text(data.error_string[i]);
                    }
                }
            }
            $('#btnSave').text('save'); //change button text
            $('#btnSave').attr('disabled',false); //set button enable 
            $('.help-block').val('hide');

        },
        error: function (jqXHR, textStatus, errorThrown)
        {
            alert('Error adding / update data');
            $('#btnSave').text('save'); //change button text
            $('#btnSave').attr('disabled',false); //set button enable 

        }
    });
}

///***For save the room tariff details from adding modal form *****///

////***For reload the datatable for delete *****///

function reload_table_delete()
{
    $table.ajax.reload(null,false); //reload datatable ajax
    
    swal("Room tariff details deleted successfully", "", "success")
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
    
////***For reload the room tariff datatable for delete *****///

function delete_room_tariff(id)
{
     $.ajax({
        url : "<?php echo base_url();?>index.php/Room_tariff_management/ajax_edit/" + id,
        type: "GET",
        dataType: "JSON",
        success: function(data)
        {

            $('[name="id"]').val(data.room_tariff_hike_id);
            $('[name="properties_name"]').val(data.properties_name);
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

function delete_room_tariff_action()
{
    $('#btnSave1').text('deleting...'); //change button text
    $('#btnSave1').attr('disabled',true); //set button disable 
    var url;

        url = "<?php echo base_url();?>index.php/Room_tariff_management/delete/";
        
    

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
                $("#id").val('');
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

////***For delete the room tariff details from  database *****///

////***For open modal of room tariff adding form  *****///
    
function add_hike_room_tariff()
{ 
    save_method = 'add';
    $("#id").val('');
    $('#form')[0].reset(); // reset form on modals
    $('.form-group').removeClass('input-warning-o'); // clear error class
    $('.help-block').empty(); // clear error string
    $('#Tariff_uploadedModal').modal('show'); // show bootstrap modal
    $('.modal-title').text('Add Hike under room tariff Details'); // Set Title to Bootstrap modal title
    $('#btnSave').text('save');
    $(".profile-details").remove();
    $(".rates").remove();
    $("hr").remove();
    $(".some_days").remove();
}

////***For open modal of room tariff adding form  *****///
</script>