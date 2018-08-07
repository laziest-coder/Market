@extends('market.master')

@section('content')
<div class="col-md-12">
    <div class="row">
    <div class="col-md-12">
      <h3>Клиенты <small></small></h3>
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
                    <h5>{{ $customer->address }}</h5>
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
  </div>
  <div class="text-center">
      {!! $customers->links(); !!}
  </div>
@stop
