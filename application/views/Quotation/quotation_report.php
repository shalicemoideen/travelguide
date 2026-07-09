<!--**********************************
    Content body start
***********************************-->
<div class="content-body">
    <div class="container-fluid">
        <button type="button" id="btn" class="btn btn-rounded btn-primary btn-md"><i class="fas fa-filter"></i> Filter</button><br><br>

        <form id="quotationReportFilterForm" method="POST" action="">
            <div class="card-header" id="Create" style="display:none">
                <div class="d-flex align-items-center">
                    <div class="row row-demo-grid hdr-filter-dd-fullwd">
                        <div class="col-sm-6 col-md-3">
                            <div class="card">
                                <div class="input-group">
                                    <input type="text" class="form-control" placeholder="Guest name" id="guest_name" name="guest_name">
                                </div>
                            </div>
                        </div>
                        <?php if ($current_user_type == 'A'): ?>
                        <div class="col-sm-6 col-md-3">
                            <div class="card">
                                <div class="input-group">
                                    <select name="staff_id" id="staff_id" class="form-control input-lg">
                                        <option value="">Select Assigned Staff</option>
                                        <?php foreach ($staff as $row): ?>
                                            <option value="<?php echo $row->user_id; ?>"><?php echo $row->admin_name; ?></option>
                                        <?php endforeach; ?>
                                    </select>
                                </div>
                            </div>
                        </div>
                        <?php else: ?>
                        <input type="hidden" id="staff_id" name="staff_id" value="<?php echo $current_user_id; ?>">
                        <?php endif; ?>
                        <div class="col-sm-6 col-md-3">
                            <div class="card">
                                <div class="input-group">
                                    <select name="quotation_status" id="quotation_status" class="form-control input-lg">
                                        <option value="">All Statuses</option>
                                        <option value="1">Generated</option>
                                        <option value="2">Draft</option>
                                        <option value="3">Sent</option>
                                        <option value="4">Rejected</option>
                                        <option value="5">Confirmed</option>
                                        <option value="6">Cancelled</option>
                                    </select>
                                </div>
                            </div>
                        </div>
                        <div class="col-sm-6 col-md-3">
                            <div class="card">
                                <div class="input-group">
                                    <input type="text" class="form-control" placeholder="Date Range" id="quotation_report_daterange" name="quotation_report_daterange" readonly>
                                </div>
                            </div>
                        </div>
                        <div class="col-sm-2 col-md-3">
                            <div class="card">
                                <button type="button" class="btn btn-warning btn-md" id="search">
                                    <span class="btn-label"><i class="fas fa-search"></i></span>
                                    Search
                                </button>
                            </div>
                        </div>
                        <div class="col-sm-2 col-md-3">
                            <div class="card">
                                <button type="button" class="btn btn-secondary btn-md" id="reset">
                                    <span class="btn-label"><i class="icon-refresh"></i></span>
                                    Refresh
                                </button>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
        </form>

        <div class="row">
            <div class="col-12">
                <div class="card">
                    <div class="card-header">
                        <h2 class="card-title"><b>Quotation Report</b></h2>
                    </div>
                    <div class="card-body">
                        <div class="table-responsive">
                            <table class="table card-table display mb-4 shadow-hover table-responsive-lg" id="QuotationReport">
                                <thead>
                                    <tr>
                                        <th>Sl.no</th>
                                        <th>Quotation No</th>
                                        <th>Assigned Staff</th>
                                        <th>Guest Name</th>
                                        <th>Destination</th>
                                        <th>Quotation Date</th>
                                        <th>Travel Date</th>
                                        <th>Duration</th>
                                        <th>Quotation Status</th>
                                    </tr>
                                </thead>
                                <tbody></tbody>
                                <tfoot>
                                    <tr>
                                        <th colspan="9" class="text-right" id="quotation-total-count" style="text-align:right; font-size:15px; color:#3d4465; background-color:#f0f4ff; padding:10px 16px; border-top:2px solid #5e72e4;"></th>
                                    </tr>
                                </tfoot>
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
