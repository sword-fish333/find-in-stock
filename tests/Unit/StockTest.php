<?php

namespace Tests\Unit;

use App\Clients\ClientException;
use Facades\App\Clients\ClientFactory;
use App\Clients\RetailerClient;
use App\Clients\StockStatus;
use App\Retailer;
use App\Stock;
use Illuminate\Foundation\Testing\RefreshDatabase;
use Tests\TestCase;
class StockTest extends TestCase
{
    use RefreshDatabase;
    public function test_exception_if_client_not_found()
    {
        $this->seed(\RetailerWithProduct::class);
        Retailer::first()->update(['name'=>'Foo retailer']);

        $this->expectException(ClientException::class);

        Stock::first()->track();


    }

    public function test_update_local_stock_status_after_being_tracked(){

        $this->seed(\RetailerWithProduct::class);

        $clientMock=\Mockery::mock(RetailerClient::class);
        $clientMock->shouldReceive('checkAvailability')->andReturn(new StockStatus($availability=true,$price=22222));
        ClientFactory::shouldReceive('make')->andReturn($clientMock);
        $stock=tap(Stock::first())->track();
        $this->assertTrue($stock->in_stock);
        $this->assertEquals(2222,$stock->price);
    }
}
class FakeClient implements RetailerClient{
    public function checkAvailability(Stock $stock)
    {
        return new StockStatus($available=true, $price=2222);
    }
}
