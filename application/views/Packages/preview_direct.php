<!DOCTYPE html>
<html lang="en">
<head>
<meta charset="UTF-8">
<title>Package Preview</title>
<link href="https://fonts.googleapis.com/css2?family=Poppins:wght@300;400;600;700&display=swap" rel="stylesheet">

<style>
:root{
  --brand:#1e3a8a;
  --brand2:#2563eb;
  --green:#2e7d32;
  --text:#111827;
  --muted:#6b7280;
  --line:#e5e7eb;
  --soft:#f8fafc;

  --pdf-width: 285mm;
  --pdf-height: 285mm;
}

body{
  margin:0;
  font-family:'Poppins',sans-serif;
  background:#fff;
  color:var(--text);
  -webkit-print-color-adjust: exact;
  print-color-adjust: exact;
}

.btn-area{
  position:fixed;
  bottom:20px;
  right:20px;
  z-index:9999;
}
button{
  padding:12px 28px;
  border:none;
  background:var(--brand);
  color:#fff;
  font-weight:600;
  border-radius:6px;
  cursor:pointer;
  font-size:14px;
}
button:hover{background:#172554;}

@media print{
  .btn-area,
  .cover-editor-toolbar{
    display:none !important;
  }
}

/* ===== PDF PAGE ===== */
.pdf-page{
  width:var(--pdf-width);
  height:var(--pdf-height);
  margin:0 auto;
  box-sizing:border-box;
  page-break-after:always;
  overflow:hidden;
  position:relative;
  background:#fff;
}

/* ===== COVER PAGE ===== */
.cover-page{
  background:linear-gradient(135deg,var(--brand),var(--brand2));
  color:white;
  display:flex;
  flex-direction:column;
  justify-content:center;
  align-items:center;
  text-align:center;
  padding:40mm 20mm;
  box-sizing:border-box;
}
.cover-page.cover-has-image{
  background-size:cover;
  background-position:center center;
  background-repeat:no-repeat;
}
.cover-page.cover-has-image::before{
  content:"";
  position:absolute;
  inset:0;
  background:rgba(0,0,0,0.18);
}
.cover-page > *{
  position:relative;
  z-index:1;
}

/* editable toolbar */
.cover-editor-toolbar{
  position:absolute;
  top:10mm;
  left:10mm;
  z-index:50;
  display:flex;
  align-items:center;
  gap:8px;
  background:rgba(255,255,255,.96);
  padding:8px 10px;
  border-radius:10px;
  box-shadow:0 4px 14px rgba(0,0,0,.12);
}
.cover-editor-toolbar button,
.cover-editor-toolbar select,
.cover-editor-toolbar input[type="color"]{
  height:34px;
  border:1px solid #d1d5db;
  border-radius:6px;
  background:#fff;
  color:#111;
  font-size:14px;
  padding:0 10px;
}
.cover-editor-toolbar button{
  min-width:36px;
  cursor:pointer;
}
.cover-editor-toolbar .mini-btn{
  padding:0 12px;
}

/* editable title/subtitle */
.cover-title-box{
  position:absolute;
  top:110mm;
  left:50%;
  transform:translateX(-50%);
  z-index:20;
  max-width:80%;
  text-align:center;
  cursor:move;
}
.cover-subtitle-box{
  position:absolute;
  top:145mm;
  left:50%;
  transform:translateX(-50%);
  z-index:20;
  max-width:70%;
  text-align:center;
  cursor:move;
}
.editable-cover{
  outline:none;
  display:inline-block;
  min-width:120px;
  min-height:32px;
  cursor:text;
  user-select:text;
  white-space:pre-wrap;
  word-break:break-word;
}
.cover-title{
  font-size:48px;
  font-weight:700;
  letter-spacing:3px;
  margin:0;
  color:#fff;
  line-height:1.1;
}
.cover-subtitle{
  font-size:22px;
  font-weight:700;
  margin:0;
  color:#fff;
  line-height:1.2;
}
.cover-details{
  margin-top:16px;
  font-size:17px;
  line-height:1.7;
  max-width:145mm;
}
.cover-footer{
  position:absolute;
  bottom:22mm;
  width:100%;
  font-size:14px;
  opacity:.95;
  text-align:center;
}
.last-cover-content{display:none;}

/* ===== BRIEF PAGE ===== */
.brief-page{
  background:#fff;
  padding:0mm 28mm 18mm 28mm;
  position:relative;
}
.brief-logo{
  position:absolute;
  top:6mm;
  right:18mm;
  width:48mm;
  text-align:right;
}
.brief-logo img{
  max-width:63mm;
  height:auto;
}
.brief-header{
  margin-top:24mm;
  margin-bottom:8mm;
  display:flex;
  justify-content:center;
}
.brief-header-inner{
  width:70%;
  max-width:185mm;
  display:flex;
  align-items:center;
  gap:14px;
}
.brief-icon-wrap{
  flex:0 0 auto;
  display:flex;
  align-items:center;
  justify-content:center;
}
.brief-icon-img{
  width:40mm;
  height:auto;
  display:block;
}
.brief-title{
  color:#3a8553;
  font-size:40px;
  font-weight:600;
  line-height:1.05;
  letter-spacing:1px;
  text-transform:uppercase;
  text-align:left;
}
.brief-list{
  margin-top:8mm;
  display:flex;
  flex-direction:column;
  align-items:center;
}
.brief-row{
  background:#3a8553;
  border-radius:30px;
  min-height:18mm;
  display:flex;
  align-items:center;
  width:70%;
  max-width:185mm;
  padding:0 10mm;
  margin-bottom:10px;
}
.brief-day{
  background:#fff;
  color:#3a8553;
  border-radius:20px;
  min-width:27mm;
  height:11mm;
  display:flex;
  align-items:center;
  justify-content:center;
  font-size:20px;
  font-weight:601;
  margin-right:12mm;
  white-space:nowrap;
}
.brief-route{
  color:#fff;
  font-size:25px;
  font-weight:501;
  letter-spacing:.4px;
  text-transform:uppercase;
  line-height:1.2;
  flex:1;
}

/* ===== DAY PAGE ===== */
.daypage{
  padding:10mm 0 0 0;
}
.daypage-logo{
  position:absolute;
  top:4mm;
  right:12mm;
  width:52mm;
  text-align:right;
  z-index:5;
}
.daypage-logo img{
  max-width:63mm;
  height:auto;
}
.daypage-top{
  position:relative;
  padding-top:2mm;
  margin:0 12mm 5mm 12mm;
  display:flex;
  align-items:center;
  gap:12px;
  min-height:18mm;
}
.day-pill{
  background:var(--green);
  color:#fff;
  font-weight:700;
  border-radius:999px;
  padding:7px 14px;
  font-size:15px;
  white-space:nowrap;
}
.route-title{
  font-size:24px;
  font-weight:600;
  letter-spacing:.4px;
  text-transform:uppercase;
  padding-right:70mm;
  line-height:1.2;
  flex:1;
}
.day-desc{
  font-size:22px;
  line-height:1.5;
  color:#000;
  margin:0 12mm 6mm 12mm;
  padding-right:0;
  max-width:none;
  word-break:normal;
  overflow-wrap:break-word;
}
.day-desc p{ margin:0 0 10px 0; }
.day-desc ul, .day-desc ol{ margin:6px 0 6px -22px; }

.hero{
  display:block;
  width:100%;
  height:135mm;
  object-fit:cover;
  margin:0;
}

/* ===== COMMON FOOTER ===== */
.footer,
.footer-lite{
  position:absolute;
  left:12mm;
  right:12mm;
  bottom:6mm;
  padding-top:0;
  border-top:none;
  display:flex;
  justify-content:center;
  gap:18px;
  color:var(--green);
  font-size:16px;
  background:#fff;
}
.fitem{
  display:flex;
  gap:8px;
  align-items:center;
  color:var(--green);
}
.ficon{
  width:14px;
  height:14px;
  display:inline-flex;
  align-items:center;
  justify-content:center;
  color:var(--green);
  flex:0 0 14px;
}
.ficon svg{
  width:14px;
  height:14px;
  display:block;
  stroke:currentColor;
  fill:none;
  stroke-width:2;
  stroke-linecap:round;
  stroke-linejoin:round;
}

/* ===== CONTENT PAGES ===== */
.content-page{
  height:var(--pdf-height);
  padding:18mm 18mm 16mm 18mm;
  box-sizing:border-box;
  background:#fff;
  position:relative;
}
.content-logo{
  position:absolute;
  top:12mm;
  right:18mm;
  width:52mm;
  text-align:right;
}
.content-logo img{
  max-width:63mm;
  height:auto;
}
.content-top{
  padding-top:18mm;
  margin-bottom:10mm;
}
.content-title{
  display:inline-block;
  background:var(--green);
  color:#fff;
  padding:8px 18px;
  border-radius:999px;
  font-size:22px;
  font-weight:700;
  letter-spacing:.4px;
}
.box-grid{
  display:grid;
  grid-template-columns:1fr 1fr;
  gap:10mm;
}
.info-box{
  background:#fff;
  border:1px solid var(--line);
  border-radius:16px;
  padding:18px 18px 14px 18px;
  box-shadow:0 4px 14px rgba(0,0,0,0.04);
}
.info-box.green{ border-top:6px solid #22c55e; }
.info-box.red{ border-top:6px solid #ef4444; }
.info-box.blue{ border-top:6px solid #2563eb; }
.info-box.orange{ border-top:6px solid #f59e0b; }
.info-box.purple{ border-top:6px solid #8b5cf6; }
.info-box.teal{ border-top:6px solid #14b8a6; }

.info-box h3{
  margin:0 0 12px 0;
  font-size:20px;
  font-weight:700;
}
.clean-list{
  list-style:none;
  margin:0;
  padding:0;
}
.clean-list li{
  position:relative;
  padding-left:22px;
  margin-bottom:10px;
  line-height:1.5;
  font-size:14px;
  color:#374151;
}
.clean-list li:before{
  content:"➤";
  position:absolute;
  left:0;
  top:0;
  color:var(--green);
  font-weight:700;
}
.check-list li:before{ color:#16a34a; content:"✔"; }
.cross-list li:before{ color:#dc2626; content:"✖"; }
.note-list li:before{ color:#f97316; content:"→"; }

.single-box{
  margin-top:2mm;
}
.single-box .info-box{
  margin-bottom:8mm;
}
.empty-text{
  color:#9ca3af;
  font-size:14px;
}

/* ===== PROPERTY PAGES ===== */
.property-page{
  height:var(--pdf-height);
  padding:16mm 4mm 12mm 4mm;
  background:#fff;
  box-sizing:border-box;
  position:relative;
}
.property-header{
  display:flex;
  justify-content:space-between;
  align-items:flex-start;
  margin-bottom:12px;
}
.property-contact{
  font-size:14px;
  font-weight:600;
}
.property-logo img{
  width:60mm;
}
.property-main-title{
  font-size:25px;
  font-weight:700;
  margin-top:8px;
  margin-bottom:25px;
}
.property-category{
  display:inline-block;
  background:#d7d7d7;
  padding:6px 14px;
  font-weight:700;
  margin-bottom:35px;
}
.accommodation-heading{
  display:flex;
  align-items:center;
  gap:12px;
  margin-bottom:10px;
}
.accommodation-title{
  font-size:22px;
  font-weight:550;
  color:#9a9a9a;
}
.icon-group{
  display:flex;
  align-items:center;
  gap:8px;
}
.dots{
  display:flex;
  flex-direction:column;
  gap:4px;
}
.dots span{
  width:5px;
  height:4px;
  background:#bdbdbd;
  border-radius:50%;
  display:block;
}
.lines{
  display:flex;
  flex-direction:column;
  gap:6px;
}
.lines span{
  width:28px;
  height:2px;
  background:#bdbdbd;
  display:block;
}
.property-table{
  width:100%;
  border-collapse:separate;
  border-spacing:3px;
}
.property-table th{
  background:#bfbfbf;
  padding:10px;
  font-weight:700;
  font-size:14px;
}
.property-table td{
  padding:8px;
  font-size:13px;
  line-height:1.4;
}
.property-table tbody tr:nth-child(odd) td{
  background:#ffffff;
}
.property-table tbody tr:nth-child(even) td{
  background:#d7d7d7;
}

.standard-wrap{
  margin-top:16mm;
  background:#efefef;
  border:1px solid #d7d7d7;
  padding:10mm 10mm 8mm 10mm;
}
.standard-topline{
  display:flex;
  justify-content:space-between;
  align-items:flex-start;
  margin-bottom:8mm;
}
.standard-contact{
  font-size:13px;
  color:#111;
  line-height:1.8;
  font-weight:600;
}
.standard-logo-inline{
  text-align:right;
}
.standard-logo-inline img{
  max-width:52mm;
  height:auto;
}
.standard-main-title{
  text-align:center;
  font-size:24px;
  font-weight:700;
  letter-spacing:1px;
  margin:5mm 0 7mm 0;
  color:#000;
  text-transform:uppercase;
}
.standard-package-type{
  display:inline-block;
  background:#cfcfcf;
  color:#000;
  font-size:16px;
  font-weight:700;
  padding:7px 14px;
  margin-bottom:6mm;
}
.standard-section-title{
  margin:3mm 0 4mm 0;
  padding:7px 12px;
  background:#f4f4f4;
  color:#b4b4b4;
  font-size:18px;
  font-weight:700;
  text-transform:uppercase;
  border-left:4px solid #d6d6d6;
}
.standard-table{
  width:100%;
  border-collapse:separate;
  border-spacing:3px;
  table-layout:fixed;
}
.standard-table th{
  background:#bdbdbd;
  color:#000;
  font-size:13px;
  font-weight:700;
  padding:10px 8px;
  text-align:center;
}
.standard-table td{
  background:#e9e9e9;
  color:#222;
  font-size:13px;
  padding:10px 8px;
  text-align:center;
  word-wrap:break-word;
}
.standard-table tr:nth-child(even) td{
  background:#c8c8c8;
}

/* ===== EXCLUSIVE ===== */
.exclusive-page{
  width:var(--pdf-width);
  height:var(--pdf-height);
  page-break-after:always;
  position:relative;
  overflow:hidden;
  box-sizing:border-box;
  font-family:'Poppins',sans-serif;
  background:
    radial-gradient(circle at center, #ffffff 0%, #f7efe8 45%, #f1e6db 100%),
    linear-gradient(135deg, #f7efe8 0%, #efe2d6 100%);
}
.exclusive-page::before{
  content:"";
  position:absolute;
  inset:0;
  background:
    radial-gradient(circle at 20% 20%, rgba(255,255,255,0.35) 0, rgba(255,255,255,0) 22%),
    radial-gradient(circle at 80% 30%, rgba(255,255,255,0.22) 0, rgba(255,255,255,0) 20%),
    radial-gradient(circle at 40% 75%, rgba(255,255,255,0.18) 0, rgba(255,255,255,0) 24%);
  opacity:.8;
  pointer-events:none;
}
.exclusive-inner{
  position:relative;
  z-index:1;
  padding:10mm 8mm 0 8mm;
  min-height:100%;
  box-sizing:border-box;
}
.exclusive-logo-wrap{
  text-align:center;
  margin-top:2mm;
}
.exclusive-ornament-top,
.exclusive-ornament-bottom{
  text-align:center;
  line-height:0;
}
.exclusive-ornament-top img,
.exclusive-ornament-bottom img{
  max-width:92mm;
  width:100%;
  height:auto;
}
.exclusive-logo{
  text-align:center;
  margin:3mm 0 2mm 0;
}
.exclusive-logo img{
  max-width:56mm;
  height:auto;
}
.exclusive-package-title{
  margin:8px 0 4px 0;
  text-align:center;
  font-family:Georgia, "Times New Roman", serif;
  font-size:23px;
  line-height:1.25;
  font-weight:400;
  color:#2a211a;
}
.exclusive-summary-band{
  width:calc(100% + 16mm);
  margin-left:-8mm;
  margin-right:-8mm;
  margin-top:3mm;
  margin-bottom:7mm;
  background:#eadcc8;
  border-top:2px solid #c9ab76;
  border-bottom:2px solid #c9ab76;
  padding:7px 8mm 9px 8mm;
  box-sizing:border-box;
  text-align:center;
}
.exclusive-summary-title{
  font-family:Georgia, "Times New Roman", serif;
  font-size:19px;
  font-weight:700;
  letter-spacing:.4px;
  text-transform:uppercase;
  color:#241b14;
  margin-bottom:4px;
}
.exclusive-section-title{
  text-align:center;
  margin:6mm 0 7mm 0;
  font-family:Georgia, "Times New Roman", serif;
  font-size:21px;
  font-weight:400;
  color:#231a14;
  text-transform:uppercase;
  letter-spacing:.5px;
}
.exclusive-table-wrap{
  margin:0 0 8mm 0;
}
.exclusive-table{
  width:100%;
  border-collapse:separate;
  border-spacing:0;
  table-layout:fixed;
}
.exclusive-table th{
  background:#145c25;
  color:#fff;
  border-right:3px solid #ffffff;
  border-bottom:3px solid #ffffff;
  padding:8px 6px;
  text-align:center;
  font-size:13px;
  font-weight:700;
  line-height:1.2;
  text-transform:uppercase;
}
.exclusive-table th:last-child{ border-right:none; }
.exclusive-table td{
  text-align:center;
  font-size:12px;
  line-height:1.25;
  color:#1f1b16;
  border-right:3px solid #f4efe7;
  border-bottom:3px solid #f4efe7;
  font-weight:500;
  background:#f5f0e9;
  word-wrap:break-word;
}
.exclusive-table td:last-child{ border-right:none; }
.exclusive-table tbody tr:nth-child(even) td{
  background:#d8dfd4;
}
.exclusive-table tbody td:first-child{
  background:#d9c7aa !important;
  color:#a05b20;
  font-weight:700;
}
.exclusive-table tbody td:nth-child(2){ font-weight:700; }
.exclusive-table tbody td:nth-child(3),
.exclusive-table tbody td:nth-child(4),
.exclusive-table tbody td:nth-child(5){ font-weight:600; }

.exclusive-footer-band{
  position:absolute;
  left:0;
  right:0;
  bottom:0;
  height:44mm;
  background:
    radial-gradient(circle at center, rgba(255,255,255,0.15) 0%, rgba(255,255,255,0) 60%),
    linear-gradient(180deg, #355f62 0%, #24464d 100%);
  border-top:3px solid #b99a5d;
}
.exclusive-footer-content{
  position:absolute;
  left:10mm;
  right:10mm;
  bottom:8mm;
  display:flex;
  justify-content:space-between;
  align-items:flex-end;
  color:#000;
}
.exclusive-footer-left,
.exclusive-footer-right{
  width:42%;
}
.exclusive-footer-item{
  display:flex;
  align-items:center;
  gap:8px;
  margin-bottom:6px;
  font-size:12px;
  color:#000;
  font-weight:600;
}
.exclusive-gold-icon{
  color:#d4b06a;
  width:16px;
  height:16px;
  display:inline-flex;
  align-items:center;
  justify-content:center;
  flex:0 0 16px;
}
.exclusive-gold-icon svg{
  width:16px;
  height:16px;
  stroke:currentColor;
  fill:none;
  stroke-width:2;
  stroke-linecap:round;
  stroke-linejoin:round;
  display:block;
}
</style>
</head>

<body>

<?php
$companyPhone = '917907648636';
$companyEmail = 'bookings@royaleindia.com';
$companyWeb   = 'www.royaleindia.in';
$companyInsta = 'royale_india_tours';

$ICON_PHONE = '
<svg viewBox="0 0 24 24" aria-hidden="true">
  <path d="M22 16.92v3a2 2 0 0 1-2.18 2 19.86 19.86 0 0 1-8.63-3.07 19.5 19.5 0 0 1-6-6A19.86 19.86 0 0 1 2.12 4.18 2 2 0 0 1 4.11 2h3a2 2 0 0 1 2 1.72c.12.9.33 1.77.61 2.61a2 2 0 0 1-.45 2.11L8 9.91a16 16 0 0 0 6.09 6.09l1.47-1.27a2 2 0 0 1 2.11-.45c.84.28 1.71.49 2.61.61A2 2 0 0 1 22 16.92z"/>
</svg>';

$ICON_WEB = '
<svg viewBox="0 0 24 24" aria-hidden="true">
  <circle cx="12" cy="12" r="10"></circle>
  <path d="M2 12h20"></path>
  <path d="M12 2a15.3 15.3 0 0 1 4 10 15.3 15.3 0 0 1-4 10 15.3 15.3 0 0 1-4-10 15.3 15.3 0 0 1 4-10z"></path>
</svg>';

$ICON_INSTAGRAM = '
<svg viewBox="0 0 24 24" aria-hidden="true">
  <rect x="3" y="3" width="18" height="18" rx="5" ry="5"></rect>
  <circle cx="12" cy="12" r="4"></circle>
  <circle cx="17.5" cy="6.5" r="1"></circle>
</svg>';

$ICON_PHONE_GOLD = $ICON_PHONE;
$ICON_EMAIL_GOLD = '
<svg viewBox="0 0 24 24" aria-hidden="true">
  <path d="M4 4h16v16H4z"></path>
  <path d="M4 7l8 6 8-6"></path>
</svg>';
$ICON_WEB_GOLD = $ICON_WEB;
?>

<div class="btn-area">
  <button onclick="downloadPDF()">Download PDF</button>
</div>

<div id="pdf-content">

  <!-- FIRST COVER -->
  <div class="pdf-page cover-page <?php echo !empty($package->packages_first_cover_page) ? 'cover-has-image' : ''; ?>"
       id="firstCoverPage"
       style="<?php echo !empty($package->packages_first_cover_page) ? "background-image:url('".base_url('uploads/packages_cover/'.$package->packages_first_cover_page)."');" : ''; ?>">

    <div class="cover-editor-toolbar" id="coverEditorToolbar">
      <button type="button" class="mini-btn" onclick="applyStyleToActive('bold')"><b>B</b></button>
      <button type="button" class="mini-btn" onclick="applyStyleToActive('italic')"><i>I</i></button>

      <select id="coverFontSize" onchange="changeActiveFontSize(this.value)">
        <option value="20">20</option>
        <option value="22">22</option>
        <option value="24">24</option>
        <option value="32">32</option>
        <option value="40">40</option>
        <option value="48" selected>48</option>
        <option value="56">56</option>
        <option value="64">64</option>
        <option value="72">72</option>
      </select>

      <input type="color" id="coverFontColor" value="#ffffff" onchange="changeActiveColor(this.value)">

      <button type="button" class="mini-btn" onclick="resetActiveElement()">Reset</button>
    </div>

    <div id="coverTitleBox" class="cover-title-box">
      <div class="cover-title editable-cover" id="coverTitleEditor" contenteditable="true">TRAVEL ITINERARY</div>
    </div>

    <div id="coverSubtitleBox" class="cover-subtitle-box">
      <div class="cover-subtitle editable-cover" id="coverSubtitleEditor" contenteditable="true">
        <?php echo !empty($package->packages_title) ? htmlspecialchars($package->packages_title) : 'Loading...'; ?>
      </div>
    </div>
  </div>

  <!-- BRIEF PAGE -->
  <div class="pdf-page brief-page" id="briefPage">
    <div class="brief-logo">
      <img src="<?= base_url('assets/images/Royale-logo-new.png'); ?>" alt="Logo">
    </div>

    <div class="brief-header">
      <div class="brief-header-inner">
        <div class="brief-icon-wrap">
          <img src="<?= base_url('assets/images/brief-itinerary-icon.png'); ?>" alt="Brief Icon" class="brief-icon-img">
        </div>
        <div class="brief-title">
          BRIEF<br>ITINERARY
        </div>
      </div>
    </div>

    <div class="brief-list">
      <?php if (!empty($itinerary)): ?>
        <?php foreach ($itinerary as $index => $day): ?>
          <div class="brief-row">
            <div class="brief-day">Day <?php echo str_pad(($index + 1), 2, '0', STR_PAD_LEFT); ?></div>
            <div class="brief-route"><?php echo strtoupper(htmlspecialchars($day->packages_itineraries_days_title)); ?></div>
          </div>
        <?php endforeach; ?>
      <?php endif; ?>
    </div>
  </div>

  <!-- ITINERARY DAY PAGES -->
  <?php if (!empty($itinerary)): ?>
    <?php foreach ($itinerary as $index => $day): ?>
      <?php
        $dayImage = '';
        if (!empty($day->packages_itineraries_days_image)) {
            $dayImage = base_url('uploads/package_day_images/'.$day->packages_itineraries_days_image);
        } elseif (!empty($day->itineraries_days_image)) {
            $dayImage = base_url('uploads/itinerary_days/'.$day->itineraries_days_image);
        }
      ?>
      <div class="pdf-page daypage">
        <div class="daypage-logo">
          <img src="<?= base_url('assets/images/Royale-logo-new.png'); ?>" alt="Logo">
        </div>

        <div class="daypage-top">
          <div class="day-pill">Day <?php echo str_pad(($index + 1), 2, '0', STR_PAD_LEFT); ?></div>
          <div class="route-title"><?php echo htmlspecialchars($day->packages_itineraries_days_title); ?></div>
        </div>

        <div class="day-desc">
          <?php echo !empty($day->packages_itineraries_days_description) ? $day->packages_itineraries_days_description : ''; ?>
        </div>

        <?php if (!empty($dayImage)): ?>
          <img class="hero" src="<?php echo $dayImage; ?>" alt="">
        <?php endif; ?>

        <div class="footer">
          <div class="fitem"><span class="ficon"><?= $ICON_PHONE; ?></span><?= $companyPhone; ?></div>
          <div class="fitem"><span class="ficon"><?= $ICON_WEB; ?></span><?= $companyWeb; ?></div>
          <div class="fitem"><span class="ficon"><?= $ICON_INSTAGRAM; ?></span><?= $companyInsta; ?></div>
        </div>
      </div>
    <?php endforeach; ?>
  <?php endif; ?>

  <!-- INCLUSIONS / EXCLUSIONS -->
  <?php if (!empty($inclusions) || !empty($exclusions)): ?>
  <div class="pdf-page content-page">
    <div class="content-logo">
      <img src="<?= base_url('assets/images/Royale-logo-new.png'); ?>" alt="Logo">
    </div>

    <div class="content-top">
      <div class="content-title">Inclusions & Exclusions</div>
    </div>

    <div class="box-grid">
      <div class="info-box green">
        <h3>Inclusions</h3>
        <?php if (!empty($inclusions)): ?>
          <ul class="clean-list check-list">
            <?php foreach ($inclusions as $row): ?>
              <li><?php echo htmlspecialchars($row->packages_inclusions_details); ?></li>
            <?php endforeach; ?>
          </ul>
        <?php else: ?>
          <div class="empty-text">No inclusions available.</div>
        <?php endif; ?>
      </div>

      <div class="info-box red">
        <h3>Exclusions</h3>
        <?php if (!empty($exclusions)): ?>
          <ul class="clean-list cross-list">
            <?php foreach ($exclusions as $row): ?>
              <li><?php echo htmlspecialchars($row->packages_exclusions_details); ?></li>
            <?php endforeach; ?>
          </ul>
        <?php else: ?>
          <div class="empty-text">No exclusions available.</div>
        <?php endif; ?>
      </div>
    </div>

    <div class="footer-lite">
      <div class="fitem"><span class="ficon"><?= $ICON_PHONE; ?></span><?= $companyPhone; ?></div>
      <div class="fitem"><span class="ficon"><?= $ICON_WEB; ?></span><?= $companyWeb; ?></div>
      <div class="fitem"><span class="ficon"><?= $ICON_INSTAGRAM; ?></span><?= $companyInsta; ?></div>
    </div>
  </div>
  <?php endif; ?>

  <!-- OPTIONAL ADD ON -->
  <?php if (!empty($optional_addons)): ?>
  <div class="pdf-page content-page">
    <div class="content-logo">
      <img src="<?= base_url('assets/images/Royale-logo-new.png'); ?>" alt="Logo">
    </div>

    <div class="content-top">
      <div class="content-title">Optional Add On</div>
    </div>

    <div class="single-box">
      <div class="info-box orange">
        <h3>Optional Add Ons</h3>
        <ul class="clean-list">
          <?php foreach ($optional_addons as $row): ?>
            <li><?php echo htmlspecialchars($row->packages_optional_add_on_details); ?></li>
          <?php endforeach; ?>
        </ul>
      </div>
    </div>

    <div class="footer-lite">
      <div class="fitem"><span class="ficon"><?= $ICON_PHONE; ?></span><?= $companyPhone; ?></div>
      <div class="fitem"><span class="ficon"><?= $ICON_WEB; ?></span><?= $companyWeb; ?></div>
      <div class="fitem"><span class="ficon"><?= $ICON_INSTAGRAM; ?></span><?= $companyInsta; ?></div>
    </div>
  </div>
  <?php endif; ?>

  <!-- PAYMENT POLICIES -->
  <?php if (!empty($payment)): ?>
  <div class="pdf-page content-page">
    <div class="content-logo">
      <img src="<?= base_url('assets/images/Royale-logo-new.png'); ?>" alt="Logo">
    </div>

    <div class="content-top">
      <div class="content-title">Payment Policies</div>
    </div>

    <div class="single-box">
      <div class="info-box blue">
        <h3>Payment Policies</h3>
        <ul class="clean-list">
          <?php foreach ($payment as $row): ?>
            <?php if (!empty($row->packages_payment_policies_details)): ?>
              <li><?php echo nl2br(htmlspecialchars($row->packages_payment_policies_details)); ?></li>
            <?php endif; ?>
          <?php endforeach; ?>
        </ul>
      </div>
    </div>

    <div class="footer-lite">
      <div class="fitem"><span class="ficon"><?= $ICON_PHONE; ?></span><?= $companyPhone; ?></div>
      <div class="fitem"><span class="ficon"><?= $ICON_WEB; ?></span><?= $companyWeb; ?></div>
      <div class="fitem"><span class="ficon"><?= $ICON_INSTAGRAM; ?></span><?= $companyInsta; ?></div>
    </div>
  </div>
  <?php endif; ?>

  <!-- TERMS -->
  <?php if (!empty($terms)): ?>
  <div class="pdf-page content-page">
    <div class="content-logo">
      <img src="<?= base_url('assets/images/Royale-logo-new.png'); ?>" alt="Logo">
    </div>

    <div class="content-top">
      <div class="content-title">Terms & Condition</div>
    </div>

    <div class="single-box">
      <div class="info-box purple">
        <h3>Terms & Conditions</h3>
        <ul class="clean-list">
          <?php foreach ($terms as $row): ?>
            <?php if (!empty($row->packages_terms_condition_details)): ?>
              <li><?php echo nl2br(htmlspecialchars($row->packages_terms_condition_details)); ?></li>
            <?php endif; ?>
          <?php endforeach; ?>
        </ul>
      </div>
    </div>

    <div class="footer-lite">
      <div class="fitem"><span class="ficon"><?= $ICON_PHONE; ?></span><?= $companyPhone; ?></div>
      <div class="fitem"><span class="ficon"><?= $ICON_WEB; ?></span><?= $companyWeb; ?></div>
      <div class="fitem"><span class="ficon"><?= $ICON_INSTAGRAM; ?></span><?= $companyInsta; ?></div>
    </div>
  </div>
  <?php endif; ?>

  <!-- CANCELLATION -->
  <?php if (!empty($cancel)): ?>
  <div class="pdf-page content-page">
    <div class="content-logo">
      <img src="<?= base_url('assets/images/Royale-logo-new.png'); ?>" alt="Logo">
    </div>

    <div class="content-top">
      <div class="content-title">Cancellation Policy</div>
    </div>

    <div class="single-box">
      <div class="info-box teal">
        <h3>Cancellation Policy</h3>
        <ul class="clean-list">
          <?php foreach ($cancel as $row): ?>
            <?php if (!empty($row->packages_cancellation_policies_details)): ?>
              <li><?php echo nl2br(htmlspecialchars($row->packages_cancellation_policies_details)); ?></li>
            <?php endif; ?>
          <?php endforeach; ?>
        </ul>
      </div>
    </div>

    <div class="footer-lite">
      <div class="fitem"><span class="ficon"><?= $ICON_PHONE; ?></span><?= $companyPhone; ?></div>
      <div class="fitem"><span class="ficon"><?= $ICON_WEB; ?></span><?= $companyWeb; ?></div>
      <div class="fitem"><span class="ficon"><?= $ICON_INSTAGRAM; ?></span><?= $companyInsta; ?></div>
    </div>
  </div>
  <?php endif; ?>

  <!-- NOTES -->
  <?php if (!empty($notes)): ?>
  <div class="pdf-page content-page">
    <div class="content-logo">
      <img src="<?= base_url('assets/images/Royale-logo-new.png'); ?>" alt="Logo">
    </div>

    <div class="content-top">
      <div class="content-title">Notes</div>
    </div>

    <div class="single-box">
      <div class="info-box orange">
        <h3>Notes</h3>
        <ul class="clean-list note-list">
          <?php foreach ($notes as $row): ?>
            <?php if (!empty($row->packages_notes_details)): ?>
              <li><?php echo nl2br(htmlspecialchars($row->packages_notes_details)); ?></li>
            <?php endif; ?>
          <?php endforeach; ?>
        </ul>
      </div>
    </div>

    <div class="footer-lite">
      <div class="fitem"><span class="ficon"><?= $ICON_PHONE; ?></span><?= $companyPhone; ?></div>
      <div class="fitem"><span class="ficon"><?= $ICON_WEB; ?></span><?= $companyWeb; ?></div>
      <div class="fitem"><span class="ficon"><?= $ICON_INSTAGRAM; ?></span><?= $companyInsta; ?></div>
    </div>
  </div>
  <?php endif; ?>

  <!-- PROPERTY PAGES -->
  <?php if (!empty($properties)): ?>
    <?php foreach ($properties as $cat): ?>
      <?php
        $designType = !empty($cat->packages_properties_common_design_type)
          ? strtolower(trim($cat->packages_properties_common_design_type))
          : 'standard';

        $categoryTitle = !empty($cat->packages_properties_common_category_name)
          ? $cat->packages_properties_common_category_name
          : 'Accommodation Summary';
      ?>

      <?php if ($designType === 'exclusive'): ?>
        <?php
        $exclusiveRows = array();

        if (!empty($cat->days)) {
          foreach ($cat->days as $day) {
            if (!empty($day->rows)) {
              foreach ($day->rows as $prop) {
                $propertyNames = array();
                $roomNames = array();

                if (!empty($prop->property_name) && $prop->property_name !== '-') {
                  $propertyNames[] = $prop->property_name;
                }

                if (!empty($prop->rooms) && is_array($prop->rooms)) {
                  foreach ($prop->rooms as $roomName) {
                    if (!empty($roomName) && $roomName !== '-') {
                      $roomNames[] = $roomName;
                    }
                  }
                }

                $exclusiveRows[] = array(
                  'day_no' => !empty($day->day_no) ? $day->day_no : '',
                  'destination' => !empty($day->destination_name) ? $day->destination_name : '-',
                  'hotel' => !empty($propertyNames) ? implode(', ', array_unique($propertyNames)) : '-',
                  'room' => !empty($roomNames) ? implode(', ', array_unique($roomNames)) : '-',
                  'meal' => '-'
                );
              }
            } else {
              $exclusiveRows[] = array(
                'day_no' => !empty($day->day_no) ? $day->day_no : '',
                'destination' => !empty($day->destination_name) ? $day->destination_name : '-',
                'hotel' => '-',
                'room' => '-',
                'meal' => '-'
              );
            }
          }
        }
        ?>

        <?php if (!empty($exclusiveRows)): ?>
        <div class="pdf-page exclusive-page">
          <div class="exclusive-inner">

            <div class="exclusive-logo-wrap">
              <div class="exclusive-ornament-top">
                <img src="<?= base_url('assets/images/exclusive-ornament-top.png'); ?>" alt="">
              </div>

              <div class="exclusive-logo">
                <img src="<?= base_url('assets/images/Royale-logo-gold.png'); ?>" alt="Logo">
              </div>

              <div class="exclusive-ornament-bottom">
                <img src="<?= base_url('assets/images/exclusive-ornament-bottom.png'); ?>" alt="">
              </div>
            </div>

            <div class="exclusive-package-title">
              <?= htmlspecialchars($package->packages_title); ?>
            </div>

            <div class="exclusive-summary-band">
              <div class="exclusive-summary-title">Package Cost &amp; Accommodation Summary</div>
            </div>

            <div class="exclusive-section-title">ACCOMODATION DETAILS</div>

            <div class="exclusive-table-wrap">
              <table class="exclusive-table">
                <thead>
                  <tr>
                    <th style="width:16%;">Day</th>
                    <th style="width:17%;">Destination</th>
                    <th style="width:25%;">Hotel / Stay</th>
                    <th style="width:20%;">Room Type</th>
                    <th style="width:22%;">Meal Plan</th>
                  </tr>
                </thead>
                <tbody>
                  <?php foreach ($exclusiveRows as $row): ?>
                    <tr>
                      <td><?= htmlspecialchars($row['day_no']); ?></td>
                      <td><?= htmlspecialchars($row['destination']); ?></td>
                      <td><?= htmlspecialchars($row['hotel']); ?></td>
                      <td><?= htmlspecialchars($row['room']); ?></td>
                      <td><?= htmlspecialchars($row['meal']); ?></td>
                    </tr>
                  <?php endforeach; ?>
                </tbody>
              </table>
            </div>

          </div>

          <div class="exclusive-footer-band">
            <div class="exclusive-footer-content">
              <div class="exclusive-footer-left">
                <div class="exclusive-footer-item">
                  <span class="exclusive-gold-icon"><?= $ICON_WEB_GOLD; ?></span>
                  <span><?= $companyWeb; ?></span>
                </div>
              </div>

              <div class="exclusive-footer-right">
                <div class="exclusive-footer-item">
                  <span class="exclusive-gold-icon"><?= $ICON_PHONE_GOLD; ?></span>
                  <span><?= $companyPhone; ?></span>
                </div>
                <div class="exclusive-footer-item">
                  <span class="exclusive-gold-icon"><?= $ICON_EMAIL_GOLD; ?></span>
                  <span><?= $companyEmail; ?></span>
                </div>
              </div>
            </div>
          </div>
        </div>
        <?php endif; ?>

      <?php else: ?>
        <div class="pdf-page property-page">
          <div class="standard-wrap">
            <div class="standard-topline">
              <div class="standard-contact">
                Phone: <?= $companyPhone; ?><br>
                Website: <?= $companyWeb; ?><br>
                Instagram: <?= $companyInsta; ?>
              </div>
              <div class="standard-logo-inline">
                <img src="<?= base_url('assets/images/Royale-logo-new.png'); ?>" alt="Logo">
              </div>
            </div>

            <div class="standard-main-title"><?= htmlspecialchars($package->packages_title); ?></div>
            <div class="standard-package-type"><?= htmlspecialchars($categoryTitle); ?></div>
            <div class="standard-section-title">Accommodation Details</div>

            <table class="standard-table">
              <thead>
                <tr>
                  <th>Day</th>
                  <th>Destination</th>
                  <th>Hotel Name</th>
                  <th>Room Category</th>
                  <th>Meal Plan</th>
                </tr>
              </thead>
              <tbody>
                <?php if (!empty($cat->days)): ?>
                  <?php foreach ($cat->days as $day): ?>
                    <?php
                      $propertyNames = array();
                      $roomNames = array();

                      if (!empty($day->rows)) {
                        foreach ($day->rows as $prop) {
                          if (!empty($prop->property_name) && $prop->property_name !== '-') {
                            $propertyNames[] = $prop->property_name;
                          }
                          if (!empty($prop->rooms) && is_array($prop->rooms)) {
                            foreach ($prop->rooms as $roomName) {
                              if (!empty($roomName) && $roomName !== '-') {
                                $roomNames[] = $roomName;
                              }
                            }
                          }
                        }
                      }

                      $propertyText = !empty($propertyNames) ? implode(', ', array_unique($propertyNames)) : '-';
                      $roomText = !empty($roomNames) ? implode(', ', array_unique($roomNames)) : '-';
                    ?>
                    <tr>
                      <td><?= htmlspecialchars($day->day_no); ?></td>
                      <td><?= htmlspecialchars($day->destination_name); ?></td>
                      <td><?= htmlspecialchars($propertyText); ?></td>
                      <td><?= htmlspecialchars($roomText); ?></td>
                      <td>-</td>
                    </tr>
                  <?php endforeach; ?>
                <?php endif; ?>
              </tbody>
            </table>
          </div>
        </div>
      <?php endif; ?>
    <?php endforeach; ?>
  <?php endif; ?>

  <!-- LAST COVER -->
  <div class="pdf-page cover-page <?php echo !empty($package->packages_last_cover_page) ? 'cover-has-image' : ''; ?>"
       id="lastCoverPage"
       style="<?php echo !empty($package->packages_last_cover_page) ? "background-image:url('".base_url('uploads/packages_cover/'.$package->packages_last_cover_page)."');" : 'background:linear-gradient(135deg,var(--brand),var(--brand2));'; ?>">
    <div class="last-cover-content"></div>
  </div>

</div>

<script src="https://cdnjs.cloudflare.com/ajax/libs/jspdf/2.5.1/jspdf.umd.min.js"></script>
<script src="https://cdnjs.cloudflare.com/ajax/libs/html2canvas/1.4.1/html2canvas.min.js"></script>

<script>
let activeEditableId = 'coverTitleEditor';

function setActiveEditable(id){
  activeEditableId = id;
  const colorInput = document.getElementById('coverFontColor');
  const fontSelect = document.getElementById('coverFontSize');
  const el = document.getElementById(id);

  if (!el) return;

  const c = window.getComputedStyle(el).color;
  const fs = parseInt(window.getComputedStyle(el).fontSize, 10);

  const hex = rgbToHex(c);
  if (hex && colorInput) colorInput.value = hex;
  if (fs && fontSelect) fontSelect.value = fs;
}

function rgbToHex(rgb){
  const m = rgb && rgb.match(/\d+/g);
  if (!m || m.length < 3) return null;
  return "#" + m.slice(0,3).map(x => {
    const h = parseInt(x,10).toString(16);
    return h.length === 1 ? '0' + h : h;
  }).join('');
}

function focusActive(){
  const el = document.getElementById(activeEditableId);
  if (el) el.focus();
}

function applyStyleToActive(type){
  const el = document.getElementById(activeEditableId);
  if (!el) return;

  if (type === 'bold') {
    const current = window.getComputedStyle(el).fontWeight;
    el.style.fontWeight = (parseInt(current, 10) >= 600) ? '400' : '700';
  }

  if (type === 'italic') {
    const current = window.getComputedStyle(el).fontStyle;
    el.style.fontStyle = (current === 'italic') ? 'normal' : 'italic';
  }

  focusActive();
}

function changeActiveFontSize(size){
  const el = document.getElementById(activeEditableId);
  if (!el) return;
  el.style.fontSize = size + 'px';
  focusActive();
}

function changeActiveColor(color){
  const el = document.getElementById(activeEditableId);
  if (!el) return;
  el.style.color = color;
  focusActive();
}

function resetActiveElement(){
  const el = document.getElementById(activeEditableId);
  const box = activeEditableId === 'coverTitleEditor'
    ? document.getElementById('coverTitleBox')
    : document.getElementById('coverSubtitleBox');

  if (!el || !box) return;

  if (activeEditableId === 'coverTitleEditor') {
    el.innerHTML = 'TRAVEL ITINERARY';
    el.style.fontSize = '48px';
    el.style.color = '#ffffff';
    el.style.fontWeight = '700';
    el.style.fontStyle = 'normal';
    el.style.letterSpacing = '3px';
  } else {
    el.innerHTML = '<?php echo addslashes(!empty($package->packages_title) ? $package->packages_title : 'Loading...'); ?>';
    el.style.fontSize = '22px';
    el.style.color = '#ffffff';
    el.style.fontWeight = '700';
    el.style.fontStyle = 'normal';
    el.style.letterSpacing = '0px';
  }

  box.dataset.dx = '0';
  box.dataset.dy = '0';
  box.style.transform = 'translateX(-50%)';
}

function initDraggableText(boxId, editableId){
  const box = document.getElementById(boxId);
  const editor = document.getElementById(editableId);

  let dragging = false;
  let startX = 0;
  let startY = 0;
  let dx = 0;
  let dy = 0;

  box.dataset.dx = '0';
  box.dataset.dy = '0';

  function applyTransform(){
    box.style.transform = 'translate(calc(-50% + ' + dx + 'px), ' + dy + 'px)';
  }

  box.addEventListener('mousedown', function(e){
    setActiveEditable(editableId);

    if (e.target === editor) {
      if (window.getSelection().toString().length > 0) return;
      if (e.detail >= 2) return;
    }

    dragging = true;
    startX = e.clientX - dx;
    startY = e.clientY - dy;
    e.preventDefault();
  });

  editor.addEventListener('focus', function(){
    setActiveEditable(editableId);
  });

  editor.addEventListener('click', function(){
    setActiveEditable(editableId);
  });

  document.addEventListener('mousemove', function(e){
    if (!dragging) return;
    dx = e.clientX - startX;
    dy = e.clientY - startY;
    box.dataset.dx = dx;
    box.dataset.dy = dy;
    applyTransform();
  });

  document.addEventListener('mouseup', function(){
    dragging = false;
  });
}

function initCoverEditors(){
  initDraggableText('coverTitleBox', 'coverTitleEditor');
  initDraggableText('coverSubtitleBox', 'coverSubtitleEditor');
  setActiveEditable('coverTitleEditor');
}

window.addEventListener("load", function(){
  initCoverEditors();
});

async function downloadPDF(){
  const { jsPDF } = window.jspdf;

  const width = 285;
  const height = 285;

  const toolbar = document.getElementById('coverEditorToolbar');
  const oldDisplay = toolbar ? toolbar.style.display : '';

  if (toolbar) toolbar.style.display = 'none';

  try {
    const pdf = new jsPDF({
      orientation: width > height ? 'l' : 'p',
      unit: 'mm',
      format: [width, height]
    });

    const pages = document.querySelectorAll('.pdf-page');

    for(let i = 0; i < pages.length; i++){
      const canvas = await html2canvas(pages[i], {
        scale: 2,
        useCORS: true,
        backgroundColor: '#ffffff'
      });

      const imgData = canvas.toDataURL('image/jpeg', 1.0);

      if(i > 0) pdf.addPage([width, height]);
      pdf.addImage(imgData, 'JPEG', 0, 0, width, height);
    }

    pdf.save('Package_Preview.pdf');
  } finally {
    if (toolbar) toolbar.style.display = oldDisplay || 'flex';
  }
}
</script>

</body>
</html>