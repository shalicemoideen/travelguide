<script>

// Module select all
$(document).on('change', '.module-select-all', function () {

    let card = $(this).closest('.permission-card');

    card.find('.permission-checkbox')
        .prop('checked', $(this).is(':checked'));

});


// Auto update module select all checkbox
$(document).on('change', '.permission-checkbox', function () {

    let card = $(this).closest('.permission-card');

    let total = card.find('.permission-checkbox').length;
    let checked = card.find('.permission-checkbox:checked').length;

    card.find('.module-select-all')
        .prop('checked', total === checked);

});

// Select / Unselect all permissions
$(document).on('change', '#select_all_permissions', function () {

    $('.permission-checkbox').prop('checked', $(this).is(':checked'));

});

// Auto update select all checkbox
$(document).on('change', '.permission-checkbox', function () {

    let total = $('.permission-checkbox').length;
    let checked = $('.permission-checkbox:checked').length;

    $('#select_all_permissions').prop('checked', total === checked);

});

////***Filter button hide and show*****///

$(document).ready(function () {
    $("#btn").click(function () {
        $("#Create").toggle();
    });
});


////***Filter button hide and show*****///

$("#state_id_filter").select2();
$("#state_created_user_id").select2();

////***searching button*****///

$('#search').click(function () {
        
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
	
	
    $table = $('#Role_table').DataTable( {
        "processing": true,
        "serverSide": true,
		"searching": true,
		"aLengthMenu": [[10, 25, 50, -1], [10, 25, 50, "All"]],
        // "bDestroy" : true,
        dom: 'lBfrtip',
			buttons: [
				
                                {
                                    extend: 'excel',
                                    exportOptions: {
                                        columns: [0, 1, 2]
                                    },
                                    title: 'Role details'
                                },
                                {
                                    extend: 'pdf',
                                    exportOptions: {
                                        columns: [0, 1, 2]
                                    },
                                    title: 'Role details'
                                },
                                {
                                    extend: 'print',
                                    exportOptions: {
                                        columns: [0 ,1, 2]
                                    },
                                    title: 'Role details'
                                },
                               
			],
        "ajax": {
            "url": "<?php echo base_url();?>index.php/Role/get/",
            "type": "POST",
            "data" : function (d) {
						// d.permission_status = $("#permission_status_search").val();
						// d.state_created_user_id = $("#state_created_user_id").val();
           }			
        },
		
        "createdRow": function ( row, data, index ) {
          

            let actionHtml = '<div class="d-flex">';

            // Edit button
            if (hasPermission('ROLE_UPDATE')) {
                actionHtml += '<a href="javascript:void(0)" onclick="edit_role('+data['id']+')" class="btn btn-primary shadow btn-xs sharp me-1"><i class="fas fa-pencil-alt"></i></a>';
            }

            // Delete button
            if (hasPermission('ROLE_DELETE')) {
                actionHtml += '<a href="javascript:void(0)" onclick="return delete_role('+data['id']+')" class="btn btn-danger shadow btn-xs sharp"><i class="fa fa-trash"></i></a>';
            }

            actionHtml += '</div>';

            $('td', row).eq(3).html(actionHtml);

			// $('td', row).eq(3).html('<div class="d-flex"><a href="javascript:void(0)" onclick="edit_role('+data['id']+')" class="btn btn-primary shadow btn-xs sharp me-1"><i class="fas fa-pencil-alt"></i></a><a href="javascript:void(0)" onclick="return delete_role('+data['id']+')" class="btn btn-danger shadow btn-xs sharp"><i class="fa fa-trash"></i></a></div>');
			
            
           },

           "drawCallback": function( settings ) {
                // displaySelectByUserType();
            },

        "columns": [
            { 
                "data": null,
                "orderable": false,
                "render": function (data, type, row, meta) {
                    return meta.row + meta.settings._iDisplayStart + 1;
                }
            },
            { "data": "name", "orderable": false },
            { "data": "description", "orderable": false },
            { "data": "id", "orderable": false }
            
            
        ]
        
    });
    
  

  });
    
 
////***Listing table*****///

////***For close the modal *****///
function Rolemodalclose()
{

    $('#RoleModal').modal('hide');
   
	//$( "div" ).remove( ".modal-backdrop" );
    $('#role_name').val('');
    $('#role_description').val('');
	$('#category_name_alert').hide();
	$('.submit').removeAttr('disabled');
	$('.form-group').removeClass('input-success-o');
	$('.form-group').removeClass('input-warning-o');
	$('.state_name').removeClass('input-success-o');
	$('.state_name').removeClass('input-warning-o');
    $('.state_description').removeClass('input-success-o');
    $('.state_description').removeClass('input-warning-o');
	// $('#btnSave').removeAttr('disabled');
}
////***For close the modal *****///

////***For open the modal *****///
$('#PackagecategoryModal').on('shown.bs.modal', function () {
    
	$('#role_name').focus();
    $('#category_name_alert').hide();
	// $(".submit").attr("disabled", "disabled");
	$('.form-group').removeClass('input-success-o');
	$('.form-group').removeClass('input-warning-o');
	$('.state_name').removeClass('input-success-o');
	$('.state_name').removeClass('input-warning-o');
    $('.state_description').removeClass('input-success-o');
    $('.state_description').removeClass('input-warning-o');
})
////***For open the modal *****///
	
