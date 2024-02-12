@extends('layouts.adminmaster')

@section('content')
<div class="container-fluid">
    <!-- Page Heading -->
    <div class="d-sm-flex align-items-center justify-content-between mb-4">
        <h1 class="h3 mb-0 text-gray-800">Job</h1>
        <a href="#" class="d-none d-sm-inline-block btn btn-sm btn-primary shadow-sm"><i
                class="fas fa-download fa-sm text-white-50"></i> Generate Report</a>
    </div>
    <!-- Content Row -->
    <div class="row">
        <div class="col-md-12">
            <div class="card shadow mb-4">
                <!-- Card Header - Dropdown -->
                <a href="#categorytable_block" class="d-block card-header py-3" data-toggle="collapse" role="button" aria-expanded="true" aria-controls="collapseCardExample">
                    <h6 class="m-0 font-weight-bold text-primary"><?php echo __('Job List');?></h6>
                </a>
                <!-- Card Body -->
                <div class="card-body" id="categorytable_block">
                    <div class="table-responsive">
                        <table class="table table-bordered" id="dataTable" width="100%" cellspacing="0">
                            <thead class="bg-gradient-light">
                                <tr>
                                    <th>No</th>
                                    <th>Title</th>
                                    <th>ID</th>
                                    <th>Allow</th>
                                </tr>
                            </thead>
                            <tbody>
                                @foreach($jobs as $index => $job)
                                <tr>
                                    <td>
                                        {{$index+1}}
                                    </td>
                                    <td>
                                        {{$job->title}}
                                    </td>
                                    <td>
                                        {{$job->id}}
                                    </td>
                                    <td>
                                        @if ($job->isAllowed == 0)
                                        <button class="btn btn-primary btn-block" onclick="allowJob({{ $job->id }})">Allow</button>
                                        @endif
                                    </td>
                                </tr>
                                @endforeach
                            </tbody>
                        </table>
                    </div>
                    <div class="d-felx justify-content-center">
                        {{ $jobs->links() }}
                    </div>
                </div>
            </div>
        </div>
    </div>
</div>
@endsection

@section('page-script')
<script type="text/javascript">

    function allowJob(jobId) {
        $.ajax({
            url: `/admin/jobs/${jobId}`,
            type: 'post',
            headers: {
                'X-CSRF-TOKEN': '{{ csrf_token() }}'
            },
            success: function(data) {
                console.log(data);
                window.location.href = '/admin/jobs';
            },
            error: function(error) {
                console.log(error);
            }
        });
    }

</script>
@stop