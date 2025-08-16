<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

return new class extends Migration {
  public function up(): void {
    Schema::create('sdn_programs', function (Blueprint $t) {
      $t->id();
      $t->foreignId('sdn_entry_id')->constrained('sdn_entries')->cascadeOnDelete();
      $t->string('program_code')->index();
      $t->timestamps();
    });
  }

  public function down(): void {
    Schema::dropIfExists('sdn_programs');
  }
};
