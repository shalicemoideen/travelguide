///////////////////////////////////////////////////**************** Quotation ***************////////////////////////////



$('#quotation_date').datepicker({

    format: 'dd-mm-yyyy',

    autoclose: true,

    todayHighlight: true

});



function resetQuotationModalForm() {



    var form = document.getElementById('form');

    if (form) { form.reset(); }

    var form5 = document.getElementById('form5');

    if (form5) { form5.reset(); }



    $('#id').val('');

    $('#leads_id_hidden').val('');

    $('#packages_id_hidden').val('');



    if ($('#leads_id').length) {

        $('#leads_id').prop('disabled', false).data('filter-mode', 'add_quotation').empty()

            .append('<option value="">Please Select lead</option>')

            .val('').trigger('change.select2');

    }



    $('#template_name_display').text('');

    $('#lead_name_display').text('');

    $('#packages_id_fk').val('');



    $('#QuotationModal').find('select').each(function () {

        $(this).val('').trigger('change');

    });



    // reset option blocks

    if ($('#optionsContainer').length) {

        $('#optionsContainer').html('');

    }

    if ($('.optionBlockContainer').length) {

        $('.optionBlockContainer').html('');

    }



    // reset counters

    if (typeof optionCount !== 'undefined') {

        optionCount = 0;

    }



    // reset inclusion table

    var $incTbody = $('#inclusionTable tbody');

    if ($incTbody.length) {

        $incTbody.find('tr:gt(0)').remove();



        var $firstInc = $incTbody.find('tr:eq(0)');

        $firstInc.find('input').val('');

        $firstInc.find('select').each(function () {

            $(this).html('<option value="">Select</option>').val('').trigger('change');

        });

        $firstInc.find('.removeInclusionBtn').prop('disabled', false);

    }



    // reset special requirement table

    var $spTbody = $('#specialReqTable tbody');

    if ($spTbody.length) {

        $spTbody.find('tr:gt(0)').remove();



        var $firstSp = $spTbody.find('tr:eq(0)');

        $firstSp.find('input').val('');

        $firstSp.find('select').each(function () {

            $(this).html('<option value="">Select</option>').val('').trigger('change.select2');

        });

        $firstSp.find('.removeSpecialReqBtn').prop('disabled', false);

    }



    // uncheck and hide addon boxes

    $('#quotation_property_inclusion_type').prop('checked', false);

    $('#quotation_special_requirement_type').prop('checked', false);

    $('#inclusionBox').hide();

    $('#specialReqBox').hide();



    // reset totals

    $('#totalInclusionAmountText').text('0.00');

    $('#totalInclusionAmountInput').val('0');



    $('#totalSpecialReqAmountText').text('0.00');

    $('#totalSpecialReqAmountInput').val('0');



    // reset runtime arrays if used

    if (typeof __dayOptions !== 'undefined') __dayOptions = [];

    if (typeof __specialReqOptions !== 'undefined') __specialReqOptions = [];

    if (typeof __dayPropertyMap !== 'undefined') __dayPropertyMap = {};

    if (typeof __propertyInclusionMap !== 'undefined') __propertyInclusionMap = {};



    // button reset

    $('#btnSave').text('save').prop('disabled', false);



    // remove invalid classes

    $('#QuotationModal').find('.is-invalid').removeClass('is-invalid');

}



$('#QuotationModal').on('hidden.bs.modal', function () {

    resetQuotationModalForm();

});



function open_quotation(leadId) {

  save_method = 'add';

  resetQuotationModalForm();

  // Reset the form (optional)

  var form = document.getElementById('form5');

  if (form) form.reset();



  // Clear payload UI containers if you have any

  // $('.optionBlockContainer').empty();



  // Disable save until lead is loaded

  $('#btnSave').prop('disabled', true);



$('.modal-title-quote').text('Add Quotation Details'); // Set Title to Bootstrap modal title



// Set current date in textbox

var today = new Date();

var dd = String(today.getDate()).padStart(2, '0');

var mm = String(today.getMonth() + 1).padStart(2, '0'); // January is 0

var yyyy = today.getFullYear();



var formattedDate = dd + '-' + mm + '-' + yyyy;

$('#quotation_date').val(formattedDate);

  // Fetch lead (gives package_id_fk)

  $.ajax({

    url: "<?php echo base_url('index.php/Leads/ajax_edit/'); ?>" + leadId,

    type: "GET",

    dataType: "JSON",

    success: function(res) {



      var packageId = res && res.package_id_fk ? res.package_id_fk : '';



      if (!packageId) {

        alert('This lead does not have a template assigned (package_id_fk is empty).');

        return;

      }





      var leadDisplay = res && res.leads_number

          ? res.leads_number + ' - ' + res.guest_name

          : (res.guest_name || leadId);



      // âœ… set hidden ids and display names

      $('#leads_id_hidden').val(leadId);

      $('#packages_id_hidden').val(packageId);



      // also set form inputs that ajax_add expects

      if ($('#leads_id').length) {

          $('#leads_id').empty().append(new Option(leadDisplay, leadId, true, true)).val(leadId).trigger('change.select2');

      }

      $('#packages_id_fk').val(packageId);



      $('#lead_name_display').text(leadDisplay);

      $('#template_name_display').text(res.packages_title || '');



      loadInclusionAndRequirementDropdownData();   // âœ… now will work (after you fixed IDs inside it)



      // Hide dropdown row in this Leads-page modal version

      $('#leadPackageRow').addClass('d-none');



      // Open modal (Bootstrap 4 vs 5 safe)

      $('#QuotationModal').modal('show');



      // Enable save

      $('#btnSave').prop('disabled', false);



      // âœ… prepare: when user clicks "Add New Option", load package options based on hidden package id

      // (we attach once)

      bindAddOptionBtnOnce();

      toggleAddOptionBtn();



    },

    error: function() {

      alert('Failed to load lead details.');

    }

  });

}





function toggleAddOptionBtn() {

    var packageId = $('#packages_id_fk').val() || $('#packages_id_hidden').val();

    $('#addOptionBtn').prop('disabled', !packageId);

}



var __addOptionBound = false;



function bindAddOptionBtnOnce() {

  if (__addOptionBound) return;

  __addOptionBound = true;



  // bind inside modal (safer than document)

  $('#QuotationModal').on('click', '#addOptionBtn', function (e) {

    e.preventDefault();

    e.stopPropagation();



    console.log('âœ… Add Option clicked');



    var packageId = $('#packages_id_hidden').val();

    console.log('packageId:', packageId);



    if (!packageId) {

      alert('Template id not found.');

      return;

    }



    // make sure container exists

    var $wrap = $('.optionBlockContainer');

    console.log('optionBlockContainer length:', $wrap.length);



    if (!$wrap.length) {

      alert('Missing .optionBlockContainer in HTML. Add it inside modal body.');

      return;

    }



    var $newOptionBlock = addNewOptionBlock(); // must return block

    console.log('new option block created:', $newOptionBlock.length);



    if (!$newOptionBlock || !$newOptionBlock.length) {

      alert('Option block was not created. Check addNewOptionBlock().');

      return;

    }



    loadPackageOptionsIntoDropdown($newOptionBlock.find('.propertyDropdown'), packageId);

  });

}





///***For save the quotation details from adding modal form *****///







/////******** Jquery validation when save******/////////////



// function showError(msg, el) {

//     alert(msg);

//     if (el) {

//         el.scrollIntoView({ behavior: 'smooth', block: 'center' });

//         el.classList.add('is-invalid');

//         setTimeout(() => el.classList.remove('is-invalid'), 2000);

//     }

// }



function showError(message, element)

{

    alert(message);



    $('.is-invalid').removeClass('is-invalid');

    $('.select2-error').removeClass('select2-error');



    if (!element) return false;



    var $modalBody = $('#QuotationModal .modal-body');

    var $target = $(element);



    // select2 support

    if ($target.hasClass('select2-hidden-accessible')) {

        var $s2 = $target.next('.select2').find('.select2-selection');

        $s2.addClass('select2-error');

        $target = $s2;

    } else if ($target.closest('.select2').length) {

        $target.closest('.select2').find('.select2-selection').addClass('select2-error');

        $target = $target.closest('.select2');

    } else {

        $target.addClass('is-invalid');

    }



    if ($target.length && $modalBody.length) {

        var bodyTop = $modalBody.offset().top;

        var targetTop = $target.offset().top;

        var currentScroll = $modalBody.scrollTop();



        $modalBody.animate({

            scrollTop: currentScroll + (targetTop - bodyTop) - 80

        }, 300);

    }



    setTimeout(function () {

        if ($(element).hasClass('select2-hidden-accessible')) {

            $(element).select2('open');

        } else if (element.focus) {

            element.focus();

        }

    }, 350);



    return false;

}



function num(v) {

    const n = parseFloat(v);

    return isNaN(n) ? 0 : n;

}



$('.specialReqDaySelect, .inclusionDaySelect, .inclusionPropertySelect, .inclusionNameSelect')

.each(function () {

    $(this).trigger('change.select2');

});



function isValidOpenedPackageOption(optionId) {

    let found = false;



    $('.optionBlock').each(function () {

        const val = $(this).find('.propertyDropdown').val() || '';

        if (val == optionId) {

            found = true;

            return false;

        }

    });



    return found;

}



function validateUniquePropertyDropdowns() {

    var values = {};

    var valid = true;



    $('.propertyDropdown').each(function () {

        var val = $(this).val() || '';



        if (!val) return;



        if (values[val]) {

            alert('Duplicate package option selected.');

            $(this).focus();

            valid = false;

            return false;

        }



        values[val] = true;

    });



    return valid;

}



// function validateQuotationForm() {



//     if (!$('#quotation_date').val())

//         return showError('Quotation date is required', $('#quotation_date')[0]), false;



//     if (!$('#arriving_destination').val())

//         return showError('Arriving destination is required', $('#arriving_destination')[0]), false;



//     if (!$('#departuring_destination').val())

//         return showError('Departuring destination is required', $('#departuring_destination')[0]), false;



//     if (!$('#leads_id_hidden').val())

//         return showError('Please select Lead', $('#leads_id_hidden')[0]), false;



//     if (!$('#packages_id_hidden').val())

//         return showError('Please select Template', $('#packages_id_hidden')[0]), false;



//     if (!validateUniquePropertyDropdowns()) {

//         return false;

//     }



//     const optionBlocks = document.querySelectorAll('.optionBlock');

//     if (!optionBlocks || optionBlocks.length === 0) {

//         showError('Please add at least one Template Option', document.getElementById('packages_id_hidden'));

//         return false;

//     }



//     let anySelected = false;

//     optionBlocks.forEach(ob => {

//         const sel = ob.querySelector('.propertyDropdown');

//         if (sel && sel.value) anySelected = true;

//     });



//     if (!anySelected) {

//         const firstSelect = optionBlocks[0]?.querySelector('.propertyDropdown');

//         showError('Please select at least one Template Option from dropdown', firstSelect || document.getElementById('packages_id_fk'));

//         return false;

//     }



//     let valid = true;



//     document.querySelectorAll('.optionBlock').forEach(optionBlock => {



//         if (!valid) return;



//         const optionSel = optionBlock.querySelector('[name="packages_properties_common_id_fk[]"]');

//         const titleEl   = optionBlock.querySelector('[name="quotation_options_title[]"]');

//         const cabEl     = optionBlock.querySelector('[name="quotation_options_cab_amount[]"]');

//         const designEl  = optionBlock.querySelector('[name="quotation_options_design_type[]"]');

//         const vehicleEl = optionBlock.querySelector('[name="quotation_options_vehicle_id_fk[]"]');

       

//         const amountTypeEl = optionBlock.querySelector('.optionAmountType');

//         const perAmountEl  = optionBlock.querySelector('.optionPerAmount');



//         if (!amountTypeEl || !amountTypeEl.value) {

//             return valid = false, showError('Select amount type', amountTypeEl);

//         }



//         if (amountTypeEl.value !== 'net' && num(perAmountEl?.value) <= 0) {

//             return valid = false, showError('Amount is required', perAmountEl);

//         }



//         if (!optionSel?.value)

//             return valid = false, showError('Select Template Option', optionSel);



//         if (!titleEl?.value.trim())

//             return valid = false, showError('Option title is required', titleEl);



//         if (num(cabEl?.value) <= 0)

//             return valid = false, showError('Cab amount is required', cabEl);



//         if (!designEl || !designEl.value)

//             return valid = false, showError('Design type is required', designEl);



//         if (!vehicleEl || !vehicleEl.value)

//             return valid = false, showError('Vehicle is required', vehicleEl);

        



//         optionBlock.querySelectorAll('.autoCalcRateInput').forEach(inp => {

//             if (!valid) return;

//             if (num(inp.value) <= 0)

//                 return valid = false, showError('Room calculated rate cannot be 0.00', inp);

//         });



//         optionBlock.querySelectorAll('.itineraryDayRow').forEach(dayRow => {



//             if (!valid) return;



//             const openPropertySelector = dayRow.querySelector('.propertySelector:not(.d-none)');

//             if (openPropertySelector) {

//                 const propDropdown = openPropertySelector.querySelector('.propertySelectDropdown');

//                 if (propDropdown && !propDropdown.value) {

//                     return valid = false, showError('Please select property or remove the empty property block', propDropdown);

//                 }

//             }



//             dayRow.querySelectorAll('.propertyBlock').forEach(propertyBlock => {



//                 if (!valid) return;



//                 if (!propertyBlock.dataset.propertyId) {

//                     valid = false;

//                     showError('Property not selected', propertyBlock);

//                     return;

//                 }



//                 const tbody = propertyBlock.querySelector('tbody');

//                 const allRows = tbody ? tbody.querySelectorAll('tr') : [];



//                 // 1) package-loaded existing room rows

//                 const existingSavedRows = tbody ? tbody.querySelectorAll('tr[data-room-id]') : [];



//                 // 2) manually opened room dropdown rows

//                 const manualRoomRows = tbody ? tbody.querySelectorAll('tr .roomSelect') : [];



//                 let hasManualRow = false;

//                 let hasManualSelectedRoom = false;



//                 manualRoomRows.forEach(function(roomSelect) {

//                     if (!valid) return;



//                     hasManualRow = true;



//                     const roomRow = roomSelect.closest('tr');



//                     // manual room row opened but no room selected

//                     if (!roomSelect.value) {

//                         valid = false;

//                         showError('Please select room or remove the empty room row', roomSelect);

//                         return;

//                     }



//                     // selected but dataset not set

//                     if (!roomRow.dataset.roomId) {

//                         valid = false;

//                         showError('Room not selected', roomSelect);

//                         return;

//                     }



//                     hasManualSelectedRoom = true;

//                 });



//                 if (!valid) return;



//                 // CASE A:

//                 // property block has package-loaded saved rooms -> valid

//                 if (existingSavedRows.length > 0) {

//                     return;

//                 }



//                 // CASE B:

//                 // no existing saved rooms, but manual room rows exist and selected -> valid

//                 if (hasManualRow && hasManualSelectedRoom) {

//                     return;

//                 }



//                 // CASE C:

//                 // no existing saved rooms and no manual rows at all

//                 if (allRows.length === 0) {

//                     valid = false;

//                     showError('Please add at least one room', propertyBlock);

//                     return;

//                 }



//                 // CASE D:

//                 // rows exist but still no selected room

//                 valid = false;

//                 showError('Please select at least one room', propertyBlock);

//                 return;

//             });

//         });



//         const marginType  = optionBlock.querySelector('.optionMarginType');

//         const marginValue = optionBlock.querySelector('.optionMarginValue');



//         if (!marginType?.value || num(marginValue?.value) <= 0)

//             return valid = false, showError('Margin amount/percentage is required', marginValue);

//     });



//     if (!valid) return false;



    



//     /* ================= 8. PROPERTY INCLUSIONS ================= */



// if ($('#quotation_property_inclusion_type').is(':checked')) {



//     document.querySelectorAll('#inclusionTable tbody tr').forEach(tr => {

//         if (!valid) return;



//         const optionSel = tr.querySelector('.inclusionPackageOptionSelect');

//         const optionId  = optionSel ? optionSel.value : '';



//         const daySel  = tr.querySelector('.inclusionDaySelect');

//         const propSel = tr.querySelector('.inclusionPropertySelect');

//         const incSel  = tr.querySelector('.inclusionNameSelect');

//         const amtEl   = tr.querySelector('.inclusionAmountInput');



//         if (!optionId || !isValidOpenedPackageOption(optionId)) {

//             valid = false;

//             alert('Please select a valid Template Option from opened option blocks');

//             if (optionSel) optionSel.focus();

//             return;

//         }



//         if (!daySel || !daySel.value) {

//             valid = false;

//             showError('Select Day | Date | Destination for Inclusion', daySel);

//             return;

//         }



//         if (!propSel || !propSel.value) {

//             valid = false;

//             showError('Select Property for Inclusion', propSel);

//             return;

//         }



//         if (!incSel || !incSel.value) {

//             valid = false;

//             showError('Select Inclusion Name', incSel);

//             return;

//         }



//         if (!amtEl || num(amtEl.value) <= 0) {

//             valid = false;

//             showError('Inclusion amount required', amtEl);

//             return;

//         }

//     });

// }



// if (!valid) return false;



//     /* ================= 9. SPECIAL REQUIREMENTS ================= */

// if ($('#quotation_special_requirement_type').is(':checked')) {



//     document.querySelectorAll('#specialReqTable tbody tr').forEach(tr => {

//         if (!valid) return;



//         const daySel = tr.querySelector('.specialReqDaySelect');

//         const reqSel = tr.querySelector('.specialReqSelect');

//         const amtEl  = tr.querySelector('.specialReqCost');



//         if (!daySel?.value)

//             return valid = false, showError('Select Day | Date | Destination for Requirement', daySel);



//         if (!reqSel?.value)

//             return valid = false, showError('Select Special Requirement', reqSel);



//         if (num(amtEl?.value) <= 0)

//             return valid = false, showError('Requirement amount required', amtEl);

//     });

// }



// if (!valid) return false;

//     return valid;

// }



function validateQuotationForm() {



    $('.room-rate-error').removeClass('room-rate-error');

$('.select2-error').removeClass('select2-error');

$('.is-invalid').removeClass('is-invalid');



    if (!$('#quotation_date').val())

        return showError('Quotation date is required', $('#quotation_date')[0]), false;



    if (!$('#arriving_destination').val())

        return showError('Arriving destination is required', $('#arriving_destination')[0]), false;



    if (!$('#departuring_destination').val())

        return showError('Departuring destination is required', $('#departuring_destination')[0]), false;



     if (!$('#leads_id_hidden').val() && !$('#leads_id').val())

        return showError('Please select Lead', ($('#leads_id')[0] || $('#leads_id_hidden')[0])), false;



    if (!$('#packages_id_hidden').val())

        return showError('Please select Template', $('#packages_id_hidden')[0]), false;



    // if (!validateUniquePropertyDropdowns()) {

    //     return false;

    // }



    const optionBlocks = document.querySelectorAll('.optionBlock');

    if (!optionBlocks || optionBlocks.length === 0) {

        showError('Please add at least one Template Option', document.getElementById('packages_id_fk'));

        return false;

    }



    let anySelected = false;

    optionBlocks.forEach(ob => {

        const sel = ob.querySelector('.propertyDropdown');

        if (sel && sel.value) anySelected = true;

    });



    if (!anySelected) {

        const firstSelect = optionBlocks[0]?.querySelector('.propertyDropdown');

        // showError('Please select at least one Template Option from dropdown', firstSelect || document.getElementById('packages_id_fk'));

        showError(

    'Please select at least one Template Option from dropdown',

        $(firstSelect).next('.select2')[0] || firstSelect

    );

        return false;

    }



    let valid = true;



    document.querySelectorAll('.optionBlock').forEach(optionBlock => {



        if (!valid) return;



        const optionSel = optionBlock.querySelector('[name="packages_properties_common_id_fk[]"]');

        const titleEl   = optionBlock.querySelector('[name="quotation_options_title[]"]');

        const cabEl     = optionBlock.querySelector('[name="quotation_options_cab_amount[]"]');

        const designEl  = optionBlock.querySelector('[name="quotation_options_design_type[]"]');

        const vehicleEl = optionBlock.querySelector('[name="quotation_options_vehicle_id_fk[]"]');

        

        const marginType  = optionBlock.querySelector('.optionMarginType');

        const marginValue = optionBlock.querySelector('.optionMarginValue');







        const amountTypeEl = optionBlock.querySelector('.optionAmountType');

        const perAmountEl  = optionBlock.querySelector('.optionPerAmount');





        /* ===== VALIDATE MARGIN LAST ===== */







if (amountTypeEl) {

    if (!amountTypeEl.value) {

        valid = false;

        showError('Select amount type', amountTypeEl);

        return;

    }



    if (amountTypeEl.value !== 'net' && num(perAmountEl ? perAmountEl.value : 0) <= 0) {

        valid = false;

        showError('Amount is required', perAmountEl);

        return;

    }

}





// if (!marginValue?.value || num(marginValue.value) <= 0) {

//     return valid = false,

//     showError('Margin amount/percentage is required', marginValue);

// }

        if (!optionSel?.value)

            return valid = false, showError('Select Template Option', optionSel);



        if (!titleEl?.value.trim())

            return valid = false, showError('Option title is required', titleEl);



        if (num(cabEl?.value) <= 0)

            return valid = false, showError('Cab amount is required', cabEl);



        if (!designEl || !designEl.value)

            return valid = false, showError('Design type is required', designEl);



        // if (!vehicleEl || !vehicleEl.value)

        //     return valid = false, showError('Vehicle is required', vehicleEl);

        

        if (!vehicleEl || !vehicleEl.value) {

            return valid = false,

            showError(

                'Vehicle is required',

                $(vehicleEl).next('.select2')[0] || vehicleEl

            );

        }



        let hasZeroRoomRate = false;



        optionBlock.querySelectorAll('.autoCalcRateInput').forEach(inp => {

            if (!valid) return;



            const row = inp.closest('tr');



            if (num(inp.value) <= 0) {

                valid = false;



                if (row) {

                    $(row).addClass('room-rate-error');



                    const $modalBody = $('#QuotationModal .modal-body');

                    const $target = $(row);



                    $modalBody.animate({

                        scrollTop: $modalBody.scrollTop() + ($target.offset().top - $modalBody.offset().top) - 90

                    }, 300);

                }



                alert('Room calculated rate cannot be 0.00');

                return;

            } else {

                if (row) {

                    $(row).removeClass('room-rate-error');

                }

            }

        });



        if (!valid) return false;

        



        optionBlock.querySelectorAll('.itineraryDayRow').forEach(dayRow => {



            if (!valid) return;



            const openPropertySelector = dayRow.querySelector('.propertySelector:not(.d-none)');

            if (openPropertySelector) {

                const propDropdown = openPropertySelector.querySelector('.propertySelectDropdown');

                if (propDropdown && !propDropdown.value) {

                    return valid = false, showError('Please select property or remove the empty property block', propDropdown);

                }

            }



            dayRow.querySelectorAll('.property-group').forEach(propertyGroup => {



                if (!valid) return;



                if (!propertyGroup.dataset.propertyId) {

                    valid = false;

                    showError('Property not selected', propertyGroup);

                    return;

                }



                const allRows = propertyGroup.querySelectorAll('.room-row');



                // 1) package-loaded existing room rows

                const existingSavedRows = propertyGroup.querySelectorAll('.room-row[data-room-id]');



                // 2) manually opened room dropdown rows

                const manualRoomRows = propertyGroup.querySelectorAll('.room-row .roomSelect');



                let hasManualRow = false;

                let hasManualSelectedRoom = false;



                manualRoomRows.forEach(function(roomSelect) {

                    if (!valid) return;



                    hasManualRow = true;



                    const roomRow = roomSelect.closest('.room-row');



                    // manual room row opened but no room selected

                    if (!roomSelect.value) {

                        valid = false;

                        showError('Please select room or remove the empty room row', roomSelect);

                        return;

                    }



                    // selected but dataset not set

                    if (!roomRow.dataset.roomId) {

                        valid = false;

                        showError('Room not selected', roomSelect);

                        return;

                    }



                    hasManualSelectedRoom = true;

                });



                if (!valid) return;



                // CASE A:

                // property group has package-loaded saved rooms -> valid

                if (existingSavedRows.length > 0) {

                    return;

                }



                // CASE B:

                // no existing saved rooms, but manual room rows exist and selected -> valid

                if (hasManualRow && hasManualSelectedRoom) {

                    return;

                }



                // CASE C:

                // no existing saved rooms and no manual rows at all

                if (allRows.length === 0) {

                    valid = false;

                    showError('Please add at least one room', propertyGroup);

                    return;

                }



                // CASE D:

                // rows exist but still no selected room

                valid = false;

                showError('Please select at least one room', propertyGroup);

                return;

            });

        });



        

    });



    if (!valid) return false;



    // 8. Margin validation ONLY HERE, outside the above loop

    $('.optionBlock').each(function () {

        if (!valid) return false;



        const marginValue = this.querySelector('.optionMarginValue');



        if (!marginValue || $.trim($(marginValue).val()) === '' || num($(marginValue).val()) <= 0) {

            valid = false;

            showError('Margin amount/percentage is required', marginValue);

            return false;

        }



        return true;

    });



    if (!valid) return false;



    /* ================= 8. PROPERTY INCLUSIONS ================= */



if ($('#quotation_property_inclusion_type').is(':checked')) {

    const incRows = document.querySelectorAll('#inclusionTable tbody tr');

    if (!incRows.length) {

        valid = false;

        alert('At least one Property Based Inclusion is required');

        return false;

    }



    document.querySelectorAll('#inclusionTable tbody tr').forEach(tr => {

        if (!valid) return;



        const optionSel = tr.querySelector('.inclusionPackageOptionSelect');

        const optionId  = optionSel ? optionSel.value : '';



        const daySel  = tr.querySelector('.inclusionDaySelect');

        const propSel = tr.querySelector('.inclusionPropertySelect');

        const incSel  = tr.querySelector('.inclusionNameSelect');

        const amtEl   = tr.querySelector('.inclusionAmountInput');



        if (!optionId || !isValidOpenedPackageOption(optionId)) {

            valid = false;

            // alert('Please select a valid Template Option from opened option blocks');

            // if (optionSel) optionSel.focus();

            showError(

                'Please select a valid Template Option from opened option blocks',

                $(optionSel).next('.select2')[0] || optionSel

            );

            return;

        }



        if (!daySel || !daySel.value) {

            valid = false;

            // showError('Select Day | Date | Destination for Inclusion', daySel);

            showError(

                'Select Day | Date | Destination for Inclusion',

                $(daySel).next('.select2')[0] || daySel

            );

            return;

        }



        if (!propSel || !propSel.value) {

            valid = false;

            // showError('Select Property for Inclusion', propSel);

            showError(

    'Select Property for Inclusion',

    $(propSel).next('.select2')[0] || propSel

);

            return;

        }



        if (!incSel || !incSel.value) {

            valid = false;

            // showError('Select Inclusion Name', incSel);

            showError(

    'Select Inclusion Name',

    $(incSel).next('.select2')[0] || incSel

);

            return;

        }



        if (!amtEl || num(amtEl.value) <= 0) {

            valid = false;

            showError('Inclusion amount required', amtEl);

            return;

        }

    });

}



if (!valid) return false;



    /* ================= 9. SPECIAL REQUIREMENTS ================= */

if ($('#quotation_special_requirement_type').is(':checked')) {

    const reqRows = document.querySelectorAll('#specialReqTable tbody tr');

    if (!reqRows.length) {

        valid = false;

        alert('At least one Special Requirement is required');

        return false;

    }



    document.querySelectorAll('#specialReqTable tbody tr').forEach(tr => {

        if (!valid) return;



        const daySel = tr.querySelector('.specialReqDaySelect');

        const reqName = tr.querySelector('.specialReqName');

        const amtEl  = tr.querySelector('.specialReqCost');



        if (!daySel?.value)

            return valid = false,

        showError(

    'Select Day | Date | Destination for Requirement',

    $(daySel).next('.select2')[0] || daySel

);



        if (!reqName?.value?.trim())

            return valid = false, showError('Enter Special Requirement', reqName);



        if (num(amtEl?.value) <= 0)

            return valid = false, showError('Requirement amount required', amtEl);

    });

}



if (!valid) return false;

    return valid;

}



function saveQuotation() {



    // âœ… VALIDATE FIRST

    if (!validateQuotationForm()) {

        return;

    }



    let url = save_method === 'add'

        ? "<?php echo base_url();?>index.php/Quotation/ajax_add/"

        : "<?php echo base_url();?>index.php/Quotation/ajax_update/";



    $('#btnSave').text('saving...').attr('disabled', true);



    // ensure latest totals

    recalcAllOptionsBeforeSave();



    const form = document.getElementById('form5') || document.getElementById('form');

    const data = new FormData(form);



    // JSON payload

    data.append('data', JSON.stringify(buildQuotationPayload()));



    $.ajax({

        url: url,

        type: "POST",

        data: data,

        dataType: "JSON",

        processData: false,

        contentType: false,

        success: function (res) {



            if (res.status) {

                if (save_method === 'update' && typeof reload_table === 'function') {

                    reload_table();

                    resetQuotationModalForm();

                    $('#QuotationModal').modal('hide');

                } else {

                    swal("Quotation details added successfully", "", "success").then((result) => {

                        if (result.isConfirmed || result.value) {

                            window.location.href = "<?php echo base_url('index.php/Quotation'); ?>";

                        }

                    });

                }

            } else {

                alert('Validation failed on server');

            }



            $('#btnSave').text('save').attr('disabled', false);

        },

        error: function () {

            alert('Error saving data');

            $('#btnSave').text('save').attr('disabled', false);

        }

    });

}





