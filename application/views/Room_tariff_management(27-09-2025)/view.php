 <style>
    .modal-lg {
    max-width: 80%;

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
                                <input type="hidden"  class="form-control" id="room_tariff_hike_id_fk_hidden" value="<?php if(isset($records->room_tariff_hike_id)) echo $records->room_tariff_hike_id ?>">
                            </div>
                            <div class="card-body">
                                <!-- Nav tabs -->
                                <div class="custom-tab-1  panel-body">
                                    <ul class="nav nav-tabs">
                                        <li class="nav-item prof_cls" id="Property">
                                            <a href="#" class="nav-link active" data-page="Tariff_details" id="Tariff_details" onclick="return Tariff_details('<?php echo $records->room_tariff_hike_id ?>')"><i class="la la-home me-2"></i> Home</a>
                                        </li>
                                        <li class="nav-item prof_cls" id="Rooms">
                                            <a href="#" class="nav-link" data-page="Hike_tariff_details" id="Hike_tariff_details" onclick="return Hike_tariff_details('<?php echo $records->room_tariff_hike_id ?>')"><i class="la la-user me-2"></i> Hike tariff</a>
                                        </li>

                                    </ul>
                                    <div class="tab-content">
                                        <div id="pages">
                                            <div class="tab-pane fade show row page" data-page="Tariff_details" id="Tariff_details">
                                                <div  class="col-lg-12">
                                                    <div class="card">
                                                        <div class="card-header">
                                                            <h4 class="card-title">Room tariff details</h4>
                                                        </div>
                                                        <div class="card-body">
                                                            <div class="form-validation">
                                                                <form class="needs-validation" novalidate >
                                                                    <div class="row">
                                                                        <div class="col-xl-6">
                                                                            <div class="mb-3 row">
                                                                                <input type="hidden"  class="form-control" id="Id" value="<?php if(isset($records->room_tariff_hike_id)) echo $records->room_tariff_hike_id ?>">
                                                                                <label class="col-lg-4 col-form-label" for="validationCustom01">Property
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
                                                                                <label class="col-lg-4 col-form-label" for="validationCustom03">From date      
                                                                                </label>
                                                                                <div class="col-lg-6">
                                                                                    <?php if(isset($records->room_tariff_hike_from_date)) echo $records->room_tariff_hike_from_date ?>
                                                                                </div>
                                                                            </div>
                                                                            <div class="mb-3 row">
                                                                                <label class="col-lg-4 col-form-label" for="validationCustom04">To date 
                                                                                </label>
                                                                                <div class="col-lg-6">
                                                                                    <?php if(isset($records->room_tariff_hike_to_date)) echo $records->room_tariff_hike_to_date ?>
                                                                                </div>
                                                                            </div>
                                                                            <div class="mb-3 row">
                                                                                <label class="col-lg-4 col-form-label" for="validationCustom05">Breakfast adult rate
                                                                                </label>
                                                                                <div class="col-lg-6">
                                                                                    <?php if(isset($records->room_tariff_hike_breakfast_rate_adult)) echo $records->room_tariff_hike_breakfast_rate_adult ?>
                                                                                </div>
                                                                            </div>
                                                                            <div class="mb-3 row">
                                                                                <label class="col-lg-4 col-form-label" for="validationCustom06">Breakfast child rate
                                                                                </label>
                                                                                <div class="col-lg-6">
                                                                                    <?php if(isset($records->room_tariff_hike_breakfast_rate_child)) echo $records->room_tariff_hike_breakfast_rate_child ?>
                                                                                </div>
                                                                            </div>
                                                                            <div class="mb-3 row">
                                                                                <label class="col-lg-4 col-form-label" for="validationCustom07">Lunch adult rate                
                                                                                </label>
                                                                                <div class="col-lg-6">
                                                                                    <?php if(isset($records->room_tariff_hike_lunch_rate_adult)) echo $records->room_tariff_hike_lunch_rate_adult ?>
                                                                                </div>
                                                                            </div>
                                                                            <div class="mb-3 row">
                                                                                <label class="col-lg-4 col-form-label" for="validationCustom08">Lunch child rate
                                                                                </label>
                                                                                <div class="col-lg-6">
                                                                                    <?php if(isset($records->room_tariff_hike_lunch_rate_child)) echo $records->room_tariff_hike_lunch_rate_child?>
                                                                                </div>
                                                                            </div>
                                                                            <div class="mb-3 row">
                                                                                <label class="col-lg-4 col-form-label" for="validationCustom09">Dinner adult rate 
                                                                                </label>
                                                                                <div class="col-lg-6">
                                                                                     <?php if(isset($records->room_tariff_hike_dinner_rate_adult)) echo $records->room_tariff_hike_dinner_rate_adult ?>
                                                                                </div>
                                                                            </div>
                                                                            <div class="mb-3 row">
                                                                                <label class="col-lg-4 col-form-label" for="validationCustom10">Dinner child rate <span
                                                                                        class="text-danger">*</span>
                                                                                </label>
                                                                                <div class="col-lg-6">
                                                                                     <?php if(isset($records->room_tariff_hike_dinner_rate_child)) echo $records->room_tariff_hike_dinner_rate_child ?>
                                                                                </div>
                                                                            </div>
                                                                            <div class="mb-3 row">
                                                                                <label class="col-lg-4 col-form-label" for="validationCustom11">Description              
                                                                                </label>
                                                                                <div class="col-lg-6">
                                                                                    <?php if(isset($records->room_tariff_hike_description)) echo $records->room_tariff_hike_description ?>
                                                                                </div>
                                                                            </div>
                                                                            <div class="mb-3 row">
                                                                                <label class="col-lg-4 col-form-label" for="validationCustom11">Created by username             
                                                                                </label>
                                                                                <div class="col-lg-6">
                                                                                    <?php if(isset($records->room_tariff_hike_createdby_user_name)) echo $records->room_tariff_hike_createdby_user_name ?>
                                                                                </div>
                                                                            </div>                             
                                                                        </div>
                                                                        <div class="col-xl-6">                
                                                                            <div class="mb-3 row">
                                                                                <label class="col-lg-4 col-form-label" for="validationCustom11">Username          
                                                                                </label>
                                                                                <div class="col-lg-6">
                                                                                    <?php if(isset($records->room_tariff_hike_createdby_user_name)) echo $records->room_tariff_hike_createdby_user_name ?>
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

                                         <br><div class="tab-pane fade show row page" style="display:none" data-page="Hike_tariff_details" id="Hike_tariff_details">
                                                <div class="col-sm-2"><button type="button" id="btn1" class="btn btn-rounded btn-primary btn-md"><i class="fas fa-filter"></i> Filter</button></div><br><br><br>
                                                <!-- <div class="row page-titles">
                                                    <ol class="breadcrumb">
                                                        <li class="breadcrumb-item active"><a href="javascript:void(0)">Table</a></li>
                                                        <li class="breadcrumb-item"><a href="javascript:void(0)">Datatable</a></li>
                                                    </ol>
                                                </div> -->
                                                <!-- row -->
                                                <form id="exampleValidation1" method="POST" action="" enctype="multipart/form-data">
                                                                    <div class="card-header" id="Create1" style="display:none">
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
                                                                                <div class="col-sm-6 col-md-5">
                                                                                    <div class="card">
                                                                                        <div class="input-group">
                                                                                            <select data-validation="required"  data-pms-required="true" class="form-control input-lg multi-select" id="property_category_id_fk" name="property_category_id_fk" required>  
                                                            
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
                                                                                            <input type="text" class="form-control" placeholder="Tariff start date" id="start_date" name="start_date" required>
                                                                                        </div>
                                                                                    </div>
                                                                                </div>
                                                                                <div class="col-sm-6 col-md-5">
                                                                                    <div class="card">
                                                                                        <div class="input-group">
                                                                                            <input type="text" class="form-control" placeholder="Tariff end date" id="end_date" name="end_date" required>
                                                                                        </div>
                                                                                    </div>
                                                                                </div>                              
                                                                                <div class="col-sm-6 col-md-5 staff-do-not-show">
                                                                                    <div class="card">
                                                                                        <div class="input-group">
                                                                                            <select name="room_tariff_hike_createdby_user_id" id="room_tariff_hike_createdby_user_id" class="form-control input-lg multi-select" required>                                     
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
                                                                                        <button type="button" class="btn btn-warning btn-md" id="search1">
                                                                                            <span class="btn-label">
                                                                                                <i class="fas fa-search"></i>
                                                                                            </span>
                                                                                            Search
                                                                                        </button>
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
                                                                <h2 class="card-title"><b>Hike Room tariff Details</b></h2>
                                                                <button onclick="add_hike_room_tariff()"  data-bs-target="#HikeroomtariffModal" class="btn btn-rounded btn-secondary btn-md"><b>+ New hike room tariff</b></button> 
                                                            </div>
                                                            <div class="card-body">
                                                                <div class="table-responsive">
                                                                    <table class="table card-table display mb-4 shadow-hover table-responsive-lg" id="Hike_room_tariff_registration">
                                                                        <thead>
                                                                            <tr>
                                                                                <th>Sl.no</th>
                                                                                <th>Property Name</th>
                                                                                <th>From date</th>
                                                                                <th>To date</th>
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

                                            <br><div class="tab-pane fade show row page" style="display:none" data-page="Upload_tariff_details" id="Upload_tariff_details">
                                                <div class="col-sm-2"><button type="button" id="btn2" class="btn btn-rounded btn-primary btn-md"><i class="fas fa-filter"></i> Filter</button></div><br><br><br>
                                                <!-- <div class="row page-titles">
                                                    <ol class="breadcrumb">
                                                        <li class="breadcrumb-item active"><a href="javascript:void(0)">Table</a></li>
                                                        <li class="breadcrumb-item"><a href="javascript:void(0)">Datatable</a></li>
                                                    </ol>
                                                </div> -->
                                                <!-- row -->
                                                <form id="exampleValidation2" method="POST" action="" enctype="multipart/form-data">
                                                                    <div class="card-header" id="Create2" style="display:none">
                                                                        <div class="d-flex align-items-center">
                                                                            <div class="row row-demo-grid hdr-filter-dd-fullwd">
                                                                                <div class="col-sm-6 col-md-5">
                                                                                    <div class="card">
                                                                                        <div class="input-group">
                                                                                            <input type="text" class="form-control" name="start_date" id="start_date" placeholder="Enter from date" required>
                                                                                        </div>
                                                                                    </div>
                                                                                </div>  
                                                                                
                                                                                <div class="col-sm-6 col-md-5">
                                                                                    <div class="card">
                                                                                        <div class="input-group">
                                                                                            <input type="text" class="form-control" name="end_date" id="end_date" placeholder="Enter end date" required>
                                                                                        </div>
                                                                                    </div>
                                                                                </div>
                                                                                                                          
                                                                                <div class="col-sm-6 col-md-5 staff-do-not-show">
                                                                                    <div class="card">
                                                                                        <div class="input-group">
                                                                                            <select name="upload_tariff_document_created_by_user_id" id="upload_tariff_document_created_by_user_id" class="form-control input-lg multi-select" required>                                     
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
                                                                                        <button type="button" class="btn btn-warning btn-md" id="search2">
                                                                                            <span class="btn-label">
                                                                                                <i class="fas fa-search"></i>
                                                                                            </span>
                                                                                            Search
                                                                                        </button>
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
                                                                <h2 class="card-title"><b>Tariff uploaded Details</b></h2>
                                                                <button onclick="add_tariff_uploaded()"  data-bs-target="#Tariff_uploadedModal" class="btn btn-rounded btn-secondary btn-md"><b>+ Upload new room tariff</b></button> 
                                                            </div>
                                                            <div class="card-body">
                                                                <div class="table-responsive">
                                                                    <table class="table card-table display mb-4 shadow-hover table-responsive-lg" id="Tariff_uploaded_registration">
                                                                        <thead>
                                                                            <tr>
                                                                                <th>Sl.no</th>
                                                                                <th>From date</th>
                                                                                <th>To date</th>
                                                                                <th>Document</th>
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
                                        </div> <!-- end page -->
                                        <!--    <div class="tab-pane fade" id="contact1">
                                            <div class="pt-4">
                                                <h4>This is contact title</h4>
                                                <p>Far far away, behind the word mountains, far from the countries Vokalia and Consonantia, there live the blind texts. Separated they live in Bookmarksgrove.
                                                </p>
                                                <p>Far far away, behind the word mountains, far from the countries Vokalia and Consonantia, there live the blind texts. Separated they live in Bookmarksgrove.
                                                </p>
                                            </div>
                                        </div>
                                        <div class="tab-pane fade" id="message1">
                                            <div class="pt-4">
                                                <h4>This is message title</h4>
                                                <p>Raw denim you probably haven't heard of them jean shorts Austin. Nesciunt tofu stumptown aliqua, retro synth master cleanse. Mustache cliche tempor.
                                                </p>
                                                <p>Raw denim you probably haven't heard of them jean shorts Austin. Nesciunt tofu stumptown aliqua, retro synth master cleanse. Mustache cliche tempor.
                                                </p>
                                            </div>
                                        </div> -->
                                    </div>
                                </div>
                            </div>
                        </div>
                    </div>
                    
                    

                    <!-- <div class="col-xl-12">
                        <div class="card">
                            <div class="card-header">
                                <h4 class="card-title">Vertical Nav Pill</h4>
                            </div>
                            <div class="card-body">
                                <div class="row">
                                    <div class="col-sm-2">
                                        <div class="nav flex-column nav-pills mb-3">
                                            <a href="#v-pills-home" data-bs-toggle="pill" class="nav-link active show">Home</a>
                                            <a href="#v-pills-profile" data-bs-toggle="pill" class="nav-link">Profile</a>
                                            <a href="#v-pills-messages" data-bs-toggle="pill" class="nav-link">Messages</a>
                                            <a href="#v-pills-settings" data-bs-toggle="pill" class="nav-link">Settings</a>
                                        </div>
                                    </div>
                                    <div class="col-sm-8">
                                        <div class="tab-content">
                                            <div id="v-pills-home" class="tab-pane fade active show">
                                                <p>Cillum ad ut irure tempor velit nostrud occaecat ullamco aliqua anim Lorem sint. Veniam sint duis incididunt do esse magna mollit excepteur laborum qui. Id id reprehenderit sit est eu aliqua occaecat quis
                                                    et velit excepteur laborum mollit dolore eiusmod. Ipsum dolor in occaecat commodo et voluptate minim reprehenderit mollit pariatur. Deserunt non laborum enim et cillum eu deserunt excepteur ea incididunt
                                                    minim occaecat.
                                                </p>
                                            </div>
                                            <div id="v-pills-profile" class="tab-pane fade">
                                                <p>Culpa dolor voluptate do laboris laboris irure reprehenderit id incididunt duis pariatur mollit aute magna pariatur consectetur. Eu veniam duis non ut dolor deserunt commodo et minim in quis laboris ipsum
                                                    velit id veniam. Quis ut consectetur adipisicing officia excepteur non sit. Ut et elit aliquip labore Lorem enim eu. Ullamco mollit occaecat dolore ipsum id officia mollit qui esse anim eiusmod do sint
                                                    minim consectetur qui.
                                                </p>
                                            </div>
                                            <div id="v-pills-messages" class="tab-pane fade">
                                                <p>Fugiat id quis dolor culpa eiusmod anim velit excepteur proident dolor aute qui magna. Ad proident laboris ullamco esse anim Lorem Lorem veniam quis Lorem irure occaecat velit nostrud magna nulla. Velit
                                                    et et proident Lorem do ea tempor officia dolor. Reprehenderit Lorem aliquip labore est magna commodo est ea veniam consectetur.</p>
                                            </div>
                                            <div id="v-pills-settings" class="tab-pane fade">
                                                <p>Eu dolore ea ullamco dolore Lorem id cupidatat excepteur reprehenderit consectetur elit id dolor proident in cupidatat officia. Voluptate excepteur commodo labore nisi cillum duis aliqua do. Aliqua amet
                                                    qui mollit consectetur nulla mollit velit aliqua veniam nisi id do Lorem deserunt amet. Culpa ullamco sit adipisicing labore officia magna elit nisi in aute tempor commodo eiusmod.</p>
                                            </div>
                                        </div>
                                    </div>
                                </div>
                            </div>
                        </div>
                    </div> -->
                    

                </div>
              

            </div>
        </div>
        <!--**********************************
            Content body end
        ***********************************-->

       <!-- Modal -->
        <div class="modal fade" id="Tariff_uploadedModal" role="dialog" data-backdrop="static"  data-keyboard="false">
            <div class="modal-dialog modal-lg" role="document">
                <div class="modal-content">
                    <div class="modal-header">
                        <h3 class="modal-title"></h5>
                        <button type="button" class="btn-close" onclick="RoomTariffmodalclose()" data-bs-dismiss="modal">
                        </button>
                    </div>
                    <form class="needs-validation sl-cust-validation" action="#" id="form" >
                        <div class="modal-body">
                        
                            <input type="hidden" value="" name="id" id="id"/> 
                            <div class="row">
                                <div class="col-md-4">
                                    <div class=" form-group">
                                        <label class="col-lg-3 col-form-label" for="properties_id_fk"><b>Property</b> <span class="text-danger">*</span>
                                        </label>
                                        
                                            <select name="properties_id_fk" id="properties_id_fk" class="form-control multi-select" required>                                     
                                                <option value="">Please Select property</option>                            
                                                                    <?php foreach($property as $row)
                                                                    {
                                                                        
                                                                        echo '<option value="'.$row->properties_id.'" '.$sel.'>'.$row->properties_name.'</option>';

                                                                    } ?>
                                            </select>
                                            <span class="help-block" style="color:red"></span>
                                        
                                    </div>
                                </div>
                                <div class="col-md-4">
                                    <div class="form-group">
                                        <label class="col-lg-7 col-form-label" for="room_tariff_hike_from_date"><b>Hike From date</b> <span class="text-danger">*</span>
                                        </label>
                                            <input type="text" class="form-control" name="room_tariff_hike_from_date" id="room_tariff_hike_from_date" placeholder="Enter Hike From date" required>
                                            <span class="help-block" style="color:red"></span>
                                    </div>
                                </div>

                                <div class="col-md-4">
                                    <div class="form-group">
                                        <label class="col-lg-7 col-form-label" for="room_tariff_hike_to_date"><b>Hike to date</b> <span class="text-danger">*</span>
                                        </label>
                                            <input type="text" class="form-control" name="room_tariff_hike_to_date" id="room_tariff_hike_to_date" placeholder="Enter Hike to date" required>
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
                                            <textarea class="form-control" name="room_tariff_hike_description" id="room_tariff_hike_description"  rows="5" placeholder="Enter Description" required></textarea>
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
                            <button type="submit" class="btn btn-primary" id="btnSave" onclick="save()">Save</button>
                        </div>
                    </form>
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