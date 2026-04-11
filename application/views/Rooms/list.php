<style>
    .modal-lg {
    max-width: 80%;
}
</style>
<!--**********************************
            Content body start
        ***********************************-->
        <div class="content-body">
            <div class="container-fluid">
				<button type="button" id="btn" class="btn btn-rounded btn-primary btn-md"><i class="fas fa-filter"></i> Filter</button><br><br>
				<!-- <div class="row page-titles">
					<ol class="breadcrumb">
						<li class="breadcrumb-item active"><a href="javascript:void(0)">Table</a></li>
						<li class="breadcrumb-item"><a href="javascript:void(0)">Datatable</a></li>
					</ol>
                </div> -->
                <!-- row --><input type="hidden" id="counter_edit2" value="">
                <form id="exampleValidation" method="POST" action="" enctype="multipart/form-data">
                                    <div class="card-header" id="Create" style="display:none">
                                        <div class="d-flex align-items-center">
                                            <div class="row row-demo-grid hdr-filter-dd-fullwd">
                                                <div class="col-sm-6 col-md-5">
                                                    <div class="card">
                                                        <div class="input-group">
                                                            <select data-validation="required"  data-pms-required="true" class="form-control input-lg multi-select" id="properties_id" name="properties_id" required>  
                            
                                                                    <option value="">Please Select property</option>
                                                                    <?php

                                                                    foreach($property as $row)
                                                                    {
                                                                        
                                                                        echo '<option value="'.$row->properties_id.'" '.$sel.'>'.$row->properties_name.'</option>';

                                                                    }

                                                                    ?>
                                                            </select>
                                                        </div>
                                                    </div>
                                                </div>  
                                                <div class="col-sm-6 col-md-5">
                                                    <div class="card">
                                                        <div class="input-group">
                                                            <select data-validation="required"  data-pms-required="true" class="form-control input-lg multi-select" id="room_meal_plan_id" name="room_meal_plan_id" required>  
                            
                                                                    <option value="">Please Select meal plan</option>                            
                                                                    <?php foreach($meal_plan as $row) {
                                                                            // $sel = ($records->state==$row->state_id)?'selected':'';
                                                                            echo '<option value="'.$row->meal_plan_id.'">'.$row->meal_plan_name.'</option>';
                                                                        } ?>
                                                            </select>
                                                        </div>
                                                    </div>
                                                </div>
                                                <div class="col-sm-6 col-md-5">
                                                    <div class="card">
                                                        <div class="input-group">
                                                            <select data-validation="required"  data-pms-required="true" class="form-control input-lg multi-select" id="properties_room_category_id" name="properties_room_category_id"  required>  
                            
                                                                   <option value="">Please Select Room</option>

                                                                    <?php foreach($room_category as $row) {
                                                                            // $sel = ($records->state==$row->state_id)?'selected':'';
                                                                            echo '<option value="'.$row->properties_room_category_id.'">'.$row->properties_room_category_name.'</option>';
                                                                        } ?>
                                                            </select>
                                                        </div>
                                                    </div>
                                                </div>
                                                                                          
                                                <div class="col-sm-6 col-md-5 staff-do-not-show">
                                                    <div class="card">
                                                        <div class="input-group">
                                                            <select name="properties_room_category_createdby_user_id" id="properties_room_category_createdby_user_id" class="form-control input-lg multi-select" required>                                     
                                                                <option value="">Please Select Created by</option>                            
                                                                <?php foreach($staff as $row) {
                                                                        // $sel = ($records->state==$row->state_id)?'selected':'';
                                                                        echo '<option value="'.$row->user_id.'">'.$row->admin_name.'</option>';
                                                                    } ?>
                                                            </select>
                                                        </div>
                                                    </div>
                                                </div>
                                                <div class="col-sm-2 col-md-3">
                                                    <div class="card">
                                                        <button type="button" class="btn btn-warning btn-md" id="search">
                                                            <span class="btn-label">
                                                                <i class="fas fa-search"></i>
                                                            </span>
                                                            Search
                                                        </button>
                                                    </div>
                                                </div>
                                                <div class="col-sm-2 col-md-3">
                                                    <div class="card">
                                                        <a href="<?php echo base_url();?>Rooms">
                                                        <button type="button" class="btn btn-secondary btn-md" id="search">
                                                            <span class="btn-label">
                                                                <i class="icon-refresh"></i>
                                                            </span>
                                                            Refresh
                                                        </button>
                                                        </a>
                                                    </div>
                                                </div>
                                                
                                            </div>
                                        
                                        </div>
                                    </div>
                                    </form>

                <div class="row">
                    
                    
					<div class="col-12">
                        <div class="card">
                            <div class="card-header">
                                <h4 class="card-title">Rooms Details</h4>
                                <button onclick="add_room()"  data-bs-target="#RoomModal" class="btn btn-rounded btn-secondary btn-md"><b>+ New room</b></button> 
                            </div>
                            <div class="card-body">
                                <div class="table-responsive">
                                    <table id="Room_registration" class="display" style="min-width: 845px">
                                        <thead>
                                            <tr>
                                                <th>Sl.no</th>
                                                <th>Photo</th>
                                                <th>Property</th>
                                                <th>Room name</th>
                                                <th>Meal plan</th>
                                                <th>Inventory</th>
                                                <th>Description</th>
                                                <th>Created by</th>
                                                <th>Action</th>
                                            </tr>
                                        </thead>
                                        <tbody>
                                            
                                        </tbody>
                                    </table>
                                </div>
                            </div>
                        </div>
                    </div>
					
					
				</div>
            </div>
        </div>
        <!--**********************************
            Content body end
        ***********************************-->

        <!-- Modal -->
        <div class="modal fade" id="RoomModal" role="dialog" data-backdrop="static"  data-keyboard="false">
            <div class="modal-dialog modal-lg" role="document">
                <div class="modal-content">
                    <div class="modal-header">
                        <h3 class="modal-title"></h5>
                        <button type="button" class="btn-close" onclick="Roommodalclose()" data-bs-dismiss="modal">
                        </button>
                    </div>
                    <div class="modal-body">
                        
                        <form class="needs-validation" action="#" id="form1" >
                            <input type="text" value="" name="id1" id="id1"/> 
                            <!-- <input type="text" value="" name="properties_id_fk" id="properties_id_fk"/> -->
                            <div class="row">
                                <div class="col-md-4">
                                    <div class="form-group">
                                        <label class="col-lg-7 col-form-label" for="properties_id_fk"><b>Property</b> <span class="text-danger">*</span>
                                        </label>
                                            <select name="properties_id_fk" id="properties_id_fk" class="form-control multi-select" required>                                     
                                                <option value="">Please Select property</option>
                                                                    <?php

                                                                    foreach($property as $row)
                                                                    {
                                                                        
                                                                        echo '<option value="'.$row->properties_id.'" '.$sel.'>'.$row->properties_name.'</option>';

                                                                    }

                                                                    ?>
                                            </select>
                                            <span class="help-block" style="color:red"></span>
                                    </div>
                                </div>
                                <div class="col-md-4">
                                    <div class=" form-group">
                                        <label class="col-lg-3 col-form-label" for="properties_room_category_name"><b>Name</b> <span class="text-danger">*</span>
                                        </label>
                                        
                                            <input type="text" class="form-control" name="properties_room_category_name" id="properties_room_category_name" placeholder="Enter room name" required>
                                            <span class="help-block" style="color:red"></span>
                                        
                                    </div>
                                </div>
                                <div class="col-md-4">
                                    <div class="form-group">
                                        <label class="col-lg-7 col-form-label" for="room_meal_plan_id_fk"><b>Meal plan</b> <span class="text-danger">*</span>
                                        </label>
                                            <select name="room_meal_plan_id_fk" id="room_meal_plan_id_fk" class="form-control multi-select" required>                                     
                                                <option value="">Please Select meal plan</option>                            
                                                                    <?php foreach($meal_plan as $row) {
                                                                        // $sel = ($records->state==$row->state_id)?'selected':'';
                                                                        echo '<option value="'.$row->meal_plan_id.'">'.$row->meal_plan_name.'</option>';
                                                                    } ?>
                                            </select>
                                            <span class="help-block" style="color:red"></span>
                                    </div>
                                </div>

                                <div class="col-md-4">
                                    <div class="form-group">
                                        <label class="col-lg-6 col-form-label" for="properties_room_category_inventory"><b>Room inventory</b> 
                                        </label>
                                            <input type="number" class="form-control" name="properties_room_category_inventory" id="properties_room_category_inventory" placeholder="Enter room Inventory" required>
                                            <span class="help-block" style="color:red"></span>
                                    </div>
                                </div>

                                
                            </div>
                              <br>       
                            <div class="row">
                            <div class="profile-blog">
                                <h5 class="text-primary d-inline">Room's Occupancy Capacity</h5>
                                           
                                        
                            </div><br>
                          

                                <div class="col-md-4">
                                    <div class="form-group">
                                        <label class="col-lg-8 col-form-label" for="properties_room_category_number_of_adults_allowed"><b>No. of Adults allowed (without extra bed / mattress)</b> <span class="text-danger">*</span>
                                        </label>
                                            <input type="number" class="form-control" name="properties_room_category_number_of_adults_allowed" id="properties_room_category_number_of_adults_allowed" placeholder="Enter No. of Adults allowed" required>
                                            <span class="help-block" style="color:red"></span>
                                    </div>
                                </div>

                                <div class="col-md-4">
                                    <div class="form-group">
                                        <label class="col-lg-6 col-form-label" for="properties_room_category_children_allowed_on_bed_sharing_basis"><b>Children allowed on bed sharing basis</b> <span class="text-danger">*</span>
                                        </label>
                                            <input type="number" class="form-control" name="properties_room_category_children_allowed_on_bed_sharing_basis" id="properties_room_category_children_allowed_on_bed_sharing_basis" placeholder="Enter Children allowed on bed sharing basis" required>
                                            <span class="help-block" style="color:red"></span>
                                    </div>
                                </div>

                                <div class="col-md-4">
                                    <div class="form-group">
                                        <label class="col-lg-6 col-form-label" for="properties_room_category_extra_bed_mattress_allowed_in_room"><b>Extra bed /mattress allowed in the room</b> <span class="text-danger">*</span>
                                        </label>
                                            <input type="number" class="form-control" name="properties_room_category_extra_bed_mattress_allowed_in_room" id="properties_room_category_extra_bed_mattress_allowed_in_room" placeholder="Enter extra bed /mattress allowed" required>
                                            <span class="help-block" style="color:red"></span>
                                    </div>
                                
                                </div>                                
                            </div>
                            <br>
                             <div class="row">
                                 <div class="profile-blog">
                                    <h5 class="text-primary d-inline">Room's Child and Infant policy</h5>
                                               
                                            
                                </div><br>
                                <div class="col-md-4">
                                    <div class="form-group">
                                        <label class="col-lg-9 col-form-label" for="properties_room_category_welcomes_child_all_ages"><b>Room welcomes child of all ages</b> <span class="text-danger">*</span>
                                        </label>
                                        
                                            <select name="properties_room_category_welcomes_child_all_ages" id="properties_room_category_welcomes_child_all_ages" class="form-control multi-select" required>                                     
                                               <option value="Y">Yes</option>
                                               <option value="N">No</option>

                                                
                                            </select>
                                            <span class="help-block" style="color:red"></span>
                                    </div>
                                </div>

                                <div class="col-md-4">
                                    <div class="form-group">
                                        <label class="col-lg-11 col-form-label" for="properties_room_category_admission_restricted_guests_under_age"><b>Admission is restricted for guests under</b> <span class="text-danger">*</span>
                                        </label>
                                        
                                            <input type="number" class="form-control" name="properties_room_category_admission_restricted_guests_under_age" id="properties_room_category_admission_restricted_guests_under_age" placeholder="Enter admission is restricted for guests under" required>
                                            <span class="help-block" style="color:red"></span>
                                    </div>
                                </div>

                                
                            </div> 

                            <div class="row">
                            <!--     <br>
                            <div class="card-header border-0 pb-0">
                                <h5 class="card-title">Tariff category</h5>
                            </div><br> -->
                                <div class="col-md-4">
                                    <div class="form-group">
                                        <label class="col-lg-10 col-form-label" for="properties_room_category_complimentary_guest_between_type"><b>Complimentary for guest between</b> <span class="text-danger">*</span>
                                        </label>
                                        
                                            <select name="properties_room_category_complimentary_guest_between_type" id="properties_room_category_complimentary_guest_between_type" class="form-control multi-select" required>                                     
                                               <option value="Y">Yes</option>
                                               <option value="N">No</option>

                                                
                                            </select>
                                            <span class="help-block" style="color:red"></span>
                                    </div>
                                </div>

                                <div class="col-md-4">
                                    <div class="form-group">
                                        <label class="col-lg-8 col-form-label" for="properties_room_category_complimentary_guest_between_from_year"><b>Complimentary from year</b>  <span class="text-danger">*</span>
                                        </label>
                                            <input type="number" class="form-control" name="properties_room_category_complimentary_guest_between_from_year" id="properties_room_category_complimentary_guest_between_from_year" placeholder="Enter Complimentary for guest between" required disabled>
                                            <span class="help-block" style="color:red"></span>
                                            <input type="hidden" name="properties_room_category_complimentary_guest_between_from_year_hidden" id="properties_room_category_complimentary_guest_between_from_year_hidden">
                                    </div>
                                </div>

                                <div class="col-md-4">
                                    <div class="form-group">
                                        <label class="col-lg-6 col-form-label" for="properties_room_category_complimentary_guest_between_to_year"><b>Complimentary to year</b> <span class="text-danger">*</span>
                                        </label>
                                            <input type="number" class="form-control" name="properties_room_category_complimentary_guest_between_to_year" id="properties_room_category_complimentary_guest_between_to_year" placeholder="Enter Complimentary for guest between" required>
                                            <span class="help-block" style="color:red"></span>
                                            <span id="greater1_alert" style="color:red"></span>
                                    </div>
                                </div>

                                
                            </div> 

                            <div class="row">
                                <div class="col-md-4">
                                    <div class="form-group">
                                        <label class="col-lg-10 col-form-label" for="properties_room_category_child_rate_applied_guest_between_type"><b>Child rate applied for guest between</b> <span class="text-danger">*</span>
                                        </label>
                                        
                                            <select name="properties_room_category_child_rate_applied_guest_between_type" id="properties_room_category_child_rate_applied_guest_between_type" class="form-control multi-select" required>                                     
                                               <option value="Y">Yes</option>
                                               <option value="N">No</option>

                                                
                                            </select>
                                            <span class="help-block" style="color:red"></span>
                                    </div>
                                </div>
                                <div class="col-md-4">
                                    <div class="form-group">
                                        <label class="col-lg-10 col-form-label" for="properties_room_category_child_rate_applied_guest_from_year"><b>Child rate applied for guest from year</b> <span class="text-danger">*</span>
                                        </label>
                                            <input type="number" class="form-control" name="properties_room_category_child_rate_applied_guest_from_year" id="properties_room_category_child_rate_applied_guest_from_year" placeholder="Enter child rate applied for guest from year" required disabled>
                                            <span class="help-block" style="color:red"></span>
                                            <input type="hidden" name="properties_room_category_child_rate_applied_guest_from_year_hidden" id="properties_room_category_child_rate_applied_guest_from_year_hidden">
                                    </div>
                                </div>

                                <div class="col-md-4">
                                    <div class="form-group">
                                        <label class="col-lg-10 col-form-label" for="properties_room_category_child_rate_applied_guest_to_year"><b>Child rate applied for guest to year</b> <span class="text-danger">*</span>
                                        </label>
                                            <input type="number" class="form-control" name="properties_room_category_child_rate_applied_guest_to_year" id="properties_room_category_child_rate_applied_guest_to_year" placeholder="Enter Child rate applied for guest to year" required>
                                            <span class="help-block" style="color:red"></span>
                                            <span id="greater2_alert" style="color:red"></span>
                                    </div>
                                </div>


                                
                            </div> 

                            <div class="row">
                                
                                <div class="col-md-4">
                                    <div class="form-group">
                                        <label class="col-lg-8 col-form-label" for="properties_room_category_adult_rate_applied_guest_over"><b>Adult rate applied guest over</b> <span class="text-danger">*</span>
                                        </label>
                                        
                                            <input type="text" class="form-control" name="properties_room_category_adult_rate_applied_guest_over" id="properties_room_category_adult_rate_applied_guest_over" placeholder="Enter Adult rate applied guest over" required disabled>
                                            <span class="help-block" style="color:red"></span>
                                            <input type="hidden" name="properties_room_category_adult_rate_applied_guest_over_hidden" id="properties_room_category_adult_rate_applied_guest_over_hidden">
                                    </div>
                                </div>

                                <div class="col-md-4">
                                        <div class="form-group properties_room_category_photo">
                                            <label class="col-lg-5 col-form-label" for="properties_room_category_photo"><b>Room photo</b>
                                            </label>
                                                <input id="properties_room_category_photo" name="properties_room_category_photo" class="form-control" type="file" required>
                                                <span class="help-block" style="color:red"></span>
                                                <input id="properties_room_category_photo_txt" name="properties_room_category_photo_txt" type="hidden">
                                                
                                        </div>
                                    </div>


                                <div class="col-md-4">
                                        <div class="form-group">
                                            <label class="col-lg-5 col-form-label" for="properties_room_category_description"><b>Description</b>
                                            </label>
                                                <textarea class="form-control" name="properties_room_category_description" id="properties_room_category_description"  rows="5" placeholder="Enter Description" required></textarea>
                                                <span class="help-block" style="color:red"></span>
                                        </div>
                                    </div>

                            </div>     
                        </form>
                    </div>
                    <div class="modal-footer">
                        <button type="button" class="btn btn-danger light" onclick="Roommodalclose()" data-bs-dismiss="modal">Close</button>
                        <button type="button" class="btn btn-primary" id="btnSave1" onclick="save1()" >Save</button>
                    </div>
                </div>
            </div>
        </div>

        <!-- Modal -->
<div class="modal fade" id="deleterow1Modal" role="dialog" data-backdrop="static"  data-keyboard="false">
    <div class="modal-dialog" role="document">
        <div class="modal-content">
            <div class="modal-header">
                <h5 class="modal-title1"></h5>
                <button type="button" class="btn-close" data-bs-dismiss="modal">
                </button>
            </div>
            <div class="modal-body">
                
                <form class="needs-validation" action="#" id="form2" >
                    <input type="hidden" value="" name="id2" id="id2"/> 
                    <input type="hidden" value="" name="properties_room_category_name" id="properties_room_category_name1"/>
                    
                </form>
            </div>
            <div class="modal-footer">
                <button type="button" class="btn btn-danger light" onclick="Propertymodalclose()" data-bs-dismiss="modal">Close</button>
                <button type="button" class="btn btn-primary" id="btnSave2" onclick="delete_room_action()" >Delete</button>
            </div>
        </div>
    </div>
</div>