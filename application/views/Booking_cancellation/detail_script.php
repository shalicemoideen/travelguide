<script>
$(function () {

    var BC_URL = '<?php echo base_url(); ?>index.php/Booking_cancellation/';
    var UPLOADS = '<?php echo base_url(); ?>uploads/cancellation_proofs/';
    var CID    = parseInt($('#bcd_id').val(), 10);

    var state = { header: null, properties: [], services: [], customer_refunds: [],
                  property_refunds: [], adjustments: [], summary: null, permissions: {} };

    // =====================================================
    // Helpers
    // =====================================================

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

    function toast(type, msg) {
        if (typeof notify !== 'undefined') {
            new notify({ style: type === 'error' ? 'error' : 'success', message: msg,
                         timeout: 4000 }).show();
        } else { alert(msg); }
    }

    function pill(text, bg, fg) {
        return '<span class="bcd-pill" style="background:' + bg + ';color:' + fg + '">' + esc(text) + '</span>';
    }

    function statusPill(s) {
        var m = { DRAFT: ['#e9ecef','#495057'], PENDING_APPROVAL: ['#fff3cd','#664d03'],
                  APPROVED: ['#cfe2ff','#084298'], SETTLED: ['#d1e7dd','#0f5132'],
                  REJECTED: ['#f8d7da','#842029'], REVERSED: ['#e2d9f3','#432874'] };
        var c = m[s] || ['#e9ecef','#495057'];
        return pill(String(s).replace(/_/g, ' '), c[0], c[1]);
    }

    function settlePill(s) {
        var m = { NOT_APPLICABLE: ['#f1f3f5','#868e96'], PENDING: ['#fff3cd','#664d03'],
                  PARTIAL: ['#ffe5d0','#8a4b0a'], COMPLETED: ['#d1e7dd','#0f5132'],
                  WRITTEN_OFF: ['#f8d7da','#842029'] };
        var c = m[s] || ['#f1f3f5','#868e96'];
        return pill(String(s).replace(/_/g, ' '), c[0], c[1]);
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

    function todayDmy() {
        var d = new Date();
        return ('0' + d.getDate()).slice(-2) + '/' + ('0' + (d.getMonth() + 1)).slice(-2) + '/' + d.getFullYear();
    }

    function bindDates(scope) {
        $(scope || document).find('.bcd-date').datepicker({
            format: 'dd/mm/yyyy', autoclose: true, todayHighlight: true
        });
    }
    bindDates();

    /*
     * SweetAlert2 compatibility shim.
     * The app currently bundles SweetAlert2 v7.33.1, where the modal is invoked
     * as Swal({...}) / swal({...}) (no .fire()), the icon option is `type`, and
     * .then() resolves to {value:...} on confirm / {dismiss:...} on cancel --
     * there is no `isConfirmed`. This normalises v7, v8 and v9+ so the callbacks
     * fire reliably. Falls back to native confirm/prompt if the library is absent.
     */
    function swalRun(options) {
        var fn = null;
        if (typeof Swal !== 'undefined') {
            if (typeof Swal.fire === 'function') { fn = function (o) { return Swal.fire(o); }; } // v8+
            else if (typeof Swal === 'function')  { fn = Swal; }                                  // v7
        }
        if (!fn && typeof swal === 'function') { fn = swal; }                                     // v7 lowercase alias
        if (!fn) { return null; }

        return fn(options).then(function (r) {
            if (r === true) { return { confirmed: true, value: true }; }
            if (r && typeof r === 'object') {
                if (r.dismiss) { return { confirmed: false }; }               // cancelled / backdrop / esc
                if (r.isConfirmed === false) { return { confirmed: false }; }
                return { confirmed: true, value: (r.value !== undefined ? r.value : true) };
            }
            return { confirmed: (r !== undefined && r !== null), value: r };
        }, function () {
            return { confirmed: false };                                       // v7 rejects the promise on dismiss
        });
    }

    function confirmThen(title, text, confirmText, cb) {
        var p = swalRun({ title: title, html: text, type: 'warning', icon: 'warning',
                          showCancelButton: true, confirmButtonText: confirmText,
                          confirmButtonColor: '#d64550' });
        if (p) { p.then(function (r) { if (r.confirmed) cb(); }); }
        else if (confirm(title)) { cb(); }
    }

    function promptThen(title, label, cb) {
        var p = swalRun({ title: title, input: 'textarea', inputLabel: label, inputPlaceholder: label,
                          inputValidator: function (v) { return (!v || !$.trim(v)) ? 'This is required' : null; },
                          showCancelButton: true, confirmButtonColor: '#d64550' });
        if (p) { p.then(function (r) { if (r.confirmed && r.value && $.trim(r.value)) cb(r.value); }); }
        else { var v = prompt(label); if (v && $.trim(v)) cb(v); }
    }

    function isMoneyOpen() {
        return state.summary && ['APPROVED', 'SETTLED'].indexOf(state.summary.cancellation_status) >= 0;
    }

    function proofLink(file) {
        return file ? '<a href="' + UPLOADS + encodeURIComponent(file) + '" target="_blank" '
                    + 'class="btn btn-outline-secondary btn-xs"><i class="la la-paperclip"></i></a>'
                    : '<span class="text-muted">-</span>';
    }

    // =====================================================
    // Load & render
    // =====================================================

    function load() {
        $.post(BC_URL + 'ajax_get_cancellation', { booking_cancellation_id: CID }, function (res) {
            if (!res.status) { toast('error', res.message); return; }
            state = res.data;
            renderAll();
        }, 'json').fail(function () { toast('error', 'Could not load the cancellation'); });
    }

    function renderAll() {
        /* Render each section in isolation: a failure in one (e.g. a freshly
           created row with an unexpected field) must never abort the rest,
           otherwise the ledger looks like it "did not reload". */
        var steps = [renderSummary, renderCustomerRefunds, renderProperties, renderServices, renderAdjustments];
        for (var i = 0; i < steps.length; i++) {
            try { steps[i](); }
            catch (e) { if (window.console && console.error) { console.error('Cancellation render step failed:', e); } }
        }
    }

    /* Write endpoints return a fresh summary; refetch the rest so ledgers stay in sync. */
    function afterWrite(res, closeModal) {
        if (!res.status) { toast('error', res.message); return false; }
        /* The toast / modal-hide steps must never prevent the reload below.
           If any of them throw, the write already succeeded server-side, so we
           still refresh the screen instead of leaving it stale until a manual reload. */
        try {
            toast('success', res.message);
            if (closeModal) { $(closeModal).modal('hide'); }
            if (res.data && res.data.summary) { state.summary = res.data.summary; renderSummary(); }
        } catch (e) {
            if (window.console && console.error) { console.error('Cancellation post-save step failed:', e); }
        }
        load();
        return true;
    }

    function renderSummary() {
        var s = state.summary;
        if (!s) return;

        $('#bcd_status_pill').html(statusPill(s.cancellation_status));

        $('#t_package').text(money(s.package_value));
        $('#t_received').text(money(s.customer_received));
        $('#t_charge').text(money(s.customer_cancellation_charge));
        $('#t_cust_balance').text(money(s.customer_refund_balance));
        $('#t_cust_pill').html(settlePill(s.customer_settlement_status));

        $('#t_supp_paid').text(money(s.supplier_paid));
        $('#t_supp_expected').text(money(s.supplier_refund_expected));
        $('#t_supp_pending').text(money(s.supplier_refund_pending));
        $('#t_supp_pill').html(settlePill(s.supplier_settlement_status));

        var net = parseFloat(s.net_result || 0);
        $('#t_net').text(money(net)).removeClass('text-danger text-success')
                   .addClass(net < 0 ? 'text-danger' : 'text-success');
        $('#t_net_tile').removeClass('accent-red accent-green')
                        .addClass(net < 0 ? 'accent-red' : 'accent-green');
        $('#t_net_note').text(net < 0 ? 'Loss to the company' : 'Profit retained');

        $('#p_retained').text(money(s.net_retained_from_customer));
        $('#p_suppliers').text(money(s.net_paid_to_suppliers));
        $('#p_other').text(money(s.net_other_cost));
        $('#p_adjust').text(money(s.net_adjustment_total))
                      .removeClass('text-danger text-success')
                      .addClass(parseFloat(s.net_adjustment_total) < 0 ? 'text-danger' : 'text-success');
        $('#p_net').text(money(net)).removeClass('text-danger text-success')
                   .addClass(net < 0 ? 'text-danger' : 'text-success');

        $('#p_package').text(money(s.package_value));
        $('#p_received').text(money(s.customer_received));
        $('#p_outstanding').text(money(s.customer_outstanding));
        $('#p_supp_booked').text(money(s.supplier_booked));
        $('#p_supp_paid').text(money(s.supplier_paid));
        $('#p_supp_charge').text(money(s.supplier_cancellation_charge));
        $('#p_supp_payable').text(money(s.supplier_still_payable));

        $('#cc_amount').val(parseFloat(s.customer_cancellation_charge || 0).toFixed(2));
        $('#cc_suggested').val(money(parseFloat(s.supplier_cancellation_charge || 0)
                                    + parseFloat(s.net_other_cost || 0)));
        $('#cr_balance_hint').text(money(s.customer_refund_balance));

        /* Nothing left to refund -> no point offering the button */
        $('#crAddBtn').prop('disabled', parseFloat(s.customer_refund_balance || 0) <= 0.009);
    }

    // -----------------------------------------------------
    // Customer refund ledger
    // -----------------------------------------------------

    function renderCustomerRefunds() {
        var perms = state.permissions || {};
        var rows  = '';

        if (!state.customer_refunds.length) {
            rows = '<tr><td colspan="9" class="text-center text-muted">No refunds recorded yet</td></tr>';
        } else {
            $.each(state.customer_refunds, function (i, r) {
                var isRev = r.refund_entry_type === 'REVERSAL';
                var appr  = r.accountant_approval_status;

                var apprHtml = appr === 'approved' ? pill('APPROVED', '#d1e7dd', '#0f5132')
                             : appr === 'rejected' ? pill('REJECTED', '#f8d7da', '#842029')
                             : pill('PENDING', '#fff3cd', '#664d03');

                var actions = '';
                if (!isRev && appr === 'pending' && perms.refund_approve) {
                    actions += '<button class="btn btn-success btn-xs cr-approve me-1" data-id="' + r.customer_refund_id
                            +  '" data-decision="approved" title="Approve"><i class="la la-check"></i></button>'
                            +  '<button class="btn btn-warning btn-xs cr-approve me-1" data-id="' + r.customer_refund_id
                            +  '" data-decision="rejected" title="Reject"><i class="la la-times"></i></button>';
                }
                if (!isRev && perms.refund_reverse) {
                    actions += '<button class="btn btn-outline-danger btn-xs cr-reverse" data-id="' + r.customer_refund_id
                            +  '" title="Reverse this entry"><i class="la la-undo"></i></button>';
                }
                if (!actions) { actions = '<span class="text-muted">-</span>'; }

                rows += '<tr' + (isRev ? ' class="table-light"' : '') + '>'
                     +  '<td>' + r.customer_refund_id + (isRev ? ' ' + pill('REVERSAL', '#e2d9f3', '#432874') : '') + '</td>'
                     +  '<td>' + dmy(r.refund_date) + '</td>'
                     +  '<td>' + esc(r.refund_mode || '-') + '</td>'
                     +  '<td>' + esc(r.refund_reference || '-') + '</td>'
                     +  '<td class="bcd-money ' + (isRev ? 'text-danger' : '') + '">'
                     +      (isRev ? '-' : '') + money(r.refund_amount) + '</td>'
                     +  '<td>' + apprHtml + '</td>'
                     +  '<td>' + esc(r.refund_paid_by_username || '-') + '</td>'
                     +  '<td>' + proofLink(r.refund_proof_file) + '</td>'
                     +  '<td class="text-center">' + actions + '</td>'
                     +  '</tr>';
            });
        }

        $('#crTable tbody').html(rows);
    }

    // -----------------------------------------------------
    // Property lines
    // -----------------------------------------------------

    function refundsForLine(lineId) {
        return $.grep(state.property_refunds, function (r) {
            return parseInt(r.cancellation_property_id_fk, 10) === parseInt(lineId, 10);
        });
    }

    function renderProperties() {
        var perms = state.permissions || {};
        var open  = isMoneyOpen();
        var html  = '';

        $('#cnt_properties').text(state.properties.length);

        if (!state.properties.length) {
            $('#propertyCards').html('<div class="alert alert-secondary">No property reservations in scope.</div>');
            return;
        }

        $.each(state.properties, function (i, p) {
            var pending  = parseFloat(p.refund_pending || 0);
            var payable  = parseFloat(p.still_payable_to_property || 0);
            var expected = parseFloat(p.refund_expected || 0);
            var refunds  = refundsForLine(p.cancellation_property_id);

            var overdue = false;
            if (p.expected_refund_by_date && p.expected_refund_by_date !== '0000-00-00' && pending > 0.009) {
                overdue = new Date(p.expected_refund_by_date) < new Date(new Date().toDateString());
            }

            var btns = '';
            if (perms.charge && ['REJECTED', 'REVERSED'].indexOf(state.summary.cancellation_status) < 0) {
                btns += '<button class="btn btn-primary btn-sm pc-open me-1" data-id="' + p.cancellation_property_id + '">'
                     +  '<i class="la la-edit me-1"></i>Charge</button>';
            }
            if (open && perms.refund_supplier && pending > 0.009) {
                btns += '<button class="btn btn-success btn-sm pr-open me-1" data-id="' + p.cancellation_property_id + '">'
                     +  '<i class="la la-download me-1"></i>Refund Received</button>';
            }
            if (open && perms.charge && pending > 0.009 && p.line_status !== 'REFUSED') {
                btns += '<button class="btn btn-outline-danger btn-sm pl-refuse me-1" data-id="' + p.cancellation_property_id + '">'
                     +  '<i class="la la-ban me-1"></i>Refused</button>';
            }
            if (open && perms.adjust && pending > 0.009) {
                btns += '<button class="btn btn-outline-warning btn-sm pl-writeoff me-1" data-id="' + p.cancellation_property_id + '">'
                     +  '<i class="la la-eraser me-1"></i>Write Off</button>';
            }
            if (open && pending > 0.009) {
                btns += '<button class="btn btn-outline-secondary btn-sm pl-followup" data-id="' + p.cancellation_property_id + '">'
                     +  '<i class="la la-phone me-1"></i>Log Follow-up</button>';
            }

            var refundRows = '';
            if (refunds.length) {
                $.each(refunds, function (j, r) {
                    var isRev = r.refund_entry_type === 'REVERSAL';
                    var act = (!isRev && perms.refund_reverse)
                        ? '<button class="btn btn-outline-danger btn-xs pr-reverse" data-id="' + r.property_refund_id
                          + '" title="Reverse"><i class="la la-undo"></i></button>'
                        : '<span class="text-muted">-</span>';

                    refundRows += '<tr' + (isRev ? ' class="table-light"' : '') + '>'
                               +  '<td>' + dmy(r.refund_date) + '</td>'
                               +  '<td>' + esc(r.refund_mode || '-')
                               +      (isRev ? ' ' + pill('REVERSAL', '#e2d9f3', '#432874') : '') + '</td>'
                               +  '<td>' + esc(r.refund_reference || '-') + '</td>'
                               +  '<td class="bcd-money ' + (isRev ? 'text-danger' : '') + '">'
                               +      (isRev ? '-' : '') + money(r.refund_amount) + '</td>'
                               +  '<td>' + esc(r.refund_received_by_username || '-') + '</td>'
                               +  '<td>' + proofLink(r.refund_proof_file) + '</td>'
                               +  '<td class="text-center">' + act + '</td>'
                               +  '</tr>';
                });
            } else {
                refundRows = '<tr><td colspan="7" class="text-center text-muted">No refund received yet</td></tr>';
            }

            html += '<div class="card mb-3" style="border:1px solid #e5e7eb;">'
                 +  '<div class="card-body p-3">'

                 +  '<div class="d-flex justify-content-between align-items-start flex-wrap gap-2 mb-3">'
                 +      '<div>'
                 +          '<div class="fw-bold" style="font-size:15px;">' + esc(p.snap_property_name) + '</div>'
                 +          '<div class="text-muted" style="font-size:12px;">'
                 +              dmy(p.snap_check_in_date) + ' \u2192 ' + dmy(p.snap_check_out_date)
                 +              ' &middot; ' + (p.snap_duration_nights || 0) + 'N'
                 +              (p.snap_confirmation_number ? ' &middot; CNF ' + esc(p.snap_confirmation_number) : '')
                 +          '</div>'
                 +      '</div>'
                 +      '<div class="text-end">'
                 +          linePill(p.line_status)
                 +          (overdue ? ' ' + pill('OVERDUE', '#f8d7da', '#842029') : '')
                 +          (parseInt(p.followup_count, 10) > 0
                                ? '<div class="text-muted mt-1" style="font-size:11px;">'
                                  + p.followup_count + ' follow-up(s), last ' + dmy(p.last_followup_date) + '</div>' : '')
                 +      '</div>'
                 +  '</div>'

                 +  '<div class="row g-2 mb-3">'
                 +      tile('Reserved', money(p.snap_reservation_amount))
                 +      tile('Paid', money(p.snap_amount_paid))
                 +      tile('Hotel Charge', money(p.cancellation_charge))
                 +      tile('Refund Expected', money(expected))
                 +      tile('Received', money(p.refund_received), 'text-success')
                 +      tile('Pending', money(pending), pending > 0.009 ? 'text-danger' : '')
                 +  '</div>';

            if (payable > 0.009) {
                html += '<div class="alert alert-warning py-2 mb-3" style="font-size:13px;">'
                     +  '<i class="la la-exclamation-triangle me-1"></i>'
                     +  'The hotel charge exceeds what we paid. <strong>' + money(payable)
                     +  '</strong> is still payable to this property.</div>';
            }

            if (parseFloat(p.amount_written_off || 0) > 0.009) {
                html += '<div class="alert alert-danger py-2 mb-3" style="font-size:13px;">'
                     +  'Written off: <strong>' + money(p.amount_written_off) + '</strong></div>';
            }

            if (p.refusal_reason) {
                html += '<div class="alert alert-danger py-2 mb-3" style="font-size:13px;">'
                     +  'Refund refused: ' + esc(p.refusal_reason) + '</div>';
            }

            html += '<div class="mb-2">' + btns + '</div>';

            if (p.charge_confirmed_by || p.charge_confirmed_date !== null || p.expected_refund_by_date) {
                html += '<div class="text-muted mb-2" style="font-size:12px;">'
                     +  'Charge basis: <strong>' + esc(String(p.charge_basis || '-').replace(/_/g, ' ')) + '</strong>'
                     +  (p.charge_confirmed_by ? ' &middot; confirmed by ' + esc(p.charge_confirmed_by) : '')
                     +  (p.charge_confirmed_date && p.charge_confirmed_date !== '0000-00-00'
                            ? ' on ' + dmy(p.charge_confirmed_date) : '')
                     +  (p.expected_refund_by_date && p.expected_refund_by_date !== '0000-00-00'
                            ? ' &middot; refund expected by <strong>' + dmy(p.expected_refund_by_date) + '</strong>' : '')
                     +  (p.charge_proof_file ? ' ' + proofLink(p.charge_proof_file) : '')
                     +  '</div>';
            }

            html += '<div class="table-responsive">'
                 +  '<table class="table table-sm table-bordered bcd-sub-table mb-0">'
                 +      '<thead><tr><th>Date</th><th>Mode</th><th>Reference</th>'
                 +      '<th class="bcd-money">Amount</th><th>By</th><th>Proof</th>'
                 +      '<th class="text-center">Action</th></tr></thead>'
                 +      '<tbody>' + refundRows + '</tbody>'
                 +  '</table></div>';

            if (p.line_remarks) {
                html += '<div class="mt-2 text-muted" style="font-size:12px;white-space:pre-wrap;">'
                     +  esc(p.line_remarks) + '</div>';
            }

            html += '</div></div>';
        });

        $('#propertyCards').html(html);
    }

    function tile(label, value, cls) {
        return '<div class="col-md-2 col-6"><div class="bcd-tile p-2">'
             + '<div class="lbl">' + esc(label) + '</div>'
             + '<div class="val bcd-money ' + (cls || '') + '" style="font-size:14px;">' + value + '</div>'
             + '</div></div>';
    }

    // -----------------------------------------------------
    // Services
    // -----------------------------------------------------

    function renderServices() {
        var perms = state.permissions || {};
        var editable = perms.charge && ['REJECTED', 'REVERSED'].indexOf(state.summary.cancellation_status) < 0;
        var rows = '';

        $('#cnt_services').text(state.services.length);

        if (!state.services.length) {
            rows = '<tr><td colspan="10" class="text-center text-muted">'
                 + 'No service lines. Add transport, visa or guide costs so the net result is complete.</td></tr>';
        } else {
            $.each(state.services, function (i, s) {
                rows += '<tr>'
                     +  '<td>' + esc(String(s.service_type).replace(/_/g, ' ')) + '</td>'
                     +  '<td>' + esc(s.vendor_name || '-') + '</td>'
                     +  '<td>' + esc(s.service_description || '-') + '</td>'
                     +  '<td class="bcd-money">' + money(s.snap_service_amount) + '</td>'
                     +  '<td class="bcd-money">' + money(s.snap_amount_paid) + '</td>'
                     +  '<td class="bcd-money">' + money(s.cancellation_charge) + '</td>'
                     +  '<td class="bcd-money">' + money(s.refund_expected) + '</td>'
                     +  '<td class="bcd-money">' + money(s.refund_received) + '</td>'
                     +  '<td>' + (parseInt(s.is_recoverable, 10) === 1
                            ? pill('YES', '#d1e7dd', '#0f5132') : pill('NO', '#f8d7da', '#842029')) + '</td>'
                     +  '<td class="text-center">' + (editable
                            ? '<button class="btn btn-primary btn-xs svc-edit" data-id="' + s.cancellation_service_id
                              + '"><i class="la la-edit"></i></button>'
                            : '<span class="text-muted">-</span>') + '</td>'
                     +  '</tr>';
            });
        }

        $('#svcTable tbody').html(rows);
    }

    // -----------------------------------------------------
    // Adjustments
    // -----------------------------------------------------

    function renderAdjustments() {
        var rows = '';
        $('#cnt_adjustments').text(state.adjustments.length);

        if (!state.adjustments.length) {
            rows = '<tr><td colspan="8" class="text-center text-muted">No adjustments</td></tr>';
        } else {
            $.each(state.adjustments, function (i, a) {
                var credit = a.adjustment_direction === 'CREDIT';
                var canDelete = true;
                rows += '<tr>'
                     +  '<td>' + esc(String(a.adjustment_type).replace(/_/g, ' ')) + '</td>'
                     +  '<td>' + esc(a.adjustment_side) + '</td>'
                     +  '<td>' + (credit ? pill('CREDIT', '#d1e7dd', '#0f5132') : pill('DEBIT', '#f8d7da', '#842029')) + '</td>'
                     +  '<td class="bcd-money ' + (credit ? 'text-success' : 'text-danger') + '">'
                     +      (credit ? '+' : '-') + money(a.adjustment_amount) + '</td>'
                     +  '<td style="white-space:pre-wrap;">' + esc(a.adjustment_reason) + '</td>'
                     +  '<td>' + esc(a.adjustment_created_by_username || '-') + '</td>'
                     +  '<td>' + dmy(a.adjustment_created_datetime) + '</td>'
                     +  '<td class="text-center">'
                     +    (canDelete
                          ? '<button class="btn btn-danger btn-xs bc-delete-adj" data-id="' + a.cancellation_adjustment_id + '" title="Delete"><i class="la la-trash"></i></button>'
                          : '-')
                     +  '</td>'
                     +  '</tr>';
            });
        }

        $('#adjTable tbody').html(rows);
    }

    $(document).on('click', '.bc-delete-adj', function () {
        var id = $(this).data('id');
        confirmThen('Delete this adjustment?',
            'The adjustment will be removed and the P&L recalculated.',
            'Delete', function () {
                $.post(BC_URL + 'ajax_delete_adjustment',
                    { cancellation_adjustment_id: id }, function (res) {
                        afterWrite(res);
                    }, 'json');
            });
    });

    // =====================================================
    // Lifecycle actions
    // =====================================================

    $('#bcdSubmitApproval').on('click', function () {
        confirmThen('Submit for approval?',
            'The approver will be able to cancel the booking. You will not be able to edit the reason or dates afterwards.',
            'Submit', function () {
                $.post(BC_URL + 'ajax_submit_for_approval', { booking_cancellation_id: CID }, function (res) {
                    if (!res.status) { toast('error', res.message); return; }
                    toast('success', res.message);
                    location.reload();
                }, 'json');
            });
    });

    $('#bcdApprove').on('click', function () {
        confirmThen('Approve this cancellation?',
            'The booking status will change to <strong>Cancelled</strong> and refund recording will unlock. '
            + 'This is the point of no return for the booking.',
            'Approve &amp; Cancel Booking', function () {
                $.post(BC_URL + 'ajax_approve_cancellation', { booking_cancellation_id: CID }, function (res) {
                    if (!res.status) { toast('error', res.message); return; }
                    toast('success', res.message);
                    location.reload();
                }, 'json');
            });
    });

    $('#bcdReject').on('click', function () {
        promptThen('Reject this cancellation', 'Why is it being rejected?', function (reason) {
            $.post(BC_URL + 'ajax_reject_cancellation',
                { booking_cancellation_id: CID, rejected_reason: reason }, function (res) {
                    if (!res.status) { toast('error', res.message); return; }
                    toast('success', res.message);
                    location.reload();
                }, 'json');
        });
    });

    $('#bcdReverse').on('click', function () {
        promptThen('Reverse this cancellation',
            'The booking will be restored to its previous status. Only possible while no money has moved.',
            function (reason) {
                $.post(BC_URL + 'ajax_reverse_cancellation',
                    { booking_cancellation_id: CID, reversed_reason: reason }, function (res) {
                        if (!res.status) { toast('error', res.message); return; }
                        toast('success', res.message);
                        location.reload();
                    }, 'json');
            });
    });

    $('#hdSave').on('click', function () {
        $.post(BC_URL + 'ajax_update_draft', {
            booking_cancellation_id:     CID,
            cancellation_reason_id_fk:   $('#hd_reason').val(),
            cancellation_request_date:   $('#hd_request_date').val(),
            cancellation_effective_date: $('#hd_effective_date').val(),
            cancellation_reason_notes:   $('#hd_notes').val()
        }, function (res) { afterWrite(res); }, 'json');
    });

    // =====================================================
    // Customer charge & refunds
    // =====================================================

    $('#ccSave').on('click', function () {
        var btn = $(this).prop('disabled', true)
            .html('<i class="la la-spinner la-spin me-1"></i> Saving...');
        $.post(BC_URL + 'ajax_save_customer_charge', {
            booking_cancellation_id:       CID,
            customer_cancellation_charge:  $('#cc_amount').val(),
            customer_charge_is_override:   $('#cc_override').is(':checked') ? 1 : 0,
            customer_charge_override_note: $('#cc_note').val()
        }, function (res) {
            if (res.status) {
                btn.prop('disabled', false).html('<i class="la la-save me-1"></i> Save Charge');
                afterWrite(res);
            } else {
                btn.prop('disabled', false).html('<i class="la la-save me-1"></i> Save Charge');
                toast('error', res.message);
            }
        }, 'json').fail(function () {
            btn.prop('disabled', false).html('<i class="la la-save me-1"></i> Save Charge');
            toast('error', 'Could not save the charge');
        });
    });

    $('#crAddBtn').on('click', function () {
        $('#crForm')[0].reset();
        $('#cr_date').val(todayDmy());
        $('#cr_amount').val(parseFloat(state.summary.customer_refund_balance || 0).toFixed(2));
        $('#cr_balance_hint').text(money(state.summary.customer_refund_balance));
        $('#crModal').modal('show');
    });

    $('#crForm').on('submit', function (e) {
        e.preventDefault();

        var fd = new FormData(this);
        fd.append('booking_cancellation_id', CID);

        var btn = $(this).find('button[type=submit]').prop('disabled', true);

        $.ajax({
            url: BC_URL + 'ajax_add_customer_refund',
            type: 'POST', data: fd, processData: false, contentType: false, dataType: 'json',
            success: function (res) { btn.prop('disabled', false); afterWrite(res, '#crModal'); },
            error: function () { btn.prop('disabled', false); toast('error', 'Could not save the refund'); }
        });
    });

    $(document).on('click', '.cr-approve', function () {
        var id = $(this).data('id'), decision = $(this).data('decision');
        confirmThen('Mark this refund as ' + decision + '?', '', 'Confirm', function () {
            $.post(BC_URL + 'ajax_approve_customer_refund',
                { customer_refund_id: id, decision: decision }, function (res) {
                    afterWrite(res);
                }, 'json');
        });
    });

    $(document).on('click', '.cr-reverse', function () {
        var id = $(this).data('id');
        promptThen('Reverse this refund',
            'A contra entry will be added. The original row stays for audit.', function (reason) {
                $.post(BC_URL + 'ajax_reverse_customer_refund',
                    { customer_refund_id: id, refund_remarks: reason }, function (res) {
                        afterWrite(res);
                    }, 'json');
            });
    });

    // =====================================================
    // Property charge & refunds
    // =====================================================

    function findLine(id) {
        var found = null;
        $.each(state.properties, function (i, p) {
            if (parseInt(p.cancellation_property_id, 10) === parseInt(id, 10)) { found = p; }
        });
        return found;
    }

    function recalcPcPreview() {
        var paid   = parseFloat($('#pc_paid').data('raw') || 0);
        var charge = parseFloat($('#pc_charge').val() || 0);
        $('#pc_expected').val(money(Math.max(0, paid - charge)));
        $('#pc_payable').val(money(Math.max(0, charge - paid)));
    }

    $('#pc_charge').on('input', recalcPcPreview);

    $('#pc_percentage').on('input', function () {
        var pct = parseFloat($(this).val() || 0);
        var reserved = parseFloat($('#pc_charge').data('reserved') || 0);
        if (pct > 0 && reserved > 0) {
            $('#pc_charge').val((reserved * pct / 100).toFixed(2));
            recalcPcPreview();
        }
    });

    $(document).on('click', '.pc-open', function () {
        var p = findLine($(this).data('id'));
        if (!p) return;

        $('#pc_line_id').val(p.cancellation_property_id);
        $('#pc_title').text(p.snap_property_name);
        $('#pc_paid').val(money(p.snap_amount_paid)).data('raw', p.snap_amount_paid);
        $('#pc_charge').val(parseFloat(p.cancellation_charge || 0).toFixed(2))
                       .data('reserved', p.snap_reservation_amount);
        $('#pc_basis').val(p.charge_basis || 'NEGOTIATED');
        $('#pc_percentage').val(p.charge_percentage || '');
        $('#pc_cnfm_by').val(p.charge_confirmed_by || '');
        $('#pc_cnfm_date').val(p.charge_confirmed_date && p.charge_confirmed_date !== '0000-00-00'
                                ? dmy(p.charge_confirmed_date) : '');
        $('#pc_expected_by').val(p.expected_refund_by_date && p.expected_refund_by_date !== '0000-00-00'
                                ? dmy(p.expected_refund_by_date) : '');
        $('#pc_remarks').val('');
        $('#pcForm input[name=charge_proof_file]').val('');

        recalcPcPreview();
        $('#pcModal').modal('show');
    });

    $('#pcForm').on('submit', function (e) {
        e.preventDefault();
        var fd  = new FormData(this);
        var btn = $(this).find('button[type=submit]').prop('disabled', true);

        $.ajax({
            url: BC_URL + 'ajax_save_property_charge',
            type: 'POST', data: fd, processData: false, contentType: false, dataType: 'json',
            success: function (res) { btn.prop('disabled', false); afterWrite(res, '#pcModal'); },
            error: function () { btn.prop('disabled', false); toast('error', 'Could not save the charge'); }
        });
    });

    $(document).on('click', '.pr-open', function () {
        var p = findLine($(this).data('id'));
        if (!p) return;

        var pending = parseFloat(p.refund_pending || 0);

        $('#prForm')[0].reset();
        $('#pr_line_id').val(p.cancellation_property_id);
        $('#pr_title').text(p.snap_property_name);
        $('#pr_pending_hint').text(money(pending));
        $('#pr_amount').val(pending.toFixed(2));
        $('#pr_date').val(todayDmy());
        $('#pr_adjust_wrap').hide();
        $('#prModal').modal('show');
    });

    $('#pr_mode').on('change', function () {
        $('#pr_adjust_wrap').toggle($(this).val() === 'ADJUSTED' || $(this).val() === 'CREDIT_NOTE');
    });

    $('#prForm').on('submit', function (e) {
        e.preventDefault();
        var fd  = new FormData(this);
        var btn = $(this).find('button[type=submit]').prop('disabled', true);

        $.ajax({
            url: BC_URL + 'ajax_add_property_refund',
            type: 'POST', data: fd, processData: false, contentType: false, dataType: 'json',
            success: function (res) { btn.prop('disabled', false); afterWrite(res, '#prModal'); },
            error: function () { btn.prop('disabled', false); toast('error', 'Could not save the refund'); }
        });
    });

    $(document).on('click', '.pr-reverse', function () {
        var id = $(this).data('id');
        promptThen('Reverse this refund', 'A contra entry will be added.', function (reason) {
            $.post(BC_URL + 'ajax_reverse_property_refund',
                { property_refund_id: id, refund_remarks: reason }, function (res) {
                    afterWrite(res);
                }, 'json');
        });
    });

    $(document).on('click', '.pl-refuse', function () {
        var id = $(this).data('id');
        promptThen('Mark refund as refused',
            'Record what the hotel said. The pending amount stays visible until written off.', function (reason) {
                $.post(BC_URL + 'ajax_mark_property_refused',
                    { cancellation_property_id: id, refusal_reason: reason }, function (res) {
                        afterWrite(res);
                    }, 'json');
            });
    });

    $(document).on('click', '.pl-writeoff', function () {
        var p = findLine($(this).data('id'));
        if (!p) return;
        var id = p.cancellation_property_id;

        promptThen('Write off ' + money(p.refund_pending) + '?',
            'This books the unrecovered amount as a company loss and closes the line.', function (reason) {
                $.post(BC_URL + 'ajax_write_off_property',
                    { cancellation_property_id: id, adjustment_reason: reason }, function (res) {
                        afterWrite(res);
                    }, 'json');
            });
    });

    $(document).on('click', '.pl-followup', function () {
        var id = $(this).data('id');
        promptThen('Log a follow-up', 'What did the property say?', function (note) {
            $.post(BC_URL + 'ajax_log_property_followup',
                { cancellation_property_id: id, followup_note: note }, function (res) {
                    afterWrite(res);
                }, 'json');
        });
    });

    // =====================================================
    // Services
    // =====================================================

    $('#svcAddBtn').on('click', function () {
        $('#svcForm')[0].reset();
        $('#svc_id').val('');
        $('#svc_recoverable').prop('checked', true);
        $('#svc_type').prop('disabled', false);
        $('#svcModal').modal('show');
    });

    $(document).on('click', '.svc-edit', function () {
        var id = parseInt($(this).data('id'), 10);
        var s  = null;
        $.each(state.services, function (i, row) {
            if (parseInt(row.cancellation_service_id, 10) === id) { s = row; }
        });
        if (!s) return;

        $('#svc_id').val(s.cancellation_service_id);
        $('#svc_type').val(s.service_type).prop('disabled', true);
        $('#svc_vendor').val(s.vendor_name || '');
        $('#svc_desc').val(s.service_description || '');
        $('#svc_amount').val(parseFloat(s.snap_service_amount || 0).toFixed(2));
        $('#svc_paid').val(parseFloat(s.snap_amount_paid || 0).toFixed(2));
        $('#svc_charge').val(parseFloat(s.cancellation_charge || 0).toFixed(2));
        $('#svc_received').val(parseFloat(s.refund_received || 0).toFixed(2));
        $('#svc_recoverable').prop('checked', parseInt(s.is_recoverable, 10) === 1);
        $('#svc_remarks').val(s.service_remarks || '');

        $('#svcModal').modal('show');
    });

    $('#svcForm').on('submit', function (e) {
        e.preventDefault();
        var data = $(this).serialize() + '&service_type=' + encodeURIComponent($('#svc_type').val());
        var btn  = $(this).find('button[type=submit]').prop('disabled', true);

        $.post(BC_URL + 'ajax_save_service_line', data, function (res) {
            btn.prop('disabled', false);
            afterWrite(res, '#svcModal');
        }, 'json').fail(function () {
            btn.prop('disabled', false);
            toast('error', 'Could not save the service line');
        });
    });

    // =====================================================
    // Adjustments
    // =====================================================

    $('#adjAddBtn').on('click', function () {
        $('#adjForm')[0].reset();
        $('#adjModal').modal('show');
    });

    $('#adjForm').on('submit', function (e) {
        e.preventDefault();
        var btn = $(this).find('button[type=submit]').prop('disabled', true)
            .html('<i class="la la-spinner la-spin me-1"></i> Saving...');

        $.post(BC_URL + 'ajax_add_adjustment', $(this).serialize(), function (res) {
            if (res.status) {
                $('#adjForm')[0].reset();
                btn.prop('disabled', false).html('<i class="la la-save me-1"></i> Save');
                afterWrite(res, '#adjModal');
            } else {
                btn.prop('disabled', false).html('<i class="la la-save me-1"></i> Save');
                toast('error', res.message);
            }
        }, 'json').fail(function () {
            btn.prop('disabled', false).html('<i class="la la-save me-1"></i> Save');
            toast('error', 'Could not save the adjustment');
        });
    });

    // =====================================================
    load();
});
</script>
