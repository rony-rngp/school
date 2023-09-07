<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class CreateAdmissionsTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('admissions', function (Blueprint $table) {
            $table->id();
            $table->string('name');
            $table->string('fname');
            $table->string('mname');
            $table->string('mobile');
            $table->string('address');
            $table->string('gender');
            $table->string('religion');
            $table->date('dob');
            $table->unsignedBigInteger('year_id');
            $table->unsignedBigInteger('class_id');
            $table->string('image')->nullable();
            $table->double('amount')->nullable();
            $table->string('transaction')->nullable();
            $table->string('reference')->nullable();
            $table->foreign('class_id')
                ->references('id')->on('student_classes')
                ->onDelete('cascade');
            $table->foreign('year_id')
                ->references('id')->on('years')
                ->onDelete('cascade');
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
        Schema::dropIfExists('admissions');
    }
}
