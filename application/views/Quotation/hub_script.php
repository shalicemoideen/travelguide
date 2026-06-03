<script>
document.addEventListener('DOMContentLoaded', function () {

    // alert('hub ready');

    var quotation_id = document.getElementById('quotation_id')
        ? document.getElementById('quotation_id').value
        : 0;

    if (quotation_id && quotation_id != 0) {
        loadQuotationHubSummary(quotation_id);
    }
});

function loadQuotationHubSummary(quotation_id)
{
    console.log('AJAX called with quotation_id:', quotation_id);

    $.ajax({
        url: "<?php echo base_url(); ?>index.php/Quotation/ajax_get_quotation_hub_summary",
        type: "POST",
        dataType: "json",
        data: {
            quotation_id: quotation_id
        },
        success: function(res) {

            console.log('AJAX response:', res);

            if (!res.status) {
                console.log('No data:', res.message);
                return;
            }

            var data = res.data;

            $('#hubQuotationNumber').text(data.quotation_number || '-');
            $('#hubGuestName').text(data.guest_name || '-');
            $('#hubLeadNumber').text(data.leads_number || '-');
            $('#hubLeadType').text(data.lead_type || '-');
            $('#hubStartDate').text(data.start_date || '-');
            $('#hubDuration').text(data.duration ? data.duration + ' Days' : '-');
            $('#hubEndDate').text(data.end_date || '-');

            var statusHtml = '-';

            if (data.quotation_current_status == 1) statusHtml = '<span class="badge badge-secondary">Generated</span>';
            else if (data.quotation_current_status == 2) statusHtml = '<span class="badge badge-light">Draft</span>';
            else if (data.quotation_current_status == 3) statusHtml = '<span class="badge badge-info">Sent</span>';
            else if (data.quotation_current_status == 4) statusHtml = '<span class="badge badge-danger">Rejected</span>';
            else if (data.quotation_current_status == 5) statusHtml = '<span class="badge badge-success">Accepted</span>';
            else if (data.quotation_current_status == 6) statusHtml = '<span class="badge badge-danger">Cancelled</span>';

            $('#hubQuotationStatus').html(statusHtml);
        },
        error: function(xhr) {
            console.log('AJAX error:', xhr.responseText);
        }
    });
}

$(document).ready(function () {

    var quotation_id = $('#quotation_id').val();

    if (quotation_id && quotation_id != 0) {

        loadQuotationHubSummary(quotation_id);

        loadHubLeadDetails(quotation_id);

        loadHubAccommodationDetails(quotation_id);
    }
});

function loadHubLeadDetails(quotation_id)
{
    $.ajax({
        url: "<?php echo base_url('index.php/Quotation/ajax_get_hub_lead_details/'); ?>" + quotation_id,
        type: "GET",
        dataType: "JSON",

        // success: function(response)
        // {
        //     if (!response.status) {

        //         $('#quotationLeadDetailsSection').html(`
        //             <div class="alert alert-warning mb-0">
        //                 Lead details not found.
        //             </div>
        //         `);

        //         return;
        //     }

        //     var d = response.data;

        //     var html = '';

        //     html += buildLeadTopSection(d);

        //     if ((d.lead_type || '').trim() === 'B2C') {
        //         html += buildB2CLayout(d);
        //     }
        //     else if ((d.lead_type || '').trim() === 'Meta Lead') {
        //         html += buildMetaLayout(d);
        //     }
        //     else if ((d.lead_type || '').trim() === 'B2B') {
        //         html += buildB2BLayout(d);
        //     }
        //     else {
        //         html += buildFallbackLayout(d);
        //     }

        //     $('#quotationLeadDetailsSection').html(html);
        // },

        success: function(response)
{
    if (!response.status) {
        $('#quotationLeadDetailsSection').html(`
            <div class="alert alert-warning mb-0">Lead details not found.</div>
        `);
        return;
    }

    var d = response.data;
    $('#quotationLeadDetailsSection').html(buildHubImportantLeadDetails(d));
},

        error: function()
        {
            $('#quotationLeadDetailsSection').html(`
                <div class="alert alert-danger mb-0">
                    Failed to load lead details.
                </div>
            `);
        }
    });
}

