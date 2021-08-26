<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Transaction extends Model
{
    use HasFactory;
    protected $table = 'transactions';
    protected $fillable=['order_id','paid_amount',
                        'change_balance','payment_method',
                        'user_id','transaction_date',
                        'transaction_amount'];

    public function order(){
        return $this->belongsTo('App\Models\Order','order_id','id');
    }
    public function user(){
        return $this->belongsTo('App\Models\User','user_id','id');
    }
    public function order_detail(){
        return $this->belongsTo('App\Models\OrderDetail','order_id','order_id');
    }
}
