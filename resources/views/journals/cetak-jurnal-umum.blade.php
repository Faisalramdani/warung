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
<td><h2>Laporan Penjualan<br>Toko DARMA Bogor</h2>
</td>
</tr>
</table>
<table class="table table-bordered" width="100%" align="center">
<thead>
<tr>
{{-- <th width="5%">Nama</th>
<th width="15%">Akun</th>
<th width="5%">Debit</th>
<th width="5%">Kredit</th>
<th width="5%">Tanggal</th> --}}
<tr class="bg-secondary">
    <th>Nama</th>
    <th colspan="2">Akun</th>
    <th>Debit</th>
    <th>Kredit</th>
</tr>
</tr>
</thead>
<tbody>
    {{-- Looping data jurnal --}}
    @foreach ($orders as $order)
        @foreach ($order->items as $item)
        {{-- {{$item}} --}}
        <tr>
            <td>{{ $order_items->product->name }}</td>
            <td colspan="2">5.2.0 - Kas</td>
            <td>{{ floor($item->price) }}</td>
            <td>0</td>
        </tr>
        @if($item)
        <tr>
            <td>{{ $order_items->product->name }}</td>
            <td colspan="2">5.2.1 - Penjualan</td>
                <td>0</td>
                <td>{{ floor($item->price) }}</td>
            </tr>
        @else

        @endif
        @endforeach
    @endforeach
    {{-- <tr>
        <td colspan="2">5.2.1 - Pembelian</td>
        <td>0</td>
        <td>25000</td>
    </tr> --}}
</tbody>
<tfoot>
    @php
        $total = 0;
    @endphp

        {{-- @foreach ($order->items as $item) --}}
            <tr class="bg-secondary">
                <td colspan="3"><b>Total</b></td>
                <td><b>{{ floor($debit) }}</b></td>
                <td><b>{{ floor($debit) }}</b></td>
            </tr>
        {{-- @endforeach     --}}
    {{-- @endforeach --}}
</tfoot>
</table>
<div align="right">
<h6>Tanda Tangan</h6><br><br><h6>{{ Auth::user()->first_name }}</h6>
</div>
</body>
</html>