function buildHubImportantLeadDetails(d)
{
    return `
        <div class="card border-0 shadow-sm mb-4">
            <div class="card-header bg-white">
                <h5 class="mb-0 fw-bold">Lead Details</h5>
            </div>

            <div class="card-body">
                <div class="row g-3">

                    <div class="col-xl-3 col-lg-6 col-md-6">
                        ${buildHubInfoSection('Lead Overview', [
                            ['Lead Status', getStatusChipHtml(d.lead_current_status)],
                            ['Guest Name', d.guest_name],
                            ['Lead No', d.leads_number],
                            ['Lead Type', d.lead_type]
                        ])}
                    </div>

                    <div class="col-xl-3 col-lg-6 col-md-6">
                        ${buildHubInfoSection('Contact Details', [
                            ['WhatsApp Number', d.whats_number],
                            ['Assigned Staff', d.staff_name]
                        ])}
                    </div>

                    <div class="col-xl-3 col-lg-6 col-md-6">
                        ${buildHubInfoSection('Travel Details', [
                            ['Register Date', formatDate(d.lead_register_date)],
                            ['Travel Start Date', formatDate(d.start_date)],
                            ['Duration', d.duration ? d.duration + ' Days' : '-'],
                            ['End Date', formatDate(d.end_date)]
                        ])}
                    </div>

                    <div class="col-xl-3 col-lg-6 col-md-6">
                        ${buildHubInfoSection('Created Details', [
                            ['Created Date', formatDate(d.leads_created_date)],
                            ['Created Time', d.leads_created_time],
                            ['Created By User', d.leads_createdby_username]
                        ])}
                    </div>

                </div>
            </div>
        </div>
    `;
}

function buildHubInfoSection(title, rows)
{
    var html = '';

    rows.forEach(function(row) {
        var label = row[0];
        var value = row[1];

        if (value === null || value === undefined || value === '') {
            value = '-';
        }

        html += `
            <div class="hub-info-row">
                <div class="hub-info-label">${escapeHtml(label)}</div>
                <div class="hub-info-value">${String(value).includes('<span') ? value : escapeHtml(value)}</div>
            </div>
        `;
    });

    return `
        <div class="hub-info-section h-100">
            <div class="hub-info-title">${escapeHtml(title)}</div>
            ${html}
        </div>
    `;
}

function loadHubAccommodationDetails(quotation_id)
{
    $.ajax({
        url: "<?php echo base_url('index.php/Quotation/ajax_guest_accommodation_details/'); ?>" + quotation_id,
        type: "GET",
        dataType: "JSON",

        success: function(response)
        {
            if (!response.status || !response.data || response.data.length === 0) {

                $('#quotationAccommodationSection').html(`
                    <div class="alert alert-warning mb-0">
                        No accommodation details found.
                    </div>
                `);

                return;
            }

            var html = `
                <div class="card border-0 shadow-sm">
                    <div class="card-header bg-white">
                        <h5 class="mb-0 fw-bold">Guest & Accommodation Details</h5>
                    </div>

                    <div class="card-body">

                        <div class="table-responsive">

                            <table class="table table-bordered align-middle">
                                <thead class="table-light">
                                    <tr>
                                        <th>Day</th>
                                        <th>Date</th>
                                        <th>Destination</th>
                                        <th>Adults</th>
                                        <th>Children</th>
                                        <th>Total</th>
                                        <th>Child Age</th>
                                        <th>Meal Plan</th>
                                    </tr>
                                </thead>

                                <tbody>
            `;

            $.each(response.data, function(i, row) {

                html += `
                    <tr>

                        <td>
                            <strong>${escapeHtml(row.day_name || row.day_label || '-')}</strong>

                            ${row.travel_back_flag === 'TB'
                                ? `<div class="mt-1">
                                        <span class="badge bg-info">
                                            Travel Back
                                        </span>
                                   </div>`
                                : ''
                            }
                        </td>

                        <td>${formatDate(row.accommodation_date)}</td>

                        <td>${escapeHtml(row.state_name || '-')}</td>

                        <td>${escapeHtml(row.adults || '0')}</td>

                        <td>${escapeHtml(row.children || '0')}</td>

                        <td>
                            <strong>${escapeHtml(row.total_count || '0')}</strong>
                        </td>

                        <td>${escapeHtml(row.child_age_breakup || '-')}</td>

                        <td>${escapeHtml(row.meal_plan_name || '-')}</td>

                    </tr>
                `;
            });

            html += `
                                </tbody>
                            </table>

                        </div>
                    </div>
                </div>
            `;

            $('#quotationAccommodationSection').html(html);
        },

        error: function()
        {
            $('#quotationAccommodationSection').html(`
                <div class="alert alert-danger mb-0">
                    Failed to load accommodation details.
                </div>
            `);
        }
    });
}

function getAccommodationRequiredBadge(value)
{
    if (value === 'R') {
        return '<span class="badge bg-success">Required</span>';
    }

    if (value === 'N') {
        return '<span class="badge bg-secondary">Not Required</span>';
    }

    // if (value === 'T') {
    //     return '<span class="badge bg-info">Travel Back Required</span>';
    // }

    return '<span class="badge bg-light text-dark">-</span>';
}



function normalizeValue(value)
{
    if (value === null || value === undefined || value === '') {
        return '-';
    }
    return value;
}


function formatDate(dateStr)
{
    if (!dateStr || dateStr === '0000-00-00') return '-';

    var parts = dateStr.split('-');
    if (parts.length !== 3) return dateStr;

    return parts[2] + '/' + parts[1] + '/' + parts[0];
}

function getAccommodationStatusText(val)
{
    return parseInt(val, 10) === 1 ? 'Completed' : 'Pending';
}

