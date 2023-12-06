@foreach($produtos as $produto)
<div class="modal fade" id="modal_{{ $produto->id }}_vlr_custo">
  <div class="modal-dialog modal-md">
    <div class="modal-content">
      <div class="modal-header p-2">
        <h5 class="modal-title"><strong>Valor de Custo</strong><br>{{ $produto->marca . " - " . $produto->nome }}</h5>
        <button type="button" class="close" data-bs-dismiss="modal" aria-label="Close">
          <span aria-hidden="true">×</span>
        </button>
      </div>
      <div class="modal-body">
        <div class="form-group row">
          <label for="vlr_custo" class="col-sm-4 col-form-label">Antigo Valor de Custo</label>
          <div class="col-sm-8">
            <input type="text" class="form-control form-control-sm text-right" id="vlr_custo[{{ $produto->id }}]" value="{{ number_format($produto->vlr_custo, 2, ',', '.') }}" placeholder="0,00" disabled>
          </div>
        </div>
        <div class="form-group row">
          <label for="N_vlr_custo[{{ $produto->id }}]" class="col-sm-4 col-form-label">Novo Valor de Custo</label>
          <div class="col-sm-8">
            <input type="text" class="form-control form-control-sm text-right" id="N_vlr_custo[{{ $produto->id }}]" value="0" placeholder="0,00">
          </div>
        </div>
      </div>
      <div class="modal-footer justify-content-between">
        <button type="button" class="btn btn-default" data-bs-dismiss="modal">Fechar</button>
        <button type="button" class="btn btn-primary" onclick="atualizar_valores({{ $produto->id }})">Salvar</button>
      </div>
    </div>
  </div>
</div>
<div class="modal fade" id="modal_{{ $produto->id }}_vlr_venda">
  <div class="modal-dialog modal-md">
    <div class="modal-content">
      <div class="modal-header p-2">
        <h6 class="modal-title"><strong>Valor de Venda</strong><br>{{ $produto->marca . " - " . $produto->nome }}</h6>
        <button type="button" class="close" data-bs-dismiss="modal" aria-label="Close">
          <span aria-hidden="true">×</span>
        </button>
      </div>
      <div class="modal-body">
        <div class="form-group row">
          <label for="novo_vlr_venda" class="col-sm-4 col-form-label">Antigo Valor de Venda</label>
          <div class="col-sm-8">
            <input type="text" class="form-control form-control-sm text-right" id="vlr_venda[{{ $produto->id }}]" value="{{ number_format($produto->vlr_venda, 2, ',', '.') }}" placeholder="0,00" disabled>
          </div>
        </div>
        <div class="form-group row">
          <label for="N_vlr_venda[{{ $produto->id }}]" class="col-sm-4 col-form-label">Novo Valor de Venda</label>
          <div class="col-sm-8">
            <input type="text" class="form-control form-control-sm text-right" id="N_vlr_venda[{{ $produto->id }}]" value="0" placeholder="0,00">
          </div>
        </div>
      </div>
      <div class="modal-footer justify-content-between">
        <button type="button" class="btn btn-default" data-bs-dismiss="modal">Fechar</button>
        <button type="button" class="btn btn-primary" onclick="atualizar_valores({{ $produto->id }})">Salvar</button>
      </div>
    </div>
  </div>
</div>
@endforeach

