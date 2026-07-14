<script type="text/javascript">
var base_url = '<?php echo base_url(); ?>';
var currentProperties = [];   // cached property list (with derived dates) for selected booking+option
var pr_current_quotation_id = 0;
var pr_current_properties_id = 0;
var pr_checkin_date = '';
var pr_current_scheduler_id = 0;

$(document).ready(function() {

    $('#cutoff_date_display').datepicker({
        format: 'dd/mm/yyyy',
        autoclose: true,
        todayHighlight: true
    }).on('changeDate', function() {
        var p = $(this).val().split('/');
        $('#cutoff_date').val(p.length === 3 ? p[2] + '-' + p[1] + '-' + p[0] : '');
    });

    // Preselect booking when opened from the Quote Hub
    var preselect = $('#preselect_quotation').val();
    if (preselect && preselect != 0) {
        $('#booking_select').val(preselect).trigger('change');
    }

    $('#booking_select').change(function() {
        var quotation_id = $(this).val();
        resetPanel();
        $('#option_wrap').hide();
        $('#property_select').prop('disabled', true).html('<option value="">Select Property</option>');
        if (!quotation_id) return;

        $.ajax({
            url: base_url + 'property_reservation/ajax_get_options',
            type: 'POST',
            data: { quotation_id: quotation_id },
            dataType: 'json',
            success: function(res) {
                var opts = (res.data || []);
                var html = '<option value="">Select Option</option>';
                opts.forEach(function(o) {
                    html += '<option value="' + o.quotation_options_id + '">' + o.quotation_options_title + '</option>';
                });
                $('#option_select').html(html);
                $('#option_wrap').show();

                if (opts.length === 1) {
                    $('#option_select').val(opts[0].quotation_options_id).trigger('change');
                }
            }
        });
    });

    $('#option_select').change(function() {
        var quotation_id = $('#booking_select').val();
        var option_id = $(this).val();
        resetPanel();
        $('#property_select').prop('disabled', true).html('<option value="">Select Property</option>');
        if (!quotation_id || !option_id) return;

        $.ajax({
            url: base_url + 'property_reservation/ajax_get_properties',
            type: 'POST',
            data: { quotation_id: quotation_id, quotation_options_id: option_id },
            dataType: 'json',
            success: function(res) {
                currentProperties = (res.data || []);
                var html = '<option value="">Select Property</option>';
                currentProperties.forEach(function(p, idx) {
                    html += '<option value="' + idx + '">' + p.properties_name + '</option>';
                });
                $('#property_select').html(html).prop('disabled', false);
            }
        });
    });

    $('#property_select').change(function() {
        var idx = $(this).val();
        resetPanel();
        if (idx === '') return;

        var prop = currentProperties[idx];
        var quotation_id = $('#booking_select').val();
        pr_current_quotation_id  = quotation_id;
        pr_current_properties_id = prop.properties_id;

        $.ajax({
            url: base_url + 'property_reservation/ajax_get_reservation',
            type: 'POST',
            data: {
                quotation_id: quotation_id,
                properties_id: prop.properties_id,
                check_in_date: prop.check_in_date,
                check_out_date: prop.check_out_date,
                duration_nights: prop.duration_nights
            },
            dataType: 'json',
            success: function(res) {
                if (!res.status) { alert(res.message || 'Unable to load reservation'); return; }
                renderReservation(res);
            }
        });
    });
});

function resetPanel() {
    $('#reservation_panel').hide();
    $('#property_reservation_id').val('');
}

