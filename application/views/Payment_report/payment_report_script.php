<script type="text/javascript">
var base_url = '<?php echo base_url(); ?>index.php/';
var paymentReportTable;
var can_approve_payment = <?php echo has_permission('RECEIPT_SCHEDULER_APPROVE_PAYMENT') ? 'true' : 'false'; ?>;
var cp_can_pay_initial = <?php echo (has_permission('RECEIPT_SCHEDULER_PAY_INITIAL') || has_permission('PAYMENT_REPORT')) ? 'true' : 'false'; ?>;
var cp_can_pay_other = <?php echo (has_permission('RECEIPT_SCHEDULER_PAY_OTHER') || has_permission('PAYMENT_REPORT')) ? 'true' : 'false'; ?>;
var can_record_property_payment = <?php echo (has_permission('PROPERTY_RESERVATION') || has_permission('PROPERTY_PAYMENTS_REPORT') || has_permission('PAYMENT_REPORT')) ? 'true' : 'false'; ?>;
var currentQuotationId = null;
var currentCustomerSchedulerId = null;
var currentPropertySchedulerIds = [];
var currentPropertySchedulerId = null;
var currentHistoryInstallmentId = null;
var currentPropertyHistoryInstallmentId = null;
var pendingApprovePaymentId = null;

$(document).ready(function() {
    loadPaymentReportTable();

    // Fix: nested modal scrolling - when child modal closes, restore modal-open on body if parent is still visible
    ['recordCustomerPaymentModal', 'viewCustomerPaymentsModal', 'recordPropertyPaymentModal', 'viewPropertyPaymentsModal', 'approveConfirmModal'].forEach(function(childModalId) {
        $('#' + childModalId).on('hidden.bs.modal', function () {
            if ($('#paymentDetailsModal').hasClass('show')) {
                document.body.classList.add('modal-open');
            }
        });
    });
    $('#paymentDetailsModal').on('hidden.bs.modal', function () {
        document.body.classList.remove('modal-open');
    });

    if ($.fn.datepicker) {
        $('.datepicker').datepicker({
            format: 'dd/mm/yyyy',
            autoclose: true,
            todayHighlight: true
        });
    }

    $('#property-tab').on('shown.bs.tab', function() {
        if (currentQuotationId && currentPropertySchedulerIds.length > 0) {
            loadAllPropertyPaymentDetails(currentPropertySchedulerIds);
        }
    });

    $('#propertyPaymentContent').on('show.bs.collapse', '.collapse', function() {
        var $card = $(this).closest('.card');
        $card.find('.toggle-icon').removeClass('fa-chevron-right').addClass('fa-chevron-down');
        $card.find('.card-header .badge').removeClass('bg-secondary').addClass('bg-success').text('Open');
    });

    $('#propertyPaymentContent').on('hide.bs.collapse', '.collapse', function() {
        var $card = $(this).closest('.card');
        $card.find('.toggle-icon').removeClass('fa-chevron-down').addClass('fa-chevron-right');
        $card.find('.card-header .badge').removeClass('bg-success').addClass('bg-secondary').text('Closed');
    });
});

