<?php
    $products = App\Product::all();
    $category = App\ProductCategory::all();
    $seller = App\Seller::orderBy('id','desc')->paginate(15);
    $product = App\Product::where('sale','1')->get();
 ?>
<!DOCTYPE html>
<html class=" no-touchevents backgroundblendmode objectfit object-fit" lang="ru">
  <head>
        <meta charset="utf-8">
        <meta name="viewport" content="width=device-width, initial-scale=1.0">
        <meta name="csrf-param" content="_csrf-fk">
        <title>Market</title>
        <link rel="icon" type="image/png" href="{{ asset('img/fr.png') }}">
        <script src="https://ajax.googleapis.com/ajax/libs/jquery/3.3.1/jquery.min.js"></script>
        <script src="https://maxcdn.bootstrapcdn.com/bootstrap/3.3.7/js/bootstrap.min.js"></script>
        <link href="https://market.mixcart.ru/fmarket/plugins/bootstrap-3.3.7/css/bootstrap.min.css" rel="stylesheet">
        <link href="{{ asset('css/mixmarket.css') }}" rel="stylesheet">

        <script src="https://code.jquery.com/jquery-2.2.4.min.js"></script>
<script src="https://cdnjs.cloudflare.com/ajax/libs/owl-carousel/1.3.3/owl.carousel.js"></script>
<link href="https://cdnjs.cloudflare.com/ajax/libs/owl-carousel/1.3.3/owl.carousel.css" rel="stylesheet" />
<link href="https://cdnjs.cloudflare.com/ajax/libs/owl-carousel/1.3.3/owl.transitions.css" rel="stylesheet" />
<link href="https://cdnjs.cloudflare.com/ajax/libs/owl-carousel/1.3.3/owl.theme.min.css" rel="stylesheet" />

  </head>
  <style>
  .panel-group {margin-bottom: 0px;overflow: hidden;}
  .panel-group .panel{border-radius:0;border:0;border-bottom:1px solid #ddd}
  .panel-body { padding:0px; }
  .panel-body table tr td span{ width:100%;display: block;padding-left: 25px;padding-top:10px;padding-bottom:7px;}
  .panel-body table tr td {padding:0}
  .panel-body .table {margin-bottom: 0px;}
  .panel-group .panel+.panel {margin-top: 0px;}
  .panel-default>.panel-heading {color: #333;background-color: #fff;}
  #accordion {box-shadow: 0px 1px 3px rgba(9, 12, 17, 0.2);border-radius:3px;}
  .panel-default>.panel-heading {padding-top:0;padding-bottom:0;}
  .panel-collapse{background: #f3f3f3;}
  .panel-default > .panel-heading + .panel-collapse > .panel-body {border-top: none; }
  .panel-default>.panel-heading h4{padding-top:15px;padding-bottom:10px;}
  #accordion .caret{margin-top: -21px;}
  .panel-default>.panel-heading a{text-decoration: none;color:#3f3e3e;}
  .panel-default>.panel-heading a:hover{text-decoration: none;color:#84bf76;}
  .panel-body table tr td a{ text-decoration: none;color:#7b7b7b;}
  .panel-body table tr td a:hover{ text-decoration: none;color:#84bf76;}
    .inl {
      display: inline-flex;
      width: 100%;
    }
    .for {
      margin-top: -19px;
    }
    .inl button {
      border: 0px;
      background-color: white;
    }#owl-demo .item {
    margin: 3px;
  }
  #owl-demo .item img {
    display: block;
    width: 100%;
    height: 200px;
  }
  .item {
    width: 100%;
  }
  </style>
    <body style="background:url( {{ asset('img/linen.jpg') }}) repeat">
  <!-- navbar start -->
<section>
    <nav class="navbar navbar-inverse navbar-static-top example6 shadow-bottom">
        <div class="container" style="padding: 9px 30px">
            <div class="navbar-header">
                <a href="{{ url('market') }}"><img src="{{ asset('img/fr.png') }}" width="50px;" height="40px;"></a>
            </div>
                <ul class="nav navbar-nav navbar-right">
                  @if(Auth::check())
                      <li><a href="{{ url('/user_check') }}">Рабочий Стол</a></li>
                  @endif
                    <li><a href="{{ url('market/customers') }}">КЛИЕНТЫ</a></li>
                    <li><a href="{{ url('market/vendors') }}">ПОСТАВЩИКИ</a></li>
                    <li><a href="{{ url('market/about') }}">О Нас</a></li>
                    @if(Auth::check())
                      <li>
                        {!! Form::open(['route' => 'logout', 'method' => 'POST']) !!}
                          {{ Form::submit('[выход]',['class' => 'btn-navbar']) }}
                        {!! Form::close() !!}
                      </li>
                    @else
                      <li>
                        {!! Form::open(['route' => 'login', 'method' => 'GET']) !!}
                          {{ Form::submit('[вход/регистрация]',['class' => 'btn-navbar']) }}
                        {!! Form::close() !!}
                      </li>
                    @endif
                  </ul>
            </div>
        </div>
    </nav>
</section>
<!-- navbar end -->

<!-- search start -->
    {!! Form::open(['route' => 'search', 'method' => 'POST', 'class' => 'for']) !!}
    <div class="inl">
      {{ Form::text('search',null,['class' => 'form-control search-block','placeholder' => 'Поиск товаров и поставщиков','aria-describedby' => 'basic-addon1','id' => 'search']) }}
      <button class="ser"><img src="{{ asset('img/icons8-search-50.png') }}"></button>
    </div>
    {!! Form::close() !!}<br>
<!-- search end -->


<!-- carousel start -->
    <section>
      <div class="container">
        <center><h3>Популярные поставщики</h3></center>
        <div id="owl-demo1">
          @foreach($seller as $sel)
            <div class="item col-md-12">
                      <div class="mp-product-block">
                              <a href="{{ route('market_vendor',['vendor_id' => $sel->id]) }}">
                              <img class="product-image" src="{{ $sel->image ? asset('img/products/'.$sel->image) : asset('img/default-avatar.png') }}">
                          </a>
                      </div>
            </div>
          @endforeach
        </div>
      </div>
    </section>
<!-- carousel end -->

        <section id="features1-u">
            <div class="container">
                <div class="row">
                    <div class="col-md-12">
                        <div class="row">
                            <div class="col-md-4 right-padding" style="margin-bottom: 30px;">

                            <div class="row">
                                <div class="col-md-12">
                                    <h3>Каталог <span class="badge pull-right">{{ count($products) }} товаров</span></h3>
                                </div>
                            </div>
                          <div class="row">
                              <div class="col-md-12">
                                @foreach($category as $cat)
                                <div class="panel-group">
                                  <div class="panel panel-default">
                                    <div class="panel-heading">
                                      <h4 class="panel-title">
                                        <span><a href="{{ route('bigpros',['category_id' => $cat->id]) }}"><p>{{ $cat->name }}</p></a></span>
                                      </h4>
                                      <a data-toggle="collapse" href="#collapse{{ $cat->id }}"><span class="caret"></span></a>
                                    </div>
                                    <div id="collapse{{ $cat->id }}" class="panel-collapse collapse">
                                      <ul class="list-group">
                                        @foreach($cat->sub_product_category as $sub)
                                          <a href="{{ route('subpros',['category_id' => $sub->id]) }}" class="subproducts"><li class="list-group-item">{{ $sub->name }}</li></a>
                                        @endforeach
                                      </ul>
                                    </div>
                                  </div>
                                </div>
                                @endforeach
                              </div>
                          </div>
                        </div>
                        <div class="col-md-8">
                          @yield('content')
                        </div>

                    </div>
                </div>
                </div>
            </div>
        </section>

        <div class="container">
          <center><h3>Акционные продукты</h3></center>
        </div>

        <!-- carousel start -->
            <section>
              <div class="container">
                <div id="owl-demo">
                  @foreach($product as $pro)
                    <div class="item col-md-12">
                              <div class="mp-product-block">
                                      <a href="{{ route('info',['product_id' => $pro->id]) }}">
                                      <img class="product-image" src="{{ $pro->image ? asset('img/products/'.$pro->image) : asset('img/defaults/'.$pro->sub_product_category->product_category->image) }}">
                                  </a>
                                  <div class="row">
                                      <div class="col-md-12">
                                          <div class="product-title">
                                              <a href="{{ route('info',['product_id' => $pro->id]) }}"><h3>{{ $pro->name }}</h3></a>
                                          </div>
                                          <div class="product-category">
                                              <h5>{{ $pro->sub_product_category->product_category->name }}/{{ $pro->sub_product_category->name }}</h5>
                                          </div>
                                          <div class="product-company">
                                              <a href="{{ route('market_vendor',['vendor_id' => $pro->seller->id]) }}">
                                                  <h5>{{ $pro->seller->name }}</h5>
                                              </a>
                                          </div>
                                      </div>
                                      <div class="col-md-12">
                                          <div class="product-price">
                                                @if($pro->sale =! 0)
                                                  <h4 style="text-decoration: line-through;text-decoration-color: red;">{{ $pro->price }} <small>SO'M</small></h4>
                                                  <h4>{{ $pro->price_sale }} <small>SO'M</small></h4>
                                                @else
                                                  <h4>{{ $pro->price }} <small>SO'M</small></h4>
                                                @endif
                                            </div>
                                      </div>
                                      <div class="col-md-12">
                                        @if(Auth::check())
                                          @if(Auth::user()->role == 'customer')
                                            <div class="product-button">
                                                <a href="{{ route('info',['product_id' => $pro->id]) }}" class="btn btn-100 btn-success add-to-cart" data-product-id="120412"><span class="pe-7s-cart"></span> КУПИТЬ</a>
                                            </div>
                                          @else
                                          <!-- Button to Open the Modal -->
                                            <div class="product-button">
                                                <a href="#" class="btn btn-100 btn-success add-to-cart" data-toggle="modal" data-target="#myModal"><span class="pe-7s-cart"></span> КУПИТЬ</a>
                                            </div>
                                            <!-- The Modal -->
                                            <div class="modal fade" id="myModal">
                                              <div class="modal-dialog modal-dialog-centered">
                                                <div class="modal-content">
                                                  <!-- Modal Header -->
                                                  <div class="modal-header">
                                                    <h4 class="modal-title">ПРЕДУПРЕЖДЕНИЕ!</h4>
                                                    <button type="button" class="close" data-dismiss="modal">&times;</button>
                                                  </div>
                                                  <!-- Modal body -->
                                                  <div class="modal-body">
                                                    <h4>Вы не являйтесь клиентом чтобы КУПИТЬ!</h4>
                                                  </div>
                                                  <!-- Modal footer -->
                                                  <div class="modal-footer">
                                                    <button type="button" class="btn btn-secondary" data-dismiss="modal">Закрыть</button>
                                                  </div>

                                                </div>
                                              </div>
                                            </div>
                                          @endif
                                        @else
                                          <div class="product-button">
                                              <a href="{{ route('login') }}" class="btn btn-100 btn-success add-to-cart" data-product-id="120412"><span class="pe-7s-cart"></span> КУПИТЬ</a>
                                          </div>
                                        @endif
                                      </div>
                                  </div>
                              </div>
                    </div>
                  @endforeach
                </div>
              </div>
            </section>
        <!-- carousel end -->
<script>
  $(document).ready(function() {
    $("#owl-demo").owlCarousel({
      autoPlay: 4000,
      items: 4,
      itemsDesktop: [1199, 3],
      itemsDesktopSmall: [979, 3]
    });
    $("#owl-demo1").owlCarousel({
      autoPlay: 4000,
      items: 4,
      itemsDesktop: [1199, 3],
      itemsDesktopSmall: [979, 3]
    });
  });
</script>
</body>
</html>
