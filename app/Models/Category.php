<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Category extends Model
{
    use HasFactory;
    protected $table = "categories";

    protected $fillable = [
        "name",
        "image",
        "status"
    ];

    public function Products(){
        return $this->hasMany(Product::class);
    }

    public function FirstProducts(){
        return $this->hasOne(Product::class)->orderBy("price","desc");
    }
}
