<style>
    .modal-lg {
    max-width: 80%;
}
.ck-content ul { list-style: disc; margin-left:20px; }
.ck-content ol { list-style: decimal; margin-left:20px; }

.ck-content ul li {
  list-style: disc !important;
}

.ck-content ol li {
  list-style: decimal !important;
}

.ck-content ul,
.ck-content ol {
  margin-left: 20px !important;
}

/* Pagination active page number color */
.dataTables_wrapper .dataTables_paginate .paginate_button.current,
.dataTables_wrapper .dataTables_paginate .paginate_button.current:hover {
    background: #E23428 !important;
    background-color: #E23428 !important;
    color: #fff !important;
    border-color: #E23428 !important;
    font-weight: 600;
}
</style>
<style>
.select2-container--default .select2-selection--single .select2-selection__clear {
    position: absolute;
    right: 25px;
    top: 50%;
    transform: translateY(-50%);
    z-index: 10;
}
.select2-container--default .select2-selection--single .select2-selection__arrow {
    position: absolute;
    right: 5px;
    top: 50%;
    transform: translateY(-50%);
}
</style>
<!--**********************************
            Content body start
        ***********************************-->
        <div class="content-body">
            <div class="container-fluid">
				<button type="button" id="btn" class="btn btn-rounded btn-primary btn-md"><i class="fas fa-filter"></i> Filter</button><br><br>
				<!-- <div class="row page-titles">
					<ol class="breadcrumb">
						<li class="breadcrumb-item active"><a href="javascript:void(0)">Table</a></li>
						<li class="breadcrumb-item"><a href="javascript:void(0)">Datatable</a></li>
					</ol>
                </div> -->
                <!-- row --><input type="hidden" id="counter_edit2" value="">
                <form id="exampleValidation" method="POST" action="" enctype="multipart/form-data">
                                    <div class="card-header" id="Create" style="display:none">
                                        <div class="d-flex align-items-center">
                                            <div class="row row-demo-grid hdr-filter-dd-fullwd">
                                                <div class="col-sm-6 col-md-5">
                                                    <div class="card">
                                                        <div class="input-group">
                                                            <select class=" input-lg lst-flt-select2" id="itineraries_id_filter" name="itineraries_id_filter">
                                                            </select>
                                                        </div>
                                                    </div>
                                                </div>
                                                <div class="col-sm-6 col-md-5">
                                                    <div class="card">
                                                        <div class="input-group">
                                                            <select class="form-control input-lg lst-flt-select2" id="itineraries_category_id_filter" name="itineraries_category_id_filter">
                                                            </select>
                                                        </div>
                                                    </div>
                                                </div>
                                                <div class="col-sm-6 col-md-5">
                                                    <div class="card">
                                                        <div class="input-group">
                                                            <input type="text" class="form-control" name="itineraries_duration_nights_filter" id="itineraries_duration_nights_filter" placeholder="Enter duration in nights">
                                                        </div>
                                                    </div>
                                                </div>
                                                <div class="col-sm-6 col-md-5">
                                                    <div class="card">
                                                        <div class="input-group">
                                                            <select class="form-control input-lg lst-flt-select2" id="itineraries_days_destination_id_fk_filter" name="itineraries_days_destination_id_fk_filter">
                                                            </select>
                                                        </div>
                                                    </div>
                                                </div>
                                                <div class="col-sm-6 col-md-5 staff-do-not-show">
                                                    <div class="card">
                                                        <div class="input-group">
                                                            <select name="itineraries_createdby_user_id" id="itineraries_createdby_user_id" class="form-control input-lg lst-flt-select2">
                                                            </select>
                                                        </div>
                                                    </div>
                                                </div>
                                                <div class="col-sm-2 col-md-3">
                                                    <div class="card">
                                                        <button type="button" class="btn btn-warning btn-md" id="search">
                                                            <span class="btn-label">
                                                                <i class="fas fa-search"></i>
                                                            </span>
                                                            Search
                                                        </button>
                                                    </div>
                                                </div>
                                                <div class="col-sm-2 col-md-3">
                                                    <div class="card">
                                                        <button type="button" class="btn btn-secondary btn-md" id="refresh">
                                                            <span class="btn-label">
                                                                <i class="icon-refresh"></i>
                                                            </span>
                                                            Refresh
                                                        </button>
                                                    </div>
                                                </div>
                                                
                                            </div>
                                        
                                        </div>
                                    </div>
                                    </form>

                <div class="row">
                    
                    
					<div class="col-12">
                        <div class="card">
                            <div class="card-header">
                                <h4 class="card-title">Itinerary Details</h4>
                                <?php if (has_permission('ITINERARY_CREATE')): ?>
                                <a onclick="add_Itinerary()"  data-bs-target="#ItineraryModal" class="btn btn-rounded btn-secondary btn-md">+ New Itinerary</a> 
                                <?php endif; ?>                                
                            </div>
                            <div class="card-body">
                                <div class="table-responsive">
                                    <table id="Itinerary_table" class="display" style="min-width: 845px">
                                        <thead>
                                            <tr>
                                                <th>Sl.no</th>
                                                <th>Name</th>
                                                <th>Category</th>
                                                <th>Duration nights</th>
                                                <th>Description</th>
                                                <th>Created by</th>
                                                <th>Action</th>
                                            </tr>
                                        </thead>
                                        <tbody>
                                            
                                        </tbody>
                                    </table>
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

        <!-- Modal -->
        <!-- Modal -->
