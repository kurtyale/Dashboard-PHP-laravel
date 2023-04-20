<?php

namespace App\Services;

use App\Models\Temperature;
use Illuminate\Http\Request;

class TabelaService
{

    protected $temperature;
    protected $request;


    public static function tabelaindex()
    {

        $query = Temperature::query();

        $dado = $query;

        return view('tabela');
    }

    public static function getTodosNomes()
    {
        $query = Temperature::query();

        $tabela = $query
        ->select('nome')
        ->groupBy('nome')
        ->get();
        return $tabela;

    }
}
