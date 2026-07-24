<!--**********************************
    Content body start
***********************************-->
<div class="content-body">
    <div class="container-fluid">
        <div class="row">
            <div class="col-12">
                <div class="card">
                    <div class="card-header d-flex justify-content-between align-items-center">
                        <h4 class="card-title mb-0">Property Payments Report</h4>
                        <button type="button" class="btn btn-primary btn-sm" id="btnToggleFilters" onclick="togglePropertyPaymentFilters()">
                            <i class="fas fa-filter me-1"></i> Filters
                        </button>
                    </div>
                    <div class="card-body">
                        <!-- Filters -->
                        <div id="propertyPaymentFilterSection" class="row mb-3" style="display: none;">
                            <div class="col-md-3 mb-2">
                                <label class="form-label">Quotation Number</label>
                                <input type="text" class="form-control" id="filter_quotation_number" placeholder="Search...">
                            </div>
                            <div class="col-md-3 mb-2">
                                <label class="form-label">Guest Name</label>
                                <input type="text" class="form-control" id="filter_guest_name" placeholder="Search...">
                            </div>
                            <div class="col-md-3 mb-2">
                                <label class="form-label">Property Name</label>
                                <input type="text" class="form-control" id="filter_property_name" placeholder="Search...">
                            </div>
                            <div class="col-md-3 mb-2">
                                <label class="form-label">Payment Type</label>
                                <select class="form-control" id="filter_payment_type">
                                    <option value="">All</option>
                                    <option value="FULL">Full Payment</option>
                                    <option value="EMI">EMI</option>
                                </select>
                            </div>
                            <div class="col-md-3 mb-2">
                                <label class="form-label">&nbsp;</label>
                                <div>
                                    <button type="button" class="btn btn-primary btn-sm" onclick="applyPropertyPaymentReportFilters()">Apply</button>
                                    <button type="button" class="btn btn-secondary btn-sm" onclick="clearPropertyPaymentReportFilters()">Clear</button>
                                </div>
                            </div>
                        </div>

                        <style>
                            #property_payment_report_table th,
                            #property_payment_report_table td {
                                font-size: 13px;
                                padding: 6px 8px;
                                white-space: nowrap;
                            }
                            #property_payment_report_table tbody tr {
                                transition: all 0.2s ease;
                            }
                            #property_payment_report_table tbody tr:hover {
                                box-shadow: 0 4px 8px rgba(0, 0, 0, 0.12);
                                transform: translateY(-1px);
                                background-color: #f8f9fa;
                            }
                        </style>
                        <div class="table-responsive">
                            <table id="property_payment_report_table" class="display" style="min-width: 900px">
                                <thead>
                                    <tr>
                                        <th>Sl.no</th>
                                        <th>Quotation #</th>
                                        <th>Guest Name</th>
                                        <th>Property</th>
                                        <th>Payment Type</th>
                                        <th>Total Amount</th>
                                        <th>Paid</th>
                                        <th>Pending</th>
                                        <th>EMI Count</th>
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

<!-- Payment Schedule Details Modal -->
<div class="modal fade" id="viewPropertySchedulerDetailsModal" tabindex="-1" aria-hidden="true">
    <div class="modal-dialog modal-xl">
        <div class="modal-content">
            <div class="modal-header">
                <h5 class="modal-title">Property Payment Schedule Details</h5>
                <button type="button" class="btn-close" data-bs-dismiss="modal"></button>
            </div>
            <div class="modal-body">
                <div class="row mb-3">
                    <div class="col-md-3">
                        <strong>Quotation:</strong> <span id="ppd_quotation_number">-</span>
                    </div>
                    <div class="col-md-3">
                        <strong>Guest:</strong> <span id="ppd_guest_name">-</span>
                    </div>
                    <div class="col-md-3">
                        <strong>Property:</strong> <span id="ppd_property_name">-</span>
                    </div>
                    <div class="col-md-3">
                        <strong>Type:</strong> <span id="ppd_payment_type">-</span>
                    </div>
                </div>

                <div class="row mb-3">
                    <div class="col-md-3">
                        <div class="card bg-secondary text-white">
                            <div class="card-body text-center">
                                <h6 class="text-white">Total</h6>
                                <h4 class="text-white" id="ppd_total_amount">₹0.00</h4>
                            </div>
                        </div>
                    </div>
                    <div class="col-md-3">
                        <div class="card bg-success text-white">
                            <div class="card-body text-center">
                                <h6 class="text-white">Paid</h6>
                                <h4 class="text-white" id="ppd_paid_amount">₹0.00</h4>
                            </div>
                        </div>
                    </div>
                    <div class="col-md-3">
                        <div class="card bg-warning text-white">
                            <div class="card-body text-center">
                                <h6 class="text-white">Pending</h6>
                                <h4 class="text-white" id="ppd_pending_amount">₹0.00</h4>
                            </div>
                        </div>
                    </div>
                    <div class="col-md-3">
                        <div class="card bg-danger text-white">
                            <div class="card-body text-center">
                                <h6 class="text-white">Overdue</h6>
                                <h4 class="text-white" id="ppd_overdue_count">0</h4>
                            </div>
                        </div>
                    </div>
                </div>

                <h6>Installments</h6>
                <div class="table-responsive">
                    <table class="table table-bordered table-sm" id="ppdInstallmentsTable">
                        <thead class="table-light">
                            <tr>
                                <th>#</th>
                                <th>Due Date</th>
                                <th>Amount</th>
                                <th>Paid</th>
                                <th>Status</th>
                                <th>Action</th>
                            </tr>
                        </thead>
                        <tbody id="ppdInstallmentsBody">
                        </tbody>
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

<!-- Payment Receipts Modal -->
<div class="modal fade" id="viewPropertyPaymentsModal" tabindex="-1" aria-hidden="true">
    <div class="modal-dialog modal-dialog-centered modal-lg">
        <div class="modal-content">
            <div class="modal-header">
                <h5 class="modal-title">Payment Receipts</h5>
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
<!--**********************************
    Content body end
***********************************-->
