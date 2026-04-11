<script>

////***Filter button hide and show*****///

$(document).ready(function () {
    $("#btn").click(function () {
        $("#Create").toggle();
    });
});


////***Filter button hide and show*****///

////***Latest dropdown select2*****///

$("#transporter_id").select2();
$("#transporter_createdby_user_id").select2();
$("#transporter_base_station_id_fk").select2();
$("#vehicle_id_fk").select2();
$("#vehicle_id_fk1").select2();
$("#transporter_base_station_id_fk1").select2();

////***Latest dropdown select2*****///

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

////***Latest Jquery form validation for adding form*****///

	////***Listing table*****///

var save_method; //for save method string
var table;
  $(document).ready(function() {
	
	
    $table = $('#Transporter_table').DataTable( {
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
            "url": "<?php echo base_url();?>index.php/Transporter/get/",
            "type": "POST",
            "data" : function (d) {
						d.transporter_id = $("#transporter_id").val();
						d.transporter_base_station_id_fk = $("#transporter_base_station_id_fk1").val();
                        d.vehicle_id_fk = $("#vehicle_id_fk1").val();
                        d.transporter_createdby_user_id = $("#transporter_createdby_user_id").val();
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

			$('td', row).eq(6).html('<div class="d-flex"><a href="javascript:void(0)" onclick="edit_transporter('+data['transporter_id']+')" class="btn btn-primary shadow btn-xs sharp me-1"><i class="fas fa-pencil-alt"></i></a><a href="javascript:void(0)" onclick="return delete_transporter('+data['transporter_id']+')" class="btn btn-danger shadow btn-xs sharp"><i class="fa fa-trash"></i></a></div>');
			
            var staff_id_fk = data['transporter_id'];

            $.ajax({
                      url: "<?php echo base_url(); ?>index.php/Transporter/vehicle_array_list/",
                      dataType: 'json',
                      type: 'POST',
                      data:{staff_id_fk: staff_id_fk},
                      success: function(data) {
                        var result = data;
                        console.log(result);
                        var field = [];
                        $.each(result, function (i, item) {
                            // $('#myTable tbody').append('<tr><td>' + item.customer_name + '</td><td>' + item.customer_address + '</td></tr>');
                            //field.push(item.task_assigning_datetime);
                            

                                   field.push('<span class="badge badge-secondary">'+item.vehicle_name+'</span>');
                            

                            
                            //var tt = 'Date : '+item.task_assigning_datetime;
                        });

                        //console.log(field);
                        var str1 = field.toString(); // Gives you "42,55"
                        var str2 = String(field); // Ditto
                        $('td', row).eq(4).html(field);
                    }
                });
            
           },

           "drawCallback": function( settings ) {
                // displaySelectByUserType();
            },

        "columns": [
            { "data": "transporter_status", "orderable": false },
            { "data": "transporter_name", "orderable": false },
            { "data": "transporter_address", "orderable": false },
            { "data": "state_name", "orderable": false },
            { "data": "state_name", "orderable": false },
            { "data": "transporter_createdby_user_name", "orderable": false },                      
            { "data": "transporter_id", "orderable": false }
            
            
        ]
        
    });
    
  

  });
    
 
////***Listing table*****///

////***For close the modal *****///
function Transportermodalclose()
{

    $('#TransporterModal').modal('hide');
   
	//$( "div" ).remove( ".modal-backdrop" );
    $('#transporter_name').val('');
    $('#transporter_address').val('');
    $('#transporter_base_station_id_fk').val('').change();
    $('#vehicle_id_fk').val('0').change();
	$('#category_name_alert').hide();
	$('.submit').removeAttr('disabled');
	$('.form-group').removeClass('input-success-o');
	$('.form-group').removeClass('input-warning-o');
	$('.transporter_name').removeClass('input-success-o');
	$('.transporter_name').removeClass('input-warning-o');
    $('.transporter_address').removeClass('input-success-o');
    $('.transporter_address').removeClass('input-warning-o');
	// $('#btnSave').removeAttr('disabled');
}
////***For close the modal *****///

////***For open the modal *****///
$('#TransporterModal').on('shown.bs.modal', function () {
    // $("#state_id_fk").select2('open');
	$('#transporter_name').focus();
    var id = $("#id").val();
    if(id == '')
    { 
        $('#transporter_base_station_id_fk').val('').change();
        $('#vehicle_id_fk').val('0').change();
    }
    $('#category_name_alert').hide();
	// $(".submit").attr("disabled", "disabled");
	$('.form-group').removeClass('input-success-o');
	$('.form-group').removeClass('input-warning-o');
	$('.transporter_name').removeClass('input-success-o');
	$('.transporter_name').removeClass('input-warning-o');
    $('.transporter_address').removeClass('input-success-o');
    $('.transporter_address').removeClass('input-warning-o');
})
////***For open the modal *****///
	
////***For open modal of transporter adding form  *****///
	
function add_Transporter()
{ 
    save_method = 'add';
    $("#id").val('');
    $('#form')[0].reset(); // reset form on modals
    $('.form-group').removeClass('input-warning-o'); // clear error class
    $('.help-block').empty(); // clear error string
    $('#TransporterModal').modal('show'); // show bootstrap modal
    $('.modal-title').text('Add transporter Details'); // Set Title to Bootstrap modal title
	$('#btnSave').text('save');
}

