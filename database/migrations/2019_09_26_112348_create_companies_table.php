<?php

use Illuminate\Support\Facades\Schema;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Database\Migrations\Migration;

class CreateCompaniesTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('companies', function (Blueprint $table) {
            // Identifier
            $table->increments('id');
            
            // Fields
            $table->string('name');
            $table->longText('description');
            $table->string('category');
            $table->string('logo')->nullable();
            $table->string('backgroundImage')->nullable();
            $table->string('address')->nullable();
            $table->string('address_url')->nullable();
            $table->string('website')->nullable();
            $table->string('linkedin')->nullable();
            $table->string('instagram')->nullable();
            $table->string('facebook')->nullable();
            $table->string('twitter')->nullable();
            $table->string('youtube')->nullable();
            $table->string('key_person_name')->nullable();
            $table->string('key_person_image')->nullable();
            $table->string('key_person_title')->nullable();
            
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
        Schema::table('companies', function (Blueprint $table) {
            Schema::dropIfExist('companies');
        });
    }
}
