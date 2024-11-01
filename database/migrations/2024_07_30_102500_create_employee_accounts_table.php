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
        Schema::create('employee_accounts', function (Blueprint $table) {
            $table->id();
            $table->integer('user_id')->default(0); 
            $table->string('staff_id')->nullable();

            $table->integer('bank_id')->default(0); 
            $table->string('branch_name')->nullable();
            $table->string('account_name')->nullable();
            $table->string('account_number', 30)->unique()->nullable(); 
            $table->integer('created_user_id')->default(0);
            $table->integer('modified_user_id')->default(0);
            $table->integer('deleted_user_id')->default(0);

			$table->integer('status')->default(1)->comment('0= Inactive, 1= Active'); 
            
           // $table->integer('created_by')->default(0);
           // $table->integer('modified_by')->default(0);
            $table->timestamps();
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('employee_accounts');
    }
};
