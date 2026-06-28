<script>

document.addEventListener('DOMContentLoaded', function () {



    // alert('hub ready');



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



            $('#hubQuotationNumber').text(data.quotation_number || '-');

            $('#hubGuestName').text(data.guest_name || '-');

            $('#hubLeadNumber').text(data.leads_number || '-');

            $('#hubLeadType').text(data.lead_type || '-');

            $('#hubStartDate').text(data.start_date || '-');

            $('#hubDuration').text(data.duration ? data.duration + ' Days' : '-');

            $('#hubEndDate').text(data.end_date || '-');

            $('#hub_lead_id').val(data.leads_id || '');



            var statusHtml = '-';



            if (data.quotation_current_status == 1) statusHtml = '<span class="badge badge-secondary">Generated</span>';

            else if (data.quotation_current_status == 2) statusHtml = '<span class="badge badge-light">Draft</span>';

            else if (data.quotation_current_status == 3) statusHtml = '<span class="badge badge-info">Sent</span>';

            else if (data.quotation_current_status == 4) statusHtml = '<span class="badge badge-danger">Rejected</span>';

            else if (data.quotation_current_status == 5) statusHtml = '<span class="badge badge-success">Confirmed</span>';

            else if (data.quotation_current_status == 6) statusHtml = '<span class="badge badge-danger">Cancelled</span>';



            $('#hubQuotationStatus').html(statusHtml);

            // Show confirmed option inside the status card
            if (data.quotation_current_status == 5 && data.confirmed_option_title) {
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

        },

        error: function(xhr) {

            console.log('AJAX error:', xhr.responseText);

        }

    });

}



// Update buttons and tabs based on quotation status

function updateQuotationHubActions(status) {

    var buttonsHtml = '';



    // Status 2=Draft, 3=Sent, 4=Rejected: Show Generate button

    if (status == 2 || status == 3 || status == 4) {

        buttonsHtml = '<button type="button" class="btn btn-primary btn-sm" onclick="showGenerateModal()">' +

                      '<i class="la la-file-alt me-1"></i> Generate Quotation</button>';

    }

    // Status 1=Generated: Show Confirm button

    else if (status == 1) {

        buttonsHtml = '<button type="button" class="btn btn-success btn-sm" onclick="showConfirmModal()">' +

                      '<i class="la la-check-circle me-1"></i> Confirm Quotation</button>';

    }

    // Status 5=Accepted: Show confirmed status

    else if (status == 5) {

        var confirmedOption = $('#hubStatusOptionText').text();
        var optionLabel = confirmedOption ? ' <span style="background:#fff;color:#155724;padding:2px 8px;border-radius:12px;margin-left:6px;font-size:14px;">' + confirmedOption + '</span>' : '';
        buttonsHtml = '<span class="badge badge-success p-2" style="font-size:16px;padding:10px 16px;"><i class="la la-check me-1"></i> Quotation Confirmed' + optionLabel + '</span>';

    }



    $('#quotationActionButtons').html(buttonsHtml);



    // Tab enabling/disabling logic

    // Group 1: Client confirmation, Receipt Scheduler, Property reservation

    // Enabled only for status 1 (Generated) and 5 (Confirmed)

    var group1Enabled = (status == 1 || status == 5);

    toggleTab('tabClientConfirmation', group1Enabled,

        status == 1 ? 'Generate quotation to enable this tab' :

        (status == 5 ? '' : 'Quotation must be generated first'));

    toggleTab('tabReceiptScheduler', group1Enabled,

        status == 1 ? '' :

        (status == 5 ? '' : 'Quotation must be generated first'));

    toggleTab('tabPropertyReservation', group1Enabled,

        status == 1 ? '' :

        (status == 5 ? '' : 'Quotation must be generated first'));



    // Group 2: Property voucher, Tour voucher, Driver itinerary

    // Enabled only for status 5 (Confirmed)

    var group2Enabled = (status == 5);

    var group2Tooltip = status == 5 ? '' : 'Quotation must be confirmed first';

    toggleTab('tabPropertyVoucher', group2Enabled, group2Tooltip);

    toggleTab('tabTourVoucher', group2Enabled, group2Tooltip);

    toggleTab('tabDriverItinerary', group2Enabled, group2Tooltip);

    toggleTab('tabFinancialPosting', group2Enabled, group2Tooltip);

}



