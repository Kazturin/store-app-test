<?php

namespace App\Http\Controllers;

use App\Models\Order;
use Illuminate\Support\Facades\Auth;

class OrderController extends Controller
{
    /**
     * @return \Illuminate\Contracts\Foundation\Application|\Illuminate\Contracts\View\Factory|\Illuminate\Contracts\View\View
     */

    public function index(){

        $orders = Order::with('product')->whereHas('product',function ($query) {
            $query->where(['products.created_by'=>Auth::user()->id]);
        })->orderBy('created_at')->paginate(20);

        return view('order.index',compact('orders'));
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param  \App\Models\Order  $order
     * @return \Illuminate\Http\RedirectResponse
     */

    public function confirm(Order $order){

        $order->status = Order::STATUS_CONFIRMED;
        $order->save();

        return redirect()->route('orders.index')->with('success', 'Подтвержден');
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param  \App\Models\Order  $order
     * @return \Illuminate\Http\RedirectResponse
     */

    public function reject(Order $order){

        $order->status = Order::STATUS_REJECTED;
        $order->save();

        return redirect()->route('orders.index')->with('reject', 'Отклонен');

    }
}
