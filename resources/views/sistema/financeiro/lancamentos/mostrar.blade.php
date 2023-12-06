@extends('layouts.app')

@section('content')
<div class="book">
  <div class="page">
    <div class="subpage">
      <div class="invoice p-3 mb-3">
     
        <div class="row">
          <div class="col-xs-12">
            <div class="box box-solid" id="div_imprimir">
              <div class="box-header with-border">
                <div class="row">
                  <div class="col-xs-12">
                    <table width="100%">
                      <tr>
                        <td rowspan="4" class="text-center" id="col_logo" width="75"><img src="{{ asset('img/company/favicon.png') }}" alt="IE Caratinga" width="75"></td>
                        <td><strong>{{ $empresa->nome ?? 'Nome da Empresa' }}</strong></td>
                        <td width="26%" rowspan="4" class="text-center" style="vertical-align: top;">
                          <h4 class="text-left"><strong><font>Recibo - R$ {{ number_format($dado->vlr_final, 2, ',', '.') }}</font></strong></h4>
                          &emsp;
                        </td>
                        <td><strong>ID Lançamento: &nbsp;</strong>{{ $dado->id }}</td>
                      </tr>
                      <tr>
                        <td><strong>CNPJ: &nbsp;</strong>{{ $empresa->cnpj ?? 'Nome da Empresa' }}</td>
                        @if (isset($dado->id_caixa))
                        <td><strong>ID Caixa: &nbsp;</strong><a href="{{ route('pdv.caixas.mostrar', $dado->id_caixa) }}">{{ $dado->id_caixa }}</a></td>
                        @endif
                      </tr>
                      <tr>
                        <td><strong>Telefone: &nbsp;</strong>{{ $empresa->nome ?? 'Nome da Empresa' }}</td>
                        <td><strong>Data do Lançamento: &nbsp;</strong>{{ \Carbon\Carbon::parse($dado->created_at)->format('d/m/Y H:i') }}</td>
                      </tr>
                      <tr>
                        <td><strong>e-Mail: &nbsp;</strong>{{ $empresa->email ?? 'mg.caratinga@institutoembelleze.com' }}</td>
                        @if( $dado->id_vendedor )
                        <td><strong>Vendedor: &nbsp;</strong>{{ $dado->Vendedores->apelido }}</td>
                        @endif
                      </tr>
                    </table>
                  </div>
                </div>
              </div>
              @php
              function valorPorExtenso( $valor = 0, $bolExibirMoeda = true, $bolPalavraFeminina = false )
              { 
                $singular = null;
                $plural   = null;
                
                if($bolExibirMoeda)
                {
                  $singular = array("centavo", "real", "mil", "milhão", "bilhão", "trilhão", "quatrilhão");
                  $plural   = array("centavos", "reais", "mil", "milhões", "bilhões", "trilhões","quatrilhões");
                }
                else
                {
                  $singular = array("", "", "mil", "milhão", "bilhão", "trilhão", "quatrilhão");
                  $plural   = array("", "", "mil", "milhões", "bilhões", "trilhões","quatrilhões");
                }
                
                $c    = array("", "cem", "duzentos", "trezentos", "quatrocentos","quinhentos", "seiscentos", "setecentos", "oitocentos", "novecentos");
                $d    = array("", "dez", "vinte", "trinta", "quarenta", "cinquenta","sessenta", "setenta", "oitenta", "noventa");
                $d10  = array("dez", "onze", "doze", "treze", "quatorze", "quinze","dezesseis", "dezessete", "dezoito", "dezenove");
                $u    = array("", "um", "dois", "três", "quatro", "cinco", "seis","sete", "oito", "nove");
                
                if($bolPalavraFeminina)
                {
                  if($valor == 1) 
                  {
                    $u = array("", "uma", "duas", "três", "quatro", "cinco", "seis","sete", "oito", "nove");
                  }
                  else 
                  {
                    $u = array("", "um", "duas", "três", "quatro", "cinco", "seis","sete", "oito", "nove");
                  }
                  
                  $c = array("", "cem", "duzentas", "trezentas", "quatrocentas","quinhentas", "seiscentas", "setecentas", "oitocentas", "novecentas");
                }
                
                $z = 0;
                
                $valor    = number_format( $valor, 2, ".", "." );
                $inteiro  = explode( ".", $valor );
                
                for($i = 0; $i < count( $inteiro ); $i++)
                {
                  for($ii = mb_strlen( $inteiro[$i] ); $ii < 3; $ii++ ) 
                  {
                    $inteiro[$i] = "0" . $inteiro[$i];
                  }
                }
                
                // $fim identifica onde que deve se dar junção de centenas por "e" ou por "," ;)
                $rt   = null;
                $fim  = count( $inteiro ) - ($inteiro[count( $inteiro ) - 1] > 0 ? 1 : 2);
                for( $i = 0; $i < count( $inteiro ); $i++ )
                {
                  $valor  = $inteiro[$i];
                  $rc     = (($valor > 100) && ($valor < 200)) ? "cento" : $c[$valor[0]];
                  $rd     = ($valor[1] < 2) ? "" : $d[$valor[1]];
                  $ru     = ($valor > 0) ? (($valor[1] == 1) ? $d10[$valor[2]] : $u[$valor[2]]) : "";
                  
                  $r      = $rc . (($rc && ($rd || $ru)) ? " e " : "") . $rd . (($rd && $ru) ? " e " : "") . $ru;
                  $t      = count( $inteiro ) - 1 - $i;
                  $r     .= $r ? " " . ($valor > 1 ? $plural[$t] : $singular[$t]) : "";
                  if( $valor == "000")
                  {
                    $z++;
                  }
                  elseif( $z > 0 )
                  {
                    $z--;
                  }
                  
                  if( ($t == 1) && ($z > 0) && ($inteiro[0] > 0) )
                  {
                    $r .= ( ($z > 1) ? " de " : "") . $plural[$t];
                  }
                  
                  if( $r )
                  {
                    $rt = $rt . ((($i > 0) && ($i <= $fim) && ($inteiro[0] > 0) && ($z < 1)) ? ( ($i < $fim) ? ", " : " e ") : " ") . $r;
                  }
                }
                
                $rt = mb_substr( $rt, 1 );
                
                return($rt ? trim( $rt ) : "zero");
              }
              @endphp
              <div class="box-body">
                <div class="row">
                  <div class="col-xs-12">
                    <br>
                    @if ($dado->tipo == 'R')
                    <p class="text-center">
                      {{-- {{ dd($dado->qexgzmnndqxmyks->tipo_pessoa) }} --}}
                      Recebi(emos) 
                      @if (isset($dado->id_cliente) AND $dado->qexgzmnndqxmyks->cpf)
                      de <strong>{{ $dado->qexgzmnndqxmyks->nome ?? '' }}</strong>
                      {{ $dado->qexgzmnndqxmyks->tipo_pessoa == 'Física' ? 'CPF' : 'CPF' }} {{ $dado->qexgzmnndqxmyks->cpf }}, 
                      @endif
                      o valor de R$ {{ number_format($dado->vlr_final, 2, ',', '.') }} ( {{ valorPorExtenso($dado->vlr_final, true, false) }} ), 
                      referente a {{ $dado->informacao }}
                    </p>
                    @endif
                    @if ($dado->tipo == 'D')
                    <p class="text-center">
                      Eu, <strong>{{ $dado->qexgzmnndqxmyks->nome ?? '' }}</strong>, 
                      @if (isset($dado->id_cliente) AND $dado->qexgzmnndqxmyks->cpf)
                      {{ $dado->qexgzmnndqxmyks->tipo_pessoa == 'Física' ? 'CPF' : 'CPF' }} {{ $dado->qexgzmnndqxmyks->cpf }} 
                      @endif
                      recebi do 
                      @if (isset($dado->id_cliente) AND $dado->qexgzmnndqxmyks->cpf)
                      {{ $empresa->nome ?? 'Nome da Empresa ou Cliente' }} – CNPJ {{ $empresa->cnpj ?? 'CNPJ ou CPF' }},
                      @endif
                      o valor de R$ {{ number_format($dado->vlr_final, 2, ',', '.') }} (  {{ valorPorExtenso($dado->vlr_final, true, false) }} ), 
                      referente a {{ $dado->informacao }}.
                    </p>
                    @endif
                    <br>
                    <p class="text-center">
                      Caratinga / MG, 
                      {{-- {{ \Carbon\Carbon::now()->format('l d \d\e F \d\e Y') }} --}}
                      
                      <span id="dia_extenso"></span>
                      <br>
                      <br>
                      <br>
                      <br>
                      <div class="text-center" style="border-top: 1px solid black; left: 30%; position: relative; width: 40%;">
                        <span>
                          <strong>
                            {{ $dado->qexgzmnndqxmyks->nome ?? '' }}
                            @if (isset($dado->id_cliente) AND $dado->qexgzmnndqxmyks->cpf)
                            {{ $dado->qexgzmnndqxmyks->tipo_pessoa == 'Física' ? ' - CPF: ' : ' - CNPJ: ' }} {{ $dado->qexgzmnndqxmyks->cpf }} 
                            @endif
                          </strong>
                        </span>
                      </div>
                      {{-- <br> --}}
                      {{-- Caratinga / MG, {{ \Carbon\Carbon::now()->formatLocalized('%A %d de %B de %Y') }} --}}
                      {{-- <br> --}}
                      {{-- <td style="width:1%; white-space:nowrap;"><strong>ID Cliente: </strong><a href="{{ route('pessoa.show', $dado->id_cliente ) }}">{{ $dado->id_cliente }}</a>&emsp;</td> --}}
                    </p>
                  </div>
                </div>
              </div>
            </div>
          </div>
        </div>  
        
        <div class="row no-print">
          <div class="col-12">
            <a onclick="window.print()" rel="noopener" target="_blank" class="btn btn-default float-right"><i class="fas fa-print"></i> Imprimir</a>
          </div>
        </div>
      </div>
    </div>    
  </div>
