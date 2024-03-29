<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class Order extends Model
{

     /**
     * The primary key associated with the table.
     *
     * @var string
     */
    protected $primaryKey = 'order_id';

    protected $fillable = [
        'customer_id',
        'user_id',
        'code_transaction'
    ];

    public function items()
    {
        return $this->hasMany(OrderItem::class,'order_id');
    }

    public function orderItem()
    {
        return $this->hasOne(OrderItem::class,'order_id','order_id');
    }

    // public function orderItem()
    // {
    //     return $this->belongsTo(OrderItem::class,'id');
    // }

    public function payments()
    {
        return $this->hasMany(Payment::class,'order_id','order_id');
    }

    public function customer()
    {
        return $this->belongsTo(Customer::class);
    }

    public function getCustomerName()
    {
        if($this->customer) {
            return $this->customer->first_name . ' ' . $this->customer->last_name;
        }
        return 'Working Customer';
    }

    public function total()
    {
        return $this->items->map(function ($i){
            return $i->price;
        })->sum();
    }

    public function formattedTotal()
    {
        return number_format($this->total(), 2);
    }

    public function receivedAmount()
    {
        return $this->payments->map(function ($i){
            return $i->amount;
        })->sum();
    }

    public function formattedReceivedAmount()
    {
        return number_format($this->receivedAmount(), 2);
    }
}
