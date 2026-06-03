<style>
    .modal-lg {
    max-width: 90%;
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
                <!-- row --><input type="hidden" id="counter_edit2" value="">
                <form id="exampleValidation" method="POST" action="" enctype="multipart/form-data">
                                    <div class="card-header" id="Create" style="display:none">
                                        <div class="d-flex align-items-center">
                                            <div class="row row-demo-grid hdr-filter-dd-fullwd">
                                                <div class="col-sm-6 col-md-5">
                                                    <div class="card">
                                                        <div class="input-group">
                                                            <select data-validation="required"  data-pms-required="true" class="form-control input-lg lst-flt-select2" id="inclusion_exclusion_common_id" name="inclusion_exclusion_common_id" required>  
                            
                                                                    <option value="">Please Select transporter</option>
                                                                    <?php

                                                                    foreach($transporter as $row)
                                                                    {
                                                                        
                                                                        echo '<option value="'.$row->inclusion_exclusion_common_id.'" '.$sel.'>'.$row->inclusion_exclusion_common_title.'</option>';

                                                                    }

                                                                    ?>
                                                            </select>
                                                        </div>
                                                    </div>
                                                </div>  
                                                <div class="col-sm-6 col-md-5 staff-do-not-show">
                                                    <div class="card">
                                                        <div class="input-group">
                                                            <select name="inclusion_exclusion_common_createdby_user_id" id="inclusion_exclusion_common_createdby_user_id" class="form-control input-lg lst-flt-select2" required>                                     
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
                                                        <a href="<?php echo base_url();?>Inclusions_exclusions">
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
                                <h4 class="card-title">Inclusions and exclusions Details</h4>
                                <?php if (has_permission('INCLUSION_AND_EXCLUSION_CREATE')): ?>
                                        <a onclick="add_inclusions_exclusions()"  data-bs-target="#Inclusions_exclusionsModal" class="btn btn-rounded btn-secondary btn-md">+ New Inclusions & exclusions</a> 
                                <?php endif; ?>                                
                            </div>
                            <div class="card-body">
                                <div class="table-responsive">
                                    <table id="Inclusions_exclusions_table" class="display" style="min-width: 845px">
                                        <thead>
                                            <tr>
                                                <th>Sl.no</th>
                                                <th>Title</th>
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
        <div class="modal fade" id="Inclusions_exclusionsModal" role="dialog" data-backdrop="static"  data-keyboard="false">
            <div class="modal-dialog modal-lg" role="document">
                <div class="modal-content">
                    <div class="modal-header">
                        <h5 class="modal-title"></h5>
                        <button type="button" class="btn-close" onclick="Inclusions_exclusionsmodalclose()" data-bs-dismiss="modal">
                        </button>
                    </div>
                    <div class="modal-body">
                        
                        <form class="needs-validation" action="#" id="form" >
                            <input type="hidden" value="" name="id" id="id"/> 
                            <input type="hidden" name="removed_inclusions_ids" id="removed_inclusions_ids"  value=""/>
                            <input type="hidden" name="removed_exclusions_ids" id="removed_exclusions_ids"  value=""/>
                            <div class="row">
                                <div class="col-md-8">
                                    <div class=" form-group">
                                        <label class="col-lg-3 col-form-label" for="inclusion_exclusion_common_title">Title <span class="text-danger">*</span>
                                        </label>
                                        
                                            <input type="text" class="form-control" name="inclusion_exclusion_common_title" id="inclusion_exclusion_common_title" placeholder="Enter title" required>
                                            <span class="help-block" style="color:red"></span>
                                            <input type="hidden" id="counter_edit1" >
                                        
                                    </div>

                                    </div>
                            </div>
                            <div class="box-body no-padding">

                                

                                <div id="product" class="box-body no-padding">
                                    
                                   <div class="row">

                                    <div class="col-xl-6 col-lg-6">
                                        <div class="card">
                                            <div class="card-header">
                                                <h4 class="card-title">Inclusions</h4>
                                            </div>
                                            <div class="card-body">
                                                <div class="basic-form">
                                                    
                                                        <div class="row" id="product1">
                                                            <div class="mb-3 col-md-6">
                                                                <!-- <label class="form-label">D</label> -->
                                                                <input type="hidden" name="inclusion_exclusion_common_id_fk1[1]" id="inclusion_exclusion_common_id_fk1_1" />
                                                                <textarea class="form-control" name="inclusions_details[1]" id="inclusions_details_1"  rows="5" placeholder="Enter Inclusions" required></textarea>
                                                            <span class="help-block" style="color:red"></span>
                                                            </div>
                                                            <div class="mb-3 col-md-6">
                                                                <button class="btn btn-primary add" type="button" id="submit"  onclick="addMore1()">+ Add new</button>
                                                            </div>
                                                            
                                                        </div>
                                                        
                                                    
                                                </div>
                                            </div>
                                        </div>
                                    </div>
                                    <div class="col-xl-6 col-lg-6">
                                        <div class="card">
                                            <div class="card-header">
                                                <h4 class="card-title">exclusions</h4>
                                            </div>
                                            <div class="card-body">
                                                <div class="basic-form">
                                                    
                                                        <div class="row" id="product2">
                                                            <div class="mb-3 col-md-6">
                                                                <!-- <label class="form-label">D</label> -->
                                                                <input type="hidden" name="inclusion_exclusion_common_id_fk2[1]" id="inclusion_exclusion_common_id_fk2_1" />
                                                                <textarea class="form-control" name="exclusions_details[1]" id="exclusions_details_1"  rows="5" placeholder="Enter exclusions" required></textarea>
                                                            <span class="help-block" style="color:red"></span>
                                                            </div>
                                                            <div class="mb-3 col-md-6">
                                                                <button class="btn btn-primary add" type="button" id="submit"  onclick="addMore2()">+ Add new</button>
                                                            </div>
                                                            
                                                        </div>
                                                    
                                                </div>
                                            </div>
                                        </div>
                                    </div>
                            </div>
                                    
                                </div>

                                <div class="col-sm-2"></div>

                                
                              </div>
                        



                            
                        </form>
                    </div>
                    <div class="modal-footer">
                        <button type="button" class="btn btn-danger light" onclick="Inclusions_exclusionsmodalclose()" data-bs-dismiss="modal">Close</button>
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
                    <input type="hidden" value="" name="inclusion_exclusion_common_title" id="inclusion_exclusion_common_title1"/>
                    
                </form>
            </div>
            <div class="modal-footer">
                <button type="button" class="btn btn-danger light" onclick="Inclusions_exclusionsmodalclose()" data-bs-dismiss="modal">Close</button>
                <button type="button" class="btn btn-primary" id="btnSave1" onclick="delete_inclusions_exclusions_action()" >Delete</button>
            </div>
        </div>
    </div>
</div>