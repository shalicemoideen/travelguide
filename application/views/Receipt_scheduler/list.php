<!--**********************************

    Content body start

***********************************-->

<div class="content-body">

    <div class="container-fluid">

        <!-- Filters and DataTable -->

        <div class="row">

            <div class="col-12">

                <div class="card">

                    <div class="card-header d-flex justify-content-between align-items-center">

                        <h4 class="card-title mb-0">Receipt Scheduler - Payment Schedules</h4>

                        <?php if (has_permission('RECEIPT_SCHEDULER')): ?>

                        <a onclick="add_scheduler()" class="btn btn-rounded btn-primary btn-sm">+ Create Payment Schedule</a>

                        <?php endif; ?>

                    </div>

                    <div class="card-body">

                        <!-- Filters -->

                        <div class="row mb-3">

                            <div class="col-md-3">

                                <label class="form-label">Quotation Number</label>

                                <input type="text" class="form-control" id="filter_quotation_number" placeholder="Search...">

                            </div>

                            <div class="col-md-2">

                                <label class="form-label">Payment Type</label>

                                <select class="form-control" id="filter_payment_type">

                                    <option value="">All</option>

                                    <option value="FULL">Full Payment</option>

                                    <option value="EMI">EMI</option>

                                </select>

                            </div>

                            <div class="col-md-2">

                                <label class="form-label">From Date</label>

                                <input type="date" class="form-control" id="filter_start_date">

                            </div>

                            <div class="col-md-2">

                                <label class="form-label">To Date</label>

                                <input type="date" class="form-control" id="filter_end_date">

                            </div>

                            <div class="col-md-3">

                                <label class="form-label">&nbsp;</label>

                                <div>

                                    <button type="button" class="btn btn-primary btn-sm" onclick="applyFilters()">Apply</button>

                                    <button type="button" class="btn btn-secondary btn-sm" onclick="clearFilters()">Clear</button>

                                </div>

                            </div>

                        </div>



                        <div class="table-responsive">

                            <table id="scheduler_table" class="display" style="min-width: 845px">

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



<!-- Add/Edit Scheduler Modal -->

