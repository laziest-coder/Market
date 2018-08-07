@extends('market.master')

@section('content')
<div class="col-md-12">
<div class="row">
    <div class="col-md-12 no-padding">
        <ul class="breadcrumb"><li><a href="{{ url('market/vendors') }}">Все поставщики</a></li>
          @if(count($products) > 0)
            <li><a href="{{ route('market_vendor',['vendor_id' => $products[0]->seller->id]) }}">{{ $products[0]->seller->name }}</a></li>
          @else
            <li class="active">{{ $seller->name }}</li>
          @endif
          <li class="active">Каталог</li>
        </ul>
    </div>
</div>
<div class="row">
    <div class="col-md-12">
      @if(count($products) > 0)
        <div class="row" id="mp-product-block">
          @foreach($products as $product)
                            <div class="col-xs-12 col-sm-6 col-md-6 col-lg-4 col-xl-3 min-padding">
                    <div class="mp-product-block">
                            <a href="{{ route('info',['product_id' => $product->id]) }}">
                            <img class="product-image" src="{{ $product->image ?asset('img/products/'.$product->image):asset('img/default-avatar.png') }}">
                        </a>
                        <div class="row">
                            <div class="col-md-12">
                                <div class="product-title">
                                    <a href="{{ route('info',['product_id' => $product->id]) }}"><h3>{{ $product->name }}</h3></a>
                                </div>
                                <div class="product-category">
                                    <h5>{{ $product->sub_product_category->product_category->name }}/{{ $product->sub_product_category->name }}</h5>
                                </div>
                                <div class="product-company">
                                    <a href="{{ route('market_vendor',['vendor_id' => $product->seller->id]) }}">
                                        <h5>{{ $product->seller->name }}</h5>
                                    </a>
                                </div>
                            </div>
                            <div class="col-md-12">
                                <div class="product-price">
                                    <h4>{{ $product->price }}<small>SO'M</small></h4>
                                </div>

                            </div>
                            <div class="col-md-12">
                                <div class="product-button">
                                    <a href="{{ route('info',['product_id' => $product->id]) }}" class="btn btn-100 btn-success add-to-cart"></span> КУПИТЬ</a>
                                </div>
                            </div>
                        </div>
                    </div>
                </div>
                @endforeach
    </div>
    @else
      <h3>У этого поставщика нет никакого продукты.</h3>
    @endif
</div>
</div>
</div>
<div class="text-center">
    {!! $products->links(); !!}
</div>
@stop