////***For open modal of transporter adding form  *****///

////***For editing transporter details from adding modal form  *****///

function edit_transporter(id)
{
    save_method = 'update';
    $('#form')[0].reset(); // reset form on modals
    $('.form-group').removeClass('input-warning-o'); // clear error class
    $('.help-block').empty(); // clear error string

    //Ajax Load data from ajax
    $.ajax({
        url : "<?php echo base_url();?>index.php/Transporter/ajax_edit/" + id,
        type: "GET",
        dataType: "JSON",
        success: function(data)
        {
            
            $('[name="id"]').val(data.transporter_id);
            $('[name="transporter_name"]').val(data.transporter_name);
            $('[name="transporter_address"]').val(data.transporter_address);
            $('[id="transporter_base_station_id_fk"]').val(data.transporter_base_station_id_fk).trigger('change.select2');
            $('[id="transporter_contact_person_name1"]').val(data.transporter_contact_person_name1);
            $('[id="transporter_contact_person_email1"]').val(data.transporter_contact_person_email1);  
            $('[name="transporter_contact_person_contact_num1"]').val(data.transporter_contact_person_contact_num1); 
            $('[name="transporter_contact_person_contact_num12"]').val(data.transporter_contact_person_contact_num12);
            $('[name="transporter_contact_person_name2"]').val(data.transporter_contact_person_name2);
            $('[name="transporter_contact_person_email2"]').val(data.transporter_contact_person_email2);
            $('[name="transporter_contact_person_contact_num2"]').val(data.transporter_contact_person_contact_num2);
            $('[name="transporter_contact_person_contact_num22"]').val(data.transporter_contact_person_contact_num22);
            $('[name="transporter_bank_name"]').val(data.transporter_bank_name);
            $('[name="transporter_bank_account_number"]').val(data.transporter_bank_account_number);
            $('[name="transporter_bank_account_name"]').val(data.transporter_bank_account_name);
            $('[name="transporter_bank_account_ifsc_code"]').val(data.transporter_bank_account_ifsc_code);
            $('[name="transporter_bank_account_branch"]').val(data.transporter_bank_account_branch);
            $('[name="transporter_bank_swift_code"]').val(data.transporter_bank_swift_code);     
            $('#TransporterModal').modal('show'); // show bootstrap modal when complete loaded
            $('.modal-title').text('Edit transporter Details'); // Set title to Bootstrap modal title
			$('#btnSave').text('update');

//$("#vehicle_id_fk").val(['1', '2']).prop('selected', true).trigger('change.select2');
            var transporter_id = data.transporter_id;
            $.ajax({
              url: "<?php echo base_url(); ?>index.php/Transporter/fetch_transporter_vehicle/",
              dataType: 'json',
              type: 'POST',
              data:{transporter_id:transporter_id},
              success: function(data) {
                var result = data;
                // console.log(result);
                var field = [];
                var num = 1;
                $.each(result, function (i, item) {


                            field.push(item.vehicle_id);
                    
                    

                    num++;
                   
                });

                
                 var str1 = field.toString();
                 
                //console.log(field); 
                //$("#stg").html(field);
                $("#vehicle_id_fk").val(field).prop('selected', true).trigger('change.select2');
            }

                
             });
        },
        error: function (jqXHR, textStatus, errorThrown)
        {
            alert('Error get data from ajax');
        }
    });
}

////***For editing transporter details from adding modal form  *****///

////***For reload the datatable  *****///

function reload_table()
{
    $table.ajax.reload(null,false); //reload datatable ajax 
	var id = $("#id").val();
	if(id)
	{  

        // swal("Property category details updated successfully", "", "success")
		var ff = 0;
		
		ff = "Transporter details updated successfully";

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
		
		ff = "Transporter details added successfully";

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

///***For save the transporter details from adding modal form *****///

function save()
{
     
    var url;

    if(save_method == 'add') {
        $("#id").val('');
        $('#btnSave').text('saving...'); //change button text
        $('#btnSave').attr('disabled',true); //set button disable

        url = "<?php echo base_url();?>index.php/Transporter/ajax_add/";
    } 
	else {

        $('#btnSave').text('updating...'); //change button text
        $('#btnSave').attr('disabled',true); //set button disable

        url = "<?php echo base_url();?>index.php/Transporter/ajax_update/";
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

				$('#TransporterModal').modal('hide');
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

///***For save the transporter details from adding modal form *****///

////***For reload the datatable for delete *****///

function reload_table_delete()
{
    $table.ajax.reload(null,false); //reload datatable ajax
    
    // swal("Property category details deleted successfully", "", "success")
        var ff = 0;
        
        ff = "Transporter details deleted successfully";

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
    
////***For reload the transporter datatable for delete *****///

function delete_transporter(id)
{
     $.ajax({
        url : "<?php echo base_url();?>index.php/Transporter/ajax_edit/" + id,
        type: "GET",
        dataType: "JSON",
        success: function(data)
        {

            $('[name="id"]').val(data.transporter_id);
            $('[name="transporter_name"]').val(data.transporter_name);
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

function delete_transporter_action()
{
    $('#btnSave1').text('deleting...'); //change button text
    $('#btnSave1').attr('disabled',true); //set button disable 
    var url;

        url = "<?php echo base_url();?>index.php/Transporter/delete/";
        
    

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

////***For delete the transporter details from  database *****///


</script>