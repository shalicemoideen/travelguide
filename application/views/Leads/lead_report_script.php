<script type="text/javascript">



////***Select2 AJAX dropdowns *****///
function initFilterSelect2Ajax(id, url, placeholder) {
    $('#' + id).select2({
        width: '100%',
        placeholder: placeholder,
        allowClear: true,
        minimumInputLength: 0,
        ajax: {
            url: '<?php echo base_url(); ?>index.php/' + url,
            type: 'GET',
            dataType: 'json',
            delay: 250,
            data: function (params) { return { q: params.term || '' }; },
            processResults: function (data) { return { results: data.results }; },
            cache: false
        }
    });
}

function initFilterSelect2Static(id, placeholder) {
    $('#' + id).select2({ width: '100%', placeholder: placeholder, allowClear: true });
}

// auto focus search input for all select2
$(document).on('select2:open', function () {
    setTimeout(function () {
        let searchField = document.querySelector('.select2-container--open .select2-search__field');
        if (searchField) {
            searchField.focus();
        }
    }, 50);
});

////***Date Range Picker *****///
$('#leads_report_daterange').daterangepicker({
    autoUpdateInput: false,
    locale: {
        format: 'DD/MM/YYYY',
        cancelLabel: 'Clear'
    }
});

$('#leads_report_daterange').on('apply.daterangepicker', function(ev, picker) {
    $(this).val(
        picker.startDate.format('DD/MM/YYYY') + ' - ' + picker.endDate.format('DD/MM/YYYY')
    );
});

$('#leads_report_daterange').on('cancel.daterangepicker', function() {
    $(this).val('');
});

////***Travel Date Range Picker *****///
$('#leads_report_travel_daterange').daterangepicker({
    autoUpdateInput: false,
    locale: {
        format: 'DD/MM/YYYY',
        cancelLabel: 'Clear'
    }
});

$('#leads_report_travel_daterange').on('apply.daterangepicker', function(ev, picker) {
    $(this).val(
        picker.startDate.format('DD/MM/YYYY') + ' - ' + picker.endDate.format('DD/MM/YYYY')
    );
});

$('#leads_report_travel_daterange').on('cancel.daterangepicker', function() {
    $(this).val('');
});



var statusLabels = {

    1: '<span class="badge bg-info text-white">In take</span>',

    2: '<span class="badge bg-warning text-dark">Qualified</span>',

    3: '<span class="badge bg-success text-white">Converted to trip</span>',

    4: '<span class="badge bg-danger text-white">Not Qualified</span>',

    5: '<span class="badge bg-secondary text-white">Lost</span>'

};



var statusLabelsExport = {

    1: 'In take', 2: 'Qualified', 3: 'Converted to trip', 4: 'Not Qualified', 5: 'Lost'

};



function getUrlParam(name) {

    var results = new RegExp('[?&]' + name + '=([^&#]*)').exec(window.location.href);

    return results ? decodeURIComponent(results[1]) : null;

}



function fmtDate(d) {

    var dd   = String(d.getDate()).padStart(2, '0');

    var mm   = String(d.getMonth() + 1).padStart(2, '0');

    var yyyy = d.getFullYear();

    return dd + '/' + mm + '/' + yyyy;

}



function getPeriodDates(period) {

    if (period === 'custom') {

        var startParam = getUrlParam('start');

        var endParam   = getUrlParam('end');

        if (startParam && endParam) {

            var s = startParam.split('-');

            var e = endParam.split('-');

            return { start: s[2] + '/' + s[1] + '/' + s[0], end: e[2] + '/' + e[1] + '/' + e[0] };

        }

    }

    var now   = new Date();

    var start = new Date(now);

    var end   = new Date(now);

    if (period === 'week') {

        var dow = now.getDay();

        start   = new Date(now); start.setDate(now.getDate() - dow);

        end     = new Date(now); end.setDate(now.getDate() + (6 - dow));

    } else if (period === 'month') {

        start = new Date(now.getFullYear(), now.getMonth(), 1);

        end   = new Date(now.getFullYear(), now.getMonth() + 1, 0);

    } else if (period === 'year') {

        start = new Date(now.getFullYear(), 0, 1);

        end   = new Date(now.getFullYear(), 11, 31);

    }

    return { start: fmtDate(start), end: fmtDate(end) };

}



