<!DOCTYPE html>
<html lang="en">
<head>
<meta charset="UTF-8">
<title>Quotation Preview</title>
<link href="https://fonts.googleapis.com/css2?family=Open+Sans:wght@300;400;600;700;800&display=swap" rel="stylesheet">

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
  font-family:'Open Sans',sans-serif;
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
  min-width:38mm;
  height:11mm;
  display:flex;
  align-items:center;
  justify-content:center;
  font-size:20px;
  font-weight:601;
  margin-right:12mm;
  white-space:nowrap;
}
.brief-date{
  color:#fff;
  font-size:14px;
  font-weight:400;
  margin-right:10mm;
  white-space:nowrap;
  opacity:0.9;
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

/* ===== PROPERTY PAGES ===== */
.property-page{
  height:var(--pdf-height);
  padding:8mm 10mm 10mm 10mm;
  background:#fff;
  box-sizing:border-box;
  position:relative;
}
.standard-full-wrap{
  min-height:100%;
  box-sizing:border-box;
  padding:10mm 10mm 8mm 10mm;
  position:relative;
}
.property-header{
  display:flex;
  justify-content:space-between;
  align-items:flex-start;
  margin-bottom:7mm;
}
.property-left{
  width:58%;
}
.property-contact{
  font-size:14px;
  font-weight:700;
  color:#111;
  line-height:1.6;
}
.contact-row{
  display:flex;
  align-items:center;
  gap:10px;
  margin-bottom:6px;
}
.contact-icon-img{
  height:auto;
  max-height:18px;
  display:inline-block;
  vertical-align:middle;
  flex:0 0 auto;
  object-fit:contain;
}
.contact-value{
  font-size:14px;
  font-weight:700;
  color:#111;
  line-height:1.2;
}
.property-logo{
  width:38%;
  text-align:right;
}
.property-logo img{
  width:58mm;
  max-width:100%;
  height:auto;
}
.property-main-title{
  text-align:center;
  font-size:36px;
  font-weight:800;
  letter-spacing:1px;
  margin:4mm 0 8mm 0;
  color:#000;
  text-transform:uppercase;
  line-height:1.15;
}
.standard-summary-row{
  display:grid;
  grid-template-columns:62% 38%;
  gap:8px;
  margin-bottom:12px;
}
.standard-left-summary,
.standard-right-summary{
  border:1px solid #e4e4e4;
}
.standard-package-type{
  display:flex;
  align-items:center;
  gap:10px;
  background:#cfcfcf;
  color:#000;
  font-size:16px;
  font-weight:800;
  padding:12px 14px;
  margin:0 0 10px 0;
  width:100%;
  box-sizing:border-box;
}
.standard-package-inner{
  display:flex;
  align-items:center;
  gap:10px;
  flex-wrap:wrap;
}
.standard-package-type img{
  width:18px;
  height:18px;
  object-fit:contain;
  flex:0 0 18px;
}
.standard-package-star{
  color:#facc15;
  font-size:18px;
  font-weight:800;
  line-height:1;
  margin-left:2px;
}
.standard-package-type .type-text{
  font-weight:800;
}
.standard-left-info{
  padding:0 12px 8px 12px;
}
.standard-info-row{
  display:flex;
  align-items:center;
  gap:10px;
  font-size:14px;
  color:#111;
  font-weight:700;
  margin-bottom:8px;
  line-height:1.25;
}
.standard-info-icon-img{
  width:28px;
  height:28px;
  object-fit:contain;
  flex:0 0 22px;
}
.standard-right-summary{
  display:flex;
  flex-direction:column;
  justify-content:center;
  align-items:center;
}
.standard-cost-title{
  text-align:center;
  font-size:13px;
  font-weight:800;
  color:#334155;
  padding:10px 8px 8px 8px;
  letter-spacing:.4px;
  text-transform:uppercase;
  border-bottom:2px solid #e5e5e5;
  box-shadow:0 1px 0 #dcdcdc;
  width:100%;
}
.standard-cost-value{
  text-align:center;
  font-size:28px;
  font-weight:900;
  color:#334155;
  padding:10px 8px 12px 8px;
  line-height:1.1;
}
.standard-cost-suffix{
  text-align:center;
  font-size:13px;
  font-weight:600;
  color:#666;
  padding:0 8px 12px 8px;
  line-height:1.2;
}
.accommodation-heading{
  display:flex;
  align-items:center;
  gap:12px;
  margin:14px 0 10px 0;
  padding:10px 12px;
}
.accommodation-title{
  font-size:18px;
  font-weight:600;
  color:#b4b4b4;
  letter-spacing:.3px;
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
  table-layout:fixed;
}
.property-table th{
  background:#bfbfbf;
  padding:10px 8px;
  font-weight:700;
  font-size:14px;
  color:#000;
  text-align:center;
}
.property-table td{
  padding:5px 6px;
  font-size:12px;
  line-height:1.4;
  color:#111;
  text-align:center;
  word-wrap:break-word;
}
.property-table tbody tr:nth-child(odd) td{
  background:#ffffff;
}
.property-table tbody tr:nth-child(even) td{
  background:#d7d7d7;
}
.standard-extra-section{
  margin-top:14px;
}
.standard-extra-box{
  display:grid;
  grid-template-columns:280px 1fr;
  align-items:center;
  gap:18px;
  background:#fff;
  padding:14px 16px;
  margin-bottom:10px;
  border:1px solid #e3e3e3;
}
.standard-extra-left{
  display:flex;
  align-items:center;
  gap:12px;
  min-width:0;
}
.standard-extra-icon-img{
  width:75px;
  height:auto;
  object-fit:contain;
  flex:0 0 58px;
}
.standard-extra-title{
  background:transparent;
  color:#b4b4b4;
  font-size:14px;
  font-weight:700;
  padding:0;
  margin:0;
  text-transform:uppercase;
  line-height:1.1;
}
.standard-extra-right{
  min-width:0;
}
.standard-extra-text{
  font-size:12px;
  font-weight:700;
  color:#111;
  line-height:1.45;
}
.standard-extra-red-list{
  margin:0;
  padding-left:18px;
}
.standard-extra-red-list li{
  color:#ff2a1f;
  font-size:12px;
  font-weight:700;
  line-height:1.45;
  margin-bottom:4px;
}
.standard-extra-red-list li::marker{
  color:#ff2a1f;
}

/* ===== COMPLIMENTARY INCLUSIONS (STANDARD) ===== */
.complimentary-box{
  margin-top:14px;
  page-break-inside:avoid;
  break-inside:avoid;
  background:linear-gradient(135deg, #f5f5f5, #e8e8e8);
  border:2px solid #999;
  border-radius:12px;
  padding:16px 24px;
  text-align:center;
  box-shadow:0 2px 6px rgba(0,0,0,0.08);
}
.complimentary-text{
  font-size:13px;
  line-height:1.3;
  color:#ff0000;
  font-weight:700;
  text-shadow:1px 1px 3px rgba(0,0,0,0.5), 0 0 2px rgba(255,255,255,0.8);
}
.complimentary-text br{
  line-height:0;
  margin-bottom:0;
}

/* ===== COMPLIMENTARY INCLUSIONS (EXCLUSIVE) ===== */
.complimentary-box-exclusive{
  margin-top:4mm;
  page-break-inside:avoid;
  break-inside:avoid;
  background:linear-gradient(135deg, #f7efe8, #ecd9c8);
  border:2px solid #c9a45c;
  border-radius:10px;
  padding:10px 20px;
  text-align:center;
  box-shadow:0 2px 6px rgba(201,164,92,0.15);
}
.complimentary-text-exclusive{
  font-family:'Open Sans',sans-serif;
  font-size:13px;
  line-height:1.3;
  color:#ff0000;
  font-weight:700;
  text-shadow:1px 1px 3px rgba(0,0,0,0.5), 0 0 2px rgba(255,255,255,0.8);
}
.complimentary-text-exclusive br{
  line-height:0;
  margin-bottom:0;
}

/* ===== EXCLUSIVE ===== */
.exclusive-page{
  width:var(--pdf-width);
  height:var(--pdf-height);
  page-break-after:always;
  position:relative;
  overflow:hidden;
  box-sizing:border-box;
  font-family:'Open Sans',sans-serif;
  background:#f7efe8;
}
.exclusive-page::before{
  content:"";
  position:absolute;
  inset:0;
  background:
    radial-gradient(circle at 20% 20%, rgba(255,255,255,0.20) 0%, rgba(255,255,255,0) 28%),
    radial-gradient(circle at 75% 30%, rgba(255,255,255,0.14) 0%, rgba(255,255,255,0) 26%),
    radial-gradient(circle at 40% 75%, rgba(255,255,255,0.12) 0%, rgba(255,255,255,0) 30%),
    linear-gradient(180deg, rgba(255,255,255,0.16), rgba(0,0,0,0.02));
  pointer-events:none;
}
.exclusive-inner{
  position:relative;
  z-index:1;
  padding:10mm 10mm 0 10mm;
  min-height:100%;
  box-sizing:border-box;
}
.exclusive-top-decor{
  text-align:center;
  margin-top:2mm;
  margin-bottom:2mm;
}
.exclusive-top-decor img{
  max-width:90mm;
  width:100%;
  height:auto;
}
.exclusive-logo{
  text-align:center;
  margin:2mm 0 3mm 0;
}
.exclusive-logo img{
  max-width:56mm;
  height:auto;
}
.exclusive-package-title{
  margin:6px 0 6px 0;
  text-align:center;
  font-family:'Open Sans',sans-serif;
  font-size:20px;
  line-height:1.25;
  font-weight:400;
  color:#2f231c;
}
.exclusive-mid-decor{
  text-align:center;
  margin:2mm 0 3mm 0;
}
.exclusive-mid-decor img{
  max-width:80mm;
  width:100%;
  height:auto;
}
.exclusive-summary-band{
  width:calc(100% + 20mm);
  margin-left:-10mm;
  margin-right:-10mm;
  margin-top:3mm;
  margin-bottom:7mm;
  background:linear-gradient(180deg, #ead7c2 0%, #e3cfbb 100%);
  border-top:2px solid #cfb48b;
  border-bottom:2px solid #cfb48b;
  padding:8px 10mm 10px 10mm;
  box-sizing:border-box;
  text-align:center;
}
.exclusive-summary-title{
  font-family:'Open Sans',sans-serif;
  font-size:13px;
  font-weight:700;
  text-transform:uppercase;
  color:#241b14;
  letter-spacing:.4px;
  margin-bottom:4px;
}
.exclusive-summary-price{
  display:flex;
  align-items:baseline;
  justify-content:center;
  gap:10px;
}
.exclusive-summary-price .amount{
  font-size:24px;
  font-weight:800;
  color:#000;
  line-height:1;
}
.exclusive-summary-price .amount-suffix{
  font-size:13px;
  font-weight:600;
  color:#5c4a3a;
  margin-left:4px;
}
.exclusive-section-title{
  text-align:center;
  margin:7mm 0 6mm 0;
  font-family:'Open Sans',sans-serif;
  font-size:14px;
  font-weight:700;
  color:#231a14;
  text-transform:uppercase;
  letter-spacing:.4px;
}
.exclusive-table-wrap{
  margin:0 0 2mm 0;
}
.exclusive-table{
  width:100%;
  border-collapse:separate;
  border-spacing:2px;
  table-layout:fixed;
}
.exclusive-table th{
  background:#0b6b3f;
  color:#fff;
  padding:8px 6px;
  text-align:center;
  font-size:12px;
  font-weight:700;
  line-height:1.2;
  text-transform:uppercase;
}
.exclusive-table td{
  text-align:center;
  font-size:12px;
  line-height:1.3;
  color:#1f1b16;
  font-weight:600;
  background:#f7f4ef;
  padding:8px 6px;
  word-wrap:break-word;
}
.exclusive-table tbody tr:nth-child(even) td{
  background:#e5e8e2;
}
.exclusive-table tbody td:first-child{
  color:#a05b20;
  font-weight:700;
}
.exclusive-bottom-grid{
  display:grid;
  grid-template-columns:1fr 1fr;
  gap:0mm;
  margin-top:15mm;
  padding-left:25mm;
  padding-right:4mm;
  position:relative;
}
.exclusive-bottom-grid::before{
  content:"";
  position:absolute;
  top:0;
  bottom:0;
  left:50%;
  transform:translateX(-50%);
  width:2px;
  background:#c9a45c;
  opacity:0.9;
}
.exclusive-feature-box{
  padding:0 6mm;
  position:relative;
  padding-top:2mm;
}
.exclusive-feature-title{
  display:flex;
  align-items:center;
  gap:10px;
  margin-bottom:8px;
  color:#0f5e38;
  font-family:'Open Sans',sans-serif;
  font-size:14px;
  font-weight:700;
  text-transform:uppercase;
}
.exclusive-feature-title img{
  width:35px;
  height:30px;
  object-fit:contain;
}
.exclusive-feature-list{
  margin:0;
  padding-left:0;
  list-style:none;
}
.exclusive-feature-list li{
  position:relative;
  padding-left:22px;
  margin-bottom:6px;
  font-size:13px;
  line-height:1.45;
  color:#3f3023;
  font-family:'Open Sans',sans-serif;
}
.exclusive-feature-list.transport li::before{
  content:"✔";
  position:absolute;
  left:0;
  top:0;
  color:#b09045;
  font-weight:700;
}
.exclusive-footer-band{
  position:absolute;
  left:0;
  right:0;
  bottom:0;
  height:36mm;
  background:linear-gradient(180deg, #42696b 0%, #24464d 100%);
  border-top:3px solid #b99a5d;
}
.exclusive-footer-content{
  position:absolute;
  left:12mm;
  right:12mm;
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
  font-size:15px;
  color:#f0ecec;
  font-weight:700;
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

.exclusive-summary-row{
  display:flex;
  align-items:center;
  justify-content:space-between;
  position:relative;
}

/* LEFT */
.exclusive-summary-left{
  display:flex;
  flex-direction:column;
  gap:5px;
  min-width:200px;
}

/* CENTER PERFECT */
.exclusive-summary-title-center{
  position:absolute;
  left:50%;
  transform:translateX(-50%);
  font-weight:700;
  font-size:16px;
  text-align:center;
  white-space:nowrap;
}

/* RIGHT placeholder */
.exclusive-summary-right{
  min-width:200px;
}

/* ICON ROW */
.exclusive-info-item{
  display:flex;
  align-items:center;
  gap:6px;
  font-size:14px;
  font-weight:600;
}

.exclusive-info-item img{
  width:16px;
  height:16px;
}
/* ===== SIMPLE SECTION ===== */
.simple-inc-exc-page{
  background:#fff;
  position:relative;
  padding:20mm 10mm 16mm 10mm;
  box-sizing:border-box;
}
.simple-inc-exc-wrap{
  margin:20mm auto 0 auto;
  width:92%;
  max-width:250mm;
}
.simple-section{
  width:100%;
  margin-bottom:16mm;
}
.exclusions-section{
  margin-top:10mm;
}
.simple-pill-title{
  display:inline-block;
  background:var(--green);
  color:#fff;
  font-size:20px;
  font-weight:700;
  border-radius:20px;
  padding:10px 18px;
  line-height:1;
  letter-spacing:.4px;
  margin-bottom:10mm;
  width:fit-content;
  margin-left:0;
}
.simple-list-block{
  width:100%;
}
.simple-point{
  display:grid;
  grid-template-columns:8px 1fr;
  column-gap:10px;
  align-items:start;
  width:100%;
  margin-bottom:6px;
}
.simple-point-bullet{
  font-size:26px;
  line-height:1.1;
  color:#000;
  text-align:center;
  margin-top:1px;
}
.simple-point-text{
  font-size:20px;
  line-height:1.55;
  color:#000;
  text-align:left;
  word-break:normal;
  overflow-wrap:anywhere;
  white-space:normal;
}

/* ===== PAYMENT / ACCOUNT DETAILS ===== */
.payment-account-design{
  display:grid;
  grid-template-columns:40% 60%;
  gap:0;
  background:#f2f2f2;
  margin-top:8mm;
  border-radius:5px;
  overflow:hidden;
  box-shadow:0 2px 10px rgba(0,0,0,0.08);
  page-break-inside:avoid;
  break-inside:avoid;
}

.payment-account-design.no-qr-panel{
  grid-template-columns:1fr;
}

.payment-qr-panel{
  background:#fff;
  border:1px solid #e0e0e0;
  border-top:4px solid #1976d2;
  border-bottom:4px solid #25146f;
  text-align:center;
  padding:6mm 5mm;
  display:flex;
  flex-direction:column;
  align-items:center;
  justify-content:flex-start;
}

.payment-qr-bank-logo{
  max-width:30mm;
  max-height:12mm;
  object-fit:contain;
  margin-bottom:3mm;
}

.payment-qr-company{
  font-size:12px;
  font-weight:700;
  color:#444;
  margin-bottom:3mm;
  text-transform:uppercase;
  letter-spacing:0.3px;
}

.payment-scan-title{
  font-size:22px;
  font-weight:800;
  color:#25146f;
  margin:2mm 0 3mm;
  letter-spacing:1px;
}

.payment-main-qr{
  width:55mm;
  max-width:100%;
  height:auto;
  margin-bottom:2mm;
}

.payment-upi-id{
  font-size:12px;
  font-weight:700;
  color:#333;
  margin:2mm 0 3mm;
}

.payment-icons{
  display:flex;
  justify-content:center;
  align-items:center;
  flex-wrap:wrap;
  gap:6px;
  margin-top:2mm;
}

.payment-icons img{
  height:24px;
  width:auto;
  object-fit:contain;
  display:block;
}

.payment-account-panel{
  background:#efefef;
  padding:6mm 8mm;
}

.payment-account-title{
  font-family:'Open Sans',sans-serif;
  font-size:24px;
  font-weight:700;
  color:#222;
  border-bottom:1px solid #ccc;
  padding-bottom:3mm;
  margin-bottom:4mm;
}

.payment-account-grid{
  display:block;
}

.payment-account-grid.multi-account-grid{
  display:grid;
  grid-template-columns:1fr 1fr;
  gap:4mm 8mm;
}

.payment-bank-item{
  padding:3mm 0 4mm 0;
  border-bottom:1px solid #ccc;
}

.payment-account-grid.multi-account-grid .payment-bank-item{
  padding:2mm 0;
  border-bottom:none;
}

.payment-bank-item:last-child{
  border-bottom:none;
}

.payment-bank-logo{
  max-width:30mm;
  max-height:12mm;
  object-fit:contain;
  margin-bottom:2mm;
}

.payment-bank-lines{
  font-family:'Open Sans',sans-serif;
  font-size:12.5px;
  line-height:1.5;
  color:#111;
}

.payment-bank-lines div{
  margin-bottom:1px;
}

.payment-bank-lines strong{
  font-weight:700;
}
</style>
<style>
/* A4 PAGE */
/* .pdf-page{
  width:210mm;
  min-height:297mm;
  margin:0 auto;
  position:relative;
  background:#fff;
  page-break-after:auto;
} */

/* .common-flow-page{
  padding:0;
  overflow:hidden;
} */

/* .common-flow-content{
  position:absolute;
  top:38mm;
  left:18mm;
  right:18mm;
  bottom:20mm;
  overflow:hidden;
} */

  /* .common-flow-content{
  position:absolute;
  top:38mm;
  left:18mm;
  right:18mm;
  bottom:22mm;
  overflow:hidden;
}

.common-flow-content .simple-section{
  margin-bottom:12mm;
}

.common-flow-content .simple-pill-title{
  margin-bottom:7mm;
}

.common-flow-content .simple-point{
  page-break-inside:avoid;
  break-inside:avoid;
  margin-bottom:5px;
}

.common-generated-page .payment-account-wrap{
  margin-bottom:12mm;
}

.common-flow-page .content-logo{
  position:absolute;
  top:10mm;
  right:18mm;
  width:52mm;
  text-align:right;
}

.common-flow-page .content-logo img{
  max-width:63mm;
  height:auto;
}

.common-flow-page .footer-lite{
  position:absolute;
  left:12mm;
  right:12mm;
  bottom:6mm;
} */

.prepared-by-box{
  margin-top:5mm;
  font-size:20px;
  line-height:1.8;
}

.prepared-by-name{
  font-size:24px;
  font-weight:700;
  margin-bottom:4px;
}

.prepared-by-line{
  font-size:20px;
  margin-bottom:2px;
}
 .common-flow-content{
  position:absolute;
  top:38mm;
  left:18mm;
  right:18mm;
  bottom:28mm; /* more safe space from footer */
  overflow:hidden;
}

.common-flow-content .simple-section{
  margin-bottom:10mm;
}

.common-flow-content .continued-section{
  margin-top:0;
}

.common-flow-content .simple-pill-title{
  margin-bottom:7mm;
}

.common-flow-content .simple-point{
  break-inside:avoid;
  page-break-inside:avoid;
  margin-bottom:6px;
}

.common-flow-content .simple-point-text{
  line-height:1.45;
}
 
.flow-section{
  margin-bottom:12mm;
  page-break-inside:avoid;
  break-inside:avoid;
}
/* CONTENT AREA */
.flow-content{
  padding:40mm 20mm 30mm 20mm; /* TOP for header, BOTTOM for footer */
}

/* HEADER */
.content-logo{
  position:absolute;
  top:10mm;
  right:15mm;
}

/* FOOTER */
.footer-lite{
  position:absolute;
  bottom:10mm;
  left:0;
  width:100%;
}

/* PREVENT BREAK INSIDE SECTION */
.flow-section{
  break-inside:avoid;
  page-break-inside:avoid;
  margin-bottom:15mm;
}

/* AUTO PAGE BREAK */
@media print {

  .pdf-page{
    page-break-after:always;
  }

  .flow-content{
    break-after:auto;
  }

}

/* .standard-extra-section,
.exclusive-bottom-grid {
  max-height: 72mm;
  overflow: hidden;
} */

.standard-cont-page .standard-split-content{
  position:absolute;
  top:52mm;
  left:20mm;
  right:20mm;
  bottom:16mm;
  overflow:hidden;
}

/* .exclusive-cont-page .exclusive-split-content{
  position:absolute;
  top:58mm;
  left:14mm;
  right:14mm;
  bottom:42mm;
  overflow:hidden;
} */

.exclusive-cont-page .exclusive-split-content{
  position:absolute;
  top:68mm;   /* ✅ increased */
  left:14mm;
  right:14mm;
  bottom:42mm;
  overflow:hidden;
}

.standard-cont-title{
  text-align:center;
  font-size:26px;
  font-weight:800;
  margin-bottom:8mm;
  color:#000;
}

/* .exclusive-cont-title{
  text-align:center;
  font-family:Georgia, "Times New Roman", serif;
  font-size:20px;
  font-weight:700;
  color:#231a14;
  text-transform:uppercase;
  margin-bottom:6mm;
} */

.exclusive-cont-page .exclusive-cont-title{
  text-align:center;
  font-family:'Open Sans',sans-serif;
  font-size:20px;
  font-weight:700;
  color:#231a14;
  text-transform:uppercase;

  /* margin-top: 6mm; */
  margin-bottom: 10mm;   /* ✅ important */
}

.generated-option-page .standard-extra-section,
.generated-option-page .exclusive-bottom-grid{
  max-height:none !important;
  overflow:visible !important;
}

.generated-standard-page .standard-full-wrap {
  padding: 10mm 10mm 8mm 10mm;
}

.generated-exclusive-page .exclusive-inner {
  padding: 10mm 10mm 0 10mm;
}

.generated-extra-content {
  margin-top: 30mm;
}

.generated-standard-page .property-header {
  margin-bottom: 8mm;
}

.generated-exclusive-page .exclusive-logo {
  text-align: center;
  margin-top: 6mm;
}

.generated-brief-page .brief-list{
  margin-top:8mm;
}

.generated-brief-page .brief-header{
  margin-top:24mm;
}

.generated-brief-page .brief-logo{
  position:absolute;
  top:6mm;
  right:18mm;
  width:48mm;
  text-align:right;
}

/* ===== FONT SIZE LEVELS (auto-fitted by JS) ===== */
/* Standard levels */
.font-xs .standard-package-type { font-size:14px !important; }
.font-xs .standard-package-star { font-size:16px !important; }
.font-xs .standard-info-row { font-size:12px !important; }
.font-xs .standard-cost-title { font-size:11px !important; }
.font-xs .standard-cost-value { font-size:24px !important; }
.font-xs .standard-cost-suffix { font-size:11px !important; }
.font-xs .accommodation-title { font-size:16px !important; }
.font-xs .property-table th { font-size:11px !important; }
.font-xs .property-table td { font-size:10px !important; }
.font-xs .standard-extra-title { font-size:12px !important; }
.font-xs .standard-extra-text { font-size:10px !important; }
.font-xs .standard-extra-red-list li { font-size:10px !important; }
.font-xs .complimentary-text { font-size:11px !important; }
.font-xs .contact-value { font-size:12px !important; }

.font-sm .standard-package-type { font-size:15px !important; }
.font-sm .standard-package-star { font-size:17px !important; }
.font-sm .standard-info-row { font-size:13px !important; }
.font-sm .standard-cost-title { font-size:12px !important; }
.font-sm .standard-cost-value { font-size:26px !important; }
.font-sm .standard-cost-suffix { font-size:11px !important; }
.font-sm .accommodation-title { font-size:17px !important; }
.font-sm .property-table th { font-size:12px !important; }
.font-sm .property-table td { font-size:11px !important; }
.font-sm .standard-extra-title { font-size:13px !important; }
.font-sm .standard-extra-text { font-size:11px !important; }
.font-sm .standard-extra-red-list li { font-size:11px !important; }
.font-sm .complimentary-text { font-size:12px !important; }
.font-sm .contact-value { font-size:13px !important; }

.font-lg .standard-package-type { font-size:18px !important; }
.font-lg .standard-package-star { font-size:20px !important; }
.font-lg .standard-info-row { font-size:15px !important; }
.font-lg .standard-cost-title { font-size:15px !important; }
.font-lg .standard-cost-value { font-size:32px !important; }
.font-lg .standard-cost-suffix { font-size:14px !important; }
.font-lg .accommodation-title { font-size:20px !important; }
.font-lg .property-table th { font-size:16px !important; }
.font-lg .property-table td { font-size:14px !important; }
.font-lg .standard-extra-title { font-size:16px !important; }
.font-lg .standard-extra-text { font-size:14px !important; }
.font-lg .standard-extra-red-list li { font-size:14px !important; }
.font-lg .complimentary-text { font-size:15px !important; }
.font-lg .contact-value { font-size:16px !important; }

.font-xl .standard-package-type { font-size:19px !important; }
.font-xl .standard-package-star { font-size:21px !important; }
.font-xl .standard-info-row { font-size:16px !important; }
.font-xl .standard-cost-title { font-size:16px !important; }
.font-xl .standard-cost-value { font-size:34px !important; }
.font-xl .standard-cost-suffix { font-size:15px !important; }
.font-xl .accommodation-title { font-size:21px !important; }
.font-xl .property-table th { font-size:17px !important; }
.font-xl .property-table td { font-size:15px !important; }
.font-xl .standard-extra-title { font-size:17px !important; }
.font-xl .standard-extra-text { font-size:15px !important; }
.font-xl .standard-extra-red-list li { font-size:15px !important; }
.font-xl .complimentary-text { font-size:16px !important; }
.font-xl .contact-value { font-size:17px !important; }

/* Exclusive levels */
.font-xs .exclusive-package-title { font-size:17px !important; }
.font-xs .exclusive-summary-title { font-size:11px !important; }
.font-xs .exclusive-summary-price .amount { font-size:20px !important; }
.font-xs .exclusive-section-title { font-size:12px !important; }
.font-xs .exclusive-table th { font-size:10px !important; }
.font-xs .exclusive-table td { font-size:10px !important; }
.font-xs .exclusive-feature-title { font-size:12px !important; }
.font-xs .exclusive-feature-list li { font-size:11px !important; }
.font-xs .complimentary-text-exclusive { font-size:11px !important; }

.font-sm .exclusive-package-title { font-size:18px !important; }
.font-sm .exclusive-summary-title { font-size:12px !important; }
.font-sm .exclusive-summary-price .amount { font-size:22px !important; }
.font-sm .exclusive-section-title { font-size:13px !important; }
.font-sm .exclusive-table th { font-size:11px !important; }
.font-sm .exclusive-table td { font-size:11px !important; }
.font-sm .exclusive-feature-title { font-size:13px !important; }
.font-sm .exclusive-feature-list li { font-size:12px !important; }
.font-sm .complimentary-text-exclusive { font-size:12px !important; }

.font-lg .exclusive-package-title { font-size:22px !important; }
.font-lg .exclusive-summary-title { font-size:15px !important; }
.font-lg .exclusive-summary-price .amount { font-size:26px !important; }
.font-lg .exclusive-section-title { font-size:16px !important; }
.font-lg .exclusive-table th { font-size:14px !important; }
.font-lg .exclusive-table td { font-size:14px !important; }
.font-lg .exclusive-feature-title { font-size:16px !important; }
.font-lg .exclusive-feature-list li { font-size:14px !important; }
.font-lg .complimentary-text-exclusive { font-size:15px !important; }

.font-xl .exclusive-package-title { font-size:24px !important; }
.font-xl .exclusive-summary-title { font-size:16px !important; }
.font-xl .exclusive-summary-price .amount { font-size:28px !important; }
.font-xl .exclusive-section-title { font-size:17px !important; }
.font-xl .exclusive-table th { font-size:15px !important; }
.font-xl .exclusive-table td { font-size:15px !important; }
.font-xl .exclusive-feature-title { font-size:17px !important; }
.font-xl .exclusive-feature-list li { font-size:15px !important; }
.font-xl .complimentary-text-exclusive { font-size:16px !important; }

/* Brief page levels */
.font-xs .brief-header { margin-top:14mm !important; margin-bottom:5mm !important; }
.font-xs .brief-icon-img { width:24mm !important; }
.font-xs .brief-title { font-size:26px !important; }
.font-xs .brief-list { margin-top:5mm !important; }
.font-xs .brief-row { min-height:13mm !important; padding:0 7mm !important; margin-bottom:6px !important; }
.font-xs .brief-day { font-size:13px !important; min-width:28mm !important; height:9mm !important; margin-right:8mm !important; }
.font-xs .brief-date { font-size:10px !important; margin-right:6mm !important; }
.font-xs .brief-route { font-size:16px !important; }

.font-sm .brief-header { margin-top:18mm !important; margin-bottom:6mm !important; }
.font-sm .brief-icon-img { width:30mm !important; }
.font-sm .brief-title { font-size:32px !important; }
.font-sm .brief-list { margin-top:6mm !important; }
.font-sm .brief-row { min-height:15mm !important; padding:0 8mm !important; margin-bottom:8px !important; }
.font-sm .brief-day { font-size:16px !important; min-width:32mm !important; height:10mm !important; margin-right:10mm !important; }
.font-sm .brief-date { font-size:12px !important; margin-right:8mm !important; }
.font-sm .brief-route { font-size:20px !important; }

.font-lg .brief-header { margin-top:26mm !important; margin-bottom:9mm !important; }
.font-lg .brief-icon-img { width:44mm !important; }
.font-lg .brief-title { font-size:44px !important; }
.font-lg .brief-list { margin-top:9mm !important; }
.font-lg .brief-row { min-height:20mm !important; padding:0 11mm !important; margin-bottom:11px !important; }
.font-lg .brief-day { font-size:22px !important; min-width:40mm !important; height:12mm !important; margin-right:13mm !important; }
.font-lg .brief-date { font-size:15px !important; margin-right:11mm !important; }
.font-lg .brief-route { font-size:27px !important; }

.font-xl .brief-header { margin-top:28mm !important; margin-bottom:10mm !important; }
.font-xl .brief-icon-img { width:48mm !important; }
.font-xl .brief-title { font-size:48px !important; }
.font-xl .brief-list { margin-top:10mm !important; }
.font-xl .brief-row { min-height:22mm !important; padding:0 12mm !important; margin-bottom:12px !important; }
.font-xl .brief-day { font-size:24px !important; min-width:42mm !important; height:13mm !important; margin-right:14mm !important; }
.font-xl .brief-date { font-size:16px !important; margin-right:12mm !important; }
.font-xl .brief-route { font-size:29px !important; }
</style>
<style>
#pdfLoadingOverlay{
  position:fixed;
  inset:0;
  background:rgba(255,255,255,0.85);
  z-index:999999;
  display:flex;
  align-items:center;
  justify-content:center;
}

.pdf-loader-box{
  background:#fff;
  padding:24px 34px;
  border-radius:12px;
  box-shadow:0 8px 25px rgba(0,0,0,0.15);
  text-align:center;
  font-family:'Open Sans',sans-serif;
}

.pdf-spinner{
  width:42px;
  height:42px;
  border:4px solid #ddd;
  border-top:4px solid var(--green);
  border-radius:50%;
  animation:pdfSpin 0.8s linear infinite;
  margin:0 auto 14px auto;
}

.pdf-loader-text{
  font-size:15px;
  font-weight:600;
  color:#111;
}

@keyframes pdfSpin{
  from{ transform:rotate(0deg); }
  to{ transform:rotate(360deg); }
}
</style>
</head>

<body>
<div id="pdfLoadingOverlay" style="display:none;">
  <div class="pdf-loader-box">
    <div class="pdf-spinner"></div>
    <div class="pdf-loader-text">Preparing PDF, please wait...</div>
  </div>
</div>
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

if (!function_exists('q_preview_amount')) {
    function q_preview_amount($value){
        return number_format((float)$value, 0);
    }
}
?>

<div class="btn-area">
  <button onclick="downloadPDF()">Download PDF</button>
</div>

<div id="pdf-content">

  <!-- FIRST COVER -->
  <div class="pdf-page cover-page <?php echo !empty($quotation->quotation_first_cover_page) ? 'cover-has-image' : ''; ?>"
       id="firstCoverPage"
       style="<?php echo !empty($quotation->quotation_first_cover_page) ? "background-image:url('".base_url('uploads/quotation_cover/'.$quotation->quotation_first_cover_page)."');" : ''; ?>">

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
        <?php echo !empty($quotation->quotation_title) ? htmlspecialchars($quotation->quotation_title) : 'Loading...'; ?>
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
      <?php if (!empty($brief_itinerary)): ?>
        <?php
          $brief_start_date = isset($quotation->start_date) ? $quotation->start_date : null;
          $brief_start_ts = $brief_start_date ? strtotime($brief_start_date) : 0;
        ?>
        <?php foreach ($brief_itinerary as $index => $day): ?>
          <?php
            $brief_date_text = '';
            if ($brief_start_ts) {
              $brief_day_ts = strtotime('+' . $index . ' days', $brief_start_ts);
              $brief_date_text = date('d M Y', $brief_day_ts);
            }
          ?>
          <div class="brief-row">
            <div class="brief-day"><?php echo $brief_date_text ? htmlspecialchars($brief_date_text) : 'Day ' . str_pad(($index + 1), 2, '0', STR_PAD_LEFT); ?></div>
            <div class="brief-route"><?php echo strtoupper(htmlspecialchars($day->quotation_itineraries_days_title)); ?></div>
          </div>
        <?php endforeach; ?>
      <?php endif; ?>
      <div class="footer">
  <div class="fitem"><span class="ficon"><?= $ICON_PHONE; ?></span><?= $companyPhone; ?></div>
  <div class="fitem"><span class="ficon"><?= $ICON_WEB; ?></span><?= $companyWeb; ?></div>
  <div class="fitem"><span class="ficon"><?= $ICON_INSTAGRAM; ?></span><?= $companyInsta; ?></div>
</div>
    </div>
  </div>

  <!-- ITINERARY DAY PAGES -->
  <?php if (!empty($itinerary)): ?>
    <?php foreach ($itinerary as $index => $day): ?>
      <?php $dayImage = !empty($day->quotation_itineraries_days_image) ? base_url('uploads/quotation_day_images/'.$day->quotation_itineraries_days_image) : ''; ?>
      <div class="pdf-page daypage">
        <div class="daypage-logo">
          <img src="<?= base_url('assets/images/Royale-logo-new1.png'); ?>" alt="Logo">
        </div>

        <div class="daypage-top">
          <?php
            $day_date_text = '';
            if (isset($quotation->start_date) && $quotation->start_date) {
              $day_start_ts = strtotime($quotation->start_date);
              $day_date_text = date('d M Y', strtotime('+' . $index . ' days', $day_start_ts));
            }
          ?>
          <div class="day-pill"><?php echo $day_date_text ? htmlspecialchars($day_date_text) : 'Day ' . str_pad(($index + 1), 2, '0', STR_PAD_LEFT); ?></div>
          <div class="route-title"><?php echo htmlspecialchars($day->quotation_itineraries_days_title); ?></div>
        </div>

        <div class="day-desc">
          <?php echo !empty($day->quotation_itineraries_days_description) ? $day->quotation_itineraries_days_description : ''; ?>
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

  <div id="incExcSectionsSource" style="display:none;">

<?php if (!empty($inclusions)): ?>
<div class="simple-section">
  <div class="simple-pill-title">INCLUSIONS</div>
  <div class="simple-list-block">
    <?php foreach ($inclusions as $row): ?>
      <?php if (!empty($row->quotation_inclusions_details)): ?>
        <div class="simple-point">
          <div class="simple-point-bullet">•</div>
          <div class="simple-point-text">
            <?= htmlspecialchars($row->quotation_inclusions_details); ?>
          </div>
        </div>
      <?php endif; ?>
    <?php endforeach; ?>
  </div>
</div>
<?php endif; ?>

<?php if (!empty($exclusions)): ?>
<div class="simple-section">
  <div class="simple-pill-title">EXCLUSIONS</div>
  <div class="simple-list-block">
    <?php foreach ($exclusions as $row): ?>
      <?php if (!empty($row->quotation_exclusions_details)): ?>
        <div class="simple-point">
          <div class="simple-point-bullet">•</div>
          <div class="simple-point-text">
            <?= htmlspecialchars($row->quotation_exclusions_details); ?>
          </div>
        </div>
      <?php endif; ?>
    <?php endforeach; ?>
  </div>
</div>
<?php endif; ?>

</div>

<div id="incExcPagesContainer"></div>

  <!-- PROPERTY / OPTION PAGES -->
  <?php if (!empty($options)): ?>
    <?php foreach ($options as $cat): ?>
      <?php
        $designType = !empty($cat->quotation_options_design_type) ? strtolower(trim($cat->quotation_options_design_type)) : 'standard';
        $categoryTitle = !empty($cat->quotation_options_title) ? $cat->quotation_options_title : 'Accommodation Summary';
        $showRoom = ((int)$cat->quotation_options_room_category_display === 1);
        $showMeal = ((int)$cat->quotation_options_meal_plan_display === 1);
        $totalAmount = isset($cat->preview_total_amount)
    ? (float)$cat->preview_total_amount
    : (float)$cat->quotation_options_total_quote_rate;
      ?>

      

      <?php if ($designType === 'exclusive'): ?>
        <div class="pdf-page exclusive-page">
          <div class="exclusive-inner">

            <div class="exclusive-top-decor">
              <img src="<?= base_url('assets/images/exclusive-ornament-top.png'); ?>" alt="">
            </div>

            <div class="exclusive-logo">
              <img src="<?= base_url('assets/images/Royale-logo-gold.png'); ?>" alt="Logo">
            </div>

            <div class="exclusive-package-title">
              <?= htmlspecialchars($categoryTitle); ?>
            </div>

            <div class="exclusive-mid-decor">
              <img src="<?= base_url('assets/images/exclusive-ornament-bottom.png'); ?>" alt="">
            </div>

            <!-- <div class="exclusive-summary-band">
              <div class="exclusive-summary-title">PACKAGE COST &amp; ACCOMMODATION SUMMARY</div>
              <div class="exclusive-summary-price">
                <span class="amount"><?= q_preview_amount($totalAmount); ?></span>
              </div>
            </div> -->
<?php
$guest = isset($guest_total) ? $guest_total : [];

$adults   = isset($guest['adults']) ? (int)$guest['adults'] : 0;
$children = isset($guest['children']) ? (int)$guest['children'] : 0;
?>
            <div class="exclusive-summary-band">

  <div class="exclusive-summary-row">

    <!-- LEFT -->
    <div class="exclusive-summary-left">
      <div class="exclusive-info-item">
        <img src="<?= base_url('assets/images/guest.png'); ?>">
        <span>
          <?= $adults; ?> Adult<?= $adults > 1 ? 's' : '' ?>
          <?php if ($children > 0): ?>
            + <?= $children; ?> Child<?= $children > 1 ? 'ren' : '' ?>
          <?php endif; ?>
        </span>
      </div>
      
      <div class="exclusive-info-item">
        <img src="<?= base_url('assets/images/travel.png'); ?>">
        <span><?= htmlspecialchars($travel_date_text); ?></span>
      </div>
    </div>

    <!-- CENTER -->
    <div class="exclusive-summary-title-center">
      PACKAGE COST &amp; ACCOMMODATION SUMMARY
    </div>

    <!-- RIGHT (empty placeholder for perfect centering) -->
    <div class="exclusive-summary-right"></div>

  </div>
<?php if (!function_exists('q_option_display_amount_premium')) {
function q_option_display_amount_premium($option)
{
    $type = !empty($option->quotation_options_amount_type)
        ? $option->quotation_options_amount_type
        : 'net';

    if ($type === 'person') {
        return array(q_preview_amount($option->quotation_options_per_amount), 'Per Person');
    }

    if ($type === 'adult') {
        return array(q_preview_amount($option->quotation_options_per_amount), 'Per Adult');
    }

    if ($type === 'couple') {
        return array(q_preview_amount($option->quotation_options_per_amount), 'Per Couple');
    }

    return array(q_preview_amount($option->preview_total_amount), 'NET');
}
} // end function_exists q_option_display_amount_premium
?>
  <!-- PRICE -->
  <div class="exclusive-summary-price">
    <?php
      $exc_cost = q_option_display_amount_premium($cat);
      $exc_amount = $exc_cost[0];
      $exc_suffix = $exc_cost[1];
    ?>
    <span class="amount"><?= htmlspecialchars($exc_amount); ?>/-</span>
    <span class="amount-suffix"><?= htmlspecialchars($exc_suffix); ?></span>
  </div>

</div>
            <div class="exclusive-section-title">ACCOMMODATION DETAILS</div>

            <div class="exclusive-table-wrap">
              <?php
                $colCount = ($showRoom ? 1 : 0) + ($showMeal ? 1 : 0);
                if ($colCount === 2) {
                    $wDay = 8; $wDest = 14; $wHotel = 38; $wRoom = 25; $wMeal = 15;
                } elseif ($colCount === 1) {
                    $wDay = 8; $wDest = 18; $wHotel = 59;
                    $wRoom = $showRoom ? 35 : 0;
                    $wMeal = $showMeal ? 15 : 0;
                } else {
                    $wDay = 12; $wDest = 18; $wHotel = 70; $wRoom = 0; $wMeal = 0;
                }
              ?>
              <table class="exclusive-table">
                <thead>
                  <tr>
                    <th style="width:<?= $wDay; ?>%;">DATE</th>
                    <th style="width:<?= $wDest; ?>%;">DESTINATION</th>
                    <th style="width:<?= $wHotel; ?>%;">HOTEL / STAY</th>
                    <?php if ($showRoom): ?><th style="width:<?= $wRoom; ?>%;">ROOM TYPE</th><?php endif; ?>
                    <?php if ($showMeal): ?><th style="width:<?= $wMeal; ?>%;">MEAL PLAN</th><?php endif; ?>
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
                            if (!empty($prop->properties_name)) $propertyNames[] = $prop->properties_name;
                            if (!empty($prop->rooms) && is_array($prop->rooms)) {
                              foreach ($prop->rooms as $roomName) {
                                if (!empty($roomName)) $roomNames[] = $roomName;
                              }
                            }
                          }
                        }

                        $propertyText = !empty($propertyNames) ? implode(' / ', array_unique($propertyNames)) : '-';
                        $roomText = !empty($roomNames) ? implode(' / ', array_unique($roomNames)) : '-';
                      ?>
                      <?php
                        $exc_day_date_text = '';
                        $exc_day_num = 0;
                        if (!empty($day->quotation_properties_days_day)) {
                          $exc_day_num = (int)preg_replace('/[^0-9]/', '', $day->quotation_properties_days_day);
                        } elseif (!empty($day->quotation_itineraries_days_day)) {
                          $exc_day_num = (int)preg_replace('/[^0-9]/', '', $day->quotation_itineraries_days_day);
                        }
                        if (isset($quotation->start_date) && $quotation->start_date && $exc_day_num > 0) {
                          $exc_day_date_text = date('d M Y', strtotime('+' . ($exc_day_num - 1) . ' days', strtotime($quotation->start_date)));
                        }
                      ?>
                      <tr>
                        <td><?= $exc_day_date_text ? htmlspecialchars($exc_day_date_text) : 'Day ' . str_pad($exc_day_num, 2, '0', STR_PAD_LEFT); ?></td>
                        <td><?= htmlspecialchars($day->state_name); ?></td>
                        <?php if (!empty($day->quotation_itineraries_days_travel_back)): ?>
                          <td colspan="<?= $colCount + 1; ?>"><?= htmlspecialchars(!empty($cat->quotation_options_last_day_details) ? $cat->quotation_options_last_day_details : ''); ?></td>
                        <?php else: ?>
                          <td><?= htmlspecialchars($propertyText); ?></td>
                          <?php if ($showRoom): ?><td><?= htmlspecialchars($roomText); ?></td><?php endif; ?>
                          <?php if ($showMeal): ?><td><?= htmlspecialchars(!empty($day->meal_plan) ? $day->meal_plan : '-'); ?></td><?php endif; ?>
                        <?php endif; ?>
                      </tr>
                    <?php endforeach; ?>
                  <?php endif; ?>
                </tbody>
              </table>
            </div>

            <?php if (!empty($cat->quotation_options_complimentary_inclusion) || !empty($cat->special_requirements)): ?>
            <div class="complimentary-box-exclusive">
              <div class="complimentary-text-exclusive"><?php
                $parts = [];
                if (!empty($cat->quotation_options_complimentary_inclusion)) {
                  $parts[] = htmlspecialchars($cat->quotation_options_complimentary_inclusion);
                }
                if (!empty($cat->special_requirements)) {
                  $parts[] = implode(', ', array_map(function($sr) { return htmlspecialchars($sr->special_requirements_name); }, $cat->special_requirements));
                }
                echo nl2br(implode(', ', $parts));
              ?></div>
            </div>
            <?php endif; ?>

            <div class="exclusive-bottom-grid">

              <?php if ((int)$cat->quotation_options_vehicle_display === 1): ?>
              <div class="exclusive-feature-box">
                  <div class="exclusive-feature-title">
                      <img src="<?= base_url('assets/images/exclusive-transport.png'); ?>">
                      <span>TRANSPORTATION</span>
                  </div>
                  <ul class="exclusive-feature-list transport">
                      <li>
                          <?php
                          $vehicleText = trim(
                              (isset($cat->vehicle_name) ? $cat->vehicle_name : '') .
                              (!empty($cat->vehicle_number_seat) ? ' ('.$cat->vehicle_number_seat.' Seater)' : '') .
                              (!empty($cat->vehicle_description) ? ' - '.$cat->vehicle_description : '')
                          );
                          echo htmlspecialchars($vehicleText ?: '-');
                          ?>
                      </li>
                  </ul>
              </div>
              <?php endif; ?>

              <!-- <div class="exclusive-feature-box">
                <div class="exclusive-feature-title">
                  <img src="<?= base_url('assets/images/exclusive-heart.png'); ?>" alt="">
                  <span>Property based Inclusions</span>
                </div>
                <ul class="exclusive-feature-list transport">
                  <?php if (!empty($cat->complimentary)): ?>
                    <?php foreach ($cat->complimentary as $inc): ?>
                      <li><?= htmlspecialchars($inc->inclusion_name); ?></li>
                    <?php endforeach; ?>
                  <?php else: ?>
                    <li>-</li>
                  <?php endif; ?>
                </ul>
              </div>

              <div class="exclusive-feature-box">
                <div class="exclusive-feature-title">
                  <img src="<?= base_url('assets/images/exclusive-heart.png'); ?>" alt="">
                  <span>SPECIAL REQUIREMENTS</span>
                </div>

                <ul class="exclusive-feature-list transport">
                  <?php if (!empty($cat->special_requirements)): ?>
                    <?php foreach ($cat->special_requirements as $sr): ?>
                      <li>
                        <?= htmlspecialchars($sr->special_requirements_name); ?>
                        <?php if (!empty($sr->quotation_special_requirements_cost)): ?>
                          - <?= number_format((float)$sr->quotation_special_requirements_cost, 2); ?>
                        <?php endif; ?>
                      </li>
                    <?php endforeach; ?>
                  <?php else: ?>
                    <li>-</li>
                  <?php endif; ?>
                </ul>
              </div> -->

              <?php if (!empty($cat->complimentary)): ?>
<div class="exclusive-feature-box">
  <div class="exclusive-feature-title">
    <img src="<?= base_url('assets/images/exclusive-heart.png'); ?>" alt="">
    <span>Property based Inclusions</span>
  </div>

  <ul class="exclusive-feature-list transport">
    <?php foreach ($cat->complimentary as $inc): ?>
      <li><?= htmlspecialchars($inc->inclusion_name); ?></li>
    <?php endforeach; ?>
  </ul>
</div>
<?php endif; ?>


<?php if (!empty($cat->special_requirements)): ?>
<div style="display:none;">
<div class="exclusive-feature-box">
  <div class="exclusive-feature-title">
    <img src="<?= base_url('assets/images/exclusive-heart.png'); ?>" alt="">
    <span>SPECIAL REQUIREMENTS</span>
  </div>

  <ul class="exclusive-feature-list transport">
    <?php foreach ($cat->special_requirements as $sr): ?>
      <li>
        <?= htmlspecialchars($sr->special_requirements_name); ?>
      </li>
    <?php endforeach; ?>
  </ul>
</div>
</div>
<?php endif; ?>
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

      <?php else: ?>
        <div class="pdf-page property-page">
          <div class="standard-full-wrap">

            <div class="property-header">
              <div class="property-left">
                <div class="property-contact">
                  <div class="contact-row">
                    <img src="<?= base_url('assets/images/phone-grey.png'); ?>" alt="Phone" class="contact-icon-img">
                    <!-- <span class="contact-value"><?= $companyPhone; ?></span> -->
                     <span class="contact-value">919072609079</span>
                  </div>
                  <div class="contact-row">
                    <img src="<?= base_url('assets/images/email-grey.png'); ?>" alt="Email" class="contact-icon-img">
                    <!-- <span class="contact-value"><?= $companyEmail; ?></span> -->
                     <span class="contact-value">sales@royaleindia.in</span>
                  </div>
                </div>
              </div>

              <div class="property-logo">
                <img src="<?= base_url('assets/images/Royale-logo-new.png'); ?>" alt="Logo">
              </div>
            </div>

            <!-- <div class="property-main-title">
              PACKAGE COST &amp; ACCOMMODATION SUMMARY
            </div> -->

            <div class="standard-summary-row">
              <div class="standard-left-summary">
                <div class="standard-package-type">
                  <div class="standard-package-inner">
                    <img src="<?= base_url('assets/images/type.png'); ?>" alt="Type">
                    <span class="type-text">Package Type: <?= htmlspecialchars($categoryTitle); ?></span>
                    <span class="standard-package-star">★</span>
                  </div>
                </div>

                <div class="standard-left-info">
                  <div class="standard-info-row">
                    <img src="<?= base_url('assets/images/guest.png'); ?>" alt="Guests" class="standard-info-icon-img">
                    <!-- <span><strong>Guests:</strong> <?= str_pad((int)$guest_total, 2, '0', STR_PAD_LEFT); ?> Guests</span> -->
                    <?php
$guestTotal = isset($guest_total['total']) ? (int)$guest_total['total'] : 0;
$adults     = isset($guest_total['adults']) ? (int)$guest_total['adults'] : 0;
$children   = isset($guest_total['children']) ? (int)$guest_total['children'] : 0;
?>

<span>
    <strong>Guests:</strong>
    <?= $guestTotal; ?> Guests |
    <?= $adults; ?> Adult<?= $adults > 1 ? 's' : '' ?>

    <?php if ($children > 0): ?>
        | <?= $children; ?> Child<?= $children > 1 ? 'ren' : '' ?>
    <?php endif; ?>
</span>
                  </div>

                  <div class="standard-info-row">
                    <img src="<?= base_url('assets/images/travel.png'); ?>" alt="Travel" class="standard-info-icon-img">
                    <span><strong>Travel Dates:</strong> <?= htmlspecialchars($travel_date_text); ?></span>
                  </div>
                </div>
              </div>
<?php if (!function_exists('q_option_display_amount_standard')) {
function q_option_display_amount_standard($option)
{
    $type = !empty($option->quotation_options_amount_type)
        ? $option->quotation_options_amount_type
        : 'net';

    if ($type === 'person') {
        return ' ' . q_preview_amount($option->quotation_options_per_amount) . '/- Per Person';
    }

    if ($type === 'adult') {
        return ' ' . q_preview_amount($option->quotation_options_per_amount) . '/- Per Adult';
    }

    if ($type === 'couple') {
        return ' ' . q_preview_amount($option->quotation_options_per_amount) . '/- Per Couple';
    }

    return ' ' . q_preview_amount($option->preview_total_amount) . ' /- NET';
}
} // end function_exists q_option_display_amount_standard
?>
              <div class="standard-right-summary">
                <div class="standard-cost-title">TOTAL PACKAGE COST</div>
                <?php
                  $std_cost_amount = '';
                  $std_cost_suffix = '';
                  $std_type = !empty($cat->quotation_options_amount_type) ? $cat->quotation_options_amount_type : 'net';
                  if ($std_type === 'person') {
                    $std_cost_amount = q_preview_amount($cat->quotation_options_per_amount);
                    $std_cost_suffix = 'Per Person';
                  } elseif ($std_type === 'adult') {
                    $std_cost_amount = q_preview_amount($cat->quotation_options_per_amount);
                    $std_cost_suffix = 'Per Adult';
                  } elseif ($std_type === 'couple') {
                    $std_cost_amount = q_preview_amount($cat->quotation_options_per_amount);
                    $std_cost_suffix = 'Per Couple';
                  } else {
                    $std_cost_amount = q_preview_amount($cat->preview_total_amount);
                    $std_cost_suffix = 'NET';
                  }
                ?>
                <div class="standard-cost-value"><?= htmlspecialchars($std_cost_amount); ?>/-</div>
                <?php if ($std_cost_suffix): ?>
                <div class="standard-cost-suffix"><?= htmlspecialchars($std_cost_suffix); ?></div>
                <?php endif; ?>
              </div>
            </div>

            <div class="accommodation-heading">
              <div class="icon-group">
                <div class="dots">
                  <span></span><span></span><span></span><span></span>
                </div>
                <div class="lines">
                  <span></span><span></span><span></span><span></span>
                </div>
              </div>
              <div class="accommodation-title">ACCOMMODATION DETAILS</div>
            </div>

            <?php
                $colCountS = ($showRoom ? 1 : 0) + ($showMeal ? 1 : 0);
                if ($colCountS === 2) {
                    $wDateS = 8; $wDestS = 14; $wHotelS = 38; $wRoomS = 25; $wMealS = 15;
                } elseif ($colCountS === 1) {
                    $wDateS = 8; $wDestS = 18; $wHotelS = 59;
                    $wRoomS = $showRoom ? 35 : 0;
                    $wMealS = $showMeal ? 15 : 0;
                } else {
                    $wDateS = 12; $wDestS = 18; $wHotelS = 70; $wRoomS = 0; $wMealS = 0;
                }
            ?>
            <table class="property-table">
              <thead>
                <tr>
                  <th style="width:<?= $wDateS; ?>%;">Date</th>
                  <th style="width:<?= $wDestS; ?>%;">Destination</th>
                  <th style="width:<?= $wHotelS; ?>%;">Hotel Name</th>
                  <?php if ($showRoom): ?><th style="width:<?= $wRoomS; ?>%;">Room Category</th><?php endif; ?>
                  <?php if ($showMeal): ?><th style="width:<?= $wMealS; ?>%;">Meal Plan</th><?php endif; ?>
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
                          if (!empty($prop->properties_name)) $propertyNames[] = $prop->properties_name;
                          if (!empty($prop->rooms) && is_array($prop->rooms)) {
                            foreach ($prop->rooms as $roomName) {
                              if (!empty($roomName)) $roomNames[] = $roomName;
                            }
                          }
                        }
                      }

                      $propertyText = !empty($propertyNames) ? implode(' / ', array_unique($propertyNames)) : '-';
                      $roomText = !empty($roomNames) ? implode(' / ', array_unique($roomNames)) : '-';
                    ?>
                    <?php
                      $std_day_date_text = '';
                      $std_day_num = 0;
                      if (!empty($day->quotation_properties_days_day)) {
                        $std_day_num = (int)preg_replace('/[^0-9]/', '', $day->quotation_properties_days_day);
                      } elseif (!empty($day->quotation_itineraries_days_day)) {
                        $std_day_num = (int)preg_replace('/[^0-9]/', '', $day->quotation_itineraries_days_day);
                      }
                      if (isset($quotation->start_date) && $quotation->start_date && $std_day_num > 0) {
                        $std_day_date_text = date('d M Y', strtotime('+' . ($std_day_num - 1) . ' days', strtotime($quotation->start_date)));
                      }
                    ?>
                    <tr>
                      <td><?= $std_day_date_text ? htmlspecialchars($std_day_date_text) : 'Day ' . str_pad($std_day_num, 2, '0', STR_PAD_LEFT); ?></td>
                      <td><?= htmlspecialchars($day->state_name); ?></td>
                      <?php if (!empty($day->quotation_itineraries_days_travel_back)): ?>
                        <td colspan="<?= $colCountS + 1; ?>"><?= htmlspecialchars(!empty($cat->quotation_options_last_day_details) ? $cat->quotation_options_last_day_details : ''); ?></td>
                      <?php else: ?>
                        <td><?= htmlspecialchars($propertyText); ?></td>
                        <?php if ($showRoom): ?><td><?= htmlspecialchars($roomText); ?></td><?php endif; ?>
                        <?php if ($showMeal): ?><td><?= htmlspecialchars(!empty($day->meal_plan) ? $day->meal_plan : '-'); ?></td><?php endif; ?>
                      <?php endif; ?>
                    </tr>
                  <?php endforeach; ?>
                <?php endif; ?>
              </tbody>
            </table>

            <?php if (!empty($cat->quotation_options_complimentary_inclusion) || !empty($cat->special_requirements)): ?>
            <div class="complimentary-box">
              <div class="complimentary-text"><?php
                $parts = [];
                if (!empty($cat->quotation_options_complimentary_inclusion)) {
                  $parts[] = htmlspecialchars($cat->quotation_options_complimentary_inclusion);
                }
                if (!empty($cat->special_requirements)) {
                  $parts[] = implode(', ', array_map(function($sr) { return htmlspecialchars($sr->special_requirements_name); }, $cat->special_requirements));
                }
                echo nl2br(implode(', ', $parts));
              ?></div>
            </div>
            <?php endif; ?>

            <div class="standard-extra-section">
              <!-- <div class="standard-extra-box">
                <div class="standard-extra-left">
                  <img src="<?= base_url('assets/images/vehicle.png'); ?>" alt="Vehicle" class="standard-extra-icon-img">
                  <div class="standard-extra-title">TRANSPORTATION</div>
                </div>

                <div class="standard-extra-right">
                  <div class="standard-extra-text">
                    <?php
                      $vehicleText = trim(
  (isset($cat->vehicle_name) ? $cat->vehicle_name : '') .
  (!empty($cat->vehicle_number_seat) ? ' ('.$cat->vehicle_number_seat.' Seater)' : '') .
  (!empty($cat->vehicle_description) ? ' - '.$cat->vehicle_description : '')
);
                      echo htmlspecialchars($vehicleText ?: '-');
                    ?>
                  </div>
                </div>
              </div> -->

              <?php if ((int)$cat->quotation_options_vehicle_display === 1): ?>
              <div class="standard-extra-box">
                  <div class="standard-extra-left">
                      <img src="<?= base_url('assets/images/vehicle.png'); ?>" class="standard-extra-icon-img">
                      <div class="standard-extra-title">TRANSPORTATION</div>
                  </div>

                  <div class="standard-extra-right">
                      <div class="standard-extra-text">
                          <?php
                          $vehicleText = trim(
                              (isset($cat->vehicle_name) ? $cat->vehicle_name : '') .
                              (!empty($cat->vehicle_number_seat) ? ' ('.$cat->vehicle_number_seat.' Seater)' : '') .
                              (!empty($cat->vehicle_description) ? ' - '.$cat->vehicle_description : '')
                          );
                          echo htmlspecialchars($vehicleText ?: '-');
                          ?>
                      </div>
                  </div>
              </div>
              <?php endif; ?>

              <!-- <div class="standard-extra-box">
                <div class="standard-extra-left">
                  <img src="<?= base_url('assets/images/complimentary.png'); ?>" alt="Complimentary" class="standard-extra-icon-img">
                  <div class="standard-extra-title">Property Inclusions</div>
                </div>

                <div class="standard-extra-right">
                  <?php if (!empty($cat->complimentary)): ?>
                    <ul class="standard-extra-red-list">
                      <?php foreach ($cat->complimentary as $inc): ?>
                        <li><?= htmlspecialchars($inc->inclusion_name); ?></li>
                      <?php endforeach; ?>
                    </ul>
                  <?php else: ?>
                    <div class="standard-extra-text">-</div>
                  <?php endif; ?>
                </div>
              </div>

              <div class="standard-extra-box">
  <div class="standard-extra-left">
    <img src="<?= base_url('assets/images/complimentary.png'); ?>" alt="Special" class="standard-extra-icon-img">
    <div class="standard-extra-title">SPECIAL REQUIREMENTS</div>
  </div>

  <div class="standard-extra-right">
    <?php if (!empty($cat->special_requirements)): ?>
  <ul class="standard-extra-red-list">
    <?php foreach ($cat->special_requirements as $sr): ?>
      <li>
        <?= htmlspecialchars($sr->special_requirements_name); ?>
        <?php if (!empty($sr->quotation_special_requirements_cost)): ?>
          - <?= number_format((float)$sr->quotation_special_requirements_cost, 2); ?>
        <?php endif; ?>
      </li>
    <?php endforeach; ?>
  </ul>
<?php else: ?>
  <div class="standard-extra-text">-</div>
<?php endif; ?>
  </div>
</div> -->

              <?php if (!empty($cat->complimentary)): ?>
              <div class="standard-extra-box">
                <div class="standard-extra-left">
                  <!-- <img src="<?= base_url('assets/images/complimentary.png'); ?>" alt="Complimentary" class="standard-extra-icon-img"> -->
                  <div class="standard-extra-title">Property Based Inclusions</div>
                </div>

                <div class="standard-extra-right">
                  <ul class="standard-extra-red-list">
                    <?php foreach ($cat->complimentary as $inc): ?>
                      <li><?= htmlspecialchars($inc->inclusion_name); ?></li>
                    <?php endforeach; ?>
                  </ul>
                </div>
              </div>
              <?php endif; ?>


              <?php if (!empty($cat->special_requirements)): ?>
              <div style="display:none;">
              <div class="standard-extra-box">
                <div class="standard-extra-left">
                  <!-- <img src="<?= base_url('assets/images/complimentary.png'); ?>" alt="Special" class="standard-extra-icon-img"> -->
                  <div class="standard-extra-title">SPECIAL REQUIREMENTS</div>
                </div>

                <div class="standard-extra-right">
                  <ul class="standard-extra-red-list">
                    <?php foreach ($cat->special_requirements as $sr): ?>
                      <li>
                        <?= htmlspecialchars($sr->special_requirements_name); ?>
                      </li>
                    <?php endforeach; ?>
                  </ul>
                </div>
              </div>
              </div>
              <?php endif; ?>

              
            </div>

          </div>
        </div>
      <?php endif; ?>
    <?php endforeach; ?>
  <?php endif; ?>

  <div id="commonSectionsSource" style="display:none;">

  <?php if (!empty($payment)): ?>
  <div class="simple-section flow-section">
    <div class="simple-pill-title">PAYMENT POLICIES</div>
    <div class="simple-list-block">
      <?php foreach ($payment as $row): ?>
        <?php if (!empty($row->quotation_payment_policies_details)): ?>
          <div class="simple-point">
            <div class="simple-point-bullet">•</div>
            <div class="simple-point-text"><?= htmlspecialchars($row->quotation_payment_policies_details); ?></div>
          </div>
        <?php endif; ?>
      <?php endforeach; ?>
    </div>
  </div>
  <?php endif; ?>

  <?php if (!empty($account_details)): ?>

<?php
$accounts = is_array($account_details) ? $account_details : array($account_details);

$qrAccount = null;
foreach ($accounts as $acc) {
    if (!empty($acc->qr_status) && (int)$acc->qr_status === 1 && !empty($acc->qr_code)) {
        $qrAccount = $acc;
        break;
    }
}
?>

<div class="payment-account-wrap flow-section payment-account-design <?= empty($qrAccount) ? 'no-qr-panel' : ''; ?>">

  <?php if (!empty($qrAccount)): ?>
  <!-- LEFT QR PANEL -->
  <div class="payment-qr-panel">

    <?php if (!empty($qrAccount->bank_logo)): ?>
      <img src="<?= base_url('uploads/bank_logo/'.$qrAccount->bank_logo); ?>"
           alt="Bank Logo" class="payment-qr-bank-logo">
    <?php endif; ?>

    <?php if (!empty($qrAccount->account_name)): ?>
      <div class="payment-qr-company">
        <?= htmlspecialchars($qrAccount->account_name); ?>
      </div>
    <?php endif; ?>

    <div class="payment-scan-title">SCAN &amp; PAY</div>

    <?php if (!empty($qrAccount->qr_code)): ?>
      <img src="<?= base_url('uploads/qr-code/'.$qrAccount->qr_code); ?>"
           alt="QR Code" class="payment-main-qr">
    <?php endif; ?>

    <?php if (isset($qrAccount->up_id) && !empty($qrAccount->up_id)): ?>
      <div class="payment-upi-id">
        UPI ID: <?= htmlspecialchars($qrAccount->up_id); ?>
      </div>
    <?php endif; ?>

    <div class="payment-icons">
      <img src="<?= base_url('assets/images/UPI.jpg'); ?>" alt="UPI">
      <img src="<?= base_url('assets/images/bhim.png'); ?>" alt="BHIM">
      <img src="<?= base_url('assets/images/google-pay.png'); ?>" alt="Google Pay">
      <img src="<?= base_url('assets/images/paytm.png'); ?>" alt="Paytm">
      <img src="<?= base_url('assets/images/phonepay.png'); ?>" alt="PhonePe">
    </div>

  </div>
  <?php endif; ?>

  <!-- RIGHT ACCOUNT DETAILS -->
  <div class="payment-account-panel">
    <div class="payment-account-title">Account Details</div>

    <div class="payment-account-grid <?= count($accounts) > 2 ? 'multi-account-grid' : ''; ?>">
      <?php foreach ($accounts as $acc): ?>
        <div class="payment-bank-item">

          <?php if (!empty($acc->bank_logo)): ?>
            <img src="<?= base_url('uploads/bank_logo/'.$acc->bank_logo); ?>"
                 alt="Bank Logo" class="payment-bank-logo">
          <?php endif; ?>

          <div class="payment-bank-lines">
            <?php if (!empty($acc->account_name)): ?>
              <div><strong>A/c Name:</strong> <?= htmlspecialchars($acc->account_name); ?></div>
            <?php endif; ?>

            <?php if (!empty($acc->account_number)): ?>
              <div><strong>A/c No:</strong> <?= htmlspecialchars($acc->account_number); ?></div>
            <?php endif; ?>

            <?php if (!empty($acc->ifsc_code)): ?>
              <div><strong>IFSC:</strong> <?= htmlspecialchars($acc->ifsc_code); ?></div>
            <?php endif; ?>

            <?php if (!empty($acc->branch_name)): ?>
              <div><strong>BRANCH:</strong> <?= htmlspecialchars($acc->branch_name); ?></div>
            <?php endif; ?>

            <?php if (!empty($acc->up_id)): ?>
              <div style="white-space:nowrap;"><strong>UPI ID:</strong> <?= htmlspecialchars($acc->up_id); ?></div>
            <?php endif; ?>
          </div>

        </div>
      <?php endforeach; ?>
    </div>
  </div>

</div>
<?php endif; ?>

  <?php if (!empty($optional_addons)): ?>
  <div class="simple-section flow-section">
    <div class="simple-pill-title">OPTIONAL ADD ON</div>
    <div class="simple-list-block">
      <?php foreach ($optional_addons as $row): ?>
        <?php if (!empty($row->quotation_optional_add_on_details)): ?>
          <div class="simple-point">
            <div class="simple-point-bullet">•</div>
            <div class="simple-point-text"><?= htmlspecialchars($row->quotation_optional_add_on_details); ?></div>
          </div>
        <?php endif; ?>
      <?php endforeach; ?>
    </div>
  </div>
  <?php endif; ?>

  <?php if (!empty($cancel)): ?>
  <div class="simple-section flow-section">
    <div class="simple-pill-title">CANCELLATION POLICY</div>
    <div class="simple-list-block">
      <?php foreach ($cancel as $row): ?>
        <?php if (!empty($row->quotation_cancellation_policies_details)): ?>
          <div class="simple-point">
            <div class="simple-point-bullet">•</div>
            <div class="simple-point-text"><?= htmlspecialchars($row->quotation_cancellation_policies_details); ?></div>
          </div>
        <?php endif; ?>
      <?php endforeach; ?>
    </div>
  </div>
  <?php endif; ?>

  <?php if (!empty($terms)): ?>
  <div class="simple-section flow-section">
    <div class="simple-pill-title">TERMS & CONDITION</div>
    <div class="simple-list-block">
      <?php foreach ($terms as $row): ?>
        <?php if (!empty($row->quotation_terms_condition_details)): ?>
          <div class="simple-point">
            <div class="simple-point-bullet">•</div>
            <div class="simple-point-text"><?= htmlspecialchars($row->quotation_terms_condition_details); ?></div>
          </div>
        <?php endif; ?>
      <?php endforeach; ?>
    </div>
  </div>
  <?php endif; ?>

  <?php if (!empty($notes)): ?>
  <div class="simple-section flow-section">
    <div class="simple-pill-title">NOTES</div>
    <div class="simple-list-block">
      <?php foreach ($notes as $row): ?>
        <?php if (!empty($row->quotation_notes_details)): ?>
          <div class="simple-point">
            <div class="simple-point-bullet">•</div>
            <div class="simple-point-text"><?= htmlspecialchars($row->quotation_notes_details); ?></div>
          </div>
        <?php endif; ?>
      <?php endforeach; ?>
    </div>
  </div>
  <?php endif; ?>

  <?php if (!empty($prepared_by)): ?>
  <div class="simple-section flow-section">
    <div class="simple-pill-title">PREPARED BY</div>
    <div class="prepared-by-box">
      <div class="prepared-by-name">
        <?= htmlspecialchars($prepared_by->admin_name); ?>
      </div>
      <?php if (!empty($prepared_by->designation_name)): ?>
      <div class="prepared-by-line">
        <?= htmlspecialchars($prepared_by->designation_name); ?>
      </div>
      <?php endif; ?>
      <?php if (!empty($prepared_by->user_phone_number)): ?>
      <div class="prepared-by-line">
        Ph No : <?= htmlspecialchars($prepared_by->user_phone_number); ?>
      </div>
      <?php endif; ?>
      <?php if (!empty($prepared_by->user_email_address)): ?>
      <div class="prepared-by-line">
        Mail ID : <?= htmlspecialchars($prepared_by->user_email_address); ?>
      </div>
      <?php endif; ?>
    </div>
  </div>
  <?php endif; ?>

</div>

<div id="commonPagesContainer"></div>

  <!-- LAST COVER -->
  <div class="pdf-page cover-page <?php echo !empty($quotation->quotation_last_cover_page) ? 'cover-has-image' : ''; ?>"
       id="lastCoverPage"
       style="<?php echo !empty($quotation->quotation_last_cover_page) ? "background-image:url('".base_url('uploads/quotation_cover/'.$quotation->quotation_last_cover_page)."');" : 'background:linear-gradient(135deg,var(--brand),var(--brand2));'; ?>">
    <div class="last-cover-content"></div>
  </div>

</div>

<script src="https://cdnjs.cloudflare.com/ajax/libs/jspdf/2.5.1/jspdf.umd.min.js"></script>
<script src="https://cdnjs.cloudflare.com/ajax/libs/html2canvas/1.4.1/html2canvas.min.js"></script>
<script>
var guestName = "<?php
  $guest_name_for_file = (!empty($quotation->guest_name)) ? $quotation->guest_name : 'Guest';
  echo preg_replace('/[^A-Za-z0-9\- ]/', '', $guest_name_for_file);
?>";
</script>
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
    el.innerHTML = '<?php echo addslashes(!empty($quotation->quotation_title) ? $quotation->quotation_title : 'Loading...'); ?>';
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

function createCommonPage() {
  const page = document.createElement('div');
  page.className = 'pdf-page common-flow-page common-generated-page';

  page.innerHTML = `
    <div class="content-logo">
      <img src="<?= base_url('assets/images/Royale-logo-new.png'); ?>" alt="Logo">
    </div>

    <div class="common-flow-content"></div>

    <div class="footer-lite">
      <div class="fitem"><span class="ficon"><?= $ICON_PHONE; ?></span><?= $companyPhone; ?></div>
      <div class="fitem"><span class="ficon"><?= $ICON_WEB; ?></span><?= $companyWeb; ?></div>
      <div class="fitem"><span class="ficon"><?= $ICON_INSTAGRAM; ?></span><?= $companyInsta; ?></div>
    </div>
  `;

  return page;
}

// function buildCommonPages() {
//   const source = document.getElementById('commonSectionsSource');
//   const target = document.getElementById('commonPagesContainer');

//   if (!source || !target) return;

//   target.innerHTML = '';

//   const sections = Array.from(source.children);
//   if (!sections.length) return;

//   let page = createCommonPage();
//   target.appendChild(page);

//   let content = page.querySelector('.common-flow-content');

//   sections.forEach(function(section) {
//     const clone = section.cloneNode(true);
//     content.appendChild(clone);

//     if (content.scrollHeight > content.clientHeight) {
//       content.removeChild(clone);

//       page = createCommonPage();
//       target.appendChild(page);

//       content = page.querySelector('.common-flow-content');
//       content.appendChild(clone);
//     }
//   });
// }

// function buildCommonPages() {
//   const source = document.getElementById('commonSectionsSource');
//   const target = document.getElementById('commonPagesContainer');

//   if (!source || !target) return;

//   // do not rebuild if already generated
//   if (target.querySelector('.common-generated-page')) return;

//   target.innerHTML = '';

//   const sections = Array.from(source.children);
//   if (!sections.length) return;

//   let page = createCommonPage();
//   target.appendChild(page);

//   let content = page.querySelector('.common-flow-content');

//   function newPage() {
//     page = createCommonPage();
//     target.appendChild(page);
//     content = page.querySelector('.common-flow-content');
//   }

//   sections.forEach(function(section) {

//     // clone section wrapper without children
//     const sectionClone = section.cloneNode(false);

//     // section title
//     const title = section.querySelector('.simple-pill-title');
//     const list  = section.querySelector('.simple-list-block');

//     // for normal list sections
//     if (title && list) {
//       const titleClone = title.cloneNode(true);
//       const listClone = document.createElement('div');
//       listClone.className = 'simple-list-block';

//       sectionClone.appendChild(titleClone);
//       sectionClone.appendChild(listClone);
//       content.appendChild(sectionClone);

//       // if title itself does not fit, move whole section to new page
//       if (content.scrollHeight > content.clientHeight) {
//         content.removeChild(sectionClone);
//         newPage();
//         content.appendChild(sectionClone);
//       }

//       const points = Array.from(list.children);

//       points.forEach(function(point) {
//         const pointClone = point.cloneNode(true);
//         listClone.appendChild(pointClone);

//         if (content.scrollHeight > content.clientHeight) {
//           listClone.removeChild(pointClone);

//           // create next page with same section title
//           newPage();

//           const nextSection = section.cloneNode(false);
//           const nextTitle = title.cloneNode(true);
//           const nextList = document.createElement('div');
//           nextList.className = 'simple-list-block';

//           nextSection.appendChild(nextTitle);
//           nextSection.appendChild(nextList);
//           content.appendChild(nextSection);

//           nextList.appendChild(pointClone);
//         }
//       });

//       return;
//     }

//     // for account details or other non-list blocks
//     const blockClone = section.cloneNode(true);
//     content.appendChild(blockClone);

//     if (content.scrollHeight > content.clientHeight) {
//       content.removeChild(blockClone);
//       newPage();
//       content.appendChild(blockClone);
//     }
//   });
// }

function buildCommonPages() {
  const source = document.getElementById('commonSectionsSource');
  const target = document.getElementById('commonPagesContainer');

  if (!source || !target) return;

  // do not rebuild if already generated
  if (target.querySelector('.common-generated-page')) return;

  target.innerHTML = '';

  const sections = Array.from(source.children);
  if (!sections.length) return;

  let page = createCommonPage();
  target.appendChild(page);

  let content = page.querySelector('.common-flow-content');

  function newPage() {
    page = createCommonPage();
    target.appendChild(page);
    content = page.querySelector('.common-flow-content');
  }

  function ensureFits(el) {
    return content.scrollHeight <= content.clientHeight;
  }

  sections.forEach(function(section) {

    const title = section.querySelector('.simple-pill-title');
    const list  = section.querySelector('.simple-list-block');

    // LIST SECTIONS: payment, optional, cancellation, terms, notes
    if (title && list) {

      let sectionBox = document.createElement('div');
      sectionBox.className = 'simple-section flow-section';

      let titleClone = title.cloneNode(true);
      let listBox = document.createElement('div');
      listBox.className = 'simple-list-block';

      sectionBox.appendChild(titleClone);
      sectionBox.appendChild(listBox);
      content.appendChild(sectionBox);

      // if heading itself does not fit, move to next page
      if (!ensureFits(sectionBox)) {
        content.removeChild(sectionBox);
        newPage();

        sectionBox = document.createElement('div');
        sectionBox.className = 'simple-section flow-section';

        titleClone = title.cloneNode(true);
        listBox = document.createElement('div');
        listBox.className = 'simple-list-block';

        sectionBox.appendChild(titleClone);
        sectionBox.appendChild(listBox);
        content.appendChild(sectionBox);
      }

      const points = Array.from(list.querySelectorAll('.simple-point'));

      points.forEach(function(point) {
        const pointClone = point.cloneNode(true);
        listBox.appendChild(pointClone);

        if (!ensureFits(pointClone)) {
          listBox.removeChild(pointClone);

          // If no points were placed yet, the title is alone on the page;
          // bring it to the next page along with the first point.
          const titleIsAlone = listBox.children.length === 0;

          if (titleIsAlone) {
            content.removeChild(sectionBox);
          }

          newPage();

          sectionBox = document.createElement('div');
          sectionBox.className = 'simple-section flow-section' + (titleIsAlone ? '' : ' continued-section');

          listBox = document.createElement('div');
          listBox.className = 'simple-list-block';

          if (titleIsAlone) {
            sectionBox.appendChild(title.cloneNode(true));
          }

          sectionBox.appendChild(listBox);
          content.appendChild(sectionBox);

          listBox.appendChild(pointClone);
        }
      });

      return;
    }

    // NON-LIST BLOCKS: account details
    const blockClone = section.cloneNode(true);
    content.appendChild(blockClone);

    if (!ensureFits(blockClone)) {
      content.removeChild(blockClone);
      newPage();
      content.appendChild(blockClone);
    }
  });
}

function mmToPx(mm) {
  return mm * (96 / 25.4);
}

function createStandardContinuationPage() {
  const page = document.createElement('div');
  page.className = 'pdf-page property-page standard-cont-page generated-option-page';

  page.innerHTML = `
    <div class="standard-full-wrap">
      <div class="property-header">
        <div class="property-left">
          <div class="property-contact">
            <div class="contact-row">
              <img src="<?= base_url('assets/images/phone-grey.png'); ?>" class="contact-icon-img">
              <span class="contact-value"><?= $companyPhone; ?></span>
            </div>
            <div class="contact-row">
              <img src="<?= base_url('assets/images/email-grey.png'); ?>" class="contact-icon-img">
              <span class="contact-value"><?= $companyEmail; ?></span>
            </div>
          </div>
        </div>
        <div class="property-logo">
          <img src="<?= base_url('assets/images/Royale-logo-new.png'); ?>">
        </div>
      </div>

      <div class="standard-split-content"></div>
    </div>
  `;

  return page;
}

function createExclusiveContinuationPage() {
  const page = document.createElement('div');
  page.className = 'pdf-page exclusive-page exclusive-cont-page generated-option-page';

  page.innerHTML = `
    <div class="exclusive-inner">
      <div class="exclusive-top-decor">
        <img src="<?= base_url('assets/images/exclusive-ornament-top.png'); ?>">
      </div>

      <div class="exclusive-logo">
        <img src="<?= base_url('assets/images/Royale-logo-gold.png'); ?>">
      </div>

      <div class="exclusive-mid-decor">
        <img src="<?= base_url('assets/images/exclusive-ornament-bottom.png'); ?>">
      </div>

      <div class="exclusive-split-content"></div>
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
  `;

  return page;
}

function fitOptionPageFontSize(page, type) {
  const contentSelector = type === 'standard' ? '.standard-full-wrap' : '.exclusive-inner';
  const content = page.querySelector(contentSelector);
  if (!content) return;

  const fontClasses = ['font-xs', 'font-sm', 'font-normal', 'font-lg', 'font-xl'];
  fontClasses.forEach(function(cls) { page.classList.remove(cls); });

  const targetHeight = page.clientHeight;
  const originalHeight = page.style.height;
  const originalOverflow = page.style.overflow;
  const originalContentMinHeight = content.style.minHeight;

  page.style.height = 'auto';
  page.style.overflow = 'visible';
  content.style.minHeight = '0';

  const tryOrder = ['font-xl', 'font-lg', 'font-normal', 'font-sm', 'font-xs'];
  let chosenClass = 'font-xs';

  for (let i = 0; i < tryOrder.length; i++) {
    const cls = tryOrder[i];
    page.classList.remove(...fontClasses);
    page.classList.add(cls);
    void content.offsetHeight;
    if (content.scrollHeight <= targetHeight + 2) {
      chosenClass = cls;
      break;
    }
  }

  page.classList.remove(...fontClasses);
  page.classList.add(chosenClass);
  page.style.height = originalHeight;
  page.style.overflow = originalOverflow;
  content.style.minHeight = originalContentMinHeight;
}

function buildOptionExtraPages() {
  // document.querySelectorAll('.generated-option-page').forEach(function(el) {
  //   el.remove();
  // });

  if (document.querySelectorAll('.generated-option-page').length > 0) {
    return;
}

  document.querySelectorAll('.property-page:not(.generated-option-page)').forEach(function(page) {
    fitOptionPageFontSize(page, 'standard');
    splitStandardOptionPage(page);
  });

  document.querySelectorAll('.exclusive-page:not(.generated-option-page):not(#lastCoverPage)').forEach(function(page) {
    fitOptionPageFontSize(page, 'exclusive');
    splitExclusiveOptionPage(page);
  });

  removeEmptyContinuationPages();
}

function removeEmptyContinuationPages() {
  document.querySelectorAll('.standard-cont-page.generated-option-page').forEach(function(p) {
    var c = p.querySelector('.standard-split-content');
    if (!c) { p.remove(); return; }
    var hasContent = false;
    Array.from(c.children).forEach(function(child) {
      if (child.tagName === 'TABLE') {
        var tbody = child.querySelector('tbody');
        if (tbody && tbody.children.length > 0) hasContent = true;
      } else if (child.classList && child.classList.contains('standard-extra-section')) {
        if (child.children.length > 0) hasContent = true;
      } else {
        hasContent = true;
      }
    });
    if (!hasContent) p.remove();
  });

  document.querySelectorAll('.exclusive-cont-page.generated-option-page').forEach(function(p) {
    var c = p.querySelector('.exclusive-split-content');
    if (!c) { p.remove(); return; }
    var hasContent = false;
    Array.from(c.children).forEach(function(child) {
      if (child.tagName === 'TABLE') {
        var tbody = child.querySelector('tbody');
        if (tbody && tbody.children.length > 0) hasContent = true;
      } else if (child.classList && child.classList.contains('exclusive-bottom-grid')) {
        if (child.children.length > 0) hasContent = true;
      } else {
        hasContent = true;
      }
    });
    if (!hasContent) p.remove();
  });
}

function splitStandardOptionPage(page) {
  const table = page.querySelector('.property-table');
  const extra = page.querySelector('.standard-extra-section');
  const compBox = page.querySelector('.complimentary-box');

  if (!table) return;

  const pageTop = page.getBoundingClientRect().top;
  const limitBottom = pageTop + page.offsetHeight - mmToPx(16);

  const tbody = table.querySelector('tbody');
  const rows = Array.from(tbody.querySelectorAll('tr'));
  const extras = extra ? Array.from(extra.children) : [];

  const overflowItems = [];

  rows.forEach(function(row) {
    if (row.getBoundingClientRect().bottom > limitBottom) {
      overflowItems.push({ type: 'row', node: row });
    }
  });

  overflowItems.forEach(function(item) {
    item.node.remove();
  });

  extras.forEach(function(block) {
    if (!block.parentNode) return;

    if (block.getBoundingClientRect().bottom > limitBottom) {
      overflowItems.push({ type: 'extra', node: block });
      block.remove();
    }
  });

  if (compBox && compBox.parentNode) {
    if (compBox.getBoundingClientRect().bottom > limitBottom) {
      overflowItems.push({ type: 'complimentary', node: compBox });
      compBox.remove();
    }
  }

  if (!overflowItems.length) return;

  let insertAfter = page;
  let contPage = createStandardContinuationPage();

  insertAfter.parentNode.insertBefore(contPage, insertAfter.nextSibling);
  insertAfter = contPage;

  let content = contPage.querySelector('.standard-split-content');
  let currentTable = null;
  let currentTbody = null;
  let currentExtra = null;

  overflowItems.forEach(function(item) {

    if (item.type === 'row') {
      if (!currentTable) {
        currentTable = table.cloneNode(false);
        currentTable.innerHTML = table.querySelector('thead').outerHTML + '<tbody></tbody>';
        currentTbody = currentTable.querySelector('tbody');
        content.appendChild(currentTable);
      }

      currentTbody.appendChild(item.node);

      if (content.scrollHeight > content.clientHeight) {
        currentTbody.removeChild(item.node);

        contPage = createStandardContinuationPage();
        insertAfter.parentNode.insertBefore(contPage, insertAfter.nextSibling);
        insertAfter = contPage;

        content = contPage.querySelector('.standard-split-content');
        currentTable = table.cloneNode(false);
        currentTable.innerHTML = table.querySelector('thead').outerHTML + '<tbody></tbody>';
        currentTbody = currentTable.querySelector('tbody');
        content.appendChild(currentTable);
        currentTbody.appendChild(item.node);
      }
    }

    if (item.type === 'extra') {
      if (!currentExtra) {
        currentExtra = document.createElement('div');
        currentExtra.className = 'standard-extra-section';
        content.appendChild(currentExtra);
      }

      currentExtra.appendChild(item.node);

      if (content.scrollHeight > content.clientHeight) {
        currentExtra.removeChild(item.node);

        contPage = createStandardContinuationPage();
        insertAfter.parentNode.insertBefore(contPage, insertAfter.nextSibling);
        insertAfter = contPage;

        content = contPage.querySelector('.standard-split-content');
        currentExtra = document.createElement('div');
        currentExtra.className = 'standard-extra-section';
        content.appendChild(currentExtra);
        currentExtra.appendChild(item.node);
      }
    }
    if (item.type === 'complimentary') {
      content.appendChild(item.node);

      if (content.scrollHeight > content.clientHeight) {
        item.node.remove();

        contPage = createStandardContinuationPage();
        insertAfter.parentNode.insertBefore(contPage, insertAfter.nextSibling);
        insertAfter = contPage;

        content = contPage.querySelector('.standard-split-content');
        content.appendChild(item.node);
      }
    }
  });

  document.querySelectorAll('.standard-cont-page.generated-option-page').forEach(function(p) {
    var c = p.querySelector('.standard-split-content');
    if (!c) { p.remove(); return; }
    var hasContent = false;
    Array.from(c.children).forEach(function(child) {
      if (child.tagName === 'TABLE') {
        var tbody = child.querySelector('tbody');
        if (tbody && tbody.children.length > 0) hasContent = true;
      } else if (child.classList && child.classList.contains('standard-extra-section')) {
        if (child.children.length > 0) hasContent = true;
      } else {
        hasContent = true;
      }
    });
    if (!hasContent) p.remove();
  });
}

function splitExclusiveOptionPage(page) {
  const table = page.querySelector('.exclusive-table');
  const extra = page.querySelector('.exclusive-bottom-grid');
  const compBox = page.querySelector('.complimentary-box-exclusive');

  if (!table) return;

  const pageTop = page.getBoundingClientRect().top;
  const limitBottom = pageTop + page.offsetHeight - mmToPx(40);

  const tbody = table.querySelector('tbody');
  const rows = Array.from(tbody.querySelectorAll('tr'));
  const extras = extra ? Array.from(extra.children).filter(function(el) {
    return el.classList.contains('exclusive-feature-box');
  }) : [];

  const overflowItems = [];

  rows.forEach(function(row) {
    if (row.getBoundingClientRect().bottom > limitBottom) {
      overflowItems.push({ type: 'row', node: row });
    }
  });

  overflowItems.forEach(function(item) {
    item.node.remove();
  });

  extras.forEach(function(block) {
    if (!block.parentNode) return;

    if (block.getBoundingClientRect().bottom > limitBottom) {
      overflowItems.push({ type: 'extra', node: block });
      block.remove();
    }
  });

  if (compBox && compBox.parentNode) {
    if (compBox.getBoundingClientRect().bottom > limitBottom) {
      overflowItems.push({ type: 'complimentary', node: compBox });
      compBox.remove();
    }
  }

  if (!overflowItems.length) return;

  let insertAfter = page;
  let contPage = createExclusiveContinuationPage();

  insertAfter.parentNode.insertBefore(contPage, insertAfter.nextSibling);
  insertAfter = contPage;

  let content = contPage.querySelector('.exclusive-split-content');
  let currentTable = null;
  let currentTbody = null;
  let currentExtra = null;

  overflowItems.forEach(function(item) {

    if (item.type === 'row') {
      if (!currentTable) {
        currentTable = table.cloneNode(false);
        currentTable.innerHTML = table.querySelector('thead').outerHTML + '<tbody></tbody>';
        currentTbody = currentTable.querySelector('tbody');
        content.appendChild(currentTable);
      }

      currentTbody.appendChild(item.node);

      if (content.scrollHeight > content.clientHeight) {
        currentTbody.removeChild(item.node);

        contPage = createExclusiveContinuationPage();
        insertAfter.parentNode.insertBefore(contPage, insertAfter.nextSibling);
        insertAfter = contPage;

        content = contPage.querySelector('.exclusive-split-content');
        currentTable = table.cloneNode(false);
        currentTable.innerHTML = table.querySelector('thead').outerHTML + '<tbody></tbody>';
        currentTbody = currentTable.querySelector('tbody');
        content.appendChild(currentTable);
        currentTbody.appendChild(item.node);
      }
    }

    if (item.type === 'extra') {
      if (!currentExtra) {
        currentExtra = document.createElement('div');
        currentExtra.className = 'exclusive-bottom-grid';
        content.appendChild(currentExtra);
      }

      currentExtra.appendChild(item.node);

      if (content.scrollHeight > content.clientHeight) {
        currentExtra.removeChild(item.node);

        contPage = createExclusiveContinuationPage();
        insertAfter.parentNode.insertBefore(contPage, insertAfter.nextSibling);
        insertAfter = contPage;

        content = contPage.querySelector('.exclusive-split-content');
        currentExtra = document.createElement('div');
        currentExtra.className = 'exclusive-bottom-grid';
        content.appendChild(currentExtra);
        currentExtra.appendChild(item.node);
      }
    }
    if (item.type === 'complimentary') {
      content.appendChild(item.node);

      if (content.scrollHeight > content.clientHeight) {
        item.node.remove();

        contPage = createExclusiveContinuationPage();
        insertAfter.parentNode.insertBefore(contPage, insertAfter.nextSibling);
        insertAfter = contPage;

        content = contPage.querySelector('.exclusive-split-content');
        content.appendChild(item.node);
      }
    }
  });

  document.querySelectorAll('.exclusive-cont-page.generated-option-page').forEach(function(p) {
    var c = p.querySelector('.exclusive-split-content');
    if (!c) { p.remove(); return; }
    var hasContent = false;
    Array.from(c.children).forEach(function(child) {
      if (child.tagName === 'TABLE') {
        var tbody = child.querySelector('tbody');
        if (tbody && tbody.children.length > 0) hasContent = true;
      } else if (child.classList && child.classList.contains('exclusive-bottom-grid')) {
        if (child.children.length > 0) hasContent = true;
      } else {
        hasContent = true;
      }
    });
    if (!hasContent) p.remove();
  });
}

function fitBriefPageFontSize(page) {
  const header = page.querySelector('.brief-header');
  const list = page.querySelector('.brief-list');
  if (!header || !list) return 'font-normal';

  const fontClasses = ['font-xs', 'font-sm', 'font-normal', 'font-lg', 'font-xl'];
  fontClasses.forEach(function(cls) { page.classList.remove(cls); });

  const targetHeight = page.clientHeight;
  const originalHeight = page.style.height;
  const originalOverflow = page.style.overflow;
  const originalListMinHeight = list.style.minHeight;

  page.style.height = 'auto';
  page.style.overflow = 'visible';
  list.style.minHeight = '0';

  const tryOrder = ['font-normal', 'font-sm', 'font-xs'];
  let chosenClass = 'font-xs';

  for (let i = 0; i < tryOrder.length; i++) {
    const cls = tryOrder[i];
    page.classList.remove(...fontClasses);
    page.classList.add(cls);
    void list.offsetHeight;
    const contentHeight = header.scrollHeight + list.scrollHeight;
    if (contentHeight <= targetHeight + 2) {
      chosenClass = cls;
      break;
    }
  }

  page.classList.remove(...fontClasses);
  page.classList.add(chosenClass);
  page.style.height = originalHeight;
  page.style.overflow = originalOverflow;
  list.style.minHeight = originalListMinHeight;

  return chosenClass;
}

function createBriefContinuationPage() {
  const page = document.createElement('div');
  page.className = 'pdf-page brief-page generated-brief-page';

  page.innerHTML = `
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

    <div class="brief-list"></div>

    <div class="footer">
      <div class="fitem"><span class="ficon"><?= $ICON_PHONE; ?></span><?= $companyPhone; ?></div>
      <div class="fitem"><span class="ficon"><?= $ICON_WEB; ?></span><?= $companyWeb; ?></div>
      <div class="fitem"><span class="ficon"><?= $ICON_INSTAGRAM; ?></span><?= $companyInsta; ?></div>
    </div>
  `;

  return page;
}

function buildBriefExtraPages() {
  if (document.querySelectorAll('.generated-brief-page').length > 0) {
    return;
  }

  const briefPage = document.getElementById('briefPage');
  if (!briefPage) return;

  const briefList = briefPage.querySelector('.brief-list');
  if (!briefList) return;

  const chosenBriefClass = fitBriefPageFontSize(briefPage);

  const rows = Array.from(briefList.querySelectorAll('.brief-row'));
  if (!rows.length) return;

  const pageTop = briefPage.getBoundingClientRect().top;
  const limitBottom = pageTop + briefPage.offsetHeight - mmToPx(22);

  let overflowRows = [];

  rows.forEach(function(row) {
    if (row.getBoundingClientRect().bottom > limitBottom) {
      overflowRows.push(row);
    }
  });

  overflowRows.forEach(function(row) {
    row.remove();
  });

  if (!overflowRows.length) return;

  let insertAfter = briefPage;
  let contPage = createBriefContinuationPage();
  ['font-xs', 'font-sm', 'font-normal', 'font-lg', 'font-xl'].forEach(function(cls) { contPage.classList.remove(cls); });
  contPage.classList.add(chosenBriefClass);
  insertAfter.parentNode.insertBefore(contPage, insertAfter.nextSibling);
  insertAfter = contPage;

  let contList = contPage.querySelector('.brief-list');

  overflowRows.forEach(function(row) {
    contList.appendChild(row);

    if (contList.scrollHeight > contList.clientHeight || row.getBoundingClientRect().bottom > contPage.getBoundingClientRect().top + contPage.offsetHeight - mmToPx(22)) {
      contList.removeChild(row);

      contPage = createBriefContinuationPage();
      ['font-xs', 'font-sm', 'font-normal', 'font-lg', 'font-xl'].forEach(function(cls) { contPage.classList.remove(cls); });
      contPage.classList.add(chosenBriefClass);
      insertAfter.parentNode.insertBefore(contPage, insertAfter.nextSibling);
      insertAfter = contPage;

      contList = contPage.querySelector('.brief-list');
      contList.appendChild(row);
    }
  });
}

function buildIncExcPages() {

  const source = document.getElementById('incExcSectionsSource');
  const target = document.getElementById('incExcPagesContainer');

  if (!source || !target) return;

  if (target.querySelector('.inc-exc-generated-page')) return;

  target.innerHTML = '';

  const sections = Array.from(source.children);
  if (!sections.length) return;

  let page = createCommonPage();
  page.classList.add('inc-exc-generated-page');

  target.appendChild(page);

  let content = page.querySelector('.common-flow-content');

  function newPage() {
    page = createCommonPage();
    page.classList.add('inc-exc-generated-page');
    target.appendChild(page);
    content = page.querySelector('.common-flow-content');
  }

  function ensureFits() {
    return content.scrollHeight <= content.clientHeight;
  }

  sections.forEach(function(section){

    const title = section.querySelector('.simple-pill-title');
    const list  = section.querySelector('.simple-list-block');

    let sectionBox = document.createElement('div');
    sectionBox.className = 'simple-section';

    let titleClone = title.cloneNode(true);
    let listBox = document.createElement('div');
    listBox.className = 'simple-list-block';

    sectionBox.appendChild(titleClone);
    sectionBox.appendChild(listBox);
    content.appendChild(sectionBox);

    // move title if near footer
    if (!ensureFits()) {
      content.removeChild(sectionBox);
      newPage();

      sectionBox = document.createElement('div');
      sectionBox.className = 'simple-section';

      titleClone = title.cloneNode(true);
      listBox = document.createElement('div');
      listBox.className = 'simple-list-block';

      sectionBox.appendChild(titleClone);
      sectionBox.appendChild(listBox);
      content.appendChild(sectionBox);
    }

    const points = Array.from(list.querySelectorAll('.simple-point'));

    points.forEach(function(point){

      const pointClone = point.cloneNode(true);
      listBox.appendChild(pointClone);

      if (!ensureFits()) {

        listBox.removeChild(pointClone);

        newPage();

        // continue without repeating title
        sectionBox = document.createElement('div');
        sectionBox.className = 'simple-section continued-section';

        listBox = document.createElement('div');
        listBox.className = 'simple-list-block';

        sectionBox.appendChild(listBox);
        content.appendChild(sectionBox);

        listBox.appendChild(pointClone);
      }

    });

  });
}


window.addEventListener("load", function(){
  initCoverEditors();

  setTimeout(function () {
    buildBriefExtraPages();
    buildOptionExtraPages();
    buildIncExcPages();   // ✅ NEW
    buildCommonPages();
  }, 800);
});

function showPdfLoader(){
  var overlay = document.getElementById('pdfLoadingOverlay');
  var btn = document.querySelector('.btn-area button');

  if (overlay) overlay.style.display = 'flex';

  if (btn) {
    btn.disabled = true;
    btn.innerText = 'Preparing...';
  }
}

function hidePdfLoader(){
  var overlay = document.getElementById('pdfLoadingOverlay');
  var btn = document.querySelector('.btn-area button');

  if (overlay) overlay.style.display = 'none';

  if (btn) {
    btn.disabled = false;
    btn.innerText = 'Download PDF';
  }
}

// async function downloadPDF(){

//   showPdfLoader();
//   buildBriefExtraPages();
//   buildOptionExtraPages();
//   buildIncExcPages();
//   buildCommonPages();
//   const { jsPDF } = window.jspdf;

//   const width = 285;
//   const height = 285;

//   const toolbar = document.getElementById('coverEditorToolbar');
//   const oldDisplay = toolbar ? toolbar.style.display : '';

//   if (toolbar) toolbar.style.display = 'none';

//   try {
//     const pdf = new jsPDF({
//       orientation: width > height ? 'l' : 'p',
//       unit: 'mm',
//       format: [width, height]
//     });

//     const pages = document.querySelectorAll('.pdf-page');

//     for(let i = 0; i < pages.length; i++){
//       const canvas = await html2canvas(pages[i], {
//         scale: 2,
//         useCORS: true,
//         backgroundColor: '#ffffff'
//       });

//       const imgData = canvas.toDataURL('image/jpeg', 1.0);

//       if(i > 0) pdf.addPage([width, height]);
//       pdf.addImage(imgData, 'JPEG', 0, 0, width, height);
//     }
// var today = new Date();
// var dateText =
//     String(today.getDate()).padStart(2, '0') + '-' +
//     String(today.getMonth() + 1).padStart(2, '0') + '-' +
//     today.getFullYear();

// var safeGuestName = guestName.replace(/\s+/g, '_');
// var fileName = "Quotation-" + safeGuestName + "-" + dateText + ".pdf";

// pdf.save(fileName);
//     // pdf.save('Quotation_Preview.pdf');
//   } finally {
//     if (toolbar) toolbar.style.display = oldDisplay || 'flex';
//   }
// }

async function downloadPDF(){

  showPdfLoader();

  const { jsPDF } = window.jspdf;

  const width = 285;
  const height = 285;

  const toolbar = document.getElementById('coverEditorToolbar');
  const oldDisplay = toolbar ? toolbar.style.display : '';

  if (toolbar) toolbar.style.display = 'none';

  try {

    await new Promise(resolve => setTimeout(resolve, 100));

    buildBriefExtraPages();
    buildOptionExtraPages();
    buildIncExcPages();
    buildCommonPages();

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

    var today = new Date();
    var dateText =
      String(today.getDate()).padStart(2, '0') + '-' +
      String(today.getMonth() + 1).padStart(2, '0') + '-' +
      today.getFullYear();

    var guest = (typeof guestName !== 'undefined' && guestName)
      ? guestName
      : 'Guest';

    var safeGuestName = guest.replace(/[^\w\s-]/g, '').replace(/\s+/g, '_');

    var fileName = "Quotation-" + safeGuestName + "-" + dateText + ".pdf";

    pdf.save(fileName);

  } catch(e) {

    console.error(e);
    alert('PDF download failed. Please try again.');

  } finally {

    if (toolbar) toolbar.style.display = oldDisplay || 'flex';
    hidePdfLoader();

  }
}


</script>

</body>
</html>