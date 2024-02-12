@extends('layouts.sitemaster')

@section('content')
<div class="container-fluid">
    <div class="row">
        <div class="col-lg-12">
            <div class="card shadow mb-4">
                <div class="d-flex justify-content-between align-items-center card-header py-2" role="button" aria-expanded="false" aria-controls="collapseCardExample">
                    <div class="d-flex flex-row gap-1 align-items-center">
                        <h6 class="m-0 font-weight-bold text-primary">Top results</h6>
                        <h6 class="m-0 text-secondary">{{ $jobs->firstItem() }}-{{ $jobs->lastItem() }} of {{ $jobs->total() }} results</h6>
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
                            <h6 class="m-0 text-secondary job-description">
                                {{ $job->description }} 
                                {{-- <span class="text-primary more-button">more</span> --}}
                            </h6>
                            <div class="d-flex justify-content-between align-items-center">
                                <h6 class="m-0 participants-num">
                                    Number of participants: <span class="text-primary">{{ $job->participants_num }}</span>
                                </h6>
                                <div class="d-flex align-items-center gap-4">
                                    <h6>Posted by <a href=""><span class="text-primary">{{ $job->name }}</span></a></h6>
                                    <h6>Deadline: <span class="text-primary">{{ $job->deadline }}</span></h6>
                                </div>
                            </div>
                        </div>
                    @endforeach
                    <div class="pagenation">
                        {{ $jobs->links() }}
                    </div>
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