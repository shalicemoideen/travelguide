<script>
var save_method;
var table;

$(document).ready(function() {
    table = $('#attendance_table').DataTable({
        "processing": true,
        "serverSide": true,
        "searching": true,
        "aLengthMenu": [[10, 25, 50, 100], [10, 25, 50, 100]],
        dom: 'lBfrtip',
        buttons: [
            {
                extend: 'excel',
                exportOptions: {
                    columns: [0, 1, 2, 3, 4, 5, 6, 7]
                }
            },
            {
                extend: 'pdf',
                exportOptions: {
                    columns: [0, 1, 2, 3, 4, 5, 6, 7]
                }
            },
            {
                extend: 'print',
                exportOptions: {
                    columns: [0, 1, 2, 3, 4, 5, 6, 7]
                }
            },
        ],
        "ajax": {
            "url": "<?php echo base_url();?>index.php/Staff_attendance/get/",
            "type": "POST",
            "data": function(d) {
                d.staff_id_filter = $('#filter_staff_id').val();
                d.date_from_filter = $('#filter_date_from').val();
                d.date_to_filter = $('#filter_date_to').val();
                d.status_filter = $('#filter_status').val();
            }
        },
        "createdRow": function(row, data, index) {
            table.column(0).nodes().each(function(node, index, dt) {
                table.cell(node).data(index + 1);
            });

            // Status badge styling
            let statusBadge = '';
            switch(data.status) {
                case 'present':
                    statusBadge = '<span class="badge bg-success">Present</span>';
                    break;
                case 'absent':
                    statusBadge = '<span class="badge bg-danger">Absent</span>';
                    break;
                case 'late':
                    statusBadge = '<span class="badge bg-warning text-dark">Late</span>';
                    break;
                case 'half_day':
                    statusBadge = '<span class="badge bg-info">Half Day</span>';
                    break;
                case 'on_leave':
                    statusBadge = '<span class="badge bg-secondary">On Leave</span>';
                    break;
                case 'holiday':
                    statusBadge = '<span class="badge bg-primary">Holiday</span>';
                    break;
                case 'weekend':
                    statusBadge = '<span class="badge bg-dark">Weekend</span>';
                    break;
                default:
                    statusBadge = '<span class="badge bg-light text-dark">' + data.status + '</span>';
            }
            $('td', row).eq(6).html(statusBadge);

            // Entry type badge
            let typeBadge = data.is_manual_entry == 1 ? 
                '<span class="badge bg-warning text-dark">Manual</span>' : 
                '<span class="badge bg-success">Device</span>';
            $('td', row).eq(7).html(typeBadge);

            // Action buttons
            let actionHtml = '<div class="d-flex">';
            actionHtml += '<a href="javascript:void(0)" onclick="edit_attendance(' + data.attendance_id + ')" class="btn btn-primary shadow btn-xs sharp me-1"><i class="fas fa-pencil-alt"></i></a>';
            actionHtml += '<a href="javascript:void(0)" onclick="delete_attendance(' + data.attendance_id + ')" class="btn btn-danger shadow btn-xs sharp"><i class="fa fa-trash"></i></a>';
            actionHtml += '</div>';
            $('td', row).eq(8).html(actionHtml);
        },
        "columns": [
            { "data": "attendance_id", "orderable": false },
            { "data": "staff_name", "orderable": true },
            { "data": "punch_date", "orderable": true },
            { "data": "first_punch_in", "orderable": true },
            { "data": "last_punch_out", "orderable": true },
            { "data": "net_working_hours", "orderable": true },
            { "data": "status", "orderable": true },
            { "data": "is_manual_entry", "orderable": true },
            { "data": "attendance_id", "orderable": false }
        ]
    });
});

function toggleApiConfig() {
    $('#apiConfigBody').slideToggle();
}

function saveApiConfig() {
    var url = "<?php echo base_url();?>index.php/Staff_attendance/save_api_config";
    
    // Combine username and password into api_key field (format: username:password)
    var username = $('#api_username').val();
    var password = $('#api_password').val();
    $('#api_key_hidden').val(username + ':' + password);
    
    $.ajax({
        url: url,
        type: "POST",
        data: $('#apiConfigForm').serialize(),
        dataType: "JSON",
        success: function(data) {
            if (data.status) {
                if (typeof toastr !== 'undefined') {
                    toastr.success('API configuration saved successfully');
                } else {
                    alert('API configuration saved successfully');
                }
            } else {
                if (typeof toastr !== 'undefined') {
                    toastr.error('Failed to save configuration');
                } else {
                    alert('Failed to save configuration');
                }
            }
        },
        error: function(jqXHR, textStatus, errorThrown) {
            alert('Error saving configuration');
        }
    });
}

function syncFromDevice() {
    var from_date = $('#sync_from_date').val();
    var to_date = $('#sync_to_date').val();

    if (!from_date || !to_date) {
        if (typeof toastr !== 'undefined') {
            toastr.error('Please select date range');
        } else {
            alert('Please select date range');
        }
        return;
    }

    $('#syncStatus').html('<span class="text-info"><i class="fas fa-spinner fa-spin"></i> Syncing...</span>');

    $.ajax({
        url: "<?php echo base_url();?>index.php/Staff_attendance/sync_from_device",
        type: "POST",
        data: { from_date: from_date, to_date: to_date },
        dataType: "JSON",
        success: function(data) {
            if (data.status) {
                $('#syncStatus').html('<span class="text-success"><i class="fas fa-check"></i> ' + data.message + '</span>');
                if (typeof toastr !== 'undefined') {
                    toastr.success(data.message);
                } else {
                    alert(data.message);
                }
                table.ajax.reload();
            } else {
                $('#syncStatus').html('<span class="text-danger"><i class="fas fa-times"></i> ' + data.message + '</span>');
                if (typeof toastr !== 'undefined') {
                    toastr.error(data.message);
                } else {
                    alert(data.message);
                }
            }
        },
        error: function(jqXHR, textStatus, errorThrown) {
            $('#syncStatus').html('<span class="text-danger">Sync failed</span>');
            alert('Error syncing data from device');
        }
    });
}

