<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

return new class extends Migration
{
    /**
     * Run the migrations.
     */
    public function up(): void
    {
        Schema::create('sdn_akas', function (Blueprint $t) {
            $t->id();
            $t->foreignId('sdn_entry_id')->constrained()->cascadeOnDelete();
            $t->string('alias')->index();
            $t->enum('strength',['weak','strong'])->nullable()->index();
            $t->timestamps();
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('sdn_akas');
    }
};
