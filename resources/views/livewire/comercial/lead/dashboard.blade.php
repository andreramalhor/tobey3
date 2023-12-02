<div>
    <section class="content pt-3">
        <div class="container-fluid">
            <div class="row">
                <div class="col-md-9">
                    <h5 class="mb-2">Gráfico de desempenho</h5>
                    <div class="row">
                        <div class="col-md-12">
                            <div class="row">
                                <div class="col-md-3">
                                    <div class="info-box mb-3">
                                        <span class="info-box-icon bg-success elevation-1"><i class="fas fa-shopping-cart"></i></span>
                                        <div class="info-box-content">
                                            <span class="info-box-text">Leads cadastrados no mês</span>
                                            <span class="info-box-number">{{ $total_cadastro_mes }}</span>
                                        </div>
                                    </div>
                                </div>
                                <div class="col-md-3">
                                    <div class="info-box mb-3">
                                        <span class="info-box-icon bg-warning elevation-1"><i class="fas fa-shopping-cart"></i></span>
                                        <div class="info-box-content">
                                            <span class="info-box-text">Leads cadastrados no dia</span>
                                            <span class="info-box-number">{{ $total_cadastro_dia }}</span>
                                        </div>
                                    </div>
                                </div>
                                <div class="col-md-3">
                                    <div class="info-box mb-3">
                                        <span class="info-box-icon bg-secondary elevation-1"><i class="fas fa-money-bill"></i></span>
                                        <div class="info-box-content">
                                            <span class="info-box-text">Vendas no mês</span>
                                            <span class="info-box-number">{{ $total_vendas_mes }}</span>
                                        </div>
                                    </div>
                                </div>
                                <div class="col-md-3">
                                    <div class="info-box mb-3">
                                        <span class="info-box-icon bg-info elevation-1"><i class="fas fa-money-bill"></i></span>
                                        <div class="info-box-content">
                                            <span class="info-box-text">Vendas no dia</span>
                                            <span class="info-box-number">{{ $total_vendas_dia }}</span>
                                        </div>
                                    </div>
                                </div>
                            </div>
                        </div>
                        <div class="col-md-12">
                            <x-auxiliar.kanban />
                        </div>
                    </div>
                </div>
                <div class="col-md-3">
                    <h5 class="mb-2">Últimos atendimentos</h5>
                    <div class="row">
                        <div class="card">
                            <div class="card-body p-0">
                                <ul class="products-list product-list-in-card pl-2 pr-2">
                                    @foreach(App\Models\Atendimento\Pessoa::vendedores()->get() as $vendedor)
                                    <li class="item">
                                        <div class="product-img">
                                            <img src="{{ $vendedor->src_foto }}" class="img-size-50">
                                        </div>
                                        <div class="product-info">
                                            <a class="product-title">{{ $vendedor->apelido }}
                                                <span class="badge badge-warning float-right">
                                                    {{ getTimeDifference(App\Models\Comercial\LeadConversa::last_atendimento($vendedor->id)->created_at ?? \Carbon\Carbon::now()) }}
                                                </span>
                                            </a>
                                            <span class="product-description"></span>
                                        </div>
                                    </li>
                                    @endforeach
                                </ul>
                            </div>

                            @php
                                function getTimeDifference($startTime) {
                                    $currentTime = \Carbon\Carbon::now();
                                    $difference = $currentTime->diff($startTime);
                                    return $difference->format('%H:%I:%S');
                                }
                            @endphp
                        </div>
                    </div>

                    <h5 class="mb-2">Ranking empresas</h5>
                    <div class="row">
                        <div class="card">
                            <div class="card-body p-0">
                                <div class="table-responsive">
                                    <table class="table m-0">
                                        <thead>
                                            <tr>
                                                <th>#</th>
                                                <th>Nome</th>
                                                <th>Mês</th>
                                                <th>Dia</th>
                                            </tr>
                                        </thead>
                                        <tbody>
                                            @php
                                                $clientesSorted = App\Models\Atendimento\Pessoa::empresas()
                                                    ->get()
                                                    ->sortByDesc(function($clientes) {
                                                        return $clientes->sakljqekliwuwef()
                                                            ->whereBetween('created_at', [\Carbon\Carbon::now()->startOfMonth(), \Carbon\Carbon::now()->endOfMonth()])
                                                            ->count();
                                                    });
                                            @endphp

                                            @foreach($clientesSorted as $index => $clientes)
                                                <tr>
                                                    <td><img src="{{ $clientes->src_foto }}" class="img-size-50"></td>
                                                    <td>{{ $clientes->apelido }}</td>
                                                    <td>{{ $clientes->sakljqekliwuwef()->whereBetween('created_at', [\Carbon\Carbon::now()->startOfMonth(), \Carbon\Carbon::now()->endOfMonth()])->count() }}</td>
                                                    <td>{{ $clientes->sakljqekliwuwef()->whereBetween('created_at', [\Carbon\Carbon::now()->startOfDay(), \Carbon\Carbon::now()->endOfDay()])->count() }}</td>
                                                </tr>
                                            @endforeach
                                        </tbody>
                                    </table>
                                </div>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </section>
</div>


