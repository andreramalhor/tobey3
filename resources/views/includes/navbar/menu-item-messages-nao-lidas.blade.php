{{--
<a class="nav-link" data-bs-toggle="dropdown" href="#">
    <i class="far fa-envelope"></i>
    @if( $mensagens->count() > 0)
    <span class="badge badge-warning navbar-badge">{{ $mensagens->count() }}</span>
    @endif
</a>
<div class="dropdown-menu dropdown-menu-lg dropdown-menu-right" style="left: inherit; right: 0px;">
    @foreach($mensagens as $mensagem)
        <a href="{{ route('frm.mensagens.mostrar', $mensagem->id ) }}" class="dropdown-item">
            <div class="media">
                <div class="media-body">
                    <h3 class="dropdown-item-title">
                    {{ $mensagem->nome }}
                        <span class="float-right text-sm text-danger"><i class="fas fa-star"></i></span>
                    </h3>
                    <p class="text-sm text-left">{{ $mensagem->assunto }}
                        <span class="text-sm text-muted text-right float-right"><small><i class="far fa-clock mr-1"></i>{{ \Carbon\Carbon::createFromTimeStamp(strtotime($mensagem->created_at))->diffForHumans() }}</small></span>
                    </p>
                </div>
            </div>
        </a>
        <div class="dropdown-divider"></div>
    @endforeach
    <a href="{{ route('frm.mensagens') }}" class="dropdown-item dropdown-footer">Ver Todas as Mensagens</a>
</div>
 --}}