///***For save the quotation details from adding modal form *****///







$(document).ready(function () {



    function resetInclusionBox() {

        const $tbody = $('#inclusionTable tbody');

        $tbody.find('tr:gt(0)').remove();



        const $first = $tbody.find('tr:eq(0)');

        $first.find('input').val('');

        $first.find('select').each(function () {

            $(this).val(null).trigger('change');

        });



        $first.find('.inclusionPropertySelect').html('<option value="">Select Property</option>');

        $first.find('.inclusionNameSelect').html('<option value="">Select Inclusion</option>');

        $first.find('.removeInclusionBtn').prop('disabled', false);



        if (typeof recalcInclusionTotal === 'function') {

            recalcInclusionTotal();

        }

    }



    function resetSpecialReqBox() {

        const $tbody = $('#specialReqTable tbody');

        $tbody.find('tr:gt(0)').remove();



        const $first = $tbody.find('tr:eq(0)');

        $first.find('input').val('');

        $first.find('select').each(function () {

            $(this).val(null).trigger('change');

        });



        $first.find('.removeSpecialReqBtn').prop('disabled', false);



        if (typeof recalcSpecialReqTotal === 'function') {

            recalcSpecialReqTotal();

        }

    }



    function resetAddonBlocks() {

        $('#quotation_property_inclusion_type').prop('checked', false);

        $('#quotation_special_requirement_type').prop('checked', false);



        $('#inclusionBox').hide();

        $('#specialReqBox').hide();



        resetInclusionBox();

        resetSpecialReqBox();

    }



    function hasPackageSelected() {

        var pkg = $('#packages_id_fk').val() || $('#packages_id_hidden').val() || '';

        return $.trim(pkg) !== '';

    }



    function hasValidOptionSelected() {

        var ok = false;

        $('.optionBlock .propertyDropdown').each(function () {

            if ($(this).val()) {

                ok = true;

                return false;

            }

        });

        return ok;

    }



    function loadDefaultInclusionPackageOptions() {

        document.querySelectorAll('#inclusionTable tbody tr').forEach(function (row) {

            const selectEl = row.querySelector('.inclusionPackageOptionSelect');

            if (selectEl) {

                fillInclusionPackageOptionSelect(selectEl);

            }

        });

    }



    function toggleBox($checkbox, $box, resetFn) {

        if ($checkbox.is(':checked')) {



            if (!hasPackageSelected()) {

                alert('Please select template first');

                $checkbox.prop('checked', false);

                $box.hide();

                resetFn();

                return;

            }



            if ($('.optionBlock').length === 0) {

                alert('Please add at least one option block first');

                $checkbox.prop('checked', false);

                $box.hide();

                resetFn();

                return;

            }



            if (!hasValidOptionSelected()) {

                alert('Please select at least one template option first');

                $checkbox.prop('checked', false);

                $box.hide();

                resetFn();

                return;

            }



            $box.stop(true, true).slideDown(150);



            if (typeof loadInclusionAndRequirementDropdownData === 'function') {

                loadInclusionAndRequirementDropdownData();

            }



            // âœ… NEW: load package option for default row

            setTimeout(function () {

                loadDefaultInclusionPackageOptions();

            }, 50);





        } else {

            $box.stop(true, true).slideUp(150, function () {

                resetFn();

            });

        }

    }



    // setTimeout(function () {



    //     $box.find('.inclusionPackageOptionSelect').each(function () {

    //         initSelect2(this, 'Select Package Option');

    //     });

    //     $box.find('.inclusionDaySelect').each(function () {

    //         initSelect2(this, 'Select Day | Date | Destination');

    //     });



    //     $box.find('.inclusionPropertySelect').each(function () {

    //         initSelect2(this, 'Select Property');

    //     });



    //     $box.find('.inclusionNameSelect').each(function () {

    //         initSelect2(this, 'Select Inclusion');

    //     });



    //     $box.find('.specialReqSelect').each(function () {

    //         initSelect2(this, 'Select Requirement');

    //     });



    // }, 100);



    $('#inclusionBox').hide();

    $('#specialReqBox').hide();



    $('#quotation_property_inclusion_type').on('change', function () {

        toggleBox($(this), $('#inclusionBox'), resetInclusionBox);

    });



    $('#quotation_special_requirement_type').on('change', function () {

        toggleBox($(this), $('#specialReqBox'), resetSpecialReqBox);

    });



    // visible package select

    $(document).on('change', '#packages_id_fk', function () {

        resetAddonBlocks();

    });



    // visible package select2

    $(document).on('select2:select select2:clear', '#packages_id_fk', function () {

        resetAddonBlocks();

    });



    // hidden package field used in leads page modal version

    $(document).on('change', '#packages_id_hidden', function () {

        resetAddonBlocks();

    });



    // if no valid option remains

    $(document).on('change', '.propertyDropdown', function () {

        if (!hasValidOptionSelected()) {

            resetAddonBlocks();

        }

    });



    $(document).on('click', '.removeOptionBtn', function () {

        setTimeout(function () {

            if (!hasValidOptionSelected()) {

                resetAddonBlocks();

            }

        }, 50);

    });



});



/* ================= SPECIAL REQUIREMENTS ================= */



// $(document).ready(function () {



//     function resetInclusionBox() {

//         var $tbody = $('#inclusionTable tbody');

//         $tbody.find('tr:gt(0)').remove();



//         var $first = $tbody.find('tr:eq(0)');

//         $first.find('select').val('').trigger('change');

//         $first.find('input').val('');

//         $first.find('.removeInclusionBtn').prop('disabled', true);



//         recalcInclusionTotal();

//     }



//     function toggleInclusionBox() {

//         if ($('#quotation_property_inclusion_type').is(':checked')) {

//             $('#inclusionBox').stop(true, true).slideDown(150);

//             loadInclusionAndRequirementDropdownData();

//         } else {

//             $('#inclusionBox').stop(true, true).slideUp(150, function () {

//                 resetInclusionBox();

//             });

//         }

//     }



//     // first load

//     toggleInclusionBox();



//     // checkbox change

//     $(document).on('change', '#quotation_property_inclusion_type', function () {

//         toggleInclusionBox();

//     });

// });



let __dayOptions = [];

let __dayPropertyMap = {};        // dayKey => properties

let __propertyInclusionMap = {};  // propertyId => inclusions



function formatDateDMY(dateStr) {

    if (!dateStr) return '';

    var p = dateStr.split('-');

    if (p.length === 3) return p[2] + '/' + p[1] + '/' + p[0];

    return dateStr;

}



function makeDayKey(row) {

    return row.day_id_fk + '|' + row.stay_destination_id_fk + '|' + row.accommodation_date;

}



function buildDayOptionLabel(row) {

    return (row.packages_properties_days_day || '') +

           ' | ' + formatDateDMY(row.accommodation_date || '') +

           ' | ' + (row.state_name || '');

}



function initSelect2(el, placeholder) {

    if (!el) return;



    var $el = $(el);



    if ($el.hasClass('select2-hidden-accessible')) {

        $el.select2('destroy');

    }



    $el.select2({

        width: '100%',

        placeholder: placeholder || 'Select',

        allowClear: true,

        dropdownParent: $('#QuotationModal')

    });

}





function fillDaySelect(selectEl) {

    if (!selectEl) return;



    var currentVal = $(selectEl).val() || '';



    var html = '<option value="">Select Day | Date | Destination</option>';

    __dayOptions.forEach(function (r) {

        var key = makeDayKey(r);

        html += '<option value="' + key + '">' + buildDayOptionLabel(r) + '</option>';

    });



    $(selectEl).html(html);



    if (currentVal && $(selectEl).find('option[value="' + currentVal + '"]').length) {

        $(selectEl).val(currentVal);

    } else {

        $(selectEl).val('');

    }



    initSelect2(selectEl, 'Select Day | Date | Destination');

}



function fillPropertySelect(selectEl, dayKey) {

    if (!selectEl) return;



    var html = '<option value="">Select Property</option>';

    var rows = __dayPropertyMap[dayKey] || [];



    rows.forEach(function (r) {

        html += '<option value="' + r.property_id + '">' + r.property_name + '</option>';

    });



    selectEl.innerHTML = html;

    initSelect2(selectEl, 'Select Property');

}



function fillInclusionSelect(selectEl, propertyId) {

    if (!selectEl) return;



    var html = '<option value="">Select Inclusion</option>';

    var rows = __propertyInclusionMap[propertyId] || [];



    rows.forEach(function (r) {

        html += '<option value="' + r.property_inclusions_id + '" data-amount="' + (r.property_inclusions_amount || 0) + '">' +

                    r.property_inclusions_name +

                '</option>';

    });



    selectEl.innerHTML = html;

    initSelect2(selectEl, 'Select Inclusion');

}



// function clearPropertySelect(selectEl) {

//     if (!selectEl) return;



//     $(selectEl).html('<option value="">Select Property</option>').val('');

//     initSelect2(selectEl, 'Select Property');

//     $(selectEl).trigger('change.select2');

// }



// function clearInclusionSelect(selectEl) {

//     if (!selectEl) return;



//     $(selectEl).html('<option value="">Select Inclusion</option>').val('');

//     initSelect2(selectEl, 'Select Inclusion');

//     $(selectEl).trigger('change.select2');

// }



function clearPropertySelect(selectEl) {

    setSelect2Empty(selectEl, 'Select Property');

}



function clearInclusionSelect(selectEl) {

    setSelect2Empty(selectEl, 'Select Inclusion');

}



document.getElementById('addSpecialReqBtn').addEventListener('click', function (e) {

    e.preventDefault();



    var tbody = document.querySelector('#specialReqTable tbody');

    tbody.insertAdjacentHTML('beforeend', createSpecialReqRow());



    var row = tbody.lastElementChild;



    fillDaySelect(row.querySelector('.specialReqDaySelect'));



    if (typeof recalcSpecialReqTotal === 'function') {

        recalcSpecialReqTotal();

    }

});







function isPackageSelected() {

    return $('#packages_id_fk').val() !== '';

}



function hasValidOptionSelected() {

    let valid = false;



    document.querySelectorAll('.propertyDropdown').forEach(el => {

        if (el.value && el.value !== '') {

            valid = true;

        }

    });



    return valid;

}



/* ================= LOAD DROPDOWNS (call on package/lead change) ================= */



function loadInclusionAndRequirementDropdownData(callback) {

    var leadId = $('#leads_id_hidden').val() || $('#leads_id').val() || '';

    var packageId = $('#packages_id_hidden').val() || $('#packages_id_fk').val() || '';



    if (!leadId || !packageId) {

        if (typeof callback === 'function') callback();

        return;

    }



    var urlDays =

        `<?php echo base_url(); ?>index.php/Quotation/ajax_get_accommodation_day_options?lead_id=${encodeURIComponent(leadId)}&package_id=${encodeURIComponent(packageId)}`;



    var urlReq =

        `<?php echo base_url(); ?>index.php/Quotation/ajax_get_special_requirements`;



    Promise.all([

        fetch(urlDays).then(function (r) { return r.json(); }),

        fetch(urlReq).then(function (r) { return r.json(); })

    ])

    .then(function (result) {

        var daysRes = result[0];

        var reqRes = result[1];



        __dayOptions = (daysRes && daysRes.status && Array.isArray(daysRes.data)) ? daysRes.data : [];

        __specialReqOptions = (reqRes && reqRes.status && Array.isArray(reqRes.data)) ? reqRes.data : [];



        document.querySelectorAll('.inclusionDaySelect').forEach(function (el) {

            fillDaySelect(el);

        });



        document.querySelectorAll('.specialReqDaySelect').forEach(function (el) {

            fillDaySelect(el);

        });



        if (typeof recalcInclusionTotal === 'function') {

            recalcInclusionTotal();

        }



        if (typeof recalcSpecialReqTotal === 'function') {

            recalcSpecialReqTotal();

        }



        if (typeof callback === 'function') callback();

    })

    .catch(function (err) {

        console.error(err);

        if (typeof callback === 'function') callback();

    });

}

// Call it when lead/package changes:



// // âœ… if you still also use visible package dropdown somewhere else



////***For open modal of quotation adding form  *****///



function clearQuotationOnPackageChange() {



    // â— clear option blocks

    // $('#optionsContainer').empty();

    $('.optionBlock').remove();



    if (typeof optionCount !== 'undefined') {

        optionCount = 0;

    }



    // â— uncheck checkboxes

    $('#quotation_property_inclusion_type').prop('checked', false);

    $('#quotation_special_requirement_type').prop('checked', false);



    // â— hide boxes

    $('#inclusionBox').hide();

    $('#specialReqBox').hide();



    // ===== PROPERTY INCLUSION RESET =====

    const $incTbody = $('#inclusionTable tbody');



    if ($incTbody.length) {

        $incTbody.find('tr:gt(0)').remove();



        const $first = $incTbody.find('tr:eq(0)');

        $first.find('input').val('');

        $first.find('select').val('').trigger('change');



        // reset dropdown options if needed

        $first.find('.inclusionPropertySelect').html('<option value="">Select Property</option>');

        $first.find('.inclusionNameSelect').html('<option value="">Select Inclusion</option>');



        $first.find('.removeInclusionBtn').prop('disabled', false);

    }



    // ===== SPECIAL REQUIREMENT RESET =====

    const $spTbody = $('#specialReqTable tbody');



    if ($spTbody.length) {

        $spTbody.find('tr:gt(0)').remove();



        const $first = $spTbody.find('tr:eq(0)');

        $first.find('input').val('');

        $first.find('select').val('').trigger('change');



        $first.find('.removeSpecialReqBtn').prop('disabled', false);

    }



    // â— reset totals

    $('#totalInclusionAmountText').text('0.00');

    $('#totalInclusionAmountInput').val('0');



    $('#totalSpecialReqAmountText').text('0.00');

    $('#totalSpecialReqAmountInput').val('0');



    // â— clear cached data

    if (typeof __dayOptions !== 'undefined') __dayOptions = [];

    if (typeof __specialReqOptions !== 'undefined') __specialReqOptions = [];

    if (typeof __dayPropertyMap !== 'undefined') __dayPropertyMap = {};

    if (typeof __propertyInclusionMap !== 'undefined') __propertyInclusionMap = {};



    // âœ… reset scroll position

    $('#QuotationModal .modal-body').scrollTop(0);



    // âœ… fix bootstrap scroll recalculation

    setTimeout(function () {

        $('#QuotationModal').modal('handleUpdate');

    }, 100);

}



$(document).on('change', '#packages_id_fk, #leads_id', function () {

    loadInclusionAndRequirementDropdownData();

    clearQuotationOnPackageChange();

      // âœ… fix bootstrap scroll recalculation

    setTimeout(function () {

        $('#QuotationModal').modal('handleUpdate');

    }, 100);

});



// âœ… Select2-safe trigger

$(document).on('select2:select', '#packages_id_fk, #leads_id', function () {

    loadInclusionAndRequirementDropdownData();

    clearQuotationOnPackageChange();

      // âœ… fix bootstrap scroll recalculation

    setTimeout(function () {

        $('#QuotationModal').modal('handleUpdate');

    }, 100);

});



/* ================= ROW TEMPLATES ================= */



function createInclusionRow() {

    return `

        <tr>

            <td>

                <select class="form-select form-select-sm inclusionPackageOptionSelect" name="package_option_id_fk[]">

                    <option value="">Select Template Option</option>

                </select>

            </td>

            <td>

                <select class="form-select form-select-sm inclusionDaySelect" name="inclusion_day_key[]">

                    <option value="">Select Day | Date | Destination</option>

                </select>

            </td>

            <td>

                <select class="form-select form-select-sm inclusionPropertySelect" name="inclusion_property_id_fk[]">

                    <option value="">Select Property</option>

                </select>

            </td>

            <td>

                <select class="form-select form-select-sm inclusionNameSelect" name="inclusion_name_id_fk[]">

                    <option value="">Select Inclusion</option>

                </select>

            </td>

            <td class="amount-col">

    <input type="number"

           class="form-control form-control-sm inclusionAmountInput"

           name="inclusion_amount[]"

           placeholder="Amount">

</td>

            <td>

                <button type="button" class="btn btn-danger btn-sm removeInclusionBtn">X</button>

            </td>

        </tr>

    `;

}





function fillInclusionPackageOptionSelect(selectEl, selectedValue) {

    if (!selectEl) return;



    var currentValue = selectedValue || $(selectEl).val() || '';

    var html = '<option value="">Select Template Option</option>';



    $('.optionBlock').each(function () {

        var val  = $(this).find('.propertyDropdown').val() || '';

        var text = $(this).find('.propertyDropdown option:selected').text() || '';



        if (val) {

            html += '<option value="' + val + '">' + text + '</option>';

        }

    });



    $(selectEl).html(html);



    if (currentValue) {

        $(selectEl).val(currentValue);

    }



    initSelect2(selectEl, 'Select Template Option');

    $(selectEl).trigger('change.select2');

}



document.getElementById('addInclusionBtn').addEventListener('click', function (e) {

    e.preventDefault();



    const tbody = document.querySelector('#inclusionTable tbody');

    tbody.insertAdjacentHTML('beforeend', createInclusionRow());



    const row = tbody.lastElementChild;



    fillInclusionPackageOptionSelect(row.querySelector('.inclusionPackageOptionSelect'));

    fillDaySelect(row.querySelector('.inclusionDaySelect')); // initially empty/reset later

    clearPropertySelect(row.querySelector('.inclusionPropertySelect'));

    clearInclusionSelect(row.querySelector('.inclusionNameSelect'));

});



document.querySelectorAll('.inclusionPackageOptionSelect').forEach(function (el) {

    fillInclusionPackageOptionSelect(el);

});





function createSpecialReqRow() {

    return `

        <tr>

            <td>

                <select class="form-select form-select-sm specialReqDaySelect" name="specialreq_day_key[]">

                    <option value="">Select Day | Date | Destination</option>

                </select>

            </td>

            <td>

                <input type="text" class="form-control form-control-sm specialReqName"

                       name="quotation_special_requirements_name[]" placeholder="Enter Requirement">

            </td>

            <td>

                <input type="number" class="form-control form-control-sm specialReqCost"

                       name="special_requirements_cost[]" placeholder="Amount">

            </td>

            <td class="text-center">

                <button type="button" class="btn btn-sm btn-danger removeSpecialReqBtn">

                    <i class="bi bi-trash"></i>

                </button>

            </td>

        </tr>

    `;

}

/* ================= ADD/REMOVE ROWS ================= */



function refreshQuotationModalScroll(keepPosition) {

    setTimeout(function () {

        var $modal = $('#QuotationModal');

        var body = $modal.find('.modal-body')[0];



        if (body) {

            var oldTop = body.scrollTop;



            body.style.overflowY = 'auto';

            body.style.overflowX = 'hidden';

            body.style.maxHeight = 'none';

            body.style.minHeight = '0';



            if (keepPosition) {

                body.scrollTop = oldTop;

            }

        }



        if ($modal.hasClass('show')) {

            $modal.modal('handleUpdate');

        }

    }, 120);

}



function setSelect2Loading(selectEl, loadingText) {

    if (!selectEl) return;



    var $el = $(selectEl);



    if ($el.hasClass('select2-hidden-accessible')) {

        $el.select2('destroy');

    }



    $el.prop('disabled', true)

       .html('<option value="">' + (loadingText || 'Loading...') + '</option>')

       .val('');



    initSelect2(selectEl, loadingText || 'Loading...');

}



function setSelect2Ready(selectEl, html, placeholder) {

    if (!selectEl) return;



    var $el = $(selectEl);



    if ($el.hasClass('select2-hidden-accessible')) {

        $el.select2('destroy');

    }



    $el.html(html)

       .val('')

       .prop('disabled', false);



    initSelect2(selectEl, placeholder || 'Select');

    refreshQuotationModalScroll(true);

}



function setSelect2Empty(selectEl, placeholder) {

    if (!selectEl) return;



    var $el = $(selectEl);



    if ($el.hasClass('select2-hidden-accessible')) {

        $el.select2('destroy');

    }



    $el.html('<option value="">' + (placeholder || 'Select') + '</option>')

       .val('')

       .prop('disabled', true);



    initSelect2(selectEl, placeholder || 'Select');

}



// $(document).on('change', '.inclusionDaySelect', function () {

//     var row = this.closest('tr');

//     if (!row) return;



//     var dayKey = $(this).val() || '';

//     var leadId = $('#leads_id_hidden').val() || $('#leads_id').val() || '';

//     var packageId = $('#packages_id_hidden').val() || $('#packages_id_fk').val() || '';

//     var packageOptionId = $(row).find('.inclusionPackageOptionSelect').val() || '';



//     var propSel = row.querySelector('.inclusionPropertySelect');

//     var incSel = row.querySelector('.inclusionNameSelect');

//     var amtEl = row.querySelector('.inclusionAmountInput');



//     clearPropertySelect(propSel);

//     clearInclusionSelect(incSel);

//     if (amtEl) amtEl.value = '';



//     if (!dayKey || !leadId || !packageId || !packageOptionId) return;



//     fetch(

//         `<?php echo base_url(); ?>index.php/Quotation/ajax_get_daywise_properties_for_inclusion?lead_id=${encodeURIComponent(leadId)}&package_id=${encodeURIComponent(packageId)}&day_key=${encodeURIComponent(dayKey)}&packages_properties_common_id_fk=${encodeURIComponent(packageOptionId)}`

//     )

//     .then(function (r) { return r.json(); })

//     .then(function (res) {

//         var html = '<option value="">Select Property</option>';



//         if (res && res.status && Array.isArray(res.data)) {

//             res.data.forEach(function (p) {

//                 html += '<option value="' + p.property_id + '">' + p.property_name + '</option>';

//             });

//         }



//         $(propSel).html(html).val('');

//         initSelect2(propSel, 'Select Property');



//         clearInclusionSelect(incSel);

//     })

//     .catch(function (err) {

//         console.error(err);

//     });

// });



$(document).on('change', '.inclusionDaySelect', function () {

    var row = this.closest('tr');

    if (!row) return;



    var dayKey = $(this).val() || '';

    var leadId = $('#leads_id_hidden').val() || $('#leads_id').val() || '';

    var packageId = $('#packages_id_hidden').val() || $('#packages_id_fk').val() || '';

    var packageOptionId = $(row).find('.inclusionPackageOptionSelect').val() || '';



    var propSel = row.querySelector('.inclusionPropertySelect');

    var incSel = row.querySelector('.inclusionNameSelect');

    var amtEl = row.querySelector('.inclusionAmountInput');



    if (amtEl) amtEl.value = '';



    // lock property and inclusion first

    setSelect2Empty(incSel, 'Select Inclusion');

    setSelect2Loading(propSel, 'Loading Property...');



    if (!dayKey || !leadId || !packageId || !packageOptionId) {

        setSelect2Empty(propSel, 'Select Property');

        setSelect2Empty(incSel, 'Select Inclusion');

        refreshQuotationModalScroll(true);

        return;

    }



    fetch(

        `<?php echo base_url(); ?>index.php/Quotation/ajax_get_daywise_properties_for_inclusion?lead_id=${encodeURIComponent(leadId)}&package_id=${encodeURIComponent(packageId)}&day_key=${encodeURIComponent(dayKey)}&packages_properties_common_id_fk=${encodeURIComponent(packageOptionId)}`

    )

    .then(function (r) { return r.json(); })

    .then(function (res) {

        var html = '<option value="">Select Property</option>';



        if (res && res.status && Array.isArray(res.data) && res.data.length > 0) {

            res.data.forEach(function (p) {

                html += '<option value="' + p.property_id + '">' + p.property_name + '</option>';

            });



            setSelect2Ready(propSel, html, 'Select Property');

        } else {

            setSelect2Empty(propSel, 'No Property Found');

        }



        setSelect2Empty(incSel, 'Select Inclusion');

        refreshQuotationModalScroll(true);

    })

    .catch(function (err) {

        console.error(err);

        setSelect2Empty(propSel, 'Failed to load Property');

        setSelect2Empty(incSel, 'Select Inclusion');

        refreshQuotationModalScroll(true);

    });

});



// $(document).on('change', '.inclusionPropertySelect', function () {

//     var row = this.closest('tr');

//     if (!row) return;



//     var propertyId = $(this).val() || '';

//     var incSel = row.querySelector('.inclusionNameSelect');

//     var amtEl = row.querySelector('.inclusionAmountInput');



//     clearInclusionSelect(incSel);

//     if (amtEl) amtEl.value = '';



//     if (!propertyId) return;



//     fetch(`<?php echo base_url(); ?>index.php/Quotation/ajax_get_property_inclusions_by_property?property_id=${encodeURIComponent(propertyId)}`)

//         .then(function (r) { return r.json(); })

//         .then(function (res) {

//             var html = '<option value="">Select Inclusion</option>';



//             if (res && res.status && Array.isArray(res.data)) {

//                 res.data.forEach(function (item) {

//                     html += '<option value="' + item.property_inclusions_id + '" data-amount="' + (item.property_inclusions_amount || 0) + '">' +

//                                 item.property_inclusions_name +

//                             '</option>';

//                 });

//             }



//             $(incSel).html(html).val('');

//             initSelect2(incSel, 'Select Inclusion');

//         })

//         .catch(function (err) {

//             console.error(err);

//         });

// });



$(document).on('change', '.inclusionPropertySelect', function () {

    var row = this.closest('tr');

    if (!row) return;



    var propertyId = $(this).val() || '';

    var incSel = row.querySelector('.inclusionNameSelect');

    var amtEl = row.querySelector('.inclusionAmountInput');



    if (amtEl) amtEl.value = '';



    setSelect2Loading(incSel, 'Loading Inclusion...');



    if (!propertyId) {

        setSelect2Empty(incSel, 'Select Inclusion');

        refreshQuotationModalScroll(true);

        return;

    }



    fetch(`<?php echo base_url(); ?>index.php/Quotation/ajax_get_property_inclusions_by_property?property_id=${encodeURIComponent(propertyId)}`)

        .then(function (r) { return r.json(); })

        .then(function (res) {

            var html = '<option value="">Select Inclusion</option>';



            if (res && res.status && Array.isArray(res.data) && res.data.length > 0) {

                res.data.forEach(function (item) {

                    html += '<option value="' + item.property_inclusions_id + '" data-amount="' + (item.property_inclusions_amount || 0) + '">' +

                                item.property_inclusions_name +

                            '</option>';

                });



                setSelect2Ready(incSel, html, 'Select Inclusion');

            } else {

                setSelect2Empty(incSel, 'No Inclusion Found');

            }



            refreshQuotationModalScroll(true);

        })

        .catch(function (err) {

            console.error(err);

            setSelect2Empty(incSel, 'Failed to load Inclusion');

            refreshQuotationModalScroll(true);

        });

});



$(document).on('change', '.inclusionNameSelect', function () {

    var row = this.closest('tr');

    if (!row) return;



    var amtEl = row.querySelector('.inclusionAmountInput');

    var opt = this.options[this.selectedIndex];

    var amount = opt ? (opt.getAttribute('data-amount') || '0') : '0';



    if (amtEl) amtEl.value = amount;



    recalcInclusionTotal();

});



$(document).on('input', '.inclusionAmountInput', function () {

    recalcInclusionTotal();

});



$(document).on('select2:select', '.inclusionNameSelect', function () {

    $(this).trigger('change');

});





document.addEventListener('click', function (e) {

  if (e.target.closest('.removeInclusionBtn')) {

    e.target.closest('tr').remove();

    recalcInclusionTotal();

  }

});





document.addEventListener('click', function (e) {

  if (e.target.closest('.removeSpecialReqBtn')) {

    e.target.closest('tr').remove();

    recalcSpecialReqTotal();

  }

});





/* ================= AUTO-FILL COST WHEN SELECT REQUIREMENT ================= */





function num(v) {

  const n = parseFloat(v);

  return isNaN(n) ? 0 : n;

}



function money(n) {

  return num(n).toFixed(2);

}



/* âœ… Recalculate inclusion total */

function recalcInclusionTotal() {

  let total = 0;

  document.querySelectorAll('#inclusionTable tbody [name="inclusion_amount[]"]').forEach(inp => {

    total += num(inp.value);

  });



  const txt = document.getElementById('totalInclusionAmountText');

  const hid = document.getElementById('totalInclusionAmountInput');

  if (txt) txt.textContent = money(total);

  if (hid) hid.value = money(total);



  return total;

}



/* âœ… Recalculate special requirements total */

function recalcSpecialReqTotal() {

  let total = 0;

  document.querySelectorAll('#specialReqTable tbody [name="special_requirements_cost[]"]').forEach(inp => {

    total += num(inp.value);

  });



  const txt = document.getElementById('totalSpecialReqAmountText');

  const hid = document.getElementById('totalSpecialReqAmountInput');

  if (txt) txt.textContent = money(total);

  if (hid) hid.value = money(total);



  return total;

}



/* âœ… Recalculate both (use after add/remove/load) */

function recalcAllInclusionSpecialTotals() {

  recalcInclusionTotal();

  recalcSpecialReqTotal();

}



/* Live update on typing amount fields */

document.addEventListener('input', function (e) {

  if (e.target.matches('#inclusionTable tbody [name="inclusion_amount[]"]')) {

    recalcInclusionTotal();

  }

  if (e.target.matches('#specialReqTable tbody [name="special_requirements_cost[]"]')) {

    recalcSpecialReqTotal();

  }

});



let optionCount = 0;



/* ================= ENABLE ADD OPTION AFTER PACKAGE ================= */



