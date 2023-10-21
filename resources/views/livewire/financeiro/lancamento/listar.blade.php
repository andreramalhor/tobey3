<div>
    <section class="content pt-3">
        <div class="container-fluid">
            <div class="card">
                <div class="card-header">
                    <h3 class="card-title">Extrato de movimentações</h3>
                </div>
                <div class="card-body p-0">
                    <div class="row p-2">
                        <div class="col-1">
                            <div class="form-group">
                                <div class="input-group">
                                    <select class="form-control form-control-sm" name="tipo" wire:model.live="tipo">
                                        <option value="">Tipo</option>
                                        <option value="R">Receita</option>
                                        <option value="D">Despesa</option>
                                        <option value="T">Transferência</option>
                                    </select>
                                </div>
                            </div>
                        </div>
                        <div class="col-2">
                            <div class="form-group">
                                <div class="input-group">
                                    <div class="input-group-prepend">
                                        <span class="input-group-text"><small>De:</small></span>
                                    </div>
                                    <input type="date" class="form-control form-control-sm" name="inicio" wire:model.live="inicio">
                                </div>
                            </div>
                        </div>
                        <div class="col-2">
                            <div class="form-group">
                                <div class="input-group">
                                    <div class="input-group-prepend">
                                        <span class="input-group-text"><small>à:</small></span>
                                    </div>
                                    <input type="date" class="form-control form-control-sm" name="final" wire:model.live="final">
                                </div>
                            </div>
                        </div>
                        <div class="col-3">
                            <div class="form-group">
                                <div class="input-group">
                                    <input type="text" class="form-control form-control-sm" name="pesquisa" wire:model.live="pesquisa" placeholder="Pesquisar pessoas ou descrição">
                                </div>
                            </div>
                        </div>
                        <x-financeiro.bancos-select col="1" name="id_banco" wire:model.live="banco"/>
                        <div class="col-1">
                            <div class="form-group">
                                <div class="input-group">
                                    <input type="text" class="form-control form-control-sm" name="valor" wire:model.live="valor" placeholder="Valor">
                                </div>
                            </div>
                        </div>
                        <div class="col-2">
                            <div class="form-group">
                                <div class="input-group">
                                    <input type="text" class="form-control form-control-sm" name="conta" wire:model.live="conta" placeholder="Conta">
                                </div>
                            </div>
                        </div>
                    </div>
                    <table class="table table-sm">
                        <thead class="table-dark">
                            <tr>
                                <th>#</th>
                                <th>Tipo</th>
                                <th>Data lançamento</th>
                                <th>Descrição / Pessoa</th>
                                <th>Banco / Conta contábil</th>
                                <th class="text-right">Valor</th>
                                <th class="text-right">Saldo</th>
                                <th class="text-center"><i class="fas fa-ellipsis-h"></i></th>
                            </tr>
                        </thead>
                        <tbody>
                            @php
                                $receita = 0;
                                $despesa = 0;
                                $transfe = 0;
                                $saldo   = 0;
                            @endphp

                            @forelse($lancamentos as $lancamento)

                                @php
                                    switch ($lancamento->tipo)
                                    {
                                        case 'R':
                                            $receita = $receita + $lancamento->vlr_final;
                                            $saldo   = $saldo + $lancamento->vlr_final;
                                            break;
                                        case 'T':
                                            $transfe = $transfe + $lancamento->vlr_final;
                                            $saldo   = $saldo + $lancamento->vlr_final;
                                            break;
                                        case 'D':
                                            $despesa = $despesa + $lancamento->vlr_final;
                                            $saldo   = $saldo - $lancamento->vlr_final;
                                            break;
                                        default:
                                            echo "Opção não reconhecida";
                                            break;
                                    }
                                @endphp
                                <tr>
                                    <td class="text-center">{{ $lancamento->id }}</td>
                                    <td class="text-center">
                                        <span class="badge bg-{{ $lancamento->color }}">{{ $lancamento->tipo }}</span>
                                    </td>
                                    <td>
                                        {{ \Carbon\Carbon::parse($lancamento->dt_pagamento)->format('d/m/Y') }}
                                    </td>
                                    <td>
                                        <strong>{{ $lancamento->informacao ?? $lancamento->descricao }}</strong><br>
                                        <small>Pessoa: {{ $lancamento->qexgzmnndqxmyks->apelido ?? '' }}</small>
                                    </td>
                                    <td>
                                        <small>Banco: {{ $lancamento->yaapdycfbplzkeg->nome ?? '' }}</small><br>
                                        <small>{{ $lancamento->qlwiqwuheqlefkd->titulo ?? '' }}</small>
                                    </td>
                                    <td class="text-right text-{{ $lancamento->color }}"><strong>{{ number_format($lancamento->vlr_final, 2, ',', '.') }}</strong></td>
                                    <td class="text-right text-{{ $saldo < 0 ? 'danger' : 'success' }}"><strong>{{ number_format($saldo, 2, ',', '.') }}</strong></td>
                                    <td class="text-center">
                                        <a href="" wire:click="atender({{ $lancamento->id }})" class="badge bg-gray">Atn</a>
                                        <a href="" wire:click="editar({{ $lancamento->id }})" class="badge bg-gray">Edi</a>
                                        <a href="" wire:click="excluir({{ $lancamento->id }})" class="badge bg-gray">Exc</a>
                                    </td>
                                </tr>
                            @empty
                                <tr>
                                    <th colspan="7" class="text-center">Não há resultados para essa pesquisa.</th>
                                </tr>
                            @endforelse
                        </tbody>
                        <tfoot>
                            <tr>
                                <td></td>
                                <td></td>
                                <td></td>
                                <td></td>
                                <td></td>
                                <td class="text-right">{{ number_format($receita + $transfe - $despesa, 2, ',', '.') }}</td>
                                <td></td>
                            </tr>
                        </tfoot>
                    </table>
                </div>
            </div>
        </div>
    </section>
</div>