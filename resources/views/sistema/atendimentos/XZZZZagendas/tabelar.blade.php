<div class="card-body table-responsive p-0">
  <table class="table table-sm table-striped no-padding table-valign-middle projects" id="tabela-agendamentos">
    <thead class="table-dark">
      <tr>
        <th class="text-nowrap">#</th>
        <th class="text-nowrap text-center">Data</th>
        <th class="text-nowrap text-center">Início</th>
        <th class="text-nowrap text-center">Final</th>
        <th class="text-nowrap">Cliente</th>
        <th class="text-nowrap">Profissional</th>
        <th class="text-nowrap">Serviço</th>
        <th class="text-nowrap">Agendado Por</th>
        <th class="text-nowrap text-center">Agendado Em</th>
        <th class="text-nowrap">Obs</th>
        <th class="text-nowrap text-center">Status</th>
        <th class="text-nowrap text-center"><i class="fas fa-ellipsis-h"></i></th>
      </tr>
    </thead>
    <tbody>
      @forelse($agendamentos as $agendamento)
        @if( isset($agendamento->deleted_at) )
          <tr class="table-danger">
        @else
          <tr>
         @endif
          <td class="text-nowrap">{{ $agendamento->id }}</td>
          <td class="text-nowrap text-center">{{ isset($agendamento->start) ? \Carbon\Carbon::parse($agendamento->start)->format('d/m/Y') : 'Não Informado' }}</td>
          <td class="text-nowrap text-center">{{ isset($agendamento->start) ? \Carbon\Carbon::parse($agendamento->start)->format('H:i') : 'Não Informado' }}</td>
          <td class="text-nowrap text-center">{{ isset($agendamento->end) ? \Carbon\Carbon::parse($agendamento->end)->format('H:i') : 'Não Informado' }}</td>
          <td class="text-nowrap">{{ $agendamento->xhooqvzhbgojbtg->apelido ?? $agendamento->id_cliente ?? $agendamento->obs ?? 'Não Informado'  }}</td>
          <td class="text-nowrap">{!! $agendamento->hhmaqpijffgfhmj->foto_tabela ?? $agendamento->id_profexec ?? 'Não Informado'  !!}</td>
          <td class="text-nowrap">{{ $agendamento->zlpekczgsltqgwg->nome ?? $agendamento->id_servprod ?? 'Não Informado' }}</td>
          <td class="text-nowrap">{{ $agendamento->eiuroereuwnofiw->apelido ?? $agendamento->id_criador ?? 'Não Informado' }}</td>
          <td class="text-nowrap text-center">{{ \Carbon\Carbon::parse($agendamento->created_at)->format('d/m/Y H:i:s') }}</td>
          <td class="text-nowrap">{{ $agendamento->obs }}</td>
          <td class="text-nowrap text-center">
            <span class="badge badge-primary" style="background-color: {{ $agendamento->color }}; color: black;"><b>{{ $agendamento->status }}</b></span></b>
          </td>
          <td class="text-nowrap text-center">
            <div class="btn-group">
              <!-- if($agendamento->instagram != null)
                <a href="{{ url('//www.instagram.com/'.$agendamento->instagram) }}" class="btn btn-default btn-xs" data-bs-tooltip="tooltip" data-bs-title="Instagram" data-original-title="Instagram" target="_blank"><i class="fab fa-instagram"></i></a>
              endif
              
              if($agendamento->facebook != null)
                <a href="{{ url('//www.facebook.com/'.$agendamento->facebook) }}" class="btn btn-default btn-xs" data-bs-tooltip="tooltip" data-bs-title="Facebook" data-original-title="Facebook" target="_blank"><i class="fab fa-facebook-square"></i></a>
              else
                <a href="{{ url('//www.facebook.com/search/top?q='.$agendamento->nome) }}" class="btn btn-default btn-xs" data-bs-tooltip="tooltip" data-bs-title="Facebook" data-original-title="Facebook" target="_blank"><i class="fab fa-facebook-square"></i></a>
              endif
              if($agendamento->ginthgfwxbdhwtu->where('whatsapp', 1)->first() != null)
              <a href='{{ url("//api.whatsapp.com/send?phone=55".$agendamento->whatsapp  ) }}' class="btn btn-default btn-xs" data-bs-tooltip="tooltip" data-bs-title="WhatsApp" data-original-title="WhatsApp" target="_blank"><i class="fab fa-whatsapp"></i></a>
              endif -->

            </div>

              <!-- can('agendamentos.Detalhes')
                <a href="{{ route('atd.agendamentos.mostrar', $agendamento) }}" class="text-muted" data-bs-tooltip="tooltip" data-bs-title="Visualizar" data-original-title="Visualizar"><i class="fa-solid fa-eye"></i></a>&nbsp;&nbsp;
              endcan -->

              <!-- can('agendamentos.Editar')
                <a href="{{ route('atd.agendamentos.editar', $agendamento) }}" class="text-muted" data-bs-tooltip="tooltip" data-bs-title="Editar" data-original-title="Editar"><i class="fa-solid fa-pencil"></i></a>&nbsp;&nbsp;
              endcan -->
              
              @can('agendamentos.Excluir')
                @if($agendamento->deleted_at == null)
                  <a onClick="agendamentos_excluir({{$agendamento->id}})" class="text-muted" data-bs-tooltip="tooltip" data-bs-title="Excluir" data-original-title="Excluir"><i class="fa-solid fa-trash"></i></a>
                @else
                  <a onClick="agendamentos_restaurar({{$agendamento->id}})" class="text-muted" data-bs-tooltip="tooltip" data-bs-title="Reativar" data-original-title="Reativar"><i class="fa-solid fa-recycle"></i></a>
                @endif
              @endcan
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
    {{ $agendamentos->appends($dataForm)->links() }}
    @else
    {{ $agendamentos->links() }}
    @endif
  </div>
</div>

