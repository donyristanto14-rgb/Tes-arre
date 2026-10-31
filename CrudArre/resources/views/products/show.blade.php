@extends('layouts.app')

@section('title', 'Detail Produk')

@section('content')
    <div class="d-flex flex-column flex-sm-row justify-content-between align-items-sm-center gap-3 mb-4">
        <div>
            <h1 class="h2 mb-1">Detail Produk</h1>
            <p class="text-secondary mb-0">Informasi lengkap produk.</p>
        </div>
        <div class="d-flex gap-2">
            <a href="{{ route('products.index', [], false) }}" class="btn btn-outline-secondary">Kembali</a>
            <a href="{{ route('products.edit', $product, false) }}" class="btn btn-primary">Edit Produk</a>
        </div>
    </div>

    <div class="card border-0 shadow-sm">
        <div class="card-body p-4">
            <dl class="row mb-0">
                <dt class="col-sm-3 mb-2">Nama</dt>
                <dd class="col-sm-9 mb-3">{{ $product->nama_produk }}</dd>
                <dt class="col-sm-3 mb-2">Kategori</dt>
                <dd class="col-sm-9 mb-3">{{ $product->kategori }}</dd>
                <dt class="col-sm-3 mb-2">Harga</dt>
                <dd class="col-sm-9 mb-3">{{ number_format((float) $product->harga, 2, ',', '.') }}</dd>
                <dt class="col-sm-3 mb-2">Stok</dt>
                <dd class="col-sm-9 mb-3">{{ $product->stok }}</dd>
                <dt class="col-sm-3 mb-2">Deskripsi</dt>
                <dd class="col-sm-9 mb-0">{{ $product->deskripsi ?: 'Tidak ada deskripsi.' }}</dd>
            </dl>
        </div>
    </div>
@endsection
