@extends('layouts.app')

@section('title', 'Daftar Produk')

@section('content')
    <div class="d-flex flex-column flex-sm-row justify-content-between align-items-sm-center gap-3 mb-4">
        <div>
            <h1 class="h2 mb-1">Daftar Produk</h1>
            <p class="text-secondary mb-0">Kelola produk yang tersimpan.</p>
        </div>
        <a href="{{ route('products.create', [], false) }}" class="btn btn-primary">Tambah Produk</a>
    </div>

    <div class="card border-0 shadow-sm">
        <div class="d-flex flex-column flex-md-row justify-content-between align-items-md-center gap-3 p-3 border-bottom">
            <div class="small text-secondary">
                Menampilkan {{ $products->firstItem() ?? 0 }}–{{ $products->lastItem() ?? 0 }} dari {{ $products->total() }} produk bersama
            </div>
            <form action="{{ route('products.index', [], false) }}" method="GET" class="d-flex gap-2">
                <label for="productSearch" class="visually-hidden">Cari nama atau kategori produk</label>
                <input
                    type="search"
                    name="search"
                    id="productSearch"
                    value="{{ $search }}"
                    class="form-control"
                    placeholder="Cari nama atau kategori"
                    maxlength="255"
                >
                <button type="submit" class="btn btn-outline-primary flex-shrink-0">Cari</button>
                @if ($search !== '')
                    <a href="{{ route('products.index', [], false) }}" class="btn btn-outline-secondary flex-shrink-0">Reset</a>
                @endif
            </form>
        </div>
        <div class="table-responsive">
            <table class="table table-hover align-middle mb-0">
                <thead class="table-light">
                    <tr>
                        <th scope="col">Nama</th>
                        <th scope="col">Kategori</th>
                        <th scope="col">Harga</th>
                        <th scope="col">Stok</th>
                        <th scope="col" class="text-end">Aksi</th>
                    </tr>
                </thead>
                <tbody>
                    @forelse ($products as $product)
                        <tr>
                            <td class="fw-semibold">{{ $product->nama_produk }}</td>
                            <td>{{ $product->kategori }}</td>
                            <td>{{ number_format((float) $product->harga, 2, ',', '.') }}</td>
                            <td>{{ $product->stok }}</td>
                            <td>
                                <div class="d-flex justify-content-end flex-wrap gap-2">
                                    <a href="{{ route('products.show', $product, false) }}" class="btn btn-sm btn-outline-primary">Detail</a>
                                    <a href="{{ route('products.edit', $product, false) }}" class="btn btn-sm btn-outline-secondary">Edit</a>
                                    <form action="{{ route('products.destroy', $product, false) }}" method="POST" onsubmit="return confirm('Yakin ingin menghapus produk ini?')">
                                        @csrf
                                        @method('DELETE')
                                        <button type="submit" class="btn btn-sm btn-outline-danger">Hapus</button>
                                    </form>
                                </div>
                            </td>
                        </tr>
                    @empty
                        <tr>
                            <td colspan="5" class="text-center text-secondary py-5">
                                {{ $search !== '' ? 'Tidak ada produk yang cocok dengan pencarian.' : 'Belum ada produk.' }}
                            </td>
                        </tr>
                    @endforelse
                </tbody>
            </table>
        </div>
        @if ($products->hasPages())
            <div class="border-top p-3">
                {{ $products->links('pagination::bootstrap-5') }}
            </div>
        @endif
    </div>
@endsection
