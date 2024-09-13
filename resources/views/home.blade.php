@extends('layouts.master')

@section('content')
    <!-- seo start -->
    <div class="col-xl-4 col-md-12">
        <div class="card">
            <div class="card-body">
                <div class="row align-items-center">
                    <div class="col-6">
                        <h3>$16,756</h3>
                        <h6 class="text-muted m-b-0">Visits<i class="fa fa-caret-down text-c-red m-l-10"></i></h6>
                    </div>
                    <div class="col-6">
                        <div id="seo-chart1" class="d-flex align-items-end"></div>
                    </div>
                </div>
            </div>
        </div>
    </div>
    <div class="col-xl-4 col-md-6">
        <div class="card">
            <div class="card-body">
                <div class="row align-items-center">
                    <div class="col-6">
                        <h3>49.54%</h3>
                        <h6 class="text-muted m-b-0">Bounce Rate<i class="fa fa-caret-up text-c-green m-l-10"></i></h6>
                    </div>
                    <div class="col-6">
                        <div id="seo-chart2" class="d-flex align-items-end"></div>
                    </div>
                </div>
            </div>
        </div>
    </div>
    <div class="col-xl-4 col-md-6">
        <div class="card">
            <div class="card-body">
                <div class="row align-items-center">
                    <div class="col-6">
                        <h3>1,62,564</h3>
                        <h6 class="text-muted m-b-0">Products<i class="fa fa-caret-down text-c-red m-l-10"></i></h6>
                    </div>
                    <div class="col-6">
                        <div id="seo-chart3" class="d-flex align-items-end"></div>
                    </div>
                </div>
            </div>
        </div>
    </div>
    <!-- seo end -->

    <!-- Latest Customers start -->
    <div class="col-lg-8 col-md-12">
            <div class="card table-card">
                <div class="card-header">
                    <h5>Projects</h5>
                    <div class="card-header-right">
                        <div class="btn-group card-option">
                            <button type="button" class="btn dropdown-toggle" data-toggle="dropdown" aria-haspopup="true" aria-expanded="false">
                                <i class="feather icon-more-horizontal"></i>
                            </button>
                            <ul class="list-unstyled card-option dropdown-menu dropdown-menu-right">
                                <li class="dropdown-item full-card"><a href="#!"><span><i class="feather icon-maximize"></i> maximize</span><span style="display:none"><i class="feather icon-minimize"></i> Restore</span></a></li>
                                <li class="dropdown-item minimize-card"><a href="#!"><span><i class="feather icon-minus"></i> collapse</span><span style="display:none"><i class="feather icon-plus"></i> expand</span></a></li>
                                <li class="dropdown-item reload-card"><a href="#!"><i class="feather icon-refresh-cw"></i> reload</a></li>
                                <li class="dropdown-item close-card"><a href="#!"><i class="feather icon-trash"></i> remove</a></li>
                            </ul>
                        </div>
                    </div>
                </div>
                <div class="card-body p-0">
                    <div class="table-responsive">
                        <table class="table table-hover mb-0">
                            <thead>
                                <tr>
                                    <th>
                                        <div class="chk-option">
                                            <label class="check-task custom-control custom-checkbox d-flex justify-content-center done-task">
                                                <input type="checkbox" class="custom-control-input">
                                                <span class="custom-control-label"></span>
                                            </label>
                                        </div>
                                        Assigned
                                    </th>
                                    <th>Name</th>
                                    <th>Due Date</th>
                                    <th class="text-right">Priority</th>
                                </tr>
                            </thead>
                            <tbody>
                                <tr>
                                    <td>
                                        <div class="chk-option">
                                            <label class="check-task custom-control custom-checkbox d-flex justify-content-center done-task">
                                                <input type="checkbox" class="custom-control-input">
                                                <span class="custom-control-label"></span>
                                            </label>
                                        </div>
                                        <div class="d-inline-block align-middle">
                                            <img src="{{ asset('template/dist/assets/images/user/avatar-4.jpg') }}" alt="user image" class="img-radius wid-40 align-top m-r-15">
                                            <div class="d-inline-block">
                                                <h6>John Deo</h6>
                                                <p class="text-muted m-b-0">Graphics Designer</p>
                                            </div>
                                        </div>
                                    </td>
                                    <td>Able Pro</td>
                                    <td>Jun, 26</td>
                                    <td class="text-right"><label class="badge badge-light-danger">Low</label></td>
                                </tr>
                                <tr>
                                    <td>
                                        <div class="chk-option">
                                            <label class="check-task custom-control custom-checkbox d-flex justify-content-center done-task">
                                                <input type="checkbox" class="custom-control-input">
                                                <span class="custom-control-label"></span>
                                            </label>
                                        </div>
                                        <div class="d-inline-block align-middle">
                                            <img src="{{ asset('template/dist/assets/images/user/avatar-2.jpg') }}" alt="user image" class="img-radius wid-40 align-top m-r-15">
                                            <div class="d-inline-block">
                                                <h6>Jenifer Vintage</h6>
                                                <p class="text-muted m-b-0">Web Designer</p>
                                            </div>
                                        </div>
                                    </td>
                                    <td>Mashable</td>
                                    <td>March, 31</td>
                                    <td class="text-right"><label class="badge badge-light-primary">high</label></td>
                                </tr>
                                <tr>
                                    <td>
                                        <div class="chk-option">
                                            <label class="check-task custom-control custom-checkbox d-flex justify-content-center done-task">
                                                <input type="checkbox" class="custom-control-input">
                                                <span class="custom-control-label"></span>
                                            </label>
                                        </div>
                                        <div class="d-inline-block align-middle">
                                            <img src="{{ asset('template/dist/assets/images/user/avatar-3.jpg') }}" alt="user image" class="img-radius wid-40 align-top m-r-15">
                                            <div class="d-inline-block">
                                                <h6>William Jem</h6>
                                                <p class="text-muted m-b-0">Developer</p>
                                            </div>
                                        </div>
                                    </td>
                                    <td>Flatable</td>
                                    <td>Aug, 02</td>
                                    <td class="text-right"><label class="badge badge-light-success">medium</label></td>
                                </tr>
                                <tr>
                                    <td>
                                        <div class="chk-option">
                                            <label class="check-task custom-control custom-checkbox d-flex justify-content-center done-task">
                                                <input type="checkbox" class="custom-control-input">
                                                <span class="custom-control-label"></span>
                                            </label>
                                        </div>
                                        <div class="d-inline-block align-middle">
                                            <img src="{{ asset('template/dist/assets/images/user/avatar-2.jpg') }}" alt="user image" class="img-radius wid-40 align-top m-r-15">
                                            <div class="d-inline-block">
                                                <h6>David Jones</h6>
                                                <p class="text-muted m-b-0">Developer</p>
                                            </div>
                                        </div>
                                    </td>
                                    <td>Guruable</td>
                                    <td>Sep, 22</td>
                                    <td class="text-right"><label class="badge badge-light-primary">high</label></td>
                                </tr>
                            </tbody>
                        </table>
                    </div>
                </div>
            </div>
    </div>
    <div class="col-lg-4 col-md-12">

        <div class="card">
                <div class="card-body">
                    <h5 class="mb-3">Total Leads</h5>
                    <p class="text-c-green f-w-500"><i class="fa fa-caret-up m-r-15"></i> 18% High than last month</p>
                    <div class="row">
                        <div class="col-4 b-r-default">
                            <p class="text-muted m-b-5">Overall</p>
                            <h5>76.12%</h5>
                        </div>
                        <div class="col-4 b-r-default">
                            <p class="text-muted m-b-5">Monthly</p>
                            <h5>16.40%</h5>
                        </div>
                        <div class="col-4">
                            <p class="text-muted m-b-5">Day</p>
                            <h5>4.56%</h5>
                        </div>
                    </div>
                </div>
                <div id="tot-lead" style="height:150px"></div>
            </div>
    </div>
    <!-- Latest Customers end -->
@endsection

@section('script')

<!-- Apex Chart -->
<script src="{{ asset('template/dist/assets/js/plugins/apexcharts.min.js') }}"></script>
<!-- custom-chart js -->
<script src="{{ asset('template/dist/assets/js/pages/dashboard-main.js') }}"></script>

@endsection
