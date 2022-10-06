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
        Schema::create('company_info', function (Blueprint $table) {
            $table->id();
            $table->timestamps();
            $table->string("name",100)->unique();
            $table->string("company_id",25)->unique();
            $table->tinyInteger("company_type")->default(0)->comment("0=emdad,1=buyer,2=supplier");
            $table->string("company_vat_id",25)->unique();
            $table->string("contact_name",100)->nullable(false);
            $table->string("contact_phone",15)->nullable(false);
            $table->string("contact_email",100)->nullable(false);
        });
    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down()
    {
        Schema::dropIfExists('company_infos');
    }
};
