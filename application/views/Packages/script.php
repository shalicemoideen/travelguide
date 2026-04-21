
<script type="text/javascript">

////***Filter button hide and show*****///

$(document).ready(function () {
    $("#btn").click(function () {
        $("#Create").toggle();
    });
});

$(document).ready(function () {
    $("#btn1").click(function () {
        $("#Create1").toggle();
    });
});

$(document).ready(function () {
    $("#btn2").click(function () {
        $("#Create2").toggle();
    });
});


////***Filter button hide and show*****///

////***searching button*****///

$('#search').click(function () {
        
        $table.ajax.reload();
    });

$('#search1').click(function () {
        
        $table1.ajax.reload();
    });

$('#search2').click(function () {
        
        $table2.ajax.reload();
    });

$( "#packages_duration_in_nights_filter" ).keypress(function() {
            $table.ajax.reload();
});

////***searching button*****///

////***Listing table*****///

var save_method; //for save method string
var table;
  $(document).ready(function() {
    
    
    $table = $('#Package_registration').DataTable( {
        "processing": true,
        "serverSide": true,
        "searching": false,
        "aLengthMenu": [[10, 25, 50, -1], [10, 25, 50, "All"]],
        // "bDestroy" : true,
        dom: 'lBfrtip',
            buttons: [
                
                                {
                                    extend: 'excel',
                                    exportOptions: {
                                        columns: [0, 1, 2, 3, 4, 5]
                                    }
                                },
                                {
                                    extend: 'pdf',
                                    exportOptions: {
                                        columns: [0, 1, 2, 3, 4, 5]
                                    }
                                },
                                {
                                    extend: 'print',
                                    exportOptions: {
                                        columns: [0 ,1, 2, 3, 4, 5]
                                    }
                                },
                               
            ],
        "ajax": {
            "url": "<?php echo base_url();?>index.php/Packages/get/",
            "type": "POST",
            "data" : function (d) {
                        d.packages_title_filter = $("#packages_title_filter").val();
                        d.packages_category_id_filter = $("#packages_category_id_filter").val();
                        d.packages_itinerary_category_id_filter = $("#packages_itinerary_category_id_filter").val();
                        d.packages_itinerary_id_filter = $("#packages_itinerary_id_filter").val();
                        d.packages_duration_in_nights_filter = $("#packages_duration_in_nights_filter").val();
                        d.packages_createdby_user_id = $("#packages_createdby_user_id").val();
           }            
        },
        // "ajax": {
            // "url": "<?php echo site_url('States/get')?>",
            // "type": "POST"
        // },
        "createdRow": function ( row, data, index ) {
          
//            $('td',row).eq(0).html(index+1);
           $table.column(0).nodes().each(function(node,index,dt){
            $table.cell(node).data(index+1);
            });
            
            
            $('td', row).eq(7).html('<div class="dropdown ms-auto text-end"><div class="btn-link" data-bs-toggle="dropdown"><svg width="24px" height="24px" viewBox="0 0 24 24" version="1.1"><g stroke="none" stroke-width="1" fill="none" fill-rule="evenodd"><rect x="0" y="0" width="24" height="24"></rect><circle fill="#000000" cx="5" cy="12" r="2"></circle><circle fill="#000000" cx="12" cy="12" r="2"></circle><circle fill="#000000" cx="19" cy="12" r="2"></circle></g></svg></div><div class="dropdown-menu dropdown-menu-end"><a class="dropdown-item" href="javascript:void(0)" id="rt" onclick="edit_package('+data['packages_id']+')">Edit</a><a class="dropdown-item" href="javascript:void(0)" onclick="edit_package('+data['packages_id']+', \'duplicate\')">Duplicate</a><a class="dropdown-item" target="_blank" href="<?php echo base_url();?>index.php/Packages/preview_direct/'+data['packages_id']+'" >Preview</a><a class="dropdown-item" href="javascript:void(0)" onclick="return delete_package('+data['packages_id']+')">Delete</a></div></div>');

            
            
           },

           "drawCallback": function( settings ) {
                // displaySelectByUserType();
            },

        "columns": [
            { "data": "packages_status", "orderable": false },
            { "data": "packages_title", "orderable": false },
            { "data": "package_category_name", "orderable": false },
            { "data": "packages_duration_in_nights", "orderable": false },
            { "data": "itinerary_category_name", "orderable": false },
            { "data": "itineraries_name", "orderable": false },
            { "data": "packages_createdby_user_name", "orderable": false },                      
            { "data": "packages_id", "orderable": false }
            
            
        ]
        
    });
    
  

  });
    
 
////***Listing table*****///

////***For open modal of room tariff adding form  *****///
    
function add_packages()
{ 
    save_method = 'add';
    $("#id").val('');
    $('#form')[0].reset(); // reset form on modals
    $('.form-group').removeClass('input-warning-o'); // clear error class
    $('.help-block').empty(); // clear error string
    $('#PackagesModal').modal('show'); // show bootstrap modal
    $('.modal-title').text('Create Template Details'); // Set Title to Bootstrap modal title
    $('#btnSave').text('save');
}

////***For open modal of room tariff adding form  *****///

////***For reset package modal  *****///

function resetPackageModal() {

  // reset form
  $('#form')[0].reset();

  // clear select2
  $('#packages_category_id_fk, #packages_itinerary_category_id_fk, #packages_itinerary_id_fk')
    .val('').trigger('change');

  // clear itinerary table + hidden inputs
  $('#itinerary').html('');

  // uncheck all feature checkboxes
  $('#packages_inclusion_exclusion_checked_type').prop('checked', false).trigger('change');
  $('#packages_optional_add_on_checked_type').prop('checked', false).trigger('change');
  // $('#packages_special_requirment_checked_type').prop('checked', false).trigger('change');
  $('#packages_payment_policies_checked_type').prop('checked', false).trigger('change');
  $('#packages_terms_conditions_checked_type').prop('checked', false).trigger('change');
  $('#packages_cancellation_policy_checked_type').prop('checked', false).trigger('change');
  $('#packages_notes_checked_type').prop('checked', false).trigger('change');
  // $('#packages_property_checked_type').prop('checked', false).trigger('change');
  $('#packages_property_type').prop('checked', false).trigger('change');

  // clear dynamic blocks
  $('#inclusion').html('');
  $('#exclusion').html('');
  $('#optional-addon').find('.optional-addon-row').remove();
  $('#special-requirments').find('.special-row').remove();
  $('#payment-policies').find('.payment-row').remove();
  $('#terms-conditions').find('.terms-row').remove();
  $('#cancellation-policy').find('.cancellation-row').remove();
  $('#add_notes').find('.note-row').remove();
  $('#property').html('');
}

// when modal opens fresh for add
$('#PackagesModal').on('show.bs.modal', function () {
  if (window.save_method === 'add') resetPackageModal();
});

// optional: always reset when closing
// $('#PackagesModal').on('hidden.bs.modal', function () {
//   resetPackageModal();
// });

$('#PackagesModal').on('hide.bs.modal', function () {
  suppressPropertyClearConfirm = true;
});

$('#PackagesModal').on('hidden.bs.modal', function () {
  setTimeout(function () {
    suppressPropertyClearConfirm = false;
  }, 200);
});

function resetPropertiesBlock() {
  $('#packages_property_type').prop('checked', false);
  $('input[name="packages_property_checked_type"]').val('');
  $('#property').empty().hide();
  $('[onClick="addMore10();"]').closest('.terms_add, .mb-3').hide();

  if (typeof window.resetPropertySections === 'function') {
    window.resetPropertySections();
  }
}
////***For reset package modal  *****///

////***For open modal for edit  *****///


window.isPropertyPrefill = false;   // prevents change handler from interfering during edit
window.isEditLoading = false;       // you already use this

window.dayEditors = window.dayEditors || {};

window.destroyDayEditors = function () {
  if (!window.dayEditors) window.dayEditors = {};
  Object.keys(window.dayEditors).forEach(function (k) {
    try {
      var ed = window.dayEditors[k];
      if (ed && ed.destroy) ed.destroy();
    } catch (e) {}
  });
  window.dayEditors = {};
};

window.initEditorsForDays = function () {
  window.destroyDayEditors();

  // ✅ wait 1 tick so DOM rows are fully inserted
  setTimeout(function () {
    $('.day-editor').each(function () {
      const textarea = this;
      const rowNum = $(this).closest('tr').data('row-num');

      // If ClassicEditor is not loaded, you will see plain textarea
      if (typeof ClassicEditor === 'undefined') {
        console.error('ClassicEditor not loaded!');
        return;
      }

      ClassicEditor.create(textarea).then(editor => {
        window.dayEditors[rowNum] = editor;
      }).catch(err => console.error(err));
    });
  }, 0);
};

window.destinationMap = window.destinationMap || null;

window.loadDestinationMap = function (done) {
  if (window.destinationMap) {
    if (typeof done === 'function') done(window.destinationMap);
    return;
  }

  $.getJSON('<?php echo base_url(); ?>index.php/Packages/gettdestination_details', function (res) {
    const map = {};
    (res || []).forEach(function (r) {
      map[String(r.state_id)] = r.state_name;
    });
    window.destinationMap = map;
    if (typeof done === 'function') done(map);
  }).fail(function () {
    window.destinationMap = {};
    if (typeof done === 'function') done({});
  });
};


window.isPropertyEditBuild = false;

window.loadItinerariesByCategoryDuration = function(done){

  const $duration  = $('#packages_duration_in_nights');
  const $cat       = $('#packages_itinerary_category_id_fk');
  const $itinerary = $('#packages_itinerary_id_fk');

  const nights = $.trim($duration.val());
  const catId  = $.trim($cat.val());

  $itinerary.html('<option value="">Please Select itinerary</option>');

  if (!catId || !nights) {
    if ($itinerary.hasClass('select2-hidden-accessible')) $itinerary.trigger('change.select2');
    if (typeof done === 'function') done(false);
    return;
  }

  $itinerary.html('<option value="">Loading...</option>');
  if ($itinerary.hasClass('select2-hidden-accessible')) $itinerary.trigger('change.select2');

  $.ajax({
    url: '<?php echo base_url(); ?>index.php/Packages/fetch_itinerary_under_category', // ✅ correct
    type: 'POST',
    data: {
      packages_itinerary_category_id_fk: catId,     // ✅ correct
      packages_duration_in_nights: nights           // ✅ correct
    },
    success: function(html){
      $itinerary.html(html);

      // refresh select2
      if ($itinerary.hasClass('select2-hidden-accessible')) {
        $itinerary.trigger('change.select2');
      } else {
        $itinerary.trigger('change');
      }

      if (typeof done === 'function') done(true);
    },
    error: function(){
      $itinerary.html('<option value="">Please Select itinerary</option>');
      if ($itinerary.hasClass('select2-hidden-accessible')) $itinerary.trigger('change.select2');
      if (typeof done === 'function') done(false);
    }
  });
};

// $(document).on('change', '.tb-required-checkbox', function () {
//   var $row = $(this).closest('tr');
//   $row.find('.tb-required-status').val($(this).is(':checked') ? '1' : '2');
// });

// $(document).on('change', '.tb-required-checkbox', function () {

//     const $row = $(this).closest('tr');

//     const val = $(this).is(':checked') ? '1' : '2';

//     $row.find('.required-status-hidden').val(val);

// });

// $(document).on('change', '.tb-required-checkbox', function () {
//     var $row = $(this).closest('tr');
//     var val = $(this).is(':checked') ? '1' : '2';
//     $row.find('.tb-required-status').val(val);

//     // keep row attribute updated for validation/property section
//     $row.attr('data-required-status', val);
// });

// $(document).on('change', '.tb-required-checkbox', function () {
//     var $row = $(this).closest('tr');
//     var val = $(this).is(':checked') ? '1' : '2';

//     $row.find('.tb-required-status').val(val);
//     $row.attr('data-required-status', val);

//     var dayId = String($row.find('input[name="itineraries_days_id_fk[]"]').val() || '');
//     if (dayId) {
//       $('#property tr.day-row[data-day-id="' + dayId + '"]').attr('data-required-status', val);
//     }
// });

$(document).on('change', '.tb-required-checkbox', function () {
  var $itineraryRow = $(this).closest('tr');
  var val = $(this).is(':checked') ? '1' : '2';

  $itineraryRow.find('.tb-required-status').val(val);
  $itineraryRow.attr('data-required-status', val);

  var dayId = String($itineraryRow.find('input[name="itineraries_days_id_fk[]"]').val() || '');
  if (!dayId) return;

  $('#property .day-row[data-day-id="' + dayId + '"]').each(function(){
    $(this).attr('data-required-status', val);

    $(this).find('.assignment-row').each(function(){
      var $propSel = $(this).find('.property-select');
      var $roomSel = $(this).find('.rooms-select');

      if (val === '1') {
        $propSel.attr('required', 'required');
        $roomSel.attr('required', 'required');
      } else {
        $propSel.removeAttr('required');
        $roomSel.removeAttr('required');
      }
    });
  });
});

function buildItineraryRowsFromSaved(itineraryDays) {

  const tbody = $('#itinerary');

  destroyDayEditors();     // your existing function
  tbody.empty();

  if (!itineraryDays || !itineraryDays.length) {
    tbody.append(`<tr><td colspan="6" class="text-center text-danger">No saved itinerary days found</td></tr>`);
    return;
  }

  itineraryDays.forEach(function (item, i) {

    const rowNum = i + 1;

    const isTB = (item.packages_itineraries_days_travel_back === 'TB');

    const tbBadge = isTB
      ? ` <span class="badge bg-warning text-dark ms-2">Travel Back</span>`
      : '';

    // destination name might not exist in your saved table - fallback to ID
    const destName = item.state_name || item.packages_itineraries_days_destination_name || item.packages_itineraries_days_destination_id_fk || '';

    // day image preview
    const imgFile = item.packages_itineraries_days_image || '';
    const imgUrl  = imgFile
      ? `<?php echo base_url('uploads/package_day_images/'); ?>${imgFile}`
      : '';

    const imgHtml = imgUrl
      ? `<img src="${imgUrl}" class="day-thumb" alt="Day Image">`
      : `<div class="text-muted small">No image</div>`;

    

    const requiredStatus = parseInt(item.packages_itineraries_days_required_status || 0, 10);
    let requiredStatusHtml = '';

    if (isTB) {
      requiredStatusHtml = `
        <div class="mt-2 tb-required-wrap">
          <label class="form-check-label" style="font-size:13px;">
            <input type="checkbox"
                  class="form-check-input tb-required-checkbox"
                  ${requiredStatus === 2 ? '' : 'checked'}>
            Property / Room Required
          </label>
          <input type="hidden"
                name="packages_itineraries_days_required_status[]"
                class="tb-required-status"
                value="${requiredStatus === 2 ? 2 : 1}">
        </div>
      `;
    } else {
      requiredStatusHtml = `
        <input type="hidden"
              name="packages_itineraries_days_required_status[]"
              class="tb-required-status"
              value="0">
      `;
    }
    tbody.append(`
      <tr data-row-num="${rowNum}" data-required-status="${isTB ? (requiredStatus === 2 ? 2 : 1) : 0}">
        <td>
          <div>
            <b>${item.packages_itineraries_days_day || ('Day ' + rowNum)}</b>
            | ${item.packages_itineraries_days_title || ''}
            ${tbBadge}
          </div>

          <input type="hidden" name="is_travel_back[]" class="is-travel-back" value="${isTB ? '1' : '0'}">

          <input type="hidden"
                name="packages_itineraries_days_travel_back[]"
                class="pkg-travel-back"
                value="${isTB ? 'TB' : ''}">

          ${requiredStatusHtml}
        </td>

        <td class="stay-destination-cell">
  <span class="stay-destination-text">${item.state_name || ''}</span>
  <input type="hidden" class="active-destination-id" value="${item.packages_itineraries_days_destination_id_fk || ''}">
  <input type="hidden" class="active-destination-name" value="${item.state_name || ''}">
</td>

        <td>
          <textarea
            name="packages_itineraries_days_description[]"
            class="form-control day-editor"
            id="day_editor_${rowNum}"
            rows="6">${item.packages_itineraries_days_description || ''}</textarea>

          <!-- Needed for saving -->
          <input type="hidden" name="itineraries_days_id_fk[]" value="${item.itineraries_days_id_fk || ''}">
          <input type="hidden" name="packages_itineraries_days_day[]" value="${item.packages_itineraries_days_day || ''}">
          <input type="hidden" name="packages_itineraries_days_title[]" value="${item.packages_itineraries_days_title || ''}">

          <!-- IMPORTANT: this is the posted destination array -->
          <input type="hidden"
                 name="packages_itineraries_days_destination_id_fk[]"
                 class="destination-post"
                 value="${item.packages_itineraries_days_destination_id_fk || ''}">

          <!-- keep old image if no new upload -->
          <input type="hidden" name="default_itinerary_day_image[]" value="${imgFile}">
        </td>

        <td>
          ${imgHtml}
          <div class="mt-2">
            <input type="file"
                   class="form-control form-control-sm day-image-input"
                   name="packages_itineraries_days_image_file[]"
                   accept="image/*">
          </div>
        </td>

        <td>
          <select class="form-control change_destination" style="width:100%;">
            <option value="">Please Select Destination</option>
          </select>
        </td>

        <td class="position-relative">
          <select class="form-control change_itinerary mb-2" data-row-num="${rowNum}" style="width:100%;" data-loaded="0">
            <option value="">Please Select Itinerary</option>
          </select>

          <select class="form-control change_itinerary_day" data-row-num="${rowNum}" style="width:100%;">
            <option value="">Please Select Days</option>
          </select>

          <div class="day-description-tooltip" id="tooltip_${rowNum}">
            <div class="tooltip-content"></div>
          </div>
        </td>
      </tr>
    `);
  });

  // ✅ Init select2 (same as your normal load)
  $('.change_destination').select2({ width: '100%' });
  $('.change_itinerary').select2({ width: '100%' });
  $('.change_itinerary_day').select2({ width: '100%' });

  // ✅ Load dropdown options
  if (typeof loadChangeDestinations === 'function') loadChangeDestinations();
  if (typeof loadRowWiseItineraries === 'function') loadRowWiseItineraries();

  // ✅ Init CKEditor
  if (typeof initEditorsForDays === 'function') initEditorsForDays();

  // ✅ Update stay destination names from master list
loadDestinationMap(function(map){
  $('#itinerary tr').each(function(){
    const $tr = $(this);
    const id = String($tr.find('.active-destination-id').val() || '');
    if (!id) return;

    const name = map[id] || id;

    $tr.find('.stay-destination-text').text(name);
    $tr.find('.active-destination-name').val(name);
  });
});

// ✅ if property checkbox was checked during edit load, open now
// if (window.pendingPropertyOpen && typeof window.openPropertyUI === 'function') {
//   window.pendingPropertyOpen = false;
//   window.openPropertyUI();
// }
}