function renderReservation(res) {
    var r = res.reservation;
    $('#property_reservation_id').val(r.property_reservation_id);
    pr_checkin_date = r.check_in_date || '';

    $('#info_property').text(r.properties_name || '-');
    $('#info_guest').text(r.guest_name || '-');
    $('#info_booking').text(r.booking_number || '-');
    $('#info_checkin').text(formatDate(r.check_in_date));
    $('#info_checkout').text(formatDate(r.check_out_date));
    $('#info_duration').text((r.duration_nights || 1) + ' Night(s)');

    // Level 1
    $('#blocking_cnfm_by').val(r.blocking_cnfm_by || '');
    $('#blocking_cutoff_date').val(r.blocking_cutoff_date || '');
    $('#blocking_date').val(r.blocking_date || '');
    setPill('#pill_blocking', r.blocking_status, 'BLOCKED');

    // Level 2
    $('#confirmation_cnfm_by').val(r.confirmation_cnfm_by || '');
    $('#confirmation_cnfm_no').val(r.confirmation_cnfm_no || '');
    $('#confirmation_cnfm_date').val(r.confirmation_cnfm_date || '');
    setPill('#pill_confirm', r.confirmation_status, 'CONFIRMED');

    // Level 3
    $('#reconfirmation_cnfm_by').val(r.reconfirmation_cnfm_by || '');
    $('#reconfirmation_cnfm_no').val(r.reconfirmation_cnfm_no || '');
    $('#reconfirmation_date').val(r.reconfirmation_date || '');
    setPill('#pill_recon', r.reconfirmation_status, 'RECONFIRMED');

    // Payment
    var total = res.total_amount || 0;
    $('#total_amount').val(total);
    $('#payment_total_display').text(parseFloat(total).toLocaleString('en-IN'));
    pr_current_scheduler_id = 0;
    $('#btn_view_payments').hide();
    $('#discount_amount').val(0);
    $('#discounted_total').val(total);
    $('#discounted_total_display').hide();
    $('input[name="payment_type"]').prop('checked', false);
    $('#cutoff_date').val('');
    $('#cutoff_date_display').val('');
    $('#fullSection').hide();
    $('#emiSection').hide();
    $('#emiTableBody').html('');

    if (res.payment) {
        var p = res.payment;
        $('#total_amount').val(p.total_amount);
        $('#payment_total_display').text(parseFloat(p.total_amount).toLocaleString('en-IN'));
        pr_current_scheduler_id = parseInt(p.property_payment_scheduler_id) || 0;
        $('#btn_view_payments').css('display', pr_current_scheduler_id > 0 ? 'inline-block' : 'none');
        var savedDiscount = parseFloat(p.discount_amount) || 0;
        $('#discount_amount').val(savedDiscount);
        var net = parseFloat(p.discounted_total) || (parseFloat(p.total_amount) - savedDiscount);
        $('#discounted_total').val(net);
        if (savedDiscount > 0) {
            $('#discounted_total_val').text(net.toLocaleString('en-IN'));
            $('#discounted_total_display').show();
        }
        if (p.payment_type === 'FULL') {
            $('#pt_full').prop('checked', true);
            togglePaymentType();
            if (res.installments && res.installments.length > 0) {
                var cd = res.installments[0].due_date || '';
                $('#cutoff_date').val(cd);
                $('#cutoff_date_display').val(pr_formatDateDMY(cd));
            } else if (pr_checkin_date) {
                $('#cutoff_date').val(pr_checkin_date);
                $('#cutoff_date_display').val(pr_formatDateDMY(pr_checkin_date));
            }
        } else if (p.payment_type === 'EMI') {
            $('#pt_emi').prop('checked', true);
            $('#max_emi_count').val(p.max_emi_count || 3);
            $('#split_type').val(p.split_type || 'AMOUNT');
            togglePaymentType();
            renderEmiFromData(res.installments, p.split_type);
        }
    }

    renderComments(res.comments || []);
    $('#reservation_panel').show();
}

function setPill(sel, status, doneValue) {
    var $el = $(sel);
    if (status === doneValue) {
        $el.text(doneValue).removeClass('bg-secondary').addClass('bg-success');
    } else {
        $el.text('PENDING').removeClass('bg-success').addClass('bg-secondary');
    }
}

// ---------------- Level 1 ----------------
function saveBlocking() {
    postForm('property_reservation/save_blocking', '#blockingForm', function() {
        reloadCurrent();
    });
}

