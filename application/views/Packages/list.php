<style>
    .modal-lg {
    max-width: 95%;

    .modal-body {
    max-height: calc(100vh - 210px);
    overflow-y: auto;
}
}
.ck-content ul { list-style: disc; margin-left:20px; }
.ck-content ol { list-style: decimal; margin-left:20px; }

.ck-content ul li {
  list-style: disc !important;
}

.ck-content ol li {
  list-style: decimal !important;
}

.ck-content ul,
.ck-content ol {
  margin-left: 20px !important;
}
</style>
<style>
.day-thumb{
  width: 140px;
  height: 95px;
  object-fit: cover;
  border-radius: 8px;
  border: 1px solid #ddd;
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
                                                            <select data-validation="required"  data-pms-required="true" class="form-control input-lg multi-select" id="packages_title_filter" name="packages_title_filter" required>  
                            
                                                                    <option value="">Please Select template</option>
                                                                    <?php

                                                                    foreach($package as $row)
                                                                    {
                                                                        
                                                                        echo '<option value="'.$row->packages_title.'" '.$sel.'>'.$row->packages_title.'</option>';

                                                                    }

                                                                    ?>
                                                            </select>
                                                        </div>
                                                    </div>
                                                </div>  
                                                <div class="col-sm-6 col-md-5">
                                                    <div class="card">
                                                        <div class="input-group">
                                                            <select data-validation="required"  data-pms-required="true" class="form-control input-lg multi-select" id="packages_category_id_filter" name="packages_category_id_filter"  required>  
                            
                                                                   <option value="">Please Select Template category</option>

                                                                    <?php foreach($pcategory as $row) {
                                                                            // $sel = ($records->state==$row->state_id)?'selected':'';
                                                                            echo '<option value="'.$row->package_category_id.'">'.$row->package_category_name.'</option>';
                                                                        } ?>
                                                            </select>
                                                        </div>
                                                    </div>
                                                </div> 
                                                <div class="col-sm-6 col-md-5">
                                                    <div class="card">
                                                        <div class="input-group">
                                                            <select data-validation="required"  data-pms-required="true" class="form-control input-lg multi-select" id="packages_itinerary_category_id_filter" name="packages_itinerary_category_id_filter" required>  
                            
                                                                    <option value="">Please Select itinerary category</option>                            
                                                                    <?php foreach($itcategory as $row) {
                                                                            // $sel = ($records->state==$row->state_id)?'selected':'';
                                                                            echo '<option value="'.$row->itinerary_category_id.'">'.$row->itinerary_category_name.'</option>';
                                                                        } ?>
                                                            </select>
                                                        </div>
                                                    </div>
                                                </div>
                                                <div class="col-sm-6 col-md-5">
                                                    <div class="card">
                                                        <div class="input-group">
                                                            <select data-validation="required"  data-pms-required="true" class="form-control input-lg multi-select" id="packages_itinerary_id_filter" name="packages_itinerary_id_filter" required>  
                            
                                                                    <option value="">Please Select itinerary</option>                            
                                                                    <?php foreach($itinerary as $row) {
                                                                            // $sel = ($records->state==$row->state_id)?'selected':'';
                                                                            echo '<option value="'.$row->itineraries_id.'">'.$row->itineraries_name.'</option>';
                                                                        } ?>
                                                            </select>
                                                        </div>
                                                    </div>
                                                </div>
                                                <div class="col-sm-6 col-md-5">
                                                    <div class="card">
                                                        <div class="input-group">
                                                            <input type="text" class="form-control" placeholder="Duration in nights" id="packages_duration_in_nights_filter" name="packages_duration_in_nights_filter" required>
                                                        </div>
                                                    </div>
                                                </div>                          
                                                <div class="col-sm-6 col-md-5 staff-do-not-show">
                                                    <div class="card">
                                                        <div class="input-group">
                                                            <select name="packages_createdby_user_id" id="packages_createdby_user_id" class="form-control input-lg multi-select" required>                                     
                                                                <option value="">Please Select Created by</option>                            
                                                                <?php foreach($users as $row) {
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
                                                        <a href="<?php echo base_url();?>Packages">
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
                                <h2 class="card-title"><b>Template Details</b></h2>
                                <a onclick="add_packages()"  data-bs-target="#PackagesModal" class="btn btn-rounded btn-secondary btn-md"><b>+ Create Template</b></a> 
                            </div>
                            <div class="card-body">
                                <div class="table-responsive">
                                    <table class="table card-table display mb-4 shadow-hover table-responsive-lg" id="Package_registration">
                                        <thead>
                                            <tr>
                                                <th>Sl.no</th>
                                                <th>Template title</th>
                                                <th>Template category</th>
                                                <th>Durations in nights</th>
                                                <th>Itinerary Category</th>
                                                <th>Itinerary name</th>
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
         <div class="modal fade" id="PackagesModal" tabindex="-1" aria-labelledby="AddPriorityModalLabel" aria-hidden="true" data-bs-backdrop="static" data-bs-keyboard="false">
        <!-- <div class="modal fade" id="PackagesModal" role="dialog" tabindex="-1" data-backdrop="static"  aria-hidden="true" data-bs-keyboard="false"> -->
            <div class="modal-dialog modal-lg" role="document">
                <div class="modal-content">
                    <div class="modal-header">
                        <h3 class="modal-title"></h5>
                        <button type="button" class="btn-close" onclick="Packagemodalclose()" data-bs-dismiss="modal">
                        </button>
                    </div>
                    <div class="modal-body">
                        
                        <form class="needs-validation" action="#" id="form" enctype="multipart/form-data">
                            <input type="hidden" value="" name="id" id="id"/> 
                            <input type="hidden" name="packages_id" id="packages_id">

                            <div class="row">
                                <div class="col-md-2">
                                    <div class=" form-group">
                                        <label class="col-lg-7 col-form-label" for="packages_title"><b>Template title</b> <span class="text-danger">*</span>
                                        </label>
                                        
                                            <input type="text" class="form-control" name="packages_title" id="packages_title" placeholder="Enter Template title" required>
                                            <span class="help-block" style="color:red"></span>
                                        
                                    </div>
                                </div>
                                <div class="col-md-2">
                                    <div class="form-group">
                                        <label class="col-lg-9 col-form-label" for="packages_duration_in_nights"><b>Duration in nights</b> <span class="text-danger">*</span>
                                        </label>
                                            <input type="number" class="form-control" name="packages_duration_in_nights" id="packages_duration_in_nights" placeholder="Enter Duration in nights" required>
                                            <span class="help-block" style="color:red"></span>
                                    </div>
                                </div>

                                <div class="col-md-2">
                                    <div class="form-group">
                                        <label class="col-lg-9 col-form-label" for="packages_category_id_fk"><b>Template category</b> <span class="text-danger">*</span>
                                        </label>
                                            <select name="packages_category_id_fk" id="packages_category_id_fk" class="form-control multi-select" required>                                     
                                                <option value="">Select template category</option>                            
                                                                    <?php foreach($pcategory as $row)
                                                                    {
                                                                        
                                                                        echo '<option value="'.$row->package_category_id.'" '.$sel.'>'.$row->package_category_name.'</option>';

                                                                    } ?>
                                            </select>
                                            <span class="help-block" style="color:red"></span>
                                    </div>
                                </div>

                                <div class="col-md-3">
                                    <div class="form-group">
                                        <label class="col-lg-7 col-form-label" for="packages_itinerary_category_id_fk"><b>Itinerary category</b> <span class="text-danger">*</span>
                                        </label>
                                            <select name="packages_itinerary_category_id_fk" id="packages_itinerary_category_id_fk" class="form-control multi-select" required>                                     
                                                <option value="">Please Select itinerary category</option>                            
                                                                    <?php foreach($itcategory as $row)
                                                                    {
                                                                        
                                                                        echo '<option value="'.$row->itinerary_category_id.'" '.$sel.'>'.$row->itinerary_category_name.'</option>';

                                                                    } ?>
                                            </select>
                                            <span class="help-block" style="color:red"></span>
                                    </div>
                                </div>

                                <div class="col-md-3">
                                    <div class="form-group">
                                        <label class="col-lg-7 col-form-label" for="room_tariff_hike_to_date"><b>Itinerary</b> <span class="text-danger">*</span>
                                        </label>
                                            <select name="packages_itinerary_id_fk" id="packages_itinerary_id_fk" class="form-control multi-select" required>                                     
                                                <option value="">Please Select itinerary</option>                            
                                                                    
                                            </select>
                                            <span class="help-block" style="color:red"></span>
                                    </div>
                                </div>

                            </div>

                            <div class="row">
                                
                                <div class="col-md-2">
                                    <label><b>First cover page</b></label>

                                    <input id="packages_first_cover_page" name="packages_first_cover_page"
                                    class="form-control" type="file">

                                    <input id="packages_first_cover_page_txt" name="packages_first_cover_page_txt" type="hidden">

                                    <div id="first_cover_preview" style="margin-top:8px;"></div>

                                </div>


                                <div class="col-md-2">
                                    <label><b>Last cover page</b></label>

                                    <input id="packages_last_cover_page" name="packages_last_cover_page"
                                    class="form-control" type="file">

                                    <input id="packages_last_cover_page_txt" name="packages_last_cover_page_txt" type="hidden">

                                    <div id="last_cover_preview" style="margin-top:8px;"></div>

                                </div>                               
                            </div>

                            
                            
                            <div class="row">
                                <div class="table-responsive">
                                    <table class="table table-responsive-md" id="table1">
                                        <!-- <thead><tr><th><strong>Day</strong></th><th><strong>Stay Destination</strong></th><th><strong>Content</strong></th><th><strong>Change Destination</strong></th><th><strong>change Content</strong></th></tr></thead> -->
                                        <thead>
                                            <tr>
                                                <th>Day</th>
                                                <th>Stay Destination</th>
                                                <th style="width:40%;">Description</th>
                                                <th style="width:15%;">Image</th>
                                                <th>Change Destination</th>
                                                <th>Change Content</th>
                                            </tr>
                                        </thead>

                                        <tbody id="itinerary">
                                                                
                                        </tbody>    
                                       
                                                    </table></div>
                            </div>     
                            
                            

                            <div class="row">
                                
                                <div class="form-check custom-checkbox checkbox-success check-lg me-3"><input type="checkbox" class="form-check-input sc_chkbox"  id="packages_inclusion_exclusion_checked_type" name="packages_inclusion_exclusion_checked_type" value="Y" required=""><label class="form-check-label" for="customCheckBox2"><b>Inclusions and exclusions</b></label></div>
                                    <div class="row" id="inclusionExclusionWrapper">
                                        <div class="col-md-3">
                                            <div class="form-group">
                                                
                                                    <select name="packages_inclusion_exclusion_common_id_fk" id="packages_inclusion_exclusion_common_id_fk" class="form-control multi-select" required>                                     
                                                        <option value="">Please Search by title</option>                            
                                                                            <?php foreach($inclusions_exclusion as $row)
                                                                            {
                                                                                
                                                                                echo '<option value="'.$row->inclusion_exclusion_common_id.'" '.$sel.'>'.$row->inclusion_exclusion_common_title.'</option>';

                                                                            } ?>
                                                    </select>
                                                    <span class="help-block" style="color:red"></span>
                                            </div>
                                        </div>
                                    </div>
                                    <div class="col-xl-6 col-lg-6" id="myDiv2">
                                        <div class="card">
                                            <div class="card-header">
                                                <h4 class="card-title">Inclusions</h4>
                                            </div>
                                            <div class="card-body">
                                                <div class="basic-form">

                                                    <!-- INCLUSIONS -->
                                                    <div id="inclusion"></div>

                                                    <div class="add1">
                                                        <button type="button" class="btn btn-primary add-inclusion">
                                                            + Add new
                                                        </button>
                                                    </div>

                                                </div>
                                            </div>
                                        </div>
                                    </div>
                                    <div class="col-xl-6 col-lg-6" id="myDiv3">
                                        <div class="card">
                                            <div class="card-header">
                                                <h4 class="card-title">exclusions</h4>
                                            </div>
                                            <div class="card-body">
                                                <div class="basic-form">

                                                    <!-- EXCLUSIONS -->
                                                    <div id="exclusion"></div>

                                                    <div class="add2">
                                                        <button type="button" class="btn btn-primary add-exclusion">
                                                            + Add new
                                                        </button>
                                                    </div>

                                                </div>
                                            </div>
                                        </div>
                                    </div>
                            </div><hr>

                            <div class="row">
                                
                                <div class="form-check custom-checkbox checkbox-success check-lg me-3"><input type="checkbox" class="form-check-input sc_chkbox"  id="packages_optional_add_on_checked_type" name="packages_optional_add_on_checked_type" value="Y" required=""><label class="form-check-label" for="customCheckBox2"><b> Add Optional add on</b></label></div>
                                    <div class="col-xl-10 col-lg-10">
                                        <div class="card">
                                            
                                            <div class="card-body">
                                                <div class="basic-form" id="optional-addon">
                                                    
                                                    <div class="mb-3 col-md-6">
                                                        <button class="btn btn-primary add-optional-addon" type="button">+ Add new</button>
                                                        <!-- <button class="btn btn-primary add" type="button" id="submit"  onClick="addMore3();">+ Add new</button> -->
                                                    </div>
                                                </div>
                                            </div>
                                        </div>
                                    </div>
                                    
                            </div><hr>

                            <!-- <div class="row">
                                
                                <div class="form-check custom-checkbox checkbox-success check-lg me-3"><input type="checkbox" class="form-check-input sc_chkbox"  id="packages_special_requirment_checked_type" name="packages_special_requirment_checked_type" value="Y" required=""><label class="form-check-label" for="customCheckBox2"><b> Add Special requirement</b></label></div>
                                    <div class="col-xl-10 col-lg-10">
                                        <div class="card">
                                            
                                            <div class="card-body">
                                                <div class="basic-form" id="special-requirments">
                                                    
                                                     <div class="mb-3 col-md-6">
                                                        <button class="btn btn-primary add" type="button" id="submit"  onClick="addMore4();">+ Add new</button>
                                                    </div>
                                                </div>
                                            </div>
                                        </div>
                                    </div>
                                    
                            </div><hr> -->

                            <div class="row">
                                
                                <div class="form-check custom-checkbox checkbox-success check-lg me-3"><input type="checkbox" class="form-check-input sc_chkbox"  id="packages_payment_policies_checked_type" name="packages_payment_policies_checked_type" value="Y" required=""><label class="form-check-label" for="customCheckBox2"><b>Payment policies </b></label></div>
                                    <div class="row" id="myDiv4">
                                        <div class="col-md-3">
                                            <div class="form-group">
                                                
                                                    <select name="payment_policies_id_fk" id="payment_policies_id_fk" class="form-control multi-select" required>                                     
                                                        <option value="">Please Search by title</option>                            
                                                                            <?php foreach($payment_policies as $row)
                                                                            {
                                                                                
                                                                                echo '<option value="'.$row->payment_policies_id.'" '.$sel.'>'.$row->payment_policies_name.'</option>';

                                                                            } ?>
                                                    </select>
                                                    <span class="help-block" style="color:red"></span>
                                            </div>
                                        </div>
                                    </div>
                                    <div class="col-xl-10 col-lg-10" id="myDiv5">
                                        <div class="card">
                                            
                                            <div class="card-body">
                                                <div class="basic-form" id="payment-policies">
                                                    
                                                    <div class="mb-3 col-md-6 payment_add">
                                                        <button class="btn btn-primary add" type="button" id="submit"  onClick="addMore5();">+ Add new</button>
                                                    </div>
                                                </div>
                                            </div>
                                        </div>
                                    </div>
                                    
                            </div><hr>

                            <div class="row">
                                
                                <div class="form-check custom-checkbox checkbox-success check-lg me-3"><input type="checkbox" class="form-check-input sc_chkbox"  id="packages_terms_conditions_checked_type" name="packages_terms_conditions_checked_type" value="Y" required=""><label class="form-check-label" for="customCheckBox2"><b>Terms & condition</b></label></div>
                                    <div class="row" id="myDiv6">
                                        <div class="col-md-3">
                                            <div class="form-group">
                                                
                                                    <select name="terms_condition_id_fk" id="terms_condition_id_fk" class="form-control multi-select" required>                                     
                                                        <option value="">Please Search by title</option>                            
                                                                            <?php foreach($terms_condition as $row)
                                                                            {
                                                                                
                                                                                echo '<option value="'.$row->terms_condition_id.'" '.$sel.'>'.$row->terms_condition_name.'</option>';

                                                                            } ?>
                                                    </select>
                                                    <span class="help-block" style="color:red"></span>
                                            </div>
                                        </div>
                                    </div>
                                    <div class="col-xl-10 col-lg-10" id="myDiv7">
                                        <div class="card">
                                           
                                            <div class="card-body">
                                                <div class="basic-form" id="terms-conditions">
                                                    
                                                    <div class="mb-3 col-md-6 terms_add">
                                                        <button class="btn btn-primary add" type="button" id="submit"  onClick="addMore6();">+ Add new</button>
                                                    </div>
                                                </div>
                                            </div>
                                        </div>
                                    </div>
                                    
                            </div><hr>

                            <div class="row">
                                
                                <div class="form-check custom-checkbox checkbox-success check-lg me-3"><input type="checkbox" class="form-check-input sc_chkbox"   id="packages_cancellation_policy_checked_type" name="packages_cancellation_policy_checked_type" value="Y" required=""><label class="form-check-label" for="customCheckBox2"><b>Cancellation Policy </b></label></div>
                                    <div class="row" id="myDiv8">
                                        <div class="col-md-3">
                                            <div class="form-group">
                                                
                                                    <select name="cancellation_policies_id_fk" id="cancellation_policies_id_fk" class="form-control multi-select" required>                                     
                                                        <option value="">Please Search by title</option>                            
                                                                            <?php foreach($cancellation_policies as $row)
                                                                            {
                                                                                
                                                                                echo '<option value="'.$row->cancellation_policies_id.'" '.$sel.'>'.$row->cancellation_policies_name.'</option>';

                                                                            } ?>
                                                    </select>
                                                    <span class="help-block" style="color:red"></span>
                                            </div>
                                        </div>
                                    </div>
                                    <div class="col-xl-10 col-lg-10" id="myDiv9">
                                        <div class="card">
                                            
                                            <div class="card-body">
                                                <div class="basic-form" id="cancellation-policy">
                                                   
                                                    <div class="mb-3 col-md-6 terms_add">
                                                        <button class="btn btn-primary add" type="button" id="submit"  onClick="addMore7();">+ Add new</button>
                                                    </div>
                                                </div>
                                            </div>
                                        </div>
                                    </div>
                                    
                            </div><hr>

                            <div class="row">
                                
                                <div class="form-check custom-checkbox checkbox-success check-lg me-3"><input type="checkbox" class="form-check-input sc_chkbox"  id="packages_notes_checked_type" name="packages_notes_checked_type" value="Y" required=""><label class="form-check-label" for="customCheckBox2"><b> Add Notes</b></label></div>
                                    <div class="col-xl-10 col-lg-10">
                                        <div class="card">
                                            
                                            <div class="card-body">
                                                <div class="basic-form" id="add_notes">
                                                    
                                                     <div class="mb-3 col-md-6 terms_add">
                                                        <button class="btn btn-primary add" type="button" id="submit"  onClick="addMore8();">+ Add new</button>
                                                    </div>
                                                </div>
                                            </div>
                                        </div>
                                    </div>
                                    
                            </div><hr>
                           
                            <div class="row">
                                 <div class="form-check custom-checkbox checkbox-success check-lg me-3"><input type="checkbox" class="form-check-input sc_chkbox"  id="packages_property_type" value="Y" name="packages_property_checked_type" required=""><label class="form-check-label" for="customCheckBox2"><b> Add Properties</b></label></div>
                                 <div id="property"></div>   
                                 
                                            <div class="mb-3 col-md-6 terms_add">
                                                        <button class="btn btn-primary add" type="button" id="submit"  onClick="addMore10();">+ Add new</button>
                                                    </div>
                            </div>
                        </form>
                    </div>
                    <div class="modal-footer">
                        <button type="button" class="btn btn-danger light" onclick="Packagemodalclose()" data-bs-dismiss="modal">Close</button>
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
                    <input type="hidden" value="" name="packages_title" id="packages_title2"/>
                    
                </form>
            </div>
            <div class="modal-footer">
                <button type="button" class="btn btn-danger light" onclick="Propertymodalclose()" data-bs-dismiss="modal">Close</button>
                <button type="button" class="btn btn-primary" id="btnSave1" onclick="delete_package_action()" >Delete</button>
            </div>
        </div>
    </div>
</div>

<div id="day-hover-popup" style="display:none;"></div>

<style>
    .itinerary-modal-content {
    max-height: 350px;
    overflow-y: auto;
    padding: 10px;
    font-size: 14px;
    line-height: 1.7;
    background: #fafafa;
    border: 1px solid #e1e1e1;
}

.day-popup {
    max-height: 200px;
    overflow-y: auto;
    border: 1px solid #ddd;
    background: #fff;
    padding: 10px;
    box-shadow: 0 2px 8px rgba(0,0,0,0.2);
    font-size: 13px;
    line-height: 1.5;
}


/* .day-description-tooltip {
    position: fixed;
    width: 420px;
    max-height: 260px;
    overflow-y: auto;
    background: #fff;
    border: 2px solid #1e90ff;
    border-radius: 6px;
    padding: 12px;
    font-size: 13px;
    line-height: 1.5;
    z-index: 99999;
    box-shadow: 0 6px 18px rgba(0,0,0,.25);
    display: none;
} */

/* Tooltip styles for itinerary day descriptions */
.day-description-tooltip {
    position: absolute;
    background: #fff;
    border: 2px solid #007bff;
    border-radius: 8px;
    padding: 15px;
    box-shadow: 0 4px 12px rgba(0,0,0,0.15);
    z-index: 1000;
    min-width: 400px;
    max-width: 500px;
    display: none;
    top: 0;
    right: 100%;
    margin-top: 5px;
    max-height: 300px;
    overflow-y: auto;
    transition: opacity 0.15s ease, transform 0.15s ease;
}

.day-description-tooltip .tooltip-content {
    color: #333;
    font-size: 14px;
    line-height: 1.6;
    word-wrap: break-word;
    cursor: pointer;
}

@media (max-width: 768px) {
    .day-description-tooltip {
        right: auto;
        left: 0;
        width: 100%;
        min-width: unset;
    }
}


/* .change_itinerary_day {
    position: relative;
} */

td.position-relative {
    position: relative;
}

.position-relative {
    position: relative;
}
</style>


