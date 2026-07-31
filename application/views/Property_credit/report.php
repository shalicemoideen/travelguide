<!--**********************************
    Content body start
***********************************-->
<div class="content-body">
    <div class="container-fluid">
        <div class="row">
            <div class="col-12">
                <div class="card">
                    <div class="card-header d-flex justify-content-between align-items-center">
                        <h4 class="card-title mb-0">Property Credit Report</h4>
                        <button type="button" class="btn btn-primary btn-sm" id="btnToggleFilters" onclick="toggleCreditFilters()">
                            <i class="fas fa-filter me-1"></i> Filters
                        </button>
                    </div>
                    <div class="card-body">
                        <!-- Filters -->
                        <div id="creditFilterSection" class="row mb-3" style="display: none;">
                            <div class="col-md-3 mb-2">
                                <label class="form-label">Property</label>
                                <select class="form-control" id="filter_property">
                                    <option value="">All Properties</option>
                                    <?php foreach ($properties as $p): ?>
                                        <option value="<?php echo $p->properties_id_fk; ?>"><?php echo htmlspecialchars($p->properties_name); ?></option>
                                    <?php endforeach; ?>
                                </select>
                            </div>
                            <div class="col-md-3 mb-2">
                                <label class="form-label">Credit Status</label>
                                <select class="form-control" id="filter_credit_status">
                                    <option value="">All</option>
                                    <option value="AVAILABLE">Available</option>
                                    <option value="PARTIALLY_USED">Partially Used</option>
                                    <option value="FULLY_UTILIZED">Fully Utilized</option>
                                    <option value="EXPIRED">Expired</option>
                                    <option value="CANCELLED">Cancelled</option>
                                </select>
                            </div>
                            <div class="col-md-3 mb-2">
                                <label class="form-label">Created From</label>
                                <input type="date" class="form-control" id="filter_start_date">
                            </div>
                            <div class="col-md-3 mb-2">
                                <label class="form-label">Created To</label>
                                <input type="date" class="form-control" id="filter_end_date">
                            </div>
                            <div class="col-md-3 mb-2">
                                <label class="form-label">Expiring Within (days)</label>
                                <input type="number" min="1" class="form-control" id="filter_expiring_days" placeholder="e.g. 30">
                            </div>
                            <div class="col-md-3 mb-2">
                                <label class="form-label">&nbsp;</label>
                                <div>
                                    <button type="button" class="btn btn-primary btn-sm" onclick="applyCreditReportFilters()">Apply</button>
                                    <button type="button" class="btn btn-secondary btn-sm" onclick="clearCreditReportFilters()">Clear</button>
                                </div>
                            </div>
                        </div>

                        <!-- Summary tiles -->
                        <div class="row g-3 mb-3">
                            <div class="col-md-4">
                                <div class="card bg-info text-white">
                                    <div class="card-body text-center py-2">
                                        <small>Total Credit</small>
                                        <h5 class="mb-0" id="tile_total_credit">&#8377;0.00</h5>
                                    </div>
                                </div>
                            </div>
                            <div class="col-md-4">
                                <div class="card bg-success text-white">
                                    <div class="card-body text-center py-2">
                                        <small>Total Used</small>
                                        <h5 class="mb-0" id="tile_total_used">&#8377;0.00</h5>
                                    </div>
                                </div>
                            </div>
                            <div class="col-md-4">
                                <div class="card bg-warning">
                                    <div class="card-body text-center py-2">
                                        <small>Total Remaining</small>
                                        <h5 class="mb-0" id="tile_total_remaining">&#8377;0.00</h5>
                                    </div>
                                </div>
                            </div>
                        </div>

                        <style>
                            #credit_report_table th,
                            #credit_report_table td {
                                font-size: 13px;
                                padding: 6px 8px;
                                white-space: nowrap;
                            }
                            #credit_report_table tbody tr {
                                transition: all 0.2s ease;
                            }
                            #credit_report_table tbody tr:hover {
                                background-color: #f8f9fa;
                            }
                            .credit-status-pill {
                                padding: 2px 8px;
                                border-radius: 12px;
                                font-size: 11px;
                                font-weight: 600;
                                text-transform: uppercase;
                            }
                        </style>

                        <div class="table-responsive">
                            <table class="table table-bordered table-hover" id="credit_report_table" style="width:100%;">
                                <thead class="table-light">
                                    <tr>
                                        <th>#</th>
                                        <th>Property</th>
                                        <th>Cancellation</th>
                                        <th>Original Booking</th>
                                        <th class="text-end">Credit Amount</th>
                                        <th class="text-end">Used</th>
                                        <th class="text-end">Remaining</th>
                                        <th>Status</th>
                                        <th>Expiry</th>
                                        <th>Reference</th>
                                        <th>Created</th>
                                        <th>Age (days)</th>
                                    </tr>
                                </thead>
                                <tbody></tbody>
                            </table>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div>
</div>
