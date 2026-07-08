<script>

var save_method;
var table;
var destCounter = 0;

$(document).ready(function() {

    $table = $('#Template_master_table').DataTable({
        "processing": true,
        "serverSide": true,
        "searching": true,
        "aLengthMenu": [[10, 25, 50, -1], [10, 25, 50, "All"]],
        dom: 'lBfrtip',
        buttons: [
            {
                extend: 'excel',
                exportOptions: { columns: [0, 1, 2] },
                title: 'Template Master Details'
            },
            {
                extend: 'pdf',
                exportOptions: { columns: [0, 1, 2] },
                title: 'Template Master Details'
            },
            {
                extend: 'print',
                exportOptions: { columns: [0, 1, 2] },
                title: 'Template Master Details'
            }
        ],
        "ajax": {
            "url": "<?php echo base_url();?>index.php/Template_master/get/",
            "type": "POST"
        },
        "createdRow": function (row, data, index) {
            $table.column(0).nodes().each(function(node,index,dt){
                $table.cell(node).data(index+1);
            });

            let actionHtml = '<div class="d-flex">';
            if (hasPermission('TEMPLATE_MASTER_UPDATE')) {
                actionHtml += '<a href="javascript:void(0)" onclick="edit_template_master('+data['template_master_id']+')" class="btn btn-primary shadow btn-xs sharp me-1"><i class="fas fa-pencil-alt"></i></a>';
            }
            if (hasPermission('TEMPLATE_MASTER_DELETE')) {
                actionHtml += '<a href="javascript:void(0)" onclick="return delete_template_master('+data['template_master_id']+')" class="btn btn-danger shadow btn-xs sharp"><i class="fa fa-trash"></i></a>';
            }
            actionHtml += '</div>';

            $('td', row).eq(3).html(actionHtml);
        },
        "columns": [
            { "data": "template_master_status", "orderable": false },
            { "data": "template_master_category_name", "orderable": false },
            { "data": "template_master_design_type", "orderable": false },
            { "data": "template_master_id", "orderable": false }
        ]
    });

});

function templateMasterModalClose()
{
    $('#TemplateMasterModal').modal('hide');
    $('#template_master_category_name').val('');
    $('#template_master_design_type').val('');
    $('#category_name_alert').hide();
    $('.submit').removeAttr('disabled');
    $('.form-group').removeClass('input-success-o');
    $('.form-group').removeClass('input-warning-o');
    $('.template_master_category_name').removeClass('input-success-o');
    $('.template_master_category_name').removeClass('input-warning-o');
    $('.template_master_design_type').removeClass('input-success-o');
    $('.template_master_design_type').removeClass('input-warning-o');
    $('#destinations_container').empty();
    destCounter = 0;
}

$('#TemplateMasterModal').on('shown.bs.modal', function () {
    $('#template_master_category_name').focus();
    $('#category_name_alert').hide();
    $('.form-group').removeClass('input-success-o');
    $('.form-group').removeClass('input-warning-o');
    $('.template_master_category_name').removeClass('input-success-o');
    $('.template_master_category_name').removeClass('input-warning-o');
    $('.template_master_design_type').removeClass('input-success-o');
    $('.template_master_design_type').removeClass('input-warning-o');
});

function add_template_master()
{
    save_method = 'add';
    $("#id").val('');
    $('#form')[0].reset();
    $('.form-group').removeClass('input-warning-o');
    $('.help-block').empty();
    $('#destinations_container').empty();
    destCounter = 0;
    $('#TemplateMasterModal').modal('show');
    $('.modal-title').text('Add Template Master');
    $('#btnSave').text('Save');
}