// ---------------- Level 2 ----------------
function togglePaymentType() {
    var type = $('input[name="payment_type"]:checked').val();
    if (type === 'FULL') {
        $('#fullSection').show();
        $('#emiSection').hide();
        if (pr_checkin_date && !$('#cutoff_date').val()) {
            $('#cutoff_date').val(pr_checkin_date);
            $('#cutoff_date_display').val(pr_formatDateDMY(pr_checkin_date));
        }
    } else if (type === 'EMI') {
        $('#fullSection').hide();
        $('#emiSection').show();
        if ($('#emiTableBody tr').length === 0) generateEmiRows();
    } else {
        $('#fullSection').hide();
        $('#emiSection').hide();
    }
}

function pr_formatDateDMY(d) {
    if (!d) return '';
    var p = d.split('-');
    if (p.length !== 3) return d;
    return p[2] + '/' + p[1] + '/' + p[0];
}

function pr_parseDateDMY(d) {
    if (!d) return '';
    var p = d.split('/');
    if (p.length !== 3) return d;
    return p[2] + '-' + p[1] + '-' + p[0];
}

function pr_addDays(ymd, days) {
    var dt = new Date(ymd);
    dt.setDate(dt.getDate() + days);
    var mm = String(dt.getMonth() + 1).padStart(2, '0');
    var dd = String(dt.getDate()).padStart(2, '0');
    return dt.getFullYear() + '-' + mm + '-' + dd;
}

function pr_initEmiDatepickers() {
    $('#emiTableBody .pr-emi-due-date').datepicker({
        format: 'dd/mm/yyyy',
        autoclose: true,
        todayHighlight: true
    }).off('changeDate.premi').on('changeDate.premi', function() {
        $(this).closest('tr').find('.pr-emi-due-date-hidden').val(pr_parseDateDMY($(this).val()));
    });
}

function pr_getNetTotal() {
    var total = parseFloat($('#total_amount').val()) || 0;
    var discount = parseFloat($('#discount_amount').val()) || 0;
    return Math.max(0, total - discount);
}

function pr_applyDiscount() {
    var total = parseFloat($('#total_amount').val()) || 0;
    var discount = parseFloat($('#discount_amount').val()) || 0;
    if (discount < 0) { discount = 0; $('#discount_amount').val(0); }
    if (discount > total) { discount = total; $('#discount_amount').val(total); }
    var net = total - discount;
    $('#discounted_total').val(net);
    if (discount > 0) {
        $('#discounted_total_val').text(net.toLocaleString('en-IN'));
        $('#discounted_total_display').show();
    } else {
        $('#discounted_total_display').hide();
    }
    var type = $('input[name="payment_type"]:checked').val();
    if (type === 'EMI') generateEmiRows();
}

function generateEmiRows() {
    pr_buildEmiRows(pr_checkin_date ? [pr_checkin_date] : []);
}

function pr_buildEmiRows(accDates) {
    var count = parseInt($('#max_emi_count').val()) || 3;
    var total = pr_getNetTotal();
    var split = $('#split_type').val();
    $('#emiValHeader').text(split === 'PERCENTAGE' ? 'Percentage (%)' : 'Amount');

    var checkInDate = (accDates && accDates.length > 0) ? accDates[0] : '';

    var html = '';
    for (var i = 1; i <= count; i++) {
        var def = split === 'PERCENTAGE' ? (100 / count).toFixed(2) : (total / count).toFixed(2);
        var dueDateYMD = checkInDate;
        html += '<tr>';
        html += '<td class="text-center">' + i + '</td>';
        html += '<td>';
        if (split === 'PERCENTAGE') {
            html += '<input type="number" step="0.01" class="form-control form-control-sm emi-percentage" name="emi_percentage[]" value="' + def + '">';
        } else {
            html += '<input type="number" step="0.01" class="form-control form-control-sm emi-amount" name="emi_amount[]" value="' + def + '">';
        }
        html += '</td>';
        html += '<td>';
        html += '<input type="text" class="form-control form-control-sm pr-emi-due-date" placeholder="dd/mm/yyyy" value="' + pr_formatDateDMY(dueDateYMD) + '" required>';
        html += '<input type="hidden" name="emi_due_date[]" class="pr-emi-due-date-hidden" value="' + dueDateYMD + '">';
        html += '</td>';
        html += '<td class="emi-calc text-end">0.00</td>';
        html += '</tr>';
    }
    $('#emiTableBody').html(html);
    pr_initEmiDatepickers();
    calcEmiTotal();
}

