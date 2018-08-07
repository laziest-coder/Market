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
@foreach($customer as $cust)
<div class="row">
    <ul class="breadcrumb"><li><a href="{{ url('market/customers') }}">Все клиенты</a></li>
<li class="active">{{ $cust->name }}</li>
</ul></div>
<div class="row">
<div class="col-md-12 mp-block">
    <div class="row">
      <div class="col-md-8 col-lg-8">
          <div class="row">
              <div class="col-md-12">
                  <h3>{{ $cust->name }}</h3>
                  <h5><span class="title-param">Контактное лицо:</span> {{ $cust->contact->fio }}</h5>
                  <h5><span class="title-param">Телефон:</span> {{ $cust->contact->phoneNumber }}</h5>
                  <h5><span class="title-param">Email:</span> {{ $cust->contact->email }}</h5>
                  <hr>
              </div>
              <div class="col-md-6 mp-block-left">
                  <div class="row">
                      <div class="col-md-12 no-padding">
                        @if(Auth::check())
                          @if(Auth::user()->role == 'customer')
                          <!-- Button to Open the Modal -->
                            <div class="product-button">
                                <a href="#" class="btn btn-100 btn-success" data-toggle="modal" data-target="#myModal"><span class="pe-7s-cart"></span> Предложить услуги</a>
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
                                    <h4>Вы не являйтесь поставщиком чтобы ПРЕДЛОЖИТЬ УСЛУГИ!</h4>
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
                              <a href="{{ route('offer',['customer_id' => $cust->id]) }}" class="btn btn-100 btn-success view-catalog" data-product-id="">
                                  <isc></isc>&nbsp;&nbsp;Предложить услуги</a>
                            </div>
                          @endif
                        @else
                          <div class="product-button">
                            <a href="{{ route('login') }}" class="btn btn-100 btn-success view-catalog" data-product-id="">
                                <isc></isc>&nbsp;&nbsp;Предложить услуги</a>
                          </div>
                        @endif
                      </div>
                  </div>
              </div>
          </div>
      </div>
      <div class="col-md-4 col-lg-4">
              <img class="mp-supplier-image" src="{{ $cust->image?asset('img/customers/'.$cust->image):asset('img/default-avatar.png') }}">
      </div>
      <div class="col-md-12" style="padding-top:25px">
              <h5><span class="title-param">Адрес:</span> {{ $cust->address }}</h5>
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
                  <div class="col-md-12" style="padding-bottom:10px;">{{ $cust->info }}</div>
              </div>
          </div>
      </div>
    </div>
</div>
</div>
  </div>
  @endforeach
@stop
