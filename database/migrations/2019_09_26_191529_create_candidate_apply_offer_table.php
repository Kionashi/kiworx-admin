<?php

use Illuminate\Database\Schema\Blueprint;
use Illuminate\Database\Migrations\Migration;
use Illuminate\Support\Facades\Schema;

class CreateCandidateApplyOfferTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('candidate_apply_offer', function (Blueprint $table) {
        	
        	// Foreign keys
    		$table->integer('candidate_id')->unsigned();
    		$table->foreign('candidate_id')->references('id')->on('candidates')->onDelete('cascade');
    		$table->integer('offer_id')->unsigned();
    		$table->foreign('offer_id')->references('id')->on('offers');
    	});
    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down()
    {
        Schema::drop('admin_user_has_role');
    }
}
