
<script type="text/javascript">

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

$( "#packages_duration_in_nights1" ).keypress(function() {
            $table.ajax.reload();
});

////***searching button*****///

////***Listing table*****///

var save_method; //for save method string
var table;
  $(document).ready(function() {
    
    
    $table = $('#Package_registration').DataTable( {
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
            "url": "<?php echo base_url();?>index.php/Packages/get/",
            "type": "POST",
            "data" : function (d) {
                        d.packages_title = $("#packages_title").val();
                        d.packages_category_id = $("#packages_category_id").val();
                        d.packages_itinerary_category_id = $("#packages_itinerary_category_id").val();
                        d.packages_duration_in_nights = $("#packages_duration_in_nights1").val();
                        d.packages_createdby_user_id = $("#packages_createdby_user_id").val();
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
            
            
            $('td', row).eq(7).html('<div class="dropdown ms-auto text-end"><div class="btn-link" data-bs-toggle="dropdown"><svg width="24px" height="24px" viewBox="0 0 24 24" version="1.1"><g stroke="none" stroke-width="1" fill="none" fill-rule="evenodd"><rect x="0" y="0" width="24" height="24"></rect><circle fill="#000000" cx="5" cy="12" r="2"></circle><circle fill="#000000" cx="12" cy="12" r="2"></circle><circle fill="#000000" cx="19" cy="12" r="2"></circle></g></svg></div><div class="dropdown-menu dropdown-menu-end"><a class="dropdown-item" href="javascript:void(0)" id="rt" onclick="edit_package('+data['packages_id']+')">Edit</a><a class="dropdown-item" href="javascript:void(0)" onclick="return delete_package('+data['packages_id']+')">Delete</a><a class="dropdown-item" href="<?php echo base_url();?>index.php/Packages/View/'+data['packages_id']+'" >View Details</a><a class="dropdown-item" href="<?php echo base_url();?>index.php/Packages/preview_direct/" >Preview</a></div></div>');

            
            
           },

           "drawCallback": function( settings ) {
                // displaySelectByUserType();
            },

        "columns": [
            { "data": "packages_status", "orderable": false },
            { "data": "packages_title", "orderable": false },
            { "data": "package_category_name", "orderable": false },
            { "data": "packages_duration_in_nights", "orderable": false },
            { "data": "itinerary_category_name", "orderable": false },
            { "data": "itineraries_name", "orderable": false },
            { "data": "packages_createdby_user_name", "orderable": false },                      
            { "data": "packages_id", "orderable": false }
            
            
        ]
        
    });
    
  

  });
    
 
////***Listing table*****///

    ////***For open modal of room tariff adding form  *****///
    
function add_packages()
{ 
    save_method = 'add';
    $("#id").val('');
    $('#form')[0].reset(); // reset form on modals
    $('.form-group').removeClass('input-warning-o'); // clear error class
    $('.help-block').empty(); // clear error string
    $('#PackagesModal').modal('show'); // show bootstrap modal
    $('.modal-title').text('Create Package Details'); // Set Title to Bootstrap modal title
    $('#btnSave').text('save');
}

////***For open modal of room tariff adding form  *****///

////***Ajax dropdown for add*****///


$(document).ready(function() {
    $('#packages_itinerary_category_id_fk').change(function() {
    //alert("oo");
        var packages_itinerary_category_id_fk = $('#packages_itinerary_category_id_fk').val();
        var packages_duration_in_nights = $('#packages_duration_in_nights').val();

    
        if(packages_itinerary_category_id_fk != '') {
        $.ajax({
            url: "<?php echo base_url(); ?>index.php/Packages/fetch_itinerary_under_category",
            method: "POST",
            data: {
                packages_itinerary_category_id_fk: packages_itinerary_category_id_fk,packages_duration_in_nights:packages_duration_in_nights
            },
            success: function(data) {
                $('#packages_itinerary_id_fk').html(data);
                // $('#city').html('<option value="">Select City</option>');
            }
        });
        } else {
            $('#packages_itinerary_id_fk').html('<option value="0">Please Select Lead</option>');
            // $('#city').html('<option value="">Select City</option>');
        }

    });
});
////***Ajax dropdown for add*****///

$(document).ready(function() {

    $('#myDiv1').hide();
    $('#myDiv2').hide();
    $('#myDiv3').hide();
    $('#optional-addon').hide();
    $('#special-requirments').hide();
    //$('#payment-policies').hide();
    $('#myDiv4').hide();
    $('#myDiv5').hide();
    $('#myDiv6').hide();
    $('#myDiv7').hide();
    $('#myDiv8').hide();
    $('#myDiv9').hide();
    $('#add_notes').hide();
  // Listen for changes on the checkbox
  $('#packages_inclusion_exclusion_checked_type').change(function() {
    // Check if the checkbox is currently checked
    if ($(this).is(':checked')) {
      // If checked, show the div
      $('#myDiv1').show();
      $('#myDiv2').show();
      $('#myDiv3').show();
    } else {
      // If unchecked, hide the div
      $('#myDiv1').hide();
      $('#myDiv2').hide();
      $('#myDiv3').hide();
    }
  });


  $('#packages_optional_add_on_checked_type').change(function() {
    // Check if the checkbox is currently checked
    if ($(this).is(':checked')) {
      // If checked, show the div
      $('#optional-addon').show();

    } else {
      // If unchecked, hide the div
      $('#optional-addon').hide();

    }
  });
$('#packages_special_requirment_checked_type').change(function() {
    // Check if the checkbox is currently checked
    if ($(this).is(':checked')) {
      // If checked, show the div
      $('#special-requirments').show();

    } else {
      // If unchecked, hide the div
      $('#special-requirments').hide();

    }
  });

  $('#packages_payment_policies_checked_type').change(function() {
    // Check if the checkbox is currently checked
    if ($(this).is(':checked')) {
      // If checked, show the div
      $('#myDiv4').show();
      $('#myDiv5').show();
    } else {
      // If unchecked, hide the div
      $('#myDiv4').hide();
      $('#myDiv5').hide();

    }
  });

  $('#packages_terms_conditions_checked_type').change(function() {
    // Check if the checkbox is currently checked
    if ($(this).is(':checked')) {
      // If checked, show the div
      $('#myDiv6').show();
      $('#myDiv7').show();
    } else {
      // If unchecked, hide the div
      $('#myDiv6').hide();
      $('#myDiv7').hide();

    }
  });

  $('#packages_cancellation_policy_checked_type').change(function() {
    // Check if the checkbox is currently checked
    if ($(this).is(':checked')) {
      // If checked, show the div
      $('#myDiv8').show();
      $('#myDiv9').show();
    } else {
      // If unchecked, hide the div
      $('#myDiv8').hide();
      $('#myDiv9').hide();

    }
  });

  $('#packages_notes_checked_type').change(function() {
    // Check if the checkbox is currently checked
    if ($(this).is(':checked')) {
      // If checked, show the div
      $('#add_notes').show();
    } else {
      // If unchecked, hide the div
      $('#add_notes').hide();

    }
  });

  $('#packages_inclusion_exclusion_common_id_fk').change(function() {
    
    // Check if the checkbox is currently checked
    if ($('#packages_inclusion_exclusion_common_id_fk').val() == '') {
        // alert("k");
      // If checked, show the div
      $('.add1').show();
      $('.add2').show();
      $('.inc').hide();
      $('.exc').hide();
    } else {
        // alert("d");
      // If unchecked, hide the div
      $('.add1').hide();
      $('.add2').hide();
      $('.inc').show();
      $('.exc').show();
    }
  });

  $('#payment_policies_id_fk').change(function() {
    
    // Check if the checkbox is currently checked
    if ($('#payment_policies_id_fk').val() == '') {
        // alert("k");
      // If checked, show the div
      $('.payment_add').show();
      $('.payment').hide();
    } else {
        // alert("d");
      // If unchecked, hide the div
      $('.payment_add').hide();
      $('.payment').show();
    }
  });
  
});

var counter10 = 1;

var n10 = $("#counter_edit1").val();
                 // alert(n1);

var counter_edit10 = $("#counter_edit1").val();



if(counter_edit10 >0){
    counter10 = counter_edit10-1;
}

