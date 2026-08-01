<!--**********************************
    Content body start
***********************************-->
<div class="content-body">
    <div class="container-fluid">
        <div class="row">
            <div class="col-12">
                <div class="card">
                    <div class="card-header d-flex justify-content-between align-items-center">
                        <h4 class="card-title mb-0">Payment Report</h4>
                        <button type="button" class="btn btn-primary btn-sm" id="btnToggleFilters" onclick="togglePaymentReportFilters()">
                            <i class="fas fa-filter me-1"></i> Filters
                        </button>
                    </div>
                    <div class="card-body">
                        <!-- Filters -->
                        <div id="paymentReportFilterSection" class="row mb-3" style="display: none;">
                            <div class="col-md-2 mb-2">
                                <label class="form-label">Quotation Number</label>
                                <input type="text" class="form-control" id="filter_quotation_number" placeholder="Search...">
                            </div>
                            <div class="col-md-2 mb-2">
                                <label class="form-label">Guest Name</label>
                                <input type="text" class="form-control" id="filter_guest_name" placeholder="Search...">
                            </div>
                            <div class="col-md-2 mb-2">
                                <label class="form-label">Cust. Payment Status</label>
                                <select class="form-control form-select" id="filter_customer_payment_status">
                                    <option value="">All</option>
                                    <option value="PAID">Paid</option>
                                    <option value="PARTIAL">Partial</option>
                                    <option value="PENDING">Pending</option>
                                    <option value="OVERDUE">Overdue</option>
                                </select>
                            </div>
                            <div class="col-md-2 mb-2">
                                <label class="form-label">Cust. Approval</label>
                                <select class="form-control form-select" id="filter_customer_approval">
                                    <option value="">All</option>
                                    <option value="pending">Pending</option>
                                    <option value="approved">All Approved</option>
                                </select>
                            </div>
                            <div class="col-md-2 mb-2">
                                <label class="form-label">Travel Date</label>
                                <input type="text" class="form-control" id="filter_travel_daterange" placeholder="dd/mm/yyyy - dd/mm/yyyy" autocomplete="off">
                            </div>
                            <div class="col-md-2 mb-2">
                                <label class="form-label">Prop. Payment Status</label>
                                <select class="form-control form-select" id="filter_property_payment_status">
                                    <option value="">All</option>
                                    <option value="PAID">Paid</option>
                                    <option value="PARTIAL">Partial</option>
                                    <option value="PENDING">Pending</option>
                                    <option value="OVERDUE">Overdue</option>
                                </select>
                            </div>
                            <div class="col-md-2 mb-2">
                                <label class="form-label">&nbsp;</label>
                                <div class="d-flex align-items-center">
                                    <button type="button" class="btn btn-primary btn-sm" onclick="applyPaymentReportFilters()">Apply</button>
                                    <button type="button" class="btn btn-secondary btn-sm ms-1" onclick="clearPaymentReportFilters()">Clear</button>
                                </div>
                            </div>
                        </div>

                        <style>
                            #payment_report_table th,
                            #payment_report_table td {
                                font-size: 13px;
                                padding: 6px 8px;
                                white-space: nowrap;
                            }
                            #payment_report_table tbody tr {
                                transition: all 0.2s ease;
                            }
                            #payment_report_table tbody tr:hover {
                                box-shadow: 0 4px 8px rgba(0, 0, 0, 0.12);
                                transform: translateY(-1px);
                                background-color: #f8f9fa;
                            }
                        </style>
                        <div class="table-responsive">
                            <table id="payment_report_table" class="display" style="min-width: 900px">
                                <thead>
                                    <tr>
                                        <th>Sl.no</th>
                                        <th>Quotation #</th>
                                        <th>Guest Name</th>
                                        <th>Travel Date</th>
                                        <th>Phone</th>
                                        <th>Cust. Payment</th>
                                        <th>Cust. Approval</th>
                                        <th>Prop. Payment</th>
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

