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
        Schema::create('essential_files', function (Blueprint $table) {
            $table->id();
            $table->string('title');
            $table->string('document'); // File path for the document
            $table->string('file_type')->nullable(); // pdf, docx, etc.
            $table->integer('file_size')->nullable(); // File size in bytes
            $table->integer('order')->default(0); // Display order
            $table->boolean('is_active')->default(true);
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
        Schema::dropIfExists('essential_files');
    }
};