const packageSelect = document.getElementById('packages_id_fk');

const addOptionBtn = document.getElementById('addOptionBtn');

const optionsContainer = document.getElementById('optionsContainer');



packageSelect.addEventListener('change', () => {

  alert("dd")

    addOptionBtn.disabled = !packageSelect.value;

    optionsContainer.innerHTML = '';

    optionCount = 0;

    // loadDayDestOptionsForInclusionAndReq();

});



/* ================= ADD OPTION ================= */



document.getElementById('addOptionBtn')?.addEventListener('click', function (e) {

    e.preventDefault();

    e.stopPropagation();



    optionCount++;



    optionsContainer.insertAdjacentHTML('beforeend', getOptionTemplate(optionCount));



    const optionBlock = optionsContainer.lastElementChild;

    const dropdown = optionBlock.querySelector('.propertyDropdown');

    const vehicleDropdown = optionBlock.querySelector('.vehicle-select');



    fetchPropertyCategories(dropdown);

    fetchVehicles(vehicleDropdown);



    if ($.fn.select2) {

        $(optionBlock).find('.design-type-select').select2({

            width: '100%',

            placeholder: 'Select Design',

            allowClear: true,

            dropdownParent: $('#QuotationModal')

        });



        $(optionBlock).find('.vehicle-select').select2({

            width: '100%',

            placeholder: 'Select Vehicle',

            allowClear: true,

            dropdownParent: $('#QuotationModal')

        });



        $(optionBlock).find('.propertyDropdown').select2({

            width: '100%',

            placeholder: 'Select template option',

            allowClear: true,

            dropdownParent: $('#QuotationModal')

        });

    }



    reIndexOptions();

// clearQuotationOnPackageChange();

      // âœ… fix bootstrap scroll recalculation

    setTimeout(function () {

        $('#QuotationModal').modal('handleUpdate');

    }, 100);

});



function fetchVehicles(dropdown, callback) {

    if (!dropdown) return;



    dropdown.innerHTML = '<option value="">Loading...</option>';



    fetch(`<?php echo base_url(); ?>index.php/Quotation/ajax_get_vehicle_list`)

        .then(res => res.json())

        .then(res => {

            dropdown.innerHTML = '<option value="">Select Vehicle</option>';

            if (res.status && res.data) {

                res.data.forEach(item => {

                    const opt = document.createElement('option');

                    opt.value = item.vehicle_id;

                    opt.textContent = item.vehicle_name + ' (' + item.vehicle_number_seat + ')';

                    dropdown.appendChild(opt);

                });

            }

            if (typeof callback === 'function') callback();

        })

        .catch(() => {

            dropdown.innerHTML = '<option value="">Failed to load vehicle</option>';

            if (typeof callback === 'function') callback();

        });

}



/* ================= LOAD ITINERARY ON OPTION SELECT ================= */



// âœ… store old value BEFORE dropdown opens

$(document).on('select2:opening', '.propertyDropdown', function () {

    $(this).data('old-value', $(this).val() || '');

});



// âœ… validate on change (duplicate check disabled)

$(document).on('change', '.propertyDropdown', function () {

    // Allow duplicate template option selection

});



$(document).on('change', '.propertyDropdown', function () {

    var dropdown = this;

    if (!dropdown) return;



    const optionBlock = dropdown.closest('.optionBlock');

    if (!optionBlock) return;



    const commonId = dropdown.value;



    const selectedOption = dropdown.options[dropdown.selectedIndex];

    const designType = selectedOption ? (selectedOption.getAttribute('data-design-type') || '') : '';

    const optionText = selectedOption ? (selectedOption.textContent || '').trim() : '';



    // Auto-fill option title from selected template option

    const titleInput = optionBlock.querySelector('[name="quotation_options_title[]"]');

    if (titleInput && optionText && optionText !== 'Select template option') {

        titleInput.value = optionText;

    }



    const designDropdown = optionBlock.querySelector('.design-type-select');

    if (designDropdown) {

        designDropdown.value = designType;

        if ($.fn.select2 && $(designDropdown).hasClass('select2-hidden-accessible')) {

            $(designDropdown).trigger('change');

        }

    }



    if (!commonId) return;



    loadItinerary(optionBlock, commonId);

});



$(document).on('select2:select', '.propertyDropdown', function () {

    $(this).trigger('change');

});

/* ================= REMOVE OPTION ================= */





document.addEventListener('click', function (e) {

    const btn = e.target.closest('.removeOptionBtn');

    if (!btn) return;



    e.preventDefault();

    e.stopPropagation();



    const uid = btn.getAttribute('data-remove-uid');

    if (!uid) return;



    const block = document.querySelector('.optionBlock[data-option-uid="' + uid + '"]');

    if (block) {

        block.remove();

    }



    reIndexOptions();

});



/* ================= HELPERS ================= */





function reIndexOptions() {

    const blocks = document.querySelectorAll('.optionBlock');

    optionCount = blocks.length;



    blocks.forEach((block, i) => {

        const newIndex = i + 1;



        block.dataset.optionIndex = newIndex;



        const titleEl = block.querySelector('.optionTitle');

        if (titleEl) {

            titleEl.innerText = 'Option ' + newIndex;

        }



        const removeBtn = block.querySelector('.removeOptionBtn');

        if (removeBtn) {

            if (blocks.length === 1) {

                removeBtn.classList.add('d-none');

            } else {

                removeBtn.classList.remove('d-none');

            }

        }

    });

}



/* ================= FETCH PROPERTY OPTIONS ================= */



function fetchPropertyCategories(dropdown) {



    // const packageId = packageSelect.value;

    const packageId = document.getElementById('packages_id_hidden')?.value || '';

    if (!packageId) return;



    dropdown.innerHTML = '<option>Loading...</option>';



    fetch(`<?php echo base_url(); ?>index.php/Quotation/get_property_categories_by_package?package_id=${packageId}`)

        .then(res => res.json())

        .then(res => {

            dropdown.innerHTML = '<option value="">Select template option</option>';

            if (!res.status) return;



            // res.data.forEach(item => {

            //     const opt = document.createElement('option');

            //     opt.value = item.packages_properties_common_id;

            //     opt.textContent = item.packages_properties_common_category_name;

            //     dropdown.appendChild(opt);

            // });

            

            res.data.forEach(item => {

                const opt = document.createElement('option');

                opt.value = item.packages_properties_common_id;

                opt.textContent = item.packages_properties_common_category_name;

                opt.setAttribute('data-design-type', item.packages_properties_common_design_type || '');

                dropdown.appendChild(opt);

            });



            if ($.fn.select2) {

                $(dropdown).select2({

                    width: '100%',

                    placeholder: 'Select template option',

                    allowClear: true,

                    dropdownParent: $('#QuotationModal')

                });

            }

        });

}



/* ================= LOAD FULL ITINERARY ================= */



function formatDateDMY(dateStr) {

    if (!dateStr) return '';



    const parts = dateStr.split('-');

    if (parts.length !== 3) return dateStr;



    return parts[2] + '/' + parts[1] + '/' + parts[0];

}



$(document).on('change', '.optionAmountType', function () {

    var $block = $(this).closest('.option-total-box');

    var val = $(this).val();



    var input = $block.find('.optionPerAmount');



    if (val === 'adult' || val === 'person' || val === 'couple') {

        input.removeClass('d-none');

    } else {

        input.addClass('d-none').val('');

    }

});



function loadItinerary(optionBlock, commonId) {



    const container = optionBlock.querySelector('.itineraryContainer');

    if (!container) return;



    // âœ… Your select id is leads_id (from your HTML)

    const leadId = document.getElementById('leads_id_hidden')?.value

        || document.getElementById('leads_id')?.value

        || '';

    const packageId = document.getElementById('packages_id_hidden')?.value || '';



    // âœ… Debug (check in browser console)

    console.log('loadItinerary params =>', { leadId, packageId, commonId });



    if (!commonId || !leadId || !packageId) {

        container.innerHTML = `

            <p class="text-danger mb-0">

                Missing params: 

                commonId=${commonId || 'EMPTY'},

                leadId=${leadId || 'EMPTY'},

                packageId=${packageId || 'EMPTY'}.

                Please select Lead + Template + Template Option.

            </p>`;

        return;

    }



    container.innerHTML = '<p>Loading itinerary...</p>';



    const url =

        `<?php echo base_url(); ?>index.php/Quotation/get_package_full_itinerary` +

        `?packages_properties_common_id=${encodeURIComponent(commonId)}` +

        `&lead_id=${encodeURIComponent(leadId)}` +

        `&package_id=${encodeURIComponent(packageId)}`;



    fetch(url)

        .then(async (r) => {

            // âœ… read as text first to avoid JSON.parse crash

            const text = await r.text();

            console.log('API raw response:', text);



            if (!text || text.trim() === '') {

                throw new Error('Empty response from server');

            }



            try {

                return JSON.parse(text);

            } catch (err) {

                throw new Error('Response is not valid JSON. Check API raw response in console.');

            }

        })

        .then(res => {



            if (!res.status || !Array.isArray(res.data) || res.data.length === 0) {

                container.innerHTML = `<p class="text-warning mb-0">No accommodation days found for this lead/template.</p>`;

                return;

            }



            let html = `

                <div class="table-responsive">

                <table class="table table-bordered">

                    <thead style="background: #3949ab; color: #ffffff;">

                        <tr>

                            <th style="width: 100px; color: #ffffff;">Day | Date</th>

                            <th style="width: 140px; color: #ffffff;">Stay Destination</th>

                            <th style="color: #ffffff;">Properties & Rooms</th>

                        </tr>

                    </thead>

                    <tbody>

            `;



            res.data.forEach(day => {



                let propertyGroupsHTML = '';



                (day.properties || []).forEach(property => {



                    let roomsHTML = '';



                    (property.rooms || []).forEach(room => {

                        roomsHTML += `

                            <tr class="room-row" data-room-id="${room.properties_room_category_id || ''}" data-packages-room-id="${room.packages_properties_rooms_id || 0}"

                                data-day-id="${day.packages_properties_days_id || 0}">

                                <td class="property-ref-cell text-muted" style="border-left:3px solid #0d6efd;"></td>

                                <td class="roomName">

                                    ${room.properties_room_category_name || ''}

                                    <input type="hidden" name="packages_properties_rooms_id_fk[]" value="${room.packages_properties_rooms_id || 0}">

                                    <input type="hidden" name="quotation_properties_rooms_id_fk[]" value="${room.properties_room_category_id || 0}">

                                    <input type="hidden" name="quotation_room_tariff_details_id[]" class="quotationRoomTariffDetailsIdInput" value="${room.quotation_room_tariff_details_id || ''}">

                                </td>

                                <td class="roomRate">

                                    <span class="autoCalcRateText">0.00</span>

                                    <input type="hidden" name="total_room_cost[][]" class="autoCalcRateInput" value="0.00">

                                </td>

                                <td class="text-center">

                                    <button type="button"

                                        class="btn btn-sm btn-warning me-1 editRoomBtn"

                                        data-lead-id="${leadId}"

                                        data-property-day-id="${day.packages_properties_days_id}"

                                        data-stay-destination-id="${day.packages_properties_days_destination_id_fk}"

                                        data-property-id="${property.properties_id}"

                                        data-room-category-id="${room.properties_room_category_id}">

                                        <i class="bi bi-pencil"></i>

                                    </button>

                                    <button type="button" class="btn btn-sm btn-danger removeRoomBtn">

                                        <i class="bi bi-trash"></i>

                                    </button>

                                </td>

                            </tr>

                        `;

                    });



                    propertyGroupsHTML += `

                        <tbody class="property-group"

                               data-property-id="${property.properties_id || ''}"

                               data-packages-property-id="${property.packages_properties_id || 0}">

                            <tr class="property-group-header">

                                <td class="property-name-cell">${property.properties_name || ''}</td>

                                <td colspan="2"></td>

                                <td class="text-center">

                                    <button type="button" class="btn btn-sm btn-danger removePropertyBtn">

                                        <i class="bi bi-trash"></i>

                                    </button>

                                    <input type="hidden" name="packages_properties_id_fk[]" value="${property.packages_properties_id || 0}">

                                    <input type="hidden" name="properties_id_fk[]" value="${property.properties_id || 0}">

                                </td>

                            </tr>

                            ${roomsHTML}

                            <tr class="add-room-row">

                                <td colspan="4" class="text-center">

                                    <button type="button" class="btn btn-sm btn-success addRoomBtn">

                                        <i class="bi bi-plus-circle"></i> Add Room

                                    </button>

                                </td>

                            </tr>

                        </tbody>

                    `;

                });



                let hasProperties = propertyGroupsHTML !== '';



                html += `

                    <tr class="itineraryDayRow" data-itinerary-day-id="${day.packages_itinerary_days_id_fk || 0}">

                        <td>

                            <strong>${day.packages_properties_days_day || ''} | ${formatDateDMY(day.accommodation_date)}</strong>

                            <input type="hidden" name="packages_properties_days_id_fk[]" value="${day.packages_properties_days_id || 0}">

                            <input type="hidden" name="packages_itinerary_days_id_fk[]" value="${day.packages_itinerary_days_id_fk || 0}">

                            <input type="hidden" name="quotation_properties_days_day[]" value="${day.packages_properties_days_day || ''}">

                            <input type="hidden" name="accommodation_plan_id_fk[]" value="${day.accommodation_plan_id || 0}">

                        </td>



                        <td>

                            ${day.state_name || ''}

                            <input type="hidden" name="quotation_properties_days_destination_id_fk[]" value="${day.packages_properties_days_destination_id_fk || 0}">

                        </td>



                        <td>

                            <div class="propertiesContainer">

                                <table class="table table-sm table-bordered unified-property-table">

                                    <thead class="table-light">

                                        <tr>

                                            <th style="width:22%">Property</th>

                                            <th style="width:28%">Room Name</th>

                                            <th style="width:20%">Calculated Rate</th>

                                            <th style="width:30%" class="text-center">Action</th>

                                        </tr>

                                    </thead>

                                    ${hasProperties ? propertyGroupsHTML : ''}

                                    <tfoot>

                                        <tr class="add-property-row">

                                            <td colspan="4" class="text-center">

                                                <button type="button" class="btn btn-sm btn-primary addPropertyBtn">

                                                    <i class="bi bi-plus-square"></i> Add Property

                                                </button>

                                            </td>

                                        </tr>

                                    </tfoot>

                                </table>

                            </div>



                            <div class="propertySelector d-none mt-2 border rounded p-2 bg-light">

                                <div class="d-flex gap-2 align-items-start">

                                    <div class="flex-grow-1">

                                        <select class="form-select form-select-sm propertySelectDropdown">

                                            <option value="">Select Property</option>

                                        </select>

                                    </div>

                                    <button type="button" class="btn btn-sm btn-danger removePropertySelectorBtn" title="Remove">

                                        <i class="bi bi-trash"></i>

                                    </button>

                                </div>

                            </div>

                        </td>

                    </tr>

                `;

            });



            html += `</tbody></table><!-- ================= OPTION TOTAL SUMMARY ================= -->

<div class="option-total-box border rounded p-3 mt-4 bg-light">



  <div class="row g-3 align-items-end">



  <!-- Total Cost -->

  <div class="col-md-3">

    <label class="form-label fw-semibold" style="font-size: 13px;">Total Cost</label>

    <div class="quote-amount-highlight d-inline-block px-3 py-2 rounded">

      &#8377; <span class="optionTotalCostText">0.00</span>

    </div>

    <input type="hidden" class="optionTotalCostInput" name="option_total_cost[]">

  </div>



  <!-- Amount Type -->

  <div class="col-md-3">

    <label class="form-label fw-semibold" style="font-size: 13px;">Amount Type</label>

    <div class="d-flex gap-3">

      <select class="form-select form-select-sm optionAmountType" style="width:50%;">

        <option value="net">Net Amount</option>

        <option value="adult">Per Adult</option>

        <option value="person">Per Person</option>

        <option value="couple">Per Couple</option>

      </select>



      <input type="number"

             class="form-control form-control-sm optionPerAmount d-none"

             style="width:50%;"

             placeholder="Amount">

    </div>

  </div>



  <!-- Margin -->

  <div class="col-md-3">

    <label class="form-label fw-semibold" style="font-size: 13px;">Margin</label>

    <div class="d-flex gap-3">

      <select class="form-select form-select-sm optionMarginType" style="width:50%;">

        <option value="amount">Amount</option>

        <option value="percent">%</option>

      </select>



      <input type="number"

             class="form-control form-control-sm optionMarginValue"

             style="width:50%;"

             placeholder="Margin">

    </div>

  </div>



  <!-- Total Quote Rate -->

  <div class="col-md-3">

    <label class="form-label fw-semibold" style="font-size: 13px;">Total Quote Rate</label>

    <div class="quote-amount-highlight d-inline-block px-3 py-2 rounded">

      &#8377; <span class="optionQuoteTotalText">0.00</span>

    </div>

    <input type="hidden" class="optionQuoteTotalInput" name="option_quote_total[]">

  </div>



</div>

</div>`;

            container.innerHTML = html;

        })

        .catch(err => {

            console.error(err);

            container.innerHTML = `<p class="text-danger mb-0">${err.message}</p>`;

        });

}







/* ================= TEMPLATE ================= */





function getOptionTemplate(index) {

    const uid = 'option_' + Date.now() + '_' + Math.floor(Math.random() * 10000);



    return `

    <div class="optionBlock border p-3 mb-4"

         data-option-index="${index}"

         data-option-uid="${uid}">

         

        <button class="optionTitle" type="button" data-bs-toggle="collapse" data-bs-target="#collapseOption${uid}" aria-expanded="true" aria-controls="collapseOption${uid}">

            Option ${index}

        </button>

        <div class="collapse show" id="collapseOption${uid}">

        <div class="row mb-3 g-3">

            <div class="col-md-2">

                <label>Select template option</label>

                <select name="packages_properties_common_id_fk[]" class="form-select form-select-sm propertyDropdown">

                    <option value="">Select template option</option>

                </select>

            </div>



            <div class="col-md-2">

                <label>Name of the option</label>

                <input type="text" name="quotation_options_title[]" class="form-control form-control-sm">

            </div>



            <div class="col-md-2">

                <label>Cab amount</label>

                <input type="number" name="quotation_options_cab_amount[]" class="form-control form-control-sm">

            </div>



            <div class="col-md-2">

                <label>Select Design</label>

                <select name="quotation_options_design_type[]" class="form-select form-select-sm design-type-select">

                    <option value="">Select Design</option>

                    <option value="Standard">Standard</option>

                    <option value="Exclusive">Exclusive</option>

                </select>

            </div>



            <div class="col-md-2">

                <label>Select Vehicle</label>

                <select name="quotation_options_vehicle_id_fk[]" class="form-select form-select-sm vehicle-select">

                    <option value="">Select Vehicle</option>

                </select>

            </div>



            <div class="col-md-2 d-flex align-items-end justify-content-end">

                <button type="button"

                        class="btn btn-danger removeOptionBtn ${index === 1 ? 'd-none' : ''}"

                        data-remove-uid="${uid}">

                    <i class="bi bi-trash"></i>

                </button>

            </div>

        </div>



        <div class="row mb-3">

            <div class="col-md-3">

                <div class="form-check mt-2">

                    <input class="form-check-input room-category-display-checkbox"

                           type="checkbox"

                           name="quotation_options_room_category_display[]"

                           value="1"

                           checked>

                    <label class="form-check-label">

                        Show Room Category

                    </label>

                </div>

            </div>



            <div class="col-md-3">

                <div class="form-check mt-2">

                    <input class="form-check-input meal-plan-display-checkbox"

                           type="checkbox"

                           name="quotation_options_meal_plan_display[]"

                           value="1"

                           checked>

                    <label class="form-check-label">

                        Show Meal Plan

                    </label>

                </div>

            </div>



            <div class="col-md-3">

                <div class="form-check mt-2">

                    <input class="form-check-input vehicle-display-checkbox"

                        type="checkbox"

                        name="quotation_options_vehicle_display[]"

                        value="1"

                        checked>

                    <label class="form-check-label">

                        Show Vehicle

                    </label>

                </div>

            </div>

        </div>



        <div class="row mb-3">

            <div class="col-md-12">

                <div class="form-check">

                    <input class="form-check-input auto-calc-all-properties"

                           type="checkbox"

                           value="1">

                    <label class="form-check-label fw-bold text-primary">

                        Calculate room tariff for all properties

                    </label>

                </div>

                <small class="auto-calc-status text-muted" style="display:none;"></small>

            </div>

        </div>



        <div class="itineraryContainer"></div>

    </div>

    </div>

    `;

}

////////////********** *************///////////



function initModalSelect2(el, placeholderText) {

    if (!el) return;



    var $el = $(el);



    if ($el.hasClass('select2-hidden-accessible')) {

        $el.select2('destroy');

    }



    $el.select2({

        width: '100%',

        placeholder: placeholderText || 'Select',

        allowClear: true,

        dropdownParent: $('#QuotationModal')

    });

}





document.addEventListener('click', function (e) {



    const btn = e.target.closest('.addPropertyBtn');

    if (!btn) return;



    const dayRow = btn.closest('.itineraryDayRow');

    const selector = dayRow.querySelector('.propertySelector');

    const dropdown = selector ? selector.querySelector('.propertySelectDropdown') : null;



    if (!selector || !dropdown) {

        console.error('propertySelector or dropdown not found');

        return;

    }



    selector.classList.remove('d-none');



    if (dropdown.dataset.loaded === '1') {

        initModalSelect2(dropdown, 'Select Property');

        return;

    }



    dropdown.innerHTML = '<option value="">Loading...</option>';



    fetch(`<?php echo base_url(); ?>index.php/Quotation/get_properties`)

        .then(r => r.json())

        .then(r => {

            dropdown.innerHTML = '<option value="">Select Property</option>';



            if (r.status && Array.isArray(r.data)) {

                r.data.forEach(p => {

                    dropdown.innerHTML += `

                        <option value="${p.properties_id}">

                            ${p.properties_name}

                        </option>`;

                });

            }



            dropdown.dataset.loaded = '1';



            // âœ… init select2

            initModalSelect2(dropdown, 'Select Property');

        });

});





$(document).on('change', '.propertySelectDropdown', function () {



    const dropdown = this;

    const propertyId = dropdown.value;

    if (!propertyId) return;



    const dayRow = dropdown.closest('.itineraryDayRow');

    const propertiesContainer = dayRow.querySelector('.propertiesContainer');

    const unifiedTable = propertiesContainer ? propertiesContainer.querySelector('.unified-property-table') : null;



    const exists = [...(unifiedTable ? unifiedTable.querySelectorAll('.property-group') : [])]

        .some(group => group.dataset.propertyId === propertyId);



    if (exists) {

        alert('This property is already added for this day.');

        $(dropdown).val('').trigger('change');

        return;

    }



    const propertyName = dropdown.options[dropdown.selectedIndex].text;



    const newTbodyHTML = `

        <tbody class="property-group" data-property-id="${propertyId}" data-packages-property-id="0">

            <tr class="property-group-header">

                <td class="property-name-cell">${propertyName}</td>

                <td colspan="2"></td>

                <td class="text-center">

                    <button type="button" class="btn btn-sm btn-danger removePropertyBtn">

                        <i class="bi bi-trash"></i>

                    </button>

                    <input type="hidden" name="properties_id_fk[]" value="${propertyId}">

                    <input type="hidden" name="packages_properties_id_fk[]" value="0">

                </td>

            </tr>

            <tr class="add-room-row">

                <td colspan="4" class="text-center">

                    <button type="button" class="btn btn-sm btn-success addRoomBtn">

                        <i class="bi bi-plus-circle"></i> Add Room

                    </button>

                </td>

            </tr>

        </tbody>

    `;



    if (unifiedTable) {

        const tfoot = unifiedTable.querySelector('tfoot');

        if (tfoot) {

            tfoot.insertAdjacentHTML('beforebegin', newTbodyHTML);

        } else {

            unifiedTable.insertAdjacentHTML('beforeend', newTbodyHTML);

        }

    }



    $(dropdown).val('').trigger('change');

    dropdown.closest('.propertySelector').classList.add('d-none');

});



document.addEventListener('click', function (e) {

    const btn = e.target.closest('.removePropertyBtn');

    if (!btn) return;



    const propertyGroup = btn.closest('.property-group');

    if (propertyGroup) {

        propertyGroup.remove();

    }

});



$(document).on('click', '.removePropertySelectorBtn', function () {

    var $selector = $(this).closest('.propertySelector');

    $selector.find('.propertySelectDropdown').val('').trigger('change');

    $selector.addClass('d-none');

});



document.addEventListener('change', function (e) {



    if (!e.target.classList.contains('propertySelectDropdown')) return;



    const dropdown = e.target;

    const propertyId = dropdown.value;

    if (!propertyId) return;



    const dayRow = dropdown.closest('.itineraryDayRow');

    const propertiesContainer = dayRow.querySelector('.propertiesContainer');

    const unifiedTable = propertiesContainer?.querySelector('.unified-property-table');



    let exists = false;



    (unifiedTable ? unifiedTable.querySelectorAll('.property-group') : []).forEach(group => {

        if (group.dataset.propertyId === propertyId) {

            exists = true;

        }

    });



    if (exists) {

        alert('This property is already added for this day.');

        dropdown.value = '';

        return;

    }



    // âœ… continue adding property if not duplicate

});





function getRoomRowTemplate(propertyId, rooms, leadId, propertyDayId, stayDestId) {

    let options = `<option value="">Select Room</option>`;



    rooms.forEach(r => {

        options += `

            <option value="${r.properties_room_category_id}"

                    data-room-category-id="${r.properties_room_category_id}"

                    data-package-room-id="${r.packages_properties_rooms_id || 0}">

                ${r.properties_room_category_name}

            </option>

        `;

    });



    return `

        <tr class="room-row" data-room-id="" data-packages-room-id="" data-day-id="${propertyDayId || ''}">

            <td class="property-ref-cell text-muted" style="border-left:3px solid #0d6efd;"></td>

            <td>

                <select class="form-select form-select-sm roomSelect">${options}</select>

                <input type="hidden" name="packages_properties_rooms_id_fk[]" class="pkgRoomInput" value="">

                <input type="hidden" name="quotation_properties_rooms_id_fk[]" class="roomInput" value="">

                <input type="hidden" name="quotation_room_tariff_details_id[]" class="quotationRoomTariffDetailsIdInput" value="">

            </td>



            <td class="roomRate">

                <span class="autoCalcRateText">0.00</span>

                <input type="hidden" name="total_room_cost[][]" class="autoCalcRateInput" value="0.00">

            </td>



            <td class="text-center">

                <button type="button"

                        class="btn btn-sm btn-warning me-1 editRoomBtn"

                        data-lead-id="${leadId || ''}"

                        data-property-id="${propertyId || ''}"

                        data-property-day-id="${propertyDayId || ''}"

                        data-stay-destination-id="${stayDestId || ''}"

                        data-room-category-id="">

                    <i class="bi bi-pencil"></i>

                </button>



                <button type="button" class="btn btn-sm btn-danger removeRoomBtn">

                    <i class="bi bi-trash"></i>

                </button>

            </td>

        </tr>

    `;

}





$(document).on('change', '.roomSelect', function () {

    const select = this;

    const row = select.closest('tr');

    const propertyGroup = select.closest('.property-group');

    const dayRow = select.closest('.itineraryDayRow');



    const roomId = $(select).val();

    if (!roomId) return;



    let duplicate = false;



    // âœ… check all room rows in same property except current row

    $(propertyGroup).find('.room-row').each(function () {

        if (this === row) return;



        const otherRowRoomId =

            this.dataset.roomId ||

            ($(this).find('.roomSelect').length ? $(this).find('.roomSelect').val() : '');



        if (String(otherRowRoomId) === String(roomId)) {

            duplicate = true;

        }

    });



    if (duplicate) {

        alert('Room already selected');



        row.dataset.roomId = '';

        row.dataset.packagesRoomId = '';

        row.querySelector('.roomInput').value = '';

        row.querySelector('.pkgRoomInput').value = '';



        const editBtnReset = row.querySelector('.editRoomBtn');

        if (editBtnReset) {

            editBtnReset.dataset.roomCategoryId = '';

        }



        $(select).val('').trigger('change.select2');

        return;

    }



    const selectedOption = select.options[select.selectedIndex];

    const packageRoomId = selectedOption ? (selectedOption.getAttribute('data-package-room-id') || 0) : 0;



    const leadId = $('#leads_id_hidden').val() || $('#leads_id').val() || '';

    const propertyId = propertyGroup?.dataset.propertyId || '';

    const propertyDayId = dayRow?.querySelector('[name="packages_properties_days_id_fk[]"]')?.value || '';

    const stayDestId = dayRow?.querySelector('[name="quotation_properties_days_destination_id_fk[]"]')?.value || '';



    // âœ… save row datasets

    row.dataset.roomId = roomId;

    row.dataset.packagesRoomId = packageRoomId;



    // âœ… save hidden inputs

    row.querySelector('.roomInput').value = roomId;

    row.querySelector('.pkgRoomInput').value = packageRoomId;



//         alert("leadId"+leadId)

// alert("propertyId"+propertyId);

// alert("propertyDayId"+propertyDayId);

// alert("stayDestId"+stayDestId);

// alert("roomId"+roomId);



    // âœ… set edit button datasets

    const editBtn = row.querySelector('.editRoomBtn');

    if (editBtn) {

        editBtn.dataset.leadId = leadId;

        editBtn.dataset.propertyId = propertyId;

        editBtn.dataset.propertyDayId = propertyDayId;

        editBtn.dataset.stayDestinationId = stayDestId;

        editBtn.dataset.roomCategoryId = roomId;

    }



    console.log('editRoomBtn data set =>', {

        leadId: leadId,

        propertyId: propertyId,

        propertyDayId: propertyDayId,

        stayDestId: stayDestId,

        roomCategoryId: roomId,

        packageRoomId: packageRoomId

    });

});