<!-- Payment Details Tabbed Modal -->
<div class="modal fade" id="paymentDetailsModal" tabindex="-1" aria-hidden="true">
    <div class="modal-dialog modal-xl">
        <div class="modal-content">
            <div class="modal-header" style="background:linear-gradient(135deg,#4a3ee0,#5a4ff0);">
                <h5 class="modal-title text-white"><i class="fas fa-file-invoice-dollar me-1"></i> Payment Details</h5>
                <button type="button" class="btn-close" data-bs-dismiss="modal"></button>
            </div>
            <div class="modal-body">
                <input type="hidden" id="pd_quotation_id" value="0">
                <input type="hidden" id="pd_customer_scheduler_id" value="0">
                <input type="hidden" id="pd_property_scheduler_id" value="0">

                <!-- Detail Grid -->
                <div style="border:1px solid #e5e7eb;border-radius:8px;overflow:hidden;margin-bottom:16px;">
                    <div class="row g-0">
                        <div class="col-md-4" style="padding:12px 16px;border-bottom:1px solid #e5e7eb;border-right:1px solid #e5e7eb;">
                            <small style="font-size:11px;color:#6b7280;text-transform:uppercase;letter-spacing:.5px;display:block;margin-bottom:3px;">Quotation No.</small>
                            <span style="font-size:14px;font-weight:600;" id="pd_quotation_number">-</span>
                        </div>
                        <div class="col-md-4" style="padding:12px 16px;border-bottom:1px solid #e5e7eb;border-right:1px solid #e5e7eb;">
                            <small style="font-size:11px;color:#6b7280;text-transform:uppercase;letter-spacing:.5px;display:block;margin-bottom:3px;">Guest Name</small>
                            <span style="font-size:14px;font-weight:600;" id="pd_guest_name">-</span>
                        </div>
                        <div class="col-md-4" style="padding:12px 16px;border-bottom:1px solid #e5e7eb;">
                            <small style="font-size:11px;color:#6b7280;text-transform:uppercase;letter-spacing:.5px;display:block;margin-bottom:3px;">Phone</small>
                            <span style="font-size:14px;font-weight:600;" id="pd_phone">-</span>
                        </div>
                    </div>
                </div>

                <!-- Tabs -->
                <ul class="nav nav-tabs mb-3" id="paymentTabs" role="tablist">
                    <li class="nav-item" role="presentation">
                        <button class="nav-link active" id="customer-tab" data-bs-toggle="tab" data-bs-target="#customerPaymentPane" type="button" role="tab">Customer Payment</button>
                    </li>
                    <li class="nav-item" role="presentation">
                        <button class="nav-link" id="property-tab" data-bs-toggle="tab" data-bs-target="#propertyPaymentPane" type="button" role="tab">Property Payment</button>
                    </li>
                </ul>

                <div class="tab-content" id="paymentTabsContent">
                    <!-- Customer Payment Tab -->
                    <div class="tab-pane fade show active" id="customerPaymentPane" role="tabpanel">
                        <div id="customerPaymentContent">
                            <div class="text-center text-muted py-4">Loading customer payment details...</div>
                        </div>
                    </div>

                    <!-- Property Payment Tab -->
                    <div class="tab-pane fade" id="propertyPaymentPane" role="tabpanel">
                        <div id="propertyPaymentContent">
                            <div class="text-center text-muted py-4">Loading property payment details...</div>
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

<!-- Customer Record Payment Modal -->
<div class="modal fade" id="recordCustomerPaymentModal" tabindex="-1" aria-hidden="true">
    <div class="modal-dialog modal-dialog-centered modal-md">
        <div class="modal-content">
            <div class="modal-header">
                <h5 class="modal-title">Record Payment</h5>
                <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
            </div>
            <div class="modal-body">
                <form id="recordCustomerPaymentForm" enctype="multipart/form-data">
                    <input type="hidden" id="cp_installment_id" name="installment_id">
                    <div class="row g-3">
                        <div class="col-md-6">
                            <label class="form-label">Due Amount</label>
                            <input type="text" class="form-control" id="cp_installment_amount" readonly>
                        </div>
                        <div class="col-md-6">
                            <label class="form-label">Payment Amount <span class="text-danger">*</span></label>
                            <input type="number" step="0.01" class="form-control" id="cp_payment_amount" name="payment_amount" required>
                        </div>
                        <div class="col-md-6">
                            <label class="form-label">Payment Date <span class="text-danger">*</span></label>
                            <input type="text" class="form-control datepicker" id="cp_payment_date" name="payment_date" placeholder="dd/mm/yyyy" autocomplete="off" required>
                        </div>
                        <div class="col-md-6">
                            <label class="form-label">Payment Method</label>
                            <select class="form-control" id="cp_payment_method" name="payment_method">
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
                            <input type="text" class="form-control" id="cp_payment_reference" name="payment_reference" placeholder="Transaction/Receipt No.">
                        </div>
                        <div class="col-md-12">
                            <label class="form-label">Payment Slip <span class="text-danger">*</span></label>
                            <input type="file" class="form-control" id="cp_payment_slip" name="payment_slip" accept=".jpg,.jpeg,.png,.pdf" required>
                            <small class="text-muted">JPG, JPEG, PNG, or PDF. Maximum 20 MB.</small>
                        </div>
                        <div class="col-md-12">
                            <label class="form-label">Remarks</label>
                            <textarea class="form-control" id="cp_payment_remarks" name="payment_remarks" rows="2"></textarea>
                        </div>
                    </div>
                </form>
            </div>
            <div class="modal-footer">
                <button type="button" class="btn btn-secondary" data-bs-dismiss="modal">Cancel</button>
                <button type="button" class="btn btn-success" onclick="submitCustomerPayment()">Record Payment</button>
            </div>
        </div>
    </div>
</div>

