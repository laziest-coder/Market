@extends('admin.master')

@section('title')
Данные пользователя
@stop

@section('content')
<style>
  .btn-danger {
    background-color: red;
    color: white;
  }
</style>
  <div class="container">
    <section class="content-header">
        <h3>
              <i class="fa fa-users" style="margin-right: 15px;"></i>Данные пользователя<small style="margin-left: 10px;">Одобрение пользователя</small>
        </h3>
    </section>
    @if($data == 'notfound')
    <label>Имя пользователя:</label>
    <p class="form-control">{{ $user->name }}</p>
    <h3>Этот пользователь еще не добавил информацию про организации</h3>
    {!! Form::open(['route' => ['user.delete','user_id' => $user->id],'method' => 'DELETE']) !!}
      {{ Form::submit('Удалить этот пользователь',['class' => 'btn btn-danger']) }}
    {!! Form::close() !!}
    @else
      <label>Имя пользователя:</label>
      <p class="form-control">{{ $user->name }}</p>
      <label>Роль пользователя:</label>
      @if($user->role == 'seller')
        <p class="form-control">Поставщик</p>
        <h3>Данные о поставщика</h3>
        <label>Название поставщика:</label>
        <p class="form-control">{{ $data->name }}</p>
        <label>Адрес поставщика:</label>
        <p class="form-control">{{ $data->address }}</p>
        <div class="row">
          <div class="col-md-4">
            <label>Контактное лицо поставщика:</label>
            <p class="form-control">{{ $data->contact->fio }}</p>
          </div>
          <div class="col-md-4">
            <label>Контактное e-mail лицо поставщика:</label>
            <p class="form-control">{{ $data->contact->email }}</p>
          </div>
          <div class="col-md-4">
            <label>Контактное телефон лицо поставщика:</label>
            <p class="form-control">{{ $data->contact->phoneNumber }}</p>
          </div>
        </div>
      @else
        <p class="form-control">Покупатель</p>
        <h3>Данные о покупателя</h3>
        <label>Название покупателя:</label>
        <p class="form-control">{{ $data->name }}</p>
        <label>Адрес покупателя:</label>
        <p class="form-control">{{ $data->address }}</p>
        <div class="row">
          <div class="col-md-4">
            <label>Контактное лицо покупателя:</label>
            <p class="form-control">{{ $data->contact->fio }}</p>
          </div>
          <div class="col-md-4">
            <label>Контактное e-mail лицо покупателя:</label>
            <p class="form-control">{{ $data->contact->email }}</p>
          </div>
          <div class="col-md-4">
            <label>Контактное телефон лицо покупателя:</label>
            <p class="form-control">{{ $data->contact->phoneNumber }}</p>
          </div>
        </div>
        @endif
        {!! Form::open(['route' => ['user.delete','user_id' => $user->id],'method' => 'DELETE']) !!}
          {{ Form::submit('Удалить этот пользователь',['class' => 'btn btn-danger']) }}
        {!! Form::close() !!}

  </div>
  @endif
@stop
