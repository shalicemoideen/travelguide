<script>
////***Latest Jquery form validation*****///

$("#exampleValidation").validate({

    validClass: "success",

    messages: {},

    highlight: function(element) {

      $(element).closest('.form-group').removeClass('has-success').addClass('has-error');

    },

    success: function(element) {

      $(element).closest('.form-group').removeClass('has-error').addClass('has-success');

    },

  });

////***Latest Jquery form validation*****///

////***Latest boostrap dropdown*****///

// $('.lst-flt-select2').select2({ theme: "bootstrap" });

//     $('.lst-flt-select2').change(function(){

//       $(this).valid();

//     });

//   $('#m_staff').select2({

//     theme: "bootstrap"

//   });

//   /* validate */


//   // validation when select change

//   $('#m_staff').change(function(){

//     $(this).valid();

//   });


// $('#user_id_fk').select2({

//     theme: "bootstrap"

//   });

//   /* validate */


//   // validation when select change

//   $('#user_id_fk').change(function(){

//     $(this).valid();

//   });

//   $('#user_id_fk1').select2({

//     theme: "bootstrap"

//   });

//   /* validate */


//   // validation when select change

//   $('#user_id_fk1').change(function(){

//     $(this).valid();

//   });

//    $('#y_staff').select2({

//     theme: "bootstrap"

//   });

//   /* validate */


//   // validation when select change

//   $('#y_staff').change(function(){

//     $(this).valid();

//   });
////***Latest boostrap dropdown*****///

////***Ajax dropdown for add*****///


$(document).ready(function() {
  $('#user_id_fk').change(function() {
  // alert("oo");
    

    var currentLoggedInUserType = $('#currentLoggedInUserType').val();
    if(currentLoggedInUserType == 'A')
    {
      var user_id_fk = $('#user_id_fk').val();
    }
    else if (currentLoggedInUserType == 'C'){

      var user_id_fk = $('#currentLoggedInUserId').val();
    }
    else{

      // var user_id_fk = $('#currentuserid_fk').val();
    }

    if(user_id_fk != '') {
      $.ajax({
        url: "<?php echo base_url(); ?>index.php/Dashboard/fetch_staff_under_company",
        method: "POST",
        data: {
          user_id_fk: user_id_fk
        },
        success: function(data) {
          $('#m_staff').html(data);
          // $('#city').html('<option value="">Select City</option>');
        }
      });
    } else {
      $('#m_staff').html('<option value="0"> Please Select Staff </option>');
      // $('#city').html('<option value="">Select City</option>');
    }    
  });
  
  $('#user_id_fk1').change(function() {
  // alert("oo");
    var currentLoggedInUserType = $('#currentLoggedInUserType').val();
    if(currentLoggedInUserType == 'A')
    {
      var user_id_fk = $('#user_id_fk1').val();
    }
    else if (currentLoggedInUserType == 'C'){

      var user_id_fk = $('#currentLoggedInUserId').val();
    }
    else{

      // var user_id_fk = $('#currentuserid_fk').val();
    }
    if(user_id_fk != '') {
      $.ajax({
        url: "<?php echo base_url(); ?>index.php/Dashboard/fetch_staff_under_company",
        method: "POST",
        data: {
          user_id_fk: user_id_fk
        },
        success: function(data) {
          $('#y_staff').html(data);
          // $('#city').html('<option value="">Select City</option>');
        }
      });
    } else {
      $('#y_staff').html('<option value="0"> Please Select Staff </option>');
      // $('#city').html('<option value="">Select City</option>');
    }    
  });
  
});

$(document).ready(function() {
var currentLoggedInUserType = $('#currentLoggedInUserType').val();
    if(currentLoggedInUserType == 'A')
    {
      var user_id_fk = $('#user_id_fk').val();  
    }
    else if (currentLoggedInUserType == 'C'){

      var user_id_fk = $('#currentLoggedInUserId').val();
    }
    
  // alert("oo");
    var user_id_fk = $('#user_id_fk').val();
    if(user_id_fk != '') {
      $.ajax({
        url: "<?php echo base_url(); ?>index.php/Dashboard/fetch_staff_under_company",
        method: "POST",
        data: {
          user_id_fk: user_id_fk
        },
        success: function(data) {
          $('#m_staff').html(data);
          // $('#city').html('<option value="">Select City</option>');
        }
      });
    } else {
      $('#m_staff').html('<option value="0"> Please Select Staff </option>');
      // $('#city').html('<option value="">Select City</option>');
    }    

  
  
});


