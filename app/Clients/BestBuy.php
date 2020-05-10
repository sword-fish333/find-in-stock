<?php


namespace App\Clients;


use App\Stock;
use GuzzleHttp\Client;

class BestBuy implements RetailerClient
{

    public function checkAvailability(Stock $stock):StockStatus{
        $result=[];
        $result['available']=true;
        $result['price']=2222;

        //        $result= (new Client())->get('http://api.bestbuy.com')->json();
        return  new StockStatus(
            $result['available'],
            $result['price']
        );
    }
}
