<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class CreateEmpApplicationTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('employee_application', function (Blueprint $table) {
            $table->id();
            $table->string('leave_type');
            $table->string('start_date');
            $table->string('end_date');
            $table->string('leave_duration');
            $table->string('apply_date');
            $table->text('reason');            
            $table->string('leave_status'); 
        });
    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down()
    {
        Schema::dropIfExists('emp_application');
    }
}