function renderEmiFromData(installments, split) {
    if (!installments) return;
    $('#emiValHeader').text(split === 'PERCENTAGE' ? 'Percentage (%)' : 'Amount');
    var html = '';
    for (var i = 0; i < installments.length; i++) {
        var inst = installments[i];
        html += '<tr>';
        html += '<td class="text-center">' + inst.installment_number + '</td>';
        html += '<td>';
        if (split === 'PERCENTAGE') {
            html += '<input type="number" step="0.01" class="form-control form-control-sm emi-percentage" name="emi_percentage[]" value="' + (inst.installment_percentage || '') + '">';
        } else {
            html += '<input type="number" step="0.01" class="form-control form-control-sm emi-amount" name="emi_amount[]" value="' + (inst.installment_amount || '') + '">';
        }
        html += '</td>';
        html += '<td>';
        html += '<input type="text" class="form-control form-control-sm pr-emi-due-date" placeholder="dd/mm/yyyy" value="' + pr_formatDateDMY(inst.due_date || '') + '" required>';
        html += '<input type="hidden" name="emi_due_date[]" class="pr-emi-due-date-hidden" value="' + (inst.due_date || '') + '">';
        html += '</td>';
        html += '<td class="emi-calc text-end">' + parseFloat(inst.calculated_amount).toFixed(2) + '</td>';
        html += '</tr>';
    }
    $('#emiTableBody').html(html);
    pr_initEmiDatepickers();
    calcEmiTotal();
}

function calcEmiTotal() {
    var total = pr_getNetTotal();
    var split = $('#split_type').val();
    var sum = 0;
    if (split === 'PERCENTAGE') {
        $('.emi-percentage').each(function() {
            var pct = parseFloat($(this).val()) || 0;
            var calc = (total * pct) / 100;
            sum += calc;
            $(this).closest('tr').find('.emi-calc').text(calc.toFixed(2));
        });
    } else {
        $('.emi-amount').each(function() {
            var amt = parseFloat($(this).val()) || 0;
            sum += amt;
            $(this).closest('tr').find('.emi-calc').text(amt.toFixed(2));
        });
    }
    $('#emiCalcTotal').text(sum.toFixed(2));
    if (Math.abs(sum - total) > 0.01) {
        $('#emiCalcTotal').addClass('text-danger');
    } else {
        $('#emiCalcTotal').removeClass('text-danger');
    }
}

function redistributeEmiAmounts($changed) {
    var split = $('#split_type').val();
    var total = split === 'PERCENTAGE' ? 100 : pr_getNetTotal();
    var $inputs = split === 'PERCENTAGE' ? $('.emi-percentage') : $('.emi-amount');
    var changedVal = parseFloat($changed.val()) || 0;
    var $others = $inputs.not($changed);
    if ($others.length > 0) {
        $others.val(((total - changedVal) / $others.length).toFixed(2));
    }
    calcEmiTotal();
}

$(document).on('change input', '#emiTableBody .emi-amount', function() {
    redistributeEmiAmounts($(this));
});

$(document).on('change input', '#emiTableBody .emi-percentage', function() {
    redistributeEmiAmounts($(this));
});

$(document).on('change', '#emiTableBody .pr-emi-due-date', function() {
    $(this).closest('tr').find('.pr-emi-due-date-hidden').val(pr_parseDateDMY($(this).val()));
});

function saveConfirmation() {
    var type = $('input[name="payment_type"]:checked').val();
    if (!type) { alert('Please select payment terms'); return; }
    postForm('property_reservation/save_confirmation', '#confirmForm', function() {
        reloadCurrent();
    });
}

