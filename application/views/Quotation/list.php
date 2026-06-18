<style>
    .modal-lg {
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
/* #QuotationModal .modal-dialog {
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

#QuotationModal .modal-body {
    flex: 1 1 auto;
    min-height: 0;
    max-height: none !important;
    overflow-y: auto !important;
    overflow-x: hidden !important;
} */
.ck-content ul { list-style: disc; margin-left:20px; }
.ck-content ol { list-style: decimal; margin-left:20px; }

.ck-content ul li {
  list-style: disc !important;
}

.ck-content ol li {
  list-style: decimal !important;
}

.ck-content ul,
.ck-content ol {
  margin-left: 20px !important;
}
</style>
<style>
.day-thumb{
  width: 140px;
  height: 95px;
  object-fit: cover;
  border-radius: 8px;
  border: 1px solid #ddd;
}
.child-note-foc {
    color: red;
    font-size: 12px;
    margin-top: 3px;
    display: none;   /* hidden initially */
}
/* .itineraryDayRow {
   border-bottom: 3px solid #0d6efd; 
} */
.itineraryDayRow {
    border-bottom: 6px solid #0d6efd !important;
    /* padding-bottom: 12px; */
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

/* .select2-error {
    border: 1px solid #dc3545 !important;
    border-radius: 4px !important;
}

.select2-container--default .select2-selection.select2-error {
    border: 1px solid #dc3545 !important;
}
.room-rate-error {
    border: 2px solid #dc3545 !important;
} */

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
.Leadsview{
  max-width: 95%;
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
/* Keep filter Select2 below modal */
#Create .select2-container {
    z-index: 1000 !important;
}
#Create .select2-dropdown {
    z-index: 1001 !important;
}
#QuotationModal {
    z-index: 1050 !important;
}
#QuotationModal .select2-container {
    z-index: 1060 !important;
}
#QuotationModal .select2-dropdown {
    z-index: 1061 !important;
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
                <!-- row -->
                <form id="exampleValidation" method="POST" action="" enctype="multipart/form-data">
                                    <div class="card-header" id="Create" style="display:none">
                                        <div class="d-flex align-items-center">
                                            <div class="row row-demo-grid hdr-filter-dd-fullwd">
                                                <div class="col-sm-6 col-md-3">
                                                    <div class="card">
                                                        <div class="input-group">
                                                            <select data-validation="required" data-pms-required="true" class="form-control input-lg" id="quotation_number_filter" name="quotation_number_filter" required>
                                                                <option value="">Please Select Quotation number</option>
                                                            </select>
                                                        </div>
                                                    </div>
                                                </div>  
                                                <div class="col-sm-6 col-md-3">
                                                    <div class="card">
                                                        <div class="input-group">
                                                            <select data-validation="required" data-pms-required="true" class="form-control input-lg" id="package_id_filter" name="package_id_filter" required>
                                                                <option value="">Please Select package</option>
                                                            </select>
                                                        </div>
                                                    </div>
                                                </div>
                                                <div class="col-sm-6 col-md-3">
                                                    <div class="card">
                                                        <div class="input-group">
                                                            <select data-validation="required" data-pms-required="true" class="form-control input-lg" id="leads_id_filter" name="leads_id_filter" required>
                                                                <option value="">Please Select lead</option>
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
                                                                   <option value="6">Cancelled</option>

                                                                    
                                                            </select>
                                                        </div>
                                                    </div>
                                                </div>
                                                <div class="col-sm-6 col-md-3">
                                                    <div class="card">
                                                        <div class="input-group">
                                                            <input type="text" class="form-control" placeholder="Guest name" id="guest_name" name="guest_name" required>
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
                                                            <input type="text" class="form-control" placeholder="Quotation Date Range" id="quotation_daterange" name="quotation_daterange">
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
                                                        <button type="button" class="btn btn-secondary btn-md" id="reset_filter">
                                                            <span class="btn-label">
                                                                <i class="icon-refresh"></i>
                                                            </span>
                                                            Reset
                                                        </button>
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
                                <h2 class="card-title"><b>Quotation Details</b></h2>
                                <?php if (has_permission('QUOTATION_CREATE')): ?>
                                        <a onclick="add_quotation()"  data-bs-target="#QuotationModal" class="btn btn-rounded btn-secondary btn-md"><b>+ Create Quotation</b></a> 
                                <?php endif; ?>                                   
                            </div>
                            <div class="card-body">
                                <div class="table-responsive">
                                    <table class="table card-table display mb-4 shadow-hover table-responsive-lg" id="Quotation_registration">
                                        <thead>
                                            <tr>
                                                <th>Sl.no</th>
                                                <th>Quotation no:</th>
                                                <th>Lead:</th>
                                                <th>Template name</th>
                                                <th>Quotation date</th>
                                                <th>Remark</th>
                                                <th>Status</th>
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
        <div class="modal fade" id="QuotationModal" tabindex="-1" aria-labelledby="AddPriorityModalLabel" aria-hidden="true" data-bs-backdrop="static" data-bs-keyboard="false"> 
        <!-- <div class="modal fade" id="QuotationModal" role="dialog" data-backdrop="static"  data-keyboard="false"> -->
            <div class="modal-dialog modal-lg" role="document">
                <div class="modal-content">
                    <div class="modal-header">
                        <h3 class="modal-title"></h5>
                        <button type="button" class="btn-close" onclick="Quotationmodalclose()" data-bs-dismiss="modal">
                        </button>
                    </div>
                    <div class="modal-body">
                        
                        <form class="needs-validation" action="#" id="form" >
                            <input type="hidden" value="" name="id" id="id"/> 
                            <input type="hidden" id="selected_lead_id" value="">
                            <input type="hidden" id="leads_id_hidden" name="leads_id_hidden">
