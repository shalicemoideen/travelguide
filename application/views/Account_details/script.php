<script>

////***Filter button hide and show*****///

$(document).ready(function () {
    $("#btn").click(function () {
        $("#Create").toggle();
    });
});


////***Filter button hide and show*****///

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
	
	
    $table = $('#Account_details_table').DataTable( {
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
                                        columns: [0, 1, 2, 3, 4, 5, 6, 7]
                                    },
                                    title: 'Account details'
                                },
                                {
                                    extend: 'pdf',
                                    exportOptions: {
                                        columns: [0, 1, 2, 3, 4, 5, 6, 7]
                                    },
                                    title: 'Account details'
                                },
                                {
                                    extend: 'print',
                                    exportOptions: {
                                        columns: [0, 1, 2, 3, 4, 5, 6, 7]
                                    },
                                    title: 'Account details'
                                },
                               
			],
        "ajax": {
            "url": "<?php echo base_url();?>index.php/Account_details/get/",
            "type": "POST",
            "data" : function (d) {
						// d.account_name_filter = $("#account_name_filter").val();
           }			
        },
        "createdRow": function ( row, data, index ) {
          
//            $('td',row).eq(0).html(index+1);
           $table.column(0).nodes().each(function(node,index,dt){
            $table.cell(node).data(index+1);
            });
			
            let actionHtml = '<div class="d-flex">';

            // Edit button
            if (hasPermission('ACCOUNT_DETAILS_UPDATE')) {
                actionHtml += '<a href="javascript:void(0)" onclick="edit_account_details('+data['account_details_id']+')" class="btn btn-primary shadow btn-xs sharp me-1"><i class="fas fa-pencil-alt"></i></a>';
            }

            // Delete button
            if (hasPermission('ACCOUNT_DETAILS_DELETE')) {
                actionHtml += '<a href="javascript:void(0)" onclick="return delete_account_details('+data['account_details_id']+')" class="btn btn-danger shadow btn-xs sharp"><i class="fa fa-trash"></i></a>';
            }

            actionHtml += '</div>';

            $('td', row).eq(8).html(actionHtml);

            // QR code image
            if (data['qr_code'] && data['qr_code'] != '') {
                $('td', row).eq(6).html('<a target="_blank" href="<?php echo base_url();?>uploads/qr-code/' + data['qr_code'] + '"><img src="<?php echo base_url();?>uploads/qr-code/' + data['qr_code'] + '" style="height:40px;width:40px;"></a>');
            } else {
                $('td', row).eq(6).html('');
            }

            // Bank logo image
            if (data['bank_logo'] && data['bank_logo'] != '') {
                $('td', row).eq(7).html('<a target="_blank" href="<?php echo base_url();?>uploads/bank_logo/' + data['bank_logo'] + '"><img src="<?php echo base_url();?>uploads/bank_logo/' + data['bank_logo'] + '" style="height:40px;width:40px;"></a>');
            } else {
                $('td', row).eq(7).html('');
            }
           
           },

           "drawCallback": function( settings ) {
                // displaySelectByUserType();
            },

        "columns": [
            { "data": "account_details_status", "orderable": false },
            { "data": "account_name", "orderable": false },
            { "data": "account_number", "orderable": false },
            { "data": "ifsc_code", "orderable": false },
            { "data": "branch_name", "orderable": false },
            { "data": "up_id", "orderable": false },
            { "data": "qr_code", "orderable": false },
            { "data": "bank_logo", "orderable": false },
            { "data": "account_details_id", "orderable": false }
            
            
        ]
        
    });
    
  

  });
    
 
////***Listing table*****///

////***For close the modal *****///
function AccountDetailsModalClose()
{

    $('#AccountDetailsModal').modal('hide');
   
    $('#form')[0].reset();
    $('#qr_code_preview').html('');
    $('#bank_logo_preview').html('');
    $('#qr_code_old').val('');
    $('#bank_logo_old').val('');
    $('#up_id').val('');
	$('.submit').removeAttr('disabled');
	$('.form-group').removeClass('input-success-o');
	$('.form-group').removeClass('input-warning-o');
	$('.account_name').removeClass('input-success-o');
	$('.account_name').removeClass('input-warning-o');
	$('.account_number').removeClass('input-success-o');
	$('.account_number').removeClass('input-warning-o');
}
////***For close the modal *****///

////***For open the modal *****///
$('#AccountDetailsModal').on('shown.bs.modal', function () {
    $('#account_name').focus();
	$('.form-group').removeClass('input-success-o');
	$('.form-group').removeClass('input-warning-o');
	$('.account_name').removeClass('input-success-o');
	$('.account_name').removeClass('input-warning-o');
	$('.account_number').removeClass('input-success-o');
	$('.account_number').removeClass('input-warning-o');
})
////***For open the modal *****///
	
////***For open modal of adding form  *****///	
	
function add_account_details()
{ 
    save_method = 'add';
    $("#id").val('');
    $('#form')[0].reset(); // reset form on modals
    $('.form-group').removeClass('input-warning-o'); // clear error class
    $('.help-block').empty(); // clear error string
    $('#qr_code_preview').html('');
    $('#bank_logo_preview').html('');
    $('#qr_code_old').val('');
    $('#bank_logo_old').val('');
    $('#up_id').val('');
    $('#AccountDetailsModal').modal('show'); // show bootstrap modal
    $('.modal-title').text('Add Account Details'); // Set Title to Bootstrap modal title
	$('#btnSave').text('save');
}

