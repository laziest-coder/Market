@extends('market.master')

@section('content')
@if(count($products) == 0 && count($sellers) == 0 && count($customers) == 0)
  <center><h3>По вашему запросу ничего не найдено</h3></center>
@else
<!-- products -->
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
  <div class="col-md-12">
<div class="col-xs-12 col-md-6 col-sm-6 min-padding">
<h3>Товары({{ count($products) }})</h3>
</div>
</div>
<div class="row">
<div class="col-md-12">
<div class="category-text" style="max-height: none;"></div>
</div>
</div>
<div class="row">
<div class="col-md-12">
<div class="row" id="mp-product-block">
@foreach($products as $product)
<div class="col-xs-12 col-sm-6 col-md-6 col-lg-4 col-xl-3 min-padding">
<div class="mp-product-block">
<a href="{{ route('info',['product_id' => $product->id]) }}">
<img class="product-image" src="{{ $product->image ? asset('img/products/'.$product->image) : asset('img/coala.jpg') }}">
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
                        <h4>{{ $product->price }} <small>SO'M</small></h4>
    </div>
</div>
<div class="col-md-12">
@if(Auth::check())
@if(Auth::user()->role == 'customer')
  <div class="product-button">
      <a href="{{ route('info',['product_id' => $product->id]) }}" class="btn btn-100 btn-outline-success add-to-cart" data-product-id="120412"><span class="pe-7s-cart"></span> КУПИТЬ</a>
  </div>
@else
<!-- Button to Open the Modal -->
  <div class="product-button">
      <a href="#" class="btn btn-100 btn-outline-success add-to-cart" data-toggle="modal" data-target="#myModal"><span class="pe-7s-cart"></span> КУПИТЬ</a>
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
    <a href="{{ route('login') }}" class="btn btn-100 btn-outline-success add-to-cart" data-product-id="120412"><span class="pe-7s-cart"></span> КУПИТЬ</a>
</div>
@endif
</div>
</div>
</div>
</div>
@endforeach
</div>
<!-- <div class="row">
<div class="col-md-12 min-padding">
<a href="#" class="btn btn-100 btn-outline-default " id="product-more">Показать еще</a>
</div>
</div> -->
</div>
</div>
</div>


 <!-- Vendors -->


     <div class="row">
     <div class="col-md-12">
       <h3>Поставщики({{ count($sellers) }}) <small></small></h3>
         <div class="row" id="supplier-block">
           @foreach($sellers as $seller)
                         <div class="col-xs-12 col-sm-6 col-md-6 col-lg-4 col-xl-3 min-padding">
             <div class="mp-suppiler-block">
                  <a href="{{ route('market_vendor',['vendor_id' => $seller->id]) }}">
                 <img class="supplier-image" src="{{ $seller->image?asset('img/sellers/'.$seller->image):asset('img/default-avatar.png') }}">
               </a>
               <div class="row">
                 <div class="col-md-12">
                   <div class="supplier-title">
                     <a href="{{ route('market_vendor',['vendor_id' => $seller->id]) }}">
                     <h3>{{ $seller->name }}</h3>
                     </a>
                   </div>
                   <div class="supplier-category">
                     <h5>Москва</h5>
                   </div>
                 </div>
                 <div class="col-md-12">
                   <div class="supplier-button">
                     <a href="{{ route('market_vendor',['vendor_id' => $seller->id]) }}" class="btn btn-success invite-vendor" data-vendor-id="2816" style="width: 100%">Посмотреть</a>
                   </div>
                 </div>
               </div>
             </div>
           </div>
           @endforeach
         </div>
     </div>
 </div>

   <!-- Customer -->

       <div class="row">
       <div class="col-md-12">
         <h3>Клиенты({{ count($customers) }}) <small></small></h3>
           <div class="row" id="supplier-block">
             @foreach($customers as $customer)
                           <div class="col-xs-12 col-sm-6 col-md-6 col-lg-4 col-xl-3 min-padding">
               <div class="mp-suppiler-block">
                    <a href="{{ route('market_customer',['customer_id' => $customer->id]) }}">
                   <img class="supplier-image" src="{{ $customer->image?asset('img/customers/'.$customer->image):asset('img/default-avatar.png') }}">
                 </a>
                 <div class="row">
                   <div class="col-md-12">
                     <div class="supplier-title">
                       <a href="{{ route('market_customer',['customer_id' => $customer->id]) }}">
                       <h3>{{ $customer->name }}</h3>
                       </a>
                     </div>
                     <div class="supplier-category">
                       <h5>Москва</h5>
                     </div>
                   </div>
                   <div class="col-md-12">
                     <div class="supplier-button">
                       <a href="{{ route('market_customer',['customer_id' => $customer->id]) }}" class="btn btn-success invite-vendor" data-vendor-id="2816" style="width: 100%">Посмотреть</a>
                     </div>
                   </div>
                 </div>
               </div>
             </div>
             @endforeach
           </div>
       </div>
   </div>
@endif

@stop
