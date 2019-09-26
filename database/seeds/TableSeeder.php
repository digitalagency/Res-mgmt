<?php

use App\Models\Admin\Table;
use Illuminate\Database\Seeder;

class TableSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        DB::statement('SET FOREIGN_KEY_CHECKS = 0');
        
        Table::truncate();
        $tablesNumber = 20;
        factory(Table::class, $tablesNumber)->create();
    }
}