////***For open modal of stage adding form  *****///

////***For editing account details from adding modal form  *****///

function edit_account_details(id)
{
    save_method = 'update';
    $('#form')[0].reset(); // reset form on modals
    $('.form-group').removeClass('input-warning-o'); // clear error class
    $('.help-block').empty(); // clear error string

    //Ajax Load data from ajax
    $.ajax({
        url : "<?php echo base_url();?>index.php/Account_details/ajax_edit/" + id,
        type: "GET",
        dataType: "JSON",
        success: function(data)
        {

            $('[name="id"]').val(data.account_details_id);
            $('[name="account_name"]').val(data.account_name);
            $('[name="account_number"]').val(data.account_number);
            $('[name="ifsc_code"]').val(data.ifsc_code);
            $('[name="branch_name"]').val(data.branch_name);
            $('[name="up_id"]').val(data.up_id ? data.up_id : '');
            $('[name="qr_code_old"]').val(data.qr_code ? data.qr_code : '');
            $('[name="bank_logo_old"]').val(data.bank_logo ? data.bank_logo : '');

            if (data.qr_code && data.qr_code != '') {
                $('#qr_code_preview').html('<a target="_blank" href="<?php echo base_url();?>uploads/qr-code/' + data.qr_code + '"><img src="<?php echo base_url();?>uploads/qr-code/' + data.qr_code + '" style="height:60px;width:60px;"></a>');
            }
            if (data.bank_logo && data.bank_logo != '') {
                $('#bank_logo_preview').html('<a target="_blank" href="<?php echo base_url();?>uploads/bank_logo/' + data.bank_logo + '"><img src="<?php echo base_url();?>uploads/bank_logo/' + data.bank_logo + '" style="height:60px;width:60px;"></a>');
            }

            $('#AccountDetailsModal').modal('show'); // show bootstrap modal when complete loaded
            $('.modal-title').text('Edit Account Details'); // Set title to Bootstrap modal title
			$('#btnSave').text('update');
        },
        error: function (jqXHR, textStatus, errorThrown)
        {
            alert('Error get data from ajax');
        }
    });
}

////***For editing account details from adding modal form  *****///

////***For reload the datatable  *****///

function reload_table()
{
    $table.ajax.reload(null,false); //reload datatable ajax 
	var id = $("#id").val();
	if(id)
	{  
		var ff = 0;
		
		ff = "Account details updated successfully";

		 $("#vehicle_update").val(ff);
		 
		 
		 var options = {

		'title': '',

		'style': 'success',

		'message': ff,

		'icon': 'fas fa-check',

		};
		
		var n1 = new notify(options); 

		n1.show(); 

		setTimeout(function(){ n1.hide(); }, 10000);
	}
	else{
		
		var ff = 0;
		
		ff = "Account details added successfully";

		 $("#vehicle_add").val(ff);
		 
		 
		 var options = {

		'title': '',

		'style': 'success',

		'message': ff,

		'icon': 'fas fa-check',

		};
		
		var n1 = new notify(options); 

		n1.show(); 

		setTimeout(function(){ n1.hide(); }, 10000);
	}
	
    
}

////***For reload the datatable  *****///

///***For save the account details from adding modal form *****///

function save()
{
     
    var url;

    if(save_method == 'add') {
        $("#id").val('');
        $('#btnSave').text('saving...'); //change button text
        $('#btnSave').attr('disabled',true); //set button disable

        url = "<?php echo base_url();?>index.php/Account_details/ajax_add/";
    } 
	else {

        $('#btnSave').text('updating...'); //change button text
        $('#btnSave').attr('disabled',true); //set button disable

        url = "<?php echo base_url();?>index.php/Account_details/ajax_update/";
    }
    
	var form = document.getElementById('form');
    var data = new FormData(form);
    // ajax adding data to database
    $.ajax({
        url : url,
        type: "POST",
        data: data,
        dataType: "JSON",
        processData: false,
        enctype: 'multipart/form-data',
        contentType: false,
        success: function(data)
        {

            if(data.status) //if success close modal and reload ajax table
            {

				$('#AccountDetailsModal').modal('hide');

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

///***For save the account details from adding modal form *****///

////***For reload the datatable for delete *****///

function reload_table_delete()
{
    $table.ajax.reload(null,false); //reload datatable ajax
    
        var ff = 0;
        
        ff = "Account details deleted successfully";

         $("#roles_delete").val(ff);
        
         
         var options = {

        'title': '',

        'style': 'success',

        'message': ff,

        'icon': 'fas fa-check',

        };
        var n1 = new notify(options); 

        n1.show(); 

        setTimeout(function(){ n1.hide(); }, 10000);
        
}

////***For reload the datatable for delete *****///
    
////***For reload the category datatable for delete *****///

function delete_account_details(id)
{
     $.ajax({
        url : "<?php echo base_url();?>index.php/Account_details/ajax_edit/" + id,
        type: "GET",
        dataType: "JSON",
        success: function(data)
        {

            $('[name="id"]').val(data.account_details_id);
            $('[name="account_name"]').val(data.account_name);
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

function delete_account_details_action()
{
    $('#btnSave1').text('deleting...'); //change button text
    $('#btnSave1').attr('disabled',true); //set button disable 
    var url;

        url = "<?php echo base_url();?>index.php/Account_details/delete/";
        
    

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

////***For delete the account details from  database *****///


</script>
