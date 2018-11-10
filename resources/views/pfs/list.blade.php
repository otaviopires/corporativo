@extends('layouts.app')

@section('content')
	<h1 align="center">Histórico de PFs</h1>
	
	{!! Form::open(['method'=>'GET','url'=>'/find','role'=>'search'])  !!}
	<!-- <div class="input-group custom-search-form"> -->
		<!-- <input type="text" class="form-control" name="search" placeholder="Procurar..."> -->
        <!-- <span class="input-group-btn"> -->
			<!-- <button class="btn btn-default-sm" type="submit"> -->
				<!-- <a class="fa fa-search">Procurar</a> -->
			<!-- </button> -->
		<!-- </span> -->
	<!-- </div> -->
	
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
				<th scope="col" style="vertical-align:middle">Regional</th>
				<th scope="col" style="vertical-align:middle">Localidade</th>
			</tr>
		</thead>
	@foreach ($pfs as $i=>$pf)
		<tbody>
	        <tr class="accordion-toggler" data-toggle="collapse" data-target="#demo{{$pf['protocolo']}}" style="background-color:lightyellow; text-align:center">
			  <th scope="row">{{ $pf['protocolo'] }}</th>
			  <td>{{ $pf['fila'] }}</td>
			  <td>{{ $pf['status'] }}</td>
			  <td>{{ $pf['data_abertura'] }}</td>
			  <td>{{ $pf['regional'] }}</td>
			  <td>{{ $pf['localidade'] }}</td>	
			</tr> 
			<tr>
				<td colspan="10" style="background-color:lightblue; color: #000000;">
					<div  id="demo{{$pf['protocolo']}}" class="accordian-collapse collapse mx-4">	
						<table class="table border-0" style="background-color:rgba(0, 0, 0, 0);">
							<tr>
								<td class="border-0" width="20%"><strong>Técnico:</strong></td>
								<td class="border-0 pull-left" width="30%" style="text-align:right;">{{$pf['tecnico']}} <br></td>
							</tr>
							<tr>
								<td class="border-0" width="20%"><strong>Vencimento Anatel:</strong></td>
								<td class="border-0 pull-left" width="30%" style="text-align:right;">{{$pf['vencimento_anatel']}} <br></td>
							</tr>
							<tr>
								<td class="border-0" width="20%"><strong>Data de abertura:</strong></td>
								<td class="border-0 pull-left" width="30%" style="text-align:right;">{{$pf['dt_abertura']}} <br></td>
							</tr>
							<tr>
								<td class="border-0" width="20%"><strong>Serviço:</strong></td>
								<td class="border-0 pull-left" width="30%" style="text-align:right;">{{$pf['servico']}} <br></td>
							</tr>
						</table>
					</div> 
				</td>
			</tr>
		</tbody>
	@endforeach
	</table>
    {{$pfs->links()}}	
@endsection
