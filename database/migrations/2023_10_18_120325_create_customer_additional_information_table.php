<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class CreateCustomerAdditionalInformationTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('customer_additional_information', function (Blueprint $table) {
            $table->id();
            $table->string('customer_id');
            $table->string('customer_id_type')->nullable();
            $table->string('id_number')->nullable();
            $table->string('driving_license')->nullable();
            $table->string('image')->nullable();
            $table->string('location')->nullable();
            $table->string('contact_person_detail')->nullable();
            $table->string('contact_person_phone')->nullable();
            $table->string('relation')->nullable();
            $table->boolean('compliance_gdpr')->nullable();
            $table->boolean('sms_notification')->default(0);
            $table->boolean('email_notification')->default(0);
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
        Schema::dropIfExists('customer_additional_information');
    }
}
