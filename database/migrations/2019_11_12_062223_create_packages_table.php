<?php

use App\Models\Enums\Currency;
use App\Models\Enums\PackageStatus;
use Illuminate\Support\Facades\Schema;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Database\Migrations\Migration;

class CreatePackagesTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('service_packages', function (Blueprint $table) {
            $table->bigIncrements('id');
            $table->string('title');
            $table->string('description')->default(null)->nullable();
            $table->decimal('price');
            $table->string('currency',3)->default(Currency::PLN);
            $table->boolean('active')->default(PackageStatus::INACTIVE);
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
        Schema::dropIfExists('service_packages');
    }
}
