<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

return new class extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('startups', function (Blueprint $table) {
            $table->id();
            $table->string('name_of_firm');
            $table->string('year_of_operation');
            $table->string('size_of_company');
            $table->string('location_of_firm');
            $table->string('gender_of_entrepreneurs');
            $table->text('sector')->nullable();
            $table->string('status_of_firm')->default('Active');
            $table->timestamps();
        });
    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down()
    {
        Schema::dropIfExists('startups');
    }
};
