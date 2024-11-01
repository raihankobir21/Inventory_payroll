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
        Schema::create('employee_advance_payments', function (Blueprint $table) {
            $table->id();
            $table->integer('project_id')->default(0); 
            $table->string('project_custom_id', 30)->nullable(); 
			
            $table->integer('user_id')->default(0); 
            $table->string('staff_id', 15)->nullable();
            $table->string('purpose', 60)->nullable();
			$table->double('amount', 8,2)->nullable();
            //$table->integer('created_by')->default(0);
            //$table->integer('modified_by')->default(0);
            $table->integer('created_user_id')->default(0);
            $table->integer('modified_user_id')->default(0);
            $table->integer('deleted_user_id')->default(0);

			$table->tinyInteger('type')->default(0)->comment('1= Project Purpose, 2= Salary Purpose'); 
			$table->tinyInteger('status')->default(1)->comment('0= Inactive, 1= Active'); 
            $table->timestamps();
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('employee_advance_payments');
    }
};