<!-- Customer Payment History Modal -->
<div class="modal fade" id="viewCustomerPaymentsModal" tabindex="-1" aria-hidden="true">
    <div class="modal-dialog modal-dialog-centered modal-md">
        <div class="modal-content">
            <div class="modal-header">
                <h5 class="modal-title">Payment History</h5>
                <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
            </div>
            <div class="modal-body">
                <div class="table-responsive">
                    <table class="table table-sm table-bordered" id="customerPaymentHistoryTable">
                        <thead>
                            <tr>
                                <th>#</th>
                                <th>Amount</th>
                                <th>Date</th>
                                <th>Method</th>
                                <th>Reference</th>
                                <th>Received By</th>
                                <th>Approval Status</th>
                                <th>Action</th>
                            </tr>
                        </thead>
                        <tbody></tbody>
                    </table>
                </div>
            </div>
            <div class="modal-footer">
                <button type="button" class="btn btn-secondary" data-bs-dismiss="modal">Close</button>
            </div>
        </div>
    </div>
</div>

<!-- Property Record Payment Modal -->
<div class="modal fade" id="recordPropertyPaymentModal" tabindex="-1" aria-hidden="true">
    <div class="modal-dialog modal-dialog-centered modal-md">
        <div class="modal-content">
            <div class="modal-header">
                <h5 class="modal-title">Record Property Payment</h5>
                <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
            </div>
            <div class="modal-body">
                <form id="recordPropertyPaymentForm" enctype="multipart/form-data">
                    <input type="hidden" id="pp_installment_id" name="installment_id">
                    <input type="hidden" id="pp_scheduler_id" name="scheduler_id">
                    <div class="row g-3">
                        <div class="col-md-6">
                            <label class="form-label">Due Amount</label>
                            <input type="text" class="form-control" id="pp_installment_amount" readonly>
                        </div>
                        <div class="col-md-6">
                            <label class="form-label">Payment Amount <span class="text-danger">*</span></label>
                            <input type="number" step="0.01" class="form-control" id="pp_payment_amount" name="payment_amount" required>
                        </div>
                        <div class="col-md-6">
                            <label class="form-label">Payment Date <span class="text-danger">*</span></label>
                            <input type="text" class="form-control datepicker" id="pp_payment_date" name="payment_date" placeholder="dd/mm/yyyy" autocomplete="off" required>
                        </div>
                        <div class="col-md-6">
                            <label class="form-label">Payment Method</label>
                            <select class="form-control" id="pp_payment_method" name="payment_method">
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
                            <input type="text" class="form-control" id="pp_payment_reference" name="payment_reference" placeholder="Transaction/Receipt No.">
                        </div>
                        <div class="col-md-12">
                            <label class="form-label">Payment Slip <span class="text-danger">*</span></label>
                            <input type="file" class="form-control" id="pp_payment_slip" name="payment_slip" accept=".jpg,.jpeg,.png,.pdf" required>
                            <small class="text-muted">JPG, JPEG, PNG, or PDF. Maximum 20 MB.</small>
                        </div>
                        <div class="col-md-12">
                            <label class="form-label">Remarks</label>
                            <textarea class="form-control" id="pp_payment_remarks" name="payment_remarks" rows="2"></textarea>
                        </div>
                    </div>
                </form>
            </div>
            <div class="modal-footer">
                <button type="button" class="btn btn-secondary" data-bs-dismiss="modal">Cancel</button>
                <button type="button" class="btn btn-success" onclick="submitPropertyPayment()">Record Payment</button>
            </div>
        </div>
    </div>
</div>

<!-- Property Payment History Modal -->
<div class="modal fade" id="viewPropertyPaymentsModal" tabindex="-1" aria-hidden="true">
    <div class="modal-dialog modal-dialog-centered modal-md">
        <div class="modal-content">
            <div class="modal-header">
                <h5 class="modal-title">Payment History</h5>
                <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
            </div>
            <div class="modal-body">
                <div class="table-responsive">
                    <table class="table table-sm table-bordered" id="propertyPaymentHistoryTable">
                        <thead>
                            <tr>
                                <th>#</th>
                                <th>Amount</th>
                                <th>Date</th>
                                <th>Method</th>
                                <th>Reference</th>
                                <th>Paid By</th>
                                <th>Action</th>
                            </tr>
                        </thead>
                        <tbody></tbody>
                    </table>
                </div>
            </div>
            <div class="modal-footer">
                <button type="button" class="btn btn-secondary" data-bs-dismiss="modal">Close</button>
            </div>
        </div>
    </div>
</div>

<!-- Approve Confirmation Modal -->
<div class="modal fade" id="approveConfirmModal" tabindex="-1" aria-hidden="true">
    <div class="modal-dialog modal-dialog-centered modal-md">
        <div class="modal-content">
            <div class="modal-header">
                <h5 class="modal-title">Confirm Approval</h5>
                <button type="button" class="btn-close" data-bs-dismiss="modal"></button>
            </div>
            <div class="modal-body">
                Are you sure you want to approve this payment?
            </div>
            <div class="modal-footer">
                <button type="button" class="btn btn-secondary" data-bs-dismiss="modal">Cancel</button>
                <button type="button" class="btn btn-success" id="btnConfirmApprove" onclick="submitApprovePayment()">Approve</button>
            </div>
        </div>
    </div>
</div>
<!--**********************************
    Content body end
***********************************-->
