<div class="row">
    
    <x-slot name="title">
        {{ __('Extrato de lançamentos') }}
    </x-slot>

    <div class="col-md-12">
        <div class="card">
            <div class="overlay d-none" wire:loading.class="d-block"></div>
            <div class="card-header">
                <h3 class="card-title">Extrato de lançamentos {{ $modal_type ?? 'modaltype' }}</h3>
            </div>
            <div class="card-body p-0">
                <div class="row p-2">
                    <div class="offset-md-8 col-md-2">
                        <div class="input-group input-group-sm">
                            <input type="text" class="form-control float-right" placeholder="Pesquisar" wire:model.live="pesquisar">
                            <div class="input-group-append">
                                <button type="submit" class="btn btn-default">
                                    <i class="fas fa-search"></i>
                                </button>
                            </div>
                        </div>
                    </div>
                    <div class="col-md-2">
                        <a class="btn btn-secondary btn-block btn-sm float-right" wire:click="criar"><i class="fa fa-plus"></i> Cadastrar novo condomínio</a>
                    </div>
                </div>
                <table class="table">
                    <thead class="table-dark">
                        <tr>
                            {{-- <th class="text-center"></th> --}}
                            <th class="text-left">Condomínio</th>
                            <th class="text-left">Endereço</th>
                            <th class="text-left">Telefone</th>
                            <th class="text-left">CNPJ</th>
                            <th class="text-right"><i class="fas fa-ellipsis-h"></i></th>
                        </tr>
                    </thead>
                    <tbody>
                        @forelse ($lancamentos as $ciclo)
                        <tr wire:key="{{ $ciclo->id }}">
                            {{-- <td class="p-1 text-center">
                                <img class="direct-chat-img" src="{{ $ciclo->src_foto  }}">
                            </td> --}}
                            <td class="p-1 text-left">{{ $ciclo->nome }}</td>
                            <td class="p-1 text-left">{{ $ciclo->endereco }}</td>
                            <td class="p-1 text-left">{{ $ciclo->fone }}</td>
                            <td class="p-1 text-left">{{ $ciclo->cnpj }}</td>
                            <td class="p-1 text-right">
                                <x-icon.view click="{{ $ciclo->id }}" />
                                &nbsp;
                                <x-icon.edit click="{{ $ciclo->id }}" />
                                &nbsp;
                                <x-icon.delete click="{{ $ciclo->id }}" />
                            </td>
                        </tr>
                        @empty
                        <tr>
                            <td colspan="6" class="text-center"><small>Não há lançamentos cadastrados</small></td>
                        </tr>
                        @endforelse
                    </tbody>
                </table>
            </div>
            <div class="card-footer clearfix">
                <div class="float-right">
                    {{ $lancamentos->links() }}
                </div>
            </div>
        </div>
    </div>
    @include('livewire.condominio.criar')
    @include('livewire.condominio.editar')
    @include('livewire.condominio.mostrar')
</div>

