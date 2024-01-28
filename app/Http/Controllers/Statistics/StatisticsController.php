<?php

namespace App\Http\Controllers\Statistics;

use App\Http\Controllers\Controller;
use App\Models\Category;
use App\Models\Product;
use App\Models\User;
use App\Traits\Response;

class StatisticsController extends Controller
{
    use Response;
    public function __construct()
    {
        $this->middleware('permission:show_statistics');
    }
    public function __invoke()
    {
        $numberOfusers = User::count();
        $numberOfcategories = Category::count();
        $numberOfproducts = Product::count();
        $data = [
            'users_count' => $numberOfusers,
            'categories_count' => $numberOfcategories,
            'products_count' => $numberOfproducts,
        ];
        return $this->okResponse('data fetched successfully',$data);
    }
}
