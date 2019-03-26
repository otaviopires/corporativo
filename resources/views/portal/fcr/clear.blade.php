@extends('adminlte::page')

@section('title', 'Portal Corporativo')

@section('content_header')

<h1>Clear Channel</h1>
<ol class="breadcrumb">
    <li><a href="{{route('home')}}"><i class="fa fa-home"></i> Home</a></li>
    <li class="active">FCR</li>
    <li class="active">Clear Channel</li>
</ol>
@stop

@section('content')

<h4><strong><a data-toggle="collapse" href="#collapse1" aria-expanded="true" aria-controls="collapse1" role="button">Cisco</strong>&nbsp;<i class="fa fa-chevron-circle-down"></i></a></h4>
<div class="collapse" id="collapse1">
    <code>
        show vlan id [nº da vlan] <br/>
        show mac address-table dynamic vlan nº da Vlan> <br/>
        show interface [nome da interface] [numero da interface] <br/>
        show version <br/>
        show log <br/>
        show clock <br/> <br/>
    </code>
    <strong>Configurar IP</strong> &nbsp; <i class="fa fa-caret-down"></i> <br/>
    <code>
        configure terminal <br/>
        interface vlan [nº da vlan] <br/>
        ip address [ip] [mascara] <br/>
        do ping [ip criado na outra ponta] repeat [quantidade de pacotes] <br/>
        no interface vlan [nº da vlan] <br/>
    </code>        
    <br/>
</div>

<h4><strong> <a data-toggle="collapse" href="#collapse2" aria-expanded="true" aria-controls="collapse2" role="button">Extreme</strong>&nbsp;<i class="fa fa-chevron-circle-down"></i> </a> </h4>
<div class="collapse" id="collapse2">
    <code>
        show vlan v [nº da vlan] <br/>
        show fdb vlan v[nº da Vlan] <br/>
        show fdb vlan "V142-0000090465" <br/>
        show ports [numero da interface] <br/>
        show ports [numero da interface] rxerrors <br/>
        show ports [numero da interface] txerrors <br/>
        show ports [numero da interface] congestion <br/>
        show switch detail <br/>
        show log <br/> <br/>
    </code>
    <strong>Configurar IP</strong> &nbsp; <i class="fa fa-caret-down"></i> <br/>
    <code>
        configure vlan v[nº da vlan] ipaddress [ip] [mascara] <br/>
        ping count [quantidade de pacotes] [ip criado na outra ponta] <br/>
        delete vlan v[nº da vlan] ipaddress [ip] [mascara] <br/>
    </code>        
    <br/>
</div>

<h4><strong> <a data-toggle="collapse" href="#collapse3" aria-expanded="true" aria-controls="collapse3" role="button">Datacom</strong>&nbsp;<i class="fa fa-chevron-circle-down"></i> </a> </h4>
<div class="collapse" id="collapse3">
    <code>
        show vlan id [nº da vlan] <br/>
        show mac-address-table vlan [nº da Vlan] <br/>
        show interfaces status [nome da interface] [numero da interface] <br/>
        show interfaces table utilization bandwidth <br/>
        show uptime <br/>
        show log ram <br/>
        show clock <br/> <br/>
    </code>
    <strong>Configurar IP</strong> &nbsp; <i class="fa fa-caret-down"></i> <br/>
    <code>
        configure <br/>
        interface vlan [nº da vlan] <br/>
        ip address [ip]/[Mascara bit] <br/>
        ping [ip criado na outra ponta] count [quantidade de pacotes] <br/>
        configure <br/>
        interface vlan [nº da vlan] <br/>
        no ip address [ip]/[Mascara bit] <br/>
    </code>        
    <br/>        
</div>

<h4><strong> <a data-toggle="collapse" href="#collapse4" aria-expanded="true" aria-controls="collapse4" role="button">Juniper</strong>&nbsp;<i class="fa fa-chevron-circle-down"></i> </a> </h4>
<div class="collapse" id="collapse4">
    <code>
        show ethernet-switching table vlan 516 <br/>
        show ethernet-switching layer2-protocol-tunneling vlan V206-0000211803<br/>
        show vlans V206-0000211803 <br/>
    </code>
    <br/><br/>
</div>

@stop