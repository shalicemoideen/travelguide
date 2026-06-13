<script type="text/javascript">
var base_url = '<?php echo base_url(); ?>';
var table;
var save_method;
var currentSchedulerId = null;

$(document).ready(function() {
    loadTable();

    $('#quotation_id_fk').change(function() {
        var quotation_id = $(this).val();
        if (quotation_id) {
            $.ajax({
                url: base_url + 'receipt_scheduler/get_quotation_amount',
                type: 'POST',
                data: { quotation_id: quotation_id },
                dataType: 'json',
                success: function(response) {
                    $('#total_amount').val(response.total_amount);
                }
            });
        }
    });

    $('#payment_date').val(new Date().toISOString().split('T')[0]);
});

function loadTable() {
    table = $('#scheduler_table').DataTable({
        "processing": true,
        "serverSide": true,
        "order": [],
        "ajax": {
            "url": base_url + "receipt_scheduler/get_table",
            "type": "POST",
            "data": function(d) {
                d.quotation_number_filter = $('#filter_quotation_number').val();
                d.payment_type_filter = $('#filter_payment_type').val();
                d.start_date = $('#filter_start_date').val();
                d.end_date = $('#filter_end_date').val();
            }
        },
        "columnDefs": [{
            "targets": [0, -1],
            "orderable": false
        }],
        "columns": [
            {
                data: null,
                render: function(data, type, row, meta) {
                    return meta.row + meta.settings._iDisplayStart + 1;
                }
            },
            { data: "quotation_number" },
            { data: "guest_name" },
            {
                data: "payment_type",
                render: function(data) {
                    if (data == 'FULL') {
                        return '<span class="badge bg-primary">Full Payment</span>';
                    } else {
                        return '<span class="badge bg-info">EMI</span>';
                    }
                }
            },
            {
                data: "total_amount",
                render: function(data) {
                    return '₹' + parseFloat(data).toLocaleString('en-IN', { minimumFractionDigits: 2 });
                }
            },
            {
                data: "max_emi_count",
                render: function(data, type, row) {
                    return row.payment_type == 'EMI' ? data : '-';
                }
            },
            { data: "created_date_formatted" },
            {
                data: null,
                render: function(data, type, row) {
                    var html = '<div class="d-flex">';
                    html += '<button type="button" class="btn btn-info btn-sm me-1" onclick="viewScheduler(' + row.receipt_scheduler_id + ')" title="View"><i class="fas fa-eye"></i></button>';
                    html += '<button type="button" class="btn btn-warning btn-sm me-1" onclick="editScheduler(' + row.receipt_scheduler_id + ')" title="Edit"><i class="fas fa-edit"></i></button>';
                    html += '<button type="button" class="btn btn-danger btn-sm" onclick="deleteScheduler(' + row.receipt_scheduler_id + ')" title="Delete"><i class="fas fa-trash"></i></button>';
                    html += '</div>';
                    return html;
                }
            }
        ]
    });
}

function applyFilters() {
    table.ajax.reload();
}

function clearFilters() {
    $('#filter_quotation_number').val('');
    $('#filter_payment_type').val('');
    $('#filter_start_date').val('');
    $('#filter_end_date').val('');
    table.ajax.reload();
}

function add_scheduler() {
    save_method = 'add';
    $('#schedulerForm')[0].reset();
    $('#receipt_scheduler_id').val('');
    $('#quotation_id_fk').prop('disabled', false);
    $('#fullPaymentSection').hide();
    $('#emiSection').hide();
    $('#emiTableBody').html('');
    $('.modal-title').text('Create Payment Schedule');
    $('#schedulerModal').modal('show');
}

function togglePaymentType() {
    var type = $('#payment_type').val();
    if (type == 'FULL') {
        $('#fullPaymentSection').show();
        $('#emiSection').hide();
    } else if (type == 'EMI') {
        $('#fullPaymentSection').hide();
        $('#emiSection').show();
        generateEmiRows();
    } else {
        $('#fullPaymentSection').hide();
        $('#emiSection').hide();
    }
}

function toggleSplitType() {
    var splitType = $('#split_type').val();
    if (splitType == 'PERCENTAGE') {
        $('#emiAmountHeader').text('Percentage (%)');
    } else {
        $('#emiAmountHeader').text('Amount');
    }
    generateEmiRows();
}

