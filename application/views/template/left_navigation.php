<?php 
 $currentusertype = $this->session->userdata('user_type');
 ?>

<!--**********************************
			Sidebar start
		***********************************-->
		<div class="dlabnav">
			<div class="dlabnav-scroll">
				<ul class="metismenu" id="menu">
					<li class="<?php if($this->uri->segment(1)=="Dashboard"){echo "active";}?>"><a href="<?php echo base_url();?>index.php/Dashboard" aria-expanded="false">
							<i class="flaticon-025-dashboard"></i>
							<span class="nav-text">Dashboard</span>
						</a>
					</li>
					<?php if (has_any_permission([
						'LEADS_VIEW',
						'LEADS_CREATE',
						'LEADS_UPDATE',
						'LEADS_DELETE'
					])): ?>
					<li class="<?php if($this->uri->segment(1)=="Leads"){echo "active";}?>"><a href="<?php echo base_url();?>index.php/Leads" aria-expanded="false">
							<i class="flaticon-052-inside"></i>
							<span class="nav-text">Leads</span>
						</a>
					</li>
					<?php endif; ?>
					<?php if($this->session->userdata('user_type') == 'A'){ ?>

					<li><a class="has-arrow " href="javascript:void()" aria-expanded="false">
						<!-- <i class="flaticon-038-gauge"></i> -->
						<i class="bi bi-people-fill"></i>
							<span class="nav-text">Staff Managment</span>
						</a>
						<ul aria-expanded="false">
							<li class="<?php if($this->uri->segment(1)=="Staff"){echo "active";}?>"><a href="<?php echo base_url();?>index.php/Staff">Staff</a></li>
							<li class="<?php if($this->uri->segment(1)=="Staff_attendance"){echo "active";}?>"><a href="<?php echo base_url();?>index.php/Staff_attendance">Staff Attendance</a></li>
							<li class="<?php if($this->uri->segment(1)=="Role"){echo "active";}?>"><a href="<?php echo base_url();?>index.php/Role">Role</a></li>
							<li class="<?php if($this->uri->segment(1)=="Designation"){echo "active";}?>"><a href="<?php echo base_url();?>index.php/Designation">Designation</a></li>
						</ul>
					</li>

					<?php } ?>
					
					

					<?php if (has_any_permission([
							'PROPERTY_VIEW',
							'PROPERTY_CREATE',
							'PROPERTY_UPDATE',
							'PROPERTY_DELETE',
							'PROPERTY_CATEGORY_CREATE',
							'PROPERTY_CATEGORY_UPDATE',
							'PROPERTY_CATEGORY_DELETE',
							'DESTINATION_VIEW',
							'DESTINATION_CREATE',
							'DESTINATION_UPDATE',
							'DESTINATION_DELETE',
							'LOCATION_VIEW',
							'LOCATION_CREATE',
							'LOCATION_UPDATE',
							'LOCATION_DELETE',
							'VEHICLE_VIEW',
							'VEHICLE_CREATE',
							'VEHICLE_UPDATE',
							'VEHICLE_DELETE',
							'TRANSPORTER_VIEW',
							'TRANSPORTER_CREATE',
							'TRANSPORTER_UPDATE',
							'TRANSPORTER_DELETE'
						])): ?>	
					<li><a class="has-arrow " href="javascript:void()" aria-expanded="false">
						<i class="flaticon-013-checkmark"></i>
							<span class="nav-text">Masters</span>
						</a>
						<ul aria-expanded="false">
							<?php if (has_any_permission([
										'PROPERTY_VIEW',
										'PROPERTY_CREATE',
										'PROPERTY_UPDATE',
										'PROPERTY_DELETE',
										'PROPERTY_CATEGORY_CREATE',
										'PROPERTY_CATEGORY_UPDATE',
										'PROPERTY_CATEGORY_DELETE'
									])): ?>							
							<li><a class="has-arrow" href="javascript:void()" aria-expanded="false">Property</a>
								<ul aria-expanded="false">
									<?php if (has_any_permission([
										'PROPERTY_VIEW',
										'PROPERTY_CREATE',
										'PROPERTY_UPDATE',
										'PROPERTY_DELETE'
									])): ?>
									<li><a class="<?php if($this->uri->segment(1)=="Property_registration"){echo "active";}?>" href="<?php echo base_url();?>index.php/Property_registration">My properties</a></li>
									<?php endif; 
									if (has_any_permission([
										'PROPERTY_CATEGORY_CREATE',
										'PROPERTY_CATEGORY_UPDATE',
										'PROPERTY_CATEGORY_DELETE'
									])):
									?>	
									<li class="<?php if($this->uri->segment(1)=="Property_category"){echo "active";}?>"><a href="<?php echo base_url();?>index.php/Property_category">Property category</a></li>
									<?php endif; ?>	
								</ul>
							</li>
							<?php endif; ?>
							
							<?php if (has_any_permission([
							    'LOCATION_VIEW',
							    'LOCATION_CREATE',
							    'LOCATION_UPDATE',
							    'LOCATION_DELETE'
							])): ?>
							<li class="<?php if($this->uri->segment(1)=="Location"){echo "active";}?>"><a href="<?php echo base_url();?>index.php/Location">Location</a></li>

							<?php endif; ?>
							<?php if (has_any_permission([
							    'ACCOUNT_DETAILS_VIEW',
							    'ACCOUNT_DETAILS_CREATE',
							    'ACCOUNT_DETAILS_UPDATE',
							    'ACCOUNT_DETAILS_DELETE'
							])): ?>
							<li class="<?php if($this->uri->segment(1)=="Account_details"){echo "active";}?>"><a href="<?php echo base_url();?>index.php/Account_details">Account Details</a></li>
							<?php endif; ?>
							<?php if (has_any_permission([
							    'DESTINATION_VIEW',
							    'DESTINATION_CREATE',
							    'DESTINATION_UPDATE',
							    'DESTINATION_DELETE'
							])): ?>
							<li class="<?php if($this->uri->segment(1)=="Destination"){echo "active";}?>"><a href="<?php echo base_url();?>index.php/Destination">Destination</a></li>
						<?php endif; ?>
							<?php if($this->session->userdata('user_type') == 'A'){ ?>
							<li class="<?php if($this->uri->segment(1)=="Company_holidays"){echo "active";}?>"><a href="<?php echo base_url();?>index.php/Company_holidays">Company Holidays</a></li>
							<?php } ?>
							<?php if (has_any_permission([
							    'VEHICLE_VIEW',
							    'VEHICLE_CREATE',
							    'VEHICLE_UPDATE',
							    'VEHICLE_DELETE',
								'TRANSPORTER_VIEW',
								'TRANSPORTER_CREATE',
								'TRANSPORTER_UPDATE',
								'TRANSPORTER_DELETE'
							])): ?>
							<li><a class="has-arrow" href="javascript:void()" aria-expanded="false">Vehicles</a>
								<ul aria-expanded="false">
									<?php if (has_any_permission([
										'VEHICLE_VIEW',
										'VEHICLE_CREATE',
										'VEHICLE_UPDATE',
										'VEHICLE_DELETE'
									])): ?>
									<li class="<?php if($this->uri->segment(1)=="Vehicle"){echo "active";}?>"><a href="<?php echo base_url();?>index.php/Vehicle">Vehicle models</a></li>
									<?php endif; if (has_any_permission([
										'TRANSPORTER_VIEW',
										'TRANSPORTER_CREATE',
										'TRANSPORTER_UPDATE',
										'TRANSPORTER_DELETE'
									])):?>	
									<li class="<?php if($this->uri->segment(1)=="Transporter"){echo "active";}?>"><a href="<?php echo base_url();?>index.php/Transporter">Transporter</a></li>
									<?php endif; ?>	
								</ul>
							</li>
							<li><a class="has-arrow" href="javascript:void()" aria-expanded="false">Leads</a>
								<ul aria-expanded="false">
									<?php if (has_any_permission([
										'SOURCE_VIEW',
										'SOURCE_CREATE',
										'SOURCE_UPDATE',
										'SOURCE_DELETE'
									])): ?>									
									<li class="<?php if($this->uri->segment(1)=="Source"){echo "active";}?>"><a href="<?php echo base_url();?>index.php/Source">Source</a></li>								
									<?php endif; if (has_any_permission([
										'STAGE_VIEW',
										'STAGE_CREATE',
										'STAGE_UPDATE',
										'STAGE_DELETE'
									])):?>
									<li class="<?php if($this->uri->segment(1)=="Stages"){echo "active";}?>"><a href="<?php echo base_url();?>index.php/Stages">Stages</a></li>
									<?php endif; if (has_any_permission([
										'PRIORITY_STATUS_VIEW',
										'PRIORITY_STATUS_CREATE',
										'PRIORITY_STATUS_UPDATE',
										'PRIORITY_STATUS_DELETE'
									])):?>
									<li class="<?php if($this->uri->segment(1)=="Priority_status"){echo "active";}?>"><a href="<?php echo base_url();?>index.php/Priority_status">Priority Status</a></li>								
									<?php endif; ?>
								</ul>
							</li>
						<?php endif; 
							if (has_any_permission([
							    'B2B_PARTNER_VIEW',
							    'B2B_PARTNER_CREATE',
							    'B2B_PARTNER_UPDATE',
							    'B2B_PARTNER_DELETE'
							])): ?>
							<li><a class="has-arrow" href="javascript:void()" aria-expanded="false">Partners</a>
								<ul aria-expanded="false">
									<li class="<?php if($this->uri->segment(1)=="B2b_partner"){echo "active";}?>"><a href="<?php echo base_url();?>index.php/B2b_partner">B2B partner</a></li>
								</ul>
							</li>
						<?php endif; ?>
							
						</ul>
					</li>
					<?php endif; ?>
					
					<?php if (has_any_permission([
							'ITINERARY_VIEW',
							'ITINERARY_CREATE',
							'ITINERARY_UPDATE',
							'ITINERARY_DELETE',
							'CATEGORY_VIEW',
							'CATEGORY_CREATE',
							'CATEGORY_UPDATE',
							'CATEGORY_DELETE',
							'INCLUSION_AND_EXCLUSION_VIEW',
							'INCLUSION_AND_EXCLUSION_CREATE',
							'INCLUSION_AND_EXCLUSION_UPDATE',
							'INCLUSION_AND_EXCLUSION_DELETE',
							'PAYMENT_POLICY_VIEW',
							'PAYMENT_POLICY_CREATE',
							'PAYMENT_POLICY_UPDATE',
							'PAYMENT_POLICY_DELETE',
							'TERMS_AND_CONDITIONS_VIEW',
							'TERMS_AND_CONDITIONS_CREATE',
							'TERMS_AND_CONDITIONS_UPDATE',
							'TERMS_AND_CONDITIONS_DELETE',
							'CANCELLATION_AND_POLICY_VIEW',
							'CANCELLATION_AND_POLICY_CREATE',
							'CANCELLATION_AND_POLICY_UPDATE',
							'CANCELLATION_AND_POLICY_DELETE'
						])): ?>
					<li><a class="has-arrow " href="javascript:void()" aria-expanded="false">
						<!-- <i class="flaticon-038-gauge"></i> -->
						<i class="bi bi-layout-split"></i>
							<span class="nav-text">Itinerary</span>
						</a>
						<ul aria-expanded="false">
							<?php  
							if (has_any_permission([
								'ITINERARY_VIEW',
								'ITINERARY_CREATE',
								'ITINERARY_UPDATE',
								'ITINERARY_DELETE'
							])): ?>
							<li class="<?php if($this->uri->segment(1)=="itinerary"){echo "active";}?>"><a href="<?php echo base_url();?>index.php/itinerary">My itinerary</a></li>
							<?php endif; if (has_any_permission([
								'CATEGORY_VIEW',
								'CATEGORY_CREATE',
								'CATEGORY_UPDATE',
								'CATEGORY_DELETE'
							])):?>
							<li class="<?php if($this->uri->segment(1)=="Itinerary_category"){echo "active";}?>"><a href="<?php echo base_url();?>index.php/Itinerary_category">Itinerary category</a></li>
							<?php endif; if (has_any_permission([
								'INCLUSION_AND_EXCLUSION_VIEW',
								'INCLUSION_AND_EXCLUSION_CREATE',
								'INCLUSION_AND_EXCLUSION_UPDATE',
								'INCLUSION_AND_EXCLUSION_DELETE'
							])):?>
							<li class="<?php if($this->uri->segment(1)=="Inclusions_exclusions"){echo "active";}?>"><a href="<?php echo base_url();?>index.php/Inclusions_exclusions">Inclusions & exclusions</a></li>
							<?php endif; if (has_any_permission([
								'PAYMENT_POLICY_VIEW',
								'PAYMENT_POLICY_CREATE',
								'PAYMENT_POLICY_UPDATE',
								'PAYMENT_POLICY_DELETE'
							])):?>
							<li class="<?php if($this->uri->segment(1)=="Payment_policies"){echo "active";}?>"><a href="<?php echo base_url();?>index.php/Payment_policies">Payment policy</a></li>
							<?php endif; if (has_any_permission([
								'TERMS_AND_CONDITIONS_VIEW',
								'TERMS_AND_CONDITIONS_CREATE',
								'TERMS_AND_CONDITIONS_UPDATE',
								'TERMS_AND_CONDITIONS_DELETE'
							])):?>
							<li class="<?php if($this->uri->segment(1)=="Terms_condition"){echo "active";}?>"><a href="<?php echo base_url();?>index.php/Terms_condition">Terms and condition</a></li>
							<?php endif; if (has_any_permission([
								'CANCELLATION_AND_POLICY_VIEW',
								'CANCELLATION_AND_POLICY_CREATE',
								'CANCELLATION_AND_POLICY_UPDATE',
								'CANCELLATION_AND_POLICY_DELETE'
							])):?>
							<li class="<?php if($this->uri->segment(1)=="Cancellation_policies"){echo "active";}?>"><a href="<?php echo base_url();?>index.php/Cancellation_policies">Cancellation and policy</a></li>
							<?php endif; ?>
							<!-- <li class="<?php if($this->uri->segment(1)=="Special_requirments"){echo "active";}?>"><a href="<?php echo base_url();?>index.php/Special_requirments">Special requirments</a></li> -->
						</ul>
					</li>
					<?php endif; ?>
					<?php  
					if (has_any_permission([
						'TEMPLATES_VIEW',
						'TEMPLATES_CREATE',
						'TEMPLATES_UPDATE',
						'TEMPLATES_DELETE'
					])): ?>
					<li><a class="has-arrow " href="javascript:void()" aria-expanded="false">
						<i class="flaticon-022-copy"></i>
							<span class="nav-text">Templates</span>
						</a>
						<ul aria-expanded="false">
							<?php if (has_permission('TEMPLATE_MASTER_VIEW')): ?>
							<li class="<?php if($this->uri->segment(1)=="Template_master"){echo "active";}?>"><a href="<?php echo base_url();?>index.php/Template_master">Template Master</a></li>
							<?php endif; ?>
							<li class="<?php if($this->uri->segment(1)=="Packages"){echo "active";}?>"><a href="<?php echo base_url();?>index.php/Packages">My templates</a></li>
							<li class="<?php if($this->uri->segment(1)=="Package_category"){echo "active";}?>"><a href="<?php echo base_url();?>index.php/Package_category">Templates category</a></li>
						</ul>
					</li>
					<?php endif; ?>
					<?php  
					if (has_any_permission([
						'QUOTATION_VIEW',
						'QUOTATION_VIEW_CONFIRMED',
						'QUOTATION_CREATE',
						'QUOTATION_UPDATE',
						'QUOTATION_DELETE'
					])): ?>
					<li class="<?php if($this->uri->segment(1)=="Quotation" && $this->uri->segment(2)!="converted_trips_report"){echo "active";}?>"><a href="<?php echo base_url();?>index.php/Quotation" aria-expanded="false">
							<i class="flaticon-017-clipboard"></i>
							<span class="nav-text">Quotation</span>
						</a>
					</li>
					<?php endif; ?>

					<?php if (has_any_permission([
						'BOOKING_CANCELLATION_VIEW',
						'BOOKING_CANCELLATION_TRACKER',
						'BOOKING_CANCELLATION_REPORT',
						'PROPERTY_CREDIT_VIEW'
					])): ?>
					<li class="<?php if($this->uri->segment(1)=="Booking_cancellation"){echo "active";}?>"><a class="has-arrow" href="javascript:void()" aria-expanded="false">
						<i class="la la-ban"></i>
						<span class="nav-text">Cancellations</span>
					</a>
					<ul aria-expanded="false">
						<?php if (has_permission('BOOKING_CANCELLATION_VIEW')): ?>
						<li class="<?php if($this->uri->segment(1)=="Booking_cancellation" && $this->uri->segment(2)==""){echo "active";}?>"><a href="<?php echo base_url();?>index.php/Booking_cancellation">Booking Cancellation</a></li>
						<?php endif; ?>
						<?php if (has_permission('BOOKING_CANCELLATION_TRACKER')): ?>
						<li class="<?php if($this->uri->segment(2)=="tracker"){echo "active";}?>"><a href="<?php echo base_url();?>index.php/Booking_cancellation/tracker">Supplier Refund Tracker</a></li>
						<?php endif; ?>
						<?php if (has_permission('BOOKING_CANCELLATION_REPORT')): ?>
						<li class="<?php if($this->uri->segment(2)=="customer_refund_register"){echo "active";}?>"><a href="<?php echo base_url();?>index.php/Booking_cancellation/customer_refund_register">Customer Refund Register</a></li>
						<?php endif; ?>
						<?php if (has_permission('PROPERTY_CREDIT_VIEW')): ?>
						<li class="<?php if($this->uri->segment(1)=="Property_credit"){echo "active";}?>"><a href="<?php echo base_url();?>index.php/Property_credit">Property Credit Ledger</a></li>
						<?php endif; ?>
					</ul>
					</li>
					<?php endif; ?>

					<?php if (has_any_permission([
						'CONVERTED_TRIPS_REPORT',
						'INCENTIVE_REPORT',
						'FINANCIAL_POSTING_REPORT',
						'LEAD_REPORT',
						'QUOTATION_REPORT',
						'TRANSPORTER_REPORT',
						'CUSTOMER_PAYMENT_REPORT',
						'PROPERTY_PAYMENTS_REPORT',
						'PAYMENT_REPORT'
					])): ?>
					<li class="<?php if($this->uri->segment(2)=="converted_trips_report" || $this->uri->segment(2)=="incentive_reports" || $this->uri->segment(2)=="financial_posting_report" || $this->uri->segment(2)=="quotation_report" || $this->uri->segment(2)=="transporter_report" || $this->uri->segment(1)=="IncentiveConfig" || $this->uri->segment(2)=="lead_report" || $this->uri->segment(2)=="customer_payment_report" || $this->uri->segment(2)=="property_payments_report" || $this->uri->segment(1)=="Payment_report"){echo "active";}?>"><a class="has-arrow" href="javascript:void()" aria-expanded="false">
							<i class="bi bi-bar-chart-line-fill"></i>
							<span class="nav-text">Reports</span>
						</a>
						<ul aria-expanded="false">
							<?php if (has_permission('CONVERTED_TRIPS_REPORT')): ?>
							<li class="<?php if($this->uri->segment(2)=="converted_trips_report"){echo "active";}?>"><a href="<?php echo base_url();?>index.php/Quotation/converted_trips_report">Converted Trips</a></li>
							<?php endif; ?>
							<?php if (has_permission('INCENTIVE_REPORT')): ?>
							<li class="<?php if($this->uri->segment(2)=="incentive_reports"){echo "active";}?>"><a href="<?php echo base_url();?>index.php/Quotation/incentive_reports">Incentive Report</a></li>
							<?php endif; ?>
							<?php if (has_permission('FINANCIAL_POSTING_REPORT')): ?>
							<li class="<?php if($this->uri->segment(2)=="financial_posting_report"){echo "active";}?>"><a href="<?php echo base_url();?>index.php/Quotation/financial_posting_report">Financial Posting</a></li>
							<?php endif; ?>
							<?php if (has_permission('LEAD_REPORT')): ?>
							<li class="<?php if($this->uri->segment(2)=="lead_report"){echo "active";}?>"><a href="<?php echo base_url();?>index.php/Leads/lead_report">Lead Report</a></li>
							<?php endif; ?>
							<?php if (has_permission('QUOTATION_REPORT')): ?>
							<li class="<?php if($this->uri->segment(2)=="quotation_report"){echo "active";}?>"><a href="<?php echo base_url();?>index.php/Quotation/quotation_report">Quotation Report</a></li>
							<?php endif; ?>
							<?php if (has_permission('TRANSPORTER_REPORT')): ?>
								<li class="<?php if($this->uri->segment(2) == "transporter_report"){echo "active";}?>"><a href="<?php echo base_url();?>index.php/Quotation/transporter_report">Transporter Report</a></li>
							<?php endif; ?>
						<!-- <?php if (has_permission('CUSTOMER_PAYMENT_REPORT')): ?>
							<li class="<?php if($this->uri->segment(2)=="customer_payment_report"){echo "active";}?>"><a href="<?php echo base_url();?>index.php/Receipt_scheduler/customer_payment_report">Customer Payment Report</a></li>
						<?php endif; ?>
						<?php if (has_permission('PROPERTY_PAYMENTS_REPORT')): ?>
							<li class="<?php if($this->uri->segment(2)=="property_payments_report"){echo "active";}?>"><a href="<?php echo base_url();?>index.php/Property_reservation/property_payments_report">Property Payments Report</a></li>
						<?php endif; ?> -->
						<?php if (has_permission('PAYMENT_REPORT')): ?>
							<li class="<?php if($this->uri->segment(1)=="Payment_report"){echo "active";}?>"><a href="<?php echo base_url();?>index.php/Payment_report">Payment Report</a></li>
						<?php endif; ?>
						<?php if($this->session->userdata('user_type') == 'A'): ?>
						<li class="<?php if($this->uri->segment(1)=="IncentiveConfig"){echo "active";}?>"><a href="<?php echo base_url();?>index.php/IncentiveConfig">Incentive Config</a></li>
						<?php endif; ?>
						</ul>
					</li>
					<?php endif; ?>
					<?php if($this->session->userdata('user_type') == 'A'){ ?>
					<li><a class="has-arrow " href="javascript:void()" aria-expanded="false">
						<!-- <i class="flaticon-050-info"></i> -->
						 <i class="bi bi-badge-ad-fill"></i>
							<span class="nav-text">Meta Settings</span>
						</a>
						<ul aria-expanded="false">
							<li class="<?php if($this->uri->segment(1)=="Meta_ads_setting"){echo "active";}?>"><a href="<?php echo base_url();?>index.php/Meta_ads_setting">Create ads</a></li>
							<li class="<?php if($this->uri->segment(1)=="staff_order_assign"){echo "active";}?>"><a href="<?php echo base_url();?>index.php/staff_order_assign">Assign order</a></li>
						</ul>
					</li>
					<?php } ?>
					<!-- <li><a class="has-arrow " href="javascript:void()" aria-expanded="false">
						<i class="flaticon-050-info"></i>
							<span class="nav-text">Settings</span>
						</a>
						<ul aria-expanded="false">
							<li class="<?php if($this->uri->segment(1)=="Property_category"){echo "active";}?>"><a href="<?php echo base_url();?>index.php/Property_category">Property category</a></li>
						</ul>
					</li> -->
				</ul>

			</div>
		</div>
		<!--**********************************
			Sidebar end
		***********************************-->