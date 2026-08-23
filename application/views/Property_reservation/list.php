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

                <!-- Properties replaced on the confirmation page. Retained so the
                     amount already committed to them stays visible and can be
                     cancelled and credited. -->
                <div id="supersededPanel" class="alert alert-secondary border-secondary mb-4" style="display:none;">
                    <strong><i class="fas fa-exchange-alt me-1"></i> Previously Selected Properties</strong>
                    <div class="small text-muted mb-2">
                        The client changed property on the confirmation page. Cancellation is offered only where an amount was already paid; the rest are kept as history.
                    </div>
                    <div class="table-responsive">
                        <table class="table table-sm table-bordered align-middle mb-0" id="supersededTable">
                            <thead class="table-light">
                                <tr>
                                    <th>Property</th>
                                    <th>Replaced By</th>
                                    <th>Check In</th>
                                    <th class="text-end">Reserved Amount</th>
                                    <th class="text-end">Amount Paid</th>
                                    <th>Status</th>
                                    <th class="text-center">Action</th>
                                </tr>
                            </thead>
                            <tbody></tbody>
                        </table>
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

                    <!-- Property Credit Detection -->
                    <div id="creditPanel" class="alert alert-warning border-warning mb-3" style="display:none;">
                        <div class="d-flex align-items-center justify-content-between">
                            <div>
                                <i class="fas fa-wallet text-warning me-1"></i>
                                <strong>Available Property Credit Detected</strong>
                                <span id="creditTotalBadge" class="badge bg-warning text-dark ms-2">₹0.00</span>
                            </div>
                            <button type="button" class="btn btn-sm btn-outline-warning" onclick="openCreditModal()">
                                <i class="fas fa-plus me-1"></i> Apply Credit
                            </button>
                        </div>
                        <div id="creditList" class="mt-2 small"></div>
                    </div>

                    <!-- Applied Credits Summary -->
                    <div id="appliedCreditsPanel" class="alert alert-success border-success mb-3" style="display:none;">
                        <strong><i class="fas fa-check-circle me-1"></i> Property Credit Applied to This Booking</strong>
                        <div id="appliedCreditsList" class="mt-2 small"></div>
                    </div>

                    <input type="hidden" id="property_reservation_id" value="">

                    <!-- Property Rent + Property-based Inclusions -->
                    <div class="row g-3 mb-4">
                        <div class="col-md-4">
                            <div class="pr-info-box">
                                <div class="lbl">Property Rent</div>
                                <div class="val">INR <span id="rent_breakdown_total">0.00</span></div>
                            </div>
                        </div>
                        <div class="col-md-8">
                            <div class="pr-info-box">
                                <div class="lbl">Property-based Inclusions</div>
                                <div id="inclusions_detail_list" class="val" style="font-weight:500;">-</div>
                            </div>
                        </div>
                    </div>

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
                                                        <label class="form-label fw-bold">Select Payment Terms <span class="text-danger">*</span></label>
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
                                                        <div style="background:linear-gradient(135deg,#2e7d32,#43a047);color:#fff;padding:8px 16px;border-radius:8px;font-size:20px;font-weight:700;display:inline-block;">INR <span id="payment_total_display">0</span></div>
                                                        <input type="hidden" name="total_amount" id="total_amount" value="0">
                                                        <div class="mt-2 d-flex align-items-center justify-content-end gap-2">
                                                            <label class="form-label mb-0 text-muted">Actual Amount</label>
                                                            <input type="number" min="0" step="0.01" class="form-control form-control-sm" id="actual_amount" name="actual_amount" value="0" style="width:120px;" oninput="pr_applyActualAmount()">
                                                            <input type="hidden" id="discount_amount" name="discount_amount" value="0">
                                                            <input type="hidden" id="discounted_total" name="discounted_total" value="0">
                                                        </div>
                                                        <div class="mt-1 text-success fw-bold" id="discounted_total_display" style="display:none;">Net Payable: INR <span id="discounted_total_val">0</span></div>
                                                    </div>
                                                </div>

                                                <!-- FULL / On Account -->
                                                <div id="fullSection" class="mt-3" style="display:none;">
                                                    <div class="option-block" style="margin-bottom:0;">
                                                        <div style="background:linear-gradient(135deg,#2e7d32,#43a047);color:#fff;padding:10px 16px;border-radius:8px 8px 0 0;font-size:15px;font-weight:700;">
                                                            <i class="fas fa-money-bill-wave me-1"></i> Full Payment Details
                                                        </div>
                                                        <div style="background:#fff;border-radius:0 0 8px 8px;overflow:hidden;box-shadow:0 1px 3px rgba(0,0,0,.08);">
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
                                                                                <input type="text" class="form-control form-control-sm" id="cutoff_date_display" placeholder="dd/mm/yyyy" autocomplete="off">
                                                                                <input type="hidden" name="cutoff_date" id="cutoff_date">
                                                                            </td>
                                                                        </tr>
                                                                    </tbody>
                                                                </table>
                                                            </div>
                                                        </div>
                                                    </div>
                                                </div>

                                                <!-- EMI / Installments -->
                                                <div id="emiSection" class="mt-3" style="display:none;">
                                                    <div class="option-block" style="margin-bottom:0;">
                                                        <div style="background:linear-gradient(135deg,#e65100,#f57c00);color:#fff;padding:10px 16px;border-radius:8px 8px 0 0;font-size:15px;font-weight:700;display:flex;justify-content:space-between;align-items:center;">
                                                            <span><i class="fas fa-calendar-check me-1"></i> EMI Configuration</span>
                                                            <span style="background:rgba(255,255,255,.25);padding:4px 12px;border-radius:6px;font-size:16px;font-weight:700;">Total: <span id="emi_total_display" style="font-size:18px;">₹0.00</span></span>
                                                        </div>
                                                        <div style="background:#fff;border-radius:0 0 8px 8px;overflow:hidden;box-shadow:0 1px 3px rgba(0,0,0,.08);padding:16px;">
                                                            <div class="row g-3 mb-2">
                                                                <div class="col-md-3">
                                                                    <label class="form-label">No. of Installments <span class="text-danger">*</span></label>
                                                                    <input type="number" min="2" max="24" value="3" class="form-control" id="max_emi_count" name="max_emi_count" onchange="generateEmiRows()">
                                                                </div>
                                                                <div class="col-md-3">
                                                                    <label class="form-label">Split By <span class="text-danger">*</span></label>
                                                                    <select class="form-control" id="split_type" name="split_type" onchange="generateEmiRows()">
                                                                        <option value="AMOUNT">Fixed Amount</option>
                                                                        <option value="PERCENTAGE">Percentage</option>
                                                                    </select>
                                                                </div>
                                                                <div class="col-md-3">
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
                                                                            <th width="80" style="background:#fff3e0;color:#e65100;font-size:12px;text-transform:uppercase;letter-spacing:.3px;">#</th>
                                                                            <th id="emiValHeader" style="background:#fff3e0;color:#e65100;font-size:12px;text-transform:uppercase;letter-spacing:.3px;">Amount</th>
                                                                            <th width="160" style="background:#fff3e0;color:#e65100;font-size:12px;text-transform:uppercase;letter-spacing:.3px;">Due Date</th>
                                                                            <th width="140" style="background:#fff3e0;color:#e65100;font-size:12px;text-transform:uppercase;letter-spacing:.3px;">Calculated</th>
                                                                        </tr>
                                                                    </thead>
                                                                    <tbody id="emiTableBody"></tbody>
                                                                    <tfoot>
                                                                        <tr style="background:#fff3e0;">
                                                                            <td colspan="3" style="text-align:right;"><strong>Total</strong></td>
                                                                            <td id="emiCalcTotal" style="font-size:16px;font-weight:700;color:#e65100;">0.00</td>
                                                                        </tr>
                                                                    </tfoot>
                                                                </table>
                                                            </div>
                                                        </div>
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
                            <span style="font-size:14px;font-weight:600;" id="pr_view_quotation">-</span>
                        </div>
                        <div class="col-md-3" style="padding:12px 16px;border-bottom:1px solid #e5e7eb;border-right:1px solid #e5e7eb;">
                            <small style="font-size:11px;color:#6b7280;text-transform:uppercase;letter-spacing:.5px;display:block;margin-bottom:3px;">Guest Name</small>
                            <span style="font-size:14px;font-weight:600;" id="pr_view_guest">-</span>
                        </div>
                        <div class="col-md-3" style="padding:12px 16px;border-bottom:1px solid #e5e7eb;border-right:1px solid #e5e7eb;">
                            <small style="font-size:11px;color:#6b7280;text-transform:uppercase;letter-spacing:.5px;display:block;margin-bottom:3px;">Property</small>
                            <span style="font-size:14px;font-weight:600;" id="pr_view_property">-</span>
                        </div>
                        <div class="col-md-3" style="padding:12px 16px;">
                            <small style="font-size:11px;color:#6b7280;text-transform:uppercase;letter-spacing:.5px;display:block;margin-bottom:3px;">Payment Type</small>
                            <span style="font-size:14px;font-weight:600;" id="pr_view_type">-</span>
                        </div>
                    </div>
                </div>
                <!-- Summary Cards -->
                <div class="row mb-3">
                    <div class="col-md-3">
                        <div style="background:#fff;border-radius:8px;padding:14px 16px;text-align:center;box-shadow:0 1px 3px rgba(0,0,0,.08);border:1px solid #e5e7eb;">
                            <div style="font-size:11px;text-transform:uppercase;letter-spacing:.5px;color:#6b7280;margin-bottom:6px;">Total</div>
                            <div style="font-size:18px;font-weight:700;color:#64748b;" id="pr_view_total">₹0.00</div>
                        </div>
                    </div>
                    <div class="col-md-3">
                        <div style="background:linear-gradient(135deg,#2e7d32,#388e3c);border-radius:8px;padding:14px 16px;text-align:center;box-shadow:0 1px 3px rgba(0,0,0,.08);">
                            <div style="font-size:11px;text-transform:uppercase;letter-spacing:.5px;color:rgba(255,255,255,.8);margin-bottom:6px;">Paid</div>
                            <div style="font-size:18px;font-weight:700;color:#fff;" id="pr_view_paid">₹0.00</div>
                        </div>
                    </div>
                    <div class="col-md-3">
                        <div style="background:linear-gradient(135deg,#f59e0b,#d97706);border-radius:8px;padding:14px 16px;text-align:center;box-shadow:0 1px 3px rgba(0,0,0,.08);">
                            <div style="font-size:11px;text-transform:uppercase;letter-spacing:.5px;color:rgba(255,255,255,.8);margin-bottom:6px;">Pending</div>
                            <div style="font-size:18px;font-weight:700;color:#fff;" id="pr_view_pending">₹0.00</div>
                        </div>
                    </div>
                    <div class="col-md-3">
                        <div style="background:linear-gradient(135deg,#dc2626,#b91c1c);border-radius:8px;padding:14px 16px;text-align:center;box-shadow:0 1px 3px rgba(0,0,0,.08);">
                            <div style="font-size:11px;text-transform:uppercase;letter-spacing:.5px;color:rgba(255,255,255,.8);margin-bottom:6px;">Overdue</div>
                            <div style="font-size:18px;font-weight:700;color:#fff;" id="pr_view_overdue">0</div>
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
                            <table class="table table-bordered table-sm mb-0">
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
                                <tbody id="pr_installments_body"></tbody>
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

