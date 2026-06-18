<?php
function di_get($arr, $key, $default = '-') {
    return isset($arr[$key]) && $arr[$key] !== '' ? $arr[$key] : $default;
}

function di_date($date) {
    if (empty($date) || $date == '0000-00-00') return '-';
    return date('d M Y', strtotime($date));
}

function di_day_date($date) {
    if (empty($date) || $date == '0000-00-00') return '-';
    return date('D, d M Y', strtotime($date));
}

$main = isset($main) ? $main : array();
$days = isset($days) ? $days : array();
?>
<!DOCTYPE html>
<html>
<head>
<title>Driver Itinerary</title>
<link href="<?php echo base_url(); ?>assets/vendor/line-awesome/css/line-awesome.min.css" rel="stylesheet">
<style>
body {
    font-family: Arial, sans-serif;
    margin: 0;
    background: #fff;
    color: #000;
}

.topbar {
    height: 60px;
    box-shadow: 0 2px 10px rgba(0,0,0,.12);
    display: flex;
    align-items: center;
    justify-content: flex-end;
    padding: 0 18px;
}

.actions button {
    margin-left: 10px;
    padding: 12px 24px;
    font-size: 14px;
    border: none;
    border-radius: 25px;
    font-weight: 600;
    cursor: pointer;
    transition: all 0.3s ease;
    box-shadow: 0 4px 6px rgba(0,0,0,0.1);
    color: #fff;
}

