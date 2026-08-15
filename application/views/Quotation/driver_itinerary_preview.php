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

.btn-pdf {
    background: linear-gradient(135deg, #dc3545 0%, #c82333 100%);
}
.btn-pdf:hover {
    background: linear-gradient(135deg, #b02a37 0%, #a01e2c 100%);
    transform: translateY(-2px);
    box-shadow: 0 6px 12px rgba(220,53,69,0.4);
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

.day-description {
    margin-top: 6px;
    font-size: 14px;
    color: #333;
    line-height: 1.6;
}

.map-link {
    display: inline-block;
    margin-top: 5px;
    font-size: 13px;
    color: #1a73e8;
    font-weight: 600;
    text-decoration: none;
}

.map-link:hover {
    text-decoration: underline;
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
        <button class="btn-pdf" onclick="exportToPDF()"><i class="la la-file-pdf"></i> Download PDF</button>
        <button class="btn-word" onclick="exportToWord()"><i class="la la-file-word"></i> Export to Word</button>
        <button class="btn-wa" onclick="copyWhatsApp()"><i class="la la-whatsapp"></i> Copy WhatsApp Content</button>
    </div>
</div>

<div class="wrapper" id="driverContent">

    <div class="title">Driver's Itinerary</div>

    <?php $qt = di_get($main, 'quotation_title'); if ($qt && $qt !== '-'): ?>
    <div style="text-align:center; margin-bottom:30px;">
        <span style="display:inline-block; background:#fff3cd; border:2px solid #ffc107; border-radius:8px; padding:10px 24px; font-size:20px; font-weight:800; color:#856404;">
            <?= htmlspecialchars($qt); ?>
        </span>
    </div>
    <?php endif; ?>

    <table class="info-table">
        <tr>
            <td class="info-label">Ref: <?= htmlspecialchars(di_get($main, 'quotation_number')); ?></td>
            <td class="info-label">Trip Code</td>
            <td><strong><?= htmlspecialchars(di_get($main, 'trip_code')); ?></strong></td>
            <td class="info-label">Guest Name</td>
            <td><strong><?= htmlspecialchars(di_get($main, 'guest_name')); ?></strong></td>
        </tr>

        <tr>
            <td class="info-label">Phone</td>
            <td><strong><?= htmlspecialchars(di_get($main, 'whats_number')); ?></strong></td>
            <td class="info-label">Start Date</td>
            <td><?= di_date(di_get($main, 'start_date')); ?></td>
            <td><strong>Duration</strong> <?= (int)di_get($main, 'duration', 0); ?> Nights</td>
        </tr>

        <tr>
            <td class="info-label">End Date</td>
            <td><?= di_date(di_get($main, 'end_date')); ?></td>
            <td colspan="1" class="info-label">Arrival Details<br>
                <span style="color:#000;font-weight:400;">
                    <?= htmlspecialchars(di_get($main, 'arriving_destination')); ?>
                </span>
            </td>

            <td colspan="2" class="info-label">Departure Details<br>
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
                <?php if (!empty($d['properties_google_map_location'])): ?>
                <div>
                    <a class="map-link" href="<?= htmlspecialchars($d['properties_google_map_location']); ?>" target="_blank"><?= htmlspecialchars($d['properties_google_map_location']); ?></a>
                </div>
                <?php endif; ?>
                <?php if (!empty($d['quotation_itineraries_days_description'])): ?>
                <div class="day-description">
                    <?= $d['quotation_itineraries_days_description']; ?>
                </div>
                <?php endif; ?>
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
    .day-description {
        margin-top: 6px;
        font-size: 14px;
        color: #333;
        line-height: 1.6;
    }
    .map-link {
        display: inline-block;
        margin-top: 5px;
        font-size: 13px;
        color: #1a73e8;
        font-weight: 600;
        text-decoration: none;
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

<script src="https://cdnjs.cloudflare.com/ajax/libs/jspdf/2.5.1/jspdf.umd.min.js"></script>
<script src="https://cdnjs.cloudflare.com/ajax/libs/html2canvas/1.4.1/html2canvas.min.js"></script>
<script>
async function exportToPDF() {
    var btnPdf = document.querySelector('.btn-pdf');
    if (btnPdf) { btnPdf.disabled = true; btnPdf.innerHTML = '<i class="la la-spinner la-spin"></i> Generating...'; }

    try {
        var content = document.getElementById('driverContent');
        var canvas = await html2canvas(content, {
            scale: 2,
            useCORS: true,
            backgroundColor: '#ffffff'
        });

        var imgData = canvas.toDataURL('image/png');
        var { jsPDF } = window.jspdf;

        var imgWidth = 210;
        var pageHeight = 297;
        var imgHeight = (canvas.height * imgWidth) / canvas.width;
        var heightLeft = imgHeight;

        var pdf = new jsPDF('p', 'mm', 'a4');
        var position = 0;

        pdf.addImage(imgData, 'PNG', 0, position, imgWidth, imgHeight);
        heightLeft -= pageHeight;

        while (heightLeft > 0) {
            position = heightLeft - imgHeight;
            pdf.addPage();
            pdf.addImage(imgData, 'PNG', 0, position, imgWidth, imgHeight);
            heightLeft -= pageHeight;
        }

        var fileName = '<?= preg_replace("/[^A-Za-z0-9\-_]/", "-", di_get($main, "guest_name", "Guest")); ?>-driver-itinerary.pdf';
        pdf.save(fileName);
    } catch (err) {
        console.error('PDF generation failed:', err);
        alert('Failed to generate PDF. Please try again.');
    } finally {
        if (btnPdf) { btnPdf.disabled = false; btnPdf.innerHTML = '<i class="la la-file-pdf"></i> Download PDF'; }
    }
}
</script>

</body>
</html>