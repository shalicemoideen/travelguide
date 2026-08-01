<?php
$arAdmintype = array('A'=>'Super admin','C'=>'Company','S'=>'Staff');
?>
<!-- End Sidebar -->
		<div class="main-panel">
			<div class="container">
				<div class="page-inner">
					<h4 class="page-title">Edit User Profile</h4>
					<div class="row">
						<div class="col-md-8">
							<div class="card card-with-nav">
								<div class="card-header">
									<div class="row row-nav-line">
										
									</div>
								</div>
								 <!-- form start -->
							<form class="form-horizontal" method="POST" enctype="multipart/form-data" action="<?php echo base_url();?>index.php/User/add">
								<input type="hidden" name="user_id" id="user_id"  value="<?php if(isset($records->user_id)) echo $records->user_id ?>"/>
								<div class="card-body">
									<div class="form-group form-show-validation row">
										<label for="birth" class="col-lg-3 col-md-3 col-sm-4 mt-sm-2 text-right">Admin name </label>
										<div class="col-lg-4 col-md-9 col-sm-8">
											<div class="input-group">
												<label for="birth" class="col-lg-3 col-md-3 col-sm-4 mt-sm-2 text-right"><?php if(isset($records->admin_name)) echo $records->admin_name ?> </label>
											</div>
										</div>
									</div>
									<div class="form-group form-show-validation row">
										<label for="birth" class="col-lg-3 col-md-3 col-sm-4 mt-sm-2 text-right">Admin type </label>
										<div class="col-lg-4 col-md-9 col-sm-8">
											<div class="input-group">
												<label for="birth" class="col-lg-3 col-md-3 col-sm-4 mt-sm-2 text-right"><?php if(isset($arAdmintype[$records->user_type])) echo $arAdmintype[$records->user_type] ?> </label>
											</div>
										</div>
									</div>
									<div class="form-group form-show-validation row">
										<label class="col-lg-3 col-md-3 col-sm-4 mt-sm-2 text-right">Upload Profile pic <span class="required-label">*</span></label>
										<div class="col-lg-4 col-md-9 col-sm-8">
											<div>
												<input type="file" class="form-control form-control-file" id="user_profile_pic" name="user_profile_pic" accept="image/*" value="<?php if(isset($records->user_profile_pic)) echo $records->user_profile_pic ?>"  >
												<?php if(isset($records->user_profile_pic) && $records->user_profile_pic!='') { echo 'Current File: '.$records->user_profile_pic; } ?>
											</div>
										</div>
									</div>
									<div class="form-group form-show-validation row">
										<label for="birth" class="col-lg-3 col-md-3 col-sm-4 mt-sm-2 text-right">Address </label>
										<div class="col-lg-4 col-md-9 col-sm-8">
											<div class="input-group">
												<textarea class="form-control" id="user_address" name="user_address" rows="5">
														<?php if(isset($records->user_address)) echo $records->user_address ?>
												</textarea>
											</div>
										</div>
									</div>
									<div class="form-group form-show-validation row">
										<label for="birth" class="col-lg-3 col-md-3 col-sm-4 mt-sm-2 text-right">Email Address </label>
										<div class="col-lg-4 col-md-9 col-sm-8">
											<div class="input-group">
												<input type="text" class="form-control" id="user_email_address" placeholder="Enter email address" name="user_email_address" value="<?php if(isset($records->user_email_address)) { echo $records->user_email_address;}  ?>" required>
											</div>
										</div>
									</div>
									<div class="form-group form-show-validation row">
										<label for="birth" class="col-lg-3 col-md-3 col-sm-4 mt-sm-2 text-right">Phone number </label>
										<div class="col-lg-4 col-md-9 col-sm-8">
											<div class="input-group">
												<input type="text" class="form-control" id="user_phone_number" placeholder="Enter phone number" name="user_phone_number" value="<?php if(isset($records->user_phone_number)) { echo $records->user_phone_number;}  ?>" required>
											</div>
										</div>
									</div>
									<div class="form-group form-show-validation row">
										<label for="birth" class="col-lg-3 col-md-3 col-sm-4 mt-sm-2 text-right">Land line </label>
										<div class="col-lg-4 col-md-9 col-sm-8">
											<div class="input-group">
												<input type="text" class="form-control" id="user_lan_number" placeholder="Enter landline number" name="user_lan_number" value="<?php if(isset($records->user_lan_number)) { echo $records->user_lan_number;}  ?>" required>
											</div>
										</div>
									</div>
									<div class="form-group form-show-validation row staff-do-not-show company-do-not-show">
										<label for="birth" class="col-lg-3 col-md-3 col-sm-4 mt-sm-2 text-right">User name </label>
										<div class="col-lg-4 col-md-9 col-sm-8">
											<div class="input-group">
												<input type="text" class="form-control" id="user_name" placeholder="Enter User name" name="user_name" value="<?php if(isset($records->user_name)) { echo $records->user_name;}  ?>" required>												
											</div>
											<b><span id="user_name_alert" style="color: red"></span></b>
										</div>
									</div>
									<div class="form-group form-show-validation row staff-do-not-show company-do-not-show">
										<label for="birth" class="col-lg-3 col-md-3 col-sm-4 mt-sm-2 text-right">Password </label>
										<div class="col-lg-4 col-md-9 col-sm-8">
											<div class="input-group">
												<input type="password" class="form-control" id="password" placeholder="Enter Password" name="password" value="" autocomplete="new-password">
												<button class="btn btn-outline-secondary" type="button" onclick="toggleProfilePwd(this)"><i class="fa fa-eye"></i></button>
											</div>
										</div>
									</div>
									<div class="form-group form-show-validation row">
										<label for="birth" class="col-lg-3 col-md-3 col-sm-4 mt-sm-2 text-right">Description </label>
										<div class="col-lg-4 col-md-9 col-sm-8">
											<div class="input-group">
												<textarea class="form-control" id="user_description" name="user_description" rows="5">
														<?php if(isset($records->user_description)) echo $records->user_description ?>
												</textarea>
											</div>
										</div>
									</div>
									<div class="card-action">
										<div class="row">
											<div class="col-md-12">
												<input class="btn btn-success submit" type="submit" value="Submit">
												<button class="btn btn-danger">Cancel</button>
											</div>										
										</div>
									</div>
								</div>
								</form>
							</div>
						</div>
						
					</div>
				</div>
			</div>