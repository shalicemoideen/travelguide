<script type="text/javascript">
var base_url = '<?php echo base_url(); ?>index.php/';
var customerReportTable;
var can_approve_payment = <?php echo has_permission('RECEIPT_SCHEDULER_APPROVE_PAYMENT') ? 'true' : 'false'; ?>;
var cp_can_pay_initial = <?php echo has_permission('RECEIPT_SCHEDULER_PAY_INITIAL') ? 'true' : 'false'; ?>;
var cp_can_pay_other = <?php echo has_permission('RECEIPT_SCHEDULER_PAY_OTHER') ? 'true' : 'false'; ?>;
var currentSchedulerId = null;
var currentHistoryInstallmentId = null;
var pendingApprovePaymentId = null;

$('#created_date_range').daterangepicker({
    autoUpdateInput: false,
    locale: {
        format: 'DD/MM/YYYY',
        cancelLabel: 'Clear'
    }
});

$('#created_date_range').on('apply.daterangepicker', function(ev, picker) {
    $(this).val(picker.startDate.format('DD/MM/YYYY') + ' - ' + picker.endDate.format('DD/MM/YYYY'));
});

$('#created_date_range').on('cancel.daterangepicker', function() {
    $(this).val('');
});

$(document).ready(function() {
    loadCustomerPaymentReportTable();

    if ($.fn.datepicker) {
        $('.datepicker').datepicker({
            format: 'dd/mm/yyyy',
            autoclose: true,
            todayHighlight: true
        });
    }
});

function loadCustomerPaymentReportTable() {
    customerReportTable = $('#customer_payment_report_table').DataTable({
        "processing": true,
        "serverSide": true,
        "order": [],
        "searching": false,
        "ajax": {
            "url": base_url + "receipt_scheduler/get_customer_scheduler_report_table",
            "type": "POST",
            "data": function(d) {
                d.quotation_number_filter = $('#filter_quotation_number').val();
                d.guest_name_filter = $('#filter_guest_name').val();
                d.payment_type_filter = $('#filter_payment_type').val();
                var dateRange = $('#created_date_range').val();
                if (dateRange) {
                    var dates = dateRange.split(' - ');
                    d.start_date = dates[0];
                    d.end_date = dates[1];
                } else {
                    d.start_date = '';
                    d.end_date = '';
                }
            }
        },
        "columnDefs": [
            { "targets": [0, -1], "orderable": false },
            { "targets": 9, "width": "80px", "orderable": false }
        ],
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
                    return '₹' + parseFloat(data || 0).toLocaleString('en-IN', { minimumFractionDigits: 2 });
                }
            },
            {
                data: "total_paid",
                render: function(data) {
                    return '₹' + parseFloat(data || 0).toLocaleString('en-IN', { minimumFractionDigits: 2 });
                }
            },
            {
                data: "pending_amount",
                render: function(data) {
                    var amt = parseFloat(data || 0);
                    var cls = amt <= 0 ? 'text-success' : 'text-danger';
                    return '<span class="' + cls + '">₹' + amt.toLocaleString('en-IN', { minimumFractionDigits: 2 }) + '</span>';
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
                    return '<div class="d-flex">' +
                        '<button type="button" class="btn btn-info shadow btn-xs sharp me-1" onclick="viewSchedulerDetails(' + row.receipt_scheduler_id + ')" title="View Details"><i class="fas fa-eye"></i></button>' +
                        '</div>';
                }
            }
        ]
    });
}

function toggleCustomerFilters() {
    $('#customerFilterSection').slideToggle();
}

function applyCustomerReportFilters() {
    customerReportTable.ajax.reload();
}

function clearCustomerReportFilters() {
    $('#filter_quotation_number').val('');
    $('#filter_guest_name').val('');
    $('#filter_payment_type').val('');
    $('#created_date_range').val('');
    customerReportTable.ajax.reload();
}

