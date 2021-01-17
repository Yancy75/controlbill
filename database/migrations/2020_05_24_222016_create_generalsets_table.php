<?php

use Illuminate\Support\Facades\Schema;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Database\Migrations\Migration;

class CreateGeneralsetsTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('generalsets', function (Blueprint $table) {
            $table->bigIncrements('id');
            $table->unsignedBigInteger('supermarket_id');
            $table->decimal('regular_hours', 8, 2);
            $table->decimal('pto_hours', 8, 2);
            $table->decimal('porcentage', 5, 2);
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
        Schema::dropIfExists('generalsets');
    }
}
