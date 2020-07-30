<?php

use Illuminate\Support\Facades\Schema;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Database\Migrations\Migration;

class CreateProjectsTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('projects', function (Blueprint $table) {
            $table->bigIncrements('id');
            $table->string('name');
            $table->longText('description')->nullable();
            $table->integer('company_id')->unsigned()->nullable();
            $table->integer('user_id')->unsigned();
            $table->integer('days')->unsigned()->nullable(); /*no. of days completion of project will take */
           
            $table->foreign('user_id')->references('id')->on('users'); /*foreign key that references the id field in the users table */
            $table->foreign('company_id')->references('id')->on('companies'); /*foreign key that references the company id field in the companies table */
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
        Schema::dropIfExists('projects');
    }
}