<input type="hidden" id="packages_id_hidden" name="packages_id_hidden">
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
                            <div class="row">
                                <div class="col-md-3 leads_id">
                                    <div class=" form-group">
                                        <label class="col-lg-5 col-form-label" for="leads">Leads  <span class="text-danger">*</span>
                                        </label>
                                        
                                            <select name="leads_id" id="leads_id" class="form-control input-lg lst-flt-select2" required>                                     
                                                <option value="">Please Select lead</option>
                                                <?php foreach($leads as $row) {
                                                    // $sel = ($records->state==$row->state_id)?'selected':'';
                                                    echo '<option value="'.$row->leads_id.'">'.$row->guest_name.'</option>';
                                                } ?>
                                            </select>
                                        
                                    </div>
                                </div>
                                <div class="col-md-3 packages_id_fk">
                                    <div class=" form-group">
                                        <label class="col-lg-5 col-form-label" for="leads">Template  <span class="text-danger">*</span>
                                        </label>
                                        
                                            <select name="packages_id_fk" id="packages_id_fk" class="form-control input-lg lst-flt-select2" required>                                     
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

                            <button type="button" class="btn btn-primary mt-2" id="addOptionBtn" disabled>
                              + Add New Option
                            </button>

                            
                            
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
                                                <th style="width:20%">Amount</th>
                                                <th style="width:10%" class="text-center">Action</th>-->
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
                        <button type="button" class="btn btn-primary" id="btnSave" onclick="save()" >Save</button>
                    </div>
                </div>
            </div>
        </div>

  <div class="modal fade" id="ChangeStatusModal" tabindex="-1" data-bs-backdrop="static"> 
    <div class="modal-dialog"> <div class="modal-content"> 
      <div class="modal-header"> 
          <h5 class="modal-title2">Change quotation Status</h5> 
          <button type="button" class="btn-close" data-bs-dismiss="modal"></button> 
        </div> 
        <div class="modal-body"> 
          <form id="changeStatusForm"> <input type="hidden" id="lead_id" name="lead_id"> 
          <input type="hidden" id="quotation_id" name="quotation_id"> <div class="mb-3"> 
            <label class="form-label">Status <span class="text-danger">*</span></label> 
              <select class="form-control select2" id="quotation_current_status" name="quotation_current_status" required> 
                <option value="">Select Status</option> 
              </select> 
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
  <div class="modal-dialog modal-lg modal-dialog-scrollable">
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
         <div class="modal fade" id="QuotationitineraryModal" tabindex="-1" aria-labelledby="AddPriorityModalLabel" aria-hidden="true" data-bs-backdrop="static" data-bs-keyboard="false">
        <!-- <div class="modal fade" id="PackagesModal" role="dialog" tabindex="-1" data-backdrop="static"  aria-hidden="true" data-bs-keyboard="false"> -->
            <div class="modal-dialog modal-lg" role="document">
                <div class="modal-content">
                    <div class="modal-header">
                        <h3 class="modal-title"></h5>
                        <button type="button" class="btn-close" onclick="Quotationitinerarymodalclose()" data-bs-dismiss="modal">
                        </button>
                    </div>
                    <div class="modal-body">
                        
                        <form class="needs-validation" action="#" id="form2" enctype="multipart/form-data">
                            <!-- <input type="hidden" value="" name="id" id="id"/>  -->
                            <input type="hidden" name="quotations_id" id="quotations_id">

                            <div class="row">
                                <div class="col-md-2">
                                    <div class=" form-group">
                                        <label class="col-lg-7 col-form-label" for="quotation_title"><b>Quotation title</b> <span class="text-danger">*</span>
                                        </label>
                                        
                                            <input type="text" class="form-control" name="quotation_title" id="quotation_title" placeholder="Enter Quotation title" required>
                                            <span class="help-block" style="color:red"></span>
                                        
                                    </div>
                                </div>
                                

                                <div class="col-md-2">
                                    <label><b>First cover page</b></label>

                                    <input id="quotation_first_cover_page" name="quotation_first_cover_page"
                                    class="form-control" type="file">

                                    <input id="quotation_first_cover_page_txt" name="quotation_first_cover_page_txt" type="hidden">

                                    <div id="first_cover_preview" style="margin-top:8px;"></div>

                                </div>


                                <div class="col-md-2">
                                    <label><b>Last cover page</b></label>

                                    <input id="quotation_last_cover_page" name="quotation_last_cover_page"
                                    class="form-control" type="file">

                                    <input id="quotation_last_cover_page_txt" name="quotation_last_cover_page_txt" type="hidden">

                                    <div id="last_cover_preview" style="margin-top:8px;"></div>

                                </div>                               
                            

                            </div>

                            

                            
                            
                            <div class="row">
                                <div class="table-responsive">
                                    <table class="table table-responsive-md" id="table1">
                                        <!-- <thead><tr><th><strong>Day</strong></th><th><strong>Stay Destination</strong></th><th><strong>Content</strong></th><th><strong>Change Destination</strong></th><th><strong>change Content</strong></th></tr></thead> -->
                                        <thead>
                                            <tr>
                                                <th>Day</th>
                                                <th>Stay Destination</th>
                                                <th style="width:40%;">Description</th>
                                                <th style="width:15%;">Image</th>
                                                <!-- <th>Change Destination</th> -->
                                                <th>Change Content</th>
                                            </tr>
                                        </thead>

                                        <tbody id="itinerary">
                                                                
                                        </tbody>    
                                       
                                                    </table></div>
                            </div>     
                            
                            

                            <div class="row">
                                
                                <div class="form-check custom-checkbox checkbox-success check-lg me-3"><input type="checkbox" class="form-check-input sc_chkbox"  id="quotation_inclusion_exclusion_checked_type" name="quotation_inclusion_exclusion_checked_type" value="Y" required=""><label class="form-check-label" for="customCheckBox2"><b>Inclusions and exclusions</b></label></div>
                                    <div class="row" id="inclusionExclusionWrapper">
                                        <div class="col-md-3">
                                            <div class="form-group">
                                                
                                                    <select name="quotation_inclusion_exclusion_common_id_fk" id="quotation_inclusion_exclusion_common_id_fk" class="form-control multi-select" required>                                     
                                                        <option value="">Please Search by title</option>                            
                                                                            <?php foreach($inclusions_exclusion as $row)
                                                                            {
                                                                                
                                                                                echo '<option value="'.$row->inclusion_exclusion_common_id.'" '.$sel.'>'.$row->inclusion_exclusion_common_title.'</option>';

                                                                            } ?>
                                                    </select>
                                                    <span class="help-block" style="color:red"></span>
                                            </div>
                                        </div>
                                    </div>
                                    <div class="col-xl-6 col-lg-6" id="myDiv2">
                                        <div class="card">
                                            <div class="card-header">
                                                <h4 class="card-title">Inclusions</h4>
                                            </div>
                                            <div class="card-body">
                                                <div class="basic-form">

                                                    <!-- INCLUSIONS -->
                                                    <div id="inclusion"></div>

                                                    <div class="add1">
                                                        <button type="button" class="btn btn-primary add-inclusion">
                                                            + Add new
                                                        </button>
                                                    </div>

                                                </div>
                                            </div>
                                        </div>
                                    </div>
                                    <div class="col-xl-6 col-lg-6" id="myDiv3">
                                        <div class="card">
                                            <div class="card-header">
                                                <h4 class="card-title">exclusions</h4>
                                            </div>
                                            <div class="card-body">
                                                <div class="basic-form">

                                                    <!-- EXCLUSIONS -->
                                                    <div id="exclusion"></div>

                                                    <div class="add2">
                                                        <button type="button" class="btn btn-primary add-exclusion">
                                                            + Add new
                                                        </button>
                                                    </div>

                                                </div>
                                            </div>
                                        </div>
                                    </div>
                            </div><hr>

                            <div class="row">
                                
                                <div class="form-check custom-checkbox checkbox-success check-lg me-3"><input type="checkbox" class="form-check-input sc_chkbox"  id="quotation_optional_add_on_checked_type" name="quotation_optional_add_on_checked_type" value="Y" required=""><label class="form-check-label" for="customCheckBox2"><b> Add Optional add on</b></label></div>
                                    <div class="col-xl-10 col-lg-10">
                                        <div class="card">
                                            
                                            <div class="card-body">
                                                <div class="basic-form" id="optional-addon">
                                                    
                                                    <div class="mb-3 col-md-6">
                                                        <button class="btn btn-primary add-optional-addon" type="button">+ Add new</button>
                                                        <!-- <button class="btn btn-primary add" type="button" id="submit"  onClick="addMore3();">+ Add new</button> -->
                                                    </div>
                                                </div>
                                            </div>
                                        </div>
                                    </div>
                                    
                            </div><hr>


                            <div class="row">
                                
                                <div class="form-check custom-checkbox checkbox-success check-lg me-3"><input type="checkbox" class="form-check-input sc_chkbox"  id="quotation_payment_policies_checked_type" name="quotation_payment_policies_checked_type" value="Y" required=""><label class="form-check-label" for="customCheckBox2"><b>Payment policies </b></label></div>
                                    <div class="row" id="myDiv4">
                                        <div class="col-md-3">
                                            <div class="form-group">
                                                
                                                    <select name="quotation_policies_id_fk" id="quotation_policies_id_fk" class="form-control multi-select" required>                                     
                                                        <option value="">Please Search by title</option>                            
                                                                            <?php foreach($payment_policies as $row)
                                                                            {
                                                                                
                                                                                echo '<option value="'.$row->payment_policies_id.'" '.$sel.'>'.$row->payment_policies_name.'</option>';

                                                                            } ?>
                                                    </select>
                                                    <span class="help-block" style="color:red"></span>
                                            </div>
                                        </div>
                                    </div>
                                    <div class="col-xl-10 col-lg-10" id="myDiv5">
                                        <div class="card">
                                            
                                            <div class="card-body">
                                                <div class="basic-form" id="payment-policies">
                                                    
                                                    <div class="mb-3 col-md-6 payment_add">
                                                        <button class="btn btn-primary add" type="button" id="submit"  onClick="addMore5();">+ Add new</button>
                                                    </div>
                                                </div>
                                            </div>
                                        </div>
                                    </div>
                                    
                            </div><hr>

                            <div class="row">
                                
                                <div class="form-check custom-checkbox checkbox-success check-lg me-3"><input type="checkbox" class="form-check-input sc_chkbox"  id="quotation_terms_conditions_checked_type" name="quotation_terms_conditions_checked_type" value="Y" required=""><label class="form-check-label" for="customCheckBox2"><b>Terms & condition</b></label></div>
                                    <div class="row" id="myDiv6">
                                        <div class="col-md-3">
                                            <div class="form-group">
                                                
                                                    <select name="quotation_terms_condition_id_fk" id="quotation_terms_condition_id_fk" class="form-control multi-select" required>                                     
                                                        <option value="">Please Search by title</option>                            
                                                                            <?php foreach($terms_condition as $row)
                                                                            {
                                                                                
                                                                                echo '<option value="'.$row->terms_condition_id.'" '.$sel.'>'.$row->terms_condition_name.'</option>';

                                                                            } ?>
                                                    </select>
                                                    <span class="help-block" style="color:red"></span>
                                            </div>
                                        </div>
                                    </div>
                                    <div class="col-xl-10 col-lg-10" id="myDiv7">
                                        <div class="card">
                                           
                                            <div class="card-body">
                                                <div class="basic-form" id="terms-conditions">
                                                    
                                                    <div class="mb-3 col-md-6 terms_add">
                                                        <button class="btn btn-primary add" type="button" id="submit"  onClick="addMore6();">+ Add new</button>
                                                    </div>
                                                </div>
                                            </div>
                                        </div>
                                    </div>
                                    
                            </div><hr>

                            <div class="row">
                                
                                <div class="form-check custom-checkbox checkbox-success check-lg me-3"><input type="checkbox" class="form-check-input sc_chkbox"   id="quotation_cancellation_policy_checked_type" name="quotation_cancellation_policy_checked_type" value="Y" required=""><label class="form-check-label" for="customCheckBox2"><b>Cancellation Policy </b></label></div>
                                    <div class="row" id="myDiv8">
                                        <div class="col-md-3">
                                            <div class="form-group">
                                                
                                                    <select name="quotation_cancellation_policies_id_fk" id="quotation_cancellation_policies_id_fk" class="form-control multi-select" required>                                     
                                                        <option value="">Please Search by title</option>                            
                                                                            <?php foreach($cancellation_policies as $row)
                                                                            {
                                                                                
                                                                                echo '<option value="'.$row->cancellation_policies_id.'">'.$row->cancellation_policies_name.'</option>';

                                                                            } ?>
                                                    </select>
                                                    <span class="help-block" style="color:red"></span>
                                            </div>
                                        </div>
                                    </div>
                                    <div class="col-xl-10 col-lg-10" id="myDiv9">
                                        <div class="card">
                                            
                                            <div class="card-body">
                                                <div class="basic-form" id="cancellation-policy">
                                                   
                                                    <div class="mb-3 col-md-6 terms_add">
                                                        <button class="btn btn-primary add" type="button" id="submit"  onClick="addMore7();">+ Add new</button>
                                                    </div>
                                                </div>
                                            </div>
                                        </div>
                                    </div>
                                    
                            </div><hr>

                            <div class="row">
                                
                                <div class="form-check custom-checkbox checkbox-success check-lg me-3"><input type="checkbox" class="form-check-input sc_chkbox"  id="quotation_notes_checked_type" name="quotation_notes_checked_type" value="Y" required=""><label class="form-check-label" for="customCheckBox2"><b> Add Notes</b></label></div>
                                    <div class="col-xl-10 col-lg-10">
                                        <div class="card">
                                            
                                            <div class="card-body">
                                                <div class="basic-form" id="add_notes">
                                                    
                                                     <div class="mb-3 col-md-6 terms_add">
                                                        <button class="btn btn-primary add" type="button" id="submit"  onClick="addMore8();">+ Add new</button>
                                                    </div>
                                                </div>
                                            </div>
                                        </div>
                                    </div>
                                    
                            </div><hr>
                        </form>
                    </div>
                    <div class="modal-footer">
                        <button type="button" class="btn btn-danger light" onclick="Quotationitinerarymodalclose()" data-bs-dismiss="modal">Close</button>
                        <button type="button" class="btn btn-primary" id="btnSave" onclick="save_quote_itinerary()" >Save</button>
                    </div>
                </div>
            </div>
        </div>