<!-- Record Payment Modal -->
<div class="modal fade" id="prRecordPaymentModal" tabindex="-1" role="dialog">
    <div class="modal-dialog" role="document">
        <div class="modal-content">
            <div class="modal-header">
                <h5 class="modal-title">Record Payment</h5>
                <button type="button" class="btn-close" data-bs-dismiss="modal"></button>
            </div>
            <div class="modal-body">
                <form id="prPaymentForm" enctype="multipart/form-data">
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
                        <input type="text" class="form-control" name="payment_date" id="pr_pay_date" placeholder="dd/mm/yyyy" autocomplete="off" required>
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
                        <label class="form-label">Payment Slip <span class="text-danger">*</span></label>
                        <input type="file" class="form-control" id="pr_pay_slip" accept=".jpg,.jpeg,.png,.pdf" multiple style="display:none;">
                        <button type="button" class="btn btn-primary btn-sm" onclick="$('#pr_pay_slip').click();"><i class="fas fa-plus me-1"></i> Add Files</button>
                        <div id="pr_pay_slip_list" class="mt-2"></div>
                        <small class="text-muted">JPG, JPEG, PNG, or PDF. Maximum 20 MB per file. Add one or more files.</small>
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

<!-- Cancel Superseded Property Reservation -->
<div class="modal fade" id="prCancelReservationModal" tabindex="-1" role="dialog">
    <div class="modal-dialog" role="document">
        <div class="modal-content">
            <div class="modal-header">
                <h5 class="modal-title"><i class="fas fa-ban me-1"></i> Cancel Property Reservation</h5>
                <button type="button" class="btn-close" data-bs-dismiss="modal"></button>
            </div>
            <div class="modal-body">
                <div class="alert alert-warning py-2 small mb-3">
                    The client replaced <strong id="cancelResPropertyName">this property</strong>.
                    Enter the amount the property is holding for us — it is recorded in Property Credit
                    Management and can be applied to a future booking with the same property.
                </div>

                <input type="hidden" id="cancel_res_id" value="">

                <div class="row g-3">
                    <div class="col-md-6">
                        <div class="pr-info-box">
                            <div class="lbl">Reserved Amount</div>
                            <div class="val">INR <span id="cancelResReserved">0.00</span></div>
                        </div>
                    </div>
                    <div class="col-md-6">
                        <div class="pr-info-box">
                            <div class="lbl">Amount Paid</div>
                            <div class="val">INR <span id="cancelResPaid">0.00</span></div>
                        </div>
                    </div>
                </div>

                <div class="row g-3 mt-1">
                    <div class="col-md-6">
                        <label class="form-label">Cancellation Amount <span class="text-danger">*</span></label>
                        <input type="number" step="0.01" min="0" class="form-control" id="cancel_res_amount" value="0.00">
                        <small class="text-muted">Cannot exceed the amount paid. Enter 0 if nothing is recoverable.</small>
                    </div>
                    <div class="col-md-6">
                        <label class="form-label">Cancellation Date <span class="text-danger">*</span></label>
                        <input type="text" class="form-control datepicker" id="cancel_res_date" placeholder="dd/mm/yyyy" autocomplete="off">
                    </div>
                    <div class="col-md-6">
                        <label class="form-label">Credit Reference No</label>
                        <input type="text" class="form-control" id="cancel_res_reference" placeholder="Hotel credit reference">
                    </div>
                    <div class="col-md-6">
                        <label class="form-label">Credit Expiry Date</label>
                        <input type="text" class="form-control datepicker" id="cancel_res_expiry" placeholder="dd/mm/yyyy" autocomplete="off">
                        <small class="text-muted">Leave blank if the credit does not expire.</small>
                    </div>
                    <div class="col-12">
                        <label class="form-label">Reason / Remarks</label>
                        <textarea class="form-control" id="cancel_res_reason" rows="2" placeholder="Why the reservation was cancelled"></textarea>
                    </div>
                </div>
            </div>
            <div class="modal-footer">
                <button type="button" class="btn btn-secondary" data-bs-dismiss="modal">Close</button>
                <button type="button" class="btn btn-danger" id="cancelResSubmitBtn" onclick="submitCancelReservation()">
                    <i class="fas fa-ban me-1"></i> Cancel Reservation &amp; Record Credit
                </button>
            </div>
        </div>
    </div>
