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
        Schema::create('patients', function (Blueprint $table) {
            $table->id();
            $table->integer('MRN');
            $table->string('fname',100);
            $table->string('lname',100);
            $table->string('password',100);
            $table->text('protocol',255)->nullable();
            $table->text('medical_history',255)->nullable();
            $table->integer('age')->nullable();
            $table->foreignId("receptionist_id")->constrained();
            $table->string('token',255)->nullable();
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
        Schema::dropIfExists('patients');
    }
};
