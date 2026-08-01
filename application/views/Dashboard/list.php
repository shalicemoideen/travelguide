<!--**********************************
		Content body start
	***********************************-->
<div class="content-body">
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
					<div class="col-xl-3 col-sm-6">
						<div class="card" style="background:linear-gradient(135deg,#667eea 0%,#764ba2 100%);border:none;border-radius:12px;">
							<div class="card-body">
								<div class="d-flex align-items-center justify-content-between">
									<div>
										<h2 class="mb-1 font-w600" id="total_leads_count" style="color:#fff;font-size:2rem;">
											<a id="total-leads-link" href="<?php echo base_url();?>index.php/Leads/lead_report?period=today" style="color:#fff;">
												<?php foreach ($allleads as $row){ echo ($row->total_count == 0) ? '0' : $row->total_count; } ?>
											</a>
										</h2>
										<p class="mb-1" style="color:rgba(255,255,255,0.9);font-weight:600;">Total Leads</p>
									</div>
									<div style="opacity:0.35;">
										<svg xmlns="http://www.w3.org/2000/svg" width="52" height="52" fill="white" viewBox="0 0 24 24"><path d="M16 11c1.66 0 2.99-1.34 2.99-3S17.66 5 16 5c-1.66 0-3 1.34-3 3s1.34 3 3 3zm-8 0c1.66 0 2.99-1.34 2.99-3S9.66 5 8 5C6.34 5 5 6.34 5 8s1.34 3 3 3zm0 2c-2.33 0-7 1.17-7 3.5V19h14v-2.5c0-2.33-4.67-3.5-7-3.5zm8 0c-.29 0-.62.02-.97.05 1.16.84 1.97 1.97 1.97 3.45V19h6v-2.5c0-2.33-4.67-3.5-7-3.5z"/></svg>
									</div>
								</div>
							</div>
						</div>
					</div>
					<div class="col-xl-3 col-sm-6">
						<div class="card" style="background:linear-gradient(135deg,#f093fb 0%,#f5576c 100%);border:none;border-radius:12px;">
							<div class="card-body">
								<div class="d-flex align-items-center justify-content-between">
									<div>
										<h2 class="mb-1 font-w600" id="converted_trips_count" style="color:#fff;font-size:2rem;">
											<a id="converted-trips-link" href="<?php echo base_url();?>index.php/Quotation/converted_trips_report?period=today" style="color:#fff;">
												<?php foreach ($converted as $row){ echo ($row->total_count == 0) ? '0' : $row->total_count; } ?>
											</a>
										</h2>
										<p class="mb-1" style="color:rgba(255,255,255,0.9);font-weight:600;">Converted Trips</p>
									</div>
									<div style="opacity:0.35;">
										<svg xmlns="http://www.w3.org/2000/svg" width="52" height="52" fill="white" viewBox="0 0 24 24"><path d="M9 16.17L4.83 12l-1.42 1.41L9 19 21 7l-1.41-1.41z"/></svg>
									</div>
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
											<a id="arrival-trips-link" href="<?php echo base_url();?>index.php/Quotation/converted_trips_report?period=today&date_type=arrival" style="color:#fff;">
												<?php foreach ($checkin as $row){ echo ($row->total_count == 0) ? '0' : $row->total_count; } ?>
											</a>
										</h2>
										<p class="mb-1" style="color:rgba(255,255,255,0.9);font-weight:600;">Arrival trips</p>
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
											<a id="departure-trips-link" href="<?php echo base_url();?>index.php/Quotation/converted_trips_report?period=today&date_type=departure" style="color:#fff;">
												<?php foreach ($checkout as $row){ echo ($row->total_count == 0) ? '0' : $row->total_count; } ?>
											</a>
										</h2>
										<p class="mb-1" style="color:rgba(255,255,255,0.9);font-weight:600;">Departure trips</p>
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

		<!-- ===== PERIOD FILTER CARDS ===== -->
		<div class="row mt-3">
			<div class="col-xl-3 col-sm-6">
				<div class="card" style="background:linear-gradient(135deg,#11998e 0%,#38ef7d 100%);border:none;border-radius:12px;">
					<div class="card-body">
						<div class="d-flex align-items-center justify-content-between">
							<div>
								<h2 class="mb-1 font-w600" id="quotations_generated_count" style="color:#fff;font-size:2rem;">
									<a id="quotations-generated-link" href="<?php echo base_url();?>index.php/Quotation/quotation_report?period=today&status=1" style="color:#fff;">
										<?php foreach ($quotations_generated as $row){ echo ($row->total_count == 0) ? '0' : $row->total_count; } ?>
									</a>
								</h2>
								<p class="mb-1" style="color:rgba(255,255,255,0.9);font-weight:600;">Quotation Generated</p>
							</div>
							<div style="opacity:0.35;">
								<svg xmlns="http://www.w3.org/2000/svg" width="52" height="52" fill="white" viewBox="0 0 24 24"><path d="M14 2H6c-1.1 0-2 .9-2 2v16c0 1.1.9 2 2 2h12c1.1 0 2-.9 2-2V8l-6-6zm2 16H8v-2h8v2zm0-4H8v-2h8v2zm-3-5V3.5L18.5 9H13z"/></svg>
							</div>
						</div>
					</div>
				</div>
			</div>
			<div class="col-xl-3 col-sm-6">
				<div class="card" style="background:linear-gradient(135deg,#4facfe 0%,#00f2fe 100%);border:none;border-radius:12px;">
					<div class="card-body">
						<div class="d-flex align-items-center justify-content-between">
							<div>
								<h2 class="mb-1 font-w600" id="quotations_confirmed_count" style="color:#fff;font-size:2rem;">
									<a id="quotations-confirmed-link" href="<?php echo base_url();?>index.php/Quotation/quotation_report?period=today&status=5" style="color:#fff;">
										<?php foreach ($quotations_confirmed as $row){ echo ($row->total_count == 0) ? '0' : $row->total_count; } ?>
									</a>
								</h2>
								<p class="mb-1" style="color:rgba(255,255,255,0.9);font-weight:600;">Confirmed</p>
							</div>
							<div style="opacity:0.35;">
								<svg xmlns="http://www.w3.org/2000/svg" width="52" height="52" fill="white" viewBox="0 0 24 24"><path d="M9 16.17L4.83 12l-1.42 1.41L9 19 21 7l-1.41-1.41z"/></svg>
							</div>
						</div>
					</div>
				</div>
			</div>
			<div class="col-xl-3 col-sm-6">
				<div class="card" style="background:linear-gradient(135deg,#a18cd1 0%,#fbc2eb 100%);border:none;border-radius:12px;">
					<div class="card-body">
						<div class="d-flex align-items-center justify-content-between">
							<div>
								<h2 class="mb-1 font-w600" id="quotations_reservation_count" style="color:#fff;font-size:2rem;">
									<a id="quotations-reservation-link" href="<?php echo base_url();?>index.php/Quotation/quotation_report?period=today&status=8" style="color:#fff;">
										<?php foreach ($quotations_reservation as $row){ echo ($row->total_count == 0) ? '0' : $row->total_count; } ?>
									</a>
								</h2>
								<p class="mb-1" style="color:rgba(255,255,255,0.9);font-weight:600;">Reservation Completed</p>
							</div>
							<div style="opacity:0.35;">
								<svg xmlns="http://www.w3.org/2000/svg" width="52" height="52" fill="white" viewBox="0 0 24 24"><path d="M19 3H5c-1.1 0-2 .9-2 2v14c0 1.1.9 2 2 2h14c1.1 0 2-.9 2-2V5c0-1.1-.9-2-2-2zm-2 14H7v-2h10v2zm0-4H7v-2h10v2zm0-4H7V7h10v2z"/></svg>
							</div>
						</div>
					</div>
				</div>
			</div>
			<div class="col-xl-3 col-sm-6">
				<div class="card" style="background:linear-gradient(135deg,#f6d365 0%,#fda085 100%);border:none;border-radius:12px;">
					<div class="card-body">
						<div class="d-flex align-items-center justify-content-between">
							<div>
								<h2 class="mb-1 font-w600" id="quotations_driver_not_assigned_count" style="color:#fff;font-size:2rem;">
									<a id="quotations-driver-not-assigned-link" href="<?php echo base_url();?>index.php/Quotation/quotation_report?period=today&status=9" style="color:#fff;">
										<?php foreach ($quotations_driver_not_assigned as $row){ echo ($row->total_count == 0) ? '0' : $row->total_count; } ?>
									</a>
								</h2>
								<p class="mb-1" style="color:rgba(255,255,255,0.9);font-weight:600;">Driver Not Assigned</p>
							</div>
							<div style="opacity:0.35;">
								<svg xmlns="http://www.w3.org/2000/svg" width="52" height="52" fill="white" viewBox="0 0 24 24"><path d="M18.92 6.01C18.72 5.42 18.16 5 17.5 5h-11c-.66 0-1.21.42-1.42 1.01L3 12v8c0 .55.45 1 1 1h1c.55 0 1-.45 1-1v-1h12v1c0 .55.45 1 1 1h1c.55 0 1-.45 1-1v-8l-2.08-5.99zM6.5 16c-.83 0-1.5-.67-1.5-1.5S5.67 13 6.5 13s1.5.67 1.5 1.5S7.33 16 6.5 16zm11 0c-.83 0-1.5-.67-1.5-1.5s.67-1.5 1.5-1.5 1.5.67 1.5 1.5-.67 1.5-1.5 1.5zM5 11l1.5-4.5h11L19 11H5z"/></svg>
							</div>
						</div>
					</div>
				</div>
			</div>
		</div>
		<!-- ===== END PERIOD FILTER CARDS ===== -->

		<!-- ===== PENDING PAYMENT CARDS ===== -->
		<div class="row mt-3">
			<div class="col-xl-3 col-sm-6">
				<div class="card" style="background:linear-gradient(135deg,#e53935 0%,#ef5350 100%);border:none;border-radius:12px;">
					<div class="card-body">
						<div class="d-flex align-items-center justify-content-between">
							<div>
								<h2 class="mb-1 font-w600" id="pending_customer_payment_count" style="color:#fff;font-size:2rem;">
									<a id="pending-customer-payment-link" href="<?php echo base_url();?>index.php/Payment_report?period=today" style="color:#fff;">
										<?php echo ($pending_customer_payment == 0) ? '0' : $pending_customer_payment; ?>
									</a>
								</h2>
								<p class="mb-1" style="color:rgba(255,255,255,0.9);font-weight:600;">Customer Payment Pending</p>
							</div>
							<div style="opacity:0.35;">
								<svg xmlns="http://www.w3.org/2000/svg" width="52" height="52" fill="white" viewBox="0 0 24 24"><path d="M12 2C6.48 2 2 6.48 2 12s4.48 10 10 10 10-4.48 10-10S17.52 2 12 2zm1 15h-2v-2h2v2zm0-4h-2V7h2v6z"/></svg>
							</div>
						</div>
					</div>
				</div>
			</div>
			<div class="col-xl-3 col-sm-6">
				<div class="card" style="background:linear-gradient(135deg,#ff7043 0%,#ffab40 100%);border:none;border-radius:12px;">
					<div class="card-body">
						<div class="d-flex align-items-center justify-content-between">
							<div>
								<h2 class="mb-1 font-w600" id="pending_property_payment_count" style="color:#fff;font-size:2rem;">
									<a id="pending-property-payment-link" href="<?php echo base_url();?>index.php/Payment_report?period=today" style="color:#fff;">
										<?php echo ($pending_property_payment == 0) ? '0' : $pending_property_payment; ?>
									</a>
								</h2>
								<p class="mb-1" style="color:rgba(255,255,255,0.9);font-weight:600;">Property Payment Pending</p>
							</div>
							<div style="opacity:0.35;">
								<svg xmlns="http://www.w3.org/2000/svg" width="52" height="52" fill="white" viewBox="0 0 24 24"><path d="M19 3H5c-1.1 0-2 .9-2 2v14c0 1.1.9 2 2 2h14c1.1 0 2-.9 2-2V5c0-1.1-.9-2-2-2zm-7 14h-2v-2h2v2zm0-4h-2V7h2v6z"/></svg>
							</div>
						</div>
					</div>
				</div>
			</div>
		</div>
		<!-- ===== END PENDING PAYMENT CARDS ===== -->

		<!-- ===== LEADS ANALYTICS CHARTS ===== -->
		<div class="row">
			<div class="col-xl-8 col-lg-8">
				<div class="card">
					<div class="card-header border-0 pb-0">
						<h4 class="fs-20">Leads Incoming &ndash; Last 30 Days</h4>
					</div>
					<div class="card-body">
						<div id="leads_daily_chart"></div>
					</div>
				</div>
			</div>
			<div class="col-xl-4 col-lg-4">
				<div class="card">
					<div class="card-header border-0 pb-0">
						<h4 class="fs-20">Lead Status Breakdown</h4>
					</div>
					<div class="card-body">
						<div id="leads_status_donut"></div>
					</div>
				</div>
			</div>
			<div class="col-xl-12">
				<div class="card">
					<div class="card-header border-0 pb-0">
						<h4 class="fs-20">Staff &ndash; Leads Assigned vs Converted to Trip</h4>
					</div>
					<div class="card-body">
						<div id="leads_staff_chart"></div>
					</div>
				</div>
			</div>
		</div>
		<!-- ===== END LEADS ANALYTICS CHARTS ===== -->

	</div>
</div>
<!--**********************************
		Content body end
	***********************************-->