function loadPaymentReportTable() {
    paymentReportTable = $('#payment_report_table').DataTable({
        "processing": true,
        "serverSide": true,
        "order": [],
        "searching": false,
        "ajax": {
            "url": base_url + "Payment_report/get_payment_report_table",
            "type": "POST",
            "data": function(d) {
                d.quotation_number_filter = $('#filter_quotation_number').val();
                d.guest_name_filter = $('#filter_guest_name').val();
                d.customer_payment_status_filter = $('#filter_customer_payment_status').val();
                d.customer_approval_filter = $('#filter_customer_approval').val();
                d.property_payment_status_filter = $('#filter_property_payment_status').val();
            }
        },
        "columnDefs": [
            { "targets": [0, -1], "orderable": false },
            { "targets": -1, "width": "80px", "orderable": false }
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
            { data: "whats_number", render: function(data) { return data || '-'; } },
            {
                data: "customer_payment_statuses",
                render: function(data, type, row) {
                    if (row.has_customer_scheduler == 0) {
                        return '<span class="badge bg-secondary">No Scheduler</span>';
                    }
                    if (!data) return '<span class="badge bg-secondary">No Data</span>';
                    var statuses = data.split(',');
                    var badges = '';
                    if (statuses.indexOf('OVERDUE') >= 0) {
                        badges += '<span class="badge bg-danger me-1">Overdue</span>';
                    }
                    if (statuses.indexOf('PENDING') >= 0) {
                        badges += '<span class="badge bg-danger me-1">Pending</span>';
                    }
                    if (statuses.indexOf('PARTIAL') >= 0) {
                        badges += '<span class="badge bg-warning me-1">Partial</span>';
                    }
                    if (statuses.indexOf('PAID') >= 0 && statuses.length === 1) {
                        badges += '<span class="badge bg-success me-1">Paid</span>';
                    }
                    if (statuses.indexOf('PAID') >= 0 && statuses.length > 1) {
                        badges += '<span class="badge bg-success me-1">Some Paid</span>';
                    }
                    return badges || '<span class="badge bg-secondary">-</span>';
                }
            },
            {
                data: "customer_approval_pending",
                render: function(data, type, row) {
                    if (row.has_customer_scheduler == 0) {
                        return '<span class="text-muted">-</span>';
                    }
                    if (data > 0) {
                        return '<span class="badge bg-warning">' + data + ' Pending</span>';
                    }
                    return '<span class="badge bg-success">All Approved</span>';
                }
            },
            {
                data: "property_payment_statuses",
                render: function(data, type, row) {
                    if (row.has_property_scheduler == 0) {
                        return '<span class="badge bg-secondary">No Scheduler</span>';
                    }
                    if (!data) return '<span class="badge bg-secondary">No Data</span>';
                    var statuses = data.split(',');
                    var badges = '';
                    if (statuses.indexOf('OVERDUE') >= 0) {
                        badges += '<span class="badge bg-danger me-1">Overdue</span>';
                    }
                    if (statuses.indexOf('PENDING') >= 0) {
                        badges += '<span class="badge bg-danger me-1">Pending</span>';
                    }
                    if (statuses.indexOf('PARTIAL') >= 0) {
                        badges += '<span class="badge bg-warning me-1">Partial</span>';
                    }
                    if (statuses.indexOf('PAID') >= 0 && statuses.length === 1) {
                        badges += '<span class="badge bg-success me-1">Paid</span>';
                    }
                    if (statuses.indexOf('PAID') >= 0 && statuses.length > 1) {
                        badges += '<span class="badge bg-success me-1">Some Paid</span>';
                    }
                    return badges || '<span class="badge bg-secondary">-</span>';
                }
            },
            {
                data: null,
                render: function(data, type, row) {
                    return '<div class="d-flex">' +
                        '<button type="button" class="btn btn-info shadow btn-xs sharp me-1" onclick="viewPaymentDetails(' + row.quotation_id + ', ' + row.has_customer_scheduler + ', ' + row.has_property_scheduler + ')" title="View Payment Details"><i class="fas fa-eye"></i></button>' +
                        '</div>';
                }
            }
        ]
    });
}

function togglePaymentReportFilters() {
    $('#paymentReportFilterSection').slideToggle();
}

function applyPaymentReportFilters() {
    paymentReportTable.ajax.reload();
}

function clearPaymentReportFilters() {
    $('#filter_quotation_number').val('');
    $('#filter_guest_name').val('');
    $('#filter_customer_payment_status').val('');
    $('#filter_customer_approval').val('');
    $('#filter_property_payment_status').val('');
    paymentReportTable.ajax.reload();
}

