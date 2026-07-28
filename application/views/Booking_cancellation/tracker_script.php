<script>
$(function () {

    var BC_URL = '<?php echo base_url(); ?>index.php/Booking_cancellation/';

    function money(v) {
        return parseFloat(v || 0).toLocaleString('en-IN', { minimumFractionDigits: 2, maximumFractionDigits: 2 });
    }

    function dmy(iso) {
        if (!iso || iso === '0000-00-00') return '-';
        var p = String(iso).substr(0, 10).split('-');
        return p.length === 3 ? p[2] + '/' + p[1] + '/' + p[0] : '-';
    }

    function esc(s) {
        return $('<div>').text(s === null || s === undefined ? '' : s).html();
    }

    function pill(text, bg, fg) {
        return '<span class="bct-pill" style="background:' + bg + ';color:' + fg + '">' + esc(text) + '</span>';
    }

    function linePill(s) {
        var m = { PENDING_INTIMATION: ['#f1f3f5','#495057'], INTIMATED: ['#e7f1ff','#0a58ca'],
                  CHARGE_CONFIRMED: ['#cfe2ff','#084298'], REFUND_PENDING: ['#fff3cd','#664d03'],
                  PARTIALLY_REFUNDED: ['#ffe5d0','#8a4b0a'], FULLY_REFUNDED: ['#d1e7dd','#0f5132'],
                  REFUSED: ['#f8d7da','#842029'], WRITTEN_OFF: ['#f8d7da','#842029'],
                  NO_REFUND_DUE: ['#f1f3f5','#868e96'], PAYABLE_PENDING: ['#ffe5d0','#8a4b0a'] };
        var c = m[s] || ['#f1f3f5','#495057'];
        return pill(String(s).replace(/_/g, ' '), c[0], c[1]);
    }

    function ageCell(days, pending) {
        if (days === null || days === undefined || days === '') return '-';
        days = parseInt(days, 10);
        var cls = days <= 15 ? 'b1' : days <= 30 ? 'b2' : days <= 60 ? 'b3' : 'b4';
        var overdue = parseFloat(pending || 0) > 0.009 && days > 30;
        return '<span class="bct-age ' + cls + '">' + days + 'd</span>'
             + (overdue ? '<br>' + pill('OVERDUE', '#f8d7da', '#842029') : '');
    }

    $('.bct-date').datepicker({ format: 'dd/mm/yyyy', autoclose: true, todayHighlight: true });

    var table = $('#bctTable').DataTable({
        processing: true,
        serverSide: true,
        ordering: false,
        pageLength: 25,
        lengthMenu: [[10, 25, 50, 100], [10, 25, 50, 100]],
        language: { emptyTable: 'No supplier refund items found' },
        ajax: {
            url: BC_URL + 'get_tracker_table',
            type: 'POST',
            data: function (d) {
                d.property_filter    = $('#tf_property').val();
                d.line_status_filter = $('#tf_status').val();
                d.age_bucket         = $('#tf_age').val();
                d.start_date         = $('#tf_start').val();
                d.end_date           = $('#tf_end').val();
                d.open_only          = $('#tf_open_only').is(':checked') ? '1' : '';
            },
            dataSrc: function (json) {
                var t = json.totals || {};
                $('#tt_expected').text(money(t.expected));
                $('#tt_received').text(money(t.received));
                $('#tt_pending').text(money(t.pending));
                $('#tt_payable').text(money(t.payable));
                return json.data;
            }
        },
        columns: [
            { data: 'snap_property_name', render: function (v, t, row) {
                return '<span class="fw-bold">' + esc(v) + '</span>'
                     + '<br><small class="text-muted">' + dmy(row.snap_check_in_date)
                     + ' \u2192 ' + dmy(row.snap_check_out_date) + '</small>'
                     + (row.snap_confirmation_number
                        ? '<br><small class="text-muted">CNF ' + esc(row.snap_confirmation_number) + '</small>' : '');
            }},
            { data: 'cancellation_number', render: function (v, t, row) {
                return '<a href="' + BC_URL + 'detail/' + row.booking_cancellation_id_fk + '">' + esc(v) + '</a>';
            }},
            { data: 'quotation_number', render: function (v, t, row) {
                return esc(v || '-') + '<br><small class="text-muted">' + esc(row.guest_name || '') + '</small>';
            }},
            { data: 'cancellation_effective_date', render: dmy },
            { data: 'age_days', className: 'text-center', render: function (v, t, row) {
                return ageCell(v, row.refund_pending);
            }},
            { data: 'snap_amount_paid', className: 'bct-money', render: money },
            { data: 'cancellation_charge', className: 'bct-money', render: money },
            { data: 'refund_expected', className: 'bct-money', render: money },
            { data: 'refund_received', className: 'bct-money', render: function (v) {
                return '<span class="text-success">' + money(v) + '</span>';
            }},
            { data: 'refund_pending', className: 'bct-money', render: function (v, t, row) {
                var pending = parseFloat(v || 0);
                var payable = parseFloat(row.still_payable_to_property || 0);
                var out = pending > 0.009
                    ? '<span class="text-danger fw-bold">' + money(pending) + '</span>'
                    : '<span class="text-muted">' + money(pending) + '</span>';
                if (payable > 0.009) {
                    out += '<br><small class="text-warning">owe ' + money(payable) + '</small>';
                }
                if (parseFloat(row.amount_written_off || 0) > 0.009) {
                    out += '<br><small class="text-muted">w/o ' + money(row.amount_written_off) + '</small>';
                }
                return out;
            }},
            { data: 'line_status', render: function (v, t, row) {
                var out = linePill(v);
                if (row.expected_refund_by_date && row.expected_refund_by_date !== '0000-00-00') {
                    out += '<br><small class="text-muted">by ' + dmy(row.expected_refund_by_date) + '</small>';
                }
                return out;
            }},
            { data: 'followup_count', render: function (v, t, row) {
                v = parseInt(v || 0, 10);
                if (!v) return '<span class="text-muted">none</span>';
                return v + 'x<br><small class="text-muted">' + dmy(row.last_followup_date) + '</small>';
            }},
            { data: null, className: 'text-center', orderable: false, render: function (v, t, row) {
                return '<a href="' + BC_URL + 'detail/' + row.booking_cancellation_id_fk
                     + '#tabSupplier" class="btn btn-primary btn-xs"><i class="la la-external-link-alt"></i></a>';
            }}
        ]
    });

    $('#tApply').on('click', function () { table.ajax.reload(); });

    $('#tReset').on('click', function () {
        $('#tf_property, #tf_status, #tf_age').val('');
        $('#tf_start, #tf_end').val('');
        $('#tf_open_only').prop('checked', true);
        table.ajax.reload();
    });

});
</script>
