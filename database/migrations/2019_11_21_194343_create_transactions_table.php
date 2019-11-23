<?php

use Illuminate\Support\Facades\Schema;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Database\Migrations\Migration;

class CreateTransactionsTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('transactions', function (Blueprint $table) {
            $table->bigIncrements('id');
            $table->unsignedBigInteger('payment_id');
            $table->decimal('order_amount');
            $table->string('url_return')->nullable()->default(null);
            $table->string('url_status')->nullable()->default(null);
            $table->string('client_email')->nullable()->default(null);
            $table->string('client_name')->nullable()->default(null);
            $table->string('client_phone')->nullable()->default(null);
            $table->string('client_address')->nullable()->default(null);
            $table->string('client_postcode')->nullable()->default(null);
            $table->string('client_city')->nullable()->default(null);
            $table->string('client_country')->nullable()->default(null);
            $table->string('order_description')->nullable()->default(null);
            $table->string('product_title')->nullable()->default(null);
            $table->string('product_description')->nullable()->default(null);
            $table->string('session_id')->nullable()->default(null);
            $table->string('token')->nullable()->default(null);
            $table->boolean('is_register')->default(false);
            $table->json('request_parameters')->nullable()->default(null);
            $table->integer('error_code')->nullable()->default(null);
            $table->json('error_description')->nullable()->default(null);
            $table->timestamps();

            $table->foreign('payment_id')
                ->references('id')
                ->on('payments')
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
        Schema::dropIfExists('transactions');
    }
}
