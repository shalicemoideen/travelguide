 <style>
    .modal-lg {
    max-width: 80%;

    .modal-body {
    max-height: calc(100vh - 210px);
    overflow-y: auto;
}
}
.modal-lg-tariff {
    max-width: 95%;

    .modal-body {
    max-height: calc(100vh - 210px);
    overflow-y: auto;
}
}
</style>

<?php $boat_type = array('Y'=>"Yes",'N'=>"No"); ?>
<?php $check_type = array('T'=>"24 hours",'O'=>"Other"); ?>
 <!--**********************************
            Content body start
        ***********************************-->
        <div class="content-body">
            <div class="container-fluid">
                <div class="row">

                    <div class="col-xl-12">
                        <div class="card">
                            <div class="card-header">
                                <!-- <h4 class="card-title">Custom Tab 1</h4> -->
                                <input type="hidden"  class="form-control" id="properties_id_fk_hidden" value="<?php if(isset($records->properties_id)) echo $records->properties_id ?>">
                            </div>
                            <div class="card-body">
                                <!-- Nav tabs -->
                                <div class="custom-tab-1  panel-body">
                                    <!-- <ul class="nav nav-tabs">
                                        <li class="nav-item prof_cls" id="Property">
                                            <a href="#" class="nav-link active" data-page="Property_details" id="Property_details" onclick="return Property_details('<?php echo $records->properties_id ?>')"><i class="la la-home me-2"></i> Home</a>
                                        </li>
                                        <li class="nav-item prof_cls" id="Rooms">
                                            <a href="#" class="nav-link" data-page="Room_details" id="Room_details" onclick="return Room_details('<?php echo $records->properties_id ?>')"><i class="la la-user me-2"></i> Rooms</a>
                                        </li>
                                        <li class="nav-item prof_cls" id="Upload_tariff">
                                            <a href="#" class="nav-link" data-page="Upload_tariff_details" id="Upload_tariff_details" onclick="return Upload_tariff_details('<?php echo $records->properties_id ?>')"><i class="la la-user me-2"></i> Upload tariff</a>
                                        </li>
                                        <li class="nav-item prof_cls" id="Room_tariff">
                                            <a href="#" class="nav-link" data-page="Room_tariff_management" id="Room_tariff_management" onclick="return Room_tariff_management('<?php echo $records->properties_id ?>')"><i class="la la-user me-2"></i> Room tariff</a>
                                        </li>
                                        <li class="nav-item prof_cls" id="Property_inclusion">
                                            <a href="#" class="nav-link" data-page="Property_inclusion_details" id="Property_inclusion_details" onclick="return Property_inclusion_details('<?php echo $records->properties_id ?>')"><i class="la la-user me-2"></i> Property inclusion</a>
                                        </li>

                                    </ul> -->
                                    <!-- <ul class="nav nav-tabs" id="propertyTab" role="tablist">

                                        <li class="nav-item" role="presentation">
                                            <button class="nav-link active" 
                                                    id="home-tab" 
                                                    data-bs-toggle="tab" 
                                                    data-bs-target="#Property_details" 
                                                    type="button" 
                                                    role="tab">
                                                Home
                                            </button>
                                        </li>

                                        <li class="nav-item" role="presentation">
                                            <button class="nav-link" 
                                                    id="rooms-tab" 
                                                    data-bs-toggle="tab" 
                                                    data-bs-target="#Room_details" 
                                                    type="button" 
                                                    role="tab">
                                                Rooms
                                            </button>
                                        </li>

                                        <li class="nav-item" role="presentation">
                                            <button class="nav-link" 
                                                    id="upload-tab" 
                                                    data-bs-toggle="tab" 
                                                    data-bs-target="#Upload_tariff_details" 
                                                    type="button" 
                                                    role="tab">
                                                Upload Tariff
                                            </button>
                                        </li>

                                        <li class="nav-item" role="presentation">
                                            <button class="nav-link" 
                                                    id="room-tariff-tab" 
                                                    data-bs-toggle="tab" 
                                                    data-bs-target="#Room_tariff_management" 
                                                    type="button" 
                                                    role="tab">
                                                Room Tariff
                                            </button>
                                        </li>

                                        <li class="nav-item" role="presentation">
                                            <button class="nav-link" 
                                                    id="inclusion-tab" 
                                                    data-bs-toggle="tab" 
                                                    data-bs-target="#Property_inclusion_details" 
                                                    type="button" 
                                                    role="tab">
                                                Property Inclusion
                                            </button>
                                        </li>

                                    </ul> -->
                                    
                                    <ul class="nav nav-tabs" id="propertyTab" role="tablist">
                                        <li class="nav-item" role="presentation">
                                            <button class="nav-link active" id="home-tab"
                                                    data-bs-toggle="tab" data-bs-target="#Property_details"
                                                    type="button" role="tab">
                                            Home
                                            </button>
                                        </li>

                                        <li class="nav-item" role="presentation">
                                            <button class="nav-link" id="rooms-tab"
                                                    data-bs-toggle="tab" data-bs-target="#Room_details"
                                                    type="button" role="tab">
                                            Room category
                                            </button>
                                        </li>

                                        <li class="nav-item" role="presentation">
                                            <button class="nav-link" id="upload-tab"
                                                    data-bs-toggle="tab" data-bs-target="#Upload_tariff_details"
                                                    type="button" role="tab">
                                            Upload Tariff
                                            </button>
                                        </li>

                                        <li class="nav-item" role="presentation">
                                            <button class="nav-link" id="roomtariff-tab"
                                                    data-bs-toggle="tab" data-bs-target="#Room_tariff_management"
                                                    type="button" role="tab">
                                            Room Tariff
                                            </button>
                                        </li>

                                        <li class="nav-item" role="presentation">
                                            <button class="nav-link" id="roomhiketariff-tab"
                                                    data-bs-toggle="tab" data-bs-target="#Room_tariff_hike_management"
                                                    type="button" role="tab">
                                            Room Hike Tariff
                                            </button>
                                        </li>

                                        <li class="nav-item" role="presentation">
                                            <button class="nav-link" id="inclusion-tab"
                                                    data-bs-toggle="tab" data-bs-target="#Property_inclusion_details"
                                                    type="button" role="tab">
                                            Property Inclusion
                                            </button>
                                        </li>
                                    </ul>

                                    

                                    <div class="tab-content mt-3" id="propertyTabContent">

                                        <div class="tab-pane fade show active" id="Property_details" role="tabpanel">
                                            <div  class="col-lg-12">
                                                <div class="card">
                                                    <div class="card-header">
                                                        <h4 class="card-title">Property details</h4>
                                                    </div>
                                                    <div class="card-body">
                                                        <div class="form-validation">
                                                            <form class="needs-validation" novalidate >
                                                                <div class="row">
                                                                    <div class="col-xl-6">
                                                                        <div class="mb-3 row">
                                                                            <input type="hidden"  class="form-control" id="Id" value="<?php if(isset($records->properties_id)) echo $records->properties_id ?>">
                                                                            <label class="col-lg-4 col-form-label" for="validationCustom01">Name
                                                                            </label>
                                                                            <div class="col-lg-6">
                                                                                <?php if(isset($records->properties_name)) echo $records->properties_name ?>
                                                                            </div>
                                                                        </div>
                                                                        <div class="mb-3 row">
                                                                            <label class="col-lg-4 col-form-label" for="validationCustom02">Category 
                                                                            </label>
                                                                            <div class="col-lg-6">
                                                                                <?php if(isset($records->property_category_name)) echo $records->property_category_name ?>
                                                                            </div>
                                                                        </div>
                                                                        <div class="mb-3 row">
                                                                            <label class="col-lg-4 col-form-label" for="validationCustom03">Nation      
                                                                            </label>
                                                                            <div class="col-lg-6">
                                                                                <?php if(isset($records->name)) echo $records->name ?>
                                                                            </div>
                                                                        </div>
                                                                        <div class="mb-3 row">
                                                                            <label class="col-lg-4 col-form-label" for="validationCustom04">Location 
                                                                            </label>
                                                                            <div class="col-lg-6">
                                                                                <?php if(isset($records->plname)) echo $records->plname ?>
                                                                            </div>
                                                                        </div>
                                                                        <div class="mb-3 row">
                                                                            <label class="col-lg-4 col-form-label" for="validationCustom05">Destination
                                                                            </label>
                                                                            <div class="col-lg-6">
                                                                                <?php if(isset($records->rcname)) echo $records->rcname ?>
                                                                            </div>
                                                                        </div>
                                                                        <div class="mb-3 row">
                                                                            <label class="col-lg-4 col-form-label" for="validationCustom06">Boat type
                                                                            </label>
                                                                            <div class="col-lg-6">
                                                                                <?php if(isset($records->properties_house_boat_type)) echo $boat_type[$records->properties_house_boat_type] ?>
                                                                            </div>
                                                                        </div>
                                                                        <div class="mb-3 row">
                                                                            <label class="col-lg-4 col-form-label" for="validationCustom07">Hotel url                
                                                                            </label>
                                                                            <div class="col-lg-6">
                                                                                <?php if(isset($records->properties_hotel_url)) echo $records->properties_hotel_url ?>
                                                                            </div>
                                                                        </div>
                                                                        <div class="mb-3 row">
                                                                            <label class="col-lg-4 col-form-label" for="validationCustom08">Checking type
                                                                            </label>
                                                                            <div class="col-lg-6">
                                                                                <?php if(isset($records->properties_check_type)) echo $check_type[$records->properties_check_type]?>
                                                                            </div>
                                                                        </div>
                                                                        <div class="mb-3 row">
                                                                            <label class="col-lg-4 col-form-label" for="validationCustom09">Check in time 
                                                                            </label>
                                                                            <div class="col-lg-6">
                                                                                    <?php if(isset($records->properties_check_in_time)) echo $records->properties_check_in_time ?>
                                                                            </div>
                                                                        </div>
                                                                        <div class="mb-3 row">
                                                                            <label class="col-lg-4 col-form-label" for="validationCustom10">Check out time <span
                                                                                    class="text-danger">*</span>
                                                                            </label>
                                                                            <div class="col-lg-6">
                                                                                    <?php if(isset($records->properties_check_out_time)) echo $records->properties_check_out_time ?>
                                                                            </div>
                                                                        </div>
                                                                        <div class="mb-3 row">
                                                                            <label class="col-lg-4 col-form-label" for="validationCustom11">Sales contact name              
                                                                            </label>
                                                                            <div class="col-lg-6">
                                                                                <?php if(isset($records->properties_sales_contact_name)) echo $records->properties_sales_contact_name ?>
                                                                            </div>
                                                                        </div>
                                                                        <div class="mb-3 row">
                                                                            <label class="col-lg-4 col-form-label" for="validationCustom11">Sales contact number              
                                                                            </label>
                                                                            <div class="col-lg-6">
                                                                                <?php if(isset($records->properties_sales_contact_phone_number)) echo $records->properties_sales_contact_phone_number ?>
                                                                            </div>
                                                                        </div>
                                                                        <div class="mb-3 row">
                                                                            <label class="col-lg-4 col-form-label" for="validationCustom11">Sales contact email              
                                                                            </label>
                                                                            <div class="col-lg-6">
                                                                                <?php if(isset($records->properties_sales_contact_email)) echo $records->properties_sales_contact_email ?>
                                                                            </div>
                                                                        </div>
                                                                        <div class="mb-3 row">
                                                                            <label class="col-lg-4 col-form-label" for="validationCustom11">Reservation contact name              
                                                                            </label>
                                                                            <div class="col-lg-6">
                                                                                <?php if(isset($records->properties_reservation_contact_name)) echo $records->properties_reservation_contact_name ?>
                                                                            </div>
                                                                        </div>
                                                                    </div>
                                                                    <div class="col-xl-6">                
                                                                        <div class="mb-3 row">
                                                                            <label class="col-lg-4 col-form-label" for="validationCustom11">Reservation contact number              
                                                                            </label>
                                                                            <div class="col-lg-6">
                                                                                <?php if(isset($records->properties_reservation_contact_phone_number)) echo $records->properties_reservation_contact_phone_number ?>
                                                                            </div>
                                                                        </div>
                                                                        <div class="mb-3 row">
                                                                            <label class="col-lg-4 col-form-label" for="validationCustom11">Reservation contact email              
                                                                            </label>
                                                                            <div class="col-lg-6">
                                                                                <?php if(isset($records->properties_reservation_contact_email)) echo $records->properties_reservation_contact_email ?>
                                                                            </div>
                                                                        </div>
                                                                        <div class="mb-3 row">
                                                                            <label class="col-lg-4 col-form-label" for="validationCustom11">Google location map            
                                                                            </label>
                                                                            <div class="col-lg-6">
                                                                                <?php if(isset($records->properties_google_map_location)) echo $records->properties_google_map_location ?>
                                                                            </div>
                                                                        </div>
                                                                        <div class="mb-3 row">
                                                                            <label class="col-lg-4 col-form-label" for="validationCustom11">Hotel logo
                                                                            </label>
                                                                            <div class="col-lg-6">
                                                                                <?php if(isset($records->properties_hotel_logo) && $records->properties_hotel_logo): ?>
                                                                                    <?php
                                                                                        $logoFile = $records->properties_hotel_logo;
                                                                                        $logoExt  = pathinfo($logoFile, PATHINFO_EXTENSION);
                                                                                        $logoName = (isset($records->properties_name) ? $records->properties_name : 'property') . '_logo.' . $logoExt;
                                                                                    ?>
                                                                                    <button type="button" class="btn btn-sm btn-primary"
                                                                                        onclick="downloadViewFile('<?php echo base_url(); ?>uploads/Property-doc/logo/<?php echo $logoFile; ?>', '<?php echo htmlspecialchars($logoName); ?>')">
                                                                                        <i class="fa fa-download"></i> Download Logo
                                                                                    </button>
                                                                                <?php endif; ?>
                                                                            </div>
                                                                        </div>
                                                                        <div class="mb-3 row">
                                                                            <label class="col-lg-4 col-form-label" for="validationCustom11">Property photos
                                                                            </label>
                                                                            <div class="col-lg-6">
                                                                                <?php if(isset($records->properties_photos) && $records->properties_photos): ?>
                                                                                    <?php
                                                                                        $photoFile = $records->properties_photos;
                                                                                        $photoExt  = pathinfo($photoFile, PATHINFO_EXTENSION);
                                                                                        $photoName = (isset($records->properties_name) ? $records->properties_name : 'property') . '.' . $photoExt;
                                                                                    ?>
                                                                                    <button type="button" class="btn btn-sm btn-primary"
                                                                                        onclick="downloadViewFile('<?php echo base_url(); ?>uploads/Property-doc/photo/<?php echo $photoFile; ?>', '<?php echo htmlspecialchars($photoName); ?>')">
                                                                                        <i class="fa fa-download"></i> Download Photo
                                                                                    </button>
                                                                                <?php endif; ?>
                                                                            </div>
                                                                        </div>
                                                                        <div class="mb-3 row">
                                                                            <label class="col-lg-4 col-form-label" for="validationCustom11">Description           
                                                                            </label>
                                                                            <div class="col-lg-6">
                                                                                <?php if(isset($records->properties_description)) echo $records->properties_description ?>
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

                                        <div class="tab-pane fade" id="Room_details" role="tabpanel">
                                            <div id="Room_details_container" class="p-2">Open tab to load…</div>
                                        </div>

                                        <div class="tab-pane fade" id="Upload_tariff_details" role="tabpanel">
                                            <div id="Upload_tariff_details_container" class="p-2">Open tab to load…</div>
                                        </div>

                                        <div class="tab-pane fade" id="Room_tariff_management" role="tabpanel">
                                            <div id="Room_tariff_management_container" class="p-2">Open tab to load…</div>
                                        </div>

                                        <div class="tab-pane fade" id="Room_tariff_hike_management" role="tabpanel">
                                            <div id="Room_tariff_hike_management_container" class="p-2">Open tab to load…</div>
                                        </div>

                                        <div class="tab-pane fade" id="Property_inclusion_details" role="tabpanel">
                                            <div id="Property_inclusion_details_container" class="p-2">Open tab to load…</div>
                                        </div>

                                    </div>
                                    <input type="hidden" id="property_id" value="<?php echo $records->properties_id; ?>">
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
                            <input type="hidden" value="" name="id1" id="id1"/> 
                            <input type="hidden" value="" name="properties_id_fk" id="properties_id_fk"/>
                            <div class="row">
                                <div class="col-md-4">
                                    <div class=" form-group">
                                        <label class="col-lg-3 col-form-label" for="properties_room_category_name"><b>Name</b> <span class="text-danger">*</span>
                                        </label>
                                        
                                            <input type="text" class="form-control" name="properties_room_category_name" id="properties_room_category_name" placeholder="Enter room category name" required>
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
                                            <input type="number" class="form-control" name="properties_room_category_inventory" id="properties_room_category_inventory" placeholder="Enter room category Inventory" required>
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
        <div class="modal fade" id="Tariff_uploadedModal" role="dialog" data-backdrop="static"  data-keyboard="false">
            <div class="modal-dialog" role="document">
                <div class="modal-content">
                    <div class="modal-header">
                        <h5 class="modal-title"></h5>
                        <button type="button" class="btn-close" onclick="Tariffuploadedmodalclose()" data-bs-dismiss="modal">
                        </button>
                    </div>
                    <div class="modal-body">
                        
                        <form class="needs-validation" action="#" id="form3" >
                            <input type="hidden" value="" name="id3" id="id3"/> 
                            <input type="hidden" value="" name="properties_id_fk" id="properties_id_fk1"/>
                            <div class="row">
                                <div class="col-xl-9">
                                    <div class="mb-3 row form-group">
                                        <label class="col-lg-4 col-form-label" for="upload_tariff_document_from_date">From date
                                            <span class="text-danger">*</span>
                                        </label>
                                        <div class="col-lg-8 upload_tariff_document_from_date">
                                            <input type="text" class="form-control" name="upload_tariff_document_from_date" id="upload_tariff_document_from_date" placeholder="Enter From date" required>
                                            <span class="help-block" style="color:red"></span>
                                        </div>
                                    </div>
                                    <div class="mb-3 row form-group">
                                        <label class="col-lg-4 col-form-label" for="upload_tariff_document_to_date">End date
                                            <span class="text-danger">*</span>
                                        </label>
                                        <div class="col-lg-8 upload_tariff_document_to_date">
                                            <input type="text" class="form-control" name="upload_tariff_document_to_date" id="upload_tariff_document_to_date" placeholder="Enter end date" required>
                                            <span class="help-block" style="color:red"></span>
                                        </div>
                                    </div>
                                    <div class="mb-3 row form-group">
                                        <label class="col-lg-4 col-form-label" for="upload_tariff_document_name">Document
                                            <span class="text-danger">*</span>
                                        </label>
                                        <div class="col-lg-8 upload_tariff_document_name">
                                            <input id="upload_tariff_document_name" name="upload_tariff_document_name" class="form-control" type="file" required>
                                                <span class="help-block" style="color:red"></span>
                                                <input id="upload_tariff_document_name_txt" name="upload_tariff_document_name_txt" type="hidden">
                                        </div>
                                    </div>
                                    <div class="mb-3 row">
                                        <label class="col-lg-4 col-form-label" for="upload_tariff_document_description">Description 
                                        </label>
                                        <div class="col-lg-8">
                                            <textarea class="form-control" name="upload_tariff_document_description" id="upload_tariff_document_description"  rows="5" placeholder="Enter Description" required></textarea>
                                            <div class="invalid-feedback">
                                                Please enter a Description.
                                            </div>
                                        </div>
                                    </div>
                                </div>
                            </div>
                        </form>
                    </div>
                    <div class="modal-footer">
                        <button type="button" class="btn btn-danger light" onclick="Tariffuploadedmodalclose()" data-bs-dismiss="modal">Close</button>
                        <button type="button" class="btn btn-primary" id="btnSave3" onclick="save2()" >Save</button>
                    </div>
                </div>
            </div>
        </div>

        <!-- Modal -->
        <div class="modal fade" id="RoomTariffModal" role="dialog" data-backdrop="static"  data-keyboard="false">
            <div class="modal-dialog modal-lg-tariff" role="document">
                <div class="modal-content">
                    <div class="modal-header">
                        <h3 class="modal-title"></h5>
                        <button type="button" class="btn-close" onclick="RoomTariffmodalclose()" data-bs-dismiss="modal">
                        </button>
                    </div>
                    <form class="needs-validation sl-cust-validation" action="#" id="form5" >
                        <div class="modal-body">
                        
                            <input type="hidden" value="" name="id" id="id5"/> 
                            <input type="hidden"  class="form-control" id="properties_id_fk" name="properties_id_fk" value="<?php if(isset($records->properties_id)) echo $records->properties_id ?>">
                            <div class="row">
                                <div class="col-md-4">
                                    <div class="form-group">
                                        <label class="col-lg-7 col-form-label" for="room_tariff_hike_from_date"><b>From date</b> <span class="text-danger">*</span>
                                        </label>
                                            <input type="text" class="form-control" name="room_tariff_hike_from_date" id="room_tariff_hike_from_date" placeholder="Enter From date" required>
                                            <span class="help-block" style="color:red"></span>
                                    </div>
                                </div>

                                <div class="col-md-4">
                                    <div class="form-group">
                                        <label class="col-lg-7 col-form-label" for="room_tariff_hike_to_date"><b>To date</b> <span class="text-danger">*</span>
                                        </label>
                                            <input type="text" class="form-control" name="room_tariff_hike_to_date" id="room_tariff_hike_to_date" placeholder="Enter To date" required>
                                            <span class="help-block" style="color:red"></span>
                                    </div>
                                </div>

                            </div>
                                    
                            <div class="row">
                                <div class="col-md-3">
                                    <div class="form-group">
                                        <label class="col-lg-8 col-form-label" for="room_tariff_hike_breakfast_rate_adult"><b>Adult breakfast rate</b> <span class="text-danger">*</span>
                                        </label>
                                            <input type="number" class="form-control" name="room_tariff_hike_breakfast_rate_adult" id="room_tariff_hike_breakfast_rate_adult" placeholder="Enter Adult breakfast rate" required>
                                            <span class="help-block" style="color:red"></span>
                                    </div>
                                </div>

                                <div class="col-md-3">
                                    <div class="form-group">
                                        <label class="col-lg-8 col-form-label" for="room_tariff_hike_breakfast_rate_child"><b>Child breakfast rate</b> <span class="text-danger">*</span>
                                        </label>
                                            <input type="number" class="form-control" name="room_tariff_hike_breakfast_rate_child" id="room_tariff_hike_breakfast_rate_child" placeholder="Enter Child breakfast rate" required>
                                            <span class="help-block" style="color:red"></span>
                                    </div>
                                </div>

                                <div class="col-md-3">
                                    <div class="form-group">
                                        <label class="col-lg-8 col-form-label" for="room_tariff_hike_lunch_rate_adult"><b>Adult lunch rate</b> <span class="text-danger">*</span>
                                        </label>
                                            <input type="number" class="form-control" name="room_tariff_hike_lunch_rate_adult" id="room_tariff_hike_lunch_rate_adult" placeholder="Enter Adult lunch rate" required>
                                            <span class="help-block" style="color:red"></span>
                                    </div>
                                </div>
                                
                                <div class="col-md-3">
                                    <div class="form-group">
                                        <label class="col-lg-8 col-form-label" for="room_tariff_hike_lunch_rate_child"><b>Child lunch rate</b> <span class="text-danger">*</span>
                                        </label>
                                            <input type="number" class="form-control" name="room_tariff_hike_lunch_rate_child" id="room_tariff_hike_lunch_rate_child" placeholder="Enter Child lunch rate" required>
                                            <span class="help-block" style="color:red"></span>
                                    </div>
                                </div>
                            </div>

                            <div class="row">
                                

                                <div class="col-md-3">
                                    <div class="form-group">
                                        <label class="col-lg-7 col-form-label" for="room_tariff_hike_dinner_rate_adult"><b>Adult dinner rate</b> <span class="text-danger">*</span>
                                        </label>
                                            <input type="number" class="form-control" name="room_tariff_hike_dinner_rate_adult" id="room_tariff_hike_dinner_rate_adult" placeholder="Enter Adult dinner rate" required>
                                            <span class="help-block" style="color:red"></span>
                                    </div>
                                </div>

                                <div class="col-md-3">
                                    <div class="form-group">
                                        <label class="col-lg-7 col-form-label" for="room_tariff_hike_dinner_rate_child"><b>Child dinner rate</b> <span class="text-danger">*</span>
                                        </label>
                                            <input type="number" class="form-control" name="room_tariff_hike_dinner_rate_child" id="room_tariff_hike_dinner_rate_child" placeholder="Enter Child dinner rate" required>
                                            <span class="help-block" style="color:red"></span>
                                    </div>
                                </div>
                                
                                <div class="col-md-3">
                                    <div class="form-group">
                                        <label class="col-lg-5 col-form-label" for="room_tariff_hike_description"><b>Description</b>
                                        </label>
                                            <textarea class="form-control" name="room_tariff_hike_description" id="room_tariff_hike_description"  rows="5" placeholder="Enter Description"></textarea>
                                            <span class="help-block" style="color:red"></span>
                                    </div>
                                </div>
                            </div>

                            <div id="row1">
                                
                                
                            </div>

                            <div id="row2" >
                                
                            </div>
                        </div>
                        <div class="modal-footer">
                            <button type="button" class="btn btn-danger light" onclick="Propertymodalclose()" data-bs-dismiss="modal">Close</button>
                            <button type="submit" class="btn btn-primary" id="btnSave" onclick="save_tariff()">Save</button>
                        </div>
                    </form>
                </div>
            </div>
        </div>

        <!-- VIEW MODAL -->