function addMore10() {

  var itinerary_category_id = $("#packages_itinerary_id_fk").val();

  $("<DIV>").load("", function() {
    
    $(this).attr('data-validation','required');
    $(this).attr('data-validation','nameFields');
    $(this).attr('data-validation','digitsOnly');
    $(this).attr('data-validation','date');
    $(this).attr('data-validation','usPhone');
    $(this).attr('data-validation','email');
    $(this).attr('data-validation','dropDown');


    // var htmlVal = '<DIV class="product-item box box-success list exp_section" id="product-item_'+counter+'">&nbsp <input type="hidden" name="sub-counter-'+counter+'" id="sub-counter-'+counter+'" value="0" /> <table class="table table-bordered" cellspacing="2" ><tr><div class="row"><div class="col-sm-12"><input type="hidden" name="terms_condition_id_fk['+counter+']" id="terms_condition_id_fk_'+counter+'"/> <textarea class="form-control" name="terms_condition_items_name['+counter+']" id="terms_condition_items_name_'+counter+'"  rows="5" placeholder="Enter details" required></textarea><button class="btn-sm btn-danger" type="button" style="margin-top:20%;" onClick="deleteRow('+counter+');"><b>X</b></button></div></div></div></tr></table></DIV>';

    //  var htmlVal = '<div class="mb-3 col-md-8 product-item" id="product-item_'+counter+'"><input type="hidden" name="terms_condition_id_fk['+counter+']" id="terms_condition_id_fk_'+counter+'"/><textarea class="form-control" name="terms_condition_items_name['+counter+']" id="terms_condition_items_name_'+counter+'"  rows="5" placeholder="Enter Terms and condition" required></textarea><span class="help-block" style="color:red"></span></div><div class="mb-3 col-md-3 product-item1" id="product-item1_'+counter+'"><button class="btn-sm btn-danger" type="button" onClick="deleteRow('+counter+');"><b>X</b></button></div>';
     
      // <div class="col-sm-4 mt-2 mt-sm-0"> <button class="btn btn-primary add" type="button" id="submit" onClick="addMore9('+num1+');">+ Add new</button> </div>
    //$("#product-item_"+num).append(htmlVal);

  var num1 = 1; var num = 1;
  
  $.ajax({
      url: "<?php echo base_url(); ?>index.php/Packages/itinerary_array_list/",
      dataType: 'json',
      type: 'POST',
      data:{itinerary_category_id:itinerary_category_id},
      success: function(data) {    
          var result = data;
      // console.log(result);

      var field1 = [];
      
      $.each(result, function (i, item) {                

          
          //field1.push('<tr><td>'+item.itineraries_days_day+'</td><td>'+item.state_name+'</td><td><div class="row" id="product-item_'+num1+'">&nbsp <input type="hidden" name="sub-counter-'+num1+'" id="sub-counter-'+num1+'" value="0" /> <div class="col-sm-4"> <select name="properties_id_fk['+num1+']" id="properties_id_fk_'+num1+'" class="form-control multi-select properties" required> <option value="">Please Select Properties</option> </select> </div> <div class="col-sm-4 mt-2 mt-sm-0"> <select name="properties_id_fk['+num1+']" id="properties_id_fk_'+num1+'" class="form-control multi-select" required> <option value="">Please Select Rooms</option> </select> </div> <div class="col-sm-3 mt-2 mt-sm-0"> <button class="btn btn-primary add" type="button" id="submit" onClick="addMore9('+num1+');">+ Add new</button> </div> </div></td></tr>');

          // field1.push('<tr><td><strong>Day1 | ARRIVAL AT COCHIN & TRANSFER TO MUNNAR</strong></td><td><div class="d-flex align-items-center">Alappuzha</div></td><td> <div class="row"> <div class="col-sm-4"> <select name="properties_id_fk['+num1+']" id="properties_id_fk_'+num1+'" class="form-control multi-select" required> <option value="">Please Search by title</option> </select> </div> <div class="col-sm-4 mt-2 mt-sm-0"> <select name="properties_id_fk['+num1+']" id="properties_id_fk_'+num1+'" class="form-control multi-select" required> <option value="">Please Search by title</option>  </select> </div> <div class="col-sm-4 mt-2 mt-sm-0"> <button class="btn btn-primary add" type="button" id="submit" >+ Add new</button> </div> </div> </td></tr> </tbody></table></div>');
          field1.push('<tr><td>'+item.itineraries_days_day+'</td><td>'+item.state_name+'</td><td><div class="row" id="product-item_'+num1+'">&nbsp <input type="hidden" name="sub-counter-'+num1+'" id="sub-counter-'+num1+'" value="0" /> <div class="col-sm-4"> <select name="properties_id_fk['+num1+']" id="properties_id_fk_'+num1+'" class="form-control multi-select properties" required> <option value="">Please Select Properties</option> </select> </div> <div class="col-sm-4 mt-2 mt-sm-0"> <select name="properties_id_fk['+num1+']" id="properties_id_fk_'+num1+'" class="form-control multi-select" required> <option value="">Please Select Rooms</option> </select> </div> <div class="col-sm-3 mt-2 mt-sm-0"> <button class="btn btn-primary add" type="button" id="submit" onClick="addMore9('+num1+');">+ Add new</button> </div> </div></td></tr>');  
          
          num1++;
          
      });

          // $("#counter_edit1").val(num);    
      console.log(field1); 
      //$("#stg").html(field);
      //$("#row1").append(field);
      var htmlVal = '<div class="row"> <div class="col-md-3"> <div class="form-group"> <input type="text" name="packages_properties_common_category_name['+counter10+']" id="packages_properties_common_category_name_'+counter10+'" class="form-control" placeholder="Enter category name" value="" required/> <span class="help-block" style="color:red"></span> </div> </div> </div> <div class="table-responsive"> <table class="table table-responsive-md" id="table2"> <thead> <tr> <th><strong>Day</strong></th><th><strong>Stay Destination</strong></th><th><strong>Properties and room</strong></th></tr></thead> <tbody> '+field1+'</tbody></table></div>';
      $("#property").html(htmlVal);
      }
  });
        
    
  });

  counter10++; 

    
}

$("#packages_itinerary_id_fk").change(function() {

        var itinerary_category_id = $(this).val();

        var num1 = 1; var num = 1;
        
        $.ajax({
            url: "<?php echo base_url(); ?>index.php/Packages/itinerary_array_list/",
            dataType: 'json',
            type: 'POST',
            data:{itinerary_category_id:itinerary_category_id},
            success: function(data) {    
                var result = data;
            // console.log(result);
            var field = [];
            
            $.each(result, function (i, item) {                

                field.push('<tr><td style="display:none"><input checked="checked" type="checkbox" /></td><td>'+item.itineraries_days_day+' | '+item.itineraries_days_title+'<input type="hidden" name="itineraries_days_id_fk['+num+']" id="itineraries_days_id_fk_'+num+'" value="'+item.itineraries_days_day+'"/><input type="hidden" name="packages_itineraries_days_day['+num+']" id="packages_itineraries_days_day_'+num+'" value="'+item.itineraries_days_day+'"/><input type="hidden" name="packages_itineraries_days_title['+num+']" id="packages_itineraries_days_title_'+num+'" value="'+item.itineraries_days_title+'"/></td><td>'+item.state_name+'<input type="hidden" name="packages_itineraries_days_destination_id_fk['+num+']" id="packages_itineraries_days_destination_id_fk_'+num+'" value="'+item.itineraries_days_destination_id_fk+'"/></td><td style="width:500px;hieght:500px">'+item.itineraries_days_description+'<input type="hidden" name="packages_itineraries_days_description['+num+']" id="packages_itineraries_days_description_'+num+'" value="'+item.itineraries_days_description+'"/></td><td><select id="change_designation_id_'+num+'" class="form-control multi-select change_designation" required> <option value="">Please Select Designation</option> </select></td><td><select  id="change_itinerary_id_'+num+'" class="form-control multi-select" required> <option value="">Please Select itinerary</option> </select><select  id="change_itinerary_day_id_'+num+'" class="form-control multi-select" required> <option value="">Please Select Days</option> </select></td></tr>');
                
                $.ajax({
                  
                  type: "POST",
                  url: "<?php echo base_url()?>index.php/Packages/gettdestination_details/",
                  success: function(cities)
                  {
                    // $('.properties').append('<option value="">Please Select Properties</option>');

                    $.each(cities,function(id,city) {

                      var opt = $('<option />');
                      opt.val(id);
                      opt.text(city);

                      $('.change_designation').append(opt);
                      //$('.properties').append(opt);

                    });
                  }
                })

                num++;
                
            });

            
                // $("#counter_edit1").val(num);    
            console.log(field); 
            //$("#stg").html(field);
            //$("#row1").append(field);
            $("#itinerary").html(field);

            var field1 = [];
            
            $.each(result, function (i, item) {                

                
                //field1.push('<tr><td>'+item.itineraries_days_day+'</td><td>'+item.state_name+'</td><td><div class="row" id="product-item_'+num1+'">&nbsp <input type="hidden" name="sub-counter-'+num1+'" id="sub-counter-'+num1+'" value="0" /> <div class="col-sm-4"> <select name="properties_id_fk['+num1+']" id="properties_id_fk_'+num1+'" class="form-control multi-select properties" required> <option value="">Please Select Properties</option> </select> </div> <div class="col-sm-4 mt-2 mt-sm-0"> <select name="properties_id_fk['+num1+']" id="properties_id_fk_'+num1+'" class="form-control multi-select" required> <option value="">Please Select Rooms</option> </select> </div> <div class="col-sm-3 mt-2 mt-sm-0"> <button class="btn btn-primary add" type="button" id="submit" onClick="addMore9('+num1+');">+ Add new</button> </div> </div></td></tr>');

                 
                
                num1++;
                
            });

                // $("#counter_edit1").val(num);    
            console.log(field1); 
            //$("#stg").html(field);
            //$("#row1").append(field);
            //$("#property").html(field1);
            }
        });

         $.ajax({
                  
                  type: "POST",
                  url: "<?php echo base_url()?>index.php/Packages/gettproperties_details/",
                  success: function(cities)
                  {
                    // $('.properties').append('<option value="">Please Select Properties</option>');

                    $.each(cities,function(id,city) {

                      var opt = $('<option />');
                      opt.val(id);
                      opt.text(city);

                      $('.properties').append(opt);
                      //$('.properties').append(opt);

                    });
                  }
                })

});

var counter9 = 1;

var n9 = $("#counter_edit1").val();
                 // alert(n1);

var counter_edit9 = $("#counter_edit9").val();



if(counter_edit9 >0){
    counter9 = counter_edit9-1;
}