function edit_template_master(id)
{
    save_method = 'update';
    $('#form')[0].reset();
    $('.form-group').removeClass('input-warning-o');
    $('.help-block').empty();
    $('#destinations_container').empty();
    destCounter = 0;

    $.ajax({
        url : "<?php echo base_url();?>index.php/Template_master/ajax_edit/" + id,
        type: "GET",
        dataType: "JSON",
        success: function(data)
        {
            $('[name="id"]').val(data.template_master_id);
            $('[name="template_master_category_name"]').val(data.template_master_category_name);
            $('[name="template_master_design_type"]').val(data.template_master_design_type);

            if (data.destinations && data.destinations.length) {
                data.destinations.forEach(function(dest) {
                    addDestinationFromData(dest);
                });
            }

            $('#TemplateMasterModal').modal('show');
            $('.modal-title').text('Edit Template Master');
            $('#btnSave').text('Update');
        },
        error: function (jqXHR, textStatus, errorThrown)
        {
            alert('Error getting data from ajax');
        }
    });
}

function reload_table()
{
    $table.ajax.reload(null,false);
    var id = $("#id").val();
    if(id) {
        var ff = "Template Master updated successfully";
        $("#vehicle_update").val(ff);
        var options = {
            'title': '',
            'style': 'success',
            'message': ff,
            'icon': 'fas fa-check',
        };
        var n1 = new notify(options);
        n1.show();
        setTimeout(function(){ n1.hide(); }, 10000);
    } else {
        var ff = "Template Master added successfully";
        $("#vehicle_add").val(ff);
        var options = {
            'title': '',
            'style': 'success',
            'message': ff,
            'icon': 'fas fa-check',
        };
        var n1 = new notify(options);
        n1.show();
        setTimeout(function(){ n1.hide(); }, 10000);
    }
}

function validateTemplateMaster() {
    var valid = true;
    var firstErrorEl = null;

    // Clear all previous errors
    $('.help-block').text('');
    $('.form-group').removeClass('input-warning-o');
    $('.destination-block .flex-grow-1').removeClass('input-warning-o');
    $('.destination-block').removeClass('input-warning-o');
    $('#destinations_container > .dest-error').remove();

    // Category Name
    if ($('#template_master_category_name').val().trim() == '') {
        $('#template_master_category_name').next('.help-block').text('Category name is required');
        $('#template_master_category_name').closest('.form-group').addClass('input-warning-o');
        if (!firstErrorEl) firstErrorEl = $('#template_master_category_name');
        valid = false;
    }

    // Design Type
    if ($('#template_master_design_type').val() == '') {
        $('#template_master_design_type').next('.help-block').text('Design type is required');
        $('#template_master_design_type').closest('.form-group').addClass('input-warning-o');
        if (!firstErrorEl) firstErrorEl = $('#template_master_design_type');
        valid = false;
    }

    // Destinations
    var $destBlocks = $('#destinations_container .destination-block');
    if ($destBlocks.length == 0) {
        $('#destinations_container').prepend('<div class="dest-error mb-1"><span class="help-block" style="color:red">At least one destination is required</span></div>');
        valid = false;
    }

    // Check for duplicate destinations across all blocks
    var destVals = [];
    $destBlocks.each(function() {
        destVals.push($(this).find('.destination-select').val());
    });
    $destBlocks.each(function() {
        var $destSelect = $(this).find('.destination-select');
        var val = $destSelect.val();
        if (val) {
            var count = 0;
            for (var i = 0; i < destVals.length; i++) {
                if (destVals[i] == val) count++;
            }
            if (count > 1) {
                $destSelect.parent().find('.help-block').text('This destination is already selected');
                $destSelect.closest('.form-group').addClass('input-warning-o');
                if (!firstErrorEl) firstErrorEl = $destSelect;
                valid = false;
            }
        }
    });

    $destBlocks.each(function() {
        var $block = $(this);
        var destNum = $block.find('.dest-number').text();

        // Destination (state) select
        var $destSelect = $block.find('.destination-select');
        if (!$destSelect.val()) {
            $destSelect.parent().find('.help-block').text('Please select a destination');
            $destSelect.closest('.form-group').addClass('input-warning-o');
            if (!firstErrorEl) firstErrorEl = $destSelect;
            valid = false;
            return false; // break each
        }

        // Property & Room assignments
        var $assignments = $block.find('.assignment-row');
        if ($assignments.length == 0) {
            $block.append('<div class="assign-error mt-1"><span class="help-block" style="color:red">At least one property & room is required</span></div>');
            if (!firstErrorEl) firstErrorEl = $block;
            valid = false;
            return false;
        }

        // Check for duplicate properties within same destination
        var propVals = [];
        $assignments.each(function() {
            propVals.push($(this).find('.property-select').val());
        });
        $assignments.each(function() {
            var $prop = $(this).find('.property-select');
            var pval = $prop.val();
            if (pval) {
                var count = 0;
                for (var i = 0; i < propVals.length; i++) {
                    if (propVals[i] == pval) count++;
                }
                if (count > 1) {
                    $prop.parent().find('.help-block').text('This property is already selected in this destination');
                    $prop.closest('.flex-grow-1').addClass('input-warning-o');
                    if (!firstErrorEl) firstErrorEl = $prop;
                    valid = false;
                }
            }
        });

        $assignments.each(function() {
            var $row = $(this);
            var $prop = $row.find('.property-select');
            var $room = $row.find('.room-select');

            if (!$prop.val()) {
                $prop.parent().find('.help-block').text('Please select a property');
                $prop.closest('.flex-grow-1').addClass('input-warning-o');
                if (!firstErrorEl) firstErrorEl = $prop;
                valid = false;
                return false;
            }

            var roomVal = $room.val();
            if (!roomVal || (Array.isArray(roomVal) && roomVal.length == 0)) {
                $room.parent().find('.help-block').text('Please select at least one room');
                $room.closest('.flex-grow-1').addClass('input-warning-o');
                if (!firstErrorEl) firstErrorEl = $room;
                valid = false;
                return false;
            }
        });
    });

    if (!valid && firstErrorEl && firstErrorEl.length) {
        var $modalBody = $('#TemplateMasterModal').find('.modal-body');
        var scrollTo = firstErrorEl.position().top + $modalBody.scrollTop() - 100;
        $modalBody.animate({ scrollTop: scrollTo }, 300);
    }

    return valid;
}

