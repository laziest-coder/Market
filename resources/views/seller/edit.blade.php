@extends('seller.master')

@section('title')
Мои каталоги | Изменить
@stop

@section('content')
  <div class="container">
    <section class="content-header">
    <h3 class="margin-right-350">
        <i class="fa fa-list-alt" style="margin-right: 10px;"></i> Редактирование каталога<small></small>
    </h3>
    </section>
    @include('layouts._flash')
    {!! Form::open(['route' => ['catalogs.update',$product->id], 'method' => 'PUT', 'files' => 'true']) !!}

    {{ Form::label('name', 'Название продукта:') }}
    {{ Form::text('name', $product->name , ['class' => 'form-control']) }}
    <br>
    <div class="row">
      {{ Form::label('sub_product_category_id', 'Category:') }}
      <select name="sub_product_category_id">
        @foreach($subs as $sub)
          <option>{{ $sub->name }}</option>
        @endforeach
      </select>
    </div><br>
    {{ Form::label('price','Цена:') }}
    {{ Form::text('price', $product->price , ['class' => 'form-control']) }}
    {{ Form::label('sale_amount','Процент скидки:') }}
    {{ Form::text('sale_amount',$product->sale_amount,['class' => 'form-control']) }}
    {{ Form::label('image','Изображение продукта:') }}
  	{{ Form::file('image',['class' => 'form-control ig']) }}
    {{ Form::label('description','Комментария про продукта:') }}
    {{ Form::textarea('description',$product->description,['class' => 'form-control']) }}
    <br>
    {{ Form::submit('Изменить', ['class' => 'btn btn-primary']) }}

    {!! Form::close() !!}
  </div><br>
@stop