function addMore9(num=0) {
  
 
var subcnt = eval($('#sub-counter-'+num).val()); subcnt++; $('#sub-counter-'+num).val(subcnt);
 console.log(subcnt);
    $("<DIV>").load("", function() {
    
    $(this).attr('data-validation','required');
    $(this).attr('data-validation','nameFields');
    $(this).attr('data-validation','digitsOnly');
    $(this).attr('data-validation','date');
    $(this).attr('data-validation','usPhone');
    $(this).attr('data-validation','email');
    $(this).attr('data-validation','dropDown');


    // var htmlVal = '<DIV class="product-item box box-success list exp_section" id="product-item_'+counter+'">&nbsp <input type="hidden" name="sub-counter-'+counter+'" id="sub-counter-'+counter+'" value="0" /> <table class="table table-bordered" cellspacing="2" ><tr><div class="row"><div class="col-sm-12"><input type="hidden" name="terms_condition_id_fk['+counter+']" id="terms_condition_id_fk_'+counter+'"/> <textarea class="form-control" name="terms_condition_items_name['+counter+']" id="terms_condition_items_name_'+counter+'"  rows="5" placeholder="Enter details" required></textarea><button class="btn-sm btn-danger" type="button" style="margin-top:20%;" onClick="deleteRow('+counter+');"><b>X</b></button></div></div></div></tr></table></DIV>';

    //  var htmlVal = '<div class="mb-3 col-md-8 product-item" id="product-item_'+counter+'"><input type="hidden" name="terms_condition_id_fk['+counter+']" id="terms_condition_id_fk_'+counter+'"/><textarea class="form-control" name="terms_condition_items_name['+counter+']" id="terms_condition_items_name_'+counter+'"  rows="5" placeholder="Enter Terms and condition" required></textarea><span class="help-block" style="color:red"></span></div><div class="mb-3 col-md-3 product-item1" id="product-item1_'+counter+'"><button class="btn-sm btn-danger" type="button" onClick="deleteRow('+counter+');"><b>X</b></button></div>';
     var htmlVal = '<div class="col-sm-4"> <select name="properties_id_fk['+counter9+']" id="properties_id_fk_'+counter9+'" class="form-control multi-select properties" required> <option value="">Please Select Properties</option> </select> </div><div class="col-sm-4 mt-2 mt-sm-0"> <select name="properties_id_fk['+counter9+']" id="properties_id_fk_'+counter9+'" class="form-control multi-select" required> <option value="">Please Select Rooms</option> </select> </div><div class="mb-3 col-md-3"><button class="btn-sm btn-danger" type="button" onClick="deleteRow9('+counter9+');"><b>X</b></button></div>';
      // <div class="col-sm-4 mt-2 mt-sm-0"> <button class="btn btn-primary add" type="button" id="submit" onClick="addMore9('+num1+');">+ Add new</button> </div>
    $("#product-item_"+num).append(htmlVal);
        
    
  });   
counter9++;  

}

$("#packages_inclusion_exclusion_common_id_fk").change(function() {

        var inclusion_exclusion_common_id = $(this).val();

        var num1 = 1; var num = 1;
        
        $.ajax({
            url: "<?php echo base_url(); ?>index.php/Packages/inclusion_array_list/",
            dataType: 'json',
            type: 'POST',
            data:{inclusion_exclusion_common_id:inclusion_exclusion_common_id},
            success: function(data) {    
                var result = data;
            // console.log(result);
            var field = [];
            
            $.each(result, function (i, item) {                

                // field.push('<hr><div class="profile-details"><div class="profile-name px-3 pt-2"><input type="hidden" name="room_tariff_hike_rate_id['+num+']" id="room_tariff_hike_rate_id_'+num+'"><input type="hidden" name="room_id_fk['+num+']" id="room_id_fk_'+num+'" value="'+item.properties_room_category_id+'"><h4 class="text-primary mb-0">'+item.properties_room_category_name+'</h4><!--<p>UX / UI Designer</p></div><div class="profile-email px-2 pt-2"><h4 class="text-muted mb-0">hello@email.com</h4><p>Email</p>--></div></div><div class="row rates"><div class="col-md-2"><div class="form-group"><label class="col-lg-6 col-form-label" for="room_tariff_hike_rate_room_rate"><b>Room rate</b> <span class="text-danger">*</span></label><input type="number" class="form-control" name="room_tariff_hike_rate_room_rate['+num+']" id="room_tariff_hike_rate_room_rate_'+num+'" placeholder="Enter Room rate" required><span class="help-block" style="color:red"></span></div></div><div class="col-md-2"><div class="form-group"><label class="col-lg-12 col-form-label" for="room_tariff_hike_rate_adult_with_extra_bed"><b>Adult with Extra Bed Rate</b></label><input type="number" class="form-control" name="room_tariff_hike_rate_adult_with_extra_bed['+num+']" id="room_tariff_hike_rate_adult_with_extra_bed_'+num+'" placeholder="Adult with Extra Bed Rate" required><span class="help-block" style="color:red"></span></div></div><div class="col-md-2"><div class="form-group"><label class="col-lg-12 col-form-label" for="room_tariff_hike_rate_child_with_extra_bed"><b>Child With Extra Bed Rate</b></label><input type="number" class="form-control" name="room_tariff_hike_rate_child_with_extra_bed['+num+']" id="room_tariff_hike_rate_child_with_extra_bed_'+num+'" placeholder="Child With Extra Bed Rate" required><span class="help-block" style="color:red"></span></div></div> <div class="col-md-2"><div class="form-group"><label class="col-lg-10 col-form-label" for="room_tariff_hike_rate_child_sharing_bed"><b>Child Sharing Bed Rate</b></label><input type="number" class="form-control" name="room_tariff_hike_rate_child_sharing_bed['+num+']" id="room_tariff_hike_rate_child_sharing_bed_'+num+'" placeholder="Child Sharing Bed Rate" required><span class="help-block" style="color:red"></span></div></div><div class="col-md-2"><div class="form-group"><label class="col-lg-10 col-form-label" for="room_tariff_hike_rate_single_occupancy"><b>Single Occupancy Rate</b></label><input type="number" class="form-control" name="room_tariff_hike_rate_single_occupancy['+num+']" id="room_tariff_hike_rate_single_occupancy_'+num+'" placeholder="Single Occupancy Rate" required><span class="help-block" style="color:red"></span></div></div><div class="col-md-2"><div class="form-group"><label class="col-lg-12 col-form-label" for="room_tariff_hike_rate_single_occupancy"><b>Hike on some days of week</b></label><select name="room_tariff_hike_rate_some_days_type['+num+']" id="room_tariff_hike_rate_some_days_type_'+num+'" class="form-control multi-select item" required><option value="N">No</option><option value="Y">Yes</option></select><span class="help-block" style="color:red"></span></div></div><div class="row some_days" id="some_days_'+num+'"><div class="table-responsive"><table class="table table-responsive-md"><thead><tr><th style="width:50px;"><div class="form-check custom-checkbox checkbox-success check-lg me-3"><input type="checkbox" class="form-check-input checkAll" id="checkAll" name="checkAll_'+num+'"><label class="form-check-label" for="checkAll"></label></div></th><th><strong>Weekday</strong></th><th><strong>Hike Amount Room</strong></th><th><strong>Adult with Extra Bed</strong></th><th><strong>Child With Extra Bed</strong></th><th><strong>Child Sharing Bed</strong></th><th><strong>Single Occupancy</strong></th></tr></thead><tbody>'+ field1.join('') +'</tbody></table></div></div>');
                field.push('<form><div class="row inc"><div class="mb-3 col-md-6"><input type="hidden" name="inclusion_common_id_fk['+num+']" id="inclusion_common_id_fk_'+num+'" value="'+item.inclusion_exclusion_common_id_fk1+'"/><input type="hidden" name="inclusions_id_fk['+num+']" id="inclusions_id_fk_'+num+'" value="'+item.inclusions_id+'"/><textarea class="form-control" name="packages_inclusions_details['+num+']" id="packages_inclusions_details_'+num+'"  rows="5" required>'+item.inclusions_details+'</textarea><span class="help-block" style="color:red"></span></div></form></div>');
                

                num++;
                
            });

            
                // $("#counter_edit1").val(num);    
            console.log(field); 
            //$("#stg").html(field);
            //$("#row1").append(field);
            $("#inclusion").html(field);
            }
        });

        $.ajax({
            url: "<?php echo base_url(); ?>index.php/Packages/exclusion_array_list/",
            dataType: 'json',
            type: 'POST',
            data:{inclusion_exclusion_common_id:inclusion_exclusion_common_id},
            success: function(data) {    
                var result = data;
            // console.log(result);
            var field = [];
            
            $.each(result, function (i, item) {                

                // field.push('<hr><div class="profile-details"><div class="profile-name px-3 pt-2"><input type="hidden" name="room_tariff_hike_rate_id['+num+']" id="room_tariff_hike_rate_id_'+num+'"><input type="hidden" name="room_id_fk['+num+']" id="room_id_fk_'+num+'" value="'+item.properties_room_category_id+'"><h4 class="text-primary mb-0">'+item.properties_room_category_name+'</h4><!--<p>UX / UI Designer</p></div><div class="profile-email px-2 pt-2"><h4 class="text-muted mb-0">hello@email.com</h4><p>Email</p>--></div></div><div class="row rates"><div class="col-md-2"><div class="form-group"><label class="col-lg-6 col-form-label" for="room_tariff_hike_rate_room_rate"><b>Room rate</b> <span class="text-danger">*</span></label><input type="number" class="form-control" name="room_tariff_hike_rate_room_rate['+num+']" id="room_tariff_hike_rate_room_rate_'+num+'" placeholder="Enter Room rate" required><span class="help-block" style="color:red"></span></div></div><div class="col-md-2"><div class="form-group"><label class="col-lg-12 col-form-label" for="room_tariff_hike_rate_adult_with_extra_bed"><b>Adult with Extra Bed Rate</b></label><input type="number" class="form-control" name="room_tariff_hike_rate_adult_with_extra_bed['+num+']" id="room_tariff_hike_rate_adult_with_extra_bed_'+num+'" placeholder="Adult with Extra Bed Rate" required><span class="help-block" style="color:red"></span></div></div><div class="col-md-2"><div class="form-group"><label class="col-lg-12 col-form-label" for="room_tariff_hike_rate_child_with_extra_bed"><b>Child With Extra Bed Rate</b></label><input type="number" class="form-control" name="room_tariff_hike_rate_child_with_extra_bed['+num+']" id="room_tariff_hike_rate_child_with_extra_bed_'+num+'" placeholder="Child With Extra Bed Rate" required><span class="help-block" style="color:red"></span></div></div> <div class="col-md-2"><div class="form-group"><label class="col-lg-10 col-form-label" for="room_tariff_hike_rate_child_sharing_bed"><b>Child Sharing Bed Rate</b></label><input type="number" class="form-control" name="room_tariff_hike_rate_child_sharing_bed['+num+']" id="room_tariff_hike_rate_child_sharing_bed_'+num+'" placeholder="Child Sharing Bed Rate" required><span class="help-block" style="color:red"></span></div></div><div class="col-md-2"><div class="form-group"><label class="col-lg-10 col-form-label" for="room_tariff_hike_rate_single_occupancy"><b>Single Occupancy Rate</b></label><input type="number" class="form-control" name="room_tariff_hike_rate_single_occupancy['+num+']" id="room_tariff_hike_rate_single_occupancy_'+num+'" placeholder="Single Occupancy Rate" required><span class="help-block" style="color:red"></span></div></div><div class="col-md-2"><div class="form-group"><label class="col-lg-12 col-form-label" for="room_tariff_hike_rate_single_occupancy"><b>Hike on some days of week</b></label><select name="room_tariff_hike_rate_some_days_type['+num+']" id="room_tariff_hike_rate_some_days_type_'+num+'" class="form-control multi-select item" required><option value="N">No</option><option value="Y">Yes</option></select><span class="help-block" style="color:red"></span></div></div><div class="row some_days" id="some_days_'+num+'"><div class="table-responsive"><table class="table table-responsive-md"><thead><tr><th style="width:50px;"><div class="form-check custom-checkbox checkbox-success check-lg me-3"><input type="checkbox" class="form-check-input checkAll" id="checkAll" name="checkAll_'+num+'"><label class="form-check-label" for="checkAll"></label></div></th><th><strong>Weekday</strong></th><th><strong>Hike Amount Room</strong></th><th><strong>Adult with Extra Bed</strong></th><th><strong>Child With Extra Bed</strong></th><th><strong>Child Sharing Bed</strong></th><th><strong>Single Occupancy</strong></th></tr></thead><tbody>'+ field1.join('') +'</tbody></table></div></div>');
                field.push('<form><div class="row exc"><div class="mb-3 col-md-6"><input type="hidden" name="exclusions_common_id_fk['+num1+']" id="exclusions_common_id_fk_'+num1+'" value="'+item.inclusion_exclusion_common_id_fk2+'"/><input type="hidden" name="exclusions_id_fk['+num1+']" id="exclusions_id_fk_'+num1+'" value="'+item.exclusions_id+'"/><textarea class="form-control" name="packages_exclusions_details['+num1+']" id="packages_exclusions_details_'+num1+'"  rows="5" required>'+item.exclusions_details+'</textarea><span class="help-block" style="color:red"></span></div></form></div>');
                

                num++;
                
            });

            
                // $("#counter_edit1").val(num);    
            console.log(field); 
            //$("#stg").html(field);
            //$("#row1").append(field);
            $("#exclusion").html(field);
            }
        });

});

