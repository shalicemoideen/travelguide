<script>

var hub_can_pay_initial = <?php echo has_permission('RECEIPT_SCHEDULER_PAY_INITIAL') ? 'true' : 'false'; ?>;

var hub_can_pay_other = <?php echo has_permission('RECEIPT_SCHEDULER_PAY_OTHER') ? 'true' : 'false'; ?>;

var hub_can_approve_payment = <?php echo has_permission('RECEIPT_SCHEDULER_APPROVE_PAYMENT') ? 'true' : 'false'; ?>;

var hub_can_view = <?php echo has_permission('RECEIPT_SCHEDULER') || has_permission('PAYMENT_REPORT') ? 'true' : 'false'; ?>;

var hub_can_edit = <?php echo has_permission('RECEIPT_SCHEDULER') ? 'true' : 'false'; ?>;

var hub_can_delete = <?php echo has_permission('RECEIPT_SCHEDULER') ? 'true' : 'false'; ?>;

var hub_scheduler_exists = false;


document.addEventListener('DOMContentLoaded', function () {







    // Fix: nested modal scrolling - when child modal closes, restore modal-open on body if parent is still visible

    ['hub_receiptsModal', 'hub_paymentModal'].forEach(function(childModalId) {

        $('#' + childModalId).on('hidden.bs.modal', function () {

            if ($('#hub_viewModal').hasClass('show')) {

                document.body.classList.add('modal-open');

            }

        });

    });

    $('#hub_viewModal').on('hidden.bs.modal', function () {

        document.body.classList.remove('modal-open');

    });







    var quotation_id = document.getElementById('quotation_id')



        ? document.getElementById('quotation_id').value



        : 0;







    if (quotation_id && quotation_id != 0) {



        loadQuotationHubSummary(quotation_id);



    }



});







function loadQuotationHubSummary(quotation_id)



{



    console.log('AJAX called with quotation_id:', quotation_id);







    $.ajax({



        url: "<?php echo base_url(); ?>index.php/Quotation/ajax_get_quotation_hub_summary",



        type: "POST",



        dataType: "json",



        data: {



            quotation_id: quotation_id



        },



        success: function(res) {







            console.log('AJAX response:', res);







            if (!res.status) {



                console.log('No data:', res.message);



                return;



            }







            var data = res.data;



            window._hubSummaryData = data;







            $('#hubQuotationNumber').text(data.quotation_number || '-');

            $('#hubTripCode').text(data.trip_code || '');
            if (!data.trip_code) $('#hubTripCode').hide(); else $('#hubTripCode').show();

            $('#hubQuotationTitle').text(data.quotation_title || data.quotation_number || '-');

            if (hasPermission('QUOTATION_HUB_EDIT')) {
                $('#hubEditTitleBtn').show();
            } else {
                $('#hubEditTitleBtn').hide();
            }



            $('#hubGuestName').text(data.guest_name || '-');



            $('#hubLeadNumber').text(data.leads_number || '-');



            $('#hubLeadType').text(data.lead_type || '-');



            $('#hubStartDate').text(data.start_date || '-');



            $('#hubDuration').text(data.duration ? formatDuration(data.duration) : '-');



            $('#hubEndDate').text(data.end_date || '-');



            $('#hub_lead_id').val(data.leads_id || '');







            var statusHtml = '-';







            if (data.quotation_current_status == 1) statusHtml = '<span class="badge badge-secondary">Generated</span>';



            else if (data.quotation_current_status == 2) statusHtml = '<span class="badge badge-light">Draft</span>';



            else if (data.quotation_current_status == 3) statusHtml = '<span class="badge badge-info">Sent</span>';



            else if (data.quotation_current_status == 4) statusHtml = '<span class="badge badge-danger">Rejected</span>';



            else if (data.quotation_current_status == 5) statusHtml = '<span class="badge badge-success">Confirmed</span>';



            else if (data.quotation_current_status == 6) statusHtml = '<span class="badge badge-danger">Cancelled</span>';



            else if (data.quotation_current_status == 8) statusHtml = '<span class="badge badge-info">Reservation Completed</span>';



            else if (data.quotation_current_status == 9) statusHtml = '<span class="badge badge-warning">Driver Not Assigned</span>';



            else if (data.quotation_current_status == 7) statusHtml = '<span class="badge badge-primary">Ready to Trip</span>';

            else if (data.quotation_current_status == 10) statusHtml = '<span class="badge badge-success">Trip Completed</span>';







            $('#hubQuotationStatus').html(statusHtml);



            // Show confirmed option inside the status card

            if ((data.quotation_current_status == 5 || data.quotation_current_status == 8) && data.confirmed_option_title) {

                $('#hubStatusConfirmedOption').show();

                $('#hubStatusOptionText').text(data.confirmed_option_title);

            } else {

                $('#hubStatusConfirmedOption').hide();

                $('#hubStatusOptionText').text('');

            }



            // Store status for tab/button control



            $('#hubQuotationStatus').data('status', data.quotation_current_status);







            // Update action buttons and tabs based on status



            updateQuotationHubActions(data.quotation_current_status);



            // Update review card

            updateReviewCard(data);



        },



        error: function(xhr) {



            console.log('AJAX error:', xhr.responseText);



        }



    });



}







// Update buttons and tabs based on quotation status



function updateQuotationHubActions(status) {



    var buttonsHtml = '';







    // Status 2=Draft, 3=Sent, 4=Rejected: Show Generate button (permission required)



    if ((status == 2 || status == 3 || status == 4) && hasPermission('GENERATE_QUOTATION')) {



        buttonsHtml = '<button type="button" class="btn btn-primary btn-sm" onclick="showGenerateModal()">' +



                      '<i class="la la-file-alt me-1"></i> Generate Quotation</button>';



    }



    // Status 1=Generated: Show Confirm button (permission required, first EMI approved by accountant required)



    else if (status == 1 && hasPermission('CONFIRM_QUOTATION')) {



        var hubSummary = window._hubSummaryData || {};

        var firstEmiApproved = hubSummary.first_emi_approved == true;

        var firstEmiPaymentPending = hubSummary.first_emi_payment_pending == true;



        if (firstEmiApproved) {

            buttonsHtml = '<button type="button" class="btn btn-success btn-sm" onclick="showConfirmModal()">' +

                          '<i class="la la-check-circle me-1"></i> Confirm Quotation</button>';

        } else {

            buttonsHtml = '<button type="button" class="btn btn-success btn-sm" disabled title="First installment payment must be approved by accountant">' +

                          '<i class="la la-check-circle me-1"></i> Confirm Quotation</button>';

            if (firstEmiPaymentPending) {

                buttonsHtml += '<div class="text-danger mt-1 small">Waiting for accounts approve on advance payment to confirm</div>';

            }

        }



    }



    // Status 5=Confirmed: Show reservation completed button (enabled once all properties reconfirmed)



    else if (status == 5) {



        var hubSummary = window._hubSummaryData || {};

        var allPropertiesReserved = hubSummary.all_properties_reserved == true;



        var confirmedOption = $('#hubStatusOptionText').text();

        var optionLabel = confirmedOption ? ' <span style="background:#fff;color:#155724;padding:2px 8px;border-radius:12px;margin-left:6px;font-size:14px;">' + confirmedOption + '</span>' : '';



        buttonsHtml = '<span class="badge badge-success p-2" style="font-size:16px;padding:10px 16px;"><i class="la la-check me-1"></i> Quotation Confirmed' + optionLabel + '</span> ';

        if (hasPermission('PROPERTY_RESERVATION')) {

            if (allPropertiesReserved) {

                buttonsHtml += '<button type="button" class="btn btn-success btn-sm ms-2" onclick="showMarkReservationCompletedModal()"><i class="la la-check-circle me-1"></i> Reservation Completed</button>';

            } else {

                buttonsHtml += '<button type="button" class="btn btn-success btn-sm ms-2" disabled title="All property reservations must be reconfirmed first"><i class="la la-check-circle me-1"></i> Reservation Completed</button>';

            }

        }

        if (hasPermission('BOOKING_CANCELLATION_VIEW')) {

            buttonsHtml += '<a href="<?php echo base_url(); ?>index.php/Booking_cancellation/index/' + $('#quotation_id').val() + '" class="btn btn-danger btn-sm ms-2"><i class="la la-ban me-1"></i> Cancel Booking</a>';

        }

        buttonsHtml += buildEditQuotationButton();



    }



    // Status 8=Reservation Completed: Show confirmed badge + Transporter Allocation; voucher/itinerary tabs enabled



    else if (status == 8) {



        var confirmedOption = $('#hubStatusOptionText').text();

        var optionLabel = confirmedOption ? ' <span style="background:#fff;color:#155724;padding:2px 8px;border-radius:12px;margin-left:6px;font-size:14px;">' + confirmedOption + '</span>' : '';

        buttonsHtml = '<span class="badge badge-info p-2" style="font-size:16px;padding:10px 16px;"><i class="la la-check me-1"></i> Reservation Completed' + optionLabel + '</span> ';

        if (hasPermission('DRIVER_ITINERARY')) {

            buttonsHtml += '<button type="button" class="btn btn-warning btn-sm ms-2" onclick="showDriverAllocationModal()"><i class="la la-car me-1"></i> Transporter Allocation</button>';

        }

        if (hasPermission('BOOKING_CANCELLATION_VIEW')) {

            buttonsHtml += '<a href="<?php echo base_url(); ?>index.php/Booking_cancellation/index/' + $('#quotation_id').val() + '" class="btn btn-danger btn-sm ms-2"><i class="la la-ban me-1"></i> Cancel Booking</a>';

        }

        buttonsHtml += buildEditQuotationButton();

        buttonsHtml += buildVoucherDropdown();



    }



    // Status 9=Driver Not Assigned


    else if (status == 9) {

        buttonsHtml = '<span class="badge badge-warning p-2" style="font-size:16px;padding:10px 16px;"><i class="la la-car me-1"></i> Driver Not Assigned</span> ';

        if (hasPermission('DRIVER_ITINERARY')) {

            buttonsHtml += '<button type="button" class="btn btn-warning btn-sm ms-2" onclick="showDriverAllocationModal()"><i class="la la-edit me-1"></i> Edit Transporter Allocation</button>';

            buttonsHtml += '<button type="button" class="btn btn-success btn-sm ms-2" onclick="hubOpenAssignDriverModal()"><i class="la la-user-plus me-1"></i> Assign Driver Details</button>';

        }

        if (hasPermission('BOOKING_CANCELLATION_VIEW')) {

            buttonsHtml += '<a href="<?php echo base_url(); ?>index.php/Booking_cancellation/index/' + $('#quotation_id').val() + '" class="btn btn-danger btn-sm ms-2"><i class="la la-ban me-1"></i> Cancel Booking</a>';

        }

        buttonsHtml += buildEditQuotationButton();

        buttonsHtml += buildVoucherDropdown();



    }



    // Status 7=Ready to Trip



    else if (status == 7) {



        buttonsHtml = '<span class="badge badge-primary p-2" style="font-size:16px;padding:10px 16px;"><i class="la la-car me-1"></i> Ready to Trip</span> ';

        if (hasPermission('DRIVER_ITINERARY')) {

            buttonsHtml += '<button type="button" class="btn btn-warning btn-sm ms-2" onclick="showDriverAllocationModal()"><i class="la la-edit me-1"></i> Edit Transporter Allocation</button>';

            buttonsHtml += '<button type="button" class="btn btn-success btn-sm ms-2" onclick="hubOpenAssignDriverModal()"><i class="la la-user-edit me-1"></i> Edit Driver Details</button>';

        }

        var hubSummary7 = window._hubSummaryData || {};
        if (hubSummary7.all_payments_complete == true) {
            buttonsHtml += '<button type="button" class="btn btn-success btn-sm ms-2" onclick="markTripCompleted()"><i class="la la-check-circle me-1"></i> Mark as Trip Completed</button>';
        } else {
            buttonsHtml += '<span title="All payments must be completed before marking trip as completed" data-bs-toggle="tooltip"><button type="button" class="btn btn-success btn-sm ms-2" disabled style="pointer-events:none;"><i class="la la-check-circle me-1"></i> Mark as Trip Completed</button></span>';
        }

        if (hasPermission('BOOKING_CANCELLATION_VIEW')) {

            buttonsHtml += '<a href="<?php echo base_url(); ?>index.php/Booking_cancellation/index/' + $('#quotation_id').val() + '" class="btn btn-danger btn-sm ms-2"><i class="la la-ban me-1"></i> Cancel Booking</a>';

        }

        buttonsHtml += buildEditQuotationButton();

        buttonsHtml += buildVoucherDropdown();



    }



    // Status 10=Trip Completed



    else if (status == 10) {



        buttonsHtml = '<span class="badge badge-success p-2" style="font-size:16px;padding:10px 16px;"><i class="la la-check-circle me-1"></i> Trip Completed</span> ';

        if (window._hubSummaryData && window._hubSummaryData.driver_name) {
            buttonsHtml += '<button type="button" class="btn btn-info btn-sm ms-2" onclick="hubViewDriverDetails()"><i class="la la-eye me-1"></i> View Driver Details</button>';
        }

        buttonsHtml += buildVoucherDropdown();



    }



    // Status 6=Cancelled



    else if (status == 6) {



        buttonsHtml = '<span class="badge badge-danger p-2" style="font-size:16px;padding:10px 16px;"><i class="la la-ban me-1"></i> Cancelled</span> ';

        if (hasPermission('BOOKING_CANCELLATION_VIEW')) {

            buttonsHtml += '<a href="<?php echo base_url(); ?>index.php/Booking_cancellation" class="btn btn-outline-danger btn-sm ms-2"><i class="la la-eye me-1"></i> View Cancellation Records</a>';

        }



    }







    $('#quotationActionButtons').html(buttonsHtml);

    // Initialize tooltips for any disabled button wrappers
    $('#quotationActionButtons [data-bs-toggle="tooltip"]').each(function() {
        new bootstrap.Tooltip(this);
    });







    // Tab enabling/disabling logic



    // Group 1: Client confirmation, Receipt Scheduler, Property reservation



    // Enabled for status 1, 5, 8, 9, 7



    var group1Enabled = (status == 1 || status == 5 || status == 8 || status == 9 || status == 7 || status == 10);



    toggleTab('tabClientConfirmation', group1Enabled,



        status == 1 ? 'Generate quotation to enable this tab' :



        (status == 5 ? '' : 'Quotation must be generated first'));



    toggleTab('tabReceiptScheduler', group1Enabled,



        status == 1 ? '' :



        (status == 5 ? '' : 'Quotation must be generated first'));



    var propertyReservationEnabled = (status == 5 || status == 8 || status == 9 || status == 7 || status == 10);



    toggleTab('tabPropertyReservation', propertyReservationEnabled,



        status == 5 ? '' : 'Quotation must be confirmed first');







    // Group 2: Financial posting

    // Enabled only for status 10 (Trip Completed)

    var group2Enabled = (status == 10);

    var group2Tooltip = group2Enabled ? '' : 'Trip must be completed to enable financial posting';



    toggleTab('tabFinancialPosting', group2Enabled, group2Tooltip);



}



