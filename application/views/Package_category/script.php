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
	
	
    $table = $('#Package_category_table').DataTable( {
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
                                    title: 'Template category details'
                                },
                                {
                                    extend: 'pdf',
                                    exportOptions: {
                                        columns: [0, 1, 2]
                                    },
                                    title: 'Template category details'
                                },
                                {
                                    extend: 'print',
                                    exportOptions: {
                                        columns: [0 ,1, 2]
                                    },
                                    title: 'Template category details'
                                },
                               
			],
        "ajax": {
            "url": "<?php echo base_url();?>index.php/Package_category/get/",
            "type": "POST",
            "data" : function (d) {
						// d.package_category_id = $("#package_category_id").val();
						// d.package_category_createdby_user_id = $("#package_category_createdby_user_id").val();
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

			// $('td', row).eq(4).html('<div class="d-flex"><a href="javascript:void(0)" onclick="edit_category('+data['package_category_id']+')" class="btn btn-primary shadow btn-xs sharp me-1"><i class="fas fa-pencil-alt"></i></a><a href="javascript:void(0)" onclick="return delete_category('+data['package_category_id']+')" class="btn btn-danger shadow btn-xs sharp"><i class="fa fa-trash"></i></a></div>');
			
            let actionHtml = '<div class="d-flex">';

            // Edit button
            if (hasPermission('TEMPLATES_CATEGORY_UPDATE')) {
                actionHtml += '<a href="javascript:void(0)" onclick="edit_category('+data['package_category_id']+')" class="btn btn-primary shadow btn-xs sharp me-1"><i class="fas fa-pencil-alt"></i></a>';
            }

            // Delete button
            if (hasPermission('TEMPLATES_CATEGORY_DELETE')) {
                actionHtml += '<a href="javascript:void(0)" onclick="return delete_category('+data['package_category_id']+')" class="btn btn-danger shadow btn-xs sharp"><i class="fa fa-trash"></i></a>';
            }

            actionHtml += '</div>';

            $('td', row).eq(3).html(actionHtml);
            
           },

           "drawCallback": function( settings ) {
                // displaySelectByUserType();
            },

        "columns": [
            { "data": "package_category_status", "orderable": false },
            { "data": "package_category_name", "orderable": false },
            { "data": "package_category_description", "orderable": false },                    
            { "data": "package_category_id", "orderable": false }
            
            
        ]
        
    });
    
  

  });
    
 
////***Listing table*****///

////***For close the modal *****///
function packagecategorymodalclose()
{

    $('#PackagecategoryModal').modal('hide');
   
	//$( "div" ).remove( ".modal-backdrop" );
    $('#package_category_name').val('');
    $('#package_category_description').val('');
	$('#category_name_alert').hide();
	$('.submit').removeAttr('disabled');
	$('.form-group').removeClass('input-success-o');
	$('.form-group').removeClass('input-warning-o');
	$('.package_category_name').removeClass('input-success-o');
	$('.package_category_name').removeClass('input-warning-o');
    $('.package_category_description').removeClass('input-success-o');
    $('.package_category_description').removeClass('input-warning-o');
	// $('#btnSave').removeAttr('disabled');
}
////***For close the modal *****///

////***For open the modal *****///
$('#PackagecategoryModal').on('shown.bs.modal', function () {
    // $("#state_id_fk").select2('open');
	$('#package_category_name').focus();
    $('#category_name_alert').hide();
	// $(".submit").attr("disabled", "disabled");
	$('.form-group').removeClass('input-success-o');
	$('.form-group').removeClass('input-warning-o');
	$('.property_category_name').removeClass('input-success-o');
	$('.property_category_name').removeClass('input-warning-o');
    $('.package_category_description').removeClass('input-success-o');
    $('.package_category_description').removeClass('input-warning-o');
})
////***For open the modal *****///
	
////***For open modal of Package category adding form  *****///
	
function add_category()
{ 
    save_method = 'add';
    $("#id").val('');
    $('#form')[0].reset(); // reset form on modals
    $('.form-group').removeClass('input-warning-o'); // clear error class
    $('.help-block').empty(); // clear error string
    $('#PackagecategoryModal').modal('show'); // show bootstrap modal
    $('.modal-title').text('Add Template category Details'); // Set Title to Bootstrap modal title
	$('#btnSave').text('save');
}

////***For open modal of stage adding form  *****///

