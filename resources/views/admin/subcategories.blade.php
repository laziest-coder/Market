@extends('admin.master')

@section('title')
Саб Категории
@stop

@section('content')
<style>
.plus {
    width: 50px;
    height: 50px;
    margin-right: 10px;
}
.pl {
  display: inline-flex;
}
</style>
<div class="container">
  <h3>Саб категории:</h3>
  <div class="container">
    <div class="pl">
    <a href="{{ route('subadd',['product_id' => $subcats[0]->product_category->id]) }}"><img src="{{ asset('img/plus.png') }}" class="plus"></a><h3> Добавить</h3>
    </div>
  </div>
  @foreach($subcats as $sub)
  <div class="row">
      <div class="col-md-8"><p class="form-control">{{ $sub->name }}</p></div>
      <div class="col-md-2"><a href="{{ route('subcategories.edit',['product_id' => $sub->product_category->id,'subcat_id' => $sub->id]) }}"><button class="btn btn-success">Изменить</button></a></div>
      {!! Form::open(['route' => ['subcategories.delete','product_id' => $sub->product_category->id,'subcat_id' => $sub->id],'method' => 'delete']) !!}
        <div class="col-md-2"><button class="btn btn-danger" style="background-color: red; color: white;">Удалить</button></div>
      {!! Form::close() !!}
  </div>
  @endforeach
</div>
@stop