function save()
{
    if (!validateTemplateMaster()) {
        $('#btnSave').text('Save');
        $('#btnSave').attr('disabled', false);
        return false;
    }

    var url;
    if(save_method == 'add') {
        $("#id").val('');
        $('#btnSave').text('Saving...');
        $('#btnSave').attr('disabled',true);
        url = "<?php echo base_url();?>index.php/Template_master/ajax_add/";
    } else {
        $('#btnSave').text('Updating...');
        $('#btnSave').attr('disabled',true);
        url = "<?php echo base_url();?>index.php/Template_master/ajax_update/";
    }

    var form = document.getElementById('form');
    var data = new FormData(form);
    $.ajax({
        url : url,
        type: "POST",
        data: data,
        dataType: "JSON",
        processData: false,
        enctype: 'multipart/form-data',
        contentType: false,
        success: function(data)
        {
            if(data.status) {
                $('#TemplateMasterModal').modal('hide');
                reload_table();
            } else {
                for (var i = 0; i < data.inputerror.length; i++) {
                    $('[name="'+data.inputerror[i]+'"]').parent().parent().addClass('input-warning-o');
                    $('[name="'+data.inputerror[i]+'"]').next().text(data.error_string[i]);
                }
            }
            $('#btnSave').text('Save');
            $('#btnSave').attr('disabled',false);
            $('.help-block').val('hide');
        },
        error: function (jqXHR, textStatus, errorThrown)
        {
            alert('Error adding / updating data');
            $('#btnSave').text('Save');
            $('#btnSave').attr('disabled',false);
        }
    });
}

