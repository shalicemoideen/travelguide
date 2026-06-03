<!DOCTYPE html>
<html lang="en" class="h-100">


<!-- Mirrored from travl.dexignlab.com/django/xhtml/page-login.html by HTTrack Website Copier/3.x [XR&CO'2014], Fri, 11 Jul 2025 04:27:16 GMT -->
<head>
    <meta charset="utf-8">
	<meta http-equiv="X-UA-Compatible" content="IE=edge">
	<meta name="keywords" content="" />
	<meta name="author" content="" />
	<meta name="robots" content="" />
	<meta name="viewport" content="width=device-width, initial-scale=1">
	<meta name="description" content="Travl - Django Hotel Admin Dashboard Bootstrap Template" />
	<meta property="og:title" content="Travl - Django Hotel Admin Dashboard Bootstrap Template" />
	<meta property="og:description" content="Travl - Django Hotel Admin Dashboard Bootstrap Template" />
	<meta property="og:image" content="../social-image.html" />
	<meta name="format-detection" content="telephone=no">
	
	<!-- PAGE TITLE HERE -->
	<title>Travl - Django Hotel Admin Dashboard Bootstrap Template</title>
	
	<!-- FAVICONS ICON -->
	<link rel="shortcut icon" type="<?php echo base_url();?>assets/image/png" href="<?php echo base_url();?>assets/images/favicon.png" />
    <link href="<?php echo base_url();?>assets/css/style.css" rel="stylesheet">
    	<link href="<?php echo base_url();?>assets/vendor/jquery-nice-select/css/nice-select.css" rel="stylesheet">
	<link href="<?php echo base_url();?>assets/vendor/owl-carousel/owl.carousel.css" rel="stylesheet">
	<link href="<?php echo base_url();?>assets/vendor/bootstrap-datetimepicker/css/bootstrap-datetimepicker.min.css" rel="stylesheet">
	
	<!-- Daterange picker -->
    <link href="<?php echo base_url();?>assets/vendor/bootstrap-daterangepicker/daterangepicker.css" rel="stylesheet">
    <!-- Clockpicker -->
    <link href="<?php echo base_url();?>assets/vendor/clockpicker/css/bootstrap-clockpicker.min.css" rel="stylesheet">
    <!-- asColorpicker -->
    <link href="<?php echo base_url();?>assets/vendor/jquery-asColorPicker/css/asColorPicker.min.css" rel="stylesheet">
    <!-- Material color picker -->
    <link href="<?php echo base_url();?>assets/vendor/bootstrap-material-datetimepicker/css/bootstrap-material-datetimepicker.css" rel="stylesheet">

	<link href="<?php echo base_url();?>assets/vendor/sweetalert2/dist/sweetalert2.min.css" rel="stylesheet">
	<link href="<?php echo base_url();?>assets/vendor/jquery-nice-select/css/nice-select.css" rel="stylesheet">

	<!-- Datatable -->
    <link href="<?php echo base_url();?>assets/vendor/datatables/css/jquery.dataTables.min.css" rel="stylesheet">

     <!-- Datable export button CSS -->
	<link href="<?php echo base_url();?>assets/css/buttons.dataTables.min.css" rel="stylesheet" type="text/css" />
	
    <!-- Custom Stylesheet -->
	<link href="<?php echo base_url();?>assets/vendor/jquery-nice-select/css/nice-select.css" rel="stylesheet">
	<link rel="stylesheet" href="<?php echo base_url();?>assets/vendor/select2/css/select2.min.css">
	
	<!-- Style css -->
	<link href="<?php echo base_url();?>assets/css/style.css" rel="stylesheet">

	<!-- Notification CSS -->
	<link href='<?php echo base_url();?>assets/css/jquery.noty.css' rel='stylesheet'>
    <link href='<?php echo base_url();?>assets/css/noty_theme_default.css' rel='stylesheet'>
	<link href="<?php echo base_url();?>assets/css/notify.css" rel="stylesheet"/>
	
	 <!-- Pick date -->
    <link rel="stylesheet" href="<?php echo base_url();?>assets/vendor/pickadate/themes/default.css">
    <link rel="stylesheet" href="<?php echo base_url();?>assets/vendor/pickadate/themes/default.date.css">
	<link href="https://fonts.googleapis.com/icon?family=Material+Icons" rel="stylesheet">

</head>

<body class="vh-100">
    <div class="authincation h-100">
        <div class="container h-100">
            <div class="row justify-content-center h-100 align-items-center">
                <div class="col-md-6">
                    <div class="authincation-content">
                        <div class="row no-gutters">
                            <div class="col-xl-12">
                                <div class="auth-form">
									<div class="text-center mb-3">
										<a href="#"><img src="<?php echo base_url();?>assets/images/Royale-logo-new.png" alt=""></a>
									</div>
                                    <h4 class="text-center mb-4">Login in your account</h4>
                                    <form id="exampleValidation"  method="POST">
                                        <div class="mb-3">
                                            <label class="mb-1"><strong>Username</strong></label>
                                            <input type="text" id="username" name="username" class="form-control" placeholder="Username">
                                        </div>
                                        <div class="mb-3">
                                            <label class="mb-1"><strong>Password</strong></label>
                                            <input type="password" id="password" name="password" class="form-control" placeholder="Password">

					<input type="hidden" id="validation_password"/> 
					<b><span id="Password_alert" style="color: red"></span></b>
                                        </div>
                                        <div class="text-center">
                                            <button type="submit" id="submit" class="btn btn-primary btn-block">Login</button>
                                        </div>
                                    </form>
                                </div>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div>


    <!--**********************************
        Scripts
    ***********************************-->
    <!-- Required vendors -->
	<script src="<?php echo base_url();?>assets/vendor/global/global.min.js"></script>

	<script src="<?php echo base_url();?>assets/vendor/jquery-nice-select/js/jquery.nice-select.min.js"></script>
	
	<!-- Apex Chart -->
	
	<script src="<?php echo base_url();?>assets/vendor/apexchart/apexchart.js"></script>
	
	
	<!-- Chart piety plugin files -->
	
	
	<!-- Dashboard 1 -->
	<script src="<?php echo base_url();?>assets/js/dashboard/dashboard-1.js"></script>
	
	<script src="<?php echo base_url();?>assets/vendor/owl-carousel/owl.carousel.js"></script>
	<script src="<?php echo base_url();?>assets/vendor/bootstrap-datetimepicker/js/moment.js"></script>
	<script src="<?php echo base_url();?>assets/vendor/bootstrap-datetimepicker/js/bootstrap-datetimepicker.min.js"></script>
	
	<!-- Required vendors -->
    <script src="<?php echo base_url();?>assets/vendor/global/global.min.js"></script>
    <script src="<?php echo base_url();?>assets/vendor/chart.js/Chart.bundle.min.js"></script>
	<!-- Apex Chart -->
	<script src="<?php echo base_url();?>assets/vendor/apexchart/apexchart.js"></script>
	
	<script src="<?php echo base_url();?>assets/vendor/sweetalert2/dist/sweetalert2.min.js"></script>
    <script src="<?php echo base_url();?>assets/js/plugins-init/sweetalert.init.js"></script>

	<script src="<?php echo base_url();?>assets/vendor/jquery-nice-select/js/jquery.nice-select.min.js"></script>

    <!-- Datatable -->
    <script src="<?php echo base_url();?>assets/vendor/datatables/js/jquery.dataTables.min.js"></script>
    <script src="<?php echo base_url();?>assets/js/plugins-init/datatables.init.js"></script>

     <!-- Daterangepicker -->
    <!-- momment js is must -->
    <script src="<?php echo base_url();?>assets/vendor/moment/moment.min.js"></script>
    <script src="<?php echo base_url();?>assets/vendor/bootstrap-daterangepicker/daterangepicker.js"></script>
    <!-- clockpicker -->
    <script src="<?php echo base_url();?>assets/vendor/clockpicker/js/bootstrap-clockpicker.min.js"></script>
    <!-- asColorPicker -->
    <script src="<?php echo base_url();?>assets/vendor/jquery-asColor/jquery-asColor.min.js"></script>
    <script src="<?php echo base_url();?>assets/vendor/jquery-asGradient/jquery-asGradient.min.js"></script>
    <script src="<?php echo base_url();?>assets/vendor/jquery-asColorPicker/js/jquery-asColorPicker.min.js"></script>
    <!-- Material color picker -->
    <script src="<?php echo base_url();?>assets/vendor/bootstrap-material-datetimepicker/js/bootstrap-material-datetimepicker.js"></script>
    <!-- pickdate -->
    <script src="<?php echo base_url();?>assets/vendor/pickadate/picker.js"></script>
    <script src="<?php echo base_url();?>assets/vendor/pickadate/picker.time.js"></script>
    <script src="<?php echo base_url();?>assets/vendor/pickadate/picker.date.js"></script>



    <!-- Daterangepicker -->
    <script src="<?php echo base_url();?>assets/js/plugins-init/bs-daterange-picker-init.js"></script>
    <!-- Clockpicker init -->
    <script src="<?php echo base_url();?>assets/js/plugins-init/clock-picker-init.js"></script>
    <!-- asColorPicker init -->
    <script src="<?php echo base_url();?>assets/js/plugins-init/jquery-asColorPicker.init.js"></script>
    <!-- Material color picker init -->
    <script src="<?php echo base_url();?>assets/js/plugins-init/material-date-picker-init.js"></script>
    <!-- Pickdate -->
    <script src="<?php echo base_url();?>assets/js/plugins-init/pickadate-init.js"></script>

    <script src="<?php echo base_url();?>assets/vendor/jquery-nice-select/js/jquery.nice-select.min.js"></script>
    <script src="<?php echo base_url();?>assets/vendor/select2/js/select2.full.min.js"></script>
    <script src="<?php echo base_url();?>assets/js/plugins-init/select2-init.js"></script>

	
	<script src="<?php echo base_url();?>assets/js/custom.min.js"></script>
	<script src="<?php echo base_url();?>assets/js/dlabnav-init.js"></script>
	<script src="<?php echo base_url();?>assets/js/demo.js"></script>
	<script src="<?php echo base_url();?>assets/js/styleSwitcher.js"></script>
	
	<!-- jQuery Validation -->
	<script src="<?php echo base_url();?>assets/js/plugin/jquery.validate/jquery.validate.min.js"></script>
	<script src="<?php echo base_url();?>assets/js/plugin/jquery.validate/additional-methods.min.js"></script>
	
	<!-- Notification -->
	<script src="<?php echo base_url();?>assets/js/jquery.noty.js"></script>
	<script src="<?php echo base_url();?>assets/js/notify.js"></script>
	<!-- <script src="<?php echo base_url();?>assets/js/notification.js"></script> -->

	<!-- Magnific Popup -->
	<script src="<?php echo base_url();?>assets/js/plugin/jquery.magnific-popup/jquery.magnific-popup.min.js"></script>
    <!-- Required vendors -->
    <script src="<?php echo base_url();?>assets/vendor/global/global.min.js"></script>
    <script src="<?php echo base_url();?>assets/js/custom.min.js"></script>
    <script src="<?php echo base_url();?>assets/js/dlabnav-init.js"></script>
	<script src="<?php echo base_url();?>assets/js/styleSwitcher.js"></script>
</body>

<!-- Mirrored from travl.dexignlab.com/django/xhtml/page-login.html by HTTrack Website Copier/3.x [XR&CO'2014], Fri, 11 Jul 2025 04:27:17 GMT -->
</html>
<script type="text/javascript">


		// $("#exampleValidation").validate({
		// 	validClass: "success",
		// 	rules: {
		// 		gender: {required: true},
		// 		confirmpassword: {
		// 			equalTo: "#password"
		// 		},
		// 		birth: {
		// 			date: true
		// 		},
		// 		uploadImg: {
		// 			required: true, 
		// 		},
		// 	},
		// 	highlight: function(element) {
		// 		$(element).closest('.form-group').removeClass('has-success').addClass('has-error');
		// 	},
		// 	success: function(element) {
		// 		$(element).closest('.form-group').removeClass('has-error').addClass('has-success');
		// 	},
		// });
		
	

$(document).ready(function () {
 var isFormValid = false;

function checkFormValidity1(){
// var user_type = $('#user_type').val();
var username = $('#username').val();

isFormValid = true;
 $.ajax({
			url: "<?php echo base_url(); ?>index.php/Login/checkUsername/",
			dataType: 'json',
			// data: {value:username,user_type:user_type},
			data: {value:username},
			type: 'POST',
			async: false,
			success:
			function(data) {
				
				
				// console.log(user_name);
				// console.log(data);
				var ff = 0;
				
				// alert(loan_amount);exit();
				if(data){
				 
				 $('#User_name_alert').hide();
				 // alert("no");
			return true;
				
			
			
			}
			else{
			
			isFormValid = false;
				 
				ff = "Username is not valid";

				 $("#validation_username").val(ff);
				 $("#username").val('');
				 $('#username').focus();
				 $('.form-group').addClass('has-error');
				 var Data1 = "User name is incorrect";
				 $('#User_name_alert').html(Data1);
                 $('#User_name_alert').show();
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
				
				// alert("Yes");
				return false;
				
				
			
			}
		}
				 
	});
}

$("#exampleValidation").submit(function (e) {
		// alert("Success");
		console.log(isFormValid,"1");
            checkFormValidity1();
			console.log(isFormValid,"2");
			// // setTimeout(function(){  }, 20000);
            if(isFormValid){
               
            }else{
                e.preventDefault();
            }
            
        // });
});
});

$(document).ready(function () {
 var isFormValid = false;

function checkFormValidity2(){
// var user_type = $('#user_type').val();
var password = $('#password').val();

isFormValid = true;
 $.ajax({
			url: "<?php echo base_url(); ?>index.php/Login/checkPassword/",
			dataType: 'json',
			// data: {value:password,user_type:user_type},
			data: {value:password},
			type: 'POST',
			async: false,
			success:
			function(data) {
				
				
				// console.log(user_name);
				// console.log(data);
				var tt = 0;
				
				// alert(loan_amount);exit();
				if(data){
				 
				 $('#Password_alert').hide();
				 // $('.form-group').removeClass('has-error');
				 // alert("no");
			return true;
				
			
			
			}
			else{
			
			isFormValid = false;
				 
				tt = "Password is not valid";

				 $("#validation_password").val(tt);
				 $("#password").val('');
				 $('#password').focus();
				 $('.form-group').addClass('has-error');
				 var Data1 = "Password is incorrect";
				 $('#Password_alert').html(Data1);
                 $('#Password_alert').show();
				 var options = {

                'title': '',

                'style': 'error',

                'message': tt,

                // 'success': 'warning',
				'icon': 'warning',

                };
				
				var n1 = new notify(options); 

                n1.show(); 

                setTimeout(function(){ n1.hide(); }, 10000);
				
				// alert("Yes");
				return false;
				
				
			
			}
		}
				 
	});
}

$("#exampleValidation").submit(function (e) {
		// alert("Success");
		console.log(isFormValid,"1");
            checkFormValidity2();
			console.log(isFormValid,"2");
			// // setTimeout(function(){  }, 20000);
            if(isFormValid){
               
            }else{
                e.preventDefault();
            }
            
        });
});

		
// ////***Checking user name is coorect*****///
</script>
