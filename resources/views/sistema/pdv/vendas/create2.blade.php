@extends('layouts.app')

@section('content')
<form method="POST" action="{{ route('venda.store') }}" id="form_venda_create" autocomplete="off">
  @csrf
  <input type="hidden" name="id_criador" value="{{ Auth::User()->id }}">
  <input type="hidden" name="tipo" value="Venda">
  <input type="hidden" name="ativo" value="1">
  <div class="row">
    <div class="col-4">
      <div class="row">
        <div class="col-12">
          <div class="card">
            <div class="card-header">
              <h3 class="card-title">Cliente</h3>
              <div class="card-tools">
                <div class="btn-group">
                  <a class="btn btn-sm btn-default" href="#" ><i class="fas fa-plus"></i></a>
                  <a class="btn btn-sm btn-default" data-bs-toggle="modal" data-target="#modal_pesquisa" id="modal_pesquisa_modalzim"><i class="fas fa-filter"></i></a>
                </div>
              </div>
            </div>
            <div class="card-body">
              <div class="row">
                <div class="col-12">
                  <label class="col-form-label">Profissional<font color="red">*</font></label>
                  <select class="form-control form-control-sm" name="id_cliente" onchange="validar(this)">
                    <option value="">Selecione . . .</option>

                  </select>
                </div>
              </div>
            </div>
          </div>
        </div>
        <div class="col-12">
          <div class="card">
            <div class="card-header">
              <h3 class="card-title">Profissional</h3>
              <div class="card-tools">
                <div class="btn-group">
                  <a class="btn btn-sm btn-default" href="#" ><i class="fas fa-plus"></i></a>
                  <a class="btn btn-sm btn-default" data-bs-toggle="modal" data-target="#modal_pesquisa" id="modal_pesquisa_modalzim"><i class="fas fa-filter"></i></a>
                </div>
              </div>
            </div>
            <div class="card-body" style="padding: 0px;">
              <div class="row">
                <div class="col-2">
                  <div class="radio-group">
                    {{-- @foreach($profissionais as $profissional) --}}
                    {{-- <img src="{{ asset('/img/Atendimentos/Pessoas/Perfil/1.png') }}" class="img-circle" alt="User Image" width="25px"> --}}
                    <img src="{{ asset('img/Atendimentos/Pessoas/Perfil/1.png') }}" class="img-circle radio" alt="User Image" width="50px" style="margin: 5px;" id="profissa_1" data-value="1" data-origem="imagem" onclick="selecionaProfissional(this);" data-bs-tooltip="tooltip" data-bs-title="" data-original-title="1">
                    <img src="{{ asset('img/Atendimentos/Pessoas/Perfil/2.png') }}" class="img-circle radio" alt="User Image" width="50px" style="margin: 5px;" id="profissa_2" data-value="2" data-origem="imagem" onclick="selecionaProfissional(this);" data-bs-tooltip="tooltip" data-bs-title="" data-original-title="2">
                    <img src="{{ asset('img/Atendimentos/Pessoas/Perfil/3.png') }}" class="img-circle radio" alt="User Image" width="50px" style="margin: 5px;" id="profissa_3" data-value="3" data-origem="imagem" onclick="selecionaProfissional(this);" data-bs-tooltip="tooltip" data-bs-title="" data-original-title="3">
                    <img src="{{ asset('img/Atendimentos/Pessoas/Perfil/4.png') }}" class="img-circle radio" alt="User Image" width="50px" style="margin: 5px;" id="profissa_4" data-value="4" data-origem="imagem" onclick="selecionaProfissional(this);" data-bs-tooltip="tooltip" data-bs-title="" data-original-title="4">
                    <img src="{{ asset('img/Atendimentos/Pessoas/Perfil/5.png') }}" class="img-circle radio" alt="User Image" width="50px" style="margin: 5px;" id="profissa_5" data-value="5" data-origem="imagem" onclick="selecionaProfissional(this);" data-bs-tooltip="tooltip" data-bs-title="" data-original-title="5">
                    <img src="{{ asset('img/Atendimentos/Pessoas/Perfil/6.png') }}" class="img-circle radio" alt="User Image" width="50px" style="margin: 5px;" id="profissa_6" data-value="6" data-origem="imagem" onclick="selecionaProfissional(this);" data-bs-tooltip="tooltip" data-bs-title="" data-original-title="6">
                    <img src="{{ asset('img/Atendimentos/Pessoas/Perfil/7.png') }}" class="img-circle radio" alt="User Image" width="50px" style="margin: 5px;" id="profissa_7" data-value="7" data-origem="imagem" onclick="selecionaProfissional(this);" data-bs-tooltip="tooltip" data-bs-title="" data-original-title="7">
                    <img src="{{ asset('img/Atendimentos/Pessoas/Perfil/8.png') }}" class="img-circle radio" alt="User Image" width="50px" style="margin: 5px;" id="profissa_8" data-value="8" data-origem="imagem" onclick="selecionaProfissional(this);" data-bs-tooltip="tooltip" data-bs-title="" data-original-title="8">
                    <img src="{{ asset('img/Atendimentos/Pessoas/Perfil/9.png') }}" class="img-circle radio" alt="User Image" width="50px" style="margin: 5px;" id="profissa_9" data-value="9" data-origem="imagem" onclick="selecionaProfissional(this);" data-bs-tooltip="tooltip" data-bs-title="" data-original-title="9">
                    <img src="{{ asset('img/Atendimentos/Pessoas/Perfil/10.png') }}" class="img-circle radio" alt="User Image" width="50px" style="margin: 5px;" id="profissa_10" data-value="10" data-origem="imagem" onclick="selecionaProfissional(this);" data-bs-tooltip="tooltip" data-bs-title="" data-original-title="10">
                    <img src="{{ asset('img/Atendimentos/Pessoas/Perfil/11.png') }}" class="img-circle radio" alt="User Image" width="50px" style="margin: 5px;" id="profissa_11" data-value="11" data-origem="imagem" onclick="selecionaProfissional(this);" data-bs-tooltip="tooltip" data-bs-title="" data-original-title="11">
                    <img src="{{ asset('img/Atendimentos/Pessoas/Perfil/12.png') }}" class="img-circle radio" alt="User Image" width="50px" style="margin: 5px;" id="profissa_12" data-value="12" data-origem="imagem" onclick="selecionaProfissional(this);" data-bs-tooltip="tooltip" data-bs-title="" data-original-title="12">

                    <img src="{{ asset('img/Atendimentos/Pessoas/Perfil/1.png') }}" class="img-circle radio" alt="User Image" width="50px" style="margin: 5px;" id="profissa_1" data-value="1" data-origem="imagem" onclick="selecionaProfissional(this);" data-bs-tooltip="tooltip" data-bs-title="" data-original-title="1">
                    <img src="{{ asset('img/Atendimentos/Pessoas/Perfil/2.png') }}" class="img-circle radio" alt="User Image" width="50px" style="margin: 5px;" id="profissa_2" data-value="2" data-origem="imagem" onclick="selecionaProfissional(this);" data-bs-tooltip="tooltip" data-bs-title="" data-original-title="2">
                    <img src="{{ asset('img/Atendimentos/Pessoas/Perfil/3.png') }}" class="img-circle radio" alt="User Image" width="50px" style="margin: 5px;" id="profissa_3" data-value="3" data-origem="imagem" onclick="selecionaProfissional(this);" data-bs-tooltip="tooltip" data-bs-title="" data-original-title="3">
                    <img src="{{ asset('img/Atendimentos/Pessoas/Perfil/4.png') }}" class="img-circle radio" alt="User Image" width="50px" style="margin: 5px;" id="profissa_4" data-value="4" data-origem="imagem" onclick="selecionaProfissional(this);" data-bs-tooltip="tooltip" data-bs-title="" data-original-title="4">
                    <img src="{{ asset('img/Atendimentos/Pessoas/Perfil/5.png') }}" class="img-circle radio" alt="User Image" width="50px" style="margin: 5px;" id="profissa_5" data-value="5" data-origem="imagem" onclick="selecionaProfissional(this);" data-bs-tooltip="tooltip" data-bs-title="" data-original-title="5">
                    <img src="{{ asset('img/Atendimentos/Pessoas/Perfil/6.png') }}" class="img-circle radio" alt="User Image" width="50px" style="margin: 5px;" id="profissa_6" data-value="6" data-origem="imagem" onclick="selecionaProfissional(this);" data-bs-tooltip="tooltip" data-bs-title="" data-original-title="6">
                    <img src="{{ asset('img/Atendimentos/Pessoas/Perfil/7.png') }}" class="img-circle radio" alt="User Image" width="50px" style="margin: 5px;" id="profissa_7" data-value="7" data-origem="imagem" onclick="selecionaProfissional(this);" data-bs-tooltip="tooltip" data-bs-title="" data-original-title="7">
                    <img src="{{ asset('img/Atendimentos/Pessoas/Perfil/8.png') }}" class="img-circle radio" alt="User Image" width="50px" style="margin: 5px;" id="profissa_8" data-value="8" data-origem="imagem" onclick="selecionaProfissional(this);" data-bs-tooltip="tooltip" data-bs-title="" data-original-title="8">
                    <img src="{{ asset('img/Atendimentos/Pessoas/Perfil/9.png') }}" class="img-circle radio" alt="User Image" width="50px" style="margin: 5px;" id="profissa_9" data-value="9" data-origem="imagem" onclick="selecionaProfissional(this);" data-bs-tooltip="tooltip" data-bs-title="" data-original-title="9">
                    <img src="{{ asset('img/Atendimentos/Pessoas/Perfil/10.png') }}" class="img-circle radio" alt="User Image" width="50px" style="margin: 5px;" id="profissa_10" data-value="10" data-origem="imagem" onclick="selecionaProfissional(this);" data-bs-tooltip="tooltip" data-bs-title="" data-original-title="10">
                    <img src="{{ asset('img/Atendimentos/Pessoas/Perfil/11.png') }}" class="img-circle radio" alt="User Image" width="50px" style="margin: 5px;" id="profissa_11" data-value="11" data-origem="imagem" onclick="selecionaProfissional(this);" data-bs-tooltip="tooltip" data-bs-title="" data-original-title="11">
                    <img src="{{ asset('img/Atendimentos/Pessoas/Perfil/12.png') }}" class="img-circle radio" alt="User Image" width="50px" style="margin: 5px;" id="profissa_12" data-value="12" data-origem="imagem" onclick="selecionaProfissional(this);" data-bs-tooltip="tooltip" data-bs-title="" data-original-title="12">
                    {{-- @endforeach --}}
                  </div>
                </div>
                <div class="col-10" style="padding: 5px 10px 3px 0px">

                  <div class="input-group input-group-sm mb-3">
                    <div class="input-group-prepend">
                      <span class="input-group-text"><i class="fas fa-filter fa-sm"></i></span>
                    </div>
                    <input type="text" class="form-control btn-sm" aria-describedby="inputGroup-sizing-sm" placeholder="Filtrar">
                  </div>
                  <table class="table table-sm table-bordered">
                    <thead>                  
                      <tr>
                        <th style="width: 10px">#</th>
                        <th>Task</th>
                        <th class="text-center">Valor</th>
                      </tr>
                    </thead>
                    <tbody>
                      <tr>
                        <td>1.</td>
                        <td>Update software</td>
                        <td class="text-right" font="10">480,00</td>
                      </tr>
                      <tr>
                        <td>2.</td>
                        <td>Clean database</td>
                        <td class="text-right" font="10">18,00</td>
                      </tr>
                      <tr>
                        <td>3.</td>
                        <td>Cron job running</td>
                        <td class="text-right" font="10">100,00</td>
                      </tr>
                      <tr>
                        <td>4.</td>
                        <td>Fix and squish bugs</td>
                        <td class="text-right" font="10">50,00</td>
                      </tr>
                      <tr>
                        <td>1.</td>
                        <td>Update software</td>
                        <td class="text-right" font="10">480,00</td>
                      </tr>
                      <tr>
                        <td>2.</td>
                        <td>Clean database</td>
                        <td class="text-right" font="10">18,00</td>
                      </tr>
                      <tr>
                        <td>3.</td>
                        <td>Cron job running</td>
                        <td class="text-right" font="10">100,00</td>
                      </tr>
                      <tr>
                        <td>4.</td>
                        <td>Fix and squish bugs</td>
                        <td class="text-right" font="10">50,00</td>
                      </tr>
                      <tr>
                        <td>1.</td>
                        <td>Update software</td>
                        <td class="text-right" font="10">480,00</td>
                      </tr>
                      <tr>
                        <td>2.</td>
                        <td>Clean database</td>
                        <td class="text-right" font="10">18,00</td>
                      </tr>
                      <tr>
                        <td>3.</td>
                        <td>Cron job running</td>
                        <td class="text-right" font="10">100,00</td>
                      </tr>
                      <tr>
                        <td>4.</td>
                        <td>Fix and squish bugs</td>
                        <td class="text-right" font="10">50,00</td>
                      </tr>
                      <tr>
                        <td>1.</td>
                        <td>Update software</td>
                        <td class="text-right" font="10">480,00</td>
                      </tr>
                      <tr>
                        <td>2.</td>
                        <td>Clean database</td>
                        <td class="text-right" font="10">18,00</td>
                      </tr>
                      <tr>
                        <td>3.</td>
                        <td>Cron job running</td>
                        <td class="text-right" font="10">100,00</td>
                      </tr>
                      <tr>
                        <td>4.</td>
                        <td>Fix and squish bugs</td>
                        <td class="text-right" font="10">50,00</td>
                      </tr>
                      <tr>
                        <td>1.</td>
                        <td>Update software</td>
                        <td class="text-right" font="10">480,00</td>
                      </tr>
                      <tr>
                        <td>2.</td>
                        <td>Clean database</td>
                        <td class="text-right" font="10">18,00</td>
                      </tr>
                      <tr>
                        <td>3.</td>
                        <td>Cron job running</td>
                        <td class="text-right" font="10">100,00</td>
                      </tr>
                      <tr>
                        <td>4.</td>
                        <td>Fix and squish bugs</td>
                        <td class="text-right" font="10">50,00</td>
                      </tr>
                      <tr>
                        <td>1.</td>
                        <td>Update software</td>
                        <td class="text-right" font="10">480,00</td>
                      </tr>
                      <tr>
                        <td>2.</td>
                        <td>Clean database</td>
                        <td class="text-right" font="10">18,00</td>
                      </tr>
                      <tr>
                        <td>3.</td>
                        <td>Cron job running</td>
                        <td class="text-right" font="10">100,00</td>
                      </tr>
                      <tr>
                        <td>4.</td>
                        <td>Fix and squish bugs</td>
                        <td class="text-right" font="10">50,00</td>
                      </tr>
                      <tr>
                        <td>1.</td>
                        <td>Update software</td>
                        <td class="text-right" font="10">480,00</td>
                      </tr>
                      <tr>
                        <td>2.</td>
                        <td>Clean database</td>
                        <td class="text-right" font="10">18,00</td>
                      </tr>
                      <tr>
                        <td>3.</td>
                        <td>Cron job running</td>
                        <td class="text-right" font="10">100,00</td>
                      </tr>
                      <tr>
                        <td>4.</td>
                        <td>Fix and squish bugs</td>
                        <td class="text-right" font="10">50,00</td>
                      </tr>
                      <tr>
                        <td>1.</td>
                        <td>Update software</td>
                        <td class="text-right" font="10">480,00</td>
                      </tr>
                      <tr>
                        <td>2.</td>
                        <td>Clean database</td>
                        <td class="text-right" font="10">18,00</td>
                      </tr>
                      <tr>
                        <td>3.</td>
                        <td>Cron job running</td>
                        <td class="text-right" font="10">100,00</td>
                      </tr>
                      <tr>
                        <td>4.</td>
                        <td>Fix and squish bugs</td>
                        <td class="text-right" font="10">50,00</td>
                      </tr>
                      <tr>
                        <td>1.</td>
                        <td>Update software</td>
                        <td class="text-right" font="10">480,00</td>
                      </tr>
                      <tr>
                        <td>2.</td>
                        <td>Clean database</td>
                        <td class="text-right" font="10">18,00</td>
                      </tr>
                      <tr>
                        <td>3.</td>
                        <td>Cron job running</td>
                        <td class="text-right" font="10">100,00</td>
                      </tr>
                      <tr>
                        <td>4.</td>
                        <td>Fix and squish bugs</td>
                        <td class="text-right" font="10">50,00</td>
                      </tr>
                      <tr>
                        <td>1.</td>
                        <td>Update software</td>
                        <td class="text-right" font="10">480,00</td>
                      </tr>
                      <tr>
                        <td>2.</td>
                        <td>Clean database</td>
                        <td class="text-right" font="10">18,00</td>
                      </tr>
                      <tr>
                        <td>3.</td>
                        <td>Cron job running</td>
                        <td class="text-right" font="10">100,00</td>
                      </tr>
                      <tr>
                        <td>4.</td>
                        <td>Fix and squish bugs</td>
                        <td class="text-right" font="10">50,00</td>
                      </tr>
                      <tr>
                        <td>1.</td>
                        <td>Update software</td>
                        <td class="text-right" font="10">480,00</td>
                      </tr>
                      <tr>
                        <td>2.</td>
                        <td>Clean database</td>
                        <td class="text-right" font="10">18,00</td>
                      </tr>
                      <tr>
                        <td>3.</td>
                        <td>Cron job running</td>
                        <td class="text-right" font="10">100,00</td>
                      </tr>
                      <tr>
                        <td>4.</td>
                        <td>Fix and squish bugs</td>
                        <td class="text-right" font="10">50,00</td>
                      </tr>
                      <tr>
                        <td>1.</td>
                        <td>Update software</td>
                        <td class="text-right" font="10">480,00</td>
                      </tr>
                      <tr>
                        <td>2.</td>
                        <td>Clean database</td>
                        <td class="text-right" font="10">18,00</td>
                      </tr>
                      <tr>
                        <td>3.</td>
                        <td>Cron job running</td>
                        <td class="text-right" font="10">100,00</td>
                      </tr>
                      <tr>
                        <td>4.</td>
                        <td>Fix and squish bugs</td>
                        <td class="text-right" font="10">50,00</td>
                      </tr>
                      <tr>
                        <td>1.</td>
                        <td>Update software</td>
                        <td class="text-right" font="10">480,00</td>
                      </tr>
                      <tr>
                        <td>2.</td>
                        <td>Clean database</td>
                        <td class="text-right" font="10">18,00</td>
                      </tr>
                      <tr>
                        <td>3.</td>
                        <td>Cron job running</td>
                        <td class="text-right" font="10">100,00</td>
                      </tr>
                      <tr>
                        <td>4.</td>
                        <td>Fix and squish bugs</td>
                        <td class="text-right" font="10">50,00</td>
                      </tr>
                      <tr>
                        <td>1.</td>
                        <td>Update software</td>
                        <td class="text-right" font="10">480,00</td>
                      </tr>
                      <tr>
                        <td>2.</td>
                        <td>Clean database</td>
                        <td class="text-right" font="10">18,00</td>
                      </tr>
                      <tr>
                        <td>3.</td>
                        <td>Cron job running</td>
                        <td class="text-right" font="10">100,00</td>
                      </tr>
                      <tr>
                        <td>4.</td>
                        <td>Fix and squish bugs</td>
                        <td class="text-right" font="10">50,00</td>
                      </tr>
                      <tr>
                        <td>1.</td>
                        <td>Update software</td>
                        <td class="text-right" font="10">480,00</td>
                      </tr>
                      <tr>
                        <td>2.</td>
                        <td>Clean database</td>
                        <td class="text-right" font="10">18,00</td>
                      </tr>
                      <tr>
                        <td>3.</td>
                        <td>Cron job running</td>
                        <td class="text-right" font="10">100,00</td>
                      </tr>
                      <tr>
                        <td>4.</td>
                        <td>Fix and squish bugs</td>
                        <td class="text-right" font="10">50,00</td>
                      </tr>
                      <tr>
                        <td>1.</td>
                        <td>Update software</td>
                        <td class="text-right" font="10">480,00</td>
                      </tr>
                      <tr>
                        <td>2.</td>
                        <td>Clean database</td>
                        <td class="text-right" font="10">18,00</td>
                      </tr>
                      <tr>
                        <td>3.</td>
                        <td>Cron job running</td>
                        <td class="text-right" font="10">100,00</td>
                      </tr>
                      <tr>
                        <td>4.</td>
                        <td>Fix and squish bugs</td>
                        <td class="text-right" font="10">50,00</td>
                      </tr>
                      <tr>
                        <td>1.</td>
                        <td>Update software</td>
                        <td class="text-right" font="10">480,00</td>
                      </tr>
                      <tr>
                        <td>2.</td>
                        <td>Clean database</td>
                        <td class="text-right" font="10">18,00</td>
                      </tr>
                      <tr>
                        <td>3.</td>
                        <td>Cron job running</td>
                        <td class="text-right" font="10">100,00</td>
                      </tr>
                      <tr>
                        <td>4.</td>
                        <td>Fix and squish bugs</td>
                        <td class="text-right" font="10">50,00</td>
                      </tr>
                      <tr>
                        <td>1.</td>
                        <td>Update software</td>
                        <td class="text-right" font="10">480,00</td>
                      </tr>
                      <tr>
                        <td>2.</td>
                        <td>Clean database</td>
                        <td class="text-right" font="10">18,00</td>
                      </tr>
                      <tr>
                        <td>3.</td>
                        <td>Cron job running</td>
                        <td class="text-right" font="10">100,00</td>
                      </tr>
                      <tr>
                        <td>4.</td>
                        <td>Fix and squish bugs</td>
                        <td class="text-right" font="10">50,00</td>
                      </tr>
                    </tbody>
                  </table>
                </div>
              </div>

