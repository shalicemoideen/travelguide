<!--**********************************
    Content body start
***********************************-->
<div class="content-body">
    <div class="container-fluid">
        <!-- API Configuration Card -->
        <div class="row">
            <div class="col-12">
                <div class="card">
                    <div class="card-header d-flex justify-content-between align-items-center">
                        <h4 class="card-title mb-0">Biometric Device API Configuration</h4>
                        <button type="button" class="btn btn-primary btn-sm" onclick="toggleApiConfig()">
                            <i class="fas fa-cog"></i> Configure
                        </button>
                    </div>
                    <div class="card-body" id="apiConfigBody" style="display: none;">
                        <form id="apiConfigForm">
                            <input type="hidden" name="config_id" id="config_id" value="<?php echo isset($api_config->config_id) ? $api_config->config_id : ''; ?>">
                            <div class="row">
                                <div class="col-md-6">
                                    <div class="mb-3">
                                        <label class="form-label">API Name</label>
                                        <input type="text" class="form-control" name="api_name" id="api_name" 
                                            value="<?php echo isset($api_config->api_name) ? $api_config->api_name : 'Biometric Device API'; ?>">
                                    </div>
                                </div>
                                <div class="col-md-6">
                                    <div class="mb-3">
                                        <label class="form-label">API Endpoint</label>
                                        <input type="text" class="form-control" name="api_endpoint" id="api_endpoint" 
                                            value="<?php echo isset($api_config->api_endpoint) ? $api_config->api_endpoint : ''; ?>">
                                    </div>
                                </div>
                            </div>
                            <div class="row">
                                <div class="col-md-6">
                                    <div class="mb-3">
                                        <label class="form-label">API Username</label>
                                        <input type="text" class="form-control" name="api_username" id="api_username" 
                                            value="<?php echo isset($api_config->api_key) ? explode(':', $api_config->api_key)[0] : ''; ?>">
                                        <small class="text-muted">eSSL Web API username</small>
                                    </div>
                                </div>
                                <div class="col-md-6">
                                    <div class="mb-3">
                                        <label class="form-label">API Password</label>
                                        <input type="password" class="form-control" name="api_password" id="api_password" 
                                            value="<?php echo isset($api_config->api_key) && strpos($api_config->api_key, ':') !== false ? explode(':', $api_config->api_key)[1] : ''; ?>">
                                        <small class="text-muted">eSSL Web API password</small>
                                    </div>
                                </div>
                            </div>
                            <input type="hidden" name="api_key" id="api_key_hidden" value="<?php echo isset($api_config->api_key) ? $api_config->api_key : ''; ?>">
                            <input type="hidden" name="api_secret" id="api_secret_hidden" value="<?php echo isset($api_config->api_secret) ? $api_config->api_secret : ''; ?>">
                            <div class="row">
                                <div class="col-md-6">
                                    <div class="mb-3">
                                        <label class="form-label">Device ID</label>
                                        <input type="text" class="form-control" name="device_id" id="device_id" 
                                            value="<?php echo isset($api_config->device_id) ? $api_config->device_id : ''; ?>">
                                    </div>
                                </div>
                                <div class="col-md-6">
                                    <div class="mb-3">
                                        <label class="form-label">Sync Interval (minutes)</label>
                                        <input type="number" class="form-control" name="sync_interval_minutes" id="sync_interval_minutes" 
                                            value="<?php echo isset($api_config->sync_interval_minutes) ? $api_config->sync_interval_minutes : 60; ?>">
                                    </div>
                                </div>
                            </div>
                            <div class="row">
                                <div class="col-md-6">
                                    <div class="mb-3">
                                        <div class="form-check form-switch">
                                            <input class="form-check-input" type="checkbox" id="is_active" name="is_active" value="1" 
                                                <?php echo (isset($api_config->is_active) && $api_config->is_active == 1) ? 'checked' : ''; ?>>
                                            <label class="form-check-label" for="is_active">Enable API Integration</label>
                                        </div>
                                    </div>
                                </div>
                                <div class="col-md-6">
                                    <?php if (isset($api_config->last_sync_datetime) && $api_config->last_sync_datetime): ?>
                                    <small class="text-muted">
                                        Last Sync: <?php echo date('d-m-Y H:i', strtotime($api_config->last_sync_datetime)); ?> 
                                        (<?php echo $api_config->last_sync_status; ?>)
                                    </small>
                                    <?php endif; ?>
                                </div>
                            </div>
                            <div class="row mt-3">
                                <div class="col-12">
                                    <button type="button" class="btn btn-primary" onclick="saveApiConfig()">Save Configuration</button>
                                </div>
                            </div>
                        </form>
                    </div>
                </div>
            </div>
        </div>

        <!-- Sync Card -->
        <div class="row mt-3">
            <div class="col-12">
                <div class="card">
                    <div class="card-header">
                        <h4 class="card-title">Sync Attendance Data</h4>
                    </div>
                    <div class="card-body">
                        <div class="row align-items-end">
                            <div class="col-md-3">
                                <div class="mb-3">
                                    <label class="form-label">From Date</label>
                                    <input type="date" class="form-control" id="sync_from_date" 
                                        value="<?php echo date('Y-m-d', strtotime('-7 days')); ?>">
                                </div>
                            </div>
                            <div class="col-md-3">
                                <div class="mb-3">
                                    <label class="form-label">To Date</label>
                                    <input type="date" class="form-control" id="sync_to_date" 
                                        value="<?php echo date('Y-m-d'); ?>">
                                </div>
                            </div>
                            <div class="col-md-3">
                                <div class="mb-3">
                                    <button type="button" class="btn btn-success" onclick="syncFromDevice()">
                                        <i class="fas fa-sync"></i> Sync from Device
                                    </button>
                                </div>
                            </div>
                            <div class="col-md-3">
                                <div id="syncStatus" class="text-muted"></div>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
        </div>

        <!-- Filters and DataTable -->
        <div class="row mt-4">
            <div class="col-12">
                <div class="card">
                    <div class="card-header d-flex justify-content-between align-items-center">
                        <h4 class="card-title mb-0">Staff Attendance Records</h4>
                        <a onclick="add_attendance()" data-bs-target="#attendanceModal" class="btn btn-rounded btn-secondary btn-sm">+ Add Manual Entry</a>
                    </div>
                    <div class="card-body">
                        <!-- Filters -->
                        <div class="row mb-3">
                            <div class="col-md-3">
                                <label class="form-label">Staff</label>
                                <select class="form-control" id="filter_staff_id">
                                    <option value="">All Staff</option>
                                    <?php foreach ($staff_list as $staff): ?>
                                    <option value="<?php echo $staff->user_id; ?>"><?php echo $staff->admin_name; ?></option>
                                    <?php endforeach; ?>
                                </select>
                            </div>
                            <div class="col-md-2">
                                <label class="form-label">From Date</label>
                                <input type="date" class="form-control" id="filter_date_from">
                            </div>
                            <div class="col-md-2">
                                <label class="form-label">To Date</label>
                                <input type="date" class="form-control" id="filter_date_to">
                            </div>
                            <div class="col-md-2">
                                <label class="form-label">Status</label>
                                <select class="form-control" id="filter_status">
                                    <option value="">All Status</option>
                                    <option value="present">Present</option>
                                    <option value="absent">Absent</option>
                                    <option value="late">Late</option>
                                    <option value="half_day">Half Day</option>
                                    <option value="on_leave">On Leave</option>
                                    <option value="holiday">Holiday</option>
                                    <option value="weekend">Weekend</option>
                                </select>
                            </div>
                            <div class="col-md-3">
                                <label class="form-label">&nbsp;</label>
                                <div>
                                    <button type="button" class="btn btn-primary btn-sm" onclick="applyFilters()">Apply Filters</button>
                                    <button type="button" class="btn btn-secondary btn-sm" onclick="clearFilters()">Clear</button>
                                </div>
                            </div>
                        </div>

                        <div class="table-responsive">
                            <table id="attendance_table" class="display" style="min-width: 845px">
                                <thead>
                                    <tr>
                                        <th>Sl.no</th>
                                        <th>Staff Name</th>
                                        <th>Date</th>
                                        <th>Punch In</th>
                                        <th>Punch Out</th>
                                        <th>Working Hrs</th>
                                        <th>Status</th>
                                        <th>Type</th>
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
<!--**********************************
    Content body end
