<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class CreateOrderDetailsTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('order_details', function (Blueprint $table) {
            $table->id();
            $table->foreignId("order_id")->constrained("orders", "id")->onDelete("cascade");
            $table->integer("worker_id")->nullable();
            $table->integer("service_id");
            $table->integer("quantity");
            $table->decimal("bill_amount");
            $table->decimal("paid_amount");
            $table->decimal("due");
            $table->char('status', 20)->default('pending')->comment('pending','proccess','complete');
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
        Schema::dropIfExists('order_details');
    }
}
