<?php

use Illuminate\Support\Facades\Schema;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Database\Migrations\Migration;

class CreateTNMedicinesTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('t_n_medicines', function (Blueprint $table) {
            $table->increments('id');
            $table->string('name')->nullable();
            $table->text('description')->nullable();
            $table->text('message')->nullable();
            $table->integer('price')->nullable();
            $table->string('keywords')->nullable();
            $table->string('tag')->nullable();
            $table->string('type')->nullable();
            $table->string('url')->nullable();
            $table->string('img')->nullable();
            $table->boolean('status')->nullable();
            $table->integer('rcount')->nullable();
            $table->integer('fcount')->nullable();
            $table->integer('count')->nullable();
            $table->timestamp('created_at')->default(\DB::raw('CURRENT_TIMESTAMP'));
            $table->timestamp('updated_at')->default(\DB::raw('CURRENT_TIMESTAMP ON UPDATE CURRENT_TIMESTAMP'));
        });
    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down()
    {
        Schema::dropIfExists('t_n_medicines');
    }
}
