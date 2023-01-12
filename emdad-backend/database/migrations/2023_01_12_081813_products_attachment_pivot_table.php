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
        Schema::create('products_attachment_pivot', function (Blueprint $table) {
            $table->id();
            $table->foreignId('file_type_id')->nullable();
            $table->foreignId('product_id')->nullable();
            $table->string('image_path');
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
        Schema::dropIfExists('products_attachment_pivot');
    }
};
