<script type="text/javascript">
var base_url = '<?php echo base_url(); ?>index.php/';
var propertyPaymentReportTable;
var currentPropertySchedulerId = null;
var currentPropertyHistoryInstallmentId = null;
var autoReload = false;

function getUrlParam(name) {
    var results = new RegExp('[?&]' + name + '=([^&#]*)').exec(window.location.href);
    return results ? decodeURIComponent(results[1]) : null;
}

function fmtDate(d) {
    var dd = String(d.getDate()).padStart(2, '0');
    var mm = String(d.getMonth() + 1).padStart(2, '0');
    var yyyy = d.getFullYear();
    return dd + '/' + mm + '/' + yyyy;
}

function getPeriodDates(period) {
    if (period === 'custom') {
        var startParam = getUrlParam('start');
        var endParam   = getUrlParam('end');
        if (startParam && endParam) {
            var s = startParam.split('-');
            var e = endParam.split('-');
            return { start: s[2] + '/' + s[1] + '/' + s[0], end: e[2] + '/' + e[1] + '/' + e[0] };
        }
    }
    var now   = new Date();
    var start = new Date(now);
    var end   = new Date(now);
    if (period === 'week') {
        var dow = now.getDay();
        start   = new Date(now); start.setDate(now.getDate() - dow);
        end     = new Date(now); end.setDate(now.getDate() + (6 - dow));
    } else if (period === 'month') {
        start = new Date(now.getFullYear(), now.getMonth(), 1);
        end   = new Date(now.getFullYear(), now.getMonth() + 1, 0);
    } else if (period === 'year') {
        start = new Date(now.getFullYear(), 0, 1);
        end   = new Date(now.getFullYear(), 11, 31);
    }
    return { start: fmtDate(start), end: fmtDate(end) };
}

function convertDateToYMD(dateStr) {
    if (!dateStr) return '';
    var parts = dateStr.split('/');
    if (parts.length === 3) {
        return parts[2] + '-' + parts[1] + '-' + parts[0];
    }
    return dateStr;
}

$(document).ready(function() {
    if ($.fn.datepicker) {
        $('.datepicker').datepicker({
            format: 'dd/mm/yyyy',
            autoclose: true,
            todayHighlight: true
        });
    }

    if ($.fn.daterangepicker) {
        $('#filter_travel_daterange').daterangepicker({
            autoUpdateInput: false,
            locale: {
                format: 'DD/MM/YYYY',
                cancelLabel: 'Clear'
            }
        });
        $('#filter_travel_daterange').on('apply.daterangepicker', function(ev, picker) {
            $(this).val(picker.startDate.format('DD/MM/YYYY') + ' - ' + picker.endDate.format('DD/MM/YYYY'));
        });
        $('#filter_travel_daterange').on('cancel.daterangepicker', function() {
            $(this).val('');
        });
    }

    var period = getUrlParam('period');
    if (period && period !== '') {
        var dates = getPeriodDates(period);
        $('#filter_travel_daterange').val(dates.start + ' - ' + dates.end);
        $('#propertyPaymentFilterSection').show();
        autoReload = true;
    }

    loadPropertyPaymentReportTable();
});

function loadPropertyPaymentReportTable() {
    propertyPaymentReportTable = $('#property_payment_report_table').DataTable({
        "processing": true,
        "serverSide": true,
        "order": [],
        "searching": false,
        "ajax": {
            "url": base_url + "property_reservation/get_property_scheduler_report_table",
            "type": "POST",
            "data": function(d) {
                d.quotation_number_filter = $('#filter_quotation_number').val();
                d.guest_name_filter = $('#filter_guest_name').val();
                d.property_name_filter = $('#filter_property_name').val();
                d.payment_type_filter = $('#filter_payment_type').val();
                var dr = $('#filter_travel_daterange').val();
                if (dr) {
                    var parts = dr.split(' - ');
                    if (parts.length === 2) {
                        d.travel_date_start = convertDateToYMD(parts[0]);
                        d.travel_date_end = convertDateToYMD(parts[1]);
                    }
                }
            }
        },
        "columnDefs": [
            { "targets": [0, -1], "orderable": false },
            { "targets": 10, "width": "80px", "orderable": false }
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
            { data: "start_date", render: function(data) { return data ? formatDate(data) : '-'; } },
            { data: "properties_name" },
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
                data: "net_total",
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
            {
                data: null,
                render: function(data, type, row) {
                    return '<div class="d-flex">' +
                        '<button type="button" class="btn btn-info shadow btn-xs sharp me-1" onclick="viewPropertySchedulerDetails(' + row.property_payment_scheduler_id + ')" title="View Details"><i class="fas fa-eye"></i></button>' +
                        '</div>';
                }
            }
        ]
    });

    if (autoReload) {
        propertyPaymentReportTable.ajax.reload();
    }
}

function togglePropertyPaymentFilters() {
    $('#propertyPaymentFilterSection').slideToggle();
}

