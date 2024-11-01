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
        Schema::create('company_remain_balances', function (Blueprint $table) {
            $table->id();
            $table->string('event_table_name',100)->nullable();
            $table->string('event_table_row_id',100)->nullable();
			$table->enum('event_type', ['Income', 'Expense'])->nullable();
            
			$table->double('event_amount', 8,2)->nullable();
			$table->double('remain_balance', 8,2)->nullable();
            
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
        Schema::dropIfExists('company_remain_balances');
    }
};
