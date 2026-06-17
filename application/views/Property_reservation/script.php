<script type="text/javascript">
var base_url = '<?php echo base_url(); ?>';
var currentProperties = [];   // cached property list (with derived dates) for selected booking+option

$(document).ready(function() {

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
    $('input[name="payment_type"]').prop('checked', false);
    $('#fullSection').hide();
    $('#emiSection').hide();
    $('#emiTableBody').html('');

    if (res.payment) {
        var p = res.payment;
        $('#total_amount').val(p.total_amount);
        $('#payment_total_display').text(parseFloat(p.total_amount).toLocaleString('en-IN'));
        if (p.payment_type === 'FULL') {
            $('#pt_full').prop('checked', true);
            togglePaymentType();
            if (res.installments && res.installments.length > 0) {
                $('#cutoff_date').val(res.installments[0].due_date);
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
    } else if (type === 'EMI') {
        $('#fullSection').hide();
        $('#emiSection').show();
        if ($('#emiTableBody tr').length === 0) generateEmiRows();
    } else {
        $('#fullSection').hide();
        $('#emiSection').hide();
    }
}

function generateEmiRows() {
    var count = parseInt($('#max_emi_count').val()) || 3;
    var total = parseFloat($('#total_amount').val()) || 0;
    var split = $('#split_type').val();
    $('#emiValHeader').text(split === 'PERCENTAGE' ? 'Percentage (%)' : 'Amount');

    var html = '';
    for (var i = 1; i <= count; i++) {
        var def = split === 'PERCENTAGE' ? (100 / count).toFixed(2) : (total / count).toFixed(2);
        html += '<tr>';
        html += '<td class="text-center">' + i + '</td>';
        html += '<td>';
        if (split === 'PERCENTAGE') {
            html += '<input type="number" step="0.01" class="form-control form-control-sm emi-percentage" name="emi_percentage[]" value="' + def + '" onchange="calcEmiTotal()">';
        } else {
            html += '<input type="number" step="0.01" class="form-control form-control-sm emi-amount" name="emi_amount[]" value="' + def + '" onchange="calcEmiTotal()">';
        }
        html += '</td>';
        html += '<td><input type="date" class="form-control form-control-sm" name="emi_due_date[]"></td>';
        html += '<td class="emi-calc text-end">0.00</td>';
        html += '</tr>';
    }
    $('#emiTableBody').html(html);
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
            html += '<input type="number" step="0.01" class="form-control form-control-sm emi-percentage" name="emi_percentage[]" value="' + (inst.installment_percentage || '') + '" onchange="calcEmiTotal()">';
        } else {
            html += '<input type="number" step="0.01" class="form-control form-control-sm emi-amount" name="emi_amount[]" value="' + (inst.installment_amount || '') + '" onchange="calcEmiTotal()">';
        }
        html += '</td>';
        html += '<td><input type="date" class="form-control form-control-sm" name="emi_due_date[]" value="' + (inst.due_date || '') + '"></td>';
        html += '<td class="emi-calc text-end">' + parseFloat(inst.calculated_amount).toFixed(2) + '</td>';
        html += '</tr>';
    }
    $('#emiTableBody').html(html);
    calcEmiTotal();
}

function calcEmiTotal() {
    var total = parseFloat($('#total_amount').val()) || 0;
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
</script>
