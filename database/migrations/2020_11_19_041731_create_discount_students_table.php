<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class CreateDiscountStudentsTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('discount_students', function (Blueprint $table) {
            $table->id();
            $table->unsignedBigInteger('assign_student_id');
            $table->unsignedBigInteger('fee_category_id');
            $table->double('discount')->nullable();
            $table->foreign('assign_student_id')
                ->references('id')->on('assign_students')
                ->onDelete('cascade');
            $table->foreign('fee_category_id')
                ->references('id')->on('fee_categories')
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
        Schema::dropIfExists('discount_students');
    }
}