function applyPropertyPaymentReportFilters() {
    propertyPaymentReportTable.ajax.reload();
}

function clearPropertyPaymentReportFilters() {
    $('#filter_quotation_number').val('');
    $('#filter_guest_name').val('');
    $('#filter_property_name').val('');
    $('#filter_payment_type').val('');
    $('#filter_travel_daterange').val('');
    propertyPaymentReportTable.ajax.reload();
}

function viewPropertySchedulerDetails(schedulerId) {
    currentPropertySchedulerId = schedulerId;
    $.ajax({
        url: base_url + 'property_reservation/get_property_payment_summary',
        type: 'POST',
        data: { scheduler_id: schedulerId },
        dataType: 'json',
        success: function(response) {
            if (!response || !response.payment) {
                alert('Unable to load payment details');
                return;
            }

            var scheduler = response.payment;
            $('#ppd_quotation_number').text(scheduler.quotation_number || '-');
            $('#ppd_guest_name').text(scheduler.guest_name || '-');
            $('#ppd_property_name').text(scheduler.properties_name || '-');
            $('#ppd_payment_type').html(scheduler.payment_type == 'FULL' ? '<span class="badge bg-primary">Full Payment</span>' : '<span class="badge bg-info">EMI</span>');
            $('#ppd_total_amount').text('₹' + parseFloat(response.net_total).toLocaleString('en-IN', { minimumFractionDigits: 2 }));
            $('#ppd_paid_amount').text('₹' + parseFloat(response.total_paid).toLocaleString('en-IN', { minimumFractionDigits: 2 }));
            $('#ppd_pending_amount').text('₹' + parseFloat(response.pending).toLocaleString('en-IN', { minimumFractionDigits: 2 }));
            $('#ppd_overdue_count').text(response.overdue_count);

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
                    html += '<button class="btn btn-success btn-xs me-1" onclick="openRecordPropertyPayment(' + inst.installment_id + ', ' + currentPropertySchedulerId + ', ' + remaining.toFixed(2) + ')"><i class="fas fa-money-bill"></i> Pay</button>';
                }
                if (inst.payment_status == 'PAID' || inst.payment_status == 'PARTIAL') {
                    html += '<button class="btn btn-info btn-xs" onclick="viewPropertyPaymentHistory(' + inst.installment_id + ')" title="Payment History"><i class="fas fa-receipt"></i> History</button>';
                }
                html += '</td>';
                html += '</tr>';
            }
            $('#ppdInstallmentsBody').html(html);

            $('#viewPropertySchedulerDetailsModal').modal('show');
        },
        error: function() {
            alert('Failed to load payment details');
        }
    });
}

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
    if (window.resetMultiFiles_pp_payment_slip) { window.resetMultiFiles_pp_payment_slip(); }
    if (!window._pp_payment_slip_picker_init) {
        initMultiFilePicker('pp_payment_slip', 'pp_payment_slip_list');
        window._pp_payment_slip_picker_init = true;
    }

    $('#recordPropertyPaymentModal').modal('show');
}

function submitPropertyPayment() {
    var $amount = $('#pp_payment_amount');
    var $date = $('#pp_payment_date');

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
    var pickedFiles = window.getMultiFiles_pp_payment_slip ? window.getMultiFiles_pp_payment_slip() : [];
    if (!dateValid || pickedFiles.length === 0) {
        var msg = !dateValid ? 'Please enter a valid payment date in dd/mm/yyyy format.' : 'Please upload a payment slip.';
        var n = new notify({ title: '', style: 'error', message: msg, icon: 'fas fa-times' });
        n.show(); setTimeout(function(){ n.hide(); }, 3000);
        return;
    }

    var formData = new FormData($('#recordPropertyPaymentForm')[0]);
    for (var i = 0; i < pickedFiles.length; i++) {
        formData.append('payment_slip[]', pickedFiles[i]);
    }

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
                propertyPaymentReportTable.ajax.reload();
                if (currentPropertySchedulerId) {
                    viewPropertySchedulerDetails(currentPropertySchedulerId);
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
                    var slipLink = '';
                    if (payment.payment_slip) {
                        var slips = payment.payment_slip.split(',');
                        for (var s = 0; s < slips.length; s++) {
                            slipLink += '<a href="<?php echo base_url(); ?>uploads/payment_slips/' + slips[s] + '" target="_blank" class="btn btn-primary shadow btn-xs sharp me-1" title="Payment Slip ' + (s+1) + '"><i class="fas fa-file-alt"></i></a>';
                        }
                    }
                    var actionHtml = '<div class="d-flex">' + slipLink +
                        '<button class="btn btn-primary shadow btn-xs sharp" onclick="printPropertyReceipt(' + payment.payment_id + ')" title="Print Receipt"><i class="fas fa-print"></i></button>' +
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
            alert('Failed to load payment history.');
        }
    });
}

function printPropertyReceipt(paymentId) {
    var url = base_url + 'property_reservation/print_receipt/' + paymentId;
    window.open(url, '_blank', 'width=800,height=700');
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
