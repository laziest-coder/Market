@extends('customer.customer')

@section('title')
Настройки | Изменить
@stop

@section('content')

<div class="container">
	<section class="content-header">
    <h3>
        <i class="fa fa-gears"></i> Изменение настройки<small>Информация об организации</small>
    </h3>
    </section>
	<br>
	@include('layouts._flash')
	{!! Form::open(['route' => ['cust_settings.update','cust_setting' => $customer[0]->id], 'method' => 'PUT','files' => 'true']) !!}

	{{ Form::label('image','Аватар магазина:') }}
	{{ Form::file('image',['class' => 'form-control ig']) }}

	{{ Form::label('name','Название магазина:') }}
	{{ Form::text('name', $customer[0]->name, ['class' => 'form-control', 'placeholder' => 'Введите имя магазина']) }}

	{{ Form::label('owner','Владелец магазина:') }}
	{{ Form::text('owner', $customer[0]->owner, ['class' => 'form-control', 'placeholder' => 'Введите имя владелеца магазина']) }}

	{{ Form::label('website','Вебсайт магазина:') }}
	{{ Form::text('website', $customer[0]->website, ['class' => 'form-control','placeholder' => 'Введите вебсайт магазина']) }}

	{{ Form::label('address','Адрес магазина:') }}
	{{ Form::text('address', $customer[0]->address, ['class' => 'form-control','placeholder' => 'Введите адрес магазина']) }}

	{{ Form::label('info','Описание:') }}
	{{ Form::textarea('info', $customer[0]->info, ['class' => 'form-control','placeholder' => 'Введите описание о магазине']) }}

	<div class="container">
		<h3>Контактное лицо:</h3>
		<div class="row">
			<div class="col-md-3">
				{{ Form::label('fio','ФИО контактного лица:') }}
				{{ Form::text('fio', $customer[0]->contact->fio, ['class' => 'form-control','placeholder' => 'Введите ФИО контактного лица']) }}
			</div>
			<div class="col-md-3">
				{{ Form::label('email','E-mail:') }}
				{{ Form::text('email', $customer[0]->contact->email, ['class' => 'form-control','placeholder' => 'Введите e-mail контактного лица']) }}
			</div>
			<div class="col-md-3">
				{{ Form::label('phoneNumber','Телефон:') }}
				{{ Form::text('phoneNumber', $customer[0]->contact->phoneNumber, ['class' => 'form-control','placeholder' => 'Введите телефон контактного лица']) }}
			</div>
		</div>
	</div>
	<br>
	{{ Form::submit('Изменить', ['class' => 'btn btn-success']) }}
	{!! Form::close() !!}<br>
</div>
@stop
