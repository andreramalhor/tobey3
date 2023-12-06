<?php

namespace App\Models\pivots;

use Illuminate\Database\Eloquent\Model;

use App\Models\Cadastro\ServicoProduto;

class ProviderProduct extends Model
{
  protected $table = 'cnf_fornecedor_produto';
  protected $fillable = [
    'id_fornecedor',
    'id_servprod',
  ];



// RELACIONAMENTOS  ===========================================================================================
  public function idp8nnq72l()
  {
    return $this->belongsTo(ServicoProduto::class, 'id_servprod', 'id' )->withTrashed();
    // return $this->belongsTo(ServicoProduto::class, 'id_servprod', 'id' )->orderByRaw('!ISNULL(deleted_at), deleted_at DESC, created_at DESC')->withTrashed();
  }
}