{{--

    CRUD

create    criar
read      mostrar
update    atualizar
delete    deletar


# create (criar)
store (armazenar ou salvar)
# edit (editar)
update (atualizar)
# show (mostrar ou exibir)
destroy (destruir, remover ou deletar)

--}}
{{--

extends('layouts.app')

section('content')
<section class="content-header p-0">
  <div class="container-fluid">
    <div class="row mb-2">
      <div class="col-sm-6">
        <h1>Lançamentos</h1>
      </div>
      <div class="col-sm-6 p-0">
        <div class="btn-group float-end p-0 ml-1">
          <!-- <a href="#" onclick="lancamentos_direcionar('lancar')" class="btn btn-primary">Lançar (desativado)</a> -->
        </div>
        <div class="btn-group float-end p-0 ml-1">
          <a href="#" onclick="lancamentos_direcionar('transferencia')" class="btn btn-warning">Transferências</a>
        </div>
        <div class="btn-group float-end p-0 ml-1">
          <a href="#" onclick="lancamentos_direcionar('receita_geral')" class="btn btn-success">Receitas</a>
          <!-- <button type="button" class="btn btn-default dropdown-toggle dropdown-icon" data-bs-toggle="dropdown" aria-expanded="false"></button>
          <div class="dropdown-menu dropdown-menu-end" role="menu" style="">
            <a class="dropdown-item" href="#" onclick="lancamentos_direcionar('despesa.vale')">Vale</a>
            <a class="dropdown-item" href="#" onclick="lancamentos_direcionar('aksjalks')">Adiantamento</a>
            <div class="dropdown-divider"></div>
            <a class="dropdown-item" href="#" onclick="lancamentos_direcionar('aksjalks')">Energia</a>
            <a class="dropdown-item" href="#" onclick="lancamentos_direcionar('aksjalks')">Internet</a>
            <a class="dropdown-item" href="#" onclick="lancamentos_direcionar('aksjalks')">Celular</a>
            <a class="dropdown-item" href="#" onclick="lancamentos_direcionar('aksjalks')">Água</a>
            <a class="dropdown-item" href="#" onclick="lancamentos_direcionar('aksjalks')">Água</a>
          </div> -->
        </div>
        <div class="btn-group float-end p-0 ml-1">
          <a href="#" onclick="lancamentos_direcionar('despesa_geral')" class="btn btn-danger">Despesas</a>
          <button type="button" class="btn btn-default dropdown-toggle dropdown-icon" data-bs-toggle="dropdown" aria-expanded="false"></button>
          <div class="dropdown-menu dropdown-menu-end" role="menu" style="">
            {{-- <a class="dropdown-item" href="#" onclick="lancamentos_direcionar('desp_indicou_ganhou')">Campanha Indicou, Ganhou!</a> --}}
{{--

            if(isset(\Auth::User()->abcde->first()->id))
            <a class="dropdown-item" href="#" onclick="lancamentos_direcionar('desp_adiantamento')">Vale / Adiantamento</a>
            endif
            <!-- <a class="dropdown-item" href="#" onclick="lancamentos_direcionar('aksjalks')">Vale</a>
            <div class="dropdown-divider"></div>
            <a class="dropdown-item" href="#" onclick="lancamentos_direcionar('aksjalks')">Energia</a>
            <a class="dropdown-item" href="#" onclick="lancamentos_direcionar('aksjalks')">Internet</a>
            <a class="dropdown-item" href="#" onclick="lancamentos_direcionar('aksjalks')">Celular</a>
            <a class="dropdown-item" href="#" onclick="lancamentos_direcionar('aksjalks')">Água</a>
            <a class="dropdown-item" href="#" onclick="lancamentos_direcionar('aksjalks')">Água</a> -->
          </div>
        </div>
      </div>
    </div>
  </div>
</section>

<div class="row">
  <div class="col-12 col-sm-12 col-md-12 col-lg-12 col-xl-12">
    <div class="card">
      <div class="overlay" id="overlay-lancamentos">
        <i class="fas fa-2x fa-sync-alt fa-spin"></i>
      </div>
      <div class="card-header">
        <h3 class="card-title">Lançamentos</h3>
        <div class="card-tools">
          <div class="btn-toolbar">
            <div class="input-group input-group-sm mb-2">
              <input type="text" class="form-control form-control-sm" id="ipt-pesquisa" onkeyup="lancamentos_tabelar()">
              <div class="input-group-append">
                <a class="input-group-text"><i class="fas fa-search"></i></a>
              </div>
            </div>
            &emsp;
            <div class="btn-group">
              <a class="btn btn-sm btn-default" data-bs-toggle="modal" data-bs-target="#modal_lancamentos_filtrar"><i class="fas fa-filter"></i></a>
              can('Lançamentos.Criar')
                {{-- <a class="btn btn-sm btn-default" data-bs-toggle="modal" data-bs-target="#modal_lancamentos_adicionar"><i class="fas fa-plus"></i></a> --}}
                {{-- <a class="btn btn-sm btn-default" href="{{ route('fin.lancamentos.adicionar', 'sajs') }}"><i class="fas fa-plus"></i></a> --}}
{{--

              endcan
            </div>
            include('sistema.financeiro.lancamentos.auxiliares.mod_filtro')
          </div>
        </div>
      </div>
      <div class="card-body table-responsive p-0">
        <table class="table table-striped table-valign-middle" id="tabela-lancamentos">
          <thead>
            <tr>
              <th class="text-center"><i class="fas fa-ellipsis-h"></i></th>
            </tr>
          </thead>
          <tbody>
            <tr>
              <td class="text-center">Carregando...</td>
            </tr>
          </tbody>
        </table>
      </div>
    </div>
  </div>  
</div>
include('includes.modal.modal-geral-1')
endsection

section('js')
<script type="text/javascript">
$(window).on('shown.bs.modal', function()
{
  $('.select2').select2({
    dropdownParent: $('#modal-geral-1'),
  });
})

$(document).ready( function()
{
  lancamentos_tabelar()
  
  $(document).on('click', '.pagination a', function(event)
  {
    event.preventDefault()
    var page = $(this).attr('href').split('page=')[1]
    lancamentos_tabelar(page)
  })
})

function lancamentos_direcionar(direcionamento)
{
  var url = "{{ route('fin.lancamentos.adicionar', ':direcionamento') }}"
  var url = url.replace(':direcionamento', direcionamento)

  axios.get(url)
  .then(function(response)
  {
    // console.log(response.data)
    $('#modal-geral-1').empty().append(response.data)
  })
  include('includes.catch', [ 'codigo_erro' => '9193146a' ] )
  .then( function()
  {
    $('#modal-geral-1').modal('show')
  })
}

function lancamentos_tabelar(page)
{
  $('#overlay-lancamentos').show()

  var url = "{{ route('fin.lancamentos.tabelar') }}"  

  var filtro   = $('#form-filtro').serialize()
  var pesquisa = $('#ipt-pesquisa').val()
  // var params   = url
  // var params   = url+'&'+filtro+'&pesquisa='+pesquisa
    var params   = url+'&'+filtro+'&pesquisa='+pesquisa;

  axios.get(url, {
    params: {
      page: page,
      filtro: filtro,
      pesquisa: pesquisa,
    }
  })
  // axios.get(params)
  .then(function(response)
  {
    console.log(response.data)
    $('#tabela-lancamentos').empty().append(response.data)
  })
  include('includes.catch', [ 'codigo_erro' => '2721248a' ] )
  .then( function(response)
  {
    $('#overlay-lancamentos').hide()
  })
}

function lancamentos_tabelar_confirmados(page)
{
  $('#overlay-lancamentos-2').show()

  var url    = "{{ route('fin.lancamentos.tabelar') }}"  
  var params = url+'?tipo_tabela=confirmado'

  axios.get(params)
  .then(function(response)
  {
    // console.log(response.data)
    $('#tabela-lancamentos-confirmados').empty().append(response.data)
  })
include('includes.catch', [ 'codigo_erro' => '1602498a' ] )
  .then( function(response)
  {
    $('#overlay-lancamentos-2').hide()
  })
}

  function lancamentos_excluir(id)
  {
    $('#overlay-lancamentos').show()

    var url = "{{ route('fin.lancamentos.excluir', ':id') }}"
    var url = url.replace(':id', id)

    axios.delete(url)
    .then(function(response)
    {
      // console.log(response.data)
      toastrjs(response.data.type, response.data.message)
    })
include('includes.catch', [ 'codigo_erro' => '6391366a' ] )
    .then( function(response)
    {
      lancamentos_tabelar()
    })
    .then( function(response)
    {
      $('#overlay-lancamentos').hide()
    })
  }

  function lancamentos_restaurar(id)
  {
    $('#overlay-lancamentos').show()

    var url = "{{ route('fin.lancamentos.restaurar', ':id') }}"
    var url = url.replace(':id', id)
    
    axios.post(url)
    .then(function(response)
    {
      console.log(response.data)
      toastrjs(response.data.type, response.data.message)
    })
include('includes.catch', [ 'codigo_erro' => '3396740a' ] )
    .then( function(response)
    {
      lancamentos_tabelar()
    })
    .then( function(response)
    {
      $('#overlay-lancamentos').hide()
    })
  }

  if(session()->exists('resposta'))
  toastrjs('{{ session()->get('resposta')['type'] }}', '{{ session()->get('resposta')['message'] }}')
  endif
</script>
endsection
--}}
