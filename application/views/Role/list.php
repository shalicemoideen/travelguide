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
                                                            <select data-validation="required"  data-pms-required="true" class="form-control input-lg lst-flt-select2" id="state_id_filter" name="state_id_filter" required>  
                            
                                                                    
                                                            </select>
                                                        </div>
                                                    </div>
                                                </div>                                                
                                                <div class="col-sm-6 col-md-5 staff-do-not-show">
                                                    <div class="card">
                                                        <div class="input-group">
                                                            <select name="permission_status" id="permission_status_search" class="form-control input-lg lst-flt-select2" required>                                     
                                                                <option value="">Please Select Status</option>
                                                                <option value="1">Active</option>
                                                                <option value="0">Inactive</option>                                                        
                                                               
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
                                                        <a href="<?php echo base_url();?>index.php/Role">
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
                                <h4 class="card-title">Role Details</h4>
                                <a onclick="add_role()"  data-bs-target="#RoleModal" class="btn btn-rounded btn-secondary btn-md">+ New Role</a> 
                            </div>
                            <div class="card-body">
                                <div class="table-responsive">
                                    <table id="Role_table" class="display" style="min-width: 845px">
                                        <thead>
                                            <tr>
                                                <th>Sl.no</th>
                                                <th>Name</th>
                                                <th>Description</th>
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
        <div class="modal fade" id="RoleModal" role="dialog" data-backdrop="static"  data-keyboard="false">
            <div class="modal-dialog modal-lg" role="document">
                <div class="modal-content">
                    <div class="modal-header">
                        <h5 class="modal-title"></h5>
                        <button type="button" class="btn-close" onclick="RoleModalclose()" data-bs-dismiss="modal">
                        </button>
                    </div>
                    <div class="modal-body">
                        
                        <form class="needs-validation" action="#" id="form" >
                            <input type="hidden" value="" name="id" id="id"/> 
                            <div class="row">
                                <div class="col-xl-12">
                                    <div class="mb-3 row form-group">
                                        <label class="col-lg-4 col-form-label" for="role_name">Name
                                            <span class="text-danger">*</span>
                                        </label>
                                        <div class="col-lg-8 role_name">
                                            <input type="text" class="form-control" name="role_name" id="permission_name" placeholder="Enter Role" required>
                                            <span class="help-block" style="color:red"></span>
                                            <b><span id="role_name_alert" style="color: red"></span></b>
                                        </div>
                                    </div>
                                    <div class="mb-3 row">
                                        <label class="col-lg-4 col-form-label" for="role_description">Description 
                                        </label>
                                        <div class="col-lg-8">
                                            <textarea class="form-control" name="role_description" id="role_description"  rows="5" placeholder="Enter Description" required></textarea>
                                            <div class="invalid-feedback">
                                                Please enter a Description.
                                            </div>
                                        </div>
                                    </div>


                                    <div class="mb-3 row" id="permissions_group">
                                    <?php foreach ($permissions as $module => $submodules): ?>

                                    <div class="card mb-2">
                                        <div class="card-header">
                                            <strong><?= $module ?></strong>
                                        </div>

                                        <div class="card-body">

                                            <?php foreach ($submodules as $sub => $perms): ?>

                                                <div style="margin-bottom:10px;">
                                                    <strong><?= $sub ?></strong><br>

                                                    <?php foreach ($perms as $perm): ?>
                                                        <label style="margin-right:15px;">
                                                            <input type="checkbox" name="permissions_name[]" value="<?= $perm->id ?>">
                                                            <?= str_replace([$module.'_',$sub.'_'], '', $perm->name) ?>
                                                        </label>
                                                    <?php endforeach; ?>

                                                </div>

                                            <?php endforeach; ?>

                                        </div>
                                    </div>

                                    <?php endforeach; ?>
                                    <span class="help-block" style="color:red"></span>
                                    <b><span class="text-danger" style="color: red"></span></b>
                                </div>


                                    <!-- <div class="row" id="permissions_group">
                                        
                                        <?php foreach($permissions as $permission) { ?>
                                            <div class="col-md-6 mb-2">
                                                <div class="form-check" >
                                                    <input 
                                                        type="checkbox" 
                                                        id="perm_<?php echo $permission->id; ?>" 
                                                        class="form-check-input sc_chkbox"
                                                        name="permissions_name[]" 
                                                        value="<?php echo $permission->id; ?>"
                                                    >
                                                    
                                                    <b><label class="form-check-label" for="perm_<?php echo $permission->id; ?>">
                                                        <?php echo $permission->name; ?>
                                                    </label></b>
                                                </div>
                                            </div>
                                        <?php } ?>
                                        <span class="help-block" style="color:red"></span>
                                        <b><span class="text-danger" style="color: red"></span></b>
                                    </div> -->
                                </div>
                            </div>
                        </form>
                    </div>
                    <div class="modal-footer">
                        <button type="button" class="btn btn-danger light" onclick="RoleModalclose()" data-bs-dismiss="modal">Close</button>
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
                    <input type="hidden" value="" name="role_id_delete" id="role_id_delete"/> 
                    <div class="form-group">
                        <label>Role Name: <span name="role_name_delete" id="role_name_label" class="fw-bold"></span></label>
                    </div>
                    
                </form>
            </div>
            <div class="modal-footer">
                <button type="button" class="btn btn-danger light" onclick="RoleModalclose()" data-bs-dismiss="modal">Close</button>
                <button type="button" class="btn btn-primary" id="btnSave1" onclick="delete_permission_action()" >Delete</button>
            </div>
        </div>
    </div>
</div>