function viewPaymentDetails(quotationId, hasCustomer, hasProperty) {
    currentQuotationId = quotationId;
    currentCustomerSchedulerId = 0;
    currentPropertySchedulerId = 0;
    currentPropertySchedulerIds = [];

    $('#customerPaymentContent').html('<div class="text-center text-muted py-4">Loading customer payment details...</div>');
    $('#propertyPaymentContent').html('<div class="text-center text-muted py-4">Loading property payment details...</div>');

    $.ajax({
        url: base_url + 'Quotation/ajax_get_quotation_basic_info',
        type: 'POST',
        data: { quotation_id: quotationId },
        dataType: 'json',
        success: function(response) {
            if (response && response.status) {
                var d = response.data;
                $('#pd_quotation_number').text(d.quotation_number || '-');
                $('#pd_guest_name').text(d.guest_name || '-');
                $('#pd_phone').text(d.whats_number || '-');
            }

            if (hasProperty > 0) {
                $('#property-tab').css('pointer-events', '').css('opacity', '');
                loadPropertySchedulerId(quotationId);
            } else {
                $('#property-tab').css('pointer-events', 'none').css('opacity', '0.5');
                $('#propertyPaymentContent').html('<div class="text-center text-muted py-4">No property payment scheduler found.</div>');
            }
        },
        error: function() {
            $('#pd_quotation_number').text('-');
            $('#pd_guest_name').text('-');
            $('#pd_phone').text('-');
            $('#property-tab').css('pointer-events', 'none').css('opacity', '0.5');
            $('#propertyPaymentContent').html('<div class="text-center text-muted py-4">No property payment scheduler found.</div>');
        }
    });

    if (hasCustomer > 0) {
        $('#customer-tab').css('pointer-events', '').css('opacity', '');
        loadCustomerSchedulerId(quotationId);
    } else {
        $('#customer-tab').css('pointer-events', 'none').css('opacity', '0.5');
        $('#customerPaymentContent').html('<div class="text-center text-muted py-4">No customer payment scheduler found.</div>');
    }

    // Reset to customer tab first
    $('#customer-tab').removeClass('active');
    $('#property-tab').removeClass('active');
    $('#customerPaymentPane').removeClass('show active');
    $('#propertyPaymentPane').removeClass('show active');
    $('#customer-tab').addClass('active');
    $('#customerPaymentPane').addClass('show active');

    $('#paymentDetailsModal').modal('show');
}

function loadCustomerSchedulerId(quotationId) {
    $.ajax({
        url: base_url + 'receipt_scheduler/get_scheduler_by_quotation',
        type: 'POST',
        data: { quotation_id: quotationId },
        dataType: 'json',
        success: function(response) {
            if (response && response.receipt_scheduler_id) {
                currentCustomerSchedulerId = response.receipt_scheduler_id;
                loadCustomerPaymentDetails(response.receipt_scheduler_id);
            } else {
                $('#customerPaymentContent').html('<div class="text-center text-muted py-4">No customer payment scheduler found.</div>');
            }
        },
        error: function() {
            $('#customerPaymentContent').html('<div class="text-center text-danger py-4">Failed to load customer payment details.</div>');
        }
    });
}

function loadPropertySchedulerId(quotationId) {
    $.ajax({
        url: base_url + 'property_reservation/get_property_scheduler_by_quotation',
        type: 'POST',
        data: { quotation_id: quotationId },
        dataType: 'json',
        success: function(response) {
            if (response && response.property_payment_scheduler_ids && response.property_payment_scheduler_ids.length > 0) {
                currentPropertySchedulerIds = response.property_payment_scheduler_ids;
                currentPropertySchedulerId = response.property_payment_scheduler_ids[0];
                loadAllPropertyPaymentDetails(response.property_payment_scheduler_ids);
            } else {
                $('#propertyPaymentContent').html('<div class="text-center text-muted py-4">No property payment scheduler found.</div>');
            }
        },
        error: function() {
            $('#propertyPaymentContent').html('<div class="text-center text-danger py-4">Failed to load property payment details.</div>');
        }
    });
}