// function buildSavedPropertyUI(propertyData) {
//   if (!propertyData || !propertyData.length) return;

//   // keep checked, do not trigger change (change will wipe)
//   $('#packages_property_type').prop('checked', true);

//   // open UI without clearing again
//   $('input[name="packages_property_checked_type"]').val('Y');
//   $('#property').show();
//   $('[onClick="addMore10();"]').closest('.terms_add, .mb-3').show();

//   // clear sections
//   $('#property').empty();
//   window.sectionCount = 0;
  

//   $.each(propertyData, function(_, sec){

//     // create section skeleton (this calls getDaysFromItinerary and builds day rows)
//     addMore10();

//     var $section   = $('#property .property-section').last();
//     var sectionId  = $section.data('section');

//     // set category name
//     $section.find('input[name^="property_category_name"]').val(
//       sec.packages_properties_common_category_name || ''
//     );
// // alert(sec.packages_properties_common_category_name);
//     $section.find('select[name^="packages_properties_common_design_type"]')
//     .val(sec.packages_properties_common_design_type)
//     .trigger('change');

//     // days
//     $.each(sec.days || [], function(_, dayObj){

//       var dayKey = String(dayObj.itineraries_days_id_fk || '');
//       var destId = String(dayObj.destination_id || '');

//       if (!dayKey) return;

//       var $dayRow = $section.find('tr.day-row[data-day-id="' + dayKey + '"]');
//       if (!$dayRow.length) return;

//       var dayKey = String(dayObj.itineraries_days_id_fk || '');
//       var $dayRow = $section.find('tr.day-row[data-day-id="'+dayKey+'"]');

//       if (!$dayRow.length && dayObj.day_index) {
//         $dayRow = $section.find('tr.day-row[data-day-index="'+dayObj.day_index+'"]');
//       }

//       if (!$dayRow.length) {
//         console.log('NO dayRow found for', dayObj);
//         return;
//       }

//       // update hidden destination
//       $dayRow.find('input[name^="property_destination_id"]').val(destId);
//       $dayRow.find('.assignments').attr('data-dest-id', destId);

//       // remove auto-created default assignment row
//       $dayRow.find('.assignment-row').remove();



//       $dayRow.find('.assignment-row').remove();

// $.each(dayObj.properties || [], function(idx, p){
//   addAssignmentRowD($dayRow, sectionId, dayKey, destId, (idx===0), ($dayRow.data('is-tb')==1));

//   var $assign  = $dayRow.find('.assignment-row').last();
//   var $propSel = $assign.find('.property-select');
//   var $roomSel = $assign.find('.rooms-select');

//   setPropertyAndRoomsFromSavedD(destId, $propSel, $roomSel, p.property_id, p.rooms);
// });
//     });

//   });
// }

window.loadChangeDestinations = function () {

  loadDestinationMap(function(map){

    $('.change_destination').each(function () {
      const $select = $(this);

      // if already filled, skip
      if ($select.data('filled') == 1) return;

      $select.empty().append('<option value="">Please Select Destination</option>');

      Object.keys(map).forEach(function(id){
        $select.append(`<option value="${id}">${map[id]}</option>`);
      });

      // re-init select2 safely
      if ($select.hasClass('select2-hidden-accessible')) {
        $select.trigger('change.select2');
      }

      $select.data('filled', 1);
    });

  });
};

window.loadRowWiseItineraries = function () {

  $('.change_itinerary').each(function () {

    const $itinerarySelect = $(this);

    // stop if already loaded
    if ($itinerarySelect.data('loaded') == 1) return;

    $itinerarySelect.html('<option value="">Loading...</option>');

    $.ajax({
      url: '<?php echo base_url(); ?>index.php/Packages/fetch_itinerary',
      type: 'POST',
      dataType: 'json',
      success: function (res) {

        $itinerarySelect.html('<option value="">Please Select Itinerary</option>');

        (res || []).forEach(function (rowData) {
          $itinerarySelect.append(`
            <option value="${rowData.itineraries_id}">
              ${rowData.itineraries_name}
            </option>
          `);
        });

        $itinerarySelect.data('loaded', 1);

        if ($itinerarySelect.hasClass('select2-hidden-accessible')) {
          $itinerarySelect.trigger('change.select2');
        }
      },
      error: function () {
        $itinerarySelect.html('<option value="">Please Select Itinerary</option>');
      }
    });

  });
};
// function edit_package(id, mode) {

//   // window.save_method = 'update';
//   mode = mode || 'update';
//   window.save_method = (mode === 'duplicate') ? 'add' : 'update';

//   // IMPORTANT: reset modal ONLY for duplicate, not for update
//   // (optional) if you want fresh dynamic UI
//   if (mode === 'duplicate') {
//     resetPackageModal();
//   }
  

//   // (Recommended) reset then keep update mode
//   // resetPackageModal();  // uncomment if you want clean start before fill

//   $.ajax({
//     url: "<?php echo base_url(); ?>index.php/Packages/ajax_edit/" + id,
//     type: "GET",
//     dataType: "json",
//     success: function (res) {

//       if (!res.status) {
//         alert(res.message || 'Failed to load package');
//         return;
//       }

//       const p = res.package;

//       // ✅ Open modal first (so select2 + DOM exist)
//       $('#PackagesModal').modal('show');
//        // ✅ Set ID only for UPDATE
//       if (mode === 'update') {
//         $('#packages_id').val(p.packages_id);
//         $('#btnSave').text('Update');
//         $('#PackagesModal .modal-title').text('Edit Package');
//       } else {
//         // ✅ DUPLICATE: clear ID so it inserts new
//         $('#packages_id').val('');
//         $('#btnSave').text('Save');
//         $('#PackagesModal .modal-title').text('Duplicate Package');
//       }

//       // master fields
//       $('#packages_title').val(p.packages_title);
//       $('#packages_duration_in_nights').val(p.packages_duration_in_nights);

//       // select2 dropdowns
//       $('#packages_category_id_fk').val(p.packages_category_id_fk).trigger('change');
//       $('#packages_itinerary_category_id_fk').val(p.packages_itinerary_category_id_fk).trigger('change');

//       /* ================================
//         LOAD COVER PAGE IMAGES
//       ================================ */

//       if (p.packages_first_cover_page) {

//           $('#packages_first_cover_page_txt').val(p.packages_first_cover_page);

//           $('#first_cover_preview').html(
//               '<img src="<?php echo base_url("uploads/packages_cover/"); ?>' +
//               p.packages_first_cover_page +
//               '" style="width:120px;border:1px solid #ddd;padding:3px;">'
//           );

//           $('#packages_first_cover_page').prop('required', false);

//       } else {

//           $('#first_cover_preview').html('');
//           $('#packages_first_cover_page').prop('required', true);
//       }


//       if (p.packages_last_cover_page) {

//           $('#packages_last_cover_page_txt').val(p.packages_last_cover_page);

//           $('#last_cover_preview').html(
//               '<img src="<?php echo base_url("uploads/packages_cover/"); ?>' +
//               p.packages_last_cover_page +
//               '" style="width:120px;border:1px solid #ddd;padding:3px;">'
//           );

//           $('#packages_last_cover_page').prop('required', false);

//       } else {

//           $('#last_cover_preview').html('');
//           $('#packages_last_cover_page').prop('required', true);
//       }
//       /* ==========================================================
//          1) Load itineraries dropdown first (category + duration)
//          then set itinerary id
//          ========================================================== */

       

//     window.isEditLoading = true;
      
// loadItinerariesByCategoryDuration(function(ok){

//   $('#packages_itinerary_id_fk').val(p.packages_itinerary_id_fk);

//   if ($('#packages_itinerary_id_fk').hasClass('select2-hidden-accessible')) {
//     $('#packages_itinerary_id_fk').trigger('change.select2');
//   }

//   if (res.itinerary_days && res.itinerary_days.length) {
//     buildItineraryRowsFromSaved(res.itinerary_days);
//   }

//   // ✅ VERY IMPORTANT: wait a little so itinerary DOM fully exists
//   setTimeout(function () {

//     if (p.packages_property_checked_type === 'Y') {
//       $('#packages_property_type').prop('checked', true);
//       buildSavedPropertyUI(res.property_data || []);
//     }

//     window.isEditLoading = false;

//   }, 300);
// });
//       /* ==========================================================
//          2) After itinerary table built -> fill saved days description
//          ========================================================== */
//       setTimeout(function () {

//         if (res.itinerary_days && res.itinerary_days.length) {

//           $('#itinerary tr').each(function (i) {

//             const saved = res.itinerary_days[i];
//             if (!saved) return;

//             $(this).find('.day-content-display')
//               .html(saved.packages_itineraries_days_description || '');

//             $(this).find('.hidden-day-description')
//               .val(saved.packages_itineraries_days_description || '');
//           });
//         }

//       }, 1400);

//       /* ==========================================================
//          3) INCLUSION / EXCLUSION
//          ========================================================== */
//       if (p.packages_inclusion_exclusion_checked_type === 'Y') {

//         $('#packages_inclusion_exclusion_checked_type')
//           .prop('checked', true)
//           .trigger('change');

//         $('#packages_inclusion_exclusion_common_id_fk')
//           .val(p.packages_inclusion_exclusion_common_id_fk)
//           .trigger('change');

//         setTimeout(function () {

//           $('#inclusion').empty();
//           $('#exclusion').empty();

//           (res.inclusions || []).forEach(function (row) {
//             $('#inclusion').append(`
//               <div class="d-flex gap-2 mb-2 inclusion-row align-items-start">
//                 <textarea class="form-control" name="packages_inclusions_details[]" rows="3">${row.packages_inclusions_details || ''}</textarea>
//                 <button type="button" class="btn btn-sm btn-danger remove-row"><b>X</b></button>
//               </div>
//             `);
//           });

//           (res.exclusions || []).forEach(function (row) {
//             $('#exclusion').append(`
//               <div class="d-flex gap-2 mb-2 exclusion-row align-items-start">
//                 <textarea class="form-control" name="packages_exclusions_details[]" rows="3">${row.packages_exclusions_details || ''}</textarea>
//                 <button type="button" class="btn btn-sm btn-danger remove-row"><b>X</b></button>
//               </div>
//             `);
//           });

//         }, 600);
//       }

//       /* ==========================================================
//          4) OPTIONAL ADDONS
//          ========================================================== */
//       if (p.packages_optional_add_on_checked_type === 'Y') {

//         $('#packages_optional_add_on_checked_type')
//           .prop('checked', true)
//           .trigger('change');

//         const $box = $('#optional-addon');
//         $box.find('.optional-addon-row').remove();

//         (res.optional_addons || []).forEach(function (r) {
//           $box.find('.mb-3.col-md-6').first().before(`
//             <div class="d-flex gap-2 mb-2 optional-addon-row align-items-start">
//               <textarea name="packages_optional_add_on_details[]" class="form-control" rows="3">${r.packages_optional_add_on_details || ''}</textarea>
//               <button type="button" class="btn btn-sm btn-danger remove-optional-addon"><b>X</b></button>
//             </div>
//           `);
//         });
//       }

//       /* ==========================================================
//          5) SPECIAL REQUIREMENTS
//          ========================================================== */
//       // if (p.packages_special_requirment_checked_type === 'Y') {

//       //   $('#packages_special_requirment_checked_type')
//       //     .prop('checked', true)
//       //     .trigger('change');

//       //   $('#special-requirments').find('.special-row').remove();

//       //   (res.special_requirements || []).forEach(function (r) {
//       //     addMore4();
//       //     const $last = $('#special-requirments').find('.special-row').last();
//       //     $last.find('.special-select').val(r.special_requirements_id_fk).trigger('change');
//       //     $last.find('.special-amount').val(r.packages_special_requirements_cost || '');
//       //   });
//       // }

//       /* ==========================================================
//          6) PAYMENT POLICIES
//          ========================================================== */
//       if (p.packages_payment_policies_checked_type === 'Y') {

//         $('#packages_payment_policies_checked_type')
//           .prop('checked', true)
//           .trigger('change');

//         $('#payment_policies_id_fk').val(p.payment_policies_id_fk).trigger('change');

//         setTimeout(function () {

//           $('#payment-policies').find('.payment-row').remove();

//           (res.payment_policies || []).forEach(function (r) {
//             $('#payment-policies').find('.payment_add').first().before(`
//               <div class="d-flex gap-2 mb-2 payment-row align-items-start">
//                 <textarea class="form-control" name="packages_payment_policies_details[]" rows="3">${r.packages_payment_policies_details || ''}</textarea>
//                 <button type="button" class="btn btn-sm btn-danger remove-payment"><b>X</b></button>
//               </div>
//             `);
//           });

//         }, 600);
//       }

//       /* ==========================================================
//          7) TERMS
//          ========================================================== */
//       if (p.packages_terms_conditions_checked_type === 'Y') {

//         $('#packages_terms_conditions_checked_type')
//           .prop('checked', true)
//           .trigger('change');

//         $('#terms_condition_id_fk').val(p.terms_condition_id_fk).trigger('change');

//         setTimeout(function () {

//           $('#terms-conditions').find('.terms-row').remove();

//           (res.terms || []).forEach(function (r) {
//             $('#terms-conditions').find('.terms_add').first().before(`
//               <div class="d-flex gap-2 mb-2 terms-row align-items-start">
//                 <textarea class="form-control" name="packages_terms_condition_details[]" rows="3">${r.packages_terms_condition_details || ''}</textarea>
//                 <button type="button" class="btn btn-sm btn-danger remove-terms"><b>X</b></button>
//               </div>
//             `);
//           });

//         }, 600);
//       }

//       /* ==========================================================
//          8) CANCELLATION
//          ========================================================== */
//       if (p.packages_cancellation_policy_checked_type === 'Y') {

//         $('#packages_cancellation_policy_checked_type')
//           .prop('checked', true)
//           .trigger('change');

//         $('#cancellation_policies_id_fk').val(p.cancellation_policies_id_fk).trigger('change');

//         setTimeout(function () {

//           $('#cancellation-policy').find('.cancellation-row').remove();

//           (res.cancellation || []).forEach(function (r) {
//             $('#cancellation-policy').find('.terms_add').first().before(`
//               <div class="d-flex gap-2 mb-2 cancellation-row align-items-start">
//                 <textarea class="form-control" name="packages_cancellation_policies_details[]" rows="3">${r.packages_cancellation_policies_details || ''}</textarea>
//                 <button type="button" class="btn btn-sm btn-danger remove-cancellation"><b>X</b></button>
//               </div>
//             `);
//           });

//         }, 600);
//       }

//       /* ==========================================================
//          9) NOTES
//          ========================================================== */
//       if (p.packages_notes_checked_type === 'Y') {

//         $('#packages_notes_checked_type')
//           .prop('checked', true)
//           .trigger('change');

//         $('#add_notes').find('.note-row').remove();

//         (res.notes || []).forEach(function (r) {

//           $('#add_notes').find('.mb-3.col-md-6').first().before(`
//             <div class="d-flex gap-2 mb-2 note-row align-items-start">
//               <textarea class="form-control" name="packages_notes_details[]" rows="3">${r.packages_notes_details || ''}</textarea>
//               <button type="button" class="btn btn-sm btn-danger remove-note"><b>X</b></button>
//             </div>
//           `);

//         });
//       }

//       /* ==========================================================
//          10) PROPERTIES (FIXED)
//          - wait for itinerary table
//          - trigger checkbox AFTER table built
//          - create sections
//          - set category name correctly (name^ selector)
//          - wait for property options and room options before selecting
//          ========================================================== */




//     },
//     error: function () {
//       alert('Failed to load edit data');
//     }
//   });
// }

