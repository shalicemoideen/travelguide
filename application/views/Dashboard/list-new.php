<div class="main-panel">
			<div class="container">
				<div class="page-inner">
					<!-- Card -->
					<h4 class="page-title">Dashboard</h4>
					<div class="row">
						<!--<div class="col-sm-6 col-md-3">
							<div class="card card-stats card-primary card-round">
								<div class="card-body">
									<div class="row">
										<div class="col-5">
											<div class="icon-big text-center">
												<i class="fas fa-chalkboard"></i>
											</div>
										</div>
										<div class="col-7 col-stats">
											<div class="numbers">
												<p class="card-category">Total Board</p>
												<h4 class="card-title" ><a href="<?php echo base_url();?>index.php/Board" style="color:#ffffff">
												<?php foreach ($Board_count as $row)
												{
													if($row->total_count == 0){
														echo '0';
													}
													else{
														echo $row->total_count;
													}
												}?>
												</a></h4>
											</div>
										</div>
									</div>
								</div>
							</div>
						</div>-->
						<div class="col-sm-6 col-md-3">
							<div class="card card-stats card-info card-round">
								<div class="card-body">
									<div class="row">
										<div class="col-5">
											<div class="icon-big text-center">
												<i class="flaticon-users"></i>
											</div>
										</div>
										<div class="col-7 col-stats">
											<div class="numbers">
												<p class="card-category">Total customer</p>
												<h4 class="card-title" ><a href="<?php echo base_url();?>index.php/Customer" style="color:#ffffff">
												<?php foreach ($Customer_count as $row)
												{
													if($row->total_count == 0){
														echo '0';
													}
													else{
														echo $row->total_count;
													}
												}?>
												</a></h4>
											</div>
										</div>
									</div>
								</div>
							</div>
						</div>
						<!--<div class="col-sm-6 col-md-3">
							<div class="card card-stats card-success card-round">
								<div class="card-body ">
									<div class="row">
										<div class="col-5">
											<div class="icon-big text-center">
												<i class="fas fa-building"></i>
											</div>
										</div>
										<div class="col-7 col-stats">
											<div class="numbers">
												<p class="card-category">Total Building</p>
												<h4 class="card-title" ><a href="<?php echo base_url();?>index.php/Building" style="color:#ffffff">
												<?php foreach ($Building_count as $row)
												{
													if($row->total_count == 0){
														echo '0';
													}
													else{
														echo $row->total_count;
													}
												}?>
												</a></h4>
											</div>
										</div>
									</div>
								</div>
							</div>
						</div>
						<div class="col-sm-6 col-md-3">
							<div class="card card-stats card-secondary card-round">
								<div class="card-body ">
									<div class="row">
										<div class="col-5">
											<div class="icon-big text-center">
												<i class="flaticon-interface-7"></i>
											</div>
										</div>
										<div class="col-7 col-stats">
											<div class="numbers">
												<p class="card-category">Total Land</p>
												<!--<h4 class="card-title">576</h4>
												<h4 class="card-title" ><a href="<?php echo base_url();?>index.php/Land" style="color:#ffffff">
												<?php foreach ($Land_count as $row)
												{
													if($row->total_count == 0){
														echo '0';
													}
													else{
														echo $row->total_count;
													}
												}?>
												</a></h4>
											</div>
										</div>
									</div>
								</div>
							</div>
						</div>-->
						<div class="col-sm-6 col-md-3">
							<div class="card card-stats card-round">
								<div class="card-body ">
									<div class="row">
										<div class="col-5">
											<div class="icon-big text-center">
												<i class="fas fa-check text-success"></i>
											</div>
										</div>
										<div class="col-7 col-stats">
											<div class="numbers">
												<p class="card-category">Available board list</p>
												<h4 class="card-title" ><a href="<?php echo base_url();?>index.php/Available_boards" style="color:#2A2F5B">
												<?php $Available_board = isset($Available_board)?$Available_board:0;
                  echo $Available_board;?>
												</a></h4>
											</div>
										</div>
									</div>
								</div>
							</div>
						</div>
						<div class="col-sm-6 col-md-3">
							<div class="card card-stats card-round">
								<div class="card-body ">
									<div class="row">
										<div class="col-5">
											<div class="icon-big text-center">
												<i class="fas fa-exclamation-triangle text-danger"></i>
											</div>
										</div>
										<div class="col-7 col-stats">
											<div class="numbers">
												<p class="card-category">Booking pending</p>
												<h4 class="card-title" ><a href="<?php echo base_url();?>index.php/Booking_pending" style="color:#2A2F5B">
												<?php foreach ($BookingPending_count as $row)
												{
													if($row->total_count == 0){
														echo '0';
													}
													else{
														echo $row->total_count;
													}
												}?>
												</a></h4>
											</div>
										</div>
									</div>
								</div>
							</div>
						</div>
						<div class="col-sm-6 col-md-3">
							<div class="card card-stats card-round">
								<div class="card-body">
									<div class="row">
										<div class="col-5">
											<div class="icon-big text-center">
												<i class="fas fa-book text-warning"></i>
											</div>
										</div>
										<div class="col-7 col-stats">
											<div class="numbers">
												<p class="card-category">Active booked</p>
												<h4 class="card-title" ><a href="<?php echo base_url();?>index.php/Activebooked" style="color:#2A2F5B">
												<?php foreach ($ActiveBooked_count as $row)
												{
													if($row->total_count == 0){
														echo '0';
													}
													else{
														echo $row->total_count;
													}
												}?>
												</a></h4>
											</div>
										</div>
									</div>
								</div>
							</div>
						</div>
					</div>
					<!-- Card With Icon States Color -->
					<div class="row">
						
						<div class="col-sm-6 col-md-3">
							<div class="card card-stats card-round">
								<div class="card-body">
									<div class="row">
										<div class="col-5">
											<div class="icon-big text-center">
												<i class="fas fa-backspace text-primary"></i>
											</div>
										</div>
										<div class="col-7 col-stats">
											<div class="numbers">
												<p class="card-category">Booking closed</p>
												<h4 class="card-title" ><a href="<?php echo base_url();?>index.php/Bookingclosed" style="color:#2A2F5B">
												<?php foreach ($BookingClosed_count as $row)
												{
													if($row->total_count == 0){
														echo '0';
													}
													else{
														echo $row->total_count;
													}
												}?>
												</a></h4>
											</div>
										</div>
									</div>
								</div>
							</div>
						</div>
						
						<div class="col-sm-6 col-md-3">
							<div class="card card-stats card-round">
								<div class="card-body ">
									<div class="row align-items-center">
										<div class="col-icon">
											<div class="icon-big text-center icon-primary bubble-shadow-small">
												<i class="fas fa-lock"></i>
											</div>
										</div>
										<div class="col col-stats ml-3 ml-sm-0">
											<div class="numbers">
												<p class="card-category">Active blocked</p>
												<h4 class="card-title" ><a href="<?php echo base_url();?>index.php/Activeblocked" style="color:#2A2F5B">
												<?php foreach ($ActiveBlocked_count as $row)
												{
													if($row->total_count == 0){
														echo '0';
													}
													else{
														echo $row->total_count;
													}
												}?>
												</a></h4>
											</div>
										</div>
									</div>
								</div>
							</div>
						</div>
						<!--fas fa-times-->
						<div class="col-sm-6 col-md-3">
							<div class="card card-stats card-round">
								<div class="card-body">
									<div class="row align-items-center">
										<div class="col-icon">
											<div class="icon-big text-center icon-info bubble-shadow-small">
												<i class="fas fa-lock-open"></i>
											</div>
										</div>
										<div class="col col-stats ml-3 ml-sm-0">
											<div class="numbers">
												<p class="card-category"><a href="<?php echo base_url();?>index.php/Activeunblocked" style="color:#2A2F5B">
												 unblocked data
												</a></p>
												
											</div>
										</div>
									</div>
								</div>
							</div>
						</div>
						<div class="col-sm-6 col-md-3">
							<div class="card card-stats card-round">
								<div class="card-body">
									<div class="row align-items-center">
										<div class="col-icon">
											<div class="icon-big text-center icon-success bubble-shadow-small">
												<i class="fas fa-warehouse"></i>
											</div>
										</div>
										<div class="col col-stats ml-3 ml-sm-0">
											<div class="numbers">
												<p class="card-category">On due properties</p>
												<h4 class="card-title" ><a href="<?php echo base_url();?>index.php/Renewalondueproperties" style="color:#2A2F5B">
												<?php foreach ($OnDueProperties_count as $row)
												{
													if($row->total_count == 0){
														echo '0';
													}
													else{
														echo $row->total_count;
													}
												}?>
												</a></h4>
											</div>
										</div>
									</div>
								</div>
							</div>
						</div>
					</div>
					<!-- Card With Icon States Background -->
					<div class="row">
						
						<div class="col-sm-6 col-md-3">
							<div class="card card-stats card-round">
								<div class="card-body">
									<div class="row align-items-center">
										<div class="col-icon">
											<div class="icon-big text-center icon-secondary bubble-shadow-small">
												<i class="fas fa-book-open"></i>
											</div>
										</div>
										<div class="col col-stats ml-3 ml-sm-0">
											<div class="numbers">
												<p class="card-category">On due insurance</p>
												<h4 class="card-title" ><a href="<?php echo base_url();?>index.php/Insuranceondueboards" style="color:#2A2F5B">
												<?php foreach ($OnDueInsurance_count as $row)
												{
													if($row->total_count == 0){
														echo '0';
													}
													else{
														echo $row->total_count;
													}
												}?>
												</a></h4>
											</div>
										</div>
									</div>
								</div>
							</div>
						</div>
						
						<div class="col-sm-6 col-md-3">
							<div class="card card-stats card-round">
								<div class="card-body ">
									<div class="row">
										<div class="col-5">
											<div class="icon-big text-center">
												<i class="fas fa-exclamation-circle text-danger"></i>
											</div>
										</div>
										<div class="col-7 col-stats">
											<div class="numbers">
												<p class="card-category">Duration  dued without display</p>
												<h4 class="card-title" ><a href="<?php echo base_url();?>index.php/BookingPendingDue" style="color:#2A2F5B">
												<?php foreach ($BoardBookingPendingDue_count as $row)
												{
													if($row->total_count == 0){
														echo '0';
													}
													else{
														echo $row->total_count;
													}
												}?>
												</a></h4>
											</div>
										</div>
									</div>
								</div>
							</div>
						</div>
						<div class="col-sm-6 col-md-3">
							<div class="card card-stats card-round">
								<div class="card-body ">
									<div class="row">
										<div class="col-5">
											<div class="icon-big text-center">
												<i class="fas fa-bookmark text-warning"></i>
											</div>
										</div>
										<div class="col-7 col-stats">
											<div class="numbers">
												<p class="card-category">Booking due</p>
												<h4 class="card-title" ><a href="<?php echo base_url();?>index.php/ActiveBookedDue" style="color:#2A2F5B">
												<?php foreach ($BoardActiveBookedDue_count as $row)
												{
													if($row->total_count == 0){
														echo '0';
													}
													else{
														echo $row->total_count;
													}
												}?>
												</a></h4>
											</div>
										</div>
									</div>
								</div>
							</div>
						</div>
					</div>
					<!-- Card With Icon States Color -->
					
					<!-- Card With Icon States Background -->
					
					<button class="btn btn-danger" id="btn">
						<span class="btn-label">
							<i class="fas fa-filter"></i>
						</span>
						Filter
					</button>
					<br>
					<br>
					
					<div class="row">
						<div class="col-md-12">
						<form id="exampleValidation" method="POST" action="" enctype="multipart/form-data">
							<div class="card">
								<div class="card-header" id="Create" style="display:none">
									<div class="d-flex align-items-center hdr-filter-dd-fullwd">
										<div class="row row-demo-grid">
											<div class="col-sm-6 col-md-3">
												<div class="card">
													<select name="state_id" id="state_id" class="form-control input-lg lst-flt-select2">
														<option value="">Please Select State</option>
														<?php
														foreach($state as $row)
														{
														 echo '<option value="'.$row->state_id.'">'.$row->state_name.'</option>';
														}
														?>
													</select>
												</div>
											</div>
											<div class="col-sm-6 col-md-3">
												<div class="card">
													<select name="district_id" id="district_id" class="form-control input-lg lst-flt-select2">
														<option value="">Please Select District</option>
														<!--<?php
														foreach($district as $districts){
																$town_name = isset($records->district_id_fk)?$records->district_id_fk:'';
																?>
														<option value="<?php echo $districts->district_id?>"<?php if($town_name == $districts->district_id) echo "selected=selected"?>><?php echo $districts->district_name ?></option>
														 
														 <?php
																}
														?>-->
													</select>
												</div>
											</div>
											<div class="col-sm-6 col-md-3">
												<div class="card">
													<select name="town_id" id="town_id" class="form-control input-lg lst-flt-select2">
														<option value="">Please Select Town</option>
													</select>
												</div>
											</div>
											<div class="col-sm-6 col-md-3">
												<div class="card">
													<select name="landmark_id" id="landmark_id" class="form-control input-lg lst-flt-select2">
														<option value="">Please Select Landmark</option>
													</select>
												</div>
											</div>
											<div class="col-sm-6 col-md-3">
												<div class="card">
													<select name="property_id" id="property_id" class="form-control input-lg lst-flt-select2" >
														<option value="">Please Select Property</option>
													</select>
												</div>
											</div>
											<div class="col-sm-6 col-md-3">
												<div class="card">
													<select name="board_id_fk" id="board_id_fk" class="form-control input-lg lst-flt-select2" >
														<option value="">Please Select Board</option>
													</select>
												</div>
											</div>
											<!--<div class="col-sm-6 col-md-3">
												<div class="card">
													<select name="customer_name" id="customer_name" class="form-control input-lg">
														<option value="">Please Select customer</option>
														<?php
														foreach($customer as $row)
														{
														 echo '<option value="'.$row->customer_name.'">'.$row->customer_name.'</option>';
														}
														?>
													</select>
												</div>
											</div>-->

											<div class="col-sm-6 col-md-3">
												<div class="card">
													<div class="input-group">
														<input type="text" class="form-control" placeholder="Start date" id="start_date" name="start_date">
														<div class="input-group-append">
															<span class="input-group-text">
																<i class="fa fa-calendar-check"></i>
															</span>
														</div>
													</div>
												</div>
											</div>
											<div class="col-sm-6 col-md-3">
												<div class="card">
													<div class="input-group">
														<input type="text" class="form-control"  placeholder="End date" id="end_date" name="end_date">
														<div class="input-group-append">
															<span class="input-group-text">
																<i class="fa fa-calendar-check"></i>
															</span>
														</div>
													</div>
												</div>
											</div>
											<div class="col-sm-2 col-md-2">
												<div class="card">
													<button type="button" class="btn btn-warning" id="search">
														<span class="btn-label">
															<i class="fas fa-search"></i>
														</span>
														Search
													</button>
												</div>
											</div>
											<a href="<?php echo base_url();?>index.php/dashboard">
												<button type="button" class="btn btn-secondary">
													<span class="btn-label">
														<i class="icon-refresh"></i>
													</span>
													Refresh
												</button>
											</a>
										</div>
									
									</div>
								</div>
								<div class="card-body">
									 
									<div class="table-responsive">
										<table id="Availablity_checking_table" class="display table table-striped table-hover" >
											<thead>
												<tr>
												  <th>Sl No.</th>
												  <th>Board number</th>
												  <th>Width</th>
												  <th>Height</th>
												  <th>Location</th>
												  <th><center>Order no:</center></th>
												  <th><center>Customer name:</center></th>
												  <th style="width:100px"><center>start date</center></th>
												  <th style="width:100px"><center>End date</center></th>
												  
												  <th><center>Status</center></th>
												  <th style="width:100px"><center>Action</center></th>
												 
												  
												</tr>
											</thead>
											<tfoot>
												
											</tfoot>
											<tbody>
												
											</tbody>
										</table>
									</div>
								</div>
							</div>
							</form>
						</div>
					</div><!--new row close-->
				</div>
			</div>
	<!-- Bootstrap modal -->
