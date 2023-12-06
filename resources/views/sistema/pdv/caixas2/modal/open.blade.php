<div class="modal fade" tabindex="-1" role="dialog" aria-hidden="true" id="modal-caixa-open">
  <form action="{{ route('caixa.store') }}" method="POST" autocomplete="off" id="form_caixa_open">
    {!! csrf_field() !!}
    <div class="modal-dialog modal-lg">
      <div class="modal-content">
        <div class="modal-header">
          <h4 class="modal-title">Abrir Caixa</h4>
          <button type="button" class="close" data-bs-dismiss="modal" aria-label="Close">
            <span aria-hidden="true">×</span>
          </button>
        </div>
        <div class="modal-body">
          <div class="row">
            <input type="hidden" name="status" value="Aberto">
            <input type="hidden" name="dt_abertura" value="{{ \Carbon\Carbon::now() }}">
            <input type="hidden" name="id_usuario_abertura" value="{{ Auth::User()->id }}">
            <div class="col-4">
              <label class="col-form-label">Usuário</label>
              <input type="text" class="form-control form-control-sm " value="{{ Auth::User()->name }}" disabled="disabled">
            </div>
            <div class="col-4">
              <label class="col-form-label">Banco</label>
              <select class="form-control form-control-sm" name="id_banco" id="id_banco">
                <option>Selecione . . .</option>
                <option value="1">Caixa (Gaveta)</option>
                <option value="2">Sicoob Crediriodoce</option>
                <option value="3">Cofre</option>
                <option value="4">Caixa Econômica Federal</option>
                <option value="5">Caixa (Modelos)</option>
              </select>
            </div>
            <div class="col-4">
              <label class="col-form-label">Valor de Abertura do Caixa</label>
              <input type="text" class="form-control form-control-sm " value="" disabled="disabled">
            </div>
          </div>
        </div>
        <div class="modal-footer justify-content-between">
          <button type="reset" class="btn btn-default btn-xs" data-bs-dismiss="modal">Cancelar</button>
          <button type="submit" class="btn btn-primary btn-xs">Abrir</button>
        </div>
      </div>
    </div>
  </form>
</div>






{{-- <div class="col-xs-4 col-sm-4 col-md-4 form-group"> --}}
  {{-- {{ Form::label( 'id_usuario_abertura', '', ['style' => 'display: block;'] ) }} --}}
  {{-- {{ Form::input('text', null ,  }} --}}
{{-- </div> --}}
{{-- <div class="col-xs-4 col-sm-4 col-md-4 form-group"> --}}
  {{-- {{ Form::label( 'id_banco', 'Banco', ['style' => 'display: block;'] ) }} --}}
  {{-- {{ Form::select( 'id_banco', [ --}}
                {{-- 
                                            null => 'Selecione o local',
                                            '1' => 'Caixa (Gaveta)',
                                            '2' => 'Sicoob Crediriodoce',
                                            '3' => 'Cofre',
                                            '4' => 'Caixa Econômica Federal',
                                            '5' => 'Caixa (Modelos)',
                                          ] , null, [
                                            'class' => 'form-control input-sm',
                                          ]) }}
                                          --}}
                                        {{-- </div> --}}
                                        {{-- <div class="col-xs-4 col-sm-4 col-md-4 form-group"> --}}
                {{-- 
                {{ Form::label( 'vlr_abertura', 'Valor de Abertura do Caixa', ['style' => 'display: block;'] ) }}
                {{ Form::input('text','vlr_abertura', null, [
                                                      'id' => 'vlr_abertura1',
                                                      'placeholder' => '0,00',
                                                      'class' => 'form-control input-sm money',
                                                      'readonly' => 'readonly',
                                                      'style' => 'text-align: right;',
                                                      'mask' => '#.##0,00;',
                                                    ]) }}
              </div>
            </div>
          </div>
          <div class="modal-footer">
            <input type="reset" class="btn btn-default btn-sm pull-left" id="cancelar_caixa_open" value="Cancelar" data-bs-dismiss="modal">
            <input type="submit" class="btn btn-success btn-sm pull-right" id="submit_caixa_open" style="display: none;" value="Abrir Caixa">
          </div>
          <div class="overlay" id="overlay02" style="display: none;">
            <i class="fa fa-spinner fa-pulse"></i>
          </div>
        </div>
      </div>
    </div>
    </form> 
  </div>
</div>
--}}
