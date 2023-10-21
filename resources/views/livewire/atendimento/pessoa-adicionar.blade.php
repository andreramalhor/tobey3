<div wire:ignore.self class="modal fade" id="modal-pessoa-adicionar" aria-hidden="true">
  <div class="modal-dialog modal-xl">
    <div class="modal-content">
      <!-- <div class="overlay"-->
      <!--   <i class="fas fa-2x fa-sync fa-spin"></i-->
      <!-- </div-->
      <form wire:submit="save">
        <div class="modal-header">
          <h4 class="modal-title">Cadastrar pessoa</h4>
          <button type="button" class="close" data-bs-dismiss="modal" aria-label="Close">
            <span aria-hidden="true"><i class="fas fa-times"></i></span>
          </button>
        </div>
        <div class="modal-body">
          <div class="row">

            <ul class="todo-list">
              <li>
                <div class="row">
                  <x-adminlte.form.input.text name="kjahdkwkbewtoip" valor="Cliente" />
                  <x-adminlte.form.input.text col="3" label="Nome" name="nome" placeholder="Nome" />
{{--              <x-adminlte.form.input.text col="2" label="Apelido" name="apelido" placeholder="Apelido" /> --}}
                  <x-adminlte.form.input.date col="2" label="Data de nascimento" name="dt_nascimento" placeholder="Apelido" />
                  <x-adminlte.form.input.text col="2" label="E-mail" name="email" placeholder="E-mail" />
                  <x-adminlte.form.input.text col="2" label="CPF" name="cpf" placeholder="CPF" />
                  <x-adminlte.form.input.select col="1" label="Sexo" name="sexo" placeholder="sexo" >
                    <option value="F">F</option>
                    <option value="M">M</option>
                  </x-adminlte.form.input.select>
                  <x-adminlte.form.input.text col="2" label="Instagram" name="instagram" placeholder="instagram" />
                  <x-adminlte.form.input.text col="12" name="observacao" placeholder="Observação" />
                </div>
              </li>
              <br>
              <li>
                <div class="row">
                  <x-adminlte.form.input.text col="1" label="DDD" name="ddd" placeholder="DDD" />
                  <x-adminlte.form.input.text col="3" label="Telefone" name="telefone" placeholder="9 0000-0000" />
                </div>
              </li>
              <br>
              <li>
                <div class="row">
                  <x-adminlte.form.input.text col="2" label="CEP" name="cep" placeholder="CEP" />
                  <x-adminlte.form.input.text col="3" label="Logradouro" name="logradouro" placeholder="Logradouro" />
                  <x-adminlte.form.input.text col="1" label="Núm."  name="numero" placeholder=""  />
                  <x-adminlte.form.input.text col="2" label="Bairro" name="bairro" placeholder="Bairro" />
                  <x-adminlte.form.input.text col="3" label="Cidade" name="cidade" placeholder="Cidade" />
                  <x-adminlte.form.input.select col="1" label="UF" name="uf" placeholder="UF" >
                    <option value="AC">AC</option>
                    <option value="AL">AL</option>
                    <option value="AP">AP</option>
                    <option value="AM">AM</option>
                    <option value="BA">BA</option>
                    <option value="CE">CE</option>
                    <option value="DF">DF</option>
                    <option value="ES">ES</option>
                    <option value="GO">GO</option>
                    <option value="MA">MA</option>
                    <option value="MT">MT</option>
                    <option value="MS">MS</option>
                    <option value="MG" selected>MG</option>
                    <option value="PA">PA</option>
                    <option value="PB">PB</option>
                    <option value="PR">PR</option>
                    <option value="PE">PE</option>
                    <option value="PI">PI</option>
                    <option value="RJ">RJ</option>
                    <option value="RN">RN</option>
                    <option value="RS">RS</option>
                    <option value="RO">RO</option>
                    <option value="RR">RR</option>
                    <option value="SC">SC</option>
                    <option value="SP">SP</option>
                    <option value="SE">SE</option>
                    <option value="TO">TO</option>
                  </x-adminlte.form.input.select>
                </div>
              </li>
            </ul>
          </div>
        </div>
        <div class="modal-footer justify-content-between">
          <button type="button" class="btn btn-default" data-bs-dismiss="modal">Fechar</button>
          <button type="submit" class="btn btn-primary" wire:target="save">Gravar</button>
        </div>
      </form>
    </div>
  </div>
</div>