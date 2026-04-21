<script>
// https://www.geeksforgeeks.org/jquery/how-to-get-a-dialog-box-if-there-is-no-internet-connection-using-jquery/
$(document).ready(function () {        
       
    $("#properties_room_category_welcomes_child_all_ages").change(function(){
        
        if($(this).val()=="Y"){

            
            $("#properties_room_category_admission_restricted_guests_under_age").prop('disabled',true);
            $('#properties_room_category_adult_rate_applied_guest_over').val('');
            $('#properties_room_category_adult_rate_applied_guest_over_hidden').val('');
        }
        else{

            $("#properties_room_category_admission_restricted_guests_under_age").prop('disabled',false);
            $('#properties_room_category_admission_restricted_guests_under_age').val('0');


            var complimentary = $('#properties_room_category_complimentary_guest_between_type').val('N').change();
            var child_rate = $('#properties_room_category_child_rate_applied_guest_between_type').val('N').change();
            $('#properties_room_category_complimentary_guest_between_from_year').val('');
            $('#properties_room_category_complimentary_guest_between_from_year_hidden').val('');

            $('#properties_room_category_child_rate_applied_guest_from_year').val('');
            $('#properties_room_category_child_rate_applied_guest_from_year_hidden').val('');

            $('#properties_room_category_adult_rate_applied_guest_over').val('0');
            $('#properties_room_category_adult_rate_applied_guest_over_hidden').val('0');

        }
        $('#properties_room_category_admission_restricted_guests_under_age').val('');
        $('#properties_room_category_complimentary_guest_between_from_year').val('');
        $('#properties_room_category_complimentary_guest_between_from_year_hidden').val('');
        $('#properties_room_category_complimentary_guest_between_to_year').val('');
        $('#properties_room_category_child_rate_applied_guest_from_year').val('');
        $('#properties_room_category_child_rate_applied_guest_from_year_hidden').val('');
        $('#properties_room_category_child_rate_applied_guest_to_year').val('');
        // event.preventDefault();
    });

     $("#properties_room_category_complimentary_guest_between_type").change(function(){
        
        if($(this).val()=="Y"){

            var welcomes = $('#properties_room_category_welcomes_child_all_ages :selected').val();
            if(welcomes == "Y"){


                $('#properties_room_category_complimentary_guest_between_from_year').val('0');
                $('#properties_room_category_complimentary_guest_between_from_year_hidden').val('0');
                $("#properties_room_category_complimentary_guest_between_to_year").prop('disabled',false);
                
            }
            else{

                var restricted = $('#properties_room_category_admission_restricted_guests_under_age').val();
                //alert(restricted);
                $("#properties_room_category_complimentary_guest_between_to_year").prop('disabled',false);
                $('#properties_room_category_complimentary_guest_between_from_year').val(restricted);
                $('#properties_room_category_complimentary_guest_between_from_year_hidden').val(restricted);


            }

            
        }
        else{

            $("#properties_room_category_complimentary_guest_between_to_year").prop('disabled',true);
            $('#properties_room_category_complimentary_guest_between_from_year').val('');
            $('#properties_room_category_complimentary_guest_between_from_year_hidden').val('');
            $('#properties_room_category_complimentary_guest_between_to_year').val('');

            var admission_restricted = $('#properties_room_category_admission_restricted_guests_under_age').val();

            var complimentaryto_year = $('#properties_room_category_child_rate_applied_guest_to_year').val();
             sumcomplimentaryto_year = parseFloat(complimentaryto_year) + 1;
            var child_rate_type = $('#properties_room_category_child_rate_applied_guest_between_type :selected').val();

            if(child_rate_type == 'Y'){

                 
                $('#properties_room_category_adult_rate_applied_guest_over').val(sumcomplimentaryto_year);
                $('#properties_room_category_adult_rate_applied_guest_over_hidden').val(sumcomplimentaryto_year);

            }else{

                $('#properties_room_category_adult_rate_applied_guest_over').val(admission_restricted);
                $('#properties_room_category_adult_rate_applied_guest_over_hidden').val(sumcomplimentaryto_year);
            }
        }
        
        // event.preventDefault();
    });

     $("#properties_room_category_child_rate_applied_guest_between_type").change(function(){
        
        if($(this).val()=="Y"){

            $("#properties_room_category_child_rate_applied_guest_to_year").prop('disabled',false);
            var complimentary_type = $('#properties_room_category_complimentary_guest_between_type :selected').val();
            var complimentaryto_year = $('#properties_room_category_complimentary_guest_between_to_year').val();
            var restricted = $('#properties_room_category_admission_restricted_guests_under_age').val();

            if(complimentary_type == 'Y' && complimentaryto_year != ''){

                var complimentaryto_year = $('#properties_room_category_complimentary_guest_between_to_year').val();
                sumcomplimentaryto_year = parseFloat(complimentaryto_year) + 1;
                
                
                $('#properties_room_category_child_rate_applied_guest_from_year').val(sumcomplimentaryto_year);
                $('#properties_room_category_child_rate_applied_guest_from_year_hidden').val(sumcomplimentaryto_year);
            }
            else{

                $('#properties_room_category_child_rate_applied_guest_from_year').val(restricted);
                $('#properties_room_category_child_rate_applied_guest_from_year_hidden').val(restricted);
            }
            
        }
        else{

            $("#properties_room_category_child_rate_applied_guest_to_year").prop('disabled',true);

            $('#properties_room_category_child_rate_applied_guest_from_year').val('');
            $('#properties_room_category_child_rate_applied_guest_from_year_hidden').val('');
            $('#properties_room_category_child_rate_applied_guest_to_year').val('');

            var admission_restricted = $('#properties_room_category_admission_restricted_guests_under_age').val();
            var complimentary_to_year = $('#properties_room_category_complimentary_guest_between_to_year').val();
            sumcomplimentaryto_year = parseFloat(complimentary_to_year) + 1;
            var complimentary_type = $('#properties_room_category_complimentary_guest_between_type :selected').val();

            if(complimentary_type == 'Y'){

                
                $('#properties_room_category_adult_rate_applied_guest_over').val(sumcomplimentaryto_year);
                $('#properties_room_category_adult_rate_applied_guest_over_hidden').val(sumcomplimentaryto_year);

            }else{

                $('#properties_room_category_adult_rate_applied_guest_over').val(admission_restricted);
                $('#properties_room_category_adult_rate_applied_guest_over_hidden').val(admission_restricted);
            }
        }
        
        // event.preventDefault();
    });

    $(document).on('change input', '#properties_room_category_admission_restricted_guests_under_age', function(e){ 

         var admission_restricted = $('#properties_room_category_admission_restricted_guests_under_age').val();
         var complimentary_type = $('#properties_room_category_complimentary_guest_between_type :selected').val();
         var child_rate_type = $('#properties_room_category_child_rate_applied_guest_between_type :selected').val();

         var complimentary_to_year = $('#properties_room_category_complimentary_guest_between_to_year').val();
            sumcomplimentaryto_year = parseFloat(complimentary_to_year) + 1;

        var child_rate_appliedto_year = $('#properties_room_category_child_rate_applied_guest_to_year').val();
             sumchild_rate_appliedto_year = parseFloat(child_rate_appliedto_year) + 1;    

         if(complimentary_type == 'Y'){

            $('#properties_room_category_complimentary_guest_between_from_year').val(admission_restricted);
            $('#properties_room_category_complimentary_guest_between_from_year_hidden').val(admission_restricted);
            $('#properties_room_category_adult_rate_applied_guest_over').val(admission_restricted);
            $('#properties_room_category_adult_rate_applied_guest_over_hidden').val(admission_restricted);

         }else{
            $('#properties_room_category_complimentary_guest_between_from_year').val('');
            $('#properties_room_category_complimentary_guest_between_from_year_hidden').val('');
            $('#properties_room_category_adult_rate_applied_guest_over').val(admission_restricted);
            $('#properties_room_category_adult_rate_applied_guest_over_hidden').val(admission_restricted);
         }

            
            $('#properties_room_category_complimentary_guest_between_to_year').val('');
            $('#properties_room_category_child_rate_applied_guest_from_year').val('');
            $('#properties_room_category_child_rate_applied_guest_from_year_hidden').val('');
            $('#properties_room_category_child_rate_applied_guest_to_year').val('');
            // if(complimentary_type == 'N' && child_rate_type == 'N'){

            //     $('#properties_room_category_adult_rate_applied_guest_over').val(admission_restricted);

            // }
            // if(complimentary_type == 'Y' && child_rate_type == 'Y'){

            //     $('#properties_room_category_adult_rate_applied_guest_over').val(sumchild_rate_appliedto_year);

            // }
            // if(complimentary_type == 'N' && child_rate_type == 'Y'){

            //     $('#properties_room_category_adult_rate_applied_guest_over').val(sumchild_rate_appliedto_year);

            // }
            // if(complimentary_type == 'Y' && child_rate_type == 'N'){

            //     $('#properties_room_category_adult_rate_applied_guest_over').val(sumcomplimentaryto_year);

            // }
             
    });

    $(document).on('change input', '#properties_room_category_complimentary_guest_between_to_year', function(e){ 

         var complimentaryto_year = $('#properties_room_category_complimentary_guest_between_to_year').val();
             sumcomplimentaryto_year = parseFloat(complimentaryto_year) + 1;
         var child_rate_type = $('#properties_room_category_child_rate_applied_guest_between_type :selected').val();

         var  complimentaryfrom_year = $('#properties_room_category_complimentary_guest_between_from_year_hidden').val();

         
            if(child_rate_type == 'Y'){

               

             $('#properties_room_category_child_rate_applied_guest_from_year').val(sumcomplimentaryto_year);
             $('#properties_room_category_child_rate_applied_guest_from_year_hidden').val(sumcomplimentaryto_year);
             $('#properties_room_category_adult_rate_applied_guest_over').val(sumcomplimentaryto_year);
             $('#properties_room_category_adult_rate_applied_guest_over_hidden').val(sumcomplimentaryto_year);


            }
            else{

                $('#properties_room_category_adult_rate_applied_guest_over').val(sumcomplimentaryto_year);
                $('#properties_room_category_adult_rate_applied_guest_over_hidden').val(sumcomplimentaryto_year);
             }

             complimentaryto_year_ss = parseFloat(complimentaryto_year);
             complimentaryfrom_year_ss = parseFloat(complimentaryfrom_year);
             //alert(complimentaryto_year_ss);
             //alert(complimentaryto_year_ss);

             if(complimentaryto_year_ss < complimentaryfrom_year_ss){

                //alert("dd");
                $('#properties_room_category_complimentary_guest_between_to_year').val('');
                 var data1 = "To year should be greater than from year";
                $("#greater1_alert").html(data1);
                $("#greater1_alert").show();
               }
               else{

                $("#greater1_alert").hide();
               }
    });

    $(document).on('change input', '#properties_room_category_child_rate_applied_guest_to_year', function(e){ 

         var child_rate_appliedto_year = $('#properties_room_category_child_rate_applied_guest_to_year').val();
             sumchild_rate_appliedto_year = parseFloat(child_rate_appliedto_year) + 1;
             $('#properties_room_category_adult_rate_applied_guest_over').val(sumchild_rate_appliedto_year);
             $('#properties_room_category_adult_rate_applied_guest_over_hidden').val(sumchild_rate_appliedto_year);

        var child_rate_appliedfrom_year = $('#properties_room_category_child_rate_applied_guest_from_year').val();

        child_rate_appliedto_year_ss = parseFloat(child_rate_appliedto_year);
        child_rate_appliedfrom_year_ss = parseFloat(child_rate_appliedfrom_year);
        //alert(complimentaryto_year_ss);
        //alert(complimentaryto_year_ss);

        if(child_rate_appliedto_year_ss < child_rate_appliedfrom_year_ss){

            //alert("dd");
            $('#properties_room_category_child_rate_applied_guest_to_year').val('');
             var data1 = "To year should be greater than from year";
            $("#greater2_alert").html(data1);
            $("#greater2_alert").show();
        }
        else{

            $("#greater2_alert").hide();
        }
    });
});
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
////***Filter button hide and show*****///

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

