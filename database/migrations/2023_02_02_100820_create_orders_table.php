<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class CreateOrdersTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('orders', function (Blueprint $table) {
            $table->id();
            $table->string("invoice");
            $table->string("date");
            $table->foreignId("customer_id")->constrained("users", "id")->onDelete("cascade");
            $table->boolean("is_shipping")->default(0);
            $table->integer("shipping_thana");
            $table->integer("shipping_area");
            $table->string("shipping_mobile");
            $table->text("shipping_address");
            $table->string("shipping_postcode")->nullable();
            $table->decimal("subtotal");
            $table->decimal("shipping_charge");
            $table->decimal("total");
            $table->decimal("due");
            $table->string("payment_type");
            $table->text("note")->nullable();
            $table->char('status', 20)->default('pending')->comment('pending', 'complete');
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
        Schema::dropIfExists('orders');
    }
}
