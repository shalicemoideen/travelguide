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
					<li><a class="has-arrow " href="javascript:void()" aria-expanded="false">
						<i class="flaticon-038-gauge"></i>
							<span class="nav-text">Staff Managment</span>
						</a>
						<ul aria-expanded="false">
							<li class="<?php if($this->uri->segment(1)=="Staff"){echo "active";}?>"><a href="<?php echo base_url();?>index.php/Staff">Staff</a></li>
							<!-- <li class="<?php if($this->uri->segment(1)=="Designation"){echo "active";}?>"><a href="<?php echo base_url();?>index.php/Designation">Designation</a></li>
							<li class="<?php if($this->uri->segment(1)=="Role"){echo "active";}?>"><a href="<?php echo base_url();?>index.php/Role">Role</a></li> -->
						</ul>
					</li>
					<li><a class="has-arrow " href="javascript:void()" aria-expanded="false">
						<i class="flaticon-050-info"></i>
							<span class="nav-text">Masters</span>
						</a>
						<ul aria-expanded="false">
							<li><a class="has-arrow" href="javascript:void()" aria-expanded="false">Property</a>
								<ul aria-expanded="false">
									<li><a class="<?php if($this->uri->segment(1)=="Property_registration"){echo "active";}?>" href="<?php echo base_url();?>index.php/Property_registration">My properties</a></li>
									<li class="<?php if($this->uri->segment(1)=="Property_category"){echo "active";}?>"><a href="<?php echo base_url();?>index.php/Property_category">Property category</a></li>
								</ul>
							</li>
							<li class="<?php if($this->uri->segment(1)=="Destination"){echo "active";}?>"><a href="<?php echo base_url();?>index.php/Destination">Destination</a></li>
							<li><a class="has-arrow" href="javascript:void()" aria-expanded="false">Vehicles</a>
								<ul aria-expanded="false">
									<li class="<?php if($this->uri->segment(1)=="Vehicle"){echo "active";}?>"><a href="<?php echo base_url();?>index.php/Vehicle">Vehicle models</a></li>
									<li class="<?php if($this->uri->segment(1)=="Transporter"){echo "active";}?>"><a href="<?php echo base_url();?>index.php/Transporter">Transporter</a></li>
								</ul>
							</li>
							<li><a class="has-arrow" href="javascript:void()" aria-expanded="false">Partners</a>
								<ul aria-expanded="false">
									<li class="<?php if($this->uri->segment(1)=="B2b_partner"){echo "active";}?>"><a href="<?php echo base_url();?>index.php/B2b_partner">B2B partner</a></li>
								</ul>
							</li>
						</ul>
					</li>
					<li><a class="has-arrow " href="javascript:void()" aria-expanded="false">
						<i class="flaticon-038-gauge"></i>
							<span class="nav-text">Itinerary</span>
						</a>
						<ul aria-expanded="false">
							<li class="<?php if($this->uri->segment(1)=="itinerary"){echo "active";}?>"><a href="<?php echo base_url();?>index.php/itinerary">My itinerary</a></li>
							<li class="<?php if($this->uri->segment(1)=="Itinerary_category"){echo "active";}?>"><a href="<?php echo base_url();?>index.php/Itinerary_category">Itinerary category</a></li>
							<li class="<?php if($this->uri->segment(1)=="Inclusions_exclusions"){echo "active";}?>"><a href="<?php echo base_url();?>index.php/Inclusions_exclusions">Inclusions & exclusions</a></li>
							<li class="<?php if($this->uri->segment(1)=="Payment_policies"){echo "active";}?>"><a href="<?php echo base_url();?>index.php/Payment_policies">Payment policy</a></li>
							<li class="<?php if($this->uri->segment(1)=="Terms_condition"){echo "active";}?>"><a href="<?php echo base_url();?>index.php/Terms_condition">Terms and condition</a></li>
							<li class="<?php if($this->uri->segment(1)=="Cancellation_policies"){echo "active";}?>"><a href="<?php echo base_url();?>index.php/Cancellation_policies">Cancellation and policy</a></li>
							<li class="<?php if($this->uri->segment(1)=="Special_requirments"){echo "active";}?>"><a href="<?php echo base_url();?>index.php/Special_requirments">Special requirments</a></li>
							<!-- <li class="<?php if($this->uri->segment(1)=="Destination"){echo "active";}?>"><a href="<?php echo base_url();?>index.php/Destination">important travel guidlines</a></li> -->
							<!-- <li class="<?php if($this->uri->segment(1)=="Destination"){echo "active";}?>"><a href="<?php echo base_url();?>index.php/Destination">Terms & conditions</a></li>
							<li class="<?php if($this->uri->segment(1)=="Destination"){echo "active";}?>"><a href="<?php echo base_url();?>index.php/Destination">Optional add ons</a></li>
							<li class="<?php if($this->uri->segment(1)=="Destination"){echo "active";}?>"><a href="<?php echo base_url();?>index.php/Destination">Special requirments</a></li>
							<li class="<?php if($this->uri->segment(1)=="Destination"){echo "active";}?>"><a href="<?php echo base_url();?>index.php/Destination">Notes</a></li>
							<li class="<?php if($this->uri->segment(1)=="Destination"){echo "active";}?>"><a href="<?php echo base_url();?>index.php/Destination">Travel tips</a></li> -->
						</ul>
					</li>
					<li><a class="has-arrow " href="javascript:void()" aria-expanded="false">
						<i class="flaticon-038-gauge"></i>
							<span class="nav-text">Templates</span>
						</a>
						<ul aria-expanded="false">
							<li class="<?php if($this->uri->segment(1)=="Packages"){echo "active";}?>"><a href="<?php echo base_url();?>index.php/Packages">My templates</a></li>
							<li class="<?php if($this->uri->segment(1)=="Package_category"){echo "active";}?>"><a href="<?php echo base_url();?>index.php/Package_category">Templates category</a></li>
						</ul>
					</li>
					<!-- <li class="<?php if($this->uri->segment(1)=="Rooms"){echo "active";}?>"><a href="<?php echo base_url();?>index.php/Rooms" aria-expanded="false">
							<i class="flaticon-058-minus"></i>
							<span class="nav-text">Rooms</span>
						</a>
					</li>
					<li class="<?php if($this->uri->segment(1)=="Room_tariff_management"){echo "active";}?>"><a href="<?php echo base_url();?>index.php/Room_tariff_management" aria-expanded="false">
							<i class="flaticon-063-pencil"></i>
							<span class="nav-text">Room tariff</span>
						</a>
					</li> -->
					<li class="<?php if($this->uri->segment(1)=="Leads"){echo "active";}?>"><a href="<?php echo base_url();?>index.php/Leads" aria-expanded="false">
							<i class="flaticon-052-inside"></i>
							<span class="nav-text">Leads</span>
						</a>
					</li>
					<li class="<?php if($this->uri->segment(1)=="Quotation"){echo "active";}?>"><a  href="<?php echo base_url();?>index.php/Quotation" aria-expanded="false">
							<i class="flaticon-017-clipboard"></i>
							<span class="nav-text">Quotation</span>
						</a>
					</li>
					<li><a class="has-arrow " href="javascript:void()" aria-expanded="false">
						<i class="flaticon-050-info"></i>
							<span class="nav-text">Meta Settings</span>
						</a>
						<ul aria-expanded="false">
							<li class="<?php if($this->uri->segment(1)=="Meta_ads_setting"){echo "active";}?>"><a href="<?php echo base_url();?>index.php/Meta_ads_setting">Create ads</a></li>
							<li class="<?php if($this->uri->segment(1)=="staff_order_assign"){echo "active";}?>"><a href="<?php echo base_url();?>index.php/staff_order_assign">Assign order</a></li>
						</ul>
					</li>
				</ul>

			</div>
		</div>
		<!--**********************************
			Sidebar end
		***********************************-->