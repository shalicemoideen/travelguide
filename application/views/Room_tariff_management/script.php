<script>
////***Date picker *****///

$('#room_tariff_hike_from_date').pickadate({

        // format: 'DD/MM/YYYY'
    });

$('#room_tariff_hike_to_date').pickadate({

        // format: 'DD/MM/YYYY'
    });
// $('#room_tariff_hike_from_date').bootstrapMaterialDatePicker({
//          weekStart: 0,
//         time: false,
//         format: 'DD/MM/YYYY'
//     });

// $('#room_tariff_hike_to_date').bootstrapMaterialDatePicker({
//          weekStart: 0,
//         time: false,
//         format: 'DD/MM/YYYY'
//     });

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
      
$.validator.addMethod("dateRangeUnique", function(value, element) {

    var ok = false;

    var propId = $("#properties_id_fk").val();
    var fromD  = $("#room_tariff_hike_from_date").val();
    var toD    = $("#room_tariff_hike_to_date").val();

    // exclude id for edit (hidden #id)
    var excludeId = $("#id").val();

    // only validate when all present
    if (!propId || !fromD || !toD) return true;

    $.ajax({
        url: "<?php echo base_url(); ?>index.php/Room_tariff_management/ajax_check_date_range",
        type: "POST",
        dataType: "json",
        async: false, // IMPORTANT for validate method
        data: {
            properties_id_fk: propId,
            room_tariff_hike_from_date: fromD,
            room_tariff_hike_to_date: toD,
            exclude_id: excludeId
        },
        success: function(res){
            ok = (res.valid === true);
        },
        error: function(){
            ok = true; // don't block save if validation api fails
        }
    });

    return ok;

}, "This date range already exists / overlaps for the selected property.");

