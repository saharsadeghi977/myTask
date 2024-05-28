<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class File extends Model
{
    protected $fillable=[
        'title',
        'type',
        'storage',
        'path',



    ];

    use HasFactory;
    public function morphable(){
        return $this->morphTo();
    }
}
