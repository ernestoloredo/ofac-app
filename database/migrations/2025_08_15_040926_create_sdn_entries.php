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
        Schema::create('sdn_entries', function (Blueprint $t) {
          $t->id();
          $t->string('uid_xml')->index();           // unique id del XML
          $t->enum('list_type',['sdn','consolidated'])->index();
          $t->string('name')->index();
          $t->string('entity_type',32)->nullable()->index();
          $t->text('remarks')->nullable();
          $t->string('program_summary')->nullable();
          $t->date('source_date')->nullable();
          $t->string('version_ns')->nullable();     // namespace/version del XML
          $t->boolean('active')->default(true)->index();
          $t->timestamps();
          $t->unique(['uid_xml','list_type']);
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('sdn_entries');
    }
};
