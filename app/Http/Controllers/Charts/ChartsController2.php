<?php

namespace App\Http\Controllers\Charts;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use Illuminate\Database\Eloquent\Builder;

use App\Models\Financeiro\RecebimentoCartao;

class ChartsController extends Controller
{
  public function cartoes_semanal(Request $request)
  {
    $from = \Carbon\Carbon::today()->subDays(1);
    $to   = \Carbon\Carbon::today()->addDays(1);
   
    $recebimentos = RecebimentoCartao::
                            whereBetween('dt_prevista', [$from, $to])->
                            select(\DB::raw('sum(vlr_real) as vlr_real, sum(vlr_real - vlr_final) as vlr_desc, sum(vlr_final) as vlr_receber, count(*) as qtd_recebimentos, dt_prevista, id_forma_pagamento'))->
                            groupBy(['dt_prevista', 'id_forma_pagamento'])->
                            // where('status', '=', 'Aguardando Validação')->
                            with(['gevmgwjvzgdexwm' => function ($q)
                            {
                              $q->orderBy('tipo', 'asc');
                            }])->
                            get()->
                            groupBy(['dt_prevista']);

    // dd($recebimentos);
    
    // $labels = [];
    // $T_labels = [];
    // $teste2 = [];
    // $T_teste2 = [];

    // foreach ($recebimentos as $key => $dia_recebimento)
    // {
    //   array_push($labels, $key);
    //   array_push($T_labels, count($dia_recebimento));

    //   dd($dia_recebimento);
    //   $credito = $dia_recebimento->where('gevmgwjvzgdexwm.forma', '=', 'Cartão de Crédito')->where('gevmgwjvzgdexwm.forma', '=', 'Cartão de Crédito')->sum('vlr_desc');        
    
    //   foreach ($dia_recebimento as $key1 => $formas_pagamento)
    //   {
    //     $credito = $formas_pagamento->where('gevmgwjvzgdexwm.forma', '=', 'Cartão de Crédito')->sum('vlr_desc');        
    //     array_push($teste2, $credito);
    //     // array_push($T_teste2, count($credito));

    //     // dd($dia_recebimento, $key1, $formas_pagamento->first()->gevmgwjvzgdexwm->forma);
    //     // array_push($teste2, $formas_pagamento->first()->gevmgwjvzgdexwm->forma);
  
    //   //   if (count($formas_pagamento) > 1 )
    //   //   {
    //   //     dd('s');
    //   //   }
    //   //   else
    //   //   {
    //   //     count($key1, $formas_pagamento);
    //   //     array_push($teste2, $dia_recebimento);
    //   //     dd($key1, $formas_pagamento);
    //   //   }
    //   //   // dd($key1, $formas_pagamento);
    //   //   // dd($key1, $formas_pagamento, $formas_pagamento->gevmgwjvzgdexwm, $formas_pagamento->gevmgwjvzgdexwm->forma);
    //   }
    // }


    // dd($T_labels, $labels, $T_teste2, $teste2);


    // dd(array_keys($recebimentos));
    // return response()->json($recebimentos->toArray(), 200);
    // return response()->json($recebimentos, 200);
    return $recebimentos;
  }

// =================================================================================================================================================
}
