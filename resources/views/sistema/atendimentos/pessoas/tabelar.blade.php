<div class="card-body table-responsive p-0">
  <table class="table table-sm table-striped no-padding table-valign-middle projects" id="tabela-pessoas">
    <thead class="table-dark">
      <tr>
        <th class="text-nowrap">#</th>
        <th class="text-nowrap">Foto</th>
        <th class="text-nowrap">Nome</th>
        <th class="text-nowrap text-center">CPF/CNPJ</th>
        <th class="text-nowrap">Data de Nascimento</th>
        <th class="text-nowrap">e-Mail</th>
        @if(optional(\Auth::User()->klwqejqlkwndwiqo)->nome == 'Instituto Embelleze Caratinga')
          <th class="text-nowrap"># RSschool</th>
        @endif
        <th class="text-nowrap text-center"></th>
        <th class="text-nowrap text-center"><i class="fas fa-ellipsis-h"></i></th>
      </tr>
    </thead>
    <tbody>
      @forelse($pessoas as $pessoa)
        @if( isset($pessoa->deleted_at) )
          <tr class="table-danger">
        @else
          <tr>
        @endif
          <td class="text-nowrap">{!! ($pessoa->link_id) !!}</td>
          <td class="text-nowrap">
            <li class="list-inline-item">
              <img src="{{ $pessoa->foto_perfil }}" alt="{{ $pessoa->nome }}" class="table-avatar" onerror="this.src='http://127.0.0.1:8000/img/atendimentos/pessoas/0.png'" style="width: 30px">
            </li>
          </td>
          <td class="text-nowrap">{{ $pessoa->nome }}</td>
          <td class="text-nowrap text-center">{{ $pessoa->cpf }}</td>
          <td class="text-nowrap">
            @if(isset($pessoa->dt_nascimento))
            {{ \Carbon\Carbon::parse($pessoa->dt_nascimento)->format('d/m/Y') }} ({{ \Carbon\Carbon::parse($pessoa->dt_nascimento)->age }} anos)
            @endif
          </td>
          <td class="text-nowrap">{{ $pessoa->email }}</td>

          @if(optional(\Auth::User()->klwqejqlkwndwiqo)->nome == 'Instituto Embelleze Caratinga')
            <td class="text-nowrap text-left">
              <a onclick="pessoas_idrsschool('{{ $pessoa->id }}', '{{ $pessoa->id_rsschool }}')" class="text-muted" data-bs-tooltip="tooltip" data-bs-title="# RS School" data-original-title="RS School" style="cursor: pointer;"><i class="fa-solid fa-shield"></i></a>
                &nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;
                {{ $pessoa->id_rsschool ?? '' }}
            </td>
          @endif

          <td class="text-nowrap text-center">
            <div class="btn-group">
              @if($pessoa->instagram != null)
                <a href="{{ url('//www.instagram.com/'.$pessoa->instagram) }}" class="btn btn-default btn-xs" data-bs-tooltip="tooltip" data-bs-title="Instagram" data-original-title="Instagram" target="_blank"><i class="fab fa-instagram"></i></a>
              @endif
              
              @if($pessoa->facebook != null)
                <a href="{{ url('//www.facebook.com/'.$pessoa->facebook) }}" class="btn btn-default btn-xs" data-bs-tooltip="tooltip" data-bs-title="Facebook" data-original-title="Facebook" target="_blank"><i class="fab fa-facebook-square"></i></a>
              @endif

              @if($pessoa->ginthgfwxbdhwtu->where('whatsapp', 1)->first() != null)
              <a href='{{ url("//api.whatsapp.com/send?phone=55".$pessoa->whatsapp  ) }}' class="btn btn-default btn-xs" data-bs-tooltip="tooltip" data-bs-title="WhatsApp" data-original-title="WhatsApp" target="_blank"><i class="fab fa-whatsapp"></i></a>
              @endif

            </div>
          </td>

          <td class="text-nowrap text-center">
            @if($pessoa->id != 1)

              @can('Pessoas.Detalhes')
                <a href="{{ route('atd.pessoas.mostrar', $pessoa) }}" class="text-muted" data-bs-tooltip="tooltip" data-bs-title="Visualizar" data-original-title="Visualizar"><i class="fa-solid fa-eye"></i></a>&nbsp;&nbsp;
              @endcan

              @can('Pessoas.Editar')
                <a href="{{ route('atd.pessoas.editar', $pessoa) }}" class="text-muted" data-bs-tooltip="tooltip" data-bs-title="Editar" data-original-title="Editar"><i class="fa-solid fa-pencil"></i></a>&nbsp;&nbsp;
              @endcan
              
              @can('Pessoas.Excluir')
                @if($pessoa->deleted_at == null)
                  <a onClick="pessoas_excluir({{$pessoa->id}})" class="text-muted" data-bs-tooltip="tooltip" data-bs-title="Excluir" data-original-title="Excluir"><i class="fa-solid fa-trash"></i></a>
                @else
                  <a onClick="pessoas_restaurar({{$pessoa->id}})" class="text-muted" data-bs-tooltip="tooltip" data-bs-title="Reativar" data-original-title="Reativar"><i class="fa-solid fa-recycle"></i></a>
                @endif
              @endcan
            @endif
          </td>

        </tr>
      @empty
      <tr>
        <td class="text-center" colspan="8">Não há resultados para essa tabela.</td>
      </tr>
      @endforelse
    </tbody>
  </table>
</div>
<div class="card-footer clearfix">
  <div class="pagination pagination-sm float-right">
    @if(isset($dataForm))
    {{ $pessoas->appends($dataForm)->links() }}
    @else
    {{ $pessoas->links() }}
    @endif
  </div>
</div>

<script>
  var tooltipTriggerList = document.querySelectorAll('[data-bs-tooltip="tooltip"]');
  var tooltipList = [...tooltipTriggerList].map(tooltipTriggerEl => new bootstrap.Tooltip(tooltipTriggerEl));
</script>
