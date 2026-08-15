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

function tdCard(title, body) {
    return '<div class="td-card"><div class="td-card-head">' + title +
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
    html += '<div class="mb-3">';
    html += '<div class="td-title">' + tdVal(m.quotation_title || m.quotation_options_title) + '</div>';
    html += '<div>';
    html += '<span class="badge bg-primary me-1">Quote: ' + tdVal(m.quotation_number) + '</span>';
    html += '<span class="badge bg-warning text-dark me-1">Trip Code: ' + tdVal(m.trip_code) + '</span>';
    if (m.leads_number) html += '<span class="badge bg-secondary">' + tdEsc(m.leads_number) + '</span>';
    html += '</div></div>';

    html += '<div class="row">';

    // Guest information
    var guest = '';
    guest += tdRow('Guest Name', tdVal(m.guest_name));
    guest += tdRow('Address', tdVal(m.leads_address));
    guest += tdRow('E-mail ID', tdVal(m.leads_email));
    guest += tdRow('Contact Number', tdVal(m.whats_number));
    guest += tdRow('Alternative Contact', tdVal(m.alternative_number));
    guest += tdRow('Assigned Staff', tdVal(m.staff_name));
    html += '<div class="col-md-6">' + tdCard('Guest Information', guest) + '</div>';

    // Trip information
    var members = [];
    if (parseInt(m.total_adults, 10) > 0)   members.push(parseInt(m.total_adults, 10) + ' Adults');
    if (parseInt(m.total_children, 10) > 0) members.push(parseInt(m.total_children, 10) + ' Children');

    var trip = '';
    trip += tdRow('Pickup', tdVal(m.arriving_destination));
    trip += tdRow('Drop', tdVal(m.departuring_destination));
    trip += tdRow('Pickup Date', tdDate(m.start_date));
    trip += tdRow('Drop Date', tdDate(m.end_date));
    trip += tdRow('Days Trip', nights + 'N' + days + 'D');
    trip += tdRow('Category', tdVal(m.package_category_name));
    trip += tdRow('Number of Members', members.length ? members.join(', ') : '-');
    trip += tdRow('Quotation Option', tdVal(m.quotation_options_title));
    html += '<div class="col-md-6">' + tdCard('Trip Information', trip) + '</div>';

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
    html += tdCard('Transportation', trans);

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
    html += tdCard('Staycations / Itinerary Days', stay);

    // Inclusions
    var incs = d.inclusions || [];
    if (incs.length) {
        var inc = '';
        for (var a = 0; a < incs.length; a++) {
            inc += tdRow(tdDate(incs[a].accommodation_date) + ' &middot; ' + tdVal(incs[a].properties_name),
                         tdVal(incs[a].property_inclusions_name));
        }
        html += tdCard('Inclusions', inc);
    }

    // Special requirements
    var sps = d.special_requirements || [];
    if (sps.length) {
        var sp = '';
        for (var b = 0; b < sps.length; b++) {
            sp += tdRow(tdDate(sps[b].accommodation_date) + ' &middot; ' + tdVal(sps[b].special_requirements_name),
                        tdMoney(sps[b].quotation_special_requirements_cost));
        }
        html += tdCard('Special Preferences', sp);
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
    html += tdCard('Payment', pay);

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
