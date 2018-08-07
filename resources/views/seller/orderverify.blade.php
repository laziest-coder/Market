@extends('seller.master')

@section('title')
Заказы
@stop

@section('content')
  <div class="container">
    <h2>Одобрение заказа:</h2>

    <label for="">Клиент:</label>
    <p class="form-control">{{ $customer->name }}</p>

    <label for="">Цена:</label>
    <p class="form-control">{{ $order->price }}</p>

    <label for="">Количество:</label>
    <p class="form-control">{{ $order->quantity }}</p>

    <label for="">Комментария:</label>
    <div class="container" id="des">
      <p>{{ $order->comment }}</p>
    </div>

    <h3>Выберите дату доставку продукта:</h3>
    {!! Form::open(['route' => ['verifycomplete', 'order_id' => $order->id], 'method' => 'PUT']) !!}
    {{ Form::date('planned_on') }}
    <br><br>
    {{ Form::submit('Одобрить', ['class' => 'btn btn-success']) }}

    {!! Form::close() !!}
  </div>
  <style>
  #des {
    border: 1px solid #e0e0d1;
    background-color: white;
  }
  </style>
@stop
