@foreach($produtos as $produto)
{{-- @dd($produto) --}}
  <div class="col-md-2">
    <div class="card">
      <div class="card-header">
        <h6 class="card-title">{{ $produto->marca ?? 'Espaço Milady' }} ({{ $produto->id }})</h6>
      </div>
      <div class="card-body">
        <img style="border-radius: 5%; background-color: red;" src="{{ asset('img/catalogo/produtos/'. $produto->id .'.png') }}" alt="{{ $produto->nome }}" onerror="this.src='http://127.0.0.1:8000/img/catalogo/produtos/0.png'">
      </div>
      <div class="card-body">
        <span>{{ $produto->nome }}</span>
        <br>
        <div class="text-center">
          <strong id="vlr_unitario_[{{ $produto->id }}]">R$ {{ number_format($produto->vlr_venda, 2, ',', '.') }}</strong>
        </div>
        <div class="text-center">
          <strong id="total_[{{ $produto->id }}]">Total: R$ 0,00</strong>
        </div>
      </div>
      <div class="card-footer">
        <div class="row">
          <div class="input-group mb-3">
            <div class="input-group-prepend">
              <button type="button" class="btn btn-sm btn-danger" onclick="menos( '{{ $produto->id }}')"> - </button>
            </div>
            <input type="number" class="form-control form-control-sm" name="qtd_[{{ $produto->id }}]" id="qtd_[{{ $produto->id }}]" value="0" step="1" min="0" style="text-align:center;">
            <div class="input-group-append">
              <button type="button" class="btn btn-sm btn-primary" onclick="mais( '{{ $produto->id }}' )"> + </button>
            </div>
          </div>
        </div>
      </div>
    </div>
  </div>
@endforeach

