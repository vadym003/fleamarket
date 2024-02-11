@extends('layouts.sitemaster')

@section('content')
<div class="container-fluid">

    <div class="row">
        <div class="col-xl-12, col-lg-12 col-md-12 col-sm-12 pt-1 p ">
            <div class="">
                <nav class="navbar navbar-expand navbar-light border-bottom-primary topbar mb-4 static-top shadow">
                    <ul class="navbar-nav">

                        <!-- Nav Item - Messages -->
                        <li class="nav-item  no-arrow mx-1">
                            <a class="nav-link text-black " href="?category=" id="homelink" role="button"
                                data-toggle="" aria-haspopup="true" aria-expanded="false">
                                All
                            </a>
                        </li>
                        @foreach($category as $item)
                        <li class="nav-item  no-arrow mx-1">
                            <a class="nav-link text-black " href="?category={{$item->catid}}" id="homelink" role="button"
                                data-toggle="" aria-haspopup="true" aria-expanded="false">
                                {{$item->cat_name}}
                            </a>
                        </li>
                        @endforeach
                    </ul>
                    <a href="{{ route('fleamarket.addpage') }}" class="btn btn-primary d-sm-inline-block ml-auto my-2 my-md-0 mw-100 ">Add</a>
                </nav>
                
            </div>
        </div>
    </div>
    <div class="row">
        <div class="col-xl-12, col-lg-12 col-md-12 col-sm-12 pt-1">
            @foreach($products as $proitem)
            <div class="card mb-4 border-left-primary">
                <div class="card-body">
                    <div class="row no-gutters align-items-center">
                        <div class="col-auto mr-3">
                            <?php if($proitem->image_url != ""){ ?>
                            <img class="listimg" src="/img/{{ $proitem->image_url}}"></img>
                            <?php }else{ ?>
                                <img class="listimg" src="/img/default.png"></img>
                            <?php } ?>
                            

                        </div>
                        <div class="col mr-3">
                            <div class="row">
                                <div class="col-xl-3, col-lg-3 col-md-3">{{ $proitem->product_name}}</div>
                                <div class="col-xl-3, col-lg-3 col-md-3">seller: {{ $proitem->user_id}}</div>
                                <div class="col-xl-3, col-lg-3 col-md-3">Price: {{ $proitem->price}}</div>
                                <div class="col-xl-3, col-lg-3 col-md-3">sold: 2</div>
                            </div>
                            <span>Publish: </span><br/>
                            <span>Dev Language: {{$proitem->dev_language}} </span><br/>
                            <span>Language: {{$proitem->language}} </span><br/>
                            <span>Service: {{$proitem->service}} </span><br/>
                            <span>Free Service: {{$proitem->install}} </span><br/>
                        </div>
                        <div class="col-auto">
                            <a href="{{ route('fleamarket.detail')}}?product={{$proitem->id}}" class="btn btn-primary">Detail...</a>
                            <?php if($proitem->user_id == $userid){ ?>
                            <a href="{{ route('fleamarket.addpage')}}?product={{$proitem->id}}" class="btn btn-primary">Edit</a>
                            <?php } ?>
                        </div>
                    </div>
                </div>
            </div>
            @endforeach
            <div class="d-felx justify-content-center">
                {{ $products->links() }}
            </div>
        </div>
    </div>

</div>
@endsection

@section('page-css')
<style>
    .listimg{ max-width:250px; max-height: 200px;}
</style>
@endsection
@section('page-script')
<script type="text/javascript">

    $(document).ready(function() {

      $(".btn-success").click(function(){ 
          var html = $(".clone").html();
          $(".increment").after(html);
      });

      $("body").on("click",".btn-danger",function(){ 
          $(this).parents(".control-group").remove();
      });

    });

</script>
@stop