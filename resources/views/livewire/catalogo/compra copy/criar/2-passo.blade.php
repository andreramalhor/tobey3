@if ( $modalType == 'passo_2' )
<div class="modal show" tabindex="-1" role="dialog" style="display: block;" >
    <div class="modal-dialog modal-xl w-90">
        <div class="modal-content">
            <form wire:submit.prevent="gravarprodutos">
                <div class="modal-body">
                    <div class="row">
                        <div class="col-sm-3">
                            <div class="form-group">
                                <label>Produto</label>
                                <select class="form-control form-control-sm @error('{{ $name }}') is-invalid @enderror" wire:model="fin_compras_detalhes_id_servprod" wire:change="sobreProduto()" >
                                    <option>Selecione . . .</option>
                                    @foreach($produtosfornecedor as $produto )
                                    <option value="{{ $produto->id }}">{{ $produto->nome }}</option>
                                    @endforeach
                                </select>
                                @error('fin_compras_detalhes_id_servprod')<div class="invalid-feedback">{{ $message }}</div>@enderror
                            </div>
                        </div>

                        <div class="col-sm-1">
                            <div class="form-group">
                                <label>Qtd</label>
                                <input type="number" class="form-control form-control-sm text-center @error('fin_compras_detalhes_qtd') is-invalid @enderror" wire:model="fin_compras_detalhes_qtd" min="1">
                                @error('fin_compras_detalhes_qtd')<div class="invalid-feedback">{{ $message }}</div>@enderror
                            </div>
                        </div>

                        <div class="col-sm-2">
                            <div class="form-group">
                                <label>vlr_compra {{ $fin_compras_detalhes_vlr_compra }}</label>
                                <input type="text" class="form-control form-control-sm text-right @error('fin_compras_detalhes_vlr_compra') is-invalid @enderror" wire:model.live="fin_compras_detalhes_vlr_compra">
                                <div class="small">Último valor: {{ $fin_compras_detalhes_vlr_compra }}</div>
                                @error('fin_compras_detalhes_vlr_compra')<div class="invalid-feedback">{{ $message }}</div>@enderror
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
