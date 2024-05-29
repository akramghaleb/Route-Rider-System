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
        Schema::create('bus_services', function (Blueprint $table) {
            $table->id();
            $table->integer('bus_id')->unsigned();
            $table->foreign('bus_id')->references('id')->on('buses');

            $table->string('type');
            $table->string('name');
            $table->longText('description')->nullable();

            $table->integer('created_by')->nullable();
            $table->integer('updated_by')->nullable();

            $table->timestamps();
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('bus_services');
    }
};
