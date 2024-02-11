@extends('layouts.sitemaster')

@section('content')
<div class="container-fluid">

    <!-- Content Row -->
    <div class="row">
        <div class="col-xl-12 col-lg-12">
            <div class="card shadow mb-4">
                <!-- Card Header - Dropdown -->
                <div class="d-block card-header py-3" aria-expanded="false" aria-controls="collapseCardExample">
                    <h6 class="m-0 font-weight-bold text-primary">Edit Data</h6>
                </div>
                <!-- Card Body -->
                <div class="card-body" id="new_block">
                <?php if($product->deleted == 1){ ?>
                    <div class="alert alert-danger">
                        This product is deleted at <?php echo $product->deleted_at;?>
                    </div>
                <?php } ?>
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
                    <form role="form" method="post" action="{{ route('fleamarket.update') }}?product={{$productid}}" accept-charset="UTF-8"  method="post" enctype="multipart/form-data">
                        @csrf
                        <input type="hidden" id="productid" name="productid" value="{{$productid}}"/>

                        <ul class="nav nav-tabs">
                            <li class="active">
                                <a  href="#datatab" data-toggle="tab">Data Field</a>
                            </li>
                            <li class=""><a href="#filetab" data-toggle="tab">Files</a>
                            </li>
                        </ul>
                        <div class="tab-content ">
                            <div class="tab-pane active p-3" id="datatab">
                                <div class="row">
                                    <div class="col-xl-6 col-lg-6 col-md-6 col-sm-6">
                                        <input type="hidden" id="p_type" name="p_type" value="1"/>
                                        <div class="form-group">
                                            <label>Product Name</label>
                                            <input class="form-control" id="p_name" name="p_name" value="{{ $product->product_name}}">                                    
                                        </div>                                 
                                    </div>
                                    <div class="col-xl-3, col-lg-3 col-md-6 col-sm-6">
                                        <div class="form-group">
                                            <label>Price</label>
                                            <input class="form-control" id="p_price" name="p_price" value="{{ $product->price}}">                                    
                                        </div> 
                                    </div>
                                    <div class="col-xl-3, col-lg-3 col-md-6 col-sm-6">
                                        
                                        <div class="form-group">
                                            <label>Amount</label>
                                            <input class="form-control" id="p_amount" name="p_amount" value="{{ $product->amount}}">                                    
                                        </div>                 
                                    </div>
                                    <div class="col-xl-3, col-lg-3 col-md-6 col-sm-6">
                                        <div class="form-group">
                                            <label>Development Language</label>
                                            <input class="form-control" id="p_devlang" name="p_devlang" value="{{ $product->dev_language}}">                                    
                                        </div> 
                                    </div>
                                    <div class="col-xl-3, col-lg-3 col-md-6 col-sm-6">
                                        <div class="form-group">
                                            <label>Supported Language</label>
                                            <input class="form-control" id="p_language" name="p_language" value="{{ $product->language}}">                                    
                                        </div> 
                                    </div>
                                    <div class="col-xl-3, col-lg-3 col-md-6 col-sm-6">
                                        <div class="form-group">
                                            <label>Service</label>
                                            <input class="form-control" id="p_service" name="p_service" value="{{ $product->service}}">                                    
                                        </div>                                 
                                    </div>
                                    <div class="col-xl-3, col-lg-3 col-md-6 col-sm-6">
                                        <div class="form-group">
                                            <label>Free Service </label>
                                            <input class="form-control" id="p_install" name="p_install" value="{{ $product->install}}">                                    
                                        </div> 
                                    </div>
                                </div>
                                <div class="row">
                                    <div class="col-xl-6 col-lg-6 col-md-6 col-sm-6">
                                        <div class="form-group">
                                            <label>Description</label>
                                            <textarea class="form-control" id="p_description" rows="4" name="p_description">{{ $product->description}}</textarea>                         
                                        </div> 
                                        <div class="form-group">
                                            <label>Short Description</label>
                                            <input class="form-control" id="p_shortdesc" name="p_shortdesc" value="{{ $product->shortdescription}}">                                    
                                        </div> 
                                        <div class="form-group">
                                            <label>Features</label>
                                            <input class="form-control" id="p_features" name="p_features" value="{{ $product->features}}">                                    
                                        </div> 
                                    </div>
                                    <div class="col-xl-3, col-lg-3 col-md-6 col-sm-6">                       
                                        <div class="form-group">
                                            <label><?php echo __('Select Category');?></label>
                                            <select id="category" name="category" class="form-control">
                                                <option value = "0" >Select Category</option>
                                                @foreach($category as $item)
                                                <option value="{{$item->catid}}" <?php if($product->cat_id == $item->catid){ echo ' selected="selected" '; } ?>>{{$item->cat_name}}</option>
                                                @endforeach
                                            </select>
                                        </div>
                                        <div class="form-group">
                                            <label><?php echo __('Select Tags');?></label>
                                            <select multiple id="tag" name="tag[]" class="form-control selectpicker">
                                                @foreach($tag as $item)
                                                <option value = "{{$item->tagid}}" <?php if($item->selected == true){ ?> selected="selected" <?php }?> >{{$item->tag_name}}</option>
                                                @endforeach
                                            </select>
                                        </div>
                                        
                                    </div>    
                                    <div class="col-xl-3, col-lg-3 col-md-6 col-sm-6">
                                        
                                    </div>
                                </div>        
                            </div>
                            <div class="tab-pane p-5" id="filetab">
                                <div class="row">
                                    <div class="col-xl-6 col-lg-6 col-md-6 col-sm-6">
                                        <?php if(!empty($file) && count($file) > 0){ 
                                            $index = 1; ?>
                                        <div class="table-responsive">
                                            <table class="table table-bordered" id="dataTable" width="100%" cellspacing="0">
                                                <thead class="bg-gradient-light">
                                                    <tr>
                                                        <th>Index</th>
                                                        <th>File Url</th>
                                                        <th>Action</th>
                                                    </tr>
                                                </thead>
                                                <tbody>
                                                    @foreach($file as $data)
                                                    <tr>
                                                        <td>
                                                            {{$index++}}
                                                        </td>
                                                        <td>
                                                        <source src="/public/prodfile/{{$data->image_url}}">{{$data->image_url}}</source>
                                                        </td>
                                                        <td>
                                                            <button type="button" onclick="filedelete('{{$data->id}},{{$data->image_id}},{{$data->product_id}},{{$data->id}}');" class="btn btn-danger">Delete</button>
                                                        </td>
                                                    </tr>
                                                    @endforeach
                                                </tbody>
                                            </table>
                                        </div>
                                        <?php } ?>
                                        <div class=" input-group control-group prodincrement" >
                                            <div class="table-responsive mb-2"><?php echo __('Select Product File');?></div>
                                            <input type="file" name="prodfilenames[]" class="form-control">
                                            <div class="input-group-btn"> 
                                                <button class="btn btn-success prod" type="button"><i class="glyphicon glyphicon-plus"></i>Add</button>
                                            </div>
                                        </div>
                                        <div class="prodclone hide">
                                            <div class="control-group input-group" style="margin-top:10px">
                                                <input type="file" name="prodfilenames[]" class="form-control">
                                                <div class="input-group-btn"> 
                                                <button class="btn btn-danger prod" type="button"><i class="glyphicon glyphicon-remove"></i> Remove</button>
                                                </div>
                                            </div>
                                        </div>
                                    </div>
                                    <div class="col-xl-6 col-lg-6 col-md-6 col-sm-6">
                                        <?php if(!empty($image) && count($image) > 0){ 
                                            $index = 1; ?>
                                        <div class="table-responsive">
                                            <table class="table table-bordered" id="dataTable" width="100%" cellspacing="0">
                                                <thead class="bg-gradient-light">
                                                    <tr>
                                                        <th>Index</th>
                                                        <th>Image Url</th>
                                                        <th>Action</th>
                                                    </tr>
                                                </thead>
                                                <tbody>
                                                    @foreach($image as $data)
                                                    <tr>
                                                        <td>
                                                            {{$index++}}
                                                        </td>
                                                        <td>
                                                            {{$data->image_url}}
                                                        </td>
                                                        <td>
                                                            <button type="button"  onclick="filedelete('{{$data->id}}');"  class="btn btn-danger">Delete</button>
                                                        </td>
                                                    </tr>
                                                    @endforeach
                                                </tbody>
                                            </table>
                                        </div>
                                        <?php } ?>
                                        <div class="input-group control-group increment" >
                                            <div class="table-responsive mb-2"><?php echo __('Select Image File');?></div>
                                            <input type="file" name="filenames[]" class="form-control">
                                            <div class="input-group-btn"> 
                                                <button class="btn btn-success image" type="button"><i class="glyphicon glyphicon-plus"></i>Add</button>
                                            </div>
                                        </div>
                                        <div class="clone hide">
                                            <div class="control-group input-group" style="margin-top:10px">
                                                <input type="file" name="filenames[]" class="form-control">
                                                <div class="input-group-btn"> 
                                                <button class="btn btn-danger image" type="button"><i class="glyphicon glyphicon-remove"></i> Remove</button>
                                                </div>
                                            </div>
                                        </div>
                                    </div>
                                </div>

                            </div>
                        </div>
                        
                        
                        <div class="row">
                        <?php if($product->deleted == 0){ ?>
                            <div class="col-xl-4, col-lg-4 col-md-4 pt-3">
                                <button type="submit" class="btn btn-primary btn-block">Update</button>
                            </div>
                            
                            <div class="col-xl-4, col-lg-4 col-md-4 pt-3">
                                <button type="reset" class="btn btn-info btn-block">Reset</button>
                            </div>
                            <div class="col-xl-4, col-lg-4 col-md-4 pt-3">
                                <button type="button" onclick="DelProduct('{{$productid}}');" class="btn btn-danger btn-block">Delete</button>
                            </div>
                        <?php } ?>
                        </div>
                    </form>
                </div>
            </div>
        </div>
    </div>


