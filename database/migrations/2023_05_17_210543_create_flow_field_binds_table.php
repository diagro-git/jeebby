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
        Schema::create('flow_field_binds', function (Blueprint $table) {
            $table->id();
            $table->foreign(\App\Models\Team::class);
            $table->foreign(\App\Models\FlowStorageField::class, 'flow_storage_field_input_id');
            $table->foreign(\App\Models\FlowStorageField::class, 'flow_storage_field_output_id');
            $table->timestamps();
            $table->softDeletes();
            $table->unique(['flow_storage_field_input_id', 'flow_storage_field_output_id'], 'bind_uq_1');
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('flow_field_binds');
    }
};