////***Inclusion Dynamic text box details saving into database*****////

////***Payment policies on Dynamic text box details saving into database*****////

$("#payment_policies_id_fk").change(function() {

        var payment_policies_id = $(this).val();

        var num1 = 1; var num = 1;
        
        $.ajax({
            url: "<?php echo base_url(); ?>index.php/Packages/payment_policies_array_list/",
            dataType: 'json',
            type: 'POST',
            data:{payment_policies_id:payment_policies_id},
            success: function(data) {    
                var result = data;
            // console.log(result);
            var field = [];
            
            $.each(result, function (i, item) {                

                // field.push('<hr><div class="profile-details"><div class="profile-name px-3 pt-2"><input type="hidden" name="room_tariff_hike_rate_id['+num+']" id="room_tariff_hike_rate_id_'+num+'"><input type="hidden" name="room_id_fk['+num+']" id="room_id_fk_'+num+'" value="'+item.properties_room_category_id+'"><h4 class="text-primary mb-0">'+item.properties_room_category_name+'</h4><!--<p>UX / UI Designer</p></div><div class="profile-email px-2 pt-2"><h4 class="text-muted mb-0">hello@email.com</h4><p>Email</p>--></div></div><div class="row rates"><div class="col-md-2"><div class="form-group"><label class="col-lg-6 col-form-label" for="room_tariff_hike_rate_room_rate"><b>Room rate</b> <span class="text-danger">*</span></label><input type="number" class="form-control" name="room_tariff_hike_rate_room_rate['+num+']" id="room_tariff_hike_rate_room_rate_'+num+'" placeholder="Enter Room rate" required><span class="help-block" style="color:red"></span></div></div><div class="col-md-2"><div class="form-group"><label class="col-lg-12 col-form-label" for="room_tariff_hike_rate_adult_with_extra_bed"><b>Adult with Extra Bed Rate</b></label><input type="number" class="form-control" name="room_tariff_hike_rate_adult_with_extra_bed['+num+']" id="room_tariff_hike_rate_adult_with_extra_bed_'+num+'" placeholder="Adult with Extra Bed Rate" required><span class="help-block" style="color:red"></span></div></div><div class="col-md-2"><div class="form-group"><label class="col-lg-12 col-form-label" for="room_tariff_hike_rate_child_with_extra_bed"><b>Child With Extra Bed Rate</b></label><input type="number" class="form-control" name="room_tariff_hike_rate_child_with_extra_bed['+num+']" id="room_tariff_hike_rate_child_with_extra_bed_'+num+'" placeholder="Child With Extra Bed Rate" required><span class="help-block" style="color:red"></span></div></div> <div class="col-md-2"><div class="form-group"><label class="col-lg-10 col-form-label" for="room_tariff_hike_rate_child_sharing_bed"><b>Child Sharing Bed Rate</b></label><input type="number" class="form-control" name="room_tariff_hike_rate_child_sharing_bed['+num+']" id="room_tariff_hike_rate_child_sharing_bed_'+num+'" placeholder="Child Sharing Bed Rate" required><span class="help-block" style="color:red"></span></div></div><div class="col-md-2"><div class="form-group"><label class="col-lg-10 col-form-label" for="room_tariff_hike_rate_single_occupancy"><b>Single Occupancy Rate</b></label><input type="number" class="form-control" name="room_tariff_hike_rate_single_occupancy['+num+']" id="room_tariff_hike_rate_single_occupancy_'+num+'" placeholder="Single Occupancy Rate" required><span class="help-block" style="color:red"></span></div></div><div class="col-md-2"><div class="form-group"><label class="col-lg-12 col-form-label" for="room_tariff_hike_rate_single_occupancy"><b>Hike on some days of week</b></label><select name="room_tariff_hike_rate_some_days_type['+num+']" id="room_tariff_hike_rate_some_days_type_'+num+'" class="form-control multi-select item" required><option value="N">No</option><option value="Y">Yes</option></select><span class="help-block" style="color:red"></span></div></div><div class="row some_days" id="some_days_'+num+'"><div class="table-responsive"><table class="table table-responsive-md"><thead><tr><th style="width:50px;"><div class="form-check custom-checkbox checkbox-success check-lg me-3"><input type="checkbox" class="form-check-input checkAll" id="checkAll" name="checkAll_'+num+'"><label class="form-check-label" for="checkAll"></label></div></th><th><strong>Weekday</strong></th><th><strong>Hike Amount Room</strong></th><th><strong>Adult with Extra Bed</strong></th><th><strong>Child With Extra Bed</strong></th><th><strong>Child Sharing Bed</strong></th><th><strong>Single Occupancy</strong></th></tr></thead><tbody>'+ field1.join('') +'</tbody></table></div></div>');
                field.push('<form><div class="row"><div class="mb-3 col-md-6"><input type="hidden" name="payment_policies_items_id_fk['+num+']" id="payment_policies_items_id_fk_'+num+'" value="'+item.payment_policies_items_id+'"/><textarea class="form-control" name="packages_payment_policies_details['+num+']" id="packages_payment_policies_details_'+num+'"  rows="5" required>'+item.payment_policies_items_name+'</textarea><span class="help-block" style="color:red"></span></div></form></div>');
                

                num++;
                
            });

            
                // $("#counter_edit1").val(num);    
            console.log(field); 
            //$("#stg").html(field);
            //$("#row1").append(field);
            $("#payment-policies").html(field);
            }
        });


});

////***Payment policies on Dynamic text box details saving into database*****////

////***Terms & Condition on Dynamic text box details saving into database*****////

