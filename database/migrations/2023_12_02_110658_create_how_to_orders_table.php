<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class CreateHowToOrdersTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('how_to_orders', function (Blueprint $table) {
            $table->id();
            $table->string('name', 55);
            $table->string('title', 45);
            $table->string('description', 155);
            $table->string('title_two', 45)->nullable();
            $table->string('description_two', 155)->nullable();
            $table->string('title_three', 45)->nullable();
            $table->string('description_three', 155)->nullable();
            $table->string('video_link');
            $table->string('thumbnail');
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
        Schema::dropIfExists('how_to_orders');
    }
}
