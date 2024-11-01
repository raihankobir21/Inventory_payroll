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
        Schema::create('employee_expenses', function (Blueprint $table) {
            $table->id(); 
			$table->integer('project_id')->default(0); 
            $table->string('project_custom_id', 30)->nullable(); 
			
            $table->foreignId('user_id')->constrained('users')->onDelete('cascade');
            $table->string('staff_id', 15)->nullable();
            $table->string('purpose', 60)->nullable();
            $table->string('remarks', 300)->nullable();
			
            $table->double('previous_in_hand', 8, 2)->nullable();
            $table->double('expense_amount', 8, 2)->nullable();
            $table->double('remain_balance', 8, 2)->nullable();
			
            $table->tinyInteger('status')->default(0)->comment('0=pending, 1=approved');
            $table->integer('created_by')->default(0);
            $table->integer('modified_by')->default(0);
            $table->timestamps();
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('employee_expenses');
    }
};
