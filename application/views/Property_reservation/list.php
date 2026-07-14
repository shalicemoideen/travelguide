<style>
.pr-header-bar {
    background: linear-gradient(90deg, #6f6af8, #8a85ff);
    color: #fff;
    border-radius: 10px 10px 0 0;
    padding: 12px 18px;
    font-weight: 700;
    font-size: 16px;
}
.pr-info-box {
    border: 1px solid #e5e7eb;
    border-radius: 8px;
    padding: 12px 14px;
    background: #fff;
    height: 100%;
}
.pr-info-box .lbl { color: #6b7280; font-size: 12px; }
.pr-info-box .val { color: #111827; font-weight: 700; font-size: 14px; }
.pr-section-title {
    font-weight: 700;
    color: #111827;
}
.pr-accordion .accordion-button {
    font-weight: 700;
    color: #111827;
}
.pr-status-pill {
    font-size: 11px;
    padding: 2px 10px;
    border-radius: 999px;
    margin-left: 10px;
}
.pr-payment-head {
    background: linear-gradient(90deg, #6f6af8, #8a85ff);
    color: #fff;
    padding: 8px 14px;
    border-radius: 8px 8px 0 0;
    font-weight: 700;
}
</style>

<div class="content-body">
    <div class="container-fluid">
        <div class="card">
            <div class="pr-header-bar">Hotel Reservation Status</div>
            <div class="card-body">

                <input type="hidden" id="preselect_quotation" value="<?php echo isset($preselect_quotation) ? (int)$preselect_quotation : 0; ?>">

                <!-- Booking + Property selectors -->
                <div class="row g-3 mb-4">
                    <div class="col-md-5">
                        <label class="form-label">Booking No</label>
                        <select class="form-control" id="booking_select">
                            <option value="">Select Booking</option>
                            <?php foreach ($bookings as $b): ?>
                                <option value="<?php echo $b->quotation_id; ?>">
                                    <?php echo $b->quotation_number; ?> - <?php echo $b->guest_name; ?>
                                </option>
                            <?php endforeach; ?>
                        </select>
                    </div>
                    <div class="col-md-3" id="option_wrap" style="display:none;">
                        <label class="form-label">Option</label>
                        <select class="form-control" id="option_select">
                            <option value="">Select Option</option>
                        </select>
                    </div>
                    <div class="col-md-4">
                        <label class="form-label">Property</label>
                        <select class="form-control" id="property_select" disabled>
                            <option value="">Select Property</option>
                        </select>
                    </div>
                </div>

                <!-- Reservation panel (hidden until property selected) -->
                <div id="reservation_panel" style="display:none;">

                    <!-- Info boxes -->
                    <div class="row g-3 mb-3">
                        <div class="col-md-4"><div class="pr-info-box"><div class="lbl">Property</div><div class="val" id="info_property">-</div></div></div>
                        <div class="col-md-4"><div class="pr-info-box"><div class="lbl">Guest</div><div class="val" id="info_guest">-</div></div></div>
                        <div class="col-md-4"><div class="pr-info-box"><div class="lbl">Booking No</div><div class="val" id="info_booking">-</div></div></div>
                    </div>
                    <div class="row g-3 mb-4">
                        <div class="col-md-4"><div class="pr-info-box"><div class="lbl">Check In</div><div class="val" id="info_checkin">-</div></div></div>
                        <div class="col-md-4"><div class="pr-info-box"><div class="lbl">Check Out</div><div class="val" id="info_checkout">-</div></div></div>
                        <div class="col-md-4"><div class="pr-info-box"><div class="lbl">Duration</div><div class="val" id="info_duration">-</div></div></div>
                    </div>

                    <input type="hidden" id="property_reservation_id" value="">

                    <div class="accordion pr-accordion" id="prAccordion">

                        <!-- LEVEL 1: Hotel Blocking -->
                        <div class="accordion-item">
                            <h2 class="accordion-header">
                                <button class="accordion-button collapsed" type="button" data-bs-toggle="collapse" data-bs-target="#collapseBlocking">
                                    Hotel Blocking Details
                                    <span class="pr-status-pill bg-secondary text-white" id="pill_blocking">PENDING</span>
                                </button>
                            </h2>
                            <div id="collapseBlocking" class="accordion-collapse collapse" data-bs-parent="#prAccordion">
                                <div class="accordion-body">
                                    <form id="blockingForm">
                                        <div class="row g-3">
                                            <div class="col-md-4">
                                                <label class="form-label">CNFM By</label>
                                                <input type="text" class="form-control" name="blocking_cnfm_by" id="blocking_cnfm_by">
                                            </div>
                                            <div class="col-md-4">
                                                <label class="form-label">Cut-off Date</label>
                                                <input type="date" class="form-control" name="blocking_cutoff_date" id="blocking_cutoff_date">
                                            </div>
                                            <div class="col-md-4">
                                                <label class="form-label">Blocked Date</label>
                                                <input type="date" class="form-control" name="blocking_date" id="blocking_date">
                                            </div>
                                        </div>
                                        <div class="text-center mt-3">
                                            <button type="button" class="btn btn-primary" onclick="saveBlocking()">Submit</button>
                                        </div>
                                    </form>
                                </div>
                            </div>
                        </div>

                        <!-- LEVEL 2: Reservation Confirmation -->
                        <div class="accordion-item">
                            <h2 class="accordion-header">
                                <button class="accordion-button collapsed" type="button" data-bs-toggle="collapse" data-bs-target="#collapseConfirm">
                                    Reservation Confirmation Details
                                    <span class="pr-status-pill bg-secondary text-white" id="pill_confirm">PENDING</span>
                                </button>
                            </h2>
                            <div id="collapseConfirm" class="accordion-collapse collapse" data-bs-parent="#prAccordion">
                                <div class="accordion-body">
                                    <form id="confirmForm">
                                        <div class="row g-3">
                                            <div class="col-md-4">
                                                <label class="form-label">CNFM By</label>
                                                <input type="text" class="form-control" name="confirmation_cnfm_by" id="confirmation_cnfm_by">
                                            </div>
                                            <div class="col-md-4">
                                                <label class="form-label">CNFM No</label>
                                                <input type="text" class="form-control" name="confirmation_cnfm_no" id="confirmation_cnfm_no">
                                            </div>
                                            <div class="col-md-4">
                                                <label class="form-label">CNFM Date</label>
                                                <input type="date" class="form-control" name="confirmation_cnfm_date" id="confirmation_cnfm_date">
                                            </div>
                                        </div>

                                        <!-- Payment Scheduler -->
                                        <div class="mt-4">
                                            <div class="pr-payment-head">Payment Scheduler</div>
                                            <div class="border border-top-0 rounded-bottom p-3">
                                                <div class="d-flex justify-content-between align-items-start flex-wrap">
                                                    <div>
                                                        <label class="form-label fw-bold">Select Payment Terms</label>
                                                        <div class="form-check">
                                                            <input class="form-check-input" type="radio" name="payment_type" id="pt_full" value="FULL" onchange="togglePaymentType()">
                                                            <label class="form-check-label" for="pt_full">On Account</label>
                                                        </div>
                                                        <div class="form-check">
                                                            <input class="form-check-input" type="radio" name="payment_type" id="pt_emi" value="EMI" onchange="togglePaymentType()">
                                                            <label class="form-check-label" for="pt_emi">In Installments</label>
                                                        </div>
                                                    </div>
                                                    <div class="text-end">
                                                        <div class="text-muted">Total Amount</div>
                                                        <div class="h4 mb-0">INR <span id="payment_total_display">0</span></div>
                                                        <input type="hidden" name="total_amount" id="total_amount" value="0">
                                                        <div class="mt-2 d-flex align-items-center justify-content-end gap-2">
                                                            <label class="form-label mb-0 text-muted">Discount</label>
                                                            <input type="number" min="0" step="0.01" class="form-control form-control-sm" id="discount_amount" name="discount_amount" value="0" style="width:120px;" oninput="pr_applyDiscount()">
                                                            <input type="hidden" id="discounted_total" name="discounted_total" value="0">
                                                        </div>
                                                        <div class="mt-1 text-success fw-bold" id="discounted_total_display" style="display:none;">Net Payable: INR <span id="discounted_total_val">0</span></div>
                                                    </div>
                                                </div>

                                                <!-- FULL / On Account -->
                                                <div id="fullSection" class="mt-3" style="display:none;">
                                                    <div class="row g-3">
                                                        <div class="col-md-4">
                                                            <label class="form-label">Payment Cut-off Date</label>
                                                            <input type="text" class="form-control" id="cutoff_date_display" placeholder="dd/mm/yyyy" autocomplete="off">
                                                            <input type="hidden" name="cutoff_date" id="cutoff_date">
                                                        </div>
                                                    </div>
                                                </div>

                                                <!-- EMI / Installments -->
                                                <div id="emiSection" class="mt-3" style="display:none;">
                                                    <div class="row g-3 mb-2">
                                                        <div class="col-md-3">
                                                            <label class="form-label">No. of Installments</label>
                                                            <input type="number" min="2" max="24" value="3" class="form-control" id="max_emi_count" name="max_emi_count" onchange="generateEmiRows()">
                                                        </div>
                                                        <div class="col-md-3">
                                                            <label class="form-label">Split By</label>
                                                            <select class="form-control" id="split_type" name="split_type" onchange="generateEmiRows()">
                                                                <option value="AMOUNT">Fixed Amount</option>
                                                                <option value="PERCENTAGE">Percentage</option>
                                                            </select>
                                                        </div>
                                                    </div>
                                                    <div class="table-responsive">
                                                        <table class="table table-bordered table-sm" id="emiTable">
                                                            <thead class="table-light">
                                                                <tr>
                                                                    <th width="80">#</th>
                                                                    <th id="emiValHeader">Amount</th>
                                                                    <th width="160">Due Date</th>
                                                                    <th width="140">Calculated</th>
                                                                </tr>
                                                            </thead>
                                                            <tbody id="emiTableBody"></tbody>
                                                            <tfoot>
                                                                <tr class="table-warning">
                                                                    <td colspan="3" class="text-end"><strong>Total</strong></td>
                                                                    <td id="emiCalcTotal">0.00</td>
                                                                </tr>
                                                            </tfoot>
                                                        </table>
                                                    </div>
                                                </div>
                                            </div>
                                        </div>

                                        <div class="text-center mt-3 d-flex gap-2 justify-content-center">
                                            <button type="button" class="btn btn-primary" onclick="saveConfirmation()">Submit</button>
                                            <button type="button" class="btn btn-info" id="btn_view_payments" style="display:none!important;" onclick="prViewPaymentSummary()"><i class="fas fa-eye"></i> View Payments</button>
                                        </div>
                                    </form>
                                </div>
                            </div>
                        </div>

                        <!-- LEVEL 3: Re-confirmation -->
                        <div class="accordion-item">
                            <h2 class="accordion-header">
                                <button class="accordion-button collapsed" type="button" data-bs-toggle="collapse" data-bs-target="#collapseRecon">
                                    Re-confirmation Details
                                    <span class="pr-status-pill bg-secondary text-white" id="pill_recon">PENDING</span>
                                </button>
                            </h2>
                            <div id="collapseRecon" class="accordion-collapse collapse" data-bs-parent="#prAccordion">
                                <div class="accordion-body">
                                    <form id="reconForm">
                                        <div class="row g-3">
                                            <div class="col-md-4">
                                                <label class="form-label">CNFM By</label>
                                                <input type="text" class="form-control" name="reconfirmation_cnfm_by" id="reconfirmation_cnfm_by">
                                            </div>
                                            <div class="col-md-4">
                                                <label class="form-label">CNFM No</label>
                                                <input type="text" class="form-control" name="reconfirmation_cnfm_no" id="reconfirmation_cnfm_no">
                                            </div>
                                            <div class="col-md-4">
                                                <label class="form-label">RE-CNFM Date</label>
                                                <input type="date" class="form-control" name="reconfirmation_date" id="reconfirmation_date">
                                            </div>
                                        </div>
                                        <div class="text-center mt-3">
                                            <button type="button" class="btn btn-primary" onclick="saveReconfirmation()">Submit</button>
                                        </div>
                                    </form>
                                </div>
                            </div>
                        </div>

                        <!-- Comments -->
                        <div class="accordion-item">
                            <h2 class="accordion-header">
                                <button class="accordion-button collapsed" type="button" data-bs-toggle="collapse" data-bs-target="#collapseComments">
                                    Comments
                                </button>
                            </h2>
                            <div id="collapseComments" class="accordion-collapse collapse" data-bs-parent="#prAccordion">
                                <div class="accordion-body">
                                    <div class="input-group mb-3">
                                        <input type="text" class="form-control" id="comment_text" placeholder="Add a comment...">
                                        <button class="btn btn-primary" type="button" onclick="addComment()">Add</button>
                                    </div>
                                    <ul class="list-group" id="commentsList"></ul>
                                </div>
                            </div>
                        </div>

                    </div>
                </div>

            </div>
        </div>
    </div>
</div>

<!-- Payment Summary Modal -->
<div class="modal fade" id="prPaymentSummaryModal" tabindex="-1" role="dialog">
    <div class="modal-dialog modal-xl" role="document">
        <div class="modal-content">
            <div class="modal-header">
                <h5 class="modal-title">Payment Summary</h5>
                <button type="button" class="btn-close" data-bs-dismiss="modal"></button>
            </div>
            <div class="modal-body">
                <div class="row mb-3">
                    <div class="col-md-4">
                        <div class="card bg-success text-white">
                            <div class="card-body text-center py-2">
                                <small>Paid</small>
                                <h5 class="mb-0" id="pr_view_paid">₹0.00</h5>
                            </div>
                        </div>
                    </div>
                    <div class="col-md-4">
                        <div class="card bg-warning">
                            <div class="card-body text-center py-2">
                                <small>Pending</small>
                                <h5 class="mb-0" id="pr_view_pending">₹0.00</h5>
                            </div>
                        </div>
                    </div>
                    <div class="col-md-4">
                        <div class="card bg-danger text-white">
                            <div class="card-body text-center py-2">
                                <small>Overdue</small>
                                <h5 class="mb-0" id="pr_view_overdue">0</h5>
                            </div>
                        </div>
                    </div>
                </div>
                <div class="table-responsive">
                    <table class="table table-bordered table-sm">
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
                        <tbody id="pr_installments_body"></tbody>
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
<div class="modal fade" id="prRecordPaymentModal" tabindex="-1" role="dialog">
    <div class="modal-dialog" role="document">
        <div class="modal-content">
            <div class="modal-header">
                <h5 class="modal-title">Record Payment</h5>
                <button type="button" class="btn-close" data-bs-dismiss="modal"></button>
            </div>
            <div class="modal-body">
                <form id="prPaymentForm">
                    <input type="hidden" name="installment_id" id="pr_pay_installment_id">
                    <input type="hidden" name="scheduler_id" id="pr_pay_scheduler_id">
                    <div class="mb-3">
                        <label class="form-label">Due Amount</label>
                        <input type="text" class="form-control" id="pr_pay_due_amount" readonly>
                    </div>
                    <div class="mb-3">
                        <label class="form-label">Payment Amount <span class="text-danger">*</span></label>
                        <input type="number" step="0.01" class="form-control" name="payment_amount" id="pr_pay_amount" required>
                    </div>
                    <div class="mb-3">
                        <label class="form-label">Payment Date <span class="text-danger">*</span></label>
                        <input type="date" class="form-control" name="payment_date" id="pr_pay_date" required>
                    </div>
                    <div class="mb-3">
                        <label class="form-label">Payment Method</label>
                        <select class="form-control" name="payment_method" id="pr_pay_method">
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
                        <input type="text" class="form-control" name="payment_reference" id="pr_pay_ref" placeholder="Transaction/Receipt No.">
                    </div>
                    <div class="mb-3">
                        <label class="form-label">Remarks</label>
                        <textarea class="form-control" name="payment_remarks" id="pr_pay_remarks" rows="2"></textarea>
                    </div>
                </form>
            </div>
            <div class="modal-footer">
                <button type="button" class="btn btn-secondary" data-bs-dismiss="modal">Cancel</button>
                <button type="button" class="btn btn-success" onclick="prSavePayment()">Record Payment</button>
            </div>
        </div>
    </div>
</div>

<!-- Receipts Modal -->
<div class="modal fade" id="prReceiptsModal" tabindex="-1" role="dialog">
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
                                <th width="90">Action</th>
                            </tr>
                        </thead>
                        <tbody id="pr_receipts_body"></tbody>
                    </table>
                </div>
            </div>
            <div class="modal-footer">
                <button type="button" class="btn btn-secondary" data-bs-dismiss="modal">Close</button>
            </div>
        </div>
    </div>
</div>
