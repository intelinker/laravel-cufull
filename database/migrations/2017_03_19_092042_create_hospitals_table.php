<?php

use Illuminate\Support\Facades\Schema;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Database\Migrations\Migration;

class CreateHospitalsTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('hospitals', function (Blueprint $table) {
            $table->increments('id');
            $table->string('title');
            $table->string('description');
            $table->string('avatar');
            $table->string('domain');
            $table->string('token');
            $table->string('level');
            $table->boolean('top');
            $table->integer('category_id')->references('id')->on('categories')->onDelete('cascade');
            $table->integer('area_id')->references('id')->on('area')->onDelete('cascade');
            $table->integer('contact_id')->references('id')->on('contact')->onDelete('cascade');
            $table->tinyInteger('published')->references('id')->on('article_statuses');
            $table->date('publish_date');
            $table->date('close_date');
            $table->timestamp('created_at')->default(\DB::raw('CURRENT_TIMESTAMP'));
            $table->timestamp('updated_at')->default(\DB::raw('CURRENT_TIMESTAMP ON UPDATE CURRENT_TIMESTAMP'));
            $table->integer('updated_by')->references('id')->on('users')->onDelete('cascade');
            $table->integer('created_by')->references('id')->on('users')->onDelete('cascade');
        });
    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down()
    {
        Schema::dropIfExists('hospitals');
    }
}
