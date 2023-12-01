<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class CreateUserverifiesTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('userverifies', function (Blueprint $table) {
           
                $table->id();
                $table->string('user_id');
                $table->string('token');
                $table->timestamps();
            });
            
            Schema::table('users', function (Blueprint $table) {
                $table->boolean('is_email_verified')->default(0);
            });
    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down()
    {
        Schema::dropIfExists('userverifies');
    }
}
