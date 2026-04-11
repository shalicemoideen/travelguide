<script>

////***Filter button hide and show*****///

$(document).ready(function () {
    $("#btn").click(function () {
        $("#Create").toggle();
    });
});


////***Filter button hide and show*****///

$("#special_requirements_id").select2();
$("#special_requirements_createdby_user_id").select2();

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
	
	
    $table = $('#Special_requirments_table').DataTable( {
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
                                        columns: [0, 1, 2, 3, 4]
                                    }
                                },
                                {
                                    extend: 'pdf',
                                    exportOptions: {
                                        columns: [0, 1, 2, 3, 4]
                                    }
                                },
                                {
                                    extend: 'print',
                                    exportOptions: {
                                        columns: [0 ,1, 2, 3, 4]
                                    }
                                },
                               
			],
        "ajax": {
            "url": "<?php echo base_url();?>index.php/Special_requirments/get/",
            "type": "POST",
            "data" : function (d) {
						d.special_requirements_id = $("#special_requirements_id").val();
						d.special_requirements_createdby_user_id = $("#special_requirements_createdby_user_id").val();
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

			$('td', row).eq(5).html('<div class="d-flex"><a href="javascript:void(0)" onclick="edit_special_requirements('+data['special_requirements_id']+')" class="btn btn-primary shadow btn-xs sharp me-1"><i class="fas fa-pencil-alt"></i></a><a href="javascript:void(0)" onclick="return delete_special_requirements('+data['special_requirements_id']+')" class="btn btn-danger shadow btn-xs sharp"><i class="fa fa-trash"></i></a></div>');
			
            
           },

           "drawCallback": function( settings ) {
                // displaySelectByUserType();
            },

        "columns": [
            { "data": "special_requirements_status", "orderable": false },
            { "data": "special_requirements_name", "orderable": false },
            { "data": "special_requirements_cost", "orderable": false },
            { "data": "special_requirements_description", "orderable": false },
            { "data": "special_requirements_createdby_user_name", "orderable": false },                      
            { "data": "special_requirements_id", "orderable": false }
            
            
        ]
        
    });
    
  

  });
    
 
////***Listing table*****///

////***For close the modal *****///
function specialrequirmentsmodalclose()
{

    $('#SpecialrequirmentsModal').modal('hide');
   
	//$( "div" ).remove( ".modal-backdrop" );
    $('#special_requirements_name').val('');
    $('#special_requirements_cost').val('');
    $('#special_requirements_description').val('');
	$('#category_name_alert').hide();
	$('.submit').removeAttr('disabled');
	$('.form-group').removeClass('input-success-o');
	$('.form-group').removeClass('input-warning-o');
	$('.special_requirements_name').removeClass('input-success-o');
	$('.special_requirements_name').removeClass('input-warning-o');
    $('.special_requirements_cost').removeClass('input-success-o');
    $('.special_requirements_cost').removeClass('input-warning-o');
    $('.special_requirements_description').removeClass('input-success-o');
    $('.special_requirements_description').removeClass('input-warning-o');
	// $('#btnSave').removeAttr('disabled');
}
////***For close the modal *****///

////***For open the modal *****///
$('#SpecialrequirmentsModal').on('shown.bs.modal', function () {
    // $("#state_id_fk").select2('open');
	$('#special_requirements_name').focus();
    $('#special_requirements_name_alert').hide();
	// $(".submit").attr("disabled", "disabled");
	$('.form-group').removeClass('input-success-o');
	$('.form-group').removeClass('input-warning-o');
	$('.special_requirements_name').removeClass('input-success-o');
	$('.special_requirements_name').removeClass('input-warning-o');
    $('.special_requirements_cost').removeClass('input-success-o');
    $('.special_requirements_cost').removeClass('input-warning-o');
    $('.special_requirements_description').removeClass('input-success-o');
    $('.special_requirements_description').removeClass('input-warning-o');
})
////***For open the modal *****///
	
////***For open modal of Special requirments adding form  *****///
	
function add_special_requirments()
{ 
    save_method = 'add';
    $("#id").val('');
    $('#form')[0].reset(); // reset form on modals
    $('.form-group').removeClass('input-warning-o'); // clear error class
    $('.help-block').empty(); // clear error string
    $('#SpecialrequirmentsModal').modal('show'); // show bootstrap modal
    $('.modal-title').text('Add Special requirments Details'); // Set Title to Bootstrap modal title
	$('#btnSave').text('save');
}

////***For open modal of stage adding form  *****///

////***For editing Special requirments details from adding modal form  *****///

