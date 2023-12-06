@extends('layouts.app')

@section('content_top_nav_left')
{{-- @can('Realizar.Comandas') --}}
<li class="nav-item dropdown">
  <a class="nav-link" data-bs-toggle="dropdown" href="#" aria-expanded="false">Despesas</a>
  <div class="dropdown-menu dropdown-menu-lg dropdown-menu-left">
    <a href="{{ route('lancamento.vale') }}" class="dropdown-item">
      <div class="media">
        <div class="media-body">
          <h3 class="dropdown-item-title">Vale</h3>
        </div>
      </div>
    </a>
    <a href="{{ route('lancamento.pao') }}" class="dropdown-item">
      <div class="media">
        <div class="media-body">
          <h3 class="dropdown-item-title">Pão</h3>
        </div>
      </div>
    </a>
    <div class="dropdown-divider"></div>
    {{-- <a href="{{ route('pdv.caixas.mostrar', Auth::User()->abcde->first()->id ?? null ) }}" class="dropdown-item"> --}}
      {{-- <div class="media">
        <i class="fas fa-store fa-2x fa-fw"></i>
        <div class="media-body">
          <h3 class="dropdown-item-title">Ver Caixa <span class="badge bg-pink text-sm">{{ Auth::User()->abcde->first()->id ?? null }}</span></h3>
          <p class="text-sm text-right"><span class="badge badge-warning">Saldo atual do Caixa: R$ {{ number_format(Auth::User()->abcde->first()->saldo_atual, 2, ',', '.') }}</span></p>
        </div>
      </div>
    </a> --}}
    <a href="{{ route('lancamento.d_gerais') }}" class="dropdown-item">
      <div class="media">
        <div class="media-body">
          <h3 class="dropdown-item-title">Gerais</h3>
        </div>
      </div>
    </a>
  </div>
</li>
<li class="nav-item dropdown">
  <a class="nav-link" href="{{ route('lancamento.r_gerais') }}">Receitas</a>
</li>
<li class="nav-item dropdown">
  <a class="nav-link" data-bs-toggle="dropdown" href="#" aria-expanded="false">Transferências</a>
  <div class="dropdown-menu dropdown-menu-lg dropdown-menu-left">
    <a href="{{ route('lancamento.transferencia') }}" class="dropdown-item">
      <div class="media">
        <div class="media-body">
          <h3 class="dropdown-item-title">Transferências</h3>
        </div>
      </div>
    </a>
  </div>
</li>
@endsection


