@extends('layouts.app')

@section('content')
	<h1 align="center">OGs Abertas</h1>
	
	
	<!-- <form action="/search" method="GET"> -->
		<!-- <input type="text" name="category" required/> -->
		<!-- <button type="submit">Submit</button> -->
	<!-- </form> -->
	
	<table class="table table-hover table-bordered">
		<thead>
			<tr style="background-color:lightgreen;" align="center">
				<th scope="col" style="vertical-align:middle">Protocolo</th>
				<th scope="col" style="vertical-align:middle">Fila</th>
				<th scope="col" style="vertical-align:middle">Status</th>
				<th scope="col" style="vertical-align:middle">Data de abertura</th>
				<th scope="col" style="vertical-align:middle">Serviço</th>			  
				<th scope="col" style="vertical-align:middle">Regional</th>
				<th scope="col" style="vertical-align:middle">Localidade</th>
				<th scope="col" style="vertical-align:middle">Interrompeu?</th>
				<th scope="col" style="vertical-align:middle">Quantidade de clientes</th>
			</tr>
		</thead>
	@foreach ($ogs as $og)
		<tbody>
	        <tr data-toggle="collapse" data-target="#demo{{$og['protocolo']}}" class="accordion-toggle" style="background-color:lightyellow; text-align:center">
			  <th scope="row">{{ $og['protocolo'] }}</th>
			  <td>{{ $og['fila'] }}</td>
			  <td>{{ $og['status'] }}</td>
			  <td>{{ $og['data_abertura'] }}</td>
			  <td>{{ $og['servico'] }}</td>
			  <td>{{ $og['regional'] }}</td>
			  <td>{{ $og['localidade'] }}</td>
			  <td>{{ $og['interrompeu'] }}</td>
			  <td>{{ $og['qtd_clientes'] }}</td>		
			</tr> 
			<tr>
				<td colspan="9" style="background-color:lightblue; color: #000000;">
					<div  id="demo{{$og['protocolo']}}" class="accordian-collapse collapse mx-4">	
						<ul>
							<li>
								<strong>Descrição:</strong>
								{{$og['descricao']}}			
							</li>
							<li>
								{!! nl2br(e($og['obs'])) !!}
							</li>
						</ul>
					</div> 
				</td>
			</tr>
		</tbody>
	@endforeach
	</table>
@endsection
