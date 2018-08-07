@extends('customer.customer')

@section('title')
Заявки
@stop

@section('content')
<div class="container">
  <section class="content-header">
      <h3>
          <i class="fa fa-paper-plane" style="margin-right: 15px;"></i>Заявки<small style="margin-left: 10px;">Список всех заявков</small>
      </h3>
  </section>
  @if($offers == 'notaddedinfo')
  <center><h3>Вы не добавили информацию про вашего организации.</h3></center>
  @else
  @if(count($offers) > 0)
  <table class="table table-bordered">
  <thead>
    <tr>
      <th scope="col">#</th>
      <th scope="col">Поставщик</th>
      <th scope="col">Дата</th>
      <th scope="col">Комментарий</th>
    </tr>
  </thead>
  <tbody>
    <?php
        $num = 1;
     ?>
    @foreach($offers as $offer)
    <tr>
      <th scope="row"><a href="{{ route('offaccept',['offer_id' => $offer->id]) }}">{{ $num++ }}</a></th>
      <td>{{ $offer->seller->name }}</td>
      <td>{{ $offer->created_at }}</td>
      <td>{{ $offer->comment }}</td>
    </tr>
    @endforeach
  </tbody>
</table>
@else
<center><h3>У вас нет никаких заявков :(</h3></center>
@endif
@endif
</div>
@stop
