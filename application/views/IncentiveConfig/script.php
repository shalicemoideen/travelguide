<script type="text/javascript">

var baseUrl = "<?php echo base_url(); ?>";

function toggleDeductionRow() {
    var type = $('#slab_type').val();
    if (type === 'percentage') {
        $('#deductionRow').show();
        $('#lblIncentiveValue').text('Incentive % (of Profit) *');
    } else {
        $('#deductionRow').hide();
        $('#slab_deduction').val(0);
        $('#lblIncentiveValue').text('Incentive Amount (₹) *');
    }
}

$('#slab_type').on('change', toggleDeductionRow);

$('#btnAddSlab').on('click', function () {
    $('#slabModalTitle').text('Add Incentive Slab');
    $('#slab_id').val('');
    $('#slab_label').val('');
    $('#slab_min').val('');
    $('#slab_max').val('');
    $('#slab_type').val('fixed');
    $('#slab_value').val('');
    $('#slab_deduction').val(0);
    toggleDeductionRow();
    $('#slabModal').modal('show');
});

$(document).on('click', '.btnEdit', function () {
    $('#slabModalTitle').text('Edit Incentive Slab');
    $('#slab_id').val($(this).data('id'));
    $('#slab_label').val($(this).data('label'));
    $('#slab_min').val($(this).data('min'));
    $('#slab_max').val($(this).data('max') != 'null' && $(this).data('max') ? $(this).data('max') : '');
    $('#slab_type').val($(this).data('type'));
    $('#slab_value').val($(this).data('value'));
    $('#slab_deduction').val($(this).data('deduction'));
    toggleDeductionRow();
    $('#slabModal').modal('show');
});

$('#btnSaveSlab').on('click', function () {
    var label = $.trim($('#slab_label').val());
    var min   = $.trim($('#slab_min').val());
    var value = $.trim($('#slab_value').val());

    if (!label || min === '' || !value) {
        Swal.fire('Validation', 'Slab Label, Min Profit and Incentive Value are required.', 'warning');
        return;
    }

    var id  = $('#slab_id').val();
    var url = id ? baseUrl + 'index.php/IncentiveConfig/ajax_update' : baseUrl + 'index.php/IncentiveConfig/ajax_add';

    $.ajax({
        url: url,
        type: 'POST',
        data: {
            id:               id,
            slab_label:       label,
            min_profit:       min,
            max_profit:       $('#slab_max').val(),
            calculation_type: $('#slab_type').val(),
            incentive_value:  value,
            deduction:        $('#slab_deduction').val() || 0
        },
        success: function (res) {
            var r = typeof res === 'string' ? JSON.parse(res) : res;
            if (r.status) {
                $('#slabModal').modal('hide');
                Swal.fire({ icon: 'success', title: 'Saved', timer: 1200, showConfirmButton: false });
                setTimeout(function () { location.reload(); }, 1300);
            }
        }
    });
});

$(document).on('click', '.btnDelete', function () {
    var id = $(this).data('id');
    Swal.fire({
        title: 'Delete this slab?',
        icon: 'warning',
        showCancelButton: true,
        confirmButtonColor: '#d33',
        confirmButtonText: 'Yes, delete'
    }).then(function (result) {
        if (result.isConfirmed) {
            $.ajax({
                url: baseUrl + 'index.php/IncentiveConfig/ajax_delete',
                type: 'POST',
                data: { id: id },
                success: function () {
                    Swal.fire({ icon: 'success', title: 'Deleted', timer: 1000, showConfirmButton: false });
                    setTimeout(function () { location.reload(); }, 1100);
                }
            });
        }
    });
});

$(document).ready(function () {
    toggleDeductionRow();
});
</script>
