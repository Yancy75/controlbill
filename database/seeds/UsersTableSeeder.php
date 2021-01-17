<?php

use App\User;
use Illuminate\Database\Seeder;

class UsersTableSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        factory(User::class)->create([
            'name'     => 'Jose Tejada',
            'username' => 'jetdai',
            'email'    => 'jet_thunder@hotmail.com',
            'password' => bcrypt('123456'),
            'status'   => '1',
            'level'    => 'admin',
        ]);

    }
}
