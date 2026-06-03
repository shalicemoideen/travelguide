<script>

////***Filter button hide and show*****///

$(document).ready(function () {
    $("#btn").click(function () {
        $("#Create").toggle();
    });
});


////***Filter button hide and show*****///

////***Latest dropdown select2*****///

$("#b2b_partner_id").select2();
$("#b2b_partner_createdby_user_id").select2();
$("#b2b_partner_country_id_fk").select2();
$("#b2b_partner_location_id_fk").select2();
$("#b2b_partner_country_id_fk1").select2();
$("#b2b_partner_location_id_fk1").select2();
////***Latest dropdown select2*****///

////***Ajax drop down add*****///

$('#b2b_partner_country_id_fk').change(function() {
    // alert("oo");
        var country_id = $('#b2b_partner_country_id_fk').val();
        if(country_id != '') {
            $.ajax({
                url: "<?php echo base_url(); ?>index.php/B2b_partner/fetch_state",
                method: "POST",
                data: {
                    country_id: country_id
                },
                success: function(data) {
                    $('#b2b_partner_location_id_fk').html(data);
                    // $('#city').html('<option value="">Select City</option>');
                }
            });
        } else {
            $('#b2b_partner_location_id_fk').html('<option value="0"> Please Select Location </option>');
            // $('#city').html('<option value="">Select City</option>');
        }
    });

////***Ajax drop down add*****///

////***Ajax drop down listing*****///

$('#b2b_partner_country_id_fk1').change(function() {
    // alert("oo");
        var country_id = $('#b2b_partner_country_id_fk1').val();

        if(country_id != '') {
            $.ajax({
                url: "<?php echo base_url(); ?>index.php/B2b_partner/fetch_state",
                method: "POST",
                data: {
                    country_id: country_id
                },
                success: function(data) {
                    $('#b2b_partner_location_id_fk1').html(data);
                    // $('#city').html('<option value="">Select City</option>');
                }
            });
        } else {
            $('#b2b_partner_location_id_fk').html('<option value="0"> Please Select Location </option>');
            // $('#city').html('<option value="">Select City</option>');
        }
    });

////***Ajax drop down listing*****///

////***searching button*****///

$('#search').click(function () {
        
        $table.ajax.reload();
    });

$( "#b2b_partner_person_name1" ).keypress(function() {
            $table.ajax.reload();
});

$( "#b2b_partner_contact_number1" ).keypress(function() {
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
	
	
    $table = $('#B2B_partner_table').DataTable( {
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
                                        columns: [0, 1, 2, 3, 4, 5, 6, 7, 8, 9]
                                    }
                                },
                                {
                                    extend: 'pdf',
                                    exportOptions: {
                                        columns: [0, 1, 2, 3, 4, 5, 6, 7, 8, 9]
                                    }
                                },
                                {
                                    extend: 'print',
                                    exportOptions: {
                                        columns: [0 ,1, 2, 3, 4, 5, 6, 7, 8, 9]
                                    }
                                },
                               
			],
        "ajax": {
            "url": "<?php echo base_url();?>index.php/B2b_partner/get/",
            "type": "POST",
            "data" : function (d) {
						d.b2b_partner_id = $("#b2b_partner_id").val();
						d.b2b_partner_createdby_user_id = $("#b2b_partner_createdby_user_id").val();
                        d.b2b_partner_country_id_fk = $("#b2b_partner_country_id_fk1").val();
                        d.b2b_partner_location_id_fk = $("#b2b_partner_location_id_fk1").val();
                        d.b2b_partner_person_name = $("#b2b_partner_person_name1").val();
                        d.b2b_partner_contact_number = $("#b2b_partner_contact_number1").val();
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

			// $('td', row).eq(10).html('<div class="d-flex"><a href="javascript:void(0)" onclick="edit_b2bpartner('+data['b2b_partner_id']+')" class="btn btn-primary shadow btn-xs sharp me-1"><i class="fas fa-pencil-alt"></i></a><a href="javascript:void(0)" onclick="return delete_b2bpartner('+data['b2b_partner_id']+')" class="btn btn-danger shadow btn-xs sharp"><i class="fa fa-trash"></i></a></div>');
			
            let actionHtml = '<div class="d-flex">';

            // Edit button
            if (hasPermission('B2B_PARTNER_UPDATE')) {
                actionHtml += '<a href="javascript:void(0)" onclick="edit_b2bpartner('+data['b2b_partner_id']+')" class="btn btn-primary shadow btn-xs sharp me-1"><i class="fas fa-pencil-alt"></i></a>';
            }

            // Delete button
            if (hasPermission('B2B_PARTNER_DELETE')) {
                actionHtml += '<a href="javascript:void(0)" onclick="return delete_b2bpartner('+data['b2b_partner_id']+')" class="btn btn-danger shadow btn-xs sharp"><i class="fa fa-trash"></i></a>';
            }

            actionHtml += '</div>';

            $('td', row).eq(10).html(actionHtml);

           },

           "drawCallback": function( settings ) {
                // displaySelectByUserType();
            },

        "columns": [
            { "data": "b2b_partner_status", "orderable": false },
            { "data": "b2b_partner_agent_name", "orderable": false },
            { "data": "b2b_partner_address", "orderable": false },
            { "data": "name", "orderable": false },
            { "data": "state_name", "orderable": false },
            { "data": "b2b_partner_person_name", "orderable": false },
            { "data": "b2b_partner_contact_number", "orderable": false },
            { "data": "b2b_partner_email_address", "orderable": false },
            { "data": "b2b_partner_description", "orderable": false },
            { "data": "b2b_partner_createdby_user_name", "orderable": false },                      
            { "data": "b2b_partner_id", "orderable": false }
            
            
        ]
        
    });
    
  

  });
    
 
