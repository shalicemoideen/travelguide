<script>

var selectedCampaigns = {};

$(document).ready(function() {
    loadShiftBlocks();
});

function formatTime12Hour(timeStr)
{
    if (!timeStr) return '';

    let parts = timeStr.split(':');
    let hour = parseInt(parts[0], 10);
    let minute = parts[1];
    let ampm = hour >= 12 ? 'PM' : 'AM';

    hour = hour % 12;
    hour = hour ? hour : 12;

    if (minute === '00') {
        return hour + ' ' + ampm;
    }

    return hour + ':' + minute + ' ' + ampm;
}

// function bindCampaignChange()
// {
//     $('.campaign-dropdown').off('change').on('change', function() {
//         let shift_id = $(this).data('shift-id');
//         let campaign_id = $(this).val();

//         selectedCampaigns[shift_id] = campaign_id;

//         if (campaign_id == '') {
//             $('#staff_sortable_' + shift_id).html('<div class="text-muted">Please select campaign</div>');
//             return;
//         }

//         loadStaffList(shift_id, campaign_id);
//     });
// }

function bindCampaignChange()
{
    $('.campaign-dropdown').off('select2:select').on('select2:select', function(e) {
        let $this = $(this);
        let shift_id = String($this.data('shift-id'));
        let campaign_id = e.params.data.id;

        // keep selected value in memory
        selectedCampaigns[shift_id] = campaign_id;

        // also keep selected value in element attribute
        $this.attr('data-selected-campaign', campaign_id);

        loadStaffList(shift_id, campaign_id);
    });

    $('.campaign-dropdown').off('select2:unselect').on('select2:unselect', function(e) {
        let $this = $(this);
        let shift_id = String($this.data('shift-id'));

        // clear selected value from memory
        selectedCampaigns[shift_id] = '';

        // clear selected value from element attribute
        $this.attr('data-selected-campaign', '');

        $('#staff_sortable_' + shift_id).html('<div class="text-muted">Please select campaign</div>');
    });
}

// function loadShiftBlocks()
// {
//     $.ajax({
//         url: "<?php echo base_url(); ?>index.php/Staff_order_assign/ajax_get_all_shifts",
//         type: "GET",
//         dataType: "JSON",
//         success: function(shifts) {

//             $.ajax({
//                 url: "<?php echo base_url(); ?>index.php/Staff_order_assign/ajax_get_all_campaigns",
//                 type: "GET",
//                 dataType: "JSON",
//                 success: function(campaigns) {

//                     let html = '';

//                     $.each(shifts, function(index, shift) {

//                         let shiftTitle = formatTime12Hour(shift.shift_start_time) + ' to ' + formatTime12Hour(shift.shift_end_time);

//                         let campaignOptions = '<option value="">Please select campaign</option>';

//                         $.each(campaigns, function(i, camp) {
//                             let selected = (String(selectedCampaigns[shift.shift_id]) === String(camp.meta_ads_setting_id)) ? 'selected' : '';

//                             campaignOptions += '<option value="' + camp.meta_ads_setting_id + '" ' + selected + '>'
//                                 + camp.meta_ads_setting_name + ' - ' + camp.facebook_form_id + '</option>';
//                         });

//                         html += `
//                             <div class="col-xl-6 col-lg-6 mb-4">
//                                 <div class="card">
//                                     <div class="card-header">
//                                         <h4 class="card-title">${shiftTitle}</h4>
//                                     </div>
//                                     <div class="card-body">
//                                         <div class="basic-form">
//                                             <div class="form-group mb-3">
//                                                 <label>Select Campaign</label>
//                                                 <select class="form-control campaign-dropdown shift-campaign-select"
//                                                         data-shift-id="${shift.shift_id}"
//                                                         id="campaign_ads_id_${shift.shift_id}">
//                                                     ${campaignOptions}
//                                                 </select>
//                                             </div>

//                                             <div class="staff-list-wrapper">
//                                                 <div class="staff-sortable-list"
//                                                      id="staff_sortable_${shift.shift_id}"
//                                                      data-shift-id="${shift.shift_id}">
//                                                     <div class="text-muted">Please select campaign</div>
//                                                 </div>
//                                             </div>
//                                         </div>
//                                     </div>
//                                 </div>
//                             </div>
//                         `;
//                     });

//                     $('#shiftBlocksContainer').html(html);

//                     $('.shift-campaign-select').select2({
//                         width: '100%',
//                         placeholder: 'Please select campaign'
//                     });

//                     $('.campaign-dropdown').each(function() {
//                         let shift_id = $(this).data('shift-id');
//                         if (selectedCampaigns[shift_id]) {
//                             $(this).val(selectedCampaigns[shift_id]).trigger('change.select2');
//                         }
//                     });

//                     bindCampaignChange();

//                     $.each(selectedCampaigns, function(shift_id, campaign_id) {
//                         if (campaign_id) {
//                             loadStaffList(shift_id, campaign_id);
//                         }
//                     });
//                 }
//             });
//         }
//     });
// }

