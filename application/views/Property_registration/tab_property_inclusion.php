                                                                                            <div class="col-sm-2"><button type="button" id="btn6" class="btn btn-rounded btn-primary btn-md"><i class="fas fa-filter"></i> Filter</button></div><br><br><br>
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
                                                                                
                                                                                <div class="col-sm-6 col-md-5 staff-do-not-show">
                                                                                    <div class="card">
                                                                                        <div class="input-group">
                                                                                            <select name="property_inclusions_id_filter" id="property_inclusions_id_filter" class="form-control input-lg multi-select" required>                                     
                                                                                                <option value="">Please Select inclusion</option>                            
                                                                                                <?php foreach($inclusions as $row) {
                                                                                                        // $sel = ($records->state==$row->state_id)?'selected':'';
                                                                                                        echo '<option value="'.$row->property_inclusions_id.'">'.$row->property_inclusions_name.'</option>';
                                                                                                    } ?>
                                                                                            </select>
                                                                                        </div>
                                                                                    </div>
                                                                                </div>
                                                                                                                          
                                                                                <div class="col-sm-6 col-md-5 staff-do-not-show">
                                                                                    <div class="card">
                                                                                        <div class="input-group">
                                                                                            <select name="property_inclusions_created_by_userid" id="property_inclusions_created_by_userid" class="form-control input-lg multi-select" required>                                     
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
                                                                                        <button type="button" class="btn btn-warning btn-md" id="search4">
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
                                                                <h2 class="card-title"><b>Property inclusion Details</b></h2>
                                                                <button onclick="add_property_inclusion()"  data-bs-target="#Property_inclusionModal" class="btn btn-rounded btn-secondary btn-md"><b>+ Add new property inclusion</b></button> 
                                                            </div>
                                                            <div class="card-body">
                                                                <div class="table-responsive">
                                                                    <table class="table card-table display mb-4 shadow-hover table-responsive-lg" id="Property_inclusion_table">
                                                                        <thead>
                                                                            <tr>
                                                                                <th>Sl.no</th>
                                                                                <th>Inclusion name</th>
                                                                                <th>Amount</th>
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
