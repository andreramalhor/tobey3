<div class="row">
    <div class="col-md-12">
        <div class="card">
            <div class="card-header">
                <h3 class="card-title">Pessoas</h3>
            </div>
            <div class="card-body p-0">
                <div class="row p-2">
                    <div class="col-1">
                        <div class="form-group">
                            <div class="input-group">
                                <select class="form-control form-control-sm" name="tipo" wire:model.live="p_tipo">
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
                                <input type="date" class="form-control form-control-sm" name="inicio" wire:model.live="p_inicio">
                            </div>
                        </div>
                    </div>
                    <div class="col-2">
                        <div class="form-group">
                            <div class="input-group">
                                <div class="input-group-prepend">
                                    <span class="input-group-text"><small>à:</small></span>
                                </div>
                                <input type="date" class="form-control form-control-sm" name="final" wire:model.live="p_final">
                            </div>
                        </div>
                    </div>
                    <div class="col-3">
                        <div class="form-group">
                            <div class="input-group">
                                <input type="text" class="form-control form-control-sm" name="informacao" wire:model.live="p_informacao" placeholder="Pesquisar pessoas ou descrição">
                            </div>
                        </div>
                    </div>

                    <x-financeiro.banco.bancos-select col="1" name="id_banco" wire:model.live="p_banco" />

                    <div class="col-1">
                        <div class="form-group">
                            <div class="input-group">
                                <input type="text" class="form-control form-control-sm" name="valor" wire:model.live="p_valor" placeholder="Valor">
                            </div>
                        </div>
                    </div>

                    <x-contabilidade.planoconta.planocontas-select col="2" name="conta" wire:model.live="p_conta" />

                </div>

                <div class="row p-2">
                    <div class="offset-md-8 col-md-2">
                        <div class="input-group input-group-sm">
                            <input type="text" class="form-control float-right"  placeholder="Pesquisar" wire:model.live="p_pesquisar">
                            <div class="input-group-append">
                                <button type="submit" class="btn btn-default">
                                    <i class="fas fa-search"></i>
                                </button>
                            </div>
                        </div>
                    </div>
                    <div class="col-md-2">
                        <a class="btn btn-primary btn-block btn-sm float-right" wire:click="create"><i class="fa fa-plus"></i> Cadastrar novo lançamento</a>
                    </div>
                </div>

                <table class="table">
                    <thead class="table-dark">
                        <tr>
                            <th class="text-center">#</th>
                            <th class="text-left">Tipo</th>
                            <th class="text-left">Data lançamento</th>
                            <th class="text-left">Descrição / Pessoa</th>
                            <th class="text-left">Banco / Conta contábil</th>
                            <th class="text-right">Valor</th>
                            <th class="text-right">Saldo</th>
                            <th class="text-right"><i class="fas fa-ellipsis-h"></i></th>
                        </tr>
                    </thead>
                    <tbody>
                        @php
                            $receita = 0;
                            $despesa = 0;
                            $transfe = 0;
                            $saldo   = 0;
                        @endphp

                        @forelse($lancamentos as $ciclo)

                            @php
                                switch ($ciclo->tipo)
                                {
                                    case 'R':
                                        $receita = $receita + $ciclo->vlr_final;
                                        $saldo   = $saldo + $ciclo->vlr_final;
                                        break;
                                    case 'T':
                                        $transfe = $transfe + $ciclo->vlr_final;
                                        $saldo   = $saldo + $ciclo->vlr_final;
                                        break;
                                    case 'D':
                                        $despesa = $despesa + $ciclo->vlr_final;
                                        $saldo   = $saldo - $ciclo->vlr_final;
                                        break;
                                    default:
                                        echo "Opção não reconhecida";
                                        break;
                                }
                            @endphp
                            <tr>
                                <td class="text-center py-1">{{ $ciclo->id }}</td>
                                <td class="text-left py-1">
                                    <span class="badge bg-{{ $ciclo->color }}">{{ $ciclo->tipo }}</span>
                                </td>
                                <td class="text-left py-1">
                                    {{ \Carbon\Carbon::parse($ciclo->dt_pagamento)->format('d/m/Y') }}
                                </td>
                                <td class="text-left py-1">
                                    <strong>{{ $ciclo->informacao ?? $ciclo->descricao }}</strong><br>
                                    <small>Pessoa: {{ $ciclo->qexgzmnndqxmyks->apelido ?? '' }}</small>
                                </td>
                                <td class="text-left py-1">
                                    <small>Banco: {{ $ciclo->yaapdycfbplzkeg->nome ?? '' }}</small><br>
                                    <small>{{ $ciclo->qlwiqwuheqlefkd->titulo ?? '' }}</small>
                                </td>
                                <td class="text-right py-1 text-{{ $ciclo->color }}"><strong>{{ number_format($ciclo->vlr_final, 2, ',', '.') }}</strong></td>
                                <td class="text-right py-1 text-{{ $saldo < 0 ? 'danger' : 'success' }}"><strong>{{ number_format($saldo, 2, ',', '.') }}</strong></td>


                                <td class="text-right py-1">
                                    <x-icon.view click="{{ $ciclo->id }}" />
                                    &nbsp;
                                    <x-icon.edit click="{{ $ciclo->id }}" />
                                    &nbsp;
                                    <x-icon.delete click="{{ $ciclo->id }}" />
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
                            <td></td>
                            <td class="text-right"><strong>{{ number_format($receita + $transfe - $despesa, 2, ',', '.') }}</strong></td>
                            <td></td>
                        </tr>
                    </tfoot>
                </table>
            </div>
            <div class="card-footer clearfix">
                <div class="float-right">
                    {{-- {{ $lancamentos->links() }} --}}
                </div>
            </div>
        </div>
    </div>
    @include('livewire.financeiro.lancamento.adicionar')
    @include('livewire.financeiro.lancamento.show')
</div>