<div class="modal fade" id="schedulerModal" role="dialog" data-backdrop="static" data-keyboard="false">

    <div class="modal-dialog" role="document" style="max-width: 850px;">

        <div class="modal-content">

            <div class="modal-header bg-primary">

                <h5 class="modal-title text-white">Create Payment Schedule</h5>

                <button type="button" class="btn-close" data-bs-dismiss="modal"></button>

            </div>

            <div class="modal-body">

                <form class="needs-validation" action="#" id="schedulerForm">

                    <input type="hidden" value="" name="receipt_scheduler_id" id="receipt_scheduler_id"/>

                    

                    <div class="row">

                        <div class="col-md-6">

                            <div class="mb-3">

                                <label class="form-label">Select Confirmed Quotation <span class="text-danger">*</span></label>

                                <select class="form-control select2" name="quotation_id_fk" id="quotation_id_fk" required>

                                    <option value="">Select Quotation</option>

                                    <?php foreach ($confirmed_quotations as $q): ?>

                                    <option value="<?php echo $q->quotation_id; ?>">

                                        <?php echo $q->quotation_number; ?> - <?php echo $q->guest_name; ?>

                                    </option>

                                    <?php endforeach; ?>

                                </select>

                            </div>

                        </div>

                        <div class="col-md-6">

                            <div class="mb-3">

                                <label class="form-label">Total Amount <span class="text-danger">*</span></label>

                                <input type="hidden" name="total_amount" id="total_amount">

                                <div style="background:linear-gradient(135deg,#2e7d32,#43a047);color:#fff;padding:12px 16px;border-radius:8px;font-size:22px;font-weight:700;text-align:center;box-shadow:0 2px 6px rgba(0,0,0,.12);">

                                    <span id="total_amount_display">₹0.00</span>

                                </div>

                            </div>

                        </div>

                    </div>



                    <div class="row">

                        <div class="col-md-6">

                            <div class="mb-3">

                                <label class="form-label">Payment Type <span class="text-danger">*</span></label>

                                <select class="form-control" name="payment_type" id="payment_type" required onchange="togglePaymentType()">

                                    <option value="">Select Type</option>

                                    <option value="FULL">Full Payment</option>

                                    <option value="EMI">EMI (Installments)</option>

                                </select>

                            </div>

                        </div>

                        <div class="col-md-6">

                            <div class="mb-3">

                                <label class="form-label">Remarks</label>

                                <input type="text" class="form-control" name="receipt_scheduler_remarks" id="receipt_scheduler_remarks">

                            </div>

                        </div>

                    </div>



                    <!-- Full Payment Section -->

                    <div id="fullPaymentSection" style="display:none;">

                        <div class="option-block" style="margin-bottom:0;">

                            <div class="option-header" style="background:linear-gradient(135deg,#2e7d32,#43a047);color:#fff;padding:10px 16px;border-radius:8px 8px 0 0;font-size:15px;font-weight:700;display:flex;justify-content:space-between;align-items:center;">

                                <span><i class="fas fa-money-bill-wave me-1"></i> Full Payment Details</span>

                            </div>

                            <div class="option-body" style="background:#fff;border-radius:0 0 8px 8px;overflow:hidden;box-shadow:0 1px 3px rgba(0,0,0,.08);">

                                <div class="table-responsive">

                                    <table class="table table-bordered table-sm mb-0">

                                        <thead>

                                            <tr>

                                                <th style="width:50%;background:#e8f5e9;color:#2e7d32;font-size:12px;text-transform:uppercase;letter-spacing:.3px;">Description</th>

                                                <th style="width:50%;background:#e8f5e9;color:#2e7d32;font-size:12px;text-transform:uppercase;letter-spacing:.3px;">Value</th>

                                            </tr>

                                        </thead>

                                        <tbody>

                                            <tr style="background:#f1f8f4;">

                                                <td><strong>Total Amount</strong></td>

                                                <td><span id="full_total_display" style="font-size:20px;font-weight:700;color:#2e7d32;">₹0.00</span></td>

                                            </tr>

                                            <tr>

                                                <td><strong>Cutoff Date <span class="text-danger">*</span></strong></td>

                                                <td>

                                                    <input type="date" class="form-control form-control-sm" name="cutoff_date" id="cutoff_date">

                                                    <small id="cutoff_date_display" class="text-primary fw-semibold"></small>

                                                </td>

                                            </tr>

                                        </tbody>

                                    </table>

                                </div>

                            </div>

                        </div>

                    </div>



                    <!-- EMI Section -->

                    <div id="emiSection" style="display:none;">

                        <div class="option-block" style="margin-bottom:0;">

                            <div class="option-header" style="background:linear-gradient(135deg,#e65100,#f57c00);color:#fff;padding:10px 16px;border-radius:8px 8px 0 0;font-size:15px;font-weight:700;display:flex;justify-content:space-between;align-items:center;">

                                <span><i class="fas fa-calendar-check me-1"></i> EMI Configuration</span>

                                <span style="background:rgba(255,255,255,.25);padding:4px 12px;border-radius:6px;font-size:16px;font-weight:700;">Total: <span id="emi_total_display" style="font-size:18px;">₹0.00</span></span>

                            </div>

                            <div class="option-body" style="background:#fff;border-radius:0 0 8px 8px;overflow:hidden;box-shadow:0 1px 3px rgba(0,0,0,.08);padding:16px;">

                                <div class="row mb-3">

                                    <div class="col-md-4">

                                        <label class="form-label">Maximum EMI Count <span class="text-danger">*</span></label>

                                        <input type="number" min="2" max="24" class="form-control" name="max_emi_count" id="max_emi_count" value="2" onchange="generateEmiRows()">

                                    </div>

                                    <div class="col-md-4">

                                        <label class="form-label">Split By <span class="text-danger">*</span></label>

                                        <select class="form-control" name="split_type" id="split_type" onchange="toggleSplitType()">

                                            <option value="AMOUNT">Fixed Amount</option>

                                            <option value="PERCENTAGE">Percentage</option>

                                        </select>

                                    </div>

                                    <div class="col-md-4">

                                        <label class="form-label">&nbsp;</label>

                                        <button type="button" class="btn btn-warning btn-sm d-block" onclick="generateEmiRows()">

                                            <i class="fas fa-redo"></i> Reset

                                        </button>

                                    </div>

                                </div>



                                <div class="table-responsive">

                                    <table class="table table-bordered table-sm mb-0" id="emiTable">

                                        <thead>

                                            <tr>

                                                <th width="80" style="background:#fff3e0;color:#e65100;font-size:12px;text-transform:uppercase;letter-spacing:.3px;">EMI #</th>

                                                <th class="amount-col" id="emiAmountHeader" style="background:#fff3e0;color:#e65100;font-size:12px;text-transform:uppercase;letter-spacing:.3px;">Amount</th>

                                                <th width="150" style="background:#fff3e0;color:#e65100;font-size:12px;text-transform:uppercase;letter-spacing:.3px;">Due Date</th>

                                                <th width="120" style="background:#fff3e0;color:#e65100;font-size:12px;text-transform:uppercase;letter-spacing:.3px;">Calculated</th>

                                            </tr>

                                        </thead>

                                        <tbody id="emiTableBody">

                                        </tbody>

                                        <tfoot>

                                            <tr style="background:#fff3e0;">

                                                <td colspan="3" style="text-align:right;"><strong>Total</strong></td>

                                                <td id="emiCalculatedTotal" style="font-size:16px;font-weight:700;color:#e65100;">0.00</td>

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

                <button type="button" class="btn btn-primary" id="btnSave" onclick="save()">Save</button>

            </div>

        </div>

    </div>

