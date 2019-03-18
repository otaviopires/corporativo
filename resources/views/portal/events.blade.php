@extends('adminlte::page')

@section('title', 'Portal Corporativo - Plantão')

@section('content_header')			
	<h1>Escalas de Plantões</h1>
	<ol class="breadcrumb">
		<li><a href="{{route('home')}}"><i class="fa fa-home"></i> Home</a></li>
		<li class="active">Escalas de Plantõess</li>
	</ol>

	<br>

	<div class="painel-heading">
		<h4>Cadastrar Plantonista:</h4>
	</div>

	<div class="painel-body">
		{!! Form::open(array('route' => 'events.add','method'=>'POST','files'=>'true')) !!}
			<div class="row">
				<div class="col-xs-12 col-sm-12 col-md-12">
					@if (Session::has('success'))
						<div class="alert alert-success">{{Session::get('success') }}</div>
					@elseif (Session::has('warnning'))
						<div class="alert alert-danger">{{Session::get('warnning') }}</div>
					@endif
				</div>

				<div class="col-xs-4 col-sm-4 col-md-4">
					<div class="form-group">
						{!! Form::label('envet_name','Plantonista:') !!}
						<div class=''>
						{!! Form::text('event_name', null, ['class' => 'form-control']) !!}
						{!! $errors->first('event_name', '<p class="alert alert-danger">:message</p>') !!}
						</div>
					</div>
				</div>	

				<div class="col-xs-3 col-sm-3 col-md-3">
					<div class="form-group">
						{!! Form::label('start_date','Inicio:') !!}
						<div class=''>
						{!! Form::date('start_date', null, ['class' => 'form-control']) !!}
						{!! $errors->first('start_date', '<p class="alert alert-danger">:message</p>') !!}
						</div>
					</div>
				</div>	

				<div class="col-xs-3 col-sm-3 col-md-3">
					<div class="form-group">
						{!! Form::label('end_date','Fim:') !!}
						<div class=''>
						{!! Form::date('end_date', null, ['class' => 'form-control']) !!}
						{!! $errors->first('end_date', '<p class="alert alert-danger">:message</p>') !!}
						</div>
					</div>
				</div>	

				<div class="col-xs-1 col-sm-1 col-md-1 text-center"> {{-- &nbsp;<br/> --}}
				{!! Form::submit('Cadastrar Plantonista',['class'=>'btn btn-primary']) !!}
				</div>
			</div>
		{!! Form::close() !!}
	</div>
@stop

@section('content')
	<div class="panel panel-primary">
		<div class="panel-heading">Calendário</div>
		<div class="panel-body" >
			{!! $calendar_details->calendar() !!}
		</div>
	</div>
@stop

@section('adminlte_js')
	<script src="https://cdnjs.cloudflare.com/ajax/libs/moment.js/2.9.0/moment.min.js"></script>
	<script src="https://cdnjs.cloudflare.com/ajax/libs/fullcalendar/2.2.7/fullcalendar.min.js"></script>	
	{!! $calendar_details->script() !!}
@stop






	
