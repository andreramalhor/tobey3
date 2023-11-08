<div>
  <div class="row">
    <div class="col-md-12">
      <div class="card card-default">
        <form wire:submit="save">
          <div class="card-header">
            <h3 class="card-title">Lançamento</h3>
          </div>

          <div class="card-body">
            <div class="row">

              <div class="col-sm-2">
                <div class="form-group">
                  <label for="tipo">Tipo</label>  
                  <select class="form-control form-control-sm @error('tipo') is-invalid @enderror" wire:model="tipo">
                    <option value="R">Receita</option>
                    <option value="D">Despesa</option>
                    <option value="T" disabled>Transferência</option>
                  </select>
                  @error("tipo")<span class="text-danger">{{ $message }}</spam>@enderror
                </div>
              </div>

              <div class="col-sm-2">
                <div class="form-group">
                  <label for="dt_competencia">Data de competência</label>
                  <input type="date" class="form-control form-control-sm @error('dt_competencia') is-invalid @enderror" wire:model="dt_competencia">
                  @error("dt_competencia")<span class="text-danger">{{ $message }}</spam>@enderror
                </div>
              </div>
              
              <div class="col-sm-2">
                <div class="form-group">
                  <label for="dt_vencimento">Data de vencimento</label>
                  <input type="date" class="form-control form-control-sm @error('dt_vencimento') is-invalid @enderror" wire:model="dt_vencimento">
                  @error("dt_vencimento")<span class="text-danger">{{ $message }}</spam>@enderror
                </div>
              </div>
              
              <div class="col-sm-2">
                <div class="form-group">
                  <label for="dt_recebimento">Data de recebimento</label>
                  <input type="date" class="form-control form-control-sm @error('dt_recebimento') is-invalid @enderror" wire:model="dt_recebimento">
                  @error("dt_recebimento")<span class="text-danger">{{ $message }}</spam>@enderror
                </div>
              </div>
              
              <div class="col-sm-2">
                <div class="form-group">
                  <label for="dt_confirmacao">Data de confirmação</label>
                  <input type="date" class="form-control form-control-sm @error('dt_confirmacao') is-invalid @enderror" wire:model="dt_confirmacao">
                  @error("dt_confirmacao")<span class="text-danger">{{ $message }}</spam>@enderror
                </div>
              </div>
              
              <div class="col-sm-2">
                <div class="form-group">
                  <label for="dt_pagamento">Data de pagamento</label>
                  <input type="date" class="form-control form-control-sm @error('dt_pagamento') is-invalid @enderror" wire:model="dt_pagamento">
                  @error("dt_pagamento")<span class="text-danger">{{ $message }}</spam>@enderror
                </div>
              </div>
              
              <div class="col-sm-3">
                <div class="form-group">
                  <label for="id_pessoa">Pessoa</label>
                  <select class="form-control form-control-sm @error('id_pessoa') is-invalid @enderror" wire:model="id_pessoa">
                    <option value=0>Selecione. . . </option>
                    @foreach($clientes as $key => $cliente)
                    <option value="{{ $key }}">{{ $cliente }}</option>
                    @endforeach
                  </select>
                  @error("id_pessoa")<span class="text-danger">{{ $message }}</spam>@enderror
                </div>
              </div>
              
              <div class="col-sm-5">
                <div class="form-group">
                  <label for="descricao">Descrição</label>
                  <input type="text" class="form-control form-control-sm @error('descricao') is-invalid @enderror" wire:model.live="descricao" placeholder="Descrição">
                  @error("descricao")<span class="text-danger">{{ $message }}</spam>@enderror
                </div>
              </div>
              
              <div class="col-sm-1">
                <div class="form-group">
                  <label for="num_documento">Núm. Doc.</label>
                  <input type="text" class="form-control form-control-sm text-right @error('num_documento') is-invalid @enderror" wire:model="num_documento" placeholder="Núm. Documento">
                  @error("num_documento")<span class="text-danger">{{ $message }}</spam>@enderror
                </div>
              </div>
              
              <div class="col-sm-1">
                <div class="form-group">
                  <label for="vlr_bruto">Valor Bruto</label>
                  <input type="text" class="form-control form-control-sm text-right @error('vlr_bruto') is-invalid @enderror" wire:model="vlr_bruto" placeholder="0,00">
                  @error("vlr_bruto")<span class="text-danger">{{ $message }}</spam>@enderror
                </div>
              </div>
              
              <div class="col-sm-1">
                <div class="form-group">
                  <label for="vlr_dsc_acr">Desc./Acrésc.</label>
                  <input type="text" class="form-control form-control-sm text-right @error('vlr_dsc_acr') is-invalid @enderror" wire:model="vlr_dsc_acr" placeholder="0,00">
                  @error("vlr_dsc_acr")<span class="text-danger">{{ $message }}</spam>@enderror
                </div>
              </div>
              
              <div class="col-sm-1">
                <div class="form-group">
                  <label for="vlr_final">Valor Pago</label>
                  <input type="text" class="form-control form-control-sm text-right @error('vlr_final') is-invalid @enderror" wire:model="vlr_final" placeholder="0,00">
                  @error("vlr_final")<span class="text-danger">{{ $message }}</spam>@enderror
                </div>
              </div>
              
              <div class="col-sm-2">
                <div class="form-group">
                  <label for="id_banco">Banco/Local</label>
                  <select class="form-control form-control-sm @error('id_banco') is-invalid @enderror" wire:model="id_banco">
                    <option value=0>Selecione. . . </option>
                    @foreach($bancos as $key => $banco)
                    <option value="{{ $key }}">{{ $banco }}</option>
                    @endforeach
                  </select>
                  @error("id_banco")<span class="text-danger">{{ $message }}</spam>@enderror
                </div>
              </div>
              
              <div class="col-sm-3">
                <div class="form-group">
                  <label for="id_conta">Conta Contábil</label>
                  <select class="form-control form-control-sm select2 @error('id_conta') is-invalid @enderror" wire:model="id_conta">
                    <option value=0>Selecione. . . </option>
                    @foreach($contas as $key => $conta)
                    <option value="{{ $key }}">{{ $conta }}</option>
                    @endforeach
                  </select>
                  @error("id_conta")<span class="text-danger">{{ $message }}</spam>@enderror
                </div>
              </div>
              
              <div class="col-sm-2">
                <div class="form-group">
                  <label for="centro_custo">Centro de custo</label>
                  <select class="form-control form-control-sm @error('centro_custo') is-invalid @enderror" wire:model="centro_custo">
                    <option>Converta Soluções</option>
                    <option>Marketing</option>
                    <option>Call Center</option>
                    <option>Investimento André</option>
                  </select>
                  @error("centro_custo")<span class="text-danger">{{ $message }}</spam>@enderror
                </div>
              </div>
              
              <div class="col-sm-2">
                <div class="form-group">
                  <label for="id_forma_pagamento">Forma de pagamento</label>
                  <select class="form-control form-control-sm @error('id_forma_pagamento') is-invalid @enderror" wire:model="id_forma_pagamento">
                    <option value=0>Selecione. . . </option>
                    @foreach($formas_pagamentos as $forma)
                    <option value="{{ $forma->forma }}">{{ $forma->forma }}</option>
                    @endforeach
                  </select>
                  @error("id_forma_pagamento")<span class="text-danger">{{ $message }}</spam>@enderror
                </div>
              </div>
              
              <div class="col-sm-1">
                <div class="form-group">
                  <label for="parcela">Parcela</label>
                  <input type="text" class="form-control form-control-sm text-right @error('parcela') is-invalid @enderror" wire:model="parcela">
                  @error("parcela")<span class="text-danger">{{ $message }}</spam>@enderror
                </div>
              </div>
              
              <div class="col-sm-2">
                <div class="form-group">
                  <label for="status">Status</label>
                  <input type="text" class="form-control form-control-sm text-right @error('status') is-invalid @enderror" wire:model="status" placeholder="status">
                  @error("status")<span class="text-danger">{{ $message }}</spam>@enderror
                </div>
              </div>

            </div>
          </div>
          
          <div class="card-footer justify-content-between">
            <button type="submit" class="btn btn-default" wire:target="save">Efetuar lançamento</button>
          </div>

        </form>
      </div>
    </div>
  </div>
</div>
