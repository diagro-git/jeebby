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
        Schema::create('flow_storage_fields', function (Blueprint $table) {
            $table->id();
            $table->foreignIdFor(\App\Models\Flow::class);
            $table->string('name', 30);
            $table->unsignedTinyInteger('type');
            $table->boolean('input')->default(false);
            $table->boolean('output')->default(false);
            $table->timestamps();
            $table->softDeletes();

            $table->unique(['flow_id', 'name'], 'fsfin_unq');
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('flow_storage_fields');
    }
};