$(document).ready(function () {

    $("#btn").click(function () {
        $("#Create").toggle();
        if ($("#Create").is(":visible")) {
            initFilterSelect2Ajax('staff_id', 'Leads/get_staff_dropdown', 'Select assigned staff');
            initFilterSelect2Static('lead_status', 'Select lead status');
        }
    });



    var period = getUrlParam('period');

    if (period && period !== '') {

        var dates = getPeriodDates(period);

        $('#leads_report_daterange').val(dates.start + ' - ' + dates.end);

        $('#Create').show();

        initFilterSelect2Ajax('staff_id', 'Leads/get_staff_dropdown', 'Select assigned staff');
        initFilterSelect2Static('lead_status', 'Select lead status');

    }

});



$('#search').click(function () {

    $table.ajax.reload();

});



$('#reset').click(function () {

    $('#guest_name').val('');

    $('#staff_id').val(null).trigger('change');

    $('#lead_status').val(null).trigger('change');

    $('#leads_report_daterange').val('');

    $('#leads_report_travel_daterange').val('');

    $table.ajax.reload();

});



var $table;

$(document).ready(function () {

    $table = $('#LeadReport').DataTable({

        "processing": true,

        "serverSide": true,

        "searching": false,

        "aLengthMenu": [[10, 25, 50, -1], [10, 25, 50, "All"]],

        dom: 'lBfrtip',

        buttons: [

            {

                extend: 'excel',

                exportOptions: { columns: [0, 1, 2, 3, 4, 5, 6, 7], orthogonal: 'export' },

                footer: true

            },

            {

                extend: 'pdf',

                exportOptions: { columns: [0, 1, 2, 3, 4, 5, 6, 7], orthogonal: 'export' },

                footer: true

            },

            {

                extend: 'print',

                exportOptions: { columns: [0, 1, 2, 3, 4, 5, 6, 7], orthogonal: 'export' },

                footer: true

            }

        ],

        "ajax": {

            "url": "<?php echo base_url(); ?>index.php/Leads/ajax_lead_report",

            "type": "POST",

            "data": function (d) {

                d.guest_name  = $("#guest_name").val();

                d.staff_id    = $("#staff_id").val();

                d.lead_status = $("#lead_status").val();

                var reportRange = $("#leads_report_daterange").val();

                if (reportRange) {

                    var reportDates = reportRange.split(' - ');

                    d.start_date = reportDates[0];

                    d.end_date   = reportDates[1];

                } else {

                    d.start_date = '';

                    d.end_date   = '';

                }

                var travelRange = $("#leads_report_travel_daterange").val();

                if (travelRange) {

                    var travelDates = travelRange.split(' - ');

                    d.travel_start_date = travelDates[0];

                    d.travel_end_date   = travelDates[1];

                } else {

                    d.travel_start_date = '';

                    d.travel_end_date   = '';

                }

            }

        },

        "createdRow": function (row, data, index) {

            var leadNumberCell = $('td', row).eq(1);

            leadNumberCell.html('<a class="leads-number-link" href="javascript:void(0)" onclick="view_lead_details(' + data['leads_id'] + ')">' + data['leads_number'] + '</a>');

            var guestCell  = $('td', row).eq(3);

            var guestName  = data['guest_name'] || '';

            var adults    = parseInt(data['total_adults']   || 0);

            var children  = parseInt(data['total_children'] || 0);

            var guestHtml = '<div>' + guestName + '</div>';

            if (adults > 0 || children > 0) {

                guestHtml += '<div class="mt-1" style="font-size:11px;">';

                if (adults   > 0) guestHtml += '<span class="badge bg-primary me-1">Adults: '   + adults   + '</span>';

                if (children > 0) guestHtml += '<span class="badge bg-warning text-dark">Kids: ' + children + '</span>';

                guestHtml += '</div>';

            }

            guestCell.html(guestHtml);



            var statusCell = $('td', row).eq(7);

            var statusCode = parseInt(data['lead_current_status']);

            statusCell.html(statusLabels[statusCode] || statusCode);

        },

        "drawCallback": function (settings) {

            var api = this.api();

            api.column(0).nodes().each(function (node, i) {

                var pageInfo = api.page.info();

                $(node).html(pageInfo.start + i + 1);

            });

            var info = api.page.info();

            var total    = info.recordsTotal;

            var filtered = info.recordsDisplay;

            var label = 'Total Leads: <strong>' + total + '</strong>';

            if (filtered !== total) {

                label += ' &nbsp;|&nbsp; Filtered: <strong>' + filtered + '</strong>';

            }

            $('#lead-total-count').html(label);

            $(api.table().footer()).find('th:last').html(label);

        },

        "columns": [

            { "data": "leads_id",           "orderable": false },

            { "data": "leads_number",        "orderable": false },

            { "data": "staff_name",          "orderable": false },

            { "data": "guest_name",          "orderable": false },

            { "data": "destination",         "orderable": false },

            { "data": "lead_created_date",    "orderable": false },

            { "data": "travel_date", "orderable": false, "render": function(data, type, row) {

                var dur = parseInt(row.duration, 10);

                var durStr = '-';

                if (!isNaN(dur) && dur > 0) {

                    var nights = dur;

                    var days = dur + 1;

                    durStr = nights + 'N ' + days + 'D';

                }

                if (type === 'export') {

                    return (data || '-') + ' | ' + (row.travel_end_date || '-') + ' | ' + durStr;

                }

                return '<div style="line-height:1.6">' +

                    '<div><span style="color:#36b9cc;font-weight:600;font-size:13px">' + (data || '-') + '</span></div>' +

                    '<div><span style="color:#e74a3b;font-weight:600;font-size:13px">' + (row.travel_end_date || '-') + '</span></div>' +

                    '<div><span class="badge badge-success" style="font-size:11px">' + durStr + '</span></div>' +

                    '</div>';

            }},

            { "data": "lead_current_status", "orderable": false, "render": function(data, type, row) {

                if (type === 'export') {

                    var code = parseInt(data);

                    return statusLabelsExport[code] || data;

                }

                return data;

            }}

        ]

    });



    if (getUrlParam('period')) {

        $table.ajax.reload();

    }

});

