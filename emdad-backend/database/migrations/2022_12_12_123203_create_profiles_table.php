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
        Schema::create('profiles', function (Blueprint $table) {
            $table->id();
            $table->integer('parent_id');
            $table->string('name_ar')->nullable();
            $table->string('name_en')->nullable();
            $table->string('swift')->nullable();
            $table->string('iban')->nullable();
            $table->enum('type', ['Buyer', 'supplier'])->nullable();
            $table->string('bank')->nullable();
            $table->date('cr_expire_data')->nullable();
            $table->foreignId('subs_id')->nullable();
            $table->json('subscription_details')->nullable();
            $table->string('vat_number')->nullable();
            $table->string('cr_number')->nullable();
            $table->boolean('active')->default(false);

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
        Schema::dropIfExists('profiles');
    }
};
