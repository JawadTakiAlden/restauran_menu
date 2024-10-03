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
        $newImageName = uniqid() . '_' . 'logo_'. now()->timestamp . '.' . $logo->extension();
        $logo->move(public_path('restaurant_images/logos') , $newImageName);
        return $this->attributes['logo'] =  '/restaurant_images/logos/'. $newImageName;
    }

    public function setQrAttribute ($logo){
        if (!$logo){
            return $this->attributes['qr'] = fake()->imageUrl;
        }
        $newImageName = uniqid() . '_' . 'qr_'. now()->timestamp . '.' . $logo->extension();
        $logo->move(public_path('restaurant_images/QR') , $newImageName);
        return $this->attributes['qr'] =  '/restaurant_images/QRs/'. $newImageName;
    }

    public function setCoverAttribute ($cover){
        if (!$cover){
            return $this->attributes['cover'] = fake()->imageUrl;
        }
        $newImageName = uniqid() . '_' . 'cover_'. now()->timestamp . '.' . $cover->extension();
        $cover->move(public_path('restaurant_images/covers') , $newImageName);
        return $this->attributes['cover'] =  '/restaurant_images/covers/'. $newImageName;
    }
}
