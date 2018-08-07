@extends('admin.master')

@section('title')
Изменение саб категории
@stop

@section('content')
<div class="container">
  {!! Form::open(['route' => ['subcategories.edit.put','product_id' => $subcat->product_category->id,'subcat_id' => $subcat->id],'method' => 'put']) !!}
    <h3>Предналежащий категории:</h3>
    <p class="form-control">{{ $subcat->product_category->name }}</p>
    <h3>Название саб категории:</h3>
    <input type="text" name="sub" value="{{ $subcat->name }}" class="form-control"><br>
    <input type="submit" value="Изменить" class="btn btn-success">
  {!! Form::close() !!}
</div>
@stop