// ---------------- Level 3 ----------------
function saveReconfirmation() {
    postForm('property_reservation/save_reconfirmation', '#reconForm', function() {
        reloadCurrent();
    });
}

// ---------------- Comments ----------------
function addComment() {
    var id = $('#property_reservation_id').val();
    var text = $('#comment_text').val();
    if (!text.trim()) return;
    $.ajax({
        url: base_url + 'property_reservation/add_comment',
        type: 'POST',
        data: { property_reservation_id: id, comment_text: text },
        dataType: 'json',
        success: function(res) {
            if (res.error) { alert(res.message); return; }
            $('#comment_text').val('');
            renderComments(res.comments || []);
        }
    });
}

function renderComments(comments) {
    var html = '';
    comments.forEach(function(c) {
        html += '<li class="list-group-item d-flex justify-content-between align-items-start">';
        html += '<div><div>' + escapeHtml(c.comment_text) + '</div>';
        html += '<small class="text-muted">' + (c.created_by_name || 'User') + ' · ' + formatDateTime(c.comment_created_date) + '</small></div>';
        html += '</li>';
    });
    if (!html) html = '<li class="list-group-item text-muted">No comments yet.</li>';
    $('#commentsList').html(html);
}

// ---------------- Shared ----------------
function postForm(url, formSel, onDone) {
    var id = $('#property_reservation_id').val();
    if (!id) { alert('Please select a property first'); return; }
    var data = $(formSel).serialize() + '&property_reservation_id=' + id;
    $.ajax({
        url: base_url + url,
        type: 'POST',
        data: data,
        dataType: 'json',
        success: function(res) {
            alert(res.message);
            if (!res.error && onDone) onDone();
        },
        error: function() { alert('An error occurred. Please try again.'); }
    });
}

function reloadCurrent() {
    $('#property_select').trigger('change');
}

function formatDate(d) {
    if (!d || d === '0000-00-00') return '-';
    var dt = new Date(d);
    if (isNaN(dt)) return d;
    return String(dt.getDate()).padStart(2, '0') + ' ' +
           dt.toLocaleString('en-US', { month: 'short' }) + ' ' + dt.getFullYear();
}

function formatDateTime(d) {
    if (!d) return '';
    var dt = new Date(d.replace(' ', 'T'));
    if (isNaN(dt)) return d;
    return formatDate(d) + ' ' + String(dt.getHours()).padStart(2, '0') + ':' + String(dt.getMinutes()).padStart(2, '0');
}

function escapeHtml(s) {
    return $('<div>').text(s || '').html();
}

