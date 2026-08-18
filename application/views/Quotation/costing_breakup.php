<!DOCTYPE html>
<html lang="en">
<head>
<meta charset="UTF-8">
<title>Quotation Details - <?php echo htmlspecialchars($quotation->quotation_number); ?></title>
<link href="https://fonts.googleapis.com/css2?family=Poppins:wght@300;400;500;600;700&display=swap" rel="stylesheet">
<link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.4.0/css/all.min.css">
<style>
:root{--brand:#4a3ee0;--brand-light:#5a4ff0;--text:#111827;--muted:#6b7280;--line:#e5e7eb;--soft:#f8fafc;--green:#2e7d32;}
*{box-sizing:border-box;margin:0;padding:0;}
body{font-family:'Poppins',sans-serif;background:#f1f5f9;color:var(--text);-webkit-print-color-adjust:exact;print-color-adjust:exact;}
.btn-area{position:fixed;bottom:20px;right:20px;z-index:9999;display:flex;gap:10px;}
.btn-area button{padding:10px 24px;border:none;background:var(--brand);color:#fff;border-radius:6px;cursor:pointer;font-size:14px;font-weight:600;}
.btn-area button:hover{opacity:.9;}
.container{max-width:1100px;margin:20px auto;padding:0 10px;}
.top-bar{background:#fff;border-radius:8px;margin-bottom:16px;box-shadow:0 1px 3px rgba(0,0,0,.08);overflow:hidden;}
.top-bar-header{background:linear-gradient(135deg,var(--brand),var(--brand-light));color:#fff;padding:16px 22px;display:flex;justify-content:space-between;align-items:center;flex-wrap:wrap;gap:10px;}
.top-bar-header h2{font-size:20px;margin:0;}
.top-bar-header .header-meta{font-size:13px;opacity:.9;display:flex;gap:20px;flex-wrap:wrap;}
.detail-grid{display:grid;grid-template-columns:repeat(auto-fill,minmax(200px,1fr));gap:0;}
.detail-item{padding:12px 22px;border-bottom:1px solid var(--line);border-right:1px solid var(--line);}
.detail-item label{display:block;font-size:11px;color:var(--muted);text-transform:uppercase;letter-spacing:.5px;margin-bottom:3px;font-weight:500;}
.detail-item .d-val{display:block;font-size:14px;font-weight:600;color:var(--text);}
.detail-item .d-val.status-badge{display:inline-block;padding:.5em 1.2em;font-size:75%;font-weight:700;line-height:1;text-align:center;white-space:nowrap;vertical-align:baseline;border-radius:50rem;}
.badge-secondary{color:#fff;background-color:#6c757d;}
.badge-light{color:#212529;background-color:#f8f9fa;}
.badge-info{color:#fff;background-color:#17a2b8;}
.badge-danger{color:#fff;background-color:#dc3545;}
.badge-success{color:#fff;background-color:#28a745;}
.badge-primary{color:#fff;background-color:#007bff;}
.badge-warning{color:#212529;background-color:#ffc107;}
.option-block{margin-bottom:24px;}
.option-header{background:linear-gradient(135deg,var(--brand),var(--brand-light));color:#fff;padding:14px 22px;border-radius:8px 8px 0 0;font-size:17px;font-weight:700;display:flex;justify-content:space-between;align-items:center;cursor:pointer;user-select:none;}
.option-header.confirmed{background:linear-gradient(135deg,#2e7d32,#388e3c);}
.option-header .confirmed-tag{display:inline-flex;align-items:center;gap:4px;background:rgba(255,255,255,.2);padding:3px 10px;border-radius:4px;font-size:12px;font-weight:600;margin-left:8px;}
.option-header .collapse-icon{transition:transform .3s;font-size:18px;}
.option-header .collapse-icon.collapsed{transform:rotate(-90deg);}
.option-body{background:#fff;border-radius:0 0 8px 8px;overflow:hidden;box-shadow:0 1px 3px rgba(0,0,0,.08);}
table{width:100%;border-collapse:collapse;font-size:14px;}
table th{background:#eef2ff;padding:10px 12px;text-align:left;font-weight:600;color:var(--brand);border-bottom:2px solid var(--line);white-space:nowrap;font-size:12px;text-transform:uppercase;letter-spacing:.3px;}
table td{padding:10px 12px;border-bottom:1px solid var(--line);vertical-align:top;}
.day-info{background:#f0f4ff;font-weight:600;color:var(--brand);width:150px;vertical-align:top;border-right:1px solid var(--line);}
.day-info .day-label{font-size:15px;font-weight:700;margin-bottom:3px;}
.day-info .day-date{font-size:12px;color:var(--muted);margin-bottom:2px;}
.day-info .day-dest{font-size:12px;color:var(--muted);}
.property-header-cell{background:#eef2ff;font-weight:700;color:var(--brand);font-size:14px;padding:10px 12px;}
.property-name{font-weight:600;font-size:14px;}
.meal-badge{display:inline-block;background:#dbeafe;color:#1e40af;padding:2px 8px;border-radius:4px;font-size:11px;font-weight:600;margin-left:6px;}
.meal-badge i{font-size:11px;margin-right:2px;}
.room-row{border-bottom:1px solid #f3f4f6;}
.room-row:last-child{border-bottom:none;}
.room-name{font-size:13px;font-weight:500;}
.pax-icons{display:inline-flex;gap:3px;margin-left:6px;vertical-align:middle;}
.pax-icons .pax{font-size:12px;color:var(--muted);margin-right:4px;}
.pax-icons .pax i{font-size:11px;margin-right:1px;}
.rate-cell{font-size:13px;white-space:nowrap;}
.rate-val{color:var(--text);}
.rate-zero{color:#9ca3af;}
.fac-note{font-size:10px;color:var(--muted);}
.inclusions-section{padding:14px 22px;background:#f0f4ff;border-top:1px solid var(--line);}
.inclusions-title{font-size:14px;font-weight:700;color:var(--brand);margin-bottom:10px;}
.inclusions-title i{margin-right:4px;font-size:14px;}
.inc-table td{font-size:13px;padding:8px 12px;}
.inc-table th{font-size:11px;padding:8px 12px;}
.special-section{padding:14px 22px;background:#f0f4ff;border-top:1px solid var(--line);}
.special-title{font-size:14px;font-weight:700;color:var(--brand);margin-bottom:10px;}
.special-title i{margin-right:4px;font-size:14px;}
.summary-cards{display:flex;gap:12px;padding:16px 22px;background:#eef2ff;border-top:2px solid var(--brand);flex-wrap:wrap;}
.summary-card{flex:1;min-width:140px;background:#fff;border-radius:8px;padding:14px 16px;text-align:center;box-shadow:0 1px 3px rgba(0,0,0,.08);}
.summary-card .sc-label{font-size:11px;text-transform:uppercase;letter-spacing:.5px;color:var(--muted);margin-bottom:6px;}
.summary-card .sc-value{font-size:18px;font-weight:700;}
.summary-card .sc-value.cab{color:#0ea5e9;}
.summary-card .sc-value.inc{color:#10b981;}
.summary-card .sc-value.spl{color:#f59e0b;}
.summary-card .sc-value.cost{color:#64748b;}
.summary-card .sc-value.margin{color:#8b5cf6;}
.summary-card .sc-value.quote{color:var(--brand);}
.summary-card.grand{background:linear-gradient(135deg,#2e7d32,#388e3c);border:none;}
.summary-card.grand .sc-label{color:rgba(255,255,255,.8);}
.summary-card.grand .sc-value{color:#fff;font-size:20px;}
.no-data{padding:20px;text-align:center;color:var(--muted);font-size:14px;}
@media print{.btn-area{display:none;}.container{max-width:100%;margin:0;padding:0;}.option-body{display:block !important;}}
</style>
</head>
<body>
<div class="btn-area">
  <button onclick="window.print()"><i class="fas fa-print"></i> Print</button>
  <button onclick="window.close()"><i class="fas fa-times"></i> Close</button>
</div>
<div class="container">

  <?php
  $statusMap=array(1=>'Generated',2=>'Draft',3=>'Sent',4=>'Rejected',5=>'Confirmed',6=>'Cancelled',7=>'Ready to Trip',8=>'Reservation Completed',9=>'Driver Not Assigned',10=>'Trip Completed');
  $statusText=isset($statusMap[$quotation->quotation_current_status]) ? $statusMap[$quotation->quotation_current_status] : 'Unknown';
  $statusBadgeClass=array(1=>'badge-secondary',2=>'badge-light',3=>'badge-info',4=>'badge-danger',5=>'badge-success',6=>'badge-danger',7=>'badge-primary',8=>'badge-info',9=>'badge-warning',10=>'badge-success');
  $badgeClass=isset($statusBadgeClass[$quotation->quotation_current_status]) ? $statusBadgeClass[$quotation->quotation_current_status] : 'badge-secondary';
  ?>
  <div class="top-bar">
    <div class="top-bar-header">
      <h2><i class="fas fa-file-invoice-dollar"></i> Quotation Details</h2>
      <div class="header-meta">
        <span><i class="fas fa-hashtag"></i> <?php echo htmlspecialchars($quotation->quotation_number); ?></span>
        <span><i class="fas fa-user"></i> <?php echo htmlspecialchars(isset($quotation->guest_name) ? $quotation->guest_name : '-'); ?></span>
      </div>
    </div>
    <div class="detail-grid">
      <div class="detail-item">
        <label>Quotation No</label>
        <span class="d-val"><?php echo htmlspecialchars($quotation->quotation_number); ?></span>
      </div>
      <div class="detail-item">
        <label>Quotation Date</label>
        <span class="d-val"><?php echo !empty($quotation->quotation_date) && $quotation->quotation_date != '0000-00-00' ? date('d M Y', strtotime($quotation->quotation_date)) : '-'; ?></span>
      </div>
      <div class="detail-item">
        <label>Quotation Title</label>
        <span class="d-val"><?php echo htmlspecialchars(isset($quotation->quotation_title) ? $quotation->quotation_title : '-'); ?></span>
      </div>
      <div class="detail-item">
        <label>Guest Name</label>
        <span class="d-val"><?php echo htmlspecialchars(isset($quotation->guest_name) ? $quotation->guest_name : '-'); ?></span>
      </div>
      <div class="detail-item">
        <label>Lead No</label>
        <span class="d-val"><?php echo htmlspecialchars(isset($quotation->leads_number) ? $quotation->leads_number : '-'); ?></span>
      </div>
      <div class="detail-item">
        <label>Phone</label>
        <span class="d-val"><?php echo htmlspecialchars(isset($quotation->whats_number) ? $quotation->whats_number : '-'); ?></span>
      </div>
      <div class="detail-item">
        <label>Arriving</label>
        <span class="d-val"><?php echo htmlspecialchars(isset($quotation->arriving_destination) ? $quotation->arriving_destination : '-'); ?></span>
      </div>
      <div class="detail-item">
        <label>Departing</label>
        <span class="d-val"><?php echo htmlspecialchars(isset($quotation->departuring_destination) ? $quotation->departuring_destination : '-'); ?></span>
      </div>
      <div class="detail-item">
        <label>Travel Dates</label>
        <span class="d-val">
          <?php
          if(!empty($quotation->start_date)&&!empty($quotation->end_date)){
            echo date('d M Y',strtotime($quotation->start_date)).' - '.date('d M Y',strtotime($quotation->end_date));
          }else{echo '-';}
          ?>
        </span>
      </div>
      <div class="detail-item">
        <label>Status</label>
        <span class="d-val"><span class="status-badge <?php echo $badgeClass; ?>"><?php echo $statusText; ?></span>
          <?php if(!empty($quotation->confirmed_option_title)): ?>
            <div style="margin-top:6px;font-size:13px;color:var(--green);font-weight:600;"><i class="fas fa-check-circle"></i> Confirmed Option: <?php echo htmlspecialchars($quotation->confirmed_option_title); ?></div>
          <?php endif; ?>
        </span>
      </div>
      <div class="detail-item">
        <label>Created By</label>
        <span class="d-val"><?php echo htmlspecialchars(isset($quotation->admin_name) ? $quotation->admin_name : '-'); ?></span>
      </div>
      <div class="detail-item">
        <label>Created At</label>
        <span class="d-val"><?php echo !empty($quotation->quotation_created_at) ? date('d M Y, h:i A', strtotime($quotation->quotation_created_at)) : '-'; ?></span>
      </div>
      <?php if(!empty($quotation->quotation_remarks)): ?>
      <div class="detail-item" style="grid-column:1/-1;">
        <label>Remarks</label>
        <span class="d-val" style="font-weight:400;font-size:13px;"><?php echo htmlspecialchars($quotation->quotation_remarks); ?></span>
      </div>
      <?php endif; ?>
    </div>
  </div>

  <?php foreach($options as $optIdx=>$option): ?>
  <?php $isConfirmed = !empty($quotation->confirmed_option_id) && $quotation->confirmed_option_id == $option->quotation_options_id; ?>
  <div class="option-block">
    <div class="option-header<?php echo $isConfirmed ? ' confirmed' : ''; ?>" onclick="toggleOption(this)">
      <span>
        Option: <?php echo ($optIdx+1); ?>
        <?php if(!empty($option->quotation_options_title)): ?>
          &mdash; <?php echo htmlspecialchars($option->quotation_options_title); ?>
        <?php endif; ?>
        <?php if($isConfirmed): ?>
          <span class="confirmed-tag"><i class="fas fa-check-circle"></i> Confirmed</span>
        <?php endif; ?>
      </span>
      <i class="fas fa-chevron-down collapse-icon"></i>
    </div>
    <div class="option-body">
      <?php if(empty($option->days)): ?>
        <div class="no-data">No day-wise data available for this option.</div>
      <?php else: ?>

      <table>
        <thead>
          <tr>
            <th style="width:150px;">Day</th>
            <th>Property</th>
            <th>Room Category</th>
            <th>Room</th>
            <th>EBA</th>
            <th>CWB</th>
            <th>CNB</th>
            <th>SGL</th>
            <th>Supp Cost</th>
            <th style="text-align:right;">Total</th>
          </tr>
        </thead>
        <tbody>
        <?php foreach($option->days as $day): ?>
          <?php
          $dayRowSpan = 0;
          foreach($day->properties as $prop){
            $roomCount = count($prop->rooms);
            $dayRowSpan += max(1, $roomCount);
          }
          if($dayRowSpan === 0) $dayRowSpan = 1;
          $firstProp = true;
          ?>
          <?php foreach($day->properties as $propIdx=>$prop): ?>
            <?php
            $propRooms = $prop->rooms;
            $propRoomCount = count($propRooms);
            if($propRoomCount === 0) $propRoomCount = 1;
            $firstRoom = true;
            $propDisplayName = htmlspecialchars(isset($prop->properties_name) ? $prop->properties_name : 'Unknown');
            $propCatName = htmlspecialchars(isset($prop->property_category_name) ? $prop->property_category_name : '');
            if($propCatName) $propDisplayName .= ' (' . $propCatName . ')';
            ?>
            <?php if(!empty($propRooms)): ?>
              <?php foreach($propRooms as $roomIdx=>$room): ?>
              <tr class="room-row">
                <?php if($firstProp && $firstRoom): ?>
                <td rowspan="<?php echo $dayRowSpan; ?>" class="day-info">
                  <div class="day-label"><?php echo htmlspecialchars($day->quotation_properties_days_day); ?></div>
                  <?php if(!empty($day->accommodation_date) && $day->accommodation_date != '0000-00-00'): ?>
                    <div class="day-date"><?php echo date('D, d M Y', strtotime($day->accommodation_date)); ?></div>
                  <?php endif; ?>
                  <?php if(!empty($day->state_name)): ?>
                    <div class="day-dest"><?php echo htmlspecialchars($day->state_name); ?></div>
                  <?php endif; ?>
                </td>
                <?php endif; ?>
                <?php if($firstRoom): ?>
                <td class="property-header-cell" rowspan="<?php echo $propRoomCount; ?>">
                  <div class="property-name"><?php echo $propDisplayName; ?></div>
                  <?php if(!empty($day->meal_plan_name)): ?>
                    <span class="meal-badge"><i class="fas fa-utensils"></i> <?php echo htmlspecialchars($day->meal_plan_name); ?></span>
                  <?php endif; ?>
                </td>
                <?php endif; ?>
                <td>
                  <span class="room-name"><?php echo htmlspecialchars(isset($room->properties_room_category_name) ? $room->properties_room_category_name : '-'); ?></span>
                  <span class="pax-icons">
                    <?php
                    $adultCount = (int)(isset($room->pax_wise_bed_adult_db_count) ? $room->pax_wise_bed_adult_db_count : 0)
                                + (int)(isset($room->pax_wise_bed_adult_eb_count) ? $room->pax_wise_bed_adult_eb_count : 0)
                                + (int)(isset($room->pax_wise_bed_adult_sgl_count) ? $room->pax_wise_bed_adult_sgl_count : 0);
                    $childCount = (int)(isset($room->pax_wise_bed_child_db_count) ? $room->pax_wise_bed_child_db_count : 0)
                                + (int)(isset($room->pax_wise_bed_child_eb_count) ? $room->pax_wise_bed_child_eb_count : 0)
                                + (int)(isset($room->pax_wise_bed_child_sb_count) ? $room->pax_wise_bed_child_sb_count : 0);
                    $babyCount = (int)(isset($room->pax_wise_bed_baby_db_count) ? $room->pax_wise_bed_baby_db_count : 0)
                               + (int)(isset($room->pax_wise_bed_baby_eb_count) ? $room->pax_wise_bed_baby_eb_count : 0)
                               + (int)(isset($room->pax_wise_bed_baby_sb_count) ? $room->pax_wise_bed_baby_sb_count : 0);
                    ?>
                    <?php if($adultCount > 0): ?><span class="pax"><i class="fas fa-male"></i><?php echo $adultCount; ?></span><?php endif; ?>
                    <?php if($childCount > 0): ?><span class="pax"><i class="fas fa-child"></i><?php echo $childCount; ?></span><?php endif; ?>
                    <?php if($babyCount > 0): ?><span class="pax"><i class="fas fa-baby"></i><?php echo $babyCount; ?></span><?php endif; ?>
                  </span>
                </td>
                <td>
                  <?php
                  $roomCount = (int)(isset($room->room_unit_manual_count) ? $room->room_unit_manual_count : 0);
                  $roomRate = (float)(isset($room->room_unit_manual_rate) ? $room->room_unit_manual_rate : 0);
                  if($roomCount > 0 && $roomRate > 0){
                    echo '<span class="rate-cell rate-val">' . $roomCount . ' X ' . number_format($roomRate, 0) . '</span>';
                  } else {
                    echo '<span class="rate-cell rate-zero">0</span>';
                  }
                  ?>
                </td>
                <td>
                  <?php
                  $ebaCount = (int)(isset($room->extra_bed_adult_manual_count) ? $room->extra_bed_adult_manual_count : 0);
                  $ebaRate = (float)(isset($room->extra_bed_adult_manual_rate) ? $room->extra_bed_adult_manual_rate : 0);
                  if($ebaCount > 0 && $ebaRate > 0){
                    echo '<span class="rate-cell rate-val">' . $ebaCount . ' X ' . number_format($ebaRate, 0) . '</span>';
                  } else {
                    echo '<span class="rate-cell rate-zero">0</span>';
                  }
                  ?>
                </td>
                <td>
                  <?php
                  $cwbCount = (int)(isset($room->extra_bed_child_manual_count) ? $room->extra_bed_child_manual_count : 0);
                  $cwbRate = (float)(isset($room->extra_bed_child_manual_rate) ? $room->extra_bed_child_manual_rate : 0);
                  if($cwbCount > 0 && $cwbRate > 0){
                    echo '<span class="rate-cell rate-val">' . $cwbCount . ' X ' . number_format($cwbRate, 0) . '</span>';
                    echo '<br><span class="fac-note">*/fac</span>';
                  } else {
                    echo '<span class="rate-cell rate-zero">0</span>';
                  }
                  ?>
                </td>
                <td>
                  <?php
                  $cnbCount = (int)(isset($room->child_sharing_bed_manual_count) ? $room->child_sharing_bed_manual_count : 0);
                  $cnbRate = (float)(isset($room->child_sharing_bed_manual_rate) ? $room->child_sharing_bed_manual_rate : 0);
                  if($cnbCount > 0 && $cnbRate > 0){
                    echo '<span class="rate-cell rate-val">' . $cnbCount . ' X ' . number_format($cnbRate, 0) . '</span>';
                    echo '<br><span class="fac-note">*/fac</span>';
                  } else {
                    echo '<span class="rate-cell rate-zero">0</span>';
                  }
                  ?>
                </td>
                <td>
                  <?php
                  $sglCount = (int)(isset($room->single_occupancy_manual_count) ? $room->single_occupancy_manual_count : 0);
                  $sglRate = (float)(isset($room->single_occupancy_manual_rate) ? $room->single_occupancy_manual_rate : 0);
                  if($sglCount > 0 && $sglRate > 0){
                    echo '<span class="rate-cell rate-val">' . $sglCount . ' X ' . number_format($sglRate, 0) . '</span>';
                  } else {
                    echo '<span class="rate-cell rate-zero">0</span>';
                  }
                  ?>
                </td>
                <td>
                  <?php
                  $suppCost = (float)(isset($room->supplyment_manual_cost) ? $room->supplyment_manual_cost : 0);
                  if($suppCost > 0){
                    echo '<span class="rate-cell rate-val">' . number_format($suppCost, 0) . '</span>';
                  } else {
                    echo '<span class="rate-cell rate-zero">0</span>';
                  }
                  ?>
                </td>
                <td style="text-align:right;">
                  <span class="rate-cell rate-val" style="font-weight:700;font-size:14px;"><?php echo number_format((float)(isset($room->manual_total_rate) ? $room->manual_total_rate : 0), 2); ?></span>
                </td>
              </tr>
              <?php $firstRoom = false; $firstProp = false; ?>
              <?php endforeach; ?>
            <?php else: ?>
              <tr>
                <?php if($firstProp): ?>
                <td rowspan="<?php echo $dayRowSpan; ?>" class="day-info">
                  <div class="day-label"><?php echo htmlspecialchars($day->quotation_properties_days_day); ?></div>
                  <?php if(!empty($day->accommodation_date) && $day->accommodation_date != '0000-00-00'): ?>
                    <div class="day-date"><?php echo date('D, d M Y', strtotime($day->accommodation_date)); ?></div>
                  <?php endif; ?>
                  <?php if(!empty($day->state_name)): ?>
                    <div class="day-dest"><?php echo htmlspecialchars($day->state_name); ?></div>
                  <?php endif; ?>
                </td>
                <?php endif; ?>
                <td class="property-header-cell"><?php echo $propDisplayName; ?></td>
                <td colspan="7" class="rate-zero">No rooms assigned</td>
              </tr>
              <?php $firstProp = false; ?>
            <?php endif; ?>
          <?php endforeach; ?>
        <?php endforeach; ?>
        </tbody>
      </table>
      <?php endif; ?>

      <?php if(!empty($option->inclusions)): ?>
      <div class="inclusions-section">
        <div class="inclusions-title"><i class="fas fa-list-check"></i> Hotel Inclusions</div>
        <table class="inc-table">
          <thead>
            <tr>
              <th>Date</th>
              <th>Property Name</th>
              <th>Inclusion Type</th>
              <th style="text-align:right;">Amount</th>
            </tr>
          </thead>
          <tbody>
            <?php foreach($option->inclusions as $inc): ?>
            <tr>
              <td><?php echo !empty($inc->accommodation_date) && $inc->accommodation_date != '0000-00-00' ? date('D, d M Y', strtotime($inc->accommodation_date)) : '-'; ?></td>
              <td>
                <?php
                $incPropName = htmlspecialchars(isset($inc->inc_property_name) ? $inc->inc_property_name : '-');
                $incCatName = htmlspecialchars(isset($inc->inc_category_name) ? $inc->inc_category_name : '');
                if($incCatName) $incPropName .= ' (' . $incCatName . ')';
                echo $incPropName;
                ?>
              </td>
              <td><?php echo htmlspecialchars(isset($inc->inclusion_name) ? $inc->inclusion_name : '-'); ?></td>
              <td style="text-align:right;font-weight:600;"><?php echo number_format((float)$inc->inclusion_amount, 2); ?></td>
            </tr>
            <?php endforeach; ?>
          </tbody>
        </table>
      </div>
      <?php endif; ?>

      <?php if(!empty($option->special_requirements)): ?>
      <div class="special-section">
        <div class="special-title"><i class="fas fa-star"></i> Special Requirements</div>
        <table class="inc-table">
          <thead>
            <tr>
              <th>Date</th>
              <th>Requirement</th>
              <th style="text-align:right;">Amount</th>
            </tr>
          </thead>
          <tbody>
            <?php foreach($option->special_requirements as $sr): ?>
            <tr>
              <td><?php echo !empty($sr->accommodation_date) && $sr->accommodation_date != '0000-00-00' ? date('D, d M Y', strtotime($sr->accommodation_date)) : '-'; ?></td>
              <td><?php echo htmlspecialchars(isset($sr->quotation_special_requirements_name) ? $sr->quotation_special_requirements_name : '-'); ?></td>
              <td style="text-align:right;font-weight:600;"><?php echo number_format((float)$sr->quotation_special_requirements_cost, 2); ?></td>
            </tr>
            <?php endforeach; ?>
          </tbody>
        </table>
      </div>
      <?php endif; ?>

      <div class="summary-cards">
        <div class="summary-card">
          <div class="sc-label">Transport</div>
          <div class="sc-value cab">₹<?php echo number_format($option->cab_amount, 2); ?></div>
        </div>
        <div class="summary-card">
          <div class="sc-label">Inclusions</div>
          <div class="sc-value inc">₹<?php echo number_format($option->inclusion_total, 2); ?></div>
        </div>
        <div class="summary-card">
          <div class="sc-label">Special Req.</div>
          <div class="sc-value spl">₹<?php echo number_format($option->special_total, 2); ?></div>
        </div>
        <div class="summary-card">
          <div class="sc-label">Total Cost</div>
          <div class="sc-value cost">₹<?php echo number_format($option->total_cost, 2); ?></div>
        </div>
        <div class="summary-card">
          <div class="sc-label">Margin</div>
          <div class="sc-value margin">₹<?php echo number_format($option->margin_value, 2); ?></div>
        </div>
        <div class="summary-card">
          <div class="sc-label">Quote Rate</div>
          <div class="sc-value quote">₹<?php echo number_format($option->quote_rate, 2); ?></div>
        </div>
        <div class="summary-card grand">
          <div class="sc-label">Grand Total</div>
          <div class="sc-value">₹<?php echo number_format($option->grand_total, 2); ?></div>
        </div>
      </div>

    </div>
  </div>
  <?php endforeach; ?>

</div>

<script>
function toggleOption(header){
  var body = header.nextElementSibling;
  var icon = header.querySelector('.collapse-icon');
  if(body.style.display === 'none'){
    body.style.display = '';
    icon.classList.remove('collapsed');
  } else {
    body.style.display = 'none';
    icon.classList.add('collapsed');
  }
}
</script>
</body>
</html>
