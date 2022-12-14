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
        Schema::create('warehouses', function (Blueprint $table) {
            $table->id();
            $table->timestamps();
            $table->unsignedBigInteger("profile_id")->nullable();
            $table->string("address_name",255);
            $table->string("address_contact_phone",15);
            $table->string("address_contact_name",25);
            $table->string("address_type");
            $table->string("gate_type");
            $table->string('latitude');
            $table->string('longitude');
            $table->boolean("otp_verfied")->default(false);
            $table->timestamp("otp_expires_at")->nullable();
            $table->string("otp_receiver",6)->nullable();
            $table->enum('status',['Pending', 'Active'])->default('Pending');
            $table->foreignId('confirm_by')->nullable(true)->references("id")->on("users")->restrictOnDelete();
            $table->foreignId('created_by')->nullable(true)->references("id")->on("users")->restrictOnDelete();
            $table->softDeletes();

            $table->foreign('profile_id')->references('id')->on('profiles')->onDelete('cascade');
        });
    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down()
    {
        Schema::dropIfExists('warehouses');
    }
};
