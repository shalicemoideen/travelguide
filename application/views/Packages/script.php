
<script type="text/javascript">
////***Latest dropdown select2*****///

function initCommonSelect2(scope) {

    scope = scope || document;

    $(scope).find('.lst-flt-select2').each(function () {

        let $select = $(this);

        // avoid re-initializing
        if ($select.hasClass('select2-hidden-accessible')) {
            return;
        }

        // find nearest opened modal if this select is inside modal
        let $modal = $select.closest('.modal');
        let $modalContent = $modal.find('.modal-content');

        let options = {
            width: '100%',
            minimumResultsForSearch: 0
        };

        // only set dropdownParent when inside modal (prefer .modal-content to stay within focus trap)
        if ($modalContent.length) {
            options.dropdownParent = $modalContent;
        } else if ($modal.length) {
            options.dropdownParent = $modal;
        }

        $select.select2(options);
    });
}

// auto focus search input for all select2
$(document).on('select2:open', function (e) {
    setTimeout(function () {
        var containerId = e.target ? ($(e.target).data('select2') || {})._resultId : null;
        var searchField = document.querySelector('.select2-container--open .select2-search__field');
        if (searchField) {
            searchField.focus();
        }
    }, 100);
});

// initialize page select2
$(document).ready(function () {
    initCommonSelect2(document);
});

// call this after opening any modal
$('#PackagesModal').on('shown.bs.modal', function () {
    initCommonSelect2(this);
    initDragPackageSelect2();
    resetDragPackageDropdowns();

    // Show drag-from section only for add/duplicate, hide for edit
    if (window.save_method === 'update') {
        $('#drag_package_category').closest('.row.g-3').hide();
    } else {
        $('#drag_package_category').closest('.row.g-3').show();
    }

    if (!$('#packages_category_id_fk').hasClass('select2-hidden-accessible')) {
        $('#packages_category_id_fk').select2({
            width: '100%',
            placeholder: 'Please Select Template Category',
            allowClear: true,
            dropdownParent: $('#PackagesModal .modal-content'),
            ajax: {
                url: '<?php echo base_url(); ?>index.php/Packages/ajax_filter_package_categories',
                dataType: 'json',
                delay: 250,
                data: function(params) { return { q: params.term }; },
                processResults: function(data) { return data; },
                cache: true
            }
        });
    }

    if (!$('#packages_itinerary_category_id_fk').hasClass('select2-hidden-accessible')) {
        $('#packages_itinerary_category_id_fk').select2({
            width: '100%',
            placeholder: 'Please Select Itinerary Category',
            allowClear: true,
            dropdownParent: $('#PackagesModal .modal-content'),
            ajax: {
                url: '<?php echo base_url(); ?>index.php/Packages/ajax_filter_itinerary_categories',
                dataType: 'json',
                delay: 250,
                data: function(params) { return { q: params.term }; },
                processResults: function(data) { return data; },
                cache: true
            }
        });
    }

    if (!$('#packages_inclusion_exclusion_common_id_fk').hasClass('select2-hidden-accessible')) {
        $('#packages_inclusion_exclusion_common_id_fk').select2({
            width: '100%',
            placeholder: 'Please Search by title',
            allowClear: true,
            dropdownParent: $('#PackagesModal .modal-content'),
            ajax: {
                url: '<?php echo base_url(); ?>index.php/Packages/ajax_filter_inclusion_exclusion',
                dataType: 'json',
                delay: 250,
                data: function(params) { return { q: params.term }; },
                processResults: function(data) { return data; },
                cache: true
            }
        });
    }

    if (!$('#payment_policies_id_fk').hasClass('select2-hidden-accessible')) {
        $('#payment_policies_id_fk').select2({
            width: '100%',
            placeholder: 'Please Search by title',
            allowClear: true,
            dropdownParent: $('#PackagesModal .modal-content'),
            ajax: {
                url: '<?php echo base_url(); ?>index.php/Packages/ajax_filter_payment_policies',
                dataType: 'json',
                delay: 250,
                data: function(params) { return { q: params.term }; },
                processResults: function(data) { return data; },
                cache: true
            }
        });
    }

    if (!$('#terms_condition_id_fk').hasClass('select2-hidden-accessible')) {
        $('#terms_condition_id_fk').select2({
            width: '100%',
            placeholder: 'Please Search by title',
            allowClear: true,
            dropdownParent: $('#PackagesModal .modal-content'),
            ajax: {
                url: '<?php echo base_url(); ?>index.php/Packages/ajax_filter_terms_conditions',
                dataType: 'json',
                delay: 250,
                data: function(params) { return { q: params.term }; },
                processResults: function(data) { return data; },
                cache: true
            }
        });
    }

    if (!$('#cancellation_policies_id_fk').hasClass('select2-hidden-accessible')) {
        $('#cancellation_policies_id_fk').select2({
            width: '100%',
            placeholder: 'Please Search by title',
            allowClear: true,
            dropdownParent: $('#PackagesModal .modal-content'),
            ajax: {
                url: '<?php echo base_url(); ?>index.php/Packages/ajax_filter_cancellation_policies',
                dataType: 'json',
                delay: 250,
                data: function(params) { return { q: params.term }; },
                processResults: function(data) { return data; },
                cache: true
            }
        });
    }
});

// Initialize drag-from-package select2 dropdowns
function initDragPackageSelect2() {
    if (!$('#drag_package_category').hasClass('select2-hidden-accessible')) {
        $('#drag_package_category').select2({
            dropdownParent: $('#PackagesModal .modal-content'),
            width: '100%',
            placeholder: 'All Categories',
            allowClear: true,
            ajax: {
                url: '<?php echo base_url(); ?>index.php/Packages/ajax_filter_package_categories',
                dataType: 'json',
                delay: 250,
                data: function(params) { return { q: params.term }; },
                processResults: function(data) { return data; },
                cache: true
            }
        });
    }

    if (!$('#drag_package_select').hasClass('select2-hidden-accessible')) {
        $('#drag_package_select').select2({
            dropdownParent: $('#PackagesModal .modal-content'),
            width: '100%',
            placeholder: 'Select Template to load days',
            allowClear: true,
            ajax: {
                url: '<?php echo base_url(); ?>index.php/Packages/get_package_dropdown_by_duration',
                dataType: 'json',
                delay: 250,
                data: function(params) {
                    var dur = $('#packages_duration_in_nights').val() || '';
                    if (!dur) {
                        return { q: params.term, duration: '__none__' };
                    }
                    return {
                        q: params.term,
                        duration: dur,
                        category_id: $('#drag_package_category').val() || '',
                        exclude_id: $('#packages_id').val() || ''
                    };
                },
                processResults: function(data) { return data; },
                cache: false
            }
        });
    }

    $('#drag_package_category').off('change.dragPkg').on('change.dragPkg', function() {
        $('#drag_package_select').val(null).trigger('change');
    });
}

function resetDragPackageDropdowns() {
    if ($('#drag_package_category').hasClass('select2-hidden-accessible')) {
        $('#drag_package_category').val(null).trigger('change');
    }
    if ($('#drag_package_select').hasClass('select2-hidden-accessible')) {
        $('#drag_package_select').val(null).trigger('change');
    }
}

// Load package days from selected drag-from package
function loadDragPackageDays() {
    var packageId = $('#drag_package_select').val();
    if (!packageId) {
        alert('Please select a template first.');
        return;
    }

    var currentEditId = $('#packages_id').val();
    if (currentEditId && String(currentEditId) === String(packageId)) {
        alert('Cannot drag from the same template you are currently editing.');
        return;
    }

    $.ajax({
        url: "<?php echo base_url(); ?>index.php/Packages/ajax_edit/" + packageId,
        type: "GET",
        dataType: "json",
        success: function(res) {
            if (!res || !res.status) {
                alert(res.message || 'Failed to load template');
                return;
            }

            var p = res.package || {};

            // Auto-select package category, itinerary category and itinerary from dragged package
            if (p.packages_category_id_fk) {
                select2AjaxSetSelected('#packages_category_id_fk', p.packages_category_id_fk, p.package_category_name);
            }
            if (p.packages_itinerary_category_id_fk) {
                select2AjaxSetSelected('#packages_itinerary_category_id_fk', p.packages_itinerary_category_id_fk, p.itinerary_category_name);
            }

            // Load cover page images if they exist
            if (p.packages_first_cover_page) {
                $('#packages_first_cover_page_txt').val(p.packages_first_cover_page);
                $('#first_cover_preview').html(
                    '<img src="<?php echo base_url("uploads/packages_cover/"); ?>' +
                    p.packages_first_cover_page +
                    '" style="width:120px;border:1px solid #ddd;padding:3px;">'
                );
            }

            if (p.packages_last_cover_page) {
                $('#packages_last_cover_page_txt').val(p.packages_last_cover_page);
                $('#last_cover_preview').html(
                    '<img src="<?php echo base_url("uploads/packages_cover/"); ?>' +
                    p.packages_last_cover_page +
                    '" style="width:120px;border:1px solid #ddd;padding:3px;">'
                );
            }

            // Load itinerary dropdown and select the dragged package's itinerary, then render days
            var itinId = p.packages_itinerary_id_fk || '';
            loadItinerariesByCategoryDuration(function(ok) {
                if (ok && itinId) {
                    $('#packages_itinerary_id_fk').val(String(itinId));
                    if ($('#packages_itinerary_id_fk').hasClass('select2-hidden-accessible')) {
                        $('#packages_itinerary_id_fk').trigger('change.select2');
                    }
                }

                // Render itinerary days
                if (res.itinerary_days && res.itinerary_days.length) {
                    buildItineraryRowsFromSaved(res.itinerary_days);
                    if (typeof initEditorsForDays === 'function') initEditorsForDays();
                } else {
                    $('#itinerary').empty();
                }

                // Resolve destination names and build properties
                if (typeof loadDestinationMap === 'function') {
                    loadDestinationMap(function(map) {
                        resolveDestinationNamesFromMap(map);

                        if (p.packages_property_checked_type === 'Y') {
                            window.isPropertyEditBuild = true;
                            $('#packages_property_type').prop('checked', true);
                            buildSavedPropertyUI(res.property_data || []);
                            window.isPropertyEditBuild = false;
                        }
                    });
                }
            }, itinId);

            // inclusion/exclusion
            if (p.packages_inclusion_exclusion_checked_type === 'Y') {
                $('#packages_inclusion_exclusion_checked_type').prop('checked', true).trigger('change');
                select2AjaxSetSelected('#packages_inclusion_exclusion_common_id_fk', p.packages_inclusion_exclusion_common_id_fk, p.inclusion_exclusion_common_title);

                setTimeout(function () {
                    $('#inclusion').empty();
                    $('#exclusion').empty();

                    (res.inclusions || []).forEach(function (row) {
                        $('#inclusion').append(
                            '<div class="d-flex gap-2 mb-2 inclusion-row align-items-start">' +
                            '<textarea class="form-control" name="packages_inclusions_details[]" rows="3">' + (row.packages_inclusions_details || '') + '</textarea>' +
                            '<button type="button" class="btn btn-sm btn-danger remove-row"><b>X</b></button>' +
                            '</div>'
                        );
                    });

                    (res.exclusions || []).forEach(function (row) {
                        $('#exclusion').append(
                            '<div class="d-flex gap-2 mb-2 exclusion-row align-items-start">' +
                            '<textarea class="form-control" name="packages_exclusions_details[]" rows="3">' + (row.packages_exclusions_details || '') + '</textarea>' +
                            '<button type="button" class="btn btn-sm btn-danger remove-row"><b>X</b></button>' +
                            '</div>'
                        );
                    });
                }, 300);
            }

            // optional add-ons
            if (p.packages_optional_add_on_checked_type === 'Y') {
                $('#packages_optional_add_on_checked_type').prop('checked', true).trigger('change');

                var $box = $('#optional-addon');
                $box.find('.optional-addon-row').remove();

                (res.optional_addons || []).forEach(function (r) {
                    $box.find('.mb-3.col-md-6').first().before(
                        '<div class="d-flex gap-2 mb-2 optional-addon-row align-items-start">' +
                        '<textarea name="packages_optional_add_on_details[]" class="form-control" rows="3">' + (r.packages_optional_add_on_details || '') + '</textarea>' +
                        '<button type="button" class="btn btn-sm btn-danger remove-optional-addon"><b>X</b></button>' +
                        '</div>'
                    );
                });
            }

            // payment policies
            if (p.packages_payment_policies_checked_type === 'Y') {
                window._loadingPackage = true;
                $('#packages_payment_policies_checked_type').prop('checked', true).trigger('change');
                select2AjaxSetSelected('#payment_policies_id_fk', p.payment_policies_id_fk, p.payment_policies_name);

                setTimeout(function () {
                    window._loadingPackage = false;
                    $('#payment-policies').find('.payment-row').remove();

                    (res.payment_policies || []).forEach(function (r) {
                        $('#payment-policies').find('.payment_add').first().before(
                            '<div class="d-flex gap-2 mb-2 payment-row align-items-start">' +
                            '<textarea class="form-control" name="packages_payment_policies_details[]" rows="3">' + (r.packages_payment_policies_details || '') + '</textarea>' +
                            '<button type="button" class="btn btn-sm btn-danger remove-payment"><b>X</b></button>' +
                            '</div>'
                        );
                    });
                }, 300);
            }

            // terms & conditions
            if (p.packages_terms_conditions_checked_type === 'Y') {
                window._loadingPackage = true;
                $('#packages_terms_conditions_checked_type').prop('checked', true).trigger('change');
                select2AjaxSetSelected('#terms_condition_id_fk', p.terms_condition_id_fk, p.terms_condition_name);

                setTimeout(function () {
                    window._loadingPackage = false;
                    $('#terms-conditions').find('.terms-row').remove();

                    (res.terms || []).forEach(function (r) {
                        $('#terms-conditions').find('.terms_add').first().before(
                            '<div class="d-flex gap-2 mb-2 terms-row align-items-start">' +
                            '<textarea class="form-control" name="packages_terms_condition_details[]" rows="3">' + (r.packages_terms_condition_details || '') + '</textarea>' +
                            '<button type="button" class="btn btn-sm btn-danger remove-terms"><b>X</b></button>' +
                            '</div>'
                        );
                    });
                }, 300);
            }

            // cancellation policy
            if (p.packages_cancellation_policy_checked_type === 'Y') {
                window._loadingPackage = true;
                $('#packages_cancellation_policy_checked_type').prop('checked', true).trigger('change');
                select2AjaxSetSelected('#cancellation_policies_id_fk', p.cancellation_policies_id_fk, p.cancellation_policies_name);

                setTimeout(function () {
                    window._loadingPackage = false;
                    $('#cancellation-policy').find('.cancellation-row').remove();

                    (res.cancellation || []).forEach(function (r) {
                        $('#cancellation-policy').find('.terms_add').first().before(
                            '<div class="d-flex gap-2 mb-2 cancellation-row align-items-start">' +
                            '<textarea class="form-control" name="packages_cancellation_policies_details[]" rows="3">' + (r.packages_cancellation_policies_details || '') + '</textarea>' +
                            '<button type="button" class="btn btn-sm btn-danger remove-cancellation"><b>X</b></button>' +
                            '</div>'
                        );
                    });
                }, 300);
            }

            // notes
            if (p.packages_notes_checked_type === 'Y') {
                $('#packages_notes_checked_type').prop('checked', true).trigger('change');
                $('#add_notes').find('.note-row').remove();

                (res.notes || []).forEach(function (r) {
                    $('#add_notes').find('.mb-3.col-md-6').first().before(
                        '<div class="d-flex gap-2 mb-2 note-row align-items-start">' +
                        '<textarea class="form-control" name="packages_notes_details[]" rows="3">' + (r.packages_notes_details || '') + '</textarea>' +
                        '<button type="button" class="btn btn-sm btn-danger remove-note"><b>X</b></button>' +
                        '</div>'
                    );
                });
            }
        },
        error: function() {
            alert('Error loading template details.');
        }
    });
}

