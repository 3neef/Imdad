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
        Schema::table('prodcuts', function (Blueprint $table) {
            $table->foreignId('measruing_unit')->references('id')->on('unit_of_measures')->onDelete('cascade');

        });
    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down()
    {
        Schema::table('prodcuts', function (Blueprint $table) {
            $table->dropForeign(['measruing_unit']);
        });
    }
};
