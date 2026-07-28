<script>
$(function () {

    var BC_URL  = '<?php echo base_url(); ?>index.php/Booking_cancellation/';
    var UPLOADS = '<?php echo base_url(); ?>uploads/cancellation_proofs/';

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
        return '<span class="bcr-pill" style="background:' + bg + ';color:' + fg + '">' + esc(text) + '</span>';
    }

    $('.bcr-date').datepicker({ format: 'dd/mm/yyyy', autoclose: true, todayHighlight: true });

    var table = $('#bcrTable').DataTable({
        processing: true,
        serverSide: true,
        ordering: false,
        pageLength: 25,
        lengthMenu: [[10, 25, 50, 100], [10, 25, 50, 100]],
        language: { emptyTable: 'No refunds found' },
        ajax: {
            url: BC_URL + 'get_customer_refund_table',
            type: 'POST',
            data: function (d) {
                d.start_date      = $('#rf_start').val();
                d.end_date        = $('#rf_end').val();
                d.mode_filter     = $('#rf_mode').val();
                d.approval_filter = $('#rf_approval').val();
            }
        },
        columns: [
            { data: 'refund_date', render: dmy },
            { data: 'cancellation_number', render: function (v, t, row) {
                return '<a href="' + BC_URL + 'detail/' + row.booking_cancellation_id_fk + '">' + esc(v) + '</a>'
                     + (row.refund_entry_type === 'REVERSAL'
                        ? '<br>' + pill('REVERSAL', '#e2d9f3', '#432874') : '');
            }},
            { data: 'quotation_number', render: function (v, t, row) {
                return esc(v || '-') + '<br><small class="text-muted">' + esc(row.guest_name || '') + '</small>';
            }},
            { data: 'refund_mode', render: function (v) { return esc(v || '-'); } },
            { data: 'refund_reference', render: function (v) { return esc(v || '-'); } },
            { data: 'refund_amount', className: 'bcr-money', render: function (v, t, row) {
                var isRev = row.refund_entry_type === 'REVERSAL';
                return '<span class="fw-bold ' + (isRev ? 'text-danger' : '') + '">'
                     + (isRev ? '-' : '') + money(v) + '</span>';
            }},
            { data: 'accountant_approval_status', render: function (v, t, row) {
                var html = v === 'approved' ? pill('APPROVED', '#d1e7dd', '#0f5132')
                         : v === 'rejected' ? pill('REJECTED', '#f8d7da', '#842029')
                         : pill('PENDING', '#fff3cd', '#664d03');
                if (row.accountant_approved_by_username) {
                    html += '<br><small class="text-muted">' + esc(row.accountant_approved_by_username) + '</small>';
                }
                return html;
            }},
            { data: 'refund_paid_by_username', render: function (v) { return esc(v || '-'); } },
            { data: 'refund_proof_file', orderable: false, render: function (v) {
                return v ? '<a href="' + UPLOADS + encodeURIComponent(v) + '" target="_blank" '
                         + 'class="btn btn-outline-secondary btn-xs"><i class="la la-paperclip"></i></a>'
                         : '<span class="text-muted">-</span>';
            }}
        ]
    });

    $('#rApply').on('click', function () { table.ajax.reload(); });

    $('#rReset').on('click', function () {
        $('#rf_start, #rf_end, #rf_mode, #rf_approval').val('');
        table.ajax.reload();
    });

});
</script>
