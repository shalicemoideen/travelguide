<script type="text/javascript">

$('#staff_id').select2({
    minimumResultsForSearch: 0,
    width: '100%'
});

$('#start_date').bootstrapMaterialDatePicker({
    weekStart: 0,
    time: false,
    format: 'DD/MM/YYYY'
});

$('#end_date').bootstrapMaterialDatePicker({
    weekStart: 0,
    time: false,
    format: 'DD/MM/YYYY'
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
        $('#start_date').val(dates.start);
        $('#end_date').val(dates.end);
        $('#Create').show();
    }
});

$('#search').click(function () {
    $table.ajax.reload();
});

var $table;
$(document).ready(function() {
    $table = $('#ConvertedTripsReport').DataTable({
        "processing": true,
        "serverSide": true,
        "searching": false,
        "aLengthMenu": [[10, 25, 50, -1], [10, 25, 50, "All"]],
        dom: 'lBfrtip',
        buttons: [
            {
                extend: 'excel',
                exportOptions: {
                    columns: [0, 1, 2, 3, 4, 5, 6, 7, 8]
                }
            },
            {
                extend: 'pdf',
                exportOptions: {
                    columns: [0, 1, 2, 3, 4, 5, 6, 7, 8]
                }
            },
            {
                extend: 'print',
                exportOptions: {
                    columns: [0, 1, 2, 3, 4, 5, 6, 7, 8]
                }
            }
        ],
        "ajax": {
            "url": "<?php echo base_url(); ?>index.php/Quotation/ajax_converted_trips_report",
            "type": "POST",
            "data": function (d) {
                d.guest_name = $("#guest_name").val();
                d.staff_id = $("#staff_id").val();
                d.start_date = $("#start_date").val();
                d.end_date = $("#end_date").val();
            }
        },
        "createdRow": function (row, data, index) {
            var guestCell = $('td', row).eq(2);
            var guestHtml = '<div>' + (data['guest_name'] || '') + '</div>';
            var adults   = parseInt(data['total_adults'] || 0);
            var children = parseInt(data['total_children'] || 0);
            if (adults > 0 || children > 0) {
                guestHtml += '<div class="mt-1" style="font-size:11px;">';
                if (adults > 0)   guestHtml += '<span class="badge bg-primary me-1">Adults: ' + adults + '</span>';
                if (children > 0) guestHtml += '<span class="badge bg-warning text-dark">Kids: ' + children + '</span>';
                guestHtml += '</div>';
            }
            guestCell.html(guestHtml);

            if (data['total_financial_cost'] !== undefined) {
                $('td', row).eq(6).html(parseFloat(data['total_financial_cost']).toFixed(2));
            }
            if (data['profit'] !== undefined) {
                var profit = parseFloat(data['profit']);
                var profitClass = profit >= 0 ? 'text-success' : 'text-danger';
                $('td', row).eq(7).html('<span class="' + profitClass + ' fw-bold">' + profit.toFixed(2) + '</span>');
            }
            if (data['incentive'] !== undefined) {
                var incentive = parseFloat(data['incentive']);
                var badgeClass = incentive > 0 ? 'bg-success' : 'bg-secondary';
                $('td', row).eq(8).html('<span class="badge ' + badgeClass + ' fs-6">₹' + incentive.toFixed(2) + '</span>');
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
            { "data": "guest_name", "orderable": false },
            { "data": "travel_start_date", "orderable": false },
            { "data": "duration", "orderable": false },
            { "data": "staff_name", "orderable": false },
            { "data": "total_financial_cost", "orderable": false },
            { "data": "profit", "orderable": false },
            { "data": "incentive", "orderable": false }
        ]
    });

    if (getUrlParam('period')) {
        $table.ajax.reload();
    }
});
</script>
