<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class CreateBuyPhonesTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('buy_phones', function (Blueprint $table) {
            $table->id();
            $table->string('user_id');
            $table->string('customer_id');
            $table->string('label_id');
            $table->string('device_model');
            $table->string('device_brand');
            $table->string('imei');
            $table->string('status')->nullable();
            $table->string('buying_price');
            $table->string('sell_price');
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
        Schema::dropIfExists('buy_phones');
    }
}
