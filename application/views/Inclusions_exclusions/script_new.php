<script>

var save_method;
var table;
var counter = 0;

/* ============================================
   DATATABLE
============================================ */
$(document).ready(function () {

     table = $('#Inclusions_exclusions_table').DataTable({

        "processing": true,
        "serverSide": true,
        "searching": false,
        "aLengthMenu": [
            [10, 25, 50, -1],
            [10, 25, 50, "All"]
        ],

        dom: 'lBfrtip',

        buttons: [
            {
                extend: 'excel',
                exportOptions: {
                    columns: [0, 1, 2]
                }
            },
            {
                extend: 'pdf',
                exportOptions: {
                    columns: [0, 1, 2]
                }
            },
            {
                extend: 'print',
                exportOptions: {
                    columns: [0, 1, 2]
                }
            }
        ],

        /* ============================================
           AJAX
        ============================================ */
        "ajax": {
            "url": "<?php echo base_url();?>index.php/Inclusions_exclusions/get/",
            "type": "POST",
            "data": function (d) {
                d.inclusion_exclusion_common_id = $("#inclusion_exclusion_common_id").val();
                d.inclusion_exclusion_common_createdby_user_id = $("#inclusion_exclusion_common_createdby_user_id").val();
                /* SEARCH FILTER */
                d.inclusion_exclusion_common_title_filter = $("#inclusion_exclusion_common_title_filter").val();
            }
        },

        /* ============================================
           COLUMN DEFINITIONS
        ============================================ */
        "columns": [

            /* SERIAL NUMBER */
            {
                "data": null,
                "orderable": false
            },

            /* POLICY NAME */
            {
                "data": "inclusion_exclusion_common_title",
                "orderable": false
            },

            /* CREATED BY */
            {
                "data": "inclusion_exclusion_common_createdby_user_name",
                "orderable": false
            },

            /* ACTION BUTTONS */
            {
                "data": null,
                "orderable": false
            }
        ],

        /* ============================================
           ROW CUSTOMIZATION
        ============================================ */
        "createdRow": function (row, data, dataIndex) {

            /* SERIAL NUMBER */
            $('td', row).eq(0).html(dataIndex + 1);

            /* STATUS BADGE (Optional if status needed)
               Uncomment if you want status display
            */
            /*
            let statusBadge = data.payment_policies_status == 1
                ? '<span class="badge bg-success">Active</span>'
                : '<span class="badge bg-danger">Inactive</span>';

            $('td', row).eq(1).html(statusBadge);
            */

            /* ACTION BUTTONS */
            $('td', row).eq(3).html(`
                <div class="d-flex">
                    
                    <a href="javascript:void(0)"
                       onclick="edit_include_exclude(${data.inclusion_exclusion_common_id})"
                       class="btn btn-primary shadow btn-xs sharp me-1">
                        <i class="fas fa-pencil-alt"></i>
                    </a>

                    <a href="javascript:void(0)"
                       onclick="return delete_include_exclude(${data.inclusion_exclusion_common_id})"
                       class="btn btn-danger shadow btn-xs sharp">
                        <i class="fa fa-trash"></i>
                    </a>

                </div>
            `);
        },

        /* ============================================
           SERIAL NUMBER FIX FOR PAGINATION
        ============================================ */
        "drawCallback": function (settings) {

            var api = this.api();

            api.column(0, { page: 'current' }).nodes().each(function (cell, i) {

                cell.innerHTML = settings._iDisplayStart + i + 1;

            });
        }

    });

    $("#add_more_btn_inclusion").click(function () {
        addNewRowInc();
    });
    $("#add_more_btn_exclusion").click(function () {
        addNewRowExc();
    });
});


/* ============================================
   SEARCH BUTTON
============================================ */
function search_inclusion_exclusion()
{
    if (table) {
        table.ajax.reload(null, true);
    }
}


