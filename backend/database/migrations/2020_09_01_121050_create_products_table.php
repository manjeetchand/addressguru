<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class CreateProductsTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('products', function (Blueprint $table) {
            $table->id();
            $table->integer('user_id')->index()->unsigned();
            $table->integer('category_id')->unsigned()->index();
            $table->integer('subcategory_id')->unsigned()->index();
            $table->integer('post_status')->default(0);
            $table->integer('status')->default(0);
            $table->integer('package')->default(0);
            $table->string('condition');
            $table->string('title');
            $table->text('description');
            $table->string('price');
            $table->integer('amount')->nullable();
            $table->string('name')->nullable();
            $table->string('email')->nullable();
            $table->string('phone')->nullable();
            $table->string('state')->nullable();
            $table->string('city')->nullable();
            $table->string('locality')->nullable();
            $table->string('slug')->nullable();
            $table->string('only_for')->nullable();
            $table->string('model')->nullable();
            $table->string('pro_by')->nullable();
            $table->string('dob')->nullable();
            $table->string('available')->nullable();
            $table->string('job_type')->nullable();
            $table->string('company_name')->nullable();
            $table->string('company_website')->nullable();
            $table->string('ea_number')->nullable();
            $table->string('edu_level')->nullable();
            $table->string('cc')->nullable();
            $table->string('fuel_type')->nullable();
            $table->string('year')->nullable();
            $table->string('km')->nullable();
            $table->string('trans')->nullable();
            $table->string('color')->nullable();
            $table->string('share')->nullable();
            $table->string('dwelling')->nullable();
            $table->string('size')->nullable();
            $table->string('bedroom')->nullable();
            $table->string('bathroom')->nullable();
            $table->string('smoking')->nullable();
            $table->string('pet')->nullable();
            $table->string('gender')->nullable();
            $table->string('cea')->nullable();
            $table->string('parking')->nullable();
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
        Schema::dropIfExists('products');
    }
}
