@if ( $modalType == 'extrato' )
<div class="modal show" tabindex="-1" role="dialog" style="display: block;" >
    <div class="modal-dialog modal-xl" style="height: 100vh;">
        <div class="modal-content" style="height: calc(100% - 75px);"> <!-- Ajuste o valor 75px conforme necessário -->
            <form wire:submit.prevent="gravar">
                <div class="modal-header border-bottom-0 py-2 px-0">
                    <ul class="nav nav-tabs w-100">
                        <h3 class="card-title text-left pt-1 pr-5 pl-1 ml-2">Banco: {{ $bd_nome }}</h3>
                        <li class="nav-item">
                            <a class="nav-link active" data-bs-toggle="pill" href="#tab-extrato">Extrato</a>
                        </li>
                    </ul>
                </div>
                <div class="modal-body" style="overflow-y: auto;"> <!-- Adicionando barra de rolagem vertical -->
                    <div class="tab-content">
                        <div class="tab-pane fade show active" id="tab-extrato">
                            <div class="row">
                                <ul class="todo-list">
                                    <label>Período</label>
                                    <li>
                                        <div class="row">
                                            <div class="col-sm-4">
                                                <div class="form-group">
                                                    <label for="aux_periodo">De</label>
                                                    <input type="date" class="form-control form-control-sm @error('aux_periodo_inicial') is-invalid @enderror" wire:model="aux_periodo_inicial" placeholder="Nome">
                                                    @error('aux_periodo_inicial')<div class="invalid-feedback">{{ $message ?? 'teste de mensagem de erro'}}</div>@enderror
                                                </div>
                                            </div>
                                    
                                            <div class="col-sm-4">
                                                <div class="form-group">
                                                    <label for="aux_periodo_final">a:</label>
                                                    <input type="date" class="form-control form-control-sm @error('aux_periodo_final') is-invalid @enderror" wire:model="aux_periodo_final" placeholder="000">
                                                    @error('aux_periodo_final')<div class="invalid-feedback">{{ $message ?? 'teste de mensagem de erro'}}</div>@enderror
                                                </div>
                                            </div>
                                        </div>
                                    </li>
                                </ul>
                            </div>
                        </div>
                    </div>
                    <table class="table table-sm table-striped no-padding table-valign-middle projects">
                        <thead class="table-dark">
                          <tr>
                            <th class="text-center">#</th>
                            <th class="text-center">Data</th>
                            <th class="text-center">Tipo</th>
                            <th class="text-left">Descrição</th>
                            <th class="text-right">Valor</th>
                            <th class="text-right">Saldo</th>
                          </tr>
                        </thead>
                        <tbody>
                          <tr>
                            <td class="text-center">0</td>
                            <td class="text-center">{{ \Carbon\Carbon::today()->startOfMonth()->format('d/m/Y') }}</td>
                            <td class="text-center">
                              {{-- @if($lancamento->tipo == 'R') --}}
                                {{-- <small class="badge badge-success"> --}}
                              {{-- @elseif($lancamento->tipo == 'D') --}}
                                {{-- <small class="badge badge-danger"> --}}
                              {{-- @elseif($lancamento->tipo == 'T') --}}
                                {{-- <small class="badge badge-warning"> --}}
                              {{-- @endif --}}
                              {{-- {{ $lancamento->tipo }}</small> --}}
                            </td>
                            <td class="text-left">Saldo Anterior</td>
                            <td class="text-right"><span style="color: black">{{ number_format($aux_saldo_inicial, 2, ',', '.') }}</span></td>
                            <td class="text-right"><strong style="color:
                            @if($aux_saldo_inicial < 0)
                              red
                            @endif
                            ">{{ number_format($aux_saldo_inicial, 2, ',', '.') }}</strong></td>
                          </tr>        
                          @php $saldo = $aux_saldo_inicial; @endphp
                          @forelse($aux_extrato->sortBy('dt_recebimento') as $lancamento)
                          @php
                            if($lancamento->tipo == 'R')
                            {
                              $saldo = $saldo + $lancamento->vlr_final;
                            }
                            elseif($lancamento->tipo == 'D')
                            {
                              $saldo = $saldo - $lancamento->vlr_final;
                            }
                            elseif($lancamento->tipo == 'T')
                            {
                              $saldo = $saldo + $lancamento->vlr_final;
                            }
                            else
                            {
                              $saldo = $saldo + $lancamento->vlr_final;
                            }
                          @endphp
                            <tr>
                              <td class="text-center">{{ $lancamento->id }}</td>
                              <td class="text-center">{{ \Carbon\Carbon::parse($lancamento->dt_recebimento)->format('d/m/Y') }}</td>
                    
                              <td class="text-center">
                                @if($lancamento->tipo == 'R')
                                  <small class="badge badge-success">
                                @elseif($lancamento->tipo == 'D')
                                  <small class="badge badge-danger">
                                @elseif($lancamento->tipo == 'T')
                                  <small class="badge badge-warning">
                                @endif
                                {{ $lancamento->tipo }}</small>
                              </td>
                              <td class="text-left">
                                @if( $lancamento->getTable() == 'fin_lancamentos' )
                                  {{ $lancamento->descricao }}
                                @elseif( $lancamento->getTable() == 'fin_recebimentos_cartoes' )
                                  {{ $lancamento->gevmgwjvzgdexwm->forma .' - '. $lancamento->gevmgwjvzgdexwm->bandeira }}
                                @elseif( $lancamento->getTable() == 'fin_a_receber' )
                                  {{ 'Curso: '. $lancamento->nome .' | Parcela: '. $lancamento->parcela }}
                                @endif
                              </td>
                              <td class="text-right"><span style="color:
                                @if($lancamento->tipo == 'R')
                                  blue
                                @elseif($lancamento->tipo == 'D')
                                  red
                                @elseif($lancamento->tipo == 'T')
                                  black
                                @endif
                                ">{{ number_format($lancamento->vlr_final, 2, ',', '.') }}</td>
                              </span>
                              <td class="text-right"><strong style="color:
                              @if(round($saldo, 2) < 0)
                                red
                              @endif
                              ">{{ number_format($saldo, 2, ',', '.') }}</strong></td>
                            </tr>
                          @empty
                            <tr>
                              <td class="text-center" colspan="6">Não há resultados para essa tabela.</td>
                            </tr>
                          @endforelse
                        </tbody>
                      </table>
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
