<div class="overlay" id="mensagens_overlay">
  <i class="fas fa-2x fa-sync-alt fa-spin"></i>
</div>
<div class="card-header">
  <h3 class="card-title">Inbox</h3>
  <div class="card-tools">
    <div class="input-group input-group-sm">
      <input type="text" class="form-control" placeholder="Search Mail">
      <div class="input-group-append">
        <div class="btn btn-primary">
          <i class="fas fa-search"></i>
        </div>
      </div>
    </div>
  </div>
</div>
<div class="card-body p-0">
  <div class="mailbox-controls">
    <div class="btn-group">
      <button type="button" class="btn btn-default btn-sm">
        <i class="far fa-trash-alt"></i>
      </button>
      <button type="button" class="btn btn-default btn-sm">
        <i class="fas fa-reply"></i>
      </button>
      <button type="button" class="btn btn-default btn-sm">
        <i class="fas fa-share"></i>
      </button>
    </div>
    <button type="button" class="btn btn-default btn-sm">
      <i class="fas fa-sync-alt"></i>
    </button>
  </div>
  <div class="table-responsive mailbox-messages">
    <table class="table table-hover table-striped">
      <tbody>
        @forelse($mensagens as $mensagem)
        <tr>
          <td class="mailbox-star" width="5%">
            <a href="#"><i class="fas fa-star text-warning"></i></a>
          </td>
          <td class="mailbox-name" width="15%">
            <a href="read-mail.html"><b>{{ $mensagem->nome }}</b></a>
          </td>
          <td class="mailbox-subject" width="65%">
            <a href="read-mail.html">
              <span class="d-inline-block text-truncate" style="max-width: 600px;">
                <b>{{ $mensagem->assunto }}</b> - {{ $mensagem->mensagem }}
              </span>
            </a>
          </td>
          <td class="mailbox-date" width="10%">{{ \Carbon\Carbon::createFromTimeStamp(strtotime($mensagem->created_at))->diffForHumans() }}</td>
          <td class="text-nowrap text-center" width="5%">
            <a onClick="mensagens_excluir({{ $mensagem->id }})" class="text-muted" data-bs-tooltip="tooltip" data-bs-title="Excluir" data-original-title="Excluir"><i class="fa-solid fa-trash"></i></a>
          </td>
        </tr>
        @empty
        <tr>
          <td class="text-center" colspan="4">Não há mensagens na caixa de entrada.</td>
        </tr>
        @endforelse
      </tbody>
    </table>          
  </div>
</div>
<div class="card-footer p-0">
  <div class="mailbox-controls">
    <div class="btn-group">
      <button type="button" class="btn btn-default btn-sm">
        <i class="far fa-trash-alt"></i>
      </button>
      <button type="button" class="btn btn-default btn-sm">
        <i class="fas fa-reply"></i>
      </button>
      <button type="button" class="btn btn-default btn-sm">
        <i class="fas fa-share"></i>
      </button>
    </div>          
    <button type="button" class="btn btn-default btn-sm">
      <i class="fas fa-sync-alt"></i>
    </button>
    <div class="float-right">
      1-50/200
      <div class="btn-group">
        <button type="button" class="btn btn-default btn-sm">
          <i class="fas fa-chevron-left"></i>
        </button>
        <button type="button" class="btn btn-default btn-sm">
          <i class="fas fa-chevron-right"></i>
        </button>
      </div>
    </div>
  </div>
</div>

@push('js')
  alert('s')
@endpush