// document.addEventListener('click', function (e) {



//     const btn = e.target.closest('.addRoomBtn');

//     if (!btn) return;



//     const propertyBlock = btn.closest('.propertyBlock');

//     const tbody = propertyBlock.querySelector('tbody');

//     const propertyId = propertyBlock.dataset.propertyId;



//     fetch(`<?php echo base_url(); ?>index.php/Quotation/get_rooms?properties_id=${propertyId}`)

//         .then(res => res.json())

//         .then(res => {

//             if (!res.status || !res.data.length) return;



//             tbody.insertAdjacentHTML(

//                 'beforeend',

//                 getRoomRowTemplate(propertyId, res.data)

//             );

//         });

// });



// document.addEventListener('click', function (e) {

//     const btn = e.target.closest('.addRoomBtn');

//     if (!btn) return;



//     const propertyBlock = btn.closest('.propertyBlock');

//     const tbody = propertyBlock.querySelector('tbody');

//     const propertyId = propertyBlock.dataset.propertyId || '';



//     const dayRow = btn.closest('.itineraryDayRow');

//     const propertyDayId = dayRow?.querySelector('[name="packages_properties_days_id_fk[]"]')?.value || '';

//     const stayDestId = dayRow?.querySelector('[name="quotation_properties_days_destination_id_fk[]"]')?.value || '';

//     const leadId = document.getElementById('selected_lead_id')?.value || '';



//     fetch(`<?php echo base_url(); ?>index.php/Quotation/get_rooms?properties_id=${propertyId}`)

//         .then(res => res.json())

//         .then(res => {

//             if (!res.status || !res.data.length) return;



//             tbody.insertAdjacentHTML(

//                 'beforeend',

//                 getRoomRowTemplate(propertyId, res.data, leadId, propertyDayId, stayDestId)

//             );

//         });

// });



// document.addEventListener('click', function (e) {



//     const btn = e.target.closest('.addRoomBtn');

//     if (!btn) return;



//     const propertyBlock = btn.closest('.propertyBlock');

//     const tbody = propertyBlock.querySelector('tbody');

//     const propertyId = propertyBlock.dataset.propertyId || '';



//     const dayRow = btn.closest('.itineraryDayRow');

//     const propertyDayId = dayRow?.querySelector('[name="packages_properties_days_id_fk[]"]')?.value || '';

//     const stayDestId = dayRow?.querySelector('[name="quotation_properties_days_destination_id_fk[]"]')?.value || '';

//     const leadId = $('#selected_lead_id').val() || '';



//     // âœ… validate existing rows:

//     // if any room row exists but room not selected, stop add new row

//     const roomRows = tbody.querySelectorAll('tr');

//     for (let i = 0; i < roomRows.length; i++) {

//         const roomSelect = roomRows[i].querySelector('.roomSelect');

//         const roomId = roomRows[i].dataset.roomId || (roomSelect ? roomSelect.value : '');



//         if (!roomId) {

//             alert('Please select room in existing row before adding new room.');

//             if (roomSelect) {

//                 initModalSelect2(roomSelect, 'Select Room');

//                 $(roomSelect).select2('open');

//             }

//             return;

//         }

//     }



//     fetch(`<?php echo base_url(); ?>index.php/Quotation/get_rooms?properties_id=${propertyId}`)

//         .then(res => res.json())

//         .then(res => {

//             if (!res.status || !res.data.length) return;



//             tbody.insertAdjacentHTML(

//                 'beforeend',

//                 getRoomRowTemplate(propertyId, res.data, leadId, propertyDayId, stayDestId)

//             );



//             const newRow = tbody.lastElementChild;

//             const roomSelect = newRow.querySelector('.roomSelect');



//             // âœ… init select2

//             initModalSelect2(roomSelect, 'Select Room');

//         });

// });



// document.addEventListener('click', function (e) {

//     const btn = e.target.closest('.addRoomBtn');

//     if (!btn) return;



//     const propertyBlock = btn.closest('.propertyBlock');

//     const tbody = propertyBlock.querySelector('tbody');

//     const propertyId = propertyBlock.dataset.propertyId || '';



//     const dayRow = btn.closest('.itineraryDayRow');

//     const propertyDayId = dayRow?.querySelector('[name="packages_properties_days_id_fk[]"]')?.value || '';

//     const stayDestId = dayRow?.querySelector('[name="quotation_properties_days_destination_id_fk[]"]')?.value || '';

//     const leadId = $('#selected_lead_id').val() || '';



//     const existingRows = tbody.querySelectorAll('tr');



//     // âœ… first click alert when no rooms yet

//     if (existingRows.length === 0) {

//         alert('No rooms added under this property. Please select a room.');

//     }



//     // âœ… if any existing row is still not selected, stop new row

//     for (let i = 0; i < existingRows.length; i++) {

//         const row = existingRows[i];

//         const roomSelect = row.querySelector('.roomSelect');

//         const roomId = row.dataset.roomId || (roomSelect ? roomSelect.value : '');



//         if (!roomId) {

//             alert('Please select room in existing row before adding new room.');

//             if (roomSelect) {

//                 initModalSelect2(roomSelect, 'Select Room');

//                 $(roomSelect).select2('open');

//             }

//             return;

//         }

//     }



//     fetch(`<?php echo base_url(); ?>index.php/Quotation/get_rooms?properties_id=${propertyId}`)

//         .then(res => res.json())

//         .then(res => {

//             if (!res.status || !res.data.length) return;



//             tbody.insertAdjacentHTML(

//                 'beforeend',

//                 getRoomRowTemplate(propertyId, res.data, leadId, propertyDayId, stayDestId)

//             );



//             const newRow = tbody.lastElementChild;

//             const roomSelect = newRow.querySelector('.roomSelect');



//             initModalSelect2(roomSelect, 'Select Room');

//         });

// });



const roomCache = {}; // âœ… cache rooms per property



document.addEventListener('click', async function (e) {

    const btn = e.target.closest('.addRoomBtn');

    if (!btn) return;



    const propertyGroup = btn.closest('.property-group');

    const propertyId = propertyGroup.dataset.propertyId || '';



    const dayRow = btn.closest('.itineraryDayRow');

    const propertyDayId = dayRow?.querySelector('[name="packages_properties_days_id_fk[]"]')?.value || '';

    const stayDestId = dayRow?.querySelector('[name="quotation_properties_days_destination_id_fk[]"]')?.value || '';

    const leadId = $('#selected_lead_id').val() || '';



    const existingRows = propertyGroup.querySelectorAll('.room-row');



    // âœ… Validate existing rows first

    for (let row of existingRows) {

        const roomSelect = row.querySelector('.roomSelect');

        const roomId = row.dataset.roomId || (roomSelect ? $(roomSelect).val() : '');



        if (!roomId) {

            alert('Please select room in existing row before adding new room.');

            if (roomSelect) {

                initModalSelect2(roomSelect, 'Select Room');

                $(roomSelect).select2('open');

            }

            return;

        }

    }



    let rooms = [];



    try {

        // âœ… use cache

        if (roomCache[propertyId]) {

            rooms = roomCache[propertyId];

        } else {

            const res = await fetch(`<?php echo base_url(); ?>index.php/Quotation/get_rooms?properties_id=${propertyId}`);

            const data = await res.json();



            if (!data.status || !Array.isArray(data.data)) {

                alert('No rooms available under this property.');

                return;

            }



            rooms = data.data;

            roomCache[propertyId] = rooms; // âœ… cache

        }



        // âœ… FINAL CHECK (only here alert)

        if (!rooms.length) {

            alert('No rooms available under this property.');

            return;

        }



        // âœ… insert row before the add-room-row

        const addRoomRow = propertyGroup.querySelector('.add-room-row');

        if (addRoomRow) {

            addRoomRow.insertAdjacentHTML(

                'beforebegin',

                getRoomRowTemplate(propertyId, rooms, leadId, propertyDayId, stayDestId)

            );

        } else {

            propertyGroup.insertAdjacentHTML(

                'beforeend',

                getRoomRowTemplate(propertyId, rooms, leadId, propertyDayId, stayDestId)

            );

        }



        const newRow = addRoomRow ? addRoomRow.previousElementSibling : propertyGroup.lastElementChild;

        const roomSelect = newRow.querySelector('.roomSelect');



        initModalSelect2(roomSelect, 'Select Room');



    } catch (err) {

        console.error(err);

        alert('Error loading rooms');

    }

});



document.addEventListener('click', function (e) {



    const btn = e.target.closest('.removeRoomBtn');

    if (!btn) return;



    btn.closest('tr').remove();

});



function parseDayDestValue(val) {

  // "dayId|stayDestId|date"

  const parts = (val || '').split('|');

  return {

    packages_properties_days_id_fk: parts[0] ? parseInt(parts[0], 10) : 0,

    stay_destination_id_fk: parts[1] ? parseInt(parts[1], 10) : 0,

    accommodation_date: parts[2] || ''

  };

}





function buildQuotationPayload() {



    const payload = { options: [], inclusions: [], special_requirements: [] };



    // Loop through each option block

    document.querySelectorAll('.optionBlock').forEach(optionBlock => {



        const option = {

            packages_properties_common_id_fk:

                optionBlock.querySelector('.propertyDropdown')?.value || '',

            title:

                optionBlock.querySelector('[name="quotation_options_title[]"]')?.value || '',

            cab_amount:

                optionBlock.querySelector('[name="quotation_options_cab_amount[]"]')?.value || '',



            quotation_options_design_type:

                optionBlock.querySelector('[name="quotation_options_design_type[]"]')?.value || '',



            quotation_options_vehicle_id_fk:

                optionBlock.querySelector('[name="quotation_options_vehicle_id_fk[]"]')?.value || '',



            quotation_options_room_category_display:

                optionBlock.querySelector('[name="quotation_options_room_category_display[]"]')?.checked ? 1 : 0,



            quotation_options_meal_plan_display:

                optionBlock.querySelector('[name="quotation_options_meal_plan_display[]"]')?.checked ? 1 : 0,



            quotation_options_vehicle_display:

                optionBlock.querySelector('[name="quotation_options_vehicle_display[]"]')?.checked ? 1 : 0,

            

            // âœ… NEW: save exactly what UI calculated

            quotation_options_total_cost:

                optionBlock.querySelector('.optionTotalCostInput')?.value || '0',



            // store 'percent' or 'amount' (same as your UI)

            quotation_options_margin_type:

                optionBlock.querySelector('.optionMarginType')?.value || 'amount',



            quotation_options_margin_value:

                optionBlock.querySelector('.optionMarginValue')?.value || '0',



            quotation_options_total_quote_rate:

            optionBlock.querySelector('.optionQuoteTotalInput')?.value || '0',



            quotation_options_amount_type:

             optionBlock.querySelector('.optionAmountType')?.value || 'net',



            quotation_options_per_amount:

            optionBlock.querySelector('.optionPerAmount')?.value || 0,

            days: []

        };



        // Loop only actual day rows in itinerary table (skip room/property rows)

        optionBlock.querySelectorAll('.itineraryContainer tbody > tr').forEach(dayRow => {



            // Only process rows that contain day inputs

            const dayIdInput = dayRow.querySelector('[name="packages_properties_days_id_fk[]"]');

            if (!dayIdInput) return; // skip non-day rows



            const day = {

                packages_properties_days_id_fk: dayIdInput.value,

                day: dayRow.querySelector('[name="quotation_properties_days_day[]"]')?.value || '',

                destination_id: dayRow.querySelector('[name="quotation_properties_days_destination_id_fk[]"]')?.value || '',

                accommodation_plan_id_fk:dayRow.querySelector('[name="accommodation_plan_id_fk[]"]')?.value || 0,

                properties: []

            };



            // Loop properties within this day

            const propertiesContainer = dayRow.querySelector('.propertiesContainer');

            const unifiedTable = propertiesContainer?.querySelector('.unified-property-table');

            if (unifiedTable) {

                unifiedTable.querySelectorAll('.property-group').forEach(propertyGroup => {



                    const property = {

                        packages_properties_id_fk: propertyGroup.dataset.packagesPropertyId || 0,

                        properties_id_fk: propertyGroup.dataset.propertyId || 0,

                        rooms: []

                    };



                    

                    // Loop rooms within this property

                    propertyGroup.querySelectorAll('.room-row').forEach(roomRow => {

                        if (!roomRow.dataset.roomId) return;



                        //READ TOTAL ROOM COST from the row (you must have this hidden input in the row)

            const totalRoomCost =

              roomRow.querySelector('input.autoCalcRateInput')?.value ||

              roomRow.querySelector('[name="total_room_cost[]"]')?.value ||

              '0';



                        property.rooms.push({

                            packages_properties_rooms_id_fk: roomRow.dataset.packagesRoomId || 0,

                            quotation_properties_rooms_id_fk: roomRow.dataset.roomId,

                            total_room_cost: totalRoomCost,

                            quotation_room_tariff_details_id: roomRow.querySelector('.quotationRoomTariffDetailsIdInput')?.value || 0

                        });

                    });



                    day.properties.push(property);

                });

            }



            option.days.push(day);

        });



        payload.options.push(option);

    });





    

        // ================= INCLUSIONS =================

    // payload.inclusions = [];

    // document.querySelectorAll('#inclusionTable tbody tr').forEach(tr => {

    //   const dayKey = tr.querySelector('[name="inclusion_day_key[]"]')?.value || '';

    //   const name = tr.querySelector('[name="inclusion_name[]"]')?.value || '';

    //   const amount = tr.querySelector('[name="inclusion_amount[]"]')?.value || '';



    //   if (!dayKey || !name) return;



    //   payload.inclusions.push({ dayKey, name, amount });

    // });

    

    // payload.inclusions = [];

    // document.querySelectorAll('#inclusionTable tbody tr').forEach(tr => {

    //     const dayKey = tr.querySelector('[name="inclusion_day_key[]"]')?.value || '';

    //     const propertyId = tr.querySelector('[name="inclusion_property_id_fk[]"]')?.value || '';

    //     const propertyInclusionId = tr.querySelector('[name="property_inclusions_id_fk[]"]')?.value || '';

    //     const amount = tr.querySelector('[name="inclusion_amount[]"]')?.value || '';



    //     if (!dayKey || !propertyId || !propertyInclusionId) return;



    //     payload.inclusions.push({

    //         dayKey: dayKey,

    //         property_id_fk: propertyId,

    //         property_inclusions_id_fk: propertyInclusionId,

    //         amount: amount

    //     });

    // });



    payload.inclusions = [];



    $('#inclusionTable tbody tr').each(function () {

        var $tr = $(this);



        var packageOptionId = $tr.find('.inclusionPackageOptionSelect').val() || '';

        var dayKey = $tr.find('.inclusionDaySelect').val() || '';

        var propertyId = $tr.find('.inclusionPropertySelect').val() || '';

        var propertyInclusionId = $tr.find('.inclusionNameSelect').val() || '';

        var name = $tr.find('.inclusionNameSelect option:selected').text() || '';

        var amount = $tr.find('.inclusionAmountInput').val() || '';



        if (!packageOptionId && !dayKey && !propertyId && !propertyInclusionId && !amount) {

            return;

        }



        if (!dayKey || !propertyId || !propertyInclusionId) {

            console.log('Skipped incomplete inclusion row', {

                packageOptionId: packageOptionId,

                dayKey: dayKey,

                propertyId: propertyId,

                propertyInclusionId: propertyInclusionId,

                amount: amount

            });

            return;

        }



      payload.inclusions.push({

            package_option_id_fk: packageOptionId,

            quotation_options_id_fk: $(this).closest('.optionBlock').data('option-id') || '', // âœ… ADD THIS

            dayKey: dayKey,

            property_id_fk: propertyId,

            property_inclusions_id_fk: propertyInclusionId,

            name: name,

            amount: amount

        });

    });



    console.log('Final inclusions payload:', payload.inclusions);

    // ================= SPECIAL REQUIREMENTS =================

    payload.special_requirements = [];

    document.querySelectorAll('#specialReqTable tbody tr').forEach(tr => {

      const dayKey = tr.querySelector('[name="specialreq_day_key[]"]')?.value || '';

      const reqName = tr.querySelector('[name="quotation_special_requirements_name[]"]')?.value || '';

      const cost = tr.querySelector('[name="special_requirements_cost[]"]')?.value || '';



      if (!dayKey || !reqName?.trim()) return;



      payload.special_requirements.push({

        dayKey,

        quotation_special_requirements_name: reqName.trim(),

        cost

      });

    });



    return payload;

}



    function recalcAllOptionsBeforeSave() {

  document.querySelectorAll('.optionBlock').forEach(ob => recalcOptionTotals(ob));

}





////////////********** *************///////////





function setHtmlSafe(selector, html) {

    const el = document.querySelector(selector);

    if (el) el.innerHTML = html;

}



function setTextSafe(selector, text) {

    const el = document.querySelector(selector);

    if (el) el.textContent = text;

}



/* ================= EDIT ROOM BUTTON (ENQUIRY ONLY) ================= */

/* helpers (keep yours) */

/* ================= SAFE HELPERS ================= */

function setHtmlSafe(selector, html) {

    const el = document.querySelector(selector);

    if (el) el.innerHTML = html;

}

function setTextSafe(selector, text) {

    const el = document.querySelector(selector);

    if (el) el.textContent = text;

}





/***********************

 *  POLICY AGE HELPERS

 ***********************/

function toInt(v, def = 0) {

  const n = parseInt(v, 10);

  return Number.isFinite(n) ? n : def;

}



function inRange(age, from, to) {

  if (!Number.isFinite(age)) return false;

  if (!Number.isFinite(from) || !Number.isFinite(to)) return false;

  return age >= from && age <= to;

}



function normalizeYesNo(v) {

  const s = String(v ?? '').trim().toLowerCase();

  return (s === 'y' || s === 'yes' || s === '1' || s === 'true');

}



/**

 * Build room policy age ranges string:

 * Baby 2-3 YR | Child 4-14 YR OR Baby - | Child -

 */

function getRoomPolicyAgeText(room) {

  const babyType = normalizeYesNo(room.properties_room_category_complimentary_guest_between_type);

  const babyFrom = toInt(room.properties_room_category_complimentary_guest_between_from_year, 0);

  const babyTo   = toInt(room.properties_room_category_complimentary_guest_between_to_year, 0);



  const childType = normalizeYesNo(room.properties_room_category_child_rate_applied_guest_between_type);

  const childFrom = toInt(room.properties_room_category_child_rate_applied_guest_from_year, 0);

  const childTo   = toInt(room.properties_room_category_child_rate_applied_guest_to_year, 0);



  const babyTxt  = (babyType && babyFrom > 0 && babyTo > 0) ? `Baby ${babyFrom}-${babyTo} YR` : `Baby -`;

  const childTxt = (childType && childFrom > 0 && childTo > 0) ? `Child ${childFrom}-${childTo} YR` : `Child -`;



  return `${babyTxt} | ${childTxt}`;

}



/***********************

 *  APPLIED PLAN (AGE BASED)

 *  Turns enquiry children ages into: adult/child/baby counts

 ***********************/

function computeAppliedCountsFromAges(room, enquiryPlan, childAges) {

  // enquiryPlan: { adults, children } from guset_count_details

  // childAges: [{age, count}, ...] from child_age_break_up



  const welcomesAll = normalizeYesNo(room.properties_room_category_welcomes_child_all_ages);

  const restrictUnder = toInt(room.properties_room_category_admission_restricted_guests_under_age, 0);



  const compType = normalizeYesNo(room.properties_room_category_complimentary_guest_between_type);

  const compFrom = toInt(room.properties_room_category_complimentary_guest_between_from_year, 0);

  const compTo   = toInt(room.properties_room_category_complimentary_guest_between_to_year, 0);



  const childType = normalizeYesNo(room.properties_room_category_child_rate_applied_guest_between_type);

  const childFrom = toInt(room.properties_room_category_child_rate_applied_guest_from_year, 0);

  const childTo   = toInt(room.properties_room_category_child_rate_applied_guest_to_year, 0);



  const adultOver = toInt(room.properties_room_category_adult_rate_applied_guest_over, 0);



  let adults = toInt(enquiryPlan.adults, 0);

  let children = 0;

  let baby = 0;



  let hasUnderRestrictedChild = false;



  // If you didnâ€™t store ages, fall back to enquiryPlan.children

  const ageRows = Array.isArray(childAges) && childAges.length

    ? childAges

    : (toInt(enquiryPlan.children, 0) ? [{ age: null, count: toInt(enquiryPlan.children, 0) }] : []);



  ageRows.forEach(row => {

    const age = row.age === null ? null : toInt(row.age, NaN);

    const cnt = toInt(row.count, 0);

    if (cnt <= 0) return;



    // If no age info => treat as "child" unless rule #1 forces adult

    if (age === null || !Number.isFinite(age)) {

      // Rule 1: adultOver == 0 AND welcomesAll==Y AND restrictUnder==0 => child becomes adult

      if (adultOver === 0 && welcomesAll && (!restrictUnder || restrictUnder === 0)) {

        adults += cnt;

      } else {

        children += cnt;

      }

      return;

    }



    // Rule 2: restricted age -> convert to adult and flag warning

    if (!welcomesAll && restrictUnder > 0 && age < restrictUnder) {

      adults += cnt;

      hasUnderRestrictedChild = true;

      return;

    }



    // Rule 3: complimentary range => baby

    if (compType && compFrom > 0 && compTo > 0 && inRange(age, compFrom, compTo)) {

      baby += cnt;

      return;

    }



    // Rule 4: child rate range => child

    if (childType && childFrom > 0 && childTo > 0 && inRange(age, childFrom, childTo)) {

      children += cnt;

      return;

    }



    // Adult rule by age

    if (adultOver > 0 && age >= adultOver) {

      adults += cnt;

      return;

    }



    // Rule 1 again (welcomes + adultOver==0)

    if (adultOver === 0 && welcomesAll && (!restrictUnder || restrictUnder === 0)) {

      adults += cnt;

      return;

    }



    // default => child

    children += cnt;

  });



  return {

    applied: { adults, children, baby },

    warnings: {

      restrictUnder,

      hasUnderRestrictedChild

    }

  };

}



/***********************

 *  CORE ALLOCATOR

 *  Uses policy db/eb/sb like your examples

 *

 *  Interpretation:

 *  - db = number of adults allowed per room WITHOUT extra bed

 *  - eb = extra adult capacity per room (extra beds)

 *  - sb = sharing-bed capacity per room for baby/child

 ***********************/

function autoAllocate(policy, applied) {

  const db = toInt(policy.db, 0);

  const eb = toInt(policy.eb, 0);

  const sb = toInt(policy.sb, 0);



  let adults = toInt(applied.adults, 0);

  let children = toInt(applied.children, 0);

  let baby = toInt(applied.baby, 0);



  // outputs

  const out = {

    eligible: true,

    // pax-wise

    pax: {

      adult: { db: 0, eb: 0, sb: 0, sgl: 0 },

      child: { db: 0, eb: 0, sb: 0, sgl: 0 },

      baby:  { db: 0, eb: 0, sb: 0, sgl: 0 },

    },

    // rooming plan inputs (counts only)

    plan: {

      rooms_units: 0,

      extra_bed_adult: 0,

      child_sharing_bed: 0,

      single_occupancy: 0

    },

    // messages under pax box

    notes: {

      surplus: { db: 0, eb: 0, sb: 0 },

      excess:  { eb: 0 },

      alerts: []

    }

  };



  // ======= Scenario 1: all zero => not eligible

  if (db === 0 && eb === 0 && sb === 0) {

    out.eligible = false;

    out.notes.alerts.push('This room is not eligible for booking this lead. Please update DB count.');

    return out;

  }



  // ======= Adult-only invalid: db=0 sb>0 eb=0

  if (adults > 0 && children === 0 && baby === 0 && db === 0 && eb === 0 && sb > 0) {

    out.eligible = false;

    out.notes.alerts.push('This room is not eligible for booking this lead. Please update DB count.');

    return out;

  }



  // ======= Adult-only: 1 adult special SGL rules

  if (adults === 1 && children === 0 && baby === 0) {



    // scenario 2: db>=1 eb=0 => SGL 1

    if (db >= 1 && eb === 0) {

      out.pax.adult.sgl = 1;

      out.plan.single_occupancy = 1;

      out.plan.rooms_units = 1;

      return out;

    }



    // scenario 3: db=0 eb>=1 => SGL 1 and EB 1

    if (db === 0 && eb >= 1) {

      out.pax.adult.sgl = 1;

      out.pax.adult.eb = 1;

      out.plan.single_occupancy = 1;

      out.plan.extra_bed_adult = 1;

      out.plan.rooms_units = 1;

      out.notes.excess.eb = 1; // "Excess Bed Utilization: EB:1"

      return out;

    }



    // scenario 4: db=0 sb>=1 eb=0 already handled invalid above

  }



  // ======= General Adult allocation (your examples 5-14 etc.)

  // If db == 0 and adults > 0, only EB can host adults (rare but you used it)

  // We'll treat room base capacity = db + eb. If db=0, capacity = eb.

  const capAdultPerRoom = db + eb;



  if (adults > 0) {



    // If cap is 0 but adults exist => not eligible

    if (capAdultPerRoom <= 0) {

      out.eligible = false;

      out.notes.alerts.push('This room is not eligible for booking this lead. Please update DB/EB policy.');

      return out;

    }



    // rooms needed

    const rooms = Math.ceil(adults / capAdultPerRoom);



    // DB utilization means: rooms count (like your examples)

    // For db=1 -> adult DB becomes adults because rooms = adults when cap=1

    // For db=2 -> adult DB becomes rooms (e.g. 8 adults => rooms 4)

    // BUT you display "Adult DB" as number of rooms (units). That matches your examples.

    out.pax.adult.db = rooms; // number of rooms

    out.plan.rooms_units = rooms;



    // base beds available for adults inside rooms = rooms * db

    const baseBedSlots = rooms * db;



    // extra adults beyond base => EB used

    let needExtra = Math.max(0, adults - baseBedSlots);



    // EB capacity total

    const ebCap = rooms * eb;



    // clamp

    if (needExtra > ebCap) {

      // should not happen if rooms computed from capAdultPerRoom,

      // but keep safe

      needExtra = ebCap;

      out.notes.alerts.push('Not enough EB capacity for this enquiry.');

    }



    out.pax.adult.eb = needExtra;

    out.plan.extra_bed_adult = needExtra;



    // Surplus EB (when eb policy exists and not fully used)

    if (eb > 0) {

      out.notes.surplus.eb = Math.max(0, ebCap - needExtra);

    }



    // Special: if db=0 and adults hosted only by EB => mark EB â€œexcessâ€

    if (db === 0 && needExtra > 0) {

      out.notes.excess.eb = needExtra;

    }



    // Special: if adults==1 and db>=1 but eb>0, still your rule says SGL

    // We already handled adults===1 earlier, but keep safe

    if (adults === 1) {

      out.pax.adult.db = 0;

      out.pax.adult.eb = (db === 0 ? 1 : 0);

      out.pax.adult.sgl = 1;

      out.plan.rooms_units = 1;

      out.plan.single_occupancy = 1;

    }

  }



  // ======= Child/Baby allocation into SB (per room)

  // Your later scenarios use SB for baby/child â€œsharing bedâ€.

  // We allocate sharing beds across rooms calculated above.

  const roomsCount = Math.max(1, out.plan.rooms_units || 0);

  const sbCapTotal = roomsCount * sb;

  const needSB = children + baby;



  const useSB = Math.min(sbCapTotal, needSB);

  out.plan.child_sharing_bed = useSB;



  // split SB usage: prefer baby first, then child (common)

  const babySB = Math.min(baby, useSB);

  const childSB = Math.max(0, useSB - babySB);



  out.pax.baby.sb = babySB;

  out.pax.child.sb = childSB;



  // Surplus SB

  if (sb > 0) out.notes.surplus.sb = Math.max(0, sbCapTotal - useSB);



  // If there are remaining child/baby not placed

  const remain = needSB - useSB;

  if (remain > 0) {

    out.notes.alerts.push('Not enough SB capacity for child/baby. Please adjust rooming manually.');

  }



  // Surplus DB (when db per room > what is required per room, like your db=4 example)

  // In your example: adults=9, db=4 => rooms=3, baseBedSlots=12, unused base beds = 3

  // You show "Surplus Bed Available: DB:3"

  const unusedBaseBeds = Math.max(0, (roomsCount * db) - adults);

  out.notes.surplus.db = unusedBaseBeds;



  return out;

}



/***********************

 *  APPLY ALLOCATION TO MODAL UI

 ***********************/

