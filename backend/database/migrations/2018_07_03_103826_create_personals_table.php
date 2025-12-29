<?php

use Illuminate\Database\Schema\Blueprint;
use Illuminate\Database\Migrations\Migration;

class CreatePersonalsTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('personals', function (Blueprint $table) {
            $table->increments('id');
            $table->integer('post_id')->index()->unsigned();
            $table->integer('user_id')->index()->unsigned();
            $table->string('name');
            $table->string('email');
            $table->string('state');
            $table->string('city');
            $table->text('location');
            $table->string('ph_number');
            $table->string('ph_number1')->nullable();
            $table->integer('agent');
            $table->string('verify');
            $table->integer('is_active');
            $table->integer('paid')->nullable(0);
            $table->timestamps();
            $table->softDeletes();
        });
    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down()
    {
        Schema::drop('personals');
    }
}
