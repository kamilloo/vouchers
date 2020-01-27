<?php

use Illuminate\Support\Facades\Schema;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Database\Migrations\Migration;

class CreateClientsTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('clients', function (Blueprint $table) {
            $table->bigIncrements('id');
            $table->string('email');
            $table->string('name')->nullable()->default(null);
            $table->string('phone')->nullable()->default(null);
            $table->string('city')->nullable()->default(null);
            $table->string('address')->nullable()->default(null);
            $table->string('postcode')->nullable()->default(null);
            $table->string('country')->nullable()->default(\App\Models\Enums\Country::POLAND);
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
        Schema::dropIfExists('clients');
    }
}
