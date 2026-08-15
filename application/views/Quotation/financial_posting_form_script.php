// Shared financial posting form logic: used by the quotation hub tab and
// the standalone financial posting page.

// Self-contained: the standalone page does not load the hub's escapeHtml().
function fpEscapeHtml(str) {
    if (str === null || str === undefined) return '';
    return $('<div>').text(String(str)).html();
}

// Recalculate totals whenever a quoted/actual amount changes.
$(document).on('input', '#fpHubTable .fp-quoted, #fpHubTable .fp-actual', function() {
    fpCalculate();
});

function fpLoad(leadId) {

    if (!leadId) {

        alert('Lead ID missing');

        return;

    }



    $('#fp_leads_id').val(leadId);

    $('#fp_record_id').val('');



    // Clear dynamic rows

    $('#fpHubTable tbody tr.fp-day-header').remove();

    $('#fpHubTable tbody tr.fp-day-hotel').remove();

    $('#fpHubTable tbody tr.fp-day-inclusion').remove();

    $('#fpHubTable tbody tr.fp-day-special').remove();

    $('#fpHubTable tbody tr.fp-expense').remove();



    // Reset static fields

    $('[name="fp_driver_quoted"]').val('');

    $('[name="fp_driver_actual"]').val('');

    $('[name="fp_driver_desc"]').val('');

    $('#fpMargin').text('0.00');

    $('#fpNotes').val('');

    $('#fpActualCost').text('0.00');

    $('#fpCostAfterPost').text('0.00');

    $('#fpHotelReservationAmount').text('0.00');

    $('#fpPreQuotedAmount').text('0.00');

    $('#fpDifference').text('0.00');

    $('#fpTotalMargin').text('0.00');



    var quotationId = $('#quotation_id').val() || 0;

    var defaultsRequest = quotationId ?

        $.ajax({

            url: "<?php echo base_url(); ?>index.php/Quotation/ajax_get_financial_posting_defaults/" + quotationId,

            type: "GET",

            dataType: "json"

        }) : $.Deferred().resolve({status: false}).promise();



    $.when(

        $.ajax({

            url: "<?php echo base_url(); ?>index.php/Quotation/ajax_get_financial_posting/" + leadId,

            type: "GET",

            dataType: "json"

        }),

        defaultsRequest

    ).done(function(fpRes, defaultsRes) {

        var fpData = fpRes[0];

        var defaultsData = defaultsRes[0];

        var hasRecord = fpData.status;

        var defaults = (defaultsData.status && defaultsData.data) ? defaultsData.data : null;



        console.log('FP defaults response:', defaultsData);

        console.log('FP defaults:', defaults);



        if (defaults) {

            $('#fpHotelReservationAmount').text(parseFloat(defaults.hotel_reservation_amount || 0).toFixed(2));

            $('#fpPreQuotedAmount').text(parseFloat(defaults.pre_quoted_amount || 0).toFixed(2));

        }



        if (!hasRecord) {

            // No record yet — auto-populate driver, hotel rows and margin from defaults

            if (defaults) {

                $('[name="fp_driver_quoted"]').val(defaults.driver_quote_amount || '');

                $('[name="fp_driver_actual"]').val(defaults.driver_quote_amount || '');

                if (defaults.days && defaults.days.length) {

                    defaults.days.forEach(function(day) {

                        fpAddDay(day);

                    });

                } else if (defaults.hotel_days && defaults.hotel_days.length) {

                    defaults.hotel_days.forEach(function(day) {

                        fpAddDay({

                            day_label: day.day_label,

                            hotel_cost: day.day_cost,

                            inclusions_cost: 0,

                            special_cost: 0

                        });

                    });

                }

                if (defaults.margin_value) {

                    $('#fpMargin').text(parseFloat(defaults.margin_value || 0).toFixed(2));

                }

            }

            fpCalculate();

            return;

        }



        var d = fpData.data;

        $('#fp_record_id').val(d.fp_id || '');

        $('#fp_leads_id').val(d.fp_leads_id_fk || leadId);

        $('[name="fp_driver_quoted"]').val(d.fp_driver_quoted || '');

        $('[name="fp_driver_actual"]').val(d.fp_driver_actual || '');

        $('[name="fp_driver_desc"]').val(d.fp_driver_desc || '');

        $('#fpMargin').text(d.fp_margin != null ? parseFloat(d.fp_margin).toFixed(2) : '0.00');

        $('#fpNotes').val(d.fp_notes || '');



        if (d.days && d.days.length) {

            // A saved posting only stores labels, amounts and free-text descriptions.
            // Re-attach the quotation context (confirmed property, inclusion and
            // special requirement names) so editing shows the same detail as adding.

            var contextByDay = {};

            if (defaults && defaults.days) {

                defaults.days.forEach(function(dd) {

                    contextByDay[dd.day_label] = dd;

                });

            }

            d.days.forEach(function(day) {

                var ctx = contextByDay[day.day_label];

                if (ctx) {

                    day.property_name = ctx.property_name || '';

                    day.stay_date     = ctx.stay_date     || '';

                    day.stay_day_name = ctx.stay_day_name || '';

                    if (!day.inc_desc)     { day.inc_desc     = ctx.inclusion_desc || ''; }

                    if (!day.special_desc) { day.special_desc = ctx.special_desc   || ''; }

                    day.inclusion_names = ctx.inclusion_names || '';

                    day.special_names   = ctx.special_names   || '';

                }

                fpAddDay(day);

            });

        }



        if (d.expenses && d.expenses.length) {

            d.expenses.forEach(function(exp) {

                fpAddExpense(exp.fpe_label, exp.fpe_amount, exp.fpe_description);

            });

        }



        // If driver quote/actual or margin was saved empty, fall back to quotation defaults

        if (defaults) {

            if (!$('[name="fp_driver_quoted"]').val()) {

                $('[name="fp_driver_quoted"]').val(defaults.driver_quote_amount || '');

            }

            if (!$('[name="fp_driver_actual"]').val()) {

                $('[name="fp_driver_actual"]').val(defaults.driver_quote_amount || '');

            }

            if (($('#fpMargin').text() === '' || parseFloat($('#fpMargin').text()) == 0) && defaults.margin_value) {

                $('#fpMargin').text(parseFloat(defaults.margin_value || 0).toFixed(2));

            }

        }



        fpCalculate();

    }).fail(function() {

        alert('Failed to load financial posting');

    });

}



