<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Restaurant extends Model
{
    use HasFactory;
    protected $guarded = ['id'];

    public function setLogoAttribute ($logo){
        if (!$logo){
            return $this->attributes['logo'] = fake()->imageUrl;
        }
        $newImageName = uniqid() . '_' . 'logo' . '.' . $logo->extension();
        $logo->move(public_path('restaurant_images/logos') , $newImageName);
        return $this->attributes['logo'] =  '/restaurant_images/logos/'. $newImageName;
    }

    public function setCoverAttribute ($cover){
        if (!$cover){
            return $this->attributes['cover'] = fake()->imageUrl;
        }
        $newImageName = uniqid() . '_' . 'cover' . '.' . $cover->extension();
        $cover->move(public_path('restaurant_images/covers') , $newImageName);
        return $this->attributes['cover'] =  '/restaurant_images/covers/'. $newImageName;
    }
}
