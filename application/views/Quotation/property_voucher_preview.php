<?php
function pv_date($date) {
    if (empty($date) || $date == '0000-00-00') return '-';
    return date('D, d M, Y', strtotime($date));
}

function pv_short_date($date) {
    if (empty($date) || $date == '0000-00-00') return '-';
    return date('d M Y', strtotime($date));
}

function arr_get($arr, $key, $default = '-') {
    return isset($arr[$key]) && $arr[$key] !== '' ? $arr[$key] : $default;
}

$main = isset($main) ? $main : array();
$properties = isset($properties) ? $properties : array();
$reservations = isset($reservations) ? $reservations : array();

$grouped = array();

foreach ($properties as $r) {
    $key = $r['quotation_properties_id'].'_'.$r['accommodation_date'];

    if (!isset($grouped[$key])) {
        $pid = $r['properties_id_fk'];
        $res = isset($reservations[$pid]) ? $reservations[$pid] : array();
        $grouped[$key] = array(
            'property_id'      => $pid,
            'property_name'    => $r['properties_name'],
            'property_logo'    => isset($r['properties_hotel_logo']) ? $r['properties_hotel_logo'] : '',
            'destination'      => $r['state_name'],
            'checkin'          => $r['accommodation_date'],
            'checkout'         => date('Y-m-d', strtotime($r['accommodation_date'].' +1 day')),
            'rooms'            => array(),
            'inclusions'       => isset($r['hotel_inclusions']) ? $r['hotel_inclusions'] : array(),
            'cnfm_by'          => isset($res['confirmation_cnfm_by']) ? $res['confirmation_cnfm_by'] : '',
            'cnfm_no'          => isset($res['confirmation_cnfm_no']) ? $res['confirmation_cnfm_no'] : ''
        );
    }

    $grouped[$key]['rooms'][] = $r;
}
?>
<!DOCTYPE html>
<html>
<head>
<title>Property Voucher</title>

<style>
body {
    font-family: Arial, sans-serif;
    background:#fff;
    font-size:13px;
    color:#111;
}

.print-btn {
    text-align:right;
    margin:15px 25px;
}

.print-btn button {
    background:#e6005c;
    color:#fff;
    border:0;
    padding:12px 45px;
    border-radius:4px;
    font-weight:bold;
}

.voucher-page {
    width:96%;
    margin:25px auto 45px auto;
}

.voucher-header {
    background:#5364dc;
    color:#fff;
    padding:16px;
    font-weight:bold;
    display:flex;
    justify-content:space-between;
    align-items:center;
}

.enq-box {
    border:2px solid #fff;
    padding:8px 20px;
}

.company-property-box {
    border:1px solid #b8bdd6;
    display:grid;
    grid-template-columns:1fr 1fr;
    margin-top:15px;
}

.company-box,
.property-box {
    padding:22px;
    min-height:85px;
    display:flex;
    align-items:center;
    gap:15px;
}

.company-box {
    border-right:1px solid #b8bdd6;
}

.company-info,
.property-info {
    flex:1;
}

.logo-text {
    font-size:20px;
    font-weight:bold;
}

.logo-text img {
    max-width:80px;
    height:auto;
}

.company-name,
.property-name {
    font-size:18px;
    font-weight:bold;
    color:#111;
}

.small-text {
    font-size:12px;
    color:#333;
    line-height:1.5;
}

.details-box {
    border:1px solid #b8bdd6;
    display:grid;
    grid-template-columns:1fr 1fr;
    margin-top:25px;
}

.details-left,
.details-right {
    padding:18px 15px;
}

.details-left {
    border-right:1px solid #b8bdd6;
}

.detail-row {
    display:grid;
    grid-template-columns:180px 1fr;
    margin-bottom:12px;
}

.detail-label {
    font-weight:bold;
}

.room-table,
.inclusion-table {
    width:100%;
    border-collapse:collapse;
    margin-top:18px;
}

.room-table th,
.room-table td,
.inclusion-table th,
.inclusion-table td {
    border:1px solid #b8bdd6;
    padding:10px;
    text-align:center;
    vertical-align:middle;
}