////***searching button*****///

$('#search').click(function () {
        
        $table.ajax.reload();
    });

// $( "#b2b_partner_person_name1" ).keypress(function() {
//             $table.ajax.reload();
// });

////***searching button*****///

////***Latest Jquery form validation for adding form*****///
        
$("#form").validate({

            validClass: "success",
            rules: {
                    
                    // booking_work_order_end_date: { greaterThan: "#booking_work_order_date" }
                
            },
            messages: {
                
            },
            
            highlight: function(element) {
                $(element).closest('.form-group').removeClass('input-success-o').addClass('input-warning-o');
            },
            success: function(element) {
                $(element).closest('.form-group').removeClass('input-warning-o').addClass('input-success-o');
            },

        });

$("#form1").validate({

            validClass: "success",
            rules: {
                    
                    // booking_work_order_end_date: { greaterThan: "#booking_work_order_date" }
                
            },
            messages: {
                
            },
            
            highlight: function(element) {
                $(element).closest('.form-group').removeClass('input-success-o').addClass('input-warning-o');
            },
            success: function(element) {
                $(element).closest('.form-group').removeClass('input-warning-o').addClass('input-success-o');
            },

        });
////***Latest Jquery form validation for adding form*****///

    ////***Listing table*****///

var save_method; //for save method string
var table;
  $(document).ready(function() {
    
    
    $table = $('#Room_registration').DataTable( {
        "processing": true,
        "serverSide": true,
        "searching": false,
        "aLengthMenu": [[10, 25, 50, -1], [10, 25, 50, "All"]],
        "bDestroy" : true,
        dom: 'lBfrtip',
            buttons: [
                
                {
                                    extend: 'excel',
                                    exportOptions: {
                                        columns: [0, 1, 2, 3, 4, 5, 6]
                                    },
                                    title: 'Room details',
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
                                    title: 'Room details',
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
                                    title: 'Room details',
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
            "url": "<?php echo base_url();?>index.php/Rooms/get",
            "type": "POST",
            "data" : function (d) {
                        d.properties_id = $("#properties_id").val();
                        d.room_meal_plan_id = $("#room_meal_plan_id").val();
                        d.properties_room_category_id = $("#properties_room_category_id").val();
                        d.properties_room_category_createdby_user_id = $("#properties_room_category_createdby_user_id").val();
                        
                        
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
            if(data['properties_room_category_photo'] == '')
            {
                $('td',row).eq(1).html('<img style="height: 40px; width: 40px;" src="<?php echo base_url();?>assets/images/user.png" />');
            }
            else{
                $('td',row).eq(1).html('<a class="image-popup" href="<?php echo base_url();?>uploads/Property-room-category-doc/'+data['properties_room_category_photo']+'"><img style="height: 40px; width: 40px;" src="<?php echo base_url();?>uploads/Property-room-category-doc/'+data['properties_room_category_photo']+'" /></a>');
           }
           $('td', row).eq(8).html('<div class="d-flex"><a href="javascript:void(0)" id="rt" onclick="edit_room('+data['properties_room_category_id']+')" class="btn btn-primary shadow btn-xs sharp me-1"><i class="fas fa-pencil-alt"></i></a><a href="javascript:void(0)" onclick="return delete_room('+data['properties_room_category_id']+')" class="btn btn-danger shadow btn-xs sharp"><i class="fa fa-trash"></i></a></div>');

           },

        "columns": [
            { "data": "properties_room_category_status", "orderable": false },
            { "data": "properties_room_category_photo", "orderable": false },
            { "data": "properties_name", "orderable": false },
            { "data": "properties_room_category_name", "orderable": false },
            { "data": "meal_plan_name", "orderable": false },
            { "data": "properties_room_category_inventory", "orderable": false },
            { "data": "properties_room_category_description", "orderable": false },
            { "data": "properties_room_category_createdby_user_name", "orderable": false },
            { "data": "properties_room_category_id", "orderable": false },
            
   
        ]
        
    });
    
  

  });
    
 
////***Listing table*****///


////***For close the modal *****///

function Roommodalclose()
{

    $('#RoomModal').modal('hide');
   
    //$( "div" ).remove( ".modal-backdrop" );
    $('#properties_room_category_name').val('');
    $('#room_meal_plan_id_fk').val('').change();
    $('#properties_room_category_welcomes_child_all_ages').val('Y').change();
    $('#properties_room_category_complimentary_guest_between_type').val('Y').change();
    $('#properties_room_category_child_rate_applied_guest_between_type').val('Y').change();


    $('#category_name_alert').hide();
    $('.submit').removeAttr('disabled');
    $('.form-group').removeClass('input-success-o');
    $('.form-group').removeClass('input-warning-o');
    $('.properties_room_category_name').removeClass('input-success-o');
    $('.properties_room_category_name').removeClass('input-warning-o');

    // $('#btnSave').removeAttr('disabled');
}
////***For close the modal *****///

////***For open the modal *****///
$('#RoomModal').on('shown.bs.modal', function () {
    // $("#state_id_fk").select2('open');
    $('#properties_room_category_name').focus();
    var id = $("#id").val();
    if(id == '')
    {
    $('#room_meal_plan_id_fk').val('').change();
    $('#properties_room_category_welcomes_child_all_ages').val('Y').change();
    $('#properties_room_category_complimentary_guest_between_type').val('Y').change();
    $('#properties_room_category_child_rate_applied_guest_between_type').val('Y').change();
    }
    // $(".submit").attr("disabled", "disabled");
    $('.form-group').removeClass('input-success-o');
    $('.form-group').removeClass('input-warning-o');
    $('.properties_room_category_name').removeClass('input-success-o');
    $('.properties_room_category_name').removeClass('input-warning-o');

    

})
////***For open the modal *****///

////***For open modal of Room category adding form  *****///
    
function add_room()
{ 
    save_method = 'add';
    $("#id1").val('');
    $('#form1')[0].reset(); // reset form on modals
    $('.form-group').removeClass('input-warning-o'); // clear error class
    $('.help-block').empty(); // clear error string
    $('#RoomModal').modal('show'); // show bootstrap modal
    $('.modal-title').text('Add room Details'); // Set Title to Bootstrap modal title
    $('#btnSave').text('save');

    var properties_id_fk = $("#properties_id_fk_hidden").val();
    $(".modal-body #properties_id_fk").val( properties_id_fk );

    var welcomes = $('#properties_room_category_welcomes_child_all_ages :selected').val();
    if(welcomes == "Y"){

        $("#properties_room_category_admission_restricted_guests_under_age").prop('disabled',true);

        $('#properties_room_category_complimentary_guest_between_from_year').val('0');
        $('#properties_room_category_complimentary_guest_between_from_year_hidden').val('0');

        
    }
    else{

        $("#properties_room_category_admission_restricted_guests_under_age").prop('disabled',false);


    }
}

////***For open modal of Room category adding form  *****///

////***For editing Room category details from adding modal form  *****///

function edit_room(id)
{
    save_method = 'update';
    $('#form1')[0].reset(); // reset form on modals
    $('.form-group').removeClass('input-warning-o'); // clear error class
    $('.help-block').empty(); // clear error string
    //$("#product").hide();  

    //Ajax Load data from ajax
    $.ajax({
        url : "<?php echo base_url();?>index.php/Rooms/ajax_edit/" + id,
        type: "GET",
        dataType: "JSON",
        success: function(data)
        {

            $('[name="id1"]').val(data.properties_room_category_id);
            $('[name="properties_id_fk"]').val(data.properties_id_fk).trigger('change.select2');
            $('[name="properties_room_category_name"]').val(data.properties_room_category_name);
            $('[name="room_meal_plan_id_fk"]').val(data.room_meal_plan_id_fk).trigger('change.select2');
            $('[id="properties_room_category_inventory"]').val(data.properties_room_category_inventory);
            $('[id="properties_room_category_number_of_adults_allowed"]').val(data.properties_room_category_number_of_adults_allowed);            
            $('[id="properties_room_category_children_allowed_on_bed_sharing_basis"]').val(data.properties_room_category_children_allowed_on_bed_sharing_basis);
            $('[id="properties_room_category_extra_bed_mattress_allowed_in_room"]').val(data.properties_room_category_extra_bed_mattress_allowed_in_room);
            $('[name="properties_room_category_welcomes_child_all_ages"]').val(data.properties_room_category_welcomes_child_all_ages).trigger('change.select2');
            $('[id="properties_room_category_admission_restricted_guests_under_age"]').val(data.properties_room_category_admission_restricted_guests_under_age);
            $('[name="properties_room_category_complimentary_guest_between_type"]').val(data.properties_room_category_complimentary_guest_between_type).trigger('change.select2');
            $('[name="properties_room_category_complimentary_guest_between_from_year"]').val(data.properties_room_category_complimentary_guest_between_from_year);
            $('[name="properties_room_category_complimentary_guest_between_from_year_hidden"]').val(data.properties_room_category_complimentary_guest_between_from_year);
            $('[name="properties_room_category_complimentary_guest_between_to_year"]').val(data.properties_room_category_complimentary_guest_between_to_year);
            $('[name="properties_room_category_child_rate_applied_guest_between_type"]').val(data.properties_room_category_child_rate_applied_guest_between_type).trigger('change.select2');
            $('[name="properties_room_category_child_rate_applied_guest_from_year"]').val(data.properties_room_category_child_rate_applied_guest_from_year);
            $('[name="properties_room_category_child_rate_applied_guest_from_year_hidden"]').val(data.properties_room_category_child_rate_applied_guest_from_year);
            $('[name="properties_room_category_child_rate_applied_guest_to_year"]').val(data.properties_room_category_child_rate_applied_guest_to_year);
            $('[name="properties_room_category_adult_rate_applied_guest_over"]').val(data.properties_room_category_adult_rate_applied_guest_over);
            $('[name="properties_room_category_adult_rate_applied_guest_over_hidden"]').val(data.properties_room_category_adult_rate_applied_guest_over);
            $('[name="properties_room_category_description"]').val(data.properties_room_category_description);

              
            $('#RoomModal').modal('show'); // show bootstrap modal when complete loaded
            $('.modal-title').text('Edit room Details'); // Set title to Bootstrap modal title
            $('#btnSave1').text('update');

        },
        error: function (jqXHR, textStatus, errorThrown)
        {
            alert('Error get data from ajax');
        }
    });
}

////***For editing Room category details from adding modal form  *****///

////***For reload the datatable  *****///

function reload_table1()
{
    $table.ajax.reload(null,false); //reload datatable ajax 
    var id = $("#id1").val();
    if(id)
    {  

        swal("Room details updated successfully", "", "success")
        // var ff = 0;
        
        // ff = "Room details updated successfully";

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
        
        swal("Room details added successfully", "", "success")

        // var ff = 0;
        
        // ff = "Room details added successfully";

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

///***For save the room category details from adding modal form *****///

function save1()
{
     
    var url;

    if(save_method == 'add') {
        $("#id1").val('');
        $('#btnSave1').text('saving...'); //change button text
        $('#btnSave1').attr('disabled',true); //set button disable

        url = "<?php echo base_url();?>index.php/Rooms/ajax_add/";
    } 
    else {

        $('#btnSave1').text('updating...'); //change button text
        $('#btnSave1').attr('disabled',true); //set button disable

        url = "<?php echo base_url();?>index.php/Rooms/ajax_update/";
    }
    
    var fd = new FormData();
    
    var form = document.getElementById('form1');
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

                $('#RoomModal').modal('hide');
                // $('body').removeClass('modal-open');
                // $('.modal-backdrop').remove();


                reload_table1();
            }
            else
            {
                for (var i = 0; i < data.inputerror.length; i++) 
                {
                    $('[name="'+data.inputerror[i]+'"]').parent().parent().addClass('input-warning-o'); //select parent twice to select div form-group class and add has-error class
                    $('[name="'+data.inputerror[i]+'"]').next().text(data.error_string[i]); //select span help-block class set text error string
                }
            }
            $('#btnSave1').text('save'); //change button text
            $('#btnSave1').attr('disabled',false); //set button enable 
            $('.help-block').val('hide');

        },
        error: function (jqXHR, textStatus, errorThrown)
        {
            alert('Error adding / update data');
            $('#btnSave1').text('save'); //change button text
            $('#btnSave1').attr('disabled',false); //set button enable 

        }
    });
}

