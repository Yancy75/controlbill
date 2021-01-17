<?php

use Illuminate\Support\Facades\Schema;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Database\Migrations\Migration;

class AddDatesHired extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::table('employees', function (Blueprint $table) {
            $table->date('inicial_date')->after('level')->nullable();
            $table->date('end_date')->after('inicial_date')->nullable();
            $table->string('reason')->after('end_date')->nullable();
            $table->enum('rehired', ['si', 'no'])->after('reason')->default('no');
        });
    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down()
    {
        Schema::table('employees', function (Blueprint $table) {
            //
        });
    }
}
