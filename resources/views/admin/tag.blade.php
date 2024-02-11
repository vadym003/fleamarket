@extends('layouts.adminmaster')

@section('content')
<div class="container-fluid">
    <!-- Page Heading -->
    <div class="d-sm-flex align-items-center justify-content-between mb-4">
        <h1 class="h3 mb-0 text-gray-800">Tag</h1>
        <a href="#" class="d-none d-sm-inline-block btn btn-sm btn-primary shadow-sm"><i
                class="fas fa-download fa-sm text-white-50"></i> Generate Report</a>
    </div>
    <!-- Content Row -->
    <div class="row">
        <!-- Pie Chart -->
        <div class="col-xl-4 col-lg-5">
            <div class="card shadow mb-4">
                <!-- Card Header - Dropdown -->
                <a href="#newcat_block" class="d-block card-header py-3" data-toggle="collapse" role="button" aria-expanded="true" aria-controls="collapseCardExample">
                    <h6 class="m-0 font-weight-bold text-primary">New Tag</h6>
                </a>
                <!-- Card Body -->
                <div class="card-body" id="newcat_block">
                @if(session('status'))
                    <div class="alert alert-success">
                        {{ session('status') }}
                    </div>
                @endif
                    <form role="form" method="post" action="{{ route('adminTag.add') }}" accept-charset="UTF-8">
                        @csrf
                        <div class="form-group">
                            <label>Tag Name</label>
                            <input class="form-control" id="tag_name" name="tag_name" value="">
                            <p class="help-block"><?php echo __('Please Enter New Tag Name.');?></p>
                        </div>

                        
                        <button type="submit" class="btn btn-primary btn-block">Submit</button>
                        <button type="reset" class="btn btn-info btn-block">Reset</button>
                    </form>

                </div>
            </div>
        </div>
        <!-- Area Chart -->
        <div class="col-xl-8 col-lg-7">
            <div class="card shadow mb-4">
                <!-- Card Header - Dropdown -->
                <a href="#categorytable_block" class="d-block card-header py-3" data-toggle="collapse" role="button" aria-expanded="true" aria-controls="collapseCardExample">
                    <h6 class="m-0 font-weight-bold text-primary"><?php echo __('Tag List');?></h6>
                </a>
                <!-- Card Body -->
                <div class="card-body" id="categorytable_block">
                    <div class="table-responsive">
                        <table class="table table-bordered" id="dataTable" width="100%" cellspacing="0">
                            <thead class="bg-gradient-light">
                                <tr>
                                    <th>Tag Name</th>
                                    <th>Index</th>
                                </tr>
                            </thead>
                            <tfoot class="bg-gradient-light">
                                <tr>
                                    <th>Tag Name</th>
                                    <th>Index</th>
                                </tr>
                            </tfoot>
                            <tbody>
                                @foreach($tag as $data)
                                <tr>
                                    <td>
                                        {{$data->tag_name}}
                                    </td>
                                    <td>
                                        {{$data->tag_index}}
                                    </td>
                                </tr>
                                @endforeach
                            </tbody>
                        </table>
                    </div>
                    <div class="d-felx justify-content-center">
                        {{ $tag->links() }}
                    </div>
                </div>
            </div>
        </div>

        
    </div>
</div>
@endsection
