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
        Schema::create('trips', function (Blueprint $table) {
            $table->id();
            $table->integer('bus_id')->unsigned();
            $table->foreign('bus_id')->references('id')->on('buses');

            $table->string('from');
            $table->string('to');

            $table->datetime('date_of_trip');
            $table->integer('vip_chairs')->default(1);
            $table->integer('customer_chairs')->default(1);

            $table->longText('notes')->nullable();
            $table->string('file')->nullable();

            $table->integer('created_by')->nullable();
            $table->integer('updated_by')->nullable();

            $table->timestamps();
            $table->softDeletes();
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('trips');
    }
};
