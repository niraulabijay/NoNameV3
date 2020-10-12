<?php

use Illuminate\Support\Facades\Schema;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Database\Migrations\Migration;

class CreateContentsTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('contents', function (Blueprint $table) {
            $table->increments('id');
            $table->longText('name');
            $table->string('slug');
            $table->integer('type')->unsigned();
            $table->integer('parent_id')->unsigned();
            $table->string('code')->nullable();
            $table->string('icon')->nullable();
            $table->boolean('is_learn')->nullable();
            $table->boolean('is_practice')->nullable();
            $table->boolean('is_test')->nullable();
            $table->integer('time')->nullable();
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
        Schema::dropIfExists('contents');
    }
}