/* ============================================
   RESET BUTTON
============================================ */
function reset_filters()
{
    /* CLEAR FILTERS */
    $("#inclusion_exclusion_common_title_filter").val('');
    $("#inclusion_exclusion_common_id").val('');
    $("#payment_policies_createdby_user_id").val('');

    /* RELOAD FULL TABLE */
    if (table) {
        table.ajax.reload(null, true);
    }

    /* OPTIONAL FLASH */
    $("#flash_message").html(`
        <div class="alert alert-info alert-dismissible fade show" role="alert">
            Filters reset successfully
            <button type="button" class="btn-close" data-bs-dismiss="alert"></button>
        </div>
    `);

    setTimeout(function () {
        $("#flash_message .alert").fadeOut('slow');
    }, 3000);
}


/* ============================================
   ENTER KEY SEARCH
============================================ */
$(document).on("keypress", "#inclusion_exclusion_common_title_filter", function(e) {

    if (e.which == 13) {
        search_inclusion_exclusion();
    }

});



/* ============================================
   RELOAD DATATABLE PROPERLY
   Fix:
   Clear filters + reset pagination + full reload
============================================ */
function reload_table(action_type = '')
{
    /* ============================================
       CLEAR HIDDEN FILTER VALUES
       (These may be restricting results to one row)
    ============================================ */
    $("#payment_policies_id").val('');
    $("#id").val('');

    /* Optional:
       If you have other filters, reset them too
    */
    // $("#payment_policies_createdby_user_id").val('');
    // $("#payment_policies_name_filter").val('');

    /* ============================================
       FULL TABLE RELOAD
       true = reset pagination to page 1
    ============================================ */
    

    /* ============================================
       SUCCESS MESSAGE
    ============================================ */
    let message = '';
    let flash = 1;

    if (action_type == 'update') {
        message = "Include and Exclude details updated successfully";
    } 
    else if (action_type == 'delete') {
        message = "Include and Exclude details deleted successfully";
    } 
    else if (action_type == 'add'){
        message = "Include and Exclude details added successfully";
    }
    else{
        flash = 0;
    }

    if(flash){
        $("#flash_message").html(`
        <div class="alert alert-success alert-dismissible fade show" role="alert">
            ${message}
            <button type="button" class="btn-close" data-bs-dismiss="alert"></button>
        </div>
        `);
    }

    /* AUTO HIDE */
    setTimeout(function () {
        $("#flash_message .alert").fadeOut('slow', function () {
            $(this).remove();
        });
    }, 5000);
    if (table) {
        table.ajax.reload(null, true);
    }
}


/* ============================================
   ADD NEW POLICY
============================================ */
function add_inclusions_exclusions() {

    /* MODE */
    save_method = 'add';

    /* RESET HIDDEN ID */
    $("#payment_policies_id").val('');
    $("#id").val('');

    /* RESET FORM */
    $('#form')[0].reset();

    /* CLEAR VALIDATION */
    $('.form-group').removeClass('input-warning-o');
    $('.form-control').removeClass('is-invalid');
    $('.help-block').text('');

    /* RESET BUTTON */
    $('#btnSave').text('save');
    $('#btnSave').attr('disabled', false);

    /* CLEAR DYNAMIC ITEMS */
    $("#inclusions_items").html('');

    /* RESET COUNTER */
    counter = 0;

    /* ADD FIRST DEFAULT TEXTAREA */
    addNewRowInc();
    addNewRowExc();

    /* MODAL TITLE */
    $('.modal-title').text('Add Inclusion & Exclusion Details');

    /* SHOW MODAL */
    $('#Inclusions_exclusionsModal').modal('show');
}


/* ============================================
   ADD DYNAMIC ROW
============================================ */
function addNewRowInc(value = '', item_id = '') {

    counter++;

    let html = `
        <div class="row mb-3" id="row_${counter}">
            
            <div class="col-md-8">
                
                <input type="hidden"
                       name="inclusions_id[${counter}]"
                       value="${item_id}">

                <textarea class="form-control inclusions-text"
                          name="inclusions_details[${counter}]"
                          rows="3"
                          placeholder="Enter Inclusion Item">${value}</textarea>

                <span class="help-block text-danger" id="error_${counter}"></span>
            </div>

            <div class="col-md-2">
                <button type="button"
                        class="btn btn-danger"
                        onclick="deleteRowInc(${counter})">
                    X
                </button>
            </div>

        </div>
    `;

    $("#inclusions_items").append(html);
}

