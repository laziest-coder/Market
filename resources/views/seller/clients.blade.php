@extends('seller.master')

@section('title')
Мои клиенты
@stop

@section('content')
<style>
  .plus {
      width: 50px;
      height: 50px;
      margin-right: 10px;
  }
  .pl h3 {
      margin: auto;
  }
    .supplier-image {
      height: 200px;
    }
    .invite-vendor {
      color: white;
    }
    .container {
      margin-top: 8px;
    }
</style>
<div class="container">
  <section class="content-header">
      <h3>
          <i class="fa fa-users" style="margin-right: 15px;"></i> Мои клиенты        <small></small>
      </h3>
  </section>
    @if($customers == 'nocustomerfound')
      <center><h3>К сожелению, у вас нет никаких клиентов :(</h3></center>
    @elseif($customers == 'notaddedinfo')
      <center><h3>Вы не добавили информацию про вашего организации.</h3></center>

  @else
  <div class="row" id="supplier-block">
      @foreach($customers as $customer)
      <?php
          $cust = App\Customer::where('id',$customer->customer_id)->first();
       ?>
              <div class="col-xs-12 col-sm-6 col-md-6 col-lg-4 col-xl-4 min-padding">
      <div class="mp-suppiler-block animated fadeIn">
          <a href="{{ route('market_customer',$cust->id) }}">
            <img class="supplier-image  animated fadeInUp" src="{{ $cust->image ? asset('img/customers/'.$cust->image): asset('img/default-avatar.png') }}">
          </a>
        <div class="row">
          <div class="col-md-12">
            <div class="supplier-title">
              <a href="{{ route('market_customer',$cust->id) }}">
              <h3>Названия: {{ $cust->name }}</h3>
              </a>
            </div>
            <div class="supplier-category">
              <h5>Адрес: {{ $cust->address }}</h5>
            </div>
          </div>
          <div class="col-md-12">
            <div class="supplier-button">
                <a href="{{ route('market_customer',$cust->id) }}"><button type="submit" class="btn btn-100 btn-success invite-vendor" style="width:100%">Посмотреть</button></a>
            </div>
          </div>
        </div>
      </div>
    </div>
    @endforeach
  </div>
  @endif
</div>
@if(is_array($customers))
  @if(is_numeric(count($customers)))
  <div class="text-center">
    {!! $customers->links(); !!}
  </div>
  @endif
@endif
@stop
