<?php

namespace App\Http\Controllers;

use App\Models\Temperature;
use DateTime;
use DateTimeZone;
use Illuminate\Http\Request;

class TemperaturaController extends Controller
{
    /**
     * Display a listing of the resource.
     */
    public function index()
    {

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
           // Get the authentication token from the request headers
           $token = $request->header('Authorization');


           // If the token is missing or invalid, return an error response
           if ($token !== 'TESTEDETOKEN') {
               return response()->json(['error' => 'Invalid token'], 401);
           }

           // Get the current date and time in São Paulo
           $date = new DateTime('now', new DateTimeZone('America/Sao_Paulo'));
           $formatted_date = $date->format('Y-m-d H:i:s');
           // Get the data from the request body
           $data = $request->json()->all();

           // Create a new Temperature object and save it to the database
           $temperature = new Temperature;
           $temperature->temperatura = $data['temperatura'];
           $temperature->umidade = $data['umidade'];
           $temperature->nome = $data['nome'];
           $temperature->MAC = $data['MAC'];
           $temperature->timedata = $formatted_date; // Add the new column to the insert statement
           $temperature->save();

           // Return a success response
           return response()->json(['message' => 'Dados armazenados com sucesso']);
    }

    /**
     * Display the specified resource.
     */
    public function show(string $id)
    {
        //
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