<div class="modal fade" id="RoomTariffViewModal" tabindex="-1" role="dialog" data-backdrop="static" data-keyboard="false">
  <div class="modal-dialog modal-xl" role="document">
    <div class="modal-content">

      <div class="modal-header">
        <h4 class="modal-title">Room Tariff Details</h4>
        <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
      </div>

      <div class="modal-body">

        <!-- Header summary -->
        <div class="card mb-3">
          <div class="card-body">
            <div class="row g-3">
              <div class="col-md-4">
                <div class="text-muted">Property</div>
                <div class="fw-bold" id="vw_property_name">-</div>
              </div>

              <div class="col-md-4">
                <div class="text-muted">Hike Period</div>
                <div class="fw-bold">
                  <span id="vw_from_date">-</span> to <span id="vw_to_date">-</span>
                </div>
              </div>

              <div class="col-md-4">
                <div class="text-muted">Created</div>
                <div class="fw-bold">
                  <span id="vw_created_date">-</span> <span id="vw_created_time">-</span>
                </div>
                <div class="small text-muted" id="vw_created_by">-</div>
              </div>
            </div>

            <hr>

            <div class="row g-3">
              <div class="col-md-3">
                <div class="text-muted">Breakfast (Adult)</div>
                <div class="fw-bold" id="vw_bf_adult">-</div>
              </div>
              <div class="col-md-3">
                <div class="text-muted">Breakfast (Child)</div>
                <div class="fw-bold" id="vw_bf_child">-</div>
              </div>
              <div class="col-md-3">
                <div class="text-muted">Lunch (Adult)</div>
                <div class="fw-bold" id="vw_lunch_adult">-</div>
              </div>
              <div class="col-md-3">
                <div class="text-muted">Lunch (Child)</div>
                <div class="fw-bold" id="vw_lunch_child">-</div>
              </div>

              <div class="col-md-3">
                <div class="text-muted">Dinner (Adult)</div>
                <div class="fw-bold" id="vw_dinner_adult">-</div>
              </div>
              <div class="col-md-3">
                <div class="text-muted">Dinner (Child)</div>
                <div class="fw-bold" id="vw_dinner_child">-</div>
              </div>

              <div class="col-md-6">
                <div class="text-muted">Description</div>
                <div class="fw-bold" id="vw_desc">-</div>
              </div>
            </div>
          </div>
        </div>

        <!-- Rooms container -->
        <div id="vw_rooms_container"></div>

      </div>

      <div class="modal-footer">
        <button type="button" class="btn btn-danger light" data-bs-dismiss="modal">Close</button>
      </div>

    </div>
  </div>