$(document).ready(function() {
var currentLoggedInUserType = $('#currentLoggedInUserType').val();
    if(currentLoggedInUserType == 'A')
    {
      var user_id_fk = $('#user_id_fk1').val();  
    }
    else if (currentLoggedInUserType == 'C'){

      var user_id_fk = $('#currentLoggedInUserId').val();
    }
    
  // alert("oo");
    var user_id_fk = $('#user_id_fk').val();
    if(user_id_fk != '') {
      $.ajax({
        url: "<?php echo base_url(); ?>index.php/Dashboard/fetch_staff_under_company",
        method: "POST",
        data: {
          user_id_fk: user_id_fk
        },
        success: function(data) {
          $('#y_staff').html(data);
          // $('#city').html('<option value="">Select City</option>');
        }
      });
    } else {
      $('#y_staff').html('<option value="0"> Please Select Staff </option>');
      // $('#city').html('<option value="">Select City</option>');
    }    

  
  
});

////***Ajax dropdown for add*****///

////***Latest Jquery form validation for adding form*****///
		
$("#exampleValidation").validate({

			validClass: "success",
			rules: {
					
					// booking_work_order_end_date: { greaterThan: "#booking_work_order_date" }
				
			},
			messages: {
				
			},
			
			highlight: function(element) {
				$(element).closest('.form-group').removeClass('has-success').addClass('has-error');
			},
			success: function(element) {
				$(element).closest('.form-group').removeClass('has-error').addClass('has-success');
			},

		});



////***Latest Jquery form validation for adding form*****///

////***Latest boostrap dropdown*****///
$(document).ready(function(){
$('.lst-flt-select2').select2({ theme: "bootstrap" });

    $('.lst-flt-select2').change(function(){

      $(this).valid();

    });

});
		
////***Latest boostrap dropdown*****///



////***Date picker*****///
$('#start_date').datetimepicker({
			format: 'DD/MM/YYYY',
		}).on("dp.change", function (e) {
			
			  var d = $('#start_date').val(); dArr = d.split('/'),
			  start = new Date(dArr[1] + "-" + dArr[0] + "-" + dArr[2]).getTime(); 
			  var d = $('#end_date').val(); dArr = d.split('/'),
			  end = new Date(dArr[1] + "-" + dArr[0] + "-" + dArr[2]).getTime(); 
			  var days   = (end - start)/1000/60/60/24;
			
			if (start > end){
			// alert("seleted date is greater than start date");
			var ff = 0;
				ff = "Selected start date is greater than end date";

				 $("#validation_dynamic_table").val(ff);
				 
				 
				 var options = {

                'title': '',

                'style': 'error',

                'message': ff,

                // 'success': 'warning',
				'icon': 'warning',

                };
				
				var n1 = new notify(options); 

                n1.show(); 

                setTimeout(function(){ n1.hide(); }, 10000);
			$('#end_date').val('');
			}
		});
$('#end_date').datetimepicker({
			format: 'DD/MM/YYYY',
		}).on("dp.change", function (e) {
			
			  var d = $('#start_date').val(); dArr = d.split('/'),
			  start = new Date(dArr[1] + "-" + dArr[0] + "-" + dArr[2]).getTime(); 
			  var d = $('#end_date').val(); dArr = d.split('/'),
			  end = new Date(dArr[1] + "-" + dArr[0] + "-" + dArr[2]).getTime(); 
			  var days   = (end - start)/1000/60/60/24;
			
			if (start > end){
			// alert("seleted date is greater than start date");
			var ff = 0;
				ff = "Selected end date is less than end date";

				 $("#validation_dynamic_table").val(ff);
				 
				 
				 var options = {

                'title': '',

                'style': 'error',

                'message': ff,

                // 'success': 'warning',
				'icon': 'warning',

                };
				
				var n1 = new notify(options); 

                n1.show(); 

                setTimeout(function(){ n1.hide(); }, 10000);
			$('#end_date').val('');
			}
		});
		

