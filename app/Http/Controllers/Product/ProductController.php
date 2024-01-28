<?php

namespace App\Http\Controllers\Product;


use App\Models\Product;
use App\Traits\Response;
use Illuminate\Http\Request;
use App\Http\Controllers\Controller;
use App\Http\Requests\Product\ProductRequest;
use App\Http\Resources\Product\ProductResource;

class ProductController extends Controller
{
    use Response;
    public function __construct()
    {
        $this->middleware('permission:show_product')->only(['index', 'show']);
        $this->middleware('permission:add_product')->only(['store']);
        $this->middleware('permission:edit_product')->only(['update']);
        $this->middleware('permission:delete_product')->only(['destroy']);
        $this->middleware('permission:search_product')->only(['search']);
    }
    /**
     * Display a listing of the resource.
     */
    public function index()
    {
        if (Product::exists()) {
            $products = Product::paginate(PAGINATE);
            return $this->paginateResponse('data fetched successfully', ProductResource::collection($products));
        }
        return $this->errorResponse();
    }

    /**
     * Display the specified resource.
     */
    public function show($id)
    {
        $product = Product::find($id);
        if ($product) {
            return $this->okResponse('data fetched successfully', ProductResource::make($product));
        }
        return $this->errorResponse();
    }

    /**
     * Store a newly created resource in storage.
     */
    public function store(ProductRequest $request)
    {
        $data = $request->validated();
        $product = Product::create($data);
        $product->addMediaFromRequest('image')->toMediaCollection('product_image');
        if ($product) {
            return $this->okResponse('product created', ProductResource::make($product));
        }
    }



    /**
     * Update the specified resource in storage.
     */
    public function update(ProductRequest $request, $id)
    {
        $data = $request->validated();
        $product = Product::find($id);
        if ($product) {
            $product->update($data);
            $product->clearMediaCollection('product_image');
            $product->addMediaFromRequest('image')->toMediaCollection('product_image');
            return $this->okResponse('product updated', ProductResource::make($product));
        }
        return $this->errorResponse();
    }

    /**
     * Remove the specified resource from storage.
     */
    public function destroy($id)
    {
        $product = Product::find($id);
        if ($product) {
            $product->delete();
            return $this->okResponse('product deleted', []);
        }
        return $this->errorResponse();
    }

    public function search(Request $request)
    {
        $searchTerm = $request->query('name');
        if (Product::exists()) {
            $products = Product::where('name', 'like', "%$searchTerm%")->paginate(PAGINATE);
            return $this->paginateResponse('data fetched successfully', ProductResource::collection($products));
        }
    }
    public function filterByPrice(Request $request)
    {
        $minPrice = $request->query('min_price');
        $maxPrice = $request->query('max_price');
        $query = Product::query(); // Start with a fresh query builder
        if ($minPrice) {
            $query->where('price', '>=', $minPrice);
        }
        if ($maxPrice) {
            $query->where('price', '<=', $maxPrice);
        }
        if (Product::exists())  {
            $products = $query->paginate(PAGINATE);
            return $this->paginateResponse('data fetched successfully', ProductResource::collection($products));
        }
    }
}