</div>

<div class="modal fade" id="HikeRoomTariffModal" role="dialog" data-backdrop="static" data-keyboard="false">
  <div class="modal-dialog modal-lg" role="document">
    <div class="modal-content">

      <div class="modal-header">
        <h3 class="modal-title" id="hikeRoomTariffModalTitle">Hike Room Tariff</h3>
        <button type="button" class="btn-close" data-bs-dismiss="modal"></button>
      </div>

      <form class="needs-validation sl-cust-validation" id="hike_form" action="#">
        <div class="modal-body">

          <input type="hidden" name="hike_room_tariff_hike_id" id="hike_room_tariff_hike_id" value="">
          <input type="hidden" name="room_tariff_hike_id_fk" id="room_tariff_hike_id_fk" value="">
          <input type="hidden" name="hike_properties_id_fk" id="hike_properties_id_fk" value="">
          

          <!-- show property name read-only -->
          <div class="row">

            <div class="col-md-4">
              <label><b>Hike From date</b> *</label>
              <input type="text" class="form-control" name="hike_room_tariff_hike_from_date" id="hike_room_tariff_hike_from_date" required>
            </div>

            <div class="col-md-4">
              <label><b>Hike To date</b> *</label>
              <input type="text" class="form-control" name="hike_room_tariff_hike_to_date" id="hike_room_tariff_hike_to_date" required>
            </div>
          </div>

          <!-- rates header -->
          <div class="row mt-3">
            <div class="col-md-3">
              <label><b>Adult breakfast rate</b> *</label>
              <input type="number" class="form-control" name="hike_room_tariff_hike_breakfast_rate_adult" id="hike_room_tariff_hike_breakfast_rate_adult" required>
            </div>
            <div class="col-md-3">
              <label><b>Child breakfast rate</b> *</label>
              <input type="number" class="form-control" name="hike_room_tariff_hike_breakfast_rate_child" id="hike_room_tariff_hike_breakfast_rate_child" required>
            </div>
            <div class="col-md-3">
              <label><b>Adult lunch rate</b> *</label>
              <input type="number" class="form-control" name="hike_room_tariff_hike_lunch_rate_adult" id="hike_room_tariff_hike_lunch_rate_adult" required>
            </div>
            <div class="col-md-3">
              <label><b>Child lunch rate</b> *</label>
              <input type="number" class="form-control" name="hike_room_tariff_hike_lunch_rate_child" id="hike_room_tariff_hike_lunch_rate_child" required>
            </div>
          </div>

          <div class="row mt-3">
            <div class="col-md-3">
              <label><b>Adult dinner rate</b> *</label>
              <input type="number" class="form-control" name="hike_room_tariff_hike_dinner_rate_adult" id="hike_room_tariff_hike_dinner_rate_adult" required>
            </div>
            <div class="col-md-3">
              <label><b>Child dinner rate</b> *</label>
              <input type="number" class="form-control" name="hike_room_tariff_hike_dinner_rate_child" id="hike_room_tariff_hike_dinner_rate_child" required>
            </div>

            <div class="col-md-6">
              <label><b>Description</b></label>
              <textarea class="form-control" name="hike_room_tariff_hike_description" id="hike_room_tariff_hike_description" rows="3" ></textarea>
            </div>
          </div>

          <div id="hike_rooms_container" class="mt-3"></div>

        </div>

        <div class="modal-footer">
          <button type="button" class="btn btn-danger light" data-bs-dismiss="modal">Close</button>
          <button type="button" class="btn btn-primary" id="btnHikeSave" onclick="save_hike_tariff()">Save</button>
        </div>
      </form>

    </div>
  </div>
