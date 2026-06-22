<script>

// $('#user_date_of_joining').bootstrapMaterialDatePicker({
//     weekStart: 0,
//     time: false,
//     format: 'DD/MM/YYYY'
// })

$('#user_date_of_joining').datepicker({
    format: 'dd-mm-yyyy',
    autoclose: true,
    todayHighlight: true
});
////***Filter button hide and show*****///

$(document).ready(function () {
    $("#btn").click(function () {
        $("#Create").toggle();
    });
});


////***Filter button hide and show*****///

////***Latest dropdown select2*****///

$("#user_id_filter").select2();
$("#role_id_filter").select2();
$("#designation_id_filter").select2();
$("#role_id_fk").select2();
$("#designation_id_fk").select2();
$("#languages").select2();

////***Latest dropdown select2*****///

////***searching button*****///

$('#search').click(function () {
        
        $table.ajax.reload();
    });

$( "#user_phone_number_filter" ).keypress(function() {
            $table.ajax.reload();
});

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

////***Latest Jquery form validation for adding form*****///

	////***Listing table*****///

var save_method; //for save method string
var table;
  $(document).ready(function() {
	
	
    $table = $('#StaffTable').DataTable( {
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
            "url": "<?php echo base_url();?>index.php/Staff/get/",
            "type": "POST",
            "data" : function (d) {
						d.user_id_filter = $("#user_id_filter").val();
						d.role_id_filter = $("#role_id_filter").val();
                        d.designation_id_filter = $("#designation_id_filter").val();
                        d.user_phone_number_filter = $("#user_phone_number_filter").val();
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
			
			

			let actionHtml = '<div class="d-flex">';

            // Edit button
            if (hasPermission('STAFF_UPDATE')) {
                actionHtml += '<a href="javascript:void(0)" onclick="edit_staff('+data['user_id']+')" class="btn btn-primary shadow btn-xs sharp me-1"><i class="fas fa-pencil-alt"></i></a>';
            }

            // Delete button
            if (hasPermission('STAFF_DELETE')) {
                actionHtml += '<a href="javascript:void(0)" onclick="return delete_staff('+data['user_id']+')" class="btn btn-danger shadow btn-xs sharp"><i class="fa fa-trash"></i></a>';
            }

            actionHtml += '</div>';

            $('td', row).eq(8).html(actionHtml);

			// $('td', row).eq(10).html('<div class="d-flex"><a href="javascript:void(0)" onclick="edit_staff('+data['user_id']+')" class="btn btn-primary shadow btn-xs sharp me-1"><i class="fas fa-pencil-alt"></i></a><a href="javascript:void(0)" onclick="return delete_staff('+data['user_id']+')" class="btn btn-danger shadow btn-xs sharp"><i class="fa fa-trash"></i></a></div>');
			
           if(data['user_date_of_joining'] == '01-01-1970'){

            $('td', row).eq(5).html('00-00-0000');
           }
            
           },

           "drawCallback": function( settings ) {
                // displaySelectByUserType();
            },

        "columns": [
            { "data": "user_status", "orderable": false },
            { "data": "admin_name", "orderable": false },
            { "data": "user_phone_number", "orderable": false },
            { "data": "roles_name", "orderable": false },   
            { "data": "designation_name", "orderable": false },   
            { "data": "user_date_of_joining", "orderable": false },   
            { "data": "user_name", "orderable": false }, 
            { "data": "password", "orderable": false },                      
            { "data": "user_id", "orderable": false }
            
            
        ]
        
    });
    
  

  });
    
 
////***Listing table*****///

////***For close the modal *****///
function Staffmodalclose()
{

    $('#StaffModal').modal('hide');

	//$( "div" ).remove( ".modal-backdrop" );
    $('#admin_name').val('');
    $('#user_address').val('');
    $('#role_id_fk').val('').change();
    $('#designation_id_fk').val('').change();
    $('#shift_id_fk').val('').change();
    $('#languages').val('').change();
	$('#category_name_alert').hide();
	$('.submit').removeAttr('disabled');
	$('.form-group').removeClass('input-success-o');
	$('.form-group').removeClass('input-warning-o');
	$('.admin_name').removeClass('input-success-o');
	$('.admin_name').removeClass('input-warning-o');
    $('.user_address').removeClass('input-success-o');
    $('.user_address').removeClass('input-warning-o');
	// $('#btnSave').removeAttr('disabled');
}
////***For close the modal *****///

