@extends('layouts.sitemaster')

@section('content')
<div class="container-fluid">
    <!-- Page Heading -->
    <div class="d-sm-flex align-items-center justify-content-between mb-4">
        <h1 class="h3 mb-0 text-gray-800">User Account</h1>
        <!-- <a href="#" class="d-none d-sm-inline-block btn btn-sm btn-primary shadow-sm"><i
                class="fas fa-download fa-sm text-white-50"></i> Generate Report</a> -->
    </div>
    <!-- Content Row -->
    <div class="row d-flex justify-content-center">
        <div class="col-xl-12 col-md-12">
            <div class="">
                <form role="form" method="post" action="{{ route('account.update') }}" accept-charset="UTF-8"  method="post" enctype="multipart/form-data">
                    @csrf
                    <div class="row m-l-0 m-r-0">
                        <div class="col-sm-4 ">
                            <div class=" card shadow mb-4 text-center">
                                <div class="card-body">
                                    <div class="m-b-25"> 
                                        <?php if(auth()->user()->image == ""){ ?>
                                        <img src="{{asset('admin/img/undraw_profile.svg')}}" class="img-radius" alt="User-Profile-Image"> 
                                        <?php }else{ ?>
                                        <img src="/profile/{{ auth()->user()->image}}" class="img-radius" alt="User-Profile-Image"> 
                                        <?php } ?>
                                    </div>
                                    <h5 class="f-w-600">{{auth()->user()->name}}</h5>
                                    <?php if(auth()->user()->adminflg != 1){ ?>
                                    <p>User Acount</p> 
                                    <?php }else{ ?>
                                    <p>Admin Acount</p> 
                                    <?php } ?>
                                    <div class="form-group">
                                        <label for="file-multiple-input">Click here to update photo</label>
                                        <input id="file-multiple-input" name="avatar" multiple="" type="file" class="form-control-file">
                                    </div>
                                </div>
                            </div>
                        </div>
                        <div class="col-sm-8">
                            <div class="card shadow mb-4 ">
                                <div class="card-body">                                    
                                    <h5 class="m-b-20 p-b-5 b-b-default f-w-600">Information</h5>
                                    <input class="form-control" type="hidden" id="userid" name="userid" value="{{auth()->user()->id}}">
                                    @if(session('status'))
                                        <div class="alert alert-success">
                                            {{ session('status') }}
                                        </div>
                                    @endif
                                    @if ($errors->any())
                                        <div class="alert alert-danger">
                                            <ul>
                                                @foreach ($errors->all() as $error)
                                                    <li>{{ $error }}</li>
                                                @endforeach
                                            </ul>
                                        </div>
                                    @endif
                                    <div class="row">
                                        <div class="col-sm-6">
                                            <div class="form-group">
                                                <label>User Name</label>
                                                <input class="form-control" id="username" name="username" value="{{auth()->user()->name}}">
                                            </div>
                                        </div>
                                        <div class="col-sm-6">
                                            <div class="form-group">
                                                <label>Email</label>
                                                <input class="form-control" id="email" name="email" value="{{auth()->user()->email}}">
                                            </div>
                                        </div>
                                    </div>
                                    <div class="row">
                                        <div class="col-sm-6">
                                            <div class="form-group">
                                                <label>Phone</label>
                                                <input class="form-control" id="phone" name="phone" value="{{auth()->user()->phone}}">
                                            </div>
                                        </div>
                                        <div class="col-sm-6">
                                            <div class="form-group">
                                                <label>Wallet</label>
                                                <input class="form-control" id="price" name="price" value="{{auth()->user()->price}}" disabled>
                                            </div>
                                        </div>
                                    </div>
                                    <div class="row">
                                        <div class="col-sm-12">
                                            <div class="form-group">
                                                <label>Address</label>
                                                <input class="form-control" id="address" name="address" value="{{auth()->user()->address}}">
                                            </div>
                                        </div>
                                    </div>
                                    <div class="row">
                                        <div class="col-sm-4">
                                            <button type="submit" class="btn btn-primary w-100" tabindex="4">Update</button>
                                        </div>
                                        <div class="col-sm-4">
                                            <button type="button" class="btn btn-primary w-100" tabindex="4">Change password</button>
                                        </div>
                                        <div class="col-sm-4">
                                            <a href="logout" class="btn btn-primary w-100">Logout</a>
                                        </div>
                                    </div>
                                </div>
                            </div>
                        </div>
                    </div>
                </form>
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