function select2AjaxSetSelected(selector, id, text) {
    var $s = $(selector);
    if (!id || !text) { $s.val(null).trigger('change'); return; }
    if ($s.find('option[value="' + id + '"]').length === 0) {
        $s.append(new Option(text, id, true, true));
    } else {
        $s.val(id);
    }
    $s.trigger('change');
}

////***Latest dropdown select2*****///

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

////***Filter dropdowns AJAX Select2 init*****///

$(document).ready(function () {

    $('#packages_title_filter').select2({
        width: '100%',
        placeholder: 'Please Select Template',
        allowClear: true,
        ajax: {
            url: '<?php echo base_url(); ?>index.php/Packages/ajax_filter_package_titles',
            dataType: 'json',
            delay: 250,
            data: function(params) { return { q: params.term }; },
            processResults: function(data) { return data; },
            cache: true
        }
    });

    $('#packages_category_id_filter').select2({
        width: '100%',
        placeholder: 'Please Select Template Category',
        allowClear: true,
        ajax: {
            url: '<?php echo base_url(); ?>index.php/Packages/ajax_filter_package_categories',
            dataType: 'json',
            delay: 250,
            data: function(params) { return { q: params.term }; },
            processResults: function(data) { return data; },
            cache: true
        }
    });

    $('#packages_itinerary_category_id_filter').select2({
        width: '100%',
        placeholder: 'Please Select Itinerary Category',
        allowClear: true,
        ajax: {
            url: '<?php echo base_url(); ?>index.php/Packages/ajax_filter_itinerary_categories',
            dataType: 'json',
            delay: 250,
            data: function(params) { return { q: params.term }; },
            processResults: function(data) { return data; },
            cache: true
        }
    });

    $('#packages_itinerary_id_filter').select2({
        width: '100%',
        placeholder: 'Please Select Itinerary',
        allowClear: true,
        ajax: {
            url: '<?php echo base_url(); ?>index.php/Packages/ajax_filter_itineraries',
            dataType: 'json',
            delay: 250,
            data: function(params) { return { q: params.term }; },
            processResults: function(data) { return data; },
            cache: true
        }
    });

    $('#packages_createdby_user_id').select2({
        width: '100%',
        placeholder: 'Please Select Created By',
        allowClear: true,
        ajax: {
            url: '<?php echo base_url(); ?>index.php/Packages/ajax_filter_users',
            dataType: 'json',
            delay: 250,
            data: function(params) { return { q: params.term }; },
            processResults: function(data) { return data; },
            cache: true
        }
    });

    $('#btnFilterRefresh').on('click', function () {
        $('#packages_title_filter').val(null).trigger('change');
        $('#packages_category_id_filter').val(null).trigger('change');
        $('#packages_itinerary_category_id_filter').val(null).trigger('change');
        $('#packages_itinerary_id_filter').val(null).trigger('change');
        $('#packages_duration_in_nights_filter').val('');
        $('#packages_createdby_user_id').val(null).trigger('change');
        $table.ajax.reload();
    });

});

////***Filter dropdowns AJAX Select2 init*****///

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
                                        columns: [0, 1, 2, 3, 4, 5, 6]
                                    },
                                    title: 'Template details'
                                },
                                {
                                    extend: 'pdf',
                                    exportOptions: {
                                        columns: [0, 1, 2, 3, 4, 5, 6]
                                    },
                                    title: 'Template details'
                                },
                                {
                                    extend: 'print',
                                    exportOptions: {
                                        columns: [0 ,1, 2, 3, 4, 5, 6]
                                    },
                                    title: 'Template details'
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
            
            
            // $('td', row).eq(7).html('<div class="dropdown ms-auto text-end"><div class="btn-link" data-bs-toggle="dropdown"><svg width="24px" height="24px" viewBox="0 0 24 24" version="1.1"><g stroke="none" stroke-width="1" fill="none" fill-rule="evenodd"><rect x="0" y="0" width="24" height="24"></rect><circle fill="#000000" cx="5" cy="12" r="2"></circle><circle fill="#000000" cx="12" cy="12" r="2"></circle><circle fill="#000000" cx="19" cy="12" r="2"></circle></g></svg></div><div class="dropdown-menu dropdown-menu-end"><a class="dropdown-item" href="javascript:void(0)" id="rt" onclick="edit_package('+data['packages_id']+')">Edit</a><a class="dropdown-item" href="javascript:void(0)" onclick="edit_package('+data['packages_id']+', \'duplicate\')">Duplicate</a><a class="dropdown-item" target="_blank" href="<?php echo base_url();?>index.php/Packages/preview_direct/'+data['packages_id']+'" >Preview</a><a class="dropdown-item" href="javascript:void(0)" onclick="return delete_package('+data['packages_id']+')">Delete</a></div></div>');

            let actionHtml = '<div class="dropdown ms-auto text-end"><div class="btn-link" data-bs-toggle="dropdown"><svg width="24px" height="24px" viewBox="0 0 24 24" version="1.1"><g stroke="none" stroke-width="1" fill="none" fill-rule="evenodd"><rect x="0" y="0" width="24" height="24"></rect><circle fill="#000000" cx="5" cy="12" r="2"></circle><circle fill="#000000" cx="12" cy="12" r="2"></circle><circle fill="#000000" cx="19" cy="12" r="2"></circle></g></svg></div><div class="dropdown-menu dropdown-menu-end">';

            // Check if package was created by super admin
            var isSuperAdminCreated = (data['creator_user_type'] == 'A');
            var isCurrentUserSuperAdmin = ('<?php echo $this->session->userdata("user_type"); ?>' == 'A');

            // Edit button - disabled for super admin created packages (unless current user is super admin)
            if (hasPermission('TEMPLATES_UPDATE') && (!isSuperAdminCreated || isCurrentUserSuperAdmin)) {
                actionHtml += '<a class="dropdown-item" href="javascript:void(0)" id="rt" onclick="edit_package('+data['packages_id']+')">Edit</a>';
            }

            // Duplicate button - always available based on permission
            if (hasPermission('TEMPLATES_DUPLICATE')) {
                actionHtml += '<a class="dropdown-item" href="javascript:void(0)" onclick="edit_package('+data['packages_id']+', \'duplicate\')">Duplicate</a>';
            }

            // Preview button - always available based on permission
            if (hasPermission('TEMPLATES_PREVIEW')) {
                actionHtml += '<a class="dropdown-item" target="_blank" href="<?php echo base_url();?>index.php/Packages/preview_direct/'+data['packages_id']+'" >Preview</a>';
            }

            // Delete button - disabled for super admin created packages (unless current user is super admin)
            if (hasPermission('TEMPLATES_DELETE') && (!isSuperAdminCreated || isCurrentUserSuperAdmin)) {
                actionHtml += '<a class="dropdown-item" href="javascript:void(0)" onclick="return delete_package('+data['packages_id']+')">Delete</a>';
            }

            actionHtml += '</div></div>';

            $('td', row).eq(7).html(actionHtml);
            
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
            { "data": "admin_name", "orderable": false },                      
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
  $('.day-editor').removeData('ck-editor-instance');
};

window.initEditorsToken = window.initEditorsToken || 0;

