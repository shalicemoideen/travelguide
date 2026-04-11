<!DOCTYPE html>
<html lang="en">
<head>
<meta charset="UTF-8">
<title>Travel Itinerary</title>
<link href="https://fonts.googleapis.com/css2?family=Poppins:wght@300;400;600;700&display=swap" rel="stylesheet">

<style>
:root{
  --brand:#1e3a8a;
  --brand2:#2563eb;
  --green:#2e7d32;
  --text:#111827;
  --muted:#6b7280;
  --line:#e5e7eb;
}

body{
  margin:0;
  font-family:'Poppins',sans-serif;
  background:#fff;
  color:var(--text);
  -webkit-print-color-adjust: exact;
  print-color-adjust: exact;
}

.btn-area { position: fixed; bottom:20px; right:20px; z-index:9999;}
button {
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
@media print{ .btn-area{display:none !important;} }

/* ===== PDF PAGE ===== */
.pdf-page{
  width:210mm;
  height:297mm;
  margin:0 auto;
  box-sizing:border-box;
  page-break-after:always;
  overflow:hidden;
  position:relative;
  background:#fff;
}

/* ===== COVER PAGE ===== */
.cover-page {
  background:linear-gradient(135deg,var(--brand),var(--brand2));
  color:white;
  display:flex;
  flex-direction:column;
  justify-content:center;
  align-items:center;
  text-align:center;
  padding:40mm 20mm 40mm 20mm;
}
.cover-title{
  font-size:48px;
  font-weight:700;
  letter-spacing:3px;
  margin:0;
}
.cover-subtitle{
  font-size:22px;
  font-weight:300;
  margin-top:10px;
}
.cover-details{
  margin-top:50px;
  font-size:18px;
  line-height:1.8;
}
.cover-footer{
  position:absolute;
  bottom:25mm;
  width:100%;
  font-size:14px;
  opacity:0.95;
}

/* ===== ITINERARY DAY PAGE ===== */
.daypage{
  padding:18mm 18mm 14mm 18mm;
}

/* Logo top-right */
.daypage-logo{
  position:absolute;
  top:12mm;
  right:18mm;
  width:52mm;
  text-align:right;
}
.daypage-logo img{
  max-width:52mm;
  height:auto;
}

/* Day + title */
.daypage-top{
  padding-top:18mm;
  display:flex;
  align-items:center;
  gap:12px;
  margin-bottom:6mm;
}

.day-pill{
  background:var(--green);
  color:#fff;
  font-weight:700;
  border-radius:999px;
  padding:7px 14px;
  font-size:14px;
}

.route-title{
  font-size:22px;
  font-weight:500;
  letter-spacing:.4px;
  text-transform:uppercase;
  padding-right:58mm;
}

/* Single sentence description */
.day-desc{
  font-size:15px;
  line-height:1.6;
  color:var(--muted);
  margin-bottom:8mm;
  padding-right:58mm;
}

/* Image */
.hero{
  width:100%;
  height:130mm;
  object-fit:cover;
  display:block;
}

/* Footer */
.footer{
  position:absolute;
  left:18mm;
  right:18mm;
  bottom:10mm;
  padding-top:8mm;
  border-top:1px solid var(--line);
  display:flex;
  justify-content:center;
  gap:18px;
  color:var(--muted);
  font-size:12px;
}
.fitem{ display:flex; gap:8px; align-items:center; }
.ficon{ font-size:14px; }

</style>
</head>

<body>

<div class="btn-area">
  <button onclick="downloadPDF()">Download PDF</button>
</div>

<div id="pdf-content">

  <!-- COVER PAGE -->
  <div class="pdf-page cover-page">
    <h1 class="cover-title">TRAVEL ITINERARY</h1>
    <div class="cover-subtitle">Paris, France</div>
    <div class="cover-details">
      Prepared For: <strong>John Doe</strong><br>
      Travel Dates: <strong>10 March – 15 March 2026</strong><br>
      Duration: <strong>5 Days</strong>
    </div>
    <div class="cover-footer">
      Your Travel Company<br>
      contact@travelcompany.com | +1 234 567 890
    </div>
  </div>

  <!-- ITINERARY PAGES -->
  <div id="itinerary-pages"></div>

</div>

<script src="https://cdnjs.cloudflare.com/ajax/libs/jspdf/2.5.1/jspdf.umd.min.js"></script>
<script src="https://cdnjs.cloudflare.com/ajax/libs/html2canvas/1.4.1/html2canvas.min.js"></script>

<script>

/* ===== COMPANY INFO ===== */
const COMPANY = {
  logo: "<?php echo base_url();?>assets/images/royale-logo.png",
  phone: "+917907648636",
  website: "www.royaleindia.in",
  instagram: "royale_india_tours"
};

/* ===== ITINERARY DATA ===== */
const itinerary = [
  {
    day: "Day 01",
    route: "PARIS ARRIVAL",
    desc: "Arrive in Paris, enjoy airport pickup, check in to your hotel and relax before an evening stroll.",
    img: "https://images.unsplash.com/photo-1549144511-f099e773c147?auto=format&fit=crop&w=1800&q=80"
  },
  {
    day: "Day 02",
    route: "CITY TOUR",
    desc: "Discover Paris highlights including Eiffel Tower, Louvre Museum and a scenic Seine River cruise.",
    img: "https://images.unsplash.com/photo-1502602898657-3e91760cbb34?auto=format&fit=crop&w=1800&q=80"
  },
  {
    day: "Day 03",
    route: "CULTURE & ART",
    desc: "Explore historic streets, visit Notre Dame area and enjoy the artistic charm of Montmartre.",
    img: "https://images.unsplash.com/photo-1522092787789-7ae8d1964b99?auto=format&fit=crop&w=1800&q=80"
  }
];

/* ===== BUILD DAY PAGE ===== */
function buildDayPage(d){
  const page = document.createElement("div");
  page.className = "pdf-page daypage";

  page.innerHTML = `
    <div class="daypage-logo">
      <img src="${COMPANY.logo}" alt="Logo" crossorigin="anonymous">
    </div>

    <div class="daypage-top">
      <div class="day-pill">${d.day}</div>
      <div class="route-title">${d.route}</div>
    </div>

    <p class="day-desc">${d.desc}</p>

    <img class="hero" src="${d.img}" alt="${d.day}" crossorigin="anonymous">

    <div class="footer">
      <div class="fitem"><span class="ficon">📞</span>${COMPANY.phone}</div>
      <div class="fitem"><span class="ficon">🔗</span>${COMPANY.website}</div>
      <div class="fitem"><span class="ficon">📷</span>${COMPANY.instagram}</div>
    </div>
  `;

  return page;
}

/* Render pages */
function renderItinerary(){
  const holder = document.getElementById("itinerary-pages");
  holder.innerHTML = "";
  itinerary.forEach(d => holder.appendChild(buildDayPage(d)));
}

window.addEventListener("load", renderItinerary);

/* ===== PDF DOWNLOAD ===== */
async function downloadPDF(){
  renderItinerary();

  const { jsPDF } = window.jspdf;
  const pdf = new jsPDF('p','mm','a4');

  const pages = document.querySelectorAll('.pdf-page');

  for(let i=0;i<pages.length;i++){
    const canvas = await html2canvas(pages[i], {
      scale: 2,
      useCORS: true,
      backgroundColor: '#ffffff'
    });

    const imgData = canvas.toDataURL('image/jpeg', 1.0);

    if(i > 0) pdf.addPage();
    pdf.addImage(imgData, 'JPEG', 0, 0, 210, 297);
  }

  pdf.save('Travel_Itinerary.pdf');
}
</script>

</body>
</html>