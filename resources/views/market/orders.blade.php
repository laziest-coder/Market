@extends('market.master')

@section('content')
@if( $customer == null)
  redirect('/customer/cust_settings')
@endif
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
  <ul class="breadcrumb text-overflow" title="{{ $pro->name }}" data-toggle="tooltip" data-placement="bottom" data-original-title="{{ $pro->name }}"><li class="active">{{ $pro->sub_product_category->product_category->name }}</li>
<li><a href="/category/kokteyli">{{ $pro->sub_product_category->name }}</a></li>
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
              <div class="col-md-12">
                @include('layouts._flash')
              </div>
              <div class="col-md-12">
                {!! Form::open(['route' => ['buy', $pro->id], 'method' => 'POST']) !!}

                  {{ Form::label('quantity','Quantity') }}
                  {{ Form::text('quantity', null , ['class' => 'form-control','placeholder'=>'Enter the quantity of product']) }}

                  {{ Form::label('comment','Comment') }}
                  {{ Form::textarea('comment',null, ['class' => 'form-control','placeholder' => 'Enter your comments here']) }}

                  {{ Form::hidden('seller_id', $pro->seller->id , ['class' => 'form-control']) }}
                  {{ Form::hidden('price', $pro->price , ['class' => 'form-control']) }}
                  {{ Form::hidden('products_id', $pro->id , ['class' => 'form-control']) }}
                  {{ Form::hidden('customer_id', $customer->id , ['class' => 'form-control']) }}
                  <br>
                  {{ Form::submit('Заказать', ['class' => 'btn btn-100 btn-success']) }}
                  <br><br>
                	{!! Form::close() !!}
                </form>
              </div>
              <div class="col-md-6 mp-block-left">
                  <div class="row">
                      <div class="col-md-12 no-padding">
                          <div class="product-button">

                          </div>
                      </div>
                  </div>
              </div>
          </div>
      </div>
      <div class="col-md-4 col-lg-4">
              <img class="mp-product-image" src="{{ $pro->image?asset('img/products/'.$pro->image): asset('img/defaults/'.$pro->sub_product_category->product_category->image) }}">
      </div>
    </div>
</div>
</div>
@endforeach
@stop
