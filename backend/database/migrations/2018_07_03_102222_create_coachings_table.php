<?php

use Illuminate\Database\Schema\Blueprint;
use Illuminate\Database\Migrations\Migration;

class CreateCoachingsTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('coachings', function (Blueprint $table) {
            $table->increments('id');
            $table->integer('user_id')->index()->unsigned();
            $table->integer('category_id')->unsigned()->index();
            $table->integer('subcategory_id')->unsigned()->index();
            $table->integer('status')->default(0);
            $table->string('business_name');
            $table->text('business_address');
            $table->text('ad_description');
            $table->text('map');
            $table->text('lat');
            $table->string('video');
            $table->string('payment')->nullable();
            $table->string('course')->nullable();
            $table->string('facility')->nullable();
            $table->string('service')->nullable();
            $table->string('floor')->nullable();
            $table->string('area')->nullable();
            $table->string('furnished')->nullable();
            $table->string('bathroom')->nullable();
            $table->string('religion_view')->nullable();
            $table->string('only_for')->nullable();
            $table->string('rent')->nullable();
            $table->string('web_link');
            $table->string('slug')->nullable();
            $table->string('photo');
            $table->string('r_type')->nullable();
            $table->string('h_star')->nullable();
            $table->string('ifsc')->nullable();
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
        Schema::drop('coachings');
    }
}
