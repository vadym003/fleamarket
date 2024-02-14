@extends('layouts.adminmaster')

@section('content')
<div class="container-fluid">
    <!-- Page Heading -->
    <div class="d-sm-flex align-items-center justify-content-between mb-4">
        <h1 class="h3 mb-0 text-gray-800">Category</h1>
        <!-- <a href="#" class="d-none d-sm-inline-block btn btn-sm btn-primary shadow-sm"><i
                class="fas fa-download fa-sm text-white-50"></i> Generate Report</a> -->
    </div>
    <!-- Content Row -->
    <div class="row">
        <!-- Pie Chart -->
        <div class="col-xl-4 col-lg-5">
            <div class="card shadow mb-4">
                <!-- Card Header - Dropdown -->
                <a href="#newcat_block" class="d-block card-header py-3" data-toggle="collapse" role="button" aria-expanded="true" aria-controls="collapseCardExample">
                    <h6 class="m-0 font-weight-bold text-primary">New Category</h6>
                </a>
                <!-- Card Body -->
                <div class="card-body" id="newcat_block">
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
                    <form role="form" method="post" action="{{ route('adminCategory.add') }}" accept-charset="UTF-8">
                        @csrf
                        <div class="form-group">
                            <label>Category Name</label>
                            <input class="form-control" id="cat_name" name="cat_name" value="">
                        </div>

                        <div class="form-group">
                            <label>Category Index</label>
                            <input class="form-control" id="cat_index" name="cat_index" value="">
                        </div>

                        <div class="form-group" style="display:none;">
                            <label><?php echo __('Select Parent Category');?></label>
                            <select multiple id="parentcat" name="parentcat" class="form-control">
                                <option value = "0" selected = "selected">Parent</option>
                                <!-- <option>|--2</option>
                                <option>|--3</option>
                                <option>&nbsp;&nbsp;&nbsp;&nbsp;|--4</option>
                                <option>5</option> -->
                            </select>
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
                    <h6 class="m-0 font-weight-bold text-primary"><?php echo __('Category List');?></h6>
                </a>
                <!-- Card Body -->
                <div class="card-body" id="categorytable_block">
                    <div class="table-responsive">
                        <table class="table table-bordered" id="dataTable" width="100%" cellspacing="0">
                            <thead class="bg-gradient-light">
                                <tr>
                                    <th>Category Name</th>
                                    <th>Index</th>
                                    <th>Edit</th>
                                    <th>Delete</th>
                                </tr>
                            </thead>
                            <tbody>
                                @foreach($category as $data)
                                <tr>
                                    <td>
                                        {{$data->cat_name}}
                                    </td>
                                    <td>
                                        {{$data->cat_index}}
                                    </td>
                                    <td>
                                        <button type="button" class="btn btn-primary" onclick="editmodalshow('{{$data->catid}}','{{$data->cat_name}}','{{$data->cat_index}}');">Edit</button>
                                    </td>
                                    <td>
                                        <button type="button" class="btn btn-danger" onclick="deletecat('{{$data->catid}}');">Delete</button>
                                    </td>
                                </tr>
                                @endforeach
                            </tbody>
                        </table>
                    </div>
                    <div class="d-felx justify-content-center">
                        {{ $category->links() }}
                    </div>
                </div>
            </div>
        </div>

        
    </div>
</div>

<a href="#" data-toggle="modal" data-target="#categoryedit" id="editmodelbtn" style="display:none;"></a>
    <!-- Edit Modal-->
    <div class="modal fade" id="categoryedit" tabindex="-1" role="dialog" aria-labelledby="categoryeditblock"
        aria-hidden="true">
        <div class="modal-dialog" role="document">
            <div class="modal-content">
                <div class="modal-header">
                    <h5 class="modal-title" id="categoryeditblock">Category Edit</h5>
                    <button class="close" type="button" data-dismiss="modal" aria-label="Close">
                        <span aria-hidden="true">×</span>
                    </button>
                </div>
                <div class="modal-body">
                    <input type="hidden" class="form-control" id="cat_id1" name="cat_id1" value="">
                    <div class="form-group">
                        <label>Category Name</label>
                        <input class="form-control" id="cat_name1" name="cat_name1" value="">
                    </div>

                    <div class="form-group">
                        <label>Category Index</label>
                        <input class="form-control" id="cat_index1" name="cat_index1" value="">
                    </div>
                </div>
                <div class="modal-footer">                    
                    <a class="btn btn-primary" href="#"
                        onclick="ajaxeditmodal();">
                    Submit
                    </a>
                    <button class="btn btn-secondary" type="button" data-dismiss="modal">Cancel</button>

                </div>
            </div>
        </div>
    </div>
@endsection

@section('page-script')
<script type="text/javascript">
        function editmodalshow(catid, catname, catindex){
            $('#cat_id1').val(catid);
            $('#cat_name1').val(catname);
            $('#cat_index1').val(catindex);
            $('#editmodelbtn').click();

        }
        function ajaxeditmodal(){
            var tokenid = $("input[name='_token']").val();
            var catid = $('#cat_id1').val();
            var catname = $('#cat_name1').val();
            var catindex = $('#cat_index1').val();

            $.ajax({
                type: 'POST',
                url: '{!! route('adminCategory.edit') !!}',
                data: { catid: catid , catname:catname, catindex:catindex, _token:tokenid},
                dataType: 'json',
                success: function(response) {
                    // Handle the response message
                    if(response == true){
                        window.location.reload();
                    }
                },
                error: function(xhr, status, error) {
                    // Handle errors if needed
                    console.error(xhr.responseText);
                }
            });
        }
        function deletecat(catid){
            var tokenid = $("input[name='_token']").val();
            $.ajax({
                type: 'POST',
                url: '{!! route('adminCategory.delete') !!}',
                data: { catid: catid ,  _token:tokenid},
                dataType: 'json',
                success: function(response) {
                    // Handle the response message
                    if(response == true){
                        window.location.reload();
                    }else{
                        alert(response);
                    }
                },
                error: function(xhr, status, error) {
                    // Handle errors if needed
                    console.error(xhr.responseText);
                }
            });
        }
</script>
@stop
