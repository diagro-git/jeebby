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
        Schema::create('installation_statusses', function (Blueprint $table) {
            $table->id();
            $table->foreignIdFor(\App\Models\Team::class);
            $table->foreignIdFor(\App\Models\Flow::class);
            $table->unsignedTinyInteger('status');
            $table->string('message');
            $table->timestamps();
            $table->softDeletes();
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('installation_statusses');
    }
};