function loadShiftBlocks()
{
    $.ajax({
        url: "<?php echo base_url(); ?>index.php/Staff_order_assign/ajax_get_all_shifts",
        type: "GET",
        dataType: "JSON",
        success: function(shifts) {

            $.ajax({
                url: "<?php echo base_url(); ?>index.php/Staff_order_assign/ajax_get_all_campaigns",
                type: "GET",
                dataType: "JSON",
                success: function(campaigns) {

                    let html = '';

                    $.each(shifts, function(index, shift) {

                        let shiftTitle = formatTime12Hour(shift.shift_start_time) + ' to ' + formatTime12Hour(shift.shift_end_time);

                        let campaignOptions = '<option value="">Please select campaign</option>';

                        $.each(campaigns, function(i, camp) {
                            let shiftKey = String(shift.shift_id);
                            let campKey = String(camp.meta_ads_setting_id);
                            let selected = (String(selectedCampaigns[shiftKey] || '') === campKey) ? 'selected' : '';

                            campaignOptions += '<option value="' + campKey + '" ' + selected + '>'
                                + camp.meta_ads_setting_name + ' - ' + camp.facebook_form_id + '</option>';
                        });

                        html += `
                            <div class="col-xl-6 col-lg-6 mb-4">
                                <div class="card">
                                    <div class="card-header">
                                        <h4 class="card-title">${shiftTitle}</h4>
                                    </div>
                                    <div class="card-body">
                                        <div class="basic-form">
                                            <div class="form-group mb-3">
                                                <label>Select Campaign</label>
                                                <select class="form-control campaign-dropdown shift-campaign-select"
                                                        data-shift-id="${shift.shift_id}"
                                                        data-selected-campaign="${selectedCampaigns[String(shift.shift_id)] || ''}"
                                                        id="campaign_ads_id_${shift.shift_id}">
                                                    ${campaignOptions}
                                                </select>
                                            </div>

                                            <div class="staff-list-wrapper">
                                                <div class="staff-sortable-list"
                                                     id="staff_sortable_${shift.shift_id}"
                                                     data-shift-id="${shift.shift_id}">
                                                    <div class="text-muted">Please select campaign</div>
                                                </div>
                                            </div>
                                        </div>
                                    </div>
                                </div>
                            </div>
                        `;
                    });

                    $('#shiftBlocksContainer').html(html);

                    // Initialize Select2 - it will automatically pick up the selected option from the HTML
                    $('.shift-campaign-select').select2({
                        width: '100%',
                        placeholder: 'Please select campaign',
                        dropdownParent: $(document.body)
                    });

                    bindCampaignChange();

                    $.each(selectedCampaigns, function(shift_id, campaign_id) {
                        if (campaign_id) {
                            loadStaffList(shift_id, campaign_id);
                        }
                    });
                }
            });
        }
    });
}

function loadStaffList(shift_id, campaign_id)
{
    $.ajax({
        url: "<?php echo base_url(); ?>index.php/Staff_order_assign/ajax_get_staff_order_by_shift_campaign",
        type: "POST",
        dataType: "JSON",
        data: {
            shift_id: shift_id,
            campaign_id: campaign_id
        },
        success: function(response) {

            let html = '';

            if (response.length > 0) {
                $.each(response, function(index, staff) {
                    html += `
                        <div class="staff-item card mb-2 p-3"
                             data-staff-order-assign-id="${staff.staff_order_assign_id}">
                            <div class="d-flex justify-content-between align-items-center">
                                <div>
                                    <strong>${staff.staff_order}. ${staff.admin_name}</strong><br>
                                    <small>Staff ID: ${staff.staff_id_fk}</small>
                                </div>
                                <div class="drag-handle" style="cursor:move;">
                                    <i class="fa fa-bars"></i>
                                </div>
                            </div>
                        </div>
                    `;
                });
            } else {
                html = '<div class="text-danger">No staff found for this shift and campaign</div>';
            }

            $('#staff_sortable_' + shift_id).html(html);

            makeSortable(shift_id, campaign_id);
        }
    });
}

function makeSortable(shift_id, campaign_id)
{
    $('#staff_sortable_' + shift_id).sortable({
        placeholder: "ui-state-highlight",
        handle: ".drag-handle",
        update: function(event, ui) {
            saveNewStaffOrder(shift_id, campaign_id);
        }
    });
}

function saveNewStaffOrder(shift_id, campaign_id)
{
    let order_data = [];

    $('#staff_sortable_' + shift_id + ' .staff-item').each(function(index) {
        order_data.push({
            staff_order_assign_id: $(this).data('staff-order-assign-id'),
            staff_order: index + 1
        });

        // update display number immediately in UI
        let currentName = $(this).find('strong').text();
    });

    $.ajax({
        url: "<?php echo base_url(); ?>index.php/Staff_order_assign/ajax_update_staff_order",
        type: "POST",
        dataType: "JSON",
        data: {
            order_data: order_data
        },
        success: function(res) {
        if (res.status) {
            loadStaffList(shift_id, campaign_id);

            if (typeof toastr !== 'undefined') {
                toastr.success('Updated successfully');
            } else {
                alert('Updated successfully');
            }
        } else {
            if (typeof toastr !== 'undefined') {
                toastr.error('Failed to update order');
            } else {
                alert('Failed to update order');
            }
        }
    }
    });
}
</script>