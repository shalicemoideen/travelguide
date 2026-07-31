<script type="text/javascript">
var base_url = '<?php echo base_url(); ?>index.php/';
var table;
var save_method;
var currentSchedulerId = null;
var rs_can_pay_initial = <?php echo has_permission('RECEIPT_SCHEDULER_PAY_INITIAL') ? 'true' : 'false'; ?>;
var rs_can_pay_other = <?php echo has_permission('RECEIPT_SCHEDULER_PAY_OTHER') ? 'true' : 'false'; ?>;
var rs_can_view = <?php echo has_permission('RECEIPT_SCHEDULER') || has_permission('PAYMENT_REPORT') ? 'true' : 'false'; ?>;
var rs_can_edit = <?php echo has_permission('RECEIPT_SCHEDULER') ? 'true' : 'false'; ?>;
var rs_can_delete = <?php echo has_permission('RECEIPT_SCHEDULER') ? 'true' : 'false'; ?>;

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
                    window.__schedulerTravelStartDate = response.travel_start_date || '';
                    $('#cutoff_date').val(window.__schedulerTravelStartDate);
                    updateCutoffDateDisplay();
                    if ($('#payment_type').val() == 'EMI') {
                        generateEmiRows();
                    }
                }
            });
        } else {
            window.__schedulerTravelStartDate = '';
            $('#cutoff_date').val('');
            updateCutoffDateDisplay();
        }
    });

    $('#payment_date').val(new Date().toISOString().split('T')[0]);
});