////***For open the modal *****///
$('#StaffModal').on('shown.bs.modal', function () {
    // $("#state_id_fk").select2('open');
	$('#admin_name').focus();
    var id = $("#id").val();
    if(id == '')
    {
        $('#designation_id_fk').val('').change();
        $('#role_id_fk').val('').change();
        $('#shift_id_fk').val('').change();
        $('#languages').val('').change();
    }
    $('#category_name_alert').hide();
	// $(".submit").attr("disabled", "disabled");
	$('.form-group').removeClass('input-success-o');
	$('.form-group').removeClass('input-warning-o');
	$('.admin_name').removeClass('input-success-o');
	$('.admin_name').removeClass('input-warning-o');
    $('.user_address').removeClass('input-success-o');
    $('.user_address').removeClass('input-warning-o');
})
////***For open the modal *****///
	
////***For open modal of staff adding form  *****///
	
function add_Staff()
{ 
    save_method = 'add';
    $("#id").val('');
    $('#form')[0].reset(); // reset form on modals
    $('.form-group').removeClass('input-warning-o'); // clear error class
    $('.help-block').empty(); // clear error string
    $('#StaffModal').modal('show'); // show bootstrap modal
    $('.modal-title').text('Add staff Details'); // Set Title to Bootstrap modal title
	$('#btnSave').text('save');
}

////***For open modal of staff adding form  *****///

////***For editing staff details from adding modal form  *****///

function edit_staff(id)
{
    save_method = 'update';
    $('#form')[0].reset(); // reset form on modals
    $('.form-group').removeClass('input-warning-o'); // clear error class
    $('.help-block').empty(); // clear error string

    //Ajax Load data from ajax
    $.ajax({
        url : "<?php echo base_url();?>index.php/Staff/ajax_edit/" + id,
        type: "GET",
        dataType: "JSON",
        success: function(data)
        {
            
            $('[name="id"]').val(data.user_id);
            $('[name="admin_name"]').val(data.admin_name);
            $('[name="user_address"]').val(data.user_address);
            $('[id="role_id_fk"]').val(data.role_id_fk).trigger('change.select2');
            $('[id="designation_id_fk"]').val(data.designation_id_fk).trigger('change.select2');
            $('[id="shift_id_fk"]').val(data.shift_id_fk).trigger('change.select2');
            $('[id="user_email_address"]').val(data.user_email_address);
            $('[id="user_phone_number"]').val(data.user_phone_number);  
            $('[name="user_lan_number"]').val(data.user_lan_number); 
            $('[name="user_date_of_joining"]').val(data.user_date_of_joining);
            $('[name="user_name"]').val(data.user_name);
            $('[name="password"]').val(data.password);
            $('[name="device_user_id"]').val(data.device_user_id);
            $('[name="user_description"]').val(data.user_description);  

            // Force Stop checkbox
            if (data.meta_force_stop == 'Y') {
                $('#meta_force_stop').prop('checked', true);
            } else {
                $('#meta_force_stop').prop('checked', false);
            }

            // Languages multi-select
            if (data.languages && data.languages.length > 0) {
                $('#languages').val(data.languages).trigger('change');
            } else {
                $('#languages').val('').trigger('change');
            }

            $('#StaffModal').modal('show'); // show bootstrap modal when complete loaded
            $('.modal-title').text('Edit staff Details'); // Set title to Bootstrap modal title
			$('#btnSave').text('update');


        },
        error: function (jqXHR, textStatus, errorThrown)
        {
            alert('Error get data from ajax');
        }
    });
}

////***For editing staff details from adding modal form  *****///

////***For reload the datatable  *****///

