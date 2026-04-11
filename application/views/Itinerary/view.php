<!DOCTYPE html>
<html lang="en">
<head>
<meta charset="UTF-8">
<title>Travel Itinerary Preview</title>
<link href="https://fonts.googleapis.com/css2?family=Poppins:wght@300;400;600;700&display=swap" rel="stylesheet">

<style>
:root{
  --brand:#1e3a8a;
  --brand2:#2563eb;
  --green:#2e7d32;
  --text:#111827;
  --muted:#6b7280;
  --line:#e5e7eb;

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
  position: fixed;
  bottom:20px;
  right:20px;
  z-index:9999;
}
button{
  padding:12px 30px;
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
  width: var(--pdf-width);
  height: var(--pdf-height);
  margin: 0 auto;
  box-sizing: border-box;
  page-break-after: always;
  overflow: hidden;
  position: relative;
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
  padding:40mm 20mm 40mm 20mm;
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
  background:rgba(0,0,0,0.15);
}
.cover-page > *{
  position:relative;
  z-index:1;
}

/* ===== editable cover toolbar ===== */
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

/* ===== editable cover title/subtitle ===== */
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
  font-weight:500;
  margin:0;
  color:#fff;
  line-height:1.2;
}

/* blank last cover */
.last-cover-content{
  display:none;
}
.cover-page.last-cover.blank-only{
  padding:0;
}
.cover-page.last-cover.blank-only .last-cover-content{
  display:none;
}

/* ===== BRIEF PAGE ===== */
.brief-page{
  background:#ffff;
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
  font-size:22px;
  font-weight:505;
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

/* ===== ITINERARY DAY PAGE ===== */
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
  color:#000000;
  margin:0 12mm 6mm 12mm;
  padding-right:0;
  max-width:none;
  word-break:normal;
  overflow-wrap:break-word;
}
.day-desc p{
  margin:0 0 10px 0;
}
.day-desc ul, .day-desc ol{
  margin:6px 0 6px -22px;
}

.hero{
  display:block;
  width:100%;
  height:135mm;
  object-fit:cover;
  margin:0;
}

