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
        buttons: [
            {
                extend: 'excel',
                exportOptions: {
                    columns: [0, 1, 2, 3, 4, 5, 6, 7, 8, 9]
                }
            },
            {
                extend: 'pdf',
                exportOptions: {
                    columns: [0, 1, 2, 3, 4, 5, 6, 7, 8, 9]
                }
            },
            {
                extend: 'print',
                exportOptions: {
                    columns: [0, 1, 2, 3, 4, 5, 6, 7, 8, 9]
                }
            }
        ],
        "ajax": {
            "url": "<?php echo base_url(); ?>index.php/Quotation/ajax_incentive_reports",
            "type": "POST",
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
                $('td', row).eq(9).html('<span class="badge ' + badgeClass + ' fs-6">₹' + incentive.toFixed(2) + '</span>');
            }
        },
        "drawCallback": function(settings) {
            var api = this.api();
            api.column(0).nodes().each(function(node, i) {
                var pageInfo = api.page.info();
                $(node).html(pageInfo.start + i + 1);
            });
        },
        "columns": [
            { "data": "leads_id", "orderable": false },
            { "data": "quotation_number", "orderable": false },
            { "data": "trip_code", "orderable": false },
            { "data": "guest_name", "orderable": false },
            { "data": "travel_start_date", "orderable": false },
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
