<?php

use Illuminate\Support\Facades\Schema;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Database\Migrations\Migration;

class CreateTNFactoriesTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('t_n_factories', function (Blueprint $table) {
            $table->increments('id');
            $table->string('name')->nullable();
            $table->string('address')->nullable();
            $table->text('message')->nullable();
            $table->string('classcode')->nullable();
            $table->string('tel')->nullable();
            $table->integer('area')->nullable();
            $table->string('charge')->nullable();
            $table->string('legal')->nullable();
            $table->string('type')->nullable();
            $table->string('number')->nullable();
            $table->string('img')->nullable();
            $table->string('paddress')->nullable();
            $table->string('raddress')->nullable();
            $table->string('url')->nullable();
            $table->double('x')->nullable();
            $table->double('y')->nullable();
            $table->string('zipcode')->nullable();
            $table->double('createdate')->nullable();
            $table->integer('rcount')->nullable();
            $table->integer('fcount')->nullable();
            $table->integer('count')->nullable();
            $table->boolean('status')->nullable();
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
        Schema::dropIfExists('t_n_factories');
    }
}
