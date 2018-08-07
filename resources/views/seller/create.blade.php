@extends('seller.master')

@section('title')
Мои каталоги | Создать
@stop

@section('content')
  <div class="container">
    <section class="content-header">
    <h3 class="margin-right-350">
        <i class="fa fa-list-alt" style="margin-right: 10px;"></i> Добавление каталога<small></small>
    </h3>
    </section>
    @include('layouts._flash')
    {!! Form::open(['route' => 'catalogs.store', 'method' => 'POST', 'files' => 'true']) !!}

    {{ Form::label('name', 'Название продукта:') }}
    {{ Form::text('name', null , ['class' => 'form-control','placeholder' => 'Введите название продукта']) }}
    <br>
    <div class="row">
      {{ Form::label('sub_product_category_id', 'Категория:') }}
      <select name="sub_product_category_id" class="form-control" style="padding-right: 10px;">
        @foreach($subs as $sub)
          <option>{{ $sub->name }}</option>
        @endforeach
      </select>
    </div><br>
    {{ Form::label('price','Цена:') }}
    {{ Form::text('price', null , ['class' => 'form-control','placeholder' => 'Введите цена продукта']) }}
    <br><div class="tok">
      <label style="margin-top: 10px;margin-right: 10px;">Скидка:</label>
      <label class="switch">
        <input type="checkbox" id="chk" onclick="is_sale()" name="sale">
        <span class="slider round"></span>
      </label>
    </div><br><br>
    {{ Form::label('sale_amount','Процент скидки:',['id' => 'sale']) }}
    {{ Form::text('sale_amount',null,['class' => 'form-control','id' => 'kana','placeholder' => 'Введите процент скидки продукта']) }}
    {{ Form::label('image', 'Изображение продукта:') }}
  	{{ Form::file('image',['class' => 'form-control ig']) }}
    <br>{{ Form::label('description','Комментария про продукта:') }}
    {{ Form::textarea('description',null,['class' => 'form-control','placeholder' => 'Введите комментария про продукта']) }}
    <br>
    {{ Form::submit('Добавить', ['class' => 'btn btn-primary bl']) }}

    {!! Form::close() !!}
  </div><br>
  <script>
    function is_sale()
    {
      var el = document.getElementById("sale");
      var ll = document.getElementById("kana");
      var chk = document.getElementById("chk");
      if(chk.checked == true){
        el.style.display = 'block';
        ll.style.display = 'block';
      }else{
        el.style.display = 'none';
        ll.style.display = 'none';
      }
    }
  </script>
  <style>
  #sale,#kana {
    display: none;
  }
  .tok {
    display: inline-flex;
  }
    .bl {
      color: white;
      background-color: blue;
    }
    .switch {
  position: relative;
  display: inline-block;
  width: 60px;
  height: 34px;
}

.switch input {display:none;}

.slider {
  position: absolute;
  cursor: pointer;
  top: 0;
  left: 0;
  right: 0;
  bottom: 0;
  background-color: #ccc;
  -webkit-transition: .4s;
  transition: .4s;
}

.slider:before {
  position: absolute;
  content: "";
  height: 26px;
  width: 26px;
  left: 4px;
  bottom: 4px;
  background-color: white;
  -webkit-transition: .4s;
  transition: .4s;
}

input:checked + .slider {
  background-color: #2196F3;
}

input:focus + .slider {
  box-shadow: 0 0 1px #2196F3;
}

input:checked + .slider:before {
  -webkit-transform: translateX(26px);
  -ms-transform: translateX(26px);
  transform: translateX(26px);
}

/* Rounded sliders */
.slider.round {
  border-radius: 34px;
}

.slider.round:before {
  border-radius: 50%;
}
    </style>
@stop
