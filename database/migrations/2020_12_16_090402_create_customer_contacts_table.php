<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class CreateCustomerContactsTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('customer_contacts', function (Blueprint $table) {
            $table->id();
            $table->foreignUuid('customer_id')->references('id')->on('customers')
                ->onUpdate('cascade')
                ->onDelete('cascade');
            $table->unsignedBigInteger('shipping_address_id')->nullable();
            $table->foreign('shipping_address_id')->references('id')->on('shipping_addresses')
                ->onUpdate('cascade')
                ->onDelete('cascade');
            $table->string('name');
            $table->string('phone')->nullable();
            $table->string('email')->nullable();
            $table->string('mobile')->nullable();
            $table->string('position')->nullable();
            $table->string('division')->nullable();
        });
    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down()
    {
        Schema::dropIfExists('customer_contacts');
    }
}
