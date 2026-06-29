<!--**********************************
            Content body start
        ***********************************-->
        <div class="content-body">
            <div class="container-fluid">
                <button type="button" id="btn" class="btn btn-rounded btn-primary btn-md"><i class="fas fa-filter"></i> Filter</button><br><br>

                <form id="convertedTripsFilterForm" method="POST" action="">
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
                                                <?php foreach ($staff as $row) {
                                                    echo '<option value="' . $row->user_id . '">' . $row->admin_name . '</option>';
                                                } ?>
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
                                            <input type="text" class="form-control" placeholder="Start date" id="start_date" name="start_date">
                                        </div>
                                    </div>
                                </div>
                                <div class="col-sm-6 col-md-3">
                                    <div class="card">
                                        <div class="input-group">
                                            <input type="text" class="form-control" placeholder="End date" id="end_date" name="end_date">
                                        </div>
                                    </div>
                                </div>
                                <div class="col-sm-2 col-md-3">
                                    <div class="card">
                                        <button type="button" class="btn btn-warning btn-md" id="search">
                                            <span class="btn-label">
                                                <i class="fas fa-search"></i>
                                            </span>
                                            Search
                                        </button>
                                    </div>
                                </div>
                                <div class="col-sm-2 col-md-3">
                                    <div class="card">
                                        <a href="<?php echo base_url(); ?>index.php/Quotation/converted_trips_report">
                                            <button type="button" class="btn btn-secondary btn-md" id="reset">
                                                <span class="btn-label">
                                                    <i class="icon-refresh"></i>
                                                </span>
                                                Refresh
                                            </button>
                                        </a>
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
                                <h2 class="card-title"><b>Converted Trips Report</b></h2>
                            </div>
                            <div class="card-body">
                                <div class="table-responsive">
                                    <table class="table card-table display mb-4 shadow-hover table-responsive-lg" id="ConvertedTripsReport">
                                        <thead>
                                            <tr>
                                                <th>Sl.no</th>
                                                <th>Quotation no</th>
                                                <th>Guest name</th>
                                                <th>Travel date</th>
                                                <th>Duration</th>
                                                <th>Assigned staff</th>
                                                <th>Total Cost</th>
                                                <th>Profit</th>
                                                <th>Incentive</th>
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
        <!--**********************************
            Content body end
        ***********************************-->
