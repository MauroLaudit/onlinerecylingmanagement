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
        /* Schema::table('inventory', function (Blueprint $table) {
        }); */

        Schema::create('inventory', function (Blueprint $table) {
            $table->id();
            $table->string('stock_id');
            $table->string('recyclable');
            $table->string('amount');
            $table->string('price');
            $table->date('monthly_stock');
            
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
        /* Schema::table('inventory', function (Blueprint $table) {
        }); */
            Schema::dropIfExists('inventory');
    }
};
