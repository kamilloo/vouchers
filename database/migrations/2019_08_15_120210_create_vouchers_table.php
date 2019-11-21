<?php

use App\Models\Descriptors\MorphType;
use Illuminate\Support\Facades\Schema;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Database\Migrations\Migration;

class CreateVouchersTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('vouchers', function (Blueprint $table) {
            $table->bigIncrements('id');
            $table->unsignedBigInteger('user_id');
            $table->unsignedBigInteger('merchant_id');
            $table->string('type');
            $table->string('title');
            $table->string('price')->nullable()->default(null);
            $table->nullableMorphs(MorphType::PRODUCT);
            $table->string('file')->nullable()->default(null);
            $table->timestamps();

            $table->foreign('user_id')->references('id')->on('users');
            $table->foreign('merchant_id')->references('id')->on('merchants');
        });
    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down()
    {
        Schema::dropIfExists('vouchers');
    }
}
