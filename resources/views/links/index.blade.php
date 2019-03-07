@extends('adminlte::page')

@section('content')

	<h1 class="py-2">Links úteis</h1>

	<form action="/links/find" method="POST" role="search">
		{{ csrf_field() }}
		<div class="input-group">
			<input type="text" class="form-control" name="q"
				placeholder="Pequise..."> <span class="input-group-btn">
				<button type="submit" class="btn btn-default">
					<span class="glyphicon glyphicon-search"></span>
				</button>
			</span>
		</div>
	</form>

	<div class="collapse">
		<ul class='list-group'>
			@foreach($links as $link)
				<li class='list-group-item' id="dropdown">
					<a href="#" class="dropdown-toggle" data-toggle="dropdown" aria-expanded="false">{{$link->name}}</a>
					<ul class="children active dropdown-menu">
							<li>{{$link->url}}</li>
							<li>{{$link->description}}</li>
					</ul>
				</li>
			@endforeach
		</ul>
	</div>

	@foreach($links as $link)
		<div class="card">
			<div class="card-header">
				<a data-toggle="collapse" href="#{{$link->id}}">
					<div class="col-md-11 col-sm-11">
						{{$link->name}}
					</div>
				</a>
			
				<a href="{{$link->url}}" target="_blank">
					<div class="col-md-1 col-sm-1">
						<i class="fa fa-external-link pull-right"></i>
					</div>
				</a>
			</div>
			
			<div id="{{$link->id}}" class="card-collapse collapse">
				<div class="card-body">
					{{$link->description}}
				</div>
			</div>
		</div>
	@endforeach
@endsection
