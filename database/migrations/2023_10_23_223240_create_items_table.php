<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class CreateItemsTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('items', function (Blueprint $table) {
            $table->id();
            $table->string('item_name');
            $table->string('item_category');
            $table->string('manufacturer');
            $table->string('device_model');
            $table->string('warranty');
            $table->string('imei');
            $table->string('condition');
            $table->string('physical_location');
            $table->string('sub_category');

            $table->string('sku');
            $table->string('upc_code');
            $table->string('short_description');
            $table->string('image');
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
        Schema::dropIfExists('items');
    }
}
