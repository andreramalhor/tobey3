<ul class="todo-list">
    <label>Sobre o compra</label>
    <li>
        <div class="row">
            <div class="col-sm-2">
                <div class="form-group">
                    <label for="fin_compras_pagamentos_id">id</label>
                    <input type="text" class="form-control form-control-sm @error('fin_compras_pagamentos_id') is-invalid @enderror" wire:model="fin_compras_pagamentos_id" placeholder="id">
                    @error('fin_compras_pagamentos_id')<div class="invalid-feedback">{{ $message }}</div>@enderror
                </div>
            </div>
            <div class="col-sm-2">
                <div class="form-group">
                    <label for="fin_compras_pagamentos_id_compra">id_compra</label>
                    <input type="text" class="form-control form-control-sm @error('fin_compras_pagamentos_id_compra') is-invalid @enderror" wire:model="fin_compras_pagamentos_id_compra" placeholder="id_compra">
                    @error('fin_compras_pagamentos_id_compra')<div class="invalid-feedback">{{ $message }}</div>@enderror
                </div>
            </div>
            <div class="col-sm-2">
                <div class="form-group">
                    <label for="fin_compras_pagamentos_id_forma_pagamento">id_forma_pagamento</label>
                    <input type="text" class="form-control form-control-sm @error('fin_compras_pagamentos_id_forma_pagamento') is-invalid @enderror" wire:model="fin_compras_pagamentos_id_forma_pagamento" placeholder="id_forma_pagamento">
                    @error('fin_compras_pagamentos_id_forma_pagamento')<div class="invalid-feedback">{{ $message }}</div>@enderror
                </div>
            </div>
            <div class="col-sm-2">
                <div class="form-group">
                    <label for="fin_compras_pagamentos_descricao">descricao</label>
                    <input type="text" class="form-control form-control-sm @error('fin_compras_pagamentos_descricao') is-invalid @enderror" wire:model="fin_compras_pagamentos_descricao" placeholder="descricao">
                    @error('fin_compras_pagamentos_descricao')<div class="invalid-feedback">{{ $message }}</div>@enderror
                </div>
            </div>
            <div class="col-sm-2">
                <div class="form-group">
                    <label for="fin_compras_pagamentos_parcela">parcela</label>
                    <input type="text" class="form-control form-control-sm @error('fin_compras_pagamentos_parcela') is-invalid @enderror" wire:model="fin_compras_pagamentos_parcela" placeholder="parcela">
                    @error('fin_compras_pagamentos_parcela')<div class="invalid-feedback">{{ $message }}</div>@enderror
                </div>
            </div>
            <div class="col-sm-2">
                <div class="form-group">
                    <label for="fin_compras_pagamentos_valor">valor</label>
                    <input type="text" class="form-control form-control-sm @error('fin_compras_pagamentos_valor') is-invalid @enderror" wire:model="fin_compras_pagamentos_valor" placeholder="valor">
                    @error('fin_compras_pagamentos_valor')<div class="invalid-feedback">{{ $message }}</div>@enderror
                </div>
            </div>
            <div class="col-sm-2">
                <div class="form-group">
                    <label for="fin_compras_pagamentos_dt_prevista">dt_prevista</label>
                    <input type="text" class="form-control form-control-sm @error('fin_compras_pagamentos_dt_prevista') is-invalid @enderror" wire:model="fin_compras_pagamentos_dt_prevista" placeholder="dt_prevista">
                    @error('fin_compras_pagamentos_dt_prevista')<div class="invalid-feedback">{{ $message }}</div>@enderror
                </div>
            </div>
            <div class="col-sm-2">
                <div class="form-group">
                    <label for="fin_compras_pagamentos_status">status</label>
                    <input type="text" class="form-control form-control-sm @error('fin_compras_pagamentos_status') is-invalid @enderror" wire:model="fin_compras_pagamentos_status" placeholder="status">
                    @error('fin_compras_pagamentos_status')<div class="invalid-feedback">{{ $message }}</div>@enderror
                </div>
            </div>
        </div>
    </li>
</ul>
