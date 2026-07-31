

<style>
.confirmation-option-card:not(.is-confirmed):hover {
    transform: translateY(-3px);
    box-shadow: 0 6px 16px rgba(74,62,224,0.2) !important;
}
.confirmation-option-card.is-confirmed:hover {
    transform: translateY(-3px);
    box-shadow: 0 6px 16px rgba(46,125,50,0.25) !important;
}
.quotation-hub-summary {
    margin-bottom: 25px;
}

.quotation-info-card {
    border-radius: 14px;
    padding: 18px 20px;
    background: #ffffff;
    border: 1px solid #e5e7eb;
    box-shadow: 0 4px 12px rgba(0,0,0,0.05);
    height: 100%;
}

.quotation-info-label {
    font-size: 13px;
    color: #6b7280;
    font-weight: 600;
    margin-bottom: 8px;
    text-transform: uppercase;
}

.quotation-info-value {
    font-size: 20px;
    color: #111827;
    font-weight: 700;
    word-break: break-word;
}

.quotation-status-badge {
    display: inline-block;
    padding: 6px 14px;
    border-radius: 999px;
    background: #e8f5e9;
    color: #2e7d32;
    font-size: 15px;
    font-weight: 700;
}
</style>
<style>
.hub-info-section {
    background: #ffffff;
    border: 1px solid #e5e7eb;
    border-radius: 14px;
    padding: 16px;
    height: 100%;
}

.hub-info-title {
    font-size: 15px;
    font-weight: 700;
    color: #111827;
    margin-bottom: 14px;
    padding-bottom: 8px;
    border-bottom: 1px solid #e5e7eb;
}

.hub-info-row {
    margin-bottom: 12px;
}

.hub-info-label {
    font-size: 12px;
    font-weight: 600;
    color: #6b7280;
    text-transform: uppercase;
    margin-bottom: 3px;
}