function reload_table()
{
    $table.ajax.reload(null,false); //reload datatable ajax 
	var id = $("#id").val();
	if(id)
	{  

        // swal("Property category details updated successfully", "", "success")
		var ff = 0;
		
		ff = "Staff details updated successfully";

		 $("#vehicle_update").val(ff);
		
		 
		 var options = {

		'title': '',

		'style': 'success',

		'message': ff,

		// 'success': 'warning',
		'icon': 'fas fa-check',

		};
		
		var n1 = new notify(options); 

		n1.show(); 

		setTimeout(function(){ n1.hide(); }, 10000);
	}
	else{
		
        // swal("Property category details added successfully", "", "success")

		var ff = 0;
		
		ff = "Staff details added successfully";

		 $("#vehicle_add").val(ff);
		
		 
		 var options = {

		'title': '',

		'style': 'success',

		'message': ff,

		// 'success': 'warning',
		'icon': 'fas fa-check',

		};
		
		var n1 = new notify(options); 

		n1.show(); 

		setTimeout(function(){ n1.hide(); }, 10000);
	}
	
    
}

////***For reload the datatable  *****///

///***For save the staff details from adding modal form *****///

function save()
{
    // clear old file errors
    $('.form-group').removeClass('input-warning-o');
    $('.help-block').text('');
     
    var url;

    if(save_method == 'add') {
        $("#id").val('');
        $('#btnSave').text('saving...'); //change button text
        $('#btnSave').attr('disabled',true); //set button disable

        url = "<?php echo base_url();?>index.php/Staff/ajax_add/";
    } 
	else {

        $('#btnSave').text('updating...'); //change button text
        $('#btnSave').attr('disabled',true); //set button disable

        url = "<?php echo base_url();?>index.php/Staff/ajax_update/";
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

				$('#StaffModal').modal('hide');
                // $('body').removeClass('modal-open');
                // $('.modal-backdrop').remove();


                reload_table();
            }
            else
            {
                // for (var i = 0; i < data.inputerror.length; i++) 
                // {
                //     $('[name="'+data.inputerror[i]+'"]').parent().parent().addClass('input-warning-o'); //select parent twice to select div form-group class and add has-error class
                //     $('[name="'+data.inputerror[i]+'"]').next().text(data.error_string[i]); //select span help-block class set text error string
                // }

                if(data.inputerror){
                    for (var i = 0; i < data.inputerror.length; i++) {
                        $('[name="'+data.inputerror[i]+'"]').closest('.form-group').addClass('input-warning-o');
                        $('[name="'+data.inputerror[i]+'"]').closest('.form-group').find('.help-block').first().text(data.error_string[i]);
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


///***For save the staff details from adding modal form *****///

////***For reload the datatable for delete *****///

function reload_table_delete()
{
    $table.ajax.reload(null,false); //reload datatable ajax
    
    // swal("Property category details deleted successfully", "", "success")
        var ff = 0;
        
        ff = "Staff details deleted successfully";

         $("#roles_delete").val(ff);
        
         
         var options = {

        'title': '',

        'style': 'success',

        'message': ff,

        // 'success': 'warning',
        'icon': 'fas fa-check',

        };
        var n1 = new notify(options); 

        n1.show(); 

        setTimeout(function(){ n1.hide(); }, 10000);
        
}

////***For reload the datatable for delete *****///
    
////***For reload the staff datatable for delete *****///

function delete_staff(id)
{
     $.ajax({
        url : "<?php echo base_url();?>index.php/Staff/ajax_edit/" + id,
        type: "GET",
        dataType: "JSON",
        success: function(data)
        {

            $('[name="id"]').val(data.user_id);
            $('[name="admin_name"]').val(data.admin_name);
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

function delete_staff_action()
{
    $('#btnSave1').text('deleting...'); //change button text
    $('#btnSave1').attr('disabled',true); //set button disable 
    var url;

        url = "<?php echo base_url();?>index.php/Staff/delete/";
        
    

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
                    $('[name="'+data.inputerror[i]+'"]').next().text(data.error_string[i]); //select span help-block class set text error string
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

////***For delete the staff details from  database *****///


</script>