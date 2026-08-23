<script type="text/javascript">
var base_url = '<?php echo base_url(); ?>';
var currentProperties = [];   // cached property list (with derived dates) for selected booking+option
var pr_current_quotation_id = 0;
var pr_current_properties_id = 0;
var pr_checkin_date = '';
var pr_current_scheduler_id = 0;
var pr_has_payments = false;

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
        $('#supersededPanel').hide();
        if (!quotation_id) return;

        loadSupersededReservations(quotation_id);

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
                if (!res.status) { var n = new notify({ title: '', style: 'error', message: res.message || 'Unable to load reservation', icon: 'fas fa-times' }); n.show(); setTimeout(function(){ n.hide(); }, 3000); return; }
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

    renderRentBreakdown(res.rent_breakdown || []);
    renderInclusionsDetail(res.inclusions_detail || []);

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
    var prHasPayments = res.has_payments || false;
    pr_has_payments = prHasPayments;
    pr_current_scheduler_id = 0;
    $('#btn_view_payments').hide();
    $('#actual_amount').val(0);
    $('#discount_amount').val(0);
    $('#discounted_total').val(total);
    $('#discounted_total_display').hide();
    $('input[name="payment_type"]').prop('checked', false).prop('disabled', false);
    $('#cutoff_date').val('');
    $('#cutoff_date_display').val('');
    $('#fullSection').hide();
    $('#emiSection').hide();
    $('#emiTableBody').html('');
    $('#max_emi_count').prop('disabled', false);
    $('#split_type').prop('disabled', false);
    $('button[onclick="generateEmiRows()"]').prop('disabled', false);

    if (res.payment) {
        var p = res.payment;
        $('#total_amount').val(p.total_amount);
        $('#payment_total_display').text(parseFloat(p.total_amount).toLocaleString('en-IN'));
        pr_current_scheduler_id = parseInt(p.property_payment_scheduler_id) || 0;
        $('#btn_view_payments').css('display', pr_current_scheduler_id > 0 ? 'inline-block' : 'none');
        var savedNet = parseFloat(p.discounted_total) || parseFloat(p.total_amount) || 0;
        $('#actual_amount').val(savedNet);
        $('#discount_amount').val(0);
        $('#discounted_total').val(savedNet);
        var totalAmt = parseFloat(p.total_amount) || 0;
        if (savedNet > 0 && savedNet !== totalAmt) {
            $('#discounted_total_val').text(savedNet.toLocaleString('en-IN'));
            $('#discounted_total_display').show();
        }
        if (prHasPayments) {
            $('input[name="payment_type"]').prop('disabled', true);
            $('#max_emi_count').prop('disabled', true);
            $('#split_type').prop('disabled', true);
            $('button[onclick="generateEmiRows()"]').prop('disabled', true);
            $('#cutoff_date_display').prop('readonly', true);
            $('#actual_amount').prop('readonly', true);
        } else {
            $('#cutoff_date_display').prop('readonly', false);
            $('#actual_amount').prop('readonly', false);
        }
        if (p.payment_type === 'FULL') {
            $('#pt_full').prop('checked', true);
            togglePaymentType();
            var fullNet = pr_getNetTotal();
            $('#full_total_display').text('₹' + pr_money(fullNet));
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
    renderCreditPanels(res);
    $('#reservation_panel').show();
}

function pr_money(v) {
    return parseFloat(v || 0).toLocaleString('en-IN', { minimumFractionDigits: 2, maximumFractionDigits: 2 });
}

function renderRentBreakdown(rows) {
    var total = 0;
    rows.forEach(function(row) {
        total += parseFloat(row.day_rent) || 0;
    });
    $('#rent_breakdown_total').text(pr_money(total));
}

function renderInclusionsDetail(rows) {
    var html = '';
    rows.forEach(function(row) {
        var amt = parseFloat(row.inclusion_amount) || 0;
        html += '<div>' + pr_escapeHtml(row.inclusion_name || '-') + ' &mdash; <strong>INR ' + pr_money(amt) + '</strong></div>';
    });
    if (!html) html = '<span class="text-muted">No property-based inclusions</span>';
    $('#inclusions_detail_list').html(html);
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
        var fullNet = pr_getNetTotal();
        $('#full_total_display').text('₹' + pr_money(fullNet));
    } else if (type === 'EMI') {
        $('#fullSection').hide();
        $('#emiSection').show();
        if ($('#emiTableBody tr').length === 0) generateEmiRows();
        var emiNet = pr_getNetTotal();
        $('#emi_total_display').text('₹' + pr_money(emiNet));
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
    var actual = parseFloat($('#actual_amount').val()) || 0;
    if (actual > 0) return actual;
    return parseFloat($('#total_amount').val()) || 0;
}

function pr_applyActualAmount() {
    var actual = parseFloat($('#actual_amount').val()) || 0;
    if (actual < 0) { actual = 0; $('#actual_amount').val(0); }
    var net = actual > 0 ? actual : (parseFloat($('#total_amount').val()) || 0);
    $('#discount_amount').val(0);
    $('#discounted_total').val(net);
    var total = parseFloat($('#total_amount').val()) || 0;
    if (actual > 0 && actual !== total) {
        $('#discounted_total_val').text(net.toLocaleString('en-IN'));
        $('#discounted_total_display').show();
    } else {
        $('#discounted_total_display').hide();
    }
    var type = $('input[name="payment_type"]:checked').val();
    if (type === 'EMI') generateEmiRows();
    if (type === 'FULL') $('#full_total_display').text('₹' + pr_money(net));
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
    var ro = pr_has_payments ? ' readonly' : '';
    $('#emiValHeader').text(split === 'PERCENTAGE' ? 'Percentage (%)' : 'Amount');
    var html = '';
    for (var i = 0; i < installments.length; i++) {
        var inst = installments[i];
        html += '<tr>';
        html += '<td class="text-center">' + inst.installment_number + '</td>';
        html += '<td>';
        if (split === 'PERCENTAGE') {
            html += '<input type="number" step="0.01" class="form-control form-control-sm emi-percentage" name="emi_percentage[]" value="' + (inst.installment_percentage || '') + '"' + ro + '>';
        } else {
            html += '<input type="number" step="0.01" class="form-control form-control-sm emi-amount" name="emi_amount[]" value="' + (inst.installment_amount || '') + '"' + ro + '>';
        }
        html += '</td>';
        html += '<td>';
        html += '<input type="text" class="form-control form-control-sm pr-emi-due-date" placeholder="dd/mm/yyyy" value="' + pr_formatDateDMY(inst.due_date || '') + '" required' + ro + '>';
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
    $('#emi_total_display').text('₹' + pr_money(sum));
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
    var changedIndex = $inputs.index($changed);
    var changedVal = parseFloat($changed.val()) || 0;

    var sumBefore = 0;
    for (var i = 0; i < changedIndex; i++) {
        sumBefore += parseFloat($($inputs[i]).val()) || 0;
    }

    var sumAfter = total - sumBefore - changedVal;
    var $afterInputs = $inputs.slice(changedIndex + 1);

    if ($afterInputs.length > 0) {
        $afterInputs.val((sumAfter / $afterInputs.length).toFixed(2));
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
    if (!type) {
        var n = new notify({ title: '', style: 'error', message: 'Please select Payment Terms.', icon: 'fas fa-exclamation-circle' });
        n.show(); setTimeout(function(){ n.hide(); }, 3000);
        return;
    }
    if (type === 'FULL') {
        if (!$('#cutoff_date').val()) {
            var n = new notify({ title: '', style: 'error', message: 'Please select Cutoff Date for Full Payment.', icon: 'fas fa-exclamation-circle' });
            n.show(); setTimeout(function(){ n.hide(); }, 3000);
            return;
        }
    }
    if (type === 'EMI') {
        var emiAmounts = $('#emiTableBody .emi-amount');
        var emiPercentages = $('#emiTableBody .emi-percentage');
        var emiDueDates = $('#emiTableBody .pr-emi-due-date-hidden');
        var hasError = false;

        if (emiAmounts.length === 0 && emiPercentages.length === 0) {
            var n = new notify({ title: '', style: 'error', message: 'Please generate EMI rows before saving.', icon: 'fas fa-exclamation-circle' });
            n.show(); setTimeout(function(){ n.hide(); }, 3000);
            return;
        }

        emiAmounts.each(function() {
            if (!$(this).val() || parseFloat($(this).val()) <= 0) hasError = true;
        });
        emiPercentages.each(function() {
            if (!$(this).val() || parseFloat($(this).val()) <= 0) hasError = true;
        });
        if (hasError) {
            var n = new notify({ title: '', style: 'error', message: 'Please fill all EMI amounts/percentages with valid values.', icon: 'fas fa-exclamation-circle' });
            n.show(); setTimeout(function(){ n.hide(); }, 3000);
            return;
        }

        var hasDateError = false;
        emiDueDates.each(function() {
            if (!$(this).val()) hasDateError = true;
        });
        if (hasDateError) {
            var n = new notify({ title: '', style: 'error', message: 'Please select Due Date for all EMI installments.', icon: 'fas fa-exclamation-circle' });
            n.show(); setTimeout(function(){ n.hide(); }, 3000);
            return;
        }
    }
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
            if (res.error) {
                var n = new notify({ title: '', style: 'error', message: res.message, icon: 'fas fa-times' });
                n.show(); setTimeout(function(){ n.hide(); }, 3000);
                return;
            }
            $('#comment_text').val('');
            renderComments(res.comments || []);
        }
    });
}

