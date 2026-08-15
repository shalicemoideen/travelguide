<?php
// Format date helper
function nice_date($date) {
    if (!$date || $date == '0000-00-00') return '-';
    return date('d F Y', strtotime($date));
}

function short_date($date) {
    if (!$date || $date == '0000-00-00') return '-';
    return date('d M Y', strtotime($date));
}

function getDayName($date) {
    if (!$date || $date == '0000-00-00') return '-';
    return date('D', strtotime($date));
}

// Safe array access helper
function get($arr, $key, $default = '') {
    return isset($arr[$key]) ? $arr[$key] : $default;
}

$main = isset($main) ? $main : [];
$rooms = isset($rooms) ? $rooms : [];
$inclusions = isset($inclusions) ? $inclusions : [];
$account = isset($account) ? $account : [];

// Calculate totals
$totalNights = isset($main['duration']) ? (int)$main['duration'] : 0;
$totalDays = $totalNights + 1;
?>
<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Confirmation - <?php echo htmlspecialchars(get($main, 'quotation_number', 'N/A')); ?></title>
    <link href="<?php echo base_url(); ?>assets/vendor/bootstrap/css/bootstrap.min.css" rel="stylesheet">
    <link href="<?php echo base_url(); ?>assets/vendor/line-awesome/css/line-awesome.min.css" rel="stylesheet">
    <style>
        body {
            font-family: Arial, sans-serif;
            font-size: 12px;
            line-height: 1.5;
            color: #333;
            background: #f5f5f5;
            padding: 20px;
        }
        .confirmation-container {
            background: #fff;
            padding: 30px;
            max-width: 900px;
            margin: 0 auto;
            box-shadow: 0 2px 10px rgba(0,0,0,0.1);
        }
        .subject-line {
            margin-bottom: 15px;
            font-size: 13px;
        }
        .greeting {
            margin-bottom: 20px;
        }
        .greeting p {
            margin-bottom: 5px;
        }
        .reference-section {
            margin-bottom: 20px;
        }
        .reference-line {
            font-weight: bold;
            margin-bottom: 10px;
        }
        .info-row {
            margin-bottom: 3px;
        }
        .section-header {
            background: #1a3a5c;
            color: #fff;
            padding: 8px 12px;
            font-weight: bold;
            margin: 20px 0 10px 0;
            font-size: 13px;
        }
        .accommodation-table {
            width: 100%;
            border-collapse: collapse;
            margin-bottom: 20px;
        }
        .accommodation-table td {
            border: 1px solid #ddd;
            padding: 10px;
            vertical-align: top;
        }
        .accommodation-table tr:first-child td {
            border-top: 2px solid #333;
        }
        .accommodation-table tr:last-child td {
            border-bottom: 2px solid #333;
        }
        .day-header {
            font-weight: bold;
            margin-bottom: 5px;
        }
        .property-name {
            color: #c00070;
            font-weight: bold;
            margin: 5px 0;
        }
        .room-type {
            color: #b00020;
            font-weight: bold;
            margin-bottom: 5px;
        }
        .inclusions-list {
            margin: 10px 0;
            padding-left: 20px;
        }
        .inclusions-list li {
            margin-bottom: 5px;
        }
        .abbreviations {
            font-size: 11px;
            color: #666;
            margin: 15px 0;
        }
        .transport-table {
            width: 100%;
            border-collapse: collapse;
            margin-bottom: 20px;
        }
        .transport-table th,
        .transport-table td {
            border: 1px solid #ddd;
            padding: 8px;
            text-align: left;
        }
        .transport-table th {
            background: #f5f5f5;
            font-weight: bold;
        }
        .payment-section {
            margin: 10px 0;
        }
        .payment-line {
            margin-bottom: 5px;
        }
        .installment-list {
            margin: 10px 0;
        }
        .installment-item {
            margin-bottom: 3px;
        }
        .bank-details {
            margin: 10px 0;
        }
        .bank-details div {
            margin-bottom: 3px;
        }
        .prepared-section {
            margin-top: 20px;
        }
        .prepared-section div {
            margin-bottom: 3px;
        }
        .action-buttons {
            text-align: right;
            margin-bottom: 15px;
        }
        .action-buttons .btn {
            margin-left: 10px;
            padding: 12px 24px;
            font-size: 14px;
            font-weight: 600;
            border: none;
            border-radius: 6px;
            cursor: pointer;
            transition: all 0.3s ease;
            box-shadow: 0 4px 6px rgba(0,0,0,0.1);
        }
        .btn-copy {
            background: linear-gradient(135deg, #667eea 0%, #764ba2 100%);
            color: white;
        }
        .btn-copy:hover {
            background: linear-gradient(135deg, #5a6fd6 0%, #6a4190 100%);
            transform: translateY(-2px);
            box-shadow: 0 6px 12px rgba(102, 126, 234, 0.4);
        }
        .btn-word {
            background: linear-gradient(135deg, #11998e 0%, #38ef7d 100%);
            color: white;
        }
        .btn-word:hover {
            background: linear-gradient(135deg, #0d8578 0%, #2dd46a 100%);
            transform: translateY(-2px);
            box-shadow: 0 6px 12px rgba(17, 153, 142, 0.4);
        }
    </style>
</head>
<body>
    <div class="action-buttons no-print">
        <button type="button" class="btn btn-copy" onclick="copyContent()">
            <i class="la la-copy"></i> Copy to Clipboard
        </button>
        <button type="button" class="btn btn-word" onclick="exportToWord()">
            <i class="la la-file-word"></i> Export to Word
        </button>
    </div>

    <div class="confirmation-container" id="confirmationContent">
        <!-- Subject Line -->
        <div class="subject-line">
            Subject: Request to confirm Quote #<?php echo htmlspecialchars(get($main, 'quotation_number')); ?> - <?php echo htmlspecialchars(get($main, 'guest_name')); ?> - Start Date: <?php echo nice_date(get($main, 'start_date')); ?> - Duration: <?php echo $totalNights; ?> N | <?php echo $totalDays; ?> days
        </div>

        <!-- Greeting -->
        <div class="greeting">
            <p>Dear <?php echo htmlspecialchars(get($main, 'guest_name')); ?>,</p>
            <p>Warm greetings from Royale India !</p>
            <p>We are pleased to present the finalized quotation for your upcoming travel plans.</p>
            <p>We request your review and provide us with your confirmation via email.</p>
        </div>

        <!-- Reference -->
        <div class="reference-section">
            <div class="reference-line">Reference: <?php echo htmlspecialchars(get($main, 'quotation_number')); ?></div>
            
            <div class="info-row"><strong>Lead Guest Name:</strong> <?php echo htmlspecialchars(get($main, 'guest_name')); ?></div>
            <div class="info-row"><strong>Start Date:</strong> <?php echo nice_date(get($main, 'start_date')); ?> | <strong>End Date:</strong> <?php echo nice_date(get($main, 'end_date')); ?> | <strong>Duration:</strong> <?php echo $totalNights; ?> Nights</div>
            <div class="info-row"><strong>Arriving:</strong> <?php echo htmlspecialchars(get($main, 'arriving_destination')); ?> | <strong>Departing:</strong> <?php echo htmlspecialchars(get($main, 'departuring_destination')); ?></div>
        </div>

        <!-- Accommodation Plan -->
        <div class="section-header">Accommodation Plan</div>
        <table class="accommodation-table">
            <?php foreach ($rooms as $r): ?>
            <tr>
                <td>
                    <div class="day-header"><?php echo get($r, 'quotation_properties_days_day'); ?> - <?php echo short_date(get($r, 'accommodation_date')); ?></div>
                    <div><?php echo get($r, 'state_name'); ?></div>
                    <div class="property-name"><?php echo get($r, 'properties_name'); ?></div>
                </td>
                <td>
                    <div class="room-type">Room Type: <?php echo get($r, 'properties_room_category_name'); ?></div>
                    <div>
                        Rooms: <?php echo (int)get($r, 'room_unit_manual_count', 1); ?>
                        (<?php echo (int)get($r, 'adults', 1); ?> Adults)
                        |
                        SGL: <?php echo (int)get($r, 'single_occupancy_manual_count', 0); ?>
                        |
                        EBA: <?php echo (int)get($r, 'extra_bed_adult_manual_count', 0); ?>
                        |
                        CWB: <?php echo (int)get($r, 'extra_bed_child_manual_count', 0); ?>
                        |
                        CNB: <?php echo (int)get($r, 'child_sharing_bed_manual_count', 0); ?>
                    </div>
                    <div>
                        <!-- Adult: <?php echo (int)get($r, 'adults', 0); ?> |
                        Child: <?php echo (int)get($r, 'children', 0); ?>
                        (Meal Plan: <?php echo get($r, 'meal_plan_name', 'CP'); ?>) -->
                        <?php
$planContext = isset($r['applied_plan']) ? $r['applied_plan'] : array();

$appliedAdults = isset($planContext['applied']['adults'])
    ? (int)$planContext['applied']['adults'] : 0;

$appliedChild = isset($planContext['applied']['children'])
    ? (int)$planContext['applied']['children'] : 0;

$appliedBaby = isset($planContext['applied']['baby'])
    ? (int)$planContext['applied']['baby'] : 0;

$mealPlanName = !empty($planContext['meal_plan_name'])
    ? $planContext['meal_plan_name']
    : get($r, 'meal_plan_name', 'CP');
?>

Adult: <?= $appliedAdults; ?> |
Child: <?= $appliedChild; ?> |
Infant: <?= $appliedBaby; ?>
(Meal Plan: <?= htmlspecialchars($mealPlanName); ?>)
                    </div>
                </td>
            </tr>
            <?php endforeach; ?>
        </table>

        <!-- Hotel Inclusions -->
        <?php if (!empty($inclusions)): ?>
        <div class="section-header">Hotel Inclusions</div>
        <ul class="inclusions-list">
            <?php foreach ($inclusions as $inc): ?>
            <li>
                <?php echo short_date(get($inc, 'accommodation_date')); ?>: 
                <?php echo get($inc, 'properties_name'); ?> | 
                <?php echo get($inc, 'property_inclusions_name'); ?>
            </li>
            <?php endforeach; ?>
        </ul>
        <?php endif; ?>

        <?php if (!empty($special_requirements)) { ?>
        <div class="section-header">Special Requirements</div>

        <ul class="inclusions-list">
        <?php foreach ($special_requirements as $sp) { ?>
            <li>
                <?= short_date($sp['accommodation_date']); ?> :
                <?= htmlspecialchars($sp['special_requirements_name']); ?>
            </li>
        <?php } ?>
        </ul>
        <?php } ?>

        <!-- Abbreviations -->
        <div class="abbreviations">
            <strong>Abbreviations</strong><br>
            EBA: Extra Bed Adult | CWB: Extra Bed Child | CNB: Child sharing bed | SGL: Single Occupancy<br>
            EP: Room Only | CP: Breakfast | MAP: Breakfast + Dinner | AP: Breakfast + Lunch + Dinner | AI: Breakfast + Lunch + Dinner + Beverages
        </div>

        <!-- Transportation -->
        <div class="section-header">Transportation</div>
        <table class="transport-table">
            <tr>
                <th>Vehicle Type</th>
                <th>Days</th>
            </tr>
            <tr>
                <td><?php echo htmlspecialchars(get($main, 'vehicle_name', 'Vehicle')); ?></td>
                <td>All Days</td>
            </tr>
        </table>

        <!-- Payment Policy -->
        <div class="section-header">Payment Policy</div>
        <div class="payment-section">
            <div class="payment-line"><strong>Quoted Price (INR):</strong> <?= number_format(get($main, 'final_quoted_price', 0), 2); ?></div>
            <div class="payment-line"><strong>Payment Terms:</strong> In installments</div>
            
            <div class="installment-list">
                <?php 
                $installmentCounter = 1;
                foreach ($payment_schedule as $schedule): 
                    // Determine ordinal suffix
                    if ($installmentCounter == 1) $ordinal = '1st';
                    elseif ($installmentCounter == 2) $ordinal = '2nd';
                    elseif ($installmentCounter == 3) $ordinal = '3rd';
                    else $ordinal = $installmentCounter . 'th';
                ?>
                <div class="installment-item">
                    <?php echo $ordinal; ?> Installment Due on <?php echo nice_date(get($schedule, 'due_date')); ?> - INR <?php echo number_format(get($schedule, 'calculated_amount', 0), 0); ?>
                </div>
                <?php 
                    $installmentCounter++;
                endforeach; 
                ?>
            </div>
            <p class="text-muted"><em>Please: Initiation of the booking process and confirmation is dependent upon timely receipt of payments as outlined in the payment schedule.</em></p>
        </div>

        <!-- Bank Details -->
        <div class="section-header">Bank Details</div>
        <div class="bank-details">
            <?php if ($account): ?>
            <div><strong>Account Name:</strong> <?php echo htmlspecialchars(get($account, 'account_name', 'N/A')); ?></div>
            <div><strong>Account Number:</strong> <?php echo htmlspecialchars(get($account, 'account_number', 'N/A')); ?></div>
            <div><strong>Bank Name:</strong> <?php echo htmlspecialchars(get($account, 'bank_name', 'N/A')); ?></div>
            <div><strong>IFSC/IBAN Code:</strong> <?php echo htmlspecialchars(isset($account['ifsc_code']) && $account['ifsc_code'] ? $account['ifsc_code'] : get($account, 'iban_code', 'N/A')); ?></div>
            <?php else: ?>
            <div>Bank details not available</div>
            <?php endif; ?>
        </div>

        <!-- Prepared By -->
        <div class="section-header">Prepared by</div>
        <div class="prepared-section">
            <?php
            $pb = isset($main['prepared_by_user']) ? $main['prepared_by_user'] : null;
            if ($pb): ?>
                <div><?php echo htmlspecialchars($pb->admin_name); ?></div>
                <?php if (!empty($pb->user_phone_number)): ?>
                <div>Ph No : <?php echo htmlspecialchars($pb->user_phone_number); ?></div>
                <?php endif; ?>
            <?php else: ?>
                <div><?php echo htmlspecialchars(get($main, 'quotation_created_by_username', 'Staff')); ?></div>
            <?php endif; ?>
            <div>Royale India</div>
            <div>Ernakulam, Kerala, India</div>
            <div>https://royaleindia.in</div>
        </div>
    </div>

    <script src="<?php echo base_url(); ?>assets/vendor/bootstrap/js/bootstrap.bundle.min.js"></script>
    <script>
        function copyContent() {
            const content = document.getElementById('confirmationContent').innerText;
            navigator.clipboard.writeText(content).then(function() {
                alert('Content copied to clipboard!');
            }, function(err) {
                console.error('Could not copy text: ', err);
            });
        }

        function exportToWord() {
            const content = document.getElementById('confirmationContent').innerHTML;
            const styles = `
                <style>
                    body { font-family: Arial, sans-serif; font-size: 12px; line-height: 1.5; color: #333; }
                    .subject-line { margin-bottom: 15px; font-size: 13px; }
                    .greeting { margin-bottom: 20px; }
                    .greeting p { margin-bottom: 5px; }
                    .reference-section { margin-bottom: 20px; }
                    .reference-line { font-weight: bold; margin-bottom: 10px; color: #1a3a5c; font-size: 14px; }
                    .info-row { margin-bottom: 3px; }
                    .info-row strong { color: #1a3a5c; }
                    .section-header { background: #1a3a5c; color: #fff; padding: 8px 12px; font-weight: bold; margin: 20px 0 10px 0; font-size: 13px; }
                    .accommodation-table { width: 100%; border-collapse: collapse; margin-bottom: 20px; }
                    .accommodation-table td { border: 1px solid #ddd; padding: 10px; vertical-align: top; }
                    .accommodation-table tr:first-child td { border-top: 2px solid #333; }
                    .accommodation-table tr:last-child td { border-bottom: 2px solid #333; }
                    .day-header { font-weight: bold; margin-bottom: 5px; color: #1a3a5c; font-size: 13px; }
                    .property-name { color: #c00070; font-weight: bold; margin: 5px 0; }
                    .room-type { color: #b00020; font-weight: bold; margin-bottom: 5px; }
                    .inclusions-list { margin: 10px 0; padding-left: 20px; }
                    .inclusions-list li { margin-bottom: 5px; }
                    .abbreviations { font-size: 11px; color: #666; margin: 15px 0; }
                    .transport-table { width: 100%; border-collapse: collapse; margin-bottom: 20px; }
                    .transport-table th, .transport-table td { border: 1px solid #ddd; padding: 8px; text-align: left; }
                    .transport-table th { background: #f5f5f5; font-weight: bold; }
                    .payment-section { margin: 10px 0; }
                    .payment-line { margin-bottom: 5px; }
                    .payment-line strong { color: #1a3a5c; }
                    .installment-list { margin: 10px 0; }
                    .installment-item { margin-bottom: 3px; }
                    .bank-details { margin: 10px 0; }
                    .bank-details div { margin-bottom: 3px; }
                    .prepared-section { margin-top: 20px; }
                    .prepared-section div { margin-bottom: 3px; }
                </style>
            `;
            const html = `<!DOCTYPE html><html><head><meta charset="utf-8"><title>Confirmation</title>${styles}</head><body>${content}</body></html>`;
            const blob = new Blob([html], { type: 'application/msword' });
            const url = URL.createObjectURL(blob);
            const link = document.createElement('a');
            link.href = url;
            link.download = '<?php echo htmlspecialchars(get($main, 'guest_name', 'Guest')); ?> - <?php echo get($main, 'quotation_number', 'Quote'); ?>.doc';
            document.body.appendChild(link);
            link.click();
            document.body.removeChild(link);
            URL.revokeObjectURL(url);
        }
    </script>
</body>
</html>
