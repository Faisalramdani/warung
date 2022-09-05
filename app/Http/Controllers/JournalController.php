<?php

namespace App\Http\Controllers;

use PDF;
// use Barryvdh\DomPDF\PDF;
// use Barryvdh\DomPDF\PDF;
use App\Models\Order;
use App\Models\Journal;
use App\Models\OrderItem;
use App\Models\Product;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\DB;

class JournalController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index(Request $request)
    {
        //
        // $journal = Journal::all();

        $orders = new Order();
        if($request->start_date) {
            $orders = $orders->where('created_at', '>=', $request->start_date);
        }
        if($request->end_date) {
            $orders = $orders->where('created_at', '<=', $request->end_date . ' 23:59:59');
        }

        $orders = $orders->with(['items', 'payments', 'customer'])->latest()->paginate(10);

        // dd($orders);

        $total = $orders->map(function($i) {
            return $i->total();
        })->sum();

        $receivedAmount = $orders->map(function($i) {
            return $i->receivedAmount();
        })->sum();



        return view('journals.index',compact('orders','total','receivedAmount'));
    }


    public function journal(Request $request){


        $orders = new Order();
        if($request->start_date) {
            $orders = $orders->where('created_at', '>=', $request->start_date);
        }
        if($request->end_date) {
            $orders = $orders->where('created_at', '<=', $request->end_date . ' 23:59:59');
        }

        $orders = $orders->with(['items', 'payments', 'customer'])->latest()->paginate(10);

        $debit = DB::table('order_items')->sum('price');

        $order_id = DB::table('order_items')->select('order_id')->get();

        $kredit = Product::with(['order_items'])->get();

        $order_items = OrderItem::with(['product'])->first();


        $total = $orders->map(function($i) {
            return $i->total();
        })->sum();

        $receivedAmount = $orders->map(function($i) {
            return $i->receivedAmount();
        })->sum();

        return view('journals.jurnal-umum',compact('orders','total','debit', 'receivedAmount', 'order_items'));

    }


    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create()
    {
        //
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function store(Request $request)
    {
        //
    }

    /**
     * Display the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function show(Request $request)
    {
        //
        $periode = $request->get('periode');
        if($periode == 'All')
            {
                $orders = new Order();
                if($request->start_date) {
                    $orders = $orders->where('created_at', '>=', $request->start_date);
                }
                if($request->end_date) {
                    $orders = $orders->where('created_at', '<=', $request->end_date . ' 23:59:59');
                }

                $orders = $orders->with(['items', 'payments', 'customer'])->latest()->paginate(10);

                $total = $orders->map(function($i) {
                    return $i->total();
                })->sum();

                $receivedAmount = $orders->map(function($i) {
                    return $i->receivedAmount();
                })->sum();

            // $akun=\App\Akun::All();
            $pdf = PDF::loadview('journals.cetak',compact('orders','total','receivedAmount'))->setPaper('A4','landscape');
            return $pdf->stream();
        }elseif($periode == 'periode'){
            $tglawal = $request->get('tglawal');
            $tglakhir = $request->get('tglakhir');
            // $akun = \App\Akun::All();
            $pp= DB::table('jurnal')
                    ->whereBetween('tgl_jurnal', [$tglawal,$tglakhir])
                    ->orderby('tgl_jurnal','ASC')
                    ->get();
            $pdf = PDF::loadview('journals.cetak',['lapjur'=>$pp])->setPaper('A4','landscape');
            return $pdf->stream();
        }

    }

    public function showJurnal(Request $request)
    {
        //
        $periode = $request->get('periode');
        if($periode == 'All')
            {
                $orders = new Order();
                if($request->start_date) {
                    $orders = $orders->where('created_at', '>=', $request->start_date);
                }
                if($request->end_date) {
                    $orders = $orders->where('created_at', '<=', $request->end_date . ' 23:59:59');
                }

                $orders = $orders->with(['items', 'payments', 'customer'])->latest()->paginate(10);

                $debit = DB::table('order_items')->sum('price');

                $order_id = DB::table('order_items')->select('order_id')->get();

                $kredit = Product::with(['order_items'])->get();

                $order_items = OrderItem::with(['product'])->first();


                $total = $orders->map(function($i) {
                    return $i->total();
                })->sum();

                $receivedAmount = $orders->map(function($i) {
                    return $i->receivedAmount();
                })->sum();

            // $akun=\App\Akun::All();
            $pdf = PDF::loadview('journals.cetak-jurnal-umum',compact('orders','total','receivedAmount','debit', 'order_items'))->setPaper('A4','landscape');
            return $pdf->stream();
        }elseif($periode == 'periode'){
            $tglawal = $request->get('tglawal');
            $tglakhir = $request->get('tglakhir');
            // $akun = \App\Akun::All();
            $pp= DB::table('jurnal')
                    ->whereBetween('tgl_jurnal', [$tglawal,$tglakhir])
                    ->orderby('tgl_jurnal','ASC')
                    ->get();
            $pdf = PDF::loadview('journals.cetak',['lapjur'=>$pp])->setPaper('A4','landscape');
            return $pdf->stream();
        }

    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function edit($id)
    {
        //
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function update(Request $request, $id)
    {
        //
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function destroy($id)
    {
        //
    }
}