function loadCustomerPaymentDetails(schedulerId) {
    $.ajax({
        url: base_url + 'receipt_scheduler/get_payment_summary',
        type: 'POST',
        data: { receipt_scheduler_id: schedulerId },
        dataType: 'json',
        success: function(response) {
            if (!response || !response.scheduler) {
                $('#customerPaymentContent').html('<div class="text-center text-muted py-4">Unable to load payment details.</div>');
                return;
            }

            var scheduler = response.scheduler;
            var html = '';

            html += '<div class="row mb-3">';
            html += '<div class="col-md-12"><strong>Payment Type:</strong> ' + (scheduler.payment_type == 'FULL' ? '<span class="badge bg-primary">Full Payment</span>' : '<span class="badge bg-info">EMI</span>') + '</div>';
            html += '</div>';

            html += '<div class="row mb-3">';
            html += '<div class="col-md-3"><div style="background:#fff;border-radius:8px;padding:14px 16px;text-align:center;box-shadow:0 1px 3px rgba(0,0,0,.08);border:1px solid #e5e7eb;"><div style="font-size:11px;text-transform:uppercase;letter-spacing:.5px;color:#6b7280;margin-bottom:6px;">Total</div><div style="font-size:18px;font-weight:700;color:#64748b;">₹' + parseFloat(response.total_amount).toLocaleString('en-IN', { minimumFractionDigits: 2 }) + '</div></div></div>';
            html += '<div class="col-md-3"><div style="background:linear-gradient(135deg,#2e7d32,#388e3c);border-radius:8px;padding:14px 16px;text-align:center;box-shadow:0 1px 3px rgba(0,0,0,.08);"><div style="font-size:11px;text-transform:uppercase;letter-spacing:.5px;color:rgba(255,255,255,.8);margin-bottom:6px;">Paid</div><div style="font-size:18px;font-weight:700;color:#fff;">₹' + parseFloat(response.total_paid).toLocaleString('en-IN', { minimumFractionDigits: 2 }) + '</div></div></div>';
            html += '<div class="col-md-3"><div style="background:linear-gradient(135deg,#f59e0b,#d97706);border-radius:8px;padding:14px 16px;text-align:center;box-shadow:0 1px 3px rgba(0,0,0,.08);"><div style="font-size:11px;text-transform:uppercase;letter-spacing:.5px;color:rgba(255,255,255,.8);margin-bottom:6px;">Pending</div><div style="font-size:18px;font-weight:700;color:#fff;">₹' + parseFloat(response.pending_amount).toLocaleString('en-IN', { minimumFractionDigits: 2 }) + '</div></div></div>';
            html += '<div class="col-md-3"><div style="background:linear-gradient(135deg,#dc2626,#b91c1c);border-radius:8px;padding:14px 16px;text-align:center;box-shadow:0 1px 3px rgba(0,0,0,.08);"><div style="font-size:11px;text-transform:uppercase;letter-spacing:.5px;color:rgba(255,255,255,.8);margin-bottom:6px;">Overdue</div><div style="font-size:18px;font-weight:700;color:#fff;">' + response.overdue_count + '</div></div></div>';
            html += '</div>';

            html += '<div class="option-block" style="margin-bottom:0;">';
            html += '<div style="background:linear-gradient(135deg,#4a3ee0,#5a4ff0);color:#fff;padding:10px 16px;border-radius:8px 8px 0 0;font-size:15px;font-weight:700;"><i class="fas fa-list me-1"></i> Installments</div>';
            html += '<div style="background:#fff;border-radius:0 0 8px 8px;overflow:hidden;box-shadow:0 1px 3px rgba(0,0,0,.08);">';
            html += '<div class="table-responsive">';
            html += '<table class="table table-bordered table-sm mb-0"><thead><tr><th style="background:#eef2ff;color:#4a3ee0;font-size:12px;text-transform:uppercase;letter-spacing:.3px;">#</th><th style="background:#eef2ff;color:#4a3ee0;font-size:12px;text-transform:uppercase;letter-spacing:.3px;">Due Date</th><th style="background:#eef2ff;color:#4a3ee0;font-size:12px;text-transform:uppercase;letter-spacing:.3px;">Amount</th><th style="background:#eef2ff;color:#4a3ee0;font-size:12px;text-transform:uppercase;letter-spacing:.3px;">Paid</th><th style="background:#eef2ff;color:#4a3ee0;font-size:12px;text-transform:uppercase;letter-spacing:.3px;">Status</th><th style="background:#eef2ff;color:#4a3ee0;font-size:12px;text-transform:uppercase;letter-spacing:.3px;">Action</th></tr></thead><tbody>';

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
                    html += '<button class="btn btn-info btn-xs" onclick="viewCustomerPaymentHistory(' + inst.installment_id + ')" title="Payment History"><i class="fas fa-receipt"></i> Payment History</button>';
                }
                html += '</td>';
                html += '</tr>';
            }

            html += '</tbody></table></div></div></div>';
            $('#customerPaymentContent').html(html);
        },
        error: function() {
            $('#customerPaymentContent').html('<div class="text-center text-danger py-4">Failed to load customer payment details.</div>');
        }
    });
}

