<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Maison extends Model
{
    /** @use HasFactory<\Database\Factories\MaisonFactory> */
    use HasFactory;

    protected $fillable = [
        'title',
        'address',
        'price',
        'rooms',
        'size',
        'description',
        'user_id'
    ];

    public function users()
    {
        return $this->belongsTo(User::class);
    }

    public function images()
    {
        return $this->hasMany(Image::class);
    }

}
