@extends('customer.customer')

@section('title')
Заказы
@stop

@section('content')
<div class="container">
  <section class="content-header">
      <h3>
          <i class="fa fa-history" style="margin-right: 15px;"></i>Заказы<small style="margin-left: 10px;">Список всех созданных заказов</small>
      </h3>
  </section>
@if($orders == 'noorders')
<div class="row">
    <div class="col-md-12 table-responsive">
      <table class="table table-bordered">
  <thead>
    <tr>
      <th scope="col">№</th>
      <th scope="col">Клиент</th>
      <th scope="col">Продукт</th>
      <th scope="col">Дата Заказа</th>
      <th scope="col">Стоимость</th>
      <th scope="col">Одобрено</th>
      <th scope="col">Статус</th>
      <th scope="col">Дата Прибытия Продукта</th>
    </tr>
  </thead>
  <tbody>
    <tr>
    <p>Ничего не найдено</p>
  </tr>
  </tbody>
</table>
</div>
</div>
@elseif($orders == 'notregistered')
  <center><h3>Вы еше не добавили информацию про вашего организации.</h3></center>
@else
  <div class="row">
      <div class="col-md-12 table-responsive">
        <table class="table table-bordered">
    <thead>
      <tr>
        <th scope="col">№</th>
        <th scope="col">Поставщик</th>
        <th scope="col">Продукт</th>
        <th scope="col">Дата Заказа</th>
        <th scope="col">Количество</th>
        <th scope="col">Стоимость</th>
        <th scope="col">Кешбек(1%)</th>
        <th scope="col">Одобрено</th>
        <th scope="col">Статус</th>
        <th scope="col">Дата Прибытия Продукта</th>
      </tr>
    </thead>
    <?php
        $num = 1;
     ?>
    @foreach($orders as $order)
    <?php
        $product = App\Product::where('id',$order->products_id)->first();
     ?>
    <tbody>
      <tr>
        <td scope="row">{{ $num++ }}</td>
        <td>{{ $order->seller->name }}</td>
        <td>{{ $product->name }}</td>
        <td>{{ $order->created_at }}</td>
        <td>{{ $order->quantity }}</td>
        <td>{{ $order->price }} SO'M</td>
        <td>{{ $order->price*0.01 }}</td>
        @if($order->status == 'waiting')
          <td>Нет</td>
          <td>Ожидается</td>
          <td>Ожидается</td>
        @else
          <td>Да</td>
          <td>Закончено</td>
          <td>{{ $order->planned_on }}</td>
        @endif
      </tr>
    </tbody>
    @endforeach
  </table>
  </div>
</div>
@endif
@stop
