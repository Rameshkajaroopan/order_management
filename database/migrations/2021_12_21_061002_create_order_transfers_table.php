<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class CreateOrderTransfersTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('order_transfers', function (Blueprint $table) {
            $table->bigIncrements('id')->unsigned();
            $table->bigInteger('order_id')->unsigned();
            $table->foreign('order_id')->references('id')->on('orders')->onDelete('cascade');
            $table->bigInteger('requested_branch_id')->references('id')->on('branches')->onDelete('cascade');
            $table->bigInteger('approved_branch_id')->unsigned();
            $table->foreign('approved_branch_id')->references('id')->on('branches')->onDelete('cascade');
            $table->bigInteger('requested_user_id')->unsigned();
            $table->foreign('requested_user_id')->references('id')->on('users')->onDelete('cascade');
            $table->bigInteger('approved_user_id')->unsigned()->nullable();
            $table->foreign('approved_user_id')->references('id')->on('users')->onDelete('cascade');
            $table->dateTime('requested_date');
            $table->dateTime('approved_date')->nullable();
            $table->string('location_status');
            $table->string('request_status');
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
        Schema::dropIfExists('order_transfers');
    }
}