$("#form").validate({
             debug: false,
    rules: {
        properties_id_fk: { required: true },
        room_tariff_hike_from_date: { required: true },
        room_tariff_hike_to_date: {
            required: true,
            dateRangeUnique: true
        }
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
$("#properties_id_fk, #room_tariff_hike_from_date, #room_tariff_hike_to_date").on("change blur", function(){
    $("#room_tariff_hike_to_date").valid();
});

////***Latest Jquery form validation for adding form*****///

$(document).ready(function(){
    /* $(document).on("click",'#btnSave',function(){
        $(document).find('#form [required][value=""]').attr('aria-invalid', true);
    }); */

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
                        field1.push('<tr><td><div class="form-check custom-checkbox checkbox-success check-lg me-3"><input type="checkbox" class="form-check-input sc_chkbox" name="week_day_id['+num+']['+num1+']" id="room_tariff_week_days_rate_id_'+num1+'" value="'+item.week_days_id+'"><label class="form-check-label" for="customCheckBox2"></label></div></td><td><strong>'+item.week_days_name+'</strong></td><td><div class="d-flex align-items-center"><input type="text" class="form-control" name="room_amount['+num+']['+num1+']" id="room_tariff_week_days_rate_room_amount_'+num1+'" placeholder="Enter room rate" required disabled><span class="help-block" style="color:red"></span></div></td><td><input type="number" class="form-control" name="adult_with_extra_bed['+num+']['+num1+']" id="room_tariff_week_days_rate_adult_with_extra_bed_'+num1+'" placeholder="Enter Adult with Extra Bed" required disabled><span class="help-block" style="color:red"></span> </td><td><input type="number" class="form-control" name="child_with_extra_bed['+num+']['+num1+']" id="room_tariff_week_days_rate_child_with_extra_bed_'+num1+'" placeholder="Enter Child With Extra Bed" required disabled><span class="help-block" style="color:red"></span></td><td><input type="number" class="form-control" name="child_sharing_bed['+num+']['+num1+']" id="room_tariff_week_days_rate_child_sharing_bed_'+num1+'" placeholder="Enter Child Sharing Bed" required disabled><span class="help-block" style="color:red"></span></td><td><input type="number" class="form-control" name="single_occupancy['+num+']['+num1+']" id="room_tariff_week_days_rate_single_occupancy_'+num1+'" placeholder="Enter Single Occupancy rate" required disabled><span class="help-block" style="color:red"></span></td></tr>');
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
                toggleSaveByRooms();
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

$(document).on('change', '.sc_chkbox', function(){
    var tr = $(this).closest('tr');
    if($(this).prop('checked')){
        tr.find('input[type="number"]').prop('disabled', false);
    } else {
        tr.find('input[type="number"]').prop('disabled', true).val('');
    }
});

$(document).on("change", ".item", function () {
    var counter = this.id.split("_").pop();
    if ($(this).val() === "Y") $("#some_days_" + counter).show();
    else $("#some_days_" + counter).hide();
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

             $('td', row).eq(6).html('<div class="dropdown ms-auto text-end"><div class="btn-link" data-bs-toggle="dropdown"><svg width="24px" height="24px" viewBox="0 0 24 24" version="1.1"><g stroke="none" stroke-width="1" fill="none" fill-rule="evenodd"><rect x="0" y="0" width="24" height="24"></rect><circle fill="#000000" cx="5" cy="12" r="2"></circle><circle fill="#000000" cx="12" cy="12" r="2"></circle><circle fill="#000000" cx="19" cy="12" r="2"></circle></g></svg></div><div class="dropdown-menu dropdown-menu-end"><a class="dropdown-item" href="javascript:void(0)" id="rt" onclick="edit_room_tariff('+data['room_tariff_hike_id']+')">Edit</a><a class="dropdown-item" href="javascript:void(0)" onclick="return delete_room_tariff('+data['room_tariff_hike_id']+')">Delete</a><a class="dropdown-item" href="javascript:void(0)" onclick="return view_room_tariff('+data['room_tariff_hike_id']+')">View details</a></div></div>');
            
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

function toDMY(ymd) {
    if (!ymd) return '';
    // handle "YYYY-MM-DD" or "YYYY-MM-DD hh:mm:ss"
    const parts = ymd.split(' ')[0].split('-'); 
    return parts[2] + '/' + parts[1] + '/' + parts[0];
}


function edit_room_tariff(id)
{
    save_method = 'update';

    // reset
    $('#form')[0].reset();
    $("#row1").html('');
    $('.help-block').text('');
    $('#id').val(id);

    $.ajax({
        url: "<?php echo base_url(); ?>index.php/Room_tariff_management/ajax_edit/" + id,
        type: "GET",
        dataType: "json",
        success: function(res) {
            if (!res.status) {
                alert(res.message || "Not found");
                return;
            }

            // ===== 1) Fill header fields =====
            IS_EDIT_MODE = true;

            let propId = res.hike.properties_id_fk;

            // If option not present (rare), add it:
            if ($('#properties_id_fk option[value="'+propId+'"]').length === 0) {
                $('#properties_id_fk').append(new Option(res.hike.properties_name || propId, propId, true, true));
            }

            // Select2 refresh without triggering your rebuild:
            $('#properties_id_fk').val(propId).trigger('change.select2');

            // $('#properties_id_fk').val(res.hike.properties_id_fk);

            // DB column is DATE => show as yyyy-mm-dd (or format as you need)
            // $('#room_tariff_hike_from_date').val(res.hike.room_tariff_hike_from_date);
            // $('#room_tariff_hike_to_date').val(res.hike.room_tariff_hike_to_date);
            $('#room_tariff_hike_from_date').val(toDMY(res.hike.room_tariff_hike_from_date));
            $('#room_tariff_hike_to_date').val(toDMY(res.hike.room_tariff_hike_to_date));


            $('#room_tariff_hike_breakfast_rate_adult').val(res.hike.room_tariff_hike_breakfast_rate_adult);
            $('#room_tariff_hike_breakfast_rate_child').val(res.hike.room_tariff_hike_breakfast_rate_child);
            $('#room_tariff_hike_lunch_rate_adult').val(res.hike.room_tariff_hike_lunch_rate_adult);
            $('#room_tariff_hike_lunch_rate_child').val(res.hike.room_tariff_hike_lunch_rate_child);
            $('#room_tariff_hike_dinner_rate_adult').val(res.hike.room_tariff_hike_dinner_rate_adult);
            $('#room_tariff_hike_dinner_rate_child').val(res.hike.room_tariff_hike_dinner_rate_child);
            $('#room_tariff_hike_description').val(res.hike.room_tariff_hike_description);

            // ===== 2) Build lookup maps =====
            // ratesByRoom[room_id] = row from room_tariff_hike_rate
            const ratesByRoom = {};
            (res.rates || []).forEach(r => {
                ratesByRoom[r.room_id_fk] = r;
            });

            // weekByRoomDay[room_id][weekday_id] = weekday rate row
            const weekByRoomDay = {};
            (res.weekRates || []).forEach(w => {
                const roomId = w.room_id_fk;         // IMPORTANT
                const dayId  = w.week_days_id_fk;

                if (!weekByRoomDay[roomId]) weekByRoomDay[roomId] = {};
                weekByRoomDay[roomId][dayId] = w;
            });

            // ===== 3) Render rooms + weekday blocks =====
            renderRoomBlocks(res.rooms || [], res.weekdays || [], ratesByRoom, weekByRoomDay);

            // ===== 4) Open modal =====
            $('#RoomTariffModal').modal('show');
            $('#btnSave').text('Update').prop('disabled', false);
        },
        error: function() {
            alert("Error fetching room tariff details");
        }
    });
}

function renderRoomBlocks(rooms, weekdays, ratesByRoom, weekByRoomDay)
{
    let html = '';
    let num = 1;

    rooms.forEach(room => {
        const roomId = room.properties_room_category_id;
        const rateRow = ratesByRoom[roomId] || null;

        const someType = rateRow ? (rateRow.room_tariff_hike_rate_some_days_type || 'N') : 'N';

        // room header inputs
        html += `
            <hr>
            <div class="profile-details">
                <div class="profile-name px-3 pt-2">
                    <input type="hidden" name="room_tariff_hike_rate_id[${num}]" value="${rateRow ? rateRow.room_tariff_hike_rate_id : ''}">
                    <input type="hidden" name="room_id_fk[${num}]" value="${roomId}">
                    <h4 class="text-primary mb-0">${room.properties_room_category_name}</h4>
                </div>
            </div>

            <div class="row rates">
                <div class="col-md-2">
                    <label><b>Room rate</b> *</label>
                    <input type="number" class="form-control"
                        name="room_tariff_hike_rate_room_rate[${num}]"
                        value="${rateRow ? (rateRow.room_tariff_hike_rate_room_rate || '') : ''}" required>
                </div>

                <div class="col-md-2">
                    <label><b>Adult Extra Bed</b></label>
                    <input type="number" class="form-control"
                        name="room_tariff_hike_rate_adult_with_extra_bed[${num}]"
                        value="${rateRow ? (rateRow.room_tariff_hike_rate_adult_with_extra_bed || '') : ''}" required>
                </div>

                <div class="col-md-2">
                    <label><b>Child Extra Bed</b></label>
                    <input type="number" class="form-control"
                        name="room_tariff_hike_rate_child_with_extra_bed[${num}]"
                        value="${rateRow ? (rateRow.room_tariff_hike_rate_child_with_extra_bed || '') : ''}" required>
                </div>

                <div class="col-md-2">
                    <label><b>Child Sharing</b></label>
                    <input type="number" class="form-control"
                        name="room_tariff_hike_rate_child_sharing_bed[${num}]"
                        value="${rateRow ? (rateRow.room_tariff_hike_rate_child_sharing_bed || '') : ''}" required>
                </div>

                <div class="col-md-2">
                    <label><b>Single</b></label>
                    <input type="number" class="form-control"
                        name="room_tariff_hike_rate_single_occupancy[${num}]"
                        value="${rateRow ? (rateRow.room_tariff_hike_rate_single_occupancy || '') : ''}" required>
                </div>

                <div class="col-md-2">
                    <label><b>Hike on some days</b></label>
                    <select name="room_tariff_hike_rate_some_days_type[${num}]"
                        id="room_tariff_hike_rate_some_days_type_${num}"
                        class="form-control item" required>
                        <option value="N" ${someType === 'N' ? 'selected' : ''}>No</option>
                        <option value="Y" ${someType === 'Y' ? 'selected' : ''}>Yes</option>
                    </select>
                </div>
            </div>
        `;

        // weekdays table
        let rows = '';
        let idx = 1;

        weekdays.forEach(d => {
            const dayId = d.week_days_id;

            // const wdRow = (weekByRoomDay[roomId] && weekByRoomDay[roomId][dayId]) ? weekByRoomDay[roomId][dayId] : null;
            // const checked = wdRow ? 'checked' : '';
            // const disabled = wdRow ? '' : 'disabled';

            const roomKey = String(roomId);
            const dayKey  = String(dayId);

            const wdRow = (weekByRoomDay[roomKey] && weekByRoomDay[roomKey][dayKey])
                ? weekByRoomDay[roomKey][dayKey]
                : null;

            const checked  = wdRow ? 'checked' : '';
            const disabled = wdRow ? '' : 'disabled';

            rows += `
                <tr>
                    <td style="width:50px;">
                        <input type="checkbox" class="form-check-input sc_chkbox"
                            name="week_day_id[${num}][${idx}]"
                            value="${dayId}"
                            ${checked}>
                    </td>
                    <td><strong>${d.week_days_name}</strong></td>

                    <td><input type="number" class="form-control"
                        name="room_amount[${num}][${idx}]"
                        value="${wdRow ? (wdRow.room_tariff_week_days_rate_room_amount || '') : ''}"
                        required ${disabled}></td>

                    <td><input type="number" class="form-control"
                        name="adult_with_extra_bed[${num}][${idx}]"
                        value="${wdRow ? (wdRow.room_tariff_week_days_rate_adult_with_extra_bed || '') : ''}"
                        required ${disabled}></td>

                    <td><input type="number" class="form-control"
                        name="child_with_extra_bed[${num}][${idx}]"
                        value="${wdRow ? (wdRow.room_tariff_week_days_rate_child_with_extra_bed || '') : ''}"
                        required ${disabled}></td>

                    <td><input type="number" class="form-control"
                        name="child_sharing_bed[${num}][${idx}]"
                        value="${wdRow ? (wdRow.room_tariff_week_days_rate_child_sharing_bed || '') : ''}"
                        required ${disabled}></td>

                    <td><input type="number" class="form-control"
                        name="single_occupancy[${num}][${idx}]"
                        value="${wdRow ? (wdRow.room_tariff_week_days_rate_single_occupancy || '') : ''}"
                        required ${disabled}></td>
                </tr>
            `;
            idx++;
        });

        html += `
            <div class="row some_days" id="some_days_${num}" style="${someType === 'Y' ? '' : 'display:none'}">
                <div class="table-responsive">
                    <table class="table table-responsive-md">
                        <thead>
                            <tr>
                                <th style="width:50px;">
                                    <input type="checkbox" class="form-check-input checkAll">
                                </th>
                                <th><strong>Weekday</strong></th>
                                <th><strong>Hike Amount Room</strong></th>
                                <th><strong>Adult with Extra Bed</strong></th>
                                <th><strong>Child With Extra Bed</strong></th>
                                <th><strong>Child Sharing Bed</strong></th>
                                <th><strong>Single Occupancy</strong></th>
                            </tr>
                        </thead>
                        <tbody>${rows}</tbody>
                    </table>
                </div>
            </div>
        `;

        num++;
    });

    $("#row1").html(html);
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

function toYMD(dmy){
  // dmy = dd/mm/yyyy
  if(!dmy) return '';
  var p = dmy.split('/');
  if(p.length !== 3) return '';
  return p[2] + '-' + p[1] + '-' + p[0];
}

function toDMY(ymd){
  if(!ymd) return '';
  var p = ymd.split(' ')[0].split('-');
  if(p.length !== 3) return ymd;
  return p[2] + '/' + p[1] + '/' + p[0];
}

var autoFillTimer = null;

function triggerAutoFillLastTariff(){
  // only for ADD (don’t overwrite edit values)
  if (typeof save_method !== 'undefined' && save_method !== 'add') return;

  clearTimeout(autoFillTimer);
  autoFillTimer = setTimeout(function(){
    autoFillLastTariff();
  }, 250);
}


// Select2 property change
$('#properties_id_fk').on('change.select2', function(){
  triggerAutoFillLastTariff();
});

// Date change
$('#room_tariff_hike_from_date, #room_tariff_hike_to_date').on('change blur', function(){
  triggerAutoFillLastTariff();
});

function autoFillLastTariff()
{
  var propId = $('#properties_id_fk').val();
  var fromD  = $('#room_tariff_hike_from_date').val();

  if (!propId) return;

  $.ajax({
    url: "<?php echo base_url(); ?>index.php/Room_tariff_management/ajax_last_tariff",
    type: "POST",
    dataType: "json",
    data: {
      properties_id_fk: propId,
      room_tariff_hike_from_date: fromD
    },
    success: function(res){
      if(!res.status) return;

      // No previous data -> just keep empty but still show rooms
      var last = res.data;

      // 1) Always load weekdays + rooms for this property
      $.ajax({
        url: "<?php echo base_url(); ?>index.php/Room_tariff_management/weekdays_array_list/",
        type: "POST",
        dataType: "json",
        success: function(weekdays){

          $.ajax({
            url: "<?php echo base_url(); ?>index.php/Room_tariff_management/rooms_array_list/",
            type: "POST",
            dataType: "json",
            data: { properties_id: propId },
            success: function(rooms){

              if (!rooms || rooms.length === 0) {
                $("#row1").html('');
                $('#btnSave').prop('disabled', true);
                alert("No rooms available for this property.");
                return;
              }

              // 2) Fill header values from last.hike (if exists)
              if (last && last.hike) {
                $('#room_tariff_hike_breakfast_rate_adult').val(last.hike.room_tariff_hike_breakfast_rate_adult);
                $('#room_tariff_hike_breakfast_rate_child').val(last.hike.room_tariff_hike_breakfast_rate_child);
                $('#room_tariff_hike_lunch_rate_adult').val(last.hike.room_tariff_hike_lunch_rate_adult);
                $('#room_tariff_hike_lunch_rate_child').val(last.hike.room_tariff_hike_lunch_rate_child);
                $('#room_tariff_hike_dinner_rate_adult').val(last.hike.room_tariff_hike_dinner_rate_adult);
                $('#room_tariff_hike_dinner_rate_child').val(last.hike.room_tariff_hike_dinner_rate_child);
                $('#room_tariff_hike_description').val(last.hike.room_tariff_hike_description);
              } else {
                // Optional: clear header if no last
                // $('#room_tariff_hike_breakfast_rate_adult').val('');
              }

              // 3) Build maps from last.rates + last.weekRates
              var ratesByRoom = {};
              var weekByRoomDay = {};

              if (last && last.rates) {
                last.rates.forEach(function(r){
                  ratesByRoom[String(r.room_id_fk)] = r;
                });
              }

              if (last && last.weekRates) {
                last.weekRates.forEach(function(w){
                  // IMPORTANT: weekRates query includes room_id_fk (via join)
                  var roomId = String(w.room_id_fk);
                  var dayId  = String(w.week_days_id_fk);
                  if (!weekByRoomDay[roomId]) weekByRoomDay[roomId] = {};
                  weekByRoomDay[roomId][dayId] = w;
                });
              }

              // 4) Render room blocks with last values applied
              // NOTE: When auto-fill, set rate_id empty because it's ADD mode
              // Your renderRoomBlocks should set room_tariff_hike_rate_id[...] = '' for add
              renderRoomBlocks(rooms, weekdays, ratesByRoom, weekByRoomDay);

              $('#btnSave').prop('disabled', false);

            }
          });

        }
      });
    }
  });
}

///***For save the room tariff details from adding modal form *****///


function hasRoomsInForm(){
    return $('input[name^="room_id_fk"]').length > 0;
}

function toggleSaveByRooms(){
    if (!hasRoomsInForm()) {
        $('#btnSave').prop('disabled', true);
        // show message near property select or top
        if ($("#noRoomsMsg").length === 0) {
            $("#properties_id_fk").closest('.form-group').append(
                '<div id="noRoomsMsg" class="text-danger mt-1">No rooms available for this property. Cannot save tariff.</div>'
            );
        }
    } else {
        $('#btnSave').prop('disabled', false);
        $("#noRoomsMsg").remove();
    }
}


function save()
{
    $('.sl-cust-validation').find(':disabled').removeAttr('aria-invalid');

    var emptyRequiredFields = $('.sl-cust-validation').find('[required]').filter(function() {
        return $(this).val().trim() === '' && !$(this).is(':disabled');
    });

    if (emptyRequiredFields.length > 0) {
        emptyRequiredFields.attr('aria-invalid', true);
        return false;
    }
  
    if ($('input[name^="room_id_fk"]').length === 0) {
        alert("No rooms available for this property. Cannot save tariff.");
        return false;
    }
    if (!$("#form").valid()) return false;
    
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
        url : "<?php echo base_url();?>index.php/Room_tariff_management/ajax_edit_delete/" + id,
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

function toDMY(ymd) {
  if (!ymd) return '-';
  var d = ymd.split(' ')[0].split('-'); // YYYY-MM-DD
  if (d.length !== 3) return ymd;
  return d[2] + '/' + d[1] + '/' + d[0];
}

function safe(v) {
  return (v === null || typeof v === 'undefined' || v === '') ? '-' : v;
}

function view_room_tariff(id)
{
  $("#vw_rooms_container").html('');

  $.ajax({
    url: "<?php echo base_url(); ?>index.php/Room_tariff_management/ajax_view/" + id,
    type: "GET",
    dataType: "json",
    success: function(res) {
      if (!res.status) {
        alert(res.message || "Not found");
        return;
      }

      var data = res.data;
      var hike = data.hike;

      // Fill header
      $("#vw_property_name").text(safe(hike.properties_name));
      $("#vw_from_date").text(toDMY(hike.room_tariff_hike_from_date));
      $("#vw_to_date").text(toDMY(hike.room_tariff_hike_to_date));

      $("#vw_created_date").text(safe(toDMY(hike.room_tariff_hike_created_date)));
      $("#vw_created_time").text(safe(hike.room_tariff_hike_created_time));
      $("#vw_created_by").text("By: " + safe(hike.room_tariff_hike_createdby_user_name));

      $("#vw_bf_adult").text(safe(hike.room_tariff_hike_breakfast_rate_adult));
      $("#vw_bf_child").text(safe(hike.room_tariff_hike_breakfast_rate_child));
      $("#vw_lunch_adult").text(safe(hike.room_tariff_hike_lunch_rate_adult));
      $("#vw_lunch_child").text(safe(hike.room_tariff_hike_lunch_rate_child));
      $("#vw_dinner_adult").text(safe(hike.room_tariff_hike_dinner_rate_adult));
      $("#vw_dinner_child").text(safe(hike.room_tariff_hike_dinner_rate_child));
      $("#vw_desc").text(safe(hike.room_tariff_hike_description));

      // Build map: weekRates by room_id + rate_id
      var weekByRoom = {}; // weekByRoom[room_id] = [rows...]
      (data.weekRates || []).forEach(function(w){
        var roomId = String(w.room_id_fk); // from join
        if (!weekByRoom[roomId]) weekByRoom[roomId] = [];
        weekByRoom[roomId].push(w);
      });

      // Render rooms
      var roomsHtml = '';
      (data.rates || []).forEach(function(r){
        var roomId = String(r.room_id_fk);
        var someType = r.room_tariff_hike_rate_some_days_type || 'N';

        roomsHtml += `
          <div class="card mb-3">
            <div class="card-header d-flex align-items-center justify-content-between">
              <div>
                <div class="fw-bold">${safe(r.properties_room_category_name)}</div>
                <div class="small text-muted">Room ID: ${roomId}</div>
              </div>
              <span class="badge bg-${someType === 'Y' ? 'success' : 'secondary'}">
                Some days: ${someType}
              </span>
            </div>

            <div class="card-body">
              <div class="row g-3">
                <div class="col-md-2">
                  <div class="text-muted">Room Rate</div>
                  <div class="fw-bold">${safe(r.room_tariff_hike_rate_room_rate)}</div>
                </div>
                <div class="col-md-2">
                  <div class="text-muted">Adult Extra Bed</div>
                  <div class="fw-bold">${safe(r.room_tariff_hike_rate_adult_with_extra_bed)}</div>
                </div>
                <div class="col-md-2">
                  <div class="text-muted">Child Extra Bed</div>
                  <div class="fw-bold">${safe(r.room_tariff_hike_rate_child_with_extra_bed)}</div>
                </div>
                <div class="col-md-2">
                  <div class="text-muted">Child Sharing Bed</div>
                  <div class="fw-bold">${safe(r.room_tariff_hike_rate_child_sharing_bed)}</div>
                </div>
                <div class="col-md-2">
                  <div class="text-muted">Single Occupancy</div>
                  <div class="fw-bold">${safe(r.room_tariff_hike_rate_single_occupancy)}</div>
                </div>
              </div>

              ${renderWeekdayTable(someType, weekByRoom[roomId])}
            </div>
          </div>
        `;
      });

      $("#vw_rooms_container").html(roomsHtml);

      $("#RoomTariffViewModal").modal('show');
    },
    error: function() {
      alert("Error loading view details");
    }
  });
}

function renderWeekdayTable(someType, weekRows)
{
  if (someType !== 'Y') return '';

  weekRows = weekRows || [];
  if (weekRows.length === 0) {
    return `<div class="mt-3 alert alert-light border">No weekday hike saved for this room.</div>`;
  }

  var trs = '';
  weekRows.forEach(function(w){
    trs += `
      <tr>
        <td><span class="badge bg-light text-dark border">${safe(w.week_days_name)}</span></td>
        <td class="fw-bold">${safe(w.room_tariff_week_days_rate_room_amount)}</td>
        <td>${safe(w.room_tariff_week_days_rate_adult_with_extra_bed)}</td>
        <td>${safe(w.room_tariff_week_days_rate_child_with_extra_bed)}</td>
        <td>${safe(w.room_tariff_week_days_rate_child_sharing_bed)}</td>
        <td>${safe(w.room_tariff_week_days_rate_single_occupancy)}</td>
      </tr>
    `;
  });

  return `
    <div class="mt-4">
      <div class="fw-bold mb-2">Weekday Hike Details</div>
      <div class="table-responsive">
        <table class="table table-bordered align-middle">
          <thead class="table-light">
            <tr>
              <th>Weekday</th>
              <th>Room Amount</th>
              <th>Adult Extra Bed</th>
              <th>Child Extra Bed</th>
              <th>Child Sharing Bed</th>
              <th>Single Occupancy</th>
            </tr>
          </thead>
          <tbody>${trs}</tbody>
        </table>
      </div>
    </div>
  `;
}

</script>