function edit_package(id, mode) {
  mode = mode || 'update';
  window.save_method = (mode === 'duplicate') ? 'add' : 'update';

  // always reset first for stable edit load
  resetPackageModal();

  $.ajax({
    url: "<?php echo base_url(); ?>index.php/Packages/ajax_edit/" + id,
    type: "GET",
    dataType: "json",
    success: function (res) {

      if (!res.status) {
        alert(res.message || 'Failed to load package');
        return;
      }

      const p = res.package || {};

      $('#PackagesModal').modal('show');

      if (mode === 'update') {
        $('#packages_id').val(p.packages_id);
        $('#btnSave').text('Update');
        $('#PackagesModal .modal-title').text('Edit Package');
      } else {
        $('#packages_id').val('');
        $('#btnSave').text('Save');
        $('#PackagesModal .modal-title').text('Duplicate Package');
      }

      // master fields
      $('#packages_title').val(p.packages_title || '');
      $('#packages_duration_in_nights').val(p.packages_duration_in_nights || '');

      // cover previews
      if (p.packages_first_cover_page) {
        $('#packages_first_cover_page_txt').val(p.packages_first_cover_page);
        $('#first_cover_preview').html(
          '<img src="<?php echo base_url("uploads/packages_cover/"); ?>' +
          p.packages_first_cover_page +
          '" style="width:120px;border:1px solid #ddd;padding:3px;">'
        );
        $('#packages_first_cover_page').prop('required', false);
      } else {
        $('#packages_first_cover_page_txt').val('');
        $('#first_cover_preview').html('');
        $('#packages_first_cover_page').prop('required', true);
      }

      if (p.packages_last_cover_page) {
        $('#packages_last_cover_page_txt').val(p.packages_last_cover_page);
        $('#last_cover_preview').html(
          '<img src="<?php echo base_url("uploads/packages_cover/"); ?>' +
          p.packages_last_cover_page +
          '" style="width:120px;border:1px solid #ddd;padding:3px;">'
        );
        $('#packages_last_cover_page').prop('required', false);
      } else {
        $('#packages_last_cover_page_txt').val('');
        $('#last_cover_preview').html('');
        $('#packages_last_cover_page').prop('required', true);
      }

      window.isEditLoading = true;
      window.isPropertyPrefill = true;
      window.pendingPropertyOpen = false;

      // set fixed dropdown first
      $('#packages_category_id_fk').val(p.packages_category_id_fk || '').trigger('change.select2');
      $('#packages_itinerary_category_id_fk').val(p.packages_itinerary_category_id_fk || '').trigger('change.select2');

      // load itinerary dropdown options based on category + duration
      loadItinerariesByCategoryDuration(function(ok){

        if (!ok) {
          window.isEditLoading = false;
          window.isPropertyPrefill = false;
          alert('Failed to load itinerary list');
          return;
        }

        // set itinerary dropdown AFTER options are loaded
        $('#packages_itinerary_id_fk').val(String(p.packages_itinerary_id_fk || ''));

        if ($('#packages_itinerary_id_fk').hasClass('select2-hidden-accessible')) {
          $('#packages_itinerary_id_fk').trigger('change.select2');
        }

        // DO NOT trigger normal change here during edit
        // build rows directly from saved data
        buildItineraryRowsFromSaved(res.itinerary_days || []);

        // now build property block only after itinerary rows exist
        setTimeout(function () {

          if (p.packages_property_checked_type === 'Y') {
            $('#packages_property_type').prop('checked', true);
            $('input[name="packages_property_checked_type"]').val('Y');
            buildSavedPropertyUI(res.property_data || []);
          }

          window.isEditLoading = false;

        }, 300);
      });

      // inclusion / exclusion
      if (p.packages_inclusion_exclusion_checked_type === 'Y') {
        $('#packages_inclusion_exclusion_checked_type').prop('checked', true).trigger('change');
        $('#packages_inclusion_exclusion_common_id_fk').val(p.packages_inclusion_exclusion_common_id_fk || '').trigger('change');

        setTimeout(function () {
          $('#inclusion').empty();
          $('#exclusion').empty();

          (res.inclusions || []).forEach(function (row) {
            $('#inclusion').append(`
              <div class="d-flex gap-2 mb-2 inclusion-row align-items-start">
                <textarea class="form-control" name="packages_inclusions_details[]" rows="3">${row.packages_inclusions_details || ''}</textarea>
                <button type="button" class="btn btn-sm btn-danger remove-row"><b>X</b></button>
              </div>
            `);
          });

          (res.exclusions || []).forEach(function (row) {
            $('#exclusion').append(`
              <div class="d-flex gap-2 mb-2 exclusion-row align-items-start">
                <textarea class="form-control" name="packages_exclusions_details[]" rows="3">${row.packages_exclusions_details || ''}</textarea>
                <button type="button" class="btn btn-sm btn-danger remove-row"><b>X</b></button>
              </div>
            `);
          });
        }, 300);
      }

      if (p.packages_optional_add_on_checked_type === 'Y') {
        $('#packages_optional_add_on_checked_type').prop('checked', true).trigger('change');
        const $box = $('#optional-addon');
        $box.find('.optional-addon-row').remove();

        (res.optional_addons || []).forEach(function (r) {
          $box.find('.mb-3.col-md-6').first().before(`
            <div class="d-flex gap-2 mb-2 optional-addon-row align-items-start">
              <textarea name="packages_optional_add_on_details[]" class="form-control" rows="3">${r.packages_optional_add_on_details || ''}</textarea>
              <button type="button" class="btn btn-sm btn-danger remove-optional-addon"><b>X</b></button>
            </div>
          `);
        });
      }

      if (p.packages_payment_policies_checked_type === 'Y') {
        $('#packages_payment_policies_checked_type').prop('checked', true).trigger('change');
        $('#payment_policies_id_fk').val(p.payment_policies_id_fk || '').trigger('change');

        setTimeout(function () {
          $('#payment-policies').find('.payment-row').remove();
          (res.payment_policies || []).forEach(function (r) {
            $('#payment-policies').find('.payment_add').first().before(`
              <div class="d-flex gap-2 mb-2 payment-row align-items-start">
                <textarea class="form-control" name="packages_payment_policies_details[]" rows="3">${r.packages_payment_policies_details || ''}</textarea>
                <button type="button" class="btn btn-sm btn-danger remove-payment"><b>X</b></button>
              </div>
            `);
          });
        }, 300);
      }

      if (p.packages_terms_conditions_checked_type === 'Y') {
        $('#packages_terms_conditions_checked_type').prop('checked', true).trigger('change');
        $('#terms_condition_id_fk').val(p.terms_condition_id_fk || '').trigger('change');

        setTimeout(function () {
          $('#terms-conditions').find('.terms-row').remove();
          (res.terms || []).forEach(function (r) {
            $('#terms-conditions').find('.terms_add').first().before(`
              <div class="d-flex gap-2 mb-2 terms-row align-items-start">
                <textarea class="form-control" name="packages_terms_condition_details[]" rows="3">${r.packages_terms_condition_details || ''}</textarea>
                <button type="button" class="btn btn-sm btn-danger remove-terms"><b>X</b></button>
              </div>
            `);
          });
        }, 300);
      }

      if (p.packages_cancellation_policy_checked_type === 'Y') {
        $('#packages_cancellation_policy_checked_type').prop('checked', true).trigger('change');
        $('#cancellation_policies_id_fk').val(p.cancellation_policies_id_fk || '').trigger('change');

        setTimeout(function () {
          $('#cancellation-policy').find('.cancellation-row').remove();
          (res.cancellation || []).forEach(function (r) {
            $('#cancellation-policy').find('.terms_add').first().before(`
              <div class="d-flex gap-2 mb-2 cancellation-row align-items-start">
                <textarea class="form-control" name="packages_cancellation_policies_details[]" rows="3">${r.packages_cancellation_policies_details || ''}</textarea>
                <button type="button" class="btn btn-sm btn-danger remove-cancellation"><b>X</b></button>
              </div>
            `);
          });
        }, 300);
      }

      if (p.packages_notes_checked_type === 'Y') {
        $('#packages_notes_checked_type').prop('checked', true).trigger('change');
        $('#add_notes').find('.note-row').remove();

        (res.notes || []).forEach(function (r) {
          $('#add_notes').find('.mb-3.col-md-6').first().before(`
            <div class="d-flex gap-2 mb-2 note-row align-items-start">
              <textarea class="form-control" name="packages_notes_details[]" rows="3">${r.packages_notes_details || ''}</textarea>
              <button type="button" class="btn btn-sm btn-danger remove-note"><b>X</b></button>
            </div>
          `);
        });
      }
    },
    error: function () {
      alert('Failed to load edit data');
    }
  });
}
////***For open modal for edit  *****///


///***For save the package details from adding modal form *****///

/* ==========================================================
   SIMPLE BOOTSTRAP STYLE ERROR HELPERS
   ========================================================== */
function clearValidationErrors() {
  $('.is-invalid').removeClass('is-invalid');
  $('.js-err').remove();
}

function setInvalid($el, msg) {
  $el.addClass('is-invalid');

  // put message after input/select/textarea
  const $msg = $('<div class="text-danger small js-err mt-1"></div>').text(msg);

  // if element already has a message, replace it
  if ($el.next('.js-err').length) {
    $el.next('.js-err').replaceWith($msg);
  } else {
    $el.after($msg);
  }
}

function scrollToFirstError() {
  const $first = $('.is-invalid').first();
  if ($first.length) {
    $('html, body').animate({ scrollTop: $first.offset().top - 120 }, 300);
  }
}

function isEmpty(val) {
  return val === null || val === undefined || String(val).trim() === '';
}

/* ==========================================================
   VALIDATION MAIN FUNCTION
   return true => OK submit
   return false => stop submit
   ========================================================== */
function validatePackageForm() {

  clearValidationErrors();
  let ok = true;

  /* ==========================================================
     1) MAIN REQUIRED FIELDS
     ========================================================== */
  const $pkgTitle   = $('[name="packages_title"]');
  const $duration   = $('[name="packages_duration_in_nights"]');
  const $pkgCat     = $('[name="packages_category_id_fk"]');
  const $itCat      = $('[name="packages_itinerary_category_id_fk"]');
  const $itinerary  = $('[name="packages_itinerary_id_fk"]');

  if (isEmpty($pkgTitle.val())) { ok = false; setInvalid($pkgTitle, 'Package title is required'); }
  if (isEmpty($duration.val())) { ok = false; setInvalid($duration, 'Duration (nights) is required'); }
  if (isEmpty($pkgCat.val()))   { ok = false; setInvalid($pkgCat, 'Package category is required'); }
  if (isEmpty($itCat.val()))    { ok = false; setInvalid($itCat, 'Itinerary category is required'); }
  if (isEmpty($itinerary.val())){ ok = false; setInvalid($itinerary, 'Itinerary is required'); }

  /* ==========================================================
     2-3) INCLUSIONS / EXCLUSIONS
     checkbox checked -> must have at least 1 textarea in each
     and none can be empty
     ========================================================== */
  const $incChk = $('#packages_inclusion_exclusion_checked_type');
  if ($incChk.is(':checked')) {

    const $incAreas = $('#inclusion textarea');
    const $excAreas = $('#exclusion textarea');

    // Must open at least one in each OR loaded from dropdown
    if ($incAreas.length === 0) {
      ok = false;
      setInvalid($('#packages_inclusion_exclusion_common_id_fk'), 'Add at least one Inclusion (use +Add new or select a title)');
    }
    if ($excAreas.length === 0) {
      ok = false;
      setInvalid($('#packages_inclusion_exclusion_common_id_fk'), 'Add at least one Exclusion (use +Add new or select a title)');
    }

    // Required: any textarea empty => invalid
    $incAreas.each(function () {
      if (isEmpty($(this).val())) { ok = false; setInvalid($(this), 'Inclusion cannot be empty'); }
    });
    $excAreas.each(function () {
      if (isEmpty($(this).val())) { ok = false; setInvalid($(this), 'Exclusion cannot be empty'); }
    });
  }

  /* ==========================================================
     4-5) OPTIONAL ADD ON
     checkbox checked -> must have at least 1 textarea
     and none can be empty
     ========================================================== */
  const $optChk = $('#packages_optional_add_on_checked_type');
  if ($optChk.is(':checked')) {

    // change selector below if your container id differs
    const $optAreas = $('#optional-addon textarea[name="packages_optional_add_on_details[]"], #optional-addon textarea');

    if ($optAreas.length === 0) {
      ok = false;
      setInvalid($optChk, 'Add at least one Optional add on');
    }

    $optAreas.each(function () {
      if (isEmpty($(this).val())) { ok = false; setInvalid($(this), 'Optional add on cannot be empty'); }
    });
  }

  /* ==========================================================
     6-7) SPECIAL REQUIREMENT
     checkbox checked -> must have at least 1 row
     validate select + amount (both required)
     ========================================================== */
  // const $spChk = $('#packages_special_requirment_checked_type');
  // if ($spChk.is(':checked')) {

  //   const $spRows = $('#special-requirments .special-row');
  //   if ($spRows.length === 0) {
  //     ok = false;
  //     setInvalid($spChk, 'Add at least one Special requirement');
  //   }

  //   // validate each row
  //   $spRows.each(function () {
  //     const $sel = $(this).find('select[name="special_requirements_id_fk[]"]');
  //     const $amt = $(this).find('input[name="packages_special_requirements_cost[]"]');

  //     if ($sel.length && isEmpty($sel.val())) { ok = false; setInvalid($sel, 'Select a special requirement'); }
  //     if ($amt.length && isEmpty($amt.val())) { ok = false; setInvalid($amt, 'Amount is required'); }
  //   });
  // }

  /* ==========================================================
     8-9) PAYMENT POLICIES
     checkbox checked -> must have at least 1 textarea
     and none empty
     ========================================================== */
  const $payChk = $('#packages_payment_policies_checked_type');
  if ($payChk.is(':checked')) {

    // container: #payment-policies
    const $payAreas = $('#payment-policies textarea');

    if ($payAreas.length === 0) {
      ok = false;
      setInvalid($('#payment_policies_id_fk'), 'Add at least one Payment policy item (+Add new or select a title)');
    }

    $payAreas.each(function () {
      if (isEmpty($(this).val())) { ok = false; setInvalid($(this), 'Payment policy cannot be empty'); }
    });
  }

  /* ==========================================================
     10-11) TERMS & CONDITIONS
     checkbox checked -> must have at least 1 textarea
     and none empty
     ========================================================== */
  const $tcChk = $('#packages_terms_conditions_checked_type');
  if ($tcChk.is(':checked')) {

    const $tcAreas = $('#terms-conditions textarea');

    if ($tcAreas.length === 0) {
      ok = false;
      setInvalid($('#terms_condition_id_fk'), 'Add at least one Terms & condition item (+Add new or select a title)');
    }

    $tcAreas.each(function () {
      if (isEmpty($(this).val())) { ok = false; setInvalid($(this), 'Terms & condition cannot be empty'); }
    });
  }

  /* ==========================================================
     12-13) CANCELLATION POLICY
     checkbox checked -> must have at least 1 textarea
     and none empty
     ========================================================== */
  const $canChk = $('#packages_cancellation_policy_checked_type');
  if ($canChk.is(':checked')) {

    const $canAreas = $('#cancellation-policy textarea');

    if ($canAreas.length === 0) {
      ok = false;
      setInvalid($('#cancellation_policies_id_fk'), 'Add at least one Cancellation policy item (+Add new or select a title)');
    }

    $canAreas.each(function () {
      if (isEmpty($(this).val())) { ok = false; setInvalid($(this), 'Cancellation policy cannot be empty'); }
    });
  }

  /* ==========================================================
     14-15) NOTES
     checkbox checked -> must have at least 1 textarea
     and none empty
     ========================================================== */
  const $notesChk = $('#packages_notes_checked_type');
  if ($notesChk.is(':checked')) {

    const $noteAreas = $('#add_notes textarea');

    if ($noteAreas.length === 0) {
      ok = false;
      setInvalid($notesChk, 'Add at least one Note');
    }

    $noteAreas.each(function () {
      if (isEmpty($(this).val())) { ok = false; setInvalid($(this), 'Note cannot be empty'); }
    });
  }

  /* ==========================================================
     16) PROPERTIES (dynamic)
     checkbox checked -> validate:
       - at least one section exists
       - category name required
       - each assignment row: property required
       - each assignment row: rooms must have at least 1 selected
     ========================================================== */

  const $propChk = $('#packages_property_type');
  if ($propChk.is(':checked')) {

    const $sections = $('#property .property-section');

    if ($sections.length === 0) {
      ok = false;
      setInvalid($propChk, 'Add at least one Property section');
    }

    $sections.each(function () {

      const $sec = $(this);

      const $cat = $sec.find('input[name^="property_category_name"]');
      if ($cat.length && isEmpty($cat.val())) {
        ok = false;
        setInvalid($cat, 'Category name is required');
      }

      const $designType = $sec.find('select[name^="packages_properties_common_design_type"]');
      if ($designType.length && isEmpty($designType.val())) {
        ok = false;
        setInvalid($designType, 'Design Type is required');
      }

      $sec.find('tr.day-row').each(function () {

        const $dayRow = $(this);
        const isTB = ($dayRow.data('is-tb') == 1);
        const requiredStatus = String($dayRow.attr('data-required-status') || '0');

        if (isTB && requiredStatus === '2') {
          return true;
        }

        $dayRow.find('.assignment-row').each(function () {

          const $row = $(this);
          const $propSel = $row.find('select.property-select');
          const $roomsSel = $row.find('select.rooms-select');

          const propVal = $propSel.val();
          const roomsVal = $roomsSel.val();

          if (isEmpty(propVal)) {
            ok = false;
            setInvalid($propSel, 'Select a property');
            return;
          }

          if (!roomsVal || roomsVal.length === 0) {
            ok = false;
            setInvalid($roomsSel, 'Select at least one room');
          }
        });
      });
    });
  }
  if (!ok) scrollToFirstError();
  return ok;
}

