@extends('dashboard.admin.layouts.includes')
@section('content')
<style>
    .dropdown-menu {
        min-width: 5.4rem !important;
    }
    .prjectDiv{
     margin-top: 6%;
 }
@media only screen and (max-width: 600px) {
 .prjectDiv{
     margin-top: 20%;
 }
}
</style>
<!-- Page wrapper  -->
<div class="page-wrapper">
    <!-- Container fluid  -->
    <div class="container-fluid">
        <!-- Bread crumb and right sidebar toggle -->
        <div class="row page-titles">
            <div class="col-md-5 col-8 align-self-center">
                <h3 class="text-themecolor">Dashboard</h3>
                <ol class="breadcrumb">
                    <li class="breadcrumb-item"><a href="{{route('admin.dashboard')}}">Dashboard</a></li>
                    <li class="breadcrumb-item"><a href="#">Work</a></li>
                    <li class="breadcrumb-item active">Projects</li>
                </ol>
            </div>
            <div class="col-md-7 col-4 align-self-center">
                <div class="d-flex m-t-10 justify-content-end">
                    <div class="d-flex m-r-20 m-l-10 hidden-md-down">
                        <div class="chart-text m-r-10">
                            <h6 class="m-b-0"><small>THIS MONTH</small></h6>
                            <h4 class="m-t-0 text-info">$58,356</h4>
                        </div>
                        <div class="spark-chart">
                            <div id="monthchart"></div>
                        </div>
                    </div>
                    <div class="d-flex m-r-20 m-l-10 hidden-md-down">
                        <div class="chart-text m-r-10">
                            <h6 class="m-b-0"><small>LAST MONTH</small></h6>
                            <h4 class="m-t-0 text-primary">$48,356</h4>
                        </div>
                        <div class="spark-chart">
                            <div id="lastmonthchart"></div>
                        </div>
                    </div>
                    <div class="">
                        <button
                            class="right-side-toggle waves-effect waves-light btn-success btn btn-circle btn-sm pull-right m-l-10"><i
                                class="ti-settings text-white"></i></button>
                    </div>
                </div>
            </div>
        </div>
        <!-- End Bread crumb and right sidebar toggle -->
        <!-- .right-sidebar -->
        <div class="right-sidebar">
            <div class="slimscrollright">
                <div class="rpanel-title"> Service Panel <span><i class="ti-close right-side-toggle"></i></span> </div>
                <div class="r-panel-body">
                    <ul id="themecolors" class="m-t-20">
                        <li><b>With Light sidebar</b></li>
                        <li><a href="javascript:void(0)" data-theme="default" class="default-theme">1</a></li>
                        <li><a href="javascript:void(0)" data-theme="green" class="green-theme">2</a></li>
                        <li><a href="javascript:void(0)" data-theme="red" class="red-theme">3</a></li>
                        <li><a href="javascript:void(0)" data-theme="blue" class="blue-theme working">4</a></li>
                        <li><a href="javascript:void(0)" data-theme="purple" class="purple-theme">5</a></li>
                        <li><a href="javascript:void(0)" data-theme="megna" class="megna-theme">6</a></li>
                        <li class="d-block m-t-30"><b>With Dark sidebar</b></li>
                        <li><a href="javascript:void(0)" data-theme="default-dark" class="default-dark-theme">7</a></li>
                        <li><a href="javascript:void(0)" data-theme="green-dark" class="green-dark-theme">8</a></li>
                        <li><a href="javascript:void(0)" data-theme="red-dark" class="red-dark-theme">9</a></li>
                        <li><a href="javascript:void(0)" data-theme="blue-dark" class="blue-dark-theme">10</a></li>
                        <li><a href="javascript:void(0)" data-theme="purple-dark" class="purple-dark-theme">11</a></li>
                        <li><a href="javascript:void(0)" data-theme="megna-dark" class="megna-dark-theme ">12</a></li>
                    </ul>
                    <ul class="m-t-20 chatonline">
                        <li><b>Chat option</b></li>
                        <li>
                            <a href="javascript:void(0)"><img src="../assets/images/users/1.jpg" alt="user-img"
                                    class="img-circle"> <span>Varun Dhavan <small
                                        class="text-success">online</small></span></a>
                        </li>
                        <li>
                            <a href="javascript:void(0)"><img src="../assets/images/users/2.jpg" alt="user-img"
                                    class="img-circle"> <span>Genelia Deshmukh <small
                                        class="text-warning">Away</small></span></a>
                        </li>
                        <li>
                            <a href="javascript:void(0)"><img src="../assets/images/users/3.jpg" alt="user-img"
                                    class="img-circle"> <span>Ritesh Deshmukh <small
                                        class="text-danger">Busy</small></span></a>
                        </li>
                        <li>
                            <a href="javascript:void(0)"><img src="../assets/images/users/4.jpg" alt="user-img"
                                    class="img-circle"> <span>Arijit Sinh <small
                                        class="text-muted">Offline</small></span></a>
                        </li>
                        <li>
                            <a href="javascript:void(0)"><img src="../assets/images/users/5.jpg" alt="user-img"
                                    class="img-circle"> <span>Govinda Star <small
                                        class="text-success">online</small></span></a>
                        </li>
                        <li>
                            <a href="javascript:void(0)"><img src="../assets/images/users/6.jpg" alt="user-img"
                                    class="img-circle"> <span>John Abraham<small
                                        class="text-success">online</small></span></a>
                        </li>
                        <li>
                            <a href="javascript:void(0)"><img src="../assets/images/users/7.jpg" alt="user-img"
                                    class="img-circle"> <span>Hritik Roshan<small
                                        class="text-success">online</small></span></a>
                        </li>
                        <li>
                            <a href="javascript:void(0)"><img src="../assets/images/users/8.jpg" alt="user-img"
                                    class="img-circle"> <span>Pwandeep rajan <small
                                        class="text-success">online</small></span></a>
                        </li>
                    </ul>
                </div>
            </div>
        </div>
        <!-- End Right sidebar -->
        <!-- Start Page Content -->
        <div class="row">
            <div class="col-12">
                <div class="card">
                    <div class="card-body">
                        <h4 class="card-title">Projects</h4>
                        <div class="dropdown">
                            <a href="#" type="button" class="btn btn-info t-10 float-right" data-toggle="dropdown" style="font-size: 12px"
                                aria-haspopup="true" aria-expanded="false"><i class="ti-download" style="font-size: 12px"></i> Export</a>
                            <div class="dropdown-menu" aria-labelledby="dropdownMenuButton" style="width:10px">
                                <a class="dropdown-item text-dark" href="{{route('admin.project.export')}}"
                                    style="font-size: 12px"><i class="fa fa-file-excel" style="font-size: 12px"></i>
                                    Excel</a>
                                <a class="dropdown-item  text-dark" href=""
                                    style="font-size: 12px"><i class="fa fa-file-excel" style="font-size: 12px"></i>
                                    CSV</a>

                            </div>
                        </div>
                        <a href="{{route('admin.project.create')}}" type="button"
                            class="btn btn-outline-success t-10 float-right" style="margin-right: 10px;font-size: 12px"><i
                                class="ti-plus" style="font-size: 12px"></i> New</a>
                        {{-- <a href="" type="button"
                            class="btn btn-outline-primary t-10 float-right" style="margin-right: 10px"><i
                                class="mdi mdi-plus"></i> Project Templates</a> --}}
                                <a href="{{route('admin.projects.archive')}}" type="button"
                            class="btn btn-outline-warning t-10 float-right" style="margin-right: 10px;font-size: 12px"><i
                                class="ti-trash" style="font-size: 12px"></i> View Archive</a>
                           {{-- <a href="" type="button"
                            class="btn btn-outline-info t-10 float-right" style="margin-right: 10px"><i class="mdi mdi-pin" style="font-size: 14px"></i> Pinned Project</a> --}}
                        <div class="row justify-content-center prjectDiv" >
                            <div class="col-md-3 col-xs-6 b-r mb-2"> <span
                                    class="btn btn-circle  btn-info text-white">{{count($projects)}}</span> <strong>Total Projects</strong>

                            </div>
                            <div class="col-md-3 col-xs-6 b-r mb-2"><span
                                    class="btn btn-circle  btn-warning text-white">{{count($underReviewProjects)}}</span>
                                <strong>Overdue Projects</strong>

                            </div>
                            <div class="col-md-3 col-xs-6"><span
                                    class="btn btn-circle  btn-success text-white">{{count($noStartedProjects)}}</span>
                                <strong>Not Started Projects</strong>

                            </div>
                        </div>
                            <div class="row justify-content-center" style="margin-top: 2%">
                            <div class="col-md-3 col-xs-6 b-r mb-2"> <span
                                    class="btn btn-circle text-white" style="background-color: #12c4f1">{{count($completedProjects)}}</span> <strong>Completed Projects</strong>

                            </div>
                            <div class="col-md-3 col-xs-6 b-r mb-2"><span
                                    class="btn btn-circle text-white" style="background-color: #33cea8">{{count($inProgressProjects)}}</span>
                                <strong>In Progress Projects</strong>

                            </div>
                            <div class="col-md-3 col-xs-6"><span
                                    class="btn btn-circle  btn-primary text-white">{{count($canceledProjects)}}</span>
                                <strong>Canceled Projects</strong>

                            </div>
                        </div>
                        <div class="table-responsive m-t-40">

                            <table id="example23" class="display nowrap table table-hover table-striped table-bordered"
                                cellspacing="0" width="100%">
                                <thead>
                                    <tr>
                                        <th>#</th>
                                        <th>Project Name</th>
                                        <th>Members</th>
                                        <th>Dedline</th>
                                        <th>Client</th>
                                        <th>Completions</th>
                                        <th>Status</th>
                                        <th>Action</th>
                                    </tr>
                                </thead>
                                <tbody>

                                    @foreach ($projects as $key=>$value)
                                    <tr>
                                        <td>{{$loop->iteration}}</td>
                                        <td>{{$value->project_name}}</td>
                                        <td>
                                            @forelse($value->members as $item)
                                            <img data-toggle="tooltip" data-original-title="{{ ucwords($item->user->name) }}"
                                                src="{{asset($item->user->image) }}" alt="user" class="img-circle" width="30"
                                                height="30">
                                                
                                            @empty
                                            No record found
                                            @endforelse
                                        </td>
                                        <td>{{$value->deadline != null?  date_format($value->deadline,"d/m/Y") : 'No Deadline'}}</td>
                                        <td>{{$value->client->name}}</td>
                                        <td>
                                            <p>Progress &nbsp;<small class="pull-right">{{$value->completion_percent}}%</small></p>
                                        <div class="progress ">
                                            <div class="progress-bar bg-danger wow animated progress-animated" style="width: {{$value->completion_percent}}%; height:6px;" role="progressbar"> </div>
                                        </div>
                                        </td>
                                        <td><small
                                                class="label" style="background-color: #edf9f7;color:#33cea8">{{$value->project_status}}</small></td>
                                      
                                        <td class="">
                                            <div class="dropdown">
                                                <button class="btn btn-light" type="button" id="dropdownMenuButton"
                                                    data-toggle="dropdown" aria-haspopup="true" aria-expanded="false">
                                                    <i class="ti-settings" style="font-size: 10px"></i>
                                                </button>
                                                <div class="dropdown-menu" aria-labelledby="dropdownMenuButton">
                                                    <a class="dropdown-item text-dark"
                                                        href="{{route('admin.project.show' , ['id'=>$value->id])}}"
                                                        type="button" style="font-size: 12px;cursor: pointer"><i
                                                            class="ti-eye" style="font-size: 12px"></i> View Details</a>
                                                    <a class="dropdown-item text-dark" type="button"
                                                        style="font-size: 12px; cursor: pointer;"
                                                        href="{{route('admin.project.edit' , ['id'=>$value->id])}}"><i
                                                            class="ti-marker-alt" style="font-size: 12px"></i> Edit</a>
                                                        <a class="dropdown-item text-dark"
                                                        href="{{route('admin.project.show' , ['id'=>$value->id])}}"
                                                        type="button" style="font-size: 12px;cursor: pointer"><i
                                                            class="icon-user-follow" style="font-size: 12px"></i> Add Member</a>
                                                    <a class="dropdown-item text-dark" type="button"
                                                        href="{{route('admin.project.archive' , ['id'=>$value->id])}}"
                                                        id="archivep" style="font-size: 12px;"><i class="ti-trash"
                                                            style="font-size: 12px"></i> Archive</a>
                                                    <a class="dropdown-item text-dark"
                                                        href="{{route('admin.project.delete' , ['id'=>$value->id])}}"
                                                        type="button" style="font-size: 12px" id="delete"><i class="ti-close"
                                                            style="font-size: 12px"></i> Delete</a>
                                                </div>
                                            </div>
                                        </td>
                                    </tr>
                                    @endforeach

                                </tbody>
                            </table>
                        </div>
                    </div>
                </div>
            </div>
        </div>
        <!-- End PAge Content -->
    </div>
    <!-- footer -->
    <footer class="footer">
        © 2021 Webfabricant
    </footer>
    <!-- End footer -->
</div>
<!-- End Page wrapper  -->

<!-- leaD Category modal -->

@endsection
