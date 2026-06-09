<script>

var save_method;
var table;
var counter = 0;

/* ============================================
   DATATABLE
============================================ */
$(document).ready(function () {

     table = $('#Cancellation_policy_table').DataTable({

        "processing": true,
        "serverSide": true,
        "searching": true,
        "aLengthMenu": [
            [10, 25, 50, -1],
            [10, 25, 50, "All"]
        ],

        dom: 'lBfrtip',

        buttons: [
            // {
            //     extend: 'excel',
            //     exportOptions: {
            //         columns: [0, 1, 2]
            //     }
            // },
            // {
            //     extend: 'pdf',
            //     exportOptions: {
            //         columns: [0, 1, 2]
            //     }
            // },
            // {
            //     extend: 'print',
            //     exportOptions: {
            //         columns: [0, 1, 2]
            //     }
            // }
        ],

        /* ============================================
           AJAX
        ============================================ */
        "ajax": {
            "url": "<?php echo base_url();?>index.php/Cancellation_policies/get/",
            "type": "POST",
            "data": function (d) {
                // d.payment_policies_id = $("#payment_policies_id").val();
                // d.payment_policies_createdby_user_id = $("#payment_policies_createdby_user_id").val();
                /* SEARCH FILTER */
                // d.payment_policies_name = $("#payment_policies_name_filter").val();
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
                "data": "cancellation_policies_name",
                "orderable": false
            },

            /* CREATED BY */
            // {
            //     "data": "admin_name",
            //     "orderable": false
            // },

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
            // $('td', row).eq(3).html(`
            //     <div class="d-flex">
                    
            //         <a href="javascript:void(0)"
            //            onclick="edit_payment_policies(${data.cancellation_policies_id})"
            //            class="btn btn-primary shadow btn-xs sharp me-1">
            //             <i class="fas fa-pencil-alt"></i>
            //         </a>

            //         <a href="javascript:void(0)"
            //            onclick="return delete_payment_policies(${data.cancellation_policies_id})"
            //            class="btn btn-danger shadow btn-xs sharp">
            //             <i class="fa fa-trash"></i>
            //         </a>

            //     </div>
            // `);

            let actionHtml = '<div class="d-flex">';

            // Edit button
            if (hasPermission('CANCELLATION_AND_POLICY_UPDATE')) {
                actionHtml += '<a href="javascript:void(0)" onclick="edit_cancellation_policy('+data['cancellation_policies_id']+')" class="btn btn-primary shadow btn-xs sharp me-1"><i class="fas fa-pencil-alt"></i></a>';
            }

            // Delete button
            if (hasPermission('CANCELLATION_AND_POLICY_DELETE')) {
                actionHtml += '<a href="javascript:void(0)" onclick="return delete_cancellation_policy('+data['cancellation_policies_id']+')" class="btn btn-danger shadow btn-xs sharp"><i class="fa fa-trash"></i></a>';
            }

            actionHtml += '</div>';

            $('td', row).eq(2).html(actionHtml);
           
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

    $("#add_more_btn").click(function () {
        addNewRow();
    });
});


/* ============================================
   SEARCH BUTTON
============================================ */
function search_cancellation_policy()
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
    $("#cancellation_policies_name_filter").val('');
    $("#cancellation_policies_id").val('');
    $("#cancellation_policies_createdby_user_id").val('');

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
$(document).on("keypress", "#cancellation_policies_name_filter", function(e) {

    if (e.which == 13) {
        search_cancellation_policy();
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
    $("#cancellation_policies_id").val('');
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
        message = "Cancellation policy details updated successfully";
    } 
    else if (action_type == 'delete') {
        message = "Cancellation policy details deleted successfully";
    } 
    else if (action_type == 'add'){
        message = "Cancellation policy details added successfully";
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
   ADD NEW TERMS
============================================ */
function add_cancellation_policy() {

    /* MODE */
    save_method = 'add';

    /* RESET HIDDEN ID */
    $("#cancellation_policies_id").val('');
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
    $("#product1").html('');

    /* RESET COUNTER */
    counter = 0;

    /* ADD FIRST DEFAULT TEXTAREA */
    addNewRow();

    /* MODAL TITLE */
    $('.modal-title').text('Add Cancellation policy Details');

    /* SHOW MODAL */
    $('#Cancellation_policyModal').modal('show');
}


/* ============================================
   ADD DYNAMIC ROW
============================================ */
function addNewRow(value = '', item_id = '') {

    counter++;

    let html = `
        <div class="row mb-3" id="row_${counter}">
            
            <div class="col-md-10">
                
                <input type="hidden"
                       name="cancellation_policies_item_id
                       [${counter}]"
                       value="${item_id}">

                <textarea class="form-control terms-text"
                          name="cancellation_policies_item_name[${counter}]"
                          rows="3"
                          placeholder="Enter Cancellation policy Item">${value}</textarea>

                <span class="help-block text-danger" id="error_${counter}"></span>
            </div>

            <div class="col-md-2">
                <button type="button"
                        class="btn btn-danger"
                        onclick="deleteRow(${counter})">
                    X
                </button>
            </div>

        </div>
    `;

    $("#product1").append(html);
}


/* ============================================
   DELETE ROW
============================================ */
function deleteRow(id) {
    $("#row_" + id).remove();
}


/* ============================================
   EDIT
============================================ */
function edit_cancellation_policy(id) {

    save_method = 'update';

    $('#form')[0].reset();
    $('#product1').html('');
    counter = 0;

    $.ajax({
        url: "<?php echo site_url('Cancellation_policies/ajax_edit/') ?>/" + id,
        type: "GET",
        dataType: "JSON",

        success: function (data) {
            console.log(data.cancel.cancellation_policies_id, 'data.cancel.cancellation_policies_id');

            $("#cancellation_policies_id").val(data.cancel.cancellation_policies_id);
            $("#cancellation_policies_name").val(data.cancel.cancellation_policies_name);

            $.each(data.items, function (i, item) {
                addNewRow(
                    item.cancellation_policies_item_name,
                    item.cancellation_policies_item_id
                );
            });

            $('#Cancellation_policyModal').modal('show');
        }
    });
}


/* ============================================
   VALIDATION
============================================ */
function validateCancel() {

    let valid = true;

    $(".help-block").text('');

    if ($("#cancellation_policies_name").val().trim() == '') {
        $("#cancellation_policies_name").next('.help-block').text('Cancellation name is required');
        valid = false;
    }

    $(".terms-text").each(function () {

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

        $("#cancellation_policies_id").val('');

        $('#btnSave').text('saving...');
        $('#btnSave').attr('disabled', true);

        url = "<?php echo base_url();?>index.php/Cancellation_policies/ajax_add/";

    } else {

        $('#btnSave').text('updating...');
        $('#btnSave').attr('disabled', true);

        url = "<?php echo base_url();?>index.php/Cancellation_policies/ajax_update/";
    }

    /* VALIDATION */
    if (!validateCancel()) {

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
                    message = "Cancellation policy details added successfully";
                } else {
                    
                    action_type = 'update';
                    message = "Cancellation policy details updated successfully";
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
                $('#Cancellation_policyModal').modal('hide');

                /* RESET FORM */
                $('#form')[0].reset();
                $('#product1').html('');
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
function delete_cancellation_policy(id)
{
    if (!id) {
        alert('Invalid Cancellation policy ID');
        return false;
    }

    $.ajax({
        url: "<?php echo base_url();?>index.php/Cancellation_policies/ajax_edit/" + id,
        type: "GET",
        dataType: "JSON",

        success: function(data)
        {
            /* SET VALUES */
            $('#delete_id').val(data.cancel.cancellation_policies_id);

            $('#delete_cancel_name').text(
                data.cancel.cancellation_policies_name
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
function confirm_delete_cancellation_policy()
{
    var id = $('#delete_id').val();

    if (!id) {
        alert('Invalid cancellation policy ID');
        return false;
    }

    $('#btnSave1').text('Deleting...');
    $('#btnSave1').attr('disabled', true);

    $.ajax({
        url: "<?php echo base_url();?>index.php/Cancellation_policies/ajax_delete/" + id,
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