</div>

<!-- Property Credit Application Modal -->
<div class="modal fade" id="prCreditModal" tabindex="-1" role="dialog">
    <div class="modal-dialog modal-lg" role="document">
        <div class="modal-content">
            <div class="modal-header">
                <h5 class="modal-title"><i class="fas fa-wallet me-1"></i> Apply Property Credit</h5>
                <button type="button" class="btn-close" data-bs-dismiss="modal"></button>
            </div>
            <div class="modal-body">
                <div class="alert alert-info py-2 small mb-3">
                    Select one or more credits to apply against this booking. The credit amount will reduce
                    the supplier payable for this property.
                </div>
                <div class="table-responsive">
                    <table class="table table-bordered table-sm" id="creditModalTable">
                        <thead class="table-light">
                            <tr>
                                <th width="40">Apply</th>
                                <th>Credit From</th>
                                <th>Booking</th>
                                <th class="text-end">Remaining</th>
                                <th class="text-end">Apply Amount</th>
                                <th>Expiry</th>
                            </tr>
                        </thead>
                        <tbody id="creditModalBody"></tbody>
                    </table>
                </div>
                <div class="text-end mt-2">
                    <strong>Total Credit Applied: </strong>
                    <span id="creditApplyTotal" class="text-success">₹0.00</span>
                </div>
            </div>
            <div class="modal-footer">
                <button type="button" class="btn btn-secondary" data-bs-dismiss="modal">Cancel</button>
                <button type="button" class="btn btn-success" onclick="applySelectedCredits()">
                    <i class="fas fa-check me-1"></i> Apply Selected Credit(s)
                </button>
            </div>
        </div>
    </div>