////***For editing Package category details from adding modal form  *****///

function edit_category(id)
{
    save_method = 'update';
    $('#form')[0].reset(); // reset form on modals
    $('.form-group').removeClass('input-warning-o'); // clear error class
    $('.help-block').empty(); // clear error string

    //Ajax Load data from ajax
    $.ajax({
        url : "<?php echo base_url();?>index.php/Package_category/ajax_edit/" + id,
        type: "GET",
        dataType: "JSON",
        success: function(data)
        {

            $('[name="id"]').val(data.package_category_id);
            $('[name="package_category_name"]').val(data.package_category_name);
            $('[name="package_category_description"]').val(data.package_category_description);      
            $('#PackagecategoryModal').modal('show'); // show bootstrap modal when complete loaded
            $('.modal-title').text('Edit TemplateS category Details'); // Set title to Bootstrap modal title
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
		
		ff = "Template category details updated successfully";

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
		
		ff = "Template category details added successfully";

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

        url = "<?php echo base_url();?>index.php/Package_category/ajax_add/";
    } 
	else {

        $('#btnSave').text('updating...'); //change button text
        $('#btnSave').attr('disabled',true); //set button disable

        url = "<?php echo base_url();?>index.php/Package_category/ajax_update/";
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

				$('#PackagecategoryModal').modal('hide');
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

///***For save the Package category details from adding modal form *****///

////***For reload the datatable for delete *****///

function reload_table_delete()
{
    $table.ajax.reload(null,false); //reload datatable ajax
    
    // swal("Package category details deleted successfully", "", "success")
        var ff = 0;
        
        ff = "Package category details deleted successfully";

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

function delete_category(id)
{
     $.ajax({
        url : "<?php echo base_url();?>index.php/Package_category/ajax_edit/" + id,
        type: "GET",
        dataType: "JSON",
        success: function(data)
        {

            $('[name="id"]').val(data.package_category_id);
            $('[name="package_category_name"]').val(data.package_category_name);
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

function delete_category_action()
{
    $('#btnSave1').text('deleting...'); //change button text
    $('#btnSave1').attr('disabled',true); //set button disable 
    var url;

        url = "<?php echo base_url();?>index.php/Package_category/delete/";
        
    

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

////***For delete the Package category details from  database *****///

////***Checking Package category name already existing*****///

$("#package_category_name").on("input", function(e) {

var package_category_name =$("#package_category_name").val();
var id = $ ("#id").val();
//alert(product_id);
if(id){
if(package_category_name){
    $.ajax({
        url:"<?php echo base_url()?>index.php/Package_category/checkEditpackage_category",
        type: 'POST',
        data: {value:package_category_name,id:id},
        dataType: 'json',
        success:
        function(data)
        {
            //alert(data);
            if(data){
                var data1 = "Package category Already Exist";
                $("#category_name_alert").html(data1);
                $("#category_name_alert").show();
                $('#package_category_name').val('');
                $('#package_category_name').focus();
                $('#btnSave').attr("disabled", "disabled");
                $('.package_category_name').removeClass('input-success-o').addClass('input-warning-o');
             }
             else{
                 $('#btnSave').removeAttr('disabled');
                  $("#category_name_alert").hide();
                  $('.package_category_name').removeClass('input-warning-o').addClass('input-success-o');
             }

        },
        error:function(e){
        console.log("error");
        }
        });
    }
 }
 else{
 if(package_category_name){
    $.ajax({
        url:"<?php echo base_url()?>index.php/Package_category/checkpackage_category",
        type: 'POST',
        data: {value:package_category_name},
        dataType: 'json',
        success:
        function(data)
        {
            // alert(state_id);
            if(data){
            // alert(state_id);
                var data1 = "Package category Already Exist";
                $("#category_name_alert").html(data1);
                $("#category_name_alert").show();
                $('#package_category_name').val('');
                $('#package_category_name').focus();
                $('#btnSave').attr("disabled", "disabled");
                $('.package_category_name').removeClass('input-success-o').addClass('input-warning-o');
             }
             else{
                 $('#btnSave').removeAttr('disabled');
                 $("#category_name_alert").hide();
                 $('.package_category_name').removeClass('input-warning-o').addClass('input-success-o');
             }

        },
        error:function(e){
        console.log("error");
        }
        });
}
 
 }
 

});

////***Checking Package category name already existing*****///
</script>