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
        Schema::create('companies', function (Blueprint $table) {
            $table->id();
            $table->string('name', 60)->nullable();
            $table->string('mobile_no', 11)->nullable()->unique();
            $table->string('email')->unique();
            $table->text('address')->nullable();

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
        Schema::dropIfExists('companies');
    }
};
