@extends('admin.layouts.master')

@section('content')

    <!-- Main Content -->
    <section class="section">
        <div class="section-header">
            <h1>Settings</h1>
        </div>

        <div class="section-body">
            @include('admin.layouts.flash-message')
            <div class="row">
                <div class="col-12">
                    <div class="card">
                        <div class="card-body">
                            <div class="row">
                                <div class="col-2">
                                    <div class="list-group" id="list-tab" role="tablist">
                                        <a class="list-group-item list-group-item-action active" id="list-home-list"
                                           data-toggle="list" href="#list-home" role="tab">Paypal</a>
                                        <a class="list-group-item list-group-item-action" id="list-profile-list"
                                           data-toggle="list" href="#list-profile" role="tab">Profile</a>
                                        <a class="list-group-item list-group-item-action" id="list-messages-list"
                                           data-toggle="list" href="#list-messages" role="tab">Messages</a>
                                        <a class="list-group-item list-group-item-action" id="list-settings-list"
                                           data-toggle="list" href="#list-settings" role="tab">Settings</a>
                                    </div>
                                </div>
                                <div class="col-10">
                                    <div class="tab-content" id="nav-tabContent">
                                        @include('admin.payment-settings.sections.paypal-setting')
                                        <div class="tab-pane fade" id="list-profile" role="tabpanel"
                                             aria-labelledby="list-profile-list">

                                        </div>
                                        <div class="tab-pane fade" id="list-messages" role="tabpanel"
                                             aria-labelledby="list-messages-list">

                                        </div>
                                        <div class="tab-pane fade" id="list-settings" role="tabpanel"
                                             aria-labelledby="list-settings-list">

                                        </div>
                                    </div>
                                </div>
                            </div>
                        </div>
                    </div>
                </div>

            </div>

        </div>
    </section>
@endsection





