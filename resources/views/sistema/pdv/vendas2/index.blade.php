@extends('layouts.app')

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
        <h3 class="card-title">Lista Geral de Vendas</h3>

        <div class="card-tools">
          <div class="btn-group">
            <a class="btn btn-sm btn-default" href="{{ route('pdv.vendas.create') }}" ><i class="fas fa-plus"></i></a>
            <a class="btn btn-sm btn-default" data-bs-toggle="modal" data-bs-target="#modal_pesquisa" id="modal_pesquisa_modalzim"><i class="fas fa-filter"></i></a>
          </div>
        </div>
        @include('sistema.pdv.vendas.modal.pesquisa')
      </div>
      <div class="card-body table-responsive p-0">
        <table class="table table-sm table-head-fixed text-nowrap no-padding" id="venda-list">
          <thead>
            <tr>
              <th class="text-center">#</th>
              <th class="text-left">Horário</th>
              <th class="text-center">Status</th>
              <th class="text-left">Cliente</th>
              <th class="text-right">Qtd Produtos/ Serviços</th>
              <th class="text-center">Valor</th>
              <th><i class="fas fa-ellipsis-h"></i></th>
            </tr>
          </thead>
          <tbody>
            @forelse($vendas->sortBy('status') as $venda)
            <tr  class={{ isset($venda->deleted_at) ? "table-danger" : "" }} >
              <td class="text-center">{{ $venda->id }}</td>
              <td class="text-left">{{ \Carbon\Carbon::parse($venda->created_at)->format('d/m/Y H:i') }}</td>
              <td class="text-center">
                @switch($venda->status)
                  @case('Aberta')
                    <span class="badge badge-warning">{{ $venda->status }}</span>
                    @break
                  @case('Finalizado')
                    <span class="badge badge-success">{{ $venda->status }}</span>
                    @break
                  @case('Excluído')
                    <span class="badge badge-danger">{{ $venda->status }}</span>
                    @break
                  @default
                    {{$venda->status}}
                @endswitch
              </td>
              <td class="text-left">{{ $venda->lufqzahwwexkxli->apelido ?? $venda->id_cliente }}</td>
              <td class="text-right">{{ $venda->qtd_produtos  }}</td>
              <td class="text-center">{{ number_format($venda->vlr_final, 2, ',', '.') }}</td>
              <td>
                <div class="btn-group">
                  <a class="btn btn-default btn-xs" data-bs-tooltip="tooltip" data-bs-title="Visualizar" data-original-title="Visualizar" onclick="showVenda({{ $venda->id }})"><i class="fas fa-search"></i></a>
                  @if($venda->deleted_at == null)
                  <a href="{{ route('pdv.vendas.edit', $venda) }}" class="btn btn-default btn-xs" data-bs-tooltip="tooltip" data-bs-title="Editar" data-original-title="Editar"><i class="fas fa-pencil-alt"></i></a>
                  @endif
                  @if($venda->deleted_at == null && isset($venda->PDVCaixasVendas->status) && $venda->PDVCaixasVendas->status == "Aberto" )
                  <a class="btn btn-danger btn-xs" onclick="deletarVenda( {{ $venda->id }} )" ><i class="fas fa-fw fa-times"></i></a>
                  {{-- @elseif($venda->deleted_at == null) --}}
                  {{-- <a href="{{ route('pdv.vendas.index', $venda) }}" class="btn btn-success btn-xs"> <i class="fa fa-redo"></i></a> --}}
                  @endif
                </div>
                <div class="btn-group">
                  @if($venda->instagram != null)
                  <a href="{{ url('//www.instagram.com/'.$venda->instagram) }}" class="btn btn-default btn-xs" data-bs-tooltip="tooltip" data-bs-title="Instagram" data-original-title="Instagram" target="_blank"><i class="fab fa-instagram"></i></a>
                  @endif
                  @if($venda->facebook != null)
                  <a href="{{ url('//www.instagram.com/'.$venda->facebook) }}" class="btn btn-default btn-xs" data-bs-tooltip="tooltip" data-bs-title="Facebook" data-original-title="Facebook" target="_blank"><i class="fab fa-facebook-square"></i></a>
                  @endif
                  @if($venda->status == 'Aberta')
                  <a href="{{ route('pdv.vendas.editar', $venda->id) }}" class="btn btn-warning btn-xs"> <i class="fas fa-fw fa-box-open"></i></a>
                  <a href="{{ route('pdv.vendas.pagar', $venda->id) }}" class="btn btn-success btn-xs"> <i class="fas fa-fw fa-credit-card"></i></a>
                  @endif

                  {{-- @if($venda->AtdVendasContatos->where('principal', 1)->first() != null) --}}
                  {{-- <a href='{{ url("//api.whatsapp.com/send?phone=55".$venda->whatsapp  ) }}' class="btn btn-default btn-xs" data-bs-tooltip="tooltip" data-bs-title="WhatsApp" data-original-title="WhatsApp" target="_blank"><i class="fab fa-whatsapp"></i></a> --}}
                  {{-- @endif --}}
                </div>
              </td>
            </tr>
            @empty
            <tr>
              <td class="text-center" colspan="8">Ainda não há vendas cadastradas.</td>
            </tr>
            @endforelse
          </tbody>
        </table>
      </div>
      <div class="card-footer clearfix">
        <div class="pagination pagination-sm float-right" style="height: 32px;">
          @if(isset($dataForm))
          {{ $vendas->appends($dataForm)->links() }}
          @else
          {{ $vendas->links() }}
          @endif
        </div>
      </div>
    </div>
    <meta name="csrf-token" content="{{ csrf_token() }}">
  </div>
</div>
@include('sistema.pdv.vendas.auxiliares.resumo')
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


function deletarVenda( id )
{
  confirmar = confirm('Deseja realmente excluir a comanda '+id+'?')

  if (confirmar)
  {
    var url = "{{ route('pdv.vendas.destroy', ':id') }}";
    var url = url.replace(':id', id);

    // axios.delete('api/users', {params: {'id': this.checkedNames})
    axios.delete(url, {
      _token : $('meta[name="csrf-token"]').attr('content'),
      id : id,
    })
    .then( function(response)
    {
      location.reload()
      console.log(response)
      // toastrjs(response.data.typ, response.data.msg)
    })
@include('includes.catch', [ 'codigo_erro' => '3370064a' ] )
  }
}
  // function listar()
  // {
  //   $.ajax(
  //   {
  //     type: 'get',
  {{-- //     url: "{{ route('pdv.vendas.list') }}", --}}
  //     beforeSend: function(response)
  //     {
  //       $('.overlay').show();
  //     },
  //     success: function(response)
  //     {
  //       $('#venda-list').empty().html(response);
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

  // $('#venda-list').on('click', 'input[type="checkbox"]', function()
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
