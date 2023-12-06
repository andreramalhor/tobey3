@extends('layouts.app')

@section('content')
<div class="row">
  <div class="col-12">
    <div class="card">
      <div class="card-header">
        <h3 class="card-title">Pagination Month</h3>
      </div>
      <div class="card-body">
        <ul class="pagination justify-content-center">
          <li class="page-item"><a class="page-link" href="#">«</a></li>
          <li class="page-item">
            <a class="page-link" href="#">2021</a>
          </li>
          <li class="page-item active">
            <a class="page-link" href="#">2022</a>
          </li>
          <li class="page-item">
            <a class="page-link" href="#">2023</a>
          </li>
          <li class="page-item"><a class="page-link" href="#">»</a></li>
        </ul>
      </div>
    </div>
  </div>
</div>
<div class="row">
  <div class="col-md-12">
    <div class="card">
{{-- 
      <div class="overlay">
        <i class="fas fa-2x fa-sync-alt fa-spin"></i>
      </div>
      --}}
      <div class="card-header">
        <h3 class="card-title">Faturamento Contratos</h3>

        <div class="card-tools">
          <div class="btn-group">
            {{-- <a class="btn btn-sm btn-default" href="{{ route('purcharses.provider') }}" ><i class="fas fa-plus"></i></a> --}}
            <a class="btn btn-sm btn-default" data-bs-toggle="modal" data-bs-target="#modal_pesquisa" id="modal_pesquisa_modalzim"><i class="fas fa-filter"></i></a>
          </div>
        </div>
        @include('sistema.financeiro.compras.modal.pesquisa')
      </div>
      <div class="card-body table-responsive p-0">
        <table class="table table-sm table-striped table-head-fixed text-nowrap no-padding" id="compra-list">
          <thead>
            <tr>
              <th class="text-Center">#</th>
              <th class="text-left">Cliente</th>
              <th class="text-right">Janeiro</th>
              <th class="text-right">Fevereiro</th>
              <th class="text-right">Março</th>
              <th class="text-right">Abril</th>
              <th class="text-right">Maio</th>
              <th class="text-right">Junho</th>
              <th class="text-right">Julho</th>
              <th class="text-right">Agosto</th>
              <th class="text-right">Setembro</th>
              <th class="text-right">Outubro</th>
              <th class="text-right">Novembro</th>
              <th class="text-right">Dezembro</th>
              <th class="text-right">Total</th>
            </tr>
          </thead>
          <tbody>
            @php $total_ano = 0; @endphp
            @forelse($dados as $id_cliente => $cliente)
            @php
            $total_mes = 0;
            $total_mes = isset($cliente['01']) ? $total_mes + $cliente['01']->sum('vlr_final') : $total_mes + 0;
            $total_mes = isset($cliente['02']) ? $total_mes + $cliente['02']->sum('vlr_final') : $total_mes + 0; 
            $total_mes = isset($cliente['03']) ? $total_mes + $cliente['03']->sum('vlr_final') : $total_mes + 0; 
            $total_mes = isset($cliente['04']) ? $total_mes + $cliente['04']->sum('vlr_final') : $total_mes + 0; 
            $total_mes = isset($cliente['05']) ? $total_mes + $cliente['05']->sum('vlr_final') : $total_mes + 0; 
            $total_mes = isset($cliente['06']) ? $total_mes + $cliente['06']->sum('vlr_final') : $total_mes + 0; 
            $total_mes = isset($cliente['07']) ? $total_mes + $cliente['07']->sum('vlr_final') : $total_mes + 0; 
            $total_mes = isset($cliente['08']) ? $total_mes + $cliente['08']->sum('vlr_final') : $total_mes + 0; 
            $total_mes = isset($cliente['09']) ? $total_mes + $cliente['09']->sum('vlr_final') : $total_mes + 0; 
            $total_mes = isset($cliente['10']) ? $total_mes + $cliente['10']->sum('vlr_final') : $total_mes + 0; 
            $total_mes = isset($cliente['11']) ? $total_mes + $cliente['11']->sum('vlr_final') : $total_mes + 0; 
            $total_mes = isset($cliente['12']) ? $total_mes + $cliente['12']->sum('vlr_final') : $total_mes + 0; 
            $total_ano = $total_ano + $total_mes; 
            @endphp
            <tr>
              <td class="text-left">{{ $cliente->first()->id_cliente ?? '*' }}</td>
              <td class="text-left">{{ $cliente->first()->qexgzmnndqxmyks->apelido ?? '*' }}</td>

              @include('sistema.financeiro.contratos.auxiliares.inc_cor_vencimento')
              {{-- <td class="text-right">{{ isset($cliente['01']) ? number_format($cliente['01']->sum('vlr_final'), 2, ',', '.') : '-' }}</td> --}}
              {{-- <td class="text-right">{{ isset($cliente['02']) ? number_format($cliente['02']->sum('vlr_final'), 2, ',', '.') : '-' }}</td> --}}
              {{-- <td class="text-right">{{ isset($cliente['03']) ? number_format($cliente['03']->sum('vlr_final'), 2, ',', '.') : '-' }}</td> --}}
              {{-- <td class="text-right">{{ isset($cliente['04']) ? number_format($cliente['04']->sum('vlr_final'), 2, ',', '.') : '-' }}</td> --}}
              {{-- <td class="text-right">{{ isset($cliente['05']) ? number_format($cliente['05']->sum('vlr_final'), 2, ',', '.') : '-' }}</td> --}}
              {{-- <td class="text-right">{{ isset($cliente['06']) ? number_format($cliente['06']->sum('vlr_final'), 2, ',', '.') : '-' }}</td> --}}
              {{-- <td class="text-right">{{ isset($cliente['07']) ? number_format($cliente['07']->sum('vlr_final'), 2, ',', '.') : '-' }}</td> --}}
              {{-- <td class="text-right">{{ isset($cliente['08']) ? number_format($cliente['08']->sum('vlr_final'), 2, ',', '.') : '-' }}</td> --}}
              {{-- <td class="text-right">{{ isset($cliente['09']) ? number_format($cliente['09']->sum('vlr_final'), 2, ',', '.') : '-' }}</td> --}}
              {{-- <td class="text-right">{{ isset($cliente['10']) ? number_format($cliente['10']->sum('vlr_final'), 2, ',', '.') : '-' }}</td> --}}
              {{-- <td class="text-right">{{ isset($cliente['11']) ? number_format($cliente['11']->sum('vlr_final'), 2, ',', '.') : '-' }}</td> --}}
              {{-- <td class="text-right">{{ isset($cliente['12']) ? number_format($cliente['12']->sum('vlr_final'), 2, ',', '.') : '-' }}</td> --}}
              <td class="text-right"><strong>{{ number_format($total_mes, 2, ',', '.') }}</strong></td>
            </tr>
            @empty
            <tr>
              <td class="text-center" colspan="8">Ainda não há compras cadastradas.</td>
            </tr>
            @endforelse
          </tbody>
          <tfoot>
            <tr>
              <th class="text-left"></th>
              <th class="text-left"></th>
              <th class="text-right">{{ isset($totais['01']) ? number_format($totais['01']->sum('vlr_final'), 2, ',', '.') : '-' }}</th>
              <th class="text-right">{{ isset($totais['02']) ? number_format($totais['02']->sum('vlr_final'), 2, ',', '.') : '-' }}</th>
              <th class="text-right">{{ isset($totais['03']) ? number_format($totais['03']->sum('vlr_final'), 2, ',', '.') : '-' }}</th>
              <th class="text-right">{{ isset($totais['04']) ? number_format($totais['04']->sum('vlr_final'), 2, ',', '.') : '-' }}</th>
              <th class="text-right">{{ isset($totais['05']) ? number_format($totais['05']->sum('vlr_final'), 2, ',', '.') : '-' }}</th>
              <th class="text-right">{{ isset($totais['06']) ? number_format($totais['06']->sum('vlr_final'), 2, ',', '.') : '-' }}</th>
              <th class="text-right">{{ isset($totais['07']) ? number_format($totais['07']->sum('vlr_final'), 2, ',', '.') : '-' }}</th>
              <th class="text-right">{{ isset($totais['08']) ? number_format($totais['08']->sum('vlr_final'), 2, ',', '.') : '-' }}</th>
              <th class="text-right">{{ isset($totais['09']) ? number_format($totais['09']->sum('vlr_final'), 2, ',', '.') : '-' }}</th>
              <th class="text-right">{{ isset($totais['10']) ? number_format($totais['10']->sum('vlr_final'), 2, ',', '.') : '-' }}</th>
              <th class="text-right">{{ isset($totais['11']) ? number_format($totais['11']->sum('vlr_final'), 2, ',', '.') : '-' }}</th>
              <th class="text-right">{{ isset($totais['12']) ? number_format($totais['12']->sum('vlr_final'), 2, ',', '.') : '-' }}</th>
              <td class="text-center"><strong>{{ number_format($total_ano, 2, ',', '.') }}</strong></td>
            </tr>
          </tfoot>
        </table>
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
  {{-- //     url: "{{ route('compra.list') }}", --}}
  //     beforeSend: function(response)
  //     {
  //       $('.overlay').show();
  //     },
  //     success: function(response)
  //     {
  //       $('#compra-list').empty().html(response);
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

  // $('#compra-list').on('click', 'input[type="checkbox"]', function()
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
