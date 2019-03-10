@extends('adminlte::page')

@section('title', 'Portal Corporativo')

@section('content_header')
    <h1>Bem vindo ao Portal CRE</h1>

@stop

@section('content')
    {{-- {{print_r($ogs)}} --}}
    {{-- @json($ogs); --}}

    {{-- @foreach ($ogs as $i=>$og)
        <span>{{$og[$i][$i]}}<span>
        <span>{{$og[$i][$i+1]}}<span>
    @endforeach --}}
    {{-- @foreach ($ogs as $og)
      ['{{ $og }}', 1],
    @endforeach --}}
    
    {{-- @foreach($ogs as $i => $og)
      {{$og["regional"]}}
      @foreach( $og as $regional)
        {{print_r($regional)}}
      @endforeach
    
    @endforeach --}}

    <script type="text/javascript" src="https://www.gstatic.com/charts/loader.js"></script>
    <script type="text/javascript">
      google.charts.load('current', {'packages':['corechart']});
      google.charts.setOnLoadCallback(drawChart);

      function drawChart() {

        var data = google.visualization.arrayToDataTable([
            ['Regional', 'Quantidade'],
            @foreach($ogs as $regional => $qtd)
                ['{{$regional}}', {{$qtd}}],
            @endforeach                
        ]);

        var options = {
          title: 'OGs em aberto - POR REGIONAL',
          backgroundColor: { 
            width:600,
            height:300,
            fill:'transparent',
            is3D:true,
          }
        };

        var chart = new google.visualization.PieChart(document.getElementById('piechart'));

        chart.draw(data, options);
      }
    </script>
  
  <div id="piechart" style="width: 900px; height: 500px;"></div>

@stop