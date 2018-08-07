@extends('admin.master')

@section('title')
Заказы
@stop

@section('content')
<div class="container">
  <section class="content-header">
      <h3>
          <i class="fa fa-history" style="margin-right: 15px;"></i>Заказы<small style="margin-left: 10px;">Список всех заказов</small>
      </h3>
  </section>
  @if(count($orders) == 0)
  <div class="row">
      <div class="col-md-12 table-responsive">
        <table class="table table-bordered">
    <thead>
      <tr>
        <th scope="col">#</th>
        <th scope="col">От кого</th>
        <th scope="col">Кому</th>
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
  @else
  <div class="row">
      <div class="col-md-12 table-responsive">
        <table class="table table-bordered">
    <thead>
      <tr>
        <th scope="col">#</th>
        <th scope="col">От кого</th>
        <th scope="col">Кому</th>
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
      <tbody>
        <?php
            $product = App\Product::where('id',$order->products_id)->first();
         ?>
        <tr>
          <td>{{ $num++ }}</td>
          <td>{{ $order->customer->name }}</td>
          <td>{{ $order->seller->name }}</td>
          <td>{{ $product->name }}</td>
          <td>{{ $order->created_at }}</td>
          <td>{{ $order->quantity }}</td>
          <td>{{ $order->price }}</td>
          <td>{{ $order->price*0.01 }}</td>
          @if($order->status == 'waiting')
            <td>Нет</td>
            <td>Ожидается</td>
            <td>Ожидается</td>
          @else
            <td>Да</td>
            <td>Закончено</td>
            <td>{{ date('Y-m-d',strtotime($order->planned_on)) }}</td>
          @endif
        </tr>
      </tbody>
     @endforeach
  </table>
  </div>
  </div>
</div>
@endif
@stop
