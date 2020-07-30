<?php

use Illuminate\Support\Facades\Schema;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Database\Migrations\Migration;

class CreateCommentsTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('comments', function (Blueprint $table) {
            $table->bigIncrements('id');
            $table->longText('body');
            $table->string('url', 255)->nullable(); /*allows user to provide a link to work that they have done for the day, 255 specifies the length(no. of characters) of the url, nullable indicates that this field can be empty*/
            $table->integer('user_id')->unsigned(); /*the id of the user that created the comment */
            $table->integer('commentable_id')->unsigned(); /*the id of the table that the comment is associated with e.g a comment that corresponds to a task */
            $table->string('commentable_type'); /*the name of the table that the comment is associated with e.g a comment that corresponds to a task */

            $table->foreign('user_id')->references('id')->on('users'); /*foreign key that references the id field in the users table */
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
        Schema::dropIfExists('comments');
    }
}
