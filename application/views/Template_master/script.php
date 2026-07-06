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

function save()
{
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

function addDestination() {
    var idx = destCounter++;
    var html = $('#destination_template').html();
    html = html.replace(/__DEST_IDX__/g, idx);
    $('#destinations_container').append(html);

    var $block = $('#destinations_container').children().last();
    initStateSelect($block.find('.state-select'));

    $block.find('.state-select').on('change', function() {
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
            $room.empty().prop('disabled', true);
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
                    placeholder: 'Select State First',
                    dropdownParent: $('#TemplateMasterModal')
                });
            }
        });
    });

    renumberDestinations();
}

function addDestinationFromData(dest) {
    var idx = destCounter++;
    var html = $('#destination_template').html();
    html = html.replace(/__DEST_IDX__/g, idx);
    $('#destinations_container').append(html);

    var $block = $('#destinations_container').children().last();
    initStateSelect($block.find('.state-select'));

    if (dest.state_id) {
        var $state = $block.find('.state-select');
        $state.append(new Option(dest.state_name || dest.state_id, dest.state_id, true, true)).trigger('change');
    }

    $block.find('.state-select').on('change', function() {
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
            $room.empty().prop('disabled', true);
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
                    placeholder: 'Select State First',
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
    var destIdx = $destBlock.data('dest-idx');
    var stateId = $destBlock.find('.state-select').val();
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
            placeholder: 'Select State First',
            dropdownParent: $('#TemplateMasterModal')
        });
    }

    $roomSelect.select2({
        width: '100%',
        placeholder: 'Select Property First',
        dropdownParent: $('#TemplateMasterModal')
    });

    $propSelect.on('change', function() {
        var propId = $(this).val();
        if ($roomSelect.hasClass('select2-hidden-accessible')) {
            $roomSelect.select2('destroy');
        }
        $roomSelect.empty();
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
    var destIdx = $destBlock.data('dest-idx');
    var stateId = $destBlock.find('.state-select').val();
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
            placeholder: 'Select State First',
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
        var propId = $(this).val();
        if ($roomSelect.hasClass('select2-hidden-accessible')) {
            $roomSelect.select2('destroy');
        }
        $roomSelect.empty();
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

function initStateSelect($select) {
    $select.select2({
        width: '100%',
        placeholder: 'Select State',
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