{{--               <div class="row">
                <div class="col-12">
                  <label class="col-form-label">Nome Cliente<font color="red">*</font></label>
                  <select class="form-control form-control-sm" name="id_cliente" onchange="validar(this)">
                    <option value="">Selecione . . .</option>

                  </select>
                </div>
              </div> --}}
            </div>
          </div>
        </div>
      </div>
    </div>
    <div class="col-8">
      <div class="row">
        <div class="col-12">
          <div class="card">
            <div class="card-header">
              <h3 class="card-title">Itens da Venda</h3>
              <div class="card-tools">
                <div class="btn-group">
                  <a class="btn btn-sm btn-default" href="#" ><i class="fas fa-plus"></i></a>
                  <a class="btn btn-sm btn-default" data-bs-toggle="modal" data-target="#modal_pesquisa" id="modal_pesquisa_modalzim"><i class="fas fa-filter"></i></a>
                </div>
              </div>
            </div>
            <div class="card-body">
              <div class="row">
                <div class="col-12">
                  <label class="col-form-label">Profissional<font color="red">*</font></label>
                  <select class="form-control form-control-sm" name="id_cliente" onchange="validar(this)">
                    <option value="">Selecione . . .</option>

                  </select>
                </div>
              </div>
            </div>
          </div>
        </div>
        <div class="col-12">
          <div class="card">
            <div class="card-header">
              <h3 class="card-title">Itens da Venda</h3>
              <div class="card-tools">
                <div class="btn-group">
                  <a class="btn btn-sm btn-default" href="#" ><i class="fas fa-plus"></i></a>
                  <a class="btn btn-sm btn-default" data-bs-toggle="modal" data-target="#modal_pesquisa" id="modal_pesquisa_modalzim"><i class="fas fa-filter"></i></a>
                </div>
              </div>
            </div>
            <div class="card-body">
              <div class="row">
                <div class="col-12">
                  <label class="col-form-label">Profissional<font color="red">*</font></label>
                  <select class="form-control form-control-sm" name="id_cliente" onchange="validar(this)">
                    <option value="">Selecione . . .</option>

                  </select>
                </div>
              </div>
            </div>
          </div>
        </div>
      </div>
    </div>
  </div>
  <div class="row">
    <div class="col-12">
      <a href="{{ route('venda.index') }}" class="btn btn-secondary">Cancel</a>
      <a class="btn btn-success float-right" style="color:white" id='submit_venda_create'>Cadastrar</a>
    </div>
  </div>