<div class="card">
  <div class="card-header">
    <h3 class="card-title">Produtos</h3>
    <div class="card-tools">
      <button type="button" class="btn btn-tool" data-card-widget="collapse" title="Collapse">
        <i class="fas fa-minus"></i>
      </button>
      <button type="button" class="btn btn-tool" data-card-widget="remove" title="Remove">
        <i class="fas fa-times"></i>
      </button>
    </div>
  </div>
  <div class="card-body p-0">
    <table class="table projects table-bordered">
      <thead class="table-dark">
        <tr>
          <th class="align-baseline">#</th>
          <th class="align-baseline"></th>
          <th class="align-baseline">
            Produto <br>
            <small>Descrição</small>
          </th>
          <th class="align-baseline text-center">
            Estoque Atual <br>
            <small>Mín | Máx</small>
          </th>
          <th class="align-baseline text-right">
            Vlr. Custo <br>
            <small>Custo estoque</small>
          </th>
          <th class="align-baseline text-right">
            Vlr. Venda <br>
            <small>Tipo Preço</small>
          </th>
          <th class="align-baseline text-center">Qtd</th>
          {{-- <th class="align-baseline">Status</th> --}}
          <th class="align-baseline text-right">
            Vlr. Compra <br>
            <small>Vlr. Lucro</small>
          </th>
          {{-- <th class="align-baseline">Progresso</th> --}}
          <th class="align-baseline"></th>
        </tr>
      </thead>
      <tbody>
        <script type="text/javascript">
          var cat_produtos = [];
        </script>

        @foreach($produtos as $produto)

        <script type="text/javascript">

          produto =
          {
            id                            : {!! $produto->id !!},
            tipo                          : "{!! $produto->tipo !!}",
            ativo                         : "{!! $produto->ativo !!}",
            nome                          : "{!! $produto->nome !!}",
            id_categoria                  : "{!! $produto->id_categoria !!}",
            tipo_preco                    : "{!! $produto->tipo_preco !!}",
            vlr_venda                     : "{!! $produto->vlr_venda !!}",
            cst_adicional                 : "{!! $produto->cst_adicional !!}",
            prc_comissao                  : "{!! $produto->prc_comissao !!}",
            tempo_retorno                 : "{!! $produto->tempo_retorno !!}",
            duracao                       : "{!! $produto->duracao !!}",
            fidelidade_pontos_ganhos      : "{!! $produto->fidelidade_pontos_ganhos !!}",
            fidelidade_pontos_necessarios : "{!! $produto->fidelidade_pontos_necessarios !!}",
            unidade                       : "{!! $produto->unidade !!}",
            marca                         : "{!! $produto->marca !!}",
            cod_nota                      : "{!! $produto->cod_nota !!}",
            cod_barras                    : "{!! $produto->cod_barras !!}",
            estoque_min                   : "{!! $produto->estoque_min !!}",
            estoque_max                   : "{!! $produto->estoque_max !!}",
            ncm_prod_serv                 : "{!! $produto->ncm_prod_serv !!}",
            ipi_prod_serv                 : "{!! $produto->ipi_prod_serv !!}",
            icms_prod_serv                : "{!! $produto->icms_prod_serv !!}",
            simples_prod_serv             : "{!! $produto->simples_prod_serv !!}",
            vlr_mercado                   : "{!! $produto->vlr_mercado !!}",
            vlr_nota                      : "{!! $produto->vlr_nota !!}",
            vlr_frete                     : "{!! $produto->vlr_frete !!}",
            vlr_comissao                  : "{!! $produto->vlr_comissao !!}",
            vlr_marg_contribuicao         : "{!! $produto->vlr_marg_contribuicao !!}",
            marg_contribuicao             : "{!! $produto->marg_contribuicao !!}",
            vlr_custo                     : "{!! $produto->vlr_custo !!}",
            vlr_custo_estoque             : "{!! $produto->vlr_custo_estoque !!}",
            margem_custo                  : "{!! $produto->margem_custo !!}",
            consumo_medio                 : "{!! $produto->consumo_medio !!}",
            cmv_prod_serv                 : "{!! $produto->cmv_prod_serv !!}",
            curva_abc                     : "{!! $produto->curva_abc !!}",
            id_fornecedor                 : "{!! $produto->id_fornecedor !!}",
            descricao                     : "{!! $produto->descricao !!}",
            status                        : "{!! $produto->status !!}",
            N_qtd                         : 0,
            N_vlr_custo                   : null,
            N_vlr_venda                   : null,
          }

          cat_produtos.push(produto);

        </script>

        <tr>

          <td class="text-center p-1">{{ $produto->id }}</td>

          <td class="text-center p-1">
            <img style="border-radius: 5%; background-color: red; width: 50px;" src="{{ asset('img/catalogo/produtos/'. $produto->id .'.png') }}" alt="{{ $produto->nome }}" onerror="this.src='http://127.0.0.1:8000/img/catalogo/produtos/0.png'">
          </td>

          <td class="p-1">
            <a>
              {{ $produto->marca . " - " . $produto->nome }}
            </a>
            <br>
            <small>
              {{ $produto->tipo . " - " . $produto->descricao }}
            </small>
          </td>

          <td class="text-center p-1">
            <a>
              {{ $produto->estoque_atual }}
            </a>
            <br>
            <small>
              {{ $produto->estoque_min . " | " . $produto->estoque_max }}
            </small>
          </td>

          <td class="text-right p-1">
            <span class="float-left text-left">
              <a href="" data-bs-toggle="modal" data-bs-target="#modal_{{ $produto->id }}_vlr_custo">
                <small>
                  <i class="fas fa-pencil-alt"></i>
                </small>
                <br>
                <small>Editar Custos</small>
              </a>
            </span>
            <span class="float-right">
              <a id="id_vlr_custo_[{{ $produto->id }}]">
                {{ number_format($produto->vlr_custo, 2, ',', '.') }}
              </a>
              <br>
              <small>
                {{ number_format($produto->vlr_custo_estoque, 2, ',', '.') }}
              </small>
            </span>

          </td>

          <td class="text-right p-1">
            <span class="float-left text-left">
              <a href="" data-bs-toggle="modal" data-bs-target="#modal_{{ $produto->id }}_vlr_venda">
                <small>
                  <i class="fas fa-pencil-alt"></i>
                </small>
                <br>
                <small>Editar Preço</small>
              </a>

              {{-- <a data-bs-toggle="modal" data-bs-target="#modal-vlr_venda[{{ $produto->id }}]"> --}}
                {{-- <small> --}}
                  {{-- <i class="fas fa-pencil-alt"></i> --}}
                {{-- </small> --}}
                {{-- <br> --}}
              {{-- </a> --}}
            </span>
            <span class="float-right">
              <a id="id_vlr_venda_[{{ $produto->id }}]">
                {{ number_format($produto->vlr_venda, 2, ',', '.') }}
              </a>
              <br>
              <small>
                {{ $produto->tipo_preco }}
              </small>
            </span>
          </td>

          <td class="text-center p-1">
            <span id="qtd_[{{ $produto->id }}]">0</span>
            <br>
            <div class="btn-group pull-right">
              <a onclick="menos( '{{ $produto->id }}')" class="btn btn-warning btn-xs">
                <i style="width: 10.5px;" class="fa fa-minus"></i>
              </a>
              <a onclick="mais( '{{ $produto->id }}')" class="btn btn-primary btn-xs">
                <i style="width: 10.5px;" class="fa fa-plus"></i>
              </a>
            </div>
          </td>

          {{-- <td class="p-1" class="project-state"> --}}
            {{-- <span class="badge badge-success">Success</span> --}}
          {{-- </td> --}}

          <td class="text-right p-1">
            <a>
              <span id="total_vlr_custo_[{{ $produto->id }}]">0,00</span>
            </a>
            <br>
            <small>
              <span id="total_vlr_lucro_[{{ $produto->id }}]">0,00</span>
            </small>
          </td>

          {{-- <td class="p-1" class="project_progress"> --}}
            {{-- <div class="progress progress-sm"> --}}
              {{-- <div class="progress-bar bg-green" role="progressbar" aria-valuenow="57" aria-valuemin="0" aria-valuemax="100" style="width: 57%"></div> --}}
            {{-- </div> --}}
            {{-- <small> --}}
              {{-- 57% Complete --}}
            {{-- </small> --}}
          {{-- </td> --}}

          <td class="text-center p-1" class="project-actions text-right">
            <a class="btn btn-primary btn-sm" href="#">
              <small>
                <i class="fas fa-folder">
                </i>
                View
              </small>
            </a>
            <a class="btn btn-info btn-sm" href="#">
              <small>
                <i class="fas fa-pencil-alt">
                </i>
                Edit
              </small>
            </a>
            <a class="btn btn-danger btn-sm" href="#">
              <small>
                <i class="fas fa-trash">
                </i>
                Delete
              </small>
            </a>
          </td>

        </tr>
        @endforeach

      </tbody>
    </table>
  </div>

  <script type="text/javascript">
    function menos( id )
    {
      produto_x = cat_produtos.filter( elem => parseInt(elem.id) === parseInt(id) ).reduce(function getTotal(total, item)
      {
        if (item.N_qtd != 0)
        {
          nova_qtd   = item.N_qtd - 1;
          item.N_qtd = nova_qtd;
          document.getElementById('qtd_['+id+']').innerHTML = nova_qtd;
          atualizar_valores( id )
        }
      }, 0);
    }

    function mais( id )
    {
      produto_x = cat_produtos.filter( elem => parseInt(elem.id) === parseInt(id) ).reduce(function getTotal(total, item)
      {
        nova_qtd   = item.N_qtd + 1;
        item.N_qtd = nova_qtd;
        document.getElementById('qtd_['+id+']').innerHTML = nova_qtd;
        atualizar_valores( id )
      }, 0);
    }

    function atualizar_valores( id )
    {
      nova_qtd   = document.getElementById('qtd_['+id+']').innerHTML
      nova_custo = accounting.unformat(document.getElementById('N_vlr_custo['+id+']').value) == 0 ? accounting.unformat(document.getElementById('vlr_custo['+id+']').value) : accounting.unformat(document.getElementById('N_vlr_custo['+id+']').value);
      nova_venda = accounting.unformat(document.getElementById('N_vlr_venda['+id+']').value) == 0 ? accounting.unformat(document.getElementById('vlr_venda['+id+']').value) : accounting.unformat(document.getElementById('N_vlr_venda['+id+']').value);

      produto_x = cat_produtos.filter( elem => parseInt(elem.id) === parseInt(id) ).reduce(function getTotal(total, item)
      {
        // ANALISA SE O FOI ATRIBUIDO NOVO VALOR DE CUSTO NO OBEJTO
        if( nova_custo > 0)
        {
          item.N_vlr_custo = nova_custo;
        }

        // ANALISA SE O FOI ATRIBUIDO NOVO VALOR DE VENDA NO OBEJTO
        if( nova_venda > 0)
        {
          item.N_vlr_venda = nova_venda;
        }

        // calcula o custo e lucro para colocar no span
        novo_vlr_custo = nova_custo * nova_qtd;
        novo_vlr_lucro = (nova_venda * nova_qtd) - (nova_custo * nova_qtd);
        document.getElementById('id_vlr_custo_['+id+']').innerHTML = accounting.formatMoney(nova_custo, "");
        document.getElementById('id_vlr_venda_['+id+']').innerHTML = accounting.formatMoney(nova_venda, "");

        document.getElementById('total_vlr_custo_['+id+']').innerHTML = accounting.formatMoney(novo_vlr_custo, "");
        document.getElementById('total_vlr_lucro_['+id+']').innerHTML = accounting.formatMoney(novo_vlr_lucro, "");


        $("#cat_produtos").val(JSON.stringify(cat_produtos))
        
        $('#modal_'+id+'_vlr_custo').removeClass('in');
        $('.modal-backdrop').remove();
        $('#modal_'+id+'_vlr_custo').hide();

        $('#modal_'+id+'_vlr_venda').removeClass('in');
        $('.modal-backdrop').remove();
        $('#modal_'+id+'_vlr_venda').hide();

      }, 0);
    }

  </script>