function applyAllocationToModal(allocation) {

  // reset message areas if you have them

  setTextSafe('#paxNoteSurplus', '');

  setTextSafe('#paxNoteExcess', '');

  setTextSafe('#paxNoteAlert', '');



  // pax-wise spans

  setTextSafe('[data-role="adult-db"]', allocation.pax.adult.db);

  setTextSafe('[data-role="adult-eb"]', allocation.pax.adult.eb);

  setTextSafe('[data-role="adult-sb"]', allocation.pax.adult.sb);

  setTextSafe('[data-role="adult-sgl"]', allocation.pax.adult.sgl);



  setTextSafe('[data-role="child-db"]', allocation.pax.child.db);

  setTextSafe('[data-role="child-eb"]', allocation.pax.child.eb);

  setTextSafe('[data-role="child-sb"]', allocation.pax.child.sb);

  setTextSafe('[data-role="child-sgl"]', allocation.pax.child.sgl);



  setTextSafe('[data-role="baby-db"]', allocation.pax.baby.db);

  setTextSafe('[data-role="baby-eb"]', allocation.pax.baby.eb);

  setTextSafe('[data-role="baby-sb"]', allocation.pax.baby.sb);

  setTextSafe('[data-role="baby-sgl"]', allocation.pax.baby.sgl);



  // rooming plan input fields (Auto)

  // Use your modal input names/ids; adjust selectors if different.

  const autoRooms = document.querySelector('[name="auto_room_member_count"]');

  const autoEB    = document.querySelector('[name="auto_extra_bed_adult_count"]');

  const autoSB    = document.querySelector('[name="auto_child_sharing_bed_count"]');

  const autoSGL   = document.querySelector('[name="auto_single_occupancy_count"]');



  if (autoRooms) autoRooms.value = allocation.plan.rooms_units;

  if (autoEB)    autoEB.value    = allocation.plan.extra_bed_adult;

  if (autoSB)    autoSB.value    = allocation.plan.child_sharing_bed;

  if (autoSGL)   autoSGL.value   = allocation.plan.single_occupancy;



  // rooming plan input fields (Manual) default same as auto

  const manRooms = document.querySelector('[name="manual_count"]');

  const manEB    = document.querySelector('[name="manual_extra_bed_adult_count"]');

  const manSB    = document.querySelector('[name="manual_child_sharing_bed_count"]');

  const manSGL   = document.querySelector('[name="manual_single_occupancy_count"]');



  if (manRooms) manRooms.value = allocation.plan.rooms_units;

  if (manEB)    manEB.value    = allocation.plan.extra_bed_adult;

  if (manSB)    manSB.value    = allocation.plan.child_sharing_bed;

  if (manSGL)   manSGL.value   = allocation.plan.single_occupancy;



  // notes

  const surplusParts = [];

  if (allocation.notes.surplus.db > 0) surplusParts.push(`DB:${allocation.notes.surplus.db}`);

  if (allocation.notes.surplus.eb > 0) surplusParts.push(`EB:${allocation.notes.surplus.eb}`);

  if (allocation.notes.surplus.sb > 0) surplusParts.push(`SB:${allocation.notes.surplus.sb}`);



  if (surplusParts.length) {

    setTextSafe('#paxNoteSurplus', `Surplus Bed Available: ${surplusParts.join(' ')}`);

  }



  if (allocation.notes.excess.eb > 0) {

    setTextSafe('#paxNoteExcess', `Excess Bed Utilization: EB:${allocation.notes.excess.eb}`);

  }



  if (allocation.notes.alerts.length) {

    setTextSafe('#paxNoteAlert', allocation.notes.alerts.join(' | '));

  }

}





/* ================= EDIT ROOM BUTTON (FULL) ================= */

function setHtmlSafe(selector, html) {

    var el = document.querySelector(selector);

    if (el) el.innerHTML = html;

}

function setTextSafe(selector, text) {

    var el = document.querySelector(selector);

    if (el) el.textContent = (text === undefined || text === null) ? '' : String(text);

}

function setTextSafeIn(modalEl, selector, text) {

    if (!modalEl) return;

    var el = modalEl.querySelector(selector);

    if (el) el.textContent = (text === undefined || text === null) ? '' : String(text);

}

function setHtmlSafeIn(modalEl, selector, html) {

    if (!modalEl) return;

    var el = modalEl.querySelector(selector);

    if (el) el.innerHTML = html || '';

}



function nval(selector)

{

    return parseFloat($(selector).val()) || 0;

}



function clearRoomPricingWarnings()

{

    $('#roomPricingWarningBox')

        .addClass('d-none')

        .html('');

}



function showRoomPricingWarnings(messages)

{

    if (!messages || messages.length === 0) {

        clearRoomPricingWarnings();

        return;

    }



    var html = '<div class="alert alert-warning mb-0">';



    $.each(messages, function(i, msg) {

        html += '<div class="mb-1"><i class="bi bi-exclamation-triangle me-1"></i>' + msg + '</div>';

    });



    html += '</div>';



    $('#roomPricingWarningBox')

        .removeClass('d-none')

        .html(html);

}



function checkRoomPricingWarnings()

{

    var messages = [];



    /*

      CASE 1:

      Check both auto and manual rates.

      If all rates are zero, show tariff warning.

    */

    var roomAutoRate = nval('[name="auto_room_member_rate"]');

    var roomManRate  = nval('[name="manual_rate"]');



    var sglAutoRate  = nval('[name="auto_single_occupancy_rate"]');

    var sglManRate   = nval('[name="manual_single_occupancy_rate"]');



    var ebaAutoRate  = nval('[name="auto_extra_bed_adult_rate"]');

    var ebaManRate   = nval('[name="manual_extra_bed_adult_rate"]');



    var cwbAutoRate  = nval('[name="auto_extra_bed_child_rate"]');

    var cwbManRate   = nval('[name="manual_extra_bed_child_rate"]');



    var cnbAutoRate  = nval('[name="auto_child_sharing_bed_rate"]');

    var cnbManRate   = nval('[name="manual_child_sharing_bed_rate"]');



    var tariffFound =

        roomAutoRate > 0 || roomManRate > 0 ||

        sglAutoRate  > 0 || sglManRate  > 0 ||

        ebaAutoRate  > 0 || ebaManRate  > 0 ||

        cwbAutoRate  > 0 || cwbManRate  > 0 ||

        cnbAutoRate  > 0 || cnbManRate  > 0;



    if (!tariffFound) {

        messages.push(

            'Rates for all bed units were not found in the tariff. Auto rooming amounts may show as zero â€” enter per-unit rates manually in the rooming table.'

        );

    }



    /*

      CASE 2:

      Meal supplement missing.

      Use tariff data stored on the modal by applyTariffRatesToModal.

    */

    var modalEl = document.getElementById('roompricingandguestallocationModal');

    var tariffData = null;

    if (modalEl && modalEl.dataset.tariffData) {

        try { tariffData = JSON.parse(modalEl.dataset.tariffData); } catch (e) { tariffData = null; }

    }



    if (tariffData && tariffData.needs_supplement) {

        var autoSupplement  = nval('[name="auto_supplment_cost"]');

        var manualSupplement = nval('[name="manual_supplment_cost"]');



        // If backend says supplement is needed but couldn't find the tariff rates for missing meals

        if (tariffData.meal_rates_missing && tariffData.meal_rates_missing.length > 0) {

            messages.push(

                'Meal rates not found. Update rates or enter manually in the supplement cost field.'

            );

        }

    }



    showRoomPricingWarnings(messages);

}



// Check warnings when modal opens (after fields are populated)

$('#roompricingandguestallocationModal').on('shown.bs.modal', function () {

    setTimeout(function () {

        checkRoomPricingWarnings();

    }, 500);

});



$(document).on('input change', '#roompricingandguestallocationModal input', function () {

    checkRoomPricingWarnings();

});



$(document).on('click', '.editRoomBtn', function () {

    if (window.__autoCalcActive) {

        // Let the main modal flow handle auto-calculation

        return;

    }


clearRoomPricingWarnings();

    window.__lastRoomEditBtn = this;



    let row = $(this).closest('tr');



    let day_id_fk = row.find('[name="packages_properties_days_id_fk[]"]').val();

    let room_row_fk = row.find('[name="quotation_properties_rooms_id_fk[]"]').val();



    $.ajax({

        url: '<?php echo base_url(); ?>index.php/Quotation/ajax_get_quotation_room_tariff_details',

        type: "GET",

        dataType: "json",

        data: {

            packages_properties_days_id_fk: day_id_fk,

            quotation_properties_rooms_id_fk: room_row_fk

        },

        // success: function (res) {



        //     if (res.status) {



        //         let d = res.data;



        //         // âœ… SET HIDDEN ID

        //         $('#modal_quotation_room_tariff_details_id')

        //             .val(d.quotation_room_tariff_details_id);



        //         // âœ… AUTO SECTION

        //         $('[name="room_unit_auto_count"]').val(d.room_unit_auto_count);

        //         $('[name="room_unit_auto_rate"]').val(d.room_unit_auto_rate);



        //         // âœ… MANUAL SECTION

        //         $('[name="room_unit_manual_count"]').val(d.room_unit_manual_count);

        //         $('[name="room_unit_manual_rate"]').val(d.room_unit_manual_rate);



        //         // ðŸ‘‰ repeat for all fields (same mapping)



        //         // âœ… TRIGGER TOTAL CALCULATION

        //         calculateRoomTariffTotals();



        //     } else {

        //         // no data â†’ reset modal

        //         $('#modal_quotation_room_tariff_details_id').val('');

        //         resetRoomTariffModal();

        //     }

        // }



        success: function (res) {



    clearRoomPricingWarnings();



    if (res.status) {



        let d = res.data;



        $('#modal_quotation_room_tariff_details_id')

            .val(d.quotation_room_tariff_details_id);



        $('[name="room_unit_auto_count"]').val(d.room_unit_auto_count);

        $('[name="room_unit_auto_rate"]').val(d.room_unit_auto_rate);



        $('[name="room_unit_manual_count"]').val(d.room_unit_manual_count);

        $('[name="room_unit_manual_rate"]').val(d.room_unit_manual_rate);



        $('[name="single_occupancy_auto_rate"]').val(d.single_occupancy_auto_rate);

        $('[name="single_occupancy_manual_rate"]').val(d.single_occupancy_manual_rate);



        $('[name="extra_bed_adult_auto_rate"]').val(d.extra_bed_adult_auto_rate);

        $('[name="extra_bed_adult_manual_rate"]').val(d.extra_bed_adult_manual_rate);



        $('[name="extra_bed_child_auto_rate"]').val(d.extra_bed_child_auto_rate);

        $('[name="extra_bed_child_manual_rate"]').val(d.extra_bed_child_manual_rate);



        $('[name="child_sharing_bed_auto_rate"]').val(d.child_sharing_bed_auto_rate);

        $('[name="child_sharing_bed_manual_rate"]').val(d.child_sharing_bed_manual_rate);



        $('[name="adult_meal_plan_rate"]').val(d.adult_meal_plan_rate || 0);

        $('[name="child_meal_plan_rate"]').val(d.child_meal_plan_rate || 0);

        $('[name="adult_supplement_cost"]').val(d.adult_supplement_cost || 0);

        $('[name="child_supplement_cost"]').val(d.child_supplement_cost || 0);



        calculateRoomTariffTotals();



        setTimeout(function () {

            checkRoomPricingWarnings();

        }, 200);



    } else {

        resetRoomTariffModal();



        setTimeout(function () {

            checkRoomPricingWarnings();

        }, 200);

    }

}

    });



});



function updateRemainingUI(result) {



    const cap = result.capacity;



    if (!cap) {

        $('#remaining-row').hide();

        return;

    }



    let hasRemaining = false;



    // DB

    if (cap.remainingDB > 0) {

        $('#remaining-db')

            .text(`DB: ${cap.remainingDB}`)

            .show();

        hasRemaining = true;

    } else {

        $('#remaining-db').hide();

    }



    // EB

    if (cap.remainingEB > 0) {

        $('#remaining-eb')

            .text(`EB: ${cap.remainingEB}`)

            .show();

        hasRemaining = true;

    } else {

        $('#remaining-eb').hide();

    }



    // SB

    if (cap.remainingSB > 0) {

        $('#remaining-sb')

            .text(`SB: ${cap.remainingSB}`)

            .show();

        hasRemaining = true;

    } else {

        $('#remaining-sb').hide();

    }



    // Show row only if anything exists

    if (hasRemaining) {

        $('#remaining-row').show();

    } else {

        $('#remaining-row').hide();

    }

}



$('#sync-btn').on('click', syncAutoToManualCountsAndRates);



document.addEventListener('click', function (e) {



    var btn = e.target.closest('.editRoomBtn');

    if (!btn) return;



    $('.child-note-foc').text('');

    $('.child-note-foc').hide();

    $('#remaining-row').hide();

    var leadId         = btn.dataset.leadId || '';

    var propertyId     = btn.dataset.propertyId || '';

    var roomCategoryId = btn.dataset.roomCategoryId || '';

    // var propertyDayId  = btn.dataset.propertyDayId || '';

    var stayDestId     = btn.dataset.stayDestinationId || '';



    // if (!leadId || !propertyId || !roomCategoryId || !propertyDayId || !stayDestId) {

    //     alert('Missing lead/property/room/day/destination details');

    //     console.log({ leadId: leadId, propertyId: propertyId, roomCategoryId: roomCategoryId, propertyDayId: propertyDayId, stayDestId: stayDestId });

    //     return;

    // }



    const dayRow = btn.closest('.itineraryDayRow');

    var itineraryDayId = dayRow?.dataset.itineraryDayId || 

                     dayRow?.querySelector('[name="packages_itinerary_days_id_fk[]"]')?.value || '';



    if (!leadId || !propertyId || !roomCategoryId || !itineraryDayId || !stayDestId) {

  //     alert("Lead"+leadId);

  // alert("propertyId"+propertyId);

  // alert("roomCategoryId"+roomCategoryId);

  // alert("itineraryDayId"+itineraryDayId);

  // alert("stayDestId"+stayDestId);

      alert('Missing lead/property/room/day/destination details');

      console.log({

          leadId: leadId,

          propertyId: propertyId,

          roomCategoryId: roomCategoryId,

          itineraryDayId: itineraryDayId,

          stayDestId: stayDestId

      });

      return;

  }    

  

 

    var modalEl = document.getElementById('roompricingandguestallocationModal');

    if (!modalEl) {

        alert('Modal not found in page');

        return;

    }



    // store last clicked button row for UI update after save

window.__lastRoomEditBtn = btn;



// day row (itinerary day row)

// const dayRow = btn.closest('.itineraryDayRow'); 

// const dayId = dayRow?.querySelector('[name="packages_properties_days_id_fk[]"]')?.value || '';







// room row id (quotation_properties_rooms_id_fk)

// you already store room row id in hidden input inside the room row:

const roomTr = btn.closest('tr');

const qpRoomId = roomTr?.querySelector('[name="packages_properties_rooms_id_fk[]"]')?.value || '';



const tariffDetailsId = roomTr?.querySelector('.quotationRoomTariffDetailsIdInput')?.value || '';

document.getElementById('modal_quotation_room_tariff_details_id').value = tariffDetailsId;



document.getElementById('modal_packages_properties_days_id_fk').value = itineraryDayId;

document.getElementById('modal_quotation_properties_rooms_id_fk').value = qpRoomId;





    /* ================= RESET MODAL ================= */

    setTextSafeIn(modalEl, '#modalTotalRate', '0');

    setTextSafeIn(modalEl, '#modalLeadInfo', 'Loading...');

    setTextSafeIn(modalEl, '#modalRoomInfo', 'Loading...');

    setTextSafeIn(modalEl, '[data-role="room-policy"]', 'Loading...');

    setTextSafeIn(modalEl, '[data-role="meal-plan"]', '-');



    // Room policy age line (Baby/Child range)

    setTextSafeIn(modalEl, '[data-role="room-policy-ages"]', 'Baby - | Child -');



    // âœ… In Enquiry reset (Adult + Child only)

    setTextSafeIn(modalEl, '[data-role="enquiry-adult"]', '0');

    setTextSafeIn(modalEl, '[data-role="enquiry-child"]', '0');

    setTextSafeIn(modalEl, '[data-role="enquiry-meal"]', '-');



    // âœ… Applied reset (Adult + Child + Baby + meal)

    setTextSafeIn(modalEl, '[data-role="applied-adult"]', '0');

    setTextSafeIn(modalEl, '[data-role="applied-child"]', '0');

    setTextSafeIn(modalEl, '[data-role="applied-baby"]', '0');

    setTextSafeIn(modalEl, '[data-role="applied-meal"]', '-');

    setHtmlSafeIn(modalEl, '#mealMismatchIconWrap', '');

    setHtmlSafeIn(modalEl, '#appliedMealWarningWrap', '');



    // âœ… reset pax-wise bed utilization spans

    var spans = modalEl.querySelectorAll('[data-role^="adult-"],[data-role^="child-"],[data-role^="baby-"]');

    for (var i = 0; i < spans.length; i++) spans[i].textContent = '0';



    // âœ… hidden fields

    var modalLead = document.getElementById('modal_lead_id');

    var modalProp = document.getElementById('modal_property_id');

    var modalRoom = document.getElementById('modal_room_category_id');

    var savedTariffId = document.getElementById('modal_quotation_room_tariff_details_id').value || '';

    if (modalLead) modalLead.value = leadId;

    if (modalProp) modalProp.value = propertyId;

    if (modalRoom) modalRoom.value = roomCategoryId;



    // âœ… open modal first

    // bootstrap.Modal.getOrCreateInstance(modalEl).show();

//     $('#roompricingandguestallocationModal').modal({

//   backdrop: 'static',

//   keyboard: false,

//   show: true

// });

$('#roompricingandguestallocationModal').modal('show'); // show bootstrap modal



    /* ================= API URLS ================= */

    var urlPolicy =

        `<?php echo base_url(); ?>index.php/Quotation/ajax_get_room_policy_details` +

        `?lead_id=${encodeURIComponent(leadId)}` +

        `&property_id=${encodeURIComponent(propertyId)}` +

        `&room_category_id=${encodeURIComponent(roomCategoryId)}`;



    // var urlEnquiry =

    //     `<?php echo base_url(); ?>index.php/Quotation/ajax_get_in_enquiry_context` +

    //     `?lead_id=${encodeURIComponent(leadId)}` +

    //     `&property_day_id=${encodeURIComponent(propertyDayId)}` +

    //     `&stay_destination_id=${encodeURIComponent(stayDestId)}` +

    //     `&property_id=${encodeURIComponent(propertyId)}` +

    //     `&room_category_id=${encodeURIComponent(roomCategoryId)}`;



    var urlEnquiry =

      `<?php echo base_url(); ?>index.php/Quotation/ajax_get_in_enquiry_context` +

      `?lead_id=${encodeURIComponent(leadId)}` +

      `&day_id_fk=${encodeURIComponent(itineraryDayId)}` +

      `&stay_destination_id=${encodeURIComponent(stayDestId)}` +

      `&property_id=${encodeURIComponent(propertyId)}` +

      `&room_category_id=${encodeURIComponent(roomCategoryId)}`;



    // var urlApplied =

    //     `<?php echo base_url(); ?>index.php/Quotation/ajax_get_applied_plan_context` +

    //     `?lead_id=${encodeURIComponent(leadId)}` +

    //     `&property_day_id=${encodeURIComponent(propertyDayId)}` +

    //     `&stay_destination_id=${encodeURIComponent(stayDestId)}` +

    //     `&property_id=${encodeURIComponent(propertyId)}` +

    //     `&room_category_id=${encodeURIComponent(roomCategoryId)}`;

    

    var urlApplied =

    `<?php echo base_url(); ?>index.php/Quotation/ajax_get_applied_plan_context` +

    `?lead_id=${encodeURIComponent(leadId)}` +

    `&day_id_fk=${encodeURIComponent(itineraryDayId)}` +

    `&stay_destination_id=${encodeURIComponent(stayDestId)}` +

    `&property_id=${encodeURIComponent(propertyId)}` +

    `&room_category_id=${encodeURIComponent(roomCategoryId)}`;



    /* ================= LOAD ALL ================= */

    Promise.all([

        fetch(urlPolicy).then(function (r) { return r.json(); }),

        fetch(urlEnquiry).then(function (r) { return r.json(); }),

        fetch(urlApplied).then(function (r) { return r.json(); })

    ])

    .then(function (responses) {



        var policyRes = responses[0];

        var enquiryRes = responses[1];

        var appliedRes = responses[2];



        /* ================= POLICY UI ================= */

        var policy = { db: 0, eb: 0, sb: 0 };



        if (policyRes && policyRes.status) {



            var lead = (policyRes.data && policyRes.data.lead) ? policyRes.data.lead : {};

            var property = (policyRes.data && policyRes.data.property) ? policyRes.data.property : {};

            var room = (policyRes.data && policyRes.data.room) ? policyRes.data.room : {};



            var db  = parseInt(room.properties_room_category_number_of_adults_allowed, 10);

            var eb  = parseInt(room.properties_room_category_extra_bed_mattress_allowed_in_room, 10);

            var sb  = parseInt(room.properties_room_category_children_allowed_on_bed_sharing_basis, 10);

            var inv = room.properties_room_category_inventory;



            if (isNaN(db)) db = 0;

            if (isNaN(eb)) eb = 0;

            if (isNaN(sb)) sb = 0;

            if (inv === undefined || inv === null) inv = 0;



            policy = { db: db, eb: eb, sb: sb };



            setTextSafeIn(modalEl, '#modalLeadInfo', 'Lead No: ' + (lead.leads_number || '-'));



            setHtmlSafeIn(

                modalEl,

                '#modalRoomInfo',

                (property.properties_name || '-') + '<br>' +

                (room.properties_room_category_name || '-') + '<br>' +

                'DB:' + db + ' | EB:' + eb + ' | SB:' + sb + ' | Inventory:' + inv

            );



            setTextSafeIn(modalEl, '[data-role="room-policy"]', 'DB:' + db + ' | EB:' + eb + ' | SB:' + sb + ' | Inventory:' + inv);



            // Room default meal plan name

            setTextSafeIn(modalEl, '[data-role="meal-plan"]', room.meal_plan_name || '-');



            // Baby/Child age range text from backend (if you return it)

            var agesTxt = (policyRes.data && policyRes.data.policy_ages_text) ? policyRes.data.policy_ages_text : '';

            setTextSafeIn(modalEl, '[data-role="room-policy-ages"]', agesTxt ? agesTxt : 'Baby - | Child -');

        }



        /* ================= IN ENQUIRY UI ================= */

        if (enquiryRes && enquiryRes.status) {



            var eqData = enquiryRes.data ? enquiryRes.data : {};

            var eqPlan = eqData.plan ? eqData.plan : null;



            setTextSafeIn(modalEl, '[data-role="enquiry-meal"]', eqData.meal_plan_name || '-');



            if (eqPlan) {

                setTextSafeIn(modalEl, '[data-role="enquiry-adult"]', (eqPlan.adults !== undefined && eqPlan.adults !== null) ? eqPlan.adults : 0);

                setTextSafeIn(modalEl, '[data-role="enquiry-child"]', (eqPlan.children !== undefined && eqPlan.children !== null) ? eqPlan.children : 0);

            } else {

                setTextSafeIn(modalEl, '[data-role="enquiry-adult"]', '0');

                setTextSafeIn(modalEl, '[data-role="enquiry-child"]', '0');

            }



        } else {

            setTextSafeIn(modalEl, '[data-role="enquiry-adult"]', '0');

            setTextSafeIn(modalEl, '[data-role="enquiry-child"]', '0');

            setTextSafeIn(modalEl, '[data-role="enquiry-meal"]', '-');

        }



        /* ================= APPLIED UI ================= */

        var appliedPlan = { adults: 0, children: 0, baby: 0 };



        setTextSafeIn(modalEl, '[data-role="applied-meal"]', '-');

        setHtmlSafeIn(modalEl, '#mealMismatchIconWrap', '');

        setHtmlSafeIn(modalEl, '#appliedMealWarningWrap', '');



        if (appliedRes && appliedRes.status) {



            var apData = appliedRes.data ? appliedRes.data : {};



            // Applied meal name

            setTextSafeIn(modalEl, '[data-role="applied-meal"]', apData.meal_plan_name || '-');



            // mismatch icon (ONLY for applied meal)data-bs-placement="top"

            if (parseInt(apData.meal_plan_mismatch, 10) === 1) {



                setHtmlSafeIn(modalEl, '#mealMismatchIconWrap', (

                    '<span class="ms-2 text-warning" ' +

                    'data-bs-toggle="tooltip" data-placement="top" ' +

                    'title="Room\'s default meal plan is overridden by the enquiry meal plan">' +

                    '<i class="bi bi-exclamation-triangle-fill"></i>' +

                    '</span>'

                ));



                var wrap = modalEl.querySelector('#mealMismatchIconWrap');

                var tipEl = wrap ? wrap.querySelector('[data-bs-toggle="tooltip"]') : null;

                // if (tipEl) new bootstrap.Tooltip(tipEl);

                if (tipEl) $(tipEl).tooltip();

            }



            // EP room-only warning: room default meal plan id = 2

            // if (parseInt(apData.room_is_ep_room_only, 10) === 1) {

            //     setHtmlSafeIn(modalEl, '#appliedMealWarningWrap',

            //         '<div class="text-danger mt-2"><small>' +

            //         'Meal rates not found. Update rates or enter manually in the supplement cost field.' +

            //         '</small></div>'

            //     );

            // }



            // Applied counts computed in backend (adult/child/baby)

            if (apData.applied) {

                appliedPlan.adults = parseInt(apData.applied.adults, 10); if (isNaN(appliedPlan.adults)) appliedPlan.adults = 0;

                appliedPlan.children = parseInt(apData.applied.children, 10); if (isNaN(appliedPlan.children)) appliedPlan.children = 0;

                appliedPlan.baby = parseInt(apData.applied.baby, 10); if (isNaN(appliedPlan.baby)) appliedPlan.baby = 0;

            }



            setTextSafeIn(modalEl, '[data-role="applied-adult"]', appliedPlan.adults);

            setTextSafeIn(modalEl, '[data-role="applied-child"]', appliedPlan.children);

            setTextSafeIn(modalEl, '[data-role="applied-baby"]', appliedPlan.baby);



        } else {

            setTextSafeIn(modalEl, '[data-role="applied-adult"]', '0');

            setTextSafeIn(modalEl, '[data-role="applied-child"]', '0');

            setTextSafeIn(modalEl, '[data-role="applied-baby"]', '0');

            setTextSafeIn(modalEl, '[data-role="applied-meal"]', '-');

        }



        /* ================= AUTO ALLOCATION ================= */

        if (typeof autoAllocateBeds === 'function' && typeof applyAutoAllocationToModal === 'function') {

            var allocation = allocateRooms(policy, appliedPlan);

            applyAutoAllocationToModal(allocation);

            updateRemainingUI(allocation);



            // Store context for manual validation

            var _pDb = document.getElementById('modal_policy_db');

            var _pEb = document.getElementById('modal_policy_eb');

            var _pSb = document.getElementById('modal_policy_sb');

            var _pAdults = document.getElementById('modal_applied_adults');

            var _pChildren = document.getElementById('modal_applied_children');

            var _pBaby = document.getElementById('modal_applied_baby');

            var _pMin = document.getElementById('modal_min_rooms_required');

            if (_pDb) _pDb.value = policy.db;

            if (_pEb) _pEb.value = policy.eb;

            if (_pSb) _pSb.value = policy.sb;

            if (_pAdults) _pAdults.value = appliedPlan.adults;

            if (_pChildren) _pChildren.value = appliedPlan.children;

            if (_pBaby) _pBaby.value = appliedPlan.baby;

            if (_pMin) _pMin.value = allocation.totalRooms;



            // 1) copy auto -> manual so manual starts same

            syncAutoToManualCountsAndRates();



           // 2) calculate amounts + totals for both

          //  refreshAllAmountsAndTotals();



        }



    //     const urlTariff =

    // `<?php echo base_url(); ?>index.php/Quotation/ajax_get_tariff_by_context` +

    // `?lead_id=${encodeURIComponent(leadId)}` +

    // `&property_day_id=${encodeURIComponent(propertyDayId)}` +

    // `&stay_destination_id=${encodeURIComponent(stayDestId)}` +

    // `&property_id=${encodeURIComponent(propertyId)}` +

    // `&room_category_id=${encodeURIComponent(roomCategoryId)}`;



    const urlTariff =

    `<?php echo base_url(); ?>index.php/Quotation/ajax_get_tariff_by_context` +

    `?lead_id=${encodeURIComponent(leadId)}` +

    `&day_id_fk=${encodeURIComponent(itineraryDayId)}` +

    `&stay_destination_id=${encodeURIComponent(stayDestId)}` +

    `&property_id=${encodeURIComponent(propertyId)}` +

    `&room_category_id=${encodeURIComponent(roomCategoryId)}`;



// fetch(urlTariff)

//   .then(r => r.json())

//   .then(tariffRes => {

//       applyTariffRatesToModal(tariffRes);

//       calcTotalFromAuto(); // optional

//   })



// fetch(urlTariff)

//   .then(r => r.json())

//   .then(tariffRes => {



//       applyTariffRatesToModal(tariffRes);



//       // âœ… ensure DOM updated before calculation

//       setTimeout(() => {

//           syncAutoToManualCountsAndRates();   // important

//           refreshAllAmountsAndTotals();       // MAIN FIX

//       }, 50);

//   })



//   .catch(err => console.error('Tariff API error', err));



fetch(urlTariff)

  .then(r => r.json())

  .then(tariffRes => {

      applyTariffRatesToModal(tariffRes);



      if (savedTariffId) {

          fetch(`<?php echo base_url(); ?>index.php/Quotation/ajax_get_saved_quotation_room_tariff_details_by_id?quotation_room_tariff_details_id=${encodeURIComponent(savedTariffId)}`)

            .then(r => r.json())

            .then(savedRes => {

                if (savedRes.status && savedRes.data) {

                    fillSavedManualSection(savedRes.data);

                    maybeAutoSaveRoomTariff();

                } else {

                    refreshAllAmountsAndTotals();

                    maybeAutoSaveRoomTariff();

                }

            })

            .catch(err => {

                console.error(err);

                refreshAllAmountsAndTotals();

                maybeAutoSaveRoomTariff();

            });

      } else {

          refreshAllAmountsAndTotals();

          maybeAutoSaveRoomTariff();

      }

  })

  .catch(err => {

      console.error('Tariff API error', err);

      if (window.__autoCalcActive) {

          cancelAutoCalc('Tariff load failed. Auto calculation stopped.');

      }

  });





    })

    .catch(function (err) {

        console.error(err);

        alert('Error loading modal data');

    });



});





