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
        Schema::create('department_company_user', function (Blueprint $table) {
            $table->id();
            $table->foreignId('department_id')->nullable()->restrictOnDelete();
            $table->foreignId('user_id')->nullable()->restrictOnDelete();
            $table->foreignId('company_id')->nullable()->restrictOnDelete();
            $table->unique(["department_id","users_id","company_id","deleted_at"])->name("department_company_user_deletedat");
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
        Schema::dropIfExists('department_company_users');
    }
};
