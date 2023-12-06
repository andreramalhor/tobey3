<div class="card-body table-responsive p-0">
  <table class="table table-sm table-striped no-padding table-valign-middle projects" id="tabela-contratos">
    <thead class="table-dark">
      <tr>
        <th class="text-nowrap">#</th>
        <th class="text-nowrap">Foto</th>
        <th class="text-nowrap">Nome</th>
        <th class="text-nowrap text-center">CPF/CNPJ</th>
        <th class="text-nowrap">Data de Nascimento</th>
        <th class="text-nowrap">e-Mail</th>
        <th class="text-nowrap"># RSschool</th>
        <th class="text-nowrap text-center"></th>
        <th class="text-nowrap text-center"><i class="fas fa-ellipsis-h"></i></th>
      </tr>
    </thead>
    <tbody>
      @forelse($contratos as $contrato)
        @if( isset($contrato->deleted_at) )
          <tr class="table-danger">
        @else
          <tr>
        @endif
          <td class="text-nowrap">{{ $contrato->id }}</td>
          <td class="text-nowrap">
            <li class="list-inline-item">
              <img src="{{ $contrato->foto_perfil }}" alt="{{ $contrato->nome }}" class="table-avatar" onerror="this.src='http://127.0.0.1:8000/img/atendimentos/contratos/0.png'" style="width: 30px">
            </li>
          </td>
          <td class="text-nowrap">{{ $contrato->nome }}</td>
          <td class="text-nowrap text-center">{{ $contrato->cpf }}</td>
          <td class="text-nowrap">
            @if(isset($contrato->dt_nascimento))
            {{ \Carbon\Carbon::parse($contrato->dt_nascimento)->format('d/m/Y') }} ({{ \Carbon\Carbon::parse($contrato->dt_nascimento)->age }} anos)
            @endif
          </td>
          <td class="text-nowrap">{{ $contrato->email }}</td>
          <td class="text-nowrap text-left">
            <a onclick="contratos_idrsschool('{{ $contrato->id }}', '{{ $contrato->id_rsschool }}')" class="text-muted" data-bs-tooltip="tooltip" data-bs-title="# RS School" data-original-title="RS School" style="cursor: pointer;"><i class="fa-solid fa-shield"></i></a>
            &nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;

            {{ $contrato->id_rsschool ?? '' }}
          </td>

          <td class="text-nowrap text-center">
            <div class="btn-group">
              @if($contrato->instagram != null)
                <a href="{{ url('//www.instagram.com/'.$contrato->instagram) }}" class="btn btn-default btn-xs" data-bs-tooltip="tooltip" data-bs-title="Instagram" data-original-title="Instagram" target="_blank"><i class="fab fa-instagram"></i></a>
              @endif
              
              @if($contrato->facebook != null)
                <a href="{{ url('//www.facebook.com/'.$contrato->facebook) }}" class="btn btn-default btn-xs" data-bs-tooltip="tooltip" data-bs-title="Facebook" data-original-title="Facebook" target="_blank"><i class="fab fa-facebook-square"></i></a>
              @else
                <a href="{{ url('//www.facebook.com/search/top?q='.$contrato->nome) }}" class="btn btn-default btn-xs" data-bs-tooltip="tooltip" data-bs-title="Facebook" data-original-title="Facebook" target="_blank"><i class="fab fa-facebook-square"></i></a>
              @endif

            </div>
          </td>

          <td class="text-nowrap text-center">

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
    {{ $contratos->appends($dataForm)->links() }}
    @else
    {{ $contratos->links() }}
    @endif
  </div>
</div>