</div>



<!-- View Payment Summary Modal -->

<div class="modal fade" id="viewModal" role="dialog">

    <div class="modal-dialog modal-xl" role="document">

        <div class="modal-content">

            <div class="modal-header" style="background:linear-gradient(135deg,#4a3ee0,#5a4ff0);">

                <h5 class="modal-title text-white"><i class="fas fa-file-invoice-dollar me-1"></i> Payment Schedule Details</h5>

                <button type="button" class="btn-close" data-bs-dismiss="modal"></button>

            </div>

            <div class="modal-body">

                <!-- Detail Grid -->

                <div style="border:1px solid #e5e7eb;border-radius:8px;overflow:hidden;margin-bottom:16px;">

                    <div class="row g-0">

                        <div class="col-md-3" style="padding:12px 16px;border-bottom:1px solid #e5e7eb;border-right:1px solid #e5e7eb;">

                            <small style="font-size:11px;color:#6b7280;text-transform:uppercase;letter-spacing:.5px;display:block;margin-bottom:3px;">Quotation No.</small>

                            <span style="font-size:14px;font-weight:600;" id="view_quotation_number">-</span>

                        </div>

                        <div class="col-md-3" style="padding:12px 16px;border-bottom:1px solid #e5e7eb;border-right:1px solid #e5e7eb;">

                            <small style="font-size:11px;color:#6b7280;text-transform:uppercase;letter-spacing:.5px;display:block;margin-bottom:3px;">Guest Name</small>

                            <span style="font-size:14px;font-weight:600;" id="view_guest_name">-</span>

                        </div>

                        <div class="col-md-3" style="padding:12px 16px;border-bottom:1px solid #e5e7eb;border-right:1px solid #e5e7eb;">

                            <small style="font-size:11px;color:#6b7280;text-transform:uppercase;letter-spacing:.5px;display:block;margin-bottom:3px;">Payment Type</small>

                            <span style="font-size:14px;font-weight:600;" id="view_payment_type">-</span>

                        </div>

                        <div class="col-md-3" style="padding:12px 16px;">

                            <small style="font-size:11px;color:#6b7280;text-transform:uppercase;letter-spacing:.5px;display:block;margin-bottom:3px;">Total</small>

                            <span style="font-size:14px;font-weight:600;" id="view_total_amount">-</span>

                        </div>

                    </div>

                </div>



                <!-- Summary Cards -->

                <div class="row mb-3">

                    <div class="col-md-4">

                        <div style="background:linear-gradient(135deg,#2e7d32,#388e3c);border-radius:8px;padding:14px 16px;text-align:center;box-shadow:0 1px 3px rgba(0,0,0,.08);">

                            <div style="font-size:11px;text-transform:uppercase;letter-spacing:.5px;color:rgba(255,255,255,.8);margin-bottom:6px;">Paid</div>

                            <div style="font-size:18px;font-weight:700;color:#fff;" id="view_paid_amount">₹0.00</div>

                        </div>

                    </div>

                    <div class="col-md-4">

                        <div style="background:linear-gradient(135deg,#f59e0b,#d97706);border-radius:8px;padding:14px 16px;text-align:center;box-shadow:0 1px 3px rgba(0,0,0,.08);">

                            <div style="font-size:11px;text-transform:uppercase;letter-spacing:.5px;color:rgba(255,255,255,.8);margin-bottom:6px;">Pending</div>

                            <div style="font-size:18px;font-weight:700;color:#fff;" id="view_pending_amount">₹0.00</div>

                        </div>

                    </div>

                    <div class="col-md-4">

                        <div style="background:linear-gradient(135deg,#dc2626,#b91c1c);border-radius:8px;padding:14px 16px;text-align:center;box-shadow:0 1px 3px rgba(0,0,0,.08);">

                            <div style="font-size:11px;text-transform:uppercase;letter-spacing:.5px;color:rgba(255,255,255,.8);margin-bottom:6px;">Overdue</div>

                            <div style="font-size:18px;font-weight:700;color:#fff;" id="view_overdue_count">0</div>

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

                            <table class="table table-bordered table-sm mb-0" id="viewInstallmentsTable">

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

                                <tbody id="viewInstallmentsBody">

                                </tbody>

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



