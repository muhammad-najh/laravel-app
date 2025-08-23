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
        Schema::create('my_sub_services_cat', function (Blueprint $table) {
            $table->id();
            $table->bigInteger('service_id')->unsigned();

            $table->string('name_en')->nullable();
            $table->string('name_ar')->nullable();
            $table->string('name_krd')->nullable();
            $table->string('slug')->nullable();
            $table->timestamps();

            $table->foreign('service_id')
            ->references('id')
            ->on('my_services_cat')
            ->onCascade('delete');
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('my_sub_services_cat');
    }
};
