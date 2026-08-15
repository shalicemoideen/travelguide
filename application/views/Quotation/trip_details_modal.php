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
                        <button type="button" class="btn btn-light" data-bs-dismiss="modal">Close</button>
                    </div>
                </div>
            </div>
        </div>

        <style>
        #tripDetailsBody .td-card { border:1px solid #e6eaef; border-radius:8px; margin-bottom:16px; background:#fff; }
        #tripDetailsBody .td-card-head { padding:10px 16px; border-bottom:1px solid #e6eaef; font-weight:700;
            font-size:12px; letter-spacing:.5px; text-transform:uppercase; color:#31456a; background:#f7f9fc;
            border-radius:8px 8px 0 0; }
        #tripDetailsBody .td-card-body { padding:12px 16px; }
        #tripDetailsBody .td-row { display:flex; justify-content:space-between; gap:16px; padding:7px 0;
            border-bottom:1px dashed #e6eaef; font-size:13px; }
        #tripDetailsBody .td-row:last-child { border-bottom:0; }
        #tripDetailsBody .td-label { color:#6b7a90; }
        #tripDetailsBody .td-value { font-weight:600; color:#243b53; text-align:right; }
        #tripDetailsBody .td-title { font-size:20px; font-weight:700; color:#243b53; margin-bottom:4px; }
        #tripDetailsBody .td-stay { border-left:3px solid #00838f; background:#f7fbfc; border-radius:4px;
            padding:9px 12px; margin-bottom:8px; }
        #tripDetailsBody .td-stay-date { font-size:11px; font-weight:700; color:#00838f; text-transform:uppercase; }
        #tripDetailsBody .td-stay-name { font-weight:700; color:#243b53; }
        #tripDetailsBody .td-stay-meta { font-size:12px; color:#6b7a90; }
        #tripDetailsBody .td-money { font-size:15px; }
        </style>
