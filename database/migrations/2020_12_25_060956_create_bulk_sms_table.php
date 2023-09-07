<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class CreateBulkSmsTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('bulk_sms', function (Blueprint $table) {
            $table->id();
            $table->unsignedBigInteger('student_id')->comment('student_id=user_id');
            $table->unsignedBigInteger('year_id');
            $table->unsignedBigInteger('class_id');
            $table->string('roll');
            $table->longText('body');
            $table->string('status');
            $table->foreign('student_id')
                ->references('id')->on('users')
                ->onDelete('cascade');
            $table->foreign('year_id')
                ->references('id')->on('years')
                ->onDelete('cascade');
            $table->foreign('class_id')
                ->references('id')->on('student_classes')
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
        Schema::dropIfExists('bulk_sms');
    }
}