///***For save the room category details from adding modal form *****///

////***For reload the datatable for delete *****///

function reload_table_delete1()
{
    $table.ajax.reload(null,false); //reload datatable ajax
    
    swal("Room details deleted successfully", "", "success")
        // var ff = 0;
        
        // ff = "Room details deleted successfully";

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
    
////***For reload the Room datatable for delete *****///

function delete_room(id)
{
     $.ajax({
        url : "<?php echo base_url();?>index.php/Rooms/ajax_edit/" + id,
        type: "GET",
        dataType: "JSON",
        success: function(data)
        {

            $('[name="id2"]').val(data.properties_room_category_id);
            $('[name="properties_room_category_name"]').val(data.properties_room_category_name);
            $('#deleterow1Modal').modal('show'); // show bootstrap modal when complete loaded
            $('.modal-title1').text('Do you want to delete this record?'); // Set title to Bootstrap modal title
            $('#btnSave2').text('delete');
            $('#btnSave2').attr('disabled',false); //set button enable 

        },
        error: function (jqXHR, textStatus, errorThrown)
        {
            alert('Error get data from ajax');
        }
    });
    
    // $('#deleterowModal').modal('show'); // show bootstrap modal
        // ajax delete data to database 
}

function delete_room_action()
{
    $('#btnSave2').text('deleting...'); //change button text
    $('#btnSave2').attr('disabled',true); //set button disable 
    var url;

        url = "<?php echo base_url();?>index.php/Rooms/delete/";
        
    

    // ajax adding data to database
    $.ajax({
        url : url,
        type: "POST",
        data: $('#form2').serialize(),
        dataType: "JSON",
        success: function(data)
        {

            if(data.status) //if success close modal and reload ajax table
            {
                $("#id2").val('');
                $('#deleterow1Modal').modal('hide');
                reload_table_delete1();
                // ('body').removeClass('modal-open');
                //$('.modal-backdrop').remove();
                
            }
            else
            {
                for (var i = 0; i < data.inputerror.length; i++) 
                {
                    $('[name="'+data.inputerror[i]+'"]').parent().parent().addClass('has-error'); //select parent twice to select div form-group class and add has-error class
                    $('[name="'+data.inputerror[i]+'"]').next().text(data.error_string[i]); //select span help-block class set text error string
                }
            }

            $('#btnSave2').text('save'); //change button text
            $('#btnSave2').attr('disabled',false); //set button enable 


        },
        error: function (jqXHR, textStatus, errorThrown)
        {
            alert('Error adding / update data');
            $('#btnSave2').text('save'); //change button text
            $('#btnSave2').attr('disabled',false); //set button enable 

        }
    });
}

////***For delete the Room details from  database *****///

$(document).ready(function(){
// $("select[name='related_type']").onchange(function(){
$("#properties_check_type").change(function() {

if($(this).val()=="T")
{
// alert("oo");
$('#row1').hide();
$('#row2').show();
}
else
{
$('#row1').show();
$('#row2').hide();
}
});  
});


</script>