</form>
@endsection

@section('js')
<script type="text/javascript">
//
$(document).ready(function()
{
  $("[name='vlr_venda'], [name='vlr_custo'], [name='cst_adicional']").inputmask('decimal', {
    'alias': 'numeric',
    'groupSeparator': '.',
    'autoGroup': true,
    'digits': 2,
    'radixPoint': ",",
    'digitsOptional': false,
    'allowMinus': false,
    'prefix': '',
    'placeholder': '0,00',
  });
});

function validar(field)
{
  let campo = $(field);
  let n_campo = campo.attr('name');
  let v_campo = campo.val();

  let dados = {
    [n_campo]: v_campo,
  }

  axios.post('{{ route('venda.triate') }}', dados)
  .then(function(response)
  {
    console.log(response)
    campo.removeClass('is-warning');
    campo.removeClass('is-invalid');
    campo.addClass('is-valid');
  })
  @include('includes.catch', [ 'codigo_erro' => '9506925a' ] )
};

$("#submit_venda_create").on('click', function(e)
{
  e.preventDefault();

  let dados = $('#form_venda_create').serialize();

  axios.post('{{ route('venda.store') }}', dados)
  .then(function(response)
  {
    console.log(response)
    window.location.href = response.data.redirect;
  })
@include('includes.catch', [ 'codigo_erro' => '2612141a' ] )
});
</script>
@endsection