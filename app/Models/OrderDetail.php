<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class OrderDetail extends Model
{
    use HasFactory;
    protected $table = 'order_details';
    protected $fillable=['order_id','product_id',
                        'unit_price','quantity',
                        'amount','discount'];
    public function products(){
        return $this->belongsTo('App\Models\Product','product_id','id');
    }
    public function orders(){
        return $this->belongsTo('App\Models\Order','order_id','id');
    }
    public function transaction(){
        return $this->belongsTo('App\Models\Transaction','order_id','order_id');
    }                   
}
