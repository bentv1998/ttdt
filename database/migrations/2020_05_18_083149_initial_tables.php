<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class InitialTables extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('teachers', function (Blueprint $table) {
            $table->id();
            $table->string('code')->unique();
            $table->string('phone')->unique();
            $table->string('birth');
            $table->foreignId('user_id')->references('id')->on('users');
            $table->tinyInteger('gender')->default(0);
            $table->timestamps();
        });

        Schema::create('staffs', function (Blueprint $table) {
            $table->id();
            $table->string('code')->unique();
            $table->string('phone')->unique();
            $table->string('birth');
            $table->foreignId('user_id')->references('id')->on('users');
            $table->tinyInteger('gender')->default(0);
            $table->timestamps();
        });

        Schema::create('parents', function (Blueprint $table) {
            $table->id();
            $table->string('code')->unique();
            $table->string('phone')->unique();
            $table->string('email');
            $table->bigInteger('user_id')->nullable();
            $table->timestamps();
        });

        Schema::create('students', function (Blueprint $table) {
            $table->id();
            $table->string('code')->unique();
            $table->string('image')->nullable();
            $table->string('name');
            $table->string('birth')->nullable();
            $table->foreignId('parent_id')->references('id')->on('parents');
            $table->tinyInteger('gender')->default(0);
            $table->timestamps();
        });

        Schema::create('classes', function (Blueprint $table) {
            $table->id();
            $table->string('code')->unique();
            $table->string('name');
            $table->foreignId('schedule_id')->references('id')->on('schedules');
            $table->foreignId('teacher_id')->references('id')->on('teachers');
            $table->integer('tuition');
            $table->timestamps();
        });

        Schema::create('schedules', function (Blueprint $table) {
            $table->id();
            $table->string('name');
            $table->time('time');
            $table->text('day');
            $table->timestamps();
        });

        Schema::create('class_students', function (Blueprint $table) {
            $table->id();
            $table->foreignId('student_id')->references('id')->on('students');
            $table->foreignId('class_id')->references('id')->on('classes');
            $table->boolean('status')->default(false);
            $table->timestamps();
        });

        Schema::create('products', function (Blueprint $table) {
            $table->id();
            $table->string('name');
            $table->string('code')->unique();
            $table->integer('sku')->default(0);
            $table->integer('price');
            $table->integer('discount')->default(0);
            $table->boolean('status')->default(true);
            $table->foreignId('category_id')->references('id')->on('categories');
            $table->string('img')->nullable();
            $table->string('description')->nullable();
            $table->timestamps();
        });

        Schema::create('orders', function (Blueprint $table) {
            $table->id();
            $table->string('code')->unique();
            $table->foreignId('staff_id')->references('id')->on('staffs');
            $table->foreignId('parent_id')->references('id')->on('parents');
            $table->integer('discount')->default(0);
            $table->integer('total');
            $table->integer('amount_paid');
            $table->integer('refund');
            $table->string('note')->nullable();
            $table->timestamps();
        });

        Schema::create('order_details', function (Blueprint $table) {
            $table->id();
            $table->foreignId('product_id')->references('id')->on('products');
            $table->foreignId('order_id')->references('id')->on('orders');
            $table->integer('discount')->default(0);
            $table->integer('price');
            $table->integer('quantity');
            $table->timestamps();
        });

        Schema::create('attendances', function (Blueprint $table) {
            $table->id();
            $table->string('student_ids');
            $table->foreignId('class_id')->references('id')->on('classes');
            $table->boolean('status')->default(false);
            $table->timestamps();
        });

        Schema::create('absents', function (Blueprint $table) {
            $table->id();
            $table->foreignId('student_id')->references('id')->on('students');
            $table->foreignId('class_id')->references('id')->on('classes');
            $table->timestamps();
        });

        Schema::create('tests', function (Blueprint $table) {
            $table->id();
            $table->string('name');
            $table->foreignId('teacher_id')->references('id')->on('teachers');
            $table->foreignId('class_id')->references('id')->on('classes');
            $table->integer('time');
            $table->timestamps();
        });

        Schema::create('questions', function (Blueprint $table) {
            $table->id();
            $table->foreignId('test_id')->references('id')->on('tests');
            $table->text('content');
            $table->string('option_1');
            $table->string('option_2');
            $table->string('option_3')->nullable();
            $table->string('option_4')->nullable();
            $table->string('answer');
            $table->timestamps();
        });

        Schema::create('categories', function (Blueprint $table) {
            $table->id();
            $table->string('name');
            $table->text('description')->nullable();
            $table->timestamps();
        });

        Schema::create('mails', function (Blueprint $table) {
            $table->id();
            $table->string('key')->unique();
            $table->string('header')->nullable();
            $table->text('body')->nullable();
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
        Schema::dropIfExists('mails');
        Schema::dropIfExists('absents');
        Schema::dropIfExists('order_details');
        Schema::dropIfExists('orders');
        Schema::dropIfExists('products');
        Schema::dropIfExists('categories');
        Schema::dropIfExists('attendances');
        Schema::dropIfExists('questions');
        Schema::dropIfExists('tests');
        Schema::dropIfExists('class_students');
        Schema::dropIfExists('classes');
        Schema::dropIfExists('schedules');
        Schema::dropIfExists('teachers');
        Schema::dropIfExists('students');
        Schema::dropIfExists('parents');
        Schema::dropIfExists('staffs');
    }
}
