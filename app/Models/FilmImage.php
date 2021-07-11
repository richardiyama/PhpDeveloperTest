<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class FilmImage extends Model
{
    /**
     * @var string
     */
    protected $table = 'film_images';

    /**
     * @var array
     */
    protected $fillable = ['film_id', 'full'];

    /**
     * @var array
     */
    protected $casts = [
        'film_id'    =>  'integer',
    ];

    /**
     * @return \Illuminate\Database\Eloquent\Relations\BelongsTo
     */
    public function film()
    {
        return $this->belongsTo(Film::class);
    }
}