function loadTable() {
    table = $('#scheduler_table').DataTable({
        "processing": true,
        "serverSide": true,
        "order": [],
        "searching": false,
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
                    if (rs_can_view) {
                        html += '<button type="button" class="btn btn-info btn-sm me-1" onclick="viewScheduler(' + row.receipt_scheduler_id + ')" title="View"><i class="fas fa-eye"></i></button>';
                    }
                    if (rs_can_edit && (!row.has_payments || row.has_payments == 0)) {
                        html += '<button type="button" class="btn btn-warning btn-sm me-1" onclick="editScheduler(' + row.receipt_scheduler_id + ')" title="Edit"><i class="fas fa-edit"></i></button>';
                    }
                    if (rs_can_delete && (!row.has_payments || row.has_payments == 0)) {
                        html += '<button type="button" class="btn btn-danger btn-sm" onclick="deleteScheduler(' + row.receipt_scheduler_id + ')" title="Delete"><i class="fas fa-trash"></i></button>';
                    }
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
    updateCutoffDateDisplay();
    $('.modal-title').text('Create Payment Schedule');
    $('#schedulerModal').modal('show');
}

function togglePaymentType() {
    var type = $('#payment_type').val();
    if (type == 'FULL') {
        $('#fullPaymentSection').show();
        $('#emiSection').hide();
        var amt = parseFloat($('#total_amount').val()) || 0;
        $('#full_total_display').text('₹' + amt.toLocaleString('en-IN', { minimumFractionDigits: 2 }));
    } else if (type == 'EMI') {
        $('#fullPaymentSection').hide();
        $('#emiSection').show();
        var amt = parseFloat($('#total_amount').val()) || 0;
        $('#emi_total_display').text('₹' + amt.toLocaleString('en-IN', { minimumFractionDigits: 2 }));
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
    var count = Math.min(24, Math.max(2, parseInt($('#max_emi_count').val()) || 2));
    $('#max_emi_count').val(count);
    var totalAmount = parseFloat($('#total_amount').val()) || 0;
    var splitType = $('#split_type').val();
    var html = '';
    var today = new Date();
    var todayYMD = today.getFullYear() + '-' + String(today.getMonth() + 1).padStart(2, '0') + '-' + String(today.getDate()).padStart(2, '0');

    for (var i = 1; i <= count; i++) {
        var defaultValue = splitType == 'PERCENTAGE'
            ? (i === 1 ? 30 : 70 / (count - 1)).toFixed(2)
            : (totalAmount / count).toFixed(2);
        html += '<tr>';
        html += '<td class="text-center"><strong>EMI ' + i + '</strong></td>';
        html += '<td>';
        if (splitType == 'PERCENTAGE') {
            html += '<input type="number" step="0.01" class="form-control form-control-sm emi-percentage" name="emi_percentage[]" value="' + defaultValue + '">';
        } else {
            html += '<input type="number" step="0.01" class="form-control form-control-sm emi-amount" name="emi_amount[]" value="' + defaultValue + '">';
        }
        html += '</td>';
        html += '<td>';
        html += '<input type="text" class="form-control form-control-sm emi-due-date" placeholder="dd/mm/yyyy" required>';
        var dueDateYMD = i === 1 ? todayYMD : (window.__schedulerTravelStartDate || todayYMD);
        html += '<input type="hidden" name="emi_due_date[]" class="emi-due-date-hidden" value="' + dueDateYMD + '">';
        html += '</td>';
        html += '<td class="calculated-amount text-end">₹' + (splitType == 'PERCENTAGE' ? ((totalAmount * parseFloat(defaultValue)) / 100).toFixed(2) : defaultValue) + '</td>';
        html += '</tr>';
    }

    $('#emiTableBody').html(html);
    $('#emiTableBody .emi-due-date').each(function(index) {
        var dueDateYMD = index === 0 ? todayYMD : (window.__schedulerTravelStartDate || todayYMD);
        $(this).val(formatDateSlashDMY(dueDateYMD));
    });
    initEmiDatepickers();
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

function redistributeEmiAmounts($changedInput) {
    var splitType = $('#split_type').val();
    var total;
    var $inputs;

    if (splitType == 'PERCENTAGE') {
        total = 100;
        $inputs = $('.emi-percentage');
    } else {
        total = parseFloat($('#total_amount').val()) || 0;
        $inputs = $('.emi-amount');
    }

    var changedVal = parseFloat($changedInput.val()) || 0;
    var remaining = total - changedVal;
    var $others = $inputs.not($changedInput);

    if ($others.length > 0) {
        var each = (remaining / $others.length).toFixed(2);
        $others.val(each);
    }

    calculateEmiTotal();
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
                var n = new notify({ title: '', style: 'error', message: response.message, icon: 'fas fa-times' });
                n.show(); setTimeout(function(){ n.hide(); }, 3000);
            } else {
                $('#schedulerModal').modal('hide');
                table.ajax.reload();
                var n = new notify({ title: '', style: 'success', message: response.message, icon: 'fas fa-check' });
                n.show(); setTimeout(function(){ n.hide(); }, 3000);
            }
        },
        error: function() {
            $('#btnSave').prop('disabled', false).text('Save');
            var n = new notify({ title: '', style: 'error', message: 'An error occurred. Please try again.', icon: 'fas fa-times' });
            n.show(); setTimeout(function(){ n.hide(); }, 3000);
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
            var hasPayments = response.has_payments || false;

            $('#receipt_scheduler_id').val(scheduler.receipt_scheduler_id);
            $('#quotation_id_fk').val(scheduler.quotation_id_fk).prop('disabled', true);
            $('#total_amount').val(scheduler.total_amount);
            $('#payment_type').val(scheduler.payment_type);
            $('#receipt_scheduler_remarks').val(scheduler.receipt_scheduler_remarks);

            if (hasPayments) {
                $('#total_amount').prop('readonly', true);
                $('#payment_type').prop('disabled', true);
                $('#max_emi_count').prop('readonly', true);
                $('#split_type').prop('disabled', true);
                $('button[onclick="generateEmiRows()"]').prop('disabled', true);
            } else {
                $('#total_amount').prop('readonly', false);
                $('#payment_type').prop('disabled', false);
                $('#max_emi_count').prop('readonly', false);
                $('#split_type').prop('disabled', false);
                $('button[onclick="generateEmiRows()"]').prop('disabled', false);
            }

            togglePaymentType();

            if (scheduler.payment_type == 'FULL') {
                if (installments.length > 0) {
                    $('#cutoff_date').val(installments[0].due_date);
                    updateCutoffDateDisplay();
                }
            } else {
                $('#max_emi_count').val(Math.min(24, Math.max(2, parseInt(scheduler.max_emi_count) || 2)));
                $('#split_type').val(scheduler.split_type);
                toggleSplitType();

                var html = '';
                for (var i = 0; i < installments.length; i++) {
                    var inst = installments[i];
                    html += '<tr>';
                    html += '<td class="text-center"><strong>EMI ' + inst.installment_number + '</strong></td>';
                    html += '<td>';
                    if (scheduler.split_type == 'PERCENTAGE') {
                        html += '<input type="number" step="0.01" class="form-control form-control-sm emi-percentage" name="emi_percentage[]" value="' + (inst.installment_percentage || '') + '"' + (hasPayments ? ' readonly' : '') + '>';
                    } else {
                        html += '<input type="number" step="0.01" class="form-control form-control-sm emi-amount" name="emi_amount[]" value="' + (inst.installment_amount || '') + '"' + (hasPayments ? ' readonly' : '') + '>';
                    }
                    html += '</td>';
                    html += '<td>';
                    html += '<input type="text" class="form-control form-control-sm emi-due-date" placeholder="dd/mm/yyyy" value="' + formatDateSlashDMY(inst.due_date) + '" required' + (hasPayments ? ' readonly' : '') + '>';
                    html += '<input type="hidden" name="emi_due_date[]" class="emi-due-date-hidden" value="' + (inst.due_date || '') + '">';
                    html += '</td>';
                    html += '<td class="calculated-amount text-end">₹' + parseFloat(inst.calculated_amount).toFixed(2) + '</td>';
                    html += '</tr>';
                }
                $('#emiTableBody').html(html);
                initEmiDatepickers();
                calculateEmiTotal();
            }

            if (hasPayments) {
                $('.modal-title').text('Edit Payment Schedule (Locked — Payments Collected)');
            } else {
                $('.modal-title').text('Edit Payment Schedule');
            }
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
                var n = new notify({ title: '', style: 'error', message: 'Unable to load payment details', icon: 'fas fa-times' });
                n.show(); setTimeout(function(){ n.hide(); }, 3000);
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
                    var rsCanPay = (inst.installment_number == 1 && rs_can_pay_initial) || (inst.installment_number > 1 && rs_can_pay_other);
                    if (rsCanPay) {
                        html += '<button class="btn btn-success btn-xs me-1" onclick="recordPayment(' + inst.installment_id + ', ' + remaining.toFixed(2) + ')"><i class="fas fa-money-bill"></i> Pay</button>';
                    }
                }
                if (inst.payment_status == 'PAID' || inst.payment_status == 'PARTIAL') {
                    html += '<button class="btn btn-info btn-xs" onclick="viewReceipts(' + inst.installment_id + ')" title="Receipts"><i class="fas fa-receipt"></i> Receipt</button>';
                }
                html += '</td>';
                html += '</tr>';
            }
            $('#viewInstallmentsBody').html(html);

            $('#viewModal').modal('show');
        }
    });
}

