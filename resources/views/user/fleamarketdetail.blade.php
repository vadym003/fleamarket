@extends('layouts.sitemaster')

@section('content')
<div class="container-fluid">

    <div class="">
        <section class="clickble_slider1 row">
            <div class="container py-4">
                <div class="row">
                    <div class="col-sm-6">
                        <!-- Swiper -->
                        <div class="row">
                            <div class="col-md-12 px-0 py-2">
                            <div class="swiper swiper_large_preview">
                                <div class="swiper-wrapper">
                                @foreach($image as $item)
                                <div class="swiper-slide">
                                    <div class="zoom_img">
                                    <img class="img-fluid" src="/img/{{ $item->image_url}}" />
                                    </div>
                                </div>
                                @endforeach

                                </div>
                                <div class="swiper-button-next"></div>
                                <div class="swiper-button-prev"></div>
                            </div>
                            </div>
                            <div class="col-md-12 px-0 py-2">
                            <div thumbsSlider="" class="swiper swiper_thumb">
                                <div class="swiper-wrapper">
                                @foreach($image as $item)
                                <div class="swiper-slide">
                                    <div class="zoom_img">
                                    <img class="img-fluid" src="/img/{{ $item->image_url}}" />
                                    </div>
                                </div>
                                @endforeach
                                </div>
                                <div class="swiper-button-next"></div>
                                <div class="swiper-button-prev"></div>
                            </div>
                            </div>
                        </div>


                    </div>
                    <div class="col-sm-6">
                        <h1>{{ $product->product_name }}</h1>
                        <h3 class="text-success">Price: {{ $product->price }}</h3>
                        <h3 class="text-error">Amount: {{ $product->amount }}</h3>
                        <div class="lorem_text">

                            <p>
                            {{ $product->shortdescription }}
                            </p>
                        </div>
                        <div class="">
                            Category: {{$product->cat_name}}
                        </div>
                        <div class="">
                            Tags: @foreach($tags as $tagitem)
                                {{ $tagitem->tag_name}},
                            @endforeach
                        </div>

                        <a href="#" class="btn btn-primary btn-large">Buy</a>
                    </div>
                </div>
            </div>
        </section>
    </div>
    <div class="row">
    <div id="exTab2" class="container py-4">	
        <ul class="nav nav-tabs">
            <li class="active">
                <a  href="#overview" data-toggle="tab">Overview</a>
            </li>
            <li class=""><a href="#review" data-toggle="tab">Rreview</a>
            </li>
            <li class=""><a href="#sale" data-toggle="tab">Sale</a>
            </li>
        </ul>

            <div class="tab-content ">
                <div class="tab-pane active p-5" id="overview">
                    <div class="row py-2">
                        <div class="col-sm-3">Description</div>
                        <div class="col-sm-9">{{$product->description}}</div>
                    </div>
                    <div class="row py-2">
                        <div class="col-sm-3">Development Language</div>
                        <div class="col-sm-9">{{$product->dev_language}}</div>
                    </div>
                    <div class="row py-2">
                        <div class="col-sm-3">Supported Language</div>
                        <div class="col-sm-9">{{$product->language}}</div>
                    </div>
                    <div class="row py-2">
                        <div class="col-sm-3">Service</div>
                        <div class="col-sm-9">{{$product->service}}</div>
                    </div>
                    <div class="row py-2">
                        <div class="col-sm-3">Free Service</div>
                        <div class="col-sm-9">{{$product->install}}</div>
                    </div>
                    <div class="row py-2">
                        <div class="col-sm-3">Features</div>
                        <div class="col-sm-9">{{$product->features}}</div>
                    </div>
                    <div class="row py-2">
                        <div class="col-sm-3">Others</div>
                        <div class="col-sm-9">{{$product->others}}</div>
                    </div>
                </div>
                <div class="tab-pane" id="review">
                    <h3>Review Block</h3>
                </div>
                <div class="tab-pane" id="sale">
                <h3>Sale Block</h3>
            </div>
            </div>
        </div>
    </div>        

</div>
@endsection

@section('page-css')
<link href="{{ asset('css/swiper-bundle.min.css') }}" rel="stylesheet">
<!-- <link href="{{ asset('css/bootstrap.min.css') }}" rel="stylesheet"> -->
<style>
    .swiper {
      width: 100%;
      height: 100%;
    }

    .swiper-slide {
      text-align: center;
      font-size: 18px;
      background: #fff;
      /* Center slide text vertically */
      display: -webkit-box;
      display: -ms-flexbox;
      display: -webkit-flex;
      display: flex;
      -webkit-box-pack: center;
      -ms-flex-pack: center;
      -webkit-justify-content: center;
      justify-content: center;
      -webkit-box-align: center;
      -ms-flex-align: center;
      -webkit-align-items: center;
      align-items: center;
      cursor: pointer;
    }

    .swiper-slide img {
      display: block;
      width: 100%;
      /* height: 100%;
      object-fit: cover; */
    }

    .swiper {
      width: 100%;
    }



    .swiper_thumb .swiper-slide {
      opacity: 0.7;
    }

    .swiper_thumb .swiper-slide:hover {
      opacity: 1;
    }

    .swiper_thumb .swiper-slide-thumb-active {
      opacity: 1;
      border: 2px solid blue;
    }

    .swiper-slide img {
      display: block;
      width: 100%;
      /* height: 100%;
      object-fit: cover; */
      user-select: none;
    }

    .swiper-button-next,
    .swiper-button-prev {
      color: blue;
      background: rgba(255, 255, 255, .8);
      width: 40px;
      height: 40px;
      border-radius: 50%;
      box-shadow: 0px 2px 2px rgb(34,48,225);
      z-index: 9;
    }

    .swiper-button-next,
    .swiper-button-prev::after {
      font-size: 24px;
      font-weight: 600;
    }

    .swiper-button-prev,
    .swiper-button-next::after {
      font-size: 24px;
      font-weight: 600;
    }

    .swiper-button-next {
      right: 0px;
    }

    .swiper-button-prev {
      left: 0px;
    }

    .swiper-button-next:hover {
      color: #ccc;
      background: blue;
    }

    .swiper-button-prev:hover {
      color: #ccc;
      background: blue;
    }
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
<script src="{{ asset('js/swiper-bundle.min.js')}}"></script>
<script src="{{ asset('js/bootstrap.min.js')}}"></script>
<script type="text/javascript">
    jQuery(".nav.nav-tabs li").click(function(){
        jQuery(".nav.nav-tabs li").removeClass('active');
        jQuery(this).addClass('active');
    });
var swiper = new Swiper(".swiper_thumb", {
      spaceBetween: 10,
      slidesPerView: 4,
      speed: 300,
      loop: true,
      freeMode: true,
      watchSlidesProgress: true,
      ClickAble: true,
      navigation: {
        nextEl: ".swiper-button-next",
        prevEl: ".swiper-button-prev",
      },
    });
    var swiper2 = new Swiper(".swiper_large_preview", {
      spaceBetween: 10,
      slidesPerView: 1,
      // speed: 300,
      speed: 0,
      loop: true,
      // freeMode: true,
      navigation: {
        nextEl: ".swiper-button-next",
        prevEl: ".swiper-button-prev",
      },
      thumbs: {
        swiper: swiper,
      },
    });

</script>
@stop