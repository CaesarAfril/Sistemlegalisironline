<?php

namespace Database\Seeders;

use Illuminate\Database\Seeder;
use App\Models\User;
use Hash;

class userSeeders extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        $user = new User;
        $user->name = "superadmin";
        $user->email = "SA@gmail.com";
        $user->password = Hash::make("aaaa");
        $user->email_verified_at = \Carbon\Carbon::now();
        $user->role = "1";
        $simpan = $user->save();
    }
}
