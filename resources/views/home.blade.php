

@extends('adminlte::page')

@section('title', 'Portal Corporativo')

@section('content_header')
    <h1>Bem vindo ao Portal CRE</h1>
    <ol class="breadcrumb">
        <li><a href="{{route('home')}}"><i class="fa fa-home"></i> Home</a></li>
    </ol>
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
      google.charts.setOnLoadCallback(drawChartOgsTop10PerRegion);
      google.charts.setOnLoadCallback(drawChartPfsTop10PerRegion);


      function drawChartOgsAbertas() 
      {
        var data = google.visualization.arrayToDataTable([
            ['Regional', 'Quantidade', {role: 'link'}],
            @foreach($open as $regional => $qtd)
                ['{{$regional}}', {{$qtd}}, '/ogs/find/open?q={{$regional}}'],
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

        google.visualization.events.addListener(chart, 'select', function() {
          var row = chart.getSelection()[0].row;
          window.open(data.getValue(row, 2));
        });        
      }

      function drawChartOgsFechadas() 
      {
        var data = google.visualization.arrayToDataTable([
            ['Regional', 'Quantidade', {role: 'link'}],
            @foreach($closed as $regional => $qtd)
                ['{{$regional}}', {{$qtd}}, '/ogs/find?q={{$regional}}'],
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

        google.visualization.events.addListener(chart, 'select', function() {
          var row = chart.getSelection()[0].row;
          window.open(data.getValue(row, 2));
        });
      }

      function drawChartPfsAbertas() 
      {
        var data = google.visualization.arrayToDataTable([
            ['Regional', 'Quantidade', {role: 'link'}],
            @foreach($openPfs as $regional => $qtd)
                ['{{$regional}}', {{$qtd}}, '/pfs/list/find/open?q={{$regional}}'],
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

        google.visualization.events.addListener(chart, 'select', function() {
          var row = chart.getSelection()[0].row;
          window.open(data.getValue(row, 2));
        });
      }
      
      function drawChartPfsFechadas() 
      {
        var data = google.visualization.arrayToDataTable([
            ['Regional', 'Quantidade', {role: 'link'}],
            @foreach($closedPfs as $regional => $qtd)
                ['{{$regional}}', {{$qtd}}, '/pfs/list/find?q={{$regional}}'],
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

        google.visualization.events.addListener(chart, 'select', function() {
          var row = chart.getSelection()[0].row;
          window.open(data.getValue(row, 2));
        });
      }

      function drawChartOgsTop10PerRegion() 
      {
        var data = google.visualization.arrayToDataTable([
            ['Regional', 'Quantidade', {role: 'link'}],
            @foreach($top10Ogs as $regional => $qtd)
                ['{{$regional}}', {{$qtd}}, '/ogs/find?q={{$regional}}'],
            @endforeach                
        ]);

        var options = { 
          width: 500,
          title: 'OGs - Top 10 - Regionais:',
          backgroundColor: { 
            fill:'transparent',
          },
          is3D:true,
          legend: { position: 'none' },
        };

        var chart = new google.visualization.ColumnChart(document.getElementById('top-10-ogs'));
        chart.draw(data, options);

        google.visualization.events.addListener(chart, 'select', function() {
          var row = chart.getSelection()[0].row;
          window.open(data.getValue(row, 2));
        });
      }

      function drawChartPfsTop10PerRegion() 
      {
        var data = google.visualization.arrayToDataTable([
            ['Regional', 'Quantidade', {role: 'link'}, { role: 'style' }],
            @foreach($top10Pfs as $regional => $qtd)
                ['{{$regional}}', {{$qtd}}, '/pfs/list/find?q={{$regional}}', '#a52b0e'],
            @endforeach                
        ]);

        var options = { 
          width: 500,
          title: 'PFs - Top 10 - Regionais:',
          backgroundColor: { 
            fill:'transparent',
          },
          is3D:true,
          legend: { position: 'none' },
        };

        var chart = new google.visualization.ColumnChart(document.getElementById('top-10-pfs'));
        chart.draw(data, options);

        google.visualization.events.addListener(chart, 'select', function() {
          var row = chart.getSelection()[0].row;
          window.open(data.getValue(row, 2));
        });
      }      

    </script>  
  
  <div class="grid"> 
    <div class="item" id="ogs-abertas"></div>
    <div class="item" id="ogs-fechadas"></div>
    <div class="item" id="pfs-abertas"></div>
    <div class="item" id="pfs-fechadas"></div>
    <div class="item" id="top-10-ogs"></div>
    <div class="item" id="top-10-pfs"></div>
  </div>
  
@stop