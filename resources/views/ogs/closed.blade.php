@extends('adminlte::page')

@section('content')
	<h1 align="center">Histórico de OGs Encerradas</h1>
	
	{!! Form::open(['method'=>'GET','ogs'=>'/find','role'=>'search'])  !!}
	<div class="input-group custom-search-form">
		<input type="text" class="form-control" name="search" placeholder="Procurar...">
        <span class="input-group-btn">
			<button class="btn btn-default-sm" type="submit">
				<a class="fa fa-search">Procurar</a>
			</button>
		</span>
	</div>
	
	<!-- <form action="/search" method="GET"> -->
		<!-- <input type="text" name="category" required/> -->
		<!-- <button type="submit">Submit</button> -->
	<!-- </form> -->
	
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
    {{$ogs->links()}}	
	<META HTTP-EQUIV=Refresh CONTENT="100; URL=http://10.13.65.95/ogs/closed">
@endsection