const $propChk = $('#packages_property_type');
if ($propChk.is(':checked')) {

  const $sections = $('#property .property-section');

  if ($sections.length === 0) {
    ok = false;
    setInvalid($propChk, 'Add at least one Property section');
  }

  $sections.each(function () {

    const $sec = $(this);

    const $cat = $sec.find('input[name^="property_category_name"]');
    if ($cat.length && isEmpty($cat.val())) {
      ok = false;
      setInvalid($cat, 'Category name is required');
    }

    const $designType = $sec.find('select[name^="packages_properties_common_design_type"]');
    if ($designType.length && isEmpty($designType.val())) {
      ok = false;
      setInvalid($designType, 'Design Type is required');
    }

    $sec.find('tr.day-row').each(function () {

      const $dayRow = $(this);
      const isTB = ($dayRow.data('is-tb') == 1);
      const requiredStatus = String($dayRow.attr('data-required-status') || '0');

      if (isTB && requiredStatus === '2') {
        return true;
      }

      $dayRow.find('.assignment-row').each(function () {

        const $row = $(this);
        const $propSel = $row.find('select.property-select');
        const $roomsSel = $row.find('select.rooms-select');

        const propVal = $propSel.val();
        const roomsVal = $roomsSel.val();

        if (isEmpty(propVal)) {
          ok = false;
          setInvalid($propSel, 'Select a property');
          return;
        }

        if (!roomsVal || roomsVal.length === 0) {
          ok = false;
          setInvalid($roomsSel, 'Select at least one room');
        }
      });
    });
  });
}

// $('#PackagesModal').on('shown.bs.modal', function () {
//   resetPackageModal();
// });



function syncDayEditorsToTextarea() {
  if (!window.dayEditors) return;

  Object.keys(window.dayEditors).forEach(function(rowNum){
    const editor = window.dayEditors[rowNum];
    const $tr = $('#itinerary tr[data-row-num="'+rowNum+'"]');
    const $ta = $tr.find('textarea.day-editor');

    if (editor && $ta.length) {
      $ta.val(editor.getData()); // ✅ write editor html into textarea
    }
  });
}

window.dayEditors = {};   // {rowNum: editorInstance}



// function save() {

//   //   // ✅ stop submit if invalid
//   if (!validatePackageForm()) {
//     return;
//   }
//   let url = "";

//   if (save_method === 'add') {
//     url = "<?php echo base_url();?>index.php/Packages/ajax_add/";
//     $('#btnSave').text('Saving...');
//   } else {
//     url = "<?php echo base_url();?>index.php/Packages/ajax_update/";
//     $('#btnSave').text('Updating...');
//   }

//   $('#btnSave').attr('disabled', true);

//   syncDayEditorsToTextarea(); // ✅ VERY IMPORTANT

//   var form = document.getElementById('form');
//   var data = new FormData(form);

//   $.ajax({
//     url: url,
//     type: "POST",
//     data: data,
//     dataType: "JSON",
//     processData: false,
//     contentType: false,
//     success: function(res) {

//       if (res.status) {

//         $('#PackagesModal').modal('hide');
//         resetPackageModal();
//         reload_table();

//       } else {
//         alert(res.message || 'Validation failed');
//       }

//       $('#btnSave').text('Save');
//       $('#btnSave').attr('disabled', false);
//     },
//     error: function() {
//       alert('Error saving data');
//       $('#btnSave').text('Save');
//       $('#btnSave').attr('disabled', false);
//     }
//   });
// }

function save() {

  if (!validatePackageForm()) {
    return;
  }

  let url = "";

  if (save_method === 'add') {
    url = "<?php echo base_url();?>index.php/Packages/ajax_add/";
    $('#btnSave').text('Saving...');
  } else {
    url = "<?php echo base_url();?>index.php/Packages/ajax_update/";
    $('#btnSave').text('Updating...');
  }

  $('#btnSave').attr('disabled', true);

  syncDayEditorsToTextarea();

  // ✅ prevent confirm popup while saving/resetting
  suppressPropertyClearConfirm = true;

  var form = document.getElementById('form');
  var data = new FormData(form);

  $.ajax({
    url: url,
    type: "POST",
    data: data,
    dataType: "JSON",
    processData: false,
    contentType: false,
    success: function(res) {

      if (res.status) {
        $('#PackagesModal').modal('hide');
        resetPackageModal();
        reload_table();
      } else {
        alert(res.message || 'Validation failed');
      }

      $('#btnSave').text('Save');
      $('#btnSave').attr('disabled', false);

      setTimeout(function () {
        suppressPropertyClearConfirm = false;
      }, 300);
    },
    error: function() {
      alert('Error saving data');
      $('#btnSave').text('Save');
      $('#btnSave').attr('disabled', false);

      setTimeout(function () {
        suppressPropertyClearConfirm = false;
      }, 300);
    }
  });
}
///***For save the package details from adding modal form *****///

////***For reload the datatable  *****///

function reload_table()
{
    $table.ajax.reload(null,false); //reload datatable ajax 
    var id = $("#id").val();
    if(id)
    {  

          swal("Package details updated successfully", "", "success")
      
    }
    else{
      
          swal("Package details added successfully", "", "success")

    }
	
    
}

////***For reload the datatable  *****///

// Store CKEditor instances by row number




$(document).ready(function () {

  const $duration  = $('#packages_duration_in_nights');
  const $cat       = $('#packages_itinerary_category_id_fk');
  const $itinerary = $('#packages_itinerary_id_fk');

  if ($itinerary.length) $itinerary.select2({ width: '100%' });

  $cat.on('change', function () {
    window.loadItinerariesByCategoryDuration();
  });

  let t = null;
  $duration.on('keyup change', function () {
    clearTimeout(t);
    t = setTimeout(function () {
      if ($cat.val()) {
        window.loadItinerariesByCategoryDuration();
      } else {
        $itinerary.html('<option value="">Please Select itinerary</option>');
        if ($itinerary.hasClass('select2-hidden-accessible')) $itinerary.trigger('change.select2');
      }
    }, 300);
  });

});



////***Ajax dropdown for add*****///

////***For reset modal again *****///

// function resetPackageModal() {

//   const $modal = $('#PackagesModal');
//   const $form  = $('#form');

//   /* ===============================
//      1️⃣ Reset FORM FIELDS
//      =============================== */
//   $form[0].reset();

//   /* ===============================
//      2️⃣ Reset SELECT2 (VERY IMPORTANT)
//      =============================== */
//   $modal.find('select').each(function () {
//     if ($(this).hasClass('select2-hidden-accessible')) {
//       $(this).val(null).trigger('change');
//     }
//   });

//   /* ===============================
//      3️⃣ Uncheck ALL checkboxes
//      =============================== */
//   $modal.find('input[type="checkbox"]').prop('checked', false);

//   /* ===============================
//      4️⃣ Clear dynamic containers
//      =============================== */

//   // Itinerary table
//   $('#itinerary').empty();

//   // Inclusion / exclusion
//   $('#inclusion, #exclusion').empty();
//   $('#inclusionExclusionWrapper').hide();
//   $('#myDiv2, #myDiv3').hide();

//   // Optional add on
//   $('#optional-addon').find('.optional-addon-row').remove();
//   $('#optional-addon').closest('.col-xl-10').hide();

//   // Special requirements
//   // $('#special-requirments').find('.special-row').remove();
//   // $('#special-requirments').closest('.col-xl-10').hide();

//   // Payment policies
//   $('#payment-policies').find('.payment-row').remove();
//   $('#myDiv4, #myDiv5').hide();

//   // Terms & conditions
//   $('#terms-conditions').find('.terms-row').remove();
//   $('#myDiv6, #myDiv7').hide();

//   // Cancellation policy
//   $('#cancellation-policy').find('.cancellation-row').remove();
//   $('#myDiv8, #myDiv9').hide();

//   // Notes
//   $('#add_notes').find('.note-row').remove();
//   // $('#add_notes').closest('.col-xl-10').hide();

//   // Properties
//   $('#property').empty().hide();
//   $('[onClick="addMore10();"]').closest('.terms_add, .mb-3').hide();

//   /* ===============================
//      5️⃣ Remove validation states
//      =============================== */
//   $modal.find('.is-invalid, .has-error').removeClass('is-invalid has-error');
//   $modal.find('.help-block').text('');

// }

function resetPackageModal() {

  suppressPropertyClearConfirm = true;

  const $modal = $('#PackagesModal');
  const $form  = $('#form');

  $form[0].reset();

  $modal.find('select').each(function () {
    if ($(this).hasClass('select2-hidden-accessible')) {
      $(this).val(null).trigger('change');
    }
  });

  $modal.find('input[type="checkbox"]').prop('checked', false);

  $('#itinerary').empty();
  $('#inclusion, #exclusion').empty();
  $('#inclusionExclusionWrapper').hide();
  $('#myDiv2, #myDiv3').hide();

  $('#optional-addon').find('.optional-addon-row').remove();
  $('#optional-addon').closest('.col-xl-10').hide();

  $('#payment-policies').find('.payment-row').remove();
  $('#myDiv4, #myDiv5').hide();

  $('#terms-conditions').find('.terms-row').remove();
  $('#myDiv6, #myDiv7').hide();

  $('#cancellation-policy').find('.cancellation-row').remove();
  $('#myDiv8, #myDiv9').hide();

  $('#add_notes').find('.note-row').remove();

  $('#property').empty().hide();
  $('[onClick="addMore10();"]').closest('.terms_add, .mb-3').hide();

  $modal.find('.is-invalid, .has-error').removeClass('is-invalid has-error');
  $modal.find('.help-block').text('');

  setTimeout(function () {
    suppressPropertyClearConfirm = false;
  }, 300);
}

////***For reset modal again *****///


////***For select2 change destination *****///


$(document).on('change', '.change_destination', function () {

  const $row = $(this).closest('tr');
  const newDestId   = $(this).val();
  const newDestName = $(this).find('option:selected').text();

  if (!newDestId) return;

  $row.find('.active-destination-id').val(newDestId);
  $row.find('.active-destination-name').val(newDestName);

  // ✅ IMPORTANT: this is the posted array field
  $row.find('.destination-post').val(newDestId);
});

////***For set destination id and name if selected another destination from dropdown under change destination *****///

////***For loading itiniraries in dropdown under duration nights and load days based on itineray and display details in tooltip *****///

$(document).ready(function () {

    /* ==========================================================
       1. Package itinerary change → Load table rows
    ========================================================== */

$('#packages_first_cover_page').on('change', function(){
    const file = this.files[0];
    if(file){
        const url = URL.createObjectURL(file);
        $('#first_cover_preview').html('<img src="'+url+'" style="width:120px;">');
    }
});

$('#packages_last_cover_page').on('change', function(){
    const file = this.files[0];
    if(file){
        const url = URL.createObjectURL(file);
        $('#last_cover_preview').html('<img src="'+url+'" style="width:120px;">');
    }
});

$('#packages_itinerary_id_fk').on('change', function () {

  if (window.isEditLoading) return;  // ✅ ADD THIS LINE
  
  let itineraryId = $(this).val();
  let tbody = $('#itinerary');

  destroyDayEditors();
  tbody.empty();

  if (!itineraryId) return;

  tbody.append(`<tr><td colspan="6" class="text-center text-muted">Loading itinerary days...</td></tr>`);

  $.ajax({
    url: "<?php echo base_url(); ?>index.php/Packages/itinerary_array_list/" + itineraryId,
    type: 'GET',
    dataType: 'json',
    success: function (res) {

      destroyDayEditors();
      tbody.empty();

      if (!res || !res.length) {
        tbody.append(`<tr><td colspan="6" class="text-center text-danger">No itinerary days found</td></tr>`);
        return;
      }

      $.each(res, function (i, item) {

        let rowNum = i + 1;

        // TB badge
        let tbBadge = (item.itineraries_days_travel_back === 'TB')
          ? ` <span class="badge bg-warning text-dark ms-2">Travel Back</span>`
          : '';

        // Image URL (adjust your uploads path)
        let imgFile = item.itineraries_days_image || '';
        let imgUrl  = imgFile ? `<?php echo base_url('uploads/itinerary_days/'); ?>${imgFile}` : '';

        // Thumbnail (a bit bigger)
        let imgHtml = imgUrl
          ? `<img src="${imgUrl}" class="day-thumb" alt="Day Image">`
          : `<div class="text-muted small">No image</div>`;

        let isTB = (item.itineraries_days_travel_back === 'TB');
        let requiredStatusHtml = '';

        if (isTB) {
          requiredStatusHtml = `
            <div class="mt-2 tb-required-wrap">
              <label class="form-check-label" style="font-size:13px;">
                <input type="checkbox"
                      class="form-check-input tb-required-checkbox"
                      checked>
                Property / Room Required
              </label>
              <input type="hidden"
                    name="packages_itineraries_days_required_status[]"
                    class="tb-required-status"
                    value="1">
            </div>
          `;
        } else {
          requiredStatusHtml = `
            <input type="hidden"
                  name="packages_itineraries_days_required_status[]"
                  class="tb-required-status"
                  value="0">
          `;
        }
        tbody.append(`
          <tr data-row-num="${rowNum}">
            <td>
              <div>
                <b>${item.itineraries_days_day}</b> | ${item.itineraries_days_title}${tbBadge}
              </div>

              <input type="hidden" name="is_travel_back[]" class="is-travel-back" value="${isTB ? '1' : '0'}">

              <input type="hidden"
                    name="packages_itineraries_days_travel_back[]"
                    class="pkg-travel-back"
                    value="${isTB ? 'TB' : ''}">

              ${requiredStatusHtml}
            </td>

            <td>
              ${item.state_name}
              <input type="hidden" class="active-destination-id" value="${item.itineraries_days_destination_id_fk}">
              <input type="hidden" class="active-destination-name" value="${item.state_name}">
            </td>

            <td>
              <!-- CKEditor textarea (NO hidden textarea now) -->
              <textarea
                name="packages_itineraries_days_description[]"
                class="form-control day-editor"
                id="day_editor_${rowNum}"
                rows="6">${item.itineraries_days_description || ''}</textarea>

              <!-- Needed for saving -->
              <input type="hidden" name="itineraries_days_id_fk[]" value="${item.itineraries_days_id}">
              <input type="hidden" name="packages_itineraries_days_day[]" value="${item.itineraries_days_day}">
              <input type="hidden" name="packages_itineraries_days_title[]" value="${item.itineraries_days_title}">
              <input type="hidden" name="packages_itineraries_days_destination_id_fk[]" class="destination-post" value="${item.itineraries_days_destination_id_fk}">

              <!-- default image filename (so controller can store if no new upload) -->
              <input type="hidden" name="default_itinerary_day_image[]" value="${imgFile}">
            </td>

            <td>
              ${imgHtml}

              <div class="mt-2">
                <input type="file"
                       class="form-control form-control-sm day-image-input"
                       name="packages_itineraries_days_image_file[]"
                       accept="image/*">
              </div>
            </td>

            <td>
              <select class="form-control change_destination" style="width:100%;">
                <option value="">Please Select Destination</option>
              </select>
            </td>

            <td class="position-relative">
              <select class="form-control change_itinerary mb-2" data-row-num="${rowNum}" style="width:100%;">
                <option value="">Please Select Itinerary</option>
              </select>

              <select class="form-control change_itinerary_day" data-row-num="${rowNum}" style="width:100%;">
                <option value="">Please Select Days</option>
              </select>

              <div class="day-description-tooltip" id="tooltip_${rowNum}">
                <div class="tooltip-content"></div>
              </div>
            </td>
          </tr>
        `);
      });

      // Select2 init
      $('.change_destination').select2({ width: '100%' });
      $('.change_itinerary').select2({ width: '100%' });
      $('.change_itinerary_day').select2({ width: '100%' });

      // Load destinations + row-wise itineraries
      loadChangeDestinations();
      loadRowWiseItineraries();

      // ✅ INIT CKEDITOR for each row
      initEditorsForDays();

      if (window.pendingPropertyOpen && typeof window.openPropertyUI === 'function') {
        window.pendingPropertyOpen = false;
        window.openPropertyUI();
      }
    }
  });

  $.ajax({
        url: "<?php echo base_url(); ?>index.php/Packages/get_itinerary_cover_pages",
        type: "POST",
        dataType: "json",
        data: { itinerary_id: itineraryId },
        success: function(res){

            if(!res) return;

            // FIRST COVER
            if(res.itineraries_first_cover_page){

                $('#packages_first_cover_page_txt')
                    .val(res.itineraries_first_cover_page);

                $('#first_cover_preview').html(
                    '<img src="<?php echo base_url("uploads/itinerary_cover/"); ?>'
                    + res.itineraries_first_cover_page +
                    '" style="width:120px;border:1px solid #ddd;padding:3px;">'
                );

                $('#packages_first_cover_page').prop('required', false);

            }else{

                $('#first_cover_preview').html('');
                $('#packages_first_cover_page').prop('required', true);
            }


            // LAST COVER
            if(res.itineraries_last_cover_page){

                $('#packages_last_cover_page_txt')
                    .val(res.itineraries_last_cover_page);

                $('#last_cover_preview').html(
                    '<img src="<?php echo base_url("uploads/itinerary_cover/"); ?>'
                    + res.itineraries_last_cover_page +
                    '" style="width:120px;border:1px solid #ddd;padding:3px;">'
                );

                $('#packages_last_cover_page').prop('required', false);

            }else{

                $('#last_cover_preview').html('');
                $('#packages_last_cover_page').prop('required', true);
            }

        }
    });
});



////***For loading itinerary details on change itinerary dropdown *****///

////***For loading select2 change detination dropdown*****///

    /* ==========================================================
       2. Load Change Destination dropdown (once per row)
    ========================================================== */


    /* ==========================================================
       3. Auto-load itinerary dropdown using STAY destination
    ========================================================== */
    


   
  /* ==========================================================
       4. Itinerary change → Load itinerary days
    ========================================================== */
  

    function initDaySelect2(el) {
    el.select2({
        width: '100%',
        placeholder: 'Please Select Days',
        allowClear: true,
        dropdownAutoWidth: true,
        templateResult: function (data) {

            if (!data.id) return data.text;

            var description = $(data.element).attr('data-desc');

            var $span = $('<span>').text(data.text);

            if (description) {
                $span.attr('data-preview-desc', description);
            }

            return $span;
        }
    });
}

  /* ==========================================================
       5. Itinerary description in block on mouse over itinerary days
    ========================================================== */

    $(document).on('change', '.change_itinerary', function () {

    let row = $(this).closest('tr');
    let itineraryId = $(this).val();
    let daySelect = row.find('.change_itinerary_day');

    // 🔥 Destroy existing Select2 instance
    if (daySelect.hasClass('select2-hidden-accessible')) {
        daySelect.select2('destroy');
    }

    daySelect.empty().append('<option value="">Please Select Days</option>');

    if (!itineraryId) {
        initDaySelect2(daySelect);
        return;
    }

    $.ajax({
        type: "POST",
        url: "<?php echo base_url(); ?>index.php/Packages/fetch_days_under_itinerary",
        data: { itineraries_id_fk: itineraryId },
        dataType: "json",
        success: function (days) {

            $.each(days, function (i, day) {

                daySelect.append(
                    `<option value="${day.itineraries_days_id}"
                        data-desc="${day.itineraries_days_description}">
                         ${day.itineraries_days_day} | ${day.itineraries_days_title}
                    </option>`
                );
            });

            // ✅ Re-initialize Select2 AFTER options added
            initDaySelect2(daySelect);
        }
    });
});



var activeRowId = null;
var isMenuOpening = false;

$(document).on('select2:open', '.change_itinerary_day', function() {
    activeRowId = $(this).data('row-num');
    isMenuOpening = true;
    setTimeout(() => isMenuOpening = false, 200);
});

$(document).on('mouseenter', '.select2-results__option', function() {

    if (!activeRowId || isMenuOpening) return;

    var description = $(this).find('[data-preview-desc]').attr('data-preview-desc');
    // var tooltip = $('#tooltip_' + activeRowId);

    // if (description) {
    //     tooltip.html(description).fadeIn(100);
    //     $tooltip.css({ opacity: 1, transform: 'translateY(0)' }).show();

    // }

    var $tooltip = $('#tooltip_' + activeRowId);

    if (description) {
      $tooltip.html(description).fadeIn(100);
      $tooltip.css({ opacity: 1, transform: 'translateY(0)' }).show();
    }
});

$(document).on('select2:close', '.change_itinerary_day', function() {
    $('.day-description-tooltip').hide();
    activeRowId = null;
});




$(document).on('select2:select', '.change_itinerary_day', function (e) {

  let $select = $(this);
  let row = $select.closest('tr');
  let rowNum = row.data('row-num');

  let data = e.params.data;
  let description = $(data.element).attr('data-desc') || '';

  // ✅ Put description into CKEditor
  if (window.dayEditors && window.dayEditors[rowNum]) {
    window.dayEditors[rowNum].setData(description);
  } else {
    // fallback
    row.find('.day-editor').val(description);
  }
});

});

