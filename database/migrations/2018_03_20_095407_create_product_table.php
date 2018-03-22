<?php

use Illuminate\Support\Facades\Schema;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Database\Migrations\Migration;

class CreateProductTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('product', function (Blueprint $table) {
            $table->increments('id');
            $table->string('name', 255);
            $table->string('slug', 255);
            $table->integer('branding_id');
            $table->integer('category_id');
            $table->text('image');
            $table->integer('quantity');
            $table->integer('price');
            $table->string('time', 255);
            $table->string('production', 255);
            $table->string('madein', 255);
            $table->text('madeof');
            $table->string('weight', 255);
            $table->string('volume', 255);
            $table->text('description');
            $table->text('content');
            $table->tinyInteger('is_activated');
            $table->tinyInteger('is_deleted');
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
        Schema::dropIfExists('product');
    }
}