////***Date picker*****///

////***searching button*****///
$('#search').click(function () {
        
        $table.ajax.reload();
    });
////***searching button*****///

////***Reload data-table ajax*****///
function reload_table()
{
    $table.ajax.reload(null,false); //reload datatable ajax 
}
////***Reload data-table ajax*****///

////***Filter button hide and show*****///
$(document).ready(function () {
    $("#btn").click(function () {
        $("#Create").toggle();
    });
});
////***Filter button hide and show*****///


////***Listing table*****///

var save_method; //for save method string
var table;

  $(document).ready(function() {
  
    $table = $('#Activites_table').DataTable( {
        "searching": false,
		"processing": true,
        "serverSide": true,
		"paging": false,
         "info":  false,
		"aLengthMenu": [[10, 25, 50, -1], [10, 25, 50, "All"]],
        // "bDestroy" : true,
        dom: 'lBfrtip',
			buttons: [
				
                                
                               
			],
        "ajax": {
            "url": "<?php echo base_url();?>index.php/dashboard/get/",
            "type": "POST",
            "data" : function (d) {
						d.activity_type = $("#activity_type").val();
						d.activity_action = $("#activity_action").val();
						d.activity_by_userid = $("#activity_by_userid").val();
						d.start_date = $("#start_date").val();
						d.end_date = $("#end_date").val();
							

           }
        },
		// "ajax": {
            // "url": "<?php echo site_url('States/get')?>",
            // "type": "POST"
        // },
        "createdRow": function ( row, data, index ) {
          
//            $('td',row).eq(0).html(index+1);
           // $table.column(0).nodes().each(function(node,index,dt){
            // $table.cell(node).data(index+1);
            // });
			
			$table.column(2).nodes().each(function(node,index,dt){
			
				// $table.cell(node).data(data['board_serial_number']+data['board_width']+data['board_length']);
				// $table.cell(node).data("BK/no"  +data['booking_number']);
				//$('td',row).eq(1).html("BK/no"  +data['booking_number']);
		    });
			
			$('td', row).eq(14).html('<div class="btn-group dropdown"><button class="btn btn-primary btn-sm dropdown-toggle" type="button" data-toggle="dropdown" style="font-size:13px;">Action</button><ul class="dropdown-menu" role="menu"><li><a class="dropdown-item" href="<?php echo base_url();?>index.php/Booking/view/'+data['booking_id']+'" target="_blank">View details</a> </li><li><a class="dropdown-item" href="<?php echo base_url();?>index.php/Booking/receipt/'+data['booking_id']+'" target="_blank">Receipt</a> </li><li><a class="dropdown-item" href="javascript:void(0)" onclick="return confirmDelete('+data['booking_id']+')">Delete</a> </li></ul></div>');
           
			

			
						
            // $('td', row).eq(10).html('<div class="form-button-action"><a  data-toggle="tooltip" title="" class="btn btn-link btn-primary btn-lg" data-original-title="Edit Task" href="<?php echo base_url();?>index.php/Board_fixing/edit/'+data['board_fixing_id']+'" ><i class="fa fa-edit"></i></a><button type="button" data-toggle="tooltip" title="" class="btn btn-link btn-danger" data-original-title="Remove" href="javascript:void(0)" onclick="return delete_ledger('+data['ledger_id']+')"><i class="fa fa-times"></i></button></div>');
           },
		
		"drawCallback": function( settings ) {
                displaySelectByUserType();
            },
			
        "columns": [
            { "data": "activity_type", "orderable": false },            
            { "data": "activity_action", "orderable": false },
            { "data": "activity_by_username", "orderable": false },
			{ "data": "activity_date_time", "orderable": false },
            { "data": "activity_description", "orderable": false },

        ]
        
    } );
    
  
//set input/textarea/select event when change value, remove class error and remove text help block 
    // $("input").change(function(){
    //     $(this).parent().parent().removeClass('has-error');
    //     // $(this).parent().parent().removeClass('has-success');
    //     $(this).next().empty();
    // });
    // $("textarea").change(function(){
    //     $(this).parent().parent().removeClass('has-error');
		// // $(this).parent().parent().addClass('has-success');
    //     $(this).next().empty();
    // });
    // $("select").change(function(){
    //     $(this).parent().parent().removeClass('has-error');
    //     // $(this).parent().parent().removeClass('select2-hidden-accessible');
    //     $(this).next().empty();
    // });  
  });
    
 
