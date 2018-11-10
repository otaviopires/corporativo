@extends('adminlte::page')

@section('title', 'Portal Corporativo - Cadastro Perfil')


@section('content_header')
<h1>Nível de acesso</h1>
<ol class="breadcrumb">
    <li><a href="{{route('home')}}"><i class="fa fa-home"></i> Home</a></li>
    <li class="active">Nível de acesso</li>
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
                <table id="table" class="table table-bordered table-striped table-hover">
                    <thead>
                        <tr>
                            <th>Nome</th>
                            <th>Descrição</th>
                            <th>Criado</th>
                        </tr>
                    </thead>
                    <tbody>
                        @forelse($roles as $role)
                        <tr id="{{$role->id}}">
                            <td>{{$role->name}}</td>
                            <td>{{$role->label}}</td>
                            <td>{{$role->created_at}}</td>
                        </tr>
                        @empty
                        @endforelse
                    </tbody>
                </table>
            </div>
        </div>
    </div>
</div>
<div class="modal fade" id="modal-new" style="display: none;">
    <div class="modal-dialog">
        <div class="modal-content">
            <form role="form" method="post" action="">
                {!! csrf_field() !!}
                <div class="modal-header">
                    <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                        <span aria-hidden="true">×</span></button>
                    <h4 class="modal-title">Cadastrar Perfil</h4>
                </div>
                <div class="modal-body">

                    <div class="box-body">
                        <div class="form-group">
                            <label>Nome</label>
                            <input name="name" type="text" class="form-control" placeholder="Nome" value="{{old('name')}}" autocomplete="off">
                        </div>
                        <div class="form-group">
                            <label>Descrição</label>
                            <input name="label" type="text" class="form-control" placeholder="Descrição" value="{{old('label')}}" autocomplete="off">
                        </div>
                        <div class="form-group">
                            <label>Permissões</label>
                            <select name="permission[]" class="form-control select2" multiple="multiple"  style="width: 100%;">
                                @foreach ($permissions as $permission)
                                <option title="{{$permission->label}}" value="{{$permission->id}}">{{$permission->name}}</option>
                                @endforeach
                            </select>
                        </div>
                    </div>

                </div>
                <div class="modal-footer">
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
<script src="{{ asset('vendor/adminlte/dist/js/roles.js') }}"></script>
@endpush