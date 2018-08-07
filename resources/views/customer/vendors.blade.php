@extends('customer.customer')

@section('title')
Поставщики
@stop

@section('content')
  <div class="container">
    <section class="content-header">
        <h3>
            <i class="fa fa-users" style="margin-right: 15px;"></i>Поставщики<small style="margin-left: 10px;">Список всех поставщиков</small>
        </h3>
    </section><br>
    <div class="row" id="supplier-block">
      @foreach($sellers as $seller)
                <div class="col-xs-12 col-sm-6 col-md-6 col-lg-4 col-xl-3 min-padding">
        <div class="mp-suppiler-block animated fadeIn">
          <a href="{{ route('market_vendor',$seller->id) }}" class="anchor">
            <img class="supplier-image  animated fadeInUp" src="{{ $seller->image?asset('img/sellers/'.$seller->image):asset('img/default-avatar.png') }}">
          </a>
          <div class="row">
            <div class="col-md-12">
              <div class="supplier-title">
                <a href="{{ route('market_vendor',$seller->id) }}">
                <h3>Название: {{ $seller->name }}</h3>
                </a>
              </div>
              <div class="supplier-category">
                <h5>Адрес: {{ $seller->address }}</h5>
              </div>
            </div>
            <div class="col-md-12">
              <div class="supplier-button">
                <a href="{{ route('market_vendor',$seller->id) }}" class="btn btn-100 btn-success invite-vendor" data-vendor-id="2816" style="width: 100%">Посмотреть</a>
              </div>
            </div>
          </div>
        </div>
      </div>
        @endforeach
    </div>
  </div>
  <style>
   .supplier-image {
     max-width: 100%;
   }
   .invite-vendor {
     color: white;
   }
  </style>
@stop
