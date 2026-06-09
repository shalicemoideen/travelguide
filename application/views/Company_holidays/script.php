<script>
var save_method;
var table;

$(document).ready(function() {
    table = $('#holiday_table').DataTable({
        "processing": true,
        "serverSide": true,
        "searching": true,
        "aLengthMenu": [[10, 25, 50, -1], [10, 25, 50, "All"]],
        dom: 'lBfrtip',
        buttons: [
            {
                extend: 'excel',
                exportOptions: {
                    columns: [0, 1, 2, 3, 4, 5]
                }
            },
            {
                extend: 'pdf',
                exportOptions: {
                    columns: [0, 1, 2, 3, 4, 5]
                }
            },
            {
                extend: 'print',
                exportOptions: {
                    columns: [0, 1, 2, 3, 4, 5]
                }
            },
        ],
        "ajax": {
            "url": "<?php echo base_url();?>index.php/Company_holidays/get/",
            "type": "POST"
        },
        "createdRow": function(row, data, index) {
            table.column(0).nodes().each(function(node, index, dt) {
                table.cell(node).data(index + 1);
            });

            let actionHtml = '<div class="d-flex">';
            actionHtml += '<a href="javascript:void(0)" onclick="edit_holiday(' + data['company_holiday_id'] + ')" class="btn btn-primary shadow btn-xs sharp me-1"><i class="fas fa-pencil-alt"></i></a>';
            actionHtml += '<a href="javascript:void(0)" onclick="return delete_holiday(' + data['company_holiday_id'] + ', \'' + data['holiday_name'] + '\')" class="btn btn-danger shadow btn-xs sharp"><i class="fa fa-trash"></i></a>';
            actionHtml += '</div>';

            $('td', row).eq(6).html(actionHtml);
        },
        "columns": [
            { "data": "holiday_status", "orderable": false },
            { "data": "holiday_name", "orderable": false },
            { "data": "holiday_date", "orderable": false },
            { "data": "holiday_type", "orderable": false },
            { "data": "holiday_description", "orderable": false },
            { "data": "holiday_created_by_username", "orderable": false },
            { "data": "company_holiday_id", "orderable": false }
        ]
    });
});

function add_holiday() {
    save_method = 'add';
    $('#form')[0].reset();
    $('.modal-title').text('Add New Holiday');
    $('#holidayModal').modal('show');
}

function edit_holiday(id) {
    save_method = 'update';
    $('#form')[0].reset();
    $('.modal-title').text('Edit Holiday');
    
    $.ajax({
        url: "<?php echo base_url();?>index.php/Company_holidays/ajax_edit/" + id,
        type: "GET",
        dataType: "JSON",
        success: function(data) {
            $('#id').val(data.company_holiday_id);
            $('#holiday_name').val(data.holiday_name);
            $('#holiday_date').val(data.holiday_date);
            $('#holiday_type').val(data.holiday_type);
            $('#holiday_description').val(data.holiday_description);
            $('#holidayModal').modal('show');
        },
        error: function(jqXHR, textStatus, errorThrown) {
            alert('Error getting holiday details');
        }
    });
}

