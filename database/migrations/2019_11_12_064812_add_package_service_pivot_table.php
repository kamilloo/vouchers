<?php

use Illuminate\Support\Facades\Schema;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Database\Migrations\Migration;

class AddPackageServicePivotTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('package_service', function (Blueprint $table) {
            $table->unsignedBigInteger('package_id');
            $table->unsignedBigInteger('service_id');

            $table->foreign('service_id')
                ->references('id')
                ->on('services')
                ->onDelete('cascade')
                ->onUpdate('cascade');

            $table->foreign('package_id')
                ->references('id')
                ->on('service_packages')
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
        Schema::dropIfExists('package_service');
    }
}