.btn-word {
    background: linear-gradient(135deg, #667eea 0%, #764ba2 100%);
}
.btn-word:hover {
    background: linear-gradient(135deg, #5a6fd6 0%, #6a4190 100%);
    transform: translateY(-2px);
    box-shadow: 0 6px 12px rgba(102,126,234,0.4);
}

.btn-wa {
    background: linear-gradient(135deg, #11998e 0%, #38ef7d 100%);
}
.btn-wa:hover {
    background: linear-gradient(135deg, #0d8578 0%, #2dd46a 100%);
    transform: translateY(-2px);
    box-shadow: 0 6px 12px rgba(17,153,142,0.4);
}

.wrapper {
    width: 960px;
    margin: 22px auto;
}

.title {
    text-align: center;
    font-size: 28px;
    font-weight: 800;
    text-decoration: underline;
    margin-bottom: 40px;
}

.info-table {
    width: 650px;
    margin: 0 auto 50px auto;
    border-collapse: collapse;
    font-size: 17px;
}

.info-table td {
    border: 1px solid #000;
    padding: 7px 12px;
}

.info-label {
    font-weight: 800;
    color: #002b66;
}

.section-header {
    background: #183772;
    color: #fff;
    font-size: 24px;
    font-weight: 800;
    padding: 4px 8px;
    margin-bottom: 25px;
}

.accommodation-box {
    width: 950px;
    margin: 0 auto;
}

.day-block {
    margin-bottom: 28px;
}

.day-title {
    font-size: 18px;
    color: #002b66;
    font-weight: 800;
    margin-bottom: 6px;
}

.property-line {
    font-size: 16px;
    color: #ff0066;
    font-weight: 800;
}

@media print {
    .topbar {
        display: none;
    }

    .wrapper {
        margin-top: 20px;
    }
}
</style>
</head>

<body>

<div class="topbar no-print">
    <div class="actions">
        <button class="btn-word" onclick="exportToWord()"><i class="la la-file-word"></i> Export to Word</button>
        <button class="btn-wa" onclick="copyWhatsApp()"><i class="la la-whatsapp"></i> Copy WhatsApp Content</button>
    </div>
</div>

<div class="wrapper" id="driverContent">

    <div class="title">Driver's Itinerary</div>

    <table class="info-table">
        <tr>
            <td class="info-label">Ref: <?= htmlspecialchars(di_get($main, 'quotation_number')); ?></td>
            <td class="info-label">Guest Name</td>
            <td><strong><?= htmlspecialchars(di_get($main, 'guest_name')); ?></strong></td>
            <td class="info-label">Phone</td>
            <td><strong><?= htmlspecialchars(di_get($main, 'whats_number')); ?></strong></td>
        </tr>

        <tr>
            <td class="info-label">Start Date</td>
            <td><?= di_date(di_get($main, 'start_date')); ?></td>
            <td class="info-label">End Date</td>
            <td><?= di_date(di_get($main, 'end_date')); ?></td>
            <td><strong>Duration</strong> <?= (int)di_get($main, 'duration', 0); ?> Nights</td>
        </tr>

        <tr>
            <td colspan="2" class="info-label">Arrival Details<br>
                <span style="color:#000;font-weight:400;">
                    <?= htmlspecialchars(di_get($main, 'arriving_destination')); ?>
                </span>
            </td>

            <td colspan="3" class="info-label">Departure Details<br>
                <span style="color:#000;font-weight:400;">
                    <?= htmlspecialchars(di_get($main, 'departuring_destination')); ?>
                </span>
            </td>
        </tr>
    </table>

    <div class="accommodation-box">

        <div class="section-header">Accommodation Plan</div>

        <?php foreach ($days as $d): ?>
            <div class="day-block">
                <div class="day-title">
                    <?= htmlspecialchars(di_get($d, 'quotation_properties_days_day')); ?>:
                    <?= htmlspecialchars(di_get($d, 'state_name')); ?>
                    (<?= di_day_date(di_get($d, 'accommodation_date')); ?>)
                </div>

                <div class="property-line">
                    <?= htmlspecialchars(di_get($d, 'properties_name')); ?> (4 star)
                    <?php
                    $contact = !empty($d['properties_sales_contact_phone_number']) ? $d['properties_sales_contact_phone_number'] : (!empty($d['properties_reservation_contact_phone_number']) ? $d['properties_reservation_contact_phone_number'] : '');
                    if (!empty($contact)):
                    ?>
                        | <?= htmlspecialchars($contact); ?>
                    <?php endif; ?>
                </div>
            </div>
        <?php endforeach; ?>

    </div>

</div>

<script>
function copyWhatsApp() {
    var text = document.getElementById('driverContent').innerText;
    navigator.clipboard.writeText(text).then(function() {
        alert('WhatsApp content copied!');
    }, function(err) {
        console.error('Could not copy: ', err);
    });
}

function exportToWord() {
    var content = document.getElementById('driverContent').innerHTML;

    var styles = `
    <style>
    body {
        font-family: Arial, sans-serif;
        margin: 0;
        background: #fff;
        color: #000;
    }
    .wrapper {
        width: 960px;
        margin: 22px auto;
    }
    .title {
        text-align: center;
        font-size: 28px;
        font-weight: 800;
        text-decoration: underline;
        margin-bottom: 40px;
    }
    .info-table {
        width: 650px;
        margin: 0 auto 50px auto;
        border-collapse: collapse;
        font-size: 17px;
    }
    .info-table td {
        border: 1px solid #000;
        padding: 7px 12px;
    }
    .info-label {
        font-weight: 800;
        color: #002b66;
    }
    .section-header {
        background: #183772;
        color: #fff;
        font-size: 24px;
        font-weight: 800;
        padding: 4px 8px;
        margin-bottom: 25px;
    }
    .accommodation-box {
        width: 950px;
        margin: 0 auto;
    }
    .day-block {
        margin-bottom: 28px;
    }
    .day-title {
        font-size: 18px;
        color: #002b66;
        font-weight: 800;
        margin-bottom: 6px;
    }
    .property-line {
        font-size: 16px;
        color: #ff0066;
        font-weight: 800;
    }
    </style>`;

    var html = '<!DOCTYPE html><html><head><meta charset="utf-8">' + styles + '</head><body>' +
               '<div class="wrapper">' + content + '</div></body></html>';

    var blob = new Blob(['\ufeff', html], {
        type: 'application/msword'
    });

    var link = document.createElement('a');
    link.href = URL.createObjectURL(blob);
    link.download = '<?= preg_replace("/[^A-Za-z0-9\-_]/", "-", di_get($main, "guest_name", "Guest")); ?>-driver-itinerary.doc';
    link.click();
}
</script>

</body>
</html>