<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class CreateStoreDetailTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('store_detail', function (Blueprint $table) {
            $table->id();
            $table->bigInteger('store_id')->unsigned()->nullable();
            $table->bigInteger('user_id')->nullable();
            $table->bigInteger('user_delete_id')->nullable();
            $table->string('name', 254)->nullable();
            $table->string('address', 254)->nullable();
            $table->string('phone', 254)->nullable();
            $table->text('description')->nullable();
            $table->timestamps();
            $table->softDeletes();
        });
    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down()
    {
        Schema::dropIfExists('store_detail');
    }
}