<div class="modal fade" id="PendingtobookingModal" tabindex="-1" role="dialog" data-backdrop="static"  data-keyboard="false">
    <div class="modal-dialog">
        <div class="modal-content">
            <div class="modal-header">
				<h2 class="modal-title">
					<span class="fw-mediumbold">
					Do you need to change status from pending into booked ?</span> 
					<!--<span class="fw-light">
						Row
					</span>-->
									</h2>
				<button type="button" class="close"  data-dismiss="modal" aria-label="Close">
					<span aria-hidden="true">&times;</span>
				</button>
			</div>
            <div class="modal-body form">
                <form method="post" action="" id="modal_form_id" enctype="multipart/form-data">
					<div class="form-group form-show-validation row">
						<label for="birth" class="col-lg-4 col-md-3 col-sm-4 mt-sm-2 text-right">Booking start date <span class="required-label">*</span></label>
						<div class="col-lg-6 col-md-9 col-sm-8">
							<div class="input-group">
								<input type="text" class="form-control" id="booking_start_date" placeholder="Enter booking start date" name="booking_start_date" value="" required>
								<div class="input-group-append">
									<span class="input-group-text">
										<i class="fa fa-calendar-o"></i>
									</span>
								</div>
							</div>
						</div>
					</div>
					<div class="form-group form-show-validation row">
						<label for="birth" class="col-lg-4 col-md-3 col-sm-4 mt-sm-2 text-right">Booking end date <span class="required-label">*</span></label>
						<div class="col-lg-6 col-md-9 col-sm-8">
							<div class="input-group">
								<input type="text" class="form-control" id="booking_end_date" placeholder="Enter booking end date" name="booking_end_date" required>
								<div class="input-group-append">
									<span class="input-group-text">
										<i class="fa fa-calendar-o"></i>
									</span>
								</div>
							</div>
						</div>
					</div>
					<div class="form-group form-show-validation row">
						<label class="col-lg-4 col-md-3 col-sm-4 mt-sm-2 text-right">Booking intial pic <span class="required-label">*</span></label>
						<div class="col-lg-6 col-md-9 col-sm-8">
							<div>
								<input type="file" class="form-control form-control-file" id="booking_initial_image" name="booking_initial_image" required>
							</div>
						</div>
					</div>					
                
            </div>
            <div class="modal-footer">
                <!--<button type="button" id="btnSave" onclick="save()" class="btn btn-primary">Save</button>
                <button type="button" class="btn btn-danger" data-dismiss="modal">Cancel</button>
				-->
				<button type="button" id="cnl"  data-dismiss="modal"  class="btn btn-primary cnl" >CANCEL</button>
				<button type="submit"  id="lkl" class="btn btn-primary option"  target="0">OK</button>

			</div>
			</form>
        </div><!-- /.modal-content -->
    </div><!-- /.modal-dialog -->