function renderComments(comments) {
    var html = '';
    comments.forEach(function(c) {
        html += '<li class="list-group-item d-flex justify-content-between align-items-start">';
        html += '<div><div>' + pr_escapeHtml(c.comment_text) + '</div>';
        html += '<small class="text-muted">' + (c.created_by_name || 'User') + ' · ' + formatDateTime(c.comment_created_date) + '</small></div>';
        html += '</li>';
    });
    if (!html) html = '<li class="list-group-item text-muted">No comments yet.</li>';
    $('#commentsList').html(html);
}

// ---------------- Shared ----------------
function postForm(url, formSel, onDone) {
    var id = $('#property_reservation_id').val();
    if (!id) {
        var n = new notify({ title: '', style: 'error', message: 'Please select a property first.', icon: 'fas fa-exclamation-circle' });
        n.show(); setTimeout(function(){ n.hide(); }, 3000);
        return;
    }
    var data = $(formSel).serialize() + '&property_reservation_id=' + id;
    $.ajax({
        url: base_url + url,
        type: 'POST',
        data: data,
        dataType: 'json',
        success: function(res) {
            var style = res.error ? 'error' : 'success';
            var icon = res.error ? 'fas fa-times' : 'fas fa-check';
            var n = new notify({ title: '', style: style, message: res.message, icon: icon });
            n.show(); setTimeout(function(){ n.hide(); }, 3000);
            if (!res.error && onDone) onDone();
        },
        error: function() {
            var n = new notify({ title: '', style: 'error', message: 'An error occurred. Please try again.', icon: 'fas fa-times' });
            n.show(); setTimeout(function(){ n.hide(); }, 3000);
        }
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

function pr_escapeHtml(s) {
    return $('<div>').text(s || '').html();
}

// -------- Payment Recording --------
function prViewPaymentSummary() {
    if (!pr_current_scheduler_id) { var n = new notify({ title: '', style: 'error', message: 'No payment schedule found. Save confirmation first.', icon: 'fas fa-exclamation-circle' }); n.show(); setTimeout(function(){ n.hide(); }, 3000); return; }
    $.ajax({
        url: base_url + 'index.php/property_reservation/ajax_get_payment_summary',
        type: 'POST',
        data: { scheduler_id: pr_current_scheduler_id },
        dataType: 'json',
        success: function(res) {
            if (res.error) { var n = new notify({ title: '', style: 'error', message: res.message, icon: 'fas fa-times' }); n.show(); setTimeout(function(){ n.hide(); }, 3000); return; }
            var d = res.data;
            var s = d.scheduler || d.payment || null;
            if (s) {
                $('#pr_view_quotation').text(s.quotation_number || '-');
                $('#pr_view_guest').text(s.guest_name || '-');
                $('#pr_view_property').text(s.properties_name || '-');
                $('#pr_view_type').html(s.payment_type == 'FULL' ? '<span class="badge bg-primary">Full Payment</span>' : '<span class="badge bg-info">EMI</span>');
            }
            var totalAmt = d.net_total || (s ? (s.discounted_total > 0 ? s.discounted_total : s.total_amount) : 0);
            $('#pr_view_total').text('₹' + parseFloat(totalAmt).toLocaleString('en-IN', { minimumFractionDigits: 2 }));
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

function prPaymentTodayDMY() {
    var today = new Date();
    return String(today.getDate()).padStart(2, '0') + '/' + String(today.getMonth() + 1).padStart(2, '0') + '/' + today.getFullYear();
}

function prRecordPayment(installmentId, dueAmount) {
    $('#pr_pay_installment_id').val(installmentId);
    $('#pr_pay_scheduler_id').val(pr_current_scheduler_id);
    $('#pr_pay_due_amount').val('₹' + parseFloat(dueAmount).toFixed(2));
    $('#pr_pay_amount').val(parseFloat(dueAmount).toFixed(2));
    $('#pr_pay_date').val(prPaymentTodayDMY());
    if (!$('#pr_pay_date').data('datepicker')) {
        $('#pr_pay_date').datepicker({ format: 'dd/mm/yyyy', autoclose: true, todayHighlight: true });
    }
    $('#pr_pay_method').val('');
    $('#pr_pay_ref').val('');
    $('#pr_pay_remarks').val('');
    $('#pr_pay_slip').val('');
    if (window.resetMultiFiles_pr_pay_slip) { window.resetMultiFiles_pr_pay_slip(); }
    if (!window._pr_pay_slip_picker_init) {
        initMultiFilePicker('pr_pay_slip', 'pr_pay_slip_list');
        window._pr_pay_slip_picker_init = true;
    }
    $('#prRecordPaymentModal').modal('show');
}

function prSavePayment() {
    var $date = $('#pr_pay_date');
    var dateValid = /^\d{2}\/\d{2}\/\d{4}$/.test($date.val());
    $date.toggleClass('is-invalid', !dateValid);
    var pickedFiles = window.getMultiFiles_pr_pay_slip ? window.getMultiFiles_pr_pay_slip() : [];
    if (!dateValid || pickedFiles.length === 0) {
        var n = new notify({ title: '', style: 'error', message: 'Payment date and payment slip are required.', icon: 'fas fa-exclamation-circle' });
        n.show(); setTimeout(function(){ n.hide(); }, 3000);
        return;
    }

    var formData = new FormData($('#prPaymentForm')[0]);
    for (var i = 0; i < pickedFiles.length; i++) {
        formData.append('payment_slip[]', pickedFiles[i]);
    }
    $.ajax({
        url: base_url + 'index.php/property_reservation/ajax_record_payment',
        type: 'POST',
        data: formData,
        processData: false,
        contentType: false,
        dataType: 'json',
        success: function(res) {
            if (res.error) { var n = new notify({ title: '', style: 'error', message: res.message, icon: 'fas fa-times' }); n.show(); setTimeout(function(){ n.hide(); }, 3000); return; }
            $('#prRecordPaymentModal').modal('hide');
            prViewPaymentSummary();
            var n2 = new notify({ title: '', style: 'success', message: res.message, icon: 'fas fa-check' });
            n2.show(); setTimeout(function(){ n2.hide(); }, 3000);
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

// =====================================================
// PROPERTY CREDIT DETECTION & APPLICATION
// =====================================================

var pr_available_credits = [];
var pr_applied_credits   = [];

function renderCreditPanels(res) {
    pr_available_credits = res.available_credits || [];
    pr_applied_credits   = res.applied_credits   || [];

    // Available credits panel
    if (pr_available_credits.length > 0) {
        var totalRemaining = 0;
        var html = '';
        pr_available_credits.forEach(function(c) {
            var rem = parseFloat(c.remaining_amount) || 0;
            totalRemaining += rem;
            html += '<div class="d-flex justify-content-between border-bottom py-1">'
                 +  '<span>Credit #' + c.property_credit_id
                 +  ' from <strong>' + pr_escapeHtml(c.cancellation_number || '-') + '</strong>'
                 +  (c.expiry_date && c.expiry_date !== '0000-00-00' ? ' <span class="text-danger small">(expires ' + pr_formatDateDMY(c.expiry_date) + ')</span>' : '')
                 +  '</span>'
                 +  '<span class="fw-bold text-warning">\u20B9' + pr_money(rem) + '</span>'
                 +  '</div>';
        });
        $('#creditList').html(html);
        $('#creditTotalBadge').text('\u20B9' + pr_money(totalRemaining));
        $('#creditPanel').show();
    } else {
        $('#creditPanel').hide();
    }

    // Applied credits panel
    if (pr_applied_credits.length > 0) {
        var totalApplied = 0;
        var aHtml = '';
        pr_applied_credits.forEach(function(a) {
            var amt = parseFloat(a.applied_amount) || 0;
            totalApplied += amt;
            aHtml += '<div class="d-flex justify-content-between border-bottom py-1">'
                  +  '<span>Credit #' + a.property_credit_id_fk
                  +  ' from <strong>' + pr_escapeHtml(a.cancellation_number || '-') + '</strong>'
                  +  ' applied on ' + pr_formatDateDMY(String(a.applied_datetime).substr(0, 10))
                  +  '</span>'
                  +  '<span class="fw-bold text-success">\u20B9' + pr_money(amt) + '</span>'
                  +  '</div>';
        });
        aHtml += '<div class="d-flex justify-content-between pt-2">'
              +  '<span class="fw-bold">Total Credit Used</span>'
              +  '<span class="fw-bold text-success">\u20B9' + pr_money(totalApplied) + '</span>'
              +  '</div>';
        $('#appliedCreditsList').html(aHtml);
        $('#appliedCreditsPanel').show();
    } else {
        $('#appliedCreditsPanel').hide();
    }
}

function openCreditModal() {
    if (pr_available_credits.length === 0) {
        alert('No available credits for this property.');
        return;
    }

    var html = '';
    pr_available_credits.forEach(function(c) {
        var rem = parseFloat(c.remaining_amount) || 0;
        html += '<tr>'
             +  '<td class="text-center"><input type="checkbox" class="form-check-input credit-check" data-credit-id="' + c.property_credit_id + '" data-remaining="' + rem + '"></td>'
             +  '<td>' + pr_escapeHtml(c.cancellation_number || '-') + '</td>'
             +  '<td>' + pr_escapeHtml(c.original_booking_number || '-') + '</td>'
             +  '<td class="text-end">\u20B9' + pr_money(rem) + '</td>'
             +  '<td class="text-end"><input type="number" min="0" step="0.01" class="form-control form-control-sm credit-amount" style="width:120px; display:inline-block;" value="' + rem.toFixed(2) + '" data-credit-id="' + c.property_credit_id + '"></td>'
             +  '<td>' + (c.expiry_date && c.expiry_date !== '0000-00-00' ? pr_formatDateDMY(c.expiry_date) : '-') + '</td>'
             +  '</tr>';
    });
    $('#creditModalBody').html(html);
    $('#creditApplyTotal').text('\u20B9' + pr_money(0));

    // Update total when checkbox or amount changes
    $('.credit-check').on('change', updateCreditApplyTotal);
    $('.credit-amount').on('input', updateCreditApplyTotal);

    $('#prCreditModal').modal('show');
}

function updateCreditApplyTotal() {
    var total = 0;
    $('.credit-check:checked').each(function() {
        var id = $(this).data('credit-id');
        var remaining = parseFloat($(this).data('remaining')) || 0;
        var amtInput = $('.credit-amount[data-credit-id="' + id + '"]');
        var amt = parseFloat(amtInput.val()) || 0;
        if (amt > remaining) {
            amtInput.val(remaining.toFixed(2));
            amt = remaining;
        }
        if (amt < 0) {
            amtInput.val(0);
            amt = 0;
        }
        total += amt;
    });
    $('#creditApplyTotal').text('\u20B9' + pr_money(total));
}

function applySelectedCredits() {
    var selected = [];
    $('.credit-check:checked').each(function() {
        var id = $(this).data('credit-id');
        var amt = parseFloat($('.credit-amount[data-credit-id="' + id + '"]').val()) || 0;
        if (amt > 0) {
            selected.push({ credit_id: id, amount: amt });
        }
    });

    if (selected.length === 0) {
        alert('Please select at least one credit and enter an amount.');
        return;
    }

    var reservationId = parseInt($('#property_reservation_id').val(), 10) || 0;
    var done = 0;
    var errors = [];

    selected.forEach(function(item) {
        $.ajax({
            url: base_url + 'index.php/Property_credit/ajax_apply_credit',
            type: 'POST',
            async: false,
            data: {
                property_credit_id: item.credit_id,
                quotation_id: pr_current_quotation_id,
                property_reservation_id: reservationId,
                applied_amount: item.amount
            },
            dataType: 'json',
            success: function(res) {
                if (res.status) { done++; }
                else { errors.push(res.message || 'Unknown error'); }
            },
            error: function() { errors.push('Network error for credit #' + item.credit_id); }
        });
    });

    if (errors.length > 0) {
        alert('Some credits could not be applied:\n' + errors.join('\n'));
    }
    if (done > 0) {
        $('#prCreditModal').modal('hide');
        reloadCurrent();
    }
}

/* =========================================================
   PROPERTY CHANGE: superseded reservations
   ========================================================= */

var prSupersededRows = [];

function prNotify(style, message) {
    var n = new notify({
        title: '',
        style: style,
        message: message,
        icon: style === 'success' ? 'fas fa-check' : 'fas fa-times'
    });
    n.show();
    setTimeout(function() { n.hide(); }, 4000);
}

function prMoney(v) {
    return parseFloat(v || 0).toFixed(2);
}

/**
 * Properties the client replaced on the confirmation page. They drop out of
 * every confirmation-driven query, so they are loaded separately to keep the
 * money already committed to them visible.
 */
function loadSupersededReservations(quotation_id) {
    prSupersededRows = [];
    $('#supersededTable tbody').empty();
    $('#supersededPanel').hide();
    if (!quotation_id) return;

    $.ajax({
        url: base_url + 'property_reservation/ajax_get_superseded_reservations',
        type: 'POST',
        data: { quotation_id: quotation_id },
        dataType: 'json',
        success: function(res) {
            if (!res.status || !res.rows || res.rows.length === 0) return;

            prSupersededRows = res.rows;
            var html = '';

            res.rows.forEach(function(r, idx) {
                var cancelled = (r.reservation_state === 'CANCELLED');
                var credit    = r.property_credit;

                var statusCell = cancelled
                    ? '<span class="badge bg-danger">CANCELLED</span>'
                    : '<span class="badge bg-warning text-dark">REPLACED</span>';

                var actionCell;
                if (cancelled) {
                    actionCell = credit
                        ? '<span class="badge bg-success">Credit ' + prMoney(credit.credit_amount) + '</span>'
                        : '<span class="text-muted small">No credit</span>';
                } else if (!r.is_cancellable) {
                    // Nothing was paid to this property, so there is nothing to
                    // recover — the row is kept purely as change history.
                    actionCell = '<span class="text-muted small"><i class="fas fa-history me-1"></i>History only</span>';
                } else if (res.can_cancel) {
                    actionCell = '<button type="button" class="btn btn-sm btn-outline-danger" onclick="openCancelReservationModal(' + idx + ')">'
                               + '<i class="fas fa-ban me-1"></i> Cancel Reservation</button>';
                } else {
                    actionCell = '<span class="text-muted small">-</span>';
                }

                html += '<tr>'
                     +  '<td>' + (r.properties_name || '-') + '</td>'
                     +  '<td>' + (r.superseded_by_property_name || '<span class="text-muted">-</span>') + '</td>'
                     +  '<td>' + (r.check_in_date || '-') + '</td>'
                     +  '<td class="text-end">' + prMoney(r.snap_reservation_amount) + '</td>'
                     +  '<td class="text-end">' + prMoney(r.snap_paid_amount) + '</td>'
                     +  '<td>' + statusCell + '</td>'
                     +  '<td class="text-center">' + actionCell + '</td>'
                     +  '</tr>';
            });

            $('#supersededTable tbody').html(html);
            $('#supersededPanel').show();
        }
    });
}

function openCancelReservationModal(idx) {
    var r = prSupersededRows[idx];
    if (!r) return;

    $('#cancel_res_id').val(r.property_reservation_id);
    $('#cancelResPropertyName').text(r.properties_name || 'this property');
    $('#cancelResReserved').text(prMoney(r.snap_reservation_amount));
    $('#cancelResPaid').text(prMoney(r.snap_paid_amount));

    // Default to the full amount the property is holding; staff can reduce it.
    $('#cancel_res_amount').val(prMoney(r.snap_paid_amount)).attr('max', prMoney(r.snap_paid_amount));
    $('#cancel_res_reference').val('');
    $('#cancel_res_reason').val('');
    $('#cancel_res_expiry').val('');

    var today = new Date();
    var dd = ('0' + today.getDate()).slice(-2);
    var mm = ('0' + (today.getMonth() + 1)).slice(-2);
    $('#cancel_res_date').val(dd + '/' + mm + '/' + today.getFullYear());

    $('#cancel_res_date, #cancel_res_expiry').each(function() {
        if (!$(this).data('datepicker')) {
            $(this).datepicker({ format: 'dd/mm/yyyy', autoclose: true, todayHighlight: true });
        }
    });

    $('#cancelResSubmitBtn').prop('disabled', false);
    $('#prCancelReservationModal').modal('show');
}

function submitCancelReservation() {
    var reservation_id = $('#cancel_res_id').val();
    var amount         = parseFloat($('#cancel_res_amount').val() || 0);
    var date           = $('#cancel_res_date').val();
    var paid           = parseFloat($('#cancelResPaid').text() || 0);

    if (!reservation_id) return;

    if (isNaN(amount) || amount < 0) {
        prNotify('error', 'Enter a valid cancellation amount.');
        return;
    }
    if (amount > paid + 0.009) {
        prNotify('error', 'Cancellation amount cannot exceed the amount paid (' + prMoney(paid) + ').');
        return;
    }
    if (!date) {
        prNotify('error', 'Cancellation date is required.');
        return;
    }
    if (!confirm('Cancel this reservation and record a credit of ' + prMoney(amount) + '?')) return;

    // Guard against a double submit creating a second credit.
    $('#cancelResSubmitBtn').prop('disabled', true);

    $.ajax({
        url: base_url + 'property_reservation/ajax_cancel_reservation',
        type: 'POST',
        dataType: 'json',
        data: {
            property_reservation_id: reservation_id,
            cancellation_amount    : amount,
            cancellation_date      : date,
            cancellation_reason    : $('#cancel_res_reason').val(),
            reference_number       : $('#cancel_res_reference').val(),
            credit_expiry_date     : $('#cancel_res_expiry').val()
        },
        success: function(res) {
            if (!res.status) {
                prNotify('error', res.message || 'Could not cancel the reservation');
                $('#cancelResSubmitBtn').prop('disabled', false);
                return;
            }
            prNotify('success', res.message);
            $('#prCancelReservationModal').modal('hide');
            loadSupersededReservations($('#booking_select').val());
            reloadCurrent();
        },
        error: function() {
            prNotify('error', 'An error occurred. Please try again.');
            $('#cancelResSubmitBtn').prop('disabled', false);
        }
    });
}

</script>
