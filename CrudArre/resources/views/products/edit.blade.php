@extends('layouts.app')

@section('title', 'Edit Produk')

@section('content')
    <div class="mb-4">
        <h1 class="h2 mb-1">Edit Produk</h1>
        <p class="text-secondary mb-0">Perbarui informasi produk.</p>
    </div>

    <form action="{{ route('products.update', $product, false) }}" method="POST" class="card border-0 shadow-sm">
        @csrf
        @method('PUT')
        <div class="card-body p-4">
            @if ($errors->any())
                <div class="alert alert-danger" role="alert">Periksa kembali data yang dimasukkan.</div>
            @endif

            <div class="row g-3">
                <div class="col-12 col-md-6">
                    <label for="nama_produk" class="form-label">Nama produk</label>
                    <input type="text" name="nama_produk" id="nama_produk" value="{{ old('nama_produk', $product->nama_produk) }}" class="form-control @error('nama_produk') is-invalid @enderror" maxlength="255" required>
                    @error('nama_produk') <div class="invalid-feedback">{{ $message }}</div> @enderror
                </div>
                <div class="col-12 col-md-6">
                    <label for="kategori" class="form-label">Kategori</label>
                    <input type="text" name="kategori" id="kategori" value="{{ old('kategori', $product->kategori) }}" class="form-control @error('kategori') is-invalid @enderror" maxlength="255" required>
                    @error('kategori') <div class="invalid-feedback">{{ $message }}</div> @enderror
                </div>
                <div class="col-12 col-md-6">
                    <label for="harga" class="form-label">Harga</label>
                    <input type="number" name="harga" id="harga" value="{{ old('harga', $product->harga) }}" class="form-control @error('harga') is-invalid @enderror" min="0" step="0.01" required>
                    @error('harga') <div class="invalid-feedback">{{ $message }}</div> @enderror
                </div>
                <div class="col-12 col-md-6">
                    <label for="stok" class="form-label">Stok</label>
                    <input type="number" name="stok" id="stok" value="{{ old('stok', $product->stok) }}" class="form-control @error('stok') is-invalid @enderror" min="0" step="1" required>
                    @error('stok') <div class="invalid-feedback">{{ $message }}</div> @enderror
                </div>
                <div class="col-12">
                    <label for="deskripsi" class="form-label">Deskripsi <span class="text-secondary">(opsional)</span></label>
                    <textarea name="deskripsi" id="deskripsi" rows="4" class="form-control @error('deskripsi') is-invalid @enderror">{{ old('deskripsi', $product->deskripsi) }}</textarea>
                    @error('deskripsi') <div class="invalid-feedback">{{ $message }}</div> @enderror
                </div>
            </div>
        </div>
        <div class="card-footer bg-white d-flex flex-column flex-sm-row justify-content-end gap-2 p-3">
            <a href="{{ route('products.index', [], false) }}" class="btn btn-outline-secondary">Batal</a>
            <button type="submit" class="btn btn-primary">Simpan Perubahan</button>
        </div>
    </form>
@endsection
