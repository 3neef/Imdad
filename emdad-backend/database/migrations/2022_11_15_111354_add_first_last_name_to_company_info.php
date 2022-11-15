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
        Schema::table('company_info', function (Blueprint $table) {
            //
            $table->string("first_name",50);
            $table->string("last_name",50);
            $table->string("person_id",11);
            $table->string("id_type",10);
            $table->string('company_name')->nullable();

            $table->foreignId('roles_id')->nullable()->references("id")->on("roles")->restrictOnDelete();


        });
    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down()
    {
        Schema::table('company_info', function (Blueprint $table) {
            //
        });
    }
};
