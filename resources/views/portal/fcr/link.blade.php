@extends('adminlte::page')

@section('title', 'Portal Corporativo')

@section('content_header')

<h1>Internet Link</h1>
<ol class="breadcrumb">
    <li><a href="{{route('home')}}"><i class="fa fa-home"></i> Home</a></li>
    <li class="active">FCR</li>
    <li class="active">Internet Link</li>
</ol>
@stop

@section('content')

<h4><strong><a data-toggle="collapse" href="#collapse1" aria-expanded="true" aria-controls="collapse1" role="button">Nomenclaturas</strong>&nbsp;<i class="fa fa-chevron-circle-down"></i></a></h4>
<div class="collapse" id="collapse1">
    <span> <code> enable </code> </span> &nbsp; <i class="fa fa-caret-right"></i> Cisco, AudioCodes <br>
    <code> super </code> &nbsp; <i class="fa fa-caret-right"></i> HP <br>
    <code> show </code> &nbsp; <i class="fa fa-caret-right"></i> Cisco <br>
    <code> show data </code> &nbsp; <i class="fa fa-caret-right"></i>  AudioCodes<br>
    <code> display </code> &nbsp; <i class="fa fa-caret-right"></i> HP <br>
</div>

<h4><strong> <a data-toggle="collapse" href="#collapse2" aria-expanded="true" aria-controls="collapse2" role="button">AudioCodes</strong>&nbsp;<i class="fa fa-chevron-circle-down"></i> </a> </h4>
<div class="collapse" id="collapse2">
    <code>
        show data<br>
        show data ip interface brief<br>
        show data arp<br>
        show data interface fastethernet 0/0<br>
        show running-config data interface fastethernet 0/0<br>
        show running-config data<span> <i class="fa fa-caret-right"></i> (verificar nome da vrf)</span><br>
        show running-config data interface fastethernet 0/0.206<br>
        ping 200.160.2.3 source data vrf DADOS source-address interface vlan 10<br>
        show system version<span> <i class="fa fa-caret-right"></i> (6.80A.286)</span><br>
        show system uptime<br>
        show system log<br>
        show running-config system<br>
        show system date<br>
        show system time<br>
        show sytem cpu<br>
        show system utilization<br>
        show ip data route vrf DADOS
    </code>
    <br/>
</div>

<h4><strong> <a data-toggle="collapse" href="#collapse3" aria-expanded="true" aria-controls="collapse3" role="button">HP</strong>&nbsp;<i class="fa fa-chevron-circle-down"></i> </a> </h4>
<div class="collapse" id="collapse3">
    <code>
        display ip interface brief     
        display arp<br>
        display interface Ethernet 0/0<br>
        display current-configuration | include vpn-instance<br>
        display current-configuration interface Ethernet 0/0.1037<br>
        ping -vpn-instance vrf-1037 -a 187.15.16.14 200.160.2.3<br>
        ping -a 187.15.16.14 200.160.2.3<br>
        traceroute source 189.112.119.142 151.101.66.167 no-resolve wait 1<br>
        display version<br>
        display logbuffer<br>
        display current-configuration<br>
        display clock<br>
        display ip routing-table vpn-instance vrf-1037<br>
        display cpu-usage history<br>
        display ip routing-table<br>
        display ip routing-table vpn-instance vrf-1037 verbose
    </code>
    <br/><br/>

    <strong>Mudar o tempo de atualização do consumo na interface</strong> &nbsp; <i class="fa fa-caret-down"></i> <br/>
    <code>
    configure terminal <br>
    interface x<br>
    load-interval 30<br>
    load-interval 5
    </code>
    <br/>
</div>

<h4><strong> <a data-toggle="collapse" href="#collapse4" aria-expanded="true" aria-controls="collapse4" role="button">Cisco</strong>&nbsp;<i class="fa fa-chevron-circle-down"></i> </a> </h4>
<div class="collapse" id="collapse4">
    <code>
        show ip interface brief <br>
        show interface deion<br>
        show arp<br>
        show interfaces fastEthernet 0/0<br>
        show running-config interface fastEthernet 0/0<br>
        ping 200.160.2.3 source 187.72.4.30<br>
        show version<br>
        show log<br>
        show running-config<br>
        show clock<br>
        show processes cpu history<br>
        show ip route
    </code>
    <br/>
</div>

<h4><strong> <a data-toggle="collapse" href="#collapse5" aria-expanded="true" aria-controls="collapse5" role="button">PE</strong>&nbsp;<i class="fa fa-chevron-circle-down"></i> </a> </h4>
<div class="collapse" id="collapse5">
    <code>
    show interfaces description | include [circuito]  <br>
    show interfaces deion | include [circuito]/[vlan] <br>
    show interface details | match [vlan] <br>
    show interfaces et-0/0/4 deions <br>
    show configuration | display set | match 1478 <br>
    show route table inet 192.185.216.141 <br>
    ping 201.48.224.37 rapid count 2000 <br>
    show route receive-protocol bgp 170.84.32.253 <br>
    show bgp summary | match 200.146.208.85
    </code>
    <br>
</div>

@stop