function reload_table_delete()
{
    $table.ajax.reload(null,false);
    var ff = "Template Master deleted successfully";
    $("#roles_delete").val(ff);
    var options = {
        'title': '',
        'style': 'success',
        'message': ff,
        'icon': 'fas fa-check',
    };
    var n1 = new notify(options);
    n1.show();
    setTimeout(function(){ n1.hide(); }, 10000);
}

function delete_template_master(id)
{
    $.ajax({
        url : "<?php echo base_url();?>index.php/Template_master/ajax_edit/" + id,
        type: "GET",
        dataType: "JSON",
        success: function(data)
        {
            $('[name="id"]').val(data.template_master_id);
            $('#deleterowModal').modal('show');
            $('.modal-title1').text('Do you want to delete this record?');
            $('#btnSave1').text('Delete');
            $('#btnSave1').attr('disabled',false);
        },
        error: function (jqXHR, textStatus, errorThrown)
        {
            alert('Error getting data from ajax');
        }
    });
}

function delete_template_master_action()
{
    $('#btnSave1').text('Deleting...');
    $('#btnSave1').attr('disabled',true);
    var url = "<?php echo base_url();?>index.php/Template_master/delete/";

    $.ajax({
        url : url,
        type: "POST",
        data: $('#form1').serialize(),
        dataType: "JSON",
        success: function(data)
        {
            if(data.status) {
                $("#id").val('');
                $('#deleterowModal').modal('hide');
                reload_table_delete();
                $('body').removeClass('modal-open');
                $('.modal-backdrop').remove();
            } else {
                for (var i = 0; i < data.inputerror.length; i++) {
                    $('[name="'+data.inputerror[i]+'"]').parent().parent().addClass('has-error');
                    $('[name="'+data.inputerror[i]+'"]').next().text(data.error_string[i]);
                }
            }
            $('#btnSave1').text('Delete');
            $('#btnSave1').attr('disabled',false);
        },
        error: function (jqXHR, textStatus, errorThrown)
        {
            alert('Error deleting data');
            $('#btnSave1').text('Delete');
            $('#btnSave1').attr('disabled',false);
        }
    });
}

var _skipDupCheck = false;

function checkDuplicateDestinations($changed) {
    $changed.parent().find('.help-block').text('');
    $changed.closest('.form-group').removeClass('input-warning-o');
    var val = $changed.val();
    if (!val || val == '') return;
    var dup = false;
    $('#destinations_container .destination-block').each(function() {
        var $sel = $(this).find('.destination-select');
        if ($sel[0] !== $changed[0] && $sel.val() == val) {
            dup = true;
        }
    });
    if (dup) {
        $changed.parent().find('.help-block').text('This destination is already selected');
        $changed.closest('.form-group').addClass('input-warning-o');
        _skipDupCheck = true;
        $changed.val('').trigger('change');
        _skipDupCheck = false;
    }
}

function checkDuplicateProperties($block, $changed) {
    $changed.parent().find('.help-block').text('');
    $changed.closest('.flex-grow-1').removeClass('input-warning-o');
    var val = $changed.val();
    if (!val || val == '') return;
    var dup = false;
    $block.find('.assignment-row').each(function() {
        var $prop = $(this).find('.property-select');
        if ($prop[0] !== $changed[0] && $prop.val() == val) {
            dup = true;
        }
    });
    if (dup) {
        $changed.parent().find('.help-block').text('This property is already selected in this destination');
        $changed.closest('.flex-grow-1').addClass('input-warning-o');
        _skipDupCheck = true;
        $changed.val('').trigger('change');
        _skipDupCheck = false;
    }
}