////***Listing table*****///

/******************* dashboard chart based on number of task ********************/
  //  makechart();
  // function makechart()
  // {
  //   var m_month = $('#m_month').val();
  //   var m_year = $('#m_year').val();
  //   var m_staff = $('#m_staff').val();
  //   var y_year = $('#y_year').val();
  //   var y_staff = $('#y_staff').val();
  //   $.ajax({
  //     url:"<?=base_url()?>dashboard/graph_data",
  //     method:"GET",
  //     data:{m_month: m_month, m_year: m_year, m_staff: m_staff, y_year: y_year, y_staff: y_staff },
  //     dataType:"JSON",
  //     success:function(data)
  //     { 
  //       var ctx = $('#mbar_chart');
	// 	var month_total_income = data.month.total_income;
	// 	var month_total_expense = data.month.total_expense;
	// 	var total_pending = data.month.total_pending;
	// 	var total_task1 = parseFloat(month_total_income) + parseFloat(month_total_expense) + parseFloat(total_pending);
		
	// 	var month_income_amount = data.month.income_amount;
	// 	var month_expense_amount = data.month.expense_amount;
	// 	var total_daytask1 = parseFloat(month_income_amount) + parseFloat(month_expense_amount);
  //       var data1 = {
  //         labels: data.month.labels,
  //         datasets: [{
  //           label: "Total task "+total_task1
  //         },{
  //           label: "Completed task "+data.month.total_income,
  //           backgroundColor: "#0DC143",
  //           data: data.month.income_amount
  //         }, {
  //           label: "Not completed task "+data.month.total_expense,
  //           backgroundColor: "rgba(252, 3, 45, 0.75)",
  //           data: data.month.expense_amount
  //         }, {
  //           label: "Pending task "+data.month.total_pending,
  //           backgroundColor: "#FFB900",
  //           data: data.month.pending_amount
  //         }]
  //       };

  //       var myBarChart = new Chart(ctx, {
  //         type: 'bar',
  //         data: data1,
  //         options: {
  //           barValueSpacing: 30,
  //           scales: {
  //             yAxes: [{
  //               ticks: {
  //                 min: 0,
  //               }
  //             }]
  //           }
  //         }
  //       });

  //       var ctx2 = $('#ybar_chart');
	// 	var year_total_income = data.year.total_income;
	// 	var year_total_expense = data.year.total_expense;
	// 	var year_total_pending = data.year.total_pending;
	// 	var total_task2 = parseFloat(year_total_income) + parseFloat(year_total_expense) + parseFloat(year_total_pending);
		
  //       var data2 = {
  //         labels: data.year.labels,
  //         datasets: [{
  //           label: "Total task "+total_task2
  //         },{
  //           label: "Completed task "+data.year.total_income,
  //           backgroundColor: "#0DC143",
  //           data: data.year.income_amount
  //         }, {
  //           label: "Not completed task "+data.year.total_expense,
  //           backgroundColor: "rgba(252, 3, 45, 0.75)",
  //           data: data.year.expense_amount
  //         }, {
  //           label: "Pending task "+data.year.total_pending,
  //           backgroundColor: "#FFB900",
  //           data: data.year.pending_amount
  //         }]
  //       };

  //       var myBarChart2 = new Chart(ctx2, {
  //         type: 'bar',
  //         data: data2,
  //         options: {
  //           barValueSpacing: 20,
  //           scales: {
  //             yAxes: [{
  //               ticks: {
  //                 min: 0,
  //               }
  //             }]
  //           }
  //         }
  //       });
  //     }
  //   });
  // }


