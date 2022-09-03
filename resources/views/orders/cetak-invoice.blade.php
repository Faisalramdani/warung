<!DOCTYPE html>
<html>
<head>
<title>Laporan Penjualan</title>
<link rel="stylesheet" href="https://stackpath.bootstrapcdn.com/bootstrap/4.3.1/css/bootstrap.min.css" integrity="sha384-ggOyR0iXCbMQv3Xipma34MD+dH/1fQ784/j6cY/iJTQUOhcWr7x9JvoRxT2MZw1T" crossorigin="anonymous">
<style type="text/css">
table tr td,
table tr th{
font-size: 10pt;
}
</style>
</head>
<body>
<table class="table table-bordered" width="100%" align="center">
<tr align="center">
<td><h2>Invoice<br>Toko DARMA Bogor</h2>
</td>
</tr>
</table>
<table class="table table-bordered" width="100%" align="center">
<thead>
<tr>
<th width="5%">ID</th>
<th width="15%">Pembeli</th>
<th width="5%">Harga</th>
<th width="5%">Qty</th>
<th width="5%">Pembayaran</th>
<th width="5%">Tanggal</th>
</tr>
</thead>
<tbody>
</td>
@php
$subtotal1 = 0;
$subtotal2 = 0;
@endphp

@foreach ($orders as $bb)
<!-- pembuatan prulangan bersarang -->
{{-- @if($loop->parent->first) --}}
<tr>
<th>{{$bb->id}}</th>
<th>{{$bb->getCustomerName()}}</th>
<th>{{ config('settings.currency_symbol') }} {{$bb->formattedReceivedAmount()}}</th>
<th>{{$bb->orderItem->quantity}}</th>
<th>
     @if($bb->receivedAmount() == 0)
    <span class="badge badge-danger">Belum Bayar</span>
    @elseif($bb->receivedAmount() < $bb->total())
        <span class="badge badge-warning">Kurang</span>
    @elseif($bb->receivedAmount() == $bb->total())
        <span class="badge badge-success">Lunas</span>
    @elseif($bb->receivedAmount() > $bb->total())
        <span class="badge badge-info">Kembalian</span>
    @endif
</th>
<th>{{ $bb->created_at }}</th>
</tr>
@endforeach
{{-- <tr> --}}
{{-- <th>Rp. {{ number_format($subtotal1) }}</th>
<th>Rp. {{ number_format($subtotal2) }}</th> --}}
{{-- </tr> --}}
</tbody>
</table>
<div align="right">
<h6>Tanda Tangan</h6><br><br><h6>{{ Auth::user()->first_name }}</h6>
</div>
</body>
</html>