function loadAllPropertyPaymentDetails(schedulerIds) {
    if (!schedulerIds || schedulerIds.length === 0) {
        $('#propertyPaymentContent').html('<div class="text-center text-muted py-4">No property payment scheduler found.</div>');
        return;
    }

    $('#propertyPaymentContent').html('<div class="text-center text-muted py-4">Loading property payment details...</div>');
    var allHtml = '';
    var completed = 0;
    var failed = 0;

    schedulerIds.forEach(function(schedulerId, idx) {
        loadSinglePropertyPaymentDetails(schedulerId, idx, function(html) {
            allHtml += html;
            completed++;
            if (completed + failed === schedulerIds.length) {
                if (allHtml) {
                    $('#propertyPaymentContent').html(allHtml);
                } else {
                    $('#propertyPaymentContent').html('<div class="text-center text-muted py-4">No property payment details found.</div>');
                }
            }
        }, function() {
            failed++;
            if (completed + failed === schedulerIds.length) {
                if (allHtml) {
                    $('#propertyPaymentContent').html(allHtml);
                } else {
                    $('#propertyPaymentContent').html('<div class="text-center text-danger py-4">Failed to load property payment details.</div>');
                }
            }
        });
    });
}

function loadSinglePropertyPaymentDetails(schedulerId, idx, onSuccess, onError) {
    $.ajax({
        url: base_url + 'property_reservation/get_property_payment_summary',
        type: 'POST',
        data: { scheduler_id: schedulerId },
        dataType: 'json',
        success: function(response) {
            if (!response || !response.payment) {
                onSuccess('');
                return;
            }

            var scheduler = response.payment;
            var collapseId = 'propertyCollapse_' + schedulerId;
            var isExpanded = (idx === 0);
            var html = '';

            html += '<div class="property-payment-block mb-3" data-scheduler-id="' + schedulerId + '">';
            html += '<div class="card">';
            html += '<div class="card-header d-flex justify-content-between align-items-center" style="cursor:pointer;" data-bs-toggle="collapse" data-bs-target="#' + collapseId + '">';
            html += '<h5 class="mb-0 text-primary"><i class="fas fa-chevron-' + (isExpanded ? 'down' : 'right') + ' me-2 toggle-icon"></i>' + (scheduler.properties_name || 'Property') + '</h5>';
            html += '<span class="badge ' + (isExpanded ? 'bg-success' : 'bg-secondary') + '">' + (isExpanded ? 'Open' : 'Closed') + '</span>';
            html += '</div>';
            html += '<div class="collapse' + (isExpanded ? ' show' : '') + '" id="' + collapseId + '">';
            html += '<div class="card-body">';

            html += '<div class="row mb-3">';
            html += '<div class="col-md-12"><strong>Payment Type:</strong> ' + (scheduler.payment_type == 'FULL' ? '<span class="badge bg-primary">Full Payment</span>' : '<span class="badge bg-info">EMI</span>') + '</div>';
            html += '</div>';

            html += '<div class="row mb-3">';
            html += '<div class="col-md-3"><div style="background:#fff;border-radius:8px;padding:14px 16px;text-align:center;box-shadow:0 1px 3px rgba(0,0,0,.08);border:1px solid #e5e7eb;"><div style="font-size:11px;text-transform:uppercase;letter-spacing:.5px;color:#6b7280;margin-bottom:6px;">Total</div><div style="font-size:18px;font-weight:700;color:#64748b;">₹' + parseFloat(response.net_total).toLocaleString('en-IN', { minimumFractionDigits: 2 }) + '</div></div></div>';
            html += '<div class="col-md-3"><div style="background:linear-gradient(135deg,#2e7d32,#388e3c);border-radius:8px;padding:14px 16px;text-align:center;box-shadow:0 1px 3px rgba(0,0,0,.08);"><div style="font-size:11px;text-transform:uppercase;letter-spacing:.5px;color:rgba(255,255,255,.8);margin-bottom:6px;">Paid</div><div style="font-size:18px;font-weight:700;color:#fff;">₹' + parseFloat(response.total_paid).toLocaleString('en-IN', { minimumFractionDigits: 2 }) + '</div></div></div>';
            html += '<div class="col-md-3"><div style="background:linear-gradient(135deg,#f59e0b,#d97706);border-radius:8px;padding:14px 16px;text-align:center;box-shadow:0 1px 3px rgba(0,0,0,.08);"><div style="font-size:11px;text-transform:uppercase;letter-spacing:.5px;color:rgba(255,255,255,.8);margin-bottom:6px;">Pending</div><div style="font-size:18px;font-weight:700;color:#fff;">₹' + parseFloat(response.pending).toLocaleString('en-IN', { minimumFractionDigits: 2 }) + '</div></div></div>';
            html += '<div class="col-md-3"><div style="background:linear-gradient(135deg,#dc2626,#b91c1c);border-radius:8px;padding:14px 16px;text-align:center;box-shadow:0 1px 3px rgba(0,0,0,.08);"><div style="font-size:11px;text-transform:uppercase;letter-spacing:.5px;color:rgba(255,255,255,.8);margin-bottom:6px;">Overdue</div><div style="font-size:18px;font-weight:700;color:#fff;">' + response.overdue_count + '</div></div></div>';
            html += '</div>';

            html += '<div class="option-block" style="margin-bottom:0;">';
            html += '<div style="background:linear-gradient(135deg,#4a3ee0,#5a4ff0);color:#fff;padding:10px 16px;border-radius:8px 8px 0 0;font-size:15px;font-weight:700;"><i class="fas fa-list me-1"></i> Installments</div>';
            html += '<div style="background:#fff;border-radius:0 0 8px 8px;overflow:hidden;box-shadow:0 1px 3px rgba(0,0,0,.08);">';
            html += '<div class="table-responsive">';
            html += '<table class="table table-bordered table-sm mb-0"><thead><tr><th style="background:#eef2ff;color:#4a3ee0;font-size:12px;text-transform:uppercase;letter-spacing:.3px;">#</th><th style="background:#eef2ff;color:#4a3ee0;font-size:12px;text-transform:uppercase;letter-spacing:.3px;">Due Date</th><th style="background:#eef2ff;color:#4a3ee0;font-size:12px;text-transform:uppercase;letter-spacing:.3px;">Amount</th><th style="background:#eef2ff;color:#4a3ee0;font-size:12px;text-transform:uppercase;letter-spacing:.3px;">Paid</th><th style="background:#eef2ff;color:#4a3ee0;font-size:12px;text-transform:uppercase;letter-spacing:.3px;">Status</th><th style="background:#eef2ff;color:#4a3ee0;font-size:12px;text-transform:uppercase;letter-spacing:.3px;">Action</th></tr></thead><tbody>';

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
                    if (can_record_property_payment) {
                        html += '<button class="btn btn-success btn-xs me-1" onclick="openRecordPropertyPayment(' + inst.installment_id + ', ' + schedulerId + ', ' + remaining.toFixed(2) + ')"><i class="fas fa-money-bill"></i> Pay</button>';
                    }
                }
                if (inst.payment_status == 'PAID' || inst.payment_status == 'PARTIAL') {
                    html += '<button class="btn btn-info btn-xs" onclick="viewPropertyPaymentHistory(' + inst.installment_id + ')" title="Payment History"><i class="fas fa-receipt"></i> Payment History</button>';
                }
                html += '</td>';
                html += '</tr>';
            }

            html += '</tbody></table></div></div></div>';
            html += '</div>'; // card-body
            html += '</div>'; // collapse
            html += '</div>'; // card
            html += '</div>'; // property-payment-block

            onSuccess(html);
        },
        error: function() {
            onError();
        }
    });
}

