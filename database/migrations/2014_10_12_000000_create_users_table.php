<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class CreateUsersTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('users', function (Blueprint $table) {
            $table->id();
            $table->string('customer_code', 100);
            $table->string('name');
            $table->string('username')->unique();
            $table->string('email')->unique();
            $table->string('customer_type', 50)->default("Retail");
            $table->timestamp('email_verified_at')->nullable();
            $table->string('password');
            $table->string('mobile')->nullable();
            $table->integer('district_id')->nullable();
            $table->integer('thana_id')->nullable();
            $table->string('postcode')->nullable();
            $table->string('address')->nullable();
            $table->string("image")->nullable();
            $table->string("nid_card")->nullable();
            $table->string("trade_license")->nullable();
            $table->string("visiting_card")->nullable();
            $table->char("status", 5)->default("p");
            $table->rememberToken();
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
        Schema::dropIfExists('users');
    }
}
