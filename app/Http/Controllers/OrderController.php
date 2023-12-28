<?php

namespace App\Http\Controllers;

use App\Models\Order;
use App\Models\OrderList;
use Illuminate\Http\Request;

class OrderController extends Controller
{
    // redirect order page
    public function orderPage()
    {
        $orderData = Order::select('orders.*', 'users.name as user_name')
            ->leftJoin('users', 'users.id', 'orders.user_id')
            ->orderBy('created_at', 'desc')
            ->get();

        return view('admin.order.list', compact('orderData'));
    }

    public function orderStatus(Request $request)
    {
        $orderData = Order::select('orders.*', 'users.name as user_name')
            ->leftJoin('users', 'users.id', 'orders.user_id')
            ->orderBy('created_at', 'desc');

        if ($request->orderStatus == null) {
            $orderData = $orderData->get();
        } else ($orderData = $orderData->where('status', $request->orderStatus)->get()
        );

        return view('admin.order.list', compact('orderData'));
    }

    //order status change
    public function change(Request $request)
    {
        Order::where('id', $request->orderId)->update([
            'status' => $request->currentStatus
        ]);
    }

    //order list info
    public function info($orderCode)
    {
        $order = Order::where('order_code', $orderCode)->get();
        $orderList = OrderList::select('order_lists.*', 'users.name as user_name', 'products.image as product_image')
            ->where('order_code', $orderCode)
            ->leftJoin('users', 'users.id', 'order_lists.user_id')
            ->leftJoin('products', 'products.id', 'order_lists.product_id')
            ->get();

        return view('admin.order.info', compact('orderList', 'order'));
    }
}