.room-table th,
.inclusion-table th {
    background:#dfe3ff;
    font-weight:bold;
}

.room-table tbody tr:nth-child(even),
.inclusion-table tbody tr:nth-child(even) {
    background:#f5f5f5;
}

.left-text {
    text-align:left !important;
}

.abbr-box {
    border-left:1px solid #b8bdd6;
    border-right:1px solid #b8bdd6;
    border-bottom:1px solid #b8bdd6;
    padding:18px;
    font-weight:bold;
    line-height:1.7;
}

.comments {
    margin-top:35px;
}

.comments-title {
    font-size:18px;
    font-weight:bold;
}

.comment-btn {
    float:right;
    background:#e6005c;
    color:#fff;
    border:0;
    padding:8px 18px;
}

.footer-note {
    margin-top:35px;
    font-weight:bold;
    font-size:12px;
}

.icon-count {
    color:#5260b8;
    font-weight:bold;
    margin:0 7px;
}

@media print {
    .print-btn,
    .comment-btn {
        display:none;
    }

    .voucher-page {
        page-break-after:always;
    }
}
</style>
</head>

<body>

<div class="print-btn">
    <button onclick="window.print()">Print</button>
</div>

<?php foreach ($grouped as $g): ?>

<div class="voucher-page">

    <div class="voucher-header">
        <div>Hotel Reservation Voucher</div>
        <div class="enq-box">
            Enq No: <?= htmlspecialchars(arr_get($main, 'quotation_number')); ?>
        </div>
    </div>

    <div class="company-property-box">

        <div class="company-box">
            <div class="logo-text"><img src="<?php echo base_url();?>assets/images/Royale-logo-new.png" alt="Royale India"></div>
            <div class="company-info">
                <div class="company-name">Royale India</div>
                <div class="small-text">
                    📍 Kerala, Ernakulam, India<br>
                    +9181244356788
                </div>
            </div>
        </div>

        <div class="property-box">
            <?php if (!empty($g['property_logo'])): ?>
            <div class="logo-text"><img src="<?php echo base_url(); ?>uploads/Property-doc/logo/<?= htmlspecialchars($g['property_logo']); ?>" alt="<?= htmlspecialchars($g['property_name']); ?>"></div>
            <?php endif; ?>
            <div class="property-info">
                <div class="property-name"><?= htmlspecialchars($g['property_name']); ?></div>
                <div class="small-text">
                    📍 <?= htmlspecialchars($g['destination']); ?>, India<br>
                    (Front office)
                </div>
            </div>
        </div>

    </div>

    <div class="details-box">

        <div class="details-left">
            <div class="detail-row">
                <div class="detail-label">Guest Name:</div>
                <div><?= htmlspecialchars(arr_get($main, 'guest_name')); ?></div>
            </div>

            <div class="detail-row">
                <div class="detail-label">Phone Number:</div>
                <div><?= htmlspecialchars(arr_get($main, 'whats_number')); ?></div>
            </div>

            <div class="detail-row">
                <div class="detail-label">Nationality:</div>
                <div><?= htmlspecialchars(arr_get($main, 'country_name', 'India')); ?></div>
            </div>

            <div class="detail-row">
                <div class="detail-label">Confirmed By:</div>
                <div><?= htmlspecialchars($g['cnfm_by']); ?></div>
            </div>

            <div class="detail-row">
                <div class="detail-label">Confirmation Ref:</div>
                <div><?= htmlspecialchars($g['cnfm_no']); ?></div>
            </div>
        </div>

        <div class="details-right">
            <div class="detail-row">
                <div class="detail-label">Check In:</div>
                <div><?= pv_date($g['checkin']); ?></div>
            </div>

            <div class="detail-row">
                <div class="detail-label">Check Out:</div>
                <div><?= pv_date($g['checkout']); ?></div>
            </div>

            <div class="detail-row">
                <div class="detail-label">Check In Time:</div>
                <div>14:00</div>
            </div>

            <div class="detail-row">
                <div class="detail-label">Check Out Time:</div>
                <div>11:00</div>
            </div>
        </div>

    </div>

    <table class="room-table">
        <thead>
            <tr>
                <th style="width:11%">Date</th>
                <th class="left-text">Room Name</th>
                <th style="width:15%">Guests</th>
                <th>Units</th>
                <th>SGL</th>
                <th>EBA</th>
                <th>CWB</th>
                <th>CNB</th>
                <th>Meal Plan</th>
                <!-- <th>Mandatory Lunch</th>
                <th>Mandatory Dinner</th> -->
            </tr>
        </thead>

        <tbody>
            <?php foreach ($g['rooms'] as $index => $room): ?>

                <?php
                $planContext = isset($room['applied_plan']) ? $room['applied_plan'] : array();

                $adults = isset($planContext['applied']['adults'])
                    ? (int)$planContext['applied']['adults'] : 0;

                $children = isset($planContext['applied']['children'])
                    ? (int)$planContext['applied']['children'] : 0;

                $infant = isset($planContext['applied']['baby'])
                    ? (int)$planContext['applied']['baby'] : 0;

                $mealPlan = !empty($planContext['meal_plan_name'])
                    ? $planContext['meal_plan_name']
                    : arr_get($room, 'meal_plan_name', 'CP');
                ?>

                <tr>
                    <?php if ($index == 0): ?>
                        <td rowspan="<?= count($g['rooms']); ?>">
                            <?= pv_short_date($g['checkin']); ?>
                        </td>
                    <?php endif; ?>

                    <td class="left-text">
                        <?= htmlspecialchars(arr_get($room, 'properties_room_category_name')); ?>
                    </td>

                    <td>
                        <span class="icon-count">👤 <?= $adults; ?></span>
                        <span class="icon-count">🧒 <?= $children; ?></span>
                        <span class="icon-count">👶 <?= $infant; ?></span>
                    </td>

                    <td><?= (int)arr_get($room, 'room_unit_manual_count', 1); ?></td>
                    <td><?= (int)arr_get($room, 'single_occupancy_manual_count', 0); ?></td>
                    <td><?= (int)arr_get($room, 'extra_bed_adult_manual_count', 0); ?></td>
                    <td><?= (int)arr_get($room, 'extra_bed_child_manual_count', 0); ?></td>
                    <td><?= (int)arr_get($room, 'child_sharing_bed_manual_count', 0); ?></td>
                    <td><?= htmlspecialchars($mealPlan); ?></td>
                    <!-- <td>NA</td>
                    <td>NA</td> -->
                </tr>

            <?php endforeach; ?>
        </tbody>
    </table>

    <div class="abbr-box">
        EBA: Extra Bed for Adults | CWB: Child With Extra Bed | CNB: Child Sharing Bed | SGL: Single-Occupancy Room<br>
        EP: Room Only | CP: Room With Breakfast | MAP: Room With Breakfast & Dinner | AP: Room with Breakfast, Lunch & Dinner
    </div>

    <?php if (!empty($g['inclusions'])): ?>
        <table class="inclusion-table">
            <thead>
                <tr>
                    <th style="width:12%">Date</th>
                    <th class="left-text">Hotel Inclusion</th>
                </tr>
            </thead>
            <tbody>
                <?php foreach ($g['inclusions'] as $inc): ?>
                    <tr>
                        <td><?= pv_short_date($inc['accommodation_date']); ?></td>
                        <td class="left-text"><?= htmlspecialchars($inc['property_inclusions_name']); ?></td>
                    </tr>
                <?php endforeach; ?>
            </tbody>
        </table>
    <?php endif; ?>

    <div class="comments">
        <button class="comment-btn">+ Add comment</button>
        <div class="comments-title">Comments</div>
        <ul>
            <li>All guests are required to carry ID cards</li>
            <li>Foreign nationals must produce original passport at check in</li>
        </ul>
    </div>

    <div class="footer-note">
        This is a computer generated voucher and does not contain any signature.
    </div>

</div>

<?php endforeach; ?>

</body>
</html>