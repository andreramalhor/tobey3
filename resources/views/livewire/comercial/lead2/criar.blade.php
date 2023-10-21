<div>
  <div class="row">
    <div class="col-md-12">
      <div class="card card-default">
        <form wire:submit.prevent="save">
          <div class="card-header">
            <h3 class="card-title">Criar novo lead</h3>
          </div>

          <div class="card-body">
            <div class="row">
              <x-atendimento.pessoa.clientes-select col="6" label="Empresa" name="id_pessoa"/>

              <div class="col-sm-6">
                <div class="form-group">
                  <label for="id_consultor">Consultor</label>
                  <select class="form-control form-control-sm @error('id_consultor') is-invalid @enderror" wire:model.init="id_consultor" {{  \Auth::User()->kjahdkwkbewtoip->contains('nome', 'Vendedor') ? 'disabled' : '' }}>
                    <option>Selecione. . . </option>
                    @foreach($vendedores as $vendedor)
                    <option value="{{ $vendedor->id }}" {{  \Auth::User()->kjahdkwkbewtoip->contains('nome', 'Vendedor') ? 'selected' : '' }}>{{ $vendedor->nome }}</option>
                    @endforeach
                  </select>
                  @error("id_consultor")<span class="text-danger">{{ $message }}</spam>@enderror
                </div>
              </div>

              <div class="col-sm-8">
                <div class="form-group">
                  <label for="nome">Nome</label>
                  <input type="text" class="form-control form-control-sm @error('nome') is-invalid @enderror" wire:model.debouce.500ms="nome" placeholder="Nome">
                  @error("nome")<span class="text-danger">{{ $message }}</spam>@enderror
                </div>
              </div>
              <div class="col-sm-4">
                <div class="form-group">
                  <label for="telefone">Telefone</label>
                  <input type="text" class="form-control form-control-sm @error('telefone') is-invalid @enderror" wire:model.debouce.500ms="telefone" placeholder="Telefone">
                  @error("telefone")<span class="text-danger">{{ $message }}</spam>@enderror
                </div>
              </div>

              <div class="col-sm-4">
                <div class="form-group">
                  <label for="cidade">Cidade</label>
                  <input type="text" class="form-control form-control-sm @error('cidade') is-invalid @enderror" wire:model.debouce.500ms="cidade" placeholder="Cidade">
                  @error("cidade")<span class="text-danger">{{ $message }}</spam>@enderror
                </div>
              </div>
              <div class="col-sm-4">
                <div class="form-group">
                  <label for="email">Endereco</label>
                  <input type="text" class="form-control form-control-sm @error('endereco') is-invalid @enderror" wire:model.debouce.500ms="endereco" placeholder="Endereco">
                  @error("endereco")<span class="text-danger">{{ $message }}</spam>@enderror
                </div>
              </div>
              <div class="col-sm-4">
                <div class="form-group">
                  <label for="email">E-Mail</label>
                  <input type="text" class="form-control form-control-sm @error('email') is-invalid @enderror" wire:model.debouce.500ms="email" placeholder="E-Mail">
                  @error("email")<span class="text-danger">{{ $message }}</spam>@enderror
                </div>
              </div>

              <div class="col-sm-4">
                <div class="form-group">
                  <label for="id_origem">Origem</label>
                  <select class="form-control form-control-sm @error('id_origem') is-invalid @enderror" wire:model.init="id_origem">
                    @foreach($origens as $key => $origem)
                    <option value="{{ $key }}">{{ $origem }}</option>
                    @endforeach
                  </select>
                </div>
              </div>
              <div class="col-sm-4">
                <div class="form-group">
                  <label for="interesse">Interesse</label>
                  <select class="form-control form-control-sm @error('interesse') is-invalid @enderror" wire:model.init="interesse">
                    <option value="frio">Frio</option>
                    <option value="morno">Morno</option>
                    <option value="quente">Quente</option>
                  </select>
                </div>
              </div>

              <div class="col-sm-4">
                <div class="form-group">
                  <label for="status">Status</label>
                  <input type="text" class="form-control form-control-sm @error('status') is-invalid @enderror" wire:model.debouce.500ms="status" placeholder="Status">
                  @error("status")<span class="text-danger">{{ $message }}</spam>@enderror
                </div>
              </div>

              <div class="col-sm-12">
                <div class="form-group">
                  <label for="obs">Observação</label>
                  <input type="text" class="form-control form-control-sm @error('obs') is-invalid @enderror" wire:model.debouce.500ms="obs" placeholder="Observação">
                  @error("obs")<span class="text-danger">{{ $message }}</spam>@enderror
                </div>
              </div>

            </div>
          </div>

          <div class="card-footer justify-content-between">
            <button type="submit" class="btn btn-default" wire:target="save">Salvar lead</button>
          </div>

        </form>
      </div>
    </div>
  </div>
</div>
