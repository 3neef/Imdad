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
        Schema::create('prodcuts', function (Blueprint $table) {
            $table->id();
            $table->foreignId('categories_id')->references('id')->on('categories')->onDelete('cascade');
            $table->foreignId('company_id')->references('id')->on('company_info')->onDelete('cascade');
            $table->string('name');
            $table->integer('price');
            $table->string('image');
            $table->timestamps();
            $table->softDeletes();
        });
    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down()
    {
        Schema::dropIfExists('prodcuts');
    }
};
