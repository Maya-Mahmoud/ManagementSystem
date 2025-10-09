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
        Schema::create('departments', function (Blueprint $table) {
            $table->id();
            $table->string('name')->unique();
            $table->timestamps();
        });

        // Insert fixed departments
        DB::table('departments')->insert([
            ['name' => 'communications'],
            ['name' => 'energy'],
            ['name' => 'marine'],
            ['name' => 'design_and_production'],
            ['name' => 'computers'],
            ['name' => 'medical'],
            ['name' => 'mechatronics'],
            ['name' => 'power'],
        ]);
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('departments');
    }
};
