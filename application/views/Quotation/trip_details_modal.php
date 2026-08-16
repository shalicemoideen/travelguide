        <!-- Converted trip details modal -->
        <div class="modal fade" id="TripDetailsModal" tabindex="-1" aria-hidden="true">
            <div class="modal-dialog modal-xl modal-dialog-scrollable">
                <div class="modal-content">
                    <div class="modal-header" style="background:#f4f6f9;">
                        <h5 class="modal-title"><i class="fas fa-suitcase-rolling me-2"></i> Trip Details</h5>
                        <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
                    </div>
                    <div class="modal-body" id="tripDetailsBody"></div>
                    <div class="modal-footer">
                        <button type="button" class="btn btn-primary btn-sm" id="tdCopyBtn" onclick="copyTripDetails()">
                            <i class="fas fa-copy me-1"></i> Copy to Clipboard
                        </button>
                        <button type="button" class="btn btn-light" data-bs-dismiss="modal">Close</button>
                    </div>
                </div>
            </div>
        </div>

        <style>
        #tripDetailsBody { font-size:13px; }
        #tripDetailsBody .td-card { border:1px solid #e3e8ef; border-radius:8px; margin-bottom:12px; background:#fff; overflow:hidden; }
        #tripDetailsBody .td-card-head { padding:8px 14px; border-bottom:1px solid #e3e8ef; font-weight:700;
            font-size:11px; letter-spacing:.5px; text-transform:uppercase; color:#fff; }
        #tripDetailsBody .td-card-head.guest     { background:linear-gradient(135deg,#4a3ee0,#6c5ce7); }
        #tripDetailsBody .td-card-head.trip      { background:linear-gradient(135deg,#00838f,#00acc1); }
        #tripDetailsBody .td-card-head.trans     { background:linear-gradient(135deg,#e67e22,#f39c12); }
        #tripDetailsBody .td-card-head.stay      { background:linear-gradient(135deg,#2d9e6f,#27ae60); }
        #tripDetailsBody .td-card-head.inc       { background:linear-gradient(135deg,#2980b9,#3498db); }
        #tripDetailsBody .td-card-head.spec      { background:linear-gradient(135deg,#c0392b,#e74c3c); }
        #tripDetailsBody .td-card-head.pay       { background:linear-gradient(135deg,#8e44ad,#9b59b6); }
        #tripDetailsBody .td-card-body { padding:10px 14px; }
        #tripDetailsBody .td-row { display:flex; justify-content:space-between; gap:12px; padding:5px 0;
            border-bottom:1px dashed #e3e8ef; font-size:13px; }
        #tripDetailsBody .td-row:last-child { border-bottom:0; }
        #tripDetailsBody .td-label { color:#6b7a90; white-space:nowrap; }
        #tripDetailsBody .td-value { font-weight:600; color:#243b53; text-align:right; }
        #tripDetailsBody .td-title { font-size:18px; font-weight:700; color:#243b53; margin-bottom:3px; }
        #tripDetailsBody .td-stay { border-left:3px solid #27ae60; background:#f0fbf4; border-radius:4px;
            padding:7px 10px; margin-bottom:6px; }
        #tripDetailsBody .td-stay-date { font-size:10px; font-weight:700; color:#27ae60; text-transform:uppercase; }
        #tripDetailsBody .td-stay-name { font-weight:700; color:#243b53; font-size:13px; }
        #tripDetailsBody .td-stay-meta { font-size:11px; color:#6b7a90; }
        #tripDetailsBody .td-stay-meta .badge { font-size:10px; }
        #tripDetailsBody .td-money { font-size:14px; }
        #tripDetailsBody .td-info-grid { display:grid; grid-template-columns:1fr 1fr; gap:4px 16px; }
        #tripDetailsBody .td-info-item { display:flex; flex-direction:column; padding:4px 0; }
        #tripDetailsBody .td-info-item .td-label { font-size:10px; text-transform:uppercase; letter-spacing:.3px; }
        #tripDetailsBody .td-info-item .td-value { font-size:13px; text-align:left; }
        #tripDetailsBody .td-stat-row { display:flex; gap:8px; margin-bottom:10px; }
        #tripDetailsBody .td-stat { flex:1; text-align:center; border-radius:6px; padding:8px 4px; }
        #tripDetailsBody .td-stat-label { font-size:10px; text-transform:uppercase; letter-spacing:.3px; color:#6b7a90; }
        #tripDetailsBody .td-stat-value { font-size:15px; font-weight:700; margin-top:2px; }
        </style>
