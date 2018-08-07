<?php

use Illuminate\Support\Facades\Schema;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Database\Migrations\Migration;

class Orders extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
      Schema::create('orders',function (Blueprint $table){
          $table->increments('id');
          $table->integer('products_id');
          $table->integer('customer_id');
          $table->integer('seller_id');
          $table->integer('price');
          $table->integer('quantity');
          $table->enum('status',['waiting','finished'])->defult('waiting');
          $table->text('comment')->nullable();
          $table->timestamp('planned_on')->nullable();
          $table->timestamps();
      });
    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down()
    {
          Schema::dropIfExists('orders');
    }
}
