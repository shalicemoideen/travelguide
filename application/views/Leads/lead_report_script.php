<script type="text/javascript">

$('#staff_id').select2({
    minimumResultsForSearch: 0,
    width: '100%'
});

$('#lead_status').select2({
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

var statusLabels = {
    1: '<span class="badge bg-info text-white">In take</span>',
    2: '<span class="badge bg-warning text-dark">Qualified</span>',
    3: '<span class="badge bg-success text-white">Converted to trip</span>',
    4: '<span class="badge bg-danger text-white">Not Qualified</span>',
    5: '<span class="badge bg-secondary text-white">Lost</span>'
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
        $('#start_date').val(dates.start);
        $('#end_date').val(dates.end);
        $('#Create').show();
    }
});

$('#search').click(function () {
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
                exportOptions: { columns: [0, 1, 2, 3, 4, 5, 6, 7, 8] }
            },
            {
                extend: 'pdf',
                exportOptions: { columns: [0, 1, 2, 3, 4, 5, 6, 7, 8] }
            },
            {
                extend: 'print',
                exportOptions: { columns: [0, 1, 2, 3, 4, 5, 6, 7, 8] }
            }
        ],
        "ajax": {
            "url": "<?php echo base_url(); ?>index.php/Leads/ajax_lead_report",
            "type": "POST",
            "data": function (d) {
                d.guest_name  = $("#guest_name").val();
                d.staff_id    = $("#staff_id").val();
                d.lead_status = $("#lead_status").val();
                d.start_date  = $("#start_date").val();
                d.end_date    = $("#end_date").val();
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

            var statusCell = $('td', row).eq(8);
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
        },
        "columns": [
            { "data": "leads_id",           "orderable": false },
            { "data": "leads_number",        "orderable": false },
            { "data": "staff_name",          "orderable": false },
            { "data": "guest_name",          "orderable": false },
            { "data": "destination",         "orderable": false },
            { "data": "lead_created_date",    "orderable": false },
            { "data": "travel_date",         "orderable": false },
            { "data": "duration",            "orderable": false },
            { "data": "lead_current_status", "orderable": false }
        ]
    });

    if (getUrlParam('period')) {
        $table.ajax.reload();
    }
});
</script>
