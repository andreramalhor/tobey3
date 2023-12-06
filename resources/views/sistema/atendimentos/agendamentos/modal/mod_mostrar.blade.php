<div class="modal fade" id="modal_lead_create" tabindex="-1" style="display: none;" aria-hidden="true">
  <div class="modal-dialog mw-100 mh-100" style="width: 95%; height: 95%;">
    <div class="modal-content" style="height: 95%;">
      {{-- <div class="overlay" id="overlay_lead"></div> --}}
      <div class="modal-header border-0 p-2">
        <h4 class="modal-title">Cadastrar novo Lead</span></h4>
        <button type="button" class="btn-close p-2" data-bs-dismiss="modal" aria-label="Close"></button>
      </div>
      <div class="modal-body p-2">
        <div class="row">
          <div class="col-3">
            <h6 class="text-center m-0 mb-2" style="border-bottom: 1px solid lightgray;">Dados do Lead</h6>
            <div class="col-12">
              <div class="form-group mb-2">
                <label class="m-0">Nome</label>
                <input type="hidden" id="lead_create_status" value="entrada_lead">
                <input type="hidden" id="lead_create_id_consultor" value="{{ Auth::User()->id }}">
                <input type="hidden" id="lead_create_turmas_interesse" value="">
                <input type="text" class="form-control form-control-sm" id="lead_create_nome" placeholder="Nome">
              </div>
            </div>
            <div class="col-12">
              <div class="form-group mb-2">
                <label class="m-0">Telefone</label>
                <div class="input-group">
                  <input type="text" class="form-control form-control-sm text-right" id="lead_create_telefone" placeholder="Telefone">
                  <div class="input-group-append">
                    <a class="input-group-text" id="lead_create_link_whatsapp" target="_blank" data-bs-tooltip="tooltip" data-bs-title="Whatsapp" aria-label="Whatsapp">
                      <i class="fa-brands fa-whatsapp"></i>
                    </a>
                  </div>
                </div>
              </div>
            </div>
            <div class="col-12">
              <div class="form-group mb-2">
                <label class="m-0">Cidade</label>
                <input type="text" class="form-control form-control-sm" id="lead_create_cidade" placeholder="Cidade" value="Caratinga">
              </div>
            </div>
            <div class="col-12">
              <div class="form-group mb-2">
                <label class="m-0">Origem do Lead</label>
                <select class="form-control form-control-sm" id="lead_create_id_origem">
                  <option value="1"  >Assistente</option>
                  <option value="29" >Bing</option>
                  <option value="6"  >Book Fotográfico</option>
                  <option value="41" >BusDoor</option>
                  <option value="7"  >Campanha de Indicação</option>
                  <option value="18" >Carro de Som</option>
                  <option value="15" >Cartaz</option>
                  <option value="11" >Compre e Aplique</option>
                  <option value="3"  >Consultor Externo</option>
                  <option value="9"  >Corporativo</option>
                  <option value="42" >E-Mail Marketing</option>
                  <option value="25" >Facebook</option>
                  <option value="987">Facebook Lucas</option>
                  <option value="20" >Fachada</option>
                  <option value="16" >Faixa</option>
                  <option value="26" >Google</option>
                  <option value="104">Indicação de Ex-Aluno</option>
                  <option value="19" >Indicação Espontânea</option>
                  <option value="30" >Instagram</option>
                  <option value="21" >Internet/Site</option>
                  <option value="13" >Jornal</option>
                  <option value="22" >Lista Telefônica</option>
                  <option value="5"  >Mala Direta</option>
                  <option value="38" >Modelo</option>
                  <option value="17" >Muro</option>
                  <option value="14" >Outdoor</option>
                  <option value="33" >Outlook</option>
                  <option value="23" >Outros</option>
                  <option value="4"  >Panfletos</option>
                  <option value="43" >Parceria Prefeitura</option>
                  <option value="24" >Rádio</option>
                  <option value="35" >Recebimento de Transferência</option>
                  <option value="8"  >Renovações</option>
                  <option value="39" >Revista</option>
                  <option value="27" >Site da Franquia</option>
                  <option value="28" >SMS</option>
                  <option value="2"  >Telemarketing</option>
                  <option value="12" >TV</option>
                  <option value="32" >Twitter</option>
                  <option value="34" >Vendas Online</option>
                  <option value="10" >Visitas Antigas</option>
                  <option value="36" >WhatsApp</option>
                  <option value="40" >Workshop</option>
                  <option value="31" >Yahoo</option>
                </select>
              </div>
            </div>
            <div class="col-12">
              <div class="form-group mb-2">
                <label class="m-0">Interesse</label>
                <select class="form-control form-control-sm" id="lead_create_interesse">
                  <option value="frio" selected>Frio</option>
                  <option value="morno">Morno</option>
                  <option value="quente">Quente</option>
                </select>
              </div>
            </div>
            <div class="col-12">
              <div class="form-group mb-2">
                <label class="m-0">Observação</label>
                <textarea class="form-control form-control-sm" id="lead_create_obs" rows="2"></textarea>
              </div>
            </div>
          </div>
          <div class="col-3 border-left">
            <h6 class="text-center m-0 mb-2" style="border-bottom: 1px solid lightgray;">Cursos/Turmas de Interesse</h6>
            <div class="row">
              <div class="col-12">
                <div class="form-group mb-3">
                  <label class="m-0">Cursos Disponíveis</label>
                  <div class="col-sm-12">
                    <div class="form-group" id="lead_create_turmas_disponiveis">
                      <div class="custom-control custom-checkbox">
                        <input class="custom-control-input" type="checkbox" id="customCheckbox1" value="option1">
                        <label for="customCheckbox1" class="custom-control-label">Custom Checkbox</label>
                      </div>
                      <!-- <div class="custom-control custom-checkbox">
                        <input class="custom-control-input" type="checkbox" id="customCheckbox2" checked="">
                        <label for="customCheckbox2" class="custom-control-label">Custom Checkbox checked</label>
                      </div>
                      <div class="custom-control custom-checkbox">
                        <input class="custom-control-input" type="checkbox" id="customCheckbox3" disabled="">
                        <label for="customCheckbox3" class="custom-control-label">Custom Checkbox disabled</label>
                      </div>
                      <div class="custom-control custom-checkbox">
                        <input class="custom-control-input custom-control-input-danger" type="checkbox" id="customCheckbox4" checked="">
                        <label for="customCheckbox4" class="custom-control-label">Custom Checkbox with custom color</label>
                      </div> -->

                    </div>
                  </div>
                </div>
              </div>
            </div>
          </div>
          <div class="col-6 border-left overflow-auto">
            <h6 class="text-center m-0 mb-2" style="border-bottom: 1px solid lightgray;">Conversas</h6>
            <div class="row">
              <div class="col-12">
                <div class="form-group mb-3">
                  <label class="m-0">Registrar Conversa</label>
                  <div class="input-group">
                    <textarea class="form-control form-control-sm" id="lead_create_nova_conversa" rows="2"></textarea>
                  </div>
                </div>
              </div>
            </div>
            <div class="row overflow-auto" id="lead_create_conversas" style="height: auto; max-height: 250px;">
            </div>
          </div>
        </div>
        </br>
        <div class="row">
          <div class="col-md-3 p-1">
            <button type="button" class="btn btn-info btn-block" id="label_create_entrada_lead" onclick="lead_definirStatus( 'entrada_lead' )"><strong>Entrada do Lead</strong></button>
          </div>
          <div class="col-md-3 p-1">
            <button type="button" class="btn btn-outline-primary btn-block" id="label_create_apresentacao_curso" onclick="lead_definirStatus( 'apresentacao_curso' )"><strong>Apresentação do Curso</strong></button>
          </div>
          <div class="col-md-3 p-1">
            <button type="button" class="btn btn-outline-secondary btn-block" id="label_create_proposta_enviada" onclick="lead_definirStatus( 'proposta_enviada' )"><strong>Proposta Enviada</strong></button>
          </div>
          <div class="col-md-3 p-1">
            <button type="button" class="btn btn-outline-dark btn-block" id="label_create_negociando_venda" onclick="lead_definirStatus( 'negociando_venda' )"><strong>Negociando</strong></button>
          </div>
        </div>
      </div>
      <div class="modal-footer p-2">
        <button type="button" class="btn btn-default" data-bs-dismiss="modal">Fechar</button>
        <button type="button" class="btn btn-primary" data-bs-dismiss="modal" onclick="lead_create()">Cadastrar</button>
      </div>
    </div>
  </div>
</div>

@push('js')
<script type="text/javascript">

</script>
@endpush
