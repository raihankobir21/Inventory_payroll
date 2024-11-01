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
        Schema::create('my_companies', function (Blueprint $table) {
            $table->id();
			
            $table->string('name', 60)->nullable();
            $table->string('short_name',20)->nullable();
            $table->string('mobile')->nullable();
            $table->string('email')->nullable();
            $table->text('address')->nullable();
			
            $table->text('logo')->nullable();
            $table->text('signature_holder_name')->nullable();
            $table->text('signature_holder_designation')->nullable();
            $table->text('signature')->nullable();

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
        Schema::dropIfExists('my_companies');
    }
};