////***For Leads view *****///

function view_lead_details(id)
{
    $('#leadViewBody').html(`
        <div class="text-center py-5">
            <div class="spinner-border text-primary"></div>
            <p class="mt-2 mb-0">Loading lead details...</p>
        </div>
    `);

    $('#guestAccommodationBody').html(`
        <div class="text-center py-5">
            <div class="spinner-border text-primary"></div>
            <p class="mt-2 mb-0">Loading guest and accommodation details...</p>
        </div>
    `);

    $('#leadViewTabs button[data-bs-target="#leadDetailsTab"]').tab('show');
    $('#LeadsviewModal').modal('show');

    $.ajax({
        url: "<?php echo base_url('index.php/Leads/ajax_view_lead_details/'); ?>" + id,
        type: "GET",
        dataType: "JSON",
        success: function(response)
        {
            if (!response.status) {
                $('#leadViewBody').html(`
                    <div class="alert alert-danger mb-0">${response.message || 'Lead details not found.'}</div>
                `);
                return;
            }

            var d = response.data;
            var leadType = (d.lead_type || '').trim();
            var html = '';

            html += buildLeadTopSection(d);

            if (leadType === 'B2C') {
                html += buildB2CLayout(d);
            } else if (leadType === 'Meta Lead') {
                html += buildMetaLayout(d);
            } else if (leadType === 'B2B') {
                html += buildB2BLayout(d);
            } else {
                html += buildFallbackLayout(d);
            }

            $('#leadViewBody').html(html);
        },
        error: function()
        {
            $('#leadViewBody').html(`
                <div class="alert alert-danger mb-0">Failed to load lead details.</div>
            `);
        }
    });

    load_guest_accommodation_details(id);
}

