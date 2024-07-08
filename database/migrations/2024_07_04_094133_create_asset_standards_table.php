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
        Schema::create('asset_standards', function (Blueprint $table) {
            $table->id();
            $table->text('item_name');
            $table->unsignedBigInteger('created_by')->nullable(); // User who created the asset
            $table->foreign('created_by')->references('id')->on('users'); // Foreign key constraint
            $table->timestamps();
            $table->softDeletes();
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('asset_standards');
    }
};
