<?php

namespace App\Http\Controllers;

use App\Services\TabelaService;
use Illuminate\Http\Request;

class TabelaController extends Controller
{
    public function gettabela(Request $request)
    {
        $nomes = TabelaService::getTodosNomes();
        $tabela = TabelaService::tabelaindex($request->dataInicio, $request->dataFim, $request->nomesSelecionados);

        if ($request->ajax()) {
            return response()->json([
                'nomes' => $nomes,
                'tabela' => $tabela
            ]);
        }

        return view('tabela', [
            'nomes' => $nomes,
            'tabela' => $tabela
        ]);
    }


    public function getnomes(TabelaService $TabelaService)
    {

        $nomes = $TabelaService->getTodosNomes();

        return view('index', [
            'nomes' => $nomes
        ]);
    }
}
