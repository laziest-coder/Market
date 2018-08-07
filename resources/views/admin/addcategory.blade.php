@extends('admin.master')

@section('title')
Добавить категории
@stop

@section('content')
<style>
  .plus {
      width: 50px;
      height: 50px;
      margin-right: 10px;
  }
  .pl h3 {
      margin: auto;
  }
    .supplier-image {
      height: 150px;
    }
    .invite-vendor {
      color: white;
    }
    .container {
      margin-top: 8px;
    }
    .pl {
      display: inline-flex;
    }
</style>
<div class="container">
  <section class="content-header">
      <h3>
          <i class="fa fa-list-alt" style="margin-right: 15px;"></i>Добавление категории
      </h3>
  </section>
  <div class="container">
    <div class="pl">
    <a href="{{ route('addui') }}"><img src="{{ asset('img/plus.png') }}" class="plus"></a><h3> Добавить</h3>
    </div>
  </div><br>
  @include('layouts._flash')
  <div class="row">
      <div class="col-md-12 table-responsive">
        <table class="table table-bordered">
    <thead>
      <tr>
        <th scope="col">#</th>
        <th scope="col">Название Категория</th>
        <th scope="col">Название Саб Категория</th>
        <th scope="col">Изменение Саб Категории</th>
      </tr>
    </thead>
    <?php
        $num = 1;
     ?>
    <tbody>
      @foreach($category as $cat)
      <tr>
          <th scope="col"><a href="{{ route('category.edit',['category_id' => $cat->id]) }}">{{ $num++ }}</a></th>
          <th scope="col">{{ $cat->name }}</th>
          <th scope="col">
            @foreach($cat->sub_product_category as $sub)
            {{ $sub->name.',' }}
            @endforeach
          </th>
          <th scope="col"><a href="{{ route('product.subcategories',['product_id' => $cat->id]) }}">Изменить</a></th>
      </tr>
      @endforeach
    </tbody>
  </table>
</div>
</div>
@stop
