<div class="custom-control custom-switch custom-switch-off-danger custom-switch-on-success">
  <input type="checkbox" class="custom-control-input" id="{{ $funcao_id ?? 'funcao_id' }}" 
  @if($pessoa_funcoes->contains('id_funcao', $funcao_id))
    checked="checked" 
  @endif
   onchange="pessoas_funcoes_verificar(this)">
  <label class="custom-control-label" for="{{ $funcao_id ?? 'funcao_id' }}"><span class="small">{{ $funcao_id ?? 'funcao_id' }} - </span>&nbsp;{{ $funcao_nome ?? 'funcao_nome' }}<span class="small"> ({{ $funcao_descricao ?? 'funcao_descricao' }})</span></label>
</div>