<script type="text/javascript">

$('#staff_id').select2({
    minimumResultsForSearch: 0,
    width: '100%'
});

$('#incentive_report_daterange').daterangepicker({
    autoUpdateInput: false,
    locale: {
        format: 'DD/MM/YYYY',
        cancelLabel: 'Clear'
    }
});

$('#incentive_report_daterange').on('apply.daterangepicker', function(ev, picker) {
    $(this).val(
        picker.startDate.format('DD/MM/YYYY') + ' - ' + picker.endDate.format('DD/MM/YYYY')
    );
});

$('#incentive_report_daterange').on('cancel.daterangepicker', function() {
    $(this).val('');
});

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
        $('#incentive_report_daterange').val(dates.start + ' - ' + dates.end);
        $('#Create').show();
    }

    var dateType = getUrlParam('date_type');
    if (dateType && dateType !== '') {
        $('#incentive_report_date_type').val(dateType);
    }
});

$('#search').click(function () {
    $table.ajax.reload();
});

$('#reset').click(function () {
    $('#guest_name').val('');
    $('#trip_code').val('');
    $('#staff_id').val(null).trigger('change');
    $('#incentive_report_daterange').val('');
    $table.ajax.reload();
});

var $table;
$(document).ready(function() {
    $table = $('#IncentiveReport').DataTable({
        "processing": true,
        "serverSide": true,
        "searching": false,
        "aLengthMenu": [[10, 25, 50, -1], [10, 25, 50, "All"]],
        dom: 'lBfrtip',
        "language": {
            "paginate": {
                "previous": "<",
                "next": ">"
            }
        },
        "drawCallback": function(settings) {
            var api = this.api();
            api.column(0).nodes().each(function(node, i) {
                var pageInfo = api.page.info();
                $(node).html(pageInfo.start + i + 1);
            });
            $('#IncentiveReport thead th').css({'font-size':'13px','padding':'5px 8px','white-space':'nowrap'});
            $('#IncentiveReport tbody td').css({'padding':'4px 8px','white-space':'nowrap'});
        },
        buttons: [
            {
                extend: 'excel',
                exportOptions: {
                    columns: [0, 1, 2, 3, 4, 5, 6, 7, 8, 9],
                    orthogonal: 'export'
                },
                footer: true
            },
            {
                extend: 'pdf',
                exportOptions: {
                    columns: [0, 1, 2, 3, 4, 5, 6, 7, 8, 9],
                    orthogonal: 'export'
                },
                footer: true
            },
            {
                extend: 'print',
                exportOptions: {
                    columns: [0, 1, 2, 3, 4, 5, 6, 7, 8, 9],
                    orthogonal: 'export'
                },
                footer: true
            }
        ],
        "ajax": {
            "url": "<?php echo base_url(); ?>index.php/Quotation/ajax_incentive_reports",
            "type": "POST",
            "dataSrc": function(json) {
                if (json.totals) {
                    var t = json.totals;
                    var pq = parseFloat(t.total_pre_quoted || 0).toFixed(2);
                    var tc = parseFloat(t.total_cost || 0).toFixed(2);
                    var tp = parseFloat(t.total_profit || 0).toFixed(2);
                    var ti = parseFloat(t.total_incentive || 0).toFixed(2);
                    $('#incentive-total-pre-quoted').html(pq);
                    $('#incentive-total-cost').html(tc);
                    $('#incentive-total-profit').html(tp);
                    $('#incentive-total-incentive').html('\u20B9' + ti);
                    var $foot = $('#IncentiveReport tfoot th');
                    $foot.eq(6).html(pq);
                    $foot.eq(7).html(tc);
                    $foot.eq(8).html(tp);
                    $foot.eq(9).html('\u20B9' + ti);
                }
                return json.data;
            },
            "data": function (d) {
                d.guest_name = $("#guest_name").val();
                d.trip_code  = $("#trip_code").val();
                d.staff_id   = $("#staff_id").val();
                d.date_type  = $("#incentive_report_date_type").val();
                var reportRange = $("#incentive_report_daterange").val();
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
            $('td', row).eq(2).html(data['trip_code'] ? '<span class="badge badge-warning">' + data['trip_code'] + '</span>' : '-');

            if (data['pre_quoted_amount'] !== undefined) {
                $('td', row).eq(6).html(parseFloat(data['pre_quoted_amount']).toFixed(2));
            }
            if (data['total_financial_cost'] !== undefined) {
                $('td', row).eq(7).html(parseFloat(data['total_financial_cost']).toFixed(2));
            }
            if (data['profit'] !== undefined) {
                var profit = parseFloat(data['profit']);
                var profitClass = profit >= 0 ? 'text-success' : 'text-danger';
                $('td', row).eq(8).html('<span class="' + profitClass + ' fw-bold">' + profit.toFixed(2) + '</span>');
            }
            if (data['incentive'] !== undefined) {
                var incentive = parseFloat(data['incentive']);
                var badgeClass = incentive > 0 ? 'bg-success' : 'bg-secondary';
                $('td', row).eq(9).html('<span class="badge ' + badgeClass + '" style="font-size:11px">₹' + incentive.toFixed(2) + '</span>');
            }
        },
        "columns": [
            { "data": "leads_id", "orderable": false },
            { "data": "quotation_number", "orderable": false },
            { "data": "trip_code", "orderable": false },
            { "data": "guest_name", "orderable": false },
            { "data": "travel_start_date", "orderable": false, "render": function(data, type, row) {
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
            { "data": "staff_name", "orderable": false },
            { "data": "pre_quoted_amount", "orderable": false },
            { "data": "total_financial_cost", "orderable": false },
            { "data": "profit", "orderable": false },
            { "data": "incentive", "orderable": false }
        ]
    });

    if (getUrlParam('period') || getUrlParam('date_type')) {
        $table.ajax.reload();
    }
});
</script>
