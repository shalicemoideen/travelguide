<style>
.bcd-header {
    background: linear-gradient(90deg, #d64550, #f0736f);
    color: #fff;
    border-radius: 10px 10px 0 0;
    padding: 14px 18px;
    display: flex;
    justify-content: space-between;
    align-items: center;
    flex-wrap: wrap;
    gap: 12px;
}
.bcd-header .num { font-weight: 700; font-size: 18px; }
.bcd-header .sub { font-size: 12px; opacity: .9; }
.bcd-tile {
    border: 1px solid #e5e7eb;
    border-radius: 8px;
    padding: 12px 14px;
    background: #fff;
    height: 100%;
}
.bcd-tile .lbl { color: #6b7280; font-size: 12px; margin-bottom: 3px; }
.bcd-tile .val { color: #111827; font-weight: 700; font-size: 16px; }
.bcd-tile.accent-green  { border-left: 4px solid #198754; }
.bcd-tile.accent-red    { border-left: 4px solid #dc3545; }
.bcd-tile.accent-amber  { border-left: 4px solid #ffc107; }
.bcd-tile.accent-blue   { border-left: 4px solid #0d6efd; }
.bcd-money { text-align: right; font-variant-numeric: tabular-nums; }
.bcd-pill {
    font-size: 11px; padding: 3px 10px; border-radius: 999px; font-weight: 600; display: inline-block;
}
.bcd-pnl {
    border: 1px solid #e5e7eb; border-radius: 10px; overflow: hidden; background: #fff;
}
.bcd-pnl .row-line {
    display: flex; justify-content: space-between; padding: 10px 16px; border-bottom: 1px solid #f1f1f4;
    font-size: 14px;
}
.bcd-pnl .row-line:last-child { border-bottom: none; }
.bcd-pnl .row-line.total { background: #f8f9fb; font-weight: 700; font-size: 16px; }
.bcd-pnl .amt { font-variant-numeric: tabular-nums; font-weight: 600; }
.bcd-section-title { font-weight: 700; color: #111827; margin-bottom: 12px; }
.nav-tabs .nav-link { font-weight: 600; color: #6b7280; }
.nav-tabs .nav-link.active { color: #d64550; }
.bcd-sub-table th { font-size: 12px; white-space: nowrap; background: #f8f9fb; }
.bcd-sub-table td { font-size: 13px; vertical-align: middle; }
.bcd-reversed { text-decoration: line-through; opacity: .6; }
.bcd-locked-note { font-size: 12px; color: #6b7280; }
</style>

<?php
$cid    = (int)$cancellation_id;
$status = $header->cancellation_status;
$editable  = in_array($status, array('DRAFT', 'PENDING_APPROVAL'));
$money_open = in_array($status, array('APPROVED', 'SETTLED'));
?>

<div class="content-body">
    <div class="container-fluid">

        <input type="hidden" id="bcd_id" value="<?php echo $cid; ?>">

        <div class="card">
            <div class="bcd-header">
                <div>
                    <div class="num">
                        <i class="la la-ban me-2"></i><?php echo htmlspecialchars($header->cancellation_number); ?>
                        <?php if ($header->cancellation_scope === 'PARTIAL'): ?>
                            <span class="bcd-pill" style="background:#fff;color:#0a58ca;">PARTIAL</span>
                        <?php endif; ?>
                    </div>
                    <div class="sub">
                        Booking <?php echo htmlspecialchars($header->quotation_number); ?>
                        &middot; <?php echo htmlspecialchars($header->guest_name); ?>
                        &middot; Cancelled <?php echo $header->cancellation_effective_date
                                ? date('d/m/Y', strtotime($header->cancellation_effective_date)) : '-'; ?>
                        <?php if ($header->days_before_travel !== null): ?>
                            &middot; <?php echo (int)$header->days_before_travel < 0
                                ? abs((int)$header->days_before_travel) . 'd after departure'
                                : (int)$header->days_before_travel . 'd before travel'; ?>
                        <?php endif; ?>
                    </div>
                </div>
                <div class="d-flex align-items-center gap-2 flex-wrap">
                    <span id="bcd_status_pill"></span>

                    <?php if ($status === 'DRAFT' && has_permission('BOOKING_CANCELLATION_CREATE')): ?>
                        <button class="btn btn-light btn-sm fw-bold" id="bcdSubmitApproval">
                            <i class="la la-paper-plane me-1"></i> Submit for Approval
                        </button>
                    <?php endif; ?>

                    <?php if ($status === 'PENDING_APPROVAL' && has_permission('BOOKING_CANCELLATION_APPROVE')): ?>
                        <button class="btn btn-success btn-sm fw-bold" id="bcdApprove">
                            <i class="la la-check me-1"></i> Approve
                        </button>
                        <button class="btn btn-outline-light btn-sm fw-bold" id="bcdReject">
                            <i class="la la-times me-1"></i> Reject
                        </button>
                    <?php endif; ?>

                    <?php if ($money_open && has_permission('BOOKING_CANCELLATION_REVERSE')): ?>
                        <button class="btn btn-outline-light btn-sm" id="bcdReverse" style="display:none;">
                            <i class="la la-undo me-1"></i> Reverse
                        </button>
                    <?php endif; ?>

                    <a href="<?php echo base_url(); ?>index.php/Booking_cancellation" class="btn btn-outline-light btn-sm">
                        <i class="la la-list me-1"></i> All
                    </a>
                </div>
            </div>

            <div class="card-body">

                <?php if ($status === 'REJECTED'): ?>
                    <div class="alert alert-danger">
                        <strong>Rejected</strong> by <?php echo htmlspecialchars($header->approved_by_username); ?>
                        &mdash; <?php echo htmlspecialchars($header->rejected_reason); ?>
                    </div>
                <?php elseif ($status === 'REVERSED'): ?>
                    <div class="alert alert-warning">
                        <strong>Reversed</strong> by <?php echo htmlspecialchars($header->reversed_by_username); ?>
                        on <?php echo $header->reversed_datetime ? date('d/m/Y', strtotime($header->reversed_datetime)) : '-'; ?>
                        &mdash; <?php echo htmlspecialchars($header->reversed_reason); ?>
                    </div>
                <?php elseif ($status === 'DRAFT'): ?>
                    <div class="alert alert-info mb-3">
                        This is a <strong>draft</strong>. The booking is still
                        <strong><?php echo htmlspecialchars(
                            $this->Booking_cancellation_model->status_label($header->quotation_current_status)); ?></strong>.
                        Refunds unlock only after approval.
                    </div>
                <?php elseif ($status === 'PENDING_APPROVAL'): ?>
                    <div class="alert alert-warning mb-3">
                        Awaiting approval. Requested by
                        <strong><?php echo htmlspecialchars($header->requested_by_username); ?></strong>.
                    </div>
                <?php endif; ?>

                <!-- ============ SUMMARY TILES ============ -->
                <div class="row g-3 mb-3">
                    <div class="col-md-3"><div class="bcd-tile accent-blue">
                        <div class="lbl">Package Value</div><div class="val bcd-money" id="t_package">0.00</div></div></div>
                    <div class="col-md-3"><div class="bcd-tile accent-green">
                        <div class="lbl">Received from Customer</div><div class="val bcd-money" id="t_received">0.00</div></div></div>
                    <div class="col-md-3"><div class="bcd-tile accent-amber">
                        <div class="lbl">Cancellation Charge (Retained)</div><div class="val bcd-money" id="t_charge">0.00</div></div></div>
                    <div class="col-md-3"><div class="bcd-tile accent-red">
                        <div class="lbl">Customer Refund Balance</div><div class="val bcd-money" id="t_cust_balance">0.00</div>
                        <div class="mt-1" id="t_cust_pill"></div></div></div>
                </div>
                <div class="row g-3 mb-4">
                    <div class="col-md-3"><div class="bcd-tile">
                        <div class="lbl">Paid to Suppliers</div><div class="val bcd-money" id="t_supp_paid">0.00</div></div></div>
                    <div class="col-md-3"><div class="bcd-tile accent-amber">
                        <div class="lbl">Supplier Refund Expected</div><div class="val bcd-money" id="t_supp_expected">0.00</div></div></div>
                    <div class="col-md-3"><div class="bcd-tile accent-red">
                        <div class="lbl">Supplier Refund Pending</div><div class="val bcd-money" id="t_supp_pending">0.00</div>
                        <div class="mt-1" id="t_supp_pill"></div></div></div>
                    <div class="col-md-3"><div class="bcd-tile" id="t_net_tile">
                        <div class="lbl">Net Result</div><div class="val bcd-money" id="t_net">0.00</div>
                        <div class="bcd-locked-note" id="t_net_note"></div></div></div>
                </div>

                <!-- ============ TABS ============ -->
                <ul class="nav nav-tabs mb-3" role="tablist">
                    <li class="nav-item"><button class="nav-link active" data-bs-toggle="tab" data-bs-target="#tabCustomer" type="button">
                        <i class="la la-user me-1"></i> Customer Side</button></li>
                    <li class="nav-item"><button class="nav-link" data-bs-toggle="tab" data-bs-target="#tabSupplier" type="button">
                        <i class="la la-hotel me-1"></i> Properties <span class="badge bg-secondary" id="cnt_properties">0</span></button></li>
                    <li class="nav-item"><button class="nav-link" data-bs-toggle="tab" data-bs-target="#tabServices" type="button">
                        <i class="la la-bus me-1"></i> Other Services <span class="badge bg-secondary" id="cnt_services">0</span></button></li>
                    <li class="nav-item"><button class="nav-link" data-bs-toggle="tab" data-bs-target="#tabAdjust" type="button">
                        <i class="la la-sliders-h me-1"></i> Adjustments <span class="badge bg-secondary" id="cnt_adjustments">0</span></button></li>
                    <li class="nav-item"><button class="nav-link" data-bs-toggle="tab" data-bs-target="#tabPnl" type="button">
                        <i class="la la-calculator me-1"></i> P&amp;L</button></li>
                    <li class="nav-item"><button class="nav-link" data-bs-toggle="tab" data-bs-target="#tabInfo" type="button">
                        <i class="la la-info-circle me-1"></i> Details</button></li>
                </ul>

                <div class="tab-content">

                    <!-- ---------- CUSTOMER ---------- -->
                    <div class="tab-pane fade show active" id="tabCustomer">

                        <?php if (has_permission('BOOKING_CANCELLATION_CHARGE')
                                  && !in_array($status, array('REJECTED', 'REVERSED'))): ?>
                        <div class="border rounded p-3 mb-4" style="background:#fbfbfd;">
                            <div class="bcd-section-title">Cancellation charge retained from the customer</div>
                            <div class="row g-3 align-items-end">
                                <div class="col-md-3">
                                    <label class="form-label mb-1">Charge Amount</label>
                                    <input type="number" step="0.01" min="0" class="form-control" id="cc_amount">
                                </div>
                                <div class="col-md-3">
                                    <label class="form-label mb-1">Suggested (supplier cost)</label>
                                    <input type="text" class="form-control" id="cc_suggested" readonly>
                                </div>
                                <div class="col-md-2" style="display:none;">
                                    <div class="form-check mt-4">
                                        <input class="form-check-input" type="checkbox" id="cc_override">
                                        <label class="form-check-label" for="cc_override">Override</label>
                                    </div>
                                </div>
                                <div class="col-md-4" style="display:none;">
                                    <label class="form-label mb-1">Justification (required if overriding)</label>
                                    <input type="text" class="form-control" id="cc_note" placeholder="Why the suggested figure is not used">
                                </div>
                            </div>
                            <div class="mt-3">
                                <button class="btn btn-primary btn-sm" id="ccSave">
                                    <i class="la la-save me-1"></i> Save Charge
                                </button>
                                <span class="bcd-locked-note ms-2">
                                    Refund due = received &minus; charge. Recalculated instantly.
                                </span>
                            </div>
                        </div>
                        <?php endif; ?>

                        <div class="d-flex justify-content-between align-items-center mb-2">
                            <div class="bcd-section-title mb-0">Customer refund ledger</div>
                            <?php if ($money_open && has_permission('BOOKING_CANCELLATION_REFUND_CUSTOMER')): ?>
                            <button class="btn btn-danger btn-sm" id="crAddBtn">
                                <i class="la la-plus me-1"></i> Record Refund
                            </button>
                            <?php endif; ?>
                        </div>

                        <?php if (!$money_open): ?>
                            <div class="alert alert-secondary py-2 bcd-locked-note mb-2">
                                Refunds unlock once the cancellation is approved.
                            </div>
                        <?php endif; ?>

                        <div class="table-responsive">
                            <table class="table table-sm table-bordered bcd-sub-table mb-0" id="crTable">
                                <thead>
                                    <tr>
                                        <th>#</th><th>Date</th><th>Mode</th><th>Reference</th>
                                        <th class="bcd-money">Amount</th><th>Approval</th>
                                        <th>Paid By</th><th>Proof</th><th class="text-center">Action</th>
                                    </tr>
                                </thead>
                                <tbody></tbody>
                            </table>
                        </div>
                    </div>

                    <!-- ---------- SUPPLIER / PROPERTIES ---------- -->
                    <div class="tab-pane fade" id="tabSupplier">
                        <div class="bcd-section-title">Property-wise cancellation charges &amp; refund recovery</div>
                        <div id="propertyCards"></div>

                        <div class="mt-4" id="creditLedgerSection" style="display:none;">
                            <div class="bcd-section-title">
                                <i class="la la-wallet me-1"></i> Property Credit Ledger
                            </div>
                            <div class="alert alert-secondary py-2 bcd-locked-note mb-2">
                                Credits created when a property retains the refund amount for future bookings.
                            </div>
                            <div class="table-responsive">
                                <table class="table table-sm table-bordered bcd-sub-table mb-0" id="creditLedgerTable">
                                    <thead>
                                        <tr>
                                            <th>#</th><th>Property</th><th>Original Booking</th>
                                            <th class="bcd-money">Credit Amount</th>
                                            <th class="bcd-money">Used</th>
                                            <th class="bcd-money">Remaining</th>
                                            <th>Status</th><th>Expiry</th>
                                            <th>Reference</th><th>Created</th>
                                        </tr>
                                    </thead>
                                    <tbody></tbody>
                                </table>
                            </div>
                        </div>
                    </div>

                    <!-- ---------- SERVICES ---------- -->
                    <div class="tab-pane fade" id="tabServices">
                        <div class="d-flex justify-content-between align-items-center mb-2">
                            <div class="bcd-section-title mb-0">Non-property services</div>
                            <?php if (has_permission('BOOKING_CANCELLATION_CHARGE')
                                      && !in_array($status, array('REJECTED', 'REVERSED'))): ?>
                            <button class="btn btn-primary btn-sm" id="svcAddBtn">
                                <i class="la la-plus me-1"></i> Add Service Line
                            </button>
                            <?php endif; ?>
                        </div>
                        <div class="alert alert-secondary py-2 bcd-locked-note">
                            Transport, visa, guide and inclusion costs. Without these the net result is understated.
                        </div>
                        <div class="table-responsive">
                            <table class="table table-sm table-bordered bcd-sub-table mb-0" id="svcTable">
                                <thead>
                                    <tr>
                                        <th>Type</th><th>Vendor</th><th>Description</th>
                                        <th class="bcd-money">Amount</th><th class="bcd-money">Paid</th>
                                        <th class="bcd-money">Charge</th><th class="bcd-money">Refund Expected</th>
                                        <th class="bcd-money">Refund Received</th><th>Recoverable</th>
                                        <th class="text-center">Action</th>
                                    </tr>
                                </thead>
                                <tbody></tbody>
                            </table>
                        </div>
                    </div>

                    <!-- ---------- ADJUSTMENTS ---------- -->
                    <div class="tab-pane fade" id="tabAdjust">
                        <div class="d-flex justify-content-between align-items-center mb-2">
                            <div class="bcd-section-title mb-0">Adjustments, write-offs &amp; goodwill</div>
                            <?php if (has_permission('BOOKING_CANCELLATION_ADJUST')
                                      && !in_array($status, array('REJECTED', 'REVERSED'))): ?>
                            <button class="btn btn-primary btn-sm" id="adjAddBtn">
                                <i class="la la-plus me-1"></i> Add Adjustment
                            </button>
                            <?php endif; ?>
                        </div>
                        <div class="alert alert-secondary py-2 bcd-locked-note">
                            <strong>CREDIT</strong> increases company income. <strong>DEBIT</strong> increases company cost.
                            Adjustments feed straight into the net result and can be deleted if entered in error.
                        </div>
                        <div class="table-responsive">
                            <table class="table table-sm table-bordered bcd-sub-table mb-0" id="adjTable">
                                <thead>
                                    <tr>
                                        <th>Type</th><th>Side</th><th>Dir</th>
                                        <th class="bcd-money">Amount</th><th>Reason</th><th>By</th><th>On</th><th class="text-center">Action</th>
                                    </tr>
                                </thead>
                                <tbody></tbody>
                            </table>
                        </div>
                    </div>

                    <!-- ---------- P&L ---------- -->
                    <div class="tab-pane fade" id="tabPnl">
                        <div class="row">
                            <div class="col-lg-7">
                                <div class="bcd-section-title">Cancellation profit &amp; loss</div>
                                <div class="bcd-pnl">
                                    <div class="row-line">
                                        <span>Retained from customer <small class="text-muted">(received &minus; refunded)</small></span>
                                        <span class="amt text-success" id="p_retained">0.00</span>
                                    </div>
                                    <div class="row-line">
                                        <span>Less: net paid to properties <small class="text-muted">(paid &minus; recovered + still payable)</small></span>
                                        <span class="amt text-danger" id="p_suppliers">0.00</span>
                                    </div>
                                    <div class="row-line">
                                        <span>Less: other service cost</span>
                                        <span class="amt text-danger" id="p_other">0.00</span>
                                    </div>
                                    <div class="row-line">
                                        <span>Adjustments <small class="text-muted">(credit &minus; debit)</small></span>
                                        <span class="amt" id="p_adjust">0.00</span>
                                    </div>
                                    <div class="row-line total">
                                        <span>Net Result</span>
                                        <span class="amt" id="p_net">0.00</span>
                                    </div>
                                </div>
                                <div class="bcd-locked-note mt-2" id="p_computed"></div>
                            </div>
                            <div class="col-lg-5">
                                <div class="bcd-section-title">Snapshot at cancellation</div>
                                <div class="bcd-pnl">
                                    <div class="row-line"><span>Package value</span><span class="amt" id="p_package">0.00</span></div>
                                    <div class="row-line"><span>Received from customer</span><span class="amt" id="p_received">0.00</span></div>
                                    <div class="row-line"><span>Customer outstanding (uncollected)</span><span class="amt" id="p_outstanding">0.00</span></div>
                                    <div class="row-line"><span>Supplier booked</span><span class="amt" id="p_supp_booked">0.00</span></div>
                                    <div class="row-line"><span>Supplier paid</span><span class="amt" id="p_supp_paid">0.00</span></div>
                                    <div class="row-line"><span>Supplier charge assessed</span><span class="amt" id="p_supp_charge">0.00</span></div>
                                    <div class="row-line"><span>Still payable to properties</span><span class="amt text-danger" id="p_supp_payable">0.00</span></div>
                                </div>
                            </div>
                        </div>
                    </div>

                    <!-- ---------- INFO ---------- -->
                    <div class="tab-pane fade" id="tabInfo">
                        <div class="row g-3">
                            <div class="col-md-6">
                                <?php if ($editable && has_permission('BOOKING_CANCELLATION_CREATE')): ?>
                                <div class="border rounded p-3" style="background:#fbfbfd;">
                                    <div class="bcd-section-title">Reason &amp; dates</div>
                                    <div class="mb-3">
                                        <label class="form-label mb-1">Reason</label>
                                        <select class="form-control" id="hd_reason">
                                            <?php foreach ($reasons as $r): ?>
                                                <option value="<?php echo (int)$r->cancellation_reason_id; ?>"
                                                    <?php echo (int)$header->cancellation_reason_id_fk === (int)$r->cancellation_reason_id ? 'selected' : ''; ?>>
                                                    <?php echo htmlspecialchars($r->reason_name); ?>
                                                </option>
                                            <?php endforeach; ?>
                                        </select>
                                    </div>
                                    <div class="row g-2 mb-3">
                                        <div class="col-6">
                                            <label class="form-label mb-1">Request Date</label>
                                            <input type="text" class="form-control bcd-date" id="hd_request_date"
                                                   value="<?php echo $header->cancellation_request_date
                                                        ? date('d/m/Y', strtotime($header->cancellation_request_date)) : ''; ?>">
                                        </div>
                                        <div class="col-6">
                                            <label class="form-label mb-1">Effective Date</label>
                                            <input type="text" class="form-control bcd-date" id="hd_effective_date"
                                                   value="<?php echo $header->cancellation_effective_date
                                                        ? date('d/m/Y', strtotime($header->cancellation_effective_date)) : ''; ?>">
                                        </div>
                                    </div>
                                    <div class="mb-3">
                                        <label class="form-label mb-1">Notes</label>
                                        <textarea class="form-control" id="hd_notes" rows="3"><?php
                                            echo htmlspecialchars($header->cancellation_reason_notes); ?></textarea>
                                    </div>
                                    <button class="btn btn-primary btn-sm" id="hdSave">
                                        <i class="la la-save me-1"></i> Save
                                    </button>
                                </div>
                                <?php else: ?>
                                <div class="bcd-pnl">
                                    <div class="row-line"><span>Reason</span><span><?php echo htmlspecialchars($header->reason_name); ?></span></div>
                                    <div class="row-line"><span>Category</span><span><?php echo htmlspecialchars($header->reason_category); ?></span></div>
                                    <div class="row-line"><span>Request date</span><span><?php echo $header->cancellation_request_date
                                        ? date('d/m/Y', strtotime($header->cancellation_request_date)) : '-'; ?></span></div>
                                    <div class="row-line"><span>Effective date</span><span><?php echo $header->cancellation_effective_date
                                        ? date('d/m/Y', strtotime($header->cancellation_effective_date)) : '-'; ?></span></div>
                                    <div class="row-line"><span>Notes</span><span><?php echo nl2br(htmlspecialchars($header->cancellation_reason_notes)); ?></span></div>
                                </div>
                                <?php endif; ?>
                            </div>
                            <div class="col-md-6">
                                <div class="bcd-section-title">Trail</div>
                                <div class="bcd-pnl">
                                    <div class="row-line"><span>Requested by</span>
                                        <span><?php echo htmlspecialchars($header->requested_by_username); ?></span></div>
                                    <div class="row-line"><span>Requested on</span>
                                        <span><?php echo $header->booking_cancellation_created_datetime
                                            ? date('d/m/Y H:i', strtotime($header->booking_cancellation_created_datetime)) : '-'; ?></span></div>
                                    <div class="row-line"><span>Approved by</span>
                                        <span><?php echo htmlspecialchars($header->approved_by_username ?: '-'); ?></span></div>
                                    <div class="row-line"><span>Approved on</span>
                                        <span><?php echo $header->approved_datetime
                                            ? date('d/m/Y H:i', strtotime($header->approved_datetime)) : '-'; ?></span></div>
                                    <div class="row-line"><span>Settled on</span>
                                        <span><?php echo $header->settled_datetime
                                            ? date('d/m/Y H:i', strtotime($header->settled_datetime)) : '-'; ?></span></div>
                                    <div class="row-line"><span>Sales staff</span>
                                        <span><?php echo htmlspecialchars($header->staff_name ?: '-'); ?></span></div>
                                    <div class="row-line"><span>Travel dates</span>
                                        <span><?php echo $header->start_date ? date('d/m/Y', strtotime($header->start_date)) : '-'; ?>
                                              &rarr; <?php echo $header->end_date ? date('d/m/Y', strtotime($header->end_date)) : '-'; ?></span></div>
                                </div>
                            </div>
                        </div>
                    </div>

                </div>
            </div>
        </div>
    </div>
</div>


<!-- ================= CUSTOMER REFUND MODAL ================= -->
<div class="modal fade" id="crModal" tabindex="-1" data-bs-backdrop="static">
    <div class="modal-dialog">
        <form class="modal-content" id="crForm" enctype="multipart/form-data">
            <div class="modal-header">
                <h5 class="modal-title fw-bold">Record Customer Refund</h5>
                <button type="button" class="btn-close" data-bs-dismiss="modal"></button>
            </div>
            <div class="modal-body">
                <div class="alert alert-info py-2" style="font-size:13px;">
                    Balance due: <strong id="cr_balance_hint">0.00</strong>
                </div>
                <div class="row g-3">
                    <div class="col-6">
                        <label class="form-label">Amount <span class="text-danger">*</span></label>
                        <input type="number" step="0.01" min="0.01" class="form-control" name="refund_amount" id="cr_amount" required>
                    </div>
                    <div class="col-6">
                        <label class="form-label">Refund Date <span class="text-danger">*</span></label>
                        <input type="text" class="form-control bcd-date" name="refund_date" id="cr_date" placeholder="dd/mm/yyyy" required>
                    </div>
                    <div class="col-6">
                        <label class="form-label">Mode <span class="text-danger">*</span></label>
                        <select class="form-control" name="refund_mode" required>
                            <option value="">Select mode</option>
                            <option>NEFT</option><option>UPI</option><option>CASH</option>
                            <option>CHEQUE</option><option>CARD_REVERSAL</option><option>CREDIT_NOTE</option>
                        </select>
                    </div>
                    <div class="col-6">
                        <label class="form-label">Reference (UTR / Txn)</label>
                        <input type="text" class="form-control" name="refund_reference">
                    </div>
                    <div class="col-12">
                        <label class="form-label">Bank / Account credited</label>
                        <input type="text" class="form-control" name="refund_bank_account">
                    </div>
                    <div class="col-12">
                        <label class="form-label">Proof (jpg / png / pdf)</label>
                        <input type="file" class="form-control" name="refund_proof_file" accept=".jpg,.jpeg,.png,.pdf">
                    </div>
                    <div class="col-12">
                        <label class="form-label">Remarks</label>
                        <textarea class="form-control" name="refund_remarks" rows="2"></textarea>
                    </div>
                </div>
            </div>
            <div class="modal-footer">
                <button type="button" class="btn btn-light" data-bs-dismiss="modal">Cancel</button>
                <button type="submit" class="btn btn-danger"><i class="la la-save me-1"></i> Save Refund</button>
            </div>
        </form>
    </div>
</div>


<!-- ================= PROPERTY CHARGE MODAL ================= -->
<div class="modal fade" id="pcModal" tabindex="-1" data-bs-backdrop="static">
    <div class="modal-dialog modal-lg">
        <form class="modal-content" id="pcForm" enctype="multipart/form-data">
            <input type="hidden" name="cancellation_property_id" id="pc_line_id">
            <div class="modal-header">
                <h5 class="modal-title fw-bold">Property Cancellation Charge &mdash; <span id="pc_title"></span></h5>
                <button type="button" class="btn-close" data-bs-dismiss="modal"></button>
            </div>
            <div class="modal-body">
                <div class="row g-3">
                    <div class="col-md-4">
                        <label class="form-label">Amount Paid to Property</label>
                        <input type="text" class="form-control" id="pc_paid" readonly>
                    </div>
                    <div class="col-md-4">
                        <label class="form-label">Charge Basis</label>
                        <select class="form-control" name="charge_basis" id="pc_basis">
                            <option value="POLICY_SLAB">Policy slab</option>
                            <option value="NEGOTIATED">Negotiated</option>
                            <option value="FULL_RETENTION">Full retention</option>
                            <option value="NO_CHARGE">No charge</option>
                            <option value="NO_SHOW">No show</option>
                        </select>
                    </div>
                    <div class="col-md-4">
                        <label class="form-label">Charge %</label>
                        <input type="number" step="0.01" min="0" max="100" class="form-control" name="charge_percentage" id="pc_percentage">
                    </div>
                    <div class="col-md-4">
                        <label class="form-label">Charge Amount <span class="text-danger">*</span></label>
                        <input type="number" step="0.01" min="0" class="form-control" name="cancellation_charge" id="pc_charge" required>
                    </div>
                    <div class="col-md-4">
                        <label class="form-label">Refund Expected (auto)</label>
                        <input type="text" class="form-control" id="pc_expected" readonly>
                    </div>
                    <div class="col-md-4">
                        <label class="form-label">Still Payable (auto)</label>
                        <input type="text" class="form-control" id="pc_payable" readonly>
                    </div>
                    <div class="col-md-4">
                        <label class="form-label">Confirmed By (hotel contact)</label>
                        <input type="text" class="form-control" name="charge_confirmed_by" id="pc_cnfm_by">
                    </div>
                    <div class="col-md-4">
                        <label class="form-label">Confirmed Date</label>
                        <input type="text" class="form-control bcd-date" name="charge_confirmed_date" id="pc_cnfm_date" placeholder="dd/mm/yyyy">
                    </div>
                    <div class="col-md-4">
                        <label class="form-label">Refund Expected By</label>
                        <input type="text" class="form-control bcd-date" name="expected_refund_by_date" id="pc_expected_by" placeholder="dd/mm/yyyy">
                    </div>
                    <div class="col-12">
                        <label class="form-label">Charge Proof (hotel email / letter)</label>
                        <input type="file" class="form-control" name="charge_proof_file" accept=".jpg,.jpeg,.png,.pdf">
                    </div>
                    <div class="col-12">
                        <label class="form-label">Remarks</label>
                        <textarea class="form-control" name="line_remarks" id="pc_remarks" rows="2"></textarea>
                    </div>
                </div>
            </div>
            <div class="modal-footer">
                <button type="button" class="btn btn-light" data-bs-dismiss="modal">Cancel</button>
                <button type="submit" class="btn btn-primary"><i class="la la-save me-1"></i> Save Charge</button>
            </div>
        </form>
    </div>
</div>


<!-- ================= PROPERTY REFUND MODAL ================= -->
<div class="modal fade" id="prModal" tabindex="-1" data-bs-backdrop="static">
    <div class="modal-dialog">
        <form class="modal-content" id="prForm" enctype="multipart/form-data">
            <input type="hidden" name="cancellation_property_id" id="pr_line_id">
            <div class="modal-header">
                <h5 class="modal-title fw-bold">Record Refund Received &mdash; <span id="pr_title"></span></h5>
                <button type="button" class="btn-close" data-bs-dismiss="modal"></button>
            </div>
            <div class="modal-body">
                <div class="alert alert-info py-2" style="font-size:13px;">
                    Pending: <strong id="pr_pending_hint">0.00</strong>
                </div>
                <div class="row g-3">
                    <div class="col-6">
                        <label class="form-label">Amount <span class="text-danger">*</span></label>
                        <input type="number" step="0.01" min="0.01" class="form-control" name="refund_amount" id="pr_amount" required>
                    </div>
                    <div class="col-6">
                        <label class="form-label">Received On <span class="text-danger">*</span></label>
                        <input type="text" class="form-control bcd-date" name="refund_date" id="pr_date" placeholder="dd/mm/yyyy" required>
                    </div>
                    <div class="col-6">
                        <label class="form-label">Mode <span class="text-danger">*</span></label>
                        <select class="form-control" name="refund_mode" id="pr_mode" required>
                            <option value="">Select mode</option>
                            <option>NEFT</option><option>UPI</option><option>CASH</option>
                            <option>CHEQUE</option><option>CREDIT_NOTE</option><option>ADJUSTED</option>
                            <option value="PROPERTY_CREDIT">PROPERTY CREDIT (Future Booking Credit)</option>
                        </select>
                    </div>
                    <div class="col-6">
                        <label class="form-label">Reference</label>
                        <input type="text" class="form-control" name="refund_reference">
                    </div>
                    <div class="col-6" id="pr_credit_expiry_wrap" style="display:none;">
                        <label class="form-label">Credit Expiry Date (optional)</label>
                        <input type="text" class="form-control bcd-date" name="credit_expiry_date" id="pr_credit_expiry" placeholder="dd/mm/yyyy">
                    </div>
                    <div class="col-12" id="pr_adjust_wrap" style="display:none;">
                        <label class="form-label">Adjusted against Booking ID</label>
                        <input type="number" min="0" class="form-control" name="adjusted_against_quotation_id"
                               placeholder="Quotation ID the credit was moved to">
                        <small class="text-muted">Use when the hotel carries the credit into a future booking.</small>
                    </div>
                    <div class="col-12">
                        <label class="form-label">Proof</label>
                        <input type="file" class="form-control" name="refund_proof_file" accept=".jpg,.jpeg,.png,.pdf">
                    </div>
                    <div class="col-12">
                        <label class="form-label">Remarks</label>
                        <textarea class="form-control" name="refund_remarks" rows="2"></textarea>
                    </div>
                </div>
            </div>
            <div class="modal-footer">
                <button type="button" class="btn btn-light" data-bs-dismiss="modal">Cancel</button>
                <button type="submit" class="btn btn-success"><i class="la la-save me-1"></i> Save Refund</button>
            </div>
        </form>
    </div>
</div>


<!-- ================= SERVICE MODAL ================= -->
<div class="modal fade" id="svcModal" tabindex="-1" data-bs-backdrop="static">
    <div class="modal-dialog">
        <form class="modal-content" id="svcForm">
            <input type="hidden" name="cancellation_service_id" id="svc_id">
            <input type="hidden" name="booking_cancellation_id" value="<?php echo $cid; ?>">
            <div class="modal-header">
                <h5 class="modal-title fw-bold">Service Line</h5>
                <button type="button" class="btn-close" data-bs-dismiss="modal"></button>
            </div>
            <div class="modal-body">
                <div class="row g-3">
                    <div class="col-6">
                        <label class="form-label">Type <span class="text-danger">*</span></label>
                        <select class="form-control" name="service_type" id="svc_type">
                            <option value="TRANSPORT">Transport</option>
                            <option value="INCLUSION">Inclusion</option>
                            <option value="SPECIAL_REQUIREMENT">Special Requirement</option>
                            <option value="FLIGHT">Flight</option>
                            <option value="VISA">Visa</option>
                            <option value="GUIDE">Guide</option>
                            <option value="OTHER">Other</option>
                        </select>
                    </div>
                    <div class="col-6">
                        <label class="form-label">Vendor</label>
                        <input type="text" class="form-control" name="vendor_name" id="svc_vendor">
                    </div>
                    <div class="col-12">
                        <label class="form-label">Description</label>
                        <input type="text" class="form-control" name="service_description" id="svc_desc">
                    </div>
                    <div class="col-6">
                        <label class="form-label">Service Amount</label>
                        <input type="number" step="0.01" min="0" class="form-control" name="snap_service_amount" id="svc_amount">
                    </div>
                    <div class="col-6">
                        <label class="form-label">Amount Paid</label>
                        <input type="number" step="0.01" min="0" class="form-control" name="snap_amount_paid" id="svc_paid">
                    </div>
                    <div class="col-6">
                        <label class="form-label">Cancellation Charge</label>
                        <input type="number" step="0.01" min="0" class="form-control" name="cancellation_charge" id="svc_charge">
                    </div>
                    <div class="col-6">
                        <label class="form-label">Refund Received</label>
                        <input type="number" step="0.01" min="0" class="form-control" name="refund_received" id="svc_received">
                    </div>
                    <div class="col-12">
                        <div class="form-check">
                            <input class="form-check-input" type="checkbox" name="is_recoverable" value="1" id="svc_recoverable" checked>
                            <label class="form-check-label" for="svc_recoverable">
                                Recoverable &mdash; untick for costs that can never come back (gateway fees, visa fees)
                            </label>
                        </div>
                    </div>
                    <div class="col-12">
                        <label class="form-label">Remarks</label>
                        <textarea class="form-control" name="service_remarks" id="svc_remarks" rows="2"></textarea>
                    </div>
                </div>
            </div>
            <div class="modal-footer">
                <button type="button" class="btn btn-light" data-bs-dismiss="modal">Cancel</button>
                <button type="submit" class="btn btn-primary"><i class="la la-save me-1"></i> Save</button>
            </div>
        </form>
    </div>
</div>


<!-- ================= ADJUSTMENT MODAL ================= -->
<div class="modal fade" id="adjModal" tabindex="-1" data-bs-backdrop="static">
    <div class="modal-dialog">
        <form class="modal-content" id="adjForm">
            <input type="hidden" name="booking_cancellation_id" value="<?php echo $cid; ?>">
            <div class="modal-header">
                <h5 class="modal-title fw-bold">Add Adjustment</h5>
                <button type="button" class="btn-close" data-bs-dismiss="modal"></button>
            </div>
            <div class="modal-body">
                <div class="row g-3">
                    <div class="col-12">
                        <label class="form-label">Type <span class="text-danger">*</span></label>
                        <select class="form-control" name="adjustment_type" required>
                            <option value="">Select type</option>
                            <option value="WRITE_OFF">Write-off</option>
                            <option value="GOODWILL_DISCOUNT">Goodwill discount</option>
                            <option value="ADDITIONAL_CHARGE">Additional charge</option>
                            <option value="BANK_CHARGE">Bank charge</option>
                            <option value="GATEWAY_FEE">Payment gateway fee</option>
                            <option value="TAX_ADJUSTMENT">Tax adjustment</option>
                            <option value="CREDIT_NOTE_ISSUED">Credit note issued</option>
                            <option value="INCENTIVE_CLAWBACK">Incentive clawback</option>
                            <option value="ROUNDING">Rounding</option>
                            <option value="OTHER">Other</option>
                        </select>
                    </div>
                    <div class="col-6">
                        <label class="form-label">Side <span class="text-danger">*</span></label>
                        <select class="form-control" name="adjustment_side" required>
                            <option value="COMPANY">Company</option>
                            <option value="CUSTOMER">Customer</option>
                            <option value="SUPPLIER">Supplier</option>
                        </select>
                    </div>
                    <div class="col-6">
                        <label class="form-label">Direction <span class="text-danger">*</span></label>
                        <select class="form-control" name="adjustment_direction" required>
                            <option value="DEBIT">Debit (cost to company)</option>
                            <option value="CREDIT">Credit (income to company)</option>
                        </select>
                    </div>
                    <div class="col-6">
                        <label class="form-label">Amount <span class="text-danger">*</span></label>
                        <input type="number" step="0.01" min="0.01" class="form-control" name="adjustment_amount" required>
                    </div>
                    <div class="col-12">
                        <label class="form-label">Reason <span class="text-danger">*</span></label>
                        <textarea class="form-control" name="adjustment_reason" rows="2" required></textarea>
                    </div>
                </div>
            </div>
            <div class="modal-footer">
                <button type="button" class="btn btn-light" data-bs-dismiss="modal">Cancel</button>
                <button type="submit" class="btn btn-primary"><i class="la la-save me-1"></i> Save</button>
            </div>
        </form>
    </div>
</div>