@section('content')
<div class="row">
  <div class="col-md-12">
    <div class="card">
{{--
      <div class="overlay">
        <i class="fas fa-2x fa-sync-alt fa-spin"></i>
      </div>
      --}}
      <div class="card-header">
        <h3 class="card-title">Lista Geral de Lançamentos</h3>

        <div class="card-tools">
          <div class="btn-group">
            <a class="btn btn-sm btn-default" href="{{ route('lancamento.create') }}" ><i class="fas fa-plus"></i></a>
            <a class="btn btn-sm btn-default" data-bs-toggle="modal" data-bs-target="#modal_pesquisa" id="modal_pesquisa_modalzim"><i class="fas fa-filter"></i></a>
          </div>
        </div>
        @include('sistema.financeiro.lancamentos.modal.pesquisa')
      </div>
      <div class="card-body table-responsive p-0">
        <table class="table table-sm table-head-fixed text-nowrap no-padding" id="lancamento-list">
          <thead>
            <tr>
              <th width="5%" class="text-center">#</th>
              <th width="10%" class="text-center">Status</th>
              <th width="30%" class="text-left">Cliente</th>
              <th width="20%" class="text-center">Valor</th>
              <th width="5%"><i class="fas fa-ellipsis-h"></i></th>
            </tr>
          </thead>
          <tbody>
            @forelse($lancamentos->sortBy('status') as $lancamento)
            <tr>
              <td class="text-center">{{ $lancamento->id }}</td>
              <td class="text-center">
                @switch($lancamento->status)
                  @case('Aberta')
                    <span class="badge bg-warning">{{ $lancamento->status }}</span>
                    @break
                  @case('Finalizada')
                    <span class="badge bg-success">{{ $lancamento->status }}</span>
                    @break
                  @default
                    {{$lancamento->status}}
                @endswitch
              </td>
              <td class="text-left">{{ $lancamento->AtdPessoasClientesLancamentos->apelido ?? $lancamento->id_cliente }}</td>
              <td class="text-center">{{ number_format($lancamento->vlr_final, 2, ',', '.') }}</td>
              <td>
                <div class="btn-group">
                  <a href="{{ route('lancamento.show', $lancamento) }}" class="btn btn-default btn-xs" data-bs-tooltip="tooltip" data-bs-title="Visualizar" data-original-title="Visualizar"><i class="fas fa-search"></i></a>
                  @if($lancamento->deleted_at == null)
                  <a href="{{ route('lancamento.edit', $lancamento) }}" class="btn btn-default btn-xs" data-bs-tooltip="tooltip" data-bs-title="Editar" data-original-title="Editar"><i class="fas fa-pencil-alt"></i></a>
                  @endif
                  @if($lancamento->deleted_at == null)
                  <a href="{{ route('lancamento.index', $lancamento) }}" class="btn btn-default btn-xs" data-bs-tooltip="tooltip" data-bs-title="Desativar" data-original-title="Desativar"><i class="fas fa-times"></i></a>
                  @else
                  <a href="{{ route('lancamento.index', $lancamento) }}" class="btn btn-success btn-xs"> <i class="fa fa-redo"></i></a>
                  @endif
                </div>
                <div class="btn-group">
                  @if($lancamento->instagram != null)
                  <a href="{{ url('//www.instagram.com/'.$lancamento->instagram) }}" class="btn btn-default btn-xs" data-bs-tooltip="tooltip" data-bs-title="Instagram" data-original-title="Instagram" target="_blank"><i class="fab fa-instagram"></i></a>
                  @endif
                  @if($lancamento->facebook != null)
                  <a href="{{ url('//www.instagram.com/'.$lancamento->facebook) }}" class="btn btn-default btn-xs" data-bs-tooltip="tooltip" data-bs-title="Facebook" data-original-title="Facebook" target="_blank"><i class="fab fa-facebook-square"></i></a>
                  @endif
                  {{-- @if($lancamento->AtdLancamentosContatos->where('principal', 1)->first() != null) --}}
                  {{-- <a href='{{ url("//api.whatsapp.com/send?phone=55".$lancamento->whatsapp  ) }}' class="btn btn-default btn-xs" data-bs-tooltip="tooltip" data-bs-title="WhatsApp" data-original-title="WhatsApp" target="_blank"><i class="fab fa-whatsapp"></i></a> --}}
                  {{-- @endif --}}
                </div>
              </td>
            </tr>
            @empty
            <tr>
              <td class="text-center" colspan="8">Ainda não há lançamentos cadastrados.</td>
            </tr>
            @endforelse
          </tbody>
        </table>
      </div>
      <div class="card-footer clearfix">
        <div class="pagination pagination-sm float-right" style="height: 32px;">
          @if(isset($dataForm))
          {{ $lancamentos->appends($dataForm)->links() }}
          @else
          {{ $lancamentos->links() }}
          @endif
        </div>
      </div>
    </div>
    <meta name="csrf-token" content="{{ csrf_token() }}">
  </div>
</div>
@endsection

