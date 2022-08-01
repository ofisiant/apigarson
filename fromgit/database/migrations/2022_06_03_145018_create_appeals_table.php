<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

return new class extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('appeals', function (Blueprint $table) {
            $table->id();
            $table->bigInteger('user_id')->unsigned(); 
            $table->index('user_id');
            $table->foreign('user_id')->references('id')->on('users');

            $table->bigInteger('job_id')->unsigned(); 
            $table->index('job_id');
            $table->foreign('job_id')->references('id')->on('works');


            $table->enum('status', ['0', '1','2'])->default(0);
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
        
        Schema::dropIfExists('appeals');
    }
};
