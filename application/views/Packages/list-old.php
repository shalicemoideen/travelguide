<style>
    .modal-lg {
    max-width: 95%;

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
                                                            <select data-validation="required"  data-pms-required="true" class="form-control input-lg multi-select" id="packages_title" name="packages_title" required>  
                            
                                                                    <option value="">Please Select package</option>
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
                                                            <select data-validation="required"  data-pms-required="true" class="form-control input-lg multi-select" id="packages_category_id" name="packages_category_id"  required>  
                            
                                                                   <option value="">Please Select Package category</option>

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
                                                            <select data-validation="required"  data-pms-required="true" class="form-control input-lg multi-select" id="packages_itinerary_category_id" name="packages_itinerary_category_id" required>  
                            
                                                                    <option value="">Please Select property category</option>                            
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
                                                            <input type="text" class="form-control" placeholder="Duration in nights" id="packages_duration_in_nights1" name="packages_duration_in_nights" required>
                                                        </div>
                                                    </div>
                                                </div>                          
                                                <div class="col-sm-6 col-md-5 staff-do-not-show">
                                                    <div class="card">
                                                        <div class="input-group">
                                                            <select name="packages_createdby_user_id" id="packages_createdby_user_id" class="form-control input-lg multi-select" required>                                     
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
                                <h2 class="card-title"><b>Packages Details</b></h2>
                                <a onclick="add_packages()"  data-bs-target="#PackagesModal" class="btn btn-rounded btn-secondary btn-md"><b>+ Create Packages</b></a> 
                            </div>
                            <div class="card-body">
                                <div class="table-responsive">
                                    <table class="table card-table display mb-4 shadow-hover table-responsive-lg" id="Package_registration">
                                        <thead>
                                            <tr>
                                                <th>Sl.no</th>
                                                <th>Package title</th>
                                                <th>Package category</th>
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
        <div class="modal fade" id="PackagesModal" role="dialog" data-backdrop="static"  data-keyboard="false">
            <div class="modal-dialog modal-lg" role="document">
                <div class="modal-content">
                    <div class="modal-header">
                        <h3 class="modal-title"></h5>
                        <button type="button" class="btn-close" onclick="Packagemodalclose()" data-bs-dismiss="modal">
                        </button>
                    </div>
                    <div class="modal-body">
                        
                        <form class="needs-validation" action="#" id="form" >
                            <input type="hidden" value="" name="id" id="id"/> 
                            <div class="row">
                                <div class="col-md-2">
                                    <div class=" form-group">
                                        <label class="col-lg-7 col-form-label" for="packages_title"><b>Package title</b> <span class="text-danger">*</span>
                                        </label>
                                        
                                            <input type="text" class="form-control" name="packages_title" id="packages_title" placeholder="Enter Package title" required>
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
                                        <label class="col-lg-9 col-form-label" for="packages_category_id_fk"><b>Package category</b> <span class="text-danger">*</span>
                                        </label>
                                            <select name="packages_category_id_fk" id="packages_category_id_fk" class="form-control multi-select" required>                                     
                                                <option value="">Select package category</option>                            
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
                                <div class="table-responsive">
                                    <table class="table table-responsive-md" id="table1">
                                        <thead><tr><th><strong>Day</strong></th><th><strong>Stay Destination</strong></th><th><strong>Content</strong></th><th><strong>Change Destination</strong></th><th><strong>change Content</strong></th></tr></thead>
                                        <tbody id="itinerary">
                                                                
                                        </tbody>    
                                        <!-- <thead>
                                            <tr>
                                                <th><strong>Day</strong></th><th><strong>Stay Destination</strong></th><th><strong>Description</strong></th></tr></thead>
                                                        <tbody>
                                                            <tr><td><strong>Day1 | ARRIVAL AT COCHIN & TRANSFER TO MUNNAR</strong></td><td><div class="d-flex align-items-center">Alappuzha</div></td><td>After arrival in Cochin International Airport/Railway. Pickup and proceed to Munnar (The green Paradise of Kerala)

On the way visit Neriamangalam Forest, Cheeyappara and Valara Waterfalls along with the lovely valleys and foggy hills.

Enjoy a guided tour of the lush Spice Garden, where you will learn about various spices, herbs and medicinal plants.

Other Sightseeing/Activity places:- Adventure Park (Zip line, Giant Swing, Bali swing..etc) , Handloom & Chocolate Factory, Hot Air Balloon.

After Arriving Munnar, Get ready to explore the city of Munnar, Visit Rose Garden, Boating in Mattupetty Dam, Tea Factory/ Museum, Photo Point, Elephant Park, Echo Point. </td></tr>
<tr><td><strong>Day 2 | MUNNAR TO ALAPPEY</strong></td><td><div class="d-flex align-items-center">Alappuzha</div></td><td>After arrival in Cochin International Airport/Railway. Pickup and proceed to Munnar (The green Paradise of Kerala)

On the way visit Neriamangalam Forest, Cheeyappara and Valara Waterfalls along with the lovely valleys and foggy hills.

Enjoy a guided tour of the lush Spice Garden, where you will learn about various spices, herbs and medicinal plants.

Other Sightseeing/Activity places:- Adventure Park (Zip line, Giant Swing, Bali swing..etc) , Handloom & Chocolate Factory, Hot Air Balloon.

After Arriving Munnar, Get ready to explore the city of Munnar, Visit Rose Garden, Boating in Mattupetty Dam, Tea Factory/ Museum, Photo Point, Elephant Park, Echo Point. </td></tr>
                                                        </tbody> -->
                                                    </table></div>
                            </div>     
                            
                            

                            <div class="row">
                                
                                <div class="form-check custom-checkbox checkbox-success check-lg me-3"><input type="checkbox" class="form-check-input sc_chkbox"  id="packages_inclusion_exclusion_checked_type" name="packages_inclusion_exclusion_checked_type" value="Y" required=""><label class="form-check-label" for="customCheckBox2"><b>Inclusions and exclusions</b></label></div>
                                    <div class="row" id="myDiv1">
                                        <div class="col-md-3">
                                            <div class="form-group">
                                                <!-- <label class="col-lg-7 col-form-label" for="room_tariff_hike_to_date"><b>Search by title
                                                </label> -->
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
                                                <div class="basic-form" id="inclusion">
                                                    <!-- <form>
                                                        <div class="row">
                                                            <div class="mb-3 col-md-6">
                                                               
                                                                <textarea class="form-control" name="room_tariff_hike_description" id="room_tariff_hike_description"  rows="5" placeholder="Enter Inclusions" required></textarea>
                                                            <span class="help-block" style="color:red"></span>
                                                            </div>
                                                            <div class="mb-3 col-md-6">
                                                                <button class="btn btn-primary add" type="button" id="submit"  >+ Add new</button>
                                                            </div>
                                                            
                                                        </div>
                                                        
                                                    </form> -->
                                                    <div class="mb-3 col-md-6 add1">
                                                                <button class="btn btn-primary" type="button" id="submit"  onClick="addMore1();">+ Add new</button>
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
                                                <div class="basic-form" id="exclusion">
                                                    <!-- <form>
                                                        <div class="row">
                                                            <div class="mb-3 col-md-6">
                                                               
                                                                <textarea class="form-control" name="room_tariff_hike_description" id="room_tariff_hike_description"  rows="5" placeholder="Enter exclusions" required></textarea>
                                                            <span class="help-block" style="color:red"></span>
                                                            </div>
                                                            <div class="mb-3 col-md-6">
                                                                <button class="btn btn-primary add" type="button" id="submit"  >+ Add new</button>
                                                            </div>
                                                            
                                                        </div>
                                                    </form> -->
                                                    <div class="mb-3 col-md-6 add2">
                                                                <button class="btn btn-primary" type="button" id="submit" onClick="addMore2();">+ Add new</button>
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
                                            <!-- <div class="card-header">
                                                <h4 class="card-title"></h4>
                                            </div> -->
                                            <div class="card-body">
                                                <div class="basic-form" id="optional-addon">
                                                    <!-- <form>
                                                
                                      
                                                       <div class="row">
                                                            <div class="mb-3 col-md-6">
                                                               
                                                                 <textarea class="form-control" name="room_tariff_hike_description" id="room_tariff_hike_description"  rows="5" placeholder="Enter Optional add on" required></textarea>
                                                            <span class="help-block" style="color:red"></span>
                                                            </div>
                                                            <div class="mb-3 col-md-6">
                                                                <button class="btn btn-primary add" type="button" id="submit"  >+ Add new</button>
                                                            </div>
                                                            
                                                        </div> 
                                                    </form> -->

                                                    <div class="mb-3 col-md-6">
                                                        <button class="btn btn-primary add" type="button" id="submit"  onClick="addMore3();">+ Add new</button>
                                                    </div>
                                                </div>
                                            </div>
                                        </div>
                                    </div>
                                    
                            </div><hr>

                            <div class="row">
                                
                                <div class="form-check custom-checkbox checkbox-success check-lg me-3"><input type="checkbox" class="form-check-input sc_chkbox"  id="packages_special_requirment_checked_type" name="packages_special_requirment_checked_type" value="Y" required=""><label class="form-check-label" for="customCheckBox2"><b> Add Special requirement</b></label></div>
                                    <div class="col-xl-10 col-lg-10">
                                        <div class="card">
                                            <!-- <div class="card-header">
                                                <h4 class="card-title"></h4>
                                            </div> -->
                                            <div class="card-body">
                                                <div class="basic-form" id="special-requirments">
                                                    <!-- <form>
                                                
                                      
                                                       <div class="row">
                                                            <div class="mb-3 col-md-3">
                                                                 <select name="properties_id_fk" id="properties_id_fk" class="form-control multi-select" required>                                     
                                                                    <option value="">Please Search by title</option>                            
                                                                                        <?php foreach($property as $row)
                                                                                        {
                                                                                            
                                                                                            echo '<option value="'.$row->properties_id.'" '.$sel.'>'.$row->properties_name.'</option>';

                                                                                        } ?>
                                                                </select>
                                                            <span class="help-block" style="color:red"></span>
                                                            </div>
                                                            <div class="mb-3 col-md-3">
                                                                <input type="text" class="form-control" name="payment_policies_name" id="payment_policies_name" placeholder="Enter amount" required>
                                                            </div>
                                                            <div class="mb-3 col-md-3">
                                                                <button class="btn btn-primary add" type="button" id="submit"  >+ Add new</button>
                                                            </div>
                                                            
                                                        </div> 
                                                    </form> -->
                                                     <div class="mb-3 col-md-6">
                                                        <button class="btn btn-primary add" type="button" id="submit"  onClick="addMore4();">+ Add new</button>
                                                    </div>
                                                </div>
                                            </div>
                                        </div>
                                    </div>
                                    
                            </div><hr>

                            <div class="row">
                                
                                <div class="form-check custom-checkbox checkbox-success check-lg me-3"><input type="checkbox" class="form-check-input sc_chkbox"  id="packages_payment_policies_checked_type" name="packages_payment_policies_checked_type" value="Y" required=""><label class="form-check-label" for="customCheckBox2"><b>Payment policies </b></label></div>
                                    <div class="row" id="myDiv4">
                                        <div class="col-md-3">
                                            <div class="form-group">
                                                <!-- <label class="col-lg-7 col-form-label" for="room_tariff_hike_to_date"><b>Search by title
                                                </label> -->
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
                                            <!-- <div class="card-header">
                                                <h4 class="card-title">Inclusions</h4>
                                            </div> -->
                                            <div class="card-body">
                                                <div class="basic-form" id="payment-policies">
                                                    <!-- <form>
                                                        <div class="row">
                                                            <div class="mb-3 col-md-6">
                                                                 <textarea class="form-control" name="room_tariff_hike_description" id="room_tariff_hike_description"  rows="5" placeholder="Enter payment policies" required></textarea>
                                                            <span class="help-block" style="color:red"></span>
                                                            </div>
                                                            <div class="mb-3 col-md-6">
                                                                <button class="btn btn-primary add" type="button" id="submit"  >+ Add new</button>
                                                            </div>
                                                            
                                                        </div>
                                                        
                                                    </form> -->
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
                                                <!-- <label class="col-lg-7 col-form-label" for="room_tariff_hike_to_date"><b>Search by title
                                                </label> -->
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
                                            <!-- <div class="card-header">
                                                <h4 class="card-title">Inclusions</h4>
                                            </div> -->
                                            <div class="card-body">
                                                <div class="basic-form" id="terms-conditions">
                                                    <!-- <form>
                                                        <div class="row">
                                                            <div class="mb-3 col-md-6">
                                                                 <textarea class="form-control" name="room_tariff_hike_description" id="room_tariff_hike_description"  rows="5" placeholder="Enter Terms & condition" required></textarea>
                                                            <span class="help-block" style="color:red"></span>
                                                            </div>
                                                            <div class="mb-3 col-md-6">
                                                                <button class="btn btn-primary add" type="button" id="submit"  >+ Add new</button>
                                                            </div>
                                                            
                                                        </div>
                                                        
                                                    </form> -->
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
                                                <!-- <label class="col-lg-7 col-form-label" for="room_tariff_hike_to_date"><b>Search by title
                                                </label> -->
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
                                            <!-- <div class="card-header">
                                                <h4 class="card-title">Inclusions</h4>
                                            </div> -->
                                            <div class="card-body">
                                                <div class="basic-form" id="cancellation-policy">
                                                    <!-- <form>
                                                        <div class="row">
                                                            <div class="mb-3 col-md-6">
                                                                 <textarea class="form-control" name="room_tariff_hike_description" id="room_tariff_hike_description"  rows="5" placeholder="Enter Cancellation Policy " required></textarea>
                                                            <span class="help-block" style="color:red"></span>
                                                            </div>
                                                            <div class="mb-3 col-md-6">
                                                                <button class="btn btn-primary add" type="button" id="submit"  >+ Add new</button>
                                                            </div>
                                                            
                                                        </div>
                                                        
                                                    </form> -->
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
                                            <!-- <div class="card-header">
                                                <h4 class="card-title"></h4>
                                            </div> -->
                                            <div class="card-body">
                                                <div class="basic-form" id="add_notes">
                                                    <!-- <form>
                                                
                                      
                                                       <div class="row">
                                                            <div class="mb-3 col-md-6">
                                                                 <textarea class="form-control" name="room_tariff_hike_description" id="room_tariff_hike_description"  rows="5" placeholder="Enter Notes" required></textarea>
                                                            <span class="help-block" style="color:red"></span>
                                                            </div>
                                                            <div class="mb-3 col-md-6">
                                                                <button class="btn btn-primary add" type="button" id="submit"  >+ Add new</button>
                                                            </div>
                                                            
                                                        </div> 
                                                    </form> -->
                                                     <div class="mb-3 col-md-6 terms_add">
                                                        <button class="btn btn-primary add" type="button" id="submit"  onClick="addMore8();">+ Add new</button>
                                                    </div>
                                                </div>
                                            </div>
                                        </div>
                                    </div>
                                    
                            </div><hr>
                           
                            <div class="row">
                                 <div class="form-check custom-checkbox checkbox-success check-lg me-3"><input type="checkbox" class="form-check-input sc_chkbox"  id="packages_property_type" value="" required=""><label class="form-check-label" for="customCheckBox2"><b> Add Properties</b></label></div>
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
                    <input type="hidden" value="" name="properties_name" id="properties_name"/>
                    
                </form>
            </div>
            <div class="modal-footer">
                <button type="button" class="btn btn-danger light" onclick="Propertymodalclose()" data-bs-dismiss="modal">Close</button>
                <button type="button" class="btn btn-primary" id="btnSave1" onclick="delete_room_tariff_action()" >Delete</button>
            </div>
        </div>
    </div>
</div>