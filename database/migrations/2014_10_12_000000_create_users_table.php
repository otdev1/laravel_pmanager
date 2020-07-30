<?php

use Illuminate\Support\Facades\Schema;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Database\Migrations\Migration;

class CreateUsersTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        if(!Schema::hasTable('users')){
            Schema::create('users', function (Blueprint $table) {
                $table->bigIncrements('id'); /*this field is referenced by the companies table */
                $table->string('name');
                $table->string('email')->unique();
                $table->timestamp('email_verified_at')->nullable();
                $table->string('password');

                $table->string('first_name')->nullable();
                $table->string('middle_name')->nullable();
                $table->string('last_name')->nullable();
                $table->string('city')->nullable();
                $table->integer('role_id')->unsigned()->default(3); /*the dafault role for a newly created user is 3*/

                $table->rememberToken();
                $table->timestamps();
            });
        }
        /*Schema::table('users', function (Blueprint $table){ /*table command(schema method - https://laravel.com/docs/5.0/schema) is used to update an existing column 
            $table->string('first_name')->nullable();
            $table->string('middle_name')->nullable();
            $table->string('last_name')->nullable();
            $table->string('city')->nullable();
            $table->integer('role_id')->unsigned()->default(3); /*the dafault role for a newly created user is 3
        });*/
    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down()
    {
        Schema::dropIfExists('users');
    }
}
