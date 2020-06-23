<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

<<<<<<< HEAD:database/migrations/2014_10_12_000000_create_users_table.php
class CreateUsersTable extends Migration
=======
class CreateChurchTable extends Migration
>>>>>>> create church table:database/migrations/2020_06_22_110148_create_church_table.php
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
<<<<<<< HEAD:database/migrations/2014_10_12_000000_create_users_table.php
        Schema::create('users', function (Blueprint $table) {
            $table->id();
            $table->string('name');
            $table->string('email')->unique();
            $table->timestamp('email_verified_at')->nullable();
            $table->string('password');
            $table->rememberToken();
=======
        Schema::create('church', function (Blueprint $table) {
            $table->id();
	    $table->string('name');
	    $table->string('location');
	    $table->string('religion');
>>>>>>> create church table:database/migrations/2020_06_22_110148_create_church_table.php
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
<<<<<<< HEAD:database/migrations/2014_10_12_000000_create_users_table.php
        Schema::dropIfExists('users');
=======
        Schema::dropIfExists('church');
>>>>>>> create church table:database/migrations/2020_06_22_110148_create_church_table.php
    }
}
