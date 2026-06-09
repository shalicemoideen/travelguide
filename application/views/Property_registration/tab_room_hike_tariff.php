                                                <div class="col-sm-2"><button type="button" id="btn4" class="btn btn-rounded btn-primary btn-md"><i class="fas fa-filter"></i> Filter</button></div><br><br><br>
                                                <!-- row -->
                                                <form id="exampleValidation4" method="POST" action="" enctype="multipart/form-data">
                                                    <div class="card-header" id="Create4" style="display:none">
                                                        <div class="d-flex align-items-center">
                                                            <div class="row row-demo-grid hdr-filter-dd-fullwd">
                                                                <div class="col-sm-6 col-md-5">
                                                                    <div class="card">
                                                                        <div class="input-group">
                                                                            <input type="text" class="form-control" placeholder="Room tariff date range" id="room_tariff_daterange_filter" name="room_tariff_daterange_filter">
                                                                        </div>
                                                                    </div>
                                                                </div>
                                                                <div class="col-sm-6 col-md-5">
                                                                    <div class="card">
                                                                        <div class="input-group">
                                                                            <input type="text" class="form-control" placeholder="Hike tariff date range" id="hike_tariff_daterange" name="hike_tariff_daterange">
                                                                        </div>
                                                                    </div>
                                                                </div>
                                                                <div class="col-sm-6 col-md-5 staff-do-not-show">
                                                                    <div class="card">
                                                                        <div class="input-group">
                                                                            <select name="hike_room_tariff_hike_createdby_user_id" id="hike_room_tariff_hike_createdby_user_id" class="form-control input-lg multi-select">
                                                                                <option value="">Please Select Created by</option>
                                                                            </select>
                                                                        </div>
                                                                    </div>
                                                                </div>
                                                                <div class="col-sm-2 col-md-3">
                                                                    <div class="card">
                                                                        <button type="button" class="btn btn-warning btn-md" id="search5">
                                                                            <span class="btn-label">
                                                                                <i class="fas fa-search"></i>
                                                                            </span>
                                                                            Search
                                                                        </button>
                                                                    </div>
                                                                </div>
                                                                <div class="col-sm-2 col-md-3">
                                                                    <div class="card">
                                                                        <button type="button" class="btn btn-secondary btn-md" id="refresh5">
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
                                                                <!-- <h2 class="card-title"><b>Room hike tariff Details</b></h2>
                                                                <?php if (has_permission('ROOM_TARIFF_HIKE_CREATE')): ?>
                                                                    <button onclick="add_room_hike_tariff()" data-bs-target="#RoomTariffHikeModal" class="btn btn-rounded btn-secondary btn-md"><b>+ New room hike tariff</b></button>
                                                                <?php endif; ?> -->
                                                            </div>
                                                            <div class="card-body">
                                                                <div class="table-responsive">
                                                                    <table class="table card-table display mb-4 shadow-hover table-responsive-lg" id="Room_hike_tariff_registration">
                                                                        <thead>
                                                                            <tr>
                                                                                <th>Sl.no</th>
                                                                                <th>Property Name</th>
                                                                                <th>Room tariff from / to date</th>
                                                                                <th>Hike From date</th>
                                                                                <th>Hike To date</th>
                                                                                <th>Description</th>
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
                                        </div> <!-- end page -->
                                        <!--    <div class="tab-pane fade" id="contact1">
                                            <div class="pt-4">
                                                <h4>This is contact title</h4>
                                                <p>Far far away, behind the word mountains, far from the countries Vokalia and Consonantia, there live the blind texts. Separated they live in Bookmarksgrove.
                                                </p>
                                                <p>Far far away, behind the word mountains, far from the countries Vokalia and Consonantia, there live the blind texts. Separated they live in Bookmarksgrove.
                                                </p>
                                            </div>
                                        </div>
                                        <div class="tab-pane fade" id="message1">
                                            <div class="pt-4">
                                                <h4>This is message title</h4>
                                                <p>Raw denim you probably haven't heard of them jean shorts Austin. Nesciunt tofu stumptown aliqua, retro synth master cleanse. Mustache cliche tempor.
                                                </p>
                                                <p>Raw denim you probably haven't heard of them jean shorts Austin. Nesciunt tofu stumptown aliqua, retro synth master cleanse. Mustache cliche tempor.
                                                </p>
                                            </div>
                                        </div> -->
                                    </div>
                                </div>
                            </div>
                        </div>
                    </div>
                    
                    

                    <!-- <div class="col-xl-12">
                        <div class="card">
                            <div class="card-header">
                                <h4 class="card-title">Vertical Nav Pill</h4>
                            </div>
                            <div class="card-body">
                                <div class="row">
                                    <div class="col-sm-2">
                                        <div class="nav flex-column nav-pills mb-3">
                                            <a href="#v-pills-home" data-bs-toggle="pill" class="nav-link active show">Home</a>
                                            <a href="#v-pills-profile" data-bs-toggle="pill" class="nav-link">Profile</a>
                                            <a href="#v-pills-messages" data-bs-toggle="pill" class="nav-link">Messages</a>
                                            <a href="#v-pills-settings" data-bs-toggle="pill" class="nav-link">Settings</a>
                                        </div>
                                    </div>
                                    <div class="col-sm-8">
                                        <div class="tab-content">
                                            <div id="v-pills-home" class="tab-pane fade active show">
                                                <p>Cillum ad ut irure tempor velit nostrud occaecat ullamco aliqua anim Lorem sint. Veniam sint duis incididunt do esse magna mollit excepteur laborum qui. Id id reprehenderit sit est eu aliqua occaecat quis
                                                    et velit excepteur laborum mollit dolore eiusmod. Ipsum dolor in occaecat commodo et voluptate minim reprehenderit mollit pariatur. Deserunt non laborum enim et cillum eu deserunt excepteur ea incididunt
                                                    minim occaecat.
                                                </p>
                                            </div>
                                            <div id="v-pills-profile" class="tab-pane fade">
                                                <p>Culpa dolor voluptate do laboris laboris irure reprehenderit id incididunt duis pariatur mollit aute magna pariatur consectetur. Eu veniam duis non ut dolor deserunt commodo et minim in quis laboris ipsum
                                                    velit id veniam. Quis ut consectetur adipisicing officia excepteur non sit. Ut et elit aliquip labore Lorem enim eu. Ullamco mollit occaecat dolore ipsum id officia mollit qui esse anim eiusmod do sint
                                                    minim consectetur qui.
                                                </p>
                                            </div>
                                            <div id="v-pills-messages" class="tab-pane fade">
                                                <p>Fugiat id quis dolor culpa eiusmod anim velit excepteur proident dolor aute qui magna. Ad proident laboris ullamco esse anim Lorem Lorem veniam quis Lorem irure occaecat velit nostrud magna nulla. Velit
                                                    et et proident Lorem do ea tempor officia dolor. Reprehenderit Lorem aliquip labore est magna commodo est ea veniam consectetur.</p>
                                            </div>
                                            <div id="v-pills-settings" class="tab-pane fade">
                                                <p>Eu dolore ea ullamco dolore Lorem id cupidatat excepteur reprehenderit consectetur elit id dolor proident in cupidatat officia. Voluptate excepteur commodo labore nisi cillum duis aliqua do. Aliqua amet
                                                    qui mollit consectetur nulla mollit velit aliqua veniam nisi id do Lorem deserunt amet. Culpa ullamco sit adipisicing labore officia magna elit nisi in aute tempor commodo eiusmod.</p>
                                            </div>
                                        </div>
                                    </div>
                                </div>
                            </div>
                        </div>
                    </div> -->

