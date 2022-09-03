<?php

namespace App\Http\Controllers;

use App\Models\Order;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\DB;
use App\Http\Requests\OrderStoreRequest;
use PDF;

class OrderController extends Controller
{
    public function index(Request $request) {

        $orders = new Order();
        if($request->start_date) {
            $orders = $orders->where('created_at', '>=', $request->start_date);
        }
        if($request->end_date) {
            $orders = $orders->where('created_at', '<=', $request->end_date . ' 23:59:59');
        }

        $orders = $orders->with(['items', 'payments', 'customer', 'orderItem'])
                    ->orderBy('id','asc')
                    ->latest()
                    ->paginate(10);
        // dd($orders);

        $total = $orders->map(function($i) {
            return $i->total();
        })->sum();

        $receivedAmount = $orders->map(function($i) {
            return $i->receivedAmount();
        })->sum();

        return view('orders.index', compact('orders', 'total', 'receivedAmount'));
    }

    public function store(OrderStoreRequest $request)
    {
        // dd($request->all());

        $order = Order::create([
            'customer_id' => $request->customer_id,
            'user_id' => $request->user()->id,
        ]);

        $cart = $request->user()->cart()->get();

        foreach ($cart as $item) {


            $order->items()->create([
                'price' => $item->price * $item->pivot->quantity,
                'quantity' => $item->pivot->quantity,
                'product_id' => $item->id,
                'code_transaction' => $request->customer_id .'/'. $item->id .'/'. \date('d-m-y'),
            ]);
            $item->quantity = $item->quantity - $item->pivot->quantity;
            $item->save();
        }
        $request->user()->cart()->detach();
        $order->payments()->create([
            'amount' => $request->amount,
            'user_id' => $request->user()->id,
        ]);
        return 'success';
    }


    public function show(Request $request){

        // dd($request->all());

        // $invoice = DB::table('orders')
        // ->where('id',$request->id)
        // ->first();

        $orders = new Order();

        $orders = $orders->with(['items', 'payments', 'customer'])
                    ->where('id',$request->id)->get();

        // $order = Order::all();

        // dd($order->orderItem);

        // dd($orders);

        $pdf = PDF::loadview('orders.cetak-invoice',['orders'=>$orders])->setPaper('A4','landscape');
        return $pdf->stream();


    }

    public function coupon(Request $request){



        $orders = new Order();

        $orders = $orders->with(['items', 'payments', 'customer'])
                    ->where('id',$request->id)->first();

        $pdf = PDF::loadview('orders.cetak-kupon',['orders'=>$orders])->setPaper('A4','landscape');
        return $pdf->stream();


    }



}
