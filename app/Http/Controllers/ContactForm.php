<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Mail;
use App\Mail\Contact;

class ContactForm extends Controller
{
    private $nome;
    private $email;
    private $mensagem;

    public function __construct(Request $request)
    {
        $this->nome     = $request->nome;
        $this->empresa  = $request->empresa;
        $this->email    = $request->email;
        $this->telefone = $request->telefone;
        $this->mensagem = $request->mensagem;
    }

    public function enviarEmail()
    {
        $data = array(
            'nome'     => $this->nome,
            'empresa'    => $this->empresa,
            'email' => $this->email,
            'telefone' => $this->telefone,
            'mensagem' => $this->mensagem,
        );

        Mail::to( config('mail.from.address') )
            ->send( new Contact($data) );
    }

}
