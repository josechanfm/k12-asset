<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use App\Models\ItemImage;

class Item extends Model
{
    use HasFactory;
    protected $fillable=['serial','title_zh','title_en','description','location_id','category_id','tag_ids'];
    public function images(){
        return $this->hasMany(ItemImage::class);
    }

}
