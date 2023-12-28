<?php

namespace App\Http\Controllers\user;

use Carbon\Carbon;
use App\Models\Cart;
use App\Models\Order;
use App\Models\Product;
use App\Models\OrderList;
use Illuminate\Http\Request;
use App\Http\Controllers\Controller;
use Illuminate\Support\Facades\Auth;

class ajaxController extends Controller
{
    //product sorting
    public function list(Request $request)
    {
        if ($request->status == 'asc') {
            $data = Product::orderBy('created_at', 'asc')->get();
        } else {
            $data = Product::orderBy('created_at', 'desc')->get();
        }

        return response()->json($data, 200);
    }

    //redirect pizza order list
    public function addCart(Request $request)
    {
        $data = $this->getOrderData($request);

        Cart::create($data);

        $response = [
            'message' => 'Add to Cart success',
            'status' => 'success',
        ];

        return response()->json($response, 200);
    }

    //Order Checkout
    public function checkout(Request $request)
    {
        $total = 0;

        foreach ($request->all() as $item) {
            $data = OrderList::create([
                'user_id' => $item['user_id'],
                'product_id' => $item['product_id'],
                'qty' => $item['qty'],
                'order_code' => $item['order_code'],
                'total' => $item['total'],
            ]);

            $total += $data->total;
        }

        //delete cart data
        Cart::where('user_id', Auth::user()->id)->delete();


        // import orderList data to order table
        Order::create([
            'user_id' => Auth::user()->id,
            'order_code' => $data->order_code,
            'total_price' => $total + 3500,
        ]);

        return response()->json([
            'status' => 'true',
            'message' => 'order complete....',
        ], 200);
    }


    //clear cart
    public function clear()
    {
        Cart::where('user_id', Auth::user()->id)->delete();
    }

    //clear current product
    public function clearCurrentProduct(Request $request)
    {
        Cart::where('user_id', Auth::user()->id)
            ->where('product_id', $request->productId)
            ->where('id', $request->orderId)
            ->delete();
    }


    // private pizza data
    private function getOrderData($request)
    {
        return [
            'user_id' => $request->user,
            'product_id' => $request->pizza,
            'qty' => $request->count,
            'created_at' => Carbon::now(),
            'updated_at' => Carbon::now(),
        ];
    }

    //increase view count
    public function count(Request $request)
    {
        $pizza = Product::where('id', $request->productId)->first();

        Product::where('id', $request->productId)->update([

            'view_count' => $pizza->view_count + 1
        ]);
    }
}
