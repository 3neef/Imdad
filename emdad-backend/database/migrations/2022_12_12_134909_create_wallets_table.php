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
        Schema::create('wallets', function (Blueprint $table) {
            $table->id();
            $table->nullableMorphs('accountable');
            $table->double('balance')->default(0);
            $table->double('pending')->default(0);
            $table->string('card_number')->nullable();
            $table->string('password')->nullable();
            $table->boolean('main')->default(0);
            $table->set('type', ['sender', 'receiver', 'both']);
            $table->set('status', ['active', 'disabled'])->default('active');
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
        Schema::dropIfExists('wallets');
    }
};
