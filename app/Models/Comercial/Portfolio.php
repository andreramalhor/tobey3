<?php

namespace App\Models\Comercial;

use Illuminate\Database\Eloquent\Model;
use Carbon\Carbon;

class Portfolio extends Model
{
	public $timestamps = false;

    protected $primaryKey = 'id';
    protected $table      = 'com_portfolio';
    protected $fillable   = [
        'titulo',
        'slug',
        'conteudo',
    ];
    protected $appends = [
        // 'nomes',
    ];

    // // RELACIONAMENTOS  ===========================================================================================

    // // MUTATORS         ===========================================================================================
}
