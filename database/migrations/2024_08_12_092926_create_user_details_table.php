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
        Schema::create('user_details', function (Blueprint $table) {
            $table->id();
            $table->integer('user_id')->default(0); 
            $table->string('staff_id', 15)->nullable()->unique();
            $table->enum('gender', ['male', 'female', 'other'])->nullable();
            $table->tinyInteger('blood_group')->default(0); 
            $table->string('designation', 60)->nullable();
			$table->string('email', 60)->nullable();
			$table->text('nid', 30)->nullable();
            $table->text('photo')->nullable(); 
            $table->date('joining_date')->nullable();
			$table->text('present_address')->nullable();
			$table->text('permanent_address')->nullable();
			$table->text('emergency_contact')->nullable();
            $table->integer('salary_category_id')->default(0);
            $table->string('joining_salary', 15)->nullable();
            $table->integer('created_user_id')->default(0);
            $table->integer('modified_user_id')->default(0);
            $table->integer('deleted_user_id')->default(0);

			 
			$table->tinyInteger('status')->default(0)->comment('0= active, 1= inactive');
            $table->timestamps();
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('user_details');
    }
};
