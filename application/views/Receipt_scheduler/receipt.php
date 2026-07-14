<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <title>Payment Receipt</title>
    <link rel="stylesheet" href="https://cdn.jsdelivr.net/npm/bootstrap@4.6.2/dist/css/bootstrap.min.css">
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/5.15.4/css/all.min.css">
    <style>
        body {
            background: #f8f9fa;
            padding: 30px 0;
        }
        .receipt-container {
            max-width: 700px;
            margin: 0 auto;
            background: #fff;
            border: 1px solid #dee2e6;
            padding: 40px;
            box-shadow: 0 0 15px rgba(0,0,0,0.05);
        }
        .receipt-header {
            border-bottom: 2px solid #343a40;
            padding-bottom: 20px;
            margin-bottom: 25px;
        }
        .receipt-title {
            font-size: 1.75rem;
            font-weight: 700;
            margin-bottom: 5px;
        }
        .receipt-meta {
            font-size: 0.95rem;
            color: #6c757d;
        }
        .receipt-row {
            margin-bottom: 10px;
        }
        .receipt-label {
            font-weight: 600;
            color: #495057;
        }
        .receipt-amount {
            font-size: 1.5rem;
            font-weight: 700;
            color: #198754;
        }
        .receipt-footer {
            margin-top: 40px;
            padding-top: 20px;
            border-top: 1px solid #dee2e6;
            font-size: 0.9rem;
            color: #6c757d;
        }
        .print-btn {
            margin-bottom: 20px;
        }
        @media print {
            body {
                background: #fff;
                padding: 0;
            }
            .receipt-container {
                border: none;
                box-shadow: none;
                max-width: 100%;
            }
            .no-print {
                display: none !important;
            }
        }
    </style>
</head>
<body>
    <div class="container">
        <div class="text-center no-print">
            <button type="button" class="btn btn-primary print-btn" onclick="window.print()">
                <i class="fas fa-print"></i> Print Receipt
            </button>
        </div>

        <div class="receipt-container">
            <div class="receipt-header d-flex justify-content-between align-items-start">
                <div>
                    <div class="receipt-title">PAYMENT RECEIPT</div>
                    <div class="receipt-meta">Receipt No: REC-<?php echo str_pad($payment->payment_id, 6, '0', STR_PAD_LEFT); ?></div>
                </div>
                <div class="text-right">
                    <div class="receipt-meta">Date: <?php echo date('d/m/Y', strtotime($payment->payment_date)); ?></div>
                </div>
            </div>

            <div class="row receipt-row">
                <div class="col-md-6">
                    <span class="receipt-label">Quotation:</span>
                    <?php echo htmlspecialchars($scheduler->quotation_number ?: '-'); ?>
                </div>
                <div class="col-md-6 text-md-right">
                    <span class="receipt-label">Guest:</span>
                    <?php echo htmlspecialchars($scheduler->guest_name ?: '-'); ?>
                </div>
            </div>

            <div class="row receipt-row">
                <div class="col-md-6">
                    <span class="receipt-label">Installment:</span>
                    EMI <?php echo htmlspecialchars($installment->installment_number); ?>
                </div>
                <div class="col-md-6 text-md-right">
                    <span class="receipt-label">Due Date:</span>
                    <?php echo $installment->due_date ? date('d/m/Y', strtotime($installment->due_date)) : '-'; ?>
                </div>
            </div>

            <div class="row receipt-row">
                <div class="col-md-6">
                    <span class="receipt-label">Payment Method:</span>
                    <?php echo htmlspecialchars($payment->payment_method ?: '-'); ?>
                </div>
                <div class="col-md-6 text-md-right">
                    <span class="receipt-label">Reference:</span>
                    <?php echo htmlspecialchars($payment->payment_reference ?: '-'); ?>
                </div>
            </div>

            <div class="row receipt-row mt-4">
                <div class="col-12">
                    <span class="receipt-label">Amount Received:</span>
                    <div class="receipt-amount">₹<?php echo number_format((float)$payment->payment_amount, 2); ?></div>
                </div>
            </div>

            <?php if (!empty($payment->payment_remarks)) { ?>
            <div class="row receipt-row mt-3">
                <div class="col-12">
                    <span class="receipt-label">Remarks:</span>
                    <?php echo nl2br(htmlspecialchars($payment->payment_remarks)); ?>
                </div>
            </div>
            <?php } ?>

            <div class="receipt-footer">
                <div class="row">
                    <div class="col-md-6">
                        <span class="receipt-label">Received By:</span><br>
                        <?php echo htmlspecialchars($payment->payment_received_by_username ?: '-'); ?>
                    </div>
                    <div class="col-md-6 text-md-right">
                        <span class="receipt-label">Total Schedule Amount:</span><br>
                        ₹<?php echo number_format((float)$scheduler->total_amount, 2); ?>
                    </div>
                </div>
                <div class="text-center mt-4">
                    <small>This is a computer generated receipt and does not require signature.</small>
                </div>
            </div>
        </div>
    </div>
</body>
</html>
