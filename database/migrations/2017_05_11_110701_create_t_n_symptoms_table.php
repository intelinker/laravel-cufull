<?php

use Illuminate\Support\Facades\Schema;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Database\Migrations\Migration;

class CreateTNSymptomsTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('t_n_symptoms', function (Blueprint $table) {
            $table->increments('id');
            $table->string('name')->nullable();
            $table->text('description')->nullable();
            $table->text('message')->nullable();
            $table->text('disease')->nullable();
            $table->string('checks')->nullable();
            $table->text('drug')->nullable();
            $table->text('causetext')->nullable();
            $table->text('detailtext')->nullable();
            $table->string('department')->nullable();
            $table->string('keywords')->nullable();
            $table->string('place')->nullable();
            $table->string('img')->nullable();
            $table->string('url')->nullable();
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
        Schema::dropIfExists('t_n_symptoms');
    }
}
