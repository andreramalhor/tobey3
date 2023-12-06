@extends('layouts.app')

@section('content')
<form method="POST" action="{{ route('com.leads.confirmar_edicao', $lead->id) }}" autocomplete="off">
  @method('PUT')
  @csrf
  <input type="hidden" name="id_criador" value="{{ Auth::User()->id }}">
  <div class="row">
    <div class="col-7">
      <div class="card">
        <div class="card-header">
          <h3 class="card-title">Lead: {{ $lead->nome ?? ''}}</h3>
        </div>
        <div class="card-body">
          <div class="row">
            <div class="col-8">
              <label class="col-form-label">Nome<font color="red">*</font></label>
              <input type="text" class="form-control form-control-sm " name="nome" value="{{ $lead->nome ?? '' }}">
            </div>
            <div class="col-4">
              <label class="col-form-label">Telefone<font color="red">*</font></label>
              <input type="text" class="form-control form-control-sm" name="telefone" value="{{ $lead->telefone ?? '' }}">
            </div>
            <div class="col-6">
              <label class="col-form-label">Cidade</label>
              <input type="text" class="form-control form-control-sm" name="cidade" value="{{ $lead->cidade ?? '' }}">
            </div>
            <div class="col-6">
              <label class="col-form-label">e-Mail</label>
              <input type="text" class="form-control form-control-sm" name="email" value="{{ $lead->email ?? '' }}">
            </div>
            <div class="col-4">
              <label class="col-form-label">Interesse</label>
              <select class="form-control form-control-sm" name="sexo">
                <option value="frio" {{ $lead->interesse == "frio" ? 'selected' : "" }}>Frio</option>
                <option value="morno" {{ $lead->interesse == "morno" ? 'selected' : "" }}>Morno</option>
                <option value="quente" {{ $lead->interesse == "quente" ? 'selected' : "" }}>Quente</option>
              </select>
            </div>
            <div class="col-4">
              <label class="col-form-label">Status</label>
              <select class="form-control form-control-sm" name="sexo">
              <option value="entrada_lead"       {{ $lead->status == "entrada_lead" ? 'selected' : "" }}>Entrada do Lead</option>
              <option value="apresentacao_curso" {{ $lead->status == "apresentacao_curso" ? 'selected' : "" }}>Apresentação do Curso</option>
              <option value="proposta_enviada"   {{ $lead->status == "proposta_enviada" ? 'selected' : "" }}>Proposta Enviada</option>
              <option value="negociando_venda"   {{ $lead->status == "negociando_venda" ? 'selected' : "" }}>Negociando</option>
              <option value="perdido"            {{ $lead->status == "perdido" ? 'selected' : "" }}>Pedido</option>
              <option value="ganho"              {{ $lead->status == "ganho" ? 'selected' : "" }}>Ganho</option>
              </select>
            </div>
            <div class="col-4">
              <label class="col-form-label">Criado em:</label>
              <input type="date" class="form-control form-control-sm" name="created_at" value="{{ \Carbon\Carbon::parse($lead->created_at)->format('Y-m-d') ?? '' }}" disabled>
            </div>
            <div class="col-12">
              <label class="col-form-label">Observação</label>
              <input type="text" class="form-control form-control-sm" name="obs" value="{{ $lead->obs ?? '' }}">
            </div>
          </div>
        </div>
      </div>
    </div>

    <div class="col-5">
      <div class="card">
        <div class="card-header">
          <h3 class="card-title">Conversas</h3>
        </div>
        <div class="card-body">
          <div class="row">
            <div class="col-12">
            @forelse($lead->fghtvxswwryiiil as $conversa)
              <label class="col-form-label">Conversa ({{ \Carbon\Carbon::parse($conversa->created_at)->format('d/m/Y H:i') }})</label>
              <textarea class="form-control form-control-sm" rows="3" disabled>{{ $conversa->conversa ?? '' }}</textarea>
            @empty
              <b>Não há conversas cadastradas com esse lead.</b>
            @endforelse
            </div>
          </div>
        </div>
      </div>
    </div>
  </div>
  <div class="row">
    <div class="col-12">
      <a href="{{ route('com.leads') }}" class="btn btn-secondary">Cancelar</a>
      <button type="submit" class="btn btn-success float-right">Editar</button>
    </div>
  </div>
</form>
<br>
@endsection