function addDestination() {
    $('#destinations_container > .dest-error').remove();
    var idx = destCounter++;
    var html = $('#destination_template').html();
    html = html.replace(/__DEST_IDX__/g, idx);
    $('#destinations_container').append(html);

    var $block = $('#destinations_container').children().last();
    initDestinationSelect($block.find('.destination-select'));

    $block.find('.destination-select').on('change', function() {
        if (_skipDupCheck) return;
        $(this).parent().find('.help-block').text('');
        $(this).closest('.form-group').removeClass('input-warning-o');
        checkDuplicateDestinations($(this));
        var stateId = $(this).val();
        $block.find('.property-select').each(function() {
            var $prop = $(this);
            if ($prop.hasClass('select2-hidden-accessible')) {
                $prop.select2('destroy');
            }
            $prop.empty().append('<option value="">Select Property</option>');
            var $room = $prop.closest('.assignment-row').find('.room-select');
            if ($room.hasClass('select2-hidden-accessible')) {
                $room.select2('destroy');
            }
            $room.empty();
            $room.select2({
                width: '100%',
                placeholder: 'Select Property First',
                dropdownParent: $('#TemplateMasterModal')
            });
            if (stateId) {
                initPropertySelect($prop, stateId);
            } else {
                $prop.select2({
                    width: '100%',
                    placeholder: 'Select Destination First',
                    dropdownParent: $('#TemplateMasterModal')
                });
            }
        });
    });

    renumberDestinations();
}

function addDestinationFromData(dest) {
    $('#destinations_container > .dest-error').remove();
    var idx = destCounter++;
    var html = $('#destination_template').html();
    html = html.replace(/__DEST_IDX__/g, idx);
    $('#destinations_container').append(html);

    var $block = $('#destinations_container').children().last();
    initDestinationSelect($block.find('.destination-select'));

    if (dest.state_id) {
        var $state = $block.find('.destination-select');
        $state.append(new Option(dest.state_name || dest.state_id, dest.state_id, true, true)).trigger('change');
    }

    $block.find('.destination-select').on('change', function() {
        if (_skipDupCheck) return;
        $(this).parent().find('.help-block').text('');
        $(this).closest('.form-group').removeClass('input-warning-o');
        checkDuplicateDestinations($(this));
        var stateId = $(this).val();
        $block.find('.property-select').each(function() {
            var $prop = $(this);
            if ($prop.hasClass('select2-hidden-accessible')) {
                $prop.select2('destroy');
            }
            $prop.empty().append('<option value="">Select Property</option>');
            var $room = $prop.closest('.assignment-row').find('.room-select');
            if ($room.hasClass('select2-hidden-accessible')) {
                $room.select2('destroy');
            }
            $room.empty();
            $room.select2({
                width: '100%',
                placeholder: 'Select Property First',
                dropdownParent: $('#TemplateMasterModal')
            });
            if (stateId) {
                initPropertySelect($prop, stateId);
            } else {
                $prop.select2({
                    width: '100%',
                    placeholder: 'Select Destination First',
                    dropdownParent: $('#TemplateMasterModal')
                });
            }
        });
    });

    if (dest.properties && dest.properties.length) {
        dest.properties.forEach(function(prop) {
            addAssignmentFromData($block, prop, prop.rooms || []);
        });
    }

    renumberDestinations();
}

function removeDestination(btn) {
    $(btn).closest('.destination-block').remove();
    renumberDestinations();
}

function renumberDestinations() {
    $('#destinations_container .destination-block').each(function(i) {
        $(this).find('.dest-number').text(i + 1);
    });
}

