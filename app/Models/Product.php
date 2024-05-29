<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Product extends Model
{
    use HasFactory;
    protected $fillable = ['name', 'type', 'slug','category_id','description'];

    public function category(){
        return $this->belongsTo(Product::class);
    }
    public function files(){
        return $this->morphToMany(File::class,'fileable');
    }
}
