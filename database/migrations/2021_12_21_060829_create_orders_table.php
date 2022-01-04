<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class CreateOrdersTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('orders', function (Blueprint $table) {
            $table->bigIncrements('id')->unsigned();
            $table->string('serial_number');
            $table->string('customer_name');
            $table->string('mobile');
            $table->string('Item');
            $table->string('weight');
            $table->decimal('total_amount');
            $table->decimal('paid_amount');
            $table->string('payment_mode');
            $table->dateTime('created_date');
            $table->dateTime('due_date');
            $table->bigInteger('created_branch_id')->unsigned();
            $table->foreign('created_branch_id')->references('id')->on('branches')->onDelete('cascade');
            $table->bigInteger('created_user_id')->unsigned();
            $table->foreign('created_user_id')->references('id')->on('users')->onDelete('cascade');
            $table->string('current_location');
            $table->string('address');
            $table->string('img')->nullable();
            $table->string('working_status');
            $table->string('description')->nullable();
            $table->timestamps();
        });
    }

    public function down()
    {
        Schema::dropIfExists('orders');
    }
}
