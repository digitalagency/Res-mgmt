<?php
use App\User;
use App\Models\Admin\Role;
use App\Models\Admin\Permission;
use App\Models\Admin\PermissionComponent;
use App\Models\Admin\Category;
use App\Models\Admin\Product;

use App\Models\Admin\Table;

//Home Breadcrumb
Breadcrumbs::for('home', function ($trail) {
    $trail->push('Home', route('home'));
});

/*
*   Employee Breadcrumb
*/

// Home / Employee
Breadcrumbs::for('employee.index', function ($trail) {
    $trail->parent('home');
    $trail->push('Employees', route('employee.index'));
});



// Home / Employees / Create Employee
Breadcrumbs::for('employee.create', function ($trail) {
    $trail->parent('employee.index');
    $trail->push('Create Employee', route('employee.create'));
});

// Home / Employees / Create Employee / [ Employee Name ]
Breadcrumbs::for('employee.edit', function ($trail, $id) {
    $user = User::find($id);
    $trail->parent('employee.index');
    $trail->push($user->name, route('employee.edit', $user->name));
});

/*
*   Role Breadcrumb
*/

// Home / Roles
Breadcrumbs::for('role.index', function ($trail) {
    $trail->parent('home');
    $trail->push('Roles', route('role.index'));
});

// Home / Role / Create Role
Breadcrumbs::for('role.create', function ($trail) {
    $trail->parent('role.index');
    $trail->push('Create Role', route('role.create'));
});

// Home / Role / Create Role / [ Role ]
Breadcrumbs::for('role.edit', function ($trail, $id) {
    $role = Role::find($id);
    $trail->parent('role.index');
    $trail->push($role->role, route('role.edit', $role->role));
});

/*
*   Permission Breadcrumb
*/

// Home / Permissions
Breadcrumbs::for('permission.index', function ($trail) {
    $trail->parent('home');
    $trail->push('Permissions', route('permission.index'));
});

// Home / Permissions / Create Permission
Breadcrumbs::for('permission.create', function ($trail) {
    $trail->parent('permission.index');
    $trail->push('Create Permission', route('permission.create'));
});

// Home / Permissions / Create Permission / [ Permission ]
Breadcrumbs::for('permission.edit', function ($trail, $id) {
    $permission = Permission::find($id);
    $trail->parent('permission.index');
    $trail->push($permission->permission, route('permission.edit', $permission->permission));
});

/*
*   Permission Component Breadcrumb
*/

// Home / Permission Components
Breadcrumbs::for('p_component.index', function ($trail) {
    $trail->parent('home');
    $trail->push('Permission Components', route('p_component.index'));
});

// Home / Permission Components / Create Permission Component
Breadcrumbs::for('p_component.create', function ($trail) {
    $trail->parent('p_component.index');
    $trail->push('Create Permission Component', route('p_component.create'));
});

// Home / Permission Components / Create Permission Component / [ Permission Component ]
Breadcrumbs::for('p_component.edit', function ($trail, $id) {
    $p_component = PermissionComponent::find($id);
    $trail->parent('p_component.index');
    $trail->push($p_component->component, route('p_component.edit', $p_component->component));
});

/**
 * Category Breadcrumbs
 */
// Home / Category / Create
Breadcrumbs::for('category.create', function ($trail) {
    $trail->parent('home');
    $trail->push('Create Category', route('category.create'));
});


// Home / Category /
Breadcrumbs::for('category.index', function ($trail) {
    $trail->parent('home');
    $trail->push('Category', route('category.index'));
});

// Home/ Category / edit
Breadcrumbs::for('category.edit', function ($trail, $id) {
    $category = Category::find($id);
    $trail->parent('category.index');
    $trail->push($category->name, route('category.edit', $category->name));
});


// Home/ Category / [Category Name]
Breadcrumbs::for('category.single', function ($trail, $slug) {
    $category = Category::where('slug', $slug)->first();
    $trail->parent('category.index');
    $trail->push($category->name, route('category.single', $category->name));
});

/**
 * Product Breadcrumbs
 */
// Home / Product /
Breadcrumbs::for('product.index', function ($trail) {
    $trail->parent('home');
    $trail->push('Product', route('product.index'));
});

// Home / Product / Create
Breadcrumbs::for('product.create', function ($trail) {
    $trail->parent('product.index');
    $trail->push('Create Product', route('product.create'));
});

// Home/ Product / [ProductName]
Breadcrumbs::for('product.edit', function ($trail, $id) {
    $product = Product::find($id);
    $trail->parent('product.index');
    $trail->push($product->name, route('product.edit', $product->name));
});


// Home/ Product / [ProductName]
Breadcrumbs::for('product.single', function ($trail, $slug) {
    $product = Product::where('slug', $slug)->first();
    $trail->parent('product.index');
    $trail->push($product->name, route('product.single', $product->name));
});
/*
*   Table Breadcrumb
*/

// Home / Tables
Breadcrumbs::for('table.index', function ($trail) {
    $trail->parent('home');
    $trail->push('Tables', route('table.index'));
});

// Home / Tables / Create Table
Breadcrumbs::for('table.create', function ($trail) {
    $trail->parent('table.index');
    $trail->push('Add Table', route('table.create'));
});

// Home / Tables / Create Table / [ Permission ]
Breadcrumbs::for('table.edit', function ($trail, $id) {
    $table = Table::find($id);
    $trail->parent('table.index');
    $trail->push($table->table_no, route('table.edit', $table->table_no));
});
