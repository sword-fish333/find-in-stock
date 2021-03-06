<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class Product extends Model
{
    protected $table='products';
    protected $guarded=[];

    public function inStock(){

        return $this->stock()->where('in_stock',true)->exists();
    }

    public function stock(){
        return $this->hasMany(Stock::class);
    }
    public function track()
    {
        $this->stock->each->track();
    }
}
