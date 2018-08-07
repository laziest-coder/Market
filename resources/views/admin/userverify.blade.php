@extends('admin.master')

@section('title')
Одобрение пользователя
@stop

@section('content')
<style>
.switch {
  position: relative;
  display: inline-block;
  width: 60px;
  height: 34px;
}

.switch input {display:none;}

.slider {
  position: absolute;
  cursor: pointer;
  top: 0;
  left: 0;
  right: 0;
  bottom: 0;
  background-color: #ccc;
  -webkit-transition: .4s;
  transition: .4s;
}

.slider:before {
  position: absolute;
  content: "";
  height: 26px;
  width: 26px;
  left: 4px;
  bottom: 4px;
  background-color: white;
  -webkit-transition: .4s;
  transition: .4s;
}

input:checked + .slider {
  background-color: #2196F3;
}

input:focus + .slider {
  box-shadow: 0 0 1px #2196F3;
}

input:checked + .slider:before {
  -webkit-transform: translateX(26px);
  -ms-transform: translateX(26px);
  transform: translateX(26px);
}

/* Rounded sliders */
.slider.round {
  border-radius: 34px;
}

.slider.round:before {
  border-radius: 50%;
}
</style>
  <div class="container">
    <section class="content-header">
        <h3>
              <i class="fa fa-users" style="margin-right: 15px;"></i>Одобрение<small style="margin-left: 10px;">Одобрение пользователя</small>
        </h3>
    </section>
    @if($data == 'notfound')
    <label>Имя пользователя:</label>
    <p class="form-control">{{ $user->name }}</p>
    <h3>Этот полтзователь еще не добавил информацию про организации</h3>
    {!! Form::open(['route' => ['userverifycomplete','user_id' => $user->id],'method' => 'PUT']) !!}
      <div class="row">
        <label style="top: -15px;position:relative;">Активировать:</label>
        <label class="switch">
          <input type="checkbox" name="active">
          <span class="slider round"></span>
        </label>
      </div>
      {{ Form::submit('Активировать',['class' => 'btn btn-success']) }}
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
        {!! Form::open(['route' => ['userverifycomplete','user_id' => $user->id],'method' => 'PUT']) !!}
          <div class="row">
            <label style="top: -15px;position:relative;">Активировать:</label>
            <label class="switch">
              <input type="checkbox" name="active">
              <span class="slider round"></span>
            </label>
          </div>
          {{ Form::submit('Активировать',['class' => 'btn btn-success']) }}
        {!! Form::close() !!}

  </div>
  @endif
@stop
