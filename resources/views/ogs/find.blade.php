@extends('adminlte::page')

@section('content_header')
	<h1>OGs encontradas ({{$total}}):</h1>
	<ol class="breadcrumb">
			<li><a href="{{route('home')}}"><i class="fa fa-home"></i> Home</a></li>
			<li class="active">OG's</li>
			<li class="active">Resultado da pesquisa</li>
	</ol>
@stop


@section('content')

	<form action="/ogs/find" method="POST" role="search">
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
				<th scope="col" style="vertical-align:middle"><center>Protocolo</center></th>
				<th scope="col" style="vertical-align:middle"><center>Ocorrência</center></th>
				<th scope="col" style="vertical-align:middle"><center>Status</center></th>
				<th scope="col" style="vertical-align:middle"><center>Data de abertura</center></th>
				<th scope="col" style="vertical-align:middle"><center>Serviço</center></th>			  
				<th scope="col" style="vertical-align:middle"><center>Localidade</center></th>
				<th scope="col" style="vertical-align:middle"><center>Regional</center></th>
				<!--<th scope="col" style="vertical-align:middle">Interrompeu?</th>
				<th scope="col" style="vertical-align:middle">Quantidade de clientes</th> -->
			</tr>
		</thead>
	@foreach ($ogs as $og)
		<tbody>
	        <tr data-toggle="collapse" data-target="#demo{{$og['protocolo']}}" class="accordion-toggle" style="background-color:lightyellow; text-align:center">
			  <th scope="row">{{ $og['protocolo'] }}</th>
			  <td>{{ $og['descricao'] }}</td>
			  <td>{{ $og['status'] }}</td>
			  <td>{{ $og['data_abertura'] }}</td>
			  <td>{{ $og['servico'] }}</td>
			  <td>{{ $og['localidade'] }}</td>
			  <td>{{ $og['regional'] }}</td>
			  <!--<td>{{ $og['interrompeu'] }}</td>
			  <td>{{ $og['qtd_clientes'] }}</td> -->		
			</tr> 
			<tr>
				<td colspan="9" style="background-color:lightblue; color: #000000;">
					<div  id="demo{{$og['protocolo']}}" class="accordian-collapse collapse mx-4">	
											<table class="table border-0" style="background-color:rgba(0, 0, 0, 0);">
							<tr>
								<td class="border-0" width="20%"><strong>Técnico:</strong></td>
								<td class="border-0 pull-left" width="30%" style="text-align:right;">{{$og['tecnico']}} <br></td>
							</tr>
							<tr>
								<td class="border-0" width="20%"><strong>Vencimento Anatel:</strong></td>
								<td class="border-0 pull-left" width="30%" style="text-align:right;">{{$og['vencimento_anatel']}} <br></td>
							</tr>
							<tr>
								<td class="border-0" width="20%"><strong>Data de abertura:</strong></td>
								<td class="border-0 pull-left" width="30%" style="text-align:right;">{{$og['data_abertura']}} <br></td>
							</tr>
							<tr>
								<td class="border-0" width="20%"><strong>Serviço:</strong></td>
								<td class="border-0 pull-left" width="30%" style="text-align:right;">{{$og['servico']}} <br></td>
							</tr>
						</table>
					<!--	<ul>
							<li>
								<strong>Descrição:</strong>
								{{$og['descricao']}}			
							</li>
							<li>
								{!! nl2br(e($og['obs'])) !!}
							</li>
						</ul>-->
					</div> 
				</td>
			</tr>
		</tbody>
	@endforeach
	</table>
	@if( $ogs instanceof \Illuminate\Pagination\AbstractPaginator)
		{{ $ogs->links() }}
 	@endif
	{{-- <META HTTP-EQUIV=Refresh CONTENT="100; URL=http://10.13.65.95/ogs/closed"> --}}
@endsection
