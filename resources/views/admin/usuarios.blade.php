@extends('adminlte::page')

@section('title', 'Portal Corporativo - Usuários')

@section('content_header')
<h1>Usuários</h1>
<ol class="breadcrumb">
    <li><a href="{{route('home')}}"><i class="fa fa-home"></i> Home</a></li>
    <li class="active">Usuários</li>
</ol>
@stop

@section('content')
<div class="row">
    <div class="col-lg-12">
            @include('includes.alerts')
        <div class="box box-primary">
            <div class="box-header">
                <button type="button" class="btn btn-primary" data-toggle="modal" data-target="#modal-new"><i class="fa fa-plus"></i> Cadastrar</button>
            </div>
            <div class="box-body">
                <table id="table_user" class="table table-bordered table-striped table-hover">
                    <thead>
                        <tr>
                            <th>Nome</th>
                            <th>Usuário</th>
                            <th>Email</th>
                            <th>Nivel</th>
                        </tr>
                    </thead>
                    <tbody>
                        @foreach($usuarios as $user)
                        <tr id="{{$user->id}}">
                            <td>{{$user->name}}</td>
                            <td>{{$user->username}}</td>
                            <td>{{$user->email}}</td>
                            <td>
                                @foreach ($user->roles as $role)
                                {{$role->label}}
                                @endforeach
                            </td>
                        </tr>
                        @endforeach
                    </tbody>
                </table>
            </div>
        </div>
    </div>
</div>
<div class="modal fade" id="modal-new" style="display: none;">
    <div class="modal-dialog">
        <div class="modal-content">
            <form role="form" method="post" action="" enctype="multipart/form-data">
                {!! csrf_field() !!}
                <input name="password" type="hidden" class="form-control" value="mudar123">
                <div class="modal-header">
                    <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                        <span aria-hidden="true">×</span></button>
                    <h4 class="modal-title">Cadastrar Usuário</h4>
                </div>
                <div class="modal-body">

                    <div class="box-body">
                        <div class="row">
                            <div class="col-md-12">
                                <div class="form-group">
                                    <label>Nome</label>
                                    <input name="name" type="text" class="form-control" placeholder="Nome Completo" value="{{old('name')}}" autocomplete="off">
                                </div>
                                <div class="form-group">
                                    <label>Usuário</label>
                                    <input name="username" type="text" class="form-control" placeholder="Usuário" value="{{old('username')}}" autocomplete="off">
                                </div>
                                <div class="form-group">
                                    <label>Email</label>
                                    <input name="email" type="text" class="form-control" placeholder="Email Corporativo" value="{{old('email')}}" autocomplete="off">
                                </div>
                                <div class="form-group">
                                    <label>Nivel</label>
                                    <select name="role" class="form-control">
                                        <option value="" disabled="" selected="">Selecione</option>
                                        @foreach ($roles as $role)
                                        <option {{ old('role') == $role->id ? "selected" : "" }} value="{{$role->id}}">{{$role->label}}</option>
                                        @endforeach
                                    </select>
                                </div>
                            </div>
                        </div>
                    </div>
                </div>
                <div class="modal-footer">
                    <span class="pull-left">Senha padrão: <b>mudar123</b></span>
                    <button type="submit" class="btn btn-primary"><i class="fa fa-save"></i> Salvar</button>
                    <button type="button" class="btn btn-danger" data-dismiss="modal"><i class="fa fa-times"></i> Fechar</button>
                </div>
            </form>
        </div>
    </div>
</div>
<div class="modal fade" id="modal-edit" style="display: none;">
    <div class="modal-dialog">
        <div class="modal-content" id="conteudoModal">

        </div>
    </div>
</div>

@stop
@push('js')
<script src="{{ asset('vendor/adminlte/dist/js/usuarios.js') }}"></script>
@endpush