/* ================= Auto Allocation ================= */

function autoAllocateBeds(policy, applied) {



    const roomDB = Number(policy.db || 0);

    const roomEB = Number(policy.eb || 0);

    const roomSB = Number(policy.sb || 0);



    let adults = Number(applied.adults || 0);

    let children = Number(applied.children || 0);

    let baby = Number(applied.baby || 0);



    const dbCap = roomDB > 0 ? roomDB : 2;



    // ===== Adults -> Rooms/DB/EB =====

    let rooms = Math.ceil(adults / dbCap);

    if (rooms < 1 && adults > 0) rooms = 1;



    let adultsInDB = Math.min(adults, rooms * dbCap);

    let remainingAdults = adults - adultsInDB;



    let adultsInEB = 0;



    if (remainingAdults > 0 && roomEB > 0) {

        const ebCapacityTotal = rooms * roomEB;

        adultsInEB = Math.min(remainingAdults, ebCapacityTotal);

        remainingAdults -= adultsInEB;

    }



    while (remainingAdults > 0) {

        rooms += 1;



        const takeDB = Math.min(dbCap, remainingAdults);

        adultsInDB += takeDB;

        remainingAdults -= takeDB;



        if (roomEB > 0 && remainingAdults > 0) {

            const takeEB = Math.min(roomEB, remainingAdults);

            adultsInEB += takeEB;

            remainingAdults -= takeEB;

        }

    }



    // SGL (approx): if remainder is 1 adult in last room

    let remDB = adults % dbCap;

    let adultSGLRooms = (dbCap > 1 && remDB === 1) ? 1 : 0;



    // ===== Children/Baby -> SB =====

    let sbCapacityTotal = rooms * roomSB;



    let childInSB = Math.min(children, sbCapacityTotal);

    let remainingChildren = children - childInSB;



    let babyInSB = Math.min(baby, Math.max(0, sbCapacityTotal - childInSB));

    let remainingBaby = baby - babyInSB;



    let extraChildRooms = 0;



    while ((remainingChildren + remainingBaby) > 0) {



        if (roomSB <= 0) break;



        extraChildRooms += 1;



        const takeChild = Math.min(roomSB, remainingChildren);

        remainingChildren -= takeChild;



        const freeSB = roomSB - takeChild;

        const takeBaby = Math.min(freeSB, remainingBaby);

        remainingBaby -= takeBaby;

    }



    return {

        totalRooms: rooms + extraChildRooms,

        adult: { db: Math.max(0, adults - adultsInEB), eb: adultsInEB, sb: 0, sgl: adultSGLRooms },

        child: { db: 0, eb: 0, sb: (children - remainingChildren), sgl: 0 },

        baby: { db: 0, eb: 0, sb: (baby - remainingBaby), sgl: 0 },

        warnings: { unallocatedChildren: remainingChildren, unallocatedBaby: remainingBaby }

    };

}



function handleSingleAdultSGL(policy) {



    const adults = Number(policy.adults || 0);

    const children = Number(policy.children || 0);

    const baby = Number(policy.baby || 0);



    // âœ… Only 1 adult and no dependents

    if (adults === 1 && children === 0 && baby === 0) {

        return {

            isHandled: true,

            result: {

                totalRooms: 0,

                adult: {

                    db: 0,

                    eb: 0,

                    sb: 0,

                    sgl: 1

                },

                child: { db: 0, eb: 0, sb: 0 },

                baby: { db: 0, eb: 0, sb: 0 }

            }

        };

    }



    return { isHandled: false };

}



function allocateRooms(applied, policy) {



    // ðŸ”¹ Step 0: Check SGL condition

    const sglCheck = handleSingleAdultSGL(policy);



    if (sglCheck.isHandled) {

        return sglCheck.result;

    }

    

    const baseAdults = Number(policy.adults || 0);

    const baseChildren = Number(policy.children || 0);

    const baseBaby = Number(policy.baby || 0);



    const roomDB = Number(applied.db || 0); // per room

    const roomEB = Number(applied.eb || 0); // per room

    const roomSB = Number(applied.sb || 0); // per room (child sharing)



    const effectiveCapacity = roomDB + roomEB + roomSB;



    if (effectiveCapacity === 0) {

        throw new Error("Invalid room config: DB + EB + SB cannot be 0");

    }



    // -------------------------------

    // ðŸ¨ STEP 1: INITIAL ROOM ESTIMATE

    // -------------------------------

    const totalGuests = baseAdults + baseChildren + baseBaby;

    let rooms = Math.ceil(totalGuests / effectiveCapacity) || 1;



    // -------------------------------

    // ðŸ” STEP 2: ALLOCATION LOOP

    // -------------------------------

    while (true) {



        let adults = baseAdults;

        let children = baseChildren;

        let baby = baseBaby;



        // capacities

        let totalDB = rooms * roomDB;

        let totalEB = rooms * roomEB;

        let totalSB = rooms * roomSB;



        // -------------------------------

        // ðŸ‘¶ 1. BABY â†’ SB

        // -------------------------------

        let babySB = Math.min(baby, totalSB);

        baby -= babySB;



        let remainingSB = totalSB - babySB;



        // -------------------------------

        // ðŸ‘¨ 2. ADULT â†’ DB

        // -------------------------------

        let adultDB = Math.min(adults, totalDB);

        adults -= adultDB;



        let remainingDB = totalDB - adultDB;



        // -------------------------------

        // ðŸ§’ 3. CHILD â†’ remaining DB (use free DB slots before SB/EB)

        // -------------------------------

        let childDB = Math.min(children, remainingDB);

        children -= childDB;



        remainingDB -= childDB;



        // -------------------------------

        // ðŸ§’ 4. CHILD â†’ SB (only if DB is full)

        // -------------------------------

        let childSB = Math.min(children, remainingSB);

        children -= childSB;



        remainingSB -= childSB;



        // -------------------------------

        // ðŸ‘¶ 5. BABY â†’ EB

        // -------------------------------

        let babyEB = Math.min(baby, totalEB);

        baby -= babyEB;



        let remainingEB = totalEB - babyEB;



        // -------------------------------

        // ðŸ‘¨ 6. ADULT â†’ EB

        // -------------------------------

        let adultEB = Math.min(adults, remainingEB);

        adults -= adultEB;



        remainingEB -= adultEB;



        // -------------------------------

        // ðŸ§’ 7. CHILD â†’ EB

        // -------------------------------

        let childEB = Math.min(children, remainingEB);

        children -= childEB;



        remainingEB -= childEB;



        // -------------------------------

        // âœ… CHECK: ALL ALLOCATED?

        // -------------------------------

        if (adults === 0 && children === 0 && baby === 0) {

            return {

                totalRooms: rooms,

                capacity: {

                    totalDB: totalDB,

                    totalEB: totalEB,

                    totalSB: totalSB,

                    remainingDB: remainingDB,

                    remainingEB: remainingEB,

                    remainingSB: remainingSB

                },



                adult: {

                    db: adultDB,

                    eb: adultEB,

                    sb: 0

                },



                child: {

                    db: childDB,

                    eb: childEB,

                    sb: childSB

                },



                baby: {

                    db: 0,

                    eb: babyEB,

                    sb: babySB

                }

            };

        }



        // -------------------------------

        // â— NOT ENOUGH â†’ INCREASE ROOMS

        // -------------------------------

        rooms++;

    }

}



function setValSafe(selector, val) {

    const el = document.querySelector(selector);

    if (el) el.value = (val ?? 0);

}



function applyAutoAllocationToModal(result) {



    // ---------------------------

    // AUTO ROOMING PLAN INPUTS

    // ---------------------------

    setValSafe('#roompricingandguestallocationModal [name="auto_room_member_count"]', result.totalRooms ?? 0);



    // If your autoAllocateBeds also calculates these, use them.

    // If not, they will become 0 (safe).

    setValSafe('#roompricingandguestallocationModal [name="auto_extra_bed_adult_count"]', result.adult?.eb ?? 0);

    setValSafe('#roompricingandguestallocationModal [name="auto_extra_bed_child_count"]', result.child?.eb ?? 0);

    setValSafe('#roompricingandguestallocationModal [name="auto_child_sharing_bed_count"]', result.child?.sb ?? 0);

    setValSafe('#roompricingandguestallocationModal [name="auto_single_occupancy_count"]', result.adult?.sgl ?? 0);

    setValSafe('#roompricingandguestallocationModal [name="auto_supplment_cost_count"]', 0); // later



    // ---------------------------

    // âœ… MANUAL DEFAULTS = SAME AS AUTO

    // ---------------------------

    setValSafe('#roompricingandguestallocationModal [name="manual_count"]', result.totalRooms ?? 0);

    setValSafe('#roompricingandguestallocationModal [name="manual_extra_bed_adult_count"]', result.adult?.eb ?? 0);

    setValSafe('#roompricingandguestallocationModal [name="manual_extra_bed_child_count"]', result.child?.eb ?? 0);

    setValSafe('#roompricingandguestallocationModal [name="manual_child_sharing_bed_count"]', result.child?.sb ?? 0);

    setValSafe('#roompricingandguestallocationModal [name="manual_single_occupancy_count"]', result.adult?.sgl ?? 0);

    setValSafe('#roompricingandguestallocationModal [name="manual_supplment_cost_count"]', 0); // later



    // ---------------------------

    // PAX-WISE BED UTILIZATION

    // ---------------------------

    setTextSafe('#roompricingandguestallocationModal [data-role="adult-db"]',  result.adult?.db  ?? 0);

    setTextSafe('#roompricingandguestallocationModal [data-role="adult-eb"]',  result.adult?.eb  ?? 0);

    setTextSafe('#roompricingandguestallocationModal [data-role="adult-sb"]',  result.adult?.sb  ?? 0);

    setTextSafe('#roompricingandguestallocationModal [data-role="adult-sgl"]', result.adult?.sgl ?? 0);



    setTextSafe('#roompricingandguestallocationModal [data-role="child-db"]',  result.child?.db  ?? 0);

    setTextSafe('#roompricingandguestallocationModal [data-role="child-eb"]',  result.child?.eb  ?? 0);

    setTextSafe('#roompricingandguestallocationModal [data-role="child-sb"]',  result.child?.sb  ?? 0);

    setTextSafe('#roompricingandguestallocationModal [data-role="child-sgl"]', result.child?.sgl ?? 0);



    setTextSafe('#roompricingandguestallocationModal [data-role="baby-db"]',   result.baby?.db   ?? 0);

    setTextSafe('#roompricingandguestallocationModal [data-role="baby-eb"]',   result.baby?.eb   ?? 0);

    setTextSafe('#roompricingandguestallocationModal [data-role="baby-sb"]',   result.baby?.sb   ?? 0);

    setTextSafe('#roompricingandguestallocationModal [data-role="baby-sgl"]',  result.baby?.sgl  ?? 0);



    baby_child_sharing_count = result.baby?.sb;

    var total_baby_foc = (result.baby?.sb ?? 0) + (result.baby?.eb ?? 0);



    if(total_baby_foc > 0){

        $('.child-note-foc').text(`Child on FOC basis (${total_baby_foc})`);

        $('.child-note-foc').show();

    }



    var _babySbEl = document.getElementById('modal_baby_sb_count');

    var _babyEbEl = document.getElementById('modal_baby_eb_count');

    if (_babySbEl) _babySbEl.value = result.baby?.sb ?? 0;

    if (_babyEbEl) _babyEbEl.value = result.baby?.eb ?? 0;

    // ---------------------------

    // WARNINGS (optional)

    // ---------------------------

    if (result.warnings && (result.warnings.unallocatedChildren > 0 || result.warnings.unallocatedBaby > 0)) {

        console.warn('Unallocated pax due to policy limits:', result.warnings);

    }

}



function setInputSafe(selector, val) {

    const el = document.querySelector(selector);

    if (el) el.value = (val === undefined || val === null) ? '' : val;

}



function applyTariffRatesToModal(tariffRes) {



    if (!tariffRes || !tariffRes.status) return;



    const d = tariffRes.data || {};

    const rates = d.rates || {};



    // Store tariff data on modal for warning checks

    const modalEl = document.getElementById('roompricingandguestallocationModal');

    if (modalEl) {

        modalEl.dataset.tariffData = JSON.stringify({

            rates: rates,

            supplement_amount: d.supplement_amount || 0,

            needs_supplement: d.needs_supplement || false,

            missing_meals: d.missing_meals || [],

            meal_rates_missing: d.meal_rates_missing || [],

            meal_rates_source: d.meal_rates_source || '',

            rates_source: d.rates_source || ''

        });

    }



    // âœ… Rooms | Units RATE (Auto + Manual)

    setInputSafe('#roompricingandguestallocationModal [name="auto_room_member_rate"]', rates.room_rate || 0);

    setInputSafe('#roompricingandguestallocationModal [name="manual_rate"]', rates.room_rate || 0);



    // âœ… Extra Bed Adult RATE (Auto + Manual)

    setInputSafe('#roompricingandguestallocationModal [name="auto_extra_bed_adult_rate"]', rates.adult_eb_rate || 0);

    setInputSafe('#roompricingandguestallocationModal [name="manual_extra_bed_adult_rate"]', rates.adult_eb_rate || 0);



    // âœ… Extra Bed Child RATE (Auto + Manual)

    setInputSafe('#roompricingandguestallocationModal [name="auto_extra_bed_child_rate"]', rates.child_eb_rate || 0);

    setInputSafe('#roompricingandguestallocationModal [name="manual_extra_bed_child_rate"]', rates.child_eb_rate || 0);



    // âœ… Child Sharing Bed RATE (Auto + Manual)

    setInputSafe('#roompricingandguestallocationModal [name="auto_child_sharing_bed_rate"]', rates.child_sb_rate || 0);

    setInputSafe('#roompricingandguestallocationModal [name="manual_child_sharing_bed_rate"]', rates.child_sb_rate || 0);



    // âœ… Single Occupancy RATE (Auto + Manual)

    setInputSafe('#roompricingandguestallocationModal [name="auto_single_occupancy_rate"]', rates.sgl_rate || 0);

    setInputSafe('#roompricingandguestallocationModal [name="manual_single_occupancy_rate"]', rates.sgl_rate || 0);



    // âœ… Supplement Cost COUNT = NA (Auto + Manual)

    const supCountAuto = document.querySelector('#roompricingandguestallocationModal [name="auto_supplment_cost_count"]');

    const supCountMan  = document.querySelector('#roompricingandguestallocationModal [name="manual_supplment_cost_count"]');

    if (supCountAuto) { supCountAuto.value = 'NA'; supCountAuto.setAttribute('readonly','readonly'); }

    if (supCountMan)  { supCountMan.value  = 'NA'; supCountMan.setAttribute('readonly','readonly'); }



    // âœ… Supplement Cost RATE (Auto + Manual)

    setInputSafe('#roompricingandguestallocationModal [name="auto_supplment_cost"]', d.supplement_amount || 0);

    setInputSafe('#roompricingandguestallocationModal [name="manual_supplment_cost"]', d.supplement_amount || 0);

}



function calcTotalFromAuto() {



    const num = (sel) => parseFloat(document.querySelector(sel)?.value || 0) || 0;



    const roomsCount = num('#roompricingandguestallocationModal [name="auto_room_member_count"]');

    const roomsRate  = num('#roompricingandguestallocationModal [name="auto_room_member_rate"]');



    const ebAcount = num('#roompricingandguestallocationModal [name="auto_extra_bed_adult_count"]');

    const ebArate  = num('#roompricingandguestallocationModal [name="auto_extra_bed_adult_rate"]');



    const ebCcount = num('#roompricingandguestallocationModal [name="auto_extra_bed_child_count"]');

    const ebCrate  = num('#roompricingandguestallocationModal [name="auto_extra_bed_child_rate"]');



    const sbCount = num('#roompricingandguestallocationModal [name="auto_child_sharing_bed_count"]');

    const sbRate  = num('#roompricingandguestallocationModal [name="auto_child_sharing_bed_rate"]');



    const sglCount = num('#roompricingandguestallocationModal [name="auto_single_occupancy_count"]');

    const sglRate  = num('#roompricingandguestallocationModal [name="auto_single_occupancy_rate"]');



    const supplement = num('#roompricingandguestallocationModal [name="auto_supplment_cost"]');



    const total =

        (roomsCount * roomsRate) +

        (ebAcount * ebArate) +

        (ebCcount * ebCrate) +

        (sbCount * sbRate) +

        (sglCount * sglRate) +

        supplement;



    setTextSafe('#modalTotalRate', total.toFixed(2));

}



/* ================= RATE + AMOUNT CALC HELPERS ================= */



function toNumber(val) {

  if (val === null || val === undefined) return 0;

  val = ('' + val).replace(/,/g, '').trim();

  if (val === '' || val.toUpperCase() === 'NA') return 0;

  const n = parseFloat(val);

  return isNaN(n) ? 0 : n;

}



function money(val) {

  // you can format if you want. Keeping simple:

  const n = toNumber(val);

  return (Math.round(n * 100) / 100).toFixed(2);

}



function getPlanInput(plan, line, field) {

  return document.querySelector(

    `#roompricingandguestallocationModal [data-plan="${plan}"][data-line="${line}"][data-field="${field}"]`

  );

}



function setAmount(plan, line, amount) {

  const span = document.querySelector(

    `#roompricingandguestallocationModal [data-role="amount-${plan}-${line}"]`

  );

  if (span) span.textContent = money(amount);



  const hidden = document.querySelector(

    `#roompricingandguestallocationModal [data-save="${plan}"][data-line="${line}"][data-save-field="amount"]`

  );

  if (hidden) hidden.value = money(amount);

}



function calcLineAmount(plan, line) {

  const countEl = getPlanInput(plan, line, 'count');

  const rateEl  = getPlanInput(plan, line, 'rate');



  const rate = toNumber(rateEl ? rateEl.value : 0);



  // Supplement: amount = rate only (count is NA)

  if (line === 'supplement') {

    setAmount(plan, line, rate);

    return rate;

  }



  const count = toNumber(countEl ? countEl.value : 0);

  const amt = count * rate;

  setAmount(plan, line, amt);

  return amt;

}



function calcTotal(plan) {

  const lines = ['rooms', 'eb_adult', 'eb_child', 'sb_child', 'sgl', 'supplement'];

  let total = 0;



  lines.forEach(line => {

    total += calcLineAmount(plan, line);

  });



  // total html + hidden

  const totalSpan = document.querySelector(`#roompricingandguestallocationModal [data-role="total-${plan}"]`);

  if (totalSpan) totalSpan.textContent = money(total);



  const totalHidden = document.getElementById(`${plan}_total_rate`);

  if (totalHidden) totalHidden.value = money(total);



  return total;

}



/* Copy Auto -> Manual counts/rates so manual starts same as auto */

function syncAutoToManualCountsAndRates() {

  const lines = ['rooms', 'eb_adult', 'eb_child', 'sb_child', 'sgl', 'supplement'];



  lines.forEach(line => {

    const aCount = getPlanInput('auto', line, 'count');

    const aRate  = getPlanInput('auto', line, 'rate');

    const mCount = getPlanInput('manual', line, 'count');

    const mRate  = getPlanInput('manual', line, 'rate');



    // manual should start same values (only if inputs exist)

    if (mCount && aCount) mCount.value = aCount.value;

    if (mRate && aRate) mRate.value = aRate.value;

  });

}



/* Call this whenever modal opens or whenever auto allocation/rates loaded */

function refreshAllAmountsAndTotals() {

  // Auto

  calcTotal('auto');

  // Manual

  calcTotal('manual');

}



/* Manual live update when user edits count/rate */

document.addEventListener('input', function (e) {

  const el = e.target;

  if (!el.closest('#roompricingandguestallocationModal')) return;



  const plan = el.dataset.plan;

  const line = el.dataset.line;



  if (plan !== 'manual') return; // only manual updates by user input

  if (!line) return;



  // update only that line and total

  calcLineAmount('manual', line);

  calcTotal('manual');

});



const roomModalEl = document.getElementById('roompricingandguestallocationModal');



if (roomModalEl) {

  roomModalEl.addEventListener('shown.bs.modal', function () {

    // Wait 1 tick so DOM values are painted

    setTimeout(() => {

      refreshAllAmountsAndTotals();

    }, 0);

  });

}



document.getElementById('btnSave1')?.addEventListener('click', function () {



     // âœ… NEW VALIDATION

    if (!validateManualRoomingPlan()) {

        if (window.__autoCalcActive) {

            cancelAutoCalc('Validation failed for a room. Auto calculation stopped.');

        }

        return;

    }



    const dayId   = document.getElementById('modal_packages_properties_days_id_fk')?.value || '';

    const roomRow = document.getElementById('modal_quotation_properties_rooms_id_fk')?.value || '';



    if (!dayId || !roomRow) {

        console.log({ dayId, roomRow });

        if (window.__autoCalcActive) {

            cancelAutoCalc('Missing Day ID or Room Row ID. Auto calculation stopped.');

        } else {

            alert('Missing Day ID or Room Row ID');

        }

        return;

    }



    const fd = new FormData();

    fd.append('packages_properties_days_id_fk', dayId);

    fd.append('quotation_properties_rooms_id_fk', roomRow);



    const spanNum = (sel) => (document.querySelector(sel)?.textContent || '0').trim();

    const inputVal = (sel, def='0') => (document.querySelector(sel)?.value ?? def);



    const quotationRoomTariffDetailsId =

    document.getElementById('modal_quotation_room_tariff_details_id')?.value || '';



    fd.append('quotation_room_tariff_details_id', quotationRoomTariffDetailsId);

    // pax wise

    fd.append('pax_wise_bed_adult_db_count', spanNum('[data-role="adult-db"]'));

    fd.append('pax_wise_bed_adult_eb_count', spanNum('[data-role="adult-eb"]'));

    fd.append('pax_wise_bed_adult_sgl_count', spanNum('[data-role="adult-sb"]'));



    fd.append('pax_wise_bed_child_db_count', spanNum('[data-role="child-db"]'));

    fd.append('pax_wise_bed_child_eb_count', spanNum('[data-role="child-eb"]'));

    fd.append('pax_wise_bed_child_sb_count', spanNum('[data-role="child-sb"]'));



    fd.append('pax_wise_bed_baby_db_count', spanNum('[data-role="baby-db"]'));

    fd.append('pax_wise_bed_baby_eb_count', spanNum('[data-role="baby-eb"]'));

    fd.append('pax_wise_bed_baby_sb_count', spanNum('[data-role="baby-sb"]'));



    // Auto inputs

    fd.append('room_unit_auto_count', inputVal('[name="auto_room_member_count"]'));

    fd.append('room_unit_auto_rate', inputVal('[name="auto_room_member_rate"]'));

    fd.append('room_unit_auto_total_rate', (document.querySelector('[data-role="amount-auto-rooms"]')?.textContent || '0'));



    fd.append('extra_bed_adult_auto_count', inputVal('[name="auto_extra_bed_adult_count"]'));

    fd.append('extra_bed_adult_auto_rate', inputVal('[name="auto_extra_bed_adult_rate"]'));

    fd.append('extra_bed_adult_auto_total_rate', (document.querySelector('[data-role="amount-auto-eb_adult"]')?.textContent || '0'));



    fd.append('extra_bed_child_auto_count', inputVal('[name="auto_extra_bed_child_count"]'));

    fd.append('extra_bed_child_auto_rate', inputVal('[name="auto_extra_bed_child_rate"]'));

    fd.append('extra_bed_child_auto_total_rate', (document.querySelector('[data-role="amount-auto-eb_child"]')?.textContent || '0'));



    fd.append('child_sharing_bed_auto_count', inputVal('[name="auto_child_sharing_bed_count"]'));

    fd.append('child_sharing_bed_auto_rate', inputVal('[name="auto_child_sharing_bed_rate"]'));

    fd.append('child_sharing_bed_auto_total_rate', (document.querySelector('[data-role="amount-auto-sb_child"]')?.textContent || '0'));



    fd.append('single_occupancy_auto_count', inputVal('[name="auto_single_occupancy_count"]'));

    fd.append('single_occupancy_auto_rate', inputVal('[name="auto_single_occupancy_rate"]'));

    fd.append('single_occupancy_auto_total_rate', (document.querySelector('[data-role="amount-auto-sgl"]')?.textContent || '0'));



    fd.append('supplyment_auto_cost', inputVal('[name="auto_supplment_cost"]'));

    fd.append('supplyment_auto_total_cost', (document.querySelector('[data-role="amount-auto-supplement"]')?.textContent || '0'));



    // Manual inputs

    fd.append('room_unit_manual_count', inputVal('[name="manual_count"]'));

    fd.append('room_unit_manual_rate', inputVal('[name="manual_rate"]'));

    fd.append('room_unit_manual_total_rate', (document.querySelector('[data-role="amount-manual-rooms"]')?.textContent || '0'));



    fd.append('extra_bed_adult_manual_count', inputVal('[name="manual_extra_bed_adult_count"]'));

    fd.append('extra_bed_adult_manual_rate', inputVal('[name="manual_extra_bed_adult_rate"]'));

    fd.append('extra_bed_adult_manual_total_rate', (document.querySelector('[data-role="amount-manual-eb_adult"]')?.textContent || '0'));



    fd.append('extra_bed_child_manual_count', inputVal('[name="manual_extra_bed_child_count"]'));

    fd.append('extra_bed_child_manual_rate', inputVal('[name="manual_extra_bed_child_rate"]'));

    fd.append('extra_bed_child_manual_total_rate', (document.querySelector('[data-role="amount-manual-eb_child"]')?.textContent || '0'));



    fd.append('child_sharing_bed_manual_count', inputVal('[name="manual_child_sharing_bed_count"]'));

    fd.append('child_sharing_bed_manual_rate', inputVal('[name="manual_child_sharing_bed_rate"]'));

    fd.append('child_sharing_bed_manual_total_rate', (document.querySelector('[data-role="amount-manual-sb_child"]')?.textContent || '0'));



    fd.append('single_occupancy_manual_count', inputVal('[name="manual_single_occupancy_count"]'));

    fd.append('single_occupancy_manual_rate', inputVal('[name="manual_single_occupancy_rate"]'));

    fd.append('single_occupancy_manual_total_rate', (document.querySelector('[data-role="amount-manual-sgl"]')?.textContent || '0'));



    fd.append('supplyment_manual_cost', inputVal('[name="manual_supplment_cost"]'));

    fd.append('supplyment_manual_total_cost', (document.querySelector('[data-role="amount-manual-supplement"]')?.textContent || '0'));



    // totals

    fd.append('auto_total_rate', (document.querySelector('[data-role="total-auto"]')?.textContent || '0'));

    fd.append('manual_total_rate', (document.querySelector('[data-role="total-manual"]')?.textContent || '0'));



    fetch(`<?php echo base_url(); ?>index.php/Quotation/ajax_add_quotation_room_tariff_details`, {

        method: 'POST',

        body: fd

    })

    .then(r => r.json())



    .then(res => {

    if (!res.status) {

        alert(res.message || 'Save failed');

        return;

    }



    const savedId = res.quotation_room_tariff_details_id || '';



    // modal hidden

    const modalIdEl = document.getElementById('modal_quotation_room_tariff_details_id');

    if (modalIdEl) modalIdEl.value = savedId;



    // row hidden

    if (window.__lastRoomEditBtn) {

        const tr = window.__lastRoomEditBtn.closest('tr');



        const tariffIdInput = tr?.querySelector('.quotationRoomTariffDetailsIdInput');

        if (tariffIdInput) tariffIdInput.value = savedId;



        const rateText  = tr?.querySelector('.autoCalcRateText');

        const rateInput = tr?.querySelector('.autoCalcRateInput');



        const manualTotal = num(document.querySelector('#manual_total_rate')?.value || 0);

        const finalTotal  = manualTotal > 0 ? manualTotal : num(document.querySelector('#auto_total_rate')?.value || 0);

        const val = finalTotal.toFixed(2);



        if (rateText)  rateText.textContent = val;

        if (rateInput) rateInput.value = val;



        const optionBlock = window.__lastRoomEditBtn.closest('.optionBlock');

        if (optionBlock) recalcOptionTotals(optionBlock);

    }



    if (window.__lastRoomEditBtn) {

        const tr = window.__lastRoomEditBtn.closest('tr');

        const tariffHidden = tr ? tr.querySelector('.quotationRoomTariffDetailsIdInput') : null;



        if (tariffHidden && res.quotation_room_tariff_details_id) {

            tariffHidden.value = res.quotation_room_tariff_details_id;

        }

    }

    $('#roompricingandguestallocationModal').modal('hide');



    if (window.__autoCalcActive) {

        setTimeout(processNextAutoCalcRoom, 300);

    }

})

    .catch(err => {

        console.error(err);



        if (window.__autoCalcActive) {

            cancelAutoCalc('Save failed. Auto calculation stopped.');

        } else {

            alert('Server error');

        }

    });



});







/* ================= READ VALUES ================= */



