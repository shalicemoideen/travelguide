<!-- Content Wrapper. Contains page content -->
  <div class="content-wrapper">
    <!-- Content Header (Page header) -->
    <section class="content-header">
      <h1>
        Generator Capacity Form
        <!-- <small>Optional description</small> -->
      </h1>
      <ol class="breadcrumb">
        <li><a href="<?php echo base_url();?>index.php/dashboard/"><i class="fa fa-dashboard"></i> Home</a></li>
        <li><a href="<?php echo base_url();?>index.php/Capacity/"><i class="fa fa-dashboard"></i> Back to List</a></li>
        <li class="active">Capacity Form</li>
      </ol>
    </section>

     <!-- Main content -->
    <section class="content">
      <div class="row">

          <!-- right column -->
        <div class="col-md-8">
          <!-- Horizontal Form -->
          <div class="box box-info">
            <div class="box-header with-border">
              <h3 class="box-title"></h3>
            </div>
            <!-- /.box-header -->
            <!-- form start -->
            <form class="form-horizontal" method="POST" enctype="multipart/form-data" action="<?php echo base_url();?>index.php/Vehicle/upload">
              <!-- radio -->
                
            <div class="box-body">
                <div class="form-group clearfix">
					<div class="col-md-3">
						<label for="exampleInputEmail1">Upload image</label>
					</div>
					
					<div class="col-md-6">
				   <input type='file' name='userfile' size='20' />
					</div>
					
				</div>				   
            </div>
              <!-- /.box-body -->
              
			  <div class="box-footer">
				<button type="submit" id="submit" class="btn btn-info">Create</button>
                <button type="reset" class="btn pull-right">Cancel</button>
                
              </div>
              <!-- /.box-footer -->
            </form>
          </div>
          <!-- /.box -->
          
        </div>
        <!--/.col (right) -->
     </div>

    </section>
    <!-- /.content -->
  </div>
  <!-- /.content-wrapper -->