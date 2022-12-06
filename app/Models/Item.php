<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use App\Models\ItemImage;

class Item extends Model
{
    use HasFactory;

    public function images(){
        return $this->hasMany(ItemImage::class);
    }

}
