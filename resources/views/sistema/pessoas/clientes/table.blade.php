<div class="card-body table-responsive p-0">
  <table class="table table-sm table-head-fixed text-nowrap no-padding" id="pessoa-list">
    <thead>
      <tr>
        {{-- <th class="text-center">#</th> --}}
        <th style="background-color: silver;">Nome</th>
        <th style="background-color: silver;">Username</th>
        <th style="background-color: silver;">E-mail</th>
        <th style="background-color: silver;" class="text-center">Created_at</th>
        <th style="background-color: silver;"><i class="fas fa-ellipsis-h"></i></th>
      </tr>
    </thead>
    <tbody>
      @forelse($pessoas as $pessoa)
        @if( isset($pessoa->deleted_at) )
          <tr class="table-danger">
        @else
          <tr>
        @endif
        {{-- <td><img src="{{ asset('/img/atendimentos/pessoas/'.$pessoa->id.'.png') }}" class="img-circle" alt="User Image" width="25px"></td> --}}
        <td>{{ $pessoa->nome }}</td>
        <td>{{ $pessoa->ATD_Pessoas_Equipe->username }}</td>
        <td>{{ $pessoa->email }}</td>
        <td>{{ \Carbon\Carbon::parse($pessoa->created_at)->format('d/m/Y H:i:s') }}</td>
        <td>
          <div class="btn-group">
            <a href="{{ route('pessoa.show', $pessoa) }}" class="btn btn-default btn-xs" data-bs-tooltip="tooltip" data-bs-title="Visualizar" data-original-title="Visualizar"><i class="fas fa-search"></i></a>
            @if($pessoa->deleted_at == null)
            <a href="{{ route('pessoa.edit', $pessoa) }}" class="btn btn-default btn-xs" data-bs-tooltip="tooltip" data-bs-title="Editar" data-original-title="Editar"><i class="fas fa-pencil-alt"></i></a>
            @endif
            @if($pessoa->deleted_at == null)
              <button type="button" class="btn btn-default btn-xs" id="btn_clean" onclick="disablePerson('{{ $pessoa->id }}')" data-bs-dismiss="modal"><i class="fas fa-times"></i></button>
            @else
              <button type="button" class="btn btn-success btn-xs" id="btn_clean" onclick="activatePerson('{{ $pessoa->id }}')" data-bs-dismiss="modal"><i class="fas fa-redo"></i></button>
            @endif
          </div>
          <div class="btn-group">
            @if($pessoa->instagram != null)
            <a href="{{ url('//www.instagram.com/'.$pessoa->instagram) }}" class="btn btn-default btn-xs" data-bs-tooltip="tooltip" data-bs-title="Instagram" data-original-title="Instagram" target="_blank"><i class="fab fa-instagram"></i></a>
            @endif
            @if($pessoa->facebook != null)
            <a href="{{ url('//www.instagram.com/'.$pessoa->facebook) }}" class="btn btn-default btn-xs" data-bs-tooltip="tooltip" data-bs-title="Facebook" data-original-title="Facebook" target="_blank"><i class="fab fa-facebook-square"></i></a>
            @endif
            {{-- @if($pessoa->AtdPessoasContatos->where('principal', 1)->first() != null) --}}
            {{-- <a href='{{ url("//api.whatsapp.com/send?phone=55".$pessoa->whatsapp  ) }}' class="btn btn-default btn-xs" data-bs-tooltip="tooltip" data-bs-title="WhatsApp" data-original-title="WhatsApp" target="_blank"><i class="fab fa-whatsapp"></i></a> --}}
            {{-- @endif --}}
          </div>
        </td>
      </tr>
      @empty
      <tr>
        <td class="text-center" colspan="8">Ainda não há pessoas cadastradas.</td>
      </tr>
      @endforelse
    </tbody>
  </table>
</div>
<div class="card-footer clearfix">
  <div class="pagination pagination-sm float-right">
    {{ $pessoas->links() }}
  </div>
</div>
