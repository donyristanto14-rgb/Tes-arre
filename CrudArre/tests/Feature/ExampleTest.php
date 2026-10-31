<?php

namespace Tests\Feature;

use Illuminate\Foundation\Testing\RefreshDatabase;
use Tests\TestCase;

class ExampleTest extends TestCase
{
    use RefreshDatabase;

    /**
     * A basic test example.
     */
    public function test_the_homepage_redirects_to_the_product_list(): void
    {
        $this->get('/')
            ->assertRedirect(route('products.index'));

        $this->get(route('products.index'))
            ->assertRedirect('/login');
    }
}