</div>

<!-- Modal -->
        <div class="modal fade" id="Property_inclusionModal" role="dialog" data-backdrop="static"  data-keyboard="false">
            <div class="modal-dialog" role="document">
                <div class="modal-content">
                    <div class="modal-header">
                        <h5 class="modal-title"></h5>
                        <button type="button" class="btn-close" onclick="Propertyinclusionmodalclose()" data-bs-dismiss="modal">
                        </button>
                    </div>
                    <div class="modal-body">
                        
                        <form class="needs-validation" action="#" id="form7" >
                            <input type="hidden" value="" name="id" id="id7"/> 
                            <input type="hidden" value="" name="properties_id_fk" id="properties_id_fk5"/>
                            <div class="row">
                                <div class="col-xl-9">
                                    <div class="mb-3 row form-group">
                                        <label class="col-lg-4 col-form-label" for="property_inclusions_name">Inclusion name
                                            <span class="text-danger">*</span>
                                        </label>
                                        <div class="col-lg-8 property_inclusions_name">
                                            <input type="text" class="form-control" name="property_inclusions_name" id="property_inclusions_name" placeholder="Enter Inclusion name" required>
                                            <span class="help-block" style="color:red"></span>
                                        </div>
                                    </div>
                                    <div class="mb-3 row form-group">
                                        <label class="col-lg-4 col-form-label" for="property_inclusions_amount">Amount
                                            <span class="text-danger">*</span>
                                        </label>
                                        <div class="col-lg-8 property_inclusions_amount">
                                            <input type="number" class="form-control" name="property_inclusions_amount" id="property_inclusions_amount" placeholder="Enter amount" required>
                                            <span class="help-block" style="color:red"></span>
                                        </div>
                                    </div>
                                    <div class="mb-3 row">
                                        <label class="col-lg-4 col-form-label" for="property_inclusions_description">Description 
                                        </label>
                                        <div class="col-lg-8">
                                            <textarea class="form-control" name="property_inclusions_description" id="property_inclusions_description"  rows="5" placeholder="Enter Description" required></textarea>
                                            <div class="invalid-feedback">
                                                Please enter a Description.
                                            </div>
                                        </div>
                                    </div>
                                </div>
                            </div>
                        </form>
                    </div>
                    <div class="modal-footer">
                        <button type="button" class="btn btn-danger light" onclick="Propertyinclusionmodalclose()" data-bs-dismiss="modal">Close</button>
                        <button type="button" class="btn btn-primary" id="btnSave8" onclick="save3()" >Save</button>
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