function toggleTab(tabId, enabled, tooltipMessage) {

    var $tab = $('#' + tabId);

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

                            ['Duration', d.duration ? d.duration + ' Days' : '-'],

                            ['End Date', formatDate(d.end_date)]

                        ])}

                    </div>



                    <div class="col-xl-3 col-lg-6 col-md-6">

                        ${buildHubInfoSection('Created Details', [

                            ['Created Date', formatDate(d.leads_created_date)],

                            ['Created Time', d.leads_created_time],

                            ['Created By User', d.leads_createdby_username]

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



function loadConfirmationOptions(quotation_id, savedData)

{

    $.ajax({

        url: "<?php echo base_url(); ?>index.php/Quotation/ajax_get_confirmation_options",

        type: "POST",

        dataType: "json",

        data: { quotation_id: quotation_id },

        success: function(res) {

            var html = '<option value="">Select Option</option>';



            if (res.status && res.data) {

                $.each(res.data, function(i, row) {

                    html += '<option value="' + row.quotation_options_id + '">' +

                        escapeHtml(row.quotation_options_title || 'Option ' + (i + 1)) +

                    '</option>';

                });

            }



            $('#confirmationOptionSelect').html(html);



            if ($.fn.select2) {

                if ($('#confirmationOptionSelect').hasClass('select2-hidden-accessible')) {

                    $('#confirmationOptionSelect').select2('destroy');

                }



                $('#confirmationOptionSelect').select2({

                    width: '100%',

                    placeholder: 'Select Option'

                });

            }



            if (savedData && savedData.option_id) {

                $('#confirmationOptionSelect').val(savedData.option_id).trigger('change.select2');

                loadConfirmationOptionDetails(quotation_id, savedData.option_id, savedData.rows || []);

            } else {

                // No saved data — reset details section and hide export button
                $('#confirmationOptionDetails').html(`
                    <div class="alert alert-info mb-0">Please select an option to view details.</div>
                `);

                $('#copyExportConfirmationBtn').addClass('d-none');

            }

        }

    });

}



$(document).on('change', '#confirmationOptionSelect', function () {

    var quotation_id = $('#quotation_id').val();

    var quotation_options_id = $(this).val();



    if (!quotation_options_id) {

        $('#confirmationOptionDetails').html(`

            <div class="alert alert-info mb-0">Please select an option to view details.</div>

        `);

        return;

    }



    // Always fetch saved rows so confirmation_ids are available for update on submit

    $.ajax({

        url: "<?php echo base_url(); ?>index.php/Quotation/ajax_get_saved_confirmation",

        type: "POST",

        dataType: "json",

        data: { quotation_id: quotation_id },

        success: function(saved) {

            var savedRows = saved.status ? saved.rows : [];

            // If the selected option matches the saved option, pre-check the saved checkboxes

            var preCheck  = saved.status && String(saved.option_id) === String(quotation_options_id);

            // Hide button until rooms are (re-)checked after option change
            $('#copyExportConfirmationBtn').addClass('d-none');

            loadConfirmationOptionDetails(quotation_id, quotation_options_id, savedRows, preCheck);

        },

        error: function() {

            loadConfirmationOptionDetails(quotation_id, quotation_options_id, [], false);

        }

    });

});



function loadConfirmationOptionDetails(quotation_id, quotation_options_id, savedRows, preCheck)

{

    savedRows = savedRows || [];

    if (preCheck === undefined) preCheck = true;



    $('#confirmationOptionDetails').html(`

        <div class="text-center py-4">

            <div class="spinner-border text-primary"></div>

            <p class="mt-2 mb-0">Loading option details...</p>

        </div>

    `);



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

                $('#confirmationOptionDetails').html(`

                    <div class="alert alert-warning mb-0">No details found.</div>

                `);

                return;

            }



            $('#confirmationOptionDetails').html(buildConfirmationDetailsTable(res.data, savedRows, preCheck));

            // Show button if this option has saved data
            if (preCheck && savedRows.length > 0) {
                $('#copyExportConfirmationBtn')
                    .removeClass('d-none')
                    .data('quotation-id', quotation_id);
            }

        }

    });

}



function buildConfirmationDetailsTable(days, savedRows, preCheck)

