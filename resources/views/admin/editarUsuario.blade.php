@if($user)
<form role="form" method="POST" action="{{route('usuarios.update',$user->id)}}">
    @csrf
    @method('PUT')
    <div class="modal-header">
        <button type="button" class="close" data-dismiss="modal" aria-label="Close">
            <span aria-hidden="true">×</span></button>
        <h4 class="modal-title">Editar Usuário</h4>
    </div>
    <div class="modal-body">
        <div class="box-body">
            <div class="row">
                <div class="col-md-12">
                    <div class="form-group">
                        <label>Nome</label>
                        <input name="name" type="text" class="form-control" placeholder="Nome Completo" value="{{$user->name}}" autocomplete="off">
                    </div>
                    <div class="form-group">
                        <label>Usuário</label>
                        <input name="username" type="text" class="form-control" placeholder="Usuário" value="{{$user->username}}" autocomplete="off">
                    </div>
                    <div class="form-group">
                        <label>Email</label>
                        <input name="email" type="text" class="form-control" placeholder="Email Corporativo" value="{{$user->email}}" autocomplete="off">
                    </div>
                    <div class="form-group">
                        <label>Perfil</label>
                        <select class="form-control" name="role">
                            @foreach ($roles as $role)
                            @foreach ($user->roles as $value)
                            <option value="{{$role->id}}" {{$value->label==$role->label?'selected':''}}>{{$role->label}}</option>
                            @endforeach
                            @endforeach
                        </select>
                    </div>
                </div>
            </div> 
        </div>
    </div>
    <div class="modal-footer">
        <button type="button" onclick="event.preventDefault(); document.getElementById('delete-user').submit();" class="btn btn-danger pull-left"><i class="fa fa-trash"></i> Apagar Usuário</button>
        <button type="submit" class="btn btn-primary"><i class="fa fa-save"></i> Salvar</button>
        <button type="button" class="btn btn-danger" data-dismiss="modal"><i class="fa fa-times"></i> Fechar</button>
    </div>
</form>
<form id="delete-user" action="{{ route('usuarios.destroy', $user->id) }}" method="POST" style="display: none;">
    @method('DELETE')
    @csrf
</form>
<script>
    $(function () {
        $('select').select2({
            width: '100%',
            language: "pt-BR"
        });
    });
</script>
@endif