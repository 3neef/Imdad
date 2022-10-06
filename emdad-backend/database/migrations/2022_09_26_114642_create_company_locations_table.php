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
        Schema::create('company_locations', function (Blueprint $table) {
            $table->id();
            $table->timestamps();
            $table->unsignedBigInteger("company_id");
            $table->unsignedBigInteger("city_id");
            $table->string("address_name",255);
            $table->string("address_details",255);
            $table->string("address_contact_phone",15);

            $table->foreign('company_id')->references('id')->on('company_infos')->onDelete('cascade');
            $table->foreign('city_id')->references('id')->on('city')->onDelete('cascade');
        });
    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down()
    {
        Schema::dropIfExists('company_locations');
    }
};
