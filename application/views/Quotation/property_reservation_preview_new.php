<?php
function pr_date_new($date) {
    if (empty($date) || $date == '0000-00-00') return '-';
    return date('d-M-Y', strtotime($date));
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
            'rooms' => array(),
            'inclusions' => array()
        );
    }
    $grouped[$key]['rooms'][] = $r;
    // Collect inclusions (same property may have multiple room rows, avoid duplicates)
    if (isset($r['property_inclusions']) && is_array($r['property_inclusions'])) {
        foreach ($r['property_inclusions'] as $inc) {
            $incKey = $inc['inclusion_name'] . '_' . $inc['inclusion_amount'];
            if (!isset($grouped[$key]['inclusions'][$incKey])) {
                $grouped[$key]['inclusions'][$incKey] = $inc;
            }
        }
    }
}

$tripCode = isset($main['quotation_number']) ? $main['quotation_number'] : '';
$guestName = isset($main['guest_name']) ? $main['guest_name'] : '';
?>
<!DOCTYPE html>
<html>
<head>
<title>Property Reservation</title>
<link href="<?php echo base_url(); ?>assets/vendor/line-awesome/css/line-awesome.min.css" rel="stylesheet">
<style>
@page{size:A4;margin:0;}
body{font-family:Arial;background:#f5f5f5;font-size:13px;margin:0;padding:0;}
.page{
    width:210mm;
    min-height:297mm;
    background:#fff;
    margin:30px auto;
    padding:15mm 18mm;
    box-shadow:0 0 8px #aaa;
    box-sizing:border-box;
}
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
.email-content{white-space:pre-wrap;line-height:1.8;}
</style>
</head>
<body>

<?php foreach ($grouped as $g):
    $totalRooms = 0;
    $roomCategory = '';
    $mealPlan = '';
    $adults = 0;
    $children = 0;
    $childAges = array();

    foreach ($g['rooms'] as $room):
        $planContext = isset($room['applied_plan']) ? $room['applied_plan'] : array();
        $adults += isset($planContext['applied']['adults']) ? (int)$planContext['applied']['adults'] : 0;
        $children += isset($planContext['applied']['children']) ? (int)$planContext['applied']['children'] : 0;
        $totalRooms += (int)$room['room_unit_manual_count'];
        if (!$roomCategory) $roomCategory = $room['properties_room_category_name'];
        if (!$mealPlan) {
            $mealPlan = !empty($planContext['meal_plan_name']) ? $planContext['meal_plan_name'] : (!empty($room['meal_plan_name']) ? $room['meal_plan_name'] : 'CP');
        }
        if (isset($planContext['child_age_break_up']) && is_array($planContext['child_age_break_up'])) {
            foreach ($planContext['child_age_break_up'] as $ca) {
                $childAges[] = $ca['age'] . ' yrs (' . $ca['count'] . ')';
            }
        }
    endforeach;

    $childAgeStr = !empty($childAges) ? implode(', ', $childAges) : '0';
    $nights = 1;

    // Build inclusions string
    $inclusionList = array_values($g['inclusions']);
    if (!empty($inclusionList)) {
        $incLines = array();
        foreach ($inclusionList as $inc) {
            $incLines[] = '  - ' . htmlspecialchars($inc['inclusion_name']);
        }
        $inclusionStr = implode("\n", $incLines);
    } else {
        $inclusionStr = 'Nil';
    }
?>
<div class="page reservationContent">

    <div class="btns">
        <button class="btn btn-copy" onclick="copyEmailNew(this)"><i class="la la-copy"></i> Copy Email Content</button>
        <button class="btn btn-whatsapp" onclick="copyWhatsAppNew(this)"><i class="la la-whatsapp"></i> Copy WhatsApp Content</button>
    </div>

    <div class="email-content">Subject: <?= htmlspecialchars($tripCode); ?> – Reservation Request | <?= htmlspecialchars($guestName); ?> | Royale India

Dear Reservations Team,

Greetings from Royale India.

Kindly confirm the reservation as per the following details:

Trip Code: <?= htmlspecialchars($tripCode); ?>

Guest Name: <?= htmlspecialchars($guestName); ?>

No. of Guests: <?= $adults; ?> Adults, <?= $children; ?> Children (<?= htmlspecialchars($childAgeStr); ?>)
Number of Rooms: <?= $totalRooms; ?>

Room Category: <?= htmlspecialchars($roomCategory); ?>

Meal Plan: <?= htmlspecialchars($mealPlan); ?>

Check-in Date: <?= pr_date_new($g['checkin']); ?>

Check-out Date: <?= pr_date_new(date('Y-m-d', strtotime($g['checkin'].' +'.$nights.' day'))); ?>

Duration of Stay: <?= $nights; ?> Nights

Special Requests:
<?= $inclusionStr; ?>


Kindly confirm the reservation at the earliest and share the reservation confirmation voucher along with the confirmation number.

Thank you for your support. We look forward to your confirmation.

Kind Regards,


Reservations Team
RIT Royale Getaways Private Limited (Royale India)
📞 +91-90726 09089
✉️ reservations@royaleindia.in
🌐 www.royaleindia.in</div>

</div>
<?php endforeach; ?>

<script>
function copyEmailNew(btn) {
    var page = btn.closest('.page');
    var text = page.querySelector('.email-content').innerText;
    navigator.clipboard.writeText(text).then(function() {
        alert('Email content copied!');
    }, function(err) {
        console.error('Could not copy: ', err);
    });
}
function copyWhatsAppNew(btn) {
    var page = btn.closest('.page');
    var text = page.querySelector('.email-content').innerText;
    navigator.clipboard.writeText(text).then(function() {
        alert('WhatsApp content copied!');
    }, function(err) {
        console.error('Could not copy: ', err);
    });
}
</script>

</body>
</html>
