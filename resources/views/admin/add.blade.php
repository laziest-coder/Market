@extends('admin.master')

@section('title')
Добавить категории
@stop

@section('content')
<div class="container">
  <section class="content-header">
      <h3>
          <i class="fa fa-list-alt" style="margin-right: 15px;"></i>Добавление категории
      </h3>
  </section>
  @include('layouts._flash')
  <form method="post" action="{{ route('catpost') }}" enctype="multipart/form-data">
    {{ csrf_field() }}
    <label for="name">Название категория:</label>
    <input type="text" class="form-control" name="name">
    <label for="sub">Название саб-категория:</label>
    <input type="text" class="form-control" name="sub"><br>
    <label>Дефаултная изображение продукта:</label>
    <input type="file" class="form-control ig" name="image"><br>
    <input type="submit" class="btn btn-success" value="Добавить">
  </form>
</div>
@stop
