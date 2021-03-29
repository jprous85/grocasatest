<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class CreateLeadsTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('leads', function (Blueprint $table) {
            $table->increments('id');
            $table->string('name');
            $table->enum('source', ['FOTOCASA', 'HABITACLIA']);
            $table->integer('owner');
            $table->integer('created_by');
            $table->timestamps();

            $table->foreign('owner')->references('_id')->on('users')->onDelete('cascade')->onUpdate('cascade');
            $table->foreign('created_by')->references('_id')->on('users')->onDelete('cascade')->onUpdate('cascade');
        });
    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down()
    {
        Schema::dropIfExists('leads');
    }
}