function fpAddDay(dayData) {

    dayData = dayData || {};

    var dayLabel = dayData.day_label || 'Day 1';

    var hotelQuoted = dayData.hotel_quoted != null ? dayData.hotel_quoted : (dayData.hotel_cost || '');

    var hotelActual = dayData.hotel_actual != null ? dayData.hotel_actual : (dayData.hotel_cost || '');

    var hotelDesc = dayData.hotel_desc || '';

    var incQuoted = dayData.inc_quoted != null ? dayData.inc_quoted : (dayData.inclusions_cost || '');

    var incActual = dayData.inc_actual != null ? dayData.inc_actual : (dayData.inclusions_cost || '');

    var incDesc = dayData.inc_desc || dayData.inclusion_desc || '';

    var specialQuoted = dayData.special_quoted != null ? dayData.special_quoted : (dayData.special_cost || '');

    var specialActual = dayData.special_actual != null ? dayData.special_actual : (dayData.special_cost || '');

    var specialDesc = dayData.special_desc || '';



    var safeLabel = fpEscapeHtml(dayLabel);

    var propertyName  = dayData.property_name || '';

    var stayDate      = dayData.stay_date || '';

    var stayDayName   = dayData.stay_day_name || '';

    var inclusionList = dayData.inclusion_names || incDesc;

    var specialList   = dayData.special_names   || specialDesc;

    var daySubtotal = (parseFloat(hotelQuoted) || 0) + (parseFloat(incQuoted) || 0) + (parseFloat(specialQuoted) || 0);

    var dayIndex = $('#fpHubTable tbody tr.fp-day-header').length;

    var collapsedClass = dayIndex > 0 ? ' fp-collapsed' : '';

    var html = '';



    // Day title row (grouped header with per-day subtotal)

    html += '<tr class="fp-day-header' + collapsedClass + '">' +

        '<td colspan="5">' +

            '<span class="fp-day-toggle"><i class="la la-angle-down"></i></span>' +

            '<span class="fp-day-badge"><i class="la la-calendar-day me-1"></i>' + safeLabel + '</span>' +
            (stayDate ? '<span class="fp-day-date">' + fpEscapeHtml(stayDate) +
                (stayDayName ? ' (' + fpEscapeHtml(stayDayName) + ')' : '') + '</span>' : '') +
            (propertyName ? '<span class="fp-day-property"><i class="la la-hotel me-1"></i>' + fpEscapeHtml(propertyName) + '</span>' : '') +

            '<span class="fp-day-subtotal">Day Total (Quoted): <b>' + daySubtotal.toFixed(2) + '</b></span>' +

        '</td>' +

        '</tr>';



    // Hotel row

    var itemHiddenClass = dayIndex > 0 ? ' fp-hidden' : '';

    html += '<tr class="fp-day-hotel fp-day-item' + itemHiddenClass + '" data-day-label="' + safeLabel + '">' +

        '<td class="fp-item-label"><span class="fp-item-icon fp-icon-hotel"><i class="la la-hotel"></i></span>Hotel Rent' +
            (propertyName ? '<div class="fp-item-sub">' + fpEscapeHtml(propertyName) + '</div>' : '') + '</td>' +

        '<td><input type="number" class="form-control form-control-sm fp-quoted" name="day_hotel_quoted[]" value="' + hotelQuoted + '" placeholder="0.00" min="0" step="0.01" readonly></td>' +

        '<td><input type="number" class="form-control form-control-sm fp-actual" name="day_hotel_actual[]" value="' + hotelActual + '" placeholder="0.00" min="0" step="0.01"></td>' +

        '<td><input type="text" class="form-control form-control-sm" name="day_hotel_desc[]" value="' + fpEscapeHtml(hotelDesc) + '" placeholder="Description"></td>' +

        '<td class="text-center"></td>' +

        '</tr>';



    // Inclusions row

    html += '<tr class="fp-day-inclusion fp-day-item' + itemHiddenClass + '">' +

        '<td class="fp-item-label"><span class="fp-item-icon fp-icon-inc"><i class="la la-concierge-bell"></i></span>Property Based Inclusions' +
            (inclusionList ? '<div class="fp-item-sub">' + fpEscapeHtml(inclusionList) + '</div>' : '') + '</td>' +

        '<td><input type="number" class="form-control form-control-sm fp-quoted" name="day_inc_quoted[]" value="' + incQuoted + '" placeholder="0.00" min="0" step="0.01" readonly></td>' +

        '<td><input type="number" class="form-control form-control-sm fp-actual" name="day_inc_actual[]" value="' + incActual + '" placeholder="0.00" min="0" step="0.01"></td>' +

        '<td><input type="text" class="form-control form-control-sm" name="day_inc_desc[]" value="' + fpEscapeHtml(incDesc) + '" placeholder="Description"></td>' +

        '<td class="text-center"></td>' +

        '</tr>';



    // Special Requirements row

    html += '<tr class="fp-day-special fp-day-item' + itemHiddenClass + '">' +

        '<td class="fp-item-label"><span class="fp-item-icon fp-icon-special"><i class="la la-star"></i></span>Special Requirements' +
            (specialList ? '<div class="fp-item-sub">' + fpEscapeHtml(specialList) + '</div>' : '') + '</td>' +

        '<td><input type="number" class="form-control form-control-sm fp-quoted" name="day_special_quoted[]" value="' + specialQuoted + '" placeholder="0.00" min="0" step="0.01" readonly></td>' +

        '<td><input type="number" class="form-control form-control-sm fp-actual" name="day_special_actual[]" value="' + specialActual + '" placeholder="0.00" min="0" step="0.01"></td>' +

        '<td><input type="text" class="form-control form-control-sm" name="day_special_desc[]" value="' + fpEscapeHtml(specialDesc) + '" placeholder="Description"></td>' +

        '<td class="text-center"></td>' +

        '</tr>';



    // Insert before the Other Expenses section to preserve day order

    $('#fpOtherExpHeader').before(html);

    fpCalculate();

}



