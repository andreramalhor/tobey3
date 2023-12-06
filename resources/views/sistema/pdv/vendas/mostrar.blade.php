@extends('layouts.app')

@section('content')
<div class="row">
  <div class="col-3">
    <div class="card">
      <div class="card-body box-profile">
        <div class="text-center">
          <img class="profile-user-img img-fluid img-circle" src="{{ $pessoa->foto_perfil }}" alt="User profile picture">
        </div>
        <h3 class="profile-username text-center">{{ $pessoa->apelido }}</h3>
        <p class="text-muted text-center">{{ $pessoa->nome }}</p>
        <hr>
        <span class="text-center">
          <strong><i class="fas fa-birthday-cake mr-1"></i> Dt Nascimento</strong>
          @if(isset($pessoa->dt_nascimento))
            <p class="text-muted" style="margin-bottom: 8px;"><font size="2,8">{{ \Carbon\Carbon::parse($pessoa->dt_nascimento)->format('d/m/Y') }} ({{ \Carbon\Carbon::parse($pessoa->dt_nascimento)->age }} anos)</font></p>
          @else
            <p class="text-muted" style="margin-bottom: 8px;"><font size="2,8"> - </font></p>
          @endif
        </span>
        <span class="text-center">
          <strong><i class="far fa-id-card mr-1"></i> {{ $pessoa->label_cpf_cnpj }} </strong>
          <p class="text-muted" style="margin-bottom: 8px;"><font size="2,8">{{ $pessoa->cpf ?? "-" }}</font></p>
        </span>
        <span class="text-center">
          <strong><i class="far fa-file-alt mr-1"></i> Observação</strong>
          <p class="text-muted" style="margin-bottom: 8px;"><font size="2,8">{{ $pessoa->observacao ?? "-" }}</font></p>
        </span>
        @can('Equipe.Alterar Senha')
          @if(isset($pessoa->krdhcnrxogfuwla) AND $pessoa->id == Auth::User()->id)
            <a href="{{ route('atd.equipe.alterar_senha', $pessoa->id) }}" class="btn btn-primary btn-block"><b>Alterar Senha</b></a>
          @endif
        @endcan
      </div>
    </div>
    <div class="card card-primary">
      <div class="card-header">
        <h3 class="card-title">Sobre</h3>
      </div>
      <div class="card-body">
        <strong><i class="fas fa-phone mr-1"></i> Contatos</strong>
        @forelse($pessoa->ginthgfwxbdhwtu->sortbyDesc('whatsapp') as $contato)
          <p class="text-muted" style="margin-bottom: 2px"><font size="2">
            <span style="font-size: 7px;"><i class="fas fa-circle fa-xs"></i></span>
            ({{ $contato->ddd }}) {{ $contato->telefone }}
            @if($contato->whatsapp)
            <a class="float-right btn btn-default btn-xs" href="https://api.whatsapp.com/send?phone=55{{ $contato->tellink }}" target="_black" data-tt="tooltip" title="WhatsaApp"><i class="fab fa-whatsapp"></i></a>
            @endif
          </font></p>
        @empty
          <p class="text-muted"><font size="2,8">Não há contatos cadastrados.</font></p>
        @endforelse
        <hr>
        <strong><i class="fas fa-map-marker-alt mr-1"></i> Localização</strong>
        @forelse($pessoa->uqbchiwyagnnkip as $endereco)
          <p class="text-muted" style="margin-bottom: 2px"><font size="2"> 
            <span style="font-size: 7px;"><i class="fas fa-circle fa-xs"></i></span>
            {{ $endereco->logradouro }}, {{ $endereco->numero }} {{ $endereco->complemento != null ? "(".$endereco->complemento.")" : "" }} - {{ $endereco->bairro }} <br>
            {{ $endereco->cidade }} - {{ $endereco->uf }}
          </p></font>
        @empty
          <p class="text-muted"><font size="2,8">Não há endereços cadastrados.</font></p>
        @endforelse
        <hr>
        <strong><i class="fas fa-vector-square mr-1"></i> Midias Sociais</strong>
        @if(isset($pessoa->instagram) || isset($pessoa->facebook))
          <p class="text-muted" style="margin-bottom: 2px"><font size="2"> 
            <span style="font-size: 7px;"></span>
            @if($pessoa->instagram)
              <a class="btn btn-default btn-xs" href="https://www.instagram.com/{{ $pessoa->instagram }}" target="_black" data-tt="tooltip" title="Instagram"><i class="fa-brands fa-instagram"></i></a> {{ $pessoa->instagram }}
            @endif
            <br>
            @if($pessoa->facebook)
              <a class="btn btn-default btn-xs" href="https://www.facebook.com/{{ $pessoa->facebook }}" target="_black" data-tt="tooltip" title="Facebook"><i class="fa-brands fa-facebook"></i></a> {{ $pessoa->facebook }}
            @endif
        @else
          <p class="text-muted"><font size="2,8">Não há mídias sociais cadastrados.</font></p>
        @endif

        </p></font>
      </div>
    </div>
  </div>
  <div class="col-9">
    <div class="card">
      <div class="card-header p-2">
        <ul class="nav nav-pills">
          <li class="nav-item"><a class="nav-link" href="#painel" data-bs-toggle="tab">Painel</a></li>
          <li class="nav-item"><a class="nav-link" href="#financeiro" data-bs-toggle="tab">Financeiro</a></li>
          <li class="nav-item"><a class="nav-link" href="#sobre" data-bs-toggle="tab">Sobre</a></li>
          <li class="nav-item"><a class="nav-link active" href="#tipo" data-bs-toggle="tab">Tipo</a></li>
        </ul>
      </div>
      <div class="card-body">
        <div class="tab-content">
          <div class=" tab-pane" id="painel">
            @include('sistema.atendimentos.pessoas.auxiliares.inc_mostrar_painel')
          </div>
          <div class="tab-pane" id="financeiro">
            @include('sistema.atendimentos.pessoas.auxiliares.inc_mostrar_financeiro')
          </div>
          <div class="tab-pane" id="sobre">
            @include('sistema.atendimentos.pessoas.auxiliares.inc_mostrar_sobre')
          </div>
          <div class="tab-pane active" id="tipo">
            @include('sistema.atendimentos.pessoas.auxiliares.inc_mostrar_tipo')
          </div>
        </div>
      </div>
    </div>
  </div>
</div>
@include('sistema.pdv.vendas.auxiliares.resumo')
@endsection

@push('js')
<script type="text/javascript">
  @if(session()->exists('resposta'))
  toastrjs('{{ session()->get('resposta')['type'] }}', '{{ session()->get('resposta')['message'] }}')
  @endif
</script>
@endpush