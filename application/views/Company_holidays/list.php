<!--**********************************
            Content body start
        ***********************************-->
        <div class="content-body">
            <div class="container-fluid">
                <!-- Holiday Settings Card -->
                <div class="row">
                    <div class="col-12">
                        <div class="card">
                            <div class="card-header">
                                <h4 class="card-title">Recurring Holiday Settings</h4>
                            </div>
                            <div class="card-body">
                                <form id="settingsForm">
                                    <div class="row">
                                        <div class="col-md-6">
                                            <div class="form-check form-switch">
                                                <input class="form-check-input" type="checkbox" id="enable_sunday_holiday" name="enable_sunday_holiday" value="1" <?php echo isset($settings) && $this->Company_holidays_model->get_setting('enable_sunday_holiday') == '1' ? 'checked' : ''; ?>>
                                                <label class="form-check-label" for="enable_sunday_holiday">Enable all Sundays as holidays</label>
                                            </div>
                                        </div>
                                        <div class="col-md-6">
                                            <div class="form-check form-switch">
                                                <input class="form-check-input" type="checkbox" id="enable_second_saturday_holiday" name="enable_second_saturday_holiday" value="1" <?php echo isset($settings) && $this->Company_holidays_model->get_setting('enable_second_saturday_holiday') == '1' ? 'checked' : ''; ?>>
                                                <label class="form-check-label" for="enable_second_saturday_holiday">Enable 2nd Saturday of every month as holiday</label>
                                            </div>
                                        </div>
                                    </div>
                                    <div class="row mt-3">
                                        <div class="col-12">
                                            <button type="button" class="btn btn-primary" onclick="saveSettings()">Save Settings</button>
                                        </div>
                                    </div>
                                </form>
                            </div>
                        </div>
                    </div>
                </div>
                <!-- row -->
                <div class="row mt-4">
					<div class="col-12">
                        <div class="card">
                            <div class="card-header">
                                <h4 class="card-title">Company Holidays</h4>
                                <a onclick="add_holiday()" data-bs-target="#holidayModal" class="btn btn-rounded btn-secondary btn-md">+ New Holiday</a>
                            </div>
                            <div class="card-body">
                                <div class="table-responsive">
                                    <table id="holiday_table" class="display" style="min-width: 845px">
                                        <thead>
                                            <tr>
                                                <th>Sl.no</th>
                                                <th>Holiday Name</th>
                                                <th>Date</th>
                                                <th>Type</th>
                                                <th>Description</th>
                                                <th>Created By</th>
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

        <!-- Modal -->
        <div class="modal fade" id="holidayModal" role="dialog" data-backdrop="static" data-keyboard="false">
            <div class="modal-dialog" role="document">
                <div class="modal-content">
                    <div class="modal-header">
                        <h5 class="modal-title"></h5>
                        <button type="button" class="btn-close" onclick="closeHolidayModal()" data-bs-dismiss="modal">
                        </button>
                    </div>
                    <div class="modal-body">
                        <form class="needs-validation" action="#" id="form">
                            <input type="hidden" value="" name="id" id="id"/>
                            <div class="row">
                                <div class="col-xl-12">
                                    <div class="mb-3 row form-group">
                                        <label class="col-lg-4 col-form-label" for="holiday_name">Holiday Name
                                            <span class="text-danger">*</span>
                                        </label>
                                        <div class="col-lg-8 holiday_name">
                                            <input type="text" class="form-control" name="holiday_name" id="holiday_name" placeholder="Enter holiday name" required>
                                            <span class="help-block" style="color:red"></span>
                                            <b><span id="holiday_name_alert" style="color: red"></span></b>
                                        </div>
                                    </div>
                                    <div class="mb-3 row form-group">
                                        <label class="col-lg-4 col-form-label" for="holiday_date">Holiday Date
                                            <span class="text-danger">*</span>
                                        </label>
                                        <div class="col-lg-8 holiday_date">
                                            <input type="date" class="form-control" name="holiday_date" id="holiday_date" required onchange="checkHolidayType()">
                                            <span class="help-block" style="color:red"></span>
                                            <b><span id="holiday_date_alert" style="color: red"></span></b>
                                            <small class="text-info mt-1" id="holiday_type_info"></small>
                                        </div>
                                    </div>
                                    <div class="mb-3 row form-group">
                                        <label class="col-lg-4 col-form-label" for="holiday_type">Holiday Type
                                        </label>
                                        <div class="col-lg-8">
                                            <select class="form-control" name="holiday_type" id="holiday_type">
                                                <option value="fixed">Fixed (One-time)</option>
                                                <option value="recurring">Recurring (Every Year)</option>
                                            </select>
                                        </div>
                                    </div>
                                    <div class="mb-3 row">
                                        <label class="col-lg-4 col-form-label" for="holiday_description">Description
                                        </label>
                                        <div class="col-lg-8">
                                            <textarea class="form-control" name="holiday_description" id="holiday_description" rows="5" placeholder="Enter Description"></textarea>
                                        </div>
                                    </div>
                                </div>
                            </div>
                        </form>
                    </div>
                    <div class="modal-footer">
                        <button type="button" class="btn btn-danger light" onclick="closeHolidayModal()" data-bs-dismiss="modal">Close</button>
                        <button type="button" class="btn btn-primary" id="btnSave" onclick="save()">Save</button>
                    </div>
                </div>
            </div>
        </div>

<!-- Delete Modal -->
<div class="modal fade" id="deleteHolidayModal" role="dialog" data-backdrop="static" data-keyboard="false">
    <div class="modal-dialog" role="document">
        <div class="modal-content">
            <div class="modal-header">
                <h5 class="modal-title1">Delete Holiday</h5>
                <button type="button" class="btn-close" data-bs-dismiss="modal">
                </button>
            </div>
            <div class="modal-body">
                <form class="needs-validation" action="#" id="deleteForm">
                    <input type="hidden" value="" name="id" id="deleteId"/>
                    <input type="hidden" value="" name="holiday_name" id="deleteHolidayName"/>
                    <p>Are you sure you want to delete this holiday?</p>
                </form>
            </div>
            <div class="modal-footer">
                <button type="button" class="btn btn-danger light" onclick="closeDeleteModal()" data-bs-dismiss="modal">Close</button>
                <button type="button" class="btn btn-primary" id="btnDelete" onclick="deleteHoliday()">Delete</button>
            </div>
        </div>
    </div>
</div>
