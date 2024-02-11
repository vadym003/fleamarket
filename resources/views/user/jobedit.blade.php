@extends('layouts.sitemaster')

@section('content')
<div class="container-fluid">
    <div class="row">
        <div class="col-xl-12">
            <div class="card shadow mb-4">
                <a href="#new_block3" class="d-block card-header py-3" data-toggle="collapse" role="button" aria-expanded="false" aria-controls="collapseCardExample">
                    <h6 class="m-0 font-weight-bold text-primary">Edit a job</h6>
                </a>
                <div class="card-body position-relative" id="new_block3">
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
                    <form role="form" method="post" action="{{ route('jobs.update', $job->id) }}" accept-charset="UTF-8" enctype="multipart/form-data">
                        @csrf
                        @method('put')
                        <div class="row">
                            <div class="col-md-12">
                                <div class="form-group">
                                    <label>Job Title</label>
                                    <input type="text" class="form-control" id="title" name="title" value="{{ $job->title }}">                                    
                                </div>                                 
                            </div>
                            <div class="col-md-12">
                                <div class="form-group">
                                    <label>Job Desctiption</label>
                                    <textarea class="form-control" id="description" rows="4" name="description">{{ $job->description }}</textarea>                                    
                                </div> 
                            </div>
                            <div class="col-md-12">
                                <div class="form-group">
                                    <label>Category</label>
                                    <select class="form-control" id="category" name="category">
                                        <option value="">-- Select Category --</option>
                                        @foreach($categories as $category)
                                            <option value="{{ $category->catid }}" selected="{{ $job->category_id == $category->catid ? 'true' : 'false' }}">{{ $category->cat_name }}</option>
                                        @endforeach
                                    </select>
                                </div>                 
                            </div>
                            <div class="col-md-12">
                                <div class="form-group">
                                    <label>Price</label>
                                    <input type="number" class="form-control" id="price" name="price" value="{{ $job->price }}">                                    
                                </div> 
                            </div>
                            <div class="col-md-12">
                                <div class="form-group">
                                    <label>Number of Participants</label>
                                    <input type="number" class="form-control" id="participants_num" name="participants_num" value="{{ $job->participants_num }}">                                 
                                </div>                                 
                            </div>
                            <div class="col-md-12">
                                <div class="form-group">
                                    <label>Deadline</label>
                                    <input type="date" class="form-control" id="deadline" name="deadline" value="{{ $job->deadline }}">                                    
                                </div> 
                            </div>
                        </div>
                        
                        <div class="d-flex align-items-center gap-4">
                            <button type="submit" class="btn btn-primary px-4">Update</button>
                            <a href="/jobs" class="btn btn-secondary px-4">Cancel</a>
                        </div>
                    </form>
                    <form class="deleteForm" role="form" method="post" action="{{ route('jobs.destroy', $job->id) }}" accept-charset="UTF-8">
                        @csrf
                        @method('delete')
                        <button class="btn btn-danger px-4">Delete</button>
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