function load_guest_accommodation_details(lead_id)
{
    $.ajax({
        url: "<?php echo base_url('index.php/Leads/ajax_guest_accommodation_details/'); ?>" + lead_id,
        type: "GET",
        dataType: "JSON",
        success: function(response)
        {
            if (!response.status || !response.data || response.data.length === 0) {
                $('#guestAccommodationBody').html(`
                    <div class="alert alert-warning mb-0">
                        No guest count or accommodation details found.
                    </div>
                `);
                return;
            }

            var html = `
                <div class="table-responsive">
                    <table class="table table-bordered table-hover align-middle lead-accommodation-table">
                        <thead class="table-light">
                            <tr>
                                <th>Day</th>
                                <th>Date</th>
                                <th>Accommodation Type</th>
                                <th>Destination</th>
                                <th>Adults</th>
                                <th>Child</th>
                                <th>Total</th>
                                <th>Child Age Breakup</th>
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
                            ${row.travel_back_flag === 'TB' ? `
                                <div class="mt-1">
                                    <span class="badge bg-info">Travel Back</span>
                                </div>
                            ` : ''}
                            <div class="text-muted small">${escapeHtml(row.accommodation_day_name || '')}</div>
                        </td>
                        <td>${formatDate(row.accommodation_date)}</td>
                        <td>${getAccommodationRequiredBadge(row.accomodation_required_staus)}</td>
                        <td>${escapeHtml(row.state_name || '-')}</td>
                        <td>${escapeHtml(row.adults || '0')}</td>
                        <td>${escapeHtml(row.children || '0')}</td>
                        <td><strong>${escapeHtml(row.total_count || '0')}</strong></td>
                        <td>${escapeHtml(row.child_age_breakup || '-')}</td>
                        <td>${escapeHtml(row.meal_plan_name || '-')}</td>
                    </tr>
                `;
            });

            html += `
                        </tbody>
                    </table>
                </div>
            `;

            $('#guestAccommodationBody').html(html);
        },
        error: function()
        {
            $('#guestAccommodationBody').html(`
                <div class="alert alert-danger mb-0">
                    Failed to load guest count and accommodation details.
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
    return '<span class="badge bg-light text-dark">-</span>';
}

function buildLeadTopSection(d)
{
    return `
        <div class="lead-summary-box">
            <div class="row align-items-center g-3">
                <div class="col-md-8">
                    <div class="lead-summary-title">${escapeHtml(d.guest_name || d.agent_name || '-')}</div>
                    <div class="lead-summary-sub">Lead No: <strong>${escapeHtml(d.leads_number || '-')}</strong></div>
                    <div class="mini-info-row">
                        <div class="mini-pill"><strong>Stage:</strong> ${cleanButtonHtml(d.stages_button)}</div>
                        <div class="mini-pill"><strong>Priority:</strong> ${cleanButtonHtml(d.priority_status_button)}</div>
                        <div class="mini-pill"><strong>Created:</strong> ${formatDateTime(d.leads_created_at)}</div>
                        <div class="mini-pill"><strong>Assigned Staff:</strong> ${escapeHtml(d.staff_name || '-')}</div>
                    </div>
                </div>
                <div class="col-md-4">
                    <div class="lead-top-badges">
                        ${getStatusChipHtml(d.lead_current_status)}
                        <span class="lead-type-badge">${escapeHtml(d.lead_type || '-')}</span>
                    </div>
                </div>
            </div>
        </div>
    `;
}

function buildB2CLayout(d)
{
    return `
        <div class="row g-3">
            <div class="col-md-6">
                ${buildLeadCard('Guest Information', [
                    ['Guest Name', d.guest_name],
                    ['Email', d.leads_email],
                    ['WhatsApp', d.whats_number],
                    ['Alternative Number', d.alternative_number],
                    ['Address', d.leads_address],
                    ['Lead Type', d.lead_type]
                ])}
            </div>
            <div class="col-md-6">
                ${buildLeadCard('Assignment & Source', [
                    ['Status', getStatusChipHtml(d.lead_current_status)],
                    ['Assigned Staff', d.staff_name],
                    ['Source', d.source_name],
                    ['Template', d.packages_title],
                    ['Country', d.country_name],
                ])}
            </div>
            <div class="col-md-6">
                ${buildLeadCard('Travel Information', [
                    ['Register Date', formatDate(d.lead_register_date)],
                    ['Date Type', d.date_type],
                    ['Travel Start Date', formatDate(d.start_date)],
                    ['End Date', formatDate(d.end_date)],
                    ['Duration', formatDuration(d.duration)],
                    ['Accommodation Status', getAccommodationStatusText(d.leads_accomodation_status,d.leads_quotation_status)]
                ])}
            </div>
            <div class="col-md-6">
                ${buildLeadCard('Created Information', [
                    ['Created Date', formatDateTime(d.leads_created_at)],
                    ['Created By User', d.created_by_admin_name],
                    ['Updated Date', formatDateTime(d.leads_updated_at)],
                    ['Updated By', d.updated_by_admin_name]
                ])}
            </div>
            <div class="col-md-12">
                ${buildDescriptionSection(d.description)}
            </div>
        </div>
    `;
}

function buildMetaLayout(d)
{
    return `
        <div class="row g-3">
            <div class="col-md-6">
                ${buildLeadCard('Guest Information', [
                    ['Guest Name', d.guest_name],
                    ['Email', d.leads_email],
                    ['WhatsApp', d.whats_number],
                    ['Alternative Number', d.alternative_number],
                    ['Address', d.leads_address],
                    ['Lead Type', d.lead_type]
                ])}
            </div>
            <div class="col-md-6">
                ${buildLeadCard('Assignment & Ads Information', [
                    ['Status', getStatusChipHtml(d.lead_current_status)],
                    ['Assigned Staff', d.staff_name],
                    ['Ads Name', d.meta_ads_setting_name],
                    ['Source', d.source_name],
                    ['Template', d.packages_title],
                    ['Country', d.country_name],
                ])}
            </div>
            <div class="col-md-6">
                ${buildLeadCard('Travel Information', [
                    ['Register Date', formatDate(d.lead_register_date)],
                    ['Date Type', d.date_type],
                    ['Travel Start Date', formatDate(d.start_date)],
                    ['End Date', formatDate(d.end_date)],
                    ['Duration', formatDuration(d.duration)],
                    ['Accommodation Status', getAccommodationStatusText(d.leads_accomodation_status,d.leads_quotation_status)]
                ])}
            </div>
            <div class="col-md-6">
                ${buildLeadCard('Created Information', [
                    ['Created Date', formatDateTime(d.leads_created_at)],
                    ['Created By User', d.created_by_admin_name],
                    ['Updated Date', formatDateTime(d.leads_updated_at)],
                    ['Updated By', d.updated_by_admin_name]
                ])}
            </div>
            <div class="col-md-12">
                ${buildDescriptionSection(d.description)}
            </div>
        </div>
    `;
}

function buildB2BLayout(d)
{
    return `
        <div class="row g-3">
            <div class="col-md-6">
                ${buildLeadCard('B2B Information', [
                    ['Agent Name', d.agent_name],
                    ['Status', getStatusChipHtml(d.lead_current_status)],
                    ['Stage', d.stages_name]
                ])}
            </div>
            <div class="col-md-6">
                ${buildLeadCard('Financial Details', [
                    ['Total Package Cost', d.total_package_cost],
                    ['Expense', d.expense],
                    ['Margin', d.margin]
                ])}
            </div>
            <div class="col-md-6">
                ${buildLeadCard('Created Information', [
                    ['Created Date', formatDateTime(d.leads_created_at)],
                    ['Created By User', d.created_by_admin_name],
                    ['Updated Date', formatDateTime(d.leads_updated_at)],
                    ['Updated By', d.updated_by_admin_name]
                ])}
            </div>
            <div class="col-md-12">
                ${buildDescriptionSection(d.description)}
            </div>
        </div>
    `;
}

function buildFallbackLayout(d)
{
    return `
        <div class="row g-3">
            <div class="col-md-6">
                ${buildLeadCard('Lead Information', [
                    ['Guest Name', d.guest_name],
                    ['Lead No', d.leads_number],
                    ['Lead Type', d.lead_type],
                    ['Status', getStatusChipHtml(d.lead_current_status)],
                    ['Stage', cleanButtonHtml(d.stages_button)],
                    ['Priority', cleanButtonHtml(d.priority_status_button)],
                ])}
            </div>
            <div class="col-md-6">
                ${buildLeadCard('Created Information', [
                    ['Created Date', formatDateTime(d.leads_created_at)],
                    ['Created By User', d.created_by_admin_name],
                    ['Updated Date', formatDateTime(d.leads_updated_at)],
                    ['Updated By', d.updated_by_admin_name]
                ])}
            </div>
            <div class="col-md-12">
                ${buildDescriptionSection(d.description)}
            </div>
        </div>
    `;
}

function buildLeadCard(title, rows)
{
    var rowsHtml = '';
    for (var i = 0; i < rows.length; i++) {
        let value = rows[i][1];
        if (typeof value === 'string' && value.includes('<span')) {
            value = cleanButtonHtml(value);
        } else {
            value = normalizeValue(value);
        }
        rowsHtml += `
            <div class="lead-detail-row">
                <div class="lead-detail-label">${escapeHtml(rows[i][0])}</div>
                <div class="lead-detail-value">${value}</div>
            </div>
        `;
    }
    return `
        <div class="lead-card">
            <div class="lead-card-header">${escapeHtml(title)}</div>
            <div class="lead-card-body">
                ${rowsHtml}
            </div>
        </div>
    `;
}

function buildDescriptionSection(description)
{
    return `
        <div class="lead-card">
            <div class="lead-card-header">Description</div>
            <div class="lead-card-body">
                <div class="lead-description-box">${escapeHtml(description || '-')}</div>
            </div>
        </div>
    `;
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

function formatDuration(dur)
{
    var n = parseInt(dur, 10);
    if (isNaN(n) || n <= 0) return '-';
    var nights = n;
    var days = n + 1;
    return nights + ' Night' + (nights !== 1 ? 's' : '') + ' ' + days + ' Day' + (days !== 1 ? 's' : '');
}

function formatDateTime(dateTimeStr)
{
    if (!dateTimeStr || dateTimeStr === '0000-00-00 00:00:00') return '-';
    var parts = dateTimeStr.split(' ');
    if (parts.length !== 2) return dateTimeStr;
    var dateParts = parts[0].split('-');
    if (dateParts.length !== 3) return dateTimeStr;
    return dateParts[2] + '/' + dateParts[1] + '/' + dateParts[0] + ' ' + parts[1];
}

function getAccommodationStatusText(accStatus, quotationStatus)
{
    accStatus = parseInt(accStatus);
    quotationStatus = parseInt(quotationStatus);
    if (accStatus === 0) {
        return '<span class="badge badge-xs badge-primary">Guest Count Required</span>';
    }
    if (accStatus === 1) {
        return '<span class="badge badge-xs badge-warning">Accommodation Required</span>';
    }
    if (accStatus === 2 && quotationStatus === 0) {
        return '<span class="badge badge-xs badge-info">Quotation Not Created</span>';
    }
    if (accStatus === 2 && quotationStatus === 1) {
        return '<span class="badge badge-xs badge-success">Quotation Created</span>';
    }
    if (accStatus === 2 && quotationStatus === 2) {
        return '<span class="badge badge-xs badge-danger">Cancelled / Quotation Not Created</span>';
    }
    return '<span class="badge badge-xs badge-secondary">Unknown</span>';
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

////***For Leads view *****///

</script>