@section('js')
<script>
  $(document).ready(function()
  {
    // listar()
  });

  // $.ajaxSetup(
  // {
  //   headers:
  //   {
  //     'X-CSRF-TOKEN': $('meta[name="csrf-token"]').attr('content')
  //   }
  // });

  // function listar()
  // {
  //   $.ajax(
  //   {
  //     type: 'get',
  {{-- //     url: "{{ route('lancamento.list') }}", --}}
  //     beforeSend: function(response)
  //     {
  //       $('.overlay').show();
  //     },
  //     success: function(response)
  //     {
  //       $('#lancamento-list').empty().html(response);
  //     },
  //     error: function(response)
  //     {
  //       console.log(response)
  //     },
  //     failure: function (response)
  //     {
  //       console.log(response)
  //       alert('failure')
  //       // $('#result').html(response);
  //     },
  //     complete: function (response)
  //     {
  //       $('.overlay').hide();
  //       // setTimeout('$(".overlay").fadeOut(1500).css("display", "none");', 3000);
  //     }
  //   });
  // }

  // $('#lancamento-list').on('click', 'input[type="checkbox"]', function()
  // {
  //   var task = $(this).parents('.task');
  //   var idd  = task.prevObject[0].value;
  //   var done = task.prevObject[0].checked;

  {{-- //   var url = "{{ route('tarefa.update', ':idd') }}"; --}}
  //   var url = url.replace(':idd', idd);

  //   $.ajax({
  //     url : url,
  //     method : 'PATCH',
  //     data :
  //     {
  //       _token : $('meta[name="csrf-token"]').attr('content'),
  //       id : idd,
  //       done : done,
  //     },
  //     dataType : 'json',
  //     success : function(response)
  //     {
  //       if (response.typ == 'success')
  //       {
  //         Command: toastr["success"](response.msg)
  //       }
  //       else
  //       {
  //         Command: toastr["warning"](response.msg)
  //       }

  //       toastr.options = {
  //         "closeButton": true,
  //         "debug": false,
  //         "newestOnTop": true,
  //         "progressBar": true,
  //         "positionClass": "toast-top-right",
  //         "preventDuplicates": false,
  //         "onclick": null,
  //         "showDuration": "300",
  //         "hideDuration": "1000",
  //         "timeOut": "3000",
  //         "extendedTimeOut": "1000",
  //         "showEasing": "swing",
  //         "hideEasing": "linear",
  //         "showMethod": "fadeIn",
  //         "hideMethod": "fadeOut"
  //       }
  //     },
  //     error : function(response)
  //     {
  //       console.log(response)
  //       Command:toastr["error"]('Houve algum erro e a operação não pode ser concluída!')

  //       toastr.options = {
  //         "closeButton": true,
  //         "debug": false,
  //         "newestOnTop": true,
  //         "progressBar": true,
  //         "positionClass": "toast-top-right",
  //         "preventDuplicates": false,
  //         "onclick": null,
  //         "showDuration": "300",
  //         "hideDuration": "1000",
  //         "timeOut": "3000",
  //         "extendedTimeOut": "1000",
  //         "showEasing": "swing",
  //         "hideEasing": "linear",
  //         "showMethod": "fadeIn",
  //         "hideMethod": "fadeOut"
  //       }
  //     },
  //     complete : function(response)
  //     {
  //       listar();
  //     },
  //   });
  // });

  // $("#form_task_create").on('submit', function (e)
  // {
  //   e.preventDefault();

  //   var form = $(this);

  //   $.ajax({
    {{-- //     url       : "{{ route('tarefa.store') }}", --}}
  //     method    : "POST",
  //     data      : form.serialize(),
  //     dataType  : 'json',
  //     success   : function(data)
  //     {
  //       console.log(data)
  //       alert('servico criado com sucesso');
  //     },
  //     error     : function(defeito)
  //     {
  //       console.log(defeito)
  //       alert('Houve algum erro e o cliente não foi criado.');
  //     },
  //     complete  : function(resulado)
  //     {
  //       alert('s')
  //       // $("#cancelar_servico_create").click();
  //     },
  //   });
  // });
  @if(session()->exists('resposta'))
  toastrjs('{{ session()->get('resposta')['type'] }}', '{{ session()->get('resposta')['message'] }}')
  @endif
</script>
@stop