{

    savedRows = savedRows || [];

    if (preCheck === undefined) preCheck = true;



    // Build a lookup keyed by day only: properties_day_id_fk -> { id, properties_room_id_fk }

    var savedMap = {};

    $.each(savedRows, function(i, r) {

        savedMap[r.properties_day_id_fk] = { id: r.id || 0, room_id: r.properties_room_id_fk };

    });



    var html = `

        <form id="confirmationSubmitForm">

        <div class="table-responsive">

            <table class="table table-bordered align-middle" id="confirmationDetailsTable">

                <thead class="table-light">

                    <tr>

                        <th>Day</th>

                        <th>Destination</th>

                        <th>Property</th>

                        <th>Room</th>

                        <th style="width:80px" class="text-center">Select</th>

                    </tr>

                </thead>

                <tbody>

    `;



    $.each(days, function(i, day) {

        if (!day.properties || !day.properties.length) return;



        // count total room rows for this day (for rowspan)

        var dayRowspan = 0;

        $.each(day.properties, function(j, prop) {

            if (prop.rooms && prop.rooms.length) dayRowspan += prop.rooms.length;

            else dayRowspan += 1;

        });



        var dayRendered  = false;

        var daySaved     = savedMap[day.quotation_properties_days_id] || {};

        var dayConfId    = daySaved.id      || 0;

        var dayRoomSaved = daySaved.room_id || 0;



        $.each(day.properties, function(j, property) {

            var rooms = (property.rooms && property.rooms.length) ? property.rooms : [null];



            // count room rows for this property (for rowspan)

            var propRowspan = rooms.length;

            var propRendered = false;



            $.each(rooms, function(k, room) {

                var roomName      = room ? escapeHtml(room.properties_room_category_name || '-') : '-';

                var roomCatId     = room ? room.quotation_properties_rooms_id_fk : '';

                var roomQprId     = room ? room.quotation_properties_rooms_id : '';



                html += '<tr>';



                // Day + Destination cell (rowspan over all room rows for this day)

                if (!dayRendered) {

                    html += `

                        <td rowspan="${dayRowspan}" class="align-middle fw-semibold text-center">

                            <input type="hidden" class="hid_days_id" value="${day.quotation_properties_days_id}">

                            <input type="hidden" class="hid_confirmation_id" value="${dayConfId}">

                            ${escapeHtml(day.quotation_properties_days_day || '-')}

                        </td>

                        <td rowspan="${dayRowspan}" class="align-middle text-center">

                            <input type="hidden" class="hid_destination_id" value="${day.quotation_properties_days_destination_id_fk}">

                            ${escapeHtml(day.state_name || '-')}

                        </td>

                    `;

                    dayRendered = true;

                }



                // Property cell (rowspan over all room rows for this property)

                if (!propRendered) {

                    html += `

                        <td rowspan="${propRowspan}" class="align-middle">

                            <input type="hidden" class="hid_property_id" value="${property.properties_id_fk}">

                            ${escapeHtml(property.properties_name || '-')}

                        </td>

                    `;

                    propRendered = true;

                }



                // Room cell + hidden + checkbox

                html += `

                        <td class="align-middle">

                            <input type="hidden" class="hid_room_cat_id" value="${roomCatId}">

                            ${roomName}

                        </td>

                        <td class="text-center align-middle">

                            <input type="checkbox"

                                   class="form-check-input confirmationRoomCheck"

                                   data-days-id="${day.quotation_properties_days_id}"

                                   data-destination-id="${day.quotation_properties_days_destination_id_fk}"

                                   

                                   data-property-id="${property.quotation_properties_id}"
                                   data-room-id="${roomQprId}"

                                   data-qpr-id="${roomQprId}"

                                   data-confirmation-id="${dayConfId}"

                                   ${preCheck && dayRoomSaved && String(dayRoomSaved) === String(roomQprId) ? 'checked' : ''}>

                        </td>

                    </tr>

                `;

            });

        });

    });



    html += `

                </tbody>

            </table>

        </div>

        <div class="mt-3">

            <button type="button" class="btn btn-primary" id="btnSubmitConfirmation">

                <i class="fas fa-check-circle me-1"></i> Submit Confirmation

            </button>
            <button type="button" class="btn d-none" id="copyExportConfirmationBtn" style="
                background: linear-gradient(135deg, #11998e 0%, #38ef7d 100%);
                color: white;
                border: none;
                padding: 10px 20px;
                font-size: 14px;
                font-weight: 600;
                border-radius: 6px;
                margin-left: 10px;
                box-shadow: 0 4px 6px rgba(0,0,0,0.1);
                transition: all 0.3s ease;
            " onmouseover="this.style.transform='translateY(-2px)';this.style.boxShadow='0 6px 12px rgba(17, 153, 142, 0.4)';" onmouseout="this.style.transform='translateY(0)';this.style.boxShadow='0 4px 6px rgba(0,0,0,0.1)';">
                <i class="fas fa-file-export me-2"></i> View / Copy / Export Confirmation
            </button>

        </div>

        </form>

    `;



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



    $('#confirmationSubmitModal').modal('show');

});



