<div class="custom-control custom-switch custom-switch-off-danger custom-switch-on-success">
  <input type="checkbox" class="custom-control-input" id="{{ $nome_permissao ?? 'nome_permissao' }}" 
  @if($funcao_permissoes->contains('nome', $nome_permissao))
    checked="checked" 
  @endif
   onchange="atualizar(this)">
  <label class="custom-control-label" for="{{ $nome_permissao ?? 'nome_permissao' }}">&nbsp;{{ $local ?? 'local' }}<span class="small"> ({{ $nome_permissao ?? 'nome_permissao' }})</span></label>
</div>