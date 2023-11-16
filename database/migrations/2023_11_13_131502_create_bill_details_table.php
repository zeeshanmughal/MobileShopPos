<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class CreateBillDetailsTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('bill_details', function (Blueprint $table) {
            $table->id();
            $table->string('user_id');
            $table->string('customer_id');
            $table->string('service_detail_id');
            $table->float('price')->default(0.00);
            $table->integer('quantity')->default(1);
            $table->float('tax')->default(0.00);
            $table->float('discount')->default(0.00);
            $table->float('total_paid')->default(0.00);

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
        Schema::dropIfExists('bill_details');
    }
}
