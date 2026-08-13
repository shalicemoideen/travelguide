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

    // $(document).on('change input', '#properties_room_category_child_rate_applied_guest_to_year', function(e){ 

    //      var child_rate_appliedto_year = $('#properties_room_category_child_rate_applied_guest_to_year').val();
    //          sumchild_rate_appliedto_year = parseFloat(child_rate_appliedto_year) + 1;
    //          $('#properties_room_category_adult_rate_applied_guest_over').val(sumchild_rate_appliedto_year);
    //          $('#properties_room_category_adult_rate_applied_guest_over_hidden').val(sumchild_rate_appliedto_year);

    //     var child_rate_appliedfrom_year = $('#properties_room_category_child_rate_applied_guest_from_year').val();

    //     child_rate_appliedto_year_ss = parseFloat(child_rate_appliedto_year);
    //     child_rate_appliedfrom_year_ss = parseFloat(child_rate_appliedfrom_year);
    //     //alert(complimentaryto_year_ss);
    //     //alert(complimentaryto_year_ss);

    //     if(child_rate_appliedto_year_ss < child_rate_appliedfrom_year_ss){

    //         //alert("dd");
    //         $('#properties_room_category_child_rate_applied_guest_to_year').val('');
    //          var data1 = "To year should be greater than from year";
    //         $("#greater2_alert").html(data1);
    //         $("#greater2_alert").show();
    //     }
    //     else{

    //         $("#greater2_alert").hide();
    //     }
    // });

    $(document).on('change blur', '#properties_room_category_child_rate_applied_guest_to_year', function(e){ 

    var child_rate_appliedto_year = parseFloat($(this).val());
    var child_rate_appliedfrom_year = parseFloat($('#properties_room_category_child_rate_applied_guest_from_year').val());

    if (!isNaN(child_rate_appliedto_year) && !isNaN(child_rate_appliedfrom_year)) {

        if(child_rate_appliedto_year < child_rate_appliedfrom_year){

            $(this).val('');
            $("#greater2_alert").html("To year should be greater than from year").show();
        }
        else{
            $("#greater2_alert").hide();

            var sumchild_rate_appliedto_year = child_rate_appliedto_year + 1;
            $('#properties_room_category_adult_rate_applied_guest_over').val(sumchild_rate_appliedto_year);
            $('#properties_room_category_adult_rate_applied_guest_over_hidden').val(sumchild_rate_appliedto_year);
        }
    }
});

});

////***Date picker *****///

$('#start_date3').bootstrapMaterialDatePicker({
         weekStart: 0,
        time: false,
        format: 'DD/MM/YYYY'
    });

$('#end_date3').bootstrapMaterialDatePicker({
         weekStart: 0,
        time: false,
        format: 'DD/MM/YYYY'
    });

$('#upload_tariff_document_from_date').bootstrapMaterialDatePicker({
         weekStart: 0,
        time: false,
        format: 'DD/MM/YYYY'
    });

$('#upload_tariff_document_to_date').bootstrapMaterialDatePicker({
         weekStart: 0,
        time: false,
        format: 'DD/MM/YYYY'
    });

$('#room_tariff_hike_from_date').pickadate({

        // format: 'DD/MM/YYYY'
    });

$('#room_tariff_hike_to_date').pickadate({

        // format: 'DD/MM/YYYY'
    });
////***Date picker *****///

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

$(document).ready(function () {
    $("#btn2").click(function () {
        $("#Create2").toggle();
    });
});

