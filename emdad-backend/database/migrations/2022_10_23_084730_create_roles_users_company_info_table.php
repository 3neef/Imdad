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
        Schema::create('roles_users_company_info', function (Blueprint $table) {
            $table->id();
            $table->foreignId('roles_id')->nullable(true)->references("id")->on("roles")->restrictOnDelete();
            $table->foreignId('users_id')->nullable(true)->references("id")->on("users")->restrictOnDelete();
            $table->foreignId('company_info_id')->nullable(true)->references("id")->on("company_info")->restrictOnDelete();
            $table->unique(["roles_id","users_id","company_info_id","deleted_at"]);
            $table->softDeletes();
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
        Schema::dropIfExists('roles_users_company_info');
    }
};
