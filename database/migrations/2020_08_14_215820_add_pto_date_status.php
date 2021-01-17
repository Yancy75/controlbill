<?php

use Illuminate\Support\Facades\Schema;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Database\Migrations\Migration;

class AddPtoDateStatus extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::table('employeesets', function (Blueprint $table) {
            $table->date('pto_date_activation')->after('pto_accumulate_yearly')->nullable();
            $table->enum('pto_status', ['active', 'inactive'])->after('pto_date_activation')->default('inactive');
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
