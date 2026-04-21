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
                                        <a href="<?php echo base_url();?>Room_tariff_management">
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
                                <h2 class="card-title"><b>Room tariff Details</b></h2>
                                <a onclick="add_room_tariff()"  data-bs-target="#RoomTariffModal" class="btn btn-rounded btn-secondary btn-md"><b>+ New room tariff</b></a> 
                            </div>
                            <div class="card-body">
                                <div class="table-responsive">
                                    <table class="table card-table display mb-4 shadow-hover table-responsive-lg" id="Room_tariff_registration">
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
        </div>
        <!--**********************************
            Content body end
        ***********************************-->

        <!-- Modal -->
        <div class="modal fade" id="RoomTariffModal" role="dialog" data-backdrop="static"  data-keyboard="false">
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