function addAssignment(btn) {
    var $destBlock = $(btn).closest('.destination-block');
    $destBlock.find('.assign-error').remove();
    var destIdx = $destBlock.data('dest-idx');
    var stateId = $destBlock.find('.destination-select').val();
    var propIdx = Date.now();

    var html = $('#assignment_template').html();
    html = html.replace(/__DEST_IDX__/g, destIdx).replace(/__PROP_IDX__/g, propIdx);
    var $row = $(html);
    $destBlock.find('.assignments-container').append($row);

    var $propSelect = $row.find('.property-select');
    var $roomSelect = $row.find('.room-select');

    if (stateId) {
        initPropertySelect($propSelect, stateId);
    } else {
        $propSelect.select2({
            width: '100%',
            placeholder: 'Select Destination First',
            dropdownParent: $('#TemplateMasterModal')
        });
    }

    $roomSelect.select2({
        width: '100%',
        placeholder: 'Select Property First',
        dropdownParent: $('#TemplateMasterModal')
    });

    $propSelect.on('change', function() {
        if (_skipDupCheck) return;
        $(this).parent().find('.help-block').text('');
        $(this).closest('.flex-grow-1').removeClass('input-warning-o');
        $roomSelect.parent().find('.help-block').text('');
        $roomSelect.closest('.flex-grow-1').removeClass('input-warning-o');
        checkDuplicateProperties($destBlock, $(this));
        var propId = $(this).val();
        if ($roomSelect.hasClass('select2-hidden-accessible')) {
            $roomSelect.select2('destroy');
        }
        $roomSelect.empty().prop('disabled', false);
        if (propId) {
            initRoomSelect($roomSelect, propId);
        } else {
            $roomSelect.select2({
                width: '100%',
                placeholder: 'Select Property First',
                dropdownParent: $('#TemplateMasterModal')
            });
        }
    });
}

function addAssignmentFromData($destBlock, propData, roomList) {
    $destBlock.find('.assign-error').remove();
    var destIdx = $destBlock.data('dest-idx');
    var stateId = $destBlock.find('.destination-select').val();
    var propIdx = Date.now();

    var html = $('#assignment_template').html();
    html = html.replace(/__DEST_IDX__/g, destIdx).replace(/__PROP_IDX__/g, propIdx);
    var $row = $(html);
    $destBlock.find('.assignments-container').append($row);

    var $propSelect = $row.find('.property-select');
    var $roomSelect = $row.find('.room-select');

    if (stateId && propData.property_id) {
        $propSelect.append(new Option(propData.property_name || propData.property_id, propData.property_id, true, true));
        initPropertySelect($propSelect, stateId);
    } else {
        $propSelect.select2({
            width: '100%',
            placeholder: 'Select Destination First',
            dropdownParent: $('#TemplateMasterModal')
        });
    }

    if (propData.property_id && roomList.length) {
        roomList.forEach(function(r) {
            var rid = String(r.properties_room_category_id || r.room_id || r.id || '');
            var rname = r.properties_room_category_name || r.room_name || 'Room ' + rid;
            if (rid) {
                $roomSelect.append(new Option(rname, rid, false, false));
            }
        });
        initRoomSelect($roomSelect, propData.property_id);
        var roomIds = roomList.map(function(r) { return String(r.properties_room_category_id || r.room_id || r.id || ''); }).filter(Boolean);
        $roomSelect.val(roomIds).trigger('change');
    } else {
        $roomSelect.select2({
            width: '100%',
            placeholder: 'Select Property First',
            dropdownParent: $('#TemplateMasterModal')
        });
    }

    $propSelect.on('change', function() {
        if (_skipDupCheck) return;
        $(this).parent().find('.help-block').text('');
        $(this).closest('.flex-grow-1').removeClass('input-warning-o');
        $roomSelect.parent().find('.help-block').text('');
        $roomSelect.closest('.flex-grow-1').removeClass('input-warning-o');
        checkDuplicateProperties($destBlock, $(this));
        var propId = $(this).val();
        if ($roomSelect.hasClass('select2-hidden-accessible')) {
            $roomSelect.select2('destroy');
        }
        $roomSelect.empty().prop('disabled', false);
        if (propId) {
            initRoomSelect($roomSelect, propId);
        } else {
            $roomSelect.select2({
                width: '100%',
                placeholder: 'Select Property First',
                dropdownParent: $('#TemplateMasterModal')
            });
        }
    });
}

function removeAssignment(btn) {
    $(btn).closest('.assignment-row').remove();
}

function initDestinationSelect($select) {
    $select.select2({
        width: '100%',
        placeholder: 'Select Destination',
        allowClear: true,
        dropdownParent: $('#TemplateMasterModal'),
        ajax: {
            url: '<?php echo base_url(); ?>index.php/Template_master/ajax_get_states',
            dataType: 'json',
            delay: 250,
            data: function(params) {
                return { q: params.term };
            },
            processResults: function(data) {
                return data;
            },
            cache: true
        }
    });
}

