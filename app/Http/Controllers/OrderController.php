<?php

namespace App\Http\Controllers;

use App\Models\Order;
use App\Contracts\OrderContract;
class OrderController extends Controller
{
    

    public function __construct()
    {
        
    }

    public function index()
    {
        $orders = Order::all();
      
        
        return view('admin.orders.index', compact('orders'));
    }

    public function show($orderNumber)
    {
        $order = Order::find($id);
        return view('admin.orders.show', compact('order'));
    }
}