<div class="modal fade" id="ItineraryModal" tabindex="-1"  aria-hidden="true" data-bs-backdrop="static" data-bs-keyboard="false"> 
<!-- <div class="modal fade" id="ItineraryModal" tabindex="-1" aria-hidden="true" data-backdrop="static" data-keyboard="false"> -->
  <div class="modal-dialog modal-xl modal-dialog-scrollable" role="document">
    <div class="modal-content">

      <div class="modal-header">
        <h5 class="modal-title" id="ItineraryModalTitle">Itinerary</h5>
        <button type="button" class="btn-close" onclick="Itinerarymodalclose()" data-bs-dismiss="modal" aria-label="Close"></button>
      </div>

      <div class="modal-body">
        <form class="needs-validation sl-cust-validation" action="#" id="form" novalidate>
          <input type="hidden" value="" name="id" id="id">
          <input type="hidden" name="removed_itineraries_days_ids" id="removed_itineraries_days_ids" value="">
        
          <!-- Top Fields -->
          <div class="row g-3">
            <div class="col-md-3">
              <label class="form-label"><b>Name</b> <span class="text-danger">*</span></label>
              <input type="text" class="form-control" name="itineraries_name" id="itineraries_name" placeholder="Enter itinerary name" required>
              <span class="help-block" style="color:red"></span>
            </div>

            <div class="col-md-3" id="returnRequest">
              <label class="form-label"><b>Duration in nights</b> <span class="text-danger">*</span></label>
              <input type="number" min="1" class="form-control" name="itineraries_duration_nights" id="itineraries_duration_nights1" placeholder="Enter Duration in nights" required>
              <span class="help-block" style="color:red"></span>
            </div>

            <div class="col-md-3">
              <label class="form-label"><b>Category</b> <span class="text-danger">*</span></label>
              <select name="itineraries_category_id_fk" id="itineraries_category_id_fk" class="input-lg" required>
              </select>
              <span class="help-block" style="color:red"></span>
            </div>

            <div class="col-md-3">
              <label class="form-label"><b>Description</b> </label>
              <textarea class="form-control" name="itineraries_description" id="itineraries_description" rows="3" placeholder="Enter Description" required></textarea>
              <span class="help-block" style="color:red"></span>
            </div>
          </div>

          <div class="row">
                                
              <div class="col-md-2">
                  <label><b>First cover page</b></label>

                  <input id="itineraries_first_cover_page" name="itineraries_first_cover_page"
                  class="form-control" type="file">

                  <input id="itineraries_first_cover_page_txt" name="itineraries_first_cover_page_txt" type="hidden">

                  <div id="first_cover_preview" style="margin-top:8px;"></div>

              </div>


              <div class="col-md-2">
                  <label><b>Last cover page</b></label>

                  <input id="itineraries_last_cover_page" name="itineraries_last_cover_page"
                  class="form-control" type="file">

                  <input id="itineraries_last_cover_page_txt" name="itineraries_last_cover_page_txt" type="hidden">

                  <div id="last_cover_preview" style="margin-top:8px;"></div>

              </div>                               
          </div>

          <!-- Day Blocks Container -->
          <div class="mt-3">
            <div class="card">
              <div class="card-header py-2">
                <h6 class="m-0">Days Plan</h6>
              </div>

              <div class="card-body">
                <!-- IMPORTANT: wrapper must be inside modal body card -->
                <div id="productRowWrapper" class="row gy-2"></div>
              </div>
            </div>
          </div>

          <!-- Template for Day Row -->
          
          <template id="dayRowTemplate">
  <div class="col-12 day-row">
    <div class="card mb-2">
      <div class="card-body p-3">

        <div class="d-flex justify-content-between align-items-center mb-2">
          <div class="day-label fw-bold">Day 1</div>
          <span class="badge bg-secondary travel-badge" style="display:none;">Travel Back</span>
        </div>

        <input type="hidden" name="itineraries_days_id[]" class="itineraries_days_id" value="">
        <input type="hidden" name="itineraries_days_day[]" class="itineraries_days_day" value="">
        <input type="hidden" name="itineraries_days_travel_back[]" class="itineraries_days_travel_back" value="">

        <!-- keep old image on update -->
        <input type="hidden" name="itineraries_days_image_existing[]" class="itineraries_days_image_existing" value="">

        <div class="row g-2">
          <div class="col-md-4">
            <label class="form-label mb-1"><b>Destination</b></label>
            <select name="itineraries_days_destination_id_fk[]"
                    class="form-control destination_select select2-destination"
                    required>
              <option value="">Please Select Destination</option>
            </select>
          </div>

          <div class="col-md-4">
            <label class="form-label mb-1"><b>Title</b></label>
            <input type="text" name="itineraries_days_title[]" class="form-control itineraries_days_title" required>
          </div>

          <div class="col-md-4">
            <label class="form-label mb-1"><b>Image</b></label>
            <input type="file"
                   name="itineraries_days_image[]"
                   class="form-control itineraries_days_image"
                   accept="image/*">
            <small class="text-muted">Optional (jpg/png/webp/gif)</small>
            <div class="mt-2">
              <img class="img-thumbnail day-image-preview" src="" style="display:none; max-height:90px;">
            </div>
          </div>

          <div class="col-12">
            <label class="form-label mb-1"><b>Description</b></label>
            <!-- IMPORTANT: we will assign unique id from JS -->
            <!-- <textarea name="itineraries_days_description[]" class="form-control itineraries_days_description" rows="3" required></textarea> -->
            <textarea name="itineraries_days_description[]" class="form-control day-editor"></textarea>

          </div>
        </div>

      </div>
    </div>
  </div>
