<style>
    .modal-lg {
    max-width: 80%;

    .modal-body {
    max-height: calc(100vh - 210px);
    overflow-y: auto;
}
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
                <!-- row -->
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
                                                            <select data-validation="required"  data-pms-required="true" class="form-control input-lg multi-select" id="property_category_id_fk2" name="property_category_id_fk" required>  
                            
                                                                    <option value="">Please Select property category</option>                            
                                                                    <?php foreach($property_category as $row) {
                                                                            // $sel = ($records->state==$row->state_id)?'selected':'';
                                                                            echo '<option value="'.$row->property_category_id.'">'.$row->property_category_name.'</option>';
                                                                        } ?>
                                                            </select>
                                                        </div>
                                                    </div>
                                                </div>
                                                <div class="col-sm-6 col-md-5">
                                                    <div class="card">
                                                        <div class="input-group">
                                                            <select data-validation="required"  data-pms-required="true" class="form-control input-lg multi-select" id="country_id_fk2" name="country_id_fk"  required>  
                            
                                                                   <option value="">Please Select Country</option>

                                                                    <?php foreach($country as $row) {
                                                                            // $sel = ($records->state==$row->state_id)?'selected':'';
                                                                            echo '<option value="'.$row->id.'">'.$row->name.'</option>';
                                                                        } ?>
                                                            </select>
                                                        </div>
                                                    </div>
                                                </div>
                                                <div class="col-sm-6 col-md-5">
                                                    <div class="card">
                                                        <div class="input-group">
                                                            <select data-validation="required"  data-pms-required="true" class="form-control input-lg multi-select" id="state_id_fk2" name="state_id_fk" required>  
                            
                                                                   <option value="">Please Select Location</option>

                                                                    <?php foreach($state as $row) {
                                                                            // $sel = ($records->state==$row->state_id)?'selected':'';
                                                                            echo '<option value="'.$row->state_id.'">'.$row->state_name.'</option>';
                                                                        } ?>
                                                            </select>
                                                        </div>
                                                    </div>
                                                </div>
                                                <div class="col-sm-6 col-md-5">
                                                    <div class="card">
                                                        <div class="input-group">
                                                            <select data-validation="required"  data-pms-required="true" class="form-control input-lg multi-select" id="properties_destination_id_fk2" name="properties_destination_id_fk" required>  
                            
                                                                   <option value="">Please Select Destination</option>

                                                                    <?php foreach($state as $row) {
                                                                            // $sel = ($records->state==$row->state_id)?'selected':'';
                                                                            echo '<option value="'.$row->state_id.'">'.$row->state_name.'</option>';
                                                                        } ?>
                                                            </select>
                                                        </div>
                                                    </div>
                                                </div>                                           
                                                <div class="col-sm-6 col-md-5 staff-do-not-show">
                                                    <div class="card">
                                                        <div class="input-group">
                                                            <select name="properties_createdby_userid" id="properties_createdby_userid" class="form-control input-lg multi-select" required>                                     
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
                                                        <a href="<?php echo base_url();?>Property_registration">
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
                                <h2 class="card-title"><b>Property Details</b></h2>
                                <?php if (has_permission('PROPERTY_CREATE')): ?>
                                    <a onclick="add_property()"  data-bs-target="#PropertyModal" class="btn btn-rounded btn-secondary btn-md"><b>+ New Property</b></a>  
                                <?php endif; ?>                                
                            </div>
                            <div class="card-body">
                                <div class="table-responsive">
                                    <table class="table card-table display mb-4 shadow-hover table-responsive-lg" id="Property_registration">
                                        <thead>
                                            <tr>
                                                <th>Sl.no</th>
                                                <th>Property Name</th>
                                                <th>Category</th>
                                                <th>Country</th>
                                                <th>Location</th>
                                                <th>Destination</th>
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
        <div class="modal fade" id="PropertyModal" role="dialog" data-backdrop="static"  data-keyboard="false">
            <div class="modal-dialog modal-lg" role="document">
                <div class="modal-content">
                    <div class="modal-header">
                        <h3 class="modal-title"></h5>
                        <button type="button" class="btn-close" onclick="Propertymodalclose()" data-bs-dismiss="modal">
                        </button>
                    </div>
                    <div class="modal-body">
                        
                        <form class="needs-validation" action="#" id="form" >
                            <input type="hidden" value="" name="id" id="id"/> 
                            <div class="row">
                                <div class="col-md-3">
                                    <div class=" form-group">
                                        <label class="col-lg-3 col-form-label" for="properties_name"><b>Name</b> <span class="text-danger">*</span>
                                        </label>
                                        
                                            <input type="text" class="form-control" name="properties_name" id="properties_name" placeholder="Enter property name" required>
                                            <span class="help-block" style="color:red"></span>
                                        
                                    </div>
                                </div>
                                <div class="col-md-3">
                                    <div class="form-group">
                                        <label class="col-lg-7 col-form-label" for="property_category_id_fk"><b>Property category</b> <span class="text-danger">*</span>
                                        </label>
                                            <select name="property_category_id_fk" id="property_category_id_fk" class="form-control multi-select" required>                                     
                                                <option value="">Please Select property category</option>                            
                                                                    <?php foreach($property_category as $row) {
                                                                            // $sel = ($records->state==$row->state_id)?'selected':'';
                                                                            echo '<option value="'.$row->property_category_id.'">'.$row->property_category_name.'</option>';
                                                                        } ?>
                                            </select>
                                            <span class="help-block" style="color:red"></span>
                                    </div>
                                </div>

                                <div class="col-md-3">
                                    <div class="form-group">
                                        <label class="col-lg-4 col-form-label" for="country_id_fk"><b>Country</b> <span class="text-danger">*</span>
                                        </label>
                                        
                                            <select name="country_id_fk" id="country_id_fk" class="form-control "  required>                                     
                                               <option value="">Please Select Country</option>

                                                <?php foreach($country as $row) {
                                                        // $sel = ($records->state==$row->state_id)?'selected':'';
                                                        echo '<option value="'.$row->id.'">'.$row->name.'</option>';
                                                    } ?>                            
                                               
                                            </select>
                                            <span class="help-block" style="color:red"></span>
                                    </div>
                                </div>

                                <div class="col-md-3">
                                    <div class="form-group">
                                        <label class="col-lg-4 col-form-label" for="country_id_fk"><b>Location</b> <span class="text-danger">*</span>
                                        </label>
                                        
                                            <select name="state_id_fk" id="state_id_fk" class="form-control multi-select" required>                                     
                                               <option value="">Please Select Location</option>

                                                <?php foreach($state as $row) {
                                                        // $sel = ($records->state==$row->state_id)?'selected':'';
                                                        echo '<option value="'.$row->state_id.'">'.$row->state_name.'</option>';
                                                    } ?>                           
                                               
                                            </select>
                                            <span class="help-block" style="color:red"></span>
                                    </div>
                                </div>
                            </div>
                                    
                            <div class="row">
                                <div class="col-md-3">
                                    <div class="form-group">
                                        <label class="col-lg-5 col-form-label" for="country_id_fk"><b>Destination</b> <span class="text-danger">*</span>
                                        </label>
                                        
                                            <select name="properties_destination_id_fk" id="properties_destination_id_fk" class="form-control multi-select" required>                                     
                                               <option value="">Please Select Destination</option>

                                                <?php foreach($state as $row) {
                                                        // $sel = ($records->state==$row->state_id)?'selected':'';
                                                        echo '<option value="'.$row->state_id.'">'.$row->state_name.'</option>';
                                                    } ?>                           
                                               
                                            </select>
                                            <span class="help-block" style="color:red"></span>
                                    </div>
                                </div>

                                <div class="col-md-3">
                                    <div class="form-group">
                                        <label class="col-lg-5 col-form-label" for="properties_house_boat_type"><b>Boat type</b> <span class="text-danger">*</span>
                                        </label>
                                        
                                            <select name="properties_house_boat_type" id="properties_house_boat_type" class="form-control multi-select" required>                                     
                                               <option value="">Please Select Boat type</option>
                                               <option value="Y">Yes</option>
                                               <option value="N">No</option>

                                                                         
                                               
                                            </select>
                                            <span class="help-block" style="color:red"></span>
                                    </div>
                                </div>

                                <div class="col-md-3">
                                    <div class="form-group">
                                        <label class="col-lg-6 col-form-label" for="properties_hotel_url"><b>Hotel url</b> 
                                        </label>
                                            <input type="text" class="form-control" name="properties_hotel_url" id="properties_hotel_url" placeholder="Enter hotel URL" required>
                                            <span class="help-block" style="color:red"></span>
                                    </div>
                                </div>

                                

                                <div class="col-md-3">
                                    <div class="form-group">
                                        <label class="col-lg-6 col-form-label" for="properties_check_type"><b>Checking type</b> <span class="text-danger">*</span>
                                        </label>
                                            <select name="properties_check_type" id="properties_check_type" class="form-control multi-select" required>                                     
                                               <option value="T">24 hours</option>
                                               <option value="O">Other</option>

                                                                         
                                               
                                            </select>
                                            <span class="help-block" style="color:red"></span>
                                    </div>
                                </div>
                            </div>        
                            
                        
                            <div class="row">
                                
                                <div class="col-md-3">        
                                    <div class="form-group">
                                        <label class="col-lg-5 col-form-label" for="properties_check_in_time"><b>Check in time</b> <span class="text-danger">*</span>
                                        </label>
                                            
                                            <div class="input-group clockpicker">
                                                <input type="text" class="form-control" name="properties_check_in_time" id="properties_check_in_time" placeholder="Enter check in time" required><span class="input-group-text"><i class="far fa-clock"></i></span>
                                                <span class="help-block" style="color:red"></span>
                                            </div>
                                    </div>
                                </div>

                                <div class="col-md-3">
                                    <div class="form-group">
                                        <label class="col-lg-6 col-form-label" for="properties_check_out_time"><b>Check out time</b> <span class="text-danger">*</span>
                                        </label>
                                            <div class="input-group clockpicker">
                                                <input type="text" class="form-control" name="properties_check_out_time" id="properties_check_out_time" placeholder="Enter check out time" required><span class="input-group-text"><i class="far fa-clock"></i></span>
                                                <span class="help-block" style="color:red"></span>
                                            </div>
                                    </div>
                                </div>   

                                <div class="col-md-3">
                                    <div class="form-group">
                                        <label class="col-lg-7 col-form-label" for="properties_sales_contact_name"><b>Sales contact name</b>
                                        </label>
                                            <input type="text" class="form-control" name="properties_sales_contact_name" id="properties_sales_contact_name" placeholder="Enter Sales contact name" required>
                                            <span class="help-block" style="color:red"></span>
                                    </div>
                                </div>

                                

                                <div class="col-md-3">
                                    <div class="form-group">
                                        <label class="col-lg-8 col-form-label" for="properties_sales_contact_phone_number"><b>Sales contact number</b>
                                        </label>
                                            <input type="text" class="form-control" name="properties_sales_contact_phone_number" id="properties_sales_contact_phone_number" placeholder="Enter Sales contact number" required>
                                            <span class="help-block" style="color:red"></span>
                                    </div>
                                </div>

                                
                            </div>

                            <div class="row">
                                
                                <div class="col-md-3">        
                                    <div class="form-group">
                                        <label class="col-lg-7 col-form-label" for="properties_sales_contact_email"><b>Sales contact email</b>
                                        </label>
                                            <input type="text" class="form-control" name="properties_sales_contact_email" id="properties_sales_contact_email" placeholder="Enter Sales contact email" required>
                                            <span class="help-block" style="color:red"></span>
                                    </div>
                                </div>

                                <div class="col-md-3">
                                    <div class="form-group">
                                        <label class="col-lg-10 col-form-label" for="properties_reservation_contact_name"><b>Reservation contact name</b>
                                        </label>
                                            <input type="text" class="form-control" name="properties_reservation_contact_name" id="properties_reservation_contact_name" placeholder="Enter Reservation contact name" required>
                                            <span class="help-block" style="color:red"></span>
                                    </div>
                                </div>

                                <div class="col-md-3">
                                    <div class="form-group">
                                        <label class="col-lg-12 col-form-label" for="properties_reservation_contact_phone_number"><b>Reservation contact phone number</b>
                                        </label>
                                            <input type="text" class="form-control" name="properties_reservation_contact_phone_number" id="properties_reservation_contact_phone_number" placeholder="Enter Reservation contact phone number" required>
                                            <span class="help-block" style="color:red"></span>
                                    </div>
                                </div>

                                

                                <div class="col-md-3">
                                    <div class="form-group">
                                        <label class="col-lg-10 col-form-label" for="properties_reservation_contact_email"><b>Reservation contact email</b>
                                        </label>
                                            <input type="text" class="form-control" name="properties_reservation_contact_email" id="properties_reservation_contact_email" placeholder="Enter Reservation contact email" required>
                                            <span class="help-block" style="color:red"></span>
                                    </div>
                                </div>

                                
                            </div>

                            <div class="row">
                                    
                                <div class="col-md-3">        
                                    <div class="form-group">
                                        <label class="col-lg-5 col-form-label" for="properties_google_map_location"><b>Google map</b>
                                        </label>
                                            <input type="text" class="form-control" name="properties_google_map_location" id="properties_google_map_location" placeholder="Enter Google map" required>
                                            <span class="help-block" style="color:red"></span>
                                    </div>
                                </div>

                                <div class="col-md-3">
                                    <div class="form-group properties_hotel_logo">
                                        <label class="col-lg-5 col-form-label"><b>Hotel logo</b></label>
                                        <input id="properties_hotel_logo" name="properties_hotel_logo" class="form-control" type="file">
                                        <!-- ERROR MESSAGE -->
                                        <span class="help-block text-danger file-error"></span>
                                        <input id="properties_hotel_logo_txt" name="properties_hotel_logo_txt" type="hidden">

                                        <!-- preview -->
                                        <div class="mt-2" id="hotel_logo_preview_box" style="display:none;">
                                            <img id="hotel_logo_preview_img" style="width:70px;height:70px;object-fit:cover;border:1px solid #ddd;border-radius:6px;display:none;">
                                            
                                            <div id="hotel_logo_preview_pdf" style="display:none;">
                                                <a id="hotel_logo_preview_link" target="_blank" class="btn btn-sm btn-danger">
                                                    <i class="fa fa-file-pdf"></i> View PDF
                                                </a>
                                            </div>
                                        </div>

                                    </div>

                                </div>

                                <div class="col-md-3">
                                    <div class="form-group properties_photos">
                                        <label class="col-lg-5 col-form-label" for="properties_photos"><b>Property photo</b>
                                        </label>
                                            <input type="file" class="form-control" name="properties_photos" id="properties_photos">
                                            <span class="help-block" style="color:red"></span>
                                            <!-- ERROR MESSAGE -->
                                            <span class="help-block text-danger file-error"></span>
                                            <input id="properties_photos_txt" name="properties_photos_txt" type="hidden">

                                            <div class="mt-2" id="property_photo_preview_box" style="display:none;">
                                                <img id="property_photo_preview_img" style="width:70px;height:70px;object-fit:cover;border:1px solid #ddd;border-radius:6px;display:none;">
                                                
                                                <div id="property_photo_preview_pdf" style="display:none;">
                                                    <a id="property_photo_preview_link" target="_blank" class="btn btn-sm btn-danger">
                                                        <i class="fa fa-file-pdf"></i> View PDF
                                                    </a>
                                                </div>
                                            </div>


                                    </div>
                                </div>

                                <div class="col-md-3">
                                    <div class="form-group">
                                        <label class="col-lg-5 col-form-label" for="properties_description"><b>Description</b>
                                        </label>
                                            <textarea class="form-control" name="properties_description" id="properties_description"  rows="5" placeholder="Enter Description" required></textarea>
                                            <span class="help-block" style="color:red"></span>
                                    </div>
                                </div>                               
                            </div>
                            
                        </form>
                    </div>
                    <div class="modal-footer">
                        <button type="button" class="btn btn-danger light" onclick="Propertymodalclose()" data-bs-dismiss="modal">Close</button>
                        <button type="button" class="btn btn-primary" id="btnSave" onclick="save()" >Save</button>
                    </div>
                </div>
            </div>
        </div>


<!-- Modal -->
<div class="modal fade" id="deleterowModal" role="dialog" data-backdrop="static"  data-keyboard="false">
    <div class="modal-dialog" role="document">
        <div class="modal-content">
            <div class="modal-header">
                <h5 class="modal-title1"></h5>
                <button type="button" class="btn-close" data-bs-dismiss="modal">
                </button>
            </div>
            <div class="modal-body">
                
                <form class="needs-validation" action="#" id="form1" >
                    <input type="hidden" value="" name="id" id="id1"/> 
                    <input type="hidden" value="" name="properties_name" id="properties_name1"/>
                    
                </form>
            </div>
            <div class="modal-footer">
                <button type="button" class="btn btn-danger light" onclick="Propertymodalclose()" data-bs-dismiss="modal">Close</button>
                <button type="button" class="btn btn-primary" id="btnSave1" onclick="delete_property_action()" >Delete</button>
            </div>
        </div>
    </div>
</div>