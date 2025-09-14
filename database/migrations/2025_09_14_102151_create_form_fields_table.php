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
        Schema::create('form_fields', function (Blueprint $table) {
            $table->id();
            $table->foreignId('form_id')->constrained()->onDelete('cascade');
            $table->string('type'); // text, textarea, select, radio, checkbox, email, number, date, file
            $table->string('label');
            $table->string('name');
            $table->text('description')->nullable();
            $table->text('placeholder')->nullable();
            $table->json('options')->nullable(); // For select, radio, checkbox options
            $table->boolean('is_required')->default(false);
            $table->integer('order')->default(0);
            $table->json('validation_rules')->nullable(); // Additional validation rules
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
        Schema::dropIfExists('form_fields');
    }
};
