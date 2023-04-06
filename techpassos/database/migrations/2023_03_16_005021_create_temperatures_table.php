<?php

use Carbon\Carbon;
use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

return new class extends Migration
{
    /**
     * Run the migrations.
     */
public function up()
{
    Schema::create('temperatures', function (Blueprint $table) {
        $table->id();
        $table->decimal('temperatura', 5, 2);
        $table->decimal('umidade', 5, 2);
        $table->string('nome', 50);
        $table->string('MAC', 17);
        $table->timestamp('timedata')->default(Carbon::now('America/Sao_Paulo'));
        $table->timestamps();
    });
}

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('temperatures');
    }
};