$(document).on('click', '#btnConfirmSubmitYes', function () {

    $('#confirmationSubmitModal').modal('hide');



    var checked      = $('#confirmationDetailsTable .confirmationRoomCheck:checked');

    var quotation_id = $('#quotation_id').val();

    var option_id    = $('#confirmationOptionSelect').val();



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

                message : res.status ? 'Confirmation saved successfully.' : ('Failed to save confirmation. ' + (res.message || '')),

                icon    : res.status ? 'fas fa-check' : 'fas fa-times'

            });

            n.show(); setTimeout(function(){ n.hide(); }, 5000);

            // Show Copy/Export button on success
            if (res.status) {
                $('#copyExportConfirmationBtn')
                    .removeClass('d-none')
                    .data('quotation-id', quotation_id);
            }

        },

        error: function() {

            var n = new notify({ title: '', style: 'error', message: 'Server error while saving confirmation.', icon: 'fas fa-times' });

            n.show(); setTimeout(function(){ n.hide(); }, 5000);

        }

    });

});

// Copy/Export Confirmation Button Handler
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


// ===== Receipt Scheduler Hub Functions =====



var hub_schedulerTable = null;

var hub_save_method = 'add';

var hub_currentSchedulerId = null;



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
                            <button onclick="hub_add_scheduler()" class="btn btn-rounded btn-primary btn-sm">+ Create Payment Schedule</button>
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

            // Load scheduler
            if (!hub_schedulerTable) {

                hub_loadSchedulerTable(quotation_id);

            } else {

                hub_schedulerTable.ajax.reload();

            }

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

                html += '<button type="button" class="btn btn-info btn-sm me-1" onclick="hub_viewScheduler(' + row.receipt_scheduler_id + ')" title="View"><i class="fas fa-eye"></i></button>';

                html += '<button type="button" class="btn btn-warning btn-sm me-1" onclick="hub_editScheduler(' + row.receipt_scheduler_id + ')" title="Edit"><i class="fas fa-edit"></i></button>';

                html += '<button type="button" class="btn btn-danger btn-sm" onclick="hub_deleteScheduler(' + row.receipt_scheduler_id + ')" title="Delete"><i class="fas fa-trash"></i></button>';

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

function loadPropertyStatus(quotation_id)
{
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

            $('#hub_quotation_display').val($('#hubQuotationNumber').text() + ' - ' + $('#hubGuestName').text());

        }

    });



    $('#hub_schedulerModal').modal('show');

}



