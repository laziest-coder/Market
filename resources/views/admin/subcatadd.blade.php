@extends('admin.master')

@section('title')
Добавление саб-категория
@stop

@section('content')
<div class="container">
  {!! Form::open(['route' => ['subcategories.add.post','product_id' => $category->id],'method' => 'post']) !!}
    <h3>Предналежащий категории:</h3>
    <p class="form-control">{{ $category->name }}</p>
    <h3>Название саб категории:</h3>
    <input type="text" name="sub" placeholder="Введите название саб-категория" class="form-control"><br>
    <input type="submit" value="Добавить" class="btn btn-success">
  {!! Form::close() !!}
</div>
@stop
