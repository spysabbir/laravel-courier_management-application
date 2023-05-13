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
        Schema::create('courier_summaries', function (Blueprint $table) {
            $table->id();
            $table->integer('tracking_id');
            $table->string('sender_type');
            $table->integer('sender_branch_id');
            $table->string('sender_name');
            $table->string('sender_email')->nullable();
            $table->string('sender_phone_number');
            $table->text('sender_address');
            $table->integer('receiver_branch_id');
            $table->string('receiver_name');
            $table->string('receiver_email')->nullable();
            $table->string('receiver_phone_number');
            $table->text('receiver_address');
            $table->longText('special_comment')->nullable();
            $table->float('grand_total');
            $table->string('payment_type');
            $table->string('payment_status')->default('Unpaid');
            $table->float('payment_amount')->nullable();
            $table->string('courier_status')->default('Processing');
            $table->integer('sender_agent_id');
            $table->integer('delivery_agent_id')->nullable();
            $table->integer('otp')->nullable();
            $table->timestamps();
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('courier_summaries');
    }
};