// Toggle day section collapse/expand

$(document).on('click', '#fpHubTable tbody tr.fp-day-header', function() {

    var $header = $(this);

    var $items = $header.nextUntil('tr.fp-day-header, tr#fpOtherExpHeader', 'tr.fp-day-item');

    $header.toggleClass('fp-collapsed');

    $items.toggleClass('fp-hidden');

});



function fpAddExpense(label, amount, desc) {

    label = label || '';

    amount = (amount !== undefined && amount !== null) ? amount : '';

    desc = desc || '';



    var html = '<tr class="fp-expense table-light fp-label">' +

        '<td class="fw-bold"><input type="text" class="form-control form-control-sm" name="exp_labels[]" value="' + fpEscapeHtml(label) + '" placeholder="Other expense"></td>' +

        '<td class="text-center text-muted">—</td>' +

        '<td><input type="number" class="form-control form-control-sm fp-actual" name="exp_amounts[]" value="' + amount + '" placeholder="0.00" min="0" step="0.01"></td>' +

        '<td><input type="text" class="form-control form-control-sm" name="exp_descs[]" value="' + fpEscapeHtml(desc) + '" placeholder="Description"></td>' +

        '<td class="text-center"><button type="button" class="btn btn-sm btn-link text-danger" onclick="fpRemoveRow(this)"><i class="la la-trash"></i></button></td>' +

        '</tr>';



    var $lastExpense = $('#fpHubTable tbody tr.fp-expense').last();

    if ($lastExpense.length) {

        $lastExpense.after(html);

    } else {

        $('#fpOtherExpHeader').after(html);

    }

    fpCalculate();

}



