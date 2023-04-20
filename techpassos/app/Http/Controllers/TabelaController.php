<?php

namespace App\Http\Controllers;

use App\Services\TabelaService;
use Illuminate\Http\Request;

class TabelaController extends Controller
{

    public function gettabela(Request $request)
    {
        $id = $request->id;
        $tabela = TabelaService::getTodosNomes();
        $responses = TabelaService::tabelaindex();

        return view('tabela', [
            'tabela' => $tabela
        ]);

    }

    public function getnomes(TabelaService $TabelaService)
    {

        $tabela = $TabelaService->getTodosNomes();

        return view('index', [
            'tabela' => $tabela
        ]);
    }
}
