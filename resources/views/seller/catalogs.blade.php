@extends('seller.master')

@section('title')
Мои каталоги
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
  <link href="{{ asset('css/mixmarket.css') }}" rel="stylesheet">
  <div class="container">
    <section class="content-header">
        <h3>
            <i class="fa fa-list-alt" style="margin-right: 15px;"></i> Мои каталоги<small></small>
        </h3>
    </section>
      @if($products == 'noproductfound')
      <div class="pl">
      <a href="{{ route('catalogs.create') }}"><img src="{{ asset('img/plus.png') }}" class="plus"></a><h3>Добавить</h3>
      </div><hr>
        <center><h3>Вы еще не добавили каталог</h3></center>
      @elseif($products == 'notaddedinfo')
        <center><h3>Вы не добавили информацию про вашего организации.</h3></center>

    @else
    <div class="container">
      <div class="pl">
      <a href="{{ route('catalogs.create') }}"><img src="{{ asset('img/plus.png') }}" class="plus"></a><h3> Добавить</h3>
      </div>
    </div>
    <br>
    @include('layouts._flash')
    <div class="row" id="supplier-block">
      @foreach($products as $product)
                <div class="col-xs-12 col-sm-6 col-md-6 col-lg-4 col-xl-4 min-padding">
        <div class="mp-suppiler-block animated fadeIn">
            <a href="{{ route('info',['product_id' => $product->id]) }}">
              <img class="supplier-image  animated fadeInUp" height="100%" max-with="100%" src="{{ $product->image ? asset('img/products/'.$product->image): asset('img/defaults/'.$product->sub_product_category->product_category->image) }}">
            </a>
          <div class="row">
            <div class="col-md-12">
              <div class="supplier-title">
                <a href="{{ route('info',['product_id' => $product->id]) }}">
                <h3>Название: {{ $product->name }}</h3>
                </a>
              </div>
              <div class="supplier-category">
                <h5>Категория: {{ $product->sub_product_category->name }}</h5>
              </div>
            </div>
            <div class="col-md-12">
              <div class="supplier-button">
                {!! Form::open(['route' => ['catalogs.edit', $product->id], 'method' => 'GET']) !!}
                  {{ Form::submit('Изменить', ['class' => 'btn btn-100 btn-success invite-vendor', 'style' => 'width:100%' ]) }}
                {!! Form::close() !!}
              </div><br>
              <div class="supplier-button">
                {!! Form::open(['route' => ['catalogs.destroy', $product->id], 'method' => 'DELETE']) !!}
                  {{ Form::submit('Удалить',['class' => 'btn btn-danger', 'style' => 'width: 100%']) }}
                {!! Form::close() !!}
              </div>
            </div>
          </div>
        </div>
      </div>
      @endforeach
    </div>
    @endif
  </div>

    @if(is_numeric(count($products)))
    <div class="text-center">
        {!! $products->links(); !!}
    </div>
    
  @endif
@stop
