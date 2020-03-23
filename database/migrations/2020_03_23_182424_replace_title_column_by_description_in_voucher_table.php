<?php

use Illuminate\Support\Facades\Schema;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Database\Migrations\Migration;

class ReplaceTitleColumnByDescriptionInVoucherTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::table('vouchers', function (Blueprint $table) {
            $table->dropColumn('title');
            $table->string('description')->nullable()->default(null)->after('type');
        });
    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down()
    {
        Schema::table('vouchers', function (Blueprint $table) {
            $table->dropColumn('description');
            $table->string('title');
        });
    }
}
