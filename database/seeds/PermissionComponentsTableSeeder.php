<?php

use App\Models\Admin\PermissionComponent;
use Illuminate\Database\Seeder;

class PermissionComponentsTableSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        PermissionComponent::truncate();
        $items = [
            ['id' => 1, 'component' => 'User Management'],
            ['id' => 2, 'component' => 'Role'],
            ['id' => 3, 'component' => 'Permission'],
            ['id' => 4, 'component' => 'Table Management'],
            ['id' => 5, 'component' => 'Category'],
            ['id' => 6, 'component' => 'Product'],
        ];

        foreach($items as $item)
        {
            PermissionComponent::create($item);
        }
    }
}
