<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class AddNewColumnToBillDetailsTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::table('bill_details', function (Blueprint $table) {
            //
            $table->string('bill_for')->nullable();
            $table->string('phone_id')->nullable();
            $table->string('total_price')->nullable();


        });
    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down()
    {
        Schema::table('bill_details', function (Blueprint $table) {
            //
            $table->dropColumn('bill_for');
            $table->dropColumn('phone_id');
            $table->dropColumn('total_price');


        });
    }
}
