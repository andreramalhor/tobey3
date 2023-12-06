@extends('layouts.app')

@section('content')
<form method="POST" action="{{ route('lancamento.lancar_pao') }}" autocomplete="off">
  @csrf
  <div class="row">
    <div class="col-12">
      <div class="card">
        <div class="card-header">
          <h3 class="card-title">Lançar despesa de Padaria</h3>
        </div>
        <div class="card-body">
          <div class="row">
            <div class="col-4"></div>
            <div class="col-4">
              <div class="form-group">
                <label>Valor</label>
                <input type="text" class="form-control form-control-sm text-right" id="valor" placeholder="0,00">
              </div>
            </div>
            <div class="col-4"></div>
          </div>
        </div>
        <div class="card-footer">
          <button type="button" class="btn btn-default btn-sm" href="{{ route('lancamento.index') }}" >Cancelar</button>
          <button type="submit" class="btn btn-primary btn-sm float-right">Salvar</button>
        </div>
      </div>
    </div>
  </div>
  <input type="hidden" name="0[tipo]"                       value="D">
  <input type="hidden" name="0[id_banco]"                   value="{{ Auth::User()->abcde->first()->id_banco ?? null }}">
  <input type="hidden" name="0[id_conta]"                   value=>
  <input type="hidden" name="0[num_documento]"              value="Pão">
  <input type="hidden" name="0[id_cliente]"                 value="27"> {{-- ID PADARIA --}}
  <input type="hidden" name="0[informacao]"                 value="Pão">
  <input type="hidden" name="0[vlr_bruto]"                  value="null" id='vlr_bruto'>
  <input type="hidden" name="0[vlr_dsc_acr]"                value="0">
  <input type="hidden" name="0[vlr_final]"                  value="null" id='vlr_final'>
  <input type="hidden" name="0[parcela]"                    value="01/01">
  <input type="hidden" name="0[id_forma_pagamento]"         value="1">
  <input type="hidden" name="0[descricao]"                  value="Dinheiro">
  <input type="hidden" name="0[dt_vencimento]"              value="{{ \Carbon\Carbon::Today() }}">
  <input type="hidden" name="0[dt_recebimento]"             value="{{ \Carbon\Carbon::Today() }}">
  <input type="hidden" name="0[dt_confirmacao]"             value="{{ \Carbon\Carbon::Today() }}">
  <input type="hidden" name="0[id_usuario_lancamento]"      value="{{ Auth::User()->id }}">
  <input type="hidden" name="0[id_usuario_confirmacao]"     value="{{ Auth::User()->id }}">
  <input type="hidden" name="0[id_caixa]"                   value="{{ Auth::User()->abcde->first()->id ?? null }}">
  <input type="hidden" name="0[id_lancamento_origem]"       value=>
  <input type="hidden" name="0[origem]"                     value="fin_conta_pessoas">
  <input type="hidden" name="0[status]"                     value="À Descontar">
</form>
@endsection

@push('js')
<script type="text/javascript">

  $(document).ready(function()
  {
    $("#valor").inputmask('decimal', {
      'alias': 'numeric',
      'groupSeparator': '.',
      'autoGroup': true,
      'digits': 2,
      'radixPoint': ",",
      'digitsOptional': false,
      'allowMinus': false,
      'placeholder': '0,00',
    });
  });

  $("#valor").change(function()
  {
    let valor = $("#valor").val().replace(/\./g, '').replace(',', '.');

    $('#vlr_final').val(valor);
    $('#vlr_bruto').val(valor);
  })
</script>
@endpush