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
        Schema::create('default_settings', function (Blueprint $table) {
            $table->id();
            $table->string('app_name')->default('Laravel');
            $table->string('app_url')->default('http://127.0.0.1:8000/');
            $table->string('time_zone')->default("UTC");
            $table->string('favicon')->default('default_favicon.png');
            $table->string('logo_photo')->default('default_logo_photo.png');
            $table->string('main_phone')->nullable();
            $table->string('support_phone')->nullable();
            $table->string('main_email')->nullable();
            $table->string('support_email')->nullable();
            $table->text('address')->nullable();
            $table->text('google_map_link')->nullable();
            $table->string('facebook_link')->nullable();
            $table->string('twitter_link')->nullable();
            $table->string('instagram_link')->nullable();
            $table->string('linkedin_link')->nullable();
            $table->string('youtube_link')->nullable();
            $table->integer('created_by');
            $table->integer('updated_by')->nullable();
            $table->timestamps();
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('default_settings');
    }
};
