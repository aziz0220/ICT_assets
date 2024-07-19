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
        Schema::create('assets', function (Blueprint $table) {
            $table->id();
            $table->string('asset_name');
            $table->date('purchased_date');
            $table->date('end_of_life');
            $table->text('warrant');
            $table->integer('quantity');
            $table->boolean('is_registered');
            $table->boolean('head_approval')->nullable();
            $table->unsignedBigInteger('vendor_id');
            $table->foreign('vendor_id')->references('id')->on('vendors');
            $table->unsignedBigInteger('category_id');
            $table->foreign('category_id')->references('id')->on('asset_categories');
            $table->unsignedBigInteger('status_id');
            $table->foreign('status_id')->references('id')->on('asset_statuses');
            $table->unsignedBigInteger('standard_id');
            $table->foreign('standard_id')->references('id')->on('asset_standards');
            $table->unsignedBigInteger('created_by'); // User who created the asset
            $table->foreign('created_by')->references('id')->on('users'); // Foreign key constraint
            $table->timestamps();
            $table->softDeletes();
        });
//        Schema::create('asset_vendor', function (Blueprint $table) {
//            $table->id();
//            $table->foreignIdFor(\App\Models\Asset::class)->constrained()->cascadeOnDelete();
//            $table->foreignIdFor(\App\Models\Vendor::class)->constrained()->cascadeOnDelete();
//            $table->timestamps();
//        });
    }

    /**
     * Reverse the migrations.
     */

    public function down(): void
    {
        Schema::dropIfExists('assets');
//        Schema::dropIfExists('asset_vendor');
    }
};
