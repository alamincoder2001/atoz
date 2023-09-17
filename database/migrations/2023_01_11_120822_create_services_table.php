<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class CreateServicesTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('services', function (Blueprint $table) {
            $table->id();
            $table->string("service_code");
            $table->string("name");
            $table->string("slug");
            $table->integer("category_id")->nullable();
            $table->decimal("vat");
            $table->boolean("is_arrival")->default(0);
            $table->boolean("is_feature")->default(0);
            $table->boolean("is_popular")->default(0);
            $table->boolean("is_topsold")->default(0);
            $table->longText("description")->nullable();
            $table->string("image")->nullable();
            $table->char("status", 5)->default("a");
            $table->timestamps();
            $table->softDeletes();
        });
    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down()
    {
        Schema::dropIfExists('services');
    }
}
