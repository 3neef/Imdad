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
            $table->foreignId("company_id")->constrained();
            $table->foreignId("city_id")->constrained();
            $table->string("address_name",255);
            $table->string("address_details",255);
            $table->string("address_contact_phone",15);
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
