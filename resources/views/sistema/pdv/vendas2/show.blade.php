@extends('layouts.app')

@section('content')
  <div class="row">
    <div class="col-12">
      <div class="card card-solid" id="div_imprimir">
        <div class="card-header with-border">
          <div class="row">
            <div class="col-12">
              <table width="100%">
                <tr>
                  <td rowspan="4" class="text-center" id="col_logo" width="75"><img src="{{ asset('img/atendimentos/pessoas/0.png') }}" alt="Espaço Milady" width="75" style="margin-right: 50px;"></td>
                  <td><strong>{{ $empresa->nome }}</strong></td>
                  <td width="26%" rowspan="4" class="text-center" style="vertical-align: top;">
                    <h4 class="text-left"><strong><font>Recibo de Comanda</font></strong></h4>
                  &emsp;
                  </td>
                  <td><strong>ID Comanda: &nbsp;</strong>{{ $venda->id }}</td>
                </tr>
                <tr>
                  <td><strong>CNPJ: &nbsp;</strong>{{ $empresa->cnpj }}</td>
                  <td><strong>ID Caixa: &nbsp;</strong><a href="{{ route('pdv.caixas.mostrar', $venda->id_caixa) }}" class="badge bg-pink">{{ $venda->id_caixa }}</a></td>
                </tr>
                <tr>
                  <td><strong>Telefone: &nbsp;</strong>{{ $empresa->telefone_fixo }}</td>
                  <td><strong>Data Compra: &nbsp;</strong>{{ Carbon\Carbon::parse($venda->created_at)->format('d/m/Y H:i') }}</td>
                </tr>
                <tr>
                  <td><strong>e-Mail: &nbsp;</strong>{{ $empresa->email }}</td>
                  @if( $venda->id_vendedor )
                    <td><strong>Vendedor: &nbsp;</strong>{{ $venda->AtdPessoasVendedores->apelido }}</td>
                  @endif
                </tr>
              </table>
            </div>
          </div>
        </div>

        <div class="card-body">
          <div class="row">
            <div class="col-12 form-group ">
              <h5 style="border-bottom: 1px solid lightgray; margin: 0px;">Dados do Cliente</h5>
              <table width="100%">
                <tr>
                  @if (isset($venda->id_cliente))
                    <td style="width:1%; white-space:nowrap;"><strong>ID Cliente: </strong><a href="{{ route('pessoa.show', $venda->id_cliente ) }}" class="badge bg-pink">{{ $venda->id_cliente }}</a>&emsp;</td>
                  @endif
                  <td><strong>Nome: </strong>{{ $venda->lufqzahwwexkxli->nome ?? 'Cliente não cadastrado' }}</td>
                  @if (isset($venda->lufqzahwwexkxli->cpf_cnpj))
                    <td class="text-right"><strong>CPF: </strong>{{ $venda->lufqzahwwexkxli->cpf_cnpj }}</td>
                  @endif
                </tr>
              </table>
              @if ( $venda->Pessoas and $venda->lufqzahwwexkxli->Enderecos->where('principal', 1)->first() )
                <table width="100%">
                  <tr>
                    <td><strong>Endereço: </strong>{{ $venda->lufqzahwwexkxli->Enderecos->where('principal', 1)->first()->logradouro ?? '' }}</td>
                    <td><strong>Nº: </strong>{{ $venda->lufqzahwwexkxli->Enderecos->where('principal', 1)->first()->numero ?? '' }}</td>
                    @if( $venda->lufqzahwwexkxli->Enderecos->where('principal', 1)->first()->complemento != '' )
                      <td><strong>Comp.: </strong>{{ $venda->lufqzahwwexkxli->Enderecos->where('principal', 1)->first()->complemento ?? '' }}</td>
                    @endif
                    <td><strong>Bairro: </strong>{{ $venda->lufqzahwwexkxli->Enderecos->where('principal', 1)->first()->bairro ?? '' }}</td>
                    <td><strong>Cidade: </strong>{{ $venda->lufqzahwwexkxli->Enderecos->where('principal', 1)->first()->cidade ?? '' }}</td>
                    <td><strong>UF: </strong>{{ $venda->lufqzahwwexkxli->Enderecos->where('principal', 1)->first()->uf ?? '' }}</td>
                    <td class="text-right"><strong>CEP: </strong>{{ $venda->lufqzahwwexkxli->Enderecos->where('principal', 1)->first()->cep ?? '' }}</td>
                  </tr>
                </table>
              @endif
            </div>
          </div>


          <div class="row">
            <div class="col-12 form-group ">
              <h5 style="border-bottom: 1px solid lightgray; margin: 0px;">Itens Vendidos</h5>
              <table class="table-striped" width="100%">
                <tr>
                  <th class="text-left">Cód.</th>
                  <th class="text-left">Descrição</th>
                  <th class="text-left">Profissional</th>
                  <th class="text-right">Total</th>
                </tr>
                @forelse($venda->dfyejmfcrkolqjh as $produto)
                  <tr>
                    <td class="text-left">{{ $produto->id_servprod }}</td>
                    <td class="text-left">{{ $produto->kcvkongmlqeklsl->nome ?? 'ERROOOOIU' }}</td>
                    <td class="text-left">{{ $produto->hgihnjekboyabez->xeypqgkmimzvknq->apelido ?? $produto->hgihnjekboyabez->id_pessoa ?? $produto->id }}</td>
                    <td class="text-right">{{ number_format($produto->vlr_final, 2, ',', '.') }}</td>
                  </tr>
                  @empty
                  <tr>
                    <td class="text-center" colspan="5">Não foram registrados produtos nesta venda</td>
                  </tr>
                @endforelse
                @if (count($venda->dfyejmfcrkolqjh))
                  <tr>
                    <td class="text-left"><strong>Itens: {{ $venda->dfyejmfcrkolqjh->count() }}</strong></td>
                    <td class="text-left"></td>
                    <td class="text-left"></td>
                    <td class="text-right"><strong>{{ number_format($venda->dfyejmfcrkolqjh->sum('vlr_final'), 2, ',', '.') }}</td></strong>
                  </tr>
                @endif
              </table>
            </div>
          </div>

          <div class="row">
            <div class="col-12 form-group ">
              <h5 style="border-bottom: 1px solid lightgray; margin: 0px;">Dados do Pagamento</h5>
              <table class="table-striped" width="100%">
                @forelse($venda->xzxfrjmgwpgsnta as $pagamento)
                  <tr>
                    <td class="text-left"><strong>Forma: </strong>{{ $pagamento->qmbnkthuczqdsdn->forma }} {{ $pagamento->qmbnkthuczqdsdn->bandeira == $pagamento->qmbnkthuczqdsdn->forma ? '' : ' - '.$pagamento->qmbnkthuczqdsdn->bandeira }} {{ $pagamento->qmbnkthuczqdsdn->parcela > 1 ? '('.$pagamento->qmbnkthuczqdsdn->parcela.'x)' : '' }}</td>
                    <td class="text-center"><strong>Parcela: </strong>{{ $pagamento->parcela }}</td>
                    <td class="text-center"><strong>Data prevista: </strong>{{ \Carbon\Carbon::parse($pagamento->dt_prevista)->format('d/m/Y') }}</td>
                    <td class="text-right"><strong>Valor: </strong>{{ number_format($pagamento->valor, 2, ',', '.') }}</td>
                  </tr>
                  @empty
                  <tr>
                    <td class="text-center" colspan="5">Não foram registrados produtos nesta venda</td>
                  </tr>
                @endforelse
                @if (count($venda->dfyejmfcrkolqjh))
                  <tr>
                    <td></td>
                    <td></td>
                    <td></td>
                    <td class="text-right"><strong>Total: {{ number_format($venda->xzxfrjmgwpgsnta->sum('valor'), 2, ',', '.') }}</td></strong>
                  </tr>
                @endif
              </table>
              <div style="border-bottom: 1px solid lightgray; margin: 0px;">
                &nbsp;
              </div>
            </div>
          </div>
        </div>
        <div class="card-footer">
          <a class="btn btn-default" href="{{ URL::previous() }}">Voltar</a>
          <a class="btn btn-info" onclick="print()">Imprimir</a>
        </div>
      </div>
    </div>
  </div>
@stop

@section('css')
<style type="text/css">
@media print
{
  .container
  {
    max-width: none;
    margin: 0;
  }
  a[href]:after
  {
    content: none !important;
  }
  .box-footer
  {
    display: none !important;
  }
  #div_imprimir
  {
    zoom: 90%;
  }
}
</style>
@endsection
