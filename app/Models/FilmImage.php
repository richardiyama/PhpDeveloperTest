<?php

namespace App\Models\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class FilmImage extends Model
{
    use HasFactory;

    /**
     * @var string
     */
    protected $table = 'film_images';

    /**
     * @var array
     */
    protected $fillable = ['film_id', 'thumbnail', 'full'];

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
