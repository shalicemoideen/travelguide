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