function loadPropertyPaymentDetails(schedulerId) {
    loadAllPropertyPaymentDetails([schedulerId]);
}

// ===== Customer Payment Functions =====

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

    $('#recordCustomerPaymentModal').modal('show');
}

function submitCustomerPayment() {
    var amount = $.trim($('#cp_payment_amount').val());
    var date   = $.trim($('#cp_payment_date').val());
    var slip   = $('#cp_payment_slip')[0].files[0];

    if (amount == '' || isNaN(amount) || parseFloat(amount) <= 0) {
        var n = new notify({ title: '', style: 'error', message: 'Please enter a valid payment amount greater than 0.', icon: 'fas fa-times' });
        n.show(); setTimeout(function(){ n.hide(); }, 3000);
        $('#cp_payment_amount').focus();
        return;
    }

    var datePattern = /^\d{2}\/\d{2}\/\d{4}$/;
    if (!datePattern.test(date)) {
        var n = new notify({ title: '', style: 'error', message: 'Payment date must be in dd/mm/yyyy format.', icon: 'fas fa-times' });
        n.show(); setTimeout(function(){ n.hide(); }, 3000);
        $('#cp_payment_date').focus();
        return;
    }

    if (!slip) {
        var n = new notify({ title: '', style: 'error', message: 'Please upload a payment slip.', icon: 'fas fa-times' });
        n.show(); setTimeout(function(){ n.hide(); }, 3000);
        $('#cp_payment_slip').focus();
        return;
    }

    var formData = new FormData($('#recordCustomerPaymentForm')[0]);

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
                $('#recordCustomerPaymentModal').modal('hide');
                paymentReportTable.ajax.reload();
                if (currentCustomerSchedulerId) {
                    loadCustomerPaymentDetails(currentCustomerSchedulerId);
                }
                var n = new notify({ title: '', style: 'success', message: response.message, icon: 'fas fa-check' });
                n.show(); setTimeout(function(){ n.hide(); }, 3000);
            }
        },
        error: function() {
            var n = new notify({ title: '', style: 'error', message: 'Failed to record payment.', icon: 'fas fa-times' });
            n.show(); setTimeout(function(){ n.hide(); }, 3000);
        }
    });
}

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
                    var slipLink = payment.payment_slip
                        ? '<a href="<?php echo base_url(); ?>uploads/payment_slips/' + payment.payment_slip + '" target="_blank" class="btn btn-primary shadow btn-xs sharp me-1" title="Payment Slip"><i class="fas fa-file-alt"></i></a>'
                        : '';
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
            var n = new notify({ title: '', style: 'error', message: 'Failed to load payment history.', icon: 'fas fa-times' });
            n.show(); setTimeout(function(){ n.hide(); }, 3000);
        }
    });
}

