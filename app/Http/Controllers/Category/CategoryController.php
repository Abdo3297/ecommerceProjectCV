<?php

namespace App\Http\Controllers\Category;

use App\Models\Category;
use App\Traits\Response;
use App\Http\Controllers\Controller;
use App\Http\Requests\Category\CategoryRequest;
use App\Http\Resources\Category\CategoryResource;
use Illuminate\Http\Request;

class CategoryController extends Controller
{
    use Response;
    public function __construct()
    {
        $this->middleware('permission:show_category')->only(['index', 'show']);
        $this->middleware('permission:add_category')->only(['store']);
        $this->middleware('permission:edit_category')->only(['update']);
        $this->middleware('permission:delete_category')->only(['destroy']);
        $this->middleware('permission:search_category')->only(['search']);
    }
    /**
     * Display a listing of the resource.
     */
    public function index()
    {
        if (Category::exists()) {
            $categories = Category::paginate(PAGINATE);
            return $this->paginateResponse('data fetched successfully', CategoryResource::collection($categories));
        }
        return $this->errorResponse();
    }

    /**
     * Display the specified resource.
     */
    public function show($id)
    {
        $category = Category::find($id);
        if ($category) {
            return $this->okResponse('data fetched successfully', CategoryResource::make($category));
        }
        return $this->errorResponse();
    }

    /**
     * Store a newly created resource in storage.
     */
    public function store(CategoryRequest $request)
    {
        $data = $request->validated();
        $category = Category::create($data);
        if ($category) {
            return $this->okResponse('category created', CategoryResource::make($category));
        }
    }

    /**
     * Update the specified resource in storage.
     */
    public function update(CategoryRequest $request, $id)
    {
        $data = $request->validated();
        $category = Category::find($id);
        if ($category) {
            $category->update($data);
            return $this->okResponse('category updated', CategoryResource::make($category));
        }
        return $this->errorResponse();
    }

    /**
     * Remove the specified resource from storage.
     */
    public function destroy($id)
    {
        $category = Category::find($id);
        if ($category) {
            $category->delete();
            return $this->okResponse('category deleted', []);
        }
        return $this->errorResponse();
    }
    public function search(Request $request) {
        $searchTerm = $request->query('name');
        if (Category::exists())  {
            $categories = Category::where('name', 'like', "%$searchTerm%")->paginate(PAGINATE);
            return $this->paginateResponse('data fetched successfully', CategoryResource::collection($categories));
        }
        return $this->errorResponse();
    }
}
