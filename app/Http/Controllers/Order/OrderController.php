<?php

namespace App\Http\Controllers\Order;

use App\Models\Order;
use App\Traits\Response;
use App\Http\Requests\Order\OrderRequest;
use App\Http\Controllers\Controller;

class OrderController extends Controller
{
    use Response;
    public function __construct() {
        $this->middleware('permission:make_order'); 
    }
    public function __invoke(OrderRequest $request)
    {
        $data = $request->validated();
        $data['user_id'] = auth('userapi')->user()->id;
        $order = Order::create($data);
        return $this->okResponse('Order created successfully',$order);
    }
}
