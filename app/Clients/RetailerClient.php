<?php


namespace App\Clients;


use App\Stock;

interface RetailerClient
{
        public function checkAvailability(Stock $stock);
}