////***For loading itiniraries in dropdown under duration nights and load days based on itineray and display details in tooltip *****///

    

////***For loading or dynamically add the inclusion and exclusion*****///

$(document).ready(function () {

  /* ==========================
     SELECTORS
     ========================== */
  const $wrapper = $('#inclusionExclusionWrapper');
  const $chk     = $('#packages_inclusion_exclusion_checked_type');
  const $ddl     = $('#packages_inclusion_exclusion_common_id_fk');

  const $incBox  = $('#inclusion');
  const $excBox  = $('#exclusion');

  // Button wrappers (your buttons are inside these)
  const $btnIncWrap = $('.add1');
  const $btnExcWrap = $('.add2');

  // Cards (heading + body + buttons)
  const $cardInc = $('#myDiv2');
  const $cardExc = $('#myDiv3');

  /* ==========================
     INITIAL STATE
     ========================== */
  $wrapper.hide();
  $cardInc.hide();
  $cardExc.hide();
  $btnIncWrap.hide();
  $btnExcWrap.hide();

  /* ==========================
     HELPERS
     ========================== */

  function clearTextareas() {
    $incBox.html('');
    $excBox.html('');
  }

  function showManualUI() {
    // Manual mode = checkbox checked + dropdown empty
    $cardInc.show();
    $cardExc.show();
    $btnIncWrap.show();
    $btnExcWrap.show();
  }

  function hideAllUI() {
    $cardInc.hide();
    $cardExc.hide();
    $btnIncWrap.hide();
    $btnExcWrap.hide();
  }

  function appendRow(type, value = '') {
    const isInc = type === 'inclusion';
    const name  = isInc ? 'packages_inclusions_details[]' : 'packages_exclusions_details[]';
    const cls   = isInc ? 'inclusion-row' : 'exclusion-row';

    const html = `
      <div class="d-flex gap-2 mb-2 ${cls} align-items-start">
        <textarea class="form-control" name="${name}" rows="3">${value}</textarea>
        <button type="button" class="btn btn-sm btn-danger remove-row"><b>X</b></button>
      </div>
    `;

    (isInc ? $incBox : $excBox).append(html);
  }

  function loadFromBackend(commonId) {
    $.ajax({
      url: '<?php echo base_url(); ?>index.php/Packages/get_inclusion_exclusion_details',
      type: 'POST',
      dataType: 'json',
      data: { common_id: commonId },
      success: function (res) {
        clearTextareas();

        // Show cards when loading (content visible)
        $cardInc.show();
        $cardExc.show();

        // Hide add buttons in load mode
        $btnIncWrap.hide();
        $btnExcWrap.hide();

        if (res.inclusions && res.inclusions.length) {
          $.each(res.inclusions, function (i, row) {
            appendRow('inclusion', row.inclusions_details || '');
          });
        }

        if (res.exclusions && res.exclusions.length) {
          $.each(res.exclusions, function (i, row) {
            appendRow('exclusion', row.exclusions_details || '');
          });
        }
      }
    });
  }

  function isManualMode() {
    return $chk.is(':checked') && !$ddl.val();
  }

  /* ==========================
     CHECKBOX TOGGLE
     ========================== */
  $chk.on('change', function () {

    if ($(this).is(':checked')) {

      // Show whole module
      $wrapper.slideDown();

      // Reset everything
      $ddl.val('');
      clearTextareas();

      // ✅ IMPORTANT: show cards + add buttons now
      showManualUI();

    } else {

      // Hide whole module
      $wrapper.slideUp();

      // Reset/clear
      $ddl.val('');
      clearTextareas();

      // Hide cards + buttons
      hideAllUI();
    }
  });

  /* ==========================
     DROPDOWN CHANGE
     ========================== */
  $ddl.on('change', function () {

    const commonId = $(this).val();
    clearTextareas();

    // If checkbox not checked, nothing should show
    if (!$chk.is(':checked')) {
      hideAllUI();
      return;
    }

    // Reset to manual mode (dropdown empty)
    if (!commonId) {
      showManualUI();
      return;
    }

    // Load mode (dropdown selected)
    loadFromBackend(commonId);
  });

  /* ==========================
     ADD MANUAL ROWS
     ========================== */
  $(document).on('click', '.add-inclusion', function () {
    if (!isManualMode()) return;
    $cardInc.show();
    appendRow('inclusion', '');
  });

  $(document).on('click', '.add-exclusion', function () {
    if (!isManualMode()) return;
    $cardExc.show();
    appendRow('exclusion', '');
  });

  /* ==========================
     REMOVE ROW
     ========================== */
  $(document).on('click', '.remove-row', function () {
    $(this).closest('.inclusion-row, .exclusion-row').remove();
  });

});


////***For loading or dynamically add the inclusion and exclusion*****///


////***For dynamically add the optional addon*****///

$(document).ready(function () {

    // Checkbox
    const $optChk = $('#packages_optional_add_on_checked_type');

    // Main container where rows are appended
    const $optBox = $('#optional-addon');

    // Keep a reference to the add button block so we don't remove it
    const $optAddBtnBlock = $optBox.find('.mb-3.col-md-6').first();

    // Hide Optional Add-on section initially if checkbox is not checked
    toggleOptionalAddonUI($optChk.is(':checked'));

    /* ==========================================
       CHECKBOX TOGGLE (SHOW/HIDE + CLEAR)
       ========================================== */
    $optChk.on('change', function () {
        const isChecked = $(this).is(':checked');

        // Show/hide UI
        toggleOptionalAddonUI(isChecked);

        // When toggling, clear all added rows
        clearOptionalAddonRows();
    });

    /* ==========================================
       ADD NEW OPTIONAL ADDON ROW
       ========================================== */
    $(document).on('click', '.add-optional-addon', function () {

        // Allow add only if checkbox checked
        if (!$optChk.is(':checked')) return;

        // Append a new row BEFORE the Add button block
        $optAddBtnBlock.before(`
            <div class="d-flex gap-2 mb-2 optional-addon-row align-items-start">
                <textarea name="packages_optional_add_on_details[]"
                          class="form-control"
                          rows="3"
                          placeholder="Enter optional add on"></textarea>

                <button type="button"
                        class="btn btn-sm btn-danger remove-optional-addon">
                    <b>X</b>
                </button>
            </div>
        `);
    });

    /* ==========================================
       REMOVE OPTIONAL ADDON ROW
       ========================================== */
    $(document).on('click', '.remove-optional-addon', function () {
        $(this).closest('.optional-addon-row').remove();
    });

    /* ==========================================
       HELPERS
       ========================================== */
    function toggleOptionalAddonUI(show) {
        // Hide/show the whole card column for optional-addon
        // (closest col-xl-10 col-lg-10 holds card)
        const $section = $optBox.closest('.col-xl-10.col-lg-10');

        if (show) {
            $section.slideDown();
        } else {
            $section.slideUp();
        }
    }

    function clearOptionalAddonRows() {
        // Remove only dynamically added rows, keep add button block
        $optBox.find('.optional-addon-row').remove();
    }

});

////***For dynamically add the optional addon*****///

////***For dynamically add the special requirments *****///

$(document).ready(function () {

    /* ==========================================================
       GET OPTIONS (CACHED)
       ========================================================== */
    function getSpecialOptions(callback) {

        // If already fetched once, reuse
        if (specialOptionsCache) {
            callback(specialOptionsCache);
            return;
        }

        $.ajax({
            url: "<?php echo base_url(); ?>index.php/Packages/get_special_requirements",
            type: "GET",
            dataType: "json",
            success: function (res) {
                specialOptionsCache = res || [];
                callback(specialOptionsCache);
            }
        });
    }

    /* ==========================================================
       POPULATE A SELECT
       ========================================================== */
    function fillSelect($select, options) {

        $select.empty().append('<option value="">Please Select</option>');

        $.each(options, function (i, item) {
            $select.append(`<option value="${item.id}">${item.text}</option>`);
        });
    }

    /* ==========================================================
       GLOBAL FUNCTION used by onClick="addMore4();"
       ========================================================== */
    window.addMore4 = function () {

        if (!$chk.is(':checked')) return;

        const $btnBlock = $box.find('.mb-3.col-md-6').first();

        // ✅ create jQuery element so we can grab the select from THIS row
        const $row = $(`
            <div class="row special-row align-items-end mb-2">

                <div class="col-md-3">
                    <select name="special_requirements_id_fk[]"
                            class="form-control special-select"
                            required>
                        <option value="">Loading...</option>
                    </select>
                </div>

                <div class="col-md-3">
                    <input type="text"
                           class="form-control special-amount"
                           name="packages_special_requirements_cost[]"
                           placeholder="Enter amount"
                           required>
                </div>

                <div class="col-md-1">
                    <button type="button" class="btn btn-sm btn-danger remove-special">
                        <b>X</b>
                    </button>
                </div>

            </div>
        `);

        // Insert before button block
        $btnBlock.before($row);

        // ✅ now target select inside THIS inserted row (not first row)
        const $select = $row.find('.special-select');

        // Load options (cached) and fill
        getSpecialOptions(function (options) {
            fillSelect($select, options);
        });
    };

    /* ==========================================================
       REMOVE ROW
       ========================================================== */
    $(document).on('click', '.remove-special', function () {
        $(this).closest('.special-row').remove();
    });

    /* ==========================================================
       ON CHANGE SELECT → LOAD AMOUNT
       ========================================================== */
    $(document).on('change', '.special-select', function () {

        const specialId = $(this).val();
        const $row = $(this).closest('.special-row');
        const $amount = $row.find('.special-amount');

        $amount.val('');

        if (!specialId) return;

        $.ajax({
            url: "<?php echo base_url(); ?>index.php/Packages/get_special_requirement_amount",
            type: "POST",
            dataType: "json",
            data: { special_requirements_id: specialId },
            success: function (res) {
                $amount.val(res.amount || '');
            }
        });
    });

});

////***For dynamically add the special requirments *****///

////***For load or dynamically add the payment policies *****///

$(document).ready(function () {

    const $chk   = $('#packages_payment_policies_checked_type');
    const $ddl   = $('#payment_policies_id_fk');
    const $box   = $('#payment-policies');
    const $card  = $('#myDiv5');
    const $ddRow = $('#myDiv4');

    // Initial hide
    $ddRow.hide();
    $card.hide();

    /* ===============================
       CHECKBOX TOGGLE
       =============================== */
    $chk.on('change', function () {

        if ($(this).is(':checked')) {

            $ddRow.slideDown();
            $card.slideDown();

            resetPaymentPolicies(true);

        } else {

            $ddRow.slideUp();
            $card.slideUp();

            resetPaymentPolicies(false);
        }
    });

    /* ===============================
       DROPDOWN CHANGE
       =============================== */
    $ddl.on('change', function () {

        const id = $(this).val();

        clearRows();

        if (!id) {
            // Manual mode
            $('.payment_add').show();
            return;
        }

        // Load mode
        $('.payment_add').hide();

        $.ajax({
            url: "<?php echo base_url(); ?>index.php/Packages/get_payment_policies_items",
            type: "POST",
            dataType: "json",
            data: { payment_policies_id: id },
            success: function (res) {

                $.each(res, function (i, row) {
                    appendRow(row.description || '');
                });
            }
        });
    });

    /* ===============================
       GLOBAL ADD FUNCTION (button)
       =============================== */
    window.addMore5 = function () {

        // Only allow manual add
        if (!$chk.is(':checked')) return;
        if ($ddl.val()) return;

        appendRow('');
    };

    /* ===============================
       APPEND TEXTAREA ROW
       =============================== */
    function appendRow(value) {

        const $btnBlock = $box.find('.payment_add').first();

        $btnBlock.before(`
            <div class="d-flex gap-2 mb-2 payment-row align-items-start">
                <textarea class="form-control"
                          name="packages_payment_policies_details[]"
                          rows="3">${value}</textarea>

                <button type="button"
                        class="btn btn-sm btn-danger remove-payment">
                    <b>X</b>
                </button>
            </div>
        `);
    }

    /* ===============================
       CLEAR ROWS
       =============================== */
    function clearRows() {
        $box.find('.payment-row').remove();
    }

    /* ===============================
       RESET FUNCTION
       =============================== */
    function resetPaymentPolicies(showAdd) {

        $ddl.val('');
        clearRows();

        if (showAdd) {
            $('.payment_add').show();
        } else {
            $('.payment_add').hide();
        }
    }

    /* ===============================
       REMOVE ROW
       =============================== */
    $(document).on('click', '.remove-payment', function () {
        $(this).closest('.payment-row').remove();
    });

});

////***For load or dynamically add the payment policies *****///

////***For load or dynamically add the terms and condition *****///