</template>


        </form>
      </div>

      <div class="modal-footer">
        <button type="button" class="btn btn-danger light" onclick="Itinerarymodalclose()" data-bs-dismiss="modal">Close</button>
        <button type="button" class="btn btn-primary" id="btnSave" onclick="save()">Save</button>
      </div>

    </div>
  </div>
</div>



<!-- Modal -->
<div class="modal fade" id="deleterowModal" role="dialog" data-backdrop="static"  data-keyboard="false">
    <div class="modal-dialog" role="document">
        <div class="modal-content">
            <div class="modal-header">
                <h5 class="modal-title1"></h5>
                <button type="button" class="btn-close" data-bs-dismiss="modal">
                </button>
            </div>
            <div class="modal-body">
                
                <form class="needs-validation" action="#" id="form1" >
                    <input type="hidden" value="" name="id" id="id1"/> 
                    <input type="hidden" value="" name="itineraries_name" id="itineraries_name1"/>
                    
                </form>
            </div>
            <div class="modal-footer">
                <button type="button" class="btn btn-danger light" onclick="Itinerarymodalclose()" data-bs-dismiss="modal">Close</button>
                <button type="button" class="btn btn-primary" id="btnSave1" onclick="delete_itineraries_action()" >Delete</button>
            </div>
        </div>
    </div>
</div>

<div id="previewSection" style="display:none; margin-top:15px;">
  <div style="display:flex; justify-content:flex-end; gap:10px; margin-bottom:10px;">
    <button type="button" class="btn btn-primary" onclick="downloadPDF()">Download PDF</button>
  </div>

  <div id="pdf-content">
    <!-- COVER PAGE -->
    <div class="pdf-page cover-page">
      <h1 class="cover-title" id="coverTitle">TRAVEL ITINERARY</h1>
      <div class="cover-subtitle" id="coverSubtitle">-</div>

      <div class="cover-details" id="coverDetails">
        Prepared For: <strong>-</strong><br>
        Travel Dates: <strong>-</strong><br>
        Duration: <strong>-</strong>
      </div>

      <div class="cover-footer" id="coverFooter">-</div>
    </div>

    <!-- DAY PAGES -->
    <div id="itinerary-pages"></div>
  </div>
</div>