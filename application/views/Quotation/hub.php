

<style>
.quotation-hub-summary {
    margin-bottom: 25px;
}

.quotation-info-card {
    border-radius: 14px;
    padding: 18px 20px;
    background: #ffffff;
    border: 1px solid #e5e7eb;
    box-shadow: 0 4px 12px rgba(0,0,0,0.05);
    height: 100%;
}

.quotation-info-label {
    font-size: 13px;
    color: #6b7280;
    font-weight: 600;
    margin-bottom: 8px;
    text-transform: uppercase;
}

.quotation-info-value {
    font-size: 20px;
    color: #111827;
    font-weight: 700;
    word-break: break-word;
}

.quotation-status-badge {
    display: inline-block;
    padding: 6px 14px;
    border-radius: 999px;
    background: #e8f5e9;
    color: #2e7d32;
    font-size: 15px;
    font-weight: 700;
}
</style>
<style>
.hub-info-section {
    background: #ffffff;
    border: 1px solid #e5e7eb;
    border-radius: 14px;
    padding: 16px;
    height: 100%;
}

.hub-info-title {
    font-size: 15px;
    font-weight: 700;
    color: #111827;
    margin-bottom: 14px;
    padding-bottom: 8px;
    border-bottom: 1px solid #e5e7eb;
}

.hub-info-row {
    margin-bottom: 12px;
}

.hub-info-label {
    font-size: 12px;
    font-weight: 600;
    color: #6b7280;
    text-transform: uppercase;
    margin-bottom: 3px;
}