function viewSchedulerDetails(schedulerId) {
    currentSchedulerId = schedulerId;
    $.ajax({
        url: base_url + 'receipt_scheduler/get_payment_summary',
        type: 'POST',
        data: { receipt_scheduler_id: schedulerId },
        dataType: 'json',
        success: function(response) {
            if (!response || !response.scheduler) {
                alert('Unable to load payment details');
                return;
            }

            var scheduler = response.scheduler;
            $('#cpd_quotation_number').text(scheduler.quotation_number);
            $('#cpd_guest_name').text(scheduler.guest_name);
            $('#cpd_payment_type').html(scheduler.payment_type == 'FULL' ? '<span class="badge bg-primary">Full Payment</span>' : '<span class="badge bg-info">EMI</span>');
            $('#cpd_total_amount').text('₹' + parseFloat(response.total_amount).toLocaleString('en-IN', { minimumFractionDigits: 2 }));
            $('#cpd_total_card').text('₹' + parseFloat(response.total_amount).toLocaleString('en-IN', { minimumFractionDigits: 2 }));
            $('#cpd_paid_amount').text('₹' + parseFloat(response.total_paid).toLocaleString('en-IN', { minimumFractionDigits: 2 }));
            $('#cpd_pending_amount').text('₹' + parseFloat(response.pending_amount).toLocaleString('en-IN', { minimumFractionDigits: 2 }));
            $('#cpd_overdue_count').text(response.overdue_count);

            var html = '';
            var installments = response.installments;
            for (var i = 0; i < installments.length; i++) {
                var inst = installments[i];
                var statusClass = '';
                if (inst.payment_status == 'PAID') statusClass = 'bg-success';
                else if (inst.payment_status == 'PARTIAL') statusClass = 'bg-warning';
                else if (inst.payment_status == 'OVERDUE') statusClass = 'bg-danger';
                else if (inst.payment_status == 'PENDING') statusClass = 'bg-danger';
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
                    var cpCanPay = (inst.installment_number == 1 && cp_can_pay_initial) || (inst.installment_number > 1 && cp_can_pay_other);
                    if (cpCanPay) {
                        html += '<button class="btn btn-success btn-xs me-1" onclick="openRecordCustomerPayment(' + inst.installment_id + ', ' + remaining.toFixed(2) + ')"><i class="fas fa-money-bill"></i> Pay</button>';
                    }
                }
                if (inst.payment_status == 'PAID' || inst.payment_status == 'PARTIAL') {
                    html += '<button class="btn btn-info btn-xs" onclick="viewCustomerPaymentHistory(' + inst.installment_id + ')" title="Payment History"><i class="fas fa-receipt"></i> History</button>';
                }
                html += '</td>';
                html += '</tr>';
            }
            $('#cpdInstallmentsBody').html(html);

            $('#viewSchedulerDetailsModal').modal('show');
        },
        error: function() {
            alert('Failed to load payment details');
        }
    });
}

function openRecordCustomerPayment(installmentId, dueAmount) {
    $('#cp_installment_id').val(installmentId);
    $('#cp_installment_amount').val('₹' + parseFloat(dueAmount).toFixed(2));
    $('#cp_payment_amount').val(parseFloat(dueAmount).toFixed(2));

    var today = new Date();
    var dd = String(today.getDate()).padStart(2, '0');
    var mm = String(today.getMonth() + 1).padStart(2, '0');
    var yyyy = today.getFullYear();
    $('#cp_payment_date').val(dd + '/' + mm + '/' + yyyy);
    $('#cp_payment_method').val('');
    $('#cp_payment_reference').val('');
    $('#cp_payment_remarks').val('');
    $('#cp_payment_slip').val('');
    if (window.resetMultiFiles_cp_payment_slip) { window.resetMultiFiles_cp_payment_slip(); }
    if (!window._cp_payment_slip_picker_init) {
        initMultiFilePicker('cp_payment_slip', 'cp_payment_slip_list');
        window._cp_payment_slip_picker_init = true;
    }

    $('#recordCustomerPaymentModal').modal('show');
}

function submitCustomerPayment() {
    var amount = $.trim($('#cp_payment_amount').val());
    var date   = $.trim($('#cp_payment_date').val());
    var pickedFiles = window.getMultiFiles_cp_payment_slip ? window.getMultiFiles_cp_payment_slip() : [];

    if (amount == '' || isNaN(amount) || parseFloat(amount) <= 0) {
        alert('Please enter a valid payment amount greater than 0.');
        $('#cp_payment_amount').focus();
        return;
    }

    var datePattern = /^\d{2}\/\d{2}\/\d{4}$/;
    if (!datePattern.test(date)) {
        alert('Payment date must be in dd/mm/yyyy format.');
        $('#cp_payment_date').focus();
        return;
    }

    if (pickedFiles.length === 0) {
        alert('Please upload a payment slip.');
        return;
    }

    var formData = new FormData($('#recordCustomerPaymentForm')[0]);
    for (var i = 0; i < pickedFiles.length; i++) {
        formData.append('payment_slip[]', pickedFiles[i]);
    }

    $.ajax({
        url: base_url + 'receipt_scheduler/record_payment',
        type: 'POST',
        data: formData,
        processData: false,
        contentType: false,
        dataType: 'json',
        success: function(response) {
            if (response.error) {
                alert(response.message);
            } else {
                $('#recordCustomerPaymentModal').modal('hide');
                customerReportTable.ajax.reload();
                if (currentSchedulerId) {
                    viewSchedulerDetails(currentSchedulerId);
                }
                alert(response.message);
            }
        },
        error: function() {
            alert('Failed to record payment.');
        }
    });
}

