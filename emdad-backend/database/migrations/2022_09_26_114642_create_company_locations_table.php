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
            $table->string("address_name",255);
            $table->string("address_contact_phone",15);
            $table->string("address_contact_name",25);
            $table->string("address_type");
            $table->string("gate_type");
            $table->string('latitude_longitude');
            $table->boolean("otp_verfied")->default(false);
            $table->timestamp("otp_expires_at")->nullable();
            $table->string("otp_receiver",6)->nullable();
            $table->foreignId('confirm_by')->references("id")->on("users")->restrictOnDelete()->restrictOnUpdate()->nullable();

            $table->foreign('company_id')->references('id')->on('company_info')->onDelete('cascade');
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
