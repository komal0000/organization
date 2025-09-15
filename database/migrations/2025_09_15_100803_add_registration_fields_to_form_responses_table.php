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
        Schema::table('form_responses', function (Blueprint $table) {
            $table->string('status')->default('pending')->after('responses');
            $table->timestamp('submitted_at')->nullable()->after('status');
            $table->text('admin_notes')->nullable()->after('submitted_at');
        });
    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down()
    {
        Schema::table('form_responses', function (Blueprint $table) {
            $table->dropColumn(['status', 'submitted_at', 'admin_notes']);
        });
    }
};
