<div class="custom-control custom-switch custom-switch-off-danger custom-switch-on-success">
  <input type="checkbox" class="custom-control-input" id="{{ $tipo_id ?? 'tipo_id' }}" 
  @if($pessoa_tipos->contains('id_tipo', $tipo_id))
    checked="checked" 
  @endif
   onchange="pessoas_tipos_verificar(this)">
  <label class="custom-control-label" for="{{ $tipo_id ?? 'tipo_id' }}"><span class="small">{{ $tipo_id ?? 'tipo_id' }} - </span>&nbsp;{{ $tipo_nome ?? 'tipo_nome' }}<span class="small"> ({{ $tipo_descricao ?? 'tipo_descricao' }})</span></label>
</div>