/******************* dashboard chart based on time ********************/
   makechart();
  function makechart()
  {
    var m_month = $('#m_month').val();
    var m_year = $('#m_year').val();
    var m_staff = $('#m_staff').val();
    var y_year = $('#y_year').val();
    var y_staff = $('#y_staff').val();
    $.ajax({
      url:"<?=base_url()?>dashboard/graph_data1",
      method:"GET",
      data:{m_month: m_month, m_year: m_year, m_staff: m_staff, y_year: y_year, y_staff: y_staff },
      dataType:"JSON",
      success:function(data)
      { 
        var ctx = $('#mbar_chart');
    var month_total_assigned = data.month.total_assigned;
    var month_total_occupied = data.month.total_occupied;
    var total_lost = data.month.total_lost;
    var total_task1 = parseFloat(month_total_assigned) + parseFloat(month_total_occupied) + parseFloat(total_lost);
    
    var month_assigned_amount = data.month.assigned_amount;
    var month_occupied_amount = data.month.occupied_amount;
    var total_daytask1 = parseFloat(month_assigned_amount) + parseFloat(month_occupied_amount);
        var data1 = {
          labels: data.month.labels,
          datasets: [{
            label: "Total duration "+total_task1
          },{
            label: "Assigned duration "+data.month.total_assigned,
            backgroundColor: "#FFB900",
            data: data.month.assigned_amount
          }, {
            label: "Completed duration "+data.month.total_occupied,
            backgroundColor: "#0DC143",
            data: data.month.occupied_amount
          }, {
            label: "Extra duration "+data.month.total_lost,
            backgroundColor: "rgba(252, 3, 45, 0.75)",
            data: data.month.lost_amount
          }]
        };

        var myBarChart = new Chart(ctx, {
          type: 'bar',
          data: data1,
          options: {
            barValueSpacing: 30,
            scales: {
              yAxes: [{
                ticks: {
                  min: 0,
                }
              }]
            }
          }
        });

        var ctx2 = $('#ybar_chart');
    var year_total_assigned = data.year.total_assigned;
    var year_total_occupied = data.year.total_occupied;
    var year_total_lost = data.year.total_lost;
    var total_task2 = parseFloat(year_total_assigned) + parseFloat(year_total_occupied) + parseFloat(year_total_lost);
    
        var data2 = {
          labels: data.year.labels,
          datasets: [{
            label: "Total duration "+total_task2
          },{
            label: "Assigned duration "+data.year.total_assigned,
            backgroundColor: "#0DC143",
            data: data.year.assigned_amount
          }, {
            label: "Completed duration "+data.year.total_occupied,
            backgroundColor: "rgba(252, 3, 45, 0.75)",
            data: data.year.occupied_amount
          }, {
            label: "Extra duration "+data.year.total_lost,
            backgroundColor: "#FFB900",
            data: data.year.lost_amount
          }]
        };

        var myBarChart2 = new Chart(ctx2, {
          type: 'bar',
          data: data2,
          options: {
            barValueSpacing: 20,
            scales: {
              yAxes: [{
                ticks: {
                  min: 0,
                }
              }]
            }
          }
        });
      }
    });
  }

  ////***For open modal of checking form  *****///
  
function add_checkin()
{
    save_method = 'checkin';
    $('#form11')[0].reset(); // reset form on modals
    $('.form-group').removeClass('has-error'); // clear error class
    $('.help-block').empty(); // clear error string
    $('#addCheckinModal').modal('show'); // show bootstrap modal
    $('.modal-title').text('Do you want to check-in ?'); // Set Title to Bootstrap modal title
    $('#btnSave').removeAttr('disabled');
}

////***For open modal of checking form  *****///

////***For editing checking details from adding modal form  *****///

