@extends('adminlte::page')

@section('title', 'Portal Corporativo - Faq')

@section('content_header')
<h1>FAQ</h1>
<ol class="breadcrumb">
    <li><a href="{{route('home')}}"><i class="fa fa-home"></i> Home</a></li>
    <li class="active">FAQ</li>
    <li><button class="btn btn-primary btn-xs" type="button" data-toggle="modal" data-target="#modalfaq"><i class="fa fa-plus fa-fw"></i> Add Pergunta</button></li>
</ol>
@stop

@section('content')
  <div class="row">
      <div class="col-lg-12">
            @include('includes.alerts')
        @forelse ($faqs as $faq)
            <div class="faq-item">
                <div class="row">
                    <div class="col-md-9">
                    <a data-toggle="collapse" href="#faq{{$faq->id}}" class="faq-question collapsed" aria-expanded="false">{{$faq->pergunta}}</a>
                    <small>Adicionado por 
                    <strong title="{{$faq->user->name}}">
                            {{$faq->user->username}}
                        </strong> 
                    <i class="fa fa-clock-o fa-fw"></i> {{$faq->created_at}}</small>
                    </div>
                    <div class="col-md-3 text-right">
                        <span class="small font-bold">Tag</span>
                        <div class="tag-list">
                            @foreach ($faq->tag as $tag)
                            <span class="tag-item">{{$tag->tag}}</span>
                            @endforeach
                        </div>
                    </div>
                </div>
                <div class="row">
                    <div class="col-lg-12">
                        <div id="faq{{$faq->id}}" class="panel-collapse collapse" aria-expanded="false" style="height: 0px;">
                            @if ($faq->resposta)
                        <div class="faq-answer" id="respondeu-{{$faq->id}}">
                                    <p>
                                        {!!$faq->resposta->resposta!!}
                                    </p>
                                </div>
                            @else
                            <div class="callout callout-info" id="info-{{$faq->id}}">
                            <p>Nenhuma resposta cadastrada! <button type="button" class="btn btn-success btn-xs" onclick="$('#responder-{{$faq->id}}').show(); $('#info-{{$faq->id}}').hide()"><i class="fa fa-pencil fa-fw"></i> Responder</button></p>
                                </div>
                            @endif
                            <div class="faq-answer" style="display: none" id="responder-{{$faq->id}}">
                                    <form action="{{route('faq.create')}}" method="get">
                                    <input type="hidden" name="faq_id" value="{{$faq->id}}">
                                            <div class="form-group">
                                            <label for="resposta">Resposta</label>
                                                <textarea class="form-control" name="resposta" id="resposta" rows="3">@if ($faq->resposta) {!!$faq->resposta->resposta!!} @endif</textarea>
                                            </div>
                                            <button type="submit" class="btn btn-primary btn-sm"><i class="fa fa-save fa-fw"></i> Salvar</button>
                                    </form>
                                </div>
                            <p class="text-right m-t-sm">
                                    @can('edit_faq')
                                        <button type="button" {{$faq->resposta ? '' : 'disabled'}} onclick="$('#responder-{{$faq->id}}').show(); $('#respondeu-{{$faq->id}}').hide()" class="btn btn-primary btn-xs"><i class="fa fa-edit fa-fw"></i> Editar</button>
                                    @endcan
                                    @can('delete_faq')
                            <button type="button" onclick="apagar({{$faq->id}})" class="btn btn-danger btn-xs"><i class="fa fa-trash fa-fw"></i> Apagar</button>
                                    @endcan
                                </p>
                        </div>
                    </div>
                </div>
            </div>
        <form id="delete-faq-{{$faq->id}}" action="{{ route('faq.destroy', $faq->id) }}" method="POST" style="display: none;">
                    @method('DELETE')
                    @csrf
            </form>
        @empty
        <div class="callout callout-info">
                <p>Nenhuma pergunta cadastrada!</p>
              </div>
        @endforelse
        <p class="text-right">{{ $faqs->links() }}</p>
    </div>
  </div>
  <div class="modal fade" id="modalfaq" tabindex="-1" role="dialog">
        <div class="modal-dialog" role="document">
          <div class="modal-content">
          <form action="" method="POST">
                @csrf
            <div class="modal-header">
              <button type="button" class="close" data-dismiss="modal" aria-label="Close"><span aria-hidden="true">&times;</span></button>
              <h4 class="modal-title">Adicionar Pergunta</h4>
            </div>
            <div class="modal-body">
                    <div class="form-group">
                      <label for="pergunta">Pergunta</label>
                    <input type="text" name="pergunta" id="pergunta" class="form-control" autocomplete="off" placeholder="Pergunta" aria-describedby="helpId" value="{{old('pergunta')}}">
                    </div>
                    <div class="form-group">
                      <label for="tag">Tag</label>
                      <select name="tag[]" id="tag" class="form-control select2" multiple="multiple"  style="width: 100%;">
                      </select>
                      <small class="text-muted">*Utilize espaço( ), virgula(,) ou ponto(.) para inserir a tag.</small>
                    </div>
            </div>
            <div class="modal-footer">
                <button type="submit" class="btn btn-primary"><i class="fa fa-send fa-fw"></i> Enviar</button>
                <button type="button" class="btn btn-danger" data-dismiss="modal"><i class="fa fa-times fa-fw"></i> Fechar</button>
            </div>
        </form>
          </div>
        </div>
      </div>
      <div class="modal fade" id="modalresposta" tabindex="-1" role="dialog">
            <div class="modal-dialog" role="document">
              <div class="modal-content">
              <form action="{{route('faq.create')}}" method="GET">
                    @csrf
                <div class="modal-header">
                  <button type="button" class="close" data-dismiss="modal" aria-label="Close"><span aria-hidden="true">&times;</span></button>
                  <h4 class="modal-title">Responder</h4>
                </div>
                <div class="modal-body">
                        <div class="form-group">
                          <label for="resposta">Resposta</label>
                          <textarea class="form-control" name="resposta" id="resposta" rows="3">{{old('resposta')}}</textarea>
                        </div>
                </div>
                <div class="modal-footer">
                    <button type="submit" class="btn btn-primary"><i class="fa fa-send fa-fw"></i> Enviar</button>
                    <button type="button" class="btn btn-danger" data-dismiss="modal"><i class="fa fa-times fa-fw"></i> Fechar</button>
                </div>
            </form>
              </div>
            </div>
          </div>
          <div class="modal fade" id="modaledit" tabindex="-1" role="dialog">
                <div class="modal-dialog" role="document">
                  <div class="modal-content">
                  <form action="" method="POST">
                        @csrf
                    <div class="modal-header">
                      <button type="button" class="close" data-dismiss="modal" aria-label="Close"><span aria-hidden="true">&times;</span></button>
                      <h4 class="modal-title">Responder</h4>
                    </div>
                    <div class="modal-body">
                            <div class="form-group">
                              <label for="resposta">Resposta</label>
                              <textarea class="form-control" name="resposta" id="resposta" rows="3">{{old('resposta')}}</textarea>
                            </div>
                    </div>
                    <div class="modal-footer">
                        <button type="submit" class="btn btn-primary"><i class="fa fa-send fa-fw"></i> Enviar</button>
                        <button type="button" class="btn btn-danger" data-dismiss="modal"><i class="fa fa-times fa-fw"></i> Fechar</button>
                    </div>
                </form>
                  </div>
                </div>
              </div>
@stop
@push('js')
<script>
$(function () {
    $('select').select2({
        language: "pt-BR",
        tags : true,
        tokenSeparators: [',', ' ', '.']
    });
});

function apagar(id){

    var r = confirm("ATENÇÃO! Deseja apagar a pergunta selecionada?");
    if (r == true) {
        document.getElementById('delete-faq-'+id).submit();
    } else {
        return false;
    }
}
</script>
@endpush