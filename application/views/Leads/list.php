<style>
 
.modal-quote {
    max-width: 95%;
}
    /* .modal-body {
    max-height: calc(100vh - 210px);
    overflow-y: auto;
}
#QuotationModal .modal-dialog {
    max-width: 95%;
}

#QuotationModal .modal-content {
    max-height: calc(100vh - 30px);
    overflow: hidden;
}

#QuotationModal .modal-body {
    max-height: calc(100vh - 150px);
    overflow-y: auto !important;
    overflow-x: hidden;
} */

#QuotationModal .modal-dialog {
    max-width: 95%;
    height: calc(100vh - 20px);
    margin: 10px auto;
}

#QuotationModal .modal-content {
    height: 100%;
    display: flex;
    flex-direction: column;
    overflow: hidden;
}

#QuotationModal .modal-header,
#QuotationModal .modal-footer {
    flex: 0 0 auto;
}

#QuotationModal .modal-body {
    flex: 1 1 auto;
    min-height: 0;
    max-height: none !important;
    overflow-y: auto !important;
    overflow-x: hidden !important;
    -webkit-overflow-scrolling: touch;
}

#QuotationModal #inclusionBox,
#QuotationModal #specialReqBox {
    overflow: visible !important;
}

#QuotationModal .table-responsive,
#QuotationModal .table-responsive-md {
    overflow-x: auto;
    overflow-y: visible !important;
}

#QuotationModal .select2-container {
    z-index: 1065 !important;
}

#QuotationModal .select2-dropdown {
    z-index: 1066 !important;
}
.Leadsview{
  max-width: 95%;
}
/* Make amount column wider */
#inclusionTable .amount-col {
    min-width: 140px;
    width: 140px;
}

/* Force input full width */
#inclusionTable .inclusionAmountInput {
    width: 100% !important;
    min-width: 120px;
    /* text-align: right; */
    font-weight: 600;
}

/* Prevent shrink */
#inclusionTable td,
#inclusionTable th {
    white-space: nowrap;
}
</style>
<style>
    .modal-lead {
    max-width: 80%;
}

/* input states */
.is-invalid {
  border-color: #dc3545 !important;
  background-image: url("data:image/svg+xml,%3Csvg xmlns='http://www.w3.org/2000/svg' fill='%23dc3545' viewBox='0 0 16 16'%3E%3Cpath d='M8 1a7 7 0 1 0 0 14A7 7 0 0 0 8 1zm0 4.5a.75.75 0 0 1 .75.75v3a.75.75 0 0 1-1.5 0v-3A.75.75 0 0 1 8 5.5zm0 6a1 1 0 1 1 0-2 1 1 0 0 1 0 2z'/%3E%3C/svg%3E");
  background-repeat: no-repeat;
  background-position: right 0.5rem center;
  background-size: 1rem;
}

.is-valid {
  border-color: #28a745 !important;
  background-image: url("data:image/svg+xml,%3Csvg xmlns='http://www.w3.org/2000/svg' fill='%2328a745' viewBox='0 0 16 16'%3E%3Cpath d='M16 2.5 6 13 0 7l2-2 4 4 8-9z'/%3E%3C/svg%3E");
  background-repeat: no-repeat;
  background-position: right 0.5rem center;
  background-size: 1rem;
}

/* --- field states (border + icon) --- */
/* .is-invalid {
  border-color: #dc3545 !important;
  padding-right: 2rem !important;
  background-image: url("data:image/svg+xml,%3Csvg xmlns='http://www.w3.org/2000/svg' fill='%23dc3545' viewBox='0 0 16 16'%3E%3Cpath d='M8 1a7 7 0 1 0 0 14A7 7 0 0 0 8 1zm0 4.5a.75.75 0 0 1 .75.75v3a.75.75 0 0 1-1.5 0v-3A.75.75 0 0 1 8 5.5zm0 6a1 1 0 1 1 0-2 1 1 0 0 1 0 2z'/%3E%3C/svg%3E");
  background-repeat: no-repeat;
  background-position: right 0.6rem center;
  background-size: 1rem;
}
.is-valid {
  border-color: #28a745 !important;
  padding-right: 2rem !important;
  background-image: url("data:image/svg+xml,%3Csvg xmlns='http://www.w3.org/2000/svg' fill='%2328a745' viewBox='0 0 16 16'%3E%3Cpath d='M16 2.5 6 13 0 7l2-2 4 4 8-9z'/%3E%3C/svg%3E");
  background-repeat: no-repeat;
  background-position: right 0.6rem center;
  background-size: 1rem;
} */

/* --- shake animation --- */
@keyframes shakeX {
  0%, 100% { transform: translateX(0); }
  20% { transform: translateX(-6px); }
  40% { transform: translateX(6px); }
  60% { transform: translateX(-4px); }
  80% { transform: translateX(4px); }
}
.shake {
  animation: shakeX 280ms ease-in-out;
}

/* Reduce column padding and font size for a compact view */
#B2C_Leads_table {
    width: 100% !important;
    table-layout: auto;
}

#B2C_Leads_table th, 
#B2C_Leads_table td {
    padding: 5px 8px !important; /* Tightens the spacing */
    font-size: 12px;             /* Smaller text to fit more columns */
    white-space: nowrap;         /* Prevents text from wrapping to multiple lines */
}

/* Optional: allow wrapping on specific long text columns like 'Description' */
#B2C_Leads_table td.allow-wrap {
    white-space: normal;
    min-width: 130px;
}

/* Reduce column padding and font size for a compact view */
#meta_Leads_table {
    width: 100% !important;
    table-layout: auto;
}

#meta_Leads_table th, 
#meta_Leads_table td {
    padding: 5px 8px !important; /* Tightens the spacing */
    font-size: 12px;             /* Smaller text to fit more columns */
    white-space: nowrap;         /* Prevents text from wrapping to multiple lines */
}

