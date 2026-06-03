<style>
    .modal-lg {
    max-width: 80%;
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
                                                            <select data-validation="required"  data-pms-required="true" class="form-control input-lg lst-flt-select2" id="cancellation_policies_id" name="cancellation_policies_id" required>  
                            
                                                                    <option value="">Please Select cancellation policies</option>
                                                                    <?php

                                                                    foreach($cancellation as $row)
                                                                    {
                                                                        
                                                                        echo '<option value="'.$row->cancellation_policies_id.'" '.$sel.'>'.$row->cancellation_policies_name.'</option>';

                                                                    }

                                                                    ?>
                                                            </select>
                                                        </div>
                                                    </div>
                                                </div>  
                                                <div class="col-sm-6 col-md-5 staff-do-not-show">
                                                    <div class="card">
                                                        <div class="input-group">
                                                            <select name="cancellation_policies_createdby_user_id" id="cancellation_policies_createdby_user_id" class="form-control input-lg lst-flt-select2" required>                                     
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
                                                        <a href="<?php echo base_url();?>Cancellation_policies">
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
                                <h4 class="card-title">Cancellation and policies Details</h4>                                
                                <?php if (has_permission('CANCELLATION_AND_POLICY_CREATE')): ?>
                                        <a onclick="add_Cancellation_policies()"  data-bs-target="#Cancellation_policiesModal" class="btn btn-rounded btn-secondary btn-md">+ New Cancellation and policies</a> 
                                <?php endif; ?>
                            </div>
                            <div class="card-body">
                                <div class="table-responsive">
                                    <table id="Cancellation_policies_table" class="display" style="min-width: 845px">
                                        <thead>
                                            <tr>
                                                <th>Sl.no</th>
                                                <th>Name</th>
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
        <div class="modal fade" id="Cancellation_policiesModal" role="dialog" data-backdrop="static"  data-keyboard="false">
            <div class="modal-dialog modal-lg" role="document">
                <div class="modal-content">
                    <div class="modal-header">
                        <h5 class="modal-title"></h5>
                        <button type="button" class="btn-close" onclick="Cancellation_policiesmodalclose()" data-bs-dismiss="modal">
                        </button>
                    </div>
                    <div class="modal-body">
                        
                        <form class="needs-validation sl-cust-validation" action="#" id="form" >
                            <input type="hidden" value="" name="id" id="id"/> 
                            <input type="hidden" name="removed_cancellation_policies_id" id="removed_cancellation_policies_id"  value=""/>
                            <div class="row">
                                <div class="col-md-8">
                                    <div class=" form-group">
                                        <label class="col-lg-3 col-form-label" for="cancellation_policies_name">Name <span class="text-danger">*</span>
                                        </label>
                                        
                                            <input type="text" class="form-control" name="cancellation_policies_name" id="cancellation_policies_name" placeholder="Enter cancellation and policies title" required>
                                            <span class="help-block" style="color:red"></span>
                                            <input type="hidden" id="counter_edit1" >
                                        
                                    </div>
                                </div>
                            </div>
                                    <div class="col-md-21" >

                    <div class="card">      

                            <div class="box-body no-padding">

                                

                                <div id="product" class="box-body no-padding">
                                    
                                   
                                    <div class="row">
                                                            <div class="col-xl-12 col-lg-12">
                                        <div class="card">
                                            <!-- <div class="card-header">
                                                <h4 class="card-title"></h4>
                                            </div> -->
                                            <div class="card-body">
                                                <div class="basic-form">
                                                    
                                                
                                      
                                                       <div class="row" id="product1">
                                                            <!-- <div class="mb-3 col-md-8">
                                                                 <input type="hidden" name="terms_condition_id_fk[1]" id="terms_condition_id_fk_1"/>
                                                                 <textarea class="form-control" name="terms_condition_items_name[1]" id="terms_condition_items_name_1"  rows="5" placeholder="Enter Terms and condition" required></textarea>
                                                            <span class="help-block" style="color:red"></span>
                                                            </div>
                                                            <div class="mb-3 col-md-3">
                                                                <button class="btn btn-primary add" type="button" id="submit" onClick="addMore();" >+ Add new</button>
                                                            </div> -->
                                                            
                                                            
                                                        </div> 
                                                    
                                                </div>
                                            </div>
                                        </div>
                                    </div></div>
                                </div>

                                <div class="col-sm-2"></div>

                                <button class="btn btn-primary add" type="button" id="submit" style="margin-left:10%;" onClick="addMore();">New Items</button>

                                
                              </div>
                            </div>

                                </div>


                            
                        </form>
                    </div>
                    <div class="modal-footer">
                        <button type="button" class="btn btn-danger light" onclick="Cancellation_policiesmodalclose()" data-bs-dismiss="modal">Close</button>
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
                    <input type="hidden" value="" name="cancellation_policies_name" id="cancellation_policies_name1"/>
                    
                </form>
            </div>
            <div class="modal-footer">
                <button type="button" class="btn btn-danger light" onclick="Cancellation_policiesmodalclose()" data-bs-dismiss="modal">Close</button>
                <button type="button" class="btn btn-primary" id="btnSave1" onclick="delete_cancellation_policies_action()" >Delete</button>
            </div>
        </div>
    </div>
</div>