<!-- Modal -->
<div class="modal fade" id="deleterow2Modal" role="dialog" data-backdrop="static"  data-keyboard="false">
    <div class="modal-dialog" role="document">
        <div class="modal-content">
            <div class="modal-header">
                <h5 class="modal-title2"></h5>
                <button type="button" class="btn-close" data-bs-dismiss="modal">
                </button>
            </div>
            <div class="modal-body">
                
                <form class="needs-validation" action="#" id="form4" >
                    <input type="hidden" value="" name="id4" id="id4"/> 
                    <input type="hidden" value="" name="upload_tariff_document_from_date" id="upload_tariff_document_from_date1"/>
                    <input type="hidden" value="" name="upload_tariff_document_to_date" id="upload_tariff_document_to_date1"/>
                    
                </form>
            </div>
            <div class="modal-footer">
                <button type="button" class="btn btn-danger light" onclick="Tariffuploadedmodalclose()" data-bs-dismiss="modal">Close</button>
                <button type="button" class="btn btn-primary" id="btnSave4" onclick="delete_tariff_document_action()" >Delete</button>
            </div>
        </div>
    </div>
</div>

<!-- Modal -->
<div class="modal fade" id="deleterow3Modal" role="dialog" data-backdrop="static"  data-keyboard="false">
    <div class="modal-dialog" role="document">
        <div class="modal-content">
            <div class="modal-header">
                <h5 class="modal-title6"></h5>
                <button type="button" class="btn-close" data-bs-dismiss="modal">
                </button>
            </div>
            <div class="modal-body">
                
                <form class="needs-validation" action="#" id="form6" >
                    <input type="hidden"  name="id" id="id6"/> 
                    <input type="hidden"  name="properties_name" id="properties_name6"/>
                    
                </form>
            </div>
            <div class="modal-footer">
                <button type="button" class="btn btn-danger light" onclick="Propertymodalclose()" data-bs-dismiss="modal">Close</button>
                <button type="button" class="btn btn-primary" id="btnSave6" onclick="delete_room_tariff_action()" >Delete</button>
            </div>
        </div>
    </div>
