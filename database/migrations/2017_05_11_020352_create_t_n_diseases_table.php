<?php

use Illuminate\Support\Facades\Schema;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Database\Migrations\Migration;

class CreateTNDiseasesTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('t_n_diseases', function (Blueprint $table) {
            $table->increments('id');
            $table->string('name')->nullable();
            $table->text('description')->nullable();
            $table->text('message')->nullable();
            $table->text('disease')->nullable();
            $table->text('diseasetext')->nullable();
            $table->string('symptom')->nullable();
            $table->text('symptomtext')->nullable();
            $table->string('food')->nullable();
            $table->text('foodtext')->nullable();
            $table->string('checks')->nullable();
            $table->text('checktext')->nullable();
            $table->text('drug')->nullable();
            $table->text('drugtext')->nullable();
            $table->text('causetext')->nullable();
            $table->text('caretext')->nullable();
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
        Schema::dropIfExists('t_n_diseases');
    }
}
