<?php

use Illuminate\Database\Seeder;
use App\User;

class UsersTableSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        User::truncate();
        $items = [
            ['name'=>'admin', 'email' => 'admin@admin.com', 'password' => bcrypt('hello123'), 'role_id' => 1]
        ];

        foreach($items as $item){
            User::create($item);
        }
    }
}
