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
                                <select class="form-control form-control-sm @error('{{ $name }}') is-invalid @enderror" wire:model="add_prod_escolhido" wire:change="sobreProduto">
                                    <option>Selecione . . .</option>
                                    @foreach($add_forn_prod_lista as $produto )
                                    <option value="{{ $produto->id }}">{{ $produto->nome }}</option>
                                    @endforeach
                                </select>
                                <div class="small">Estoque: {{ $fin_compras_detalhes_estoque_min ?? 'E-Min' }} | {{ $fin_compras_detalhes_estoque_max ?? 'E-Max' }} | {{ $fin_compras_detalhes_estoque_atual ?? 'E-Atual' }}</div>
                                @error('fin_compras_detalhes_id_servprod')<div class="invalid-feedback">{{ $message }}</div>@enderror
                            </div>
                        </div>

                        <div class="col-sm-1">
                            <div class="form-group">
                                <label>Qtd</label>
                                <input type="number" class="form-control form-control-sm text-center @error('add_prod_escolhido_qtd') is-invalid @enderror" wire:model="add_prod_escolhido_qtd" min="0" id="campo_compras_detalhes_qtd" onchange="calcularTotal()">
                                @error('add_prod_escolhido_qtd')<div class="invalid-feedback">{{ $message }}</div>@enderror
                            </div>
                        </div>

                        <div class="col-sm-2">
                            <div class="form-group">
                                <label>Custo unitário</label>
                                <input type="text" class="form-control form-control-sm text-right @error('add_prod_escolhido_vlr_compra') is-invalid @enderror" wire:model="add_prod_escolhido_vlr_compra" id="campo_compras_detalhes_vlr_compra" onchange="calcularTotal()">
                                <div class="small">Último valor: {{ number_format($add_prod_escolhido_vlr_compra ?? 0, 2, ',', '.') }}</div>
                                @error('add_prod_escolhido_vlr_compra')<div class="invalid-feedback">{{ $message }}</div>@enderror
                            </div>
                        </div>

                        <div class="col-sm-2">
                            <div class="form-group">
                                <label>Desc. / Acr.</label>
                                <input type="text" class="form-control form-control-sm text-right @error('add_prod_escolhido_vlr_dsc_acr') is-invalid @enderror" wire:model="add_prod_escolhido_vlr_dsc_acr" id="campo_compras_detalhes_vlr_dsc_acr" onchange="calcularTotal()">
                                @error('add_prod_escolhido_vlr_dsc_acr')<div class="invalid-feedback">{{ $message }}</div>@enderror
                            </div>
                        </div>

                        <div class="col-sm-2">
                            <div class="form-group">
                                <label>Custo unitário final</label>
                                <input type="text" class="form-control form-control-sm text-right @error('add_prod_escolhido_vlr_final') is-invalid @enderror" wire:model="add_prod_escolhido_vlr_final" id="campo_compras_detalhes_vlr_final" readonly>
                                @error('add_prod_escolhido_vlr_final')<div class="invalid-feedback">{{ $message }}</div>@enderror
                            </div>
                        </div>

                        <div class="col-sm-2">
                            <div class="form-group">
                                <label>Custo final</label>
                                <input type="text" class="form-control form-control-sm text-right" id="campo_compras_detalhes_vlr_custo_total" readonly>
                            </div>
                        </div>


                        <div class="offset-10 col-sm-2">
                            <div class="form-group">
                                <button type="button" class="btn btn-success btn-block btn-sm" wire:click="adicionarProduto({{ $fin_compras_id }})"><i class="fa fa-plus"></i>Adicionar produto</button>
                            </div>
                        </div>

                        <br>

                    </div>
                    <div class="row">
                        <div id="accordion">
                            <div class="card card-secondary">
                                {{-- <div class="card-header"> --}}
                                    {{-- <h4 class="card-title w-100"> --}}
                                        {{-- <a class="d-block w-100" data-bs-toggle="collapse" href="#collapseOne" aria-expanded="true"> --}}
                                            {{-- Produtos adicionados --}}
                                        {{-- </a> --}}
                                    {{-- </h4> --}}
                                {{-- </div> --}}
                                {{-- <div id="collapseOne" class="collapse show" data-bs-parent="#accordion" style=""> --}}
                                    {{-- <div class="card-body"> --}}
                                        {{-- <div class="row"> --}}
                                            <table class="table">
                                                <thead class="table-dark">
                                                    <tr>
                                                        <th class="text-left">Produto</th>
                                                        <th class="text-right">Custo unitário</th>
                                                        <th class="text-right">Desc/Acr.</th>
                                                        <th class="text-right">Custo unitário final</th>
                                                        <th class="text-center">Qtd</th>
                                                        <th class="text-right">Custo final</th>
                                                        <th class="text-center">Status</th>
                                                        <th class="text-right"><i class="fas fa-ellipsis-h"></i></th>
                                                    </tr>
                                                </thead>
                                                <tbody>
                                                    @forelse ($fin_compras_detalhes->sortByDesc('id') as $volta)
                                                    <tr wire:key="{{ $volta->id }}">
                                                        <td class="p-1 text-left">{{ $volta->odkqoweiwoeiowj->nome }}</td>
                                                        <td class="p-1 text-right"><small>{{ number_format($volta->vlr_compra, 2, ',', '.') }}</small></td>
                                                        <td class="p-1 text-right"><small>{{ number_format($volta->vlr_dsc_acr, 2, ',', '.') }}</small></td>
                                                        <td class="p-1 text-right">{{ number_format($volta->vlr_negociado, 2, ',', '.') }}</td>
                                                        <td class="p-1 text-center">{{ $volta->qtd }}</td>
                                                        <td class="p-1 text-right">{{ number_format($volta->vlr_final, 2, ',', '.') }}</td>
                                                        <td class="p-1 text-center"><small><span class="badge bg-secondary">{{ $volta->status }}</span></small></td>
                                                        <td class="p-1 text-right">
                                                            <x-icon.delete click="{{ $volta->id }}" funcao="deletarProduto" />
                                                        </td>
                                                    </tr>
                                                    @empty
                                                    <tr>
                                                        <td colspan="8" class="text-center"><small>Não há produtos adicionados a essa compra.</small></td>
                                                    </tr>
                                                    @endforelse
                                                </tbody>
                                                <tfoot>
                                                    <tr>
                                                        <td></td>
                                                        <td class="p-1 text-left">{{ $fin_compras_detalhes->count() }}</td>
                                                        <td></td>
                                                        <td></td>
                                                        <td></td>
                                                        <td class="p-1 text-center">{{ $fin_compras_detalhes->sum('qtd') }}</td>
                                                        <td class="p-1 text-right">{{ number_format($fin_compras_detalhes->sum('vlr_final'), 2, ',', '.') }}</td>
                                                        <td></td>
                                                        <td></td>
                                                    </tr>
                                                </tfoot>
                                            </table>
                                        {{-- </div> --}}
                                    {{-- </div> --}}
                                {{-- </div> --}}
                            </div>

                                {{-- <div class="card-header"> --}}
                                    {{-- <a class="collapsed show" data-bs-bs-toggle="collapse show" href="#tabela-produtos-adicionados" aria-expanded="false"> --}}
                                        {{-- <h4 class="card-title w-100 mb-0 ">Produtos adicionados</h4> --}}
                                    {{-- </a> --}}
                                {{-- </div>
                                <div id="tabela-produtos-adicionados show" class="collapse" data-bs-bs-parent="#accordion">
                                    <div class="card-body">

                                    </div>
                                </div> --}}
                            {{-- </div> --}}
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
