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
            $table->string('name');
            $table->string('photo')->nullable();
            $table->integer('salary');
            $table->smallInteger('employers');
            $table->string('customer');
            $table->enum('position', ['Garson', 'Garson Assistant','Chef' , 'Steward' , 'Hostes']);
            $table->text('description');
            $table->enum('status', ['0', '1','2'])->default('0');
            $table->enum('express', ['0', '1'])->default('0');
            $table->dateTime('start_at');
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
