<script>
// https://www.snagoff.com/blog/blog-post/add-remove-multiple-input-fields-dynamically-with-jquery-and-php/
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

// $( "#b2b_partner_person_name1" ).keypress(function() {
//             $table.ajax.reload();
// });

////***searching button*****///

////***Latest Jquery form validation for adding form*****///

    ////***Listing table*****///

var save_method; //for save method string
var table;
  $(document).ready(function() {
    
    
    $table = $('#Terms_condition_table').DataTable( {
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
                        columns: [0, 1]
                    }
                },
                {
                    extend: 'pdf',
                    exportOptions: {
                        columns: [0, 1]
                    }
                },
                {
                    extend: 'print',
                    exportOptions: {
                        columns: [0 ,1]
                    }
                },
            ],
        "ajax": {
            "url": "<?php echo base_url();?>index.php/Terms_condition/get/",
            "type": "POST",
            "data" : function (d) {
                        d.terms_condition_id = $("#terms_condition_id").val();
                        d.terms_condition_createdby_user_id = $("#terms_condition_createdby_user_id").val();
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

            $('td', row).eq(3).html('<div class="d-flex"><a href="javascript:void(0)" onclick="edit_terms_condition('+data['terms_condition_id']+')" class="btn btn-primary shadow btn-xs sharp me-1"><i class="fas fa-pencil-alt"></i></a><a href="javascript:void(0)" onclick="return delete_terms_condition('+data['terms_condition_id']+')" class="btn btn-danger shadow btn-xs sharp"><i class="fa fa-trash"></i></a></div>');
            
           
            
           },

           "drawCallback": function( settings ) {
                // displaySelectByUserType();
            },

        "columns": [
            { "data": "terms_condition_status", "orderable": false },
            { "data": "terms_condition_name", "orderable": false },
            { "data": "terms_condition_createdby_user_name", "orderable": false },
            { "data": "terms_condition_id", "orderable": false },
            
            
            
        ]
        
    });
    
    
    ////***Latest Jquery form validation for adding form*****///
            
    $("#form").validate({

        validClass: "success",
        rules: {
            'input, select, textarea': {
                required: function(element) {
                    return $(element).is(':visible');
                }
            }
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

        errorClass: 'input-error', // Optional, customize error class
        errorElement: 'div'

    });

  });
    
 
////***Listing table*****///

////***For close the modal *****///
  $('#Terms_conditionModal').on('hidden.bs.modal', function() {
  var waitForClose = window.setInterval(function() {
    if ($('body').hasClass('modal-open') == false) {
      $('.user').find('#name').trigger('focus');
      window.clearInterval(waitForClose)
    }
  }, 100);
  $(".product-item").remove();
});
function Terms_conditionmodalclose()
{

    $('#Terms_conditionModal').modal('hide');
   
    //$( "div" ).remove( ".modal-backdrop" );
    $('#terms_condition_name').val('');
    $(".product-item").remove();
    $(".product-item1").remove();
    $('#category_name_alert').hide();
    $('.submit').removeAttr('disabled');
    $('.form-group').removeClass('input-success-o');
    $('.form-group').removeClass('input-warning-o');
    $('.terms_condition_name').removeClass('input-success-o');
    $('.terms_condition_name').removeClass('input-warning-o');
    $(".product-item").remove();
    $(".product-item1").remove();

    // $('#btnSave').removeAttr('disabled');
}
////***For close the modal *****///

////***For open the modal *****///
$('#Terms_conditionModal').on('shown.bs.modal', function () {
    // $("#state_id_fk").select2('open');
    $('#terms_condition_name').focus();

    // $(".submit").attr("disabled", "disabled");
    $('.form-group').removeClass('input-success-o');
    $('.form-group').removeClass('input-warning-o');
    $('.terms_condition_name').removeClass('input-success-o');
    $('.terms_condition_name').removeClass('input-warning-o');

})
////***For open the modal *****///
    