function printCustomerReceipt(paymentId) {
    var url = base_url + 'receipt_scheduler/print_receipt/' + paymentId;
    window.open(url, '_blank', 'width=800,height=700');
}

// ===== Property Payment Functions =====

function openRecordPropertyPayment(installmentId, schedulerId, dueAmount) {
    $('#pp_installment_id').val(installmentId);
    $('#pp_scheduler_id').val(schedulerId);
    $('#pp_installment_amount').val('₹' + parseFloat(dueAmount).toFixed(2));
    $('#pp_payment_amount').val(parseFloat(dueAmount).toFixed(2));

    var today = new Date();
    var dd = String(today.getDate()).padStart(2, '0');
    var mm = String(today.getMonth() + 1).padStart(2, '0');
    var yyyy = today.getFullYear();
    $('#pp_payment_date').val(dd + '/' + mm + '/' + yyyy);
    $('#pp_payment_method').val('');
    $('#pp_payment_reference').val('');
    $('#pp_payment_remarks').val('');
    $('#pp_payment_slip').val('');

    $('#recordPropertyPaymentModal').modal('show');
}

function submitPropertyPayment() {
    var $amount = $('#pp_payment_amount');
    var $date = $('#pp_payment_date');
    var $slip = $('#pp_payment_slip');

    var amountVal = $.trim($amount.val());
    if (amountVal == '' || isNaN(amountVal) || parseFloat(amountVal) <= 0) {
        $amount.addClass('is-invalid');
        var n = new notify({ title: '', style: 'error', message: 'Please enter a valid payment amount greater than 0.', icon: 'fas fa-times' });
        n.show(); setTimeout(function(){ n.hide(); }, 3000);
        $amount.focus();
        return;
    } else {
        $amount.removeClass('is-invalid');
    }

    var dateValid = /^\d{2}\/\d{2}\/\d{4}$/.test($date.val());
    $date.toggleClass('is-invalid', !dateValid);
    $slip.toggleClass('is-invalid', !$slip.val());
    if (!dateValid || !$slip.val()) {
        var msg = !dateValid ? 'Please enter a valid payment date in dd/mm/yyyy format.' : 'Please upload a payment slip.';
        var n = new notify({ title: '', style: 'error', message: msg, icon: 'fas fa-times' });
        n.show(); setTimeout(function(){ n.hide(); }, 3000);
        return;
    }

    var formData = new FormData($('#recordPropertyPaymentForm')[0]);

    $.ajax({
        url: base_url + 'property_reservation/ajax_record_payment',
        type: 'POST',
        data: formData,
        processData: false,
        contentType: false,
        dataType: 'json',
        success: function(response) {
            if (response.error) {
                var n = new notify({ title: '', style: 'error', message: response.message || 'Failed to record payment.', icon: 'fas fa-times' });
                n.show(); setTimeout(function(){ n.hide(); }, 3000);
            } else {
                $('#recordPropertyPaymentModal').modal('hide');
                paymentReportTable.ajax.reload();
                if (currentPropertySchedulerIds.length > 0) {
                    loadAllPropertyPaymentDetails(currentPropertySchedulerIds);
                }
                var n = new notify({ title: '', style: 'success', message: response.message || 'Payment recorded successfully.', icon: 'fas fa-check' });
                n.show(); setTimeout(function(){ n.hide(); }, 3000);
            }
        },
        error: function() {
            var n = new notify({ title: '', style: 'error', message: 'Failed to record payment.', icon: 'fas fa-times' });
            n.show(); setTimeout(function(){ n.hide(); }, 3000);
        }
    });
}

