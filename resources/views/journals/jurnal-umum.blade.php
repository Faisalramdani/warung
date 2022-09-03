@extends('layouts.admin')

@section('title', 'Laporan')
@section('content-header', 'Laporan')
@section('content-actions')
{{-- <a href="{{route('products.create')}}" class="btn btn-primary">Create Product</a> --}}
@endsection
@section('css')
<link rel="stylesheet" href="{{ asset('plugins/sweetalert2/sweetalert2.min.css') }}">
@endsection
@section('content')
<div class="card product-list">
    <div class="card-header">
        <form action="{{ route('print-journal') }}" method="Post" target="_blank">
            @csrf
            <fieldset>
                <div class="form-group row">
                        <div class="col-md-4">
                            {{-- <label for="klasifikasi">Periode Laporan</label> --}}
                            <input type="hidden" name="periode" value="All">
                            {{-- <input id="jenis" type="hidden" name="jenis" value="bukubesar" class="form-control"> --}}
                                            {{-- <select id="periode" name="periode" class="form-control">
                                                <option value="">--Pilih Periode Laporan--</option>
                                                <option value="All">Semua</option>
                                                <option value="periode">Per Periode</option>
                                            </select> --}}
                        </div>
                        {{-- <div class="col-md-3">
                            <label for="no_hp">Tanggal Awal</label>
                            <input id="tglawal" type="date" name="tglawal" class="form-control">
                        </div>
                        <div class="col-md-3">
                            <label for="no_hp">Tanggal Akhir</label>
                            <input id="tglakhir" type="date" name="tglakhir" class="form-control">
                        </div> --}}
                        <div class="col-md-2 p-4 mt-1 ml-auto">
                            <input type="submit" class="btn btn-success btnsend" value="Cetak" >
                        </div>
                </div>
            </fieldset>
            </form>
    </div>
    <div class="card-body">
        <table class="table">
            <thead>
                <tr class="bg-secondary">
                    <th>Nama</th>
                    <th colspan="2">Akun</th>
                    <th>Debit</th>
                    <th>Kredit</th>
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
        {{-- {{ $journal->render() }} --}}
    </div>
</div>
@endsection

@section('js')
<script src="{{ asset('plugins/sweetalert2/sweetalert2.min.js') }}"></script>
<script>
    $(document).ready(function () {
        $(document).on('click', '.btn-delete', function () {
            $this = $(this);
            const swalWithBootstrapButtons = Swal.mixin({
                customClass: {
                    confirmButton: 'btn btn-success',
                    cancelButton: 'btn btn-danger'
                },
                buttonsStyling: false
                })

                swalWithBootstrapButtons.fire({
                title: 'Are you sure?',
                text: "Do you really want to delete this product?",
                icon: 'warning',
                showCancelButton: true,
                confirmButtonText: 'Yes, delete it!',
                cancelButtonText: 'No',
                reverseButtons: true
                }).then((result) => {
                if (result.value) {
                    $.post($this.data('url'), {_method: 'DELETE', _token: '{{csrf_token()}}'}, function (res) {
                        $this.closest('tr').fadeOut(500, function () {
                            $(this).remove();
                        })
                    })
                }
            })
        })
    })
</script>
@endsection
