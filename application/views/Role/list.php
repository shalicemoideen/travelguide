<style>
.rolemodal{
  max-width: 95%;
}
</style>
<!--**********************************
            Content body start
        ***********************************-->
        <div class="content-body">
            <div class="container-fluid">
				

                <div class="row">
                    
                    
					<div class="col-12">
                        <div class="card">
                            <div class="card-header">
                                <h4 class="card-title">Role Details</h4>
                                <?php if (has_permission('ROLE_CREATE')): ?>
                                <a onclick="add_role()"  data-bs-target="#RoleModal" class="btn btn-rounded btn-secondary btn-md">+ New Role</a> 
                                <?php endif; ?> 
                                
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
            <div class="modal-dialog modal-lg rolemodal" role="document">
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

                                    <div class="mb-3 row">
    <div class="col-lg-12">
        <label>
            <input type="checkbox" id="select_all_permissions">
            <strong>Select All Permissions</strong>
        </label>
    </div>
</div>
                                <!-- <div class="mb-3 row" id="permissions_group">
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
                                                             <?= $perm->display_name ?>
                                                        </label>
                                                    <?php endforeach; ?>

                                                </div>

                                            <?php endforeach; ?>

                                        </div>
                                    </div>

                                    <?php endforeach; ?>
                                    <span class="help-block" style="color:red"></span>
                                    <b><span class="text-danger" style="color: red"></span></b>
                                </div> -->

                                <div class="mb-3" id="permissions_group">
    <div class="row">
        <?php foreach ($permissions as $module => $submodules): ?>

            <div class="col-lg-6 col-md-6 col-sm-12 mb-3">
                <div class="card h-100">
                    <div class="card-header">
                        <strong><?= $module ?></strong>
                    </div>

                    <div class="card-body">
                        <?php foreach ($submodules as $sub => $perms): ?>

                            <div class="mb-2">
                                <strong><?= $sub ?></strong><br>

                                <?php foreach ($perms as $perm): ?>
                                    <label class="me-3 mb-1">
                                        <input type="checkbox" class="permission-checkbox" name="permissions_name[]" value="<?= $perm->id ?>">
                                        <?= $perm->display_name ?>
                                    </label>
                                <?php endforeach; ?>
                            </div>

                        <?php endforeach; ?>
                    </div>
                </div>
            </div>

        <?php endforeach; ?>
    </div>

    <span class="help-block" style="color:red"></span>
    <b><span class="text-danger"></span></b>
</div>
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
                    <input type="hidden" value="" name="role_name_delete_hidden" /> 
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