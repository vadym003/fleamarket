@extends('layouts.sitemaster')

@section('content')
<div class="container-fluid">

    <div class="row">
        {{-- <div class="col-md-3">
            <div class="card shadow mb-4">
                <a href="#new_block1" class="d-block card-header py-3" data-toggle="collapse" role="button" aria-expanded="false" aria-controls="collapseCardExample">
                    <h6 class="m-0 font-weight-bold text-primary">Filter</h6>
                </a>
                <div class="card-body" id="new_block1">
                    <div class="row">
                        <div class="col-md-12">
                            <div class="form-group">
                                <label>Title</label>
                                <input type="text" class="form-control" id="title" name="title" value="">                                    
                            </div>                                 
                        </div>
                        <div class="col-md-12">
                            <div class="form-group">
                                <label>Category</label>
                                <select class="form-control" id="category" name="category">
                                    <option value="0">-- Select Category --</option>
                                    <option value="1">Category 1</option>
                                    <option value="2">Category 2</option>
                                    <option value="3">Category 3</option>
                                </select>
                            </div>                 
                        </div>
                        <div class="col-md-6">
                            <div class="form-group">
                                <label>Min Price</label>
                                <input type="number" class="form-control" id="price" name="price" value="">                                    
                            </div> 
                        </div>
                        <div class="col-md-6">
                            <div class="form-group">
                                <label>Max Price</label>
                                <input type="number" class="form-control" id="price" name="price" value="">                                    
                            </div> 
                        </div>
                    </div>
                </div>
            </div>
        </div> --}}

        <div class="col-lg-12">
            <div class="card shadow mb-4">
                <div class="d-flex justify-content-between align-items-center card-header py-2" role="button" aria-expanded="false" aria-controls="collapseCardExample">
                    <div class="d-flex flex-row gap-1 align-items-center">
                        <h6 class="m-0 font-weight-bold text-primary">Top results</h6>
                        <h6 class="m-0 text-secondary">1-20 of 1K results</h6>
                    </div>
                    <a href="/jobs/post" class="btn btn-primary px-4 py-2">Post a job</a>
                </div>
                <div class="card-body p-0" id="new_block2">
                    @foreach($jobs as $job)
                        <div class="d-flex flex-column gap-3 job-board">
                            <div class="d-flex align-items-center justify-content-between">
                                <div class="d-flex align-items-center gap-4">
                                    <a href="/jobs/{{$job->id}}/edit"><h5 class="m-0 font-weight-bold text-primary">{{ $job->title }}</h6></a>
                                    <div class="px-3 py-1 status {{ $job->status == "Open" ? 'open-status' : ($job->status == "Complete" ? 'complete-status' : 'progress-status') }}">{{ $job->status }}</div>
                                </div>
                                <h6 class="m-0 font-weight-bold created-time">{{ $job->created_at }}</h6>
                            </div>
                            <h6 class="m-0 text-secondary">Budget {{ $job->price }} USD</h6>
                            <h6 class="m-0 text-secondary job-description">{{ $job->description }} 
                                {{-- <span class="text-primary more-button">more</span> --}}
                            </h6>
                            <div class="d-flex justify-content-between align-items-center">
                                <h6 class="m-0 partticipants-num">
                                    Number of participants: <span class="text-primary">{{ $job->participants_num }}</span>
                                </h6>
                                <div class="d-flex align-items-center gap-4">
                                    <h6>Posted by <a href=""><span class="text-primary">{{ $job->name }}</span></a></h6>
                                    <h6>Deadline: <span class="text-primary">{{ $job->deadline }}</span></h6>
                                </div>
                            </div>
                        </div>
                    @endforeach
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