<script type="text/javascript">
var base_url = '<?php echo base_url(); ?>index.php/';
var transporterReportTable;

$('#travel_date_range').daterangepicker({
    autoUpdateInput: false,
    locale: {
        format: 'DD/MM/YYYY',
        cancelLabel: 'Clear'
    }
});

$('#travel_date_range').on('apply.daterangepicker', function(ev, picker) {
    $(this).val(picker.startDate.format('DD/MM/YYYY') + ' - ' + picker.endDate.format('DD/MM/YYYY'));
});

$('#travel_date_range').on('cancel.daterangepicker', function() {
    $(this).val('');
});

$(document).ready(function() {
    loadTransporterReportTable();
});

function loadTransporterReportTable() {
    transporterReportTable = $('#transporter_report_table').DataTable({
        "processing": true,
        "serverSide": true,
        "order": [],
        "searching": false,
        "ajax": {
            "url": base_url + "Quotation/ajax_get_driver_not_assigned",
            "type": "POST",
            "data": function(d) {
                d.quotation_number_filter = $('#filter_quotation_number').val();
                d.guest_name_filter = $('#filter_guest_name').val();
                d.status_filter = $('#filter_status').val();
                var dateRange = $('#travel_date_range').val();
                if (dateRange) {
                    var dates = dateRange.split(' - ');
                    d.start_date = dates[0];
                    d.end_date = dates[1];
                } else {
                    d.start_date = '';
                    d.end_date = '';
                }
            }
        },
        "columnDefs": [
            { "targets": [0, -1], "orderable": false }
        ],
        "columns": [
            {
                data: null,
                render: function(data, type, row, meta) {
                    return meta.row + meta.settings._iDisplayStart + 1;
                }
            },
            { data: "guest_name" },
            { data: "travel_date" },
            { data: "transporter_name" },
            { data: "driver_name" },
            { data: "driver_mobile" },
            { data: "cab_number" },
            {
                data: "quotation_current_status",
                render: function(data) {
                    if (data == 7) {
                        return '<span class="badge bg-primary">Ready to Trip</span>';
                    }
                    return '<span class="badge bg-warning">Driver Not Assigned</span>';
                }
            },
            {
                data: null,
                render: function(data, type, row) {
                    if (row.quotation_current_status == 7) {
                        return '<button type="button" class="btn btn-warning shadow btn-xs sharp me-1" onclick="openAssignDriverModal(' + row.allocation_id + ',' + row.quotation_id + ')" title="Edit Driver Details"><i class="fas fa-edit"></i></button>';
                    }
                    return '<button type="button" class="btn btn-success shadow btn-xs sharp me-1" onclick="openAssignDriverModal(' + row.allocation_id + ',' + row.quotation_id + ')" title="Assign Driver"><i class="fas fa-edit"></i></button>';
                }
            }
        ]
    });
}

function toggleTransporterReportFilters() {
    $('#transporterReportFilterSection').slideToggle();
}

function applyTransporterReportFilters() {
    transporterReportTable.ajax.reload();
}

function clearTransporterReportFilters() {
    $('#filter_quotation_number').val('');
    $('#filter_guest_name').val('');
    $('#travel_date_range').val('');
    $('#filter_status').val('');
    transporterReportTable.ajax.reload();
}

function openAssignDriverModal(allocationId, quotationId) {
    var rowData = null;
    transporterReportTable.rows().every(function() {
        var data = this.data();
        if (data.allocation_id == allocationId) {
            rowData = data;
            return false;
        }
    });

    $('#ad_allocation_id').val(allocationId);
    $('#ad_quotation_id').val(quotationId);

    if (rowData) {
        $('#ad_driver_name').val(rowData.driver_name || '');
        $('#ad_driver_mobile').val(rowData.driver_mobile || '');
        $('#ad_cab_number').val(rowData.cab_number || '');
    } else {
        $('#ad_driver_name').val('');
        $('#ad_driver_mobile').val('');
        $('#ad_cab_number').val('');
    }

    $('#assignDriverModal').modal('show');
}

function submitAssignDriver() {
    var allocation_id = $('#ad_allocation_id').val();
    var quotation_id  = $('#ad_quotation_id').val();
    var driver_name   = $.trim($('#ad_driver_name').val());
    var driver_mobile = $.trim($('#ad_driver_mobile').val());
    var cab_number    = $.trim($('#ad_cab_number').val());

    if (driver_name == '') {
        var n = new notify({ title: '', style: 'error', message: 'Driver name is required.', icon: 'fas fa-times' });
        n.show(); setTimeout(function(){ n.hide(); }, 3000);
        $('#ad_driver_name').focus();
        return;
    }

    if (driver_mobile == '') {
        var n = new notify({ title: '', style: 'error', message: 'Driver mobile is required.', icon: 'fas fa-times' });
        n.show(); setTimeout(function(){ n.hide(); }, 3000);
        $('#ad_driver_mobile').focus();
        return;
    }

    if (cab_number == '') {
        var n = new notify({ title: '', style: 'error', message: 'Cab number is required.', icon: 'fas fa-times' });
        n.show(); setTimeout(function(){ n.hide(); }, 3000);
        $('#ad_cab_number').focus();
        return;
    }

    $.ajax({
        url: base_url + "Quotation/ajax_update_driver_details",
        type: "POST",
        dataType: "json",
        data: {
            allocation_id: allocation_id,
            quotation_id:  quotation_id,
            driver_name:   driver_name,
            driver_mobile: driver_mobile,
            cab_number:    cab_number
        },
        success: function(res) {
            $('#assignDriverModal').modal('hide');
            if (res.status) {
                transporterReportTable.ajax.reload();
                var n = new notify({ title: '', style: 'success', message: res.message || 'Driver details updated. Status set to Ready to Trip.', icon: 'fas fa-check' });
                n.show(); setTimeout(function(){ n.hide(); }, 3000);
            } else {
                var n = new notify({ title: '', style: 'error', message: res.message || 'Failed to update driver details.', icon: 'fas fa-times' });
                n.show(); setTimeout(function(){ n.hide(); }, 5000);
            }
        },
        error: function() {
            $('#assignDriverModal').modal('hide');
            var n = new notify({ title: '', style: 'error', message: 'Server error occurred.', icon: 'fas fa-times' });
            n.show(); setTimeout(function(){ n.hide(); }, 5000);
        }
    });
}
</script>
