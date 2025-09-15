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
        Schema::create('membership_contents', function (Blueprint $table) {
            $table->id();
            $table->string('section_key')->unique(); // e.g., 'hero_title', 'benefits_section', etc.
            $table->string('section_name'); // Display name for admin
            $table->string('content_type')->default('text'); // text, textarea, image, rich_text
            $table->text('content')->nullable();
            $table->text('description')->nullable(); // Helper text for admin
            $table->integer('order')->default(0);
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
        Schema::dropIfExists('membership_contents');
    }
};
