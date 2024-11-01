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
        Schema::create('salary_categories', function (Blueprint $table) {
            $table->id();
			$table->string('title', 60)->nullable()->unique();
			 
			$table->string('basic_working_hour_start', 10)->nullable();
			$table->string('basic_working_hour_end', 10)->nullable();
			$table->string('basic_working_hour', 10)->nullable();
			
			$table->text('calculation_process')->nullable();
			$table->tinyInteger('type')->default(0)->comment('1= Day Basis With Overtime, 2= Day Basis without Overtime, 3= Monthly Basis with Overtime, 4= Monthly  Basis without Overtime');

            $table->integer('created_user_id')->default(0);
            $table->integer('modified_user_id')->default(0);
            $table->integer('deleted_user_id')->default(0);

			
			$table->tinyInteger('status')->default(1)->comment('0= Inactive, 1= Active');
            $table->timestamps();
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('salary_categories');
    }
};
