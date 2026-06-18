<?php
function tv_get($arr, $key, $default = '-') {
    return isset($arr[$key]) && $arr[$key] !== '' ? $arr[$key] : $default;
}

function tv_date($date) {
    if (empty($date) || $date == '0000-00-00') return '-';
    return date('d M Y', strtotime($date));
}

function tv_date_full($date) {
    if (empty($date) || $date == '0000-00-00') return '-';
    return date('d F Y', strtotime($date));
}

function tv_day_date($date) {
    if (empty($date) || $date == '0000-00-00') return '-';
    return date('D, d M Y', strtotime($date));
}

$main = isset($main) ? $main : array();
$rooms = isset($rooms) ? $rooms : array();
$inclusions = isset($inclusions) ? $inclusions : array();
$payment_schedule = isset($payment_schedule) ? $payment_schedule : array();
$account = isset($account) ? $account : array();
$reservations = isset($reservations) ? $reservations : array();

$totalNights = (int)tv_get($main, 'duration', 0);
$totalDays = $totalNights + 1;

/* group rooms by day */
$dayRooms = array();
$propertyRows = array();

foreach ($rooms as $r) {
    $dayKey = tv_get($r, 'quotation_properties_days_id', '').'_'.tv_get($r, 'accommodation_date', '');

    if (!isset($dayRooms[$dayKey])) {
        $dayRooms[$dayKey] = array(
            'day' => tv_get($r, 'quotation_properties_days_day'),
            'date' => tv_get($r, 'accommodation_date'),
            'destination' => tv_get($r, 'state_name'),
            'property' => tv_get($r, 'properties_name'),
            'rooms' => array()
        );
    }

    $dayRooms[$dayKey]['rooms'][] = $r;

    $propKey = tv_get($r, 'properties_id_fk').'_'.tv_get($r, 'accommodation_date');
    if (!isset($propertyRows[$propKey])) {
        $pid = tv_get($r, 'properties_id_fk');
        $res = isset($reservations[$pid]) ? $reservations[$pid] : array();
        $propertyRows[$propKey] = array(
            'property' => tv_get($r, 'properties_name'),
            'star'     => '4 star',
            'checkin'  => tv_get($r, 'accommodation_date'),
            'checkout' => date('Y-m-d', strtotime(tv_get($r, 'accommodation_date').' +1 day')),
            'cnfm_by'  => isset($res['confirmation_cnfm_by']) ? $res['confirmation_cnfm_by'] : '',
            'cnfm_no'  => isset($res['confirmation_cnfm_no']) ? $res['confirmation_cnfm_no'] : ''
        );
    }
}
?>
<!DOCTYPE html>
<html>
<head>
<title>Tour Voucher</title>
<link href="<?php echo base_url(); ?>assets/vendor/line-awesome/css/line-awesome.min.css" rel="stylesheet">
<style>
body {
    font-family: Arial, sans-serif;
    background:#fff;
    font-size:13px;
    color:#000;
    margin:0;
}
.topbar {
    height:45px;
    box-shadow:0 1px 8px rgba(0,0,0,.15);
    display:flex;
    align-items:center;
    justify-content:flex-end;
    padding:0 18px;
}
.top-actions button {
    margin-left:10px;
    padding:12px 24px;
    font-size:14px;
    border:none;
    border-radius:25px;
    font-weight:600;
    cursor:pointer;
    transition:all 0.3s ease;
    box-shadow:0 4px 6px rgba(0,0,0,0.1);
    color:#fff;
}
.btn-copy{
    background:linear-gradient(135deg, #667eea 0%, #764ba2 100%);
}
.btn-copy:hover{
    background:linear-gradient(135deg, #5a6fd6 0%, #6a4190 100%);
    transform:translateY(-2px);
    box-shadow:0 6px 12px rgba(102,126,234,0.4);
}
.btn-word{
    background:linear-gradient(135deg, #11998e 0%, #38ef7d 100%);
}
.btn-word:hover{
    background:linear-gradient(135deg, #0d8578 0%, #2dd46a 100%);
    transform:translateY(-2px);
    box-shadow:0 6px 12px rgba(17,153,142,0.4);
}
.wrapper {
    width:650px;
    margin:45px auto;
}
.subject {
    margin-bottom:20px;
}
.main-title {
    text-align:center;
    color:#5d78c8;
    font-size:32px;
    font-weight:800;
    margin:8px 0 25px;
}
.blue-head {
    background:#6b8bd6;
    color:#fff;
    font-weight:bold;
    font-size:16px;
    padding:6px 8px;
}
.tbl {
    width:100%;
    border-collapse:collapse;
    margin-bottom:25px;
}
.tbl td,
.tbl th {
    border:1px solid #000;
    padding:6px 8px;
    vertical-align:top;
}
.tbl th {
    font-weight:bold;
    background:#f2f2f2;
}
.label-blue {
    color:#003b82;
    font-weight:bold;
}
.property-name {
    color:#d1007a;
    font-weight:bold;
}
.room-type {
    color:#b00020;
    font-weight:bold;
}
.red {
    color:red;
    font-weight:bold;
}
.blue-text {
    color:#003b82;
    font-weight:bold;
}
.section-gap {
    margin-top:22px;
}
.bank-section,
.prepared-section {
    margin-top:35px;
    font-size:15px;
}
ul.hotel-inc {
    margin-top:15px;
}
@media print {
    .topbar { display:none; }
    .wrapper { margin:0 auto; }
}
</style>
</head>
<body>

<div class="topbar no-print">
    <div class="top-actions">
        <button class="btn-copy" onclick="copyContent()"><i class="la la-copy"></i> Copy Content</button>
        <button class="btn-word" onclick="exportToWord()"><i class="la la-file-word"></i> Export to Word</button>
    </div>
</div>

<div class="wrapper" id="voucherContent">

    <div class="subject">
        <strong>Subject Line for Email</strong><br>
        Tour Voucher – <?= htmlspecialchars(tv_get($main, 'guest_name')); ?> -
        <?= htmlspecialchars(tv_get($main, 'quotation_number')); ?> -
        Start Date: <?= tv_date_full(tv_get($main, 'start_date')); ?> –
        Duration: <?= $totalNights; ?> N | <?= $totalDays; ?> days
    </div>

    <div class="main-title">TOUR VOUCHER</div>

    <p>Dear <?= htmlspecialchars(tv_get($main, 'guest_name')); ?>,</p>
    <p>
        <strong>Greetings from Royale India!</strong><br>
        We are pleased to provide you with the confirmation details for your upcoming travel.
    </p>

    <table class="tbl">
        <tr>
            <td class="label-blue">Ref: <?= htmlspecialchars(tv_get($main, 'quotation_number')); ?></td>
            <td class="label-blue">Guest Name</td>
            <td><strong><?= htmlspecialchars(tv_get($main, 'guest_name')); ?></strong></td>
        </tr>
        <tr>
            <td><span class="label-blue">Start Date</span> <?= tv_date(tv_get($main, 'start_date')); ?></td>
            <td><span class="label-blue">End Date</span> <?= tv_date(tv_get($main, 'end_date')); ?></td>
            <td><span class="label-blue">Duration</span> <?= $totalNights; ?> Nights</td>
        </tr>
        <tr>
            <td colspan="3"><span class="label-blue">Destinations</span>
                <?php
                $destinations = array();
                foreach ($dayRooms as $d) {
                    if (!in_array($d['destination'], $destinations)) {
                        $destinations[] = $d['destination'];
                    }
                }
                echo htmlspecialchars(implode(' (1N) | ', $destinations));
                ?>
            </td>
        </tr>
        <tr>
            <td colspan="2"><span class="label-blue">Arrival Details</span><br><?= htmlspecialchars(tv_get($main, 'arriving_destination')); ?></td>
            <td><span class="label-blue">Departure Details</span><br><?= htmlspecialchars(tv_get($main, 'departuring_destination')); ?></td>
        </tr>
    </table>

    <div class="section-gap">
        <div class="blue-head">Receipt Details</div>
        <?php
        $totalPaid = 0;
        $totalAmount = 0;
        foreach ($payment_schedule as $p) {
            $totalAmount += (float)tv_get($p, 'calculated_amount', 0);
            $totalPaid  += (float)tv_get($p, 'paid_amount', 0);
        }
        ?>
        <table class="tbl">
            <tr>
                <td colspan="2"><strong>Price Quoted</strong></td>
                <td class="text-end"><strong>INR <?= number_format((float)tv_get($main, 'final_quoted_price', 0), 2); ?></strong></td>
                <td colspan="2"><strong>Amount Received</strong></td>
                <td><strong>INR <?= number_format($totalPaid, 2); ?></strong></td>
            </tr>
            <tr>
                <th>Instalment</th>
                <th>Due Date</th>
                <th>Amount</th>
                <th>Recd. | Adjusted</th>
                <th>Balance</th>
                <th>Status</th>
            </tr>
            <?php
            $i = 1;
            foreach ($payment_schedule as $p):
                $amt   = (float)tv_get($p, 'calculated_amount', 0);
                $paid  = (float)tv_get($p, 'paid_amount', 0);
                $bal   = $amt - $paid;
            ?>
            <tr>
                <td align="center"><?= $i++; ?></td>
                <td align="center"><?= tv_date(tv_get($p, 'due_date')); ?></td>
                <td align="right"><?= number_format($amt, 2); ?></td>
                <td align="right"><?= number_format($paid, 2); ?></td>
                <td align="right"><?= number_format($bal, 2); ?></td>
                <td align="center"><?= htmlspecialchars(tv_get($p, 'payment_status', 'Pending')); ?></td>
            </tr>
            <?php endforeach; ?>
            <tr>
                <td colspan="2" align="center"><strong>Total</strong></td>
                <td align="right"><strong><?= number_format($totalAmount, 2); ?></strong></td>
                <td align="right"><strong><?= number_format($totalPaid, 2); ?></strong></td>
                <td align="right"><strong><?= number_format($totalAmount - $totalPaid, 2); ?></strong></td>
                <td></td>
            </tr>
        </table>
    </div>

    <div class="section-gap">
        <div class="blue-head">Vehicle Details</div>
        <table class="tbl">
            <tr>
                <th>Vehicle Mode</th>
                <th>Registration No.</th>
                <th>Driver Name</th>
                <th>Mobile</th>
            </tr>
            <tr>
                <td><?= htmlspecialchars(tv_get($main, 'vehicle_name')); ?></td>
                <td align="center">TBA</td>
                <td align="center">TBA</td>
                <td align="center">TBA</td>
            </tr>
        </table>
        <div>TBA: To be announced (Details shall be communicated shortly)</div>
    </div>

    <div class="section-gap">
        <div class="blue-head">Property Details</div>
        <table class="tbl">
            <tr>
                <th>Property</th>
                <th>Check-in</th>
                <th>Check-out</th>
                <th>Confirmation Details</th>
            </tr>
            <?php foreach ($propertyRows as $p): ?>
            <tr>
                <td>
                    <span class="property-name"><?= htmlspecialchars($p['property']); ?></span><br>
                    <?= htmlspecialchars($p['star']); ?> | Contact:
                </td>
                <td align="center"><?= date('d-M-y', strtotime($p['checkin'])); ?><br><?= date('D', strtotime($p['checkin'])); ?></td>
                <td align="center"><?= date('d-M-y', strtotime($p['checkout'])); ?><br><?= date('D', strtotime($p['checkout'])); ?></td>
                <td>
                    <span class="label-blue">CNFM No:</span> <?= htmlspecialchars($p['cnfm_no'] ?: '-'); ?><br>
                    <span class="label-blue">CNFM By:</span> <?= htmlspecialchars($p['cnfm_by'] ?: '-'); ?>
                </td>
            </tr>
            <?php endforeach; ?>
        </table>
    </div>

    <div class="section-gap">
        <div class="blue-head">Day-wise Accommodation</div>
        <table class="tbl">
            <?php foreach ($dayRooms as $day): ?>
            <tr>
                <td style="width:45%;">
                    <div class="label-blue">
                        <?= htmlspecialchars($day['day']); ?> - <?= tv_day_date($day['date']); ?>
                    </div>
                    <strong><?= htmlspecialchars($day['destination']); ?></strong><br>
                    <span class="property-name"><?= htmlspecialchars($day['property']); ?> (4 star)</span>
                </td>
                <td>
                    <?php foreach ($day['rooms'] as $room): ?>
                        <?php
                        $planContext = isset($room['applied_plan']) ? $room['applied_plan'] : array();

                        $adults = isset($planContext['applied']['adults']) ? (int)$planContext['applied']['adults'] : 0;
                        $child  = isset($planContext['applied']['children']) ? (int)$planContext['applied']['children'] : 0;
                        $baby   = isset($planContext['applied']['baby']) ? (int)$planContext['applied']['baby'] : 0;

                        $meal = !empty($planContext['meal_plan_name'])
                            ? $planContext['meal_plan_name']
                            : tv_get($room, 'meal_plan_name', 'CP');
                        ?>
                        <div style="margin-bottom:12px;">
                            <span class="room-type">Room Type:</span>
                            <strong><?= htmlspecialchars(tv_get($room, 'properties_room_category_name')); ?></strong><br>
                            Rooms: <?= (int)tv_get($room, 'room_unit_manual_count', 1); ?>
                            (<?= $adults; ?> Adults)
                            | SGL: <?= (int)tv_get($room, 'single_occupancy_manual_count', 0); ?>
                            | EBA: <?= (int)tv_get($room, 'extra_bed_adult_manual_count', 0); ?>
                            | CWB: <?= (int)tv_get($room, 'extra_bed_child_manual_count', 0); ?>
                            | CNB: <?= (int)tv_get($room, 'child_sharing_bed_manual_count', 0); ?><br>
                            Adult: <?= $adults; ?> |
                            Child <?= $child; ?> |
                            Infant: <?= $baby; ?>
                            (<span class="label-blue">Meal Plan: <?= htmlspecialchars($meal); ?></span>)
                        </div>
                    <?php endforeach; ?>
                </td>
            </tr>
            <?php endforeach; ?>
        </table>
    </div>

    <?php if (!empty($inclusions)): ?>
    <div class="section-gap">
        <div class="blue-head">Hotel Inclusions</div>
        <ul class="hotel-inc">
            <?php foreach ($inclusions as $inc): ?>
            <li>
                <?= tv_day_date(tv_get($inc, 'accommodation_date')); ?>:
                <?= htmlspecialchars(tv_get($inc, 'properties_name')); ?> |
                <?= htmlspecialchars(tv_get($inc, 'property_inclusions_name')); ?>
            </li>
            <?php endforeach; ?>
        </ul>
    </div>
    <?php endif; ?>

    <?php if (!empty($special_requirements)): ?>
    <div class="section-gap">
        <div class="blue-head">Special Requirements</div>
        <ul class="hotel-inc">
            <?php foreach ($special_requirements as $sp): ?>
            <li>
                <?= tv_day_date(tv_get($sp, 'accommodation_date')); ?>:
                <?= htmlspecialchars(tv_get($sp, 'special_requirements_name')); ?>

                <?php if ((float)tv_get($sp, 'quotation_special_requirements_cost', 0) > 0): ?>
                    - INR <?= number_format((float)tv_get($sp, 'quotation_special_requirements_cost', 0), 2); ?>
                <?php endif; ?>
            </li>
            <?php endforeach; ?>
        </ul>
    </div>
    <?php endif; ?>

    <div class="bank-section">
        <strong>Bank Details</strong><br>
        Account Name: <?= htmlspecialchars(tv_get($account, 'account_name')); ?><br>
        Account Number: <?= htmlspecialchars(tv_get($account, 'account_number')); ?><br>
        Bank Name: <?= htmlspecialchars(tv_get($account, 'bank_name')); ?><br>
        IFSC/IBAN Code: <?= htmlspecialchars(tv_get($account, 'iban_code', tv_get($account, 'ifsc_code'))); ?>
    </div>

    <div class="prepared-section">
        <strong>Prepared by</strong><br>
        <?= htmlspecialchars(tv_get($main, 'quotation_created_by_username')); ?><br>
        Royale India<br>
        Ernakulam, Kerala, India<br>
        +917382882822<br>
        <a href="https://royaleindia.in">https://royaleindia.in</a>
    </div>

</div>

<script>
function copyContent() {
    var text = document.getElementById('voucherContent').innerText;
    navigator.clipboard.writeText(text).then(function() {
        alert('Content copied to clipboard!');
    }, function(err) {
        console.error('Could not copy: ', err);
    });
}

function exportToWord() {
    var content = document.getElementById('voucherContent').innerHTML;

    var styles = `
    <style>
    body {
        font-family: Arial, sans-serif;
        background:#fff;
        font-size:13px;
        color:#000;
        margin:0;
    }
    .wrapper {
        width:650px;
        margin:0 auto;
    }
    .subject {
        margin-bottom:20px;
    }
    .main-title {
        text-align:center;
        color:#5d78c8;
        font-size:32px;
        font-weight:800;
        margin:8px 0 25px;
    }
    .blue-head {
        background:#6b8bd6;
        color:#fff;
        font-weight:bold;
        font-size:16px;
        padding:6px 8px;
    }
    .tbl {
        width:100%;
        border-collapse:collapse;
        margin-bottom:25px;
    }
    .tbl td,
    .tbl th {
        border:1px solid #000;
        padding:6px 8px;
        vertical-align:top;
    }
    .tbl th {
        font-weight:bold;
        background:#f2f2f2;
    }
    .label-blue {
        color:#003b82;
        font-weight:bold;
    }
    .property-name {
        color:#d1007a;
        font-weight:bold;
    }
    .room-type {
        color:#b00020;
        font-weight:bold;
    }
    .red {
        color:red;
        font-weight:bold;
    }
    .blue-text {
        color:#003b82;
        font-weight:bold;
    }
    .section-gap {
        margin-top:22px;
    }
    .bank-section,
    .prepared-section {
        margin-top:35px;
        font-size:15px;
    }
    ul.hotel-inc {
        margin-top:15px;
    }
    </style>`;

    var html = '<!DOCTYPE html><html><head><meta charset="utf-8">' + styles + '</head><body>' +
               '<div class="wrapper">' + content + '</div></body></html>';

    var blob = new Blob(['\ufeff', html], {
        type: 'application/msword'
    });

    var link = document.createElement('a');
    link.href = URL.createObjectURL(blob);
    link.download = '<?= preg_replace("/[^A-Za-z0-9\-_]/", "-", tv_get($main, "guest_name", "Guest")); ?>-<?= preg_replace("/[^A-Za-z0-9\-_]/", "-", tv_get($main, "quotation_number", "Quote")); ?>-tour-voucher.doc';
    link.click();
}
</script>

</body>
</html>