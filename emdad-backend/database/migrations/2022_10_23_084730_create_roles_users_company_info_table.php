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
            $table->foreignId('roles_id')->nullable(true)->references("id")->on("roles")->cascadeOnDelete();
            $table->foreignId('users_id')->nullable(true)->references("id")->on("users")->cascadeOnDelete();
            $table->foreignId('company_info_id')->nullable(true)->references("id")->on("company_info")->cascadeOnDelete();
            $table->unique(["roles_id","users_id","company_info_id","deleted_at"])->name("user_role_company_deletedat");
            $table->softDeletes();
            $table->tinyInteger("status")->default(1)->comment("1=active,0=inactive");
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