/**

 * If you have multiple optionBlocks, we calculate totals using the ACTIVE option.

 * ACTIVE = the optionBlock that user is working on (has selected package option)

 * If you want "highest room among ALL options", change getActiveOptionBlock().

 */

function getActiveOptionBlock() {

  // Best-effort: choose first visible optionBlock

  const blocks = Array.from(document.querySelectorAll('.optionBlock'));

  if (!blocks.length) return null;



  // If you mark active one with class, prefer that:

  const active = document.querySelector('.optionBlock.active');

  if (active) return active;



  // Otherwise take first:

  return blocks[0];

}



function getCabCost() {

  const optionBlock = getActiveOptionBlock();

  if (!optionBlock) return 0;



  const cabEl = optionBlock.querySelector('[name="quotation_options_cab_amount[]"]');

  return toNumber(cabEl ? cabEl.value : 0);

}



function getHighestRoomRate() {

  const optionBlock = getActiveOptionBlock();

  if (!optionBlock) return 0;



  let maxRate = 0;



  // Room rows have hidden input .autoCalcRateInput (your plan)

  optionBlock.querySelectorAll('.autoCalcRateInput').forEach(inp => {

    const v = toNumber(inp.value);

    if (v > maxRate) maxRate = v;

  });



  // If you don't have inputs in some rows, also try text

  optionBlock.querySelectorAll('.autoCalcRateText').forEach(span => {

    const v = toNumber(span.textContent);

    if (v > maxRate) maxRate = v;

  });



  return maxRate;

}



function getInclusionTotal() {

  let total = 0;

  document.querySelectorAll('[name="inclusion_amount[]"]').forEach(inp => {

    total += toNumber(inp.value);

  });

  return total;

}



function getSpecialReqTotal() {

  let total = 0;

  document.querySelectorAll('[name="special_requirements_cost[]"], .specialReqCost').forEach(inp => {

    total += toNumber(inp.value);

  });

  return total;

}



function getMarginAmount(totalCost) {

  const type = document.getElementById('marginType')?.value || 'amount';

  const value = toNumber(document.getElementById('marginValue')?.value);



  if (type === 'percent') {

    return (totalCost * value) / 100;

  }

  return value;

}



/* ================= MAIN CALC ================= */



function refreshQuoteSummaryTotals() {

  const cab = getCabCost();

  const highestRoom = getHighestRoomRate();

  const inclusionTotal = getInclusionTotal();

  const specialReqTotal = getSpecialReqTotal();



  const totalCost = cab + highestRoom + inclusionTotal + specialReqTotal;

  const marginAmount = getMarginAmount(totalCost);

  const totalQuote = totalCost + marginAmount;



  // UI text

  const setText = (id, val) => {

    const el = document.getElementById(id);

    if (el) el.textContent = money(val);

  };



  setText('cabCostText', cab);

  setText('highestRoomText', highestRoom);

  setText('inclusionTotalText', inclusionTotal);

  setText('specialReqTotalText', specialReqTotal);

  setText('marginAmountText', marginAmount);



  setText('totalCostText', totalCost);

  setText('totalQuoteText', totalQuote);



  // Hidden inputs for save

  const totalCostInp = document.getElementById('total_cost');

  const marginInp = document.getElementById('margin_amount');

  const totalQuoteInp = document.getElementById('total_quote_rate');



  if (totalCostInp) totalCostInp.value = money(totalCost);

  if (marginInp) marginInp.value = money(marginAmount);

  if (totalQuoteInp) totalQuoteInp.value = money(totalQuote);

}



/* ================= LIVE UPDATES ================= */



// Any typing in Cab / Inclusion / Special Req should recalc

document.addEventListener('input', function (e) {

  const t = e.target;



  if (

    t.matches('[name="quotation_options_cab_amount[]"]') ||

    t.matches('[name="inclusion_amount[]"]') ||

    t.matches('[name="special_requirements_cost[]"]') ||

    t.closest('.specialReqCost') ||

    t.id === 'marginValue'

  ) {

    refreshQuoteSummaryTotals();

  }

});



// Margin type change

document.addEventListener('change', function (e) {

  const t = e.target;

  if (t && t.id === 'marginType') refreshQuoteSummaryTotals();

});





/* ===== GLOBAL HELPERS ===== */

function num(v) {

  const n = parseFloat(v);

  return isNaN(n) ? 0 : n;

}



/* Highest room auto-calculated rate per day (sum of max per day) */

function calculateHighestRoomRatePerDay(optionBlock) {

  const dayMax = {}; // {dayId: maxRate}



  optionBlock.querySelectorAll('.autoCalcRateInput').forEach(input => {

    const tr = input.closest('tr');

    const dayId = tr?.getAttribute('data-day-id');

    if (!dayId) return;



    const rate = num(input.value);



    if (dayMax[dayId] === undefined || rate > dayMax[dayId]) {

      dayMax[dayId] = rate;

    }

  });



  return Object.values(dayMax).reduce((a, b) => a + b, 0);

}





function recalcOptionTotals(optionBlock) {

  if (!optionBlock) return;



  const cabInput = optionBlock.querySelector('[name="quotation_options_cab_amount[]"]');

  const cabAmount = num(cabInput?.value);



  const roomsTotal = calculateHighestRoomRatePerDay(optionBlock);

  const totalCost = cabAmount + roomsTotal;



  const costText  = optionBlock.querySelector('.optionTotalCostText');

  const costInput = optionBlock.querySelector('.optionTotalCostInput');

  if (costText)  costText.textContent = totalCost.toFixed(2);

  if (costInput) costInput.value = totalCost.toFixed(2);



  const marginTypeEl  = optionBlock.querySelector('.optionMarginType');

  const marginValueEl = optionBlock.querySelector('.optionMarginValue');



  const marginType  = marginTypeEl ? marginTypeEl.value : 'amount';

  const marginValue = num(marginValueEl?.value);



  let marginAmount = 0;

  if (marginType === 'percent') marginAmount = (totalCost * marginValue) / 100;

  else marginAmount = marginValue;



  const quoteTotal = totalCost + marginAmount;



  const quoteText  = optionBlock.querySelector('.optionQuoteTotalText');

  const quoteInput = optionBlock.querySelector('.optionQuoteTotalInput');

  if (quoteText)  quoteText.textContent = quoteTotal.toFixed(2);

  if (quoteInput) quoteInput.value = quoteTotal.toFixed(2);

}



/* ===== LIVE RECALC TRIGGERS ===== */

document.addEventListener('input', function (e) {

  // cab amount

  if (e.target.name === 'quotation_options_cab_amount[]') {

    const optionBlock = e.target.closest('.optionBlock');

    recalcOptionTotals(optionBlock);

  }



  // margin value

  if (e.target.classList.contains('optionMarginValue')) {

    const optionBlock = e.target.closest('.optionBlock');

    recalcOptionTotals(optionBlock);

  }

});



document.addEventListener('change', function (e) {

  // margin type

  if (e.target.classList.contains('optionMarginType')) {

    const optionBlock = e.target.closest('.optionBlock');

    recalcOptionTotals(optionBlock);

  }

});



function setManualField(name, value) {

    var el = document.querySelector('#roompricingandguestallocationModal [name="' + name + '"]');

    if (el) el.value = (value === undefined || value === null) ? '' : value;

}



function fillSavedManualSection(data) {

    if (!data) return;



    setManualField('manual_count', data.room_unit_manual_count || 0);

    setManualField('manual_rate', data.room_unit_manual_rate || 0);



    setManualField('manual_extra_bed_adult_count', data.extra_bed_adult_manual_count || 0);

    setManualField('manual_extra_bed_adult_rate', data.extra_bed_adult_manual_rate || 0);



    setManualField('manual_extra_bed_child_count', data.extra_bed_child_manual_count || 0);

    setManualField('manual_extra_bed_child_rate', data.extra_bed_child_manual_rate || 0);



    setManualField('manual_child_sharing_bed_count', data.child_sharing_bed_manual_count || 0);

    setManualField('manual_child_sharing_bed_rate', data.child_sharing_bed_manual_rate || 0);



    setManualField('manual_single_occupancy_count', data.single_occupancy_manual_count || 0);

    setManualField('manual_single_occupancy_rate', data.single_occupancy_manual_rate || 0);



    setManualField('manual_supplment_cost_count', data.supplyment_manual_cost_count || 'NA');

    setManualField('manual_supplment_cost', data.supplyment_manual_cost || 0);



    var hidden = document.getElementById('manual_total_rate');

    if (hidden) hidden.value = data.manual_total_rate || 0;



    if (typeof refreshAllAmountsAndTotals === 'function') {

        refreshAllAmountsAndTotals();

    }

}

// Status options

const QUOTATION_STATUSES = [

//   { id: 1, text: 'Generated' },

  { id: 2, text: 'Draft' },

  { id: 3, text: 'Sent' },

  { id: 4, text: 'Rejected' },

//   { id: 5, text: 'Confirmed' },

  { id: 6, text: 'Cancelled' }

];



function computeRequiredBedCounts(rooms, policyDb, policyEb, policySb, adults, children, baby) {

    var totalDB = rooms * policyDb;

    var totalEB = rooms * policyEb;

    var totalSB = rooms * policySb;

    var a = adults, c = children, b = baby;



    var babySB  = Math.min(b, totalSB);              b -= babySB;

    var childSB = Math.min(c, totalSB - babySB);     c -= childSB;

    var adultDB = Math.min(a, totalDB);              a -= adultDB;

    var remDB   = totalDB - adultDB;

    var childDB = Math.min(c, remDB);                c -= childDB;

    var babyEB  = Math.min(b, totalEB);              b -= babyEB;

    var remEB   = totalEB - babyEB;

    var adultEB = Math.min(a, remEB);                a -= adultEB; remEB -= adultEB;

    var childEB = Math.min(c, remEB);                c -= childEB;



    return {

        fits:    (a === 0 && c === 0 && b === 0),

        adultEB: adultEB,

        childEB: childEB,

        childSB: childSB,

        babySB:  babySB,

        maxEB:   totalEB,

        maxSB:   totalSB

    };

}



document.addEventListener('input', function (e) {



    if (!e.target.closest('#roompricingandguestallocationModal')) return;



    const el = e.target;



    if (!el.name) return;



    if (el.name.includes('manual')) {



        const row = el.closest('tr') || el.closest('.row');

        if (!row) return;



        const countEl = row.querySelector('[name*="count"]');

        const rateEl  = row.querySelector('[name*="rate"]');



        if (!countEl || !rateEl) return;



        const count = parseFloat(countEl.value) || 0;

        const rate  = parseFloat(rateEl.value) || 0;



        if (count > 0 && rate <= 0) {

            rateEl.classList.add('is-invalid');

        } else {

            rateEl.classList.remove('is-invalid');

        }

    }



    // Live room count adequacy warning

    if (el.name === 'manual_count') {

        var minRooms = parseInt(document.getElementById('modal_min_rooms_required')?.value || 0);

        var enteredRooms = parseInt(el.value || 0);

        var warnDiv = document.getElementById('manual-room-count-warning');

        if (warnDiv && minRooms > 0) {

            if (enteredRooms < minRooms) {

                var policyDb = parseInt(document.getElementById('modal_policy_db')?.value || 0);

                var policyEb = parseInt(document.getElementById('modal_policy_eb')?.value || 0);

                var policySb = parseInt(document.getElementById('modal_policy_sb')?.value || 0);

                var appAdults = parseInt(document.getElementById('modal_applied_adults')?.value || 0);

                var appChildren = parseInt(document.getElementById('modal_applied_children')?.value || 0);

                var appBaby = parseInt(document.getElementById('modal_applied_baby')?.value || 0);

                warnDiv.textContent =

                    'Insufficient rooms: ' + enteredRooms + ' chosen, min ' + minRooms + ' required ' +

                    '(Policy DB:' + policyDb + ' EB:' + policyEb + ' SB:' + policySb +

                    ' | Guests Adults:' + appAdults + ' Children:' + appChildren + ' Baby:' + appBaby + ')';

                warnDiv.style.display = 'block';

                el.classList.add('is-invalid');

            } else {

                warnDiv.style.display = 'none';

                el.classList.remove('is-invalid');

            }

        }

    }



    // Live EB / SB adequacy warnings

    var _ebSbFields = ['manual_count', 'manual_extra_bed_adult_count', 'manual_extra_bed_child_count', 'manual_child_sharing_bed_count'];

    if (_ebSbFields.includes(el.name)) {

        var _rooms    = parseInt(document.querySelector('[name="manual_count"]')?.value || 0);

        var _pDb      = parseInt(document.getElementById('modal_policy_db')?.value || 0);

        var _pEb      = parseInt(document.getElementById('modal_policy_eb')?.value || 0);

        var _pSb      = parseInt(document.getElementById('modal_policy_sb')?.value || 0);

        var _adults   = parseInt(document.getElementById('modal_applied_adults')?.value || 0);

        var _children = parseInt(document.getElementById('modal_applied_children')?.value || 0);

        var _baby     = parseInt(document.getElementById('modal_applied_baby')?.value || 0);



        if (_rooms > 0 && (_adults + _children + _baby) > 0) {

            var _req = computeRequiredBedCounts(_rooms, _pDb, _pEb, _pSb, _adults, _children, _baby);



            var _ebAEl   = document.querySelector('[name="manual_extra_bed_adult_count"]');

            var _ebCEl   = document.querySelector('[name="manual_extra_bed_child_count"]');

            var _sbCEl   = document.querySelector('[name="manual_child_sharing_bed_count"]');

            var _ebAWarn = document.getElementById('manual-eb-adult-warning');

            var _ebCWarn = document.getElementById('manual-eb-child-warning');

            var _sbCWarn = document.getElementById('manual-sb-child-warning');



            var _mEbA = parseInt(_ebAEl?.value || 0);

            var _mEbC = parseInt(_ebCEl?.value || 0);

            var _mSbC = parseInt(_sbCEl?.value || 0);



            var _totalEB    = _mEbA + _mEbC;

            var _babySb = parseInt(document.getElementById('modal_baby_sb_count')?.value || 0);

            var _babyEb = parseInt(document.getElementById('modal_baby_eb_count')?.value || 0);

            var _totalCap  = _rooms * _pDb + _totalEB + _mSbC + _babySb + _babyEb;

            var _totalGuests = _adults + _children + _baby;



            if (_ebAWarn) {

                if (_totalEB > _req.maxEB) {

                    _ebAWarn.textContent = 'Total EB (' + _totalEB + ') exceeds capacity: max ' + _req.maxEB + ' for ' + _rooms + ' room(s)';

                    _ebAWarn.style.display = 'block';

                    if (_ebAEl) _ebAEl.classList.add('is-invalid');

                } else {

                    _ebAWarn.style.display = 'none';

                    if (_ebAEl) _ebAEl.classList.remove('is-invalid');

                }

            }



            if (_ebCWarn) {

                if (_totalEB > _req.maxEB) {

                    _ebCWarn.textContent = 'Total EB (' + _totalEB + ') exceeds capacity: max ' + _req.maxEB + ' for ' + _rooms + ' room(s)';

                    _ebCWarn.style.display = 'block';

                    if (_ebCEl) _ebCEl.classList.add('is-invalid');

                } else {

                    _ebCWarn.style.display = 'none';

                    if (_ebCEl) _ebCEl.classList.remove('is-invalid');

                }

            }



            if (_sbCWarn) {

                if (_mSbC > _req.maxSB) {

                    _sbCWarn.textContent = 'SB (' + _mSbC + ') exceeds capacity: max ' + _req.maxSB + ' for ' + _rooms + ' room(s)';

                    _sbCWarn.style.display = 'block';

                    if (_sbCEl) _sbCEl.classList.add('is-invalid');

                } else if (_totalCap < _totalGuests) {

                    _sbCWarn.textContent = 'Insufficient beds: capacity ' + _totalCap + ' < guests ' + _totalGuests + '. Add rooms, EB, or SB.';

                    _sbCWarn.style.display = 'block';

                    if (_sbCEl) _sbCEl.classList.add('is-invalid');

                } else {

                    _sbCWarn.style.display = 'none';

                    if (_sbCEl) _sbCEl.classList.remove('is-invalid');

                }

            }

        }

    }

});



function validateManualRoomingPlan() {



    let isValid = true;



    function showError(el, msg) {

        var n = new notify({

            title: '',

            style: 'error',

            message: msg,

            icon: 'fas fa-times'

        });

        n.show();

        setTimeout(function(){ n.hide(); }, 5000);



        if (el) {

            el.focus();

            el.classList.add('is-invalid');

            setTimeout(() => el.classList.remove('is-invalid'), 2000);

        }

        isValid = false;

    }



    // Capacity adequacy check

    var minRooms   = parseInt(document.getElementById('modal_min_rooms_required')?.value || 0);

    var policyDb   = parseInt(document.getElementById('modal_policy_db')?.value || 0);

    var policyEb   = parseInt(document.getElementById('modal_policy_eb')?.value || 0);

    var policySb   = parseInt(document.getElementById('modal_policy_sb')?.value || 0);

    var appAdults  = parseInt(document.getElementById('modal_applied_adults')?.value || 0);

    var appChildren= parseInt(document.getElementById('modal_applied_children')?.value || 0);

    var appBaby    = parseInt(document.getElementById('modal_applied_baby')?.value || 0);



    var manualCountEl = document.querySelector('[name="manual_count"]');

    var manualRooms   = parseInt(manualCountEl?.value || 0);



    if (minRooms > 0 && manualRooms < minRooms) {

        alert(

            'Room count is inadequate.\n\n' +

            'You entered: ' + manualRooms + ' room(s)\n' +

            'Minimum required: ' + minRooms + ' room(s)\n\n' +

            'Room policy â€” DB: ' + policyDb + ' | EB: ' + policyEb + ' | SB: ' + policySb + '\n' +

            'Guest requirement â€” Adults: ' + appAdults + ' | Children: ' + appChildren + ' | Baby: ' + appBaby

        );

        if (manualCountEl) {

            manualCountEl.focus();

            manualCountEl.classList.add('is-invalid');

            setTimeout(() => manualCountEl.classList.remove('is-invalid'), 3000);

        }

        return false;

    }



    // EB / SB adequacy check

    if (manualRooms > 0 && (appAdults + appChildren + appBaby) > 0) {

        var req = computeRequiredBedCounts(manualRooms, policyDb, policyEb, policySb, appAdults, appChildren, appBaby);



        var ebAdultEl = document.querySelector('[name="manual_extra_bed_adult_count"]');

        var ebChildEl = document.querySelector('[name="manual_extra_bed_child_count"]');

        var sbChildEl = document.querySelector('[name="manual_child_sharing_bed_count"]');

        var mEbAdult  = parseInt(ebAdultEl?.value || 0);

        var mEbChild  = parseInt(ebChildEl?.value || 0);

        var mSbChild  = parseInt(sbChildEl?.value || 0);



        var babySb = parseInt(document.getElementById('modal_baby_sb_count')?.value || 0);

        var babyEb = parseInt(document.getElementById('modal_baby_eb_count')?.value || 0);

        var totalCap    = manualRooms * policyDb + mEbAdult + mEbChild + mSbChild + babySb + babyEb;

        var totalGuests = appAdults + appChildren + appBaby;

        if (totalCap < totalGuests) {

            alert(

                'Bed capacity is insufficient for all guests.\n\n' +

                'Capacity: ' + manualRooms + ' rooms Ã— DB(' + policyDb + ') + EB(' + (mEbAdult + mEbChild) + ') + SB(' + mSbChild + ') = ' + totalCap + '\n' +

                'Guests: Adults(' + appAdults + ') + Children(' + appChildren + ') + Baby(' + appBaby + ') = ' + totalGuests + '\n\n' +

                'Please increase room count, Extra Beds, or Child Sharing Beds.'

            );

            return false;

        }



        if (mEbAdult + mEbChild > req.maxEB) {

            alert(

                'Total Extra Bed count exceeds room capacity.\n\n' +

                'EB Adult: ' + mEbAdult + ' + EB Child: ' + mEbChild + ' = ' + (mEbAdult + mEbChild) + '\n' +

                'Max EB capacity: ' + req.maxEB + ' (' + manualRooms + ' rooms Ã— EB:' + policyEb + ')'

            );

            return false;

        }



        if (mSbChild > req.maxSB) {

            alert(

                'Child Sharing Bed count exceeds room capacity.\n\n' +

                'Entered: ' + mSbChild + '\n' +

                'Max SB capacity: ' + req.maxSB + ' (' + manualRooms + ' rooms Ã— SB:' + policySb + ')'

            );

            return false;

        }

    }



    // All manual fields

    const fields = [

        {count: 'manual_count', rate: 'manual_rate', label: 'Room Units'},

        {count: 'manual_extra_bed_adult_count', rate: 'manual_extra_bed_adult_rate', label: 'Extra Bed Adult'},

        {count: 'manual_extra_bed_child_count', rate: 'manual_extra_bed_child_rate', label: 'Extra Bed Child'},

        {count: 'manual_child_sharing_bed_count', rate: 'manual_child_sharing_bed_rate', label: 'Child Sharing Bed'},

        {count: 'manual_single_occupancy_count', rate: 'manual_single_occupancy_rate', label: 'Single Occupancy'}

    ];



    for (let f of fields) {



        let countEl = document.querySelector(`[name="${f.count}"]`);

        let rateEl  = document.querySelector(`[name="${f.rate}"]`);



        if (!countEl || !rateEl) continue;



        let count = parseFloat(countEl.value) || 0;

        let rate  = parseFloat(rateEl.value) || 0;



        // âŒ Empty validation

        if (countEl.value === '') {

            showError(countEl, `${f.label} count is required`);

            return false;

        }



        if (rateEl.value === '') {

            showError(rateEl, `${f.label} rate is required`);

            return false;

        }



        // âŒ Logic validation

        if (count > 0 && rate <= 0) {

            showError(rateEl, `${f.label} rate must be greater than 0`);

            return false;

        }

    }



    // âŒ Supplement cost validation

    var modalEl2 = document.getElementById('roompricingandguestallocationModal');

    var tariffData2 = null;

    if (modalEl2 && modalEl2.dataset.tariffData) {

        try { tariffData2 = JSON.parse(modalEl2.dataset.tariffData); } catch (e) { tariffData2 = null; }

    }



    if (tariffData2 && tariffData2.needs_supplement) {

        let supEl = document.querySelector('[name="manual_supplment_cost"]');

        let supVal = supEl ? (parseFloat(supEl.value) || 0) : 0;



        if (supVal <= 0) {

            showError(supEl, 'Supplement cost is required because the room policy does not cover the enquiry meal plan. Please enter a valid supplement cost.');

            return false;

        }

    }



    return isValid;

}



////////////////////// Quotation Edit /////////////////////////





function edit_quotation(id)

{

    save_method = 'update';

    window.isQuotationEditLoading = true;



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

        url: "<?php echo base_url();?>index.php/Quotation/ajax_edit/" + id,

        type: "GET",

        dataType: "JSON",

        success: function(res)

        {

            if (!res.status) {

                window.isQuotationEditLoading = false;

                alert(res.message || 'Failed to load quotation');

                return;

            }



            const q = res.quotation || {};



            $('[name="id"]').val(q.quotation_id || '');

            $('[name="quotation_date"]').val(q.quotation_date || '');

            $('[name="arriving_destination"]').val(q.arriving_destination || '');

            $('[name="departuring_destination"]').val(q.departuring_destination || '');

            $('[name="quotation_remarks"]').val(q.quotation_remarks || '');



            const leads_id = q.leads_id_fk || '';



            // Ã¢Å“â€¦ support both possible column names

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



            // $('#leads_id').val(leads_id).trigger('change.select2');

            // $('#leads_id_hidden').val(leads_id);

            // Lead disable

// $('[name="leads_id"]').prop('disabled', true).trigger('change.select2');

// $('#leads_id_hidden').val(leads_id);



            $('#packages_id_hidden').val(package_id);

            $('#packages_id_fk').val(package_id);

            $('#template_name_display').text(q.packages_title || '');



            if (!leads_id || !package_id) {

                window.isQuotationEditLoading = false;

                alert('Lead or Template missing');

                return;

            }



            $('#QuotationModal').modal('show');

            $('#QuotationModal .modal-title').text('Edit Quotation Details');

            $('#btnSave').text('Update');



            rebuildQuotationOptionBlocks(res.options || [], package_id, function () {



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



            setTimeout(function () {

                window.isQuotationEditLoading = false;

                $('#addOptionBtn').prop('disabled', false).removeClass('disabled');

            }, 500);

        },

        error: function ()

        {

            window.isQuotationEditLoading = false;

            alert('Error getting data from ajax');

        }

    });

}



/* Template is auto-determined by lead; #packages_id_fk is now hidden */



function loadPackageOptionsIntoDropdown($select, packageId, selectedValue, callback) {

    if (!$select || !$select.length) return;



    $.ajax({

        url: "<?php echo base_url('index.php/Leads/ajax_get_package_property_categories'); ?>",

        type: "GET",

        dataType: "JSON",

        data: { package_id: packageId },

        success: function(res) {



            var rows = (res && res.status && res.data) ? res.data : [];

            var html = '<option value="">Select Template Option</option>';



            for (var i = 0; i < rows.length; i++) {

                html += '<option value="' + rows[i].packages_properties_common_id + '">' +

                            rows[i].packages_properties_common_category_name +

                        '</option>';

            }



            $select.html(html);



            if (selectedValue) {

                $select.val(String(selectedValue));

            }



            if ($.fn.select2) {

                if ($select.hasClass('select2-hidden-accessible')) {

                    $select.select2('destroy');

                }



                $select.select2({

                    width: '100%',

                    placeholder: 'Select Template Option',

                    allowClear: true,

                    dropdownParent: $('#QuotationModal')

                });

            }



            $select.trigger('change.select2');



            if (typeof callback === 'function') {

                callback();

            }

        },

        error: function() {

            $select.html('<option value="">Failed to load options</option>');

            if (typeof callback === 'function') {

                callback();

            }

        }

    });

}



function rebuildQuotationOptionBlocks(options, packageId, doneCallback)

{

    // const $wrap = $('.optionBlockContainer');

    const $wrap = $('#optionsContainer').length ? $('#optionsContainer') : $('.optionBlockContainer');

    $wrap.empty();

    optionCount = 0;



    if (!options || !options.length) {

        if (typeof doneCallback === 'function') doneCallback();

        return;

    }



    let completed = 0;



    options.forEach(function(opt) {



        optionCount++;

        $wrap.append(getOptionTemplate(optionCount));



        const $block = $wrap.children('.optionBlock').last();



        $block.attr('data-option-id', opt.quotation_options_id || '');

        $block.find('[name="quotation_options_title[]"]').val(opt.quotation_options_title || '');

        $block.find('[name="quotation_options_cab_amount[]"]').val(opt.quotation_options_cab_amount || '');

        // $block.find('[name="quotation_options_design_type[]"]').val(opt.quotation_options_design_type || '').trigger('change');

        // $block.find('[name="quotation_options_vehicle_id_fk[]"]').val(opt.quotation_options_vehicle_id_fk || '').trigger('change');



        // Select Design

        const $design = $block.find('[name="quotation_options_design_type[]"]');



        if ($.fn.select2 && !$design.hasClass('select2-hidden-accessible')) {

            $design.select2({

                width: '100%',

                placeholder: 'Select Design',

                allowClear: true,

                dropdownParent: $('#QuotationModal')

            });

        }



        $design.val(String(opt.quotation_options_design_type || '')).trigger('change.select2');





        // Select Vehicle

        const $vehicle = $block.find('[name="quotation_options_vehicle_id_fk[]"]');



        if ($.fn.select2 && !$vehicle.hasClass('select2-hidden-accessible')) {

            $vehicle.select2({

                width: '100%',

                placeholder: 'Select Vehicle',

                allowClear: true,

                dropdownParent: $('#QuotationModal')

            });

        }



        fetchVehicles($vehicle[0], function () {

            $vehicle.val(String(opt.quotation_options_vehicle_id_fk || '')).trigger('change.select2');

        });



        $block.find('[name="quotation_options_room_category_display[]"]').prop(

            'checked',

            parseInt(opt.quotation_options_room_category_display || 0) === 1

        );



        $block.find('[name="quotation_options_meal_plan_display[]"]').prop(

            'checked',

            parseInt(opt.quotation_options_meal_plan_display || 0) === 1

        );



        $block.find('[name="quotation_options_vehicle_display[]"]')

    .prop('checked', parseInt(opt.quotation_options_vehicle_display || 0) === 1);



        // load package option dropdown, then render saved itinerary

        loadPackageOptionsIntoDropdown(

            $block.find('.propertyDropdown'),

            packageId,

            opt.packages_properties_common_id_fk,

            function () {

                buildSavedOptionItinerary($block, opt);



                completed++;

                if (completed === options.length) {

                    if (typeof doneCallback === 'function') doneCallback();

                }

            }

        );

    });

}



function formatItineraryDayDate(dateStr)

{

    if (!dateStr || dateStr === '0000-00-00') return '';



    var parts = dateStr.split('-');

    if (parts.length !== 3) return dateStr;



    var d = new Date(parts[0], parts[1] - 1, parts[2]);



    var days = ['Sun', 'Mon', 'Tue', 'Wed', 'Thu', 'Fri', 'Sat'];

    var months = ['Jan', 'Feb', 'Mar', 'Apr', 'May', 'Jun',

                  'Jul', 'Aug', 'Sep', 'Oct', 'Nov', 'Dec'];



    return days[d.getDay()] + ', ' + parts[2] + ' ' + months[d.getMonth()] + ' ' + parts[0];

}



function buildSavedOptionItinerary($block, optionData)

