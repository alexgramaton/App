<?php

use Illuminate\Database\Seeder;
use Illuminate\Database\Eloquent\Model;
use App\User;
use Illuminate\Support\Str;

class UsersTableSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        if(config('admin.admin_email')) {
            User::firstOrCreate(
                ['email' => config('admin.admin_email')], [
										'password' => bcrypt(config('admin.admin_password')),
										'type' => config('admin.admin_type'),
										'email_verified' => 1,
										'email_verification_token' => '',
                ]
            );
        }
    }
}