.footer{
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
.ficon.instagram svg{
  fill:none;
}
</style>
</head>

<body>

<div class="btn-area">
  <button onclick="downloadPDF()">Download PDF</button>
</div>

<div id="pdf-content">

  <!-- FIRST COVER PAGE -->
  <div class="pdf-page cover-page" id="firstCoverPage">

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
      <div class="cover-subtitle editable-cover" id="coverSubtitleEditor" contenteditable="true">Loading...</div>
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

    <div class="brief-list" id="brief-list"></div>
  </div>

  <!-- ITINERARY PAGES -->
  <div id="itinerary-pages"></div>

  <!-- LAST COVER PAGE -->
  <div class="pdf-page cover-page last-cover blank-only" id="lastCoverPage">
    <div class="last-cover-content"></div>
  </div>

</div>

<script src="https://cdnjs.cloudflare.com/ajax/libs/jspdf/2.5.1/jspdf.umd.min.js"></script>
<script src="https://cdnjs.cloudflare.com/ajax/libs/html2canvas/1.4.1/html2canvas.min.js"></script>
<script src="https://cdnjs.cloudflare.com/ajax/libs/jquery/3.7.1/jquery.min.js"></script>

<script>
const ITINERARY_ID = <?= (int)$itineraries_id ?>;
const COMPANY_LOGO = "<?= base_url('assets/images/Royale-logo-new.png'); ?>";
const COVER_BASE = "<?= base_url('uploads/itinerary_cover/'); ?>";

let itinerary = [];
let activeEditableId = 'coverTitleEditor';

/* inline svg icons */
const ICON_PHONE = `
<svg viewBox="0 0 24 24" aria-hidden="true">
  <path d="M22 16.92v3a2 2 0 0 1-2.18 2 19.86 19.86 0 0 1-8.63-3.07 19.5 19.5 0 0 1-6-6A19.86 19.86 0 0 1 2.12 4.18 2 2 0 0 1 4.11 2h3a2 2 0 0 1 2 1.72c.12.9.33 1.77.61 2.61a2 2 0 0 1-.45 2.11L8 9.91a16 16 0 0 0 6.09 6.09l1.47-1.27a2 2 0 0 1 2.11-.45c.84.28 1.71.49 2.61.61A2 2 0 0 1 22 16.92z"/>
</svg>`;

const ICON_WEB = `
<svg viewBox="0 0 24 24" aria-hidden="true">
  <circle cx="12" cy="12" r="10"></circle>
  <path d="M2 12h20"></path>
  <path d="M12 2a15.3 15.3 0 0 1 4 10 15.3 15.3 0 0 1-4 10 15.3 15.3 0 0 1-4-10 15.3 15.3 0 0 1 4-10z"></path>
</svg>`;

const ICON_INSTAGRAM = `
<svg viewBox="0 0 24 24" aria-hidden="true">
  <rect x="3" y="3" width="18" height="18" rx="5" ry="5"></rect>
  <circle cx="12" cy="12" r="4"></circle>
  <circle cx="17.5" cy="6.5" r="1"></circle>
</svg>`;

/* ===== cover title/subtitle editor ===== */
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
    el.innerHTML = 'Loading...';
    el.style.fontSize = '22px';
    el.style.color = '#ffffff';
    el.style.fontWeight = '500';
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

/* sanitize day html */
function safeHTML(html){
  html = String(html || '');
  html = html.replace(/<script[\s\S]*?>[\s\S]*?<\/script>/gi, '');
  const plain = html.replace(/<[^>]*>/g,'').replace(/&nbsp;/g,' ').replace(/\s+/g,' ').trim();
  if (!plain) return '';
  return html;
}

function setCoverBackground(el, fileName){
  if (!el) return;

  el.classList.remove('cover-has-image');
  el.style.backgroundImage = '';
  el.style.backgroundSize = '';
  el.style.backgroundPosition = '';
  el.style.backgroundRepeat = '';

  if (fileName) {
    el.classList.add('cover-has-image');
    el.style.backgroundImage = 'url("' + COVER_BASE + fileName + '")';
    el.style.backgroundSize = 'cover';
    el.style.backgroundPosition = 'center center';
    el.style.backgroundRepeat = 'no-repeat';
  }
}

/* first and last cover */
function setCovers(master){
  master = master || {};

  document.getElementById('coverSubtitleEditor').innerText = master.cover_subtitle || '-';

  setCoverBackground(
    document.getElementById('firstCoverPage'),
    master.itineraries_first_cover_page || ''
  );

  setCoverBackground(
    document.getElementById('lastCoverPage'),
    master.itineraries_last_cover_page || ''
  );
}

function buildBriefPage(){
  const holder = document.getElementById('brief-list');
  holder.innerHTML = '';

  itinerary.forEach(function(d, index){
    const num = d.day_no ? String(d.day_no).padStart(2, '0') : String(index + 1).padStart(2, '0');
    const dayText = 'Day ' + num;
    const title = d.title || '';

    const row = document.createElement('div');
    row.className = 'brief-row';
    row.innerHTML = `
      <div class="brief-day">${dayText}</div>
      <div class="brief-route">${title}</div>
    `;
    holder.appendChild(row);
  });
}

function buildDayPage(d){
  const page = document.createElement("div");
  page.className = "pdf-page daypage";

  const dayText = d.day_text || ('Day ' + (d.day_no || ''));
  const title = d.title || '';
  const descHTML = safeHTML(d.desc_html || '');
  const imageUrl = d.image_url || '';

  page.innerHTML = `
    <div class="daypage-logo">
      <img src="${COMPANY_LOGO}" alt="Logo">
    </div>

    <div class="daypage-top">
      <div class="day-pill">${dayText}</div>
      <div class="route-title">${title}</div>
    </div>

    <div class="day-desc">${descHTML}</div>

    ${imageUrl ? `<img class="hero" src="${imageUrl}" alt="">` : ''}

    <div class="footer">
      <div class="fitem">
        <span class="ficon phone">${ICON_PHONE}</span>
        ${(window.__COMPANY_PHONE__ || '')}
      </div>
      <div class="fitem">
        <span class="ficon web">${ICON_WEB}</span>
        ${(window.__COMPANY_WEBSITE__ || '')}
      </div>
      <div class="fitem">
        <span class="ficon instagram">${ICON_INSTAGRAM}</span>
        ${(window.__COMPANY_INSTAGRAM__ || '')}
      </div>
    </div>
  `;
  return page;
}

function renderItinerary(){
  const holder = document.getElementById("itinerary-pages");
  holder.innerHTML = '';

  buildBriefPage();
  itinerary.forEach(d => holder.appendChild(buildDayPage(d)));
}

function loadPreview(){
  $.ajax({
    url: "<?= base_url('index.php/Itinerary/ajax_view_preview/'); ?>" + ITINERARY_ID,
    type: "GET",
    dataType: "JSON",
    success: function(res){
      console.log("Preview API Response:", res);

      if (!res || !res.status) {
        alert("No preview data");
        return;
      }

      setCovers(res.master || {});
      window.__COMPANY_PHONE__ = (res.master && res.master.company_phone) ? res.master.company_phone : '';
      window.__COMPANY_WEBSITE__ = 'www.royaleindia.in';
      window.__COMPANY_INSTAGRAM__ = 'royale_india_tours';

      itinerary = Array.isArray(res.days) ? res.days : [];
      renderItinerary();
    },
    error: function(xhr){
      console.error(xhr.responseText || xhr);
      alert("Error loading preview");
    }
  });
}

window.addEventListener("load", function(){
  initCoverEditors();
  loadPreview();
});

/* PDF download */
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

    for(let i=0;i<pages.length;i++){
      const canvas = await html2canvas(pages[i], {
        scale: 2,
        useCORS: true,
        backgroundColor: '#ffffff'
      });

      const imgData = canvas.toDataURL('image/jpeg', 1.0);

      if(i > 0) pdf.addPage([width, height]);
      pdf.addImage(imgData, 'JPEG', 0, 0, width, height);
    }

    pdf.save('Travel_Itinerary.pdf');
  } finally {
    if (toolbar) toolbar.style.display = oldDisplay || 'flex';
  }
}
</script>

</body>
</html>