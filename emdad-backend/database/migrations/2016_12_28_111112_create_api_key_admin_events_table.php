<?php

use Illuminate\Support\Facades\Schema;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Database\Migrations\Migration;

class CreateApiKeyAdminEventsTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('x-authorization_admin_events', function (Blueprint $table) {
            $table->increments('id');
            $table->unsignedInteger('x-authorization_id');
            $table->ipAddress('ip_address');
            $table->string('event');
            $table->timestamps();

            $table->index('ip_address');
            $table->index('event');
            $table->foreign('x-authorization_id')->references('id')->on('x-authorizations');
        });
    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down()
    {
        Schema::dropIfExists('x-authorization_admin_events');
    }
}
