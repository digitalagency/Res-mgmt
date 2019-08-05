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
        $items = [
            ['name'=>'admin', 'email' => 'admin@admin.com', 'password' => 'hello123']
        ];

        foreach($items as $item){
            User::create($item);
        }
    }
}