</div>

<div class="modal fade" id="HikeRoomTariffViewModal" tabindex="-1" role="dialog" data-backdrop="static" data-keyboard="false">
  <div class="modal-dialog modal-xl" role="document">
    <div class="modal-content">

      <div class="modal-header">
        <h4 class="modal-title">Room Tariff Hike Details</h4>
        <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
      </div>

      <div class="modal-body">

        <div class="card mb-3">
          <div class="card-body">

            <div class="row g-3">
              <div class="col-md-4">
                <div class="text-muted">Property</div>
                <div class="fw-bold" id="hvw_property_name">-</div>
              </div>

              <div class="col-md-4">
                <div class="text-muted">Parent Room Tariff Period</div>
                <div class="fw-bold">
                  <span id="hvw_parent_from">-</span> to <span id="hvw_parent_to">-</span>
                </div>
              </div>

              <div class="col-md-4">
                <div class="text-muted">Created</div>
                <div class="fw-bold">
                  <span id="hvw_created_date">-</span> <span id="hvw_created_time">-</span>
                </div>
                <div class="small text-muted" id="hvw_created_by">-</div>
              </div>
            </div>

            <hr>

            <div class="row g-3">
              <div class="col-md-4">
                <div class="text-muted">Hike Period</div>
                <div class="fw-bold">
                  <span id="hvw_from_date">-</span> to <span id="hvw_to_date">-</span>
                </div>
              </div>

              <div class="col-md-2">
                <div class="text-muted">Breakfast (Adult)</div>
                <div class="fw-bold" id="hvw_bf_adult">-</div>
              </div>
              <div class="col-md-2">
                <div class="text-muted">Breakfast (Child)</div>
                <div class="fw-bold" id="hvw_bf_child">-</div>
              </div>

              <div class="col-md-2">
                <div class="text-muted">Lunch (Adult)</div>
                <div class="fw-bold" id="hvw_lunch_adult">-</div>
              </div>
              <div class="col-md-2">
                <div class="text-muted">Lunch (Child)</div>
                <div class="fw-bold" id="hvw_lunch_child">-</div>
              </div>

              <div class="col-md-2">
                <div class="text-muted">Dinner (Adult)</div>
                <div class="fw-bold" id="hvw_dinner_adult">-</div>
              </div>
              <div class="col-md-2">
                <div class="text-muted">Dinner (Child)</div>
                <div class="fw-bold" id="hvw_dinner_child">-</div>
              </div>

              <div class="col-md-8">
                <div class="text-muted">Description</div>
                <div class="fw-bold" id="hvw_desc">-</div>
              </div>
            </div>

          </div>
        </div>

        <div id="hvw_rooms_container"></div>

      </div>

      <div class="modal-footer">
        <button type="button" class="btn btn-danger light" data-bs-dismiss="modal">Close</button>
      </div>

    </div>
  </div>
