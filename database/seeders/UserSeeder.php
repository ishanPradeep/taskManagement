<?php
namespace Database\Seeders;

use App\Models\UserLevel;
use Illuminate\Database\Seeder;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Facades\Hash;

class UserSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        DB::table('users')->insert([
            [
                'name' => 'user',
                'email' => 'user@gmail.com',
                'email_verified_at'=>'2020-06-18 19:43:54.000000',
                'password' => Hash::make('user'),
                'user_level_id' => UserLevel::where('scope','user')->first()->id,
            ]

        ]);

//        $user = User::where('email', 'superadmin@gmail.com')->first();
//        $user->assignRole('super_admin');
//        $user->save();
    }
}