$(document).ready(function () {
    $("#btn3").click(function () {
        $("#Create3").toggle();
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

////***Property details on view*****///  

function Property_details(id){
    // var conf = confirm("Do you want to Edit details?");
    // if(conf){
        $('#Property_details').html();
        $.ajax({
        url:"<?php echo base_url();?>index.php/Property_registration/get_data",
        type: 'POST',
        data:{id:id},
        dataType: 'json',
        success:
        function(data)
        {
             //alert(data['id']);
               document.getElementById('Id').value=data['properties_id'];
                $("#properties_name").html(data['properties_name']);
                
               
               
            
        },
        
        error:function(e){
        console.log("error");
        }
      
      });
      $('.nav-link').removeClass('active');
      $('#Property_details').addClass('active');
}

////***Property details on view*****///

////***Room category details*****///

function Room_details(id){
    // alert(id);
    //var id = document.getElementById('Id').value;
    $table1 = $('#Room_registration').DataTable( {
        "searching": false,
        "processing": true,
        "serverSide": true,
        "aLengthMenu": [[10, 25, 50, -1], [10, 25, 50, "All"]],
        "bDestroy" : true,
        "aLengthMenu": [[10, 25, 50, -1], [10, 25, 50, "All"]],
        // "bDestroy" : true,
        // aLengthMenu: [
          // [1, 2],
          // [1, 2]
        // ],
        // iDisplayLength: 1,
        "fnDrawCallback": function () {
            $('.image-popup').magnificPopup({
        type: 'image',
        closeOnContentClick: true,
        closeBtnInside: true,
        fixedContentPos: true,
        image: {
          verticalFit: true
        },
        zoom: {
          enabled: true,
          duration: 300 // don't foget to change the duration also in CSS
        },
        });
    },
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
            "url": "<?php echo base_url();?>index.php/Property_registration/get_roomcategory/"+id,
            "type": "POST",
            "data" : function (d) {
                        d.properties_id = $("#properties_id").val();
                        d.room_meal_plan_id = $("#room_meal_plan_id").val();
                        d.properties_room_category_id = $("#properties_room_category_id").val();
                        d.properties_room_category_createdby_user_id = $("#properties_room_category_createdby_user_id").val();
                        
                        
           }
        },
        "createdRow": function ( row, data, index ) {
          
//            $('td',row).eq(0).html(index+1);
           $table1.column(0).nodes().each(function(node,index,dt){
            $table1.cell(node).data(index+1);
            });
            if(data['properties_room_category_photo'] == '')
            {
                $('td',row).eq(1).html('<img style="height: 40px; width: 40px;" src="<?php echo base_url();?>assets/images/user.png" />');
            }
            else{
                $('td',row).eq(1).html('<a class="image-popup" href="<?php echo base_url();?>uploads/Property-room-category-doc/'+data['properties_room_category_photo']+'"><img style="height: 40px; width: 40px;" src="<?php echo base_url();?>uploads/Property-room-category-doc/'+data['properties_room_category_photo']+'" /></a>');
           }
           $('td', row).eq(7).html('<div class="d-flex"><a href="javascript:void(0)" id="rt" onclick="edit_room('+data['properties_room_category_id']+')" class="btn btn-primary shadow btn-xs sharp me-1"><i class="fas fa-pencil-alt"></i></a><a href="javascript:void(0)" onclick="return delete_room('+data['properties_room_category_id']+')" class="btn btn-danger shadow btn-xs sharp"><i class="fa fa-trash"></i></a></div>');

           },

        "columns": [
            { "data": "properties_room_category_status", "orderable": false },
            { "data": "properties_room_category_photo", "orderable": false },
            { "data": "properties_room_category_name", "orderable": false },
            { "data": "meal_plan_name", "orderable": false },
            { "data": "properties_room_category_inventory", "orderable": false },
            { "data": "properties_room_category_description", "orderable": false },
            { "data": "properties_room_category_createdby_user_name", "orderable": false },
            { "data": "properties_room_category_id", "orderable": false },
            
   
        ]
        
    } );
    
    $('.nav-link').removeClass('active');
    $('#Room_details').addClass('active');
    
  }
    
 
////***Room category details*****///

////***Upload tariff details*****///

function Upload_tariff_details(id){
    // alert(id);
    //var id = document.getElementById('Id').value;
    $table2 = $('#Tariff_uploaded_registration').DataTable( {
        "searching": false,
        "processing": true,
        "serverSide": true,
        "aLengthMenu": [[10, 25, 50, -1], [10, 25, 50, "All"]],
        "bDestroy" : true,
        "aLengthMenu": [[10, 25, 50, -1], [10, 25, 50, "All"]],
        // "bDestroy" : true,
        // aLengthMenu: [
          // [1, 2],
          // [1, 2]
        // ],
        // iDisplayLength: 1,
        
        dom: 'lBfrtip',
            buttons: [
                
                {
                                    extend: 'excel',
                                    exportOptions: {
                                        columns: [0, 1, 2, 3, 4, 5, 6]
                                    },
                                    title: 'Tariff uploaded details',
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
                                    title: 'Tariff uploaded details',
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
                                    title: 'Tariff uploaded details',
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
            "url": "<?php echo base_url();?>index.php/Property_registration/get_uploaded_tariff/"+id,
            "type": "POST",
            "data" : function (d) {
                        d.start_date = $("#start_date").val();
                        d.end_date = $("#end_date").val();
                        d.upload_tariff_document_created_by_user_id = $("#upload_tariff_document_created_by_user_id").val();
                        
                        
           }
        },
        "createdRow": function ( row, data, index ) {
          
//            $('td',row).eq(0).html(index+1);
           $table2.column(0).nodes().each(function(node,index,dt){
            $table2.cell(node).data(index+1);
            });
            if(data['upload_tariff_document_name'] == ""){
                        $('td', row).eq(3).html('<center> </center>');  
                    }
                    else{
                        $('td', row).eq(3).html('<center> <a target="_blank" href="<?php echo base_url();?>uploads/tariff-doc/'+data['upload_tariff_document_name']+'"><i class="fas fa-file"></i></a></center>');    
                    } 
           $('td', row).eq(6).html('<div class="d-flex"><a href="javascript:void(0)" id="rt" onclick="edit_tariff_document('+data['upload_tariff_document_id']+')" class="btn btn-primary shadow btn-xs sharp me-1"><i class="fas fa-pencil-alt"></i></a><a href="javascript:void(0)" onclick="return delete_tariff_document('+data['upload_tariff_document_id']+')" class="btn btn-danger shadow btn-xs sharp"><i class="fa fa-trash"></i></a></div>');

           },

        "columns": [
            { "data": "upload_tariff_document_status", "orderable": false },
            { "data": "upload_tariff_document_from_date", "orderable": false },
            { "data": "upload_tariff_document_to_date", "orderable": false },
            { "data": "upload_tariff_document_name", "orderable": false },
            { "data": "upload_tariff_document_description", "orderable": false },
            { "data": "upload_tariff_document_created_by_user_name", "orderable": false },
            { "data": "upload_tariff_document_id", "orderable": false },
            
   
        ]
        
    } );
    
    $('.nav-link').removeClass('active');
    $('#Upload_tariff_details').addClass('active');
    
  }
    
 
////***Upload tariif details*****///  

////***Room tariff details*****///  

function Room_tariff_management(id){
    // alert(id);
    //var id = document.getElementById('Id').value;
    $table3 = $('#Room_tariff_registration').DataTable( {
        "searching": false,
        "processing": true,
        "serverSide": true,
        "aLengthMenu": [[10, 25, 50, -1], [10, 25, 50, "All"]],
        "bDestroy" : true,
        "aLengthMenu": [[10, 25, 50, -1], [10, 25, 50, "All"]],
        // "bDestroy" : true,
        // aLengthMenu: [
          // [1, 2],
          // [1, 2]
        // ],
        // iDisplayLength: 1,
        
        dom: 'lBfrtip',
            buttons: [
                
                {
                                    extend: 'excel',
                                    exportOptions: {
                                        columns: [0, 1, 2, 3, 4, 5, 6]
                                    },
                                    title: 'Property Tariff details',
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
                                    title: 'Property Tariff details',
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
                                    title: 'Property Tariff details',
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
            "url": "<?php echo base_url();?>index.php/Property_registration/Room_tariff_management/"+id,
            "type": "POST",
            "data" : function (d) {
                        // d.properties_id = $("#properties_id").val();
                        d.property_category_id_fk = $("#property_category_id_fk").val();
                        d.properties_room_category_id = $("#properties_room_category_id3").val();
                        d.room_tariff_hike_createdby_user_id = $("#room_tariff_hike_createdby_user_id").val();
                        d.start_date = $("#start_date3").val();
                        d.end_date = $("#end_date3").val();
           }            
        },
        "createdRow": function ( row, data, index ) {
          
//            $('td',row).eq(0).html(index+1);
           $table3.column(0).nodes().each(function(node,index,dt){
            $table3.cell(node).data(index+1);
            });
            
            
             $('td', row).eq(6).html('<div class="dropdown ms-auto text-end"><div class="btn-link" data-bs-toggle="dropdown"><svg width="24px" height="24px" viewBox="0 0 24 24" version="1.1"><g stroke="none" stroke-width="1" fill="none" fill-rule="evenodd"><rect x="0" y="0" width="24" height="24"></rect><circle fill="#000000" cx="5" cy="12" r="2"></circle><circle fill="#000000" cx="12" cy="12" r="2"></circle><circle fill="#000000" cx="19" cy="12" r="2"></circle></g></svg></div><div class="dropdown-menu dropdown-menu-end"><a class="dropdown-item" href="javascript:void(0)" id="rt" onclick="edit_room_tariff('+data['room_tariff_hike_id']+')">Edit</a><a class="dropdown-item" href="javascript:void(0)" onclick="return delete_room_tariff('+data['room_tariff_hike_id']+')">Delete</a><a class="dropdown-item" href="javascript:void(0)" onclick="return view_room_tariff('+data['room_tariff_hike_id']+')">View details</a></div></div>');
            
           
            
           },

        "columns": [
            { "data": "room_tariff_hike_status", "orderable": false },
            { "data": "properties_name", "orderable": false },
            { "data": "room_tariff_hike_from_date", "orderable": false },
            { "data": "room_tariff_hike_to_date", "orderable": false },
            { "data": "room_tariff_hike_description", "orderable": false },
            { "data": "room_tariff_hike_createdby_user_name", "orderable": false },                      
            { "data": "room_tariff_hike_id", "orderable": false }
            
            
        ]
        
    } );
    
    $('.nav-link').removeClass('active');
    $('#Room_tariff_management').addClass('active');
    
  }
    
 
////***Room tariff details*****///  

////***searching button*****///

$('#search').click(function () {
        
        $table.ajax.reload();
    });

$('#search1').click(function () {
        
        $table1.ajax.reload();
    });

$('#search2').click(function () {
        
        $table2.ajax.reload();
    });

$('#search3').click(function () {
        
        $table3.ajax.reload();
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

$("#form2").validate({

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
    
    
    $table = $('#Property_registration').DataTable( {
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
                                    title: 'Property registration details'
                                },
                                {
                                    extend: 'pdf',
                                    exportOptions: {
                                        columns: [0, 1, 2, 3, 4, 5, 6]
                                    },
                                    title: 'Property registration details'
                                },
                                {
                                    extend: 'print',
                                    exportOptions: {
                                        columns: [0 ,1, 2, 3, 4, 5, 6]
                                    },
                                    title: 'Property registration details'
                                },
                               
            ],
        "ajax": {
            "url": "<?php echo base_url();?>index.php/Property_registration/get/",
            "type": "POST",
            "data" : function (d) {
                        d.properties_id = $("#properties_id").val();
                        d.property_category_id_fk = $("#property_category_id_fk2").val();
                        d.country_id_fk = $("#country_id_fk2").val();
                        d.state_id_fk = $("#state_id_fk2").val();
                        d.properties_destination_id_fk = $("#properties_destination_id_fk2").val();
                        d.properties_createdby_userid = $("#properties_createdby_userid").val();
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

           // $('td', row).eq(7).html('<div class="d-flex"><a href="javascript:void(0)" id="rt" onclick="edit_property('+data['properties_id']+')" class="btn btn-primary shadow btn-xs sharp me-1"><i class="fas fa-pencil-alt"></i></a><a href="javascript:void(0)" onclick="return delete_property('+data['properties_id']+')" class="btn btn-danger shadow btn-xs sharp"><i class="fa fa-trash"></i></a><a href="javascript:void(0)" onclick="return delete_property('+data['properties_id']+')" class="btn btn-danger shadow btn-xs sharp"><i class="fa fa-eye"></i></a></div>');

           // $('td', row).eq(7).html('<div class="btn-group" role="group"><button type="button" class="btn btn-secondary dropdown-toggle" data-bs-toggle="dropdown">Secondary</button><div class="dropdown-menu"><a class="dropdown-item" href="javascript:void()">Dropdown link</a><a class="dropdown-item" href="javascript:void()">Dropdown link</a></div></div>');
            
           $('td', row).eq(7).html('<div class="dropdown ms-auto text-end"><div class="btn-link" data-bs-toggle="dropdown"><svg width="24px" height="24px" viewBox="0 0 24 24" version="1.1"><g stroke="none" stroke-width="1" fill="none" fill-rule="evenodd"><rect x="0" y="0" width="24" height="24"></rect><circle fill="#000000" cx="5" cy="12" r="2"></circle><circle fill="#000000" cx="12" cy="12" r="2"></circle><circle fill="#000000" cx="19" cy="12" r="2"></circle></g></svg></div><div class="dropdown-menu dropdown-menu-end"><a class="dropdown-item" href="javascript:void(0)" id="rt" onclick="edit_property('+data['properties_id']+')">Edit</a><a class="dropdown-item" href="javascript:void(0)" onclick="return delete_property('+data['properties_id']+')">Delete</a><a class="dropdown-item" href="<?php echo base_url();?>index.php/Property_registration/View/'+data['properties_id']+'" >View Details</a></div></div>');
            
           },

           "drawCallback": function( settings ) {
                // displaySelectByUserType();
            },

        "columns": [
            { "data": "properties_status", "orderable": false },
            { "data": "properties_name", "orderable": false },
            { "data": "property_category_name", "orderable": false },
            { "data": "name", "orderable": false },
            { "data": "plname", "orderable": false },
            { "data": "rcname", "orderable": false },
            { "data": "properties_createdby_username", "orderable": false },
            { "data": "properties_id", "orderable": false },
            
            
            
        ]
        
    });
    
  

  });
    
 
////***Listing table*****///

////***For close the modal *****///

function Propertymodalclose()
{

    $('#PropertyModal').modal('hide');
   
    //$( "div" ).remove( ".modal-backdrop" );
    $('#properties_name').val('');
    $('#property_category_id_fk').val('').change();
    $('#country_id_fk').val('').change();
    $('#state_id_fk').val('').change();
    $('#properties_destination_id_fk').val('').change();
    $('#properties_house_boat_type').val('').change();
    $('#properties_check_type').val('T').change();

    $('#category_name_alert').hide();
    $('.submit').removeAttr('disabled');
    $('.form-group').removeClass('input-success-o');
    $('.form-group').removeClass('input-warning-o');
    $('.properties_name').removeClass('input-success-o');
    $('.properties_name').removeClass('input-warning-o');

    // $('#btnSave').removeAttr('disabled');
}
////***For close the modal *****///

////***For open the modal *****///
$('#PropertyModal').on('shown.bs.modal', function () {
    // $("#state_id_fk").select2('open');
    $('#properties_name').focus();
    var id = $("#id").val();
    if(id == '')
    {
    $('#property_category_id_fk').val('').change();
    $('#country_id_fk').val('').change();
    $('#state_id_fk').val('').change();
    $('#properties_destination_id_fk').val('').change();
    $('#properties_house_boat_type').val('').change();
    $('#properties_check_type').val('T').change();
    }
    // $(".submit").attr("disabled", "disabled");
    $('.form-group').removeClass('input-success-o');
    $('.form-group').removeClass('input-warning-o');
    $('.properties_name').removeClass('input-success-o');
    $('.properties_name').removeClass('input-warning-o');

    var check_type = $('#properties_check_type').val();

    if(check_type == 'T'){

        $('#row1').hide();
        $('#row2').show();
    }
    else{

        $('#row1').show();
        $('#row2').hide();
    }

})
////***For open the modal *****///

////***For open modal of Property adding form  *****///
    
function add_property()
{
    save_method = 'add';

    $('#form')[0].reset();
    $('.form-group').removeClass('input-warning-o');
    $('.help-block').empty();

    // Force checking type to 24 hours
    $('#properties_check_type').val('T').trigger('change.select2');

    // Disable check-in and check-out
    toggleCheckTimeByType('T');

    // Hide thumbnails (optional)
    $('#hotel_logo_preview').hide();
    $('#property_photo_preview').hide();

    $('#PropertyModal').modal('show');
    $('.modal-title').text('Add property Details');
    $('#btnSave').text('save');
}


////***For open modal of Property adding form  *****///

////***For editing Property details from adding modal form  *****///

function setThumb(imgSelector, filename, basePath) {
    if (filename) {
        $(imgSelector).attr('src', basePath + filename).show();
    } else {
        $(imgSelector).attr('src', '').hide();
    }
}

function previewSelectedFile(input, type)
{
    if (input.files && input.files[0]) {
        var file = input.files[0];
        var ext = file.name.split('.').pop().toLowerCase();

        $('#' + type + '_preview_box').show();

        if (ext === 'pdf') {
            $('#' + type + '_preview_img').hide();
            $('#' + type + '_preview_pdf').show();

            var blobUrl = URL.createObjectURL(file);
            $('#' + type + '_preview_link').attr('href', blobUrl);
        } else {
            var reader = new FileReader();
            reader.onload = function(e){
                $('#' + type + '_preview_pdf').hide();
                $('#' + type + '_preview_img')
                    .attr('src', e.target.result)
                    .show();
            }
            reader.readAsDataURL(file);
        }
    }
}

$('#properties_hotel_logo').on('change', function(){
    previewSelectedFile(this, 'hotel_logo');
});

$('#properties_photos').on('change', function(){
    previewSelectedFile(this, 'property_photo');
});

function edit_property(id)
{
    save_method = 'update';
    $('#form')[0].reset();
    $('.form-group').removeClass('input-warning-o');
    $('.help-block').empty();

    $.ajax({
        url : "<?php echo base_url();?>index.php/Property_registration/ajax_edit/" + id,
        type: "GET",
        dataType: "JSON",
        success: function(data)
        {
            $('[name="id"]').val(data.properties_id);
            $('[name="properties_name"]').val(data.properties_name);

            $('#property_category_id_fk').val(data.property_category_id_fk).trigger('change.select2');
            $('#country_id_fk').val(data.country_id_fk).trigger('change.select2');
            $('#state_id_fk').val(data.state_id_fk).trigger('change.select2');
            $('#properties_destination_id_fk').val(data.properties_destination_id_fk).trigger('change.select2');
            $('#properties_house_boat_type').val(data.properties_house_boat_type).trigger('change.select2');

            $('#properties_hotel_url').val(data.properties_hotel_url);

            $('#properties_check_type').val(data.properties_check_type).trigger('change.select2');

            // Set time values first, then toggle (toggle will clear if T)
            $('#properties_check_in_time').val(data.properties_check_in_time);
            $('#properties_check_out_time').val(data.properties_check_out_time);

            $('#properties_sales_contact_name').val(data.properties_sales_contact_name);
            $('#properties_sales_contact_phone_number').val(data.properties_sales_contact_phone_number);
            $('#properties_sales_contact_email').val(data.properties_sales_contact_email);

            $('#properties_reservation_contact_name').val(data.properties_reservation_contact_name);
            $('#properties_reservation_contact_phone_number').val(data.properties_reservation_contact_phone_number);
            $('#properties_reservation_contact_email').val(data.properties_reservation_contact_email);

            $('#properties_google_map_location').val(data.properties_google_map_location);

            // hidden old file names
            $('#properties_hotel_logo_txt').val(data.properties_hotel_logo);
            $('#properties_photos_txt').val(data.properties_photos);

            $('#properties_description').val(data.properties_description);

            // thumbnail previews (adjust folders to match your upload paths)
            var BASE = "<?php echo base_url(); ?>";

            // adjust folders to match your upload paths
            setSmartPreview('hotel_logo', data.properties_hotel_logo, BASE + 'uploads/Property-doc/logo/');
            setSmartPreview('property_photo', data.properties_photos, BASE + 'uploads/Property-doc/photo/');

            // apply disable/enable based on check type
            toggleCheckTimeByType(data.properties_check_type);

            $('#PropertyModal').modal('show');
            $('.modal-title').text('Edit property Details');
            $('#btnSave').text('update');
        },
        error: function () {
            alert('Error get data from ajax');
        }
    });
}

// function previewFile(input, imgSelector){
//     if (input.files && input.files[0]) {
//         var reader = new FileReader();
//         reader.onload = function(e){ $(imgSelector).attr('src', e.target.result).show(); }
//         reader.readAsDataURL(input.files[0]);
//     }
// }

function setSmartPreview(type, filename, basePath)
{
    if (!filename) {
        $('#' + type + '_preview_box').hide();
        return;
    }

    var fullPath = basePath + filename;
    var ext = filename.split('.').pop().toLowerCase();

    $('#' + type + '_preview_box').show();

    if (ext === 'pdf') {
        // Show PDF button
        $('#' + type + '_preview_img').hide();
        $('#' + type + '_preview_pdf').show();
        $('#' + type + '_preview_link').attr('href', fullPath);
    } 
    else if (['jpg','jpeg','png','gif'].includes(ext)) {
        // Show image
        $('#' + type + '_preview_pdf').hide();
        $('#' + type + '_preview_img')
            .attr('src', fullPath)
            .show();
    } 
    else {
        // Other file types (optional)
        $('#' + type + '_preview_pdf').hide();
        $('#' + type + '_preview_img').hide();
    }
}


// $('#properties_hotel_logo').on('change', function(){ previewFile(this, '#hotel_logo_preview'); });
// $('#properties_photos').on('change', function(){ previewFile(this, '#property_photo_preview'); });


////***For editing Property details from adding modal form  *****///

////***For reload the datatable  *****///

function reload_table()
{
    $table.ajax.reload(null,false); //reload datatable ajax 
    var id = $("#id").val();
    if(id)
    {  

        swal("Property details updated successfully", "", "success")
        // var ff = 0;
        
        // ff = "Property details updated successfully";

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
        
        swal("Property details added successfully", "", "success")

        // var ff = 0;
        
        // ff = "Property details added successfully";

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

///***For save the Property details from adding modal form *****///

function validateFileInput(fileInput, allowedExts, maxBytes)
{
    if (!fileInput || !fileInput.files.length) return { ok: true };

    const file = fileInput.files[0];
    const ext = file.name.split('.').pop().toLowerCase();

    if (!allowedExts.includes(ext)) {
        return { ok: false, msg: 'Only JPG, JPEG, PNG, GIF or PDF allowed.' };
    }

    if (file.size > maxBytes) {
        return { ok: false, msg: 'File must be less than 2 MB.' };
    }

    return { ok: true };
}


function showFileError(inputSelector, message)
{
    var $group = $(inputSelector).closest('.form-group');

    $group.addClass('input-warning-o');

    $group.find('.file-error').text(message);
}

function save()
{
    // clear old file errors
    $('.form-group').removeClass('input-warning-o');
    $('.help-block').text('');

    const allowed = ['jpg','jpeg','png','gif','pdf'];
    const maxBytes = 2 * 1024 * 1024;

    // Validate Logo
    let logoInput = document.getElementById('properties_hotel_logo');
    let v1 = validateFileInput(logoInput, allowed, maxBytes);

    if (!v1.ok) {
        showFileError('#properties_hotel_logo', v1.msg);
        return;
    }

    // Validate Photo
    let photoInput = document.getElementById('properties_photos');
    let v2 = validateFileInput(photoInput, allowed, maxBytes);

    if (!v2.ok) {
        showFileError('#properties_photos', v2.msg);
        return;
    }


    // Continue your existing save ajax...
    var url;
    if(save_method == 'add') {
        $('#btnSave').text('saving...').attr('disabled', true);
        url = "<?php echo base_url();?>index.php/Property_registration/ajax_add/";
    } else {
        $('#btnSave').text('updating...').attr('disabled', true);
        url = "<?php echo base_url();?>index.php/Property_registration/ajax_update/";
    }

    var form = document.getElementById('form');
    var data = new FormData(form);

    $.ajax({
        url : url,
        type: "POST",
        data: data,
        dataType: "JSON",
        processData: false,
        contentType: false,
        success: function(res){
            if(res.status){
                $('#PropertyModal').modal('hide');
                reload_table();
            } else {
                // display server validation errors
                if(res.fileerror){
                    // file errors (custom)
                    if(res.fileerror.properties_hotel_logo){
                        showFileError('#properties_hotel_logo', res.fileerror.properties_hotel_logo);
                    }
                    if(res.fileerror.properties_photos){
                        showFileError('#properties_photos', res.fileerror.properties_photos);
                    }
                }
                if(res.inputerror){
                    for (var i = 0; i < res.inputerror.length; i++) {
                        $('[name="'+res.inputerror[i]+'"]').closest('.form-group').addClass('input-warning-o');
                        $('[name="'+res.inputerror[i]+'"]').closest('.form-group').find('.help-block').first().text(res.error_string[i]);
                    }
                }
            }
            $('#btnSave').text('save').attr('disabled', false);
        },
        error: function(){
            alert('Error adding / update data');
            $('#btnSave').text('save').attr('disabled', false);
        }
    });
}


///***For save the Property details from adding modal form *****///

////***For reload the datatable for delete *****///

function reload_table_delete()
{
    $table.ajax.reload(null,false); //reload datatable ajax
    
    swal("Property details deleted successfully", "", "success")
        // var ff = 0;
        
        // ff = "Property details deleted successfully";

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
    
////***For reload the Property datatable for delete *****///

function delete_property(id)
{
     $.ajax({
        url : "<?php echo base_url();?>index.php/Property_registration/ajax_edit/" + id,
        type: "GET",
        dataType: "JSON",
        success: function(data)
        {

            $('[name="id"]').val(data.properties_id);
            $('[name="properties_name"]').val(data.properties_name);
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

function delete_property_action()
{
    $('#btnSave1').text('deleting...'); //change button text
    $('#btnSave1').attr('disabled',true); //set button disable 
    var url;

        url = "<?php echo base_url();?>index.php/Property_registration/delete/";
        
    

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

////***For delete the Property details from  database *****///

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
        url : "<?php echo base_url();?>index.php/Property_registration/ajax_edit_room_category/" + id,
        type: "GET",
        dataType: "JSON",
        success: function(data)
        {

            $('[name="id1"]').val(data.properties_room_category_id);
            $('[name="properties_id_fk"]').val(data.properties_id_fk);
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
    $table1.ajax.reload(null,false); //reload datatable ajax 
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

        url = "<?php echo base_url();?>index.php/Property_registration/ajax_add_room_category/";
    } 
    else {

        $('#btnSave1').text('updating...'); //change button text
        $('#btnSave1').attr('disabled',true); //set button disable

        url = "<?php echo base_url();?>index.php/Property_registration/ajax_update_room_category/";
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
    $table1.ajax.reload(null,false); //reload datatable ajax
    
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
        url : "<?php echo base_url();?>index.php/Property_registration/ajax_edit_room_category/" + id,
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

        url = "<?php echo base_url();?>index.php/Property_registration/delete_room_category/";
        
    

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

////***For close the modal *****///

function Tariffuploadedmodalclose()
{

    $('#Tariff_uploadedModal').modal('hide');
   
    //$( "div" ).remove( ".modal-backdrop" );
    $('#upload_tariff_document_from_date').val('');
    $('#upload_tariff_document_to_date').val('');
    $('#upload_tariff_document_description').val('');
   


    $('.submit').removeAttr('disabled');
    $('.form-group').removeClass('input-success-o');
    $('.form-group').removeClass('input-warning-o');
    $('.upload_tariff_document_from_date').removeClass('input-success-o');
    $('.upload_tariff_document_from_date').removeClass('input-warning-o');
    $('.upload_tariff_document_to_date').removeClass('input-success-o');
    $('.upload_tariff_document_to_date').removeClass('input-warning-o');

    // $('#btnSave').removeAttr('disabled');
}
////***For close the modal *****///

////***For open the modal *****///
$('#Tariff_uploadedModal').on('shown.bs.modal', function () {
    // $("#state_id_fk").select2('open');
    $('#upload_tariff_document_from_date').focus();
    
    // $(".submit").attr("disabled", "disabled");
    $('.form-group').removeClass('input-success-o');
    $('.form-group').removeClass('input-warning-o');
    $('.upload_tariff_document_from_date').removeClass('input-success-o');
    $('.upload_tariff_document_from_date').removeClass('input-warning-o');
    $('.upload_tariff_document_to_date').removeClass('input-success-o');
    $('.upload_tariff_document_to_date').removeClass('input-warning-o');

    

})
////***For open the modal *****///

////***For open modal of Tariff uploaded adding form  *****///
    
function add_tariff_uploaded()
{ 
    save_method = 'add';
    $("#id3").val('');
    $('#form3')[0].reset(); // reset form on modals
    $('.form-group').removeClass('input-warning-o'); // clear error class
    $('.help-block').empty(); // clear error string
    $('#Tariff_uploadedModal').modal('show'); // show bootstrap modal
    $('.modal-title').text('Upolad room tariff Details'); // Set Title to Bootstrap modal title
    $('#btnSave3').text('save');

    var properties_id_fk = $("#properties_id_fk_hidden").val();
    $(".modal-body #properties_id_fk1").val( properties_id_fk );

    
}

////***For open modal of Tariff uploaded adding form  *****///

////***For editing Tariff uploaded details from adding modal form  *****///

function edit_tariff_document(id)
{
    save_method = 'update';
    $('#form3')[0].reset(); // reset form on modals
    $('.form-group').removeClass('input-warning-o'); // clear error class
    $('.help-block').empty(); // clear error string
    //$("#product").hide();  

    //Ajax Load data from ajax
    $.ajax({
        url : "<?php echo base_url();?>index.php/Property_registration/ajax_edit_uploaded_tariff/" + id,
        type: "GET",
        dataType: "JSON",
        success: function(data)
        {

            $('[name="id3"]').val(data.upload_tariff_document_id);
            $('[name="upload_tariff_document_from_date"]').val(data.upload_tariff_document_from_date);
            $('[id="upload_tariff_document_to_date"]').val(data.upload_tariff_document_to_date);
            $('[name="upload_tariff_document_name_txt"]').val(data.upload_tariff_document_name);
            $('[id="upload_tariff_document_description"]').val(data.upload_tariff_document_description);            
            

              
            $('#Tariff_uploadedModal').modal('show'); // show bootstrap modal when complete loaded
            $('.modal-title').text('Edit upoladed room tariff Details'); // Set title to Bootstrap modal title
            $('#btnSave1').text('update');

        },
        error: function (jqXHR, textStatus, errorThrown)
        {
            alert('Error get data from ajax');
        }
    });
}

////***For editing Tariff uploaded details from adding modal form  *****///

////***For reload the datatable  *****///

function reload_table2()
{
    $table2.ajax.reload(null,false); //reload datatable ajax 
    var id = $("#id1").val();
    if(id)
    {  

        swal("Tariff uploaded updated successfully", "", "success")
        // var ff = 0;
        
        // ff = "Tariff uploaded updated successfully";

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
        
        swal("Tariff uploaded successfully", "", "success")

        // var ff = 0;
        
        // ff = "Tariff uploaded successfully";

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

///***For save the Tariff uploaded details from adding modal form *****///

function save2()
{
     
    var url;

    if(save_method == 'add') {
        $("#id3").val('');
        $('#btnSave3').text('saving...'); //change button text
        $('#btnSave3').attr('disabled',true); //set button disable

        url = "<?php echo base_url();?>index.php/Property_registration/ajax_add_uploaded_tariff/";
    } 
    else {

        $('#btnSave3').text('updating...'); //change button text
        $('#btnSave3').attr('disabled',true); //set button disable

        url = "<?php echo base_url();?>index.php/Property_registration/ajax_update_uploaded_tariff/";
    }
    
    var fd = new FormData();
    
    var form = document.getElementById('form3');
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

                $('#Tariff_uploadedModal').modal('hide');
                // $('body').removeClass('modal-open');
                // $('.modal-backdrop').remove();


                reload_table2();
            }
            else
            {
                for (var i = 0; i < data.inputerror.length; i++) 
                {
                    $('[name="'+data.inputerror[i]+'"]').parent().parent().addClass('input-warning-o'); //select parent twice to select div form-group class and add has-error class
                    $('[name="'+data.inputerror[i]+'"]').next().text(data.error_string[i]); //select span help-block class set text error string
                }
            }
            $('#btnSave3').text('save'); //change button text
            $('#btnSave3').attr('disabled',false); //set button enable 
            $('.help-block').val('hide');

        },
        error: function (jqXHR, textStatus, errorThrown)
        {
            alert('Error adding / update data');
            $('#btnSave3').text('save'); //change button text
            $('#btnSave3').attr('disabled',false); //set button enable 

        }
    });
}

///***For save the Tariff uploaded details from adding modal form *****///

////***For reload the datatable for delete *****///

function reload_table_delete2()
{
    $table2.ajax.reload(null,false); //reload datatable ajax
    
    swal("Tariff uploaded deleted successfully", "", "success")
        // var ff = 0;
        
        // ff = "Tariff uploaded deleted successfully";

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
    
////***For reload the Tariff uploaded datatable for delete *****///

function delete_tariff_document(id)
{
     $.ajax({
        url : "<?php echo base_url();?>index.php/Property_registration/ajax_edit_uploaded_tariff/" + id,
        type: "GET",
        dataType: "JSON",
        success: function(data)
        {

            $('[name="id4"]').val(data.upload_tariff_document_id);
            $('[name="upload_tariff_document_from_date"]').val(data.upload_tariff_document_from_date);
            $('[name="upload_tariff_document_to_date"]').val(data.upload_tariff_document_to_date);
            $('#deleterow2Modal').modal('show'); // show bootstrap modal when complete loaded
            $('.modal-title2').text('Do you want to delete this record?'); // Set title to Bootstrap modal title
            $('#btnSave4').text('delete');
            $('#btnSave4').attr('disabled',false); //set button enable 

        },
        error: function (jqXHR, textStatus, errorThrown)
        {
            alert('Error get data from ajax');
        }
    });
    
    // $('#deleterowModal').modal('show'); // show bootstrap modal
        // ajax delete data to database 
}

function delete_tariff_document_action()
{
    $('#btnSave4').text('deleting...'); //change button text
    $('#btnSave4').attr('disabled',true); //set button disable 
    var url;

        url = "<?php echo base_url();?>index.php/Property_registration/delete_uploaded_tariff/";
        
    

    // ajax adding data to database
    $.ajax({
        url : url,
        type: "POST",
        data: $('#form4').serialize(),
        dataType: "JSON",
        success: function(data)
        {

            if(data.status) //if success close modal and reload ajax table
            {
                $("#id4").val('');
                $('#deleterow2Modal').modal('hide');
                reload_table_delete2();
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

            $('#btnSave4').text('save'); //change button text
            $('#btnSave4').attr('disabled',false); //set button enable 


        },
        error: function (jqXHR, textStatus, errorThrown)
        {
            alert('Error adding / update data');
            $('#btnSave4').text('save'); //change button text
            $('#btnSave4').attr('disabled',false); //set button enable 

        }
    });
}

////***For delete the Tariff uploaded details from  database *****///

// $(document).ready(function(){
// // $("select[name='related_type']").onchange(function(){
// $("#properties_check_type").change(function() {

// if($(this).val()=="T")
// {
// // alert("oo");
// $('#row1').hide();
// $('#row2').show();
// }
// else
// {
// $('#row1').show();
// $('#row2').hide();
// }
// });  
// });

function toggleCheckTimeByType(typeVal) {
    if (typeVal === 'T') {
        // 24 hours -> disable & clear
        $('#properties_check_in_time').val('').prop('disabled', true);
        $('#properties_check_out_time').val('').prop('disabled', true);
    } else {
        // Other -> enable & set defaults
        var $in = $('#properties_check_in_time');
        var $out = $('#properties_check_out_time');
        $in.prop('disabled', false);
        $out.prop('disabled', false);
        if (!$in.val()) $in.val('14:00:00');
        if (!$out.val()) $out.val('11:00:00');
    }
}

// On change
$(document).on('change', '#properties_check_type', function () {
    toggleCheckTimeByType($(this).val());
});

// When modal opens (important)
$('#PropertyModal').on('shown.bs.modal', function () {
    toggleCheckTimeByType($('#properties_check_type').val());
});



////***Validate Selected file is jpeg,jpg and png when select board image*****///

$('#properties_hotel_logo').on('change', function(){
    $('.file-error').text('');
    let v = validateFileInput(this, ['jpg','jpeg','png','gif','pdf'], 2 * 1024 * 1024);
    if (!v.ok) {
        showFileError('#properties_hotel_logo', v.msg);
        this.value = ''; // clear invalid file
    }
});

$('#properties_photos').on('change', function(){
    $('.file-error').text('');
    let v = validateFileInput(this, ['jpg','jpeg','png','gif','pdf'], 2 * 1024 * 1024);
    if (!v.ok) {
        showFileError('#properties_photos', v.msg);
        this.value = '';
    }
});

 




////***Validate Selected file is jpeg,jpg and png when booking and closing*****///


//////////////********* Room tariff managmnent *///////////////////////////////

////***Latest Jquery form validation for adding form*****///
      
$.validator.addMethod("dateRangeUnique", function(value, element) {
    var ok = false;

    var propId = $("#properties_id_fk").val();
    var fromD  = $("#room_tariff_hike_from_date").val();
    var toD    = $("#room_tariff_hike_to_date").val();

    // exclude id for edit
    var excludeId = $("#id5").val();

    if (!propId || !fromD || !toD) return true;

    $.ajax({
        url: "<?php echo base_url(); ?>index.php/Room_tariff_management/ajax_check_date_range",
        type: "POST",
        dataType: "json",
        async: false,
        data: {
            properties_id_fk: propId,
            room_tariff_hike_from_date: fromD,
            room_tariff_hike_to_date: toD,
            exclude_id: excludeId
        },
        success: function(res){
            ok = (res.valid === true);
        },
        error: function(){
            ok = true;
        }
    });

    return ok;
}, "This date range already exists / overlaps for this property.");


$("#form5").validate({
    debug: false,
    rules: {
        properties_id_fk: { required: true },
        room_tariff_hike_from_date: { required: true },
        room_tariff_hike_to_date: { required: true, dateRangeUnique: true }
    },
    highlight: function(element) {
        $(element).closest('.form-group').removeClass('input-success-o').addClass('input-warning-o');
    },
    unhighlight: function(element) {
        $(element).closest('.form-group').removeClass('input-warning-o').addClass('input-success-o');
    }
});

// re-check uniqueness when dates change
$("#room_tariff_hike_from_date, #room_tariff_hike_to_date").on("change blur", function(){
    $("#room_tariff_hike_to_date").valid();
});


////***Latest Jquery form validation for adding form*****///

$(document).ready(function(){
  

$(document).on("change",'.item',function(){
    var type = $(this).val();
    var counterId = $(this).attr("id");
    // var counter = counterId.substr(counterId.length - 1);
    var counter = counterId.split("_").pop(-1);
    // console.log(counter,"counter");

    // alert(type);


    if(type == 'Y'){

        $('#some_days_'+counter+'').show();

    }
    else{

        $('#some_days_'+counter+'').hide();
    }

});

$(document).on('change', '.checkAll', function(){
    var cur_tbl = $(this).closest('table');
    cur_tbl.find('input[type="checkbox"]').prop('checked', $(this).prop('checked'));
    if($(this).prop('checked')){
        cur_tbl.find('input[type="text"], input[type="number"]').prop('disabled',false);
    } else {
        cur_tbl.find('input[type="text"], input[type="number"]').prop('disabled',true);
    }
});

  $(document).on('change', '.sc_chkbox', function(){
    var cur_tbl = $(this).closest('tr');
    cur_tbl.find('input[type="checkbox"]').prop('checked', $(this).prop('checked'));
    if($(this).prop('checked')){
        cur_tbl.find('input[type="text"], input[type="number"]').prop('disabled',false);
    } else {
        cur_tbl.find('input[type="text"], input[type="number"]').prop('disabled',true);
    }
  });
});

$(document).on('change', '.sc_chkbox', function(){
    var tr = $(this).closest('tr');
    if($(this).prop('checked')){
        tr.find('input[type="number"]').prop('disabled', false);
    } else {
        tr.find('input[type="number"]').prop('disabled', true).val('');
    }
});

$(document).on("change", ".item", function () {
    var counter = this.id.split("_").pop();
    if ($(this).val() === "Y") $("#some_days_" + counter).show();
    else $("#some_days_" + counter).hide();
});

////***For close the modal *****///
function RoomTariffmodalclose()
{

    $('#RoomTariffModal').modal('hide');
   
    //$( "div" ).remove( ".modal-backdrop" );
    $('#properties_id_fk').val('');
    $('#room_tariff_hike_from_date').val('');
    $('#transporter_base_station_id_fk').val('').change();
    // $('#vehicle_id_fk').val('0').change();
    $('#category_name_alert').hide();
    $('.submit').removeAttr('disabled');
    $('.form-group').removeClass('input-success-o');
    $('.form-group').removeClass('input-warning-o');
    $('.properties_id_fk').removeClass('input-success-o');
    $('.properties_id_fk').removeClass('input-warning-o');
    $('.room_tariff_hike_from_date').removeClass('input-success-o');
    $('.room_tariff_hike_from_date').removeClass('input-warning-o');
    // $('#btnSave').removeAttr('disabled');
}
////***For close the modal *****///

////***For open the modal *****///
$('#RoomTariffModal').on('shown.bs.modal', function () {
    // $("#state_id_fk").select2('open');
    // $('#transporter_name').focus();
    var id = $("#id").val();
    if(id == '')
    { 
        $('#properties_id_fk').val('').change();
        // $('#vehicle_id_fk').val('0').change();
    }
    $('#category_name_alert').hide();
    // $(".submit").attr("disabled", "disabled");
    $('.form-group').removeClass('input-success-o');
    $('.form-group').removeClass('input-warning-o');
    $('.properties_id_fk').removeClass('input-success-o');
    $('.properties_id_fk').removeClass('input-warning-o');
    $('.room_tariff_hike_from_date').removeClass('input-success-o');
    $('.room_tariff_hike_from_date').removeClass('input-warning-o');
})
////***For open the modal *****///
    
////***For open modal of room tariff adding form  *****///
    
function add_room_tariff()
{
    save_method = 'add';

    $("#id5").val('');
    $('#form5')[0].reset();
    $('.help-block').empty();
    $("#row1").html('');

    // keep property id (because reset clears it)
    var properties_id = $("#properties_id_fk_hidden").val();
    $("#properties_id_fk").val(properties_id);

    $('#RoomTariffModal').modal('show');
    $('.modal-title').text('Add room tariff Details');
    $('#btnSave').text('Save').prop('disabled', false);

    $(".profile-details, .rates, hr, .some_days").remove();

    // load weekdays
    $.ajax({
        url: "<?php echo base_url(); ?>index.php/Room_tariff_management/weekdays_array_list/",
        dataType: 'json',
        type: 'POST',
        success: function(weekdays) {

            // load rooms for this property
            $.ajax({
                url: "<?php echo base_url(); ?>index.php/Room_tariff_management/rooms_array_list/",
                dataType: 'json',
                type: 'POST',
                data: { properties_id: properties_id },
                success: function(rooms) {

                    if (!rooms || rooms.length === 0) {
                        $("#row1").html('');
                        $('#btnSave').prop('disabled', true);
                        alert("No rooms available for this property.");
                        return;
                    }

                    // render your blocks (you already have renderRoomBlocks)
                    renderRoomBlocks(rooms, weekdays, {}, {});
                    $('.some_days').hide();
                }
            });
        }
    });
}


////***For open modal of room tariff adding form  *****///

////***For editing room tariff details from adding modal form  *****///

function toDMY(ymd) {
    if (!ymd) return '';
    // handle "YYYY-MM-DD" or "YYYY-MM-DD hh:mm:ss"
    const parts = ymd.split(' ')[0].split('-'); 
    return parts[2] + '/' + parts[1] + '/' + parts[0];
}


function edit_room_tariff(id)
{
    save_method = 'update';

    // reset
    $('#form5')[0].reset();
    $("#row1").html('');
    $('.help-block').text('');
    $('#id5').val(id);

    $.ajax({
        url: "<?php echo base_url(); ?>index.php/Room_tariff_management/ajax_edit/" + id,
        type: "GET",
        dataType: "json",
        success: function(res) {
            if (!res.status) {
                alert(res.message || "Not found");
                return;
            }

            // ===== 1) Fill header fields =====
            IS_EDIT_MODE = true;

            let propId = res.hike.properties_id_fk;

            // // If option not present (rare), add it:
            // if ($('#properties_id_fk option[value="'+propId+'"]').length === 0) {
            //     $('#properties_id_fk').append(new Option(res.hike.properties_name || propId, propId, true, true));
            // }

            // // Select2 refresh without triggering your rebuild:
            // $('#properties_id_fk').val(propId).trigger('change.select2');
            $("#properties_id_fk").val(res.hike.properties_id_fk);

            // $('#properties_id_fk').val(res.hike.properties_id_fk);

            // DB column is DATE => show as yyyy-mm-dd (or format as you need)
            // $('#room_tariff_hike_from_date').val(res.hike.room_tariff_hike_from_date);
            // $('#room_tariff_hike_to_date').val(res.hike.room_tariff_hike_to_date);
            $('#room_tariff_hike_from_date').val(toDMY(res.hike.room_tariff_hike_from_date));
            $('#room_tariff_hike_to_date').val(toDMY(res.hike.room_tariff_hike_to_date));


            $('#room_tariff_hike_breakfast_rate_adult').val(res.hike.room_tariff_hike_breakfast_rate_adult);
            $('#room_tariff_hike_breakfast_rate_child').val(res.hike.room_tariff_hike_breakfast_rate_child);
            $('#room_tariff_hike_lunch_rate_adult').val(res.hike.room_tariff_hike_lunch_rate_adult);
            $('#room_tariff_hike_lunch_rate_child').val(res.hike.room_tariff_hike_lunch_rate_child);
            $('#room_tariff_hike_dinner_rate_adult').val(res.hike.room_tariff_hike_dinner_rate_adult);
            $('#room_tariff_hike_dinner_rate_child').val(res.hike.room_tariff_hike_dinner_rate_child);
            $('#room_tariff_hike_description').val(res.hike.room_tariff_hike_description);

            // ===== 2) Build lookup maps =====
            // ratesByRoom[room_id] = row from room_tariff_hike_rate
            const ratesByRoom = {};
            (res.rates || []).forEach(r => {
                ratesByRoom[r.room_id_fk] = r;
            });

            // weekByRoomDay[room_id][weekday_id] = weekday rate row
            const weekByRoomDay = {};
            (res.weekRates || []).forEach(w => {
                const roomId = w.room_id_fk;         // IMPORTANT
                const dayId  = w.week_days_id_fk;

                if (!weekByRoomDay[roomId]) weekByRoomDay[roomId] = {};
                weekByRoomDay[roomId][dayId] = w;
            });

            // ===== 3) Render rooms + weekday blocks =====
            renderRoomBlocks(res.rooms || [], res.weekdays || [], ratesByRoom, weekByRoomDay);

            // ===== 4) Open modal =====
            $('#RoomTariffModal').modal('show');
            $('#btnSave').text('Update').prop('disabled', false);
        },
        error: function() {
            alert("Error fetching room tariff details");
        }
    });
}

function renderRoomBlocks(rooms, weekdays, ratesByRoom, weekByRoomDay)
{
    let html = '';
    let num = 1;

    rooms.forEach(room => {
        const roomId = room.properties_room_category_id;
        const rateRow = ratesByRoom[roomId] || null;

        const someType = rateRow ? (rateRow.room_tariff_hike_rate_some_days_type || 'N') : 'N';

        // room header inputs
        html += `
            <hr>
            <div class="profile-details">
                <div class="profile-name px-3 pt-2">
                    <input type="hidden" name="room_tariff_hike_rate_id[${num}]" value="${rateRow ? rateRow.room_tariff_hike_rate_id : ''}">
                    <input type="hidden" name="room_id_fk[${num}]" value="${roomId}">
                    <h4 class="text-primary mb-0">${room.properties_room_category_name}</h4>
                </div>
            </div>

            <div class="row rates">
                <div class="col-md-2">
                    <label><b>Room rate</b> *</label>
                    <input type="number" class="form-control"
                        name="room_tariff_hike_rate_room_rate[${num}]"
                        value="${rateRow ? (rateRow.room_tariff_hike_rate_room_rate || '') : ''}" required>
                </div>

                <div class="col-md-2">
                    <label><b>Adult Extra Bed</b></label>
                    <input type="number" class="form-control"
                        name="room_tariff_hike_rate_adult_with_extra_bed[${num}]"
                        value="${rateRow ? (rateRow.room_tariff_hike_rate_adult_with_extra_bed || '') : ''}" required>
                </div>

                <div class="col-md-2">
                    <label><b>Child Extra Bed</b></label>
                    <input type="number" class="form-control"
                        name="room_tariff_hike_rate_child_with_extra_bed[${num}]"
                        value="${rateRow ? (rateRow.room_tariff_hike_rate_child_with_extra_bed || '') : ''}" required>
                </div>

                <div class="col-md-2">
                    <label><b>Child Sharing</b></label>
                    <input type="number" class="form-control"
                        name="room_tariff_hike_rate_child_sharing_bed[${num}]"
                        value="${rateRow ? (rateRow.room_tariff_hike_rate_child_sharing_bed || '') : ''}" required>
                </div>

                <div class="col-md-2">
                    <label><b>Single</b></label>
                    <input type="number" class="form-control"
                        name="room_tariff_hike_rate_single_occupancy[${num}]"
                        value="${rateRow ? (rateRow.room_tariff_hike_rate_single_occupancy || '') : ''}" required>
                </div>

                <div class="col-md-2">
                    <label><b>Hike on some days</b></label>
                    <select name="room_tariff_hike_rate_some_days_type[${num}]"
                        id="room_tariff_hike_rate_some_days_type_${num}"
                        class="form-control item" required>
                        <option value="N" ${someType === 'N' ? 'selected' : ''}>No</option>
                        <option value="Y" ${someType === 'Y' ? 'selected' : ''}>Yes</option>
                    </select>
                </div>
            </div>
        `;

        // weekdays table
        let rows = '';
        let idx = 1;

        weekdays.forEach(d => {
            const dayId = d.week_days_id;

            // const wdRow = (weekByRoomDay[roomId] && weekByRoomDay[roomId][dayId]) ? weekByRoomDay[roomId][dayId] : null;
            // const checked = wdRow ? 'checked' : '';
            // const disabled = wdRow ? '' : 'disabled';

            const roomKey = String(roomId);
            const dayKey  = String(dayId);

            const wdRow = (weekByRoomDay[roomKey] && weekByRoomDay[roomKey][dayKey])
                ? weekByRoomDay[roomKey][dayKey]
                : null;

            const checked  = wdRow ? 'checked' : '';
            const disabled = wdRow ? '' : 'disabled';

            rows += `
                <tr>
                    <td style="width:50px;">
                        <input type="checkbox" class="form-check-input sc_chkbox"
                            name="week_day_id[${num}][${idx}]"
                            value="${dayId}"
                            ${checked}>
                    </td>
                    <td><strong>${d.week_days_name}</strong></td>

                    <td><input type="number" class="form-control"
                        name="room_amount[${num}][${idx}]"
                        value="${wdRow ? (wdRow.room_tariff_week_days_rate_room_amount || '') : ''}"
                        required ${disabled}></td>

                    <td><input type="number" class="form-control"
                        name="adult_with_extra_bed[${num}][${idx}]"
                        value="${wdRow ? (wdRow.room_tariff_week_days_rate_adult_with_extra_bed || '') : ''}"
                        required ${disabled}></td>

                    <td><input type="number" class="form-control"
                        name="child_with_extra_bed[${num}][${idx}]"
                        value="${wdRow ? (wdRow.room_tariff_week_days_rate_child_with_extra_bed || '') : ''}"
                        required ${disabled}></td>

                    <td><input type="number" class="form-control"
                        name="child_sharing_bed[${num}][${idx}]"
                        value="${wdRow ? (wdRow.room_tariff_week_days_rate_child_sharing_bed || '') : ''}"
                        required ${disabled}></td>

                    <td><input type="number" class="form-control"
                        name="single_occupancy[${num}][${idx}]"
                        value="${wdRow ? (wdRow.room_tariff_week_days_rate_single_occupancy || '') : ''}"
                        required ${disabled}></td>
                </tr>
            `;
            idx++;
        });

        html += `
            <div class="row some_days" id="some_days_${num}" style="${someType === 'Y' ? '' : 'display:none'}">
                <div class="table-responsive">
                    <table class="table table-responsive-md">
                        <thead>
                            <tr>
                                <th style="width:50px;">
                                    <input type="checkbox" class="form-check-input checkAll">
                                </th>
                                <th><strong>Weekday</strong></th>
                                <th><strong>Hike Amount Room</strong></th>
                                <th><strong>Adult with Extra Bed</strong></th>
                                <th><strong>Child With Extra Bed</strong></th>
                                <th><strong>Child Sharing Bed</strong></th>
                                <th><strong>Single Occupancy</strong></th>
                            </tr>
                        </thead>
                        <tbody>${rows}</tbody>
                    </table>
                </div>
            </div>
        `;

        num++;
    });

    $("#row1").html(html);
}

////***For editing room tariff details from adding modal form  *****///

////***For reload the datatable  *****///

function reload_table_tariff()
{
    $table3.ajax.reload(null,false); //reload datatable ajax 
    var id = $("#id5").val();
    if(id)
    {  

        swal("Room tariff details updated successfully", "", "success")
        // var ff = 0;
        
        // ff = "Room tariff details updated successfully";

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
        
        swal("Room tariff details added successfully", "", "success")

        // var ff = 0;
        
        // ff = "Transporter details added successfully";

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

function toYMD(dmy){
  // dmy = dd/mm/yyyy
  if(!dmy) return '';
  var p = dmy.split('/');
  if(p.length !== 3) return '';
  return p[2] + '-' + p[1] + '-' + p[0];
}

function toDMY(ymd){
  if(!ymd) return '';
  var p = ymd.split(' ')[0].split('-');
  if(p.length !== 3) return ymd;
  return p[2] + '/' + p[1] + '/' + p[0];
}

var autoFillTimer = null;

function triggerAutoFillLastTariff(){
  // only for ADD (don’t overwrite edit values)
  if (typeof save_method !== 'undefined' && save_method !== 'add') return;

  clearTimeout(autoFillTimer);
  autoFillTimer = setTimeout(function(){
    autoFillLastTariff();
  }, 250);
}


// Select2 property change
$('#properties_id_fk').on('change.select2', function(){
  triggerAutoFillLastTariff();
});

// Date change
$('#room_tariff_hike_from_date, #room_tariff_hike_to_date').on('change blur', function(){
  triggerAutoFillLastTariff();
});

function autoFillLastTariff()
{
  var propId = $('#properties_id_fk').val();
  var fromD  = $('#room_tariff_hike_from_date').val();

  if (!propId) return;

  $.ajax({
    url: "<?php echo base_url(); ?>index.php/Room_tariff_management/ajax_last_tariff",
    type: "POST",
    dataType: "json",
    data: {
      properties_id_fk: propId,
      room_tariff_hike_from_date: fromD
    },
    success: function(res){
      if(!res.status) return;

      // No previous data -> just keep empty but still show rooms
      var last = res.data;

      // 1) Always load weekdays + rooms for this property
      $.ajax({
        url: "<?php echo base_url(); ?>index.php/Room_tariff_management/weekdays_array_list/",
        type: "POST",
        dataType: "json",
        success: function(weekdays){

          $.ajax({
            url: "<?php echo base_url(); ?>index.php/Room_tariff_management/rooms_array_list/",
            type: "POST",
            dataType: "json",
            data: { properties_id: propId },
            success: function(rooms){

              if (!rooms || rooms.length === 0) {
                $("#row1").html('');
                $('#btnSave').prop('disabled', true);
                alert("No rooms available for this property.");
                return;
              }

              // 2) Fill header values from last.hike (if exists)
              if (last && last.hike) {
                $('#room_tariff_hike_breakfast_rate_adult').val(last.hike.room_tariff_hike_breakfast_rate_adult);
                $('#room_tariff_hike_breakfast_rate_child').val(last.hike.room_tariff_hike_breakfast_rate_child);
                $('#room_tariff_hike_lunch_rate_adult').val(last.hike.room_tariff_hike_lunch_rate_adult);
                $('#room_tariff_hike_lunch_rate_child').val(last.hike.room_tariff_hike_lunch_rate_child);
                $('#room_tariff_hike_dinner_rate_adult').val(last.hike.room_tariff_hike_dinner_rate_adult);
                $('#room_tariff_hike_dinner_rate_child').val(last.hike.room_tariff_hike_dinner_rate_child);
                $('#room_tariff_hike_description').val(last.hike.room_tariff_hike_description);
              } else {
                // Optional: clear header if no last
                // $('#room_tariff_hike_breakfast_rate_adult').val('');
              }

              // 3) Build maps from last.rates + last.weekRates
              var ratesByRoom = {};
              var weekByRoomDay = {};

              if (last && last.rates) {
                last.rates.forEach(function(r){
                  ratesByRoom[String(r.room_id_fk)] = r;
                });
              }

              if (last && last.weekRates) {
                last.weekRates.forEach(function(w){
                  // IMPORTANT: weekRates query includes room_id_fk (via join)
                  var roomId = String(w.room_id_fk);
                  var dayId  = String(w.week_days_id_fk);
                  if (!weekByRoomDay[roomId]) weekByRoomDay[roomId] = {};
                  weekByRoomDay[roomId][dayId] = w;
                });
              }

              // 4) Render room blocks with last values applied
              // NOTE: When auto-fill, set rate_id empty because it's ADD mode
              // Your renderRoomBlocks should set room_tariff_hike_rate_id[...] = '' for add
              renderRoomBlocks(rooms, weekdays, ratesByRoom, weekByRoomDay);

              $('#btnSave').prop('disabled', false);

            }
          });

        }
      });
    }
  });
}

///***For save the room tariff details from adding modal form *****///


function hasRoomsInForm(){
    return $('input[name^="room_id_fk"]').length > 0;
}

function toggleSaveByRooms(){
    if (!hasRoomsInForm()) {
        $('#btnSave').prop('disabled', true);
        // show message near property select or top
        if ($("#noRoomsMsg").length === 0) {
            $("#properties_id_fk").closest('.form-group').append(
                '<div id="noRoomsMsg" class="text-danger mt-1">No rooms available for this property. Cannot save tariff.</div>'
            );
        }
    } else {
        $('#btnSave').prop('disabled', false);
        $("#noRoomsMsg").remove();
    }
}


// function save_tariff()
// {
//     $('.sl-cust-validation').find(':disabled').removeAttr('aria-invalid');

//     var emptyRequiredFields = $('.sl-cust-validation').find('[required]').filter(function() {
//         return $(this).val().trim() === '' && !$(this).is(':disabled');
//     });

//     if (emptyRequiredFields.length > 0) {
//         emptyRequiredFields.attr('aria-invalid', true);
//         return false;
//     }
  
//     if ($('input[name^="room_id_fk"]').length === 0) {
//         alert("No rooms available for this property. Cannot save tariff.");
//         return false;
//     }
//     if (!$("#form").valid()) return false;
    
//     var url;

//     if(save_method == 'add') {
//         $("#id").val('');
//         $('#btnSave').text('saving...'); //change button text
//         $('#btnSave').attr('disabled',true); //set button disable

//         url = "<?php echo base_url();?>index.php/Room_tariff_management/ajax_add/";
//     } 
//     else {

//         $('#btnSave').text('updating...'); //change button text
//         $('#btnSave').attr('disabled',true); //set button disable

//         url = "<?php echo base_url();?>index.php/Room_tariff_management/ajax_update/";
//     }
    
//     var fd = new FormData();
    
//     var form = document.getElementById('form');
//     var data = new FormData(form);
//     // ajax adding data to database
//     $.ajax({
//         url : url,
//         type: "POST",
//         data: data, //$('#form').serialize(),
//         dataType: "JSON",
//         //cache : false,
//         processData: false,
//         enctype: 'multipart/form-data',
//         contentType: false,
//         success: function(data)
//         {

//             if(data.status) //if success close modal and reload ajax table
//             {

//                 $('#RoomTariffModal').modal('hide');
//                 // $('body').removeClass('modal-open');
//                 // $('.modal-backdrop').remove();


//                 reload_table();
//             }
//             else
//             {
//                 for (var i = 0; i < data.inputerror.length; i++) 
//                 {
//                     $('[name="'+data.inputerror[i]+'"]').parent().parent().addClass('input-warning-o'); //select parent twice to select div form-group class and add has-error class
//                     if($('[name="'+data.inputerror[i]+'"]').parent().find('.help-block').length) {
//                         $('[name="'+data.inputerror[i]+'"]').parent().find('.help-block').text(data.error_string[i]); //select span help-block class set text error string
//                     } else {
//                         $('[name="'+data.inputerror[i]+'"]').next().text(data.error_string[i]);
//                     }
//                 }
//             }
//             $('#btnSave').text('save'); //change button text
//             $('#btnSave').attr('disabled',false); //set button enable 
//             $('.help-block').val('hide');

//         },
//         error: function (jqXHR, textStatus, errorThrown)
//         {
//             alert('Error adding / update data');
//             $('#btnSave').text('save'); //change button text
//             $('#btnSave').attr('disabled',false); //set button enable 

//         }
//     });
// }

function save_tariff()
{
    if (!$("#form5").valid()) return false;

    if ($('input[name^="room_id_fk"]').length === 0) {
        alert("No rooms available for this property. Cannot save tariff.");
        return false;
    }

    var url = (save_method === 'add')
        ? "<?php echo base_url();?>index.php/Room_tariff_management/ajax_add/"
        : "<?php echo base_url();?>index.php/Room_tariff_management/ajax_update/";

    $('#btnSave').text(save_method === 'add' ? 'saving...' : 'updating...')
        .prop('disabled', true);

    var form = document.getElementById('form5');
    var data = new FormData(form);

    $.ajax({
        url: url,
        type: "POST",
        data: data,
        dataType: "JSON",
        processData: false,
        contentType: false,
        success: function(resp) {

            if (resp.status) {
                $('#RoomTariffModal').modal('hide');
                reload_table_tariff();
            } else {
                for (var i = 0; i < resp.inputerror.length; i++) {
                    var name = resp.inputerror[i];
                    var msg  = resp.error_string[i];

                    var $el = $('[name="'+name+'"]');
                    $el.closest('.form-group').addClass('input-warning-o');

                    if ($el.parent().find('.help-block').length) {
                        $el.parent().find('.help-block').text(msg);
                    } else {
                        $el.next('.help-block').text(msg);
                    }
                }
            }

            $('#btnSave').text('Save').prop('disabled', false);
        },
        error: function () {
            alert('Error adding / update data');
            $('#btnSave').text('Save').prop('disabled', false);
        }
    });
}

///***For save the room tariff details from adding modal form *****///

////***For reload the datatable for delete *****///

function reload_table_delete_tariff()
{
    $table3.ajax.reload(null,false); //reload datatable ajax
    
    swal("Room tariff details deleted successfully", "", "success")
        // var ff = 0;
        
        // ff = "Room tariff details deleted successfully";

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
    
////***For reload the room tariff datatable for delete *****///

function delete_room_tariff(id)
{
     $.ajax({
        url : "<?php echo base_url();?>index.php/Room_tariff_management/ajax_edit_delete/" + id,
        type: "GET",
        dataType: "JSON",
        success: function(data)
        {
console.log(data.room_tariff_hike_id);
            $('#id6').val(data.room_tariff_hike_id);
            $('#properties_name6').val(data.properties_name);
            $('#deleterow3Modal').modal('show'); // show bootstrap modal when complete loaded
            $('.modal-title6').text('Do you want to delete this record?'); // Set title to Bootstrap modal title
            $('#btnSave6').text('delete');
            $('#btnSave6').attr('disabled',false); //set button enable 

        },
        error: function (jqXHR, textStatus, errorThrown)
        {
            alert('Error get data from ajax');
        }
    });
    
    // $('#deleterowModal').modal('show'); // show bootstrap modal
        // ajax delete data to database 
}

function delete_room_tariff_action()
{
    $('#btnSave6').text('deleting...'); //change button text
    $('#btnSave6').attr('disabled',true); //set button disable 
    var url;

        url = "<?php echo base_url();?>index.php/Room_tariff_management/delete/";
        
    

    // ajax adding data to database
    $.ajax({
        url : url,
        type: "POST",
        data: $('#form6').serialize(),
        dataType: "JSON",
        success: function(data)
        {

            if(data.status) //if success close modal and reload ajax table
            {
                $("#id").val('');
                $('#deleterow3Modal').modal('hide');
                reload_table_delete_tariff();
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

            $('#btnSave6').text('save'); //change button text
            $('#btnSave6').attr('disabled',false); //set button enable 


        },
        error: function (jqXHR, textStatus, errorThrown)
        {
            alert('Error adding / update data');
            $('#btnSave6').text('save'); //change button text
            $('#btnSave6').attr('disabled',false); //set button enable 

        }
    });
}

////***For delete the room tariff details from  database *****///

////***For open modal of room tariff adding form  *****///
    
function add_hike_room_tariff()
{ 
    save_method = 'add';
    $("#id").val('');
    $('#form')[0].reset(); // reset form on modals
    $('.form-group').removeClass('input-warning-o'); // clear error class
    $('.help-block').empty(); // clear error string
    $('#Tariff_uploadedModal').modal('show'); // show bootstrap modal
    $('.modal-title').text('Add Hike under room tariff Details'); // Set Title to Bootstrap modal title
    $('#btnSave').text('save');
    $(".profile-details").remove();
    $(".rates").remove();
    $("hr").remove();
    $(".some_days").remove();
}

////***For open modal of room tariff adding form  *****///

function toDMY(ymd) {
  if (!ymd) return '-';
  var d = ymd.split(' ')[0].split('-'); // YYYY-MM-DD
  if (d.length !== 3) return ymd;
  return d[2] + '/' + d[1] + '/' + d[0];
}

function safe(v) {
  return (v === null || typeof v === 'undefined' || v === '') ? '-' : v;
}

function view_room_tariff(id)
{
  $("#vw_rooms_container").html('');

  $.ajax({
    url: "<?php echo base_url(); ?>index.php/Room_tariff_management/ajax_view/" + id,
    type: "GET",
    dataType: "json",
    success: function(res) {
      if (!res.status) {
        alert(res.message || "Not found");
        return;
      }

      var data = res.data;
      var hike = data.hike;

      // Fill header
      $("#vw_property_name").text(safe(hike.properties_name));
      $("#vw_from_date").text(toDMY(hike.room_tariff_hike_from_date));
      $("#vw_to_date").text(toDMY(hike.room_tariff_hike_to_date));

      $("#vw_created_date").text(safe(toDMY(hike.room_tariff_hike_created_date)));
      $("#vw_created_time").text(safe(hike.room_tariff_hike_created_time));
      $("#vw_created_by").text("By: " + safe(hike.room_tariff_hike_createdby_user_name));

      $("#vw_bf_adult").text(safe(hike.room_tariff_hike_breakfast_rate_adult));
      $("#vw_bf_child").text(safe(hike.room_tariff_hike_breakfast_rate_child));
      $("#vw_lunch_adult").text(safe(hike.room_tariff_hike_lunch_rate_adult));
      $("#vw_lunch_child").text(safe(hike.room_tariff_hike_lunch_rate_child));
      $("#vw_dinner_adult").text(safe(hike.room_tariff_hike_dinner_rate_adult));
      $("#vw_dinner_child").text(safe(hike.room_tariff_hike_dinner_rate_child));
      $("#vw_desc").text(safe(hike.room_tariff_hike_description));

      // Build map: weekRates by room_id + rate_id
      var weekByRoom = {}; // weekByRoom[room_id] = [rows...]
      (data.weekRates || []).forEach(function(w){
        var roomId = String(w.room_id_fk); // from join
        if (!weekByRoom[roomId]) weekByRoom[roomId] = [];
        weekByRoom[roomId].push(w);
      });

      // Render rooms
      var roomsHtml = '';
      (data.rates || []).forEach(function(r){
        var roomId = String(r.room_id_fk);
        var someType = r.room_tariff_hike_rate_some_days_type || 'N';

        roomsHtml += `
          <div class="card mb-3">
            <div class="card-header d-flex align-items-center justify-content-between">
              <div>
                <div class="fw-bold">${safe(r.properties_room_category_name)}</div>
                <div class="small text-muted">Room ID: ${roomId}</div>
              </div>
              <span class="badge bg-${someType === 'Y' ? 'success' : 'secondary'}">
                Some days: ${someType}
              </span>
            </div>

            <div class="card-body">
              <div class="row g-3">
                <div class="col-md-2">
                  <div class="text-muted">Room Rate</div>
                  <div class="fw-bold">${safe(r.room_tariff_hike_rate_room_rate)}</div>
                </div>
                <div class="col-md-2">
                  <div class="text-muted">Adult Extra Bed</div>
                  <div class="fw-bold">${safe(r.room_tariff_hike_rate_adult_with_extra_bed)}</div>
                </div>
                <div class="col-md-2">
                  <div class="text-muted">Child Extra Bed</div>
                  <div class="fw-bold">${safe(r.room_tariff_hike_rate_child_with_extra_bed)}</div>
                </div>
                <div class="col-md-2">
                  <div class="text-muted">Child Sharing Bed</div>
                  <div class="fw-bold">${safe(r.room_tariff_hike_rate_child_sharing_bed)}</div>
                </div>
                <div class="col-md-2">
                  <div class="text-muted">Single Occupancy</div>
                  <div class="fw-bold">${safe(r.room_tariff_hike_rate_single_occupancy)}</div>
                </div>
              </div>

              ${renderWeekdayTable(someType, weekByRoom[roomId])}
            </div>
          </div>
        `;
      });

      $("#vw_rooms_container").html(roomsHtml);

      $("#RoomTariffViewModal").modal('show');
    },
    error: function() {
      alert("Error loading view details");
    }
  });
}

function renderWeekdayTable(someType, weekRows)
{
  if (someType !== 'Y') return '';

  weekRows = weekRows || [];
  if (weekRows.length === 0) {
    return `<div class="mt-3 alert alert-light border">No weekday hike saved for this room.</div>`;
  }

  var trs = '';
  weekRows.forEach(function(w){
    trs += `
      <tr>
        <td><span class="badge bg-light text-dark border">${safe(w.week_days_name)}</span></td>
        <td class="fw-bold">${safe(w.room_tariff_week_days_rate_room_amount)}</td>
        <td>${safe(w.room_tariff_week_days_rate_adult_with_extra_bed)}</td>
        <td>${safe(w.room_tariff_week_days_rate_child_with_extra_bed)}</td>
        <td>${safe(w.room_tariff_week_days_rate_child_sharing_bed)}</td>
        <td>${safe(w.room_tariff_week_days_rate_single_occupancy)}</td>
      </tr>
    `;
  });

  return `
    <div class="mt-4">
      <div class="fw-bold mb-2">Weekday Hike Details</div>
      <div class="table-responsive">
        <table class="table table-bordered align-middle">
          <thead class="table-light">
            <tr>
              <th>Weekday</th>
              <th>Room Amount</th>
              <th>Adult Extra Bed</th>
              <th>Child Extra Bed</th>
              <th>Child Sharing Bed</th>
              <th>Single Occupancy</th>
            </tr>
          </thead>
          <tbody>${trs}</tbody>
        </table>
      </div>
    </div>
  `;
}


</script>