// -------- Payment Recording --------
function prViewPaymentSummary() {
    if (!pr_current_scheduler_id) { alert('No payment schedule found. Save confirmation first.'); return; }
    $.ajax({
        url: base_url + 'index.php/property_reservation/ajax_get_payment_summary',
        type: 'POST',
        data: { scheduler_id: pr_current_scheduler_id },
        dataType: 'json',
        success: function(res) {
            if (res.error) { alert(res.message); return; }
            var d = res.data;
            $('#pr_view_paid').text('₹' + parseFloat(d.total_paid).toLocaleString('en-IN', { minimumFractionDigits: 2 }));
            $('#pr_view_pending').text('₹' + parseFloat(d.pending).toLocaleString('en-IN', { minimumFractionDigits: 2 }));
            $('#pr_view_overdue').text(d.overdue_count);
            var html = '';
            var insts = d.installments;
            for (var i = 0; i < insts.length; i++) {
                var inst = insts[i];
                var sc = inst.payment_status === 'PAID' ? 'bg-success' : (inst.payment_status === 'PARTIAL' ? 'bg-warning' : (inst.payment_status === 'OVERDUE' ? 'bg-danger' : 'bg-secondary'));
                var remaining = parseFloat(inst.calculated_amount) - parseFloat(inst.paid_amount);
                html += '<tr>';
                html += '<td>' + inst.installment_number + '</td>';
                html += '<td>' + formatDate(inst.due_date) + '</td>';
                html += '<td>₹' + parseFloat(inst.calculated_amount).toLocaleString('en-IN', { minimumFractionDigits: 2 }) + '</td>';
                html += '<td>₹' + parseFloat(inst.paid_amount).toLocaleString('en-IN', { minimumFractionDigits: 2 }) + '</td>';
                html += '<td><span class="badge ' + sc + '">' + inst.payment_status + '</span></td>';
                html += '<td>';
                if (inst.payment_status !== 'PAID') {
                    html += '<button class="btn btn-success btn-xs me-1" onclick="prRecordPayment(' + inst.installment_id + ',' + remaining.toFixed(2) + ')"><i class="fas fa-money-bill"></i> Pay</button>';
                }
                if (inst.payment_status === 'PAID' || inst.payment_status === 'PARTIAL') {
                    html += '<button class="btn btn-info btn-xs" onclick="prViewReceipts(' + inst.installment_id + ')"><i class="fas fa-receipt"></i> Receipts</button>';
                }
                html += '</td></tr>';
            }
            if (!html) html = '<tr><td colspan="6" class="text-center text-muted">No installments found</td></tr>';
            $('#pr_installments_body').html(html);
            $('#prPaymentSummaryModal').modal('show');
        }
    });
}

function prRecordPayment(installmentId, dueAmount) {
    $('#pr_pay_installment_id').val(installmentId);
    $('#pr_pay_scheduler_id').val(pr_current_scheduler_id);
    $('#pr_pay_due_amount').val('₹' + parseFloat(dueAmount).toFixed(2));
    $('#pr_pay_amount').val(parseFloat(dueAmount).toFixed(2));
    $('#pr_pay_date').val(new Date().toISOString().split('T')[0]);
    $('#pr_pay_method').val('');
    $('#pr_pay_ref').val('');
    $('#pr_pay_remarks').val('');
    $('#prRecordPaymentModal').modal('show');
}

function prSavePayment() {
    var formData = $('#prPaymentForm').serialize();
    $.ajax({
        url: base_url + 'index.php/property_reservation/ajax_record_payment',
        type: 'POST',
        data: formData,
        dataType: 'json',
        success: function(res) {
            if (res.error) { alert(res.message); return; }
            $('#prRecordPaymentModal').modal('hide');
            prViewPaymentSummary();
            alert(res.message);
        }
    });
}

function prViewReceipts(installmentId) {
    $.ajax({
        url: base_url + 'index.php/property_reservation/ajax_get_installment_payments',
        type: 'POST',
        data: { installment_id: installmentId },
        dataType: 'json',
        success: function(res) {
            var payments = res.payments || [];
            var html = '';
            if (payments.length > 0) {
                for (var i = 0; i < payments.length; i++) {
                    var p = payments[i];
                    html += '<tr>';
                    html += '<td>' + formatDate(p.payment_date) + '</td>';
                    html += '<td>₹' + parseFloat(p.payment_amount).toLocaleString('en-IN', { minimumFractionDigits: 2 }) + '</td>';
                    html += '<td>' + (p.payment_method || '-') + '</td>';
                    html += '<td>' + (p.payment_reference || '-') + '</td>';
                    html += '<td>' + (p.payment_paid_by_username || '-') + '</td>';
                    html += '<td><button class="btn btn-primary btn-xs" onclick="prPrintReceipt(' + p.payment_id + ')"><i class="fas fa-print"></i> Print</button></td>';
                    html += '</tr>';
                }
            } else {
                html = '<tr><td colspan="6" class="text-center text-muted">No payments recorded</td></tr>';
            }
            $('#pr_receipts_body').html(html);
            $('#prReceiptsModal').modal('show');
        }
    });
}

function prPrintReceipt(paymentId) {
    window.open(base_url + 'index.php/property_reservation/print_receipt/' + paymentId, '_blank', 'width=800,height=700');
}
</script>
