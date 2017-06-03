<?php

use Illuminate\Support\Facades\Schema;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Database\Migrations\Migration;

class CreateDiariesTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('diaries', function (Blueprint $table) {
            $table->increments('id');
            $table->string('title');
            $table->string('description')->nullable();
            $table->integer('images')->default(0);
            $table->string('avatar');
            $table->text('content');
            $table->integer('book_id')->references('id')->on('books')->onDelete('cascade')->default(0);
            $table->integer('hospital_id')->references('id')->on('hospitals')->onDelete('cascade')->default(0);
            $table->integer('in_hospital')->default(0);
            $table->integer('medicine_id')->references('id')->on('medicine')->onDelete('cascade')->default(0);
            $table->integer('disease_id')->references('id')->on('disease')->onDelete('cascade')->default(0);
            $table->integer('checked_count')->default(0);
            $table->integer('medicine_count')->default(0);
            $table->string('token')->nullable();
            $table->boolean('top')->default(0);
            $table->integer('category_id')->references('id')->on('categories')->onDelete('cascade')->default(0);
            $table->integer('type_id')->references('id')->on('article_types')->onDelete('cascade')->default(0);
            $table->tinyInteger('published')->references('id')->on('article_statuses')->default(0);
            $table->date('publish_date')->nullable();
            $table->date('close_date')->nullable();
//            $table->integer('comments_count')->default(0);
//            $table->integer('approved')->default(0);
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
        Schema::dropIfExists('diaries');
    }
}
