<?php

namespace App\Http\Controllers\Pay;

use App\Models\Order;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\DB;
use App\Http\Controllers\Controller;
use Srmklive\PayPal\Services\ExpressCheckout;

class PaypalController extends Controller
{
    public function payment()
    {
        $data = [];
        $items = Order::select('product_id', 'qty')->get();
        $data['items'] = [];
        foreach ($items as $item) {
            $product = DB::table('products')->where('id', $item->product_id)->first();
            if ($product) {
                $data['items'][] = [
                    'name' => $product->name,
                    'price' => $product->price,
                    'qty' => $item->qty
                ];
            }
        }
        $data['invoice_id'] = 1;
        $data['invoice_description'] = "Order Invoice";
        $data['return_url'] = route('payment.success');
        $data['cancel_url'] = route('payment.cancel');
        $total = 0;
        foreach ($data['items'] as $item) {
            $total += $item['qty'] * $item['price'];
        }
        $data['total'] = $total;
        $provider = new ExpressCheckout;
        $response = $provider->setExpressCheckout($data, true);
        return redirect($response['paypal_link']);
    }
    public function cancel()
    {
        return response()->json([
            'message' => 'Payment Cancelled',
            'type' => 'error',
            'status' => 402
        ], 402);
    }
    public function success(Request $request)
    {
        $token = $request->query('token');
        $payerId = $request->query('PayerID');
        $provider = new ExpressCheckout;
        $response = $provider->getExpressCheckoutDetails($request->token);
        if (in_array(strtoupper($response['ACK']), ['SUCCESS', 'SUCCESSWITHWARNING'])) {
            return response()->json([
                'message' => 'Paid Successfully',
                'type' => 'success',
                'status' => 200,
                'token' => $token,
                'PayerID' => $payerId,
            ], 200);
        }
        return response()->json([
            'message' => 'Payment Failed',
            'type' => 'error',
            'status' => 402
        ], 402);
    }
}
