

@extends('adminlte::page')

@section('title', 'Portal Corporativo')

@section('content_header')
    <h1>Bem vindo ao Portal CRE</h1>

@stop

@section('content')
    {{-- {{ \App\Http\Controllers\OgsController::retunClosedOgsToHomeChart() }} --}}
    {{-- {{GraphsHelper::retunDataToHomeChart()}} --}}
    <script type="text/javascript" src="https://www.gstatic.com/charts/loader.js"></script>
    <script type="text/javascript">
      google.charts.load('current', {'packages':['corechart']});
      google.charts.setOnLoadCallback(drawChartOgsAbertas);
      google.charts.setOnLoadCallback(drawChartOgsFechadas);
      google.charts.setOnLoadCallback(drawChartPfsAbertas);
      google.charts.setOnLoadCallback(drawChartPfsFechadas);
      

      function drawChartOgsAbertas() {
        var data = google.visualization.arrayToDataTable([
            ['Regional', 'Quantidade'],
            @foreach($open as $regional => $qtd)
                ['{{$regional}}', {{$qtd}}],
            @endforeach                
        ]);

        var options = {
          title: 'OGs - Em Andamento - POR REGIONAL ({{array_sum($open)}})',
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
          title: 'OGs - Fechadas - POR REGIONAL ({{array_sum($closed)}})',
          backgroundColor: { 
            fill:'transparent',
          },
          is3D:true,
        };

        var chart = new google.visualization.PieChart(document.getElementById('ogs-fechadas'));
        chart.draw(data, options);
      }


      
      function drawChartPfsAbertas() {
        var data = google.visualization.arrayToDataTable([
            ['Regional', 'Quantidade'],
            @foreach($openPfs as $regional => $qtd)
                ['{{$regional}}', {{$qtd}}],
            @endforeach                
        ]);

        var options = {
          title: 'PFs - Abertas - POR REGIONAL ({{array_sum($openPfs)}})',
          backgroundColor: { 
            fill:'transparent',
          },
          is3D:true,
        };

        var chart = new google.visualization.PieChart(document.getElementById('pfs-abertas'));
        chart.draw(data, options);
      }

      
      function drawChartPfsFechadas() {
        var data = google.visualization.arrayToDataTable([
            ['Regional', 'Quantidade'],
            @foreach($closedPfs as $regional => $qtd)
                ['{{$regional}}', {{$qtd}}],
            @endforeach                
        ]);

        var options = {
          title: 'PFs - Fechadas - POR REGIONAL ({{array_sum($closedPfs)}})',
          backgroundColor: { 
            fill:'transparent',
          },
          is3D:true,
        };

        var chart = new google.visualization.PieChart(document.getElementById('pfs-fechadas'));
        chart.draw(data, options);
      }

    </script>  
  
  <div class="grid"> 
    <div class="item" id="ogs-abertas"></div>
    <div class="item" id="ogs-fechadas"></div>
    <div class="item" id="pfs-abertas"></div>
    <div class="item" id="pfs-fechadas"></div>
    
    <div class="item" id="3"></div>
  </div>
  
@stop