function edit_checking(id)
{
    save_method = 'checkout';
    $('#form11')[0].reset(); // reset form on modals
    $('.form-group').removeClass('has-error'); // clear error class
    $('.help-block').empty(); // clear error string
  
    //Ajax Load data from ajax
    $.ajax({
        url : "<?php echo base_url();?>index.php/Task_mng/ajax_edit_checkin/" + id,
        type: "GET",
        dataType: "JSON",
        success: function(data)
        {
      
            $('[name="id11"]').val(data.attendance_id);
            //$('[name="task_management_description"]').val(data.task_management_description);
            $('#addCheckinModal').modal('show'); // show bootstrap modal when complete loaded
            $('.modal-title').text('Do you want to check-out ?'); // Set title to Bootstrap modal title
            $('#btnSave').removeAttr('disabled');
      
      
      const datetime1 = data. attendance_checkin_datetime;
            console.log(datetime1);


        var d=new Date();
      var dd=d.getDate();
      var mm=d.getMonth()+1;
      var yy=d.getFullYear();
      var newdate2=yy+"/"+mm+"/"+dd;

      // var MyDate = new Date();
      // var MyDateString;

      // MyDate.setDate(MyDate.getDate() + 20);

      // MyDateString = ('0' + MyDate.getDate()).slice(-2) + '/' + ('0' + (MyDate.getMonth()+1)).slice(-2) + '/' + MyDate.getFullYear();

        var d = new Date();
      var time = d.getHours() + ":" + d.getMinutes() + ":" + d.getSeconds();

      const datetime2 = newdate2 + ' ' + time;

      //document.write(datetime);
        console.log(datetime2);              

      updateDuration3(datetime1, datetime2);
      

      
        },
        error: function (jqXHR, textStatus, errorThrown)
        {
            alert('Error get data from ajax');
        }
    });
}

function updateDuration3(startTime, endTime) {
    var ms = moment(endTime, 'YYYY/MM/DD HH:mm:ss').diff(moment(startTime, 'YYYY/MM/DD HH:mm:ss')),
        dt = moment.duration(ms),
        h = Math.floor(dt.asHours()),
        m = moment.utc(ms).format('mm');

    $('#totalhour').val(h + ' hours, ' + m + ' minutes');
    $('#totalhournum').val(h + '.' + m );



}
////***For editing checking details from adding modal form  *****///

////***For reload the checking  *****///

function reload_table_checking()
{
    //$table.ajax.reload(null,false); //reload datatable ajax
  
  

  var id1 = $("#id11").val();
  if(id1)
  {
    var ff = 0;
    
    ff = "Check out successfully";

     $("#checkin").val(ff);
    
     
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

    var ff = 0;
    
    ff = "Check in successfully";

     $("#checkout").val(ff);
    
     
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

////***For reload the checking  *****///

///***checking modal form *****///

function check_in()
{
    $('#btnSave').text('saving...'); //change button text
    $('#btnSave').attr('disabled',true); //set button disable 
    var url;

    if(save_method == 'checkin') {
        url = "<?php echo base_url();?>index.php/Task_mng/ajax_check_in/";
    $('#id11').val('');
    $('#checkstatus').val(0);
    } 
  if(save_method == 'checkout') {
        url = "<?php echo base_url();?>index.php/Task_mng/ajax_check_out/";
        $('#checkstatus').val(2);
    }

    // var checkstatus = $("#checkstatus").val();
  // alert(checkstatus);
  // if(checkstatus == '2'){
    
  //  alert("sd11");
  //  $("#checkin").show();
  //  $("#checkout").hide();

  // }else{

    

  //  alert("sd00");
  //  $("#checkin").hide();
  //  $("#checkout").show();

  // }

    // ajax adding data to database
    $.ajax({
        url : url,
        type: "POST",
        data: $('#form11').serialize(),
        dataType: "JSON",
        success: function(data)
        {

            if(data.status) //if success close modal and reload ajax table
            {
                
        $('#addCheckinModal').modal('hide');
                reload_table_checking();
                location.reload();
            }
            else
            {
                for (var i = 0; i < data.inputerror.length; i++) 
                {
                    $('[name="'+data.inputerror[i]+'"]').parent().parent().addClass('has-error'); //select parent twice to select div form-group class and add has-error class
                    $('[name="'+data.inputerror[i]+'"]').next().text(data.error_string[i]); //select span help-block class set text error string
                }
            }
            $('#btnSave').text('save'); //change button text
            $('#btnSave').attr('disabled',false); //set button enable 


        },
        error: function (jqXHR, textStatus, errorThrown)
        {
            alert('Error adding / update data');
            $('#btnSave').text('save'); //change button text
            $('#btnSave').attr('disabled',false); //set button enable 

        }
    });
}

///***checking modal form *****///
</script>