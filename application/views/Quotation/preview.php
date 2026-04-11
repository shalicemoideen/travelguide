<?php
function e($v, $default = '-') {
    return htmlspecialchars((isset($v) && $v !== '') ? $v : $default, ENT_QUOTES, 'UTF-8');
}
function nf($v) {
    $x = (float)(isset($v) ? $v : 0);
    return number_format($x, 2);
}
?>
<!DOCTYPE html>
<html lang="en">
<head>
<meta charset="UTF-8">
<meta name="viewport" content="width=device-width, initial-scale=1.0">
<title>Quotation Preview</title>
<link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.3/dist/css/bootstrap.min.css" rel="stylesheet">
<link href="https://fonts.googleapis.com/css2?family=Poppins:wght@400;600;700&display=swap" rel="stylesheet">

<style>
  body { font-family: 'Poppins', sans-serif; background-color:#f8f9fa; margin:0; }

  /* === HERO / COVER (FULL PAGE, NO TEXT) === */
  .hero {
    height: 100vh;
    background: url('https://images.unsplash.com/photo-1507525428034-b723cf961d3e?auto=format&fit=crop&w=1950&q=80') no-repeat center center/cover;
    position: relative;
  }
  .hero::before {
    content: "";
    position: absolute;
    inset: 0;
    background-color: rgba(0, 0, 0, 0.55);
    z-index: 0;
  }

  /* === ITINERARY SECTION (SAME AS PACKAGE SAMPLE) === */
  .itinerary-section { padding: 80px 15px; }
  .itinerary-section h1 { text-align:center; font-weight:700; color:#007bff; margin-bottom:50px; }

  .itinerary-card {
    background:#fff;
    border-radius:10px;
    overflow:hidden;
    box-shadow:0 5px 20px rgba(0,0,0,0.05);
    margin-bottom:40px;
    transition: transform .3s ease, box-shadow .3s ease;
    width:100%;
  }
  .itinerary-card:hover {
    transform: translateY(-5px);
    box-shadow:0 10px 25px rgba(0,0,0,0.1);
  }
  .itinerary-card img { width:100%; height:auto; display:block; object-fit:cover; }
  .itinerary-content { padding:25px; }
  .itinerary-content h2 { color:#007bff; font-size:1.6rem; font-weight:600; }
  .itinerary-content p { color:#555; margin-top:10px; margin-bottom:15px; }
  .info { display:flex; flex-wrap:wrap; gap:15px; color:#6c757d; font-size:.9rem; }

  /* === INCLUSION / EXCLUSION SECTION (SAME AS PACKAGE SAMPLE) === */
  .inclusion-exclusion-section { background:#f1f8ff; }
  .inclusion-exclusion-section .section-title { color:#007bff; font-weight:700; margin-bottom:10px; }
  .inclusion-exclusion-section .section-title span { color:#ffc107; }
  .inclusion-exclusion-section .section-subtitle { color:#555; font-size:1.1rem; margin-bottom:30px; }

  .inclusion-box, .exclusion-box {
    border-radius:12px;
    box-shadow:0 4px 20px rgba(0,0,0,0.05);
    transition: transform .3s ease, box-shadow .3s ease;
    background:#fff;
  }
  .inclusion-box:hover, .exclusion-box:hover {
    transform: translateY(-5px);
    box-shadow:0 8px 25px rgba(0,0,0,0.1);
  }
  .inclusion-box { border-left:5px solid #28a745; }
  .exclusion-box { border-left:5px solid #dc3545; }
  .inclusion-box h3, .exclusion-box h3 { font-weight:600; margin-bottom:15px; }
  .inclusion-box ul, .exclusion-box ul { list-style:none; padding-left:0; margin:0; }
  .inclusion-box li, .exclusion-box li {
    position:relative;
    padding-left:28px;
    margin-bottom:10px;
    color:#555;
    font-size:1rem;
  }
  .inclusion-box li::before { content:"✔"; position:absolute; left:0; color:#28a745; font-weight:bold; }
  .exclusion-box li::before { content:"✖"; position:absolute; left:0; color:#dc3545; font-weight:bold; }

  /* === OPTIONAL ADD-ONS (SAME AS PACKAGE SAMPLE) === */
  .optional-addons-list { background: linear-gradient(135deg, #f9fbff 0%, #ffffff 100%); }
  .optional-addons-list .section-title { color:#007bff; font-weight:700; margin-bottom:10px; }
  .optional-addons-list .section-title span { color:#ffc107; }
  .optional-addons-list .section-subtitle { color:#555; font-size:1.05rem; max-width:650px; margin:0 auto 40px; }

  .addon-list { list-style:none; margin:0; padding:0; }
  .addon-list li {
    display:flex;
    align-items:flex-start;
    background:#fff;
    border-radius:10px;
    padding:18px 24px;
    margin-bottom:16px;
    box-shadow:0 4px 15px rgba(0,0,0,0.05);
    transition: all .3s ease;
  }
  .addon-list li:hover { transform: translateX(8px); box-shadow:0 8px 25px rgba(0,0,0,0.08); }
  .addon-list .arrow { font-size:1.4rem; color:#ffc107; margin-right:18px; line-height:1.2; flex-shrink:0; }
  .addon-list div p { color:#444; margin:0; line-height:1.6; font-size:.98rem; }

  /* === SPECIAL REQUIREMENTS (USE SAME SAMPLE LOOK) === */
  .special-req-section { background: linear-gradient(135deg, #f7fbff 0%, #ffffff 100%); }
  .special-req-section .section-title { color:#007bff; font-weight:700; margin-bottom:10px; }
  .special-req-section .section-title span { color:#ff7b00; }
  .special-req-section .section-subtitle { color:#555; font-size:1.05rem; max-width:650px; margin:0 auto 40px; }

  .req-item {
    background:#fff;
    border-radius:12px;
    padding:18px 25px;
    display:flex;
    align-items:center;
    justify-content:space-between;
    box-shadow:0 4px 20px rgba(0,0,0,0.05);
    transition: all .3s ease;
    margin-bottom:12px;
  }
  .req-item:hover { transform: translateY(-5px); box-shadow:0 8px 25px rgba(0,0,0,0.08); }
  .req-info p { margin:0; font-size:1rem; color:#333; font-weight:500; }
  .req-amount { font-size:1rem; color:#007bff; font-weight:600; white-space:nowrap; }

  /* === PAYMENT POLICIES (SAME AS SAMPLE) === */
  .payment-policies-box {
    background-color:#f9faff;
    border:2px solid #007bff;
    border-radius:12px;
    padding:0;
    overflow:hidden;
  }
  .box-title-wrapper { background-color:#007bff; padding:15px 20px; }
  .box-title { color:#fff; font-weight:700; font-size:1.5rem; margin:0; text-align:center; }
  .policies-list { list-style:none; padding:20px; margin:0; }
  .policies-list li {
    position:relative;
    padding-left:25px;
    margin-bottom:12px;
    color:#555;
    font-size:.95rem;
    line-height:1.5;
  }
  .policies-list li::before { content:'➤'; position:absolute; left:0; color:#007bff; font-size:1rem; top:0; }

  /* === TERMS / CANCELLATION (SAME AS SAMPLE CARD STYLE) === */
  .terms-card, .cancellation-card {
    background-color:#ffffff;
    border-radius:15px;
    box-shadow:0 6px 18px rgba(0,0,0,0.08);
    overflow:hidden;
    transition: transform .2s;
  }
  .terms-card:hover, .cancellation-card:hover { transform: translateY(-3px); }
  .terms-card-header {
    background-color:#007bff;
    color:#fff;
    font-weight:600;
    font-size:1.4rem;
    padding:18px 20px;
    text-align:center;
  }
  .cancellation-card-header {
    background-color:#28a745;
    color:#fff;
    font-weight:600;
    font-size:1.4rem;
    padding:18px 20px;
    text-align:center;
  }
  .terms-card-list, .cancellation-card-list { list-style:none; padding:20px; margin:0; }
  .terms-card-list li, .cancellation-card-list li {
    position:relative; padding-left:28px; margin-bottom:14px; font-size:.95rem; line-height:1.5; color:#333;
  }
  .terms-card-list li::before { content:'➔'; position:absolute; left:0; color:#007bff; font-size:1rem; top:0; }
  .cancellation-card-list li::before { content:'➔'; position:absolute; left:0; color:#28a745; font-size:1rem; top:0; }

  /* === NOTES (SAME AS SAMPLE) === */
  .notes-header-alt h2 {
    font-size:2rem;
    font-weight:700;
    color:#333;
    border-bottom:3px solid #ff6b6b;
    display:inline-block;
    padding-bottom:5px;
    margin-bottom:20px;
  }
  .notes-box-alt {
    background-color:#fff3e6;
    border-left:5px solid #ff6b6b;
    padding:20px 25px;
    border-radius:8px;
    box-shadow:0 2px 10px rgba(0,0,0,0.05);
  }
  .notes-box-alt ul { list-style:none; padding-left:0; margin:0; }
  .notes-box-alt ul li {
    position:relative;
    padding-left:20px;
    margin-bottom:12px;
    font-size:1rem;
    color:#444;
    line-height:1.5;
  }
  .notes-box-alt ul li::before {
    content:"→";
    position:absolute;
    left:0;
    color:#ff6b6b;
    font-weight:bold;
    top:0;
  }

  /* === QUOTATION OPTIONS (CLEAN DESIGN) === */
  .option-wrap { background:#f8f9fa; }
  .option-card {
    background:#fff;
    border-radius:12px;
    box-shadow:0 6px 18px rgba(0,0,0,0.06);
    overflow:hidden;
    margin-bottom:24px;
  }
  .option-category {
    background:#004aad;
    color:#fff;
    padding:12px 18px;
    font-weight:700;
    font-size:1.2rem;
  }
  .option-body { padding:18px; }
  .option-name {
    font-weight:800;
    font-size:1.4rem;
    color:#0d6efd;
    margin-bottom:8px;
  }
  .quote-total {
    display:inline-block;
    background:#ffc107;
    padding:10px 14px;
    border-radius:999px;
    font-weight:800;
    font-size:1.2rem;
    color:#000;
    margin-bottom:14px;
  }
  .prop-table th { background:#004aad; color:#fff; }
  .prop-name { font-weight:700; color:#004aad; }
  .room-chip {
    display:inline-block;
    background:#f1f6ff;
    border:1px solid #d6e5ff;
    color:#0d3d8a;
    padding:6px 10px;
    border-radius:999px;
    font-size:.9rem;
    margin:4px 6px 0 0;
  }
</style>
</head>

<body>

<!-- COVER (NO TEXT) -->
<section class="hero"></section>

<!-- ITINERARY (quotation itinerary days) -->
<?php if (!empty($itinerary)): ?>
<section class="itinerary-section" id="itinerary">
  <div class="container">
    <h1>Your Travel Itinerary</h1>

    <?php foreach ($itinerary as $day): ?>
      <div class="itinerary-card">
        <img src="https://images.unsplash.com/photo-1505761671935-60b3a7427bad" alt="itinerary">
        <div class="itinerary-content">
          <h2>
            Day <?php echo e(isset($day->quotation_itineraries_days_day) ? $day->quotation_itineraries_days_day : '-'); ?>
            – <?php echo e(isset($day->quotation_itineraries_days_title) ? $day->quotation_itineraries_days_title : '-'); ?>
          </h2>
          <p><?php echo nl2br(htmlspecialchars(isset($day->quotation_itineraries_days_description) ? $day->quotation_itineraries_days_description : '', ENT_QUOTES, 'UTF-8')); ?></p>
          <div class="info">
            <span>📍 <?php echo e(isset($day->state_name) ? $day->state_name : '-'); ?></span>
          </div>
        </div>
      </div>
    <?php endforeach; ?>

  </div>
</section>
<?php endif; ?>

<!-- INCLUSIONS & EXCLUSIONS (same as package sample) -->
<?php if (!empty($inclusions) || !empty($exclusions)): ?>
<section class="inclusion-exclusion-section py-5">
  <div class="container">
    <div class="text-center mb-5">
      <h1 class="section-title">Inclusions & <span>Exclusions</span></h1>
      <p class="section-subtitle">Here’s what’s covered in your travel package—and what’s not.</p>
    </div>

    <div class="row g-4">
      <?php if (!empty($inclusions)): ?>
      <div class="col-md-6">
        <div class="inclusion-box p-4 h-100">
          <h3>✅ Inclusions</h3>
          <ul>
            <?php foreach ($inclusions as $i): ?>
              <?php if (!empty($i->quotation_inclusions_details)): ?>
                <li><?php echo nl2br(htmlspecialchars($i->quotation_inclusions_details, ENT_QUOTES, 'UTF-8')); ?></li>
              <?php endif; ?>
            <?php endforeach; ?>
          </ul>
        </div>
      </div>
      <?php endif; ?>

      <?php if (!empty($exclusions)): ?>
      <div class="col-md-6">
        <div class="exclusion-box p-4 h-100">
          <h3>❌ Exclusions</h3>
          <ul>
            <?php foreach ($exclusions as $e): ?>
              <?php if (!empty($e->quotation_exclusions_details)): ?>
                <li><?php echo nl2br(htmlspecialchars($e->quotation_exclusions_details, ENT_QUOTES, 'UTF-8')); ?></li>
              <?php endif; ?>
            <?php endforeach; ?>
          </ul>
        </div>
      </div>
      <?php endif; ?>
    </div>

  </div>
</section>
<?php endif; ?>

<!-- OPTIONAL ADD-ONS (same as package sample) -->
<?php if (!empty($optional_addons)): ?>
<section class="optional-addons-list py-5">
  <div class="container">
    <div class="text-center mb-5">
      <h1 class="section-title">✨ Optional <span>Add-Ons</span></h1>
      <p class="section-subtitle">Enhance your travel experience with premium upgrades and exclusive activities.</p>
    </div>

    <div class="row justify-content-center">
      <div class="col-lg-8">
        <ul class="addon-list">
          <?php foreach ($optional_addons as $o): ?>
            <?php if (!empty($o->quotation_optional_add_on_details)): ?>
              <li>
                <span class="arrow">➤</span>
                <div><p><?php echo nl2br(htmlspecialchars($o->quotation_optional_add_on_details, ENT_QUOTES, 'UTF-8')); ?></p></div>
              </li>
            <?php endif; ?>
          <?php endforeach; ?>
        </ul>
      </div>
    </div>
  </div>
</section>
<?php endif; ?>

<!-- QUOTATION OPTIONS (new requested layout) -->
<?php if (!empty($options)): ?>
<section class="option-wrap py-5">
  <div class="container">
    <div class="text-center mb-4">
      <h1 class="section-title">Property Details</h1>
      <p class="section-subtitle">Option wise property & room details.</p>
    </div>

    <?php foreach ($options as $opt): ?>
      <div class="option-card">
        <!-- Category separate -->
        <div class="option-category">
          <?php echo e(isset($opt->packages_properties_common_category_name) ? $opt->packages_properties_common_category_name : 'Category'); ?>
        </div>

        <div class="option-body">
          <!-- Option name above quote total -->
          <div class="option-name">
            <?php echo e(isset($opt->quotation_options_title) ? $opt->quotation_options_title : 'Option'); ?>
          </div>

          <!-- Quote total big + highlight -->
          <div class="quote-total">
            Quote Total: ₹ <?php echo nf(isset($opt->quotation_options_total_quote_rate) ? $opt->quotation_options_total_quote_rate : 0); ?>
          </div>

          <?php if (!empty($opt->days)): ?>
            <?php foreach ($opt->days as $day): ?>
              <div class="mt-4">
                <h5 class="text-secondary mb-2">
                  Day <?php echo e(isset($day->quotation_properties_days_day) ? $day->quotation_properties_days_day : '-'); ?>
                  <small class="text-muted"> · <?php echo e(isset($day->state_name) ? $day->state_name : '-'); ?></small>
                </h5>

                <div class="table-responsive">
                  <table class="table table-bordered align-middle bg-white prop-table">
                    <thead>
                      <tr>
                        <th style="width:40%">Property</th>
                        <th style="width:60%">Rooms</th>
                      </tr>
                    </thead>
                    <tbody>
                      <?php if (!empty($day->properties)): ?>
                        <?php foreach ($day->properties as $prop): ?>
                          <tr>
                            <td class="prop-name"><?php echo e(isset($prop->properties_name) ? $prop->properties_name : '-'); ?></td>
                            <td>
                              <?php if (!empty($prop->rooms)): ?>
                                <?php foreach ($prop->rooms as $r): ?>
                                  <span class="room-chip"><?php echo e(isset($r->properties_room_category_name) ? $r->properties_room_category_name : '-'); ?></span>
                                <?php endforeach; ?>
                              <?php else: ?>
                                <span class="text-muted">No rooms</span>
                              <?php endif; ?>
                            </td>
                          </tr>
                        <?php endforeach; ?>
                      <?php else: ?>
                        <tr><td colspan="2" class="text-muted">No properties</td></tr>
                      <?php endif; ?>
                    </tbody>
                  </table>
                </div>
              </div>
            <?php endforeach; ?>
          <?php else: ?>
            <div class="text-muted">No days found for this option.</div>
          <?php endif; ?>
        </div>
      </div>
    <?php endforeach; ?>

  </div>
</section>
<?php endif; ?>

<!-- SPECIAL REQUIREMENTS (same as package sample design) -->
<?php if (!empty($special_req)): ?>
<section class="special-req-section py-5">
  <div class="container">
    <div class="text-center mb-5">
      <h1 class="section-title">📝 Special <span>Requirements</span></h1>
      <p class="section-subtitle">Customize your trip with additional services designed for your comfort and convenience.</p>
    </div>

    <div class="row g-4 justify-content-center">
      <div class="col-md-6 col-sm-12">
        <?php foreach ($special_req as $s): ?>
          <div class="req-item">
            <div class="req-info">
              <p class="req-name"><?php echo e(isset($s->special_requirements_name) ? $s->special_requirements_name : '-'); ?></p>
            </div>
            <div class="req-amount"><?php echo nf(isset($s->quotation_special_requirements_cost) ? $s->quotation_special_requirements_cost : 0); ?></div>
          </div>
        <?php endforeach; ?>
      </div>
    </div>
  </div>
</section>
<?php endif; ?>

<!-- PAYMENT POLICIES (same as sample) -->
<?php if (!empty($payment)): ?>
<section class="payment-policies-section py-4">
  <div class="container">
    <div class="payment-policies-box">
      <div class="box-title-wrapper">
        <h1 class="box-title">Payment Policies</h1>
      </div>
      <ul class="policies-list">
        <?php foreach ($payment as $p): ?>
          <?php if (!empty($p->quotation_payment_policies_details)): ?>
            <li><?php echo nl2br(htmlspecialchars($p->quotation_payment_policies_details, ENT_QUOTES, 'UTF-8')); ?></li>
          <?php endif; ?>
        <?php endforeach; ?>
      </ul>
    </div>
  </div>
</section>
<?php endif; ?>

<!-- TERMS & CONDITIONS (same as sample) -->
<?php if (!empty($terms)): ?>
<section class="terms-card-section py-4">
  <div class="container">
    <div class="terms-card">
      <div class="terms-card-header">Terms & Conditions</div>
      <ul class="terms-card-list">
        <?php foreach ($terms as $t): ?>
          <?php if (!empty($t->quotation_terms_condition_details)): ?>
            <li><?php echo nl2br(htmlspecialchars($t->quotation_terms_condition_details, ENT_QUOTES, 'UTF-8')); ?></li>
          <?php endif; ?>
        <?php endforeach; ?>
      </ul>
    </div>
  </div>
</section>
<?php endif; ?>

<!-- CANCELLATION POLICY (same as sample) -->
<?php if (!empty($cancel)): ?>
<section class="cancellation-card-section py-4">
  <div class="container">
    <div class="cancellation-card">
      <div class="cancellation-card-header">Cancellation Policy</div>
      <ul class="cancellation-card-list">
        <?php foreach ($cancel as $c): ?>
          <?php if (!empty($c->quotation_cancellation_policies_details)): ?>
            <li><?php echo nl2br(htmlspecialchars($c->quotation_cancellation_policies_details, ENT_QUOTES, 'UTF-8')); ?></li>
          <?php endif; ?>
        <?php endforeach; ?>
      </ul>
    </div>
  </div>
</section>
<?php endif; ?>

<!-- NOTES (same as sample) -->
<?php if (!empty($notes)): ?>
<section class="notes-section-alt py-5">
  <div class="container">
    <div class="notes-header-alt">
      <h2>Notes</h2>
    </div>
    <div class="notes-box-alt">
      <ul>
        <?php foreach ($notes as $nn): ?>
          <?php if (!empty($nn->quotation_notes_details)): ?>
            <li><?php echo nl2br(htmlspecialchars($nn->quotation_notes_details, ENT_QUOTES, 'UTF-8')); ?></li>
          <?php endif; ?>
        <?php endforeach; ?>
      </ul>
    </div>
  </div>
</section>
<?php endif; ?>

<script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.3/dist/js/bootstrap.bundle.min.js"></script>
</body>
</html>
