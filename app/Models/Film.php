<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Film extends Model
{
    use HasFactory;

 /**
     * @var string
     */
    protected $table = 'films';

    /**
     * The attributes that are mass assignable.
     *
     * @var array
     */
    protected $fillable = [
        'name',
        'description',
         'genre_id',
         'quantity',
          'price',
    ];

    public function genre(){
        return $this->belongsTo(Genre::class, 'genre_id','id');
    }

    /**
 * @return \Illuminate\Database\Eloquent\Relations\HasMany
 */
     public function images(){
    return $this->hasMany(FilmImage::class);
    }

}
