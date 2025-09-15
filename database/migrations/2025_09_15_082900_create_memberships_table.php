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
        Schema::create('memberships', function (Blueprint $table) {
            $table->id();

            // Your Information Section
            $table->string('first_name');
            $table->string('last_name');
            $table->string('email');
            $table->string('phone_number');
            $table->text('residential_area')->nullable();

            // Additional Information Section
            $table->string('chapter_applying_for')->nullable();
            $table->enum('nepali_citizen', ['yes', 'no'])->nullable();
            $table->text('academic_qualification')->nullable();
            $table->enum('marital_status', ['single', 'married', 'divorced', 'widowed'])->nullable();
            $table->text('organization_member')->nullable(); // If member of other organization
            $table->string('sector')->nullable();

            // Country Details Section
            $table->string('city')->nullable();
            $table->text('address')->nullable();
            $table->string('website')->nullable();
            $table->integer('number_of_employees')->nullable();
            $table->string('organization_telephone')->nullable();
            $table->string('organization_email')->nullable();

            // Application status and metadata
            $table->enum('status', ['pending', 'approved', 'rejected'])->default('pending');
            $table->text('admin_notes')->nullable();
            $table->timestamp('submitted_at')->useCurrent();
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
        Schema::dropIfExists('memberships');
    }
};