</div>
@endsection


@section('page-css')
<link href="{{ asset('css/bootstrap-select.min.css') }}" rel="stylesheet">
<style>
    .nav-tabs>li {
    float: left;
    margin-bottom: -1px;
}
    .nav>li>a {
    position: relative;
    display: block;
    padding: 10px 15px;
}
    .nav-tabs>li>a {
    margin-right: 2px;
    line-height: 1.42857143;
    border: 1px solid transparent;
    border-radius: 4px 4px 0 0;
}
    .nav-tabs>li.active>a, .nav-tabs>li.active>a:focus, .nav-tabs>li.active>a:hover {
      color: #555;
      cursor: default;
      background-color: #fff;
      border: 1px solid #ddd;
      border-bottom-color: transparent;
  }
  .nav>li>a:focus, .nav>li>a:hover {
    text-decoration: none;
    background-color: #eee;
}
  .nav-tabs>li>a:hover {
    border-color: #eee #eee #ddd;
}
</style>
@stop

@section('page-script')
<script src="{{ asset('js/bootstrap-select.min.js')}}"></script>
<script type="text/javascript">

    $(document).ready(function() {

      $(".btn-success.image").click(function(){ 
          var html = $(".clone").html();
          $(".increment").after(html);
      });

      $("body").on("click",".btn-danger.image",function(){ 
          $(this).parents(".control-group").remove();
      });

      $(".btn-success.prod").click(function(){ 
          var html = $(".prodclone").html();
          $(".prodincrement").after(html);
      });

      $("body").on("click",".btn-danger.prod",function(){ 
          $(this).parents(".control-group").remove();
      });

        jQuery(".nav.nav-tabs li").click(function(){
            jQuery(".nav.nav-tabs li").removeClass('active');
            jQuery(this).addClass('active');
        });
    });

    function filedelete(delid){
        var tokenid = $("input[name='_token']").val();
        $.ajax({
            type: 'POST',
            url: '{!! route('fleamarket.delete') !!}',
            data: { delpimgid: delid , _token:tokenid},
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

    function DelProduct(delid){
        var tokenid = $("input[name='_token']").val();
        $.ajax({
            type: 'POST',
            url: '{!! route('fleamarket.productdelete') !!}',
            data: { delprocid: delid , _token:tokenid},
            dataType: 'json',
            success: function(response) {
                // Handle the response message
                if(response == true){
                    window.location.href = "/{{ route('fleamarket') }}"
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