<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

return new class extends Migration {
  public function up(): void {
    Schema::create('import_logs', function (Blueprint $t) {
      $t->id();
      $t->enum('list_type', ['sdn','consolidated']);
      $t->string('file_path');
      $t->string('sha256', 64)->index();
      $t->unsignedInteger('total')->default(0);
      $t->unsignedInteger('inserted')->default(0);
      $t->unsignedInteger('updated')->default(0);
      $t->unsignedInteger('deactivated')->default(0);
      $t->string('status', 16)->default('OK')->index();
      $t->timestamps();
    });
  }

  public function down(): void {
    Schema::dropIfExists('import_logs');
  }
};
