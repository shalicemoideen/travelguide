<!--**********************************
    Content body start
***********************************-->
<div class="content-body">
    <div class="container-fluid">
        <div class="row">
            <div class="col-12">
                <div class="card">
                    <div class="card-header d-flex justify-content-between align-items-center">
                        <h4 class="card-title mb-0">Transporter Report</h4>
                        <button type="button" class="btn btn-primary btn-sm" id="btnToggleFilters" onclick="toggleTransporterReportFilters()">
                            <i class="fas fa-filter me-1"></i> Filters
                        </button>
                    </div>
                    <div class="card-body">
                        <!-- Filters -->
                        <div id="transporterReportFilterSection" class="row mb-3" style="display: none;">
                            <div class="col-md-3 mb-2">
                                <label class="form-label">Quotation Number</label>
                                <input type="text" class="form-control" id="filter_quotation_number" placeholder="Search...">
                            </div>
                            <div class="col-md-3 mb-2">
                                <label class="form-label">Guest Name</label>
                                <input type="text" class="form-control" id="filter_guest_name" placeholder="Search...">
                            </div>
                            <div class="col-md-3 mb-2">
                                <label class="form-label">Travel Date Range</label>
                                <input type="text" class="form-control" id="travel_date_range" placeholder="dd/mm/yyyy - dd/mm/yyyy" autocomplete="off" readonly>
                            </div>
                            <div class="col-md-3 mb-2">
                                <label class="form-label">Status</label>
                                <select class="form-control" id="filter_status">
                                    <option value="">All Statuses</option>
                                    <option value="9">Driver Not Assigned</option>
                                    <option value="7">Ready to Trip</option>
                                </select>
                            </div>
                            <div class="col-md-3 mb-2">
                                <label class="form-label">&nbsp;</label>
                                <div>
                                    <button type="button" class="btn btn-primary btn-sm" onclick="applyTransporterReportFilters()">Apply</button>
                                    <button type="button" class="btn btn-secondary btn-sm" onclick="clearTransporterReportFilters()">Clear</button>
                                </div>
                            </div>
                        </div>

                        <style>
                            #transporter_report_table th,
                            #transporter_report_table td {
                                font-size: 13px;
                                padding: 6px 8px;
                                white-space: nowrap;
                            }
                            #transporter_report_table tbody tr {
                                transition: all 0.2s ease;
                            }
                            #transporter_report_table tbody tr:hover {
                                box-shadow: 0 4px 8px rgba(0, 0, 0, 0.12);
                                transform: translateY(-1px);
                                background-color: #f8f9fa;
                            }
                        </style>
                        <div class="table-responsive">
                            <table id="transporter_report_table" class="display" style="min-width: 1100px">
                                <thead>
                                    <tr>
                                        <th>Sl.no</th>
                                        <th>Guest Name</th>
                                        <th>Travel Date</th>
                                        <th>Transporter</th>
                                        <th>Driver Name</th>
                                        <th>Driver Mobile</th>
                                        <th>Cab No</th>
                                        <th>Status</th>
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

<!-- Assign Driver Details Modal -->
<div class="modal fade" id="assignDriverModal" tabindex="-1" aria-hidden="true">
    <div class="modal-dialog modal-dialog-centered modal-md">
        <div class="modal-content">
            <div class="modal-header">
                <h5 class="modal-title">Assign Driver Details</h5>
                <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
            </div>
            <div class="modal-body">
                <form id="assignDriverForm">
                    <input type="hidden" id="ad_allocation_id" name="allocation_id">
                    <input type="hidden" id="ad_quotation_id" name="quotation_id">
                    <div class="row g-3">
                        <div class="col-md-12">
                            <label class="form-label">Driver Name <span class="text-danger">*</span></label>
                            <input type="text" class="form-control" id="ad_driver_name" name="driver_name" placeholder="Enter driver name">
                        </div>
                        <div class="col-md-6">
                            <label class="form-label">Driver Mobile</label>
                            <input type="text" class="form-control" id="ad_driver_mobile" name="driver_mobile" placeholder="Enter driver mobile">
                        </div>
                        <div class="col-md-6">
                            <label class="form-label">Cab Number</label>
                            <input type="text" class="form-control" id="ad_cab_number" name="cab_number" placeholder="Enter cab number">
                        </div>
                    </div>
                </form>
            </div>
            <div class="modal-footer">
                <button type="button" class="btn btn-secondary" data-bs-dismiss="modal">Cancel</button>
                <button type="button" class="btn btn-success" onclick="submitAssignDriver()">Update &amp; Set Ready to Trip</button>
            </div>
        </div>
    </div>
</div>
<!-- View Guest Details Modal -->
<div class="modal fade" id="viewGuestDetailsModal" tabindex="-1" aria-hidden="true">
    <div class="modal-dialog modal-dialog-centered modal-lg">
        <div class="modal-content">
            <div class="modal-header">
                <h5 class="modal-title"><i class="fas fa-eye me-2"></i>Guest Details</h5>
                <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
            </div>
            <div class="modal-body" id="guestDetailsContent">
                <div class="text-center text-muted py-4">Loading...</div>
            </div>
            <div class="modal-footer">
                <button type="button" class="btn btn-secondary" data-bs-dismiss="modal">Close</button>
                <button type="button" class="btn btn-primary" onclick="copyGuestDetails()"><i class="fas fa-copy me-1"></i> Copy Details</button>
            </div>
        </div>
    </div>
</div>

<!--**********************************
    Content body end
***********************************-->