function paymentTodayDMY() {
    var today = new Date();
    return String(today.getDate()).padStart(2, '0') + '/' + String(today.getMonth() + 1).padStart(2, '0') + '/' + today.getFullYear();
}

function recordPayment(installmentId, dueAmount) {
    $('#payment_installment_id').val(installmentId);
    $('#payment_due_amount').val('₹' + dueAmount.toFixed(2));
    $('#payment_amount').val(dueAmount.toFixed(2));
    $('#payment_date').val(paymentTodayDMY());
    if (!$('#payment_date').data('datepicker')) {
        $('#payment_date').datepicker({ format: 'dd/mm/yyyy', autoclose: true, todayHighlight: true });
    }
    $('#payment_method').val('');
    $('#payment_reference').val('');
    $('#payment_remarks').val('');
    $('#payment_slip').val('');
    $('#paymentModal').modal('show');
}

function savePayment() {
    var $date = $('#payment_date');
    var $slip = $('#payment_slip');
    var dateValid = /^\d{2}\/\d{2}\/\d{4}$/.test($date.val());
    $date.toggleClass('is-invalid', !dateValid);
    $slip.toggleClass('is-invalid', !$slip.val());
    if (!dateValid || !$slip.val()) {
        var n = new notify({ title: '', style: 'error', message: 'Payment date and payment slip are required.', icon: 'fas fa-times' });
        n.show(); setTimeout(function(){ n.hide(); }, 3000);
        return;
    }

    var formData = new FormData($('#paymentForm')[0]);
    $.ajax({
        url: base_url + 'receipt_scheduler/record_payment',
        type: 'POST',
        data: formData,
        processData: false,
        contentType: false,
        dataType: 'json',
        success: function(response) {
            if (response.error) {
                var n = new notify({ title: '', style: 'error', message: response.message, icon: 'fas fa-times' });
                n.show(); setTimeout(function(){ n.hide(); }, 3000);
            } else {
                $('#paymentModal').modal('hide');
                viewScheduler(currentSchedulerId);
                table.ajax.reload();
                var n = new notify({ title: '', style: 'success', message: response.message, icon: 'fas fa-check' });
                n.show(); setTimeout(function(){ n.hide(); }, 3000);
            }
        }
    });
}

