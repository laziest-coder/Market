@extends('market.master')

@section('content')
<div class="col-md-12">

<style>
  .mp-supplier-image{
  object-fit: cover;
  width: 100%;
  height: 193px;
  padding: 15px 0px;
  }
  .mp-supplier-article{
  width:100%;
  display:inline-block;
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
  btn-cart-active i{
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
.title-param{
font-family: "HelveticaBold",Arial,sans-serif;
}
</style>
@foreach($seller as $sel)
<div class="row">
    <ul class="breadcrumb"><li><a href="{{ url('market/vendors') }}">Все поставщики</a></li>
<li class="active">{{ $sel->name }}</li>
</ul></div>
<div class="row">
<div class="col-md-12 mp-block">
    <div class="row">
      <div class="col-md-8 col-lg-8">
          <div class="row">
              <div class="col-md-12">
                  <h3>{{ $sel->name }}</h3>
                  <h5><span class="title-param">Контактное лицо:</span> {{ $sel->contact->fio }}</h5>
                  <h5><span class="title-param">Телефон:</span> {{ $sel->contact->phoneNumber }}</h5>
                  <h5><span class="title-param">Emaol:</span> {{ $sel->contact->email }}</h5>
                  <hr>
              </div>
                              <div class="col-md-6 mp-block-left">
                  <div class="row">
                      <div class="col-md-12 no-padding">
                          <div class="product-button">
                            <a href="{{ route('vendor_catalog',['vendor_id' => $sel->id]) }}" class="btn btn-100 btn-success view-catalog" data-product-id="">
                                <isc></isc>&nbsp;&nbsp;КАТАЛОГ                              </a>
                          </div>
                      </div>
                  </div>
              </div>

          </div>
      </div>
      <div class="col-md-4 col-lg-4">
              <img class="mp-supplier-image" src="{{ $sel->image?asset('img/sellers/'.$sel->image):asset('img/default-avatar.png') }}">
      </div>
      <div class="col-md-12" style="padding-top:25px">

              <h5><span class="title-param">Адрес:</span> {{ $sel->address }}</h5>

      </div>
      <div class="col-md-12">
          <div class="row">
              <div class="col-md-6">
                  <h4>ОПИСАНИЕ</h4>
              </div>
          </div>
      </div>
      <div class="col-md-12">
          <div class="row">
              <div class="col-md-12">
                  <div class="col-md-12" style="padding-bottom:10px;">{{ $sel->info }}</div>
              </div>
          </div>
      </div>
    </div>
</div>
</div>
  </div>
  @endforeach
@stop
