////*** Trip details modal ***////

function tdEsc(v) {
    if (v === null || v === undefined || v === '') return '';
    return $('<div>').text(v).html();
}

function tdVal(v) {
    var s = tdEsc(v);
    return s === '' ? '-' : s;
}

function tdDate(ymd) {
    if (!ymd) return '-';
    var m = String(ymd).match(/^(\d{4})-(\d{2})-(\d{2})/);
    if (!m) return tdEsc(ymd);
    return m[3] + '-' + m[2] + '-' + m[1];
}

function tdMoney(n) {
    var v = parseFloat(n || 0);
    if (isNaN(v)) v = 0;
    return '₹' + v.toFixed(2);
}

function tdRow(label, value) {
    return '<div class="td-row"><span class="td-label">' + label +
           '</span><span class="td-value">' + value + '</span></div>';
}

function tdCard(title, body, cls) {
    cls = cls || '';
    return '<div class="td-card"><div class="td-card-head ' + cls + '">' + title +
           '</div><div class="td-card-body">' + body + '</div></div>';
}

function tdMealPlan(r) {
    var ap = r.applied_plan || {};
    return ap.meal_plan_name || ap.room_meal_plan_name || r.meal_plan_name || '';
}

function buildTripDetails(d) {
    var m = d.main || {};
    var nights = parseInt(m.total_nights, 10);
    if (isNaN(nights) || nights < 0) nights = parseInt(m.duration, 10) || 0;
    var days = nights + 1;

    var html = '';

    // Header
    html += '<div class="mb-2 d-flex align-items-center justify-content-between">';
    html += '<div class="td-title">' + tdVal(m.quotation_title || m.quotation_options_title) + '</div>';
    html += '<div>';
    html += '<span class="badge bg-primary me-1">Quote: ' + tdVal(m.quotation_number) + '</span>';
    html += '<span class="badge bg-warning text-dark me-1">Trip Code: ' + tdVal(m.trip_code) + '</span>';
    if (m.leads_number) html += '<span class="badge bg-secondary">' + tdEsc(m.leads_number) + '</span>';
    html += '</div></div>';

    // Stat highlight row
    var members = [];
    if (parseInt(m.total_adults, 10) > 0)   members.push(parseInt(m.total_adults, 10) + ' Adults');
    if (parseInt(m.total_children, 10) > 0) members.push(parseInt(m.total_children, 10) + ' Children');
    html += '<div class="td-stat-row">';
    html += '<div class="td-stat" style="background:linear-gradient(135deg,#e3f2fd,#bbdefb);"><div class="td-stat-label"><i class="fas fa-flag-start me-1" style="color:#1a73e8;"></i>Pickup Date</div><div class="td-stat-value" style="color:#1565c0;">' + tdDate(m.start_date) + '</div></div>';
    html += '<div class="td-stat" style="background:linear-gradient(135deg,#ffebee,#ffcdd2);"><div class="td-stat-label"><i class="fas fa-flag-checkered me-1" style="color:#e74a3b;"></i>Drop Date</div><div class="td-stat-value" style="color:#c62828;">' + tdDate(m.end_date) + '</div></div>';
    html += '<div class="td-stat" style="background:linear-gradient(135deg,#e8f5e9,#c8e6c9);"><div class="td-stat-label"><i class="fas fa-clock me-1" style="color:#1cc88a;"></i>Duration</div><div class="td-stat-value" style="color:#2e7d32;">' + nights + 'N ' + days + 'D</div></div>';
    html += '<div class="td-stat" style="background:linear-gradient(135deg,#fff8e1,#ffecb3);"><div class="td-stat-label"><i class="fas fa-users me-1" style="color:#f6c23e;"></i>Members</div><div class="td-stat-value" style="color:#e65100;">' + (members.length ? members.join(', ') : '-') + '</div></div>';
    html += '</div>';

    html += '<div class="row">';

    // Guest information
    var guest = '<div class="td-info-grid">';
    guest += '<div class="td-info-item"><span class="td-label">Guest Name</span><span class="td-value">' + tdVal(m.guest_name) + '</span></div>';
    guest += '<div class="td-info-item"><span class="td-label">Contact</span><span class="td-value">' + tdVal(m.whats_number) + '</span></div>';
    guest += '<div class="td-info-item"><span class="td-label">Alt Contact</span><span class="td-value">' + tdVal(m.alternative_number) + '</span></div>';
    guest += '<div class="td-info-item"><span class="td-label">E-mail</span><span class="td-value">' + tdVal(m.leads_email) + '</span></div>';
    guest += '<div class="td-info-item" style="grid-column:span 2;"><span class="td-label">Address</span><span class="td-value">' + tdVal(m.leads_address) + '</span></div>';
    guest += '<div class="td-info-item" style="grid-column:span 2;"><span class="td-label">Assigned Staff</span><span class="td-value">' + tdVal(m.staff_name) + '</span></div>';
    guest += '</div>';
    html += '<div class="col-md-6">' + tdCard('<i class="fas fa-user me-1"></i> Guest Information', guest, 'guest') + '</div>';

    // Trip information (no Category)
    var trip = '<div class="td-info-grid">';
    trip += '<div class="td-info-item"><span class="td-label">Pickup</span><span class="td-value">' + tdVal(m.arriving_destination) + '</span></div>';
    trip += '<div class="td-info-item"><span class="td-label">Drop</span><span class="td-value">' + tdVal(m.departuring_destination) + '</span></div>';
    trip += '<div class="td-info-item" style="grid-column:span 2;"><span class="td-label">Quotation Option</span><span class="td-value">' + tdVal(m.quotation_options_title) + '</span></div>';
    trip += '</div>';
    html += '<div class="col-md-6">' + tdCard('<i class="fas fa-route me-1"></i> Trip Information', trip, 'trip') + '</div>';

    html += '</div>';

    // Transportation
    var trans = tdRow('Type of Vehicle', tdVal(m.vehicle_name));
    var tlist = d.transport || [];
    if (tlist.length) {
        for (var t = 0; t < tlist.length; t++) {
            var tr = tlist[t];
            trans += tdRow('Transporter', tdVal(tr.transporter_name));
            trans += tdRow('Driver', tdVal(tr.driver_name) + (tr.driver_mobile ? ' (' + tdEsc(tr.driver_mobile) + ')' : ''));
            trans += tdRow('Cab Number', tdVal(tr.cab_number));
        }
    } else {
        trans += tdRow('Transporter', 'Not assigned');
    }
    html += tdCard('<i class="fas fa-car me-1"></i> Transportation', trans, 'trans');

    // Staycations - grouped per day
    var rooms = d.rooms || [];
    var stay = '';
    if (rooms.length) {
        var groups = {};
        var order  = [];
        for (var i = 0; i < rooms.length; i++) {
            var r   = rooms[i];
            var key = (r.accommodation_date || '') + '|' + (r.quotation_properties_days_day || '') + '|' + (r.properties_name || '');
            if (!groups[key]) { groups[key] = { head: r, items: [] }; order.push(key); }
            groups[key].items.push(r);
        }
        for (var g = 0; g < order.length; g++) {
            var grp = groups[order[g]];
            var h   = grp.head;
            stay += '<div class="td-stay">';
            stay += '<div class="td-stay-date">' + tdVal(h.quotation_properties_days_day) + ' &middot; ' + tdDate(h.accommodation_date);
            if (h.state_name) stay += ' &middot; ' + tdEsc(h.state_name);
            stay += '</div>';
            stay += '<div class="td-stay-name">' + tdVal(h.properties_name) + '</div>';
            for (var k = 0; k < grp.items.length; k++) {
                var it    = grp.items[k];
                var parts = [];
                if (it.properties_room_category_name) parts.push(tdEsc(it.properties_room_category_name));
                if (parseInt(it.room_unit_manual_count, 10) > 0) parts.push(parseInt(it.room_unit_manual_count, 10) + ' Room(s)');
                var mp = tdMealPlan(it);
                if (mp) parts.push('Plan: ' + tdEsc(mp));
                if (parseInt(it.adults, 10) > 0)   parts.push(parseInt(it.adults, 10) + ' Adults');
                if (parseInt(it.children, 10) > 0) parts.push(parseInt(it.children, 10) + ' Children');
                if (parts.length) stay += '<div class="td-stay-meta">' + parts.join(' | ') + '</div>';
            }
            stay += '</div>';
        }
    } else {
        stay = '<div class="text-muted">No confirmed accommodation found.</div>';
    }
    html += tdCard('<i class="fas fa-bed me-1"></i> Staycations / Itinerary Days', stay, 'stay');

    // Inclusions
    var incs = d.inclusions || [];
    if (incs.length) {
        var inc = '';
        for (var a = 0; a < incs.length; a++) {
            inc += tdRow(tdDate(incs[a].accommodation_date) + ' &middot; ' + tdVal(incs[a].properties_name),
                         tdVal(incs[a].property_inclusions_name));
        }
        html += tdCard('<i class="fas fa-plus-circle me-1"></i> Inclusions', inc, 'inc');
    }

    // Special requirements
    var sps = d.special_requirements || [];
    if (sps.length) {
        var sp = '';
        for (var b = 0; b < sps.length; b++) {
            sp += tdRow(tdDate(sps[b].accommodation_date) + ' &middot; ' + tdVal(sps[b].special_requirements_name),
                        tdMoney(sps[b].quotation_special_requirements_cost));
        }
        html += tdCard('<i class="fas fa-star me-1"></i> Special Preferences', sp, 'spec');
    }

    // Payment
    var sched = d.payment_schedule || [];
    var paid  = 0;
    for (var p = 0; p < sched.length; p++) {
        paid += parseFloat(sched[p].paid_amount || 0);
    }
    var cost    = parseFloat(m.package_cost || 0);
    var pending = cost - paid;

    var pay = '';
    pay += '<div class="td-row td-money"><span class="td-label">Package Cost</span><span class="td-value">' + tdMoney(cost) + '</span></div>';
    pay += '<div class="td-row td-money"><span class="td-label">Advance Received</span><span class="td-value text-success">' + tdMoney(paid) + '</span></div>';
    pay += '<div class="td-row td-money"><span class="td-label">Pending</span><span class="td-value ' + (pending > 0 ? 'text-danger' : 'text-success') + '">' + tdMoney(pending) + '</span></div>';
    for (var s = 0; s < sched.length; s++) {
        pay += tdRow('Installment due ' + tdDate(sched[s].due_date),
                     tdMoney(sched[s].calculated_amount) + ' &middot; paid ' + tdMoney(sched[s].paid_amount));
    }
    html += tdCard('<i class="fas fa-rupee-sign me-1"></i> Payment', pay, 'pay');

    return html;
}

