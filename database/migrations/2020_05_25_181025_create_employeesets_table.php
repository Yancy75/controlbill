<?php

use Illuminate\Support\Facades\Schema;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Database\Migrations\Migration;

class CreateEmployeesetsTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('employeesets', function (Blueprint $table) {
            $table->bigIncrements('id');
            $table->unsignedBigInteger('employee_id');
            $table->decimal('pay_hour', 8, 2);
            $table->integer('total_pto');
            $table->decimal('pto_accumulate_yearly', 8, 2);
            $table->date('pto_date_activation');
            $table->enum('pto_status', ['active', 'inactive']);
            $table->integer('year')->unsigned();
            $table->enum('salary_type', ['hourly', 'salary']);
            $table->integer('hours_calculated_salary')->unsigned()->nullable();
            $table->enum('salary_except', ['except', 'no except']);
            $table->enum('on_book', ['on book', 'semi', 'none']);
            $table->decimal('contract_hours', 8, 2);
            $table->timestamps();
            $table->engine = 'InnoDB';
            $table->foreign('employee_id')->references('id')->on('employees')->onDelete('cascade');
        });
    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down()
    {
        Schema::dropIfExists('employeesets');
    }
}
