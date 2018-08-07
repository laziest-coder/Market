@extends('admin.master')

@section('title')
Данные продукта
@stop

@section('content')
<div class="container">
  <h3>Данные продукта:</h3>
  <label>Название продукта:</label>
  <p class="form-control">{{ $product->name }}</p>
  <label>Цена продукта:</label>
  <p class="form-control">{{ $product->price }}</p>
  <label>Описание продукта:</label>
  <div id="des" class="container">
    <p class="">{{ $product->description }}</p>
  </div>
  <label>Поставщик продукта:</label>
  <p class="form-control">{{ $product->seller->name }}</p>
  {!! Form::open(['route' => ['product.delete',$product->id],'method' => 'DELETE']) !!}
    {{ Form::submit('Удалить этот продукт',['class' => 'btn btn-danger dan']) }}
  {!! Form::close() !!}
</div>
<style>
  .dan {
    background-color: red;
    color: white;
  }
  #des {
    border: 1px solid #e0e0d1;
    background-color: white;
  }
</style>
@stop
