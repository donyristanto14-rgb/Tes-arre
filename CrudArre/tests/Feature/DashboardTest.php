<?php

namespace Tests\Feature;

use App\Models\Product;
use App\Models\User;
use Illuminate\Foundation\Testing\RefreshDatabase;
use Tests\TestCase;

class DashboardTest extends TestCase
{
    use RefreshDatabase;

    public function test_dashboard_shows_shared_inventory_summary_and_low_stock_products(): void
    {
        Product::create([
            'nama_produk' => 'Nearly Empty Mouse',
            'kategori' => 'Aksesoris',
            'harga' => 100000,
            'stok' => 0,
        ]);
        Product::create([
            'nama_produk' => 'Low Stock Keyboard',
            'kategori' => 'Aksesoris',
            'harga' => 250000,
            'stok' => 5,
        ]);
        Product::create([
            'nama_produk' => 'Available Monitor',
            'kategori' => 'Elektronik',
            'harga' => 1500000,
            'stok' => 6,
        ]);

        $this->actingAs(User::factory()->create())
            ->get(route('dashboard'))
            ->assertOk()
            ->assertSeeText('Total produk')
            ->assertSeeText('Kategori')
            ->assertSeeText('Stok rendah')
            ->assertSeeText('Nearly Empty Mouse')
            ->assertSeeText('Low Stock Keyboard')
            ->assertDontSeeText('Available Monitor')
            ->assertSee('>3</p>', false)
            ->assertSee('>2</p>', false);
    }

    public function test_dashboard_shows_empty_low_stock_state(): void
    {
        Product::create([
            'nama_produk' => 'Available Monitor',
            'kategori' => 'Elektronik',
            'harga' => 1500000,
            'stok' => 6,
        ]);

        $this->actingAs(User::factory()->create())
            ->get(route('dashboard'))
            ->assertOk()
            ->assertSeeText('Tidak ada produk yang perlu direstok.')
            ->assertSeeText('Dashboard');
    }

    public function test_guests_cannot_access_dashboard_inventory_summary(): void
    {
        $this->get(route('dashboard'))
            ->assertRedirect('/login');
    }
}
