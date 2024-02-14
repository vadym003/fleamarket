@extends('layouts.adminmaster')

@section('content')
<div class="container-fluid">
    <!-- Page Heading -->
    <div class="d-sm-flex align-items-center justify-content-between mb-4">
        <h1 class="h3 mb-0 text-gray-800">Users</h1>
        <!-- <a href="#" class="d-none d-sm-inline-block btn btn-sm btn-primary shadow-sm"><i
                class="fas fa-download fa-sm text-white-50"></i> Generate Report</a> -->
    </div>
    <!-- Content Row -->
    <div class="row d-flex justify-content-center">
        <div class="col-sm-12">
            <div class="card shadow mb-4">
                <!-- Card Header - Dropdown -->
                <!-- Card Body -->
                <div class="card-body" id="categorytable_block">
                    <div class="table-responsive">
                        <table class="table table-bordered" id="dataTable" width="100%" cellspacing="0">
                            <thead class="bg-gradient-light">
                                <tr>
                                    <th>User Name</th>
                                    <th>Email</th>
                                    <th>Phone</th>
                                    <th>Address</th>
                                    <th>Action</th>
                                </tr>
                            </thead>
                            <tbody>
                                @foreach($users as $data)
                                <tr>
                                    <td>
                                        {{$data->name}}
                                    </td>
                                    <td>
                                        {{$data->email}}
                                    </td>
                                    <td>
                                        {{$data->phone}}
                                    </td>
                                    <td>
                                        {{$data->address}}
                                    </td>
                                    <td>
                                        <button type="button" class="btn btn-primary" onclick="editmodalshow('{{$data->id}}');">Delete</button>
                                    </td>
                                </tr>
                                @endforeach
                            </tbody>
                        </table>
                    </div>
                    <div class="d-felx justify-content-center">
                        {{ $users->links() }}
                    </div>
                </div>
            </div>
        </div>
    </div>
</div>
@endsection
@section('page-css')
<style>
.user-card-full {
    overflow: hidden;
}
.card {
    border-radius: 5px;
    -webkit-box-shadow: 0 1px 20px 0 rgba(69, 90, 100, 0.08);
    box-shadow: 0 1px 20px 0 rgba(69, 90, 100, 0.08);
    border: none;
    margin-bottom: 30px
}
.m-r-0 {
    margin-right: 0px
}
.m-l-0 {
    margin-left: 0px
}
.user-card-full .user-profile {
    border-radius: 5px 0 0 5px
}
.bg-c-lite-green {
    background: linear-gradient(to right, #185A91, #3498DA)
}
.user-profile {
    padding: 20px 0
}
.card-block {
    padding: 1.25rem
}
.m-b-25 {
    margin-bottom: 25px
}
.img-radius {
    border-radius: 5px;
    width:100%;
}
h6 {
    font-size: 14px
}
.card .card-block p {
    line-height: 25px
}

@media only screen and (min-width: 1400px) {
    p {
        font-size: 14px
    }
}
.card-block {
    padding: 1.25rem
}
.b-b-default {
    border-bottom: 1px solid #e0e0e0
}
.m-b-20 {
    margin-bottom: 20px
}
.p-b-5 {
    padding-bottom: 5px !important
}
.card .card-block p {
    line-height: 25px
}
.m-b-10 {
    margin-bottom: 10px
}
.text-muted {
    color: #919aa3 !important
}
.b-b-default {
    border-bottom: 1px solid #e0e0e0
}
.f-w-600 {
    font-weight: 600
}
.m-b-20 {
    margin-bottom: 20px
}
.m-t-40 {
    margin-top: 20px
}
.p-b-5 {
    padding-bottom: 5px !important
}
.m-b-10 {
    margin-bottom: 10px
}
.m-t-40 {
    margin-top: 20px
}
</style>
@stop
@section('page-script')
<script type="text/javascript">
</script>
@stop
