<?php

namespace App\Imports;

use App\Models\Atendimento\Pessoa;
use App\Models\Comercial\Lead;
use App\Models\Comercial\LeadFila;
use Illuminate\Support\Collection;
use Maatwebsite\Excel\Concerns\ToCollection;
use Maatwebsite\Excel\Concerns\WithHeadingRow;

class LeadsImport implements ToCollection, WithHeadingRow
{
    public function collection(Collection $rows)
    {
        $lista_atendente = Pessoa::vendedores()->orderBy('id')->pluck('id')->toArray();
        $atual_atendente = LeadFila::first()->proxima_pessoa;

        foreach ($lista_atendente as $key => $value)
        {
            if($value == $atual_atendente)
            {
                $index = $key;
            }
        }

        foreach ($rows as $chave => $row)
        {
            if($row['id_pessoa'] != null)
            {
                Lead::create([
                    'id_pessoa'           => $row['id_pessoa'] ?? null,
                    'nome'                => $row['nome'] ?? null,
                    'telefone'            => $row['telefone'] ?? 1111,
                    'obs'                 => $row['obs'] ?? null,
                    'cidade'              => $row['cidade'] ?? null,
                    'email'               => $row['email'] ?? null,
                    'interesse'           => $row['interesse'] ?? 1111,
                    'id_consultor'        => $row['id_consultor'] ?? $lista_atendente[$index],
                    'endereco'            => $row['endereco'] ?? null,
                    'id_origem'           => $row['id_origem'] ?? null,
                    'status'              => $row['status'] ?? null,
                    'arquivado_favorito'  => $row['arquivado_favorito'] ?? null,
                    'favorito'            => $row['favorito'] ?? null,
                    'arquivado'           => $row['arquivado'] ?? null,
                    'proximo_atendimento' => \Carbon\Carbon::now()
                ]);

                if(is_null($row['id_consultor']))
                {
                    if( ($index+1) < count($lista_atendente) )
                    {
                        $index = $index + 1;
                        LeadFila::find(1)->update(['proxima_pessoa' => $lista_atendente[$index]]);
                    }
                    else
                    {
                        $index = 0;
                        LeadFila::find(1)->update(['proxima_pessoa' => $lista_atendente[$index]]);
                    }
                }
            }
        }
    }

}