function addNewRowExc(value = '', item_id = '') {

    counter++;

    let html = `
        <div class="row mb-3" id="row_${counter}">
            
            <div class="col-md-8">
                
                <input type="hidden"
                       name="exclusions_id[${counter}]"
                       value="${item_id}">

                <textarea class="form-control exclusions-text"
                          name="exclusions_details[${counter}]"
                          rows="3"
                          placeholder="Enter Exclusion Item">${value}</textarea>

                <span class="help-block text-danger" id="error_${counter}"></span>
            </div>

            <div class="col-md-2">
                <button type="button"
                        class="btn btn-danger"
                        onclick="deleteRowExc(${counter})">
                    X
                </button>
            </div>

        </div>
    `;

    $("#exclusions_items").append(html);
}


/* ============================================
   DELETE ROW
============================================ */
function deleteRowInc(id) {
    $("#row_" + id).remove();
}

function deleteRowExc(id) {
    $("#row_" + id).remove();
}

/* ============================================
   EDIT
============================================ */
function edit_include_exclude(id) {

    save_method = 'update';

    $('#form')[0].reset();
    $('#inclusions_items').html('');
    $('#exclusions_items').html('');
    counter = 0;

    $.ajax({
        url: "<?php echo site_url('Inclusions_exclusions/ajax_edit/') ?>/" + id,
        type: "GET",
        dataType: "JSON",

        success: function (data) {
            console.log(data.item.inclusion_exclusion_common_id, 'data.policy.inclusion_exclusion_common_id');

            $("#inclusion_exclusion_common_id").val(data.item.inclusion_exclusion_common_id);
            $("#inclusion_exclusion_common_title").val(data.item.inclusion_exclusion_common_title);

            $.each(data.inclusions, function (i, item) {
                addNewRowInc(
                    item.inclusions_details,
                    item.inclusions_id
                );
            });

            $.each(data.exclusions, function (i, item) {
                addNewRowExc(
                    item.exclusions_details,
                    item.exclusions_id
                );
            });

            $('#Inclusions_exclusionsModal').modal('show');
        }
    });
}


/* ============================================
   VALIDATION
============================================ */
function validatePolicies() {

    let valid = true;

    $(".help-block").text('');

    if ($("#inclusion_exclusion_common_title").val().trim() == '') {
        $("#inclusion_exclusion_common_title").next('.help-block').text('Inclusion title is required');
        valid = false;
    }

    $(".inclusions-text").each(function () {

        let value = $(this).val().trim();

        if (value == '') {
            $(this).next('.help-block').text('This field is required');
            valid = false;
        }
    });

    $(".exclusions-text").each(function () {

        let value = $(this).val().trim();

        if (value == '') {
            $(this).next('.help-block').text('This field is required');
            valid = false;
        }
    });

    return valid;
}



