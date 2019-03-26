@extends('adminlte::page')

@section('title', 'Portal Corporativo')

@section('content_header')

<h1>VPN</h1>
<ol class="breadcrumb">
    <li><a href="{{route('home')}}"><i class="fa fa-home"></i> Home</a></li>
    <li class="active">FCR</li>
    <li class="active">VPN</li>
</ol>
@stop

@section('content')

<h4><strong><a data-toggle="collapse" href="#collapse1" aria-expanded="true" aria-controls="collapse1" role="button">CPE</strong>&nbsp;<i class="fa fa-chevron-circle-down"></i></a></h4>
<div class="collapse" id="collapse1">
    <ul>
        <li>Logar no roteador de gerência</li>
        
        <ul>
            <li> <code>10.99.255.253</code> </li>
            <li> <code>10.99.255.254</code></li>
        </ul>
        
        <li>Ping na loopback</li>
        <li>Telnet na loopback</li>
        <li><code>display/show arp</code> 
        <li><code>display/show ip interface brief</code> 
        <li><code>display/show ip route</code> &nbsp; <i class="fa fa-caret-right"></i> para ver rotas</li>
    </ul>
</div>

<h4><strong> <a data-toggle="collapse" href="#collapse2" aria-expanded="true" aria-controls="collapse2" role="button">PE</strong>&nbsp;<i class="fa fa-chevron-circle-down"></i> </a> </h4>
<div class="collapse" id="collapse2">
    <code>
            ping vrf VPN-340 10.163.70.121 <br/>
            telnet vrf VPN-340 10.163.70.121 <br/>
            ping routing-instance VPN-636 10.42.10.17 source 10.42.10.18 <br/>
            ping routing-instance VPN-636 10.42.10.18 interface ge-0/2/1.754 rapid count 100 <br/>
    </code>
</div>

<h4><strong> <a data-toggle="collapse" href="#collapse3" aria-expanded="true" aria-controls="collapse3" role="button">Switch</strong>&nbsp;<i class="fa fa-chevron-circle-down"></i> </a> </h4>
<div class="collapse" id="collapse3">
    <code>
        show fdb vlan "V1455-0000163455" 
    </code>
    <br/>
</div>

@stop