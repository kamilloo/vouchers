<?php

use Illuminate\Support\Facades\Schema;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Database\Migrations\Migration;

class CreateTransactionConfirmationsTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('transaction_confirmations', function (Blueprint $table) {
            $table->bigIncrements('id');
            $table->unsignedBigInteger('transaction_id');
            $table->json('request_parameters')->nullable()->default(null);
            $table->json('receive_parameters')->nullable()->default(null);
            $table->boolean('success')->nullable()->default(null);
            $table->string('session_id')->nullable()->default(null);
            $table->json('error_description')->nullable()->default(null);
            $table->string('error_code')->nullable()->default(null);
            $table->string('order_id')->nullable()->default(null);
            $table->timestamps();

            $table->foreign('transaction_id')
                ->references('id')
                ->on('transactions')
                ->onDelete('cascade')
                ->onUpdate('cascade');
        });
    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down()
    {
        Schema::dropIfExists('transaction_confirmations');
    }
}
