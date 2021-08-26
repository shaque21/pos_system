<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Product extends Model
{
    use HasFactory;
    protected $table = 'products';
    protected $fillable=['product_name','description',
                        'brand','price',
                        'quantity','alert_stock',
                        'product_slug','product_status','product_img'];

    public function order_details(){
        return $this->hasMany(OrderDetail::class);
    }
}