////***For open modal of Terms and condition adding form  *****///
    
function add_Terms_condition()
{ 
    save_method = 'add';
    $("#id").val('');
    $('#form')[0].reset(); // reset form on modals
    $('.form-group').removeClass('input-warning-o'); // clear error class
    $('.help-block').empty(); // clear error string
    $('#Terms_conditionModal').modal('show'); // show bootstrap modal
    $('.modal-title').text('Add Terms and condition Details'); // Set Title to Bootstrap modal title
    $('#btnSave').text('save');
    $(".product-item").remove();
    $(".product-item1").remove();
    counter = 0;
}

////***For open modal of Terms and condition adding form  *****///

////***For editing Terms and condition details from adding modal form  *****///

function edit_terms_condition(id)
{
    save_method = 'update';
    $('#form')[0].reset(); // reset form on modals
    $('.form-group').removeClass('input-warning-o'); // clear error class
    $('.help-block').empty(); // clear error string
    //$("#product").hide();  

    //Ajax Load data from ajax
    $.ajax({
        url : "<?php echo base_url();?>index.php/Terms_condition/ajax_edit/" + id,
        type: "GET",
        dataType: "JSON",
        success: function(data)
        {
            
            $('[name="id"]').val(data.terms_condition_id);
            $('[name="terms_condition_name"]').val(data.terms_condition_name);
              
            $('#Terms_conditionModal').modal('show'); // show bootstrap modal when complete loaded
            $('.modal-title').text('Edit Terms and condition Details'); // Set title to Bootstrap modal title
            $('#btnSave').text('update');

            var terms_condition_id = data.terms_condition_id;
            $.ajax({
              url: "<?php echo base_url(); ?>index.php/Terms_condition/fetch_terms_condition_items/",
              dataType: 'json',
              type: 'POST',
              data:{terms_condition_id:terms_condition_id},
              success: function(data) {
                var result = data;
                // console.log(result);
                var field = [];
                var num = 1;
                $.each(result, function (i, item) {


                            // field.push('<DIV class="product-item box box-success list exp_section" id="product-item_'+num+'">&nbsp <input type="hidden" name="sub-counter-'+num+'" id="sub-counter-'+num+'" value="0" /> <table class="table table-bordered" cellspacing="2" ><tr><div class="row"><div class="col-sm-12"><input type="hidden" name="terms_condition_id_fk['+num+']" id="terms_condition_id_fk_'+num+'" value="'+item.terms_condition_id_fk+'"/><input type="text" name="terms_condition_items_id['+num+']" id="terms_condition_items_id_'+num+'" value="'+item.terms_condition_items_id+'"/> <textarea class="form-control" name="terms_condition_items_name['+num+']" id="terms_condition_items_name_'+num+'"  rows="5" placeholder="Enter Terms and condition" required>'+item.terms_condition_items_name+'</textarea><input type="text" id="counter_edit" value="'+num+'"><button class="btn-sm btn-danger" type="button" style="margin-top:20%;" onClick="deleteRow('+num+');"><b>X</b></button></div></div></div></tr></table></DIV>');

                    field.push('<div class="mb-3 col-md-8 product-item" id="product-item_'+num+'"><input type="hidden" name="terms_condition_id_fk['+num+']" id="terms_condition_id_fk_'+num+'" value="'+item.terms_condition_id_fk+'"/><input type="hidden" name="terms_condition_items_id['+num+']" id="terms_condition_items_id_'+num+'" value="'+item.terms_condition_items_id+'"/><textarea class="form-control" name="terms_condition_items_name['+num+']" id="terms_condition_items_name_'+num+'"  rows="5" placeholder="Enter Terms and condition" required>'+item.terms_condition_items_name+'</textarea><span class="help-block" style="color:red"></span></div><div class="mb-3 col-md-3 product-item1" id="product-item1_'+num+'"><button class="btn-sm btn-danger" type="button" onClick="deleteRow('+num+');"><b>X</b></button></div>');
                    
                    

                    num++;
                   
                });

               
            //alert(num) 
            $("#counter_edit1").val(num);    
            console.log(field); 
            //$("#stg").html(field);
            $("#product1").append(field);  
            $("#counter_edit").val(num - 1) 
            counter = num-1;
            }

                
             });
        },
        error: function (jqXHR, textStatus, errorThrown)
        {
            alert('Error get data from ajax');
        }
    });
}

