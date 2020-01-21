<?php

use Illuminate\Support\Facades\Schema;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Database\Migrations\Migration;

class CreateMerchantsTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('merchants', function (Blueprint $table) {
            $table->bigIncrements('id');
            $table->unsignedBigInteger('user_id');
            $table->unsignedBigInteger('template_id')->nullable();
            $table->unsignedBigInteger('merchant_id')->nullable()->default(null);
            $table->unsignedBigInteger('pos_id')->nullable()->default(null);
            $table->string('crc')->nullable()->default(null);
            $table->string('homepage')->nullable()->default(null);
            $table->boolean('sandbox')->default(\App\Models\Enums\GatewaySandbox::ENABLED);
            $table->timestamps();

            $table->foreign('user_id')->references('id')->on('users');
            $table->foreign('template_id')->references('id')->on('templates');
        });
    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down()
    {
        Schema::dropIfExists('merchants');
    }
}