function hub_togglePaymentType() {

    var type = $('#hub_payment_type').val();

    if (type == 'FULL') {

        $('#hub_fullPaymentSection').show();

        $('#hub_emiSection').hide();

    } else if (type == 'EMI') {

        $('#hub_fullPaymentSection').hide();

        $('#hub_emiSection').show();

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



function hub_generateEmiRows() {

    var count = parseInt($('#hub_max_emi_count').val()) || 3;

    var totalAmount = parseFloat($('#hub_total_amount').val()) || 0;

    var splitType = $('#hub_split_type').val();

    var html = '';

    for (var i = 1; i <= count; i++) {

        var defaultValue = splitType == 'PERCENTAGE' ? (100 / count).toFixed(2) : (totalAmount / count).toFixed(2);

        html += '<tr><td class="text-center"><strong>EMI ' + i + '</strong></td><td>';

        if (splitType == 'PERCENTAGE') {

            html += '<input type="number" step="0.01" class="form-control form-control-sm hub-emi-percentage" name="emi_percentage[]" value="' + defaultValue + '" onchange="hub_calculateEmiTotal()">';

        } else {

            html += '<input type="number" step="0.01" class="form-control form-control-sm hub-emi-amount" name="emi_amount[]" value="' + defaultValue + '" onchange="hub_calculateEmiTotal()">';

        }

        html += '</td><td><input type="date" class="form-control form-control-sm" name="emi_due_date[]" required></td>';

        html += '<td class="hub-calculated-amount text-end">₹' + (splitType == 'PERCENTAGE' ? ((totalAmount * parseFloat(defaultValue)) / 100).toFixed(2) : defaultValue) + '</td></tr>';

    }

    $('#hub_emiTableBody').html(html);

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

                alert(response.message);

            } else {

                $('#hub_schedulerModal').modal('hide');

                hub_schedulerTable.ajax.reload();

                alert(response.message);

            }

        },

        error: function() {

            $('#hub_btnSave').prop('disabled', false).text('Save');

            alert('An error occurred. Please try again.');

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

            $('#hub_receipt_scheduler_id').val(scheduler.receipt_scheduler_id);

            $('#hub_quotation_id_fk').val(scheduler.quotation_id_fk);

            $('#hub_quotation_display').val(scheduler.quotation_number + ' - ' + scheduler.guest_name);

            $('#hub_total_amount').val(scheduler.total_amount);

            $('#hub_payment_type').val(scheduler.payment_type);

            $('#hub_receipt_scheduler_remarks').val(scheduler.receipt_scheduler_remarks);

            hub_togglePaymentType();

            if (scheduler.payment_type == 'FULL') {

                if (installments.length > 0) $('#hub_cutoff_date').val(installments[0].due_date);

            } else {

                $('#hub_max_emi_count').val(scheduler.max_emi_count);

                $('#hub_split_type').val(scheduler.split_type);

                hub_toggleSplitType();

                var html = '';

                for (var i = 0; i < installments.length; i++) {

                    var inst = installments[i];

                    html += '<tr><td class="text-center"><strong>EMI ' + inst.installment_number + '</strong></td><td>';

                    if (scheduler.split_type == 'PERCENTAGE') {

                        html += '<input type="number" step="0.01" class="form-control form-control-sm hub-emi-percentage" name="emi_percentage[]" value="' + (inst.installment_percentage || '') + '" onchange="hub_calculateEmiTotal()">';

                    } else {

                        html += '<input type="number" step="0.01" class="form-control form-control-sm hub-emi-amount" name="emi_amount[]" value="' + (inst.installment_amount || '') + '" onchange="hub_calculateEmiTotal()">';

                    }

                    html += '</td><td><input type="date" class="form-control form-control-sm" name="emi_due_date[]" value="' + inst.due_date + '" required></td>';

                    html += '<td class="hub-calculated-amount text-end">₹' + parseFloat(inst.calculated_amount).toFixed(2) + '</td></tr>';

                }

                $('#hub_emiTableBody').html(html);

                hub_calculateEmiTotal();

            }

            $('#hub_schedulerModalTitle').text('Edit Payment Schedule');

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

            if (!response || !response.scheduler) { alert('Unable to load payment details'); return; }

            var scheduler = response.scheduler;

            $('#hub_view_quotation_number').text(scheduler.quotation_number);

            $('#hub_view_guest_name').text(scheduler.guest_name);

            $('#hub_view_payment_type').html(scheduler.payment_type == 'FULL' ? '<span class="badge bg-primary">Full Payment</span>' : '<span class="badge bg-info">EMI</span>');

            $('#hub_view_total_amount').text('₹' + parseFloat(response.total_amount).toLocaleString('en-IN', { minimumFractionDigits: 2 }));

            $('#hub_view_paid_amount').text('₹' + parseFloat(response.total_paid).toLocaleString('en-IN', { minimumFractionDigits: 2 }));

            $('#hub_view_pending_amount').text('₹' + parseFloat(response.pending_amount).toLocaleString('en-IN', { minimumFractionDigits: 2 }));

            $('#hub_view_overdue_count').text(response.overdue_count);

            var html = '';

            var installments = response.installments;

            for (var i = 0; i < installments.length; i++) {

                var inst = installments[i];

                var statusClass = inst.payment_status == 'PAID' ? 'bg-success' : (inst.payment_status == 'PARTIAL' ? 'bg-warning' : (inst.payment_status == 'OVERDUE' ? 'bg-danger' : 'bg-secondary'));

                html += '<tr><td>' + inst.installment_number + '</td><td>' + hub_formatDate(inst.due_date) + '</td>';

                html += '<td>₹' + parseFloat(inst.calculated_amount).toLocaleString('en-IN', { minimumFractionDigits: 2 }) + '</td>';

                html += '<td>₹' + parseFloat(inst.paid_amount).toLocaleString('en-IN', { minimumFractionDigits: 2 }) + '</td>';

                html += '<td><span class="badge ' + statusClass + '">' + inst.payment_status + '</span></td><td>';

                if (inst.payment_status != 'PAID') {

                    var remaining = parseFloat(inst.calculated_amount) - parseFloat(inst.paid_amount);

                    html += '<button class="btn btn-success btn-xs" onclick="hub_recordPayment(' + inst.installment_id + ', ' + remaining.toFixed(2) + ')"><i class="fas fa-money-bill"></i> Pay</button>';

                }

                html += '</td></tr>';

            }

            $('#hub_viewInstallmentsBody').html(html);

            $('#hub_viewModal').modal('show');

        }

    });

}



function hub_recordPayment(installmentId, dueAmount) {

    $('#hub_payment_installment_id').val(installmentId);

    $('#hub_payment_due_amount').val('₹' + dueAmount.toFixed(2));

    $('#hub_payment_amount').val(dueAmount.toFixed(2));

    $('#hub_payment_date').val(new Date().toISOString().split('T')[0]);

    $('#hub_payment_method').val('');

    $('#hub_payment_reference').val('');

    $('#hub_payment_remarks').val('');

    $('#hub_paymentModal').modal('show');

}



