<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

return new class extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('transaction_company', function (Blueprint $table) {
            $table->id();
            $table->string('transaction_id');
            $table->string('stock_id');
            $table->string('order_amount');
            $table->string('address');
            $table->string('contact_no');
            
            $table->rememberToken();
            $table->timestamps();
            $table->timestamp('deleted_at')->nullable();
        });
    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down()
    {
        Schema::table('company_orders', function (Blueprint $table) {
            //
        });
    }
};
