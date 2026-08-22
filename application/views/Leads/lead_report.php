<!--**********************************

    Content body start

***********************************-->

<div class="content-body">

    <div class="container-fluid">

        <button type="button" id="btn" class="btn btn-rounded btn-primary btn-md"><i class="fas fa-filter"></i> Filter</button><br><br>



        <form id="leadReportFilterForm" method="POST" action="">

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

                        <?php if ($current_user_type == 'A' || (isset($can_view_all) && $can_view_all)): ?>

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

                                    <select name="lead_status" id="lead_status" class="form-control input-lg">

                                        <option value="">All Statuses</option>

                                        <option value="1">In take</option>

                                        <option value="2">Qualified</option>

                                        <option value="3">Converted to trip</option>

                                        <option value="4">Not Qualified</option>

                                        <option value="5">Lost</option>

                                    </select>

                                </div>

                            </div>

                        </div>

                        <div class="col-sm-6 col-md-3">

                            <div class="card">

                                <div class="input-group">

                                    <input type="text" class="form-control" placeholder="Register Date Range" id="leads_report_daterange" name="leads_report_daterange" readonly>

                                </div>

                            </div>

                        </div>

                        <div class="col-sm-6 col-md-3">

                            <div class="card">

                                <div class="input-group">

                                    <input type="text" class="form-control" placeholder="Travel Date Range" id="leads_report_travel_daterange" name="leads_report_travel_daterange" readonly>

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

                        <h2 class="card-title"><b>Lead Report</b></h2>

                    </div>

                    <div class="card-body">

                        <div class="table-responsive">

                            <table class="table card-table display mb-4 shadow-hover table-responsive-lg" id="LeadReport">

                                <thead>

                                    <tr>

                                        <th>Sl.no</th>

                                        <th>Lead No</th>

                                        <th>Assigned Staff</th>

                                        <th>Guest Name</th>

                                        <th>Destination</th>

                                        <th>Created Date</th>

                                        <th>Travel Details</th>

                                        <th>Lead Status</th>

                                    </tr>

                                </thead>

                                <tbody></tbody>

                                <tfoot>

                                    <tr>

                                        <th></th>

                                        <th></th>

                                        <th></th>

                                        <th></th>

                                        <th></th>

                                        <th></th>

                                        <th></th>

                                        <th id="lead-total-count" style="text-align:right; font-size:14px; font-weight:700; color:#3d4465; background:linear-gradient(135deg,#f8f9fc,#eaecf4); padding:10px 12px; border-top:2px solid #5e72e4; white-space:nowrap;"></th>

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

