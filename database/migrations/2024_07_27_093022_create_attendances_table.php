<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

return new class extends Migration
{
    /**
     * Run the migrations.
     */
    public function up(): void
    {
        Schema::create('attendances', function (Blueprint $table) {
            $table->id();
            $table->integer('user_id')->default(0); 
            $table->string('staff_id', 30)->nullable();
            $table->double('present_salary', 8,2)->nullable();
            $table->double('payable_salary', 8,2)->nullable();
            $table->string('total_working_hour', 20)->nullable();


           // $table->integer('created_by')->default(0);
            //$table->integer('modified_user_id')->default(0);
            $table->integer('created_user_id')->default(0);
            $table->integer('modified_user_id')->default(0);
            $table->integer('deleted_user_id')->default(0);

			$table->dateTime('exit_time')->nullable();
			$table->tinyInteger('status')->default(0)->comment('0= absent, 1= present');
			$table->tinyInteger('late_consider')->default(0)->comment('0= no, 1= yes');
			$table->string('remarks')->nullable();
            $table->timestamps();
        });
    }
    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('attendances');
    }
};
