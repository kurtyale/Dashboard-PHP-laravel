<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Temperature extends Model
{
    use HasFactory;

    protected $table = 'temperatures';

    protected $fillable = [
        'temperatura',
        'umidade',
        'nome',
        'MAC',
        'timedata'
    ];

    public function scopeCurrentDate($query)
    {
        $now = \Carbon\Carbon::now()->setTimezone('America/Sao_Paulo');
        $dateString = $now->toDateString();
        return $query->whereDate('timedata', '=', $dateString);
    }
}
