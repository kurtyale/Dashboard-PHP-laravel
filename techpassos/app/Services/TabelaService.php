<?php

namespace App\Services;

use App\Models\Temperature;

class TabelaService
{
    public static function tabelaindex($dataInicio, $dataFim, $nomesSelecionados)
    {
        $query = Temperature::query();

        if (empty($nomesSelecionados)) {
            $dataInicio = date('Y-m-d', strtotime(str_replace('/', '-', $dataInicio)));
            $dataFim = date('Y-m-d', strtotime(str_replace('/', '-', $dataFim)));

            $tabela = $query
                ->select('temperatura', 'umidade', 'nome', Temperature::raw('DATE_FORMAT(timedata, "%d-%m-%Y") as data'), Temperature::raw('TIME(timedata) as hora'))
                ->whereBetween('timedata', [$dataInicio . ' 00:00:00', $dataFim . ' 23:59:59'])
                ->get();

        } else {
            $dataInicio = date('Y-m-d', strtotime(str_replace('/', '-', $dataInicio)));
            $dataFim = date('Y-m-d', strtotime(str_replace('/', '-', $dataFim)));

            $tabela = $query
                ->select('temperatura', 'umidade', 'nome', Temperature::raw('DATE_FORMAT(timedata, "%d-%m-%Y") as data'), Temperature::raw('TIME(timedata) as hora'))
                ->whereBetween('timedata', [$dataInicio . ' 00:00:00', $dataFim . ' 23:59:59'])
                ->whereIn('nome', $nomesSelecionados)
                ->get();


        }

        return $tabela;
    }

    public static function getTodosNomes()
    {
        return Temperature::select('nome')->distinct()->get();
    }
}
