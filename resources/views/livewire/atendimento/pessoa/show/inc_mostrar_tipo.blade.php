<div class="row">
    <x-acl.funcao destino="checkbox" />
    @can('Funções.Editar')
    <div class="row invoice-info">
        <div class="col-sm-12 invoice-col">
            @foreach($funcoes->groupBy('categoria') as $categoria => $funcao)
            @can('Administrador do Sistema')
            <br><strong>{{ $categoria }}</strong><br>
            @foreach($funcao as $funcao_pessoa)
            @include('sistema.atendimentos.pessoas.auxiliares.inc_editar_color_checkbox', [ 'pessoa_funcoes' => $pessoa->aistggwbdgrrher->sortby('nome') ?? 'funcao_pessoa', 'funcao_id' => $funcao_pessoa->id ?? 'funcao_id', 'funcao_nome' => $funcao_pessoa->nome, 'funcao_descricao' => $funcao_pessoa->descricao ])
            @endforeach
            @else
            @if( $categoria != 'Acesso Total')
            <br><strong>{{ $categoria }}</strong><br>
            @foreach($funcao as $funcao_pessoa)
            @include('sistema.atendimentos.pessoas.auxiliares.inc_editar_color_checkbox', [ 'pessoa_funcoes' => $pessoa->aistggwbdgrrher->sortby('nome') ?? 'funcao_pessoa', 'funcao_id' => $funcao_pessoa->id ?? 'funcao_id', 'funcao_nome' => $funcao_pessoa->nome, 'funcao_descricao' => $funcao_pessoa->descricao ])
            @endforeach
            @endif
            @endcan
            @endforeach
            <br><br>
        </div>
    </div>
    @else
    <div class="row invoice-info">
        <div class="col-sm-12 invoice-col">
            @foreach($funcoes->groupBy('categoria') as $categoria => $funcao)
            <br><strong>{{ $categoria }}</strong><br>
            @foreach($funcao as $funcao_pessoa)
            <i class="fa-xs fa-solid fa-circle"
            @if($pessoa->aistggwbdgrrher->contains('id_funcao', $funcao_pessoa->id))
            style="color:green;"
            @else
            style="color:red;"
            @endif
            ></i>
            &nbsp;
            <label>
                <span class="small"></span>&nbsp;{{ $funcao_pessoa->nome ?? 'funcao_pessoa->nome' }}<span class="small"> ({{ $funcao_pessoa->descricao ?? 'funcao_pessoa->descricao' }})</span>
            </label>
            <br>
            @endforeach
            @endforeach
            <br><br>
        </div>
    </div>
    @endcan
</div>
