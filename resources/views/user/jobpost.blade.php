@extends('layouts.sitemaster')

@section('content')
<div class="container-fluid">
    <div class="row">
        <div class="col-xl-12">
            <div class="card shadow mb-4">
                <a href="#new_block3" class="d-block card-header py-3" data-toggle="collapse" role="button" aria-expanded="false" aria-controls="collapseCardExample">
                    <h6 class="m-0 font-weight-bold text-primary">Post a job</h6>
                </a>
                <div class="card-body" id="new_block3">
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
                    <form role="form" method="post" action="{{ route('jobs.store') }}" accept-charset="UTF-8" enctype="multipart/form-data">
                        @csrf
                        <div class="row">
                            <div class="col-md-12">
                                <div class="form-group">
                                    <label>Job Title</label>
                                    <input type="text" class="form-control" id="title" name="title" value="">                                    
                                </div>                                 
                            </div>
                            <div class="col-md-12">
                                <div class="form-group">
                                    <label>Job Desctiption</label>
                                    <textarea class="form-control" id="description" rows="4" name="description"></textarea>                                    
                                </div> 
                            </div>
                            <div class="col-md-12">
                                <div class="form-group">
                                    <label>Category</label>
                                    <select class="form-control" id="category" name="category">
                                        <option value="">-- Select Category --</option>
                                        @foreach($categories as $category)
                                            <option value="{{ $category->catid }}">{{ $category->cat_name }}</option>
                                        @endforeach
                                    </select>
                                </div>                 
                            </div>
                            <div class="col-md-12">
                                <div class="form-group">
                                    <label>Price</label>
                                    <input type="number" class="form-control" id="price" name="price" value="">                                    
                                </div> 
                            </div>
                            <div class="col-md-12">
                                <div class="form-group">
                                    <label>Number of Participants</label>
                                    <input type="number" class="form-control" id="participants_num" name="participants_num">                                    
                                </div>                                 
                            </div>
                            <div class="col-md-12">
                                <div class="form-group">
                                    <label>Deadline</label>
                                    <input type="date" class="form-control" id="deadline" name="deadline" value="">                                    
                                </div> 
                            </div>
                        </div>
                        
                        <div class="row">
                            <div class="col-md-6 pt-3">
                                <button type="submit" class="btn btn-primary btn-block">Submit</button>
                            </div>
                            <div class="col-md-6 pt-3">
                                <a href="/jobs" class="btn btn-secondary btn-block">Cancel</a>
                            </div>
                        </div>
                    </form>

                </div>
            </div>
        </div>
    </div>
</div>
@endsection

@section('page-css')
<link href="{{ asset('css/job.css') }}" rel="stylesheet">
@stop


@section('page-script')
<script type="text/javascript">

</script>
@stop