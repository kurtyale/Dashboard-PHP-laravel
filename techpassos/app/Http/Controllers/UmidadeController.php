<?php

namespace App\Http\Controllers;

use App\Models\Temperature;
use App\Services\UmidadeService;
use Illuminate\Http\Request;

class UmidadeController extends Controller
{
    /**
     * Display a listing of the resource.
     */
    public function index(UmidadeService $umidadeService)
    {

        $umidades = $umidadeService->search();
        $qtdSensores = $umidadeService->Sensores(); // chamar o método Sensores() para obter a quantidade de sensores
        $datasets   = $umidadeService->MaxTempSemana();

        return view('index', [
            'umidades' => $umidades,
            'qtdSensores' => $qtdSensores
        ]);

    }

    public function getData(Request $request){
        $id = $request->id;
        $response = UmidadeService::MaxTempSemana();
        return response()->json($response);
    }



    /**
     * Show the form for creating a new resource.
     */
    public function create()
    {
        //
    }

    /**
     * Store a newly created resource in storage.
     */
    public function store(Request $request)
    {
        //
    }

    /**
     * Display the specified resource.
     */
    public function show(string $id)
    {


    }

    /**
     * Show the form for editing the specified resource.
     */
    public function edit(string $id)
    {
        //
    }

    /**
     * Update the specified resource in storage.
     */
    public function update(Request $request, string $id)
    {
        //
    }

    /**
     * Remove the specified resource from storage.
     */
    public function destroy(string $id)
    {
        //
    }
}
