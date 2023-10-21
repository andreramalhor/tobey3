<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Maatwebsite\Excel\Facades\Excel;
use App\Models\Comercial\Lead;

class LeadsController extends Controller
{
    public function index()
    {
        return view('welcome');
    }

    public function import()
    {
        $filename = 'example.xlsx';
        $path = public_html('file/'. $filename);

        return response()->download($path, $filename, [
            'Content-Type' => 'application/vnd.ms-excel',
            'Content-Disposition' => 'inline; filename="'. $filename . '"'
        ]);
    }
}
