<?php

namespace App\Http\Controllers;

use App\Http\Requests\ProductRequest;
use App\Http\Resources\ProductResource;
use App\Models\Product;
use App\Traits\Response;
use Illuminate\Http\Request;

class ProductController extends Controller
{
    use Response;
    public function __construct()
    {
        $this->middleware('permission:show_product')->only(['index', 'show']);
        $this->middleware('permission:add_product')->only(['store']);
        $this->middleware('permission:edit_product')->only(['update']);
        $this->middleware('permission:delete_product')->only(['destroy']);
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
    public function update(ProductRequest $request,$id)
    {
        //
    }

    /**
     * Remove the specified resource from storage.
     */
    public function destroy(string $id)
    {
        //
    }
}
