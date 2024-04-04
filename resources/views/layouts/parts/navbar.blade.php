<nav class="main-header navbar navbar-expand navbar-dark navbar-blue text-sm">
    <ul class="navbar-nav">

        {{-- @if(1==2) --}}
            {{-- @can('Sócios') --}}
            <li class="nav-item">
                <a class="nav-link" data-widget="pushmenu" href="#" role="button"><i class="fas fa-bars"></i></a>
            </li>
            {{-- @endcan --}}
        {{-- @endif --}}

        <x-adminlte.layouts.navbar-links href="{{ route('dashboard') }}" icon="<i class='fa-solid fa-gauge-high'></i>" tooltip="Dashboard" />

        <x-adminlte.layouts.navbar-links href="{{ route('condominios') }}" icon="<i class='fa-regular fa-building'></i>" tooltip="Condomínios" />

        {{-- @can('Sócios') --}}
        <!-- can('Lançamentos.Visualizar') -->
        <x-adminlte.layouts.navbar-links icon="<i class='fa-solid fa-users'></i>" tooltip="Atendimento">
            <li><a class="dropdown-item" href="{{ route('atd.pessoas') }}">Pessoas</a></li>
            <li><a class="dropdown-item" href="{{ route('atd.clientes') }}">Clientes</a></li>
            <li><a class="dropdown-item" href="{{ route('atd.agendamentos') }}">Agendamentos</a></li>
        </x-adminlte.layouts.navbar-links>
        {{-- @endcan --}}

        <x-adminlte.layouts.navbar-links icon="<i class='fa-solid fa-solid fa-book-open'></i>" tooltip="Catálogo">
            <li><a class="dropdown-item" href="{{ route('cat.categorias') }}">Categorias</a></li>
            <li><a class="dropdown-item" href="{{ route('cat.servicos') }}">Serviços</a></li>
            <li><a class="dropdown-item" href="{{ route('cat.produtos') }}">Produtos</a></li>
            <li><a class="dropdown-item" href="{{ route('cat.compras') }}">Compra de produtos</a></li>
        </x-adminlte.layouts.navbar-links>

        <x-adminlte.layouts.navbar-links icon="<i class='fa-solid fa-solid fa-handshake'></i>" tooltip="Comercial">
            <li><a class="dropdown-item" href="{{ route('com.leads.dashboard') }}">Dashboard</a></li>
            <li><a class="dropdown-item" href="{{ route('com.leads.comissoes') }}">Comissões</a></li>
            {{-- <li><a class="dropdown-item" href="{{ route('com.leads.criar') }}">Adicionar Lead</a></li> --}}
            {{-- <li><a class="dropdown-item" href="{{ route('com.leads.empresa') }}">Atendimento</a></li> --}}
            <li><a class="dropdown-item" href="{{ route('com.leads') }}">Visualizar Leads</a></li>
        </x-adminlte.layouts.navbar-links>

        {{-- @can('Sócios') --}}
        <!-- can('Lançamentos.Visualizar') -->
        <x-adminlte.layouts.navbar-links icon="<i class='fa-solid fa-solid fa-dollar'></i>" tooltip="Financeiro">
            <li><a class="dropdown-item" href="{{ route('fin.bancos') }}">Bancos</a></li>
            <li><a class="dropdown-item" href="{{ route('fin.lancamentos.dashboard') }}">Dashboard</a></li>
            <li><a class="dropdown-item" href="{{ route('fin.lancamentos.criar') }}">Lançamentos</a></li>
            <li><a class="dropdown-item" href="{{ route('fin.lancamentos') }}">Extrato de movimentações</a></li>
            <!-- <li><a class="dropdown-item" href="{{ route('fin.bancos') }}">Bancos</a></li> -->
        </x-adminlte.layouts.navbar-links>
        {{-- @endcan --}}

        {{-- @can('Sócios') --}}
        <!-- can('Lançamentos.Visualizar') -->
        <x-adminlte.layouts.navbar-links icon="<i class='fa-solid fa-solid fa-tools'></i>" tooltip="Ferramentas">
            <li><a class="dropdown-item" href="{{ route('fer.kanban.listar') }}">KanBan</a></li>
            {{-- <li><a class="dropdown-item" href="{{ route('fer.tarefas.listar') }}">Tarefas</a></li> --}}
        </x-adminlte.layouts.navbar-links>
        {{-- @endcan --}}

        {{-- @can('Sócios') --}}
        <!-- can('Lançamentos.Visualizar') -->
        <x-adminlte.layouts.navbar-links icon="<i class='fa-solid fa-solid fa-gear'></i>" tooltip="Configurações">
            <li><a class="dropdown-item" href="{{ route('cfg.sistema') }}">Opções de sistema</a></li>
            <li><a class="dropdown-item" href="{{ route('cfg.usuarios') }}">Usuários do sistema</a></li>
            {{-- <li><a class="dropdown-item" href="{{ route('fer.tarefas.listar') }}">Tarefas</a></li> --}}
        </x-adminlte.layouts.navbar-links>
        {{-- @endcan --}}

        {{-- @can('Sócios') --}}
        <!-- can('PDV.Visualizar') -->
        <x-adminlte.layouts.navbar-links icon="<i class='fa-solid fa-solid fa-store'></i>" tooltip="PDV">
            <li><a class="dropdown-item" href="{{ route('pdv.caixas') }}"><i class='fa-solid fa-solid fa-cash-register'></i> Caixas</a></li>
            <li><a class="dropdown-item" href="{{ route('pdv.vendas') }}"><i class='fa-solid fa-solid fa-receipt'></i> Vendas</a></li>
        </x-adminlte.layouts.navbar-links>
        {{-- @endcan --}}
    </ul>








    

    <ul class="navbar-nav ml-auto">
        <li class="nav-item dropdown user-menu">
            <a href="#" class="nav-link dropdown-toggle" data-bs-toggle="dropdown" id="nav-link-menu-user" role="button" aria-expanded="false">
                <img src="{{ auth()->user()->sdfjsefbdjfhufe->src_foto ?? null }}" class="user-image img-circle elevation-2">
            </a>
            <ul class="dropdown-menu-lg dropdown-menu dropdown-menu-end" aria-labelledby="nav-link-menu-user">
                <li class="user-header">
                    <img src="{{ auth()->user()->sdfjsefbdjfhufe->src_foto ?? null }}" class="img-circle elevation-2 d-inline">
                    <p class="">{{ auth()->user()->name ?? "NULO"}}<small>{{ auth()->user()->sdfjsefbdjfhufe->nome ?? "NULO" }}</small></p>
                </li>
                <li class="user-footer">
                    <a href="{{ route('profile.show') }}" class="btn btn-default btn-flat"><i class="fas fa-user"></i> Perfil</a>
                    <a class="btn btn-default btn-flat float-right " href="#" onclick="event.preventDefault(); document.getElementById('logout-form').submit();"><i class="fa fa-fw fa-power-off"></i>Sair</a>
                    <form id="logout-form" action="{{ route('logout') }}" method="POST" style="display: none;">@csrf</form>
                </li>
            </ul>
        </li>
    </ul>

    {{-- <ul class="navbar-nav ml-auto">
        @if(1==2)
            @can('Administrador do sistema')
            <li class="nav-item">
                <a class="nav-link" data-widget="navbar-search" href="#" role="button">
                    <i class="fas fa-search"></i>
                </a>
                <div class="navbar-search-block">
                    <form class="form-inline">
                        <div class="input-group input-group-sm">
                            <input class="form-control form-control-navbar" type="search" placeholder="Search" aria-label="Search">
                            <div class="input-group-append">
                                <button class="btn btn-navbar" type="submit">
                                    <i class="fas fa-search"></i>
                                </button>
                                <button class="btn btn-navbar" type="button" data-widget="navbar-search">
                                    <i class="fas fa-times"></i>
                                </button>
                            </div>
                        </div>
                    </form>
                </div>
            </li>
            <li class="nav-item dropdown">
                <a class="nav-link" data-toggle="dropdown" href="#">
                    <i class="far fa-comments"></i>
                    <span class="badge badge-danger navbar-badge">3</span>
                </a>
                <div class="dropdown-menu dropdown-menu-lg dropdown-menu-right">
                    <a href="#" class="dropdown-item">
                        <div class="media">
                            <img src="https://adminlte.io/themes/v3/dist/img/user1-128x128.jpg" alt="User Avatar" class="img-size-50 mr-3 img-circle">
                            <div class="media-body">
                                <h3 class="dropdown-item-title">
                                    Brad Diesel
                                    <span class="float-right text-sm text-danger"><i class="fas fa-star"></i></span>
                                </h3>
                                <p class="text-sm">Call me whenever you can...</p>
                                <p class="text-sm text-muted"><i class="far fa-clock mr-1"></i>4 Hours Ago</p>
                            </div>
                        </div>
                    </a>
                    <div class="dropdown-divider"></div>
                    <a href="#" class="dropdown-item">
                        <div class="media">
                            <img src="https://adminlte.io/themes/v3/dist/img/user8-128x128.jpg" alt="User Avatar" class="img-size-50 img-circle mr-3">
                            <div class="media-body">
                                <h3 class="dropdown-item-title">
                                    John Pierce
                                    <span class="float-right text-sm text-muted"><i class="fas fa-star"></i></span>
                                </h3>
                                <p class="text-sm">I got your message bro</p>
                                <p class="text-sm text-muted"><i class="far fa-clock mr-1"></i>4 Hours Ago</p>
                            </div>
                        </div>
                    </a>
                    <div class="dropdown-divider"></div>
                    <a href="#" class="dropdown-item">
                        <div class="media">
                            <img src="https://adminlte.io/themes/v3/dist/img/user3-128x128.jpg" alt="User Avatar" class="img-size-50 img-circle mr-3">
                            <div class="media-body">
                                <h3 class="dropdown-item-title">
                                    Nora Silvester
                                    <span class="float-right text-sm text-warning"><i class="fas fa-star"></i></span>
                                </h3>
                                <p class="text-sm">The subject goes here</p>
                                <p class="text-sm text-muted"><i class="far fa-clock mr-1"></i>4 Hours Ago</p>
                            </div>
                        </div>
                    </a>
                    <div class="dropdown-divider"></div>
                    <a href="#" class="dropdown-item dropdown-footer">See All Messages</a>
                </div>
            </li>
            <li class="nav-item dropdown">
                <a class="nav-link" data-toggle="dropdown" href="#">
                    <i class="far fa-bell"></i>
                    <span class="badge badge-warning navbar-badge">15</span>
                </a>
                <div class="dropdown-menu dropdown-menu-lg dropdown-menu-right">
                    <span class="dropdown-item dropdown-header">15 Notifications</span>
                    <div class="dropdown-divider"></div>
                    <a href="#" class="dropdown-item">
                        <i class="fas fa-envelope mr-2"></i>4 new messages
                        <span class="float-right text-muted text-sm">3 mins</span>
                    </a>
                    <div class="dropdown-divider"></div>
                    <a href="#" class="dropdown-item">
                        <i class="fas fa-users mr-2"></i>8 friend requests
                        <span class="float-right text-muted text-sm">12 hours</span>
                    </a>
                    <div class="dropdown-divider"></div>
                    <a href="#" class="dropdown-item">
                        <i class="fas fa-file mr-2"></i>3 new reports
                        <span class="float-right text-muted text-sm">2 days</span>
                    </a>
                    <div class="dropdown-divider"></div>
                    <a href="#" class="dropdown-item dropdown-footer">See All Notifications</a>
                </div>
            </li>
            <li class="nav-item">
                <a class="nav-link" data-widget="fullscreen" href="#" role="button">
                    <i class="fas fa-expand-arrows-alt"></i>
                </a>
            </li>
            <li class="nav-item">
                <a class="nav-link" data-widget="control-sidebar" data-controlsidebar-slide="true" href="#" role="button">
                    <i class="fas fa-th-large"></i>
                </a>
            </li>
            @endcan
        @endif
        <x-dropdown align="right" width="48">
            <x-slot name="trigger">
                @if (Laravel\Jetstream\Jetstream::managesProfilePhotos())
                    <button class="nav-item dropdown user-menu">
                        <img class="h-6 w-6 rounded-full object-cover" src="{{ Auth::user()->profile_photo_url }}" alt="{{ Auth::user()->name }}" />
                    </button>
                @else
                    <span class="inline-flex rounded-md">
                        <button type="button" class="inline-flex items-center px-3 py-2 border border-transparent text-sm leading-4 font-medium rounded-md text-gray-500 dark:text-gray-400 bg-white dark:bg-gray-800 hover:text-gray-700 dark:hover:text-gray-300 focus:outline-none focus:bg-gray-50 dark:focus:bg-gray-700 active:bg-gray-50 dark:active:bg-gray-700 transition ease-in-out duration-150">
                            {{ Auth::user()->name }}
                            <svg class="ml-2 -mr-0.5 h-4 w-4" xmlns="http://www.w3.org/2000/svg" fill="none" viewBox="0 0 24 24" stroke-width="1.5" stroke="currentColor">
                                <path stroke-linecap="round" stroke-linejoin="round" d="M19.5 8.25l-7.5 7.5-7.5-7.5" />
                            </svg>
                        </button>
                    </span>
                @endif
            </x-slot>

            <x-slot name="content">
                <!-- Account Management -->
                <div class="block px-4 py-2 text-xs text-gray-400">
                    {{ __('Manage Account') }}
                </div>

                <x-dropdown-link href="{{ route('profile.show') }}">
                    {{ __('Profile') }}
                </x-dropdown-link>

                @if (Laravel\Jetstream\Jetstream::hasApiFeatures())
                    <x-dropdown-link href="{{ route('api-tokens.index') }}">
                        {{ __('API Tokens') }}
                    </x-dropdown-link>
                @endif

                <div class="border-t border-gray-200 dark:border-gray-600"></div>

                <!-- Authentication -->
                <form method="POST" action="{{ route('logout') }}" x-data>
                    @csrf

                    <x-dropdown-link href="{{ route('logout') }}"
                            @click.prevent="$root.submit();">
                        {{ __('Log Out') }}
                    </x-dropdown-link>
                </form>
            </x-slot>
        </x-dropdown>
    </ul> --}}
</nav>
