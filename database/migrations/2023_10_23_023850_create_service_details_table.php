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
            $table->string('user_id')->nullable();
            $table->string('customer_id');
            $table->string('repair_category')->nullable();
            $table->string('device');
            $table->string('device_issue');
            $table->string('imei_or_serial');
            $table->string('repair_status')->default('pending');
            $table->dateTime('repair_time')->nullable();
            $table->string('assigned_to')->nullable();
            $table->dateTime('pickup_time')->nullable();
            $table->integer('quantity')->default(1);
            $table->decimal('price', 8, 2)->nullable();
            $table->decimal('tax', 8, 2)->nullable();
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
