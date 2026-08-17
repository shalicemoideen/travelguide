<script type="text/javascript">

$('#staff_id').select2({
    minimumResultsForSearch: 0,
    width: '100%'
});

$('#converted_trips_daterange').daterangepicker({
    autoUpdateInput: false,
    locale: {
        format: 'DD/MM/YYYY',
        cancelLabel: 'Clear'
    }
});

$('#converted_trips_daterange').on('apply.daterangepicker', function(ev, picker) {
    $(this).val(
        picker.startDate.format('DD/MM/YYYY') + ' - ' + picker.endDate.format('DD/MM/YYYY')
    );
});

$('#converted_trips_daterange').on('cancel.daterangepicker', function() {
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
        $('#converted_trips_daterange').val(dates.start + ' - ' + dates.end);
        $('#Create').show();
    }

    var dateType = getUrlParam('date_type');
    if (dateType && dateType !== '') {
        $('#converted_trips_date_type').val(dateType);
    }
});

$('#search').click(function () {
    $table.ajax.reload();
});

$('#reset').click(function () {
    $('#guest_name').val('');
    $('#trip_code').val('');
    $('#staff_id').val(null).trigger('change');
    $('#converted_trips_daterange').val('');
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
                    columns: [0, 1, 2, 3, 4, 5, 6],
                    orthogonal: 'export'
                },
                footer: true
            },
            {
                extend: 'pdf',
                exportOptions: {
                    columns: [0, 1, 2, 3, 4, 5, 6],
                    orthogonal: 'export'
                },
                footer: true
            },
            {
                extend: 'print',
                exportOptions: {
                    columns: [0, 1, 2, 3, 4, 5, 6],
                    orthogonal: 'export'
                },
                footer: true
            }
        ],
        "ajax": {
            "url": "<?php echo base_url(); ?>index.php/Quotation/ajax_converted_trips_report",
            "type": "POST",
            "data": function (d) {
                d.guest_name = $("#guest_name").val();
                d.trip_code = $("#trip_code").val();
                d.staff_id = $("#staff_id").val();
                d.date_type = $("#converted_trips_date_type").val();
                var reportRange = $("#converted_trips_daterange").val();
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
            var guestCell = $('td', row).eq(3);
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

            if (data['quotation_id']) {
                $('td', row).eq(1).html(
                    '<a href="javascript:void(0)" class="text-primary fw-bold" onclick="view_trip_details(' +
                    data['quotation_id'] + ')">' + (data['quotation_number'] || '-') + '</a>'
                );
            }
            if (data['trip_code']) {
                $('td', row).eq(2).html('<span class="badge badge-warning">' + data['trip_code'] + '</span>');
            }

            if (data['pre_quoted_amount'] !== undefined) {
                $('td', row).eq(6).html(parseFloat(data['pre_quoted_amount']).toFixed(2));
            }
        },
        "drawCallback": function(settings) {
            var api = this.api();
            api.column(0).nodes().each(function(node, i) {
                var pageInfo = api.page.info();
                $(node).html(pageInfo.start + i + 1);
            });
            var info = api.page.info();
            var total    = info.recordsTotal;
            var filtered = info.recordsDisplay;
            var label = 'Total Converted Trips: <strong>' + total + '</strong>';
            if (filtered !== total) {
                label += ' &nbsp;|&nbsp; Filtered: <strong>' + filtered + '</strong>';
            }
            $('#converted-trips-total-count').html(label);
            $(api.table().footer()).find('th:last').html(label);
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
            { "data": "pre_quoted_amount", "orderable": false }
        ]
    });

    if (getUrlParam('period') || getUrlParam('date_type')) {
        $table.ajax.reload();
    }
});

<?php include(APPPATH . 'views/Quotation/trip_details_modal_script.php'); ?>
</script>
