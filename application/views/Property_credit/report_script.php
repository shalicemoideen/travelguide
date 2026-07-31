<script type="text/javascript">
var base_url = '<?php echo base_url(); ?>';
var creditTable = null;

$(document).ready(function() {
    creditTable = $('#credit_report_table').DataTable({
        processing: true,
        serverSide: true,
        ajax: {
            url: base_url + 'index.php/Property_credit/get',
            type: 'POST',
            data: function(d) {
                d.property_filter       = $('#filter_property').val();
                d.credit_status_filter  = $('#filter_credit_status').val();
                d.start_date            = $('#filter_start_date').val();
                d.end_date              = $('#filter_end_date').val();
                d.expiring_days         = $('#filter_expiring_days').val();
            },
            dataSrc: function(res) {
                updateTiles(res.recordsTotal > 0 ? null : null);
                fetchReportTotals();
                return res.data;
            }
        },
        columns: [
            { data: null, render: function(data, type, row, meta) { return meta.row + 1; } },
            { data: 'properties_name', defaultContent: '-' },
            { data: 'cancellation_number', defaultContent: '-' },
            { data: 'original_booking_number', defaultContent: '-' },
            { data: 'credit_amount', className: 'text-end', render: function(data) { return '&#8377;' + fmtMoney(data); } },
            { data: 'used_amount', className: 'text-end', render: function(data) { return '&#8377;' + fmtMoney(data); } },
            { data: 'remaining_amount', className: 'text-end', render: function(data) { return '<strong>&#8377;' + fmtMoney(data) + '</strong>'; } },
            { data: 'credit_status', render: function(data) { return creditStatusPill(data); } },
            { data: 'expiry_date', defaultContent: '-', render: function(data) { return data && data !== '0000-00-00' ? fmtDate(data) : '-'; } },
            { data: 'reference_number', defaultContent: '-' },
            { data: 'created_datetime', defaultContent: '-', render: function(data) { return data ? fmtDate(String(data).substr(0, 10)) : '-'; } },
            { data: 'age_days', className: 'text-center', defaultContent: '-' }
        ],
        order: [[0, 'desc']],
        pageLength: 25,
        lengthMenu: [10, 25, 50, 100]
    });
});

function fmtMoney(v) {
    return parseFloat(v || 0).toLocaleString('en-IN', { minimumFractionDigits: 2, maximumFractionDigits: 2 });
}

function fmtDate(d) {
    if (!d) return '-';
    var p = d.split('-');
    if (p.length !== 3) return d;
    return p[2] + '/' + p[1] + '/' + p[0];
}

function creditStatusPill(s) {
    var m = {
        AVAILABLE:       ['badge bg-success', 'AVAILABLE'],
        PARTIALLY_USED:  ['badge bg-warning text-dark', 'PARTIALLY USED'],
        FULLY_UTILIZED:  ['badge bg-primary', 'FULLY UTILIZED'],
        EXPIRED:         ['badge bg-danger', 'EXPIRED'],
        CANCELLED:       ['badge bg-secondary', 'CANCELLED']
    };
    var c = m[s] || ['badge bg-secondary', s];
    return '<span class="credit-status-pill ' + c[0] + '">' + c[1] + '</span>';
}

function toggleCreditFilters() {
    $('#creditFilterSection').slideToggle();
}

function applyCreditReportFilters() {
    creditTable.ajax.reload();
}

function clearCreditReportFilters() {
    $('#filter_property').val('');
    $('#filter_credit_status').val('');
    $('#filter_start_date').val('');
    $('#filter_end_date').val('');
    $('#filter_expiring_days').val('');
    creditTable.ajax.reload();
}

function fetchReportTotals() {
    $.ajax({
        url: base_url + 'index.php/Property_credit/ajax_get_report_totals',
        type: 'POST',
        data: {
            property_filter:      $('#filter_property').val(),
            credit_status_filter: $('#filter_credit_status').val(),
            start_date:           $('#filter_start_date').val(),
            end_date:             $('#filter_end_date').val(),
            expiring_days:        $('#filter_expiring_days').val()
        },
        dataType: 'json',
        success: function(res) {
            if (res.status && res.data) {
                $('#tile_total_credit').html('&#8377;' + fmtMoney(res.data.total_credit));
                $('#tile_total_used').html('&#8377;' + fmtMoney(res.data.total_used));
                $('#tile_total_remaining').html('&#8377;' + fmtMoney(res.data.total_remaining));
            }
        }
    });
}

function updateTiles() {
    fetchReportTotals();
}
</script>
