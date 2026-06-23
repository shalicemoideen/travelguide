<!--**********************************
			Content body start
		***********************************-->
		<div class="content-body">
			<!-- row -->
			<div class="container-fluid">
				<div class="row mb-3">
					<div class="col-xl-12 text-end">
						<select id="dashboard-period-select" class="form-select" style="width:auto;display:inline-block;">
							<option value="today" selected>Today</option>
							<option value="week">This Week</option>
							<option value="month">This Month</option>
							<option value="year">This Year</option>
						</select>
					</div>
				</div>

				<div class="row">
					<div class="col-xl-12">
						<div class="row">
							<div class="col-xl-12">
								<div class="row">
									<div class="col-xl-3 col-sm-6">
										<div class="card" style="background:linear-gradient(135deg,#667eea 0%,#764ba2 100%);border:none;border-radius:12px;">
											<div class="card-body">
												<div class="d-flex align-items-center justify-content-between">
													<div>
														<h2 class="mb-1 font-w600" id="total_leads_count" style="color:#fff;font-size:2rem;"><a href="<?php echo base_url();?>index.php/Leads" style="color:#fff;"><?php foreach ($allleads as $row){ echo ($row->total_count==0)?"0":$row->total_count; } ?></a></h2>
														<p class="mb-1" style="color:rgba(255,255,255,0.9);font-weight:600;">Total Leads</p>
													</div>
													<div style="opacity:0.35;"><svg xmlns="http://www.w3.org/2000/svg" width="52" height="52" fill="white" viewBox="0 0 24 24"><path d="M16 11c1.66 0 2.99-1.34 2.99-3S17.66 5 16 5c-1.66 0-3 1.34-3 3s1.34 3 3 3zm-8 0c1.66 0 2.99-1.34 2.99-3S9.66 5 8 5C6.34 5 5 6.34 5 8s1.34 3 3 3zm0 2c-2.33 0-7 1.17-7 3.5V19h14v-2.5c0-2.33-4.67-3.5-7-3.5zm8 0c-.29 0-.62.02-.97.05 1.16.84 1.97 1.97 1.97 3.45V19h6v-2.5c0-2.33-4.67-3.5-7-3.5z"/></svg></div>
												</div>
											</div>
										</div>
									</div>
									<div class="col-xl-3 col-sm-6">
										<div class="card" style="background:linear-gradient(135deg,#f093fb 0%,#f5576c 100%);border:none;border-radius:12px;">
											<div class="card-body">
												<div class="d-flex align-items-center justify-content-between">
													<div>
														<h2 class="mb-1 font-w600" id="converted_trips_count" style="color:#fff;font-size:2rem;"><a href="<?php echo base_url();?>index.php/LeadsConverted" style="color:#fff;"><?php foreach ($converted as $row){ echo ($row->total_count==0)?"0":$row->total_count; } ?></a></h2>
														<p class="mb-1" style="color:rgba(255,255,255,0.9);font-weight:600;">Converted Trips</p>
													</div>
													<div style="opacity:0.35;"><svg xmlns="http://www.w3.org/2000/svg" width="52" height="52" fill="white" viewBox="0 0 24 24"><path d="M9 16.17L4.83 12l-1.42 1.41L9 19 21 7l-1.41-1.41z"/></svg></div>
												</div>
											</div>
										</div>
									</div>
									<div class="col-xl-3 col-sm-6">
										<div class="card" style="background:linear-gradient(135deg,#28a745 0%,#20c997 100%);border:none;border-radius:12px;">
											<div class="card-body">
												<div class="d-flex align-items-center justify-content-between">
													<div>
														<h2 class="mb-1 font-w600" id="checkin_count" style="color:#fff;font-size:2rem;">
															<a href="<?php echo base_url();?>index.php/Staff_attendance" style="color:#fff;">
																<?php foreach ($checkin as $row)
																{
																	if($row->total_count == 0){ echo '0'; }
																	else{ echo $row->total_count; }
																}?>
															</a>
														</h2>
														<p class="mb-1" style="color:rgba(255,255,255,0.9);font-weight:600;">Check-In</p>
													</div>
													<div style="opacity:0.35;">
														<svg xmlns="http://www.w3.org/2000/svg" width="52" height="52" fill="white" viewBox="0 0 24 24"><path d="M10 17v-3H3v-4h7V7l5 5-5 5zm9 2H12v-2h7V5h-7V3h7a2 2 0 0 1 2 2v14a2 2 0 0 1-2 2z"/></svg>
													</div>
												</div>
											</div>
										</div>
									</div>
									<div class="col-xl-3 col-sm-6">
										<div class="card" style="background:linear-gradient(135deg,#fd7e14 0%,#ffc107 100%);border:none;border-radius:12px;">
											<div class="card-body">
												<div class="d-flex align-items-center justify-content-between">
													<div>
														<h2 class="mb-1 font-w600" id="checkout_count" style="color:#fff;font-size:2rem;">
															<a href="<?php echo base_url();?>index.php/Staff_attendance" style="color:#fff;">
																<?php foreach ($checkout as $row)
																{
																	if($row->total_count == 0){ echo '0'; }
																	else{ echo $row->total_count; }
																}?>
															</a>
														</h2>
														<p class="mb-1" style="color:rgba(255,255,255,0.9);font-weight:600;">Check-Out</p>
													</div>
													<div style="opacity:0.35;">
														<svg xmlns="http://www.w3.org/2000/svg" width="52" height="52" fill="white" viewBox="0 0 24 24"><path d="M14 7v3h7v4h-7v3l-5-5 5-5zM5 5h7V3H5a2 2 0 0 0-2 2v14a2 2 0 0 0 2 2h7v-2H5V5z"/></svg>
													</div>
												</div>
											</div>
										</div>
									</div>
								</div>
							</div>
							
							
						</div>
					</div>
				</div>
			</div>
		</div>

		<!-- ===== PERIOD FILTER CARDS ===== -->
		<div class="row mt-3">
			<div class="col-xl-12 col-sm-12">
				<div class="card" style="background:linear-gradient(135deg,#11998e 0%,#38ef7d 100%);border:none;border-radius:12px;">
					<div class="card-body">
						<div class="d-flex align-items-center justify-content-between">
							<div>
								<h2 class="mb-1 font-w600" id="quotations_sent_count" style="color:#fff;font-size:2rem;">
									<?php foreach ($quotations_sent as $row){ echo ($row->total_count == 0) ? '0' : $row->total_count; } ?>
								</h2>
								<p class="mb-1" style="color:rgba(255,255,255,0.9);font-weight:600;">Quotations Sent</p>
							</div>
							<div style="opacity:0.35;">
								<svg xmlns="http://www.w3.org/2000/svg" width="52" height="52" fill="white" viewBox="0 0 24 24"><path d="M20 4H4c-1.1 0-2 .9-2 2v12c0 1.1.9 2 2 2h16c1.1 0 2-.9 2-2V6c0-1.1-.9-2-2-2zm0 14H4V6h16v12zM4 0h16v2H4zm0 22h16v2H4z"/></svg>
							</div>
						</div>
					</div>
				</div>
			</div>
		</div>
		<!-- ===== END PERIOD FILTER CARDS ===== -->

		<!--**********************************
			Content body end
		***********************************-->