$("#terms_condition_id_fk").change(function() {

        var terms_condition_id = $(this).val();

        var num1 = 1; var num = 1;
        
        $.ajax({
            url: "<?php echo base_url(); ?>index.php/Packages/terms_condition_array_list/",
            dataType: 'json',
            type: 'POST',
            data:{terms_condition_id:terms_condition_id},
            success: function(data) {    
                var result = data;
            // console.log(result);
            var field = [];
            
            $.each(result, function (i, item) {                

                // field.push('<hr><div class="profile-details"><div class="profile-name px-3 pt-2"><input type="hidden" name="room_tariff_hike_rate_id['+num+']" id="room_tariff_hike_rate_id_'+num+'"><input type="hidden" name="room_id_fk['+num+']" id="room_id_fk_'+num+'" value="'+item.properties_room_category_id+'"><h4 class="text-primary mb-0">'+item.properties_room_category_name+'</h4><!--<p>UX / UI Designer</p></div><div class="profile-email px-2 pt-2"><h4 class="text-muted mb-0">hello@email.com</h4><p>Email</p>--></div></div><div class="row rates"><div class="col-md-2"><div class="form-group"><label class="col-lg-6 col-form-label" for="room_tariff_hike_rate_room_rate"><b>Room rate</b> <span class="text-danger">*</span></label><input type="number" class="form-control" name="room_tariff_hike_rate_room_rate['+num+']" id="room_tariff_hike_rate_room_rate_'+num+'" placeholder="Enter Room rate" required><span class="help-block" style="color:red"></span></div></div><div class="col-md-2"><div class="form-group"><label class="col-lg-12 col-form-label" for="room_tariff_hike_rate_adult_with_extra_bed"><b>Adult with Extra Bed Rate</b></label><input type="number" class="form-control" name="room_tariff_hike_rate_adult_with_extra_bed['+num+']" id="room_tariff_hike_rate_adult_with_extra_bed_'+num+'" placeholder="Adult with Extra Bed Rate" required><span class="help-block" style="color:red"></span></div></div><div class="col-md-2"><div class="form-group"><label class="col-lg-12 col-form-label" for="room_tariff_hike_rate_child_with_extra_bed"><b>Child With Extra Bed Rate</b></label><input type="number" class="form-control" name="room_tariff_hike_rate_child_with_extra_bed['+num+']" id="room_tariff_hike_rate_child_with_extra_bed_'+num+'" placeholder="Child With Extra Bed Rate" required><span class="help-block" style="color:red"></span></div></div> <div class="col-md-2"><div class="form-group"><label class="col-lg-10 col-form-label" for="room_tariff_hike_rate_child_sharing_bed"><b>Child Sharing Bed Rate</b></label><input type="number" class="form-control" name="room_tariff_hike_rate_child_sharing_bed['+num+']" id="room_tariff_hike_rate_child_sharing_bed_'+num+'" placeholder="Child Sharing Bed Rate" required><span class="help-block" style="color:red"></span></div></div><div class="col-md-2"><div class="form-group"><label class="col-lg-10 col-form-label" for="room_tariff_hike_rate_single_occupancy"><b>Single Occupancy Rate</b></label><input type="number" class="form-control" name="room_tariff_hike_rate_single_occupancy['+num+']" id="room_tariff_hike_rate_single_occupancy_'+num+'" placeholder="Single Occupancy Rate" required><span class="help-block" style="color:red"></span></div></div><div class="col-md-2"><div class="form-group"><label class="col-lg-12 col-form-label" for="room_tariff_hike_rate_single_occupancy"><b>Hike on some days of week</b></label><select name="room_tariff_hike_rate_some_days_type['+num+']" id="room_tariff_hike_rate_some_days_type_'+num+'" class="form-control multi-select item" required><option value="N">No</option><option value="Y">Yes</option></select><span class="help-block" style="color:red"></span></div></div><div class="row some_days" id="some_days_'+num+'"><div class="table-responsive"><table class="table table-responsive-md"><thead><tr><th style="width:50px;"><div class="form-check custom-checkbox checkbox-success check-lg me-3"><input type="checkbox" class="form-check-input checkAll" id="checkAll" name="checkAll_'+num+'"><label class="form-check-label" for="checkAll"></label></div></th><th><strong>Weekday</strong></th><th><strong>Hike Amount Room</strong></th><th><strong>Adult with Extra Bed</strong></th><th><strong>Child With Extra Bed</strong></th><th><strong>Child Sharing Bed</strong></th><th><strong>Single Occupancy</strong></th></tr></thead><tbody>'+ field1.join('') +'</tbody></table></div></div>');
                field.push('<form><div class="row"><div class="mb-3 col-md-6"><input type="hidden" name="terms_condition_item_id_fk['+num+']" id="terms_condition_item_id_fk_'+num+'" value="'+item.terms_condition_items_id+'"/><textarea class="form-control" name="packages_terms_condition_details['+num+']" id="packages_terms_condition_details_'+num+'"  rows="5" required>'+item.terms_condition_items_name+'</textarea><span class="help-block" style="color:red"></span></div></form></div>');
                

                num++;
                
            });

            
                // $("#counter_edit1").val(num);    
            console.log(field); 
            //$("#stg").html(field);
            //$("#row1").append(field);
            $("#terms-conditions").html(field);
            }
        });


});

////***Terms & Condition on Dynamic text box details saving into database*****////

////***Cancellation policy on Dynamic text box details saving into database*****////

$("#cancellation_policies_id_fk").change(function() {

        var cancellation_policies_id = $(this).val();

        var num1 = 1; var num = 1;
        
        $.ajax({
            url: "<?php echo base_url(); ?>index.php/Packages/cancellation_policies_array_list/",
            dataType: 'json',
            type: 'POST',
            data:{cancellation_policies_id:cancellation_policies_id},
            success: function(data) {    
                var result = data;
            // console.log(result);
            var field = [];
            
            $.each(result, function (i, item) {                

                // field.push('<hr><div class="profile-details"><div class="profile-name px-3 pt-2"><input type="hidden" name="room_tariff_hike_rate_id['+num+']" id="room_tariff_hike_rate_id_'+num+'"><input type="hidden" name="room_id_fk['+num+']" id="room_id_fk_'+num+'" value="'+item.properties_room_category_id+'"><h4 class="text-primary mb-0">'+item.properties_room_category_name+'</h4><!--<p>UX / UI Designer</p></div><div class="profile-email px-2 pt-2"><h4 class="text-muted mb-0">hello@email.com</h4><p>Email</p>--></div></div><div class="row rates"><div class="col-md-2"><div class="form-group"><label class="col-lg-6 col-form-label" for="room_tariff_hike_rate_room_rate"><b>Room rate</b> <span class="text-danger">*</span></label><input type="number" class="form-control" name="room_tariff_hike_rate_room_rate['+num+']" id="room_tariff_hike_rate_room_rate_'+num+'" placeholder="Enter Room rate" required><span class="help-block" style="color:red"></span></div></div><div class="col-md-2"><div class="form-group"><label class="col-lg-12 col-form-label" for="room_tariff_hike_rate_adult_with_extra_bed"><b>Adult with Extra Bed Rate</b></label><input type="number" class="form-control" name="room_tariff_hike_rate_adult_with_extra_bed['+num+']" id="room_tariff_hike_rate_adult_with_extra_bed_'+num+'" placeholder="Adult with Extra Bed Rate" required><span class="help-block" style="color:red"></span></div></div><div class="col-md-2"><div class="form-group"><label class="col-lg-12 col-form-label" for="room_tariff_hike_rate_child_with_extra_bed"><b>Child With Extra Bed Rate</b></label><input type="number" class="form-control" name="room_tariff_hike_rate_child_with_extra_bed['+num+']" id="room_tariff_hike_rate_child_with_extra_bed_'+num+'" placeholder="Child With Extra Bed Rate" required><span class="help-block" style="color:red"></span></div></div> <div class="col-md-2"><div class="form-group"><label class="col-lg-10 col-form-label" for="room_tariff_hike_rate_child_sharing_bed"><b>Child Sharing Bed Rate</b></label><input type="number" class="form-control" name="room_tariff_hike_rate_child_sharing_bed['+num+']" id="room_tariff_hike_rate_child_sharing_bed_'+num+'" placeholder="Child Sharing Bed Rate" required><span class="help-block" style="color:red"></span></div></div><div class="col-md-2"><div class="form-group"><label class="col-lg-10 col-form-label" for="room_tariff_hike_rate_single_occupancy"><b>Single Occupancy Rate</b></label><input type="number" class="form-control" name="room_tariff_hike_rate_single_occupancy['+num+']" id="room_tariff_hike_rate_single_occupancy_'+num+'" placeholder="Single Occupancy Rate" required><span class="help-block" style="color:red"></span></div></div><div class="col-md-2"><div class="form-group"><label class="col-lg-12 col-form-label" for="room_tariff_hike_rate_single_occupancy"><b>Hike on some days of week</b></label><select name="room_tariff_hike_rate_some_days_type['+num+']" id="room_tariff_hike_rate_some_days_type_'+num+'" class="form-control multi-select item" required><option value="N">No</option><option value="Y">Yes</option></select><span class="help-block" style="color:red"></span></div></div><div class="row some_days" id="some_days_'+num+'"><div class="table-responsive"><table class="table table-responsive-md"><thead><tr><th style="width:50px;"><div class="form-check custom-checkbox checkbox-success check-lg me-3"><input type="checkbox" class="form-check-input checkAll" id="checkAll" name="checkAll_'+num+'"><label class="form-check-label" for="checkAll"></label></div></th><th><strong>Weekday</strong></th><th><strong>Hike Amount Room</strong></th><th><strong>Adult with Extra Bed</strong></th><th><strong>Child With Extra Bed</strong></th><th><strong>Child Sharing Bed</strong></th><th><strong>Single Occupancy</strong></th></tr></thead><tbody>'+ field1.join('') +'</tbody></table></div></div>');
                field.push('<form><div class="row"><div class="mb-3 col-md-6"><input type="hidden" name="cancellation_policies_item_id_fk['+counter7+']" id="cancellation_policies_item_id_fk_'+counter7+'" value="'+item.cancellation_policies_item_id+'"/><textarea class="form-control" name="packages_cancellation_policies_details['+num+']" id="packages_cancellation_policies_details_'+num+'"  rows="5" required>'+item.cancellation_policies_item_name+'</textarea><span class="help-block" style="color:red"></span></div></form></div>');
                

                num++;
                
            });

            
                // $("#counter_edit1").val(num);    
            console.log(field); 
            //$("#stg").html(field);
            //$("#row1").append(field);
            $("#cancellation-policy").html(field);
            }
        });


});

