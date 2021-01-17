<?php

use Illuminate\Support\Facades\Schema;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Database\Migrations\Migration;

class CreateBillsTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('bills', function (Blueprint $table) {
            $table->bigIncrements('id');
            $table->unsignedBigInteger('tienda_id');
            $table->unsignedBigInteger('item_id');
            $table->unsignedBigInteger('vendor_id');
            $table->string('description');
            $table->float('qty', 8, 2);
            $table->float('price', 8, 2);
            $table->float('product_amount', 8, 2);
            $table->enum('unit', ['unit', 'lbs']);
            $table->enum('status', ['active', 'inactive', 'open', 'close']);
            $table->dateTime('fecha_bill');
            $table->timestamps();
            $table->engine = 'InnoDB';
            $table->foreign('tienda_id')->references('id')->on('tiendas')->onDelete('cascade');
            $table->foreign('item_id')->references('id')->on('items')->onDelete('cascade');
            $table->foreign('vendor_id')->references('id')->on('vendors')->onDelete('cascade');
        });
    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down()
    {
        Schema::dropIfExists('bills');
    }
}
