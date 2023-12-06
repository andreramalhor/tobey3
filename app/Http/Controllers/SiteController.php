<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;

use App\Models\Gerenciamento\Empresa;
use App\Models\Site\Contato;

class SiteController extends Controller
{
    public function index()
    {
        $empresa = Empresa::orderBy('id', 'asc')->first();
        // \Auth::User()->klwqejqlkwndwiqo
        
        if($empresa->nome == 'Sena Clinic')
        {
            return view('templates.restaurantly.index', [
                'empresa' => $empresa,
            ]);
            dd($empresa);
        }
        else if($empresa->nome == 'Instituto Embelleze Caratinga')
        {
            true;
        }
        else if($empresa->nome == 'Instituto Embelleze Teófilo Otoni')
        {
            true;
        }
        else if($empresa->nome == 'Espaço Milady')
        {
            true;
        }
        dd($empresa->nome);

        if (\Auth::user())
        {
            return view('home');
        }
        else
        {
            return view('vendor.adminlte.auth.login');
        }
    }

    public function estrutura()
    {
        return view('templates.aeste.pages.estrutura');
    }

    public function links()
    {
        return view('templates.aeste.links');
    }

    public function listaEspera()
    {
        return view('site.link.listaEspera');
    }

    public function listaEsperaDados(Request $request)
    {
        $dados = lista_espera_inauguracao_noivas::create($request->all());

        return route('link.confirmacao');
    }

    public function confirmacao()
    {
        return view('site.link.confirmacao');
    }
}