////***Cancellation policy on Dynamic text box details saving into database*****////

////***Inclusion Dynamic text box details saving into database*****////

var counter1 = 1;

var n1 = $("#counter_edit1").val();
                 // alert(n1);

var counter_edit1 = $("#counter_edit1").val();



if(counter_edit1 >0){
    counter1 = counter_edit1-1;
}

function addMore1() {
 var n1 = $("#counter_edit").val();

    $("<DIV>").load("", function() {
    
    $(this).attr('data-validation','required');
    $(this).attr('data-validation','nameFields');
    $(this).attr('data-validation','digitsOnly');
    $(this).attr('data-validation','date');
    $(this).attr('data-validation','usPhone');
    $(this).attr('data-validation','email');
    $(this).attr('data-validation','dropDown');


    // var htmlVal = '<DIV class="product-item box box-success list exp_section" id="product-item_'+counter+'">&nbsp <input type="hidden" name="sub-counter-'+counter+'" id="sub-counter-'+counter+'" value="0" /> <table class="table table-bordered" cellspacing="2" ><tr><div class="row"><div class="col-sm-12"><input type="hidden" name="terms_condition_id_fk['+counter+']" id="terms_condition_id_fk_'+counter+'"/> <textarea class="form-control" name="terms_condition_items_name['+counter+']" id="terms_condition_items_name_'+counter+'"  rows="5" placeholder="Enter details" required></textarea><button class="btn-sm btn-danger" type="button" style="margin-top:20%;" onClick="deleteRow('+counter+');"><b>X</b></button></div></div></div></tr></table></DIV>';

    //  var htmlVal = '<div class="mb-3 col-md-8 product-item" id="product-item_'+counter+'"><input type="hidden" name="terms_condition_id_fk['+counter+']" id="terms_condition_id_fk_'+counter+'"/><textarea class="form-control" name="terms_condition_items_name['+counter+']" id="terms_condition_items_name_'+counter+'"  rows="5" placeholder="Enter Terms and condition" required></textarea><span class="help-block" style="color:red"></span></div><div class="mb-3 col-md-3 product-item1" id="product-item1_'+counter+'"><button class="btn-sm btn-danger" type="button" onClick="deleteRow('+counter+');"><b>X</b></button></div>';
     var htmlVal = '<form><div class="row" id="product-item1_'+counter1+'"><div class="mb-3 col-md-6"  ><input type="hidden" name="inclusion_common_id_fk['+counter1+']" id="inclusion_common_id_fk_'+counter1+'"/><input type="hidden" name="inclusions_id_fk['+counter1+']" id="inclusions_id_fk_'+counter1+'" /><textarea class="form-control" name="packages_inclusions_details['+counter1+']" id="packages_inclusions_details_'+counter1+'"  rows="5" required></textarea><span class="help-block" style="color:red"></span></div><div class="mb-3 col-md-3"><button class="btn-sm btn-danger" type="button" onClick="deleteRow1('+counter1+');"><b>X</b></button></div></div></form>';
    $("#inclusion").append(htmlVal);   
        
    
  });   
counter1++;  

}
////***Inclusion Dynamic text box details saving into database*****////

////***Inclusion Delete dynamic table rows*****///
var removed_item_ids = [];
function deleteRow1(counter1) {

    console.log(counter1,"counter");
    $("#product-item1_"+counter1).remove();
    var a = $("#countervalue").val();
    $("#countervalue").val(a-1);

   

}

////***Inclusion Delete dynamic table rows*****///

////***Exclusion Dynamic text box details saving into database*****////

var counter2 = 1;

var n2 = $("#counter_edit1").val();
                 // alert(n1);

var counter_edit2 = $("#counter_edit1").val();



if(counter_edit2 >0){
    counter2 = counter_edit2-1;
}

function addMore2() {
 var n1 = $("#counter_edit").val();

    $("<DIV>").load("", function() {
    
    $(this).attr('data-validation','required');
    $(this).attr('data-validation','nameFields');
    $(this).attr('data-validation','digitsOnly');
    $(this).attr('data-validation','date');
    $(this).attr('data-validation','usPhone');
    $(this).attr('data-validation','email');
    $(this).attr('data-validation','dropDown');


    // var htmlVal = '<DIV class="product-item box box-success list exp_section" id="product-item_'+counter+'">&nbsp <input type="hidden" name="sub-counter-'+counter+'" id="sub-counter-'+counter+'" value="0" /> <table class="table table-bordered" cellspacing="2" ><tr><div class="row"><div class="col-sm-12"><input type="hidden" name="terms_condition_id_fk['+counter+']" id="terms_condition_id_fk_'+counter+'"/> <textarea class="form-control" name="terms_condition_items_name['+counter+']" id="terms_condition_items_name_'+counter+'"  rows="5" placeholder="Enter details" required></textarea><button class="btn-sm btn-danger" type="button" style="margin-top:20%;" onClick="deleteRow('+counter+');"><b>X</b></button></div></div></div></tr></table></DIV>';

    //  var htmlVal = '<div class="mb-3 col-md-8 product-item" id="product-item_'+counter+'"><input type="hidden" name="terms_condition_id_fk['+counter+']" id="terms_condition_id_fk_'+counter+'"/><textarea class="form-control" name="terms_condition_items_name['+counter+']" id="terms_condition_items_name_'+counter+'"  rows="5" placeholder="Enter Terms and condition" required></textarea><span class="help-block" style="color:red"></span></div><div class="mb-3 col-md-3 product-item1" id="product-item1_'+counter+'"><button class="btn-sm btn-danger" type="button" onClick="deleteRow('+counter+');"><b>X</b></button></div>';
     var htmlVal = '<form><div class="row" id="product-item1_'+counter2+'"><div class="mb-3 col-md-6"  ><input type="hidden" name="exclusions_common_id_fk['+counter2+']" id="exclusions_common_id_fk_'+counter2+'" /><input type="hidden" name="exclusions_id_fk['+counter2+']" id="exclusions_id_fk_'+counter2+'" /><textarea class="form-control" name="packages_exclusions_details['+counter2+']" id="packages_exclusions_details_'+counter2+'"  rows="5" required></textarea><span class="help-block" style="color:red"></span></div><div class="mb-3 col-md-3"><button class="btn-sm btn-danger" type="button" onClick="deleteRow2('+counter2+');"><b>X</b></button></div></div></form>';
    $("#exclusion").append(htmlVal);   
        
    
  });   
counter2++;  

}
////***Exclusion Dynamic text box details saving into database*****////

////***Exclusion Delete dynamic table rows*****///
var removed_item_ids = [];
function deleteRow2(counter2) {

    console.log(counter2,"counter");
    $("#product-item1_"+counter2).remove();
    var a = $("#countervalue").val();
    $("#countervalue").val(a-1);

   

}

////***Exclusion Delete dynamic table rows*****///

////***Optional add-on Dynamic text box details saving into database*****////

var counter3 = 1;

var n3 = $("#counter_edit1").val();
                 // alert(n1);

var counter_edit3 = $("#counter_edit1").val();



if(counter_edit3 >0){
    counter3 = counter_edit3-1;
}

function addMore3() {
 var n1 = $("#counter_edit").val();

    $("<DIV>").load("", function() {
    
    $(this).attr('data-validation','required');
    $(this).attr('data-validation','nameFields');
    $(this).attr('data-validation','digitsOnly');
    $(this).attr('data-validation','date');
    $(this).attr('data-validation','usPhone');
    $(this).attr('data-validation','email');
    $(this).attr('data-validation','dropDown');


    // var htmlVal = '<DIV class="product-item box box-success list exp_section" id="product-item_'+counter+'">&nbsp <input type="hidden" name="sub-counter-'+counter+'" id="sub-counter-'+counter+'" value="0" /> <table class="table table-bordered" cellspacing="2" ><tr><div class="row"><div class="col-sm-12"><input type="hidden" name="terms_condition_id_fk['+counter+']" id="terms_condition_id_fk_'+counter+'"/> <textarea class="form-control" name="terms_condition_items_name['+counter+']" id="terms_condition_items_name_'+counter+'"  rows="5" placeholder="Enter details" required></textarea><button class="btn-sm btn-danger" type="button" style="margin-top:20%;" onClick="deleteRow('+counter+');"><b>X</b></button></div></div></div></tr></table></DIV>';

    //  var htmlVal = '<div class="mb-3 col-md-8 product-item" id="product-item_'+counter+'"><input type="hidden" name="terms_condition_id_fk['+counter+']" id="terms_condition_id_fk_'+counter+'"/><textarea class="form-control" name="terms_condition_items_name['+counter+']" id="terms_condition_items_name_'+counter+'"  rows="5" placeholder="Enter Terms and condition" required></textarea><span class="help-block" style="color:red"></span></div><div class="mb-3 col-md-3 product-item1" id="product-item1_'+counter+'"><button class="btn-sm btn-danger" type="button" onClick="deleteRow('+counter+');"><b>X</b></button></div>';
     var htmlVal = '<form><div class="row" id="product-item1_'+counter3+'"><div class="mb-3 col-md-6"><textarea class="form-control" name="packages_optional_add_on_details['+counter3+']" id="packages_optional_add_on_details_'+counter3+'"  rows="5" placeholder="Enter Optional add on" required></textarea><span class="help-block" style="color:red"></span></div><div class="mb-3 col-md-3"><button class="btn-sm btn-danger" type="button" onClick="deleteRow3('+counter3+');"><b>X</b></button></div></div></form>';
    $("#optional-addon").append(htmlVal);   
        
    
  });   
counter3++;  

}
////***Optional add-on Dynamic text box details saving into database*****////