function fpRemoveRow(btn) {

    $(btn).closest('tr').remove();

    fpCalculate();

}



function fpCalculate() {

    var quotedTotal = 0;

    var actualTotal = 0;



    $('#fpHubTable .fp-quoted').each(function() {

        quotedTotal += parseFloat($(this).val()) || 0;

    });



    $('#fpHubTable .fp-actual').each(function() {

        actualTotal += parseFloat($(this).val()) || 0;

    });



    var margin = parseFloat($('#fpMargin').text()) || 0;

    var totalAfterMargin = actualTotal + margin;

    var preQuoted = parseFloat($('#fpPreQuotedAmount').text()) || 0;

    var difference = preQuoted - totalAfterMargin;

    var totalMargin = difference + margin;



    $('#fpActualCost').text(quotedTotal.toFixed(2));

    $('#fpCostAfterPost').text(actualTotal.toFixed(2));

    $('#fpTotalAfterMargin').text(totalAfterMargin.toFixed(2));

    $('#fpDifference').text(difference.toFixed(2));

    $('#fpTotalMargin').text(totalMargin.toFixed(2));



    fpPaintAmountBadge($('#fpTotalMargin'), totalMargin);

}



/* Colour an amount badge green when positive, red when negative, grey at zero. */

function fpPaintAmountBadge($el, value) {

    var background = '#6c757d';

    if (value > 0) {

        background = '#198754';

    } else if (value < 0) {

        background = '#dc3545';

    }

    $el.css('background', background);

}



