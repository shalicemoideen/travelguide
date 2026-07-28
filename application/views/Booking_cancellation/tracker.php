<style>
.bct-header {
    background: linear-gradient(90deg, #0b6e4f, #22a06b);
    color: #fff;
    border-radius: 10px 10px 0 0;
    padding: 14px 18px;
    font-weight: 700;
    font-size: 16px;
}
.bct-filter {
    border: 1px solid #e5e7eb; border-radius: 8px; padding: 14px;
    background: #fbfbfd; margin-bottom: 18px;
}
.bct-tile {
    border: 1px solid #e5e7eb; border-radius: 8px; padding: 12px 14px; background: #fff; height: 100%;
}
.bct-tile .lbl { color: #6b7280; font-size: 12px; }
.bct-tile .val { font-weight: 700; font-size: 18px; font-variant-numeric: tabular-nums; }
.bct-tile.expected { border-left: 4px solid #0d6efd; }
.bct-tile.received { border-left: 4px solid #198754; }
.bct-tile.pending  { border-left: 4px solid #dc3545; }
.bct-tile.payable  { border-left: 4px solid #ffc107; }
.bct-money { text-align: right; font-variant-numeric: tabular-nums; }
.bct-pill { font-size: 11px; padding: 3px 10px; border-radius: 999px; font-weight: 600; display: inline-block; }
.bct-age { font-weight: 700; }
.bct-age.b1 { color: #198754; }
.bct-age.b2 { color: #b98900; }
.bct-age.b3 { color: #d97706; }
.bct-age.b4 { color: #dc3545; }
</style>

<div class="content-body">
    <div class="container-fluid">

        <div class="card">
            <div class="bct-header">
                <i class="la la-hourglass-half me-2"></i>Supplier Refund Tracker
                <span class="fw-normal ms-2" style="font-size:12px;opacity:.9;">
                    Money owed back to us by properties across all cancellations
                </span>
            </div>

            <div class="card-body">

                <!-- TOTALS -->
                <div class="row g-3 mb-4">
                    <div class="col-md-3"><div class="bct-tile expected">
                        <div class="lbl">Refund Expected</div><div class="val bct-money" id="tt_expected">0.00</div></div></div>
                    <div class="col-md-3"><div class="bct-tile received">
                        <div class="lbl">Refund Received</div><div class="val bct-money" id="tt_received">0.00</div></div></div>
                    <div class="col-md-3"><div class="bct-tile pending">
                        <div class="lbl">Still Pending</div><div class="val bct-money" id="tt_pending">0.00</div></div></div>
                    <div class="col-md-3"><div class="bct-tile payable">
                        <div class="lbl">Still Payable to Properties</div><div class="val bct-money" id="tt_payable">0.00</div></div></div>
                </div>

                <!-- FILTERS -->
                <div class="bct-filter">
                    <div class="row g-3">
                        <div class="col-md-3">
                            <label class="form-label mb-1">Property</label>
                            <select class="form-control form-control-sm" id="tf_property">
                                <option value="">All properties</option>
                                <?php foreach ($properties as $p): ?>
                                    <option value="<?php echo (int)$p->properties_id_fk; ?>">
                                        <?php echo htmlspecialchars($p->snap_property_name); ?>
                                    </option>
                                <?php endforeach; ?>
                            </select>
                        </div>
                        <div class="col-md-2">
                            <label class="form-label mb-1">Line Status</label>
                            <select class="form-control form-control-sm" id="tf_status">
                                <option value="">All</option>
                                <option value="PENDING_INTIMATION">Pending Intimation</option>
                                <option value="INTIMATED">Intimated</option>
                                <option value="CHARGE_CONFIRMED">Charge Confirmed</option>
                                <option value="REFUND_PENDING">Refund Pending</option>
                                <option value="PARTIALLY_REFUNDED">Partially Refunded</option>
                                <option value="FULLY_REFUNDED">Fully Refunded</option>
                                <option value="REFUSED">Refused</option>
                                <option value="WRITTEN_OFF">Written Off</option>
                                <option value="NO_REFUND_DUE">No Refund Due</option>
                                <option value="PAYABLE_PENDING">Payable Pending</option>
                            </select>
                        </div>
                        <div class="col-md-2">
                            <label class="form-label mb-1">Ageing</label>
                            <select class="form-control form-control-sm" id="tf_age">
                                <option value="">All</option>
                                <option value="0_15">0 - 15 days</option>
                                <option value="16_30">16 - 30 days</option>
                                <option value="31_60">31 - 60 days</option>
                                <option value="60_up">60+ days</option>
                            </select>
                        </div>
                        <div class="col-md-2">
                            <label class="form-label mb-1">Cancelled From</label>
                            <input type="text" class="form-control form-control-sm bct-date" id="tf_start" placeholder="dd/mm/yyyy" autocomplete="off">
                        </div>
                        <div class="col-md-2">
                            <label class="form-label mb-1">Cancelled To</label>
                            <input type="text" class="form-control form-control-sm bct-date" id="tf_end" placeholder="dd/mm/yyyy" autocomplete="off">
                        </div>
                        <div class="col-md-3 d-flex align-items-end">
                            <div class="form-check">
                                <input class="form-check-input" type="checkbox" id="tf_open_only" checked>
                                <label class="form-check-label" for="tf_open_only">Open items only</label>
                            </div>
                        </div>
                        <div class="col-md-4 d-flex align-items-end gap-2">
                            <button type="button" class="btn btn-primary btn-sm" id="tApply">
                                <i class="la la-search me-1"></i> Apply
                            </button>
                            <button type="button" class="btn btn-outline-secondary btn-sm" id="tReset">
                                <i class="la la-refresh me-1"></i> Reset
                            </button>
                        </div>
                    </div>
                </div>

                <div class="table-responsive">
                    <table class="table table-hover table-sm display" id="bctTable" style="width:100%">
                        <thead>
                            <tr>
                                <th>Property</th>
                                <th>Cancellation</th>
                                <th>Booking / Guest</th>
                                <th>Cancelled On</th>
                                <th class="text-center">Age</th>
                                <th class="bct-money">Paid</th>
                                <th class="bct-money">Charge</th>
                                <th class="bct-money">Expected</th>
                                <th class="bct-money">Received</th>
                                <th class="bct-money">Pending</th>
                                <th>Status</th>
                                <th>Follow-up</th>
                                <th class="text-center">Open</th>
                            </tr>
                        </thead>
                        <tbody></tbody>
                    </table>
                </div>

            </div>
        </div>
    </div>
</div>
