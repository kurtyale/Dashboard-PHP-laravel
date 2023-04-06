<?php

namespace App\Services;

use App\Models\Temperature;
use Illuminate\Http\Request;

class UmidadeService
{
    protected $temperature;
    protected $request;

    public function __construct(Temperature $temperature, Request $request)
    {
        $this->temperature = $temperature;
        $this->request = $request;
    }

    public function search()
    {

        $umidades = Temperature::currentDate()
            ->groupBy('nome')
            ->selectRaw('nome, MAX(timedata) as timedata, MAX(umidade) as maxumidade, MAX(temperatura) as maxtemperatura, MIN(temperatura) as mintemperatura, MIN(umidade) as minumidade')
            ->get();

        return $umidades;
    }

    public function Sensores()
    {

        $qtdSensores = Temperature::currentDate()
            ->selectRaw('COUNT(DISTINCT nome) as Sensores')
            ->get();

        return $qtdSensores;
    }

    public static function MaxTempSemana()
    {

        $query = Temperature::query();

        $dataset = $query
            ->select('nome', Temperature::raw('MAX(temperatura) as max_temperatura'), Temperature::raw('DAYNAME(timedata) as dia_semana'))
            ->whereRaw('WEEK(timedata, 1) = WEEK(CURDATE(), 1)')
            ->groupBy('nome', Temperature::raw('DAYNAME(timedata)'))
            ->get();

        $datasets = [];
        $labels = [];
        $nome = [];
        $alpha = 0.3;
        foreach ($dataset as $dado) {

            if (!in_array($dado->dia_semana, $labels)) {
                array_push($labels, $dado->dia_semana);
            }
            if (!in_array($dado->nome, $nome)) {
                array_push($nome, $dado->nome);
            }
        }

        for ($i = 0; $i < count($nome); $i++) {

            $temperaturas = array_fill(0, 5, null);
            foreach ($dataset as $dado) {
                if ($nome[$i] == $dado->nome) {

                    $index = array_search($dado->dia_semana, $labels);
                    array_splice($temperaturas, $index, 0, $dado->max_temperatura);
                }
            }
            $alpha += 0.1;
            $backgroundColor = "rgba(235, 22, 22, {$alpha})";
            $objeto = [
                "label" => $nome[$i],
                "data" => $temperaturas,
                "backgroundColor" => $backgroundColor
            ];
            array_push($datasets, $objeto);
        }

        $retorno = ["labels" => $labels, "datasets" => $datasets];
        return $retorno;
    }
}
