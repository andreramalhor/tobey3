@if(\Schema::hasTable('pdv_caixas') && isset(Auth::User()->abcde) && count(Auth::User()->abcde) )
  <li class="nav-item dropdown">
    <a class="nav-link" data-bs-toggle="dropdown" href="#" aria-expanded="false">
      <i class="fas fa-store"></i>
      {{-- <span class="badge bg-pink navbar-badge">3</span> --}}
    </a>
    <div class="dropdown-menu dropdown-menu-lg dropdown-menu-right" style="left: inherit; right: 0px;">
      <a href="{{ route('pdv.vendas.adicionar') }}" class="dropdown-item">
        <div class="media">
          {{-- <i class="fas fa-receipt fa-2x fa-fw"></i> --}}
          <div class="media-body">
            <h3 class="dropdown-item-title">Realizar Venda</h3>
          </div>
        </div>
      </a>
      <div class="dropdown-divider"></div>
      <a href="{{ route('pdv.caixas.mostrar', Auth::User()->abcde->first()->id ) }}" class="dropdown-item">
        <div class="media">
          {{-- <i class="fas fa-store fa-2x fa-fw"></i> --}}
          <div class="media-body">
            <h3 class="dropdown-item-title">Ver Caixa <span class="badge bg-pink text-sm">{{ Auth::User()->abcde->first()->id }}</span></h3>
            <p class="text-sm text-right"><span class="badge badge-warning">Saldo atual do Caixa: R$ {{ number_format(Auth::User()->abcde->first()->saldo_atual, 2, ',', '.') }}</span></p>
          </div>
        </div>
      </a>
    </div>
  </li>
  {{--
  <div class="dropdown-divider"></div>
  <a href="#" class="dropdown-item">
    <div class="media">
      <img src="https://picsum.photos/300/300" alt="User Avatar" class="img-size-50 img-circle mr-3">
        <div class="media-body">
        <h3 class="dropdown-item-title">John Pierce
          <span class="float-right text-sm text-muted"><i class="fas fa-star"></i></span>
        </h3>
        <p class="text-sm">I got your message bro</p>
        <p class="text-sm text-muted"><i class="far fa-clock mr-1"></i> 4 Hours Ago</p>
      </div>
    </div>
  </a>
  <div class="dropdown-divider"></div>
  <a href="#" class="dropdown-item">
    <div class="media">
      <img src="https://picsum.photos/300/300" alt="User Avatar" class="img-size-50 img-circle mr-3">
      <div class="media-body">
        <h3 class="dropdown-item-title">Nora Silvester
          <span class="float-right text-sm text-warning"><i class="fas fa-star"></i></span>
        </h3>
        <p class="text-sm">The subject goes here</p>
        <p class="text-sm text-muted"><i class="far fa-clock mr-1"></i> 4 Hours Ago</p>
      </div>
    </div>
  </a>
  <div class="dropdown-divider"></div>
  <a href="#" class="dropdown-item dropdown-footer">See All Messages</a>
  --}}
@endif
