<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class Product extends Model
{
      /**
     * The primary key associated with the table.
     *
     * @var string
     */
    // protected $primaryKey = 'product_id';

    protected $fillable = [
        'name',
        'description',
        'image',
        'barcode',
        'price_buy',
        'price',
        'quantity',
        'status'
    ];

    public function order_items(){

        return $this->hasMany(OrderItem::class);

    }

}
