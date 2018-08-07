@extends('market.master')

@section('content')
<div class="col-md-12">
                                <style>
    .filter{
        margin: 24px 0 12px 0;
        color:#76aa69;
        border-bottom: 1px dotted;
        float: right;
        margin-left:15px;
    }
    @media (max-width: 767px){
        .filter{
            margin: -10px 0 15px 0;
            float: none;
        }
    }
    .filter:hover,.filter:focus{text-decoration:none;color:#84bf76;}
    .caret.down {
        border-bottom: 4px dashed;
        border-top:0;
    }
    .caret.up {
        border-top: 4px dashed;
        border-bottom:0;
    }
</style>
<div class="row">
    <div class="col-xs-12 col-md-6 col-sm-6 min-padding">
        <ul class="breadcrumb"><li><a href="{{ route('bigpros',['category_id' => $products->product_category->id]) }}">{{ $products->product_category->name }}</a></li>
<li class="active">{{ $products->name }}</li>
</ul>    </div>
</div>
<div class="row">
    <div class="col-md-12">
        <div class="category-text" style="max-height: none;"></div>
    </div>
</div>
<div class="row">
    <div class="col-md-12">
        <div class="row" id="mp-product-block">
          @foreach($pros as $pro)
                <div class="col-xs-12 col-sm-6 col-md-6 col-lg-4 col-xl-3 min-padding">
                    <div class="mp-product-block">
                            <a href="{{ route('info',['product_id' => $pro->id]) }}">
                            <img class="product-image" src="{{ $pro->image?asset('img/products/'.$pro->image):asset('img/defaults/'.$products->product_category->image) }}">
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
                                    <h4>{{ $pro->price }}<small>SO'M</small></h4>
                                </div>
                            </div>
                            <div class="col-md-12">
                              @if(Auth::check())
                              @if(Auth::user()->role == 'customer')
                                <div class="product-button">
                                    <a href="{{ route('info',['product_id' => $pro->id]) }}" class="btn btn-100 btn-success add-to-cart" data-product-id="120355"><isc class="icon-shopping-cart" aria-hidden="true"></isc> КУПИТЬ</a>
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
                                    <a href="{{ route('login') }}" class="btn btn-100 btn-success add-to-cart" data-product-id="120355"><isc aria-hidden="true"></isc> КУПИТЬ</a>
                                </div>
                              @endif
                            </div>
                        </div>
                    </div>
                </div>
                @endforeach
        </div>
    </div>
</div>
  </div>
<div class="text-center">
  {!! $pros->links() !!}
</div>
@stop
