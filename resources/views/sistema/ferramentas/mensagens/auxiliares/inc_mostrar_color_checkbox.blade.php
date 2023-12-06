<i class="fa-xs fa-solid fa-circle"
@if($funcao_permissoes->contains('nome', $nome_permissao))
  style="color:green;"
@else
  style="color:red;"
@endif
></i>&nbsp;&nbsp;{{ $local ?? 'local' }}<span class="small"> ({{ $nome_permissao ?? 'nome_permissao' }})</span><br>
