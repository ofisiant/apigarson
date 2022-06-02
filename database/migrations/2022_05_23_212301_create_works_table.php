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
        Schema::create('works', function (Blueprint $table) {
            $table->id();
            $table->string('client_id');
            $table->integer('salary');
            $table->date('work_day');
            $table->dateTime('work_hour');
            $table->string('customer');
            $table->integer('employee_numbers');
            $table->text('description');
            $table->enum('position', ['Garson', 'Garson Assistant','Chef' , 'Steward' , 'Hostes']);
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
        Schema::dropIfExists('works');
    }
};
