<?php

namespace App\Services;

use App\Models\Temperature;
use Carbon\Carbon;
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
            ->select('nome', Temperature::raw('MAX(temperatura) as max_temperatura'), Temperature::raw("DATE_FORMAT(timedata, '%d/%m/%Y') as dia_semana"))
            ->whereRaw('WEEK(timedata, 1) = WEEK(CURDATE(), 1)')
            ->groupBy('nome', Temperature::raw("DATE_FORMAT(timedata, '%d/%m/%Y')"))
            ->get();


        $datasetmin = $query
            ->select('nome', Temperature::raw('MIN(temperatura) as min_temperatura'), Temperature::raw("DATE_FORMAT(timedata, '%d/%m/%Y') as dia_semana"))
            ->whereRaw('WEEK(timedata, 1) = WEEK(CURDATE(), 1)')
            ->groupBy('nome', Temperature::raw("DATE_FORMAT(timedata, '%d/%m/%Y')"))
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
        foreach($datasetmin as $dadomin){
            if (!in_array($dadomin->dia_semana, $labels)) {
                array_push($labels, $dadomin->dia_semana);
            }
            if (!in_array($dadomin->nome, $nome)) {
                array_push($nome, $dadomin->nome);
            }
        }


        for ($i = 0; $i < count($nome); $i++) {

            $temperaturas = array_fill(0, 6, null);
            $temperaturas2 = array_fill(0, 6, null);
            foreach ($dataset as $dado) {
                if ($nome[$i] == $dado->nome) {

                    $index = array_search($dado->dia_semana, $labels);
                    array_splice($temperaturas, $index, 0, $dado->max_temperatura);
                }
            }
            $alpha += 0.1;
            $backgroundColor = "rgba(247, 100, 32 , {$alpha})";
            $objeto = [
                "label" => $nome[$i],
                "data" => $temperaturas,
                "backgroundColor" => $backgroundColor
            ];
            array_push($datasets, $objeto);

          //segundo
            foreach ($datasetmin as $dadomin) {
                if ($nome[$i] == $dadomin->nome) {

                    $index = array_search($dadomin->dia_semana, $labels);
                    array_splice($temperaturas2, $index, 0, $dadomin->min_temperatura);
                }
            }
            $alpha += 0.1;
            $backgroundColor = "rgba(7, 235, 247 , {$alpha})";
            $objeto = [
                "label" => $nome[$i],
                "data" => $temperaturas2,
                "backgroundColor" => $backgroundColor
            ];
            array_push($datasets, $objeto);

        }

        $retorno = ["labels" => $labels, "datasets" => $datasets];
        return $retorno;
    }

    public static function MaxUmidSemana()
    {
        $query = Temperature::query();


        $dataset = $query
            ->select(
                'nome',
                Temperature::raw('MAX(umidade) as max_umidade'),
                Temperature::raw("DATE_FORMAT(timedata, '%d/%m/%Y') as dia_semana")
                )
            ->whereRaw('WEEK(timedata, 1) = WEEK(CURDATE(), 1)')
            ->groupBy('nome', Temperature::raw("DATE_FORMAT(timedata, '%d/%m/%Y')"))
            ->get();


        $datasetmin = $query
            ->select('nome', Temperature::raw('MIN(umidade) as min_umidade'), Temperature::raw("DATE_FORMAT(timedata, '%d/%m/%Y') as dia_semana"))
            ->whereRaw('WEEK(timedata, 1) = WEEK(CURDATE(), 1)')
            ->groupBy('nome', Temperature::raw("DATE_FORMAT(timedata, '%d/%m/%Y')"))
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

        foreach($datasetmin as $dadomin){
            if (!in_array($dadomin->dia_semana, $labels)) {
                array_push($labels, $dadomin->dia_semana);
            }
            if (!in_array($dadomin->nome, $nome)) {
                array_push($nome, $dadomin->nome);
            }
        }


        for ($i = 0; $i < count($nome); $i++) {

            $temperaturas = array_fill(0, 6, null);
            $temperaturas2 = array_fill(0, 6, null);
            foreach ($dataset as $dado) {
                if ($nome[$i] == $dado->nome && isset($dado->dia_semana) && isset($dado->max_umidade) && $dado->max_umidade !== null) {

                    $index = array_search($dado->dia_semana, $labels);
                    if ($dado->max_umidade !== null && $dado->dia_semana == $labels[$index]) {
                    array_splice($temperaturas, $index, 0, $dado->max_umidade);
                    }
                }
            }
            $alpha += 0.1;
            $backgroundColor = "rgba(35, 169, 255, {$alpha})";
            $objeto = [
                "label" => $nome[$i],
                "data" => $temperaturas,
                "backgroundColor" => $backgroundColor
            ];
            array_push($datasets, $objeto);

          //segundo
            foreach ($datasetmin as $dadomin) {
                if ($nome[$i] == $dadomin->nome) {

                    $index = array_search($dadomin->dia_semana, $labels);
                    if ($dadomin->min_umidade !== null && $dadomin->dia_semana == $labels[$index]) {
                    array_splice($temperaturas2, $index, 0, $dadomin->min_umidade);
                    }
                }
            }
            $alpha += 0.1;
            $backgroundColor = "rgba(65, 78, 255 , {$alpha})";
            $objeto = [
                "label" => $nome[$i],
                "data" => $temperaturas2,
                "backgroundColor" => $backgroundColor
            ];
            array_push($datasets, $objeto);

        }

        $retorno = ["labels" => $labels, "datasets" => $datasets];
        return $retorno;
    }
}
