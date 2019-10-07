<?php

use Illuminate\Support\Facades\Schema;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Database\Migrations\Migration;

class CreateOffersTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('offers', function (Blueprint $table) {
            // Identifier
            $table->increments('id');
            
            // Fields
            $table->string('position');
            $table->longText('description');
            $table->string('experience')->nullable();
            $table->string('start_date')->nullable();
            $table->string('contract_type')->nullable();
            $table->enum('category', ['IT', 'Marketing', 'Business']);
            $table->boolean('finished')->default(false);
            
            // Foreign keys
            $table->integer('company_id')->unsigned();
            $table->foreign('company_id')->references('id')->on('companies');
            
            // Timestamps
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
        Schema::dropIfExists('offers');
    }
}