function fpSubmit() {

    var leadId = $('#fp_leads_id').val();

    var recordId = $('#fp_record_id').val();



    if (!leadId) {

        alert('Lead ID missing');

        return;

    }



    var payload = {

        fp_leads_id_fk: leadId,

        fp_record_id: recordId,

        fp_driver_quoted: parseFloat($('[name="fp_driver_quoted"]').val()) || 0,

        fp_driver_actual: parseFloat($('[name="fp_driver_actual"]').val()) || 0,

        fp_driver_desc: $('[name="fp_driver_desc"]').val() || '',

        fp_actual_cost: parseFloat($('#fpActualCost').text()) || 0,

        fp_cost_after: parseFloat($('#fpCostAfterPost').text()) || 0,

        fp_margin: parseFloat($('#fpMargin').text()) || 0,

        fp_notes: $('#fpNotes').val() || '',

        days: [],

        exp_labels: [],

        exp_amounts: [],

        exp_descs: []

    };



    // Collect day-based data

    var dayCount = $('#fpHubTable tbody tr.fp-day-hotel').length;

    for (var i = 0; i < dayCount; i++) {

        var hotelRow = $('#fpHubTable tbody tr.fp-day-hotel').eq(i);

        var incRow = $('#fpHubTable tbody tr.fp-day-inclusion').eq(i);

        var specialRow = $('#fpHubTable tbody tr.fp-day-special').eq(i);



        var dayLabel = hotelRow.data('dayLabel') || ('Day ' + (i + 1));

        payload.days.push({

            day_label: dayLabel,

            hotel_quoted: parseFloat(hotelRow.find('[name="day_hotel_quoted[]"]').val()) || 0,

            hotel_actual: parseFloat(hotelRow.find('[name="day_hotel_actual[]"]').val()) || 0,

            hotel_desc: hotelRow.find('[name="day_hotel_desc[]"]').val() || '',

            inc_quoted: parseFloat(incRow.find('[name="day_inc_quoted[]"]').val()) || 0,

            inc_actual: parseFloat(incRow.find('[name="day_inc_actual[]"]').val()) || 0,

            inc_desc: incRow.find('[name="day_inc_desc[]"]').val() || '',

            special_quoted: parseFloat(specialRow.find('[name="day_special_quoted[]"]').val()) || 0,

            special_actual: parseFloat(specialRow.find('[name="day_special_actual[]"]').val()) || 0,

            special_desc: specialRow.find('[name="day_special_desc[]"]').val() || ''

        });

    }



    $('#fpHubTable tr.fp-expense').each(function() {

        payload.exp_labels.push($(this).find('[name="exp_labels[]"]').val() || '');

        payload.exp_amounts.push(parseFloat($(this).find('[name="exp_amounts[]"]').val()) || 0);

        payload.exp_descs.push($(this).find('[name="exp_descs[]"]').val() || '');

    });



    $.ajax({

        url: "<?php echo base_url(); ?>index.php/Quotation/ajax_save_financial_posting",

        type: "POST",

        dataType: "json",

        data: JSON.stringify(payload),

        success: function(res) {

            if (res.status) {

                $('#fp_record_id').val(res.fp_id || recordId);

                var n = new notify({

                    title: '',

                    style: 'success',

                    message: 'Financial posting saved successfully',

                    icon: 'fas fa-check'

                });

                n.show(); setTimeout(function(){ n.hide(); }, 3000);

                // The standalone financial posting page defines this to close its
                // modal and refresh the listing; the hub tab leaves it undefined.

                if (typeof fpOnSaved === 'function') { fpOnSaved(res); }

            } else {

                var n = new notify({

                    title: '',

                    style: 'error',

                    message: res.message || 'Failed to save financial posting',

                    icon: 'fas fa-times'

                });

                n.show(); setTimeout(function(){ n.hide(); }, 5000);

            }

        },

        error: function() {

            var n = new notify({

                title: '',

                style: 'error',

                message: 'Server error occurred',

                icon: 'fas fa-times'

            });

            n.show(); setTimeout(function(){ n.hide(); }, 5000);

        }

    });

}



// -------- Hub Property Reservation Payment Recording --------

function fpReset() {

    var leadId = $('#hub_lead_id').val();

    if (leadId) {

        fpLoad(leadId);

    } else {

        $('#fpHubTable tbody tr.fp-hotel-day').remove();

        $('#fpHubTable tbody tr.fp-expense').remove();

        $('[name="fp_driver_quoted"]').val('');

        $('[name="fp_driver_actual"]').val('');

        $('[name="fp_driver_desc"]').val('');

        $('#fpMargin').text('0.00');

        $('#fpNotes').val('');

        $('#fpActualCost').text('0.00');

        $('#fpCostAfterPost').text('0.00');

        $('#fpHotelReservationAmount').text('0.00');

        $('#fpPreQuotedAmount').text('0.00');

    $('#fpDifference').text('0.00');

    $('#fpTotalMargin').text('0.00');

        $('#fp_record_id').val('');

    }

}