var currentHistoryInstallmentId = null;

function viewCustomerPaymentHistory(installmentId) {
    currentHistoryInstallmentId = installmentId;
    $.ajax({
        url: base_url + 'receipt_scheduler/get_installment_payments',
        type: 'POST',
        data: { installment_id: installmentId },
        dataType: 'json',
        success: function(payments) {
            var tbody = $('#customerPaymentHistoryTable tbody');
            tbody.empty();
            if (!payments || payments.length == 0) {
                tbody.append('<tr><td colspan="8" class="text-center text-muted">No payments found</td></tr>');
            } else {
                for (var i = 0; i < payments.length; i++) {
                    var payment = payments[i];
                    var slipLink = '';
                    if (payment.payment_slip) {
                        var slips = payment.payment_slip.split(',');
                        for (var s = 0; s < slips.length; s++) {
                            slipLink += '<a href="<?php echo base_url(); ?>uploads/payment_slips/' + slips[s] + '" target="_blank" class="btn btn-primary shadow btn-xs sharp me-1" title="Payment Slip ' + (s+1) + '"><i class="fas fa-file-alt"></i></a>';
                        }
                    }
                    var status = payment.accountant_approval_status ? payment.accountant_approval_status : 'pending';
                    var statusBadge = '<span class="badge ' + (status == 'approved' ? 'bg-success' : 'bg-warning') + '">' + status.charAt(0).toUpperCase() + status.slice(1) + '</span>';
                    var actionHtml = '<div class="d-flex">' + slipLink + '<button class="btn btn-primary shadow btn-xs sharp me-1" onclick="printCustomerReceipt(' + payment.payment_id + ')" title="Print Receipt"><i class="fas fa-print"></i></button>';
                    if (status != 'approved' && can_approve_payment) {
                        actionHtml += '<button class="btn btn-warning shadow btn-xs sharp" onclick="approvePaymentFromReport(' + payment.payment_id + ')" title="Approve Payment"><i class="fas fa-check"></i></button>';
                    }
                    actionHtml += '</div>';
                    var row = '<tr>' +
                        '<td>' + (i + 1) + '</td>' +
                        '<td>₹' + parseFloat(payment.payment_amount || 0).toLocaleString('en-IN', { minimumFractionDigits: 2 }) + '</td>' +
                        '<td>' + formatDate(payment.payment_date) + '</td>' +
                        '<td>' + (payment.payment_method || '-') + '</td>' +
                        '<td>' + (payment.payment_reference || '-') + '</td>' +
                        '<td>' + (payment.payment_received_by_username || '-') + '</td>' +
                        '<td>' + statusBadge + '</td>' +
                        '<td>' + actionHtml + '</td>' +
                        '</tr>';
                    tbody.append(row);
                }
            }
            $('#viewCustomerPaymentsModal').modal('show');
        },
        error: function() {
            alert('Failed to load payment history.');
        }
    });
}

function printCustomerReceipt(paymentId) {
    var url = base_url + 'receipt_scheduler/print_receipt/' + paymentId;
    window.open(url, '_blank', 'width=800,height=700');
}

function approvePaymentFromReport(paymentId) {
    pendingApprovePaymentId = paymentId;
    $('#approveConfirmModal').modal('show');
}

function submitApprovePayment() {
    if (!pendingApprovePaymentId) {
        return;
    }

    $.ajax({
        url: base_url + 'receipt_scheduler/approve_payment',
        type: 'POST',
        data: { payment_id: pendingApprovePaymentId },
        dataType: 'json',
        success: function(response) {
            $('#approveConfirmModal').modal('hide');
            pendingApprovePaymentId = null;
            if (response.error) {
                alert(response.message || 'Failed to approve payment.');
            } else {
                customerReportTable.ajax.reload();
                if (currentSchedulerId && $('#viewSchedulerDetailsModal').is(':visible')) {
                    viewSchedulerDetails(currentSchedulerId);
                }
                if (currentHistoryInstallmentId && $('#viewCustomerPaymentsModal').is(':visible')) {
                    viewCustomerPaymentHistory(currentHistoryInstallmentId);
                }
                alert(response.message || 'Payment approved successfully.');
            }
        },
        error: function() {
            $('#approveConfirmModal').modal('hide');
            pendingApprovePaymentId = null;
            alert('Failed to approve payment.');
        }
    });
}

function formatDate(dateStr) {
    if (!dateStr) return '-';
    var date = new Date(dateStr);
    if (isNaN(date.getTime())) return dateStr;
    var day = String(date.getDate()).padStart(2, '0');
    var month = String(date.getMonth() + 1).padStart(2, '0');
    var year = date.getFullYear();
    return day + '-' + month + '-' + year;
}
</script>
