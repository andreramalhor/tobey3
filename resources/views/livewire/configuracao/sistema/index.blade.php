<div class="row">
    <div class="col-md-3">
        <div class="card">
            <div class="overlay d-none" wire:loading.class="d-block"></div>
            <div class="card-body">
                <button type="button" class="btn btn-block btn-sm text-left @if($botao_usuarios == 'active') btn-secondary @else btn-default @endif" wire:click="selecionarMenu('botao_usuarios')">Usuários do sistema</button>
                <button type="button" class="btn btn-block btn-sm text-left @if($botao_bancos == 'active') btn-secondary @else btn-default @endif" wire:click="selecionarMenu('botao_bancos')">Bancos</button>
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
        @livewire('financeiro.banco')
    </div>
    @endif
</div>
