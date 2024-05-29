<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class File extends Model
{
    protected $fillable = [
        'title',
        'type',
        'storage',
        'path',
        'entry',
    ];

    use HasFactory;

    public function products()
    {
        return $this->morphToMany(Product::class, 'fileable');
    }
}
