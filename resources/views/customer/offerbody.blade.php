@extends('customer.customer')

@section('content')
<div class="container">
  <section class="content-header">
      <h3>
          <i class="fa fa-paper-plane" style="margin-right: 15px;"></i>Заявки<small style="margin-left: 10px;">Список всех заявков</small>
      </h3>
  </section>
  <label for="">Поставщик:</label>
  <p class="form-control">{{ $offer->seller->name }}</p>
  <label for="">Дата:</label>
  <p class="form-control">{{ $offer->created_at }}</p>
  <label for="">Комментария поставщика:</label>
  <div class="container" id="des">
    <p>{{ $offer->comment }}</p>
  </div><br>
  <a href="{{ redirect()->back()->getTargetUrl() }}"><button class="form-control btn btn-success">Назад</button></a>
</div>
<style>
#des {
  border: 1px solid #e0e0d1;
  background-color: white;
}
</style>
@stop
