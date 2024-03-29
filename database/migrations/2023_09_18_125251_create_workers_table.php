<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class CreateWorkersTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('workers', function (Blueprint $table) {
            $table->id();
            $table->string("worker_code", 100);
            $table->string("name");
            $table->string("father_name");
            $table->string("mother_name");
            $table->string("mobile", 15)->unique();
            $table->string("password");
            $table->string('nid_front_img')->nullable();
            $table->string('nid_back_img')->nullable();
            $table->decimal("commission");
            $table->integer('category_id')->nullable();
            $table->integer('manager_id')->nullable();
            $table->integer('district_id')->nullable();
            $table->integer('thana_id')->nullable();
            $table->integer('area_id')->nullable();
            $table->string('present_address')->nullable();
            $table->string('permanent_address')->nullable();
            $table->string('description')->nullable();
            $table->string('reference')->nullable();
            $table->char("status", 5)->default("p");
            $table->string("image")->nullable();
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
        Schema::dropIfExists('workers');
    }
}