/* ============================================
   SAVE FUNCTION (ADD / UPDATE)
   IMPORTANT:
   Call flash message BEFORE resetting modal values
============================================ */
function save(e)
{
    if (e) e.preventDefault();

    var url;

    if (save_method == 'add') {

        $("#payment_policies_id").val('');

        $('#btnSave').text('saving...');
        $('#btnSave').attr('disabled', true);

        url = "<?php echo base_url();?>index.php/Inclusions_exclusions/ajax_add/";

    } else {

        $('#btnSave').text('updating...');
        $('#btnSave').attr('disabled', true);

        url = "<?php echo base_url();?>index.php/Inclusions_exclusions/ajax_update/";
    }

    /* VALIDATION */
    if (!validatePolicies()) {

        $('#btnSave').text('save');
        $('#btnSave').attr('disabled', false);

        return false;
    }

    var form = document.getElementById('form');
    var data = new FormData(form);

    $.ajax({
        url: url,
        type: "POST",
        data: data,
        dataType: "JSON",
        processData: false,
        contentType: false,

        success: function(response)
        {
            if (response.status) {

                /* ============================================
                   SET MESSAGE DIRECTLY HERE
                ============================================ */
                let message = '';
                let action_type ='';

                if (save_method == 'add') {
                    action_type = 'add';
                    message = "Inclusion and Exclusion details added successfully";
                } else {
                    
                    action_type = 'update';
                    message = "Inclusion and Exclusion details updated successfully";
                }

                /* ============================================
                   SHOW FLASH MESSAGE
                ============================================ */
                $("#flash_message").html(`
                    <div class="alert alert-success alert-dismissible fade show" role="alert">
                        ${message}
                        <button type="button" class="btn-close" data-bs-dismiss="alert"></button>
                    </div>
                `);

                /* AUTO HIDE */
                setTimeout(function () {
                    $("#flash_message .alert").fadeOut('slow');
                }, 5000);

                /* CLOSE MODAL */
                $('#Inclusions_exclusionsModal').modal('hide');

                /* RESET FORM */
                $('#form')[0].reset();
                $('#inclusions_items').html('');
                $('#exclusions_items').html('');

                counter = 0;

                /* RELOAD TABLE */
                reload_table(action_type);

            } else {

                if (response.message) {
                    alert(response.message);
                }

                for (var i = 0; i < response.inputerror.length; i++) {

                    $('[name="' + response.inputerror[i] + '"]')
                        .closest('.form-group, .col-md-10, .mb-3')
                        .addClass('input-warning-o');

                    $('[name="' + response.inputerror[i] + '"]')
                        .next('.help-block')
                        .text(response.error_string[i]);
                }
            }

            $('#btnSave').text('save');
            $('#btnSave').attr('disabled', false);
        },

        error: function (jqXHR)
        {
            console.log(jqXHR.responseText);

            alert('Error adding / updating data');

            $('#btnSave').text('save');
            $('#btnSave').attr('disabled', false);
        }
    });
}




/* ============================================
   OPEN DELETE CONFIRMATION MODAL
============================================ */
function delete_include_exclude(id)
{
    if (!id) {
        alert('Invalid Include and Exclude ID');
        return false;
    }

    $.ajax({
        url: "<?php echo base_url();?>index.php/Inclusions_exclusions/ajax_edit/" + id,
        type: "GET",
        dataType: "JSON",

        success: function(data)
        {
            /* SET VALUES */
            $('#delete_id').val(data.item.inclusion_exclusion_common_id);

            $('#delete_inclusion_exclusion_common_title').text(
                data.item.inclusion_exclusion_common_title
            );

            /* SHOW MODAL */
            $('#deleterowModal').modal('show');

            /* TITLE */
            $('.modal-title1').text('Do you want to delete this record?');

            /* BUTTON */
            $('#btnSave1').text('Delete');
            $('#btnSave1').attr('disabled', false);
        },

        error: function(jqXHR)
        {
            console.log(jqXHR.responseText);

            alert('Failed to fetch record details');
        }
    });

    return false;
}



/* ============================================
   CONFIRM DELETE ACTION
============================================ */
function confirm_delete_payment_policy()
{
    var id = $('#delete_id').val();

    if (!id) {
        alert('Invalid Include and Exclude ID');
        return false;
    }

    $('#btnSave1').text('Deleting...');
    $('#btnSave1').attr('disabled', true);

    $.ajax({
        url: "<?php echo base_url();?>index.php/Inclusions_exclusions/ajax_delete/" + id,
        type: "POST",
        dataType: "JSON",

        success: function(response)
        {
            if (response.status) {

                /* CLOSE MODAL */
                $('#deleterowModal').modal('hide');

                /* RELOAD TABLE */
                reload_table('delete');

            } else {

                alert(response.message || 'Delete failed');
            }

            $('#btnSave1').text('Delete');
            $('#btnSave1').attr('disabled', false);
        },

        error: function(jqXHR)
        {
            console.log(jqXHR.responseText);

            alert('Error deleting data');

            $('#btnSave1').text('Delete');
            $('#btnSave1').attr('disabled', false);
        }
    });
}

</script>