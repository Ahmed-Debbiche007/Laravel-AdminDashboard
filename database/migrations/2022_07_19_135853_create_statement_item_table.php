<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class CreateStatementItemTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('statement_items', function (Blueprint $table) {
            
            $table->unsignedBigInteger('statement_id');
            $table->foreign('statement_id')->references('id')->on('statements')->onUpdate('cascade')->onDelete('cascade');
            $table->unsignedBigInteger('listing_id');
            $table->foreign('listing_id')->references('id')->on('listings')->onUpdate('cascade');
            $table->float('quantity');
            $table->float('discount');
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
        Schema::dropIfExists('statement_items');
    }
}
