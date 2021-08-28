<?php

namespace App\Http\Controllers\Admin\Api;

use App\Http\Controllers\Controller;
use App\Models\Order;
use Illuminate\Database\QueryException;

class OrdersController extends Controller
{
    /**
     * @return \Illuminate\Http\JsonResponse
     */
    public function index()
    {
        try {
            $orders = Order::active()->with('products.product.images')->with('gift_certificates.gift_certificate')->latest()->paginate(10);
            return response()->json($orders, 200);
        } catch (QueryException $exception) {
            return response()->json(['message'=>$exception->getMessage(), 'success'=>false], 500);
        }
    }
}
