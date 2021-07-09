<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class OrderItem extends Model
{
    protected $table = 'order_items';

    protected $fillable = [
        'order_id', 'film_id', 'quantity', 'price'
    ];

    public function film()
    {
        return $this->belongsTo(Film::class, 'film_id');
    }
}
