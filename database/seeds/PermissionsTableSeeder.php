<?php

use App\Models\Admin\Permission;
use Illuminate\Database\Seeder;

class PermissionsTableSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        Permission::truncate();
        $items = [
            ['permission' => 'user-access', 'p_component_id' => 1],
            ['permission' => 'employee-access', 'p_component_id' => 1 ],
            ['permission' => 'employee-add', 'p_component_id' => 1 ],
            ['permission' => 'employee-edit', 'p_component_id' => 1 ],
            ['permission' => 'employee-view', 'p_component_id' => 1 ],
            ['permission' => 'employee-delete', 'p_component_id' => 1 ],
            ['permission' => 'employee-action', 'p_component_id' => 1 ],
            ['permission' => 'role-view', 'p_component_id' => 2 ],
            ['permission' => 'role-add', 'p_component_id' => 2 ],
            ['permission' => 'role-edit', 'p_component_id' => 2 ],
            ['permission' => 'role-delete', 'p_component_id' => 2 ],
            ['permission' => 'role-action', 'p_component_id' => 2 ],
            ['permission' => 'permission-view', 'p_component_id' => 3 ],
            ['permission' => 'permission-add', 'p_component_id' => 3 ],
            ['permission' => 'permission-edit', 'p_component_id' => 3 ],
            ['permission' => 'permission-delete', 'p_component_id' => 3 ],
            ['permission' => 'table-access', 'p_component_id' => 4 ],
            ['permission' => 'table-view', 'p_component_id' => 4 ],
            ['permission' => 'table-add', 'p_component_id' => 4 ],
            ['permission' => 'table-edit', 'p_component_id' => 4 ],
            ['permission' => 'table-delete', 'p_component_id' => 4 ],
            ['permission' => 'table-action', 'p_component_id' => 4 ],
            ['permission' => 'category-access', 'p_component_id' => 5 ],
            ['permission' => 'category-view', 'p_component_id' => 5 ],
            ['permission' => 'category-add', 'p_component_id' => 5 ],
            ['permission' => 'category-edit', 'p_component_id' => 5 ],
            ['permission' => 'category-delete', 'p_component_id' => 5 ],
            ['permission' => 'category-action', 'p_component_id' => 5 ],
            ['permission' => 'category-single', 'p_component_id' => 5 ],
            ['permission' => 'product-access', 'p_component_id' => 6 ],
            ['permission' => 'product-view', 'p_component_id' => 6 ],
            ['permission' => 'product-add', 'p_component_id' => 6 ],
            ['permission' => 'product-edit', 'p_component_id' => 6 ],
            ['permission' => 'product-delete', 'p_component_id' => 6 ],
            ['permission' => 'product-metadata', 'p_component_id' => 6 ],
            ['permission' => 'product-single', 'p_component_id' => 6 ],
            ['permission' => 'product-featured', 'p_component_id' => 6 ],
        ];

        foreach ($items as $item) {
            Permission::create($item);
        }
    }
}
