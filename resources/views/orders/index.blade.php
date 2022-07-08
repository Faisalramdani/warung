@extends('layouts.admin')

@section('title', 'Penjualan')
@section('content-header', 'Penjualan')
@section('content-actions')
@if (Auth::user()->role_id == 1)

@else
<a href="{{route('cart.index')}}" class="btn btn-primary">Transaksi</a>
@endif
@endsection

@section('content')
<div class="card">
    <div class="card-body">
        <div class="row">
            <div class="col-md-7"></div>
            <div class="col-md-5">
                <form action="{{route('orders.index')}}">
                    <div class="row">
                        <div class="col-md-5">
                            <input type="date" name="start_date" class="form-control" value="{{request('start_date')}}" />
                        </div>
                        <div class="col-md-5">
                            <input type="date" name="end_date" class="form-control" value="{{request('end_date')}}" />
                        </div>
                        <div class="col-md-2">
                            <button class="btn btn-outline-primary" type="submit">Submit</button>
                        </div>
                    </div>
                </form>
            </div>
        </div>
        <table class="table">
            <thead>
                <tr>
                    <th>ID</th>
                    <th>Nama</th>
                    <th>Kode Transaksi</th>
                    <th>Total harga</th>
                    <th>Uang di terima</th>
                    <th>Status</th>
                    <th>total kembalian</th>
                    <th>Tanggal</th>
                    <th>Aksi</th>
                </tr>
            </thead>
            <tbody>
                @foreach ($orders as $order)
                <tr>
                    <td>{{$order->id}}</td>
                    <td>{{$order->getCustomerName()}}</td>
                    <td>{{$order->orderItem->code_transaction}}</td>
                    <td>{{ config('settings.currency_symbol') }} {{$order->formattedTotal()}}</td>
                    <td>{{ config('settings.currency_symbol') }} {{$order->formattedReceivedAmount()}}</td>
                    <td>
                        @if($order->receivedAmount() == 0)
                            <span class="badge badge-danger">Belum bayar</span>
                        @elseif($order->receivedAmount() < $order->total())
                            <span class="badge badge-warning">Pembayaran Kurang</span>
                        @elseif($order->receivedAmount() == $order->total())
                            <span class="badge badge-success">Sudah di bayar</span>
                        @elseif($order->receivedAmount() > $order->total())
                            <span class="badge badge-info">Kembalian</span>
                        @endif
                    </td>
                    <td>{{config('settings.currency_symbol')}} {{number_format($order->total() - $order->receivedAmount(), 2)}}</td>
                    <td>{{$order->created_at}}</td>
                    <td>
                        <div class="form-group row">
                                <form action="{{ route('invoice') }}" method="Post" >
                                    @csrf
                                    <input type="hidden" name="id" value="{{ $order->id }}">
                                    <button class="btn btn-sm btn-success mr-2">Cetak Invoice</button>
                                </form>
                                <form action="{{ route('coupon') }}" method="post">
                                    @csrf
                                    <input type="hidden" name="id" value="{{ $order->id }}">
                                    <button class="btn btn-sm btn-warning">Cetak Kupon</button>
                                </form>
                            </div>
                    </td>
                </tr>
                @endforeach
            </tbody>
            <tfoot>
                <tr>
                    <th></th>
                    <th></th>
                    <th></th>
                    <th>{{ config('settings.currency_symbol') }} {{ number_format($total, 2) }}</th>
                    <th>{{ config('settings.currency_symbol') }} {{ number_format($receivedAmount, 2) }}</th>
                    <th></th>
                    <th></th>
                    <th></th>
                    <th></th>
                </tr>
            </tfoot>
        </table>
        {{ $orders->render() }}
    </div>
</div>
@endsection

