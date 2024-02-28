<div class="modal fade order-history" id="showMyModal" tabindex="-1" role="dialog" aria-labelledby="updateModalTitle"
     aria-hidden="true">
    <div class="modal-dialog modal-lg" role="document">
        <div class="modal-content">
            <div class="modal-header">
                <h4 class="modal-title" id="createModalTitle">Purchase information</h4>
                <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                    <i aria-hidden="true" class="ki ki-close"></i>
                </button>
            </div>


            @php
                $settings = \App\Models\CalendarSettings::where('calendar_id', request()->calendar_user->id)->first();
                $vat = $settings->vat ?? 0;
            @endphp

            <div class="modal-body" data-vat="{{ $vat }}">
                <div class="tab-content" id="createTabContent">
                    <div class="tab-pane fade show active" id="general_tab" role="tabpanel">
                        <div class="row">
                            <div class="col-12">
                                <h5 class="form-group">Buyer</h5>
                                <div class="row">
                                    <div class="col-6">
                                        <div class="form-group">
                                            <label class="col-auto col-form-label font-weight-bold">First Name</label>
                                            <div class="col-sm-12">
                                                <p id="FirstName"></p>
                                            </div>
                                        </div>
                                    </div>

                                    <div class="col-6">
                                        <div class="form-group">
                                            <label class="col-auto col-form-label font-weight-bold">Last Name</label>
                                            <div class="col-sm-12">
                                                <p id="LastName"></p>
                                            </div>
                                        </div>
                                    </div>


                                    <div class="col-6">
                                        <div class="form-group">
                                            <label class="col-auto col-form-label font-weight-bold">Phone</label>
                                            <div class="col-sm-12">
                                                <p id="Phone"></p>
                                            </div>
                                        </div>
                                    </div>


                                    <div class="col-6">
                                        <div class="form-group">
                                            <label class="col-auto col-form-label font-weight-bold">Place</label>
                                            <div class="col-sm-12">
                                                <p id="Place"></p>
                                            </div>
                                        </div>
                                    </div>
                                    <div class="col-6">
                                        <div class="form-group">
                                            <label class="col-auto col-form-label font-weight-bold">Street</label>
                                            <div class="col-sm-12">
                                                <p id="Street"></p>
                                            </div>
                                        </div>
                                    </div>
                                    <div class="col-6">
                                        <div class="form-group">
                                            <label class="col-auto col-form-label font-weight-bold">Email</label>
                                            <div class="col-sm-12">
                                                <p id="Email"></p>
                                            </div>
                                        </div>
                                    </div>
                                    <div class="col-6">
                                        <div class="form-group">
                                            <label class="col-auto col-form-label font-weight-bold">Slot started</label>
                                            <div class="col-sm-12">
                                                <p id="SlotStarted"></p>
                                            </div>
                                        </div>
                                    </div>
                                    <div class="col-6">
                                        <div class="form-group">
                                            <label class="col-auto col-form-label font-weight-bold">Is sent email</label>
                                            <div class="col-sm-12">
                                                <p id="SentMail"></p>
                                            </div>
                                        </div>
                                    </div>
                                </div>
                            </div>

                            <div class="col-12" id="myproducts"></div>

                            <hr>

                            <h5 class="form-group ml-2 mt-4">Comments</h5>

                            <div class="col-12 ml-2" id="order-comments"></div>

                            <div class="w-100 comment-form">
                                <textarea class="w-100 new-comment-content" placeholder="Comment"></textarea>
                                <button class="post-comment">Post Comment</button>
                            </div>
                        </div>
                    </div>
                </div>
            </div>

            <div class="modal-footer">
                <button type="button" class="btn btn-lg btn-light-primary font-weight-bold" data-dismiss="modal">
                    Close
                </button>
            </div>

        </div>
    </div>
</div>