////***Listing table*****///

////***For close the modal *****///
function b2bpartnermodalclose()
{

    $('#B2BpartnerModal').modal('hide');
   
	//$( "div" ).remove( ".modal-backdrop" );
    $('#b2b_partner_agent_name').val('');
    $('#b2b_partner_address').val('');
	$('#category_name_alert').hide();
	$('.submit').removeAttr('disabled');
	$('.form-group').removeClass('input-success-o');
	$('.form-group').removeClass('input-warning-o');
	$('.b2b_partner_agent_name').removeClass('input-success-o');
	$('.b2b_partner_agent_name').removeClass('input-warning-o');
    $('.b2b_partner_address').removeClass('input-success-o');
    $('.b2b_partner_address').removeClass('input-warning-o');
	// $('#btnSave').removeAttr('disabled');
}
////***For close the modal *****///

////***For open the modal *****///
$('#B2BpartnerModal').on('shown.bs.modal', function () {
    // $("#state_id_fk").select2('open');
	$('#b2b_partner_agent_name').focus();
    $('#category_name_alert').hide();
	// $(".submit").attr("disabled", "disabled");
	$('.form-group').removeClass('input-success-o');
	$('.form-group').removeClass('input-warning-o');
	$('.b2b_partner_agent_name').removeClass('input-success-o');
	$('.b2b_partner_agent_name').removeClass('input-warning-o');
    $('.b2b_partner_address').removeClass('input-success-o');
    $('.b2b_partner_address').removeClass('input-warning-o');
})
////***For open the modal *****///
	
////***For open modal of B2B partner adding form  *****///
	
function add_b2bpartner()
{ 
    save_method = 'add';
    $("#id").val('');
    $('#form')[0].reset(); // reset form on modals
    $('.form-group').removeClass('input-warning-o'); // clear error class
    $('.help-block').empty(); // clear error string
    $('#B2BpartnerModal').modal('show'); // show bootstrap modal
    $('.modal-title').text('Add B2B partner Details'); // Set Title to Bootstrap modal title
	$('#btnSave').text('save');
}

////***For open modal of B2B partner adding form  *****///

////***For editing B2B partner details from adding modal form  *****///

