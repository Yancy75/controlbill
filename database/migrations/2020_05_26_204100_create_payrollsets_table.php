<?php

use Illuminate\Support\Facades\Schema;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Database\Migrations\Migration;

class CreatePayrollsetsTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('payrollsets', function (Blueprint $table) {
            $table->bigIncrements('id');
            $table->unsignedBigInteger('supermarket_id');
            $table->date('period_starting');
            $table->string('type_salary');
            $table->decimal('regular_hours_amount', 8, 2)->unsigned()->nullable();
            $table->decimal('pay_hour', 8, 2);
            $table->decimal('working_hours', 8, 2);
            $table->decimal('pto', 5, 2)->nullable();
            $table->decimal('ajust_bonus', 8, 2)->nullable();
            $table->decimal('check_gross', 8, 2)->nullable();
            $table->decimal('check_net', 8, 2)->nullable();
            $table->decimal('taxes', 8, 2)->nullable();
            $table->decimal('direct_deposit', 8, 2)->nullable();
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
        Schema::dropIfExists('payrollsets');
    }
}
