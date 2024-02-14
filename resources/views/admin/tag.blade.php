@extends('layouts.adminmaster')

@section('content')
<div class="container-fluid">
    <!-- Page Heading -->
    <div class="d-sm-flex align-items-center justify-content-between mb-4">
        <h1 class="h3 mb-0 text-gray-800">Tag</h1>
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
                @if ($errors->any())
                    <div class="alert alert-danger">
                        <ul>
                            @foreach ($errors->all() as $error)
                                <li>{{ $error }}</li>
                            @endforeach
                        </ul>
                    </div>
                @endif
                    <form role="form" method="post" action="{{ route('adminTag.add') }}" accept-charset="UTF-8">
                        @csrf
                        <div class="form-group">
                            <label>Tag Name</label>
                            <input class="form-control" id="tag_name" name="tag_name" value="">
                        </div>
                        <div class="form-group">
                            <label>Tag Index</label>
                            <input class="form-control" id="tag_index" name="tag_index" value="">
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
                                    <th>Edit</th>
                                    <th>Delete</th>
                                </tr>
                            </thead>
                            <tbody>
                                @foreach($tag as $data)
                                <tr>
                                    <td>
                                        {{$data->tag_name}}
                                    </td>
                                    <td>
                                        {{$data->tag_index}}
                                    </td>
                                    <td>
                                        <button type="button" class="btn btn-primary" onclick="editmodalshow('{{$data->tagid}}','{{$data->tag_name}}','{{$data->tag_index}}');">Edit</button>
                                    </td>
                                    <td>
                                        <button type="button" class="btn btn-danger" onclick="deletetag('{{$data->tagid}}');">Delete</button>
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
<a href="#" data-toggle="modal" data-target="#tagedit" id="editmodelbtn" style="display:none;"></a>
    <!-- Edit Modal-->
    <div class="modal fade" id="tagedit" tabindex="-1" role="dialog" aria-labelledby="tageditblock"
        aria-hidden="true">
        <div class="modal-dialog" role="document">
            <div class="modal-content">
                <div class="modal-header">
                    <h5 class="modal-title" id="tageditblock">Tag Edit</h5>
                    <button class="close" type="button" data-dismiss="modal" aria-label="Close">
                        <span aria-hidden="true">×</span>
                    </button>
                </div>
                <div class="modal-body">
                    <input type="hidden" class="form-control" id="tag_id1" name="tag_id1" value="">
                    <div class="form-group">
                        <label>Tag Name</label>
                        <input class="form-control" id="tag_name1" name="tag_name1" value="">
                    </div>

                    <div class="form-group">
                        <label>Tag Index</label>
                        <input class="form-control" id="tag_index1" name="tag_index1" value="">
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
        function editmodalshow(tagid, tagname, tagindex){
            $('#tag_id1').val(tagid);
            $('#tag_name1').val(tagname);
            $('#tag_index1').val(tagindex);
            $('#editmodelbtn').click();

        }
        function ajaxeditmodal(){
            var tokenid = $("input[name='_token']").val();
            var tagid = $('#tag_id1').val();
            var tagname = $('#tag_name1').val();
            var tagindex = $('#tag_index1').val();

            $.ajax({
                type: 'POST',
                url: '{!! route('adminTag.edit') !!}',
                data: { tagid: tagid , tagname:tagname, tagindex:tagindex, _token:tokenid},
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
        function deletetag(tagid){
            var tokenid = $("input[name='_token']").val();
            $.ajax({
                type: 'POST',
                url: '{!! route('adminTag.delete') !!}',
                data: { tagid: tagid ,  _token:tokenid},
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
