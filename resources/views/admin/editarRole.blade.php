@if($roles)

<form role="form" method="POST" action="{{route('roles.update',$roles->id)}}">
    @csrf
    @method('PUT')
    <div class="modal-header">
        <button type="button" class="close" data-dismiss="modal" aria-label="Close">
            <span aria-hidden="true">×</span></button>
        <h4 class="modal-title">Editar Perfil</h4>
    </div>
    <div class="modal-body">
        <div class="box-body">
            <div class="form-group">
                <label>Nome</label>
                <input name="name" type="text" class="form-control" placeholder="Nome" value="{{$roles->name}}" autocomplete="off">
            </div>
            <div class="form-group">
                <label>Descrição</label>
                <input name="label" type="text" class="form-control" placeholder="Descrição" value="{{$roles->label}}" autocomplete="off">
            </div>
            <div class="form-group">
                <label>Permissões</label>
                <select {{$roles->name=='adm'?'disabled':''}} name="permission[]" class="form-control select2" multiple="multiple"  style="width: 100%;">
                    @foreach ($permissions as $permission) 
                    @if(in_array($permission->name,$permissao))
                    <option title="{{$permission->label}}" value="{{$permission->id}}" selected>{{$permission->name}}</option>
                    @else
                    <option title="{{$permission->label}}" value="{{$permission->id}}">{{$permission->name}}</option>
                    @endif
                    @endforeach
                </select>
            </div>
        </div>
    </div>
    <div class="modal-footer">
        <button type="button" onclick="event.preventDefault(); document.getElementById('delete-role').submit();" class="btn btn-danger pull-left" {{$roles->name=='adm'?'disabled':''}} ><i class="fa fa-trash"></i> Apagar Nível</button>
        <button type="submit" class="btn btn-primary" {{$roles->name=='adm'?'disabled':''}}><i class="fa fa-save"></i> Salvar</button>
        <button type="button" class="btn btn-danger" data-dismiss="modal"><i class="fa fa-times"></i> Fechar</button>
    </div>
</form>
<form id="delete-role" action="{{ route('roles.destroy', $roles->id) }}" method="POST" style="display: none;">
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