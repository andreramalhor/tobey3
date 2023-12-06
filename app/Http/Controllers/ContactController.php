<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\Comercial\Lead;

class ContactController extends Controller
{
    public function index()
    {
        return view('site-regna.index');
        // return view('site2.layouts.app2');
    }

    public function cadastro_lead()
    {
        return view('site-regna.cadastro_lead');
        // return view('site2.layouts.app2');
    }

    public function index_tres()
    {
        return view('site-regna.portfolio-details');
        // return view('site2.layouts.app2');
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create()
    {
        //
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function store(Request $request)
    {
        $contato = new ContactForm($request);

        try
        {
            $contato->enviarEmail();

            return back()->with('success', 'Obrigado por nos contactar.');
        }
        catch (\Exception $error)
        {
            return back()->with('error', "Ocorreu um erro inesperado: {$error->getMessage()}");                
        }
    }

    /**
     * Display the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function show($id)
    {
        //
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function edit($id)
    {
        //
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function update(Request $request, $id)
    {
        //
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function destroy($id)
    {
        //
    }
}
