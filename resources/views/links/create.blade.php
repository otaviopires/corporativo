@extends('adminlte::page')

@section('content')
    <h1>Inserir novo link útil</h1>
    {!! Form::open(['action' => 'UsefulLinksController@store', 'method' => 'POST', 'enctype' => 'multipart/form-data']) !!}
        <div class="form-group">
            {{Form::label('name', 'Nome de link')}}
            {{Form::text('name', '', ['class' => 'form-control', 'placeholder' => 'Título'])}}
        </div>
		<div class="form-group">
            {{Form::label('url', 'URL do link')}}
            {{Form::text('url', '', ['class' => 'form-control', 'placeholder' => 'Url do link'])}}
        </div>
        <div class="form-group">
            {{Form::label('description', 'Descrição')}}
            {{Form::textarea('description', '', ['class' => 'form-control', 'placeholder' => 'Descrição do link'])}}
        </div>

        {{Form::submit('Salvar', ['class'=>'btn btn-primary'])}}
    {!! Form::close() !!}
@endsection