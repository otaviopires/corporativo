@extends('adminlte::page')


@section('content_header')
	<h1>Falhas em Andamento</h1>
	<ol class="breadcrumb">
			<li><a href="{{route('home')}}"><i class="fa fa-home"></i> Home</a></li>
			<li class="active">OG's</li>
			<li class="active">Em andamento</li>
	</ol>
@stop

@section('content')
	<form action="/ogs/find/open" method="POST" role="search">
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
	
	<table class="table table-hover table-bordered">
		<thead>
			<tr style="background-color:lightgreen;" align="center">
				<th scope="col" style="vertical-align:middle"><center>Protocolo</th>
				<th scope="col" style="vertical-align:middle"><center>Ocorrência</th>
				<th scope="col" style="vertical-align:middle"><center>Status</th>
				<th scope="col" style="vertical-align:middle"><center>Data de abertura</th>
				<th scope="col" style="vertical-align:middle"><center>Serviço</th>
				<th scope="col" style="vertical-align:middle"><center>Localidade</th>
				<th scope="col" style="vertical-align:middle"><center>Regional</th>
				<!-- <th scope="col" style="vertical-align:middle">Interrompeu?</th>-->
				<!-- <th scope="col" style="vertical-align:middle">Quantidade de clientes</th> -->
			</tr>
		</thead>
	@foreach ($ogs as $og)
		<tbody>
	          <tr class="accordion-toggler" data-toggle="collapse" data-target="#demo{{$og['PROTOCOLO']}}" style="background-color:lightyellow; text-align:center">
			  <th scope="row"><center>{{ $og['PROTOCOLO'] }}</th>
			  <td style="border-top: none"><center>{{ $og['DESC_EQPTO'] }}</td>
			  <td><center>{{ $og['STATUS'] }}</td>
			  <td><center>{{ $og['ENTRADA_FILA'] }}</td>
			  <td><center>{{ $og['SERVICO'] }}</td>
			  <td><center>{{ $og['LOCALIDADE'] }}</td>
			  <td><center>{{ $og['REGIONAL'] }}</td>
			  
			</tr> 
			<tr>
				<td colspan="7" style="background-color:lightblue; color: #000000;">
					<div  id="demo{{$og['PROTOCOLO']}}" class="accordian-collapse collapse mx-4">	
						<table class="table" style="background-color:rgba(0, 0, 0, 0);">
							<tr>
								<td class="" width="20%"style="border-top: none"><strong>Técnico:</strong></td>
								<td class="border-0 pull-left" width="30%" style="text-align:right;border-top: none">{{$og['TECNICO']}} <br></td>
							</tr>
							<tr>
								<td class="border-0" width="20%"style="border-top: none"><strong>Vencimento Anatel:</strong></td>
								<td class="border-0 pull-left" width="30%" style="text-align:right;border-top: none">{{$og['VENCIMENTO_ANATEL']}} <br></td>
							</tr>
							<tr>
								<td class="border-0" width="20%"style="border-top: none"><strong>Data de abertura:</strong></td>
								<td class="border-0 pull-left" width="30%" style="text-align:right;border-top: none">{{$og['DT_ABERTURA']}} <br></td>
							</tr>
							<tr>
								<td class="border-0" width="20%"style="border-top: none"><strong>Fila:</strong></td>
								<td class="border-0 pull-left" width="30%" style="text-align:right;border-top: none">{{$og['FILA']}} <br></td>
							</tr>
						</table>
					</div> 
				</td>
			</tr>
		</tbody>
	@endforeach
	</table>
	<META HTTP-EQUIV=Refresh CONTENT="100; URL=http://10.13.65.95/ogs">
@endsection
