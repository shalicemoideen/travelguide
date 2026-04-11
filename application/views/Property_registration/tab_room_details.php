                                      
                                         <!-- <div class="tab-pane fade show row page" style="display:none" data-page="Room_details" id="Room_details"> -->
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
                                                                                            <input type="hidden" id="properties_id" name="properties_id" value="<?php echo $records->properties_id; ?>">
                                                                                            <div class="form-control bg-light"><?php echo $records->properties_name; ?></div>
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
                                                                <h2 class="card-title"><b>Room Details</b></h2>
                                                                <button onclick="add_room()"  data-bs-target="#RoomModal" class="btn btn-rounded btn-secondary btn-md"><b>+ New room</b></button> 
                                                            </div>
                                                            <div class="card-body">
                                                                <div class="table-responsive">
                                                                    <table class="table card-table display mb-4 shadow-hover table-responsive-lg" id="Room_registration">
                                                                        <thead>
                                                                            <tr>
                                                                                <th>Sl.no</th>
                                                                                <th>Photo</th>
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