function viewReceipts(installmentId) {
    $.ajax({
        url: base_url + 'receipt_scheduler/get_installment_payments',
        type: 'POST',
        data: { installment_id: installmentId },
        dataType: 'json',
        success: function(payments) {
            var html = '';
            if (payments && payments.length > 0) {
                for (var i = 0; i < payments.length; i++) {
                    var p = payments[i];
                    html += '<tr>';
                    html += '<td>' + formatDate(p.payment_date) + '</td>';
                    html += '<td>₹' + parseFloat(p.payment_amount).toLocaleString('en-IN', { minimumFractionDigits: 2 }) + '</td>';
                    html += '<td>' + (p.payment_method || '-') + '</td>';
                    html += '<td>' + (p.payment_reference || '-') + '</td>';
                    html += '<td>' + (p.payment_received_by_username || '-') + '</td>';
                    html += '<td><button class="btn btn-primary btn-xs" onclick="printReceipt(' + p.payment_id + ')"><i class="fas fa-print"></i> Print</button></td>';
                    html += '</tr>';
                }
            } else {
                html += '<tr><td colspan="6" class="text-center text-muted">No payments found</td></tr>';
            }
            $('#receiptsTableBody').html(html);
            $('#receiptsModal').modal('show');
        }
    });
}

function printReceipt(paymentId) {
    var url = base_url + 'receipt_scheduler/print_receipt/' + paymentId;
    window.open(url, '_blank', 'width=800,height=700');
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
                var n = new notify({ title: '', style: 'error', message: response.message, icon: 'fas fa-times' });
                n.show(); setTimeout(function(){ n.hide(); }, 3000);
            } else {
                table.ajax.reload();
                var n = new notify({ title: '', style: 'success', message: response.message, icon: 'fas fa-check' });
                n.show(); setTimeout(function(){ n.hide(); }, 3000);
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
        var amt = parseFloat($(this).val()) || 0;
        $('#emi_total_display').text('₹' + amt.toLocaleString('en-IN', { minimumFractionDigits: 2 }));
        generateEmiRows();
    } else if ($('#payment_type').val() == 'FULL') {
        var amt = parseFloat($(this).val()) || 0;
        $('#full_total_display').text('₹' + amt.toLocaleString('en-IN', { minimumFractionDigits: 2 }));
    }
});

$(document).on('change input', '.emi-amount', function() {
    redistributeEmiAmounts($(this));
});

$(document).on('change input', '.emi-percentage', function() {
    redistributeEmiAmounts($(this));
});

function updateCutoffDateDisplay() {
    var dateVal = $('#cutoff_date').val();
    $('#cutoff_date_display').text(formatDateSlashDMY(dateVal));
}

function formatDateSlashDMY(dateStr) {
    if (!dateStr) return '';
    var parts = dateStr.split('-');
    if (parts.length !== 3) return dateStr;
    return parts[2] + '/' + parts[1] + '/' + parts[0];
}

function parseDateSlashDMY(dateStr) {
    if (!dateStr) return '';
    var parts = dateStr.split('/');
    if (parts.length !== 3) return dateStr;
    return parts[2] + '-' + parts[1] + '-' + parts[0];
}

function initEmiDatepickers() {
    $('#emiTableBody .emi-due-date').datepicker({
        format: 'dd/mm/yyyy',
        autoclose: true,
        todayHighlight: true
    }).off('changeDate.emi').on('changeDate.emi', function() {
        var val = $(this).val();
        $(this).closest('tr').find('.emi-due-date-hidden').val(parseDateSlashDMY(val));
    });
}

$('#cutoff_date').on('change', function() {
    updateCutoffDateDisplay();
});

$(document).on('change', '#emiTableBody .emi-due-date', function() {
    var val = $(this).val();
    $(this).closest('tr').find('.emi-due-date-hidden').val(parseDateSlashDMY(val));
});
</script>
