<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

return new class extends Migration
{
    /**
     * Run the migrations.
     *php
     * @return void
     */
    public function up()
    {
        Schema::table('recipes', function (Blueprint $table) {
            Schema::table('recipes', function (Blueprint $table) {
                $table->text('ingredients')->nullable()->after('category');
            });
        });
    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down()
    {
        Schema::table('recipes', function (Blueprint $table) {
            Schema::table('recipes', function (Blueprint $table) {
                $table->dropColumn('ingredients');
            });
        });
    }
};
