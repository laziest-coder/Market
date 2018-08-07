@extends('seller.master')

@section('title')
Настройки | Изменить
@stop

@section('content')

<div class="container">
	<section class="content-header">
    <h3>
        <i class="fa fa-gears" style="margin-right: 10px;"></i> Изменение настройки<small style="margin-left: 10px;">Информация об организации</small>
    </h3>
    </section>
	<br>
	@include('layouts._flash')
	{!! Form::open(['route' => ['settings.update','setting' => $seller[0]->id], 'method' => 'PUT', 'files' => 'true']) !!}

	{{ Form::label('image','Аватар поставщика:') }}
	{{ Form::file('image',['class' => 'form-control ig']) }}

	{{ Form::label('name','Название поставщика:') }}
	{{ Form::text('name', $seller[0]->name, ['class' => 'form-control', 'placeholder' => 'Введите имя поставщика']) }}

	{{ Form::label('owner','Владелец поставщика:') }}
	{{ Form::text('owner', $seller[0]->owner, ['class' => 'form-control', 'placeholder' => 'Введите имя владелеца поставщика']) }}

	{{ Form::label('website','Вебсайт поставщика:') }}
	{{ Form::text('website', $seller[0]->website, ['class' => 'form-control','placeholder' => 'Введите вебсайт поставщика']) }}

	{{ Form::label('address','Адрес поставщика:') }}
	{{ Form::text('address', $seller[0]->address, ['class' => 'form-control','placeholder' => 'Введите адрес поставщика']) }}

	{{ Form::label('info','Описание про поставщика:') }}
	{{ Form::textarea('info', $seller[0]->info, ['class' => 'form-control','placeholder' => 'Введите описание о поставщике']) }}

	<div class="container">
		<h3>Контактное лицо:</h3>
		<div class="row">
			<div class="col-md-3">
				{{ Form::label('fio','ФИО контактного лица::') }}
				{{ Form::text('fio', $seller[0]->contact->fio, ['class' => 'form-control','placeholder' => 'Введите ФИО контактного лица']) }}
			</div>
			<div class="col-md-3">
				{{ Form::label('email','E-mail:') }}
				{{ Form::text('email', $seller[0]->contact->email, ['class' => 'form-control','placeholder' => 'Введите e-mail контактного лица']) }}
			</div>
			<div class="col-md-3">
				{{ Form::label('phoneNumber','Телефон:') }}
				{{ Form::text('phoneNumber', $seller[0]->contact->phoneNumber, ['class' => 'form-control','placeholder' => 'Введите телефон контактного лица']) }}
			</div>
		</div>
	</div>
	<br>
	{{ Form::submit('Изменить', ['class' => 'btn btn-success']) }}
	{!! Form::close() !!}
</div><br>

@stop
