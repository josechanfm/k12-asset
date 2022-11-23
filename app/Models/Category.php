<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Category extends Model
{
    use HasFactory;

    protected $fillable=['parent_id','abbr','title','description','status'];

    // public function childre(){
    //     return $this->hasMany(Category::class, 'parent_id');
    // }
    // public function Supplier(){
    //     return $this->hasMany(Supplier::class);
    // }
}
