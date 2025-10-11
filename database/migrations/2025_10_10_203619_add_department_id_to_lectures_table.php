<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;
use Illuminate\Support\Facades\DB;

return new class extends Migration
{
    /**
     * Run the migrations.
     */
    public function up(): void
    {
        DB::statement('ALTER TABLE lectures DROP FOREIGN KEY IF EXISTS lectures_department_id_foreign');
        Schema::table('lectures', function (Blueprint $table) {
            $table->foreignId('department_id')->nullable()->change();
        });
        DB::statement('UPDATE lectures SET department_id = NULL;');
        Schema::table('lectures', function (Blueprint $table) {
            $table->foreign('department_id')->references('id')->on('departments')->onDelete('cascade');
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::table('lectures', function (Blueprint $table) {
            //
        });
    }
};