***********************************-->

<!-- Attendance Modal -->
<div class="modal fade" id="attendanceModal" role="dialog" data-backdrop="static" data-keyboard="false">
    <div class="modal-dialog modal-lg" role="document">
        <div class="modal-content">
            <div class="modal-header">
                <h5 class="modal-title"></h5>
                <button type="button" class="btn-close" onclick="closeAttendanceModal()" data-bs-dismiss="modal">
                </button>
            </div>
            <div class="modal-body">
                <form class="needs-validation" action="#" id="form">
                    <input type="hidden" value="" name="attendance_id" id="attendance_id"/>
                    <div class="row">
                        <div class="col-xl-12">
                            <div class="mb-3 row form-group">
                                <label class="col-lg-3 col-form-label" for="user_id_fk">Staff Member
                                    <span class="text-danger">*</span>
                                </label>
                                <div class="col-lg-9 user_id_fk">
                                    <select class="form-control" name="user_id_fk" id="user_id_fk" required>
                                        <option value="">Select Staff</option>
                                        <?php foreach ($staff_list as $staff): ?>
                                        <option value="<?php echo $staff->user_id; ?>"><?php echo $staff->admin_name; ?></option>
                                        <?php endforeach; ?>
                                    </select>
                                    <span class="help-block" style="color:red"></span>
                                    <b><span id="user_id_fk_alert" style="color: red"></span></b>
                                </div>
                            </div>
                            <div class="mb-3 row form-group">
                                <label class="col-lg-3 col-form-label" for="punch_date">Date
                                    <span class="text-danger">*</span>
                                </label>
                                <div class="col-lg-9 punch_date">
                                    <input type="date" class="form-control" name="punch_date" id="punch_date" required>
                                    <span class="help-block" style="color:red"></span>
                                    <b><span id="punch_date_alert" style="color: red"></span></b>
                                </div>
                            </div>
                            <div class="mb-3 row form-group">
                                <label class="col-lg-3 col-form-label" for="first_punch_in">Punch In Time</label>
                                <div class="col-lg-9">
                                    <input type="time" class="form-control" name="first_punch_in" id="first_punch_in">
                                </div>
                            </div>
                            <div class="mb-3 row form-group">
                                <label class="col-lg-3 col-form-label" for="last_punch_out">Punch Out Time</label>
                                <div class="col-lg-9">
                                    <input type="time" class="form-control" name="last_punch_out" id="last_punch_out">
                                </div>
                            </div>
                            <div class="mb-3 row form-group">
                                <label class="col-lg-3 col-form-label" for="status">Status
                                    <span class="text-danger">*</span>
                                </label>
                                <div class="col-lg-9 status">
                                    <select class="form-control" name="status" id="status" required>
                                        <option value="present">Present</option>
                                        <option value="absent">Absent</option>
                                        <option value="late">Late</option>
                                        <option value="half_day">Half Day</option>
                                        <option value="on_leave">On Leave</option>
                                        <option value="holiday">Holiday</option>
                                    </select>
                                    <span class="help-block" style="color:red"></span>
                                    <b><span id="status_alert" style="color: red"></span></b>
                                </div>
                            </div>
                            <div class="mb-3 row form-group">
                                <label class="col-lg-3 col-form-label" for="shift_id_fk">Shift</label>
                                <div class="col-lg-9">
                                    <select class="form-control" name="shift_id_fk" id="shift_id_fk">
                                        <option value="">Select Shift</option>
                                        <?php foreach ($shifts as $shift): ?>
                                        <option value="<?php echo $shift->shift_id; ?>"><?php echo $shift->shift_name; ?></option>
                                        <?php endforeach; ?>
                                    </select>
                                </div>
                            </div>
                            <div class="mb-3 row form-group">
                                <label class="col-lg-3 col-form-label" for="manual_entry_reason">Reason/Notes</label>
                                <div class="col-lg-9">
                                    <textarea class="form-control" name="manual_entry_reason" id="manual_entry_reason" rows="3" placeholder="Enter reason for manual entry or any notes"></textarea>
                                </div>
                            </div>
                        </div>
                    </div>
                </form>
            </div>
            <div class="modal-footer">
                <button type="button" class="btn btn-danger light" onclick="closeAttendanceModal()" data-bs-dismiss="modal">Close</button>
                <button type="button" class="btn btn-primary" id="btnSave" onclick="save()">Save</button>
            </div>
        </div>
    </div>
</div>

<!-- Delete Modal -->
<div class="modal fade" id="deleteAttendanceModal" role="dialog" data-backdrop="static" data-keyboard="false">
    <div class="modal-dialog" role="document">
        <div class="modal-content">
            <div class="modal-header">
                <h5 class="modal-title1">Delete Attendance Record</h5>
                <button type="button" class="btn-close" data-bs-dismiss="modal">
                </button>
            </div>
            <div class="modal-body">
                <form class="needs-validation" action="#" id="deleteForm">
                    <input type="hidden" value="" name="delete_attendance_id" id="delete_attendance_id"/>
                    <p>Are you sure you want to delete this attendance record?</p>
                </form>
            </div>
            <div class="modal-footer">
                <button type="button" class="btn btn-danger light" onclick="closeDeleteModal()" data-bs-dismiss="modal">Close</button>
                <button type="button" class="btn btn-primary" id="btnDelete" onclick="deleteAttendance()">Delete</button>
            </div>
        </div>
    </div>
</div>
