<?php
function pr_date($date) {
    if (empty($date) || $date == '0000-00-00') return '-';
    return date('D, d M Y', strtotime($date));
}

$main = isset($main) ? $main : array();
$properties = isset($properties) ? $properties : array();

$grouped = array();

foreach ($properties as $r) {
    $key = $r['properties_id_fk'].'_'.$r['accommodation_date'];

    if (!isset($grouped[$key])) {
        $grouped[$key] = array(
            'property_name' => $r['properties_name'],
            'destination' => $r['state_name'],
            'checkin' => $r['accommodation_date'],
            'rooms' => array()
        );
    }

    $grouped[$key]['rooms'][] = $r;
}
?>

<!DOCTYPE html>
<html>
<head>
<title>Property Reservation</title>
<link href="<?php echo base_url(); ?>assets/vendor/line-awesome/css/line-awesome.min.css" rel="stylesheet">
<style>
body{font-family:Arial;background:#f5f5f5;font-size:13px;}
.page{width:700px;background:#fff;margin:30px auto;padding:60px 80px;box-shadow:0 0 8px #aaa;}
.btns{text-align:right;margin-bottom:20px;}
.btns .btn{
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
.btn-whatsapp{
    background:linear-gradient(135deg, #11998e 0%, #38ef7d 100%);
}
.btn-whatsapp:hover{
    background:linear-gradient(135deg, #0d8578 0%, #2dd46a 100%);
    transform:translateY(-2px);
    box-shadow:0 6px 12px rgba(17,153,142,0.4);
}
.section-title{color:red;font-weight:bold;margin-top:25px;}
.label{font-weight:bold;width:120px;display:inline-block;}
.property{font-weight:bold;color:#183c70;}
.room-title{font-weight:bold;color:#b00020;}
.red{color:red;font-weight:bold;}
.blue{color:#183c70;font-weight:bold;text-decoration:underline;}
</style>
</head>
<body>

<?php foreach ($grouped as $g): ?>
<div class="page reservationContent">

    <div class="btns">
        <button class="btn btn-copy" onclick="copyEmail(this)"><i class="la la-copy"></i> Copy Email Content</button>
        <button class="btn btn-whatsapp" onclick="copyWhatsApp(this)"><i class="la la-whatsapp"></i> Copy WhatsApp Content</button>
    </div>

    <p class="section-title">Email:</p>

    <p>
        <strong class="red">Subject:</strong>
        Reservation Request - Tour Matrix Test, Ernakulam -
        <strong>Ref: <?= htmlspecialchars($main['quotation_number']); ?></strong>
        - <?= htmlspecialchars($g['property_name']); ?>
    </p>

    <p>Dear Reservations Team</p>
    <p>Greetings from Tour Matrix Test!</p>

    <p><span class="label">Property:</span>
        <span class="property"><?= htmlspecialchars($g['property_name']); ?> | <?= htmlspecialchars($g['destination']); ?></span>
    </p>

    <p><span class="label">Guest Name:</span> <?= htmlspecialchars($main['guest_name']); ?></p>
    <p><span class="label">Check-in:</span> <?= pr_date($g['checkin']); ?></p>
    <p><span class="label">Check-out:</span> <?= pr_date(date('Y-m-d', strtotime($g['checkin'].' +1 day'))); ?></p>
    <p><span class="label">Stay Duration:</span> 1 Nights</p>

    <p class="blue">Rooming Requirements</p>
    <p><strong><?= date('d F Y', strtotime($g['checkin'])); ?></strong></p>
    <ul>
    <?php foreach ($g['rooms'] as $room): ?>

        <?php
        $planContext = isset($room['applied_plan']) ? $room['applied_plan'] : array();

        $appliedAdults = isset($planContext['applied']['adults'])
            ? (int)$planContext['applied']['adults'] : 0;

        $appliedChild = isset($planContext['applied']['children'])
            ? (int)$planContext['applied']['children'] : 0;

        $appliedInfant = isset($planContext['applied']['baby'])
            ? (int)$planContext['applied']['baby'] : 0;

        $mealPlanName = !empty($planContext['meal_plan_name'])
            ? $planContext['meal_plan_name']
            : (!empty($room['meal_plan_name']) ? $room['meal_plan_name'] : 'CP');
        ?>

        <li>
            <span class="room-title"><?= htmlspecialchars($room['properties_room_category_name']); ?></span>
            - Meal Plan <span class="red"><?= htmlspecialchars($mealPlanName); ?></span>
            | Adults <?= $appliedAdults; ?>
            | Child <?= $appliedChild; ?>
            | Infant <?= $appliedInfant; ?>
            <br>

            <strong>Rooms:</strong> <?= (int)$room['room_unit_manual_count']; ?>
            |
            <strong>SGL:</strong> <?= (int)$room['single_occupancy_manual_count']; ?>
            |
            <strong>EBA:</strong> <?= (int)$room['extra_bed_adult_manual_count']; ?>
            |
            <strong>CWB:</strong> <?= (int)$room['extra_bed_child_manual_count']; ?>
            |
            <strong>CNB:</strong> <?= (int)$room['child_sharing_bed_manual_count']; ?>
            |
            <span class="red">(FOC Infant - <?= $appliedInfant; ?>)</span>
        </li>

    <?php endforeach; ?>
</ul>

    <p><span class="label">Payable:</span> INR 
        <?= number_format(array_sum(array_column($g['rooms'], 'manual_total_rate')), 2); ?>
    </p>

    <p class="blue">Abbreviations</p>
    <p>
        <strong>EBA:</strong> Extra Bed Adult |
        <strong>CWB:</strong> Extra Bed Child |
        <strong>CNB:</strong> Child sharing Bed |
        <strong>SGL:</strong> Single Occupancy
    </p>

    <p>Thank you for your prompt attention to this matter.</p>
    <p>We look forward to a positive response and a pleasant stay for our clients at your hotel.</p>

    <p>
        Best Regards,<br>
        <strong><?= htmlspecialchars($main['quotation_created_by_username']); ?></strong><br>
        Phone: +917593809967
    </p>

</div>
<?php endforeach; ?>

<script>
function copyEmail(btn) {
    var page = btn.closest('.page');
    var text = page.innerText;
    navigator.clipboard.writeText(text).then(function() {
        alert('Email content copied!');
    }, function(err) {
        console.error('Could not copy: ', err);
    });
}
function copyWhatsApp(btn) {
    var page = btn.closest('.page');
    var text = page.innerText;
    navigator.clipboard.writeText(text).then(function() {
        alert('WhatsApp content copied!');
    }, function(err) {
        console.error('Could not copy: ', err);
    });
}
</script>

</body>
</html>