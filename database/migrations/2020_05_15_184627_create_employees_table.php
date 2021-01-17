<?php

use Illuminate\Support\Facades\Schema;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Database\Migrations\Migration;

class CreateEmployeesTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('employees', function (Blueprint $table) {
            $table->bigIncrements('id');
            $table->unsignedBigInteger('supermarket_id');
            $table->string('name');
            $table->string('last_name');
            $table->string('address');
            $table->string('city');
            $table->integer('zip_code');
            $table->string('state');
            $table->string('mobil');
            $table->enum('gender', ['female', 'male']);
            $table->enum('level', ['normal', 'bookkeeper', 'admin']);
            $table->date('inicial_date');
            $table->date('end_date');
            $table->string('authorized_by');
            $table->string('reason');
            $table->string('detail');
            $table->enum('rehired', ['si', 'no']);
            $table->string('authorized_rehide_by')->nullable();
            $table->date('rehide_date')->nullable();
            $table->enum('status', ['active', 'inactive']);
            $table->timestamps();
            $table->engine = 'InnoDB';
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
        Schema::dropIfExists('employees');
    }
}