function edit_b2bpartner(id)
{
    save_method = 'update';
    $('#form')[0].reset(); // reset form on modals
    $('.form-group').removeClass('input-warning-o'); // clear error class
    $('.help-block').empty(); // clear error string

    //Ajax Load data from ajax
    $.ajax({
        url : "<?php echo base_url();?>index.php/B2b_partner/ajax_edit/" + id,
        type: "GET",
        dataType: "JSON",
        success: function(data)
        {
            country_id=data.b2b_partner_country_id_fk;state_id=data.b2b_partner_location_id_fk;
            $('[name="id"]').val(data.b2b_partner_id);
            $('[name="b2b_partner_agent_name"]').val(data.b2b_partner_agent_name);
            $('[name="b2b_partner_address"]').val(data.b2b_partner_address);
            $('[id="b2b_partner_country_id_fk"]').val(data.b2b_partner_country_id_fk).trigger('change.select2');;
            $('[id="b2b_partner_location_id_fk"]').val(data.b2b_partner_location_id_fk);
            $('[id="b2b_partner_person_name"]').val(data.b2b_partner_person_name);
            $('[id="b2b_partner_contact_number"]').val(data.b2b_partner_contact_number);  
            $('[name="b2b_partner_email_address"]').val(data.b2b_partner_email_address); 
            $('[name="b2b_partner_description"]').val(data.b2b_partner_description);     
            $('#B2BpartnerModal').modal('show'); // show bootstrap modal when complete loaded
            $('.modal-title').text('Edit B2B partner Details'); // Set title to Bootstrap modal title
			$('#btnSave').text('update');

            $.ajax({
                url: "<?php echo base_url(); ?>index.php/B2b_partner/fetch_state",
                method: "POST",
                data: {
                    country_id: country_id,state_id:state_id
                },
                success: function(data) {
                    $('#b2b_partner_location_id_fk').html(data);
                    // $('#city').html('<option value="">Select City</option>');
                }
            });
        },
        error: function (jqXHR, textStatus, errorThrown)
        {
            alert('Error get data from ajax');
        }
    });
}

////***For editing B2B partner details from adding modal form  *****///

////***For reload the datatable  *****///

function reload_table()
{
    $table.ajax.reload(null,false); //reload datatable ajax 
	var id = $("#id").val();
	if(id)
	{  

        // swal("Property category details updated successfully", "", "success")
		var ff = 0;
		
		ff = "B2B partner details updated successfully";

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
		
		ff = "B2B partner details added successfully";

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

///***For save the B2B partner details from adding modal form *****///

function save()
{
     
    var url;

    if(save_method == 'add') {
        $("#id").val('');
        $('#btnSave').text('saving...'); //change button text
        $('#btnSave').attr('disabled',true); //set button disable

        url = "<?php echo base_url();?>index.php/B2b_partner/ajax_add/";
    } 
	else {

        $('#btnSave').text('updating...'); //change button text
        $('#btnSave').attr('disabled',true); //set button disable

        url = "<?php echo base_url();?>index.php/B2b_partner/ajax_update/";
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

				$('#B2BpartnerModal').modal('hide');
                // $('body').removeClass('modal-open');
                // $('.modal-backdrop').remove();


                reload_table();
            }
            else
            {
                for (var i = 0; i < data.inputerror.length; i++) 
                {
                    $('[name="'+data.inputerror[i]+'"]').parent().parent().addClass('input-warning-o'); //select parent twice to select div form-group class and add has-error class
                    $('[name="'+data.inputerror[i]+'"]').next().text(data.error_string[i]); //select span help-block class set text error string
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

///***For save the B2B partner details from adding modal form *****///

////***For reload the datatable for delete *****///

function reload_table_delete()
{
    $table.ajax.reload(null,false); //reload datatable ajax
    
    // swal("Property category details deleted successfully", "", "success")
        var ff = 0;
        
        ff = "B2B partner details deleted successfully";

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
    
////***For reload the B2B partner datatable for delete *****///

function delete_b2bpartner(id)
{
     $.ajax({
        url : "<?php echo base_url();?>index.php/B2b_partner/ajax_edit/" + id,
        type: "GET",
        dataType: "JSON",
        success: function(data)
        {

            $('[name="id"]').val(data.b2b_partner_id);
            $('[name="b2b_partner_agent_name"]').val(data.b2b_partner_agent_name);
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

function delete_b2bpartner_action()
{
    $('#btnSave1').text('deleting...'); //change button text
    $('#btnSave1').attr('disabled',true); //set button disable 
    var url;

        url = "<?php echo base_url();?>index.php/B2b_partner/delete/";
        
    

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
            alert('Error adding / update data');
            $('#btnSave1').text('save'); //change button text
            $('#btnSave1').attr('disabled',false); //set button enable 

        }
    });
}

////***For delete the B2B partner details from  database *****///


</script>