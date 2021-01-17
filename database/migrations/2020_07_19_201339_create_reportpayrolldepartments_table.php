<?php

use Illuminate\Support\Facades\Schema;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Database\Migrations\Migration;

class CreateReportpayrolldepartmentsTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('reportpayrolldepartments', function (Blueprint $table) {
            $table->bigIncrements('id');
            $table->unsignedBigInteger('supermarket_id');
            $table->unsignedBigInteger('report_department_id');
            $table->unsignedBigInteger('payroll_department_id');
            $table->enum('status', ['active', 'inactive']);
            $table->timestamps();
            $table->engine = 'InnoDB';
            $table->foreign('supermarket_id')->references('id')->on('supermarkets')->onDelete('cascade');
            $table->foreign('report_department_id')->references('id')->on('reportdeparments')->onDelete('cascade');
            $table->foreign('payroll_department_id')->references('id')->on('departments')->onDelete('cascade');
        });
    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down()
    {
        Schema::dropIfExists('reportpayrolldepartments');
    }
}
