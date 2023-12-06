<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;

use App\Models\Gerenciamento\Empresa;
use App\Models\Site\Contato;

class SiteController extends Controller
{
    public function index()
    {
        // Direciona automaticamente para a página de Login 
        // if (\Auth::user())
        // {
        //     return view('home');
        // }
        // else
        // {
        //     return view('vendor.adminlte.auth.login');
        // }

        $empresa = Empresa::first();

        // return view('templates.aeste.index', [
        return view('templates.regna.index', [
        // return view('templates.mxtonz.index', [
            'empresa' => $empresa,
        ]);
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

