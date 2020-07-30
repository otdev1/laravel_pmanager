<?php

use Illuminate\Support\Facades\Schema;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Database\Migrations\Migration;

/* This table stores data about which user is connected to which project 
   user with user id 1 may be assigned to project 1 , 3 , 7 etc.
*/

class CreateProjectUserTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('project_user', function (Blueprint $table) {
            $table->bigIncrements('id');
            $table->integer('project_id')->unsigned();
            $table->integer('user_id')->unsigned();

            $table->foreign('user_id')->references('id')->on('users'); /*foreign key that references the id field in the users table */
            $table->foreign('project_id')->references('id')->on('projects');

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
        Schema::dropIfExists('project_user');
    }
}