/* Optional: allow wrapping on specific long text columns like 'Description' */
#meta_Leads_table td.allow-wrap {
    white-space: normal;
    min-width: 130px;
}
</style>
<style>
  .lead-view-modal{
    border:0;
    border-radius:22px;
    overflow:hidden;
    box-shadow:0 10px 35px rgba(0,0,0,.12);
  }

  .lead-view-header{
    background: linear-gradient(135deg, #eef1f4, #eef1f4);
    color:#fff;
    padding:16px 22px;
  }

  .lead-summary-box{
    background:#f8f9fb;
    border:1px solid #eef1f4;
    border-radius:18px;
    padding:20px;
    margin-bottom:18px;
  }

  .lead-summary-title{
    font-size:26px;
    font-weight:700;
    color:#212529;
    margin-bottom:4px;
  }

  .lead-summary-sub{
    color:#6c757d;
    font-size:14px;
  }

  .lead-chip{
    display:inline-block;
    padding:8px 14px;
    border-radius:999px;
    font-size:13px;
    font-weight:600;
    margin-left:8px;
  }

  .lead-card{
    background:#fff;
    border:1px solid #eef1f4;
    border-radius:18px;
    box-shadow:0 4px 14px rgba(0,0,0,.04);
    height:100%;
  }

  .lead-card-header{
    padding:14px 18px;
    border-bottom:1px solid #eef1f4;
    font-weight:700;
    font-size:15px;
    color:#212529;
    background:#fafbfc;
    border-top-left-radius:18px;
    border-top-right-radius:18px;
  }

  .lead-card-body{
    padding:16px 18px;
  }

  .lead-detail-row{
    display:flex;
    border-bottom:1px dashed #eceff3;
    padding:10px 0;
    gap:12px;
  }

  .lead-detail-row:last-child{
    border-bottom:0;
    padding-bottom:0;
  }

  .lead-detail-label{
    width:42%;
    min-width:160px;
    color:#6c757d;
    font-weight:600;
  }

  .lead-detail-value{
    flex:1;
    color:#212529;
    word-break:break-word;
  }

  .lead-description-box{
    background:#fcfcfd;
    border:1px solid #eef1f4;
    border-radius:18px;
    padding:18px;
    white-space:pre-line;
    color:#495057;
    min-height:120px;
  }

  .lead-top-badges{
    display:flex;
    flex-wrap:wrap;
    justify-content:flex-end;
    align-items:center;
    gap:8px;
  }

  .lead-type-badge{
    background:#212529;
    color:#fff;
    padding:8px 14px;
    border-radius:999px;
    font-size:13px;
    font-weight:600;
  }

  .status-chip{
    color:#fff;
    padding:8px 14px;
    border-radius:999px;
    font-size:13px;
    font-weight:600;
  }

  .status-intake{ background:#0dcaf0; color:#fff; }
  .status-qualified{ background:#6c757d; color:#fff; }
  .status-converted{ background:#198754; color:#fff; }
  .status-notqualified{ background:#ffc107; color:#212529; }
  .status-lost{ background:#dc3545; color:#fff; }

  .mini-info-row{
    display:flex;
    flex-wrap:wrap;
    gap:10px;
    margin-top:14px;
  }

  .mini-pill{
    background:#fff;
    border:1px solid #e9ecef;
    border-radius:12px;
    padding:10px 14px;
    font-size:13px;
  }

  .mini-pill strong{
    color:#495057;
    margin-right:6px;
  }

  .child-note-foc {
    color: red;
    font-size: 12px;
    margin-top: 3px;
    display: none;   /* hidden initially */
}
.itineraryDayRow {
    border-bottom: 6px solid #0d6efd !important;
    /* padding-bottom: 12px; */
}
</style>
<style>
.lead-accommodation-table th {
    font-size: 13px;
    font-weight: 700;
    white-space: nowrap;
}

.lead-accommodation-table td {
    font-size: 13px;
    vertical-align: middle;
}

#LeadsviewModal .nav-tabs .nav-link {
    font-weight: 600;
}

#LeadsviewModal .nav-tabs .nav-link.active {
    color: #0d6efd;
}
.lead-accommodation-table .badge {
    font-size: 11px;
    padding: 4px 8px;
    border-radius: 6px;
}
</style>
<style>
.select2-error {
    border: 1px solid #dc3545 !important;
    border-radius: 4px !important;
}

.select2-container--default .select2-selection.select2-error {
    border: 1px solid #dc3545 !important;
}

.room-rate-error td {
    border-top: 2px solid #dc3545 !important;
    border-bottom: 2px solid #dc3545 !important;
}

.room-rate-error td:first-child {
    border-left: 2px solid #dc3545 !important;
}

.room-rate-error td:last-child {
    border-right: 2px solid #dc3545 !important;
}
</style>
<style>
a.leads-number-link {
    font-weight: 600;
    color: #5b73e8;
    text-decoration: none;
    background-color: #eef1fd;
    padding: 2px 8px;
    border-radius: 4px;
    transition: background-color 0.2s;
}
a.leads-number-link:hover {
    background-color: #d6dcfa;
    color: #3a55d6;
    text-decoration: none;
}

.select2-container--default .select2-selection--single .select2-selection__clear {
    position: absolute;
    right: 25px;
    top: 50%;
    transform: translateY(-50%);
    z-index: 10;
}
.select2-container--default .select2-selection--single .select2-selection__arrow {
    position: absolute;
    right: 5px;
    top: 50%;
    transform: translateY(-50%);
}
</style>
<!--**********************************
			Content body start
		***********************************-->
		<div class="content-body">
			<!-- row -->
			<div class="container-fluid">
				<div class="d-flex justify-content-between align-items-center flex-wrap">
					<div class="card-action coin-tabs mb-2">
						<ul class="nav nav-tabs" role="tablist">
							<li class="nav-item">
								<a class="nav-link active" data-bs-toggle="tab" href="#Manualleads">B2C leads</a>
							</li>
							<li class="nav-item">
								<a class="nav-link" data-bs-toggle="tab" href="#Metaleads">Meta leads</a>
							</li>
							<!-- <li class="nav-item">
								<a class="nav-link" data-bs-toggle="tab" href="#B2Bleads">B2B Leads</a>
							</li> -->
						</ul>
					</div>
					<!-- <div class="d-flex align-items-center mb-2 flex-wrap"> 
						<div class="guest-calendar">
							<div id="reportrange" class="pull-right reportrange" style="width: 100%">
								<span></span><b class="caret"></b>
								<i class="fas fa-chevron-down ms-3"></i>
							</div>
						</div>
						<div class="newest ms-3">
							<select class="default-select">
								<option>Newest</option>
								<option>Oldest</option>
							</select>
						</div>	
					</div> -->
				</div>
				<div class="row mt-4">
					<div class="col-xl-12">
						<div class="card">
							<div class="card-body p-0">
								<div class="tab-content">                  
									<div class="tab-pane active show" id="Manualleads">                    
										<div class="d-flex justify-content-between align-items-center mb-3">
                      <button type="button" id="btn1" class="btn btn-rounded btn-primary btn-md">
                          <i class="fas fa-filter"></i> Filter
                      </button>
                      <?php if (has_permission('LEADS_CREATE')): ?>                                
                                <a onclick="add_leads()" data-bs-target="#LeadsModal" class="btn btn-rounded btn-secondary btn-md">
                                  + New B2C Lead
                              </a>
                        <?php endif; ?>
                      
                  </div>
                    <form id="exampleValidation1" method="POST" action="" enctype="multipart/form-data">
                        <div class="card-header" id="Create1" style="display:none">
                            <div class="d-flex align-items-center">
                                <div class="row row-demo-grid hdr-filter-dd-fullwd">
                                    <div class="col-sm-6 col-md-3">
                                        <div class="card">
                                            <div class="input-group">
                                                <select class="form-control input-lg lst2" id="leads_number_filter1" name="leads_number_filter1"><option value=""></option>
                                                </select>
                                            </div>
                                        </div>
                                    </div> 
                                    <?php if($this->session->userdata('user_type') == 'A') {?>
                                    <div class="col-sm-6 col-md-3">
                                        <div class="card">
                                            <div class="input-group">
                                                <select class="form-control input-lg lst2" id="staff_id1" name="staff_id1"><option value=""></option>
                                                </select>
                                            </div>
                                        </div>
                                    </div>
                                    <?php } ?>
                                    <div class="col-sm-6 col-md-3">
                                        <div class="card">
                                            <div class="input-group">
                                                <select class="form-control input-lg lst2" id="source_id1" name="source_id1"><option value=""></option>
                                                </select>
                                            </div>
                                        </div>
                                    </div> 
                                    <div class="col-sm-6 col-md-3">
                                        <div class="card">
                                            <div class="input-group">
                                                <select class="form-control input-lg lst2" id="packages_id1" name="packages_id1"><option value=""></option>
                                                </select>
                                            </div>
                                        </div>
                                    </div>
                                    <div class="col-sm-6 col-md-3">
                                        <div class="card">
                                            <div class="input-group">
                                                <select class="form-control input-lg lst2" id="country_id1" name="country_id1"><option value=""></option>
                                                </select>
                                            </div>
                                        </div>
                                    </div>
                                    <div class="col-sm-6 col-md-3">
                                        <div class="card">
                                            <div class="input-group">
                                                <select class="form-control input-lg lst2" id="priority_status_id1" name="priority_status_id1"><option value=""></option>
                                                </select>
                                            </div>
                                        </div>
                                    </div>
                                    <div class="col-sm-6 col-md-3">
                                        <div class="card">
                                            <div class="input-group">
                                                <select class="form-control input-lg lst2" id="stages_id1" name="stages_id1"><option value=""></option>
                                                </select>
                                            </div>
                                        </div>
                                    </div>
                                    <div class="col-sm-6 col-md-3">
                                        <div class="card">
                                            <div class="input-group">
                                                <select class="form-control input-lg lst2" id="lead_current_status1" name="lead_current_status1">
                                                      <option value="">Please Select lead status</option>
                                                      <option value="1">In take</option>
                                                      <option value="2">Qualified</option>
                                                      <option value="3">Converted to trip</option>
                                                      <option value="4">Not Qualified</option>
                                                      <option value="5">Lost</option>
                                                </select>
                                            </div>
                                        </div>
                                    </div>
                                    <div class="col-sm-6 col-md-3">
                                        <div class="card">
                                            <div class="input-group">
                                                <select class="form-control input-lg lst2" id="leads_accomodation_status1" name="leads_accomodation_status1">
                                                      <option value="">Please Select accommodation status</option>
                                                      <option value="guest_count_required">Guest Count Required</option>
                                                      <option value="accommodation_required">Accommodation Required</option>
                                                      <option value="quotation_not_created">Quotation Not Created</option>
                                                      <option value="quotation_created">Quotation Created</option>
                                                      <option value="quotation_cancelled">Cancelled / Quotation Not Created</option>
                                                </select>
                                            </div>
                                        </div>
                                    </div>
                                    <div class="col-sm-6 col-md-3">
                                        <div class="card">
                                            <div class="input-group">
                                                <input type="text" class="form-control" placeholder="Customer name" id="guest_name_filter1" name="guest_name_filter1" required>
                                            </div>
                                        </div>
                                    </div>
                                    <div class="col-sm-6 col-md-3">
                                        <div class="card">
                                            <div class="input-group">
                                                <input type="text" class="form-control" placeholder="Phone number" id="whats_number_filter1" name="whats_number_filter1" required>
                                            </div>
                                        </div>
                                    </div> 
                                    <div class="col-sm-6 col-md-3 staff-do-not-show">
                                        <div class="card">
                                            <div class="input-group">
                                                <select name="leads_createdby_userid1" id="leads_createdby_userid1" class="form-control input-lg lst2"><option value=""></option>
                                                </select>
                                            </div>
                                        </div>
                                    </div>
                                    <div class="col-sm-6 col-md-3">
                                      <div class="card">
                                          <div class="input-group">
                                            <input type="text" class="form-control" id="leads_daterange" name="daterange" placeholder="Lead Register Date Range">
                                          </div>
                                      </div>
                                  </div>
                                    <div class="col-sm-6 col-md-3">
                                      <div class="card">
                                          <div class="input-group">
                                            <input type="text" class="form-control" id="travel_daterange" name="daterange" placeholder="Travel Date Range">
                                          </div>
                                      </div>
                                  </div>
                                    <div class="col-sm-2 col-md-3">
                                        <div class="card">
                                            <button type="button" class="btn btn-warning btn-md" id="search1">
                                                <span class="btn-label">
                                                    <i class="fas fa-search"></i>
                                                </span>
                                                Search
                                            </button>
                                        </div>
                                    </div>
                                    <div class="col-sm-2 col-md-3">
                                        <div class="card">
                                            <button type="button" class="btn btn-secondary btn-md" id="refresh1">
                                                <span class="btn-label">
                                                    <i class="icon-refresh"></i>
                                                </span>
                                                Refresh
                                            </button>
                                        </div>
                                    </div>
                                    
                                </div>
                            
                            </div>
                        </div>
                      </form>
                    <div class="table-responsive">
											<table class="table card-table display mb-4 shadow-hover default-table table-responsive-lg" id="B2C_Leads_table">
												<thead>
													<tr>
														<th>Sl no</th>
														<th>Lead no:</th>
														<th>Guest name</th>
														<th>Phone number</th>
														<th>Date</th>
														<th>Travel date</th>
                            <th>Duration</th>
                            <th>Assigned staff</th>
                            <th>Template</th>
                            <th>Status</th>
														<th class="text-center">Stage</th>
                            <th>Priority</th>
                            <th>Created by</th>
														<th class="bg-none">Action</th>
													</tr>
												</thead>
												<tbody>
													
												</tbody>
											</table>
										</div>	
									</div>	
									<div class="tab-pane" id="Metaleads">
                    <button type="button" id="btn2" class="btn btn-rounded btn-primary btn-md"><i class="fas fa-filter"></i> Filter</button><br><br>
										<form id="exampleValidation2" method="POST" action="" enctype="multipart/form-data">
                        <div class="card-header" id="Create2" style="display:none">
                            <div class="d-flex align-items-center">
                                <div class="row row-demo-grid hdr-filter-dd-fullwd">
                                    <div class="col-sm-6 col-md-3">
                                        <div class="card">
                                            <div class="input-group">
                                                <select class="form-control input-lg lst2" id="leads_number_filter2" name="leads_number_filter2"><option value=""></option>
                                                </select>
                                            </div>
                                        </div>
                                    </div>
                                    <?php if($this->session->userdata('user_type') == 'A') {?> 
                                    <div class="col-sm-6 col-md-3">
                                        <div class="card">
                                            <div class="input-group">
                                                <select class="form-control input-lg lst2" id="staff_id2" name="staff_id2"><option value=""></option>
                                                </select>
                                            </div>
                                        </div>
                                    </div>
                                    <?php } ?>
                                    <div class="col-sm-6 col-md-3">
                                        <div class="card">
                                            <div class="input-group">
                                                <select class="form-control input-lg lst2" id="source_id2" name="source_id2"><option value=""></option>
                                                </select>
                                            </div>
                                        </div>
                                    </div> 
                                    <div class="col-sm-6 col-md-3">
                                        <div class="card">
                                            <div class="input-group">
                                                <select class="form-control input-lg lst2" id="packages_id2" name="packages_id2"><option value=""></option>
                                                </select>
                                            </div>
                                        </div>
                                    </div>
                                    <div class="col-sm-6 col-md-3">
                                        <div class="card">
                                            <div class="input-group">
                                                <select class="form-control input-lg lst2" id="facebook_ads" name="facebook_ads"><option value=""></option>
                                                </select>
                                            </div>
                                        </div>
                                    </div>
                                    <div class="col-sm-6 col-md-3">
                                        <div class="card">
                                            <div class="input-group">
                                                <select class="form-control input-lg lst2" id="country_id2" name="country_id2"><option value=""></option>
                                                </select>
                                            </div>
                                        </div>
                                    </div>
                                    <div class="col-sm-6 col-md-3">
                                        <div class="card">
                                            <div class="input-group">
                                                <select class="form-control input-lg lst2" id="priority_status_id2" name="priority_status_id2"><option value=""></option>
                                                </select>
                                            </div>
                                        </div>
                                    </div>
                                    <div class="col-sm-6 col-md-3">
                                        <div class="card">
                                            <div class="input-group">
                                                <select class="form-control input-lg lst2" id="stages_id2" name="stages_id2"><option value=""></option>
                                                </select>
                                            </div>
                                        </div>
                                    </div>
                                    <div class="col-sm-6 col-md-3">
                                        <div class="card">
                                            <div class="input-group">
                                                <select class="form-control input-lg lst2" id="lead_current_status2" name="lead_current_status2">
                                                      <option value="">Please Select lead status</option>
                                                      <option value="1">In take</option>
                                                      <option value="2">Qualified</option>
                                                      <option value="3">Converted to trip</option>
                                                      <option value="4">Not Qualified</option>
                                                      <option value="5">Lost</option>
                                                </select>
                                            </div>
                                        </div>
                                    </div>
                                    <div class="col-sm-6 col-md-3">
                                        <div class="card">
                                            <div class="input-group">
                                                <select class="form-control input-lg lst2" id="leads_accomodation_status2" name="leads_accomodation_status2">
                                                      <option value="">Please Select accommodation status</option>
                                                      <option value="guest_count_required">Guest Count Required</option>
                                                      <option value="accommodation_required">Accommodation Required</option>
                                                      <option value="quotation_not_created">Quotation Not Created</option>
                                                      <option value="quotation_created">Quotation Created</option>
                                                      <option value="quotation_cancelled">Cancelled / Quotation Not Created</option>
                                                </select>
                                            </div>
                                        </div>
                                    </div>
                                    <div class="col-sm-6 col-md-3">
                                        <div class="card">
                                            <div class="input-group">
                                                <input type="text" class="form-control" placeholder="Customer name" id="guest_name_filter2" name="guest_name_filter2" required>
                                            </div>
                                        </div>
                                    </div>
                                    <div class="col-sm-6 col-md-3">
                                        <div class="card">
                                            <div class="input-group">
                                                <input type="text" class="form-control" placeholder="Phone number" id="whats_number_filter2" name="whats_number_filter2" required>
                                            </div>
                                        </div>
                                    </div> 
                                    <div class="col-sm-6 col-md-3 staff-do-not-show">
                                        <div class="card">
                                            <div class="input-group">
                                                <select name="leads_createdby_userid2" id="leads_createdby_userid2" class="form-control input-lg lst2"><option value=""></option>
                                                </select>
                                            </div>
                                        </div>
                                    </div>
                                    <div class="col-sm-6 col-md-3">
                                      <div class="card">
                                          <div class="input-group">
                                         
                                            <input type="text" class="form-control" id="leads_daterange2" name="daterange2" placeholder="Lead Register Date Range">
                                        
                                          </div>
                                      </div>
                                  </div>
                                  <div class="col-sm-6 col-md-3">
                                      <div class="card">
                                          <div class="input-group">
                                             
                                            <input type="text" class="form-control" id="travel_daterange2" name="daterange2" placeholder="Travel Date Range">
                                     
                                          </div>
                                      </div>
                                  </div>
                                    <div class="col-sm-2 col-md-3">
                                        <div class="card">
                                            <button type="button" class="btn btn-warning btn-md" id="search2">
                                                <span class="btn-label">
                                                    <i class="fas fa-search"></i>
                                                </span>
                                                Search
                                            </button>
                                        </div>
                                    </div>
                                    <div class="col-sm-2 col-md-3">
                                        <div class="card">
                                            <button type="button" class="btn btn-secondary btn-md" id="refresh2">
                                                <span class="btn-label">
                                                    <i class="icon-refresh"></i>
                                                </span>
                                                Refresh
                                            </button>
                                        </div>
                                    </div>
                                    
                                </div>
                            
                            </div>
                        </div>
                      </form>
										<div class="table-responsive">
											<table class="table card-table display mb-4 shadow-hover table-responsive-lg" id="meta_Leads_table">
												<thead>
													<tr>
														<th>Sl no</th>
														<th>Lead no:</th>
														<th>Guest name</th>
														<th>whats app number</th>
														<th>Register date</th>
														<th>Travel date</th>
                            <th>Duration</th>
                            <th>Assigned staff</th>
                            <th>Ads name</th>
                            <th>Status</th>
														<th class="text-center">Stage</th>
                            <th>Priority</th>
                            <th>Created by</th>
														<th class="bg-none">Action</th>
													</tr>
												</thead>
												<tbody>
													
												</tbody>
											</table>
										</div>	
									</div>
									<div class="tab-pane" id="B2Bleads">
										<button type="button" id="btn3" class="btn btn-rounded btn-primary btn-md"><i class="fas fa-filter"></i> Filter</button><br><br>
										<?php if (has_permission('LEADS_CREATE')): ?>                                
                                <a onclick="add_b2bleads()"  data-bs-target="#LeadsB2BModal" class="btn btn-rounded btn-secondary btn-md">+ New B2B Lead</a> 	
                        <?php endif; ?>                    
                    <form id="exampleValidation3" method="POST" action="" enctype="multipart/form-data">
                      <div class="card-header" id="Create3" style="display:none">
                          <div class="d-flex align-items-center">
                              <div class="row row-demo-grid hdr-filter-dd-fullwd">
                                  <div class="col-sm-6 col-md-3">
                                      <div class="card">
                                          <div class="input-group">
                                              <select data-validation="required"  data-pms-required="true" class="form-control input-lg" id="quotation_number_filter" name="quotation_number_filter" required>  
              
                                                      <option value="">Please Select Quotation number</option>
                                                      <?php

                                                      foreach($quotation as $row)
                                                      {
                                                          
                                                          echo '<option value="'.$row->quotation_id.'" '.$sel.'>'.$row->quotation_number.'</option>';

                                                      }

                                                      ?>
                                              </select>
                                          </div>
                                      </div>
                                  </div>  
                                  <div class="col-sm-6 col-md-3">
                                      <div class="card">
                                          <div class="input-group">
                                              <select data-validation="required"  data-pms-required="true" class="form-control input-lg " id="package_id_filter" name="package_id_filter"  required>  
              
                                                      <option value="">Please Select template</option>

                                                      <?php foreach($packages as $row) {
                                                              // $sel = ($records->state==$row->state_id)?'selected':'';
                                                              echo '<option value="'.$row->packages_id.'">'.$row->packages_title.'</option>';
                                                          } ?>
                                              </select>
                                          </div>
                                      </div>
                                  </div>
                                  <div class="col-sm-6 col-md-3">
                                      <div class="card">
                                          <div class="input-group">
                                              <select data-validation="required"  data-pms-required="true" class="form-control input-lg " id="leads_id_filter" name="leads_id_filter"  required>  
              
                                                      <option value="">Please Select lead</option>

                                                      <?php foreach($leads as $row) {
                                                              // $sel = ($records->state==$row->state_id)?'selected':'';
                                                              echo '<option value="'.$row->leads_id.'">'.$row->leads_number.'</option>';
                                                          } ?>
                                              </select>
                                          </div>
                                      </div>
                                  </div>
                                  <div class="col-sm-6 col-md-3">
                                      <div class="card">
                                          <div class="input-group">
                                              <select data-validation="required"  data-pms-required="true" class="form-control input-lg " id="quotation_current_status_filter" name="quotation_current_status_filter"  required>  
              
                                                      <option value="">Please Select status</option>
                                                      <option value="1">Generated</option>
                                                      <option value="2">Draft</option>
                                                      <option value="3">Sent</option>
                                                      <option value="4">Rejected</option>
                                                      <option value="5">Accepted</option>

                                                      
                                              </select>
                                          </div>
                                      </div>
                                  </div>
                                  <div class="col-sm-6 col-md-3">
                                      <div class="card">
                                          <div class="input-group">
                                              <input type="text" class="form-control" placeholder="Arriving destination" id="arriving_destination_filter" name="arriving_destination_filter" required>
                                          </div>
                                      </div>
                                  </div>
                                  <div class="col-sm-6 col-md-3">
                                      <div class="card">
                                          <div class="input-group">
                                              <input type="text" class="form-control" placeholder="Departuring destination" id="departuring_destination_filter" name="departuring_destination_filter" required>
                                          </div>
                                      </div>
                                  </div> 
                                  <div class="col-sm-6 col-md-3">
                                    <div class="card">
                                        <div class="input-group">
                                            <!-- <input type="text" class="form-control" placeholder="Start date" id="start_date" name="start_date" required> -->
                                        </div>
                                    </div>
                                </div>
                                <div class="col-sm-6 col-md-3">
                                    <div class="card">
                                        <div class="input-group">
                                            <!-- <input type="text" class="form-control" placeholder="End date" id="end_date" name="end_date" required> -->
                                        </div>
                                    </div>
                                </div>                         
                                  <div class="col-sm-6 col-md-3 staff-do-not-show">
                                      <div class="card">
                                          <div class="input-group">
                                              <select name="quotation_created_by_userid" id="quotation_created_by_userid" class="form-control input-lg " required>                                     
                                                  <option value="">Please Select Created by</option>                            
                                                  <?php foreach($users as $row) {
                                                          // $sel = ($records->state==$row->state_id)?'selected':'';
                                                          echo '<option value="'.$row->user_id.'">'.$row->admin_name.'</option>';
                                                      } ?>
                                              </select>
                                          </div>
                                      </div>
                                  </div>
                                  <div class="col-sm-2 col-md-3">
                                      <div class="card">
                                          <button type="button" class="btn btn-warning btn-md" id="search3">
                                              <span class="btn-label">
                                                  <i class="fas fa-search"></i>
                                              </span>
                                              Search
                                          </button>
                                      </div>
                                  </div>
                                  <div class="col-sm-2 col-md-3">
                                      <div class="card">
                                          <a href="<?php echo base_url();?>index.php/Leads">
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
                    <div class="table-responsive">
											<table class="table card-table display mb-4 shadow-hover table-responsive-lg" id="B2B_table">
												<thead>
													<tr>
														<th>Sl no</th>
														<th>Agent</th>
														<th>Total package cost</th>
														<th>Expense</th>
														<th>Margin</th>
														<th>Description</th>
                            <th>Created By</th>
														<th class="bg-none">Action</th>
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
			</div>
		</div>
		<!--**********************************
			Content body end
		***********************************-->

    <style>
/* Red border with exclamation for invalid */
.select2-container--default.is-invalid .select2-selection {
    border-color: #dc3545 !important;
    box-shadow: 0 0 0 0.2rem rgba(220,53,69,.25);
    position: relative;
}
.select2-container--default.is-invalid .select2-selection::after {
    content: "!";
    color: #dc3545;
    font-weight: bold;
    position: absolute;
    right: 10px;
    top: 50%;
    transform: translateY(-50%);
}

/* Green border with tick for valid */
.select2-container--default.is-valid .select2-selection {
    border-color: #28a745 !important;
    box-shadow: 0 0 0 0.2rem rgba(40,167,69,.25);
    position: relative;
}
.select2-container--default.is-valid .select2-selection::after {
    content: "✔";
    color: #28a745;
    font-weight: bold;
    position: absolute;
    right: 10px;
    top: 50%;
    transform: translateY(-50%);
}

</style>
    <div class="modal fade" id="LeadsModal" tabindex="-1" aria-labelledby="AddPriorityModalLabel" aria-hidden="true" data-bs-backdrop="static" data-bs-keyboard="false">
        <div class="modal-dialog modal-lg modal-lead" role="document">
            <div class="modal-content">
                <div class="modal-header">
                    <h5 class="modal-title"></h5>
                    <button type="button" class="btn-close" onclick="Leadsmodalclose()" data-bs-dismiss="modal">
                    </button>
                </div>
                <div class="modal-body">
                    <form class="needs-validation" action="#" id="form" novalidate>
                        <input type="hidden" value="" name="id" id="id"/>
                        <div class="row">
                          <div class="col-md-3">
                              <div class=" form-group">
                                    <label class="col-lg-4 col-form-label" for="transporter_name">Lead type <span class="text-danger">*</span>
                                    </label><br>
                                        <label class="col-lg-4 col-form-label" name="lead_type_txt"></label>
                                        <input type="hidden" name="lead_type" value=""/>
                                        <!-- <select name="lead_type" id="lead_type1" class="form-control input-lg lst-flt-select2-form" required>                                                                 
                                            <option value="B2C">B2C</option>
                                            <option value="B2B">B2B</option>
                                        </select> -->
                                        <span class="help-block" style="color:red"></span>
                              </div>
                          </div>

                            <div class="col-md-3 staff_id_fk1">
                                  <div class=" form-group">
                                      <label class="col-lg-5 col-form-label" for="transporter_address">Assigned to staff  <span class="text-danger">*</span>
                                      </label>
                                          <?php if($this->session->userdata('user_type') == 'A'){ ?>
                                          <select name="staff_id_fk" id="staff_id_fk1" class="form-control input-lg lst-flt-select2-form" required>
                                              <option value=""></option>
                                          </select>
                                          <?php } else{ ?>
                                              <br><label class="col-lg-4 col-form-label"><?php echo $this->session->userdata('admin_name'); ?></label>
                                            <input type="hidden" name="staff_id_fk" value="<?php echo $this->session->userdata('user_id'); ?>"/>
                                          <?php } ?>
                                      
                                  </div>
                            </div>

                            <div class="col-md-3 source_id_fk">
                                <div class="form-group">
                                    <label class="col-lg-4 col-form-label" for="source_id_fk">Source <span class="text-danger">*</span>
                                    </label>
                                        <select name="source_id_fk" id="source_id_fk1" class="form-control input-lg lst-flt-select2-form" onchange="checkAddNewSource(this)" required>
                                            <option value=""></option>
                                            <option value="+">+ Add new</option>
                                        </select>
                                        <span class="help-block" style="color:red"></span>
                                </div>
                            </div>

                            <div class="col-md-3 guest_name">
                                <div class="form-group">
                                    <label class="col-lg-4 col-form-label" for="guest_name">Guest name <span class="text-danger">*</span>
                                    </label>
                                    
                                        <input type="text" class="form-control" name="guest_name" id="guest_name1" placeholder="Enter Guest name" required>
                                        <span class="help-block" style="color:red"></span>
                                </div>
                            </div>
                        </div>

                        <div class="row">
                                <div class="col-md-3 country_id_fk">        
                                    <div class="form-group">
                                        <label class="col-lg-5 col-form-label" for="transporter_contact_person_name1">Nationality <span class="text-danger">*</span>
                                        </label>
                                            <select name="country_id_fk" id="country_id_fk" class="form-control input-lg lst-flt-select2-form" required>
                                                <option value=""></option>
                                            </select>
                                            <span class="help-block" style="color:red"></span>
                                    </div>
                                </div>

                                <div class="col-md-3 priority_status_id_fk">
                                    <div class="form-group">
                                        <label class="col-lg-5 col-form-label" for="transporter_contact_person_email1">Priority status <span class="text-danger">*</span>
                                        </label>
                                            <select name="priority_status_id_fk" id="priority_status_id_fk" class="form-control input-lg lst-flt-select2-form" onchange="checkAddNewPriority(this)" required>
                                                <option value=""></option>
                                                <option value="+">+ Add new</option>
                                            </select>
                                            <span class="help-block" style="color:red"></span>
                                    </div>
                                </div>
                                
                                <div class="col-md-3 whats_number">
                                    <div class=" form-group">
                                        <label class="col-lg-6 col-form-label" for="whats_number">Whatsapp number <span class="text-danger">*</span>
                                        </label>
                                        
                                            <!-- <input type="text" class="form-control" inputmode="numeric" pattern="[0-9]+" minlength="10" maxlength="15" name="whats_number" id="whats_number" placeholder="Enter Whatsapp number" required> -->
                                             <input type="text" class="form-control" inputmode="numeric" pattern="^\+?[0-9]{10,15}$" minlength="10" maxlength="16" name="whats_number" id="whats_number" placeholder="Enter WhatsApp number" required>
                                            <span class="help-block" style="color:red"></span>
                                        
                                    </div>
                                </div>

                                <div class="col-md-3 alternative_number">
                                    <div class=" form-group">
                                        <label class="col-lg-6 col-form-label" for="alternative_number">Alternative number 
                                        </label>
                                        
                                            <input type="text" class="form-control" inputmode="numeric"  pattern="[0-9]+" minlength="10" maxlength="15" name="alternative_number" id="alternative_number" placeholder="Enter Alternative number" >
                                            <span class="help-block" style="color:red"></span>
                                        
                                    </div>
                                </div>

                                
                            </div>        
                            

                            <div class="row">
                              <div class="col-md-3 leads_email">
                                  <div class=" form-group">
                                      <label class="col-lg-6 col-form-label" for="leads_email">Email address 
                                      </label>
                                      
                                          <input type="email" class="form-control" name="leads_email" id="leads_email" placeholder="Enter Email address" >
                                          <span class="help-block" style="color:red"></span>
                                      
                                  </div>
                              </div>
                              <div class="col-md-3 leads_address">
                                  <div class=" form-group">
                                      <label class="col-lg-6 col-form-label" for="leads_address">Location 
                                      </label>
                                      
                                          <input type="text" class="form-control" name="leads_address" id="leads_address" placeholder="Enter Location" >
                                          <span class="help-block" style="color:red"></span>
                                      
                                  </div>
                              </div>
                              <div class="col-md-3 date_type">
                                  <div class="form-group">
                                      <label class="col-lg-6 col-form-label" for="transporter_contact_person_contact_num12">Date type <span class="text-danger">*</span>
                                      </label>
                                          <select name="date_type" id="date_type" class="form-control input-lg lst-flt-select2-form" required>                                     
                                              <option value="">Please Select Date type</option>                            
                                              <option value="WITH">With date</option>
                                              <option value="WITHOUT">Without date</option>
                                          </select>
                                          <span class="help-block" style="color:red"></span>
                                  </div>
                              </div>
                              <div class="col-md-3">        
                                  <div class="form-group">
                                      <label class="col-lg-5 col-form-label" for="start_date">Travel Date <span class="text-danger">*</span>
                                      </label>
                                          <input type="text" class="form-control" name="start_date" id="start_date1" placeholder="Enter Travel Date" required>
                                          <span class="help-block" style="color:red"></span>
                                  </div>
                              </div>

                              <div class="col-md-3">
                                  <div class="form-group">
                                      <label class="col-lg-5 col-form-label" for="duration">Tour Duration 
                                      </label>
                                          <input type="number" class="form-control" name="duration" id="duration" placeholder="Enter Tour Duration" >
                                          <span class="help-block" style="color:red"></span>
                                          <input type="hidden" class="form-control" name="end_date" id="end_date1" readonly>
                                          <!-- <span id="end_date_text">Travel end date</span> -->
                                          <span id="end_date_text" class="d-none fw-bold text-primary"></span>
                                  </div>
                              </div>

                              <div class="col-md-3 leads_package_category_id_fk">
                                    <div class="form-group">
                                        <label class="col-lg-6 col-form-label" for="leads_package_category_id_fk">Template Category 
                                        </label>
                                            <select name="leads_package_category_id_fk" id="leads_package_category_id_fk" class="form-control input-lg lst-flt-select2-form">
                                                <option value=""></option>
                                            </select>
                                            <span class="help-block" style="color:red"></span>
                                    </div>
                              </div>

                              <div class="col-md-3 package_created_by_staff_id">
                                    <div class="form-group">
                                        <label class="col-lg-8 col-form-label" for="package_created_by_staff_id">Template Created by staff 
                                        </label>
                                            <select name="package_created_by_staff_id" id="package_created_by_staff_id" class="form-control input-lg lst-flt-select2-form">
                                                <option value=""></option>
                                            </select>
                                            <span class="help-block" style="color:red"></span>
                                    </div>
                              </div>

                              <div class="col-md-3">
                                  <div class="form-group">
                                      <label class="col-lg-6 col-form-label" for="transporter_contact_person_contact_num2">Templates 
                                      </label>
                                          <select name="package_id_fk" id="package_id_fk" class="form-control input-lg lst-flt-select2-form" required>                                     
                                              <option value="">Please Select Template</option>                            
                                              <?php foreach($packages as $row) {
                                                  // $sel = ($records->state==$row->state_id)?'selected':'';
                                                  echo '<option value="'.$row->packages_id.'">'.$row->packages_title.'</option>';
                                              } ?>
                                          </select>
                                          <span class="help-block" style="color:red"></span>
                                          <small id="package_msg" class="text-danger d-none">
                                              No template available for selected duration.
                                          </small>
                                          <small id="package_properties_msg" class="text-danger d-none"></small>
                                          <small id="package_change_msg" class="text-danger d-none"></small>

                                  </div>
                              </div>

                              

                              <div class="col-md-3">
                                  <div class="form-group">
                                      <label class="col-lg-6 col-form-label" for="transporter_contact_person_contact_num22">Description
                                      </label>
                                          <textarea class="form-control" name="description" id="description"  rows="5" placeholder="Enter Description" ></textarea>
                                          <span class="help-block" style="color:red"></span>
                                  </div>
                              </div>
                            </div>                                           
                            

                        </form>
                    </div>
                    <div class="modal-footer">
                        <button type="button" class="btn btn-danger light" onclick="Leadsmodalclose()" data-bs-dismiss="modal">Close</button>
                        <button type="button" class="btn btn-primary" id="btnSave" onclick="save()" >Save</button>
                    </div>
                </div>
            </div>
        </div>

        <div class="modal fade" id="LeadsB2BModal" tabindex="-1" aria-labelledby="AddPriorityModalLabel" aria-hidden="true" data-bs-backdrop="static" data-bs-keyboard="false">
        <div class="modal-dialog modal-lg modal-lead" role="document">
            <div class="modal-content">
                <div class="modal-header">
                    <h5 class="modal-title"></h5>
                    <button type="button" class="btn-close" onclick="Leadsb2bmodalclose()" data-bs-dismiss="modal">
                    </button>
                </div>
                <div class="modal-body">
                    <form class="needs-validation" action="#" id="form3" novalidate>
                        <input type="hidden" value="" name="id" id="id3"/>
                        <div class="row">
                          <div class="col-md-3">
                              <div class=" form-group">
                                    <label class="col-lg-4 col-form-label" for="transporter_name">Lead type <span class="text-danger">*</span>
                                    </label><br>
                                        <label class="col-lg-4 col-form-label" name="lead_type_txt_b2b"></label>
                                        <input type="hidden" name="lead_type_b2b" value=""/>
                                        <!-- <select name="lead_type" id="lead_type1" class="form-control input-lg lst-flt-select2-form" required>                                                                 
                                            <option value="B2C">B2C</option>
                                            <option value="B2B">B2B</option>
                                        </select> -->
                                        <span class="help-block" style="color:red"></span>
                              </div>
                          </div>
                          
                          <div class="col-md-3">
                            <div class=" form-group">
                                <label class="col-lg-4 col-form-label" for="transporter_name">Select agent <span class="text-danger">*</span>
                                </label>
                                
                                    <select name="agent_id_fk" id="agent_id_fk" class="form-control input-lg lst-flt-select2-form" required>                                                                 
                                        <option value="">Please Select agent</option>
                                        <!-- <option value="+">+ Add new</option> -->
                                        <?php foreach($b2b_partner as $row) {
                                            // $sel = ($records->state==$row->state_id)?'selected':'';
                                            echo '<option value="'.$row->b2b_partner_id.'">'.$row->b2b_partner_agent_name.'</option>';
                                        } ?>
                                    </select>
                                    <span class="help-block" style="color:red"></span>
                                
                            </div>
                          </div>

                            <div class="col-md-3 total_package_cost">
                                    <div class=" form-group">
                                        <label class="col-lg-6 col-form-label" for="transporter_name">Total package cost <span class="text-danger">*</span>
                                        </label>
                                        
                                            <input type="number" class="form-control" name="total_package_cost" id="total_package_cost" placeholder="Enter total package cost" required>
                                            <span class="help-block" style="color:red"></span>
                                        
                                    </div>
                            </div>

                            <div class="col-md-3 expense">
                                <div class=" form-group">
                                    <label class="col-lg-4 col-form-label" for="transporter_name">Expense <span class="text-danger">*</span>
                                    </label>
                                    
                                        <input type="number" class="form-control" name="expense" id="expense" placeholder="Enter Expense" required>
                                        <span class="help-block" style="color:red"></span>
                                    
                                </div>
                            </div>
                        </div>

                        <div class="row">  
                          <div class="col-md-3 margin">
                            <div class=" form-group">
                                <label class="col-lg-4 col-form-label" for="transporter_name">Margin <span class="text-danger">*</span>
                                </label>
                                
                                    <input type="number" class="form-control" name="margin" id="margin" placeholder="Enter Margin" required>
                                    <span class="help-block" style="color:red"></span>
                                
                            </div>  
                          </div>  
                          <div class="col-md-3">
                              <div class="form-group">
                                  <label class="col-lg-6 col-form-label" for="transporter_contact_person_contact_num22">Description
                                  </label>
                                      <textarea class="form-control" name="description" id="description"  rows="5" placeholder="Enter Description" ></textarea>
                                      <span class="help-block" style="color:red"></span>
                              </div>
                          </div>                
                        </div>                                    
                            

                        </form>
                    </div>
                    <div class="modal-footer">
                        <button type="button" class="btn btn-danger light" onclick="Leadsb2bmodalclose()" data-bs-dismiss="modal">Close</button>
                        <button type="button" class="btn btn-primary" id="btnSave3" onclick="save_b2b()" >Save</button>
                    </div>
                </div>
            </div>
        </div>

        <!-- Add Source Modal -->
<div class="modal fade" id="AddSourceModal" tabindex="-1" aria-labelledby="AddSourceModalLabel" aria-hidden="true" data-bs-backdrop="static" data-bs-keyboard="false">
    <div class="modal-dialog">
        <div class="modal-content">
            <div class="modal-header">
                <h5 class="modal-title1">Add New Source</h5>
                <button type="button" class="btn-close" data-bs-dismiss="modal"></button>
            </div>
            <div class="modal-body">
                <form id="addSourceForm">
                    <div class="mb-3">
                        <label for="source_name_modal" class="form-label">Source Name <span class="text-danger">*</span></label>
                        <input type="text" class="form-control" id="source_name_modal" name="source_name" placeholder="Enter Source Name" required>
                        <div class="invalid-feedback">Source name is required.</div>
                    </div>
                </form>
            </div>
            <div class="modal-footer">
                <button type="button" class="btn btn-secondary" data-bs-dismiss="modal">Close</button>
                <button type="button" class="btn btn-primary" onclick="saveSource()">Save</button>
            </div>
        </div>
    </div>
</div>

<!-- Add Priority Status Modal -->
<div class="modal fade" id="AddPriorityModal" tabindex="-1" aria-labelledby="AddPriorityModalLabel" aria-hidden="true" data-bs-backdrop="static" data-bs-keyboard="false">
    <div class="modal-dialog">
        <div class="modal-content">
            <div class="modal-header">
                <h5 class="modal-title1">Add New Priority Status</h5>
                <button type="button" class="btn-close" data-bs-dismiss="modal"></button>
            </div>
            <div class="modal-body">
                <form id="addPriorityForm">
                    <div class="mb-3">
                        <label for="priority_name_modal" class="form-label">Priority Name <span class="text-danger">*</span></label>
                        <input type="text" class="form-control" id="priority_name_modal" name="priority_status_name" placeholder="Enter Priority Name" required>
                        <div class="invalid-feedback">Priority name is required.</div>
                    </div>

                    <div class="mb-3">
                        <label for="priority_color_modal" class="form-label">Button Color <span class="text-danger">*</span></label>
                        <input type="color" class="form-control form-control-color" id="priority_color_modal" name="priority_color" value="#ff0000" title="Choose your color" required>
                        <div class="invalid-feedback">Please select a color.</div>
                    </div>

                    <div class="mb-3">
                        <label for="priority_description_modal" class="form-label">Description</label>
                        <textarea class="form-control" id="priority_description_modal" name="priority_status_description" rows="3" placeholder="Enter description"></textarea>
                    </div>

                </form>
            </div>
            <div class="modal-footer">
                <button type="button" class="btn btn-secondary" data-bs-dismiss="modal">Close</button>
                <button type="button" class="btn btn-primary" onclick="savePriorityStatus()">Save</button>
            </div>
        </div>
    </div>
</div>
<style>
#AddStageModal {
    z-index: 1065; /* higher than default 1055 */
}

#ChangeStatusModal {
    z-index: 1055;
}

</style>
<!-- Add Stage Modal -->
<div class="modal fade" id="AddStageModal" tabindex="-1" aria-labelledby="AddStageModalLabel" aria-hidden="true" data-bs-backdrop="static" data-bs-keyboard="false">
    <div class="modal-dialog">
        <div class="modal-content">
            <div class="modal-header">
                <h5 class="modal-title1">Add New Stage</h5>
                <button type="button" class="btn-close" data-bs-dismiss="modal"></button>
            </div>
            <div class="modal-body">
                <form id="addStageForm">
                    <div class="mb-3">
                        <label for="stage_name_modal" class="form-label">Stage Name <span class="text-danger">*</span></label>
                        <input type="text" class="form-control" id="stage_name_modal" name="stages_name" placeholder="Enter Stage Name" required>
                        <div class="invalid-feedback">Stage name is required.</div>
                    </div>

                    <div class="mb-3">
                        <label for="stage_color_modal" class="form-label">Button Color <span class="text-danger">*</span></label>
                        <input type="color" class="form-control form-control-color" id="stage_color_modal" name="stage_color" value="#007bff" title="Choose your color" required>
                        <div class="invalid-feedback">Please select a color.</div>
                    </div>

                    <div class="mb-3">
                        <label for="stage_description_modal" class="form-label">Description</label>
                        <textarea class="form-control" id="stage_description_modal" name="stages_description" rows="3" placeholder="Enter description"></textarea>
                    </div>

                </form>
            </div>
            <div class="modal-footer">
                <button type="button" class="btn btn-secondary" data-bs-dismiss="modal">Close</button>
                <button type="button" class="btn btn-primary" onclick="saveStagelisting()">Save</button>
            </div>
        </div>
    </div>
</div>

<div class="modal fade" id="ChangeStatusModal" tabindex="-1" data-bs-backdrop="static">
    <div class="modal-dialog">
        <div class="modal-content">

            <div class="modal-header">
                <h5 class="modal-title2">Change Lead Stage</h5>
                <button type="button" class="btn-close" data-bs-dismiss="modal"></button>
            </div>

            <div class="modal-body">
                <form id="changeStatusForm">
                    <input type="hidden" id="lead_id" name="lead_id">
                    <input type="hidden" id="prev_stage_id" name="prev_stage_id">
                    <input type="hidden" id="lead_type_stutus" name="lead_type_stutus">

                    <div class="mb-3">
                        <label class="form-label">Stage <span class="text-danger">*</span></label>
                        <select class="form-control select2" id="stage_id" name="stage_id" onchange="checkAddNewStage(this)" required>
                            <option value="">Select Stage</option>
                        </select>
                    </div>

                    <div class="mb-3">
                        <label class="form-label">Description</label>
                        <textarea class="form-control" name="description" rows="3"></textarea>
                    </div>
                </form>
            </div>

            <div class="modal-footer">
                <button class="btn btn-secondary" data-bs-dismiss="modal">Close</button>
                <button type="button" class="btn btn-primary" onclick="saveChangeStatus()">Save</button>
            </div>

        </div>
    </div>
</div>

<div class="modal fade" id="ChangeStatus1Modal" tabindex="-1" data-bs-backdrop="static">
    <div class="modal-dialog">
        <div class="modal-content">

            <div class="modal-header">
                <h5 class="modal-title2">Change Lead Status</h5>
                <button type="button" class="btn-close" data-bs-dismiss="modal"></button>
            </div>

            <div class="modal-body">
                <form id="changeStatusForm1">
                    <input type="hidden" id="lead_id1" name="lead_id">
                    <input type="hidden" id="prev_status" name="prev_status">
                    <input type="hidden" id="lead_type_stutus1" name="lead_type_stutus1">

                    <div class="mb-3">
                        <label class="form-label">Status <span class="text-danger">*</span></label>
                        <select class="form-control select2" id="status" name="status" required>
                            <option value="">Select Status</option>
                        </select>
                    </div>

                    <div class="mb-3">
                        <label class="form-label">Description</label>
                        <textarea class="form-control" name="description" rows="3"></textarea>
                    </div>
                </form>
            </div>

            <div class="modal-footer">
                <button class="btn btn-secondary" data-bs-dismiss="modal">Close</button>
                <button type="button" class="btn btn-primary" onclick="saveChangeStatus1()">Save</button>
            </div>

        </div>
    </div>
</div>

<!-- Leads details Modal -->


<div class="modal fade" id="LeadsviewModal" tabindex="-1" aria-labelledby="LeadsViewLabel" aria-hidden="true">
  <div class="modal-dialog modal-xl modal-dialog-scrollable Leadsview">
    <div class="modal-content lead-view-modal">

      <div class="modal-header lead-view-header">
        <h5 class="modal-title3" id="LeadsViewLabel">Lead Details</h5>
        <button type="button" class="btn-close btn-close-white" data-bs-dismiss="modal"></button>
      </div>

      <div class="modal-body">

  <ul class="nav nav-tabs mb-3" id="leadViewTabs" role="tablist">
    <li class="nav-item">
      <button class="nav-link active" data-bs-toggle="tab" data-bs-target="#leadDetailsTab" type="button">
        Lead Details
      </button>
    </li>
    <li class="nav-item">
      <button class="nav-link" data-bs-toggle="tab" data-bs-target="#guestAccommodationTab" type="button">
        Guest Count & Accommodation
      </button>
    </li>
  </ul>

  <div class="tab-content">
    <div class="tab-pane fade show active" id="leadDetailsTab">
      <div id="leadViewBody">
        <div class="text-center py-5">
          <div class="spinner-border text-primary"></div>
          <p class="mt-2 mb-0">Loading lead details...</p>
        </div>
      </div>
    </div>

    <div class="tab-pane fade" id="guestAccommodationTab">
      <div id="guestAccommodationBody">
        <div class="text-center py-5">
          <div class="spinner-border text-primary"></div>
          <p class="mt-2 mb-0">Loading guest and accommodation details...</p>
        </div>
      </div>
    </div>
  </div>

</div>

      <div class="modal-footer bg-light">
        <button class="btn btn-secondary" data-bs-dismiss="modal">Close</button>
      </div>

    </div>
  </div>
</div>


<!-- Status History Modal -->
<div class="modal fade" id="StatusHistoryModal" tabindex="-1" aria-labelledby="StatusHistoryLabel" aria-hidden="true">
  <div class="modal-dialog modal-lg modal-lead modal-dialog-scrollable">
    <div class="modal-content">

      <div class="modal-header">
        <h5 class="modal-title" id="StageHistoryLabel">Lead Status History</h5>
        <button type="button" class="btn-close" data-bs-dismiss="modal"></button>
      </div>

      <div class="modal-body">
        <table class="table table-striped table-bordered" id="statusHistoryTable">
          <thead>
            <tr>
              <th>Sl. No</th>
              <th>Current Status</th>
              <th>Previous Status</th>
              <th>Description</th>
              <th>Updated By</th>
              <th>Updated On</th>
              <th>Updated Time</th>
            </tr>
          </thead>
          <tbody></tbody>
        </table>
      </div>

      <div class="modal-footer">
        <button class="btn btn-secondary" data-bs-dismiss="modal">Close</button>
      </div>

    </div>
  </div>
</div>

<!-- Stage History Modal -->
<div class="modal fade" id="StageHistoryModal" tabindex="-1" aria-labelledby="StageHistoryLabel" aria-hidden="true">
  <div class="modal-dialog modal-lg modal-lead modal-dialog-scrollable">
    <div class="modal-content">

      <div class="modal-header">
        <h5 class="modal-title" id="StageHistoryLabel">Lead Stage History</h5>
        <button type="button" class="btn-close" data-bs-dismiss="modal"></button>
      </div>

      <div class="modal-body">
        <table class="table table-striped table-bordered" id="stageHistoryTable">
          <thead>
            <tr>
              <th>Sl. No</th>
              <th>Current Stage</th>
              <th>Previous Stage</th>
              <th>Description</th>
              <th>Updated By</th>
              <th>Updated On</th>
              <th>Updated Time</th>
            </tr>
          </thead>
          <tbody></tbody>
        </table>
      </div>

      <div class="modal-footer">
        <button class="btn btn-secondary" data-bs-dismiss="modal">Close</button>
      </div>

    </div>
  </div>
</div>

<!-- Guest Count Modal -->
<div class="modal fade" id="gusetcountModal" tabindex="-1" aria-labelledby="StageHistoryLabel" aria-hidden="true">
  <div class="modal-dialog modal-lg modal-lead modal-dialog-scrollable">
    <div class="modal-content">

      <div class="modal-header">
        <h5 class="modal-title">Guest Count</h5>
        <button type="button" class="btn-close" data-bs-dismiss="modal"></button>
      </div>

      <div class="modal-body">
        <form id="form2">

          <input type="hidden" id="guset_count_lead_id_fk" name="guset_count_lead_id_fk"/>
          <input type="hidden" id="guset_count_package_id_fk" name="guset_count_package_id_fk"/>
          <input type="hidden" id="guset_count_id" name="guset_count_id">
          <input type="hidden" id="lead_type_count" name="lead_type_count"/>


          <!-- Guest type -->
          <div class="mb-3">
            <label class="fw-bold">Guest count type</label><br>
            <input type="radio" name="guest_type" id="ds" value="S" checked>
            <label for="ds">Same guest count</label>

            <input type="radio" name="guest_type" id="df" value="D" class="ms-3">
            <label for="df">Different guest count</label>
          </div>

          <!-- Pax Table -->
          <table class="table table-bordered" id="GuestTableCount">
            <thead class="table-dark">
              <tr>
                <th>Pax Plan</th>
                <th>Adults</th>
                <th>Children</th>
                <th>Total</th>
              </tr>
            </thead>
            <tbody></tbody>
          </table>

          <!-- ADD PLAN -->
          <button type="button" id="addInclusionBtn_count" class="btn btn-outline-primary btn-sm">
            <i class="bi bi-plus-circle"></i> Add Pax Plan
          </button>

        </form>
      </div>

      <div class="modal-footer">
        <button class="btn btn-secondary" data-bs-dismiss="modal">Close</button>
        <!-- 🔴 IMPORTANT: UNIQUE ID -->
        <button class="btn btn-primary" id="btnSaveGuest">Save</button>
      </div>

    </div>
  </div>
</div>

<!-- Accomodation Plan Modal -->
<div class="modal fade" id="accomodation_planModal" tabindex="-1" aria-labelledby="AddPriorityModalLabel" aria-hidden="true" data-bs-backdrop="static" data-bs-keyboard="false">
<!-- <div class="modal fade" id="accomodation_planModal" tabindex="-1"> -->
  <div class="modal-dialog modal-lg modal-lead">
    <div class="modal-content">

      <div class="modal-header">
        <h5 class="modal-title"> Accomodation Plan </h5>
        <button type="button" class="btn-close" data-bs-dismiss="modal"></button>
      </div>

      <div class="modal-body">
        <form id="form4">

          <input type="hidden" id="lead_id_fk" name="lead_id_fk"/>
          <input type="hidden" id="pacakage_id_fk" name="pacakage_id_fk"/>
          <input type="hidden" id="accommodation_plan_guset_count_id_fk" name="accommodation_plan_guset_count_id_fk"/>
          <input type="hidden" id="lead_type_accomodation" name="lead_type_accomodation"/>
         <div class="row">
            <div class="col-12">

              <div class="table-responsive">
                <table class="table table-bordered align-middle text-center">
                  <thead class="table-light">
                    <tr>
                      <th>Day</th>
                      <th>Accommodation Status</th>
                      <th>Stay Destination</th>
                      <th>Meal Plan</th>
                      <th>Pax Count Plan</th>
                    </tr>
                  </thead>

                  <tbody id="accommodationTableBody">
                    <tr>
                      <!-- Day -->
                      <td>
                        <input type="text" class="form-control" name="day[]" value="Day 1" readonly>
                      </td>

                      <!-- Accommodation Status -->
                      <td>
                        <select name="accommodation_status[]" class="form-control lst-flt-select2" required>
                          <option value="">Select</option>
                          <option value="R">Required</option>
                          <option value="N">Not Required</option>
                        </select>
                      </td>

                      <!-- Stay Destination -->
                      <td>
                        <select name="stay_destination_id[]" class="form-control lst-flt-select2" required>
                          <option value="">Select Destination</option>
                        </select>
                      </td>

                      <!-- Meal Plan -->
                      <td>
                        <select name="meal_plan_id[]" class="form-control lst-flt-select2" required>
                          <option value="">Select Meal Plan</option>
                        </select>
                      </td>

                      <!-- Pax Count Plan -->
                      <td>
                        <select name="pax_count_plan_id[]" class="form-control lst-flt-select2" required>
                          <option value="">Select Pax Plan</option>
                        </select>
                      </td>
                    </tr>
                  </tbody>
                </table>
              </div>

            </div>
          </div>


        </form>
      </div>

      <div class="modal-footer">
        <button class="btn btn-secondary" data-bs-dismiss="modal">Close</button>
        <!-- 🔴 IMPORTANT: UNIQUE ID -->
        <button class="btn btn-primary" id="btnSaveaccplan">Save</button>
      </div>

    </div>
  </div>
</div>

<!-- Quotation Modal -->
        <div class="modal fade" id="QuotationModal" tabindex="-1" aria-labelledby="AddPriorityModalLabel" aria-hidden="true" data-bs-backdrop="static" data-bs-keyboard="false"> 
        <!-- <div class="modal fade" id="QuotationModal" role="dialog" data-backdrop="static"  data-keyboard="false"> -->
            <div class="modal-dialog modal-lg modal-quote" role="document">
                <div class="modal-content">
                    <div class="modal-header">
                        <h3 class="modal-title modal-title-quote"></h5>
                        <button type="button" class="btn-close" onclick="Quotationmodalclose()" data-bs-dismiss="modal">
                        </button>
                    </div>
                    <div class="modal-body">
                        
                        <form class="needs-validation" action="#" id="form5" >
                            <input type="hidden" value="" name="id" id="id"/> 
                            <input type="hidden" id="selected_lead_id" value="">
                            <input type="hidden" name="leads_id" id="leads_id_hidden">
                            <input type="hidden" name="packages_id_fk" id="packages_id_hidden">

                            <div class="row">
                                <div class="col-md-3">
                                    <div class=" form-group">
                                        <label class="col-lg-7 col-form-label" for="quotation_date"><b>Date</b> <span class="text-danger">*</span>
                                        </label>
                                        
                                            <input type="text" class="form-control" name="quotation_date" id="quotation_date" placeholder="Enter Date" required>
                                            <span class="help-block" style="color:red"></span>
                                        
                                    </div>
                                </div>
                                <div class="col-md-3">
                                    <div class="form-group">
                                        <label class="col-lg-9 col-form-label" for="arriving_destination"><b>Arriving destination</b> <span class="text-danger">*</span>
                                        </label>
                                            <input type="text" class="form-control" name="arriving_destination" id="arriving_destination" placeholder="Enter Arriving destination" required>
                                            <span class="help-block" style="color:red"></span>
                                    </div>
                                </div>

                                <div class="col-md-3">
                                    <div class="form-group">
                                        <label class="col-lg-9 col-form-label" for="departuring_destination"><b>Departuring destination</b> <span class="text-danger">*</span>
                                        </label>
                                            <input type="text" class="form-control" name="departuring_destination" id="departuring_destination" placeholder="Enter Departuring destination" required>
                                            <span class="help-block" style="color:red"></span>
                                    </div>
                                </div>

                                <div class="col-md-3">
                                    <div class="form-group">
                                        <label class="col-lg-7 col-form-label" for="quotation_remarks"><b>Remarks</b> 
                                        </label>
                                            <textarea id="quotation_remarks" name="quotation_remarks" class="form-control"></textarea>
                                            <span class="help-block" style="color:red"></span>
                                    </div>
                                </div>
                                        
                            </div>
                            <div class="row d-none" >
                                
                                <div class="col-md-3 packages_id_fk">
                                    <div class=" form-group">
                                        <label class="col-lg-5 col-form-label" for="leads">Template  <span class="text-danger">*</span>
                                        </label>
                                        
                                            <select id="packages_id_fk" class="form-control input-lg lst-flt-select2" required>                                     
                                                <option value="">Please Select Template</option>
                                                
                                            </select>
                                        
                                    </div>
                                </div>
                            </div>
                            
                            <!-- <div id="optionsContainer"></div>

                            <button class="btn btn-primary" id="addOptionBtn" disabled>
                                <i class="bi bi-plus-circle"></i> Add New Option
                            </button> -->
                                                
                            <!-- OPTIONS -->
                            <div id="optionsContainer"></div>

                            <button type="button" class="btn btn-primary mt-2" id="addOptionBtn">
                              + Add New Option
                            </button>

                            <div class="optionBlockContainer"></div>
                            
                            <!-- ================= PROPERTY BASED INCLUSIONS ================= -->
                            <div class="mt-5 inclusion-section">

                              <div class="d-flex align-items-center mb-2">
                                <div class="form-check">
                                  <input class="form-check-input"
                                        type="checkbox"
                                        name="quotation_property_inclusion_type"
                                        id="quotation_property_inclusion_type"
                                        value="1">
                                        <label class="form-check-label fw-bold" for="quotation_property_inclusion_type">
                                          Add Property Based Inclusions
                                        </label>
                                </div>
                              </div>

                              <!-- ✅ Wrap the whole box inside this container -->
                              <!-- <div class="p-4" id="inclusionBox" style="background-color:#f2f2f2; display:none;">

                                <h4 class="fw-bold mb-4 text-primary">Add Property Based Inclusions</h4>

                                <table class="table table-bordered table-responsive-md mb-0"
                                      id="inclusionTable"
                                      style="max-width:900px;">

                                  <thead class="table-dark">
                                    <tr>
                                      <th style="width:35%">Day | Date | Destination</th>
                                      <th style="width:30%">Inclusion Name</th>
                                      <th style="width:20%">Amount</th>
                                      <th style="width:15%" class="text-center">Action</th>
                                    </tr>
                                  </thead>

                                  <tbody>
                                    <tr>
                                      <td>
                                        <select class="form-select form-select-sm inclusionDaySelect" name="inclusion_day_key[]"></select>
                                      </td>
                                      <td>
                                        <input type="text" class="form-control form-control-sm"
                                              name="inclusion_name[]" placeholder="Inclusion name">
                                      </td>
                                      <td>
                                        <input type="number" class="form-control form-control-sm"
                                              name="inclusion_amount[]" placeholder="Amount">
                                      </td>
                                      <td class="text-center">
                                        <button class="btn btn-sm btn-danger removeInclusionBtn" disabled>
                                          <i class="bi bi-trash"></i>
                                        </button>
                                      </td>
                                    </tr>
                                  </tbody>

                                  
                                  <tfoot>
                                      <tr>
                                          <td colspan="4" class="text-center">
                                              <button class="btn btn-sm btn-success" id="addInclusionBtn">
                                                  <i class="bi bi-plus-circle"></i> Add More Inclusions
                                              </button>
                                          </td>
                                      </tr>

                                
                                      <tr class="table-light">
                                        <td colspan="2" class="text-end fw-semibold">Total Inclusion Amount</td>
                                        <td class="fw-bold">
                                          <span id="totalInclusionAmountText">0.00</span>
                                          <input type="hidden" name="total_inclusion_amount" id="totalInclusionAmountInput" value="0">
                                        </td>
                                        <td></td>
                                      </tr>
                                  </tfoot>
                                </table>

                              </div> -->

                                
                                <div class="p-4" id="inclusionBox" style="background-color:#f2f2f2; display:none;">

                                    <h4 class="fw-bold mb-4 text-primary">Add Property Based Inclusions</h4>

                                    <table class="table table-bordered table-responsive-md mb-0"
                                          id="inclusionTable"
                                          style="max-width:1100px;">

                                        <thead class="table-dark">
                                            <tr>
                                                <!-- <th style="width:28%">Template Option</th>
                                                 <th style="width:28%">Day | Date | Destination</th>
                                                <th style="width:22%">Property</th>
                                                <th style="width:25%">Inclusion Name</th>
                                                <th style="width:15%">Amount</th>
                                                <th style="width:10%" class="text-center">Action</th> -->
                                                <th style="width:25%">Template Option</th>
<th style="width:25%">Day | Date | Destination</th>
<th style="width:18%">Property</th>
<th style="width:20%">Inclusion Name</th>
<th class="amount-col">Amount</th>
<th style="width:5%">Action</th>
                                            </tr>
                                        </thead>

                                        <tbody>
                                            <tr>
                                                <td>
                                                    <select class="form-select form-select-sm inclusionPackageOptionSelect" name="package_option_id_fk[]">
                                                        <option value="">Select Template Option</option>
                                                    </select>
                                                </td>
                                                <td>
                                                    <select class="form-select form-select-sm inclusionDaySelect" name="inclusion_day_key[]">
                                                        <option value="">Select Day | Date | Destination</option>
                                                    </select>
                                                </td>
                                                <td>
                                                    <select class="form-select form-select-sm inclusionPropertySelect" name="inclusion_property_id_fk[]">
                                                        <option value="">Select Property</option>
                                                    </select>
                                                </td>
                                                <td>
                                                    <select class="form-select form-select-sm inclusionNameSelect" name="property_inclusions_id_fk[]">
                                                        <option value="">Select Inclusion</option>
                                                    </select>
                                                </td>
                                                <!-- <td>
                                                    <input type="number"
                                                          class="form-control form-control-sm inclusionAmountInput"
                                                          name="inclusion_amount[]"
                                                          placeholder="Amount">
                                                </td> -->
                                                <td class="amount-col">
                                                    <input type="number"
                                                          class="form-control form-control-sm inclusionAmountInput"
                                                          name="inclusion_amount[]"
                                                          placeholder="Amount">
                                                </td>
                                                <td class="text-center">
                                                    <button type="button" class="btn btn-sm btn-danger removeInclusionBtn" disabled>
                                                        <i class="bi bi-trash"></i>
                                                    </button>
                                                </td>
                                            </tr>
                                        </tbody>

                                        <tfoot>
                                            <tr>
                                                <td colspan="5" class="text-center">
                                                    <button type="button" class="btn btn-sm btn-success" id="addInclusionBtn">
                                                        <i class="bi bi-plus-circle"></i> Add More Inclusions
                                                    </button>
                                                </td>
                                            </tr>

                                            <tr class="table-light">
                                                <td colspan="4" class="text-end fw-semibold">Total Inclusion Amount</td>
                                                <td class="fw-bold">
                                                    <span id="totalInclusionAmountText">0.00</span>
                                                    <input type="hidden" name="total_inclusion_amount" id="totalInclusionAmountInput" value="0">
                                                </td>
                                                <td></td>
                                            </tr>
                                        </tfoot>
                                    </table>
                                </div>
                            </div>

                            <style>
                                .inclusion-section {
                                background-color: #f2f2f2;
                                padding: 24px;
                            }

                            .inclusion-section h4 {
                                font-size: 1.6rem;
                            }

                            .specialreq-section {
                                background-color: #f2f2f2;
                                padding: 24px;
                            }

                            .specialreq-section h4 {
                                font-size: 1.6rem;
                            }
/* Ensure select2 dropdown is above Bootstrap modal */
.select2-container { z-index: 1060 !important; }
.select2-dropdown { z-index: 1060 !important; }

/* Make sure search input is clickable */
.select2-search__field { pointer-events: auto !important; }

                            </style>

                            <!-- ================= SPECIAL REQUIREMENTS ================= -->
<div class="mt-4 specialreq-section">

  <div class="d-flex align-items-center mb-2">
    <div class="form-check">
      <input class="form-check-input"
             type="checkbox"
             name="quotation_special_requirement_type"
             id="quotation_special_requirement_type"
             value="1">
      <label class="form-check-label fw-bold" for="quotation_special_requirement_type">
        Special Requirements
      </label>
    </div>
  </div>

  <!-- ✅ Wrap the whole box inside this container -->
  <div class="p-4" id="specialReqBox" style="background-color:#f2f2f2; display:none;">

    <h4 class="fw-bold mb-4 text-primary">Special Requirements</h4>

    <table class="table table-bordered table-responsive-md mb-0"
           id="specialReqTable"
           style="max-width:900px;">

      <thead class="table-dark">
        <tr>
          <th style="width:35%">Day | Date | Destination</th>
          <th style="width:30%">Requirement</th>
          <th style="width:20%">Amount</th>
          <th style="width:15%" class="text-center">Action</th>
        </tr>
      </thead>

      <tbody>
        <tr>
          <td>
            <!-- <select class="form-select form-select-sm specialReqDaySelect" name="specialreq_day_key[]"></select> -->
             <select class="form-select form-select-sm specialReqDaySelect" name="specialreq_day_key[]">
                                                        <option value="">Select Day | Date | Destination</option>
                                                    </select>
          </td>
          <td>
            <select class="form-select form-select-sm specialReqSelect"
                    name="quotation_special_requirements_id_fk[]"></select>
          </td>
          <td>
            <input type="number" class="form-control form-control-sm specialReqCost"
                   name="special_requirements_cost[]" placeholder="Amount">
          </td>
          <td class="text-center">
            <button class="btn btn-sm btn-danger removeSpecialReqBtn" disabled>
              <i class="bi bi-trash"></i>
            </button>
          </td>
        </tr>
      </tbody>

      <!-- <tfoot>
        <tr>
          <td colspan="4" class="text-center">
            <button class="btn btn-sm btn-success" id="addSpecialReqBtn">
              <i class="bi bi-plus-circle"></i> Add More Requirements
            </button>
          </td>
        </tr>
      </tfoot> -->
      <tfoot>
          <tr>
              <td colspan="4" class="text-center">
                  <button class="btn btn-sm btn-success" id="addSpecialReqBtn">
                      <i class="bi bi-plus-circle"></i> Add More Requirements
                  </button>
              </td>
          </tr>

          <!-- ✅ Total row -->
          <tr class="table-light">
            <td colspan="2" class="text-end fw-semibold">Total Special Requirements Amount</td>
            <td class="fw-bold">
              <span id="totalSpecialReqAmountText">0.00</span>
              <input type="hidden" name="total_special_requirment_amount" id="totalSpecialReqAmountInput" value="0">
            </td>
            <td></td>
          </tr>
      </tfoot>
    </table>

  </div>
</div>

                            

                        </form>
                        <!-- ✅ Sticky Quote Summary (place inside QUOTATION modal-body, above footer) -->
<!-- <div id="quoteSummarySticky" class="border-top bg-white py-3"
     style="position: sticky; bottom: 0; z-index: 1050;">
  <div class="container-fluid">
    <div class="row g-2 align-items-end">

      <div class="col-md-3">
        <div class="small text-muted">Total Cost</div>
        <div class="fw-bold fs-5">
          <span id="totalCostText">0.00</span>
        </div>
        <input type="hidden" id="total_cost" name="total_cost" value="0">
        <div class="small text-muted">
          Cab + Highest Room + Inclusions + Requirements
        </div>
      </div>

      <div class="col-md-4">
        <label class="small text-muted">Margin Type</label>
        <select id="marginType" class="form-select form-select-sm">
          <option value="amount">Amount</option>
          <option value="percent">Percentage (%)</option>
        </select>
      </div>

      <div class="col-md-3">
        <label class="small text-muted">Margin Value</label>
        <input type="number" step="0.01" id="marginValue"
               class="form-control form-control-sm" placeholder="Enter amount or %">
      </div>

      <div class="col-md-2 text-md-end">
        <div class="small text-muted">Total Quote Rate</div>
        <div class="fw-bold fs-5 text-primary">
          <span id="totalQuoteText">0.00</span>
        </div>
        <input type="hidden" id="total_quote_rate" name="total_quote_rate" value="0">
      </div>

      <div class="col-12">
        <div class="d-flex flex-wrap gap-3 small text-muted mt-1">
          <div>Cab: <span id="cabCostText">0.00</span></div>
          <div>Highest Room: <span id="highestRoomText">0.00</span></div>
          <div>Inclusions: <span id="inclusionTotalText">0.00</span></div>
          <div>Special Req: <span id="specialReqTotalText">0.00</span></div>
          <div>Margin: <span id="marginAmountText">0.00</span></div>
        </div>
        <input type="hidden" id="margin_amount" name="margin_amount" value="0">
      </div>

    </div>
  </div>
</div> -->

                    </div>
                    <div class="modal-footer">
                        <button type="button" class="btn btn-danger light" onclick="Quotationmodalclose()" data-bs-dismiss="modal">Close</button>
                        <button type="button" class="btn btn-primary" id="btnSave" onclick="save_quote()" >Save</button>
                    </div>
                </div>
            </div>
        </div>


    <!-- Modal -->
<style>
  .auto-synchronize { table-layout: fixed; width: 100%; }
  .auto-synchronize th:nth-child(1) { width: 25%; }
  .auto-synchronize th:nth-child(2) { width: 37.5%; }
  .auto-synchronize th:nth-child(3) { width: 37.5%; }
</style>

<!-- ✅ Room Pricing & Guest Allocation Modal (Bootstrap 5.3.2) -->
<!-- ✅ UPDATED DESIGN: same modal structure, but fixed Sync table to:
     - show Amount next to Rate (Auto + Manual)
     - Supplement count = NA (both)
     - Total shows Auto Total + Manual Total (not single total)
     - Adds hidden inputs for saving amounts + totals later
     - Keeps your existing IDs + roles intact
-->

<div class="modal fade" id="roompricingandguestallocationModal" tabindex="-1" aria-hidden="true"
     data-bs-backdrop="static" data-bs-keyboard="false">
  <div class="modal-dialog modal-lg modal-dialog-scrollable modal-quote">
    <div class="modal-content">

      <div class="modal-header">
        <h5 class="modal-title" id="roomModalTitle">Room pricing & guest allocation</h5>
        <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
      </div>

      <div class="modal-body">

        <form class="needs-validation" action="#" id="form3">

          <!-- hidden ids -->
          <input type="hidden" name="id" id="id3" value="">
          <input type="hidden" name="lead_id" id="modal_lead_id" value="">
          <input type="hidden" name="property_id" id="modal_property_id" value="">
          <input type="hidden" name="room_category_id" id="modal_room_category_id" value="">

          <input type="hidden" id="modal_packages_properties_days_id_fk" value="">
<input type="hidden" id="modal_quotation_properties_rooms_id_fk" value="">
<input type="hidden" id="modal_quotation_room_tariff_details_id" name="quotation_room_tariff_details_id" value="">


          <div id="admissionNote" class="small text-danger mt-2"></div>

          <!-- Top info -->
          <div class="row g-3 mb-3">
            <div class="col-md-6">
              <div class="border rounded p-2 h-100">
                <div class="fw-semibold mb-1">Lead</div>
                <div class="small text-muted" id="modalLeadInfo">-</div>
              </div>
            </div>

            <div class="col-md-6">
              <div class="border rounded p-2 h-100">
                <div class="fw-semibold mb-1">Property & Room</div>
                <div class="small text-muted" id="modalRoomInfo">-</div>
              </div>
            </div>
          </div>

          <!-- Guest details -->
          <div class="table-responsive mb-3">
            <table class="guest-details table table-bordered">
              <thead class="table-light text-center">
                <tr>
                  <th>Type</th>
                  <th>Guest Count</th>
                  <th>Meal Plan</th>
                </tr>
              </thead>

              <tbody>
                <!-- IN ENQUIRY -->
                <tr>
                  <td><strong>In Enquiry</strong></td>
                  <td>
                    Adult: <span data-role="enquiry-adult">0</span> |
                    Child: <span data-role="enquiry-child">0</span>
                  </td>
                  <td><span data-role="enquiry-meal">-</span></td>
                </tr>

                <!-- ROOM POLICY -->
                <tr>
                  <td><strong>Room Policy</strong></td>
                  <td data-role="room-policy-ages">Baby - | Child -</td>
                  <td><span data-role="meal-plan">-</span></td>
                </tr>

                <!-- APPLIED PLAN -->
                <tr>
                  <td><strong>Applied Plan</strong></td>
                  <td>
                    Adult: <span data-role="applied-adult">0</span> |
                    Child: <span data-role="applied-child">0</span> |
                    Baby: <span data-role="applied-baby">0</span>
                  </td>
                  <td>
                    <span data-role="applied-meal">-</span>
                    <span id="mealMismatchIconWrap"></span>
                  </td>
                </tr>
              </tbody>
            </table>
          </div>

          <!-- Pax wise bed utilization -->
          <div class="table-responsive mb-3">
            <h5 class="fw-bold mt-3 mb-2">Pax-wise Bed Utilization</h5>

            <table class="pax-wise-bed-utilization table table-bordered">
              <thead class="table-light text-center">
                <tr>
                  <th>Pax Type</th>
                  <th>Double Bed (DB)</th>
                  <th>Extra Bed (EB)</th>
                  <th>Single / Sharing Bed (SB)</th>
                </tr>
              </thead>

              <tbody>
                <tr>
                  <td><strong>Adult</strong></td>
                  <td>DB: <span data-role="adult-db">0</span></td>
                  <td>EB: <span data-role="adult-eb">0</span></td>
                  <td>SGL: <span data-role="adult-sgl">0</span></td>
                </tr>

                <tr>
                  <td><strong>Child</strong></td>
                  <td>DB: <span data-role="child-db">0</span></td>
                  <td>EB: <span data-role="child-eb">0</span></td>
                  <td>SB: <span data-role="child-sb">0</span></td>
                </tr>

                <tr>
                  <td><strong>Baby</strong></td>
                  <td>DB: <span data-role="baby-db">0</span></td>
                  <td>EB: <span data-role="baby-eb">0</span></td>
                  <td>SB: <span data-role="baby-sb">0</span></td>
                </tr>
              </tbody>
            </table>

            <div id="appliedMealWarningWrap"></div>

            <div class="mt-2">
              <div id="paxNoteSurplus" class="small text-success"></div>
              <div id="paxNoteExcess" class="small text-warning"></div>
              <div id="paxNoteAlert" class="small text-danger"></div>
            </div>
          </div>

          <!-- ✅ Synchronize table (amount shown, manual mirrors auto counts, totals separate) -->
          <div class="table-responsive">
            <table class="table table-bordered align-middle mb-0 auto-synchronize">
              <thead class="table-light">
                <tr>
                  <th style="width: 28%;">Synchronize <button type="button"
                            id="sync-btn"
                            class="btn btn-sm btn-primary ms-2">
                        Sync
                    </button>
                  </th>
                  <th style="width: 36%;">Auto Rooming Plan</th>
                  <th style="width: 36%;">Manual Rooming Plan</th>
                </tr>
              </thead>

              <tbody>
                <!-- template row helper:
                     each plan uses:
                     data-plan="auto|manual"
                     data-line="rooms|eb_adult|eb_child|sb_child|sgl|supplement"
                     data-field="count|rate"
                -->

                <!-- Rooms | Units -->
                <tr data-line="rooms">
                  <td class="fw-semibold">Rooms | Units</td>

                  <td>
                    <div class="row g-2">
                      <div class="col-6">
                        <input type="number" class="form-control form-control-sm"
                               name="auto_room_member_count" placeholder="count"
                               data-plan="auto" data-line="rooms" data-field="count" disabled>
                      </div>
                      <div class="col-6">
                        <div class="input-group input-group-sm">
                          <input type="number" class="form-control"
                                 name="auto_room_member_rate" placeholder="rate"
                                 data-plan="auto" data-line="rooms" data-field="rate" disabled>
                          <span class="input-group-text">
                            Amt: <span data-role="amount-auto-rooms">0</span>
                          </span>
                        </div>
                        <input type="hidden" name="auto_amount_rooms" value="0"
                               data-save="auto" data-line="rooms" data-save-field="amount">
                      </div>
                    </div>
                  </td>

                  <td>
                    <div class="row g-2">
                      <div class="col-6">
                        <input type="number" class="form-control form-control-sm"
                               name="manual_count" placeholder="count"
                               data-plan="manual" data-line="rooms" data-field="count">
                      </div>
                      <div class="col-6">
                        <div class="input-group input-group-sm">
                          <input type="number" class="form-control"
                                 name="manual_rate" placeholder="rate"
                                 data-plan="manual" data-line="rooms" data-field="rate">
                          <span class="input-group-text">
                            Amt: <span data-role="amount-manual-rooms">0</span>
                          </span>
                        </div>
                        <input type="hidden" name="manual_amount_rooms" value="0"
                               data-save="manual" data-line="rooms" data-save-field="amount">
                      </div>
                    </div>
                  </td>
                </tr>

                <!-- Extra Bed ( Adult ) -->
                <tr data-line="eb_adult">
                  <td class="fw-semibold">Extra Bed ( Adult )</td>

                  <td>
                    <div class="row g-2">
                      <div class="col-6">
                        <input type="number" class="form-control form-control-sm"
                               name="auto_extra_bed_adult_count" placeholder="count"
                               data-plan="auto" data-line="eb_adult" data-field="count" disabled>
                      </div>
                      <div class="col-6">
                        <div class="input-group input-group-sm">
                          <input type="number" class="form-control"
                                 name="auto_extra_bed_adult_rate" placeholder="rate"
                                 data-plan="auto" data-line="eb_adult" data-field="rate" disabled>
                          <span class="input-group-text">
                            Amt: <span data-role="amount-auto-eb_adult">0</span>
                          </span>
                        </div>
                        <input type="hidden" name="auto_amount_eb_adult" value="0"
                               data-save="auto" data-line="eb_adult" data-save-field="amount">
                      </div>
                    </div>
                  </td>

                  <td>
                    <div class="row g-2">
                      <div class="col-6">
                        <input type="number" class="form-control form-control-sm"
                               name="manual_extra_bed_adult_count" placeholder="count"
                               data-plan="manual" data-line="eb_adult" data-field="count">
                      </div>
                      <div class="col-6">
                        <div class="input-group input-group-sm">
                          <input type="number" class="form-control"
                                 name="manual_extra_bed_adult_rate" placeholder="rate"
                                 data-plan="manual" data-line="eb_adult" data-field="rate">
                          <span class="input-group-text">
                            Amt: <span data-role="amount-manual-eb_adult">0</span>
                          </span>
                        </div>
                        <input type="hidden" name="manual_amount_eb_adult" value="0"
                               data-save="manual" data-line="eb_adult" data-save-field="amount">
                      </div>
                    </div>
                  </td>
                </tr>

                <!-- Extra Bed ( Child ) -->
                <tr data-line="eb_child">
                  <td class="fw-semibold">Extra Bed ( Child )</td>

                  <td>
                    <div class="row g-2">
                      <div class="col-6">
                        <input type="number" class="form-control form-control-sm"
                               name="auto_extra_bed_child_count" placeholder="count"
                               data-plan="auto" data-line="eb_child" data-field="count" disabled>
                      </div>
                      <div class="col-6">
                        <div class="input-group input-group-sm">
                          <input type="number" class="form-control"
                                 name="auto_extra_bed_child_rate" placeholder="rate"
                                 data-plan="auto" data-line="eb_child" data-field="rate" disabled>
                          <span class="input-group-text">
                            Amt: <span data-role="amount-auto-eb_child">0</span>
                          </span>
                        </div>
                        <input type="hidden" name="auto_amount_eb_child" value="0"
                               data-save="auto" data-line="eb_child" data-save-field="amount">
                      </div>
                    </div>
                  </td>

                  <td>
                    <div class="row g-2">
                      <div class="col-6">
                        <input type="number" class="form-control form-control-sm"
                               name="manual_extra_bed_child_count" placeholder="count"
                               data-plan="manual" data-line="eb_child" data-field="count">
                      </div>
                      <div class="col-6">
                        <div class="input-group input-group-sm">
                          <input type="number" class="form-control"
                                 name="manual_extra_bed_child_rate" placeholder="rate"
                                 data-plan="manual" data-line="eb_child" data-field="rate">
                          <span class="input-group-text">
                            Amt: <span data-role="amount-manual-eb_child">0</span>
                          </span>
                        </div>
                        <input type="hidden" name="manual_amount_eb_child" value="0"
                               data-save="manual" data-line="eb_child" data-save-field="amount">
                      </div>
                    </div>
                  </td>
                </tr>

                <!-- Child Sharing Bed -->
                <tr data-line="sb_child">
                  <td class="fw-semibold">Child Sharing Bed
                    <span class="child-note-foc">child on FOC basis</span>
                  </td>

                  <td>
                    <div class="row g-2">
                      <div class="col-6">
                        <input type="number" class="form-control form-control-sm"
                               name="auto_child_sharing_bed_count" placeholder="count"
                               data-plan="auto" data-line="sb_child" data-field="count" disabled>
                      </div>
                      <div class="col-6">
                        <div class="input-group input-group-sm">
                          <input type="number" class="form-control"
                                 name="auto_child_sharing_bed_rate" placeholder="rate"
                                 data-plan="auto" data-line="sb_child" data-field="rate" disabled>
                          <span class="input-group-text">
                            Amt: <span data-role="amount-auto-sb_child">0</span>
                          </span>
                        </div>
                        <input type="hidden" name="auto_amount_sb_child" value="0"
                               data-save="auto" data-line="sb_child" data-save-field="amount">
                      </div>
                    </div>
                  </td>

                  <td>
                    <div class="row g-2">
                      <div class="col-6">
                        <input type="number" class="form-control form-control-sm"
                               name="manual_child_sharing_bed_count" placeholder="count"
                               data-plan="manual" data-line="sb_child" data-field="count">
                      </div>
                      <div class="col-6">
                        <div class="input-group input-group-sm">
                          <input type="number" class="form-control"
                                 name="manual_child_sharing_bed_rate" placeholder="rate"
                                 data-plan="manual" data-line="sb_child" data-field="rate">
                          <span class="input-group-text">
                            Amt: <span data-role="amount-manual-sb_child">0</span>
                          </span>
                        </div>
                        <input type="hidden" name="manual_amount_sb_child" value="0"
                               data-save="manual" data-line="sb_child" data-save-field="amount">
                      </div>
                    </div>
                  </td>
                </tr>

                <!-- Single Occupancy -->
                <tr data-line="sgl">
                  <td class="fw-semibold">Single Occupancy</td>

                  <td>
                    <div class="row g-2">
                      <div class="col-6">
                        <input type="number" class="form-control form-control-sm"
                               name="auto_single_occupancy_count" placeholder="count"
                               data-plan="auto" data-line="sgl" data-field="count" disabled>
                      </div>
                      <div class="col-6">
                        <div class="input-group input-group-sm">
                          <input type="number" class="form-control"
                                 name="auto_single_occupancy_rate" placeholder="rate"
                                 data-plan="auto" data-line="sgl" data-field="rate" disabled>
                          <span class="input-group-text">
                            Amt: <span data-role="amount-auto-sgl">0</span>
                          </span>
                        </div>
                        <input type="hidden" name="auto_amount_sgl" value="0"
                               data-save="auto" data-line="sgl" data-save-field="amount">
                      </div>
                    </div>
                  </td>

                  <td>
                    <div class="row g-2">
                      <div class="col-6">
                        <input type="number" class="form-control form-control-sm"
                               name="manual_single_occupancy_count" placeholder="count"
                               data-plan="manual" data-line="sgl" data-field="count">
                      </div>
                      <div class="col-6">
                        <div class="input-group input-group-sm">
                          <input type="number" class="form-control"
                                 name="manual_single_occupancy_rate" placeholder="rate"
                                 data-plan="manual" data-line="sgl" data-field="rate">
                          <span class="input-group-text">
                            Amt: <span data-role="amount-manual-sgl">0</span>
                          </span>
                        </div>
                        <input type="hidden" name="manual_amount_sgl" value="0"
                               data-save="manual" data-line="sgl" data-save-field="amount">
                      </div>
                    </div>
                  </td>
                </tr>

                <!-- Supplement Cost (count NA) -->
                <tr data-line="supplement">
                  <td class="fw-semibold">Supplement Cost</td>

                  <td>
                    <div class="row g-2">
                      <div class="col-6">
                        <input type="text" class="form-control form-control-sm"
                               name="auto_supplment_cost_count" value="NA" disabled
                               data-plan="auto" data-line="supplement" data-field="count">
                      </div>
                      <div class="col-6">
                        <div class="input-group input-group-sm">
                          <input type="number" class="form-control"
                                 name="auto_supplment_cost" placeholder="rate"
                                 data-plan="auto" data-line="supplement" data-field="rate" disabled>
                          <span class="input-group-text">
                            Amt: <span data-role="amount-auto-supplement">0</span>
                          </span>
                        </div>
                        <input type="hidden" name="auto_amount_supplement" value="0"
                               data-save="auto" data-line="supplement" data-save-field="amount">
                      </div>
                    </div>
                  </td>

                  <td>
                    <div class="row g-2">
                      <div class="col-6">
                        <input type="text" class="form-control form-control-sm"
                               name="manual_supplment_cost_count" value="NA" disabled
                               data-plan="manual" data-line="supplement" data-field="count">
                      </div>
                      <div class="col-6">
                        <div class="input-group input-group-sm">
                          <input type="number" class="form-control"
                                 name="manual_supplment_cost" placeholder="rate"
                                 data-plan="manual" data-line="supplement" data-field="rate">
                          <span class="input-group-text">
                            Amt: <span data-role="amount-manual-supplement">0</span>
                          </span>
                        </div>
                        <input type="hidden" name="manual_amount_supplement" value="0"
                               data-save="manual" data-line="supplement" data-save-field="amount">
                      </div>
                    </div>
                  </td>
                </tr>

                <tr id="remaining-row" style="display:none;">

                    <td class="fw-semibold">
                        Remaining Capacity:

                        <span class="badge bg-success ms-2" id="remaining-db" style="display:none;">
                            DB: 0
                        </span>

                        <span class="badge bg-success ms-1" id="remaining-eb" style="display:none;">
                            EB: 0
                        </span>

                        <span class="badge bg-success ms-1" id="remaining-sb" style="display:none;">
                            SB: 0
                        </span>
                    </td>
                  
                </tr>
              </tbody>

              <!-- ✅ Totals footer: Auto + Manual -->
              <tfoot class="table-light">
                <tr>
                  <td class="fw-semibold text-end">Total Rate</td>

                  <td class="fw-bold text-center">
                    <span data-role="total-auto">0</span>
                    <input type="hidden" name="auto_total_rate" id="auto_total_rate" value="0">
                  </td>

                  <td class="fw-bold text-center">
                    <span data-role="total-manual">0</span>
                    <input type="hidden" name="manual_total_rate" id="manual_total_rate" value="0">
                  </td>
                </tr>
              </tfoot>
            </table>
          </div>

        </form>
      </div>

      <div class="modal-footer">
        <button type="button" class="btn btn-danger" data-bs-dismiss="modal">Close</button>
        <button type="button" class="btn btn-primary" id="btnSave1">Save</button>
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
                    <input type="hidden" value="" name="guest_name" id="guest_name2"/>
                    <input type="hidden" value="" name="lead_type_delete" id="lead_type_delete"/>
                    
                </form>
            </div>
            <div class="modal-footer">
                <button type="button" class="btn btn-danger light" onclick="Leadsmodalclose()" data-bs-dismiss="modal">Close</button>
                <button type="button" class="btn btn-primary" id="btnSave1" onclick="delete_leads_action()" >Delete</button>
            </div>
        </div>
    </div>
</div>