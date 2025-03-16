@extends('layouts.template')
@section('content')
    <div class="card card-outline card-primary">
        <div class="card-header">
            <h3 class="card-title">{{ $page->title }}</h3>
            <div class="card-tools"></div>
        </div>
        <div class="card-body">
            @empty($stok)
                <div class="alert alert-danger alert-dismissible">
                    <h5><i class="icon fas fa-ban"></i> Kesalahan!</h5>
                    Data yang Anda cari tidak ditemukan.
                </div>
            @else
                <table class="table table-bordered table-striped table-hover table-sm">
                    <tr>
                        <th>ID Stok</th>
                        <td>{{ $stok->stok_id }}</td>
                    </tr>
                    <tr>
                        <th>Nama Barang</th>
                        <td>{{ optional($stok->barang)->barang_nama ?? '-' }}</td>
                    </tr>
                    <tr>
                        <th>Kategori</th>
                        <td>{{ optional($stok->barang->kategori)->kategori_nama ?? '-' }}</td>
                    </tr>
                    <tr>
                        <th>Kode Barang</th>
                        <td>{{ optional($stok->barang)->barang_kode ?? '-' }}</td>
                    </tr>
                    <tr>
                        <th>Jumlah Stok</th>
                        <td>{{ $stok->stok_jumlah }}</td>
                    </tr>
                    <tr>
                        <th>Tanggal Stok</th>
                        <td>{{ date('d-m-Y', strtotime($stok->stok_tanggal)) }}</td>
                    </tr>
                    <tr>
                        <th>User</th>
                        <td>{{ optional($stok->user)->nama ?? 'Tidak Ada' }}</td>
                    </tr>
                    <tr>
                        <th>Harga Beli</th>
                        <td>{{ number_format(optional($stok->barang)->harga_beli, 0, ',', '.') }}</td>
                    </tr>
                    <tr>
                        <th>Harga Jual</th>
                        <td>{{ number_format(optional($stok->barang)->harga_jual, 0, ',', '.') }}</td>
                    </tr>
                </table>
            @endempty
            <a href="{{ url('stok') }}" class="btn btn-sm btn-default mt-2">Kembali</a>
        </div>
    </div>
@endsection
@push('css')
@endpush
@push('js')
@endpush
