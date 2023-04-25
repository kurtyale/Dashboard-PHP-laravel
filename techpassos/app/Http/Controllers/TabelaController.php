<?php

namespace App\Http\Controllers;

use Dompdf\Dompdf;
use App\Services\TabelaService;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Response;


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


    public function ImprimirPDF(Request $request)
    {
        $tabela = TabelaService::tabelaPDF($request->dataInicio, $request->dataFim, $request->nomesSelecionados);

        // Renderiza a view pdf.blade.php com os dados da tabela
        $html = view('pdf', ['tabela' => $tabela])->render();

        // Cria uma nova instância do Dompdf
        $dompdf = new Dompdf();

        // Carrega o HTML no Dompdf
        $dompdf->loadHtml($html);

        // Renderiza o HTML em PDF
        $dompdf->render();

        // Obtém o conteúdo do PDF gerado
        $pdf = $dompdf->output();

        // Define o cabeçalho Content-Type como application/pdf
        $headers = [
            'Content-Type' => 'application/pdf',
        ];

        // Retorna o PDF como resposta
        return response()->make($pdf, 200, $headers);
    }

}
