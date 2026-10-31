@extends('layouts.app')

@section('title', 'Dashboard')

@section('content')
    <div class="mb-4">
        <h1 class="h2 mb-1">Dashboard</h1>
        <p class="text-secondary mb-0">Ringkasan inventaris tim Anda.</p>
    </div>

    <div class="row g-3 mb-4">
        <div class="col-12 col-sm-6 col-lg-4">
            <section class="card h-100 border-0 shadow-sm">
                <div class="card-body p-4">
                    <p class="small text-secondary mb-2">Total produk</p>
                    <p class="display-6 fw-semibold mb-0">{{ number_format($totalProducts, 0, ',', '.') }}</p>
                </div>
            </section>
        </div>
        <div class="col-12 col-sm-6 col-lg-4">
            <section class="card h-100 border-0 shadow-sm">
                <div class="card-body p-4">
                    <p class="small text-secondary mb-2">Kategori</p>
                    <p class="display-6 fw-semibold mb-0">{{ number_format($categoryCount, 0, ',', '.') }}</p>
                </div>
            </section>
        </div>
        <div class="col-12 col-sm-6 col-lg-4">
            <section class="card h-100 border-0 shadow-sm">
                <div class="card-body p-4">
                    <p class="small text-secondary mb-2">Stok rendah <span class="fw-normal">(≤ {{ $lowStockThreshold }})</span></p>
                    <p class="display-6 fw-semibold {{ $lowStockCount > 0 ? 'text-danger' : '' }} mb-0">{{ number_format($lowStockCount, 0, ',', '.') }}</p>
                </div>
            </section>
        </div>
    </div>

    <section class="card border-0 shadow-sm">
        <div class="d-flex flex-column flex-sm-row justify-content-between align-items-sm-center gap-2 border-bottom p-3 p-md-4">
            <div>
                <h2 class="h6 fw-semibold mb-1">Perlu restok</h2>
                <p class="small text-secondary mb-0">Produk dengan stok {{ $lowStockThreshold }} unit atau kurang.</p>
            </div>
            <a href="{{ route('products.index', absolute: false) }}" class="btn btn-sm btn-outline-secondary">Semua produk</a>
        </div>

        @if ($lowStockProducts->isNotEmpty())
            <div class="table-responsive">
                <table class="table table-hover align-middle mb-0">
                    <thead class="table-light">
                        <tr>
                            <th scope="col" class="px-3 px-md-4">Produk</th>
                            <th scope="col">Kategori</th>
                            <th scope="col">Stok tersisa</th>
                            <th scope="col" class="text-end px-3 px-md-4">Tindakan</th>
                        </tr>
                    </thead>
                    <tbody>
                        @foreach ($lowStockProducts as $product)
                            <tr>
                                <td class="px-3 px-md-4 fw-semibold">{{ $product->nama_produk }}</td>
                                <td>{{ $product->kategori }}</td>
                                <td><span class="badge text-bg-danger">{{ $product->stok }}</span></td>
                                <td class="text-end px-3 px-md-4">
                                    <a href="{{ route('products.show', $product, false) }}" class="btn btn-sm btn-outline-secondary">Detail</a>
                                </td>
                            </tr>
                        @endforeach
                    </tbody>
                </table>
            </div>
            @if ($lowStockCount > $lowStockProducts->count())
                <p class="small text-secondary border-top px-3 px-md-4 py-3 mb-0">
                    Ditampilkan {{ $lowStockProducts->count() }} dari {{ $lowStockCount }} produk stok rendah.
                </p>
            @endif
        @else
            <p class="text-secondary text-center py-5 mb-0">Tidak ada produk yang perlu direstok.</p>
        @endif
    </section>
@endsection