////***Optional add-on Delete dynamic table rows*****///
var removed_item_ids = [];
function deleteRow3(counter3) {

    console.log(counter3,"counter");
    $("#product-item1_"+counter3).remove();
    var a = $("#countervalue").val();
    $("#countervalue").val(a-1);

   

}
////***Optional add-on Delete dynamic table rows*****///

////***Special requirments Dynamic text box details saving into database*****////

var counter4 = 1;

var n4 = $("#counter_edit1").val();
                 // alert(n1);

var counter_edit4 = $("#counter_edit1").val();



if(counter_edit4 >0){
    counter4 = counter_edit4-1;
}

function addMore4() {
 var n1 = $("#counter_edit").val();

    $("<DIV>").load("", function() {
    
    $(this).attr('data-validation','required');
    $(this).attr('data-validation','nameFields');
    $(this).attr('data-validation','digitsOnly');
    $(this).attr('data-validation','date');
    $(this).attr('data-validation','usPhone');
    $(this).attr('data-validation','email');
    $(this).attr('data-validation','dropDown');


    // var htmlVal = '<DIV class="product-item box box-success list exp_section" id="product-item_'+counter+'">&nbsp <input type="hidden" name="sub-counter-'+counter+'" id="sub-counter-'+counter+'" value="0" /> <table class="table table-bordered" cellspacing="2" ><tr><div class="row"><div class="col-sm-12"><input type="hidden" name="terms_condition_id_fk['+counter+']" id="terms_condition_id_fk_'+counter+'"/> <textarea class="form-control" name="terms_condition_items_name['+counter+']" id="terms_condition_items_name_'+counter+'"  rows="5" placeholder="Enter details" required></textarea><button class="btn-sm btn-danger" type="button" style="margin-top:20%;" onClick="deleteRow('+counter+');"><b>X</b></button></div></div></div></tr></table></DIV>';

    //  var htmlVal = '<div class="mb-3 col-md-8 product-item" id="product-item_'+counter+'"><input type="hidden" name="terms_condition_id_fk['+counter+']" id="terms_condition_id_fk_'+counter+'"/><textarea class="form-control" name="terms_condition_items_name['+counter+']" id="terms_condition_items_name_'+counter+'"  rows="5" placeholder="Enter Terms and condition" required></textarea><span class="help-block" style="color:red"></span></div><div class="mb-3 col-md-3 product-item1" id="product-item1_'+counter+'"><button class="btn-sm btn-danger" type="button" onClick="deleteRow('+counter+');"><b>X</b></button></div>';
     var htmlVal = '<form><div class="row" id="product-item1_'+counter4+'"><div class="mb-3 col-md-3"><select name="special_requirements_id_fk['+counter4+']" id="special_requirements_id_fk_'+counter4+'" class="form-control special" required></select><span class="help-block" style="color:red"></span></div><div class="mb-3 col-md-3"><input type="text" class="form-control" name="packages_special_requirements_cost['+counter4+']" id="packages_special_requirements_cost_'+counter4+'" placeholder="Enter amount" required></div><div class="mb-3 col-md-3"><button class="btn-sm btn-danger" type="button" onClick="deleteRow4('+counter4+');"><b>X</b></button></div></div></form>';
    $("#special-requirments").append(htmlVal);   
        
    $('#special_requirements_id_fk_'+counter4+'').select2();

    $.ajax({
			
			type: "POST",
			url: "<?php echo base_url()?>index.php/Packages/gettspecialrequirment_details/",
			success: function(cities)
			{
				$('#special_requirements_id_fk_'+counter4+'').append('<option value="">Please Select Special requirment</option>');

				$.each(cities,function(id,city) {

				  var opt = $('<option />');
				  opt.val(id);
				  opt.text(city);

				  $('#special_requirements_id_fk_'+counter4+'').append(opt);
				  $('#special_requirements_id_fk'+counter4+'').append(opt);

				});
			}
		})
        
        $(document).on("change",'#special_requirements_id_fk_'+counter4+'',function(){
    //var type = $(this).val();
    //var counterId = $(this).attr("id");
    // var counter = counterId.substr(counterId.length - 1);
    //var counter = counterId.split("_").pop(-1);
    // console.log(counter,"counter");

    special_requirements_packages_id = $('#special_requirements_id_fk_'+counter4+'').val();

     $.ajax({
            url: "<?php echo base_url(); ?>index.php/Packages/Specialrequirmentamount/"+special_requirements_packages_id,
            dataType: 'json',
            type: 'POST',
            success:
            function(data) {
                amount = data['amount'];
                if(amount>0)
                {
                    var amount = data['amount'];
                }
                else{
                    var amount = 0;
                }
                
                    $('#packages_special_requirements_cost_'+counter4+'').val(amount);
                    }
                
            
        });

});
       
    
  });   
counter4++;  

}
 

////***Special requirments Dynamic text box details saving into database*****////

////***Special requirments Delete dynamic table rows*****///
var removed_item_ids = [];
function deleteRow4(counter4) {

    console.log(counter4,"counter");
    $("#product-item1_"+counter4).remove();
    var a = $("#countervalue").val();
    $("#countervalue").val(a-1);

   

}
////***Special requirments Delete dynamic table rows*****///

////***Payment policies Dynamic text box details saving into database*****////

var counter5 = 1;

var n5 = $("#counter_edit1").val();
                 // alert(n1);

var counter_edit5 = $("#counter_edit1").val();



if(counter_edit5 >0){
    counter5 = counter_edit5-1;
}

function addMore5() {
 var n5 = $("#counter_edit").val();

    $("<DIV>").load("", function() {
    
    $(this).attr('data-validation','required');
    $(this).attr('data-validation','nameFields');
    $(this).attr('data-validation','digitsOnly');
    $(this).attr('data-validation','date');
    $(this).attr('data-validation','usPhone');
    $(this).attr('data-validation','email');
    $(this).attr('data-validation','dropDown');


    // var htmlVal = '<DIV class="product-item box box-success list exp_section" id="product-item_'+counter+'">&nbsp <input type="hidden" name="sub-counter-'+counter+'" id="sub-counter-'+counter+'" value="0" /> <table class="table table-bordered" cellspacing="2" ><tr><div class="row"><div class="col-sm-12"><input type="hidden" name="terms_condition_id_fk['+counter+']" id="terms_condition_id_fk_'+counter+'"/> <textarea class="form-control" name="terms_condition_items_name['+counter+']" id="terms_condition_items_name_'+counter+'"  rows="5" placeholder="Enter details" required></textarea><button class="btn-sm btn-danger" type="button" style="margin-top:20%;" onClick="deleteRow('+counter+');"><b>X</b></button></div></div></div></tr></table></DIV>';

    //  var htmlVal = '<div class="mb-3 col-md-8 product-item" id="product-item_'+counter+'"><input type="hidden" name="terms_condition_id_fk['+counter+']" id="terms_condition_id_fk_'+counter+'"/><textarea class="form-control" name="terms_condition_items_name['+counter+']" id="terms_condition_items_name_'+counter+'"  rows="5" placeholder="Enter Terms and condition" required></textarea><span class="help-block" style="color:red"></span></div><div class="mb-3 col-md-3 product-item1" id="product-item1_'+counter+'"><button class="btn-sm btn-danger" type="button" onClick="deleteRow('+counter+');"><b>X</b></button></div>';
     var htmlVal = '<form><div class="row payment" id="product-item1_'+counter5+'"><div class="mb-3 col-md-6"  ><input type="hidden" name="payment_policies_items_id_fk['+counter5+']" id="payment_policies_items_id_fk_'+counter5+'"/><textarea class="form-control" name="packages_payment_policies_details['+counter5+']" id="packages_payment_policies_details_'+counter5+'"  rows="5" required></textarea><span class="help-block" style="color:red"></span></div><div class="mb-3 col-md-3"><button class="btn-sm btn-danger" type="button" onClick="deleteRow5('+counter5+');"><b>X</b></button></div></div></form>';
    $("#payment-policies").append(htmlVal);   
        
    
  });   
counter5++;  

}
////***Payment policies Dynamic text box details saving into database*****////

////***Payment policies Delete dynamic table rows*****///
var removed_item_ids = [];
function deleteRow5(counter5) {

    console.log(counter5,"counter");
    $("#product-item1_"+counter5).remove();
    var a = $("#countervalue").val();
    $("#countervalue").val(a-1);

   

}
////***Payment policies Delete dynamic table rows*****///

////***Terms & conditions Dynamic text box details saving into database*****////

var counter6 = 1;

var n6 = $("#counter_edit1").val();
                 // alert(n1);

var counter_edit6 = $("#counter_edit1").val();



if(counter_edit6 >0){
    counter6 = counter_edit6-1;
}

