<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class CreateServiceDetailsTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('service_details', function (Blueprint $table) {
            $table->id();
            $table->string('user_id');
            $table->string('customer_id');
            $table->string('repair_category');
            $table->string('device');
            $table->string('device_issue');
            $table->string('imei_or_serial');
            $table->string('repair_status');
            $table->dateTime('repair_time');
            $table->string('assigned_to');
            $table->dateTime('pickup_time');
            $table->integer('quantity');
            $table->decimal('price', 8, 2);
            $table->decimal('tax', 8, 2);
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
        Schema::dropIfExists('service_details');
    }
}