function updateReviewCard(data) {

    var reviewCard = $('#hubReviewCard');

    var reviewDisplay = $('#hubReviewDisplay');

    var reviewAction = $('#hubReviewAction');



    // Show review card only when status is 10 (Trip Completed)

    if (data.quotation_current_status != 10) {

        reviewCard.hide();

        return;

    }



    reviewCard.show();



    var reviewId = data.review_id || null;

    var reviewRating = parseInt(data.review_rating) || 0;



    if (reviewId && reviewRating > 0) {

        var stars = '';

        for (var i = 1; i <= 5; i++) {

            stars += '<i class="la la-star" style="color:' + (i <= reviewRating ? '#ffc107' : '#ccc') + ';font-size:22px;"></i>';

        }

        reviewDisplay.html(stars + ' <span class="badge bg-success ms-2">Reviewed</span>');

        if (data.review_comment) {

            reviewDisplay.append('<div style="font-size:13px;color:#6c757d;margin-top:4px;font-weight:400;">' + $('<div>').text(data.review_comment).html() + '</div>');

        }

        if (hasPermission('QUOTATION_REVIEW')) {

            reviewAction.html('<button type="button" class="btn btn-warning btn-sm" onclick="openReviewModal(' + reviewRating + ', ' + '\'' + (data.review_comment || '').replace(/'/g, "\\'") + '\'' + ')"><i class="la la-edit me-1"></i> Update Review</button>');

        } else {

            reviewAction.empty();

        }

    } else {

        reviewDisplay.html('<span class="badge bg-warning">Review Pending</span>');

        if (hasPermission('QUOTATION_REVIEW')) {

            reviewAction.html('<button type="button" class="btn btn-primary btn-sm" onclick="openReviewModal(0, \'\')"><i class="la la-star me-1"></i> Add Review</button>');

        } else {

            reviewAction.empty();

        }

    }

}



function openReviewModal(currentRating, currentComment) {

    var quotation_id = $('#quotation_id').val();

    $('#review_quotation_id').val(quotation_id);

    $('#review_rating_input').val(currentRating);

    $('#review_comment_input').val(currentComment);



    // Reset stars

    $('.review-star').css('color', '#ccc');

    for (var i = 1; i <= currentRating; i++) {

        $('.review-star[data-val="' + i + '"]').css('color', '#ffc107');

    }



    var ratingLabels = ['', 'Poor', 'Fair', 'Good', 'Very Good', 'Excellent'];

    if (currentRating > 0) {

        $('#reviewRatingText').text(ratingLabels[currentRating]);

    } else {

        $('#reviewRatingText').text('Select a rating');

    }



    new bootstrap.Modal(document.getElementById('hubReviewModal')).show();

}



$(document).on('click', '.review-star', function() {

    var val = parseInt($(this).data('val'));

    $('#review_rating_input').val(val);

    $('.review-star').css('color', '#ccc');

    for (var i = 1; i <= val; i++) {

        $('.review-star[data-val="' + i + '"]').css('color', '#ffc107');

    }

    var ratingLabels = ['', 'Poor', 'Fair', 'Good', 'Very Good', 'Excellent'];

    $('#reviewRatingText').text(ratingLabels[val]);

});



$(document).on('mouseenter', '.review-star', function() {

    var val = parseInt($(this).data('val'));

    $('.review-star').css('color', '#ccc');

    for (var i = 1; i <= val; i++) {

        $('.review-star[data-val="' + i + '"]').css('color', '#ffc107');

    }

});



$(document).on('mouseleave', '#reviewStarContainer', function() {

    var currentVal = parseInt($('#review_rating_input').val()) || 0;

    $('.review-star').css('color', '#ccc');

    for (var i = 1; i <= currentVal; i++) {

        $('.review-star[data-val="' + i + '"]').css('color', '#ffc107');

    }

});



function submitReview() {

    var quotation_id = $('#review_quotation_id').val();

    var rating = parseInt($('#review_rating_input').val());

    var comment = $('#review_comment_input').val();



    if (!quotation_id) {

        alert('Quotation ID missing');

        return;

    }

    if (rating < 1 || rating > 5) {

        alert('Please select a rating (1-5 stars)');

        return;

    }



    $.ajax({

        url: '<?php echo base_url(); ?>index.php/Quotation/ajax_update_review',

        type: 'POST',

        data: {

            quotation_id: quotation_id,

            review_rating: rating,

            review_comment: comment

        },

        dataType: 'json',

        success: function(res) {

            if (res.status) {

                bootstrap.Modal.getInstance(document.getElementById('hubReviewModal')).hide();

                swal('Review updated successfully', '', 'success').then(function() {

                    window.location.reload();

                });

            } else {

                alert(res.message || 'Failed to update review');

            }

        },

        error: function(xhr) {

            alert('Error: ' + xhr.responseText);

        }

    });

}



function buildEditQuotationButton() {

    var quotation_id = $('#quotation_id').val();

    if (!quotation_id) return '';

    if (!hasPermission('QUOTATION_HUB_EDIT')) return '';

    return '<button type="button" class="btn btn-secondary btn-sm ms-2" onclick="edit_quotation_hub(' + quotation_id + ')"><i class="la la-edit me-1"></i> Edit Quotation</button>';

}

function hubOpenEditTitleModal() {
    var quotation_id = $('#quotation_id').val();
    if (!quotation_id) return;
    var currentTitle = $('#hubQuotationTitle').text().trim();
    $('#hub_edit_title_id').val(quotation_id);
    $('#hub_edit_title_input').val(currentTitle);
    $('#hubEditTitleModal').modal('show');
    setTimeout(function() { $('#hub_edit_title_input').focus(); }, 300);
}

function hubSaveTitle() {
    var quotation_id = $('#hub_edit_title_id').val();
    var title = $.trim($('#hub_edit_title_input').val());

    if (!quotation_id) {
        var n = new notify({ title: '', style: 'error', message: 'Quotation ID missing.', icon: 'fas fa-times' });
        n.show(); setTimeout(function(){ n.hide(); }, 3000);
        return;
    }
    if (title === '') {
        var n = new notify({ title: '', style: 'error', message: 'Quotation title is required.', icon: 'fas fa-times' });
        n.show(); setTimeout(function(){ n.hide(); }, 3000);
        $('#hub_edit_title_input').focus();
        return;
    }

    $.ajax({
        url: "<?php echo base_url(); ?>index.php/Quotation/ajax_update_quotation_title",
        type: "POST",
        dataType: "json",
        data: {
            quotation_id: quotation_id,
            quotation_title: title
        },
        success: function(res) {
            if (res.status) {
                $('#hubQuotationTitle').text(res.quotation_title || title);
                $('#hubEditTitleModal').modal('hide');
                var n = new notify({ title: '', style: 'success', message: res.message || 'Quotation title updated.', icon: 'fas fa-check' });
                n.show(); setTimeout(function(){ n.hide(); }, 3000);
            } else {
                var n = new notify({ title: '', style: 'error', message: res.message || 'Failed to update title.', icon: 'fas fa-times' });
                n.show(); setTimeout(function(){ n.hide(); }, 3000);
            }
        },
        error: function() {
            var n = new notify({ title: '', style: 'error', message: 'Server error. Please try again.', icon: 'fas fa-times' });
            n.show(); setTimeout(function(){ n.hide(); }, 3000);
        }
    });
}



function buildVoucherDropdown() {

    var quotation_id = $('#quotation_id').val();

    if (!quotation_id) return '';

    var baseUrl = '<?php echo base_url(); ?>index.php/Quotation/';

    var html = '<div class="btn-group ms-2">';

    html += '<button type="button" class="btn btn-info btn-sm dropdown-toggle" data-bs-toggle="dropdown" aria-expanded="false"><i class="la la-ellipsis-h me-1"></i> Actions</button>';

    html += '<ul class="dropdown-menu dropdown-menu-end">';

    if (hasPermission('PROPERTY_VOUCHER')) {

        html += '<li><a class="dropdown-item" target="_blank" href="' + baseUrl + 'property_voucher_preview/' + quotation_id + '"><i class="la la-building me-2"></i>Property Voucher</a></li>';

    }

    if (hasPermission('TOUR_VOUCHER')) {

        html += '<li><a class="dropdown-item" target="_blank" href="' + baseUrl + 'tour_voucher_preview/' + quotation_id + '"><i class="la la-map me-2"></i>Tour Voucher</a></li>';

    }

    if (hasPermission('DRIVER_ITINERARY')) {

        html += '<li><a class="dropdown-item" target="_blank" href="' + baseUrl + 'driver_itinerary_preview/' + quotation_id + '"><i class="la la-car me-2"></i>Driver Itinerary</a></li>';

    }

    html += '</ul></div>';

    return html;

}







function toggleTab(tabId, enabled, tooltipMessage) {



    var $tab = $('#' + tabId);



    // Tab may not exist in DOM if user lacks permission — silently skip

    if (!$tab.length) return;



    // Dispose existing tooltip



    var existingTooltip = bootstrap.Tooltip.getInstance($tab[0]);



    if (existingTooltip) {



        existingTooltip.dispose();



    }







    if (enabled) {



        $tab.removeClass('disabled-tab tab-disabled');



        $tab.removeAttr('title');



        $tab.removeAttr('data-bs-toggle');



        $tab.attr('data-bs-toggle', 'tab');



    } else {



        $tab.addClass('disabled-tab tab-disabled');



        if (tooltipMessage) {



            $tab.attr('title', tooltipMessage);



            $tab.attr('data-bs-toggle', 'tooltip');



            // Initialize tooltip



            new bootstrap.Tooltip($tab[0]);



        }



        // Remove tab toggle to prevent opening



        $tab.off('click').on('click', function(e) {



            e.preventDefault();



            return false;



        });



    }



}







function showGenerateModal() {



    $('#generateQuotationModal').modal('show');



}







function showDriverAllocationModal() {



    var quotation_id = $('#quotation_id').val();

    var summaryData = window._hubSummaryData || {};



    // Load transporters into select2 dropdown, then pre-fill saved values

    $.ajax({

        url: "<?php echo base_url(); ?>index.php/Quotation/ajax_get_transporters",

        type: "POST",

        dataType: "json",

        success: function(res) {

            var $sel = $('#da_transporter_id');

            $sel.empty().append('<option value="">-- Select Transporter --</option>');

            if (res.status && res.data) {

                $.each(res.data, function(i, t) {

                    $sel.append('<option value="' + t.transporter_id + '">' + t.transporter_name + '</option>');

                });

            }

            if ($.fn.select2) {

                $sel.select2({ dropdownParent: $('#driverAllocationModal'), placeholder: '-- Select Transporter --', allowClear: true, width: '100%' });

            }

            // Pre-fill transporter after options are populated

            var savedTransporter = summaryData.quotation_transporter_id_fk || '';

            if (savedTransporter) {

                $sel.val(savedTransporter).trigger('change');

            }

        }

    });



    $('#driverAllocationModal').off('shown.bs.modal').on('shown.bs.modal', function() {

        $('#da_transporter_id').next('.select2').find('.select2-selection').focus();

    });



    $(document).off('select2:open', '#da_transporter_id').on('select2:open', '#da_transporter_id', function() {

        setTimeout(function() {

            document.querySelector('.select2-container--open .select2-search__field').focus();

        }, 50);

    });



    $('#driverAllocationModal').modal('show');



}







function submitDriverAllocation() {



    var quotation_id = $('#quotation_id').val();

    var transporter_id = $('#da_transporter_id').val();



    if (!quotation_id) {

        var n = new notify({ title: '', style: 'error', message: 'Quotation ID missing.', icon: 'fas fa-times' });

        n.show(); setTimeout(function(){ n.hide(); }, 3000);

        return;

    }



    if (!transporter_id) {

        $('#da_transporter_id').closest('.form-group, .mb-3').addClass('input-warning-o');

        $('#da_transporter_id').focus();

        var n = new notify({ title: '', style: 'error', message: 'Please select a transporter.', icon: 'fas fa-times' });

        n.show(); setTimeout(function(){ n.hide(); }, 3000);

        return;

    }



    $('#da_transporter_id').closest('.form-group, .mb-3').removeClass('input-warning-o');



    $.ajax({

        url: "<?php echo base_url(); ?>index.php/Quotation/ajax_driver_allocation",

        type: "POST",

        dataType: "json",

        data: {

            quotation_id:   quotation_id,

            transporter_id: $('#da_transporter_id').val()

        },

        success: function(res) {

            $('#driverAllocationModal').modal('hide');

            if (res.status) {

                loadQuotationHubSummary(quotation_id);

                var n = new notify({ title: '', style: 'success', message: 'Transporter allocated successfully! Status set to Driver Not Assigned.', icon: 'fas fa-check' });

                n.show(); setTimeout(function(){ n.hide(); }, 3000);

            } else {

                var n = new notify({ title: '', style: 'error', message: res.message || 'Failed to allocate transporter.', icon: 'fas fa-times' });

                n.show(); setTimeout(function(){ n.hide(); }, 5000);

            }

        },

        error: function() {

            $('#driverAllocationModal').modal('hide');

            var n = new notify({ title: '', style: 'error', message: 'Server error occurred.', icon: 'fas fa-times' });

            n.show(); setTimeout(function(){ n.hide(); }, 5000);

        }

    });



}







/* ===== Assign Driver Details (from hub) ===== */

function hubOpenAssignDriverModal() {
    var data = window._hubSummaryData || {};
    var quotation_id = $('#quotation_id').val();

    $('#hub_ad_allocation_id').val(data.allocation_id || '');
    $('#hub_ad_quotation_id').val(quotation_id);
    $('#hub_ad_vehicle_name').text(data.confirmed_vehicle_name || '-');
    $('#hub_ad_driver_name').val(data.driver_name || '');
    $('#hub_ad_driver_mobile').val(data.driver_mobile || '');
    $('#hub_ad_cab_number').val(data.cab_number || '');

    $('#hub_ad_guest_count').text('Loading...');
    $.ajax({
        url: "<?php echo base_url(); ?>index.php/Quotation/ajax_get_transporter_guest_details",
        type: "POST",
        dataType: "json",
        data: { quotation_id: quotation_id },
        success: function(res) {
            if (res.status && res.data) {
                var gc = res.data.guest_count || [];
                var totalAdults = 0, totalChildren = 0;
                for (var i = 0; i < gc.length; i++) {
                    totalAdults += parseInt(gc[i].adults || 0);
                    totalChildren += parseInt(gc[i].children || 0);
                }
                var childAges = [];
                for (var i = 0; i < gc.length; i++) {
                    if (gc[i].child_ages) {
                        for (var j = 0; j < gc[i].child_ages.length; j++) {
                            if (parseInt(gc[i].child_ages[j].count) > 0) {
                                childAges.push(gc[i].child_ages[j].age + ' yrs (' + gc[i].child_ages[j].count + ')');
                            }
                        }
                    }
                }
                var childAgeStr = childAges.length > 0 ? childAges.join(', ') : '0';
                $('#hub_ad_guest_count').text(totalAdults + ' Adults, ' + totalChildren + ' Children (' + childAgeStr + ')');
            } else {
                $('#hub_ad_guest_count').text('-');
            }
        },
        error: function() {
            $('#hub_ad_guest_count').text('-');
        }
    });

    $('#hubAssignDriverModal').modal('show');
}

function hubSubmitAssignDriver() {
    var allocation_id = $('#hub_ad_allocation_id').val();
    var quotation_id  = $('#hub_ad_quotation_id').val();
    var driver_name   = $.trim($('#hub_ad_driver_name').val());
    var driver_mobile = $.trim($('#hub_ad_driver_mobile').val());
    var cab_number    = $.trim($('#hub_ad_cab_number').val());

    if (!driver_name) {
        var n = new notify({ title: '', style: 'error', message: 'Driver name is required.', icon: 'fas fa-times' });
        n.show(); setTimeout(function(){ n.hide(); }, 3000);
        $('#hub_ad_driver_name').focus();
        return;
    }
    if (!driver_mobile) {
        var n = new notify({ title: '', style: 'error', message: 'Driver mobile is required.', icon: 'fas fa-times' });
        n.show(); setTimeout(function(){ n.hide(); }, 3000);
        $('#hub_ad_driver_mobile').focus();
        return;
    }
    if (!cab_number) {
        var n = new notify({ title: '', style: 'error', message: 'Cab number is required.', icon: 'fas fa-times' });
        n.show(); setTimeout(function(){ n.hide(); }, 3000);
        $('#hub_ad_cab_number').focus();
        return;
    }

    $.ajax({
        url: "<?php echo base_url(); ?>index.php/Quotation/ajax_update_driver_details",
        type: "POST",
        dataType: "json",
        data: {
            allocation_id: allocation_id,
            quotation_id:  quotation_id,
            driver_name:   driver_name,
            driver_mobile: driver_mobile,
            cab_number:    cab_number
        },
        success: function(res) {
            $('#hubAssignDriverModal').modal('hide');
            if (res.status) {
                loadQuotationHubSummary(quotation_id);
                var n = new notify({ title: '', style: 'success', message: res.message || 'Driver details updated. Status set to Ready to Trip.', icon: 'fas fa-check' });
                n.show(); setTimeout(function(){ n.hide(); }, 3000);
            } else {
                var n = new notify({ title: '', style: 'error', message: res.message || 'Failed to update driver details.', icon: 'fas fa-times' });
                n.show(); setTimeout(function(){ n.hide(); }, 5000);
            }
        },
        error: function() {
            $('#hubAssignDriverModal').modal('hide');
            var n = new notify({ title: '', style: 'error', message: 'Server error occurred.', icon: 'fas fa-times' });
            n.show(); setTimeout(function(){ n.hide(); }, 5000);
        }
    });
}

function hubViewDriverDetails() {
    var data = window._hubSummaryData || {};
    $('#hub_vd_transporter').text(data.transporter_name || '-');
    $('#hub_vd_vehicle').text(data.confirmed_vehicle_name || '-');
    $('#hub_vd_driver_name').text(data.driver_name || '-');
    $('#hub_vd_driver_mobile').text(data.driver_mobile || '-');
    $('#hub_vd_cab_number').text(data.cab_number || '-');
    $('#hubViewDriverModal').modal('show');
}



function showMarkReservationCompletedModal() {

    $('#markReservationCompletedModal').modal('show');

}



function markTripCompleted() {

    var quotation_id = $('#quotation_id').val();

    if (!confirm('Are you sure you want to mark this trip as completed?')) return;

    $.ajax({

        url: "<?php echo base_url(); ?>index.php/Quotation/ajax_mark_trip_completed",

        type: "POST",

        dataType: "json",

        data: { quotation_id: quotation_id },

        success: function(res) {

            if (res.status) {

                loadQuotationHubSummary(quotation_id);

                var n = new notify({ title: '', style: 'success', message: res.message || 'Trip marked as completed.', icon: 'fas fa-check' });

                n.show(); setTimeout(function(){ n.hide(); }, 3000);

            } else {

                var n = new notify({ title: '', style: 'error', message: res.message || 'Failed to mark trip as completed.', icon: 'fas fa-times' });

                n.show(); setTimeout(function(){ n.hide(); }, 5000);

            }

        },

        error: function() {

            var n = new notify({ title: '', style: 'error', message: 'Server error occurred.', icon: 'fas fa-times' });

            n.show(); setTimeout(function(){ n.hide(); }, 5000);

        }

    });

}



function showConfirmModal() {



    var quotation_id = $('#quotation_id').val();



    $.ajax({



        url: "<?php echo base_url(); ?>index.php/Quotation/ajax_check_confirmation_scheduler",



        type: "POST",



        dataType: "json",



        data: { quotation_id: quotation_id },



        success: function(res) {



            if (res.can_confirm) {



                $('#confirmQuotationModal').modal('show');



            } else {



                var msg = res.messages && res.messages.length



                    ? res.messages.join('<br>')



                    : 'Cannot confirm quotation.';



                var n = new notify({



                    title: '',



                    style: 'error',



                    message: 'Please complete the following before confirming:<br>' + msg,



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







// Generate Quotation - Update status to 1



$('#btnGenerateYes').on('click', function() {



    var quotation_id = $('#quotation_id').val();



    $.ajax({



        url: "<?php echo base_url(); ?>index.php/Quotation/ajax_update_status",



        type: "POST",



        dataType: "json",



        data: {



            quotation_id: quotation_id,



            status: 1



        },



        success: function(res) {



            $('#generateQuotationModal').modal('hide');



            if (res.status) {



                // Refresh summary to get updated status



                loadQuotationHubSummary(quotation_id);



                var n = new notify({



                    title: '',



                    style: 'success',



                    message: 'Quotation generated successfully!',



                    icon: 'fas fa-check'



                });



                n.show(); setTimeout(function(){ n.hide(); }, 3000);



            } else {



                var n = new notify({



                    title: '',



                    style: 'error',



                    message: res.message || 'Failed to generate quotation',



                    icon: 'fas fa-times'



                });



                n.show(); setTimeout(function(){ n.hide(); }, 5000);



            }



        },



        error: function() {



            $('#generateQuotationModal').modal('hide');



            var n = new notify({



                title: '',



                style: 'error',



                message: 'Server error occurred',



                icon: 'fas fa-times'



            });



            n.show(); setTimeout(function(){ n.hide(); }, 5000);



        }



    });



});







// Confirm Quotation - Update status to 5



$('#btnConfirmYes').on('click', function() {



    var quotation_id = $('#quotation_id').val();



    $.ajax({



        url: "<?php echo base_url(); ?>index.php/Quotation/ajax_update_status",



        type: "POST",



        dataType: "json",



        data: {



            quotation_id: quotation_id,



            status: 5



        },



        success: function(res) {



            $('#confirmQuotationModal').modal('hide');



            if (res.status) {



                // Refresh summary to get updated status



                loadQuotationHubSummary(quotation_id);



                var n = new notify({



                    title: '',



                    style: 'success',



                    message: 'Quotation confirmed successfully!',



                    icon: 'fas fa-check'



                });



                n.show(); setTimeout(function(){ n.hide(); }, 3000);



            } else {



                var n = new notify({



                    title: '',



                    style: 'error',



                    message: res.message || 'Failed to confirm quotation',



                    icon: 'fas fa-times'



                });



                n.show(); setTimeout(function(){ n.hide(); }, 5000);



            }



        },



        error: function() {



            $('#confirmQuotationModal').modal('hide');



            var n = new notify({



                title: '',



                style: 'error',



                message: 'Server error occurred',



                icon: 'fas fa-times'



            });



            n.show(); setTimeout(function(){ n.hide(); }, 5000);



        }



    });



});



// Mark Property Reservation Completed

$('#btnMarkReservationCompletedYes').on('click', function() {

    var quotation_id = $('#quotation_id').val();



    $.ajax({

        url: "<?php echo base_url(); ?>index.php/Quotation/ajax_mark_reservation_complete",

        type: "POST",

        dataType: "json",

        data: { quotation_id: quotation_id },

        success: function(res) {

            $('#markReservationCompletedModal').modal('hide');

            if (res.status) {

                loadQuotationHubSummary(quotation_id);

                var n = new notify({

                    title: '',

                    style: 'success',

                    message: res.message || 'Reservation marked as completed successfully.',

                    icon: 'fas fa-check'

                });

                n.show(); setTimeout(function(){ n.hide(); }, 3000);

            } else {

                var n = new notify({

                    title: '',

                    style: 'error',

                    message: res.message || 'Failed to mark reservation as completed.',

                    icon: 'fas fa-times'

                });

                n.show(); setTimeout(function(){ n.hide(); }, 5000);

            }

        },

        error: function() {

            $('#markReservationCompletedModal').modal('hide');

            var n = new notify({

                title: '',

                style: 'error',

                message: 'Server error occurred',

                icon: 'fas fa-times'

            });

            n.show(); setTimeout(function(){ n.hide(); }, 5000);

        }

    });

});







$(document).ready(function () {







    var quotation_id = $('#quotation_id').val();







    if (quotation_id && quotation_id != 0) {







        loadQuotationHubSummary(quotation_id);







        loadHubLeadDetails(quotation_id);







        loadHubAccommodationDetails(quotation_id);



    }







    // Initialize Bootstrap tooltips for disabled tabs



    var tooltipTriggerList = [].slice.call(document.querySelectorAll('[data-bs-toggle="tooltip"], [title]'));



    tooltipTriggerList.map(function (tooltipTriggerEl) {



        return new bootstrap.Tooltip(tooltipTriggerEl);



    });



});







function loadHubLeadDetails(quotation_id)



{



    $.ajax({



        url: "<?php echo base_url('index.php/Quotation/ajax_get_hub_lead_details/'); ?>" + quotation_id,



        type: "GET",



        dataType: "JSON",







        // success: function(response)



        // {



        //     if (!response.status) {







        //         $('#quotationLeadDetailsSection').html(`



        //             <div class="alert alert-warning mb-0">



        //                 Lead details not found.



        //             </div>



        //         `);







        //         return;



        //     }







        //     var d = response.data;







        //     var html = '';







        //     html += buildLeadTopSection(d);







        //     if ((d.lead_type || '').trim() === 'B2C') {



        //         html += buildB2CLayout(d);



        //     }



        //     else if ((d.lead_type || '').trim() === 'Meta Lead') {



        //         html += buildMetaLayout(d);



        //     }



        //     else if ((d.lead_type || '').trim() === 'B2B') {



        //         html += buildB2BLayout(d);



        //     }



        //     else {



        //         html += buildFallbackLayout(d);



        //     }







        //     $('#quotationLeadDetailsSection').html(html);



        // },







        success: function(response)



{



    if (!response.status) {



        $('#quotationLeadDetailsSection').html(`



            <div class="alert alert-warning mb-0">Lead details not found.</div>



        `);



        return;



    }







    var d = response.data;



    $('#quotationLeadDetailsSection').html(buildHubImportantLeadDetails(d));



},







        error: function()



        {



            $('#quotationLeadDetailsSection').html(`



                <div class="alert alert-danger mb-0">



                    Failed to load lead details.



                </div>



            `);



        }



    });



}







function buildHubImportantLeadDetails(d)



{



    return `



        <div class="card border-0 shadow-sm mb-4">



            <div class="card-header bg-white">



                <h5 class="mb-0 fw-bold">Lead Details</h5>



            </div>







            <div class="card-body">



                <div class="row g-3">







                    <div class="col-xl-3 col-lg-6 col-md-6">



                        ${buildHubInfoSection('Lead Overview', [



                            ['Lead Status', getStatusChipHtml(d.lead_current_status)],



                            ['Guest Name', d.guest_name],



                            ['Lead No', d.leads_number],



                            ['Lead Type', d.lead_type]



                        ])}



                    </div>







                    <div class="col-xl-3 col-lg-6 col-md-6">



                        ${buildHubInfoSection('Contact Details', [



                            ['WhatsApp Number', d.whats_number],



                            ['Assigned Staff', d.staff_name]



                        ])}



                    </div>







                    <div class="col-xl-3 col-lg-6 col-md-6">



                        ${buildHubInfoSection('Travel Details', [



                            ['Register Date', formatDate(d.lead_register_date)],



                            ['Travel Start Date', formatDate(d.start_date)],



                            ['Duration', d.duration ? formatDuration(d.duration) : '-'],



                            ['End Date', formatDate(d.end_date)]



                        ])}



                    </div>







                    <div class="col-xl-3 col-lg-6 col-md-6">



                        ${buildHubInfoSection('Created Details', [



                            ['Created Date', formatDateTime(d.leads_created_at)],



                            ['Created By User', d.created_by_admin_name],



                            ['Updated Date', formatDateTime(d.leads_updated_at)],



                            ['Updated By', d.updated_by_admin_name]



                        ])}
                    </div>







                </div>



            </div>



        </div>



    `;



}







function buildHubInfoSection(title, rows)



{



    var html = '';







    rows.forEach(function(row) {



        var label = row[0];



        var value = row[1];







        if (value === null || value === undefined || value === '') {



            value = '-';



        }







        html += `



            <div class="hub-info-row">



                <div class="hub-info-label">${escapeHtml(label)}</div>



                <div class="hub-info-value">${String(value).includes('<span') ? value : escapeHtml(value)}</div>



            </div>



        `;



    });







    return `



        <div class="hub-info-section h-100">



            <div class="hub-info-title">${escapeHtml(title)}</div>



            ${html}



        </div>



    `;



}







function loadHubAccommodationDetails(quotation_id)



{



    $.ajax({



        url: "<?php echo base_url('index.php/Quotation/ajax_guest_accommodation_details/'); ?>" + quotation_id,



        type: "GET",



        dataType: "JSON",







        success: function(response)



        {



            if (!response.status || !response.data || response.data.length === 0) {







                $('#quotationAccommodationSection').html(`



                    <div class="alert alert-warning mb-0">



                        No accommodation details found.



                    </div>



                `);







                return;



            }







            var html = `



                <div class="card border-0 shadow-sm">



                    <div class="card-header bg-white">



                        <h5 class="mb-0 fw-bold">Guest & Accommodation Details</h5>



                    </div>







                    <div class="card-body">







                        <div class="table-responsive">







                            <table class="table table-bordered align-middle">



                                <thead class="table-light">



                                    <tr>



                                        <th>Day</th>



                                        <th>Date</th>



                                        <th>Destination</th>



                                        <th>Adults</th>



                                        <th>Children</th>



                                        <th>Total</th>



                                        <th>Child Age</th>



                                        <th>Meal Plan</th>



                                    </tr>



                                </thead>







                                <tbody>



            `;







            $.each(response.data, function(i, row) {







                html += `



                    <tr>







                        <td>



                            <strong>${escapeHtml(row.day_name || row.day_label || '-')}</strong>







                            ${row.travel_back_flag === 'TB'



                                ? `<div class="mt-1">



                                        <span class="badge bg-info">



                                            Travel Back



                                        </span>



                                   </div>`



                                : ''



                            }



                        </td>







                        <td>${formatDate(row.accommodation_date)}</td>







                        <td>${escapeHtml(row.state_name || '-')}</td>







                        <td>${escapeHtml(row.adults || '0')}</td>







                        <td>${escapeHtml(row.children || '0')}</td>







                        <td>



                            <strong>${escapeHtml(row.total_count || '0')}</strong>



                        </td>







                        <td>${escapeHtml(row.child_age_breakup || '-')}</td>







                        <td>${escapeHtml(row.meal_plan_name || '-')}</td>







                    </tr>



                `;



            });







            html += `



                                </tbody>



                            </table>







                        </div>



                    </div>



                </div>



            `;







            $('#quotationAccommodationSection').html(html);



        },







        error: function()



        {



            $('#quotationAccommodationSection').html(`



                <div class="alert alert-danger mb-0">



                    Failed to load accommodation details.



                </div>



            `);



        }



    });



}







function getAccommodationRequiredBadge(value)



{



    if (value === 'R') {



        return '<span class="badge bg-success">Required</span>';



    }







    if (value === 'N') {



        return '<span class="badge bg-secondary">Not Required</span>';



    }







    // if (value === 'T') {



    //     return '<span class="badge bg-info">Travel Back Required</span>';



    // }







    return '<span class="badge bg-light text-dark">-</span>';



}















function normalizeValue(value)



{



    if (value === null || value === undefined || value === '') {



        return '-';



    }



    return value;



}











function formatDate(dateStr)



{



    if (!dateStr || dateStr === '0000-00-00') return '-';







    var parts = dateStr.split('-');



    if (parts.length !== 3) return dateStr;







    return parts[2] + '/' + parts[1] + '/' + parts[0];





    }







function formatDuration(dur)



    {



        var n = parseInt(dur, 10);



        if (isNaN(n) || n <= 0) return '-';







        var nights = n - 1;



        return nights + ' Night' + (nights !== 1 ? 's' : '') + ' ' + n + ' Day' + (n !== 1 ? 's' : '');







    }







function formatDateTime(dateTimeStr)
{
    if (!dateTimeStr || dateTimeStr === '0000-00-00 00:00:00') return '-';
    var parts = dateTimeStr.split(' ');
    if (parts.length !== 2) return dateTimeStr;
    var dateParts = parts[0].split('-');
    if (dateParts.length !== 3) return dateTimeStr;
    return dateParts[2] + '/' + dateParts[1] + '/' + dateParts[0] + ' ' + parts[1];
}







function getAccommodationStatusText(val)



    {



        return parseInt(val, 10) === 1 ? 'Completed' : 'Pending';







    }







function getLeadCurrentStatusText(val)



{



    val = parseInt(val, 10);







    if (val === 1) return 'In take';



    if (val === 2) return 'Qualified';



    if (val === 3) return 'Converted to trip';



    if (val === 4) return 'Not Qualified';



    if (val === 5) return 'Lost';







    return '-';



}







function getStatusChipHtml(statusValue)



{



    var text = getLeadCurrentStatusText(statusValue);



    var cls = 'status-intake';







    if (text === 'Qualified') cls = 'status-qualified';



    else if (text === 'Converted to trip') cls = 'status-converted';



    else if (text === 'Not Qualified') cls = 'status-notqualified';



    else if (text === 'Lost') cls = 'status-lost';







    return `<span class="status-chip ${cls}">${escapeHtml(text)}</span>`;



}







function escapeHtml(str)



{



    if (str === null || str === undefined) return '';



    return String(str)



        .replace(/&/g, '&amp;')



        .replace(/</g, '&lt;')



        .replace(/>/g, '&gt;')



        .replace(/"/g, '&quot;')



        .replace(/'/g, '&#039;');



}







function cleanButtonHtml(html)



{



    if (!html) return '-';







    return html



        .replace(/<center>/gi, '')



        .replace(/<\/center>/gi, '')



        .trim();



}











///////****** lead details tab reload ***//////////







$('a[href="#lead-details-tab-pane"]').on('shown.bs.tab', function () {



    var quotation_id = $('#quotation_id').val();



    if (quotation_id && quotation_id != 0) {



        loadHubLeadDetails(quotation_id);



    }



});







///////****** client confirmation ***//////////







$('a[href="#clientConfirmationTab"]').on('shown.bs.tab', function () {



    var quotation_id = $('#quotation_id').val();







    $.ajax({



        url: "<?php echo base_url(); ?>index.php/Quotation/ajax_get_saved_confirmation",



        type: "POST",



        dataType: "json",



        data: { quotation_id: quotation_id },



        success: function(saved) {



            loadConfirmationOptions(quotation_id, saved.status ? saved : null);



        },



        error: function() {



            loadConfirmationOptions(quotation_id, null);



        }



    });



});







var _confirmationSelectedOptionId = 0;



function loadConfirmationOptions(quotation_id, savedData)



{



    $.ajax({



        url: "<?php echo base_url(); ?>index.php/Quotation/ajax_get_confirmation_options",



        type: "POST",



        dataType: "json",



        data: { quotation_id: quotation_id },



        success: function(res) {



            var confirmationOptionsData = [];



            if (res.status && res.data) {

                confirmationOptionsData = res.data;

            }



            window._confirmationOptionsData = confirmationOptionsData;

            window._confirmationSavedData = savedData || null;



            renderOptionSummaryCards(confirmationOptionsData, savedData);



            // Export button: show if there's a confirmed option, hide otherwise

            if (savedData && savedData.option_id) {

                $('#copyExportConfirmationBtn')

                    .removeClass('d-none')

                    .data('quotation-id', quotation_id);

            } else {

                $('#copyExportConfirmationBtn').addClass('d-none');

            }



        }



    });



}







// Search filter for option cards

$(document).on('input', '#confirmationOptionSearch', function() {

    var term = $(this).val().toLowerCase().trim();

    $('#confirmationOptionSummary .confirmation-option-card').each(function() {

        var title = $(this).data('title').toString().toLowerCase();

        var vehicle = $(this).data('vehicle').toString().toLowerCase();

        if (!term || title.indexOf(term) !== -1 || vehicle.indexOf(term) !== -1) {

            $(this).closest('.confirmation-option-col').show();

        } else {

            $(this).closest('.confirmation-option-col').hide();

        }

    });

});







function openConfirmationOptionModal(optId)

{

    var quotation_id = $('#quotation_id').val();

    var optIdInt = parseInt(optId);



    // Track selected option

    window._confirmationSelectedOptionId = optIdInt;



    // Update card highlight (selected vs confirmed)

    updateOptionCardSelection(optIdInt);



    // Show export button only if this is the confirmed option

    var confirmedOptionId = (window._confirmationSavedData && window._confirmationSavedData.option_id) ? parseInt(window._confirmationSavedData.option_id) : 0;

    if (confirmedOptionId && confirmedOptionId === optIdInt) {

        $('#copyExportConfirmationBtn').removeClass('d-none').data('quotation-id', quotation_id);

    } else {

        $('#copyExportConfirmationBtn').addClass('d-none');

    }



    // Find option data for title

    var optData = null;

    if (window._confirmationOptionsData) {

        $.each(window._confirmationOptionsData, function(i, o) {

            if (parseInt(o.quotation_options_id) === optIdInt) { optData = o; return false; }

        });

    }



    var title = optData ? escapeHtml(optData.quotation_options_title || 'Option') : 'Option';

    $('#confirmationOptionModalTitle').text(title + ' — Property & Room Details');



    // Show loading in modal body

    $('#confirmationOptionModalBody').html(`

        <div class="text-center py-5">

            <div class="spinner-border text-primary"></div>

            <p class="mt-2 mb-0 text-muted">Loading option details...</p>

        </div>

    `);



    // Show modal

    var modalEl = document.getElementById('confirmationOptionModal');

    var bsModal = bootstrap.Modal.getInstance(modalEl) || new bootstrap.Modal(modalEl);

    bsModal.show();



    // Fetch saved rows so confirmation_ids are available for update on submit

    $.ajax({

        url: "<?php echo base_url(); ?>index.php/Quotation/ajax_get_saved_confirmation",

        type: "POST",

        dataType: "json",

        data: { quotation_id: quotation_id },

        success: function(saved) {

            var savedRows = saved.status ? saved.rows : [];

            var preCheck = saved.status && String(saved.option_id) === String(optId);

            loadConfirmationOptionDetails(quotation_id, optId, savedRows, preCheck);

        },

        error: function() {

            loadConfirmationOptionDetails(quotation_id, optId, [], false);

        }

    });

}







function updateOptionCardSelection(optId)

{

    $('.confirmation-option-card').each(function() {

        var $card = $(this);

        var cardOptId = parseInt($card.data('opt-id'));

        var isConfirmed = $card.hasClass('is-confirmed');



        if (cardOptId === optId && !isConfirmed) {

            // Selected (not confirmed) — amber/orange highlight

            $card.css('border', '2px solid #f59e0b').css('box-shadow', '0 4px 12px rgba(245,158,11,0.25)');

            $card.find('.confirmation-card-header').css('background', 'linear-gradient(135deg,#f59e0b,#f97316)');

        } else if (!isConfirmed) {

            // Reset to default

            $card.css('border', '1px solid #e5e7eb').css('box-shadow', '');

            $card.find('.confirmation-card-header').css('background', 'linear-gradient(135deg,#4a3ee0,#5a4ff0)');

        }

        // Confirmed cards keep their green styling regardless

    });

}







function loadConfirmationOptionDetails(quotation_id, quotation_options_id, savedRows, preCheck)



{

    savedRows = savedRows || [];

    if (preCheck === undefined) preCheck = true;



    $.ajax({

        url: "<?php echo base_url(); ?>index.php/Quotation/ajax_get_confirmation_option_details",

        type: "POST",

        dataType: "json",

        data: {

            quotation_id: quotation_id,

            quotation_options_id: quotation_options_id

        },

        success: function(res) {

            if (!res.status || !res.data.length) {

                $('#confirmationOptionModalBody').html(`

                    <div class="alert alert-warning m-3 mb-0">No details found for this option.</div>

                `);

                return;

            }



            $('#confirmationOptionModalBody').html(buildConfirmationDetailsTable(res.data, savedRows, preCheck));

        }

    });

}







function renderOptionSummaryCards(options, savedData)



{



    if (!options || options.length === 0) {



        $('#confirmationOptionSummary').html('<div class="alert alert-info mb-0">No options available for this quotation.</div>');



        return;



    }







    var confirmedOptionId = (savedData && savedData.option_id) ? savedData.option_id : 0;







    var html = '<div id="confirmationOptionSummary" class="mb-4">';



    html += '<div class="fw-bold mb-2" style="font-size:15px;color:#333;">Quotation Options Overview</div>';



    html += '<div class="row g-3">';







    $.each(options, function(i, opt) {



        var isConfirmed = (parseInt(confirmedOptionId) === parseInt(opt.quotation_options_id));



        var title = escapeHtml(opt.quotation_options_title || 'Option ' + (i + 1));



        var vehicle = opt.vehicle_name ? escapeHtml(opt.vehicle_name) : '';







        html += '<div class="col-md-6 col-lg-4 confirmation-option-col">';



        html += '<div class="card h-100 confirmation-option-card' + (isConfirmed ? ' is-confirmed' : '') + '" data-opt-id="' + opt.quotation_options_id + '" data-title="' + title + '" data-vehicle="' + vehicle + '" style="border:1px solid #e5e7eb;border-radius:8px;overflow:hidden;cursor:pointer;transition:all 0.3s ease;' + (isConfirmed ? 'border-color:#2e7d32;border-width:2px;' : '') + '" onclick="openConfirmationOptionModal(' + opt.quotation_options_id + ')">';







        // Header



        html += '<div class="confirmation-card-header" style="' + (isConfirmed ? 'background:linear-gradient(135deg,#2e7d32,#388e3c);color:#fff;' : 'background:linear-gradient(135deg,#4a3ee0,#5a4ff0);color:#fff;') + 'padding:12px 16px;">';



        html += '<div class="d-flex justify-content-between align-items-center">';



        html += '<span style="font-size:14px;font-weight:700;">Option ' + (i + 1) + ' &mdash; ' + title + '</span>';



        if (isConfirmed) {



            html += '<span style="background:rgba(255,255,255,0.2);padding:2px 8px;border-radius:4px;font-size:11px;font-weight:600;"><i class="fas fa-check-circle"></i> Confirmed</span>';



        }



        html += '</div>';



        if (vehicle) {



            html += '<div style="font-size:12px;opacity:0.9;margin-top:4px;"><i class="fas fa-car"></i> ' + vehicle + '</div>';



        }



        html += '</div>';







        // Body - cost summary cards



        html += '<div class="card-body p-2">';



        html += '<div class="row g-1 text-center">';







        var items = [



            { label: 'Hotel', value: opt.hotel_total || 0, color: '#1e40af' },



            { label: 'Transport', value: opt.cab_amount || 0, color: '#6b7280' },



            { label: 'Inclusions', value: opt.inclusion_total || 0, color: '#7c3aed' },



            { label: 'Special', value: opt.special_total || 0, color: '#db2777' },



            { label: 'Margin', value: opt.margin_value || 0, color: '#f59e0b' }



        ];







        $.each(items, function(j, item) {



            html += '<div class="col-6 col-md-4">';



            html += '<div style="background:#f8fafc;border-radius:6px;padding:8px 4px;">';



            html += '<div style="font-size:10px;color:#6b7280;text-transform:uppercase;letter-spacing:0.3px;">' + item.label + '</div>';



            html += '<div style="font-size:13px;font-weight:700;color:' + item.color + ';">&#8377;' + formatNumber(item.value) + '</div>';



            html += '</div>';



            html += '</div>';



        });







        html += '</div>'; // row







        // Grand total bar



        html += '<div style="background:linear-gradient(135deg,#1e3a8a,#3b82f6);color:#fff;border-radius:6px;padding:10px;margin-top:8px;text-align:center;">';



        html += '<span style="font-size:12px;opacity:0.9;">Grand Total</span><br>';



        html += '<span style="font-size:18px;font-weight:800;">&#8377;' + formatNumber(opt.grand_total || 0) + '</span>';



        html += '</div>';







        html += '</div>'; // card-body



        html += '</div>'; // card



        html += '</div>'; // col



    });







    html += '</div></div>';







    $('#confirmationOptionSummary').replaceWith(html);



}







function formatNumber(n)



{



    return parseFloat(n || 0).toLocaleString('en-IN', { minimumFractionDigits: 2, maximumFractionDigits: 2 });



}







function formatDateShort(dateStr)



{



    if (!dateStr) return '';



    var d = new Date(dateStr);



    if (isNaN(d.getTime())) return dateStr;



    var months = ['Jan','Feb','Mar','Apr','May','Jun','Jul','Aug','Sep','Oct','Nov','Dec'];



    return d.getDate() + ' ' + months[d.getMonth()] + ' ' + d.getFullYear();



}







function buildConfirmationDetailsTable(days, savedRows, preCheck)



{



    savedRows = savedRows || [];



    if (preCheck === undefined) preCheck = true;







    var savedMap = {};



    $.each(savedRows, function(i, r) {



        savedMap[r.properties_day_id_fk] = { id: r.id || 0, room_id: r.properties_room_id_fk };



    });







    var html = '<form id="confirmationSubmitForm" style="padding:0;margin:0;">';



    html += '<div style="padding:12px 20px;background:#eef2ff;border-bottom:1px solid #e5e7eb;font-size:13px;color:#4a3ee0;font-weight:600;">';



    html += '<i class="fas fa-info-circle me-1"></i> Select one room per day, then click Submit Confirmation.';



    html += '</div>';



    html += '<div style="overflow-x:auto;"><table id="confirmationDetailsTable" style="width:100%;border-collapse:collapse;font-size:13px;font-family:Poppins,sans-serif;">';



    html += '<thead><tr>';



    html += '<th style="background:#eef2ff;padding:10px 12px;text-align:left;font-weight:600;color:#4a3ee0;border-bottom:2px solid #e5e7eb;font-size:12px;text-transform:uppercase;letter-spacing:0.3px;width:180px;">Day &amp; Destination</th>';



    html += '<th style="background:#eef2ff;padding:10px 12px;text-align:left;font-weight:600;color:#4a3ee0;border-bottom:2px solid #e5e7eb;font-size:12px;text-transform:uppercase;letter-spacing:0.3px;">Property</th>';



    html += '<th style="background:#eef2ff;padding:10px 12px;text-align:left;font-weight:600;color:#4a3ee0;border-bottom:2px solid #e5e7eb;font-size:12px;text-transform:uppercase;letter-spacing:0.3px;">Room</th>';



    html += '<th style="background:#eef2ff;padding:10px 12px;text-align:right;font-weight:600;color:#4a3ee0;border-bottom:2px solid #e5e7eb;font-size:12px;text-transform:uppercase;letter-spacing:0.3px;width:90px;">Room Cost</th>';



    html += '<th style="background:#eef2ff;padding:10px 12px;text-align:right;font-weight:600;color:#4a3ee0;border-bottom:2px solid #e5e7eb;font-size:12px;text-transform:uppercase;letter-spacing:0.3px;width:80px;">Extra Bed</th>';



    html += '<th style="background:#eef2ff;padding:10px 12px;text-align:right;font-weight:600;color:#4a3ee0;border-bottom:2px solid #e5e7eb;font-size:12px;text-transform:uppercase;letter-spacing:0.3px;width:90px;">Total</th>';



    html += '<th style="background:#eef2ff;padding:10px 12px;text-align:center;font-weight:600;color:#4a3ee0;border-bottom:2px solid #e5e7eb;font-size:12px;text-transform:uppercase;letter-spacing:0.3px;width:50px;">Select</th>';



    html += '</tr></thead><tbody>';







    $.each(days, function(i, day) {



        if (!day.properties || !day.properties.length) return;



        var dayRowspan = 0;



        $.each(day.properties, function(j, prop) {



            if (prop.rooms && prop.rooms.length) dayRowspan += prop.rooms.length;



            else dayRowspan += 1;



        });



        var dayRendered  = false;



        var daySaved     = savedMap[day.quotation_properties_days_id] || {};



        var dayConfId    = daySaved.id      || 0;



        var dayRoomSaved = daySaved.room_id || 0;



        var dayDate = day.accommodation_date && day.accommodation_date !== '0000-00-00' ? formatDateShort(day.accommodation_date) : '';



        var dayDest = escapeHtml(day.state_name || '-');



        var isLastDay = (i === days.length - 1);







        $.each(day.properties, function(j, property) {



            var rooms = (property.rooms && property.rooms.length) ? property.rooms : [null];



            var propRowspan = rooms.length;



            var propRendered = false;



            var propCatName = property.property_category_name ? ' (' + escapeHtml(property.property_category_name) + ')' : '';



            var isLastProp = (j === day.properties.length - 1);







            $.each(rooms, function(k, room) {



                var roomName  = room ? escapeHtml(room.properties_room_category_name || '-') : '-';



                var roomCatId = room ? room.quotation_properties_rooms_id_fk : '';



                var roomQprId = room ? room.quotation_properties_rooms_id : '';



                var roomCost  = room ? formatNumber(room.room_unit_manual_total_rate || 0) : '0.00';



                var ebaCost   = room ? formatNumber((parseFloat(room.extra_bed_adult_manual_total_rate || 0) + parseFloat(room.extra_bed_child_manual_total_rate || 0))) : '0.00';



                var roomTotal = room ? formatNumber(room.manual_total_rate || 0) : '0.00';



                var isLastRoom = (k === rooms.length - 1);







                // Border between days: thick top border for first row of a new day

                var rowBorder = 'border-bottom:1px solid #f3f4f6;';



                if (isLastRoom && isLastProp) {



                    rowBorder = 'border-bottom:2px solid #e5e7eb;';



                }







                html += '<tr style="' + rowBorder + '">';







                if (!dayRendered) {



                    html += '<td rowspan="' + dayRowspan + '" style="background:#f0f4ff;font-weight:600;color:#4a3ee0;vertical-align:top;border-right:2px solid #e5e7eb;padding:12px 14px;width:180px;">';



                    html += '<input type="hidden" class="hid_days_id" value="' + day.quotation_properties_days_id + '">';



                    html += '<input type="hidden" class="hid_confirmation_id" value="' + dayConfId + '">';



                    html += '<input type="hidden" class="hid_destination_id" value="' + day.quotation_properties_days_destination_id_fk + '">';



                    html += '<div style="font-size:15px;font-weight:700;margin-bottom:4px;">' + escapeHtml(day.quotation_properties_days_day || '-') + '</div>';



                    if (dayDate) html += '<div style="font-size:12px;color:#6b7280;margin-bottom:4px;"><i class="far fa-calendar" style="margin-right:3px;"></i>' + dayDate + '</div>';



                    html += '<div style="font-size:12px;color:#374151;margin-bottom:4px;"><i class="fas fa-map-marker-alt" style="color:#4a3ee0;margin-right:3px;"></i>' + dayDest + '</div>';



                    if (day.meal_plan_name) {



                        html += '<span style="display:inline-block;background:#dbeafe;color:#1e40af;padding:2px 8px;border-radius:4px;font-size:11px;font-weight:600;margin-top:2px;"><i class="fas fa-utensils" style="font-size:11px;margin-right:2px;"></i>' + escapeHtml(day.meal_plan_name) + '</span>';



                    }



                    html += '</td>';



                    dayRendered = true;



                }







                if (!propRendered) {



                    var propBorderRight = 'border-right:1px solid #e5e7eb;';



                    var propBorderBottom = isLastProp ? '' : 'border-bottom:1px solid #e5e7eb;';



                    html += '<td rowspan="' + propRowspan + '" style="background:#eef2ff;font-weight:700;color:#4a3ee0;font-size:14px;padding:10px 12px;vertical-align:top;' + propBorderRight + propBorderBottom + '">';



                    html += '<input type="hidden" class="hid_property_id" value="' + property.properties_id_fk + '">';



                    html += escapeHtml(property.properties_name || '-') + propCatName;



                    html += '</td>';



                    propRendered = true;



                }







                var roomBorderBottom = (isLastRoom && !isLastProp) ? 'border-bottom:1px solid #e5e7eb;' : '';



                html += '<td style="padding:10px 12px;vertical-align:top;' + roomBorderBottom + '">';



                html += '<input type="hidden" class="hid_room_cat_id" value="' + roomCatId + '">';



                html += '<span style="font-size:13px;font-weight:500;">' + roomName + '</span>';



                html += '</td>';



                html += '<td style="padding:10px 12px;text-align:right;font-weight:600;color:#1e40af;white-space:nowrap;' + roomBorderBottom + '">&#8377;' + roomCost + '</td>';



                html += '<td style="padding:10px 12px;text-align:right;color:#6b7280;white-space:nowrap;' + roomBorderBottom + '">&#8377;' + ebaCost + '</td>';



                html += '<td style="padding:10px 12px;text-align:right;font-weight:700;color:#dc2626;white-space:nowrap;' + roomBorderBottom + '">&#8377;' + roomTotal + '</td>';



                html += '<td style="padding:10px 12px;text-align:center;vertical-align:middle;' + roomBorderBottom + '">';



                html += '<input type="checkbox" class="form-check-input confirmationRoomCheck"';



                html += ' data-days-id="' + day.quotation_properties_days_id + '"';



                html += ' data-destination-id="' + day.quotation_properties_days_destination_id_fk + '"';



                html += ' data-property-id="' + property.quotation_properties_id + '"';



                html += ' data-room-id="' + roomQprId + '"';



                html += ' data-qpr-id="' + roomQprId + '"';



                html += ' data-confirmation-id="' + dayConfId + '"';



                html += (preCheck && dayRoomSaved && String(dayRoomSaved) === String(roomQprId) ? ' checked' : '') + '>';



                html += '</td>';



                html += '</tr>';



            });



        });



    });







    html += '</tbody></table></div></form>';







    return html;



}



$(document).on('click', '#copyExportConfirmationBtn', function () {

    var quotationId = $(this).data('quotation-id');



    if (!quotationId) {

        alert('Quotation ID missing');

        return;

    }



    window.open(

        "<?php echo base_url(); ?>index.php/Quotation/client_confirmation_preview/" + quotationId,

        "_blank"

    );

});



$(document).on('change', '#confirmationDetailsTable .confirmationRoomCheck', function () {



    if (!this.checked) return;



    var dayId = $(this).data('days-id');



    $('#confirmationDetailsTable .confirmationRoomCheck[data-days-id="' + dayId + '"]').not(this).prop('checked', false);



});







$(document).on('click', '#btnSubmitConfirmation', function () {



    // Collect all unique day IDs present in the table



    var allDayIds = [];



    $('#confirmationDetailsTable .confirmationRoomCheck').each(function() {



        var dayId = String($(this).data('days-id'));



        if (allDayIds.indexOf(dayId) === -1) {



            allDayIds.push(dayId);



        }



    });







    // Verify at least one checkbox is checked per day



    var uncoveredDays = [];



    $.each(allDayIds, function(i, dayId) {



        var checkedForDay = $('#confirmationDetailsTable .confirmationRoomCheck[data-days-id="' + dayId + '"]:checked').length;



        if (checkedForDay === 0) {



            uncoveredDays.push(dayId);



        }



    });







    if (uncoveredDays.length > 0) {



        var n = new notify({ title: '', style: 'error', message: 'Please select at least one property/room for every day before submitting.', icon: 'fas fa-times' });



        n.show(); setTimeout(function(){ n.hide(); }, 5000);



        return;



    }







    if (!confirm('Are you sure you want to submit the client confirmation?')) return;



    var checked      = $('#confirmationDetailsTable .confirmationRoomCheck:checked');



    var quotation_id = $('#quotation_id').val();



    var option_id    = window._confirmationSelectedOptionId || 0;







    var rows = [];



    checked.each(function() {



        rows.push({



            confirmation_id       : $(this).data('confirmation-id') || 0,



            properties_day_id_fk  : $(this).data('days-id'),



            properties_id_fk      : $(this).data('property-id'),



            // properties_room_id_fk : $(this).data('room-cat-id')



            properties_id_fk: $(this).data('property-id'),

properties_room_id_fk: $(this).data('room-id')



        });



    });







    $.ajax({



        url: "<?php echo base_url(); ?>index.php/Quotation/ajax_save_confirmation",



        type: "POST",



        dataType: "json",



        data: {



            quotation_id : quotation_id,



            option_id    : option_id,



            rows         : rows



        },



        success: function(res) {



            var n = new notify({



                title   : '',



                style   : res.status ? 'success' : 'error',



                // On success the backend reports whether a property change retained
                // any previous reservation for cancellation, so surface its message.
                message : res.status
                          ? (res.message || 'Confirmation saved successfully.')
                          : ('Failed to save confirmation. ' + (res.message || '')),



                icon    : res.status ? 'fas fa-check' : 'fas fa-times'



            });



            n.show(); setTimeout(function(){ n.hide(); }, 5000);



            // Show Copy/Export button on success

            if (res.status) {

                // Update saved data so the confirmed option is tracked

                window._confirmationSavedData = { option_id: option_id, rows: [] };



                // Close the option details modal

                var optModalEl = document.getElementById('confirmationOptionModal');

                var optBsModal = bootstrap.Modal.getInstance(optModalEl);

                if (optBsModal) optBsModal.hide();



                // Reload options to reflect confirmed state (export button will show via loadConfirmationOptions)

                loadConfirmationOptions(quotation_id, { option_id: option_id, rows: [] });

            }



        },



        error: function() {



            var n = new notify({ title: '', style: 'error', message: 'Server error while saving confirmation.', icon: 'fas fa-times' });



            n.show(); setTimeout(function(){ n.hide(); }, 5000);



        }



    });



});





// ===== Receipt Scheduler Hub Functions =====







var hub_schedulerTable = null;



var hub_save_method = 'add';



var hub_currentSchedulerId = null;



var hub_res_current_quotation_id = 0;



var hub_res_current_properties_id = 0;



var hub_res_checkin_date = '';







// Initialize table when tab is clicked



$('#tabReceiptScheduler').on('shown.bs.tab', function() {



    var quotation_id = $('#quotation_id').val();



    // Check if client confirmation is saved before allowing access

    $.ajax({



        url: "<?php echo base_url(); ?>index.php/Quotation/ajax_get_saved_confirmation",



        type: "POST",



        dataType: "json",



        data: { quotation_id: quotation_id },



        success: function(saved) {



            if (!saved.status || !saved.option_id || !saved.rows || saved.rows.length === 0) {



                // Destroy stale DataTable reference since we're replacing the DOM

                hub_schedulerTable = null;



                // Show warning inside the tab pane

                $('#receiptSchedulerTab').html(`

                    <div class="pt-4">

                        <div class="alert alert-warning d-flex align-items-center gap-3" role="alert">

                            <i class="fas fa-exclamation-triangle fa-2x text-warning"></i>

                            <div>

                                <strong>Client Confirmation Required</strong><br>

                                Please complete the <strong>Client Confirmation</strong> before setting up the Receipt Scheduler.

                            </div>

                        </div>

                    </div>

                `);



                return;



            }



            // Client confirmation exists — restore tab HTML if it was replaced by warning

            if ($('#hub_scheduler_table').length === 0) {



                $('#receiptSchedulerTab').html(`

                    <div class="pt-3">

                        <div class="d-flex justify-content-between align-items-center mb-3">

                            <h5 class="mb-0 fw-bold">Receipt Scheduler - Payment Schedules</h5>

                            <button id="hub_addSchedulerBtn" onclick="hub_add_scheduler()" class="btn btn-rounded btn-primary btn-sm">+ Create Payment Schedule</button>

                        </div>

                        <div class="table-responsive">

                            <table id="hub_scheduler_table" class="display" style="min-width: 845px">

                                <thead>

                                    <tr>

                                        <th>Sl.no</th>

                                        <th>Quotation #</th>

                                        <th>Guest Name</th>

                                        <th>Payment Type</th>

                                        <th>Total Amount</th>

                                        <th>EMI Count</th>

                                        <th>Created Date</th>

                                        <th>Action</th>

                                    </tr>

                                </thead>

                                <tbody></tbody>

                            </table>

                        </div>

                    </div>

                `);



                hub_schedulerTable = null;



            }



            // Check if scheduler already exists — hide Add button if so

            $.ajax({

                url: "<?php echo base_url(); ?>index.php/Receipt_scheduler/get_scheduler_by_quotation",

                type: 'POST',

                data: { quotation_id: quotation_id },

                dataType: 'json',

                success: function(schedRes) {

                    if (schedRes && schedRes.receipt_scheduler_id) {

                        hub_scheduler_exists = true;

                        $('#hub_addSchedulerBtn').hide();

                    } else {

                        if (hub_can_edit) {

                            $('#hub_addSchedulerBtn').show();

                        } else {

                            $('#hub_addSchedulerBtn').hide();

                        }

                    }

                    // Load scheduler after flag is set

                    if (!hub_schedulerTable) {

                        hub_loadSchedulerTable(quotation_id);

                    } else {

                        hub_schedulerTable.ajax.reload();

                    }

                },

                error: function() {

                    if (hub_can_edit) {

                        $('#hub_addSchedulerBtn').show();

                    } else {

                        $('#hub_addSchedulerBtn').hide();

                    }

                    // Load scheduler after flag is set

                    if (!hub_schedulerTable) {

                        hub_loadSchedulerTable(quotation_id);

                    } else {

                        hub_schedulerTable.ajax.reload();

                    }

                }

            });





        },



        error: function() {



            // On error, still block access

            $('#receiptSchedulerTab').html(`

                <div class="pt-4">

                    <div class="alert alert-danger" role="alert">

                        <i class="fas fa-times-circle me-2"></i> Failed to verify client confirmation status. Please try again.

                    </div>

                </div>

            `);



        }



    });



});







function hub_loadSchedulerTable(quotation_id) {



    // Destroy existing table if it exists

    if ($.fn.DataTable.isDataTable('#hub_scheduler_table')) {

        $('#hub_scheduler_table').DataTable().destroy();

    }



    hub_schedulerTable = $('#hub_scheduler_table').DataTable({



        "processing": true,



        "serverSide": true,



        "destroy": true,



        "order": [],



        "ajax": {



            "url": "<?php echo base_url(); ?>index.php/Receipt_scheduler/get_table",



            "type": "POST",



            "data": function(d) {



                d.quotation_id_filter = quotation_id;



            },



            "error": function(xhr, error, thrown) {

                console.error('Receipt Scheduler DataTable error:', error);

                console.error('Response:', xhr.responseText);

            }



        },



        "searching": false,



        "columnDefs": [{ "targets": [0, -1], "orderable": false }],



        "columns": [



            { data: null, render: function(data, type, row, meta) { return meta.row + meta.settings._iDisplayStart + 1; } },



            { data: "quotation_number" },



            { data: "guest_name" },



            { data: "payment_type", render: function(data) {



                return data == 'FULL' ? '<span class="badge bg-primary">Full Payment</span>' : '<span class="badge bg-info">EMI</span>';



            }},



            { data: "total_amount", render: function(data) {



                return '₹' + parseFloat(data).toLocaleString('en-IN', { minimumFractionDigits: 2 });



            }},



            { data: "max_emi_count", render: function(data, type, row) { return row.payment_type == 'EMI' ? data : '-'; }},



            { data: "created_date_formatted" },



            { data: null, render: function(data, type, row) {



                var html = '<div class="d-flex">';



                if (hub_can_view) {

                    html += '<button type="button" class="btn btn-info btn-sm me-1" onclick="hub_viewScheduler(' + row.receipt_scheduler_id + ')" title="View"><i class="fas fa-eye"></i></button>';

                }



                if (hub_can_edit && (!row.has_payments || row.has_payments == 0)) {

                    html += '<button type="button" class="btn btn-warning btn-sm me-1" onclick="hub_editScheduler(' + row.receipt_scheduler_id + ')" title="Edit"><i class="fas fa-edit"></i></button>';

                }



                if (hub_can_delete && (!row.has_payments || row.has_payments == 0) && !hub_scheduler_exists) {

                    html += '<button type="button" class="btn btn-danger btn-sm" onclick="hub_deleteScheduler(' + row.receipt_scheduler_id + ')" title="Delete"><i class="fas fa-trash"></i></button>';

                }



                html += '</div>';



                return html;



            }}



        ]



    });



}



///////****** property reservation + status ***//////////



$(document).ready(function () {

    var quotation_id = $('#quotation_id').val();

    if (quotation_id && quotation_id != 0) {

        $('#openPropertyReservationBtn').attr(

            'href',

            "<?php echo base_url('index.php/property_reservation/index/'); ?>" + quotation_id

        );

    }

});



$('#tabPropertyReservation').on('shown.bs.tab', function () {

    loadPropertyStatus($('#quotation_id').val());

});



/* =========================================================
   PROPERTY CHANGE: reservations retained after a property swap
   ========================================================= */

var hubSupersededRows = [];

function hubMoney(v) {

    return parseFloat(v || 0).toFixed(2);

}

function hubNotify(style, message) {

    var n = new notify({

        title   : '',

        style   : style,

        message : message,

        icon    : style === 'success' ? 'fas fa-check' : 'fas fa-times'

    });

    n.show(); setTimeout(function () { n.hide(); }, 4000);

}

/**
 * Properties the client replaced on the confirmation page.
 *
 * These are loaded separately from the status table above, which is driven by
 * the active confirmation and therefore no longer includes them. The status
 * counts and the reconfirmed-equals-total completion gate are deliberately
 * left untouched, so a retained property can never block Reservation Complete.
 */

function loadHubSupersededReservations(quotation_id)

{

    hubSupersededRows = [];

    $('#hubSupersededTable tbody').empty();

    $('#hubSupersededPanel').hide();

    if (!quotation_id) return;

    $.ajax({

        url: "<?php echo base_url(); ?>index.php/property_reservation/ajax_get_superseded_reservations",

        type: "POST",

        dataType: "json",

        data: { quotation_id: quotation_id },

        success: function (res) {

            if (!res.status || !res.rows || res.rows.length === 0) return;

            hubSupersededRows = res.rows;

            var html = '';

            res.rows.forEach(function (r, idx) {

                var cancelled = (r.reservation_state === 'CANCELLED');

                var credit    = r.property_credit;

                var statusCell = cancelled

                    ? '<span class="badge bg-danger">CANCELLED</span>'

                    : '<span class="badge bg-warning text-dark">REPLACED</span>';

                var actionCell;

                if (cancelled) {

                    actionCell = credit

                        ? '<span class="badge bg-success">Credit ' + hubMoney(credit.credit_amount) + '</span>'

                        : '<span class="text-muted small">No credit</span>';

                } else if (!r.is_cancellable) {

                    // Nothing was paid to this property, so there is nothing to
                    // recover — the row is kept purely as change history.

                    actionCell = '<span class="text-muted small"><i class="fas fa-history me-1"></i>History only</span>';

                } else if (res.can_cancel) {

                    actionCell = '<button type="button" class="btn btn-sm btn-outline-danger" onclick="hubOpenCancelReservationModal(' + idx + ')">'

                               + '<i class="fas fa-ban me-1"></i> Cancel Reservation</button>';

                } else {

                    actionCell = '<span class="text-muted small">-</span>';

                }

                html += '<tr>'

                     +  '<td>' + (r.properties_name || '-') + '</td>'

                     +  '<td>' + (r.superseded_by_property_name || '<span class="text-muted">-</span>') + '</td>'

                     +  '<td>' + (r.check_in_date || '-') + '</td>'

                     +  '<td class="text-end">' + hubMoney(r.snap_reservation_amount) + '</td>'

                     +  '<td class="text-end">' + hubMoney(r.snap_paid_amount) + '</td>'

                     +  '<td>' + statusCell + '</td>'

                     +  '<td class="text-center">' + actionCell + '</td>'

                     +  '</tr>';

            });

            $('#hubSupersededTable tbody').html(html);

            $('#hubSupersededPanel').show();

        }

    });

}

function hubOpenCancelReservationModal(idx)

{

    var r = hubSupersededRows[idx];

    if (!r) return;

    $('#hub_cancel_res_id').val(r.property_reservation_id);

    $('#hubCancelResPropertyName').text(r.properties_name || 'this property');

    $('#hubCancelResReserved').text(hubMoney(r.snap_reservation_amount));

    $('#hubCancelResPaid').text(hubMoney(r.snap_paid_amount));

    // Default to the full amount the property is holding; staff can reduce it.

    $('#hub_cancel_res_amount').val(hubMoney(r.snap_paid_amount)).attr('max', hubMoney(r.snap_paid_amount));

    $('#hub_cancel_res_reference').val('');

    $('#hub_cancel_res_reason').val('');

    $('#hub_cancel_res_expiry').val('');

    var today = new Date();

    var dd = ('0' + today.getDate()).slice(-2);

    var mm = ('0' + (today.getMonth() + 1)).slice(-2);

    $('#hub_cancel_res_date').val(dd + '/' + mm + '/' + today.getFullYear());

    $('#hub_cancel_res_date, #hub_cancel_res_expiry').each(function () {

        if (!$(this).data('datepicker')) {

            $(this).datepicker({ format: 'dd/mm/yyyy', autoclose: true, todayHighlight: true });

        }

    });

    $('#hubCancelResSubmitBtn').prop('disabled', false);

    $('#hubCancelReservationModal').modal('show');

}

function hubSubmitCancelReservation()

{

    var reservation_id = $('#hub_cancel_res_id').val();

    var amount         = parseFloat($('#hub_cancel_res_amount').val() || 0);

    var date           = $('#hub_cancel_res_date').val();

    var paid           = parseFloat($('#hubCancelResPaid').text() || 0);

    if (!reservation_id) return;

    if (isNaN(amount) || amount < 0) {

        hubNotify('error', 'Enter a valid cancellation amount.');

        return;

    }

    if (amount > paid + 0.009) {

        hubNotify('error', 'Cancellation amount cannot exceed the amount paid (' + hubMoney(paid) + ').');

        return;

    }

    if (!date) {

        hubNotify('error', 'Cancellation date is required.');

        return;

    }

    if (!confirm('Cancel this reservation and record a credit of ' + hubMoney(amount) + '?')) return;

    // Guard against a double submit creating a second credit.

    $('#hubCancelResSubmitBtn').prop('disabled', true);

    $.ajax({

        url: "<?php echo base_url(); ?>index.php/property_reservation/ajax_cancel_reservation",

        type: "POST",

        dataType: "json",

        data: {

            property_reservation_id: reservation_id,

            cancellation_amount    : amount,

            cancellation_date      : date,

            cancellation_reason    : $('#hub_cancel_res_reason').val(),

            reference_number       : $('#hub_cancel_res_reference').val(),

            credit_expiry_date     : $('#hub_cancel_res_expiry').val()

        },

        success: function (res) {

            if (!res.status) {

                hubNotify('error', res.message || 'Could not cancel the reservation');

                $('#hubCancelResSubmitBtn').prop('disabled', false);

                return;

            }

            hubNotify('success', res.message);

            $('#hubCancelReservationModal').modal('hide');

            loadPropertyStatus($('#quotation_id').val());

        },

        error: function () {

            hubNotify('error', 'An error occurred. Please try again.');

            $('#hubCancelResSubmitBtn').prop('disabled', false);

        }

    });

}

function loadPropertyStatus(quotation_id)

{

    loadHubSupersededReservations(quotation_id);

    $('#propertyStatusTable').html(`

        <div class="text-center py-4">

            <div class="spinner-border text-primary"></div>

            <p class="mt-2 mb-0">Loading property status...</p>

        </div>

    `);



    $.ajax({

        url: "<?php echo base_url(); ?>index.php/property_reservation/ajax_property_status",

        type: "POST",

        dataType: "json",

        data: { quotation_id: quotation_id },

        success: function(res) {

            if (!res.status || !res.data) {

                $('#propertyStatusTable').html('<div class="alert alert-warning mb-0">No property reservations found.</div>');

                $('#propertyStatusCounts').html('');

                return;

            }



            var d = res.data;



            $('#propertyStatusCounts').html(

                '<span class="badge bg-secondary me-2">Blocked ' + d.blocked + '/' + d.total + '</span>' +

                '<span class="badge bg-info me-2">Confirmed ' + d.confirmed + '/' + d.total + '</span>' +

                '<span class="badge bg-success">Re-Confirmed ' + d.reconfirmed + '/' + d.total + '</span>'

            );



            if (!d.rows || d.rows.length === 0) {

                $('#propertyStatusTable').html('<div class="alert alert-info mb-0">No property reservations yet for this booking.</div>');

                return;

            }



            var html = `

                <div class="table-responsive">

                    <table class="table mb-0" style="border-collapse:collapse;width:100%;">

                        <thead>

                            <tr style="background:#f8f9fa;border-bottom:2px solid #e9ecef;">

                                <th style="padding:13px 18px;font-size:12px;font-weight:700;color:#6c757d;text-transform:uppercase;letter-spacing:0.5px;border:none;width:40px;">#</th>

                                <th style="padding:13px 18px;font-size:12px;font-weight:700;color:#6c757d;text-transform:uppercase;letter-spacing:0.5px;border:none;">Property</th>

                                <th style="padding:13px 18px;font-size:12px;font-weight:700;color:#6c757d;text-transform:uppercase;letter-spacing:0.5px;border:none;text-align:right;">Amount</th>

                                <th style="padding:13px 18px;font-size:12px;font-weight:700;color:#6c757d;text-transform:uppercase;letter-spacing:0.5px;border:none;">Reservation Status</th>

                                <th style="padding:13px 18px;font-size:12px;font-weight:700;color:#6c757d;text-transform:uppercase;letter-spacing:0.5px;border:none;text-align:right;">Action</th>

                            </tr>

                        </thead>

                        <tbody>

            `;



            $.each(d.rows, function(i, row) {

                var pid    = row.properties_id || '';

                var pname  = escapeHtml(row.properties_name || '');

                var cin    = row.check_in_date  || '';

                var cout   = row.check_out_date || '';

                var nights = row.duration_nights || 1;

                var updateBtn = '<button type="button" class="btn btn-sm btn-outline-warning hubResUpdateBtn" '

                    + 'data-properties-id="' + pid + '" '

                    + 'data-properties-name="' + pname + '" '

                    + 'data-check-in="' + cin + '" '

                    + 'data-check-out="' + cout + '" '

                    + 'data-nights="' + nights + '" '

                    + 'style="border-radius:6px;font-size:12px;font-weight:600;padding:5px 12px;">'

                    + '<i class="la la-edit me-1"></i>Update</button>';

                var actionBtns = '<div style="display:flex;justify-content:flex-end;gap:6px;">' + updateBtn + '</div>';



                html += '<tr style="border-bottom:1px solid #f1f3f5;transition:background 0.15s;" onmouseover="this.style.background=\'#f8f9fa\'" onmouseout="this.style.background=\'#fff\'">';

                html += '<td style="padding:14px 18px;color:#adb5bd;font-size:13px;vertical-align:middle;">' + (i + 1) + '</td>';

                html += '<td style="padding:14px 18px;vertical-align:middle;">'

                      +   '<div style="font-weight:600;font-size:14px;color:#212529;">' + escapeHtml(row.properties_name || '-') + '</div>'

                      + '</td>';

                html += '<td style="padding:14px 18px;vertical-align:middle;text-align:right;font-weight:600;color:#212529;font-size:13px;">' + (row.property_total > 0 ? '\u20b9' + parseFloat(row.property_total).toLocaleString('en-IN', {minimumFractionDigits:2}) : '<span style="color:#adb5bd;">-</span>') + '</td>';

                html += '<td style="padding:14px 18px;vertical-align:middle;">' + buildPropertyStatusBadges(row) + '</td>';

                html += '<td style="padding:14px 18px;vertical-align:middle;">' + actionBtns + '</td>';

                html += '</tr>';

            });



            html += '</tbody></table></div>';

            $('#propertyStatusTable').html(html);

        },

        error: function() {

            $('#propertyStatusTable').html('<div class="alert alert-danger mb-0">Failed to load property status.</div>');

        }

    });

}



function buildPropertyStatusBadges(row)

{

    if (!row.property_reservation_id) {

        return '<span style="display:inline-block;padding:4px 10px;border-radius:20px;font-size:11px;font-weight:600;background:#f3f4f6;color:#9ca3af;">No Reservation Yet</span>';

    }

    var out = '<div style="display:flex;flex-wrap:wrap;gap:4px;">';

    out += (row.blocking_status === 'BLOCKED')

        ? '<span style="padding:4px 10px;border-radius:20px;font-size:11px;font-weight:600;background:#d1fae5;color:#065f46;">Blocked</span>'

        : '<span style="padding:4px 10px;border-radius:20px;font-size:11px;font-weight:600;background:#fef3c7;color:#92400e;">Blocking Pending</span>';

    out += (row.confirmation_status === 'CONFIRMED')

        ? '<span style="padding:4px 10px;border-radius:20px;font-size:11px;font-weight:600;background:#dbeafe;color:#1e40af;">Confirmed</span>'

        : '<span style="padding:4px 10px;border-radius:20px;font-size:11px;font-weight:600;background:#fef3c7;color:#92400e;">Confirm Pending</span>';

    out += (row.reconfirmation_status === 'RECONFIRMED')

        ? '<span style="padding:4px 10px;border-radius:20px;font-size:11px;font-weight:600;background:#ede9fe;color:#5b21b6;">Re-Confirmed</span>'

        : '<span style="padding:4px 10px;border-radius:20px;font-size:11px;font-weight:600;background:#fef3c7;color:#92400e;">Re-Confirm Pending</span>';

    out += '</div>';

    return out;

}



// function buildConfirmationDetailsTable(days)

// {

//     var html = `

//         <div class="table-responsive">

//             <table class="table table-bordered align-middle">

//                 <thead class="table-light">

//                     <tr>

//                         <th style="width:5%">Select</th>

//                         <th>Day</th>

//                         <th>Destination</th>

//                         <th>Property</th>

//                         <th>Room</th>

//                     </tr>

//                 </thead>

//                 <tbody>

//     `;





function hub_add_scheduler() {



    var quotation_id = $('#quotation_id').val();



    hub_save_method = 'add';



    $('#hub_schedulerForm')[0].reset();



    $('#hub_total_amount_display').text('₹0.00');



    hub_setCutoffDate('');



    $('#hub_receipt_scheduler_id').val('');



    $('#hub_quotation_id_fk').val(quotation_id);



    $('#hub_fullPaymentSection').hide();



    $('#hub_emiSection').hide();



    $('#hub_emiTableBody').html('');



    $('#hub_schedulerModalTitle').text('Create Payment Schedule');







    // Auto-fetch quotation amount and display



    $.ajax({



        url: "<?php echo base_url(); ?>index.php/Receipt_scheduler/get_quotation_amount",



        type: 'POST',



        data: { quotation_id: quotation_id },



        dataType: 'json',



        success: function(response) {



            $('#hub_total_amount').val(response.total_amount);



            var hubAmt = parseFloat(response.total_amount) || 0;

            $('#hub_total_amount_display').text('₹' + hubAmt.toLocaleString('en-IN', { minimumFractionDigits: 2 }));



            $('#hub_quotation_display').val($('#hubQuotationNumber').text() + ' - ' + $('#hubGuestName').text());



            window.__hubSchedulerTravelStartDate = response.travel_start_date || '';



            hub_setCutoffDate(window.__hubSchedulerTravelStartDate);



            if ($('#hub_payment_type').val() == 'EMI') {



                hub_generateEmiRows();



            }



        }



    });







    $('#hub_schedulerModal').modal('show');



}







function hub_togglePaymentType() {



    var type = $('#hub_payment_type').val();



    if (type == 'FULL') {



        $('#hub_fullPaymentSection').show();



        $('#hub_emiSection').hide();



        var amt = parseFloat($('#hub_total_amount').val()) || 0;



        $('#hub_sched_full_total_display').text('₹' + amt.toLocaleString('en-IN', { minimumFractionDigits: 2 }));



    } else if (type == 'EMI') {



        $('#hub_fullPaymentSection').hide();



        $('#hub_emiSection').show();



        var amt = parseFloat($('#hub_total_amount').val()) || 0;

        $('#hub_sched_emi_total_display').text('₹' + amt.toLocaleString('en-IN', { minimumFractionDigits: 2 }));



        hub_generateEmiRows();



    } else {



        $('#hub_fullPaymentSection').hide();



        $('#hub_emiSection').hide();



    }



}







function hub_toggleSplitType() {



    var splitType = $('#hub_split_type').val();



    $('#hub_emiAmountHeader').text(splitType == 'PERCENTAGE' ? 'Percentage (%)' : 'Amount');



    hub_generateEmiRows();



}







function hub_addDays(ymd, days) {

    var dt = new Date(ymd);

    dt.setDate(dt.getDate() + days);

    var mm = String(dt.getMonth() + 1).padStart(2, '0');

    var dd = String(dt.getDate()).padStart(2, '0');

    return dt.getFullYear() + '-' + mm + '-' + dd;

}



function hub_generateEmiRows() {



    var count = Math.min(24, Math.max(2, parseInt($('#hub_max_emi_count').val()) || 2));

    $('#hub_max_emi_count').val(count);



    var totalAmount = parseFloat($('#hub_total_amount').val()) || 0;



    var splitType = $('#hub_split_type').val();



    var html = '';



    for (var i = 1; i <= count; i++) {



        var defaultValue = splitType == 'PERCENTAGE'

            ? (i === 1 ? 30 : 70 / (count - 1)).toFixed(2)

            : (totalAmount / count).toFixed(2);



        html += '<tr><td class="text-center"><strong>EMI ' + i + '</strong></td><td>';



        if (splitType == 'PERCENTAGE') {



            html += '<input type="number" step="0.01" class="form-control form-control-sm hub-emi-percentage" name="emi_percentage[]" value="' + defaultValue + '">';



        } else {



            html += '<input type="number" step="0.01" class="form-control form-control-sm hub-emi-amount" name="emi_amount[]" value="' + defaultValue + '">';



        }



        html += '</td><td>';



        html += '<input type="text" class="form-control form-control-sm hub-emi-due-date" placeholder="dd/mm/yyyy" required>';



        html += '<input type="hidden" name="emi_due_date[]" class="hub-emi-due-date-hidden">';



        html += '</td>';



        html += '<td class="hub-calculated-amount text-end">₹' + (splitType == 'PERCENTAGE' ? ((totalAmount * parseFloat(defaultValue)) / 100).toFixed(2) : defaultValue) + '</td></tr>';



    }



    $('#hub_emiTableBody').html(html);



    var baseDate = window.__hubSchedulerTravelStartDate || null;



    var today = new Date();



    var todayYMD = today.getFullYear() + '-' + String(today.getMonth() + 1).padStart(2, '0') + '-' + String(today.getDate()).padStart(2, '0');



    $('#hub_emiTableBody .hub-emi-due-date').each(function(idx) {



        var ymd = idx === 0 ? todayYMD : (baseDate || todayYMD);



        $(this).val(hub_formatDateDMY(ymd));



        $(this).closest('tr').find('.hub-emi-due-date-hidden').val(ymd);



    });



    hub_initEmiDatepickers();



    hub_calculateEmiTotal();



}







function hub_calculateEmiTotal() {



    var totalAmount = parseFloat($('#hub_total_amount').val()) || 0;



    var splitType = $('#hub_split_type').val();



    var total = 0;



    if (splitType == 'PERCENTAGE') {



        var percentTotal = 0;



        $('#hub_emiTableBody .hub-emi-percentage').each(function() {



            var percent = parseFloat($(this).val()) || 0;



            percentTotal += percent;



            var calculated = (totalAmount * percent) / 100;



            total += calculated;



            $(this).closest('tr').find('.hub-calculated-amount').text('₹' + calculated.toFixed(2));



        });



        $('#hub_emiTotalCol').text(percentTotal.toFixed(2) + '%');



    } else {



        $('#hub_emiTableBody .hub-emi-amount').each(function() {



            var amt = parseFloat($(this).val()) || 0;



            total += amt;



            $(this).closest('tr').find('.hub-calculated-amount').text('₹' + amt.toFixed(2));



        });



        $('#hub_emiTotalCol').text('₹' + total.toFixed(2));



    }



    $('#hub_emiCalculatedTotal').text('₹' + total.toFixed(2));



    if (Math.abs(total - totalAmount) > 0.01) {



        $('#hub_emiCalculatedTotal').addClass('text-danger');



    } else {



        $('#hub_emiCalculatedTotal').removeClass('text-danger');



    }



}



function hub_redistributeEmiAmounts($changedInput) {

    var splitType = $('#hub_split_type').val();
    var total, $inputs;

    if (splitType == 'PERCENTAGE') {
        total = 100;
        $inputs = $('#hub_emiTableBody .hub-emi-percentage');
    } else {
        total = parseFloat($('#hub_total_amount').val()) || 0;
        $inputs = $('#hub_emiTableBody .hub-emi-amount');
    }

    var changedIndex = $inputs.index($changedInput);
    var changedVal = parseFloat($changedInput.val()) || 0;

    var sumBefore = 0;
    for (var i = 0; i < changedIndex; i++) {
        sumBefore += parseFloat($($inputs[i]).val()) || 0;
    }

    var sumAfter = total - sumBefore - changedVal;
    var $afterInputs = $inputs.slice(changedIndex + 1);

    if ($afterInputs.length > 0) {
        $afterInputs.val((sumAfter / $afterInputs.length).toFixed(2));
    }

    hub_calculateEmiTotal();

}







function hub_save() {



    var formData = $('#hub_schedulerForm').serialize();



    var url = hub_save_method == 'add'



        ? "<?php echo base_url(); ?>index.php/Receipt_scheduler/add"



        : "<?php echo base_url(); ?>index.php/Receipt_scheduler/edit";



    $.ajax({



        url: url, type: 'POST', data: formData, dataType: 'json',



        beforeSend: function() { $('#hub_btnSave').prop('disabled', true).text('Saving...'); },



        success: function(response) {



            $('#hub_btnSave').prop('disabled', false).text('Save');



            if (response.error) {



                var n = new notify({ title: '', style: 'error', message: response.message, icon: 'fas fa-times' });

                n.show(); setTimeout(function(){ n.hide(); }, 3000);



            } else {



                $('#hub_schedulerModal').modal('hide');



                if (hub_save_method == 'add') {

                    hub_scheduler_exists = true;

                    $('#hub_addSchedulerBtn').hide();

                }

                hub_schedulerTable.ajax.reload();



                var n = new notify({ title: '', style: 'success', message: response.message, icon: 'fas fa-check' });

                n.show(); setTimeout(function(){ n.hide(); }, 3000);



            }



        },



        error: function() {



            $('#hub_btnSave').prop('disabled', false).text('Save');



            var n = new notify({ title: '', style: 'error', message: 'An error occurred. Please try again.', icon: 'fas fa-times' });

            n.show(); setTimeout(function(){ n.hide(); }, 3000);



        }



    });



}







function hub_editScheduler(id) {



    hub_save_method = 'edit';



    $.ajax({



        url: "<?php echo base_url(); ?>index.php/Receipt_scheduler/get_by_id",



        type: 'POST', data: { receipt_scheduler_id: id }, dataType: 'json',



        success: function(response) {



            var scheduler = response.scheduler;



            var installments = response.installments;



            var hasPayments = response.has_payments || false;



            $('#hub_receipt_scheduler_id').val(scheduler.receipt_scheduler_id);



            $('#hub_quotation_id_fk').val(scheduler.quotation_id_fk);



            $('#hub_quotation_display').val(scheduler.quotation_number + ' - ' + scheduler.guest_name);



            $('#hub_total_amount').val(scheduler.total_amount);



            var hubEditAmt = parseFloat(scheduler.total_amount) || 0;

            $('#hub_total_amount_display').text('₹' + hubEditAmt.toLocaleString('en-IN', { minimumFractionDigits: 2 }));



            if (!hasPayments) {

                $.ajax({

                    url: "<?php echo base_url(); ?>index.php/Receipt_scheduler/get_quotation_amount",

                    type: 'POST', data: { quotation_id: scheduler.quotation_id_fk }, dataType: 'json',

                    success: function(latest) {

                        var latestAmt = parseFloat(latest.total_amount) || 0;

                        if (latestAmt > 0 && Math.abs(latestAmt - hubEditAmt) >= 0.01) {

                            $('#hub_total_amount').val(latest.total_amount);

                            $('#hub_total_amount_display').text('₹' + latestAmt.toLocaleString('en-IN', { minimumFractionDigits: 2 }));

                        }

                    }

                });

            }



            $('#hub_payment_type').val(scheduler.payment_type);



            $('#hub_receipt_scheduler_remarks').val(scheduler.receipt_scheduler_remarks);



            if (hasPayments) {

                $('#hub_total_amount').prop('readonly', true);

                $('#hub_payment_type').prop('disabled', true);

                $('#hub_max_emi_count').prop('readonly', true);

                $('#hub_split_type').prop('disabled', true);

                $('button[onclick="hub_generateEmiRows()"]').prop('disabled', true);

            } else {

                $('#hub_total_amount').prop('readonly', false);

                $('#hub_payment_type').prop('disabled', false);

                $('#hub_max_emi_count').prop('readonly', false);

                $('#hub_split_type').prop('disabled', false);

                $('button[onclick="hub_generateEmiRows()"]').prop('disabled', false);

            }



            hub_togglePaymentType();



            if (scheduler.payment_type == 'FULL') {



                if (installments.length > 0) hub_setCutoffDate(installments[0].due_date);



            } else {



                $('#hub_max_emi_count').val(scheduler.max_emi_count);



                $('#hub_split_type').val(scheduler.split_type);



                hub_toggleSplitType();



                var html = '';



                for (var i = 0; i < installments.length; i++) {



                    var inst = installments[i];



                    html += '<tr><td class="text-center"><strong>EMI ' + inst.installment_number + '</strong></td><td>';



                    if (scheduler.split_type == 'PERCENTAGE') {



                        html += '<input type="number" step="0.01" class="form-control form-control-sm hub-emi-percentage" name="emi_percentage[]" value="' + (inst.installment_percentage || '') + '"' + (hasPayments ? ' readonly' : '') + '>';



                    } else {



                        html += '<input type="number" step="0.01" class="form-control form-control-sm hub-emi-amount" name="emi_amount[]" value="' + (inst.installment_amount || '') + '"' + (hasPayments ? ' readonly' : '') + '>';



                    }



                    html += '</td><td>';



                    html += '<input type="text" class="form-control form-control-sm hub-emi-due-date" placeholder="dd/mm/yyyy" value="' + hub_formatDateDMY(inst.due_date) + '" required' + (hasPayments ? ' readonly' : '') + '>';



                    html += '<input type="hidden" name="emi_due_date[]" class="hub-emi-due-date-hidden" value="' + (inst.due_date || '') + '">';



                    html += '</td>';



                    html += '<td class="hub-calculated-amount text-end">₹' + parseFloat(inst.calculated_amount).toFixed(2) + '</td></tr>';



                }



                $('#hub_emiTableBody').html(html);



                hub_initEmiDatepickers();



                hub_calculateEmiTotal();



            }



            if (hasPayments) {

                $('#hub_schedulerModalTitle').text('Edit Payment Schedule (Locked — Payments Collected)');

            } else {

                $('#hub_schedulerModalTitle').text('Edit Payment Schedule');

            }



            $('#hub_schedulerModal').modal('show');



        }



    });



}







function hub_viewScheduler(id) {



    hub_currentSchedulerId = id;



    $.ajax({



        url: "<?php echo base_url(); ?>index.php/Receipt_scheduler/get_payment_summary",



        type: 'POST', data: { receipt_scheduler_id: id }, dataType: 'json',



        success: function(response) {



            if (!response || !response.scheduler) {

                var n = new notify({ title: '', style: 'error', message: 'Unable to load payment details', icon: 'fas fa-times' });

                n.show(); setTimeout(function(){ n.hide(); }, 3000);

                return;

            }



            var scheduler = response.scheduler;



            $('#hub_view_quotation_number').text(scheduler.quotation_number);



            $('#hub_view_guest_name').text(scheduler.guest_name);



            $('#hub_view_phone').text(scheduler.whats_number || '-');



            $('#hub_view_payment_type').html(scheduler.payment_type == 'FULL' ? '<span class="badge bg-primary">Full Payment</span>' : '<span class="badge bg-info">EMI</span>');



            $('#hub_view_total_amount').text('₹' + parseFloat(response.total_amount).toLocaleString('en-IN', { minimumFractionDigits: 2 }));



            $('#hub_view_total_card').text('₹' + parseFloat(response.total_amount).toLocaleString('en-IN', { minimumFractionDigits: 2 }));



            $('#hub_view_paid_amount').text('₹' + parseFloat(response.total_paid).toLocaleString('en-IN', { minimumFractionDigits: 2 }));



            $('#hub_view_pending_amount').text('₹' + parseFloat(response.pending_amount).toLocaleString('en-IN', { minimumFractionDigits: 2 }));



            $('#hub_view_overdue_count').text(response.overdue_count);



            var html = '';



            var installments = response.installments;



            for (var i = 0; i < installments.length; i++) {



                var inst = installments[i];



                html += '<tr><td>' + inst.installment_number + '</td><td>' + hub_formatDate(inst.due_date) + '</td>';



                html += '<td>₹' + parseFloat(inst.calculated_amount).toLocaleString('en-IN', { minimumFractionDigits: 2 }) + '</td>';



                html += '<td>₹' + parseFloat(inst.paid_amount).toLocaleString('en-IN', { minimumFractionDigits: 2 }) + '</td>';



                var statusClass = '';

                if (inst.payment_status == 'PAID') statusClass = 'bg-success';

                else if (inst.payment_status == 'PARTIAL') statusClass = 'bg-warning';

                else if (inst.payment_status == 'OVERDUE') statusClass = 'bg-danger';

                else if (inst.payment_status == 'PENDING') statusClass = 'bg-danger';

                else statusClass = 'bg-secondary';



                html += '<td><span class="badge ' + statusClass + '">' + inst.payment_status + '</span></td>';



                html += '<td>';



                if (inst.payment_status != 'PAID') {



                    var remaining = parseFloat(inst.calculated_amount) - parseFloat(inst.paid_amount);



                    var hubCanPay = (inst.installment_number == 1 && hub_can_pay_initial) || (inst.installment_number > 1 && hub_can_pay_other);



                    if (hubCanPay) {



                        html += '<button class="btn btn-success btn-xs me-1" onclick="hub_recordPayment(' + inst.installment_id + ', ' + remaining.toFixed(2) + ')"><i class="fas fa-money-bill"></i> Pay</button>';



                    }



                }



                if (inst.payment_status == 'PAID' || inst.payment_status == 'PARTIAL') {



                    html += '<button class="btn btn-info btn-xs me-1" onclick="hub_viewReceipts(' + inst.installment_id + ')" title="Payment History"><i class="fas fa-history"></i> History</button>';



                }



                html += '</td></tr>';



            }



            $('#hub_viewInstallmentsBody').html(html);



            $('#hub_viewModal').modal('show');



        }



    });



}







function hubPaymentTodayDMY() {

    var today = new Date();

    return String(today.getDate()).padStart(2, '0') + '/' + String(today.getMonth() + 1).padStart(2, '0') + '/' + today.getFullYear();

}



function hub_recordPayment(installmentId, dueAmount) {



    $('#hub_payment_installment_id').val(installmentId);



    $('#hub_payment_due_amount').val('₹' + dueAmount.toFixed(2));



    $('#hub_payment_amount').val(dueAmount.toFixed(2));



    $('#hub_payment_date').val(hubPaymentTodayDMY());

    if (!$('#hub_payment_date').data('datepicker')) {

        $('#hub_payment_date').datepicker({ format: 'dd/mm/yyyy', autoclose: true, todayHighlight: true });

    }



    $('#hub_payment_method').val('');



    $('#hub_payment_reference').val('');



    $('#hub_payment_remarks').val('');

    $('#hub_payment_slip').val('');

    if (window.resetMultiFiles_hub_payment_slip) { window.resetMultiFiles_hub_payment_slip(); }
    if (!window._hub_payment_slip_picker_init) {
        initMultiFilePicker('hub_payment_slip', 'hub_payment_slip_list');
        window._hub_payment_slip_picker_init = true;
    }

    $('#hub_paymentModal').modal('show');



}







function hub_savePayment() {



    var $amount = $('#hub_payment_amount');

    var $date = $('#hub_payment_date');



    var amountVal = $.trim($amount.val());

    if (amountVal == '' || isNaN(amountVal) || parseFloat(amountVal) <= 0) {

        $amount.addClass('is-invalid');

        var n = new notify({ title: '', style: 'error', message: 'Please enter a valid payment amount greater than 0.', icon: 'fas fa-times' });

        n.show(); setTimeout(function(){ n.hide(); }, 3000);

        $amount.focus();

        return;

    } else {

        $amount.removeClass('is-invalid');

    }



    var dateValid = /^\d{2}\/\d{2}\/\d{4}$/.test($date.val());

    $date.toggleClass('is-invalid', !dateValid);

    var pickedFiles = window.getMultiFiles_hub_payment_slip ? window.getMultiFiles_hub_payment_slip() : [];

    if (!dateValid || pickedFiles.length === 0) {

        var msg = !dateValid ? 'Please enter a valid payment date in dd/mm/yyyy format.' : 'Please upload a payment slip.';

        var n = new notify({ title: '', style: 'error', message: msg, icon: 'fas fa-times' });

        n.show(); setTimeout(function(){ n.hide(); }, 3000);

        return;

    }



    var formData = new FormData($('#hub_paymentForm')[0]);
    for (var i = 0; i < pickedFiles.length; i++) {
        formData.append('payment_slip[]', pickedFiles[i]);
    }



    $.ajax({



        url: "<?php echo base_url(); ?>index.php/Receipt_scheduler/record_payment",



        type: 'POST', data: formData, processData: false, contentType: false, dataType: 'json',



        success: function(response) {



            if (response.error) {



                var n = new notify({ title: '', style: 'error', message: response.message || 'Failed to record payment.', icon: 'fas fa-times' });

                n.show(); setTimeout(function(){ n.hide(); }, 3000);



            } else {



                $('#hub_paymentModal').modal('hide');



                hub_viewScheduler(hub_currentSchedulerId);



                hub_schedulerTable.ajax.reload();



                loadQuotationHubSummary($('#quotation_id').val());



                var n = new notify({ title: '', style: 'success', message: response.message || 'Payment recorded successfully.', icon: 'fas fa-check' });

                n.show(); setTimeout(function(){ n.hide(); }, 3000);



            }



        },

        error: function() {

            var n = new notify({ title: '', style: 'error', message: 'Failed to record payment.', icon: 'fas fa-times' });

            n.show(); setTimeout(function(){ n.hide(); }, 3000);

        }



    });



}







function hub_approvePayment(paymentId) {



    if (!confirm('Approve this payment by accountant?')) {

        return;

    }



    $.ajax({



        url: "<?php echo base_url(); ?>index.php/Receipt_scheduler/approve_payment",



        type: 'POST', data: { payment_id: paymentId }, dataType: 'json',



        success: function(response) {



            if (response.error) {



                var n = new notify({ title: '', style: 'error', message: response.message, icon: 'fas fa-times' });

                n.show(); setTimeout(function(){ n.hide(); }, 3000);



            } else {



                hub_viewScheduler(hub_currentSchedulerId);



                hub_schedulerTable.ajax.reload();



                loadQuotationHubSummary($('#quotation_id').val());



                var n = new notify({ title: '', style: 'success', message: response.message, icon: 'fas fa-check' });

                n.show(); setTimeout(function(){ n.hide(); }, 3000);



            }



        },



        error: function() {

            var n = new notify({ title: '', style: 'error', message: 'Failed to approve payment.', icon: 'fas fa-times' });

            n.show(); setTimeout(function(){ n.hide(); }, 3000);

        }



    });



}







function hub_viewReceipts(installmentId) {



    $.ajax({



        url: "<?php echo base_url(); ?>index.php/Receipt_scheduler/get_installment_payments",



        type: 'POST',



        data: { installment_id: installmentId },



        dataType: 'json',



        success: function(payments) {



            var html = '';



            if (payments && payments.length > 0) {



                for (var i = 0; i < payments.length; i++) {



                    var p = payments[i];



                    html += '<tr>';



                    html += '<td>' + hub_formatDate(p.payment_date) + '</td>';



                    html += '<td>₹' + parseFloat(p.payment_amount).toLocaleString('en-IN', { minimumFractionDigits: 2 }) + '</td>';



                    html += '<td>' + (p.payment_method || '-') + '</td>';



                    html += '<td>' + (p.payment_reference || '-') + '</td>';



                    html += '<td>' + (p.payment_received_by_username || '-') + '</td>';



                    var approvalStatus = p.accountant_approval_status ? p.accountant_approval_status : 'pending';

                    var approvalClass = approvalStatus == 'approved' ? 'bg-success' : 'bg-warning';

                    html += '<td><span class="badge ' + approvalClass + '">' + approvalStatus.charAt(0).toUpperCase() + approvalStatus.slice(1) + '</span></td>';



                    var slipLink = '';

                    if (p.payment_slip) {

                        var slips = p.payment_slip.split(',');

                        for (var s = 0; s < slips.length; s++) {

                            slipLink += '<a href="<?php echo base_url(); ?>uploads/payment_slips/' + slips[s] + '" target="_blank" class="btn btn-primary shadow btn-xs sharp me-1" title="Payment Slip ' + (s+1) + '"><i class="fas fa-file-alt"></i></a>';

                        }

                    }

                    html += '<td><div class="d-flex">' + slipLink + '<button class="btn btn-primary shadow btn-xs sharp" onclick="hub_printReceipt(' + p.payment_id + ')" title="Print Receipt"><i class="fas fa-print"></i></button></div></td>';



                    html += '</tr>';



                }



            } else {



                html += '<tr><td colspan="7" class="text-center text-muted">No payments found</td></tr>';



            }



            $('#hub_receiptsTableBody').html(html);



            $('#hub_receiptsModal').modal('show');



        }



    });



}







function hub_printReceipt(paymentId) {



    var url = "<?php echo base_url(); ?>index.php/Receipt_scheduler/print_receipt/" + paymentId;



    window.open(url, '_blank', 'width=800,height=700');



}







function hub_deleteScheduler(id) {



    $('#hub_delete_scheduler_id').val(id);



    $('#hub_deleteModal').modal('show');



}







function hub_confirmDelete() {



    var id = $('#hub_delete_scheduler_id').val();



    $.ajax({



        url: "<?php echo base_url(); ?>index.php/Receipt_scheduler/delete",



        type: 'POST', data: { receipt_scheduler_id: id }, dataType: 'json',



        success: function(response) {



            $('#hub_deleteModal').modal('hide');



            if (response.error) {



                var n = new notify({ title: '', style: 'error', message: response.message, icon: 'fas fa-times' });

                n.show(); setTimeout(function(){ n.hide(); }, 3000);



            } else {



                hub_schedulerTable.ajax.reload();



                hub_scheduler_exists = false;

                if (hub_can_edit) {

                    $('#hub_addSchedulerBtn').show();

                }



                var n = new notify({ title: '', style: 'success', message: response.message, icon: 'fas fa-check' });

                n.show(); setTimeout(function(){ n.hide(); }, 3000);



            }



        }



    });



}







function hub_formatDate(dateStr) {



    if (!dateStr) return '-';



    var date = new Date(dateStr);



    return String(date.getDate()).padStart(2, '0') + '-' + String(date.getMonth() + 1).padStart(2, '0') + '-' + date.getFullYear();



}







$('#hub_total_amount').on('change', function() {



    if ($('#hub_payment_type').val() == 'EMI') {

        var amt = parseFloat($(this).val()) || 0;

        $('#hub_sched_emi_total_display').text('₹' + amt.toLocaleString('en-IN', { minimumFractionDigits: 2 }));

        hub_generateEmiRows();

    }



    else if ($('#hub_payment_type').val() == 'FULL') {

        var amt = parseFloat($(this).val()) || 0;

        $('#hub_sched_full_total_display').text('₹' + amt.toLocaleString('en-IN', { minimumFractionDigits: 2 }));

    }



});



$(document).on('change input', '#hub_emiTableBody .hub-emi-amount', function() {



    hub_redistributeEmiAmounts($(this));



});



$(document).on('change input', '#hub_emiTableBody .hub-emi-percentage', function() {



    hub_redistributeEmiAmounts($(this));



});



function hub_formatDateDMY(dateStr) {



    if (!dateStr) return '';



    var parts = dateStr.split('-');



    if (parts.length !== 3) return dateStr;



    return parts[2] + '/' + parts[1] + '/' + parts[0];



}



function hub_parseDateDMY(dateStr) {



    if (!dateStr) return '';



    var parts = dateStr.split('/');



    if (parts.length !== 3) return dateStr;



    return parts[2] + '-' + parts[1] + '-' + parts[0];



}



function hub_setCutoffDate(ymdDate) {



    $('#hub_cutoff_date_hidden').val(ymdDate);



    $('#hub_cutoff_date').val(hub_formatDateDMY(ymdDate));



    $('#hub_cutoff_date_display').text(hub_formatDateDMY(ymdDate));



}



$('#hub_cutoff_date').datepicker({



    format: 'dd/mm/yyyy',



    autoclose: true,



    todayHighlight: true



}).on('changeDate', function() {



    var val = $(this).val();



    $('#hub_cutoff_date_hidden').val(hub_parseDateDMY(val));



    $('#hub_cutoff_date_display').text(val);



});



$('#hub_cutoff_date').on('change', function() {



    var val = $(this).val();



    $('#hub_cutoff_date_hidden').val(hub_parseDateDMY(val));



    $('#hub_cutoff_date_display').text(val);



});



function hub_initEmiDatepickers() {



    $('#hub_emiTableBody .hub-emi-due-date').datepicker({



        format: 'dd/mm/yyyy',



        autoclose: true,



        todayHighlight: true



    }).off('changeDate.hubemi').on('changeDate.hubemi', function() {



        var val = $(this).val();



        $(this).closest('tr').find('.hub-emi-due-date-hidden').val(hub_parseDateDMY(val));



    });



}



$(document).on('change', '#hub_emiTableBody .hub-emi-due-date', function() {



    var val = $(this).val();



    $(this).closest('tr').find('.hub-emi-due-date-hidden').val(hub_parseDateDMY(val));



});



$(document).on('click', '#copyPropertyReservationBtn', function () {

    var quotation_id = $('#quotation_id').val();



    if (!quotation_id) {

        alert('Quotation ID missing');

        return;

    }



    window.open(

        "<?php echo base_url(); ?>index.php/Quotation/property_reservation_preview_new/" + quotation_id,

        "_blank"

    );

});



// ===== Hub Reservation Modal =====



$(document).on('click', '.hubResUpdateBtn', function () {

    var propertiesId   = $(this).data('properties-id');

    var propertiesName = $(this).data('properties-name');

    var checkIn        = $(this).data('check-in');

    var checkOut       = $(this).data('check-out');

    var nights         = $(this).data('nights');

    var quotation_id   = $('#quotation_id').val();

    hub_res_current_quotation_id  = quotation_id;

    hub_res_current_properties_id = propertiesId;



    $('#hubResModalLoader').show();

    $('#hubResModalContent').hide();

    $('#hubReservationModal')

        .data('hub-properties-id', propertiesId)

        .data('hub-properties-name', propertiesName)

        .data('hub-check-in', checkIn)

        .data('hub-check-out', checkOut)

        .data('hub-nights', nights)

        .modal('show');



    $.ajax({

        url: '<?php echo base_url(); ?>index.php/property_reservation/ajax_get_reservation',

        type: 'POST',

        dataType: 'json',

        data: {

            quotation_id:   quotation_id,

            properties_id:  propertiesId,

            check_in_date:  checkIn,

            check_out_date: checkOut,

            duration_nights: nights

        },

        success: function(res) {

            $('#hubResModalLoader').hide();

            if (!res.status) {

                var n = new notify({ title: '', style: 'error', message: res.message || 'Unable to load reservation', icon: 'fas fa-times' });

                n.show(); setTimeout(function(){ n.hide(); }, 3000);

                return;

            }

            hubRenderReservation(res);

            $('#hubResModalContent').show();

        },

        error: function() {

            $('#hubResModalLoader').hide();

            var n = new notify({ title: '', style: 'error', message: 'Failed to load reservation data.', icon: 'fas fa-times' });

            n.show(); setTimeout(function(){ n.hide(); }, 3000);

        }

    });

});



function hubRenderReservation(res) {

    var r = res.reservation;

    $('#hub_property_reservation_id').val(r.property_reservation_id);



    var propName  = r.properties_name || $('#hubReservationModal').data('hub-properties-name') || '-';

    var checkIn   = $('#hubReservationModal').data('hub-check-in')  || r.check_in_date  || '';

    var checkOut  = $('#hubReservationModal').data('hub-check-out') || r.check_out_date || '';

    var nights    = $('#hubReservationModal').data('hub-nights')    || r.duration_nights || 1;

    hub_res_checkin_date = checkIn;

    $('#hub_info_property').text(propName);

    $('#hub_info_guest').text(r.guest_name || '-');

    $('#hub_info_booking').text(r.booking_number || '-');

    $('#hub_info_checkin').text(hubFormatDate(checkIn));

    $('#hub_info_checkout').text(hubFormatDate(checkOut));

    $('#hub_info_duration').text(nights + ' Night(s)');



    var hubToday = new Date();

    var hubTodayYMD = hubToday.getFullYear() + '-' + String(hubToday.getMonth() + 1).padStart(2, '0') + '-' + String(hubToday.getDate()).padStart(2, '0');

    $('#hub_blocking_cnfm_by').val(r.blocking_cnfm_by || '');

    $('#hub_blocking_cutoff_date').val(hub_formatDateDMY(r.blocking_cutoff_date || checkIn || ''));

    $('#hub_blocking_date').val(hub_formatDateDMY(r.blocking_date || hubTodayYMD));

    hubInitBlockingDatepickers();

    hubSetPill('#hub_pill_blocking', r.blocking_status, 'BLOCKED');



    $('#hub_confirmation_cnfm_by').val(r.confirmation_cnfm_by || '');

    $('#hub_confirmation_cnfm_no').val(r.confirmation_cnfm_no || '');

    $('#hub_confirmation_cnfm_date').val(hub_formatDateDMY(r.confirmation_cnfm_date || hubTodayYMD));

    hubSetPill('#hub_pill_confirm', r.confirmation_status, 'CONFIRMED');



    $('#hub_reconfirmation_cnfm_by').val(r.reconfirmation_cnfm_by || '');

    $('#hub_reconfirmation_cnfm_no').val(r.confirmation_cnfm_no || '');

    $('#hub_reconfirmation_date').val(hub_formatDateDMY(r.reconfirmation_date || hubTodayYMD));

    hubInitConfirmationDatepickers();

    hubSetPill('#hub_pill_recon', r.reconfirmation_status, 'RECONFIRMED');



    var rentAmount = parseFloat(res.total_amount) || 0;

    var inclusionTotal = hubSumInclusions(res.inclusions_detail || []);

    var total = rentAmount + inclusionTotal;

    $('#hub_rent_amount').val(rentAmount);

    $('#hub_inclusion_amount').val(inclusionTotal);

    $('#hub_rent_amount_display').text(rentAmount.toLocaleString('en-IN'));

    $('#hub_inclusion_amount_display').text(inclusionTotal.toLocaleString('en-IN'));

    $('#hub_res_total_amount').val(total);

    $('#hub_payment_total_display').text(total.toLocaleString('en-IN'));

    hub_res_current_scheduler_id = 0;

    $('#hub_btn_view_payments').hide();

    $('#hub_discount_amount').val(0);

    $('#hub_discounted_total').val(total);

    $('#hub_discounted_total_display').hide();

    $('input[name="hub_payment_type"]').prop('checked', false).prop('disabled', false);

    $('#hub_res_cutoff_date').val('');

    $('#hub_res_cutoff_date_display').val('').prop('readonly', false);

    $('#hub_discount_amount').prop('readonly', false);

    $('#hub_res_max_emi_count').prop('disabled', false);

    $('#hub_split_type_res').prop('disabled', false);

    $('button[onclick="hubGenerateEmiRows()"]').prop('disabled', false);

    $('#hub_res_fullSection').hide();

    $('#hub_res_emiSection').hide();

    $('#hub_res_emiTableBody').html('');



    hub_res_has_payments = res.has_payments || false;

    if (res.payment) {

        var p = res.payment;

        hub_res_current_scheduler_id = parseInt(p.property_payment_scheduler_id) || 0;

        $('#hub_btn_view_payments').css('display', hub_res_current_scheduler_id > 0 ? 'inline-block' : 'none');

        var hubSavedDiscount = parseFloat(p.discount_amount) || 0;

        $('#hub_discount_amount').val(hubSavedDiscount);

        var hubNet = Math.max(0, total - hubSavedDiscount);

        $('#hub_discounted_total').val(hubNet);

        if (hubSavedDiscount > 0) {

            $('#hub_discounted_total_val').text(hubNet.toLocaleString('en-IN'));

            $('#hub_discounted_total_display').show();

        }

        if (hub_res_has_payments) {

            $('input[name="hub_payment_type"]').prop('disabled', true);

            $('#hub_res_max_emi_count').prop('disabled', true);

            $('#hub_split_type_res').prop('disabled', true);

            $('button[onclick="hubGenerateEmiRows()"]').prop('disabled', true);

            $('#hub_res_cutoff_date_display').prop('readonly', true);

            $('#hub_discount_amount').prop('readonly', true);

        }

        if (p.payment_type === 'FULL') {

            $('#hub_pt_full').prop('checked', true);

            hubTogglePaymentType();

            if (res.installments && res.installments.length > 0) {

                var hcd = res.installments[0].due_date || '';

                $('#hub_res_cutoff_date').val(hcd);

                $('#hub_res_cutoff_date_display').val(hub_formatDateDMY(hcd));

            } else if (hub_res_checkin_date) {

                $('#hub_res_cutoff_date').val(hub_res_checkin_date);

                $('#hub_res_cutoff_date_display').val(hub_formatDateDMY(hub_res_checkin_date));

            }

        } else if (p.payment_type === 'EMI') {

            $('#hub_pt_emi').prop('checked', true);

            $('#hub_res_max_emi_count').val(Math.min(24, Math.max(2, parseInt(p.max_emi_count) || 2)));

            $('#hub_split_type_res').val(p.split_type || 'AMOUNT');

            hubTogglePaymentType();

            hubRenderEmiFromData(res.installments, p.split_type);

        }

    }



    hubRenderRentBreakdown(res.rent_breakdown || []);

    hubRenderInclusionsDetail(res.inclusions_detail || []);



    hubRenderComments(res.comments || []);
    hubRenderCreditPanels(res);
}



function hub_money(v) {

    return parseFloat(v || 0).toLocaleString('en-IN', { minimumFractionDigits: 2, maximumFractionDigits: 2 });

}



function hubRenderRentBreakdown(rows) {

    var total = 0;

    rows.forEach(function(row) {

        total += parseFloat(row.day_rent) || 0;

    });

    $('#hub_rent_breakdown_total').text(hub_money(total));

}



function hubSumInclusions(rows) {

    var total = 0;

    (rows || []).forEach(function(row) {

        total += parseFloat(row.inclusion_amount) || 0;

    });

    return total;

}



function hubRenderInclusionsDetail(rows) {

    var html = '';

    rows.forEach(function(row) {

        var amt = parseFloat(row.inclusion_amount) || 0;

        html += '<div>' + escapeHtml(row.inclusion_name || '-') + ' &mdash; <strong>INR ' + hub_money(amt) + '</strong></div>';

    });

    if (!html) html = '<span class="text-muted">No property-based inclusions</span>';

    $('#hub_inclusions_detail_list').html(html);

}



function hubSetPill(sel, status, doneValue) {

    var $el = $(sel);

    if (status === doneValue) {

        $el.text(doneValue).removeClass('bg-secondary').addClass('bg-success');

    } else {

        $el.text('PENDING').removeClass('bg-success').addClass('bg-secondary');

    }

}



function hubTogglePaymentType() {

    var type = $('input[name="hub_payment_type"]:checked').val();

    if (type === 'FULL') {

        $('#hub_res_fullSection').show();

        $('#hub_res_emiSection').hide();

        if (hub_res_checkin_date && !$('#hub_res_cutoff_date').val()) {

            $('#hub_res_cutoff_date').val(hub_res_checkin_date);

            $('#hub_res_cutoff_date_display').val(hub_formatDateDMY(hub_res_checkin_date));

        }

        hub_res_initCutoffDatepicker();

        var fullNet = hub_getNetTotal();

        $('#hub_full_total_display').text('₹' + hub_money(fullNet));

    } else if (type === 'EMI') {

        $('#hub_res_fullSection').hide();

        $('#hub_res_emiSection').show();

        if ($('#hub_res_emiTableBody tr').length === 0) hubGenerateEmiRows();

        var emiNet = hub_getNetTotal();

        $('#hub_emi_total_display').text('₹' + hub_money(emiNet));

    } else {

        $('#hub_res_fullSection').hide();

        $('#hub_res_emiSection').hide();

    }

}



function hub_res_initCutoffDatepicker() {

    if ($('#hub_res_cutoff_date_display').data('datepicker')) return;

    $('#hub_res_cutoff_date_display').datepicker({

        format: 'dd/mm/yyyy',

        autoclose: true,

        todayHighlight: true

    }).on('changeDate', function() {

        $('#hub_res_cutoff_date').val(hub_parseDateDMY($(this).val()));

    });

}



function hub_res_initEmiDatepickers() {

    $('#hub_res_emiTableBody .hub-res-emi-due-date').datepicker({

        format: 'dd/mm/yyyy',

        autoclose: true,

        todayHighlight: true

    }).off('changeDate.hubresemi').on('changeDate.hubresemi', function() {

        $(this).closest('tr').find('.hub-res-emi-due-date-hidden').val(hub_parseDateDMY($(this).val()));

    });

}



function hubRedistributeEmi($changed) {

    var split = $('#hub_split_type_res').val();
    var total, $inputs;

    if (split === 'PERCENTAGE') {
        total = 100;
        $inputs = $('#hub_res_emiTableBody .hub-emi-percentage');
    } else {
        total = hub_getNetTotal();
        $inputs = $('#hub_res_emiTableBody .hub-emi-amount');
    }

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

    hubCalcEmiTotal();

}



function hub_getNetTotal() {

    var total = parseFloat($('#hub_res_total_amount').val()) || 0;

    var discount = parseFloat($('#hub_discount_amount').val()) || 0;

    return Math.max(0, total - discount);

}



function hub_applyDiscount() {

    var total = parseFloat($('#hub_res_total_amount').val()) || 0;

    var discount = parseFloat($('#hub_discount_amount').val()) || 0;

    if (discount < 0) { discount = 0; $('#hub_discount_amount').val(0); }

    if (discount > total) { discount = total; $('#hub_discount_amount').val(total); }

    var net = total - discount;

    $('#hub_discounted_total').val(net);

    if (discount > 0) {

        $('#hub_discounted_total_val').text(net.toLocaleString('en-IN'));

        $('#hub_discounted_total_display').show();

    } else {

        $('#hub_discounted_total_display').hide();

    }

    var type = $('input[name="hub_payment_type"]:checked').val();

    if (type === 'EMI') hubGenerateEmiRows();

    if (type === 'FULL') $('#hub_full_total_display').text('₹' + hub_money(net));

}



function hubGenerateEmiRows() {

    hub_buildResEmiRows(hub_res_checkin_date ? [hub_res_checkin_date] : []);

}



function hub_buildResEmiRows(accDates) {

    var count = Math.min(24, Math.max(2, parseInt($('#hub_res_max_emi_count').val()) || 2));

    $('#hub_res_max_emi_count').val(count);

    var total = hub_getNetTotal();

    var split = $('#hub_split_type_res').val();

    var today = new Date();

    var todayYMD = today.getFullYear() + '-' + String(today.getMonth() + 1).padStart(2, '0') + '-' + String(today.getDate()).padStart(2, '0');

    $('#hub_res_emiValHeader').text(split === 'PERCENTAGE' ? 'Percentage (%)' : 'Amount');

    var checkInDate = (accDates && accDates.length > 0) ? accDates[0] : '';

    var html = '';

    for (var i = 1; i <= count; i++) {

        var def = split === 'PERCENTAGE'

            ? (i === 1 ? 30 : 70 / (count - 1)).toFixed(2)

            : (total / count).toFixed(2);

        var dueDateYMD = i === 1 ? todayYMD : (checkInDate || todayYMD);

        html += '<tr><td class="text-center">' + i + '</td><td>';

        if (split === 'PERCENTAGE') {

            html += '<input type="number" step="0.01" class="form-control form-control-sm hub-emi-percentage" name="emi_percentage[]" value="' + def + '">';

        } else {

            html += '<input type="number" step="0.01" class="form-control form-control-sm hub-emi-amount" name="emi_amount[]" value="' + def + '">';

        }

        html += '</td><td>';

        html += '<input type="text" class="form-control form-control-sm hub-res-emi-due-date" placeholder="dd/mm/yyyy" value="' + hub_formatDateDMY(dueDateYMD) + '" required>';

        html += '<input type="hidden" name="emi_due_date[]" class="hub-res-emi-due-date-hidden" value="' + dueDateYMD + '">';

        html += '</td><td class="hub-emi-calc text-end">0.00</td></tr>';

    }

    $('#hub_res_emiTableBody').html(html);

    hub_res_initEmiDatepickers();

    hubCalcEmiTotal();

}



function hubRenderEmiFromData(installments, split) {

    if (!installments) return;

    var ro = hub_res_has_payments ? ' readonly' : '';

    $('#hub_res_emiValHeader').text(split === 'PERCENTAGE' ? 'Percentage (%)' : 'Amount');

    var html = '';

    for (var i = 0; i < installments.length; i++) {

        var inst = installments[i];

        html += '<tr><td class="text-center">' + inst.installment_number + '</td><td>';

        if (split === 'PERCENTAGE') {

            html += '<input type="number" step="0.01" class="form-control form-control-sm hub-emi-percentage" name="emi_percentage[]" value="' + (inst.installment_percentage || '') + '"' + ro + '>';

        } else {

            html += '<input type="number" step="0.01" class="form-control form-control-sm hub-emi-amount" name="emi_amount[]" value="' + (inst.installment_amount || '') + '"' + ro + '>';

        }

        html += '</td><td>';

        html += '<input type="text" class="form-control form-control-sm hub-res-emi-due-date" placeholder="dd/mm/yyyy" value="' + hub_formatDateDMY(inst.due_date || '') + '" required' + ro + '>';

        html += '<input type="hidden" name="emi_due_date[]" class="hub-res-emi-due-date-hidden" value="' + (inst.due_date || '') + '">';

        html += '</td>';

        html += '<td class="hub-emi-calc text-end">' + parseFloat(inst.calculated_amount || 0).toFixed(2) + '</td></tr>';

    }

    $('#hub_res_emiTableBody').html(html);

    hub_res_initEmiDatepickers();

    hubCalcEmiTotal();

}



function hubCalcEmiTotal() {

    var split = $('#hub_split_type_res').val();

    var total = hub_getNetTotal();

    var sum = 0;

    if (split === 'PERCENTAGE') {

        $('#hub_res_emiTableBody .hub-emi-percentage').each(function() {

            var pct  = parseFloat($(this).val()) || 0;

            var calc = (total * pct) / 100;

            sum += calc;

            $(this).closest('tr').find('.hub-emi-calc').text(calc.toFixed(2));

        });

    } else {

        $('#hub_res_emiTableBody .hub-emi-amount').each(function() {

            var amt = parseFloat($(this).val()) || 0;

            sum += amt;

            $(this).closest('tr').find('.hub-emi-calc').text(amt.toFixed(2));

        });

    }

    $('#hub_res_emiCalcTotal').text(sum.toFixed(2));

    $('#hub_emi_total_display').text('₹' + hub_money(sum));

    if (Math.abs(sum - total) > 0.01) {

        $('#hub_res_emiCalcTotal').addClass('text-danger');

    } else {

        $('#hub_res_emiCalcTotal').removeClass('text-danger');

    }

}



$(document).on('change input', '#hub_res_emiTableBody .hub-emi-amount', function() {

    hubRedistributeEmi($(this));

});



$(document).on('change input', '#hub_res_emiTableBody .hub-emi-percentage', function() {

    hubRedistributeEmi($(this));

});



$(document).on('change', '#hub_res_emiTableBody .hub-res-emi-due-date', function() {

    $(this).closest('tr').find('.hub-res-emi-due-date-hidden').val(hub_parseDateDMY($(this).val()));

});



function hubInitConfirmationDatepickers() {

    $('#hub_confirmation_cnfm_date, #hub_reconfirmation_date').each(function() {

        if ($(this).data('datepicker')) return;

        $(this).datepicker({

            format: 'dd/mm/yyyy',

            autoclose: true,

            todayHighlight: true

        });

    });

}



function hubInitBlockingDatepickers() {

    $('#hub_blocking_cutoff_date, #hub_blocking_date').each(function() {

        if ($(this).data('datepicker')) return;

        $(this).datepicker({

            format: 'dd/mm/yyyy',

            autoclose: true,

            todayHighlight: true

        });

    });

}



function hubSaveBlocking() {

    hubPostForm('property_reservation/save_blocking', '#hub_blockingForm', function() {

        hubReloadReservation();

    });

}



function hubSaveConfirmation() {

    var type = $('input[name="hub_payment_type"]:checked').val();

    if (!type) {

        var n = new notify({ title: '', style: 'error', message: 'Please select Payment Terms.', icon: 'fas fa-exclamation-circle' });

        n.show(); setTimeout(function(){ n.hide(); }, 3000);

        return;

    }

    if (type === 'FULL') {

        if (!$('#hub_res_cutoff_date').val()) {

            var n = new notify({ title: '', style: 'error', message: 'Please select Cutoff Date for Full Payment.', icon: 'fas fa-exclamation-circle' });

            n.show(); setTimeout(function(){ n.hide(); }, 3000);

            return;

        }

    }

    if (type === 'EMI') {

        var emiAmounts = $('#hub_res_emiTableBody .hub-emi-amount');

        var emiPercentages = $('#hub_res_emiTableBody .hub-emi-percentage');

        var emiDueDates = $('#hub_res_emiTableBody .hub-res-emi-due-date-hidden');

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

    hubPostForm('property_reservation/save_confirmation', '#hub_confirmForm', function() {

        hubReloadReservation();

        loadQuotationHubSummary($('#quotation_id').val());

    });

}



function hubSaveReconfirmation() {

    hubPostForm('property_reservation/save_reconfirmation', '#hub_reconForm', function() {

        hubReloadReservation();

        loadQuotationHubSummary($('#quotation_id').val());

    });

}



function hubAddComment() {

    var id   = $('#hub_property_reservation_id').val();

    var text = $('#hub_comment_text').val().trim();

    if (!text) return;

    $.ajax({

        url: '<?php echo base_url(); ?>index.php/property_reservation/add_comment',

        type: 'POST',

        dataType: 'json',

        data: { property_reservation_id: id, comment_text: text },

        success: function(res) {

            if (res.error) {

                var n = new notify({ title: '', style: 'error', message: res.message, icon: 'fas fa-times' });

                n.show(); setTimeout(function(){ n.hide(); }, 3000);

                return;

            }

            $('#hub_comment_text').val('');

            hubRenderComments(res.comments || []);

        }

    });

}



function hubRenderComments(comments) {

    var html = '';

    comments.forEach(function(c) {

        html += '<li class="list-group-item d-flex justify-content-between align-items-start">';

        html += '<div><div>' + escapeHtml(c.comment_text) + '</div>';

        html += '<small class="text-muted">' + (c.created_by_name || 'User') + ' &middot; ' + (c.comment_created_date || '') + '</small></div>';

        html += '</li>';

    });

    if (!html) html = '<li class="list-group-item text-muted">No comments yet.</li>';

    $('#hub_commentsList').html(html);

}



function hubPostForm(url, formSel, onDone) {

    var id = $('#hub_property_reservation_id').val();

    if (!id) {

        var n = new notify({ title: '', style: 'error', message: 'Reservation not loaded.', icon: 'fas fa-exclamation-circle' });

        n.show(); setTimeout(function(){ n.hide(); }, 3000);

        return;

    }

    var data = $(formSel).serialize() + '&property_reservation_id=' + id;

    $.ajax({

        url: '<?php echo base_url(); ?>index.php/' + url,

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



function hubReloadReservation() {

    loadPropertyStatus($('#quotation_id').val());

    var propertiesId = $('#hubReservationModal').data('hub-properties-id');

    var checkIn  = $('#hubReservationModal').data('hub-check-in');

    var checkOut = $('#hubReservationModal').data('hub-check-out');

    var nights   = $('#hubReservationModal').data('hub-nights');

    var quotation_id = $('#quotation_id').val();

    if (!propertiesId) return;

    $('#hubResModalLoader').show();

    $('#hubResModalContent').hide();

    $.ajax({

        url: '<?php echo base_url(); ?>index.php/property_reservation/ajax_get_reservation',

        type: 'POST',

        dataType: 'json',

        data: { quotation_id: quotation_id, properties_id: propertiesId, check_in_date: checkIn, check_out_date: checkOut, duration_nights: nights },

        success: function(res) {

            $('#hubResModalLoader').hide();

            if (!res.status) {

                var n = new notify({ title: '', style: 'error', message: res.message || 'Error', icon: 'fas fa-times' });

                n.show(); setTimeout(function(){ n.hide(); }, 3000);

                return;

            }

            hubRenderReservation(res);

            $('#hubResModalContent').show();

        }

    });

}



function hubFormatDate(d) {

    if (!d || d === '0000-00-00') return '-';

    var dt = new Date(d);

    if (isNaN(dt)) return d;

    return String(dt.getDate()).padStart(2, '0') + ' ' +

           dt.toLocaleString('en-US', { month: 'short' }) + ' ' + dt.getFullYear();

}



// ==================== Financial Posting ====================



$(document).on('shown.bs.tab', 'a[data-bs-toggle="tab"][href="#financialPostingTab"]', function () {

    var leadId = $('#hub_lead_id').val();

    if (leadId) {

        fpLoad(leadId);

    }

});



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

            d.days.forEach(function(day) {

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



    var safeLabel = escapeHtml(dayLabel);

    var daySubtotal = (parseFloat(hotelQuoted) || 0) + (parseFloat(incQuoted) || 0) + (parseFloat(specialQuoted) || 0);

    var dayIndex = $('#fpHubTable tbody tr.fp-day-header').length;

    var collapsedClass = dayIndex > 0 ? ' fp-collapsed' : '';

    var html = '';



    // Day title row (grouped header with per-day subtotal)

    html += '<tr class="fp-day-header' + collapsedClass + '">' +

        '<td colspan="5">' +

            '<span class="fp-day-toggle"><i class="la la-angle-down"></i></span>' +

            '<span class="fp-day-badge"><i class="la la-calendar-day me-1"></i>' + safeLabel + '</span>' +

            '<span class="fp-day-subtotal">Day Total (Quoted): <b>' + daySubtotal.toFixed(2) + '</b></span>' +

        '</td>' +

        '</tr>';



    // Hotel row

    var itemHiddenClass = dayIndex > 0 ? ' fp-hidden' : '';

    html += '<tr class="fp-day-hotel fp-day-item' + itemHiddenClass + '" data-day-label="' + safeLabel + '">' +

        '<td class="fp-item-label"><span class="fp-item-icon fp-icon-hotel"><i class="la la-hotel"></i></span>Hotel Rent</td>' +

        '<td><input type="number" class="form-control form-control-sm fp-quoted" name="day_hotel_quoted[]" value="' + hotelQuoted + '" placeholder="0.00" min="0" step="0.01" readonly></td>' +

        '<td><input type="number" class="form-control form-control-sm fp-actual" name="day_hotel_actual[]" value="' + hotelActual + '" placeholder="0.00" min="0" step="0.01"></td>' +

        '<td><input type="text" class="form-control form-control-sm" name="day_hotel_desc[]" value="' + escapeHtml(hotelDesc) + '" placeholder="Description"></td>' +

        '<td class="text-center"></td>' +

        '</tr>';



    // Inclusions row

    html += '<tr class="fp-day-inclusion fp-day-item' + itemHiddenClass + '">' +

        '<td class="fp-item-label"><span class="fp-item-icon fp-icon-inc"><i class="la la-concierge-bell"></i></span>Property Based Inclusions</td>' +

        '<td><input type="number" class="form-control form-control-sm fp-quoted" name="day_inc_quoted[]" value="' + incQuoted + '" placeholder="0.00" min="0" step="0.01" readonly></td>' +

        '<td><input type="number" class="form-control form-control-sm fp-actual" name="day_inc_actual[]" value="' + incActual + '" placeholder="0.00" min="0" step="0.01"></td>' +

        '<td><input type="text" class="form-control form-control-sm" name="day_inc_desc[]" value="' + escapeHtml(incDesc) + '" placeholder="Description"></td>' +

        '<td class="text-center"></td>' +

        '</tr>';



    // Special Requirements row

    html += '<tr class="fp-day-special fp-day-item' + itemHiddenClass + '">' +

        '<td class="fp-item-label"><span class="fp-item-icon fp-icon-special"><i class="la la-star"></i></span>Special Requirements</td>' +

        '<td><input type="number" class="form-control form-control-sm fp-quoted" name="day_special_quoted[]" value="' + specialQuoted + '" placeholder="0.00" min="0" step="0.01" readonly></td>' +

        '<td><input type="number" class="form-control form-control-sm fp-actual" name="day_special_actual[]" value="' + specialActual + '" placeholder="0.00" min="0" step="0.01"></td>' +

        '<td><input type="text" class="form-control form-control-sm" name="day_special_desc[]" value="' + escapeHtml(specialDesc) + '" placeholder="Description"></td>' +

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

        '<td class="fw-bold"><input type="text" class="form-control form-control-sm" name="exp_labels[]" value="' + escapeHtml(label) + '" placeholder="Other expense"></td>' +

        '<td class="text-center text-muted">—</td>' +

        '<td><input type="number" class="form-control form-control-sm fp-actual" name="exp_amounts[]" value="' + amount + '" placeholder="0.00" min="0" step="0.01"></td>' +

        '<td><input type="text" class="form-control form-control-sm" name="exp_descs[]" value="' + escapeHtml(desc) + '" placeholder="Description"></td>' +

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



    $('#fpActualCost').text(quotedTotal.toFixed(2));

    $('#fpCostAfterPost').text(actualTotal.toFixed(2));

    $('#fpTotalAfterMargin').text(totalAfterMargin.toFixed(2));

    $('#fpDifference').text(difference.toFixed(2));



    var badgeStyle = {'padding':'3px 12px','border-radius':'6px','color':'#fff'};

    if (difference > 0) {

        $('#fpDifference').removeClass('text-danger text-muted').addClass('text-white')

            .css($.extend({}, badgeStyle, {'background':'#198754'}));

    } else if (difference < 0) {

        $('#fpDifference').removeClass('text-success text-muted').addClass('text-white')

            .css($.extend({}, badgeStyle, {'background':'#dc3545'}));

    } else {

        $('#fpDifference').removeClass('text-success text-danger').addClass('text-white')

            .css($.extend({}, badgeStyle, {'background':'#6c757d'}));

    }

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

var hub_res_current_scheduler_id = 0;
var hub_res_has_payments = false;



function hubPrViewPaymentSummary() {

    if (!hub_res_current_scheduler_id) {

        var n = new notify({ title: '', style: 'error', message: 'No payment schedule found. Save confirmation first.', icon: 'fas fa-exclamation-circle' });

        n.show(); setTimeout(function(){ n.hide(); }, 3000);

        return;

    }

    $.ajax({

        url: '<?php echo base_url(); ?>index.php/property_reservation/ajax_get_payment_summary',

        type: 'POST',

        data: { scheduler_id: hub_res_current_scheduler_id },

        dataType: 'json',

        success: function(res) {

            if (res.error) {

                var n = new notify({ title: '', style: 'error', message: res.message, icon: 'fas fa-times' });

                n.show(); setTimeout(function(){ n.hide(); }, 3000);

                return;

            }

            var d = res.data;

            var s = d.scheduler || d.payment || null;

            if (s) {

                $('#hub_pr_view_quotation').text(s.quotation_number || '-');

                $('#hub_pr_view_guest').text(s.guest_name || '-');

                $('#hub_pr_view_property').text(s.properties_name || '-');

                $('#hub_pr_view_type').html(s.payment_type == 'FULL' ? '<span class="badge bg-primary">Full Payment</span>' : '<span class="badge bg-info">EMI</span>');

            }

            var totalAmt = d.net_total || (s ? (s.discounted_total > 0 ? s.discounted_total : s.total_amount) : 0);

            $('#hub_pr_view_total').text('₹' + parseFloat(totalAmt).toLocaleString('en-IN', { minimumFractionDigits: 2 }));

            $('#hub_pr_view_paid').text('₹' + parseFloat(d.total_paid).toLocaleString('en-IN', { minimumFractionDigits: 2 }));

            $('#hub_pr_view_pending').text('₹' + parseFloat(d.pending).toLocaleString('en-IN', { minimumFractionDigits: 2 }));

            $('#hub_pr_view_overdue').text(d.overdue_count);

            var html = '';

            var insts = d.installments;

            for (var i = 0; i < insts.length; i++) {

                var inst = insts[i];

                var sc = inst.payment_status === 'PAID' ? 'bg-success' : (inst.payment_status === 'PARTIAL' ? 'bg-warning' : (inst.payment_status === 'OVERDUE' ? 'bg-danger' : (inst.payment_status === 'PENDING' ? 'bg-danger' : 'bg-secondary')));

                var remaining = parseFloat(inst.calculated_amount) - parseFloat(inst.paid_amount);

                html += '<tr>';

                html += '<td>' + inst.installment_number + '</td>';

                html += '<td>' + hub_formatDate(inst.due_date) + '</td>';

                html += '<td>₹' + parseFloat(inst.calculated_amount).toLocaleString('en-IN', { minimumFractionDigits: 2 }) + '</td>';

                html += '<td>₹' + parseFloat(inst.paid_amount).toLocaleString('en-IN', { minimumFractionDigits: 2 }) + '</td>';

                html += '<td><span class="badge ' + sc + '">' + inst.payment_status + '</span></td>';

                html += '<td>';

                if (inst.payment_status !== 'PAID') {

                    html += '<button class="btn btn-success btn-xs me-1" onclick="hubPrRecordPayment(' + inst.installment_id + ',' + remaining.toFixed(2) + ')"><i class="fas fa-money-bill"></i> Pay</button>';

                }

                if (inst.payment_status === 'PAID' || inst.payment_status === 'PARTIAL') {

                    html += '<button class="btn btn-info btn-xs" onclick="hubPrViewReceipts(' + inst.installment_id + ')"><i class="fas fa-history"></i> Payment History</button>';

                }

                html += '</td></tr>';

            }

            if (!html) html = '<tr><td colspan="6" class="text-center text-muted">No installments found</td></tr>';

            $('#hub_pr_installments_body').html(html);

            $('#hubPrPaymentSummaryModal').modal('show');

        }

    });

}



function hubPrRecordPayment(installmentId, dueAmount) {

    $('#hub_pr_pay_installment_id').val(installmentId);

    $('#hub_pr_pay_scheduler_id').val(hub_res_current_scheduler_id);

    $('#hub_pr_pay_due_amount').val('₹' + parseFloat(dueAmount).toFixed(2));

    $('#hub_pr_pay_amount').val(parseFloat(dueAmount).toFixed(2));

    $('#hub_pr_pay_date').val(hubPaymentTodayDMY());

    if (!$('#hub_pr_pay_date').data('datepicker')) {

        $('#hub_pr_pay_date').datepicker({ format: 'dd/mm/yyyy', autoclose: true, todayHighlight: true });

    }

    $('#hub_pr_pay_method').val('');

    $('#hub_pr_pay_ref').val('');

    $('#hub_pr_pay_remarks').val('');

    $('#hub_pr_pay_slip').val('');

    if (window.resetMultiFiles_hub_pr_pay_slip) { window.resetMultiFiles_hub_pr_pay_slip(); }
    if (!window._hub_pr_pay_slip_picker_init) {
        initMultiFilePicker('hub_pr_pay_slip', 'hub_pr_pay_slip_list');
        window._hub_pr_pay_slip_picker_init = true;
    }

    $('#hubPrRecordPaymentModal').modal('show');

}



function hubPrSavePayment() {

    var $amount = $('#hub_pr_pay_amount');

    var $date = $('#hub_pr_pay_date');



    var amountVal = $.trim($amount.val());

    if (amountVal == '' || isNaN(amountVal) || parseFloat(amountVal) <= 0) {

        $amount.addClass('is-invalid');

        var n = new notify({ title: '', style: 'error', message: 'Please enter a valid payment amount greater than 0.', icon: 'fas fa-times' });

        n.show(); setTimeout(function(){ n.hide(); }, 3000);

        $amount.focus();

        return;

    } else {

        $amount.removeClass('is-invalid');

    }



    var dateValid = /^\d{2}\/\d{2}\/\d{4}$/.test($date.val());

    $date.toggleClass('is-invalid', !dateValid);

    var pickedFiles = window.getMultiFiles_hub_pr_pay_slip ? window.getMultiFiles_hub_pr_pay_slip() : [];

    if (!dateValid || pickedFiles.length === 0) {

        var msg = !dateValid ? 'Please enter a valid payment date in dd/mm/yyyy format.' : 'Please upload a payment slip.';

        var n = new notify({ title: '', style: 'error', message: msg, icon: 'fas fa-times' });

        n.show(); setTimeout(function(){ n.hide(); }, 3000);

        return;

    }



    var formData = new FormData($('#hubPrPaymentForm')[0]);
    for (var i = 0; i < pickedFiles.length; i++) {
        formData.append('payment_slip[]', pickedFiles[i]);
    }

    $.ajax({

        url: '<?php echo base_url(); ?>index.php/property_reservation/ajax_record_payment',

        type: 'POST',

        data: formData,

        processData: false,

        contentType: false,

        dataType: 'json',

        success: function(res) {

            if (res.error) {

                var n = new notify({ title: '', style: 'error', message: res.message || 'Failed to record payment.', icon: 'fas fa-times' });

                n.show(); setTimeout(function(){ n.hide(); }, 3000);

                return;

            }

            $('#hubPrRecordPaymentModal').modal('hide');

            hubPrViewPaymentSummary();

            var n = new notify({ title: '', style: 'success', message: res.message || 'Payment recorded successfully.', icon: 'fas fa-check' });

            n.show(); setTimeout(function(){ n.hide(); }, 3000);

        },

        error: function() {

            var n = new notify({ title: '', style: 'error', message: 'Failed to record payment.', icon: 'fas fa-times' });

            n.show(); setTimeout(function(){ n.hide(); }, 3000);

        }

    });

}



function hubPrViewReceipts(installmentId) {

    $.ajax({

        url: '<?php echo base_url(); ?>index.php/property_reservation/ajax_get_installment_payments',

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

                    html += '<td>' + hub_formatDate(p.payment_date) + '</td>';

                    html += '<td>₹' + parseFloat(p.payment_amount).toLocaleString('en-IN', { minimumFractionDigits: 2 }) + '</td>';

                    html += '<td>' + (p.payment_method || '-') + '</td>';

                    html += '<td>' + (p.payment_reference || '-') + '</td>';

                    html += '<td>' + (p.payment_paid_by_username || '-') + '</td>';

                    if (p.payment_slip) {

                        var slips = p.payment_slip.split(',');

                        var slipHtml = '';

                        for (var s = 0; s < slips.length; s++) {

                            slipHtml += '<a href="<?php echo base_url(); ?>uploads/payment_slips/' + slips[s] + '" target="_blank" class="btn btn-primary btn-xs me-1"><i class="fas fa-file-alt"></i> View ' + (s+1) + '</a>';

                        }

                        html += '<td>' + slipHtml + '</td>';

                    } else {

                        html += '<td>-</td>';

                    }

                    html += '</tr>';

                }

            } else {

                html = '<tr><td colspan="6" class="text-center text-muted">No payments recorded</td></tr>';

            }

            $('#hub_pr_receipts_body').html(html);

            $('#hubPrReceiptsModal').modal('show');

        }

    });

}



function hubPrPrintReceipt(paymentId) {

    window.open('<?php echo base_url(); ?>index.php/property_reservation/print_receipt/' + paymentId, '_blank', 'width=800,height=700');

}



function hub_formatDate(dateStr) {

    if (!dateStr || dateStr === '0000-00-00') return '-';

    var parts = dateStr.split('-');

    if (parts.length !== 3) return dateStr;

    return parts[2] + '-' + parts[1] + '-' + parts[0];

}



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

        $('#fp_record_id').val('');

    }

}

// =====================================================
// PROPERTY CREDIT DETECTION & APPLICATION (HUB)
// =====================================================

var hub_available_credits = [];
var hub_applied_credits   = [];

function hub_escapeHtml(s) {
    if (s === null || s === undefined) return '';
    return $('<div>').text(String(s)).html();
}

function hubRenderCreditPanels(res) {
    hub_available_credits = res.available_credits || [];
    hub_applied_credits   = res.applied_credits   || [];

    // Available credits panel
    if (hub_available_credits.length > 0) {
        var totalRemaining = 0;
        var html = '';
        hub_available_credits.forEach(function(c) {
            var rem = parseFloat(c.remaining_amount) || 0;
            totalRemaining += rem;
            html += '<div class="d-flex justify-content-between border-bottom py-1">'
                 +  '<span>Credit #' + c.property_credit_id
                 +  ' from <strong>' + hub_escapeHtml(c.cancellation_number || '-') + '</strong>'
                 +  (c.expiry_date && c.expiry_date !== '0000-00-00' ? ' <span class="text-danger small">(expires ' + hub_formatDateDMY(c.expiry_date) + ')</span>' : '')
                 +  '</span>'
                 +  '<span class="fw-bold text-warning">\u20B9' + hub_money(rem) + '</span>'
                 +  '</div>';
        });
        $('#hub_creditList').html(html);
        $('#hub_creditTotalBadge').text('\u20B9' + hub_money(totalRemaining));
        $('#hub_creditPanel').show();
    } else {
        $('#hub_creditPanel').hide();
    }

    // Applied credits panel
    if (hub_applied_credits.length > 0) {
        var totalApplied = 0;
        var aHtml = '';
        hub_applied_credits.forEach(function(a) {
            var amt = parseFloat(a.applied_amount) || 0;
            totalApplied += amt;
            aHtml += '<div class="d-flex justify-content-between border-bottom py-1">'
                  +  '<span>Credit #' + a.property_credit_id_fk
                  +  ' from <strong>' + hub_escapeHtml(a.cancellation_number || '-') + '</strong>'
                  +  ' applied on ' + hub_formatDateDMY(String(a.applied_datetime).substr(0, 10))
                  +  '</span>'
                  +  '<span class="fw-bold text-success">\u20B9' + hub_money(amt) + '</span>'
                  +  '</div>';
        });
        aHtml += '<div class="d-flex justify-content-between pt-2">'
              +  '<span class="fw-bold">Total Credit Used</span>'
              +  '<span class="fw-bold text-success">\u20B9' + hub_money(totalApplied) + '</span>'
              +  '</div>';
        $('#hub_appliedCreditsList').html(aHtml);
        $('#hub_appliedCreditsPanel').show();
    } else {
        $('#hub_appliedCreditsPanel').hide();
    }
}

function hubOpenCreditModal() {
    if (hub_available_credits.length === 0) {
        alert('No available credits for this property.');
        return;
    }

    var html = '';
    hub_available_credits.forEach(function(c) {
        var rem = parseFloat(c.remaining_amount) || 0;
        html += '<tr>'
             +  '<td class="text-center"><input type="checkbox" class="form-check-input hub-credit-check" data-credit-id="' + c.property_credit_id + '" data-remaining="' + rem + '"></td>'
             +  '<td>' + hub_escapeHtml(c.cancellation_number || '-') + '</td>'
             +  '<td>' + hub_escapeHtml(c.original_booking_number || '-') + '</td>'
             +  '<td class="text-end">\u20B9' + hub_money(rem) + '</td>'
             +  '<td class="text-end"><input type="number" min="0" step="0.01" class="form-control form-control-sm hub-credit-amount" style="width:120px; display:inline-block;" value="' + rem.toFixed(2) + '" data-credit-id="' + c.property_credit_id + '"></td>'
             +  '<td>' + (c.expiry_date && c.expiry_date !== '0000-00-00' ? hub_formatDateDMY(c.expiry_date) : '-') + '</td>'
             +  '</tr>';
    });
    $('#hubCreditModalBody').html(html);
    $('#hub_creditApplyTotal').text('\u20B9' + hub_money(0));

    $('.hub-credit-check').on('change', hubUpdateCreditApplyTotal);
    $('.hub-credit-amount').on('input', hubUpdateCreditApplyTotal);

    $('#hubCreditModal').modal('show');
}

function hubUpdateCreditApplyTotal() {
    var total = 0;
    $('.hub-credit-check:checked').each(function() {
        var id = $(this).data('credit-id');
        var remaining = parseFloat($(this).data('remaining')) || 0;
        var amtInput = $('.hub-credit-amount[data-credit-id="' + id + '"]');
        var amt = parseFloat(amtInput.val()) || 0;
        if (amt > remaining) { amtInput.val(remaining.toFixed(2)); amt = remaining; }
        if (amt < 0) { amtInput.val(0); amt = 0; }
        total += amt;
    });
    $('#hub_creditApplyTotal').text('\u20B9' + hub_money(total));
}

function hubApplySelectedCredits() {
    var selected = [];
    $('.hub-credit-check:checked').each(function() {
        var id = $(this).data('credit-id');
        var amt = parseFloat($('.hub-credit-amount[data-credit-id="' + id + '"]').val()) || 0;
        if (amt > 0) { selected.push({ credit_id: id, amount: amt }); }
    });

    if (selected.length === 0) {
        alert('Please select at least one credit and enter an amount.');
        return;
    }

    var reservationId = parseInt($('#hub_property_reservation_id').val(), 10) || 0;
    var done = 0;
    var errors = [];

    selected.forEach(function(item) {
        $.ajax({
            url: '<?php echo base_url(); ?>index.php/Property_credit/ajax_apply_credit',
            type: 'POST',
            async: false,
            data: {
                property_credit_id: item.credit_id,
                quotation_id: hub_res_current_quotation_id,
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
        $('#hubCreditModal').modal('hide');
        // Reload reservation data
        $.ajax({
            url: '<?php echo base_url(); ?>index.php/property_reservation/ajax_get_reservation',
            type: 'POST',
            data: {
                quotation_id: hub_res_current_quotation_id,
                properties_id: hub_res_current_properties_id
            },
            dataType: 'json',
            success: function(res) {
                if (res.status) { hubRenderReservation(res); }
            }
        });
    }
}

// ================= QUOTATION HUB EDIT (CONFIRMED OPTION ONLY) =================

function edit_quotation_hub(id)
{
    save_method = 'update';
    window.isQuotationEditLoading = true;
    window.isHubEdit = true;

    var editForm = document.getElementById('form') || document.getElementById('form5');
    if (editForm) editForm.reset();

    $('.form-group').removeClass('input-warning-o');
    $('.help-block').empty();

    $('.optionBlockContainer').empty();
    $('#inclusionTable tbody tr:gt(0)').remove();
    $('#specialReqTable tbody tr:gt(0)').remove();

    $('#quotation_property_inclusion_type').prop('checked', false);
    $('#quotation_special_requirement_type').prop('checked', false);
    $('#inclusionBox').hide();
    $('#specialReqBox').hide();

    optionCount = 0;

    $.ajax({
        url: "<?php echo base_url();?>index.php/Quotation/ajax_edit_hub/" + id,
        type: "GET",
        dataType: "JSON",
        success: function(res)
        {
            if (!res.status) {
                window.isQuotationEditLoading = false;
                window.isHubEdit = false;
                alert(res.message || 'Failed to load quotation');
                return;
            }

            const q = res.quotation || {};
            const confirmedOption = res.confirmed_option || {};

            $('[name="id"]').val(q.quotation_id || '');

            $('#quotation_title').val(q.quotation_title || '');

            const leads_id = q.leads_id_fk || '';
            const package_id = q.packages_id_fk || q.package_id_fk || q.pacakage_id_fk || '';

            if (q.leads_id_fk) {
                var leadText = q.leads_number
                    ? q.leads_number + ' - ' + q.guest_name
                    : q.guest_name;
                var leadOption = new Option(leadText, q.leads_id_fk, true, true);
                $('#leads_id').data('filter-mode', 'edit').empty().append(leadOption).trigger('change.select2');
                $('#leads_id').prop('disabled', true);
                $('#leads_id_hidden').val(q.leads_id_fk);
            }

            $('#packages_id_hidden').val(package_id);
            $('#packages_id_fk').val(package_id);
            $('#template_name_display').text(q.packages_title || '');

            // Show confirmed option name as heading
            var optionTitle = confirmedOption.quotation_options_title || 'Confirmed Option';
            $('#hubEditOptionHeading').remove();
            $('#QuotationModal .modal-title').text('Edit Confirmed Quotation');
            $('#QuotationModal .modal-body').prepend(
                '<div id="hubEditOptionHeading" class="alert alert-info text-center mb-3" style="font-size:18px; font-weight:700;">' +
                '<i class="la la-check-circle me-2"></i> Confirmed Option: ' + escapeHtml(optionTitle) +
                '</div>'
            );

            // Store lead data for reschedule
            window.hubLeadData = res.lead || {};

            // Add reschedule section
            $('#hubRescheduleSection').remove();
            var startDateStr = window.hubLeadData.start_date ? formatDateForDisplay(window.hubLeadData.start_date) : '';
            var endDateStr = window.hubLeadData.end_date ? formatDateForDisplay(window.hubLeadData.end_date) : '';
            var duration = window.hubLeadData.duration || 0;

            $('#hubEditOptionHeading').after(
                '<div id="hubRescheduleSection" class="card mb-3">' +
                '<div class="card-header bg-light">' +
                '<h6 class="mb-0"><i class="la la-calendar me-2"></i> Reschedule Travel Date</h6>' +
                '</div>' +
                '<div class="card-body py-2">' +
                '<div class="row align-items-end">' +
                '<div class="col-md-2">' +
                '<label class="form-label small">Current Travel Start Date</label>' +
                '<input type="hidden" id="hubCurrentStartDate" value="' + escapeHtml(startDateStr) + '">' +
                '<p class="form-control-plaintext fw-bold" id="hubCurrentStartDateDisplay">' + escapeHtml(startDateStr) + '</p>' +
                '</div>' +
                '<div class="col-md-2">' +
                '<label class="form-label small">Current End Date</label>' +
                '<input type="hidden" id="hubCurrentEndDate" value="' + escapeHtml(endDateStr) + '">' +
                '<p class="form-control-plaintext fw-bold" id="hubCurrentEndDateDisplay">' + escapeHtml(endDateStr) + '</p>' +
                '</div>' +
                '<div class="col-md-2">' +
                '<label class="form-label small">Duration</label>' +
                '<p class="form-control-plaintext fw-bold" id="hubCurrentDurationDisplay">' + duration + ' Days</p>' +
                '</div>' +
                '<div class="col-md-3">' +
                '<label class="form-label small">New Travel Date</label>' +
                '<input type="text" class="form-control form-control-sm" id="hubNewStartDate" placeholder="dd/mm/yyyy">' +
                '</div>' +
                '<div class="col-md-3">' +
                '<label class="form-label small">New End Date</label>' +
                '<input type="text" class="form-control form-control-sm" id="hubNewEndDate" readonly placeholder="dd/mm/yyyy">' +
                '</div>' +
                '</div>' +
                '<div class="row mt-2">' +
                '<div class="col-md-12">' +
                '</div>' +
                '</div>' +
                '</div>' +
                '</div>'
            );

            // Auto-calc end date and trigger room-rate recalculation on date change
            function onNewStartDateChange() {
                window.hubDatesRecalculated = false;
                window.__hubAutoCalcTriggered = false;

                var raw = $('#hubNewStartDate').val().trim();
                // Convert dd/mm/yyyy to yyyy-mm-dd for calculation
                var parts = raw.split(/[\/-]/);
                if (parts.length === 3) {
                    var isoStart = parts[2] + '-' + parts[1].padStart(2,'0') + '-' + parts[0].padStart(2,'0');

                    // Check if same as current start date or current end date
                    var currentStartIso = $('#hubCurrentStartDate').val();
                    var currentEndIso = $('#hubCurrentEndDate').val();
                    // Convert current dates from dd-mm-yyyy to yyyy-mm-dd for comparison
                    var currentStartParts = currentStartIso.split(/[\/-]/);
                    var currentEndParts = currentEndIso.split(/[\/-]/);
                    var currentStartNormalized = currentStartParts.length === 3 ? currentStartParts[2] + '-' + currentStartParts[1].padStart(2,'0') + '-' + currentStartParts[0].padStart(2,'0') : '';
                    var currentEndNormalized = currentEndParts.length === 3 ? currentEndParts[2] + '-' + currentEndParts[1].padStart(2,'0') + '-' + currentEndParts[0].padStart(2,'0') : '';

                    if (isoStart === currentStartNormalized) {
                        alert('New travel date cannot be the same as current travel start date.');
                        $('#hubNewStartDate').val('');
                        $('#hubNewEndDate').val('');
                        return;
                    }
                    if (isoStart === currentEndNormalized) {
                        alert('New travel date cannot be the same as current end date.');
                        $('#hubNewStartDate').val('');
                        $('#hubNewEndDate').val('');
                        return;
                    }

                    if (duration > 0) {
                        var newEnd = new Date(isoStart);
                        newEnd.setDate(newEnd.getDate() + parseInt(duration));
                        var newEndDay = String(newEnd.getDate()).padStart(2, '0');
                        var newEndMonth = String(newEnd.getMonth() + 1).padStart(2, '0');
                        var newEndYear = newEnd.getFullYear();
                        $('#hubNewEndDate').val(newEndDay + '/' + newEndMonth + '/' + newEndYear);

                        // Store the new start date (ISO) so tariff fetches use the new travel dates
                        window.hubRescheduleNewStartISO = isoStart;

                        // Clear all room calculated rates — user must recalculate based on the new dates
                        var $optionBlock = $('#optionsContainer .optionBlock').first();
                        if ($optionBlock.length) {
                            $optionBlock.find('.autoCalcRateInput').val('0.00');
                            $optionBlock.find('.autoCalcRateText').text('0.00');
                            // Drop stale in-memory tariff data so rooms re-fetch rates on edit
                            $optionBlock.find('.quotationRoomTariffDetailsIdInput').each(function () {
                                if (this.value && typeof removePendingTariffData === 'function') {
                                    removePendingTariffData(this.value);
                                }
                            });
                            if (typeof recalcOptionTotals === 'function') {
                                recalcOptionTotals($optionBlock[0]);
                            }
                        }
                    }
                } else {
                    $('#hubNewEndDate').val('');
                    window.hubRescheduleNewStartISO = null;
                }
            }

            $('#hubNewStartDate').on('change', onNewStartDateChange);

            // Initialize datepicker on New Travel Date
            $('#hubNewStartDate').datepicker({ format: 'dd/mm/yyyy', autoclose: true, todayHighlight: true })
                .on('changeDate', onNewStartDateChange);

            // Hide remarks section for hub edit
            $('#quotation_remarks').closest('.col-md-3').hide();

            $('#QuotationModal').modal('show');
            $('#btnSave').text('Update').removeAttr('onclick').off('click').on('click', function(e) {
                e.preventDefault();
                saveQuotationHub();
            });

            // Build only the confirmed option block (read-only, no editing of itinerary)
            if (confirmedOption && confirmedOption.quotation_options_id) {
                rebuildQuotationOptionBlocks([confirmedOption], package_id, function () {
                    // Hide fields within option blocks for hub edit
                    hideHubEditFields();
                    $('#addOptionBtn').hide();

                    loadInclusionAndRequirementDropdownData(function () {

                        if ((res.property_inclusions || []).length > 0) {
                            $('#quotation_property_inclusion_type').prop('checked', true);
                            $('#inclusionBox').show();
                            refillSavedPropertyInclusions(res.property_inclusions || []);
                        }

                        if ((res.special_requirements || []).length > 0) {
                            $('#quotation_special_requirement_type').prop('checked', true);
                            $('#specialReqBox').show();
                            refillSavedSpecialRequirements(res.special_requirements || []);
                        }

                        setTimeout(function () {
                            window.isQuotationEditLoading = false;
                        }, 500);
                    });
                });
            } else {
                // No confirmed option found, still load inclusions/requirements
                loadInclusionAndRequirementDropdownData(function () {
                    if ((res.property_inclusions || []).length > 0) {
                        $('#quotation_property_inclusion_type').prop('checked', true);
                        $('#inclusionBox').show();
                        refillSavedPropertyInclusions(res.property_inclusions || []);
                    }
                    if ((res.special_requirements || []).length > 0) {
                        $('#quotation_special_requirement_type').prop('checked', true);
                        $('#specialReqBox').show();
                        refillSavedSpecialRequirements(res.special_requirements || []);
                    }
                    setTimeout(function () {
                        window.isQuotationEditLoading = false;
                    }, 500);
                });
            }

            setTimeout(function () {
                window.isQuotationEditLoading = false;
            }, 500);
        },
        error: function()
        {
            window.isQuotationEditLoading = false;
            window.isHubEdit = false;
            alert('Error getting data from ajax');
        }
    });
}

function hideHubEditFields()
{
    // Hide Date, Arriving destination, Departuring destination fields
    $('#quotation_date').closest('.col-md-3').hide();
    $('#arriving_destination').closest('.col-md-3').hide();
    $('#departuring_destination').closest('.col-md-3').hide();

    // Hide Leads and Template fields
    $('#leads_id').closest('.col-md-3').hide();
    $('#leads_id').closest('.col-md-3.leads_id').hide();
    $('.packages_id_fk').hide();

    // Hide Add New Option button
    $('#addOptionBtn').hide();

    // Inside each option block, hide: Select Template Option, Option Name, Select Design, Select Vehicle,
    // Show Room Category, Show Meal Plan, Show Vehicle checkboxes
    $('#optionsContainer .optionBlock').each(function() {
        var $block = $(this);
        // Select template option
        $block.find('[name="packages_properties_common_id_fk[]"]').closest('.col-md-2').hide();
        // Option name
        $block.find('[name="quotation_options_title[]"]').closest('.col-md-2').hide();
        // Select Design
        $block.find('[name="quotation_options_design_type[]"]').closest('.col-md-2').hide();
        // Select Vehicle
        $block.find('[name="quotation_options_vehicle_id_fk[]"]').closest('.col-md-2').hide();
        // Show Room Category checkbox
        $block.find('[name="quotation_options_room_category_display[]"]').closest('.col-md-3').hide();
        // Show Meal Plan checkbox
        $block.find('[name="quotation_options_meal_plan_display[]"]').closest('.col-md-3').hide();
        // Show Vehicle checkbox
        $block.find('[name="quotation_options_vehicle_display[]"]').closest('.col-md-3').hide();
    });
}

function saveQuotationHub()
{
    var quotationId = $('[name="id"]').val();
    if (!quotationId) {
        alert('Quotation ID missing');
        return;
    }

    // If travel dates were changed, ensure all room rates were recalculated for the new dates
    var newStartDate = $('#hubNewStartDate').val().trim();
    if (newStartDate) {
        if (window.__autoCalcActive) {
            alert('Room-rate recalculation is in progress. Please wait for it to complete before updating.');
            return;
        }
        var pendingRecalc = false;
        $('#optionsContainer .optionBlock').first().find('.autoCalcRateInput').each(function () {
            if (parseFloat(this.value) <= 0) {
                pendingRecalc = true;
                return false;
            }
        });
        if (pendingRecalc) {
            alert('Please recalculate room rates for the new travel dates before updating (use Auto Calculate or edit each room).');
            return;
        }
    }

    $('#btnSave').text('saving...').attr('disabled', true);

    // ensure latest totals
    if (typeof recalcAllOptionsBeforeSave === 'function') {
        recalcAllOptionsBeforeSave();
    }

    var form = document.getElementById('form') || document.getElementById('form5');
    var data = new FormData(form);

    data.set('id', quotationId);
    data.set('quotation_title', $('#QuotationModal [name="quotation_title"]').val() || '');
    data.set('quotation_remarks', $('[name="quotation_remarks"]').val() || '');
    data.set('total_inclusion_amount', $('#total_inclusion_amount').val() || 0);
    data.set('total_special_requirment_amount', $('#total_special_requirment_amount').val() || 0);

    // Pass new travel dates to the server so they are saved together with the recalculated rates
    if (newStartDate) {
        data.append('hub_new_start_date', newStartDate);
        data.append('hub_new_end_date', $('#hubNewEndDate').val().trim());
    }

    // JSON payload with options/days/properties/rooms
    data.append('data', JSON.stringify(buildQuotationPayload()));

    $.ajax({
        url: "<?php echo base_url();?>index.php/Quotation/ajax_update_hub",
        type: "POST",
        data: data,
        dataType: "JSON",
        processData: false,
        contentType: false,
        success: function(res) {
            $('#btnSave').text('Update').attr('disabled', false);
            if (res.status) {
                resetQuotationModalForm();
                $('#QuotationModal').modal('hide');
                window.isHubEdit = false;
                swal("Quotation updated successfully", "", "success").then(function() {
                    window.location.reload();
                });
            } else {
                alert(res.message || 'Update failed');
            }
        },
        error: function() {
            $('#btnSave').text('Update').attr('disabled', false);
            alert('Error saving data');
        }
    });
}

function escapeHtml(str)
{
    if (!str) return '';
    return String(str)
        .replace(/&/g, '&amp;')
        .replace(/</g, '&lt;')
        .replace(/>/g, '&gt;')
        .replace(/"/g, '&quot;')
        .replace(/'/g, '&#039;');
}

function formatDateForDisplay(dateStr)
{
    if (!dateStr || dateStr === '0000-00-00') return '';
    var d = new Date(dateStr);
    if (isNaN(d.getTime())) return dateStr;
    var day = String(d.getDate()).padStart(2, '0');
    var month = String(d.getMonth() + 1).padStart(2, '0');
    var year = d.getFullYear();
    return day + '-' + month + '-' + year;
}

// Clean up hub edit state when modal is closed
$(document).on('hidden.bs.modal', '#QuotationModal', function () {
    if (window.isHubEdit) {
        window.isHubEdit = false;
        // Remove heading
        $('#hubEditOptionHeading').remove();
        // Remove reschedule section
        $('#hubRescheduleSection').remove();
        window.hubLeadData = null;
        // Reset date-change tracking flags so unsaved date changes are discarded
        window.hubDatesRecalculated = false;
        window.__hubAutoCalcTriggered = false;
        window.hubRescheduleNewStartISO = null;
        // Restore modal title
        $('#QuotationModal .modal-title').text('');
        // Restore hidden fields
        $('#quotation_date').closest('.col-md-3').show();
        $('#arriving_destination').closest('.col-md-3').show();
        $('#departuring_destination').closest('.col-md-3').show();
        $('#quotation_remarks').closest('.col-md-3').show();
        $('#leads_id').closest('.col-md-3').show();
        $('#leads_id').closest('.col-md-3.leads_id').show();
        $('.packages_id_fk').show();
        $('#addOptionBtn').show();
        // Restore option block fields
        $('#optionsContainer .optionBlock').each(function() {
            var $block = $(this);
            $block.find('[name="packages_properties_common_id_fk[]"]').closest('.col-md-2').show();
            $block.find('[name="quotation_options_title[]"]').closest('.col-md-2').show();
            $block.find('[name="quotation_options_design_type[]"]').closest('.col-md-2').show();
            $block.find('[name="quotation_options_vehicle_id_fk[]"]').closest('.col-md-2').show();
            $block.find('[name="quotation_options_room_category_display[]"]').closest('.col-md-3').show();
            $block.find('[name="quotation_options_meal_plan_display[]"]').closest('.col-md-3').show();
            $block.find('[name="quotation_options_vehicle_display[]"]').closest('.col-md-3').show();
            $block.find('.removeOptionBtn').show();
        });
        // Restore save button
        $('#btnSave').text('Save').off('click').attr('onclick', 'saveQuotation()');
    }
});

var IS_QUOTATION_HUB = true;



<?php include(APPPATH . 'views/Quotation/quotation_modal_script.php'); ?>



</script>