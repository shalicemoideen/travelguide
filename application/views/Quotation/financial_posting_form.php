<!-- Shared financial posting form: the quotation hub tab and the standalone
     financial posting page both render this. -->
<style>
/* Financial Posting tab — light blue / teal theme */

.fp-scope .fp-card-header {

    background: linear-gradient(135deg, #00838f 0%, #006064 100%);

    color: #fff;

}

.fp-scope .fp-card-header .card-title,

.fp-scope .fp-card-header h5,

.fp-scope .fp-card-header i {

    color: #fff;

}

.fp-scope .fp-table thead th {

    background: #b2dfdb;

    color: #004d40;

    border: 1px solid #80cbc4;

    font-size: 12px;

    font-weight: 700;

    text-transform: uppercase;

}

.fp-scope .fp-table tbody td {

    border: 1px solid #e0f2f1;

    vertical-align: middle;

}

.fp-scope .fp-table tbody tr.fp-label td:first-child,

.fp-scope .fp-table tbody tr.fp-label-row td:first-child {

    background: #e0f2f1;

    font-weight: 600;

    color: #004d40;

}

.fp-scope .fp-table tbody tr.fp-total td,

.fp-scope .fp-table tbody tr.fp-total-row td {

    background: #e0f2f1;

    color: #00695c;

    font-weight: 700;

}

.fp-scope .fp-table tbody tr.fp-total td:first-child,

.fp-scope .fp-table tbody tr.fp-total-row td:first-child {

    background: #b2dfdb;

    color: #004d40;

}

.fp-scope .fp-section-header {

    background: #e0f2f1 !important;

    color: #00695c !important;

    font-size: 12px;

    font-weight: 700;

}

.fp-scope .fp-section-header .btn {

    font-size: 11px;

    padding: 2px 10px;

}

.fp-scope .fp-table .form-control {

    border: 1px solid #80cbc4;

}

.fp-scope .fp-table .form-control:focus {

    border-color: #00838f;

    box-shadow: 0 0 0 2px rgba(0, 131, 143, 0.15);

}

/* Per-day grouped costing block */

.fp-scope .fp-table tbody tr.fp-day-header td {

    background: linear-gradient(135deg, #00838f 0%, #006064 100%);

    padding: 8px 12px;

    border: none;

    cursor: pointer;

}

.fp-scope .fp-day-toggle {

    display: inline-flex;

    align-items: center;

    color: #fff;

    margin-right: 8px;

    font-size: 16px;

    transition: transform 0.2s ease;

}

.fp-scope .fp-table tbody tr.fp-day-header.fp-collapsed .fp-day-toggle {

    transform: rotate(-90deg);

}

.fp-scope .fp-table tbody tr.fp-day-item.fp-hidden {

    display: none;

}

.fp-scope .fp-day-badge {

    display: inline-flex;

    align-items: center;

    color: #fff;

    font-weight: 700;

    font-size: 13px;

    letter-spacing: .3px;

    text-transform: uppercase;

}

.fp-scope .fp-day-subtotal {

    float: right;

    color: #e0f2f1;

    font-weight: 600;

    font-size: 12px;

}

.fp-scope .fp-day-subtotal b {

    color: #fff;

    font-size: 13px;

}

.fp-scope .fp-table tbody tr.fp-day-item td {

    border: 1px solid #e0f2f1;

    background: #f7fbfb;

}

.fp-scope .fp-table tbody tr.fp-day-item.fp-day-special td {

    border-bottom: 2px solid #b2dfdb;

}

.fp-scope .fp-item-label {

    font-weight: 600;

    color: #004d40;

    padding-left: 18px !important;

    white-space: nowrap;

}

.fp-scope .fp-item-icon {

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

.fp-scope .fp-icon-hotel   { background: #00838f; }

.fp-scope .fp-icon-inc     { background: #26a69a; }

.fp-scope .fp-icon-special { background: #ff8f00; }

/* Quotation context shown alongside each day row */

.fp-scope .fp-day-date {

    display: inline-block;

    margin-left: 8px;

    color: rgba(255,255,255,.92);

    font-size: 11px;

    font-weight: 600;

    letter-spacing: .3px;

}

.fp-scope .fp-day-property {

    display: inline-block;

    margin-left: 8px;

    padding: 2px 10px;

    border-radius: 4px;

    background: rgba(255,255,255,.18);

    color: #fff;

    font-size: 11px;

    font-weight: 600;

}

.fp-scope .fp-item-sub {

    margin-top: 3px;

    margin-left: 30px;

    color: #78909c;

    font-size: 11px;

    font-weight: 500;

    line-height: 1.35;

}

/* Financial posting totals - two summary blocks */

.fp-scope .fp-summary-cell {

    background: #f4fafb;

    padding: 16px 14px !important;

    border-top: 2px solid #b2dfdb;

}

.fp-scope .fp-sum-block {

    background: #fff;

    border: 1px solid #cfe6e8;

    border-radius: 8px;

    height: 100%;

    overflow: hidden;

}

.fp-scope .fp-sum-head {

    background: #e0f2f1;

    color: #00695c;

    font-size: 11px;

    font-weight: 700;

    letter-spacing: .6px;

    text-transform: uppercase;

    padding: 9px 14px;

    border-bottom: 1px solid #cfe6e8;

}

.fp-scope .fp-sum-line {

    display: flex;

    align-items: center;

    justify-content: space-between;

    gap: 14px;

    padding: 10px 14px;

    border-bottom: 1px dashed #e3eef0;

}

.fp-scope .fp-sum-line:last-child { border-bottom: 0; }

.fp-scope .fp-sum-label {

    color: #37474f;

    font-size: 13px;

    font-weight: 600;

}

.fp-scope .fp-sum-label small {

    color: #90a4ae;

    font-weight: 400;

    margin-left: 4px;

}

.fp-scope .fp-sum-value {

    color: #00695c;

    font-size: 14px;

    font-weight: 700;

    white-space: nowrap;

    text-align: right;

}

.fp-scope .fp-sum-strong {

    background: #f1f8f9;

}

.fp-scope .fp-sum-strong .fp-sum-label { color: #004d40; }

.fp-scope .fp-sum-strong .fp-sum-value { font-size: 16px; }

.fp-scope .fp-sum-badge {

    display: inline-block;

    min-width: 110px;

    padding: 6px 14px;

    border-radius: 6px;

    color: #fff;

    background: #6c757d;

    font-size: 17px;

    font-weight: 700;

    text-align: center;

}
</style>

<div class="fp-scope">
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

                                                                    <!-- Totals: two summary blocks side by side -->

                                                                    <tr id="fpSummaryRow">

                                                                        <td colspan="5" class="fp-summary-cell">

                                                                            <div class="row g-3">

                                                                                <div class="col-lg-6">

                                                                                    <div class="fp-sum-block">

                                                                                        <div class="fp-sum-head">Cost Summary</div>

                                                                                        <div class="fp-sum-line">

                                                                                            <span class="fp-sum-label">Actual Cost <small>(sum of Expected)</small></span>

                                                                                            <span class="fp-sum-value" id="fpActualCost">0.00</span>

                                                                                        </div>

                                                                                        <div class="fp-sum-line">

                                                                                            <span class="fp-sum-label">Cost After Financial Post <small>(sum of Actual)</small></span>

                                                                                            <span class="fp-sum-value" id="fpCostAfterPost">0.00</span>

                                                                                        </div>

                                                                                        <div class="fp-sum-line">

                                                                                            <span class="fp-sum-label">Margin</span>

                                                                                            <span class="fp-sum-value" id="fpMargin">0.00</span>

                                                                                        </div>

                                                                                        <div class="fp-sum-line fp-sum-strong">

                                                                                            <span class="fp-sum-label">Total <small>(Actual + Margin)</small></span>

                                                                                            <span class="fp-sum-value" id="fpTotalAfterMargin">0.00</span>

                                                                                        </div>

                                                                                    </div>

                                                                                </div>

                                                                                <div class="col-lg-6">

                                                                                    <div class="fp-sum-block">

                                                                                        <div class="fp-sum-head">Margin Summary</div>

                                                                                        <div class="fp-sum-line">

                                                                                            <span class="fp-sum-label">Pre Quoted Amount</span>

                                                                                            <span class="fp-sum-value text-primary" id="fpPreQuotedAmount">0.00</span>

                                                                                        </div>

                                                                                        <div class="fp-sum-line">

                                                                                            <span class="fp-sum-label">Difference <small>(Pre quoted - Total)</small></span>

                                                                                            <span class="fp-sum-value" id="fpDifference">0.00</span>

                                                                                        </div>

                                                                                        <div class="fp-sum-line fp-sum-strong">

                                                                                            <span class="fp-sum-label">Total Margin <small>(Difference + Margin)</small></span>

                                                                                            <span class="fp-sum-value"><span id="fpTotalMargin" class="fp-sum-badge">0.00</span></span>

                                                                                        </div>

                                                                                    </div>

                                                                                </div>

                                                                            </div>

                                                                        </td>

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
