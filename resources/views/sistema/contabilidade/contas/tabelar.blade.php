<div class="card-body table-responsive p-0">
  <table class="table table-sm table-striped no-padding table-valign-middle projects">
    <thead class="table-dark">
      <tr>
        <th class="text-nowrap">#</th>
        <th class="text-nowrap">N. Conta</th>
        <th class="text-nowrap">Título</th>
        {{-- <th class="text-nowrap">imprime</th> --}}
        {{-- <th class="text-nowrap">soma</th> --}}
        <th class="text-nowrap text-center">Recebe Lançamentos</th>
        {{-- <th class="text-nowrap text-center">CPF/CNPJ</th> --}}
        <th class="text-nowrap text-center"><i class="fas fa-ellipsis-h"></i></th>
      </tr>
    </thead>
    <tbody>
      @forelse($contas->sortBy('nova_conta') as $conta)
        <tr>
          <td class="text-nowrap">{{ $conta->id }}</td>
          <td class="text-nowrap">{{ $conta->nova_conta }}</td>
          <td class="text-nowrap">
            <a>{!! str_repeat('&nbsp;&nbsp;&nbsp;', $conta->nivel) !!}&nbsp;{{ $conta->titulo }}</a><br>
            <small>
              {!! str_repeat('&nbsp;&nbsp;&nbsp;', $conta->nivel) !!}
              @if(!$conta->tem_lancamento)
                <a onclick="adicionar_conta_filho({{ $conta->id }})" data-bs-tooltip="tooltip" data-bs-title="Adicionar Conta Filho" data-original-title="Adicionar Conta Filho" style="cursor: pointer;" ><i class="fa-solid fa-arrow-turn-up fa-rotate-90"></i>&nbsp;&nbsp;<i class="fas fa-square-plus"></i></a>&nbsp;&nbsp;
                {{-- @else --}}
                {{-- <a class="text-muted" data-bs-tooltip="tooltip" data-bs-title="Adicionar Conta Filho" data-original-title="Adicionar Conta Filho"><i class="fas fa-square-plus"></i></a>&nbsp;&nbsp; --}}
              @endif
              @if($conta->sasjiqelrhwkejs->count() == 0 && $conta->nivel != 0)
                <a onclick="excluir_conta({{ $conta->id }})" data-bs-tooltip="tooltip" data-bs-title="Excluir Conta" data-original-title="Excluir Conta" style="cursor: pointer;" >&nbsp;&nbsp;<i class="fas fa-trash"></i></a>&nbsp;&nbsp;
              @endif
            </small>
          </td>
          {{-- <td class="text-nowrap">{{ $conta->imprime }}</td> --}}
          <td class="text-center">
            <input type="checkbox" onclick="marcar_tem_lancamento( {{ $conta->id }}, this.checked )"
            {{-- @if($conta->sasjiqelrhwkejs->count() == 0) --}}
            @if($conta->tem_lancamento)
            checked
            @endif
            >
          </td>
          {{-- <td class="text-nowrap">{{ $conta->tem_lancamento }}</td> --}}
          {{-- <td class="text-nowrap text-center">{{ $conta->cpf }}</td> --}}
          <td class="text-nowrap text-center">
            {{ $conta->jfsdlfeofwepokf->count() }}
            <div class="btn-group">
              @if($conta->instagram != null)
                <a href="{{ url('//www.instagram.com/'.$conta->instagram) }}" class="btn btn-default btn-xs" data-bs-tooltip="tooltip" data-bs-title="Instagram" data-original-title="Instagram" target="_blank"><i class="fab fa-instagram"></i></a>
              @endif
              
              @if($conta->facebook != null)
                <a href="{{ url('//www.facebook.com/'.$conta->facebook) }}" class="btn btn-default btn-xs" data-bs-tooltip="tooltip" data-bs-title="Facebook" data-original-title="Facebook" target="_blank"><i class="fab fa-facebook-square"></i></a>
              @endif
            </div>
          </td>
              {{-- @can('Pessoas.Detalhes') --}}
                {{-- <a href="{{ route('atd.pessoas.mostrar', $conta) }}" class="text-muted" data-bs-tooltip="tooltip" data-bs-title="Visualizar" data-original-title="Visualizar"><i class="fa-solid fa-eye"></i></a>&nbsp;&nbsp; --}}
              {{-- @endcan --}}
{{-- 
              @can('Pessoas.Editar')
                <a href="{{ route('atd.pessoas.editar', $conta) }}" class="text-muted" data-bs-tooltip="tooltip" data-bs-title="Editar" data-original-title="Editar"><i class="fa-solid fa-pencil"></i></a>&nbsp;&nbsp;
              @endcan --}}
              
              {{-- @can('Pessoas.Excluir')
                @if($conta->deleted_at == null)
                  <a onClick="pessoas_excluir({{$conta->id}})" class="text-muted" data-bs-tooltip="tooltip" data-bs-title="Excluir" data-original-title="Excluir"><i class="fa-solid fa-trash"></i></a>
                @else
                  <a onClick="pessoas_restaurar({{$conta->id}})" class="text-muted" data-bs-tooltip="tooltip" data-bs-title="Reativar" data-original-title="Reativar"><i class="fa-solid fa-recycle"></i></a>
                @endif
              @endcan --}}
            {{-- @endif --}}

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
    {{ $contas->links() }}
  </div>
</div>

<script>
//
function adicionar_conta_filho( id_pai )
{
  axios.get("{{ route('con.contas.adicionar') }}"+'?id='+id_pai)
  .then(res => {
    console.log(res.data)
    $('#modal-geral-1').empty().append(res.data)
  })
  {{-- @include('includes.catch', [ 'codigo_erro' => '2135483a' ] ) --}}
  .then(() => {
    $('#modal-geral-1').modal('show')
  })
}

function excluir_conta( id )
{
  // $('#overlay-produtos').show();
  
  if (confirm("Caso essa conta possua lançamentos, os lançamentos ficarão sem vinculação a uma conta contábil. Deseja Continuar?") == true)
  {
    var url = "{{ route('con.contas.excluir', ':id') }}";
    var url = url.replace(':id', id);

    axios.delete(url)
    .then(res => {
      console.log(res)
      toastrjs(res.data.type, res.data.message)
    })
    {{-- @include('includes.catch', [ 'codigo_erro' => '2324165a' ] ) --}}
    .then(() => {
      $('#modal-geral-1').modal('hide');
      contas_tabelar()
    })
    .then(() => {
      $('#overlay-produtos').hide();
    })
  }
  else
  {
    toastrjs('error', 'Operação Cancelada.')
  }
}

function marcar_tem_lancamento( id, status )
{
  let params = {
    tem_lancamento: status
  }
  
  var url = "{{ route('con.contas.atualizar', ':id') }}";
  var url = url.replace(':id', id);
    
  axios.put(url, params)
  .then(res => {
    // console.log(res.data)
    toastrjs(res.data.type, res.data.message)
  })
  {{-- @include('includes.catch', [ 'codigo_erro' => '3451245a' ] ) --}}
  .then(() => {
    $('#modal-geral-1').modal('hide');
    contas_tabelar()
  })
}
</script>
