<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class CreateObligationPaymentsTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('obligation_payments', function (Blueprint $table) {
            $table->id();
            $table->unsignedBigInteger('obligation_id');
            $table->unsignedBigInteger('payment_id');
            $table->timestamps();
           // $table->foreign(columns:'obliation_id')->references(columns:'id')->on(table:'obligations')->onDelete('cascade');
            $table->foreign('obligation_id')->references('id')->on('obligations')->onDelete('cascade');
            $table->foreign('payment_id')->references('id')->on('payments')->onDelete('cascade');
          //  $table->foreign(columns:'payment_id')->references(columns:'id')->on(table:'payments')->onDelete('cascade');
        });
    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down()
    {
        Schema::dropIfExists('obligation_payments');
    }
}
