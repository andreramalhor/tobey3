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
    $from = \Carbon\Carbon::today()->addDays($request->d)->subDays(3);
    $to   = \Carbon\Carbon::today()->addDays($request->d)->addDays(3);
   
    $recebimentos = RecebimentoCartao::
                            whereBetween('dt_prevista', [$from, $to])->
                            select(\DB::raw('sum(vlr_final) as vlr_receber, dt_prevista, status, id_forma_pagamento'))->
                            groupBy(['dt_prevista', 'status', 'id_forma_pagamento'])->
                            orderBy('dt_prevista', 'asc')->
                            orderBy('status', 'asc')->
                            get()->
                            sortBy('dt_prevista')->
                            sortBy('gevmgwjvzgdexwm.forma')->
                            groupBy(['dt_prevista', 'status', 'gevmgwjvzgdexwm.forma']);
   


    // $recebimentos = RecebimentoCartao::
    //                         whereBetween('dt_prevista', [$from, $to])->
    //                         select(\DB::raw('sum(vlr_final) as vlr_receber, count(*) as qtd_recebimentos, dt_prevista, status, id_forma_pagamento'))->
    //                         groupBy(['dt_prevista', 'status', 'id_forma_pagamento'])->
    //                         // where('status', '=', 'Aguardando Validação')->
    //                         with(['gevmgwjvzgdexwm' => function ($q)
    //                         {
    //                           $q->orderBy('forma', 'asc');
    //                         }])->
    //                         get()->
    //                         groupBy(['dt_prevista', 'status']);

    return $recebimentos;
  }

// =================================================================================================================================================
}
