<div class="card-body table-responsive p-0">
  <table class="table table-sm table-striped no-padding table-valign-middle projects" id="tabela-leads">
    <thead class="table-dark">
      <tr>
        <th class="text-nowrap">#</th>
        <th class="text-nowrap">Nome</th>
        <th class="text-nowrap">Telefone</th>
        <th class="text-nowrap">Cidade</th>
        <th class="text-nowrap">e-Mail</th>
        <th class="text-nowrap">Obs</th>
        <th class="text-nowrap">Origem</th>
        <th class="text-nowrap">Interesse</th>
        <th class="text-nowrap">Curso / Turma</th>
        <th class="text-nowrap">Status</th>
        <th class="text-nowrap">Data de<br>Cadastro</th>
        @can('Gerente Comercial')
          <th class="text-nowrap">Consultor</th>
        @endcan
        <th class="text-nowrap text-center"><i class="fas fa-ellipsis-h"></i></th>
      </tr>
    </thead>
    <tbody>
      @forelse($leads as $lead)
        @if( isset($lead->deleted_at) )
          <tr class="table-danger">
        @else
          <tr>
        @endif
          <td class="text-nowrap">{{ $lead->id }}</td>
          <td class="text-left">{{ $lead->nome }}</td>
          <td class="text-nowrap">{{ $lead->telefone }}</td>
          <td class="text-nowrap">{{ $lead->cidade }}</td>
          <td class="text-nowrap">{{ $lead->email }}</td>
          <td class="text-left">{{ $lead->obs }}</td>
          <td class="text-nowrap">{{ $lead->origem }}</td>
          <td class="text-nowrap">{!! $lead->badge_interesse !!}</td>
          <td class="text-nowrap">{{ $lead->id_turma }}</td>
          <td class="text-nowrap">{!! $lead->badge_status !!}</td>
          <td class="text-nowrap">{{ \Carbon\Carbon::parse($lead->created_at)->format('d/m/Y') }}</td>
          @can('Gerente Comercial')
          <td class="text-nowrap">{{ $lead->lskdfjweklwejrq->apelido ?? $lead->id_consultor ?? '' }}</td>
          @endcan
          <td class="text-nowrap text-center">
            @can('Leads.Detalhes')
              <a onClick="lead_modal({{ $lead->id }})" class="text-muted" data-bs-tooltip="tooltip" data-bs-title="Visualizar" data-original-title="Visualizar"><i class="fa-solid fa-eye"></i></a>&nbsp;&nbsp;
            @endcan

            @can('Leads.Editar')
              <a href="{{ route('com.leads.editar', $lead) }}" class="text-muted" data-bs-tooltip="tooltip" data-bs-title="Editar" data-original-title="Editar"><i class="fa-solid fa-pencil"></i></a>&nbsp;&nbsp;
            @endcan

            @can('Leads.Excluir')
                @if($lead->deleted_at == null)
                    <a onClick="leads_excluir({{$lead->id}})" class="text-muted" data-bs-tooltip="tooltip" data-bs-title="Excluir" data-original-title="Excluir"><i class="fa-solid fa-trash"></i></a>
                @else
                    <a onClick="leads_restaurar({{$lead->id}})" class="text-muted" data-bs-tooltip="tooltip" data-bs-title="Reativar" data-original-title="Reativar"><i class="fa-solid fa-recycle"></i></a>
                @endif
            @endcan
          </td>
        </tr>
      @empty
      <tr>
        <td class="text-center" colspan="12">Não há resultados para essa tabela.</td>
      </tr>
      @endforelse
    </tbody>
  </table>
</div>
<div class="card-footer clearfix">
  <div class="pagination pagination-sm float-right">
    @if(isset($dataForm))
    {{ $leads->appends($dataForm)->links() }}
    @else
    {{ $leads->links() }}
    @endif
  </div>
</div>