function save() {
    $('#holiday_name_alert').text('');
    $('#holiday_date_alert').text('');

    if ($('#holiday_name').val() == '') {
        $('#holiday_name_alert').text('Holiday name is required');
        return;
    }

    if ($('#holiday_date').val() == '') {
        $('#holiday_date_alert').text('Holiday date is required');
        return;
    }

    var url;
    if (save_method == 'add') {
        url = "<?php echo base_url();?>index.php/Company_holidays/ajax_add";
    } else {
        url = "<?php echo base_url();?>index.php/Company_holidays/ajax_update";
    }

    // Check if holiday date already exists
    if (save_method == 'add') {
        $.ajax({
            url: "<?php echo base_url();?>index.php/Company_holidays/checkHolidayDate",
            type: "POST",
            data: { value: $('#holiday_date').val() },
            dataType: "JSON",
            success: function(data) {
                if (data > 0) {
                    $('#holiday_date_alert').text('Holiday date already exists');
                    return;
                }
                submitForm(url);
            }
        });
    } else {
        $.ajax({
            url: "<?php echo base_url();?>index.php/Company_holidays/checkEditHolidayDate",
            type: "POST",
            data: { value: $('#holiday_date').val(), id: $('#id').val() },
            dataType: "JSON",
            success: function(data) {
                if (data > 0) {
                    $('#holiday_date_alert').text('Holiday date already exists');
                    return;
                }
                submitForm(url);
            }
        });
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
                if (save_method == 'add') {
                    if (typeof toastr !== 'undefined') {
                        toastr.success('Holiday added successfully');
                    } else {
                        alert('Holiday added successfully');
                    }
                } else {
                    if (typeof toastr !== 'undefined') {
                        toastr.success('Holiday updated successfully');
                    } else {
                        alert('Holiday updated successfully');
                    }
                }
                $('#holidayModal').modal('hide');
                table.ajax.reload();
            } else {
                if (typeof toastr !== 'undefined') {
                    toastr.error('Failed to save holiday');
                } else {
                    alert('Failed to save holiday');
                }
            }
        },
        error: function(jqXHR, textStatus, errorThrown) {
            alert('Error saving holiday');
        }
    });
}

function delete_holiday(id, holiday_name) {
    $('#deleteId').val(id);
    $('#deleteHolidayName').val(holiday_name);
    $('#deleteHolidayModal').modal('show');
}

function deleteHoliday() {
    $.ajax({
        url: "<?php echo base_url();?>index.php/Company_holidays/delete",
        type: "POST",
        data: { id: $('#deleteId').val(), holiday_name: $('#deleteHolidayName').val() },
        dataType: "JSON",
        success: function(data) {
            if (data.status) {
                if (typeof toastr !== 'undefined') {
                    toastr.success('Holiday deleted successfully');
                } else {
                    alert('Holiday deleted successfully');
                }
                $('#deleteHolidayModal').modal('hide');
                table.ajax.reload();
            } else {
                if (typeof toastr !== 'undefined') {
                    toastr.error('Failed to delete holiday');
                } else {
                    alert('Failed to delete holiday');
                }
            }
        },
        error: function(jqXHR, textStatus, errorThrown) {
            alert('Error deleting holiday');
        }
    });
}

function closeHolidayModal() {
    $('#holidayModal').modal('hide');
}

function closeDeleteModal() {
    $('#deleteHolidayModal').modal('hide');
}

function checkHolidayType() {
    let date = $('#holiday_date').val();
    if (!date) {
        $('#holiday_type_info').text('');
        return;
    }

    $.ajax({
        url: "<?php echo base_url();?>index.php/Company_holidays/ajax_check_date_holiday",
        type: "POST",
        data: { date: date },
        dataType: "JSON",
        success: function(data) {
            if (data.is_holiday) {
                $('#holiday_type_info').text('Note: This date is a ' + data.holiday_type + ' (automatically treated as holiday)');
                $('#holiday_type_info').removeClass('text-info').addClass('text-warning');
            } else {
                $('#holiday_type_info').text('');
            }
        }
    });
}

function saveSettings() {
    let enable_sunday = $('#enable_sunday_holiday').is(':checked') ? '1' : '0';
    let enable_second_saturday = $('#enable_second_saturday_holiday').is(':checked') ? '1' : '0';

    $.ajax({
        url: "<?php echo base_url();?>index.php/Company_holidays/ajax_update_settings",
        type: "POST",
        data: {
            enable_sunday_holiday: enable_sunday,
            enable_second_saturday_holiday: enable_second_saturday
        },
        dataType: "JSON",
        success: function(data) {
            if (data.status) {
                if (typeof toastr !== 'undefined') {
                    toastr.success('Settings updated successfully');
                } else {
                    alert('Settings updated successfully');
                }
            } else {
                if (typeof toastr !== 'undefined') {
                    toastr.error('Failed to update settings');
                } else {
                    alert('Failed to update settings');
                }
            }
        }
    });
}
</script>
