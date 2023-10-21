<div wire:ignore.self class="modal fade" id="modal-adicionar" aria-hidden="true">
  <div class="modal-dialog modal-xl">
    <div class="modal-content">
      @php
      #disabled = $erros->any() ? true : false;
      @endphp
      <!-- <div class="overlay"> -->
        <!-- <i class="fas fa-2x fa-sync fa-spin"></i> -->
      <!-- </div> -->
      <div class="modal-header">
        <h4 class="modal-title">Adicionar lead</h4>
        <button type="button" class="close" data-bs-dismiss="modal" aria-label="Close">
          <span aria-hidden="true"><i class="fas fa-times"></i></span>
        </button>
      </div>
      
      <form wire:submit.prevent="save">    
        <div class="modal-body">
          <div class="row">
            <div class="col-sm-8">
              <div class="form-group">
                <label for="nome">Nome @error("nome") aaaa @enderror</label>
                <input type="text" class="form-control form-control-border" wire:model.debouce.500ms="nome" placeholder="Nome">
                @error("nome") <span class="text-danger">{{ $message }}</spam> @enderror
              </div>
            </div>
            <div class="col-sm-4">
              <div class="form-group">
                <label for="telefone">Telefone</label>
                <input type="text" class="form-control form-control-border" wire:model.debouce.500ms="telefone" placeholder="Telefone">
                @error("telefone") <span class="text-danger">{{ $message }}</spam> @enderror
              </div>
            </div>
            
            <div class="col-sm-4">
              <div class="form-group">
                <label for="cidade">Cidade</label>
                <input type="text" class="form-control form-control-border" wire:model.debouce.500ms="cidade" placeholder="Cidade">
                @error("cidade") <span class="text-danger">{{ $message }}</spam> @enderror
              </div>
            </div>
            <div class="col-sm-4">
              <div class="form-group">
                <label for="email">Endereco</label>
                <input type="text" class="form-control form-control-border" wire:model.debouce.500ms="endereco" placeholder="Endereco">
                @error("endereco") <span class="text-danger">{{ $message }}</spam> @enderror
              </div>
            </div>
            <div class="col-sm-4">
              <div class="form-group">
                <label for="email">E-Mail</label>
                <input type="text" class="form-control form-control-border" wire:model.debouce.500ms="email" placeholder="E-Mail">
                @error("email") <span class="text-danger">{{ $message }}</spam> @enderror
              </div>
            </div>
            
            <div class="col-sm-4">
              <div class="form-group">
                <label for="interesse">Interesse</label>
                <input type="text" class="form-control form-control-border" wire:model.debouce.500ms="interesse" placeholder="Interesse">
                @error("interesse") <span class="text-danger">{{ $message }}</spam> @enderror
              </div>
            </div>
            <div class="col-sm-4">
              <div class="form-group">
                <label for="id_origem">Origem</label>
                <input type="text" class="form-control form-control-border" wire:model.debouce.500ms="id_origem" placeholder="Origem">
                @error("id_origem") <span class="text-danger">{{ $message }}</spam> @enderror
              </div>
            </div>
            <div class="col-sm-4">
              <div class="form-group">
                <label for="status">Status</label>
                <input type="text" class="form-control form-control-border" wire:model.debouce.500ms="status" placeholder="Status">
                @error("status") <span class="text-danger">{{ $message }}</spam> @enderror
              </div>
            </div>
            
            <div class="col-sm-9">
              <div class="form-group">
                <label for="obs">Observacao</label>
                <input type="text" class="form-control form-control-border" wire:model.debouce.500ms="obs" placeholder="Observacao">
                @error("obs") <span class="text-danger">{{ $message }}</spam> @enderror
              </div>
            </div>
            <div class="col-sm-3">
              <div class="form-group">
                <label for="id_pessoa">Empresa</label>
                <input type="text" class="form-control form-control-border" wire:model.debouce.500ms="id_pessoa" placeholder="Empresa">
                @error("id_pessoa") <span class="text-danger">{{ $message }}</spam> @enderror
              </div>
            </div>
            
            <div class="col-sm-3">
              <div class="form-group">
                <label for="id_consultor">Consultor</label>
                <input type="text" class="form-control form-control-border" wire:model.debouce.500ms="id_consultor" placeholder="Consultor">
                @error("id_consultor") <span class="text-danger">{{ $message }}</spam> @enderror
              </div>
            </div>
            <div class="col-sm-9">
              <div class="form-group">
                <label for="obs">Conversa</label>
                <input type="text" class="form-control form-control-border" wire:model.debouce.500ms="conversa" placeholder="Conversa">
                @error("conversa") <span class="text-danger">{{ $message }}</spam> @enderror
              </div>
            </div>
            
          </div>
        </div>
        <div class="modal-footer justify-content-between">
          <button type="button" class="btn btn-default" data-bs-dismiss="modal">Close</button>
          <button type="submit" class="btn btn-primary" wire:target="save" wire:loading.attr="disabled" :disabled="$disabled">
          {{ __('Create') }}  
          Save changes</button>
        </div>
      </form>
    </div>
  </div>
</div>
