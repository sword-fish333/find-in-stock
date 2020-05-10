<?php

namespace App;

use App\Clients\BestBuy;
use App\Clients\ClientException;
use Facades\App\Clients\ClientFactory;
use App\Clients\Target;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Support\Str;

class Stock extends Model
{
    protected $table='stocks';
    protected $guarded=[];

    protected $casts=[
      'in_stock'=>'boolean'
    ];

    public function track(){
//        $class=Str::studly($this->retailer->name);
        $status=$this->retailer->client()->checkAvailability($this);;

            $this->update([
                'in_stock'=>$status->available,
                'price'=>$status->price,

            ]);

    }

    public function retailer(){
        return $this->belongsTo(Retailer::class);
    }
}
