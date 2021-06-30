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
            $table->string('password', 128)->nullable(false);
            $table->string('email', 200)->nullable(false);
            $table->string('phone', 20)->nullable(false);
            $table->date('birthday')->nullable(false);
            $table->string('zipcode', 10)->nullable();
            $table->string('state', 2)->nullable();
            $table->string('city', 20)->nullable();
            $table->foreignId('attendent_id')
                ->nullable()
                ->unsigned();
            $table->foreign('attendent_id')
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
