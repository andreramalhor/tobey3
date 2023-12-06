<div class="custom-control custom-switch custom-switch-off-danger custom-switch-on-success">
  <input type="checkbox" class="custom-control-input" id="{{ $id ?? 'id' }}"
  @if($funcao_permissoes->contains('nome', $nome_permissao))
    checked="checked"
  @endif
   onchange="funcoes_permissoes_verificar(this)">
  <label class="custom-control-label" for="{{ $id ?? 'id' }}">&nbsp;{{ $local ?? 'local' }}<span class="small"> ({{ $id }}) ({{ $nome_permissao ?? 'nome_permissao' }})</span></label>
</div>
