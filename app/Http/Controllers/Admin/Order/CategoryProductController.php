<?php

namespace App\Http\Controllers\Admin\Order;

use App\Models\Admin\Category;
use Illuminate\Http\Request;
use App\Http\Controllers\Controller;

class CategoryProductController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index(Category $category)
    {
        $products = $category->products->where('status', 1)->map->only(['id', 'name', 'price']);
        return $products;
    }
}