function applyFilters() {
    table.ajax.reload();
}

function clearFilters() {
    $('#filter_staff_id').val('');
    $('#filter_date_from').val('');
    $('#filter_date_to').val('');
    $('#filter_status').val('');
    table.ajax.reload();
}

function add_attendance() {
    save_method = 'add';
    $('#form')[0].reset();
    $('.modal-title').text('Add Manual Attendance Entry');
    $('#attendance_id').val('');
    $('#attendanceModal').modal('show');
}

function edit_attendance(id) {
    save_method = 'update';
    $('#form')[0].reset();
    $('.modal-title').text('Edit Attendance Record');
    
    $.ajax({
        url: "<?php echo base_url();?>index.php/Staff_attendance/ajax_edit/" + id,
        type: "GET",
        dataType: "JSON",
        success: function(data) {
            $('#attendance_id').val(data.attendance_id);
            $('#user_id_fk').val(data.user_id_fk);
            $('#punch_date').val(data.punch_date);
            $('#first_punch_in').val(data.first_punch_in);
            $('#last_punch_out').val(data.last_punch_out);
            $('#status').val(data.status);
            $('#shift_id_fk').val(data.shift_id_fk);
            $('#manual_entry_reason').val(data.manual_entry_reason);
            $('#attendanceModal').modal('show');
        },
        error: function(jqXHR, textStatus, errorThrown) {
            alert('Error getting attendance details');
        }
    });
}

function save() {
    $('#user_id_fk_alert').text('');
    $('#punch_date_alert').text('');
    $('#status_alert').text('');

    if ($('#user_id_fk').val() == '') {
        $('#user_id_fk_alert').text('Staff member is required');
        return;
    }

    if ($('#punch_date').val() == '') {
        $('#punch_date_alert').text('Date is required');
        return;
    }

    if ($('#status').val() == '') {
        $('#status_alert').text('Status is required');
        return;
    }

    var url;
    if (save_method == 'add') {
        url = "<?php echo base_url();?>index.php/Staff_attendance/ajax_add";
        
        // Check if attendance already exists
        $.ajax({
            url: "<?php echo base_url();?>index.php/Staff_attendance/check_attendance_exists",
            type: "POST",
            data: { 
                user_id: $('#user_id_fk').val(),
                punch_date: $('#punch_date').val()
            },
            dataType: "JSON",
            success: function(data) {
                if (data.exists) {
                    if (typeof toastr !== 'undefined') {
                        toastr.warning('Attendance record already exists for this staff on selected date');
                    } else {
                        alert('Attendance record already exists for this staff on selected date');
                    }
                } else {
                    submitForm(url);
                }
            }
        });
    } else {
        url = "<?php echo base_url();?>index.php/Staff_attendance/ajax_update";
        submitForm(url);
    }
}

function submitForm(url) {
    $.ajax({
        url: url,
        type: "POST",
        data: $('#form').serialize(),
        dataType: "JSON",
        success: function(data) {
            if (data.status) {
                if (typeof toastr !== 'undefined') {
                    if (save_method == 'add') {
                        toastr.success('Attendance record added successfully');
                    } else {
                        toastr.success('Attendance record updated successfully');
                    }
                } else {
                    if (save_method == 'add') {
                        alert('Attendance record added successfully');
                    } else {
                        alert('Attendance record updated successfully');
                    }
                }
                $('#attendanceModal').modal('hide');
                table.ajax.reload();
            } else {
                if (typeof toastr !== 'undefined') {
                    toastr.error('Failed to save record');
                } else {
                    alert('Failed to save record');
                }
            }
        },
        error: function(jqXHR, textStatus, errorThrown) {
            alert('Error saving attendance record');
        }
    });
}

function delete_attendance(id) {
    $('#delete_attendance_id').val(id);
    $('#deleteAttendanceModal').modal('show');
}

function deleteAttendance() {
    $.ajax({
        url: "<?php echo base_url();?>index.php/Staff_attendance/delete",
        type: "POST",
        data: { attendance_id: $('#delete_attendance_id').val() },
        dataType: "JSON",
        success: function(data) {
            if (data.status) {
                if (typeof toastr !== 'undefined') {
                    toastr.success('Attendance record deleted successfully');
                } else {
                    alert('Attendance record deleted successfully');
                }
                $('#deleteAttendanceModal').modal('hide');
                table.ajax.reload();
            } else {
                if (typeof toastr !== 'undefined') {
                    toastr.error('Failed to delete record');
                } else {
                    alert('Failed to delete record');
                }
            }
        },
        error: function(jqXHR, textStatus, errorThrown) {
            alert('Error deleting attendance record');
        }
    });
}

function closeAttendanceModal() {
    $('#attendanceModal').modal('hide');
}

function closeDeleteModal() {
    $('#deleteAttendanceModal').modal('hide');
}
</script>