</div>

<!-- Property Credit History Modal -->
<div class="modal fade" id="prCreditHistoryModal" tabindex="-1" role="dialog">
    <div class="modal-dialog modal-xl" role="document">
        <div class="modal-content">
            <div class="modal-header">
                <h5 class="modal-title"><i class="fas fa-history me-1"></i> Property Credit History</h5>
                <button type="button" class="btn-close" data-bs-dismiss="modal"></button>
            </div>
            <div class="modal-body">
                <div class="table-responsive">
                    <table class="table table-bordered table-sm" id="creditHistoryTable">
                        <thead class="table-light">
                            <tr>
                                <th>#</th><th>Credit From</th><th>Booking</th>
                                <th class="text-end">Credit</th>
                                <th class="text-end">Used</th>
                                <th class="text-end">Remaining</th>
                                <th>Status</th><th>Expiry</th><th>Created</th>
                            </tr>
                        </thead>
                        <tbody id="creditHistoryBody"></tbody>
                    </table>
                </div>
            </div>
            <div class="modal-footer">
                <button type="button" class="btn btn-secondary" data-bs-dismiss="modal">Close</button>
            </div>
        </div>
    </div>
</div>

<!-- Receipts Modal -->
<div class="modal fade" id="prReceiptsModal" tabindex="-1" role="dialog">
    <div class="modal-dialog" role="document" style="max-width: 800px;">
        <div class="modal-content">
            <div class="modal-header" style="background:linear-gradient(135deg,#4a3ee0,#5a4ff0);">
                <h5 class="modal-title text-white"><i class="fas fa-history me-1"></i> Payment History</h5>
                <button type="button" class="btn-close" data-bs-dismiss="modal"></button>
            </div>
            <div class="modal-body">
                <div class="option-block" style="margin-bottom:0;">
                    <div style="background:linear-gradient(135deg,#4a3ee0,#5a4ff0);color:#fff;padding:10px 16px;border-radius:8px 8px 0 0;font-size:15px;font-weight:700;">
                        <i class="fas fa-receipt me-1"></i> Payment Records
                    </div>
                    <div style="background:#fff;border-radius:0 0 8px 8px;overflow:hidden;box-shadow:0 1px 3px rgba(0,0,0,.08);">
                        <div class="table-responsive">
                            <table class="table table-bordered table-sm mb-0">
                                <thead>
                                    <tr>
                                        <th style="background:#eef2ff;color:#4a3ee0;font-size:12px;text-transform:uppercase;letter-spacing:.3px;">Date</th>
                                        <th style="background:#eef2ff;color:#4a3ee0;font-size:12px;text-transform:uppercase;letter-spacing:.3px;">Amount</th>
                                        <th style="background:#eef2ff;color:#4a3ee0;font-size:12px;text-transform:uppercase;letter-spacing:.3px;">Method</th>
                                        <th style="background:#eef2ff;color:#4a3ee0;font-size:12px;text-transform:uppercase;letter-spacing:.3px;">Reference</th>
                                        <th style="background:#eef2ff;color:#4a3ee0;font-size:12px;text-transform:uppercase;letter-spacing:.3px;">Received By</th>
                                        <th style="background:#eef2ff;color:#4a3ee0;font-size:12px;text-transform:uppercase;letter-spacing:.3px;">Action</th>
                                    </tr>
                                </thead>
                                <tbody id="pr_receipts_body"></tbody>
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
