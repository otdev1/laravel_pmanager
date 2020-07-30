<?php

use Illuminate\Support\Facades\Schema;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Database\Migrations\Migration;

class CreateTasksTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('tasks', function (Blueprint $table) {
            $table->bigIncrements('id');
            $table->string('name');
            $table->integer('project_id')->unsigned(); /*the id of the project that the task belongs to */
            $table->integer('user_id')->unsigned(); /*the id of the user that created the task */
            $table->integer('days')->unsigned()->nullable(); /*number of days completion of task will take, nullable indicates that this field can be empty */
            $table->integer('hours')->unsigned()->nullable(); /*number of hours completion of task will take, nullable indicates that this field can be empty*/

            $table->integer('company_id')->unsigned()->nullable();
            $table->foreign('user_id')->references('id')->on('users'); /*foreign key that references the id field in the users table */
            
            $table->foreign('project_id')->references('id')->on('projects'); /*foreign key that references the project id field in the projects table */
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
        Schema::dropIfExists('tasks');
    }
}