function getLeadCurrentStatusText(val)
{
    val = parseInt(val, 10);

    if (val === 1) return 'In take';
    if (val === 2) return 'Qualified';
    if (val === 3) return 'Converted to trip';
    if (val === 4) return 'Not Qualified';
    if (val === 5) return 'Lost';

    return '-';
}

function getStatusChipHtml(statusValue)
{
    var text = getLeadCurrentStatusText(statusValue);
    var cls = 'status-intake';

    if (text === 'Qualified') cls = 'status-qualified';
    else if (text === 'Converted to trip') cls = 'status-converted';
    else if (text === 'Not Qualified') cls = 'status-notqualified';
    else if (text === 'Lost') cls = 'status-lost';

    return `<span class="status-chip ${cls}">${escapeHtml(text)}</span>`;
}

function escapeHtml(str)
{
    if (str === null || str === undefined) return '';
    return String(str)
        .replace(/&/g, '&amp;')
        .replace(/</g, '&lt;')
        .replace(/>/g, '&gt;')
        .replace(/"/g, '&quot;')
        .replace(/'/g, '&#039;');
}

function cleanButtonHtml(html)
{
    if (!html) return '-';

    return html
        .replace(/<center>/gi, '')
        .replace(/<\/center>/gi, '')
        .trim();
}


///////****** client confirmation ***//////////

$('a[href="#clientConfirmationTab"]').on('shown.bs.tab', function () {
    var quotation_id = $('#quotation_id').val();
    loadConfirmationOptions(quotation_id);
});

function loadConfirmationOptions(quotation_id)
{
    $.ajax({
        url: "<?php echo base_url(); ?>index.php/Quotation/ajax_get_confirmation_options",
        type: "POST",
        dataType: "json",
        data: { quotation_id: quotation_id },
        success: function(res) {
            var html = '<option value="">Select Option</option>';

            if (res.status && res.data) {
                $.each(res.data, function(i, row) {
                    html += '<option value="' + row.quotation_options_id + '">' +
                        escapeHtml(row.quotation_options_title || 'Option ' + (i + 1)) +
                    '</option>';
                });
            }

            $('#confirmationOptionSelect').html(html);

            if ($.fn.select2) {
                if ($('#confirmationOptionSelect').hasClass('select2-hidden-accessible')) {
                    $('#confirmationOptionSelect').select2('destroy');
                }

                $('#confirmationOptionSelect').select2({
                    width: '100%',
                    placeholder: 'Select Option'
                });
            }
        }
    });
}

$(document).on('change', '#confirmationOptionSelect', function () {
    var quotation_id = $('#quotation_id').val();
    var quotation_options_id = $(this).val();

    if (!quotation_options_id) {
        $('#confirmationOptionDetails').html(`
            <div class="alert alert-info mb-0">Please select an option to view details.</div>
        `);
        return;
    }

    loadConfirmationOptionDetails(quotation_id, quotation_options_id);
});

function loadConfirmationOptionDetails(quotation_id, quotation_options_id)
{
    $('#confirmationOptionDetails').html(`
        <div class="text-center py-4">
            <div class="spinner-border text-primary"></div>
            <p class="mt-2 mb-0">Loading option details...</p>
        </div>
    `);

    $.ajax({
        url: "<?php echo base_url(); ?>index.php/Quotation/ajax_get_confirmation_option_details",
        type: "POST",
        dataType: "json",
        data: {
            quotation_id: quotation_id,
            quotation_options_id: quotation_options_id
        },
        success: function(res) {
            if (!res.status || !res.data.length) {
                $('#confirmationOptionDetails').html(`
                    <div class="alert alert-warning mb-0">No details found.</div>
                `);
                return;
            }

            $('#confirmationOptionDetails').html(buildConfirmationDetailsTable(res.data));
        }
    });
}

function buildConfirmationDetailsTable(days)
{
    var html = `
        <div class="table-responsive">
            <table class="table table-bordered align-middle">
                <thead class="table-light">
                    <tr>
                        <th style="width:5%">Select</th>
                        <th>Day</th>
                        <th>Destination</th>
                        <th>Property</th>
                        <th>Room</th>
                    </tr>
                </thead>
                <tbody>
    `;

    $.each(days, function(i, day) {
        if (day.properties && day.properties.length) {
            $.each(day.properties, function(j, property) {
                if (property.rooms && property.rooms.length) {
                    $.each(property.rooms, function(k, room) {
                        html += `
                            <tr>
                                <td class="text-center">
                                    <input type="checkbox"
                                           class="form-check-input confirmationRoomCheck"
                                           value="${room.quotation_properties_rooms_id}">
                                </td>
                                <td>${escapeHtml(day.quotation_properties_days_day || '-')}</td>
                                <td>${escapeHtml(day.state_name || '-')}</td>
                                <td>${escapeHtml(property.properties_name || '-')}</td>
                                <td>${escapeHtml(room.properties_room_category_name || '-')}</td>
                            </tr>
                        `;
                    });
                }
            });
        }
    });

    html += `
                </tbody>
            </table>
        </div>
    `;

    return html;
}
</script>