{

    const container = $block.find('.itineraryContainer');

    if (!container.length) return;



    let html = `

        <div class="table-responsive">

        <table class="table table-bordered">

            <thead style="background: #3949ab; color: #ffffff;">

                <tr>

                    <th style="width: 100px; color: #ffffff;">Day | Date</th>

                    <th style="width: 140px; color: #ffffff;">Stay Destination</th>

                    <th style="color: #ffffff;">Properties & Rooms</th>

                </tr>

            </thead>

            <tbody>

    `;



    (optionData.days || []).forEach(function(day) {



        let propertyGroupsHTML = '';



        (day.properties || []).forEach(function(property) {



            let roomsHTML = '';



            (property.rooms || []).forEach(function(room) {

                const finalRate = parseFloat(room.manual_total_rate || room.auto_total_rate || room.total_room_cost || 0).toFixed(2);



                roomsHTML += `

                    <tr class="room-row" data-room-id="${room.quotation_properties_rooms_id_fk || ''}"

                        data-packages-room-id="${room.packages_properties_rooms_id_fk || 0}"

                        data-day-id="${day.packages_properties_days_id_fk || 0}">

                        <td class="property-ref-cell text-muted" style="border-left:3px solid #0d6efd;"></td>

                        <td class="roomName">

                            ${room.properties_room_category_name || ''}

                            <input type="hidden" name="packages_properties_rooms_id_fk[]" value="${room.packages_properties_rooms_id_fk || 0}">

                            <input type="hidden" name="quotation_properties_rooms_id_fk[]" value="${room.quotation_properties_rooms_id_fk || 0}">

                            <input type="hidden" name="quotation_room_tariff_details_id[]" class="quotationRoomTariffDetailsIdInput" value="${room.quotation_room_tariff_details_id || ''}">

                        </td>

                        <td class="roomRate">

                            <span class="autoCalcRateText">${finalRate}</span>

                            <input type="hidden" name="total_room_cost[][]" class="autoCalcRateInput" value="${finalRate}">

                        </td>

                        <td class="text-center">

                            <button type="button"

                                class="btn btn-sm btn-warning me-1 editRoomBtn"

                                data-lead-id="${$('#leads_id_hidden').val() || $('#leads_id').val() || ''}"

                                data-property-day-id="${day.packages_properties_days_id_fk || ''}"

                                data-stay-destination-id="${day.quotation_properties_days_destination_id_fk || ''}"

                                data-property-id="${property.properties_id_fk || ''}"

                                data-room-category-id="${room.quotation_properties_rooms_id_fk || ''}">

                                <i class="bi bi-pencil"></i>

                            </button>

                            <button type="button" class="btn btn-sm btn-danger removeRoomBtn">

                                <i class="bi bi-trash"></i>

                            </button>

                        </td>

                    </tr>

                `;

            });



            propertyGroupsHTML += `

                <tbody class="property-group"

                       data-property-id="${property.properties_id_fk || ''}"

                       data-packages-property-id="${property.packages_properties_id_fk || 0}">

                    <tr class="property-group-header">

                        <td class="property-name-cell">${property.properties_name || ''}</td>

                        <td colspan="2"></td>

                        <td class="text-center">

                            <button type="button" class="btn btn-sm btn-danger removePropertyBtn">

                                <i class="bi bi-trash"></i>

                            </button>

                            <input type="hidden" name="packages_properties_id_fk[]" value="${property.packages_properties_id_fk || 0}">

                            <input type="hidden" name="properties_id_fk[]" value="${property.properties_id_fk || 0}">

                        </td>

                    </tr>

                    ${roomsHTML}

                    <tr class="add-room-row">

                        <td colspan="4" class="text-center">

                            <button type="button" class="btn btn-sm btn-success addRoomBtn">

                                <i class="bi bi-plus-circle"></i> Add Room

                            </button>

                        </td>

                    </tr>

                </tbody>

            `;

        });



        let hasProperties = propertyGroupsHTML !== '';



        html += `

            <tr class="itineraryDayRow"

                data-accommodation-date="${day.accommodation_date || ''}">

                <td>

                    <strong>${day.quotation_properties_days_day || ''}</strong>



                    ${

                        day.accommodation_date

                        ? `<div>${formatItineraryDayDate(day.accommodation_date)}</div>`

                        : ''

                    }

                    <input type="hidden" name="packages_itinerary_days_id_fk[]" value="${day.packages_itinerary_days_id_fk || 0}">

                    <input type="hidden" name="packages_properties_days_id_fk[]" value="${day.packages_properties_days_id_fk || 0}">

                    <input type="hidden" name="quotation_properties_days_day[]" value="${day.quotation_properties_days_day || ''}">

                    <input type="hidden" name="accommodation_plan_id_fk[]" value="${day.accommodation_plan_id_fk || 0}">

                </td>



                <td>

                    ${day.state_name || day.destination_name || ''}

                    <input type="hidden" name="quotation_properties_days_destination_id_fk[]" value="${day.quotation_properties_days_destination_id_fk || 0}">

                </td>



                <td>

                    <div class="propertiesContainer">

                        <table class="table table-sm table-bordered unified-property-table">

                            <thead class="table-light">

                                <tr>

                                    <th style="width:22%">Property</th>

                                    <th style="width:28%">Room Name</th>

                                    <th style="width:20%">Calculated Rate</th>

                                    <th style="width:30%" class="text-center">Action</th>

                                </tr>

                            </thead>

                            ${hasProperties ? propertyGroupsHTML : ''}

                            <tfoot>

                                <tr class="add-property-row">

                                    <td colspan="4" class="text-center">

                                        <button type="button" class="btn btn-sm btn-primary addPropertyBtn">

                                            <i class="bi bi-plus-square"></i> Add Property

                                        </button>

                                    </td>

                                </tr>

                            </tfoot>

                        </table>

                    </div>



                    <div class="propertySelector d-none mt-2 border rounded p-2 bg-light">

                        <div class="d-flex gap-2 align-items-start">

                            <div class="flex-grow-1">

                                <select class="form-select form-select-sm propertySelectDropdown">

                                    <option value="">Select Property</option>

                                </select>

                            </div>

                            <button type="button" class="btn btn-sm btn-danger removePropertySelectorBtn" title="Remove">

                                <i class="bi bi-trash"></i>

                            </button>

                        </div>

                    </div>

                </td>

            </tr>

        `;

    });



    html += `</tbody></table>

    <div class="option-total-box border rounded p-3 mt-4 bg-light">



    <div class="row g-3 align-items-end">



        <!-- Total Cost -->

        <div class="col-md-3">

        <label class="form-label fw-semibold" style="font-size: 13px;">Total Cost</label>

        <div class="quote-amount-highlight d-inline-block px-3 py-2 rounded">

            &#8377; <span class="optionTotalCostText">

            ${parseFloat(optionData.quotation_options_total_cost || 0).toFixed(2)}

            </span>

        </div>

        <input type="hidden"

                class="optionTotalCostInput"

                name="option_total_cost[]"

                value="${parseFloat(optionData.quotation_options_total_cost || 0).toFixed(2)}">

        </div>



        <!-- Amount Type -->

        <div class="col-md-3">

        <label class="form-label fw-semibold" style="font-size: 13px;">Amount Type</label>

        <div class="d-flex gap-3">



            <select class="form-select form-select-sm optionAmountType" style="width:50%;">

            <option value="net" ${optionData.quotation_options_amount_type === 'net' ? 'selected' : ''}>Net Amount</option>

            <option value="adult" ${optionData.quotation_options_amount_type === 'adult' ? 'selected' : ''}>Per Adult</option>

            <option value="person" ${optionData.quotation_options_amount_type === 'person' ? 'selected' : ''}>Per Person</option>

            <option value="couple" ${optionData.quotation_options_amount_type === 'couple' ? 'selected' : ''}>Per Couple</option>

            </select>



            <input type="number"

                class="form-control form-control-sm optionPerAmount ${optionData.quotation_options_amount_type !== 'net' ? '' : 'd-none'}"

                style="width:50%;"

                placeholder="Amount"

                value="${optionData.quotation_options_per_amount || ''}">



        </div>

        </div>



        <!-- Margin -->

        <div class="col-md-3">

        <label class="form-label fw-semibold" style="font-size: 13px;">Margin</label>

        <div class="d-flex gap-3">



            <select class="form-select form-select-sm optionMarginType" style="width:50%;">

            <option value="amount" ${optionData.quotation_options_margin_type === 'amount' ? 'selected' : ''}>Amount</option>

            <option value="percent" ${optionData.quotation_options_margin_type === 'percent' ? 'selected' : ''}>%</option>

            </select>



            <input type="number"

                class="form-control form-control-sm optionMarginValue"

                style="width:50%;"

                placeholder="Margin"

                value="${optionData.quotation_options_margin_value || 0}">



        </div>

        </div>



        <!-- Total Quote -->

        <div class="col-md-3">

        <label class="form-label fw-semibold" style="font-size: 13px;">Total Quote Rate</label>

        <div class="quote-amount-highlight d-inline-block px-3 py-2 rounded">

            &#8377; <span class="optionQuoteTotalText">

            ${parseFloat(optionData.quotation_options_total_quote_rate || 0).toFixed(2)}

            </span>

        </div>

        <input type="hidden"

                class="optionQuoteTotalInput"

                name="option_quote_total[]"

                value="${parseFloat(optionData.quotation_options_total_quote_rate || 0).toFixed(2)}">

        </div>



    </div>

    </div>`;



    container.html(html);

}



function refillSavedPropertyInclusions(rows)

{

    if (!rows || !rows.length) return;



    $('#quotation_property_inclusion_type').prop('checked', true);

    $('#inclusionBox').show();



    const $tbody = $('#inclusionTable tbody');

    $tbody.find('tr:gt(0)').remove();



    rows.forEach(function(row, idx) {



        if (idx > 0) {

            const tbody = document.querySelector('#inclusionTable tbody');

            tbody.insertAdjacentHTML('beforeend', createInclusionRow());

        }



        const $tr = $tbody.find('tr').eq(idx);



        const packageOptionId = String(row.package_option_id_fk || '');

        const dayKey = [

            row.packages_properties_days_id_fk || '',

            row.stay_destination_id_fk || '',

            row.accommodation_date || ''

        ].join('|');



        const propertyId  = String(row.inclusion_property_id_fk || row.properties_id_fk || row.property_id_fk || '');

        const inclusionId = String(row.property_inclusions_id_fk || row.inclusion_name_id_fk || '');



        // package option

        fillInclusionPackageOptionSelect($tr.find('.inclusionPackageOptionSelect')[0]);

        setSelectValueSafe($tr.find('.inclusionPackageOptionSelect'), packageOptionId, 'Selected Template Option');



        // Ã¢Å“â€¦ same as special requirement day dropdown

        fillDaySelect($tr.find('.inclusionDaySelect')[0]);

        setSelectValueSafe($tr.find('.inclusionDaySelect'), dayKey, buildSavedDayLabel(row));



        // load property based on selected day + package option

        // loadInclusionPropertiesForRow($tr, function () {



        //     setSelectValueSafe(

        //         $tr.find('.inclusionPropertySelect'),

        //         propertyId,

        //         row.property_name || row.properties_name || 'Selected Property'

        //     );



        //     loadInclusionNamesForRow($tr, function () {



        //         setSelectValueSafe(

        //             $tr.find('.inclusionNameSelect'),

        //             inclusionId,

        //             row.inclusion_name || row.property_inclusions_name || 'Selected Inclusion'

        //         );



        //         $tr.find('.inclusionAmountInput').val(row.inclusion_amount || '');

        //         recalcInclusionTotal();

        //     });

        // });

        // 1. set package option

$tr.find('.inclusionPackageOptionSelect')

   .val(row.package_option_id_fk || '')

   .trigger('change.select2');



// 2. load days

loadInclusionDaysForRow($tr, row.package_option_id_fk, dayKey, function () {



    // 3. select saved day

    $tr.find('.inclusionDaySelect')

       .val(dayKey)

       .trigger('change.select2');



    // 4. load properties

    // loadInclusionPropertiesForRow($tr, function () {



    //     var propSel = $tr.find('.inclusionPropertySelect')[0];



    //     $(propSel)

    //         .val(row.inclusion_property_id_fk || '')

    //         .trigger('change.select2');



    //     enableSelect2(propSel, 'Select Property');



    //     // 5. load inclusions

    //     loadInclusionNamesForRow($tr, function () {



    //         var incSel = $tr.find('.inclusionNameSelect')[0];



    //         $(incSel)

    //             .val(row.property_inclusions_id_fk || '')

    //             .trigger('change.select2');



    //         enableSelect2(incSel, 'Select Inclusion');



    //         $tr.find('.inclusionAmountInput').val(row.inclusion_amount || '');



    //         recalcInclusionTotal();

    //     });

    // });

    loadInclusionPropertiesForRow($tr, function () {



    var propSel = $tr.find('.inclusionPropertySelect')[0];



    var savedPropertyId = String(row.inclusion_property_id_fk || row.properties_id_fk || row.property_id_fk || '');



    setSelectValueSafe(

        $(propSel),

        savedPropertyId,

        row.property_name || row.properties_name || 'Selected Property'

    );



    // loadInclusionNamesForRow($tr, function () {



    //     var incSel = $tr.find('.inclusionNameSelect')[0];



    //     var savedInclusionId = String(row.property_inclusions_id_fk || row.inclusion_name_id_fk || '');



    //     setSelectValueSafe(

    //         $(incSel),

    //         savedInclusionId,

    //         row.inclusion_name || row.property_inclusions_name || 'Selected Inclusion'

    //     );



    //     enableSelect2(incSel, 'Select Inclusion');



    //     $tr.find('.inclusionAmountInput').val(row.inclusion_amount || '');



    //     recalcInclusionTotal();

    // });



    loadInclusionNamesForRow($tr, function () {



        var incSel = $tr.find('.inclusionNameSelect')[0];



        var savedInclusionId = String(

            row.property_inclusions_id_fk ||

            row.inclusion_name_id_fk ||

            ''

        );



        // Ã¢Å“â€¦ if saved inclusion exists but not in loaded dropdown, add it

        if (savedInclusionId && $(incSel).find('option[value="' + savedInclusionId + '"]').length === 0) {

            $(incSel).append(

                '<option value="' + savedInclusionId + '">' +

                (row.inclusion_name || row.property_inclusions_name || 'Selected Inclusion') +

                '</option>'

            );

        }



        // Ã¢Å“â€¦ select from all loaded inclusions

        $(incSel)

            .val(savedInclusionId)

            .prop('disabled', false)

            .trigger('change.select2');



        $tr.find('.inclusionAmountInput').val(row.inclusion_amount || '');



        recalcInclusionTotal();

    });

});

});

    });



    // enable remove button on first row after refilling saved data

    $tbody.find('tr:first .removeInclusionBtn').prop('disabled', false);

}



function buildSavedDayLabel(row) {

    return 'Day ' + (row.quotation_properties_days_day || row.packages_properties_days_day || '') +

           ' | ' + formatDateDMY(row.accommodation_date || '') +

           ' | ' + (row.state_name || row.destination_name || '');

}



function setSelectValueSafe($select, value, text) {

    value = String(value || '');



    if (!$select.length || !value) return;



    if ($select.find('option[value="' + value + '"]').length === 0) {

        $select.append('<option value="' + value + '">' + (text || value) + '</option>');

    }



    $select.val(value).trigger('change.select2');

}



function buildSavedDayLabelByKey(dayId, destinationId, accDate)

{

    var label = 'Saved Day';



    $('.optionBlock .itineraryDayRow').each(function () {

        var rowDayId = $(this).find('input[name="packages_properties_days_id_fk[]"]').val() || '';

        var rowDestId = $(this).find('input[name="quotation_properties_days_destination_id_fk[]"]').val() || '';

        var rowDate = $(this).attr('data-accommodation-date') || '';



        if (String(rowDayId) === String(dayId)) {

            var dayText = $(this).find('td:eq(0) strong').text().trim();

            var destinationText = $(this).find('td:eq(1)').clone().children().remove().end().text().trim();



            var dateText = rowDate ? formatItineraryDayDate(rowDate) : (accDate ? formatItineraryDayDate(accDate) : '');



            label = dayText;



            if (dateText) {

                label += ' | ' + dateText;

            }



            if (destinationText) {

                label += ' | ' + destinationText;

            }



            return false;

        }

    });



    return label;

}



function loadInclusionDaysForRow($tr, packageOptionId, savedDayKey, callback)

{

    var daySel = $tr.find('.inclusionDaySelect')[0];

    var html = '<option value="">Select Day | Date | Destination</option>';



    $('.optionBlock').each(function () {

        var selectedOptionId = $(this).find('.propertyDropdown').val() || '';



        if (String(selectedOptionId) === String(packageOptionId)) {



            $(this).find('.itineraryDayRow').each(function () {



                var dayText = $(this).find('td:eq(0) strong').text().trim();

                var destinationText = $(this).find('td:eq(1)').clone().children().remove().end().text().trim();



                var packagesPropertiesDaysId =

                    $(this).find('input[name="packages_properties_days_id_fk[]"]').val() || '';



                var destinationId =

                    $(this).find('input[name="quotation_properties_days_destination_id_fk[]"]').val() || '';



                var accommodationDate =

                    $(this).attr('data-accommodation-date') || '';



                if (packagesPropertiesDaysId) {

                    var dayKey = packagesPropertiesDaysId + '|' + destinationId + '|' + accommodationDate;

                    // html += '<option value="' + dayKey + '">' + dayText + ' | ' + destinationText + '</option>';



                    var dateText = accommodationDate ? formatItineraryDayDate(accommodationDate) : '';



                    var label = dayText;

                    if (dateText) label += ' | ' + dateText;

                    if (destinationText) label += ' | ' + destinationText;



                    html += '<option value="' + dayKey + '">' + label + '</option>';

                }

            });

        }

    });



    $(daySel).html(html);

    initSelect2(daySel, 'Select Day | Date | Destination');



    // if (savedDayKey && $(daySel).find('option[value="' + savedDayKey + '"]').length === 0) {

    //     $(daySel).append('<option value="' + savedDayKey + '">Saved Day</option>');

    // }



    if (savedDayKey && $(daySel).find('option[value="' + savedDayKey + '"]').length === 0) {



        var savedParts = savedDayKey.split('|');



        var savedDayId = savedParts[0] || '';

        var savedDestinationId = savedParts[1] || '';

        var savedDate = savedParts[2] || '';



        var savedLabel = buildSavedDayLabelByKey(savedDayId, savedDestinationId, savedDate);



        $(daySel).append(

            '<option value="' + savedDayKey + '">' + savedLabel + '</option>'

        );

    }



    if (typeof callback === 'function') callback();

}

function loadInclusionPropertiesForRow($tr, callback)

{

    var dayKey = $tr.find('.inclusionDaySelect').val() || '';

    var leadId = $('#leads_id_hidden').val() || $('#leads_id').val() || '';

    var packageId = $('#packages_id_hidden').val() || $('#packages_id_fk').val() || '';

    var packageOptionId = $tr.find('.inclusionPackageOptionSelect').val() || '';



    var propSel = $tr.find('.inclusionPropertySelect')[0];

    var incSel  = $tr.find('.inclusionNameSelect')[0];



    // disable while loading

    setSelect2Loading(propSel, 'Loading Property...');

    setSelect2Empty(incSel, 'Select Inclusion');



    if (!dayKey || !leadId || !packageId || !packageOptionId) {

        setSelect2Empty(propSel, 'Select Property');



        if (typeof callback === 'function') callback();

        return;

    }



    fetch(

        `<?php echo base_url(); ?>index.php/Quotation/ajax_get_daywise_properties_for_inclusion?lead_id=${encodeURIComponent(leadId)}&package_id=${encodeURIComponent(packageId)}&day_key=${encodeURIComponent(dayKey)}&packages_properties_common_id_fk=${encodeURIComponent(packageOptionId)}`

    )

    .then(function (r) { return r.json(); })

    .then(function (res) {

        var html = '<option value="">Select Property</option>';



        if (res && res.status && Array.isArray(res.data) && res.data.length > 0) {

            res.data.forEach(function (p) {

                html += '<option value="' + p.property_id + '">' + p.property_name + '</option>';

            });



            // enable after data loaded

            setSelect2Ready(propSel, html, 'Select Property');

        } else {

            setSelect2Empty(propSel, 'No Property Found');

        }



        if (typeof callback === 'function') callback();



        refreshQuotationModalScroll(true);

    })

    .catch(function (err) {

        console.error(err);



        setSelect2Empty(propSel, 'Failed to load Property');



        if (typeof callback === 'function') callback();



        refreshQuotationModalScroll(true);

    });

}



// function loadInclusionNamesForRow($tr, callback)

// {

//     var propertyId = $tr.find('.inclusionPropertySelect').val() || '';

//     var incSel = $tr.find('.inclusionNameSelect')[0];



//     clearInclusionSelect(incSel);



//     if (!propertyId) {

//         if (typeof callback === 'function') callback();

//         return;

//     }



//     fetch(

//         `<?php echo base_url(); ?>index.php/Quotation/ajax_get_property_inclusions?property_id=${encodeURIComponent(propertyId)}`

//     )

//     .then(function (r) { return r.json(); })

//     .then(function (res) {

//         var html = '<option value="">Select Inclusion</option>';



//         if (res && res.status && Array.isArray(res.data)) {

//             res.data.forEach(function (p) {

//                 html += '<option value="' + p.property_inclusions_id + '" data-amount="' + (p.property_inclusions_amount || 0) + '">' +

//                     p.property_inclusions_name +

//                 '</option>';

//             });

//         }



//         $(incSel).html(html);

//         initSelect2(incSel, 'Select Inclusion');



//         if (typeof callback === 'function') callback();

//     })

//     .catch(function (err) {

//         console.error(err);

//         if (typeof callback === 'function') callback();

//     });

// }



function loadInclusionNamesForRow($tr, callback)

{

    var propertyId = $tr.find('.inclusionPropertySelect').val() || '';

    var incSel = $tr.find('.inclusionNameSelect')[0];



    // Ã°Å¸â€â€™ disable + show loading

    setSelect2Loading(incSel, 'Loading Inclusion...');



    if (!propertyId) {

        setSelect2Empty(incSel, 'Select Inclusion');



        if (typeof callback === 'function') callback();

        return;

    }



    fetch(

        `<?php echo base_url(); ?>index.php/Quotation/ajax_get_property_inclusions_by_property?property_id=${encodeURIComponent(propertyId)}`

    )

    .then(function (r) { return r.json(); })

    .then(function (res) {



        var html = '<option value="">Select Inclusion</option>';



        if (res && res.status && Array.isArray(res.data) && res.data.length > 0) {



            res.data.forEach(function (p) {

                html += '<option value="' + p.property_inclusions_id + '" data-amount="' + (p.property_inclusions_amount || 0) + '">' +

                            p.property_inclusions_name +

                        '</option>';

            });



            // Ã¢Å“â€¦ enable after load

            setSelect2Ready(incSel, html, 'Select Inclusion');



        } else {

            setSelect2Empty(incSel, 'No Inclusion Found');

        }



        if (typeof callback === 'function') callback();



        refreshQuotationModalScroll(true);

    })

    .catch(function (err) {

        console.error(err);



        setSelect2Empty(incSel, 'Failed to load Inclusion');



        if (typeof callback === 'function') callback();



        refreshQuotationModalScroll(true);

    });

}



function refillSavedSpecialRequirements(rows)

{

    if (!rows || !rows.length) return;



    $('#quotation_special_requirement_type').prop('checked', true).trigger('change');



    const $tbody = $('#specialReqTable tbody');

    $tbody.find('tr:gt(0)').remove();



    rows.forEach(function(row, idx) {



        if (idx > 0) {

            $('#addSpecialReqBtn').trigger('click');

        }



        const $tr = $tbody.find('tr').eq(idx);



        const dayKey = [

            row.packages_properties_days_id_fk || '',

            row.stay_destination_id_fk || '',

            row.accommodation_date || ''

        ].join('|');



        $tr.find('.specialReqDaySelect').val(dayKey).trigger('change');

        $tr.find('.specialReqName').val(row.quotation_special_requirements_name || '');

        $tr.find('.specialReqCost').val(row.quotation_special_requirements_cost || '');

    });



    // enable remove button on first row after refilling saved data

    $tbody.find('tr:first .removeSpecialReqBtn').prop('disabled', false);



    recalcSpecialReqTotal();

}



/* ================= AUTO-CALCULATE ALL PROPERTIES IN AN OPTION ================= */



// Inject CSS to hide the room tariff modal during batch auto-calculation

(function () {

    if (document.getElementById('auto-calc-modal-style')) return;

    var style = document.createElement('style');

    style.id = 'auto-calc-modal-style';

    style.textContent =

        '#roompricingandguestallocationModal.modal-auto-calc-hidden{' +

        'opacity:0!important;' +

        'pointer-events:none!important}' +

        '#roompricingandguestallocationModal.modal-auto-calc-hidden .modal-dialog{' +

        'transform:translateY(-100vh)!important}';

    document.head.appendChild(style);

})();



$(document).on('change', '.auto-calc-all-properties', function () {

    const $checkbox = $(this);

    const $optionBlock = $checkbox.closest('.optionBlock');

    const $status = $optionBlock.find('.auto-calc-status');



    if (!$checkbox.is(':checked')) {

        $status.hide().text('');

        return;

    }



    // Collect all edit buttons in this option

    const $buttons = $optionBlock.find('.editRoomBtn');



    if (!$buttons.length) {

        alert('No properties with rooms to calculate tariff for.');

        $checkbox.prop('checked', false);

        return;

    }



    if (!confirm('This will calculate and save room tariffs for ' + $buttons.length + ' room(s). Continue?')) {

        $checkbox.prop('checked', false);

        return;

    }



    window.__autoCalcQueue = Array.from($buttons);

    window.__autoCalcOptionBlock = $optionBlock[0];

    window.__autoCalcTotal = $buttons.length;

    window.__autoCalcCurrent = 0;

    window.__autoCalcActive = true;



    $status.show().text('Calculating 0 / ' + window.__autoCalcTotal + ' ...');

    $checkbox.prop('disabled', true);



    processNextAutoCalcRoom();

});



function updateAutoCalcStatus(message, isError) {

    const $status = $(window.__autoCalcOptionBlock).find('.auto-calc-status');

    if (!$status.length) return;

    $status.show().text(message);

    if (isError) {

        $status.removeClass('text-muted text-success').addClass('text-danger');

    } else if (message && message.indexOf('Completed') !== -1) {

        $status.removeClass('text-muted text-danger').addClass('text-success');

    } else {

        $status.removeClass('text-danger text-success').addClass('text-muted');

    }

}



function processNextAutoCalcRoom() {

    if (!window.__autoCalcActive || !window.__autoCalcQueue || window.__autoCalcQueue.length === 0) {

        finishAutoCalc();

        return;

    }



    const btn = window.__autoCalcQueue.shift();

    window.__autoCalcCurrent++;

    window.__lastRoomEditBtn = btn;



    updateAutoCalcStatus('Calculating ' + window.__autoCalcCurrent + ' / ' + window.__autoCalcTotal + ' ...');



    // Keep the modal hidden while processing automatically

    $('#roompricingandguestallocationModal').addClass('modal-auto-calc-hidden');



    // Trigger the edit button click (loads the modal and data)

    btn.click();

}



function finishAutoCalc() {

    const optionBlock = window.__autoCalcOptionBlock;

    const total = window.__autoCalcTotal || 0;



    $('#roompricingandguestallocationModal').removeClass('modal-auto-calc-hidden');



    if (optionBlock) {

        const $cb = $(optionBlock).find('.auto-calc-all-properties');

        $cb.prop('disabled', false).prop('checked', false);

    }



    updateAutoCalcStatus('Completed ' + total + ' room(s).', false);



    if (optionBlock) {

        setTimeout(function () {

            $(optionBlock).find('.auto-calc-status').fadeOut();

        }, 4000);

    }



    window.__autoCalcQueue = [];

    window.__autoCalcOptionBlock = null;

    window.__autoCalcActive = false;

    window.__autoCalcTotal = 0;

    window.__autoCalcCurrent = 0;

}



function cancelAutoCalc(message) {

    const optionBlock = window.__autoCalcOptionBlock;



    $('#roompricingandguestallocationModal').removeClass('modal-auto-calc-hidden');



    if (optionBlock) {

        const $cb = $(optionBlock).find('.auto-calc-all-properties');

        $cb.prop('disabled', false).prop('checked', false);

    }



    updateAutoCalcStatus(message || 'Auto calculation stopped.', true);



    window.__autoCalcQueue = [];

    window.__autoCalcOptionBlock = null;

    window.__autoCalcActive = false;

}



function maybeAutoSaveRoomTariff() {

    if (!window.__autoCalcActive) return;



    // Use a short delay so the DOM is fully updated

    setTimeout(function () {

        if (!window.__autoCalcActive) return;



        const saveBtn = document.getElementById('btnSave1');

        if (saveBtn) {

            saveBtn.click();

        } else {

            cancelAutoCalc('Save button not found. Auto calculation stopped.');

        }

    }, 150);

}



// Cancel auto-calculation if user manually closes the room tariff modal

$(document).on('click', '#roompricingandguestallocationModal .btn-close', function () {

    if (window.__autoCalcActive) {

        cancelAutoCalc('Modal closed manually. Auto calculation stopped.');

    }

});



// Hide the dark backdrop while the modal is being processed automatically

$('#roompricingandguestallocationModal').on('shown.bs.modal', function () {

    if (window.__autoCalcActive) {

        $('.modal-backdrop').last().css('display', 'none');

    }

});