function generateEmiRows() {
    var count = parseInt($('#max_emi_count').val()) || 3;
    var totalAmount = parseFloat($('#total_amount').val()) || 0;
    var splitType = $('#split_type').val();
    var html = '';

    for (var i = 1; i <= count; i++) {
        var defaultValue = splitType == 'PERCENTAGE' ? (100 / count).toFixed(2) : (totalAmount / count).toFixed(2);
        html += '<tr>';
        html += '<td class="text-center"><strong>EMI ' + i + '</strong></td>';
        html += '<td>';
        if (splitType == 'PERCENTAGE') {
            html += '<input type="number" step="0.01" class="form-control form-control-sm emi-percentage" name="emi_percentage[]" value="' + defaultValue + '" onchange="calculateEmiTotal()">';
        } else {
            html += '<input type="number" step="0.01" class="form-control form-control-sm emi-amount" name="emi_amount[]" value="' + defaultValue + '" onchange="calculateEmiTotal()">';
        }
        html += '</td>';
        html += '<td><input type="date" class="form-control form-control-sm" name="emi_due_date[]" required></td>';
        html += '<td class="calculated-amount text-end">₹' + (splitType == 'PERCENTAGE' ? ((totalAmount * parseFloat(defaultValue)) / 100).toFixed(2) : defaultValue) + '</td>';
        html += '</tr>';
    }

    $('#emiTableBody').html(html);
    calculateEmiTotal();
}

function calculateEmiTotal() {
    var totalAmount = parseFloat($('#total_amount').val()) || 0;
    var splitType = $('#split_type').val();
    var total = 0;

    if (splitType == 'PERCENTAGE') {
        var percentTotal = 0;
        $('.emi-percentage').each(function(index) {
            var percent = parseFloat($(this).val()) || 0;
            percentTotal += percent;
            var calculated = (totalAmount * percent) / 100;
            total += calculated;
            $(this).closest('tr').find('.calculated-amount').text('₹' + calculated.toFixed(2));
        });
        $('#emiTotalCol').text(percentTotal.toFixed(2) + '%');
    } else {
        $('.emi-amount').each(function(index) {
            var amt = parseFloat($(this).val()) || 0;
            total += amt;
            $(this).closest('tr').find('.calculated-amount').text('₹' + amt.toFixed(2));
        });
        $('#emiTotalCol').text('₹' + total.toFixed(2));
    }

    $('#emiCalculatedTotal').text('₹' + total.toFixed(2));

    if (Math.abs(total - totalAmount) > 0.01) {
        $('#emiCalculatedTotal').addClass('text-danger');
    } else {
        $('#emiCalculatedTotal').removeClass('text-danger');
    }
}

function save() {
    var formData = $('#schedulerForm').serialize();
    var url = save_method == 'add' ? base_url + 'receipt_scheduler/add' : base_url + 'receipt_scheduler/edit';

    $.ajax({
        url: url,
        type: 'POST',
        data: formData,
        dataType: 'json',
        beforeSend: function() {
            $('#btnSave').prop('disabled', true).text('Saving...');
        },
        success: function(response) {
            $('#btnSave').prop('disabled', false).text('Save');
            if (response.error) {
                alert(response.message);
            } else {
                $('#schedulerModal').modal('hide');
                table.ajax.reload();
                alert(response.message);
            }
        },
        error: function() {
            $('#btnSave').prop('disabled', false).text('Save');
            alert('An error occurred. Please try again.');
        }
    });
}

function editScheduler(id) {
    save_method = 'edit';
    $.ajax({
        url: base_url + 'receipt_scheduler/get_by_id',
        type: 'POST',
        data: { receipt_scheduler_id: id },
        dataType: 'json',
        success: function(response) {
            var scheduler = response.scheduler;
            var installments = response.installments;

            $('#receipt_scheduler_id').val(scheduler.receipt_scheduler_id);
            $('#quotation_id_fk').val(scheduler.quotation_id_fk).prop('disabled', true);
            $('#total_amount').val(scheduler.total_amount);
            $('#payment_type').val(scheduler.payment_type);
            $('#receipt_scheduler_remarks').val(scheduler.receipt_scheduler_remarks);

            togglePaymentType();

            if (scheduler.payment_type == 'FULL') {
                if (installments.length > 0) {
                    $('#cutoff_date').val(installments[0].due_date);
                }
            } else {
                $('#max_emi_count').val(scheduler.max_emi_count);
                $('#split_type').val(scheduler.split_type);
                toggleSplitType();

                var html = '';
                for (var i = 0; i < installments.length; i++) {
                    var inst = installments[i];
                    html += '<tr>';
                    html += '<td class="text-center"><strong>EMI ' + inst.installment_number + '</strong></td>';
                    html += '<td>';
                    if (scheduler.split_type == 'PERCENTAGE') {
                        html += '<input type="number" step="0.01" class="form-control form-control-sm emi-percentage" name="emi_percentage[]" value="' + (inst.installment_percentage || '') + '" onchange="calculateEmiTotal()">';
                    } else {
                        html += '<input type="number" step="0.01" class="form-control form-control-sm emi-amount" name="emi_amount[]" value="' + (inst.installment_amount || '') + '" onchange="calculateEmiTotal()">';
                    }
                    html += '</td>';
                    html += '<td><input type="date" class="form-control form-control-sm" name="emi_due_date[]" value="' + inst.due_date + '" required></td>';
                    html += '<td class="calculated-amount text-end">₹' + parseFloat(inst.calculated_amount).toFixed(2) + '</td>';
                    html += '</tr>';
                }
                $('#emiTableBody').html(html);
                calculateEmiTotal();
            }

            $('.modal-title').text('Edit Payment Schedule');
            $('#schedulerModal').modal('show');
        }
    });
}

