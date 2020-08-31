<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

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
            $table->bigIncrements('id');
            $table->string('email')->unique();
						$table->string('password');
						$table->integer('type')->default(1);
						$table->timestamp('email_verified_at')->nullable();
						$table->integer('email_verified')->default(0);
						$table->string('email_verification_token')->default('');
						$table->timestamp('last_login')->nullable();
						$table->rememberToken();
						$table->softDeletes();
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
        Schema::dropIfExists('users');
    }
}
