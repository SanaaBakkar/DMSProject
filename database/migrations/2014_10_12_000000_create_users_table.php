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
        Schema::create('users', function (Blueprint $table) {
            $table->increments('id');
            $table->string('name');
            $table->string('email')->unique();
            $table->unsignedInteger('departement_id')->nullable()->index();
            $table->foreign('departement_id')->references('id')->on('departements');
            $table->unsignedInteger('role_id')->nullable()->index();
            $table->foreign('role_id')->references('id')->on('roles');
            $table->unsignedInteger('group_id')->nullable()->index();
            $table->foreign('group_id')->references('id')->on('groups');
            $table->timestamp('email_verified_at')->nullable();
            $table->string('password');
            $table->rememberToken();
            $table->timestamps();
            $table->boolean('admin')->default(0);

        });
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