function hub_savePayment() {

    var formData = $('#hub_paymentForm').serialize();

    $.ajax({

        url: "<?php echo base_url(); ?>index.php/Receipt_scheduler/record_payment",

        type: 'POST', data: formData, dataType: 'json',

        success: function(response) {

            if (response.error) {

                alert(response.message);

            } else {

                $('#hub_paymentModal').modal('hide');

                hub_viewScheduler(hub_currentSchedulerId);

                hub_schedulerTable.ajax.reload();

                alert(response.message);

            }

        }

    });

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

                alert(response.message);

            } else {

                hub_schedulerTable.ajax.reload();

                alert(response.message);

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

    if ($('#hub_payment_type').val() == 'EMI') hub_generateEmiRows();

});

$(document).on('click', '#copyPropertyReservationBtn', function () {
    var quotation_id = $('#quotation_id').val();

    if (!quotation_id) {
        alert('Quotation ID missing');
        return;
    }

    window.open(
        "<?php echo base_url(); ?>index.php/Quotation/property_reservation_preview/" + quotation_id,
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
            if (!res.status) { alert(res.message || 'Unable to load reservation'); return; }
            hubRenderReservation(res);
            $('#hubResModalContent').show();
        },
        error: function() {
            $('#hubResModalLoader').hide();
            alert('Failed to load reservation data.');
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
    $('#hub_info_property').text(propName);
    $('#hub_info_guest').text(r.guest_name || '-');
    $('#hub_info_booking').text(r.booking_number || '-');
    $('#hub_info_checkin').text(hubFormatDate(checkIn));
    $('#hub_info_checkout').text(hubFormatDate(checkOut));
    $('#hub_info_duration').text(nights + ' Night(s)');

    $('#hub_blocking_cnfm_by').val(r.blocking_cnfm_by || '');
    $('#hub_blocking_cutoff_date').val(r.blocking_cutoff_date || '');
    $('#hub_blocking_date').val(r.blocking_date || '');
    hubSetPill('#hub_pill_blocking', r.blocking_status, 'BLOCKED');

    $('#hub_confirmation_cnfm_by').val(r.confirmation_cnfm_by || '');
    $('#hub_confirmation_cnfm_no').val(r.confirmation_cnfm_no || '');
    $('#hub_confirmation_cnfm_date').val(r.confirmation_cnfm_date || '');
    hubSetPill('#hub_pill_confirm', r.confirmation_status, 'CONFIRMED');

    $('#hub_reconfirmation_cnfm_by').val(r.reconfirmation_cnfm_by || '');
    $('#hub_reconfirmation_cnfm_no').val(r.reconfirmation_cnfm_no || '');
    $('#hub_reconfirmation_date').val(r.reconfirmation_date || '');
    hubSetPill('#hub_pill_recon', r.reconfirmation_status, 'RECONFIRMED');

    var total = res.total_amount || 0;
    $('#hub_res_total_amount').val(total);
    $('#hub_payment_total_display').text(parseFloat(total).toLocaleString('en-IN'));
    $('input[name="hub_payment_type"]').prop('checked', false);
    $('#hub_res_fullSection').hide();
    $('#hub_res_emiSection').hide();
    $('#hub_res_emiTableBody').html('');

    if (res.payment) {
        var p = res.payment;
        $('#hub_res_total_amount').val(p.total_amount);
        $('#hub_payment_total_display').text(parseFloat(p.total_amount).toLocaleString('en-IN'));
        if (p.payment_type === 'FULL') {
            $('#hub_pt_full').prop('checked', true);
            hubTogglePaymentType();
            if (res.installments && res.installments.length > 0) {
                $('#hub_cutoff_date').val(res.installments[0].due_date);
            }
        } else if (p.payment_type === 'EMI') {
            $('#hub_pt_emi').prop('checked', true);
            $('#hub_res_max_emi_count').val(p.max_emi_count || 3);
            $('#hub_split_type_res').val(p.split_type || 'AMOUNT');
            hubTogglePaymentType();
            hubRenderEmiFromData(res.installments, p.split_type);
        }
    }

    hubRenderComments(res.comments || []);
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
    } else if (type === 'EMI') {
        $('#hub_res_fullSection').hide();
        $('#hub_res_emiSection').show();
        if ($('#hub_res_emiTableBody tr').length === 0) hubGenerateEmiRows();
    } else {
        $('#hub_res_fullSection').hide();
        $('#hub_res_emiSection').hide();
    }
}

function hubGenerateEmiRows() {
    var count = parseInt($('#hub_res_max_emi_count').val()) || 3;
    var total = parseFloat($('#hub_res_total_amount').val()) || 0;
    var split = $('#hub_split_type_res').val();
    $('#hub_res_emiValHeader').text(split === 'PERCENTAGE' ? 'Percentage (%)' : 'Amount');
    var html = '';
    for (var i = 1; i <= count; i++) {
        var def = split === 'PERCENTAGE' ? (100 / count).toFixed(2) : (total / count).toFixed(2);
        html += '<tr><td class="text-center">' + i + '</td><td>';
        if (split === 'PERCENTAGE') {
            html += '<input type="number" step="0.01" class="form-control form-control-sm hub-emi-percentage" name="emi_percentage[]" value="' + def + '" onchange="hubCalcEmiTotal()">';
        } else {
            html += '<input type="number" step="0.01" class="form-control form-control-sm hub-emi-amount" name="emi_amount[]" value="' + def + '" onchange="hubCalcEmiTotal()">';
        }
        html += '</td><td><input type="date" class="form-control form-control-sm" name="emi_due_date[]"></td><td class="hub-emi-calc text-end">0.00</td></tr>';
    }
    $('#hub_res_emiTableBody').html(html);
    hubCalcEmiTotal();
}

function hubRenderEmiFromData(installments, split) {
    if (!installments) return;
    $('#hub_res_emiValHeader').text(split === 'PERCENTAGE' ? 'Percentage (%)' : 'Amount');
    var html = '';
    for (var i = 0; i < installments.length; i++) {
        var inst = installments[i];
        html += '<tr><td class="text-center">' + inst.installment_number + '</td><td>';
        if (split === 'PERCENTAGE') {
            html += '<input type="number" step="0.01" class="form-control form-control-sm hub-emi-percentage" name="emi_percentage[]" value="' + (inst.installment_percentage || '') + '" onchange="hubCalcEmiTotal()">';
        } else {
            html += '<input type="number" step="0.01" class="form-control form-control-sm hub-emi-amount" name="emi_amount[]" value="' + (inst.installment_amount || '') + '" onchange="hubCalcEmiTotal()">';
        }
        html += '</td><td><input type="date" class="form-control form-control-sm" name="emi_due_date[]" value="' + (inst.due_date || '') + '"></td>';
        html += '<td class="hub-emi-calc text-end">' + parseFloat(inst.calculated_amount || 0).toFixed(2) + '</td></tr>';
    }
    $('#hub_res_emiTableBody').html(html);
    hubCalcEmiTotal();
}

function hubCalcEmiTotal() {
    var total = parseFloat($('#hub_res_total_amount').val()) || 0;
    var split = $('#hub_split_type_res').val();
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
    if (Math.abs(sum - total) > 0.01) {
        $('#hub_res_emiCalcTotal').addClass('text-danger');
    } else {
        $('#hub_res_emiCalcTotal').removeClass('text-danger');
    }
}

function hubSaveBlocking() {
    hubPostForm('property_reservation/save_blocking', '#hub_blockingForm', function() {
        hubReloadReservation();
    });
}

function hubSaveConfirmation() {
    var type = $('input[name="hub_payment_type"]:checked').val();
    if (!type) { alert('Please select payment terms'); return; }
    hubPostForm('property_reservation/save_confirmation', '#hub_confirmForm', function() {
        hubReloadReservation();
    });
}

function hubSaveReconfirmation() {
    hubPostForm('property_reservation/save_reconfirmation', '#hub_reconForm', function() {
        hubReloadReservation();
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
            if (res.error) { alert(res.message); return; }
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
    if (!id) { alert('Reservation not loaded'); return; }
    var data = $(formSel).serialize() + '&property_reservation_id=' + id;
    $.ajax({
        url: '<?php echo base_url(); ?>index.php/' + url,
        type: 'POST',
        data: data,
        dataType: 'json',
        success: function(res) {
            if (res.error) { alert(res.message); return; }
            if (onDone) onDone();
        },
        error: function() { alert('An error occurred. Please try again.'); }
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
            if (!res.status) { alert(res.message || 'Error'); return; }
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

$(document).on('click', '#btnPropertyVoucher', function () {

    var quotation_id = $('#quotation_id').val();

    if (!quotation_id) {
        alert('Quotation ID missing');
        return;
    }

    window.open(
        '<?php echo base_url(); ?>index.php/Quotation/property_voucher_preview/' + quotation_id,
        '_blank'
    );
});

$(document).on('click', '#btnTourVoucher', function () {

    var quotation_id = $('#quotation_id').val();

    if (!quotation_id) {
        alert('Quotation ID missing');
        return;
    }

    window.open(
        "<?php echo base_url(); ?>index.php/Quotation/tour_voucher_preview/" + quotation_id,
        "_blank"
    );
});

$(document).on('click', '#btnDriverItinerary', function () {
    var quotation_id = $('#quotation_id').val();

    if (!quotation_id) {
        alert('Quotation ID missing');
        return;
    }

    window.open(
        "<?php echo base_url(); ?>index.php/Quotation/driver_itinerary_preview/" + quotation_id,
        "_blank"
    );
});

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
    $('#fpHubTable tbody tr.fp-hotel-day').remove();
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
                if (defaults.hotel_days && defaults.hotel_days.length) {
                    defaults.hotel_days.forEach(function(day) {
                        fpAddHotelDay(day.day_label, day.day_cost, day.day_cost, '');
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

        if (d.hotel_days && d.hotel_days.length) {
            d.hotel_days.forEach(function(day) {
                fpAddHotelDay(day.fphd_day_label, day.fphd_quoted_amount, day.fphd_actual_amount, day.fphd_description);
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

function fpAddHotelDay(label, quoted, actual, desc) {
    label = label || '';
    quoted = (quoted !== undefined && quoted !== null) ? quoted : '';
    actual = (actual !== undefined && actual !== null) ? actual : '';
    desc = desc || '';

    var dayIndex = $('#fpHubTable tbody tr.fp-hotel-day').length + 1;
    var dayLabel = label || 'Day ' + dayIndex + ' hotel cost';

    var html = '<tr class="fp-hotel-day table-light fp-label">' +
        '<td class="fw-bold"><input type="text" class="form-control form-control-sm" name="hotel_labels[]" value="' + escapeHtml(dayLabel) + '"></td>' +
        '<td><input type="number" class="form-control form-control-sm fp-quoted" name="hotel_quoted[]" value="' + quoted + '" placeholder="0.00" min="0" step="0.01" readonly></td>' +
        '<td><input type="number" class="form-control form-control-sm fp-actual" name="hotel_actual[]" value="' + actual + '" placeholder="0.00" min="0" step="0.01"></td>' +
        '<td><input type="text" class="form-control form-control-sm" name="hotel_descs[]" value="' + escapeHtml(desc) + '" placeholder="Description"></td>' +
        '<td class="text-center"><button type="button" class="btn btn-sm btn-link text-danger" onclick="fpRemoveRow(this)"><i class="la la-trash"></i></button></td>' +
        '</tr>';

    var $lastHotel = $('#fpHubTable tbody tr.fp-hotel-day').last();
    if ($lastHotel.length) {
        $lastHotel.after(html);
    } else {
        $('#fpHotelDayHeader').after(html);
    }
    fpCalculate();
}

function fpAddExpense(label, amount, desc) {
    label = label || '';
    amount = (amount !== undefined && amount !== null) ? amount : '';
    desc = desc || '';

    var html = '<tr class="fp-expense table-light fp-label">' +
        '<td class="fw-bold"><input type="text" class="form-control form-control-sm" name="exp_labels[]" value="' + escapeHtml(label) + '" placeholder="Other expense"></td>' +
        '<td><input type="number" class="form-control form-control-sm fp-quoted" name="exp_quoted[]" value="" placeholder="0.00" min="0" step="0.01"></td>' +
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

    var totalMargin = margin + difference;
    $('#fpTotalMargin').text(totalMargin.toFixed(2));
    if (totalMargin > 0) {
        $('#fpTotalMargin').removeClass('text-danger text-muted').addClass('text-white')
            .css($.extend({}, badgeStyle, {'background':'#198754'}));
    } else if (totalMargin < 0) {
        $('#fpTotalMargin').removeClass('text-success text-muted').addClass('text-white')
            .css($.extend({}, badgeStyle, {'background':'#dc3545'}));
    } else {
        $('#fpTotalMargin').removeClass('text-success text-danger').addClass('text-white')
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
        hotel_labels: [],
        hotel_quoted: [],
        hotel_actual: [],
        hotel_descs: [],
        exp_labels: [],
        exp_amounts: [],
        exp_descs: []
    };

    $('#fpHubTable tr.fp-hotel-day').each(function() {
        payload.hotel_labels.push($(this).find('[name="hotel_labels[]"]').val() || '');
        payload.hotel_quoted.push(parseFloat($(this).find('[name="hotel_quoted[]"]').val()) || 0);
        payload.hotel_actual.push(parseFloat($(this).find('[name="hotel_actual[]"]').val()) || 0);
        payload.hotel_descs.push($(this).find('[name="hotel_descs[]"]').val() || '');
    });

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
</script>