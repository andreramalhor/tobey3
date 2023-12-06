@extends('layouts.app')

@section('content')
<div class='row' id="div_imprimir">
  <div class="col-12 col-sm-12 col-md-3 col-lg-3 col-xl-3">
    <div class='card card-{{ $caixa->cor_status ?? "default" }}'>
      <div class='card-header'>
        <h3 class='card-title'>Caixa</h3>
        <div class="card-tools">
          <div class="btn-toolbar">
            <div class="btn-group">
              <a class="btn btn-sm btn-default" href="{{ route('pdv.caixas.imprimir', $caixa->id ?? '0') }}" target="_blank" style="color: black;"><i class="fas fa-print"></i></a>
            </div>
            @include('sistema.financeiro.lancamentos.auxiliares.mod_filtro')
          </div>
        </div>
      </div>
      <div class='card-body box-profile pt-1'>
        <h3 class='profile-username text-center'>{{ $caixa->rybeyykhpcgwkgr->nome ?? 'ERRO INDEX CAIXA 1' }}    -    # {{ $caixa->id ?? '0' }}</h3>
        <p class='text-muted text-center'><span class='badge bg-{{ $caixa->cor_status ?? "" }}'>{{ $caixa->status ?? "" }}</span></p>
        <ul class='list-group list-group-unbordered mb-3'>
          <li class='list-group-item'>
            <b>Usuário:</b> <a class='float-right'>{{ isset($caixa->kpakdkhqowIqzik) && $caixa->kpakdkhqowIqzik->count() > 0 ? optional($caixa->kpakdkhqowIqzik)->apelido :  'apelido' }}</a>
          </li>
          <li class='list-group-item'>
            <b>Data do Caixa:</b> <a class='float-right'>{{ Carbon\Carbon::parse($caixa->dt_abertura ?? Carbon::now() )->format('d/m/Y H:i') }}</a>
          </li>
          @if(isset($caixa->status) && $caixa->status == 'Fechado')
          <li class='list-group-item'>
            <b>Fechado em:</b> <a class='float-right'>{{ Carbon\Carbon::parse($caixa->dt_fechamento ?? Carbon::now() )->format('d/m/Y H:i') }}</a>
          </li>
          @endif
          @if(isset($caixa->status) && $caixa->status == 'Validado')
          <li class='list-group-item' style='padding-bottom: 0px'>
            <b>Validado em:</b> <a class='float-right'>{{ Carbon\Carbon::parse($caixa->dt_validacao ?? Carbon::now() )->format('d/m/Y H:i') }}</a>
            <p class='text-muted text-right' style='margin-bottom: 0px'>Por: {{ $caixa->leichtmaeskrpdf->apelido ?? 'ERRO SHOW CAIXA 1' }}</p>
          </li>
          @endif
          <li class='list-group-item'>
            <b>Aberto com:</b> <a class='float-right'>R$ {{ number_format($caixa->vlr_abertura ?? 0, 2, ',', '.') }}</a>
          </li>
          <li class='list-group-item'>
            @if(isset($caixa->status) && $caixa->status == 'Fechado')
            <b>Fechado com:</b> <a class='float-right'>R$ {{ number_format($caixa->vlr_fechamento ?? 0, 2, ',', '.') }}</a>
            @else
            <b>Saldo Atual:</b> <a class='float-right'>R$ {{ number_format($caixa->saldo_atual ?? 0, 2, ',', '.') }}</a>
            @endif
          </li>
          @if( isset($caixa->vlr_fechamento) )
            @if( ($caixa->vlr_fechamento - $caixa->saldo_atual) >= 0.01 || ($caixa->vlr_fechamento - $caixa->saldo_atual) <= -0.01 && $caixa->status != 'Aberto' )
              <li class='list-group-item'>
                <b>Diferença:</b>
                @if( ($caixa->vlr_fechamento - $caixa->saldo_atual ) > 0 )
                <span class='badge bg-success'>Sobrando dinheiro no caixa</span>
                @else
                <span class='badge bg-danger'>Faltando dinheiro no caixa</span>
                @endif
                <a class='float-right'>R$ {{ number_format($caixa->vlr_fechamento - $caixa->saldo_atual, 2, ',', '.') }}</a>
              </li>
              @endif
            @endif
        </ul>
      </div>
      @if(isset($caixa->status) && $caixa->status == 'Aberto')
      <div class='card-footer'>
        <a href='{{ route("pdv.caixas.fechar", $caixa->id ) }}' class='btn btn-primary btn-sm float-right'>Fechar</a>
      </div>
      @elseif(isset($caixa->status) && $caixa->status == 'Fechado')
      <div class='card-footer'>
        <div class="row">
          <div class="col-6">
            <a href='{{ route("pdv.caixas.reabrir", $caixa->id ) }}' class='btn btn-block btn-warning btn-sm'>Reabrir</a>
          </div>
          <div class="col-6">
            <a href='{{ route("pdv.caixas.confirmar", $caixa->id ) }}' class='btn btn-block btn-success btn-sm'>Validar</a>
          </div>
        </div>
      </div>
      @elseif(isset($caixa->status) && $caixa->status == 'Validado')
      <div class='card-footer'>
        <a href='#' class='btn btn-info btn-sm float-right'>Imprimir</a>
      </div>
      @endif
    </div>
  </div>
  
  <div class="col-12 col-sm-12 col-md-9 col-lg-9 col-xl-9">
    <div class="row">
      <div class="col-12 col-sm-12 col-md-6 col-lg-6 col-xl-6">
        <div class='card card-primary'>
          <div class='card-header'>
            <h3 class='card-title'>Saídas</h3>
            <div class="card-tools">
              <div class="btn-toolbar">
                <div class="btn-group">
                  <a href="#" onclick="lancamentos_direcionar('despesa_geral')" class="btn btn-sm btn-danger"><i class="fas fa-plus"></i></a>
                </div>
              </div>
            </div>
          </div>
          <div class='card-body p-0'>
            <table class='table table-sm table-hover no-padding table-valign-middle projects'>
              <thead class='table-dark'>
                <tr>
                  <th class='text-left'>#</th>
                  <th class='text-left'>Pessoa > Descricao</th>
                  <th class='text-right'>Valor</th>
                  <th class='text-right'></th>
                </tr>
              </thead>
              <tbody>
                @if(isset($caixa->wskcngeadbjhpdu) && $caixa->wskcngeadbjhpdu->count() > 0)
                  @forelse($caixa->wskcngeadbjhpdu->where('tipo', '=', 'D')->sortBy('id') as $saida)
                  <tr>
                    <td class='text-left'>{{ $saida->id }}</td>
                    <td class='text-left'>
                    @if( isset($saida->id_cliente) )
                      {{ $saida->qexgzmnndqxmyks->apelido ?? $saida->id_cliente }} - {{ $saida->descricao }}
                    @else
                      {{ $saida->descricao }}
                    @endif
                    </td>
                    <td class='text-right'>{{ number_format( $saida->vlr_final, 2, ',', '.') }}</td>
                    <td class='text-center'><a href="{{ route('fin.lancamentos.mostrar', $saida->id) }}" target="_blank" class="text-muted" data-bs-tooltip="tooltip" data-bs-title="Visualizar" data-original-title="Visualizar"><i class="fa-solid fa-eye"></i></a>&nbsp;&nbsp;</td>
                  </tr>
                  @empty
                  <tr>
                    <td class='text-center' colspan='4'>Não há registros.</td>
                  </tr>
                  @endforelse
                @endif
              </tbody>
              <tfoot>
                @if(isset($caixa->wskcngeadbjhpdu) && $caixa->wskcngeadbjhpdu->count() > 0)
                <tr>
                  <th class='text-right' colspan='3'>{{ number_format( $caixa->wskcngeadbjhpdu->where('tipo', '=', 'D')->sum('vlr_final'), 2, ',', '.') }}</th>
                  <th></th>
                </tr>
                @endif
                </tfoot>
              </table>
          </div>
        </div>
      </div>
      
      <div class="col-12 col-sm-12 col-md-6 col-lg-6 col-xl-6">
        <div class='card card-primary'>
          <div class='card-header'>
            <h3 class='card-title'>Entradas</h3>
            <div class="card-tools">
              <div class="btn-toolbar">
                <div class="btn-group">
                  <a href="#" onclick="lancamentos_direcionar('receita_geral')" class="btn btn-sm btn-success"><i class="fas fa-plus"></i></a>
                </div>
              </div>
            </div>
          </div>
          <div class='card-body p-0'>
            <table class='table table-sm table-hover no-padding table-valign-middle projects'>
              <thead class='table-dark'>
                <tr>
                  <th class='text-left'>#</th>
                  <th class='text-left'>Pessoa > Descricao</th>
                  <th class='text-right'>Valor</th>
                  <th class='text-right'></th>
                </tr>
              </thead>
              <tbody>
                @if(isset($caixa->wskcngeadbjhpdu) && $caixa->wskcngeadbjhpdu->count() > 0)
                  @forelse($caixa->wskcngeadbjhpdu->where('tipo', '=', 'R')->sortBy('id') as $entrada)
                  <tr>
                    <td class='text-left'>{{ $entrada->id }}</td>
                    <td class='text-left'>
                    @if( isset($entrada->id_cliente) )
                      {{ $entrada->qexgzmnndqxmyks->apelido ?? $entrada->id_cliente }} - {{ $entrada->descricao }}
                      @else
                      {{ $entrada->descricao }}
                      @endif
                    </td>
                    <td class='text-right'>{{ number_format( $entrada->vlr_final, 2, ',', '.') }}</td>
                    <td class='text-center'><a href="{{ route('fin.lancamentos.mostrar', $entrada->id) }}" target="_blank" class="text-muted" data-bs-tooltip="tooltip" data-bs-title="Visualizar" data-original-title="Visualizar"><i class="fa-solid fa-eye"></i></a>&nbsp;&nbsp;</td>
                  </tr>
                  @empty
                  <tr>
                    <td class='text-center' colspan='4'>Não há registros.</td>
                  </tr>
                  @endforelse
                @endif
              </tbody>
              <tfoot>
                @if(isset($caixa->wskcngeadbjhpdu) && $caixa->wskcngeadbjhpdu->count() > 0)
                  <tr>
                    <th class='text-right' colspan='3'>{{ number_format( $caixa->wskcngeadbjhpdu->where('tipo', '=', 'R')->sum('vlr_final'), 2, ',', '.') }}</th>
                    <th></th>
                  </tr>
                @endif
              </tfoot>
            </table>
          </div>
        </div>
      </div>
    </div>
      
    <div class="row">
      <div class="col-12 col-sm-12 col-md-12 col-lg-12 col-xl-12">
        <div class='card card-primary'>
          <div class='card-header'>
            <h3 class='card-title'>Transferências</h3>
            <div class="card-tools">
              <div class="btn-toolbar">
                <div class="btn-group">
                  <a href="#" onclick="lancamentos_direcionar('transferencia')" class="btn btn-sm btn-default" style="color: black;"><i class="fas fa-plus"></i></a>
                </div>
              </div>
            </div>
          </div>
          <div class='card-body p-0'>
            <table class='table table-sm table-hover no-padding table-valign-middle projects'>
              <thead class='table-dark'>
                <tr>
                  <th class='text-left'>#</th>
                  <th class='text-left'>Pessoa > Descricao</th>
                  <th class='text-right'>Valor</th>
                </tr>
              </thead>
              <tbody>
              @if(isset($caixa->wskcngeadbjhpdu) && $caixa->wskcngeadbjhpdu->count() > 0)
                @forelse($caixa->wskcngeadbjhpdu->where('tipo', '=', 'T')->sortBy('id') as $transferencia)
                <tr>
                  <td class='text-left'>{{ $transferencia->id }}</td>
                  <td class='text-left'>
                    @if( isset($transferencia->id_cliente) )
                    {{ $transferencia->qexgzmnndqxmyks->apelido ?? $transferencia->id_cliente }} - {{ $transferencia->descricao }}
                    @else
                    {{ $transferencia->descricao }}
                    @endif
                  </td>
                  <td class='text-right'>{{ number_format( $transferencia->vlr_final, 2, ',', '.') }}</td>
                </tr>
                @empty
                <tr>
                  <td class='text-center' colspan='3'>Não há registros.</td>
                </tr>
                @endforelse
              @endif
              </tbody>
              <tfoot>
              @if(isset($caixa->wskcngeadbjhpdu) && $caixa->wskcngeadbjhpdu->count() > 0)
                <tr>
                  <th class='text-right' colspan='3'>{{ number_format( $caixa->wskcngeadbjhpdu->where('tipo', '=', 'T')->sum('vlr_final'), 2, ',', '.') }}</th>
                </tr>
              @endif
              </tfoot>
            </table>
          </div>
        </div>
      </div>
    </div>
  </div>
    
  <div class="col-12 col-sm-12 col-md-4 col-lg-4 col-xl-4">
    <div class='card card-primary'>
      <div class='card-header'>
        <h3 class='card-title'>Formas de Pagamentos</h3>
      </div>
      <div class='card-body p-0'>
        <table class='table table-sm table-hover no-padding table-valign-middle projects'>
          <thead class='table-dark'>
            <tr>
              <th class='text-left'>Descricao</th>
              <th class='text-right'>Valor</th>
            </tr>
          </thead>
          <tbody>
          @if(isset($caixa->ssqlnxsbyywplan) && $caixa->ssqlnxsbyywplan->count() > 0)
            @forelse($caixa->ssqlnxsbyywplan->sortBy('id_forma_pagamento')->groupBy('qmbnkthuczqdsdn.forma') as $forma => $pagamentos)
            <tr data-widget='expandable-table' aria-expanded='true' style='background-color: ghostwhite;' >
              <td class='text-left'><i class='expandable-table-caret fas fa-caret-right fa-fw'></i> {{ $forma }}</td>
              <td class='text-right'>{{ number_format( $pagamentos->sum('valor'), 2, ',', '.') }}</td>
            </tr>
            <tr class='expandable-body'>
              <td colspan='2'>
                <div class='p-0'>
                  <table class='table table-hover m-0' style="width: -webkit-fill-available;">
                    <tbody>
                      @foreach($pagamentos->groupBy('qmbnkthuczqdsdn.bandeira') as $bandeira => $pagamento)
                      <tr data-widget='expandable-table' aria-expanded='true'>
                        <td class='text-left' style='border-bottom-width: 0px;'>{{ $bandeira }}</td>
                        <td class='text-right' style='border-bottom-width: 0px;'>{{ number_format( $pagamento->sum('valor'), 2, ',', '.') }}</td>
                      </tr>
                      @endforeach
                    </tbody>
                  </table>
                </div>
              </td>
            </tr>
            @empty
            <tr>
              <td class='text-center' colspan='2'>Não há pagamentos registrados.</td>
            </tr>
            @endforelse
          @endif
          </tbody>
          <tfoot>
          @if(isset($caixa->ssqlnxsbyywplan) && $caixa->ssqlnxsbyywplan->count() > 0)
            <tr>
              <th class='text-right' colspan='2'>{{ number_format( $caixa->ssqlnxsbyywplan->sum('valor'), 2, ',', '.') }}</th>
            </tr>
          @endif
          </tfoot>
        </table>
      </div>
    </div>
  </div>
  
  
  
  
  
  <div class="col-12 col-sm-12 col-md-8 col-lg-8 col-xl-8">
    <div class='card card-primary'>
      <div class='card-header'>
        <h3 class='card-title'>Vendas</h3>
      </div>
      <div class='card-body p-0'>
        <table class='table table-sm table-hover no-padding table-valign-middle projects'>
          <thead class='table-dark'>
            <tr>
              <th width="10%" class='text-left'>#</th>
              <th width="" colspan='2' class='text-left'>Clientes  Produtos</th>
              <th width="5%" class='text-center'>Qtd</th>
              <th width="10%" class='text-right'>Vlr Prod/Serv.</th>
              <th width="10%" class='text-right'>Vlr. Negoc.</th>
              <th width="10%" class='text-right'>Dsc/Acr</th>
              <th width="10%" class='text-right'>Vlr. Final</th>
            </tr>
          </thead>
          <tbody>
          @if(isset($caixa->rtafathibgwfust) && $caixa->rtafathibgwfust->count() > 0)
            @forelse($caixa->rtafathibgwfust->sortBy('id') as $key => $venda)
            <tr data-widget='expandable-table' aria-expanded='false' style='background-color: ghostwhite;' >
              <td width="10%" class='text-left'><i class='expandable-table-caret fas fa-caret-right fa-fw'></i><a href="" data-bs-toggle="modal" onclick="vendas_mostrar_modal({{ $venda->id }})"><span class="badge bg-pink">{{ $venda->id }}</span></td>
              <td width="" class='text-left' colspan='2'>{{ $venda->lufqzahwwexkxli->apelido ?? '(Cliente sem cadastro)' }}</td>
              <td width="5%" class='text-center'>{{ $venda->qtd_produtos }}</td>
              <td width="10%" class='text-right'>{{ number_format( $venda->vlr_prod_serv, 2, ',', '.') }}</td>
              <td width="10%" class='text-right'>{{ number_format( $venda->vlr_negociado, 2, ',', '.') }}</td>
              <td width="10%" class='text-right'>{{ number_format( $venda->vlr_dsc_acr, 2, ',', '.') }}</td>
              <td width="10%" class='text-right'>{{ number_format( $venda->vlr_final, 2, ',', '.') }}</td>
            </tr>
            <tr class='expandable-body'>
              <td colspan='8'>
                <div class='p-0'>
                  <table class='table table-hover m-0' style="width: -webkit-fill-available;">
                    <tbody>
                      @foreach($venda->dfyejmfcrkolqjh as $venda_detalhe)
                      <tr data-widget='expandable-table'>
                        <td width="" class='text-left' colspan="2" style='border-bottom-width: 0px;'>{{ $venda_detalhe->kcvkongmlqeklsl->nome ?? $venda_detalhe->id_servprod }}</td>
                        <td width="5%" class='text-center' style='border-bottom-width: 0px;'>{{ $venda_detalhe->quantidade }}</td>
                        <td width="10%" class='text-right' style='border-bottom-width: 0px;'>{{ number_format( $venda_detalhe->vlr_venda, 2, ',', '.') }}</td>
                        <td width="10%" class='text-right' style='border-bottom-width: 0px;'>{{ number_format( $venda_detalhe->vlr_negociado, 2, ',', '.') }}</td>
                        <td width="10%" class='text-right' style='border-bottom-width: 0px;'>{{ number_format( $venda_detalhe->vlr_dsc_acr, 2, ',', '.') }}</td>
                        <td width="10%" class='text-right' style='border-bottom-width: 0px;'>{{ number_format( $venda_detalhe->vlr_final, 2, ',', '.') }}</td>
                      </tr>
                      @endforeach
                    </tbody>
                  </table>
                </div>
              </td>
            </tr>
            @empty
            <tr>
              <td class='text-center' colspan='6'>Não há pagamentos registrados.</td>
            </tr>
            @endforelse
          @endif
          </tbody>
          <tfoot>
          @if(isset($caixa->rtafathibgwfust) && $caixa->rtafathibgwfust->count() > 0)
            <tr>
              <th class='text-right' colspan='6'>{{ number_format( $caixa->rtafathibgwfust->sum('vlr_final'), 2, ',', '.') }}</th>
            </tr>
          @endif
          </tfoot>
        </table>
      </div>
    </div>
  </div>
</div>
@include('includes.modal.modal-geral-1')
@endsection

@section('js')
<script type="text/javascript">
$(window).on('shown.bs.modal', function()
{
  $('.select2').select2({
    dropdownParent: $('#modal-geral-1'),
  });
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
  @include('includes.catch', [ 'codigo_erro' => '9374946a' ] )
  .then( function()
  {
    $('#modal-geral-1').modal('show')
  })
}
</script>
@endsection
