<?php

namespace App\Http\Controllers;

use App\Models\Product;
use Illuminate\View\View;

class DashboardController extends Controller
{
    private const LOW_STOCK_THRESHOLD = 5;

    public function __invoke(): View
    {
        $totalProducts = Product::query()->count();
        $categoryCount = Product::query()->distinct()->count('kategori');

        $lowStockProductsQuery = Product::query()
            ->where('stok', '<=', self::LOW_STOCK_THRESHOLD);

        $lowStockCount = (clone $lowStockProductsQuery)->count();
        $lowStockProducts = $lowStockProductsQuery
            ->orderBy('stok')
            ->orderBy('nama_produk')
            ->limit(5)
            ->get();

        return view('dashboard', [
            'totalProducts' => $totalProducts,
            'categoryCount' => $categoryCount,
            'lowStockCount' => $lowStockCount,
            'lowStockProducts' => $lowStockProducts,
            'lowStockThreshold' => self::LOW_STOCK_THRESHOLD,
        ]);
    }
}
