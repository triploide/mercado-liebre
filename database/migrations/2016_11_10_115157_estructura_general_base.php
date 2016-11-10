<?php

use Illuminate\Support\Facades\Schema;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Database\Migrations\Migration;

class EstructuraGeneralBase extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('products', function (Blueprint $table) {
            $table->increments('id');
            $table->float('price');
            $table->text('description');
            $table->string('name', 255);
            $table->string('slug', 255)->unique();
            $table->boolean('visible')->default(1);
            $table->timestamps();

            $table->integer('category_id')->unsigned();
        });

        Schema::create('categories', function (Blueprint $table) {
            $table->increments('id');
            $table->string('value', 255);
            $table->timestamps();
        });

        Schema::create('images', function (Blueprint $table) {
            $table->increments('id');
            $table->string('src');
            $table->timestamps();

            $table->integer('product_id')->unsigned();
        });

        Schema::create('materials', function (Blueprint $table) {
            $table->increments('id');
            $table->string('value', 255);
            $table->timestamps();
        });

        Schema::create('material_product', function (Blueprint $table) {
            $table->integer('material_id');
            $table->integer('product_id');
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
        Schema::dropIfExists('categories');
        Schema::dropIfExists('images');
        Schema::dropIfExists('materials');
        Schema::dropIfExists('material_product');
    }
}
