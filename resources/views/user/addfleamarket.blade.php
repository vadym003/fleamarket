@extends('layouts.sitemaster')

@section('content')
<div class="container-fluid">

    <!-- Content Row -->
    <div class="row">
        <div class="col-xl-12 col-lg-12">
            <div class="card shadow mb-4">
                <!-- Card Header - Dropdown -->
                <div class="d-block card-header py-3" aria-expanded="false" aria-controls="collapseCardExample">
                    <h6 class="m-0 font-weight-bold text-primary">New Data</h6>
                </div>
                <!-- Card Body -->
                <div class="card-body" id="new_block">
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
                    <form role="form" method="post" action="{{ route('fleamarket.add') }}" accept-charset="UTF-8"  method="post" enctype="multipart/form-data">
                        @csrf
                        <input type="hidden" id="productid" name="productid" value="{{$productid}}"/>
                        <div class="row">
                            <div class="col-xl-6 col-lg-6 col-md-6 col-sm-6">
                                <input type="hidden" id="p_type" name="p_type" value="1"/>
                                <div class="form-group">
                                    <label>Product Name</label>
                                    <input class="form-control" id="p_name" name="p_name" value="">                                    
                                </div>                                 
                            </div>
                            <div class="col-xl-3, col-lg-3 col-md-6 col-sm-6">
                                <div class="form-group">
                                    <label>Price</label>
                                    <input class="form-control" id="p_price" name="p_price" value="">                                    
                                </div> 
                            </div>
                            <div class="col-xl-3, col-lg-3 col-md-6 col-sm-6">
                                
                                <div class="form-group">
                                    <label>Amount</label>
                                    <input class="form-control" id="p_amount" name="p_amount" value="1">                                    
                                </div>                 
                            </div>
                            <div class="col-xl-3, col-lg-3 col-md-6 col-sm-6">
                                <div class="form-group">
                                    <label>Development Language</label>
                                    <input class="form-control" id="p_devlang" name="p_devlang" value="">                                    
                                </div> 
                            </div>
                            <div class="col-xl-3, col-lg-3 col-md-6 col-sm-6">
                                <div class="form-group">
                                    <label>Supported Language</label>
                                    <input class="form-control" id="p_language" name="p_language" value="">                                    
                                </div> 
                            </div>
                            <div class="col-xl-3, col-lg-3 col-md-6 col-sm-6">
                                <div class="form-group">
                                    <label>Service</label>
                                    <input class="form-control" id="p_service" name="p_service" value="">                                    
                                </div>                                 
                            </div>
                            <div class="col-xl-3, col-lg-3 col-md-6 col-sm-6">
                                <div class="form-group">
                                    <label>Free Service </label>
                                    <input class="form-control" id="p_install" name="p_install" value="">                                    
                                </div> 
                            </div>
                        </div>
                        <div class="row">
                            <div class="col-xl-6 col-lg-6 col-md-6 col-sm-6">
                                <div class="form-group">
                                    <label>Description</label>
                                    <textarea class="form-control" id="p_description" rows="4" name="p_description"></textarea>                         
                                </div> 
                                <div class="form-group">
                                    <label>Short Description</label>
                                    <input class="form-control" id="p_shortdesc" name="p_shortdesc" value="">                                    
                                </div> 
                                <div class="form-group">
                                    <label>Features</label>
                                    <input class="form-control" id="p_features" name="p_features" value="">                                    
                                </div> 
                            </div>
                            <div class="col-xl-3, col-lg-3 col-md-6 col-sm-6">                       
                                <div class="form-group">
                                    <label><?php echo __('Select Category');?></label>
                                    <select id="category" name="category" class="form-control">
                                        <option value = "0" selected = "selected">Select Category</option>
                                        @foreach($category as $item)
                                        <option value="{{$item->catid}}">{{$item->cat_name}}</option>
                                        @endforeach
                                    </select>
                                </div>
                                <div class="form-group">
                                    <label><?php echo __('Select Tags');?></label>
                                    <select multiple id="tag" name="tag[]" class="form-control selectpicker">
                                        @foreach($tag as $item)
                                        <option value = "{{$item->tagid}}" >{{$item->tag_name}}</option>
                                        @endforeach
                                    </select>
                                </div>
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
                            <div class="col-xl-3, col-lg-3 col-md-6 col-sm-6">
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
                        
                        <div class="row">
                        
                            <div class="col-xl-6, col-lg-6 col-md-6 col-sm-6 pt-3">
                                <button type="submit" class="btn btn-primary btn-block">Submit</button>
                            </div>
                            <div class="col-xl-6, col-lg-6 col-md-6 col-sm-6 pt-3">
                                <button type="reset" class="btn btn-info btn-block">Reset</button>
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
<link href="{{ asset('css/bootstrap-select.min.css') }}" rel="stylesheet">
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

    });

</script>
@stop