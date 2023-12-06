<div class="col-12 col-sm-12 col-md-12 col-lg-12 col-xl-12">
  <div class="card">
    <!-- <div class="overlay"> -->
      <!-- <i class="fas fa-2x fa-sync-alt fa-spin"></i> -->
    <!-- </div> -->
    <div class="card-header">
      <h3 class="card-title">Comissões de <strong>{{ $comissoes->first()->xeypqgkmimzvknq->apelido }}</strong> - #ID do pagamento: {{ $comissoes->first()->id_destino }} - Data do pagamento: {{ \Carbon\Carbon::parse($comissoes->first()->dt_quitacao)->format('d/m/Y') }}</h3>
    </div>
    <div class="card-body table-responsive p-0">
      <table class="table table-sm table-striped no-padding text-nowrap">
        <thead class="table-dark">
          <tr>
            <th class="text-center">#</th>
            <th class="text-center">Tipo</th>
            <th class="text-center"># Comanda</th>
            <th class="text-center">Data da Comanda</th>
            <th class="text-left">Cliente</th>
            <th class="text-left">Serviço / Produto</th>
            <th class="text-right">Vlr Serviço</th>
            <th class="text-center">% Comissão</th>
            <th class="text-right">Valor da Comissão</th>
          </tr>
        </thead>
        <tbody>
        @forelse($comissoes as $comissao)
          @if($comissao->fonte_origem == 'pdv_vendas_pagamentos')
          <tr>
            <td style="color:inherit;" class="text-center">{{ $comissao->id }}</td>
            <td style="color:inherit;" class="text-center">{{ $comissao->tipo }}</td>
            <td style="color:inherit;" class="text-center">
              <a href="" data-bs-toggle="modal" onclick="vendas_mostrar_modal({{ optional($comissao->sflfmensjwleneb)->id_venda }})"><span class="badge bg-purple">{{ optional($comissao->sflfmensjwleneb)->id_venda }}</span></a>
            </td>
            <td style="color:inherit;" class="text-center">{{ \Carbon\Carbon::parse($comissao->created_at)->format('d/m/Y') }}</td>
            <td style="color:inherit;" class="text-left">{{ optional(optional(optional($comissao->sflfmensjwleneb)->yshghlsawerrgvd)->lufqzahwwexkxli)->apelido ?? '(Cliente sem cadastro)' }}</td>
            <td style="color:inherit;" class="text-left">{{ '' ?? '' }}</td>
            <td style="color:inherit;" class="text-right">{{ number_format($comissao->valor, 2, ',', '.') }}</td>
            <td style="color:inherit;" class="text-center">{{ $comissao->percentual * 100 }}%</td>
            <td style="color:inherit;" class="text-right">{{ number_format($comissao->valor, 2, ',', '.') }}</td>
          </tr>
          @elseif($comissao->fonte_origem == 'pdv_vendas_detalhes')
          <tr>
            <td style="color:inherit;" class="text-center">{{ $comissao->id }}</td>
            <td style="color:inherit;" class="text-center">{{ $comissao->tipo }}</td>
            <td style="color:inherit;" class="text-center">
              <a href="" data-bs-toggle="modal" onclick="vendas_mostrar_modal({{ optional($comissao->lskjasdlkdflsdj)->id_venda }})"><span class="badge bg-pink">{{ optional($comissao->lskjasdlkdflsdj)->id_venda }}</span></a>
            </td>
            <td style="color:inherit;" class="text-center">{{ \Carbon\Carbon::parse($comissao->created_at)->format('d/m/Y') }}</td>
            <td style="color:inherit;" class="text-left">{{ optional(optional($comissao->skfmwuorwmlpdlm)->lufqzahwwexkxli)->apelido ?? '(Cliente sem cadastro)' }}</td>
            <td style="color:inherit;" class="text-left">{{ optional($comissao->ygferchrtuwewhq)->nome ?? '' }}</td>
            <td style="color:inherit;" class="text-right">{{ number_format(optional($comissao->lskjasdlkdflsdj)->vlr_final ?? 0, 2, ',', '.') }}</td>
            <td style="color:inherit;" class="text-center">{{ $comissao->percentual * 100 }}%</td>
            <td style="color:inherit;" class="text-right">{{ number_format($comissao->valor, 2, ',', '.') }}</td>
          </tr>
          @else
          <tr>
            <td style="color:inherit;" class="text-center">{{ $comissao->id }}</td>
            <td style="color:inherit;" class="text-center">{{ $comissao->tipo }}</td>
            <td style="color:inherit;" class="text-center"></td>
            <td style="color:inherit;" class="text-center">{{ \Carbon\Carbon::parse($comissao->created_at)->format('d/m/Y') }}</td>
            <td style="color:inherit;" class="text-left">{{ optional($comissao->xeypqgkmimzvknq)->apelido ?? '(Cliente sem cadastro)' }}</td>
            <td style="color:inherit;" class="text-left">{{ $comissao->tipo ?? '' }}</td>
            <td style="color:inherit;" class="text-right">{{ number_format(optional($comissao->lskjasdlkdflsdj)->vlr_final ?? 0, 2, ',', '.') }}</td>
            <td style="color:inherit;" class="text-center">{{ $comissao->percentual * 100 }}%</td>
            <td style="color:inherit;" class="text-right">{{ number_format($comissao->valor, 2, ',', '.') }}</td>
          </tr>
          @endif
        @endforeach
      </tbody>
      <tfoot>
        <tr>
          <th class="text-center">{{ $comissoes->count() }}</th>
          <th></th>
          <th></th>
          <th></th>
          <th></th>
          <th></th>
          <th></th>
          <th></th>
          <th class="text-right">{{ number_format($comissoes->sum('valor'), 2, ',', '.') }}</th>
        </tr>
      </tfoot>
    </table>
    </div>
    <div class="card-footer">
      <a class="btn btn-sm btn-default" href="{{ route('fin.comissoes') }}">Voltar</a>
    </div>
  </div>
</div>
