@if ( $modal_type == 'criar' )
<div class="modal show" tabindex="-1" role="dialog" style="display: block;" >
    <div class="modal-dialog modal-xl">
        <div class="modal-content">
            <div class="overlay d-none" wire:loading.class="d-block"></div>
            <form wire:submit.prevent="gravar">
                <div class="modal-header">
                    <h3 class="card-title text-left pt-1 pr-5 pl-1 ml-2">Cadastrar novo agendamento</h3>
                </div>
                <div class="modal-body">
                    <div class="row">
                        <x-atendimento.pessoa.pessoas-select col="4" label="Cliente" name="bd_id_cliente" />

                        <x-catalogo.servicos-select col="4" label="Serviço" name="bd_id_servprod" tipo="Serviço" />

                        <x-atendimento.pessoa.pessoas-select col="4" label="Profissional" name="bd_id_profexec" filtro="Parceiro" />

                        
                    </div>
                    <div class="row">
                        <div class="col-4">
                            <div class="form-group">
                                <label>Início</label>
                                <input type="datetime-local" class="form-control form-control-sm" wire:model="bd_start" id="start" value="{{ \Carbon\Carbon::now()->ceilMinutes(60)->format('Y-m-d\TH:i') }}" onchange="ajusteHorario()">
                            </div>
                        </div>
                        
                        <div class="col-4">
                            <div class="form-group">
                                <label>Duração</label>
                                <input type="time" class="form-control form-control-sm" wire:model="bd_duracao" id="duracao" value="{{ \Carbon\Carbon::parse('01:00')->format('H:i') }}" onchange="ajusteHorario()">
                            </div>
                        </div>
                        
                        <div class="col-4">
                            <div class="form-group">
                                <label>Final</label>
                                <input type="datetime-local" class="form-control form-control-sm" wire:model="bd_end" id="end" value="{{ \Carbon\Carbon::now()->ceilMinutes(120)->format('Y-m-d\TH:i') }}" readonly="readonly">
                            </div>
                        </div>
                        
                    </div>
                    <hr>
                    <div class="row">
                        <div class="col-4">
                            <div class="form-group">
                                <label>Valor</label>
                                <input type="text" class="form-control form-control-sm text-right" wire:model="bd_valor" id="valor" placeholder="0,00" value="0" onchange="escolhiValor( this.value )">
                            </div>
                        </div>
                        
                        <div class="col-8">
                            <div class="form-group">
                                <label>Observação</label>
                                <input type="text" class="form-control form-control-sm" wire:model="bd_obs" id="obs" onkeyup="escolhiObs( this.value )">
                            </div>
                        </div>
                    </div>
                    
                    
                </div>
                <div class="modal-footer justify-content-between">
                    <button type="button" class="btn btn-default mt-4" wire:click="closeModal" style="margin-top: 0px !important;">Cancelar</button>
                    <button type="submit" class="btn btn-secondary mt-4" style="margin-top: 0px !important;">Cadastrar</button>
                </div>
            </form>
        </div>
    </div>
</div>
<div class="modal-backdrop fade show"></div>
@endif