function addMore6() {
 var n6 = $("#counter_edit").val();

    $("<DIV>").load("", function() {
    
    $(this).attr('data-validation','required');
    $(this).attr('data-validation','nameFields');
    $(this).attr('data-validation','digitsOnly');
    $(this).attr('data-validation','date');
    $(this).attr('data-validation','usPhone');
    $(this).attr('data-validation','email');
    $(this).attr('data-validation','dropDown');


    // var htmlVal = '<DIV class="product-item box box-success list exp_section" id="product-item_'+counter+'">&nbsp <input type="hidden" name="sub-counter-'+counter+'" id="sub-counter-'+counter+'" value="0" /> <table class="table table-bordered" cellspacing="2" ><tr><div class="row"><div class="col-sm-12"><input type="hidden" name="terms_condition_id_fk['+counter+']" id="terms_condition_id_fk_'+counter+'"/> <textarea class="form-control" name="terms_condition_items_name['+counter+']" id="terms_condition_items_name_'+counter+'"  rows="5" placeholder="Enter details" required></textarea><button class="btn-sm btn-danger" type="button" style="margin-top:20%;" onClick="deleteRow('+counter+');"><b>X</b></button></div></div></div></tr></table></DIV>';

    //  var htmlVal = '<div class="mb-3 col-md-8 product-item" id="product-item_'+counter+'"><input type="hidden" name="terms_condition_id_fk['+counter+']" id="terms_condition_id_fk_'+counter+'"/><textarea class="form-control" name="terms_condition_items_name['+counter+']" id="terms_condition_items_name_'+counter+'"  rows="5" placeholder="Enter Terms and condition" required></textarea><span class="help-block" style="color:red"></span></div><div class="mb-3 col-md-3 product-item1" id="product-item1_'+counter+'"><button class="btn-sm btn-danger" type="button" onClick="deleteRow('+counter+');"><b>X</b></button></div>';
     var htmlVal = '<form><div class="row payment" id="product-item1_'+counter6+'"><div class="mb-3 col-md-6"  ><input type="hidden" name="terms_condition_item_id_fk['+counter6+']" id="terms_condition_item_id_fk_'+counter6+'" /><textarea class="form-control" name="packages_terms_condition_details['+counter6+']" id="packages_terms_condition_details_'+counter6+'"  rows="5" required></textarea><span class="help-block" style="color:red"></span></div><div class="mb-3 col-md-3"><button class="btn-sm btn-danger" type="button" onClick="deleteRow6('+counter6+');"><b>X</b></button></div></div></form>';
    $("#terms-conditions").append(htmlVal);   
        
    
  });   
counter6++;  

}
////***Terms & conditions Dynamic text box details saving into database*****////

////***Terms & conditions Delete dynamic table rows*****///
var removed_item_ids = [];
function deleteRow6(counter6) {

    console.log(counter6,"counter");
    $("#product-item1_"+counter6).remove();
    var a = $("#countervalue").val();
    $("#countervalue").val(a-1);

   

}
////***Terms & conditions Delete dynamic table rows*****///

////***Cancellation policy Dynamic text box details saving into database*****////

var counter7 = 1;

var n6 = $("#counter_edit1").val();
                 // alert(n1);

var counter_edit7 = $("#counter_edit1").val();



if(counter_edit7 >0){
    counter7 = counter_edit7-1;
}

function addMore7() {
 var n7 = $("#counter_edit").val();

    $("<DIV>").load("", function() {
    
    $(this).attr('data-validation','required');
    $(this).attr('data-validation','nameFields');
    $(this).attr('data-validation','digitsOnly');
    $(this).attr('data-validation','date');
    $(this).attr('data-validation','usPhone');
    $(this).attr('data-validation','email');
    $(this).attr('data-validation','dropDown');


    // var htmlVal = '<DIV class="product-item box box-success list exp_section" id="product-item_'+counter+'">&nbsp <input type="hidden" name="sub-counter-'+counter+'" id="sub-counter-'+counter+'" value="0" /> <table class="table table-bordered" cellspacing="2" ><tr><div class="row"><div class="col-sm-12"><input type="hidden" name="terms_condition_id_fk['+counter+']" id="terms_condition_id_fk_'+counter+'"/> <textarea class="form-control" name="terms_condition_items_name['+counter+']" id="terms_condition_items_name_'+counter+'"  rows="5" placeholder="Enter details" required></textarea><button class="btn-sm btn-danger" type="button" style="margin-top:20%;" onClick="deleteRow('+counter+');"><b>X</b></button></div></div></div></tr></table></DIV>';

    //  var htmlVal = '<div class="mb-3 col-md-8 product-item" id="product-item_'+counter+'"><input type="hidden" name="terms_condition_id_fk['+counter+']" id="terms_condition_id_fk_'+counter+'"/><textarea class="form-control" name="terms_condition_items_name['+counter+']" id="terms_condition_items_name_'+counter+'"  rows="5" placeholder="Enter Terms and condition" required></textarea><span class="help-block" style="color:red"></span></div><div class="mb-3 col-md-3 product-item1" id="product-item1_'+counter+'"><button class="btn-sm btn-danger" type="button" onClick="deleteRow('+counter+');"><b>X</b></button></div>';
     var htmlVal = '<form><div class="row payment" id="product-item1_'+counter7+'"><div class="mb-3 col-md-6"  ><input type="hidden" name="cancellation_policies_item_id_fk['+counter7+']" id="cancellation_policies_item_id_fk_'+counter7+'" /><textarea class="form-control" name="packages_terms_condition_details['+counter7+']" id="packages_terms_condition_details_'+counter7+'"  rows="5" required></textarea><span class="help-block" style="color:red"></span></div><div class="mb-3 col-md-3"><button class="btn-sm btn-danger" type="button" onClick="deleteRow7('+counter7+');"><b>X</b></button></div></div></form>';
    $("#cancellation-policy").append(htmlVal);   
        
    
  });   
counter7++;  

}
////***Cancellation policy Dynamic text box details saving into database*****////

////***Cancellation policy Delete dynamic table rows*****///
var removed_item_ids = [];
function deleteRow7(counter7) {

    console.log(counter7,"counter");
    $("#product-item1_"+counter7).remove();
    var a = $("#countervalue").val();
    $("#countervalue").val(a-1);

   

}
////***Cancellation policy Delete dynamic table rows*****///

////***Notes Dynamic text box details saving into database*****////

var counter8 = 1;

var n8 = $("#counter_edit1").val();
                 // alert(n1);

var counter_edit8 = $("#counter_edit1").val();



if(counter_edit8 >0){
    counter8 = counter_edit8-1;
}

function addMore8() {
 var n8 = $("#counter_edit").val();

    $("<DIV>").load("", function() {
    
    $(this).attr('data-validation','required');
    $(this).attr('data-validation','nameFields');
    $(this).attr('data-validation','digitsOnly');
    $(this).attr('data-validation','date');
    $(this).attr('data-validation','usPhone');
    $(this).attr('data-validation','email');
    $(this).attr('data-validation','dropDown');


    // var htmlVal = '<DIV class="product-item box box-success list exp_section" id="product-item_'+counter+'">&nbsp <input type="hidden" name="sub-counter-'+counter+'" id="sub-counter-'+counter+'" value="0" /> <table class="table table-bordered" cellspacing="2" ><tr><div class="row"><div class="col-sm-12"><input type="hidden" name="terms_condition_id_fk['+counter+']" id="terms_condition_id_fk_'+counter+'"/> <textarea class="form-control" name="terms_condition_items_name['+counter+']" id="terms_condition_items_name_'+counter+'"  rows="5" placeholder="Enter details" required></textarea><button class="btn-sm btn-danger" type="button" style="margin-top:20%;" onClick="deleteRow('+counter+');"><b>X</b></button></div></div></div></tr></table></DIV>';

    //  var htmlVal = '<div class="mb-3 col-md-8 product-item" id="product-item_'+counter+'"><input type="hidden" name="terms_condition_id_fk['+counter+']" id="terms_condition_id_fk_'+counter+'"/><textarea class="form-control" name="terms_condition_items_name['+counter+']" id="terms_condition_items_name_'+counter+'"  rows="5" placeholder="Enter Terms and condition" required></textarea><span class="help-block" style="color:red"></span></div><div class="mb-3 col-md-3 product-item1" id="product-item1_'+counter+'"><button class="btn-sm btn-danger" type="button" onClick="deleteRow('+counter+');"><b>X</b></button></div>';
     var htmlVal = '<form><div class="row" id="product-item1_'+counter8+'"><div class="mb-3 col-md-6"><textarea class="form-control" name="packages_notes_details['+counter8+']" id="packages_notes_details_'+counter8+'"  rows="5" placeholder="Enter Notes" required></textarea><span class="help-block" style="color:red"></span></div><div class="mb-3 col-md-3"><button class="btn-sm btn-danger" type="button" onClick="deleteRow8('+counter8+');"><b>X</b></button></div></div></form>';
    $("#add_notes").append(htmlVal);   
    
  });   
counter8++;  

}
////***Notes Dynamic text box details saving into database*****////

////***Notes Delete dynamic table rows*****///
var removed_item_ids = [];
function deleteRow8(counter8) {

    console.log(counter8,"counter");
    $("#product-item1_"+counter8).remove();
    var a = $("#countervalue").val();
    $("#countervalue").val(a-1);

   

}
////***Notes Delete dynamic table rows*****///

// $(document).ready(function()  {
//     $('#packages_property_type').on("click", function()  {
//         $('#table2 tbody').empty();
//         var $newrow,
//             $newcolumn;
//         $('#table1 tbody input:checked').parent().parent().each(function() {
//             $newrow = $('<tr></tr>').appendTo($('#table2 tbody'));
//             $("td", this).each(function() {
//                 if($("input", this).length == 0) {
//                     $newcolumn = $("<td><div></div></td>").appendTo($newrow);
//                     $("div", $newcolumn).html($(this).text());
//                 }
//             });
//         });
//     });
// });


</script>