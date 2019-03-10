

@extends('adminlte::page')

@section('title', 'Portal Corporativo')

@section('content_header')
    <h1>Bem vindo ao Portal CRE</h1>

@stop

@section('content')
    {{-- {{ \App\Http\Controllers\OgsController::retunClosedOgsToHomeChart() }} --}}

    <script type="text/javascript" src="https://www.gstatic.com/charts/loader.js"></script>
    <script type="text/javascript">
      google.charts.load('current', {'packages':['corechart']});
      google.charts.setOnLoadCallback(drawChartOgsAbertas);
      google.charts.setOnLoadCallback(drawChartOgsFechadas);

      function drawChartOgsAbertas() {
        var data = google.visualization.arrayToDataTable([
            ['Regional', 'Quantidade'],
            @foreach($open as $regional => $qtd)
                ['{{$regional}}', {{$qtd}}],
            @endforeach                
        ]);

        var options = {
          title: '{{array_sum($open)}} OGs - Em Andamento - POR REGIONAL',
          backgroundColor: { 
            fill:'transparent',
          },
          is3D:true,
        };

        var chart = new google.visualization.PieChart(document.getElementById('ogs-abertas'));
        chart.draw(data, options);
      }

      function drawChartOgsFechadas() {
        var data = google.visualization.arrayToDataTable([
            ['Regional', 'Quantidade'],
            @foreach($closed as $regional => $qtd)
                ['{{$regional}}', {{$qtd}}],
            @endforeach                
        ]);

        var options = {
          title: '{{array_sum($closed)}} OGs - Fechadas - POR REGIONAL',
          backgroundColor: { 
            fill:'transparent',
          },
          is3D:true,
        };

        var chart = new google.visualization.PieChart(document.getElementById('ogs-fechadas'));
        chart.draw(data, options);
      }
    </script>  
  
  <div class="grid"> 
    <div class="item" id="ogs-abertas"></div>
    <div class="item" id="ogs-fechadas"></div>
  </div>
  
@stop