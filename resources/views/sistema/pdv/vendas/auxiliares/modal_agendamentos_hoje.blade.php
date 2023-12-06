<div class="modal fade" id="modal_agendamentos_hoje" data-bs-backdrop="static" data-bs-keyboard="false">
  <div class="modal-dialog modal-lg">
    <div class="modal-content">
      <div class="modal-header">
        <h5 class="modal-title">Agendamentos: {{ \Carbon\Carbon::today()->format('d/m/Y') }}</h5>
        <input type="hidden" id="agendamentos_hoje_id" value="{{ $id_pessoa ?? null }}">
      </div>
      <div class="modal-body">
        <div class="row">
          <div class="col-12">
          <div class="col-12 table-responsive pl-0">
              <table class="table table-hover table-condensed table-sm table-striped no-padding table-valign-middle">
                <thead class="table-dark">
                  <tr>
                    <th style="width: 10%;">#ID</th>
                    <th style="width: auto;">Horário</th>
                    <th style="width: auto;">Profissional</th>
                    <th style="width: auto;">Serviço / Produto</th>
                    <th style="width: 15%;" class="text-right">Valor</th>
                    <th style="width: 10%;" class="text-center">. . .</th>
                  </tr>
                </thead>
                <tbody>
                @forelse($venda->cliente->iemzmwadhadlask->
                                        whereBetween('created_at',
                                        [ 
                                          \Carbon\Carbon::today()->startOfDay(), 
                                          \Carbon\Carbon::today()->endOfDay() 
                                        ]) as $key => $agendamento)
                  <tr id="agendamento_linha_{{ $agendamento->id }}" style="background-color: {{ $agendamento->color }}">
                    <td>{{ $agendamento->id }}</td>
                    <td><b>{{ \Carbon\Carbon::parse($agendamento->start)->format('H:i') }}</b> à {{ \Carbon\Carbon::parse($agendamento->end)->format('H:i') }}</td>
                    <td>{{ $agendamento->hhmaqpijffgfhmj->apelido ?? $agendamento->id_profexec }}</td>
                    <td>{{ $agendamento->zlpekczgsltqgwg->nome ?? $agendamento->id_servprod }}</td>
                    <td class="text-right">{{ number_format($agendamento->valor ?? $agendamento->zlpekczgsltqgwg->vlr_venda ?? 0, 2, ',', '.') }}</td>
                    <td class="text-center">
                      <a style="cursor:pointer;" id="agendamento_botao_{{ $agendamento->id }}" onclick="agendamento_adicionar(
                        {{ $agendamento->id }}, 
                        {{ $agendamento->id_servprod }}, 
                        {{ $agendamento->valor ?? $agendamento->zlpekczgsltqgwg->vlr_venda }}, 
                        {{ $agendamento->id_profexec }},
                        '{{ $agendamento->hhmaqpijffgfhmj->apelido }}'
                        )"><i class="fa-solid fa-square-plus"></i></a>
                    </td>
                  </tr>
                  @empty
                  <tr>
                    <td colspan="6" class="text-center">Não há serviços agendados.</td>
                  </tr>
                  @endforelse
                </tbody>
              </table>
            </div>   
          </div>
        </div>
      </div>
      <div class="modal-footer justify-content-between">
        <a class="btn btn-sm btn-default" data-bs-dismiss="modal">Cancelar</a>
        <a class="btn btn-sm btn-primary" onclick="cpf_alterar()">Lançar Todos</a>
        <a class="btn btn-sm btn-primary" onclick="cpf_alterar()">Fechar</a>
      </div>
    </div>
  </div>
</div>

<script type='text/javascript'>
//
$(document).ready(function()
{
  inputMasksActivate()
})

temp_agendamentos = {}
temp_agendamentos.fin_contas_internas = {}
function agd_servprod_executor_selecionado( id )
{
  var url = "{{ route('cat.servprod.executor', ':id') }}"
  var url = url.replace(':id', id)
  
  axios.get(url)
  .then(function(response)
  {
    // console.log(response.data)
    temp.pdv_vendas_detalhes.tipo          = response.data.tipo
    temp.pdv_vendas_detalhes.id_servprod   = response.data.id
    temp.pdv_vendas_detalhes.quantidade    = 1
    temp.pdv_vendas_detalhes.vlr_venda     = response.data.vlr_venda
    temp.pdv_vendas_detalhes.vlr_dsc_acr   = 0
    temp.pdv_vendas_detalhes.obs           = null
    temp.pdv_vendas_detalhes.status        = null
    temp.pdv_vendas_detalhes.nome          = response.data.nome
    temp.pdv_vendas_detalhes.tipo_preco    = response.data.tipo_preco
  })
  @include('includes.catch', [ 'codigo_erro' => '8542657a' ] )
}

function agd_comissao_buscar( id_servprod, id_profexec )
{
  
  var url = "{{ route('cat.comissao.buscar', [':id_profexec', ':id_servprod']) }}"
  var url = url.replace(':id_profexec', id_profexec)
  var url = url.replace(':id_servprod', id_servprod)
  
  axios.get(url)
  .then(function(response)
  {
    // console.log(response.data)
    temp.pdv_vendas_detalhes.fin_contas_internas.percentual = response.data.prc_comissao
  })
  @include('includes.catch', [ 'codigo_erro' => '6542864a' ] )
}  

