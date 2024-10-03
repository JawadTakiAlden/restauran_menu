<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Offer extends Model
{
    use HasFactory;
    protected $guarded = ['id'];

    public function setImageAttribute ($image){
        if (!$image){
            return $this->attributes['image'] = fake()->imageUrl;
        }
        $newImageName = uniqid() . '_' . 'offer' . '.' . $image->extension();
        $image->move(public_path('offer_images') , $newImageName);
        return $this->attributes['image'] =  '/'.'offer_images'.'/' . $newImageName;
    }
}
