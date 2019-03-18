@extends('adminlte::page')

@section('title', 'Portal Corporativo - Forúm')

@section('content_header')

<h1>Telefones Utéis</h1>
<ol class="breadcrumb">
    <li><a href="{{route('home')}}"><i class="fa fa-home"></i> Home</a></li>
    <li class="active">Telefones Utéis</li>
</ol>
@stop

@section('content')
<table class="table table-striped">
	<tr>
		<th>Nome</th>
		<th>Telefone</th>
        <th>Email</th>
	</tr>
	@foreach ($tels as $tel)
	<tr>
		<td>{{$tel->name}}</td>
		<td>{{$tel->tel}}</td>
        <td>{{$tel->email}}</td>
	</tr>
	@endforeach
</table>

@stop