</div><!-- /.modal -->
<!-- End Bootstrap modal -->

<!-- Bootstrap modal -->
<div class="modal fade" id="BookedtoclosedModal" tabindex="-1" role="dialog" data-backdrop="static"  data-keyboard="false">
    <div class="modal-dialog">
        <div class="modal-content">
            <div class="modal-header">
				<h2 class="modal-title">
					<span class="fw-mediumbold">
					Do you need to change status from booked into closed ?</span> 
					<!--<span class="fw-light">
						Row
					</span>-->
									</h2>
				<button type="button" class="close"  data-dismiss="modal" aria-label="Close">
					<span aria-hidden="true">&times;</span>
				</button>
			</div>
            <div class="modal-body form">
                <form method="post" action="" id="modal_form_id" enctype="multipart/form-data">
                    <div class="form-group form-show-validation row">
						<label for="birth" class="col-lg-4 col-md-3 col-sm-4 mt-sm-2 text-right">Booking closing date <span class="required-label">*</span></label>
						<div class="col-lg-7 col-md-9 col-sm-8">
							<div class="input-group">
								<input id="booking_closing_date" name="booking_closing_date" placeholder="Enter booking closing date" class="form-control" type="text" required>
								<div class="input-group-append">
									<span class="input-group-text">
										<i class="fa fa-calendar-o"></i>
									</span>
								</div>
							</div>
						</div>
					</div>
					<div class="form-group form-show-validation row">
						<label class="col-lg-4 col-md-3 col-sm-4 mt-sm-2 text-right">Booking closing pic <span class="required-label">*</span></label>
						<div class="col-lg-7 col-md-9 col-sm-8">
							<div>
								<input type='file' class="form-control form-control-file"id='booking_closing_image'  name="booking_closing_image" required>
							</div>
						</div>
					</div>
                </form>
            </div>
            <div class="modal-footer">
                <!--<button type="button" id="btnSave" onclick="save()" class="btn btn-primary">Save</button>
                <button type="button" class="btn btn-danger" data-dismiss="modal">Cancel</button>
				-->
				<button type="button" id="cnl"  data-dismiss="modal"  class="btn btn-primary cnl" >CANCEL</button>
				<button type="submit"  id="lkl1" class="btn btn-primary option"  target="0">OK</button>

			</div>
        </div><!-- /.modal-content -->
    </div><!-- /.modal-dialog -->
</div><!-- /.modal -->
<!-- End Bootstrap modal -->