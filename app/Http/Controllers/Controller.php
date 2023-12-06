<?php

namespace App\Http\Controllers;

use Illuminate\Foundation\Auth\Access\AuthorizesRequests;
use Illuminate\Foundation\Bus\DispatchesJobs;
use Illuminate\Foundation\Validation\ValidatesRequests;
use Illuminate\Routing\Controller as BaseController;

class Controller extends BaseController
{
    use AuthorizesRequests, DispatchesJobs, ValidatesRequests;

    public function __construct()
    {
        // // Transforma a página de login em uma raiz
        // if ( $this->middleware('auth') !== null )
        // {
        //     $this->middleware('auth')->except(['index']);
        // }
        // else
        // {
        //     dd('erro no construct do controller', $this->middleware('auth'));
        // }
    }
}
