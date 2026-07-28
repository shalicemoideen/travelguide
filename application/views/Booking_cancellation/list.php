<style>
.bc-header-bar {
    background: linear-gradient(90deg, #d64550, #f0736f);
    color: #fff;
    border-radius: 10px 10px 0 0;
    padding: 12px 18px;
    font-weight: 700;
    font-size: 16px;
    display: flex;
    justify-content: space-between;
    align-items: center;
    flex-wrap: wrap;
    gap: 10px;
}
.bc-filter-card {
    border: 1px solid #e5e7eb;
    border-radius: 8px;
    padding: 14px;
    background: #fbfbfd;
    margin-bottom: 18px;
}
.bc-tile {
    border: 1px solid #e5e7eb;
    border-radius: 8px;
    padding: 12px 14px;
    background: #fff;
    height: 100%;
}
.bc-tile .lbl { color: #6b7280; font-size: 12px; margin-bottom: 2px; }
.bc-tile .val { color: #111827; font-weight: 700; font-size: 15px; }
.bc-tile.is-danger .val  { color: #dc3545; }
.bc-tile.is-success .val { color: #198754; }
.bc-step-head {
    font-weight: 700;
    color: #111827;
    border-bottom: 2px solid #f1f1f4;
    padding-bottom: 8px;
    margin-bottom: 14px;
}
.bc-money { text-align: right; font-variant-numeric: tabular-nums; }
.bc-pill {
    font-size: 11px;
    padding: 3px 10px;
    border-radius: 999px;
    font-weight: 600;
    display: inline-block;
}
.bc-days-badge {
    background: #fff3cd;
    color: #664d03;
    border-radius: 6px;
    padding: 4px 12px;
    font-weight: 700;
    font-size: 13px;
}
.bc-days-badge.is-past { background: #f8d7da; color: #842029; }
#bcCreateModal table th { font-size: 12px; white-space: nowrap; }
#bcCreateModal table td { font-size: 13px; vertical-align: middle; }
.bc-confirm-guard { max-width: 220px; }
</style>

<div class="content-body">
    <div class="container-fluid">

        <div class="card">
            <div class="bc-header-bar">
                <span><i class="la la-ban me-2"></i>Booking Cancellation</span>
                <?php if (has_permission('BOOKING_CANCELLATION_CREATE')): ?>
                <button type="button" class="btn btn-light btn-sm fw-bold" id="bcNewBtn">
                    <i class="la la-plus me-1"></i> New Cancellation
                </button>
                <?php endif; ?>
            </div>

            <div class="card-body">

                <input type="hidden" id="bc_preselect_quotation"
                       value="<?php echo isset($preselect_quotation) ? (int)$preselect_quotation : 0; ?>">

                <!-- ============ FILTERS ============ -->
                <div class="bc-filter-card">
                    <div class="row g-3">
                        <div class="col-md-2">
                            <label class="form-label mb-1">Cancelled From</label>
                            <input type="text" class="form-control form-control-sm bc-date" id="f_start_date" placeholder="dd/mm/yyyy" autocomplete="off">
                        </div>
                        <div class="col-md-2">
                            <label class="form-label mb-1">Cancelled To</label>
                            <input type="text" class="form-control form-control-sm bc-date" id="f_end_date" placeholder="dd/mm/yyyy" autocomplete="off">
                        </div>
                        <div class="col-md-2">
                            <label class="form-label mb-1">Booking No</label>
                            <input type="text" class="form-control form-control-sm" id="f_quotation_number" placeholder="Booking no">
                        </div>
                        <div class="col-md-2">
                            <label class="form-label mb-1">Guest</label>
                            <input type="text" class="form-control form-control-sm" id="f_guest_name" placeholder="Guest name">
                        </div>
                        <div class="col-md-2">
                            <label class="form-label mb-1">Reason</label>
                            <select class="form-control form-control-sm" id="f_reason">
                                <option value="">All</option>
                                <?php foreach ($reasons as $r): ?>
                                    <option value="<?php echo (int)$r->cancellation_reason_id; ?>">
                                        <?php echo htmlspecialchars($r->reason_name); ?>
                                    </option>
                                <?php endforeach; ?>
                            </select>
                        </div>
                        <div class="col-md-2">
                            <label class="form-label mb-1">Status</label>
                            <select class="form-control form-control-sm" id="f_status">
                                <option value="">All</option>
                                <option value="DRAFT">Draft</option>
                                <option value="PENDING_APPROVAL">Pending Approval</option>
                                <option value="APPROVED">Approved</option>
                                <option value="SETTLED">Settled</option>
                                <option value="REJECTED">Rejected</option>
                                <option value="REVERSED">Reversed</option>
                            </select>
                        </div>
                        <div class="col-md-2">
                            <label class="form-label mb-1">Customer Refund</label>
                            <select class="form-control form-control-sm" id="f_customer_settlement">
                                <option value="">All</option>
                                <option value="NOT_APPLICABLE">Not Applicable</option>
                                <option value="PENDING">Pending</option>
                                <option value="PARTIAL">Partial</option>
                                <option value="COMPLETED">Completed</option>
                                <option value="WRITTEN_OFF">Written Off</option>
                            </select>
                        </div>
                        <div class="col-md-2">
                            <label class="form-label mb-1">Supplier Refund</label>
                            <select class="form-control form-control-sm" id="f_supplier_settlement">
                                <option value="">All</option>
                                <option value="NOT_APPLICABLE">Not Applicable</option>
                                <option value="PENDING">Pending</option>
                                <option value="PARTIAL">Partial</option>
                                <option value="COMPLETED">Completed</option>
                                <option value="WRITTEN_OFF">Written Off</option>
                            </select>
                        </div>
                        <div class="col-md-2">
                            <label class="form-label mb-1">Sales Staff</label>
                            <select class="form-control form-control-sm" id="f_staff">
                                <option value="">All</option>
                                <?php foreach ($staff as $s): ?>
                                    <option value="<?php echo (int)$s->user_id; ?>">
                                        <?php echo htmlspecialchars($s->user_name); ?>
                                    </option>
                                <?php endforeach; ?>
                            </select>
                        </div>
                        <div class="col-md-4 d-flex align-items-end gap-2">
                            <button type="button" class="btn btn-primary btn-sm" id="bcApplyFilter">
                                <i class="la la-search me-1"></i> Apply
                            </button>
                            <button type="button" class="btn btn-outline-secondary btn-sm" id="bcResetFilter">
                                <i class="la la-refresh me-1"></i> Reset
                            </button>
                        </div>
                    </div>
                </div>

                <!-- ============ TABLE ============ -->
                <div class="table-responsive">
                    <table class="table table-hover table-sm display" id="bcTable" style="width:100%">
                        <thead>
                            <tr>
                                <th>Cancellation No</th>
                                <th>Booking No</th>
                                <th>Guest</th>
                                <th>Cancelled On</th>
                                <th>Reason</th>
                                <th class="bc-money">Retained</th>
                                <th class="bc-money">Refunded</th>
                                <th class="bc-money">Supplier Pending</th>
                                <th class="bc-money">Net Result</th>
                                <th>Status</th>
                                <th class="text-center">Action</th>
                            </tr>
                        </thead>
                        <tbody></tbody>
                    </table>
                </div>

            </div>
        </div>
    </div>
</div>


<!-- =========================================================
     CREATE WIZARD
========================================================= -->
<div class="modal fade" id="bcCreateModal" tabindex="-1" data-bs-backdrop="static">
    <div class="modal-dialog modal-xl modal-dialog-scrollable">
        <div class="modal-content">
            <div class="modal-header">
                <h5 class="modal-title fw-bold"><i class="la la-ban me-2"></i>New Booking Cancellation</h5>
                <button type="button" class="btn-close" data-bs-dismiss="modal"></button>
            </div>

            <div class="modal-body">

                <!-- ---------- STEP 1 ---------- -->
                <div id="bcStep1">
                    <div class="bc-step-head">Step 1 &mdash; Booking, reason &amp; scope</div>

                    <div class="row g-3 mb-3">
                        <div class="col-md-6">
                            <label class="form-label">Booking <span class="text-danger">*</span></label>
                            <select class="form-control" id="bc_quotation_id">
                                <option value="">Select a confirmed booking</option>
                                <?php foreach ($bookings as $b): ?>
                                    <option value="<?php echo (int)$b->quotation_id; ?>">
                                        <?php echo htmlspecialchars($b->quotation_number . ' - ' . $b->guest_name); ?>
                                    </option>
                                <?php endforeach; ?>
                            </select>
                            <small class="text-muted">Only confirmed bookings without an active cancellation are listed.</small>
                        </div>
                        <div class="col-md-6 d-flex align-items-end">
                            <div id="bc_days_wrap"></div>
                        </div>
                    </div>

                    <div id="bcWorksheetWrap" style="display:none;">

                        <div class="row g-3 mb-3">
                            <div class="col-md-3"><div class="bc-tile"><div class="lbl">Guest</div><div class="val" id="ws_guest">-</div></div></div>
                            <div class="col-md-3"><div class="bc-tile"><div class="lbl">Travel Date</div><div class="val" id="ws_travel">-</div></div></div>
                            <div class="col-md-3"><div class="bc-tile"><div class="lbl">Package Value</div><div class="val bc-money" id="ws_package">0.00</div></div></div>
                            <div class="col-md-3"><div class="bc-tile is-success"><div class="lbl">Received from Customer</div><div class="val bc-money" id="ws_received">0.00</div></div></div>
                        </div>
                        <div class="row g-3 mb-4">
                            <div class="col-md-3"><div class="bc-tile"><div class="lbl">Customer Outstanding</div><div class="val bc-money" id="ws_outstanding">0.00</div></div></div>
                            <div class="col-md-3"><div class="bc-tile"><div class="lbl">Supplier Booked</div><div class="val bc-money" id="ws_supplier_booked">0.00</div></div></div>
                            <div class="col-md-3"><div class="bc-tile is-danger"><div class="lbl">Paid to Suppliers</div><div class="val bc-money" id="ws_supplier_paid">0.00</div></div></div>
                            <div class="col-md-3"><div class="bc-tile"><div class="lbl">Other Services Paid</div><div class="val bc-money" id="ws_service_paid">0.00</div></div></div>
                        </div>

                        <div class="row g-3 mb-3">
                            <div class="col-md-4">
                                <label class="form-label">Cancellation Reason <span class="text-danger">*</span></label>
                                <select class="form-control" id="bc_reason_id">
                                    <option value="">Select reason</option>
                                    <?php foreach ($reasons as $r): ?>
                                        <option value="<?php echo (int)$r->cancellation_reason_id; ?>"
                                                data-category="<?php echo htmlspecialchars($r->reason_category); ?>"
                                                data-waivable="<?php echo (int)$r->is_charge_waivable; ?>">
                                            <?php echo htmlspecialchars($r->reason_name); ?>
                                        </option>
                                    <?php endforeach; ?>
                                </select>
                                <small class="text-muted" id="bc_reason_hint"></small>
                            </div>
                            <div class="col-md-2">
                                <label class="form-label">Request Date <span class="text-danger">*</span></label>
                                <input type="text" class="form-control bc-date" id="bc_request_date" placeholder="dd/mm/yyyy" autocomplete="off">
                            </div>
                            <div class="col-md-2">
                                <label class="form-label">Effective Date <span class="text-danger">*</span></label>
                                <input type="text" class="form-control bc-date" id="bc_effective_date" placeholder="dd/mm/yyyy" autocomplete="off">
                            </div>
                            <div class="col-md-4">
                                <label class="form-label">Scope</label>
                                <select class="form-control" id="bc_scope">
                                    <option value="FULL">Full cancellation (booking becomes Cancelled)</option>
                                    <option value="PARTIAL">Partial &mdash; drop selected properties only</option>
                                </select>
                                <small class="text-muted">Partial keeps the booking confirmed; it is an amendment.</small>
                            </div>
                        </div>

                        <div class="mb-3">
                            <label class="form-label">Notes</label>
                            <textarea class="form-control" id="bc_notes" rows="2" placeholder="Context, guest's wording, reference to email/WhatsApp"></textarea>
                        </div>

                        <div class="bc-step-head">Properties in scope</div>
                        <div class="table-responsive mb-3">
                            <table class="table table-sm table-bordered mb-0" id="bcPropertyTable">
                                <thead class="table-light">
                                    <tr>
                                        <th style="width:40px;" class="text-center"><input type="checkbox" id="bcCheckAll" checked></th>
                                        <th>Property</th>
                                        <th>Check In</th>
                                        <th>Check Out</th>
                                        <th>Cut-off</th>
                                        <th>Blocking</th>
                                        <th class="bc-money">Reserved</th>
                                        <th class="bc-money">Paid</th>
                                        <th class="bc-money">Outstanding</th>
                                    </tr>
                                </thead>
                                <tbody></tbody>
                            </table>
                        </div>

                        <div id="bcServiceWrap" style="display:none;">
                            <div class="bc-step-head">Other services (carried into the cancellation)</div>
                            <div class="table-responsive mb-2">
                                <table class="table table-sm table-bordered mb-0" id="bcServiceTable">
                                    <thead class="table-light">
                                        <tr>
                                            <th>Type</th>
                                            <th>Vendor</th>
                                            <th>Description</th>
                                            <th class="bc-money">Amount</th>
                                        </tr>
                                    </thead>
                                    <tbody></tbody>
                                </table>
                            </div>
                            <small class="text-muted">
                                Amounts paid to these vendors are entered on the cancellation detail page.
                            </small>
                        </div>
                    </div>

                    <div id="bcBlockers" class="alert alert-danger mt-3" style="display:none;"></div>
                </div>

                <!-- ---------- STEP 2 ---------- -->
                <div id="bcStep2" style="display:none;">
                    <div class="bc-step-head">Step 2 &mdash; Review &amp; create draft</div>

                    <div class="alert alert-info">
                        Creating the draft does <strong>not</strong> cancel the booking. The booking status changes
                        only when the cancellation is approved. Hotel cancellation charges and refunds are recorded
                        afterwards on the cancellation detail page.
                    </div>

                    <div class="row g-3 mb-3">
                        <div class="col-md-4"><div class="bc-tile"><div class="lbl">Booking</div><div class="val" id="rv_booking">-</div></div></div>
                        <div class="col-md-4"><div class="bc-tile"><div class="lbl">Reason</div><div class="val" id="rv_reason">-</div></div></div>
                        <div class="col-md-4"><div class="bc-tile"><div class="lbl">Scope</div><div class="val" id="rv_scope">-</div></div></div>
                    </div>
                    <div class="row g-3 mb-4">
                        <div class="col-md-3"><div class="bc-tile is-success"><div class="lbl">Received from Customer</div><div class="val bc-money" id="rv_received">0.00</div></div></div>
                        <div class="col-md-3"><div class="bc-tile is-danger"><div class="lbl">Paid to Suppliers</div><div class="val bc-money" id="rv_supplier_paid">0.00</div></div></div>
                        <div class="col-md-3"><div class="bc-tile"><div class="lbl">Properties in Scope</div><div class="val" id="rv_property_count">0</div></div></div>
                        <div class="col-md-3"><div class="bc-tile"><div class="lbl">Effective Date</div><div class="val" id="rv_effective">-</div></div></div>
                    </div>

                    <div class="mb-2">
                        <label class="form-label">Type <code>CANCEL</code> to confirm <span class="text-danger">*</span></label>
                        <input type="text" class="form-control bc-confirm-guard" id="bc_guard" placeholder="CANCEL" autocomplete="off">
                    </div>
                </div>

            </div>

            <div class="modal-footer">
                <button type="button" class="btn btn-light" data-bs-dismiss="modal">Close</button>
                <button type="button" class="btn btn-outline-secondary" id="bcBackBtn" style="display:none;">
                    <i class="la la-arrow-left me-1"></i> Back
                </button>
                <button type="button" class="btn btn-primary" id="bcNextBtn" disabled>
                    Next <i class="la la-arrow-right ms-1"></i>
                </button>
                <button type="button" class="btn btn-danger" id="bcSubmitBtn" style="display:none;">
                    <i class="la la-save me-1"></i> Create Draft
                </button>
            </div>
        </div>
    </div>
</div>
