<div class="col-4">
  <div class="card card-{{ $agenda->status == 'Finalizada' ? 'success collapsed-card' : 'warning' }}">
    <div class="card-header">
      <h3 class="card-title">{{ $agenda->id }} - {{ isset($agenda->id_cliente) ? $agenda->xhooqvzhbgojbtg->apelido ?? '(Sem Cadastro)' : 'ERROR' }}</h3>
      <div class="card-tools">
        @if($agenda->status == 'Aberta')
          <a href="{{ route('pdv.vendas.pagar', $agenda->id) }}" class="btn btn-default btn-sm" data-bs-tt="tooltip" title="" data-bs-original-title="Pagar"><i class="fas fa-money-bill-wave-alt"></i></a>
          {{--
            <a href="{{ route('vendas.adicionarItens', $agenda->id) }}" class="btn btn-default btn-sm" data-bs-tt="tooltip" title="" data-bs-original-title="Adicionar Itens"><i class="glyphicon glyphicon-edit"></i></a>
          --}}
        @endif
        @if($agenda->status == 'Aberta')
          <button type="button" class="btn btn-tool" data-card-widget="collapse"><i class="fas fa-minus"></i></button>
        @else
          <button type="button" class="btn btn-tool" data-card-widget="collapse"><i class="fas fa-plus"></i></button>
        @endif
      </div>
    </div>
    <div class="card-body table-responsive p-0">
      <table class="table table-sm table-striped no-padding table-valign-middle table-hover table-condensed">
        <thead class="table-dark">
          <tr>
            <th class='text-center p-2' width="5%"><strong>Hor.</strong></th>
            <th class='text-center p-2' width="40%"><strong>Cliente</strong></th>
            <th class='text-center p-2' width="40%"><strong>Procedimento</strong></th>
            <th class='text-center p-2' width="5%"><strong>info</strong></th>
          </tr>
        </thead>
        <tbody id="campos_contatos">
          <tr data-hora="8" onclick="adicionar(this)">
            <td class='text-center p-2'><strong>08</strong></td>
            <td class='text-center p-2'>{{ \Carbon\Carbon::parse($agenda->start)->gt(\Carbon\Carbon::now()->createFromTime(8, 0, 0)) && \Carbon\Carbon::parse($agenda->start)->lt(\Carbon\Carbon::now()->createFromTime(9, 0, 0)) ? $agenda->xhooqvzhbgojbtg->apelido : null }}</td>
            <td class='text-center p-2'>{{ \Carbon\Carbon::parse($agenda->start)->gt(\Carbon\Carbon::now()->createFromTime(8, 0, 0)) && \Carbon\Carbon::parse($agenda->start)->lt(\Carbon\Carbon::now()->createFromTime(9, 0, 0)) ? $agenda->zLpekczgsltqgwg->nome : null }}</td>
            <td class='text-center p-2'>D</td>
          </tr>
          <tr data-hora="9" onclick="adicionar(this)">
            <td class='text-center p-2'><strong>09</strong></td>
            <td class='text-center p-2'>{{ \Carbon\Carbon::parse($agenda->start)->gt(\Carbon\Carbon::now()->createFromTime(9, 0, 0)) && \Carbon\Carbon::parse($agenda->start)->lt(\Carbon\Carbon::now()->createFromTime(10, 0, 0)) ? $agenda->xhooqvzhbgojbtg->apelido : null }}</td>
            <td class='text-center p-2'>{{ \Carbon\Carbon::parse($agenda->start)->gt(\Carbon\Carbon::now()->createFromTime(9, 0, 0)) && \Carbon\Carbon::parse($agenda->start)->lt(\Carbon\Carbon::now()->createFromTime(10, 0, 0)) ? $agenda->zLpekczgsltqgwg->nome : null }}</td>
            <td class='text-center p-2'>D</td>
          </tr>
          <tr data-hora="10" onclick="adicionar(this)">
            <td class='text-center p-2'><strong>10</strong></td>
            <td class='text-center p-2'>{{ \Carbon\Carbon::parse($agenda->start)->gt(\Carbon\Carbon::now()->createFromTime(10, 0, 0)) && \Carbon\Carbon::parse($agenda->start)->lt(\Carbon\Carbon::now()->createFromTime(11, 0, 0)) ? $agenda->xhooqvzhbgojbtg->apelido : null }}</td>
            <td class='text-center p-2'>{{ \Carbon\Carbon::parse($agenda->start)->gt(\Carbon\Carbon::now()->createFromTime(10, 0, 0)) && \Carbon\Carbon::parse($agenda->start)->lt(\Carbon\Carbon::now()->createFromTime(11, 0, 0)) ? $agenda->zLpekczgsltqgwg->nome : null }}</td>
            <td class='text-center p-2'>D</td>
          </tr>
          <tr data-hora="11" onclick="adicionar(this)">
            <td class='text-center p-2'><strong>11</strong></td>
            <td class='text-center p-2'>{{ \Carbon\Carbon::parse($agenda->start)->gt(\Carbon\Carbon::now()->createFromTime(11, 0, 0)) && \Carbon\Carbon::parse($agenda->start)->lt(\Carbon\Carbon::now()->createFromTime(12, 0, 0)) ? $agenda->xhooqvzhbgojbtg->apelido : null }}</td>
            <td class='text-center p-2'>{{ \Carbon\Carbon::parse($agenda->start)->gt(\Carbon\Carbon::now()->createFromTime(11, 0, 0)) && \Carbon\Carbon::parse($agenda->start)->lt(\Carbon\Carbon::now()->createFromTime(12, 0, 0)) ? $agenda->zLpekczgsltqgwg->nome : null }}</td>
            <td class='text-center p-2'>D</td>
          </tr>
          <tr data-hora="12" onclick="adicionar(this)">
            <td class='text-center p-2'><strong>12</strong></td>
            <td class='text-center p-2'>{{ \Carbon\Carbon::parse($agenda->start)->gt(\Carbon\Carbon::now()->createFromTime(12, 0, 0)) && \Carbon\Carbon::parse($agenda->start)->lt(\Carbon\Carbon::now()->createFromTime(13, 0, 0)) ? $agenda->xhooqvzhbgojbtg->apelido : null }}</td>
            <td class='text-center p-2'>{{ \Carbon\Carbon::parse($agenda->start)->gt(\Carbon\Carbon::now()->createFromTime(12, 0, 0)) && \Carbon\Carbon::parse($agenda->start)->lt(\Carbon\Carbon::now()->createFromTime(13, 0, 0)) ? $agenda->zLpekczgsltqgwg->nome : null }}</td>
            <td class='text-center p-2'>D</td>
          </tr>
          <tr data-hora="13" onclick="adicionar(this)">
            <td class='text-center p-2'><strong>13</strong></td>
            <td class='text-center p-2'>{{ \Carbon\Carbon::parse($agenda->start)->gt(\Carbon\Carbon::now()->createFromTime(13, 0, 0)) && \Carbon\Carbon::parse($agenda->start)->lt(\Carbon\Carbon::now()->createFromTime(14, 0, 0)) ? $agenda->xhooqvzhbgojbtg->apelido : null }}</td>
            <td class='text-center p-2'>{{ \Carbon\Carbon::parse($agenda->start)->gt(\Carbon\Carbon::now()->createFromTime(13, 0, 0)) && \Carbon\Carbon::parse($agenda->start)->lt(\Carbon\Carbon::now()->createFromTime(14, 0, 0)) ? $agenda->zLpekczgsltqgwg->nome : null }}</td>
            <td class='text-center p-2'>D</td>
          </tr>
          <tr data-hora="14" onclick="adicionar(this)">
            <td class='text-center p-2'><strong>14</strong></td>
            <td class='text-center p-2'>{{ \Carbon\Carbon::parse($agenda->start)->gt(\Carbon\Carbon::now()->createFromTime(14, 0, 0)) && \Carbon\Carbon::parse($agenda->start)->lt(\Carbon\Carbon::now()->createFromTime(15, 0, 0)) ? $agenda->xhooqvzhbgojbtg->apelido : null }}</td>
            <td class='text-center p-2'>{{ \Carbon\Carbon::parse($agenda->start)->gt(\Carbon\Carbon::now()->createFromTime(14, 0, 0)) && \Carbon\Carbon::parse($agenda->start)->lt(\Carbon\Carbon::now()->createFromTime(15, 0, 0)) ? $agenda->zLpekczgsltqgwg->nome : null }}</td>
            <td class='text-center p-2'>D</td>
          </tr>
          <tr data-hora="15" onclick="adicionar(this)">
            <td class='text-center p-2'><strong>15</strong></td>
            <td class='text-center p-2'>{{ \Carbon\Carbon::parse($agenda->start)->gt(\Carbon\Carbon::now()->createFromTime(15, 0, 0)) && \Carbon\Carbon::parse($agenda->start)->lt(\Carbon\Carbon::now()->createFromTime(16, 0, 0)) ? $agenda->xhooqvzhbgojbtg->apelido : null }}</td>
            <td class='text-center p-2'>{{ \Carbon\Carbon::parse($agenda->start)->gt(\Carbon\Carbon::now()->createFromTime(15, 0, 0)) && \Carbon\Carbon::parse($agenda->start)->lt(\Carbon\Carbon::now()->createFromTime(16, 0, 0)) ? $agenda->zLpekczgsltqgwg->nome : null }}</td>
            <td class='text-center p-2'>D</td>
          </tr>
          <tr data-hora="16" onclick="adicionar(this)">
            <td class='text-center p-2'><strong>16</strong></td>
            <td class='text-center p-2'>{{ \Carbon\Carbon::parse($agenda->start)->gt(\Carbon\Carbon::now()->createFromTime(16, 0, 0)) && \Carbon\Carbon::parse($agenda->start)->lt(\Carbon\Carbon::now()->createFromTime(17, 0, 0)) ? $agenda->xhooqvzhbgojbtg->apelido : null }}</td>
            <td class='text-center p-2'>{{ \Carbon\Carbon::parse($agenda->start)->gt(\Carbon\Carbon::now()->createFromTime(16, 0, 0)) && \Carbon\Carbon::parse($agenda->start)->lt(\Carbon\Carbon::now()->createFromTime(17, 0, 0)) ? $agenda->zLpekczgsltqgwg->nome : null }}</td>
            <td class='text-center p-2'>D</td>
          </tr>
          <tr data-hora="17" onclick="adicionar(this)">
            <td class='text-center p-2'><strong>17</strong></td>
            <td class='text-center p-2'>{{ \Carbon\Carbon::parse($agenda->start)->gt(\Carbon\Carbon::now()->createFromTime(17, 0, 0)) && \Carbon\Carbon::parse($agenda->start)->lt(\Carbon\Carbon::now()->createFromTime(18, 0, 0)) ? $agenda->xhooqvzhbgojbtg->apelido : null }}</td>
            <td class='text-center p-2'>{{ \Carbon\Carbon::parse($agenda->start)->gt(\Carbon\Carbon::now()->createFromTime(17, 0, 0)) && \Carbon\Carbon::parse($agenda->start)->lt(\Carbon\Carbon::now()->createFromTime(18, 0, 0)) ? $agenda->zLpekczgsltqgwg->nome : null }}</td>
            <td class='text-center p-2'>D</td>
          </tr>
          <tr data-hora="18" onclick="adicionar(this)">
            <td class='text-center p-2'><strong>18</strong></td>
            <td class='text-center p-2'>{{ \Carbon\Carbon::parse($agenda->start)->gt(\Carbon\Carbon::now()->createFromTime(18, 0, 0)) && \Carbon\Carbon::parse($agenda->start)->lt(\Carbon\Carbon::now()->createFromTime(19, 0, 0)) ? $agenda->xhooqvzhbgojbtg->apelido : null }}</td>
            <td class='text-center p-2'>{{ \Carbon\Carbon::parse($agenda->start)->gt(\Carbon\Carbon::now()->createFromTime(18, 0, 0)) && \Carbon\Carbon::parse($agenda->start)->lt(\Carbon\Carbon::now()->createFromTime(19, 0, 0)) ? $agenda->zLpekczgsltqgwg->nome : null }}</td>
            <td class='text-center p-2'>D</td>
          </tr>
          <tr data-hora="19" onclick="adicionar(this)">
            <td class='text-center p-2'><strong>19</strong></td>
            <td class='text-center p-2'>{{ \Carbon\Carbon::parse($agenda->start)->gt(\Carbon\Carbon::now()->createFromTime(19, 0, 0)) && \Carbon\Carbon::parse($agenda->start)->lt(\Carbon\Carbon::now()->createFromTime(20, 0, 0)) ? $agenda->xhooqvzhbgojbtg->apelido : null }}</td>
            <td class='text-center p-2'>{{ \Carbon\Carbon::parse($agenda->start)->gt(\Carbon\Carbon::now()->createFromTime(19, 0, 0)) && \Carbon\Carbon::parse($agenda->start)->lt(\Carbon\Carbon::now()->createFromTime(20, 0, 0)) ? $agenda->zLpekczgsltqgwg->nome : null }}</td>
            <td class='text-center p-2'>D</td>
          </tr>
          <tr data-hora="20" onclick="adicionar(this)">
            <td class='text-center p-2'><strong>20</strong></td>
            <td class='text-center p-2'>{{ \Carbon\Carbon::parse($agenda->start)->gt(\Carbon\Carbon::now()->createFromTime(20, 0, 0)) && \Carbon\Carbon::parse($agenda->start)->lt(\Carbon\Carbon::now()->createFromTime(21, 0, 0)) ? $agenda->xhooqvzhbgojbtg->apelido : null }}</td>
            <td class='text-center p-2'>{{ \Carbon\Carbon::parse($agenda->start)->gt(\Carbon\Carbon::now()->createFromTime(20, 0, 0)) && \Carbon\Carbon::parse($agenda->start)->lt(\Carbon\Carbon::now()->createFromTime(21, 0, 0)) ? $agenda->zLpekczgsltqgwg->nome : null }}</td>
            <td class='text-center p-2'>D</td>
          </tr>
        </tbody>  
        <tfoot>
        </tfoot>
      </table>
    </div>
  </div>
</div>

<script>
  function adicionar( campo )
  {
    var hora = $(campo).data('hora');

    alert(hora)
  }
</script>