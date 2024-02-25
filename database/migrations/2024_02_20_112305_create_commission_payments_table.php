<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class CreateCommissionPaymentsTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('commission_payments', function (Blueprint $table) {
            $table->id();
            $table->string('transaction_id',55);
            $table->string('payment_type', 45);
            $table->string('amount', 8,2);
            $table->date('payment_date');
            $table->string('note', 75)->nullable();
            $table->string('last_payment', 8,2)->default(0.00);
            $table->foreignId('manager_id')->constrained('admins');
            $table->foreignId('receive_by')->constrained('admins');
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
        Schema::dropIfExists('commission_payments');
    }
}
