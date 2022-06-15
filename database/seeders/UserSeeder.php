<?php

namespace Database\Seeders;

use Illuminate\Database\Seeder;
use App\Models\User;
class UserSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {

        $users =  [
            [
              'name' => 'admin',
              'email' => 'admin@gmail.com',
              'password' => bcrypt('123456'),
              'role'=>1,
            ],
            [
              'name' => 'superadmin',
              'email' => 'superadmin@gmail.com',
              'password' => bcrypt('123456'),
              'role'=>2,
            ],
            [
                'name' => 'customer',
                'email' => 'customer@gmail.com',
                'password' => bcrypt('123456'),
                'role'=>3,
            ],
          ];

          User::insert($users);
    }
}