function agd_profissional_selecionado( id_profexec, apelido_profissional )
{
  temp.pdv_vendas_detalhes.fin_contas_internas.id_origem     = null
  temp.pdv_vendas_detalhes.fin_contas_internas.fonte_origem  = 'pdv_vendas_detalhes'
  temp.pdv_vendas_detalhes.fin_contas_internas.id_pessoa     = id_profexec
  temp.pdv_vendas_detalhes.fin_contas_internas.tipo          = 'Comissão Sob Valor Final'
  temp.pdv_vendas_detalhes.fin_contas_internas.valor         = temp.pdv_vendas_detalhes.fin_contas_internas.percentual * temp.pdv_vendas_detalhes.vlr_negociado
  temp.pdv_vendas_detalhes.fin_contas_internas.dt_prevista   = moment().format('YYYY-MM-DD')
  temp.pdv_vendas_detalhes.fin_contas_internas.dt_quitacao   = null
  temp.pdv_vendas_detalhes.fin_contas_internas.id_destino    = null
  temp.pdv_vendas_detalhes.fin_contas_internas.fonte_destino = null
  temp.pdv_vendas_detalhes.fin_contas_internas.status        = 'Em Aberto'
}

function agd_venda_detalhes_adicionar()
{

  
  if(temp.pdv_vendas_detalhes.fin_contas_internas.id_pessoa != null)
  {
    temp_agendamentos.fin_contas_internas = {
      "id_origem"     : temp.pdv_vendas_detalhes.fin_contas_internas.id_origem,
      "fonte_origem"  : temp.pdv_vendas_detalhes.fin_contas_internas.fonte_origem,
      "id_pessoa"     : temp.pdv_vendas_detalhes.fin_contas_internas.id_pessoa,
      "tipo"          : temp.pdv_vendas_detalhes.fin_contas_internas.tipo,
      "percentual"    : temp.pdv_vendas_detalhes.fin_contas_internas.percentual,
      "valor"         : temp.pdv_vendas_detalhes.fin_contas_internas.valor,
      "dt_prevista"   : temp.pdv_vendas_detalhes.fin_contas_internas.dt_prevista,
      "dt_quitacao"   : temp.pdv_vendas_detalhes.fin_contas_internas.dt_quitacao,
      "id_destino"    : temp.pdv_vendas_detalhes.fin_contas_internas.id_destino,
      "fonte_destino" : temp.pdv_vendas_detalhes.fin_contas_internas.fonte_destino,
      "status"        : temp.pdv_vendas_detalhes.fin_contas_internas.status,
      "apelido"       : temp.pdv_vendas_detalhes.fin_contas_internas.apelido,
    }
  }

  console.log(temp_agendamentos)
  // pdv_vendas_detalhes.push(temp_agendamentos)
  // console.log(pdv_vendas_detalhes)
  index_d = index_d + 1

  pdv_vendas.qtd_produtos  = collect(pdv_vendas_detalhes).count()
  pdv_vendas.vlr_final     = collect(pdv_vendas_detalhes).sum('vlr_final')

  vendas_form_preencher()

  // temp.pdv_vendas_detalhes   = {}
  // temp.pdv_vendas_detalhes.fin_contas_internas = {}
}


async function agendamento_adicionar( id_agendamento, id_servprod, vlr_servprod, id_profexec, apelido_profissional )
{
  setTimeout(() => {
    $("#id_servprod_selecionar").val(id_servprod).trigger('change');
  }, 1000);

  setTimeout(() => {
    $("#id_profexec_selecionar").val(id_profexec).trigger('change');
  }, 2000);

  setTimeout(() => {
    $("#venda_detalhes_adicionar").trigger('click');
  }, 4000);
  
  $("#agendamento_linha_"+id_agendamento).css("background-color","lightblue");
  $("#agendamento_botao_"+id_agendamento).html("<i class='fa-solid fa-square-check'></i>");
  
  $("#modal_agendamentos_hoje").modal("show");


  // temp.pdv_vendas_detalhes.vlr_negociado = vlr_servprod
  // temp.pdv_vendas_detalhes.vlr_final     = vlr_servprod

  // agd_servprod_executor_selecionado( id_servprod )
  
  // agd_comissao_buscar( id_servprod, id_profexec )
  
  // temp.pdv_vendas_detalhes.fin_contas_internas.tipo    = 'Comissão Sob Valor Final'
  // temp.pdv_vendas_detalhes.fin_contas_internas.apelido = apelido_profissional
  
  // const kljdalksd= await preencher_n_temp()
  // console.log(kljdalksd)
  // agd_profissional_selecionado( id_profexec, apelido_profissional )
  
  // await pdv_vendas_detalhes.push(agd_venda_detalhes_adicionar())

}

function preencher_n_temp()
{
  return temp_agendamentos = {
    "id"            : index_d,
    "id_servprod"   : temp.pdv_vendas_detalhes.id_servprod,
    "quantidade"    : temp.pdv_vendas_detalhes.quantidade,
    "vlr_venda"     : temp.pdv_vendas_detalhes.vlr_venda,
    "vlr_negociado" : temp.pdv_vendas_detalhes.vlr_negociado,
    "vlr_dsc_acr"   : temp.pdv_vendas_detalhes.vlr_dsc_acr,
    "vlr_final"     : temp.pdv_vendas_detalhes.vlr_final,
    "obs"           : temp.pdv_vendas_detalhes.obs,
    "status"        : temp.pdv_vendas_detalhes.status,
    "nome"          : temp.pdv_vendas_detalhes.nome
  }
}


</script>