function edit_special_requirements(id)
{
    save_method = 'update';
    $('#form')[0].reset(); // reset form on modals
    $('.form-group').removeClass('input-warning-o'); // clear error class
    $('.help-block').empty(); // clear error string

    //Ajax Load data from ajax
    $.ajax({
        url : "<?php echo base_url();?>index.php/Special_requirments/ajax_edit/" + id,
        type: "GET",
        dataType: "JSON",
        success: function(data)
        {

            $('[name="id"]').val(data.special_requirements_id);
            $('[name="special_requirements_name"]').val(data.special_requirements_name);
            $('[name="special_requirements_cost"]').val(data.special_requirements_cost); 
            $('[name="special_requirements_description"]').val(data.special_requirements_description);      
            $('#SpecialrequirmentsModal').modal('show'); // show bootstrap modal when complete loaded
            $('.modal-title').text('Edit Special requirments Details'); // Set title to Bootstrap modal title
			$('#btnSave').text('update');
        },
        error: function (jqXHR, textStatus, errorThrown)
        {
            alert('Error get data from ajax');
        }
    });
}

////***For editing Special requirments details from adding modal form  *****///

////***For reload the datatable  *****///

function reload_table()
{
    $table.ajax.reload(null,false); //reload datatable ajax 
	var id = $("#id").val();
	if(id)
	{  

        // swal("Special requirments details updated successfully", "", "success")
		var ff = 0;
		
		ff = "Special requirments details updated successfully";

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
		
        // swal("Special requirments details added successfully", "", "success")

		var ff = 0;
		
		ff = "Special requirments details added successfully";

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

///***For save the Special requirments details from adding modal form *****///

function save()
{
     
    var url;

    if(save_method == 'add') {
        $("#id").val('');
        $('#btnSave').text('saving...'); //change button text
        $('#btnSave').attr('disabled',true); //set button disable

        url = "<?php echo base_url();?>index.php/Special_requirments/ajax_add/";
    } 
	else {

        $('#btnSave').text('updating...'); //change button text
        $('#btnSave').attr('disabled',true); //set button disable

        url = "<?php echo base_url();?>index.php/Special_requirments/ajax_update/";
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

				$('#SpecialrequirmentsModal').modal('hide');
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

///***For save the Special requirments details from adding modal form *****///

////***For reload the datatable for delete *****///

function reload_table_delete()
{
    $table.ajax.reload(null,false); //reload datatable ajax
    
    // swal("Itinerary category details deleted successfully", "", "success")
        var ff = 0;
        
        ff = "Special requirments details deleted successfully";

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
    
////***For reload the Special requirments datatable for delete *****///

function delete_special_requirements(id)
{
     $.ajax({
        url : "<?php echo base_url();?>index.php/Special_requirments/ajax_edit/" + id,
        type: "GET",
        dataType: "JSON",
        success: function(data)
        {

            $('[name="id"]').val(data.special_requirements_id);
            $('[name="special_requirements_name"]').val(data.special_requirements_name);
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

function delete_special_action()
{
    $('#btnSave1').text('deleting...'); //change button text
    $('#btnSave1').attr('disabled',true); //set button disable 
    var url;

        url = "<?php echo base_url();?>index.php/Special_requirments/delete/";
        
    

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

////***For delete the Special requirments details from  database *****///

////***Checking Special requirments name already existing*****///

$("#special_requirements_name").on("input", function(e) {

var special_requirements_name =$("#special_requirements_name").val();
var id = $ ("#id").val();
//alert(product_id);
if(id){
if(special_requirements_name){
    $.ajax({
        url:"<?php echo base_url()?>index.php/Special_requirments/checkEditspecial_requirements",
        type: 'POST',
        data: {value:special_requirements_name,id:id},
        dataType: 'json',
        success:
        function(data)
        {
            //alert(data);
            if(data){
                var data1 = "Special requirments Already Exist";
                $("#special_requirements_name_alert").html(data1);
                $("#special_requirements_name_alert").show();
                $('#special_requirements_name').val('');
                $('#special_requirements_name').focus();
                $('#btnSave').attr("disabled", "disabled");
                $('.special_requirements_name').removeClass('input-success-o').addClass('input-warning-o');
             }
             else{
                 $('#btnSave').removeAttr('disabled');
                  $("#special_requirements_name_alert").hide();
                  $('.special_requirements_name').removeClass('input-warning-o').addClass('input-success-o');
             }

        },
        error:function(e){
        console.log("error");
        }
        });
    }
 }
 else{
 if(special_requirements_name){
    $.ajax({
        url:"<?php echo base_url()?>index.php/Special_requirments/checkspecial_requirements",
        type: 'POST',
        data: {value:special_requirements_name},
        dataType: 'json',
        success:
        function(data)
        {
            // alert(state_id);
            if(data){
            // alert(state_id);
                var data1 = "Special requirments Already Exist";
                $("#special_requirements_name_alert").html(data1);
                $("#special_requirements_name_alert").show();
                $('#special_requirements_name').val('');
                $('#special_requirements_name').focus();
                $('#btnSave').attr("disabled", "disabled");
                $('.special_requirements_name').removeClass('input-success-o').addClass('input-warning-o');
             }
             else{
                 $('#btnSave').removeAttr('disabled');
                 $("#special_requirements_name_alert").hide();
                 $('.special_requirements_name').removeClass('input-warning-o').addClass('input-success-o');
             }

        },
        error:function(e){
        console.log("error");
        }
        });
}
 
 }
 

});

////***Checking Special requirments name already existing*****///
</script>