<?php

use Illuminate\Support\Facades\Schema;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Database\Migrations\Migration;

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
            $table->bigIncrements('id');
            $table->unsignedBigInteger('merchant_id');
            $table->unsignedBigInteger('voucher_id');
            $table->unsignedBigInteger('client_id')->nullable();
            $table->string('delivery')->default(\App\Models\Enums\DeliveryType::ONLINE);
            $table->float('price');
            $table->string('first_name');
            $table->string('last_name');
            $table->string('phone');
            $table->string('email');
            $table->string('status')->default(\App\Models\Enums\StatusType::NEW);
            $table->boolean('paid')->default(\App\Models\Enums\PaymentStatus::WAITING_FOR_PAY);
            $table->dateTime('used_at')->nullable()->default(null);
            $table->dateTime('expired_at')->nullable()->default(null);
            $table->string('qr_code')->default(null)->nullable();
            $table->timestamps();

            $table->foreign('merchant_id')->references('id')->on('merchants');
            $table->foreign('client_id')->references('id')->on('clients')->onDelete('set null');
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
