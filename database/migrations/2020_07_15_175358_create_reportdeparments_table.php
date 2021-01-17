<?php

use Illuminate\Support\Facades\Schema;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Database\Migrations\Migration;

class CreateReportdeparmentsTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('reportdeparments', function (Blueprint $table) {
            $table->bigIncrements('id');
            $table->unsignedBigInteger('supermarket_id');
            $table->string('name');
            $table->enum('status', ['active', 'inactive']);
            $table->timestamps();
            $table->engine = 'InnoDB';
            $table->foreign('supermarket_id')->references('id')->on('supermarkets')->onDelete('cascade');
        });
    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down()
    {
        Schema::dropIfExists('reportdeparments');
    }
}
