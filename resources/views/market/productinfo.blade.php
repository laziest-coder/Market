@extends('market.master')

@section('content')
  <style>
    .mp-product-image{
    object-fit: cover;
    width: 100%;
    height: 145px;
    padding: 15px 0 0 0;
    }
    .mp-product-article{
    width:100%;
    display:inline-block;
    border-radius:0 0 3px 3px;
    font-size: 12px;
    background:#343435;
    color:#fff;
    padding:5px;
    text-align: center;
    }
    .btn-cart-active{
    padding:10px;
    }
    .btn-cart{
    padding:10px;
    }
    .btn-cart i{
    line-height: 2;
    }
    @media (min-width: 992px) {
	.mp-block-left {
	padding-right:7.5px;
	}
        .mp-block-right {
	padding-left:7.5px;
	}
}
.mp-block-show-phone{padding-top:20px}
.mp-block-show-email{padding-top:20px}
.title-param{
font-family: "HelveticaBold",Arial,sans-serif;
}
.text-overflow {
    white-space: nowrap;
    overflow: hidden;
   }
</style>
@foreach($product as $pro)
<div class="row">
  <div class="col-md-12 no-padding">
    <ul class="breadcrumb text-overflow" title="{{$pro->name}}" data-toggle="tooltip" data-placement="bottom" data-original-title="{{ $pro->name }}"><li class="active">{{ $pro->sub_product_category->product_category->name }}</li>
<li><a href="{{ route('subpros',['category_id' => $pro->sub_product_category->id]) }}">{{ $pro->sub_product_category->name }}</a></li>
<li class="active">{{ $pro->name }}</li>
</ul>  </div>
</div>
<div class="row">
  <div class="col-md-12 mp-block">
      <div class="row">
        <div class="col-md-8 col-lg-8">
            <div class="row">
                <div class="col-md-12">
                    <h3>{{ $pro->name }}<br>
                        <a class="grey-link" href="{{ route('market_vendor',['vendor_id' => $pro->seller->id]) }}">
                            <small>{{ $pro->seller->name }}</small>
                                                    </a>
                    </h3>
                            <h2 style="padding-bottom:15px">{{ $pro->price }} <small>SO'M</small></h2>
                              </div>

                                <div class="col-md-6 mp-block-left">
                    <div class="row">
                        <div class="col-md-12 no-padding">
                          @if(Auth::check())
                            @if(Auth::user()->role == 'customer')
                            @if($customer == 'notaddedinfo')
                            <!-- Button to Open the Modal -->
                              <div class="product-button">
                                  <a href="#" class="btn btn-100 btn-success" data-toggle="modal" data-target="#myModal"><span class="pe-7s-cart"></span> ЗАКАЗАТЬ</a>
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
                                      <h4>Вы не добавили информацию про вашего организации!</h4>
                                    </div>
                                    <!-- Modal footer -->
                                    <div class="modal-footer">
                                      <button type="button" class="btn btn-secondary" data-dismiss="modal">Закрыть</button>
                                    </div>

                                  </div>
                                </div>
                              </div>
                              @else
                                <div class="product-button">
                                  <a href="{{ route('beforebuy',['product_id' => $pro->id]) }}" class="btn btn-100 btn-success" data-product-id="95687">
                                      <isc aria-hidden="true"></isc>&nbsp;&nbsp;ЗАКАЗАТЬ</a>
                                </div>
                            @endif
                            @else
                            <!-- Button to Open the Modal -->
                              <div class="product-button">
                                  <a href="#" class="btn btn-100 btn-success" data-toggle="modal" data-target="#myModal"><span class="pe-7s-cart"></span> ЗАКАЗАТЬ</a>
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
                                      <h4>Вы не являйтесь клиентом чтобы ЗАКАЗАТЬ!</h4>
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
                                <a href="{{ route('login') }}" class="btn btn-100 btn-success add-to-cart" data-product-id="95687">
                                    <isc aria-hidden="true"></isc>&nbsp;&nbsp;ЗАКАЗАТЬ</a>
                              </div>
                            @endif
                        </div>
                    </div>
                </div>
            </div>
        </div>
        <div class="col-md-4 col-lg-4">
                <img class="mp-product-image" src="{{ $pro->image?asset('img/products/'.$pro->image):asset('img/defaults/'.$pro->sub_product_category->product_category->image) }}">
        </div>
        <div class="col-md-12" style="padding-top:25px">
            <div class="row">
                <div class="col-md-6">
                    <h4>КОММЕНТАРИЙ</h4>
                </div>
            </div>
        </div>
        <div class="col-md-12">
            <div class="row">
                <div class="col-md-12">
                <div class="col-md-12" style="padding-bottom:10px;">
                   <span class="noinfo" style="color:black" >{{ $pro->description }}</span></div>
                 </div>
            </div>
        </div>
      </div>
  </div>
</div>
@endforeach
@stop