<!-- Modal -->
<div class="modal fade" id="ConverttripModal" role="dialog" data-backdrop="static"  data-keyboard="false">
    <div class="modal-dialog" role="document">
        <div class="modal-content">
            <div class="modal-header">
                <h5 class="modal-title5"></h5>
                <button type="button" class="btn-close" data-bs-dismiss="modal">
                </button>
            </div>
            <div class="modal-body">
                
                <form class="needs-validation" action="#" id="form5" >
                    <input type="text" value="" name="id" id="id5"/> 
                    <input type="text" value="" name="lead_id_fk" id="lead_id_fk1"/>
                    <input type="text" value="" name="trips_travel_start_date" id="trips_travel_start_date"/>
                    <input type="text" value="" name="trips_travel_duration" id="trips_travel_duration"/>
                    <input type="text" value="" name="trips_travel_end_date" id="trips_travel_end_date"/>
                    
                </form>
            </div>
            <div class="modal-footer">
                <button type="button" class="btn btn-danger light" onclick="Propertymodalclose()" data-bs-dismiss="modal">Close</button>
                <button type="button" class="btn btn-primary" id="btnSave4" onclick="convert_to_trip_action()" >Ok</button>
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
                    <input type="hidden" value="" name="quote_num" id="quote_num"/>
                    
                </form>
            </div>
            <div class="modal-footer">
                <button type="button" class="btn btn-danger light" onclick="Propertymodalclose()" data-bs-dismiss="modal">Close</button>
                <button type="button" class="btn btn-primary" id="btnSave7" onclick="delete_quotation_action()" >Delete</button>
            </div>
        </div>
    </div>
