<?php

namespace App\Http\Controllers\Order;

use App\Models\Order;
use App\Traits\Response;
use Illuminate\Http\Request;
use App\Http\Controllers\Controller;
use App\Http\Requests\Order\OrderRequest;
use App\Http\Resources\Order\OrderResource;

class OrderController extends Controller
{
    use Response;
    public function __construct() {
        $this->middleware('permission:show_order')->only(['index', 'show']);
        $this->middleware('permission:make_order')->only(['store']);
        $this->middleware('permission:edit_order')->only(['update']);
        $this->middleware('permission:delete_order')->only(['destroy']); 
    }
    
    public function index()
    {
        if (Order::exists()) {
            $orders = Order::paginate(PAGINATE);
            return $this->paginateResponse(OrderResource::collection($orders));
        }
        return $this->errorResponse();
    }
    public function show($id)
    {
        $order = Order::find($id);
        if ($order) {
            return $this->okResponse('data fetched successfully', OrderResource::make($order));
        }
        return $this->errorResponse();
    }
    public function store(OrderRequest $request)
    {
        $data = $request->validated();
        $data['user_id'] = auth('userapi')->user()->id;
        $order = Order::create($data);
        return $this->okResponse('Order created successfully',$order);
    }
    public function update(OrderRequest $request,$id)
    {
        $data = $request->validated();
        $data['user_id'] = auth('userapi')->user()->id;
        $order = Order::find($id);
        if ($order) {
            $order->update($data);
            return $this->okResponse('order updated', OrderResource::make($order));
        }
        return $this->errorResponse();
    }
    public function destroy($id)
    {
        $order = Order::find($id);
        if ($order) {
            $order->delete();
            return $this->okResponse('order deleted', []);
        }
        return $this->errorResponse();
    }
}