$(document).ready(function () {

    const $chk   = $('#packages_terms_conditions_checked_type');
    const $ddl   = $('#terms_condition_id_fk');
    const $box   = $('#terms-conditions');

    const $ddRow = $('#myDiv6');  // dropdown row
    const $card  = $('#myDiv7');  // card

    // Initial hide
    $ddRow.hide();
    $card.hide();

    /* ===============================
       CHECKBOX TOGGLE
       =============================== */
    $chk.on('change', function () {

        if ($(this).is(':checked')) {
            $ddRow.slideDown();
            $card.slideDown();
            resetTerms(true);
        } else {
            $ddRow.slideUp();
            $card.slideUp();
            resetTerms(false);
        }
    });

    /* ===============================
       DROPDOWN CHANGE
       =============================== */
    $ddl.on('change', function () {

        const id = $(this).val();

        clearTermsRows();

        // Manual mode
        if (!id) {
            $('.terms_add').show();
            return;
        }

        // Load mode
        $('.terms_add').hide();

        $.ajax({
            url: "<?php echo base_url(); ?>index.php/Packages/get_terms_conditions_items",
            type: "POST",
            dataType: "json",
            data: { terms_condition_id: id },
            success: function (res) {
                $.each(res, function (i, row) {
                    appendTermsRow(row.description || '');
                });
            }
        });
    });

    /* ===============================
       GLOBAL ADD FUNCTION (button)
       =============================== */
    window.addMore6 = function () {

        // Only allow manual add
        if (!$chk.is(':checked')) return;
        if ($ddl.val()) return;

        appendTermsRow('');
    };

    /* ===============================
       APPEND TEXTAREA ROW
       =============================== */
    function appendTermsRow(value) {

        const $btnBlock = $box.find('.terms_add').first();

        $btnBlock.before(`
            <div class="d-flex gap-2 mb-2 terms-row align-items-start">
                <textarea class="form-control"
                          name="packages_terms_condition_details[]"
                          rows="3">${value}</textarea>

                <button type="button"
                        class="btn btn-sm btn-danger remove-terms">
                    <b>X</b>
                </button>
            </div>
        `);
    }

    /* ===============================
       CLEAR ROWS
       =============================== */
    function clearTermsRows() {
        $box.find('.terms-row').remove();
    }

    /* ===============================
       RESET
       =============================== */
    function resetTerms(showAdd) {

        $ddl.val('');
        clearTermsRows();

        if (showAdd) {
            $('.terms_add').show();
        } else {
            $('.terms_add').hide();
        }
    }

    /* ===============================
       REMOVE ROW
       =============================== */
    $(document).on('click', '.remove-terms', function () {
        $(this).closest('.terms-row').remove();
    });

});

////***For load or dynamically add the terms and condition *****///

////***For load or dynamically add the cancellation policy *****///

$(document).ready(function () {

    const $chk   = $('#packages_cancellation_policy_checked_type');
    const $ddl   = $('#cancellation_policies_id_fk');
    const $box   = $('#cancellation-policy');

    const $ddRow = $('#myDiv8');  // dropdown row
    const $card  = $('#myDiv9');  // card

    // Initial hide
    $ddRow.hide();
    $card.hide();

    /* ===============================
       CHECKBOX TOGGLE
       =============================== */
    $chk.on('change', function () {

        if ($(this).is(':checked')) {
            $ddRow.slideDown();
            $card.slideDown();
            resetCancellation(true);
        } else {
            $ddRow.slideUp();
            $card.slideUp();
            resetCancellation(false);
        }
    });

    /* ===============================
       DROPDOWN CHANGE
       =============================== */
    $ddl.on('change', function () {

        const id = $(this).val();

        clearCancellationRows();

        // Manual mode
        if (!id) {
            $('.terms_add').show(); // your add button wrapper is terms_add
            return;
        }

        // Load mode
        $('.terms_add').hide();

        $.ajax({
            url: "<?php echo base_url(); ?>index.php/Packages/get_cancellation_policy_items",
            type: "POST",
            dataType: "json",
            data: { cancellation_policies_id: id },
            success: function (res) {
                $.each(res, function (i, row) {
                    appendCancellationRow(row.description || '');
                });
            }
        });
    });

    /* ===============================
       GLOBAL ADD FUNCTION (button)
       =============================== */
    window.addMore7 = function () {

        // Only allow manual add
        if (!$chk.is(':checked')) return;
        if ($ddl.val()) return;

        appendCancellationRow('');
    };

    /* ===============================
       APPEND TEXTAREA ROW
       =============================== */
    function appendCancellationRow(value) {

        const $btnBlock = $box.find('.terms_add').first();

        $btnBlock.before(`
            <div class="d-flex gap-2 mb-2 cancellation-row align-items-start">
                <textarea class="form-control"
                          name="packages_cancellation_policies_details[]"
                          rows="3">${value}</textarea>

                <button type="button"
                        class="btn btn-sm btn-danger remove-cancellation">
                    <b>X</b>
                </button>
            </div>
        `);
    }

    /* ===============================
       CLEAR ROWS
       =============================== */
    function clearCancellationRows() {
        $box.find('.cancellation-row').remove();
    }

    /* ===============================
       RESET
       =============================== */
    function resetCancellation(showAdd) {

        $ddl.val('');
        clearCancellationRows();

        if (showAdd) {
            $('.terms_add').show();
        } else {
            $('.terms_add').hide();
        }
    }

    /* ===============================
       REMOVE ROW
       =============================== */
    $(document).on('click', '.remove-cancellation', function () {
        $(this).closest('.cancellation-row').remove();
    });

});

////***For load or dynamically add the cancellation policy *****///

////***For dynamically add the notes *****///

$(document).ready(function () {

    const $chk = $('#packages_notes_checked_type');
    const $box = $('#add_notes');

    // Hide/show the whole Notes card column (col-xl-10 col-lg-10)
    const $cardCol = $box.closest('.col-xl-10.col-lg-10');

    // The add button block (we keep it, and insert rows before it)
    const $btnBlock = $box.find('.mb-3.col-md-6').first();

    /* ===============================
       INITIAL STATE
       =============================== */
    if (!$chk.is(':checked')) {
        $btnBlock.hide();
    }

    /* ===============================
       CHECKBOX TOGGLE
       =============================== */
    $chk.on('change', function () {

        if ($(this).is(':checked')) {
            $btnBlock.slideDown();
            clearNoteRows();
        } else {
            $btnBlock.slideUp();
            clearNoteRows();
        }
    });

    /* ===============================
       GLOBAL FUNCTION (button onClick)
       =============================== */
    window.addMore8 = function () {

        // Add only if checkbox checked
        if (!$chk.is(':checked')) return;

        // Insert a new textarea row before button block
        $btnBlock.before(`
            <div class="d-flex gap-2 mb-2 note-row align-items-start">
                <textarea class="form-control"
                          name="packages_notes_details[]"
                          rows="3"
                          placeholder="Enter note"
                          required></textarea>

                <button type="button"
                        class="btn btn-sm btn-danger remove-note">
                    <b>X</b>
                </button>
            </div>
        `);
    };

    /* ===============================
       REMOVE ROW
       =============================== */
    $(document).on('click', '.remove-note', function () {
        $(this).closest('.note-row').remove();
    });

    /* ===============================
       CLEAR ONLY DYNAMIC ROWS
       =============================== */
    function clearNoteRows() {
        $box.find('.note-row').remove();
    }

});

////***For dynamically add the notes *****///

