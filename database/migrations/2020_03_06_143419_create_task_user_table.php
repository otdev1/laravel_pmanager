<?php

use Illuminate\Support\Facades\Schema;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Database\Migrations\Migration;

/* This table stores data about which user is connected to which task 
   user with user id 1 may be assigned to task 1 , 3 , 7 etc.
*/

class CreateTaskUserTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('task_user', function (Blueprint $table) {
            $table->bigIncrements('id');

            $table->integer('task_id')->unsigned();
            $table->integer('user_id')->unsigned();

            $table->foreign('user_id')->references('id')->on('users'); /*foreign key that references the id field in the users table */
            $table->foreign('task_id')->references('id')->on('tasks');

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
        Schema::dropIfExists('task_user');
    }
}
