<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

return new class extends Migration {
  public function up(): void {
    Schema::create('sdn_addresses', function (Blueprint $t) {
      $t->id();
      $t->foreignId('sdn_entry_id')->constrained('sdn_entries')->cascadeOnDelete();
      $t->string('address')->nullable();
      $t->string('city')->nullable()->index();
      $t->string('state')->nullable();
      $t->string('postal')->nullable();
      $t->string('country')->nullable()->index();
      $t->timestamps();
    });
  }

  public function down(): void {
    Schema::dropIfExists('sdn_addresses');
  }
};