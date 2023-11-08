<div class="row">
    <div class="row invoice-info">
        <div class="col-sm-2 invoice-col pb-3">
            <strong class="text-muted"># ID</strong><br>
        </div>
        <div class="col-sm-10 invoice-col pb-3">
            {{ $pessoa->id }}
        </div>

        <div class="col-sm-2 invoice-col pb-3">
            <strong class="text-muted">Nome</strong><br>
        </div>
        <div class="col-sm-10 invoice-col pb-3">
            {{ $pessoa->nome }}
        </div>

        <div class="col-sm-2 invoice-col pb-3">
            <strong class="text-muted">Apelido</strong><br>
        </div>
        <div class="col-sm-10 invoice-col pb-3">
            {{ $pessoa->apelido ?? '-' }}
        </div>

        <div class="col-sm-2 invoice-col pb-3">
            <strong class="text-muted">Data de Nascimento</strong><br>
        </div>
        <div class="col-sm-10 invoice-col pb-3">
            @if(isset($pessoa->dt_nascimento))
            {{ \Carbon\Carbon::parse($pessoa->dt_nascimento)->format('d/m/Y') }} ({{ \Carbon\Carbon::parse($pessoa->dt_nascimento)->age }} anos)
            @else
            -
            @endif
        </div>

        <div class="col-sm-2 invoice-col pb-3">
            <strong class="text-muted">Sexo</strong><br>
        </div>
        <div class="col-sm-10 invoice-col pb-3">
            {{ $pessoa->sexo ?? ' - '}}
        </div>

        <div class="col-sm-2 invoice-col pb-3">
            <strong class="text-muted">{{ $pessoa->label_cpf_cnpj }}</strong><br>
        </div>
        <div class="col-sm-10 invoice-col pb-3">
            {{ $pessoa->cpf ?? ' - ' }}
        </div>

        <div class="col-sm-2 invoice-col pb-3">
            <strong class="text-muted">e-Mail</strong><br>
        </div>
        <div class="col-sm-10 invoice-col pb-3">
            <a href="mailto:{{ $pessoa->email ?? ' - ' }}"><i class="fa-solid fa-envelope"></i> {{ $pessoa->email ?? ' - ' }}</a>
        </div>

        <div class="col-sm-2 invoice-col pb-3">
            <strong class="text-muted">Mídias Sociais</strong><br>
        </div>
        <div class="col-sm-10 invoice-col pb-3">
            <a class="" href="https://www.instagram.com/{{ $pessoa->instagram }}" target="_black" data-bs-tooltip="tooltip" data-bs-title="Instagram"><i class="fa-brands fa-instagram"></i></a> {{ $pessoa->instagram ?? ' - ' }}<br>
        </div>

        <div class="col-sm-2 invoice-col pb-3">
            <strong class="text-muted">Observação</strong><br>
        </div>
        <div class="col-sm-10 invoice-col pb-3">
            {{ $pessoa->observacao ?? '-' }}
        </div>

        <div class="col-sm-2 invoice-col pb-3">
            <strong class="text-muted">Endereços</strong><br>
        </div>
        <div class="col-sm-10 invoice-col pb-3">
            @if($pessoa->endereco)
                <a class="" href="https://www.google.com.br/maps/search/{{ $pessoa->tipo_pessoa }} {{ $pessoa->logradouro }} {{ $pessoa->numero }} {{ $pessoa->bairro }} {{ $pessoa->cidade }} {{ $pessoa->uf }} {{ $pessoa->cep }}" target="_black" data-bs-tooltip="tooltip" data-bs-title="Endereço"><i class="fa-solid fa-map-location"></i></a>
                <strong>{{ $pessoa->tipo_pessoa }}</strong>: {{ $pessoa->logradouro }}, {{ $pessoa->numero }} {{ $pessoa->complemento != null ? "(".$pessoa->complemento.")" : "" }} - {{ $pessoa->bairro }}  -  {{ $pessoa->cidade }}/{{ $pessoa->uf }} - {{ $pessoa->cep }}
            @else
                -
            @endif
        </div>

        <div class="col-sm-2 invoice-col pb-3">
            <strong class="text-muted">Contatos</strong><br>
        </div>
        <div class="col-sm-10 invoice-col pb-3">
            @if($pessoa->telefone)
                <a class="" href="tel:+55{{ $pessoa->ddd }}{{ $pessoa->telefone }}" target="_black" data-bs-tooltip="tooltip" data-bs-title="Telefone"><i class="fa-solid fa-phone"></i>({{ $pessoa->ddd }}) {{ $pessoa->telefone }}</a>&nbsp;&nbsp;
                <a class="" href="https://api.whatsapp.com/send?phone=55{{ $pessoa->ddd }}{{ $pessoa->telefone }}" target="_black" data-bs-tooltip="tooltip" data-bs-title="WhatsaApp"><i class="fa-brands fa-whatsapp"></i></a>
            @else
                -
            @endif
        </div>

        <br><br>
		<div class="text-muted mt-text-right">
            Incluído no sistema por:<br>
			{{ $pessoa->hgvqzcnfxwfqjue->apelido }} em {{ \Carbon\Carbon::parse($pessoa->created_at)->format('d/m/Y H:i') }}
        </div>
    </div>
</div>