function initPropertySelect($select, stateId) {
    $select.select2({
        width: '100%',
        placeholder: 'Select Property',
        allowClear: true,
        dropdownParent: $('#TemplateMasterModal'),
        ajax: {
            url: '<?php echo base_url(); ?>index.php/Template_master/ajax_get_properties',
            dataType: 'json',
            delay: 250,
            data: function(params) {
                return { q: params.term, state_id: stateId };
            },
            processResults: function(data) {
                return data;
            },
            cache: true
        }
    });
}

$(document).on('input', '#template_master_category_name', function() {
    $(this).next('.help-block').text('');
    $(this).closest('.form-group').removeClass('input-warning-o');
});

$(document).on('change', '#template_master_design_type', function() {
    $(this).next('.help-block').text('');
    $(this).closest('.form-group').removeClass('input-warning-o');
});

$(document).on('change', '.room-select', function() {
    $(this).parent().find('.help-block').text('');
    $(this).closest('.flex-grow-1').removeClass('input-warning-o');
});

$(document).on('select2:open', '#TemplateMasterModal select', function() {
    setTimeout(function() {
        var $search = $('.select2-container--open .select2-search__field');
        if ($search.length) {
            $search[0].focus();
        }
    }, 0);
});

function initRoomSelect($select, propertyId) {
    $select.select2({
        width: '100%',
        placeholder: 'Select Room',
        allowClear: true,
        dropdownParent: $('#TemplateMasterModal'),
        ajax: {
            url: '<?php echo base_url(); ?>index.php/Template_master/ajax_get_rooms',
            dataType: 'json',
            delay: 250,
            data: function(params) {
                return { q: params.term, property_id: propertyId };
            },
            processResults: function(data) {
                return data;
            },
            cache: true
        }
    });
}

$("#template_master_category_name").on("input", function(e) {
    var category_name = $("#template_master_category_name").val();
    var id = $("#id").val();
    if(id) {
        if(category_name) {
            $.ajax({
                url:"<?php echo base_url()?>index.php/Template_master/checkEdit_category_name",
                type: 'POST',
                data: {value:category_name, id:id},
                dataType: 'json',
                success: function(data)
                {
                    if(data) {
                        $("#category_name_alert").html("Category name already exists");
                        $("#category_name_alert").show();
                        $('#template_master_category_name').val('');
                        $('#template_master_category_name').focus();
                        $('#btnSave').attr("disabled", "disabled");
                        $('.template_master_category_name').removeClass('input-success-o').addClass('input-warning-o');
                    } else {
                        $('#btnSave').removeAttr('disabled');
                        $("#category_name_alert").hide();
                        $('.template_master_category_name').removeClass('input-warning-o').addClass('input-success-o');
                    }
                },
                error:function(e) {
                    console.log("error");
                }
            });
        }
    } else {
        if(category_name) {
            $.ajax({
                url:"<?php echo base_url()?>index.php/Template_master/check_category_name",
                type: 'POST',
                data: {value:category_name},
                dataType: 'json',
                success: function(data)
                {
                    if(data) {
                        $("#category_name_alert").html("Category name already exists");
                        $("#category_name_alert").show();
                        $('#template_master_category_name').val('');
                        $('#template_master_category_name').focus();
                        $('#btnSave').attr("disabled", "disabled");
                        $('.template_master_category_name').removeClass('input-success-o').addClass('input-warning-o');
                    } else {
                        $('#btnSave').removeAttr('disabled');
                        $("#category_name_alert").hide();
                        $('.template_master_category_name').removeClass('input-warning-o').addClass('input-success-o');
                    }
                },
                error:function(e) {
                    console.log("error");
                }
            });
        }
    }
});

</script>
