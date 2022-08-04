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
        Schema::create('users', function (Blueprint $table) {
            $table->id();
            $table->string('name');
            $table->string('email')->unique();
            $table->timestamp('email_verified_at')->nullable();
            $table->string('password');
            $table->string('phone')->nullable();
            $table->string('passport_seriya')->nullable();
            $table->enum('role', ['0','1', '2', '3', '4'])->default('0');
            $table->string('photo')->nullable();
            $table->text('description')->nullable();
            $table->enum('position', ['Garson','Garson Assistant', 'Chef', 'Chef Assistant', 'Steward', 'Hostes'])->default('Garson');
            $table->integer('balance')->default(0);
            $table->integer('profit')->default(0);
            $table->integer('completed_work')->default(0);
            $table->enum('job_status', ['0','1', '2'])->default('0');

            $table->smallInteger('eng_lang')->default(0);
            $table->smallInteger('tr_lang')->default(0);
            $table->smallInteger('ru_lang')->default(0);

            $table->rememberToken();
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
        Schema::dropIfExists('users');
    }
};
