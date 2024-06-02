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
        'hash',
        'entry',
    ];

    use HasFactory;

    protected $casts=[
      'entry'=>'array',
    ];

    public function products()
    {
        return $this->morphToMany(Product::class, 'fileable');
    }
}
