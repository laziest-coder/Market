@extends('admin.master')

@section('title')
Все пользователи
@stop

@section('content')
<div class="container">
  <section class="content-header">
      <h3>
          <i class="fa fa-users" style="margin-right: 15px;"></i>Пользователи<small style="margin-left: 10px;">Список всех пользователей</small>
      </h3>
  </section>
  <div class="row">
      <div class="col-md-12 table-responsive">
        <table class="table table-bordered">
    <thead>
      <tr>
        <th scope="col">#</th>
        <th scope="col">Пользователь</th>
        <th scope="col">Роль</th>
        <th scope="col">Одобрено</th>
      </tr>
    </thead>
    <tbody>
      <?php
          $num = 1;
       ?>
      @foreach($users as $user)
      <tr>
        <td><a href="{{ route('userinfo',['user_id' => $user->id]) }}">{{ $num++ }}</a></td>
        <td>{{ $user->name }}</td>
        @if($user->role == 'seller')
          <td>Поставщик</td>
        @else
          <td>Покупатель</td>
        @endif
        @if($user->is_valid == 0)
          <td>Нет</td>
        @else
          <td>Да</td>
        @endif
      </tr>
      @endforeach
    </tbody>
  </table>
</div>
</div>
</div>

@stop
