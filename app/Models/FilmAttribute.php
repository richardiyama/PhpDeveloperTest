<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class FilmAttribute extends Model
{
    /**
     * @var string
     */
    protected $table = 'film_attributes';

    /**
     * @var array
     */
    protected $fillable = ['attribute_id', 'film_id', 'value', 'quantity', 'price'];

    /**
     * @return \Illuminate\Database\Eloquent\Relations\BelongsTo
     */
    public function film()
    {
        return $this->belongsTo(Film::class);
    }

    /**
     * @return \Illuminate\Database\Eloquent\Relations\BelongsTo
     */
    public function attribute()
    {
        return $this->belongsTo(Attribute::class);
    }
}