function viewPropertyPaymentHistory(installmentId) {
    currentPropertyHistoryInstallmentId = installmentId;
    $.ajax({
        url: base_url + 'property_reservation/ajax_get_installment_payments',
        type: 'POST',
        data: { installment_id: installmentId },
        dataType: 'json',
        success: function(response) {
            var tbody = $('#propertyPaymentHistoryTable tbody');
            tbody.empty();
            if (response.error || !response.payments || response.payments.length == 0) {
                tbody.append('<tr><td colspan="7" class="text-center text-muted">No payments found</td></tr>');
            } else {
                for (var i = 0; i < response.payments.length; i++) {
                    var payment = response.payments[i];
                    var slipLink = payment.payment_slip
                        ? '<a href="<?php echo base_url(); ?>uploads/payment_slips/' + payment.payment_slip + '" target="_blank" class="btn btn-primary shadow btn-xs sharp me-1" title="Payment Slip"><i class="fas fa-file-alt"></i></a>'
                        : '';
                    var actionHtml = '<div class="d-flex">' + slipLink +
                        '</div>';
                    var row = '<tr>' +
                        '<td>' + (i + 1) + '</td>' +
                        '<td>₹' + parseFloat(payment.payment_amount || 0).toLocaleString('en-IN', { minimumFractionDigits: 2 }) + '</td>' +
                        '<td>' + formatDate(payment.payment_date) + '</td>' +
                        '<td>' + (payment.payment_method || '-') + '</td>' +
                        '<td>' + (payment.payment_reference || '-') + '</td>' +
                        '<td>' + (payment.payment_paid_by_username || '-') + '</td>' +
                        '<td>' + actionHtml + '</td>' +
                        '</tr>';
                    tbody.append(row);
                }
            }
            $('#viewPropertyPaymentsModal').modal('show');
        },
        error: function() {
            var n = new notify({ title: '', style: 'error', message: 'Failed to load payment history.', icon: 'fas fa-times' });
            n.show(); setTimeout(function(){ n.hide(); }, 3000);
        }
    });
}

function printPropertyReceipt(paymentId) {
    var url = base_url + 'property_reservation/print_receipt/' + paymentId;
    window.open(url, '_blank', 'width=800,height=700');
}

// ===== Approve Payment =====

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
                var n = new notify({ title: '', style: 'error', message: response.message || 'Failed to approve payment.', icon: 'fas fa-times' });
                n.show(); setTimeout(function(){ n.hide(); }, 3000);
            } else {
                paymentReportTable.ajax.reload();
                if (currentCustomerSchedulerId) {
                    loadCustomerPaymentDetails(currentCustomerSchedulerId);
                }
                if (currentHistoryInstallmentId && $('#viewCustomerPaymentsModal').is(':visible')) {
                    viewCustomerPaymentHistory(currentHistoryInstallmentId);
                }
                var n = new notify({ title: '', style: 'success', message: response.message || 'Payment approved successfully.', icon: 'fas fa-check' });
                n.show(); setTimeout(function(){ n.hide(); }, 3000);
            }
        },
        error: function() {
            $('#approveConfirmModal').modal('hide');
            pendingApprovePaymentId = null;
            var n = new notify({ title: '', style: 'error', message: 'Failed to approve payment.', icon: 'fas fa-times' });
            n.show(); setTimeout(function(){ n.hide(); }, 3000);
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
