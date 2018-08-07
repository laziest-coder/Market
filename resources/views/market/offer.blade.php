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
<div class="row">
    <ul class="breadcrumb"><li><a href="{{ url('market/customers') }}">Все клиенты</a></li>
<li class="active">{{ $customer->name }}</li>
</ul></div>
<div class="row">
<div class="col-md-12 mp-block">
    <div class="row">
      <div class="col-md-8 col-lg-8">
          <!-- <div class="row"> -->
              <div class="col-md-12">
                  <h3>{{ $customer->name }}</h3>
                  <h5><span class="title-param">Контактное лицо:</span> {{ $customer->contact->fio }}</h5>
                  <h5><span class="title-param">Телефон:</span> {{ $customer->contact->phoneNumber }}</h5>
                  <h5><span class="title-param">Email:</span> {{ $customer->contact->email }}</h5>
                  <h5><span class="title-param">Адрес:</span> {{ $customer->address }}</h5>
                  <hr>
              </div>
          <!-- </div> -->
      </div>
      <div class="col-md-4 col-lg-4">
              <img class="mp-supplier-image" src="{{ $customer->image?asset('img/customers/'.$customer->image):asset('img/default-avatar.png') }}">
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
              <div class="col-md-6">
                  <div class="col-md-12" style="padding-bottom:10px;">{{ $customer->info }}</div>
              </div>
          </div>
      </div>
      <div class="col-md-12">
        @include('layouts._flash')
    </div>
      <div class="col-md-12">
        {!! Form::open(['route' => ['customeroffer', $customer->id],'method' => 'post']) !!}
          {{ Form::label('comment','Comment:') }}
          {{ Form::textarea('comment',null,['class' => 'form-control','placeholder' => 'Enter your offers heres']) }}<br>
          {{ Form::submit('Send',['class' => 'btn btn-success','style' => 'width:100%']) }}
        {!! Form::close() !!}<br>
      </div>
    </div>
</div>
</div>
  </div>
@stop
