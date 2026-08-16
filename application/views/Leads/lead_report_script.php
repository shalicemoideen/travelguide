<script type="text/javascript">

$('#staff_id').select2({
    minimumResultsForSearch: 0,
    width: '100%'
});

$('#lead_status').select2({
    minimumResultsForSearch: 0,
    width: '100%'
});

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
    });

    var period = getUrlParam('period');
    if (period && period !== '') {
        var dates = getPeriodDates(period);
        $('#leads_report_daterange').val(dates.start + ' - ' + dates.end);
        $('#Create').show();
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
            }
        },
        "createdRow": function (row, data, index) {
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
                    var nights = dur - 1;
                    durStr = nights + 'N ' + dur + 'D';
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
</script>
