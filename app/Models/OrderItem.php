<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class OrderItem extends Model
{
      /**
     * The primary key associated with the table.
     *
     * @var string
     */
    protected $primaryKey = 'order_item_id';

    protected $fillable =[
        'price',
        'quantity',
        'product_id',
        'order_id',
        'code_transaction'
    ];

    public function product()
    {
        return $this->belongsTo(Product::class);
    }
}
