<script>
$(function () {

    var BC_URL = '<?php echo base_url(); ?>index.php/Booking_cancellation/';

    var worksheet = null;

    // -----------------------------------------------------
    // Helpers
    // -----------------------------------------------------

    function money(v) {
        v = parseFloat(v || 0);
        return v.toLocaleString('en-IN', { minimumFractionDigits: 2, maximumFractionDigits: 2 });
    }

    function dmy(iso) {
        if (!iso || iso === '0000-00-00' || iso === null) return '-';
        var p = String(iso).substr(0, 10).split('-');
        return p.length === 3 ? p[2] + '/' + p[1] + '/' + p[0] : '-';
    }

    function esc(s) {
        return $('<div>').text(s === null || s === undefined ? '' : s).html();
    }

    function toast(type, msg) {
        if (typeof notify !== 'undefined') {
            new notify({ style: type === 'error' ? 'error' : 'success', message: msg, timeout: 3500 }).show();
        } else {
            alert(msg);
        }
    }

    function statusPill(status) {
        var map = {
            DRAFT:            ['#e9ecef', '#495057'],
            PENDING_APPROVAL: ['#fff3cd', '#664d03'],
            APPROVED:         ['#cfe2ff', '#084298'],
            SETTLED:          ['#d1e7dd', '#0f5132'],
            REJECTED:         ['#f8d7da', '#842029'],
            REVERSED:         ['#e2d9f3', '#432874']
        };
        var c = map[status] || ['#e9ecef', '#495057'];
        return '<span class="bc-pill" style="background:' + c[0] + ';color:' + c[1] + '">'
             + esc(String(status).replace(/_/g, ' ')) + '</span>';
    }

    function settlementPill(status) {
        var map = {
            NOT_APPLICABLE: ['#f1f3f5', '#868e96'],
            PENDING:        ['#fff3cd', '#664d03'],
            PARTIAL:        ['#ffe5d0', '#8a4b0a'],
            COMPLETED:      ['#d1e7dd', '#0f5132'],
            WRITTEN_OFF:    ['#f8d7da', '#842029']
        };
        var c = map[status] || ['#f1f3f5', '#868e96'];
        return '<span class="bc-pill" style="background:' + c[0] + ';color:' + c[1] + '">'
             + esc(String(status).replace(/_/g, ' ')) + '</span>';
    }

    // Date pickers (dd/mm/yyyy, matching the rest of the app)
    $('.bc-date').datepicker({
        format: 'dd/mm/yyyy',
        autoclose: true,
        todayHighlight: true
    });

    function todayDmy() {
        var d = new Date();
        return ('0' + d.getDate()).slice(-2) + '/' + ('0' + (d.getMonth() + 1)).slice(-2) + '/' + d.getFullYear();
    }

    // -----------------------------------------------------
    // DataTable
    // -----------------------------------------------------

    var table = $('#bcTable').DataTable({
        processing: true,
        serverSide: true,
        searching: true,
        ordering: false,
        pageLength: 25,
        lengthMenu: [[10, 25, 50, 100], [10, 25, 50, 100]],
        language: { emptyTable: 'No cancellations found' },
        ajax: {
            url: BC_URL + 'get_table',
            type: 'POST',
            data: function (d) {
                d.start_date                 = $('#f_start_date').val();
                d.end_date                   = $('#f_end_date').val();
                d.quotation_number_filter    = $('#f_quotation_number').val();
                d.guest_name_filter          = $('#f_guest_name').val();
                d.reason_filter              = $('#f_reason').val();
                d.status_filter              = $('#f_status').val();
                d.customer_settlement_filter = $('#f_customer_settlement').val();
                d.supplier_settlement_filter = $('#f_supplier_settlement').val();
                d.staff_filter               = $('#f_staff').val();
            }
        },
        columns: [
            { data: 'cancellation_number', render: function (v, t, row) {
                return '<a href="' + BC_URL + 'detail/' + row.booking_cancellation_id + '" class="fw-bold">'
                     + esc(v) + '</a>'
                     + (row.cancellation_scope === 'PARTIAL'
                        ? '<br><span class="bc-pill" style="background:#e7f1ff;color:#0a58ca">PARTIAL</span>' : '');
            }},
            { data: 'quotation_number', render: function (v, t, row) {
                return esc(v || '-') + '<br><small class="text-muted">' + esc(row.leads_number || '') + '</small>';
            }},
            { data: 'guest_name', render: function (v, t, row) {
                return esc(v || '-')
                     + (row.staff_name ? '<br><small class="text-muted">' + esc(row.staff_name) + '</small>' : '');
            }},
            { data: 'cancellation_effective_date', render: function (v, t, row) {
                var d = row.days_before_travel;
                var badge = '';
                if (d !== null && d !== undefined && d !== '') {
                    d = parseInt(d, 10);
                    badge = '<br><small class="' + (d < 0 ? 'text-danger' : 'text-muted') + '">'
                          + (d < 0 ? Math.abs(d) + 'd after departure' : d + 'd before travel') + '</small>';
                }
                return dmy(v) + badge;
            }},
            { data: 'reason_name', render: function (v) { return esc(v || '-'); } },
            { data: 'net_retained_from_customer', className: 'bc-money', render: money },
            { data: 'customer_refund_paid', className: 'bc-money', render: function (v, t, row) {
                var bal = parseFloat(row.customer_refund_due || 0) - parseFloat(row.customer_refund_paid || 0);
                return money(v)
                     + (bal > 0.009 ? '<br><small class="text-danger">' + money(bal) + ' due</small>' : '')
                     + '<br>' + settlementPill(row.customer_settlement_status);
            }},
            { data: 'supplier_refund_expected', className: 'bc-money', render: function (v, t, row) {
                var pending = parseFloat(row.supplier_refund_expected || 0) - parseFloat(row.supplier_refund_received || 0);
                return money(pending)
                     + '<br><small class="text-muted">of ' + money(v) + '</small>'
                     + '<br>' + settlementPill(row.supplier_settlement_status);
            }},
            { data: 'net_result', className: 'bc-money', render: function (v) {
                v = parseFloat(v || 0);
                var cls = v < 0 ? 'text-danger' : 'text-success';
                return '<span class="fw-bold ' + cls + '">' + money(v) + '</span>';
            }},
            { data: 'cancellation_status', render: statusPill },
            { data: null, className: 'text-center', orderable: false, render: function (v, t, row) {
                return '<a href="' + BC_URL + 'detail/' + row.booking_cancellation_id + '" '
                     + 'class="btn btn-primary btn-xs" title="Open"><i class="la la-eye"></i></a>';
            }}
        ]
    });

    $('#bcApplyFilter').on('click', function () { table.ajax.reload(); });

    $('#bcResetFilter').on('click', function () {
        $('#f_start_date, #f_end_date, #f_quotation_number, #f_guest_name').val('');
        $('#f_reason, #f_status, #f_customer_settlement, #f_supplier_settlement, #f_staff').val('');
        table.ajax.reload();
    });

    // -----------------------------------------------------
    // Create wizard
    // -----------------------------------------------------

    function resetWizard() {
        worksheet = null;
        $('#bc_quotation_id').val('');
        $('#bc_reason_id').val('');
        $('#bc_notes').val('');
        $('#bc_scope').val('FULL');
        $('#bc_guard').val('');
        $('#bc_request_date, #bc_effective_date').val(todayDmy());
        $('#bc_reason_hint').text('');
        $('#bcWorksheetWrap, #bcServiceWrap, #bcBlockers').hide();
        $('#bcPropertyTable tbody, #bcServiceTable tbody').empty();
        $('#bc_days_wrap').empty();
        showStep(1);
    }

    function showStep(n) {
        if (n === 1) {
            $('#bcStep1').show();
            $('#bcStep2').hide();
            $('#bcBackBtn, #bcSubmitBtn').hide();
            $('#bcNextBtn').show();
        } else {
            $('#bcStep1').hide();
            $('#bcStep2').show();
            $('#bcNextBtn').hide();
            $('#bcBackBtn, #bcSubmitBtn').show();
        }
    }

    $('#bcNewBtn').on('click', function () {
        resetWizard();
        $('#bcCreateModal').modal('show');
    });

    $('#bc_reason_id').on('change', function () {
        var opt = $(this).find('option:selected');
        var waivable = opt.data('waivable') == 1;
        var category = opt.data('category') || '';
        if (!$(this).val()) { $('#bc_reason_hint').text(''); return; }
        $('#bc_reason_hint').text(
            waivable
                ? 'Category ' + category + ' \u2014 a zero-charge full refund is allowed for this reason.'
                : 'Category ' + category + ' \u2014 a cancellation charge normally applies.'
        );
    });

    $('#bc_scope').on('change', function () {
        var partial = $(this).val() === 'PARTIAL';
        $('#bcCheckAll').prop('disabled', !partial);
        $('#bcPropertyTable tbody input.bc-prop').prop('disabled', !partial);
        if (!partial) {
            $('#bcPropertyTable tbody input.bc-prop').prop('checked', true);
            $('#bcCheckAll').prop('checked', true);
        }
    });

    $('#bcCheckAll').on('change', function () {
        $('#bcPropertyTable tbody input.bc-prop:not(:disabled)').prop('checked', this.checked);
    });

    $('#bc_quotation_id').on('change', function () {
        var qid = $(this).val();

        $('#bcWorksheetWrap, #bcServiceWrap, #bcBlockers').hide();
        $('#bcNextBtn').prop('disabled', true);
        worksheet = null;

        if (!qid) return;

        $.post(BC_URL + 'ajax_get_worksheet', { quotation_id: qid }, function (res) {
            if (!res.status) {
                $('#bcBlockers').html('<strong>Cannot cancel this booking:</strong><br>' + esc(res.message)).show();
                return;
            }
            worksheet = res.data;
            renderWorksheet();
            $('#bcWorksheetWrap').show();
            $('#bcNextBtn').prop('disabled', false);
        }, 'json').fail(function () {
            toast('error', 'Could not load the booking worksheet');
        });
    });

    function renderWorksheet() {
        var b = worksheet.booking;
        var c = worksheet.customer;

        $('#ws_guest').text(b.guest_name || '-');
        $('#ws_travel').text(dmy(b.start_date) + ' \u2192 ' + dmy(b.end_date));
        $('#ws_package').text(money(c.package_value));
        $('#ws_received').text(money(c.received));
        $('#ws_outstanding').text(money(c.outstanding));
        $('#ws_supplier_booked').text(money(worksheet.supplier_booked));
        $('#ws_supplier_paid').text(money(worksheet.supplier_paid));
        $('#ws_service_paid').text(money(worksheet.service_paid));

        var d = worksheet.days_before;
        if (d !== null && d !== undefined) {
            $('#bc_days_wrap').html(
                '<span class="bc-days-badge' + (d < 0 ? ' is-past' : '') + '">'
                + (d < 0 ? Math.abs(d) + ' day(s) AFTER departure' : d + ' day(s) before travel')
                + '</span>'
            );
        } else {
            $('#bc_days_wrap').empty();
        }

        var partial = $('#bc_scope').val() === 'PARTIAL';
        var rows = '';

        if (!worksheet.properties.length) {
            rows = '<tr><td colspan="9" class="text-center text-muted">No property reservations on this booking</td></tr>';
        } else {
            $.each(worksheet.properties, function (i, p) {
                rows += '<tr>'
                     +  '<td class="text-center"><input type="checkbox" class="bc-prop" value="' + p.property_reservation_id + '" checked' + (partial ? '' : ' disabled') + '></td>'
                     +  '<td>' + esc(p.properties_name) + (p.confirmation_number ? '<br><small class="text-muted">CNF ' + esc(p.confirmation_number) + '</small>' : '') + '</td>'
                     +  '<td>' + dmy(p.check_in_date) + '</td>'
                     +  '<td>' + dmy(p.check_out_date) + '</td>'
                     +  '<td>' + dmy(p.cutoff_date) + '</td>'
                     +  '<td>' + (p.blocking_status === 'BLOCKED'
                            ? '<span class="bc-pill" style="background:#d1e7dd;color:#0f5132">BLOCKED</span>'
                            : '<span class="bc-pill" style="background:#f1f3f5;color:#868e96">NOT BLOCKED</span>') + '</td>'
                     +  '<td class="bc-money">' + money(p.reservation_amount) + '</td>'
                     +  '<td class="bc-money">' + money(p.amount_paid) + '</td>'
                     +  '<td class="bc-money">' + money(p.outstanding) + '</td>'
                     +  '</tr>';
            });
        }
        $('#bcPropertyTable tbody').html(rows);

        if (worksheet.services.length) {
            var srows = '';
            $.each(worksheet.services, function (i, s) {
                srows += '<tr>'
                      +  '<td>' + esc(s.service_type) + '</td>'
                      +  '<td>' + esc(s.vendor_name || '-') + '</td>'
                      +  '<td>' + esc(s.service_description || '-') + '</td>'
                      +  '<td class="bc-money">' + money(s.service_amount) + '</td>'
                      +  '</tr>';
            });
            $('#bcServiceTable tbody').html(srows);
            $('#bcServiceWrap').show();
        } else {
            $('#bcServiceWrap').hide();
        }
    }

    function selectedProperties() {
        var ids = [];
        $('#bcPropertyTable tbody input.bc-prop:checked').each(function () {
            ids.push($(this).val());
        });
        return ids;
    }

    $('#bcNextBtn').on('click', function () {
        if (!worksheet) { toast('error', 'Select a booking first'); return; }

        var errors = [];
        if (!$('#bc_reason_id').val())      { errors.push('Select a cancellation reason'); }
        if (!$('#bc_request_date').val())   { errors.push('Enter the request date'); }
        if (!$('#bc_effective_date').val()) { errors.push('Enter the effective date'); }

        var scope = $('#bc_scope').val();
        var picked = selectedProperties();

        if (scope === 'PARTIAL' && picked.length === 0) {
            errors.push('Select at least one property for a partial cancellation');
        }

        if (errors.length) { toast('error', errors.join('. ')); return; }

        $('#rv_booking').text($('#bc_quotation_id option:selected').text());
        $('#rv_reason').text($('#bc_reason_id option:selected').text());
        $('#rv_scope').text(scope === 'PARTIAL' ? 'Partial (selected properties)' : 'Full cancellation');
        $('#rv_received').text(money(worksheet.customer.received));
        $('#rv_supplier_paid').text(money(worksheet.supplier_paid));
        $('#rv_property_count').text(scope === 'PARTIAL' ? picked.length : worksheet.properties.length);
        $('#rv_effective').text($('#bc_effective_date').val());
        $('#bc_guard').val('');

        showStep(2);
    });

    $('#bcBackBtn').on('click', function () { showStep(1); });

    $('#bcSubmitBtn').on('click', function () {
        if ($.trim($('#bc_guard').val()).toUpperCase() !== 'CANCEL') {
            toast('error', 'Type CANCEL in the confirmation box to proceed');
            return;
        }

        var btn = $(this);
        btn.prop('disabled', true).html('<i class="la la-spinner la-spin me-1"></i> Saving...');

        var payload = {
            quotation_id:                $('#bc_quotation_id').val(),
            cancellation_reason_id_fk:   $('#bc_reason_id').val(),
            cancellation_request_date:   $('#bc_request_date').val(),
            cancellation_effective_date: $('#bc_effective_date').val(),
            cancellation_scope:          $('#bc_scope').val(),
            cancellation_reason_notes:   $('#bc_notes').val(),
            'property_reservation_ids[]': selectedProperties()
        };

        $.post(BC_URL + 'ajax_create_draft', payload, function (res) {
            btn.prop('disabled', false).html('<i class="la la-save me-1"></i> Create Draft');

            if (!res.status) { toast('error', res.message); return; }

            $('#bcCreateModal').modal('hide');
            toast('success', res.message);

            window.location.href = BC_URL + 'detail/' + res.data.booking_cancellation_id;
        }, 'json').fail(function () {
            btn.prop('disabled', false).html('<i class="la la-save me-1"></i> Create Draft');
            toast('error', 'Could not create the cancellation draft');
        });
    });

    // Deep link: /Booking_cancellation/index/<quotation_id>
    var preselect = parseInt($('#bc_preselect_quotation').val() || 0, 10);
    if (preselect > 0) {
        resetWizard();
        $('#bcCreateModal').modal('show');
        $('#bc_quotation_id').val(preselect).trigger('change');
    }

});
</script>