window.initEditorsForDays = function () {
  console.log('initEditorsForDays called');
  window.destroyDayEditors();
  const token = ++window.initEditorsToken;

  // ✅ wait 1 tick so DOM rows are fully inserted
  setTimeout(function () {
    if (token !== window.initEditorsToken) return;

    $('.day-editor').each(function () {
      const textarea = this;
      const rowNum = $(this).closest('tr').data('row-num');

      // If ClassicEditor is not loaded, you will see plain textarea
      if (typeof ClassicEditor === 'undefined') {
        console.error('ClassicEditor not loaded!');
        return;
      }

      // Skip if this textarea already has a live editor
      if ($(textarea).data('ck-editor-instance')) {
        console.log('  skipping row', rowNum, 'already has editor');
        return;
      }

      ClassicEditor.create(textarea).then(editor => {
        window.dayEditors[rowNum] = editor;
        $(textarea).data('ck-editor-instance', editor);
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

window.itineraryLoadToken = 0;

window.loadItinerariesByCategoryDuration = function(done, selectedItineraryId){

  const $duration  = $('#packages_duration_in_nights');
  const $cat       = $('#packages_itinerary_category_id_fk');
  const $itinerary = $('#packages_itinerary_id_fk');

  const nights = $.trim($duration.val());
  const catId  = $.trim($cat.val());

  const token = ++window.itineraryLoadToken;

  $itinerary.html('<option value="">Please Select itinerary</option>');

  if (!catId || !nights) {
    $itinerary.val('');
    if ($itinerary.hasClass('select2-hidden-accessible')) {
      $itinerary.trigger('change.select2');
    }
    if (typeof done === 'function') done(false);
    return;
  }

  $itinerary.html('<option value="">Loading...</option>');

  if ($itinerary.hasClass('select2-hidden-accessible')) {
    $itinerary.trigger('change.select2');
  }

  $.ajax({
    url: '<?php echo base_url(); ?>index.php/Packages/fetch_itinerary_under_category',
    type: 'POST',
    data: {
      packages_itinerary_category_id_fk: catId,
      packages_duration_in_nights: nights
    },
    success: function(html){

      // stop old ajax response from resetting latest selected value
      if (token !== window.itineraryLoadToken) return;

      $itinerary.html(html);

      if (selectedItineraryId) {
        $itinerary.val(String(selectedItineraryId));
      }

      if ($itinerary.hasClass('select2-hidden-accessible')) {
        $itinerary.trigger('change.select2');
      }

      if (typeof done === 'function') done(true);
    },
    error: function(){

      if (token !== window.itineraryLoadToken) return;

      $itinerary.html('<option value="">Please Select itinerary</option>');
      $itinerary.val('');

      if ($itinerary.hasClass('select2-hidden-accessible')) {
        $itinerary.trigger('change.select2');
      }

      if (typeof done === 'function') done(false);
    }
  });
};

$(document).on('change', '.tb-required-checkbox', function () {
  var $itineraryRow = $(this).closest('tr');
  var val = $(this).is(':checked') ? '1' : '2';

  $itineraryRow.find('.tb-required-status').val(val);
  $itineraryRow.attr('data-required-status', val);
  $itineraryRow.attr('data-is-tb', '1');

  var dayId = String($itineraryRow.find('input[name="itineraries_days_id_fk[]"]').val() || '');
  if (!dayId) return;

  $('#property .day-row[data-day-id="' + dayId + '"]').each(function(){
    $(this).attr('data-required-status', val);

    if (val === '1') {
      $(this).show();
    } else {
      $(this).hide();
    }

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

function stampOriginalDestinations() {
  $('#itinerary tr').each(function () {
    const $tr  = $(this);
    const $aid = $tr.find('.active-destination-id');
    if ($aid.length && !$aid.data('original-id')) {
      $aid.data('original-id',   $aid.val());
      $aid.data('original-name', $tr.find('.active-destination-name').val() || '');
    }
  });
}

function resolveDestinationNamesFromMap(map) {
  $('#itinerary tr').each(function () {
    const $tr = $(this);
    const id = String($tr.find('.active-destination-id').val() || '');
    if (!id) return;

    const currentName = $tr.find('.active-destination-name').val() || '';
    const name = map[id] || currentName || id;

    $tr.find('.stay-destination-text').text(name);
    $tr.find('.active-destination-name').val(name);

    $tr.find('.active-destination-id')
      .data('original-id', id)
      .data('original-name', name);
  });
}

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

    // const imgHtml = imgUrl
    //   ? `<img src="${imgUrl}" class="day-thumb" alt="Day Image">`
    //   : `<div class="text-muted small">No image</div>`;

    const imgHtml = `
      <img src="${imgUrl}" class="day-thumb" alt="Day Image"
          style="max-width:120px; max-height:90px; ${imgUrl ? '' : 'display:none;'}">
      <div class="no-image-text text-muted small" ${imgUrl ? 'style="display:none;"' : ''}>No image</div>
    `;

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
          </div>
          <input type="text" name="packages_itineraries_days_title[]" class="form-control mt-1" value="${item.packages_itineraries_days_title || ''}" placeholder="Day title">
          <div>${tbBadge}</div>

          <input type="hidden" name="is_travel_back[]" class="is-travel-back" value="${isTB ? '1' : '0'}">

          <input type="hidden"
                name="packages_itineraries_days_travel_back[]"
                class="pkg-travel-back"
                value="${isTB ? 'TB' : ''}">

          ${requiredStatusHtml}
        </td>

        <td class="stay-destination-cell">
  <span class="stay-destination-text">${destName}</span>
  <input type="hidden" class="active-destination-id" value="${item.packages_itineraries_days_destination_id_fk || ''}">
  <input type="hidden" class="active-destination-name" value="${destName}">
</td>

        <td>
          <textarea
            name="packages_itineraries_days_description[]"
            class="form-control day-editor"
            id="day_editor_${rowNum}"
            rows="6">${item.packages_itineraries_days_description || ''}</textarea>

          <!-- Needed for saving -->
          <input type="hidden" name="packages_itinerary_days_id[]" value="${item.packages_itinerary_days_id || ''}">
          <input type="hidden" name="itineraries_days_id_fk[]" value="${item.itineraries_days_id_fk || ''}">
          <input type="hidden" name="packages_itineraries_days_day[]" value="${item.packages_itineraries_days_day || ''}">

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
          <div class="mb-2 d-flex gap-3">
            <label class="form-check-label" style="font-size:12px;">
              <input type="radio" name="content_source_${rowNum}" class="form-check-input content-source-radio" value="itinerary" checked> Itinerary
            </label>
            <label class="form-check-label" style="font-size:12px;">
              <input type="radio" name="content_source_${rowNum}" class="form-check-input content-source-radio" value="package"> Template
            </label>
          </div>

          <div class="content-source-itinerary">
            <select class="form-control change_itinerary mb-2" data-row-num="${rowNum}" style="width:100%;" data-loaded="0">
              <option value="">Please Select Itinerary</option>
            </select>

            <select class="form-control change_itinerary_day" data-row-num="${rowNum}" style="width:100%;">
              <option value="">Please Select Days</option>
            </select>
          </div>

          <div class="content-source-package" style="display:none;">
            <select class="form-control change_package mb-2" data-row-num="${rowNum}" style="width:100%;">
              <option value="">Please Select Template</option>
            </select>

            <select class="form-control change_package_day" data-row-num="${rowNum}" style="width:100%;">
              <option value="">Please Select Days</option>
            </select>
          </div>

          <div class="day-description-tooltip" id="tooltip_${rowNum}">
            <div class="tooltip-content"></div>
          </div>
        </td>
      </tr>
    `);
  });

  // ✅ Init select2 with AJAX for change_destination and change_itinerary
  $('#itinerary .change_destination').each(function () {
    if (!$(this).hasClass('select2-hidden-accessible')) {
      $(this).select2({
        width: '100%',
        placeholder: 'Please Select Destination',
        allowClear: true,
        dropdownParent: $('#PackagesModal .modal-content'),
        ajax: {
          url: '<?php echo base_url(); ?>index.php/Packages/ajax_filter_destinations',
          dataType: 'json',
          delay: 250,
          data: function(params) { return { q: params.term }; },
          processResults: function(data) { return data; },
          cache: true
        }
      });
    }
  });

  $('#itinerary .change_itinerary').each(function () {
    if (!$(this).hasClass('select2-hidden-accessible')) {
      $(this).select2({
        width: '100%',
        placeholder: 'Please Select Itinerary',
        allowClear: true,
        dropdownParent: $('#PackagesModal .modal-content'),
        ajax: {
          url: '<?php echo base_url(); ?>index.php/Packages/ajax_filter_change_itineraries',
          dataType: 'json',
          delay: 250,
          data: function(params) { return { q: params.term }; },
          processResults: function(data) { return data; },
          cache: true
        }
      });
    }
  });

  $('.change_itinerary_day').select2({ width: '100%', dropdownParent: $('#PackagesModal .modal-content') });

  // ✅ Init select2 for change_package (AJAX) and change_package_day
  $('#itinerary .change_package').each(function () {
    if (!$(this).hasClass('select2-hidden-accessible')) {
      $(this).select2({
        width: '100%',
        placeholder: 'Please Select Template',
        allowClear: true,
        dropdownParent: $('#PackagesModal .modal-content'),
        ajax: {
          url: '<?php echo base_url(); ?>index.php/Packages/get_package_dropdown_by_duration',
          dataType: 'json',
          delay: 250,
          data: function(params) {
            return {
              q: params.term,
              category_id: '',
              exclude_id: ''
            };
          },
          processResults: function(data) { return data; },
          cache: false
        }
      });
    }
  });

  $('.change_package_day').select2({ width: '100%', dropdownParent: $('#PackagesModal .modal-content') });

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

    // Stamp original values so the clear handler can restore them
    $tr.find('.active-destination-id')
      .data('original-id',   id)
      .data('original-name', name);
  });
});

// ✅ if property checkbox was checked during edit load, open now
// if (window.pendingPropertyOpen && typeof window.openPropertyUI === 'function') {
//   window.pendingPropertyOpen = false;
//   window.openPropertyUI();
// }
}

window.loadChangeDestinations = function () {
  // No-op: destinations now loaded via AJAX Select2 on open
};

window.loadRowWiseItineraries = function () {
  // No-op: itineraries now loaded via AJAX Select2 on open
};

function showItineraryAsSelect() {
  $('#itinerary_select_wrap').show();
  $('#itinerary_display_wrap').hide();
  $('#packages_itinerary_display').html('');
  $('#packages_itinerary_id_fk').prop('disabled', false);
}

function showItineraryAsDisplay(itineraryName) {
  $('#itinerary_display_wrap').show();
  $('#itinerary_select_wrap').hide();
  $('#packages_itinerary_display').html(itineraryName || '-');
  $('#packages_itinerary_id_fk').prop('disabled', false);
}

function showDurationAsSelect() {
  $('#duration_select_wrap').show();
  $('#duration_display_wrap').hide();
  $('#packages_duration_display').html('');
}

function showDurationAsDisplay(durationVal) {
  $('#duration_display_wrap').show();
  $('#duration_select_wrap').hide();
  $('#packages_duration_display').html(durationVal || '-');
}

function showItineraryCategoryAsSelect() {
  $('#itinerary_category_select_wrap').show();
  $('#itinerary_category_display_wrap').hide();
  $('#packages_itinerary_category_display').html('');
}

function showItineraryCategoryAsDisplay(categoryName) {
  $('#itinerary_category_display_wrap').show();
  $('#itinerary_category_select_wrap').hide();
  $('#packages_itinerary_category_display').html(categoryName || '-');
}

function edit_package(id, mode) {

  mode = mode || 'update';
  window.save_method = (mode === 'duplicate') ? 'add' : 'update';

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
        $('#PackagesModal .modal-title').text('Edit Template');
        // Hide drag-from template section in edit mode
        $('#drag_package_category').closest('.row.g-3').hide();
      } else {
        $('#packages_id').val('');
        $('#btnSave').text('Save');
        $('#PackagesModal .modal-title').text('Duplicate Template');
        // Show drag-from template section in duplicate mode
        $('#drag_package_category').closest('.row.g-3').show();
      }

      // master fields
      $('#packages_title').val(p.packages_title || '');
      $('#packages_duration_in_nights').val(p.packages_duration_in_nights || '');
      select2AjaxSetSelected('#packages_category_id_fk', p.packages_category_id_fk, p.package_category_name);
      select2AjaxSetSelected('#packages_itinerary_category_id_fk', p.packages_itinerary_category_id_fk, p.itinerary_category_name);

      // cover preview
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

      // load itinerary dropdown values first
      loadItinerariesByCategoryDuration(function(ok){

  $('#packages_itinerary_id_fk').val(String(p.packages_itinerary_id_fk));

  if ($('#packages_itinerary_id_fk').hasClass('select2-hidden-accessible')) {
    $('#packages_itinerary_id_fk').trigger('change.select2');
  }

  if (mode === 'update') {

    let itineraryText = $('#packages_itinerary_id_fk option:selected').text();

    if (!itineraryText || itineraryText === 'Please Select itinerary') {
      itineraryText = p.itineraries_name || p.packages_itinerary_name || '';
    }

    showItineraryAsDisplay(itineraryText);
    showDurationAsDisplay(p.packages_duration_in_nights || '');
    showItineraryCategoryAsDisplay(p.itinerary_category_name || '');

  // } else {

  //   showItineraryAsSelect();

  //   setTimeout(function(){
  //     $('#packages_itinerary_id_fk').trigger('change');
  //   }, 150);
  // }
  } else {

  showItineraryAsSelect();
  showDurationAsSelect();
  showItineraryCategoryAsSelect();

  window.suppressPropertyClearConfirm = true;

  $('#packages_itinerary_id_fk').trigger('change');

  setTimeout(function(){
    window.suppressPropertyClearConfirm = false;
  }, 800);
}

  if (res.itinerary_days && res.itinerary_days.length) {
    buildItineraryRowsFromSaved(res.itinerary_days);
    if (typeof initEditorsForDays === 'function') initEditorsForDays();
  }

  loadDestinationMap(function(map) {
    resolveDestinationNamesFromMap(map);

    if (p.packages_property_checked_type === 'Y') {
      window.isPropertyEditBuild = true;
      $('#packages_property_type').prop('checked', true);
      buildSavedPropertyUI(res.property_data || []);
      window.isPropertyEditBuild = false;
    }
  });

  window.isEditLoading = false;

}, p.packages_itinerary_id_fk);

      // inclusion/exclusion
      if (p.packages_inclusion_exclusion_checked_type === 'Y') {
        $('#packages_inclusion_exclusion_checked_type').prop('checked', true).trigger('change');
        select2AjaxSetSelected('#packages_inclusion_exclusion_common_id_fk', p.packages_inclusion_exclusion_common_id_fk, p.inclusion_exclusion_common_title);

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

      // optional add-ons
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

      // payment
      if (p.packages_payment_policies_checked_type === 'Y') {
        window._loadingPackage = true;
        $('#packages_payment_policies_checked_type').prop('checked', true).trigger('change');
        select2AjaxSetSelected('#payment_policies_id_fk', p.payment_policies_id_fk, p.payment_policies_name);

        setTimeout(function () {
          window._loadingPackage = false;
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

      // terms
      if (p.packages_terms_conditions_checked_type === 'Y') {
        window._loadingPackage = true;
        $('#packages_terms_conditions_checked_type').prop('checked', true).trigger('change');
        select2AjaxSetSelected('#terms_condition_id_fk', p.terms_condition_id_fk, p.terms_condition_name);

        setTimeout(function () {
          window._loadingPackage = false;
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

      // cancellation
      if (p.packages_cancellation_policy_checked_type === 'Y') {
        window._loadingPackage = true;
        $('#packages_cancellation_policy_checked_type').prop('checked', true).trigger('change');
        select2AjaxSetSelected('#cancellation_policies_id_fk', p.cancellation_policies_id_fk, p.cancellation_policies_name);

        setTimeout(function () {
          window._loadingPackage = false;
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

      // notes
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

let $firstValidationError = null;

function markInvalidAndRemember($el, msg) {
  setInvalid($el, msg);

  if (!$firstValidationError && $el && $el.length) {
    $firstValidationError = $el;
  }
}

// function moveToFirstValidationError() {
//   if (!$firstValidationError || !$firstValidationError.length) return;

//   let $target = $firstValidationError;

//   // Select2 visible box
//   if ($target.hasClass('select2-hidden-accessible')) {
//     $target = $target.next('.select2');
//   }

//   // CKEditor visible box
//   if ($firstValidationError.hasClass('day-editor')) {
//     const $ck = $firstValidationError.closest('td').find('.ck-editor');
//     if ($ck.length) $target = $ck;
//   }

//   $('html, body').animate({
//     scrollTop: $target.offset().top - 140
//   }, 400);

//   $target.css('border', '2px solid #dc3545');

//   setTimeout(function () {
//     if ($firstValidationError.hasClass('select2-hidden-accessible')) {
//       $firstValidationError.select2('open');
//     } else if (!$firstValidationError.hasClass('day-editor')) {
//       $firstValidationError.focus();
//     }
//   }, 450);
// }

function moveToFirstValidationError() {
  if (!$firstValidationError || !$firstValidationError.length) return;

  let $field = $firstValidationError;
  let $target = $field;

  // Expand any collapsed Bootstrap 5 accordion that contains this field
  const $accordionCollapse = $field.closest('.accordion-collapse');
  if ($accordionCollapse.length && !$accordionCollapse.hasClass('show')) {
    try {
      const collapseEl = $accordionCollapse[0];
      const bsCollapse = bootstrap.Collapse.getInstance(collapseEl);
      if (bsCollapse) {
        bsCollapse.show();
      } else {
        new bootstrap.Collapse(collapseEl, { toggle: false }).show();
      }
    } catch (e) {
      $accordionCollapse.addClass('show');
      const $btn = $accordionCollapse.closest('.accordion-item').find('.accordion-button');
      if ($btn.length) {
        $btn.removeClass('collapsed').attr('aria-expanded', 'true');
      }
    }
  }

  // Select2 visible container
  if ($field.hasClass('select2-hidden-accessible')) {
    const $s2 = $field.next('.select2');
    if ($s2.length) {
      $target = $s2;
      $s2.find('.select2-selection').css('border', '2px solid #dc3545');
    }
  }

  // CKEditor visible container
  if ($field.hasClass('day-editor')) {
    const $ck = $field.closest('td').find('.ck-editor');
    if ($ck.length) {
      $target = $ck;
      $ck.css('border', '2px solid #dc3545');
    } else {
      $target = $field.closest('tr');
    }
  }

  // fallback to closest visible section if target is hidden/invalid
  if (!$target.length || !$target.is(':visible') || !$target.offset()) {
    $target = $field.closest('.property-section, .card, .form-group, .mb-3, tr, div:visible').first();
  }

  if (!$target.length || !$target.offset()) {
    return;
  }

  $('html, body').animate({
    scrollTop: $target.offset().top - 140
  }, 400);

  setTimeout(function () {
    if (!$field.hasClass('day-editor') && $field.is(':visible')) {
      $field.focus();
    }
  }, 600);
}

function validatePackageForm() {

  $firstValidationError = null;
  clearValidationErrors();
  syncDayEditorsToTextarea();

    $('.ck-editor').css('border', '');
    $('textarea.day-editor').css('border', '');
  let ok = true;

  /* ==========================================================
     1) MAIN REQUIRED FIELDS
     ========================================================== */
  const $pkgTitle   = $('[name="packages_title"]');
  const $duration   = $('[name="packages_duration_in_nights"]');
  const $pkgCat     = $('[name="packages_category_id_fk"]');
  const $itCat      = $('[name="packages_itinerary_category_id_fk"]');
  // const $itinerary  = $('[name="packages_itinerary_id_fk"]');
  const $itinerary  = $('[name="packages_itinerary_id_fk"]');
if (isEmpty($itinerary.val())) {
  ok = false;
  setInvalid($itinerary, 'Itinerary is required');
  markInvalidAndRemember($itinerary, 'Itinerary is required');
}

  // if (isEmpty($pkgTitle.val())) { ok = false; setInvalid($pkgTitle, 'Package title is required'); }
  // if (isEmpty($duration.val())) { ok = false; setInvalid($duration, 'Duration (nights) is required'); }
  // if (isEmpty($pkgCat.val()))   { ok = false; setInvalid($pkgCat, 'Package category is required'); }
  // if (isEmpty($itCat.val()))    { ok = false; setInvalid($itCat, 'Itinerary category is required'); }
  // if (isEmpty($itinerary.val())){ ok = false; setInvalid($itinerary, 'Itinerary is required'); }

  if (isEmpty($pkgTitle.val())) { ok = false; markInvalidAndRemember($pkgTitle, 'Package title is required'); }
  if (isEmpty($duration.val())) { ok = false; markInvalidAndRemember($duration, 'Duration (nights) is required'); }
  if (isEmpty($pkgCat.val()))   { ok = false; markInvalidAndRemember($pkgCat, 'Package category is required'); }
  if (isEmpty($itCat.val()))    { ok = false; markInvalidAndRemember($itCat, 'Itinerary category is required'); }
  if (isEmpty($itinerary.val())){ ok = false; markInvalidAndRemember($itinerary, 'Itinerary is required'); }

  /* ==========================================================
   COVER PAGE VALIDATION
   ========================================================== */
  // const $firstCoverFile = $('#packages_first_cover_page');
  // const $firstCoverTxt  = $('#packages_first_cover_page_txt');

  // const $lastCoverFile = $('#packages_last_cover_page');
  // const $lastCoverTxt  = $('#packages_last_cover_page_txt');

  // const firstHasFile = $firstCoverFile[0] && $firstCoverFile[0].files && $firstCoverFile[0].files.length > 0;
  // const firstHasText = !isEmpty($firstCoverTxt.val());

  // if (!firstHasFile && !firstHasText) {
  //   ok = false;
  //   setInvalid($firstCoverFile, 'First cover page is required');
  // }

  // const lastHasFile = $lastCoverFile[0] && $lastCoverFile[0].files && $lastCoverFile[0].files.length > 0;
  // const lastHasText = !isEmpty($lastCoverTxt.val());

  // if (!lastHasFile && !lastHasText) {
  //   ok = false;
  //   setInvalid($lastCoverFile, 'Last cover page is required');
  // }

  // $('#itinerary tr').each(function () {
  //       const $tr = $(this);
  //       const rowNum = $tr.data('row-num') || '';
  //       const $desc = $tr.find('textarea.day-editor');

  //       if (!$desc.length) return;

  //       const value = ($desc.val() || '').trim();

  //       if (value === '' || value === '<p>&nbsp;</p>' || value === '<p></p>') {
  //           ok = false;

  //           // alert('Day ' + rowNum + ' description is required');
  //           markInvalidAndRemember($desc, 'Day ' + rowNum + ' description is required');

  //           $('html, body').animate({
  //               scrollTop: $tr.offset().top - 120
  //           }, 300);

  //           const $editorBox = $tr.find('.ck-editor');
  //           if ($editorBox.length) {
  //               $editorBox.css('border', '1px solid #dc3545');
  //           } else {
  //               $desc.css('border', '1px solid #dc3545');
  //           }

  //           return false;
  //       }
  //   });
    
  $('#itinerary tr').each(function () {
  const $tr = $(this);
  const rowNum = $tr.data('row-num') || '';

  const $title = $tr.find('input[name="packages_itineraries_days_title[]"]');
  if ($title.length && isEmpty($title.val())) {
    ok = false;
    markInvalidAndRemember($title, 'Day ' + rowNum + ' title is required');
  }

  const $desc = $tr.find('textarea.day-editor');

  if (!$desc.length) return;

  const value = ($desc.val() || '')
    .replace(/<p>&nbsp;<\/p>/gi, '')
    .replace(/<p><\/p>/gi, '')
    .replace(/&nbsp;/gi, '')
    .replace(/<[^>]*>/g, '')
    .trim();

  if (value === '') {
    ok = false;

    markInvalidAndRemember($desc, 'Day ' + rowNum + ' description is required');

    const $editorBox = $tr.find('.ck-editor');
    if ($editorBox.length) {
      $editorBox.css('border', '2px solid #dc3545');
    } else {
      $desc.css('border', '2px solid #dc3545');
    }

    return false;
  }
});
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
      // setInvalid($('#packages_inclusion_exclusion_common_id_fk'), 'Add at least one Inclusion (use +Add new or select a title)');
      markInvalidAndRemember($('#packages_inclusion_exclusion_common_id_fk'), 'Add at least one Inclusion (use +Add new or select a title)');
    }
    if ($excAreas.length === 0) {
      ok = false;
      // setInvalid($('#packages_inclusion_exclusion_common_id_fk'), 'Add at least one Exclusion (use +Add new or select a title)');
      markInvalidAndRemember($('#packages_inclusion_exclusion_common_id_fk'), 'Add at least one Exclusion (use +Add new or select a title)');
    }

    // Required: any textarea empty => invalid
    $incAreas.each(function () {
      // if (isEmpty($(this).val())) { ok = false; setInvalid($(this), 'Inclusion cannot be empty'); }
      if (isEmpty($(this).val())) { ok = false; markInvalidAndRemember($(this), 'Inclusion cannot be empty'); }
    });
    $excAreas.each(function () {
      // if (isEmpty($(this).val())) { ok = false; setInvalid($(this), 'Exclusion cannot be empty'); }
      if (isEmpty($(this).val())) { ok = false; markInvalidAndRemember($(this), 'Exclusion cannot be empty'); }
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
      // setInvalid($optChk, 'Add at least one Optional add on');
      markInvalidAndRemember($optChk, 'Add at least one Optional add on');
    }

    $optAreas.each(function () {
      // if (isEmpty($(this).val())) { ok = false; setInvalid($(this), 'Optional add on cannot be empty'); }
      if (isEmpty($(this).val())) { ok = false; markInvalidAndRemember($(this), 'Optional add on cannot be empty'); }
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
      // setInvalid($('#payment_policies_id_fk'), 'Add at least one Payment policy item (+Add new or select a title)');
      markInvalidAndRemember($('#payment_policies_id_fk'), 'Add at least one Payment policy item (+Add new or select a title)');
    }

    $payAreas.each(function () {
      // if (isEmpty($(this).val())) { ok = false; setInvalid($(this), 'Payment policy cannot be empty'); }
      if (isEmpty($(this).val())) { ok = false; markInvalidAndRemember($(this), 'Payment policy cannot be empty'); }
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
      // setInvalid($('#terms_condition_id_fk'), 'Add at least one Terms & condition item (+Add new or select a title)');
      markInvalidAndRemember($('#terms_condition_id_fk'), 'Add at least one Terms & condition item (+Add new or select a title)');
    }

    $tcAreas.each(function () {
      // if (isEmpty($(this).val())) { ok = false; setInvalid($(this), 'Terms & condition cannot be empty'); }
      if (isEmpty($(this).val())) { ok = false; markInvalidAndRemember($(this), 'Terms & condition cannot be empty'); }
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
      // setInvalid($('#cancellation_policies_id_fk'), 'Add at least one Cancellation policy item (+Add new or select a title)');
      markInvalidAndRemember($('#cancellation_policies_id_fk'), 'Add at least one Cancellation policy item (+Add new or select a title)');
    }

    $canAreas.each(function () {
      // if (isEmpty($(this).val())) { ok = false; setInvalid($(this), 'Cancellation policy cannot be empty'); }
      if (isEmpty($(this).val())) { ok = false; markInvalidAndRemember($(this), 'Cancellation policy cannot be empty'); }
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
      // setInvalid($notesChk, 'Add at least one Note');
      markInvalidAndRemember($notesChk, 'Add at least one Note');
    }

    $noteAreas.each(function () {
      // if (isEmpty($(this).val())) { ok = false; setInvalid($(this), 'Note cannot be empty'); }
      if (isEmpty($(this).val())) { ok = false; markInvalidAndRemember($(this), 'Note cannot be empty'); }
    });
  }

  /* ==========================================================
     16) PROPERTIES (dynamic)
     checkbox checked -> validate:
       - at least one section exists
       - name of the option required
       - each assignment row: property required
       - each assignment row: rooms must have at least 1 selected
     ========================================================== */

  const $propChk = $('#packages_property_type');
  if ($propChk.is(':checked')) {

    const $sections = $('#property .property-section');

    if ($sections.length === 0) {
      ok = false;
      // setInvalid($propChk, 'Add at least one Property section');
      markInvalidAndRemember($propChk, 'Add at least one Property section');
    }

    $sections.each(function () {

      const $sec = $(this);

      const $cat = $sec.find('input[name^="property_category_name"]');
      if ($cat.length && isEmpty($cat.val())) {
        ok = false;
        // setInvalid($cat, 'Name of the option is required');
        markInvalidAndRemember($cat, 'Name of the option is required');
      }

      const $designType = $sec.find('select[name^="packages_properties_common_design_type"]');
      if ($designType.length && isEmpty($designType.val())) {
        ok = false;
        // setInvalid($designType, 'Design Type is required');
        markInvalidAndRemember($designType, 'Design Type is required');
      }

      $sec.find('tr.day-row').each(function () {

        const $dayRow = $(this);
        const isTB = ($dayRow.data('is-tb') == 1);
        const requiredStatus = String($dayRow.attr('data-required-status') || '0');

        if (isTB && requiredStatus === '2') {
          return true;
        }

        const $assignRows = $dayRow.find('.assignment-row');

        if ($assignRows.length === 0) {
          ok = false;
          var dayLabel = $dayRow.find('td').first().text().trim() || 'this day';
          var $addBtn = $dayRow.find('.add-assignment');
          markInvalidAndRemember($addBtn.length ? $addBtn : $dayRow, 'At least one property is required for ' + dayLabel);
          return;
        }

        $assignRows.each(function () {

          const $row = $(this);
          const $propSel = $row.find('select.property-select');
          const $roomsSel = $row.find('select.rooms-select');

          const propVal = $propSel.val();
          const roomsVal = $roomsSel.val();

          if (isEmpty(propVal)) {
            ok = false;
            // setInvalid($propSel, 'Select a property');
            markInvalidAndRemember($propSel, 'Select a property');
            return;
          }

          if (!roomsVal || roomsVal.length === 0) {
            ok = false;
            // setInvalid($roomsSel, 'Select at least one room');
            markInvalidAndRemember($roomsSel, 'Select at least one room');
          }
        });
      });
    });
  }
  // if (!ok) scrollToFirstError();
  if (!ok) {
  moveToFirstValidationError();
}
return ok;
}

// const $propChk = $('#packages_property_type');
// if ($propChk.is(':checked')) {

//   const $sections = $('#property .property-section');

//   if ($sections.length === 0) {
//     ok = false;
//     // setInvalid($propChk, 'Add at least one Property section');
//     markInvalidAndRemember($propChk, 'Add at least one Property section');
//   }

//   $sections.each(function () {

//     const $sec = $(this);

//     const $cat = $sec.find('input[name^="property_category_name"]');
//     if ($cat.length && isEmpty($cat.val())) {
//       ok = false;
//       // setInvalid($cat, 'Category name is required');
//       markInvalidAndRemember($cat, 'Category name is required');
//     }

//     const $designType = $sec.find('select[name^="packages_properties_common_design_type"]');
//     if ($designType.length && isEmpty($designType.val())) {
//       ok = false;
//       // setInvalid($designType, 'Design Type is required');
//       markInvalidAndRemember($designType, 'Design Type is required');
//     }

//     $sec.find('tr.day-row').each(function () {

//       const $dayRow = $(this);
//       const isTB = ($dayRow.data('is-tb') == 1);
//       const requiredStatus = String($dayRow.attr('data-required-status') || '0');

//       if (isTB && requiredStatus === '2') {
//         return true;
//       }

//       $dayRow.find('.assignment-row').each(function () {

//         const $row = $(this);
//         const $propSel = $row.find('select.property-select');
//         const $roomsSel = $row.find('select.rooms-select');

//         const propVal = $propSel.val();
//         const roomsVal = $roomsSel.val();

//         if (isEmpty(propVal)) {
//           ok = false;
//           // setInvalid($propSel, 'Select a property');
//           markInvalidAndRemember($propSel, 'Select a property');
//           return;
//         }

//         if (!roomsVal || roomsVal.length === 0) {
//           ok = false;
//           // setInvalid($roomsSel, 'Select at least one room');
//           markInvalidAndRemember($roomsSel, 'Select at least one room');
//         }
//       });
//     });
//   });
// }

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

  // Debug: log template master hidden inputs before submit
  $('#property .property-section').each(function() {
    var sid = $(this).data('section');
    var tmVal = $(this).find('.template-master-id-hidden').val();
    var tmSel = $(this).find('.template-master-select').val();
    console.log('PRE-SUBMIT section #' + sid + ' hidden=' + tmVal + ' select=' + tmSel);
  });

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

  if ($itinerary.length) $itinerary.select2({ width: '100%', dropdownParent: $('#PackagesModal .modal-content') });

  // $cat.on('change', function () {
  //   window.loadItinerariesByCategoryDuration();
  // });

  $cat.on('change', function () {
    if (window.isEditLoading) return;
    window.loadItinerariesByCategoryDuration();
  });

  let t = null;

  $duration.on('keyup change', function () {
    if (window.isEditLoading) return;

    // reset drag-from package dropdown when duration changes
    if ($('#drag_package_select').hasClass('select2-hidden-accessible')) {
      $('#drag_package_select').val(null).trigger('change');
    }

    clearTimeout(t);
    t = setTimeout(function () {
      if ($cat.val()) {
        window.loadItinerariesByCategoryDuration();
      }
    }, 300);
  });
});



////***Ajax dropdown for add*****///

////***For reset modal again *****///

function resetPackageModal() {

  const $modal = $('#PackagesModal');
  const $form  = $('#form');

  // reset form
  $form[0].reset();

  // clear hidden IDs
  $('#packages_id').val('');
  $('#id').val('');

  // clear file inputs
  $('#packages_first_cover_page').val('');
  $('#packages_last_cover_page').val('');

  // clear cover hidden old values
  $('#packages_first_cover_page_txt').val('');
  $('#packages_last_cover_page_txt').val('');

  // clear cover previews
  $('#first_cover_preview').html('');
  $('#last_cover_preview').html('');

  // make cover required again for add/duplicate
  $('#packages_first_cover_page').prop('required', true);
  $('#packages_last_cover_page').prop('required', true);

  // reset itinerary display/select mode
  showItineraryAsSelect();
  showDurationAsSelect();
  showItineraryCategoryAsSelect();
  $('#packages_itinerary_display').html('');
  $('#packages_duration_display').html('');
  $('#packages_itinerary_category_display').html('');

  // reset select2 properly
  $modal.find('select').each(function () {
    const $s = $(this);

    $s.val('');

    if ($s.hasClass('select2-hidden-accessible')) {
      $s.trigger('change.select2');
    } else {
      $s.trigger('change');
    }
  });

  // reset itinerary dropdown options
  $('#packages_itinerary_id_fk')
    .html('<option value="">Please Select itinerary</option>')
    .val('');

  if ($('#packages_itinerary_id_fk').hasClass('select2-hidden-accessible')) {
    $('#packages_itinerary_id_fk').trigger('change.select2');
  }

  // uncheck checkboxes
  $modal.find('input[type="checkbox"]').prop('checked', false);

  // clear itinerary rows
  if (typeof destroyDayEditors === 'function') destroyDayEditors();
  $('#itinerary').empty();

  // reset drag-from dropdowns
  resetDragPackageDropdowns();

  // clear dynamic sections
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
  $('#myDiv10').hide();

  $('#property').empty().hide();
  $('[onClick="addMore10();"]').closest('.terms_add, .mb-3').hide();

  // reset flags
  window.isEditLoading = false;
  window.isPropertyEditBuild = false;
  window.isPropertyPrefill = false;
  window.pendingPropertyOpen = false;
  window._suppressPropertySelectChange = false;
  window._suppressTemplateMasterChange = false;

  // validation clear
  $modal.find('.is-invalid, .has-error').removeClass('is-invalid has-error');
  $modal.find('.js-err').remove();
  $modal.find('.help-block').text('');

  $('#btnSave').text('Save').prop('disabled', false);
}

////***For reset modal again *****///


////***For select2 change destination *****///


$(document).on('change', '.change_destination', function () {

  const $sel = $(this);
  if ($sel.data('skip-destination-update')) {
    $sel.removeData('skip-destination-update');
    return;
  }

  const $row = $sel.closest('tr');
  const newDestId   = $sel.val();
  const selData     = $sel.select2('data');
  const newDestName = (selData[0] && selData[0].text) ? selData[0].text : '';

  if (!newDestId) {
    // Cleared — restore original stay destination and clear property block (no confirmation needed)
    const origId   = $row.find('.active-destination-id').data('original-id')   || '';
    let origName = $row.find('.active-destination-name').data('original-name')  || '';
    if (!origName && origId && window.destinationMap && window.destinationMap[origId]) {
      origName = window.destinationMap[origId];
    }
    if (!origName) origName = origId;

    $row.find('.active-destination-id').val(origId);
    $row.find('.active-destination-name').val(origName);
    $row.find('.destination-post').val(origId);
    $row.find('.stay-destination-text').text(origName);

    var dayId = $row.find('input[name="itineraries_days_id_fk[]"]').val() || '';
    if (dayId && typeof updatePropertySectionsForDay === 'function') {
      updatePropertySectionsForDay(dayId, origId, origName);
    }
    return;
  }

  $row.find('.active-destination-id').val(newDestId);
  $row.find('.active-destination-name').val(newDestName);
  $row.find('.stay-destination-text').text(newDestName);

  // ✅ IMPORTANT: this is the posted array field
  $row.find('.destination-post').val(newDestId);
});

////***For set destination id and name if selected another destination from dropdown under change destination *****///

////***For loading itiniraries in dropdown under duration nights and load days based on itineray and display details in tooltip *****///

$(document).ready(function () {

  // Fix Bootstrap 5 modal focus trapping so Select2 search fields can receive focus
  try {
    if (typeof bootstrap !== 'undefined' && bootstrap.Modal && bootstrap.Modal.prototype._enforceFocus) {
      var originalEnforceFocus = bootstrap.Modal.prototype._enforceFocus;
      bootstrap.Modal.prototype._enforceFocus = function() {
        // If any Select2 dropdown is currently open, skip enforcing focus so the search field stays focused
        if (!document.querySelector('.select2-container--open')) {
          originalEnforceFocus.call(this);
        }
      };
    }
  } catch (e) {}

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

$(document).on('change', '.day-image-input', function () {
    var file = this.files && this.files[0] ? this.files[0] : null;
    var $tr = $(this).closest('tr');
    var $img = $tr.find('.day-thumb');
    var $noImg = $tr.find('.no-image-text');

    if (!$img.length) {
        console.log('day-thumb not found');
        return;
    }

    if (!file) {
        $img.attr('src', '').hide();
        $noImg.show();
        return;
    }

    if (!file.type.match(/^image\//)) {
        alert('Please select a valid image');
        $(this).val('');
        return;
    }

    var reader = new FileReader();
    reader.onload = function (e) {
        $img.attr('src', e.target.result).show();
        $noImg.hide();
    };
    reader.readAsDataURL(file);
});

$('#packages_itinerary_id_fk').on('change', function () {

  console.log('itinerary change handler fired: isEditLoading=', window.isEditLoading, 'val=', $(this).val());

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

      if (window.isEditLoading) return;

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
                      class="form-check-input tb-required-checkbox">
                Property / Room Required
              </label>
              <input type="hidden"
                    name="packages_itineraries_days_required_status[]"
                    class="tb-required-status"
                    value="2">
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
          <tr data-row-num="${rowNum}" data-required-status="${isTB ? 2 : 0}" data-is-tb="${isTB ? 1 : 0}">
            <td>
              <div>
                <b>${item.itineraries_days_day}</b>
              </div>
              <input type="text" name="packages_itineraries_days_title[]" class="form-control mt-1" value="${item.itineraries_days_title}" placeholder="Day title">
              <div>${tbBadge}</div>

              <input type="hidden" name="is_travel_back[]" class="is-travel-back" value="${isTB ? '1' : '0'}">

              <input type="hidden"
                    name="packages_itineraries_days_travel_back[]"
                    class="pkg-travel-back"
                    value="${isTB ? 'TB' : ''}">

              ${requiredStatusHtml}
            </td>

            <td class="stay-destination-cell">
              <span class="stay-destination-text">${item.state_name || ''}</span>
              <input type="hidden" class="active-destination-id" data-original-id="${item.itineraries_days_destination_id_fk || ''}" value="${item.itineraries_days_destination_id_fk || ''}">
              <input type="hidden" class="active-destination-name" data-original-name="${item.state_name || ''}" value="${item.state_name || ''}">
            </td>

            <td>
              <!-- CKEditor textarea (NO hidden textarea now) -->
              <textarea
                name="packages_itineraries_days_description[]"
                class="form-control day-editor"
                id="day_editor_${rowNum}"
                rows="6">${item.itineraries_days_description || ''}</textarea>

              <!-- Needed for saving -->
              <input type="hidden" name="packages_itinerary_days_id[]" value="">
              <input type="hidden" name="itineraries_days_id_fk[]" value="${item.itineraries_days_id}">
              <input type="hidden" name="packages_itineraries_days_day[]" value="${item.itineraries_days_day}">
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
              <div class="mb-2 d-flex gap-3">
                <label class="form-check-label" style="font-size:12px;">
                  <input type="radio" name="content_source_${rowNum}" class="form-check-input content-source-radio" value="itinerary" checked> Itinerary
                </label>
                <label class="form-check-label" style="font-size:12px;">
                  <input type="radio" name="content_source_${rowNum}" class="form-check-input content-source-radio" value="package"> Template
                </label>
              </div>

              <div class="content-source-itinerary">
                <select class="form-control change_itinerary mb-2" data-row-num="${rowNum}" style="width:100%;">
                  <option value="">Please Select Itinerary</option>
                </select>

                <select class="form-control change_itinerary_day" data-row-num="${rowNum}" style="width:100%;">
                  <option value="">Please Select Days</option>
                </select>
              </div>

              <div class="content-source-package" style="display:none;">
                <select class="form-control change_package mb-2" data-row-num="${rowNum}" style="width:100%;">
                  <option value="">Please Select Template</option>
                </select>

                <select class="form-control change_package_day" data-row-num="${rowNum}" style="width:100%;">
                  <option value="">Please Select Days</option>
                </select>
              </div>

              <div class="day-description-tooltip" id="tooltip_${rowNum}">
                <div class="tooltip-content"></div>
              </div>
            </td>
          </tr>
        `);
      });

      // Init AJAX Select2 for change_destination
      $('#itinerary .change_destination').each(function () {
        if (!$(this).hasClass('select2-hidden-accessible')) {
          $(this).select2({
            width: '100%',
            placeholder: 'Please Select Destination',
            allowClear: true,
            dropdownParent: $('#PackagesModal .modal-content'),
            ajax: {
              url: '<?php echo base_url(); ?>index.php/Packages/ajax_filter_destinations',
              dataType: 'json',
              delay: 250,
              data: function(params) { return { q: params.term }; },
              processResults: function(data) { return data; },
              cache: true
            }
          });
        }
      });

      // Init AJAX Select2 for change_itinerary
      $('#itinerary .change_itinerary').each(function () {
        if (!$(this).hasClass('select2-hidden-accessible')) {
          $(this).select2({
            width: '100%',
            placeholder: 'Please Select Itinerary',
            allowClear: true,
            dropdownParent: $('#PackagesModal .modal-content'),
            ajax: {
              url: '<?php echo base_url(); ?>index.php/Packages/ajax_filter_change_itineraries',
              dataType: 'json',
              delay: 250,
              data: function(params) { return { q: params.term }; },
              processResults: function(data) { return data; },
              cache: true
            }
          });
        }
      });

      $('.change_itinerary_day').select2({ width: '100%', dropdownParent: $('#PackagesModal .modal-content') });

      // Init AJAX Select2 for change_package
      $('#itinerary .change_package').each(function () {
        if (!$(this).hasClass('select2-hidden-accessible')) {
          $(this).select2({
            width: '100%',
            placeholder: 'Please Select Template',
            allowClear: true,
            dropdownParent: $('#PackagesModal .modal-content'),
            ajax: {
              url: '<?php echo base_url(); ?>index.php/Packages/get_package_dropdown_by_duration',
              dataType: 'json',
              delay: 250,
              data: function(params) {
                return {
                  q: params.term,
                  category_id: '',
                  exclude_id: ''
                };
              },
              processResults: function(data) { return data; },
              cache: false
            }
          });
        }
      });

      $('.change_package_day').select2({ width: '100%', dropdownParent: $('#PackagesModal .modal-content') });

      // Stamp original destination values so the clear handler can restore them
      stampOriginalDestinations();

      // ✅ INIT CKEDITOR for each row
      initEditorsForDays();

      if (window.pendingPropertyOpen && typeof window.openPropertyUI === 'function' && !$('#property .property-section').length) {
        window.pendingPropertyOpen = false;
        window.openPropertyUI();
      } else if ($('#property .property-section').length) {
        window.pendingPropertyOpen = false;
        console.log('Itinerary loaded: rebuilding property sections. Found', $('#property .property-section').length, 'sections');
        // Rebuild day rows in existing property sections to match new itinerary
        $('#property .property-section').each(function() {
          try {
            rebuildPropertySectionDays($(this));
          } catch (e) {
            console.error('rebuildPropertySectionDays error:', e);
          }
        });
      } else {
        console.log('Itinerary loaded: no property sections to rebuild');
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
        dropdownParent: $('#PackagesModal .modal-content'),
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

// ==========================================================
//  CONTENT SOURCE RADIO TOGGLE (Itinerary / Template)
// ==========================================================

$(document).on('change', '.content-source-radio', function () {
  let row = $(this).closest('tr');
  let val = $(this).val();

  if (val === 'package') {
    row.find('.content-source-itinerary').hide();
    row.find('.content-source-package').show();
  } else {
    row.find('.content-source-package').hide();
    row.find('.content-source-itinerary').show();
  }
});

// ==========================================================
//  CHANGE PACKAGE → Load package days into day dropdown
// ==========================================================

$(document).on('change', '.change_package', function () {

  let row = $(this).closest('tr');
  let packageId = $(this).val();
  let daySelect = row.find('.change_package_day');

  if (daySelect.hasClass('select2-hidden-accessible')) {
    daySelect.select2('destroy');
  }

  daySelect.empty().append('<option value="">Please Select Days</option>');

  if (!packageId) {
    daySelect.select2({ width: '100%', dropdownParent: $('#PackagesModal .modal-content') });
    return;
  }

  $.ajax({
    type: "POST",
    url: "<?php echo base_url(); ?>index.php/Packages/fetch_days_under_package",
    data: { packages_id: packageId },
    dataType: "json",
    success: function (days) {
      $.each(days, function (i, day) {
        daySelect.append(
          '<option value="' + day.packages_itinerary_days_id + '"'
          + ' data-desc="' + (day.packages_itineraries_days_description || '').replace(/"/g, '&quot;') + '">'
          + (day.packages_itineraries_days_day || ('Day ' + (i + 1))) + ' | ' + (day.packages_itineraries_days_title || '')
          + '</option>'
        );
      });
      daySelect.select2({
        width: '100%',
        placeholder: 'Please Select Days',
        allowClear: true,
        dropdownParent: $('#PackagesModal .modal-content'),
        templateResult: function (data) {
          if (!data.id) return data.text;
          var description = $(data.element).attr('data-desc');
          var $span = $('<span>').text(data.text);
          if (description) { $span.attr('data-preview-desc', description); }
          return $span;
        }
      });
    }
  });
});

// ==========================================================
//  CHANGE PACKAGE DAY → Load description into CKEditor
// ==========================================================

$(document).on('select2:open', '.change_package_day', function() {
  activeRowId = $(this).data('row-num');
  isMenuOpening = true;
  setTimeout(() => isMenuOpening = false, 200);
});

$(document).on('select2:close', '.change_package_day', function() {
  $('.day-description-tooltip').hide();
  activeRowId = null;
});

$(document).on('select2:select', '.change_package_day', function (e) {
  let $select = $(this);
  let row = $select.closest('tr');
  let rowNum = row.data('row-num');

  let data = e.params.data;
  let description = $(data.element).attr('data-desc') || '';

  if (window.dayEditors && window.dayEditors[rowNum]) {
    window.dayEditors[rowNum].setData(description);
  } else {
    row.find('.day-editor').val(description);
  }
});

});

    

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

        if (window._loadingPackage) return;

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

        if (window._loadingPackage) return;

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

        if (window._loadingPackage) return;

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

    // Hide/show the whole Notes card column (fallback to #add_notes if #myDiv10 missing)
    const $cardCol = $('#myDiv10').length ? $('#myDiv10') : $box.closest('.col-xl-10, .col-lg-10, .card').first();

    // The add button block (we keep it, and insert rows before it)
    const $btnBlock = $box.find('.mb-3.col-md-6').first();

    /* ===============================
       INITIAL STATE
       =============================== */
    if (!$chk.is(':checked')) {
        $cardCol.hide();
    }

    /* ===============================
       CHECKBOX TOGGLE
       =============================== */
    $chk.on('change', function () {

        if ($(this).is(':checked')) {
            $cardCol.slideDown();
            if ($btnBlock.length) $btnBlock.show();
            clearNoteRows();
        } else {
            $cardCol.slideUp();
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

  window.rebuildPropertySectionDays = function($section) {
    var sectionId = $section.data('section');
    var master = $section.data('template-master-data');
    var $tbody = $section.find('.property-days-body');
    var newDays = getDaysFromItinerary();

    console.log('rebuildPropertySectionDays: sectionId=', sectionId, 'newDays=', newDays.length, 'master=', master ? 'yes' : 'no');

    if (!newDays.length) {
      console.log('rebuildPropertySectionDays: no itinerary days, clearing tbody');
      $tbody.find('.property-select, .rooms-select').each(function() {
        if ($(this).hasClass('select2-hidden-accessible')) $(this).select2('destroy');
      });
      $tbody.empty();
      return;
    }

    // Mark all existing rows; unmark those we keep
    $tbody.find('tr.day-row').attr('data-keep', '0');

    var $lastProcessedRow = null;

    $.each(newDays, function(idx, d) {
      var dayKey = String(d.dayId);
      var destId = String(d.destId || '');
      var destName = d.destName || '';

      if (window.destinationMap && destId && window.destinationMap[destId]) {
        destName = window.destinationMap[destId];
      }
      if (!destName || destName === destId) {
        destName = destId;
      }

      var isTB = d.isTB;
      var requiredStatus = String(d.requiredStatus || '0');

      // Try to find an existing row with same dayId AND same destination
      var $existing = $tbody.find('tr.day-row[data-day-id="' + dayKey + '"]').filter(function() {
        var existingDestId = String($(this).find('input[name^="property_destination_id"]').val() || '');
        return existingDestId === destId;
      }).first();

      if ($existing.length) {
        // Keep this row — just refresh display name / visibility
        $existing.attr('data-keep', '1');
        $existing.find('.property-destination-name').text(destName).attr('data-dest-id', destId);
        $existing.find('input[name^="property_destination_id"]').val(destId);
        $existing.attr('data-is-tb', isTB ? 1 : 0);
        $existing.attr('data-required-status', d.requiredStatus);
        var tbRowHidden = (isTB && requiredStatus !== '1');
        $existing.toggle(!tbRowHidden);
        $lastProcessedRow = $existing;
        console.log('rebuildPropertySectionDays: keeping day', dayKey, 'dest', destId);
        return; // continue to next newDay
      }

      // Need to build a new row for this day
      console.log('rebuildPropertySectionDays: building day', dayKey, 'dest', destId);

      var tbBadge = isTB ? ' <span class="badge bg-warning text-dark ms-2">Travel Back</span>' : '';
      var tbRowHidden = (isTB && requiredStatus !== '1');

      var $dayRow = $(`
        <tr class="day-row"
            data-day-id="${dayKey}"
            data-is-tb="${isTB ? 1 : 0}"
            data-required-status="${d.requiredStatus}"
            data-keep="1"
            style="${tbRowHidden ? 'display:none; ' : ''}border-bottom: 2px solid #adb5bd;">
          <td>${escapeHtml(d.dayText)}${tbBadge}</td>
          <td>
            <span class="property-destination-name" data-dest-id="${escapeHtml(destId)}">${escapeHtml(destName)}</span>
            <input type="hidden"
                  name="property_destination_id[${sectionId}][${dayKey}]"
                  value="${escapeHtml(destId)}">
          </td>
          <td colspan="3">
            <div class="assignments" data-dest-id="${escapeHtml(destId)}"></div>
            <div class="mt-2">
              <button type="button" class="btn btn-danger btn-sm add-assignment">+ Add Property</button>
            </div>
          </td>
        </tr>
      `);

      if ($lastProcessedRow && $lastProcessedRow.length) {
        $lastProcessedRow.after($dayRow);
      } else {
        $tbody.prepend($dayRow);
      }
      $lastProcessedRow = $dayRow;

      // Load property/room rows from template master
      var matchedDest = null;
      if (master && master.destinations && master.destinations.length && destId) {
        for (var i = 0; i < master.destinations.length; i++) {
          if (String(master.destinations[i].state_id) === destId) {
            matchedDest = master.destinations[i];
            break;
          }
        }
      }

      if (matchedDest && matchedDest.properties && matchedDest.properties.length) {
        $.each(matchedDest.properties, function(pIdx, prop) {
          var isFirst = (pIdx === 0);
          addAssignmentRow($dayRow, sectionId, dayKey, destId, isFirst, isTB, {
            skipLoad: true,
            requiredStatus: requiredStatus
          });

          var $lastRow = $dayRow.find('.assignment-row').last();
          var $propSel = $lastRow.find('.property-select');
          var $roomsSel = $lastRow.find('.rooms-select');

          window._suppressPropertySelectChange = true;
          try {
            setPropertyAndRoomsFromSaved(
              destId,
              $propSel,
              $roomsSel,
              String(prop.property_id),
              prop.property_name,
              $.map(prop.rooms || [], function(r) {
                return { id: String(r.properties_room_category_id), text: r.properties_room_category_name };
              })
            );
          } finally {
            window._suppressPropertySelectChange = false;
          }
        });
      } else {
        addAssignmentRow($dayRow, sectionId, dayKey, destId, true, isTB, {
          skipLoad: false,
          requiredStatus: requiredStatus
        });
      }
    });

    // Remove rows that are not kept (old days no longer in itinerary or days with changed destinations)
    $tbody.find('tr.day-row[data-keep="0"]').each(function() {
      var dayKey = $(this).data('day-id');
      console.log('rebuildPropertySectionDays: removing old/changed day row', dayKey);
      $(this).find('.property-select, .rooms-select').each(function() {
        if ($(this).hasClass('select2-hidden-accessible')) $(this).select2('destroy');
      });
      $(this).remove();
    });
  }

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


  function loadProperties(destId, $select) {
  var dfd = $.Deferred();

  if ($select.hasClass('select2-hidden-accessible')) {
    $select.select2('destroy');
  }

  $select.empty().append('<option value="">Please Select Properties</option>');

  $select.select2({
    width: '100%',
    placeholder: 'Please Select Properties',
    allowClear: true,
    dropdownParent: $('#PackagesModal .modal-content'),
    ajax: {
      url: '<?php echo base_url(); ?>index.php/Packages/ajax_filter_properties',
      dataType: 'json',
      delay: 250,
      data: function(params) {
        return { destination_id: destId, q: params.term };
      },
      processResults: function(data) { return data; },
      cache: true
    }
  });

  dfd.resolve([]);

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
      placeholder:'Please Select Rooms',
      dropdownParent: $('#PackagesModal .modal-content')
    });

    dfd.resolve(res || []);
  }).fail(function(){
    $roomsSelect.prop('disabled', false);
    $roomsSelect.select2({
      width:'100%',
      placeholder:'Please Select Rooms',
      dropdownParent: $('#PackagesModal .modal-content')
    });
    dfd.resolve([]);
  });

  return dfd.promise();
}

////////

function loadPropertiesAsync(destId, $select) {
  const dfd = $.Deferred();

  if ($select.hasClass('select2-hidden-accessible')) {
    $select.select2('destroy');
  }

  $select.empty().append('<option value="">Please Select Properties</option>');

  $select.select2({
    width: '100%',
    placeholder: 'Please Select Properties',
    allowClear: true,
    dropdownParent: $('#PackagesModal .modal-content'),
    ajax: {
      url: '<?php echo base_url(); ?>index.php/Packages/ajax_filter_properties',
      dataType: 'json',
      delay: 250,
      data: function(params) {
        return { destination_id: destId, q: params.term };
      },
      processResults: function(data) { return data; },
      cache: true
    }
  });

  dfd.resolve([]);

  return dfd.promise();
}

function loadRoomsAsync(propertyId, $roomsSelect) {
  const dfd = $.Deferred();

  if ($roomsSelect.hasClass('select2-hidden-accessible')) {
    $roomsSelect.select2('destroy');
  }

  $roomsSelect.prop('disabled', true).empty();

  if (window._roomsCache && window._roomsCache[propertyId]) {
    var cached = window._roomsCache[propertyId];
    $.each(cached, function(i, r) {
      $roomsSelect.append(
        '<option value="' + String(r.properties_room_category_id) + '" data-roomid="' + String(r.room_id || '') + '">' +
        r.properties_room_category_name +
        '</option>'
      );
    });
    $roomsSelect.prop('disabled', false);
    $roomsSelect.select2({
      width: '100%',
      placeholder: 'Please Select Rooms',
      dropdownParent: $('#PackagesModal .modal-content')
    });
    dfd.resolve(cached);
    return dfd.promise();
  }

  $.ajax({
    url: '<?php echo base_url(); ?>index.php/Packages/get_rooms_by_property',
    type: 'POST',
    dataType: 'json',
    data: { property_id: propertyId },
    success: function(res) {
      window._roomsCache = window._roomsCache || {};
      window._roomsCache[propertyId] = res || [];
      $roomsSelect.empty();

      $.each(res || [], function(i, r) {
        $roomsSelect.append(
          '<option value="' + String(r.properties_room_category_id) + '" data-roomid="' + String(r.room_id || '') + '">' +
          r.properties_room_category_name +
          '</option>'
        );
      });

      $roomsSelect.prop('disabled', false);
      $roomsSelect.select2({
        width: '100%',
        placeholder: 'Please Select Rooms',
        dropdownParent: $('#PackagesModal .modal-content')
      });

      dfd.resolve(res || []);
    },
    error: function() {
      $roomsSelect.prop('disabled', false);
      $roomsSelect.select2({ width: '100%', dropdownParent: $('#PackagesModal .modal-content') });
      dfd.resolve([]);
    }
  });

  return dfd.promise();
}

function normalizeRoomIds(v) {
  if (!v) return [];

  if (Array.isArray(v)) {
    return v.map(function(x) {
      if (x === null || x === undefined) return '';

      if (typeof x === 'object') {
        return String(
          x.properties_room_category_id ||
          x.room_category_id ||
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
    return v.split(',').map(function(s) {
      return $.trim(s);
    }).filter(Boolean).map(String);
  }

  return [String(v)];
}

// function setPropertyAndRoomsFromSaved(destId, $propSel, $roomsSel, savedPropertyId, savedRoomIds) {
//   const dfd = $.Deferred();

//   savedPropertyId = savedPropertyId ? String(savedPropertyId) : '';
//   const roomVals = normalizeRoomIds(savedRoomIds);

//   loadPropertiesAsync(destId, $propSel).then(function() {

//     setTimeout(function() {

//       $propSel.val(savedPropertyId).trigger('change.select2');

//       if (!savedPropertyId) {
//         dfd.resolve();
//         return;
//       }

//       loadRoomsAsync(savedPropertyId, $roomsSel).then(function() {

//         setTimeout(function() {

//           let finalRooms = [];

//           roomVals.forEach(function(rv) {
//             if ($roomsSelectHasValue($roomsSel, rv)) {
//               finalRooms.push(rv);
//             }
//           });

//           if (finalRooms.length === 0) {
//             $roomsSel.find('option').each(function() {
//               const optVal = String($(this).val() || '');
//               const roomId = String($(this).data('roomid') || '');

//               if (roomVals.indexOf(optVal) !== -1 || roomVals.indexOf(roomId) !== -1) {
//                 finalRooms.push(optVal);
//               }
//             });
//           }

//           $roomsSel.val(finalRooms).trigger('change.select2');
//           dfd.resolve();

//         }, 50);
//       });

//     }, 50);
//   });

//   return dfd.promise();
// }

function setPropertyAndRoomsFromSaved(destId, $propSel, $roomsSel, savedPropertyId, savedPropertyName, savedRooms) {
  // savedRooms = [{id, text}, ...] as returned by get_properties_with_names
  savedPropertyId = savedPropertyId ? String(savedPropertyId) : '';
  savedPropertyName = savedPropertyName || savedPropertyId;

  // init AJAX Select2 on the property select (resolves immediately)
  loadPropertiesAsync(destId, $propSel);

  if (!savedPropertyId) return;

  // inject the saved property as a selected option — no extra AJAX needed
  if ($propSel.find('option[value="' + savedPropertyId + '"]').length === 0) {
    $propSel.append(new Option(savedPropertyName, savedPropertyId, true, true));
  } else {
    $propSel.val(savedPropertyId);
  }
  $propSel.trigger('change.select2');

  var savedRoomIds = (savedRooms || []).map(function(r) { return String(r.id); });

  // Load all rooms for this property via AJAX, then pre-select saved ones
  loadRoomsAsync(savedPropertyId, $roomsSel).then(function() {
    if (savedRoomIds.length) {
      $roomsSel.val(savedRoomIds).trigger('change.select2');
    }
  });
}

function $roomsSelectHasValue($select, val) {
  return $select.find('option[value="' + String(val) + '"]').length > 0;
}

  window.addMore10 = function () {

    if (!$('#packages_property_type').is(':checked')) return;

    const days = getDaysFromItinerary();

    var maxId = 0;
    $('#property .property-section').each(function() {
      var id = parseInt($(this).attr('data-section')) || 0;
      if (id > maxId) maxId = id;
    });
    const sectionId = maxId + 1;

    const $section = $(`
      <div class="accordion-item">
        <h2 class="accordion-header" id="headingProperty${sectionId}">
          <button class="accordion-button fw-bold collapsed" type="button" data-bs-toggle="collapse" data-bs-target="#collapseProperty${sectionId}" aria-expanded="false" aria-controls="collapseProperty${sectionId}">
            <i class="la la-building me-2 property-icon"></i> Property Section <span class="property-title-count ms-1">#${sectionId}</span>
          </button>
        </h2>
        <div id="collapseProperty${sectionId}" class="accordion-collapse collapse" aria-labelledby="headingProperty${sectionId}" data-bs-parent="#propertyAccordion">
          <div class="accordion-body p-0">
            <div class="property-section border rounded p-3 mb-0" data-section="${sectionId}">
              <div class="d-flex align-items-end justify-content-between mb-2 gap-3 flex-wrap">
                <div style="width:260px;">
                  <label><b>Template Master</b></label>
                  <select class="form-control template-master-select"
                          data-section-id="${sectionId}"
                          style="width:100%;">
                    <option value="">Select Template</option>
                  </select>
                  <input type="hidden"
                        name="packages_properties_common_template_master_id_fk[${sectionId}]"
                        class="template-master-id-hidden"
                        value="">
                </div>

                <div style="width:260px;">
                  <label><b>Name of the Option</b></label>
                  <input type="text"
                        name="property_category_name[${sectionId}]"
                        class="form-control property-category-name"
                        placeholder="Enter name of the option"
                        required>
                </div>

                <div style="width:200px;">
                  <label><b>Design Type</b></label>
                  <select name="packages_properties_common_design_type[${sectionId}]"
                          class="form-control design-type-select"
                          style="width:100%;">
                    <option value="">Select Design</option>
                    <option value="Standard">Standard</option>
                    <option value="Exclusive">Exclusive</option>
                  </select>
                </div>

                <div style="flex:1; min-width:300px;">
                  <label><b>Complimentary Inclusions</b></label>
                  <textarea name="packages_properties_common_complimentary_inclusion[${sectionId}]"
                            class="form-control complimentary-inclusion-textarea"
                            rows="2"
                            placeholder="Enter complimentary inclusions"></textarea>
                </div>

                <div>
                  <button type="button" class="btn btn-danger btn-sm remove-section">Remove Section</button>
                </div>
              </div>

              <div class="table-responsive">
                <table class="table table-sm mb-0">
                  <thead>
                    <tr>
                      <th style="width:100px;">Day</th>
                      <th style="width:180px;">Stay Destination</th>
                      <th style="width:280px;">Property</th>
                      <th>Rooms</th>
                      <th style="width:100px;"></th>
                    </tr>
                  </thead>
                  <tbody class="property-days-body"></tbody>
                </table>
              </div>
            </div>
          </div>
        </div>
      </div>
    `);

    const $tbody = $section.find('.property-days-body');

    $.each(days, function (idx, d) {
      // const dayKey = d.dayId;
      // const tbBadge = d.isTB ? ' <span class="badge bg-warning text-dark ms-2">Travel Back</span>' : '';

      const dayKey = d.dayId;
      const tbBadge = d.isTB ? ' <span class="badge bg-warning text-dark ms-2">Travel Back</span>' : '';

      const destId = String(d.destId || '');
      let destName = d.destName || '';

      if (window.destinationMap && destId && window.destinationMap[destId]) {
        destName = window.destinationMap[destId];
      }

      if (!destName || destName === destId) {
        destName = destId; // temporary fallback
      }

      const tbRowHidden = (d.isTB && String(d.requiredStatus) !== '1');

      const $dayRow = $(`
        <tr class="day-row"
            data-day-id="${dayKey}"
            data-is-tb="${d.isTB ? 1 : 0}"
            data-required-status="${d.requiredStatus}"
            style="${tbRowHidden ? 'display:none; ' : ''}border-bottom: 2px solid #adb5bd;">
          <td>${escapeHtml(d.dayText)}${tbBadge}</td>
          <td>
           
            <span class="property-destination-name" data-dest-id="${escapeHtml(destId)}">${escapeHtml(destName)}</span>
            <input type="hidden"
                  name="property_destination_id[${sectionId}][${dayKey}]"
                  value="${escapeHtml(destId)}">
          </td>
          <td colspan="3">
            <div class="assignments" data-dest-id="${escapeHtml(destId)}"></div>
            <div class="mt-2">
              <button type="button" class="btn btn-danger btn-sm add-assignment">+ Add Property</button>
            </div>
          </td>
        </tr>
      `);

      $tbody.append($dayRow);

      // addAssignmentRow(
      //   $dayRow,
      //   sectionId,
      //   dayKey,
      //   d.destId,
      //   true,
      //   d.isTB,
      //   {
      //     skipLoad: false,
      //     requiredStatus: d.requiredStatus
      //   }
      // );
      addAssignmentRow(
  $dayRow,
  sectionId,
  dayKey,
  destId,
  true,
  d.isTB,
  {
    skipLoad: window.isPropertyPrefill === true,
    requiredStatus: d.requiredStatus
  }
);
    });

    $('#property').append($section);
    $section.find('.design-type-select').select2({ width: '100%' });

    $section.find('.template-master-select').select2({
      width: '100%',
      placeholder: 'Select Template Master',
      allowClear: true,
      dropdownParent: $('#PackagesModal .modal-content'),
      ajax: {
        url: '<?php echo base_url(); ?>index.php/Packages/ajax_filter_template_masters',
        dataType: 'json',
        delay: 250,
        data: function(params) { return { q: params.term }; },
        processResults: function(data) { return data; },
        cache: true
      }
    });

    // Auto-expand newly added property section
    const collapseEl = $section.find('.accordion-collapse')[0];
    if (collapseEl) {
      const bsCollapse = new bootstrap.Collapse(collapseEl, { toggle: true });
    }

    // Focus name of the option input for better UX
    setTimeout(function() {
      $section.find('input[name^="property_category_name"]').focus();
    }, 300);
  };


  function addAssignmentRow($dayRow, sectionId, dayKey, destId, isFirst, isTravelBack, opts) {
    opts = opts || {};

    var skipLoad = (opts.skipLoad === true);
    var requiredStatus = String(opts.requiredStatus || '0');

    var mustRequire = (!isTravelBack || requiredStatus === '1');
    var requiredAttr = mustRequire ? 'required' : '';

    var $assignments = $dayRow.find('.assignments');
    var rowKey = Date.now() + '_' + Math.floor(Math.random() * 1000);

    var buttonsHtml = '<button type="button" class="btn btn-danger btn-sm remove-assignment">X</button>';

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
    // loadProperties(destId, $a.find('.property-select'));
    if (!skipLoad) {
  loadProperties(destId, $a.find('.property-select'));
}
  }

window.buildSavedPropertyUI = function(propertyData) {

  console.log('buildSavedPropertyUI received propertyData:', JSON.parse(JSON.stringify(propertyData)));

  if (!propertyData || !propertyData.length) return;

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


  $.each(propertyData, function(_, sec) {

    addMore10();

    const $section = $('#property .property-section').last();
    const sectionId = $section.data('section');

    $section.find('input[name^="property_category_name"]').val(
      sec.packages_properties_common_category_name || ''
    );

    const $design = $section.find('select[name^="packages_properties_common_design_type"]');
    $design.val(sec.packages_properties_common_design_type || '').trigger('change.select2');

    $section.find('textarea[name^="packages_properties_common_complimentary_inclusion"]').val(
      sec.packages_properties_common_complimentary_inclusion || ''
    );

    const templateMasterId = sec.packages_properties_common_template_master_id_fk || '';
    console.log('buildSavedPropertyUI: section #' + sectionId + ' templateMasterId=' + templateMasterId);
    $section.find('.template-master-id-hidden').val(templateMasterId);

    if (templateMasterId) {
      const $tmSelect = $section.find('.template-master-select');
      console.log('buildSavedPropertyUI: fetching template master data for id=' + templateMasterId);
      window._suppressTemplateMasterChange = true;
      $.ajax({
        url: '<?php echo base_url(); ?>index.php/Packages/ajax_get_template_master_data/' + templateMasterId,
        type: 'GET',
        dataType: 'json'
      }).done(function(res) {
        console.log('buildSavedPropertyUI: template master AJAX response', res.status, res.data ? 'has data' : 'no data');
        if (res.status && res.data) {
          const master = res.data;
          const option = new Option(master.template_master_category_name || ('Template #' + templateMasterId), templateMasterId, true, true);
          $tmSelect.append(option).val(templateMasterId).trigger('change');
          console.log('buildSavedPropertyUI: template master option appended, val=' + $tmSelect.val());
          $section.data('template-master-data', master);
        }
      }).always(function() {
        window._suppressTemplateMasterChange = false;
      });
    }

    $.each(sec.days || [], function(_, dayObj) {

      const dayKey = String(dayObj.itineraries_days_id_fk || '');
      const destId = String(dayObj.destination_id || '');

      if (!dayKey) return;

      const $dayRow = $section.find('tr.day-row[data-day-id="' + dayKey + '"]');

      if (!$dayRow.length) {
        console.log('Missing day row:', dayKey, dayObj);
        return;
      }

      $dayRow.find('input[name^="property_destination_id"]').val(destId);
      $dayRow.find('.assignments').attr('data-dest-id', destId);

      // remove default empty row
      $dayRow.find('.assignment-row').remove();

      if (!dayObj.properties || !dayObj.properties.length) {
        const isTB = ($dayRow.data('is-tb') == 1);
        const requiredStatus = String($dayRow.data('required-status') || '0');

        addAssignmentRow(
          $dayRow,
          sectionId,
          dayKey,
          destId,
          true,
          isTB,
          {
            skipLoad: true,
            requiredStatus: requiredStatus
          }
        );

        return;
      }

      $.each(dayObj.properties, function(idx, p) {

        const isTB = ($dayRow.data('is-tb') == 1);
        const requiredStatus = String($dayRow.data('required-status') || '0');

        addAssignmentRow(
          $dayRow,
          sectionId,
          dayKey,
          destId,
          idx === 0,
          isTB,
          {
            skipLoad: true,
            requiredStatus: requiredStatus
          }
        );

        const $assign = $dayRow.find('.assignment-row').last();
        const $propSel = $assign.find('.property-select');
        const $roomSel = $assign.find('.rooms-select');

        window._suppressPropertySelectChange = true;
        try {
          setPropertyAndRoomsFromSaved(
            destId,
            $propSel,
            $roomSel,
            p.property_id,
            p.property_name,
            p.rooms
          );
        } finally {
          window._suppressPropertySelectChange = false;
        }
      });
    });
  });

  setTimeout(function() {
    window.isPropertyPrefill = false;
    window.pendingPropertyOpen = false;
  }, 500);
};

function refreshPropertyDestinationNames() {
  loadDestinationMap(function(map) {
    $('#property .property-destination-name').each(function() {
      const $el = $(this);
      const id = String($el.data('dest-id') || '');

      if (id && map[id]) {
        $el.text(map[id]);
      }
    });
  });
}

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

  function renumberPropertySections() {
    $('#property .accordion-item').each(function(index) {
      var newId = index + 1;
      var $item = $(this);
      var oldId = $item.find('.property-section').data('section');
      if (oldId == newId) return;

      $item.find('.accordion-header').attr('id', 'headingProperty' + newId);
      $item.find('.accordion-button')
        .attr('data-bs-target', '#collapseProperty' + newId)
        .attr('aria-controls', 'collapseProperty' + newId);
      $item.find('.property-title-count').text('#' + newId);
      $item.find('.accordion-collapse')
        .attr('id', 'collapseProperty' + newId)
        .attr('aria-labelledby', 'headingProperty' + newId);
      $item.find('.property-section').attr('data-section', newId);

      $item.find('[name]').each(function() {
        var $el = $(this);
        var name = $el.attr('name');
        if (name && name.indexOf('[' + oldId + ']') !== -1) {
          $el.attr('name', name.replace(new RegExp('\\[' + oldId + '\\]', 'g'), '[' + newId + ']'));
        }
      });
    });
  }

  $(document).on('click', '.remove-section', function () {
    const $accordionItem = $(this).closest('.accordion-item');
    $accordionItem.find('.property-section select').each(function(){
      if ($(this).hasClass('select2-hidden-accessible')) {
        $(this).select2('destroy');
      }
    });
    $accordionItem.remove();
    renumberPropertySections();
  });


  $(document).on('change', '.property-select', function () {

    if (window.isPropertyPrefill) return;
    if (window._suppressPropertySelectChange) return;

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

  window.updatePropertySectionsForDay = function(dayId, newDestId, newDestName) {
    if (!dayId) { console.log('updatePropertySectionsForDay: no dayId'); return; }

    var $propertySections = $('#property .property-section');
    console.log('updatePropertySectionsForDay: found', $propertySections.length, 'property sections for dayId=', dayId, 'newDestId=', newDestId, 'newDestName=', newDestName);
    if (!$propertySections.length) return;

    $propertySections.each(function(idx) {
      var $section = $(this);
      var sectionId = $section.data('section');
      var $dayRow = $section.find('tr.day-row[data-day-id="' + dayId + '"]');
      console.log('  section #' + (idx+1) + ' (sectionId=' + sectionId + '): dayRow found=', $dayRow.length);
      if (!$dayRow.length) return;

      // Update destination name and ID
      var $destNameEl = $dayRow.find('.property-destination-name');
      var resolvedName = newDestName || (window.destinationMap && window.destinationMap[newDestId]) || newDestId || '';
      console.log('  -> updating dest name from "' + $destNameEl.text() + '" to "' + resolvedName + '"');
      $destNameEl.text(resolvedName).attr('data-dest-id', newDestId || '');

      $dayRow.find('input[name^="property_destination_id"]')
        .val(newDestId || '');

      // Update assignments div data-dest-id
      $dayRow.find('.assignments').attr('data-dest-id', newDestId || '');

      var $assignments = $dayRow.find('.assignment-row');
      console.log('  -> clearing', $assignments.length, 'assignment rows');

      // Remove all existing assignment rows and re-add fresh ones
      $assignments.each(function() {
        var $a = $(this);
        $a.find('.property-select, .rooms-select').each(function() {
          if ($(this).hasClass('select2-hidden-accessible')) {
            $(this).select2('destroy');
          }
        });
        $a.remove();
      });

      var isTB = ($dayRow.data('is-tb') == 1);
      var requiredStatus = String($dayRow.data('required-status') || '0');

      // Check if section has template master data
      var master = $section.data('template-master-data');
      var matchedDest = null;
      if (master && master.destinations && master.destinations.length && newDestId) {
        for (var i = 0; i < master.destinations.length; i++) {
          if (String(master.destinations[i].state_id) === String(newDestId)) {
            matchedDest = master.destinations[i];
            break;
          }
        }
      }

      if (matchedDest && matchedDest.properties && matchedDest.properties.length) {
        // Add rows from template for each property
        $.each(matchedDest.properties, function(idx, prop) {
          var isFirst = (idx === 0);
          addAssignmentRow($dayRow, sectionId, dayId, newDestId, isFirst, isTB, {
            skipLoad: true,
            requiredStatus: requiredStatus
          });

          var $lastRow = $dayRow.find('.assignment-row').last();
          var $propSel = $lastRow.find('.property-select');
          var $roomsSel = $lastRow.find('.rooms-select');

          window._suppressPropertySelectChange = true;
          try {
            setPropertyAndRoomsFromSaved(
              newDestId,
              $propSel,
              $roomsSel,
              String(prop.property_id),
              prop.property_name,
              $.map(prop.rooms || [], function(r) {
                return { id: String(r.properties_room_category_id), text: r.properties_room_category_name };
              })
            );
          } finally {
            window._suppressPropertySelectChange = false;
          }
        });
      } else {
        // No template match - add one blank row with + Add button
        addAssignmentRow($dayRow, sectionId, dayId, newDestId, true, isTB, {
          skipLoad: false,
          requiredStatus: requiredStatus
        });
      }
    });
  };

  // Template Master select change handler
  $(document).on('change', '.template-master-select', function() {
    if (window.isPropertyPrefill) return;
    if (window._suppressTemplateMasterChange) return;

    var templateId = $(this).val();
    var $section = $(this).closest('.property-section');
    var sectionId = $section.data('section');

    $section.find('.template-master-id-hidden').val(templateId || '');

    if (!templateId) {
      $section.removeData('template-master-data');
      return;
    }

    $.ajax({
      url: '<?php echo base_url(); ?>index.php/Packages/ajax_get_template_master_data/' + templateId,
      type: 'GET',
      dataType: 'json'
    }).done(function(res) {
      if (!res.status || !res.data) return;

      var master = res.data;

      // Store template data on section for destination change re-match
      $section.data('template-master-data', master);

      // Set name of the option
      $section.find('.property-category-name').val(master.template_master_category_name || '');

      // Set design type
      var $design = $section.find('.design-type-select');
      $design.val(master.template_master_design_type || '').trigger('change.select2');

      // Pre-fill each day row
      $section.find('tr.day-row').each(function() {
        var $dayRow = $(this);
        var dayKey = String($dayRow.data('day-id') || '');
        var destId = String($dayRow.find('input[name^="property_destination_id"]').val() || '');
        var isTB = ($dayRow.data('is-tb') == 1);
        var requiredStatus = String($dayRow.data('required-status') || '0');

        // Remove all existing assignment rows
        $dayRow.find('.assignments .assignment-row').each(function() {
          var $a = $(this);
          $a.find('.property-select, .rooms-select').each(function() {
            if ($(this).hasClass('select2-hidden-accessible')) {
              $(this).select2('destroy');
            }
          });
          $a.remove();
        });

        // Find matching template destination
        var matchedDest = null;
        if (master.destinations && master.destinations.length) {
          for (var i = 0; i < master.destinations.length; i++) {
            if (String(master.destinations[i].state_id) === destId) {
              matchedDest = master.destinations[i];
              break;
            }
          }
        }

        if (matchedDest && matchedDest.properties && matchedDest.properties.length) {
          $.each(matchedDest.properties, function(idx, prop) {
            var isFirst = (idx === 0);
            addAssignmentRow($dayRow, sectionId, dayKey, destId, isFirst, isTB, {
              skipLoad: true,
              requiredStatus: requiredStatus
            });

            var $lastRow = $dayRow.find('.assignment-row').last();
            var $propSel = $lastRow.find('.property-select');
            var $roomsSel = $lastRow.find('.rooms-select');

            window._suppressPropertySelectChange = true;
            try {
              setPropertyAndRoomsFromSaved(
                destId,
                $propSel,
                $roomsSel,
                String(prop.property_id),
                prop.property_name,
                $.map(prop.rooms || [], function(r) {
                  return { id: String(r.properties_room_category_id), text: r.properties_room_category_name };
                })
              );
            } finally {
              window._suppressPropertySelectChange = false;
            }
          });
        } else {
          // No match - add one blank row with + Add button
          addAssignmentRow($dayRow, sectionId, dayKey, destId, true, isTB, {
            skipLoad: false,
            requiredStatus: requiredStatus
          });
        }
      });
    });
  });

});

// $(document).on('change', '.property-select', function () {

//   if (window.isPropertyPrefill) return;

//   const selectedId = $(this).val();
//   const $row = $(this).closest('.assignment-row');
//   const $rooms = $row.find('.rooms-select');

//   if ($rooms.hasClass('select2-hidden-accessible')) {
//     $rooms.select2('destroy');
//   }

//   $rooms.empty().prop('disabled', true);

//   if (!selectedId) {
//     $rooms.append('<option value="">Please Select Property First</option>');
//     $rooms.select2({ width:'100%', placeholder:'Please Select Rooms' });
//     return;
//   }

//   loadRooms(selectedId, $rooms);
// });


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

let suppressPropertyClearConfirm = false;

function isPropertiesActiveOrDirty() {
  return $('#packages_property_type').is(':checked') || $('#property').children().length > 0;
}

function bindPrevValueTracker(selector) {
  $(document).on('focus', selector, function () {
    const $el = $(this);
    $el.data('prev', $el.val());
    const $row = $el.closest('tr');
    $el.data('prev-name', $row.find('.active-destination-name').val() || $row.find('.stay-destination-text').text() || '');
  });

  $(document).on('select2:opening', selector, function () {
    const $el = $(this);
    $el.data('prev', $el.val());
    const $row = $el.closest('tr');
    $el.data('prev-name', $row.find('.active-destination-name').val() || $row.find('.stay-destination-text').text() || '');
  });
}

bindPrevValueTracker('#packages_itinerary_id_fk');
bindPrevValueTracker('.change_destination');

let skipItineraryChange = false;

window.isDuplicateLoading = false;

$(document).on('change', '#packages_itinerary_id_fk', function () {

  // skip during reset / close / save / edit / duplicate loading
  if (suppressPropertyClearConfirm || window.isEditLoading || window.isDuplicateLoading) {
    return;
  }

  if (skipItineraryChange) {
    skipItineraryChange = false;
    return;
  }

  const $sel = $(this);
  const prev = $sel.data('prev');
  const now  = $sel.val();

  if (prev == now) return;

  if (isPropertiesActiveOrDirty()) {

    var hasTemplateMaster = false;
    $('#property .property-section').each(function() {
      var master = $(this).data('template-master-data');
      if (master && master.destinations) {
        hasTemplateMaster = true;
        return false;
      }
    });

    console.log('itinerary change: hasTemplateMaster=', hasTemplateMaster);

    if (!hasTemplateMaster) {
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

  // Clearing is handled directly in the first change handler — no confirm needed
  if (!now) return;

  if (isPropertiesActiveOrDirty()) {

    const ok = confirm('Changing destination will update properties for this day. Continue?');

    if (!ok) {
      skipDestinationChange = true;
      let prevName = $sel.data('prev-name') || '';
      if (!prevName && prev && window.destinationMap && window.destinationMap[prev]) {
        prevName = window.destinationMap[prev];
      }
      if (!prevName) prevName = prev;
      const $row = $sel.closest('tr');

      $sel.val(prev);

      // Revert displayed destination column and hidden fields immediately
      $row.find('.active-destination-id').val(prev);
      $row.find('.active-destination-name').val(prevName);
      $row.find('.destination-post').val(prev);
      $row.find('.stay-destination-text').text(prevName);

      $sel.data('skip-destination-update', true);
      if ($sel.hasClass('select2-hidden-accessible')) {
        $sel.trigger('change.select2');
      } else {
        $sel.trigger('change');
      }

      // Ensure flags are reset if the re-triggered event didn't consume them,
      // so the next real destination change shows the confirmation again.
      skipDestinationChange = false;
      $sel.removeData('skip-destination-update');
      return;
    }

    var dayId = $sel.closest('tr').find('input[name="itineraries_days_id_fk[]"]').val() || '';
    var selData = $sel.select2('data');
    var destName = (selData[0] && selData[0].text) ? selData[0].text : '';
    console.log('Handler2: confirmed destination change, dayId=', dayId, 'now=', now, 'destName=', destName);
    if (dayId && typeof updatePropertySectionsForDay === 'function') {
      updatePropertySectionsForDay(dayId, now, destName);
    } else {
      console.log('Handler2: NOT calling updatePropertySectionsForDay (dayId=' + dayId + ', function exists=' + (typeof updatePropertySectionsForDay === 'function') + ')');
    }
  } else {
    console.log('Handler2: isPropertiesActiveOrDirty returned false');
  }
});
////***For properties blocks when change destination or change itinerary *****///

// Allowed extensions
// const allowedImageExt = ['jpg', 'jpeg', 'png'];

// $(document).on('change', '.day-image-input', function () {

//   const file = this.files[0];
//   if (!file) return;

//   const fileName = file.name.toLowerCase();
//   const extension = fileName.split('.').pop();

//   if ($.inArray(extension, allowedImageExt) === -1) {

//     alert('Only JPG, JPEG and PNG files are allowed.');

//     // Clear invalid file
//     $(this).val('');

//     return false;
//   }
// });

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

                        