function viewScheduler(id) {
    currentSchedulerId = id;
    $.ajax({
        url: base_url + 'receipt_scheduler/get_payment_summary',
        type: 'POST',
        data: { receipt_scheduler_id: id },
        dataType: 'json',
        success: function(response) {
            if (!response || !response.scheduler) {
                alert('Unable to load payment details');
                return;
            }

            var scheduler = response.scheduler;
            $('#view_quotation_number').text(scheduler.quotation_number);
            $('#view_guest_name').text(scheduler.guest_name);
            $('#view_payment_type').html(scheduler.payment_type == 'FULL' ? '<span class="badge bg-primary">Full Payment</span>' : '<span class="badge bg-info">EMI</span>');
            $('#view_total_amount').text('₹' + parseFloat(response.total_amount).toLocaleString('en-IN', { minimumFractionDigits: 2 }));

            $('#view_paid_amount').text('₹' + parseFloat(response.total_paid).toLocaleString('en-IN', { minimumFractionDigits: 2 }));
            $('#view_pending_amount').text('₹' + parseFloat(response.pending_amount).toLocaleString('en-IN', { minimumFractionDigits: 2 }));
            $('#view_overdue_count').text(response.overdue_count);

            var html = '';
            var installments = response.installments;
            for (var i = 0; i < installments.length; i++) {
                var inst = installments[i];
                var statusClass = '';
                if (inst.payment_status == 'PAID') statusClass = 'bg-success';
                else if (inst.payment_status == 'PARTIAL') statusClass = 'bg-warning';
                else if (inst.payment_status == 'OVERDUE') statusClass = 'bg-danger';
                else statusClass = 'bg-secondary';

                html += '<tr>';
                html += '<td>' + inst.installment_number + '</td>';
                html += '<td>' + formatDate(inst.due_date) + '</td>';
                html += '<td>₹' + parseFloat(inst.calculated_amount).toLocaleString('en-IN', { minimumFractionDigits: 2 }) + '</td>';
                html += '<td>₹' + parseFloat(inst.paid_amount).toLocaleString('en-IN', { minimumFractionDigits: 2 }) + '</td>';
                html += '<td><span class="badge ' + statusClass + '">' + inst.payment_status + '</span></td>';
                html += '<td>';
                if (inst.payment_status != 'PAID') {
                    var remaining = parseFloat(inst.calculated_amount) - parseFloat(inst.paid_amount);
                    html += '<button class="btn btn-success btn-xs" onclick="recordPayment(' + inst.installment_id + ', ' + remaining.toFixed(2) + ')"><i class="fas fa-money-bill"></i> Pay</button>';
                }
                html += '</td>';
                html += '</tr>';
            }
            $('#viewInstallmentsBody').html(html);

            $('#viewModal').modal('show');
        }
    });
}

function recordPayment(installmentId, dueAmount) {
    $('#payment_installment_id').val(installmentId);
    $('#payment_due_amount').val('₹' + dueAmount.toFixed(2));
    $('#payment_amount').val(dueAmount.toFixed(2));
    $('#payment_date').val(new Date().toISOString().split('T')[0]);
    $('#payment_method').val('');
    $('#payment_reference').val('');
    $('#payment_remarks').val('');
    $('#paymentModal').modal('show');
}

function savePayment() {
    var formData = $('#paymentForm').serialize();
    $.ajax({
        url: base_url + 'receipt_scheduler/record_payment',
        type: 'POST',
        data: formData,
        dataType: 'json',
        success: function(response) {
            if (response.error) {
                alert(response.message);
            } else {
                $('#paymentModal').modal('hide');
                viewScheduler(currentSchedulerId);
                table.ajax.reload();
                alert(response.message);
            }
        }
    });
}

function deleteScheduler(id) {
    $('#delete_scheduler_id').val(id);
    $('#deleteModal').modal('show');
}

function confirmDelete() {
    var id = $('#delete_scheduler_id').val();
    $.ajax({
        url: base_url + 'receipt_scheduler/delete',
        type: 'POST',
        data: { receipt_scheduler_id: id },
        dataType: 'json',
        success: function(response) {
            $('#deleteModal').modal('hide');
            if (response.error) {
                alert(response.message);
            } else {
                table.ajax.reload();
                alert(response.message);
            }
        }
    });
}

function formatDate(dateStr) {
    if (!dateStr) return '-';
    var date = new Date(dateStr);
    var day = String(date.getDate()).padStart(2, '0');
    var month = String(date.getMonth() + 1).padStart(2, '0');
    var year = date.getFullYear();
    return day + '-' + month + '-' + year;
}

$('#total_amount').on('change', function() {
    if ($('#payment_type').val() == 'EMI') {
        generateEmiRows();
    }
});
</script>