<!-- Payment Receipts Modal -->

<div class="modal fade" id="receiptsModal" role="dialog">

    <div class="modal-dialog modal-lg" role="document">

        <div class="modal-content">

            <div class="modal-header">

                <h5 class="modal-title">Payment Receipts</h5>

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

                                <th width="100">Action</th>

                            </tr>

                        </thead>

                        <tbody id="receiptsTableBody">

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

<div class="modal fade" id="paymentModal" role="dialog">

    <div class="modal-dialog" role="document">

        <div class="modal-content">

            <div class="modal-header">

                <h5 class="modal-title">Record Payment</h5>

                <button type="button" class="btn-close" data-bs-dismiss="modal"></button>

            </div>

            <div class="modal-body">

                <form id="paymentForm" enctype="multipart/form-data">

                    <input type="hidden" name="installment_id" id="payment_installment_id">

                    <div class="mb-3">

                        <label class="form-label">Due Amount</label>

                        <input type="text" class="form-control" id="payment_due_amount" readonly>

                    </div>

                    <div class="mb-3">

                        <label class="form-label">Payment Amount <span class="text-danger">*</span></label>

                        <input type="number" step="0.01" class="form-control" name="payment_amount" id="payment_amount" required>

                    </div>

                    <div class="mb-3">

                        <label class="form-label">Payment Date <span class="text-danger">*</span></label>

                        <input type="text" class="form-control" name="payment_date" id="payment_date" placeholder="dd/mm/yyyy" autocomplete="off" required>

                    </div>

                    <div class="mb-3">

                        <label class="form-label">Payment Method</label>

                        <select class="form-control" name="payment_method" id="payment_method">

                            <option value="">Select Method</option>

                            <option value="Cash">Cash</option>

                            <option value="Card">Card</option>

                            <option value="UPI">UPI</option>

                            <option value="Bank Transfer">Bank Transfer</option>

                            <option value="Cheque">Cheque</option>

                        </select>

                    </div>

                    <div class="mb-3">

                        <label class="form-label">Reference Number</label>

                        <input type="text" class="form-control" name="payment_reference" id="payment_reference" placeholder="Transaction/Receipt No.">

                    </div>

                    <div class="mb-3">

                        <label class="form-label">Payment Slip <span class="text-danger">*</span></label>

                        <input type="file" class="form-control" id="payment_slip" accept=".jpg,.jpeg,.png,.pdf" multiple style="display:none;">

                        <button type="button" class="btn btn-primary btn-sm" onclick="$('#payment_slip').click();"><i class="fas fa-plus me-1"></i> Add Files</button>

                        <div id="payment_slip_list" class="mt-2"></div>

                        <small class="text-muted">JPG, JPEG, PNG, or PDF. Maximum 20 MB per file. Add one or more files.</small>

                    </div>

                    <div class="mb-3">

                        <label class="form-label">Remarks</label>

                        <textarea class="form-control" name="payment_remarks" id="payment_remarks" rows="2"></textarea>

                    </div>

                </form>

            </div>

            <div class="modal-footer">

                <button type="button" class="btn btn-secondary" data-bs-dismiss="modal">Close</button>

                <button type="button" class="btn btn-success" onclick="savePayment()">Record Payment</button>

            </div>

        </div>

    </div>

</div>



<!-- Delete Modal -->

<div class="modal fade" id="deleteModal" role="dialog">

    <div class="modal-dialog" role="document">

        <div class="modal-content">

            <div class="modal-header">

                <h5 class="modal-title">Delete Payment Schedule</h5>

                <button type="button" class="btn-close" data-bs-dismiss="modal"></button>

            </div>

            <div class="modal-body">

                <input type="hidden" id="delete_scheduler_id">

                <p>Are you sure you want to delete this payment schedule?</p>

                <p class="text-danger"><small>This will also delete all installment records.</small></p>

            </div>

            <div class="modal-footer">

                <button type="button" class="btn btn-secondary" data-bs-dismiss="modal">Cancel</button>

                <button type="button" class="btn btn-danger" onclick="confirmDelete()">Delete</button>

            </div>

        </div>

    </div>

</div>

