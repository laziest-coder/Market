@extends('admin.master')

@section('title')
Добавить категории
@stop

@section('content')
<style>
  .del {
    background-color: red;
    color: white;
  }
  .k {
    display: inline-flex;
  }
</style>
<div class="container">
  <section class="content-header">
      <h3>
          <i class="fa fa-list-alt" style="margin-right: 15px;"></i>Добавление категории
      </h3>
  </section>
  @include('layouts._flash')
  {!! Form::open(['route' => ['category.update','category_id' => $category->id],'method' => 'PUT','files' => 'true']) !!}
    {{ Form::label('name','Название категория:') }}
    {{ Form::text('name',$category->name,['class' => 'form-control']) }}

    {{ Form::label('image','Дефаултная изображение продукта:') }}
    {{ Form::file('image',['class' => 'form-control ig']) }}
    <br>
    <div class="row k">
      {{ Form::submit('Изменить',['class' => 'btn btn-success']) }}
  {!! Form::close() !!}
  {!! Form::open(['route' => ['category.delete', 'category_id' => $category->id],'method' => 'DELETE','files' => 'true']) !!}
  {{ Form::submit('Удалить',['class' => 'btn btn-danger del']) }}
  {!! Form::close() !!}
</div>
</div>
@stop
