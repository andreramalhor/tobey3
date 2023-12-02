@if ( $modalType == 'passo_1' )
<div class="modal show" tabindex="-1" role="dialog" style="display: block;" >
    <div class="modal-dialog modal-xl w-90">
        <div class="modal-content">
            <form wire:submit.prevent="concluir_passo_1">
                <div class="modal-body">
                    <div class="row">
                        <div class="col-sm-3">
                            <div class="form-group">
                                <label>Tipo</label>
                                <select class="form-control form-control-sm @error('fin_compras_tipo') is-invalid @enderror" wire:model="fin_compras_tipo">
                                    <option value="Produtos para revenda">Produtos para revenda</option>
                                    <option value="Produtos para consumo">Produtos para consumo</option>
                                </select>
                                @error('fin_compras_tipo')<div class="invalid-feedback">{{ $message }}</div>@enderror
                            </div>
                        </div>

                        <x-atendimento.pessoa.pessoas-select col="3" label="Fornecedor" name="fin_compras_id_fornecedor" filtro="Fornecedor" wire:model.live="fin_compras_id_fornecedor" />
                    </div>

                    <br>

                    <div class="row">
                        <div class="col-sm-1">
                            <div class="form-group">
                                <label>Produtos</label>
                                <input type="text" class="form-control form-control-sm text-center @error('fin_compras_qtd_produtos') is-invalid @enderror" wire:model="fin_compras_qtd_produtos" readonly>
                                @error('fin_compras_qtd_produtos')<div class="invalid-feedback">{{ $message }}</div>@enderror
                            </div>
                        </div>

                        <div class="col-sm-2">
                            <div class="form-group">
                                <label>Custo total</label>
                                <input type="text" class="form-control form-control-sm text-right @error('fin_compras_vlr_prod_serv') is-invalid @enderror" wire:model="fin_compras_vlr_prod_serv" readonly>
                                @error('fin_compras_vlr_prod_serv')<div class="invalid-feedback">{{ $message }}</div>@enderror
                            </div>
                        </div>

                        <div class="col-sm-2">
                            <div class="form-group">
                                <label>Desc/Acr.</label>
                                <input type="text" class="form-control form-control-sm text-right @error('fin_compras_vlr_dsc_acr') is-invalid @enderror" wire:model="fin_compras_vlr_dsc_acr" readonly>
                                @error('fin_compras_vlr_dsc_acr')<div class="invalid-feedback">{{ $message }}</div>@enderror
                            </div>
                        </div>

                        <div class="col-sm-2">
                            <div class="form-group">
                                <label>Valor final</label>
                                <input type="text" class="form-control form-control-sm text-right @error('fin_compras_vlr_final') is-invalid @enderror" wire:model="fin_compras_vlr_final" readonly>
                                @error('fin_compras_vlr_final')<div class="invalid-feedback">{{ $message }}</div>@enderror
                            </div>
                        </div>

                    </div>
                </div>
                <div class="modal-footer justify-content-between">
                    <button type="button" class="btn btn-default mt-4" wire:click="closeModal" style="margin-top: 0px !important;">Cancelar</button>
                    <button type="submit" class="btn btn-secondary mt-4" style="margin-top: 0px !important;">Salvar</button>
                </div>
            </form>
        </div>
    </div>
</div>
<div class="modal-backdrop fade show"></div>
@endif
