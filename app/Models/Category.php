<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Category extends Model
{
    use HasFactory;
    protected $guarded = ['id'];

    public function setImageAttribute ($image){
        if (!$image){
            return $this->attributes['image'] = fake()->imageUrl;
        }
        $newImageName = uniqid() . '_' . 'category' . '.' . $image->extension();
        $image->move(public_path('category_images') , $newImageName);
        return $this->attributes['image'] =  '/'.'category_images'.'/' . $newImageName;
    }

}
