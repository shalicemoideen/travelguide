<?php 
 $currentusertype = $this->session->userdata('user_type');
 ?>

<!--**********************************
			Sidebar start
		***********************************-->
		<div class="dlabnav">
			<div class="dlabnav-scroll">
				<ul class="metismenu" id="menu">
					<li class="<?php if($this->uri->segment(1)=="Home"){echo "active";}?>"><a href="<?php echo base_url();?>index.php/Home" aria-expanded="false">
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

							<?php endif;if (has_any_permission([
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
							<li class="<?php if($this->uri->segment(1)=="Special_requirments"){echo "active";}?>"><a href="<?php echo base_url();?>index.php/Special_requirments">Special requirments</a></li>
						</ul>
					</li>
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
							<li class="<?php if($this->uri->segment(1)=="Packages"){echo "active";}?>"><a href="<?php echo base_url();?>index.php/Packages">My templates</a></li>
							<li class="<?php if($this->uri->segment(1)=="Package_category"){echo "active";}?>"><a href="<?php echo base_url();?>index.php/Package_category">Templates category</a></li>
						</ul>
					</li>
					<?php endif; ?>
					<?php  
					if (has_any_permission([
						'QUOTATION_VIEW',
						'QUOTATION_CREATE',
						'QUOTATION_UPDATE',
						'QUOTATION_DELETE'
					])): ?>
					<li class="<?php if($this->uri->segment(1)=="Quotation"){echo "active";}?>"><a  href="<?php echo base_url();?>index.php/Quotation" aria-expanded="false">
							<i class="flaticon-017-clipboard"></i>
							<span class="nav-text">Quotation</span>
						</a>
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