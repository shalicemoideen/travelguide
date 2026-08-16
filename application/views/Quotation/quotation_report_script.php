<script type="text/javascript">

$('#staff_id').select2({
    minimumResultsForSearch: 0,
    width: '100%'
});

$('#quotation_status').select2({
    minimumResultsForSearch: 0,
    width: '100%'
});

$('#quotation_created_daterange').daterangepicker({
    autoUpdateInput: false,
    locale: {
        format: 'DD/MM/YYYY',
        cancelLabel: 'Clear'
    }
});

$('#quotation_created_daterange').on('apply.daterangepicker', function(ev, picker) {
    $(this).val(
        picker.startDate.format('DD/MM/YYYY') + ' - ' + picker.endDate.format('DD/MM/YYYY')
    );
});

$('#quotation_created_daterange').on('cancel.daterangepicker', function() {
    $(this).val('');
});

$('#quotation_report_daterange').daterangepicker({
    autoUpdateInput: false,
    locale: {
        format: 'DD/MM/YYYY',
        cancelLabel: 'Clear'
    }
});

$('#quotation_report_daterange').on('apply.daterangepicker', function(ev, picker) {
    $(this).val(
        picker.startDate.format('DD/MM/YYYY') + ' - ' + picker.endDate.format('DD/MM/YYYY')
    );
});

$('#quotation_report_daterange').on('cancel.daterangepicker', function() {
    $(this).val('');
});

var statusLabels = {
    1: '<span class="badge badge-secondary">Generated</span>',
    2: '<span class="badge badge-light">Draft</span>',
    3: '<span class="badge badge-info">Sent</span>',
    4: '<span class="badge badge-danger">Rejected</span>',
    5: '<span class="badge badge-success">Confirmed</span>',
    6: '<span class="badge badge-danger">Cancelled</span>',
    8: '<span class="badge badge-info">Reservation Completed</span>',
    7: '<span class="badge badge-primary">Ready to Trip</span>',
    9: '<span class="badge badge-warning">Driver Not Assigned</span>',
    10: '<span class="badge badge-success">Trip Completed</span>'
};

var statusLabelsExport = {
    1: 'Generated', 2: 'Draft', 3: 'Sent', 4: 'Rejected', 5: 'Confirmed',
    6: 'Cancelled', 7: 'Ready to Trip', 8: 'Reservation Completed',
    9: 'Driver Not Assigned', 10: 'Trip Completed'
};

var autoReload = false;

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

    var status = getUrlParam('status');
    if (status && status !== '') {
        $('#quotation_status').val(status).trigger('change');
        $('#Create').show();
        autoReload = true;
    }

    var period = getUrlParam('period');
    if (period && period !== '') {
        var dates = getPeriodDates(period);
        $('#quotation_created_daterange').val(dates.start + ' - ' + dates.end);
        $('#Create').show();
        autoReload = true;
    }
});

$('#search').click(function () {
    $table.ajax.reload();
});

$('#reset').click(function () {
    $('#guest_name').val('');
    $('#staff_id').val(null).trigger('change');
    $('#quotation_status').val(null).trigger('change');
    $('#quotation_created_daterange').val('');
    $('#quotation_report_daterange').val('');
    $table.ajax.reload();
});

var $table;
$(document).ready(function () {
    $table = $('#QuotationReport').DataTable({
        "processing": true,
        "serverSide": true,
        "searching": false,
        "aLengthMenu": [[10, 25, 50, -1], [10, 25, 50, "All"]],
        dom: 'lBfrtip',
        buttons: [
            {
                extend: 'excel',
                exportOptions: { columns: [0, 1, 2, 3, 4, 5, 6], orthogonal: 'export' },
                footer: true
            },
            {
                extend: 'pdf',
                exportOptions: { columns: [0, 1, 2, 3, 4, 5, 6], orthogonal: 'export' },
                footer: true
            },
            {
                extend: 'print',
                exportOptions: { columns: [0, 1, 2, 3, 4, 5, 6], orthogonal: 'export' },
                footer: true
            }
        ],
        "ajax": {
            "url": "<?php echo base_url(); ?>index.php/Quotation/ajax_quotation_report",
            "type": "POST",
            "data": function (d) {
                d.guest_name       = $("#guest_name").val();
                d.staff_id         = $("#staff_id").val();
                d.quotation_status = $("#quotation_status").val();
                var createdRange = $("#quotation_created_daterange").val();
                if (createdRange) {
                    var createdDates = createdRange.split(' - ');
                    d.created_start_date = createdDates[0];
                    d.created_end_date   = createdDates[1];
                } else {
                    d.created_start_date = '';
                    d.created_end_date   = '';
                }
                var reportRange = $("#quotation_report_daterange").val();
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

            var statusCell = $('td', row).eq(6);
            var statusCode = parseInt(data['quotation_current_status']);
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
            var label = 'Total Quotations: <strong>' + total + '</strong>';
            if (filtered !== total) {
                label += ' &nbsp;|&nbsp; Filtered: <strong>' + filtered + '</strong>';
            }
            $('#quotation-total-count').html(label);
            $(api.table().footer()).find('th:last').html(label);
        },
        "columns": [
            { "data": "quotation_id",           "orderable": false },
            { "data": "quotation_number",        "orderable": false },
            { "data": "staff_name",              "orderable": false },
            { "data": "guest_name",              "orderable": false },
            { "data": "quotation_date",          "orderable": false },
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
            { "data": "quotation_current_status","orderable": false, "render": function(data, type, row) {
                if (type === 'export') {
                    var code = parseInt(data);
                    return statusLabelsExport[code] || data;
                }
                return data;
            }}
        ]
    });

    if (autoReload) {
        $table.ajax.reload();
    }
});
</script>