<style>
  .lead-view-modal{
    border:0;
    border-radius:22px;
    overflow:hidden;
    box-shadow:0 10px 35px rgba(0,0,0,.12);
  }
  .lead-view-header{
    background: linear-gradient(135deg, #eef1f4, #eef1f4);
    color:#fff;
    padding:16px 22px;
  }
  .lead-summary-box{
    background:#f8f9fb;
    border:1px solid #eef1f4;
    border-radius:18px;
    padding:20px;
    margin-bottom:18px;
  }
  .lead-summary-title{
    font-size:26px;
    font-weight:700;
    color:#212529;
    margin-bottom:4px;
  }
  .lead-summary-sub{
    color:#6c757d;
    font-size:14px;
  }
  .lead-chip{
    display:inline-block;
    padding:8px 14px;
    border-radius:999px;
    font-size:13px;
    font-weight:600;
    margin-left:8px;
  }
  .lead-card{
    background:#fff;
    border:1px solid #eef1f4;
    border-radius:18px;
    box-shadow:0 4px 14px rgba(0,0,0,.04);
    height:100%;
  }
  .lead-card-header{
    padding:14px 18px;
    border-bottom:1px solid #eef1f4;
    font-weight:700;
    font-size:15px;
    color:#212529;
    background:#fafbfc;
    border-top-left-radius:18px;
    border-top-right-radius:18px;
  }
  .lead-card-body{
    padding:16px 18px;
  }
  .lead-detail-row{
    display:flex;
    border-bottom:1px dashed #eceff3;
    padding:10px 0;
    gap:12px;
  }
  .lead-detail-row:last-child{
    border-bottom:0;
    padding-bottom:0;
  }
  .lead-detail-label{
    width:42%;
    min-width:160px;
    color:#6c757d;
    font-weight:600;
  }
  .lead-detail-value{
    flex:1;
    color:#212529;
    word-break:break-word;
  }
  .lead-description-box{
    background:#fcfcfd;
    border:1px solid #eef1f4;
    border-radius:18px;
    padding:18px;
    white-space:pre-line;
    color:#495057;
    min-height:120px;
  }
  .lead-top-badges{
    display:flex;
    flex-wrap:wrap;
    justify-content:flex-end;
    align-items:center;
    gap:8px;
  }
  .lead-type-badge{
    background:#212529;
    color:#fff;
    padding:8px 14px;
    border-radius:999px;
    font-size:13px;
    font-weight:600;
  }
  .status-chip{
    color:#fff;
    padding:8px 14px;
    border-radius:999px;
    font-size:13px;
    font-weight:600;
  }
  .status-intake{ background:#0dcaf0; color:#fff; }
  .status-qualified{ background:#6c757d; color:#fff; }
  .status-converted{ background:#198754; color:#fff; }
  .status-notqualified{ background:#ffc107; color:#212529; }
  .status-lost{ background:#dc3545; color:#fff; }
  .mini-info-row{
    display:flex;
    flex-wrap:wrap;
    gap:10px;
    margin-top:14px;
  }
  .mini-pill{
    background:#fff;
    border:1px solid #e9ecef;
    border-radius:12px;
    padding:10px 14px;
    font-size:13px;
  }
  .mini-pill strong{
    color:#495057;
    margin-right:6px;
  }
  .lead-accommodation-table th {
    font-size: 13px;
    font-weight: 700;
    white-space: nowrap;
  }
  .lead-accommodation-table td {
    font-size: 13px;
    vertical-align: middle;
  }
  #LeadsviewModal .nav-tabs .nav-link {
    font-weight: 600;
  }
  #LeadsviewModal .nav-tabs .nav-link.active {
    color: #0d6efd;
  }
  .leads-number-link {
    font-weight: 600;
    color: #0d6efd;
    text-decoration: none;
  }
  .leads-number-link:hover {
    text-decoration: underline;
  }
</style>

<!-- Leads details Modal -->
<div class="modal fade" id="LeadsviewModal" tabindex="-1" aria-labelledby="LeadsViewLabel" aria-hidden="true">
  <div class="modal-dialog modal-xl modal-dialog-scrollable Leadsview">
    <div class="modal-content lead-view-modal">
      <div class="modal-header lead-view-header">
        <h5 class="modal-title" id="LeadsViewLabel"><i class="fas fa-user-tag me-2"></i>Lead Details</h5>
        <button type="button" class="btn-close btn-close-white" data-bs-dismiss="modal" aria-label="Close"></button>
      </div>
      <div class="modal-body">
        <ul class="nav nav-tabs mb-3" id="leadViewTabs" role="tablist">
          <li class="nav-item">
            <button class="nav-link active" data-bs-toggle="tab" data-bs-target="#leadDetailsTab" type="button">
              <i class="fas fa-info-circle me-1"></i>Lead Details
            </button>
          </li>
          <li class="nav-item">
            <button class="nav-link" data-bs-toggle="tab" data-bs-target="#guestAccommodationTab" type="button">
              <i class="fas fa-bed me-1"></i>Guest Count & Accommodation
            </button>
          </li>
        </ul>
        <div class="tab-content">
          <div class="tab-pane fade show active" id="leadDetailsTab">
            <div id="leadViewBody">
              <div class="text-center py-5">
                <div class="spinner-border text-primary"></div>
                <p class="mt-2 mb-0">Loading lead details...</p>
              </div>
            </div>
          </div>
          <div class="tab-pane fade" id="guestAccommodationTab">
            <div id="guestAccommodationBody">
              <div class="text-center py-5">
                <div class="spinner-border text-primary"></div>
                <p class="mt-2 mb-0">Loading guest and accommodation details...</p>
              </div>
            </div>
          </div>
        </div>
      </div>
      <div class="modal-footer">
        <button class="btn btn-danger light" data-bs-dismiss="modal">Close</button>
      </div>
    </div>
  </div>
</div>

