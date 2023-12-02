@if ( $modalType == 'criar' )
<div class="modal show" tabindex="-1" role="dialog" style="display: block;" >
    <div class="modal-dialog modal-xl w-90">
        <div class="modal-content">
            <form wire:submit.prevent="gravarCompra">
                <div class="modal-header border-bottom-0 py-2 px-0">
                    <ul class="nav nav-tabs w-100">
                        <h3 class="card-title text-left pt-1 pr-5 pl-1 ml-2">Nova compra</h3>
                        <li class="nav-item">
                            <a class="nav-link active" data-bs-toggle="pill" href="#tab-compra">Dados da compra</a>
                        </li>
                        <li class="nav-item">
                            <a class="nav-link" data-bs-toggle="pill" href="#tab-produtos">Produtos</a>
                        </li>
                        <li class="nav-item">
                            <a class="nav-link" data-bs-toggle="pill" href="#tab-pagamento">Pagamento</a>
                        </li>
                    </ul>
                </div>
                <div class="modal-body">
                    <div class="tab-content">
                        <div class="tab-pane fade show active" id="tab-compra">
                            <div class="row">
                                @include('livewire.catalogo.compra.criar.1-passo')
                            </div>
                        </div>
                        <div class="tab-pane fade" id="tab-produtos">
                            <div class="row">
                                <div class="row">
                                    @include('livewire.catalogo.compra.criar.2-passo')
                                </div>
                            </div>
                        </div>
                        <div class="tab-pane fade" id="tab-pagamento">
                            <div class="row">
                                {{-- include('livewire.catalogo.compra.criar.3-passo') --}}
                            </div>
                        </div>
                    </div>
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