////***For editing Terms and condition details from adding modal form  *****///

////***For reload the datatable  *****///

function reload_table()
{
    $table.ajax.reload(null,false); //reload datatable ajax 
    var id = $("#id").val();
    if(id)
    {  

        // swal("Terms and condition details updated successfully", "", "success")
        var ff = 0;
        
        ff = "Terms and condition details updated successfully";

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
        
        // swal("Terms and condition details added successfully", "", "success")

        var ff = 0;
        
        ff = "Terms and condition details added successfully";

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

///***For save the Terms and condition details from adding modal form *****///

function save()
{
     
    var url;

    if(save_method == 'add') {
        $("#id").val('');
        $('#btnSave').text('saving...'); //change button text
        $('#btnSave').attr('disabled',true); //set button disable

        url = "<?php echo base_url();?>index.php/Terms_condition/ajax_add/";
    } 
    else {

        $('#btnSave').text('updating...'); //change button text
        $('#btnSave').attr('disabled',true); //set button disable

        url = "<?php echo base_url();?>index.php/Terms_condition/ajax_update/";
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

                $('#Terms_conditionModal').modal('hide');
                // $('body').removeClass('modal-open');
                // $('.modal-backdrop').remove();
                $(".product-item").remove();
    $(".product-item1").remove();

                reload_table();
            }
            else
            {
                for (var i = 0; i < data.inputerror.length; i++) 
                {
                    $('[name="'+data.inputerror[i]+'"]').parent().parent().addClass('input-warning-o'); //select parent twice to select div form-group class and add has-error class
                    if($('[name="'+data.inputerror[i]+'"]').parent().find('.help-block').length) {
                        $('[name="'+data.inputerror[i]+'"]').parent().find('.help-block').text(data.error_string[i]); //select span help-block class set text error string
                    } else {
                        $('[name="'+data.inputerror[i]+'"]').next().text(data.error_string[i]);
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

///***For save the Terms and condition details from adding modal form *****///

////***For reload the datatable for delete *****///

function reload_table_delete()
{
    $table.ajax.reload(null,false); //reload datatable ajax
    
    // swal("Property category details deleted successfully", "", "success")
        var ff = 0;
        
        ff = "Terms and condition details deleted successfully";

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
    
////***For reload the Terms and condition datatable for delete *****///

function delete_terms_condition(id)
{
     $.ajax({
        url : "<?php echo base_url();?>index.php/Terms_condition/ajax_edit/" + id,
        type: "GET",
        dataType: "JSON",
        success: function(data)
        {

            $('[name="id"]').val(data.terms_condition_id);
            $('[name="terms_condition_name"]').val(data.terms_condition_name);
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

function delete_terms_condition_action()
{
    $('#btnSave1').text('deleting...'); //change button text
    $('#btnSave1').attr('disabled',true); //set button disable 
    var url;

        url = "<?php echo base_url();?>index.php/Terms_condition/delete/";
        
    

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
                    if($('[name="'+data.inputerror[i]+'"]').parent().find('.help-block').length) {
                        $('[name="'+data.inputerror[i]+'"]').parent().find('.help-block').text(data.error_string[i]); //select span help-block class set text error string
                    } else {
                        $('[name="'+data.inputerror[i]+'"]').next().text(data.error_string[i]);
                    }
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

////***For delete the Terms and condition details from  database *****///

////***Dynamic text box details saving into database*****////

// $(document).ready(function() {



//     var counter_edit = $("#counter_edit").val();



//     if(counter_edit >0){



//       counter = counter_edit-1;



//     }



//   });

var counter = 1;

var n1 = $("#counter_edit1").val();
                 // alert(n1);

var counter_edit = $("#counter_edit1").val();



if(counter_edit >0){
    counter = counter_edit-1;
}
    //alert(counter);




function addMore() {
 var n1 = $("#counter_edit").val();
                 // alert(n1);
// var user_id_fk = $('#user_id_fk').val();
// var currentLoggedInUserType = $('#currentLoggedInUserType').val();

// if(user_id_fk == '' && currentLoggedInUserType == 'A'){

// var ff = 0;
        
//         var ff = 0;
  
//   ff = "Company is required first";

//   $("#validation_dynamic").val(ff);
  
 
//      var options = {

//     'title': '',

//     'style': 'error',

//     'message': ff,

//     // 'success': 'warning',
//     'icon': 'warning',

//     };

//    var n1 = new notify(options); 

//    n1.show(); 

//    setTimeout(function(){ n1.hide(); }, 10000);
//    $('.user_id_fk').addClass('has-error');
//    $('#campaign_agency_commission').focus();
//    $('.user_id_fk').addClass('has-error');
//    return false; 
// }
// else{

    $("<DIV>").load("", function() {
    
    $(this).attr('data-validation','required');
    $(this).attr('data-validation','nameFields');
    $(this).attr('data-validation','digitsOnly');
    $(this).attr('data-validation','date');
    $(this).attr('data-validation','usPhone');
    $(this).attr('data-validation','email');
    $(this).attr('data-validation','dropDown');


    // var htmlVal = '<DIV class="product-item box box-success list exp_section" id="product-item_'+counter+'">&nbsp <input type="hidden" name="sub-counter-'+counter+'" id="sub-counter-'+counter+'" value="0" /> <table class="table table-bordered" cellspacing="2" ><tr><div class="row"><div class="col-sm-12"><input type="hidden" name="terms_condition_id_fk['+counter+']" id="terms_condition_id_fk_'+counter+'"/> <textarea class="form-control" name="terms_condition_items_name['+counter+']" id="terms_condition_items_name_'+counter+'"  rows="5" placeholder="Enter details" required></textarea><button class="btn-sm btn-danger" type="button" style="margin-top:20%;" onClick="deleteRow('+counter+');"><b>X</b></button></div></div></div></tr></table></DIV>';

     var htmlVal = '<div class="mb-3 col-md-8 product-item" id="product-item_'+counter+'"><input type="hidden" name="terms_condition_id_fk['+counter+']" id="terms_condition_id_fk_'+counter+'"/><textarea class="form-control" name="terms_condition_items_name['+counter+']" id="terms_condition_items_name_'+counter+'"  rows="5" placeholder="Enter Terms and condition" required></textarea><span class="help-block" style="color:red"></span></div><div class="mb-3 col-md-3 product-item1" id="product-item1_'+counter+'"><button class="btn-sm btn-danger" type="button" onClick="deleteRow('+counter+');"><b>X</b></button></div>';
    $("#product1").append(htmlVal);   
        
    
  });   
counter++;  

}
////***Dynamic text box details saving into database*****////

////***Delete dynamic table rows*****///
var removed_item_ids = [];
function deleteRow(counter) {

    var item_id = $('#terms_condition_items_id_'+counter).val();
    removed_item_ids.push(item_id);
    $('#removed_terms_condition_id').val(removed_item_ids);

    console.log(counter,"counter");
    $("#product-item_"+counter).remove();
    $("#product-item1_"+counter).remove();
    var a = $("#countervalue").val();
    $("#countervalue").val(a-1);

   

}

////***Delete dynamic table rows*****///
</script>