$(document).ready(function () {

  const $chk  = $('#packages_property_type');
  const $wrap = $('#property');

  if ($('input[name="packages_property_checked_type"]').length === 0) {
    $('<input>', {
      type: 'hidden',
      name: 'packages_property_checked_type',
      value: ''
    }).appendTo('#form');
  }

  const $hiddenFlag = $('input[name="packages_property_checked_type"]');
  const $globalAddBtnBlock = $('[onClick="addMore10();"]').closest('.terms_add, .mb-3');

  let sectionCount = 0;

  window.isPropertyPrefill = false;
  window.pendingPropertyOpen = false;

  window.resetPropertySections = function () {
    sectionCount = 0;
    $('#property').empty();
  };

  $wrap.hide();
  $globalAddBtnBlock.hide();

  function isItineraryLoaded() {
    const itId = $.trim($('#packages_itinerary_id_fk').val() || '');
    const hasDayRows = $('#itinerary tr').find('textarea.day-editor').length > 0;
    return !!itId && hasDayRows;
  }

  // function getDaysFromItinerary() {
  //   const days = [];

  //   $('#itinerary tr').each(function () {
  //     const $tr = $(this);
  //     const dayId = $tr.find('input[name="itineraries_days_id_fk[]"]').val() || '';

  //     if (!dayId) return;

  //     const tbVal = $tr.find('.pkg-travel-back').val();
  //     const isTB = (tbVal === 'TB');

  //     days.push({
  //       dayId: String(dayId),
  //       isTB: isTB,
  //       dayText: $tr.find('b').text() || '',
  //       destId: $tr.find('.active-destination-id').val() || '',
  //       destName: $tr.find('.active-destination-name').val() || ''
  //     });
  //   });

  //   return days;
  // }

  

  // function getDaysFromItinerary() {
  //   const days = [];

  //   $('#itinerary tr').each(function () {
  //     const $tr = $(this);
  //     const dayId = $tr.find('input[name="itineraries_days_id_fk[]"]').val() || '';

  //     if (!dayId) return;

  //     const tbVal = $tr.find('.pkg-travel-back').val();
  //     const isTB = (tbVal === 'TB');

  //     let requiredStatus = 0;
  //     const $reqHidden = $tr.find('.tb-required-status');
  //     if ($reqHidden.length) {
  //       requiredStatus = String($reqHidden.val() || '0');
  //     }

  //     days.push({
  //       dayId: String(dayId),
  //       isTB: isTB,
  //       requiredStatus: requiredStatus,
  //       dayText: $tr.find('b').text() || '',
  //       destId: $tr.find('.active-destination-id').val() || '',
  //       destName: $tr.find('.active-destination-name').val() || ''
  //     });
  //   });

  //   return days;
  // }

//   function getDaysFromItinerary() {
//   const days = [];

//   $('#itinerary tr').each(function () {
//     const $tr = $(this);
//     const dayId = $tr.find('input[name="itineraries_days_id_fk[]"]').val() || '';

//     if (!dayId) return;

//     const tbVal = $tr.find('.pkg-travel-back').val();
//     const isTB = (tbVal === 'TB');

//     let requiredStatus = '0';
//     const $reqHidden = $tr.find('.tb-required-status');
//     if ($reqHidden.length) {
//       requiredStatus = String($reqHidden.val() || '0');
//     }

//     days.push({
//       dayId: String(dayId),
//       isTB: isTB,
//       requiredStatus: requiredStatus,
//       dayText: $tr.find('b').text() || '',
//       destId: $tr.find('.active-destination-id').val() || '',
//       destName: $tr.find('.active-destination-name').val() || ''
//     });
//   });

//   return days;
// }

function getDaysFromItinerary() {
  const days = [];

  $('#itinerary tr').each(function () {
    const $tr = $(this);
    const dayId = $tr.find('input[name="itineraries_days_id_fk[]"]').val() || '';

    if (!dayId) return;

    const tbVal = $tr.find('.pkg-travel-back').val();
    const isTB = (tbVal === 'TB');

    let requiredStatus = '0';
    const $reqHidden = $tr.find('.tb-required-status');
    if ($reqHidden.length) {
      requiredStatus = String($reqHidden.val() || '0');
    }

    const destId = String($tr.find('.active-destination-id').val() || '');

    // ✅ try multiple places for destination name
    let destName = '';

    if ($tr.find('.active-destination-name').length) {
      destName = $.trim($tr.find('.active-destination-name').val() || '');
    }

    if (!destName && $tr.find('.stay-destination-text').length) {
      destName = $.trim($tr.find('.stay-destination-text').text() || '');
    }

    if (!destName) {
      // fallback from 2nd td text
      destName = $.trim($tr.children('td').eq(1).clone().children().remove().end().text() || '');
    }

    if (!destName) {
      destName = destId;
    }

    days.push({
      dayId: String(dayId),
      isTB: isTB,
      requiredStatus: requiredStatus,
      dayText: $.trim($tr.find('b').first().text() || ''),
      destId: destId,
      destName: destName
    });
  });

  return days;
}
  function escapeHtml(str) {
    return String(str)
      .replace(/&/g, '&amp;')
      .replace(/</g, '&lt;')
      .replace(/>/g, '&gt;')
      .replace(/"/g, '&quot;')
      .replace(/'/g, '&#039;');
  }

  window.openPropertyUI = function() {
    $hiddenFlag.val('Y');
    $wrap.show();
    $globalAddBtnBlock.show();

    window.resetPropertySections();
    addMore10();
  };

  $chk.off('change.propertymain').on('change.propertymain', function () {

    if (!$(this).is(':checked')) {
      window.pendingPropertyOpen = false;
      window.isPropertyPrefill = false;
      $hiddenFlag.val('');
      $wrap.hide().empty();
      $globalAddBtnBlock.hide();
      sectionCount = 0;
      return;
    }

    if (window.isPropertyPrefill) {
      $hiddenFlag.val('Y');
      $wrap.show();
      $globalAddBtnBlock.show();
      return;
    }

    if (isItineraryLoaded()) {
      openPropertyUI();
      return;
    }

    if (window.isEditLoading) {
      window.pendingPropertyOpen = true;
      $hiddenFlag.val('Y');
      $wrap.show().html('<div class="p-3 text-muted">Loading itinerary days...</div>');
      $globalAddBtnBlock.show();
      return;
    }

    alert('Please select itinerary first.');
    $(this).prop('checked', false);
    $hiddenFlag.val('');
    $wrap.empty().hide();
    $globalAddBtnBlock.hide();
  });

  // function loadProperties(destId, $select) {
  //   var dfd = $.Deferred();

  //   if ($select.hasClass('select2-hidden-accessible')) {
  //     $select.select2('destroy');
  //   }

  //   $select.html('<option value="">Loading...</option>');

  //   $.ajax({
  //     url: '<?php echo base_url(); ?>index.php/Packages/get_properties_by_destination',
  //     type: 'POST',
  //     dataType: 'json',
  //     data: { destination_id: destId }
  //   }).done(function(res){

  //     $select.empty().append('<option value="">Please Select Properties</option>');

  //     $.each(res || [], function(i, row){
  //       $select.append('<option value="' + row.properties_id + '">' + row.properties_name + '</option>');
  //     });

  //     $select.select2({
  //       width:'100%',
  //       placeholder:'Please Select Properties',
  //       allowClear:true
  //     });

  //     dfd.resolve(res || []);
  //   }).fail(function(){
  //     $select.empty().append('<option value="">Please Select Properties</option>');
  //     $select.select2({
  //       width:'100%',
  //       placeholder:'Please Select Properties',
  //       allowClear:true
  //     });
  //     dfd.resolve([]);
  //   });

  //   return dfd.promise();
  // }

  // function loadRooms(propertyId, $roomsSelect) {
  //   var dfd = $.Deferred();

  //   if ($roomsSelect.hasClass('select2-hidden-accessible')) {
  //     $roomsSelect.select2('destroy');
  //   }

  //   $roomsSelect.prop('disabled', true).empty();

  //   $.ajax({
  //     url: '<?php echo base_url(); ?>index.php/Packages/get_rooms_by_property',
  //     type: 'POST',
  //     dataType: 'json',
  //     data: { property_id: propertyId }
  //   }).done(function(res){

  //     $roomsSelect.empty();

  //     $.each(res || [], function(i, r){
  //       $roomsSelect.append(
  //         '<option value="' + r.properties_room_category_id + '" data-roomid="' + (r.room_id || '') + '">' +
  //           r.properties_room_category_name +
  //         '</option>'
  //       );
  //     });

  //     $roomsSelect.prop('disabled', false);
  //     $roomsSelect.select2({
  //       width:'100%',
  //       placeholder:'Please Select Rooms'
  //     });

  //     dfd.resolve(res || []);
  //   }).fail(function(){
  //     $roomsSelect.prop('disabled', false);
  //     $roomsSelect.select2({
  //       width:'100%',
  //       placeholder:'Please Select Rooms'
  //     });
  //     dfd.resolve([]);
  //   });

  //   return dfd.promise();
  // }

  // function normalizeRoomIds(v) {
  //   if (!v) return [];

  //   if ($.isArray(v)) {
  //     var out = [];
  //     $.each(v, function(_, x){
  //       if (x === null || x === undefined) return;

  //       if (typeof x === 'object') {
  //         var val = x.properties_room_category_id || x.room_id || x.id || x.value || '';
  //         if (val !== '') out.push(String(val));
  //       } else {
  //         out.push(String(x));
  //       }
  //     });
  //     return out;
  //   }

  //   if (typeof v === 'string') {
  //     var arr = [];
  //     $.each(v.split(','), function(_, s){
  //       s = $.trim(s);
  //       if (s) arr.push(String(s));
  //     });
  //     return arr;
  //   }

  //   return [String(v)];
  // }

  // function setPropertyAndRoomsFromSaved(destId, $propSel, $roomsSel, savedPropertyId, savedRoomIds) {
  //   var dfd = $.Deferred();

  //   savedPropertyId = savedPropertyId ? String(savedPropertyId) : '';
  //   var roomVals = normalizeRoomIds(savedRoomIds);

  //   loadProperties(destId, $propSel).done(function(){

  //     // set property after options loaded
  //     $propSel.val(savedPropertyId);

  //     if ($propSel.hasClass('select2-hidden-accessible')) {
  //       $propSel.trigger('change.select2');
  //     } else {
  //       $propSel.trigger('change');
  //     }

  //     if (!savedPropertyId) {
  //       dfd.resolve();
  //       return;
  //     }

  //     loadRooms(savedPropertyId, $roomsSel).done(function(){

  //       var finalVals = [];

  //       // first try direct match
  //       $.each(roomVals, function(_, rv){
  //         if ($roomsSel.find('option[value="' + rv + '"]').length) {
  //           finalVals.push(String(rv));
  //         }
  //       });

  //       // fallback by data-roomid
  //       if (finalVals.length === 0) {
  //         $roomsSel.find('option').each(function(){
  //           var optVal = String($(this).val() || '');
  //           var altId  = String($(this).data('roomid') || '');

  //           if ($.inArray(optVal, roomVals) !== -1 || (altId && $.inArray(altId, roomVals) !== -1)) {
  //             finalVals.push(optVal);
  //           }
  //         });
  //       }

  //       $roomsSel.val(finalVals);

  //       if ($roomsSel.hasClass('select2-hidden-accessible')) {
  //         $roomsSel.trigger('change.select2');
  //       } else {
  //         $roomsSel.trigger('change');
  //       }

  //       // debug
  //       console.log('Saved property ->', savedPropertyId);
  //       console.log('Saved room vals ->', roomVals);
  //       console.log('Final matched room vals ->', finalVals);

  //       dfd.resolve();
  //     });
  //   });

  //   return dfd.promise();
  // }

  function loadProperties(destId, $select) {
  var dfd = $.Deferred();

  if ($select.hasClass('select2-hidden-accessible')) {
    $select.select2('destroy');
  }

  $select.html('<option value="">Loading...</option>');

  $.ajax({
    url: '<?php echo base_url(); ?>index.php/Packages/get_properties_by_destination',
    type: 'POST',
    dataType: 'json',
    data: { destination_id: destId }
  }).done(function(res){

    $select.empty().append('<option value="">Please Select Properties</option>');

    $.each(res || [], function(i, row){
      $select.append('<option value="' + row.properties_id + '">' + row.properties_name + '</option>');
    });

    $select.select2({
      width:'100%',
      placeholder:'Please Select Properties',
      allowClear:true
    });

    dfd.resolve(res || []);
  }).fail(function(){
    $select.empty().append('<option value="">Please Select Properties</option>');
    $select.select2({
      width:'100%',
      placeholder:'Please Select Properties',
      allowClear:true
    });
    dfd.resolve([]);
  });

  return dfd.promise();
}

function loadRooms(propertyId, $roomsSelect) {
  var dfd = $.Deferred();

  if ($roomsSelect.hasClass('select2-hidden-accessible')) {
    $roomsSelect.select2('destroy');
  }

  $roomsSelect.prop('disabled', true).empty();

  $.ajax({
    url: '<?php echo base_url(); ?>index.php/Packages/get_rooms_by_property',
    type: 'POST',
    dataType: 'json',
    data: { property_id: propertyId }
  }).done(function(res){

    $roomsSelect.empty();

    $.each(res || [], function(i, r){
      $roomsSelect.append(
        '<option value="' + r.properties_room_category_id + '" data-roomid="' + (r.room_id || '') + '">' +
          r.properties_room_category_name +
        '</option>'
      );
    });

    $roomsSelect.prop('disabled', false);
    $roomsSelect.select2({
      width:'100%',
      placeholder:'Please Select Rooms'
    });

    dfd.resolve(res || []);
  }).fail(function(){
    $roomsSelect.prop('disabled', false);
    $roomsSelect.select2({
      width:'100%',
      placeholder:'Please Select Rooms'
    });
    dfd.resolve([]);
  });

  return dfd.promise();
}

function normalizeRoomIds(v) {
  if (!v) return [];

  if (Array.isArray(v)) {
    return v.map(function(x){
      if (x === null || x === undefined) return null;
      if (typeof x === 'object') {
        return String(
          x.properties_room_category_id ||
          x.room_id ||
          x.id ||
          x.value ||
          ''
        );
      }
      return String(x);
    }).filter(Boolean);
  }

  if (typeof v === 'string') {
    return v.split(',').map(function(s){ return s.trim(); }).filter(Boolean).map(String);
  }

  return [String(v)];
}

function setPropertyAndRoomsFromSaved(destId, $propSel, $roomsSel, savedPropertyId, savedRoomIds) {
  var dfd = $.Deferred();

  savedPropertyId = savedPropertyId ? String(savedPropertyId) : '';
  var roomVals = normalizeRoomIds(savedRoomIds);

  loadProperties(destId, $propSel).done(function(){

    $propSel.val(savedPropertyId);

    if ($propSel.hasClass('select2-hidden-accessible')) {
      $propSel.trigger('change.select2');
    }

    if (!savedPropertyId) {
      dfd.resolve();
      return;
    }

    loadRooms(savedPropertyId, $roomsSel).done(function(){

      var finalVals = [];

      $.each(roomVals, function(_, rv){
        if ($roomsSelectHasValue($roomsSel, rv)) {
          finalVals.push(String(rv));
        }
      });

      if (finalVals.length === 0) {
        $roomsSel.find('option').each(function(){
          var optVal = String($(this).val() || '');
          var altId  = String($(this).data('roomid') || '');

          if ($.inArray(optVal, roomVals) !== -1 || (altId && $.inArray(altId, roomVals) !== -1)) {
            finalVals.push(optVal);
          }
        });
      }

      $roomsSel.val(finalVals);

      if ($roomsSel.hasClass('select2-hidden-accessible')) {
        $roomsSel.trigger('change.select2');
      }

      dfd.resolve();
    });
  });

  return dfd.promise();
}

function $roomsSelectHasValue($roomsSel, value) {
  return $roomsSel.find('option[value="' + value + '"]').length > 0;
}

  // window.addMore10 = function () {

  //   if (!$chk.is(':checked')) return;

  //   const days = getDaysFromItinerary();

  //   sectionCount++;
  //   const sectionId = sectionCount;

  //   const $section = $(`
  //     <div class="property-section border rounded p-3 mb-4" data-section="${sectionId}">
  //       <div class="d-flex align-items-end justify-content-between mb-3 gap-3 flex-wrap">
  //         <div style="width:320px;">
  //           <label><b>Category Name</b></label>
  //           <input type="text"
  //                  name="property_category_name[${sectionId}]"
  //                  class="form-control"
  //                  placeholder="Enter category name"
  //                  required>
  //         </div>

  //         <div style="width:250px;">
  //           <label><b>Design Type</b></label>
  //           <select name="packages_properties_common_design_type[${sectionId}]"
  //                   class="form-control design-type-select"
  //                   style="width:100%;">
  //             <option value="">Select Design</option>
  //             <option value="Standard">Standard</option>
  //             <option value="Exclusive">Exclusive</option>
  //           </select>
  //         </div>

  //         <div>
  //           <button type="button" class="btn btn-danger btn-sm remove-section">Remove Section</button>
  //         </div>
  //       </div>

  //       <div class="table-responsive">
  //         <table class="table">
  //           <thead>
  //             <tr>
  //               <th style="width:120px;">Day</th>
  //               <th style="width:220px;">Stay Destination</th>
  //               <th style="width:320px;">Property</th>
  //               <th>Rooms</th>
  //               <th style="width:120px;"></th>
  //             </tr>
  //           </thead>
  //           <tbody class="property-days-body"></tbody>
  //         </table>
  //       </div>
  //     </div>
  //   `);

  //   const $tbody = $section.find('.property-days-body');

  //   $.each(days, function (idx, d) {
  //     const dayKey = d.dayId;
  //     const tbBadge = d.isTB ? ' <span class="badge bg-warning text-dark ms-2">Travel Back</span>' : '';

  //     const $dayRow = $(`
  //       <tr class="day-row"
  //           data-day-id="${dayKey}"
  //           data-is-tb="${d.isTB ? 1 : 0}"
  //           data-required-status="${d.requiredStatus}">
  //         <td>${escapeHtml(d.dayText)}${tbBadge}</td>
  //         <td>
  //           ${escapeHtml(d.destName)}
  //           <input type="hidden"
  //                 name="property_destination_id[${sectionId}][${dayKey}]"
  //                 value="${escapeHtml(d.destId)}">
  //         </td>
  //         <td colspan="3">
  //           <div class="assignments" data-dest-id="${escapeHtml(d.destId)}"></div>
  //         </td>
  //       </tr>
  //     `);

  //     $tbody.append($dayRow);

  //     addAssignmentRow($dayRow, sectionId, dayKey, d.destId, true, d.isTB, { skipLoad: false, requiredStatus: d.requiredStatus });
  //   });

  //   $wrap.append($section);
  //   $section.find('.design-type-select').select2({ width: '100%' });
  // };

  window.addMore10 = function () {

    if (!$('#packages_property_type').is(':checked')) return;

    const days = getDaysFromItinerary();

    sectionCount++;
    const sectionId = sectionCount;

    const $section = $(`
      <div class="property-section border rounded p-3 mb-4" data-section="${sectionId}">
        <div class="d-flex align-items-end justify-content-between mb-3 gap-3 flex-wrap">
          <div style="width:320px;">
            <label><b>Category Name</b></label>
            <input type="text"
                  name="property_category_name[${sectionId}]"
                  class="form-control"
                  placeholder="Enter category name"
                  required>
          </div>

          <div style="width:250px;">
            <label><b>Design Type</b></label>
            <select name="packages_properties_common_design_type[${sectionId}]"
                    class="form-control design-type-select"
                    style="width:100%;">
              <option value="">Select Design</option>
              <option value="Standard">Standard</option>
              <option value="Exclusive">Exclusive</option>
            </select>
          </div>

          <div>
            <button type="button" class="btn btn-danger btn-sm remove-section">Remove Section</button>
          </div>
        </div>

        <div class="table-responsive">
          <table class="table">
            <thead>
              <tr>
                <th style="width:120px;">Day</th>
                <th style="width:220px;">Stay Destination</th>
                <th style="width:320px;">Property</th>
                <th>Rooms</th>
                <th style="width:120px;"></th>
              </tr>
            </thead>
            <tbody class="property-days-body"></tbody>
          </table>
        </div>
      </div>
    `);

    const $tbody = $section.find('.property-days-body');

    $.each(days, function (idx, d) {
      const dayKey = d.dayId;
      const tbBadge = d.isTB ? ' <span class="badge bg-warning text-dark ms-2">Travel Back</span>' : '';

      const $dayRow = $(`
        <tr class="day-row"
            data-day-id="${dayKey}"
            data-is-tb="${d.isTB ? 1 : 0}"
            data-required-status="${d.requiredStatus}">
          <td>${escapeHtml(d.dayText)}${tbBadge}</td>
          <td>
            ${escapeHtml(d.destName)}
            <input type="hidden"
                  name="property_destination_id[${sectionId}][${dayKey}]"
                  value="${escapeHtml(d.destId)}">
          </td>
          <td colspan="3">
            <div class="assignments" data-dest-id="${escapeHtml(d.destId)}"></div>
          </td>
        </tr>
      `);

      $tbody.append($dayRow);

      addAssignmentRow(
        $dayRow,
        sectionId,
        dayKey,
        d.destId,
        true,
        d.isTB,
        {
          skipLoad: false,
          requiredStatus: d.requiredStatus
        }
      );
    });

    $('#property').append($section);
    $section.find('.design-type-select').select2({ width: '100%' });
  };

  // function addAssignmentRow($dayRow, sectionId, dayKey, destId, isFirst, isTravelBack, opts) {
  //   opts = opts || {};
  //   const skipLoad = (opts.skipLoad === true);

  //   const $assignments = $dayRow.find('.assignments');
  //   const rowKey = Date.now() + '_' + Math.floor(Math.random() * 1000);
  //   const requiredAttr = isTravelBack ? '' : 'required';

  //   const buttonsHtml = isFirst
  //     ? `<button type="button" class="btn btn-danger btn-sm add-assignment">+ Add</button>`
  //     : `<button type="button" class="btn btn-danger btn-sm remove-assignment">X</button>`;

  //   const $a = $(`
  //     <div class="assignment-row d-flex gap-3 align-items-start mb-2" data-row-key="${rowKey}">
  //       <div style="width:320px;">
  //         <select class="form-control property-select" ${requiredAttr}
  //                 name="properties_id[${sectionId}][${dayKey}][${rowKey}]">
  //           <option value="">Please Select Properties</option>
  //         </select>
  //       </div>

  //       <div class="flex-grow-1">
  //         <select class="form-control rooms-select" multiple ${requiredAttr} disabled
  //                 name="rooms_id[${sectionId}][${dayKey}][${rowKey}][]"></select>
  //       </div>

  //       <div style="width:120px;">${buttonsHtml}</div>
  //     </div>
  //   `);

  //   $assignments.append($a);

  //   $a.find('.property-select').select2({
  //     width: '100%',
  //     placeholder: 'Please Select Properties',
  //     allowClear: true
  //   });

  //   $a.find('.rooms-select').select2({
  //     width: '100%',
  //     placeholder: 'Please Select Rooms'
  //   });

  //   $a.find('.rooms-select')
  //     .html('<option value="">Please Select Property First</option>')
  //     .prop('disabled', true);

  //   if (!skipLoad) {
  //     loadProperties(destId, $a.find('.property-select'));
  //   }
  // }

  // function addAssignmentRow($dayRow, sectionId, dayKey, destId, isFirst, isTravelBack, opts) {
  //   opts = opts || {};
  //   var skipLoad = (opts.skipLoad === true);

  //   var $assignments = $dayRow.find('.assignments');
  //   var rowKey = Date.now() + '_' + Math.floor(Math.random() * 1000);
  //   const mustRequire = (!isTravelBack || String(opts.requiredStatus || '1') === '1');
  //   const requiredAttr = mustRequire ? 'required' : '';
  //   // var requiredAttr = isTravelBack ? '' : 'required';

  //   var buttonsHtml = isFirst
  //     ? '<button type="button" class="btn btn-danger btn-sm add-assignment">+ Add</button>'
  //     : '<button type="button" class="btn btn-danger btn-sm remove-assignment">X</button>';

  //   var $a = $(`
  //     <div class="assignment-row d-flex gap-3 align-items-start mb-2" data-row-key="${rowKey}">
  //       <div style="width:320px;">
  //         <select class="form-control property-select" ${requiredAttr}
  //                 name="properties_id[${sectionId}][${dayKey}][${rowKey}]">
  //           <option value="">Please Select Properties</option>
  //         </select>
  //       </div>

  //       <div class="flex-grow-1">
  //         <select class="form-control rooms-select" multiple ${requiredAttr} disabled
  //                 name="rooms_id[${sectionId}][${dayKey}][${rowKey}][]"></select>
  //       </div>

  //       <div style="width:120px;">${buttonsHtml}</div>
  //     </div>
  //   `);

  //   $assignments.append($a);

  //   $a.find('.property-select').select2({
  //     width: '100%',
  //     placeholder: 'Please Select Properties',
  //     allowClear: true
  //   });

  //   $a.find('.rooms-select').select2({
  //     width: '100%',
  //     placeholder: 'Please Select Rooms'
  //   });

  //   $a.find('.rooms-select')
  //     .html('<option value="">Please Select Property First</option>')
  //     .prop('disabled', true);

  //   if (!skipLoad) {
  //     loadProperties(destId, $a.find('.property-select'));
  //   }
  // }


  function addAssignmentRow($dayRow, sectionId, dayKey, destId, isFirst, isTravelBack, opts) {
    opts = opts || {};

    var skipLoad = (opts.skipLoad === true);
    var requiredStatus = String(opts.requiredStatus || '0');

    var mustRequire = (!isTravelBack || requiredStatus === '1');
    var requiredAttr = mustRequire ? 'required' : '';

    var $assignments = $dayRow.find('.assignments');
    var rowKey = Date.now() + '_' + Math.floor(Math.random() * 1000);

    var buttonsHtml = isFirst
      ? '<button type="button" class="btn btn-danger btn-sm add-assignment">+ Add</button>'
      : '<button type="button" class="btn btn-danger btn-sm remove-assignment">X</button>';

    var $a = $(`
      <div class="assignment-row d-flex gap-3 align-items-start mb-2" data-row-key="${rowKey}">
        <div style="width:320px;">
          <select class="form-control property-select" ${requiredAttr}
                  name="properties_id[${sectionId}][${dayKey}][${rowKey}]">
            <option value="">Please Select Properties</option>
          </select>
        </div>

        <div class="flex-grow-1">
          <select class="form-control rooms-select" multiple ${requiredAttr} disabled
                  name="rooms_id[${sectionId}][${dayKey}][${rowKey}][]"></select>
        </div>

        <div style="width:120px;">${buttonsHtml}</div>
      </div>
    `);

    $assignments.append($a);

    $a.find('.property-select').select2({
      width: '100%',
      placeholder: 'Please Select Properties',
      allowClear: true
    });

    $a.find('.rooms-select').select2({
      width: '100%',
      placeholder: 'Please Select Rooms'
    });

    $a.find('.rooms-select')
      .html('<option value="">Please Select Property First</option>')
      .prop('disabled', true);

    // IMPORTANT:
    // dropdown must still load for TB unchecked rows
    loadProperties(destId, $a.find('.property-select'));
  }

//   window.buildSavedPropertyUI = function(propertyData) {
//   if (!propertyData || !propertyData.length) return;

//   window.isPropertyPrefill = true;

//   $('#packages_property_type').prop('checked', true);
//   $('input[name="packages_property_checked_type"]').val('Y');
//   $('#property').show();
//   $('[onClick="addMore10();"]').closest('.terms_add, .mb-3').show();

//   if (typeof window.resetPropertySections === 'function') {
//     window.resetPropertySections();
//   } else {
//     $('#property').empty();
//   }

//   var allPromises = [];

//   $.each(propertyData, function(_, sec){

//     addMore10();

//     var $section  = $('#property .property-section').last();
//     var sectionId = $section.data('section');

//     // category
//     $section.find('input[name^="property_category_name"]').val(
//       sec.packages_properties_common_category_name || ''
//     );

//     // design type
//     $section.find('select[name^="packages_properties_common_design_type"]')
//       .val(sec.packages_properties_common_design_type || '')
//       .trigger('change.select2');

//     $.each(sec.days || [], function(_, dayObj){

//       var dayKey = String(dayObj.itineraries_days_id_fk || '');
//       var destId = String(dayObj.destination_id || '');

//       if (!dayKey) return;

//       var $dayRow = $section.find('tr.day-row[data-day-id="' + dayKey + '"]');
//       if (!$dayRow.length) {
//         console.log('No matching day row found for dayKey:', dayKey, dayObj);
//         return;
//       }

//       $dayRow.find('input[name^="property_destination_id"]').val(destId);
//       $dayRow.find('.assignments').attr('data-dest-id', destId);

//       // IMPORTANT: remove the auto-created default row
//       $dayRow.find('.assignment-row').remove();

//       var isTB = ($dayRow.data('is-tb') == 1);
//       var requiredStatus = String($dayRow.data('required-status') || '0');

//       // If no saved property rows exist, still create ONE empty row
//       // so dropdown is visible in edit modal
//       if (!dayObj.properties || !dayObj.properties.length) {
//         addAssignmentRow(
//           $dayRow,
//           sectionId,
//           dayKey,
//           destId,
//           true,
//           isTB,
//           {
//             skipLoad: false,
//             requiredStatus: requiredStatus
//           }
//         );
//         return;
//       }

//       $.each(dayObj.properties, function(idx, p){

//         addAssignmentRow(
//           $dayRow,
//           sectionId,
//           dayKey,
//           destId,
//           (idx === 0),
//           isTB,
//           {
//             skipLoad: true,
//             requiredStatus: requiredStatus
//           }
//         );

//         var $assign  = $dayRow.find('.assignment-row').last();
//         var $propSel = $assign.find('.property-select');
//         var $roomSel = $assign.find('.rooms-select');

//         allPromises.push(
//           setPropertyAndRoomsFromSaved(
//             destId,
//             $propSel,
//             $roomSel,
//             p.property_id,
//             p.rooms
//           )
//         );
//       });

//     });
//   });

//   $.when.apply($, allPromises).always(function(){
//     setTimeout(function(){
//       window.isPropertyPrefill = false;
//     }, 200);
//   });
// };

window.buildSavedPropertyUI = function(propertyData) {
  if (!propertyData || !propertyData.length) {
    window.isPropertyPrefill = false;
    return;
  }

  window.isPropertyPrefill = true;

  $('#packages_property_type').prop('checked', true);
  $('input[name="packages_property_checked_type"]').val('Y');
  $('#property').show();
  $('[onClick="addMore10();"]').closest('.terms_add, .mb-3').show();

  if (typeof window.resetPropertySections === 'function') {
    window.resetPropertySections();
  } else {
    $('#property').empty();
  }

  var chain = $.Deferred().resolve();

  $.each(propertyData, function(_, sec){

    chain = chain.then(function(){

      addMore10();

      var $section  = $('#property .property-section').last();
      var sectionId = $section.data('section');

      $section.find('input[name^="property_category_name"]').val(
        sec.packages_properties_common_category_name || ''
      );

      $section.find('select[name^="packages_properties_common_design_type"]')
        .val(sec.packages_properties_common_design_type || '')
        .trigger('change.select2');

      var innerChain = $.Deferred().resolve();

      $.each(sec.days || [], function(_, dayObj){

        innerChain = innerChain.then(function(){

          var dayKey = String(dayObj.itineraries_days_id_fk || '');
          var destId = String(dayObj.destination_id || '');

          if (!dayKey) {
            return $.Deferred().resolve();
          }

          var $dayRow = $section.find('tr.day-row[data-day-id="' + dayKey + '"]');
          if (!$dayRow.length) {
            console.log('No matching day row found for dayKey:', dayKey, dayObj);
            return $.Deferred().resolve();
          }

          $dayRow.find('input[name^="property_destination_id"]').val(destId);
          $dayRow.find('.assignments').attr('data-dest-id', destId);

          $dayRow.find('.assignment-row').remove();

          var requiredStatus = String($dayRow.data('required-status') || '0');
          var isTB = ($dayRow.data('is-tb') == 1);

          // if no saved rows, still create one empty row
          if (!dayObj.properties || !dayObj.properties.length) {
            addAssignmentRow(
              $dayRow,
              sectionId,
              dayKey,
              destId,
              true,
              isTB,
              { skipLoad: false, requiredStatus: requiredStatus }
            );
            return $.Deferred().resolve();
          }

          var rowChain = $.Deferred().resolve();

          $.each(dayObj.properties, function(idx, p){

            rowChain = rowChain.then(function(){

              addAssignmentRow(
                $dayRow,
                sectionId,
                dayKey,
                destId,
                (idx === 0),
                isTB,
                { skipLoad: true, requiredStatus: requiredStatus }
              );

              var $assign  = $dayRow.find('.assignment-row').last();
              var $propSel = $assign.find('.property-select');
              var $roomSel = $assign.find('.rooms-select');

              return setPropertyAndRoomsFromSaved(
                destId,
                $propSel,
                $roomSel,
                p.property_id,
                p.rooms
              );
            });
          });

          return rowChain;
        });
      });

      return innerChain;
    });
  });

  chain.always(function(){
    setTimeout(function(){
      window.isPropertyPrefill = false;
    }, 200);
  });
};

  $(document).on('click', '.add-assignment', function () {
    const $dayRow   = $(this).closest('tr.day-row');
    const sectionId = $(this).closest('.property-section').data('section');
    const dayKey    = String($dayRow.data('day-id') || '');
    const destId    = $dayRow.find('input[name^="property_destination_id"]').val();
    const isTB      = ($dayRow.data('is-tb') == 1);
    const requiredStatus = String($dayRow.data('required-status') || '1');

    if (!dayKey) return;

    addAssignmentRow($dayRow, sectionId, dayKey, destId, false, isTB, { skipLoad: false, requiredStatus: requiredStatus });
  });

  $(document).on('click', '.remove-assignment', function () {
    const $row = $(this).closest('.assignment-row');

    $row.find('.property-select, .rooms-select').each(function(){
      if ($(this).hasClass('select2-hidden-accessible')) {
        $(this).select2('destroy');
      }
    });

    $row.remove();
  });

  $(document).on('click', '.remove-section', function () {
    $(this).closest('.property-section').find('select').each(function(){
      if ($(this).hasClass('select2-hidden-accessible')) {
        $(this).select2('destroy');
      }
    });
    $(this).closest('.property-section').remove();
  });

  // $(document).on('change', '.property-select', function () {

  //   if (window.isPropertyPrefill) return;

  //   var selectedId   = $(this).val();
  //   var $row         = $(this).closest('.assignment-row');
  //   var $rooms       = $row.find('.rooms-select');
  //   var $assignments = $(this).closest('.assignments');

  //   if ($rooms.hasClass('select2-hidden-accessible')) {
  //     $rooms.select2('destroy');
  //   }
  //   $rooms.empty().prop('disabled', true);

  //   if (!selectedId) {
  //     $rooms.append('<option value="">Please Select Property First</option>');
  //     $rooms.select2({ width:'100%', placeholder:'Please Select Rooms' });
  //     return;
  //   }

  //   var duplicate = false;
  //   $assignments.find('.property-select').not(this).each(function () {
  //     if ($(this).val() === selectedId) {
  //       duplicate = true;
  //       return false;
  //     }
  //   });

  //   if (duplicate) {
  //     alert('This property is already selected for this day.');
  //     $(this).val('').trigger('change.select2');
  //     $rooms.append('<option value="">Please Select Property First</option>');
  //     $rooms.select2({ width:'100%', placeholder:'Please Select Rooms' });
  //     return;
  //   }

  //   loadRooms(selectedId, $rooms);
  // });

  $(document).on('change', '.property-select', function () {

    if (window.isPropertyPrefill) return;

    var selectedId   = $(this).val();
    var $row         = $(this).closest('.assignment-row');
    var $rooms       = $row.find('.rooms-select');
    var $assignments = $(this).closest('.assignments');

    if ($rooms.hasClass('select2-hidden-accessible')) {
      $rooms.select2('destroy');
    }

    $rooms.empty().prop('disabled', true);

    if (!selectedId) {
      $rooms.append('<option value="">Please Select Property First</option>');
      $rooms.select2({ width:'100%', placeholder:'Please Select Rooms' });
      return;
    }

    var duplicate = false;
    $assignments.find('.property-select').not(this).each(function () {
      if ($(this).val() === selectedId) {
        duplicate = true;
        return false;
      }
    });

    if (duplicate) {
      alert('This property is already selected for this day.');
      $(this).val('').trigger('change.select2');
      $rooms.append('<option value="">Please Select Property First</option>');
      $rooms.select2({ width:'100%', placeholder:'Please Select Rooms' });
      return;
    }

    loadRooms(selectedId, $rooms);
  });

});


////***For properties blocks when change destination or change itinerary *****///

// ---------- PROPERTY RESET (call this when you want to clear everything) ----------
function resetPropertiesBlock() {
  // Uncheck checkbox
  $('#packages_property_type').prop('checked', false).trigger('change');

  // If your properties JS doesn't rely on trigger('change'), also hard clear:
  $('#property').empty().hide();

  // Hide global "+ Add new" (the one calling addMore10)
  $('[onClick="addMore10();"]').closest('.terms_add, .mb-3').hide();
}

// ---------- check if properties block currently has anything to lose ----------
// function isPropertiesActiveOrDirty() {
//   return $('#packages_property_type').is(':checked') || $.trim($('#property').html()) !== '';
// }

// // ---------- store previous value for any select (works for normal + select2) ----------
// function bindPrevValueTracker(selector) {
//   // normal select
//   $(document).on('focus', selector, function () {
//     $(this).data('prev', $(this).val());
//   });

//   // select2 select
//   $(document).on('select2:opening', selector, function () {
//     $(this).data('prev', $(this).val());
//   });
// }

// let skipItineraryChange = false;

// $(document).on('change', '#packages_itinerary_id_fk', function () {

//   // if we are reverting value, don't run reload logic
//   if (skipItineraryChange) {
//     skipItineraryChange = false;
//     return;
//   }

//   const $sel = $(this);
//   const prev = $sel.data('prev');
//   const now  = $sel.val();

//   // If user selected same, no action
//   if (prev == now) return;

//   // Only confirm if properties has data/checked
//   if (isPropertiesActiveOrDirty()) {

//     const ok = confirm('Changing itinerary will clear the Property details block. Continue?');

//     if (!ok) {
//       // revert back
//       skipItineraryChange = true;
//       $sel.val(prev);

//       // refresh select2 UI if enabled
//       if ($sel.hasClass('select2-hidden-accessible')) {
//         $sel.trigger('change.select2');
//       } else {
//         $sel.trigger('change'); // optional
//       }
//       return;
//     }

//     // YES → clear properties block
//     resetPropertiesBlock();
//   }

//   // ✅ If confirmed or no properties data, your existing itinerary reload code will run after this
// });

// let skipDestinationChange = false;

// $(document).on('change', '.change_destination', function () {

//   if (skipDestinationChange) {
//     skipDestinationChange = false;
//     return;
//   }

//   const $sel = $(this);
//   const prev = $sel.data('prev');
//   const now  = $sel.val();

//   if (prev == now) return;

//   // Ask confirmation only if properties is active/dirty
//   if (isPropertiesActiveOrDirty()) {

//     const ok = confirm('Changing destination will clear the Property details block. Continue?');

//     if (!ok) {
//       // revert to previous value
//       skipDestinationChange = true;
//       $sel.val(prev);

//       // refresh select2 UI if enabled
//       if ($sel.hasClass('select2-hidden-accessible')) {
//         $sel.trigger('change.select2');
//       } else {
//         $sel.trigger('change');
//       }
//       return;
//     }

//     // YES → clear properties
//     resetPropertiesBlock();
//   }

//   // ✅ allow your existing destination change logic to continue (load itinerary list etc)
// });

let suppressPropertyClearConfirm = false;

function isPropertiesActiveOrDirty() {
  return $('#packages_property_type').is(':checked') || $('#property').children().length > 0;
}

function bindPrevValueTracker(selector) {
  $(document).on('focus', selector, function () {
    $(this).data('prev', $(this).val());
  });

  $(document).on('select2:opening', selector, function () {
    $(this).data('prev', $(this).val());
  });
}

bindPrevValueTracker('#packages_itinerary_id_fk');
bindPrevValueTracker('.change_destination');

let skipItineraryChange = false;

$(document).on('change', '#packages_itinerary_id_fk', function () {

  // skip during reset / close / save / edit loading
  if (suppressPropertyClearConfirm || window.isEditLoading) {
    return;
  }

  // if reverting manually
  if (skipItineraryChange) {
    skipItineraryChange = false;
    return;
  }

  const $sel = $(this);
  const prev = $sel.data('prev');
  const now  = $sel.val();

  if (prev == now) return;

  if (isPropertiesActiveOrDirty()) {

    const ok = confirm('Changing itinerary will clear the Property details block. Continue?');

    if (!ok) {
      skipItineraryChange = true;
      $sel.val(prev);

      if ($sel.hasClass('select2-hidden-accessible')) {
        $sel.trigger('change.select2');
      } else {
        $sel.trigger('change');
      }
      return;
    }

    resetPropertiesBlock();
  }
});

let skipDestinationChange = false;

$(document).on('change', '.change_destination', function () {

  // skip during reset / close / save / edit loading
  if (suppressPropertyClearConfirm || window.isEditLoading) {
    return;
  }

  if (skipDestinationChange) {
    skipDestinationChange = false;
    return;
  }

  const $sel = $(this);
  const prev = $sel.data('prev');
  const now  = $sel.val();

  if (prev == now) return;

  if (isPropertiesActiveOrDirty()) {

    const ok = confirm('Changing destination will clear the Property details block. Continue?');

    if (!ok) {
      skipDestinationChange = true;
      $sel.val(prev);

      if ($sel.hasClass('select2-hidden-accessible')) {
        $sel.trigger('change.select2');
      } else {
        $sel.trigger('change');
      }
      return;
    }

    resetPropertiesBlock();
  }
});
////***For properties blocks when change destination or change itinerary *****///

// Allowed extensions
const allowedImageExt = ['jpg', 'jpeg', 'png'];

$(document).on('change', '.day-image-input', function () {

  const file = this.files[0];
  if (!file) return;

  const fileName = file.name.toLowerCase();
  const extension = fileName.split('.').pop();

  if ($.inArray(extension, allowedImageExt) === -1) {

    alert('Only JPG, JPEG and PNG files are allowed.');

    // Clear invalid file
    $(this).val('');

    return false;
  }
});

////***For reload the datatable for delete *****///

function reload_table_delete()
{
    $table.ajax.reload(null,false); //reload datatable ajax
    
    swal("Template details deleted successfully", "", "success")
        // var ff = 0;
        
        // ff = "Room tariff details deleted successfully";

        //  $("#roles_delete").val(ff);
        
         
        //  var options = {

        // 'title': '',

        // 'style': 'success',

        // 'message': ff,

        // // 'success': 'warning',
        // 'icon': 'fas fa-check',

        // };
        // var n1 = new notify(options); 

        // n1.show(); 

        // setTimeout(function(){ n1.hide(); }, 10000);
        
}

////***For reload the package datatable for delete *****///

function delete_package(id)
{
     $.ajax({
        url : "<?php echo base_url();?>index.php/Packages/ajax_edit_delete/" + id,
        type: "GET",
        dataType: "JSON",
        success: function(data)
        {

            $("#id1").val(data.packages_id);
            $("#packages_title2").val(data.packages_title);
            $('#deleterowModal').modal('show'); // show bootstrap modal when complete loaded
            $('.modal-title1').text('Do you want to delete this record?'); // Set title to Bootstrap modal title
            $('#btnSave1').text('delete');
            $('#btnSave1').attr('disabled',false); //set button enable 

        },
        error: function (jqXHR, textStatus, errorThrown)
        {
            alert('Error get data from ajax');
        }
    });
    
    // $('#deleterowModal').modal('show'); // show bootstrap modal
        // ajax delete data to database 
}

function delete_package_action()
{
    $('#btnSave1').text('deleting...'); //change button text
    $('#btnSave1').attr('disabled',true); //set button disable 
    var url;

        url = "<?php echo base_url();?>index.php/Packages/ajax_delete/";
        
    

    // ajax adding data to database
    $.ajax({
        url : url,
        type: "POST",
        data: $('#form1').serialize(),
        dataType: "JSON",
        success: function(data)
        {

            if(data.status) //if success close modal and reload ajax table
            {
                $("#id1").val('');
                $('#deleterowModal').modal('hide');
                reload_table_delete();
                // ('body').removeClass('modal-open');
                //$('.modal-backdrop').remove();
                
            }
            else
            {
                for (var i = 0; i < data.inputerror.length; i++) 
                {
                    $('[name="'+data.inputerror[i]+'"]').parent().parent().addClass('has-error'); //select parent twice to select div form-group class and add has-error class
                    if($('[name="'+data.inputerror[i]+'"]').parent().find('.help-block').length) {
                        $('[name="'+data.inputerror[i]+'"]').parent().find('.help-block').text(data.error_string[i]); //select span help-block class set text error string
                    } else {
                        $('[name="'+data.inputerror[i]+'"]').next().text(data.error_string[i]);
                    }
                }
            }

            $('#btnSave1').text('save'); //change button text
            $('#btnSave1').attr('disabled',false); //set button enable 


        },
        error: function (jqXHR, textStatus, errorThrown)
        {
            alert('Error adding / update data');
            $('#btnSave1').text('save'); //change button text
            $('#btnSave1').attr('disabled',false); //set button enable 

        }
    });
}

////***For delete the package details from  database *****///

</script>

                        