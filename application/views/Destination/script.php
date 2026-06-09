<script>

function initCommonSelect2(scope) {

    scope = scope || document;

    $(scope).find('.lst-flt-select2').each(function () {

        let $select = $(this);

        // avoid re-initializing
        if ($select.hasClass('select2-hidden-accessible')) {
            return;
        }

        // find nearest opened modal if this select is inside modal
        let $modal = $select.closest('.modal');

        let options = {
            width: '100%',
            minimumResultsForSearch: 0
        };

        // only set dropdownParent when inside modal
        if ($modal.length) {
            options.dropdownParent = $modal;
        }

        $select.select2(options);
    });
}

// auto focus search input for all select2
$(document).on('select2:open', function () {
    setTimeout(function () {
        let searchField = document.querySelector('.select2-container--open .select2-search__field');
        if (searchField) {
            searchField.focus();
        }
    }, 50);
});

// initialize page select2
$(document).ready(function () {
    initCommonSelect2(document);
});

// call this after opening any modal
$('#DestinationModal').on('shown.bs.modal', function () {
    initCommonSelect2(this);
});

// Clear error class when select2 value changes
$(document).on('select2:select', function(e) {
    var $element = $(e.target);
    if ($element.hasClass('select2-hidden-accessible')) {
        $element.next('.select2-container').removeClass('input-warning-o');
        $element.parent().find('.help-block').text('');
    }
});

// Clear error class when select2 is cleared
$(document).on('select2:unselect', function(e) {
    var $element = $(e.target);
    if ($element.hasClass('select2-hidden-accessible')) {
        $element.next('.select2-container').removeClass('input-warning-o');
        $element.parent().find('.help-block').text('');
    }
});

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
	
	
    $table = $('#Destination_table').DataTable( {
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
                                        columns: [0, 1, 2, 3]
                                    },
                                    title: 'Desitination details'
                                },
                                {
                                    extend: 'pdf',
                                    exportOptions: {
                                        columns: [0, 1, 2, 3]
                                    },
                                    title: 'Desitination details'
                                },
                                {
                                    extend: 'print',
                                    exportOptions: {
                                        columns: [0 ,1, 2, 3]
                                    },
                                    title: 'Desitination details'
                                },

			],
        "ajax": {
            "url": "<?php echo base_url();?>index.php/Destination/get/",
            "type": "POST",
            "data" : function (d) {
						// d.state_id_filter = $("#state_id_filter").val();
						// d.state_created_user_id = $("#state_created_user_id").val();
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

            let actionHtml = '<div class="d-flex">';

            // Edit button
            if (hasPermission('DESTINATION_UPDATE')) {
                actionHtml += '<a href="javascript:void(0)" onclick="edit_destination('+data['state_id']+')" class="btn btn-primary shadow btn-xs sharp me-1"><i class="fas fa-pencil-alt"></i></a>';
            }

            // Delete button
            if (hasPermission('DESTINATION_DELETE')) {
                actionHtml += '<a href="javascript:void(0)" onclick="return delete_destination('+data['state_id']+')" class="btn btn-danger shadow btn-xs sharp"><i class="fa fa-trash"></i></a>';
            }

            actionHtml += '</div>';

            $('td', row).eq(4).html(actionHtml);

			// $('td', row).eq(4).html('<div class="d-flex"><a href="javascript:void(0)" onclick="edit_destination('+data['state_id']+')" class="btn btn-primary shadow btn-xs sharp me-1"><i class="fas fa-pencil-alt"></i></a><a href="javascript:void(0)" onclick="return delete_destination('+data['state_id']+')" class="btn btn-danger shadow btn-xs sharp"><i class="fa fa-trash"></i></a></div>');


           },

           "drawCallback": function( settings ) {
                // displaySelectByUserType();
            },

        "columns": [
            { "data": "state_status", "orderable": false },
            { "data": "location_name", "orderable": false },
            { "data": "state_name", "orderable": false },
            { "data": "state_description", "orderable": false },
            { "data": "state_id", "orderable": false }


        ]
        
    });
    
  

  });
    
 
////***Listing table*****///