function view_trip_details(quotation_id) {
    $('#tripDetailsBody').html(
        '<div class="text-center py-5"><div class="spinner-border text-primary"></div>' +
        '<p class="mt-2 mb-0">Loading trip details...</p></div>'
    );
    $('#TripDetailsModal').modal('show');

    $.ajax({
        url: "<?php echo base_url('index.php/Quotation/ajax_get_converted_trip_details/'); ?>" + quotation_id,
        type: "GET",
        dataType: "JSON",
        success: function (response) {
            if (!response.status) {
                $('#tripDetailsBody').html(
                    '<div class="alert alert-warning mb-0">' + (response.message || 'Trip details not found.') + '</div>'
                );
                return;
            }
            $('#tripDetailsBody').html(buildTripDetails(response.data));
        },
        error: function () {
            $('#tripDetailsBody').html('<div class="alert alert-danger mb-0">Failed to load trip details.</div>');
        }
    });
}

function copyTripDetails() {
    var body = document.getElementById('tripDetailsBody');
    if (!body) return;
    var lines = [];
    var cards = body.querySelectorAll('.td-card');
    cards.forEach(function(card) {
        var head = card.querySelector('.td-card-head');
        if (head) lines.push('=== ' + head.textContent.trim() + ' ===');
        var rows = card.querySelectorAll('.td-row');
        rows.forEach(function(row) {
            var label = row.querySelector('.td-label');
            var value = row.querySelector('.td-value');
            if (label && value) {
                lines.push('  ' + label.textContent.trim() + ': ' + value.textContent.trim());
            }
        });
        var items = card.querySelectorAll('.td-info-item');
        items.forEach(function(item) {
            var label = item.querySelector('.td-label');
            var value = item.querySelector('.td-value');
            if (label && value) {
                lines.push('  ' + label.textContent.trim() + ': ' + value.textContent.trim());
            }
        });
        var stays = card.querySelectorAll('.td-stay');
        stays.forEach(function(stay) {
            var date = stay.querySelector('.td-stay-date');
            var name = stay.querySelector('.td-stay-name');
            var metas = stay.querySelectorAll('.td-stay-meta');
            if (date) lines.push('  ' + date.textContent.trim());
            if (name) lines.push('    ' + name.textContent.trim());
            metas.forEach(function(m) {
                lines.push('      ' + m.textContent.trim());
            });
        });
        lines.push('');
    });
    var text = lines.join('\n');
    var btn = document.getElementById('tdCopyBtn');
    var original = btn.innerHTML;
    if (navigator.clipboard) {
        navigator.clipboard.writeText(text).then(function() {
            btn.innerHTML = '<i class="fas fa-check me-1"></i> Copied!';
            setTimeout(function() { btn.innerHTML = original; }, 2000);
        }).catch(function() {
            fallbackCopy(text, btn, original);
        });
    } else {
        fallbackCopy(text, btn, original);
    }
}

function fallbackCopy(text, btn, original) {
    var ta = document.createElement('textarea');
    ta.value = text;
    ta.style.position = 'fixed';
    ta.style.opacity = '0';
    document.body.appendChild(ta);
    ta.select();
    try {
        document.execCommand('copy');
        btn.innerHTML = '<i class="fas fa-check me-1"></i> Copied!';
    } catch (e) {
        btn.innerHTML = '<i class="fas fa-times me-1"></i> Failed';
    }
    document.body.removeChild(ta);
    setTimeout(function() { btn.innerHTML = original; }, 2000);
}
