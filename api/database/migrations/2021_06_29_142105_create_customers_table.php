<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class CreateCustomersTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('customers', function (Blueprint $table) {
            $table->id();
            $table->string('cpf')->nullable(false)->unique();
            $table->string('name', 200)->nullable(false);
            $table->string('password', 191)->nullable(false);
            $table->integer('phone', 11);
            $table->integer('birthday', 8);
            $table->integer('zipcode', 8);
            $table->string('state', 2);
            $table->string('city', 20);
            $table->integer('attendents_id')
                ->nullable()
                ->unsigned();
            $table->foreign('attendents_id')
                ->references('id')
                ->on('attendents')
                ->onDelete('cascade');
            $table->softDeletes();
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
        Schema::dropIfExists('customers');
    }
}