////***For close the modal *****///
function Destinationmodalclose()
{

    $('#DestinationModal').modal('hide');

	//$( "div" ).remove( ".modal-backdrop" );
    $('#location_id_fk').val('').trigger('change');
    $('#state_name').val('');
    $('#state_description').val('');
	$('#category_name_alert').hide();
	$('.submit').removeAttr('disabled');
	$('.form-group').removeClass('input-success-o');
	$('.form-group').removeClass('input-warning-o');
	$('.location_id_fk').removeClass('input-success-o');
	$('.location_id_fk').removeClass('input-warning-o');
	$('.state_name').removeClass('input-success-o');
	$('.state_name').removeClass('input-warning-o');
    $('.state_description').removeClass('input-success-o');
    $('.state_description').removeClass('input-warning-o');
	// $('#btnSave').removeAttr('disabled');
}
////***For close the modal *****///

////***For open the modal *****///
$('#PackagecategoryModal').on('shown.bs.modal', function () {
    // $("#state_id_fk").select2('open');
	$('#state_name').focus();
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
	
function add_destination()
{
    save_method = 'add';
    $("#id").val('');
    $('#form')[0].reset(); // reset form on modals
    $('.form-group').removeClass('input-warning-o'); // clear error class
    $('.help-block').empty(); // clear error string
    $('.select2-container').removeClass('input-warning-o'); // clear select2 error class
    $('#DestinationModal').modal('show'); // show bootstrap modal
    $('.modal-title').text('Add Destination Details'); // Set Title to Bootstrap modal title
	$('#btnSave').text('save');
}

////***For open modal of stage adding form  *****///

////***For editing Package category details from adding modal form  *****///

function edit_destination(id)
{
    save_method = 'update';
    $('#form')[0].reset(); // reset form on modals
    $('.form-group').removeClass('input-warning-o'); // clear error class
    $('.help-block').empty(); // clear error string
    $('.select2-container').removeClass('input-warning-o'); // clear select2 error class

    //Ajax Load data from ajax
    $.ajax({
        url : "<?php echo base_url();?>index.php/Destination/ajax_edit/" + id,
        type: "GET",
        dataType: "JSON",
        success: function(data)
        {

            $('[name="id"]').val(data.state_id);
            $('[name="location_id_fk"]').val(data.location_id_fk).trigger('change');
            $('[name="state_name"]').val(data.state_name);
            $('[name="state_description"]').val(data.state_description);
            $('#DestinationModal').modal('show'); // show bootstrap modal when complete loaded
            $('.modal-title').text('Edit Destination Details'); // Set title to Bootstrap modal title
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
		
		ff = "Destination details updated successfully";

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
		
		ff = "Destination details added successfully";

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

        url = "<?php echo base_url();?>index.php/Destination/ajax_add/";
    } 
	else {

        $('#btnSave').text('updating...'); //change button text
        $('#btnSave').attr('disabled',true); //set button disable

        url = "<?php echo base_url();?>index.php/Destination/ajax_update/";
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

				$('#DestinationModal').modal('hide');
                // $('body').removeClass('modal-open');
                // $('.modal-backdrop').remove();


                reload_table();
            }
            else
            {
                for (var i = 0; i < data.inputerror.length; i++)
                {
                    var $element = $('[name="'+data.inputerror[i]+'"]');

                    // Check if this is a select2 element
                    if ($element.hasClass('select2-hidden-accessible')) {
                        // For select2, add error class to the select2 container
                        $element.next('.select2-container').addClass('input-warning-o');
                        // Show error message
                        if($element.parent().find('.help-block').length) {
                            $element.parent().find('.help-block').text(data.error_string[i]);
                        } else {
                            $element.next().text(data.error_string[i]);
                        }
                    } else {
                        // For regular elements
                        $element.parent().parent().addClass('input-warning-o');
                        if($element.parent().find('.help-block').length) {
                            $element.parent().find('.help-block').text(data.error_string[i]);
                        } else {
                            $element.next().text(data.error_string[i]);
                        }
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
        
        ff = "Destination details deleted successfully";

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

function delete_destination(id)
{
     $.ajax({
        url : "<?php echo base_url();?>index.php/Destination/ajax_edit/" + id,
        type: "GET",
        dataType: "JSON",
        success: function(data)
        {

            $('[name="id"]').val(data.state_id);
            $('[name="state_name"]').val(data.state_name);
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

function delete_destination_action()
{
    $('#btnSave1').text('deleting...'); //change button text
    $('#btnSave1').attr('disabled',true); //set button disable 
    var url;

        url = "<?php echo base_url();?>index.php/Destination/delete/";
        
    

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


</script>