.hub-info-value {
    font-size: 15px;
    font-weight: 700;
    color: #111827;
    word-break: break-word;
}
</style>
<!--**********************************
            Content body start
        ***********************************-->
        <div class="content-body">
            <div class="container-fluid">
				<div class="quotation-hub-summary">
                    <input type="hidden" id="quotation_id" value="<?= isset($quotation_id) ? (int)$quotation_id : 0; ?>">
                    <div class="row g-3 mb-3">
                        <div class="col-xl-3 col-lg-3 col-md-6">
                            <div class="quotation-info-card">
                                <div class="quotation-info-label">Quotation Number</div>
                                <div id="hubQuotationNumber" class="quotation-info-value"></div>
                            </div>
                        </div>

                        <div class="col-xl-3 col-lg-3 col-md-6">
                            <div class="quotation-info-card">
                                <div class="quotation-info-label">Quotation Status</div>
                                <div class="quotation-info-value">
                                    <span class="quotation-status-badge" id="hubQuotationStatus"></span>
                                </div>
                            </div>
                        </div>

                        <div class="col-xl-3 col-lg-3 col-md-6">
                            <div class="quotation-info-card">
                                <div class="quotation-info-label">Guest Name</div>
                                <div class="quotation-info-value" id="hubGuestName"></div>
                            </div>
                        </div>

                        <div class="col-xl-3 col-lg-3 col-md-6">
                            <div class="quotation-info-card">
                                <div class="quotation-info-label">Lead Number</div>
                                <div class="quotation-info-value" id="hubLeadNumber"></div>
                            </div>
                        </div>
                    </div>

                    <div class="row g-3">
                        <div class="col-xl-3 col-lg-3 col-md-6">
                            <div class="quotation-info-card">
                                <div class="quotation-info-label">Lead Type</div>
                                <div class="quotation-info-value" id="hubLeadType"></div>
                            </div>
                        </div>

                        <div class="col-xl-3 col-lg-3 col-md-6">
                            <div class="quotation-info-card">
                                <div class="quotation-info-label">Tour Start Date</div>
                                <div class="quotation-info-value" id="hubStartDate"></div>
                            </div>
                        </div>

                        <div class="col-xl-3 col-lg-3 col-md-6">
                            <div class="quotation-info-card">
                                <div class="quotation-info-label">Duration</div>
                                <div class="quotation-info-value" id="hubDuration"></div>
                            </div>
                        </div>

                        <div class="col-xl-3 col-lg-3 col-md-6">
                            <div class="quotation-info-card">
                                <div class="quotation-info-label">Tour End Date</div>
                                <div class="quotation-info-value" id="hubEndDate"></div>
                            </div>
                        </div>
                    </div>

                </div>

                <div class="row">
                    <div class="col-xl-12">
                        <div class="card">
                            <div class="card-header">
                                <h4 class="card-title">Quotation Hub</h4>
                            </div>
                            <div class="card-body">
                                <!-- Nav tabs -->
                                <div class="default-tab">
                                    <ul class="nav nav-tabs" role="tablist">
                                        <li class="nav-item">
                                            <a class="nav-link active" data-bs-toggle="tab" href="#home"><i class="la la-home me-2"></i> Lead details</a>
                                        </li>
                                        <li class="nav-item">
                                            <!-- <a class="nav-link" data-bs-toggle="tab" href="#profile"><i class="la la-user me-2"></i> Client confirmation</a> -->
                                            <a class="nav-link" data-bs-toggle="tab" href="#clientConfirmationTab">
                                                <i class="la la-user me-2"></i> Client confirmation
                                            </a>
                                        </li>
                                        <li class="nav-item">
                                            <a class="nav-link" data-bs-toggle="tab" href="#contact"><i class="la la-phone me-2"></i> Receipt sheduller</a>
                                        </li>
                                        <li class="nav-item">
                                            <a class="nav-link" data-bs-toggle="tab" href="#message"><i class="la la-envelope me-2"></i> Property reservation</a>
                                        </li>
                                        <li class="nav-item">
                                            <a class="nav-link" data-bs-toggle="tab" href="#message"><i class="la la-envelope me-2"></i> Property reservation</a>
                                        </li>
                                        <li class="nav-item">
                                            <a class="nav-link" data-bs-toggle="tab" href="#message"><i class="la la-envelope me-2"></i> Property status</a>
                                        </li>
                                        <li class="nav-item">
                                            <a class="nav-link" data-bs-toggle="tab" href="#message"><i class="la la-envelope me-2"></i> Property voucher</a>
                                        </li>
                                        <li class="nav-item">
                                            <a class="nav-link" data-bs-toggle="tab" href="#message"><i class="la la-envelope me-2"></i> Tour voucher</a>
                                        </li>
                                        <li class="nav-item">
                                            <a class="nav-link" data-bs-toggle="tab" href="#message"><i class="la la-envelope me-2"></i> Driver itinerary</a>
                                        </li>
                                        <li class="nav-item">
                                            <a class="nav-link" data-bs-toggle="tab" href="#message"><i class="la la-envelope me-2"></i> Finiancial overview</a>
                                        </li>
                                        <li class="nav-item">
                                            <a class="nav-link" data-bs-toggle="tab" href="#message"><i class="la la-envelope me-2"></i> Payments</a>
                                        </li>
                                    </ul>
                                    <div class="tab-content">
                                        <!-- <div class="tab-pane fade show active" id="home" role="tabpanel">
                                            <div class="pt-4">
                                                <h4>This is home title</h4>
                                                <p>Far far away, behind the word mountains, far from the countries Vokalia and Consonantia, there live the blind texts. Separated they live in Bookmarksgrove.
                                                </p>
                                                <p>Far far away, behind the word mountains, far from the countries Vokalia and Consonantia, there live the blind texts. Separated they live in Bookmarksgrove.
                                                </p>
                                            </div>
                                        </div> -->
                                        <div class="tab-pane fade show active" id="lead-details-tab-pane">

                                            <div id="quotationLeadDetailsSection">
                                                <div class="text-center py-5">
                                                    <div class="spinner-border text-primary"></div>
                                                    <p class="mt-2 mb-0">Loading lead details...</p>
                                                </div>
                                            </div>

                                            <div class="mt-4" id="quotationAccommodationSection">
                                                <div class="text-center py-5">
                                                    <div class="spinner-border text-primary"></div>
                                                    <p class="mt-2 mb-0">Loading accommodation details...</p>
                                                </div>
                                            </div>

                                        </div>
                                        <div class="tab-pane fade" id="clientConfirmationTab">
                                            <div class="pt-4">

                                                <div class="card border-0 shadow-sm">
                                                    <div class="card-header bg-white">
                                                        <h5 class="mb-0 fw-bold">Client Confirmation</h5>
                                                    </div>

                                                    <div class="card-body">
                                                        <div class="row mb-3">
                                                            <div class="col-md-4">
                                                                <label class="form-label fw-semibold">Select Quotation Option</label>
                                                                <select id="confirmationOptionSelect" class="form-select">
                                                                    <option value="">Select Option</option>
                                                                </select>
                                                            </div>
                                                        </div>

                                                        <div id="confirmationOptionDetails">
                                                            <div class="alert alert-info mb-0">Please select an option to view details.</div>
                                                        </div>
                                                    </div>
                                                </div>

                                            </div>
                                        </div>
                                        <div class="tab-pane fade" id="profile">
                                            <div class="pt-4">
                                                <h4>This is profile title</h4>
                                                <p>Raw denim you probably haven't heard of them jean shorts Austin. Nesciunt tofu stumptown aliqua, retro synth master cleanse. Mustache cliche tempor.
                                                </p>
                                                <p>Raw denim you probably haven't heard of them jean shorts Austin. Nesciunt tofu stumptown aliqua, retro synth master cleanse. Mustache cliche tempor.
                                                </p>
                                            </div>
                                        </div>
                                        <div class="tab-pane fade" id="contact">
                                            <div class="pt-4">
                                                <h4>This is contact title</h4>
                                                <p>Far far away, behind the word mountains, far from the countries Vokalia and Consonantia, there live the blind texts. Separated they live in Bookmarksgrove.
                                                </p>
                                                <p>Far far away, behind the word mountains, far from the countries Vokalia and Consonantia, there live the blind texts. Separated they live in Bookmarksgrove.
                                                </p>
                                            </div>
                                        </div>
                                        <div class="tab-pane fade" id="message">
                                            <div class="pt-4">
                                                <h4>This is message title</h4>
                                                <p>Raw denim you probably haven't heard of them jean shorts Austin. Nesciunt tofu stumptown aliqua, retro synth master cleanse. Mustache cliche tempor.
                                                </p>
                                                <p>Raw denim you probably haven't heard of them jean shorts Austin. Nesciunt tofu stumptown aliqua, retro synth master cleanse. Mustache cliche tempor.
                                                </p>
                                            </div>
                                        </div>
                                    </div>
                                </div>
                            </div>
                        </div>
                    </div>
                </div>
                
            </div>
        </div>
        <!--**********************************
            Content body end
        ***********************************-->
                                                                    
       