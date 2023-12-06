@forelse($mensagens as $mensagem)
  <dt class="col-sm-3">{{ $mensagem->area }}</dt>
  <dd class="col-sm-7">{!! $mensagem->mensagem !!}</dd>
  <dd class="col-sm-2">

    <!-- <div class="btn-group">
      <a href="{{ url('//www.instagram.com/'.$mensagem->instagram) }}" class="btn btn-default btn-xs" data-bs-tooltip="tooltip" data-bs-title="Instagram" data-original-title="Instagram" target="_blank"><i class="fab fa-instagram"></i></a>
      <a href="{{ url('//www.facebook.com/'.$mensagem->facebook) }}" class="btn btn-default btn-xs" data-bs-tooltip="tooltip" data-bs-title="Facebook" data-original-title="Facebook" target="_blank"><i class="fab fa-facebook-square"></i></a>
    </div> -->

  
    <!-- can('Pessoas.Detalhes') -->
    <!-- <a href="{{ route('cfg.mensagens.mostrar', $mensagem) }}" class="text-muted" data-bs-tooltip="tooltip" data-bs-title="Visualizar" data-original-title="Visualizar"><i class="fa-solid fa-eye"></i></a>&nbsp;&nbsp; -->
    <!-- endcan -->
  
    <!-- can('Pessoas.Editar') -->
    <a href="{{ route('cfg.mensagens.editar', $mensagem) }}" class="text-muted" data-bs-tooltip="tooltip" data-bs-title="Editar" data-original-title="Editar"><i class="fa-solid fa-pencil"></i></a>&nbsp;&nbsp;
    <!-- endcan -->
    
    <!-- can('Pessoas.Excluir') -->
      <!-- if($mensagem->deleted_at == null) -->
      <!-- <a onClick="mensagens_excluir({{$mensagem->id}})" class="text-muted" data-bs-tooltip="tooltip" data-bs-title="Excluir" data-original-title="Excluir"><i class="fa-solid fa-trash"></i></a> -->
      <!-- else -->
      <!-- <a onClick="mensagens_restaurar({{$mensagem->id}})" class="text-muted" data-bs-tooltip="tooltip" data-bs-title="Reativar" data-original-title="Reativar"><i class="fa-solid fa-recycle"></i></a> -->
      <!-- endif -->
    <!-- endcan -->
  

</dd>

<hr>
@empty
  
  <dt class="col-sm-3">...</dt>
  <dd class="col-sm-7">Não há mensagens cadastradas</dd>
  <dd class="col-sm-2">...</dd>
@endforelse

