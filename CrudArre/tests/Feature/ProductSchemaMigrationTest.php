<?php

namespace Tests\Feature;

use Illuminate\Foundation\Testing\RefreshDatabase;
use Illuminate\Support\Facades\Schema;
use Tests\TestCase;

class ProductSchemaMigrationTest extends TestCase
{
    use RefreshDatabase;

    public function test_initial_migration_creates_the_indonesian_product_schema_and_keeps_breeze_users_table(): void
    {
        $this->assertFalse(Schema::hasTable('products'));
        $this->assertTrue(Schema::hasTable('produk'));
        $this->assertSame([
            'id',
            'nama_produk',
            'kategori',
            'harga',
            'stok',
            'deskripsi',
            'created_at',
            'updated_at',
        ], Schema::getColumnListing('produk'));
        $this->assertTrue(Schema::hasTable('users'));
        $this->assertTrue(Schema::hasTable('password_reset_tokens'));
        $this->assertTrue(Schema::hasTable('sessions'));
    }
}
