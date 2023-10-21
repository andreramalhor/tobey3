<div>
    <section class="content pt-3">
        <div class="container-fluid">
            <div class="row p-2">
                <ul class="pagination pagination-month justify-content-center">
                    <li class="page-item"><a class="page-link" wire:click="decrement">«</a></li>
                    <li class="page-item">
                        <a class="page-link">
                            <p class="page-month">Jul</p>
                            <p class="page-year">2023</p>
                        </a>
                    </li>
                    <li class="page-item">
                        <a class="page-link">
                            <p class="page-month">Ago</p>
                            <p class="page-year">2023</p>
                        </a>
                    </li>
                    <li class="page-item">
                        <a class="page-link">
                            <p class="page-month">Set</p>
                            <p class="page-year">2023</p>
                        </a>
                    </li>
                    <li class="page-item active">
                        <a class="page-link" name="periodo" wire:model.live="periodo">
                            <p class="page-month">Out</p>
                            <p class="page-year">2023</p>
                        </a>
                    </li>
                    <li class="page-item">
                        <a class="page-link">
                            <p class="page-month">Nov</p>
                            <p class="page-year">2023</p>
                        </a>
                    </li>
                    <li class="page-item">
                        <a class="page-link">
                            <p class="page-month">Dez</p>
                            <p class="page-year">2023</p>
                        </a>
                    </li>
                    <li class="page-item">
                        <a class="page-link">
                            <p class="page-month">Jan</p>
                            <p class="page-year">2024</p>
                        </a>
                    </li>
                    <li class="page-item"><a class="page-link" wire:click="increment">»</a></li>
                </ul>
            </div>
            <div wire:loading>Carregando . . . </div>
            <div class="row">
                <div class="col-12">
                    <div class="card">
                        <div class="card-header">
                            <h3 class="card-title">Dashboard</h3>
                        </div>
                        <div class="card-body p-0">
                            <div class="row">
                                <div class="col-12">
                                    <livewire:Financeiro.Lancamento.ChartAnual />
                                </div>                        
                            </div>
                        </div>
                    </div>
                </div>
            </div>
    
            <div class="row">
                <div class="col-6">
                    <div class="card">
                        <div class="card-header">
                            <h3 class="card-title">Clientes CallCenter</h3>
                        </div>
                        <div class="card-body p-0">
                            <div class="row p-2">
                                <table class="table table-sm">
                                    <thead class="table-dark">
                                        <tr>
                                            <th>#</th>
                                            <th>Data</th>
                                            <th>Cliente</th>
                                            <th>Banco</th>
                                            <th class="text-right">Valor</th>
                                        </tr>
                                    </thead>
                                    <tbody>
                                        @forelse($clientes_callcenter as $item)
                                        <tr>
                                            <td class="text-center">{{ $item->id }}</td>
                                            <td class="text-center">
                                                {{ isset($item->dt_pagamento) ? \Carbon\Carbon::parse($item->dt_pagamento)->format('d/m/Y') : '' }}
                                            </td>
                                            <td>
                                                {{ $item->qexgzmnndqxmyks->apelido ?? '' }}
                                            </td>
                                            <td class="text-center text-{{ !isset($item->yaapdycfbplzkeg) ? 'danger' : '' }}">
                                                <small>{{ $item->yaapdycfbplzkeg->nome ?? '(inadimplente)' }}</small><br>
                                            </td>
                                            <td class="text-right text-{{ $item->color }}"><strong>{{ number_format($item->vlr_final, 2, ',', '.') }}</strong></td>
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
                                            <td class="text-right">{{ number_format($clientes_callcenter->sum('vlr_final'), 2, ',', '.') }}</td>
                                        </tr>
                                    </tfoot>
                                </table>
                            </div>
                        </div>
                    </div>
                </div>
    
                <div class="col-6">
                    <div class="card">
                        <div class="card-header">
                            <h3 class="card-title">Clientes Marketing</h3>
                        </div>
                        <div class="card-body p-0">
                            <div class="row p-2">
                                <table class="table table-sm">
                                    <thead class="table-dark">
                                        <tr>
                                            <th>#</th>
                                            <th>Data</th>
                                            <th>Cliente</th>
                                            <th>Banco</th>
                                            <th class="text-right">Valor</th>
                                        </tr>
                                    </thead>
                                    <tbody>
                                        @forelse($clientes_marketing as $item)
                                        <tr>
                                            <td class="text-center">{{ $item->id }}</td>
                                            <td class="text-center">
                                                {{ \Carbon\Carbon::parse($item->dt_pagamento)->format('d/m/Y') }}
                                            </td>
                                            <td>
                                                {{ $item->qexgzmnndqxmyks->apelido ?? '' }}
                                            </td>
                                            <td class="text-center text-{{ !isset($item->yaapdycfbplzkeg) ? 'danger' : '' }}">
                                                <small>{{ $item->yaapdycfbplzkeg->nome ?? '(inadimplente)' }}</small><br>
                                            </td>
                                            <td class="text-right text-{{ $item->color }}"><strong>{{ number_format($item->vlr_final, 2, ',', '.') }}</strong></td>
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
                                            <td class="text-right">{{ number_format($clientes_marketing->sum('vlr_final'), 2, ',', '.') }}</td>
                                        </tr>
                                    </tfoot>
                                </table>
                            </div>
                        </div>
                    </div>
                </div>
            </div>

            <div class="row">
                <div class="col-6">
                    <div class="card">
                        <div class="card-header">
                            <h3 class="card-title">Despesas com Pessoal</h3>
                        </div>
                        <div class="card-body p-0">
                            <div class="row p-2">
                                <table class="table table-sm">
                                    <thead class="table-dark">
                                        <tr>
                                            <th>Pessoa</th>
                                            <th class="text-right">CallCenter</th>
                                            <th class="text-right">Marketing</th>
                                            <th class="text-right">Converta Soluções</th>
                                            <th class="text-right">Total</th>
                                        </tr>
                                    </thead>
                                    <tbody>
                                        @forelse($pessoal->groupBy('id_pessoa') as $itens)
                                        <tr>
                                            <td><strong>{{ $itens->first()->qexgzmnndqxmyks->apelido ?? '(sem nome)' }}</strong></td>
                                       </tr>
                                            @forelse($itens->groupBy('id_conta') as $centro)
                                            <tr>
                                                <td class="text-left">{{ $centro->first()->qlwiqwuheqlefkd->titulo ?? $item->id_conta }}</td>
                                                <td class="text-right">
                                                    @if($centro->first()->centro_custo == 'CallCenter')
                                                    {{ number_format($centro->where('centro_custo', '=', 'CallCenter')->sum('vlr_final'), 2, ',', '.') }}</td>
                                                    @else
                                                    0,00
                                                    @endif
                                                </td>
                                                <td class="text-right">
                                                    @if($centro->first()->centro_custo == 'Marketing')
                                                    {{ number_format($centro->where('centro_custo', '=', 'Marketing')->sum('vlr_final'), 2, ',', '.') }}</td>
                                                    @else
                                                    0,00
                                                    @endif
                                                </td>
                                                <td class="text-right">
                                                    @if($centro->first()->centro_custo == 'Converta Soluções')
                                                    {{ number_format($centro->where('centro_custo', '=', 'Converta Soluções')->sum('vlr_final'), 2, ',', '.') }}</td>
                                                    @else
                                                    0,00
                                                    @endif
                                                </td>
                                                <td class="text-right">
                                                    <strong>{{ number_format($centro->sum('vlr_final'), 2, ',', '.') }}</strong>
                                                </td>
                                            </tr>
                                            @empty
                                            <tr>
                                                <th colspan="7" class="text-center">Não há resultados para essa pesquisa.</th>
                                            </tr>
                                            @endforelse
                                        @empty
                                            <tr>
                                                <th colspan="7" class="text-center">Não há resultados para essa pesquisa.</th>
                                            </tr>
                                        @endforelse
                                    </tbody>
                                    <tfoot>
                                        <tr>
                                            <td></td>
                                            <td class="text-right"><strong>{{ number_format($pessoal->where('centro_custo', '=', 'CallCenter')->sum('vlr_final'), 2, ',', '.') }}</strong></td>
                                            <td class="text-right"><strong>{{ number_format($pessoal->where('centro_custo', '=', 'Marketing')->sum('vlr_final'), 2, ',', '.') }}</strong></td>
                                            <td class="text-right"><strong>{{ number_format($pessoal->where('centro_custo', '=', 'Converta Soluções')->sum('vlr_final'), 2, ',', '.') }}</strong></td>
                                            <td class="text-right"><strong>{{ number_format($pessoal->sum('vlr_final'), 2, ',', '.') }}</strong></td>
                                        </tr>
                                    </tfoot>
                                </table>
                            </div>
                        </div>
                    </div>
                </div>
            </div>

        </div>
    </section>
</div>