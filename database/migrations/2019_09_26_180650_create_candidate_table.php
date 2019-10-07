<?php

use Illuminate\Support\Facades\Schema;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Database\Migrations\Migration;

class CreateCandidateTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('candidates', function (Blueprint $table) {
            // Identifier
            $table->increments('id');
            
            // Fields
            $table->string('name');
            $table->string('lastname');
            $table->string('email')->unique();
            $table->string('password');
            $table->string('phone')->nullable();
            $table->string('curriculum')->nullable();
            $table->rememberToken();
//             $table->string('api_token', 60)->unique();

            // Timestamps
            $table->timestamps();
            
            // Foreign keys
//             $table->integer('contact_reason_id')->unsigned();
//             $table->foreign('contact_reason_id')->references('id')->on('contact_reason');
//             $table->integer('user_id')->nullable()->unsigned();
//             $table->foreign('user_id')->references('id')->on('user');
        });
    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down()
    {
        Schema::dropIfExists('contact');
    }
}
