<?php

use Illuminate\Support\Facades\Schema;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Database\Migrations\Migration;

class AddFieldsEmployeesetsTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::table('employeesets', function (Blueprint $table) {
            $table->enum('salary_type', ['hourly', 'salary'])->after('year');
            $table->enum('salary_except', ['except', 'no except'])->after('salary_type')->nullable();
            $table->decimal('contract_hours', 8, 2)->after('salary_except')->nullable();
            $table->enum('on_book', ['on book', 'semi', 'none'])->after('salary_except');
        });
    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down()
    {
        Schema::table('employeesets', function (Blueprint $table) {
            //
        });
    }
}