</div>

<div id="day-hover-popup" style="display:none;"></div>

<style>
    .itinerary-modal-content {
    max-height: 350px;
    overflow-y: auto;
    padding: 10px;
    font-size: 14px;
    line-height: 1.7;
    background: #fafafa;
    border: 1px solid #e1e1e1;
}

.day-popup {
    max-height: 200px;
    overflow-y: auto;
    border: 1px solid #ddd;
    background: #fff;
    padding: 10px;
    box-shadow: 0 2px 8px rgba(0,0,0,0.2);
    font-size: 13px;
    line-height: 1.5;
}


/* .day-description-tooltip {
    position: fixed;
    width: 420px;
    max-height: 260px;
    overflow-y: auto;
    background: #fff;
    border: 2px solid #1e90ff;
    border-radius: 6px;
    padding: 12px;
    font-size: 13px;
    line-height: 1.5;
    z-index: 99999;
    box-shadow: 0 6px 18px rgba(0,0,0,.25);
    display: none;
} */

/* Tooltip styles for itinerary day descriptions */
.day-description-tooltip {
    position: absolute;
    background: #fff;
    border: 2px solid #007bff;
    border-radius: 8px;
    padding: 15px;
    box-shadow: 0 4px 12px rgba(0,0,0,0.15);
    z-index: 1000;
    min-width: 400px;
    max-width: 500px;
    display: none;
    top: 0;
    right: 100%;
    margin-top: 5px;
    max-height: 300px;
    overflow-y: auto;
    transition: opacity 0.15s ease, transform 0.15s ease;
}

.day-description-tooltip .tooltip-content {
    color: #333;
    font-size: 14px;
    line-height: 1.6;
    word-wrap: break-word;
    cursor: pointer;
}

@media (max-width: 768px) {
    .day-description-tooltip {
        right: auto;
        left: 0;
        width: 100%;
        min-width: unset;
    }
}


/* .change_itinerary_day {
    position: relative;
} */

td.position-relative {
    position: relative;
}

.position-relative {
    position: relative;
}
</style>