</div>
@endsection
        


@section('js')
<script>
  window.print();
</script>
@endsection

@section('style')
<style>
body {
  width: 100%;
  height: 100%;
  margin: 0;
  padding: 0;
  background-color: #FAFAFA;
  font: 12pt "Tahoma";
}
* {
  box-sizing: border-box;
  -moz-box-sizing: border-box;
}
.page {
  width: 210mm;
  min-height: 297mm;
  padding: 20mm;
  margin: 10mm auto;
  border: 1px #D3D3D3 solid;
  border-radius: 5px;
  background: white;
  box-shadow: 0 0 5px rgba(0, 0, 0, 0.1);
}
.subpage {
  padding: 0.5cm;
  border: 3px black solid;
  height: 280mm;
  outline: 1cm white solid;
}

@page {
  size: A4;
  margin: 0;
}
@media print {
  html, body {
    width: 210mm;
    height: 297mm;        
  }
  .page {
    margin: 0;
    border: initial;
    border-radius: initial;
    width: initial;
    min-height: initial;
    box-shadow: initial;
    background: initial;
    page-break-after: always;
  }
}
</style>
@endsection


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

@section('js')
<script type="text/javascript">
$(document).ready(function(){
  meses = new Array("Janeiro","Fevereiro","Março","Abril","Maio","Junho","Julho","Agosto","Setembro","Outubro","Novembro","Dezembro");
  semana = new Array("Domingo","Segunda-feira","Terça-feira","Quarta-feira","Quinta-feira","Sexta-feira","Sábado");

  DiaExtenso();
});

function DiaExtenso()
{
  hoje = new Date();
  dia  = hoje.getDate();
  dias = hoje.getDay();
  mes  = hoje.getMonth();
  ano  = hoje.getYear();
  
  if (navigator.appName == "Netscape")
    ano = ano + 1900;
  diaext = semana[dias] + ", " + dia + " de " + meses[mes] + " de " + ano;

  document.getElementById('dia_extenso').innerHTML = diaext;
}
</script>
@endsection