</div>

<div class="modal fade" id="deleterow4Modal" role="dialog" data-backdrop="static"  data-keyboard="false">
    <div class="modal-dialog" role="document">
        <div class="modal-content">
            <div class="modal-header">
                <h5 class="modal-title7"></h5>
                <button type="button" class="btn-close" data-bs-dismiss="modal">
                </button>
            </div>
            <div class="modal-body">
                
                <form class="needs-validation" action="#" id="form8" >
                    <input type="hidden"  name="id" id="id8"/> 
                    <input type="hidden"  name="property_inclusions_name" id="property_inclusions_name1"/>
                    
                </form>
            </div>
            <div class="modal-footer">
                <button type="button" class="btn btn-danger light" onclick="Propertymodalclose()" data-bs-dismiss="modal">Close</button>
                <button type="button" class="btn btn-primary" id="btnSave7" onclick="delete_property_inclusion_action()" >Delete</button>
            </div>
        </div>
    </div>
</div>

<script>
function downloadViewFile(url, downloadName) {
    fetch(url, { method: 'HEAD' })
        .then(function(response) {
            if (response.ok) {
                var a = document.createElement('a');
                a.href = url;
                a.download = downloadName;
                document.body.appendChild(a);
                a.click();
                document.body.removeChild(a);
            } else {
                alert('No file exists');
            }
        })
        .catch(function() {
            alert('No file exists');
        });
}
</script>

<div class="modal fade" id="deleterow5Modal" role="dialog" data-backdrop="static"  data-keyboard="false">
    <div class="modal-dialog" role="document">
        <div class="modal-content">
            <div class="modal-header">
                <h5 class="modal-title8"></h5>
                <button type="button" class="btn-close" data-bs-dismiss="modal">
                </button>
            </div>
            <div class="modal-body">
                
                <form class="needs-validation" action="#" id="form9" >
                    <input type="hidden"  name="id" id="id9"/> 
                    <input type="hidden"  name="properties_name" id="properties_name7"/>
                    
                </form>
            </div>
            <div class="modal-footer">
                <button type="button" class="btn btn-danger light" onclick="Propertymodalclose()" data-bs-dismiss="modal">Close</button>
                <button type="button" class="btn btn-primary" id="btnSave9" onclick="delete_room_tariff_hike_action()" >Delete</button>
            </div>
        </div>
    </div>
</div>