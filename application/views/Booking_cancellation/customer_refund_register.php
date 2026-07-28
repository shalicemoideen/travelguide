<style>
.bcr-header {
    background: linear-gradient(90deg, #6f42c1, #a06bd6);
    color: #fff;
    border-radius: 10px 10px 0 0;
    padding: 14px 18px;
    font-weight: 700;
    font-size: 16px;
}
.bcr-filter {
    border: 1px solid #e5e7eb; border-radius: 8px; padding: 14px;
    background: #fbfbfd; margin-bottom: 18px;
}
.bcr-money { text-align: right; font-variant-numeric: tabular-nums; }
.bcr-pill { font-size: 11px; padding: 3px 10px; border-radius: 999px; font-weight: 600; display: inline-block; }
</style>

<div class="content-body">
    <div class="container-fluid">

        <div class="card">
            <div class="bcr-header">
                <i class="la la-money-bill-wave me-2"></i>Customer Refund Register
                <span class="fw-normal ms-2" style="font-size:12px;opacity:.9;">
                    Every refund paid out on a cancellation, with its accountant approval state
                </span>
            </div>

            <div class="card-body">

                <div class="bcr-filter">
                    <div class="row g-3">
                        <div class="col-md-2">
                            <label class="form-label mb-1">From</label>
                            <input type="text" class="form-control form-control-sm bcr-date" id="rf_start" placeholder="dd/mm/yyyy" autocomplete="off">
                        </div>
                        <div class="col-md-2">
                            <label class="form-label mb-1">To</label>
                            <input type="text" class="form-control form-control-sm bcr-date" id="rf_end" placeholder="dd/mm/yyyy" autocomplete="off">
                        </div>
                        <div class="col-md-2">
                            <label class="form-label mb-1">Mode</label>
                            <select class="form-control form-control-sm" id="rf_mode">
                                <option value="">All</option>
                                <option value="NEFT">NEFT</option>
                                <option value="UPI">UPI</option>
                                <option value="CASH">Cash</option>
                                <option value="CHEQUE">Cheque</option>
                                <option value="CARD_REVERSAL">Card Reversal</option>
                                <option value="CREDIT_NOTE">Credit Note</option>
                            </select>
                        </div>
                        <div class="col-md-2">
                            <label class="form-label mb-1">Approval</label>
                            <select class="form-control form-control-sm" id="rf_approval">
                                <option value="">All</option>
                                <option value="pending">Pending</option>
                                <option value="approved">Approved</option>
                                <option value="rejected">Rejected</option>
                            </select>
                        </div>
                        <div class="col-md-4 d-flex align-items-end gap-2">
                            <button type="button" class="btn btn-primary btn-sm" id="rApply">
                                <i class="la la-search me-1"></i> Apply
                            </button>
                            <button type="button" class="btn btn-outline-secondary btn-sm" id="rReset">
                                <i class="la la-refresh me-1"></i> Reset
                            </button>
                        </div>
                    </div>
                </div>

                <div class="table-responsive">
                    <table class="table table-hover table-sm display" id="bcrTable" style="width:100%">
                        <thead>
                            <tr>
                                <th>Date</th>
                                <th>Cancellation</th>
                                <th>Booking / Guest</th>
                                <th>Mode</th>
                                <th>Reference</th>
                                <th class="bcr-money">Amount</th>
                                <th>Approval</th>
                                <th>Paid By</th>
                                <th>Proof</th>
                            </tr>
                        </thead>
                        <tbody></tbody>
                    </table>
                </div>

            </div>
        </div>
    </div>
</div>
