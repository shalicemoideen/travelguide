<!--**********************************
            Content body start
        ***********************************-->
        <div class="content-body">
            <div class="container-fluid">

                <div class="row">
                    <div class="col-12">
                        <div class="card">
                            <div class="card-header d-flex justify-content-between align-items-center flex-wrap gap-2">
                                <h2 class="card-title mb-0"><b>Financial Posting</b></h2>
                                <div class="d-flex gap-2 flex-wrap align-items-center">
                                    <input type="text" class="form-control form-control-sm" id="fpListSearch"
                                           placeholder="Quotation no / Trip code / Guest" style="max-width:260px;">
                                    <button type="button" class="btn btn-primary btn-sm" id="fpAddBtn" style="white-space:nowrap;">
                                        <i class="la la-plus me-1"></i> Add Financial Posting
                                    </button>
                                </div>
                            </div>
                            <div class="card-body">
                                <div class="table-responsive">
                                    <table class="table card-table display mb-4 shadow-hover table-responsive-lg" id="FinancialPostingList">
                                        <thead>
                                            <tr>
                                                <th>Sl.no</th>
                                                <th>Quotation no</th>
                                                <th>Trip code</th>
                                                <th>Guest name</th>
                                                <th>Travel Details</th>
                                                <th>Pre Quoted</th>
                                                <th>Actual Cost</th>
                                                <th>Total Margin</th>
                                                <th>Action</th>
                                            </tr>
                                        </thead>
                                        <tbody></tbody>
                                    </table>
                                </div>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
        </div>

        <!-- Step 1: pick a trip-completed quotation -->
        <div class="modal fade" id="fpPickQuotationModal" tabindex="-1" aria-hidden="true">
            <div class="modal-dialog modal-lg modal-dialog-scrollable">
                <div class="modal-content">
                    <div class="modal-header" style="background:#f4f6f9;">
                        <h5 class="modal-title"><i class="la la-check-circle me-2"></i> Select a Trip Completed Quotation</h5>
                        <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
                    </div>
                    <div class="modal-body">
                        <input type="text" class="form-control mb-3" id="fpPickSearch"
                               placeholder="Search by quotation no, trip code or guest name">
                        <div id="fpPickList"></div>
                    </div>
                </div>
            </div>
        </div>

        <!-- Step 2: the shared financial posting form -->
        <div class="modal fade" id="fpFormModal" tabindex="-1" aria-hidden="true" data-bs-backdrop="static">
            <div class="modal-dialog modal-xl modal-dialog-scrollable">
                <div class="modal-content">
                    <div class="modal-header" style="background:#f4f6f9;">
                        <h5 class="modal-title">
                            <i class="la la-file-invoice-dollar me-2"></i>
                            Financial Posting <span id="fpFormQuotationLabel" class="text-muted"></span>
                        </h5>
                        <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
                    </div>
                    <div class="modal-body">
                        <!-- fpLoad() reads this to fetch the quotation defaults -->
                        <input type="hidden" id="quotation_id" value="">
                        <?php include(APPPATH . 'views/Quotation/financial_posting_form.php'); ?>
                    </div>
                </div>
            </div>
        </div>

        <style>
        #fpPickList .fp-pick-item {
            display: flex; align-items: center; justify-content: space-between; gap: 12px;
            padding: 10px 14px; border: 1px solid #e6eaef; border-radius: 8px;
            margin-bottom: 8px; cursor: pointer; background: #fff;
        }
        #fpPickList .fp-pick-item:hover { background: #f1f8f9; border-color: #80cbc4; }
        #fpPickList .fp-pick-name { font-weight: 700; color: #243b53; }
        #fpPickList .fp-pick-meta { font-size: 12px; color: #6b7a90; }
        </style>
        <!--**********************************
            Content body end
        ***********************************-->