////***For open modal of Package category adding form  *****///
	
function add_role()
{ 
    save_method = 'add';
    $("#id").val('');
    $('#form')[0].reset(); // reset form on modals
    $('.form-group').removeClass('input-warning-o'); // clear error class
    $('.help-block').empty(); // clear error string
    $('#permissions_group span.text-danger').empty();
    $('#RoleModal').modal('show'); // show bootstrap modal
    $('.modal-title').text('Add Role Details'); // Set Title to Bootstrap modal title
	$('#btnSave').text('save');
}

////***For open modal of stage adding form  *****///

////***For editing Package category details from adding modal form  *****///

function edit_role(id)
{
    save_method = 'update';
    $('#form')[0].reset(); // reset form on modals
    $('.form-group').removeClass('input-warning-o'); // clear error class
    $('.help-block').empty(); // clear error string
    $('#permissions_group span.text-danger').empty();

    //Ajax Load data from ajax
    $.ajax({
        url : "<?php echo base_url();?>index.php/Role/ajax_edit/" + id,
        type: "GET",
        dataType: "JSON",
        success: function(data)
        {
            
            $('[name="id"]').val(data.role.id);
            $('[name="role_name"]').val(data.role.name);
            $('[name="role_description"]').val(data.role.description);

            let permissionIds = data.permissions.map(function(item) {
                return item.permission_id; // keep as string (matches checkbox value)
            });

            
            // Uncheck all first
            $('input[name="permissions_name[]"]').prop('checked', false);

            // Loop and check
            permissionIds.forEach(function(id) {
                $('input[name="permissions_name[]"][value="' + id + '"]')
                    .prop('checked', true);
            });
                
            $('#RoleModal').modal('show'); // show bootstrap modal when complete loaded
            $('.modal-title').text('Edit Role Details'); // Set title to Bootstrap modal title
			$('#btnSave').text('update');
        },
        error: function (jqXHR, textStatus, errorThrown)
        {
            alert('Error get data from ajax');
        }
    });
}

////***For editing Package category details from adding modal form  *****///

////***For reload the datatable  *****///

function reload_table()
{
    $table.ajax.reload(null,false); //reload datatable ajax 
	var id = $("#id").val();
	if(id)
	{  

        // swal("Package category details updated successfully", "", "success")
		var ff = 0;
		
		ff = "Role details updated successfully";

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
		
        // swal("Package category details added successfully", "", "success")

		var ff = 0;
		
		ff = "Role details added successfully";

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

///***For save the Package category details from adding modal form *****///

function save()
{
     
    var url;

    if(save_method == 'add') {
        $("#id").val('');
        $('#btnSave').text('saving...'); //change button text
        $('#btnSave').attr('disabled',true); //set button disable

        url = "<?php echo base_url();?>index.php/Role/ajax_add/";
    } 
	else {

        $('#btnSave').text('updating...'); //change button text
        $('#btnSave').attr('disabled',true); //set button disable

        url = "<?php echo base_url();?>index.php/Role/ajax_update/";
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

				$('#RoleModal').modal('hide');
                // $('body').removeClass('modal-open');
                // $('.modal-backdrop').remove();


                reload_table();
            }
            else
            {
                for (var i = 0; i < data.inputerror.length; i++) 
                {
                    if (data.inputerror[i] == 'permissions[]') {
        
                        // highlight full group
                        $('#permissions_group').addClass('input-warning-o');

                        // show error
                        $('#permissions_group span.text-danger').text(data.error_string[i]);

                    } 
                    else{
                        $('[name="'+data.inputerror[i]+'"]').parent().parent().addClass('input-warning-o'); //select parent twice to select div form-group class and add has-error class
                        $('[name="'+data.inputerror[i]+'"]').next().text(data.error_string[i]); //select span help-block class set text error string
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

///***For save the Package category details from adding modal form *****///

////***For reload the datatable for delete *****///

function reload_table_delete()
{
    $table.ajax.reload(null,false); //reload datatable ajax
    
    // swal("Package category details deleted successfully", "", "success")
        var ff = 0;
        
        ff = "Role details deleted successfully";

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
    
////***For reload the Property category datatable for delete *****///

function delete_role(id)
{
     $.ajax({
        url : "<?php echo base_url();?>index.php/Role/ajax_edit/" + id,
        type: "GET",
        dataType: "JSON",
        success: function(data)
        {
            console.log(data);
            $('[name="role_id_delete"]').val(data.role.id);
            $('[name="role_name_delete_hidden"]').val(data.role.name);
            $('[name="role_name_delete"]').html(data.role.name);
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
    
    
}

function delete_permission_action()
{
    $('#btnSave1').text('deleting...'); //change button text
    $('#btnSave1').attr('disabled',true); //set button disable 
    var url;

        url = "<?php echo base_url();?>index.php/Role/delete/";
        
    

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
                $("#role_id_delete").val('');                
                $('#deleterowModal').modal('hide');
                reload_table_delete();
                ('body').removeClass('modal-open');
                $('.modal-backdrop').remove();
                
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
            alert('Error deleting data');
            $('#btnSave1').text('save'); //change button text
            $('#btnSave1').attr('disabled',false); //set button enable 

        }
    });
}

////***For delete the Package category details from  database *****///


</script>