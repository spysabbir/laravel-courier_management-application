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
        Schema::create('courier_details', function (Blueprint $table) {
            $table->id();
            $table->unsignedBigInteger('courier_summary_id');

            $table->text('item_description');
            $table->integer('unit_id');
            $table->integer('item_quantity');
            $table->float('cost_rate');
            $table->float('total_cost_rate');

            $table->foreign('courier_summary_id')->references('id')->on('courier_summaries')->onDelete('cascade');
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('courier_details');
    }
};
