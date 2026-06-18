<?php
$arAdmintype = array('A'=>'Super admin','C'=>'Company','S'=>'Staff');
$flash_response = $this->session->flashdata('response');
?>
<input type="hidden" id="flash_response" value="<?php echo $flash_response ? htmlspecialchars($flash_response) : ''; ?>">
<div class="content-body">
            <div class="container-fluid">
                <!-- row -->
                
                <div class="row">
                    
                    <div class="col-xl-8">
                        <div class="card">
                            <div class="card-header d-flex justify-content-between align-items-center py-2">
                                <span></span>
                                <button type="button" id="btn_toggle_file_saving"
                                    class="btn btn-sm <?php echo (isset($records->meta_force_stop) && $records->meta_force_stop === 'Y') ? 'btn-danger' : 'btn-success'; ?>"
                                    data-current="<?php echo (isset($records->meta_force_stop) ? $records->meta_force_stop : 'N'); ?>">
                                    <?php echo (isset($records->meta_force_stop) && $records->meta_force_stop === 'Y') ? 'Meta Lead Stopped (Click to Enable)' : 'Meat Lead Enabled (Click to Stop)'; ?>
                                </button>
                            </div>
                            <div class="card-body">
                                <div class="profile-tab">
                                    <div class="custom-tab-1">
                                        <ul class="nav nav-tabs">
                                            <li class="nav-item"><a href="#my-posts" data-bs-toggle="tab" class="nav-link active show">Profile details</a>
                                            </li>
                                            <li class="nav-item"><a href="#profile-settings" data-bs-toggle="tab" class="nav-link">Update profile</a>
                                            </li>
                                        </ul>
                                        <div class="tab-content">
                                            <div id="my-posts" class="tab-pane fade active show">
                                                <div class="profile-about-me">
                                                    <div class="pt-4 border-bottom-1 pb-3">
                                                        <!-- <h4 class="text-primary">About Me</h4>
                                                        <p class="mb-2">A wonderful serenity has taken possession of my entire soul, like these sweet mornings of spring which I enjoy with my whole heart. I am alone, and feel the charm of existence was created for the bliss of souls like mine.I am so happy, my dear friend, so absorbed in the exquisite sense of mere tranquil existence, that I neglect my talents.</p>
                                                        <p>A collection of textile samples lay spread out on the table - Samsa was a travelling salesman - and above it there hung a picture that he had recently cut out of an illustrated magazine and housed in a nice, gilded frame.</p> -->
                                                    </div>
                                                </div>
												<div class="profile-info">
													<div class="profile-photo">
														<?php
														if($this->session->userdata('user_profile_pic') == '')
														{ ?>
													
														
															<img src="<?php echo base_url();?>assets/images/user.png"   class="img-fluid rounded-circle" style="width:200px; height:200px;object-fit: cover;"  alt=""/>
														
														
														<?php } else { ?>

														
															
																<img src="<?php echo base_url();?>uploads/user-profile/<?php echo $this->session->userdata('user_profile_pic');?>"  style="width:200px; height:200px;object-fit: cover;" class="img-fluid rounded-circle" alt=""/>
															

														

														<?php } ?>
														<!-- <img src="<?php echo base_url();?>assets/images/profile/profile.png" class="img-fluid rounded-circle" alt=""> -->
													</div>
												</div>
                                                <div class="profile-personal-info">
                                                    <h4 class="text-primary mb-4">Personal Information</h4>
                                                    <div class="row mb-2">
                                                        <div class="col-sm-3 col-5">
                                                            <h5 class="f-w-500">Admin name <span class="pull-end">:</span>
                                                            </h5>
                                                        </div>
                                                        <div class="col-sm-9 col-7"><span><?php if(isset($admin_data->admin_name)) echo $admin_data->admin_name ?></span>
                                                        </div>
                                                    </div>
                                                    <div class="row mb-2">
                                                        <div class="col-sm-3 col-5">
                                                            <h5 class="f-w-500">Admin type <span class="pull-end">:</span>
                                                            </h5>
                                                        </div>
                                                        <div class="col-sm-9 col-7"><span><?php if(isset($arAdmintype[$admin_data->user_type])) echo $arAdmintype[$admin_data->user_type] ?></span>
                                                        </div>
                                                    </div>
                                                    <div class="row mb-2">
                                                        <div class="col-sm-3 col-5">
                                                            <h5 class="f-w-500">Address <span class="pull-end">:</span></h5>
                                                        </div>
                                                        <div class="col-sm-9 col-7"><span><?php if(isset($admin_data->user_address)) echo $admin_data->user_address ?></span>
                                                        </div>
                                                    </div>
                                                    <div class="row mb-2">
                                                        <div class="col-sm-3 col-5">
                                                            <h5 class="f-w-500">Email Address <span class="pull-end">:</span>
                                                            </h5>
                                                        </div>
                                                        <div class="col-sm-9 col-7"><span><?php if(isset($admin_data->user_email_address)) echo $admin_data->user_email_address ?></span>
                                                        </div>
                                                    </div>
                                                    <div class="row mb-2">
                                                        <div class="col-sm-3 col-5">
                                                            <h5 class="f-w-500">Phone number <span class="pull-end">:</span></h5>
                                                        </div>
                                                        <div class="col-sm-9 col-7"><span><?php if(isset($admin_data->user_phone_number)) echo $admin_data->user_phone_number ?></span>
                                                        </div>
                                                    </div>
                                                    <div class="row mb-2">
                                                        <div class="col-sm-3 col-5">
                                                            <h5 class="f-w-500">Land line <span class="pull-end">:</span></h5>
                                                        </div>
                                                        <div class="col-sm-9 col-7"><span><?php if(isset($admin_data->user_lan_number)) echo $admin_data->user_lan_number ?></span>
                                                        </div>
                                                    </div>
													<div class="row mb-2">
                                                        <div class="col-sm-3 col-5">
                                                            <h5 class="f-w-500">User name <span class="pull-end">:</span></h5>
                                                        </div>
                                                        <div class="col-sm-9 col-7"><span><?php if(isset($admin_data->user_name)) echo $admin_data->user_name ?></span>
                                                        </div>
                                                    </div>
													<div class="row mb-2">
                                                        <div class="col-sm-3 col-5">
                                                            <h5 class="f-w-500">Password <span class="pull-end">:</span></h5>
                                                        </div>
                                                        <div class="col-sm-9 col-7"><span><?php if(isset($admin_data->password)) echo $admin_data->password ?></span>
                                                        </div>
                                                    </div>
													<div class="row mb-2">
                                                        <div class="col-sm-3 col-5">
                                                            <h5 class="f-w-500">Description <span class="pull-end">:</span></h5>
                                                        </div>
                                                        <div class="col-sm-9 col-7"><span><?php if(isset($admin_data->user_description)) echo $admin_data->user_description ?></span>
                                                        </div>
                                                    </div>
                                                </div>
                                            </div>
                                            
                                            <div id="profile-settings" class="tab-pane fade">
                                                <div class="pt-3">
                                                    <div class="settings-form">
                                                        <h4 class="text-primary">Account Setting</h4>
                                                        <form method="POST" enctype="multipart/form-data" action="<?php echo base_url();?>index.php/User/add">
															<input type="hidden" name="user_id" id="user_id"  value="<?php if(isset($records->user_id)) echo $records->user_id ?>"/>
                                                            <div class="row">
                                                                <div class="mb-3 col-md-6">
                                                                    <label class="form-label"><b>Admin name</b></label>
                                                                    <div class="col-sm-9 col-7"><span><?php if(isset($admin_data->admin_name)) echo $admin_data->admin_name ?></span>
                                                        			</div>
                                                                </div>
                                                                <div class="mb-3 col-md-6">
                                                                    <label class="form-label">Admin type</label>
                                                                    <div class="col-sm-9 col-7"><span><?php if(isset($arAdmintype[$admin_data->user_type])) echo $arAdmintype[$admin_data->user_type] ?></span>
                                                        			</div>
                                                                </div>
                                                            </div>
                                                            <div class="mb-3">
                                                                <label class="form-label">Upload Profile pic</label>
                                                                <input type="file" class="form-control form-control-file" id="user_profile_pic" name="user_profile_pic" accept="image/*" value="<?php if(isset($records->user_profile_pic)) echo $records->user_profile_pic ?>"  >
																<?php if(isset($records->user_profile_pic) && $records->user_profile_pic!='') { echo 'Current File: '.$records->user_profile_pic; } ?>
                                                            </div>
                                                            <div class="mb-3">
                                                                <label class="form-label">Address </label>
                                                                <textarea class="form-control" id="user_address" name="user_address" rows="5"><?php if(isset($records->user_address)) echo $records->user_address ?></textarea>
                                                            </div>
                                                            <div class="row">
                                                                <div class="mb-3 col-md-6">
                                                                    <label class="form-label">Email Address</label>
                                                                    <input type="text" class="form-control" id="user_email_address" placeholder="Enter email address" name="user_email_address" value="<?php if(isset($records->user_email_address)) { echo $records->user_email_address;}  ?>">
                                                                </div>
                                                                <div class="mb-3 col-md-6">
                                                                    <label class="form-label">Land line</label>
                                                                    <input type="text" class="form-control" id="user_lan_number" placeholder="Enter landline number" name="user_lan_number" value="<?php if(isset($records->user_lan_number)) { echo $records->user_lan_number;}  ?>">
                                                                </div>
                                                            </div>
															<div class="row">
                                                                <div class="mb-3 col-md-6">
                                                                    <label class="form-label">User name</label>
                                                                    <input type="text" class="form-control" id="user_name" placeholder="Enter User name" name="user_name" value="<?php if(isset($records->user_name)) { echo $records->user_name;}  ?>">
                                                                </div>
                                                                <div class="mb-3 col-md-6">
                                                                    <label class="form-label">Password</label>
                                                                    <input type="text" class="form-control" id="password" placeholder="Enter Password" name="password" value="<?php if(isset($records->password)) { echo $records->password;}  ?>">
                                                                </div>
                                                            </div>
                                                            <div class="mb-3">
                                                                <div class="form-check custom-checkbox">																	
																	<label class="form-label" for="gridCheck">Description</label>
																	<textarea class="form-control" id="user_description" name="user_description" rows="5"><?php if(isset($records->user_description)) echo $records->user_description ?></textarea>
																</div>
                                                            </div>
                                                            <button class="btn btn-primary" type="submit">Update</button>
                                                        </form>
                                                    </div>
                                                </div>
                                            </div>
                                        </div>
                                    </div>
                                </div>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
        </div>

<!-- File Saving Toggle Confirmation Modal -->
<div class="modal fade" id="fileSavingConfirmModal" tabindex="-1" role="dialog" data-backdrop="static" data-keyboard="false">
    <div class="modal-dialog modal-sm" role="document">
        <div class="modal-content">
            <div class="modal-header">
                <h5 class="modal-title" id="fileSavingModalTitle">Confirm</h5>
                <button type="button" class="btn-close" data-bs-dismiss="modal"></button>
            </div>
            <div class="modal-body">
                <p id="fileSavingModalMsg">Are you sure?</p>
            </div>
            <div class="modal-footer">
                <button type="button" class="btn btn-danger light" data-bs-dismiss="modal">No</button>
                <button type="button" class="btn btn-primary" id="btnFileSavingConfirmYes">Yes</button>
            </div>
        </div>
    </div>
</div>