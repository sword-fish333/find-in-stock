<?php

namespace Tests\Feature;

use App\Product;
use Illuminate\Foundation\Testing\RefreshDatabase;
use Illuminate\Foundation\Testing\WithFaker;
use Tests\TestCase;

class TrackCommandTest extends TestCase
{

    use RefreshDatabase;

    public function test_it_tracks_a_product_stock()
    {
        $this->seed(\RetailerWithProduct::class);
        $this->assertFalse(Product::first()->inStock());

        $mock = new \GuzzleHttp\Handler\MockHandler([
            new \GuzzleHttp\Psr7\Response(200, ['available'=>true,'price'=>200]),
        ]);
        $this->artisan('track');
        $this->assertTrue(Product::first()->inStock());
    }
}
