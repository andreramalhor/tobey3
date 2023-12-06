<div class="row">
    <div class="col-md-3">
        <div class="card">
            <div class="overlay d-none" wire:loading.class="d-block"></div>
            <div class="card-body">
                <button type="button" class="btn btn-block btn-sm text-left @if($botao_usuarios == 'active') btn-primary @else btn-default @endif" wire:click="selecionarMenu('botao_usuarios')">Usuários do sistema</button>
                <button type="button" class="btn btn-block btn-sm text-left @if($botao_bancos == 'active') btn-primary @else btn-default @endif" wire:click="selecionarMenu('botao_bancos')">Bancos</button>
            </div>
        </div>    
    </div>
    @if($botao_usuarios == 'active')
    <div class="col-md-9">
        @livewire('configuracao.usuario')
    </div>
    @endif

    @if($botao_bancos == 'active')
    <div class="col-md-9">
        <div class="card card-primary card-outline">
            <div class="card-header">
                <h3 class="card-title">Configurações do sistema</h3>
            </div>
            <div class="card-body p-0">
                <div class="row">
                    <div class="col-2 col-sm-2">
                        <div class="nav flex-column nav-tabs h-100" id="vert-tabs-tab" role="tablist" aria-orientation="vertical">
                            <a class="nav-link active" id="vert-tabs-home-tab" data-bs-toggle="pill" href="#vert-tabs-home" role="tab" aria-controls="vert-tabs-home" aria-selected="true">Home</a>
                            <a class="nav-link" id="vert-tabs-profile-tab" data-bs-toggle="pill" href="#vert-tabs-profile" role="tab" aria-controls="vert-tabs-profile" aria-selected="false">Profile</a>
                            <a class="nav-link" id="vert-tabs-messages-tab" data-bs-toggle="pill" href="#vert-tabs-messages" role="tab" aria-controls="vert-tabs-messages" aria-selected="false">Messages</a>
                            <a class="nav-link" id="vert-tabs-settings-tab" data-bs-toggle="pill" href="#vert-tabs-settings" role="tab" aria-controls="vert-tabs-settings" aria-selected="false">Settings</a>
                        </div>
                    </div>
                    <div class="col-10 col-sm-10 p-2">
                        <div class="tab-content" id="vert-tabs-tabContent">
                            <div class="tab-pane text-left fade show active" id="vert-tabs-home" role="tabpanel" aria-labelledby="vert-tabs-home-tab">
                                
                                
                                <div class="card-header">
                                    <h3 class="card-title">Usuários do Sistema</h3>
                                </div>
                                <div class="card-body p-0">
                                    <div class="row p-2">
                                        <div class="offset-md-8 col-md-2">
                                            <div class="input-group input-group-sm">
                                                <input type="text" class="form-control float-right" placeholder="Pesquisar" wire:model.live="pesquisar">
                                                <div class="input-group-append">
                                                    <button type="submit" class="btn btn-default">
                                                        <i class="fas fa-search"></i>
                                                    </button>
                                                </div>
                                            </div>
                                        </div>
                                        <div class="col-md-2">
                                            <a class="btn btn-primary btn-block btn-sm float-right" wire:click="create"><i class="fa fa-plus"></i> Adicionar usuário</a>
                                        </div>
                                    </div>
                                    <table class="table">
                                        <thead class="table-dark">
                                            <tr>
                                                <th class="text-center">#</th>
                                                <th class="text-left">Nome</th>
                                                <th class="text-left">E-mail</th>
                                                <th class="text-left">Tipos</th>
                                                <th class="text-right"><i class="fas fa-ellipsis-h"></i></th>
                                            </tr>
                                        </thead>
                                        <tbody>
                                            <tr>
                                                <td class="text-center">#</td>
                                                <td class="text-left">Nome</td>
                                                <td class="text-left">E-mail</td>
                                                <td class="text-left">Tipos</td>
                                                <td class="text-right"><i class="fas fa-ellipsis-h"></i></td>
                                            </tr>
                                            <tr>
                                                <td class="text-center">#</td>
                                                <td class="text-left">Nome</td>
                                                <td class="text-left">E-mail</td>
                                                <td class="text-left">Tipos</td>
                                                <td class="text-right"><i class="fas fa-ellipsis-h"></i></td>
                                            </tr>
                                            <tr>
                                                <td class="text-center">#</td>
                                                <td class="text-left">Nome</td>
                                                <td class="text-left">E-mail</td>
                                                <td class="text-left">Tipos</td>
                                                <td class="text-right"><i class="fas fa-ellipsis-h"></i></td>
                                            </tr>
                                            <tr>
                                                <td class="text-center">#</td>
                                                <td class="text-left">Nome</td>
                                                <td class="text-left">E-mail</td>
                                                <td class="text-left">Tipos</td>
                                                <td class="text-right"><i class="fas fa-ellipsis-h"></i></td>
                                            </tr>
                                            <tr>
                                                <td class="text-center">#</td>
                                                <td class="text-left">Nome</td>
                                                <td class="text-left">E-mail</td>
                                                <td class="text-left">Tipos</td>
                                                <td class="text-right"><i class="fas fa-ellipsis-h"></i></td>
                                            </tr>
                                            <tr>
                                                <td class="text-center">#</td>
                                                <td class="text-left">Nome</td>
                                                <td class="text-left">E-mail</td>
                                                <td class="text-left">Tipos</td>
                                                <td class="text-right"><i class="fas fa-ellipsis-h"></i></td>
                                            </tr>
                                            <tr>
                                                <td class="text-center">#</td>
                                                <td class="text-left">Nome</td>
                                                <td class="text-left">E-mail</td>
                                                <td class="text-left">Tipos</td>
                                                <td class="text-right"><i class="fas fa-ellipsis-h"></i></td>
                                            </tr>
                                        </tbody>
                                    </table>
                                </div>
                                <div class="card-footer clearfix">
                                    <div class="float-right">
                                        aaa    
                                    </div>
                                </div>
                            

                            </div>
                            
                            <div class="tab-pane fade" id="vert-tabs-profile" role="tabpanel" aria-labelledby="vert-tabs-profile-tab">
                                Mauris tincidunt mi at erat gravida, eget tristique urna bibendum. Mauris pharetra purus ut ligula tempor, et vulputate metus facilisis. Lorem ipsum dolor sit amet, consectetur adipiscing elit. Vestibulum ante ipsum primis in faucibus orci luctus et ultrices posuere cubilia Curae; Maecenas sollicitudin, nisi a luctus interdum, nisl ligula placerat mi, quis posuere purus ligula eu lectus. Donec nunc tellus, elementum sit amet ultricies at, posuere nec nunc. Nunc euismod pellentesque diam.
                            </div>
                            
                            <div class="tab-pane fade" id="vert-tabs-messages" role="tabpanel" aria-labelledby="vert-tabs-messages-tab">
                                Morbi turpis dolor, vulputate vitae felis non, tincidunt congue mauris. Phasellus volutpat augue id mi placerat mollis. Vivamus faucibus eu massa eget condimentum. Fusce nec hendrerit sem, ac tristique nulla. Integer vestibulum orci odio. Cras nec augue ipsum. Suspendisse ut velit condimentum, mattis urna a, malesuada nunc. Curabitur eleifend facilisis velit finibus tristique. Nam vulputate, eros non luctus efficitur, ipsum odio volutpat massa, sit amet sollicitudin est libero sed ipsum. Nulla lacinia, ex vitae gravida fermentum, lectus ipsum gravida arcu, id fermentum metus arcu vel metus. Curabitur eget sem eu risus tincidunt eleifend ac ornare magna.
                            </div>

                            <div class="tab-pane fade" id="vert-tabs-settings" role="tabpanel" aria-labelledby="vert-tabs-settings-tab">
                                Pellentesque vestibulum commodo nibh nec blandit. Maecenas neque magna, iaculis tempus turpis ac, ornare sodales tellus. Mauris eget blandit dolor. Quisque tincidunt venenatis vulputate. Morbi euismod molestie tristique. Vestibulum consectetur dolor a vestibulum pharetra. Donec interdum placerat urna nec pharetra. Etiam eget dapibus orci, eget aliquet urna. Nunc at consequat diam. Nunc et felis ut nisl commodo dignissim. In hac habitasse platea dictumst. Praesent imperdiet accumsan ex sit amet facilisis.
                            </div>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div>
    @endif
</div>