.hub-info-value {
    font-size: 15px;
    font-weight: 700;
    color: #111827;
    word-break: break-word;
}
</style>
<style>
/* Disabled tab styling */
.nav-tabs .nav-link.disabled-tab {
    color: #adb5bd !important;
    cursor: not-allowed;
    pointer-events: none;
    background-color: #f8f9fa;
    border-color: #dee2e6 #dee2e6 #fff;
}
.nav-tabs .nav-link.disabled-tab i {
    color: #adb5bd !important;
}
.nav-tabs .nav-link.disabled-tab:hover {
    border-color: #dee2e6 #dee2e6 #fff;
}
.nav-tabs .nav-link.tab-disabled {
    color: #adb5bd !important;
    cursor: not-allowed;
    pointer-events: none;
}
</style>
<style>
/* Financial Posting tab — light blue / teal theme */
#financialPostingTab .fp-card-header {
    background: linear-gradient(135deg, #00838f 0%, #006064 100%);
    color: #fff;
}
#financialPostingTab .fp-card-header .card-title,
#financialPostingTab .fp-card-header h5,
#financialPostingTab .fp-card-header i {
    color: #fff;
}
#financialPostingTab .fp-table thead th {
    background: #b2dfdb;
    color: #004d40;
    border: 1px solid #80cbc4;
    font-size: 12px;
    font-weight: 700;
    text-transform: uppercase;
}
#financialPostingTab .fp-table tbody td {
    border: 1px solid #e0f2f1;
    vertical-align: middle;
}
#financialPostingTab .fp-table tbody tr.fp-label td:first-child,
#financialPostingTab .fp-table tbody tr.fp-label-row td:first-child {
    background: #e0f2f1;
    font-weight: 600;
    color: #004d40;
}
#financialPostingTab .fp-table tbody tr.fp-total td,
#financialPostingTab .fp-table tbody tr.fp-total-row td {
    background: #e0f2f1;
    color: #00695c;
    font-weight: 700;
}
#financialPostingTab .fp-table tbody tr.fp-total td:first-child,
#financialPostingTab .fp-table tbody tr.fp-total-row td:first-child {
    background: #b2dfdb;
    color: #004d40;
}
#financialPostingTab .fp-section-header {
    background: #e0f2f1 !important;
    color: #00695c !important;
    font-size: 12px;
    font-weight: 700;
}
#financialPostingTab .fp-section-header .btn {
    font-size: 11px;
    padding: 2px 10px;
}
#financialPostingTab .fp-table .form-control {
    border: 1px solid #80cbc4;
}
#financialPostingTab .fp-table .form-control:focus {
    border-color: #00838f;
    box-shadow: 0 0 0 2px rgba(0, 131, 143, 0.15);
}
/* Per-day grouped costing block */
#financialPostingTab .fp-table tbody tr.fp-day-header td {
    background: linear-gradient(135deg, #00838f 0%, #006064 100%);
    padding: 8px 12px;
    border: none;
    cursor: pointer;
}
#financialPostingTab .fp-day-toggle {
    display: inline-flex;
    align-items: center;
    color: #fff;
    margin-right: 8px;
    font-size: 16px;
    transition: transform 0.2s ease;
}
#financialPostingTab .fp-table tbody tr.fp-day-header.fp-collapsed .fp-day-toggle {
    transform: rotate(-90deg);
}
#financialPostingTab .fp-table tbody tr.fp-day-item.fp-hidden {
    display: none;
}
#financialPostingTab .fp-day-badge {
    display: inline-flex;
    align-items: center;
    color: #fff;
    font-weight: 700;
    font-size: 13px;
    letter-spacing: .3px;
    text-transform: uppercase;
}
#financialPostingTab .fp-day-subtotal {
    float: right;
    color: #e0f2f1;
    font-weight: 600;
    font-size: 12px;
}
#financialPostingTab .fp-day-subtotal b {
    color: #fff;
    font-size: 13px;
}
#financialPostingTab .fp-table tbody tr.fp-day-item td {
    border: 1px solid #e0f2f1;
    background: #f7fbfb;
}
#financialPostingTab .fp-table tbody tr.fp-day-item.fp-day-special td {
    border-bottom: 2px solid #b2dfdb;
}
#financialPostingTab .fp-item-label {
    font-weight: 600;
    color: #004d40;
    padding-left: 18px !important;
    white-space: nowrap;
}
#financialPostingTab .fp-item-icon {
    display: inline-flex;
    align-items: center;
    justify-content: center;
    width: 26px;
    height: 26px;
    border-radius: 6px;
    margin-right: 8px;
    color: #fff;
    font-size: 14px;
    vertical-align: middle;
}
#financialPostingTab .fp-icon-hotel   { background: #00838f; }
#financialPostingTab .fp-icon-inc     { background: #26a69a; }
#financialPostingTab .fp-icon-special { background: #ff8f00; }
</style>
<!--**********************************
            Content body start
        ***********************************-->
        <div class="content-body">
            <div class="container-fluid">
				<div class="quotation-hub-summary">
                    <input type="hidden" id="quotation_id" value="<?= isset($quotation_id) ? (int)$quotation_id : 0; ?>">
                    <input type="hidden" id="hub_lead_id" value="">
                    <div class="row g-3 mb-3">
                        <div class="col-xl-3 col-lg-3 col-md-6">
                            <div class="quotation-info-card">
                                <div class="quotation-info-label">Quotation Number</div>
                                <div id="hubQuotationNumber" class="quotation-info-value"></div>
                            </div>
                        </div>

                        <div class="col-xl-3 col-lg-3 col-md-6">
                            <div class="quotation-info-card">
                                <div class="quotation-info-label">Quotation Status</div>
                                <div class="quotation-info-value">
                                    <span class="quotation-status-badge" id="hubQuotationStatus"></span>
                                </div>
                                <div id="hubStatusConfirmedOption" style="display:none; margin-top:6px; font-size:13px; color:#2e7d32; font-weight:600;">
                                    <i class="la la-check-circle"></i> <span id="hubStatusOptionText"></span>
                                </div>
                            </div>
                        </div>

                        <div class="col-xl-3 col-lg-3 col-md-6">
                            <div class="quotation-info-card">
                                <div class="quotation-info-label">Guest Name</div>
                                <div class="quotation-info-value" id="hubGuestName"></div>
                            </div>
                        </div>

                        <div class="col-xl-3 col-lg-3 col-md-6">
                            <div class="quotation-info-card">
                                <div class="quotation-info-label">Lead Number</div>
                                <div class="quotation-info-value" id="hubLeadNumber"></div>
                            </div>
                        </div>
                    </div>

                    <div class="row g-3">
                        <div class="col-xl-3 col-lg-3 col-md-6">
                            <div class="quotation-info-card">
                                <div class="quotation-info-label">Lead Type</div>
                                <div class="quotation-info-value" id="hubLeadType"></div>
                            </div>
                        </div>

                        <div class="col-xl-3 col-lg-3 col-md-6">
                            <div class="quotation-info-card">
                                <div class="quotation-info-label">Tour Start Date</div>
                                <div class="quotation-info-value" id="hubStartDate"></div>
                            </div>
                        </div>

                        <div class="col-xl-3 col-lg-3 col-md-6">
                            <div class="quotation-info-card">
                                <div class="quotation-info-label">Duration</div>
                                <div class="quotation-info-value" id="hubDuration"></div>
                            </div>
                        </div>

                        <div class="col-xl-3 col-lg-3 col-md-6">
                            <div class="quotation-info-card">
                                <div class="quotation-info-label">Tour End Date</div>
                                <div class="quotation-info-value" id="hubEndDate"></div>
                            </div>
                        </div>
                    </div>

                </div>

                <!-- Review Status Card -->
                <div id="hubReviewCard" class="row g-3 mb-3" style="display:none;">
                    <div class="col-12">
                        <div class="card border-0 shadow-sm" style="border-radius:10px;">
                            <div class="card-body d-flex justify-content-between align-items-center flex-wrap gap-3">
                                <div class="d-flex align-items-center gap-3">
                                    <div>
                                        <div class="quotation-info-label" style="font-size:12px;color:#6c757d;font-weight:600;text-transform:uppercase;letter-spacing:0.5px;">Trip Review</div>
                                        <div id="hubReviewDisplay" style="font-size:15px;font-weight:600;color:#212529;"></div>
                                    </div>
                                </div>
                                <div id="hubReviewAction">
                                    <!-- Filled by JS -->
                                </div>
                            </div>
                        </div>
                    </div>
                </div>

                <div class="row">
                    <div class="col-xl-12">
                        <div class="card">
                            <div class="card-header d-flex justify-content-between align-items-center">
                                <h4 class="card-title mb-0">Quotation Hub</h4>
                                <div id="quotationActionButtons">
                                    <!-- Buttons will be dynamically inserted here by JS -->
                                </div>
                            </div>
                            <div class="card-body">
                                <!-- Nav tabs -->
                                <div class="default-tab">
                                    <ul class="nav nav-tabs" role="tablist">
                                        <li class="nav-item">
                                            <a class="nav-link active" data-bs-toggle="tab" href="#lead-details-tab-pane"><i class="la la-home me-2"></i> Lead details</a>
                                        </li>
                                        <?php if (has_permission('CLIENT_CONFIRMATION')): ?>
                                        <li class="nav-item">
                                            <a class="nav-link disabled-tab" data-bs-toggle="tab" href="#clientConfirmationTab" id="tabClientConfirmation">
                                                <i class="la la-user me-2"></i> Client confirmation
                                            </a>
                                        </li>
                                        <?php endif; ?>
                                        <?php if (has_permission('RECEIPT_SCHEDULER')): ?>
                                        <li class="nav-item">
                                            <a class="nav-link disabled-tab" data-bs-toggle="tab" href="#receiptSchedulerTab" id="tabReceiptScheduler">
                                                <i class="la la-calendar me-2"></i> Receipt Scheduler
                                            </a>
                                        </li>
                                        <?php endif; ?>
                                        <?php if (has_permission('PROPERTY_RESERVATION')): ?>
                                        <li class="nav-item">
                                            <a class="nav-link disabled-tab" data-bs-toggle="tab" href="#propertyReservationTab" id="tabPropertyReservation"><i class="la la-hotel me-2"></i> Property reservation</a>
                                        </li>
                                        <?php endif; ?>
                                        <?php if (has_permission('FINANCIAL_POSTING')): ?>
                                        <li class="nav-item">
                                            <a class="nav-link disabled-tab" data-bs-toggle="tab" href="#financialPostingTab" id="tabFinancialPosting">
                                                <i class="la la-file-invoice-dollar me-2"></i> Financial posting
                                            </a>
                                        </li>
                                        <?php endif; ?>
                                        <!-- <li class="nav-item">
                                            <a class="nav-link" data-bs-toggle="tab" href="#message"><i class="la la-envelope me-2"></i> Finiancial overview</a>
                                        </li>
                                        <li class="nav-item">
                                            <a class="nav-link" data-bs-toggle="tab" href="#message"><i class="la la-envelope me-2"></i> Payments</a>
                                        </li> -->
                                    </ul>
                                    <div class="tab-content">
                                        <!-- <div class="tab-pane fade show active" id="home" role="tabpanel">
                                            <div class="pt-4">
                                                <h4>This is home title</h4>
                                                <p>Far far away, behind the word mountains, far from the countries Vokalia and Consonantia, there live the blind texts. Separated they live in Bookmarksgrove.
                                                </p>
                                                <p>Far far away, behind the word mountains, far from the countries Vokalia and Consonantia, there live the blind texts. Separated they live in Bookmarksgrove.
                                                </p>
                                            </div>
                                        </div> -->
                                        <div class="tab-pane fade show active" id="lead-details-tab-pane">

                                            <div id="quotationLeadDetailsSection">
                                                <div class="text-center py-5">
                                                    <div class="spinner-border text-primary"></div>
                                                    <p class="mt-2 mb-0">Loading lead details...</p>
                                                </div>
                                            </div>

                                            <div class="mt-4" id="quotationAccommodationSection">
                                                <div class="text-center py-5">
                                                    <div class="spinner-border text-primary"></div>
                                                    <p class="mt-2 mb-0">Loading accommodation details...</p>
                                                </div>
                                            </div>

                                        </div>
                                        <div class="tab-pane fade" id="clientConfirmationTab">
                                            <div class="pt-4">

                                                <div class="card border-0 shadow-sm">
                                                    <div class="card-header bg-white d-flex justify-content-between align-items-center flex-wrap gap-2">
                                                        <h5 class="mb-0 fw-bold">Client Confirmation</h5>
                                                        <div class="d-flex gap-2 align-items-center">
                                                            <button type="button" class="btn d-none" id="copyExportConfirmationBtn" style="
                                                                background: linear-gradient(135deg, #11998e 0%, #38ef7d 100%);
                                                                color: white; border: none; padding: 8px 18px; font-size: 13px;
                                                                font-weight: 600; border-radius: 6px; box-shadow: 0 4px 6px rgba(0,0,0,0.1);
                                                                transition: all 0.3s ease; cursor: pointer;
                                                            " onmouseover="this.style.transform='translateY(-2px)';this.style.boxShadow='0 6px 12px rgba(17,153,142,0.4)';" onmouseout="this.style.transform='translateY(0)';this.style.boxShadow='0 4px 6px rgba(0,0,0,0.1)';">
                                                                <i class="fas fa-file-export me-2"></i> View / Copy / Export Confirmation
                                                            </button>
                                                        </div>
                                                    </div>

                                                    <div class="card-body">
                                                        <div class="row mb-3">
                                                            <div class="col-md-5">
                                                                <div class="input-group">
                                                                    <span class="input-group-text bg-light border-end-0"><i class="fas fa-search text-muted"></i></span>
                                                                    <input type="text" id="confirmationOptionSearch" class="form-control border-start-0" placeholder="Search options...">
                                                                </div>
                                                            </div>
                                                        </div>

                                                        <div id="confirmationOptionSummary">
                                                            <div class="alert alert-info mb-0">Loading options...</div>
                                                        </div>
                                                    </div>
                                                </div>

                                            </div>
                                        </div>
                                        <div class="tab-pane fade" id="propertyReservationTab">
                                            <div class="pt-4">
                                                <div class="card border-0 shadow-sm">
                                                    <div class="card-header bg-white d-flex justify-content-between align-items-center flex-wrap gap-2">
                                                        <div class="d-flex align-items-center gap-3">
                                                            <h5 class="mb-0 fw-bold">Property Reservation</h5>
                                                            <div id="propertyStatusCounts"></div>
                                                        </div>
                                                        <button type="button" id="copyPropertyReservationBtn" style="
                                                            background: linear-gradient(135deg, #11998e 0%, #38ef7d 100%);
                                                            color: white;
                                                            border: none;
                                                            padding: 10px 20px;
                                                            font-size: 14px;
                                                            font-weight: 600;
                                                            border-radius: 6px;
                                                            box-shadow: 0 4px 6px rgba(0,0,0,0.1);
                                                            transition: all 0.3s ease;
                                                            cursor: pointer;
                                                        " onmouseover="this.style.transform='translateY(-2px)';this.style.boxShadow='0 6px 12px rgba(17,153,142,0.4)';" onmouseout="this.style.transform='translateY(0)';this.style.boxShadow='0 4px 6px rgba(0,0,0,0.1)';">
                                                            <i class="fas fa-file-export me-2"></i> Copy Property Reservation
                                                        </button>
                                                    </div>
                                                    <div class="card-body">
                                                        <div id="propertyStatusTable">
                                                            <div class="text-center py-4">
                                                                <div class="spinner-border text-primary"></div>
                                                                <p class="mt-2 mb-0">Loading...</p>
                                                            </div>
                                                        </div>
                                                    </div>
                                                </div>
                                            </div>
                                        </div>

                                        
                                        <div class="tab-pane fade" id="financialPostingTab">
                                            <div class="pt-4">
                                                <div class="card border-0 shadow-sm">
                                                    <div class="card-header fp-card-header d-flex justify-content-between align-items-center flex-wrap gap-2">
                                                        <h5 class="mb-0 fw-bold"><i class="la la-file-invoice-dollar me-2"></i>Financial Posting</h5>
                                                        <div class="d-flex gap-2">
                                                            <button type="button" class="btn btn-info btn-sm" onclick="fpSubmit()"><i class="la la-save me-1"></i>Submit</button>
                                                            <button type="button" class="btn btn-secondary btn-sm" onclick="fpReset()"><i class="la la-refresh me-1"></i>Reset</button>
                                                        </div>
                                                    </div>
                                                    <div class="card-body">
                                                        <input type="hidden" id="fp_leads_id" value="">
                                                        <input type="hidden" id="fp_record_id" value="">
                                                        <div class="table-responsive">
                                                            <table class="table table-bordered align-middle fp-table" id="fpHubTable">
                                                                <thead class="table-info">
                                                                    <tr>
                                                                        <th style="width:30%">Item</th>
                                                                        <th style="width:20%">Quoted Amount</th>
                                                                        <th style="width:20%">Actual Amount</th>
                                                                        <th>Description</th>
                                                                        <th style="width:40px"></th>
                                                                    </tr>
                                                                </thead>
                                                                <tbody>
                                                                    <!-- Driver quote amount -->
                                                                    <tr class="table-light fp-label" id="fpDriverRow">
                                                                        <td class="fw-bold">Driver Quote Amount</td>
                                                                        <td><input type="number" class="form-control form-control-sm fp-quoted" name="fp_driver_quoted" placeholder="0.00" min="0" step="0.01" readonly></td>
                                                                        <td><input type="number" class="form-control form-control-sm fp-actual" name="fp_driver_actual" placeholder="0.00" min="0" step="0.01"></td>
                                                                        <td><input type="text" class="form-control form-control-sm" name="fp_driver_desc" placeholder="Description"></td>
                                                                        <td></td>
                                                                    </tr>
                                                                    <!-- Day-based rows will be inserted here dynamically -->
                                                                    <!-- Other expense header -->
                                                                    <tr id="fpOtherExpHeader">
                                                                        <td colspan="5" class="fp-section-header">
                                                                            Other Expenses — <button type="button" class="btn btn-sm btn-info" onclick="fpAddExpense()"><i class="la la-plus me-1"></i>Add Expense</button>
                                                                        </td>
                                                                    </tr>
                                                                    <!-- Totals -->
                                                                    <tr class="table-info fw-bold fp-total" id="fpActualCostRow">
                                                                        <td>Actual Cost <small class="text-muted fw-normal">(sum of Expected)</small></td>
                                                                        <td colspan="3"><span id="fpActualCost">0.00</span></td>
                                                                        <td></td>
                                                                    </tr>
                                                                    <tr class="table-info fw-bold fp-total" id="fpCostAfterRow">
                                                                        <td>Cost After Financial Post <small class="text-muted fw-normal">(sum of Actual)</small></td>
                                                                        <td colspan="3"><span id="fpCostAfterPost">0.00</span></td>
                                                                        <td></td>
                                                                    </tr>
                                                                    <!-- Margin -->
                                                                    <tr class="table-light fp-label" id="fpMarginRow">
                                                                        <td class="fw-bold">Margin</td>
                                                                        <td colspan="3"><span id="fpMargin" class="fw-bold text-secondary">0.00</span></td>
                                                                        <td></td>
                                                                    </tr>
                                                                    <!-- Total After Margin -->
                                                                    <tr class="table-info fw-bold fp-total" id="fpTotalAfterMarginRow">
                                                                        <td>Total <small class="text-muted fw-normal">(Actual + Margin)</small></td>
                                                                        <td colspan="3"><span id="fpTotalAfterMargin">0.00</span></td>
                                                                        <td></td>
                                                                    </tr>
                                                                    <!-- Pre quoted amount (reference) -->
                                                                    <tr class="table-light fp-label" id="fpPreQuotedRow">
                                                                        <td class="fw-bold">Pre Quoted Amount</td>
                                                                        <td colspan="3"><span id="fpPreQuotedAmount" class="fw-bold text-primary">0.00</span></td>
                                                                        <td></td>
                                                                    </tr>
                                                                    <!-- Total margin -->
                                                                    <tr class="table-light fp-label" id="fpDifferenceRow">
                                                                        <td class="fw-bold">Total margin <small class="text-muted fw-normal">(Pre quoted - Total)</small></td>
                                                                        <td colspan="3"><span id="fpDifference" class="fw-bold" style="font-size:1.25rem;">0.00</span></td>
                                                                        <td></td>
                                                                    </tr>
                                                                    <!-- Description -->
                                                                    <tr class="table-light fp-label" id="fpNotesRow">
                                                                        <td class="fw-bold">Description / Notes</td>
                                                                        <td colspan="3"><textarea class="form-control" id="fpNotes" name="fp_notes" rows="2" placeholder="Enter overall description"></textarea></td>
                                                                        <td></td>
                                                                    </tr>
                                                                </tbody>
                                                            </table>
                                                        </div>
                                                    </div>
                                                </div>
                                            </div>
                                        </div>
                                        <div class="tab-pane fade" id="receiptSchedulerTab">
                                            <div class="pt-3">
                                                <div class="d-flex justify-content-between align-items-center mb-3">
                                                    <h5 class="mb-0 fw-bold">Receipt Scheduler - Payment Schedules</h5>
                                                    <button onclick="hub_add_scheduler()" class="btn btn-rounded btn-primary btn-sm">+ Create Payment Schedule</button>
                                                </div>

                                                <div class="table-responsive">
                                                    <table id="hub_scheduler_table" class="display" style="min-width: 845px">
                                                        <thead>
                                                            <tr>
                                                                <th>Sl.no</th>
                                                                <th>Quotation #</th>
                                                                <th>Guest Name</th>
                                                                <th>Payment Type</th>
                                                                <th>Total Amount</th>
                                                                <th>EMI Count</th>
                                                                <th>Created Date</th>
                                                                <th>Action</th>
                                                            </tr>
                                                        </thead>
                                                        <tbody></tbody>
                                                    </table>
                                                </div>
                                            </div>
                                        </div>
                                        <!-- Removed old message tab pane -->
                                    </div>
                                </div>
                            </div>
                        </div>
                    </div>
                </div>
                
            </div>
        </div>
        <!-- ===== Hotel Reservation Status Modal ===== -->
        <div class="modal fade" id="hubReservationModal" tabindex="-1" aria-hidden="true" data-bs-backdrop="static">
            <div class="modal-dialog modal-xl modal-dialog-scrollable">
                <div class="modal-content" style="border:none;border-radius:12px;overflow:hidden;">

                    <div class="modal-header" style="background:linear-gradient(90deg,#6f6af8,#8a85ff);border:none;padding:16px 24px;">
                        <h5 class="modal-title text-white fw-bold mb-0"><i class="la la-hotel me-2"></i>Hotel Reservation Status</h5>
                        <button type="button" class="btn-close btn-close-white" data-bs-dismiss="modal"></button>
                    </div>

                    <div class="modal-body" style="background:#f8f9fb;padding:24px;">
                        <div id="hubResModalLoader" class="text-center py-5">
                            <div class="spinner-border text-primary"></div>
                            <p class="mt-2 text-muted">Loading reservation...</p>
                        </div>

                        <div id="hubResModalContent" style="display:none;">
                            <input type="hidden" id="hub_property_reservation_id">

                            <!-- Info Boxes -->
                            <div class="row g-3 mb-3">
                                <div class="col-md-4">
                                    <div style="border:1px solid #e5e7eb;border-radius:10px;padding:14px 16px;background:#fff;">
                                        <div style="color:#6b7280;font-size:11px;font-weight:700;text-transform:uppercase;letter-spacing:0.5px;">Property</div>
                                        <div style="color:#111827;font-weight:700;font-size:15px;margin-top:4px;" id="hub_info_property">-</div>
                                    </div>
                                </div>
                                <div class="col-md-4">
                                    <div style="border:1px solid #e5e7eb;border-radius:10px;padding:14px 16px;background:#fff;">
                                        <div style="color:#6b7280;font-size:11px;font-weight:700;text-transform:uppercase;letter-spacing:0.5px;">Guest</div>
                                        <div style="color:#111827;font-weight:700;font-size:15px;margin-top:4px;" id="hub_info_guest">-</div>
                                    </div>
                                </div>
                                <div class="col-md-4">
                                    <div style="border:1px solid #e5e7eb;border-radius:10px;padding:14px 16px;background:#fff;">
                                        <div style="color:#6b7280;font-size:11px;font-weight:700;text-transform:uppercase;letter-spacing:0.5px;">Booking No</div>
                                        <div style="color:#111827;font-weight:700;font-size:15px;margin-top:4px;" id="hub_info_booking">-</div>
                                    </div>
                                </div>
                            </div>
                            <div class="row g-3 mb-4">
                                <div class="col-md-4">
                                    <div style="border:1px solid #e5e7eb;border-radius:10px;padding:14px 16px;background:#fff;">
                                        <div style="color:#6b7280;font-size:11px;font-weight:700;text-transform:uppercase;letter-spacing:0.5px;">Check In</div>
                                        <div style="color:#111827;font-weight:700;font-size:15px;margin-top:4px;" id="hub_info_checkin">-</div>
                                    </div>
                                </div>
                                <div class="col-md-4">
                                    <div style="border:1px solid #e5e7eb;border-radius:10px;padding:14px 16px;background:#fff;">
                                        <div style="color:#6b7280;font-size:11px;font-weight:700;text-transform:uppercase;letter-spacing:0.5px;">Check Out</div>
                                        <div style="color:#111827;font-weight:700;font-size:15px;margin-top:4px;" id="hub_info_checkout">-</div>
                                    </div>
                                </div>
                                <div class="col-md-4">
                                    <div style="border:1px solid #e5e7eb;border-radius:10px;padding:14px 16px;background:#fff;">
                                        <div style="color:#6b7280;font-size:11px;font-weight:700;text-transform:uppercase;letter-spacing:0.5px;">Duration</div>
                                        <div style="color:#111827;font-weight:700;font-size:15px;margin-top:4px;" id="hub_info_duration">-</div>
                                    </div>
                                </div>
                            </div>

                            <!-- Property Rent + Property-based Inclusions -->
                            <div class="row g-3 mb-4">
                                <div class="col-md-4">
                                    <div style="border:1px solid #e5e7eb;border-radius:10px;padding:14px 16px;background:#fff;height:100%;">
                                        <div style="color:#6b7280;font-size:11px;font-weight:700;text-transform:uppercase;letter-spacing:0.5px;">Property Rent</div>
                                        <div style="color:#111827;font-weight:700;font-size:15px;margin-top:4px;">INR <span id="hub_rent_breakdown_total">0.00</span></div>
                                    </div>
                                </div>
                                <div class="col-md-8">
                                    <div style="border:1px solid #e5e7eb;border-radius:10px;padding:14px 16px;background:#fff;height:100%;">
                                        <div style="color:#6b7280;font-size:11px;font-weight:700;text-transform:uppercase;letter-spacing:0.5px;">Property-based Inclusions</div>
                                        <div id="hub_inclusions_detail_list" style="color:#111827;font-weight:500;font-size:14px;margin-top:4px;">-</div>
                                    </div>
                                </div>
                            </div>

                            <!-- Accordion -->
                            <div class="accordion" id="hubResAccordion" style="border-radius:10px;overflow:hidden;box-shadow:0 1px 4px rgba(0,0,0,0.08);">

                                <!-- Level 1: Hotel Blocking -->
                                <div class="accordion-item" style="border:none;border-bottom:1px solid #f0f0f0;">
                                    <h2 class="accordion-header">
                                        <button class="accordion-button collapsed fw-bold" type="button" data-bs-toggle="collapse" data-bs-target="#hubResBlockingCollapse" style="background:#fff;color:#111827;font-size:14px;">
                                            <i class="la la-lock me-2 text-primary"></i> Hotel Blocking Details
                                            <span class="badge rounded-pill bg-secondary ms-2" id="hub_pill_blocking" style="font-size:11px;">PENDING</span>
                                        </button>
                                    </h2>
                                    <div id="hubResBlockingCollapse" class="accordion-collapse collapse" data-bs-parent="#hubResAccordion">
                                        <div class="accordion-body" style="background:#fafafa;">
                                            <form id="hub_blockingForm">
                                                <div class="row g-3">
                                                    <div class="col-md-4">
                                                        <label class="form-label fw-semibold">CNFM By</label>
                                                        <input type="text" class="form-control" name="blocking_cnfm_by" id="hub_blocking_cnfm_by" placeholder="Confirmed by">
                                                    </div>
                                                    <div class="col-md-4">
                                                        <label class="form-label fw-semibold">Cut-off Date</label>
                                                        <input type="text" class="form-control" name="blocking_cutoff_date" id="hub_blocking_cutoff_date" placeholder="dd/mm/yyyy" autocomplete="off">
                                                    </div>
                                                    <div class="col-md-4">
                                                        <label class="form-label fw-semibold">Blocked Date</label>
                                                        <input type="text" class="form-control" name="blocking_date" id="hub_blocking_date" placeholder="dd/mm/yyyy" autocomplete="off">
                                                    </div>
                                                </div>
                                                <div class="mt-3 text-end">
                                                    <button type="button" class="btn btn-primary btn-sm px-4" onclick="hubSaveBlocking()"><i class="la la-save me-1"></i>Save Blocking</button>
                                                </div>
                                            </form>
                                        </div>
                                    </div>
                                </div>

                                <!-- Level 2: Reservation Confirmation -->
                                <div class="accordion-item" style="border:none;border-bottom:1px solid #f0f0f0;">
                                    <h2 class="accordion-header">
                                        <button class="accordion-button collapsed fw-bold" type="button" data-bs-toggle="collapse" data-bs-target="#hubResConfirmCollapse" style="background:#fff;color:#111827;font-size:14px;">
                                            <i class="la la-check-circle me-2 text-success"></i> Reservation Confirmation Details
                                            <span class="badge rounded-pill bg-secondary ms-2" id="hub_pill_confirm" style="font-size:11px;">PENDING</span>
                                        </button>
                                    </h2>
                                    <div id="hubResConfirmCollapse" class="accordion-collapse collapse" data-bs-parent="#hubResAccordion">
                                        <div class="accordion-body" style="background:#fafafa;">
                                            <form id="hub_confirmForm">
                                                <div class="row g-3 mb-3">
                                                    <div class="col-md-4">
                                                        <label class="form-label fw-semibold">CNFM By</label>
                                                        <input type="text" class="form-control" name="confirmation_cnfm_by" id="hub_confirmation_cnfm_by" placeholder="Confirmed by">
                                                    </div>
                                                    <div class="col-md-4">
                                                        <label class="form-label fw-semibold">CNFM No</label>
                                                        <input type="text" class="form-control" name="confirmation_cnfm_no" id="hub_confirmation_cnfm_no" placeholder="Confirmation number">
                                                    </div>
                                                    <div class="col-md-4">
                                                        <label class="form-label fw-semibold">CNFM Date</label>
                                                        <input type="text" class="form-control" name="confirmation_cnfm_date" id="hub_confirmation_cnfm_date" placeholder="dd/mm/yyyy" autocomplete="off">
                                                    </div>
                                                </div>
                                                <!-- Payment Scheduler -->
                                                <div style="border-radius:8px;overflow:hidden;border:1px solid #e5e7eb;">
                                                    <div style="background:linear-gradient(90deg,#6f6af8,#8a85ff);color:#fff;padding:10px 16px;font-weight:700;font-size:13px;">
                                                        <i class="la la-credit-card me-2"></i>Payment Scheduler
                                                    </div>
                                                    <div class="p-3">
                                                        <div class="d-flex justify-content-between align-items-center flex-wrap mb-3">
                                                            <div>
                                                                <div class="fw-bold mb-1" style="font-size:13px;">Select Payment Terms</div>
                                                                <div class="form-check form-check-inline">
                                                                    <input class="form-check-input" type="radio" name="hub_payment_type" id="hub_pt_full" value="FULL" onchange="hubTogglePaymentType()">
                                                                    <label class="form-check-label" for="hub_pt_full">On Account</label>
                                                                </div>
                                                                <div class="form-check form-check-inline">
                                                                    <input class="form-check-input" type="radio" name="hub_payment_type" id="hub_pt_emi" value="EMI" onchange="hubTogglePaymentType()">
                                                                    <label class="form-check-label" for="hub_pt_emi">In Installments</label>
                                                                </div>
                                                            </div>
                                                            <div class="text-end">
                                                                <div class="text-muted" style="font-size:12px;">Hotel Rent: <span class="fw-semibold text-dark">INR <span id="hub_rent_amount_display">0</span></span></div>
                                                                <div class="text-muted" style="font-size:12px;">Property Inclusions: <span class="fw-semibold text-dark">INR <span id="hub_inclusion_amount_display">0</span></span></div>
                                                                <div class="text-muted mt-1" style="font-size:12px;">Total Amount</div>
                                                                <div class="fw-bold" style="font-size:20px;">INR <span id="hub_payment_total_display">0</span></div>
                                                                <input type="hidden" name="total_amount" id="hub_res_total_amount" value="0">
                                                                <input type="hidden" id="hub_rent_amount" value="0">
                                                                <input type="hidden" id="hub_inclusion_amount" value="0">
                                                                <div class="mt-2 d-flex align-items-center justify-content-end gap-2">
                                                                    <label class="form-label mb-0 text-muted" style="font-size:12px;">Discount</label>
                                                                    <input type="number" min="0" step="0.01" class="form-control form-control-sm" id="hub_discount_amount" name="discount_amount" value="0" style="width:110px;" oninput="hub_applyDiscount()">
                                                                    <input type="hidden" id="hub_discounted_total" name="discounted_total" value="0">
                                                                </div>
                                                                <div class="mt-1 fw-bold text-success" id="hub_discounted_total_display" style="display:none;font-size:13px;">Net Payable: INR <span id="hub_discounted_total_val">0</span></div>
                                                            </div>
                                                        </div>
                                                        <div id="hub_res_fullSection" style="display:none;">
                                                            <div class="row g-3">
                                                                <div class="col-md-4">
                                                                    <label class="form-label fw-semibold">Payment Cut-off Date</label>
                                                                    <input type="text" class="form-control" id="hub_res_cutoff_date_display" placeholder="dd/mm/yyyy" autocomplete="off">
                                                                    <input type="hidden" name="cutoff_date" id="hub_res_cutoff_date">
                                                                </div>
                                                            </div>
                                                        </div>
                                                        <div id="hub_res_emiSection" style="display:none;">
                                                            <div class="row g-3 mb-3">
                                                                <div class="col-md-3">
                                                                    <label class="form-label fw-semibold">No. of Installments</label>
                                                                    <input type="number" min="2" max="24" value="2" class="form-control" id="hub_res_max_emi_count" name="max_emi_count" onchange="hubGenerateEmiRows()">
                                                                </div>
                                                                <div class="col-md-3">
                                                                    <label class="form-label fw-semibold">Split By</label>
                                                                    <select class="form-control" id="hub_split_type_res" name="split_type" onchange="hubGenerateEmiRows()">
                                                                        <option value="AMOUNT">Fixed Amount</option>
                                                                        <option value="PERCENTAGE">Percentage</option>
                                                                    </select>
                                                                </div>
                                                            </div>
                                                            <div class="table-responsive">
                                                                <table class="table table-bordered table-sm">
                                                                    <thead class="table-light">
                                                                        <tr>
                                                                            <th width="60">#</th>
                                                                            <th id="hub_res_emiValHeader">Amount</th>
                                                                            <th width="150">Due Date</th>
                                                                            <th width="130">Calculated</th>
                                                                        </tr>
                                                                    </thead>
                                                                    <tbody id="hub_res_emiTableBody"></tbody>
                                                                    <tfoot>
                                                                        <tr class="table-warning">
                                                                            <td colspan="3" class="text-end fw-bold">Total</td>
                                                                            <td id="hub_res_emiCalcTotal">0.00</td>
                                                                        </tr>
                                                                    </tfoot>
                                                                </table>
                                                            </div>
                                                        </div>
                                                    </div>
                                                </div>
                                                <div class="mt-3 d-flex gap-2 justify-content-end">
                                                    <button type="button" class="btn btn-info btn-sm px-3" id="hub_btn_view_payments" style="display:none!important;" onclick="hubPrViewPaymentSummary()"><i class="fas fa-eye"></i> View Payments</button>
                                                    <button type="button" class="btn btn-success btn-sm px-4" onclick="hubSaveConfirmation()"><i class="la la-save me-1"></i>Save Confirmation</button>
                                                </div>
                                            </form>
                                        </div>
                                    </div>
                                </div>

                                <!-- Level 3: Re-confirmation -->
                                <div class="accordion-item" style="border:none;border-bottom:1px solid #f0f0f0;">
                                    <h2 class="accordion-header">
                                        <button class="accordion-button collapsed fw-bold" type="button" data-bs-toggle="collapse" data-bs-target="#hubResReconCollapse" style="background:#fff;color:#111827;font-size:14px;">
                                            <i class="la la-redo me-2 text-warning"></i> Re-confirmation Details
                                            <span class="badge rounded-pill bg-secondary ms-2" id="hub_pill_recon" style="font-size:11px;">PENDING</span>
                                        </button>
                                    </h2>
                                    <div id="hubResReconCollapse" class="accordion-collapse collapse" data-bs-parent="#hubResAccordion">
                                        <div class="accordion-body" style="background:#fafafa;">
                                            <form id="hub_reconForm">
                                                <div class="row g-3">
                                                    <div class="col-md-4">
                                                        <label class="form-label fw-semibold">CNFM By</label>
                                                        <input type="text" class="form-control" name="reconfirmation_cnfm_by" id="hub_reconfirmation_cnfm_by" placeholder="Confirmed by">
                                                    </div>
                                                    <div class="col-md-4">
                                                        <label class="form-label fw-semibold">CNFM No</label>
                                                        <input type="text" class="form-control" name="reconfirmation_cnfm_no" id="hub_reconfirmation_cnfm_no" placeholder="Confirmation number" readonly>
                                                    </div>
                                                    <div class="col-md-4">
                                                        <label class="form-label fw-semibold">RE-CNFM Date</label>
                                                        <input type="text" class="form-control" name="reconfirmation_date" id="hub_reconfirmation_date" placeholder="dd/mm/yyyy" autocomplete="off">
                                                    </div>
                                                </div>
                                                <div class="mt-3 text-end">
                                                    <button type="button" class="btn btn-warning btn-sm px-4" onclick="hubSaveReconfirmation()"><i class="la la-save me-1"></i>Save Re-confirmation</button>
                                                </div>
                                            </form>
                                        </div>
                                    </div>
                                </div>

                                <!-- Comments -->
                                <div class="accordion-item" style="border:none;">
                                    <h2 class="accordion-header">
                                        <button class="accordion-button collapsed fw-bold" type="button" data-bs-toggle="collapse" data-bs-target="#hubResCommentsCollapse" style="background:#fff;color:#111827;font-size:14px;">
                                            <i class="la la-comment me-2 text-info"></i> Comments
                                        </button>
                                    </h2>
                                    <div id="hubResCommentsCollapse" class="accordion-collapse collapse" data-bs-parent="#hubResAccordion">
                                        <div class="accordion-body" style="background:#fafafa;">
                                            <div class="input-group mb-3">
                                                <input type="text" class="form-control" id="hub_comment_text" placeholder="Add a comment...">
                                                <button class="btn btn-primary" type="button" onclick="hubAddComment()"><i class="la la-plus me-1"></i>Add</button>
                                            </div>
                                            <ul class="list-group list-group-flush" id="hub_commentsList">
                                                <li class="list-group-item text-muted">No comments yet.</li>
                                            </ul>
                                        </div>
                                    </div>
                                </div>

                            </div><!-- /accordion -->
                        </div><!-- /hubResModalContent -->
                    </div><!-- /modal-body -->

                </div>
            </div>
        </div>
        <!-- ===== END Hotel Reservation Status Modal ===== -->

        <!-- Generate Quotation Modal -->
        <div class="modal fade" id="generateQuotationModal" tabindex="-1" aria-labelledby="generateQuotationModalLabel" aria-hidden="true">
            <div class="modal-dialog modal-dialog-centered">
                <div class="modal-content">
                    <div class="modal-header">
                        <h5 class="modal-title" id="generateQuotationModalLabel">Generate Quotation</h5>
                        <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
                    </div>
                    <div class="modal-body">
                        <p>Are you sure you want to generate this quotation?</p>
                        <p class="text-muted">This will change the quotation status from <strong>Draft/Sent/Rejected</strong> to <strong>Generated</strong>.</p>
                    </div>
                    <div class="modal-footer">
                        <button type="button" class="btn btn-secondary" data-bs-dismiss="modal">Cancel</button>
                        <button type="button" class="btn btn-primary" id="btnGenerateYes">Yes, Generate</button>
                    </div>
                </div>
            </div>
        </div>

        <!-- Confirm Quotation Modal -->
        <div class="modal fade" id="confirmQuotationModal" tabindex="-1" aria-labelledby="confirmQuotationModalLabel" aria-hidden="true">
            <div class="modal-dialog modal-dialog-centered">
                <div class="modal-content">
                    <div class="modal-header">
                        <h5 class="modal-title" id="confirmQuotationModalLabel">Confirm Quotation</h5>
                        <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
                    </div>
                    <div class="modal-body">
                        <p>Are you sure you want to confirm this quotation?</p>
                        <p class="text-muted">This will change the quotation status from <strong>Generated</strong> to <strong>Confirmed</strong>.</p>
                        <p class="text-warning"><i class="la la-info-circle"></i> Voucher and itinerary tabs will be enabled once all property reservations are marked as completed.</p>
                    </div>
                    <div class="modal-footer">
                        <button type="button" class="btn btn-secondary" data-bs-dismiss="modal">Cancel</button>
                        <button type="button" class="btn btn-success" id="btnConfirmYes">Yes, Confirm</button>
                    </div>
                </div>
            </div>
        </div>

        <!-- Mark Reservation Completed Modal -->
        <div class="modal fade" id="markReservationCompletedModal" tabindex="-1" aria-labelledby="markReservationCompletedModalLabel" aria-hidden="true">
            <div class="modal-dialog modal-dialog-centered">
                <div class="modal-content">
                    <div class="modal-header">
                        <h5 class="modal-title" id="markReservationCompletedModalLabel">Mark Reservation Completed</h5>
                        <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
                    </div>
                    <div class="modal-body">
                        <p>Are you sure you want to mark property reservations as completed?</p>
                        <p class="text-muted">This will change the status to <strong>Reservation Completed</strong> and enable all voucher and itinerary tabs.</p>
                    </div>
                    <div class="modal-footer">
                        <button type="button" class="btn btn-secondary" data-bs-dismiss="modal">Cancel</button>
                        <button type="button" class="btn btn-success" id="btnMarkReservationCompletedYes">Yes, Mark Completed</button>
                    </div>
                </div>
            </div>
        </div>

        <!-- Confirmation Submit Modal -->
        <div class="modal fade" id="confirmationSubmitModal" tabindex="-1" aria-labelledby="confirmationSubmitModalLabel" aria-hidden="true">
            <div class="modal-dialog modal-dialog-centered">
                <div class="modal-content">
                    <div class="modal-header">
                        <h5 class="modal-title" id="confirmationSubmitModalLabel">Confirm Submission</h5>
                        <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
                    </div>
                    <div class="modal-body">
                        Are you sure you want to submit the client confirmation?
                    </div>
                    <div class="modal-footer">
                        <button type="button" class="btn btn-secondary" data-bs-dismiss="modal">No</button>
                        <button type="button" class="btn btn-primary" id="btnConfirmSubmitYes">Yes, Submit</button>
                    </div>
                </div>
            </div>
        </div>

        <!-- Client Confirmation Option Details Modal -->
        <div class="modal fade" id="confirmationOptionModal" tabindex="-1" aria-hidden="true" data-bs-backdrop="static">
            <div class="modal-dialog modal-xl modal-dialog-scrollable">
                <div class="modal-content" style="border:none;border-radius:12px;overflow:hidden;">
                    <div class="modal-header" style="background:linear-gradient(135deg,#4a3ee0,#5a4ff0);color:#fff;padding:14px 20px;">
                        <h5 class="modal-title fw-bold" id="confirmationOptionModalTitle" style="font-size:16px;color:#fff;">Option Details</h5>
                        <button type="button" class="btn-close btn-close-white" data-bs-dismiss="modal" aria-label="Close"></button>
                    </div>
                    <div class="modal-body p-0" id="confirmationOptionModalBody" style="max-height:70vh;overflow-y:auto;">
                    </div>
                    <div class="modal-footer" style="border-top:1px solid #e5e7eb;">
                        <button type="button" class="btn btn-secondary" data-bs-dismiss="modal">Close</button>
                        <button type="button" class="btn btn-primary" id="btnSubmitConfirmation">
                            <i class="fas fa-check-circle me-1"></i> Submit Confirmation
                        </button>
                    </div>
                </div>
            </div>
        </div>

        <!-- ===== Receipt Scheduler Modals ===== -->

        <!-- Add/Edit Scheduler Modal -->
        <div class="modal fade" id="hub_schedulerModal" role="dialog" data-backdrop="static" data-keyboard="false">
            <div class="modal-dialog" role="document" style="max-width: 850px;">
                <div class="modal-content">
                    <div class="modal-header bg-primary">
                        <h5 class="modal-title text-white" id="hub_schedulerModalTitle">Create Payment Schedule</h5>
                        <button type="button" class="btn-close" data-bs-dismiss="modal"></button>
                    </div>
                    <div class="modal-body">
                        <form id="hub_schedulerForm">
                            <input type="hidden" value="" name="receipt_scheduler_id" id="hub_receipt_scheduler_id"/>
                            <div class="row">
                                <div class="col-md-6">
                                    <div class="mb-3">
                                        <label class="form-label">Quotation <span class="text-danger">*</span></label>
                                        <input type="text" class="form-control" id="hub_quotation_display" readonly>
                                        <input type="hidden" name="quotation_id_fk" id="hub_quotation_id_fk">
                                    </div>
                                </div>
                                <div class="col-md-6">
                                    <div class="mb-3">
                                        <label class="form-label">Total Amount <span class="text-danger">*</span></label>
                                        <input type="number" step="0.01" class="form-control" name="total_amount" id="hub_total_amount" readonly>
                                    </div>
                                </div>
                            </div>
                            <div class="row">
                                <div class="col-md-6">
                                    <div class="mb-3">
                                        <label class="form-label">Payment Type <span class="text-danger">*</span></label>
                                        <select class="form-control" name="payment_type" id="hub_payment_type" required onchange="hub_togglePaymentType()">
                                            <option value="">Select Type</option>
                                            <option value="FULL">Full Payment</option>
                                            <option value="EMI">EMI (Installments)</option>
                                        </select>
                                    </div>
                                </div>
                                <div class="col-md-6">
                                    <div class="mb-3">
                                        <label class="form-label">Remarks</label>
                                        <input type="text" class="form-control" name="receipt_scheduler_remarks" id="hub_receipt_scheduler_remarks">
                                    </div>
                                </div>
                            </div>
                            <!-- Full Payment Section -->
                            <div id="hub_fullPaymentSection" style="display:none;">
                                <div class="option-block" style="margin-bottom:0;">
                                    <div class="option-header" style="background:linear-gradient(135deg,#4a3ee0,#5a4ff0);color:#fff;padding:10px 16px;border-radius:8px 8px 0 0;font-size:15px;font-weight:700;display:flex;justify-content:space-between;align-items:center;">
                                        <span><i class="fas fa-money-bill-wave me-1"></i> Full Payment Details</span>
                                    </div>
                                    <div class="option-body" style="background:#fff;border-radius:0 0 8px 8px;overflow:hidden;box-shadow:0 1px 3px rgba(0,0,0,.08);">
                                        <div class="table-responsive">
                                            <table class="table table-bordered table-sm mb-0">
                                                <thead>
                                                    <tr>
                                                        <th style="width:50%;background:#eef2ff;color:#4a3ee0;font-size:12px;text-transform:uppercase;letter-spacing:.3px;">Description</th>
                                                        <th style="width:50%;background:#eef2ff;color:#4a3ee0;font-size:12px;text-transform:uppercase;letter-spacing:.3px;">Value</th>
                                                    </tr>
                                                </thead>
                                                <tbody>
                                                    <tr>
                                                        <td><strong>Total Amount</strong></td>
                                                        <td class="fw-bold text-success" id="hub_full_total_display">₹0.00</td>
                                                    </tr>
                                                    <tr>
                                                        <td><strong>Cutoff Date <span class="text-danger">*</span></strong></td>
                                                        <td>
                                                            <input type="text" class="form-control form-control-sm" id="hub_cutoff_date" placeholder="dd/mm/yyyy">
                                                            <input type="hidden" name="cutoff_date" id="hub_cutoff_date_hidden">
                                                            <small id="hub_cutoff_date_display" class="text-primary fw-semibold"></small>
                                                        </td>
                                                    </tr>
                                                </tbody>
                                            </table>
                                        </div>
                                    </div>
                                </div>
                            </div>
                            <!-- EMI Section -->
                            <div id="hub_emiSection" style="display:none;">
                                <div class="option-block" style="margin-bottom:0;">
                                    <div class="option-header" style="background:linear-gradient(135deg,#4a3ee0,#5a4ff0);color:#fff;padding:10px 16px;border-radius:8px 8px 0 0;font-size:15px;font-weight:700;display:flex;justify-content:space-between;align-items:center;">
                                        <span><i class="fas fa-calendar-check me-1"></i> EMI Configuration</span>
                                        <span style="background:rgba(255,255,255,.2);padding:4px 12px;border-radius:6px;font-size:14px;font-weight:600;">Total: <span id="hub_emi_total_display">₹0.00</span></span>
                                    </div>
                                    <div class="option-body" style="background:#fff;border-radius:0 0 8px 8px;overflow:hidden;box-shadow:0 1px 3px rgba(0,0,0,.08);padding:16px;">
                                        <div class="row mb-3">
                                            <div class="col-md-4">
                                                <label class="form-label">Maximum EMI Count <span class="text-danger">*</span></label>
                                                <input type="number" min="2" max="24" class="form-control" name="max_emi_count" id="hub_max_emi_count" value="2" onchange="hub_generateEmiRows()">
                                            </div>
                                            <div class="col-md-4">
                                                <label class="form-label">Split By <span class="text-danger">*</span></label>
                                                <select class="form-control" name="split_type" id="hub_split_type" onchange="hub_toggleSplitType()">
                                                    <option value="AMOUNT">Fixed Amount</option>
                                                    <option value="PERCENTAGE">Percentage</option>
                                                </select>
                                            </div>
                                            <div class="col-md-4">
                                                <label class="form-label">&nbsp;</label>
                                                <button type="button" class="btn btn-warning btn-sm d-block" onclick="hub_generateEmiRows()">
                                                    <i class="fas fa-redo"></i> Reset
                                                </button>
                                            </div>
                                        </div>
                                        <div class="table-responsive">
                                            <table class="table table-bordered table-sm mb-0" id="hub_emiTable">
                                                <thead>
                                                    <tr>
                                                        <th width="80" style="background:#eef2ff;color:#4a3ee0;font-size:12px;text-transform:uppercase;letter-spacing:.3px;">EMI #</th>
                                                        <th class="amount-col" id="hub_emiAmountHeader" style="background:#eef2ff;color:#4a3ee0;font-size:12px;text-transform:uppercase;letter-spacing:.3px;">Amount</th>
                                                        <th width="150" style="background:#eef2ff;color:#4a3ee0;font-size:12px;text-transform:uppercase;letter-spacing:.3px;">Due Date</th>
                                                        <th width="120" style="background:#eef2ff;color:#4a3ee0;font-size:12px;text-transform:uppercase;letter-spacing:.3px;">Calculated</th>
                                                    </tr>
                                                </thead>
                                                <tbody id="hub_emiTableBody"></tbody>
                                                <tfoot>
                                                    <tr style="background:#eef2ff;">
                                                        <td><strong>Total</strong></td>
                                                        <td id="hub_emiTotalCol" class="fw-bold">-</td>
                                                        <td>-</td>
                                                        <td id="hub_emiCalculatedTotal" class="fw-bold text-success">0.00</td>
                                                    </tr>
                                                </tfoot>
                                            </table>
                                        </div>
                                    </div>
                                </div>
                            </div>
                        </form>
                    </div>
                    <div class="modal-footer">
                        <button type="button" class="btn btn-danger light" data-bs-dismiss="modal">Close</button>
                        <button type="button" class="btn btn-primary" id="hub_btnSave" onclick="hub_save()">Save</button>
                    </div>
                </div>
            </div>
        </div>

        <!-- View Payment Summary Modal -->
        <div class="modal fade" id="hub_viewModal" role="dialog">
            <div class="modal-dialog" role="document" style="max-width: 900px;">
                <div class="modal-content">
                    <div class="modal-header" style="background:linear-gradient(135deg,#4a3ee0,#5a4ff0);">
                        <h5 class="modal-title text-white"><i class="fas fa-file-invoice-dollar me-1"></i> Payment Schedule Details</h5>
                        <button type="button" class="btn-close" data-bs-dismiss="modal"></button>
                    </div>
                    <div class="modal-body">
                        <!-- Detail Grid -->
                        <div style="border:1px solid #e5e7eb;border-radius:8px;overflow:hidden;margin-bottom:16px;">
                            <div class="row g-0" id="hub_viewDetailGrid">
                                <div class="col-md-3" style="padding:12px 16px;border-bottom:1px solid #e5e7eb;border-right:1px solid #e5e7eb;">
                                    <small style="font-size:11px;color:#6b7280;text-transform:uppercase;letter-spacing:.5px;display:block;margin-bottom:3px;">Quotation No.</small>
                                    <span style="font-size:14px;font-weight:600;" id="hub_view_quotation_number">-</span>
                                </div>
                                <div class="col-md-3" style="padding:12px 16px;border-bottom:1px solid #e5e7eb;border-right:1px solid #e5e7eb;">
                                    <small style="font-size:11px;color:#6b7280;text-transform:uppercase;letter-spacing:.5px;display:block;margin-bottom:3px;">Guest Name</small>
                                    <span style="font-size:14px;font-weight:600;" id="hub_view_guest_name">-</span>
                                </div>
                                <div class="col-md-3" style="padding:12px 16px;border-bottom:1px solid #e5e7eb;border-right:1px solid #e5e7eb;">
                                    <small style="font-size:11px;color:#6b7280;text-transform:uppercase;letter-spacing:.5px;display:block;margin-bottom:3px;">Phone</small>
                                    <span style="font-size:14px;font-weight:600;" id="hub_view_phone">-</span>
                                </div>
                                <div class="col-md-3" style="padding:12px 16px;border-bottom:1px solid #e5e7eb;">
                                    <small style="font-size:11px;color:#6b7280;text-transform:uppercase;letter-spacing:.5px;display:block;margin-bottom:3px;">Payment Type</small>
                                    <span style="font-size:14px;font-weight:600;" id="hub_view_payment_type">-</span>
                                </div>
                                <div class="col-md-12" style="padding:12px 16px;">
                                    <small style="font-size:11px;color:#6b7280;text-transform:uppercase;letter-spacing:.5px;display:block;margin-bottom:3px;">Total Amount</small>
                                    <span style="font-size:18px;font-weight:700;color:#2e7d32;" id="hub_view_total_amount">₹0.00</span>
                                </div>
                            </div>
                        </div>

                        <!-- Summary Cards -->
                        <div class="row mb-3">
                            <div class="col-md-3">
                                <div style="background:#fff;border-radius:8px;padding:14px 16px;text-align:center;box-shadow:0 1px 3px rgba(0,0,0,.08);border:1px solid #e5e7eb;">
                                    <div style="font-size:11px;text-transform:uppercase;letter-spacing:.5px;color:#6b7280;margin-bottom:6px;">Total</div>
                                    <div style="font-size:18px;font-weight:700;color:#64748b;" id="hub_view_total_card">₹0.00</div>
                                </div>
                            </div>
                            <div class="col-md-3">
                                <div style="background:linear-gradient(135deg,#2e7d32,#388e3c);border-radius:8px;padding:14px 16px;text-align:center;box-shadow:0 1px 3px rgba(0,0,0,.08);">
                                    <div style="font-size:11px;text-transform:uppercase;letter-spacing:.5px;color:rgba(255,255,255,.8);margin-bottom:6px;">Paid</div>
                                    <div style="font-size:18px;font-weight:700;color:#fff;" id="hub_view_paid_amount">₹0.00</div>
                                </div>
                            </div>
                            <div class="col-md-3">
                                <div style="background:linear-gradient(135deg,#f59e0b,#d97706);border-radius:8px;padding:14px 16px;text-align:center;box-shadow:0 1px 3px rgba(0,0,0,.08);">
                                    <div style="font-size:11px;text-transform:uppercase;letter-spacing:.5px;color:rgba(255,255,255,.8);margin-bottom:6px;">Pending</div>
                                    <div style="font-size:18px;font-weight:700;color:#fff;" id="hub_view_pending_amount">₹0.00</div>
                                </div>
                            </div>
                            <div class="col-md-3">
                                <div style="background:linear-gradient(135deg,#dc2626,#b91c1c);border-radius:8px;padding:14px 16px;text-align:center;box-shadow:0 1px 3px rgba(0,0,0,.08);">
                                    <div style="font-size:11px;text-transform:uppercase;letter-spacing:.5px;color:rgba(255,255,255,.8);margin-bottom:6px;">Overdue</div>
                                    <div style="font-size:18px;font-weight:700;color:#fff;" id="hub_view_overdue_count">0</div>
                                </div>
                            </div>
                        </div>

                        <!-- Installments Table -->
                        <div class="option-block" style="margin-bottom:0;">
                            <div style="background:linear-gradient(135deg,#4a3ee0,#5a4ff0);color:#fff;padding:10px 16px;border-radius:8px 8px 0 0;font-size:15px;font-weight:700;">
                                <i class="fas fa-list me-1"></i> Installments
                            </div>
                            <div style="background:#fff;border-radius:0 0 8px 8px;overflow:hidden;box-shadow:0 1px 3px rgba(0,0,0,.08);">
                                <div class="table-responsive">
                                    <table class="table table-bordered table-sm mb-0" id="hub_viewInstallmentsTable">
                                        <thead>
                                            <tr>
                                                <th style="background:#eef2ff;color:#4a3ee0;font-size:12px;text-transform:uppercase;letter-spacing:.3px;">#</th>
                                                <th style="background:#eef2ff;color:#4a3ee0;font-size:12px;text-transform:uppercase;letter-spacing:.3px;">Due Date</th>
                                                <th style="background:#eef2ff;color:#4a3ee0;font-size:12px;text-transform:uppercase;letter-spacing:.3px;">Amount</th>
                                                <th style="background:#eef2ff;color:#4a3ee0;font-size:12px;text-transform:uppercase;letter-spacing:.3px;">Paid</th>
                                                <th style="background:#eef2ff;color:#4a3ee0;font-size:12px;text-transform:uppercase;letter-spacing:.3px;">Status</th>
                                                <th style="background:#eef2ff;color:#4a3ee0;font-size:12px;text-transform:uppercase;letter-spacing:.3px;">Action</th>
                                            </tr>
                                        </thead>
                                        <tbody id="hub_viewInstallmentsBody"></tbody>
                                    </table>
                                </div>
                            </div>
                        </div>
                    </div>
                    <div class="modal-footer">
                        <button type="button" class="btn btn-secondary" data-bs-dismiss="modal">Close</button>
                    </div>
                </div>
            </div>
        </div>

        <!-- Payment History Modal -->
        <div class="modal fade" id="hub_receiptsModal" role="dialog">
            <div class="modal-dialog" role="document" style="max-width: 650px;">
                <div class="modal-content">
                    <div class="modal-header">
                        <h5 class="modal-title">Payment History</h5>
                        <button type="button" class="btn-close" data-bs-dismiss="modal"></button>
                    </div>
                    <div class="modal-body">
                        <div class="table-responsive">
                            <table class="table table-bordered table-sm">
                                <thead class="table-light">
                                    <tr>
                                        <th>Date</th>
                                        <th>Amount</th>
                                        <th>Method</th>
                                        <th>Reference</th>
                                        <th>Received By</th>
                                        <th>Approved by Accounts</th>
                                        <th width="120">Action</th>
                                    </tr>
                                </thead>
                                <tbody id="hub_receiptsTableBody"></tbody>
                            </table>
                        </div>
                    </div>
                    <div class="modal-footer">
                        <button type="button" class="btn btn-secondary" data-bs-dismiss="modal">Close</button>
                    </div>
                </div>
            </div>
        </div>

        <!-- Record Payment Modal -->
        <div class="modal fade" id="hub_paymentModal" role="dialog">
            <div class="modal-dialog" role="document">
                <div class="modal-content">
                    <div class="modal-header">
                        <h5 class="modal-title">Record Payment</h5>
                        <button type="button" class="btn-close" data-bs-dismiss="modal"></button>
                    </div>
                    <div class="modal-body">
                        <form id="hub_paymentForm" enctype="multipart/form-data">
                            <input type="hidden" name="installment_id" id="hub_payment_installment_id">
                            <div class="row g-3">
                                <div class="col-md-6">
                                    <label class="form-label">Due Amount</label>
                                    <input type="text" class="form-control" id="hub_payment_due_amount" readonly>
                                </div>
                                <div class="col-md-6">
                                    <label class="form-label">Payment Amount <span class="text-danger">*</span></label>
                                    <input type="number" step="0.01" class="form-control" name="payment_amount" id="hub_payment_amount" required>
                                </div>
                                <div class="col-md-6">
                                    <label class="form-label">Payment Date <span class="text-danger">*</span></label>
                                    <input type="text" class="form-control" name="payment_date" id="hub_payment_date" placeholder="dd/mm/yyyy" autocomplete="off" required>
                                </div>
                                <div class="col-md-6">
                                    <label class="form-label">Payment Method</label>
                                    <select class="form-control" name="payment_method" id="hub_payment_method">
                                        <option value="">Select Method</option>
                                        <option value="Cash">Cash</option>
                                        <option value="Card">Card</option>
                                        <option value="UPI">UPI</option>
                                        <option value="Bank Transfer">Bank Transfer</option>
                                        <option value="Cheque">Cheque</option>
                                    </select>
                                </div>
                                <div class="col-md-12">
                                    <label class="form-label">Reference Number</label>
                                    <input type="text" class="form-control" name="payment_reference" id="hub_payment_reference" placeholder="Transaction/Receipt No.">
                                </div>
                                <div class="col-md-12">
                                    <label class="form-label">Payment Slip <span class="text-danger">*</span></label>
                                    <input type="file" class="form-control" name="payment_slip" id="hub_payment_slip" accept=".jpg,.jpeg,.png,.pdf" required>
                                    <small class="text-muted">JPG, JPEG, PNG, or PDF. Maximum 20 MB.</small>
                                </div>
                                <div class="col-md-12">
                                    <label class="form-label">Remarks</label>
                                    <textarea class="form-control" name="payment_remarks" id="hub_payment_remarks" rows="2"></textarea>
                                </div>
                            </div>
                        </form>
                    </div>
                    <div class="modal-footer">
                        <button type="button" class="btn btn-secondary" data-bs-dismiss="modal">Close</button>
                        <button type="button" class="btn btn-success" onclick="hub_savePayment()">Record Payment</button>
                    </div>
                </div>
            </div>
        </div>

        <!-- Delete Modal -->
        <div class="modal fade" id="hub_deleteModal" role="dialog">
            <div class="modal-dialog" role="document">
                <div class="modal-content">
                    <div class="modal-header">
                        <h5 class="modal-title">Delete Payment Schedule</h5>
                        <button type="button" class="btn-close" data-bs-dismiss="modal"></button>
                    </div>
                    <div class="modal-body">
                        <input type="hidden" id="hub_delete_scheduler_id">
                        <p>Are you sure you want to delete this payment schedule?</p>
                        <p class="text-danger"><small>This will also delete all installment records.</small></p>
                    </div>
                    <div class="modal-footer">
                        <button type="button" class="btn btn-secondary" data-bs-dismiss="modal">Cancel</button>
                        <button type="button" class="btn btn-danger" onclick="hub_confirmDelete()">Delete</button>
                    </div>
                </div>
            </div>
        </div>

        <!-- Hub Property Reservation Payment Summary Modal -->
        <div class="modal fade" id="hubPrPaymentSummaryModal" tabindex="-1" role="dialog">
            <div class="modal-dialog modal-xl" role="document">
                <div class="modal-content">
                    <div class="modal-header">
                        <h5 class="modal-title">Property Payment Schedule Details</h5>
                        <button type="button" class="btn-close" data-bs-dismiss="modal"></button>
                    </div>
                    <div class="modal-body">
                        <div class="row mb-3">
                            <div class="col-md-3"><strong>Quotation:</strong> <span id="hub_pr_view_quotation">-</span></div>
                            <div class="col-md-3"><strong>Guest:</strong> <span id="hub_pr_view_guest">-</span></div>
                            <div class="col-md-3"><strong>Property:</strong> <span id="hub_pr_view_property">-</span></div>
                            <div class="col-md-3"><strong>Type:</strong> <span id="hub_pr_view_type">-</span></div>
                        </div>
                        <div class="row mb-3">
                            <div class="col-md-3">
                                <div class="card bg-secondary text-white">
                                    <div class="card-body text-center">
                                        <h6 class="text-white">Total</h6>
                                        <h4 class="text-white" id="hub_pr_view_total">₹0.00</h4>
                                    </div>
                                </div>
                            </div>
                            <div class="col-md-3">
                                <div class="card bg-success text-white">
                                    <div class="card-body text-center">
                                        <h6 class="text-white">Paid</h6>
                                        <h4 class="text-white" id="hub_pr_view_paid">₹0.00</h4>
                                    </div>
                                </div>
                            </div>
                            <div class="col-md-3">
                                <div class="card bg-warning text-white">
                                    <div class="card-body text-center">
                                        <h6 class="text-white">Pending</h6>
                                        <h4 class="text-white" id="hub_pr_view_pending">₹0.00</h4>
                                    </div>
                                </div>
                            </div>
                            <div class="col-md-3">
                                <div class="card bg-danger text-white">
                                    <div class="card-body text-center">
                                        <h6 class="text-white">Overdue</h6>
                                        <h4 class="text-white" id="hub_pr_view_overdue">0</h4>
                                    </div>
                                </div>
                            </div>
                        </div>
                        <h6>Installments</h6>
                        <div class="table-responsive">
                            <table class="table table-bordered table-sm">
                                <thead class="table-light"><tr><th>#</th><th>Due Date</th><th>Amount</th><th>Paid</th><th>Status</th><th>Action</th></tr></thead>
                                <tbody id="hub_pr_installments_body"></tbody>
                            </table>
                        </div>
                    </div>
                    <div class="modal-footer">
                        <button type="button" class="btn btn-secondary" data-bs-dismiss="modal">Close</button>
                    </div>
                </div>
            </div>
        </div>

        <!-- Hub Property Reservation Record Payment Modal -->
        <div class="modal fade" id="hubPrRecordPaymentModal" tabindex="-1" role="dialog">
            <div class="modal-dialog" role="document">
                <div class="modal-content">
                    <div class="modal-header">
                        <h5 class="modal-title">Record Payment</h5>
                        <button type="button" class="btn-close" data-bs-dismiss="modal"></button>
                    </div>
                    <div class="modal-body">
                        <form id="hubPrPaymentForm" enctype="multipart/form-data">
                            <input type="hidden" name="installment_id" id="hub_pr_pay_installment_id">
                            <input type="hidden" name="scheduler_id" id="hub_pr_pay_scheduler_id">
                            <div class="row g-3">
                                <div class="col-md-6">
                                    <label class="form-label">Due Amount</label>
                                    <input type="text" class="form-control" id="hub_pr_pay_due_amount" readonly>
                                </div>
                                <div class="col-md-6">
                                    <label class="form-label">Payment Amount <span class="text-danger">*</span></label>
                                    <input type="number" step="0.01" class="form-control" name="payment_amount" id="hub_pr_pay_amount" required>
                                </div>
                                <div class="col-md-6">
                                    <label class="form-label">Payment Date <span class="text-danger">*</span></label>
                                    <input type="text" class="form-control" name="payment_date" id="hub_pr_pay_date" placeholder="dd/mm/yyyy" autocomplete="off" required>
                                </div>
                                <div class="col-md-6">
                                    <label class="form-label">Payment Method</label>
                                    <select class="form-control" name="payment_method" id="hub_pr_pay_method">
                                        <option value="">Select Method</option>
                                        <option value="Cash">Cash</option>
                                        <option value="Card">Card</option>
                                        <option value="UPI">UPI</option>
                                        <option value="Bank Transfer">Bank Transfer</option>
                                        <option value="Cheque">Cheque</option>
                                    </select>
                                </div>
                                <div class="col-md-12">
                                    <label class="form-label">Reference Number</label>
                                    <input type="text" class="form-control" name="payment_reference" id="hub_pr_pay_ref" placeholder="Transaction/Receipt No.">
                                </div>
                                <div class="col-md-12">
                                    <label class="form-label">Payment Slip <span class="text-danger">*</span></label>
                                    <input type="file" class="form-control" name="payment_slip" id="hub_pr_pay_slip" accept=".jpg,.jpeg,.png,.pdf" required>
                                    <small class="text-muted">JPG, JPEG, PNG, or PDF. Maximum 20 MB.</small>
                                </div>
                                <div class="col-md-12">
                                    <label class="form-label">Remarks</label>
                                    <textarea class="form-control" name="payment_remarks" id="hub_pr_pay_remarks" rows="2"></textarea>
                                </div>
                            </div>
                        </form>
                    </div>
                    <div class="modal-footer">
                        <button type="button" class="btn btn-secondary" data-bs-dismiss="modal">Cancel</button>
                        <button type="button" class="btn btn-success" onclick="hubPrSavePayment()">Record Payment</button>
                    </div>
                </div>
            </div>
        </div>

        <!-- Hub Property Reservation Payment History Modal -->
        <div class="modal fade" id="hubPrReceiptsModal" tabindex="-1" role="dialog">
            <div class="modal-dialog modal-lg" role="document">
                <div class="modal-content">
                    <div class="modal-header">
                        <h5 class="modal-title">Payment History</h5>
                        <button type="button" class="btn-close" data-bs-dismiss="modal"></button>
                    </div>
                    <div class="modal-body">
                        <div class="table-responsive">
                            <table class="table table-bordered table-sm">
                                <thead class="table-light"><tr><th>Date</th><th>Amount</th><th>Method</th><th>Reference</th><th>Paid By</th><th>Slip</th></tr></thead>
                                <tbody id="hub_pr_receipts_body"></tbody>
                            </table>
                        </div>
                    </div>
                    <div class="modal-footer"><button type="button" class="btn btn-secondary" data-bs-dismiss="modal">Close</button></div>
                </div>
            </div>
        </div>

        <!-- Transporter Allocation Modal -->
        <div class="modal fade" id="driverAllocationModal" tabindex="-1" role="dialog">
            <div class="modal-dialog" role="document">
                <div class="modal-content">
                    <div class="modal-header">
                        <h5 class="modal-title"><i class="la la-car me-2"></i> Transporter Allocation</h5>
                        <button type="button" class="btn-close" data-bs-dismiss="modal"></button>
                    </div>
                    <div class="modal-body">
                        <form id="driverAllocationForm">
                            <div class="mb-3">
                                <label class="form-label fw-bold">Transporter</label>
                                <select class="form-control" id="da_transporter_id" name="transporter_id" required>
                                    <option value="">-- Select Transporter --</option>
                                </select>
                            </div>
                        </form>
                    </div>
                    <div class="modal-footer">
                        <button type="button" class="btn btn-secondary" data-bs-dismiss="modal">Cancel</button>
                        <button type="button" class="btn btn-success" onclick="submitDriverAllocation()">
                            <i class="la la-check me-1"></i> Allocate &amp; Set Driver Not Assigned
                        </button>
                    </div>
                </div>
            </div>
        </div>

        <!-- Review Update Modal -->
        <div class="modal fade" id="hubReviewModal" tabindex="-1" aria-hidden="true" data-bs-backdrop="static">
            <div class="modal-dialog modal-dialog-centered">
                <div class="modal-content">
                    <div class="modal-header">
                        <h5 class="modal-title"><i class="la la-star me-2"></i> Update Trip Review</h5>
                        <button type="button" class="btn-close" data-bs-dismiss="modal"></button>
                    </div>
                    <div class="modal-body">
                        <input type="hidden" id="review_quotation_id" value="">
                        <div class="mb-3 text-center">
                            <label class="form-label fw-bold mb-2">Rating</label>
                            <div id="reviewStarContainer" style="font-size:32px;cursor:pointer;user-select:none;">
                                <i class="la la-star review-star" data-val="1" style="color:#ccc;"></i>
                                <i class="la la-star review-star" data-val="2" style="color:#ccc;"></i>
                                <i class="la la-star review-star" data-val="3" style="color:#ccc;"></i>
                                <i class="la la-star review-star" data-val="4" style="color:#ccc;"></i>
                                <i class="la la-star review-star" data-val="5" style="color:#ccc;"></i>
                            </div>
                            <input type="hidden" id="review_rating_input" value="0">
                            <small id="reviewRatingText" class="text-muted mt-1 d-block">Select a rating</small>
                        </div>
                        <div class="mb-3">
                            <label class="form-label fw-bold">Comment (optional)</label>
                            <textarea class="form-control" id="review_comment_input" rows="3" placeholder="Add a review comment..."></textarea>
                        </div>
                    </div>
                    <div class="modal-footer">
                        <button type="button" class="btn btn-secondary" data-bs-dismiss="modal">Cancel</button>
                        <button type="button" class="btn btn-primary" onclick="submitReview()">
                            <i class="la la-check me-1"></i> Submit Review
                        </button>
                    </div>
                </div>
            </div>
        </div>

        <!-- Include quotation modals (QuotationModal, roompricingandguestallocationModal, etc.) from list.php -->
        <?php
            $quotation_modal_only = true;
            $users = isset($users) ? $users : array();
            include(APPPATH . 'views/Quotation/list.php');
        ?>

        <!--**********************************
            Content body end
        ***********************************-->
                                                                    
       