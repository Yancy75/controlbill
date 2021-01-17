<?php

use Illuminate\Support\Facades\Schema;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Database\Migrations\Migration;

class CreateExpensesTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('expenses', function (Blueprint $table) {
            $table->bigIncrements('id');
            $table->unsignedBigInteger('supermarket_id');
            $table->string('concept');
            $table->date('date');
            $table->decimal('amount', 8, 2);
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
        Schema::dropIfExists('expenses');
    }
}
