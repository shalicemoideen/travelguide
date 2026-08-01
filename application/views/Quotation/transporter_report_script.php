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
                    if (data == 10) {
                        return '<span class="badge bg-success">Trip Completed</span>';
                    }
                    return '<span class="badge bg-warning">Driver Not Assigned</span>';
                }
            },
            {
                data: null,
                render: function(data, type, row) {
                    var html = '<button type="button" class="btn btn-info shadow btn-xs sharp me-1" onclick="viewGuestDetails(' + row.quotation_id + ')" title="View Guest Details"><i class="fas fa-eye"></i></button>';
                    html += '<a class="btn btn-secondary shadow btn-xs sharp me-1" target="_blank" href="' + base_url + 'Quotation/driver_itinerary_preview/' + row.quotation_id + '" title="Driver Itinerary"><i class="fas fa-route"></i></a>';
                    if (row.quotation_current_status == 7) {
                        html += '<button type="button" class="btn btn-warning shadow btn-xs sharp me-1" onclick="openAssignDriverModal(' + row.allocation_id + ',' + row.quotation_id + ')" title="Edit Driver Details"><i class="fas fa-edit"></i></button>';
                    } else {
                        html += '<button type="button" class="btn btn-success shadow btn-xs sharp me-1" onclick="openAssignDriverModal(' + row.allocation_id + ',' + row.quotation_id + ')" title="Assign Driver"><i class="fas fa-edit"></i></button>';
                    }
                    return html;
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
        $('#ad_vehicle_name').text(rowData.confirmed_vehicle_name || '-');
        $('#ad_driver_name').val(rowData.driver_name || '');
        $('#ad_driver_mobile').val(rowData.driver_mobile || '');
        $('#ad_cab_number').val(rowData.cab_number || '');
    } else {
        $('#ad_vehicle_name').text('-');
        $('#ad_driver_name').val('');
        $('#ad_driver_mobile').val('');
        $('#ad_cab_number').val('');
    }

    // Fetch guest count details
    $('#ad_guest_count').text('Loading...');
    $.ajax({
        url: base_url + 'Quotation/ajax_get_transporter_guest_details',
        type: 'POST',
        dataType: 'json',
        data: { quotation_id: quotationId },
        success: function(res) {
            if (res.status && res.data) {
                var gc = res.data.guest_count || [];
                var totalAdults = 0, totalChildren = 0;
                for (var i = 0; i < gc.length; i++) {
                    totalAdults += parseInt(gc[i].adults || 0);
                    totalChildren += parseInt(gc[i].children || 0);
                }
                // Collect child ages from guest count details (skip entries with count 0)
                var childAges = [];
                for (var i = 0; i < gc.length; i++) {
                    if (gc[i].child_ages) {
                        for (var j = 0; j < gc[i].child_ages.length; j++) {
                            if (parseInt(gc[i].child_ages[j].count) > 0) {
                                childAges.push(gc[i].child_ages[j].age + ' yrs (' + gc[i].child_ages[j].count + ')');
                            }
                        }
                    }
                }
                var childAgeStr = childAges.length > 0 ? childAges.join(', ') : '0';
                $('#ad_guest_count').text(totalAdults + ' Adults, ' + totalChildren + ' Children (' + childAgeStr + ')');
            } else {
                $('#ad_guest_count').text('-');
            }
        },
        error: function() {
            $('#ad_guest_count').text('-');
        }
    });

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

var _guestDetailsCache = null;

function viewGuestDetails(quotationId) {
    _guestDetailsCache = null;
    $('#guestDetailsContent').html('<div class="text-center text-muted py-4">Loading...</div>');
    $('#viewGuestDetailsModal').modal('show');

    $.ajax({
        url: base_url + 'Quotation/ajax_get_transporter_guest_details',
        type: 'POST',
        dataType: 'json',
        data: { quotation_id: quotationId },
        success: function(res) {
            if (!res.status) {
                $('#guestDetailsContent').html('<div class="text-center text-danger py-4">' + (res.message || 'Failed to load') + '</div>');
                return;
            }
            var d = res.data;
            _guestDetailsCache = d;
            renderGuestDetails(d);
        },
        error: function() {
            $('#guestDetailsContent').html('<div class="text-center text-danger py-4">Server error occurred.</div>');
        }
    });
}

function fmtDate(dateStr) {
    if (!dateStr || dateStr == '0000-00-00') return '-';
    var d = new Date(dateStr);
    return d.toLocaleDateString('en-GB', { day: '2-digit', month: 'short', year: 'numeric' });
}

function renderGuestDetails(d) {
    var m = d.main;
    var gc = d.guest_count || [];
    var days = d.days || [];

    var totalAdults = 0, totalChildren = 0, totalGuests = 0;
    for (var i = 0; i < gc.length; i++) {
        totalAdults += parseInt(gc[i].adults || 0);
        totalChildren += parseInt(gc[i].children || 0);
        totalGuests += parseInt(gc[i].total_count || 0);
    }

    var html = '';

    html += '<div class="row mb-3">';
    html += '<div class="col-md-6"><strong>Guest Name:</strong> ' + escapeHtml(m.guest_name || '-') + '</div>';
    html += '<div class="col-md-6"><strong>Quotation No:</strong> ' + escapeHtml(m.quotation_number || '-') + '</div>';
    html += '</div>';

    html += '<div class="row mb-3">';
    html += '<div class="col-md-6"><strong>Phone (WhatsApp):</strong> ' + escapeHtml(m.whats_number || '-') + '</div>';
    html += '<div class="col-md-6"><strong>Alternative Number:</strong> ' + escapeHtml(m.alternative_number || '-') + '</div>';
    html += '</div>';

    html += '<div class="row mb-3">';
    html += '<div class="col-md-4"><strong>Travel Date:</strong> ' + fmtDate(m.start_date) + '</div>';
    html += '<div class="col-md-4"><strong>Tour Duration:</strong> ' + (m.duration || 0) + ' Nights</div>';
    html += '<div class="col-md-4"><strong>Travel End Date:</strong> ' + fmtDate(m.end_date) + '</div>';
    html += '</div>';

    html += '<div class="row mb-3">';
    html += '<div class="col-md-6"><strong>Arrival:</strong> ' + escapeHtml(m.arriving_destination || '-') + '</div>';
    html += '<div class="col-md-6"><strong>Departure:</strong> ' + escapeHtml(m.departuring_destination || '-') + '</div>';
    html += '</div>';

    html += '<hr>';
    html += '<h6 class="fw-bold mb-2">Guest Count</h6>';
    if (gc.length > 0) {
        // Collect child ages (skip entries with count 0)
        var childAges = [];
        for (var i = 0; i < gc.length; i++) {
            if (gc[i].child_ages) {
                for (var j = 0; j < gc[i].child_ages.length; j++) {
                    if (parseInt(gc[i].child_ages[j].count) > 0) {
                        childAges.push(gc[i].child_ages[j].age + ' yrs (' + gc[i].child_ages[j].count + ')');
                    }
                }
            }
        }
        var childAgeStr = childAges.length > 0 ? childAges.join(', ') : '0';
        html += '<p class="mb-3"><strong>Total Guest Count ' + totalGuests + ':</strong> ' + totalAdults + ' Adults, ' + totalChildren + ' Children (' + escapeHtml(childAgeStr) + ')</p>';
    } else {
        html += '<p class="text-muted mb-3">No guest count data available.</p>';
    }

    html += '<hr>';
    html += '<h6 class="fw-bold mb-2">Itinerary Details</h6>';
    if (days.length > 0) {
        for (var i = 0; i < days.length; i++) {
            var day = days[i];
            html += '<div class="card mb-2">';
            html += '<div class="card-body py-2">';
            html += '<div class="fw-bold text-primary">' + escapeHtml(day.quotation_properties_days_day || ('Day ' + (i+1))) + ': ' + escapeHtml(day.state_name || '-') + ' (' + fmtDate(day.accommodation_date) + ')</div>';
            html += '<div class="text-danger fw-bold">' + escapeHtml(day.properties_name || '-') + '</div>';
            if (day.properties_sales_contact_phone_number || day.properties_reservation_contact_phone_number) {
                var contact = day.properties_sales_contact_phone_number || day.properties_reservation_contact_phone_number;
                html += '<div class="small text-muted">Contact: ' + escapeHtml(contact) + '</div>';
            }
            if (day.quotation_itineraries_days_description) {
                html += '<div class="small mt-1">' + day.quotation_itineraries_days_description + '</div>';
            }
            html += '</div></div>';
        }
    } else {
        html += '<p class="text-muted">No itinerary data available.</p>';
    }

    $('#guestDetailsContent').html(html);
}

function escapeHtml(str) {
    if (!str) return '';
    return String(str).replace(/&/g, '&amp;').replace(/</g, '&lt;').replace(/>/g, '&gt;').replace(/"/g, '&quot;');
}

function copyGuestDetails() {
    if (!_guestDetailsCache) {
        var n = new notify({ title: '', style: 'error', message: 'No data to copy.', icon: 'fas fa-times' });
        n.show(); setTimeout(function(){ n.hide(); }, 3000);
        return;
    }

    var d = _guestDetailsCache;
    var m = d.main;
    var gc = d.guest_count || [];
    var days = d.days || [];

    var totalAdults = 0, totalChildren = 0, totalGuests = 0;
    for (var i = 0; i < gc.length; i++) {
        totalAdults += parseInt(gc[i].adults || 0);
        totalChildren += parseInt(gc[i].children || 0);
        totalGuests += parseInt(gc[i].total_count || 0);
    }

    var text = '';
    text += 'Guest Name: ' + (m.guest_name || '-') + '\n';
    text += 'Quotation No: ' + (m.quotation_number || '-') + '\n';
    text += 'Phone (WhatsApp): ' + (m.whats_number || '-') + '\n';
    text += 'Alternative Number: ' + (m.alternative_number || '-') + '\n';
    text += 'Travel Date: ' + fmtDate(m.start_date) + '\n';
    text += 'Tour Duration: ' + (m.duration || 0) + ' Nights\n';
    text += 'Travel End Date: ' + fmtDate(m.end_date) + '\n';
    text += 'Arrival: ' + (m.arriving_destination || '-') + '\n';
    text += 'Departure: ' + (m.departuring_destination || '-') + '\n';
    text += '\n--- Guest Count ---\n';
    if (gc.length > 0) {
        var childAgesCopy = [];
        for (var i = 0; i < gc.length; i++) {
            if (gc[i].child_ages) {
                for (var j = 0; j < gc[i].child_ages.length; j++) {
                    if (parseInt(gc[i].child_ages[j].count) > 0) {
                        childAgesCopy.push(gc[i].child_ages[j].age + ' yrs (' + gc[i].child_ages[j].count + ')');
                    }
                }
            }
        }
        var childAgeStrCopy = childAgesCopy.length > 0 ? childAgesCopy.join(', ') : '0';
        text += 'Total Guest Count ' + totalGuests + ': ' + totalAdults + ' Adults, ' + totalChildren + ' Children (' + childAgeStrCopy + ')\n';
    } else {
        text += 'No guest count data.\n';
    }
    text += '\n--- Itinerary ---\n';
    if (days.length > 0) {
        for (var i = 0; i < days.length; i++) {
            var day = days[i];
            text += (day.quotation_properties_days_day || ('Day ' + (i+1))) + ': ' + (day.state_name || '-') + ' (' + fmtDate(day.accommodation_date) + ')\n';
            text += '  Hotel: ' + (day.properties_name || '-') + '\n';
            if (day.properties_sales_contact_phone_number || day.properties_reservation_contact_phone_number) {
                text += '  Contact: ' + (day.properties_sales_contact_phone_number || day.properties_reservation_contact_phone_number) + '\n';
            }
            if (day.quotation_itineraries_days_description) {
                text += '  ' + day.quotation_itineraries_days_description.replace(/<[^>]*>/g, '') + '\n';
            }
            text += '\n';
        }
    } else {
        text += 'No itinerary data.\n';
    }

    navigator.clipboard.writeText(text).then(function() {
        var n = new notify({ title: '', style: 'success', message: 'Guest details copied to clipboard.', icon: 'fas fa-check' });
        n.show(); setTimeout(function(){ n.hide(); }, 3000);
    }, function() {
        var n = new notify({ title: '', style: 'error', message: 'Failed to copy. Please try again.', icon: 'fas fa-times' });
        n.show(); setTimeout(function(){ n.hide(); }, 3000);
    });
}
</script>
