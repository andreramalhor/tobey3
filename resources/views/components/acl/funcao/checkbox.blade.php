<div class="col-12">
    <ul class="p-0">
        <div class="row">
            @foreach($funcoes as $c_funcao)
                @if( $loop->index == 0 || $loop->index == ( $funcoes->count() / $colunas )  )
                    <div class="col-6">
                @endif
                    <li class="p-1">
                        <div class="icheck-primary d-inline ml-2">
                            <input type="checkbox" wire:model="{{ $name ?? '' }}" value="{{ $c_funcao->id }}" id="checkbox{{ $c_funcao->id }}"
                                @if( !is_null($contem) && $contem->contains($c_funcao->id) )
                                checked
                                @endif

                                @if( $status )
                                disabled
                                @endif
                            >
                            <label for="checkbox{{ $c_funcao->id }}">{{ $c_funcao->nome }} </label>
                        </div>
                    </li>
                @if( $loop->index == ( $funcoes->count() / $colunas ) - 1 || $loop->last )
                    </div>
                @endif
            @endforeach
        </div>
    </ul>
</div>
