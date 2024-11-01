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
        Schema::create('off_days', function (Blueprint $table) {
            $table->id();
            $table->string('title', 60)->nullable();
            $table->string('month_year')->nullable();
            $table->integer('total_days');
            $table->text('off_days');           
            $table->integer('remain_working_days');
            

            $table->integer('created_user_id')->default(0);
            $table->integer('modified_user_id')->default(0);
            $table->integer('deleted_user_id')->default(0);

            $table->integer('status')->default(1)->comment('0= Inactive, 1= Active');
            $table->timestamps();
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('off_days');
    }
};
