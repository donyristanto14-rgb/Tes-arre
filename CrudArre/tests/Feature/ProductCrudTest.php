<?php

namespace Tests\Feature;

use App\Models\Product;
use App\Models\User;
use Illuminate\Foundation\Testing\RefreshDatabase;
use Tests\TestCase;

class ProductCrudTest extends TestCase
{
    use RefreshDatabase;

    protected function setUp(): void
    {
        parent::setUp();

        $this->actingAs(User::factory()->create());
    }

    public function test_product_pages_are_available(): void
    {
        $product = Product::create([
            'nama_produk' => 'Keyboard',
            'kategori' => 'Aksesoris',
            'harga' => 250000,
            'stok' => 5,
            'deskripsi' => 'Keyboard mekanis',
        ]);

        $this->get(route('products.index'))
            ->assertOk()
            ->assertSeeText('Keyboard')
            ->assertSee('href="/products/create"', false)
            ->assertSee('href="/products/'.$product->id.'"', false)
            ->assertSee('href="/products/'.$product->id.'/edit"', false)
            ->assertSee('action="/products/'.$product->id.'"', false)
            ->assertSee('name="_method" value="DELETE"', false)
            ->assertDontSee('localhost:8000', false);

        $this->get(route('products.create'))
            ->assertOk()
            ->assertSee('action="/products"', false)
            ->assertSee('name="nama_produk"', false)
            ->assertSee('name="kategori"', false)
            ->assertSee('name="harga"', false)
            ->assertSee('name="stok"', false)
            ->assertSee('name="deskripsi"', false)
            ->assertSee('name="_token"', false)
            ->assertDontSee('localhost:8000', false);

        $this->get(route('products.show', $product))
            ->assertOk()
            ->assertSeeText('Keyboard')
            ->assertSee('href="/products/'.$product->id.'/edit"', false)
            ->assertDontSee('localhost:8000', false);

        $this->get(route('products.edit', $product))
            ->assertOk()
            ->assertSee('action="/products/'.$product->id.'"', false)
            ->assertSee('name="_method" value="PUT"', false)
            ->assertSee('value="Keyboard"', false)
            ->assertSee('name="nama_produk"', false)
            ->assertDontSee('localhost:8000', false);
    }

    public function test_products_can_be_searched_by_name_or_category(): void
    {
        Product::create([
            'nama_produk' => 'Mechanical Keyboard',
            'kategori' => 'Aksesoris',
            'harga' => 250000,
            'stok' => 5,
        ]);
        Product::create([
            'nama_produk' => 'Wireless Mouse',
            'kategori' => 'Elektronik',
            'harga' => 150000,
            'stok' => 8,
        ]);

        $this->get(route('products.index', ['search' => 'Mechanical']))
            ->assertOk()
            ->assertSeeText('Mechanical Keyboard')
            ->assertDontSeeText('Wireless Mouse')
            ->assertSee('value="Mechanical"', false);

        $this->get(route('products.index', ['search' => 'Elektronik']))
            ->assertOk()
            ->assertSeeText('Wireless Mouse')
            ->assertDontSeeText('Mechanical Keyboard');
    }

    public function test_products_are_shared_between_authenticated_team_members(): void
    {
        Product::create([
            'nama_produk' => 'Shared Team Keyboard',
            'kategori' => 'Aksesoris',
            'harga' => 250000,
            'stok' => 5,
        ]);

        $this->actingAs(User::factory()->create())
            ->get(route('products.index'))
            ->assertOk()
            ->assertSeeText('Shared Team Keyboard');
    }

    public function test_product_list_is_paginated_and_search_is_kept_on_next_page(): void
    {
        foreach (range(1, 12) as $number) {
            Product::create([
                'nama_produk' => 'Keyboard '.$number,
                'kategori' => 'Aksesoris',
                'harga' => 100000 + $number,
                'stok' => $number,
            ]);
        }

        $this->get(route('products.index', ['search' => 'Keyboard']))
            ->assertOk()
            ->assertSeeText('Keyboard 12')
            ->assertDontSeeText('Keyboard 2')
            ->assertSee('search=Keyboard', false)
            ->assertSee('page=2', false);

        $this->get(route('products.index', ['search' => 'Keyboard', 'page' => 2]))
            ->assertOk()
            ->assertSeeText('Keyboard 2')
            ->assertSeeText('Keyboard 1')
            ->assertDontSeeText('Keyboard 12');
    }

    public function test_product_can_be_created_updated_and_deleted(): void
    {
        $attributes = [
            'nama_produk' => 'Mouse',
            'kategori' => 'Aksesoris',
            'harga' => 125000,
            'stok' => 10,
            'deskripsi' => 'Mouse wireless',
        ];

        $this->post(route('products.store'), $attributes)
            ->assertRedirect('/products')
            ->assertSessionHas('success');

        $product = Product::query()->where('nama_produk', 'Mouse')->firstOrFail();
        $this->assertDatabaseHas('produk', $attributes);

        $this->put(route('products.update', $product), [
            ...$attributes,
            'nama_produk' => 'Mouse Baru',
        ])->assertRedirect('/products')
            ->assertSessionHas('success');

        $this->assertDatabaseHas('produk', ['id' => $product->id, 'nama_produk' => 'Mouse Baru']);

        $this->delete(route('products.destroy', $product))
            ->assertRedirect('/products')
            ->assertSessionHas('success');

        $this->assertDatabaseMissing('produk', ['id' => $product->id]);
    }

    public function test_product_input_is_validated(): void
    {
        $invalidAttributes = [
            'nama_produk' => '',
            'kategori' => '',
            'harga' => -1,
            'stok' => 1.5,
            'deskripsi' => ['invalid'],
        ];

        $this->from(route('products.create'))
            ->post(route('products.store'), $invalidAttributes)
            ->assertRedirect(route('products.create'))
            ->assertSessionHasErrors(['nama_produk', 'kategori', 'harga', 'stok', 'deskripsi']);

        $this->assertDatabaseCount('produk', 0);
    }

    public function test_product_text_is_escaped_in_views(): void
    {
        $product = Product::create([
            'nama_produk' => '<script>alert(1)</script>',
            'kategori' => 'Aksesoris',
            'harga' => 100,
            'stok' => 1,
        ]);

        $this->get(route('products.show', $product))
            ->assertOk()
            ->assertSee('&lt;script&gt;alert(1)&lt;/script&gt;', false)
            ->assertDontSee('<script>alert(1)</script>', false);
    }
}
